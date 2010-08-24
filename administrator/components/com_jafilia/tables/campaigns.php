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

class TableCampaigns extends JTable {
  /**
    * Primary Key
    * @var int
    */
   var $id = null;
   var $published = null;

/**
    * @var string
    */
   var $title = null;
   var $version = null;
   var $ppcvalue = null;
   var $fpsvalue = null;
   var $fplvalue = null;
   var $payout = null;
   var $chartscolor = null;
   var $template = null;
   var $desc = null;
   var $terms = null;
   var $startdate = null;
   var $enddate = null;
   
   /**
    * Constructor
    * @param object Database connector object
    */
   function TableCampaigns(& $db) {
      parent::__construct('#__jafilia_campaigns', 'id', $db);
   }
}