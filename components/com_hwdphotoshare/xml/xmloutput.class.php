<?php
/**
 *    @version [ Accetto ]
 *    @package hwdPhotoShare
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
 * This class is the HTML generator for hwdphotoshare frontend
 *
 * @package    hwdphotoshare
 * @author     Dave Horsfall <info@highwooddesign.co.uk>
 * @copyright  2008 Highwood Design
 * @license    http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @version    1.1.4 Alpha RC2.13
 */
class hwd_ps_xmlOutput
{
    /**
     * Make xml playlist for mostviewed (today) which will
     * be used by the hwdphotoshare modules.
     *
     * @return       True
     */
    function prepareSlideshowXML($album_id)
    {
		global $mosConfig_live_site, $limitstart, $mosConfig_absolute_path, $database, $mainframe, $Itemid;
		$c = hwd_ps_Config::get_instance();

    	if (file_exists(JPATH_SITE.DS.'plugins'.DS.'hwdps-slideshow'.DS.$c->hwdps_slideshow_file.'.php')) {

    		include_once(JPATH_SITE.DS.'plugins'.DS.'hwdps-slideshow'.DS.$c->hwdps_slideshow_file.'.php');
			prepareSlideshow::writeXML($album_id);

    	} else if (file_exists(JPATH_SITE.DS.'plugins'.DS.'hwdps-slideshow'.DS.'autoviewer.php')) {

    		include_once(JPATH_SITE.DS.'plugins'.DS.'hwdps-slideshow'.DS.'autoviewer.php');
			prepareSlideshow::writeXML($album_id);

    	}

		return true;
    }
}
?>