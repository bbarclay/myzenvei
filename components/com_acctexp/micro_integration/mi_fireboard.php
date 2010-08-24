<?php
/**
 * @version $Id: mi_fireboard.php
 * @package AEC - Account Control Expiration - Membership Manager
 * @subpackage Micro Integrations - Fireboard
 * @copyright 2006-2008 Copyright (C) David Deutsch
 * @author David Deutsch <skore@skore.de> & Team AEC - http://www.valanx.org
 * @license GNU/GPL v.2 http://www.gnu.org/licenses/old-licenses/gpl-2.0.html or, at your option, any later version
 */

// Dont allow direct linking
( defined('_JEXEC') || defined( '_VALID_MOS' ) ) or die( 'Direct Access to this location is not allowed.' );

class mi_fireboard
{

	function Info()
	{
		$info = array();
		$info['name'] = _AEC_MI_NAME_FIREBOARD;
		$info['desc'] = _AEC_MI_DESC_FIREBOARD;

		return $info;
	}

	function Settings()
	{
		$database = &JFactory::getDBO();

		$query = 'SELECT `id`, `title`'
			 	. ' FROM #__fb_groups'
			 	;
	 	$database->setQuery( $query );
	 	$groups = $database->loadObjectList();

		$sg = array();
		foreach ( $groups as $group ) {
			$sg[] = mosHTML::makeOption( $group->id, $group->title );
		}

        $settings = array();

		$settings['lists']['group']		= mosHTML::selectList($sg, 'group', 'size="4"', 'value', 'text', $this->settings['group']);
		$settings['lists']['group_exp'] = mosHTML::selectList($sg, 'group_exp', 'size="4"', 'value', 'text', $this->settings['group_exp']);

		$settings['set_group']			= array( 'list_yesno' );
		$settings['group']				= array( 'list' );
		$settings['set_group_exp']		= array( 'list_yesno' );
		$settings['group_exp']			= array( 'list' );
		$settings['rebuild']			= array( 'list_yesno' );
		$settings['remove']				= array( 'list_yesno' );

		return $settings;
	}

	function detect_application()
	{
		return is_dir( JPATH_SITE . '/components/com_fireboard' );
	}

	function expiration_action( $request )
	{
		$database = &JFactory::getDBO();

		if ( $this->settings['set_group_exp'] ) {
			$query = 'UPDATE #__fb_users'
				. ' SET `group_id` = \'' . $this->settings['group_exp'] . '\''
				. ' WHERE `userid` = \'' . $request->metaUser->userid . '\''
				;
			$database->setQuery( $query );
			$database->query();
		}

		return true;
	}

	function action( $request )
	{
		$database = &JFactory::getDBO();

		if ( $this->settings['set_group'] ) {
			// Check if exists - users only appear in FB users table normally when they have posted
			$query = 'SELECT `group_id`'
					. ' FROM #__fb_users'
					. ' WHERE `userid` = \'' . $request->metaUser->userid . '\''
					;
			$database->setQuery( $query );

			// If already an entry exists -> update, if not -> create
			if ( $database->loadResult() ) {
				$query = 'UPDATE #__fb_users'
						. ' SET `group_id` = \'' . $this->settings['group'] . '\''
						. ' WHERE `userid` = \'' . $request->metaUser->userid . '\''
						;
			} else {
				$query = 'INSERT INTO #__fb_users'
						. ' ( `group_id` , `userid` )'
						. ' VALUES (\'' . $this->settings['group'] . '\', \'' . $request->metaUser->userid . '\')'
						;
			}

			// Carry out query
			$database->setQuery( $query );
			$database->query();
		}

		return true;
	}
}

?>
