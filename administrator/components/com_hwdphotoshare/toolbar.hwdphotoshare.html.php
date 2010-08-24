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

class hwdpsmenu {

	function HOMEPAGE_MENU()
	{
        JToolBarHelper::title( _HWDPS_TOOLBARTITLE, 'logo' );
		JToolBarHelper::custom('homepage', 'help.png', 'help_f2.png', _HWDPS_TOOLBAR_HOME, false);
	}

	function PHOTO_MENU()
	{
        JToolBarHelper::title( _HWDPS_TOOLBARTITLE, 'logo' );
		JToolBarHelper::publishList();
		JToolBarHelper::spacer();
		JToolBarHelper::unpublishList();
		JToolBarHelper::spacer();
		JToolBarHelper::custom('featurephoto', 'publish.png', 'publish_f2.png', _HWDPS_TOOLBAR_FEATURE, false);
		JToolBarHelper::spacer();
		JToolBarHelper::custom('unfeaturephoto', 'unpublish.png', 'unpublish_f2.png', _HWDPS_TOOLBAR_UNFEATURE, false);
		JToolBarHelper::spacer();
		JToolBarHelper::editListX('editphoto', _HWDPS_TOOLBAR_EDIT);
		JToolBarHelper::spacer();
		JToolBarHelper::deleteList(_HWDPS_INFO_CONFIRMBACKPDEL, 'deletephoto', _HWDPS_TOOLBAR_REMOVE);
		JToolBarHelper::spacer();
		JToolBarHelper::custom('homepage', 'help.png', 'help_f2.png', _HWDPS_TOOLBAR_HOME, false);
	}

	function EDITPHOTO_MENU()
	{
        JToolBarHelper::title( _HWDPS_TOOLBARTITLE, 'logo' );
		JToolBarHelper::save('savephoto');
		JToolBarHelper::spacer();
		JToolBarHelper::cancel('cancelphoto');
		JToolBarHelper::spacer();
		JToolBarHelper::custom('homepage', 'help.png', 'help_f2.png', _HWDPS_TOOLBAR_HOME, false);
	}

	function ALBUM_MENU()
	{
        JToolBarHelper::title( _HWDPS_TOOLBARTITLE, 'logo' );
		JToolBarHelper::custom('publishalbum', 'publish.png', 'publish_f2.png', _HWDPS_TOOLBAR_PUBLISH, false);
		JToolBarHelper::spacer();
		JToolBarHelper::custom('unpublishalbum', 'unpublish.png', 'unpublish_f2.png', _HWDPS_TOOLBAR_UNPUBLISH, false);
		JToolBarHelper::spacer();
		JToolBarHelper::custom('featurealbum', 'publish.png', 'publish_f2.png', _HWDPS_TOOLBAR_FEATURE, false);
		JToolBarHelper::spacer();
		JToolBarHelper::custom('unfeaturealbum', 'unpublish.png', 'unpublish_f2.png', _HWDPS_TOOLBAR_UNFEATURE, false);
		JToolBarHelper::spacer();
		JToolBarHelper::editListX('editalbum', _HWDPS_TOOLBAR_EDIT);
		JToolBarHelper::spacer();
		JToolBarHelper::deleteList(_HWDPS_INFO_CONFIRMBACKADEL, 'deletealbum', _HWDPS_TOOLBAR_REMOVE);
		JToolBarHelper::spacer();
		JToolBarHelper::custom('homepage', 'help.png', 'help_f2.png', _HWDPS_TOOLBAR_HOME, false);
	}

	function EDITALBUM_MENU()
	{
        JToolBarHelper::title( _HWDPS_TOOLBARTITLE, 'logo' );
		JToolBarHelper::save('savealbum');
		JToolBarHelper::spacer();
		JToolBarHelper::cancel('cancelalbum');
		JToolBarHelper::spacer();
		JToolBarHelper::custom('homepage', 'help.png', 'help_f2.png', _HWDPS_TOOLBAR_HOME, false);
	}

	function CAT_MENU()
	{
        JToolBarHelper::title( _HWDPS_TOOLBARTITLE, 'logo' );
		JToolBarHelper::custom('publishcat', 'publish.png', 'publish_f2.png', _HWDPS_TOOLBAR_PUBLISH, false);
		JToolBarHelper::spacer();
		JToolBarHelper::custom('unpublishcat', 'unpublish.png', 'unpublish_f2.png', _HWDPS_TOOLBAR_UNPUBLISH, false);
		JToolBarHelper::spacer();
		JToolBarHelper::addNewX('newcat');
		JToolBarHelper::spacer();
		JToolBarHelper::editListX('editcat', _HWDPS_TOOLBAR_EDIT);
		JToolBarHelper::spacer();
		JToolBarHelper::deleteList(_HWDPS_INFO_CONFIRMBACKCDEL, 'deletecat', _HWDPS_TOOLBAR_REMOVE);
		JToolBarHelper::spacer();
		JToolBarHelper::custom('homepage', 'help.png', 'help_f2.png', _HWDPS_TOOLBAR_HOME, false);
	}

	function EDITCAT_MENU()
	{
        JToolBarHelper::title( _HWDPS_TOOLBARTITLE, 'logo' );
		JToolBarHelper::save('savecat');
		JToolBarHelper::spacer();
		JToolBarHelper::cancel('cancelcat');
		JToolBarHelper::spacer();
		JToolBarHelper::custom('homepage', 'help.png', 'help_f2.png', _HWDPS_TOOLBAR_HOME, false);
	}

	function GROUPS_MENU()
	{
        JToolBarHelper::title( _HWDPS_TOOLBARTITLE, 'logo' );
		JToolBarHelper::custom('publishg', 'publish.png', 'publish_f2.png', _HWDPS_TOOLBAR_PUBLISH, false);
		JToolBarHelper::spacer();
		JToolBarHelper::custom('unpublishg', 'unpublish.png', 'unpublish_f2.png', _HWDPS_TOOLBAR_UNPUBLISH, false);
		JToolBarHelper::spacer();
		JToolBarHelper::custom('featureg', 'publish.png', 'publish_f2.png', _HWDPS_TOOLBAR_FEATURE, false);
		JToolBarHelper::spacer();
		JToolBarHelper::custom('unfeatureg', 'unpublish.png', 'unpublish_f2.png', _HWDPS_TOOLBAR_UNFEATURE, false);
		JToolBarHelper::spacer();
		JToolBarHelper::editListX('editgrp', _HWDPS_TOOLBAR_EDIT);
		JToolBarHelper::spacer();
		JToolBarHelper::deleteList(_HWDPS_INFO_CONFIRMBACKGDEL, 'deletegroups', _HWDPS_TOOLBAR_DELETE);
		JToolBarHelper::spacer();
		JToolBarHelper::custom('homepage', 'help.png', 'help_f2.png', _HWDPS_TOOLBAR_HOME, false);
	}

	function EDITGRP_MENU()
	{
        JToolBarHelper::title( _HWDPS_TOOLBARTITLE, 'logo' );
		JToolBarHelper::save('savegrp');
		JToolBarHelper::spacer();
		JToolBarHelper::cancel('cancelgrp');
		JToolBarHelper::spacer();
		JToolBarHelper::custom('homepage', 'help.png', 'help_f2.png', _HWDPS_TOOLBAR_HOME, false);
	}

	function APPROVE_MENU()
	{
        JToolBarHelper::title( _HWDPS_TOOLBARTITLE, 'logo' );
		JToolBarHelper::back();
		JToolBarHelper::spacer();
		JToolBarHelper::custom('approvephoto', 'publish.png', 'publish_f2.png', _HWDPS_TOOLBAR_APPROVEP, false);
		JToolBarHelper::spacer();
		JToolBarHelper::deleteList(_HWDPS_INFO_CONFIRMBACKPDEL, 'deletephoto', 'Delete Photo');
		JToolBarHelper::spacer();
		JToolBarHelper::custom('approvealbum', 'publish.png', 'publish_f2.png', _HWDPS_TOOLBAR_APPROVEA, false);
		JToolBarHelper::spacer();
		JToolBarHelper::deleteList(_HWDPS_INFO_CONFIRMBACKPDEL, 'deletealbum', 'Delete Album');
		JToolBarHelper::spacer();
		JToolBarHelper::custom('homepage', 'help.png', 'help_f2.png', _HWDPS_TOOLBAR_HOME, false);
	}

	function GSETTINGS_MENU()
	{
        JToolBarHelper::title( _HWDPS_TOOLBARTITLE, 'logo' );
		JToolBarHelper::save('savegeneral');
		JToolBarHelper::spacer();
		JToolBarHelper::cancel('cancel');
		JToolBarHelper::spacer();
		JToolBarHelper::custom('homepage', 'help.png', 'help_f2.png', _HWDPS_TOOLBAR_HOME, false);
	}

	function MAINTENANCE_MENU()
	{
        JToolBarHelper::title( _HWDPS_TOOLBARTITLE, 'logo' );
		JToolBarHelper::back();
		JToolBarHelper::spacer();
		JToolBarHelper::custom('runmaintenance', 'config.png', 'config_f2.png', _HWDPS_TOOLBAR_RUN, false);
		JToolBarHelper::spacer();
		JToolBarHelper::custom('homepage', 'help.png', 'help_f2.png', _HWDPS_TOOLBAR_HOME, false);
	}

	function INFO_MENU()
	{
        JToolBarHelper::title( _HWDPS_TOOLBARTITLE, 'logo' );
		JToolBarHelper::back();
		JToolBarHelper::spacer();
		JToolBarHelper::custom('homepage', 'help.png', 'help_f2.png', _HWDPS_TOOLBAR_HOME, false);
	}

	function EXPORT_MENU()
	{
        JToolBarHelper::title( _HWDPS_TOOLBARTITLE, 'logo' );
		JToolBarHelper::custom('botJombackup', 'archive.png', 'archive_f2.png', _HWDPS_TOOLBAR_BKUP, false);
		JToolBarHelper::spacer();
		JToolBarHelper::cancel();
		JToolBarHelper::spacer();
		JToolBarHelper::custom('homepage', 'help.png', 'help_f2.png', _HWDPS_TOOLBAR_HOME, false);
	}

	function IMPORT_MENU()
	{
        JToolBarHelper::title( _HWDPS_TOOLBARTITLE, 'logo' );
		JToolBarHelper::cancel();
		JToolBarHelper::spacer();
		JToolBarHelper::custom('homepage', 'help.png', 'help_f2.png', _HWDPS_TOOLBAR_HOME, false);
	}


	function _DEFAULT_PLUGIN() {
        JToolBarHelper::title( _HWDPS_TOOLBARTITLE, 'logo' );
		JToolBarHelper::publishList('publishPlugin');
		JToolBarHelper::spacer();
		JToolBarHelper::unpublishList('unpublishPlugin');
		// JToolBarHelper::spacer();
		// JToolBarHelper::   "addInstall" link ('newPlugin');
/*
		JToolBarHelper::spacer();
		if (is_callable(array("JToolBarHelper","addNewX"))) {		// Mambo 4.5.0 support:
			JToolBarHelper::addNewX('newPlugin');
		} else {
			JToolBarHelper::addNew('newPlugin');
		}
*/
		JToolBarHelper::spacer();
		JToolBarHelper::deleteList(_HWDPS_INFO_CONFIRMBACKPDEL, 'deletePlugin', _HWDPS_TOOLBAR_UNINSTALL);
		JToolBarHelper::spacer();
		JToolBarHelper::spacer();
		JToolBarHelper::custom('homepage', 'help.png', 'help_f2.png', _HWDPS_TOOLBAR_HOME, false);
	}

	function _EDIT_PLUGIN() {
        JToolBarHelper::title( _HWDPS_TOOLBARTITLE, 'logo' );
		JToolBarHelper::save('savePlugin');
		JToolBarHelper::spacer();
		JToolBarHelper::cancel('cancelPlugin');
		JToolBarHelper::spacer();
		JToolBarHelper::custom('homepage', 'help.png', 'help_f2.png', _HWDPS_TOOLBAR_HOME, false);
	}

}
?>