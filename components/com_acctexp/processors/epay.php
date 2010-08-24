<?php
/**
 * @version $Id: epay.php
 * @package AEC - Account Control Expiration - Membership Manager
 * @subpackage Processors - EPay
 * @copyright 2009 Copyright (C) David Deutsch
 * @author David Deutsch <skore@skore.de> & Team AEC - http://www.valanx.org
 * @license GNU/GPL v.2 http://www.gnu.org/licenses/old-licenses/gpl-2.0.html or, at your option, any later version
 */

// Dont allow direct linking
( defined('_JEXEC') || defined( '_VALID_MOS' )) or die( 'Direct Access to this location is not allowed.' );

class processor_epay extends POSTprocessor
{
	function info()
	{
		$info = array();
		$info['longname']		= _CFG_EPAY_LONGNAME;
		$info['statement']		= _CFG_EPAY_STATEMENT;
		$info['description']	= _CFG_EPAY_DESCRIPTION;
		$info['currencies']		= 'AUD,CAD,DKK,HKD,ISK,JPY,MXN,NZD,NOK,SGD,ZAR,SEK,CHF,GBP,USD,TRY,EUR,PLN';
		$info['languages']		= "DK,UK,SE,NO,GR,IS,DE";
		$info['cc_list']		= "mastercard,jcb,diners,americanexpress,giropay";
		$info['recurring']		= 0;

		return $info;
	}

	function settings()
	{
		$settings = array();
		$settings['merchantnumber']	= "merchant ID";
		$settings['currency']		= "DKK";
		$settings['language']		= "DK";
		$settings['md5type']		= "0";
		$settings['md5key']			= "";
		$settings['windowstate']	= 0;
		$settings['instantcapture']	= 0;
		$settings['group']			= "";
		$settings['description']	= sprintf( _CFG_PROCESSOR_ITEM_NAME_DEFAULT, '[[cms_live_site]]', '[[user_name]]', '[[user_username]]' );
		$settings['authsms']		= "";
		$settings['authmail']		= "";
		$settings['use3D']			= 0;
		$settings['addfee']			= 0;

		return $settings;
	}

	function backend_settings()
	{
		$settings = array();
		$settings['merchantnumber']	= array( 'inputC'	);
		$settings['currency']		= array( 'list_currency' );
		$settings['language']		= array( 'list_language' );
		$settings['md5type']		= array( 'inputC' );
		$settings['md5key']			= array( 'inputC', );
		$settings['windowstate']	= array( 'list_yesno' );
		$settings['instantcapture']	= array( 'list_yesno'	);
		$settings['group']			= array( 'inputC' );
		$settings['description']	= array( 'inputC' );
		$settings['authsms']		= array( 'inputC',	);
		$settings['authmail']		= array( 'inputC' );
		$settings['use3D']			= array( 'list_yesno'	);
		$settings['addfee']			= array( 'list_yesno');

		return $settings;
	}

	function generatekeyForEpay($cur, $amount, $orderid, $password) {
		return md5($cur . $amount . $orderid . $password);
	}

	function validateEpayData( $post )
	{
		$strForValidate = $post['amount'] . $post['orderid'] . $post['tid'] . $this->settings['md5key'];

		if ( md5( $strForValidate ) == $post['eKey'] ) {
			return true;
		} else {
			return false;
		}
	}

	function getEpayLanguage( $strlanguage )
	{
		$l = array( "DK" => 1, "UK" => 2, "SE" => 3, "NO" => 4, "GR" => 5, "IS" => 6, "DE" => 7 );

		if ( isset( $l[$strlanguage] ) ) {
			return $l[$strlanguage];
		} else {
			return "DK";
		}
	}

	function createGatewayLink( $request )
	{
		 // target for epay standard payment window
		$var['post_url']		= "https://ssl.ditonlinebetalingssystem.dk/popup/default.asp";
		$var['orderid']			= $request->invoice->id;
		$var['amount']			= $request->int_var['amount'] * 100;
		$var['merchantnumber']	= $this->settings['merchantnumber'];
		$var['currency']		= AECToolbox::aecNumCurrency( $this->settings['currency'] );
		$var['language']		= $this->getEpayLanguage( $this->settings['language'] );

		// for this solution always use state 2 (full window (same window))
		$var['windowstate']		= $this->settings['windowstate'];
		$var['accepturl']		= $request->int_var['return_url'];
		$var['declineurl']		= AECToolbox::deadsureURL("index.php?option=com_acctexp&amp;task=cancel");
		$var['callbackurl']		= AECToolbox::deadsureURL("index.php?option=com_acctexp&amp;task=epaynotification");

		$var['group']			= $this->settings['group'];
		$var['description']		= AECToolbox::rewriteEngineRQ( $this->settings['description'], $request );
		$var['authsms']			= $this->settings['authsms'];
		$var['authmail']		= $this->settings['authmail'];

		if ( $this->settings['use3D'] == 1 ) {
			$var['use3D'] = "1";
		}

		if ( $this->settings['addfee'] == 1 ) {
			$var['addfee'] = "1";
		}

		return $var;
	}

	function getPost( $post )
	{
		$f = array( "tid"		=> array( "word", "int" ),
					"orderid"	=> array( "word", "int" ),
					"amount"	=> array( "word", "badchars" ),
					"cur"		=> array( "word", "badchars" ),
					"date"		=> array( "word", "badchars" ),
					"eKey"		=> array( "word" ),
					"fraud"		=> array( "word" ),
					"cardid"	=> array( "word" ),
					"transfee"	=> array( "word", "badchars" )
					);

		$post = array();
		foreach ( $f as $k => $s ) {
			$post[$k] = aecGetParam( $k, '', true, $s );
		}

		return $post;
	}

	function parseNotification( $post )
	{
		$database = &JFactory::getDBO();

		$post = $this->getPost( $post );

		// Does not transmit invoice number, loading via invoice id
		$iid = $post['orderid'];

		if ( $iid ) {
			$inum = AECfetchfromDB::InvoiceNumberfromId( $iid );

			$response = array();
			$response['invoice']			= $inum;
			$response['amount_currency']	= $post['cur'];
			$response['amount_paid']		= $post['amount'];

			return $response;
		} else {
			return false;
		}
	}

	function validateNotification( $response, $post, $invoice )
	{
		$database = &JFactory::getDBO();

		$post = $this->getPost( $post );

		$response['fullresponse'] = $post;

		$response = array();
		$response['valid'] = 0;

		$minlen = array( 'tid', 'orderid', 'amount', 'cur', 'date' );

		foreach ( $minlen as $k ) {
			if ( strlen( $post[$k] ) == 0 ) {
				$response['pending_reason'] = 'Empty Data';
				return $response;
			}
		}

		if ( strcmp( $this->settings['md5type'], '1' ) == 0 || strcmp( $this->settings['md5type'], '2' ) == 0 ) {
			// make MD5 check
			if ( $this->validateEpayData( $post ) ) {
				// response seems ok
				$response['valid'] = 1;
			} else {
				$response['pending_reason'] = 'MD5 Key Error';
			}
		} else {
			// response seems ok
			$response['valid'] = 1;
		}

		return $response;
	}

}

?>
