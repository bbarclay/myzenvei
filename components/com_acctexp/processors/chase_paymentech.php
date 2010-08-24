<?php
/**
 * @version $Id: chase_paymentech.php
 * @package AEC - Account Control Expiration - Membership Manager
 * @subpackage Processors - Chase Paymentech Orbital
 * @copyright 2008 Copyright (C) David Deutsch
 * @author David Deutsch <skore@skore.de> & Team AEC - http://www.valanx.org
 * @license GNU/GPL v.2 http://www.gnu.org/licenses/old-licenses/gpl-2.0.html or, at your option, any later version
 */

// Dont allow direct linking
( defined('_JEXEC') || defined( '_VALID_MOS' ) ) or die( 'Direct Access to this location is not allowed.' );

class processor_chase_paymentech extends PROFILEprocessor
{
	function info()
	{
		$info = array();
		$info['name']				= 'chase_paymentech';
		$info['longname']			= _CFG_CHASE_PAYMENTECH_LONGNAME;
		$info['statement']			= _CFG_CHASE_PAYMENTECH_STATEMENT;
		$info['description']		= _CFG_CHASE_PAYMENTECH_DESCRIPTION;
		$info['currencies']			= AECToolbox::aecCurrencyField( true, true, true, true );
		$info['cc_list']			= "visa,mastercard,discover,americanexpress,echeck,jcb,dinersclub";
		$info['recurring']			= 2;
		$info['recurring_buttons']	= 2;
		$info['actions']			= array( 'cancel' => array( 'confirm' ) );
		$info['secure']				= 1;

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
		$settings['testmode']			= 0;
		$settings['merchant_id']		= 'login';
		$settings['terminal_id']		= '001';
		$settings['BIN']				= '000002';
		$settings['currency']			= 'USD';
		$settings['pay_types']			= array( 'cc' );
		$settings['promptAddress']		= 0;
		$settings['promptZipOnly']		= 0;
		$settings['item_name']			= sprintf( _CFG_PROCESSOR_ITEM_NAME_DEFAULT, '[[cms_live_site]]', '[[user_name]]', '[[user_username]]' );
		$settings['customparams']		= '';

		return $settings;
	}

	function backend_settings()
	{
		$settings = array();
		$settings['aec_experimental']	= array( 'p' );
		$settings['testmode']			= array( 'list_yesno' );
		$settings['merchant_id'] 		= array( 'inputC' );
		$settings['terminal_id'] 		= array( 'inputC' );
		$settings['BIN']		 		= array( 'inputC' );
		$settings['currency']			= array( 'list_currency' );
		$settings['pay_types']			= array( 'list' );
		$settings['promptAddress']		= array( 'list_yesno' );
		$settings['promptZipOnly']		= array( 'list_yesno' );
		$settings['item_name']			= array( 'inputE' );
		$settings['customparams']		= array( 'inputD' );

		$paytypes = array( 'cc', 'echeck', 'eudd', 'gc', 'debit' );

		$pt = array();
		foreach ( $paytypes as $name ) {
			$cname = '_AEC_'.strtoupper($name).'FORM_TABNAME';

			if ( defined( $cname ) ) {
				$desc = constant( $cname );
			} else {
				$desc = $cname;
			}

			$paytypes_selection[] = mosHTML::makeOption( $name, $desc );

			if ( in_array( $name, $this->settings['pay_types'] ) ) {
				$pt[] = mosHTML::makeOption( $name, $desc );
			}
		}

		$s['lists']['bank']	= mosHTML::selectList( $paytypes_selection, 'chase_paymentech_pay_types', 'size="5"', 'value', 'text', $pt );

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
		$ppParams = $request->metaUser->meta->getProcessorParams( $request->parent->id );

		$post = aecPostParamClear( $_POST, true );

		if ( !empty( $post['edit_payprofile'] ) && ( $post['payprofileselect'] != "new" ) ) {
			$ppParams->paymentprofileid = $post['payprofileselect'];
		}

		if ( isset( $post['billFirstName'] ) && ( strpos( $post['cardNumber'], 'X' ) === false ) ) {

			if ( !empty( $post['cardNumber'] ) || !empty( $post['account_no'] ) ) {
				if( !empty( $post['account_no'] ) ) {
					$basicdata['paymentType']		= 'echeck';
					$basicdata['accountType']		= 'checking';
					$basicdata['routingNumber']		= $post['routing_no'];
					$basicdata['accountNumber']		= $post['account_no'];
					$basicdata['nameOnAccount']		= $post['account_name'];
					$basicdata['echeckType']		= 'CCD';
					$basicdata['bankName']			= $post['bank_name'];
				} else {
					$basicdata['paymentType']		= 'creditcard';
					$basicdata['cardNumber']		= trim( $post['cardNumber'] );
					$basicdata['expirationDate']	= $post['expirationYear'] . '-' . $post['expirationMonth'];
				}

				if ( $post['payprofileselect'] == "new" ) {
					$ppParams = $this->createProfileRequest();

					if ( !empty( $profileid ) ) {
						$ppParams = $this->payProfileAdd( $request, $profileid, $post, $ppParams );
					}
				} else {
					if ( isset( $ppParams->paymentProfiles->{$post['payprofileselect']} ) ) {
						$stored_spid = $ppParams->paymentProfiles->{$post['payprofileselect']}->profileid;
						$cim->setParameter( 'customerPaymentProfileId', $stored_spid );
						$cim->updateCustomerPaymentProfileRequest();

						if ( $cim->isSuccessful() ) {
							$this->payProfileUpdate( $request, $post['payprofileselect'], $post, $ppParams );
						}
					}
				}

				$cim->updateCustomerPaymentProfileRequest();

				$cim->setParameter( 'customerProfileId',		$cim->customerProfileId );
				$cim->setParameter( 'customerPaymentProfileId',	$cim->customerPaymentProfileId );
			}

		}

		$var = $this->ppProfileSelect( array(), $ppParams, true, $ppParams );
		$var2 = $this->checkoutform( $request );

		$return = '<form action="' . AECToolbox::deadsureURL( 'index.php?option=com_acctexp&amp;task=subscriptiondetails', true ) . '" method="post">' . "\n";
		$return .= $this->getParamsHTML( $var ) . '<br /><br />';
		$return .= $this->getParamsHTML( $var2 ) . '<br /><br />';
		$return .= '<input type="hidden" name="userid" value="' . $request->metaUser->userid . '" />' . "\n";
		$return .= '<input type="hidden" name="task" value="subscriptiondetails" />' . "\n";
		$return .= '<input type="hidden" name="sub" value="chase_paymentech_details" />' . "\n";
		$return .= '<input type="submit" class="button" value="' . _BUTTON_APPLY . '" /><br /><br />' . "\n";
		$return .= '</form>' . "\n";

		return $return;
	}

	function checkoutform( $request, $nobill=false, $ppParams=false )
	{
		$var = array();
		$vcontent = array();

		if ( $ppParams === false ) {
			$ppParams = $request->metaUser->meta->getProcessorParams( $request->parent->id );
		}

		if ( !$nobill ) {

			$vcontent = array();
			$cccontent = array();

			if ( $this->settings['recurring'] ) {
				$profile = $this->fetchProfile( $ppParams );

				$cccontent['card_number'] = $profile[''];
				$cccontent['account_no'] = $profile[''];
				$cccontent['routing_no'] = $profile[''];
			}

			if ( empty( $this->settings['pay_types'] ) ) {
				$this->settings['pay_types'] = array( 'cc' );
			}

			foreach ( $this->settings['pay_types'] as $type ) {
				switch ( $type ) {
					case 'cc':
						$array[$type] = array( 'values' => array( 'card_number', 'card_exp_month', 'card_exp_year', 'card_cvv2' ), 'vcontent' => $cccontent );
						break;
					case 'echeck':
						//$array[$type] = array( 'values' => array( 'card_number', 'card_exp_month', 'card_exp_year', 'card_cvv2' ), 'vcontent' => $vcontent );
						break;
					case 'eudd':
						//$array[$type] = array( 'values' => array( 'card_number', 'card_exp_month', 'card_exp_year', 'card_cvv2' ), 'vcontent' => $vcontent );
						break;
					case 'gc':
						//$array[$type] = array( 'values' => array( 'card_number', 'card_exp_month', 'card_exp_year', 'card_cvv2' ), 'vcontent' => $vcontent );
						break;
					case 'debit':
						//$array[$type] = array( 'values' => array( 'card_number', 'card_exp_month', 'card_exp_year', 'card_cvv2' ), 'vcontent' => $vcontent );
						break;
				}
			}

			$this->getMULTIPAYform( $var, $array );

		}

		if ( !empty( $this->settings['promptAddress'] ) ) {
			if ( isset( $profile ) ) {
				$uservalues = array( 'firstName', 'lastName', 'company', 'address', 'address2', 'city', 'state', 'zip', 'country', 'phone', 'fax' );

				$content = array();
				foreach ( $uservalues as $uv ) {
					if ( in_array( $uv, array( 'phone', 'fax' ) ) ) {
						$content[$uv] = $profile[$uv];
					} else {
						if ( $nobill && ( $uv == 'address' ) ) {
							$content[$uv] = $profile[$uv];
						} else {
							$content[$uv] = $profile[$uv];
						}
					}
				}
			}

			$var = $this->getUserform( $var, $uservalues, $request->metaUser, $content );
		}

		return $var;
	}

	function checkoutAction( $request )
	{
		global $aecConfig;

		$return = '<form action="' . AECToolbox::deadsureURL( 'index.php?option=com_acctexp&amp;task=checkout', true ) . '" method="post">' . "\n";

		if ( $this->settings['recurring'] ) {
			$ppParams = $request->metaUser->meta->getProcessorParams( $request->parent->id );

			if ( !empty( $ppParams ) ) {
				$var = array();
				$var = $this->ppProfileSelect( $var, $ppParams, false, false );

				$return .= $this->getParamsHTML( $var ) . '<br /><br />';
			}
		}

		$return .= $this->getParamsHTML( $this->checkoutform( $request ) ) . '<br /><br />';
		$return .= '<input type="hidden" name="invoice" value="' . $request->invoice->invoice_number . '" />' . "\n";
		$return .= '<input type="hidden" name="userid" value="' . $request->metaUser->userid . '" />' . "\n";
		$return .= '<input type="hidden" name="task" value="checkout" />' . "\n";
		$return .= '<input type="submit" class="button" value="' . _BUTTON_CHECKOUT . '" /><br /><br />' . "\n";
		$return .= '</form>' . "\n";

		return $return;
	}

	function createProfile( $ppParams )
	{
		$dom = new DOMDocument( '1.0', 'utf-8' );

		$R = $dom->appendChild( new DOMElement( 'Request' ) );
		$P = $R->appendChild( new DOMElement( 'Profile' ) );

		$var = array();

		$var['CustomerBin']			= $this->settings['BIN'];
		$var['CustomerMerchantID']	= $this->settings['merchant_id'];

		foreach ( $var as $k => $v ) {
			$P->appendChild( new DOMElement( $k, $v ) );
		}

		$xml = $this->transmitChase( $dom->saveXML() );

		if ( isset( $xml['Response']['profileResp'] ) ) {
			return $xml['Response']['profileResp'];
		} else {
aecDebug( $xml );
			return array();
		}
	}

	function fetchProfile( $ppParams )
	{
		$dom = new DOMDocument( '1.0', 'utf-8' );

		$R = $dom->appendChild( new DOMElement( 'Request' ) );
		$P = $R->appendChild( new DOMElement( 'Profile' ) );

		$var = array();

		$var['CustomerBin']			= $this->settings['BIN'];
		$var['CustomerMerchantID']	= $this->settings['merchant_id'];

		foreach ( $var as $k => $v ) {
			$P->appendChild( new DOMElement( $k, $v ) );
		}

		$xml = $this->transmitChase( $dom->saveXML() );

		if ( isset( $xml['Response']['profileResp'] ) ) {
			return $xml['Response']['profileResp'];
		} else {
aecDebug( $xml );
			return array();
		}
	}

	function createRequestXML( $request )
	{
		$dom = new DOMDocument( '1.0', 'utf-8' );

		$R = $dom->appendChild( new DOMElement( 'Request' ) );
		$NO = $R->appendChild( new DOMElement( 'NewOrder' ) );

		$var = array();

		if ( is_array( $request->int_var['amount'] ) ) {
			$var['IndustryType']	= 'RC';
		} else {
			$var['IndustryType']	= 'EC';
		}

		$var['MessageType']			= 'A';

		$this->appendAccountData( $var );
		$this->appendCurrencyData( $var );

		$this->appendPayData( $var, $request );

		foreach ( $var as $k => $v ) {
			$NO->appendChild( new DOMElement( $k, $v ) );
		}

		return $dom->saveXML();
	}

	function appendAccountData( &$var )
	{
		$var['BIN']			= $this->settings['BIN'];
		$var['MerchantID']	= $this->settings['merchant_id'];
		$var['TerminalID']	= $this->settings['terminal_id'];
	}

	function appendCurrencyData( &$var )
	{
		$var['CurrencyCode']		= AECToolbox::aecNumCurrency( $this->settings['currency'] );
		$var['CurrencyExponent']	= AECToolbox::aecCurrencyExp( $this->settings['currency'] );
	}

	function appendPayData( &$var, $request )
	{
		if( !empty( $request->int_var['params']['account_no'] ) ) {
			$basicdata['CheckDDA']		= $request->int_var['params']['account_no'];
		} else {
			$var['AccountNum']	= $request->int_var['params']['cardNumber'];
			$var['Exp']			= $request->int_var['params']['expirationYear'] . $request->int_var['params']['expirationMonth'];

			if ( !empty( $request->int_var['params']['cvv2'] ) ) {
				$var['CardSecValInd']	= '1';
				$var['CardSecVal']	= $request->int_var['params']['cvv2'];
			}
		}
	}

	function transmitChase( $xml )
	{
		$search = '<?xml version="1.0" encoding="utf-8"?>';

		if ( strpos( $search, $xml ) !== false ) {
			$xml = str_replace( $search, '', $xml );
		}

		$path = '/authorize';

		if ( $this->settings['testmode'] ) {
			$url = 'https://orbitalvar1.paymentech.net' . $path;
		} else {
			$url = 'https://orbital1.paymentech.net' . $path;
		}

		$curlextra = array();

		$response = $this->transmitRequest( $url, $path, $xml, 443, $curlextra );

		return $this->XMLtoArray( simplexml_load_string( $response ) );
	}

	function transmitRequestXML( $xml, $request )
	{
		$return['valid'] = false;

		$response = $this->transmitChase( $xml );

		if ( isset( $response['Response']['NewOrderResp'] ) ) {
			$r = $response['Response']['NewOrderResp'];
		} else {
			$r = array();
aecDebug( $response );
		}

		if ( $r['ProcStatus'] == 0 ) {

			$return['valid']	= true;
			$return['invoice']	= $r['ProcStatus'];
		} else {
			$return['error']		= $r['ProcStatus'] . ": " . $r['StatusMsg'];
		}

		return $return;
	}

	function prepareValidation( $subscription_list )
	{
		return true;
	}

	function validateSubscription( $subscription_id )
	{
		$database = &JFactory::getDBO();

		$invoice = new Invoice( $database );
		$invoice->loadbySubscriptionId( $subscription_id );

		$metaUser = new metaUser( $invoice->userid );
		$ppParams = $metaUser->meta->getProcessorParams( $request->parent->id );

		if ( !empty( $ppParams->profileid ) ) {

			if ( true ) {
				$invoice->pay();
				return true;
			}
		}

		return false;
	}

}
?>