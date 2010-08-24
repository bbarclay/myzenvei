<?php
/**
 * @version		$Id: controller.php 11299 2008-11-22 01:40:44Z ian $
 * @package		Joomla
 * @subpackage	Users
 * @copyright	Copyright (C) 2005 - 2008 Open Source Matters. All rights reserved.
 * @license		GNU/GPL, see LICENSE.php
 * Joomla! is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * See COPYRIGHT.php for copyright notices and details.
 */

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport('joomla.application.component.controller');

/**
 * Users Component Controller
 *
 * @package		Joomla
 * @subpackage	Users
 * @since 1.5
 */
class UsersController extends JController
{
	function frontpage()
	{
				hwdps_fileManagement::checkDirectoryStructure();
				require_once(JPATH_SITE.DS.'administrator'.DS.'components'.DS.'com_hwdphotoshare'.DS.'models'.DS.'frontpage.php');
				hwdps_BE_frontpage::frontpage();
				return;
	}

	function photos() {
				hwdps_fileManagement::checkDirectoryStructure();
				require_once(JPATH_SITE.DS.'administrator'.DS.'components'.DS.'com_hwdphotoshare'.DS.'models'.DS.'photos.php');
				hwdps_BE_photos::showPhotos();
				return;
	}

	function editphotoA() {
				global $cid;
				hwdps_fileManagement::checkDirectoryStructure();
				require_once(JPATH_SITE.DS.'administrator'.DS.'components'.DS.'com_hwdphotoshare'.DS.'models'.DS.'photos.php');
				hwdps_BE_photos::editPhoto($cid);
				return;
	}

	function editphoto() {
				global $cid;
				hwdps_fileManagement::checkDirectoryStructure();
				require_once(JPATH_SITE.DS.'administrator'.DS.'components'.DS.'com_hwdphotoshare'.DS.'models'.DS.'photos.php');
				hwdps_BE_photos::editPhoto($cid[0]);
				return;
	}

	function savephoto() {
				require_once(JPATH_SITE.DS.'administrator'.DS.'components'.DS.'com_hwdphotoshare'.DS.'models'.DS.'photos.php');
				hwdps_BE_photos::savePhoto();
				return;
	}

	function cancelphoto() {
				require_once(JPATH_SITE.DS.'administrator'.DS.'components'.DS.'com_hwdphotoshare'.DS.'models'.DS.'photos.php');
				hwdps_BE_photos::cancelPhoto();
				return;
	}

	function publish() {
				global $cid;
				require_once(JPATH_SITE.DS.'administrator'.DS.'components'.DS.'com_hwdphotoshare'.DS.'models'.DS.'photos.php');
				hwdps_BE_photos::publishPhoto( $cid, 1 );
				return;
	}

  	function unpublish() {
				global $cid;
				require_once(JPATH_SITE.DS.'administrator'.DS.'components'.DS.'com_hwdphotoshare'.DS.'models'.DS.'photos.php');
				hwdps_BE_photos::publishPhoto( $cid, 0 );
				return;
	}

	function featurephoto() {
				global $cid;
				require_once(JPATH_SITE.DS.'administrator'.DS.'components'.DS.'com_hwdphotoshare'.DS.'models'.DS.'photos.php');
				hwdps_BE_photos::featurePhoto( $cid, 1 );
				return;
	}

  	function unfeaturephoto() {
				global $cid;
				require_once(JPATH_SITE.DS.'administrator'.DS.'components'.DS.'com_hwdphotoshare'.DS.'models'.DS.'photos.php');
				hwdps_BE_photos::featurePhoto( $cid, 0 );
				return;
	}

	function deletephoto() {
				global $cid;
				require_once(JPATH_SITE.DS.'administrator'.DS.'components'.DS.'com_hwdphotoshare'.DS.'models'.DS.'photos.php');
				hwdps_BE_photos::deletePhoto($cid);
				return;
	}

	function order_photo_up() {
				global $cid;
				require_once(JPATH_SITE.DS.'administrator'.DS.'components'.DS.'com_hwdphotoshare'.DS.'models'.DS.'photos.php');
        		hwdps_BE_photos::orderForum($cid[0], -1);
				return;
	}

	function order_photo_down() {
				global $cid;
				require_once(JPATH_SITE.DS.'administrator'.DS.'components'.DS.'com_hwdphotoshare'.DS.'models'.DS.'photos.php');
        		hwdps_BE_photos::orderForum($cid[0], 1);
        		return;
	}

	function changePhotoUserSelect() {
				global $cid;
				require_once(JPATH_SITE.DS.'administrator'.DS.'components'.DS.'com_hwdphotoshare'.DS.'models'.DS.'photos.php');
        		hwdps_BE_photos::changePhotoUserSelect($cid);
        		return;

	}

	function albums() {
				hwdps_fileManagement::checkDirectoryStructure();
				require_once(JPATH_SITE.DS.'administrator'.DS.'components'.DS.'com_hwdphotoshare'.DS.'models'.DS.'albums.php');
				hwdps_BE_albums::showAlbums();
				return;
	}

	function editalbumA() {
				global $cid;
				hwdps_fileManagement::checkDirectoryStructure();
				require_once(JPATH_SITE.DS.'administrator'.DS.'components'.DS.'com_hwdphotoshare'.DS.'models'.DS.'albums.php');
				hwdps_BE_albums::editAlbum($cid);
				return;
	}

	function editalbum() {
				global $cid;
				hwdps_fileManagement::checkDirectoryStructure();
				require_once(JPATH_SITE.DS.'administrator'.DS.'components'.DS.'com_hwdphotoshare'.DS.'models'.DS.'albums.php');
				hwdps_BE_albums::editAlbum($cid[0]);
				return;
	}

	function savealbum() {
				require_once(JPATH_SITE.DS.'administrator'.DS.'components'.DS.'com_hwdphotoshare'.DS.'models'.DS.'albums.php');
				hwdps_BE_albums::saveAlbum();
				return;
	}

	function cancelalbum() {
				require_once(JPATH_SITE.DS.'administrator'.DS.'components'.DS.'com_hwdphotoshare'.DS.'models'.DS.'albums.php');
				hwdps_BE_albums::cancelAlbum();
				return;
	}

	function publishalbum() {
				global $cid;
				require_once(JPATH_SITE.DS.'administrator'.DS.'components'.DS.'com_hwdphotoshare'.DS.'models'.DS.'albums.php');
				hwdps_BE_albums::publishAlbum( $cid, 1 );
				return;
	}

  	function unpublishalbum() {
				global $cid;
				require_once(JPATH_SITE.DS.'administrator'.DS.'components'.DS.'com_hwdphotoshare'.DS.'models'.DS.'albums.php');
				hwdps_BE_albums::publishAlbum( $cid, 0 );
				return;
	}

	function featurealbum() {
				global $cid;
				require_once(JPATH_SITE.DS.'administrator'.DS.'components'.DS.'com_hwdphotoshare'.DS.'models'.DS.'albums.php');
				hwdps_BE_albums::featureAlbum( $cid, 1 );
				return;
	}

  	function unfeaturealbum() {
				global $cid;
				require_once(JPATH_SITE.DS.'administrator'.DS.'components'.DS.'com_hwdphotoshare'.DS.'models'.DS.'albums.php');
				hwdps_BE_albums::featureAlbum( $cid, 0 );
				return;
	}

	function deletealbum() {
				global $cid;
				require_once(JPATH_SITE.DS.'administrator'.DS.'components'.DS.'com_hwdphotoshare'.DS.'models'.DS.'albums.php');
				hwdps_BE_albums::deleteAlbum($cid);
				return;
	}

	function order_album_up() {
				global $cid;
				require_once(JPATH_SITE.DS.'administrator'.DS.'components'.DS.'com_hwdphotoshare'.DS.'models'.DS.'albums.php');
        		hwdps_BE_albums::orderForum($cid[0], -1);
				return;
	}

	function order_album_down() {
				global $cid;
				require_once(JPATH_SITE.DS.'administrator'.DS.'components'.DS.'com_hwdphotoshare'.DS.'models'.DS.'albums.php');
        		hwdps_BE_albums::orderForum($cid[0], 1);
        		return;
	}

	function changeAlbumUserSelect() {
				global $cid;
				require_once(JPATH_SITE.DS.'administrator'.DS.'components'.DS.'com_hwdphotoshare'.DS.'models'.DS.'albums.php');
        		hwdps_BE_albums::changeAlbumUserSelect($cid);
        		return;
	}

	function categories() {
				hwdps_fileManagement::checkDirectoryStructure();
				require_once(JPATH_SITE.DS.'administrator'.DS.'components'.DS.'com_hwdphotoshare'.DS.'models'.DS.'categories.php');
				hwdps_BE_cats::showcategories();
				return;
	}

	function editcatA() {
				global $cid;
				hwdps_fileManagement::checkDirectoryStructure();
				require_once(JPATH_SITE.DS.'administrator'.DS.'components'.DS.'com_hwdphotoshare'.DS.'models'.DS.'categories.php');
				hwdps_BE_cats::editcategories($cid);
				return;
	}

	function editcat() {
				global $cid;
				hwdps_fileManagement::checkDirectoryStructure();
				require_once(JPATH_SITE.DS.'administrator'.DS.'components'.DS.'com_hwdphotoshare'.DS.'models'.DS.'categories.php');
				hwdps_BE_cats::editcategories($cid[0]);
				return;
	}

	function newcat() {
				hwdps_fileManagement::checkDirectoryStructure();
				require_once(JPATH_SITE.DS.'administrator'.DS.'components'.DS.'com_hwdphotoshare'.DS.'models'.DS.'categories.php');
				hwdps_BE_cats::editcategories(0);
				return;
	}

	function savecat() {
				require_once(JPATH_SITE.DS.'administrator'.DS.'components'.DS.'com_hwdphotoshare'.DS.'models'.DS.'categories.php');
				hwdps_BE_cats::savecategories();
				return;
	}

	function cancelcat() {
				require_once(JPATH_SITE.DS.'administrator'.DS.'components'.DS.'com_hwdphotoshare'.DS.'models'.DS.'categories.php');
				hwdps_BE_cats::cancelcat();
				return;
	}

	function deletecat() {
				global $cid;
				require_once(JPATH_SITE.DS.'administrator'.DS.'components'.DS.'com_hwdphotoshare'.DS.'models'.DS.'categories.php');
				hwdps_BE_cats::deletecategories($cid);
				return;
	}

	function publishcat() {
				global $cid;
				require_once(JPATH_SITE.DS.'administrator'.DS.'components'.DS.'com_hwdphotoshare'.DS.'models'.DS.'categories.php');
				hwdps_BE_cats::publishcategory( $cid, 1 );
				return;
	}

  	function unpublishcat() {
				global $cid;
				require_once(JPATH_SITE.DS.'administrator'.DS.'components'.DS.'com_hwdphotoshare'.DS.'models'.DS.'categories.php');
				hwdps_BE_cats::publishcategory( $cid, 0 );
				return;
	}

	function orderup() {
				global $cid;
				require_once(JPATH_SITE.DS.'administrator'.DS.'components'.DS.'com_hwdphotoshare'.DS.'models'.DS.'categories.php');
        		hwdps_BE_cats::orderForum($cid[0], -1);
				return;
	}

	function orderdown() {
				global $cid;
				require_once(JPATH_SITE.DS.'administrator'.DS.'components'.DS.'com_hwdphotoshare'.DS.'models'.DS.'categories.php');
        		hwdps_BE_cats::orderForum($cid[0], 1);
        		return;

	}

	function groups() {
				hwdps_fileManagement::checkDirectoryStructure();
				require_once(JPATH_SITE.DS.'administrator'.DS.'components'.DS.'com_hwdphotoshare'.DS.'models'.DS.'groups.php');
				hwdps_BE_groups::showgroups();
				return;
	}

	function editgrpA() {
				global $cid;
				hwdps_fileManagement::checkDirectoryStructure();
				require_once(JPATH_SITE.DS.'administrator'.DS.'components'.DS.'com_hwdphotoshare'.DS.'models'.DS.'groups.php');
				hwdps_BE_groups::editgroups($cid);
				return;
	}

	function editgrp() {
				global $cid;
				hwdps_fileManagement::checkDirectoryStructure();
				require_once(JPATH_SITE.DS.'administrator'.DS.'components'.DS.'com_hwdphotoshare'.DS.'models'.DS.'groups.php');
				hwdps_BE_groups::editgroups($cid[0]);
				return;
	}

	function savegrp() {
				require_once(JPATH_SITE.DS.'administrator'.DS.'components'.DS.'com_hwdphotoshare'.DS.'models'.DS.'groups.php');
				hwdps_BE_groups::savegroup();
				return;
	}

	function cancelgrp() {
				require_once(JPATH_SITE.DS.'administrator'.DS.'components'.DS.'com_hwdphotoshare'.DS.'models'.DS.'groups.php');
				hwdps_BE_groups::cancelgrp();
				return;
	}

	function publishg() {
				global $cid;
				require_once(JPATH_SITE.DS.'administrator'.DS.'components'.DS.'com_hwdphotoshare'.DS.'models'.DS.'groups.php');
				hwdps_BE_groups::publishg( $cid, 1 );
				return;
	}

	function unpublishg() {
				global $cid;
				require_once(JPATH_SITE.DS.'administrator'.DS.'components'.DS.'com_hwdphotoshare'.DS.'models'.DS.'groups.php');
				hwdps_BE_groups::publishg( $cid, 0 );
				return;
	}

	function featureg() {
				global $cid;
				require_once(JPATH_SITE.DS.'administrator'.DS.'components'.DS.'com_hwdphotoshare'.DS.'models'.DS.'groups.php');
				hwdps_BE_groups::featureg( $cid, 1 );
				return;
	}

  	function unfeatureg() {
				global $cid;
				require_once(JPATH_SITE.DS.'administrator'.DS.'components'.DS.'com_hwdphotoshare'.DS.'models'.DS.'groups.php');
				hwdps_BE_groups::featureg( $cid, 0 );
				return;
	}

	function deletegroups() {
				global $cid;
				require_once(JPATH_SITE.DS.'administrator'.DS.'components'.DS.'com_hwdphotoshare'.DS.'models'.DS.'groups.php');
				hwdps_BE_groups::deletegroups($cid);
				return;

	}

	function generalsettings() {
				hwdps_fileManagement::checkDirectoryStructure();
				require_once(JPATH_SITE.DS.'administrator'.DS.'components'.DS.'com_hwdphotoshare'.DS.'models'.DS.'settings.php');
				hwdps_BE_settings::showgeneralsettings();
				return;
	}

	function savegeneral() {
				require_once(JPATH_SITE.DS.'administrator'.DS.'components'.DS.'com_hwdphotoshare'.DS.'models'.DS.'settings.php');
				hwdps_BE_settings::savegeneral();
				return;
	}

	function resizemain() {
				hwd_ps_tools::resizeMainImages();
				mosRedirect('index.php?option=com_hwdphotoshare&task=generalsettings', _HWDPS_ALERT_ADMIN_SETNOTSAVED);
				return;
	}

	function resizethumb() {
				hwd_ps_tools::resizeThumbnailImages();
				mosRedirect('index.php?option=com_hwdphotoshare&task=generalsettings', _HWDPS_ALERT_ADMIN_SETNOTSAVED);
				return;
	}

	function resizesquare() {
				hwd_ps_tools::resizeSquareImages();
				mosRedirect('index.php?option=com_hwdphotoshare&task=generalsettings', _HWDPS_ALERT_ADMIN_SETNOTSAVED);
				return;

	}

	function approvals() {
				hwdps_fileManagement::checkDirectoryStructure();
				require_once(JPATH_SITE.DS.'administrator'.DS.'components'.DS.'com_hwdphotoshare'.DS.'models'.DS.'approvals.php');
				hwdps_BE_approvals::showapprovals();
				return;
	}

	function approvephoto() {
				global $cid;
				require_once(JPATH_SITE.DS.'administrator'.DS.'components'.DS.'com_hwdphotoshare'.DS.'models'.DS.'approvals.php');
				hwdps_BE_approvals::approvePhoto( $cid, 1 );
				return;
	}

	function approvealbum() {
				global $cid;
				require_once(JPATH_SITE.DS.'administrator'.DS.'components'.DS.'com_hwdphotoshare'.DS.'models'.DS.'approvals.php');
				hwdps_BE_approvals::approveAlbum( $cid, 1 );
				return;
	}

	function reported() {
				hwdps_fileManagement::checkDirectoryStructure();
				require_once(JPATH_SITE.DS.'administrator'.DS.'components'.DS.'com_hwdphotoshare'.DS.'models'.DS.'reported.php');
				hwdps_BE_flagged::showflagged();
				return;
	}

	function maintenance() {
				hwdps_fileManagement::checkDirectoryStructure();
				require_once(JPATH_SITE.DS.'administrator'.DS.'components'.DS.'com_hwdphotoshare'.DS.'models'.DS.'maintenance.php');
				hwdps_BE_maintenance::maintenance();
				return;
	}

	function runmaintenance() {
				require_once(JPATH_SITE.DS.'administrator'.DS.'components'.DS.'com_hwdphotoshare'.DS.'models'.DS.'maintenance.php');
				hwdps_BE_maintenance::runmaintenance();
				return;

	}

	function plugins() {
				require_once(JPATH_SITE.DS.'administrator'.DS.'components'.DS.'com_hwdphotoshare'.DS.'models'.DS.'plugins.php');
				hwdps_BE_plugins::plugins();
				return;
	}

	function import() {
				hwdps_fileManagement::checkDirectoryStructure();
				require_once(JPATH_SITE.DS.'administrator'.DS.'components'.DS.'com_hwdphotoshare'.DS.'models'.DS.'imports.php');
				hwdps_BE_imports::import();
				return;

	}

	function export() {
				hwdps_fileManagement::checkDirectoryStructure();
				require_once(JPATH_SITE.DS.'administrator'.DS.'components'.DS.'com_hwdphotoshare'.DS.'models'.DS.'exports.php');
				hwdps_BE_exports::backuptables();
				return;
	}

	function botJombackup() {
				hwdps_fileManagement::checkDirectoryStructure();
				require_once(JPATH_SITE.DS.'administrator'.DS.'components'.DS.'com_hwdphotoshare'.DS.'models'.DS.'exports.php');
				hwdps_BE_exports::botJombackup();
				return;


	}

	function cleartemplatecache() {
				require_once(JPATH_SITE.DS.'administrator'.DS.'components'.DS.'com_hwdphotoshare'.DS.'models'.DS.'maintenance.php');
				hwdps_BE_maintenance::clearTemplateCache();
				return;
	}
}
?>