<?php
/**
 * @version $Id: generic_pin.php
 * @package AEC - Account Control Expiration - Membership Manager
 * @subpackage Processors - Generic PIN
 * @copyright 2006-2009 Copyright (C) David Deutsch
 * @author David Deutsch <skore@skore.de> & Team AEC - http://www.valanx.org
 * @license GNU/GPL v.2 http://www.gnu.org/licenses/old-licenses/gpl-2.0.html or, at your option, any later version
 */

// Dont allow direct linking
( defined('_JEXEC') || defined( '_VALID_MOS' ) ) or die( 'Direct Access to this location is not allowed.' );

class processor_generic_pin extends XMLprocessor
{
	function info()
	{
		$info = array();
		$info['name']			= 'generic_pin';
		$info['longname']		= _CFG_GENERIC_PIN_LONGNAME;
		$info['statement']		= _CFG_GENERIC_PIN_STATEMENT;
		$info['description']	= _CFG_GENERIC_PIN_DESCRIPTION;
		$info['currencies']		= AECToolbox::aecCurrencyField( true, true, true, true );
		$info['cc_list']		= "";
		$info['recurring']		= 0;
		$info['actions']		= array( 'email' => array() );

		return $info;
	}

	function settings()
	{
		$settings = array();
		$settings['currency']			= '';
		$settings['pin_list_file']		= '';
		$settings['dbms']				= '';
		$settings['dbhost']				= '';
		$settings['dbuser']				= '';
		$settings['dbpasswd']			= '';
		$settings['dbname']				= '';
		$settings['table_prefix']		= '';
		$settings['table_name']			= '';

		return $settings;
	}

	function saveParams( $params )
	{
		if ( !empty( $params['table_name'] ) ) {
			$db = $this->getDB();

			$tables	= $db->getTableList();

			if ( !in_array( $params['table_prefix'] . $params['table_name'], $tables ) ) {
				$query = 'CREATE TABLE IF NOT EXISTS `' . $params['table_prefix'] . $params['table_name'] . ' ('
				. '`id` int(11) NOT NULL auto_increment,'
				. '`pin` text NULL,'
				. ' PRIMARY KEY (`id`)'
				. ')'
				;
				$db->setQuery( $query );
				$db->query();
			}
		}

		return $params;
	}

	function backend_settings()
	{
		$settings = array();
		$settings['currency']			= array( 'list_currency' );
		$settings['pin_list_file']		= array( 'inputD' );
		$settings['dbms']				= array( 'inputC' );
		$settings['dbhost']				= array( 'inputC' );
		$settings['dbuser']				= array( 'inputC' );
		$settings['dbpasswd']			= array( 'inputC' );
		$settings['dbname']				= array( 'inputC' );
		$settings['table_prefix']		= array( 'inputC' );
		$settings['table_name']			= array( 'inputC' );

 		$rewriteswitches				= array( 'cms', 'user', 'expiration', 'subscription', 'plan', 'invoice' );
		$settings						= AECToolbox::rewriteEngineInfo( $rewriteswitches, $settings );

		return $settings;
	}

	function checkoutform( $request )
	{
		$var = array();
		$var['params']['pin_code'] = array( 'inputC', _AEC_GENERIC_PIN_PARAMS_PIN_CODE_NAME, _AEC_GENERIC_PIN_PARAMS_PIN_CODE_DESC);

		return $var;
	}


	function createRequestXML( $request )
	{
		return "";
	}

	function transmitRequestXML( $content, $request )
	{
		$return['valid']	= false;
		$return['raw']		= "AEC Generic Processor Payment";
		$return['error']	= "Please provide a valid Pin Code.";

		if ( empty( $request->int_var['params']['pin_code'] ) ) {
			return $return;
		}

		if ( !empty( $request->int_var['params']['pin_code'] ) ) {
			if ( $this->usePIN( $request->int_var['params']['pin_code'] ) ) {
				unset( $return['error'] );

				$return['valid'] = true;

				$return['fullresponse'] = "Used PIN " . $request->int_var['params']['pin_code'];
			}
		}

		return $return;
	}

	function getDB()
	{
		if ( $this->settings['use_altdb'] ) {
			$options = array(	'driver'	=> $this->settings['dbms'],
								'host'		=> $this->settings['dbhost'],
								'user'		=> $this->settings['dbuser'],
								'password'	=> $this->settings['dbpasswd'],
								'database'	=> $this->settings['dbname'],
								'prefix'	=> $this->settings['table_prefix']
								);

			$database =& JDatabase::getInstance($options);
		} else {
			$database =& JFactory::getDBO();
		}

		return $database;
	}

	function usePIN( $pin )
	{
		// Look up PIN in DB
		$db = $this->getDB();

		$ps = new AECMI_pinstore( $db, $this->settings['table_name'] );

		if ( $ps->loadPin( $pin ) ) {
			return false;
		} else {
			if ( $this->FilePin( $pin ) ){
				$ps->pin = $pin;

				return $ps->storeload();
			} else {
				return false;
			}
		}
	}

	function FilePin( $pin )
	{
		if ( file_exists( $this->settings['pin_list_file'] ) ) {
			// Open File and look for pin
			$file = fopen($this->settings['pin_list_file'],"r");

			while ( $line = fgets( $file, 200 ) ) {
				if ( $line == $pin ) {
					fclose($file);
					return true;
				}
			}

			fclose($file);
			return false;
		}
	}

}

class AECMI_pinstore extends serialParamDBTable {
	/** @var int Primary key */
	var $id						= null;
	/** @var int */
	var $pin					= null;

	/**
	* @param database A database connector object
	*/
	function AECMI_pinstore( &$db, $table )
	{
		parent::__construct( '#__' . $table, 'id', $db );
	}

	function loadPin( $pin )
	{
		$query = "SELECT `id`'"
		. " FROM #__" . $this->settings['table_name']
		. " WHERE `pin` = \'' . $pin . '\'"
		;
		$db->setQuery( $query );

		return $this->load( $db->loadResult() );
	}
}

?>
