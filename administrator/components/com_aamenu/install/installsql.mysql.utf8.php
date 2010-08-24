-- <?php /** $Id: installsql.mysql.utf8.php 17 2009-05-15 07:09:42Z eddieajau $ */ defined('_JEXEC') or die() ?>;

CREATE TABLE IF NOT EXISTS `#__taoj` (
  `id` int(10) NOT NULL auto_increment,
  `extension` varchar(100) NOT NULL COMMENT 'The extension',
  `version` varchar(16) NOT NULL COMMENT 'Version number',
  `installed_date` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP COMMENT 'Date-time modified or installed',
  `log` mediumtext,
  PRIMARY KEY  USING BTREE (`id`),
  KEY `idx_extension` (`extension`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='The Art of Joomla extension version history';

CREATE TABLE IF NOT EXISTS `#__taoj_aamenu_tags` (
  `component_id` INT UNSIGNED NOT NULL DEFAULT 0,
  `tag` VARCHAR(50) NOT NULL,
  `ordering` INT NOT NULL DEFAULT 0,
  INDEX idx_tags(`tag`, `ordering`)
) ENGINE = MyISAM CHARACTER SET utf8;
