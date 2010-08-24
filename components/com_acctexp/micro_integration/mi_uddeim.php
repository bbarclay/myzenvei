<?php
/**
 * @version $Id: mi_uddeim.php
 * @package AEC - Account Control Expiration - Membership Manager
 * @subpackage Micro Integrations - UddeIM
 * @copyright 2006-2008 Copyright (C) David Deutsch
 * @author David Deutsch <skore@skore.de> & Team AEC - http://www.valanx.org
 * @license GNU/GPL v.2 http://www.gnu.org/licenses/old-licenses/gpl-2.0.html or, at your option, any later version
 */

// Dont allow direct linking
( defined('_JEXEC') || defined( '_VALID_MOS' ) ) or die( 'Direct Access to this location is not allowed.' );

class mi_uddeim
{
	function Info()
	{
		$info = array();
		$info['name'] = _AEC_MI_NAME_UDDEIM;
		$info['desc'] = _AEC_MI_DESC_UDDEIM;

		return $info;
	}

	function checkInstallation()
	{
		$database = &JFactory::getDBO();

		global $mainframe;

		$tables	= array();
		$tables	= $database->getTableList();

		return in_array( $mainframe->getCfg( 'dbprefix' ) . 'acctexp_mi_uddeim', $tables );
	}

	function detect_application()
	{
		return is_dir( JPATH_SITE . '/components/com_uddeim' );
	}

	function install()
	{
		$database = &JFactory::getDBO();

		$query = 'CREATE TABLE IF NOT EXISTS `#__acctexp_mi_uddeim` ('
		. '`id` int(11) NOT NULL auto_increment,'
		. '`userid` int(11) NOT NULL,'
		. '`active` int(4) NOT NULL default \'1\','
		. '`granted_messages` int(11) NULL,'
		. '`unlimited_messages` int(3) NULL,'
		. '`used_messages` int(11) NULL,'
		. '`params` text NULL,'
		. ' PRIMARY KEY (`id`)'
		. ')'
		;
		$database->setQuery( $query );
		$database->query();
		return;
	}

	function Settings( $params )
	{
		$database = &JFactory::getDBO();

        $settings = array();
		$settings['add_messages']		= array( 'inputA' );
		$settings['set_messages']		= array( 'inputA' );
		$settings['set_unlimited']		= array( 'list_yesno' );

		$settings['unset_unlimited']	= array( 'list_yesno' );

		$settings['msg']				= array( 'list_yesno' );
		$settings['msg_sender']			= array( 'inputD' );
		$settings['msg_recipient']		= array( 'inputD' );
		$settings['msg_text']			= array( 'inputE' );
		$settings['msg_exp']			= array( 'list_yesno' );
		$settings['msg_exp_sender']		= array( 'inputD' );
		$settings['msg_exp_recipient']	= array( 'inputD' );
		$settings['msg_exp_text']		= array( 'inputE' );

		$settings['remove']				= array( 'list_yesno' );

		$rewriteswitches				= array( 'cms', 'user', 'expiration', 'subscription', 'plan', 'invoice' );
		$settings['rewriteInfo']		= array( 'fieldset', _AEC_MI_SET11_EMAIL, AECToolbox::rewriteEngineInfo( $rewriteswitches ) );

		return $settings;
	}

	function profile_info( $request )
	{
		$database = &JFactory::getDBO();
		$mi_uddeimhandler = new uddeim_restriction( $database );
		$id = $mi_uddeimhandler->getIDbyUserID( $request->metaUser->userid );

		if ( $id ) {
			$mi_uddeimhandler->load( $id );
			if ( $mi_uddeimhandler->active ) {
				$left = $mi_uddeimhandler->getMessagesLeft();
				if ( !$mi_uddeimhandler->used_messages) {
					$used = 0 ;
				} else {
					$used = $mi_uddeimhandler->used_messages;
				}
				$unlimited = $mi_uddeimhandler->unlimited_messages;
				$message = '<p>'.sprintf(_AEC_MI_DIV1_UDDEIM_USED, $used).'</p>';
				if ( $unlimited > 0 ) {
					$message .='<p>' . sprintf( _AEC_MI_DIV1_UDDEIM_REMAINING, _AEC_MI_DIV1_UDDEIM_UNLIMITED ) . '</p>';
				} else {
					$message .= '<p>' . sprintf( _AEC_MI_DIV1_UDDEIM_REMAINING, $left ) . '</p>';
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

		$messagehack =	'// AEC HACK %s START' . "\n"
		. 'global $my, JPATH_SITE;' . "\n"
		. 'include( JPATH_SITE . \'/components/com_acctexp/micro_integration/mi_uddeim.php\');' . "\n\n"
		. '$restrictionhandler = new uddeim_restriction( $database );' . "\n"
		. '$restrict_id = $restrictionhandler->getIDbyUserID( $my->id );' . "\n"
		. 'if($restrictionhandler->active){'. "\n\n"
		. '$restrictionhandler->load( $restrict_id );' . "\n\n"
		. '\tif (!$restrictionhandler->hasMessagesLeft()) {' . "\n"
		. "\t\t" . '$restrictionhandler->noMessagesLeft();' . "\n"
		. '\t}else{' . "\n"
		. "\t\t" . '$restrictionhandler->useMessage();' . "\n"
		. '\t}' . "\n"
		. '}' . "\n"
		. '// AEC HACK %s END' . "\n"
		;

		$n = 'uddeimphp';
		$hacks[$n]['name']				=	'uddeim.php';
		$hacks[$n]['desc']				=	_AEC_MI_HACK1_UDDEIM;
		$hacks[$n]['type']				=	'file';
		$hacks[$n]['filename']			=	JPATH_SITE . '/components/com_uddeim/uddeim.php';
		$hacks[$n]['read']				=	'// I could have modified this function to process mails to public users but instead of adding';
		$hacks[$n]['insert']			=	sprintf($messagehack, $n, $n) . "\n"  . $hacks[$n]['read'];

		$n = 'pmsuddeimphp';
		$hacks[$n]['name']				=	'pms.uddeim.php';
		$hacks[$n]['desc']				=	_AEC_MI_HACK2_UDDEIM;
		$hacks[$n]['type']				=	'file';
		$hacks[$n]['filename']			=	JPATH_SITE . '/components/com_comprofiler/plugin/user/plug_pmsuddeim/pms.uddeim.php';
		$hacks[$n]['read']				=	'$adminpath = $this->absolute_path."/administrator/components/com_uddeim";';
		$hacks[$n]['insert']			=	sprintf($messagehack, $n, $n) . "\n"  . $hacks[$n]['read'];

		return $hacks;
	}

	function expiration_action( $request )
	{
		if ( !empty( $this->settings['unset_unlimited'] ) ) {
			$database = &JFactory::getDBO();

			$mi_uddeimhandler = new uddeim_restriction( $database );
			$id = $mi_uddeimhandler->getIDbyUserID( $request->metaUser->userid );
			$mi_id = $id ? $id : 0;
			$mi_uddeimhandler->load( $mi_id );

			if ( $mi_id ) {
				if ( $this->settings['unset_unlimited'] ) {
					$mi_uddeimhandler->unlimited_messages = 0 ;
				}

				$mi_uddeimhandler->active = 0;
				$mi_uddeimhandler->check();
				$mi_uddeimhandler->store();
			}
		}

		if ( !empty( $this->settings['msg_exp'] ) ) {
			$this->send_message( $request, $this->settings['msg_exp_sender'], $this->settings['msg_exp_recipient'], $this->settings['msg_exp_text'] );
		}

		return true;
	}

	function action( $request )
	{
		if ( !empty( $this->settings['set_messages'] ) || !empty( $this->settings['add_messages'] ) || !empty( $this->settings['set_unlimited'] ) ) {
			$database = &JFactory::getDBO();

			$mi_uddeimhandler = new uddeim_restriction( $database );
			$id = $mi_uddeimhandler->getIDbyUserID( $request->metaUser->userid );
			$mi_id = $id ? $id : 0;
			$mi_uddeimhandler->load( $mi_id );

			if ( !$mi_id ) {
				$mi_uddeimhandler->userid = $request->metaUser->userid;
				$mi_uddeimhandler->active = 1;
			}

			if ( !empty( $this->settings['set_messages'] ) ) {
				$mi_uddeimhandler->setMessages( $this->settings['set_messages'] );
			} elseif ( !empty( $this->settings['add_messages'] ) ) {
				$mi_uddeimhandler->addMessages( $this->settings['add_messages'] );
			}

			if ( !empty( $this->settings['set_unlimited'] ) ) {
				$mi_uddeimhandler->unlimited_messages = true ;
			}

			$mi_uddeimhandler->check();
			$mi_uddeimhandler->store();
		}

		if ( !empty( $this->settings['msg'] ) ) {
			$this->send_message( $request, $this->settings['msg_sender'], $this->settings['msg_recipient'], $this->settings['msg_text'] );
		}

		return true;
	}

	function send_message( $request, $from, $to, $msg )
	{
		$database = &JFactory::getDBO();

		$f = AECToolbox::rewriteEngineRQ( $from, $request );
		$t = AECToolbox::rewriteEngineRQ( $to, $request );
		$m = AECToolbox::rewriteEngineRQ( $msg, $request );

		$query = 'INSERT INTO `jos_uddeim` (`id`, `replyid`, `fromid`, `toid`, `message`, `datum`)'
				. ' VALUES (NULL, \'0\', \'' . $f . '\', \'' . $t . '\', \'' . $m . '\', UNIX_TIMESTAMP() );';
		$database->setQuery( $query );
		$database->query();

		return true;
	}

}

class uddeim_restriction extends JTable {
	/** @var int Primary key */
	var $id						= null;
	/** @var int */
	var $userid 				= null;
	/** @var int */
	var $active					= null;
	/** @var int */
	var $granted_messages		= null;
	/** @var int */
	var $unlimited_messages	= null;
	/** @var text */
	var $used_messages			= null;
	/** @var text */
	var $params					= null;

	function getIDbyUserID( $userid ) {
		$database = &JFactory::getDBO();

		$query = 'SELECT `id`'
			. ' FROM #__acctexp_mi_uddeim'
			. ' WHERE `userid` = \'' . $userid . '\''
			;
		$database->setQuery( $query );
		return $database->loadResult();
	}

	function uddeim_restriction( &$db ) {
		parent::__construct( '#__acctexp_mi_uddeim', 'id', $db );
	}

	function is_active()
	{
		if ( $this->active ) {
			return true;
		} else {
			return false;
		}
	}

	function getMessagesLeft()
	{
		if (  $this->unlimited_messages > 0 ) {
			return 'unlimited';
		} else {
			$messages_left = $this->granted_messages - $this->used_messages;
			return $messages_left;
		}
	}

	function hasMessagesLeft()
	{
		$check = $this->getMessagesLeft();

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

	function noMessagesLeft()
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

		mosErrorAlert( _AEC_MI_UDDEIM_NOCREDIT );
	}

	function useMessage()
	{
		if ( $this->hasMessagesLeft() && $this->is_active() ) {
			$this->used_messages++;
			$this->check();
			$this->store();
			return true;
		} else {
			return false;
		}
	}

	function setMessages( $set )
	{
		$this->granted_messages = $set + $this->used_messages;
	}

	function addMessages( $add )
	{

		$this->granted_messages += $add;
	}
}
?>