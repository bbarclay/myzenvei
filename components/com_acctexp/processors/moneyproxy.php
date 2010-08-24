<?php
/**
 * @version $Id: moneyproxy.php
 * @package AEC - Account Control Expiration - Membership Manager
 * @subpackage Processors - Moneyproxy
 * @copyright 2006-2008 Copyright (C) David Deutsch
 * @author David Deutsch <skore@skore.de> & Team AEC - http://www.valanx.org
 * @license GNU/GPL v.2 http://www.gnu.org/licenses/old-licenses/gpl-2.0.html or, at your option, any later version
 */

// Dont allow direct linking
( defined('_JEXEC') || defined( '_VALID_MOS' ) ) or die( 'Direct Access to this location is not allowed.' );

class processor_moneyproxy extends POSTprocessor
{
	function info()
	{
		$info = array();
		$info['name']			= 'moneyproxy';
		$info['longname']		= _CFG_MONEYPROXY_LONGNAME;
		$info['statement']		= _CFG_MONEYPROXY_STATEMENT;
		$info['description']	= _CFG_MONEYPROXY_DESCRIPTION;
		$info['currencies']		= "GAU,CAD,EUR,USD";
		$info['languages']		= "EN";
		$info['cc_list']		= "visa,mastercard,discover,americanexpress,echeck,giropay";
		$info['recurring']		= 0;

		return $info;
	}

	function settings()
	{
		$settings = array();
		$settings['merchant_id']			= "merchant_id";
		$settings['force_client_receipt']	= 0;
		$settings['secret_key']				= "secret_key";
		$settings['suggested_memo']			= "";
		$settings['language']				= 'EN';
		$settings['item_name']				= sprintf( _CFG_PROCESSOR_ITEM_NAME_DEFAULT, '[[cms_live_site]]',
											'[[user_name]]', '[[user_username]]' );
		$settings['customparams']			= "";

		return $settings;
	}

	function backend_settings()
	{
		$settings = array();

		$settings['merchant_id']			= array( 'inputC' );
		$settings['secret_key']				= array( 'inputC' );
		$settings['force_client_receipt']	= array( 'list_yesno' );
		$settings['suggested_memo']			= array( 'inputD' );
		$settings['language']				= array( 'list_language' );
		$settings['item_name']				= array( 'inputE' );
		$settings['customparams']			= array( 'inputD' );

        $settings = AECToolbox::rewriteEngineInfo( null, $settings );

		return $settings;
	}

	function createGatewayLink( $request )
	{
		$var['merchant_id']				= $this->settings['merchant_id'];
		$var['amount']					= $request->int_var['amount'];
		$var['status_url']				= AECToolbox::deadsureURL( 'index.php?option=com_acctexp&amp;task=moneyproxynotification' );
		$var['return_success_url']		= $request->int_var['return_url'];
		$var['return_success_method']	= 'LINK';
		$var['return_failure_url']		= AECToolbox::deadsureURL( 'index.php?option=com_acctexp&amp;task=cancel' );
		$var['return_failure_method']	= 'LINK';
		$var['payment_id']				= substr( AECToolbox::rewriteEngineRQ( $this->settings['item_name'], $request ), 0, 10 );
		$var['force_client_receipt']	= $this->settings['force_client_receipt'];
		$var['suggested_memo']			= substr( $this->settings['suggested_memo'], 0, 40 );
		$var['language']				= strtolower( $this->settings['language'] );
		$var['custom1']					= $request->invoice->invoice_number;

		$var['input_hash']				= md5( implode( ':', $var ) . ':' . $this->settings['secret_key'] );

		return $var;
	}

	function parseNotification( $post )
	{
		$response = array();
		$response['invoice'] = $post['CUSTOM1'];
		$response['amount_paid'] = $post['AMOUNT'];
		$response['amount_currency'] = $post['CURRENCY'];

		return $response;
	}

	function validateNotification( $response, $post, $invoice )
	{
		$checkhash = implode( ':', array( $post['MERCHANT_ID'], $post['REFERENCE_NO'], $post['PAYMENT_ID'], $post['AMOUNT'], $post['CURRENCY'], $post['AMOUNT_GAU'], $post['EXRATE'], $post['MONEYPROXY_FEES_GAU'], $post['SYSTEM_FEES_GAU'], $post['PAYMENT_SYSTEM'], $post['CUSTOM1'], $this->settings['secret_key'] ) );

		if ( $post['HASH'] == $checkhash ) {
			$response['valid'] = true;
		} else {
			$response['valid'] = false;
		}

		return $response;
	}

}
?>