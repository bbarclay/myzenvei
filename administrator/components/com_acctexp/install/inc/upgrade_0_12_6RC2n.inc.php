<?php
/**
 * @version $Id: upgrade_0_12_6_RC2n.inc.php
 * @package AEC - Account Control Expiration - Membership Manager
 * @subpackage Install Includes
 * @copyright 2006-2008 Copyright (C) David Deutsch
 * @author David Deutsch <skore@skore.de> & Team AEC - http://www.valanx.org
 * @license GNU/GPL v.2 http://www.gnu.org/licenses/old-licenses/gpl-2.0.html or, at your option, any later version
 */

// Making up for old thoughts
$database->setQuery("UPDATE #__acctexp_itemxgroup SET group_id='1' WHERE group_id='0'");
$database->query();

// Fixing secondary invoice numbers for CCBill
$query = 'SELECT id FROM #__acctexp_config_processors WHERE name = \'ccbill\'';
$database->setQuery( $query );

$ccid = $database->loadResult();

// Checking whether CCBill is installed at all
if ( $ccid ) {
	// Get all history entries for CCBill
	$query = 'SELECT id FROM #__acctexp_log_history WHERE proc_id = \'' . $ccid . '\'';
	$database->setQuery( $query );

	$list = $database->loadResultArray();

	if ( !empty( $list ) ) {
		foreach ( $list as $hid ) {
			$history = new logHistory( $database );
			$history->load( $hid );

			$params = parameterHandler::decode( stripslashes( $history->response ) );

			// Check for the parameters we need
			if ( isset( $params['subscription_id'] ) && isset( $params['invoice'] ) ) {
				$query = 'UPDATE #__acctexp_invoices SET `secondary_ident` = \'' . $params['subscription_id'] . '\' WHERE invoice_number = \'' . $params['invoice'] . '\'';
				$database->setQuery( $query );
				$database->query();
			}
		}
	}
}

// Haunted by ghosts of xmas past
$query = 'SELECT `id` FROM #__acctexp_subscr WHERE `params` LIKE \'%_jsoon%\'';
$database->setQuery( $query );

$list = $database->loadResultArray();

if ( !empty( $list ) ) {
	foreach ( $list as $sid ) {
		$query = 'SELECT `params` FROM #__acctexp_subscr WHERE `id` = \'' . $sid . '\'';
		$database->setQuery( $query );

		$params = $database->loadResult();
		$decode = stripslashes( str_replace( array( '\n', '\t', '\r' ), array( "\n", "\t", "\r" ), trim($params) ) );
		$temp = jsoonHandler::decode( $decode );

		$query = 'UPDATE #__acctexp_subscr SET `params` = \'' . base64_encode( serialize( $temp ) ) . '\' WHERE `id` = \'' . $sid . '\'';
		$database->setQuery( $query );
		$database->query();
	}
}

if ( in_array( $mainframe->getCfg( 'dbprefix' ) . "acctexp_mi_hotproperty", $tables ) ) {
	$filename = JPATH_SITE . '/components/com_acctexp/micro_integration/mi_hotproperty.php';

	if ( file_exists( $filename ) ) {
		include_once $filename;

		$fielddeclare = array( 'params' );

		$query = 'SELECT `id`'
				. ' FROM #__acctexp_mi_hotproperty'
				;
		$database->setQuery( $query );
		$entries = $database->loadResultArray();

		if ( !empty( $entries ) ) {
			foreach ( $entries as $id ) {
				$object = null;
				$query = 'SELECT `params` FROM #__acctexp_mi_hotproperty'
				. ' WHERE `id` = \'' . $id . '\''
				;
				$database->setQuery( $query );
				if ( aecJoomla15check() ) {
					$object = $database->loadObject();
				} else {
					$database->loadObject($object);
				}

				if ( empty( $object->params ) ) {
					continue;
				}

				// Decode from jsonized fields
				if ( strpos( $object->params, "{" ) === 0 ) {
					$decode = stripslashes( str_replace( array( '\n', '\t', '\r' ), array( "\n", "\t", "\r" ), trim($object->params) ) );
					$temp = jsoonHandler::decode( $decode );
				} else {
					continue;
				}

				// ... to serialized
				$query = 'UPDATE #__acctexp_' . $dbtable
				. ' SET `params` = \'' . base64_encode( serialize( $temp ) ) . '\''
				. ' WHERE `id` = \'' . $id . '\''
				;
				$database->setQuery( $query );
				if ( !$database->query() ) {
			    	$errors[] = array( $database->getErrorMsg(), $query );
				}
			}
		}
	}
}

?>