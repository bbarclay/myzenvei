<?php
/**
 * @version $Id: upgrade_0_8_0.inc.php
 * @package AEC - Account Control Expiration - Membership Manager
 * @subpackage Install Includes
 * @copyright 2006-2008 Copyright (C) David Deutsch
 * @author David Deutsch <skore@skore.de> & Team AEC - http://www.valanx.org
 * @license GNU/GPL v.2 http://www.gnu.org/licenses/old-licenses/gpl-2.0.html or, at your option, any later version
 */

// Update routine 0.6.0 -> 0.8.0
$queri	= array();
$result = null;

$database->setQuery("SHOW COLUMNS FROM #__acctexp_config LIKE 'alertlevel1'");
if ( aecJoomla15check() ) {
	$result = $database->loadObject();
} else {
	$database->loadObject($result);
}

if ( is_object( $result ) ) {
	if (strcmp($result->Field, 'alertlevel1') === 0) {
		$database->setQuery("SHOW COLUMNS FROM #__acctexp_config LIKE 'email'");
		if ( aecJoomla15check() ) {
			$result = $database->loadObject();
		} else {
			$database->loadObject($result);
		}

		if (strcmp($result->Field, 'email') === 0) {
			$queri[] = "ALTER TABLE #__acctexp_config DROP `email`";
			$queri[] = "ALTER TABLE #__acctexp_config DROP `paypal`";
			$queri[] = "ALTER TABLE #__acctexp_config DROP `business`";
			$queri[] = "ALTER TABLE #__acctexp_config DROP `testmode`";

			foreach ( $queri AS $query ) {
				$database->setQuery( $query );
			    if ( !$database->query() ) {
			        $errors[] = array( $database->getErrorMsg(), $query );
			    }
			}
		}

		if ( in_array( $mainframe->getCfg( 'dbprefix' ) . 'acctexp_payplans', $tables ) ) {
			$queri = null;
			// Drop new table __acctexp_plans. We going to recreate it from old __acctexp_payplans
			$queri[] = "DROP TABLE  #__acctexp_plans";
			// Rename __acctexp_payplans to __acctexp_plans... Magic!!
			$queri[] = "ALTER TABLE #__acctexp_payplans RENAME TO #__acctexp_plans";
			// Get rid of old stuff.
			$queri[] = "ALTER TABLE #__acctexp_plans DROP `button`";
			$queri[] = "ALTER TABLE #__acctexp_plans DROP `button_custom`";
			$queri[] = "ALTER TABLE #__acctexp_plans DROP `src`";
			$queri[] = "ALTER TABLE #__acctexp_plans DROP `sra`";
			$queri[] = "ALTER TABLE #__acctexp_plans DROP `srt`";
			$queri[] = "ALTER TABLE #__acctexp_plans DROP `invoice`";
			$queri[] = "ALTER TABLE #__acctexp_plans DROP `tax`";
			$queri[] = "ALTER TABLE #__acctexp_plans DROP `currency_code`";
			$queri[] = "ALTER TABLE #__acctexp_plans DROP `modify`";
			$queri[] = "ALTER TABLE #__acctexp_plans DROP `lc`";
			$queri[] = "ALTER TABLE #__acctexp_plans DROP `page_style`";
			// And rename fields that should remain, but with generic names:
			// a1 -> amount1 || p1 -> period1 || t1 -> perunit1
			// a2 -> amount2 || p2 -> period2 || t2 -> perunit2
			// a3 -> amount3 || p3 -> period3 || t3 -> perunit3
			$queri[] = "ALTER TABLE #__acctexp_plans CHANGE `a1` `amount1` varchar(40) NULL";
			$queri[] = "ALTER TABLE #__acctexp_plans CHANGE `a2` `amount2` varchar(40) NULL";
			$queri[] = "ALTER TABLE #__acctexp_plans CHANGE `a3` `amount3` varchar(40) NULL";
			$queri[] = "ALTER TABLE #__acctexp_plans CHANGE `p1` `period1` varchar(40) NULL";
			$queri[] = "ALTER TABLE #__acctexp_plans CHANGE `p2` `period2` varchar(40) NULL";
			$queri[] = "ALTER TABLE #__acctexp_plans CHANGE `p3` `period3` varchar(40) NULL";
			$queri[] = "ALTER TABLE #__acctexp_plans CHANGE `t1` `perunit1` varchar(40) NULL";
			$queri[] = "ALTER TABLE #__acctexp_plans CHANGE `t2` `perunit2` varchar(40) NULL";
			$queri[] = "ALTER TABLE #__acctexp_plans CHANGE `t3` `perunit3` varchar(40) NULL";
			// Drop new table __acctexp_log_paypal. We going to recreate it from old __acctexp_paylog
			$queri[] = "DROP TABLE  #__acctexp_log_paypal";
			// Rename __acctexp_paylog to __acctexp_log_paypal...
			$queri[] = "ALTER TABLE #__acctexp_paylog RENAME TO #__acctexp_log_paypal";

			foreach ( $queri as $query ) {
				$database->setQuery( $query );
			    if ( !$database->query() ) {
			        $errors[] = array( $database->getErrorMsg(), $query );
			    }
			}

			// Associate all those old plans with PayPal processors.
			$database->setQuery("SELECT id FROM  #__acctexp_plans");
			$rows = $database->loadObjectList();
			for ($i=0, $n=count( $rows ); $i < $n; $i++) {
				$row = &$rows[$i];
				$database->setQuery("INSERT INTO `#__acctexp_processors_plans` VALUES ($row->id, '1')");
				if ( !$database->query() ) {
			    	$errors[] = array( $database->getErrorMsg(), $query );
				}
			}
		}

		// Configure extra01 field indicating recurring subscriptions...
		$database->setQuery("UPDATE #__acctexp_subscr SET extra01='1' WHERE extra01 is NULL");
		if ( !$database->query() ) {
	    	$errors[] = array( $database->getErrorMsg(), $query );
		}

	} else {
		// You're running version 0.8.0 or later. No Update required here.
	}
}

$queri = array();

$queri[] = "DROP TABLE IF EXISTS #__acctexp_log_paypal";
$queri[] = "DROP TABLE IF EXISTS #__acctexp_log_2checkout";
$queri[] = "DROP TABLE IF EXISTS #__acctexp_log_allopass";
$queri[] = "DROP TABLE IF EXISTS #__acctexp_log_authorize";
$queri[] = "DROP TABLE IF EXISTS #__acctexp_log_vklix";

$eucaInstalldb->multiQueryExec( $queri );
?>