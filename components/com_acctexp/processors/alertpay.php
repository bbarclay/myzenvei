<?php
/**
 * @version $Id: alertpay.php
 * @package AEC - Account Control Expiration - Membership Manager
 * @subpackage Processors - Alertpay
 * @copyright 2006-2008 Copyright (C) David Deutsch
 * @author David Deutsch <skore@skore.de> & Team AEC - http://www.valanx.org
 * @license GNU/GPL v.2 http://www.gnu.org/licenses/old-licenses/gpl-2.0.html or, at your option, any later version
 */

// Dont allow direct linking
( defined('_JEXEC') || defined( '_VALID_MOS' ) ) or die( 'Direct Access to this location is not allowed.' );

class processor_alertpay extends POSTprocessor
{
	function info()
	{
		$info = array();
		$info['name']					= 'alertpay';
		$info['longname']				= _AEC_PROC_INFO_AP_LNAME;
		$info['statement']				= _AEC_PROC_INFO_AP_STMNT;
		$info['description']			= _DESCRIPTION_ALERTPAY;
		$info['currencies']				= 'USD,EUR,GBP,CAD,AUD,BGN,CZK,DKK,EEK,HKD,HUF,LTL,MYR,NZD,NOK,PLN,ROL,SGD,ZAR,SEK,CHF';
		$info['cc_list']				= 'visa,mastercard,discover,americanexpress,echeck';
		$info['recurring']				= 2;
		$info['notify_trail_thanks']	= 1;
		$info['recurring_buttons']		= 2;

		return $info;
	}

	function settings()
	{
		$settings = array();
		$settings['testmode']		= 0;
		$settings['merchant']		= 'merchant';
		$settings['securitycode']	= 'security code';
		$settings['currency']		= 'EUR';
		$settings['testmode']		= 0;
		$settings['item_name']		= sprintf( _CFG_PROCESSOR_ITEM_NAME_DEFAULT, '[[cms_live_site]]', '[[user_name]]', '[[user_username]]' );
		$settings['customparams']	= "";

		return $settings;
	}

	function backend_settings()
	{
		$settings = array();
		$settings['testmode']		= array( 'list_yesno' );
		$settings['merchant']		= array( 'inputC' );
		$settings['securitycode']	= array( 'inputC' );
		$settings['currency']		= array( 'list_currency' );
		$settings['item_name']		= array( 'inputE' );
		$settings['customparams']	= array( 'inputD' );

		$settings					= AECToolbox::rewriteEngineInfo( null, $settings );

		return $settings;
	}

	function createGatewayLink( $request )
	{
		$var['post_url']	= "https://www.alertpay.com/PayProcess.aspx";
		if ( $this->settings['testmode'] ) {
			$var['ap_test'] = '1';
		}

		if ( is_array( $request->int_var['amount'] ) ) {
			$var['ap_purchasetype']	= 'Subscription';

			if ( isset( $request->int_var['amount']['amount1'] ) ) {
				$var['ap_trialamount'] 		= $request->int_var['amount']['amount1'];
				$put = $this->convertPeriodUnit( $request->int_var['amount']['unit1'], $request->int_var['amount']['period1'] );
				$var['ap_trialtimeunit'] 		= $put['unit'];
				$var['ap_trialperiodlength'] 	= $put['period'];
			}

			if ( !empty( $this->settings['tax'] ) ) {
				$tax = $request->int_var['amount']['amount3'] / ( 100 + $this->settings['tax'] ) * 100;
				$var['ap_amount'] 	= round( $tax, 2 );
			} else {
				$var['ap_amount'] 	= $request->int_var['amount']['amount3'];
			}

			$puf = $this->convertPeriodUnit( $request->int_var['amount']['unit3'], $request->int_var['amount']['period3'] );
			$var['ap_timeunit'] 		= $puf['unit'];
			$var['ap_periodlength'] 	= $puf['period'];
		} else {
			$var['ap_purchasetype']	= 'Item';

			if ( !empty( $this->settings['tax'] ) ) {
				$tax = $request->int_var['amount'] / ( 100 + $this->settings['tax'] ) * 100;
				$var['ap_amount'] 	= round( $tax, 2 );
			} else {
				$var['ap_amount'] 	= $request->int_var['amount'];
			}
		}

		$var['ap_merchant']		= $this->settings['merchant'];
		$var['ap_itemname']		= $request->invoice->invoice_number;
		$var['ap_currency']		= $this->settings['currency'];
		$var['ap_returnurl']	= AECToolbox::deadsureURL( "index.php?option=com_acctexp&amp;task=thanks" );
		$var['ap_description']	= AECToolbox::rewriteEngineRQ( $this->settings['item_name'], $request );

		$var['ap_cancelurl']	= AECToolbox::deadsureURL( "index.php?option=com_acctexp&amp;task=cancel" );

		$var['apc_1']			= $request->metaUser->cmsUser->id;
		$var['apc_2']			= AECToolbox::rewriteEngineRQ( $this->settings['item_name'], $request );
		$var['apc_3']			= $request->int_var['usage'];

		return $var;
	}

	function convertPeriodUnit( $unit, $period )
	{
		$return = array();
		$return['period'] = $period;
		switch ( $unit ) {
			case 'D':
				$return['unit'] = 'Day';
				break;
			case 'W':
				$return['unit'] = 'Week';
				break;
			case 'M':
				$return['unit'] = 'Month';
				break;
			case 'Y':
				$return['unit'] = 'Year';
				break;
		}

		return $return;
	}

	function parseNotification( $post )
	{
		$security_code			= $post['ap_securitycode'];
		$description			= $post['ap_description'];
		$total					= $post['ap_amount'];
		$userid					= $post['apc_1'];
		$invoice_number			= $post['ap_itemname'];
		$planid					= $post['apc_3'];

		$response = array();
		$response['invoice'] = $invoice_number;

		return $response;
	}

	function validateNotification( $response, $post, $invoice )
	{
		$response['valid'] = false;

		if ( ( $post['ap_status'] == "Success" && $post['ap_purchasetype'] != "subscription" ) || ( $post['ap_status'] == "Subscription-Payment-Success" ) )  {
			if ( $post['ap_securitycode'] != $this->settings['securitycode'] ) {
				$response['error'] = 'Security Code Mismatch: ' . $post['ap_securitycode'];
			} else {
				$response['valid'] = true;
			}
		} elseif ( $post['ap_status'] == "Success" && $post['ap_purchasetype'] == "subscription" ) {
			$response['null']				= 1;
			$response['explanation']		= 'Duplicate Notification';
		} elseif ( $post['ap_status'] == "Subscription-Payment-Canceled" ) {
			$response['cancel'] = 1;
		} else {
			$response['error'] = 'ap_status: ' . $post['ap_status'];
		}

		return $response;
	}

}
?>