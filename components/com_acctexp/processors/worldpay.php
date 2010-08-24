<?php
/**
 * @version $Id: worldpay.php
 * @package AEC - Account Control Expiration - Membership Manager
 * @subpackage Processors - Worldpay
 * @copyright 2007-2008 Copyright (C) David Deutsch
 * @author David Deutsch <skore@skore.de> & Team AEC - http://www.valanx.org
 * @license GNU/GPL v.2 http://www.gnu.org/licenses/old-licenses/gpl-2.0.html or, at your option, any later version
 */

// Dont allow direct linking
( defined('_JEXEC') || defined( '_VALID_MOS' ) ) or die( 'Direct Access to this location is not allowed.' );

class processor_worldpay extends POSTprocessor
{
	function info()
	{
		$info = array();
		$info['name']				= 'worldpay';
		$info['longname']			= _CFG_WORLDPAY_LONGNAME;
		$info['statement']			= _CFG_WORLDPAY_STATEMENT;
		$info['description']		= _CFG_WORLDPAY_DESCRIPTION;
		$info['currencies']			= AECToolbox::aecCurrencyField( true, true, true, true );
		$info['cc_list']			= 'visa,mastercard,discover,americanexpress,echeck,giropay';
		$info['recurring']			= 0;

		return $info;
	}

	function settings()
	{
		$settings = array();
		$settings['instId']			= 'instID';
		$settings['testmode'] 		= 0;
		$settings['currency'] 		= 'USD';
		$settings['item_name']		= sprintf( _CFG_PROCESSOR_ITEM_NAME_DEFAULT, '[[cms_live_site]]', '[[user_name]]', '[[user_username]]' );
		$settings['customparams']	= "";
		$settings['callbackPW'] 	= '';
		$settings['rewriteInfo']	= '';

		return $settings;
	}

	function backend_settings()
	{
		$settings = array();
		$settings['testmode']		= array( 'list_yesno');
		$settings['instId']			= array( 'inputC');
		$settings['currency']		= array( 'list_currency');
		$settings['info']			= array( 'fieldset' );
		$settings['item_name']		= array( 'inputE');
		$settings['customparams']	= array( 'inputD' );
 		$settings['callbackPW']		= array( 'inputC');
 		$rewriteswitches			= array( 'cms', 'user', 'expiration', 'subscription', 'plan');
		$settings = AECToolbox::rewriteEngineInfo( $rewriteswitches, $settings );

		return $settings;
	}

	function createGatewayLink( $request )
	{
		$var['post_url']	= 'https://select.worldpay.com/wcc/purchase';
		if ($this->settings->testmode) {
			$var['testMode'] = '100';
		}

		$var['instId']		= $this->settings['instId'];
		$var['currency']	= $this->settings['currency'];
		$var['cartId']		= $request->invoice->invoice_number;
		$var['amount']		= $request->int_var['amount'];

		$var['desc']	= AECToolbox::rewriteEngineRQ( $this->settings['item_name'], $request );

		return $var;
	}

/*
 * POSTBACK variables
 * instId=38290
 * email=tiq%40uk.worldpay.com
 * transTime=999178402000
 * country=GB
 * rawAuthCode=A
 * amount=14.99
 * installation=38290
 * tel=0123+456789012
 * address=
 * est+Road%0D%0ATest+Town%0D%0ATest+City
 * futurePayId=76486
 * MC_log=2379&
 * awAuthMessage=authorised+(testMode+always+Yes)
 * authAmount=23.11
 * amountString=%26%23163%3B14.99
 * cardType=Visa
 * AVS=0001
 * cost=14.99
 * currency=GBP
 * testMode=100
 * authAmountString=EUR23.11
 * fax=01234+5678901
 * lang=en
 * transStatus=Y
 * compName=Ian+Richardson
 * authCurrency=EUR
 * postcode=AB1+2CD
 * authCost=23.11
 * desc=Test+Item
 * countryMatch=S
 * cartId=Test+Item
 * transId=12227758
 * callbackPW=38290
 * M_var1=fred
 * authMode=E
 * countryString=United+Kingdom
 * name=WorldPay+Test
 */

	function parseNotification( $post )
	{
		$response = array();
		$response['invoice'] = $post['cartId'];
		$response['amount_paid'] = $post['authAmount'];
		$response['amount_currency'] = $post['authCurrency'];

		return $response;
	}

	function validateNotification( $response, $post, $invoice )
	{
		$response['valid'] = 0;
		$response['valid'] = ( strcmp( $post['transStatus'], 'Y') === 0 );

		if ( $response['valid'] ) {
			if ( !empty( $this->settings['callbackPW'] ) ) {
				if ( isset( $post['callbackPW'] ) ) {
					if ( $this->settings['callbackPW'] != $post['callbackPW'] ) {
						$response['valid'] = 0;
						$response['pending_reason'] = 'callback Password set wrong at either Worldpay or within the AEC';
					}
				} else {
					$response['valid'] = 0;
					$response['pending_reason'] = 'no callback Password set at Worldpay!!!';
				}
			}
		}

		return $response;
	}

}

?>
