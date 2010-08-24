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

class hwd_ps_photos
{
   /**
    * Save editted video details
    */
	function savePhoto()
	{
		global $mainframe, $my, $Itemid, $mainframe;
  		$db =& JFactory::getDBO();
		$my = & JFactory::getUser();

		$pid         = JRequest::getInt( 'pid', 0 );
		$setascover  = JRequest::getInt( 'setascover', 0 );
		$deletephoto = JRequest::getInt( 'deletephoto', 0 );
		$url         = Jrequest::getVar( 'url', '' );

		$row = new hwdpsphotos($db);
		$row->load( $pid );

		if ($row->user_id != $my->id) {
			$msg = _HWDPS_ALERT_NOPERM;
			$mainframe->enqueueMessage($msg);
			$mainframe->redirect( JURI::root( true ) . "/index.php?option=com_hwdphotoshare&task=editalbum&album_id=".$row->album_id );
		}

		$_POST['title'] 			= Jrequest::getVar( 'title', '' );
		$_POST['caption'] 			= Jrequest::getVar( 'caption', '' );
		$_POST['tags'] 				= Jrequest::getVar( 'tags', '' );
		$_POST['album_id'] 			= JRequest::getInt( 'album_id', 0 );

		if ($_POST['album_id'] !== $row->album_id) {

			$base_original = JPATH_SITE.DS.'hwdphotos'.DS.'uploads'.DS.$my->id.DS.$row->album_id.DS;
			$base_updated  = JPATH_SITE.DS.'hwdphotos'.DS.'uploads'.DS.$my->id.DS.intval($_POST['album_id']).DS;

			$file_original = $base_original.$row->photo_id.'.'.$row->original_type;
			$file_updated  = $base_updated.$row->photo_id.'.'.$row->original_type;

			JFolder::create($base_updated);
			$mode = 0755;
			if (!is_writable($base_updated)) { JPath::setPermissions($base_updated, $mode); }
			$mode = 0777;
			if (!is_writable($base_updated)) { JPath::setPermissions($base_updated, $mode); }

			if (!file_exists($file_updated)) {
				if (rename($file_original, $file_updated)) {
					$_POST['album_id'] = JRequest::getInt( 'album_id', 0 );
				} else {
					$_POST['album_id'] = $row->album_id;
					$mainframe->enqueueMessage("Could not move to new album.");
				}
			}

		}

		if ($setascover == "1") {
			hwd_ps_photos::removeSetCover($row->album_id);
			$_POST['setcover'] = 1;
		}

		if ($deletephoto == "1") {
			hwd_ps_photos::deletePhoto($pid, $row, $url);
		} else {
			// bind it to the table
			if (!$row->bind($_POST)) {
				echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n";
				exit();
			}

			// Make sure the record is valid
			if (!$row->check()) {
				$this->setError($this->_db->getErrorMsg());
				echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n";
				exit();
			}

			// store it in the db
			if (!$row->store()) {
				echo "<script> alert('".$row -> getError()."'); window.history.go(-1); </script>\n";
				exit();
			}

			$row->checkin();

		}
		$msg = _HWDPS_ALERT_PHOTOUPDT;
		$mainframe->enqueueMessage($msg);
		$mainframe->redirect( JURI::root( true ) . "/index.php?option=com_hwdphotoshare&task=editalbum&album_id=".$row->album_id );

	}
   /**
	* Delete videos
	*/
	function photos()
	{
		global $database, $mainframe, $limitstart, $my, $mosConfig_live_site, $mosConfig_allowUserRegistration, $acl;
		$c = hwd_ps_Config::get_instance();

		$my = & JFactory::getUser();
  		$db =& JFactory::getDBO();


		$limit 	= intval($c->ppp);

		$where = ' WHERE published = 1';
		$where .= ' AND approved = "yes"';
		if (!$my->id) {
		$where .= ' AND privacy = "public"';
		}

$sort = JRequest::getWord( 'sort' );
// switch for task function
switch ($sort)
{
	/** upload functions */
	case 'featured':
		$order = ' ORDER BY date_uploaded DESC';
		break;

	case 'recent':
		$order = ' ORDER BY date_uploaded DESC';
		break;

	case 'updated':
		$order = ' ORDER BY date_uploaded DESC';
		break;

	case 'biggest':
		$order = ' ORDER BY date_uploaded DESC';
		break;

	default:
		$order = ' ORDER BY date_uploaded DESC';
		break;
}

		$db->SetQuery( 'SELECT count(*)'
							. ' FROM #__hwdpsphotos'
							. $where
							);
  		$total = $db->loadResult();
		echo $db->getErrorMsg();

		$pageNav = new JPagination( $total, $limitstart, $limit );

		//Groups that are published
		$query = 'SELECT *'
				. ' FROM #__hwdpsphotos'
				. $where
				. $order
				;

		$db->SetQuery($query, $pageNav->limitstart, $pageNav->limit);
		$rows = $db->loadObjectList();

		hwd_ps_html::photos($rows, $pageNav, $total, $sort);
	}
   /**
	* Delete videos
	*/
	function removeSetCover($album_id)
	{
		global $database, $my, $Itemid, $mosConfig_live_site;
  		$db =& JFactory::getDBO();

		$album_id = (int)$album_id;

		// update category
		$db->SetQuery("UPDATE #__hwdpsphotos SET setcover = 0 WHERE album_id = $album_id");
		$db->Query();
		if ( !$db->query() ) {
			echo "<script> alert('".$db->getErrorMsg()."'); window.history.go(-1); </script>\n";
			exit();
		}
		return true;
	}
   /**
	* Delete videos
	*/
	function deletePhoto($pid, $row, $url)
	{
		global $mainframe, $my, $Itemid, $mosConfig_live_site;
  		$db =& JFactory::getDBO();
		$my = & JFactory::getUser();

		//check valid user
		if ($row->user_id != $my->id) {
			$msg = _HWDPS_ALERT_NOPERM;
			$mainframe->enqueueMessage($msg);
			$mainframe->redirect( JURI::root( true ) . "/index.php?option=com_hwdphotoshare&Itemid=".$Itemid );
		}

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

		$msg = _HWDPS_ALERT_PDEL;
		$mainframe->enqueueMessage($msg);
		$mainframe->redirect( JURI::root( true ) . "/index.php?option=com_hwdphotoshare&task=editalbum&album_id=".$row->album_id );
	}
   /**
	* Delete videos
	*/
	function viewPhoto()
	{
		global $database, $mainframe, $mosConfig_live_site, $limitstart, $my, $Itemid, $hwdps_joinp, $hwdps_selectp;
		$c = hwd_ps_Config::get_instance();
  		$db =& JFactory::getDBO();

		$photo_id = JRequest::getInt( 'photo_id', 0 );
		$album_id = JRequest::getInt( 'album_id', 0 );

		$limit 	= intval(1);

		$where = ' WHERE published = 1';
		$where .= ' AND album_id = '.$album_id;
		$where .= ' AND approved = "yes"';

		$db->SetQuery( 'SELECT count(*)'
							. ' FROM #__hwdpsphotos'
							. $where
							. ' ORDER BY ordering ASC'

							);
  		$total = $db->loadResult();
		echo $db->getErrorMsg();

		$where = ' WHERE photo.published = 1';
		$where .= ' AND photo.album_id = '.$album_id;
		$where .= ' AND photo.approved = "yes"';

		$pageNav = new hwdpsPageNav( $total, $limitstart, $limit );

		//Videos that are approved(converted) and published in this group
		$query = 'SELECT'.$hwdps_selectp
				. ' FROM #__hwdpsphotos AS photo'
				. $hwdps_joinp
				. $where
				. ' ORDER BY photo.ordering ASC'
				;

		$db->SetQuery($query, $pageNav->limitstart, $pageNav->limit);
		$row = $db->loadObjectList();
		echo $db->getErrorMsg();

		//Videos that are approved(converted) and published in this group
		$query = 'SELECT *'
				. ' FROM #__hwdpsalbums'
				. ' WHERE id = '.$album_id;
				;

		$db->SetQuery($query);
		$album_details = $db->loadObject();
		echo $db->getErrorMsg();

		if (empty($album_details->id)) {$album_details->id=null;}
		if (empty($album_details->user_id)) {$album_details->user_id=null;}
		if (empty($album_details->title)) {$album_details->title=null;}
		if (empty($album_details->description )) {$album_details->description =null;}

		if (count($row) == 0) {

			include_once(JPATH_SITE.DS.'administrator'.DS.'components'.DS.'com_hwdphotoshare'.DS.'libraries'.DS.'maintenance_fixerrors.class.php');
			hwd_ps_fixerrors::reorderAlbums($album_id);

			$msg = "There was a problem displaying this photo. Please try again.";
			$mainframe->enqueueMessage($msg);
			$mainframe->redirect( JURI::root( true ) . '/index.php?option=com_hwdphotoshare&task=viewalbum&album_id='.$album_id.'&Itemid='.$Itemid );

		}

		hwd_ps_html::viewPhoto($row, $pageNav, $total, $album_details);
	}
    function addPhotos()
	{
		global $database, $mainframe, $Itemid, $my;
		$c = hwd_ps_Config::get_instance();
  		$db =& JFactory::getDBO();
		$my = & JFactory::getUser();
		$album_id = JRequest::getInt( 'album_id', 0, 'request' );
		$category_id = JRequest::getInt( 'category_id', 0, 'request' );

		if (!hwd_ps_access::checkAccess($c->gtree_upld, $c->gtree_upld_child, 4, 0, _HWDPS_TITLE_NOACCESS, _HWDPS_ALERT_REGISTERFORUPLD, _HWDPS_ALERT_UPLD_NOT_AUTHORIZED, 'exclamation.png', 0)) {return;}

		if ($album_id > 0) {

			$row = new hwdpsalbums($db);
			$row->load( $album_id );
			$category_id = $row->category_id;

			if ($row->user_id != $my->id) {
				$msg = _HWDPS_ALERT_NOPERM;
				$mainframe->enqueueMessage($msg);
				$mainframe->redirect( JURI::root( true ) . '/index.php?option=com_hwdphotoshare&Itemid='.$Itemid );
			}

		} else {

          	if ($c->upld_cats == 0) {
				hwd_ps_tools::infomessage(4, 0, _HWDPS_TITLE_NOACCESS, _HWDPS_ALERT_UPLD_NOT_AUTHORIZED, "exclamation.png", 0);
				return;
			}

			$row->title = "Upload direct to category";
			$row->description = "Upload direct to category";
			$row->category_id = "Upload direct to category";
			$row->tags = "Upload direct to category";
			$row->location = "Upload direct to category";
			$row->id = "Upload direct to category";
			$row->user_id = "Upload direct to category";
			$row->privacy = "";
			$row->allow_comments = "";
			$row->allow_ratings = "";

		}

		hwd_ps_html::addPhotos($album_id, $category_id, $row);
  	}
    /**
     * Query SQL for all accessible category data
     *
     * @param string $option  the joomla component name
     * @return       Nothing
     */
    function downloadFile()
    {
        global $mainframe, $limitstart;
		$c = hwd_ps_Config::get_instance();
		$db = & JFactory::getDBO();
		$my = & JFactory::getUser();
		$acl= & JFactory::getACL();
		$usersConfig = &JComponentHelper::getParams( 'com_users' );

		$evp = JRequest::getCmd( 'evp', 0 );
		$file = JRequest::getCmd( 'file', 0 );
		$deliver = JRequest::getCmd( 'deliver', 0 );
		$media = JRequest::getCmd( 'media', 0 );
		$fix = JRequest::getCmd( 'fix', 0 );

		// get video details
		$db->SetQuery('SELECT *'
					. ' FROM #__hwdpsphotos'
					. ' WHERE id = '.(int)$file);
		$db->Query();
		$row = $db->loadObject();

		$BASEPATH = JPATH_SITE."/hwdphotos"; 		// Set this to the absolute path to your protected media files. No trailing slash!

		if ($row->photo_type == "local") {

			$path = "$BASEPATH/originals/".$row->user_id."/".$row->photo_id.".".$row->original_type;
			$url = JURI::root()."hwdphotos/originals/".$row->user_id."/".$row->photo_id.".".$row->original_type;

		}

		// Headers already sent -- temporary solution
		if (headers_sent($filename, $linenum)) {

			$mainframe->redirect( $url );
			exit;

		} else {

			$title = str_replace(" ", "-", $row->title);
			$title = preg_replace("/[^a-zA-Z0-9s-]/", "", $title);

			if (!empty($title)) {
				$ftitle = $title.".".$row->original_type;
			} else {
				$ftitle = "Photo_".$row->photo_id.".".$row->original_type;
			}

			header('Content-Type: application/octet-stream');
			header("Content-Disposition: attachment; filename=\"$ftitle\"");
			header('Content-Length: '.filesize($path));
			hwd_ps_tools::readfile_chunked($path, true);
			exit;

		}
	}
}
?>