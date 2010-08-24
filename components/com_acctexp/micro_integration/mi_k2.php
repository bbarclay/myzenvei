<?php
/**
 * @version $Id: mi_k2.php
 * @package AEC - Account Control Expiration - Membership Manager
 * @subpackage Micro Integrations - K2
 * @copyright 2006-2008 Copyright (C) David Deutsch
 * @author David Deutsch <skore@skore.de> & Team AEC - http://www.valanx.org
 * @license GNU/GPL v.2 http://www.gnu.org/licenses/old-licenses/gpl-2.0.html or, at your option, any later version
 */

// Dont allow direct linking
( defined('_JEXEC') || defined( '_VALID_MOS' ) ) or die( 'Direct Access to this location is not allowed.' );

class mi_k2
{
	function Info()
	{
		$info = array();
		$info['name'] = _AEC_MI_NAME_K2;
		$info['desc'] = _AEC_MI_DESC_K2;

		return $info;
	}

	function Settings()
	{
		$database = &JFactory::getDBO();

        $settings = array();
		$settings['set_group']		= array( 'list_yesno' );
		$settings['group']			= array( 'list' );
		$settings['set_group_exp']	= array( 'list_yesno' );
		$settings['group_exp']		= array( 'list' );
		$settings['rebuild']		= array( 'list_yesno' );
		$settings['remove']			= array( 'list_yesno' );

		$query = 'SHOW COLUMNS FROM #__k2_user_groups'
				. ' LIKE \'groups_id\''
				;

		$database->setQuery( $query );
		$result = $database->loadResult();

		$query = 'SELECT ' . ( $result ? 'groups_id' : 'id'  ) . ', name'
			 	. ' FROM #__k2_user_groups'
			 	;
	 	$database->setQuery( $query );
	 	$groups = $database->loadObjectList();

		$sg = array();
		$sge = array();

		$gr = array();
		if ( !empty( $groups ) ) {
			foreach( $groups as $group ) {
				if ( isset( $group->id ) ) {
					$gid = $group->id;
				} else {
					$gid = $group->groups_id;
				}

				$gr[] = mosHTML::makeOption( $gid, $group->name );

				if ( !empty( $this->settings['group'] ) ) {
					if ( $gid == $this->settings['group'] ) {
						$sg[] = mosHTML::makeOption( $gid, $group->name );
					}
				}

				if ( !empty( $this->settings['group_exp'] ) ) {
					if ( $gid == $this->settings['group_exp'] ) {
						$sge[] = mosHTML::makeOption( $gid, $group->name );
					}
				}
			}
		}

		$settings['lists']['group']			= mosHTML::selectList( $gr, 'group', 'size="4"', 'value', 'text', $sg );
		$settings['lists']['group_exp'] 	= mosHTML::selectList( $gr, 'group_exp', 'size="4"', 'value', 'text', $sge );

		return $settings;
	}

	function expiration_action( $request )
	{
		$database = &JFactory::getDBO();

		if ( $this->settings['set_group_exp'] && !empty( $this->settings['group_exp'] ) ) {
			$this->AddUserToGroup( $request->metaUser, $this->settings['group_exp'] );
		}

		return true;
	}

	function action( $request )
	{
		$database = &JFactory::getDBO();

		if ( $this->settings['set_group'] && !empty( $this->settings['group'] ) ) {
			$this->AddUserToGroup( $request->metaUser, $this->settings['group'] );
		}

		return true;
	}

	function AddUserToGroup( $metaUser, $groupid )
	{
		$database = &JFactory::getDBO();

		$query = 'SELECT id FROM #__k2_users'
			. ' WHERE `userID` = \'' . $metaUser->userid . '\''
			;
		$database->setQuery( $query );
		$id = $database->loadResult();

		if ( empty( $id ) ) {
			$query = 'INSERT INTO #__k2_users'
				. ' (`userID`, `userName`, `group` )'
				. ' VALUES ( \'' . $metaUser->userid . '\', \'' . $metaUser->cmsUser->username . '\', \'' . $groupid . '\' )'
				;
			$database->setQuery( $query );
			$database->query();
		} else {
			$query = 'UPDATE #__k2_users'
				. ' SET `group` = \'' . $groupid . '\''
				. ' WHERE `userID` = \'' . $metaUser->userid . '\''
				;
			$database->setQuery( $query );
			$database->query();
		}

		return true;
	}

}

?>
