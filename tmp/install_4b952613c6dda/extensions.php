<?php
/**
 * Extension Install File
 * Does the stuff for the specific extensions
 *
 * @package     Better Preview
 * @version     1.6.0
 *
 * @author      Peter van Westen <peter@nonumber.nl>
 * @link        http://www.nonumber.nl
 * @copyright   Copyright (C) 2010 NoNumber! All Rights Reserved
 * @license     http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 */

// No direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

$name = 'Better Preview';
$alias = 'betterpreview';
$ext = $name.' (system plugin)';

// SYSTEM PLUGIN
$states[] = installExtension( $alias, 'System - '.$name, 'plugin', array( 'folder'=>'system' ) );

// Stuff to do after installation / update
function afterInstall( &$db ) {
	$queries = array();
	
	// Rename old plugin name
	$queries[] = "UPDATE `#__plugins`
		SET `name` = 'System - Better Preview'
		WHERE `name` = 'System - BetterPreview' OR `name` = 'System - BetterPreview!'";

	foreach ( $queries as $query ) {
		$db->setQuery( $query );
		$db->query();
	}

}