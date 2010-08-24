<?php
/**
 * @version $Id: 2checkout.php,v 1.0 2007/06/21 09:22:22 mic Exp $ $Revision: 1.0 $
 * @package AEC - Account Control Expiration - Membership Manager
 * @subpackage Processors - 2CheckOut
 * @copyright 2006-2008 Copyright (C) David Deutsch
 * @author David Deutsch <skore@skore.de> & Team AEC - http://www.valanx.org
 * @license GNU/GPL v.2 http://www.gnu.org/licenses/old-licenses/gpl-2.0.html or, at your option, any later version
 */

// Dont allow direct linking
( defined('_JEXEC') || defined( '_VALID_MOS' ) ) or die( 'Direct Access to this location is not allowed.' );

class processor_2checkout extends POSTprocessor
{
	function info()
	{
		$info = array();
		$info['name']					= '2checkout';
		$info['longname'] 				= _AEC_PROC_INFO_2CO_LNAME;
		$info['statement'] 				= _AEC_PROC_INFO_2CO_STMNT;
		$info['description'] 			= _DESCRIPTION_2CHECKOUT;
		$info['cc_list'] 				= "visa,mastercard,discover,americanexpress,echeck,jcb,dinersclub";
		$info['recurring'] 				= 0;
		$info['notify_trail_thanks']	= 1;

		return $info;
	}

	function settings()
	{
		$settings = array();
		$settings['sid']			= '2checkout sid';
		$settings['secret_word']	= 'secret_word';
		$settings['testmode']		= 0;
		$settings['alt2courl']		= '';
		$settings['info']			= ''; // new mic
		$settings['item_name']		= sprintf( _CFG_PROCESSOR_ITEM_NAME_DEFAULT, '[[cms_live_site]]', '[[user_name]]', '[[user_username]]' );
		$settings['customparams']		= "";

		return $settings;
	}

	function backend_settings()
	{
		$settings = array();
		$settings['testmode']		= array( 'list_yesno' );
		$settings['sid']			= array( 'inputC' );
		$settings['secret_word']	= array( 'inputC' );
		$settings['info']			= array( 'fieldset' );
		$settings['alt2courl']		= array( 'list_yesno' );
		$settings['item_name']		= array( 'inputE' );
		$settings['customparams']	= array( 'inputD' );

		$settings = AECToolbox::rewriteEngineInfo( null, $settings );

		return $settings;
	}

	function createGatewayLink( $request )
	{
		if ( $this->settings['alt2courl'] ) {
			$var['post_url']		= 'https://www2.2checkout.com/2co/buyer/purchase';
		} else {
			$var['post_url']		= 'https://www.2checkout.com/2co/buyer/purchase';
		}

		if ( $this->settings['testmode'] ) {
			$var['testmode']		= 1;
			$var['demo']			= 'Y';
		}

		$var['sid']					= $this->settings['sid'];
		$var['invoice_number']		= $request->invoice->invoice_number;
		$var['fixed']				= 'Y';
		$var['total']				= $request->int_var['amount'];

		$var['cust_id']				= $request->metaUser->cmsUser->id;
		$var['cart_order_id']		= AECToolbox::rewriteEngineRQ( $this->settings['item_name'], $request );
		$var['username']			= $request->metaUser->cmsUser->username;
		$var['name']				= $request->metaUser->cmsUser->name;

		return $var;
	}

	function parseNotification( $post )
	{
		$description	= $post['cart_order_id'];
		$key			= $post['key'];
		$total			= $post['total'];
		$userid			= $post['cust_id'];
	    $invoice_number	= $post['invoice_number'];
	    $order_number	= $post['order_number'];
		$username		= $post['username'];
		$name			= $post['name'];
		$planid			= $post['planid'];
		$name			= $post['name'];

		$response = array();
		$response['invoice'] = $invoice_number;

		return $response;
	}

	function validateNotification( $response, $post, $invoice )
	{
		if ($this->settings['testmode']) {
			$string_to_hash	= $this->settings['secret_word'].$this->settings['sid']."1".$post['total'];
		} else {
			$string_to_hash	= $this->settings['secret_word'].$this->settings['sid'].$post['order_number'].$post['total'];
		}

		$check_key = strtoupper(md5($string_to_hash));

		$response['valid'] = (strcmp($check_key, $post['key']) == 0);

		return $response;
	}

}
?>
