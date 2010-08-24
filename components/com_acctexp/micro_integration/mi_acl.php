<?php
/**
 * @version $Id: mi_acl.php
 * @package AEC - Account Control Expiration - Membership Manager
 * @subpackage Micro Integrations - ACL
 * @copyright 2006-2008 Copyright (C) David Deutsch
 * @author David Deutsch <skore@skore.de> & Team AEC - http://www.valanx.org
 * @license GNU/GPL v.2 http://www.gnu.org/licenses/old-licenses/gpl-2.0.html or, at your option, any later version
 */

// Dont allow direct linking
( defined('_JEXEC') || defined( '_VALID_MOS' ) ) or die( 'Direct Access to this location is not allowed.' );

class mi_acl
{
	function Info()
	{
		$info = array();
		$info['name'] = _AEC_MI_NAME_ACL;
		$info['desc'] = _AEC_MI_DESC_ACL;

		return $info;
	}

	function Settings()
	{
		$user = &JFactory::getUser();

		$acl = &JFactory::getACL();

		$settings = array();
		$settings['change_session']	= array( 'list_yesno' );

		$settings['set_gid']			= array( 'list_yesno' );
		$settings['gid']				= array( 'list' );
		$settings['set_gid_exp']		= array( 'list_yesno' );
		$settings['gid_exp']			= array( 'list' );
		$settings['set_gid_pre_exp']	= array( 'list_yesno' );
		$settings['gid_pre_exp']		= array( 'list' );

		$settings['jaclpluspro']		= array( 'list_yesno' );
		$settings['delete_subgroups']	= array( 'list_yesno' );

		$settings['sub_set_gid']			= array( 'list_yesno' );
		$settings['sub_gid_del']			= array( 'list' );
		$settings['sub_gid']				= array( 'list' );
		$settings['sub_set_gid_exp']		= array( 'list_yesno' );
		$settings['sub_gid_exp_del']		= array( 'list' );
		$settings['sub_gid_exp']			= array( 'list' );
		$settings['sub_set_gid_pre_exp']	= array( 'list_yesno' );
		$settings['sub_gid_pre_exp_del']	= array( 'list' );
		$settings['sub_gid_pre_exp']		= array( 'list' );

		// ensure user can't add group higher than themselves
		$my_groups = $acl->get_object_groups( 'users', $user->id, 'ARO' );
		if ( is_array( $my_groups ) && count( $my_groups ) > 0) {
			$ex_groups = $acl->get_group_children( $my_groups[0], 'ARO', 'RECURSE' );
		} else {
			$ex_groups = array();
		}

		$gtree = $acl->get_group_children_tree( null, 'USERS', false );

		$ex_groups[] = 29;
		$ex_groups[] = 30;

		// remove users 'above' me
		$i = 0;
		while ( $i < count( $gtree ) ) {
			if ( in_array( $gtree[$i]->value, $ex_groups ) ) {
				array_splice( $gtree, $i, 1 );
			} else {
				$i++;
			}
		}

		$settings['lists']['gid'] 			= mosHTML::selectList( $gtree, 'gid', 'size="6"', 'value', 'text', ( empty( $this->settings['gid'] ) ? 18 : $this->settings['gid'] ) );
		$settings['lists']['gid_exp'] 		= mosHTML::selectList( $gtree, 'gid_exp', 'size="6"', 'value', 'text', ( empty( $this->settings['gid_exp'] ) ? 18 : $this->settings['gid_exp'] ) );
		$settings['lists']['gid_pre_exp'] 	= mosHTML::selectList( $gtree, 'gid_pre_exp', 'size="6"', 'value', 'text', ( empty( $this->settings['gid_pre_exp'] ) ? 18 : $this->settings['gid_pre_exp'] ) );

		$subgroups = array( 'sub_gid_del', 'sub_gid', 'sub_gid_exp_del', 'sub_gid_exp', 'sub_gid_pre_exp_del', 'sub_gid_pre_exp' );

		foreach ( $subgroups as $groupname ) {
			$selected = array();
			if ( !empty( $this->settings[$groupname] ) ) {
				foreach ( $this->settings[$groupname] as $value ) {
					$selected[]->value = $value;
				}
			}

			$settings['lists'][$groupname] = mosHTML::selectList( $gtree, $groupname.'[]', 'size="6" multiple="multiple"', 'value', 'text', $selected );
		}

		return $settings;
	}

	function relayAction( $request )
	{
		if ( !empty( $this->settings['set_gid' . $request->area] ) ) {
			$this->instantGIDchange( $request->metaUser, 'gid' . $request->area);
		}

		if ( !empty( $this->settings['sub_set_gid' . $request->area] ) ) {
			$this->jaclplusGIDchange( $request->metaUser, 'sub_gid' . $request->area );
		}

		return true;
	}

	function instantGIDchange( $metaUser, $section )
	{
		$database = &JFactory::getDBO();

		$acl = &JFactory::getACL();

		$metaUser->instantGIDchange( $this->settings[$section], $this->settings['change_session'] );

		if ( $this->settings['jaclpluspro'] ) {
			$gid_name = $acl->get_group_name( $this->settings[$section], 'ARO' );

			// Check for main entry
			$query = 'SELECT `group_id`'
					. ' FROM #__jaclplus_user_group'
					. ' WHERE `id` = \'' . (int) $metaUser->userid . '\''
					. ' AND `group_type` = \'main\''
					;
			$database->setQuery( $query );
			$groupid = $database->loadResult();

			if ( !empty( $groupid ) ) {
				$query = 'UPDATE #__jaclplus_user_group'
						. ' SET `group_id` = \'' . (int)$this->settings[$section] . '\''
						. ' WHERE `id` = \'' . (int) $metaUser->userid . '\''
						. ' AND `group_type` = \'main\''
						;
				$database->setQuery( $query );
				$database->query() or die( $database->stderr() );
			} else {
				$query = 'INSERT INTO #__jaclplus_user_group'
						. ' VALUES( \'' . (int) $metaUser->userid . '\', \'main\', \'' . (int) $this->settings[$section] . '\', \'\' )'
						;
				$database->setQuery( $query );
				$database->query() or die( $database->stderr() );
			}

			if ( $this->settings['change_session'] ) {
				$session = null;

				// Get Session
				$query = 'SELECT *'
						. ' FROM #__session'
						. ' WHERE `userid` = \'' . (int) $metaUser->userid . '\''
						;
				$database->setQuery( $query );
				if ( aecJoomla15check() ) {
					$session = $database->loadObject();
				} else {
					$database->loadObject($session);
				}

				if ( $session->userid  ) {
					$query = 'SELECT `value`'
							. ' FROM #__core_acl_aro_groups'
							. ' WHERE `id` = \'' . (int) $this->settings[$section] . '\''
							;
					$database->setQuery( $query );
					$sessiongroups = $database->loadResult();

					$data = metaUser::joomunserializesession( $session->data );
					$data['__default']['jaclplus'] = $sessiongroups;

					$query = 'UPDATE #__session'
							. ' SET `usertype` = \'' . $gid_name . '\', `gid` = \'' . $this->settings[$section] . '\','
							. ' `data` = \'' .  metaUser::joomserializesession( $data ) . '\''
							. ' WHERE `userid` = \'' . (int) $metaUser->userid . '\''
							;
					$database->setQuery( $query );
					$database->query() or die( $database->stderr() );
				}
			}
		}

		return true;
	}

	function jaclplusGIDchange( $metaUser, $section )
	{
		$database = &JFactory::getDBO();

		$acl = &JFactory::getACL();

		if ( $this->settings['delete_subgroups'] ) {
			// Delete sub entries
			$query = 'DELETE FROM #__jaclplus_user_group'
					. ' WHERE `id` = \'' . (int) $metaUser->userid . '\''
					. ' AND `group_type` = \'sub\''
					;
			$database->setQuery( $query );
			$database->query();

			$groups = array();
		} else {
			// Check for sub entries
			$query = 'SELECT `group_id`'
					. ' FROM #__jaclplus_user_group'
					. ' WHERE `id` = \'' . (int) $metaUser->userid . '\''
					. ' AND `group_type` = \'sub\''
					;
			$database->setQuery( $query );
			$groups = $database->loadResultArray();
		}

		if ( !empty( $this->settings[$section.'_del'] ) ) {
			foreach ( $this->settings[$section.'_del'] as $gid ) {
				if ( in_array( $gid, $groups ) ) {
					$query = 'DELETE FROM #__jaclplus_user_group'
							. ' WHERE `id` = \'' . (int) $metaUser->userid . '\''
							. ' AND `group_type` = \'sub\''
							. ' AND `group_id` = \'' . (int) $gid . '\''
							;
					$database->setQuery( $query );
					$database->query() or die( $database->stderr() );
				}


			}
		}

		if ( !empty( $this->settings[$section] ) ) {
			foreach ( $this->settings[$section] as $gid ) {
				if ( !in_array( $gid, $groups ) ) {
					$query = 'INSERT INTO #__jaclplus_user_group'
							. ' VALUES( \'' . (int) $metaUser->userid . '\', \'sub\', \'' . $gid . '\', \'\' )'
							;
					$database->setQuery( $query );
					$database->query() or die( $database->stderr() );
				}
			}
		}

		return true;
	}

}
?>
