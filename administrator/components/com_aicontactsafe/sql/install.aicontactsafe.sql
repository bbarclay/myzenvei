-- #__aicontactsafe_config
CREATE TABLE IF NOT EXISTS `#__aicontactsafe_config` (
  `id` int(11) unsigned NOT NULL auto_increment COMMENT 'config id',
  `config_key` varchar(50) NOT NULL default '' COMMENT 'the key of the config variable',
  `config_value` text NOT NULL COMMENT 'the value of the config variable',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8 COMMENT='Configuration table of aiContactSafe';


-- #__aicontactsafe_fields
CREATE TABLE IF NOT EXISTS `#__aicontactsafe_fields` (
  `id` int(11) unsigned NOT NULL auto_increment COMMENT 'field id',
  `name` varchar(50) NOT NULL default '' COMMENT 'the name of the field',
  `field_label` text NOT NULL COMMENT 'the label of the field',
  `label_parameters` text NOT NULL COMMENT 'the parameters of the html label tag',
  `field_label_message` text NOT NULL COMMENT 'the label of the field in the message',
  `label_message_parameters` text NOT NULL COMMENT 'the parameters of the html label in the message tag',
  `label_after_field` tinyint(1) unsigned NOT NULL default '0' COMMENT '1 - the label is placed after the field, 0 - the label is placed before the field',
  `field_type` varchar(2) NOT NULL default 'TX' COMMENT 'type of the field',
  `field_parameters` text NOT NULL COMMENT 'the parameters of the html tag',
  `field_values` text NOT NULL COMMENT 'the values used in a combobox in case this is the type of the field',
  `field_limit` int(11) NOT NULL default '0' COMMENT 'the limit of the text fields, use 0 for unlimited',
  `default_value` varchar(150) NOT NULL default '' COMMENT 'the default value of the field',
  `auto_fill` varchar(10) NOT NULL default '' COMMENT 'specify the source for auto fill UN - joomla user name, UE - joomla user email',
  `field_sufix` text NOT NULL COMMENT 'the text to display in front of the field',
  `field_prefix` text NOT NULL COMMENT 'the text to display after the field',
  `ordering` int(11) NOT NULL default '0' COMMENT 'the order of the fields in the contact form',
  `field_required` tinyint(1) unsigned NOT NULL default '0' COMMENT '1 - field is required, 0 - field is not required',
  `field_in_message` tinyint(1) unsigned NOT NULL default '1' COMMENT '1 - field is added in the message, 0 - field is not added in the message',
  `send_message` tinyint(1) unsigned NOT NULL default '0' COMMENT 'this is used only for email fields : 1 - the message is sent to this address, 0 - the message is not sent to this address',
  `date_added` datetime NOT NULL default '0000-00-00 00:00:00' COMMENT 'date when record was inserted',
  `last_update` datetime NOT NULL default '0000-00-00 00:00:00' COMMENT 'date when this record was last updated',
  `published` tinyint(1) unsigned NOT NULL default '1' COMMENT '1 - published, 0 - unpublished',
  `checked_out` tinyint(1) unsigned NOT NULL default '0' COMMENT '1 - element in edit, 0 - elemnt safe for edit',
  `checked_out_time` date NOT NULL default '0000-00-00',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8 COMMENT='Fields used by aiContactSafe';


-- #__aicontactsafe_contactinformations
CREATE TABLE IF NOT EXISTS `#__aicontactsafe_contactinformations` (
  `id` int(11) unsigned NOT NULL auto_increment COMMENT 'info id',
  `profile_id` int(11) unsigned NOT NULL COMMENT 'profile id',
  `info_key` varchar(50) NOT NULL default '' COMMENT 'the key of the info variable',
  `info_label` varchar(250) NOT NULL default '' COMMENT 'the label of the info variable',
  `info_value` text NOT NULL COMMENT 'the value of the info variable',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8 COMMENT='Contact information table displayed by aiContactSafe';


-- #__aicontactsafe_messages
CREATE TABLE IF NOT EXISTS `#__aicontactsafe_messages` (
  `id` int(11) unsigned NOT NULL auto_increment COMMENT 'message id',
  `name` varchar(50) NOT NULL default '' COMMENT 'the name of the person who sent the message',
  `email` varchar(100) NOT NULL default '' COMMENT 'the email address of the person who sent the message',
  `subject` varchar(200) NOT NULL default '' COMMENT 'the subject of the message',
  `message` text NOT NULL default '' COMMENT 'the text of the message',
  `send_to_sender` tinyint(1) unsigned NOT NULL default '0' COMMENT '1 - the message was sent to the sender also, 0 - the message was not sent to the sender also',
  `sender_ip` varchar(20) NOT NULL default '' COMMENT 'the ip from which the message was sent',
  `profile_id` int(11) unsigned NOT NULL COMMENT 'profile id',
  `status_id` int(11) unsigned NOT NULL COMMENT 'status id',
  `manual_status` tinyint(1) unsigned NOT NULL default '0' COMMENT '1 - the status was manually changed, 0 - the status is updated automatically',
  `email_destination` text NOT NULL default '' COMMENT 'the email addresses where the message was sent',
  `email_reply` varchar(100) NOT NULL default '' COMMENT 'the email address where the reply was sent',
  `subject_reply` text NOT NULL default '' COMMENT 'the subject of the reply',
  `message_reply` text NOT NULL default '' COMMENT 'the message of the reply',
  `user_id` int(11) NOT NULL default '0' COMMENT 'user owner of the message',
  `date_added` datetime NOT NULL default '0000-00-00 00:00:00' COMMENT 'date when record was inserted',
  `last_update` datetime NOT NULL default '0000-00-00 00:00:00' COMMENT 'date when this record was last updated',
  `published` tinyint(1) unsigned NOT NULL default '1' COMMENT '1 - published, 0 - unpublished',
  `checked_out` tinyint(1) unsigned NOT NULL default '0' COMMENT '1 - element in edit, 0 - elemnt safe for edit',
  `checked_out_time` date NOT NULL default '0000-00-00',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8 COMMENT='messages received by aiContactSafe';


-- #__aicontactsafe_profiles
CREATE TABLE IF NOT EXISTS `#__aicontactsafe_profiles` (
  `id` int(11) unsigned NOT NULL auto_increment COMMENT 'profile id',
  `name` varchar(50) NOT NULL default '' COMMENT 'the name of the profile',
  `use_ajax` tinyint(1) unsigned NOT NULL default '0' COMMENT '1 - ajax is used, 0 - ajax is not used',
  `use_message_css` tinyint(1) unsigned NOT NULL default '0' COMMENT '1 - message.css is loaded, 0 - message.css is not loaded',
  `contact_form_width` int(11) NOT NULL default '0' COMMENT 'the width of the contact form',
  `bottom_row_space` int(11) NOT NULL default '0' COMMENT 'the space to leave after each row',
  `align_buttons` tinyint(1) unsigned NOT NULL default '1' COMMENT '0 - none, 1 - left, 2 - center, 3 - right',
  `contact_info_width` int(11) NOT NULL default '0' COMMENT 'the width of the contact information',
  `use_captcha` tinyint(1) unsigned NOT NULL default '1' COMMENT '2 - captcha is used only for unregistered users, 1 - captcha is always used, 0 - captcha is not used',
  `captcha_type` tinyint(1) unsigned NOT NULL default '0' COMMENT '0 - aiContactSafe native, 1 - generated by Content - CAPTCHA plugin',
  `align_captcha` tinyint(1) unsigned NOT NULL default '1' COMMENT '0 - none, 1 - left, 2 - center, 3 - right',
  `email_address` varchar(100) NOT NULL default '' COMMENT 'the email address',
  `always_send_to_email_address` tinyint(1) unsigned NOT NULL default '1' COMMENT '1 - captcha is used, 0 - captcha is not used',
  `subject_prefix` varchar(100) NOT NULL default '' COMMENT 'the subject prefix of the email message',
  `email_mode` tinyint(1) unsigned NOT NULL default '1' COMMENT '1 - html, 0 - plain text',
  `record_message` tinyint(1) unsigned NOT NULL default '1' COMMENT '1 - record the message into the database, 0 - do not record the message into the database',
  `record_fields` tinyint(1) unsigned NOT NULL default '0' COMMENT '1 - record the fields of the message into the database separately, 0 - do not record the fields of the message into the database separately',
  `custom_date_format` varchar(30) NOT NULL default '%d %B %Y' COMMENT 'the format of custom date fields',
  `custom_date_years_back` int(11) NOT NULL default '70' COMMENT 'the last years to add to the year combobox',
  `custom_date_years_forward` int(11) NOT NULL default '0' COMMENT 'the next years to add to the year combobox',
  `required_field_mark` text NOT NULL COMMENT 'the string to mark the required fields',
  `display_format` int(11) NOT NULL default '2' COMMENT 'the display format of the contact form',
  `plg_contact_info` tinyint(1) unsigned NOT NULL default '0' COMMENT '1 - activate plugins on contact information',
  `use_random_letters` tinyint(1) unsigned NOT NULL default '0' COMMENT '1 - use random letters for the CAPTCHA code',
  `min_word_length` tinyint(2) unsigned NOT NULL default '5' COMMENT 'minimum word length for random CAPTCHA code',
  `max_word_length` tinyint(2) unsigned NOT NULL default '8' COMMENT 'maximum word length for random CAPTCHA code',
  `set_default` tinyint(1) unsigned NOT NULL default '0' COMMENT '1 - default profile',
  `active_fields` text NOT NULL COMMENT 'the active fields of this profile',
  `captcha_width` smallint(4) NOT NULL default '400' COMMENT 'captcha width',
  `captcha_height` smallint(4) NOT NULL default '55' COMMENT 'captcha height',
  `captcha_bgcolor` varchar(10) NOT NULL default '#FFFFFF' COMMENT 'the background color of captcha',
  `captcha_backgroundTransparent` tinyint(1) unsigned NOT NULL default '1' COMMENT '1 - captcha background transparent',
  `captcha_colors` text NOT NULL COMMENT 'the colors of text in captcha',
  `name_field_id` int(11) unsigned NOT NULL COMMENT 'id of the field used as name',
  `email_field_id` int(11) unsigned NOT NULL COMMENT 'id of the field used as email',
  `subject_field_id` int(11) unsigned NOT NULL COMMENT 'id of the field used as subject',
  `send_to_sender_field_id` int(11) unsigned NOT NULL COMMENT 'id of the field used as send to sender',
  `redirect_on_success` text NOT NULL COMMENT 'the url to redirect the web page on success',
  `fields_order` text NOT NULL COMMENT 'the order of the fields for the current profile',
  `use_mail_template` tinyint(1) unsigned NOT NULL default '0' COMMENT '1 - mail template is used, 0 - mail template is not used',
  `default_status_id` int(11) unsigned NOT NULL COMMENT 'default status id of the messages received from this profile',
  `read_status_id` int(11) unsigned NOT NULL COMMENT 'status id of the messages after is read',
  `reply_status_id` int(11) unsigned NOT NULL COMMENT 'status id of the messages after a reply is sent',
  `date_added` datetime NOT NULL default '0000-00-00 00:00:00' COMMENT 'date when record was inserted',
  `last_update` datetime NOT NULL default '0000-00-00 00:00:00' COMMENT 'date when this record was last updated',
  `published` tinyint(1) unsigned NOT NULL default '1' COMMENT '1 - published, 0 - unpublished',
  `checked_out` tinyint(1) unsigned NOT NULL default '0' COMMENT '1 - element in edit, 0 - elemnt safe for edit',
  `checked_out_time` date NOT NULL default '0000-00-00',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8 COMMENT='Profiles used by aiContactSafe';


-- #__aicontactsafe_messagefiles
CREATE TABLE IF NOT EXISTS `#__aicontactsafe_messagefiles` (
  `id` int(11) unsigned NOT NULL auto_increment COMMENT 'file id',
  `message_id` int(11) unsigned NOT NULL COMMENT 'message id',
  `name` text NOT NULL COMMENT 'the name of the file',
  `r_id` int(21) unsigned NOT NULL COMMENT 'requests id',
  `date_added` datetime NOT NULL default '0000-00-00 00:00:00' COMMENT 'date when record was inserted',
  `last_update` datetime NOT NULL default '0000-00-00 00:00:00' COMMENT 'date when this record was last updated',
  `published` tinyint(1) unsigned NOT NULL default '1' COMMENT '1 - published, 0 - unpublished',
  `checked_out` tinyint(1) unsigned NOT NULL default '0' COMMENT '1 - element in edit, 0 - elemnt safe for edit',
  `checked_out_time` date NOT NULL default '0000-00-00',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8 COMMENT='Files attached to the messages';


-- #__aicontactsafe_fieldvalues
CREATE TABLE IF NOT EXISTS `#__aicontactsafe_fieldvalues` (
  `id` int(11) unsigned NOT NULL auto_increment COMMENT 'data id',
  `field_id` int(11) unsigned NOT NULL COMMENT 'field id',
  `message_id` int(11) unsigned NOT NULL COMMENT 'message id',
  `field_value` text NOT NULL COMMENT 'the value entered into the field',
  `date_added` datetime NOT NULL default '0000-00-00 00:00:00' COMMENT 'date when record was inserted',
  `last_update` datetime NOT NULL default '0000-00-00 00:00:00' COMMENT 'date when this record was last updated',
  `published` tinyint(1) unsigned NOT NULL default '1' COMMENT '1 - published, 0 - unpublished',
  `checked_out` tinyint(1) unsigned NOT NULL default '0' COMMENT '1 - element in edit, 0 - elemnt safe for edit',
  `checked_out_time` date NOT NULL default '0000-00-00',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8 COMMENT='Values of the fields entered into the contact form';


-- #__aicontactsafe_statuses
CREATE TABLE IF NOT EXISTS `#__aicontactsafe_statuses` (
  `id` int(11) unsigned NOT NULL auto_increment COMMENT 'status id',
  `name` varchar(20) NOT NULL default '' COMMENT 'the status name',
  `color` varchar(10) NOT NULL default '#FFFFFF' COMMENT 'the color of the message when it has this status',
  `ordering` int(11) NOT NULL default '0' COMMENT 'the order of the statuses',
  `date_added` datetime NOT NULL default '0000-00-00 00:00:00' COMMENT 'date when record was inserted',
  `last_update` datetime NOT NULL default '0000-00-00 00:00:00' COMMENT 'date when this record was last updated',
  `published` tinyint(1) unsigned NOT NULL default '1' COMMENT '1 - published, 0 - unpublished',
  `checked_out` tinyint(1) unsigned NOT NULL default '0' COMMENT '1 - element in edit, 0 - elemnt safe for edit',
  `checked_out_time` date NOT NULL default '0000-00-00',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8 COMMENT='Contact information table displayed by aiContactSafe';

