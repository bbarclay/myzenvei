<?php
/**
 * @version $Id: mi_apc.php
 * @package AEC - Account Control Expiration - Membership Manager
 * @subpackage Micro Integrations - Advanced Profile Control
 * @copyright 2006-2008 Copyright (C) David Deutsch
 * @author David Deutsch <skore@skore.de> & Team AEC - http://www.valanx.org
 * @license GNU/GPL v.2 http://www.gnu.org/licenses/old-licenses/gpl-2.0.html or, at your option, any later version
 */

( defined('_JEXEC') || defined( '_VALID_MOS' ) ) or die( 'Direct Access to this location is not allowed.' );

class mi_apc
{
	function Info()
	{
		$info = array();
		$info['name'] = _AEC_MI_NAME_APC;
		$info['desc'] = _AEC_MI_DESC_APC;

		return $info;
	}

	function Settings()
	{
		$database = &JFactory::getDBO();

		$query = 'SELECT groupid, title, description'
	 	. ' FROM #__comprofiler_accesscontrol_groups'
	 	;
	 	$database->setQuery( $query );
	 	$groups = $database->loadObjectList();

		$sg = array();
		foreach( $groups as $group ) {
			$sg[] = mosHTML::makeOption( $group->groupid, $group->title . ' - ' . substr( strip_tags( $group->description ), 0, 30 ) );
		}

        $settings = array();
		$settings['set_group']			= array( 'list_yesno' );
		$settings['set_default']		= array( 'list_yesno' );
		$settings['group']				= array( 'list' );
		$settings['set_group_exp']		= array( 'list_yesno' );
		$settings['set_default_exp']	= array( 'list_yesno' );
		$settings['group_exp']			= array( 'list' );
		$settings['rebuild']			= array( 'list_yesno' );
		$settings['remove']				= array( 'list_yesno' );

		$settings['lists']['group']		= mosHTML::selectList( $sg, 'group', 'size="4"', 'value', 'text', $this->settings['group'] );
		$settings['lists']['group_exp'] = mosHTML::selectList( $sg, 'group_exp', 'size="4"', 'value', 'text', $this->settings['group_exp'] );

		return $settings;
	}

	function expiration_action( $request )
	{
		$database = &JFactory::getDBO();

		if ( $this->settings['set_group_exp'] ) {
			return $this->setGroupId( $request->metaUser->userid, $this->settings['group_exp'], $this->settings['set_default_exp'] );
		}
	}

	function action( $request )
	{
		if ( $this->settings['set_group'] ) {
			return $this->setGroupId( $request->metaUser->userid, $this->settings['group'], $this->settings['set_default'] );
		}
	}

	function setGroupId( $userid, $groupid, $default = false )
	{
		$database = &JFactory::getDBO();

		if ( $default ) {
			$query = 'SELECT title'
		 	. ' FROM #__comprofiler_accesscontrol_groups'
		 	. ' WHERE default = \'1\''
		 	;
		 	$database->setQuery( $query );
		 	$group = $database->loadResult();
		} else {
			$query = 'SELECT title'
		 	. ' FROM #__comprofiler_accesscontrol_groups'
		 	. ' WHERE groupid = \'' . $groupid . '\''
		 	;
		 	$database->setQuery( $query );
		 	$group = $database->loadResult();
		}

		if ( !empty( $group ) ) {
			$query = 'UPDATE #__comprofiler'
					. ' SET `apc_type` = \'' . $group . '\''
					. ' WHERE `id` = \'' . (int) $this->userid . '\''
					;
			$database->setQuery( $query );
		} else {
			return false;
		}
	}
}

?>
