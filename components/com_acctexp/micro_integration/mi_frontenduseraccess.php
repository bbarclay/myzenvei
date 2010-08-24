<?php
/*
AEC micro-integration plugin
for Frontend-User-Access
connects subscription plans to Frontend-User-Access-usergroups
version 1.0.1
*/


// Dont allow direct linking
( defined('_JEXEC') || defined( '_VALID_MOS' ) ) or die( 'Direct Access to this location is not allowed.' );

class mi_frontenduseraccess
{

	function Info()
	{
		$info = array();
		$info['name'] = _AEC_MI_NAME_FRONTENDUSERACCESS;
		$info['desc'] = _AEC_MI_DESC_FRONTENDUSERACCESS;

		return $info;
	}

	function Settings()
	{
		$database = &JFactory::getDBO();

		$query = 'SELECT `id`, `name`'
				. ' FROM #__fua_usergroups'
				. ' WHERE id <> 9 AND id <> 10'
				. ' ORDER BY name ASC'
				;
		$database->setQuery( $query );

		$groups = $database->loadObjectList();

		$fuagroups = array();
		$fuagroups[] = mosHTML::makeOption(0, 'no group');

		foreach ( $groups as $group ) {
			$fuagroups[] = mosHTML::makeOption( $group->id, $group->name );
		}

		$settings = array();

		$settings['lists']['group']		= mosHTML::selectList($fuagroups, 'group', 'size="4"', 'value', 'text', $this->settings['group']);
		$settings['lists']['group_exp'] = mosHTML::selectList($fuagroups, 'group_exp', 'size="4"', 'value', 'text', $this->settings['group_exp']);

		$settings['set_group']			= array( 'list_yesno' );
		$settings['group']				= array( 'list' );
		$settings['set_group_exp']		= array( 'list_yesno' );
		$settings['group_exp']			= array( 'list' );
		$settings['rebuild']			= array( 'list_yesno' );
		$settings['remove']				= array( 'list_yesno' );

		return $settings;
	}

	function action( $request )
	{
		if ( !empty( $this->settings['set_group'] ) && !empty( $this->settings['group'] ) ) {
			$this->update_fua_group( $request->metaUser->userid, $this->settings['group'] );
		}

		return true;
	}

	function expiration_action( $request )
	{
		if ( !empty( $this->settings['set_group_exp'] ) && !empty( $this->settings['group_exp'] ) ) {
			$this->update_fua_group( $request->metaUser->userid, $this->settings['group_exp'] );
		}

		return true;
	}

	function update_fua_group( $user_id, $fua_group )
	{
		$database = &JFactory::getDBO();

		$query = 'UPDATE #__fua_userindex'
				. ' SET `group_id` = \'' . $fua_group . '\''
				. ' WHERE `user_id` = \'' . $user_id . '\''
				;
		$database->setQuery( $query );
		$database->query();
	}

}

?>