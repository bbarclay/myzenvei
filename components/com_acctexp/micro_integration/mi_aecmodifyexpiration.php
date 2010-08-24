<?php
/**
 * @version $Id: mi_aecmodifyexpiration.php
 * @package AEC - Account Control Expiration - Membership Manager
 * @subpackage Micro Integrations - Modify Expiration
 * @copyright 2006-2009 Copyright (C) David Deutsch
 * @author David Deutsch <skore@skore.de> & Team AEC - http://www.valanx.org
 * @license GNU/GPL v.2 http://www.gnu.org/licenses/old-licenses/gpl-2.0.html or, at your option, any later version
 */

// Dont allow direct linking
( defined('_JEXEC') || defined( '_VALID_MOS' ) ) or die( 'Direct Access to this location is not allowed.' );

class mi_aecmodifyexpiration
{
	function Info()
	{
		$info = array();
		$info['name'] = _AEC_MI_NAME_AECMODIFYEXPIRATION;
		$info['desc'] = _AEC_MI_DESC_AECMODIFYEXPIRATION;

		return $info;
	}

	function Settings()
	{
		$settings = array();
		$settings['time_mod']		= array('inputA');
		$settings['timestamp']		= array('inputA');

		$rewriteswitches			= array( 'cms', 'user', 'expiration', 'subscription', 'plan', 'invoice' );
		$settings['rewriteInfo']	= array( 'fieldset', _AEC_MI_SET11_EMAIL, AECToolbox::rewriteEngineInfo( $rewriteswitches ) );

		return $settings;
	}


	function action( $request )
	{
		$database = &JFactory::getDBO();

		if ( empty( $this->settings['timestamp'] ) && empty( $this->settings['time_mod'] ) ) {
			return true;
		}

		if ( empty( $this->settings['timestamp'] ) ) {
			$tstamp = time();
		} else {
			$tstamp = strtotime( AECToolbox::rewriteEngineRQ( $this->settings['timestamp'], $request ) );
		}

		$new_expiration = strtotime( $this->settings['time_mod'], $tstamp );

		$request->metaUser->focusSubscription->expiration = date( 'Y-m-d H:i:s', $new_expiration );

		return true;
	}

}

?>