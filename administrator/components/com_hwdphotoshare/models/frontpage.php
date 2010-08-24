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

class hwdps_BE_frontpage
{
   /**
	* delete groups
	*/
	function frontpage()
	{
		global $database, $mainframe, $limitstart, $my, $Itemid, $mosConfig_live_site;
  		$db =& JFactory::getDBO();

		$stats = array();

        $db->setQuery( "SELECT count(*) FROM #__hwdpsphotos WHERE approved = \"pending\"" );
		$stats['photo_approvals'] = $db->loadResult();

		$db->SetQuery( "SELECT count(*) FROM #__hwdpsalbums WHERE approved = \"pending\"" );
		$stats['album_approvals'] = $db->loadResult();

		$db->SetQuery( "SELECT count(*) FROM #__hwdpsflagged_photos WHERE status = \"UNREAD\"" );
		$stats['reportedphotos'] = $db->loadResult();

		$db->SetQuery( "SELECT count(*) FROM #__hwdpsflagged_albums WHERE status = \"UNREAD\"" );
		$stats['reportedaldums'] = $db->loadResult();

		$db->SetQuery( "SELECT count(*) FROM #__hwdpsflagged_groups WHERE status = \"UNREAD\"" );
		$stats['reportedgroups'] = $db->loadResult();

		$db->SetQuery( "SELECT count(*) FROM #__hwdpsphotos" );
		$stats['totalphotos'] = $db->loadResult();

		$db->SetQuery( "SELECT count(*) FROM #__hwdpsalbums" );
		$stats['totalalbums'] = $db->loadResult();

		$db->SetQuery( "SELECT count(*) FROM #__hwdpscategories" );
		$stats['totalcategories'] = $db->loadResult();

		$db->SetQuery( "SELECT count(*) FROM #__users" );
		$stats['totalusers'] = $db->loadResult();

		$db->SetQuery( "SELECT count(*) FROM #__hwdpsgroups" );
		$stats['totalgroups'] = $db->loadResult();

		hwd_ps_HTML::homepage($stats);
	}
}
?>