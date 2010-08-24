<?php
/**
 * @package	JomSocial
 * @copyright (C) 2008 by Slashes & Dots Sdn Bhd - All rights reserved!
 * @license http://www.jomsocial.com Copyrighted Commercial Software
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

class CommunityActivitiesController extends CommunityBaseController
{
	/**
	 * Get content for activity based on the activity id.
	 *
	 *	@params	$activityId	Int	Activity id	 
	 **/
	function ajaxGetContent( $activityId )
	{
		$my				= CFactory::getUser();
		$showMore		= true;
		$objResponse	= new JAXResponse();
		$model			=& CFactory::getModel( 'Activities' );
		
		CFactory::load('libraries', 'privacy');
		CFactory::load('libraries', 'activities');
		
		// These core apps has default privacy issues with it
		$coreapps 		= array('photos','walls','videos', 'groups' );
		
		// make sure current user has access to the content item
		// For known apps, we can filter this manually
		$activity 		= $model->getActivity( $activityId );
		if( in_array($activity->app, $coreapps ) )
		{
			CFactory::load( 'helpers' , 'privacy' );
			
			switch($activity->app)
			{
				case 'walls':
					// make sure current user has permission to the profile
					$showMore = CPrivacy::isAccessAllowed($my->id, $activity->target, 'user', 'privacyProfileView');
					break;
				case 'videos':
					// Each video has its own privacy setting within the video itself
					CFactory::load( 'models' , 'videos' );
					$video	= JTable::getInstance( 'Video' , 'CTable' );
					$video->load( $activity->cid );
					$showMore = CPrivacy::isAccessAllowed($my->id, $activity->actor, 'custom', $video->permissions);
					break;
					
				case 'photos':
					// for photos, we uses the actor since the target is 0 and he
					// is doing the action himself
					$showMore = CPrivacy::isAccessAllowed($my->id, $activity->actor, 'user', 'privacyPhotoView');
					break;
				case 'groups':
			}
		}
		else
		{
			// if it is not one of the core apps, we should allow plugins to decide
			// if they want to block the 'more' view
		}
		
		if( $showMore )
		{
			$act		= $model->getActivity( $activityId );
			$content	= CActivityStream::getActivityContent($act);			
			
			$objResponse->addScriptCall( 'joms.activities.setContent' , $activityId , $content );
		}
		else
		{
			$content 	= JText::_('CC ACCESS FORBIDDEN');
			$content	= nl2br( $content );
			$content	= JString::str_ireplace( "\n" , '' , $content );
			$objResponse->addScriptCall( 'joms.activities.setContent' , $activityId , $content );
		}

		return $objResponse->sendResponse();
	}
	
	/**
	 * Hide the activity from the profile
	 * @todo: we should also hide all aggregated activities	 
	 */	 	
	function ajaxHideActivity( $userId , $activityId )
	{
		$objResponse	= new JAXResponse();
		$model			=& $this->getModel('activities');
		
		$model->hide( $userId , $activityId );
		$objResponse->addScriptCall('jQuery("#profile-newsfeed-item' . $activityId . '").fadeOut("5400");');
		
		return $objResponse->sendResponse();
	}
}
