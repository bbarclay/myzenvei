<?php
/**
 * @version $Id: authorize.php
 * @package AEC - Account Control Expiration - Membership Manager
 * @subpackage Processors - Authorize
 * @copyright 2006-2008 Copyright (C) David Deutsch
 * @author David Deutsch <skore@skore.de> & Team AEC - http://www.valanx.org
 * @license GNU/GPL v.2 http://www.gnu.org/licenses/old-licenses/gpl-2.0.html or, at your option, any later version
 */

// Dont allow direct linking
( defined('_JEXEC') || defined( '_VALID_MOS' ) ) or die( 'Direct Access to this location is not allowed.' );

class processor_authorize extends POSTprocessor
{
	function info()
	{
		$info = array();
		$info['name'] = "authorize";
		$info['longname'] = "Authorize.net";
		$info['statement'] = "Make payments with Authorize.net!";
		$info['description'] = _DESCRIPTION_AUTHORIZE;
		$info['currencies'] = AECToolbox::aecCurrencyField( true, true, true, true );
		$info['cc_list'] = "visa,mastercard,discover,americanexpress,echeck,jcb,dinersclub";
		$info['recurring'] = 0;
		$info['notify_trail_thanks'] = 1;

		return $info;
	}

	function settings()
	{
		$settings = array();
		$settings['login']				= "login";
		$settings['transaction_key']	= "transaction_key";
		$settings['testmode']			= 0;
		$settings['currency']			= "USD";
		$settings['timestamp_offset']	= '';
        $settings['item_name']			= sprintf( _CFG_PROCESSOR_ITEM_NAME_DEFAULT, '[[cms_live_site]]', '[[user_name]]', '[[user_username]]' );
        $settings['customparams']		= "";

		// Customization
		$settings['x_logo_url']				= '';
		$settings['x_background_url']		= '';
		$settings['x_color_background']		= '';
		$settings['x_color_link']			= '';
		$settings['x_color_text']			= '';
		$settings['x_header_html_receipt']	= '';
		$settings['x_footer_html_receipt']	= '';

		return $settings;
	}

	function backend_settings()
	{
		$settings = array();
		$settings['testmode']			= array( "list_yesno" );
		$settings['login'] 				= array( "inputC" );
		$settings['transaction_key']	= array( "inputC" );
		$settings['currency']			= array( "list_currency" );
		$settings['timestamp_offset']	= array( "inputC" );
		$settings['item_name']			= array( "inputE" );
		$settings['customparams']		= array( 'inputD' );

		$settings = AECToolbox::rewriteEngineInfo( null, $settings );

		// Customization
		$settings['x_logo_url']				= array( 'inputE' );
		$settings['x_background_url']		= array( 'inputE' );
		$settings['x_color_background']		= array( 'inputC' );
		$settings['x_color_link']			= array( 'inputC' );
		$settings['x_color_text']			= array( 'inputC' );
		$settings['x_header_html_receipt']	= array( 'inputE' );
		$settings['x_footer_html_receipt']	= array( 'inputE' );

		return $settings;
	}

	function createGatewayLink( $request )
	{
		if ( $this->settings['testmode'] ) {
			$var['post_url']	= "https://test.authorize.net/gateway/transact.dll";
		} else {
			$var['post_url']	= "https://secure.authorize.net/gateway/transact.dll";
		}

		$var['x_login']					= $this->settings['login'];
		$var['x_invoice_num']			= $request->invoice->invoice_number;
		$var['x_receipt_link_method']	= "POST";
		$var['x_receipt_link_url']		= AECToolbox::deadsureURL("index.php?option=com_acctexp&amp;task=authorizenotification");
		$var['x_receipt_link_text']		= "Continue";
		$var['x_show_form']				= "PAYMENT_FORM";
		//$var['x_relay_response']		= "True";
		//$var['x_relay_url']			= AECToolbox::deadsureURL('index.php?option=com_acctexp&task=authnotification');

		$var['x_amount'] = $request->int_var['amount'];
		srand(time());
		$sequence = rand(1, 1000);

		if ( !empty( $this->settings['timestamp_offset'] ) ) {
			$tstamp = time() + $this->settings['timestamp_offset'];
		} else {
			$tstamp = time();
		}

		// Calculate fingerprint
		$data = $this->settings['login'] . "^" . $sequence . "^" . $tstamp . "^" . $request->int_var['amount'] . "^" . "";
		$fingerprint = $this->hmac($this->settings['transaction_key'], $data);
		// Insert the form elements required for SIM
		$var['x_fp_sequence']	= $sequence;

		$var['x_fp_timestamp']	= $tstamp;
		$var['x_fp_hash']		= $fingerprint;

		$var['x_cust_id']			= $request->metaUser->cmsUser->id;
		$var['x_description']		= AECToolbox::rewriteEngineRQ( $this->settings['item_name'], $request );

		$s = array( 'x_logo_url', 'x_background_url', 'x_color_background', 'x_color_link',
					'x_color_text', 'x_header_html_receipt', 'x_footer_html_receipt' );

		foreach ( $s as $n ) {
			$var[$n]		= AECToolbox::rewriteEngineRQ( $this->settings[$n], $request );
		}

		return $var;
	}

	function parseNotification( $post )
	{
		$x_description			= $post['x_description'];

		$x_amount				= $post['x_amount'];
		$userid					= $post['x_cust_id'];

		$response = array();
		$response['invoice'] = $post['x_invoice_num'];

		return $response;
	}

	function validateNotification( $response, $post, $invoice )
	{
		$x_response_code		= $post['x_response_code'];
		$x_response_reason_text	= $post['x_response_reason_text'];

		$response['valid'] = ($x_response_code == '1');

		return $response;
	}

	function hmac( $key, $data )
	{
	   // RFC 2104 HMAC implementation for php.
	   // Creates an md5 HMAC.
	   // Eliminates the need to install mhash to compute a HMAC
	   // Hacked by Lance Rushing

	   $b = 64; // byte length for md5

	   if (strlen($key) > $b) {
	       $key = pack("H*",md5($key));
	   }
	   $key  = str_pad($key, $b, chr(0x00));
	   $ipad = str_pad('', $b, chr(0x36));
	   $opad = str_pad('', $b, chr(0x5c));
	   $k_ipad = $key ^ $ipad ;
	   $k_opad = $key ^ $opad;

	   return md5($k_opad  . pack("H*",md5($k_ipad . $data)));
	}

}
?>