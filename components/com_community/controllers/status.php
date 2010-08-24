<?php
/**
 * @package	JomSocial
 * @copyright (C) 2008 by Slashes & Dots Sdn Bhd - All rights reserved!
 * @license http://www.jomsocial.com Copyrighted Commercial Software
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

jimport('joomla.utilities.date');

class CommunityStatusController extends CommunityBaseController
{
	
	var $_name = 'status';
		
	/**
	 * Update the status of current user
	 */	 	
	function ajaxUpdate($message = '')
	{
		if (!isRegisteredUser())
		{
			return $this->ajaxBlockUnregister();
		}
		$mainframe 		=& JFactory::getApplication();
		$objResponse    = new JAXResponse();		
		$message = strip_tags($message);

		//trim it here so that it wun go into activities stream.
		$message = JString::trim($message);		
		
		$my			= CFactory::getUser();    
		$status		=& $this->getModel('status');
		$status->update($my->id, $message);
		
		//set user status for current session.
		$today		=& JFactory::getDate();
		$message2	= (empty($message)) ? ' ' : $message;
		$my->set( '_status' , $message2 );
		$my->set( '_posted_on' , $today->toMySQL());
		
		$profileid = JRequest::getVar('userid' , 0 , 'GET');
		if(isMine($my->id, $profileid))
		{	
			$objResponse->addScriptCall("jQuery('#profile-status span#profile-status-message').html('" . addslashes( $message ) . "');");
		}
				
		if(! empty($message))
		{		
			$act = new stdClass();
			$act->cmd 		= 'profile.status.update';
			$act->actor 	= $my->id;
			$act->target 	= $my->id;

			CFactory::load( 'helpers' , 'linkgenerator' );

			// @rule: Autolink hyperlinks
			$message		= cGenerateURILinks( $message );
			
			// @rule: Autolink to users profile when message contains @username
			$message		= cGenerateUserAliasLinks( $message );
			
		
			$privacyParams	= $my->getParams();			
			
			$act->title		= '{actor} '.$message;
			$act->content	= '';
			$act->app		= 'profile';
			$act->cid		= $my->id;
			$act->access	= $privacyParams->get('privacyProfileView');
			
			CFactory::load('libraries', 'activities');
			CActivityStream::add($act);
			
			//add user points
			CFactory::load( 'libraries' , 'userpoints' );		
			CUserPoints::assignPoint('profile.status.update');
			
			//now we need to reload the activities streams
			$friendsModel	=& CFactory::getModel('friends');
	
			$memberSince	= cGetDate($my->registerDate);
			$friendIds		= $friendsModel->getFriendIds($my->id);
	
			include_once(JPATH_COMPONENT . DS.'libraries'.DS.'activities.php');
			$act 	= new CActivityStream();
			$html	= $act->getHTML($my->id, $friendIds, $memberSince, 10);			

			$objResponse->addAssign('activity-stream-container' , 'innerHTML' , $html );
		}
		
		return $objResponse->sendResponse();
	}
	
}
