﻿<?php
/**
 * @version     $Id$ 2.0.10 b
 * @package     Joomla
 * @copyright   Copyright (C) 2005 - 2008 Open Source Matters. All rights reserved.
 * @license     GNU/GPL, see LICENSE.php
 *
 * added/fixed in version 2.0.10.b
 * - added Bulgarian translation
 *
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

// function called when the component is installed
function com_install() {
	$_version = '2.0.10.b.stable';

	// import joomla clases to manage file system
	jimport('joomla.filesystem.file');

	// initialize the database
	$db = &JFactory::getDBO();

// 2.0.1 modifications in database 
	// add the field profile_id into contactinformations table
	$query = 'ALTER TABLE `#__aicontactsafe_contactinformations` ADD `profile_id` INT( 11 ) NOT NULL AFTER `id`;';
	$db->setQuery( $query );
	$db->query();
	
	$query = 'ALTER TABLE `#__aicontactsafe_fields` ADD `label_parameters` TEXT NOT NULL COMMENT \'the parameters of the html label tag\' AFTER `field_label`;';
	$db->setQuery( $query );
	$db->query();
	
	$query = 'ALTER TABLE `#__aicontactsafe_fields` ADD `field_label_message` varchar(150) NOT NULL default \'\' COMMENT \'the label of the field in the message\';';
	$db->setQuery( $query );
	$db->query();

	$query = 'ALTER TABLE `#__aicontactsafe_fields` ADD `label_message_parameters` TEXT NOT NULL COMMENT \'the parameters of the html label in the message tag\';';
	$db->setQuery( $query );
	$db->query();

	$query = 'ALTER TABLE `#__aicontactsafe_fields` ADD `field_in_message` tinyint(1) unsigned NOT NULL default \'1\' COMMENT \'1 - field is added in the message, 0 - field is not added in the message\';';
	$db->setQuery( $query );
	$db->query();

	$query = 'ALTER TABLE `#__aicontactsafe_fields` ADD `default_value` varchar(150) NOT NULL default \'\' COMMENT \'the default value of the field\';';
	$db->setQuery( $query );
	$db->query();

	$query = 'ALTER TABLE `#__aicontactsafe_profiles` ADD `captcha_backgroundTransparent` tinyint(1) unsigned NOT NULL default \'1\' COMMENT \'1 - captcha background transparent\' AFTER `captcha_bgcolor`;';
	$db->setQuery( $query );
	$db->query();

	// remove spaces in the field name
	$query = 'UPDATE `#__aicontactsafe_fields` SET `name` = replace(name,\'\',\'_\');';
	$db->setQuery( $query );
	$db->query();

// 2.0.2 modifications in database 
	$query = 'ALTER TABLE `#__aicontactsafe_fields` ADD `field_limit` int(11) NOT NULL default \'0\' COMMENT \'the limit of the text fields, use 0 for unlimited\' AFTER `field_values`;';
	$db->setQuery( $query );
	$db->query();
	$query = 'ALTER TABLE `#__aicontactsafe_fields` ADD `auto_fill` varchar(10) NOT NULL default \'\' COMMENT \'specify the source for auto fill UN - joomla user name, UE - joomla user email\' AFTER `default_value`;';
	$db->setQuery( $query );
	$db->query();
	$query = 'ALTER TABLE `#__aicontactsafe_fields` ADD `send_message` tinyint(1) unsigned NOT NULL default \'0\' COMMENT \'this is used only for email fields : 1 - the message is sent to this address, 0 - the message is not sent to this address\' AFTER `field_in_message`;';
	$db->setQuery( $query );
	$db->query();
	$query = 'ALTER TABLE `#__aicontactsafe_profiles` ADD `name_field_id` int(11) unsigned NOT NULL COMMENT \'id of the field used as name\' AFTER `captcha_colors`;';
	$db->setQuery( $query );
	$db->query();
	$query = 'ALTER TABLE `#__aicontactsafe_profiles` CHANGE `field_label` `field_label` text NOT NULL COMMENT \'the label of the field\';';
	$db->setQuery( $query );
	$db->query();
	$query = 'ALTER TABLE `#__aicontactsafe_profiles` CHANGE `field_label_message` `field_label_message` text NOT NULL COMMENT \'the label of the field in the message\';';
	$db->setQuery( $query );
	$db->query();
	$query = 'ALTER TABLE `#__aicontactsafe_profiles` ADD `email_field_id` int(11) unsigned NOT NULL COMMENT \'id of the field used as email\' AFTER `name_field_id`;';
	$db->setQuery( $query );
	$db->query();
	$query = 'ALTER TABLE `#__aicontactsafe_profiles` ADD `subject_field_id` int(11) unsigned NOT NULL COMMENT \'id of the field used as subject\' AFTER `email_field_id`;';
	$db->setQuery( $query );
	$db->query();
	$query = 'ALTER TABLE `#__aicontactsafe_profiles` ADD `send_to_sender_field_id` int(11) unsigned NOT NULL COMMENT \'id of the field used as send to sender\' AFTER `subject_field_id`;';
	$db->setQuery( $query );
	$db->query();
	$query = 'ALTER TABLE `#__aicontactsafe_profiles` ADD `use_ajax` tinyint(1) unsigned NOT NULL default \'0\' COMMENT \'1 - ajax is used, 0 - ajax is not used\' AFTER `name`;';
	$db->setQuery( $query );
	$db->query();
	$query = 'ALTER TABLE `#__aicontactsafe_profiles` ADD `redirect_on_success` text NOT NULL COMMENT \'the url to redirect the web page on success\' AFTER `send_to_sender_field_id`;';
	$db->setQuery( $query );
	$db->query();
	$query = 'ALTER TABLE `jos_aicontactsafe_profiles` DROP `use_profile_css`';
	$db->setQuery( $query );
	$db->query();
	$query = 'ALTER TABLE `#__aicontactsafe_profiles` ADD `contact_form_width` int(11) NOT NULL default \'0\' COMMENT \'the width of the contact form\' AFTER `use_message_css`;';
	$db->setQuery( $query );
	$db->query();
	$query = 'ALTER TABLE `#__aicontactsafe_profiles` ADD `contact_info_width` int(11) NOT NULL default \'0\' COMMENT \'the width of the contact information\' AFTER `contact_form_width`;';
	$db->setQuery( $query );
	$db->query();
	$query = 'ALTER TABLE `#__aicontactsafe_profiles` ADD `email_mode` tinyint(1) unsigned NOT NULL default \'1\' COMMENT \'1 - html, 0 - plain text\' AFTER `subject_prefix`;';
	$db->setQuery( $query );
	$db->query();
	$query = 'SELECT id FROM `#__aicontactsafe_fields` WHERE `name` = \'name\' and `id` = 1';
	$db->setQuery( $query );
	$id = $db->loadResult();
	if ($id == 1) {
		$query = 'UPDATE `#__aicontactsafe_fields` SET `name` = \'aics_name\' WHERE `name` = \'name\' and `id` = 1';
		$db->setQuery( $query );
		$db->query();
		$query = 'UPDATE `#__aicontactsafe_profiles` SET `name_field_id` = 1';
		$db->setQuery( $query );
		$db->query();
	}
	$query = 'SELECT id FROM `#__aicontactsafe_fields` WHERE `name` = \'email\' and `id` = 2';
	$db->setQuery( $query );
	$id = $db->loadResult();
	if ($id == 2) {
		$query = 'UPDATE `#__aicontactsafe_fields` SET `name` = \'aics_email\', `field_type` = \'EM\' WHERE `name` = \'email\' and `id` = 2';
		$db->setQuery( $query );
		$db->query();
		$query = 'UPDATE `#__aicontactsafe_profiles` SET `email_field_id` = 2';
		$db->setQuery( $query );
		$db->query();
	}
	$query = 'SELECT id FROM `#__aicontactsafe_fields` WHERE `name` = \'phone\' and `id` = 3';
	$db->setQuery( $query );
	$id = $db->loadResult();
	if ($id == 3) {
		$query = 'UPDATE `#__aicontactsafe_fields` SET `name` = \'aics_phone\' WHERE `name` = \'phone\' and `id` = 3';
		$db->setQuery( $query );
		$db->query();
	}
	$query = 'SELECT id FROM `#__aicontactsafe_fields` WHERE `name` = \'subject\' and `id` = 4';
	$db->setQuery( $query );
	$id = $db->loadResult();
	if ($id == 4) {
		$query = 'UPDATE `#__aicontactsafe_fields` SET `name` = \'aics_subject\' WHERE `name` = \'subject\' and `id` = 4';
		$db->setQuery( $query );
		$db->query();
		$query = 'UPDATE `#__aicontactsafe_profiles` SET `subject_field_id` = 4';
		$db->setQuery( $query );
		$db->query();
	}
	$query = 'SELECT id FROM `#__aicontactsafe_fields` WHERE `name` = \'message\' and `id` = 5';
	$db->setQuery( $query );
	$id = $db->loadResult();
	if ($id == 5) {
		$query = 'UPDATE `#__aicontactsafe_fields` SET `name` = \'aics_message\' WHERE `name` = \'message\' and `id` = 5';
		$db->setQuery( $query );
		$db->query();
	}
	$query = 'SELECT id FROM `#__aicontactsafe_fields` WHERE `name` = \'send_to_sender\' and `id` = 6';
	$db->setQuery( $query );
	$id = $db->loadResult();
	if ($id == 6) {
		$query = 'UPDATE `#__aicontactsafe_fields` SET `name` = \'aics_send_to_sender\' WHERE `name` = \'send_to_sender\' and `id` = 6';
		$db->setQuery( $query );
		$db->query();
		$query = 'UPDATE `#__aicontactsafe_profiles` SET `send_to_sender_field_id` = 6';
		$db->setQuery( $query );
		$db->query();
	}
	$query = 'ALTER TABLE `#__aicontactsafe_messages` ADD `profile_id` int(11) unsigned NOT NULL COMMENT \'profile id\' AFTER `sender_ip`;';
	$db->setQuery( $query );
	$db->query();
	$query = 'SELECT id FROM `#__aicontactsafe_profiles`';
	$db->setQuery( $query );
	$ids = $db->loadObjectList();
	if (count($ids) == 1) {
		$query = 'UPDATE `#__aicontactsafe_messages` SET `profile_id` = '.$ids[0]->id.' WHERE `profile_id` = 0';
		$db->setQuery( $query );
		$db->query();
	}
	$query = 'ALTER TABLE `#__aicontactsafe_profiles` ADD `plg_contact_info` tinyint(1) unsigned NOT NULL default \'0\' COMMENT \'1 - activate plugins on contact information\' AFTER `display_format`;';
	$db->setQuery( $query );
	$db->query();
	$query = 'ALTER TABLE `#__aicontactsafe_profiles` ADD `use_random_letters` tinyint(1) unsigned NOT NULL default \'0\' COMMENT \'1 - use random letters for the CAPTCHA code\' AFTER `plg_contact_info`;';
	$db->setQuery( $query );
	$db->query();
	$query = 'ALTER TABLE `#__aicontactsafe_profiles` ADD `min_word_length` tinyint(2) unsigned NOT NULL default \'5\' COMMENT \'minimum word length for random CAPTCHA code\' AFTER `use_random_letters`;';
	$db->setQuery( $query );
	$db->query();
	$query = 'ALTER TABLE `#__aicontactsafe_profiles` ADD `max_word_length` tinyint(2) unsigned NOT NULL default \'8\' COMMENT \'maximum word length for random CAPTCHA code\' AFTER `min_word_length`;';
	$db->setQuery( $query );
	$db->query();

// 2.0.3 modifications in database 
	$query = 'ALTER TABLE `#__aicontactsafe_profiles` ADD `fields_order` text NOT NULL COMMENT \'the order of the fields for the current profile\' AFTER `redirect_on_success`;';
	$db->setQuery( $query );
	$db->query();
	$query = 'ALTER TABLE `#__aicontactsafe_profiles` ADD `use_mail_template` tinyint(1) unsigned NOT NULL default \'0\' COMMENT \'1 - mail template is used, 0 - mail template is not used\' AFTER `fields_order`;';
	$db->setQuery( $query );
	$db->query();
	$query = 'ALTER TABLE `#__aicontactsafe_messagefiles` ADD `r_id` int(21) unsigned NOT NULL COMMENT \'requests id\' AFTER `name`;';
	$db->setQuery( $query );
	$db->query();

// 2.0.5 modifications in database 
	$query = 'ALTER TABLE `#__aicontactsafe_profiles` ADD `captcha_type` tinyint(1) unsigned NOT NULL default \'0\' COMMENT \'0 - aiContactSafe native, 1 - generated by Content - CAPTCHA plugin\' AFTER `use_captcha`;';
	$db->setQuery( $query );
	$db->query();
	$query = 'ALTER TABLE `#__aicontactsafe_profiles` ADD `record_fields` tinyint(1) unsigned NOT NULL default \'0\' COMMENT \'1 - record the fields of the message into the database separately, 0 - do not record the fields of the message into the database separately\' AFTER `record_message`;';
	$db->setQuery( $query );
	$db->query();
	$query = 'ALTER TABLE `#__aicontactsafe_fields` ADD `field_sufix` text NOT NULL COMMENT \'the text to display in front of the field\' AFTER `auto_fill`;';
	$db->setQuery( $query );
	$db->query();
	$query = 'ALTER TABLE `#__aicontactsafe_fields` ADD `field_prefix` text NOT NULL COMMENT \'the text to display after the field\' AFTER `field_sufix`;';
	$db->setQuery( $query );
	$db->query();
	$query = 'ALTER TABLE `#__aicontactsafe_messages` ADD `email_replay` varchar(100) NOT NULL default \'\' COMMENT \'the email address where the reply was sent\' AFTER `profile_id`;';
	$db->setQuery( $query );
	$db->query();
	$query = 'ALTER TABLE `#__aicontactsafe_messages` ADD `subject_replay` text NOT NULL default \'\' COMMENT \'the subject of the reply\' AFTER `email_replay`;';
	$db->setQuery( $query );
	$db->query();
	$query = 'ALTER TABLE `#__aicontactsafe_messages` ADD `message_replay` text NOT NULL default \'\' COMMENT \'the message of the reply\' AFTER `subject_replay`;';
	$db->setQuery( $query );
	$db->query();

// 2.0.6 modifications in database 
	$query = 'ALTER TABLE `jos_aicontactsafe_messages` CHANGE `email_replay` `email_reply` varchar(100) NOT NULL default \'\' COMMENT \'the email address where the reply was sent\';';
	$db->setQuery( $query );
	$db->query();
	$query = 'ALTER TABLE `jos_aicontactsafe_messages` CHANGE `subject_replay` `subject_reply` text NOT NULL default \'\' COMMENT \'the subject of the reply\';';
	$db->setQuery( $query );
	$db->query();
	$query = 'ALTER TABLE `jos_aicontactsafe_messages` CHANGE `message_replay` `message_reply` text NOT NULL default \'\' COMMENT \'the message of the reply\';';
	$db->setQuery( $query );
	$db->query();
	$query = 'ALTER TABLE `#__aicontactsafe_messages` ADD `email_reply` varchar(100) NOT NULL default \'\' COMMENT \'the email address where the reply was sent\' AFTER `profile_id`;';
	$db->setQuery( $query );
	$db->query();
	$query = 'ALTER TABLE `#__aicontactsafe_messages` ADD `subject_reply` text NOT NULL default \'\' COMMENT \'the subject of the reply\' AFTER `email_reply`;';
	$db->setQuery( $query );
	$db->query();
	$query = 'ALTER TABLE `#__aicontactsafe_messages` ADD `message_reply` text NOT NULL default \'\' COMMENT \'the message of the reply\' AFTER `subject_reply`;';
	$db->setQuery( $query );
	$db->query();

// 2.0.7 modifications in database 
	$query = 'ALTER TABLE `#__aicontactsafe_messages` ADD `status_id` int(11) unsigned NOT NULL COMMENT \'status id\' AFTER `profile_id`;';
	$db->setQuery( $query );
	$db->query();
	$query = 'ALTER TABLE `#__aicontactsafe_messages` ADD `manual_status` tinyint(1) unsigned NOT NULL default \'0\' COMMENT \'1 - the status was manually changed, 0 - the status is updated automatically\' AFTER `status_id`;';
	$db->setQuery( $query );
	$db->query();
	$query = 'ALTER TABLE `#__aicontactsafe_messages` ADD `email_destination` text NOT NULL default \'\' COMMENT \'the email addresses where the message was sent\' AFTER `status_id`;';
	$db->setQuery( $query );
	$db->query();
	$query = 'ALTER TABLE `#__aicontactsafe_profiles` ADD `bottom_row_space` int(11) NOT NULL default \'0\' COMMENT \'the space to leave after each row\' AFTER `contact_form_width`;';
	$db->setQuery( $query );
	$db->query();
	$query = 'ALTER TABLE `#__aicontactsafe_profiles` ADD `default_status_id` int(11) unsigned NOT NULL COMMENT \'default status id of the messages received from this profile\' AFTER `use_mail_template`;';
	$db->setQuery( $query );
	$db->query();
	$query = 'ALTER TABLE `#__aicontactsafe_profiles` ADD `read_status_id` int(11) unsigned NOT NULL COMMENT \'status id of the messages after is read\' AFTER `default_status_id`;';
	$db->setQuery( $query );
	$db->query();
	$query = 'ALTER TABLE `#__aicontactsafe_profiles` ADD `reply_status_id` int(11) unsigned NOT NULL COMMENT \'status id of the messages after a reply is sent\' AFTER `read_status_id`;';
	$db->setQuery( $query );
	$db->query();
	$query = 'ALTER TABLE `#__aicontactsafe_profiles` ADD `align_buttons` tinyint(1) unsigned NOT NULL default \'1\' COMMENT \'0 - none, 1 - left, 2 - center, 3 - right\' AFTER `bottom_row_space`;';
	$db->setQuery( $query );
	$db->query();
	$query = 'ALTER TABLE `#__aicontactsafe_profiles` CHANGE `send_to_sender_field_id` `send_to_sender_field_id` INT( 11 ) NOT NULL COMMENT \'id of the field used as send to sender\';';
	$db->setQuery( $query );
	$db->query();

// 2.0.9 modifications in database 
	$query = 'ALTER TABLE `#__aicontactsafe_profiles` ADD `align_captcha` tinyint(1) unsigned NOT NULL default \'1\' COMMENT \'0 - none, 1 - left, 2 - center, 3 - right\' AFTER `captcha_type`;';
	$db->setQuery( $query );
	$db->query();

// 2.0.10 modifications in database 
	$query = 'ALTER TABLE `#__aicontactsafe_messages` ADD `user_id` int(11) NOT NULL default \'0\' COMMENT \'user owner of the message\' AFTER `message_reply`;';
	$db->setQuery( $query );
	$db->query();

// import joomla clases to manage file system
	jimport('joomla.filesystem.folder');
	jimport('joomla.filesystem.file');

// create the folder structure in media folder
	$att_folder = JPATH_ROOT.DS.'media'.DS.'aicontactsafe'.DS.'attachments';
	if (!JFolder::exists($att_folder)) {
		JFolder::create($att_folder);
	}
	$src = JPath::clean(JPATH_ROOT.DS.'administrator'.DS.'components'.DS.'com_aicontactsafe'.DS.'index.html');
	$dest = JPath::clean($att_folder.DS.'index.html');
	if (!JFile::exists($dest)) {
		JFile::copy($src, $dest);
	}
	$src = JPath::clean(JPATH_ROOT.DS.'administrator'.DS.'components'.DS.'com_aicontactsafe'.DS.'includes'.DS.'htaccess'.DS.'.htaccess');
	$dest = JPath::clean($att_folder.DS.'.htaccess');
	if (!JFile::exists($dest)) {
		JFile::copy($src, $dest);
	}

	$css_folder = JPATH_ROOT.DS.'media'.DS.'aicontactsafe'.DS.'cssprofiles';
	if (!JFolder::exists($css_folder)) {
		JFolder::create($css_folder);
	}
	$src = JPath::clean(JPATH_ROOT.DS.'administrator'.DS.'components'.DS.'com_aicontactsafe'.DS.'index.html');
	$dest = JPath::clean($css_folder.DS.'index.html');
	if (!JFile::exists($dest)) {
		JFile::copy($src, $dest);
	}
	$email_folder = JPATH_ROOT.DS.'media'.DS.'aicontactsafe'.DS.'mailtemplates';
	if (!JFolder::exists($email_folder)) {
		JFolder::create($email_folder);
	}
	$src = JPath::clean(JPATH_ROOT.DS.'administrator'.DS.'components'.DS.'com_aicontactsafe'.DS.'index.html');
	$dest = JPath::clean($email_folder.DS.'index.html');
	if (!JFile::exists($dest)) {
		JFile::copy($src, $dest);
	}

	// use_css_backend
	$key = 'use_css_backend';
	$value = '1';
	$query = 'SELECT id FROM `#__aicontactsafe_config` WHERE `config_key` = \'' . $key . '\'';
	$db->setQuery( $query );
	$id = $db->loadResult();
	if ($id == 0) {
		$query = 'INSERT INTO `#__aicontactsafe_config` (`id`, `config_key`, `config_value`) VALUES ( null, \'' . $key . '\', \'' . $value . '\')';
		$db->setQuery( $query );
		$db->query();
	}
	// activate_help
	$key = 'activate_help';
	$value = '1';
	$query = 'SELECT id FROM `#__aicontactsafe_config` WHERE `config_key` = \'' . $key . '\'';
	$db->setQuery( $query );
	$id = $db->loadResult();
	if ($id == 0) {
		$query = 'INSERT INTO `#__aicontactsafe_config` (`id`, `config_key`, `config_value`) VALUES ( null, \'' . $key . '\', \'' . $value . '\')';
		$db->setQuery( $query );
		$db->query();
	}
	// date_format
	$key = 'date_format';
	$value = '%d %B %Y %H:%M';
	$query = 'SELECT id FROM `#__aicontactsafe_config` WHERE `config_key` = \'' . $key . '\'';
	$db->setQuery( $query );
	$id = $db->loadResult();
	if ($id == 0) {
		$query = 'INSERT INTO `#__aicontactsafe_config` (`id`, `config_key`, `config_value`) VALUES ( null, \'' . $key . '\', \'' . $value . '\')';
		$db->setQuery( $query );
		$db->query();
	}
	// default_status_filter
	$key = 'default_status_filter';
	$value = '0';
	$query = 'SELECT id FROM `#__aicontactsafe_config` WHERE `config_key` = \'' . $key . '\'';
	$db->setQuery( $query );
	$id = $db->loadResult();
	if ($id == 0) {
		$query = 'INSERT INTO `#__aicontactsafe_config` (`id`, `config_key`, `config_value`) VALUES ( null, \'' . $key . '\', \'' . $value . '\')';
		$db->setQuery( $query );
		$db->query();
	}
	// editbox_cols
	$key = 'editbox_cols';
	$value = '40';
	$query = 'SELECT id FROM `#__aicontactsafe_config` WHERE `config_key` = \'' . $key . '\'';
	$db->setQuery( $query );
	$id = $db->loadResult();
	if ($id == 0) {
		$query = 'INSERT INTO `#__aicontactsafe_config` (`id`, `config_key`, `config_value`) VALUES ( null, \'' . $key . '\', \'' . $value . '\')';
		$db->setQuery( $query );
		$db->query();
	}
	// editbox_rows
	$key = 'editbox_rows';
	$value = '10';
	$query = 'SELECT id FROM `#__aicontactsafe_config` WHERE `config_key` = \'' . $key . '\'';
	$db->setQuery( $query );
	$id = $db->loadResult();
	if ($id == 0) {
		$query = 'INSERT INTO `#__aicontactsafe_config` (`id`, `config_key`, `config_value`) VALUES ( null, \'' . $key . '\', \'' . $value . '\')';
		$db->setQuery( $query );
		$db->query();
	}
	// default_name
	$key = 'default_name';
	$value = '';
	$query = 'SELECT id FROM `#__aicontactsafe_config` WHERE `config_key` = \'' . $key . '\'';
	$db->setQuery( $query );
	$id = $db->loadResult();
	if ($id == 0) {
		$query = 'INSERT INTO `#__aicontactsafe_config` (`id`, `config_key`, `config_value`) VALUES ( null, \'' . $key . '\', \'' . $value . '\')';
		$db->setQuery( $query );
		$db->query();
	}
	// default_email
	$key = 'default_email';
	$value = '';
	$query = 'SELECT id FROM `#__aicontactsafe_config` WHERE `config_key` = \'' . $key . '\'';
	$db->setQuery( $query );
	$id = $db->loadResult();
	if ($id == 0) {
		$query = 'INSERT INTO `#__aicontactsafe_config` (`id`, `config_key`, `config_value`) VALUES ( null, \'' . $key . '\', \'' . $value . '\')';
		$db->setQuery( $query );
		$db->query();
	}
	// default_subject
	$key = 'default_subject';
	$value = '';
	$query = 'SELECT id FROM `#__aicontactsafe_config` WHERE `config_key` = \'' . $key . '\'';
	$db->setQuery( $query );
	$id = $db->loadResult();
	if ($id == 0) {
		$query = 'INSERT INTO `#__aicontactsafe_config` (`id`, `config_key`, `config_value`) VALUES ( null, \'' . $key . '\', \'' . $value . '\')';
		$db->setQuery( $query );
		$db->query();
	}
	// activate_spam_control
	$key = 'activate_spam_control';
	$value = '0';
	$query = 'SELECT id FROM `#__aicontactsafe_config` WHERE `config_key` = \'' . $key . '\'';
	$db->setQuery( $query );
	$id = $db->loadResult();
	if ($id == 0) {
		$query = 'INSERT INTO `#__aicontactsafe_config` (`id`, `config_key`, `config_value`) VALUES ( null, \'' . $key . '\', \'' . $value . '\')';
		$db->setQuery( $query );
		$db->query();
	}
	// block_words
	$key = 'block_words';
	$value = 'url=';
	$query = 'SELECT id FROM `#__aicontactsafe_config` WHERE `config_key` = \'' . $key . '\'';
	$db->setQuery( $query );
	$id = $db->loadResult();
	if ($id == 0) {
		$query = 'INSERT INTO `#__aicontactsafe_config` (`id`, `config_key`, `config_value`) VALUES ( null, \'' . $key . '\', \'' . $value . '\')';
		$db->setQuery( $query );
		$db->query();
	}
	// record_blocked_messages
	$key = 'record_blocked_messages';
	$value = '1';
	$query = 'SELECT id FROM `#__aicontactsafe_config` WHERE `config_key` = \'' . $key . '\'';
	$db->setQuery( $query );
	$id = $db->loadResult();
	if ($id == 0) {
		$query = 'INSERT INTO `#__aicontactsafe_config` (`id`, `config_key`, `config_value`) VALUES ( null, \'' . $key . '\', \'' . $value . '\')';
		$db->setQuery( $query );
		$db->query();
	}
	// activate_ip_ban
	$key = 'activate_ip_ban';
	$value = '0';
	$query = 'SELECT id FROM `#__aicontactsafe_config` WHERE `config_key` = \'' . $key . '\'';
	$db->setQuery( $query );
	$id = $db->loadResult();
	if ($id == 0) {
		$query = 'INSERT INTO `#__aicontactsafe_config` (`id`, `config_key`, `config_value`) VALUES ( null, \'' . $key . '\', \'' . $value . '\')';
		$db->setQuery( $query );
		$db->query();
	}
	// ban_ips
	$key = 'ban_ips';
	$value = '';
	$query = 'SELECT id FROM `#__aicontactsafe_config` WHERE `config_key` = \'' . $key . '\'';
	$db->setQuery( $query );
	$id = $db->loadResult();
	if ($id == 0) {
		$query = 'INSERT INTO `#__aicontactsafe_config` (`id`, `config_key`, `config_value`) VALUES ( null, \'' . $key . '\', \'' . $value . '\')';
		$db->setQuery( $query );
		$db->query();
	}
	// redirect_ips
	$key = 'redirect_ips';
	$value = '';
	$query = 'SELECT id FROM `#__aicontactsafe_config` WHERE `config_key` = \'' . $key . '\'';
	$db->setQuery( $query );
	$id = $db->loadResult();
	if ($id == 0) {
		$query = 'INSERT INTO `#__aicontactsafe_config` (`id`, `config_key`, `config_value`) VALUES ( null, \'' . $key . '\', \'' . $value . '\')';
		$db->setQuery( $query );
		$db->query();
	}
	// ban_ips_blocked_words
	$key = 'ban_ips_blocked_words';
	$value = '0';
	$query = 'SELECT id FROM `#__aicontactsafe_config` WHERE `config_key` = \'' . $key . '\'';
	$db->setQuery( $query );
	$id = $db->loadResult();
	if ($id == 0) {
		$query = 'INSERT INTO `#__aicontactsafe_config` (`id`, `config_key`, `config_value`) VALUES ( null, \'' . $key . '\', \'' . $value . '\')';
		$db->setQuery( $query );
		$db->query();
	}
	// maximum_messages_ban_ip
	$key = 'maximum_messages_ban_ip';
	$value = '0';
	$query = 'SELECT id FROM `#__aicontactsafe_config` WHERE `config_key` = \'' . $key . '\'';
	$db->setQuery( $query );
	$id = $db->loadResult();
	if ($id == 0) {
		$query = 'INSERT INTO `#__aicontactsafe_config` (`id`, `config_key`, `config_value`) VALUES ( null, \'' . $key . '\', \'' . $value . '\')';
		$db->setQuery( $query );
		$db->query();
	}
	// maximum_minutes_ban_ip
	$key = 'maximum_minutes_ban_ip';
	$value = '0';
	$query = 'SELECT id FROM `#__aicontactsafe_config` WHERE `config_key` = \'' . $key . '\'';
	$db->setQuery( $query );
	$id = $db->loadResult();
	if ($id == 0) {
		$query = 'INSERT INTO `#__aicontactsafe_config` (`id`, `config_key`, `config_value`) VALUES ( null, \'' . $key . '\', \'' . $value . '\')';
		$db->setQuery( $query );
		$db->query();
	}
	// email_ban_ip
	$key = 'email_ban_ip';
	$value = '';
	$query = 'SELECT id FROM `#__aicontactsafe_config` WHERE `config_key` = \'' . $key . '\'';
	$db->setQuery( $query );
	$id = $db->loadResult();
	if ($id == 0) {
		$query = 'INSERT INTO `#__aicontactsafe_config` (`id`, `config_key`, `config_value`) VALUES ( null, \'' . $key . '\', \'' . $value . '\')';
		$db->setQuery( $query );
		$db->query();
	}
	// set_sender_joomla
	$key = 'set_sender_joomla';
	$value = '0';
	$query = 'SELECT id FROM `#__aicontactsafe_config` WHERE `config_key` = \'' . $key . '\'';
	$db->setQuery( $query );
	$id = $db->loadResult();
	if ($id == 0) {
		$query = 'INSERT INTO `#__aicontactsafe_config` (`id`, `config_key`, `config_value`) VALUES ( null, \'' . $key . '\', \'' . $value . '\')';
		$db->setQuery( $query );
		$db->query();
	}
	// upload_attachments
	$key = 'upload_attachments';
	$value = 'media'.DS.'aicontactsafe'.DS.'attachments';
	$value = str_replace('\\','&#92;',$value);
	$query = 'SELECT config_value FROM `#__aicontactsafe_config` WHERE `config_key` = \'' . $key . '\'';
	$db->setQuery( $query );
	$config_value = $db->loadResult();
	if (strlen(trim($config_value)) == 0) {
		$query = 'INSERT INTO `#__aicontactsafe_config` (`id`, `config_key`, `config_value`) VALUES ( null, \'' . $key . '\', \'' . $value . '\')';
		$db->setQuery( $query );
		$db->query();
	} else if (trim($config_value) == 'components&#92;com_aicontactsafe&#92;attachments' || trim($config_value) == 'components'.DS.'com_aicontactsafe'.DS.'attachments') {
		$query = 'UPDATE `#__aicontactsafe_config` SET `config_value` =  \'' . $value . '\' WHERE config_key =  \'' . $key . '\'';
		$db->setQuery( $query );
		$db->query();
	}
	// maximum_size
	$key = 'maximum_size';
	$value = '5000000';
	$query = 'SELECT id FROM `#__aicontactsafe_config` WHERE `config_key` = \'' . $key . '\'';
	$db->setQuery( $query );
	$id = $db->loadResult();
	if ($id == 0) {
		$query = 'INSERT INTO `#__aicontactsafe_config` (`id`, `config_key`, `config_value`) VALUES ( null, \'' . $key . '\', \'' . $value . '\')';
		$db->setQuery( $query );
		$db->query();
	}
	// attachments_types
	$key = 'attachments_types';
	$value = 'rar,zip,doc,xls,txt,gif,jpg,png,bmp';
	$query = 'SELECT id FROM `#__aicontactsafe_config` WHERE `config_key` = \'' . $key . '\'';
	$db->setQuery( $query );
	$id = $db->loadResult();
	if ($id == 0) {
		$query = 'INSERT INTO `#__aicontactsafe_config` (`id`, `config_key`, `config_value`) VALUES ( null, \'' . $key . '\', \'' . $value . '\')';
		$db->setQuery( $query );
		$db->query();
	}
	// attach_to_email
	$key = 'attach_to_email';
	$value = '1';
	$query = 'SELECT id FROM `#__aicontactsafe_config` WHERE `config_key` = \'' . $key . '\'';
	$db->setQuery( $query );
	$id = $db->loadResult();
	if ($id == 0) {
		$query = 'INSERT INTO `#__aicontactsafe_config` (`id`, `config_key`, `config_value`) VALUES ( null, \'' . $key . '\', \'' . $value . '\')';
		$db->setQuery( $query );
		$db->query();
	}
	// delete_after_sent
	$key = 'delete_after_sent';
	$value = '0';
	$query = 'SELECT id FROM `#__aicontactsafe_config` WHERE `config_key` = \'' . $key . '\'';
	$db->setQuery( $query );
	$id = $db->loadResult();
	if ($id == 0) {
		$query = 'INSERT INTO `#__aicontactsafe_config` (`id`, `config_key`, `config_value`) VALUES ( null, \'' . $key . '\', \'' . $value . '\')';
		$db->setQuery( $query );
		$db->query();
	}
	// gid_messages
	$key = 'gid_messages';
	$value = '18';
	$query = 'SELECT id FROM `#__aicontactsafe_config` WHERE `config_key` = \'' . $key . '\'';
	$db->setQuery( $query );
	$id = $db->loadResult();
	if ($id == 0) {
		$query = 'INSERT INTO `#__aicontactsafe_config` (`id`, `config_key`, `config_value`) VALUES ( null, \'' . $key . '\', \'' . $value . '\')';
		$db->setQuery( $query );
		$db->query();
	}
	// users_all_messages
	$key = 'users_all_messages';
	$value = '0';
	$query = 'SELECT id FROM `#__aicontactsafe_config` WHERE `config_key` = \'' . $key . '\'';
	$db->setQuery( $query );
	$id = $db->loadResult();
	if ($id == 0) {
		$query = 'INSERT INTO `#__aicontactsafe_config` (`id`, `config_key`, `config_value`) VALUES ( null, \'' . $key . '\', \'' . $value . '\')';
		$db->setQuery( $query );
		$db->query();
	}
	// user_field_message
	$key = 'user_field_message';
	$value = '0';
	$query = 'SELECT id FROM `#__aicontactsafe_config` WHERE `config_key` = \'' . $key . '\'';
	$db->setQuery( $query );
	$id = $db->loadResult();
	if ($id == 0) {
		$query = 'INSERT INTO `#__aicontactsafe_config` (`id`, `config_key`, `config_value`) VALUES ( null, \'' . $key . '\', \'' . $value . '\')';
		$db->setQuery( $query );
		$db->query();
	}

	// add default profile
	$query = 'SELECT id FROM `#__aicontactsafe_profiles` WHERE `set_default` = 1';
	$db->setQuery( $query );
	$id = $db->loadResult();
	if ($id == 0) {
		$query = 'INSERT INTO `#__aicontactsafe_profiles` (`id`, `name`, `use_message_css`, `contact_form_width`, `contact_info_width`, `use_captcha`, `email_address`, `always_send_to_email_address`, `subject_prefix`, `record_message`, `custom_date_format`, `custom_date_years_back`, `custom_date_years_forward`, `required_field_mark`, `display_format`, `set_default`, `active_fields`, `captcha_width`, `captcha_height`, `captcha_bgcolor`, `captcha_backgroundTransparent`, `captcha_colors`, `name_field_id`, `email_field_id`, `subject_field_id`, `send_to_sender_field_id`, `date_added`, `last_update`, `published`, `checked_out`, `checked_out_time`) VALUES (1, \'Default form\', 1, 0, 0, 1, \'\', 1, \'\', 1, \'%d %B %Y\', 60, 0, \'( ! )\', 2, 1, \'0\', 300, 55, \'#FFFFFF\', 1, \'#FF0000;#00FF00;#0000FF\', 1, 2, 4, 6, \'2009-01-01 00:00:00\', \'2009-01-01 00:00:00\', 1, 0, \'0000-00-00\');';
		$db->setQuery( $query );
		$db->query();

		$query = 'INSERT INTO `#__aicontactsafe_profiles` (`id`, `name`, `use_message_css`, `contact_form_width`, `contact_info_width`, `use_captcha`, `email_address`, `always_send_to_email_address`, `subject_prefix`, `record_message`, `custom_date_format`, `custom_date_years_back`, `custom_date_years_forward`, `required_field_mark`, `display_format`, `set_default`, `active_fields`, `captcha_width`, `captcha_height`, `captcha_bgcolor`, `captcha_backgroundTransparent`, `captcha_colors`, `name_field_id`, `email_field_id`, `subject_field_id`, `send_to_sender_field_id`, `date_added`, `last_update`, `published`, `checked_out`, `checked_out_time`) VALUES (2, \'Module form\', 1, 0, 0, 1, \'\', 1, \'\', 1, \'%d %B %Y\', 60, 0, \'( ! )\', 1, 0, \'0\', 180, 55, \'#FFFFFF\', 1, \'#FF0000;#00FF00;#0000FF\', 1, 2, 4, 6, \'2009-01-01 00:00:00\', \'2009-01-01 00:00:00\', 1, 0, \'0000-00-00\');';
		$db->setQuery( $query );
		$db->query();
	}

	// check all profiles for profile's CSS and mail templates
	$query = 'SELECT id FROM `#__aicontactsafe_profiles`';
	$db->setQuery( $query );
	$profiles = $db->loadObjectList();
	foreach($profiles as $profile) {
		// add the profile's CSS if not already there
		$src_file = JPath::clean(JPATH_ROOT.DS.'components'.DS.'com_aicontactsafe'.DS.'views'.DS.'message'.DS.'tmpl'.DS.'profile_align_margin.css');
		$dst_file = JPath::clean(JPATH_ROOT.DS.'media'.DS.'aicontactsafe'.DS.'cssprofiles'.DS.'profile_css_'.$profile->id.'.css');
		if (!is_file($dst_file)) {
			$profile_css_code = JFile::read($src_file);
			$profile_css_code = str_replace('aiContactSafe_mainbody_1','aiContactSafe_mainbody_'.$profile->id,$profile_css_code);
			JFile::write($dst_file, $profile_css_code);
		}
		// add the profile's mail template if not already there
		$src_file = JPath::clean(JPATH_ROOT.DS.'components'.DS.'com_aicontactsafe'.DS.'views'.DS.'mail'.DS.'tmpl'.DS.'mail.php');
		$dst_file = JPath::clean(JPATH_ROOT.DS.'media'.DS.'aicontactsafe'.DS.'mailtemplates'.DS.'mail_'.$profile->id.'.php');
		if (!is_file($dst_file)) {
			JFile::copy($src_file, $dst_file);
		}
		
	}

	// insert default statuses if none were added
	$query = 'SELECT id FROM `#__aicontactsafe_statuses`;';
	$db->setQuery( $query );
	$id = $db->loadResult();
	if ($id == 0) {
		$query = 'INSERT INTO `#__aicontactsafe_statuses` (`id`, `name`, `ordering`, `color`, `date_added`, `last_update`, `published`, `checked_out`, `checked_out_time`) VALUES
							(1, \'New\', 1, \'#FF0000\', now(), now(), 1, 0, \'0000-00-00\'),
							(2, \'Read\', 2, \'#000000\', now(), now(), 1, 0, \'0000-00-00\'),
							(3, \'Replied\', 3, \'#009900\', now(), now(), 1, 0, \'0000-00-00\'),
							(4, \'Archived\', 4, \'#CCCCCC\', now(), now(), 1, 0, \'0000-00-00\');';
		$db->setQuery( $query );
		$db->query();
	}
	// set the default status on the profiles
	$query = 'UPDATE `#__aicontactsafe_profiles` SET `default_status_id` = 1 WHERE `default_status_id` = 0';
	$db->setQuery( $query );
	$db->query();
	$query = 'UPDATE `#__aicontactsafe_profiles` SET `read_status_id` = 2 WHERE `read_status_id` = 0';
	$db->setQuery( $query );
	$db->query();
	$query = 'UPDATE `#__aicontactsafe_profiles` SET `reply_status_id` = 3 WHERE `reply_status_id` = 0';
	$db->setQuery( $query );
	$db->query();


	// add fields if the table is empty
	$query = 'SELECT count(*) as fields FROM `#__aicontactsafe_fields`';
	$db->setQuery( $query );
	$count = $db->loadResult();
	if ($count == 0) {
		$query = 'INSERT INTO `#__aicontactsafe_fields` (`id`, `name`, `field_label`, `label_parameters`, `field_label_message`, `label_message_parameters`, `label_after_field`, `field_type`, `field_parameters`, `field_values`, `auto_fill`, `field_limit`, `ordering`, `field_required`, `field_in_message`, `send_message`, `date_added`, `last_update`, `published`, `checked_out`, `checked_out_time`) VALUES
											   (1, \'aics_name\', \'Name\', \'\', \'Name\', \'\', 0, \'TX\', "class=\'textbox\'", \'\', \'UN\', 0, 1, 1, 1, 0, now(), now(), 1, 0, \'0000-00-00\'),
											   (2, \'aics_email\', \'Email\', \'\', \'Email\', \'\', 0, \'EM\', "class=\'email\'", \'\', \'UE\', 0, 2, 1, 1, 0, now(), now(), 1, 0, \'0000-00-00\'),
											   (3, \'aics_phone\', \'Phone\', \'\', \'Phone\', \'\', 0, \'TX\', "class=\'textbox\'", \'\', \'\', 15, 3, 0, 1, 0, now(), now(), 1, 0, \'0000-00-00\'),
											   (4, \'aics_subject\', \'Subject\', \'\', \'Subject\', \'\', 0, \'TX\', "class=\'textbox\'", \'\', \'\', 0, 4, 1, 1, 0, now(), now(), 1, 0, \'0000-00-00\'),
											   (5, \'aics_message\', \'Message\', \'\', \'Message\', \'\', 0, \'ED\', "class=\'editbox\'", \'\', \'\', 500, 5, 1, 1, 0, now(), now(), 1, 0, \'0000-00-00\'),
											   (6, \'aics_send_to_sender\', \'Send a copy of this message to yourself\', \'\', \'Send a copy of this message to yourself\', \'\', 1, \'CK\', "class=\'checkbox\'", \'\', \'\', 0, 6, 0, 0, 0, now(), now(), 1, 0, \'0000-00-00\');';
		$db->setQuery( $query );
		$db->query();
	}

	// add contact_info
	// contact information
	$key = 'contact_info';
	$query = 'SELECT id FROM `#__aicontactsafe_contactinformations` WHERE `info_key` = \'' . $key . '\'';
	$db->setQuery( $query );
	$id = $db->loadResult();
	if ($id == 0) {
		$value = '<img style="margin-left: 10px; float: right;" alt="articles" src="images/stories/articles.jpg" width="128" height="96" /><div style="width: 150px; float: left;">Algis Info SRL<br />Str. Hărmanului Nr.63<br />bl.1A sc.A ap.8<br />Brașov, România<br />500232<br /><a target="_blank" href="http://www.algis.ro/">www.algis.ro</a></div>';
		$query = 'INSERT INTO `#__aicontactsafe_contactinformations` (`id`, `profile_id`, `info_key`, `info_label`, `info_value`) VALUES ( null, 1, \'' . $key . '\', \'' . $key . '\', \'' . $value . '\')';
		$db->setQuery( $query );
		$db->query();

		$value = '<div style="width: 150px; float: left;">Algis Info SRL<br />Str. Hărmanului Nr.63<br />bl.1A sc.A ap.8<br />Brașov, România<br />500232<br /><a target="_blank" href="http://www.algis.ro/">www.algis.ro</a></div>';
		$query = 'INSERT INTO `#__aicontactsafe_contactinformations` (`id`, `profile_id`, `info_key`, `info_label`, `info_value`) VALUES ( null, 2, \'' . $key . '\', \'' . $key . '\', \'' . $value . '\')';
		$db->setQuery( $query );
		$db->query();
	}
	// meta_description
	$key = 'meta_description';
	$query = 'SELECT id FROM `#__aicontactsafe_contactinformations` WHERE `info_key` = \'' . $key . '\'';
	$db->setQuery( $query );
	$id = $db->loadResult();
	if ($id == 0) {
		$value = '';
		$query = 'INSERT INTO `#__aicontactsafe_contactinformations` (`id`, `profile_id`, `info_key`, `info_label`, `info_value`) VALUES ( null, 1, \'' . $key . '\', \'' . $key . '\', \'' . $value . '\')';
		$db->setQuery( $query );
		$db->query();

		$value = '';
		$query = 'INSERT INTO `#__aicontactsafe_contactinformations` (`id`, `profile_id`, `info_key`, `info_label`, `info_value`) VALUES ( null, 2, \'' . $key . '\', \'' . $key . '\', \'' . $value . '\')';
		$db->setQuery( $query );
		$db->query();
	}
	// meta_keywords
	$key = 'meta_keywords';
	$query = 'SELECT id FROM `#__aicontactsafe_contactinformations` WHERE `info_key` = \'' . $key . '\'';
	$db->setQuery( $query );
	$id = $db->loadResult();
	if ($id == 0) {
		$value = '';
		$query = 'INSERT INTO `#__aicontactsafe_contactinformations` (`id`, `profile_id`, `info_key`, `info_label`, `info_value`) VALUES ( null, 1, \'' . $key . '\', \'' . $key . '\', \'' . $value . '\')';
		$db->setQuery( $query );
		$db->query();

		$value = '';
		$query = 'INSERT INTO `#__aicontactsafe_contactinformations` (`id`, `profile_id`, `info_key`, `info_label`, `info_value`) VALUES ( null, 2, \'' . $key . '\', \'' . $key . '\', \'' . $value . '\')';
		$db->setQuery( $query );
		$db->query();
	}
	// meta_robots
	$key = 'meta_robots';
	$query = 'SELECT id FROM `#__aicontactsafe_contactinformations` WHERE `info_key` = \'' . $key . '\'';
	$db->setQuery( $query );
	$id = $db->loadResult();
	if ($id == 0) {
		$value = '';
		$query = 'INSERT INTO `#__aicontactsafe_contactinformations` (`id`, `profile_id`, `info_key`, `info_label`, `info_value`) VALUES ( null, 1, \'' . $key . '\', \'' . $key . '\', \'' . $value . '\')';
		$db->setQuery( $query );
		$db->query();

		$value = '';
		$query = 'INSERT INTO `#__aicontactsafe_contactinformations` (`id`, `profile_id`, `info_key`, `info_label`, `info_value`) VALUES ( null, 2, \'' . $key . '\', \'' . $key . '\', \'' . $value . '\')';
		$db->setQuery( $query );
		$db->query();
	}
	// thank_you_message
	$key = 'thank_you_message';
	$query = 'SELECT id FROM `#__aicontactsafe_contactinformations` WHERE `info_key` = \'' . $key . '\'';
	$db->setQuery( $query );
	$id = $db->loadResult();
	if ($id == 0) {
		$value = 'Email sent. Thank you for your message.';
		$query = 'INSERT INTO `#__aicontactsafe_contactinformations` (`id`, `profile_id`, `info_key`, `info_label`, `info_value`) VALUES ( null, 1, \'' . $key . '\', \'' . $key . '\', \'' . $value . '\')';
		$db->setQuery( $query );
		$db->query();

		$value = 'Email sent. Thank you for your message.';
		$query = 'INSERT INTO `#__aicontactsafe_contactinformations` (`id`, `profile_id`, `info_key`, `info_label`, `info_value`) VALUES ( null, 2, \'' . $key . '\', \'' . $key . '\', \'' . $value . '\')';
		$db->setQuery( $query );
		$db->query();
	}
	// required_field_notification
	$key = 'required_field_notification';
	$query = 'SELECT id FROM `#__aicontactsafe_contactinformations` WHERE `info_key` = \'' . $key . '\'';
	$db->setQuery( $query );
	$id = $db->loadResult();
	if ($id == 0) {
		$value = 'Fields marked with %mark% are required.';
		$query = 'INSERT INTO `#__aicontactsafe_contactinformations` (`id`, `profile_id`, `info_key`, `info_label`, `info_value`) VALUES ( null, 1, \'' . $key . '\', \'' . $key . '\', \'' . $value . '\')';
		$db->setQuery( $query );
		$db->query();

		$value = 'Fields marked with %mark% are required.';
		$query = 'INSERT INTO `#__aicontactsafe_contactinformations` (`id`, `profile_id`, `info_key`, `info_label`, `info_value`) VALUES ( null, 2, \'' . $key . '\', \'' . $key . '\', \'' . $value . '\')';
		$db->setQuery( $query );
		$db->query();
	}

	// copy joomfish contentelements
	$contentelements = JPath::clean(JPATH_ROOT.DS.'administrator'.DS.'components'.DS.'com_joomfish'.DS.'contentelements');
	if (is_dir($contentelements)) {
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

	// copy artio plugin
	$artio = JPath::clean(JPATH_ROOT.DS.'components'.DS.'com_sef'.DS.'sef_ext');
	if (is_dir($artio)) {
		$src = JPath::clean(JPATH_ROOT.DS.'administrator'.DS.'components'.DS.'com_aicontactsafe'.DS.'includes'.DS.'artio'.DS.'com_aicontactsafe.php');
		$dest = JPath::clean(JPATH_ROOT.DS.'components'.DS.'com_sef'.DS.'sef_ext'.DS.'com_aicontactsafe.php');
		JFile::copy($src, $dest);
		$src = JPath::clean(JPATH_ROOT.DS.'administrator'.DS.'components'.DS.'com_aicontactsafe'.DS.'includes'.DS.'artio'.DS.'com_aicontactsafe.xml');
		$dest = JPath::clean(JPATH_ROOT.DS.'components'.DS.'com_sef'.DS.'sef_ext'.DS.'com_aicontactsafe.xml');
		JFile::copy($src, $dest);
	}

	// restore menu link
	$query = 'SELECT id FROM `#__components` WHERE `name` = \'aiContactSafe\'';
	$db->setQuery( $query );
	$aiContactSafe_id = $db->loadResult();
	
	$query = 'UPDATE `#__menu` SET componentid = '.$aiContactSafe_id.' WHERE substr(link,1,34) = \'index.php?option=com_aicontactsafe\' AND type = \'component\'';
	$db->setQuery( $query );
	$db->query();

?>
	<div class="header">Congratulations, aiContactSafe is now installed!</div>
	<br/>
	<br/>
	<table border="0" cellpadding="0" cellspacing="0" width="100%">
		<tr>
			<td width="50%" valign="top">
				<img src="<?php echo JURI::root().'administrator/components/com_aicontactsafe/images/logo.gif' ;?>" border="0" /><br/>
				<br/>
				A contact form system developed by <a href="http://www.algis.ro/" target="_blank">Algis Info</a>, released under a <a href="http://www.gnu.org/licenses/gpl-2.0.html" target="_blank">GNU/GPL License</a>.<br/>
				<?php echo JText::_( 'Version' ); ?>&nbsp;<?php echo $_version; ?><br/>
				Programmer : Alexandru Dobrin &lt;alex@algis.ro&gt;<br/><br/>
				<br/>
			</td>
			<td width="50%" valign="top">
				<h3>Credits</h3><br/>
				<br/>
				<b>CAPTCHA system</b> : <br/>
				- developed by Jose Rodriguez &lt;jose.rodriguez@exec.cl&gt;<br/>
				- implemented in joomla by Alexandru Dobrin &lt;alex@algis.ro&gt;<br/>
				<br>
				You can download the original version here : <a href="http://code.google.com/p/cool-php-captcha" target="_blank">http://code.google.com/p/cool-php-captcha</a>.<br/>
				<br/>
				<b>Icons pack</b> : <br/>
				- made by Freeiconsdownload from <a href="http://www.freeiconsweb.com" target="_blank">www.freeiconsweb.com</a><br/>
				- adapted and implemented in aiContactSafe by Alexandru Dobrin &lt;alex@algis.ro&gt;<br/>
				<br/>
				<b>Bulgarian translation</b> : <br/>- Eli Jeleva <a href="http://harrisonroyce.com" target="_blank">harrisonroyce.com</a><br/>
				<br/>
				<b>Czech translation</b> : <br/>- Martin Halík<br/>
				<br/>
				<b>Danish translation</b> : <br/>- Kenneth Wiess Wood <a href="http://www.weiss-wood.dk" target="_blank">www.weiss-wood.dk</a><br/>
				<br/>
				<b>German translation</b> : <br/>- Pawel Koch <a href="http://www.le5.ch" target="_blank">www.le5.ch</a><br/>
				<br/>
				<b>Greek translation</b> : <br/>- Themistoklis Georgiadis <a href="http://www.globalinfoweb.com" target="_blank">www.globalinfoweb.com</a><br/>
				<br/>
				<b>English translation</b> : <br/>- Nic Irvine <a href="http://www.swanshops.com" target="_blank">www.swanshops.com</a><br/>
				<br/>
				<b>Spanish translation</b> : <br/>- Pablo Soto <a href="http://www.tecnoartestudio.com" target="_blank">www.tecnoartestudio.com</a><br/>
				<br/>
				<b>French translation</b> : <br/>- Denis Gravel <a href="http://www.csmissionnaires.org" target="_blank">www.csmissionnaires.org</a><br/>
				<br/>
				<b>Italian translation</b> : <br/>- Fabrizio Degni <a href="http://www.trioptimumcorporation.com" target="_blank">www.trioptimumcorporation.com</a><br/>
				<br/>
				<b>Dutch translation</b> : <br/>- Christof Vandewalle <a href="http://www.plus-it.be" target="_blank">www.plus-it.be</a><br/>
				<br/>
				<b>Polish translation</b> : <br/>- Krzysztof Machelski <a href="http://www.clearsoft.pl" target="_blank">www.clearsoft.pl</a><br/>
				<br/>
				<b>Brazilian Portuguese translation</b> : <br/>- Stefan Halbscheffel <a href="http://www.halbscheffel.eu" target="_blank">www.halbscheffel.eu</a><br/>
				<br/>
				<b>Russian translation</b> : <br/>- Gruz <a href="http://ukrstyle.com" target="_blank">www.ukrstyle.com</a><br/>
				<br/>
				<b>Slovak translation</b> : <br/>- Peter Tanuska<br/>
				<br/>
				<b>Serbian (Cyrillic) translation</b> : <br/>- krca437<br/>
				<br/>
				<b>Swedish translation</b> : <br/>- Janne Sandgren <a href="http://www.hippijannessilverringar.se" target="_blank">www.hippijannessilverringar.se</a><br/>
				<br/>
				<b>Turkish translation</b> : <br/>- Kazım Çolpan <a href="http://www.tatlisubalikavi.net" target="_blank">www.tatlisubalikavi.net</a><br/>
				<br/>
				<b>Ukrainian translation</b> : <br/>- Gruz <a href="http://ukrstyle.com" target="_blank">www.ukrstyle.com</a><br/>
				<br/>
				<br/>
			</td>
		</tr>
	</table>
<?php
}
?>
