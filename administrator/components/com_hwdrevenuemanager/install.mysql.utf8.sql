CREATE TABLE IF NOT EXISTS `#__hwdrm_vs_settings` (
  `id` int(50) NOT NULL auto_increment,
  `setting` varchar(250) default NULL,
  `value` text,
  PRIMARY KEY  (`id`)
) TYPE=MyISAM CHARACTER SET `utf8` COLLATE `utf8_general_ci`;

INSERT IGNORE INTO `#__hwdrm_vs_settings` (`id`, `setting`, `value`) 
VALUES (1, 'ad1show', ''),
(2, 'ad1_ad_client', ''),
(3, 'ad1_ad_channel', ''),
(4, 'ad1_ad_type', ''),
(5, 'ad1_ad_uifeatures', ''),
(6, 'ad1_ad_format', ''),
(7, 'ad1_color_border1', ''),
(8, 'ad1_color_bg1', ''),
(9, 'ad1_color_link1', ''),
(10, 'ad1_color_text1', ''),
(11, 'ad1_color_url1', ''),
(12, 'ad1custom', ''),
(13, 'ad2show', ''),
(14, 'ad2_ad_client', ''),
(15, 'ad2_ad_channel', ''),
(16, 'ad2_ad_type', ''),
(17, 'ad2_ad_uifeatures', ''),
(18, 'ad2_ad_format', ''),
(19, 'ad2_color_border1', ''),
(20, 'ad2_color_bg1', ''),
(21, 'ad2_color_link1', ''),
(22, 'ad2_color_text1', ''),
(23, 'ad2_color_url1', ''),
(24, 'ad2custom', ''),
(25, 'ad3show', ''),
(26, 'ad3_ad_client', ''),
(27, 'ad3_ad_channel', ''),
(28, 'ad3_ad_type', ''),
(29, 'ad3_ad_uifeatures', ''),
(30, 'ad3_ad_format', ''),
(31, 'ad3_color_border1', ''),
(32, 'ad3_color_bg1', ''),
(33, 'ad3_color_link1', ''),
(34, 'ad3_color_text1', ''),
(35, 'ad3_color_url1', ''),
(36, 'ad3custom', ''),
(37, 'ad4show', ''),
(38, 'ad4_ad_client', ''),
(39, 'ad4_ad_channel', ''),
(40, 'ad4_ad_type', ''),
(41, 'ad4_ad_uifeatures', ''),
(42, 'ad4_ad_format', ''),
(43, 'ad4_color_border1', ''),
(44, 'ad4_color_bg1', ''),
(45, 'ad4_color_link1', ''),
(46, 'ad4_color_text1', ''),
(47, 'ad4_color_url1', ''),
(48, 'ad4custom', ''),
(49, 'ad5show', ''),
(50, 'ad5_ad_client', ''),
(51, 'ad5_ad_channel', ''),
(52, 'ad5_ad_type', ''),
(53, 'ad5_ad_uifeatures', ''),
(54, 'ad5_ad_format', ''),
(55, 'ad5_color_border1', ''),
(56, 'ad5_color_bg1', ''),
(57, 'ad5_color_link1', ''),
(58, 'ad5_color_text1', ''),
(59, 'ad5_color_url1', ''),
(60, 'ad5custom', ''),
(61, 'ad6show', ''),
(62, 'ad6_ad_client', ''),
(63, 'ad6_ad_channel', ''),
(64, 'ad6_ad_type', ''),
(65, 'ad6_ad_uifeatures', ''),
(66, 'ad6_ad_format', ''),
(67, 'ad6_color_border1', ''),
(68, 'ad6_color_bg1', ''),
(69, 'ad6_color_link1', ''),
(70, 'ad6_color_text1', ''),
(71, 'ad6_color_url1', ''),
(72, 'ad6custom', ''),
(73, 'ad7show', ''),
(74, 'ad7_ad_client', ''),
(75, 'ad7_ad_channel', ''),
(76, 'ad7_ad_type', ''),
(77, 'ad7_ad_uifeatures', ''),
(78, 'ad7_ad_format', ''),
(79, 'ad7_color_border1', ''),
(80, 'ad7_color_bg1', ''),
(81, 'ad7_color_link1', ''),
(82, 'ad7_color_text1', ''),
(83, 'ad7_color_url1', ''),
(84, 'ad7custom', ''),
(85, 'ad8show', ''),
(86, 'ad8_ad_client', ''),
(87, 'ad8_ad_channel', ''),
(88, 'ad8_ad_type', ''),
(89, 'ad8_ad_uifeatures', ''),
(90, 'ad8_ad_format', ''),
(91, 'ad8_color_border1', ''),
(92, 'ad8_color_bg1', ''),
(93, 'ad8_color_link1', ''),
(94, 'ad8_color_text1', ''),
(95, 'ad8_color_url1', ''),
(96, 'ad8custom', ''),
(97, 'preroll_url', ''),				
(98, 'postroll_url', ''),		
(99, 'preroll_show', '0'),		
(100, 'postroll_show', '0'),
(101, 'enable_longtail', '0'),
(102, 'longtail_channel_default', ''),
(103, 'longtail_d', ''),
(104, 'longtail_s', '');

CREATE TABLE IF NOT EXISTS `#__hwdrm_ps_settings` (
  `id` int(50) NOT NULL auto_increment,
  `setting` varchar(250) default NULL,
  `value` text,
  PRIMARY KEY  (`id`)
) TYPE=MyISAM CHARACTER SET `utf8` COLLATE `utf8_general_ci`;

INSERT IGNORE INTO `#__hwdrm_ps_settings` (`id`, `setting`, `value`) 
VALUES (1, 'ad1show', ''),
(2, 'ad1_ad_client', ''),
(3, 'ad1_ad_channel', ''),
(4, 'ad1_ad_type', ''),
(5, 'ad1_ad_uifeatures', ''),
(6, 'ad1_ad_format', ''),
(7, 'ad1_color_border1', ''),
(8, 'ad1_color_bg1', ''),
(9, 'ad1_color_link1', ''),
(10, 'ad1_color_text1', ''),
(11, 'ad1_color_url1', ''),
(12, 'ad1custom', ''),
(13, 'ad2show', ''),
(14, 'ad2_ad_client', ''),
(15, 'ad2_ad_channel', ''),
(16, 'ad2_ad_type', ''),
(17, 'ad2_ad_uifeatures', ''),
(18, 'ad2_ad_format', ''),
(19, 'ad2_color_border1', ''),
(20, 'ad2_color_bg1', ''),
(21, 'ad2_color_link1', ''),
(22, 'ad2_color_text1', ''),
(23, 'ad2_color_url1', ''),
(24, 'ad2custom', ''),
(25, 'ad3show', ''),
(26, 'ad3_ad_client', ''),
(27, 'ad3_ad_channel', ''),
(28, 'ad3_ad_type', ''),
(29, 'ad3_ad_uifeatures', ''),
(30, 'ad3_ad_format', ''),
(31, 'ad3_color_border1', ''),
(32, 'ad3_color_bg1', ''),
(33, 'ad3_color_link1', ''),
(34, 'ad3_color_text1', ''),
(35, 'ad3_color_url1', ''),
(36, 'ad3custom', ''),
(37, 'ad4show', ''),
(38, 'ad4_ad_client', ''),
(39, 'ad4_ad_channel', ''),
(40, 'ad4_ad_type', ''),
(41, 'ad4_ad_uifeatures', ''),
(42, 'ad4_ad_format', ''),
(43, 'ad4_color_border1', ''),
(44, 'ad4_color_bg1', ''),
(45, 'ad4_color_link1', ''),
(46, 'ad4_color_text1', ''),
(47, 'ad4_color_url1', ''),
(48, 'ad4custom', ''),
(49, 'ad5show', ''),
(50, 'ad5_ad_client', ''),
(51, 'ad5_ad_channel', ''),
(52, 'ad5_ad_type', ''),
(53, 'ad5_ad_uifeatures', ''),
(54, 'ad5_ad_format', ''),
(55, 'ad5_color_border1', ''),
(56, 'ad5_color_bg1', ''),
(57, 'ad5_color_link1', ''),
(58, 'ad5_color_text1', ''),
(59, 'ad5_color_url1', ''),
(60, 'ad5custom', ''),
(61, 'ad6show', ''),
(62, 'ad6_ad_client', ''),
(63, 'ad6_ad_channel', ''),
(64, 'ad6_ad_type', ''),
(65, 'ad6_ad_uifeatures', ''),
(66, 'ad6_ad_format', ''),
(67, 'ad6_color_border1', ''),
(68, 'ad6_color_bg1', ''),
(69, 'ad6_color_link1', ''),
(70, 'ad6_color_text1', ''),
(71, 'ad6_color_url1', ''),
(72, 'ad6custom', ''),
(73, 'ad7show', ''),
(74, 'ad7_ad_client', ''),
(75, 'ad7_ad_channel', ''),
(76, 'ad7_ad_type', ''),
(77, 'ad7_ad_uifeatures', ''),
(78, 'ad7_ad_format', ''),
(79, 'ad7_color_border1', ''),
(80, 'ad7_color_bg1', ''),
(81, 'ad7_color_link1', ''),
(82, 'ad7_color_text1', ''),
(83, 'ad7_color_url1', ''),
(84, 'ad7custom', ''),
(85, 'ad8show', ''),
(86, 'ad8_ad_client', ''),
(87, 'ad8_ad_channel', ''),
(88, 'ad8_ad_type', ''),
(89, 'ad8_ad_uifeatures', ''),
(90, 'ad8_ad_format', ''),
(91, 'ad8_color_border1', ''),
(92, 'ad8_color_bg1', ''),
(93, 'ad8_color_link1', ''),
(94, 'ad8_color_text1', ''),
(95, 'ad8_color_url1', ''),
(96, 'ad8custom', '');

CREATE TABLE IF NOT EXISTS `#__hwdrm_vads` (
  `id` int(50) NOT NULL auto_increment,
  `type` tinyint(1) NOT NULL default '0',
  `url` varchar(250) default NULL,
  `priority` tinyint(1) NOT NULL default '5',
  `impressions` int(11) NOT NULL default '0',
  `date_activate` datetime NOT NULL default '0000-00-00 00:00:00',
  `date_deactivate` datetime NOT NULL default '3000-00-00 00:00:00',
  `impression_limit` int(11) NOT NULL default '1000000',
  `ordering` int(50) NOT NULL default '0',
  `checked_out` int(11) NOT NULL default '0',
  `checked_out_time` datetime NOT NULL default '0000-00-00 00:00:00',
  `published` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) TYPE=MyISAM CHARACTER SET `utf8` COLLATE `utf8_general_ci`;