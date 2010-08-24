<?php
/**
 *    @version [ Accetto ]
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

class hwdps_fileManagement
{
   /**
     * This is the constructor.It try to open the csv file.The method throws an exception
     * on failure.
     *
     * @access public
     * @param str $file The csv file.
     * @param bool $withHeaders Specify if file contains header and should be used.
     * @param str $delimiter The delimiter.
     * @param str $enclosure The enclosure.
     *
     * @throws Exception
     */
   function checkDirectoryStructure()
   {
		global $database, $mainframe, $limitstart, $my, $Itemid, $mosConfig_live_site, $mosConfig_absolute_path;
		$filepath = array();
		$filepath[0] = JPATH_SITE."/hwdphotos/";
		$filepath[1] = JPATH_SITE."/hwdphotos/originals/";
		$filepath[7] = JPATH_SITE."/hwdphotos/thumbs/";
		$filepath[8] = JPATH_SITE."/hwdphotos/thumbs/normal/";
		$filepath[9] = JPATH_SITE."/hwdphotos/thumbs/square/";
		$filepath[10] = JPATH_SITE."/hwdphotos/thumbs/squarerf/";
		$filepath[11] = JPATH_SITE."/hwdphotos/uploads/";
		foreach ($filepath as $path) {
			if (file_exists($path)) {
				if (!is_writable($path)) {
					echo "<div style=\"border:2px solid #c30;color:#c30;margin-bottom:2px;padding:5px;\">"._HWDPS_ALERT_MANCHMOD." <b>".$path."</b></div>";
				}
			} else {
				echo "<div style=\"border:2px solid #c30;color:#c30;margin-bottom:2px;padding:5px;\">"._HWDPS_ALERT_MANMKDIR." <b>".$path."</b></div>";
			}
		}
   }

}
?>