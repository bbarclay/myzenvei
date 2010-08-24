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

require_once( $mainframe->getPath( 'toolbar_html' ) );

switch ( $task ) {

		case "homepage":
		hwdpsmenu::HOMEPAGE_MENU();
		break;

		case "photos":
    	hwdpsmenu::PHOTO_MENU();
    	break;

		case "editphotoA":
		case "editphoto":
		hwdpsmenu::EDITPHOTO_MENU();
		break;

		case "albums":
    	hwdpsmenu::ALBUM_MENU();
    	break;

		case "editalbumA":
		case "editalbum":
		hwdpsmenu::EDITALBUM_MENU();
		break;

		case "categories":
    	hwdpsmenu::CAT_MENU();
    	break;

		case "editcatA":
		case "editcat":
		case "newcat":
		hwdpsmenu::EDITCAT_MENU();
		break;

		case "groups":
    	hwdpsmenu::GROUPS_MENU();
    	break;

		case "editgrpA":
		case "editgrp":
		hwdpsmenu::EDITGRP_MENU();
		break;

		case "approvals":
		case "watchvideo":
    	hwdpsmenu::APPROVE_MENU();
    	break;

		case "watchflaggedvideo":
		case "flagged":
		case "remoteupload":
		case "ftpupload":
		case "ftpupload_result":
		case "botJombackup":
		hwdpsmenu::INFO_MENU();
		break;

		case "serversettings":
    	hwdpsmenu::SSETTINGS_MENU();
    	break;

		case "generalsettings":
    	hwdpsmenu::GSETTINGS_MENU();
    	break;

		case "export":
    	hwdpsmenu::EXPORT_MENU();
    	break;

		case "import":
    	hwdpsmenu::IMPORT_MENU();
    	break;

		case "runmaintenance":
		case "maintenance":
    	hwdpsmenu::MAINTENANCE_MENU();
    	break;

		case 'plugins':
		case 'savePlugin':
		case 'applyPlugin':
		case 'deletePlugin':
		case 'cancelPlugin':
		case 'publishPlugin':
		case 'unpublishPlugin':
		case 'orderupPlugin':
		case 'orderdownPlugin':
		case 'accesspublic':
		case 'accessregistered':
		case 'accessspecial':
		case 'savepluginorder':
		case 'showPlugins':
		case 'pluginmenu':
		case 'templates':
		hwdpsmenu::_DEFAULT_PLUGIN();
		break;

		case 'editPlugin':
		hwdpsmenu::_EDIT_PLUGIN();
		break;

		default:
		hwdpsmenu::HOMEPAGE_MENU();
		break;
	}
?>