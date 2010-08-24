<?php
/**
 * @version $Id: onebip.php
 * @package AEC - Account Control Expiration - Membership Manager
 * @subpackage Processors - OneBip Buy Now
 * @copyright 2007-2008 Copyright (C) David Deutsch
 * @author David Deutsch <skore@skore.de> & Team AEC - http://www.valanx.org
 * @license GNU/GPL v.2 http://www.gnu.org/licenses/old-licenses/gpl-2.0.html or, at your option, any later version
 */

// Dont allow direct linking
( defined('_JEXEC') || defined( '_VALID_MOS' ) ) or die( 'Direct Access to this location is not allowed.' );

class processor_onebip extends POSTprocessor
{
	function info()
	{
		$info = array();
		$info['name']					= 'onebip';
		$info['longname']				= _CFG_ONEBIP_LONGNAME;
		$info['statement']				= _CFG_ONEBIP_STATEMENT;
		$info['description'] 			= _CFG_ONEBIP_DESCRIPTION;
		$info['currencies']				= 'AUD,BAM,BGN,BRL,CAD,CHF,CNY,CZK,DKK,EEK,EUR,GBP,HKD,HRK,HUF,IDR'
											. 'INR,JPY,KRW,KZT,LTL,LVL,MXN,MYR,NOK,NZD,PHP,PLN,RON,RSD,RUB,SEK,SGD,THB,TRY,TWD,UAH,USD,ZAR';
		$info['languages']				= 'AU,AT,BE,BA,BG,CA,HR,CZ,DK,EE,FI,FR,DE,HU,ID,IE,IT,KZ,LV,LT,MY,NL,NO,PL,'
											. 'PT,RO,RU,RS,SG,ZA,ES,SE,CH,TW,TH,UA,UK,US';
		$info['recurring']				= 2;
		$info['notify_trail_thanks']	= 1;
		$info['recurring_buttons']		= 2;

		return $info;
	}

	function settings()
	{
		$settings = array();
		$settings['username']	= 'your@onebip.com';
		$settings['site_id']	= '0';
		$settings['currency']	= 'USD';
		$settings['country']	= 'US';
		$settings['secret']		= 'secret';
		$settings['item_name']	= '';

		return $settings;
	}

	function backend_settings()
	{
		$settings = array();

		$settings['username']	= array( 'inputC' );
		$settings['site_id']	= array( 'inputC' );
		$settings['currency']	= array( 'list_currency' );
		$settings['country']	= array( 'list_language' );
		$settings['secret']		= array( 'inputC' );
		$settings['item_name']	= array( 'inputE' );

		$settings = AECToolbox::rewriteEngineInfo( null, $settings );

		return $settings;
	}

	function createGatewayLink( $request )
	{
		global $mosConfig_live_site;

		$var['post_url']	= 'https://www.onebip.com/otms/';

		$var['username']	= $this->settings['username'];
		$var['site_id']		= $this->settings['site_id'];
		$var['item_name']	= AECToolbox::rewriteEngineRQ( $this->settings['item_name'], $request );

		if ( is_array( $request->int_var['amount'] ) ) {
			$var['price']		= $request->int_var['amount']['amount'] * 100;
			$var['frequency']	= $this->convertPeriodUnit( $request->int_var['amount']['unit3'], $request->int_var['amount']['period3'] );
		} else {
			$var['price']	= $request->int_var['amount'] * 100;
		}

		$var['currency']	= $this->settings['currency'];

		$var['command']		= 'standard_pay';

		$var['country']		= strtolower( $this->settings['country'] );

		$var['custom[invoice]']	= $request->invoice->invoice_number;
		$var['custom[option]']	= 'com_acctexp';
		$var['custom[task]']	= 'onebipnotification';

		$var['cancel_url']	= AECToolbox::deadsureURL( 'index.php?option=com_acctexp&amp;task=cancel' );
		$var['notify_url']	= JURI::root() . 'index.php';
		$var['return_url']	= $request->int_var['return_url'];

		return $var;
	}

	function convertPeriodUnit( $unit, $period )
	{
		switch ( $unit ) {
			default:
			case 'D':
				return $period;
				break;
			case 'W':
				return $period * 7;
				break;
			case 'M':
				return $period * 31;
				break;
			case 'Y':
				return $period * 356;
				break;
		}
	}

	function parseNotification( $post )
	{
		$response = array();

		$response['invoice']			= $post['invoice'];

		$response['amount_currency']	= $post['currency'];
		$response['amount_paid']		= $post['price'];

		return $response;
	}

	function validateNotification( $response, $post, $invoice )
	{
		$response['valid'] = 0;

		if ( !empty( $post['hash'] ) ) {
			if ( $post['hash'] != md5( $this->settings['secret'] . JURI::root() . 'index.php' ) ) {
				$response['error'] = "Security Hash Check Failed";
				return $response;
			}
		}

		if ( !$post['error'] && !empty( $response['amount_paid'] ) ) {
			$response['valid'] = 1;
		}

		return $response;
	}

}
?>
