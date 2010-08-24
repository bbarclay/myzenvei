<?php
/**
 * @version $Id: upgrade_0_12_0.inc.php
 * @package AEC - Account Control Expiration - Membership Manager
 * @subpackage Install Includes
 * @copyright 2006-2008 Copyright (C) David Deutsch
 * @author David Deutsch <skore@skore.de> & Team AEC - http://www.valanx.org
 * @license GNU/GPL v.2 http://www.gnu.org/licenses/old-licenses/gpl-2.0.html or, at your option, any later version
 */

// Update routine 0.10.0x -> 0.12.0

// Rewrite old Invoice Number Formatting options into aecjson string
if ( isset( $aecConfig->cfg['invoicenum_display_id'] ) ) {
	if ( empty( $aecConfig->cfg['invoicenum_display_id'] ) ) {
		$temp = '{ "cmd":"rw_constant", "vars":"invoice_number" }';
		if ( !empty( $aecConfig->cfg['invoicenum_display_case'] ) ) {
			switch ( $aecConfig->cfg['invoicenum_display_case'] ) {
				case 'UPPER':
					$temp = '{ "cmd":"uppercase", "vars":"' . $temp . '" }';
					break;
				case 'LOWER':
					$temp = '{ "cmd":"lowercase", "vars":"' . $temp . '" }';
					break;
			}
		}
	} else {
		$temp = '{ "cmd":"rw_constant", "vars":"invoice_id" }';
		if ( !empty( $aecConfig->cfg['invoicenum_display_idinflate'] ) ) {
			$temp = '{ "cmd":"math", "vars":[' . $temp . ',"+",' . $aecConfig->cfg['invoicenum_display_idinflate'] . '] }';
		}
	}

	if ( !empty( $aecConfig->cfg['invoicenum_display_chunking'] ) ) {
		if ( !empty( $aecConfig->cfg['invoicenum_display_separator'] ) ) {
			$temp = '{ "cmd":"chunk", "vars":[' . $temp . ',' . $aecConfig->cfg['invoicenum_display_chunking'] . ',"' . $aecConfig->cfg['invoicenum_display_separator'] . '"] }';
			$separator = $aecConfig->cfg['invoicenum_display_separator'];
		} else {
			$temp = '{ "cmd":"chunk", "vars":[' . $temp . ',' . $aecConfig->cfg['invoicenum_display_chunking'] . '] }';
		}
	}

	$aecConfig->cfg['invoicenum_formatting'] = '{aecjson} ' . $temp . ' {/aecjson}';

	unset( $aecConfig->cfg['invoicenum_display_id'] );
	unset( $aecConfig->cfg['invoicenum_display_case'] );
	unset( $aecConfig->cfg['invoicenum_display_idinflate'] );
	unset( $aecConfig->cfg['invoicenum_display_chunking'] );
	unset( $aecConfig->cfg['invoicenum_display_separator'] );
}

$aecConfig->saveSettings();

// check for old values and update (if happen) old tables
$result = null;
$database->setQuery("SHOW COLUMNS FROM #__acctexp_plans LIKE 'params'");
if ( aecJoomla15check() ) {
	$result = $database->loadObject();
} else {
	$database->loadObject($result);
}

if ( !( strcmp( $result->Field, 'params' ) === 0 ) ) {
	$result = null;
	$database->setQuery("SHOW COLUMNS FROM #__acctexp_plans LIKE 'mingid'");
	if ( aecJoomla15check() ) {
		$result = $database->loadObject();
	} else {
		$database->loadObject($result);
	}

	if ( strcmp( $result->Field, 'mingid' ) === 0 ) {
		$database->setQuery("ALTER TABLE #__acctexp_plans ADD `restrictions` text NULL");
		if ( !$database->query() ) {
	    	$errors[] = array( $database->getErrorMsg(), $query );
		}

		$database->setQuery("ALTER TABLE #__acctexp_plans ADD `params` text NULL");
		if ( !$database->query() ) {
	    	$errors[] = array( $database->getErrorMsg(), $query );
		}

		$remap_params = array();
		$remap_params["amount1"]	= "trial_amount";
		$remap_params["period1"]	= "trial_period";
		$remap_params["perunit1"]	= "trial_periodunit";
		$remap_params["amount2"]	= "trial2_amount";
		$remap_params["period2"]	= "trial2_period";
		$remap_params["perunit2"]	= "trial2_periodunit";
		$remap_params["amount3"]	= "full_amount";
		$remap_params["period3"]	= "full_period";
		$remap_params["perunit3"]	= "full_periodunit";
		$remap_params["processors"] = "processors";
		$remap_params["lifetime"]	= "lifetime";
		$remap_params["fallback"]	= "fallback";
		$remap_params["similarpg"]	= "similarpg";
		$remap_params["equalpg"]	= "equalpg";
		$remap_params["gid"]		= "gid";
		$remap_params["mingid"]		= "mingid";

		$database->setQuery("SELECT * FROM  #__acctexp_plans");
		$plans = $database->loadObjectList();

		$plans_new = array();
		foreach ( $remap_params as $field => $arrayfield ) {
			foreach ( $plans as $plan ) {
				if ( isset( $plan->$field ) ) {
					$plans_new[$plan->id][$arrayfield] = $plan->$field;
				} else {
					$plans_new[$plan->id][$arrayfield] = "";
				}
			}

			$database->setQuery("ALTER TABLE #__acctexp_plans DROP COLUMN `" . $field . "`");
			if ( !$database->query() ) {
		    	$errors[] = array( $database->getErrorMsg(), $query );
			}
		}

		foreach ( $plans_new as $id => $content ) {
			$params			= '';
			$restrictions	= '';

			foreach ( $content as $name => $var ) {
				// For some values, we need to set an accompaning switch
				switch ($name) {
					case 'mingid':
						if ($var && ($var != 29) && ($var != 18)) {
							$restrictions .= "mingid_enabled=1\n";
							$restrictions .= $name . "=" . $var . "\n";
						} else {
							$restrictions .= "mingid_enabled=0\n";
							$restrictions .= $name . "=" . $var . "\n";
						}
					break;
					case 'full_amount':
						if (strcmp("0.00", $var) === 0) {
							$params .= "full_free=1\n";
							$params .= $name . "=" . $var . "\n";
						} else {
							$params .= "full_free=0\n";
							$params .= $name . "=" . $var . "\n";
						}
						break;
					case 'trial_amount':
						if (strcmp("0.00", $var) === 0) {
							$params .= "trial_free=1\n";
							$params .= $name . "=" . $var . "\n";
						} else {
							$params .= "trial_free=0\n";
							$params .= $name . "=" . $var . "\n";
						}
						break;
					default:
						$params .= $name . "=" . $var . "\n";
						break;
				}
			}

			// Making sure that plans act the same as they did before .49
			$params .= "gid_enabled=1\n";

			$database->setQuery("UPDATE #__acctexp_plans SET params='" . $params . "', restrictions='" . $restrictions . "' WHERE id='" . $id . "'");
			if ( !$database->query() ) {
		    	$errors[] = array( $database->getErrorMsg(), $query );
			}
		}

	}
}

$eucaInstalldb->dropColifExists( 'mingid', 'plans' );
$eucaInstalldb->dropColifExists( 'similarpg', 'plans' );
$eucaInstalldb->dropColifExists( 'equalpg', 'plans' );
$eucaInstalldb->dropColifExists( 'maxgid', 'plans' );
$eucaInstalldb->dropColifExists( 'email_desc_exp', 'plans' );
$eucaInstalldb->dropColifExists( 'send_exp_mail', 'plans' );
$eucaInstalldb->dropColifExists( 'desc_email', 'plans' );
$eucaInstalldb->dropColifExists( 'email_desc_exp', 'plans' );
$eucaInstalldb->dropColifExists( 'send_exp_mail', 'plans' );
$eucaInstalldb->dropColifExists( 'fallback', 'plans' );

if ( $eucaInstalldb->ColumninTable( 'customparams', 'plans' ) ) {
	$database->setQuery("SHOW COLUMNS FROM #__acctexp_plans LIKE 'custom_params'");
	if ( !$eucaInstalldb->ColumninTable( 'custom_params', 'plans' ) ) {
		$database->setQuery("ALTER TABLE #__acctexp_plans CHANGE `customparams` `custom_params` text NULL");
		if ( !$database->query() ) {
	    	$errors[] = array( $database->getErrorMsg(), $query );
		}
	}
}

$eucaInstalldb->dropColifExists( 'maxgid', 'plans' );

$eucaInstalldb->addColifNotExists( 'custom_params', "text NULL", 'plans' );
$eucaInstalldb->addColifNotExists( 'system', "int(4) NOT NULL default '0'", 'microintegrations' );
$eucaInstalldb->addColifNotExists( 'params', "text NULL", 'subscr' );
$eucaInstalldb->addColifNotExists( 'customparams', "text NULL", 'subscr' );
$eucaInstalldb->addColifNotExists( 'pre_exp_check', "int(4) NULL", 'microintegrations' );

if ( in_array( $mainframe->getCfg( 'dbprefix' ) . "acctexp", $tables ) ) {
	$result = null;
	$database->setQuery("SHOW COLUMNS FROM #__acctexp LIKE 'expiration'");
	if ( aecJoomla15check() ) {
		$result = $database->loadObject();
	} else {
		$database->loadObject($result);
	}

	if ( !empty( $result ) ) {
		if ( (strcmp($result->Field, 'expiration') === 0) && (strcmp($result->Type, 'date') === 0) ) {
			// Give extra space for plan description
			$database->setQuery("ALTER TABLE #__acctexp CHANGE `expiration` `expiration` datetime NOT NULL default '0000-00-00 00:00:00'");
			if ( !$database->query() ) {
		    	$errors[] = array( $database->getErrorMsg(), $query );
			}
		}
	}
}

$eucaInstalldb->addColifNotExists( 'counter', "int(11) NOT NULL default '0'", 'invoices' );
$eucaInstalldb->addColifNotExists( 'transactions', "text NULL", 'invoices' );

$eucaInstalldb->addColifNotExists( 'secondary_ident', "varchar(64) NULL", 'invoices' );

// This updates from the old one-plan-per-subscription plus expiration table
// to the new multi-plans-per-user architecture
if ( in_array( $mainframe->getCfg( 'dbprefix' ) . "acctexp", $tables ) ) {
	// create new primary and expiration fields
	$eucaInstalldb->addColifNotExists( 'primary', "int(4) NOT NULL default '0'", 'subscr' );
	$eucaInstalldb->addColifNotExists( 'expiration', "datetime NULL default '0000-00-00 00:00:00'", 'subscr' );

	// All Subscriptions are primary
	$query = 'UPDATE #__acctexp_subscr'
			. ' SET `primary` = \'1\''
			;
	$database->setQuery( $query );
	$database->query();

	// copy expiration date
	$query = 'UPDATE #__acctexp_subscr as a'
			. ' INNER JOIN #__acctexp as b ON a.userid = b.userid'
			. ' SET a.expiration = b.expiration'
			;
	$database->setQuery( $query );
	$database->query();

	// Get plans
	$query = 'SELECT `id`'
			. ' FROM #__acctexp_plans'
			;
	$database->setQuery( $query );
	$pplans = $database->loadResultArray();

	// Assign new make_primary flag to all old plans
	foreach ( $pplans as $planid ) {
		$subscription_plan = new SubscriptionPlan( $database );

		$subscription_plan->addParams( array( 'make_primary' => 1 ) );
	}

	// delete old expiration table
	$eucaInstalldb->dropTableifExists( 'acctexp', false );
}

// fix for 0.12.4.15f mistake
$eucaInstalldb->addColifNotExists( 'primary', "int(1) NOT NULL default '0'", 'subscr' );

$eucaInstalldb->addColifNotExists( 'subscr_id', "int(11) NULL", 'invoices' );
$eucaInstalldb->addColifNotExists( 'conditions', "text NULL", 'invoices' );

$eucaInstalldb->addColifNotExists( 'subscr_id', "int(11) NULL", 'invoices' );
$eucaInstalldb->addColifNotExists( 'conditions', "text NULL", 'invoices' );
$eucaInstalldb->addColifNotExists( 'invoice_number_format', "varchar(64)", 'invoices' );

// update remository and docman MI tables for unlimited downloads if they exist
if ( in_array( $mainframe->getCfg( 'dbprefix' ) . "acctexp_mi_remository", $tables ) ) {
	$eucaInstalldb->addColifNotExists( 'unlimited_downloads', "int(3) NULL", 'mi_remository' );
}

if ( in_array( $mainframe->getCfg( 'dbprefix' ) . "acctexp_mi_docman", $tables ) ) {
	$eucaInstalldb->addColifNotExists( 'unlimited_downloads', "int(3) NULL", 'mi_docman' );
}

// Rewrite old entries for hardcoded "transfer" processor to new API conform "offline_payment" processor
$query = 'UPDATE #__acctexp_invoices'
		. ' SET `method` = \'offline_payment\''
		. ' WHERE `method` = \'transfer\'';
$database->setQuery( $query );
if ( !$database->query() ) {
	$errors[] = array( $database->getErrorMsg(), $query );
}

$query = 'UPDATE #__acctexp_subscr'
		. ' SET `type` = \'offline_payment\''
		. ' WHERE `type` = \'transfer\'';
$database->setQuery( $query );
if ( !$database->query() ) {
	$errors[] = array( $database->getErrorMsg(), $query );
}

// Cater a strange bug that resets recurring due to the above
$query = 'UPDATE #__acctexp_subscr'
		. ' SET `recurring` = \'0\''
		. ' WHERE `type` = \'transfer\' OR `type` = \'offline_payment\'';
$database->setQuery( $query );
if ( !$database->query() ) {
	$errors[] = array( $database->getErrorMsg(), $query );
}

$eucaInstalldb->addColifNotExists( 'level', "int(4) NOT NULL default '2'", 'eventlog' );
$eucaInstalldb->addColifNotExists( 'notify', "int(1) NOT NULL default '0'", 'eventlog' );
?>