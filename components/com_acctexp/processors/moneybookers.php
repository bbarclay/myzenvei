<?php
/**
 * @version $Id: moneybookers.php
 * @package AEC - Account Control Expiration - Membership Manager
 * @subpackage Processors - Moneybookers
 * @copyright 2006-2008 Copyright (C) David Deutsch
 * @author David Deutsch <skore@skore.de> & Team AEC - http://www.valanx.org
 * @license GNU/GPL v.2 http://www.gnu.org/licenses/old-licenses/gpl-2.0.html or, at your option, any later version
 */

// Dont allow direct linking
( defined('_JEXEC') || defined( '_VALID_MOS' ) ) or die( 'Direct Access to this location is not allowed.' );

class processor_moneybookers extends POSTprocessor
{
	function info()
	{
		$info = array();
		$info['name']				= 'moneybookers';
		$info['longname']			= _CFG_MONEYBOOKERS_LONGNAME;
		$info['statement']			= _CFG_MONEYBOOKERS_STATEMENT;
		$info['description']		= _CFG_MONEYBOOKERS_DESCRIPTION;
		$info['currencies']			= 'EUR,USD,GBP,AUD,CAD,JPY,NZD,CHF,HKD,SGD,SEK,DKK,PLN,NOK,HUF,CZK';
		$info['languages']			= 'EN,DE,ES,FR,IT,PL,GR,RO,RU,TR,CN,CZ,NL.';
		$info['cc_list']			= 'visa,mastercard';
		$info['recurring']			= 0;

		return $info;
	}

	function settings()
	{
		global $mainframe;

		$settings = array();

		$settings['pay_to_email']			= '';
		$settings['secret_word']			= '';
		$settings['recipient_description']	= $mainframe->getCfg( 'sitename' );
		$settings['logo_url'] 				= AECToolbox::deadsureURL( 'images/logo.png' );
		$settings['language'] 				= 'EN';
		$settings['hide_login'] 			= 1;
		$settings['currency'] 				= 'USD';
		$settings['confirmation_note']		= "Thank you for subscribing on " . $mainframe->getCfg( 'sitename' ) . "!";
		$settings['item_name']				= sprintf( _CFG_PROCESSOR_ITEM_NAME_DEFAULT, '[[cms_live_site]]', '[[user_name]]', '[[user_username]]' );
		$settings['customparams']			= "";

		return $settings;
	}

	function backend_settings()
	{
		$settings = array();

		$settings['pay_to_email']			= array( 'inputC');
		$settings['secret_word']			= array( 'inputC');
		$settings['recipient_description']	= array( 'inputE');
		$settings['logo_url']				= array( 'inputE');
		$settings['language'] 				= array( 'list_language' );
		$settings['hide_login']				= array( 'list_yesno');
		$settings['currency'] 				= array( 'list_currency' );
		$settings['confirmation_note']		= array( 'inputE');
		$settings['item_name']				= array( 'inputE');
		$settings['customparams']			= array( 'inputD' );

		$settings = AECToolbox::rewriteEngineInfo( null, $settings );

		return $settings;
	}

	function createGatewayLink( $request )
	{
		$var['post_url']				= 'https://www.moneybookers.com/app/payment.pl';
		$var['pay_to_email']			= $this->settings['pay_to_email'];
		$var['recipient_description']	= $this->settings['recipient_description'];
		$var['logo_url']				= $this->settings['logo_url'];
		$var['transaction_id']			= $request->invoice->invoice_number;

		$var['return_url']				= $request->int_var['return_url'];
		$var['cancel_url']				= AECToolbox::deadsureURL( 'index.php?option=com_acctexp&amp;task=cancel' );
		$var['status_url']				= AECToolbox::deadsureURL( 'index.php?option=com_acctexp&amp;task=moneybookersnotification' );

		$var['language']				= $this->settings['language'];
		$var['hide_login']				= $this->settings['hide_login'];
		$var['pay_from_email']			= $request->metaUser->cmsUser->email;
		$var['amount']					= $request->int_var['amount'];

		$var['detail1_description']		= AECToolbox::rewriteEngineRQ( $this->settings['item_name'], $request );
		$var['detail1_text']			= $request->metaUser->cmsUser->id;
		$var['currency']				= $this->settings['currency'];
		$var['confirmation_note']		= $this->settings['confirmation_note'];

		return $var;
	}

	function parseNotification( $post )
	{
		$response = array();
		$response['invoice']			= $post['transaction_id'];
		$response['amount_paid']		= $post['mb_amount'];
		$response['amount_currency']	= $post['mb_currency'];

		return $response;
	}

	function validateNotification( $response, $post, $invoice )
	{
		$response['valid'] = false;

		$md5sig = md5( $post['merchant_id'] . $post['transaction_id'] . $this->settings['secret_word'] . $post['mb_amount'] . $post['mb_currency'] . $post['status'] );

		if ( ( $post['status'] == '2' ) && ( $md5sig == $post['md5sig'] ) ) {
			$response['valid'] = true;
		}

		return $response;
	}

}

?>
