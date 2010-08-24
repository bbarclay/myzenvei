<?php
/**
 * @version $Id: mi_htaccess.php
 * @package AEC - Account Control Expiration - Membership Manager
 * @subpackage Micro Integrations - .htaccess
 * @copyright 2006-2008 Copyright (C) David Deutsch
 * @author David Deutsch <skore@skore.de> & Team AEC - http://www.valanx.org
 * @license GNU/GPL v.2 http://www.gnu.org/licenses/old-licenses/gpl-2.0.html or, at your option, any later version
 */

( defined('_JEXEC') || defined( '_VALID_MOS' ) ) or die( 'Direct Access to this location is not allowed.' );

class mi_htaccess
{
	function Info()
	{
		$info = array();
		$info['name'] = _AEC_MI_NAME_HTACCESS;
		$info['desc'] = _AEC_MI_DESC_HTACCESS;

		return $info;
	}

	function mi_htaccess()
	{
		include_once( JPATH_SITE . '/components/com_acctexp/micro_integration/mi_htaccess/htaccess.class.php' );
	}

	function checkInstallation()
	{
		$database = &JFactory::getDBO();

		global $mainframe;

		$tables	= array();
		$tables	= $database->getTableList();

		return in_array( $mainframe->getCfg( 'dbprefix' ) .'_acctexp_mi_htaccess_apachepw', $tables );
	}

	function install()
	{
		$database = &JFactory::getDBO();

		$query = 'CREATE TABLE IF NOT EXISTS `#__acctexp_mi_htaccess_apachepw`'
		. ' (`id` int(11) NOT NULL auto_increment,'
		. '`userid` int(11) NOT NULL,'
		. '`apachepw` varchar(255) NOT NULL default \'1\','
		. ' PRIMARY KEY (`id`)'
		. ')'
		;
		$database->setQuery( $query );
		$database->query();
		return;
	}

	function Settings()
	{
		$settings = array();
		// field type; name; variable value, description, extra (variable name)
		$settings['mi_folder']			= array( 'inputD' );
		$settings['mi_passwordfolder']	= array( 'inputD' );
		$settings['mi_name']			= array( 'inputC' );
		$settings['use_md5']			= array( 'list_yesno' );
		$settings['use_apachemd5']		= array( 'list_yesno' );
		$settings['rebuild']			= array( 'list_yesno' );
		$settings['remove']				= array( 'list_yesno' );

		return $settings;
	}

	function saveparams( $params )
	{
		$database = &JFactory::getDBO();

		$newparams = $params;

		// Rewrite foldername to include cmsroot directory
		if ( strpos( $params['mi_folder'], "[cmsroot]" ) !== false ) {
			$newparams['mi_folder'] = str_replace("[cmsroot]", JPATH_SITE, $params['mi_folder']);
		}

		if ( strpos( $params['mi_folder'], "[abovecmsroot]" ) !== false ) {
			$newparams['mi_folder'] = str_replace("[abovecmsroot]", JPATH_SITE . "/..", $params['mi_folder']);
		}

		if ( strpos( $params['mi_passwordfolder'], "[abovecmsroot]" ) !== false ) {
			$newparams['mi_passwordfolder'] = str_replace("[abovecmsroot]", JPATH_SITE . "/..", $params['mi_passwordfolder']);
		}

		$newparams['mi_folder_fullpath']		= $newparams['mi_folder'] . "/.htaccess";
		$newparams['mi_folder_user_fullpath']	= $newparams['mi_passwordfolder'] . "/.htuser" . str_replace( "/", "_", str_replace( ".", "/", $newparams['mi_folder'] ) );

		if ( !file_exists( $newparams['mi_folder_fullpath'] ) && !$params['rebuild'] ) {
			$ht = new htaccess();
			$ht->setFPasswd( $newparams['mi_folder_user_fullpath'] );
			$ht->setFHtaccess( $newparams['mi_folder_fullpath'] );
			if( isset( $newparams['mi_name'] ) ) {
				$ht->setAuthName( $newparams['mi_name'] );
			}
			$ht->addLogin();
		}

		return $newparams;
	}

	function expiration_action( $request )
	{
		$database = &JFactory::getDBO();

		$ht = new htaccess();
		$ht->setFPasswd( $this->settings['mi_folder_user_fullpath'] );
		$ht->delUser( $request->metaUser->cmsUser->username );
	}

	function action( $request )
	{
		$database = &JFactory::getDBO();

		$ht = new htaccess();
		$ht->setFPasswd( $this->settings['mi_folder_user_fullpath'] );
		$ht->setFHtaccess( $this->settings['mi_folder_fullpath'] );

		if ( isset( $this->settings['mi_name'] ) ) {
			$ht->setAuthName( $this->settings['mi_name'] );
		}

		if ( $this->settings['use_md5'] ) {
			$ht->addUser( $request->metaUser->cmsUser->username, $request->metaUser->cmsUser->password );
		} else {
			$apachepw = new apachepw( $database );

			$apwid = $apachepw->getIDbyUserID( $request->metaUser->userid );

			if ( $apwid ) {
				$apachepw->load( $apwid );
			} else {
				// notify User? Admin?
				return false;
			}

			$ht->addUser( $request->metaUser->cmsUser->username, $apachepw->apachepw );
		}

		$ht->addLogin();
		return true;
	}

	function on_userchange_action( $request )
	{
		$database = &JFactory::getDBO();

		$apachepw = new apachepw( $database );
		$apwid = $apachepw->getIDbyUserID( $request->row->id );

		if ( $apwid ) {
			$apachepw->load( $apwid );
		} else {
			$apachepw->load(0);
			$apachepw->userid = $request->row->id;
		}

		if ( isset( $request->post['password_clear'] ) ) {
			$password = crypt( $request->post['password_clear'] );

		} elseif ( !empty( $request->post['password'] ) ) {
			$password = $request->post['password'];
		} elseif ( !empty( $request->post['password2'] ) ) {
			$password = $request->post['password2'];
		} elseif ( !$apwid ) {
			// No new password and no existing password - nothing to be done here
			return;
		}

		if ( !empty( $this->settings['use_apachemd5'] ) ) {
			$apachepw->apachepw = $this->crypt_apr1_md5( $password );
		} elseif( $this->settings['use_md5'] ) {
			$apachepw->apachepw = md5( $password );
		} else {
			$apachepw->apachepw = crypt( $password );
		}

		$apachepw->check();
		$apachepw->store();

		if ( !( strcmp( $request->trace, 'registration' ) === 0 ) ) {
			$ht = new htaccess();
			$ht->setFPasswd( $this->settings['mi_folder_user_fullpath'] );
			$ht->setFHtaccess( $this->settings['mi_folder_fullpath'] );
			if ( isset( $this->settings['mi_name'] ) ) {
				$ht->setAuthName( $this->settings['mi_name'] );
			}

			$userlist = $ht->getUsers();

			if ( in_array( $request->row->username, $userlist ) ) {
				$ht->delUser( $request->row->username );
				if ( $this->settings['use_md5'] ) {
					$ht->addUser( $request->row->username, $request->row->password );
				} else {
					$ht->addUser( $request->row->username, $apachepw->apachepw );
				}
				$ht->addLogin();
			}
		}
		return true;
	}

	function delete()
	{
		if ( !file_exists( $this->settings['mi_folder_fullpath'] ) ) {
			$ht = new htaccess();
			$ht->setFPasswd( $this->settings['mi_folder_user_fullpath'] );
			$ht->setFHtaccess( $this->settings['mi_folder_fullpath'] );

			$ht->delLogin();
			return true;
		}
		return false;
	}

	function crypt_apr1_md5( $plainpasswd )
	{
		$salt = substr(str_shuffle("abcdefghijklmnopqrstuvwxyz0123456789"), 0, 8);

		$len = strlen($plainpasswd);

		$text = $plainpasswd.'$apr1$'.$salt;

		$bin = pack("H32", md5($plainpasswd.$salt.$plainpasswd));

		for ( $i=$len; $i>0; $i-=16 ) {
			$text .= substr($bin, 0, min(16, $i));
		}

		for ( $i=$len; $i>0; $i>>=1 ) {
			$text .= ($i & 1) ? chr(0) : $plainpasswd{0};
		}

		$bin = pack("H32", md5($text));

		for ( $i = 0; $i < 1000; $i++ ) {
			$new = ($i & 1) ? $plainpasswd : $bin;
			if ($i % 3) $new .= $salt;
			if ($i % 7) $new .= $plainpasswd;
			$new .= ($i & 1) ? $bin : $plainpasswd;
			$bin = pack("H32", md5($new));
		}

		$tmp = "";
		for ( $i = 0; $i < 5; $i++ ) {
			$k = $i + 6;
			$j = $i + 12;
			if ($j == 16) $j = 5;
			$tmp = $bin[$i].$bin[$k].$bin[$j].$tmp;
		}

		$tmp = chr(0).chr(0).$bin[11].$tmp;

		$tmp = strtr(strrev(substr(base64_encode($tmp), 2)),
		"ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/",
		"./0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz");

		return "$"."apr1"."$".$salt."$".$tmp;
	}

}

class apachepw extends JTable
{
	/** @var int Primary key */
	var $id					= null;
	/** @var int */
	var $userid 			= null;
	/** @var string */
	var $apachepw			= null;

	function apachepw( &$db )
	{
		parent::__construct( '#__acctexp_mi_htaccess_apachepw', 'id', $db );
	}

	function getIDbyUserID( $userid )
	{
		$database = &JFactory::getDBO();

		$query = 'SELECT `id`'
				. ' FROM #__acctexp_mi_htaccess_apachepw'
				. ' WHERE `userid` = \'' . $userid . '\''
				;
		$database->setQuery( $query );
		return $database->loadResult();
	}
}
?>
