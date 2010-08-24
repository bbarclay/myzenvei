<?php
/**
 * @version $Id: mi_shareasale.php
 * @package AEC - Account Control Expiration - Membership Manager
 * @subpackage Micro Integrations - Share a Sale
 * @copyright 2006-2009 Copyright (C) David Deutsch
 * @author David Deutsch <skore@skore.de> & Team AEC - http://www.valanx.org
 * @license GNU/GPL v.2 http://www.gnu.org/licenses/old-licenses/gpl-2.0.html or, at your option, any later version
 */

// Dont allow direct linking
( defined('_JEXEC') || defined( '_VALID_MOS' ) ) or die( 'Direct Access to this location is not allowed.' );

class mi_shareasale
{
	function Info()
	{
		$info = array();
		$info['name'] = _AEC_MI_NAME_SHAREASALE;
		$info['desc'] = _AEC_MI_DESC_SHAREASALE;

		return $info;
	}

	function Settings()
	{
		$settings = array();
		$settings['merchantID']			= array( 'inputC' );
		$settings['onlycustomparams']	= array( 'list_yesno' );
		$settings['customparams']		= array( 'inputD' );
		$rewriteswitches				= array( 'cms', 'user', 'expiration', 'subscription', 'plan', 'invoice' );
		$settings['rewriteInfo']		= array( 'fieldset', _AEC_MI_SET11_EMAIL, AECToolbox::rewriteEngineInfo( $rewriteswitches ) );

		return $settings;
	}

	function action( $request )
	{
		$database = &JFactory::getDBO();

		$rooturl = "https://shareasale.com/q.cfm";

		$getparams = array();

        $user		= JFactory::getUser($invoice->userid);
        $SSAID		= $user->getParam('SSAID');
        $SSAIDDATA	= $user->getParam('SSAIDDATA');

		$getparams[] = 'amount='		. $request->invoice->amount;
		$getparams[] = 'tracking='		. $request->invoice->invoice_number;
		$getparams[] = 'transtype='		. 'sale';
		$getparams[] = 'merchantID='	. $this->settings['merchantID'];
		$getparams[] = 'userID='		. $user->getParam('SSAID');
		$getparams[] = 'SSAIDDATA='		. $user->getParam('SSAIDDATA');

		if ( !empty( $this->settings['onlycustomparams'] ) && !empty( $this->settings['customparams'] ) ) {
			$getparams = array();
		}

		if ( !empty( $this->settings['customparams'] ) ) {
			$rw_params = AECToolbox::rewriteEngineRQ( $this->settings['customparams'], $request );

			if ( strpos( $rw_params, "\r\n" ) !== false ) {
				$cps = explode( "\r\n", $rw_params );
			} else {
				$cps = explode( "\n", $rw_params );
			}

			foreach ( $cps as $cp ) {
				$getparams[] = $cp;
			}
		}

		$newget = array();
		foreach ( $getparams as $v ) {
			$va = explode( '=', $v, 2 );

			$newget[] = urlencode($va[0]) . '=' . urlencode($va[1]);
		}

		$ch = curl_init();
		$curl_url = $rooturl . "?" . implode( '&', $newget );
		curl_setopt($ch, CURLOPT_URL, $curl_url );
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$resp = curl_exec($ch);

		curl_close($ch);
		if ( $resp == false ) {
			aecDebug( 'Trying to establish failed with Error #' . curl_errno( $ch ) . ' ( "' . curl_error( $ch ) . '" )' );
		}

		return true;
	}

}
?>
