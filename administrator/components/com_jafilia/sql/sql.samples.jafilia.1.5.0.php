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
   
//insert default or/and example data

   $query = "INSERT INTO `#__jafilia_banner` (`title`,`version`,`text`,`published`)
VALUES
('Text link example', 'text', 'Your first Jafilia affiliate link :)',1);";

   $db->setQuery($query);
   if( ! $db->query() )
   {
      echo $img_ERROR.JText::_('Unable to insert samples').$BR;
      echo $db->getErrorMsg();
      return FALSE;
   }
/*
--  `jos_jafilia_clicks`
*/

   $query = "INSERT INTO `#__jafilia_clicks` (`id`, `uid`, `referer`, `ip`, `date`) VALUES
(1, 9999, 'http://127.0.0.1/samplehost1/', '127.0.0.1', '2009-06-28 14:46:07'),
(2, 9999, 'http://127.0.0.1/samplehost1/', '127.0.0.1', '2009-06-29 14:47:07'),
(3, 9999, 'http://127.0.0.1/samplehost2/', '127.0.0.1', '2009-06-30 14:58:40'); ";  

   $db->setQuery($query);
   if( ! $db->query() )
   {
      echo $img_ERROR.JText::_('Unable to insert samples').$BR;
      echo $db->getErrorMsg();
      return FALSE;
   }   
   
/*
-- `jos_jafilia_sales`
*/

   $query = "INSERT INTO `jos_jafilia_sales` (`id`, `uid`, `version`, `order`, `sale`, `status`, `date`, `paid`) VALUES
(1, 9999, 'click', 0, '5', 'approved', '2009-06-28 14:44:07', 0),
(2, 9999, 'click', 0, '5', 'approved', '2009-06-29 14:46:07', 0),
(3, 9999, 'click', 0, '5', 'approved', '2009-06-30 14:58:40', 0);";

   $db->setQuery($query);
   if( ! $db->query() )
   {
      echo $img_ERROR.JText::_('Unable to insert samples').$BR;
      echo $db->getErrorMsg();
      return FALSE;
   }  

/*
-- `jos_jafilia_user`
*/

   $query = "INSERT INTO `jos_jafilia_user` (`id`, `uid`, `firstname`, `lastname`, `street`, `zipcode`, `location`, `mail`, `fon`, `url`, `bank`, `blz`, `konto`, `published`, `paypal`, `state`) VALUES
(1, 9999, 'testusername', 'testuserlastname', 'test street', '00-999', 'mars', 'testmail@testdomain.com', '123456789', 'www.testurloftestuser.com', 'bank1', 77777777777, 5555555555555, 1, '', '');";


   $db->setQuery($query);
   if( ! $db->query() )
   {
      echo $img_ERROR.JText::_('Unable to insert samples').$BR;
      echo $db->getErrorMsg();
      return FALSE;
   } 
   
   if( $errors ) {
      return FALSE;
   }   
   return TRUE;	   
?>