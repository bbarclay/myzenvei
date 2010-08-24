<?php
/**
 * @version $Id: iats.php
 * @package AEC - Account Control Expiration - Membership Manager
 * @subpackage Processors - iATS
 * @copyright 2007-2008 Copyright (C) David Deutsch
 * @author David Deutsch <skore@skore.de> & Team AEC - http://www.valanx.org
 * @license GNU/GPL v.2 http://www.gnu.org/licenses/old-licenses/gpl-2.0.html or, at your option, any later version
 */

// Dont allow direct linking
( defined('_JEXEC') || defined( '_VALID_MOS' ) ) or die( 'Direct Access to this location is not allowed.' );

class processor_iats extends XMLprocessor
{
	function info()
	{
		$info = array();
		$info['name']			= 'iats';
		$info['longname']		= _CFG_IATS_LONGNAME;
		$info['statement']		= _CFG_IATS_STATEMENT;
		$info['description']	= _CFG_IATS_DESCRIPTION;
		$info['currencies']		= 'USD,GBP,AUD';
		$info['languages']		= 'GB';
		$info['cc_list']		= 'visa,mastercard,discover,americanexpress';
		$info['recurring']		= 2;
		// TODO: $info['recurring_buttons']	= 2;
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
		$settings['testmode']	= 0;

		$settings['agent_code']	= '';
		$settings['password']	= '';

		return $settings;
	}

	function backend_settings()
	{
		$settings = array();
		$settings['testmode']		= array( 'list_yesno' );
		$settings['currency']		= array( 'list_currency' );
		$settings['server_type']	= array( 'list_yesno' );

		$settings['agent_code']	= array( 'inputC' );
		$settings['password']	= array( 'inputC' );

		$settings['exp_amount']	= array( 'inputC' );
		$settings['exp_unit']	= array( 'list' );

		$perunit = array();
		$perunit[] = mosHTML::makeOption( 'M', _PAYPLAN_PERUNIT3 );
		$perunit[] = mosHTML::makeOption( 'Y', _PAYPLAN_PERUNIT4 );

		$settings['lists']['exp_unit']		= mosHTML::selectList( $perunit, 'iats_exp_unit', 'size="4"', 'value', 'text', ( empty($this->settings['exp_unit']) ? 'Y' : $this->settings['exp_unit'] ) );

		return $settings;
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
		$ppParams = $request->metaUser->meta->getProcessorParams( $request->parent->id );

		$var = array();

		$var['AgentCode']			= $this->settings['agent_code'];
		$var['Password']			= $this->settings['password'];

		if ( !empty( $ppParams['customer_id'] ) ) {
			$var['CustCode']			= $ppParams['customer_id'];
		} else {
			$var['CustCode']			= '';
		}

		$var['FirstName']			= trim( $request->int_var['params']['billFirstName'] );
		$var['LastName']			= trim( $request->int_var['params']['billLastName'] );

		$var['Address']				= $request->int_var['params']['billAddress'];
		$var['City']				= $request->int_var['params']['billCity'];
		$var['State']				= $request->int_var['params']['billState'];
		$var['ZipCode']				= $request->int_var['params']['billZip'];

		if ( is_array( $request->int_var['amount'] ) ) {
			$tvar = array();
			$fvar = array();

			$hastrial = false;

			if ( isset( $request->int_var['amount']['amount1'] ) ) {
				$t = $this->convertPeriodUnit( $request->int_var['amount']['period1'], $request->int_var['amount']['unit1'] );

				$tvar['ScheduleType']	= $t['unit'];
				$tvar['ScheduleDate']	= $t['period'];

				switch ( $t['unit'] ) {
					case 'D': $unit = 'days'; break;
					case 'W': $unit = 'weeks'; break;
					case 'M': $unit = 'months'; break;
					case 'Y': $unit = 'years'; break;
					default: $unit = 'days'; break;
				}

				$offset = strtotime( '+' . $t['period'] . ' ' . $unit );

				$tvar['BeginDate']		= date( 'Y-m-d' );
				$tvar['EndDate']		= date( 'Y-m-d', $offset );

				$tvar['MOP']			= $request->int_var['params']['cardType'];
				$tvar['CCNum']			= $request->int_var['params']['cardNumber'];
				$tvar['CCEXPIRY']		= str_pad( $request->int_var['params']['expirationMonth'], 2, '0', STR_PAD_LEFT ).'/'.$request->int_var['params']['expirationYear'];

				$tvar['CVV2']			= $request->int_var['params']['cardVV2'];

				$tvar['Amount']			= $request->int_var['amount']['amount1'];
				$tvar['Reoccurring']	= "OFF";

				foreach ( $fvar as $n => $v ) {
					$var[$n.'1'] = $v;
				}

				$hastrial = true;
			}

			$f = $this->convertPeriodUnit( $request->int_var['amount']['period3'], $request->int_var['amount']['unit3'] );

			$fvar['ScheduleType']		= $f['unit'];
			$fvar['ScheduleDate']		= $f['period'];

			$offset2 = strtotime( '+' . $this->settings['exp_amount'] . ' ' . ( ( $this->settings['exp_unit'] == 'M' ) ? 'months' : 'years' ) );

			if ( $hastrial ) {
				$offset3 = $offset2 + $offset - time();

				$fvar['BeginDate']		= date( 'Y-m-d' );
				$fvar['EndDate']		= date( 'Y-m-d', $offset3 );
			} else {
				$fvar['BeginDate']		= date( 'Y-m-d' );
				$fvar['EndDate']		= date( 'Y-m-d', $offset2 );
			}

			$fvar['MOP']				= $request->int_var['params']['cardType'];
			$fvar['CCNum']				= $request->int_var['params']['cardNumber'];
			$fvar['CCEXPIRY']			= str_pad( $request->int_var['params']['expirationMonth'], 2, '0', STR_PAD_LEFT ).'/'.$request->int_var['params']['expirationYear'];

			$fvar['CVV2']				= $request->int_var['params']['cardVV2'];

			$fvar['Amount']				= $request->int_var['amount']['amount3'];
			$fvar['Reoccurring']		= "ON";

			foreach ( $fvar as $n => $v ) {
				$var[$n.($hastrial ? '2' : '1')] = $v;
			}

			$var['ProfileReference']	= $request->invoice->invoice_number;

			$this->path = "/itravel/Customer_Create.pro";
		} else {
			$var['MOP']			= $request->int_var['params']['cardType'];
			$var['CCNum']			= $request->int_var['params']['cardNumber'];
			$var['CCEXPIRY']		= str_pad( $request->int_var['params']['expirationMonth'], 2, '0', STR_PAD_LEFT ).'/'.$request->int_var['params']['expirationYear'];

			$var['CVV2']			= $request->int_var['params']['cardVV2'];

			$var['Total']			= $request->int_var['amount'];

			$this->path = "/trams/authresult.pro";
		}

		$var['InvoiceNum']			= $request->invoice->invoice_number;

		$var['Version']				= "1.30";

		$content = array();
		foreach ( $var as $name => $value ) {
			$content[] .= urlencode( $name ) . '=' . urlencode( stripslashes( $value ) );
		}
aecDebug($content);
		return implode( '&', $content );
	}

	function transmitToTicketmaster( $xml, $request, $path=null )
	{
		if ( empty( $path ) ) {
			if ( !empty( $this->path ) ) {
				$path = $this->path;
			} else {
				$path = "/itravel/itravel.pro";
			}
		}

		if ( !isset( $this->cookieFile ) && ( $this->settings['server_type'] == 1 ) ) {
			$this->cookieFile = "cookie" .date("his"). ".txt";
		}

		if ( $this->settings['server_type'] == 1 ) {
			$iats = 'iatsuk';
		} else {
			$iats = 'iats';
		}

		if ( $request->invoice->currency == "AUD" ) {
			$iats = 'iatsau';
		}

		if ( $this->settings['testmode'] ) {
			$url = "http://www." . $iats . ".ticketmaster.com" . $path;
			$port = 80;
		} else {
			$url = "https://www." . $iats . ".ticketmaster.com" . $path;
			$port = 443;
		}

		$curlextra = array();
		$curlextra[CURLOPT_SSL_VERIFYHOST]	= 2;
		$curlextra[CURLOPT_USERAGENT]		= "Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)";
		$curlextra[CURLOPT_SSL_VERIFYHOST]	= 1;

		$cookieFile = "cookie" .date("his"). ".txt";

		if ( $this->settings['server_type'] == 1 ) {
			$curlextra[CURLOPT_COOKIEFILE] = $this->cookieFile;
		} else {
			$curlextra[CURLOPT_USERPWD] = $this->settings['agent_code'] . ":" . $this->settings['password'];
		}
aecDebug($url);aecDebug($path);aecDebug($port);aecDebug($curlextra);aecDebug($xml);
		return $this->transmitRequest( $url, $path, $xml, $port, $curlextra );
	}

	function transmitRequestXML( $xml, $request, $path=null )
	{
		$response = $this->transmitToTicketmaster( $xml, $request, $path );
aecDebug($response);
		$cccheck	= stristr( $response, "CustCode " );
		$cccheck	= stristr( $cccheck, "value=" );
		$ipos2		= strpos( $cccheck, ">" );
		$customer	= substr( $cccheck, 7, $ipos2 - 8 );

		if ( !empty( $customer ) ) {
			$ppParams = $request->metaUser->meta->getProcessorParams( $request->parent->id );

			$ppParams['customer_id'] = $customer;

			$request->metaUser->meta->setProcessorParams( $request->parent->id, $ppParams );
		}

		$return = array();
		$return['valid'] = false;
		$return['raw'] = $response;

		$iatsReturn = stristr( $response, "AUTHORIZATION RESULT:" );
		$iatsReturn = substr( $iatsReturn, strpos( $iatsReturn, ":" ) + 1, strpos( $iatsReturn , "<" ) - strpos( $iatsReturn , ":" ) - 1 );
aecDebug($iatsReturn);
		if ( $iatsReturn == "" ) {
			$return['error'] = 1;
			$return['errormsg'] = 'Rejected: Error Page';
		} else {
			$return['valid'] = true;
		}

		return $return;
	}

	function customaction_cancel( $request )
	{
		$ppParams = $request->metaUser->meta->getProcessorParams( $request->parent->id );

		if ( empty( $ppParams['customer_id'] ) ) {
			Payment_HTML::error( 'com_acctexp', $request->metaUser->cmsUser, $request->invoice, "An error occured while cancelling your subscription. Please contact the system administrator!", true );
		}

		$var = array();

		$var['AgentCode']			= $this->settings['agent_code'];
		$var['Password']			= $this->settings['password'];

		$var['CustCode']			= $ppParams['customer_id'];

		$var['Version']				= "1.30";

		$content = array();
		foreach ( $var as $name => $value ) {
			$content[] .= urlencode( $name ) . '=' . urlencode( stripslashes( $value ) );
		}

		$xml = implode( '&', $content );

		$path = "/itravel/Customer_Delete.pro";

		$r = $this->transmitToTicketmaster( $xml, $request, $path );

		if ( $r['valid'] ) {
			unset( $ppParams['customer_id'] );

			$request->metaUser->meta->setProcessorParams( $request->parent->id, $ppParams );

			$return['valid'] = 0;
			$return['cancel'] = true;

			return $return;
		} else {
			Payment_HTML::error( 'com_acctexp', $request->metaUser->cmsUser, $request->invoice, "An error occured while cancelling your subscription. Please contact the system administrator!", true );
		}
	}

	function convertPeriodUnit( $period, $unit )
	{
		$return = array();
		switch ( $unit ) {
			case 'D':
				$period = 1;
			case 'W':
				$return['unit'] = 'WEEKLY';
				$return['period'] = $period;
				break;
			case 'Y':
				$period *= 12;
			case 'M':
				$return['unit'] = 'MONTHLY';
				$return['period'] = $period;
				break;
		}

		return $return;
	}

	function ProfileRequest( $request, $profileid, $var )
	{
		$var['']				= '';

		$content = array();
		foreach ( $var as $name => $value ) {
			$content[] .= strtoupper( $name ) . '=' . urlencode( $value );
		}

		$xml = implode( '&', $content );

		return $this->transmitToTicketmaster( $xml, $request );
	}

}

?>