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

class TableClicks extends JTable {
  /**
    * Primary Key
    * @var int
    */
   var $id = null;
 /*
 var $published = null;
 */

/**
    * @var string
    */
	var $uid = null;
	var $referer = null;
	var $ip = null;
	var $date = null;
   
   /**
    * Constructor
    * @param object Database connector object
    */
   function TableClicks(& $db) {
      parent::__construct('#__jafilia_clicks', 'id', $db);
   }
}