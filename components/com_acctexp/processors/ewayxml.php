<?php
/**
 * @version $Id: ewayxml.php
 * @package AEC - Account Control Expiration - Membership Manager
 * @subpackage Processors - eWay XML
 * @copyright 2006-2008 Copyright (C) David Deutsch
 * @author David Deutsch <skore@skore.de> & Team AEC - http://www.valanx.org
 * @license GNU/GPL v.2 http://www.gnu.org/licenses/old-licenses/gpl-2.0.html or, at your option, any later version
 */

// Dont allow direct linking
( defined('_JEXEC') || defined( '_VALID_MOS' ) ) or die( 'Direct Access to this location is not allowed.' );

/**
* AcctExp Component
* @package AEC - Account Control Expiration - Membership Manager
* @subpackage processor
* @copyright 2006-2008 Copyright (C) David Deutsch
* @license GNU/GPL v.2 http://www.gnu.org/licenses/old-licenses/gpl-2.0.html or, at your option, any later version
* @author David Deutsch <skore@skore.de> & Team AEC - http://www.valanx.org
**/

class processor_ewayxml extends XMLprocessor
{
	function info()
	{
		$info = array();
		$info['name']			= 'ewayxml';
		$info['longname']		= _CFG_EWAYXML_LONGNAME;
		$info['statement']		= _CFG_EWAYXML_STATEMENT;
		$info['description']	= _CFG_EWAYXML_DESCRIPTION;
		$info['cc_list']		= 'visa,mastercard';
		$info['recurring']		= 0;

		return $info;
	}

	function settings()
	{
		$settings = array();
		$settings['testmode']		= "1";
		$settings['custId']		= "87654321";
		$settings['tax']			= "10";
		$settings['testAmount']	= "00";
		$settings['item_name']	= sprintf( _CFG_PROCESSOR_ITEM_NAME_DEFAULT, '[[cms_live_site]]', '[[user_name]]', '[[user_username]]' );
		$settings['rewriteInfo']	= '';
		$settings['SiteTitle']	= '';

		return $settings;
	}

	function backend_settings()
	{
		$settings = array();
		$settings['testmode']	= array( 'list_yesno' );
		$settings['custId']		= array( 'inputC' );
		$settings['SiteTitle']	= array( 'inputC' );
		$settings['item_name']	= array( 'inputE' );

 		$rewriteswitches		= array( 'cms', 'user', 'expiration', 'subscription', 'plan');
		$settings = AECToolbox::rewriteEngineInfo( $rewriteswitches, $settings );

		return $settings;
	}

	function createRequestXML( $request )
	{

		$order_total = $request->int_var['amount'] * 100;
		$my_trxn_number = uniqid( "eway_" );

		$nodes = array(	"ewayCustomerID" => $this->settings['custId'],
						"ewayTotalAmount" => $order_total,
						"ewayCustomerFirstName" => $request->metaUser->cmsUser->username,
						"ewayCustomerLastName" => $request->metaUser->cmsUser->name,
						"ewayCustomerInvoiceDescription" => AECToolbox::rewriteEngineRQ( $this->settings['item_name'], $request ),
						"ewayCustomerInvoiceRef" => $request->invoice->invoice_number,
						"ewayOption1" => $request->metaUser->cmsUser->id, //Send in option1, the id of the user
						"ewayOption2" => $request->invoice->invoice_number, //Send in option2, the invoice number
						"ewayTrxnNumber" => $my_trxn_number,
						"ewaySiteTitle" => $this->settings['SiteTitle'],
						"ewayCardHoldersName" => $request->int_var['params']['billFirstName'] . ' ' . $request->int_var['params']['billLastName'],
						"ewayCardNumber" => $request->int_var['params']['cardNumber'],
						"ewayCardExpiryMonth" => $request->int_var['params']['expirationMonth'],
						"ewayCardExpiryYear" => $request->int_var['params']['expirationYear'],
						"ewayCustomerEmail" => $request->metaUser->cmsUser->email,
						"ewayCustomerAddress" => '',
						"ewayCustomerPostcode" => '',
						"ewayOption3" => ''
						);
		$xml = '<ewaygateway>';

		foreach($nodes as $name => $value){
			$xml .= "<" . $name . ">" . $value . "</" . $name . ">";
		}
		$xml .= '</ewaygateway>';

		return $xml;
	}

	function transmitRequestXML( $xml, $request )
	{
		if ( $this->settings['testmode'] ) {
			$url = 'https://www.eway.com.au/gateway/xmltest/testpage.asp';
		} else {
			$url = 'https://www.eway.com.au/gateway/xmlpayment.asp';
		}
		$response = array();

		if ( $objResponse = simplexml_load_string( $this->transmitRequest( $url, '', $xml ) ) ) {
			$response['amount_paid'] = $objResponse->ewayReturnAmount / 100;
			$response['invoice'] = $objResponse->ewayTrxnOption2;
			//$response['raw'] = $objResponse->ewayTrxnError;

			if ( $objResponse->ewayTrxnStatus == 'True' ) {
				$response['valid'] = 1;
			} else {
				$response['valid'] = 0;
				$response['error'] = $objResponse->ewayTrxnError;
			}
		} else {
			$response['valid'] = 0;
			$response['error'] = _CFG_EWAYXML_CONNECTION_ERROR;
		}

		return $response;
	}

	function checkoutform()
	{
		$var = $this->getUserform();
		$var = $this->getCCform();

		return $var;
	}

	function doTheCurl( $url, $content )
	{
		$ch = curl_init();
		curl_setopt( $ch, CURLOPT_URL, $url );
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
		curl_setopt( $ch, CURLOPT_HTTPHEADER, Array("Content-Type: text/xml") );
		curl_setopt( $ch, CURLOPT_POST, 1 );
		curl_setopt( $ch, CURLOPT_POSTFIELDS, $content );
		curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, FALSE );
		$response = curl_exec( $ch );
		curl_close( $ch );

		return $response;
	}
}
?>
