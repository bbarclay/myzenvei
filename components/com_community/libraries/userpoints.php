<?php
/**
 * @category	Library
 * @package		JomSocial
 * @subpackage	user 
 * @copyright (C) 2008 by Slashes & Dots Sdn Bhd - All rights reserved!
 * @license http://www.jomsocial.com Copyrighted Commercial Software
 */
defined('_JEXEC') or die('Restricted access');

require_once( JPATH_ROOT . DS . 'components' . DS . 'com_community' . DS . 'libraries' . DS . 'core.php' );

class CUserPoints {
	
	/**
	 * return the path to karma image
	 * @param	user	CUser object	 
	 */	 	
	function getPointsImage( $user ) {
		$points = $user->getKarmaPoint();
		
		$config		=& CFactory::getConfig();

		// If user does not change their profile picture, it should never get past 0.5 points
		if( $user->getThumbAvatar() == (JURI::base() . 'components/com_community/assets/default_thumb.jpg'))
		{
			return JURI::base() . 'components/com_community/templates/'.$config->get('template').'/images/karma-0-5.gif';
		}
		else if ($points <= $config->get('point1'))
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
		//must use the JFactory::getUser to get the aid
		$juser	=& JFactory::getUser($userId);		
		
		if( $juser->id != 0 )
		{
			$aid    = $juser->aid;
			
			// if the aid is null, means this is not the current logged-in user. 
			// so we need to manually get this aid for this user.
			if(is_null($aid))
			{
				$aid = 0; //defautl to 0
				// Get an ACL object
				$acl 	=& JFactory::getACL();
				$grp 	= $acl->getAroGroup($juser->id);						
				$group	= 'USERS';
						
				if($acl->is_group_child_of( $grp->name, $group))
				{
					$aid	= 1;
					// Fudge Authors, Editors, Publishers and Super Administrators into the special access group
					if ($acl->is_group_child_of($grp->name, 'Registered') ||
					    $acl->is_group_child_of($grp->name, 'Public Backend'))    {
						$aid	= 2;
					}
				}
			}
		
			$points	= CUserPoints::_getActionPoint($action, $aid);						 
			
			$user	= CFactory::getUser($userId);
			$points	+= $user->getKarmaPoint();
			$user->_points = $points;
			$user->save();
		}
	}
	
	
	/**	 
	 * Private method. DO NOT call this method directly.
	 * Return points for various actions. Return value should be configurable from the backend.	 	 
	 */	 	
	function _getActionPoint( $action, $aid = 0) {
	
		include_once(JPATH_ROOT.DS.'components'.DS.'com_community'.DS.'models'.DS.'userpoints.php');
		
		$userPoint = '';
		if( class_exists('CFactory') ){
			$userPoint =& CFactory::getModel('userpoints');
		} else {
			$userPoint = new CommunityModelUserPoints();
		}
		
		$userAccess	= (empty($aid)) ? 0 : $aid;
		$point	= 0;
		$upObj	= $userPoint->getPointData( $action );
		
		if(! empty($upObj))
		{
			$published	= $upObj->published;						
			$access		= $upObj->access;
			
			if($access <= $userAccess)
				$point = $upObj->points;			
			
			if ($published == '0')
				$point = 0;
		}
		
		return $point;

	}//end _getActionPoint
	
	
}