<?php
/**
 * @category	Library
 * @package		JomSocial
 * @subpackage	user 
 * @copyright (C) 2008 by Slashes & Dots Sdn Bhd - All rights reserved!
 * @license http://www.jomsocial.com Copyrighted Commercial Software
 */
defined('_JEXEC') or die('Restricted access');

class CKarma {
	
	/**
	 * return the path to karma image
	 * @param	user	CUser object	 
	 */	 	
	function getKarmaImage( $user ) {
		$points = $user->getKarmaPoint();
		
		$config		=& CFactory::getConfig();

		// If user does not change their profile picture, it should never get past 0.5 points
		if( $user->getThumbAvatar() == (JURI::base() . 'components/com_community/assets/default_thumb.jpg'))
		{
			return JURI::base() . 'components/com_community/templates/'.$config->get('template').'/images/karma-0-5.gif';
		}
		else if ($points <= $config->get('point0') )
		{
			return JURI::base() . 'components/com_community/templates/'.$config->get('template').'/images/karma-0.5-5.gif';
		}

		if( $points > $config->get('point5') )
		{
			return JURI::base() . 'components/com_community/templates/'.$config->get('template').'/images/karma-5-5.gif';
		}
		
		if( $points > $config->get('point4') )
		{
			return JURI::base() . 'components/com_community/templates/'.$config->get('template').'/images/karma-4-5.gif';
		}
		
		if( $points > $config->get('point3') )
		{
			return JURI::base() . 'components/com_community/templates/'.$config->get('template').'/images/karma-3-5.gif';
		}
		
		if( $points > $config->get('point2') )
		{
			return JURI::base() . 'components/com_community/templates/'.$config->get('template').'/images/karma-2-5.gif';
		}
		
		if( $points > $config->get('point1') ) {
			return JURI::base() . 'components/com_community/templates/'.$config->get('template').'/images/karma-1-5.gif';
		}
		
		
		return JURI::base() . 'components/com_community/templates/'.$config->get('template').'/images/karma-0-5.gif';
	}
	
	
	/**
	 * add points to user based on the action.
	 */	 	
	function assignPoint( $action, $userId=null)
	{
		//get the rule points
		$user	= CFactory::getUser($userId);
		$points	= CKarma::getActionPoint($action, $user->gid);
					
		$points	+= $user->getKarmaPoint();
		
		$user->_points = $points;
		$user->save();
	}
	
	
	/**
	 * Return points for various actions. Return value should be configurable from the backend
	 * 	 
	 */	 	
	function getActionPoint( $action, $gid = 0) {
	
		include_once(JPATH_ROOT.DS.'components'.DS.'com_community'.DS.'models'.DS.'userpoints.php');
		
		$userPoint = '';
		if( class_exists('CFactory') ){
			$userPoint =& CFactory::getModel('userpoints');
		} else {
			$userPoint = new CommunityModelUserPoints();
		}
		
		$point	= 0;
		$upObj	= $userPoint->getPointData( $action );
		
		if(! empty($upObj))
		{
			$published	= $upObj->published;			
			$point		= $upObj->points;
			$access		= $upObj->access;
			
			if ($published == '0')
				$point = 0;
			else if($access != $gid)
				$point = 0;

		}			
							
		
		return $point;
	
// 		switch ($action) {
// 			case 'application.add':
// 			case 'application.remove':
// 			case 'photo.upload':
// 				return 0;
// 			case 'group.create':
// 				return 3;
// 			
// 			case 'discussion.create':
// 				return 2;
// 				
// 			case 'group.leave':
// 				return -1;
// 			
// 			case 'friends.add':
// 			case 'album.create':
// 			
// 			case 'group.wall.create':
// 			case 'group.join':
// 			case 'discussion.reply':
// 			case 'wall.create':
// 			case 'wall.create':
// 			case 'profile.status.update':
// 			
// 			default:
// 				return 1;
//		}
	}
	
	
}