<?php
/**
 *    @version [ Cape ]
 *    @package hwdRevenueManager
 *    @copyright (C) 2007 - 2009 Highwood Design
 *    @license Creative Commons Attribution-Non-Commercial-No Derivative Works 3.0 Unported Licence
 *    @license http://creativecommons.org/licenses/by-nc-nd/3.0/
 */
defined( '_JEXEC' ) or die( 'Direct Access to this location is not allowed.' );
if (!defined('HWDRM_PL_PATH')) { define( 'HWDRM_PL_PATH', dirname(__FILE__) ); }

require_once (HWDRM_PL_PATH.'/../../../components/com_hwdvideoshare/hwdvideoshare.class.php');

/**
 * This class is the HTML generator for hwdVideoShare frontend
 *
 * @package    hwdRevenueManager
 * @author     Dave Horsfall <info@highwooddesign.co.uk>
 * @copyright  (C) 2007 - 2009 Highwood Design
 * @license    http://creativecommons.org/licenses/by-nc-nd/3.0/
 * @version    2.1.1
 */
class hwd_rm_playlist
{
    /**
     * Outputs xspf playlists for basic video advert functionality
     *
     * @param array  $row  video data
     * @return       Nothing
     */
    function writeFile($row, $truepath=null, $pre_url=null, $post_url=null, $image='')
    {
		$configfile = HWDRM_PL_PATH.'/../../../components/com_hwdvideoshare/xml/xspf/'.$row->id.'.xml';

		$location = urldecode($truepath);

		if (empty($location)) {
			return;
		}

		$config = null;
		$config .= "<playlist version=\"1\">\n";
		$config .= "<title>hwdVideoShare Playlist</title>\n";
		$config .= "<tracklist>\n";

		  if (!empty($pre_url)) {
			$config .= "  <track>\n";
			$config .= "    <location><![CDATA[".trim($pre_url)."]]></location>\n";
		    $config .= "    <image><![CDATA[".trim($image)."]]></image>\n";
			$config .= "  </track>\n";
		  }

		  $config .= "  <track>\n";
		  $config .= "    <location><![CDATA[".trim($location)."]]></location>\n";
		  $config .= "    <image><![CDATA[".trim($image)."]]></image>\n";
		  if ($row->video_type !== "youtube.com") {
		    $config .= "  <meta rel='type'>video</meta>\n";
		  }
		  $config .= "  </track>\n";

		  if (!empty($post_url)) {
			$config .= "  <track>\n";
			$config .= "    <location><![CDATA[".trim($post_url)."]]></location>\n";
		    $config .= "    <image><![CDATA[".trim($image)."]]></image>\n";
			$config .= "  </track>\n";
		  }

		$config .= "</tracklist>\n";
		$config .= "</playlist>\n";

		if ($fp = fopen("$configfile", "w")) {
			fputs($fp, $config, strlen($config));
			fclose ($fp);
		}

		return true;
    }
}
?>