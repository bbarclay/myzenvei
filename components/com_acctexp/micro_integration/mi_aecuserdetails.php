<?php
/**
 * @version $Id: mi_aecuserdetails.php
 * @package AEC - Account Control Expiration - Membership Manager
 * @subpackage Micro Integrations - AEC Donations
 * @copyright 2006-2008 Copyright (C) David Deutsch
 * @author David Deutsch <skore@skore.de> & Team AEC - http://www.valanx.org
 * @license GNU/GPL v.2 http://www.gnu.org/licenses/old-licenses/gpl-2.0.html or, at your option, any later version
 */

// Dont allow direct linking
( defined('_JEXEC') || defined( '_VALID_MOS' ) ) or die( 'Direct Access to this location is not allowed.' );

class mi_aecuserdetails
{
	function Info()
	{
		$info = array();
		$info['name'] = _AEC_MI_NAME_AECUSERDETAILS;
		$info['desc'] = _AEC_MI_DESC_AECUSERDETAILS;

		return $info;
	}

	function Settings()
	{
		$database = &JFactory::getDBO();

		$settings = array();
		$settings['lists']		= array();
		$settings['settings']	= array( 'inputB' );

		$types = array( "inputA", "inputB", "inputC", "inputD", "list_language", "checkbox" );

 		$typelist = array();
 		foreach ( $types as $type ) {
 			$typelist[] = mosHTML::makeOption ( $type, $type );
 		}

		if ( !empty( $this->settings['settings'] ) ) {
			for ( $i=0; $i<$this->settings['settings']; $i++ ) {
				$p = $i . '_';

				$settings['lists'][$p.'type']	= mosHTML::selectList( $typelist, $p.'type', 'size="' . max( 10, min( 20, count( $types ) ) ) . '"', 'value', 'text', $this->settings[$p.'type'] );

				$settings[$p.'short']		= array( 'inputC', sprintf( _MI_MI_AECUSERDETAILS_SET_SHORT_NAME, $i+1 ), _MI_MI_AECUSERDETAILS_SET_SHORT_DESC );
				$settings[$p.'mandatory']	= array( 'list_yesno', sprintf( _MI_MI_AECUSERDETAILS_SET_MANDATORY_NAME, $i+1 ), _MI_MI_AECUSERDETAILS_SET_MANDATORY_DESC );
				$settings[$p.'name']		= array( 'inputC', sprintf( _MI_MI_AECUSERDETAILS_SET_NAME_NAME, $i+1 ), _MI_MI_AECUSERDETAILS_SET_NAME_DESC );
				$settings[$p.'desc']		= array( 'inputC', sprintf( _MI_MI_AECUSERDETAILS_SET_DESC_NAME, $i+1 ), _MI_MI_AECUSERDETAILS_SET_DESC_DESC );
				$settings[$p.'type']		= array( 'list', sprintf( _MI_MI_AECUSERDETAILS_SET_TYPE_NAME, $i+1 ), _MI_MI_AECUSERDETAILS_SET_TYPE_DESC );
				$settings[$p.'default']		= array( 'inputC', sprintf( _MI_MI_AECUSERDETAILS_SET_DEFAULT_NAME, $i+1 ), _MI_MI_AECUSERDETAILS_SET_DEFAULT_DESC );
			}
		}

		return $settings;
	}

	function saveParams( $params )
	{
		foreach ( $params as $n => $v ) {
			if ( !empty( $v ) && ( strpos( $n, '_short' ) ) ) {
				$params[$n] = preg_replace( '/[^a-z0-9._+-]+/i', '', trim( $v ) );
			}
		}

		return $params;
	}

	function verifyMIform( $request )
	{
		$return = array();

		if ( !empty( $this->settings['settings'] ) ) {
			for ( $i=0; $i<$this->settings['settings']; $i++ ) {
				$p = $i . '_';

				if ( !empty( $this->settings[$p.'mandatory'] ) ) {
					if ( empty( $request->params[$p.'name'] ) ) {
						$return['error'] = "Please fill in the required fields";
					}
				}

			}
		}

		if ( !empty( $return['error'] ) ) {
			return $return;
		}

		$database = &JFactory::getDBO();

		$params = array();
		if ( !empty( $this->settings['settings'] ) ) {
			for ( $i=0; $i<$this->settings['settings']; $i++ ) {
				$p = $i . '_';

				if ( !empty( $this->settings[$p.'short'] ) ) {
					$params[$this->settings[$p.'short']] = $request->params[$this->settings[$p.'short']];
				}
			}
		}

		$request->metaUser->meta->addCustomParams( $params );
		$request->metaUser->meta->storeload();

		return $return;
	}

	function getMIform( $request )
	{
		$language_array = AECToolbox::getISO4271_codes();

		$language_code_list = array();
		foreach ( $language_array as $language ) {
			$language_code_list[] = mosHTML::makeOption( $language, ( defined( '_AEC_LANG_' . $language  ) ? constant( '_AEC_LANG_' . $language ) : $language ) );
		}

		$settings	= array();
		$lists		= array();

		if ( !empty( $this->settings['settings'] ) ) {
			for ( $i=0; $i<$this->settings['settings']; $i++ ) {
				$p = $i . '_';

				if ( !empty( $request->params[$p.'name'] ) ) {
					$content = $request->params[$p.'name'];
				} else {
					$content = $this->settings[$p.'default'];
				}

				if ( !empty( $this->settings[$p.'short'] ) ) {
					if ( $this->settings[$p.'type'] == 'list_language' ) {
						$lists[$this->settings[$p.'short']] = mosHTML::selectList( $language_code_list, $this->settings[$p.'short'], 'size="10"', 'value', 'text', $content );

						$this->settings[$p.'type'] = 'list';
					}

					if ( ( $this->settings[$p.'type'] == 'radio' ) || ( $this->settings[$p.'type'] == 'checkbox' ) ) {
						$settings[$this->settings[$p.'short']] = array( $this->settings[$p.'type'], $this->settings[$p.'name'], null, $this->settings[$p.'desc'], $content );
					} else {
						$settings[$this->settings[$p.'short']] = array( $this->settings[$p.'type'], $this->settings[$p.'name'], $this->settings[$p.'desc'], $content );
					}
				}
			}
		}

		if ( !empty( $lists ) ) {
			$settings['lists'] = $lists;
		}

		return $settings;
	}

}
?>
