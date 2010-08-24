<?php
/**
 * @version $Id: header.php 789 2009-01-26 15:56:03Z elkuku $
 * @package    Jafilia
 * @subpackage
 * @author     EasyJoomla {@link http://www.easy-joomla.org Easy-Joomla.org}
 * @author     Arkadiusz Maniecki {@link http://www.jafilia.pl}
 * @author     Created on 08-Apr-2009
 */

//--No direct access
defined( '_JEXEC' ) or die( '=;)' );

/**
 * Main installer
 */
   //--install...
   $db = & JFactory::getDBO();
   $BR = '<br />';
   $query = "CREATE TABLE `#__jafilia_banner` (
  `id` int(11) NOT NULL auto_increment,
  `title` varchar(25) NOT NULL,
  `version` varchar(10) NOT NULL,
  `text` varchar(50) NOT NULL,
  `image` varchar(30) NOT NULL,
  `published` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;";
   $db->setQuery($query);
   if( ! $db->query() )
   {
      echo $img_ERROR.JText::_('Unable to create table').$BR;
      echo $db->getErrorMsg();
      return FALSE;
   }

   $query = "CREATE TABLE `#__jafilia_clicks` (
  `id` int(20) unsigned NOT NULL auto_increment,
			  `uid` int(10) unsigned NOT NULL,
			  `referer` varchar(255) NOT NULL,
			  `ip` varchar(25) NOT NULL,
			  `date` datetime NOT NULL default '0000-00-00 00:00:00',
			  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;";
   $db->setQuery($query);
   if( ! $db->query() )
   {
      echo $img_ERROR.JText::_('Unable to create table').$BR;
      echo $db->getErrorMsg();
      return FALSE;
   }

   $query = "CREATE TABLE `#__jafilia_payings` (
`id` int(10) NOT NULL auto_increment,
			  `uid` int(10) NOT NULL,
			  `amount` varchar(20) NOT NULL,
			  `status` varchar(20) NOT NULL,
			  `date` datetime NOT NULL default '0000-00-00 00:00:00',
			  `method` varchar(10) NOT NULL,
			  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;";
   $db->setQuery($query);
   if( ! $db->query() )
   {
      echo $img_ERROR.JText::_('Unable to create table').$BR;
      echo $db->getErrorMsg();
      return FALSE;
   }

   $query = "CREATE TABLE `#__jafilia_sales` (
`id` int(10) NOT NULL auto_increment,
			  `uid` int(10) NOT NULL,
			  `version` varchar(10) NOT NULL,
			  `order` int(10) NOT NULL,
			  `sale` varchar(10) NOT NULL,
			  `status` varchar(10) NOT NULL,
			  `date` datetime NOT NULL default '0000-00-00 00:00:00',
			  `paid` int(11) NOT NULL default '0',
			  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;";
   $db->setQuery($query);
   if( ! $db->query() )
   {
      echo $img_ERROR.JText::_('Unable to create table').$BR;
      echo $db->getErrorMsg();
      return FALSE;
   }      

   $query = "CREATE TABLE `#__jafilia_user` (
`id` int(10) unsigned NOT NULL auto_increment,
			  `uid` int(10) unsigned NOT NULL,
			  `firstname` varchar(20) NOT NULL,
			  `lastname` varchar(20) NOT NULL,
			  `street` varchar(30) NOT NULL,
			  `zipcode` varchar(10) NOT NULL,
			  `location` varchar(30) NOT NULL,
			  `mail` varchar(25) NOT NULL,
			  `fon` varchar(25) NOT NULL,
			  `url` varchar(40) NOT NULL,
			  `bank` varchar(30) NOT NULL,
			  `blz` int(20) NOT NULL,
			  `konto` int(20) NOT NULL,
			  `published` tinyint(1) NOT NULL default '0',
			  `paypal` varchar(25) NOT NULL,
  			  `state` varchar(10) NOT NULL,
			  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;";
   $db->setQuery($query);
   if( ! $db->query() )
   {
      echo $img_ERROR.JText::_('Unable to create table').$BR;
      echo $db->getErrorMsg();
      return FALSE;
   } 

$query = "CREATE TABLE `#__jafilia_campaigns` (
`id` int(10) unsigned NOT NULL auto_increment,
`title` varchar(30) NOT NULL,
`version` tinyint(1) NOT NULL,
`ppcvalue` double NOT NULL,
`fpsvalue` double NOT NULL,
`fplvalue` double NOT NULL,
`payout` double NOT NULL,
`chartscolor` varchar(20) NOT NULL,
`template` varchar(20) NOT NULL,
`desc` text NOT NULL,
`terms` text NOT NULL,
`startdate` date NOT NULL,
`enddate` date NOT NULL,
`published` tinyint(1) NOT NULL default '0',
PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;";

   $db->setQuery($query);
   if( ! $db->query() )
   {
      echo $img_ERROR.JText::_('Unable to create table').$BR;
      echo $db->getErrorMsg();
      return FALSE;
   } 

?>