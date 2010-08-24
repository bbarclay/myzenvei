<?php
/**
 * @version $Id: verotel.php
 * @package AEC - Account Control Expiration - Membership Manager
 * @subpackage Processors - Verotel
 * @author David Deutsch <skore@skore.de> & Team AEC - http://www.valanx.org
 * @copyright 2006-2008 Copyright (C) David Deutsch
 * @license GNU/GPL v.2 http://www.gnu.org/licenses/old-licenses/gpl-2.0.html or, at your option, any later version
 */

// Dont allow direct linking
( defined('_JEXEC') || defined( '_VALID_MOS' ) ) or die( 'Direct Access to this location is not allowed.' );

class processor_verotel extends URLprocessor
{
	function info()
	{
		$i = array();
		$i['name']					= 'verotel';
		$i['longname']				= _CFG_VEROTEL_LONGNAME;
		$i['statement']				= _CFG_VEROTEL_STATEMENT;
		$i['description']			= _CFG_VEROTEL_DESCRIPTION;
		$i['currencies']			= 'USD';
		$i['languages']				= 'AU,DE,FR,IT,GB,ES,US';
		$i['cc_list']				= 'visa,mastercard,discover,americanexpress,echeck';
		$i['notify_trail_thanks']	= 1;
		$i['recurring']				= 0;

		return $i;
	}

	function settings()
	{
		$s = array();
		$s['merchantid']		= "merchantid";
		$s['resellerid']		= "resellerid";
		$s['siteid']			= "siteid";
		$s['secretcode']		= "secretcode";
		$s['use_ticketsclub']	= 1;
		$s['customparams']		= "";

		return $s;
	}

	function backend_settings()
	{
		$s = array();

		$s['merchantid']		= array( 'inputC' );
		$s['resellerid']		= array( 'inputC' );
		$s['siteid']			= array( 'inputC' );
		$s['secretcode']		= array( 'inputC' );
		$s['use_ticketsclub']	= array( 'list_yesno' );
		$settings['info']		= array( 'fieldset' );
		$s['customparams']		= array( 'inputD' );

		return $s;
	}

	function CustomPlanParams()
	{
		$p = array();

		$p['verotel_product']	= array( 'inputC' );

		return $p;
	}

	function createGatewayLink( $request )
	{
		// Payment Plans are required to have a productid assigned
		if ( empty( $request->int_var['planparams']['verotel_product'] ) ) {
			$product = $this->settings['siteid'];
		} else {
			$product = $request->int_var['planparams']['verotel_product'];
		}

		if ( $this->settings['use_ticketsclub'] ) {
			$var['post_url']			= "https://secure.ticketsclub.com/cgi-bin/boxoffice-one.tc?";
			$var['fldcustomerid']		= $this->settings['merchantid'];
			$var['fldwebsitenr']		= $this->settings['siteid'];
			$var['tc_usercode']			= $request->metaUser->cmsUser->username;
			$var['tc_passcode']			= "xxxxxxxx";
			$var['tc_custom1']			= $request->invoice->invoice_number;
			$var['tc_custom2']			= $request->metaUser->cmsUser->username;
		} else {
			$var['post_url']			= "https://secure.verotel.com/cgi-bin/vtjp.pl?";
			$var['verotel_id']			= $this->settings['merchantid'];
			$var['verotel_product']		= $product;
			$var['verotel_website']		= $this->settings['siteid'];
			$var['verotel_usercode']	= $request->metaUser->cmsUser->username;
			$var['verotel_passcode']	= "xxxxxxxx";
			$var['verotel_custom1']		= $request->invoice->invoice_number;
		}

		return $var;
	}

	function parseNotification( $post )
	{
		$res = explode(":", aecGetParam('vercode'));

		$username	= $res[0];
		$secret		= $res[2];
		$action     = $res[3];
		$amount     = $res[4];
		$payment_id = $res[5];

		$response = array();
		$response['invoice'] = null;

		if ( $res[3] == 'add' ) {
			$response['invoice'] = $payment_id;
		} else {
			$database = &JFactory::getDBO();

			$query = 'SELECT `id` FROM #__users WHERE `username` = \'' . $username . '\'';
			$database->setQuery( $query );

			$userid = $database->loadResult();

			if ( $userid ) {
				$id = AECfetchfromDB::lastClearedInvoiceIDbyUserID( $userid );

				$query = 'SELECT `invoice_number` FROM #__acctexp_invoices WHERE `id` = \'' . $id . '\'';
				$database->setQuery( $query );

				$invoice_number = $database->loadResult();

				if ( !empty( $invoice_number ) ) {
					$response['invoice'] = $invoice_number;
				}
			}
		}

		return $response;
	}

	function validateNotification( $response, $post, $invoice )
	{
		//if ( !AECToolbox::in_ip_range( '195.20.32.0', '﻿195.20.32.256' ) ) {
			//$response['error'] = 1;
			//$response['errormsg'] = "Wrong IP tried to send notification: " . $_SERVER["REMOTE_ADDR"];
			//return $response;
		//}

		$res = explode(":", aecGetParam('vercode'));

		if( $this->settings['secretcode'] == $res[2] ) {
			$response['valid'] = 1;
		} else {
			$response['valid'] = 0;
			$response['pending_reason'] = 'INVALID SECRET WORD, provided: ' . $res[2];
		}

		switch ( $res[3] ) {
			case 'add':
				$response['valid'] = 1;
				break;
			case 'cancel':
				$response['cancel'] = 1;
				$response['valid'] = 0;
				break;
			case 'delete':
				$response['delete'] = 1;
				$response['valid'] = 0;
				break;
			case 'rebill':
				$response['amount_paid'] = $res[4];
				break;
		}

		return $response;
	}

}

?>
