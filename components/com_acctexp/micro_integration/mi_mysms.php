<?php
/**
 * @version $Id: mi_mysms.php
 * @package AEC - Account Control Expiration - Membership Manager
 * @subpackage Micro Integrations - MySMS
 * @copyright 2006-2008 Copyright (C) David Deutsch
 * @author David Deutsch <skore@skore.de> & Team AEC - http://www.valanx.org
 * @license GNU/GPL v.2 http://www.gnu.org/licenses/old-licenses/gpl-2.0.html or, at your option, any later version
 */

// Dont allow direct linking
( defined('_JEXEC') || defined( '_VALID_MOS' ) ) or die( 'Direct Access to this location is not allowed.' );

class mi_mysms
{

	function Info()
	{
		$info = array();
		$info['name'] = _AEC_MI_NAME_MYSMS;
		$info['desc'] = _AEC_MI_DESC_MYSMS;

		return $info;
	}

	function Settings()
	{
		$settings = array();
		$settings['add_credits']		= array( 'inputA' );
		$settings['disable_exp']		= array( 'list_yesno' );
		return $settings;
	}

	function expiration_action( $request )
	{
		$database = &JFactory::getDBO();

		if ( !empty( $this->settings['disable_exp'] ) ) {
			// unpublish the user
			$query = 'UPDATE #__mysms_joomlauser' .
					' SET `status` = \'0\'' .
					' WHERE `userid` = \'' . $request->metaUser->userid . '\'' .
					' LIMIT 1';
			$database->setQuery( $query );
			$database->query();
		}

		return true;
	}

	function action( $request )
	{
		$database = &JFactory::getDBO();

		if ( !empty( $this->settings['add_credits'] ) ) {
			$credits = (int) $this->settings['add_credits'];

			//set the user active and the new credits
			$query = 'UPDATE #__mysms_joomlauser' .
					' SET `state` = \'1\',' .
					' `credits` = credits+' . $credits .
					' WHERE `userid` = \'' . $request->metaUser->userid . '\'' .
					' LIMIT 1';
			$database->setQuery( $query );
			$database->query();
		}

		return true;
	}
}
?>
