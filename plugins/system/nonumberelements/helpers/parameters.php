<?php
/**
 * NoNumber! Elements Helper File: Assignments
 *
 * @package     NoNumber! Elements
 * @version     1.2.8
 *
 * @author      Peter van Westen <peter@nonumber.nl>
 * @link        http://www.nonumber.nl
 * @copyright   Copyright (C) 2010 NoNumber! All Rights Reserved
 * @license     http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 */

// No direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

/**
* Assignments
* $assignment = no / include / exclude / none
*/

class NNePparameters
{
	function &getParameters()
	{
		static $instance;
		if ( !is_object( $instance ) ) {
			$instance = new NoNumberElementsParameters;
		}
		return $instance;
	}
}
class NoNumberElementsParameters
{
	var $_xml = array();

	function getParams( $ini, $path = '' )
	{
		$xml = $this->_getXML( $path );

		if ( !$ini ) {
			return $this->_arrayToObject( $xml );
		}

		$registry = new JRegistry();
		$registry->loadINI( $ini );
		$params = $registry->toArray();
		unset( $registry );

		if ( !empty( $xml ) ) {
			$params = array_merge( $xml, $params );
		}

		return $this->_arrayToObject( $params );
	}

	function _getXML( $path )
	{
		if ( !isset( $this->_xml[$path] ) ) {
			$this->_xml[$path] = $this->_loadXML( $path );
		}

		return $this->_xml[$path];
	}

	function _loadXML( $path )
	{
		$xml = array();
		if ( $path ) {
			$xmlparser = & JFactory::getXMLParser('Simple');
			if ( $xmlparser->loadFile( $path ) ) {
				$xml = $this->_getParamValues( $xmlparser );
			}
		}

		return $xml;
	}
	
	function _getParamValues( &$xml, $keys = array() ) {
		$params = array();
		if ( isset( $xml->document ) && isset( $xml->document->params ) ) {
			foreach ( $xml->document->params as $xml_group ) {
				foreach ( $xml_group->children() as $xml_child ) {
					$key = $xml_child->attributes('name');
					if ( !empty( $key ) && $key['0'] != '@' ) {
						if ( empty( $keys ) || in_array( $key, $keys ) ) {
							$val = $xml->get( $key );
							if ( !is_array( $val ) && !strlen( $val ) ) {
								$val = $xml_child->attributes('default');
								if ( $xml_child->attributes('type') == 'textarea' ) {
									$val = str_replace( '<br />', "\n", $val );
								}
							}
							$params[$key] = $val;
						}
					}
				}
			}
		}

		return $params;
	}
	function _arrayToObject( &$array ) {
		$obj = null;
		if ( is_array( $array ) && !empty( $array ) ) {
			foreach ( $array as $key => $val ) {
				$obj->$key = $val;
			}
		}

		return $obj;
	}

}
