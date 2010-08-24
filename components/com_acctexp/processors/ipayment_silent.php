<?php
/**
 * @version $Id: ipayment_silent.php
 * @package AEC - Account Control Expiration - Membership Manager
 * @subpackage Processors - iPayment silent
 * @copyright 2006-2008 Copyright (C) David Deutsch
 * @author David Deutsch <skore@skore.de> & Team AEC - http://www.valanx.org
 * @license GNU/GPL v.2 http://www.gnu.org/licenses/old-licenses/gpl-2.0.html or, at your option, any later version
 */

// Dont allow direct linking
( defined('_JEXEC') || defined( '_VALID_MOS' ) ) or die( 'Direct Access to this location is not allowed.' );
error_reporting(E_ALL);
class processor_ipayment_silent extends XMLprocessor
{
	function info()
	{
		$info = array();
		$info['name'] = 'ipayment_silent';
		$info['longname'] = _CFG_IPAYMENT_SILENT_LONGNAME;
		$info['statement'] = _CFG_IPAYMENT_SILENT_STATEMENT;
		$info['description'] = _CFG_IPAYMENT_SILENT_DESCRIPTION;
		$info['currencies'] = AECToolbox::aecCurrencyField( true, true, true, true );
		$info['cc_list'] = "visa,mastercard,discover,americanexpress,echeck,jcb,dinersclub";
		$info['secure'] = 1;
		$info['recurring']				= 0;

		return $info;
	}

	function settings()
	{
		$settings = array();

		$settings['testmode']		= 0;
		$settings['fake_account']	= 0;
		$settings['user_id']		= "user_id";
		$settings['account_id']		= 'account_id';
		$settings['password']		= "password";
		$settings['currency']		= "USD";
		$settings['promptAddress']	= 0;
		$settings['item_name']		= sprintf( _CFG_PROCESSOR_ITEM_NAME_DEFAULT, '[[cms_live_site]]', '[[user_name]]', '[[user_username]]' );
		$settings['rewriteInfo']	= '';

		return $settings;
	}

	function backend_settings()
	{
		$settings = array();
		$settings['aec_experimental']	= array( "p" );
		$settings['testmode']			= array( "list_yesno" );
		$settings['fake_account']		= array( "list_yesno" );
		$settings['user_id'] 			= array( "inputC" );
		$settings['account_id']			= array( "inputC" );
		$settings['password']			= array( "inputC" );
		$settings['currency']			= array( "list_currency" );
		$settings['promptAddress']		= array( "list_yesno" );
		$settings['item_name']			= array( "inputE" );

 		$rewriteswitches				= array( 'cms', 'user', 'expiration', 'subscription', 'plan');
		$settings = AECToolbox::rewriteEngineInfo( $rewriteswitches, $settings );

		return $settings;
	}

	function checkoutform( $request )
	{
		$var['params']['billInfo']			= array( 'p', _AEC_IPAYMENT_SILENT_PARAMS_BILLINFO_ELV_NAME, _AEC_IPAYMENT_SILENT_PARAMS_BILLINFO_ELV_DESC );
		$var['params']['accountName']		= array( 'inputC', _AEC_WTFORM_ACCOUNTNAME_NAME, _AEC_WTFORM_ACCOUNTNAME_NAME, $request->metaUser->cmsUser->name );
		$var['params']['accountNumber']		= array( 'inputC', _AEC_WTFORM_ACCOUNTNUMBER_NAME, _AEC_WTFORM_ACCOUNTNUMBER_NAME, '' );
		$var['params']['bankNumber']		= array( 'inputC', _AEC_WTFORM_BANKNUMBER_NAME, _AEC_WTFORM_BANKNUMBER_NAME, '' );
		$var['params']['bankName']			= array( 'inputC', _AEC_WTFORM_BANKNAME_NAME, _AEC_WTFORM_BANKNAME_NAME, '' );

		$name = explode( ' ', $request->metaUser->cmsUser->name );

		if ( empty( $name[1] ) ) {
			$name[1] = "";
		}

		$var['params']['billInfo2']			= array( 'p', _AEC_IPAYMENT_SILENT_PARAMS_BILLINFO_CC_NAME, _AEC_IPAYMENT_SILENT_PARAMS_BILLINFO_CC_DESC );

		$values = array( 'card_number', 'card_exp_month', 'card_exp_year', 'card_cvv2' );

		$var = $this->getCCform( $var, $values );

		$var['params']['billInfo']			= array( 'p', _AEC_IPAYMENT_SILENT_PARAMS_BILLINFO_NAME, _AEC_IPAYMENT_SILENT_PARAMS_BILLINFO_DESC );
		$var['params']['billFirstName']		= array( 'inputC', _AEC_IPAYMENT_SILENT_PARAMS_BILLFIRSTNAME_NAME, _AEC_IPAYMENT_SILENT_PARAMS_BILLFIRSTNAME_NAME, $name[0] );
		$var['params']['billLastName']		= array( 'inputC', _AEC_IPAYMENT_SILENT_PARAMS_BILLLASTNAME_NAME, _AEC_IPAYMENT_SILENT_PARAMS_BILLLASTNAME_NAME, $name[1] );

		$var['params']['billInfo']			= array( 'p', _AEC_IPAYMENT_SILENT_PARAMS_BILLINFO_NAME, _AEC_IPAYMENT_SILENT_PARAMS_BILLINFO_DESC );

		if ( !empty( $this->settings['promptAddress'] ) ) {
			$var['params']['billAddress']	= array( 'inputC', _AEC_IPAYMENT_SILENT_PARAMS_BILLADDRESS_NAME );
			$var['params']['billCity']		= array( 'inputC', _AEC_IPAYMENT_SILENT_PARAMS_BILLCITY_NAME );
			$var['params']['billState']		= array( 'inputC', _AEC_IPAYMENT_SILENT_PARAMS_BILLSTATE_NAME );
			$var['params']['billZip']		= array( 'inputC', _AEC_IPAYMENT_SILENT_PARAMS_BILLZIP_NAME );
			$var['params']['billCountry']	= array( 'inputC', _AEC_IPAYMENT_SILENT_PARAMS_BILLCOUNTRY_NAME );
		}

		return $var;
	}

	function createRequestXML( $request )
	{
		$database = &JFactory::getDBO();

		if ( isset( $request->invoice->params['creator_ip'] ) ) {
			$ip = $request->invoice->params['creator_ip'];
		} else {
			$ip = $_SERVER['REMOTE_ADDR'];
		}

		$a = array();

		if ( empty( $request->int_var['params']['cc_number'] ) ) {
			$a['trx_paymenttyp']	= 'elv';
		} else {
			$a['trx_paymenttyp']	= 'cc';
		}

		if ( !empty( $this->settings['fake_account'] ) ) {
			$a['trxuser_id']		= '99999';
			$a['trxpassword']		= '0';
		} else {
			$a['trxuser_id']		= $this->settings['user_id'];
			$a['trxpassword']		= $this->settings['password'];
		}

		$a['order_id']		= AECfetchfromDB::InvoiceIDfromNumber( $request->invoice->invoice_number );
		$a['from_ip']		= $ip;
		$a['trx_currency']	= $this->settings['currency'];
		$a['trx_amount']	= (int) ( $request->int_var['amount'] * 100 );
		$a['trx_typ']		= 'auth';
		$a['invoice_text']	= $request->invoice->invoice_number;
		$a['addr_email']	= $request->metaUser->cmsUser->email;

		$varray = array(	'addr_name'	=>	'billFirstName',
							'addr_street'	=>	'billAddress',
							'addr_city'	=>	'billCity',
							'addr_zip'	=>	'billZip',
							'addr_country'	=>	'billCountry',
							'addr_state'	=>	'billState',
							'addr_telefon'	=>	'billTelephone',
							'cc_number'	=>	'cardNumber',
							'cc_expdate_month'	=>	'expirationMonth',
							'cc_expdate_year'	=>	'expirationYear',
							'cc_checkcode'	=>	'',
							'bank_accountnumber'	=>	'accountNumber',
							'bank_code'	=>	'bankNumber',
							'bank_name'	=>	'bankName'
						);
		foreach ( $varray as $n => $p ) {
			if ( !empty( $request->int_var['params'][$p] ) ) {
				if ( ( ( $n == 'cc_expdate_month' ) || ( $n == 'cc_expdate_year' ) ) && empty( $request->int_var['params']['cc_number'] ) ) {
					continue;
				}

				$a[$n] = $request->int_var['params'][$p];
			}
		}

		$a['client_name']		= 'aec';
		$a['client_version']	= '0.12';
		$a['silent']			= 1;

		$a['redirect_action']	= 'POST';
		$a['redirect_url']		= str_replace( '&amp;', '&', $request->int_var['return_url'] );
		$a['silent_error_url']	= AECToolbox::deadsureURL( 'index.php?option=com_acctexp&task=cancel', false, true );

		$a['hidden_trigger_url']		= AECToolbox::deadsureURL( 'index.php?option=com_acctexp&task=ipayment_silentnotification', false, true );
		$a['noparams_on_redirect_url']	= 1;
		$a['noparams_on_error_url']		= 1;

		$a['tempsecret'] = substr( base64_encode( md5( rand() ) ), 0, 12 );

		$request->invoice->addParams( array( 'tempsecret' => $a['tempsecret'] ) );
		$request->invoice->storeload();

		if ( false ) {
			return $a;
		}

		$stringarray = array();
		foreach ( $a as $name => $value ) {
			$stringarray[] = $name . '=' . urlencode( stripslashes( $value ) );
			//$string[$name] = stripslashes( $value );
		}

		$string = implode( '&', $stringarray );

		return $string;
	}

	function transmitRequestXML( $xml, $request )
	{
		$path = '/merchant/';
		if ( $this->settings['testmode'] || $this->settings['fake_account'] ) {
			if ( $this->settings['fake_account'] ) {
				$path .= "99999/example.php";
			} else {
				$path .= $this->settings['account_id'] . "/example.php";
			}
		} else {
			$path .= $this->settings['account_id'] . "/processor.php";
		}

		$url = "https://ipayment.de" . $path;
echo "<p><strong>&Uuml;bertragung - " . date('Y-m-d H:i:s') . " (Serverzeit)- " . date('Y-m-d H:i:s', time()+(60*60*6)) . " (tats&auml;chliche Zeit)</strong></p>";
echo "<h1>Senden der Daten:</h1>";
echo '<p>';
echo $xml;
echo '</p>';
echo '<p><strong>oder:</strong><br /><br />';
echo str_replace( '&', '<br />&', $xml );
echo '</p>';
echo '<h1>';
echo "an:";
echo '</h1>';
echo '<p>';
echo $url;
echo '</p>';
		$curl_calls[CURLOPT_HEADER]		= false;
		$curl_calls[CURLOPT_HTTPHEADER]	= '[[unset]]';

		// This will not turn up a response (why, that would be, like, logial and all)
		$response = $this->transmitRequest( $url, $path, $xml, 443, $curl_calls );
		$response2 = $this->transmitRequest( "https://allorca.com/components/com_acctexp/postback.php", $path, $xml, 443, $curl_calls );
echo '<h1>R&uuml;ckmeldung:</h1>';
echo '<div style="margin:12px;padding:24px;background-color:#bbb;color:#555;">';
echo '<p>';
echo $response;
echo '</p>';
echo '</div>';
echo '<h1>R&uuml;ckmeldung, Gegencheck:</h1>';
echo '<div style="margin:12px;padding:24px;background-color:#bbb;color:#555;">';
echo '<p>';
echo $response2;
echo '</p>';
echo '</div>';
		// Instead we wait a short moment
		//sleep( 10 );

		// And check whether we have been notified of a payment
		$return['valid'] = false;
		$return['raw'] = $response;

		// Reload Invoice
		$invoiceid = $request->invoice->id;
		$request->invoice->load( $invoiceid );

		if ( ( strcmp( $request->invoice->transaction_date, '0000-00-00 00:00:00' ) === 0 ) ) {
			// Ok, no transaction yet, tell the user to wait
			$return['pending']			= true;
			$return['pending_reason']	= 'waiting_response';
		} else {
			// Transaction finished
			$return['valid']			= 0;
			$return['duplicate']		= true;
		}

echo '<h1>Formular:</h1>';
echo '<form action="' . "https://ipayment.de" . $path . '" method="post" >Formular:</h1>';

$p = explode( '&', $xml );

foreach ( $p as $c ) {
	$cc = explode( '=', $c );
	echo '<input type="hidden" name="' . $cc[0] . '" value="' . $cc[1] . '" />';
}
echo '<input type="submit">';
echo '</form>';
exit;
		return $return;
	}

	function parseNotification( $post )
	{aecDebug( "ResponseFunction:parseNotification" . "\n" . "GET:".json_encode( $_GET ) . "\n" . "POST:".json_encode( $_POST ) );
		$allowed_ips= array( "212.227.34.218", 	"212.227.34.219", "212.227.34.220", "195.20.224.139" );
		if ( !in_array( $_SERVER["REMOTE_ADDR"], $allowed_ips ) ) {
			$response['error']		= true;
			$response['errormsg']	= 'Wrong calling IP - ' . $_SERVER["REMOTE_ADDR"] . ' - possible fraud attempt';

			return $response;
		}

		$response = array();
		$response['invoice']			= aecGetParam('invoice_text');
		$response['amount_paid']		= ( aecGetParam('trx_currency') / 100 );
		$response['amount_currency']	= aecGetParam('trx_currency');

		return $response;
	}

	function instantvalidateNotification( $response, $post, $invoice )
	{
		$response['valid'] = 0;
aecDebug( "ResponseFunction:instantvalidateNotification" . "\n" . "GET:".json_encode( $_GET ) . "\n" . "POST:".json_encode( $_POST ) . "\n" . "Response:".json_encode( $response ) . "\n" . "Invoice:".json_encode( $invoice ) );
		if ( aecGetParam('event') == 'error' ) {
			return $response;
		} elseif ( aecGetParam('event') == 'success' ) {
			$tempsecret = aecGetParam('tempsecret');

			if ( empty( $tempsecret ) ) {
				$response['error']		= true;
				$response['errormsg']	= 'No temp secret given';
			}

			$invoice->loadInvoiceNumber( $response['invoice'] );

			$invoiceparams = $invoice->getParams();

			if ( !isset( $invoiceparams['tempsecret'] ) ) {
				$response['error']		= true;
				$response['errormsg']	= 'No temp secret stored';
			}

			if ( $invoiceparams['tempsecret'] != $tempsecret ) {
				$response['error']		= true;
				$response['errormsg']	= 'Wrong temp secret given';
			} else {
				$response['valid'] = true;
			}
		}

		return $response;
	}

}
?>