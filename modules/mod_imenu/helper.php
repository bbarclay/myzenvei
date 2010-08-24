<?php
/*------------------------------------------------------------------------
# ogweb.net All rights reserved.
# ------------------------------------------------------------------------
# Copyright © 2009 ogweb.net. 
# Website:  http://www.ogweb.net/
-------------------------------------------------------------------------*/
// no direct access
defined('_JEXEC') or die('Restricted access');


class modIMenuHelper
{

function getMenuItems( $__menu )
	{
	//build query to get menu items properties
	$_dbo =& JFactory::getDBO();
	
	$_query = "SELECT id, name, link, params FROM #__menu WHERE menutype = '".$__menu."' AND published = '1' AND access = '0' AND parent = '0' ORDER BY ordering ASC";
	
	$_dbo->setQuery( $_query );
	
	$_items=$_dbo->loadObjectList();
	
	return $_items;

	}
}
?>