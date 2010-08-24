<?php
/**
 * @version $Id: mi_aecdonate.php
 * @package AEC - Account Control Expiration - Membership Manager
 * @subpackage Micro Integrations - AEC Donations
 * @copyright 2006-2008 Copyright (C) David Deutsch
 * @author David Deutsch <skore@skore.de> & Team AEC - http://www.valanx.org
 * @license GNU/GPL v.2 http://www.gnu.org/licenses/old-licenses/gpl-2.0.html or, at your option, any later version
 */

// Dont allow direct linking
( defined('_JEXEC') || defined( '_VALID_MOS' ) ) or die( 'Direct Access to this location is not allowed.' );

class mi_aecdonate
{
	function Settings()
	{
		$settings = array();

		$settings['min'] = array( 'inputB' );
		$settings['rec'] = array( 'inputB' );
		$settings['max'] = array( 'inputB' );

		return $settings;
	}

	function saveParams( $params )
	{
		foreach ( $params as $n => $v ) {
			if ( !empty( $v ) ) {
				if ( $n != 'rec' ) {
					$params[$n] = AECToolbox::correctAmount( $v );
				}
			}
		}

		return $params;
	}

	function getMIform( $request )
	{
		$settings = array();

		if ( !empty( $this->settings['rec'] ) ) {
			$settings['amt'] = array( 'inputC', _MI_MI_AECDONATE_USERSELECT_AMT_NAME, _MI_MI_AECDONATE_USERSELECT_AMT_DESC, $this->settings['rec'] );
		} else {
			$settings['amt'] = array( 'inputC', _MI_MI_AECDONATE_USERSELECT_AMT_NAME, _MI_MI_AECDONATE_USERSELECT_AMT_DESC, '' );
		}

		return $settings;
	}

	function modifyPrice( $request )
	{
		if ( !isset( $request->params['amt'] ) ) {
			return null;
		}

		$price = AECToolbox::correctAmount( $request->params['amt'] );

		if ( !empty( $this->settings['max'] ) ) {
			if ( $price > $this->settings['max'] ) {
				$price = $this->settings['max'];
			}
		}

		if ( !empty( $this->settings['min'] ) ) {
			if ( $price < $this->settings['min'] ) {
				$price = $this->settings['min'];
			}
		}

		$price = AECToolbox::correctAmount( $price );

		$request->add->terms->nextterm->setCost( $price );

		return null;
	}

}
?>
