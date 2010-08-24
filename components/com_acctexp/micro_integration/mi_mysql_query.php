<?php
/**
 * @version $Id: mi_mysql_query.php
 * @package AEC - Account Control Expiration - Membership Manager
 * @subpackage Micro Integrations - MySQL Query
 * @copyright 2006-2008 Copyright (C) David Deutsch
 * @author David Deutsch <skore@skore.de> & Team AEC - http://www.valanx.org
 * @license GNU/GPL v.2 http://www.gnu.org/licenses/old-licenses/gpl-2.0.html or, at your option, any later version
 */

// Dont allow direct linking
( defined('_JEXEC') || defined( '_VALID_MOS' ) ) or die( 'Direct Access to this location is not allowed.' );

class mi_mysql_query
{
	function Info()
	{
		$info = array();
		$info['name'] = _AEC_MI_NAME_MYSQL;
		$info['desc'] = _AEC_MI_DESC_MYSQL;

		return $info;
	}

	function Settings()
	{
        $settings = array();
        $settings['query']			= array( 'inputD' );
        $settings['query_exp']		= array( 'inputD' );
        $settings['query_pre_exp']	= array( 'inputD' );

		$rewriteswitches			= array( 'cms', 'user', 'expiration', 'subscription', 'plan', 'invoice' );
		$settings['rewriteInfo']	= array( 'fieldset', _AEC_MI_SET4_MYSQL, AECToolbox::rewriteEngineInfo( $rewriteswitches ) );

		return $settings;
	}

	function relayAction( $request )
	{
		if ( isset( $this->settings['query'.$request->area] ) ) {
			$database = &JFactory::getDBO();

			$query = AECToolbox::rewriteEngineRQ( $this->settings['query'.$request->area], $request );

			$database->setQuery( $query );
			if ( aecJoomla15check() ) {
				if ( !$database->queryBatch( false ) ) {
					$this->error = "MYSQL ERROR: " . $database->stderr();
				}
			} else {
				if ( !$database->query_batch( false ) ) {
					$this->error = "MYSQL ERROR: " . $database->stderr();
				}
			}
		}

		return true;
	}

}
?>
