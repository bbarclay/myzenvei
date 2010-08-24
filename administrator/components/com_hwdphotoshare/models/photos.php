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

class hwdps_BE_photos
{
   /**
	* show videos
	*/
	function showPhotos()
	{
		global $option, $mainframe, $limit, $limitstart;
		$db =& JFactory::getDBO();

		$search 		= $mainframe->getUserStateFromRequest( "search{$option}", 'search', '' );
		$search 		= addslashes( trim( strtolower( $search ) ) );

		$category_id = JRequest::getInt( 'category_id', 0 );

		$db->SetQuery( "SELECT count(*)"
							. "\nFROM #__hwdpsphotos AS a"
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
							. "\nFROM #__hwdpsphotos AS a"
							. (count( $where ) ? "\n WHERE " . implode( ' AND ', $where ) : "")
							. $catfilter
							);
				$total = $db->loadResult();
				echo $db->getErrorMsg();
		}

		$pageNav = new JPagination( $total, $limitstart, $limit );

		$query = "SELECT a.*"
				. "\nFROM #__hwdpsphotos AS a"
				. ( count( $where ) ? "\n WHERE " . implode( ' AND ', $where ) : "")
				. $catfilter
				. "\nORDER BY a.date_uploaded DESC"
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

		hwd_ps_HTML::showphotos($rows, $rows_feat, $pageNav, $search, $category_id);
	}
   /**
	* edit videos
	*/
	function editPhoto($cid)
	{
		global $db, $mosConfig_live_site, $mosConfig_absolute_path, $my;
		$db =& JFactory::getDBO();

		$row = new hwdpsphotos( $db );
		$row->load( $cid );

		if ($row->user_id == 0) {
			$usr->username = "Guest";
		} else {
			$db->SetQuery("SELECT username"
								. "\n FROM #__users"
								. "\n WHERE id = $row->user_id");
			$usr = $db->loadObject();
		}

		$db->SetQuery( "SELECT count(*)"
							. "\nFROM #__hwdpsfavorites"
							. "\nWHERE photoid = $cid"
							);
		$favs = $db->loadResult();
		echo $db->getErrorMsg();
		if (empty($favs)) {$favs = 0;}


		hwd_ps_HTML::editPhoto($row, $usr, $favs);
	}
   /**
	* save videos
	*/
	function savePhoto()
	{
		global $mainframe;

		$db =& JFactory::getDBO();
		$row = new hwdpsphotos( $db );

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

		$msg = _HWDPS_ALERT_PSAVED;
		$mainframe->enqueueMessage($msg);
		$mainframe->redirect( JURI::root( true ) . '/administrator/index.php?option=com_hwdphotoshare&task=photos' );
	}
   /**
	* cancel videos
	*/
	function cancelPhoto()
	{
		global $mainframe;
		$mainframe->redirect( JURI::root( true ) . '/administrator/index.php?option=com_hwdphotoshare&task=photos' );
	}
   /**
	* publish/unpublish videos
	*/
	function publishPhoto( $cid=null, $publish=1 ) {
		global $task, $mainframe;
  		$db =& JFactory::getDBO();
		$my = &JFactory::getUser();

		if (count( $cid ) < 1) {
			$action = $publish == 1 ? 'publish' : ($publish == -1 ? 'archive' : 'unpublish');
			echo "<script> alert('Select an item to $action'); window.history.go(-1);</script>\n";
			exit;
		}

		$total = count ( $cid );
		$cids = implode( ',', $cid );

		$db->setQuery( "UPDATE #__hwdpsphotos"
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
				$msg = $total ._HWDPS_ALERT_ADMIN_PPUB." ";
				break;

			case 0:
			default:
				$msg = $total ._HWDPS_ALERT_ADMIN_PUNPUB." ";
				break;
		}

		if (count( $cid ) == 1) {
			$row = new hwdpsphotos( $db );
			$row->checkin( $cid[0] );
		}

		$mainframe->enqueueMessage($msg);
		$mainframe->redirect( JURI::root( true ) . '/administrator/index.php?option=com_hwdphotoshare&task=photos' );


	}
   /**
	* feature/unfeature videos
	*/
	function featurePhoto( $cid=null, $publish=1 ) {
		global $task, $mainframe;
  		$db =& JFactory::getDBO();
		$my = &JFactory::getUser();

		if (count( $cid ) < 1) {
			$action = $publish == 1 ? 'feature' : ($publish == -1 ? 'archive' : 'unfeature');
			echo "<script> alert('Select an item to $action'); window.history.go(-1);</script>\n";
			exit;
		}

		$total = count ( $cid );
		$cids = implode( ',', $cid );

		$db->setQuery( "UPDATE #__hwdpsphotos"
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
				$msg = $total ._HWDPS_ALERT_ADMIN_PFEAT." ";
				break;

			case 0:
			default:
				$msg = $total ._HWDPS_ALERT_ADMIN_PUNFEAT." ";
				break;
		}


		// update all non featured videos to ordering zero
		$db->setQuery( "UPDATE #__hwdpsphotos"
						. "\n SET ordering = 0"
						. "\n WHERE featured = 0"
						);
		if (!$db->query()) {
		echo "<script> alert('".$db->getErrorMsg()."'); window.history.go(-1); </script>\n";
		exit();
		}
		// get the maximum ordering value
		$db->setQuery( "SELECT MAX(ordering) FROM #__hwdpsphotos"
						. "\n WHERE featured = 1"
						);
		$maxorder = $db->loadResult();

		// get all featured videos
		$db->setQuery( "SELECT * FROM #__hwdpsphotos"
						. "\n WHERE id IN ( $cids )"
						. "\n AND ordering = 0"
						);
		$rows = $db->loadObjectList();
		// reorder all featured videos that are set to zero order
		$neworder=$maxorder+1;
		for($i=0, $n=count( $rows ); $i < $n; $i++) {
		$row = $rows[$i];

			$db->setQuery( "UPDATE #__hwdpsphotos"
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
			$row = new hwdpsphotos( $db );
			$row->checkin( $cid[0] );
		}

		$mainframe->enqueueMessage($msg);
		$mainframe->redirect( JURI::root( true ) . '/administrator/index.php?option=com_hwdphotoshare&task=photos' );
	}
   /**
	* delete videos
	*/
	function deletePhoto($cid)
	{
		global $mainframe;
		$db =& JFactory::getDBO();

		$total = count( $cid );

		for ($i=0, $n=count($cid); $i < $n; $i++) {
			$id = $cid[$i];

    		$row = new hwdpsphotos($db);
    		$row->load($id);

			hwd_ps_tools::deletePhotoFiles($row);

			// permenantly delete
			$db->SetQuery("DELETE FROM #__hwdpsphotos WHERE id = ".$row->id);
			$db->Query();
			if ( !$db->query() ) {
				echo "<script> alert('".$db->getErrorMsg()."'); window.history.go(-1); </script>\n";
				exit();
			}

			require_once(JPATH_SITE.DS.'administrator'.DS.'components'.DS.'com_hwdphotoshare'.DS.'libraries'.DS.'maintenance_recount.class.php');
			hwd_ps_recount::recountPhotosInAlbum($row->album_id);
			hwd_ps_tools::reorganiseAlbum($row->album_id);
			hwd_ps_tools::setAlbumModifiedDate($row->album_id);

		}

		$msg = $total ._HWDPS_ALERT_ADMIN_PDEL." ";
		$mainframe->enqueueMessage($msg);
		$mainframe->redirect( JURI::root( true ) . '/administrator/index.php?option=com_hwdphotoshare&task=photos' );

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
	function changePhotoUserSelect($cid)
	{
		global $mosConfig_live_site, $mainframe, $mainframe;
  		$db =& JFactory::getDBO();

		$row = new hwdpsphotos( $db );
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