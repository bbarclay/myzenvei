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

class hwdvids_BE_groups
{
   /**
	* show groups
	*/
	function showgroups()
	{
		global $option, $mainframe, $limit, $limitstart;
  		$db =& JFactory::getDBO();

		$search 		= $mainframe->getUserStateFromRequest( "search{$option}", 'search', '' );
		$search 		= $db->getEscaped( trim( strtolower( $search ) ) );

		$db->SetQuery( "SELECT count(*)"
							. "\nFROM #__hwdvidsgroups AS a"
							. "\nWHERE a.published 	>= 0"
							);
		$total = $db->loadResult();
		echo $db->getErrorMsg();

		$where = array(
		"a.published 	>= 0",
		);

		if ($search) {
			$where[] = "LOWER(a.group_name) LIKE '%$search%'";
				$db->SetQuery( "SELECT count(*)"
							. "\nFROM #__hwdvidsgroups AS a"
							. (count( $where ) ? "\n WHERE " . implode( ' AND ', $where ) : "")
							);
				$total = $db->loadResult();
				echo $db->getErrorMsg();
		}

		$pageNav = new JPagination( $total, $limitstart, $limit );

		$query = "SELECT a.*"
				. "\nFROM #__hwdvidsgroups AS a"
				. ( count( $where ) ? "\n WHERE " . implode( ' AND ', $where ) : "")
				. "\nORDER BY a.date"
				;
		$db->SetQuery( $query, $pageNav->limitstart, $pageNav->limit );
		$rows = $db->loadObjectList();

		hwdvids_HTML::showgroups($rows, $pageNav, $search);
	}
   /**
	* edit categories
	*/
	function editgroups($cid)
	{
		global $option, $acl, $my;
  		$db =& JFactory::getDBO();
		$my = & JFactory::getUser();

		$row = new hwdvids_group( $db );
		$row->load( $cid );

		// fail if checked out not by 'me'
		if ($row->isCheckedOut( $my->id )) {
			//BUMP needs change for multilanguage support
			mosRedirect( 'index.php?option='.$option.'&task=categories', 'The categorie $row->catname is currently being edited by another administrator.' );
		}

		$db->SetQuery("SELECT * FROM #__hwdvidsgroups"
							. "\nWHERE id = $cid");
		$db->loadObject($row);

		if ($cid) {
			$row->checkout( $my->id );
		} else {
			$row->published = 1;
		}

$users = array();
$users[] = JHTML::_('select.option', '0', 'Guest');
$db->setQuery( "SELECT id AS value, username AS text FROM #__users" );
$users = array_merge( $users, $db->loadObjectList() );
$selected = $row->adminid;
$uploader_list = JHTML::_('select.genericlist', $users, 'adminid', 'class="inputbox"', 'value', 'text', $row->adminid);


		hwdvids_HTML::editgroups($row, $uploader_list);
	}
	/**
	 * save categories
	 */
	function savegroup()
	{
		global $option, $mainframe;
  		$db =& JFactory::getDBO();

  		$access_lev_u = Jrequest::getVar( 'access_lev_u', '0' );
		$access_lev_v = Jrequest::getVar( 'access_lev_v', '0' );

		$row = new hwdvids_group($db);

		$_POST['category_name'] = Jrequest::getVar( 'category_name', 'no name supplied' );
		$_POST['category_description'] = Jrequest::getVar( 'category_description', 'no name supplied' );
		$_POST['access_lev_u'] = @implode(",", $access_lev_u);
		$_POST['access_lev_v'] = @implode(",", $access_lev_v);

		// bind it to the table
		if (!$row -> bind($_POST)) {
			echo "<script> alert('"
				.$row -> getError()
				."'); window.history.go(-1); </script>\n";
			exit();
		}

		// store it in the db
		if (!$row -> store()) {
			echo "<script> alert('"
				.$row -> getError()
				."'); window.history.go(-1); </script>\n";
			exit();
		}

		$row->checkin();

		// perform maintenance
		include(JPATH_SITE.DS.'administrator'.DS.'components'.DS.'com_hwdvideoshare'.DS.'libraries'.DS.'maintenance_recount.class.php');
		hwd_vs_recount::recountVideosInCategory();
		hwd_vs_recount::recountSubcatsInCategory();

		$msg = $total ._HWDVIDS_ALERT_GRPSAVED;
		$mainframe->enqueueMessage($msg);
		$mainframe->redirect( JURI::root( true ) . '/administrator/index.php?option='.$option.'&task=groups' );
	}
	/**
	 * cancel categories
	 */
	function cancelgrp()
	{
		global $option, $mainframe;
  		$db =& JFactory::getDBO();

  		$row = new hwdvids_group( $db );
		$row->bind( $_POST );
		$row->checkin();

		$mainframe->redirect( JURI::root( true ) . '/administrator/index.php?option='.$option.'&task=groups' );
	}
   /**
	* publish/unpublish groups
	*/
	function publishg($cid=null, $publish=1) {
		global $option, $mainframe;
  		$db =& JFactory::getDBO();
		$my = & JFactory::getUser();

		if (count( $cid ) < 1) {
			$action = $publish == 1 ? 'publishg' : ($publish == -1 ? 'archive' : 'unpublishg');
			echo "<script> alert('Select an item to $action'); window.history.go(-1);</script>\n";
			exit;
		}

		$total = count ( $cid );
		$cids = implode( ',', $cid );

		$db->setQuery( "UPDATE #__hwdvidsgroups"
						. "\nSET published =" . intval( $publish )
						. "\n WHERE id IN ( $cids )"
						. "\n AND ( checked_out = 0 OR ( checked_out = $my->id ) )"
						);
		if (!$db->query()) {
			echo "<script> alert('".$db->getErrorMsg()."'); window.history.go(-1); </script>\n";
			exit();
		}

		switch ( $publish ) {
			case 1:
				$msg = $total ._HWDVIDS_ALERT_ADMIN_GPUB." ";
				break;

			case 0:
			default:
				$msg = $total ._HWDVIDS_ALERT_ADMIN_GUNPUB." ";
				break;
		}

		if (count( $cid ) == 1) {
			$row = new hwdvids_group( $db );
			$row->checkin( $cid[0] );
		}

		$mainframe->enqueueMessage($msg);
		$mainframe->redirect( JURI::root( true ) . '/administrator/index.php?option='.$option.'&task=groups' );
	}
   /**
	* feature/unfeature groups
	*/
	function featureg($cid=null, $publish=1) {
		global $option, $mainframe;
  		$db =& JFactory::getDBO();
		$my = & JFactory::getUser();

		if (count( $cid ) < 1) {
			$action = $publish == 1 ? 'featureg' : ($publish == -1 ? 'archive' : 'unfeatureg');
			echo "<script> alert('Select an item to $action'); window.history.go(-1);</script>\n";
			exit;
		}

		$total = count ( $cid );
		$cids = implode( ',', $cid );

		$db->setQuery( "UPDATE #__hwdvidsgroups"
						. "\nSET featured =" . intval( $publish )
						. "\n WHERE id IN ( $cids )"
						. "\n AND ( checked_out = 0 OR ( checked_out = $my->id ) )"
						);
		if (!$db->query()) {
			echo "<script> alert('".$db->getErrorMsg()."'); window.history.go(-1); </script>\n";
			exit();
		}

		switch ( $publish ) {
			case 1:
				$msg = $total ._HWDVIDS_ALERT_ADMIN_GFEAT." ";
				break;

			case 0:
			default:
				$msg = $total ._HWDVIDS_ALERT_ADMIN_GUNFEAT." ";
				break;
		}

		if (count( $cid ) == 1) {
			$row = new hwdvids_group( $db );
			$row->checkin( $cid[0] );
		}

		$mainframe->enqueueMessage($msg);
		$mainframe->redirect( JURI::root( true ) . '/administrator/index.php?option='.$option.'&task=groups' );
	}
   /**
	* delete groups
	*/
	function deletegroups($cid)
	{
		global $option, $mainframe;
  		$db =& JFactory::getDBO();
		$my = & JFactory::getUser();

		$total = count( $cid );
		$events = join(",", $cid);

		$db->SetQuery("DELETE FROM #__hwdvidsgroups WHERE id IN ($events)");
		$db->Query();
		if ( !$db->query() ) {
			echo "<script> alert('".$db->getErrorMsg()."'); window.history.go(-1); </script>\n";
			exit();
		}

		$db->SetQuery("DELETE FROM #__hwdvidsgroup_membership WHERE groupid IN ($events)");
		$db->Query();
		if ( !$db->query() ) {
			echo "<script> alert('".$db->getErrorMsg()."'); window.history.go(-1); </script>\n";
			exit();
		}

		$db->SetQuery("DELETE FROM #__hwdvidsgroup_videos WHERE groupid IN ($events)");
		$db->Query();
		if ( !$db->query() ) {
			echo "<script> alert('".$db->getErrorMsg()."'); window.history.go(-1); </script>\n";
			exit();
		}

		$msg = $total ._HWDVIDS_ALERT_ADMIN_GDEL." ";
		$mainframe->enqueueMessage($msg);
		$mainframe->redirect( JURI::root( true ) . '/administrator/index.php?option='.$option.'&task=groups' );
	}
}
?>