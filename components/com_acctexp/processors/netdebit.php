<?php
/**
 * @version $Id: netdebit.php
 * @package AEC - Account Control Expiration - Membership Manager
 * @subpackage Processors - PayPal Buy Now
 * @copyright 2007-2008 Copyright (C) David Deutsch
 * @author David Deutsch <skore@skore.de> & Team AEC - http://www.valanx.org
 * @license GNU/GPL v.2 http://www.gnu.org/licenses/old-licenses/gpl-2.0.html or, at your option, any later version
 */

// Dont allow direct linking
( defined('_JEXEC') || defined( '_VALID_MOS' ) ) or die( 'Direct Access to this location is not allowed.' );

class processor_netdebit extends URLprocessor
{
	function info()
	{
		$info = array();
		$info['name']				= 'netdebit';
		$info['longname']			= _CFG_NETDEBIT_LONGNAME;
		$info['statement']			= _CFG_NETDEBIT_LONGNAME;
		$info['description'] 		= _CFG_NETDEBIT_DESCRIPTION;
		$info['currencies']			= 'EUR,USD,GBP,AUD,CAD,JPY,NZD,CHF,HKD,SGD,SEK,DKK,PLN,NOK,HUF,CZK,MXN,ILS';
		$info['languages']			= 'GB,DE,FR,IT,ES,US,NL';
		$info['cc_list']			= 'visa,mastercard,eurocard';
		$info['recurring']			= 2;
		$info['recurring_buttons']	= 2;

		return $info;
	}

	function settings()
	{
		$settings = array();
		$settings['testmode']		= 0;

		$settings['content_id']		= 'content_id';
		$settings['pid']			= 'pid';
		$settings['sid']			= 'sid';
		$settings['type']			= 1;

		$settings['secret']			= 'secret';

		$settings['javascript_checkout']	= 0;

		$settings['customparams']	= "";

		return $settings;
	}

	function backend_settings()
	{
		$settings = array();
		$settings['testmode']		= array( 'list_yesno' );

		$settings['content_id']		= array( 'inputC' );
		$settings['pid']			= array( 'inputC' );
		$settings['sid']			= array( 'inputC' );
		$settings['type']			= array( 'list' );

		$settings['secret']			= array( 'inputC' );

		$settings['javascript_checkout']	= array( 'list_yesno' );

		$settings['customparams']	= array( 'inputD' );

 		$typelist = array();
		$typelist[0] = mosHTML::makeOption ( 1, _CFG_NETDEBIT_TYPE_LISTITEM_ELV );
		$typelist[1] = mosHTML::makeOption ( 2, _CFG_NETDEBIT_TYPE_LISTITEM_CC );

		$settings['lists']['type']	= mosHTML::selectList( $typelist, 'netdebit_type', 'size="1"', 'value', 'text', $this->settings['type'] );

		$settings = AECToolbox::rewriteEngineInfo( null, $settings );

		return $settings;
	}

	function createGatewayLink( $request )
	{
		$ppParams = $request->metaUser->meta->getProcessorParams( $request->parent->id );

		//$var['item_number']		= $request->metaUser->cmsUser->id;

		if ( !empty( $ppParams->customerid ) ) {
			$cust = $ppParams->customerid;
			$iscust	= 1;
		} else {
			$cust = '';
			$iscust	= 0;
		}

		if ( $this->settings['testmode'] ) {
			$this->settings['webmaster_id'] = 9090;
		} else {
			$this->settings['webmaster_id'] = 1000;
		}

		$var['F']		= $this->settings['webmaster_id'];
		$var['PID']		= $this->settings['pid'];
		$var['CON']		= $this->settings['content_id'];
		$var['SID']		= $this->settings['sid'];

		$var['VAR1']	= $request->invoice->invoice_number;
		$var['VAR2']	= "";//implode( "|", array() );
		$var['ZAH']		= $this->settings['type']; //1 = Lastschrift, 2 = Kreditkarte

		$var['POS'] = '';

		$var['KUN']		= $iscust;
		$var['KNR']		= $cust;

		if ( is_array( $request->int_var['amount'] ) ) {
			$var['TIM']	= 1;

			switch ( $request->int_var['amount']['unit3'] ) {
				case 'D': $unit = 3; break;
				case 'W': $unit = 4; break;
				case 'M': $unit = 5; break;
				case 'Y': $unit = 6; break;
				default: $unit = 3; break;
			}

			if ( $this->settings['testmode'] ) {
				$unit += 10;
			}

			$var['LZS'] = $unit;
			$var['LZW'] = $request->int_var['amount']['period3'];

			$var['BET'] = $request->int_var['amount']['amount3'];

			$var['VAL'] = md5( $request->int_var['amount']['amount3'] . $this->settings['secret'] );
		} else {
			$var['TIM'] = 0;

			$var['LZS'] = 9;
			$var['LZW'] = 1;

			$var['BET'] = $request->int_var['amount'];

			$var['VAL'] = md5( $request->int_var['amount'] . $this->settings['secret'] );
		}

		if ( $this->settings['javascript_checkout'] ) {
			// Link to NetDebit Javascript from Checkout link
			$var['_aec_checkout_onclick'] = 'GATE_NDV2_AMOUNT(\'' . $var['VAR1'] . '\',\'' . $var['VAR2'] . '\',\'' . $var['ZAH'] . '\',\'' . $var['POS'] . '\',\'' . $var['KUN'] . '\',\'' . $var['KNR'] . '\',\'' . $var['TIM'] . '\',\'' . $var['BET'] . '\',\'' . $var['LZS'] . '\',\'' . $var['LZW'] . '\',\'' . $var['VAL'] . '\');return false;';

			foreach ( $var as $name => $val ) {
				if ( $name != '_aec_checkout_onclick' ) {
					unset( $var[$name] );
				}
			}

			$var['post_url'] = "http://www.netdebit.de/central/public/javascript_disabled";

			// Attach NetDebit Javascript
			$var['_aec_html_head'] = '<!-- Beginn NetDebit - Payment V3.0 -->'
										. '<script '
										. 'src="http://www.fixport.de/secuSYS/FUNK.php?F=' . $this->settings['webmaster_id'] . '&PID=' . $this->settings['pid'] . '&CON=' . $this->settings['content_id'] . '&SID=' . $this->settings['sid'] . '" type="text/javascript"></script> '
										. '<!-- Ende   NetDebit - Payment V3.0 -->';
		} else {
			if ( $this->settings['testmode'] ) {
				$var['post_url'] = "https://web.netdebit-test.de/pay/?";
			} else {
				$var['post_url'] = "https://www.netdebit-payment.de/pay/index.php?";
			}
		}

		return $var;
	}

	function parseNotification( $post )
	{
		$database = &JFactory::getDBO();

		$response = array();
		$response['invoice']		= $post['VAR1'];
		$response['amount_paid']	= str_replace( ",", ".", $post['pay_amount'] );

		return $response;
	}

	function validateNotification( $response, $post, $invoice )
	{
		$response['valid'] = 0;

		$allowedips = array( "213.69.111.70", "213.69.111.71", "213.69.234.76", "213.69.234.74", "195.126.100.14", "213.69.111.78" );

		if ( !in_array( $_SERVER["REMOTE_ADDR"], $allowedips ) ) {
			$response['pending_reason'] = "Wrong IP tried to send notification: " . $_SERVER["REMOTE_ADDR"];
			return $response;
		}

		$metaUser = new metaUser( $response['userid'] );

		$ppParams = $metaUser->meta->getProcessorParams( $this->id );

		// Check whether we have already recorded a profile
		if ( empty( $ppParams->customerid ) ) {
			// None found - create it
			$ppParams = new stdClass();
			$ppParams->customerid = $post['customer_id'];

			$metaUser->meta->setProcessorParams( $this->id, $ppParams );
		} elseif ( $ppParams->customerid != $post['customer_id'] ) {
			// Profile found, but does not match, create new relation
			$ppParams->customerid = $post['customer_id'];

			$metaUser->meta->setProcessorParams( $this->id, $ppParams );
		}

		if ( $this->settings['secret'] == $post['password'] ) {
			switch ( $post['method'] ) {
				case 0:
					$response['valid'] = 1;
					break;
				case 1:
					$response['chargeback_settle'] = 1;
					break;
				case 7:
					$response['eot'] = 1;
					break;
				case 9:
					$response['chargeback'] = 1;
					break;
			}
		} else {
			$response['error'] = 1;
			$response['errormsg'] = 'Password mismatch';
		}

		return $response;
	}

	function notificationError( $response, $error )
	{
		echo 'OK=0 ERROR: ' . $error;
	}

	function notificationSuccess( $response )
	{
		echo 'OK=100';
	}

}
?>
