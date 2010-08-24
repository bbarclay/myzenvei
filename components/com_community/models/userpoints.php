<?php
/**
 * @category	Model
 * @package		JomSocial
 * @subpackage	Activities 
 * @copyright (C) 2008 by Slashes & Dots Sdn Bhd - All rights reserved!
 * @license http://www.jomsocial.com/license-agreement.html Copyrighted Commercial Software
 */
defined('_JEXEC') or die('Restricted access');

require_once( JPATH_ROOT . DS . 'components' . DS . 'com_community' . DS . 'models' . DS . 'models.php' );

/**
 *
 */ 
class CommunityModelUserPoints extends JCCModel
{

	function getPointData($action)
	{
		$db	 = &$this->getDBO();
		
		$query = "SELECT * FROM `#__community_userpoints`";
		$query .= " WHERE `action_string` = ".$db->Quote($action);
		$db->setQuery($query);
		
		$result	= $db->loadObject();
// 		$point	= 0;
// 		
// 		if(! empty($result))
// 		{
// 			$published	= $result->published;			
// 			$point		= $result->points;
// 			
// 			if ($published == '0')
// 				$point = 0;
// 								
// 		}
		
		return $result;
	}
}
