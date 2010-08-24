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
   $errors = FALSE;
   
   $BR = '<br />';

   //--install...
   $db = & JFactory::getDBO();
   
   $query = "DROP TABLE IF EXISTS `#__jafilia_banner`;";
   $db->setQuery($query);
   if( ! $db->query() )
   {
      echo $img_ERROR.JText::_('Unable to DROP table').$BR;
      echo $db->getErrorMsg();
      return FALSE;
   }

   $query = "DROP TABLE IF EXISTS `#__jafilia_clicks`;";
   $db->setQuery($query);
   if( ! $db->query() )
   {
      echo $img_ERROR.JText::_('Unable to DROP table').$BR;
      echo $db->getErrorMsg();
      return FALSE;
   }

   $query = "DROP TABLE IF EXISTS `#__jafilia_payings`;";
   $db->setQuery($query);
   if( ! $db->query() )
   {
      echo $img_ERROR.JText::_('Unable to DROP table').$BR;
      echo $db->getErrorMsg();
      return FALSE;
   }

   $query = "DROP TABLE IF EXISTS `#__jafilia_sales`;";
   $db->setQuery($query);
   if( ! $db->query() )
   {
      echo $img_ERROR.JText::_('Unable to DROP table').$BR;
      echo $db->getErrorMsg();
      return FALSE;
   }

   $query = "DROP TABLE IF EXISTS `#__jafilia_user`;";
   $db->setQuery($query);
   if( ! $db->query() )
   {
      echo $img_ERROR.JText::_('Unable to DROP table').$BR;
      echo $db->getErrorMsg();
      return FALSE;
   }

   $query = "DROP TABLE IF EXISTS `#__jafilia_campaigns`;";
   $db->setQuery($query);
   if( ! $db->query() )
   {
      echo $img_ERROR.JText::_('Unable to drop table').$BR;
      echo $db->getErrorMsg();
      return FALSE;
   }
  
   if( $errors )
   {
      return FALSE;
   }
   
   return TRUE;
?>