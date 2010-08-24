<?php
/**
 * @version $Id: mi_file.php
 * @package AEC - Account Control Expiration - Membership Manager
 * @subpackage Micro Integrations - File Manipulation
 * @copyright 2006-2008 Copyright (C) David Deutsch
 * @author David Deutsch <skore@skore.de> & Team AEC - http://www.valanx.org
 * @license GNU/GPL v.2 http://www.gnu.org/licenses/old-licenses/gpl-2.0.html or, at your option, any later version
 */

// Dont allow direct linking
( defined('_JEXEC') || defined( '_VALID_MOS' ) ) or die( 'Direct Access to this location is not allowed.' );

class mi_file extends MI
{
	function Info()
	{
		$info = array();
		$info['name'] = _AEC_MI_FILE_NAME;
		$info['desc'] = _AEC_MI_FILE_DESC;

		return $info;
	}

	function Settings()
	{
		$settings = array();
		$settings['path']			= array( 'inputE' );
		$settings['append']			= array( 'list_yesno' );
		$settings['content']		= array( 'inputD' );

		$settings = $this->autoduplicatesettings( $settings );

		$rewriteswitches			= array( 'cms', 'user', 'expiration', 'subscription', 'plan', 'invoice' );
		$settings['rewriteInfo']	= array( 'fieldset', _AEC_MI_SET4_MYSQL, AECToolbox::rewriteEngineInfo( $rewriteswitches ) );

		return $settings;
	}


	function relayAction( $request )
	{
		if ( !isset( $this->settings['path'.$request->area] ) ) {
			return null;
		}

		$database = &JFactory::getDBO();

		$rewriting = array( 'path', 'append', 'content' );

		foreach ( $rewriting as $rw_name ) {
			$this->settings[$rw_name.$request->area] = AECToolbox::rewriteEngineRQ( $this->settings[$rw_name.$request->area], $request );
		}

		$log_entry = new EventLog( $database );
		$log_entry->issue( $this->settings['short'.$request->area], $this->settings['tags'.$request->area], $this->settings['text'.$request->area], $this->settings['level'.$request->area], $this->settings['params'.$request->area], $this->settings['force_notify'.$request->area], $this->settings['force_email'.$request->area] );

		if ( $this->settings['append'.$request->area] ) {
			$file = fopen( $this->settings['path'.$request->area], "a" );
		} else {
			$file = fopen( $this->settings['path'.$request->area], "w" );
		}

		fwrite( $file, $this->settings['content'.$request->area] );

		return fclose( $file );
	}
}
?>
