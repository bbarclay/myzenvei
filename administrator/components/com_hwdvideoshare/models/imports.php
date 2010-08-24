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

class hwdvids_BE_imports
{
   /**
	* Import Data
	*/
	function import()
	{
		global $database, $my;
		hwdvids_HTML::importdata();
	}

   /**
	* Import Data
	*/
	function ftpupload()
	{
		global $mainframe, $mosConfig_absolute_path, $mosConfig_mailfrom, $mosConfig_fromname, $mosConfig_live_site, $Itemid, $option, $mosConfig_sitename;
		$db = & JFactory::getDBO();
		$my = & JFactory::getUser();

		$videoid 			= JRequest::getCmd( 'videoid' );
		$title 				= Jrequest::getVar( 'title', 'no name supplied' );
		$description 		= Jrequest::getVar( 'description', 'no name supplied' );
		$category_id 		= JRequest::getInt( 'category_id', 0, 'post' );
		$tags 				= Jrequest::getVar( 'tags', 'no name supplied' );
		$duration			= Jrequest::getVar( 'duration', 'no name supplied' );
		$public_private 	= JRequest::getWord( 'public_private' );
		$allow_comments 	= JRequest::getInt( 'allow_comments', 0, 'post' );
		$allow_embedding 	= JRequest::getInt( 'allow_embedding', 0, 'post' );
		$allow_ratings 		= JRequest::getInt( 'allow_ratings', 0, 'post' );

		$checkform = hwd_vs_tools::checkFormComplete($title, $description, $category_id, $tags, $public_private, $allow_comments, $allow_embedding, $allow_ratings);
		if (!$checkform) { return; }

		$row = new hwdvids_video($db);

			//check if already exists
			$db->SetQuery( 'SELECT count(*)'
							. ' FROM #__hwdvidsvideos'
							. ' WHERE video_id = '.$videoid.''
							);
			$duplicatecount = $db->loadResult();
			if ($duplicatecount > 0) {
				$msg = _HWDVIDS_ALERT_DUPLICATE;
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
				$msg = _HWDVIDS_ALERT_ERRFTP;
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

			$msg = _HWDVIDS_ALERT_SUCFTP;
			echo "<script> alert('".$msg."'); </script>\n";

			// perform maintenance
			include(JPATH_SITE.DS.'administrator'.DS.'components'.DS.'com_hwdvideoshare'.DS.'libraries'.DS.'maintenance_recount.class.php');
			hwd_vs_recount::recountVideosInCategory($row->category_id);

			$mainframe->enqueueMessage($msg);
			$mainframe->redirect( JURI::root( true ) . '/administrator/index.php?option='. $option .'&task=editvidsA&hidemainmenu=1&cid='.$row->id );

	}
   /**
	* Import Data
	*/
	function remoteupload()
	{
		global $mainframe, $my, $acl, $mosConfig_absolute_path, $mosConfig_mailfrom, $mosConfig_fromname, $mosConfig_live_site, $Itemid, $option, $mosConfig_sitename;
		$db = & JFactory::getDBO();
		$my = & JFactory::getUser();

		$videourl = Jrequest::getVar( 'videourl', '' );
		if (file_exists(JPATH_SITE.DS.'plugins'.DS.'hwdvs-thirdparty'.DS.'remote.php')) {

			require_once(JPATH_SITE.DS.'plugins'.DS.'hwdvs-thirdparty'.DS.'remote.php');
			$videourl = hwd_vs_tp_remote::remoteGetCode($videourl);

		}

		$thumbnailurl = Jrequest::getVar( 'thumbnailurl', '' );
		if (!empty($thumbnailurl) && !hwd_vs_tools::is_valid_url($thumbnailurl)) {
			$msg = _HWDVIDS_ALERT_TURLWRONG;
			$mainframe->enqueueMessage($msg);
			$mainframe->redirect( JURI::root( true ) . '/administrator/index.php?option=com_hwdvideoshare&task=import' );
		}

		$video_id 			= $videourl;
		$title 				= Jrequest::getVar( 'title', 'no name supplied' );
		$description 		= Jrequest::getVar( 'description', 'no name supplied' );
		$category_id 		= JRequest::getInt( 'category_id', 0, 'post' );
		$tags 				= Jrequest::getVar( 'tags', 'no name supplied' );
		$duration			= Jrequest::getVar( 'duration', 'no name supplied' );
		$public_private 	= JRequest::getWord( 'public_private' );
		$allow_comments 	= JRequest::getInt( 'allow_comments', 0, 'post' );
		$allow_embedding 	= JRequest::getInt( 'allow_embedding', 0, 'post' );
		$allow_ratings 		= JRequest::getInt( 'allow_ratings', 0, 'post' );

		$checkform = hwd_vs_tools::checkFormComplete($title, $description, $category_id, $tags, $public_private, $allow_comments, $allow_embedding, $allow_ratings);
		if (!$checkform) { return; }

		$row = new hwdvids_video($db);

			//check if already exists
			$db->SetQuery( 'SELECT count(*)'
							. ' FROM #__hwdvidsvideos'
							. ' WHERE video_id = "'.$video_id.'"'
							);
			$duplicatecount = $db->loadResult();
			if ($duplicatecount > 0) {
				$msg = _HWDVIDS_ALERT_DUPLICATE;
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
			$_POST['thumbnail'] 		= $thumbnailurl;

			if(empty($_POST['video_id'])) {
				$msg = _HWDVIDS_ALERT_ERRFTP;
				hwdvids_HTML_import::ftpupload_result($msg);
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

			$msg = _HWDVIDS_ALERT_SUCFTP;
			echo "<script> alert('".$msg."'); </script>\n";

			// perform maintenance
			include(JPATH_SITE.DS.'administrator'.DS.'components'.DS.'com_hwdvideoshare'.DS.'libraries'.DS.'maintenance_recount.class.php');
			hwd_vs_recount::recountVideosInCategory($row->category_id);

			$mainframe->redirect( JURI::root( true ) . '/administrator/index.php?option='. $option .'&task=editvidsA&hidemainmenu=1&cid='.$row->id );

	}
   /**
	* Import Data
	*/
	function sqlRestore()
	{
		global $mainframe, $option, $my, $mosConfig_db, $mosConfig_user, $mosConfig_dbprefix, $mosConfig_password, $mosConfig_db, $mosConfig_host, $mosConfig_host, $mosConfig_absolute_path, $mosConfig_user, $mosConfig_password;

		$base_Dir = JPATH_SITE.DS.'media'.DS;
		$base_Name = "sql_import";

		$upload_result = hwd_vs_tools::uploadFile( "upfile_0", $base_Name, $base_Dir, 2, 'gz', 1 );
		if ($upload_result[0] == "0") {
			$msg = $upload_result[1];
			$mainframe->enqueueMessage($msg);
			$mainframe->redirect( JURI::root( true ) . '/administrator/index.php?option='.$option.'&task=import' );
		}

		$config = new JConfig;

		// Enter your MySQL access data
		$host= $config->host;
		$user= $config->user;
		$pass= $config->password;
		$db=   $config->db;
		$path= JPATH_SITE;

		$backupdir = 'media';
		$bkupfile = 'sql_import.gz';
		$bkupname = substr($bkupfile, 0, strrpos($bkupfile, '.'));

		// Execute mysql command.
		system('gunzip '.JPATH_SITE.DS.'media'.DS.$base_Name.'.gz');
		system(sprintf('mysql -h %s -u %s -p%s %s < %s/%s/%s',$host,$user,$pass,$db,$path,$backupdir,$bkupname));
		@unlink(JPATH_SITE.DS.'media'.DS.$base_Name);
		@unlink(JPATH_SITE.DS.'media'.DS.$base_Name.'.gz');

		$msg = "SQL Import has been executed, please check import was successful.";
		$mainframe->enqueueMessage($msg);
		$mainframe->redirect( JURI::root( true ) . '/administrator/index.php?option='.$option.'&task=import' );
	}
   /**
	* Import Data
	*/
	function csvImport()
	{
		global $mainframe, $option, $my, $mosConfig_db, $mosConfig_user, $mosConfig_dbprefix, $mosConfig_password, $mosConfig_db, $mosConfig_host, $mosConfig_host, $mosConfig_absolute_path, $mosConfig_user, $mosConfig_password;
		$db = & JFactory::getDBO();
		$c = hwd_vs_Config::get_instance();

		$mediatype = JRequest::getWord( 'mediatype' );
		$delimiter = JRequest::getWord( 'delimiter' );
		$maxerrors = JRequest::getInt( 'maxerrors', 1, 'post' );

		$base_Dir = JPATH_SITE.DS.'media'.DS;
		$base_Name = "csv_import";

		$upload_result = hwd_vs_tools::uploadFile( "upfile_0", $base_Name, $base_Dir, 2, 'csv', 1 );
		if ($upload_result[0] == "0") {
			$msg = $upload_result[1];
			$mainframe->enqueueMessage($msg);
			$mainframe->redirect( JURI::root( true ) . '/administrator/index.php?option='.$option.'&task=import' );
		}

		if ($delimiter == "comma") {
			$delimiter = ",";
		} else if ($delimiter == "tab") {
			$delimiter = "|";
		} else if ($delimiter == "pipe") {
			$delimiter = "	";
		}

		include(JPATH_SITE.DS.'administrator'.DS.'components'.DS.'com_hwdvideoshare'.DS.'libraries'.DS.'csv_iterator.class.php');
		$csvIterator = new CsvIterator(JPATH_SITE.DS.'media'.DS.$base_Name.'.csv', true, $delimiter, "\"");

		$counter=0;
		$errors=0;
		while ($csvIterator->next()) {
			$row = $csvIterator->current();

			if ($errors > $maxerrors) {
				$msg = "Import stopped! Maximum allowed errors exceeded.";
				$mainframe->enqueueMessage($msg);
				$mainframe->redirect( JURI::root( true ) . '/administrator/index.php?option='.$option.'&task=import' );
			}

			if (!isset($row['Type']) || empty($row['Type'])) { $row['Type'] = null; $errors++; continue; }
			if (!isset($row['Code']) || empty($row['Code'])) { $row['Code'] = null; $errors++; continue; }
			if (!isset($row['Extension']) || empty($row['Extension'])) { $row['Extension'] = "flv"; }
			if (!isset($row['Thumbnail']) || empty($row['Thumbnail'])) { $row['Thumbnail'] = null; $errors++; continue; }
			if (!isset($row['Title']) || empty($row['Title'])) { $row['Title'] = _HWDVIDS_UNKNOWN; }
			if (!isset($row['Description']) || empty($row['Description'])) { $row['Description'] = _HWDVIDS_UNKNOWN; }
			if (!isset($row['Tags']) || empty($row['Tags'])) { $row['Tags'] = _HWDVIDS_UNKNOWN; }
			if (!isset($row['Category ID']) || empty($row['Category ID'])) { $row['Category ID']= "0"; }
			if (!isset($row['Duration']) || empty($row['Duration'])) { $row['Duration'] = "00:00:00"; }
			if (!isset($row['Allow Comments']) || empty($row['Allow Comments'])) { $row['Allow Comments'] = "1"; }
			if (!isset($row['Allow Embedding']) || empty($row['Allow Embedding'])) { $row['Allow Embedding'] = "1"; }
			if (!isset($row['Allow Ratings']) || empty($row['Allow Ratings'])) { $row['Allow Ratings'] = "1"; }
			if (!isset($row['Access']) || empty($row['Access'])) { $row['Access'] = "public"; }
			if (!isset($row['Number Of Views']) || empty($row['Number Of Views'])) { $row['Number Of Views'] = "0"; }
			if (!isset($row['User ID']) || empty($row['User ID'])) { $row['User ID'] = "0"; }
			if (!isset($row['Featured']) || empty($row['Featured'])) { $row['Featured'] = "0"; }
			if (!isset($row['Published']) || empty($row['Published'])) { $row['Published'] = "1"; }
			if (!isset($row['Upload Date']) || empty($row['Upload Date'])) { $row['Upload Date'] = date('Y-m-d H:i:s'); }
			if (!isset($row['Thumbnail Capture Time']) || empty($row['Thumbnail Capture Time'])) { $row['Thumbnail Capture Time'] = "00:00:02"; }

			// Sanitise
			$row['Type'] = preg_replace("/[^a-zA-Z0-9s_.-]/", "", $row['Type']);
			$row['Code'] = preg_replace("/[^a-zA-Z0-9s_-]/", "", $row['Code']);
			$row['Extension'] = preg_replace("/[^a-zA-Z0-9s_-]/", "", $row['Extension']);
			$row['Thumbnail'] = $row['Thumbnail'];
			$row['Title'] = addslashes($row['Title']);
			$row['Description'] = addslashes($row['Description']);
			$row['Tags'] = addslashes($row['Tags']);
			$row['Category ID'] = intval($row['Category ID']);
			$row['Duration'] = addslashes($row['Duration']);
			$row['Allow Comments'] = intval($row['Allow Comments']);
			$row['Allow Embedding'] = intval($row['Allow Embedding']);
			$row['Allow Ratings'] = intval($row['Allow Ratings']);
			$row['Access'] = preg_replace("/[^a-zA-Z0-9s]/", "", $row['Access']);
			$row['Number Of Views'] = intval($row['Number Of Views']);
			$row['User ID'] = intval($row['User ID']);
			$row['Featured'] = intval($row['Featured']);
			$row['Published'] = intval($row['Published']);
			$row['Upload Date'] = addslashes($row['Upload Date']);
			$row['Thumbnail Capture Time'] = addslashes($row['Thumbnail Capture Time']);

			if ($row['Type'] == "local") {

				//search for duplications
				$db->SetQuery( 'SELECT count(*)'
							 . ' FROM #__hwdvidsvideos'
							 . ' WHERE video_id = "'.$row['Code'].'"'
							 );
				$total = $db->loadResult();
				echo $db->getErrorMsg();

				if ($total > 0) {
					$errors++;
					continue;
				}

				if ($c->requiredins) {
					$_POST['video_id'] 		= $row['Code'].".".$row['Extension'];
					if ($row['Extension'] == "flv") {
						$_POST['approved'] 		= "queuedforthumbnail";
					} else {
						$_POST['approved'] 		= "queuedforconversion";
					}
				} else {
					$_POST['video_id'] 		= $row['Code'];
					if ($c->aav == 1) {
						$_POST['approved'] = "yes";
					} else {
						$_POST['approved'] = "pending";
					}
				}

				$_POST['video_type'] 		= "local";

			} else {

				//search for duplications
				$db->SetQuery( 'SELECT count(*)'
							 . ' FROM #__hwdvidsvideos'
							 . ' WHERE video_id = "'.$row['Code'].','.$row['Thumbnail'].'"'
							 );
				$total = $db->loadResult();
				echo $db->getErrorMsg();

				if ($total > 0) {
					$errors++;
					continue;
				}

				$_POST['video_id'] 		= $row['Code'].','.$row['Thumbnail'];
				$_POST['approved'] 		= "yes";
				$_POST['video_type'] 	= $row['Type'];

			}

			$row_new = new hwdvids_video($db);

			$_POST['title'] 			= $row['Title'];
			$_POST['description'] 		= $row['Description'];
			$_POST['tags'] 				= $row['Tags'];
			$_POST['category_id'] 		= $row['Category ID'];
			$_POST['date_uploaded'] 	= $row['Upload Date'];
			$_POST['video_length'] 		= $row['Duration'];
			$_POST['allow_comments'] 	= $row['Allow Comments'];
			$_POST['allow_embedding'] 	= $row['Allow Embedding'];
			$_POST['allow_ratings'] 	= $row['Allow Ratings'];
			$_POST['public_private'] 	= $row['Access'];
			$_POST['number_of_views'] 	= $row['Number Of Views'];
			$_POST['user_id'] 			= $row['User ID'];
			$_POST['featured'] 		    = $row['Featured'];
			$_POST['published'] 		= $row['Published'];
			$_POST['date_uploaded'] 	= $row['Upload Date'];
			$_POST['thumb_snap'] 		= $row['Thumbnail Capture Time'];

			// bind it to the table
			if (!$row_new->bind($_POST)) {
				echo "<script> alert('".$row_new->getError()."'); window.history.go(-1); </script>\n";
				exit();
			}

			// store it in the db
			if (!$row_new->store()) {
				echo "<script> alert('".$row_new -> getError()."'); window.history.go(-1); </script>\n";
				exit();
			}

			$counter++;
		}

		unlink(JPATH_SITE.DS.'media'.DS.$base_Name.'.csv');
		$msg = "CSV Import has been executed and ".$counter." video have been imported, please check import was successful. (".$errors." Errors Reported)";
		$mainframe->enqueueMessage($msg);
		$mainframe->redirect( JURI::root( true ) . '/administrator/index.php?option='.$option.'&task=import' );
	}
	/**
	* Import Data
	*/
	function seyretImport()
	{
		global $mainframe, $my, $acl, $mosConfig_absolute_path, $mosConfig_mailfrom, $mosConfig_fromname, $mosConfig_live_site, $Itemid, $option, $mosConfig_sitename;
		$db = & JFactory::getDBO();

		$seyretcid = JRequest::getInt( 'seyretcid', -1 );
		$category_id = JRequest::getInt( 'category_id', 0 );
		$counter = 0;

		if (!empty($seyretcid) && ($seyretcid !== -1)) {
			$where = " WHERE `catid` LIKE '%*".$seyretcid."*#%'";
		} else {
			$where = "";
		}
		// import categories
		$db->setQuery( "SELECT * FROM #__seyret_items".$where );
		if ( !$db->query() ) {
			echo "<script> alert('".$db->getErrorMsg()."'); window.history.go(-1); </script>\n";
			exit();
		}
		$rows_seyret = $db->loadObjectList();

		for ($i=0, $n=count($rows_seyret); $i < $n; $i++) {
			$row_seyret = $rows_seyret[$i];

			$row = new hwdvids_video($db);

			if ($row_seyret->videoservertype == "localfile") {

				$_POST['video_id'] 	    = "local,".$row_seyret->videoservercode.",".$row_seyret->picturelink;

			} else if ($row_seyret->videoservertype == "youtube") {

				$thumbnail = "http://img.youtube.com/vi/".$row_seyret->videoservercode."/default.jpg";
				$_POST['video_id'] 	    = "youtube.com,".$row_seyret->videoservercode.",".$thumbnail;

			} else if ($row_seyret->videoservertype == "dailymotion") {

				if (file_exists(JPATH_SITE.'/plugins/hwdvs-thirdparty/dailymotion.com.php')) {
					require_once(JPATH_SITE.'/plugins/hwdvs-thirdparty/dailymotion.com.php');
					$url = hwd_vs_tools::get_final_url( $row_seyret->videourl );
					$pos_http = strpos($url, "http");
					if ($pos_http === false) {
						$url = 'http://www.dailymotion.com'.$url;
					}
					$tp = new hwd_vs_tp_dailymotionCom();
					$result  = $tp->dailymotionComProcessCode($url);
					$video_code  = $result[1];
				} else {
					continue;
				}

				$_POST['video_id'] 	    = 'dailymotion.com,'.$video_code;

			} else if ($row_seyret->videoservertype == "blip.tv") {

				if (file_exists(JPATH_SITE.'/plugins/hwdvs-thirdparty/blip.tv.php')) {
					require_once(JPATH_SITE.'/plugins/hwdvs-thirdparty/blip.tv.php');
					$url = hwd_vs_tools::get_final_url( $row_seyret->videourl );
					$pos_http = strpos($url, "http");
					if ($pos_http === false) {
						$url = 'http://blip.tv'.$url;
					}
					$tp = new hwd_vs_tp_blipTv();
					$result  = $tp->blipTvProcessCode($row_seyret->videourl);
					$video_code  = $result[1];
				} else {
					continue;
				}

				$_POST['video_id'] 	    = 'blip.tv,'.$video_code;


			} else if ($row_seyret->videoservertype == "google") {

				if (file_exists(JPATH_SITE.'/plugins/hwdvs-thirdparty/google.php')) {
					require_once(JPATH_SITE.'/plugins/hwdvs-thirdparty/google.php');
					$url = hwd_vs_tools::get_final_url( $row_seyret->videourl );
					$pos_http = strpos($url, "http");
					if ($pos_http === false) {
						$url = 'http://video.google.com'.$url;
					}
					$tp = new hwd_vs_tp_googleCom();
					$result  = $tp->googleComProcessCode($row_seyret->videourl);
					$video_code  = $result[1];
				} else {
					continue;
				}

				$_POST['video_id'] 	    = 'google.com,'.$video_code;

			} else if ($row_seyret->videoservertype == "vimeo.com") {

				if (file_exists(JPATH_SITE.'/plugins/hwdvs-thirdparty/vimeo.com.php')) {
					require_once(JPATH_SITE.'/plugins/hwdvs-thirdparty/vimeo.com.php');
					$url = hwd_vs_tools::get_final_url( $row_seyret->videourl );
					$pos_http = strpos($url, "http");
					if ($pos_http === false) {
						$url = 'http://vimeo.com'.$url;
					}
					$tp = new hwd_vs_tp_vimeoCom();
					$result  = $tp->vimeoComProcessCode($row_seyret->videourl);
					$video_code  = $result[1];
				} else {
					continue;
				}

				$_POST['video_id'] 	    = 'vimeo.com,'.$video_code;

			} else {
				continue;
			}

			if (empty($row_seyret->playtime)) { $row_seyret->playtime = "00:00"; }

			$_POST['video_type']        = "seyret";
			$_POST['title'] 			= $row_seyret->title;
			$_POST['description'] 		= $row_seyret->itemcomment;
			$_POST['category_id'] 		= $category_id;
			$_POST['tags'] 				= $row_seyret->videotags;
			$_POST['public_private'] 	= "public";
			$_POST['allow_comments'] 	= 1;
			$_POST['allow_embedding'] 	= 1;
			$_POST['allow_ratings'] 	= 1;
			$_POST['video_length'] 		= $row_seyret->playtime;
			$_POST['date_uploaded'] 	= $row_seyret->addeddate;
			$_POST['approved'] 			= "yes";
			$_POST['number_of_views'] 	= $row_seyret->hit;
			$_POST['user_id'] 			= $row_seyret->addedby;
			$_POST['published'] 		= $row_seyret->published;

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

			$counter++;

			// fix for view archive
			if ($row_seyret->hit > 0) {
				$views = new hwdvidslogs_archive($db);

				$_POST['videoid']           = $row->id;
				$_POST['views'] 			= $row->number_of_views;

				// bind it to the table
				if (!$views->bind($_POST)) {
					echo "<script> alert('".$views->getError()."'); window.history.go(-1); </script>\n";
					exit();
				}

				// store it in the db
				if (!$views->store()) {
					echo "<script> alert('".$views -> getError()."'); window.history.go(-1); </script>\n";
					exit();
				}
			}
		}

		$msg = "Successully imported ".$counter." videos";
		$mainframe->enqueueMessage($msg);
		$mainframe->redirect( JURI::root( true ) . '/administrator/index.php?option='.$option.'&task=import' );
	}
	/**
	* Import Data
	*/
	function seyretImportUndo()
	{
		global $mainframe, $option;
		$db = & JFactory::getDBO();

		// import categories
		$db->SetQuery("DELETE FROM #__hwdvidsvideos WHERE video_type = \"seyret\"");
		$db->Query();
		if ( !$db->query() ) {
			echo "<script> alert('".$db->getErrorMsg()."'); window.history.go(-1); </script>\n";
			exit();
		}

		$msg = "Successully removed all video in hwdVideoShare that where originally imported from Seyret";
		$mainframe->enqueueMessage($msg);
		$mainframe->redirect( JURI::root( true ) . '/administrator/index.php?option='.$option.'&task=import' );
	}
	/**
	* Import Data
	*/
	function scanDirectory()
	{
		global $mainframe;
		$c = hwd_vs_Config::get_instance();

		$strDirName = Jrequest::getVar( 'directory', '' );
		if (@$hndDir = opendir($strDirName)) {
			$intCount = 0;
			while (false !== ($strFilename = readdir($hndDir))) {
				if ($strFilename != "." && $strFilename != "..") {
					$file_ext = substr($strFilename, strrpos($strFilename, '.') + 1);

					if ($c->requiredins == 1) {

						if ($file_ext == "mpg" ||
							$file_ext == "mpeg" ||
							$file_ext == "avi" ||
							$file_ext == "divx" ||
							$file_ext == "mp4" ||
							$file_ext == "flv" ||
							$file_ext == "wmv" ||
							$file_ext == "rm" ||
							$file_ext == "mov" ||
							$file_ext == "moov" ||
							$file_ext == "asf" ||
							$file_ext == "swf" ||
							$file_ext == "vob") { $intCount++; }

					} else {

						if ($file_ext == "flv") { $intCount++; }

					}
				}
			}
			closedir($hndDir);
		} else {
			echo "This directory does not exist, or you do not have permission to access it.<br />";
			exit;
			$intCount = 0;
		}

		echo $intCount." videos have been found in this directory.";
		exit;
	}
	/**
	* Import Data
	*/
	function importDirectory()
	{
		global $mainframe, $option;
		$db = & JFactory::getDBO();
		$c = hwd_vs_Config::get_instance();

		$title 				= Jrequest::getVar( 'title', 'Unknown' );
		$description 		= Jrequest::getVar( 'description', 'Unknown' );
		$category_id 		= JRequest::getInt( 'category_id', 0, 'post' );
		$tags 				= Jrequest::getVar( 'tags', 'None', 'post' );
		$public_private 	= JRequest::getWord( 'public_private', 'Public', 'post');
		$allow_comments 	= JRequest::getInt( 'allow_comments', 0, 'post' );
		$allow_embedding 	= JRequest::getInt( 'allow_embedding', 0, 'post' );
		$allow_ratings 		= JRequest::getInt( 'allow_ratings', 0, 'post' );

		if (empty($title)) { $title="Unknown"; }
		if (empty($description)) { $description="Unknown"; }
		if (empty($tags)) { $description="None"; }

		$strDirName = Jrequest::getVar( 'directory', '' );
		if (@$hndDir = opendir($strDirName)) {
			$intCount = 0;
			while (false !== ($strFilename = readdir($hndDir))) {
				if ($strFilename != "." && $strFilename != "..") {
					$file_ext = substr($strFilename, strrpos($strFilename, '.') + 1);

					if ($c->requiredins == "0") {

						if ($file_ext == "flv") {

							$file_video_id = hwd_vs_tools::generateNewVideoid();
							$fileOriginal = $strDirName."/".$strFilename;
							$fileNew      = JPATH_SITE ."/hwdvideos/uploads/".$file_video_id.".flv";

							$_POST['video_id'] 		= $file_video_id;
							if ($c->aav == 1) {
								$_POST['approved'] = "yes";
							} else {
								$_POST['approved'] = "pending";
							}

						} else {

							continue;

						}

					} else {

						if ($file_ext == "flv") {

							$file_video_id = hwd_vs_tools::generateNewVideoid();
							$fileOriginal = $strDirName."/".$strFilename;
							$fileNew      = JPATH_SITE ."/hwdvideos/uploads/originals/".$file_video_id.".".$file_ext;

							$_POST['video_id'] 		= $file_video_id.".".$file_ext;
							$_POST['approved'] 		= "queuedforthumbnail";

						} else if ($file_ext == "mp4") {

							$file_video_id = hwd_vs_tools::generateNewVideoid();
							$fileOriginal = $strDirName."/".$strFilename;
							$fileNew      = JPATH_SITE ."/hwdvideos/uploads/originals/".$file_video_id.".".$file_ext;

							$_POST['video_id'] 		= $file_video_id.".".$file_ext;
							$_POST['approved'] 		= "queuedformp4";

						} else if ($file_ext == "swf") {

							$file_video_id = hwd_vs_tools::generateNewVideoid();
							$fileOriginal = $strDirName."/".$strFilename;
							$fileNew      = JPATH_SITE ."/hwdvideos/uploads/originals/".$file_video_id.".".$file_ext;

							$_POST['video_id'] 		= $file_video_id.".".$file_ext;
							$_POST['approved'] 		= "queuedforswf";

						} else if ($file_ext == "mpg" || $file_ext == "mpeg" || $file_ext == "avi" || $file_ext == "divx" || $file_ext == "wmv" || $file_ext == "rm" || $file_ext == "mov" || $file_ext == "moov" || $file_ext == "asf" || $file_ext == "vob") {

							$file_video_id = hwd_vs_tools::generateNewVideoid();
							$fileOriginal = $strDirName."/".$strFilename;
							$fileNew      = JPATH_SITE ."/hwdvideos/uploads/originals/".$file_video_id.".".$file_ext;

							$_POST['video_id'] 		= $file_video_id.".".$file_ext;
							$_POST['approved'] 		= "queuedforconversion";

						} else {

							continue;

						}

					}

					if (copy($fileOriginal, $fileNew)) {

						$row = new hwdvids_video($db);

						$_POST['video_type'] 		= "local";
						$_POST['title'] 			= $title;
						$_POST['description'] 		= $description;
						$_POST['category_id'] 		= $category_id;
						$_POST['tags'] 				= $tags;
						$_POST['public_private'] 	= $public_private;
						$_POST['allow_comments'] 	= $allow_comments;
						$_POST['allow_embedding'] 	= $allow_embedding;
						$_POST['allow_ratings'] 	= $allow_ratings;
						$_POST['date_uploaded'] 	= date('Y-m-d H:i:s');
						$_POST['user_id'] 			= "0";
						$_POST['published'] 		= "1";
						$_POST['video_length'] 		= "0:00:00";

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
					} else {
						// NO COPY
					}

					$intCount++;

				}
			}
			closedir($hndDir);

		} else {

			$msg = "This directory does not exist, or you do not have permission to access it. No videos have been imported.";
			$mainframe->enqueueMessage($msg);
			$mainframe->redirect( JURI::root( true ) . '/administrator/index.php?option='.$option.'&task=import' );
		}

		// send upload to converter if required
		if ($c->requiredins == 1) {
			if ($c->autoconvert == "direct") {
				@exec("env -i $s->phppath ".HWDVIDSPATH."/converters/converter.php &>/dev/null &");
			} else if ($c->autoconvert == "wget") {
				@exec("env -i $s->wgetpath -O - -q ".$mosConfig_live_site."/components/com_hwdvideoshare/converters/converter.php &>/dev/null &");
			}
		}
		$msg = $intCount." videos have been imported from this server directory.";
		$mainframe->enqueueMessage($msg);
		$mainframe->redirect( JURI::root( true ) . '/administrator/index.php?option='.$option.'&task=import' );

	}
	/**
	* Import Data
	*/
	function thirdPartyImport()
	{
		global $mainframe, $option;
		$db = & JFactory::getDBO();
		$c = hwd_vs_Config::get_instance();

		$video_type	= Jrequest::getVar( 'videotype', '5' );
		$intCount = 0;
		$admin_import = true;
		require_once(JPATH_SITE.DS.'components'.DS.'com_hwdvideoshare'.DS.'models'.DS.'uploads.php');

		if ($video_type == 1 || $video_type == 5) {
		// single third party video

			if (hwd_vs_uploads::addConfirm($option, $admin_import)) {
				$intCount++;
			} else {
				return;
			}

		} else if ($video_type == 2) {
		// youtube playlist

			$requestarray = JRequest::get( 'default', 2 );
			$embeddump = $requestarray['embeddump'];

			$pos = strpos($embeddump, "p=");

			if ($pos === false) {

				return null;

			} else if ($pos) {

				$pos_srt = $pos + 2;
				$pos_end = strpos($embeddump, '&', $pos_srt);
				if ($pos_end === false) {

					$playlist_no =  substr($embeddump, $pos_srt);

				} else {

					$length = $pos_end - $pos_srt;
					$playlist_no =  substr($embeddump, $pos_srt, $length);

				}

				$playlist_no = strip_tags($playlist_no);
				$playlist_no = preg_replace("/[^a-zA-Z0-9s_-]/", "", $playlist_no);

			}

			for ($i = 0; $i <= 4; $i++) {

				$playlist_url = "http://www.youtube.com/view_play_list?p=".$playlist_no."&page=".$i;
				$playlist_url = hwd_vs_tools::get_final_url( $playlist_url );

				$msg = 'Searching page: '.$playlist_url;
				$mainframe->enqueueMessage($msg);

				$curl_handle=curl_init();
				curl_setopt($curl_handle,CURLOPT_URL,$playlist_url);
				curl_setopt($curl_handle,CURLOPT_CONNECTTIMEOUT,2);
				curl_setopt($curl_handle,CURLOPT_RETURNTRANSFER,1);
				$buffer = curl_exec($curl_handle);
				curl_close($curl_handle);

				if (empty($buffer))	{
					return null;
				} else {

					$search_counter = 0;
					$skip_counter = 0;
					$offset = intval(0);
					$duplicate_check = null;

					while ($search_counter <= 39) {

						$pos_track = strpos($buffer, "watch?v=", $offset);
						$pos_code = $pos_track + 8;
						$code = substr($buffer, $pos_code, 11);
						$code = strip_tags($code );
						$code = preg_replace("/[^a-zA-Z0-9s_-]/", "", $code);

						if ($pos_track === false) {
							$search_counter = 100;
							continue;
						} else {
							$offset = intval($pos_track+1);
						}
						if ($offset >= strlen($buffer)) {
							$search_counter = 100;
						}
						if ($code == $duplicate_check) {
							$skip_counter++;
							if ($skip_counter > 100) {
								$search_counter = 100;
								continue;
							} else {
								continue;
							}
						} else {
							$duplicate_check = $code;
						}

						unset ($_REQUEST['embeddump']);
						$_REQUEST['embeddump'] = "http://www.youtube.com/watch?v=".$code;

						if (hwd_vs_uploads::addConfirm($option, $admin_import)) {
							$intCount++;
						} else {
							$mainframe->enqueueMessage(_HWDVIDS_ALERT_DUPLICATE.": ".$code);
						}
						$search_counter++;
					}
				}
			}

		} else if ($video_type == 3) {
		// youtube userlist

			$requestarray = JRequest::get( 'default', 2 );
			$embeddump = $requestarray['embeddump'];

			$pos = strpos($embeddump, "user=");

			if ($pos === false) {

				$pos = strpos($embeddump, "user/");

				if ($pos === false) {

					return null;

				} else if ($pos) {

					$pos_srt = $pos + 5;
					$pos_end = strpos($embeddump, '&', $pos_srt);
					if ($pos_end === false) {

						$username =  substr($embeddump, $pos_srt);

					} else {

						$length = $pos_end - $pos_srt;
						$username =  substr($embeddump, $pos_srt, $length);

					}

					$username = strip_tags($username);
					$username = preg_replace("/[^a-zA-Z0-9s_-]/", "", $username);

				}

			} else if ($pos) {

				$pos_srt = $pos + 5;
				$pos_end = strpos($embeddump, '&', $pos_srt);
				if ($pos_end === false) {

					$username =  substr($embeddump, $pos_srt);

				} else {

					$length = $pos_end - $pos_srt;
					$username =  substr($embeddump, $pos_srt, $length);

				}

				$username = strip_tags($username);
				$username = preg_replace("/[^a-zA-Z0-9s_-]/", "", $username);

			}

			for ($i = 0; $i <= 4; $i++) {

				$i = $i * 20;

				$username_url = "http://www.youtube.com/profile?user=".$username."&view=videos&start=".$i;
				$username_url = hwd_vs_tools::get_final_url( $username_url );

				$msg = 'Searching page: '.$username_url;
				$mainframe->enqueueMessage($msg);

				$curl_handle=curl_init();
				curl_setopt($curl_handle,CURLOPT_URL,$username_url);
				curl_setopt($curl_handle,CURLOPT_CONNECTTIMEOUT,2);
				curl_setopt($curl_handle,CURLOPT_RETURNTRANSFER,1);
				$buffer = curl_exec($curl_handle);
				curl_close($curl_handle);

				if (empty($buffer))	{
					return null;
				} else {

					$search_counter = 0;
					$skip_counter = 0;
					$offset = intval(0);
					$duplicate_check = null;

					while ($search_counter <= 500) {

						$pos_track = strpos($buffer, "watch?v=", $offset);
						$pos_code = $pos_track + 8;
						$code = substr($buffer, $pos_code, 11);
						$code = strip_tags($code );
						$code = preg_replace("/[^a-zA-Z0-9s_-]/", "", $code);
						// echo $code.'<b>'.$search_counter.'</b>'.$skip_counter.'<br />';

						if ($pos_track === false) {
							$search_counter = 1000;
							continue;
						} else {
							$offset = intval($pos_track+1);
						}
						if ($offset >= strlen($buffer)) {
							$search_counter = 1000;
							continue;
						}
						if ($code == $duplicate_check) {
							$skip_counter++;
							if ($skip_counter > 1000) {
								$search_counter = 1000;
								continue;
							} else {
								continue;
							}
						} else {
							$duplicate_check = $code;
						}

						unset ($_REQUEST['embeddump']);
						$_REQUEST['embeddump'] = "http://www.youtube.com/watch?v=".$code;

						if (hwd_vs_uploads::addConfirm($option, $admin_import)) {
							$intCount++;
						} else {
							$mainframe->enqueueMessage(_HWDVIDS_ALERT_DUPLICATE.": ".$code);
						}
						$search_counter++;
					}

				}

			}

		} else if ($video_type == 4) {
		// youtube rss

			$requestarray = JRequest::get( 'default', 2 );
			$embeddump = $requestarray['embeddump'];

			$pos = strpos($embeddump, "http");

			if ($pos === false) {
				$embeddump = 'http://'.$embeddump;
			}

			$pos = strpos($embeddump, "gdata");

			if ($pos === false) {
				$feedurl = "http://www.youtube.com".parse_url($embeddump, PHP_URL_PATH)."?".parse_url($embeddump, PHP_URL_QUERY);
			} else {
				$feedurl = "http://gdata.youtube.com".parse_url($embeddump, PHP_URL_PATH)."?".parse_url($embeddump, PHP_URL_QUERY);
			}

			$curl_handle=curl_init();
			curl_setopt($curl_handle,CURLOPT_URL,$feedurl);
			curl_setopt($curl_handle,CURLOPT_CONNECTTIMEOUT,2);
			curl_setopt($curl_handle,CURLOPT_RETURNTRANSFER,1);
			$buffer = curl_exec($curl_handle);
			curl_close($curl_handle);

			if (empty($buffer))	{
				return null;
			} else {

				$search_counter = 0;
				$skip_counter = 0;
				$offset = intval(0);
				$duplicate_check = null;

				while ($search_counter <= 39) {

				    $pos_track = strpos($buffer, "watch?v=", $offset);
				    $pos_code = $pos_track + 8;
					$code = substr($buffer, $pos_code, 11);
					$code = strip_tags($code );
					$code = preg_replace("/[^a-zA-Z0-9s_-]/", "", $code);

				    if ($pos_track === false) {
				    	$search_counter = 100;
				    	continue;
				    } else {
				    	$offset = intval($pos_track+1);
				    }
				    if ($offset >= strlen($buffer)) {
				    	$search_counter = 100;
				    }
					if ($code == $duplicate_check) {
				    	$skip_counter++;
						if ($skip_counter > 100) {
							$search_counter = 100;
							continue;
						} else {
							continue;
						}
					} else {
						$duplicate_check = $code;
					}

					unset ($_REQUEST['embeddump']);
					$_REQUEST['embeddump'] = "http://www.youtube.com/watch?v=".$code;

					if (hwd_vs_uploads::addConfirm($option, $admin_import)) {
						$intCount++;
					} else {
						$mainframe->enqueueMessage(_HWDVIDS_ALERT_DUPLICATE.": ".$code);
					}
					$search_counter++;
				}
			}
		}

		$msg = $intCount." videos have been imported from the third party website.";
		$mainframe->enqueueMessage($msg);
		$mainframe->redirect( JURI::root( true ) . '/administrator/index.php?option='.$option.'&task=import' );

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