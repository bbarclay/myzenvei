<?php
/**
 *    @version [ Accetto ]
 *    @package hwdPhotoShare
 *    @copyright (C) 2007 - 2009 Highwood Design
 *    @license Creative Commons Attribution-Non-Commercial-No Derivative Works 3.0 Unported Licence
 *    @license http://creativecommons.org/licenses/by-nc-nd/3.0/
 */
defined( '_JEXEC' ) or die( 'Direct Access to this location is not allowed.' );

/**
 * This class is the HTML generator for hwdphotoshare frontend
 *
 * @package    hwdphotoshare
 * @author     Dave Horsfall <info@highwooddesign.co.uk>
 * @copyright  2008 Highwood Design
 * @license    http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @version    1.1.4 Alpha RC2.13
 */
class prepareSlideshow
{
    /**
     * Outputs frontpage HTML
     *
     * @param string $option  the joomla component name
     * @param array  $rows  array of video data
     * @param array  $rowsfeatured  array of featured video data
     * @param object $pageNav  page navigation object
     * @param int    $total  the total video count
     * @return       Nothing
     */
    function writeXML($album_id)
    {
		global $limitstart, $mainframe, $Itemid;
  		$db =& JFactory::getDBO();

		$album_id = intval($album_id);

		@mkdir(JPATH_SITE.DS.'components'.DS.'com_hwdphotoshare'.DS.'xml'.DS.'albums'.DS.'autoviewer'.DS, 0755);
		@chmod(JPATH_SITE.DS.'components'.DS.'com_hwdphotoshare'.DS.'xml'.DS.'albums'.DS.'autoviewer'.DS, 0755);
		$configfile = JPATH_SITE.DS.'components'.DS.'com_hwdphotoshare'.DS.'xml'.DS.'albums'.DS.'autoviewer'.DS.$album_id.'.xml';

		$query = 'SELECT *'
				. ' FROM #__hwdpsphotos'
		        . ' WHERE album_id = '.$album_id
				. ' ORDER BY ordering ASC'
				;

		$db->SetQuery($query);
		$albumphotos = $db->loadObjectList();

		$config = null;
		$config .= "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
		$config .= "<gallery frameColor=\"0xFFFFFF\" frameWidth=\"15\" imagePadding=\"20\" displayTime=\"6\" enableRightClickOpen=\"true\">\n";
		$config .= "\n";
		// print out playlist
		for ($i=0, $n=count($albumphotos); $i < $n; $i++) {
			$row = $albumphotos[$i];

			$imageurl = JURI::root(true)."/hwdphotos/uploads/".$row->user_id."/".$row->album_id."/".$row->photo_id.".".$row->original_type;
			$imagepath = JPATH_SITE."/hwdphotos/uploads/".$row->user_id."/".$row->album_id."/".$row->photo_id.".".$row->original_type;

			if (!@fopen($imagepath, 'r')) {
				@chmod($imagepath, 0755);
				@JPath::setPermissions($imagepath, 755);
				if (!@fopen($imagepath, 'r')) { continue; }
			}

			@list($width, $height, $type, $attr) = getimagesize($imagepath);

			$config .= "  <image>\n";
			$config .= "    <url>".$imageurl."</url>\n";
			$config .= "    <caption><![CDATA[".$row->caption."]]></caption>\n";
			$config .= "    <width>".$width."</width>\n";
			$config .= "    <height>".$height."</height>\n";
			$config .= "  </image>\n";
			$config .= "\n";
		}
		$config .= "</gallery>\n";

		if ($fp = fopen("$configfile", "w")) {
			fputs($fp, $config, strlen($config));
			fclose ($fp);
		}

		return true;
    }
}




