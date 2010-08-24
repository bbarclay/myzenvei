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

class hwdps_BE_approvals
{
   /**
	* show waiting approvals
	*/
	function showapprovals()
	{
		global $database, $mainframe, $limit, $limitstart;
		$db =& JFactory::getDBO();

		$db->SetQuery( "SELECT count(*)"
							. "\nFROM #__hwdpsphotos AS a"
							. "\nWHERE a.approved = \"pending\""
							);
		$total_photos = $db->loadResult();
		echo $db->getErrorMsg();

		$where = array(
		"a.approved = \"pending\"",
		);

		$query = "SELECT a.*"
				. "\nFROM #__hwdpsphotos AS a"
				. ( count( $where ) ? "\n WHERE " . implode( ' AND ', $where ) : "")
				. "\nORDER BY a.date_uploaded"
				;
		$db->SetQuery( $query );
		$rows_photos = $db->loadObjectList();

		$db->SetQuery( "SELECT count(*)"
							. "\nFROM #__hwdpsalbums AS a"
							. "\nWHERE a.approved = \"pending\""
							);
		$total_albums = $db->loadResult();
		echo $db->getErrorMsg();

		$where = array(
		"a.approved = \"pending\"",
		);

		$query = "SELECT a.*"
				. "\nFROM #__hwdpsalbums AS a"
				. ( count( $where ) ? "\n WHERE " . implode( ' AND ', $where ) : "")
				. "\nORDER BY a.date_created"
				;
		$db->SetQuery( $query );
		$rows_albums = $db->loadObjectList();

		hwd_ps_HTML::showapprovals($total_photos, $rows_photos, $total_albums, $rows_albums, $search, $filter);
	}
   /**
	* approve (& publish) videos
	*/
	function approvePhoto( $cid=null, $publish=1 ) {
		global $mainframe;
		$db =& JFactory::getDBO();
		$my = & JFactory::getUser();

		if (count( $cid ) < 1) {
			$action = $publish == 1 ? 'approve' : ($publish == -1 ? 'unapprove' : 'unpublishg');
			echo "<script> alert('Select an item to $action'); window.history.go(-1);</script>\n";
			exit;
		}

		$total = count ( $cid );
		$cids = implode( ',', $cid );

		$db->setQuery( "UPDATE #__hwdpsphotos"
						. "\nSET approved = 'yes', published = 1"
						. "\n WHERE id IN ( $cids )"
						. "\n AND ( checked_out = 0 OR ( checked_out = $my->id ) )"
						);
		if (!$db->query()) {
			echo "<script> alert('".$db->getErrorMsg()."'); window.history.go(-1); </script>\n";
			exit();
		}

		for ($i=0, $n=count($cid); $i < $n; $i++) {

			$pid = $cid[$i];

			$query = 'SELECT a.album_id'
					. ' FROM #__hwdpsphotos AS a'
					. ' WHERE a.id = '.$pid
					;

			$db->SetQuery($query);
			$album_id = $db->loadResult();

			// perform maintenance
			require_once(JPATH_SITE.DS.'administrator'.DS.'components'.DS.'com_hwdphotoshare'.DS.'libraries'.DS.'maintenance_recount.class.php');
			hwd_ps_recount::recountPhotosInAlbum($row->category_id);
			hwd_ps_tools::reorganiseAlbum($album_id);

		}

		$msg = $total ._HWDPS_ALERT_ADMIN_PAPP;
		$mainframe->enqueueMessage($msg);
		$mainframe->redirect( JURI::root( true ) . '/administrator/index.php?option=com_hwdphotoshare&task=approvals' );

	}
   /**
	* approve (& publish) videos
	*/
	function approveAlbum( $cid=null, $publish=1 ) {
		global $mainframe;
		$db =& JFactory::getDBO();
		$my = & JFactory::getUser();

		if (count( $cid ) < 1) {
			$action = $publish == 1 ? 'approve' : ($publish == -1 ? 'unapprove' : 'unpublishg');
			echo "<script> alert('Select an item to $action'); window.history.go(-1);</script>\n";
			exit;
		}

		$total = count ( $cid );
		$cids = implode( ',', $cid );

		$db->setQuery( "UPDATE #__hwdpsalbums"
						. "\nSET approved = 'yes', published = 1"
						. "\n WHERE id IN ( $cids )"
						. "\n AND ( checked_out = 0 OR ( checked_out = $my->id ) )"
						);
		if (!$db->query()) {
			echo "<script> alert('".$db->getErrorMsg()."'); window.history.go(-1); </script>\n";
			exit();
		}

		require_once(JPATH_SITE.DS.'administrator'.DS.'components'.DS.'com_hwdphotoshare'.DS.'libraries'.DS.'maintenance_recount.class.php');
		hwd_ps_recount::recountAlbumsInCategory($row->category_id);

		$msg = $total ._HWDPS_ALERT_ADMIN_AAPP;
		$mainframe->enqueueMessage($msg);
		$mainframe->redirect( JURI::root( true ) . '/administrator/index.php?option=com_hwdphotoshare&task=approvals' );
	}
}
?>