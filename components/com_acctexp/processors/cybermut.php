<?php
/**
 * @version $Id: cybermut.php
 * @package AEC - Account Control Expiration - Membership Manager
 * @subpackage Payment Processors
 * @author David Deutsch <skore@skore.de> & Team AEC - http://www.valanx.org
 * @copyright 2006-2008 Copyright (C) David Deutsch
 * @license GNU/GPL v.2 http://www.gnu.org/licenses/old-licenses/gpl-2.0.html or, at your option, any later version
 */

// Dont allow direct linking
( defined('_JEXEC') || defined( '_VALID_MOS' ) ) or die( 'Direct Access to this location is not allowed.' );

class processor_cybermut extends POSTprocessor
{
	function info()
	{
		$info = array();
		$info['name'] = 'cybermut';
		$info['longname'] = _CFG_CYBERMUT_LONGNAME;
		$info['statement'] = _CFG_CYBERMUT_STATEMENT;
		$info['description'] = _CFG_CYBERMUT_DESCRIPTION;
		$info['currencies'] = "EUR,USD,GBP,CHF";
		$info['languages'] = "FR,EN,DE,IT,ES,NL";
		$info['cc_list'] = "visa,mastercard,discover,americanexpress,echeck,giropay";
		$info['recurring']				= 0;

		return $info;
	}

	function settings()
	{
		$settings = array();
		$settings['testmode']		= 0;
		$settings['tpe']			= '7654321';
		$settings['ver']			= '1.2open';
		$settings['soc']			= 'societe';
		$settings['pass']			= 'passphrase';
		$settings['key']			= '000102030405060708090A0B0C0D0E0F10111213';
		$settings['currency']		= 'EUR';
		$settings['language']		= 'FR';
		$settings['server']			= 0;
		$settings['item_name']		= sprintf( _CFG_PROCESSOR_ITEM_NAME_DEFAULT, '[[cms_live_site]]', '[[user_name]]', '[[user_username]]' );
		$settings['customparams']	= "";

		$settings = AECToolbox::rewriteEngineInfo( null, $settings );

		return $settings;
	}


	function backend_settings()
	{
		$settings = array();
		$settings['testmode']		= array( 'list_yesno' );
		$settings['tpe']			= array( 'inputC' );
		$settings['ver']			= array( 'inputC' );
		$settings['soc']			= array( 'inputC' );
		$settings['pass']			= array( 'inputC' );
		$settings['key']			= array( 'inputC' );
		$settings['currency']		= array( 'list_currency' );
		$settings['server']			= array( 'list' );
		$settings['language']		= array( 'list_language' );
		$settings['item_name']		= array( 'inputE' );
		$settings['customparams']	= array( 'inputD' );

		$servers = array( 'paiement.creditmutuel.fr', 'ssl.paiement.cic-banques.fr', 'ssl.paiement.banque-obc.fr', 'paiement.caixanet.fr', 'creditmutuel.fr/telepaiement' );

		$server_selection = array();
		foreach ( $servers as $i => $server ) {
			$server_selection[] = mosHTML::makeOption( $i, $server );
		}

		$settings['lists']['cybermut_server'] = mosHTML::selectList( $server_selection, 'cybermut_server', 'size="5"', 'value', 'text', $this->settings['server'] );

		return $settings;
	}

	function createGatewayLink( $request )
	{
		$servers = array( 'paiement.creditmutuel.fr', 'ssl.paiement.cic-banques.fr', 'ssl.paiement.banque-obc.fr', 'paiement.caixanet.fr', 'creditmutuel.fr/telepaiement' );

		if ( $this->settings['testmode'] ) {
			$var['post_url'] = "https://" . $servers[$this->settings['server']] . "/test/paiement.cgi";
		} else {
			$var['post_url'] = "https://" . $servers[$this->settings['server']] . "/paiement.cgi";
		}

		$var['version']			= $this->settings['ver'];
		$var['TPE']				= $this->settings['tpe'];
		$var['date']			= date( "d/m/Y:H:i:s" );
		$var['montant']			= $request->int_var['amount'] . $this->settings['currency'];
		$var['reference']		= $request->metaUser->userid;
		$var['texte-libre']		= $request->invoice->invoice_number;
		$var['lgue']			= $this->settings['language'];
		$var['societe']			= $this->settings['soc'];
//print_r($var);print_r($request->int_var);exit();
		$HMAC = $var['TPE']."*".$var['date']."*".$var['montant']."*".$var['reference']."*".$var['texte-libre']."*".$var['version']."*".$var['lgue']."*".$var['societe']."*";

		//$var['MAC']				= "V1.03.sha1.php4--CtlHmac-" . $this->settings['ver'] . "-[" . $this->settings['tpe'] . "]-" . $this->CMCIC_hmac( $this->settings, $HMAC );
		$var['MAC']				= $this->CMCIC_hmac( $this->settings, $HMAC );

		/*$var['retourPLUS']		= $request->int_var['return_url'];
		$var['societe']			= $this->settings['key'];*/

		$var['url_retour']		= JURI::root() . 'index.php';
		$var['url_retour_ok']	= JURI::root() . 'index.php?option=com_acctexp&task=thanks';
		$var['url_retour_err']	= JURI::root() . 'index.php?option=com_acctexp&task=cancel';

		foreach ( $var as $k => $v ) {
			$var[$k] = $this->HtmlEncode( $v );
		}

		return $var;
	}

	function parseNotification( $post )
	{
		$response = array();
		$response['invoice'] = $post['texte-libre'];

		return $response;
	}

	function validateNotification( $response, $post, $invoice )
	{
		switch( $post['retour'] ) {
			case 'payetest':
				$response['valid']	= $this->settings['testmode'] ? true : false;
				break;
			case 'paiement':
				$response['valid']	= true;
				break;
			case 'annulation':
				$response['valid']	= false;
				$response['cancel']	= 1;
				break;
		}

		$HMAC = $post['retourPLUS']."+".$this->settings['tpe']."+".$post['date']."+".$post['montant']."+".$post['reference']."+".$post['texte-libre']."+".$this->settings['version']."+".$post['retour']."+";

		if ( $post['MAC'] !== $this->CMIC_hmac( $this->settings, $HMAC ) ) {
			$response['pending_reason'] = 'invalid HMAC';
			$response['valid'] = false;
		}

		$response['amount_paid'] = substr( $response['montant'], -3 );
		$response['amount_currency'] = str_replace( $response['amount_paid'], '', $response['montant'] );

		return $response;
	}

	function HtmlEncode( $data )
	{
		$SAFE_OUT_CHARS = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890._-";
		$encoded_data = "";
		$result = "";
		for ($i=0; $i<strlen($data); $i++) {
			if (strchr($SAFE_OUT_CHARS, $data{$i})) {
				$result .= $data{$i};
			} else if (($var = bin2hex(substr($data,$i,1))) <= "7F") {
				$result .= "&#x" . $var . ";";
			} else {
				$result .= $data{$i};
			}
		}
		return $result;
	}

	function CMCIC_hmac( $data="")
	{
		$k1 = pack( "H*", sha1( $this->settings['pass'] ) );
		$l1 = strlen( $k1 );
		$k2 = pack( "H*", $this->settings['key'] );
		$l2 = strlen( $k2 );

		if ( $l1 > $l2 ) {
			//$k2 = str_pad( $k2, $l1, chr(0x00) );
		} elseif ( $l2 > $l1 ) {
			$k1 = str_pad( $k1, $l2, chr(0x00) );
		}

		if ( $data == "" ) {
			$d = "CtlHmac" . $this->settings['ver'] . $this->settings['tpe'];
		} else {
			$d = $data;
		}

		return strtolower( $this->hmac( $k2, $d ) );
		// return strtolower( $this->hmac( $k1 ^ $k2, $d ) );
	}

	function hmac( $key, $data )
	{
	   // RFC 2104 HMAC implementation for php.
	   // Creates an md5 HMAC.
	   // Eliminates the need to install mhash to compute a HMAC
	   // Hacked by Lance Rushing

	   $b = 64; // byte length for md5

	   if ( strlen( $key ) > $b ) {
	       $key = pack( "H*", md5( $key ) );
	   }
	   $key  = str_pad( $key, $b, chr(0x00) );
	   $ipad = str_pad( '', $b, chr(0x36) );
	   $opad = str_pad( '', $b, chr(0x5c) );
	   $k_ipad = $key ^ $ipad;
	   $k_opad = $key ^ $opad;

	   return md5( $k_opad  . pack( "H*", md5( $k_ipad . $data ) ) );
	}

}

?>
