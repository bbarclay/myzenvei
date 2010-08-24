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

class hwdps_BE_flagged
{
   /**
	* show flagged media
	*/
	function showflagged()
	{
		global $database, $mainframe, $limit, $limitstart;

//		$query = "SELECT a.*, u.*"
//				. "\nFROM #__hwdpsphotos AS u"
//				. "\n LEFT JOIN #__hwdpsflagged_photos AS a ON u.id = a.videoid"
//				. "\nWHERE a.status = \"UNREAD\""
//				. "\nORDER BY a.date"
//							;
//		$database->SetQuery( $query );
//		$rowsfv = $database->loadObjectList();
//
//		$query = "SELECT a.*, u.*"
//				. "\nFROM #__hwdpsgroups AS u"
//				. "\n LEFT JOIN #__hwdpsflagged_groups AS a ON u.id = a.groupid"
//				. "\nWHERE a.status = \"UNREAD\""
//				. "\nORDER BY a.date"
//							;
//		$database->SetQuery( $query );
//		$rowsfg = $database->loadObjectList();
//
		hwd_ps_HTML::showflagged($rowsfv, $rowsfg);
	}
   /**
	* delete flagged videos
	*/
	function deleteflaggedvid( $cid=null ) {
		global $database, $task, $my, $option;

		$total = count ( $cid );
		$cids = implode( ',', $cid );

		//Get VideoID
		$query = 'SELECT videoid'
					. ' FROM #__hwdpsflagged_photos'
					. ' WHERE videoid = '.$cids
					;
		$database->SetQuery( $query );
		$database->loadObject( $videoid );

		$database->SetQuery("DELETE FROM #__hwdpsflagged_photos WHERE videoid = $videoid->videoid");
		$database->Query();
		if ( !$database->query() ) {
			echo "<script> alert('".$database->getErrorMsg()."'); window.history.go(-1); </script>\n";
			exit();
		}

		$database->SetQuery("UPDATE #__hwdpsphotos SET approved = 'deleted', published = 0, featured = 0 WHERE id = $videoid->videoid");
		$database->Query();
		if ( !$database->query() ) {
			echo "<script> alert('".$database->getErrorMsg()."'); window.history.go(-1); </script>\n";
			exit();
		}

		$database->SetQuery("DELETE FROM #__hwdpsfavorites WHERE videoid = $videoid->videoid");
		$database->Query();
		if ( !$database->query() ) {
			echo "<script> alert('".$database->getErrorMsg()."'); window.history.go(-1); </script>\n";
			exit();
		}

		$database->SetQuery("DELETE FROM #__hwdpsgroup_photos WHERE videoid = $videoid->videoid");
		$database->Query();
		if ( !$database->query() ) {
			echo "<script> alert('".$database->getErrorMsg()."'); window.history.go(-1); </script>\n";
			exit();
		}

		$database->SetQuery("DELETE FROM #__hwdpsrating WHERE videoid = $videoid->videoid");
		$database->Query();
		if ( !$database->query() ) {
			echo "<script> alert('".$database->getErrorMsg()."'); window.history.go(-1); </script>\n";
			exit();
		}

		$msg = $total ._HWDPS_ALERT_ADMIN_FLAGMDEL." ";
		mosRedirect( 'index.php?option='.$option.'&task=reported&mosmsg='. $msg );

	}
   /**
	* delete flagged groups
	*/
	function deleteflaggedgroup( $cid=null ) {
		global $database, $task, $my, $option;

		$total = count ( $cid );
		$cids = implode( ',', $cid );

		//Get CommentID
		$query = 'SELECT groupid'
					. ' FROM #__hwdpsflagged_groups'
					. ' WHERE groupid = '.$cids
					;
		$database->SetQuery( $query );
		$database->loadObject( $groupid );

		$database->SetQuery("DELETE FROM #__hwdpsflagged_groups WHERE groupid = $groupid->groupid");
		$database->Query();
		if ( !$database->query() ) {
			echo "<script> alert('".$database->getErrorMsg()."'); window.history.go(-1); </script>\n";
			exit();
		}

		$database->SetQuery("DELETE FROM #__hwdpsgroups WHERE id = $groupid->groupid");
		$database->Query();
		if ( !$database->query() ) {
			echo "<script> alert('".$database->getErrorMsg()."'); window.history.go(-1); </script>\n";
			exit();
		}

		$database->SetQuery("DELETE FROM #__hwdpsgroup_membership WHERE id = $groupid->groupid");
		$database->Query();
		if ( !$database->query() ) {
			echo "<script> alert('".$database->getErrorMsg()."'); window.history.go(-1); </script>\n";
			exit();
		}

		$database->SetQuery("DELETE FROM #__hwdpsgroup_photos WHERE id = $groupid->groupid");
		$database->Query();
		if ( !$database->query() ) {
			echo "<script> alert('".$database->getErrorMsg()."'); window.history.go(-1); </script>\n";
			exit();
		}

		$msg = $total ._HWDPS_ALERT_ADMIN_FLAGMDEL." ";
		mosRedirect( 'index.php?option='.$option.'&task=reported&mosmsg='. $msg );
	}
   /**
	* ignore flagged videos
	*/
	function readflaggedvid( $cid=null ) {
		global $database, $task, $my, $option;

		$total = count ( $cid );
		$cids = implode( ',', $cid );

		$database->SetQuery("UPDATE #__hwdpsflagged_photos SET status = 'READ' WHERE videoid IN ( $cids )");
		$database->Query();
		if ( !$database->query() ) {
			echo "<script> alert('".$database->getErrorMsg()."'); window.history.go(-1); </script>\n";
			exit();
		}

		$msg = $total ._HWDPS_ALERT_ADMIN_FLAGMREAD." ";
		mosRedirect( 'index.php?option='.$option.'&task=reported&mosmsg='. $msg );
	}
   /**
	* ignore flagged groups
	*/
	function readflaggedgroup( $cid=null ) {
		global $database, $task, $my, $option;

		$total = count ( $cid );
		$cids = implode( ',', $cid );

		$database->SetQuery("UPDATE #__hwdpsflagged_groups SET status = 'READ' WHERE groupid IN ( $cids )");
		$database->Query();
		if ( !$database->query() ) {
			echo "<script> alert('".$database->getErrorMsg()."'); window.history.go(-1); </script>\n";
			exit();
		}

		$msg = $total ._HWDPS_ALERT_ADMIN_FLAGMREAD." ";
		mosRedirect( 'index.php?option='.$option.'&task=reported&mosmsg='. $msg );
	}
   /**
	* watch flagged videos
	*/
	function watchflaggedvideo()
	{
		hwd_ps_HTML::watchflaggedvideo();
	}
}
?>