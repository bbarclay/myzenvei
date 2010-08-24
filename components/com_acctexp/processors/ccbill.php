<?php
/**
 * @version $Id: authorize_aim.php
 * @package AEC - Account Control Expiration - Membership Manager
 * @subpackage Processors - Authorize AIM
 * @copyright 2007-2008 Copyright (C) David Deutsch, Ben Ingram
 * @author David Deutsch <skore@skore.de> & Team AEC - http://www.valanx.org
 * @license GNU/GPL v.2 http://www.gnu.org/licenses/old-licenses/gpl-2.0.html or, at your option, any later version
 */

// Dont allow direct linking
( defined('_JEXEC') || defined( '_VALID_MOS' ) ) or die( 'Direct Access to this location is not allowed.' );

class processor_ccbill extends POSTprocessor
{
	function info()
	{
		$info = array();
		$info['name']					= 'ccbill';
		$info['longname']				= _CFG_CCBILL_LONGNAME;
		$info['statement']				= _CFG_CCBILL_STATEMENT;
		$info['description']			= _CFG_CCBILL_DESCRIPTION;
		$info['cc_list']				= "visa,mastercard,discover,echeck,jcb";
		$info['currencies']				= "USD";
		$info['recurring']				= 2;
		$info['notify_trail_thanks']	= 1;

		return $info;
	}

	function settings()
	{
		$settings = array();
		$settings['clientAccnum']		= "Account Number";
		$settings['clientSubacc']		= "Sub Account";
		$settings['formName']			= "Form Name";
		$settings['secretWord']			= "Secret Word";
		$settings['datalink_username']	= "Secret Word";
		$settings['customparams']		= "";

		return $settings;
	}

	function backend_settings()
	{
		$settings = array();

		$settings = array();
		$settings['clientAccnum']			= array( 'inputC' );
		$settings['clientSubacc']			= array( 'inputC' );
		$settings['formName']				= array( 'inputC' );
		$settings['secretWord']				= array( 'inputC' );
		$settings['info']					= array( 'fieldset' );
		$settings['datalink_username']		= array( 'inputC' );
		$settings['customparams']			= array( 'inputD' );

		$settings = AECToolbox::rewriteEngineInfo( null, $settings );

		return $settings;
	}

	function CustomPlanParams()
	{
		$p = array();
		$p['Allowedtypes']	= array( 'inputC' );

		return $p;
	}

	function createGatewayLink( $request )
	{
		$var['post_url']		= "https://bill.ccbill.com/jpost/signup.cgi";
		$var['clientAccnum']	= $this->settings['clientAccnum'];
		if ( !empty( $this->settings['clientSubacc'] ) ) {
			$var['clientSubacc']	= $this->settings['clientSubacc'];
		}
		$var['formName']		= $this->settings['formName'];

		$var['invoice']			= $request->invoice->invoice_number;
		$var['username']		= $request->metaUser->cmsUser->username;
		$var['password']		= "xxxxxx"; // hard coded because the CCBILL system can't deal with an empty password - despite having an option to ignore it...
		$var['email']			= $request->metaUser->cmsUser->email;
		$var['checksum']		= md5($this->settings['secretWord'] . $request->metaUser->cmsUser->username);

		if ( !empty( $request->int_var['planparams']['Allowedtypes'] ) ) {
			$var['allowedTypes'] = $request->int_var['planparams']['Allowedtypes'];
		}

		return $var;
	}

	/*
	CCBILL Response parameters - for future reference...

	customer_fname		Customer first name
	customer_lname		Customer last name
	email				Customer Email address, i.e., custmail@host.com
	username			Customer username
	password			Customer password
	productDesc			Product description
	price				Product price, i.e., $5.95 for 30 days (non-recurring)
	subscription_id		Subscription ID Number, i.e., 1000000000 (Approval Post URL only)
	reasonForDecline	The decline reason (Decline Post URL only)*
	clientAccnum		CCBill client main account number , i.e., 900100
	clientSubacc		CCBill client subaccount Number , i.e., 0000
	address1			Customer address
	city				Customer city
	state				Customer state
	country				Customer country
	phone_number		Customer phone number
	zipcode				Customer Zip Code
	start_date			The subscription start date Used to show individual corresponding yearly, monthly or daily dates for report data. The date function's format is year-month-day; for example, 2002-01-01., i.e., 2002-08-05 15:18:17
	referer				Use other Affiliate Program (non-CCBill)
	ccbill_referer		Use CCBill Affiliate Program
	reservationId		Customer�s subscription Reservation ID number
	initialPrice		The initial price of the subscription
	initialPeriod		The initial period of the subscription
	recurringPrice		The price of the subscription (recurring)
	recurringPeriod		The period of the subscription (recurring)
	rebills				The number of subscription rebills
	ip_address			Customer�s IP address , such as: 64.38.194.13
	*/

	function parseNotification( $post )
	{
		$database = &JFactory::getDBO();

		$invoice			= $post['invoice'];
		$username			= $post['username'];
		$reasonForDecline	= $post['reasonForDecline'];
		$checksum			= $post['checksum'];
		$customer_fname		= $post['customer_fname'];
		$customer_lname		= $post['customer_lname'];
		$email				= $post['email'];
		$password			= $post['password'];
		$productDesc		= $post['productDesc'];
		$price				= $post['price'];
		$clientAccnum		= $post['clientAccnum'];
		$clientSubacc		= $post['clientSubacc'];
		$address1			= $post['address1'];
		$city				= $post['city'];
		$state				= $post['state'];
		$country			= $post['country'];
		$subscription_id	= $post['subscription_id'];
		$phone_number		= $post['phone_number'];
		$zipcode			= $post['zipcode'];
		$start_date			= $post['start_date'];
		$referer			= $post['referer'];
		$ccbill_referer		= $post['ccbill_referer'];
		$reservationId		= $post['reservationId'];
		$initialPrice		= $post['initialPrice'];
		$initialPeriod		= $post['initialPeriod'];
		$recurringPrice		= $post['recurringPrice'];
		$recurringPeriod	= $post['recurringPeriod'];
		$rebills			= $post['rebills'];
		$ip_address			= $post['ip_address'];

		// Check whether this is a passive registration
		if ( empty( $invoice ) ) {
			$invoice = $subscription_id;

			// Make sure that we have not set this up before
			$exists = AECfetchfromDB::InvoiceIDfromNumber( $subscription_id );
			if ( empty( $exists ) ) {
				if ( ( $password == 'xxxxxx' ) || empty( $password ) ) {
					$password = strtoupper( substr( base64_encode( md5( rand() ) ), 0, 6 ) );
				}

				$user = array();
				$user['name'] = $customer_fname . ' ' . $customer_lname;
				$user['email'] = $email;
				$user['username'] = $username;
				$user['password'] = $password;

				$payment['secondary_ident'] = $subscription_id;
				$payment['processor'] = 'ccbill';

				$usage = null;
				if ( !empty( $post['usage'] ) ) {
					$usage = $post['usage'];
				} elseif( $post['typeId'] ) {
					$typeId = $post['typeId'];

					$firstzero = 1;
					while( $firstzero ) {
						$typeId = substr( $typeId, 1 );

						$firstzero = ( strpos( $typeId, "0" ) === 0 );
					}

					$search = 'Allowedtypes=' . $typeId;

					$query = 'SELECT id'
					. ' FROM #__acctexp_plans'
					. ' WHERE custom_params LIKE \'%' . $search . '%\''
					;

					$database->setQuery( $query );
					$planid = $database->loadResult();

					if ( $planid ) {
						$usage = $planid;
					}
				}

				if ( empty( $usage ) ) {
					$response['pending_reason'] = 'Could not identify usage';
				} else {
					$metaUser = new metaUser( 0 );
					$metaUser->procTriggerCreate( $user, $payment, $usage );
				}
			}
		}

		$response = array();
		$response['invoice'] = $invoice;
		$response['secondary_ident'] = $subscription_id;
		$response['valid'] = 1;

		if ( !empty( $reasonForDecline ) ) {
			$response['pending_reason'] = $reasonForDecline;
		}

		$response['checksum'] = $checksum;

		return $response;

	}

	function validateNotification( $response, $post, $invoice )
	{
		if ( isset( $response['pending_reason'] ) ){
			$response['valid'] = 0;
			return $response;
		}

		if ( isset( $response['checksum'] ) ) {
			$username = $post['username'];
			$validate = md5( $this->settings['secretWord'] . $username );

			$checkvalid = ( strcmp( $validate, $response['checksum'] ) == 0 );

			if ( !empty( $checkvalid ) ) {
				$response['valid'] = 1;
			} else {
				$response['valid'] = 0;
				$response['pending_reason'] = 'Checksum mismatch';
			}
		}

		if ( !empty( $response['valid'] ) ) {
			if ( !empty( $post['planparams']['recurring'] ) ) {
				$response['multiplicator'] = 'lifetime';
			}
		}

		return $response;
	}

	function prepareValidation( $subscription_list )
	{
		$database = &JFactory::getDBO();

		if ( !empty( $this->settings['datalink_username'] ) ) {
			if ( empty( $this->datalink_temp ) ) {
				$get = array();
				$get['startTime'] = date( 'YmdHis', ( time() - 24*60*60 - 1 ) );
				$get['endTime'] = date( 'YmdHis' );
				$get['transactionTypes'] = 'REBILL,EXPIRE';
				$get['clientAccnum'] = $this->settings['clientAccnum'];

				if ( !empty( $this->settings['clientSubacc'] ) ) {
					$get['clientSubacc'] = $this->settings['clientSubacc'];
				}

				$get['username'] = $this->settings['datalink_username'];
				$get['password'] = $this->settings['secretWord'];

				$fullget = array();
				foreach ( $get as $name => $value ) {
					$fullget[] = $name . '=' . $value;
				}

				$link = 'https://datalink.ccbill.com/data/main.cgi?';

				$link .= implode( '&', $fullget );

				$fp = null;
				$fp = $this->fetchURL( $link );

				if ( $fp ) {
					$lines = explode( "\n", $fp );

					$this->datalink_temp = array();
					foreach ( $lines as $line ) {
						$info = explode( ",", $line );

						$query = 'SELECT subscr_id'
						. ' FROM #__acctexp_invoices'
						. ' WHERE invoice_number = \'' . $info[2] . '\''
						. ' OR secondary_ident = \'' . $info[2] . '\''
						;
						$database->setQuery( $query );
						$subscription_id = $database->loadResult();

						switch ( $info[0] ) {
							case 'EXPIRE':
								$this->datalink_expire_temp[] = $subscription_id;
								break;
							case 'REBILL':
								$this->datalink_rebill_temp[] = $subscription_id;
								break;
							case 'REFUND':
							case 'CHARGEBACK':
								// No need to add this to the list - the payment has been reversed or cancelled by the user

								if ( $subscription_id ) {
									// Don't do anything if the user is about to expire anyways
									if ( !in_array( $subscription_id, $subscription_list ) ) {
										// But if that is not the case, expire and set to cancel

										$subscription = new Subscription( $database );
										$subscription->load( $subscription_id );
										$subscription->cancel();
									}
								}
								break;
						}
					}
				} else {
					return false;
				}
			}

			return true;
		} else {
			return null;
		}
	}

	function validateSubscription( $subscription_id )
	{
		$database = &JFactory::getDBO();

		if ( !empty( $this->datalink_rebill_temp ) ) {
			// Now lets check for this subscription
			if ( in_array( $subscription_id, $this->datalink_rebill_temp ) ) {
				$invoice = new Invoice( $database );
				$invoice->loadbySubscriptionId( $subscription_id );

				if ( $invoice->id ) {
					$invoice->computeAmount();
					$invoice->pay();
					return true;
				}
			}
		}

		if ( !empty( $this->datalink_expire_temp ) ) {
			// Now lets check for this subscription
			if ( !in_array( $subscription_id, $this->datalink_expire_temp ) ) {
				return true;
			}
		}

		return false;
	}

	function fetchURL( $url ) {
		$url_parsed = parse_url($url);

		$host = $url_parsed["host"];
		$port = $url_parsed["port"];
		if ( $port == 0 ) {
			if ( strpos( $url, "https://" ) !== false) {
				$port = 443;
			} else {
				$port = 80;
			}
		}
		$path = $url_parsed["path"];

		//if url is http://example.com without final "/"
		//I was getting a 400 error
		if ( empty( $path ) ) {
			$path="/";
		}

		if ( $url_parsed["query"] != "" ) {
			$path .= "?".$url_parsed["query"];
		}

		$out = "GET $path HTTP/1.0\r\nHost: $host\r\n\r\n";
		$fp = fsockopen( $host, $port, $errno, $errstr, 30 );

		if ( $fp ) {
			fwrite( $fp, $out );

			$return = '';
			while ( !feof( $fp ) ) {
				$return .= fgets($fp, 1024);
			}

			fclose( $fp );

			return $return;
		} else {
			return false;
		}
	}
}
?>
