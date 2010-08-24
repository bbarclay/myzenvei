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

class TableJafilia_User extends JTable {
  /**
    * Primary Key
    * @var int
    */
   var $id = null;
   var $published = null;
 /*

 */

/**
    * @var string
    */

		//var $id = null;
		var $uid = null;
		var $firstname = null;
		var $lastname = null;
		var $street = null;
		var $zipcode = null;
		var $location = null;
		var $mail = null;
		var $fon = null;
		var $url = null;
		var $bank = null;
		var $blz = null;
		var $konto = null;
		var $paypal = null;
		var $state = null;
   
   /**
    * Constructor
    * @param object Database connector object
    */
   function TableJafilia_User(& $db) {
      parent::__construct('#__jafilia_user', 'id', $db);
   }
}