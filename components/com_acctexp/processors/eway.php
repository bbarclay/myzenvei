<?php
/**
 * @version $Id: eway.php
 * @package AEC - Account Control Expiration - Membership Manager
 * @subpackage Processors - eWay
 * @copyright 2006-2008 Copyright (C) David Deutsch
 * @author David Deutsch <skore@skore.de> & Team AEC - http://www.valanx.org
 * @license GNU/GPL v.2 http://www.gnu.org/licenses/old-licenses/gpl-2.0.html or, at your option, any later version
 */

// Dont allow direct linking
( defined('_JEXEC') || defined( '_VALID_MOS' ) ) or die( 'Direct Access to this location is not allowed.' );

class processor_eway extends POSTprocessor
{
	function info()
	{
		$info = array();
		$info['name']					= 'eway';
		$info['longname']				= _CFG_EWAY_LONGNAME;
		$info['statement']				= _CFG_EWAY_STATEMENT;
		$info['description']			= _CFG_EWAY_DESCRIPTION;
		$info['cc_list']				= 'visa,mastercard';
		$info['recurring']				= 0;
		$info['notify_trail_thanks']	= 1;

		return $info;
	}

	function settings()
	{
		$settings = array();
		$settings['testmode']		= "1";
		$settings['custId']			= "87654321";
		$settings['tax']			= "10";
		$settings['autoRedirect']	= 1;
		$settings['testAmount']		= "00";
		$settings['item_name']		= sprintf( _CFG_PROCESSOR_ITEM_NAME_DEFAULT, '[[cms_live_site]]', '[[user_name]]', '[[user_username]]' );
		$settings['customparams']	= "";

		return $settings;
	}

	function backend_settings()
	{
		$settings = array();
		$settings['testmode']		= array( 'list_yesno' );
		$settings['custId']			= array( 'inputC' );
		$settings['autoRedirect']	= array( 'list_yesno' ) ;
		$settings['SiteTitle']		= array( 'inputC' );
		$settings['item_name']		= array( 'inputE' );
		$settings['customparams']	= array( 'inputD' );

		$settings = AECToolbox::rewriteEngineInfo( null, $settings );

		return $settings;
	}

	function createGatewayLink( $request )
	{
		//URL returned by eWay
		$return_url = AECToolbox::deadsureURL("index.php?option=com_acctexp&amp;task=ewaynotification");

		//Genere un identifiant unique pour la transaction
		$my_trxn_number = uniqid( "eway_" );

		$order_total = $request->int_var['amount'] * 100;

		$var = array(	"post_url" => "https://www.eWAY.com.au/gateway/payment.asp",
						"ewayCustomerID" => $this->settings['custId'],
						"ewayTotalAmount" => $order_total,
						"ewayCustomerFirstName" => $request->metaUser->cmsUser->username,
						"ewayCustomerLastName" => $request->metaUser->cmsUser->name,
						"ewayCustomerInvoiceDescription" => AECToolbox::rewriteEngineRQ( $this->settings['item_name'], $request ),
						"ewayCustomerInvoiceRef" => $request->invoice->invoice_number,
						"ewayOption1" => $request->metaUser->cmsUser->id, //Send in option1, the id of the user
						"ewayOption2" => $request->invoice->invoice_number, //Send in option2, the invoice number
						"eWAYTrxnNumber" => $my_trxn_number,
						"eWAYAutoRedirect" => $this->settings['autoRedirect'],
						"eWAYSiteTitle" => $this->settings['SiteTitle'],
						"eWAYURL" => $return_url
					);

		return $var;
	}

	function parseNotification( $post )
	{
		$eWAYResponseText	= $post['eWAYresponseText'];
		$eWAYTrxnNumber		= $post['ewayTrxnNumber'];
		$eWAYResponseCode	= $post['eWAYresponseCode'];
		$ewayTrxnReference	= $post['ewayTrxnReference'];
		$eWAYAuthCode		= $post['eWAYAuthCode'];
		$total				= $post['eWAYReturnAmount'];
		$userid				= $post['eWAYoption1'];

		$response = array();
		$response['invoice'] = $post['eWAYoption2'];

		return $response;
	}

	function validateNotification( $response, $post, $invoice )
	{
		if ( $post['ewayTrxnStatus'] == "True" && isset( $post['eWAYAuthCode'] ) ) {
			$response['valid'] = 1;
		} else {
			$response['valid'] = 0;
		}

		return $response;
	}

}
?>
