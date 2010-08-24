<?php
/**
 * @version $Id: mi_docman.php
 * @package AEC - Account Control Expiration - Membership Manager
 * @subpackage Micro Integrations - DocMan
 * @copyright 2006-2008 Copyright (C) David Deutsch
 * @author David Deutsch <skore@skore.de> & Team AEC - http://www.valanx.org
 * @license GNU/GPL v.2 http://www.gnu.org/licenses/old-licenses/gpl-2.0.html or, at your option, any later version
 */

// Dont allow direct linking
( defined('_JEXEC') || defined( '_VALID_MOS' ) ) or die( 'Direct Access to this location is not allowed.' );

class mi_docman
{
	function Info()
	{
		$info = array();
		$info['name'] = _AEC_MI_NAME_DOCMAN;
		$info['desc'] = _AEC_MI_DESC_DOCMAN;

		return $info;
	}

	function checkInstallation()
	{
		$database = &JFactory::getDBO();

		global $mainframe;

		$tables	= array();
		$tables	= $database->getTableList();

		return in_array( $mainframe->getCfg( 'dbprefix' ) . 'acctexp_mi_docman', $tables );
	}

	function detect_application()
	{
		return is_dir( JPATH_SITE . '/components/com_docman' );
	}

	function install()
	{
		$database = &JFactory::getDBO();

		$query = 'CREATE TABLE IF NOT EXISTS `#__acctexp_mi_docman` ('
					. '`id` int(11) NOT NULL auto_increment,'
					. '`userid` int(11) NOT NULL,'
					. '`active` int(4) NOT NULL default \'1\','
					. '`granted_downloads` int(11) NULL,'
					. '`unlimited_downloads` int(3) NULL,'
					. '`used_downloads` int(11) NULL,'
					. '`params` text NULL,'
					. ' PRIMARY KEY (`id`)'
					. ')'
					;
		$database->setQuery( $query );
		$database->query();
		return;
	}

	function Settings()
	{
		$database = &JFactory::getDBO();

        $settings = array();
		$settings['add_downloads']	= array( 'inputA' );
		$settings['set_downloads']	= array( 'inputA' );
		$settings['set_unlimited']	= array( 'list_yesno' );

		$settings['set_group']		= array( 'list_yesno' );
		$settings['group']			= array( 'list' );
		$settings['set_group_exp']	= array( 'list_yesno' );
		$settings['group_exp']		= array( 'list' );
		$settings['delete_on_exp'] 	= array( 'list' );
		$settings['unset_unlimited']	= array( 'list_yesno' );
		$settings['rebuild']		= array( 'list_yesno' );
		$settings['remove']			= array( 'list_yesno' );

		$query = 'SELECT groups_id, groups_name, groups_description'
			 	. ' FROM #__docman_groups'
			 	;
	 	$database->setQuery( $query );
	 	$groups = $database->loadObjectList();

		$sg = array();
		$sge = array();

		$gr = array();
		if ( !empty( $groups ) ) {
			foreach( $groups as $group ) {
				$desc = $group->groups_name . ' - ' . substr( strip_tags( $group->groups_description ), 0, 30 );

				$gr[] = mosHTML::makeOption( $group->groups_id, $desc );

				if ( !empty( $this->settings['group'] ) ) {
					if ( in_array( $group->groups_id, $this->settings['group'] ) ) {
						$sg[] = mosHTML::makeOption( $group->groups_id, $desc );
					}
				}

				if ( !empty( $this->settings['group_exp'] ) ) {
					if ( in_array( $group->groups_id, $this->settings['group_exp'] ) ) {
						$sge[] = mosHTML::makeOption( $group->groups_id, $desc );
					}
				}
			}
		}

 		$del_opts = array();
		$del_opts[] = mosHTML::makeOption ( "No", "Just apply group below." ); // Should probably be langauge file defined?
		$del_opts[] = mosHTML::makeOption ( "All", "Delete ALL, then apply group below." );
		$del_opts[] = mosHTML::makeOption ( "Set", "Delete Group Set on Application, then apply group below." );

		$settings['lists']['group']			= mosHTML::selectList( $gr, 'group[]', 'size="4" multiple="multiple"', 'value', 'text', $sg );
		$settings['lists']['group_exp'] 	= mosHTML::selectList( $gr, 'group_exp[]', 'size="4" multiple="multiple"', 'value', 'text', $sge );

		if ( !empty( $this->settings['delete_on_exp'] ) ) {
			$dee = $this->settings['delete_on_exp'];
		} else {
			$dee = array();
		}

		$settings['lists']['delete_on_exp']	= mosHTML::selectList( $del_opts, 'delete_on_exp', 'size="3"', 'value', 'text', $dee );

		return $settings;
	}

	function profile_info( $request )
	{
		$database = &JFactory::getDBO();
		$mi_docmanhandler = new docman_restriction( $database );
		$id = $mi_docmanhandler->getIDbyUserID( $request->metaUser->userid );

		if ( $id ) {
			$mi_docmanhandler->load( $id );
			if ( $mi_docmanhandler->active ) {
				$left = $mi_docmanhandler->getDownloadsLeft();
				if ( !$mi_docmanhandler->used_downloads) {
					$used = 0 ;
				} else {
					$used = $mi_docmanhandler->used_downloads;
				}
				$unlimited = $mi_docmanhandler->unlimited_downloads;
				$message = '<p>'.sprintf(_AEC_MI_DIV1_DOCMAN_USED, $used).'</p>';
				if ( $unlimited > 0 ) {
					$message .='<p>' . sprintf( _AEC_MI_DIV1_DOCMAN_REMAINING, _AEC_MI_DIV1_DOCMAN_UNLIMITED ) . '</p>';
				} else {
					$message .= '<p>' . sprintf( _AEC_MI_DIV1_DOCMAN_REMAINING, $left ) . '</p>';
				}
				return $message;
			}
		} else {
			return '';
		}
	}

	function hacks()
	{
		$hacks = array();

		$downloadhack =	'// AEC HACK docmandownloadphp START' . "\n"
		. ( aecJoomla15check() ? '$user =& JFactory::getUser();' : 'global $my, $mosConfig_absolute_path;' ) . "\n"
		. 'include_once( ' . ( aecJoomla15check() ? 'JPATH_SITE' : '$mosConfig_absolute_path' ) . ' . \'/components/com_acctexp/acctexp.class.php\' );' . "\n"
		. 'include_once( ' . ( aecJoomla15check() ? 'JPATH_SITE' : '$mosConfig_absolute_path' ) . ' . \'/components/com_acctexp/micro_integration/mi_docman.php\');' . "\n\n"
		. '$restrictionhandler = new docman_restriction( $database );' . "\n"
		. '$restrict_id = $restrictionhandler->getIDbyUserID( ' . ( aecJoomla15check() ? '$user->id' : '$my->id' ) . ' );' . "\n"
		. '$restrictionhandler->load( $restrict_id );' . "\n\n"
		. 'if (!$restrictionhandler->hasDownloadsLeft()) {' . "\n"
		. "\t" . '$restrictionhandler->noDownloadsLeft();' . "\n"
		. '} else {' . "\n"
		. "\t" . '$restrictionhandler->useDownload();' . "\n"
		. '}' . "\n"
		. '// AEC HACK docmandownloadphp END' . "\n"
		;

		$n = 'docmandownloadphp';
		$hacks[$n]['name']				=	'download.php';
		$hacks[$n]['desc']				=	_AEC_MI_HACK1_DOCMAN;
		$hacks[$n]['type']				=	'file';
		$hacks[$n]['filename']			=	JPATH_SITE . '/components/com_docman/includes_frontend/download.php';
		$hacks[$n]['read']				=	'// If the remote host is not allowed';
		$hacks[$n]['insert']			=	$downloadhack . "\n"  . $hacks[$n]['read'];

		return $hacks;
	}

	function expiration_action( $request )
	{
		$database = &JFactory::getDBO();

 		if ( $this->settings['delete_on_exp']=="Set" ) {
			$this->DeleteUserFromGroup( $request->metaUser->userid, $this->settings['group'] );
		}

		if ( $this->settings['delete_on_exp']=="All" ) {
			$groups = $this->GetUserGroups( $request->metaUser->userid );
			foreach ($groups as $group) {
				$this->DeleteUserFromGroup( $request->metaUser->userid, $group );
			}
		}

		if ( $this->settings['set_group_exp'] && !empty( $this->settings['group_exp'] ) ) {
			foreach ( $this->settings['group_exp'] as $group ) {
				$this->AddUserToGroup( $request->metaUser->userid, $group );
			}
		}


		$mi_docmanhandler = new docman_restriction( $database );
		$id = $mi_docmanhandler->getIDbyUserID( $request->metaUser->userid );
		$mi_id = $id ? $id : 0;
		$mi_docmanhandler->load( $mi_id );


		if ( $mi_id ) {
			if ( $this->settings['unset_unlimited'] ) {
				$mi_docmanhandler->unlimited_downloads = 0 ;
			}
			$mi_docmanhandler->active = 0;
			$mi_docmanhandler->check();
			$mi_docmanhandler->store();
		}

		return true;
	}

	function action( $request )
	{
		$database = &JFactory::getDBO();

		if ( $this->settings['set_group'] && !empty( $this->settings['group'] ) ) {
			foreach ( $this->settings['group'] as $group ) {
				$this->AddUserToGroup( $request->metaUser->userid, $group );
			}
		}

		$mi_docmanhandler = new docman_restriction( $database );
		$id = $mi_docmanhandler->getIDbyUserID( $request->metaUser->userid );
		$mi_id = $id ? $id : 0;
		$mi_docmanhandler->load( $mi_id );

		if ( !$mi_id ) {
			$mi_docmanhandler->userid = $request->metaUser->userid;
		}

		$mi_docmanhandler->active = 1;

		if ( $this->settings['set_downloads'] ) {
			$mi_docmanhandler->setDownloads( $this->settings['set_downloads'] );
		} elseif ( $this->settings['add_downloads'] ) {
			$mi_docmanhandler->addDownloads( $this->settings['add_downloads'] );
		}
		if ( $this->settings['set_unlimited'] ) {
			$mi_docmanhandler->unlimited_downloads = true ;
		}
		$mi_docmanhandler->check();
		$mi_docmanhandler->store();

		return true;
	}

	function GetUserGroups( $userid )
	{
		$database = &JFactory::getDBO();

		$query = 'SELECT `groups_id`'
				. ' FROM #__docman_groups'
				;
		$database->setQuery( $query );
		$ids = $database->loadResultArray();

		$groups = array();
		foreach ( $ids as $groupid ) {
			$query = 'SELECT `groups_members`'
					. ' FROM #__docman_groups'
					. ' WHERE `groups_id` = \'' . $groupid . '\''
					;
			$database->setQuery( $query );
			$users = explode( ',', $database->loadResult() );

			if ( in_array( $userid, $users ) ) {
				$groups[] = $groupid;
			}
		}

		return $groups;
	}

	function AddUserToGroup( $userid, $groupid )
	{
		$database = &JFactory::getDBO();

		$this->DeleteUserFromGroup( $userid, $groupid );

		$query = 'SELECT `groups_members`'
			. ' FROM #__docman_groups'
			. ' WHERE `groups_id` = \'' . $groupid . '\''
			;
		$database->setQuery( $query );
		$users = explode( ',', $database->loadResult() );

		$users[] = $userid;

		// Make sure we have no empty value
		$search = 0;
		while ( $search !== false ) {
			$search = array_search( '', $users );
			if ( $search !== false ) {
				unset( $users[$search] );
			}
		}

		$query = 'UPDATE #__docman_groups'
			. ' SET `groups_members` = \'' . implode( ',', $users ) . '\''
			. ' WHERE `groups_id` = \'' . $groupid . '\''
			;
		$database->setQuery( $query );
		$database->query();

		return true;
	}

	function DeleteUserFromGroup( $userid, $groupid )
	{
		$database = &JFactory::getDBO();

		$query = 'SELECT `groups_members`'
			. ' FROM #__docman_groups'
			. ' WHERE `groups_id` = \'' . $groupid . '\''
			;
		$database->setQuery( $query );
		$users = explode( ',', $database->loadResult() );

		if ( in_array( $userid, $users ) ) {
			$key = array_search( $userid, $users );
			unset( $users[$key] );

			// Make sure we have no empty value
			$search = 0;
			while ( $search !== false ) {
				$search = array_search( '', $users );
				if ( $search !== false ) {
					unset( $users[$search] );
				}
			}

			$query = 'UPDATE #__docman_groups'
				. ' SET `groups_members` = \'' . implode( ',', $users ) . '\''
				. ' WHERE `groups_id` = \'' . $groupid . '\''
				;
			$database->setQuery( $query );
			$database->query();

			return true;
		} else {
			return false;
		}
	}
}

class docman_restriction extends JTable {
	/** @var int Primary key */
	var $id						= null;
	/** @var int */
	var $userid 				= null;
	/** @var int */
	var $active					= null;
	/** @var int */
	var $granted_downloads		= null;
	/** @var int */
	var $unlimited_downloads	= null;
	/** @var text */
	var $used_downloads			= null;
	/** @var text */
	var $params					= null;

	function getIDbyUserID( $userid ) {
		$database = &JFactory::getDBO();

		$query = 'SELECT `id`'
			. ' FROM #__acctexp_mi_docman'
			. ' WHERE `userid` = \'' . $userid . '\''
			;
		$database->setQuery( $query );
		return $database->loadResult();
	}

	function docman_restriction( &$db ) {
		parent::__construct( '#__acctexp_mi_docman', 'id', $db );
	}

	function is_active()
	{
		if ( $this->active ) {
			return true;
		} else {
			return false;
		}
	}

	function getDownloadsLeft()
	{
		if (  $this->unlimited_downloads > 0 ) {
			return 'unlimited';
		} else {
			$downloads_left = $this->granted_downloads - $this->used_downloads;
			return $downloads_left;
		}
	}

	function hasDownloadsLeft()
	{
                $check = $this->getDownloadsLeft();

                if ( empty ( $check ) ) {
                        return false;
                } elseif  (  is_numeric ($check)  )  {
                        if ( $check > 0 ) {
                                return true;
                        } else {
                                return false;
                        }
                } elseif ( $check == "unlimited" ) {
                        return true;
                }

	}

	function noDownloadsLeft()
	{
		if ( !defined( '_AEC_LANG_INCLUDED_MI' ) ) {
			global $mainframe;

			$langPathMI = JPATH_SITE . '/components/com_acctexp/micro_integration/lang/';
			if ( file_exists( $langPathMI . $mainframe->getCfg( 'lang' ) . '.php' ) ) {
				include_once( $langPathMI . $mainframe->getCfg( 'lang' ) . '.php' );
			} else {
				include_once( $langPathMI . 'english.php' );
			}
		}

		aecRedirect( 'index.php?option=com_docman' , _AEC_MI_DOCMAN_NOCREDIT );
	}

	function useDownload()
	{
		if ( $this->hasDownloadsLeft() && $this->is_active() ) {
			$this->used_downloads++;
			$this->check();
			$this->store();
			return true;
		} else {
			return false;
		}
	}

	function setDownloads( $set )
	{
		$this->granted_downloads = $set + $this->used_downloads;
	}

	function addDownloads( $add )
	{
		$this->granted_downloads += $add;
	}
}
?>
