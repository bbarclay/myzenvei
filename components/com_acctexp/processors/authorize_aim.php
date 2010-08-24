<?php
/**
 * @version $Id: authorize_aim.php
 * @package AEC - Account Control Expiration - Membership Manager
 * @subpackage Processors - Authorize AIM
 * @copyright 2007-2008 Copyright (C) David Deutsch
 * @author David Deutsch <skore@skore.de> & Team AEC - http://www.valanx.org
 * @license GNU/GPL v.2 http://www.gnu.org/licenses/old-licenses/gpl-2.0.html or, at your option, any later version
 */

// Dont allow direct linking
( defined('_JEXEC') || defined( '_VALID_MOS' ) ) or die( 'Direct Access to this location is not allowed.' );

class processor_authorize_aim extends XMLprocessor
{
	function info()
	{
		$info = array();
		$info['name'] = 'authorize_aim';
		$info['longname'] = _CFG_AUTHORIZE_AIM_LONGNAME;
		$info['statement'] = _CFG_AUTHORIZE_AIM_STATEMENT;
		$info['description'] = _CFG_AUTHORIZE_AIM_DESCRIPTION;
		$info['currencies'] = AECToolbox::aecCurrencyField( true, true, true, true );
		$info['cc_list'] = "visa,mastercard,discover,americanexpress,echeck,jcb,dinersclub";
		$info['recurring'] = 0;
		$info['actions'] = array( 'cancel' => array( 'confirm' ) );
		$info['secure'] = 1;

		return $info;
	}

	function getActions( $invoice, $subscription )
	{
		$actions = parent::getActions( $invoice, $subscription );

		if ( ( $subscription->status == 'Cancelled' ) || ( $invoice->transaction_date == '0000-00-00 00:00:00' ) ) {
			if ( isset( $actions['cancel'] ) ) {
				unset( $actions['cancel'] );
			}
		}

		return $actions;
	}

	function settings()
	{
		$settings = array();
		$settings['login']				= "login";
		$settings['transaction_key']	= "transaction_key";
		$settings['testmode']			= 0;
		$settings['dumpmode']			= 0;
		$settings['currency']			= "USD";
		$settings['promptAddress']		= 0;
		$settings['promptZipOnly']		= 0;
		$settings['item_name']			= sprintf( _CFG_PROCESSOR_ITEM_NAME_DEFAULT, '[[cms_live_site]]', '[[user_name]]', '[[user_username]]' );
		$settings['customparams']		= '';

		return $settings;
	}

	function backend_settings()
	{
		$settings = array();
		$settings['testmode']			= array( "list_yesno" );
		$settings['dumpmode']			= array( "list_yesno" );
		$settings['login'] 				= array( "inputC" );
		$settings['transaction_key']	= array( "inputC" );
		$settings['currency']			= array( "list_currency" );
		$settings['promptAddress']		= array( "list_yesno" );
		$settings['promptZipOnly']		= array( "list_yesno" );
		$settings['item_name']			= array( "inputE" );
		$settings['customparams']		= array( 'inputD' );

		$settings = AECToolbox::rewriteEngineInfo( null, $settings );

		return $settings;
	}

	function checkoutform( $request )
	{
		$var = $this->getCCform( array(), array( 'card_number', 'card_exp_month', 'card_exp_year', 'card_cvv2' ) );

		// Explode Name
		$namearray		= explode( " ", $request->metaUser->cmsUser->name );
		$firstfirstname	= $namearray[0];
		$maxname		= count($namearray) - 1;
		$lastname		= $namearray[$maxname];

		$var['params']['billFirstName'] = array( 'inputC', _AEC_AUTHORIZE_AIM_PARAMS_BILLFIRSTNAME_NAME, _AEC_AUTHORIZE_AIM_PARAMS_BILLFIRSTNAME_NAME, $firstfirstname );
		$var['params']['billLastName'] = array( 'inputC', _AEC_AUTHORIZE_AIM_PARAMS_BILLLASTNAME_NAME, _AEC_AUTHORIZE_AIM_PARAMS_BILLLASTNAME_NAME, $lastname );

		if ( !empty( $this->settings['promptAddress'] ) || !empty( $this->settings['promptZipOnly'] ) ) {
			if ( empty( $this->settings['promptZipOnly'] ) ) {
				$var['params']['billAddress'] = array( 'inputC', _AEC_AUTHORIZE_AIM_PARAMS_BILLADDRESS_NAME );
				$var['params']['billCity'] = array( 'inputC', _AEC_AUTHORIZE_AIM_PARAMS_BILLCITY_NAME );
				$var['params']['billState'] = array( 'inputC', _AEC_AUTHORIZE_AIM_PARAMS_BILLSTATE_NAME );
			}

			$var['params']['billZip'] = array( 'inputC', _AEC_AUTHORIZE_AIM_PARAMS_BILLZIP_NAME );

			if ( empty( $this->settings['promptZipOnly'] ) ) {
				$var['params']['billCountry'] = array( 'inputC', _AEC_AUTHORIZE_AIM_PARAMS_BILLCOUNTRY_NAME );
			}
		}

		return $var;
	}

	function createRequestXML( $request )
	{
		$a = array();

		$a['x_login']			= trim( substr( $this->settings['login'], 0, 25 ) );
		$a['x_version']			= "3.1";
		$a['x_delim_char']		= "|";
		$a['x_delim_data']		= "TRUE";
		$a['x_url']				= "FALSE";
		$a['x_type']			= "AUTH_CAPTURE";
		$a['x_method']			= "CC";
		$a['x_tran_key']		= $this->settings['transaction_key'];
		$a['x_currency_code']	= $this->settings['currency'];
		$a['x_relay_response']	= "FALSE";
		$a['x_card_num']		= trim( $request->int_var['params']['cardNumber'] );
		$a['x_exp_date']		= str_pad( $request->int_var['params']['expirationMonth'], 2, '0', STR_PAD_LEFT ) . $request->int_var['params']['expirationYear'];
		$a['x_card_code']		= trim( $request->int_var['params']['cardVV2'] );

		if ( !empty( $request->cart ) ) {
			$sid = 0;
			foreach ( $request->cart as $ciid => $ci ) {
				if ( !empty( $ci['is_total'] ) ) {
					continue;
				}

				$lineitems = array();

				// Item ID<|>
				$lineitems[] = 'item'.substr( $sid, 0, 31 );
				// <|>item name<|>
				$lineitems[] = substr( $ci['name'], 0, 31 );
				// <|>item description<|>
				$lineitems[] = empty($ci['desc']) ? substr( $ci['name'], 0, 31 ) : substr( $ci['desc'], 0, 255);
				// <|>itemX quantity<|>
				$lineitems[] = $ci['quantity'];
				// <|>item price (unit cost)<|>
				$lineitems[] = $ci['cost'];
				// <|>itemX taxable<|>
				$lineitems[] = 0;

				$sid++;

				// TODO: trailing colon required? . '|'
				$a['x_line_item'][] = implode( '<|>', $lineitems );
			}
		}

		$a['x_description']		= trim( substr( AECToolbox::rewriteEngineRQ( $this->settings['item_name'], $request ), 0, 20 ) );
		$a['x_invoice_num']		= $request->invoice->invoice_number;

		if ( is_array( $request->int_var['amount'] ) ) {
			$a['x_amount']			= $request->int_var['amount']['amount'];
		} else {
			$a['x_amount']			= $request->int_var['amount'];
		}

		$a['x_first_name']		= trim( $request->int_var['params']['billFirstName'] );
		$a['x_last_name']		= trim( $request->int_var['params']['billLastName'] );

		if ( isset( $request->int_var['params']['billZip'] ) ) {
			if ( isset( $request->int_var['params']['billAddress'] ) ) {
				$a['x_address']		= trim( $request->int_var['params']['billAddress'] );
				$a['x_city']		= trim( $request->int_var['params']['billCity'] );
				$a['x_state']		= trim( $request->int_var['params']['billState'] );
			}

			$a['x_zip']			= trim( $request->int_var['params']['billZip'] );

			if ( isset( $request->int_var['params']['billAddress'] ) ) {
				$a['x_country']			= trim( $request->int_var['params']['billCountry'] );
			}
		}

		if ( $this->settings['testmode'] ) {
			$a['x_test_request']		= "TRUE";
		}

		$a = $this->customParams( $this->settings['customparams'], $a, $request );

		$stringarray = array();
		foreach ( $a as $name => $value ) {
			if ( is_array( $value ) ) {
				foreach ( $value as $v ) {
					$stringarray[] = $name . '=' . urlencode( stripslashes( $v ) );
				}
			} else {
				$stringarray[] = $name . '=' . urlencode( stripslashes( $value ) );
			}
		}

		$string = implode( '&', $stringarray );

		return $string;
	}

	function transmitRequestXML( $xml, $request )
	{
		$path = "/gateway/transact.dll";

		if ( !empty( $this->settings['dumpmode'] ) ) {
			$path = "/tools/datavalidation";
			$url = "http://developer.authorize.net" . $path;
		} elseif ( $this->settings['testmode'] ) {
			$url = "https://test.authorize.net" . $path;
		} else {
			$url = "https://secure.authorize.net" . $path;
		}

		$response = $this->transmitRequest( $url, $path, $xml, 443 );

		if ( !empty( $this->settings['dumpmode'] ) ) {
			echo "<h1>Request:</h1>";
			echo "<pre>";
			echo print_r($request);
			echo "</pre>";
			echo "<h1>We send:</h1>";
			echo "<pre>";
			echo urldecode(str_replace( "&", "\n", $xml ));
			echo "</pre>";
			echo "<h1>Authorize.net reponds:</h1>";
			echo $response;
			exit;
		}

		$return['valid'] = false;
		$return['raw'] = $response;

		if ( $response ) {
			$returnarray = explode( '|', $response );
			$i = 0;
			$responsearray = array();
			foreach ( $returnarray as $content ) {
				$i++;
				$fval = $content;

				switch( $i ) {
					case 1:		$fname = 'response_code';		break;
					case 2:		$fname = 'response_subcode';	break;
					case 3:		$fname = 'response_reason_code';break;
					case 4:		$fname = 'response_reason_text';break;
					case 5:		$fname = 'approval_code';		break;
					case 6:		$fname = 'avs_result_code';		break;
					case 7:		$fname = 'transaction_id';		break;
					case 8:		$fname = 'invoice_number';		break;
					case 9:		$fname = 'description';			break;
					case 10:	$fname = 'amount';				break;
					case 11:	$fname = 'method';				break;
					case 12:	$fname = 'transaction_type';	break;
					case 13:	$fname = 'customer_id';			break;
					case 14:	$fname = 'billFirstName';		break;
					case 15:	$fname = 'billLastName';		break;
					case 16:	$fname = 'company';				break;
					case 17:	$fname = 'billAddress';			break;
					case 18:	$fname = 'billCity';			break;
					case 19:	$fname = 'billState';			break;
					case 20:	$fname = 'billZip';				break;
					case 21:	$fname = 'billCountry';			break;
					case 22:	$fname = 'phone';				break;
					case 23:	$fname = 'fax';					break;
					case 24:	$fname = 'email';				break;
					case 25:	$fname = 'shipToFirstName';		break;
					case 26:	$fname = 'shipToLastName';		break;
					case 27:	$fname = 'shipToCompany';		break;
					case 28:	$fname = 'shipToAddress';		break;
					case 29:	$fname = 'shipToCity';			break;
					case 30:	$fname = 'shipToState';			break;
					case 31:	$fname = 'shipToZip';			break;
					case 32:	$fname = 'shipToCountry';		break;
					case 33:	$fname = 'tax';					break;
					case 34:	$fname = 'duty';				break;
					case 35:	$fname = 'freight';				break;
					case 36:	$fname = 'tax_exempt';			break;
					case 37:	$fname = 'po_num';				break;
					case 38:	$fname = 'md5';					break;
					case 39:
						$fname = 'card_response';

						if ( $content == "M" ) {
							$fval = "M - Match";
						} elseif ( $content == "N" ) {
							$fval = "N - No Match";
						} elseif($content == "P" ) {
							$fval = "P - Not Processed";
						} elseif($content == "S" ) {
							$fval = "S - Should have been present";
						} elseif ( $content == "U" ) {
							$fval = "U - Issuer unable to process request";
						} else {
							$fval = "NO VALUE RETURNED";
						}
						break;
					default:
						continue;
						break;
				}

				$responsearray[$fname] = $fval;
			}

			$return['invoice'] = $responsearray['invoice_number'];

			if ( ( $responsearray['response_code'] == 1 ) || ( strcmp( $responsearray['response_reason_text'], "This transaction has been approved." ) === 0 ) ) {
				$return['valid'] = 1;
			} else {
				$return['error'] = $responsearray['response_reason_text'];
			}

			$return['invoiceparams'] = array( "transaction_id" => $responsearray['transaction_id'] );

			$return['raw'] = $responsearray;
		}

		return $return;
	}
}
?>