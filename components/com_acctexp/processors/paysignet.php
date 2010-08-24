<?php
/**
 * @version $Id: paysignet.php
 * @package AEC - Account Control Expiration - Membership Manager
 * @subpackage Processors - Paysignet
 * @copyright 2007-2008 Copyright (C) David Deutsch
 * @author David Deutsch <skore@skore.de> & Team AEC - http://www.valanx.org
 * @license GNU/GPL v.2 http://www.gnu.org/licenses/old-licenses/gpl-2.0.html or, at your option, any later version
 */

// Dont allow direct linking
( defined('_JEXEC') || defined( '_VALID_MOS' ) ) or die( 'Direct Access to this location is not allowed.' );

class processor_paysignet extends POSTprocessor
{
	function info()
	{
		$info = array();
		$info['name']					= "paysignet";
		$info['longname']				= "Paysignet";
		$info['statement']				= "Make payments with Paysignet!";
		$info['description']			= _DESCRIPTION_PAYSIGNET;
		$info['cc_list']				= "visa,mastercard,discover,americanexpress,echeck";
		$info['recurring']				= 0;
		$info['notify_trail_thanks']	= 1;

		return $info;
	}

	function settings()
	{
		$settings = array();
		$settings['merchant']		= "merchant";
		$settings['testmode']		= 0;
		$settings['customparams']	= "";

		return $settings;
	}

	function backend_settings()
	{
		$settings = array();
		$settings['testmode']		= array( "list_yesno" );
		$settings['merchant'] 		= array( "inputC" );
		$settings['customparams']	= array( 'inputD' );

		return $settings;
	}

	function createGatewayLink( $request )
	{
		$var['post_url']			= "https://www.paysignet.com/validate/paysign_getdetails.asp";

		$var['epq_MMerchantOId']	= $request->invoice->invoice_number;
		$var['epq_AAmountA1']		= $request->int_var['amount'];
		$var['epq_MMerchantB2']		= $this->settings['merchant'];

		$var['epqb_NNameA1']		= $request->metaUser->cmsUser->name;

		return $var;
	}

	function parseNotification( $post )
	{
		$order_id		= $post['order_id'];
		$bank_name		= $post['bank_name'];
		$trans_status	= $post['trans_status'];
		$success		= $post['success'];

		$response = array();
		$response['invoice'] = $post['order_id'];
		$response['valid'] = ($success == '1');

		return $response;
	}

}
?>