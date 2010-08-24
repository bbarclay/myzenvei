<?php
( defined('_JEXEC') || defined( '_VALID_MOS' ) ) or die( 'Direct Access to this location is not allowed.' );

class processor_vcs extends POSTprocessor
{
	function info()
	{
		$info = array();
		$info['name']			= 'VCS';
		$info['longname']		= _CFG_VCS_LONGNAME;
		$info['statement']		= _CFG_VCS_STATEMENT;
		$info['description']	= _CFG_VCS_DESCRIPTION;
		$info['currencies']		= 'ZAR';
		$info['cc_list']		= 'visa,mastercard';
		$info['recurring']		= 2;

		return $info;
	}

	function settings()
	{
		$settings = array();
		$settings['testmode'] 		= 1;
		$settings['merchant_id']	= '1234';
		$settings['pam']			= 'PAM';
		$settings['currency']		= 'ZAR';
		$settings['item_name']		= sprintf( _CFG_PROCESSOR_ITEM_NAME_DEFAULT, '[[cms_live_site]]', '[[user_name]]', '[[user_username]]' );
		$settings['customparams']	= "";

		return $settings;
	}

	function backend_settings()
	{
		$settings = array();
		$settings['aec_experimental']	= array( "p" );
		$settings['testmode']		= array( 'list_yesno');
		$settings['merchant_id']	= array( 'inputC');
		$settings['pam']			= array( 'inputC');
		$settings['currency']		= array( 'list_currency' );
		$settings['item_name']		= array( 'inputE');
		$settings['customparams']	= array( 'inputD' );

		$settings = AECToolbox::rewriteEngineInfo( null, $settings );

		return $settings;
	}

	function createGatewayLink( $request )
	{
		$var['post_url']	= 'https://www.vcs.co.za/vvonline/ccform.asp';

		if ( $this->settings['testmode'] == '1' ) {
			$var['test_transaction'] = '100';
			$var['test_success_url'] = AECToolbox::deadsureURL( 'index.php?option=com_acctexp&amp;task=vcsnotification' );
		}

		$var['p1']		= $this->settings['merchant_id'];
		$var['p2']		= $request->invoice->invoice_number;
		$var['p3']		= date("Y.m.d.G.i.s");

		if ( is_array( $request->int_var['amount'] ) ) {
			$var['p4']		= $request->int_var['amount3'];

			$var['p7']		= $this->convertPeriodUnit( $request->int_var['period3'], $request->int_var['unit3'] );
		} else {
			$var['p4']		= $request->int_var['amount'];
		}

		$var['m_1']		= $request->int_var['return_url'];
		$var['m_2']		= AECToolbox::deadsureURL( 'index.php?option=com_acctexp&amp;task=cancel' );
		$var['m_3']		= AECToolbox::deadsureURL( 'index.php?option=com_acctexp&amp;task=vcsnotification' );
		$var['m_4']		= AECToolbox::deadsureURL( 'index.php?option=com_acctexp&amp;task=cancel' );
		$var['m_5']	    = $request->metaUser->cmsUser->name;
		$var['m_6']		= $request->metaUser->cmsUser->email;
		$var['m_7']		= AECToolbox::rewriteEngine( $this->settings['item_name'], $request->metaUser, $request->new_subscription, $request->invoice );

		return $var;
	}

	function convertPeriodUnit( $period, $unit )
	{
		$r = $period;

		switch ( $unit ) {
			case 'D':
				if ( $period < 7 ) {
					$r = $unit;
				} elseif ( ( $period >= 7 ) && ( $period < 30 ) ) {
					$r = 'W';
				} elseif ( ( $period >= 30 ) && ( $period < 365 ) ) {
					$r = 'M';
				} else {
					$r = 'Y';
				}

				break;
			case 'W':
				if ( $period < 4 ) {
					$r = $unit;
				} elseif ( ( $period >= 4 ) && ( $period < 12 ) ) {
					$r = 'M';
				} elseif ( ( $period >= 12 ) && ( $period < 24 ) ) {
					$r = 'Q';
				} elseif ( ( $period >= 24 ) && ( $period < 48 ) ) {
					$r = '6';
				} else {
					$r = 'Y';
				}

				break;
			case 'M':
				if ( $period < 3 ) {
					$r = $unit;
				} elseif ( ( $period >= 3 ) && ( $period < 6 ) ) {
					$r = 'Q';
				} elseif ( ( $period >= 6 ) && ( $period < 12 ) ) {
					$r = '6';
				} else {
					$r = 'Y';
				}

				break;
			case 'Y':
				$r = $unit;

				break;
		}

		return $r;
	}

	function parseNotification( $post )
	{
		$response = array();
		$response['invoice'] = $post['p2'];
		$response['amount_paid'] = $post['p6'];

		return $response;
	}

	function validateNotification( $response, $post, $invoice )
	{
		$response['valid'] = 0;

		if ( isset( $this->settings['pam'] ) ) {
			if ( $this->settings['pam'] == $post['pam'] ) {
				$response['valid'] = 1;
			} else {
				$response['pending_reason'] = 'false PAM';
			}
		} else {
			$response['pending_reason'] = 'no PAM set - please configure the Personal Authentication Message in your VCS and AEC VCS settings!';
		}

		if ( $post['p4'] == 'Duplicate' ) {
			$response['duplicate'] = true;
		}

		if ( substr( $post['p4'], 6 ) !== 'APPROVED' ) {
			$response['valid'] = 0;
			$response['pending_reason'] = $post['p4'];
		}

		return $response;
	}

}

?>