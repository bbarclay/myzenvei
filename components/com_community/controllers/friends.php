<?php
/**
 * @package	JomSocial
 * @copyright (C) 2008 by Slashes & Dots Sdn Bhd - All rights reserved!
 * @license http://www.jomsocial.com Copyrighted Commercial Software
 */

// no direct access
defined('_JEXEC') or die('Restricted access');


class CommunityFriendsController extends CommunityBaseController
{
	var $task;
	var $_icon = 'friends';
	var $_name = 'friends';

    function ajaxIphoneFriends()
    {
		$objResponse	= new JAXResponse();		
		$document		=& JFactory::getDocument();
		
		$viewType	= $document->getType(); 		 	
		$view		=& $this->getView( 'friends', '', $viewType );
						
		
		$html = '';
		
		ob_start();				
		$this->display();				
		$content = ob_get_contents();
		ob_end_clean();
		
		$tmpl			= new CTemplate();
		$tmpl->set('toolbar_active', 'friends');
		$simpleToolbar	= $tmpl->fetch('toolbar.simple');		
		
		$objResponse->addAssign('social-content', 'innerHTML', $simpleToolbar . $content);
		return $objResponse->sendResponse();		    	
    }

	function edit()
	{
		// Get/Create the model
		$model = & $this->getModel('profile');
		$model->setProfile('hello me');

		$this->display(false, __FUNCTION__);

	}

	function display()
	{
		// By default, display the user profile page
		$this->friends();
	}

	/**
	 * View all friends. Could be current user, if $_GET['id'] is not defined
	 * otherise, show your own friends
	 */
	function friends()
	{
		CFactory::load('libraries', 'privacy');
		$document =& JFactory::getDocument();
		$my =& JFactory::getUser();
		
		$viewType		= $document->getType();	
		$tagsFriends	= JRequest::getVar( 'tags','','GET');

		$view	=& $this->getView( 'friends','',  $viewType);
		$model	=& $this->getModel('friends');

		// Get the friend id to be displayed
		$id = JRequest::getCmd('userid', $my->id);

		// Check privacy setting
		$accesAllowed = CPrivacy::isAccessAllowed($my->id, $id, 'user', 'privacyFriendsView');
		if(!$accesAllowed || ($my->id == 0 && $id == 0))
		{
			$this->blockUnregister();
			return;
		}
		
		$data	= new stdClass();
		echo $view->get('friends');
	}

	/**
	 * Show the user invite window
	 */
	function invite()
	{
		$view =& CFactory::getView('friends');
		$validated = false;
		
		$my = CFactory::getUser();
		
		if($my->id == 0)
		{
			return $this->blockUnregister();
		}
		
		if( JRequest::getVar('action', '', 'POST') == 'invite')
		{
			$mainframe =& JFactory::getApplication();
			$validated 			= true;
			$emailExistError	= array();
			$emailInvalidError	= array();

			$emails = JRequest::getVar('emails', '', 'POST');

			if( empty($emails) ){
				$validated = false;
				$mainframe->enqueueMessage( JText::_('CC FRIEND EMAIL CANNOT BE EMPTY') , 'error');
			} else {
				$emails = explode(',', $emails);
				$userModel =& CFactory::getModel('user');

				// @todo: do simple email validation
				// make sure user is not a member yet
				// check for duplicate emails
				// make sure email is valid
				// make sure user is not already on the system
				$actualEmails = array();
				for( $i = 0; $i < count($emails); $i++ ) {
					//trim the value
					$emails[$i] = JString::trim($emails[$i]);

					if(!empty($emails[$i]) &&
						preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/i", $emails[$i]))
					{
						//now if the email already exist in system, alert the user.
						if(!$userModel->userExistsbyEmail($emails[$i])){
							$actualEmails[$emails[$i]] = true;
						} else {
							$emailExistError[] = $emails[$i];
						}
					} else {
					    // log the error and display to user.
					    if(!empty($emails[$i]))
							$emailInvalidError[] = $emails[$i];
					}
				}

				$emails = array_keys($actualEmails);
				unset($actualEmails);

				if(count($emails) <= 0)
					$validated = false;

				if(count($emailInvalidError) > 0)
				{
					for($i = 0; $i < count($emailInvalidError); $i++)
					{
						$mainframe->enqueueMessage( JText::sprintf('CC INVITE EMAIL INVALID', $emailInvalidError[$i]) , 'error');
					}
					$validated = false;
				}


				if(count($emailExistError) > 0)
				{
					for($i = 0; $i < count($emailExistError); $i++)
					{
						$mainframe->enqueueMessage( JText::sprintf('CC INVITE EMAIL EXIST', $emailExistError[$i]) , 'error');
					}
					$validated = false;
				}
			}

			$message =  JRequest::getVar('message', '', 'POST');
			
			$config		=& CFactory::getConfig();

			if( $validated ) {
				for( $i = 0; $i < count($emails); $i++ ) 
				{
					
					$emails[$i] = JString::trim($emails[$i]);
					$subject = JText::sprintf('CC INVITE EMAIL SUBJECT', $my->getDisplayName(), $config->get('sitename') );
					$body	 = JText::sprintf('CC INVITE EMAIL MESSAGE', $my->getDisplayName() , $config->get('sitename') );
 					$body	.= '
 					';
					$body	.= $message;
 					$body	.= '
 					';
					$body	.= '---------------------------------------------------
					';

					$body	.= JText::_('CC INVITE EMAIL MESSAGE VIEW FRINEDS') . ' ' . CRoute::getExternalURL('index.php?option=com_community&view=profile&userid='.$my->id.'&invite='.$my->id , false );

					// send email to the user now, (via mailQ of course!)
					$mailqModel =& CFactory::getModel( 'mailq' );
					$mailqModel->add( $emails[$i] , $subject, $body );
				}

				$mainframe->enqueueMessage(JText::sprintf( (cIsPlural(count($emails))) ? 'CC INVITE EMAIL SENT MANY' : 'CC INVITE EMAIL SENT' , count($emails)));
				
				//add user points - friends.invite removed @ 20090313
				
				//clear the post value.
				JRequest::setVar('emails', '');
				JRequest::setVar('message', '');

			} else {
				// Display error message
			}
		}

		echo $view->get('invite');
	}

	function online()
	{
		$view = $this->getView('friends');
		echo $view->get(__FUNCTION__);

	}

	function news()
	{
		$view = $this->getView('friends');
		echo $view->get(__FUNCTION__);
	}

	/**
	 * List down all request that you've sent but not approved by the other side yet
	 */
	function sent(){
		$my =& JFactory::getUser();
		
		if($my->id == 0)
		{
		   return $this->blockUnregister();
		}		
		
		$view = $this->getView('friends');
		$model =& $this->getModel('friends');

		$data	= new stdClass();
		$rsent = $model->getSentRequest($my->id);

		$data->sent = $rsent;
		$data->pagination =& $model->getPagination();

		echo $view->get('sent', $data);
	}

	/**
	 * Add new friend
	 */
	function add(){
		$view = $this->getView('friends');
		
		$my =& JFactory::getUser();
		if($my->id == 0)
		{
		   return $this->blockUnregister();
		}		

		$model	=& $this->getModel('friends');
		$id		= JRequest::getCmd('userid', 0);				
		$data 	=& JFactory::getUser($id);

		$task= JRequest::getVar('task','','GET');
		$task = $task.'()';
		$this->task=$task;

		// If a query is sent, seach for it
		if($query = JRequest::getVar('userid', '', 'POST'))
		{
			$model->addFriend($id, $my->id);
			
			//trigger for onFriendRequest
			$eventObject = new stdClass();
			$eventObject->profileOwnerId 	= $my->id;
			$eventObject->friendId 			= $id;
			$this->triggerFriendEvents( 'onFriendRequest' , $eventObject);
			unset($eventObject);
			
			echo $view->get('addSuccess', $data);
		}
		else
		{
			//@todo disallow self add as a friend
			//@todo disallow add existing friend
			if($my->id==$id)
			{
				$view->addInfo( JText::_( 'CC FRIEND CANNOT ADD SELF' ) );
				$this->display();
			}
			elseif(count($model->getFriendConnection($my->id,$id))>0){
				$view->addInfo(JText::_('CC FRIEND IS ALREADY FRIEND'));
				$this->display();

			}
			else
			{
				echo $view->get('add', $data);
			}

		}

	}

	/**
	 *	Add new friend group
	 */

// 	 function addGroup(){
// 		$view = $this->getView('friends');
// 		$model=& $this->getModel('friends');
// 		$my=& JFactory::getUser();
// 		$data	= new stdClass();
// 
// 		//if a query is sent
// 		if($groupname = JRequest::getVar('groupname','','POST')){
// 		 	if($model->addFriendGroup($my->id,$groupname))
// 		 		$data->message	= JText::_('Group successfuly added..');
// 		 	else
// 				$data->message	= JText::_('Duplicate entry');
// 
// 			$data->grouplist	= $model->getFriendsGroup( $my->id );
// 			 	echo $view->get('addGroup',$data);
// 
// 		 }
// 		 else{
// 		 	$data->grouplist	= $model->getFriendsGroup( $my->id );
// 			    echo $view->get('addGroup',$data);
// 		 }
// 	 }
	 /**
	  *	delete tags
	  *
	  */
// 
// 	 function deleteGroup(){
// 		 $view = $this->getView('friends');
// 		 $model= $this->getModel('friends');
// 		 $my=& JFactory::getUser();
// 		 $data	= new stdClass();
// 
// 		 $groupid = JRequest::getVar('id','','GET');
// 		 if(!empty($groupid))
// 		 {
// 			 $wheres['group_id']=$groupid;
// 			 $friendstag=$model->getFriendsTag($wheres);
// 			 if(count($friendstag)==0) //delete when child not exist
// 			 {
// 				 $model->deleteFriendGroup($my->id,$groupid);
// 				 $data->message	= JText::_('Group Deleted..');
// 			 }
// 			 else  //not delete when child exist
// 			 {
// 			 	$data->message	= JText::_('Cannot Delete, child exist!');
// 			 }
// 
// 		 }
// 
// 		$data->grouplist	= $model->getFriendsGroup( $my->id );
// //		  $data["grouplist"]=$model->getFriendsGroup($my->id);
// 		  echo $view->get('addGroup',$data);
// 
// 	 }


	function remove()
	{
		$mainframe =& JFactory::getApplication();
		$view	= $this->getView('friends');
		$model	= $this->getModel('friends');
		$my		= CFactory::getUser();
		
		if($my->id == 0)
		{
		   return $this->blockUnregister();
		}		

		$friendid	= JRequest::getVar('fid','','GET');

		if( $model->deleteFriend($my->id,$friendid) )
		{
			// Substract the friend count
			$model->substractFriendCount( $my->id );
			$model->substractFriendCount( $friendid );
			
			//add user points
			// we deduct poinst to both parties
			CFactory::load( 'libraries' , 'userpoints' );		
			CUserPoints::assignPoint('friends.remove');			
			CUserPoints::assignPoint('friends.remove', $friendid);

			$view->addInfo(JText::_('CC FRIEND REMOVED'));
			//@todo notify friend after remove them from our friend list
			
			//trigger for onFriendRemove
			$eventObject = new stdClass();
			$eventObject->profileOwnerId 	= $my->id;
			$eventObject->friendId 			= $friendid;
			$this->triggerFriendEvents( 'onFriendRemove' , $eventObject);
			unset($eventObject);
		}
		else
		{
			$view->addinfo(JText::_('CC ERROR REMOVING FRIEND'));
		}

		$this->display();
	}

	/**
	 * Method to cancel a friend request
	 */
	function deleteSent()
	{
		$my		= CFactory::getUser();
		
		if($my->id == 0)
		{
		   return $this->blockUnregister();
		}		
		
		$view	= $this->getView( 'friends' );
		$model	=& $this->getModel('friends');

		$friendId	= JRequest::getVar( 'fid' , '' , 'POST' );
		$message	= '';

		if($model->deleteSentRequest($my->id,$friendId))
		{
			$message	= JText::_('CC FRIEND REQUEST CANCELED');
			
			//add user points - friends.request.cancel removed @ 20090313
		}
		else
		{
			$message	= JText::_('CC FRIEND REQUEST CANCELLED ERROR');
		}

		$view->addInfo( $message );
		$this->sent();
	}

	 /**
	  * functino tag() removed @ 02-oct-2009
	  * functino ajaxAssignTag() removed @ 02-oct-2009	  
	  */

	/**
	 * Ajax function to reject a friend request
	 **/
	function ajaxRejectRequest( $requestId )
	{
		$objResponse	= new JAXResponse();
		$my				= CFactory::getUser();
		$friendsModel	=& CFactory::getModel('friends');
		
		if($my->id == 0)
		{
		   return $this->ajaxBlockUnregister();
		}		

		if( $friendsModel->isMyRequest( $requestId , $my->id) )
		{
			$pendingInfo = $friendsModel->getPendingUserId($requestId);
			
			if( $friendsModel->rejectRequest( $requestId ) )
			{
				
				//add user points - friends.request.reject removed @ 20090313
			
				$objResponse->addScriptCall( 'jQuery("#request-notice").html("' . JText::_('CC FRIEND REQUEST REJECTED') . '");' );
				$objResponse->addScriptCall( 'jQuery("#request-notice").attr("class", "info");');
				$objResponse->addScriptCall( 'jQuery("#pending-' . $requestId . '").remove();');
				
				//trigger for onFriendReject
				$eventObject = new stdClass();
				$eventObject->profileOwnerId 	= $my->id;
				$eventObject->friendId 			= $pendingInfo->connect_from;
				$this->triggerFriendEvents( 'onFriendReject' , $eventObject);
				unset($eventObject);
			}
			else
			{
				$objResponse->addScriptCall( 'jQuery("#request-notice").html("' . JText::sprintf('CC FRIEND REQUEST REJECT FAILED', $requestId ) . '");' );
				$objResponse->addScriptCall( 'jQuery("#request-notice").attr("class", "error");');
			}

		}
		else
		{
			$objResponse->addScriptCall( 'jQuery("#request-notice").html("' . JText::_('CC NOT YOUR REQUEST') . '");' );
			$objResponse->addScriptCall( 'jQuery("#request-notice").attr("class", "error");');
		}

		return $objResponse->sendResponse();

	}

	/**
	 * Ajax function to approve a friend request
	 **/
	function ajaxApproveRequest( $requestId )
	{
		$objResponse	= new JAXResponse();
		$my				= CFactory::getUser();
		$friendsModel	=& CFactory::getModel( 'friends' );
		
		if($my->id == 0)
		{
		   return $this->ajaxBlockUnregister();
		}		

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
				
				//add user points - give points to both parties
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

				$objResponse->addScriptCall( 'jQuery("#request-notice").html("' . addslashes(JText::sprintf('CC FRIENDS NOW', $friend->getDisplayName())) . '");' );
				$objResponse->addScriptCall( 'jQuery("#request-notice").attr("class", "info");');
				$objResponse->addScriptCall( 'jQuery("#pending-' . $requestId . '").remove();');
				
				//trigger for onFriendApprove			
				$eventObject = new stdClass();
				$eventObject->profileOwnerId 	= $my->id;
				$eventObject->friendId 			= $friendId;
				$this->triggerFriendEvents( 'onFriendApprove' , $eventObject);
				unset($eventObject);
			}
		}
		else
		{
			$objResponse->addScriptCall( 'jQuery("#request-notice").html("' . JText::_('CC NOT YOUR REQUEST') . '");' );
			$objResponse->addScriptCall( 'jQuery("#request-notice").attr("class", "error");');
		}

		return $objResponse->sendResponse();
	}


	function ajaxSaveFriend($postVars)
	{
		$objResponse   = new JAXResponse();//
		//@todo filter paramater
		$model =& $this->getModel('friends');
		$my = CFactory::getUser();
		
		if($my->id == 0)
		{
		   return $this->ajaxBlockUnregister();
		}		

		$postVars = CAjax::toArray($postVars);
		$id = $postVars['userid']; //get it from post
		$msg = strip_tags($postVars['msg']);
		$data  = CFactory::getUser($id);

		if(count($postVars)>0)
		{
			//require_once (JPATH_COMPONENT.DS.'libraries'.DS.'notification.php');

			$model->addFriend($id, $my->id, $msg);

			$html 	= JText::sprintf( 'CC FRIEND WILL RECEIVE REQUEST' , $data->getDisplayName());

		    $objResponse->addAssign('cWindowContent', 'innerHTML', $html );
			$objResponse->addScriptCall('cWindowResize', 110);
			$action = '<button class="button" onclick="cWindowHide();" name="close">' . JText::_('CC BUTTON CLOSE') . '</button>';
			$objResponse->addScriptCall('cWindowActions', $action);
			
			// Add notification
			$nData = array ('url' => CRoute::getExternalURL('index.php?option=com_community&view=friends&task=pending', false),
							'message' => $msg);
			$this->_notify ( 'friends.create.connection', $my->id, $id, JText::sprintf('CC FRIEND ADD REQUEST' , $my->getDisplayName()), '', 'friends.email.request', $nData );
			
			//add user points - friends.request.add removed @ 20090313
			
			//trigger for onFriendRequest
			$eventObject = new stdClass();
			$eventObject->profileOwnerId 	= $my->id;
			$eventObject->friendId 			= $id;
			$this->triggerFriendEvents( 'onFriendRequest' , $eventObject);
			unset($eventObject);
		 }


		return $objResponse->sendResponse();
	}

	/**
	 * Show internal invite
	 * Internal invite is more like an internal messaging system
	 */
	function ajaxInvite() {
		return $objResponse->sendResponse();
	}

	/**
	 * Show import friends from other account
	 *
	 */
	function ajaxFrindImport() {
	}


	/**
	 * Displays a dialog to the user if he / she really wants to
	 * cancel the friend request
	 **/
	function ajaxCancelRequest( $friendsId )
	{
		$my = CFactory::getUser();
	
		if($my->id == 0)
		{
		   return $this->ajaxBlockUnregister();
		}	
	
		$objResponse	= new JAXResponse();

		$html		= '<div>' . JText::_('CC CONFIRM CANCEL REQUEST') . '</div>';

		$formAction	= CRoute::_('index.php?option=com_community&view=friends&task=deleteSent' , false );
		$action		= '<form name="cancelRequest" action="' . $formAction . '" method="POST">';
		$action		.= '<input type="submit" class="button" name="save" value="' . JText::_('CC BUTTON YES') . '" />&nbsp;';
		$action		.= '<input type="hidden" name="fid" value="' . $friendsId . '" />';
		$action		.= '<input type="button" class="button" onclick="javascript:cWindowHide();return false;" name="cancel" value="'.JText::_('CC BUTTON NO').'" />';
		$action		.= '</form>';

		$objResponse->addAssign('cwin_logo', 'innerHTML', JText::_('CC CANCEL FRIEND REQUEST'));
		$objResponse->addAssign('cWindowContent', 'innerHTML', $html);
		$objResponse->addScriptCall('cWindowActions', $action);
		$objResponse->sendResponse();
	}

	/**
	 *Assign tags to each friends
	 */
// 	function ajaxFriendTagSave($postVars){
// 
// 		$objResponse    = new JAXResponse();
// 		//$postVars = CAjax::toArray($postVars);
// 		$data = $postVars;
// 		$tags = array();
// 
// 		//arrange post vars data
// 		foreach ($data as $key => $value)
// 		{
// 
// 		  if($value[0]=='tags[]')
// 		  {
// 		  	$tags[]=$value[1]; //store tags value in array
// 		  }
// 		  elseif($value[0]=='user_id')
// 		  {
// 		  	$user_id=$value[1]; //user_id
// 		  }
// 		}
// 
// 		$model=$this->getModel('friends');
// 
// 		//1- search for user_id in community_friendgroup
// 		$where['user_id'] = $user_id;
// 		$rows=$model->getFriendsTag($where);
// 
// 
// 		//2- loop through each record from step 1.
// 		// 2.1 - check each group_id data does exist in array tags[], if not exists delete that record
// 		//       basically do a delete on unchecked tag
// 		foreach($rows as $row)
// 		{
// 		  if(!in_array($row->group_id,$tags))
// 		  {
// 		  	//echo $row->group_id.'|'.$row->user_id.' deleted';
// 		  	$model->deleteFriendsTag($row->user_id,$row->group_id);
// 		  }
// 		}
// 
// 
// 		//3-  loop through tags[] array
// 		// 3.1 - check user_id and tags_id exist,if not insert new record
// 		foreach ($tags as $tag)
// 		{
// 			$where['group_id'] = $tag;
// 			$rows=$model->getFriendsTag($where);
// 
// 			if(count($rows)==0) //if record not exist, add it
// 			{
// 				$vars['user_id']=$user_id;
// 				$vars['group_id']=$tag;
// 				$model->setFriendsTag($vars);
// 			}
// 		}
// 
// 
// 		$tagslist = $model->getFriendsTagNames($user_id);
// 		$tagsz='';
// 		foreach($tagslist as $tagid => $tagname)
// 		{
// 		   $tagsz .=' <a href="'.CUrl::build('friends', 'tag').'&tagid='.$tagid.'">'.$tagname.'</a> ';
// 		}
// 
// 
// 		$objResponse->addScriptCall("jQuery('#tag-$user_id').html('$tagsz');");
// 		$objResponse->addScriptCall('cWindowHide');
// 		$objResponse->addAlert('Friend tags updated');
// 
// 		return $objResponse->sendResponse();
// 
// 
// 	}

	/**
	 * Show the connection request box
	 */
	function ajaxConnect( $friendId )
	{
		// Block unregistered users.
		if (!isRegisteredUser())
		{
			return $this->ajaxBlockUnregister();
		}
		$objResponse = new JAXResponse();

		//@todo filter paramater
		$model	=& $this->getModel('friends');

        $my 			= CFactory::getUser();
		$view			= $this->getView('friends');
		$user  			= CFactory::getUser($friendId);

		$connection		= $model->getFriendConnection( $my->id , $friendId );
		
		//@todo disallow self add as a friend
		//@todo disallow add existing friend
		if($my->id == $friendId)
		{
			$objResponse->addAssign('cWindowContent','innerHTML',JText::_('CC FRIEND CANNOT ADD SELF'));
			$objResponse->addScriptCall('cWindowResize', 100);
		}
		elseif(count( $connection ) > 0 )
		{
			if( $connection[0]->connect_from == $my->id )
			{
				$objResponse->addAssign('cWindowContent','innerHTML',JText::sprintf('CC FRIEND REQUEST ALREADY SENT', $user->getDisplayName()));
			}
			else
			{
				$objResponse->addAssign('cWindowContent','innerHTML',JText::sprintf('CC FRIEND REQUEST ALREADY RECEIVED', $user->getDisplayName()));
			}
			$objResponse->addScriptCall('cWindowResize', 100);
		}
		else
		{
			ob_start();
		?>
		<div id="addFriendContainer">
			<p><?php echo JText::sprintf('CC CONFIRM ADD FRIEND' , $user->getDisplayName() );?></p>
			<form name="addfriend" id="addfriend" method="post" action="">				
		        <img class="avatar" src="<?php echo $user->getThumbAvatar(); ?>" alt="<?php echo $user->getDisplayName();?>" alt=""/>
				<textarea class="inputbox" name="msg"></textarea>
				<input type="hidden" class="button" name="userid" value="<?php echo $user->id; ?>"/>
			</form>
		</div>
		<?php
			$html	= ob_get_contents();
			ob_end_clean();

		    $action  = '<button class="button" onclick="joms.friends.addNow();" name="save">' . JText::_('CC BUTTON ADD FRIEND') . '</button>';
		    $action .= '<button class="button" onclick="javascript:cWindowHide();" name="cancel">' . JText::_('CC BUTTON CANCEL') . '</button>';
			
			$objResponse->addAssign('cwin_logo', 'innerHTML', JText::_('CC FRIEND ADD'));
			$objResponse->addAssign('cWindowContent', 'innerHTML', $html);
			$objResponse->addScriptCall('cWindowActions', $action);
			$objResponse->addScriptCall('cWindowResize', 130);
		}

		return $objResponse->sendResponse();
	}


	/**
	 * List down all connection request waiting for user to approve
	 */
	function pending()
	{	

		$my		= CFactory::getUser();
		if($my->id == 0)
		{
		   return $this->blockUnregister();
		}

		$view		= $this->getView('friends');
		$model		=& $this->getModel('friends');
		$usermodel	=& $this->getModel('user');

		// @todo: make sure the rejectId and approveId is valid for this user
		if($id = JRequest::getVar('rejectId', 0, 'GET'))
		{
		    $mainframe =& JFactory::getApplication();

			if(! $model->rejectRequest($id)){
				$mainframe->enqueueMessage(JText::sprintf('CC RRIEND REQUEST REJECT FAILED', $id));
			}
		}

		if($id = JRequest::getVar('approveId', 0, 'GET'))
		{
			$mainframe =& JFactory::getApplication();
			$connected = $model->approveRequest($id);

			// If approbe id is not valid or already approve, $connected will
			// be null.. yuck
			if($connected) {
				$act = new stdClass();
				$act->cmd 		= 'friends.request.approve';
				$act->actor   	= $connected[0];
				$act->target  	= $connected[1];
				$act->title	  	= JText::_('CC ACTIVITIES FRIENDS NOW');
				$act->content	= '';
				$act->app		= 'friends';
				$act->cid		= 0;

				CFactory::load ( 'libraries', 'activities' );
				CActivityStream::add($act);
				
				//add user points - give points to both parties
				CFactory::load( 'libraries' , 'userpoints' );		
				CUserPoints::assignPoint('friends.request.approve');				

				$friendId = ( $connected[0] == $my->id ) ? $connected[1] : $connected[0];
				$friend = CFactory::getUser($friendId);
				CUserPoints::assignPoint('friends.request.approve', $friendId);

				$mainframe->enqueueMessage(JText::sprintf('CC FRIENDS NOW', $friend->getDisplayName()));
			}
		}

		$data		= new stdClass();
		$rpending	= $model->getPending($my->id);

		$data->pending		= $rpending;
		$data->pagination	=& $model->getPagination();

		echo $view->get(__FUNCTION__, $data);
	}

	/**
	 * Browse the active user's friends
	 */
	function browse(){
		$view =& $this->getView('friends');
		echo $view->get('browse');

	}

	function search()
	{
		$view =& $this->getView('friends');
		$data = array();
		$data['query'] 	= '';
		$data['result']	= null;

		// If a query is sent, seach for it
		if($query = JRequest::getVar('q', '', 'POST')){
			$model =& $this->getModel('friends');
			$data['result'] = $model->searchPeople($query);
			$data['query'] 	= $query;
		}

		echo $view->get(__FUNCTION__, $data);
	}
	
	/*
	 * friends event name
	 * object	 	
     */	
	function triggerFriendEvents( $eventName, &$args, $target = null)
	{
		CError::assert( $args , 'object', 'istype', __FILE__ , __LINE__ );
		
		require_once( COMMUNITY_COM_PATH.DS.'libraries' . DS . 'apps.php' );
		$appsLib	=& CAppPlugins::getInstance();
		$appsLib->loadApplications();		
		
		$params		= array();
		$params[]	= &$args;
		
		if(!is_null($target))
			$params[]	= $target;
				
		$appsLib->triggerEvent( $eventName , $params);
		return true;
	}
	
// 	// Browse the whole site for public_friends
// 	function browse()
// 	{
// 		$model =& $this->getModel('friends');
// 		$data = $model->getFiltered();
//
// 		$view = $this->getView('friends');
// 		echo $view->get(__FUNCTION__, $data);
// 	}
}
