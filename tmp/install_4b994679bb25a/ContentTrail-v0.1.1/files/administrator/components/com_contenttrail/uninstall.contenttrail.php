<?php

/**
 * Installer File
 * Performs an install / update of GeoXeo extensions
 *
 * @author     GeoXeo <contact@geoxeo.com>
 * @link       http://www.geoxeo.com
 * @copyright  Copyright (C) 2010 GeoXeo - All Rights Reserved
 * @license    http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 * 
 */


// No direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

// Delete plugin files
if ( is_file( JPATH_PLUGINS.DS.'content'.DS.'contenttrail.php' ) ) {
	JFile::delete( JPATH_PLUGINS.DS.'content'.DS.'contenttrail.php' );
}
if ( is_file( JPATH_PLUGINS.DS.'content'.DS.'contenttrail.xml' ) ) {
	JFile::delete( JPATH_PLUGINS.DS.'content'.DS.'contenttrail.xml' );
}

// Delete module files
JFolder::delete( JPATH_SITE.DS.'modules'.DS.'mod_contenttrail' );
