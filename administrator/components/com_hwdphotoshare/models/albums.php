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

class hwdps_BE_albums
{
   /**
	* show videos
	*/
	function showAlbums()
	{
		global $option, $mainframe, $limit, $limitstart;
		$db =& JFactory::getDBO();

		$search 		= $mainframe->getUserStateFromRequest( "search{$option}", 'search', '' );
		$search 		= addslashes( trim( strtolower( $search ) ) );

		$category_id = JRequest::getInt( 'category_id', 0, 'post' );

		$db->SetQuery( "SELECT count(*)"
							. "\nFROM #__hwdpsalbums AS a"
							. "\nWHERE a.published 	>= 0"
							);
		$total = $db->loadResult();
		echo $db->getErrorMsg();

		$where = array(
		"a.published 	>= 0",
		);

		$catfilter = "";
		if ($category_id !== 0) {
			$catfilter = "\nAND a.category_id = ".$category_id;
		}

		if ($search) {
			$where[] = "LOWER(a.title) LIKE '%$search%'";
				$db->SetQuery( "SELECT count(*)"
							. "\nFROM #__hwdpsalbums AS a"
							. (count( $where ) ? "\n WHERE " . implode( ' AND ', $where ) : "")
							. $catfilter
							);
				$total = $db->loadResult();
				echo $db->getErrorMsg();
		}

		$pageNav = new JPagination( $total, $limitstart, $limit );

		$query = "SELECT a.*"
				. "\nFROM #__hwdpsalbums AS a"
				. ( count( $where ) ? "\n WHERE " . implode( ' AND ', $where ) : "")
				. $catfilter
				. "\nORDER BY a.date_created DESC"
							;
		$db->SetQuery( $query, $pageNav->limitstart, $pageNav->limit );
		$rows = $db->loadObjectList();

		$query = "SELECT a.*"
				. "\nFROM #__hwdpsphotos AS a"
				. ( count( $where ) ? "\n WHERE " . implode( ' AND ', $where ) : "")
				. $catfilter
			    . "\nAND a.featured = 1"
				. "\nORDER BY a.ordering DESC"
							;
		$db->SetQuery( $query );
		$rows_feat = $db->loadObjectList();

		hwd_ps_HTML::showalbums($rows, $rows_feat, $pageNav, $search, $category_id);
	}
   /**
	* edit videos
	*/
	function editAlbum($cid)
	{
		global $db, $mosConfig_live_site, $mosConfig_absolute_path, $my;
		$db =& JFactory::getDBO();
		$row = new hwdpsalbums( $db );
		$row->load( $cid );

		if ($row->user_id == 0) {
			$usr->username = "Guest";
		} else {
			$db->SetQuery("SELECT username"
								. "\n FROM #__users"
								. "\n WHERE id = $row->user_id");
			$usr = $db->loadObject();
		}

		$db->SetQuery("SELECT *"
					. "\n FROM #__hwdpsphotos"
					. "\n WHERE album_id = $row->id");
		$photos = $db->loadObjectList();

		hwd_ps_HTML::editAlbum($row, $usr, $photos);
	}
   /**
	* save videos
	*/
	function saveAlbum()
	{
		global $mainframe;

		$db =& JFactory::getDBO();
		$row = new hwdpsalbums( $db );

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

		$msg = _HWDPS_ALERT_ASAVED;
		$mainframe->enqueueMessage($msg);
		$mainframe->redirect( JURI::root( true ) . '/administrator/index.php?option=com_hwdphotoshare&task=albums' );
	}
   /**
	* cancel videos
	*/
	function cancelAlbum()
	{
		global $mainframe;
		$db =& JFactory::getDBO();
		$row = new hwdpsalbums( $db );
		$row->bind( $_POST );
		$row->checkin();
		$mainframe->redirect( JURI::root( true ) . '/administrator/index.php?option=com_hwdphotoshare&task=albums' );
	}
   /**
	* publish/unpublish videos
	*/
	function publishAlbum( $cid=null, $publish=1 ) {
		global $mainframe;
		$db =& JFactory::getDBO();
		$my = & JFactory::getUser();

		if (count( $cid ) < 1) {
			$action = $publish == 1 ? 'publish' : ($publish == -1 ? 'archive' : 'unpublish');
			echo "<script> alert('Select an item to $action'); window.history.go(-1);</script>\n";
			exit;
		}

		$total = count ( $cid );
		$cids = implode( ',', $cid );

		$db->setQuery( "UPDATE #__hwdpsalbums"
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
				$msg = $total ._HWDPS_ALERT_ADMIN_APUB." ";
				break;

			case 0:
			default:
				$msg = $total ._HWDPS_ALERT_ADMIN_AUNPUB." ";
				break;
		}

		if (count( $cid ) == 1) {
			$row = new hwdpsalbums( $db );
			$row->checkin( $cid[0] );
		}

		$mainframe->enqueueMessage($msg);
		$mainframe->redirect( JURI::root( true ) . '/administrator/index.php?option=com_hwdphotoshare&task=albums' );
	}
   /**
	* feature/unfeature videos
	*/
	function featureAlbum( $cid=null, $publish=1 ) {
		global $mainframe;
		$db =& JFactory::getDBO();
		$my = & JFactory::getUser();

		if (count( $cid ) < 1) {
			$action = $publish == 1 ? 'feature' : ($publish == -1 ? 'archive' : 'unfeature');
			echo "<script> alert('Select an item to $action'); window.history.go(-1);</script>\n";
			exit;
		}

		$total = count ( $cid );
		$cids = implode( ',', $cid );

		$db->setQuery( "UPDATE #__hwdpsalbums"
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
				$msg = $total ._HWDPS_ALERT_ADMIN_AFEAT." ";
				break;

			case 0:
			default:
				$msg = $total ._HWDPS_ALERT_ADMIN_AUNFEAT." ";
				break;
		}


		// update all non featured videos to ordering zero
		$db->setQuery( "UPDATE #__hwdpsalbums"
						. "\n SET ordering = 0"
						. "\n WHERE featured = 0"
						);
		if (!$db->query()) {
		echo "<script> alert('".$db->getErrorMsg()."'); window.history.go(-1); </script>\n";
		exit();
		}
		// get the maximum ordering value
		$db->setQuery( "SELECT MAX(ordering) FROM #__hwdpsalbums"
						. "\n WHERE featured = 1"
						);
		$maxorder = $db->loadResult();

		// get all featured videos
		$db->setQuery( "SELECT * FROM #__hwdpsalbums"
						. "\n WHERE id IN ( $cids )"
						. "\n AND ordering = 0"
						);
		$rows = $db->loadObjectList();
		// reorder all featured videos that are set to zero order
		$neworder=$maxorder+1;
		for($i=0, $n=count( $rows ); $i < $n; $i++) {
		$row = $rows[$i];

			$db->setQuery( "UPDATE #__hwdpsalbums"
							. "\n SET ordering =" . $neworder
							. "\n WHERE id =" . $row->id
							);
			if (!$db->query()) {
			echo "<script> alert('".$db->getErrorMsg()."'); window.history.go(-1); </script>\n";
			exit();
			}

		$neworder++;
		}


		if (count( $cid ) == 1) {
			$row = new hwdpsalbums( $db );
			$row->checkin( $cid[0] );
		}

		$mainframe->enqueueMessage($msg);
		$mainframe->redirect( JURI::root( true ) . '/administrator/index.php?option=com_hwdphotoshare&task=albums' );
	}
   /**
	* delete videos
	*/
	function deleteAlbum($cid)
	{
		global $mainframe;
		$db =& JFactory::getDBO();
		$my = & JFactory::getUser();

		$total = count( $cid );
		$events = join(",", $cid);

		for ($i=0, $n=count($cid); $i < $n; $i++) {

			$aid = $cid[$i];

			$query = ' SELECT * FROM #__hwdpsphotos WHERE album_id = '.$aid;
			$db->SetQuery($query);
			$rows = $db->loadObjectList();

			for ($i=0, $n=count($rows); $i < $n; $i++) {
				$row = $rows[$i];
				hwd_ps_tools::deletePhotoFiles($row);
			}

			$db->SetQuery("DELETE FROM #__hwdpsalbums WHERE id = $aid AND user_id = $my->id");
			$db->Query();
			if ( !$db->query() ) {
			  echo "<script> alert('".$db->getErrorMsg()."'); window.history.go(-1); </script>\n";
			  exit();
			}

			$db->SetQuery("DELETE FROM #__hwdpsphotos WHERE album_id = $aid");
			$db->Query();
			if ( !$db->query() ) {
			  echo "<script> alert('".$db->getErrorMsg()."'); window.history.go(-1); </script>\n";
			  exit();
			}

		}

		$msg = $total ._HWDPS_ALERT_ADMIN_ADEL." ";
		$mainframe->enqueueMessage($msg);
		$mainframe->redirect( JURI::root( true ) . '/administrator/index.php?option=com_hwdphotoshare&task=albums' );
	}
function orderForum($uid, $inc)
{
    global $db;
    $row = new hwdps_video($db);
    $row->load($uid);

    //echo "uid".$uid."inc".$inc;
    //exit;

    $row->move($inc,"featured=1");
    mosRedirect ("index.php?option=com_hwdphotoshare&task=videos");
}
   /**
	* Convert seconds to HOURS:MINUTES:SECONDS format
	**/
	function sec2hms ($sec, $padHours = false)
	{

    // holds formatted string
    $hms = "";

    // there are 3600 seconds in an hour, so if we
    // divide total seconds by 3600 and throw away
    // the remainder, we've got the number of hours
    $hours = intval(intval($sec) / 3600);

    // add to $hms, with a leading 0 if asked for
    $hms .= ($padHours)
          ? str_pad($hours, 2, "0", STR_PAD_LEFT). ':'
          : $hours. ':';

    // dividing the total seconds by 60 will give us
    // the number of minutes, but we're interested in
    // minutes past the hour: to get that, we need to
    // divide by 60 again and keep the remainder
    $minutes = intval(($sec / 60) % 60);

    // then add to $hms (with a leading 0 if needed)
    $hms .= str_pad($minutes, 2, "0", STR_PAD_LEFT). ':';

    // seconds are simple - just divide the total
    // seconds by 60 and keep the remainder
    $seconds = intval($sec % 60);

    // add to $hms, again with a leading 0 if needed
    $hms .= str_pad($seconds, 2, "0", STR_PAD_LEFT);

    // done!
    return $hms;
	}

	function createThumbs( $pathToImages, $pathToThumbs, $thumbWidth )
	{
		  // echo "Creating thumbnail for $pathToImages <br />";

		  // load image and get image size
		  $img = imagecreatefromjpeg( $pathToImages );
		  $width = imagesx( $img );
		  $height = imagesy( $img );

		  // calculate thumbnail size
		  $new_width = $thumbWidth;
		  $new_height = floor( $height * ( $thumbWidth / $width ) );

		  // create a new temporary image
		  $tmp_img = imagecreatetruecolor( $new_width, $new_height );

		  // copy and resize old image into new image
		  imagecopyresized( $tmp_img, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height );

		  // save thumbnail into a file
		  imagejpeg( $tmp_img, $pathToThumbs );


	}
   /**
	* edit videos
	*/
	function changeAlbumUserSelect($cid)
	{
		global $mosConfig_live_site, $mainframe, $mainframe;
  		$db =& JFactory::getDBO();

		$row = new hwdpsalbums( $db );
		$row->load( $cid );

		$users = array();
		$users[] = JHTML::_('select.option', '0', 'Guest');
		$db->setQuery( "SELECT id AS value, username AS text FROM #__users" );
		$users = array_merge( $users, $db->loadObjectList() );
		$selected = $row->user_id;

		$uploader_list = JHTML::_('select.genericlist', $users, 'user_id', 'class="inputbox"', 'value', 'text', $selected);

		echo $uploader_list;exit;

	}
}
?>