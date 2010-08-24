<?php
/**
 * @version $Id: psigate.php
 * @package AEC - Account Control Expiration - Membership Manager
 * @subpackage Processors - Psigate
 * @copyright 2007-2008 Copyright (C) David Deutsch
 * @author David Deutsch <skore@skore.de> & Team AEC - http://www.valanx.org
 * @license GNU/GPL v.2 http://www.gnu.org/licenses/old-licenses/gpl-2.0.html or, at your option, any later version
 */

// Dont allow direct linking
( defined('_JEXEC') || defined( '_VALID_MOS' ) ) or die( 'Direct Access to this location is not allowed.' );

class processor_psigate extends POSTprocessor
{
	function info()
	{
		$info = array();
		$info['name'] = "psigate";
		$info['longname'] = "psigate";
		$info['statement'] = "Make payments with PSIGate!";
		$info['description'] = "PSIGate";
		$info['cc_list'] = "visa,mastercard,discover,echeck,jcb";
		$info['currencies'] = "USD,CAD";
		$info['recurring'] = 0;
		$info['notify_trail_thanks'] = 1;

		return $info;
	}

	function settings()
	{
		$settings = array();
		$settings['testmode']		= 0;
		$settings['StoreKey']		= "StoreKey";
		$settings['secretWord']		= "Secret Word";
		$settings['customparams']	= "";

		return $settings;
	}

	function backend_settings()
	{
		$settings = array();

		$settings['testmode']		= array( "list_yesno", "Test Mode", "Operate in PSIGate TEST mode" );
		$settings['StoreKey']		= array( "inputC","Store Key","Your Alphanumeric ID assigned by PSIGate" );
		$settings['secretWord']		= array( "inputC","Secret Word","Used to encrypt and protect transactions" );
		$settings['customparams']	= array( 'inputD' );
		return $settings;
	}

	function createGatewayLink( $request )
	{
		if ( $this->settings['testmode'] ) {
			$var['post_url']	= "https://dev.psigate.com/HTMLPost/HTMLMessenger";
		} else {
			$var['post_url']	= "https://checkout.psigate.com/HTMLPost/HTMLMessenger";
		}

		$var['StoreKey']		= $this->settings['StoreKey'];
		$var['CustomerRefNo']	= $request->invoice->invoice_number;
		//$var['OrderID']			= md5($this->settings['secretWord'] . $request->int_var['amount']);
		$var['SubTotal']		= $request->int_var['amount'];
		$var['PaymentType']		= "CC";
		$var['ThanksURL']		= AECToolbox::deadsureURL( "index.php?option=com_acctexp&amp;task=psigatenotification" );
		$var['NoThanksURL']		= AECToolbox::deadsureURL( "index.php?option=com_acctexp&amp;task=psigatenotification" );
		$var['CardAction']		= "0";
		$var['test123']			= "tester123";
		return $var;
	}


	function parseNotification ( $post )
	{
		$ReturnCode	= aecGetParam('ReturnCode', 'NA');
		$ErrMsg		= aecGetParam('ErrMsg', 'NA');
		$FullTotal	= aecGetParam('FullTotal', 'NA');
		$CardNumber	= aecGetParam('CardNumber', 'NA');
		$OrderID	= aecGetParam('OrderID', 'NA');

		$checksum	= md5($OrderID . $FullTotal);

		$response = array();
		$response['TransRefNumber']	= aecGetParam('TransRefNumber', 'NA');
		$response['Approved']		= aecGetParam('Approved', 'NA');
		$response['FullTotal']		= $FullTotal;
		$response['CardNumber']		= $CardNumber;
		$response['OrderID']		= $OrderID;
		$response['invoice']		= aecGetParam('CustomerRefNo', 'NA');


		$validate			= md5($this->settings['secretWord'] . $FullTotal);
		$response['valid']	= (strcmp($validate, $checksum) == 0);

		if ( $response['valid'] = 1 ){
			if ( substr( $ReturnCode, 0, 1 ) == "Y" ) {
				print_r("<b>Thankyou! - Your Card was approved</b><br/>");
				print_r("</br>");
				print_r("<b>Card No:</b>". $CardNumber . "<br/>");
				print_r("<b>Total Charged:</b>". $FullTotal . "<br/>");
				print_r("<br/>");
			} else {
				$response['valid']			= 0;
				$response['pending']		= 1;
				$response['pending_reason']	= $ErrMsg;
				print_r("<b>Transaction Declined <br/>Reason: </b>" .$ErrMsg . "<br/>");
			}
		} else  {
			$response['valid'] = 0;
			$response['pending']=1;
			$response['pending_reason']=$ErrMsg;
			print_r("<b>Transaction Declined (cs)<br/>Reason: </b>" .$ErrMsg . "<br/>");

		}

		print_r("<b>TransRefNumber:</b>". $response['TransRefNumber'] . "<br/>");
		print_r("<b>Invoice:</b>". $response['invoice'] . "<br/>");
		print_r("<b>OrderID:</b>". $response['OrderID']. "<br/>");

		return $response;
	}
}
?>
