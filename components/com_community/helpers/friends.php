<?php
/**
 * @category	Helper
 * @package		JomSocial
 * @copyright (C) 2008 by Slashes & Dots Sdn Bhd - All rights reserved!
 * @license http://www.jomsocial.com Copyrighted Commercial Software
 */
defined('_JEXEC') or die('Restricted access');

/**
 * Check if 2 friends is connected or not
 * @param	int userid1
 * @param	int userid2
 * @return	bool  
 */ 
function friendIsConnected($id1, $id2){
	if(($id1 == $id2) && ($id1 != 0))
		return true;
	
	if($id1 == 0 || $id2 == 0)
		return false;
	
	$db =& JFactory::getDBO();
	$sql = "SELECT count(*) FROM #__community_connection "
		  ." WHERE `connect_from`='$id1' AND `connect_to`='$id2' "
		  ." AND `status` = 1";
		
	$db->setQuery($sql);
	$result = $db->loadResult();
	if($db->getErrorNum()) {
		JError::raiseError( 500, $db->stderr());
	}
	return $result;
}

 
