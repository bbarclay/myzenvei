<?php
defined('_JEXEC') or die('Restricted Access');

class TableHello extends JTable
{
	var $id 		= null;
	var $message 		= null;	
	var $published 		= 0;	
	
	/**
	* @param database A database 
        connector object */
	function __construct(&$db)
	{
		parent::__construct( 'members', 'id', $db );
	}	
	
}

?>