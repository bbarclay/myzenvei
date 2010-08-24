<?php
/**
 * @version $Id: netcash.php,v 1.0 2009/04/21 $Revision: 1.0 $
 * @package AEC - Account Control Expiration - Membership Manager
 * @subpackage Processors - Netcash
 * @author Warren Clifton <info@galore.co.za> & Team Galore - http://galore.co.za
 * @license GNU/GPL v.2 http://www.gnu.org/licenses/old-licenses/gpl-2.0.html or, at your option, any later version
 */

// Dont allow direct linking
( defined('_JEXEC') || defined( '_VALID_MOS' ) ) or die( 'Direct Access to this location is not allowed.' );

class processor_netcash extends POSTprocessor
{
	function info()
	{
		$info = array();
		$info['name']					= 'Netcash';
		$info['longname'] 				= _CFG_NETCASH_LONGNAME;
		$info['statement'] 				= _CFG_NETCASH_STATEMENT;
		$info['description'] 			= _CFG_NETCASH_DESCRIPTION;
		$info['currencies']				= 'ZAR';
		$info['cc_list'] 				= "visa,mastercard";
		$info['recurring'] 				= 0;
		$info['languages']			    = 'EN';
		$info['notify_trail_thanks']	= 1;

		return $info;
	}

	function settings()
	{
		global $mainframe;

		$settings = array();

		$settings['user_name']			    = '';
		$settings['password']    			= '';
		$settings['pin']		        	= '';
		$settings['terminal_id']			= '';
		$settings['recipient_description']	= $mainframe->getCfg( 'sitename' );
		$settings['language'] 				= 'EN';
		$settings['currency'] 				= 'ZAR';
		$settings['confirmation_note']		= "Thank you for subscribing on " . $mainframe->getCfg( 'sitename' ) . "!";
		$settings['item_name']				= sprintf( _CFG_PROCESSOR_ITEM_NAME_DEFAULT, '[[cms_live_site]]', '[[user_name]]', '[[user_username]]' );
		$settings['customparams']			= "";

		return $settings;
	}

	function backend_settings()
	{
		$settings = array();

		$settings['user_name']			    = array( 'inputC');
		$settings['password']			    = array( 'inputC');
		$settings['pin']		        	= array( 'inputC');
		$settings['terminal_id']			= array( 'inputC');
		$settings['recipient_description']	= array( 'inputE');
		$settings['language'] 				= array( 'list_language' );
		$settings['currency'] 				= array( 'list_currency' );
		$settings['confirmation_note']		= array( 'inputE');
		$settings['item_name']				= array( 'inputE');
		$settings['customparams']			= array( 'inputD' );

		$settings = AECToolbox::rewriteEngineInfo( null, $settings );

		return $settings;
	}

	function createGatewayLink( $request )
	{
		$var['post_url']				= 'https://gateway.netcash.co.za/vvonline/ccnetcash.asp';

		$var['m_1']                     = $this->settings['user_name'];
		$var['m_2']                     = $this->settings['password'];
		$var['m_3']                     = $this->settings['pin'];
		$var['p1']                      = $this->settings['terminal_id'];
		$var['p2']                      = $request->invoice->invoice_number;
		$var['p3']                      = AECToolbox::rewriteEngine( $this->settings['item_name'], $request->metaUser, $request->new_subscription, $request->invoice );
		$var['p4']                      = $request->int_var['amount'];
		$var['p10']                     = AECToolbox::deadsureURL( 'index.php?task=cancel' );
		//$var['p10']                     = AECToolbox::deadsureURL( 'index.php?cancel=cancel&option=com_acctexp' );//Works
		$var['m_9']                     = $request->metaUser->cmsUser->email;
		$var['m_10']                    = 'task=netcashnotification&amp;option=com_acctexp';

		return $var;
	}

	function parseNotification( $post )
	{
		$response = array();
		$get = aecPostParamClear( $_GET );

		$response['invoice']			= $get['Reference'];
		$response['amount_paid']		= $get['Amount'];
		$response['reason']             = $get['Reason'];

		return $response;
	}

	function validateNotification( $response, $post, $invoice )
	{
		$response['valid'] = 0;
		$get = aecPostParamClear( $_GET );

		if($get['TransactionAccepted'] == 'true'){
			$response['valid'] = 1;
		}else{
		    $response['valid'] = 0;
		    $response['error'] = 1;
		    $response['errormsg'] = $get['Reason'];
		}

		return $response;
	}

}
?>