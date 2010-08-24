<?php
/**
 * @category	Library
 * @package		JomSocial
 * @copyright (C) 2008 by Slashes & Dots Sdn Bhd - All rights reserved!
 * @license http://www.jomsocial.com Copyrighted Commercial Software
 */
defined('_JEXEC') or die('Restricted access');

class CPrivacy
{
	/**
	 * Return true if actor have access to target's item
	 * @param type where the privacy setting should be extracted, {user, group, global, custom}
	 * Site super admin waill always have access to all area	 
	 */ 
	static function isAccessAllowed($actorId, $targetId, $type, $userPrivacyParam)
	{ 
		$actor  = CFactory::getUser($actorId);
		$target = CFactory::getUser($targetId);
		
		CFactory::load( 'helpers' , 'owner' );
		CFactory::load( 'helpers' , 'friends' );
		
		// Load User params
		$params			=& $target->getParams();
	
		// guest
		$relation = 10;
	
		// site members
		if( $actor->id != 0 )
			$relation = 20;
	
		// friends
		if( friendIsConnected($actorId, $targetId) )
			 $relation = 30;
	
		// mine, target and actor is the same person
		if( isMine($actor->id, $target->id) )
			 $relation = 40;
	
		// @todo: respect privacy settings
		// If type is 'custom', then $userPrivacyParam will contain the exact
		// permission level
		$permissionLevel = ($type == 'custom') ? $userPrivacyParam : $params->get($userPrivacyParam);
		if( $relation <  $permissionLevel && !isCommunityAdmin($actorId) )
		{
			return false;
		}
		return true;
	}
}