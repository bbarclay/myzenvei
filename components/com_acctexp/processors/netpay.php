<?php
/**
 * @version $Id: netpay.php
 * @package AEC - Account Control Expiration - Membership Manager
 * @subpackage Processors - Netpay
 * @copyright 2006-2008 Copyright (C) David Deutsch
 * @author David Deutsch <skore@skore.de> & Team AEC - http://www.valanx.org
 * @license GNU/GPL v.2 http://www.gnu.org/licenses/old-licenses/gpl-2.0.html or, at your option, any later version
 */

// Dont allow direct linking
( defined('_JEXEC') || defined( '_VALID_MOS' ) ) or die( 'Direct Access to this location is not allowed.' );

class processor_netpay extends POSTprocessor
{
	function info()
	{
		$info = array();
		$info['name']			= "netpay";
		$info['longname']		= "Net Builder";
		$info['statement']		= "Make payments with NetPay - it\'s fast, free and secure!";
		$info['currencies']		= "MYR";
		$info['description']	= "NetPay is the easiest and most affordable payment gateway in Malaysia. Process credit card payments via NetPay\'s own secure Shared Payment Page in real-time.";
		$info['cc_list']		= "visa,mastercard";
		$info['recurring']		= 0;
		return $info;
	}

	function settings()
	{
		$settings = array();
		$settings['testmode']		= "1";
		$settings['custId']			= "custid";
		$settings['password']		= "password";
		$settings['item_name']		= sprintf( _CFG_PROCESSOR_ITEM_NAME_DEFAULT, '[[cms_live_site]]', '[[user_name]]', '[[user_username]]' );
		$settings['rewriteInfo']	= '';

		return $settings;
	}

	function backend_settings()
	{
		$settings = array();

		$settings['testmode']			= array( 'list_yesno' );
		$settings['custId']				= array( 'inputC' );
		$settings['password']			= array( 'inputC' );
		$settings['item_name']			= array( 'inputE' );
		$settings['aec_experimental']	= array( 'p' );

 		$rewriteswitches			= array( 'cms', 'user', 'expiration', 'subscription', 'plan');
		$settings = AECToolbox::rewriteEngineInfo( $rewriteswitches, $settings );

		return $settings;
	}

	function createGatewayLink( $request )
	{
		$var = array(	"post_url" => "https://www.onlinepayment.com.my/NBepay/pay/" . $this->settings['custId'] . "/?",
						"orderid" => $request->invoice->invoice_number, //The invoice number
						"bill_name" => $request->metaUser->cmsUser->name,
						"bill_email" => $request->metaUser->cmsUser->email,
						"bill_mobile" =>'',
						"amount" => $request->int_var['amount'],
						"bill_desc" => AECToolbox::rewriteEngineRQ( $this->settings['item_name'], $request )
					);
		return $var;
	}

	function parseNotification( $post )
	{
		$tranID		= $post['tranID'];
		$orderid	= $post['orderid'];
		$status		= $post['status'];
		$domain		= $post['domain'];
		$amount		= $post['amount'];
		$currency	= $post['currency'];
		$appcode	= $post['appcode'];
		$paydate	= $post['paydate'];
		$skey		= $post['skey'];

		// All undeclared variables below are coming from POST method
		$key0 = md5( $tranID.$orderid.$status.$domain.$amount.$currency );
		$key1 = md5( $paydate.$domain.$key0.$appcode.$this->settings['password'] );
		if( $skey != $key1 ) $status= -1; // invalid transaction

		$response = array();

		$response['invoice'] = $post['orderid'];

		if ( $post['status'] == "00" && !empty( $appcode ) ) {
			$response['valid'] = 1;    // Means Status is OK and there is a value in the Approval Code, then update 1
		} else {
			$response['valid'] = 0;
		}

		return $response;
	}



}

?>
