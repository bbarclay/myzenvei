<?php
/**
 * @category	Helper
 * @package		JomSocial
 * @copyright (C) 2008 by Slashes & Dots Sdn Bhd - All rights reserved!
 * @license http://www.jomsocial.com Copyrighted Commercial Software
 */
defined('_JEXEC') or die('Restricted access');

// Check if the given id is the same and not a guest
function isMine($id1, $id2) {
	return ($id1 == $id2) && (($id1 != 0) || ($id2 != 0) );
}

function isRegisteredUser(){
	$my =& JFactory::getUser();
	return (($my->id != 0) && ($my->block !=1));
}

/**
 *  Determines if the currently logged in user is a super administrator
 **/
function isSuperAdministrator()
{
	return isCommunityAdmin();
}

/**
 * Check if a user can administer the community
 */ 
function isCommunityAdmin($userid = null)
{
	$my	= CFactory::getUser($userid);		
	return ( $my->usertype == 'Super Administrator' || $my->usertype == 'Administrator' || $my->usertype == 'Manager' );
}