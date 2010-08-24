<?php
/**
 * @version $Id: paycom.php
 * @package AEC - Account Control Expiration - Membership Manager
 * @subpackage Processors - Paycom
 * @copyright 2006-2008 Copyright (C) David Deutsch
 * @author David Deutsch <skore@skore.de> & Team AEC - http://www.valanx.org
 * @license GNU/GPL v.2 http://www.gnu.org/licenses/old-licenses/gpl-2.0.html or, at your option, any later version
 **/

// Dont allow direct linking
( defined('_JEXEC') || defined( '_VALID_MOS' ) ) or die( 'Direct Access to this location is not allowed.' );

class processor_paycom extends POSTprocessor
{
	function info()
	{
		$info = array();
		$info['name'] = "paycom";
		$info['longname'] = "paycom";
		$info['statement'] = "Make payments with Paycom!";
		$info['description'] = "paycom";
		$info['cc_list'] = "visa,mastercard,discover,echeck,jcb";
		$info['currencies'] = "USD";
		$info['recurring'] = 0;
		$info['notify_trail_thanks'] = 1;

		return $info;
	}

	function settings()
	{
		$settings = array();
		$settings['co_code']		= "Company Code";
		$settings['product_id']		= "Product Code";
		$settings['secretWord']		= "Secret Word";
		$settings['customparams']	= "";

		return $settings;
	}

	function backend_settings()
	{
		$settings = array();
		$settings['co_code']		= array( "inputC","Company Code","Three (3) alphanumeric ID assigned by Paycom.net" );
		$settings['product_id']		= array( "inputC","Product Code","Alphanumeric product code assigned by Paycom.net" );
		$settings['secretWord']		= array( "inputC","Secret Word","Used to encrypt and protect transactions" );
		$settings['info']			= array( 'fieldset' );
		$settings['customparams']	= array( 'inputD', "Notification URL", 'You need to remember to set the \'Notification URL\' url in your Paycom control panel... for both approves and declines this should be...<br />http://[YOUR JOOMLA LOCATION]/index.php?option=com_acctexp&task=paycomnotification<br />Thats it!' );

		return $settings;
	}

	function createGatewayLink( $request )
	{
		$var['post_url']		= "https://wnu.com/secure/fpost.cgi";
		$var['co_code']			= $this->settings['co_code'];
		$var['product_id']		= $this->settings['product_id'];
		$var['reseller']		= "a"; //hardcoded as per Paycom Interface documentation - required
		$var['x_invoice']		= $request->invoice->invoice_number;
		$var['zip']				= "";  //if you have this available through CB then use it ;)
		$var['email']			= $request->metaUser->cmsUser->email;
		$var['country']			= "";  //if you have this available through CB then use it ;) NOTE Paycom want a ISO 2 char country code.
		$var['x_checksum']		= md5($this->settings['secretWord'] . $request->metaUser->cmsUser->username);
		$var['handle_response']	= "true"; //instructs Paycom to handle the accept/deny process
		$var['response_post']	= "Y"; //tells Paycom - 'YES' we would like an answer please
		$var['no_userpass']		= "true"; //tells Paycom - we are handling the username and password
		$var['x_username']		= $request->metaUser->cmsUser->username;
		//		$var['bgcolor']			= $this->settings['bgcolor'];

		return $var;
	}


	function parseNotification( $post )
	{
		$invoice			= $post['x_invoice'];
		$name				= $post['name'];
		$address			= $post['address'];
		$city				= $post['city'];
		$state				= $post['state'];
		$zip				= $post['zip'];
		$country			= $post['country'];
		$email				= $post['email'];
		$ip_address			= $post['ip_address'];
		$order_id			= $post['order_id'];
		$product_id			= $post['product_id'];
		$ans				= $post['ans'];
		$checksum			= $post['x_checksum'];
		$username			= $post['x_username'];


		$response = array();
		$response['invoice']	= $invoice;
		$response['valid']		= 1;
		$response['ans']		= $ans;
		$response['checksum']	= $checksum;


		return $response;
	}

	function validateNotification( $response, $post, $invoice )
	{
		$validate			= md5( $this->settings['secretWord'] . $post['x_username'] );

		if ( substr( $post['ans'], 0, 1 ) == "Y" ) {
			$response['valid'] = 1;
		} else {
			$response['valid'] = 0;
			$response['pending'] = 1;
			$response['pending_reason'] = $post['ans'];

			return $response;
		}

		$response['valid'] = ( strcmp( $validate, $post['x_checksum'] ) == 0 );

		return $response;
	}

}
?>
