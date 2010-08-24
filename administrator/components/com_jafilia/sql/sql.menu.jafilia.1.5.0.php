<?php
/**
 * @version $Id: header.php 789 2009-01-26 15:56:03Z elkuku $
 * @package    Jafilia
 * @subpackage
 * @author     Arkadiusz Maniecki {@link http://www.jafilia.pl}
 * @author     Created on 28-09-2009
 */
//--No direct access
defined( '_JEXEC' ) or die( '=;)' );

	//$errors = FALSE;
	$BR = '<br />';
	$db = & JFactory::getDBO();
	/****/
	$sql = 'SELECT `id` FROM `jos_components` WHERE `name` LIKE \'Jafilia\' LIMIT 1 '; 
	$db->setQuery($sql);
	if($db->query()) {
		$compoid = $db->loadResult();
		$query = "INSERT INTO `#__menu` VALUES (NULL, 'mainmenu', 'Jafilia', 'jafilia', 'index.php?option=com_jafilia&view=jafilia', 'component', 1, 0, ".$compoid.", 0, 10, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 'page_title=\nshow_page_title=1\npageclass_sfx=\nmenu_image=-1\nsecure=0\n\n', 0, 0, 0);";
		$db->setQuery($query);
		if(!$db->query()) {
			echo $img_ERROR.JText::_('Unable to insert menu link').$BR;
			echo $db->getErrorMsg();
			return FALSE;
		} 	  
	}   
?>