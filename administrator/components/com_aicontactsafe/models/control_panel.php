<?php
/**
 * @version     $Id$ 2.0.8 0
 * @package     Joomla
 * @copyright   Copyright (C) 2005 - 2008 Open Source Matters. All rights reserved.
 * @license     GNU/GPL, see LICENSE.php
 *
 * added/fixed in version 2.0.1
 * - fixed the problem with the apostrophe in contact information
 * - added custom field date format
 * - added mark_required_fields character
 * - added always_send_to_defaut
 * - added Artio activation
 * - added Joom!Fish activation
 * added/fixed in version 2.0.8
 * - added a test for the GD library used by CAPTCHA
 *
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

// define the control_panel model class of aiContactSafe
class AiContactSafeModelControl_panel extends AiContactSafeModelDefault {

	// function to write data to database
	function writeData() {
		// get the table where to read
		$tablename = $this->getTableName();
		// remove the chars '#__' form the front of the name of the table
		$ctablename = substr($tablename,3);
		$postData = $this->readPostDataFromSession();

		// read the config variables from the post data
		$use_css_backend = (array_key_exists('use_css_backend',$postData) && $postData['use_css_backend'])?1:0;
		$activate_help = (array_key_exists('activate_help',$postData) && $postData['activate_help'])?1:0;
		$date_format = $postData['date_format'];
		$default_status_filter = $postData['default_status_filter'];
		$editbox_cols = $postData['editbox_cols'];
		$editbox_rows = $postData['editbox_rows'];
		$default_name = $postData['default_name'];
		$default_email = $postData['default_email'];
		$default_subject = $postData['default_subject'];
		$activate_spam_control = (array_key_exists('activate_spam_control',$postData) && $postData['activate_spam_control'])?1:0;
		$block_words = $postData['block_words'];
		$record_blocked_messages = (array_key_exists('record_blocked_messages',$postData) && $postData['record_blocked_messages'])?1:0;
		$activate_ip_ban = (array_key_exists('activate_ip_ban',$postData) && $postData['activate_ip_ban'])?1:0;
		$ban_ips = $postData['ban_ips'];
		$redirect_ips = $postData['redirect_ips'];
		$ban_ips_blocked_words = (array_key_exists('ban_ips_blocked_words',$postData) && $postData['ban_ips_blocked_words'])?1:0;
		$maximum_messages_ban_ip = $postData['maximum_messages_ban_ip'];
		$maximum_minutes_ban_ip = $postData['maximum_minutes_ban_ip'];
		$email_ban_ip = $postData['email_ban_ip'];
		$set_sender_joomla = (array_key_exists('set_sender_joomla',$postData) && $postData['set_sender_joomla'])?1:0;
		$upload_attachments = str_replace('\\','&#92;',$postData['upload_attachments']);
		$maximum_size = $postData['maximum_size'];
		$attachments_types = $postData['attachments_types'];
		$attach_to_email = (array_key_exists('attach_to_email',$postData) && $postData['attach_to_email'])?1:0;
		$delete_after_sent = (array_key_exists('delete_after_sent',$postData) && $postData['delete_after_sent'])?1:0;
		if($delete_after_sent && !$attach_to_email) {
			$delete_after_sent = 0;
			$this->_app->_session->set( 'isOK:' . $this->_sTask, false );
			$this->_app->_session->set( 'errorMsg:' . $this->_sTask, JText::_( 'If the files are not attached to the email they will not be deleted after the message is sent.' ) );
		}
		$gid_messages = $postData['gid_messages'];
		$users_all_messages = (array_key_exists('users_all_messages',$postData) && $postData['users_all_messages'])?1:0;
		$user_field_message = $postData['user_field_message'];

		// initialize the database
		$db = & JFactory::getDBO();

		// save use_css_backend
		$query = 'update `#__aicontactsafe_config` set config_value = \'' . $use_css_backend . '\' where config_key = \'use_css_backend\'';
		$db->setQuery( $query );
		$isOK = $db->query();
		if (!$isOK) {
			$this->_app->_session->set( 'isOK:' . $this->_sTask, false );
			JError::raiseError( 500, $db->getErrorMsg() );
		}
		// save activate_help
		$query = 'update `#__aicontactsafe_config` set config_value = \'' . $activate_help . '\' where config_key = \'activate_help\'';
		$db->setQuery( $query );
		$isOK = $db->query();
		if (!$isOK) {
			$this->_app->_session->set( 'isOK:' . $this->_sTask, false );
			JError::raiseError( 500, $db->getErrorMsg() );
		}
		// save date_format
		$query = 'update `#__aicontactsafe_config` set config_value = \'' . $date_format . '\' where config_key = \'date_format\'';
		$db->setQuery( $query );
		$isOK = $db->query();
		if (!$isOK) {
			$this->_app->_session->set( 'isOK:' . $this->_sTask, false );
			JError::raiseError( 500, $db->getErrorMsg() );
		}
		// save default_status_filter
		$query = 'update `#__aicontactsafe_config` set config_value = \'' . $default_status_filter . '\' where config_key = \'default_status_filter\'';
		$db->setQuery( $query );
		$isOK = $db->query();
		if (!$isOK) {
			$this->_app->_session->set( 'isOK:' . $this->_sTask, false );
			JError::raiseError( 500, $db->getErrorMsg() );
		}
		// save editbox_cols
		$query = 'update `#__aicontactsafe_config` set config_value = \'' . $editbox_cols . '\' where config_key = \'editbox_cols\'';
		$db->setQuery( $query );
		$isOK = $db->query();
		if (!$isOK) {
			$this->_app->_session->set( 'isOK:' . $this->_sTask, false );
			JError::raiseError( 500, $db->getErrorMsg() );
		}
		// save editbox_rows
		$query = 'update `#__aicontactsafe_config` set config_value = \'' . $editbox_rows . '\' where config_key = \'editbox_rows\'';
		$db->setQuery( $query );
		$isOK = $db->query();
		if (!$isOK) {
			$this->_app->_session->set( 'isOK:' . $this->_sTask, false );
			JError::raiseError( 500, $db->getErrorMsg() );
		}
		// save default_name
		$query = 'update `#__aicontactsafe_config` set config_value = \'' . $default_name . '\' where config_key = \'default_name\'';
		$db->setQuery( $query );
		$isOK = $db->query();
		if (!$isOK) {
			$this->_app->_session->set( 'isOK:' . $this->_sTask, false );
			JError::raiseError( 500, $db->getErrorMsg() );
		}
		// save default_email
		$query = 'update `#__aicontactsafe_config` set config_value = \'' . $default_email . '\' where config_key = \'default_email\'';
		$db->setQuery( $query );
		$isOK = $db->query();
		if (!$isOK) {
			$this->_app->_session->set( 'isOK:' . $this->_sTask, false );
			JError::raiseError( 500, $db->getErrorMsg() );
		}
		// save default_subject
		$query = 'update `#__aicontactsafe_config` set config_value = \'' . $default_subject . '\' where config_key = \'default_subject\'';
		$db->setQuery( $query );
		$isOK = $db->query();
		if (!$isOK) {
			$this->_app->_session->set( 'isOK:' . $this->_sTask, false );
			JError::raiseError( 500, $db->getErrorMsg() );
		}
		// save activate_spam_control
		$query = 'update `#__aicontactsafe_config` set config_value = \'' . $activate_spam_control . '\' where config_key = \'activate_spam_control\'';
		$db->setQuery( $query );
		$isOK = $db->query();
		if (!$isOK) {
			$this->_app->_session->set( 'isOK:' . $this->_sTask, false );
			JError::raiseError( 500, $db->getErrorMsg() );
		}
		// save block_words
		$query = 'update `#__aicontactsafe_config` set config_value = \'' . $block_words . '\' where config_key = \'block_words\'';
		$db->setQuery( $query );
		$isOK = $db->query();
		if (!$isOK) {
			$this->_app->_session->set( 'isOK:' . $this->_sTask, false );
			JError::raiseError( 500, $db->getErrorMsg() );
		}
		// save record_blocked_messages
		$query = 'update `#__aicontactsafe_config` set config_value = \'' . $record_blocked_messages . '\' where config_key = \'record_blocked_messages\'';
		$db->setQuery( $query );
		$isOK = $db->query();
		if (!$isOK) {
			$this->_app->_session->set( 'isOK:' . $this->_sTask, false );
			JError::raiseError( 500, $db->getErrorMsg() );
		}
		// save activate_ip_ban
		$query = 'update `#__aicontactsafe_config` set config_value = \'' . $activate_ip_ban . '\' where config_key = \'activate_ip_ban\'';
		$db->setQuery( $query );
		$isOK = $db->query();
		if (!$isOK) {
			$this->_app->_session->set( 'isOK:' . $this->_sTask, false );
			JError::raiseError( 500, $db->getErrorMsg() );
		}
		// save ban_ips
		$query = 'update `#__aicontactsafe_config` set config_value = \'' . $ban_ips . '\' where config_key = \'ban_ips\'';
		$db->setQuery( $query );
		$isOK = $db->query();
		if (!$isOK) {
			$this->_app->_session->set( 'isOK:' . $this->_sTask, false );
			JError::raiseError( 500, $db->getErrorMsg() );
		}
		// save redirect_ips
		$query = 'update `#__aicontactsafe_config` set config_value = \'' . $redirect_ips . '\' where config_key = \'redirect_ips\'';
		$db->setQuery( $query );
		$isOK = $db->query();
		if (!$isOK) {
			$this->_app->_session->set( 'isOK:' . $this->_sTask, false );
			JError::raiseError( 500, $db->getErrorMsg() );
		}
		// save ban_ips_blocked_words
		$query = 'update `#__aicontactsafe_config` set config_value = \'' . $ban_ips_blocked_words . '\' where config_key = \'ban_ips_blocked_words\'';
		$db->setQuery( $query );
		$isOK = $db->query();
		if (!$isOK) {
			$this->_app->_session->set( 'isOK:' . $this->_sTask, false );
			JError::raiseError( 500, $db->getErrorMsg() );
		}
		// save maximum_messages_ban_ip
		$query = 'update `#__aicontactsafe_config` set config_value = \'' . $maximum_messages_ban_ip . '\' where config_key = \'maximum_messages_ban_ip\'';
		$db->setQuery( $query );
		$isOK = $db->query();
		if (!$isOK) {
			$this->_app->_session->set( 'isOK:' . $this->_sTask, false );
			JError::raiseError( 500, $db->getErrorMsg() );
		}
		// save maximum_minutes_ban_ip
		$query = 'update `#__aicontactsafe_config` set config_value = \'' . $maximum_minutes_ban_ip . '\' where config_key = \'maximum_minutes_ban_ip\'';
		$db->setQuery( $query );
		$isOK = $db->query();
		if (!$isOK) {
			$this->_app->_session->set( 'isOK:' . $this->_sTask, false );
			JError::raiseError( 500, $db->getErrorMsg() );
		}
		// save email_ban_ip
		$query = 'update `#__aicontactsafe_config` set config_value = \'' . $email_ban_ip . '\' where config_key = \'email_ban_ip\'';
		$db->setQuery( $query );
		$isOK = $db->query();
		if (!$isOK) {
			$this->_app->_session->set( 'isOK:' . $this->_sTask, false );
			JError::raiseError( 500, $db->getErrorMsg() );
		}
		// save set_sender_joomla
		$query = 'update `#__aicontactsafe_config` set config_value = \'' . $set_sender_joomla . '\' where config_key = \'set_sender_joomla\'';
		$db->setQuery( $query );
		$isOK = $db->query();
		if (!$isOK) {
			$this->_app->_session->set( 'isOK:' . $this->_sTask, false );
			JError::raiseError( 500, $db->getErrorMsg() );
		}
		// save upload_attachments
		$query = 'update `#__aicontactsafe_config` set config_value = \'' . $upload_attachments . '\' where config_key = \'upload_attachments\'';
		$db->setQuery( $query );
		$isOK = $db->query();
		if (!$isOK) {
			$this->_app->_session->set( 'isOK:' . $this->_sTask, false );
			JError::raiseError( 500, $db->getErrorMsg() );
		}
		// make sure the folder exists
		$att_folder = str_replace('/',DS,$upload_attachments);
		$att_folder = str_replace('&#92;',DS,$att_folder);
		$att_folder = JPATH_ROOT.DS.$att_folder;
		// import joomla clases to manage file system
		jimport('joomla.filesystem.folder');
		if (!JFolder::exists($att_folder)) {
			JFolder::create($att_folder);

			// import joomla clases to manage file system
			jimport('joomla.filesystem.file');

			$src = JPath::clean(JPATH_ROOT.DS.'administrator'.DS.'components'.DS.'com_aicontactsafe'.DS.'index.html');
			$dest = JPath::clean($att_folder.DS.'index.html');
			JFile::copy($src, $dest);

			$src = JPath::clean(JPATH_ROOT.DS.'administrator'.DS.'components'.DS.'com_aicontactsafe'.DS.'includes'.DS.'htaccess'.DS.'.htaccess');
			$dest = JPath::clean($att_folder.DS.'.htaccess');
			JFile::copy($src, $dest);
		}

		// save maximum_size
		$query = 'update `#__aicontactsafe_config` set config_value = \'' . $maximum_size . '\' where config_key = \'maximum_size\'';
		$db->setQuery( $query );
		$isOK = $db->query();
		if (!$isOK) {
			$this->_app->_session->set( 'isOK:' . $this->_sTask, false );
			JError::raiseError( 500, $db->getErrorMsg() );
		}
		// save redirect_ips
		$query = 'update `#__aicontactsafe_config` set config_value = \'' . $attachments_types . '\' where config_key = \'attachments_types\'';
		$db->setQuery( $query );
		$isOK = $db->query();
		if (!$isOK) {
			$this->_app->_session->set( 'isOK:' . $this->_sTask, false );
			JError::raiseError( 500, $db->getErrorMsg() );
		}
		// save attach_to_email
		$query = 'update `#__aicontactsafe_config` set config_value = \'' . $attach_to_email . '\' where config_key = \'attach_to_email\'';
		$db->setQuery( $query );
		$isOK = $db->query();
		if (!$isOK) {
			$this->_app->_session->set( 'isOK:' . $this->_sTask, false );
			JError::raiseError( 500, $db->getErrorMsg() );
		}
		// delete_after_sent
		$query = 'update `#__aicontactsafe_config` set config_value = \'' . $delete_after_sent . '\' where config_key = \'delete_after_sent\'';
		$db->setQuery( $query );
		$isOK = $db->query();
		if (!$isOK) {
			$this->_app->_session->set( 'isOK:' . $this->_sTask, false );
			JError::raiseError( 500, $db->getErrorMsg() );
		}

		// gid_messages
		$query = 'update `#__aicontactsafe_config` set config_value = \'' . $gid_messages . '\' where config_key = \'gid_messages\'';
		$db->setQuery( $query );
		$isOK = $db->query();
		if (!$isOK) {
			$this->_app->_session->set( 'isOK:' . $this->_sTask, false );
			JError::raiseError( 500, $db->getErrorMsg() );
		}

		// users_all_messages
		$query = 'update `#__aicontactsafe_config` set config_value = \'' . $users_all_messages . '\' where config_key = \'users_all_messages\'';
		$db->setQuery( $query );
		$isOK = $db->query();
		if (!$isOK) {
			$this->_app->_session->set( 'isOK:' . $this->_sTask, false );
			JError::raiseError( 500, $db->getErrorMsg() );
		}

		// user_field_message
		$query = 'update `#__aicontactsafe_config` set config_value = \'' . $user_field_message . '\' where config_key = \'user_field_message\'';
		$db->setQuery( $query );
		$isOK = $db->query();
		if (!$isOK) {
			$this->_app->_session->set( 'isOK:' . $this->_sTask, false );
			JError::raiseError( 500, $db->getErrorMsg() );
		}

		$isOK = $this->_app->_session->get( 'isOK:' . $this->_sTask );

		return $isOK;
	}

	// function to determine the table to write to
	function getTableName($sTask = '') {
		$tablename = '#__aicontactsafe_config';
		return $tablename;
	}

	// function to delete all the tables and files uploaded by AiContactSafe
	function deleteTablesAndFiles() {
		// initialize the database
		$db = &JFactory::getDBO();

		// #__aicontactsafe_config
		$query = 'TRUNCATE TABLE `#__aicontactsafe_config`;';
		$db->setQuery( $query );
		$db->query();
		$query = 'DROP TABLE IF EXISTS `#__aicontactsafe_config`;';
		$db->setQuery( $query );
		$db->query();
		// #__aicontactsafe_fields
		$query = 'TRUNCATE TABLE `#__aicontactsafe_fields`;';
		$db->setQuery( $query );
		$db->query();
		$query = 'DROP TABLE IF EXISTS `#__aicontactsafe_fields`;';
		$db->setQuery( $query );
		$db->query();
		// #__aicontactsafe_contactinformations
		$query = 'TRUNCATE TABLE `#__aicontactsafe_contactinformations`;';
		$db->setQuery( $query );
		$db->query();
		$query = 'DROP TABLE IF EXISTS `#__aicontactsafe_contactinformations`;';
		$db->setQuery( $query );
		$db->query();
		// #__aicontactsafe_messages
		$query = 'TRUNCATE TABLE `#__aicontactsafe_messages`;';
		$db->setQuery( $query );
		$db->query();
		$query = 'DROP TABLE IF EXISTS `#__aicontactsafe_messages`;';
		$db->setQuery( $query );
		$db->query();
		// #__aicontactsafe_profiles
		$query = 'TRUNCATE TABLE `#__aicontactsafe_profiles`;';
		$db->setQuery( $query );
		$db->query();
		$query = 'DROP TABLE IF EXISTS `#__aicontactsafe_profiles`;';
		$db->setQuery( $query );
		$db->query();
		// #__aicontactsafe_messagefiles
		$query = 'TRUNCATE TABLE `#__aicontactsafe_messagefiles`;';
		$db->setQuery( $query );
		$db->query();
		$query = 'DROP TABLE IF EXISTS `#__aicontactsafe_messagefiles`;';
		$db->setQuery( $query );
		$db->query();
		// #__aicontactsafe_fieldvalues
		$query = 'TRUNCATE TABLE `#__aicontactsafe_fieldvalues`;';
		$db->setQuery( $query );
		$db->query();
		$query = 'DROP TABLE IF EXISTS `#__aicontactsafe_fieldvalues`;';
		$db->setQuery( $query );
		$db->query();
		// #__aicontactsafe_statuses
		$query = 'TRUNCATE TABLE `#__aicontactsafe_statuses`;';
		$db->setQuery( $query );
		$db->query();
		$query = 'DROP TABLE IF EXISTS `#__aicontactsafe_statuses`;';
		$db->setQuery( $query );
		$db->query();

		// delete records from joomfish
		// #__jf_tableinfo
		$query = 'DELETE FROM `#__jf_tableinfo` WHERE joomlatablename = \'aicontactsafe_contactinformations\' or joomlatablename = \'aicontactsafe_fields\' or joomlatablename = \'aicontactsafe_profiles\';';
		$db->setQuery( $query );
		$db->query();
		// #__jf_content
		$query = 'DELETE FROM `#__jf_content` WHERE reference_table = \'aicontactsafe_contactinformations\' or reference_table = \'aicontactsafe_fields\' or reference_table = \'aicontactsafe_profiles\';';
		$db->setQuery( $query );
		$db->query();

		// import joomla clases to manage file system
		jimport('joomla.filesystem.folder');

		// delete the folder containing the files in the media folder
		$aicontactsafe_media_folder = JPATH_ROOT.DS.'media'.DS.'aicontactsafe';
		JFolder::delete($aicontactsafe_media_folder);

		// uninstall aiContactSafeModule
		if ($this->checkAiContactSafeModule()) {
			$this->uninstallAiContactSafeModule();
		}
		// uninstall aiContactSafeForm
		if ($this->checkAiContactSafeForm()) {
			$this->uninstallAiContactSafeForm();
		}
		// uninstall aiContactSafeLink
		if ($this->checkAiContactSafeLink()) {
			$this->uninstallAiContactSafeLink();
		}
	}

	// function to check if artio is installed and the aiContactSafe plugin is installed
	// return
	// - 0 if Artio is not installed
	// - 1 if Artio is installed but the aiContactSafe plugin is not installed
	// - 2 if Artio is installed and the aiContactSafe plugin is installed
	function check_artio() {
		$return = 0;

		// import joomla clases to manage file system
		jimport('joomla.filesystem.file');

		$artio = JPath::clean(JPATH_ROOT.DS.'components'.DS.'com_sef'.DS.'sef_ext');
		if (is_dir($artio)) {
			$return = 1;
			$com_aicontactsafe_php = JPath::clean(JPATH_ROOT.DS.'components'.DS.'com_sef'.DS.'sef_ext'.DS.'com_aicontactsafe.php');
			$com_aicontactsafe_xml = JPath::clean(JPATH_ROOT.DS.'components'.DS.'com_sef'.DS.'sef_ext'.DS.'com_aicontactsafe.xml');
			if (is_file($com_aicontactsafe_php) && is_file($com_aicontactsafe_xml)) {
				$return = 2;
			}
		}

		return $return;
	}
	
	// function to check if Joom!Fish is installed and the content elements for aiContactSafe are installed
	// return
	// - 0 if Joom!Fish is not installed
	// - 1 if Joom!Fish is installed but the aiContactSafe content elements are not installed
	// - 2 if Joom!Fish is installed and the aiContactSafe content elements are installed
	function check_joomfish() {
		$return = 0;

		// import joomla clases to manage file system
		jimport('joomla.filesystem.file');

		$contentelements = JPath::clean(JPATH_ROOT.DS.'administrator'.DS.'components'.DS.'com_joomfish'.DS.'contentelements');
		if (is_dir($contentelements)) {
			$return = 1;
			$aicontactsafe_contactinformations = JPath::clean(JPATH_ROOT.DS.'administrator'.DS.'components'.DS.'com_joomfish'.DS.'contentelements'.DS.'aicontactsafe_contactinformations.xml');
			$aicontactsafe_fields = JPath::clean(JPATH_ROOT.DS.'administrator'.DS.'components'.DS.'com_joomfish'.DS.'contentelements'.DS.'aicontactsafe_fields.xml');
			$aicontactsafe_profiles = JPath::clean(JPATH_ROOT.DS.'administrator'.DS.'components'.DS.'com_joomfish'.DS.'contentelements'.DS.'aicontactsafe_profiles.xml');
			if (is_file($aicontactsafe_contactinformations) && is_file($aicontactsafe_fields) && is_file($aicontactsafe_profiles)) {
				$return = 2;
			}
		}

		return $return;
	}

	// function to activate aiContactSafe in Artio
	function activate_artio() {
		// import joomla clases to manage file system
		jimport('joomla.filesystem.file');

		$src = JPath::clean(JPATH_ROOT.DS.'administrator'.DS.'components'.DS.'com_aicontactsafe'.DS.'includes'.DS.'artio'.DS.'com_aicontactsafe.php');
		$dest = JPath::clean(JPATH_ROOT.DS.'components'.DS.'com_sef'.DS.'sef_ext'.DS.'com_aicontactsafe.php');
		JFile::copy($src, $dest);
		$src = JPath::clean(JPATH_ROOT.DS.'administrator'.DS.'components'.DS.'com_aicontactsafe'.DS.'includes'.DS.'artio'.DS.'com_aicontactsafe.xml');
		$dest = JPath::clean(JPATH_ROOT.DS.'components'.DS.'com_sef'.DS.'sef_ext'.DS.'com_aicontactsafe.xml');
		JFile::copy($src, $dest);
	}

	// function to deactivate aiContactSafe in Artio
	function deactivate_artio() {
		// import joomla clases to manage file system
		jimport('joomla.filesystem.file');

		$com_aicontactsafe = JPath::clean(JPATH_ROOT.DS.'components'.DS.'com_sef'.DS.'sef_ext'.DS.'com_aicontactsafe.php');
		if (is_file($com_aicontactsafe)) {
			JFile::delete($com_aicontactsafe);
		}
		$com_aicontactsafe = JPath::clean(JPATH_ROOT.DS.'components'.DS.'com_sef'.DS.'sef_ext'.DS.'com_aicontactsafe.xml');
		if (is_file($com_aicontactsafe)) {
			JFile::delete($com_aicontactsafe);
		}
	}

	// function to activate aiContactSafe in Joom!Fish
	function activate_joomfish() {
		// import joomla clases to manage file system
		jimport('joomla.filesystem.file');

		$src = JPath::clean(JPATH_ROOT.DS.'administrator'.DS.'components'.DS.'com_aicontactsafe'.DS.'includes'.DS.'joomfish'.DS.'aicontactsafe_contactinformations.xml');
		$dest = JPath::clean(JPATH_ROOT.DS.'administrator'.DS.'components'.DS.'com_joomfish'.DS.'contentelements'.DS.'aicontactsafe_contactinformations.xml');
		JFile::copy($src, $dest);
		$src = JPath::clean(JPATH_ROOT.DS.'administrator'.DS.'components'.DS.'com_aicontactsafe'.DS.'includes'.DS.'joomfish'.DS.'aicontactsafe_fields.xml');
		$dest = JPath::clean(JPATH_ROOT.DS.'administrator'.DS.'components'.DS.'com_joomfish'.DS.'contentelements'.DS.'aicontactsafe_fields.xml');
		JFile::copy($src, $dest);
		$src = JPath::clean(JPATH_ROOT.DS.'administrator'.DS.'components'.DS.'com_aicontactsafe'.DS.'includes'.DS.'joomfish'.DS.'aicontactsafe_profiles.xml');
		$dest = JPath::clean(JPATH_ROOT.DS.'administrator'.DS.'components'.DS.'com_joomfish'.DS.'contentelements'.DS.'aicontactsafe_profiles.xml');
		JFile::copy($src, $dest);
	}

	// function to deactivate aiContactSafe in Joom!Fish
	function deactivate_joomfish() {
		// import joomla clases to manage file system
		jimport('joomla.filesystem.file');

		$aicontactsafe_contactinformations = JPath::clean(JPATH_ROOT.DS.'administrator'.DS.'components'.DS.'com_joomfish'.DS.'contentelements'.DS.'aicontactsafe_contactinformations.xml');
		if (is_file($aicontactsafe_contactinformations)) {
			JFile::delete($aicontactsafe_contactinformations);
		}
		$aicontactsafe_fields = JPath::clean(JPATH_ROOT.DS.'administrator'.DS.'components'.DS.'com_joomfish'.DS.'contentelements'.DS.'aicontactsafe_fields.xml');
		if (is_file($aicontactsafe_fields)) {
			JFile::delete($aicontactsafe_fields);
		}
		$aicontactsafe_profiles = JPath::clean(JPATH_ROOT.DS.'administrator'.DS.'components'.DS.'com_joomfish'.DS.'contentelements'.DS.'aicontactsafe_profiles.xml');
		if (is_file($aicontactsafe_profiles)) {
			JFile::delete($aicontactsafe_profiles);
		}
	}

	// function to check if the message section in the template is activated
	function checkMessageSection() {
		// initialize the database
		$db = & JFactory::getDBO();

		// get all the templates
		$query = 'SELECT template FROM `#__templates_menu` where client_id = 0 and ( menuid = 0 or menuid in ( select id from `#__menu` where link like \'%option=com_aicontactsafe%\' ) )';
		$db->setQuery( $query );
		$templates = $db->loadResultArray();
		
		// import joomla clases to manage file system
		jimport('joomla.filesystem.file');

		$rspTemplates = array();
		foreach($templates as $template) {
			$indexFile = JPATH_ROOT.DS.'templates'.DS.$template.DS.'index.php';
			$fileTemplate = JFile::read($indexFile);
			$cntMessageSection = substr_count($fileTemplate, '<jdoc:include type="message" />');
			if ( $cntMessageSection == 0 ) {
				$rspTemplates[] = $template;
			}
		}
		return $rspTemplates;
	}

	// function to check language files
	function check_language() {
		// import joomla clases to manage file system
		jimport('joomla.filesystem.file');

		$response = '<div style="margin-left:15px;">';
		$response .= '<div>'.JText::_( 'Administrator' ).'</div>';

		// initialize the language class
		$lang =& JFactory::getLanguage(JPATH_ROOT.DS.'administrator');
		// check the administrator languages
		$languages = $lang->getKnownLanguages();
		foreach($languages as $lg) {
			$lang_file = JPath::clean(JPATH_ROOT.DS.'administrator'.DS.'language'.DS.$lg['tag'].DS.$lg['tag'].'.com_aicontactsafe.ini');
			$source_file = JPath::clean(JPATH_ROOT.DS.'administrator'.DS.'components'.DS.'com_aicontactsafe'.DS.'languages'.DS.$lg['tag'].'.com_aicontactsafe.ini');
			if (is_file($lang_file)) {
				if (is_file($source_file)) {
					JFile::delete($lang_file);
					JFile::copy($source_file, $lang_file);
					$response .= '<div>'.'&nbsp;&nbsp;&nbsp;&nbsp;'.$lg['backwardlang'].'&nbsp;'.JText::_( 'replaced' ).'</div>';
				} else {
					$response .= '<div>'.'&nbsp;&nbsp;&nbsp;&nbsp;'.$lg['backwardlang'].'&nbsp;'.JText::_( 'not included in aiContactSafe but installed in Joomla' ).'</div>';
				}
			} else {
				if (is_file($source_file)) {
					JFile::copy($source_file, $lang_file);
					$response .= '<div>'.'&nbsp;&nbsp;&nbsp;&nbsp;'.$lg['backwardlang'].'&nbsp;'.JText::_( 'installed' ).'</div>';
				} else {
					$response .= '<div>'.'&nbsp;&nbsp;&nbsp;&nbsp;'.$lg['backwardlang'].'&nbsp;'.JText::_( 'not included in aiContactSafe and not installed in Joomla' ).'</div>';
				}
			}
			$lang_file = JPath::clean(JPATH_ROOT.DS.'administrator'.DS.'language'.DS.$lg['tag'].DS.$lg['tag'].'.com_aicontactsafe.menu.ini');
			$source_file = JPath::clean(JPATH_ROOT.DS.'administrator'.DS.'components'.DS.'com_aicontactsafe'.DS.'languages'.DS.$lg['tag'].'.com_aicontactsafe.menu.ini');
			if (is_file($lang_file)) {
				if (is_file($source_file)) {
					JFile::delete($lang_file);
					JFile::copy($source_file, $lang_file);
					$response .= '<div>'.'&nbsp;&nbsp;&nbsp;&nbsp;'.$lg['backwardlang'].'&nbsp;menu&nbsp;'.JText::_( 'replaced' ).'</div>';
				} else {
					$response .= '<div>'.'&nbsp;&nbsp;&nbsp;&nbsp;'.$lg['backwardlang'].'&nbsp;menu&nbsp;'.JText::_( 'not included in aiContactSafe but installed in Joomla' ).'</div>';
				}
			} else {
				if (is_file($source_file)) {
					JFile::copy($source_file, $lang_file);
					$response .= '<div>'.'&nbsp;&nbsp;&nbsp;&nbsp;'.$lg['backwardlang'].'&nbsp;menu&nbsp;'.JText::_( 'installed' ).'</div>';
				} else {
					$response .= '<div>'.'&nbsp;&nbsp;&nbsp;&nbsp;'.$lg['backwardlang'].'&nbsp;menu&nbsp;'.JText::_( 'not included in aiContactSafe and not installed in Joomla' ).'</div>';
				}
			}
			$lang_file = JPath::clean(JPATH_ROOT.DS.'administrator'.DS.'language'.DS.$lg['tag'].DS.$lg['tag'].'.com_aicontactsafe.help.ini');
			$source_file = JPath::clean(JPATH_ROOT.DS.'administrator'.DS.'components'.DS.'com_aicontactsafe'.DS.'languages'.DS.$lg['tag'].'.com_aicontactsafe.help.ini');
			if (is_file($lang_file)) {
				if (is_file($source_file)) {
					JFile::delete($lang_file);
					JFile::copy($source_file, $lang_file);
					$response .= '<div>'.'&nbsp;&nbsp;&nbsp;&nbsp;'.$lg['backwardlang'].'&nbsp;help&nbsp;'.JText::_( 'replaced' ).'</div>';
				} else {
					$response .= '<div>'.'&nbsp;&nbsp;&nbsp;&nbsp;'.$lg['backwardlang'].'&nbsp;help&nbsp;'.JText::_( 'not included in aiContactSafe but installed in Joomla' ).'</div>';
				}
			} else {
				if (is_file($source_file)) {
					JFile::copy($source_file, $lang_file);
					$response .= '<div>'.'&nbsp;&nbsp;&nbsp;&nbsp;'.$lg['backwardlang'].'&nbsp;help&nbsp;'.JText::_( 'installed' ).'</div>';
				} else {
					$response .= '<div>'.'&nbsp;&nbsp;&nbsp;&nbsp;'.$lg['backwardlang'].'&nbsp;help&nbsp;'.JText::_( 'not included in aiContactSafe and not installed in Joomla' ).'</div>';
				}
			}
		}

		$response .= '<div>'.JText::_( 'Site' ).'</div>';

		// check the site languages
		$languages = $lang->getKnownLanguages(JPATH_ROOT);
		foreach($languages as $lg) {
			$lang_file = JPath::clean(JPATH_ROOT.DS.'language'.DS.$lg['tag'].DS.$lg['tag'].'.com_aicontactsafe.ini');
			$source_file = JPath::clean(JPATH_ROOT.DS.'components'.DS.'com_aicontactsafe'.DS.'languages'.DS.$lg['tag'].'.com_aicontactsafe.ini');
			if (is_file($lang_file)) {
				if (is_file($source_file)) {
					JFile::delete($lang_file);
					JFile::copy($source_file, $lang_file);
					$response .= '<div>'.'&nbsp;&nbsp;&nbsp;&nbsp;'.$lg['backwardlang'].'&nbsp;'.JText::_( 'replaced' ).'</div>';
				} else {
					$response .= '<div>'.'&nbsp;&nbsp;&nbsp;&nbsp;'.$lg['backwardlang'].'&nbsp;'.JText::_( 'not included in aiContactSafe but installed in Joomla' ).'</div>';
				}
			} else {
				if (is_file($source_file)) {
					JFile::copy($source_file, $lang_file);
					$response .= '<div>'.'&nbsp;&nbsp;&nbsp;&nbsp;'.$lg['backwardlang'].'&nbsp;'.JText::_( 'installed' ).'</div>';
				} else {
					$response .= '<div>'.'&nbsp;&nbsp;&nbsp;&nbsp;'.$lg['backwardlang'].'&nbsp;'.JText::_( 'not included in aiContactSafe and not installed in Joomla' ).'</div>';
				}
			}
		}
		$response .= '</div>';
		
		return $response;
	}

	// function to check if aiContactSafeModule is installed
	function checkAiContactSafeModule() {
		$return = 0;
		$xml_file = JPath::clean(JPATH_ROOT.DS.'modules'.DS.'mod_aicontactsafe'.DS.'mod_aicontactsafe.xml');
		if (is_file($xml_file)) {
			$xml =& JFactory::getXMLParser( 'simple' );
			$xml->loadFile( $xml_file );
			$version =& $xml->document->getElementByPath( 'version' );
			$installed_version = $version->data();
			$xml_file = JPath::clean(JPATH_ROOT.DS.'administrator'.DS.'components'.DS.'com_aicontactsafe'.DS.'includes'.DS.'mod_aicontactsafe'.DS.'mod_aicontactsafe.xml');
			if (is_file($xml_file)) {
				$xml =& JFactory::getXMLParser( 'simple' );
				$xml->loadFile( $xml_file );
				$version =& $xml->document->getElementByPath( 'version' );
				$current_version = $version->data();
			}
			if ( $installed_version == $current_version ) {
				$return = 2;
			} else {
				$return = 1;
			}
		}
		return $return;
	}

	// function to install aiContactSafeModule
	function installAiContactSafeModule() {
		jimport('joomla.installer.installer');
		$installer = & JInstaller::getInstance();
		$installed = $installer->install(JPATH_ROOT.DS.'administrator'.DS.'components'.DS.'com_aicontactsafe'.DS.'includes'.DS.'mod_aicontactsafe');
		if ($installed) {
			// initialize the database
			$db = & JFactory::getDBO();
	
			// activate the module
			$query = 'UPDATE #__modules SET published = 1 WHERE module = \'mod_aicontactsafe\'';
			$db->setQuery( $query );
			$installed = $db->query();
		}
		return $installed;
	}

	// function to uninstall aiContactSafeModule
	function uninstallAiContactSafeModule() {
		// initialize the database
		$db = & JFactory::getDBO();

		// get all the templates
		$query = 'SELECT id FROM #__modules WHERE module = \'mod_aicontactsafe\'';
		$db->setQuery( $query );
		$module_id = $db->loadResult();
		jimport('joomla.installer.installer');
		$installer = & JInstaller::getInstance();
		$uninstalled = $installer->uninstall('module', $module_id);

		return $uninstalled;
	}

	// function to reinstall aiContactSafeModule
	function reinstallAiContactSafeModule() {
		// import joomla clases to manage file system
		jimport('joomla.filesystem.file');

		$xml_file_current = JPath::clean(JPATH_ROOT.DS.'modules'.DS.'mod_aicontactsafe'.DS.'mod_aicontactsafe.xml');
		$xml_file_last = JPath::clean(JPATH_ROOT.DS.'administrator'.DS.'components'.DS.'com_aicontactsafe'.DS.'includes'.DS.'mod_aicontactsafe'.DS.'mod_aicontactsafe.xml');
		if (is_file($xml_file_current)) {
			JFile::delete($xml_file_current);
		}
		JFile::copy($xml_file_last, $xml_file_current);

		$php_file_current = JPath::clean(JPATH_ROOT.DS.'modules'.DS.'mod_aicontactsafe'.DS.'mod_aicontactsafe.php');
		$php_file_last = JPath::clean(JPATH_ROOT.DS.'administrator'.DS.'components'.DS.'com_aicontactsafe'.DS.'includes'.DS.'mod_aicontactsafe'.DS.'mod_aicontactsafe.php');
		if (is_file($php_file_current)) {
			JFile::delete($php_file_current);
		}
		JFile::copy($php_file_last, $php_file_current);

		return true;
	}

	// function to check if aiContactSafeForm is installed
	function checkAiContactSafeForm() {
		$return = 0;
		$xml_file = JPath::clean(JPATH_ROOT.DS.'plugins'.DS.'content'.DS.'aicontactsafeform.xml');
		if (is_file($xml_file)) {
			$xml =& JFactory::getXMLParser( 'simple' );
			$xml->loadFile( $xml_file );
			$version =& $xml->document->getElementByPath( 'version' );
			$installed_version = $version->data();
			$xml_file = JPath::clean(JPATH_ROOT.DS.'administrator'.DS.'components'.DS.'com_aicontactsafe'.DS.'includes'.DS.'plg_aicontactsafeform'.DS.'aicontactsafeform.xml');
			if (is_file($xml_file)) {
				$xml =& JFactory::getXMLParser( 'simple' );
				$xml->loadFile( $xml_file );
				$version =& $xml->document->getElementByPath( 'version' );
				$current_version = $version->data();
			}
			if ( $installed_version == $current_version ) {
				$return = 2;
			} else {
				$return = 1;
			}
		}
		return $return;
	}

	// function to install aiContactSafeForm
	function installAiContactSafeForm() {
		jimport('joomla.installer.installer');
		$installer = & JInstaller::getInstance();
		$installed = $installer->install(JPATH_ROOT.DS.'administrator'.DS.'components'.DS.'com_aicontactsafe'.DS.'includes'.DS.'plg_aicontactsafeform');
		if ($installed) {
			// initialize the database
			$db = & JFactory::getDBO();
	
			// activate the plugin
			$query = 'UPDATE #__plugins SET published = 1 WHERE element = \'aicontactsafeform\' and folder = \'content\'';
			$db->setQuery( $query );
			$installed = $db->query();
		}
		return $installed;
	}

	// function to uninstall aiContactSafeForm
	function uninstallAiContactSafeForm() {
		// initialize the database
		$db = & JFactory::getDBO();

		// get all the templates
		$query = 'SELECT id FROM #__plugins WHERE element = \'aicontactsafeform\' and folder = \'content\'';
		$db->setQuery( $query );
		$plugin_id = $db->loadResult();
		jimport('joomla.installer.installer');
		$installer = & JInstaller::getInstance();
		$uninstalled = $installer->uninstall('plugin', $plugin_id);

		return $uninstalled;
	}

	// function to reinstall aiContactSafeForm
	function reinstallAiContactSafeForm() {
		$upgrade = $this->uninstallAiContactSafeForm();
		if ($upgrade) {
			$upgrade = $this->installAiContactSafeForm();
		}
		return $upgrade;
	}

	// function to check if aiContactSafeLink is installed
	function checkAiContactSafeLink() {
		$return = 0;
		$xml_file = JPath::clean(JPATH_ROOT.DS.'plugins'.DS.'content'.DS.'aicontactsafelink.xml');
		if (is_file($xml_file)) {
			$xml =& JFactory::getXMLParser( 'simple' );
			$xml->loadFile( $xml_file );
			$version =& $xml->document->getElementByPath( 'version' );
			$installed_version = $version->data();
			$xml_file = JPath::clean(JPATH_ROOT.DS.'administrator'.DS.'components'.DS.'com_aicontactsafe'.DS.'includes'.DS.'plg_aicontactsafelink'.DS.'aicontactsafelink.xml');
			if (is_file($xml_file)) {
				$xml =& JFactory::getXMLParser( 'simple' );
				$xml->loadFile( $xml_file );
				$version =& $xml->document->getElementByPath( 'version' );
				$current_version = $version->data();
			}
			if ( $installed_version == $current_version ) {
				$return = 2;
			} else {
				$return = 1;
			}
		}
		return $return;
	}

	// function to install aiContactSafeLink
	function installAiContactSafeLink() {
		jimport('joomla.installer.installer');
		$installer = & JInstaller::getInstance();
		$installed = $installer->install(JPATH_ROOT.DS.'administrator'.DS.'components'.DS.'com_aicontactsafe'.DS.'includes'.DS.'plg_aicontactsafelink');
		if ($installed) {
			// initialize the database
			$db = & JFactory::getDBO();
	
			// activate the plugin
			$query = 'UPDATE #__plugins SET published = 1 WHERE element = \'aicontactsafelink\' and folder = \'content\'';
			$db->setQuery( $query );
			$installed = $db->query();
		}
		return $installed;
	}

	// function to uninstall aiContactSafeLink
	function uninstallAiContactSafeLink() {
		// initialize the database
		$db = & JFactory::getDBO();

		// get all the templates
		$query = 'SELECT id FROM #__plugins WHERE element = \'aicontactsafelink\' and folder = \'content\'';
		$db->setQuery( $query );
		$plugin_id = $db->loadResult();
		jimport('joomla.installer.installer');
		$installer = & JInstaller::getInstance();
		$uninstalled = $installer->uninstall('plugin', $plugin_id);

		return $uninstalled;
	}

	// function to reinstall aiContactSafeLink
	function reinstallAiContactSafeLink() {
		$upgrade = $this->uninstallAiContactSafeLink();
		if ($upgrade) {
			$upgrade = $this->installAiContactSafeLink();
		}
		return $upgrade;
	}

	// function to test if the GD functions used by the CAPTCHA code are available
	function checkGD() {
		$gd = array();
		if (function_exists("gd_info")) {
			$gd = gd_info();
		}
		return $gd;
	}

}
?>
