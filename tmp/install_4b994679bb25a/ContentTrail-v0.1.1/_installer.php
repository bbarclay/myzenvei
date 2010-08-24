<?php
/**
 * @author     GeoXeo <contact@geoxeo.com>
 * @link       http://www.geoxeo.com
 * @copyright  Copyright (C) 2010 GeoXeo - All Rights Reserved
 * @license    http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 * 
 */

// No direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

global $mainframe;

// Create database object
$_db = &JFactory::getDBO();

// Load language for messaging
$_lang =& JFactory::getLanguage();
$_lang->load( 'com_geoxeo-installer-uninstallme' );

$_ext = 'The extension(s)';
$_states = array();
$_has_installed = 0;
$_has_updated = 0;

$_install_file = dirname( __FILE__ ).DS.'extensions.php';
if ( !is_readable ( $_install_file ) ) {
	$mainframe->enqueueMessage( sprintf( JText::_( 'Cannot find/read the required installation file' ), $_install_file ), 'error' );
} else {
	require_once( $_install_file );
	if ( is_array( $_states ) ) {
		foreach ( $_states as $_state ) {
			if ( $_state == 1 ) {
				$_has_installed = 1;
			} else if ( $_state == 2 ) {
				$_has_updated = 1;
			}
		}
	}
	if ( !$_has_installed && !$_has_updated ) {
		$mainframe->enqueueMessage( JText::_( 'Something has gone wrong during installation of the database records' ), 'error' );
	} else {
		$_comp_folder = JPATH_ADMINISTRATOR.DS.'components'.DS.'com_geoxeo-installer-uninstallme';
	 	$_update_folder = $_comp_folder.DS.'files';

		if ( !is_dir ( $_update_folder ) ) {
			$mainframe->enqueueMessage( sprintf( JText::_( 'Could not extract the files package' ), $_zip_file ), 'error' );
		} else {
			// Copy files
			$_folders = JFolder::folders( $_update_folder );
			while ( $_folders['0'] == 'files' ) {
				$_update_folder .= DS.$_folders['0'];
				$_folders = JFolder::folders( $_update_folder );
			}
			$_succes = 1;
			foreach ( $_folders as $_subfolder ) {
				if ( !folder_copy( $_update_folder.DS.$_subfolder, JPATH_SITE.DS.$_subfolder ) ) {
					$_succes = 0;
				}
			}

			if ( $_succes ) {
				$_txt_installed = ( $_has_installed ) ? JText::_( 'installed' ) : '';
				$_txt_installed .= ( $_has_installed && $_has_updated ) ? ' / ' : '';
				$_txt_installed .= ( $_has_updated ) ? JText::_( 'updated' ) : '';
				$mainframe->enqueueMessage( sprintf( JText::_( 'The extension(s) has been installed/updated successfully' ), JText::_( $_ext ), $_txt_installed ), 'message' );
			} else {
				$mainframe->enqueueMessage( JText::_( 'Could not copy all files' ), 'error' );
			}
		}
	}
}

// uninstall the installer
if ( !uninstallInstaller() ) {
	$mainframe->enqueueMessage( JText::_( 'Could not uninstall the GeoXeo-installer' ), 'notice' );
}

// Redirect with message
$mainframe->redirect( 'index.php?option=com_installer' );

/**
 * Copy a folder.
 */
function folder_copy( $src, $dest )
{
	global $mainframe;

	// Initialize variables
	jimport( 'joomla.client.helper' );
	$ftpOptions = JClientHelper::getCredentials( 'ftp' );

	// Eliminate trailing directory separators, if any
	$src = rtrim( $src, DS );
	$dest = rtrim( $dest, DS );

	if ( !JFolder::exists( $src ) ) {
		return 0;
	}

	$succes = 1;

	// Make sure the destination exists
	if ( !JFolder::exists( $dest ) && !folder_create( $dest ) ) {
		$_folder = str_replace( JPATH_ROOT, '', $dest );
		$mainframe->enqueueMessage( JText::_( 'Failed to create directory' ).': '.$_folder, 'error error_folders' );
		$succes = 0;
	}

	if ( !( $dh = @opendir( $src ) ) ) {
		return 0;
	}

	$folders = array();
	$files = array();
	while ( ( $file = readdir( $dh ) ) !== false ) {
		if ( $file != '.' && $file != '..' ) {
			$_src = $src.DS.$file;
			switch ( filetype( $_src ) ) {
				case 'dir':
					$folders[] = $file;
					break;
				case 'file':
					$files[] = $file;
					break;
			}
		}
	}
	sort( $folders );
	sort( $files );

	// Walk through the directory recursing into folders
	foreach ( $folders as $folder ) {
		$_src = $src.DS.$folder;
		$_dest = $dest.DS.$folder;
		if ( !folder_copy( $_src, $_dest  ) ) {
			$succes = 0;
		}
	}

	if ( $ftpOptions['enabled'] == 1 ) {
		// Connect the FTP client
		jimport( 'joomla.client.ftp' );
		$ftp = &JFTP::getInstance(
			$ftpOptions['host'], $ftpOptions['port'], null,
			$ftpOptions['user'], $ftpOptions['pass']
		);

		// Walk through the directory copying files
		foreach ( $files as $file ) {
			$_src = $src.DS.$file;
			$_dest = $dest.DS.$file;
			// Translate path for the FTP account
			$_dest = JPath::clean( str_replace( JPATH_ROOT, $ftpOptions['root'], $_dest ), '/' );
			if ( ! $ftp->store( $_src, $_dest ) ) {
				$_file = str_replace( $ftpOptions['root'], '', $_dest );
				$mainframe->enqueueMessage( JText::_( 'Error saving file' ).': '.$_file, 'error error_files' );
				$succes = 0;
			}
		}
	} else {
		foreach ( $files as $file ) {
			$_src = $src.DS.$file;
			$_dest = $dest.DS.$file;
			if ( !@copy( $_src, $_dest ) ) {
				$_file = str_replace( JPATH_ROOT, '', $_dest );
				$mainframe->enqueueMessage( JText::_( 'Error saving file' ).': '.$_file, 'error error_files' );
				$succes = 0;
			}
		}
	}

	return $succes;
}

/**
 * Create a folder
 */
function folder_create( $path = '', $mode = 0755 )
{
	// Initialize variables
	jimport( 'joomla.client.helper' );
	$ftpOptions = JClientHelper::getCredentials( 'ftp' );
	static $nested = 0;

	// Check to make sure the path valid and clean
	$path = JPath::clean( $path );

	// Check if dir already exists
	if ( JFolder::exists( $path ) ) {
		return true;
	}

	// Check for safe mode
	if ( $ftpOptions['enabled'] == 1 ) {
		// Connect the FTP client
		jimport( 'joomla.client.ftp' );
		$ftp = &JFTP::getInstance(
			$ftpOptions['host'], $ftpOptions['port'], null,
			$ftpOptions['user'], $ftpOptions['pass']
		);

		// Translate path to FTP path
		$path = JPath::clean( str_replace( JPATH_ROOT, $ftpOptions['root'], $path ), '/' );
		$ret = $ftp->mkdir( $path );
		$ftp->chmod( $path, $mode );
	} else {
		// We need to get and explode the open_basedir paths
		$obd = ini_get( 'open_basedir' );

		// If open_basedir is set we need to get the open_basedir that the path is in
		if ( $obd != null )
		{
			if ( JPATH_ISWIN ) {
				$obdSeparator = ";";
			} else {
				$obdSeparator = ":";
			}
			// Create the array of open_basedir paths
			$obdArray = explode( $obdSeparator, $obd );
			$inBaseDir = false;
			// Iterate through open_basedir paths looking for a match
			foreach ( $obdArray as $test ) {
				$test = JPath::clean( $test );
				if ( strpos( $path, $test ) === 0 ) {
					$obdpath = $test;
					$inBaseDir = true;
					break;
				}
			}
			if ( $inBaseDir == false ) {
				// Return false for JFolder::create because the path to be created is not in open_basedir
				JError::raiseWarning(
					'SOME_ERROR_CODE',
					'JFolder::create: '.JText::_( 'Path not in open_basedir paths' )
				);
				return false;
			}
		}

		// First set umask
		$origmask = @umask(0);

		// Create the path
		if ( !$ret = @mkdir( $path, $mode ) ) {
			@umask( $origmask );
			return false;
		}

		// Reset umask
		@umask( $origmask );
	}

	return $ret;
}

function uninstallInstaller( $name = 'geoxeo-installer-uninstallme' )
{
	// Create database object
	$_db = &JFactory::getDBO();

	$_installer = & JInstaller::getInstance();
	$_query = 'SELECT id FROM `#__components`'.
		' WHERE `option` = '.$_db->Quote( 'com_'.$name ).
		' AND parent = 0'.
		' LIMIT 1'.
		';';
	$_db->setQuery( $_query );
	$_id = $_db->loadResult();
	$_installer->uninstall( 'component', $_id );
	$_query = 'ALTER TABLE `#__components`'.
		' AUTO_INCREMENT = 1'.
		';';
	$_db->setQuery( $_query );
	$_db->query();

	return 1;
}

function installExtension( $name, $title, $type = 'component', $extra = array(), $extra_queries = array() )
{
	// Create database object
	$_db = &JFactory::getDBO();

	$state = 0;
	switch ( $type )
	{
		case 'component':
			$_query = 'SELECT id FROM `#__components`'.
				' WHERE `option` = '.$_db->Quote( 'com_'.$name ).
				' LIMIT 1'.
				';';
			$_db->setQuery( $_query );
			$_installed = $_db->loadResult();

			if( !$_installed ) {
				$_query = 'ALTER TABLE `#__components`'.
					' AUTO_INCREMENT = 1'.
					';';
				$_db->setQuery( $_query );
				$_db->query();

				$_row =& JTable::getInstance( 'component' );
				$_row->name = $title;
				$_row->admin_menu_alt = $title;
				$_row->option = 'com_'.$name;
				$_row->link = 'option=com_'.$name;
				$_row->admin_menu_link = 'option=com_'.$name;
				foreach ( $extra as $_key => $_val ) {
					$_row->$_key = $_val;
				}
				$_row->store();
			}

			foreach ( $extra_queries as $extra_query ) {
				$_db->setQuery( $extra_query );
				$_db->query();
			}

			$state = ( $_installed ) ? 2 : 1;

			break;

		case 'plugin':
			$_folder = $extra['folder'];
			$_query = 'SELECT id FROM `#__plugins`'.
				' WHERE `element` = '.$_db->Quote( $name ).
				' AND `folder` = '.$_db->Quote( $_folder ).
				' LIMIT 1'.
				';';
			$_db->setQuery( $_query );
			$_installed = $_db->loadResult();

			if( !$_installed ) {
				$_query = 'ALTER TABLE `#__plugins`'.
					' AUTO_INCREMENT = 1'.
					';';
				$_db->setQuery( $_query );
				$_db->query();

				$_row =& JTable::getInstance( 'plugin' );
				$_row->name = $title;
				$_row->element = $name;
				$_row->published = 1;
				foreach ( $extra as $_key => $_val ) {
					$_row->$_key = $_val;
				}
				$_row->store();
			}

			foreach ( $extra_queries as $extra_query ) {
				$_db->setQuery( $extra_query );
				$_db->query();
			}

			$state = ( $_installed ) ? 2 : 1;

			break;

		case 'module':
			$_query = 'SELECT id FROM `#__modules`'.
				' WHERE `module` = '.$_db->Quote( 'mod_'.$name ).
				' LIMIT 1'.
				';';
			$_db->setQuery( $_query );
			$_installed = $_db->loadResult();

			if( !$_installed ) {
				$_query = 'ALTER TABLE `#__modules`'.
					' AUTO_INCREMENT = 1'.
					';';
				$_db->setQuery( $_query );
				$_db->query();

				$_row = & JTable::getInstance( 'module' );
				$_row->title = $title;
				$_row->module = 'mod_'.$name;
				$_row->ordering = 0;
				$_row->position = 'breadcrumb';
				$_row->showtitle = 0;
				foreach ( $extra as $_key => $_val ) {
					$_row->$_key = $_val;
				}

				if ( !$_row->store() ) {
					$mainframe->enqueueMessage( $_row->getError(), 'error' );
					return;
				}

				// Clean up possible garbage first
				$query = 'DELETE FROM #__modules_menu WHERE moduleid = '.( int ) $_row->id;
				$_db->setQuery( $query );
				$_db->query();

				// Time to create a menu entry for the module
				$query = 'INSERT INTO `#__modules_menu` VALUES ( '.( int ) $_row->id.', 0 )';
				$_db->setQuery( $query );
				$_db->query();
			}

			foreach ( $extra_queries as $extra_query ) {
				$_db->setQuery( $extra_query );
				$_db->query();
			}

			$state = ( $_installed ) ? 2 : 1;

			break;
	}
	return $state;
}