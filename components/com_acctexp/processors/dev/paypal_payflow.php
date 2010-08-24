<?php
/**
 * @version $Id: paypal_payflow.php
 * @package AEC - Account Control Expiration - Membership Manager
 * @subpackage Processors - PayPal Payflow
 * @copyright 2007-2008 Copyright (C) David Deutsch
 * @author David Deutsch <skore@skore.de> & Team AEC - http://www.valanx.org
 * @license GNU/GPL v.2 http://www.gnu.org/licenses/old-licenses/gpl-2.0.html or, at your option, any later version
 */

// Dont allow direct linking
( defined('_JEXEC') || defined( '_VALID_MOS' ) ) or die( 'Direct Access to this location is not allowed.' );

class processor_paypal_payflow extends XMLprocessor
{
	function info()
	{
		$info = array();
		$info['name']			= 'paypal_payflow';
		$info['longname']		= _CFG_PAYPAL_PAYFLOW_LONGNAME;
		$info['statement']		= _CFG_PAYPAL_PAYFLOW_STATEMENT;
		$info['description']	= _CFG_PAYPAL_PAYFLOW_DESCRIPTION;
		$info['currencies']		= 'EUR,USD,GBP,AUD,CAD,JPY,NZD,CHF,HKD,SGD,SEK,DKK,PLN,NOK,HUF,CZK,MXN,ILS';
		$info['languages']		= AECToolbox::getISO4271_codes();
		$info['cc_list']		= 'visa,mastercard,discover,americanexpress,echeck,giropay';
		$info['recurring']		= 0;
		$info['actions']		= array( 'cancel' => array( 'confirm' ) );
		$info['secure']			= 1;

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
		$settings['testmode']				= 0;
		$settings['currency']				= 'USD';

		$settings['api_user']				= '';
		$settings['api_vendor']				= '';
		$settings['api_password']			= '';
		$settings['use_certificate']		= '';
		$settings['certificate_path']	= '';
		$settings['signature']				= '';
		$settings['country']				= 'US';

		$settings['item_name']				= sprintf( _CFG_PROCESSOR_ITEM_NAME_DEFAULT, '[[cms_live_site]]', '[[user_name]]', '[[user_username]]' );

		return $settings;
	}

	function backend_settings()
	{
		$settings = array();
		$settings['aec_experimental']		= array( "p" );
		$settings['testmode']				= array( 'list_yesno' );
		$settings['currency']				= array( 'list_currency' );

		$settings['api_user']				= array( 'inputC' );
		$settings['api_password']			= array( 'inputC' );
		$settings['signature'] 				= array( 'inputC' );
		$settings['country'] 				= array( 'list' );

		$settings['cancel_note']			= array( 'inputE' );
		$settings['item_name']				= array( 'inputE' );

		$country_sel = array();
		$country_sel[] = mosHTML::makeOption( 'US', 'US' );
		//$country_sel[] = mosHTML::makeOption( 'UK', 'UK' );

		$settings['lists']['country'] = mosHTML::selectList( $country_sel, 'paypal_payflow_country', 'size="2"', 'value', 'text', $this->settings['country'] );

		$settings = AECToolbox::rewriteEngineInfo( null, $settings );

		return $settings;
	}

	function registerProfileTabs()
	{
		$tab			= array();
		$tab['details']	= _AEC_USERFORM_BILLING_DETAILS_NAME;

		return $tab;
	}

	function customtab_details( $request )
	{
		$profileid = $request->invoice->params['paypal_payflow_customerProfileId'];

		$billfirstname	= aecGetParam( 'billFirstName', null );
		$billcardnumber	= aecGetParam( 'cardNumber', null );

		$updated = null;

		if ( !empty( $billfirstname ) && !empty( $billcardnumber ) && ( strpos( $billcardnumber, 'X' ) === false ) ) {
			$var['Method']					= 'UpdateRecurringPaymentsProfile';
			$var['Profileid']				= $profileid;

			$var['card_type']				= aecGetParam( 'cardType' );
			$var['card_number']				= aecGetParam( 'cardNumber' );
			$var['expDate']					= str_pad( aecGetParam( 'expirationMonth' ), 2, '0', STR_PAD_LEFT ) . aecGetParam( 'expirationYear' );
			$var['CardVerificationValue']	= aecGetParam( 'cardVV2' );

			$udata = array( 'firstname' => 'billFirstName', 'lastname' => 'billLastName', 'street' => 'billAddress', 'street2' => 'billAddress2',
							'city' => 'billCity', 'state' => 'billState', 'zip' => 'billZip', 'country' => 'billCountry'
							);

			foreach ( $udata as $authvar => $aecvar ) {
				$value = trim( aecGetParam( $aecvar ) );

				if ( !empty( $value ) ) {
					$var[$authvar] = $value;
				}
			}

			$result = $this->ProfileRequest( $request, $profileid, $var );

			$updated = true;
		}

		if ( $profileid ) {
			$var['Method']				= 'GetRecurringPaymentsProfileDetails';
			$var['Profileid']			= $profileid;

			$vars = $this->ProfileRequest( $request, $profileid, $var );

			$vcontent = array();
			$vcontent['card_type']		= strtolower( $vars['CREDITCARDTYPE'] );
			$vcontent['card_number']	= 'XXXX' . $vars['ACCT'];
			$vcontent['firstname']		= $vars['FIRSTNAME'];
			$vcontent['lastname']		= $vars['LASTNAME'];

			if ( isset( $vars['STREET1'] ) ) {
				$vcontent['address']		= $vars['STREET1'];
				$vcontent['address2']		= $vars['STREET2'];
			} else {
				$vcontent['address']		= $vars['STREET'];
			}

			$vcontent['city']			= $vars['CITY'];
			$vcontent['state_usca']		= $vars['STATE'];
			$vcontent['zip']			= $vars['ZIP'];
			$vcontent['country_list']	= $vars['COUNTRY'];
		} else {
			$vcontent = array();
		}

		$var = $this->checkoutform( $request, $vcontent, $updated );

		$return = '<form action="' . AECToolbox::deadsureURL( 'index.php?option=com_acctexp&amp;task=paypal_payflow_details', true ) . '" method="post">' . "\n";
		$return .= $this->getParamsHTML( $var ) . '<br /><br />';
		$return .= '<input type="hidden" name="userid" value="' . $request->metaUser->userid . '" />' . "\n";
		$return .= '<input type="hidden" name="task" value="subscriptiondetails" />' . "\n";
		$return .= '<input type="hidden" name="sub" value="paypal_payflow_details" />' . "\n";
		$return .= '<input type="submit" class="button" value="' . _BUTTON_APPLY . '" /><br /><br />' . "\n";
		$return .= '</form>' . "\n";

		return $return;
	}

	function checkoutform( $request, $vcontent=null, $updated=null )
	{
		$var = array();

		if ( !empty( $vcontent ) ) {
			if ( !empty( $updated ) ) {
				$msg = _AEC_CCFORM_UPDATE2_DESC;
			} else {
				$msg = _AEC_CCFORM_UPDATE_DESC;
			}

			$var['params']['billUpdateInfo'] = array( 'p', _AEC_CCFORM_UPDATE_NAME, $msg, '' );
		}

		$values = array( 'card_type', 'card_number', 'card_exp_month', 'card_exp_year', 'card_cvv2' );
		$var = $this->getCCform( $var, $values, $vcontent );

		$values = array( 'firstname', 'lastname', 'address', 'address2', 'city', 'state_usca', 'zip', 'country_list' );
		$var = $this->getUserform( $var, $values, $request->metaUser, $vcontent );

		return $var;
	}

	function createRequestXML( $request )
	{
		global $mainframe;

		$var = array();

		if ( is_array( $request->int_var['amount'] ) ) {
			$var['Method']			= 'CreateRecurringPaymentsProfile';
		} else {
			$var['Method']			= 'DoDirectPayment';
		}

		if ( is_array( $request->int_var['amount'] ) ) {
			$var['Version']			= '59.0';
		} else {
			$var['Version']			= '3.2';
		}

		$var['user']				= $this->settings['api_user'];
		$var['pwd']					= $this->settings['api_password'];
		$var['signature']			= $this->settings['signature'];

		$var['firstName']			= trim( $request->int_var['params']['billFirstName'] );
		$var['lastName']			= trim( $request->int_var['params']['billLastName'] );
		$var['creditCardType']		= $request->int_var['params']['cardType'];
		$var['acct']				= $request->int_var['params']['cardNumber'];
		$var['expDate']				= str_pad( $request->int_var['params']['expirationMonth'], 2, '0', STR_PAD_LEFT ).$request->int_var['params']['expirationYear'];

		$var['CardVerificationValue'] = $request->int_var['params']['cardVV2'];
		$var['cvv2']				= $request->int_var['params']['cardVV2'];

		$var['street']				= $request->int_var['params']['billAddress'];

		if ( !empty( $request->int_var['params']['billAddress2'] ) ) {
			$var['street2']			= $request->int_var['params']['billAddress2'];
		}

		$var['city']				= $request->int_var['params']['billCity'];
		$var['state']				= $request->int_var['params']['billState'];
		$var['zip']					= $request->int_var['params']['billZip'];
		$var['countrycode']			= $request->int_var['params']['billCountry'];
		$var['NotifyUrl']			= AECToolbox::deadsureURL( 'index.php?option=com_acctexp&amp;task=paypal_payflownotification' );
		$var['desc']				= AECToolbox::rewriteEngineRQ( $this->settings['item_name'], $request );
		$var['InvNum']				= $request->invoice->invoice_number;;

		if ( is_array( $request->int_var['amount'] ) ) {
			// $var['InitAmt'] = 'Initial Amount'; // Not Supported Yet
			// $var['FailedInitAmtAction'] = 'ContinueOnFailure'; // Not Supported Yet (optional)

			if ( isset( $request->int_var['amount']['amount1'] ) ) {
				/* For now, this is not working, we have to wait until PayPal fixes this
				$trial = $this->convertPeriodUnit( $request->int_var['amount']['period1'], $request->int_var['amount']['unit1'] );

				$var['TrialBillingPeriod']		= $trial['unit'];
				$var['TrialBillingFrequency']	= $trial['period'];
				$var['TrialAmt']				= $request->int_var['amount']['amount1'];
				$var['TrialTotalBillingCycles'] = 1; // Not Fully Supported Yet
				*/

				switch ( $request->int_var['amount']['unit1'] ) {
					case 'D': $offset = $request->int_var['amount']['period1'] * 3600 * 24; break;
					case 'W': $offset = $request->int_var['amount']['period1'] * 3600 * 24 * 7; break;
					case 'M': $offset = $request->int_var['amount']['period1'] * 3600 * 24 * 31; break;
					case 'Y': $offset = $request->int_var['amount']['period1'] * 3600 * 24 * 356; break;
				}

				$timestamp = time() - ($mainframe->getCfg( 'offset_user' ) *3600) + $offset;
			} else {
				$timestamp = time() - $mainframe->getCfg( 'offset_user' ) *3600;
			}

			$var['ProfileStartDate']    = date( 'Y-m-d', $timestamp ) . 'T' . date( 'H:i:s', $timestamp ) . 'Z';

			$full = $this->convertPeriodUnit( $request->int_var['amount']['period3'], $request->int_var['amount']['unit3'] );

			$var['BillingPeriod']		= $full['unit'];
			$var['BillingFrequency']	= $full['period'];
			$var['amt']					= $request->int_var['amount']['amount3'];
			$var['ProfileReference']	= $request->invoice->invoice_number;
		} else {
			$var['amt']					= $request->int_var['amount'];
		}

		$var['currencyCode']			= $this->settings['currency'];

		$content = array();
		foreach ( $var as $name => $value ) {
			$content[] .= strtoupper( $name ) . '=' . urlencode( stripslashes( $value ) );
		}

		return implode( '&', $content );
	}

	function transmitToPayPal( $xml, $request )
	{
		$path = "/nvp";

		if ( $this->settings['testmode'] ) {
			$url = "https://api-3t.sandbox.paypal.com" . $path;
		} else {
			$url = "https://api-3t.paypal.com" . $path;
		}

		$curlextra = array();
		$curlextra[CURLOPT_VERBOSE] = 1;

		return $this->transmitRequest( $url, $path, $xml, 443, $curlextra );
	}

	function transmitRequestXML( $xml, $request )
	{
		$response = $this->transmitToPayPal( $xml, $request );

		$return = array();
		$return['valid'] = false;
		$return['raw'] = $response;

		// converting NVPResponse to an Associative Array
		$nvpResArray = $this->deformatNVP( $response );

		if ( $response ) {
			if ( isset( $nvpResArray['PROFILEID'] ) ) {
				$return['invoiceparams'] = array( "paypal_payflow_customerProfileId" => $nvpResArray['PROFILEID'] );
			}

			if ( strcmp( strtoupper( $nvpResArray['ACK'] ), 'SUCCESS' ) === 0 ) {
				if ( is_array( $request->int_var['amount'] ) ) {
					if ( !isset( $nvpResArray['STATUS'] ) ) {
						$return['valid'] = 1;
					} elseif ( strtoupper( $response['STATUS'] ) == 'ACTIVEPROFILE' ) {
						$return['valid'] = 1;
					} else {
						$response['pending_reason'] = 'pending';
					}
				} else {
					$return['valid'] = 1;
				}
			} else {
				$count = 0;
				while ( isset( $nvpResArray["L_SHORTMESSAGE".$count] ) ) {
						$return['error'] .= 'Error ' . $nvpResArray["L_ERRORCODE".$count] . ' = ' . $nvpResArray["L_SHORTMESSAGE".$count] . ' (' . $nvpResArray["L_LONGMESSAGE".$count] . ')' . "\n";
						$count++;
				}
			}
		}

		return $return;
	}

	function convertPeriodUnit( $period, $unit )
	{
		$return = array();
		switch ( $unit ) {
			case 'D':
				$return['unit'] = 'Day';
				$return['period'] = $period;
				break;
			case 'W':
				$return['unit'] = 'Week';
				$return['period'] = $period;
				break;
			case 'M':
				$return['unit'] = 'Month';
				$return['period'] = $period;
				break;
			case 'Y':
				$return['unit'] = 'Year';
				$return['period'] = $period;
				break;
		}

		return $return;
	}

	function customaction_cancel( $request )
	{
		$var['Method']				= 'ManageRecurringPaymentsProfileStatus';
		$var['action']				= 'Cancel';
		$var['note']				= $this->settings['cancel_note'];

		$profileid = $request->invoice->params['paypal_payflow_customerProfileId'];

		$response = $this->ProfileRequest( $request, $profileid, $var );

		if ( !empty( $response ) ) {
			$return['invoice'] = $request->invoice->invoice_number;

			if ( isset( $response['PROFILEID'] ) ) {
				if ( $response['PROFILEID'] == $profileid ) {
					$return['valid'] = 0;
					$return['cancel'] = true;
				} else {
					$return['valid'] = 0;
					$return['error'] = 'Could not transmit Cancel Message - Wrong Profile ID returned';
				}
			} else {
				$return['valid'] = 0;
				$return['error'] = 'Could not transmit Cancel Message - General Failure';
			}

			return $return;
		} else {
			Payment_HTML::error( 'com_acctexp', $request->metaUser->cmsUser, $request->invoice, "An error occured while cancelling your subscription. Please contact the system administrator!", true );
		}
	}

	function ProfileRequest( $request, $profileid, $var )
	{
		$var['Version']				= '59.0';
		$var['user']				= $this->settings['api_user'];
		$var['pwd']					= $this->settings['api_password'];
		$var['signature']			= $this->settings['signature'];

		$var['profileid']			= $profileid;

		$content = array();
		foreach ( $var as $name => $value ) {
			$content[] .= strtoupper( $name ) . '=' . urlencode( $value );
		}

		$xml = implode( '&', $content );

		$response = $this->transmitToPayPal( $xml, $request );

		return $this->deformatNVP( $response );
	}

	function deformatNVP( $nvpstr )
	{

		$intial=0;
	 	$nvpArray = array();
		while ( strlen( $nvpstr ) ) {
			//postion of Key
			$keypos= strpos($nvpstr,'=');
			//position of value
			$valuepos = strpos($nvpstr,'&') ? strpos($nvpstr,'&'): strlen($nvpstr);

			/*getting the Key and Value values and storing in a Associative Array*/
			$keyval=substr($nvpstr,$intial,$keypos);
			$valval=substr($nvpstr,$keypos+1,$valuepos-$keypos-1);
			//decoding the respose
			$nvpArray[urldecode($keyval)] =urldecode( $valval);
			$nvpstr=substr($nvpstr,$valuepos+1,strlen($nvpstr));
		}

		return $nvpArray;
	}

	function parseNotification( $post )
	{
		$database = &JFactory::getDBO();

		$mc_gross			= $post['mc_gross'];
		if ( $mc_gross == '' ) {
			$mc_gross 		= $post['mc_amount1'];
		}
		$mc_currency		= $post['mc_currency'];

		$response = array();

		if ( !empty( $post['invoice'] ) ) {
			$response['invoice'] = $post['invoice'];
		} elseif ( !empty( $post['rp_invoice_id'] ) ) {
			$response['invoice'] = $post['rp_invoice_id'];
		}

		$response['amount_paid'] = $mc_gross;
		$response['amount_currency'] = $mc_currency;

		return $response;
	}

	function validateNotification( $response, $post, $invoice )
	{
		$path = '/cgi-bin/webscr';
		if ($this->settings['testmode']) {
			$ppurl = 'www.sandbox.paypal.com' . $path;
		} else {
			$ppurl = 'www.paypal.com' . $path;
		}

		$req = 'cmd=_notify-validate';

		foreach ( $post as $key => $value ) {
			$value = urlencode( stripslashes( $value ) );
			$req .= "&$key=$value";
		}

		$fp = null;
		$fp = $this->transmitRequest( $ppurl, $path, $req, $port=443, $curlextra=null );

		$res = $fp;

		$response['fullresponse']['paypal_verification'] = $res;

		$receiver_email	= null;
		$txn_type		= null;
		$payment_type	= null;
		$payment_status	= null;
		$reason_code	= null;

		$getposts = array( 'txn_type', 'receiver_email', 'payment_status', 'payment_type', 'reason_code' );

		foreach ( $getposts as $n ) {
			if ( isset( $post[$n] ) ) {
				$$n = $post[$n];
			} else {
				$$n = null;
			}
		}

		$response['valid'] = 0;

		if ( strcmp( $receiver_email, $this->settings['business'] ) != 0 && $this->settings['checkbusiness'] ) {
			$response['pending_reason'] = 'checkbusiness error';
		} elseif ( strcmp( $res, 'VERIFIED' ) == 0 ) {
			// Process payment: Paypal Subscription & Buy Now
			if ( ( $txn_type == 'web_accept' ) || ( $txn_type == 'subscr_payment' ) || ( $txn_type == 'recurring_payment' ) ) {

				$recurring = ( ( $txn_type == 'subscr_payment' ) || ( $txn_type == 'recurring_payment' ) );

				if ( ( strcmp( $payment_type, 'instant' ) == 0 ) && ( strcmp( $payment_status, 'Pending' ) == 0 ) ) {
					$response['pending_reason'] = $post['pending_reason'];
				} elseif ( strcmp( $payment_type, 'instant' ) == 0 && strcmp( $payment_status, 'Completed' ) == 0 ) {
					$response['valid']			= 1;
				} elseif ( strcmp( $payment_type, 'echeck' ) == 0 && strcmp( $payment_status, 'Pending' ) == 0 ) {
					if ( $this->settings['acceptpendingecheck'] ) {
						if ( is_object( $invoice ) ) {
							$invoice->setParams( array( 'acceptedpendingecheck' => 1 ) );
							$invoice->check();
							$invoice->store();
						}

						$response['valid']			= 1;
						$response['pending_reason'] = 'echeck';
					} else {
						$response['pending']		= 1;
						$response['pending_reason'] = 'echeck';
					}
				} elseif ( strcmp( $payment_type, 'echeck' ) == 0 && strcmp( $payment_status, 'Completed' ) == 0 ) {
					if ( $this->settings['acceptpendingecheck'] ) {
						if ( is_object( $invoice ) ) {
							$invoiceparams = $invoice->getParams();

							if ( isset( $invoiceparams['acceptedpendingecheck'] ) ) {
								$response['valid']		= 0;
								$response['duplicate']	= 1;

								$invoice->delParams( array( 'acceptedpendingecheck' ) );
								$invoice->check();
								$invoice->store();
							}
						} else {
							$response['valid']			= 1;
						}
					} else {
						$response['valid']			= 1;
					}
				}
			} elseif ( ( strcmp( $txn_type, 'subscr_signup' ) == 0 ) || ( strcmp( $txn_type, 'recurring_payment_profile_created' ) == 0 ) ) {
				$response['pending']		= 1;
				$response['pending_reason'] = 'silent_signup';
			} elseif ( strcmp( $txn_type, 'paymentreview' ) == 0 ) {
				$response['pending']			= 1;
				$response['pending_reason']	 = 'paymentreview';
			} elseif ( strcmp( $txn_type, 'subscr_eot' ) == 0 ) {
				$response['eot']				= 1;
			} elseif ( strcmp( $txn_type, 'subscr_failed' ) == 0 ) {
				$response['null']				= 1;
				$response['explanation']		= 'Subscription Payment Failed';
			} elseif ( strcmp( $txn_type, 'subscr_cancel' ) == 0 ) {
				$response['cancel']				= 1;
			} elseif ( strcmp( $reason_code, 'refund' ) == 0 ) {
				$response['delete']				= 1;
			}
		} else {
			$response['pending_reason']			= 'error: ' . $res;
		}

		return $response;
	}

}

?>