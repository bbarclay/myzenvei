<?php
/**
 * @copyright (C) 2008 by Slashes & Dots Sdn Bhd - All rights reserved!
 * @license http://www.jomsocial.com Copyrighted Commercial Software
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

function _cGetGroupMediaPermission($groupId)
{
	// load isCommunityAdmin()
	CFactory::load( 'helpers' , 'owner' );
	$my	= CFactory::getUser();
	
	$isSuperAdmin		= isCommunityAdmin();
	$isAdmin			= false;
	$isMember			= false;
	$waitingApproval	= false;
		
	// Load the group table.
	$groupModel	=& CFactory::getModel( 'groups' );
	$group		=& JTable::getInstance( 'Group' , 'CTable' );
	$group->load( $groupId );
	$params		= $group->getParams();	
	
	if(!$isSuperAdmin)
	{
		$isAdmin	= $groupModel->isAdmin( $my->id , $group->id );			
		$isMember	= $group->isMember( $my->id );
		
		//check if awaiting group's approval
		if( $groupModel->isWaitingAuthorization( $my->id , $group->id ) )
		{
			$waitingApproval	= true;
		}
	}
	
	$permission = new stdClass();
	$permission->isMember 			= $isMember;
	$permission->waitingApproval 	= $waitingApproval;
	$permission->isAdmin 			= $isAdmin;
	$permission->isSuperAdmin 		= $isSuperAdmin;
	$permission->params 			= $params;	
	$permission->privateGroup		= $group->approvals;
	
	return $permission;
}

function cAllowViewMedia($groupId)
{
	if(empty($groupId))
	{
		return false;
	}
	
	//get permission
	$permission = _cGetGroupMediaPermission($groupId);
	
	if($permission->privateGroup)
	{
		if($permission->isSuperAdmin || ($permission->isMember && !$permission->waitingApproval) )
		{
			$allowViewVideos = true;
		}
		else
		{			
			$allowViewVideos = false;	
		}
	}
	else
	{
		$allowViewVideos = true;
	}
	
	return $allowViewVideos;
}

function cAllowManageVideo($groupId)
{
	$allowManageVideos = false;
	
	//get permission
	$permission = _cGetGroupMediaPermission($groupId);
	
	$videopermission	= $permission->params->get('videopermission' , GROUP_VIDEO_PERMISSION_ADMINS );
	
	if($videopermission == GROUP_VIDEO_PERMISSION_DISABLE)
	{
		$allowManageVideos = false;
	}
	else if( ($videopermission == GROUP_VIDEO_PERMISSION_MEMBERS && $permission->isMember && !$permission->waitingApproval) || $permission->isAdmin || $permission->isSuperAdmin )
	{
		$allowManageVideos = true;
	}
	
	return $allowManageVideos;
}

function cAllowManagePhoto($groupId)
{
	$allowManagePhotos = false;
	
	//get permission
	$permission = _cGetGroupMediaPermission($groupId);
	
	$photopermission	= $permission->params->get('photopermission' , GROUP_PHOTO_PERMISSION_ADMINS );
	if($photopermission == GROUP_PHOTO_PERMISSION_DISABLE)
	{
		$allowManagePhotos = false;
	}
	else if( ($photopermission == GROUP_PHOTO_PERMISSION_MEMBERS && $permission->isMember && !$permission->waitingApproval) || $permission->isAdmin || $permission->isSuperAdmin )
	{
		$allowManagePhotos = true;
	}
	
	return $allowManagePhotos;
}

function cAllowPhotoWall($groupid)
{
	$permission = _cGetGroupMediaPermission($groupid);
	
	if( $permission->isMember || $permission->isAdmin || $permission->isSuperAdmin )
	{
		return true;
	}
	return false;
}