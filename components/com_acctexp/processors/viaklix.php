<?php
/**
 * @version $Id: viaklix.php
 * @package AEC - Account Control Expiration - Membership Manager
 * @subpackage Processors - Viaklix
 * @copyright 2007-2008 Copyright (C) David Deutsch
 * @author David Deutsch <skore@skore.de> & Team AEC - http://www.valanx.org
 * @license GNU/GPL v.2 http://www.gnu.org/licenses/old-licenses/gpl-2.0.html or, at your option, any later version
 */

// Dont allow direct linking
( defined('_JEXEC') || defined( '_VALID_MOS' ) ) or die( 'Direct Access to this location is not allowed.' );

class processor_viaklix extends POSTprocessor
{
	function info()
	{
		$info = array();
		$info['name']					= "viaklix";
		$info['longname']				= "Viaklix";
		$info['statement']				= "Make payments with Viaklix!";
		$info['description']			= _DESCRIPTION_VIAKLIX;
		$info['cc_list']				= "visa,mastercard,discover,americanexpress,echeck,giropay";
		$info['recurring']				= 0;
		$info['notify_trail_thanks']	= 1;

		return $info;
	}

	function settings()
	{
		$settings = array();

		$settings['accountid']		= "your account id";
		$settings['userid']			= "your user id";
		$settings['pin']			= "your pin";
		$settings['testmode']		= 0;
		$settings['item_name']		= sprintf( _CFG_PROCESSOR_ITEM_NAME_DEFAULT, '[[cms_live_site]]', '[[user_name]]', '[[user_username]]' );
		$settings['customparams']	= "";

		return $settings;
	}

	function backend_settings()
	{
		$settings = array();

		$settings['testmode']		= array( "list_yesno" );
		$settings['accountid']		= array( "inputC" );
		$settings['userid']			= array( "inputC" );
		$settings['pin']			= array( "inputC" );
		$settings['item_name']		= array( "inputE" );
		$settings['customparams']	= array( 'inputD' );

		$settings = AECToolbox::rewriteEngineInfo( null, $settings );

		return $settings;
	}

	function createGatewayLink( $request )
	{
		$var['post_url']				= "https://www.viaKLIX.com/process.asp";
		$var['ssl_test_mode']			= $this->settings['testmode'] ? "true" : "false";

		$var['ssl_merchant_id']			= $this->settings['accountid'];
		//$var['ssl_user_id']				= $this->settings['userid'];
		$var['ssl_pin']					= $this->settings['pin'];
		$var['ssl_invoice_number']		= $request->invoice->invoice_number;
		$var['ssl_salestax']			= "0";
		$var['ssl_result_format']		= "HTML";
		$var['ssl_receipt_link_method']	= "POST";
		$var['ssl_receipt_link_url']	= AECToolbox::deadsureURL("index.php?option=com_acctexp&amp;task=viaklixnotification");
		$var['ssl_receipt_link_text']	= "Continue";
		$var['ssl_amount']				= $request->int_var['amount'];
		$var['currency_code']			= $this->settings['currency_code'];

		$var['item_number']				= $row->id;
		$var['item_name']				= AECToolbox::rewriteEngineRQ( $this->settings['item_name'], $request );
		$var['custom']					= $request->int_var['usage'];

		return $var;
	}

	function parseNotification( $post )
	{
		$response = array();
		$response['invoice'] = $post['ssl_invoice_number'];

		return $response;
	}

	function validateNotification( $response, $post, $invoice )
	{
		$response['valid'] = ( $post['ssl_result'] == 0 ) && ( strcmp ( $post['ssl_result_message'], "APPROVED") == 0 );

		return $response;
	}

}
?>