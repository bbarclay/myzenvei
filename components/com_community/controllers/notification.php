<?php

/**
 * @package	JomSocial
 * @copyright (C) 2008 by Slashes & Dots Sdn Bhd - All rights reserved!
 * @license http://www.jomsocial.com Copyrighted Commercial Software
 */
// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die();

class CommunityNotificationController extends CommunityBaseController
{
	
	function ajaxGetNotification()
	{
		if (!isRegisteredUser()) {
			return $this->ajaxBlockUnregister();
		}	
	
		$objResponse = new JAXResponse ();
		
		$my	= CFactory::getUser();
		
		$inboxModel		=& CFactory::getModel( 'inbox' );
		$friendModel	=& CFactory::getModel ( 'friends' );
		
		$inboxHtml			= '';
		$frenHtml			= '';
		$rowHeight			= 50;
		$menuHeight			= 35;
		$extraMenuHeight	= 0;
		$notiTotal			= 0;			

		// getting inbox
		$unreadInbox	= $inboxModel->getUnReadInbox();
        if(! empty( $unreadInbox ))
        {
        	$extraMenuHeight	+= 25;
        	$notiTotal 			+= count($unreadInbox);
			for($i = 0; $i < count($unreadInbox); $i++)
			{
				$row =& $unreadInbox[$i];
				$user = CFactory::getUser( $row->from );
				$row->avatar = $user->getThumbAvatar();
				$row->isUnread = true;
				
				$row->from_name		= $user->getDisplayName();
				$row->profileLink	= cUserLink($user->id);
			}			        
        
			$tmpl = new CTemplate();
			$tmpl->set( 'messages' , $unreadInbox );
	        $inboxHtml	= $tmpl->fetch('notification.unread.inbox');
			$inboxHtml	.= '<br />';        
        }
        
        
        // getting pending fren request
        $pendingFren	= $friendModel->getPending($my->id);
        if(! empty( $pendingFren ))
        {
        	$extraMenuHeight	+= 25;
        	$notiTotal			+= count($pendingFren);
			for($i = 0; $i < count($pendingFren); $i++)
			{
				$row		=& $pendingFren[$i];
				$row->user	= CFactory::getUser($row->id );
				$row->user->friendsCount	= $row->user->getFriendCount();
				$row->user->profileLink		= cUserLink($row->id);
			}			
			
			$tmplF	= new CTemplate();
			
			$tmplF->set( 'rows' 	, $pendingFren );
			$tmplF->setRef( 'my'	, $my );
			$frenHtml = $tmplF->fetch( 'notification.friend.request' );
		}                        
        
        $notiHtml	= $inboxHtml . $frenHtml;
        
        $objResponse->addAssign( 'cWindowContent' , 'innerHTML' , $notiHtml );
        
        $totalHeight	= $menuHeight + $extraMenuHeight + ($notiTotal * $rowHeight);
        
        if ($totalHeight > 450)
        	$totalHeight = 450; /* Max height 450 */
    	
    	$objResponse->addAssign('cwin_logo', 'innerHTML', JText::_('CC NOTIFICATIONS'));
        $objResponse->addScriptCall ( 'cWindowResize', $totalHeight );		
        
        $objResponse->sendResponse();
	
	}
	
	/**
	 * Ajax function to reject a friend request
	 **/
	function ajaxRejectRequest( $requestId )
	{
		if (!isRegisteredUser()) {
			return $this->ajaxBlockUnregister();
		}	
	
		$objResponse	= new JAXResponse();
		$my				= CFactory::getUser();
		$friendsModel	=& CFactory::getModel('friends');

		if( $friendsModel->isMyRequest( $requestId , $my->id) )
		{
			$pendingInfo = $friendsModel->getPendingUserId($requestId);
			
			if( $friendsModel->rejectRequest( $requestId ) )
			{
				//add user points - friends.request.reject removed @ 20090313
								
				$objResponse->addScriptCall( 'jQuery("#msg-pending-' . $requestId . '").html("'.JText::_('CC FRIEND REQUEST REJECTED').'");');
				$objResponse->addScriptCall( 'joms.notifications.updateNotifyCount();');
				$objResponse->addScriptCall( 'jQuery("#noti-pending-' . $requestId . '").fadeOut(1000, function() { jQuery("#noti-pending-' . $requestId . '").remove();} );');
			
				//trigger for onFriendReject
				require_once(JPATH_ROOT . DS . 'components' . DS . 'com_community' . DS . 'controllers' . DS . 'friends.php');	
				$eventObject = new stdClass();
				$eventObject->profileOwnerId 	= $my->id;
				$eventObject->friendId 			= $pendingInfo->connect_from;
				CommunityFriendsController::triggerFriendEvents( 'onFriendReject' , $eventObject);
				unset($eventObject);
			}
			else
			{
				$objResponse->addScriptCall( 'jQuery("#error-pending-' . $requestId . '").html("' . JText::sprintf('CC FRIEND REQUEST REJECT FAILED', $requestId ) . '");' );
				$objResponse->addScriptCall( 'jQuery("#error-pending-' . $requestId . '").attr("class", "error");');
			}

		}
		else
		{
			$objResponse->addScriptCall( 'jQuery("#error-pending-' . $requestId . '").html("' . JText::_('CC NOT YOUR REQUEST') . '");' );
			$objResponse->addScriptCall( 'jQuery("#error-pending-' . $requestId . '").attr("class", "error");');
		}

		return $objResponse->sendResponse();
	}
		
	/**
	 * Ajax function to approve a friend request
	 **/
	function ajaxApproveRequest( $requestId )
	{
		if (!isRegisteredUser()) {
			return $this->ajaxBlockUnregister();
		}	
	
		$objResponse	= new JAXResponse();
		$my				= CFactory::getUser();
		$friendsModel	=& CFactory::getModel( 'friends' );

		if( $friendsModel->isMyRequest( $requestId , $my->id) )		
		{
			$connected		= $friendsModel->approveRequest( $requestId );

			if( $connected )			
			{
				$act			= new stdClass();
				$act->cmd 		= 'friends.request.approve';
				$act->actor   	= $connected[0];
				$act->target  	= $connected[1];
				$act->title	  	= JText::_('CC ACTIVITIES FRIENDS NOW');
				$act->content	= '';
				$act->app		= 'friends';
				$act->cid		= 0;

				CFactory::load ( 'libraries', 'activities' );
				CActivityStream::add($act);
				
				//add user points - give points to both party
				CFactory::load( 'libraries' , 'userpoints' );		
				CUserPoints::assignPoint('friends.request.approve');				

				$friendId		= ( $connected[0] == $my->id ) ? $connected[1] : $connected[0];
 				$friend			= CFactory::getUser( $friendId );
 				CUserPoints::assignPoint('friends.request.approve', $friendId);

				// Add the friend count for the current user and the connected user
				$friendsModel->addFriendCount( $connected[0] );
				$friendsModel->addFriendCount( $connected[1] );
				
				// Add notification
				$nData = array ('url' => CRoute::getExternalURL('index.php?option=com_community&view=profile&userid='.$my->id, false));
				$this->_notify ( 'friends.create.connection', $my->id, $friend->id, JText::sprintf('CC FRIEND REQUEST APPROVED', $my->getDisplayName() ) , '', 'friends.email.approve', $nData );
				
				$objResponse->addScriptCall( 'jQuery("#msg-pending-' . $requestId . '").html("'.addslashes(JText::sprintf('CC FRIENDS NOW', $friend->getDisplayName())).'");');
				$objResponse->addScriptCall( 'joms.notifications.updateNotifyCount();');
				$objResponse->addScriptCall( 'jQuery("#noti-pending-' . $requestId . '").fadeOut(1000, function() { jQuery("#noti-pending-' . $requestId . '").remove();} );');				
			
				//trigger for onFriendApprove
				require_once(JPATH_ROOT . DS . 'components' . DS . 'com_community' . DS . 'controllers' . DS . 'friends.php');	
				$eventObject = new stdClass();
				$eventObject->profileOwnerId 	= $my->id;
				$eventObject->friendId 			= $friendId;
				CommunityFriendsController::triggerFriendEvents( 'onFriendApprove' , $eventObject);
				unset($eventObject);
			}
		}
		else
		{
			$objResponse->addScriptCall( 'jQuery("#error-pending-' . $requestId . '").html("' . JText::_('CC NOT YOUR REQUEST') . '");' );
			$objResponse->addScriptCall( 'jQuery("#error-pending-' . $requestId . '").attr("class", "error");');
		}

		return $objResponse->sendResponse();
	}		

}