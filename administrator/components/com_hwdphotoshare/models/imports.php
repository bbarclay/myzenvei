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

class hwdps_BE_imports
{
   /**
	* Import Data
	*/
	function import()
	{
		global $database, $my;
		hwd_ps_HTML::importdata();
	}

   /**
	* Import Data
	*/
	function ftpupload()
	{
		global $database, $my, $acl, $mosConfig_absolute_path, $mosConfig_mailfrom, $mosConfig_fromname, $mosConfig_live_site, $Itemid, $option, $mosConfig_sitename;

		$videoid 			= mosGetParam( $_POST, 'videoid' );
		$title 				= mosGetParam( $_POST, 'title' );
		$description 		= mosGetParam( $_POST, 'description' );
		$category_id 		= intval ( mosGetParam( $_POST, 'category_id' ) );
		$tags 				= mosGetParam( $_POST, 'tags' );
		$duration			= mosGetParam( $_POST, 'duration' );
		$public_private 	= mosGetParam( $_POST, 'public_private' );
		$allow_comments 	= intval ( mosGetParam( $_POST, 'allow_comments' ) );
		$allow_embedding 	= intval ( mosGetParam( $_POST, 'allow_embedding' ) );
		$allow_ratings 		= intval ( mosGetParam( $_POST, 'allow_ratings' ) );

		$checkform = hwd_ps_tools::checkFormComplete($title, $description, $category_id, $tags, $public_private, $allow_comments, $allow_embedding, $allow_ratings);
		if (!$checkform) { return; }

		$row = new hwdps_video($database);

			//check if already exists
			$database->SetQuery( 'SELECT count(*)'
							. ' FROM #__hwdpsphotos'
							. ' WHERE video_id = '.$videoid.''
							);
			$duplicatecount = $database->loadResult();
			if ($duplicatecount > 0) {
				$msg = _HWDPS_ALERT_DUPLICATE;
				echo "<script> alert('".$msg."'); window.history.go(-1); </script>\n";
				return;
			}

			$_POST['video_id'] 			= $videoid;
			$_POST['video_type'] 		= "local";
			$_POST['title'] 			= $title;
			$_POST['description'] 		= $description;
			$_POST['category_id'] 		= $category_id;
			$_POST['tags'] 				= $tags;
			$_POST['video_length'] 		= $duration;
			$_POST['public_private'] 	= $public_private;
			$_POST['allow_comments'] 	= $allow_comments;
			$_POST['allow_embedding'] 	= $allow_embedding;
			$_POST['allow_ratings'] 	= $allow_ratings;
			$_POST['date_uploaded'] 	= date('Y-m-d H:i:s');
			$_POST['user_id'] 			= $my->id;
			$_POST['published'] 		= "0";
			$_POST['approved'] 			= "yes";

			if(empty($_POST['video_id'])) {
				$msg = _HWDPS_ALERT_ERRFTP;
				echo "<script> alert('".$msg."'); window.history.go(-1); </script>\n";
				return;
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

			$msg = _HWDPS_ALERT_SUCFTP;
			echo "<script> alert('".$msg."'); </script>\n";

			// perform maintenance
			include(HWDPS_ADMIN_PATH.'/maintenance/recount.class.php');
			hwd_ps_recount::recountVideosInCategory($row->category_id);

			mosRedirect( 'index.php?option='. $option .'&task=editvidsA&hidemainmenu=1&cid='.$row->id );
	}
   /**
	* Import Data
	*/
	function remoteupload()
	{
		global $database, $my, $acl, $mosConfig_absolute_path, $mosConfig_mailfrom, $mosConfig_fromname, $mosConfig_live_site, $Itemid, $option, $mosConfig_sitename;

		$videourl = mosGetParam( $_POST, 'videourl' );
		$thumbnailurl = mosGetParam( $_POST, 'thumbnailurl' );
		if (!hwd_ps_tools::is_valid_url($videourl)) {
			$msg = _HWDPS_ALERT_VURLWRONG;
			echo "<script> alert('".$msg."'); window.history.go(-1); </script>\n";
			return;
		}
		if (!hwd_ps_tools::is_valid_url($thumbnailurl)) {
			$msg = _HWDPS_ALERT_TURLWRONG;
			echo "<script> alert('".$msg."'); window.history.go(-1); </script>\n";
			return;
		}
		$video_id = $videourl.",".$thumbnailurl;

		$title 				= mosGetParam( $_POST, 'title' );
		$description 		= mosGetParam( $_POST, 'description' );
		$category_id 		= intval ( mosGetParam( $_POST, 'category_id' ) );
		$tags 				= mosGetParam( $_POST, 'tags' );
		$duration			= mosGetParam( $_POST, 'duration' );
		$public_private 	= mosGetParam( $_POST, 'public_private' );
		$allow_comments 	= intval ( mosGetParam( $_POST, 'allow_comments' ) );
		$allow_embedding 	= intval ( mosGetParam( $_POST, 'allow_embedding' ) );
		$allow_ratings 		= intval ( mosGetParam( $_POST, 'allow_ratings' ) );

		$checkform = hwd_ps_tools::checkFormComplete($title, $description, $category_id, $tags, $public_private, $allow_comments, $allow_embedding, $allow_ratings);
		if (!$checkform) { return; }

		$row = new hwdps_video($database);

			//check if already exists
			$database->SetQuery( 'SELECT count(*)'
							. ' FROM #__hwdpsphotos'
							. ' WHERE video_id = '.$video_id.''
							);
			$duplicatecount = $database->loadResult();
			if ($duplicatecount > 0) {
				$msg = _HWDPS_ALERT_DUPLICATE;
				echo "<script> alert('".$msg."'); window.history.go(-1); </script>\n";
				return;
			}

			$_POST['video_id'] 			= $video_id;
			$_POST['video_type'] 		= "remote";
			$_POST['title'] 			= $title;
			$_POST['description'] 		= $description;
			$_POST['category_id'] 		= $category_id;
			$_POST['tags'] 				= $tags;
			$_POST['video_length'] 		= $duration;
			$_POST['public_private'] 	= $public_private;
			$_POST['allow_comments'] 	= $allow_comments;
			$_POST['allow_embedding'] 	= $allow_embedding;
			$_POST['allow_ratings'] 	= $allow_ratings;
			$_POST['date_uploaded'] 	= date('Y-m-d H:i:s');
			$_POST['user_id'] 			= $my->id;
			$_POST['published'] 		= "0";
			$_POST['approved'] 			= "yes";

			if(empty($_POST['video_id'])) {
				$msg = _HWDPS_ALERT_ERRFTP;
				hwd_ps_HTML_import::ftpupload_result($msg);
				return;
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

			$msg = _HWDPS_ALERT_SUCFTP;
			echo "<script> alert('".$msg."'); </script>\n";

			// perform maintenance
			include(HWDPS_ADMIN_PATH.'/maintenance/recount.class.php');
			hwd_ps_recount::recountVideosInCategory($row->category_id);

			mosRedirect( 'index.php?option='. $option .'&task=editvidsA&hidemainmenu=1&cid='.$row->id );
	}
   /**
	* Import Data
	*/
	function sqlRestore()
	{
		global $database, $my, $mosConfig_db, $mosConfig_user, $mosConfig_dbprefix, $mosConfig_password, $mosConfig_db, $mosConfig_host, $mosConfig_host, $mosConfig_absolute_path, $mosConfig_user, $mosConfig_password;

		$file_name0= (isset($_FILES['upfile_0']['tmp_name']) ? $_FILES['upfile_0']['tmp_name'] : "");
		$file_name = (isset($_FILES['upfile_0']['name']) ? $_FILES['upfile_0']['name'] : "");
		$file_size = (isset($_FILES['upfile_0']['size']) ? $_FILES['upfile_0']['size'] : "");

		if (!isset($_FILES['upfile_0']['error'])) {
        	hwd_ps_tools::infomessage(4, 0, _HWDPS_TITLE_UPLDFAIL, _HWDPS_PHPUPLD_ERR00, "exclamation.png", 0);
			return;
		} else if ($_FILES['upfile_0']['error'] == 8) {
        	hwd_ps_tools::infomessage(4, 0, _HWDPS_TITLE_UPLDFAIL, _HWDPS_PHPUPLD_ERR08, "exclamation.png", 0);
			return;
		} else if ($_FILES['upfile_0']['error'] == 7) {
        	hwd_ps_tools::infomessage(4, 0, _HWDPS_TITLE_UPLDFAIL, _HWDPS_PHPUPLD_ERR07, "exclamation.png", 0);
			return;
		} else if ($_FILES['upfile_0']['error'] == 6) {
        	hwd_ps_tools::infomessage(4, 0, _HWDPS_TITLE_UPLDFAIL, _HWDPS_PHPUPLD_ERR06, "exclamation.png", 0);
			return;
		} else if ($_FILES['upfile_0']['error'] == 5) {
        	hwd_ps_tools::infomessage(4, 0, _HWDPS_TITLE_UPLDFAIL, _HWDPS_PHPUPLD_ERR05, "exclamation.png", 0);
			return;
		} else if ($_FILES['upfile_0']['error'] == 4) {
        	hwd_ps_tools::infomessage(4, 0, _HWDPS_TITLE_UPLDFAIL, _HWDPS_PHPUPLD_ERR04, "exclamation.png", 0);
			return;
		} else if ($_FILES['upfile_0']['error'] == 3) {
        	hwd_ps_tools::infomessage(4, 0, _HWDPS_TITLE_UPLDFAIL, _HWDPS_PHPUPLD_ERR03, "exclamation.png", 0);
			return;
		} else if ($_FILES['upfile_0']['error'] == 2) {
        	hwd_ps_tools::infomessage(4, 0, _HWDPS_TITLE_UPLDFAIL, _HWDPS_PHPUPLD_ERR02, "exclamation.png", 0);
			return;
		} else if ($_FILES['upfile_0']['error'] == 1) {
        	hwd_ps_tools::infomessage(4, 0, _HWDPS_TITLE_UPLDFAIL, _HWDPS_PHPUPLD_ERR01, "exclamation.png", 0);
			return;
		} else if ($_FILES['upfile_0']['error'] == 0) {

			if (empty($file_name)) {
        		hwd_ps_tools::infomessage(4, 0, _HWDPS_TITLE_UPLDFAIL, _HWDPS_ERROR_UPLDERR00, "exclamation.png", 0);
				return;
			}

			$filename = split("\.", $file_name);
			if (eregi("[^0-9a-zA-Z_]", $filename[0])) {
        		hwd_ps_tools::infomessage(4, 0, _HWDPS_TITLE_UPLDFAIL, _HWDPS_ERROR_UPLDERR03, "exclamation.png", 0);
				return;
			}

			$file_ext = substr($file_name, strrpos($file_name, '.') + 1);
			if ($file_ext !== "gz") {
				hwd_ps_tools::infomessage(4, 0, _HWDPS_TITLE_UPLDFAIL, _HWDPS_ERROR_UPLDERR04, "exclamation.png", 0);
				return;
			}
			$base_Dir = HWDPS_ADMIN_PATH.'/../../../media/';
			if (file_exists($base_Dir.$file_name)) {
				hwd_ps_tools::infomessage(4, 0, _HWDPS_TITLE_UPLDFAIL, _HWDPS_ERROR_UPLDERR05, "exclamation.png", 0);
				return;
			}
			if (!move_uploaded_file ($_FILES['upfile_0']['tmp_name'],$base_Dir.$file_name) || !mosChmod($base_Dir.$file_name)) {
				hwd_ps_tools::infomessage(4, 0, _HWDPS_TITLE_UPLDFAIL, _HWDPS_ERROR_UPLDERR06, "exclamation.png", 0);
				return;
			}

		}

		// Enter your MySQL access data
		$host= $mosConfig_host;
		$user= $mosConfig_user;
		$pass= $mosConfig_password;
		$db=   $mosConfig_db;
		$path= $mosConfig_absolute_path;

		$backupdir = 'media';
		$bkupfile = $file_name;
		$bkupname = substr($bkupfile, 0, strrpos($bkupfile, '.'));

		// Execute mysqldump command.
		// It will produce a file named $db-$year$month$day-$hour$min.gz
		// under $DOCUMENT_ROOT/$backupdir
		@system('gunzip '.$mosConfig_absolute_path.'/media/'.$bkupfile);
		@system(sprintf('mysql -h %s -u %s -p%s %s < %s/%s/%s',$host,$user,$pass,$db,$path,$backupdir,$bkupname));

		//system('gzip '.$mosConfig_absolute_path.'/hwdvideos/backups/'.$bkupname);
		unlink($mosConfig_absolute_path.'/media/'.$bkupname);
		mosRedirect( 'index.php?option=com_hwdphotoshare&task=import', "SQL Import has been executed, please check import was successful." );
	}
   /**
	* Import Data
	*/
	function csvImport()
	{
		global $database, $my, $mosConfig_db, $mosConfig_user, $mosConfig_dbprefix, $mosConfig_password, $mosConfig_db, $mosConfig_host, $mosConfig_host, $mosConfig_absolute_path, $mosConfig_user, $mosConfig_password;

		$file_name0= (isset($_FILES['upfile_0']['tmp_name']) ? $_FILES['upfile_0']['tmp_name'] : "");
		$file_name = (isset($_FILES['upfile_0']['name']) ? $_FILES['upfile_0']['name'] : "");
		$file_size = (isset($_FILES['upfile_0']['size']) ? $_FILES['upfile_0']['size'] : "");

		if (!isset($_FILES['upfile_0']['error'])) {
        	hwd_ps_tools::infomessage(4, 0, _HWDPS_TITLE_UPLDFAIL, _HWDPS_PHPUPLD_ERR00, "exclamation.png", 0);
			return;
		} else if ($_FILES['upfile_0']['error'] == 8) {
        	hwd_ps_tools::infomessage(4, 0, _HWDPS_TITLE_UPLDFAIL, _HWDPS_PHPUPLD_ERR08, "exclamation.png", 0);
			return;
		} else if ($_FILES['upfile_0']['error'] == 7) {
        	hwd_ps_tools::infomessage(4, 0, _HWDPS_TITLE_UPLDFAIL, _HWDPS_PHPUPLD_ERR07, "exclamation.png", 0);
			return;
		} else if ($_FILES['upfile_0']['error'] == 6) {
        	hwd_ps_tools::infomessage(4, 0, _HWDPS_TITLE_UPLDFAIL, _HWDPS_PHPUPLD_ERR06, "exclamation.png", 0);
			return;
		} else if ($_FILES['upfile_0']['error'] == 5) {
        	hwd_ps_tools::infomessage(4, 0, _HWDPS_TITLE_UPLDFAIL, _HWDPS_PHPUPLD_ERR05, "exclamation.png", 0);
			return;
		} else if ($_FILES['upfile_0']['error'] == 4) {
        	hwd_ps_tools::infomessage(4, 0, _HWDPS_TITLE_UPLDFAIL, _HWDPS_PHPUPLD_ERR04, "exclamation.png", 0);
			return;
		} else if ($_FILES['upfile_0']['error'] == 3) {
        	hwd_ps_tools::infomessage(4, 0, _HWDPS_TITLE_UPLDFAIL, _HWDPS_PHPUPLD_ERR03, "exclamation.png", 0);
			return;
		} else if ($_FILES['upfile_0']['error'] == 2) {
        	hwd_ps_tools::infomessage(4, 0, _HWDPS_TITLE_UPLDFAIL, _HWDPS_PHPUPLD_ERR02, "exclamation.png", 0);
			return;
		} else if ($_FILES['upfile_0']['error'] == 1) {
        	hwd_ps_tools::infomessage(4, 0, _HWDPS_TITLE_UPLDFAIL, _HWDPS_PHPUPLD_ERR01, "exclamation.png", 0);
			return;
		} else if ($_FILES['upfile_0']['error'] == 0) {

			if (empty($file_name)) {
        		hwd_ps_tools::infomessage(4, 0, _HWDPS_TITLE_UPLDFAIL, _HWDPS_ERROR_UPLDERR00, "exclamation.png", 0);
				return;
			}

			$filename = split("\.", $file_name);
			if (eregi("[^0-9a-zA-Z_]", $filename[0])) {
        		hwd_ps_tools::infomessage(4, 0, _HWDPS_TITLE_UPLDFAIL, _HWDPS_ERROR_UPLDERR03, "exclamation.png", 0);
				return;
			}

			$file_ext = substr($file_name, strrpos($file_name, '.') + 1);
			if ($file_ext !== "csv") {
				hwd_ps_tools::infomessage(4, 0, _HWDPS_TITLE_UPLDFAIL, _HWDPS_ERROR_UPLDERR04, "exclamation.png", 0);
				return;
			}
			$base_Dir = HWDPS_ADMIN_PATH.'/../../../media/';
			if (file_exists($base_Dir.$file_name)) {
				hwd_ps_tools::infomessage(4, 0, _HWDPS_TITLE_UPLDFAIL, _HWDPS_ERROR_UPLDERR05, "exclamation.png", 0);
				return;
			}
			if (!move_uploaded_file ($_FILES['upfile_0']['tmp_name'],$base_Dir.$file_name) || !mosChmod($base_Dir.$file_name)) {
				hwd_ps_tools::infomessage(4, 0, _HWDPS_TITLE_UPLDFAIL, _HWDPS_ERROR_UPLDERR06, "exclamation.png", 0);
				return;
			}

		}

include('CsvIterator.class.php');
$csvIterator = new CsvIterator($mosConfig_absolute_path.'/media/'.$file_name, true, ",", "\"");
while ($csvIterator->next()) {
   $row = $csvIterator->current();
   echo $row[2];
}






		unlink($mosConfig_absolute_path.'/media/'.$file_name);
		exit;

		mosRedirect( 'index.php?option=com_hwdphotoshare&task=import', "SQL Import has been executed, please check import was successful." );
	}
	/**
	* Import Data
	*/
	function seyretImport()
	{
		global $database, $my, $acl, $mosConfig_absolute_path, $mosConfig_mailfrom, $mosConfig_fromname, $mosConfig_live_site, $Itemid, $option, $mosConfig_sitename;

		// import categories
		$database->setQuery( "SELECT * FROM #__seyret_categories" );
		$rows_cats = $database->loadObjectList();

		for ($i=0, $n=count($rows_cats); $i < $n; $i++) {
			$row = $rows_cats[$i];

			$database->setQuery( 'INSERT IGNORE INTO `#__hwdpscategories` (`parent`, `category_name`, `category_description`, `published`)'
								.'VALUES (0, \''.$row->categoryname.'\', \''.$row->categoryname.'\', \'1\');'
								);
			if ( !$database->query() ) {
				echo "<script> alert('".$database->getErrorMsg()."'); window.history.go(-1); </script>\n";
				exit();
			}

		}

			$msg = _HWDPS_ALERT_SUCFTP;
			echo "<script> alert('".$msg."'); </script>\n";
			mosRedirect( 'index.php?option='. $option .'&task=import' );
	}
   /**
	* check valid URL
	*/
	function is_valid_url ( $url )
	{
		$theresults = ereg("^[a-zA-Z0-9]+://[^ ]+$", $url, $trashed);
		if ($theresults) {
			return true;
		} else {
			return false;
		}
	}
}
?>