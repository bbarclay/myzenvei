<?php
/**
 * @version $Id: upgrade_0_6_0.inc.php
 * @package AEC - Account Control Expiration - Membership Manager
 * @subpackage Install Includes
 * @copyright 2006-2008 Copyright (C) David Deutsch
 * @author David Deutsch <skore@skore.de> & Team AEC - http://www.valanx.org
 * @license GNU/GPL v.2 http://www.gnu.org/licenses/old-licenses/gpl-2.0.html or, at your option, any later version
 */

// Update routine 0.3.0 -> 0.6.0
if ( in_array( $mainframe->getCfg( 'dbprefix' ) . "acctexp_payplans", $tables ) ) {
	// Check for existence of 'gid' column on table #__acctexp_payplans
	// It is existent only from version 0.6.0
	$result = null;
	$database->setQuery("SHOW COLUMNS FROM #__acctexp_payplans LIKE 'gid'");
	if ( aecJoomla15check() ) {
		$result = $database->loadObject();
	} else {
		$database->loadObject($result);
	}
	if (strcmp($result->Field, 'gid') === 0) {
		// You're already running version 0.6.0 or later. No action required.
	} else {
		// You're not running version 0.6.0 or later. Update required.
		$database->setQuery("ALTER TABLE #__acctexp_payplans ADD `gid` int(3) default NULL");
		if ( !$database->query() ) {
	    	$errors[] = array( $database->getErrorMsg(), $query );
		}
	}
}
?>