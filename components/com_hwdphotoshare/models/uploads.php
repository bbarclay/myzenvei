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
class hwd_ps_uploads
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
    function uploadConfirmPhp()
	{
	global $database, $my, $acl, $mainframe, $mosConfig_mailfrom, $mosConfig_fromname, $mosConfig_live_site, $Itemid, $option, $mosConfig_sitename;
	$c = hwd_ps_Config::get_instance();

		$album_id = JRequest::getInt( 'album_id', 0, 'request' );
		$category_id = JRequest::getInt( 'category_id', 0, 'request' );

		$upload_max = ereg_replace("[^0-9]", "", ini_get("upload_max_filesize") );
		$post_max = ereg_replace("[^0-9]", "", ini_get("post_max_size") );
		if (empty($upload_max)) { $upload_max=2; }
		if (empty($post_max)) { $post_max=2; }

		$sizelimit = min($upload_max, $post_max);

		for ($i=0, $n=10; $i < $n; $i++) {
			$file_param_name = 'upfile_'.$i;
			$report = hwd_ps_uploads::uploadAndProcessPhoto($file_param_name, $album_id, $category_id, '', $sizelimit, 'jpg,gif,png,jpeg,JPG,GIF,PNG,JPEG', 0);

			if ($report[0] == "2") {
				$mainframe->enqueueMessage($report[1]);
			} else if ($report[0] == "1") {
				$mainframe->enqueueMessage($report[1]);
			}
		}

		$mainframe->redirect( JURI::root( true ) . "/index.php?option=com_hwdphotoshare&task=editalbum&Itemid=".$Itemid."&album_id=".$album_id );
		return;
	}
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
    function jumpUpload()
	{
		global $mainframe;;
		$c = hwd_ps_Config::get_instance();

			$album_id = JRequest::getInt( 'album_id', 0 );
			$category_id = JRequest::getInt( 'category_id', 0, 'request' );

			$upload_max = ereg_replace("[^0-9]", "", ini_get("upload_max_filesize") );
			$post_max = ereg_replace("[^0-9]", "", ini_get("post_max_size") );
			if (empty($upload_max)) { $upload_max=2; }
			if (empty($post_max)) { $post_max=2; }

			$sizelimit = min($upload_max, $post_max);

			$file_param_name = 'file';
    		$report = hwd_ps_uploads::uploadAndProcessPhoto($file_param_name, $album_id, $category_id, '', $sizelimit, 'jpg,gif,png,jpeg,JPG,GIF,PNG,JPEG', 0);

			if ($report[0] == "2") {
				$mainframe->enqueueMessage($report[1]);
			} else if ($report[0] == "1") {
				$mainframe->enqueueMessage($report[1]);
			}
	}

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
    function uploadAndProcessPhoto($input_name, $album_id, $category_id, $file_name, $sizelimit=2, $allowed_formats='', $overwrite=0)
	{
		global $mainframe, $my, $mosConfig_live_site, $mosConfig_allowUserRegistration, $Itemid, $acl;
		$c = hwd_ps_Config::get_instance();
  		$db =& JFactory::getDBO();
		$my = & JFactory::getUser();

		// increase memory-limit if possible, GD needs this for large images
		@ini_set('memory_limit', '128M');

		if (!isset($album_id)) {
			hwd_ps_tools::infomessage(4, 0, _HWDPS_TITLE_UPLDFAIL, _HWDPS_ERROR_UPLDERR00, "exclamation.png", 0);
			return;
		}

		if (!isset($_FILES[$input_name]['name'])) {
        	$report[0] = "0";
        	$report[1] = _HWDPS_PHPUPLD_ERR00;
			return $report;
		}

		$report = array();
		$arr_format = array();

		$file_name_tmp       = $_FILES[$input_name]['tmp_name'];
		$file_name_org       = $_FILES[$input_name]['name'];
		$file_size           = $_FILES[$input_name]['size'];
		$file_size_limit     = $sizelimit*1024*1024; //size limit in mb
		$file_ext[0]         = substr($file_name_org, strrpos($file_name_org, '.') + 1);
		$file_ext[0]         = preg_replace("/[^a-zA-Z0-9s]/", "", $file_ext[0]);
		$file_ext[0]         = strtolower($file_ext[0]);
		$file_format         = $file_ext[0];
		$allowed_ext         = explode(",", $allowed_formats);
		$allowed_ext_compare = array_intersect($file_ext, $allowed_ext);
		$allowed_ext_result  = false;
		if (count($allowed_ext_compare) > 0) {$allowed_ext_result=true;}

		if (!isset($_FILES[$input_name]['error'])) {
        	$report[0] = "0";
        	$report[1] = _HWDPS_PHPUPLD_ERR00;
			return $report;
		} else if ($_FILES[$input_name]['error'] == 8) {
        	$report[0] = "0";
        	$report[1] = _HWDPS_PHPUPLD_ERR08;
			return $report;
		} else if ($_FILES[$input_name]['error'] == 7) {
        	$report[0] = "0";
        	$report[1] = _HWDPS_PHPUPLD_ERR07;
			return $report;
		} else if ($_FILES[$input_name]['error'] == 6) {
        	$report[0] = "0";
        	$report[1] = _HWDPS_PHPUPLD_ERR06;
			return $report;
		} else if ($_FILES[$input_name]['error'] == 5) {
        	$report[0] = "0";
        	$report[1] = _HWDPS_PHPUPLD_ERR05;
			return $report;
		} else if ($_FILES[$input_name]['error'] == 4) {
        	$report[0] = "0";
        	$report[1] = _HWDPS_PHPUPLD_ERR04;
			return $report;
		} else if ($_FILES[$input_name]['error'] == 3) {
        	$report[0] = "0";
        	$report[1] = _HWDPS_PHPUPLD_ERR03;
			return $report;
		} else if ($_FILES[$input_name]['error'] == 2) {
        	$report[0] = "0";
        	$report[1] = _HWDPS_PHPUPLD_ERR02;
			return $report;
		} else if ($_FILES[$input_name]['error'] == 1) {
        	$report[0] = "0";
        	$report[1] = _HWDPS_PHPUPLD_ERR01;
			return $report;
		} else if ($_FILES[$input_name]['error'] == 0) {

			if (empty($file_name)) {
				$photo_id = hwd_ps_tools::generateNewPhotoid();
				$file_name = $photo_id.".".$file_format;
			} else {
				$photo_id = $file_name;
				$file_name = $file_name.".".$file_format;
			}

			if ($file_size > $file_size_limit) {
				$msg = "[".$file_name_org."] Upload Failed: File is too big";
				$report[0] = "2";
				$report[1] = $msg;
				$mainframe->enqueueMessage($msg);
				return $report;
			}

			if (!$allowed_ext_result) {
				$msg = "[".$file_name_org."] Upload Failed: This file format is not allowed";
				$report[0] = "2";
				$report[1] = $msg;
				return $report;
			}

			//
			// setup directory structure and check existance
			//
			$baseOriginalDir = JPATH_SITE.DS.'hwdphotos'.DS.'originals'.DS.$my->id.DS;
			$baseResizedUDir = JPATH_SITE.DS.'hwdphotos'.DS.'uploads'.DS.$my->id.DS;
			$baseResizedADir = JPATH_SITE.DS.'hwdphotos'.DS.'uploads'.DS.$my->id.DS.$album_id.DS;
			$baseThumbDir = JPATH_SITE.DS.'hwdphotos'.DS.'thumbs'.DS.'normal'.DS;
			$baseSquareThumbDir = JPATH_SITE.DS.'hwdphotos'.DS.'thumbs'.DS.'square'.DS;
			$baseSquareThumbRfDir = JPATH_SITE.DS.'hwdphotos'.DS.'thumbs'.DS.'squarerf'.DS;

			JFolder::create($baseOriginalDir);
			JFolder::create($baseResizedUDir);
			JFolder::create($baseResizedADir);

			$mode = 0755;
			if (!is_writable($baseOriginalDir)) { JPath::setPermissions($baseOriginalDir, $mode); }
			if (!is_writable($baseResizedUDir)) { JPath::setPermissions($baseResizedUDir, $mode); }
			if (!is_writable($baseResizedADir)) { JPath::setPermissions($baseResizedADir, $mode); }
			$mode = 0777;
			if (!is_writable($baseOriginalDir)) { JPath::setPermissions($baseOriginalDir, $mode); }
			if (!is_writable($baseResizedUDir)) { JPath::setPermissions($baseResizedUDir, $mode); }
			if (!is_writable($baseResizedADir)) { JPath::setPermissions($baseResizedADir, $mode); }

			if (!$overwrite && file_exists($baseOriginalDir.$file_name)) {
				$report[0] = "2";
				$report[1] = _HWDPS_ERROR_UPLDERR05;
				return $report;
			}

			if (!is_writable($baseOriginalDir) ||
			    !is_writable($baseResizedUDir) ||
			    !is_writable($baseResizedADir) ||
			    !is_writable($baseThumbDir) ||
			    !is_writable($baseSquareThumbDir) ||
			    !is_writable($baseSquareThumbRfDir)) {
				$report[0] = "2";
				$report[1] = "[".$file_name_org."] Uploaded Failed, upload folders are not writeable.";
				return $report;
			}

			if (!move_uploaded_file ($_FILES[$input_name]['tmp_name'],$baseOriginalDir.$file_name) || !JPath::setPermissions($baseOriginalDir.$file_name)) {
				$report[0] = "0";
				$report[1] = _HWDPS_ERROR_UPLDERR06;
				return $report;
			}

			JPath::setPermissions($baseOriginalDir.$file_name, 755);
			list($width, $height, $type, $attr) = @getimagesize($baseOriginalDir.$file_name);

			$ratio = min($width,$height)/max($width,$height);
			if ($ratio > 0.50) {
				$resize = 200;
			} else if ($ratio > 0.35) {
				$resize = 300;
			} else {
				$resize = 500;
			}

			require_once(JPATH_SITE.DS.'administrator'.DS.'components'.DS.'com_hwdphotoshare'.DS.'libraries'.DS.'thumbnail.inc.php');
			if (max($width,$height) > 3000) {

				hwd_ps_uploads::createResizedIMK($baseResizedADir.$photo_id.".".$file_format, $baseOriginalDir.$file_name, $c->resize_main);
				if (!file_exists($baseResizedADir.$photo_id.".".$file_format)) {
					$report[0] = "2";
					$report[1] = "Can not process the original";
					return $report;
				}

			} else {

				$resized = new Thumbnail($baseOriginalDir.$file_name);
				$resized->resize($c->resize_main,$c->resize_main);
				$resized->save($baseResizedADir.$photo_id.".".$file_format);
				$resized->destruct();

			}

			// generate thumbnail
			$thumb = new Thumbnail($baseResizedADir.$photo_id.".".$file_format);
			$thumb->resize($c->resize_thumb,$c->resize_thumb);
			$thumb->save($baseThumbDir.$photo_id.".".$file_format);
			$thumb->destruct();

			// generate square thumbnail
			$thumb = new Thumbnail($baseResizedADir.$photo_id.".".$file_format);
			$thumb->resize($resize,$resize);
			$thumb->cropFromCenter($c->resize_square, $c->resize_square);
			$thumb->save($baseSquareThumbDir.$photo_id.".".$file_format);
			$thumb->destruct();
			// generate square reflected thumbnail
			$thumb = new Thumbnail($baseResizedADir.$photo_id.".".$file_format);
			$thumb->resize($resize,$resize);
			$thumb->cropFromCenter($c->resize_square, $c->resize_square);
			$thumb->createReflection(40,40,80,true,'#a4a4a4');
			$thumb->save($baseSquareThumbRfDir.$photo_id.".".$file_format);
			$thumb->destruct();

			if ($album_id !== 0) {
				$query = 'SELECT allow_comments,allow_ratings,privacy'
						. ' FROM #__hwdpsalbums'
						. ' WHERE id = '.$album_id
						;
				$db->SetQuery( $query );
				$albumdetails = $db->loadObject();
			} else {
				$albumdetails->allow_comments = 1;
				$albumdetails->allow_ratings = 1;
				$albumdetails->privacy = "public";
			}

			$row = new hwdpsphotos($db);

			$_POST['photo_type']        = "local";
			$_POST['photo_id']          = $photo_id;
			$_POST['thumb_id']          = $photo_id;
			$_POST['album_id']          = $album_id;
			$_POST['category_id']       = $category_id;
			$_POST['date_uploaded'] 	= date('Y-m-d H:i:s');
			$_POST['user_id'] 			= $my->id;
			$_POST['original_type'] 	= $file_format;
			$_POST['published'] 		= "1";
			$_POST['allow_comments'] 	= $albumdetails->allow_comments;
			$_POST['allow_ratings'] 	= $albumdetails->allow_ratings;
			$_POST['privacy'] 			= $albumdetails->privacy;

			if ($c->aap == 1) {
				$_POST['approved'] = "yes";
			} else {
				$_POST['approved'] = "pending";
			}

			// bind it to the table
			if (!$row->bind($_POST)) {
				echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n";
				exit();
			}

			// store it in the db
			if (!$row->store()) {
				echo "<script> alert('".$row -> getError()."'); window.history.go(-1); </script>\n";
				exit();
			}

			if ($c->aap == 1) {
				// perform maintenance
				require_once(JPATH_SITE.DS.'administrator'.DS.'components'.DS.'com_hwdphotoshare'.DS.'libraries'.DS.'maintenance_recount.class.php');
				hwd_ps_recount::recountPhotosInAlbum($row->album_id);
				include_once(JPATH_SITE.DS.'components'.DS.'com_hwdphotoshare'.DS.'xml'.DS.'xmloutput.class.php');
				hwd_ps_xmlOutput::prepareSlideshowXML($row->album_id);
			}
			hwd_ps_tools::reorganiseAlbum($row->album_id);
			hwd_ps_tools::setAlbumModifiedDate($row->album_id);

			// mail admin notification
			if ($c->mailphotonotification == 1) {

				$query = 'SELECT ordering'
						. ' FROM #__hwdpsphotos'
						. ' WHERE id = '.$row->id
						;
				$db->SetQuery($query);
				$ordering = $db->loadResult();

				$jconfig = new jconfig();
				$mailbody = ""._HWDPS_MAIL_BODY3.$jconfig->sitename.".\n";
				if (isset($row->id)) {
					$mailbody .= "".JURI::root()."index.php?option=com_hwdphotoshare&task=viewphoto&Itemid=".$Itemid."&album_id=".$row->album_id."&limitstart=".$ordering."\n";
				}
				$mailbody .= "\n"._HWDPS_MAIL_BODY4."\n";
				$mailbody .= JURI::root()."administrator";

				JUtility::sendMail( $jconfig->mailfrom, $jconfig->fromname, $c->mailnotifyaddress, _HWDPS_MAIL_SUBJECT2.$jconfig->sitename.' ', $mailbody );
			}

			$report[0] = "1";
			$report[1] = "[".$file_name_org."] Uploaded Successfully";

			return $report;
		}
	}
    /**
     * Plug-and-Play fastimagecopyresampled function replaces much slower imagecopyresampled.
     *
     * @param string $option  the joomla component name
     * @param array  $rows  array of video data
     * @param array  $rowsfeatured  array of featured video data
     * @param object $pageNav  page navigation object
     * @param int    $total  the total video count
     * @return       Nothing
     */
	function createResizedIMK($image_d, $image_s, $resize_main) {

		list($width, $height, $type, $attr) = getimagesize($image_s);
		$by = ($width/$resize_main);
		$newWidth = max($resize_main, round($width/$by));
		$newHeight = max($resize_main, round($height/$by));
		$newRes = $newWidth ."x". $newHeight;

		if (is_callable('exec') && function_exists('exec')) {
			$cr = exec("/usr/bin/convert -resize $newRes $image_s $image_d", $retval);
			return $cr;
		} else {
			return false;
		}

	}

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
    function uploadMedia()
	{
		global $mainframe;
		$c = hwd_ps_Config::get_instance();
		$db = & JFactory::getDBO();
		$my = & JFactory::getUser();
		$acl= & JFactory::getACL();
		$usersConfig = &JComponentHelper::getParams( 'com_users' );

		if (!hwd_ps_access::checkAccess($c->gtree_upld, $c->gtree_upld_child, 4, 0, _HWDPS_TITLE_NOACCESS, _HWDPS_ALERT_REGISTERFORUPLD, _HWDPS_ALERT_UPLD_NOT_AUTHORIZED, 'exclamation.png', 0)) {return;}

		$album_id = JRequest::getInt( 'album_id', null );

		if (isset($album_id)) {
			if ($album_id == '-1') {
				$category_id = JRequest::getInt( 'category_id', 0 );
				if ($category_id == 0) {
					$msg = "You need to select a category";
					$mainframe->enqueueMessage($msg);
					$mainframe->redirect( JURI::root( true ) . '/index.php?option=com_hwdphotoshare&task=upload&Itemid='.$Itemid );
				}
				if (isset($category_id) && $category_id !== '') {
					$mainframe->redirect( JURI::root( true ) . '/index.php?option=com_hwdphotoshare&task=addphotos&Itemid='.$Itemid.'&category_id='.$category_id );
				}
			} else if ($album_id == '0') {
				$msg = "You need to select an album";
				$mainframe->enqueueMessage($msg);
				$mainframe->redirect( JURI::root( true ) . '/index.php?option=com_hwdphotoshare&task=upload&Itemid='.$Itemid );
			} else {
				$mainframe->redirect( JURI::root( true ) . '/index.php?option=com_hwdphotoshare&task=addphotos&Itemid='.$Itemid.'&album_id='.$album_id );
			}
		}

		$userId = JRequest::getInt( 'user_id', 0, 'post' );

		$db->SetQuery( 'SELECT *'
						. ' FROM #__hwdpsalbums'
						. ' WHERE published = 1'
						. ' AND approved = "yes"'
						. ' AND user_id = '.$my->id
						);
  		$albums = $db->loadObjectList();

		$db->SetQuery( 'SELECT count(*)'
						. ' FROM #__hwdpsalbums'
						. ' WHERE approved = "pending"'
						. ' AND user_id = '.$my->id
						);
  		$count_pending = $db->loadResult();

		hwd_ps_html::uploadMedia($albums, $count_pending);

	}
}
?>