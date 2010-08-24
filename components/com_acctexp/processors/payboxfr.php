<?php
/**
 * @version $Id: payboxfr.php
 * @package AEC - Account Control Expiration - Membership Manager
 * @subpackage Processors - Paybox France
 * @author David Deutsch <skore@skore.de> & Team AEC - http://www.valanx.org
 * @copyright 2006-2008 Copyright (C) David Deutsch
 * @license GNU/GPL v.2 http://www.gnu.org/licenses/old-licenses/gpl-2.0.html or, at your option, any later version
 */

// Dont allow direct linking
( defined('_JEXEC') || defined( '_VALID_MOS' ) ) or die( 'Direct Access to this location is not allowed.' );

class processor_payboxfr extends POSTprocessor
{
	function info()
	{
		$info = array();
		$info['name']				= 'payboxfr';
		$info['longname']			= _CFG_PAYBOXFR_LONGNAME;
		$info['statement']			= _CFG_PAYBOXFR_STATEMENT;
		$info['description'] 		= _CFG_PAYBOXFR_DESCRIPTION;
		$info['currencies']			= 'EUR,USD,GBP,AUD,CAD,JPY,NZD';
		$info['languages']			= 'GB,DE,FR,IT,ES,SV,NL';
		$info['cc_list']			= 'visa,mastercard,discover,americanexpress,echeck,giropay';
		$info['recurring']			= 2;

		return $info;
	}

	function settings()
	{
		$settings = array();
		$settings['site']			= 'site';
		$settings['testmode']		= 1;
		$settings['rank']			= 'rank';
		$settings['identifiant']	= 'identifiant';
		$settings['publickey']		= 'publickey';
		$settings['path']			= '/cgi-bin/modulev2.cgi';
		$settings['currency']		= 'EUR';
		$settings['language']		= 'FR';
		$settings['customparams']	= "";

		return $settings;
	}

	function backend_settings()
	{
		$settings = array();
		$settings['site']			= array( 'inputC' );
		$settings['testmode']		= array( 'list_yesno' );
		$settings['rank']			= array( 'inputC' );
		$settings['identifiant']	= array( 'inputC' );
		$settings['publickey']		= array( 'inputD' );
		$settings['path']			= array( 'inputC' );
		$settings['info']			= array( 'fieldset' );
		$settings['currency']		= array( 'list_currency' );
		$settings['language']		= array( 'list_language' );
		$settings['customparams']	= array( 'inputD' );

		return $settings;
	}

	function createGatewayLink( $request )
	{
		$var['post_url']	= $this->settings['path'];

		if ( $this->settings['testmode'] ) {
			$var['PBX_AUTOSEULE'] = 'O';
		}

		$var['PBX_MODE']		= '1';
		$var['PBX_RUF1']		= 'POST';
		$var['PBX_SITE']		= $this->settings['site'];
		$var['PBX_RANG']		= $this->settings['rank'];
		$var['PBX_IDENTIFIANT']	= $this->settings['identifiant'];

		if ( is_array( $request->int_var['amount'] ) ) {
			switch ( $request->int_var['amount']['unit3'] ) {
				case 'D':
					$period = max( 1, ( (int) ( $request->int_var['amount']['period3'] / 30 ) ) );
					break;
				case 'W':
					$period = max( 1, ( (int) ( $request->int_var['amount']['period3'] / 4 ) ) );
					break;
				case 'M':
					$period = $request->int_var['amount']['period3'];
					break;
				case 'Y':
					$period = ( $request->int_var['amount']['period3'] * 12 );
					break;
			}

			$append = '';
			$svars = array();
			$svars['IBS_2MONT']		= '0000000000';
			$svars['IBS_NBPAIE']	= '00';
			$svars['IBS_FREQ']		= str_pad( $period, 2, '0', STR_PAD_LEFT );
			$svars['IBS_QUAND']		= '00';
			$svars['IBS_DELAIS']	= '000';

			foreach ( $svars as $svname => $svvar ) {
				$append .= $svname . $svvar;
			}

			$var['PBX_TOTAL']	= round( $request->int_var['amount']['amount3'] * 100 );

			$var['PBX_CMD']		= $request->invoice->invoice_number . $append;
		} else {
			$var['PBX_TOTAL']	= $request->int_var['amount'] * 100;
			$var['PBX_CMD']		= $request->invoice->invoice_number;
		}

		$iso4217num = array( 'EUR' => 978, 'USD' => 840, 'GBP' => 826, 'AUD' => 036, 'CAD' => 124, 'JPY' => 392, 'NZD' => 554 );

		if ( isset( $iso4217num[$this->settings['currency']] ) ) {
			$var['PBX_DEVISE']	= $iso4217num[$this->settings['currency']];
		} else {
			$var['PBX_DEVISE']	= '978';
		}

		$var['PBX_PORTEUR']		= $request->metaUser->cmsUser->email;

		$iso639_2to3 = array( 'GB' => 'GBR', 'DE' => 'DEU', 'FR' => 'FRA', 'IT' => 'ITA', 'ES' => 'ESP', 'SW' => 'SWE', 'NL' => 'NLD' );

		$var['PBX_LANGUE']		= $iso639_2to3[$this->settings['language']];

		$var['PBX_EFFECTUE']	= AECToolbox::deadsureURL( 'index.php?option=com_acctexp&amp;task=payboxfrnotification' );;
		$var['PBX_ANNULE']		= AECToolbox::deadsureURL( 'index.php?option=com_acctexp&amp;task=cancel' );

		$var['PBX_RETOUR']		= 'option:com_acctexp;task:payboxfrnotification;amount:M;invoice:R;authorization:A;transaction:T;subscriptionid:B;error:E;check:K';
//test
		if ( !empty( $this->settings['customparams'] ) ) {
			$custom = explode( "\n", $this->settings['customparams'] );

			foreach ( $custom as $c ) {
				$l = explode( '=', $c );

				if ( !empty( $l[0] ) && !empty( $l[1] ) ) {
					$var[trim($l[0])] = trim($l[1]);
				}
			}
		}

		return $var;
	}

	function parseNotification( $post )
	{
		$database = &JFactory::getDBO();

		$response = array();

		$returnstring = aecGetParam('invoice');
		$r = explode( 'IBS_', $returnstring );

		$checkpos = strpos( $returnstring, 'IBS_2MO' );

		$response['invoice'] = $r[0];

		$response['amount_paid'] = aecGetParam('amount') / 100;

		return $response;
	}
/**
 * "--cg7cDX\/3pgE"
 * "05bd460664f0a0c32e293f122dca527ad1d795f9"
 * "option=com_acctexp&task=payboxfrnotification&amount=590&invoice=IYWQ4YmE1YjIyZTAxIBS_2MONT0000000000IBS_NBPAIE00IBS_FREQ01IBS_QUAND00IBS_DELAIS000&authorization=XXXXXX&transaction=501610256&subscriptionid=501849829&error=00000"	"\u0017"	{"option":"com_acctexp","task":"payboxfrnotification","amount":"590","invoice":"IYWQ4YmE1YjIyZTAxIBS_2MONT0000000000IBS_NBPAIE00IBS_FREQ01IBS_QUAND00IBS_DELAIS000","authorization":"XXXXXX","transaction":"501610256","subscriptionid":"501849829","error":"00000","check":"F4TJf3P8ZncYGgXq6rFxIrf7nWtBMHHEP9N6jtIH\/0qkXpesy4FfAaTdfWzAN7u4XbXVXFB25Flfujlacz1OoxpTZg+O0TdtL637nz0J7ZzaIMQKgRvKAFuqLPXiTurTxsR6ZMghi2wM5IuPYYt3NIyyk5WfMSROUQ7DJoX3rDI="}
 */
	function validateNotification( $response, $post, $invoice )
	{
		$response['valid'] = 0;

		$gets = array( 'option', 'task', 'amount', 'invoice', 'authorization', 'transaction', 'subscriptionid', 'error', 'check' );

		$return = array();
		foreach ( $gets as $get ) {
			$return[$get] = aecGetParam($get);
		}
aecDebug($return);
		if ( !isset( $return['check'] ) ) {
			$response['pending_reason']			= 'error: No checking string provided';
			return $response;
		} elseif ( !isset( $this->settings['publickey'] ) ) {
			$response['pending_reason']			= 'error: No Public Key provided';
			return $response;
		}

		$check = base64_decode( urldecode( $return['check'] ) );

		unset( $return['check'] );

		$carr = array();
		foreach ( $return as $rname => $rvalue ) {
			$carr[] = $rname . '=' . $rvalue;
		}

		$cstring = implode( '&', $carr );

		if ( crypt( sha1( $cstring ), $this->settings['publickey'] ) == $check ) {
			$response['valid'] = 1;
		} else {
			$response['valid'] = 1;
			aecDebug($check);
			aecDebug($cstring);
			aecDebug( sha1( $cstring ) );
			aecDebug(crypt( sha1( $cstring ), $this->settings['publickey'] ));
		}

		return $response;
	}

}
?>
