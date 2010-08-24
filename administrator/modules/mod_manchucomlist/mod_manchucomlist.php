<?php
/**
* Component listing module for joomla1.5
* Author:  Sabuj Kundu aka manchumahara<manchumahara@gmail.com>
* Copyright 2008 manchumahara.com
* License:  GNU General Public License
* Version 2.0.0
*Note Some core code is used for this module
*Special thanks to Jeff Koertzen<jeff@koertzen.com>
*/

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
// Lets get some variables we will need to render the menu
$lang	=& JFactory::getLanguage();
$doc	=& JFactory::getDocument();
$user	=& JFactory::getUser();

//echo "Hi this comlist module by manchumahara mu ha ha<br/>";

echo JManchuComlist::getComList($params);
class JManchuComList{
	function getComList(&$params)
	{
		global $mainframe;		
		$show_subitem = $params->get('show_subitem') ;
		$show_credit = $params->get('show_credit') ;
		$list = JManchuComList::_getDBlist();
		if (!is_array($list) || !count($list)){
			return "There is no component or failed to load the list...";
		}
		
		$txt = "<ol id=\"manchucomlist\">\n";
		foreach($list as $item)	
		{
			$txt .= "<li><a class=\"manchucomlink\" href=\"".JFilterOutput::ampReplace($item[1])."\">".$item[0]."</a>";			
			if($show_subitem)  //Checking for showing subitems :D
			{
				$parentid = $item[2];	
				$subList = JManchuComList::_getSublist($parentid);
				if (is_array($subList) && count($subList))
				{						
					foreach($subList as $subItem)	
						{
							if ($subItem[1] <> $item[1]) {
								//$txt .= "<li><a class=\"manchusublink\" href=\"".JFilterOutput::ampReplace($subItem[1])."\">".$subItem[0]."</a></li>  ";		
								$txt .= "  [<a class=\"manchusublink\" href=\"".JFilterOutput::ampReplace($subItem[1])."\">".$subItem[0]."</a>]";		
							}
						}//loop for subitem					
				}
			}				
			$txt .= "</li>";	
		}//loop for parent item
		$txt .= "</ol>";
		if($show_credit)
		{
			$txt .= "<span style=\"padding-left:20px;\">Powered by: <a href=\"http://blog.manchumahara.com\" target=\"_blank\">Manchumahara</a>   [Special Thanks to: Jeff Koertzen]</span>";
		}
		return $txt;		
	}	
	function _getDBlist()
	{
		$db   =& JFactory::getDBO();
		$query = 'SELECT * FROM #__components WHERE parent = \'0\' AND admin_menu_img <> \'\' AND enabled = \'1\' ORDER BY name ASC';
		$db->setQuery($query);
		$items = $db->loadObjectList();

		// Process the items
		$comList = array();
		foreach($items as $item)
		{
				$key = $item->name;
				/*$subItem[0]	= $lang->hasKey($key) ? JText::_($key) : $item->name;*/
				$subItem[0]	= (JText::_($key))?JText::_($key) : $item->name;
				$subItem[1]	= 'index.php?option='. $item->option;
				$subItem[2] = $item->id;
				$comList[] = $subItem;				
		}
		return $comList;
	}	
	function _getSublist($parentid)
	{
		$db   =& JFactory::getDBO();
		$query = 'SELECT * FROM #__components WHERE parent = '.$parentid.' ORDER BY ordering ASC';
		$db->setQuery($query);
		$row = $db->loadObjectList();
		
		// Process the items
		$subList = array();
		foreach($row as $item)
		{
				$key = $item->name;
				/*$subItem[0]	= $lang->hasKey($key) ? JText::_($key) : $item->name;*/
				$subItem[0]	= (JText::_($key))?JText::_($key) : $item->name;
				$subItem[1]	= 'index.php?'. $item->admin_menu_link;
				$subList[] = $subItem;				
		}
		return $subList;
	}	
}