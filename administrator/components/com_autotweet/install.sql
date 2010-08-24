CREATE TABLE IF NOT EXISTS `#__autotweet` (
  `id` int(11) NOT NULL auto_increment,
  `postdate` datetime,
  `publish_up` datetime,
  `message` varchar(255),
  `url` varchar(255),
  `articleid` int(11),
  `attempts` int(2),
  `published` tinyint(1),   
  `pubstate` enum('success','error','pending') NOT NULL default 'pending',  
  `resultmsg` varchar(255),
  `source` varchar(30), 
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `#__autotweet_automator`;

CREATE TABLE `#__autotweet_automator` (
  `id` int(11) NOT NULL,
  `lastexec` timestamp,
   PRIMARY KEY  (`id`) 
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `#__autotweet_automator`
	(`id`, `lastexec`) VALUES (1, '0000-00-00 00:00:00');