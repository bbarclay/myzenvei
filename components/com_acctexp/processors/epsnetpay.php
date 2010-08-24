<?php
/**
 * @version $Id: epsnetpay.php
 * @package AEC - Account Control Expiration - Membership Manager
 * @subpackage Processors - EPS Netpay
 * @copyright 2006-2008 Copyright (C) David Deutsch
 * @author David Deutsch <skore@skore.de> & Team AEC - http://www.valanx.org
 * @license GNU/GPL v.2 http://www.gnu.org/licenses/old-licenses/gpl-2.0.html or, at your option, any later version
 */

// Dont allow direct linking
( defined('_JEXEC') || defined( '_VALID_MOS' ) ) or die( 'Direct Access to this location is not allowed.' );

class processor_epsnetpay extends POSTprocessor
{
	function info()
	{
		$info = array();
		$info['name'] = "epsnetpay";
		$info['longname'] = "epsNetpay";
		$info['statement'] = "Bezahlen sie mit epsNetpay!";
		$info['description'] = _DESCRIPTION_EPSNETPAY;
		$info['cc_list'] = "visa,mastercard,discover,americanexpress,echeck,giropay";
		$info['recurring'] = 0;
		$info['notify_trail_thanks'] = 1;

		return $info;
	}

	function settings()
	{
		$settings = array();

		$banks = array();
		$banks[] = "BANK AUSTRIA CREDITANSTALT";
		$banks[] = "BAWAG P.S.K. GRUPPE";
		$banks[] = "ERSTE BANK und SPARKASSEN";
		$banks[] = "RAIFFEISEN Bankengruppe";
		$banks[] = "Bankhaus Carl Sp&auml;ngler & Co. AG";
		$banks[] = "VOLKSBANKEN Gruppe";
		$banks[] = "HYPO Banken - Allgemeines Rechenzentrum";
		$banks[] = "HYPO Banken - Raiffeisen Rechenzentrum";
		$banks[] = "HYPO Banken - Tirol";
		$banks[] = "Nieder&ouml;sterreichische Landesbank";
		$banks[] = "Vorarlberger Landes- und Hypothekenbank";
		$banks[] = "Investkredit Bank";
		$banks[] = "Bank für &Auml;rzte und Freie Berufe";

		$n = 0;
		foreach ($banks as $bankname) {
			$settings['merchantname_' . $n] = $bankname;
			$settings['merchantactive_' . $n] = 0;
			$settings['merchantpin_' . $n] = "merchant pin";
			$settings['merchantid_' . $n] = "merchant id";
			$n++;
		}

		$settings['testmode']		= 0;
		$settings['acceptvok']		= 0;
		$settings['customparams']	= "";

		return $settings;
	}

	function backend_settings()
	{
		$settings = array();
		$settings['testmode']		= array("list_yesno");
		$settings['acceptvok']		= array("list_yesno");
		$settings['customparams']	= array( 'inputD' );

		$vars = $this->settings();
		foreach ( $vars as $name => $var ) {
			if ( strpos( $name, "id" ) ) {
				$id = str_replace("merchantid_", "", $name);

				$bankname = $vars["merchantname_" . $id];

				$settings["merchantactive_" . $id] = array("list_yesno", _CFG_EPSNETPAY_ACTIVATE_NAME, _CFG_EPSNETPAY_ACTIVATE_DESC);
				$settings["merchantname_" . $id] = array("inputC", "Name:", $bankname);

				$idfieldname = $bankname . ": " . _CFG_EPSNETPAY_MERCHANTID_NAME;
				$settings[$name] = array("inputC", $idfieldname, ($bankname . ": " . _CFG_EPSNETPAY_MERCHANTID_DESC));
				$pinfieldname = $bankname . ": " . _CFG_EPSNETPAY_MERCHANTPIN_NAME;
				$settings["merchantpin_" . $id] = array("inputC", $pinfieldname, ($bankname . ": " .  _CFG_EPSNETPAY_MERCHANTPIN_DESC));
			}
		}

		return $settings;
	}

	function createGatewayLink( $request )
	{
		$sapPopStsURL			= JURI::root() . "index.php";
		$var['sapInfoVersion']	= "3"; //Current Version
		$var['language']		= "DE"; // Must be german
		$var['sapPopRequestor']	= $this->settings['merchantid_' . $request->int_var['params']['bank_selection']]; // Marchant ID
		$var['sapPopServer']	= "yes"; // Server-to-Server notification
		$var['sapPopStsURL']	= $sapPopStsURL;

		$StsPar = array();
		$StsPar[] = array("option", "com_acctexp");
		$StsPar[] = array("task", "epsnetpaynotification");

		$var['sapPopStsParCnt']	= count($StsPar); // Number of custom values

		$epsparams = "";
		for ( $i=0, $j=1; $i < count($StsPar); $i++, $j++ ) {
			$var['sapPopStsParName' . $j] = $StsPar[$i][0];
			$var['sapPopStsParValue' . $j] = $StsPar[$i][1];
			$epsparams .= $StsPar[$i][0] . $StsPar[$i][1];
		}

		$var['sapPopOkUrl']		= AECToolbox::deadsureURL("index.php?option=com_acctexp&amp;task=thanks");
		$var['sapPopNokUrl']	= AECToolbox::deadsureURL("index.php?option=com_acctexp&amp;task=cancel");
		$sapUgawwhg				= "EUR"; // HAS TO BE EUR !!
		$var['sapUgawwhg']		= $sapUgawwhg;
		$sapUkddaten			= $request->metaUser->cmsUser->id;
		$var['sapUkddaten']		= $sapUkddaten;
		$sapUvwzweck			= $request->invoice->invoice_number;
		$var['sapUvwzweck']		= $sapUvwzweck;
		$sapUzusatz				= $request->invoice->invoice_number;
		$var['sapUzusatz']		= $sapUzusatz;
		$value					= preg_split("/[\.,]/", $request->int_var['amount']);

		$sapUgawVK = $value[0]; // (only the stuff before the comma)
		$sapUgawNK = $value[1]; // (only the stuff AFTER the comma)
		$var['sapUgawVK']	= $sapUgawVK;
		$var['sapUgawNK']	= $sapUgawNK;

		$fingerprint = $this->settings['merchantpin_' . $request->int_var['params']['bank_selection']].$this->settings['merchantid_' . $request->int_var['params']['bank_selection']].$sapUgawVK.$sapUgawNK.$sapUgawwhg.$sapUvwzweck.$sapUkddaten.$sapUzusatz.$sapPopStsURL.$epsparams;

		$var['sapPopFingerPrint'] = md5($fingerprint); // Fingerprint

		$bank = array();
		// BANK AUSTRIA CREDITANSTALT
		$bank[] = "https://pop.ba-ca.com/servlet/PopBACAEntry";
		// BAWAG P.S.K. GRUPPE
		$bank[] = "https://ebanking.bawag.com/InternetBanking/EPS?d=eps_vlogin";
		// ERSTE BANK und SPARKASSEN
		$bank[] = "https://vendor.netpay.at/webPay/vendorLogin";
		// RAIFFEISEN Bankengruppe
		$bank[] = "https://banking.raiffeisen.at/html/service?smi.lib=payment";
		// Bankhaus Carl Sp&auml;ngler & Co. AG
		$bank[] = "https://www.banking.co.at/appl/ebp/eps/transinit.html?resource=011";
		// VOLKSBANKEN Gruppe
		$bank[] = "https://www.banking.co.at/appl/ebp/eps/transinit.html?resource=101";
		// HYPO Banken - Allgemeines Rechenzentrum
		$bank[] = "https://www.banking.co.at/appl/ebp/eps/transinit.html?resource=015";
		// HYPO Banken - Raiffeisen Rechenzentrum
		$bank[] = "https://banking.hypo.at/html/service?smi.lib=payment";
		// HYPO Banken - Tirol
		$bank[] = "https://www.banking.co.at/appl/ebp/eps/transinit.html?resource=002";
		// Nieder&ouml;sterreichische Landesbank
		$bank[] = "https://www.banking.co.at/appl/ebp/eps/transinit.html?resource=029";
		// Vorarlberger Landes- und Hypothekenbank
		$bank[] = "https://www.banking.co.at/appl/ebp/eps/transinit.html?resource=019";
		// Investkredit Bank
		$bank[] = "https://www.banking.co.at/appl/ebp/eps/transinit.html?resource=109";
		// Bank für &Auml;rzte und Freie Berufe
		$bank[] = "https://www.banking.co.at/appl/ebp/eps/transinit.html?resource=093";

		if ($this->settings['testmode']) {
			$var['post_url']	= "https://qvendor.netpay.at/webPay/vendorLogin";
		} else {
			$var['post_url']	= $bank[$request->int_var['params']['bank_selection']];
		}

		return $var;
	}

	function Params( $params )
	{
		$merchantnumber = 0;
		$bank_selection = array();
		while ( isset( $this->settings['merchantactive_' . $merchantnumber] ) ) {
			if ($this->settings['merchantactive_' . $merchantnumber]) {
				$bank_selection[] = mosHTML::makeOption( $merchantnumber, $this->settings['merchantname_' . $merchantnumber] );
			}
			$merchantnumber++;
		}

		if ( empty( $params['bank_selection'] ) ) {
			$selected = 0;
		} else {
			$selected = $params['bank_selection'];
		}

		$var['params']['lists']['bank_selection']	= mosHTML::selectList( $bank_selection, 'bank_selection', 'size="5"', 'value', 'text', $selected );
		$var['params']['bank_selection']			= array( "list", "Bank Auswahl", "Bitte w&auml;hlen Sie die gew&uuml;nschte Bank aus." );

		return $var;
	}

	function parseNotification( $post )
	{
		$invoiceID				= $post['sapPopStsVwzweck'];
		$userid					= $post['sapPopStsRechnr'];

		$sapUgawVK				= $post['sapUgawVK']; // Amount. Value before the comma
		$sapUgawNK				= $post['sapUgawNK']; // Amount. Decimal places

		$response = array();
		$response['invoice'] = $post['sapPopStsVwzweck'];

		return $response;
	}

	function validateNotification( $response, $post, $invoice )
	{
		$merchantid = $this->settings['merchantid_' . $invoice->params['bank_selection']];
		$merchantpin = $this->settings['merchantpin_' . $invoice->params['bank_selection']];
		$sapPopStsReturnStatus	= $post['sapPopStsReturnStatus']; // Statuscode (OK/NOK/VOK)


		$StsPar = array();
		$StsPar[] = array("option", "com_acctexp");
		$StsPar[] = array("task", "epsnetpaynotification");

		$var['sapPopStsParCnt']	= count($StsPar); // Number of custom values

		$epsparams = "";
		for ( $i=0, $j=1; $i < count($StsPar); $i++, $j++ ) {
			$var['sapPopStsParName' . $j] = $StsPar[$i][0];
			$var['sapPopStsParValue' . $j] = $StsPar[$i][1];
			$epsparams .= $StsPar[$i][0] . $StsPar[$i][1];
		}

		$sapPopStsURL = JURI::root() . "index.php";

		$sapPopStsDurchfDatum = isset($post['sapPopStsDurchfDatum']) ? @$post['sapPopStsDurchfDatum'] : "";


		// Check Fingerprint
		if (($fingerprint = md5($post['sapPopStsReturnStatus'].$merchantpin.$merchantid.$post['sapPopStsEmpfname'].$post['sapPopStsEmpfnr'].$post['sapPopStsEmpfblz'].$post['sapPopStsGawVK'].$post['sapPopStsGawNK'].$post['sapPopStsGawWhg'].$post['sapPopStsVwzweck'].$post['sapPopStsRechnr'].$post['sapPopStsZusatz'].$sapPopStsDurchfDatum.$sapPopStsURL.$epsparams)) == $post['sapPopStsReturnFingerPrint']) {
			if ($this->settings['acceptvok']) {
				$response['valid'] = ( ($sapPopStsReturnStatus == 'OK') || ($sapPopStsReturnStatus == 'VOK'));
			} else {
	    		$response['valid'] = ($sapPopStsReturnStatus == 'OK');
			}
		} else {
			$response['valid'] = false;
			$response['pending_reason'] = "fingerprint mismatch";
		}


		return $response;
	}

}
?>