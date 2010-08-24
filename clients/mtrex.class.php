<?php

class mtrex {

	var $payment_test 		= "TRUE";
	var $payment_login 		= "testaccount";
	var $payment_password 	= "k5eWtc7dRgia";
	var $payment_url 		= "gateway.mtrex.com";
	var $payment_email_merchant = "sokcheadoung@gmail.com";
	var $payment_email_customer = "YES";
	var $payment_error_code = "YES";
	var $error_messages = NULL;
	var $user_ip_address = NULL;

	/**************************************************************************
	** name: __construct() initialize the class
	** created by: Sydore Pry
	** description: initialize mtrex class
	***************************************************************************/
	function __construct($login=NULL,$password=NULL,$test="TRUE") {
		// check if test payment is enable = TRUE
		$this->payment_test=($test?$test:$this->payment_test);
		// check if user assign merchant login account
		$this->login=($login?$login:$this->payment_login);
		// check if user assign merchant password
		$this->password=($password?$password:$this->payment_password);
		
		$this->user_ip_address=$_SERVER["REMOTE_ADDR"];
	}
	
	
	/**************************************************************************
	** name: process_payment()
	** created by: Sydore Pry
	** description: process transaction with mtrex.com
	***************************************************************************/
	function process_payment($vars,$recurring="NO") {

		//Mtrex vars to send
		$formdata = array (
		'mp_APIVersion' => '1.6',
		'mp_AuthenticationID' => $this->payment_login,
		'mp_AuthenticationPassword' => $this->payment_password,
		'mp_IsTestTrans' => strtoupper( $this->payment_test ),
		'mp_ConfigID' => '1',

		// Customer Name and Billing Address
		'mp_BillingFirstName' => substr($vars["billing_first_name"], 0, 50),
		'mp_BillingLastName' => substr($vars["billing_last_name"], 0, 50),
		'mp_BillingCompany' => substr($vars["billing_company"], 0, 50),
		'mp_BillingAddressLine1' => substr($vars["billing_address"], 0, 60),
		'mp_BillingCity' => substr($vars["billing_city"], 0, 40),
		'mp_BillingState' => substr($vars["billing_state"], 0, 40),
		'mp_BillingPostalCode' => substr($vars["billing_zip"], 0, 20),
		'mp_BillingCountryCode' => substr($vars["billing_country"], 0, 60),
		'mp_BillingPhone' => substr($vars["billing_phone"], 0, 25),

		// Customer Shipping Address
		'mp_ShippingFirstName' => substr($vars["shipping_first_name"], 0, 50),
		'mp_ShippingLastName' => substr($vars["shipping_last_name"], 0, 50),
		'mp_ShippingCompany' => substr($vars["shipping_company"], 0, 50),
		'mp_ShippingAddressLine1' => substr($vars["shipping_address"], 0, 60),
		'mp_ShippingCity' => substr($vars["shipping_city"], 0, 40),
		'mp_ShippingState' => substr($vars["shipping_state"], 0, 40),
		'mp_ShippingPostalCode' => substr($vars["shipping_zip"], 0, 20),
		'mp_ShippingCountryCode' => substr($vars["shipping_country"], 0, 60),
		'mp_ShippingPhone' => substr($vars["shipping_phone"], 0, 25),

		// Additional Customer Data
		'mp_CustomerIPAddress' => $this->user_ip_address,

		// Email Settings
		'mp_MerchantEmailToAddress' => $this->payment_email_merchant,

		// Transaction Data
		'mp_TotalAmount' => $vars["order_total"],
		'mp_CurrencyCode' => $vars["currency"],
		'mp_TransClearingAction' => ($recurring=='YES'?'Hold':'Capture'),
		'mp_PaymentMethod' => 'CreditCard',
		'mp_MessageRequestType' => 'Sale',
		'mp_IsRecurringTrans' => $recurring,
		'mp_NameOnCard' => $vars["credit_card_name"],
		'mp_CardNumber' => $vars["credit_card_number"],
		'mp_CardValidationValue' => $vars["credit_card_code"],
		'mp_CardExpirationDate' => ($vars["expire_month"]) . ($vars["expire_year"]),

		);
		// if recurring mtrex not required a CVV
		if($recurring=="YES")
			{
			unset($formdata["mp_CardValidationValue"]);
			}

		//build the post string
		$poststring = '';
		foreach($formdata AS $key => $val){
			$poststring .= urlencode($key) . "=" . urlencode($val) . "&";
		}
		// strip off trailing ampersand
		$poststring = substr($poststring, 0, -1);
		
	
		$result=$this->handleCommunication( "https://$this->payment_url/omega.mp", $poststring );
		
		
		if( !$result ) {
			$this->error_messages='The transaction could not be completed.' ;
			return false;
		}

		
		$responses = explode("&", $result);
		
		$this->error_messages='Beginning to analyse the response from '.$this->payment_url;
		
		foreach($responses as $res)
			{
			@list($key,$value)=split('=',$res);
			$response[$key]=$value;
			}

		// Approved - Success!
		if ($response['mp_TransResult'] == 'Approved') {	
			//return $response;
			$formdata['mp_TransID']=$response['mp_TransID'];
			$response = $this->update_payment($formdata);
			return $response;
			
		}
		// Payment Declined
		elseif ($response['mp_TransResult'] == 'Declined') {

			$response["error_message"]=$this->error_messages;
			return $response;
			
		}
		// Transaction Error
		elseif ($response['mp_TransResult'] == 'Error') {

			$response["error_message"]=$this->error_messages;
			return $response;

		} 
		
		
	}
	/**************************************************************************
	** name: update_payment()
	** created by: Sydore Pry
	** description: process transaction with mtrex.com
	***************************************************************************/
	function update_payment($var) {
		//Mtrex vars to send
		$formdata = array (
		'mp_APIVersion' => '1.6',
		'mp_AuthenticationID' => $this->payment_login,
		'mp_AuthenticationPassword' => $this->payment_password,
		'mp_IsTestTrans' => strtoupper( $this->payment_test ),
		'mp_MessageRequestType' => 'Update',
		// Now we capture the transaction
		'mp_TransClearingAction' => 'Capture',
		'mp_ConfigID' => '1',
			
		// If we change the total amount, it must be less than or equal to the initial amount
		'mp_TotalAmount' => $var['mp_TotalAmount'],
		'mp_CurrencyCode' => $vars["mp_CurrencyCode"],
		
		'mp_IsTestTrans' => strtoupper( $this->payment_test ),
			
		// Get the transaction ID from the sale we just performed
		'mp_TransID' => $var['mp_TransID']
		);
		
		//build the post string
		$poststring = '';
		foreach($formdata AS $key => $val){
			$poststring .= urlencode($key) . "=" . urlencode($val) . "&";
		}
		// strip off trailing ampersand
		$poststring = substr($poststring, 0, -1);
		
	
		$result=$this->handleCommunication( "https://$this->payment_url/omega.mp", $poststring );
		
		
		if( !$result ) {
			$this->error_messages='The transaction could not be completed.' ;
			return false;
		}

		
		return $result;
	}
	/**************************************************************************
	** name: handleCommunication()
	** created by: Sydore Pry
	** description: process transaction with mtrex.com
	***************************************************************************/
	
	function handleCommunication( $url, $postData='', $headers=array() ) {
		
		$urlParts = parse_url( $url );
		if( !isset( $urlParts['port'] )) $urlParts['port'] = 80;
		if( !isset( $urlParts['scheme'] )) $urlParts['scheme'] = 'http';

		if( isset( $urlParts['query'] )) $urlParts['query'] = '?'.$urlParts['query'];
		if( isset( $urlParts['path'] )) $urlParts['path'] = $urlParts['path'];

		// Check proxy
		$proxyURL = '';
		

		if( function_exists( "curl_init" ) && function_exists( 'curl_exec' ) ) {

			$this->error_messages= 'Using the cURL library for communicating with '.$urlParts['host'] ;

			$CR = curl_init();
			curl_setopt($CR, CURLOPT_URL, $url);

			// just to get sure the script doesn't die
			curl_setopt($CR, CURLOPT_TIMEOUT, 30 );
			if( !empty( $headers )) {
				// Add additional headers if provided
				curl_setopt($CR, CURLOPT_HTTPHEADER, $headers);
			}
			curl_setopt($CR, CURLOPT_FAILONERROR, true);
			if( $postData ) {
				curl_setopt($CR, CURLOPT_POSTFIELDS, $postData );
				curl_setopt($CR, CURLOPT_POST, 1);
			}
			
			curl_setopt($CR, CURLOPT_RETURNTRANSFER, 1);
			
			// Do we need to set up the proxy?
			if( !empty($proxyURL) ) {
				$this->error_messages='Setting up proxy: '.$proxyURL['host'].':'.VM_PROXY_PORT ;
				//curl_setopt($CR, CURLOPT_HTTPPROXYTUNNEL, true);
				curl_setopt($CR, CURLOPT_PROXY, $proxyURL['host'] );
				curl_setopt($CR, CURLOPT_PROXYPORT, VM_PROXY_PORT );
				// Check if the proxy needs authentication
				if( trim( @VM_PROXY_USER ) != '') {
					$this->error_messages[]='Using proxy authentication!' ;
					curl_setopt($CR, CURLOPT_PROXYUSERPWD, VM_PROXY_USER.':'.VM_PROXY_PASS );
				}
			}

			if( $urlParts['scheme'] == 'https') {
				// No PEER certificate validation...as we don't have
				// a certificate file for it to authenticate the host www.ups.com against!
				curl_setopt($CR, CURLOPT_SSL_VERIFYPEER, 0);
				//curl_setopt($CR, CURLOPT_SSLCERT , "/usr/locale/xxxx/clientcertificate.pem");
			}
			$result = curl_exec( $CR );
			$error = curl_error( $CR );
			if( !empty( $error ) && stristr( $error, '502') && !empty( $proxyURL )) {
				$this->error_messages='Switching to NTLM authenticaton.';
				curl_setopt( $CR, CURLOPT_PROXYAUTH, CURLAUTH_NTLM );
				$result = curl_exec( $CR );
				$error = curl_error( $CR );
			}
			curl_close( $CR );

			if( !empty( $error )) {
				$this->error_messages= $error ;
				return false;
			}
			else {
				return $result;
			}
		}
		else {
			if( $postData ) {
				if( !empty( $proxyURL )) {
					// If we have something to post we need to write into a socket
					if( $proxyURL['scheme'] == 'https'){
						$protocol = 'ssl';
					}
					else {
						$protocol = 'http';
					}
					$fp = fsockopen("$protocol://".$proxyURL['host'], VM_PROXY_PORT, $errno, $errstr, $timeout = 30);
				}
				else {
					// If we have something to post we need to write into a socket
					if( $urlParts['scheme'] == 'https'){
						$protocol = 'ssl';
					}
					else {
						$protocol = $urlParts['scheme'];
					}
					$fp = fsockopen("$protocol://".$urlParts['host'], $urlParts['port'], $errno, $errstr, $timeout = 30);
				}
			}
			else {
				if( !empty( $proxyURL )) {
					// Do a read-only fopen transaction
					$fp = fopen( $proxyURL['scheme'].'://'.$proxyURL['host'].':'.VM_PROXY_PORT, 'rb' );
				}
				else {
					// Do a read-only fopen transaction
					$fp = @fopen( $urlParts['scheme'].'://'.$urlParts['host'].':'.$urlParts['port'].$urlParts['path'], 'rb' );
				}
			}
			if(!$fp){
				//error, plesae tell us which one
				$errmsg = "Possible server error!";
				if( !empty($errstr )) {
					$errmsg .= " - $errstr ($errno)\n";
				}
				$this->error_messages= $errmsg ;
				return false;
			}
			else {
				$this->error_messages='Connection opened to '.$urlParts['host'];
			}
			if( $postData ) {
				$this->error_messages='Now posting the variables.' ;
				//send the server request
				if( !empty( $proxyURL )) {
					fputs($fp, "POST ".$urlParts['host'].':'.$urlParts['port'].$urlParts['path']." HTTP/1.0\r\n");
					fputs($fp, "Host: ".$proxyURL['host']."\r\n");

					if( trim( @VM_PROXY_USER )!= '') {
						fputs($fp, "Proxy-Authorization: Basic " . base64_encode (VM_PROXY_USER.':'.VM_PROXY_PASS ) . "\r\n\r\n");
					}
				}
				else {
					fputs($fp, 'POST '.$urlParts['path']." HTTP/1.0\r\n");
					fputs($fp, 'Host:'. $urlParts['host']."\r\n");
				}
				fputs($fp, "Content-type: application/x-www-form-urlencoded\r\n");
				fputs($fp, "Content-length: ".strlen($postData)."\r\n");
				fputs($fp, "Connection: close\r\n\r\n");
				fputs($fp, $postData . "\r\n\r\n");
			}
			else {
				if( !empty( $proxyURL )) {
					fputs($fp, "GET ".$urlParts['host'].':'.$urlParts['port'].$urlParts['path']." HTTP/1.0\r\n");
					fputs($fp, "Host: ".$proxyURL['host']."\r\n");
					if( trim( @VM_PROXY_USER )!= '') {
						fputs($fp, "Proxy-Authorization: Basic " . base64_encode (VM_PROXY_USER.':'.VM_PROXY_PASS ) . "\r\n\r\n");
					}
				}
				else {
					fputs($fp, 'GET '.$urlParts['path']." HTTP/1.0\r\n");
					fputs($fp, 'Host:'. $urlParts['host']."\r\n");
				}
			}
			// Add additional headers if provided
			foreach( $headers as $header ) {
				fputs($fp, $header."\r\n");
			}
			$data = "";
			while (!feof($fp)) {
				$data .= @fgets ($fp, 4096);
			}
			fclose( $fp );

			// If didnt get content-lenght, something is wrong, return false.
			if ( trim($data) == '' ) {
				$this->error_messages='An error occured while communicating with the server '.$urlParts['host'].'. It didn\'t reply (correctly). Please try again later, thank you.' ;
				return false;
			}
			$result = trim( $data );
			if( is_resource($fileToSaveData )) {
				fwrite($fileToSaveData, $result );
				return true;
			} else {
				return $result;
			}
		}
	}
	
	
	
// end class here
}
