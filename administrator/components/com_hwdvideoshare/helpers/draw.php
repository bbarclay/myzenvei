<?php
/**
 *    @version [ Dannevirke ]
 *    @package hwdVideoShare
 *    @copyright (C) 2007 - 2009 Highwood Design
 *    @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
 ***
 *    This program is free software: you can redistribute it and/or modify
 *    it under the terms of the GNU General Public License as published by
 *    the Free Software Foundation, either version 3 of the License, or
 *    (at your option) any later version.
 *
 *    This program is distributed in the hope that it will be useful,
 *    but WITHOUT ANY WARRANTY; without even the implied warranty of
 *    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *    GNU General Public License for more details.
 *
 *    You should have received a copy of the GNU General Public License
 *    along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */
defined( '_JEXEC' ) or die( 'Direct Access to this location is not allowed.' );

/**
 * Process character encoding
 * @package    hwdVideoShare
 * @author     Dave Horsfall <info@highwooddesign.co.uk>
 * @copyright  2008 Highwood Design
 * @license    http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @version    1.1.3
 */
class hwdvsDrawFile {

	function generalConfig()
	{
		$db =& JFactory::getDBO();

		$configfile = JPATH_SITE.DS.'administrator'.DS.'components'.DS.'com_hwdvideoshare'.DS.'config.hwdvideoshare.php';
		@chmod ($configfile, 0777);
		if (!is_writable($configfile)) {
			return false;
		}

		$config = "<?php\n";
		$config .= "class hwd_vs_Config{ \n\n";
		$config .= "  var \$instanceConfig = null;\n\n";
		$config .= "  // Member variables\n";
		// print out config
		$query  = 'SELECT *'
				. ' FROM #__hwdvidsgs'
				;
		$db->setQuery($query);
		$rows = $db->loadObjectList();
		for ($i=0, $n=count($rows); $i < $n; $i++) {
			$row = $rows[$i];
			if ($row->setting == "flvplay_width" && empty($row->value)) { $row->value = "450"; }
			if ($row->setting == "customencode") { $row->value = addslashes($row->value); }
			$config .= "  var \$".$row->setting." = '".$row->value."';\n";
		}
		$config .= "\n  function get_instance(){\n";
		$config .= "    \$instanceConfig = new hwd_vs_Config;\n";
		$config .= "    return \$instanceConfig;\n";
		$config .= "  }\n\n";
		$config .= "}\n";
		$config .= "?>";

		if ($fp = fopen("$configfile", "w")) {
			fputs($fp, $config, strlen($config));
			fclose ($fp);
		}

		return true;
	}

	function serverConfig()
	{
		$db =& JFactory::getDBO();

		$configfile = JPATH_SITE.DS.'administrator'.DS.'components'.DS.'com_hwdvideoshare'.DS.'serverconfig.hwdvideoshare.php';
		@chmod ($configfile, 0777);
		if (!is_writable($configfile)) {
			return false;
		}

		$config = "<?php\n";
		$config .= "class hwd_vs_SConfig{ \n\n";
		$config .= "  var \$instanceConfig = null;\n\n";
		$config .= "  // Member variables\n";
		// print out config
		$query  = 'SELECT *'
				. ' FROM #__hwdvidsss'
				;
		$db->setQuery($query);
		$rows = $db->loadObjectList();
		for ($i=0, $n=count($rows); $i < $n; $i++) {
			$row = $rows[$i];
			$config .= "  var \$".$row->setting." = '".$row->value."';\n";
		}
		$config .= "\n  function get_instance(){\n";
		$config .= "    \$instanceConfig = new hwd_vs_SConfig;\n";
		$config .= "    return \$instanceConfig;\n";
		$config .= "  }\n\n";
		$config .= "}\n";
		$config .= "?>";

		if ($fp = fopen("$configfile", "w")) {
			fputs($fp, $config, strlen($config));
			fclose ($fp);
		}

		return true;
	}

    /**
     * Make xml playlist datafile
     *
     * @return       True
     */
    function XMLDataFile($rows, $filename)
    {
		global $limitstart, $mainframe, $Itemid;
		$c = hwd_vs_Config::get_instance();

		$configfile = JPATH_SITE.DS.'components'.DS.'com_hwdvideoshare'.DS.'xml'.DS.$filename.'.xml';
		if (!file_exists($configfile)) {
			$fo = @fopen($configfile, 'w');
			@fclose($fo);
		}

		@chmod ($configfile, 0777);
		if (!is_writable($configfile)) {
			return false;
		}

		$config = null;
		$config .= "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
		$config .= "<playlist version=\"1\">\n";
		$config .= "<title>hwdVideoShare ".$filename." Playlist</title>\n";
		$config .= "<info>http:/xspf.org/xspf-v1.html</info>\n";
		$config .= "<trackList>\n";
		$config .= "\n";
		// print out playlist
		for ($i=0, $n=count($rows); $i < $n; $i++) {
			$row = $rows[$i];

			////echo $row->title."<br />";

			$row->title = hwdEncoding::charset_decode_utf_8($row->title);
			$row->title = hwdEncoding::XMLEntities($row->title);

			$row->description = hwdEncoding::charset_decode_utf_8($row->description);
			$row->description = hwdEncoding::XMLEntities($row->description);

			$video_code = explode(",", $row->video_id);
			if (empty($video_code[1])) {
				$row->video_id = hwdEncoding::XMLEntities($row->video_id);
			} else {
				$video_code[0] = hwdEncoding::XMLEntities($video_code[0]);
				$video_code[1] = urlencode($video_code[1]);
				$row->video_id = implode(",", $video_code);
			}

			if (empty($row->video_length)) {
				$row->video_length = "0:00:00";
			}
			if ($row->user_id == 0) {
				$row->username = "_HWDVIDS_INFO_GUEST";
				$row->name = "_HWDVIDS_INFO_GUEST";
			}

			$config .= "  <track>\n";
			$config .= "    <id><![CDATA[".$row->id."]]></id>\n";
			$config .= "    <videotitle><![CDATA[".$row->title."]]></videotitle>\n";
			$config .= "    <videocode><![CDATA[".$row->video_id."]]></videocode>\n";
			$config .= "    <videotype><![CDATA[".$row->video_type."]]></videotype>\n";
			$config .= "    <thumbnail><![CDATA[".$row->thumbnail."]]></thumbnail>\n";
			$config .= "    <category><![CDATA[]]></category>\n";
			$config .= "    <category_id><![CDATA[".$row->category_id."]]></category_id>\n";
			$config .= "    <description><![CDATA[".$row->description."]]></description>\n";
			$config .= "    <views><![CDATA[".$row->number_of_views."]]></views>\n";
			$config .= "    <duration><![CDATA[".$row->video_length."]]></duration>\n";
			$config .= "    <rating><![CDATA[".$row->updated_rating."]]></rating>\n";
			if ($c->userdisplay == 1) {
				$config .= "    <uploader><![CDATA[".$row->username."]]></uploader>\n";
			} else {
				$config .= "    <uploader><![CDATA[".$row->name."]]></uploader>\n";
			}
			$config .= "    <uploader_id><![CDATA[".$row->user_id."]]></uploader_id>\n";
			if ($c->cbint !== "0" && !empty($row->avatar)) {
				$avatar = $row->avatar;
			} else {
				$avatar = "";
			}
			$config .= "    <avatar><![CDATA[".$avatar."]]></avatar>\n";
			$config .= "  </track>\n";
			$config .= "\n";
		}
		$config .= "</trackList>\n";
		$config .= "</playlist>\n";

		if ($fp = @fopen("$configfile", "w")) {
			fputs($fp, $config, strlen($config));
			fclose ($fp);
		}

		return true;
    }

    /**
     * Make xml playlist file
     *
     * @return       True
     */
    function XMLPlaylistFile($rows, $filename)
    {
		global $limitstart, $mainframe, $Itemid;

		$configfile = JPATH_SITE.DS.'components'.DS.'com_hwdvideoshare'.DS.'xml'.DS.'xspf'.DS.$filename.'.xml';
		if (!file_exists($configfile)) {
			$fo = @fopen($configfile, 'w');
			@fclose($fo);
		}

		@chmod ($configfile, 0777);
		if (!is_writable($configfile)) {
			return false;
		}

		$config = null;
		$config .= "<playlist version=\"1\" xmlns=\"http://xspf.org/ns/0/\">\n";
		$config .= "<title>hwdVideoShare Playlist</title>\n";
		$config .= "<info>http:/xspf.org/xspf-v1.html</info>\n";
		$config .= "<trackList>\n";
		$config .= "\n";

		// print out playlist
		for ($i=0, $n=count($rows); $i < $n; $i++) {
			$row = $rows[$i];

			if ($row->video_type == "local") {
				$location = JURI::base( true )."/hwdvideos/uploads/".$row->video_id.".flv";
				$image = JURI::base( true )."/hwdvideos/thumbs/".$row->video_id.".jpg";
			} else if ($row->video_type == "remote") {
				if (@explode(",", $row->video_id)) {
					$data = explode(",", $row->video_id);
					$location = $data[0];
					$image = $data[1];
				}
			} else if ($row->video_type == "swf") {
				$location = JURI::base( true )."/hwdvideos/uploads/".$row->video_id.".swf";
				$image = JURI::base( true )."/hwdvideos/thumbs/".$row->video_id.".jpg";
			} else {

				$plugin = hwd_vs_tools::getPluginDetails($row->video_type);
				if (!$plugin) {
					continue;
				} else {
					$prepareflvurl = preg_replace("/[^a-zA-Z0-9s_-]/", "", $row->video_type)."prepareflvurl";
					$flvurl = $prepareflvurl($row->video_id, $row->id, $Itemid);
					if (!empty($flvurl)) {
						$location = trim(urldecode($flvurl));
					} else {
						continue;
					}

					if (@explode(",", $row->video_id)) {
						$data = explode(",", $row->video_id);
						$image = trim(urldecode($data[1]));
					}
				}
			}

		    $config .= "  <track>\n";
		    $config .= "    <location><![CDATA[".$location."]]></location>\n";
		    $config .= "    <image><![CDATA[".$image."]]></image>\n";
			$config .= "	<meta rel='type'>video</meta>\n";
		    $config .= "  </track>\n";
		    $config .= "\n";
		}

		$config .= "</trackList>\n";
		$config .= "</playlist>\n";

		if ($fp = @fopen("$configfile", "w")) {
			fputs($fp, $config, strlen($config));
			fclose ($fp);
		}

		return true;
    }
}
?>