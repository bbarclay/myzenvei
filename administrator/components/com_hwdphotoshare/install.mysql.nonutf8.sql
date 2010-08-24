CREATE TABLE IF NOT EXISTS `#__hwdpscategories` (
  `id` int(50) NOT NULL auto_increment,
  `parent` int(50) NOT NULL default '0',
  `category_name` varchar(250) default NULL,
  `category_description` text,
  `date` datetime NOT NULL default '0000-00-00 00:00:00',
  `access_b_v` tinyint(1) NOT NULL default '0',
  `access_u_r` varchar(7) NOT NULL default 'RECURSE',
  `access_v_r` varchar(7) NOT NULL default 'RECURSE',
  `access_u` int(11) NOT NULL default '-2',
  `access_lev_u` varchar(250) NOT NULL default '0,1',
  `access_v` int(11) NOT NULL default '-2',
  `access_lev_v` varchar(250) NOT NULL default '0,1',
  `num_albums` int(50) NOT NULL default '0',
  `num_subcats` int(50) NOT NULL default '0',
  `ordering` int(50) NOT NULL default '0',
  `checked_out` int(11) NOT NULL default '0',
  `checked_out_time` datetime NOT NULL default '0000-00-00 00:00:00',
  `published` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) TYPE=MyISAM AUTO_INCREMENT=12 ;

CREATE TABLE IF NOT EXISTS `#__hwdpsfavorites` (
  `id` int(50) NOT NULL auto_increment,
  `userid` int(50) default NULL,
  `photoid` int(50) default NULL,
  `date` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id`)
) TYPE=MyISAM AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `#__hwdpsflagged_photos` (
  `id` int(50) NOT NULL auto_increment,
  `userid` int(50) default NULL,
  `photoid` int(50) default NULL,
  `status` varchar(250) NOT NULL default 'Unread',
  `ignore` tinyint(1) NOT NULL default '0',
  `date` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id`)
) TYPE=MyISAM AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `#__hwdpsflagged_albums` (
  `id` int(50) NOT NULL auto_increment,
  `userid` int(50) default NULL,
  `albumid` int(50) default NULL,
  `status` varchar(250) NOT NULL default 'Unread',
  `ignore` tinyint(1) NOT NULL default '0',
  `date` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id`)
) TYPE=MyISAM AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `#__hwdpsflagged_groups` (
  `id` int(50) NOT NULL auto_increment,
  `userid` int(50) default NULL,
  `groupid` int(50) default NULL,
  `status` varchar(250) NOT NULL default 'Unread',
  `ignore` tinyint(1) NOT NULL default '0',
  `date` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id`)
) TYPE=MyISAM AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `#__hwdpsgroup_membership` (
  `id` int(50) NOT NULL auto_increment,
  `memberid` int(50) default NULL,
  `date` datetime NOT NULL default '0000-00-00 00:00:00',
  `groupid` int(50) default NULL,
  `approved` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) TYPE=MyISAM AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `#__hwdpsgroups` (
  `id` int(50) NOT NULL auto_increment,
  `group_name` text,
  `privacy` varchar(250) NOT NULL default 'public',
  `date` datetime NOT NULL default '0000-00-00 00:00:00',
  `allow_comments` tinyint(1) NOT NULL default '0',
  `require_approval` tinyint(1) NOT NULL default '0',
  `group_description` text,
  `featured` tinyint(1) NOT NULL default '0',
  `adminid` int(50) default NULL,
  `total_members` int(50) default '0',
  `total_photos` int(50) default '0',
  `ordering` int(50) NOT NULL default '0',
  `checked_out` int(11) NOT NULL default '0',
  `checked_out_time` datetime NOT NULL default '0000-00-00 00:00:00',
  `published` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  FULLTEXT (`group_name`,`group_description`)
) TYPE=MyISAM AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `#__hwdpsgroup_photos` (
  `id` int(50) NOT NULL auto_increment,
  `photoid` int(50) default NULL,
  `groupid` int(50) default NULL,
  `memberid` int(50) default NULL,
  `date` datetime NOT NULL default '0000-00-00 00:00:00',
  `published` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) TYPE=MyISAM AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `#__hwdpsrating` (
  `id` int(50) NOT NULL auto_increment,
  `userid` int(50) default NULL,
  `photoid` int(50) default NULL,
  `ip` varchar(15) NOT NULL default '192.168.100.1',
  `date` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id`)
) TYPE=MyISAM AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `#__hwdpsphotos` (
  `id` int(50) NOT NULL auto_increment,
  `photo_type` varchar(250) default NULL,
  `photo_id` varchar(250) default NULL,
  `thumb_id` varchar(250) default NULL,
  `album_id` int(50) NOT NULL default '0',
  `category_id` int(50) NOT NULL default '0',
  `title` text,
  `caption` text,
  `tags` text,
  `date_uploaded` datetime NOT NULL default '0000-00-00 00:00:00',
  `location` text,
  `allow_comments` tinyint(1) NOT NULL default '0',
  `allow_ratings` tinyint(1) NOT NULL default '0',
  `rating_number_votes` int(50) NOT NULL default '0',
  `rating_total_points` int(50) NOT NULL default '0',
  `updated_rating` float(4,2) NOT NULL default '0',
  `privacy` varchar(250) NOT NULL default 'public',
  `approved` varchar(250) NOT NULL default 'pending',
  `number_of_views` int(50) NOT NULL default '0',
  `user_id` int(50) NOT NULL default '0',
  `setcover` tinyint(1) NOT NULL default '0',
  `original_type` varchar(4) NOT NULL default 'jpg',
  `featured` tinyint(1) NOT NULL default '0',
  `ordering` int(50) NOT NULL default '0',
  `checked_out` int(11) NOT NULL default '0',
  `checked_out_time` datetime NOT NULL default '0000-00-00 00:00:00',
  `published` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  FULLTEXT (`title`,`tags`,`caption`)
) TYPE=MyISAM AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `#__hwdpsalbums` (
  `id` int(50) NOT NULL auto_increment,
  `title` text,
  `description` text,
  `tags` text,
  `category_id` int(50) default NULL,
  `date_created` datetime NOT NULL default '0000-00-00 00:00:00',
  `date_modified` datetime NOT NULL default '0000-00-00 00:00:00',
  `location` text,
  `allow_comments` tinyint(1) NOT NULL default '0',
  `allow_ratings` tinyint(1) NOT NULL default '0',
  `privacy` varchar(250) default NULL,
  `approved` varchar(250) default NULL,
  `user_id` int(50) default NULL,
  `number_of_photos` int(50) default 0,
  `featured` tinyint(1) NOT NULL default '0',
  `ordering` int(50) NOT NULL default '0',
  `checked_out` int(11) NOT NULL default '0',
  `checked_out_time` datetime NOT NULL default '0000-00-00 00:00:00',
  `published` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  FULLTEXT (`title`,`tags`,`description`)
) TYPE=MyISAM AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `#__hwdpsplugin` ( 
  `id` int( 11 ) NOT NULL AUTO_INCREMENT , 
  `name` varchar( 100 ) NOT NULL default '', 
  `element` varchar( 100 ) NOT NULL default '', 
  `type` varchar( 100 ) NULL default '', 
  `folder` varchar( 100 ) NULL default '', 
  `access` tinyint( 3 ) unsigned NOT NULL default '0', 
  `ordering` int( 11 ) NOT NULL default '0', 
  `published` tinyint( 3 ) NOT NULL default '0', 
  `iscore` tinyint( 3 ) NOT NULL default '0', 
  `client_id` tinyint( 3 ) NOT NULL default '0', 
  `checked_out` int( 11 ) unsigned NOT NULL default '0', 
  `checked_out_time` datetime NOT NULL default '0000-00-00 00:00:00', 
  `website` text NOT NULL default '',
  `playlist_compat` tinyint(1) NOT NULL default '0', 
  `params` text NOT NULL , PRIMARY KEY ( `id` ) , 
  KEY `idx_folder` ( `published` , `client_id` , `access` , `folder` ) 
) TYPE=MyISAM AUTO_INCREMENT=500;

CREATE TABLE IF NOT EXISTS `#__hwdpsgs` (
  `id` int(50) NOT NULL auto_increment,
  `setting` varchar(250) default NULL,
  `value` text,
  PRIMARY KEY  (`id`)
) TYPE=MyISAM AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `#__hwdpslogs_views` (
  `id` int(50) NOT NULL auto_increment,
  `photoid` int(50) NOT NULL default '0',
  `userid` int(50) NOT NULL default '0',
  `date` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id`)
) TYPE=MyISAM AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `#__hwdpslogs_votes` (
  `id` int(50) NOT NULL auto_increment,
  `photoid` int(50) NOT NULL default '0',
  `userid` int(50) NOT NULL default '0',
  `vote` int(50) NOT NULL default '0',
  `date` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id`)
) TYPE=MyISAM AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `#__hwdpslogs_favours` (
  `id` int(50) NOT NULL auto_increment,
  `photoid` int(50) NOT NULL default '0',
  `userid` int(50) NOT NULL default '0',
  `date` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id`)
) TYPE=MyISAM AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `#__hwdpslogs_archive` (
  `id` int(50) NOT NULL auto_increment,
  `photoid` varchar(250) default NULL,
  `views` int(50) NOT NULL default '0',
  `number_of_votes` int(50) NOT NULL default '0',
  `sum_of_votes` int(50) NOT NULL default '0',
  `rating` int(50) NOT NULL default '0',
  `favours` int(50) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) TYPE=MyISAM AUTO_INCREMENT=1 ;

INSERT IGNORE INTO `#__hwdpsgs` (`id`, `setting`, `value`) 
VALUES (1, 'hwdvids_template_path', 'hwdps-template'),
(2, 'hwdvids_template_file', 'default'),
(3, 'hwdps_slideshow_path', 'hwdps-slideshow'),
(4, 'hwdps_slideshow_file', 'autoviewer'),
(5, 'hwdvids_language_path', 'hwdps-language'),
(6, 'hwdvids_language_file', 'english'),		
(7, 'disable_nav_explor', '0'),
(8, 'disable_nav_groups', '0'),
(9, 'disable_nav_upload', '0'),		
(10, 'disable_nav_search', '0'),
(11, 'disable_nav_user', '0'),
(12, 'disable_nav_user1', '0'),
(13, 'disable_nav_user2', '0'),
(14, 'disable_nav_user3', '0'),
(15, 'disable_nav_user4', '0'),
(16, 'disable_nav_user5', '0'),		
(17, 'ppp', '12'),
(18, 'ppr', '3'),
(19, 'app', '12'),
(20, 'apr', '3'),
(21, 'showrate', '1'),
(22, 'showatfb', '1'),
(23, 'showrpmb', '1'),
(24, 'showcoms', '1'),
(25, 'showdesc', '1'),
(26, 'showtags', '1'),
(27, 'showscbm', '1'),
(28, 'showuldr', '0'),
(29, 'mbtu_no', '0'),
(30, 'showa2gb', '1'),
(31, 'showdlor', '1'),
(32, 'ajaxratemeth', '1'),
(33, 'ajaxfavmeth', '1'),
(34, 'ajaxrepmeth', '1'),
(35, 'ajaxa2gmeth', '1'),
(36, 'gpp', '5'),
(37, 'fgpp', '3'),
(38, 'truntitle', '25'),		
(39, 'trunpdesc', '70'),
(40, 'trunadesc', '70'),
(41, 'truncdesc', '200'),
(42, 'trungdesc', '70'),
(43, 'sb_digg', 'on'),
(44, 'sb_reddit', 'on'),
(45, 'sb_delicious', 'on'),
(46, 'sb_google', 'on'),
(47, 'sb_live', 'on'),
(48, 'sb_facebook', 'on'),
(49, 'sb_slashdot', 'on'),
(50, 'sb_netscape', 'on'),
(51, 'sb_technorati', 'on'),
(52, 'sb_stumbleupon', 'on'),
(53, 'sb_spurl', 'on'),
(54, 'sb_wists', 'on'),
(55, 'sb_simpy', 'on'),
(56, 'sb_newsvine', 'on'),
(57, 'sb_blinklist', 'on'),
(58, 'sb_furl', 'on'),
(59, 'sb_fark', 'on'),
(60, 'sb_blogmarks', 'on'),
(61, 'sb_yahoo', 'on'),
(62, 'sb_smarking', 'on'),
(63, 'sb_netvouz', 'on'),
(64, 'sb_shadows', 'on'),
(65, 'sb_rawsugar', 'on'),
(66, 'sb_magnolia', 'on'),
(67, 'sb_plugim', 'on'),
(68, 'sb_squidoo', 'on'),
(69, 'sb_blogmemes', 'on'),
(70, 'sb_feedmelinks', 'on'),
(71, 'sb_blinkbits', 'on'),
(72, 'sb_tailrank', 'on'),
(73, 'sb_linkagogo', 'on'),		
(74, 'loadmootools', 'on'),
(75, 'loadprototype', 'off'),
(76, 'loadscriptaculous', 'off'),
(77, 'loadswfobject', 'off'),		
(78, 'disablecaptcha', '1'),
(79, 'showcredit', '1'),
(80, 'usershare1', '1'),
(81, 'shareoption1', '1'),
(82, 'usershare2', '1'),
(83, 'shareoption2', '1'),
(84, 'usershare3', '1'),
(85, 'shareoption3', '1'),
(86, 'usershare4', '1'),
(87, 'shareoption4', '1'),		
(88, 'aap', '1'),
(89, 'aaa', '1'),
(90, 'aag', '1'),
(91, 'resize_main', '500'),
(92, 'resize_thumb', '100'),
(93, 'resize_square', '100'),
(94, 'mailphotonotification', '0'),
(95, 'mailalbumnotification', '0'),
(96, 'mailgroupnotification', '0'),
(97, 'mailreportnotification', '0'),
(98, 'mailnotifyaddress', ''),		
(99, 'cbint', '0'),
(100, 'cbavatar', '1'),
(101, 'avatarwidth', '61'),
(102, 'cbitemid', '0'),
(103, 'commssys', '0'),
(104, 'gjint', ''),
(105, 'jaclint', '0'),
(106, 'gtree_core', '-2'),
(107, 'gtree_core_child', 'RECURSE'),
(108, 'accesslevel_main', '0,1'),
(109, 'access_method', '0'),
(110, 'initialise_now', '1'),
(111, 'disablejupload', '0'),
(112, 'core_uploadlimit', '50'),
(113, 'gtree_upld', '-1'),
(114, 'gtree_upld_child', 'RECURSE'),
(115, 'upld_cats', '0'),
(116, 'disable_nav_catego', '0'),
(117, 'fp_nos', '4'),	
(118, 'fp_noa', '2'),
(119, 'fp_showt', '1'),
(120, 'fp_showg', '1');