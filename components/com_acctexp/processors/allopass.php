<?php
/**
 * @version $Id: allopass.php
 * @package AEC - Account Control Expiration - Membership Manager
 * @subpackage Processors - Allopass
 * @copyright 2006-2008 Copyright (C) David Deutsch
 * @author David Deutsch <skore@skore.de> & Team AEC - http://www.valanx.org
 * @license GNU/GPL v.2 http://www.gnu.org/licenses/old-licenses/gpl-2.0.html or, at your option, any later version
 */

// ------------------------------------
// "AlloPass" feature contributed by:
// educ
// Jul 2006
// Thanks!
// ------------------------------------

// Dont allow direct linking
( defined('_JEXEC') || defined( '_VALID_MOS' ) ) or die( 'Direct Access to this location is not allowed.' );

class processor_allopass extends XMLprocessor
{
	function info()
	{
		$info = array();
		$info['name'] = "allopass";
		$info['longname'] = "Allopass";
		$info['statement'] = "Make payments with Allopass!";
		$info['description'] = _DESCRIPTION_ALLOPASS;
		$info['cc_list'] = "visa,mastercard";
		$info['recurring'] = 0;
		$info['notify_trail_thanks'] = 1;

		return $info;
	}

	function settings()
	{
		$settings = array();
		$settings['siteid']			= "siteid";
		$settings['docid']			= "docid";
		$settings['auth']			= "auth";
		$settings['testmode']		= 0;
		$settings['item_name']		= sprintf( _CFG_PROCESSOR_ITEM_NAME_DEFAULT, '[[cms_live_site]]', '[[user_name]]', '[[user_username]]' );
		$settings['customparams']	= "";

		return $settings;
	}

	function backend_settings()
	{
		$settings = array();
		$settings['testmode']		= array( "list_yesno" );
		$settings['siteid']			= array( "inputC" );
		$settings['auth']			= array( "inputC" );
		$settings['item_name']		= array( "inputE" );
		$settings['customparams']	= array( 'inputD' );

		$settings				= AECToolbox::rewriteEngineInfo( null, $settings );

		return $settings;
	}

	function CustomPlanParams()
	{
		$p = array();
		$p['docid']	= array( 'inputC' );

		return $p;
	}

	function checkoutform( $request )
	{
		$var = array();
		$var['params']['DESC0'] = array("p", "<img scr=\"http://payment.allopass.com/acte/scripts/popup/access.apu?ids=" . $this->settings['siteid'] . "&idd=" . $this->settings['docid'] . "&lang=fr&country=fr\" />");
		$var['params']['CODE0'] = array("inputC", "Allopass Code", "");

		return $var;
	}

	function parseNotification( $post )
	{

   		$ssl_amount = aecGetParam( 'ssl_amount' ) ;

		$response = array();
		$response['invoice'] = $post['ssl_invoice_number'];

		return $response;
	}

	function createRequestXML( $request )
	{
		$var = array();
		$var['CODE']		= urlencode( $request->int_var['params']['CODE0'] );
		$var['AUTH']		= $this->settings['auth'];
		$var['SITE_ID']	= $this->settings['siteid'];
		$var['DOC_ID']		= $this->settings['docid'];

		$content = array();
		foreach ( $var as $name => $value ) {
			$content[] .= strtoupper( $name ) . '=' . urlencode( stripslashes( $value ) );
		}

		return implode( '&', $content );
	}

	function transmitRequestXML( $xml, $request )
	{
		$path = "/acte/access.apu";
		$url = "http://payment.allopass.com" . $path;

		$fp = $this->transmitRequest( $url, $path, $xml );

		$test_ap = substr( $fp, 0, 2 );

		if ( $test_ap == "OK" ) {
			$response['valid'] = true;
			return;
		} else {
			$response['valid'] = false;

			if ( empty( $request->int_var['params']['CODE0'] ) ) {
				$response['error'] = 'No code entered!';
			} elseif ( empty( $test_ap ) ) {
				$response['error'] = 'Unknown Error - no response from processor';
			} else {
				$response['error'] = $test_ap;
			}
		}

		return $response;
	}

}

		//$var['currency_code']			= $this->settings['currency_code'];
		//$var['ssl_merchant_id']			= $var['SITE_ID'];
		//$var['ssl_user_id']				= $var['DOC_ID'];
		//$var['ssl_pin']					= $var['AUTH'];
		//$var['ssl_invoice_number']		= $request->invoice->invoice_number;
		//$var['ssl_salestax']			= "0";
		//$var['ssl_result_format']		= "HTML";
		//$var['ssl_receipt_link_method']	= "POST";
		//$var['ssl_receipt_link_url']	= AECToolbox::deadsureURL("index.php?option=com_acctexp&amp;task=allopassnotification");
		//$var['ssl_receipt_link_text']	= "Continue";
		//$var['ssl_amount']				= $request->int_var['amount'];

		//$var['ssl_customer_code']		= $request->metaUser->cmsUser->id;
		//$var['ssl_description']			= AECToolbox::rewriteEngineRQ( $this->settings['item_name'], $request );

?>