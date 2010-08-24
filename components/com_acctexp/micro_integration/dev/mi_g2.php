<?php
/**
 * @version $Id: mi_g2.php
 * @package AEC - Account Control Expiration - Membership Manager
 * @subpackage Micro Integrations - G2
 * @copyright 2006-2008 Copyright (C) David Deutsch
 * @author David Deutsch <skore@skore.de> & Team AEC - http://www.valanx.org
 * @license GNU/GPL v.2 http://www.gnu.org/licenses/old-licenses/gpl-2.0.html or, at your option, any later version
 */

// Dont allow direct linking
( defined('_JEXEC') || defined( '_VALID_MOS' ) ) or die( 'Direct Access to this location is not allowed.' );

class mi_g2 extends MI
{
	function Info()
	{
		$info = array();
		$info['name'] = _AEC_MI_NAME_G2;
		$info['desc'] = _AEC_MI_DESC_G2;

		return $info;
	}

	function Settings()
	{
		$database = &JFactory::getDBO();

		$settings = array();
		$settings['gallery2path']		= array( 'inputD' );
		$settings['set_groups']			= array( 'list_yesno' );
		$settings['groups']				= array( 'list' );
		$settings['set_groups_user']	= array( 'list_yesno' );
		$settings['groups_sel_amt']		= array( 'inputA' );
		$settings['groups_sel_scope']	= array( 'list' );
		$settings['del_groups_exp']		= array( 'list_yesno' );
		$settings['create_albums']		= array( 'list_yesno' );
		$settings['albums_name']		= array( 'inputC' );

		$query = 'SELECT `g_id`, `g_groupType`, `g_groupName`'
			 	. ' FROM g2_Group'
			 	;
	 	$database->setQuery( $query );
	 	$groups = $database->loadObjectList();

		$sg = array();
		$sgs = array();

		$gr = array();
		foreach( $groups as $group ) {
			$desc = $group->g_groupName . '' . substr( strip_tags( "" ), 0, 30 );

			$gr[] = mosHTML::makeOption( $group->g_id, $desc );

			if ( !empty( $this->settings['groups'] ) ) {
				if ( in_array( $group->g_id, $this->settings['groups'] ) ) {
					$sg[] = mosHTML::makeOption( $group->g_id, $desc );
				}
			}

			if ( !empty( $this->settings['groups_sel_scope'] ) ) {
				if ( in_array( $group->g_id, $this->settings['groups_sel_scope'] ) ) {
					$sgs[] = mosHTML::makeOption( $group->g_id, $desc );
				}
			}
		}

		$settings['groups']				= array( 'list' );
		$settings['lists']['groups']	= mosHTML::selectList( $gr, 'groups[]', 'size="6" multiple="multiple"', 'value', 'text', $sg );
		$settings['groups_sel_scope']			= array( 'list' );
		$settings['lists']['groups_sel_scope']	= mosHTML::selectList( $gr, 'groups_sel_scope[]', 'size="6" multiple="multiple"', 'value', 'text', $sgs );

		return $settings;
	}

	function getMIform( $request )
	{
		$database = &JFactory::getDBO();

		$settings = array();

		if ( $this->settings['set_groups_user'] ) {
			$query = 'SELECT `g_id`, `g_groupType`, `g_groupName`'
				 	. ' FROM g2_Group'
				 	. ' WHERE `g_id` IN (' . implode( ',', $this->settings['groups_sel_scope'] ) . ')'
				 	;
		 	$database->setQuery( $query );
		 	$groups = $database->loadObjectList();

			$gr = array();
			foreach ( $groups as $group ) {
				$desc = $group->g_groupName . '' . substr( strip_tags( "" ), 0, 30 );

				$gr[] = mosHTML::makeOption( $group->g_id, $desc );
			}

			for ( $i=0; $i<$this->settings['groups_sel_amt']; $i++ ) {
				$settings['g2group_'.$i]			= array( 'list', _MI_MI_G2_USERSELECT_GROUP_NAME, _MI_MI_G2_USERSELECT_GROUP_DESC );
				$settings['lists']['g2group_'.$i]	= mosHTML::selectList( $gr, 'g2group_'.$i, 'size="6"', 'value', 'text', '' );
			}
		} else {
			return false;
		}

		return $settings;
	}

	function action( $request )
	{
		$database = &JFactory::getDBO();

		$this->loadG2Embed();

		$g2userid = $this->catchG2userid( $request->metaUser );

		$groups = array();

		if ( $this->settings['set_groups'] ) {
			$g = $this->settings['groups'];
			foreach ( $g as $groupid ) {
				$this->mapUserToGroup( $g2userid, $groupid );
				$groups[] = $groupid;
			}
		}

		if ( $this->settings['set_groups_user'] ) {
			for ( $i=0; $i<$this->settings['groups_sel_amt']; $i++ ) {
				if ( isset( $request->params['g2group_'.$i] ) ) {
					$this->mapUserToGroup( $g2userid, $request->params['g2group_'.$i] );
					$groups[] = $request->params['g2group_'.$i];
				}
			}
		}

		if ( !empty( $groups ) && !empty( $this->settings['create_albums'] ) && !empty( $this->settings['albums_name'] ) ) {
			array_unique( $groups );

			foreach ( $groups as $groupid ) {
				$query = 'SELECT `g_groupName`'
					 	. ' FROM g2_Group'
					 	. ' WHERE `g_id` = \'' . $groupid . '\''
					 	;
			 	$database->setQuery( $query );
			 	$groupname = $database->loadResult();

				if ( empty( $groupname ) ) {
					continue;
				}

				$query = 'SELECT `g_id`'
					 	. ' FROM g2_Item'
					 	. ' WHERE `g_title` = \'' . $groupname . '\''
					 	;
			 	$database->setQuery( $query );
			 	$parent = $database->loadResult();

				if ( empty( $parent ) ) {
					continue;
				}

				$this->createAlbumInAlbum( $g2userid, $parent, AECToolbox::rewriteEngineRQ( $this->settings['albums_name'], $request ) );
			}
		}

		return null;
	}

	function loadG2Embed()
	{
		if ( !empty( $this->settings['gallery2path'] ) ) {
			include_once( $this->settings['gallery2path'] . '/embed.php' );
			include_once( $this->settings['gallery2path'] . '/modules/core/classes/GalleryCoreApi.class' );
		}
	}

	function mapUserToGroup( $g2userid, $groupid )
	{
		$database = &JFactory::getDBO();

		$query = 'SELECT g_userId'
				. ' FROM g2_UserGroupMap'
				. ' WHERE `g_userId` = \'' . $g2userid . '\' AND `g_groupId` = \'' . $groupid . '\''
				;
		$database->setQuery( $query );

		if ( !$database->loadResult() ) {
			list ($ret, $group) = GalleryCoreApi::addUserToGroup( $g2userid, $groupid );
			if ($ret) {
				$this->setError( $ret->_errorMessage );
				return false;
			}
		} else {
			return null;
		}
	}

	function createAlbumInAlbum( $g2userid, $parentid, $albumname )
	{
		$database = &JFactory::getDBO();

		// Check that we don't create a duplicate
		$query = 'SELECT g_id'
				. ' FROM g2_Item'
				. ' WHERE `g_ownerId` = \'' . $g2userid . '\''
				. ' AND `g_title` = \'' . $albumname . '\''
				;
		$database->setQuery( $query );
		$eid = $database->loadResult();

		if ( $eid ) {
			$query = 'SELECT g_parentId'
					. ' FROM g2_ChildEntity'
					. ' WHERE `g_id` = \'' . $eid . '\''
					;
			$database->setQuery( $query );
			$pid = $database->loadResult();

			if ( $pid == $parentid ) {
				return null;
			}
		}

		// Fallback sanity check in case the user has renamed the albums
		$query = 'SELECT count(*)'
				. ' FROM g2_Item'
				. ' WHERE `g_ownerId` = \'' . $g2userid . '\''
				;
		$database->setQuery( $query );
		$entries = $database->loadResult();

		if ( $entries >= $this->settings['groups_sel_amt'] ) {
			return null;
		}

		list ($ret, $group) = GalleryCoreApi::createAlbum( $parentid, $albumname, $albumname, '', '', ''  );
		if ($ret) {
			$this->setError( $ret->_errorMessage );
			return false;
		}

		return true;
	}

	function deleteUserFromGroup( $g2userid, $groupid )
	{
		$database = &JFactory::getDBO();

		$query = 'DELETE FROM g2_UserGroupMap'
				. ' WHERE `g_userId` = \'' . $g2userid . '\' AND `g_groupId` = \'' . $groupid . '\''
				;
		$database->setQuery( $query );

		if ( $database->query() ) {
			return true;
		} else {
			$this->setError( $database->getErrorMsg() );
			return false;
		}
	}

	function catchG2userid( $metaUser )
	{
		$g2id = $this->hasG2userid( $metaUser );

		if ( $g2id ) {
			// User found, return id
			return $g2id;
		} else {
			// User not found, create user, then recurse
			return $this->createG2User( $metaUser );
		}
	}

	function hasG2userid( $metaUser )
	{
		$database = &JFactory::getDBO();

		$query = 'SELECT g_id'
				. ' FROM g2_User'
				. ' WHERE `g_userName` = \'' . $metaUser->cmsUser->username . '\''
				;
		$database->setQuery( $query );

		return $database->loadResult();
	}

	function createG2User( $metaUser )
	{
		$database = &JFactory::getDBO();

		$query = 'SELECT max(g_id)'
				. ' FROM g2_Entity'
				;
		$database->setQuery( $query );

		$userid = $database->loadResult() + 1;

		$args = array();
		$args['username']		= $metaUser->cmsUser->username;
		$args['fullname']		= $metaUser->cmsUser->name;
		$args['hashedpassword']	= $metaUser->cmsUser->password;
		$args['email']			= $metaUser->cmsUser->email;

		list ($ret, $group) = GalleryEmbed::createUser( $metaUser->cmsUser->id, $args );
		if ($ret) {
			$this->setError( $ret->_errorMessage );
			return false;
		}

		// Add to standard groups
		$this->mapUserToGroup( $userid, 2 );
		$this->mapUserToGroup( $userid, 4 );

		if ( $database->query() ) {
			return $userid;
		} else {
			$this->setError( $database->getErrorMsg() );
			return false;
		}
	}

}

?>
