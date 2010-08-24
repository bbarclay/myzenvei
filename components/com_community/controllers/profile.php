<?php
/**
 * @package	JomSocial
 * @copyright (C) 2008 by Slashes & Dots Sdn Bhd - All rights reserved!
 * @license http://www.jomsocial.com Copyrighted Commercial Software
 */
// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die();

class CommunityProfileController extends CommunityBaseController
{
	/**
	 * Edit a user's profile	
	 * 	 	
	 * @access	public
	 * @param	none 
	 */
    var $_icon = '';
    
    function ajaxIphoneProfile()
    {
		$objResponse	= new JAXResponse();		
		$document		=& JFactory::getDocument();
		
		$viewType	= $document->getType(); 		 	
		$view		=& $this->getView( 'profile', '', $viewType);
						
		
		$html = '';
		
		ob_start();				
		$this->profile();				
		$content = ob_get_contents();
		ob_end_clean();
		
		$tmpl			= new CTemplate();
		$tmpl->set('toolbar_active', 'profile');
		$simpleToolbar	= $tmpl->fetch('toolbar.simple');		
		
		$objResponse->addAssign('social-content', 'innerHTML', $simpleToolbar . $content);
		return $objResponse->sendResponse();		    	
    }

	/**
	 *	Ajax method to block user from the site. This method is only used by site administrators
	 *	
	 *	@params	$userId	int	The user id that needs to be blocked
	 *	@params	$isBlocked	boolean	Whether the user is already blocked or not. If it is blocked, system should unblock it.	 	 	 
	 **/	 	
	function ajaxBlockUser( $userId , $isBlocked )
	{
		$user	= CFactory::getUser( $userId );
		
		$objResponse	= new JAXResponse();
		$title			= '';
		$my				= CFactory::getUser();
		CFactory::load( 'helpers' , 'owner' );
		
		if($my->id == 0)
		{
		   	return $this->ajaxBlockUnregister();
		}
		
		// @rule: Only site admin can access this function.
		if( isCommunityAdmin( $my->id ) )
		{
			$isSuperAdmin	= isCommunityAdmin( $user->id );

			// @rule: Do not allow to block super administrators.
			if( $isSuperAdmin )
			{
				$content	= '<div>' . JText::_('CC NOT ALLOWED TO BLOCK SUPER ADMIN') . '</div>';
	
				$objResponse->addAssign('cWindowContent', 'innerHTML', $content);
	
				$action		= '<input type="button" class="button" onclick="cWindowHide();return false;" name="cancel" value="'.JText::_('CC BUTTON CLOSE').'" />';
				$objResponse->addScriptCall('cWindowActions', $action);
			}
			else
			{
				ob_start();
				if( !$isBlocked )
				{
				?>
				<div><?php echo JText::sprintf( 'CC BLOCK USER CONFIRMATION' , $user->getDisplayName() ); ?></div>
				<?php
					$title	= JText::_('CC BLOCK USER');
				}
				else
				{
				?>
				<div><?php echo JText::sprintf( 'CC UNBLOCK USER CONFIRMATION' , $user->getDisplayName() ); ?></div>
				<?php
				$title	= JText::_('CC UNBLOCK USER');
				}
				$content		= ob_get_contents();
				ob_end_clean();
				
				$objResponse->addAssign('cwin_logo', 'innerHTML', $title );
				$objResponse->addAssign('cWindowContent', 'innerHTML', $content);
	
				$formAction	= CRoute::_('index.php?option=com_community&view=profile&task=blockuser' , false );
				$action		= '<form name="cancelRequest" action="' . $formAction . '" method="POST">';
				$action		.= '<input type="hidden" name="userid" value="' . $userId . '" />';
				$action		.= ( $isBlocked ) ? '<input type="hidden" name="blocked" value="1" />' : '';
				$action		.= '<input type="submit" value="' . JText::_('CC BUTTON YES') . '" class="button" />&nbsp;';
				$action		.= '<input type="button" class="button" onclick="cWindowHide();return false;" name="cancel" value="'.JText::_('CC BUTTON NO').'" />';
				$action		.= '</form>';

				$objResponse->addScriptCall('cWindowActions', $action);
				$objResponse->addScriptCall('cWindowResize', '100');
			}
		}
		
		return $objResponse->sendResponse();
	}

	/**
	 *	Ajax method to remove user's picture from the site. This method is only used by site administrators
	 *	
	 *	@params	$userId	int	The user id that needs to have their picture removed.	 	 	 
	 **/
	function ajaxRemovePicture( $userId )
	{
		$objResponse	= new JAXResponse();

		$my				= CFactory::getUser();
		CFactory::load( 'helpers' , 'owner' );
		
		if($my->id == 0)
		{
		   	return $this->ajaxBlockUnregister();
		}		
		
		// @rule: Only site admin can access this function.
		if( isCommunityAdmin( $my->id ) )
		{
			ob_start();
			?>
				<div><?php echo JText::_( 'CC REMOVE AVATAR CONFIRMATION'); ?></div>
			<?php
			$content		= ob_get_contents();
			ob_end_clean();
	
			$title	= JText::_('CC REMOVE PROFILE PICTURE');
			$objResponse->addAssign('cWindowContent', 'innerHTML', $content);
			$objResponse->addAssign('cwin_logo', 'innerHTML', $title );
			
			$formAction	= CRoute::_('index.php?option=com_community&view=profile&task=removepicture' , false );
			$action		= '<form name="cancelRequest" action="' . $formAction . '" method="POST">';
			$action		.= '<input type="hidden" name="userid" value="' . $userId . '" />';
			$action		.= '<input type="submit" value="' . JText::_('CC BUTTON YES') . '" class="button" />&nbsp;';
			$action		.= '<input type="button" class="button" onclick="cWindowHide();return false;" value="'.JText::_('CC BUTTON NO').'" />';
			$action		.= '</form>';
			
			$objResponse->addScriptCall('cWindowActions', $action);
		}
		return $objResponse->sendResponse();
	}
	/**
	 * Block user from the system
	 **/
	function blockuser()
	{
		CFactory::load( 'helpers' , 'owner' );
		
		$message	= '';
		$userId		= JRequest::getVar( 'userid' , '' , 'POST' );
		$blocked	= JRequest::getVar( 'blocked' , 0 , 'POST' );
		
		$my			= CFactory::getUser();
		$url		= CRoute::_('index.php?option=com_community&view=profile&userid=' . $userId , false );
		$mainframe	=& JFactory::getApplication();
		
		if($my->id == 0)
		{
		   return $this->blockUnregister();
		}		
		
		if( isCommunityAdmin() )
		{
			$user	= CFactory::getUser( $userId );
			
			if( $user->id )
			{
				$user->block	= ( $blocked == 1 ) ? 0 : 1;
				$user->save();
				
				$message		= ( $blocked == 1 ) ? JText::_('CC USER UNBLOCKED') : JText::_('CC USER BLOCKED');
			}
			else
			{
				$message	= JText::_('CC INVALID PROFILE');
			}
		}
		else
		{
			$message	= JText::_('CC ADMIN ACCESS ONLY');
		}
		
		$mainframe->redirect( $url , $message );
	}

	/**
	 * Reverts profile picture for specific user
	 **/	 	
	function removepicture()
	{
		CFactory::load( 'helpers' , 'owner' );
		
		$message	= '';
		$userId		= JRequest::getVar( 'userid' , '' , 'POST' );
		$my			= CFactory::getUser();
		$url		= CRoute::_('index.php?option=com_community&view=profile&userid=' . $userId , false );
		$mainframe	=& JFactory::getApplication();
		
		if($my->id == 0)
		{
		   return $this->blockUnregister();
		}		
		
		if( isCommunityAdmin() )
		{
			$user	= CFactory::getUser( $userId );
			
			// User id should be valid and admin should not be allowed to block themselves.
			if( $user->id )
			{
				$userModel		=& CFactory::getModel( 'User' );
				$userModel->setImage( $user->id , DEFAULT_USER_AVATAR , 'avatar');
				$userModel->setImage( $user->id , DEFAULT_USER_THUMB , 'thumb');
								
				$message		= JText::_('CC PROFILE PICTURE REMOVED');
			}
			else
			{
				$message	= JText::_('CC INVALID PROFILE');
			}
		}
		else
		{
			$message	= JText::_('CC ADMIN ACCESS ONLY');
		}
		
		$mainframe->redirect( $url , $message );
	}
	
	/**
	 * Method is called from the reporting library. Function calls should be
	 * registered here.
	 *
	 * return	String	Message that will be displayed to user upon submission.
	 **/	 	 	
	function reportProfile( $link, $message , $id )
	{
		CFactory::load( 'libraries' , 'reporting' );
		$report = new CReportingLibrary();
		
		$report->createReport( JText::_('Bad user') , $link , $message );

		$action					= new stdClass();
		$action->label			= 'Block User';
		$action->method			= 'profile,blockProfile';
		$action->parameters		= $id;
		$action->defaultAction	= false;
		
		$report->addActions( array( $action ) );
		
		return JText::_('CC REPORT SUBMITTED');
	}
	
	/**
	 * Function that is called from the back end
	 **/	 	
	function blockProfile( $userId )
	{
		$user		= CFactory::getUser( $userId );
		
		CFactory::load( 'helpers' , 'owner' );
		
		if( isCommunityAdmin() )
		{
			$user->set( 'block' , 1 );
			$user->save();
			return JText::_('CC USER ACCOUNT BLOCKED');
		}
	}
	
	function edit()
	{
		CFactory::setActiveProfile();
		
		$user	=& JFactory::getUser();
		
		if($user->id == 0)
		{
		   return $this->blockUnregister();
		}				
		
		if(JRequest::getVar('action', '', 'POST') != ''){
			$this->_saveProfile();
		}
		
		// Get/Create the model
		$model = & $this->getModel('profile');
		$model->setProfile('hello me');
		
		$document =& JFactory::getDocument();

		$viewType	= $document->getType();	
 		$viewName	= JRequest::getCmd( 'view', $this->getName() );

		// Check if user is really allowed to edit.	
		$data = new stdClass();
		$data->profile		= $model->getEditableProfile($user->id);
		

		$view = & $this->getView( $viewName, '', $viewType);

		$this->_icon = 'edit';

		if(!$data->profile)
			echo $view->get('error', JText::_('CC USER NOT FOUND') );
		else
			echo $view->get(__FUNCTION__, $data);
	}


	function editDetails()
	{		
		$user		=& JFactory::getUser();
		$mainframe	=& JFactory::getApplication();
		$view		=& $this->getView ( 'profile' );

		if($user->id == 0){
			return $this->blockUnregister();
		}
				
		$lang	=& JFactory::getLanguage();
		$lang->load('com_user');

		// Check if user is really allowed to edit.
		$params =& $mainframe->getParams();

		// check to see if Frontend User Params have been enabled
		$usersConfig = &JComponentHelper::getParams( 'com_users' );
		$check = $usersConfig->get('frontend_userparams');

		if ($check == '1' || $check == 1 || $check == NULL)
		{
			if($user->authorize( 'com_user', 'edit' )) {
				$params		= $user->getParameters(true);
			}
		}
		
		$my			= CFactory::getUser();
		$config		=& CFactory::getConfig();
		
		$myParams	=& $my->getParams();
		$myDTS		= $myParams->get('daylightsavingoffset'); 		
		$cOffset	= (! empty($myDTS)) ? $myDTS : $config->get('daylightsavingoffset');

		$dstOffset	= array();
		$counter = -12;
		for($i=0; $i <= 24; $i++ ){
			$dstOffset[] = 	JHTML::_('select.option', $counter, $counter);
			$counter++;
		}
		
		$offSetLists = JHTML::_('select.genericlist',  $dstOffset, 'daylightsavingoffset', 'class="inputbox" size="1"', 'value', 'text', $cOffset);		
		
		$data = new stdClass();		
		$data->params		= $params;
		$data->offsetList	= $offSetLists;
		
		
		$this->_icon = 'edit';				
		
		echo $view->get ( 'editDetails', $data);
	}
	
	
	function save()
	{
		// Check for request forgeries
		$mainframe	=& JFactory::getApplication();
		JRequest::checkToken() or jexit( 'CC INVALID TOKEN' );
		
		$lang	=& JFactory::getLanguage();
		$lang->load('com_user');		
		
		$user 		=& JFactory::getUser();
		$userid		= JRequest::getVar( 'id', 0, 'post', 'int' );		

		// preform security checks
		if ($user->get('id') == 0 || $userid == 0 || $userid <> $user->get('id'))
		{
			echo $this->blockUnregister();
			return;
		}

		$username	= $user->get('username');
	
		//clean request
		$post = JRequest::get( 'post' );
		$post['username']	= $username;//JRequest::getVar('username', $username, 'post', 'username');
		$post['password']	= JRequest::getVar('password', '', 'post', 'string', JREQUEST_ALLOWRAW);
		$post['password2']	= JRequest::getVar('password2', '', 'post', 'string', JREQUEST_ALLOWRAW);
		
		
		//check email
	    $email		= $post['email'];
	    $emailPass	= $post['emailpass'];
	    $modelReg	=& $this->getModel('register');
	    
	    CFactory::load( 'helpers' , 'emails' );
	    if(!isValidInetAddress($email))
	    {
	    	$msg = JText::sprintf('CC INVITE EMAIL INVALID', $email);
			$mainframe->redirect(CRoute::_('index.php?option=com_community&view=profile&task=editDetails', false), $msg, 'error');
			return false;
	    }
	    
	    if(! empty($email) && ($email != $emailPass)){
	        if($modelReg->isEmailExists(array('email'=>$email)))
			{
				$msg = JText::sprintf('CC EMAIL EXIST', $email);
				$msg = stripslashes($msg);
				$mainframe->redirect(CRoute::_('index.php?option=com_community&view=profile&task=editDetails', false), $msg, 'error');
				return false;			
			}    
	    }
	
		// get the redirect
		$return = CRoute::_('index.php?option=com_community&view=profile&task=editDetails', false);


		// do a password safety check
		if(strlen($post['password']) || strlen($post['password2'])) 
		{ // so that "0" can be used as password e.g.
			if($post['password'] != $post['password2']) 
			{
				$msg = JText::_('PASSWORDS_DO_NOT_MATCH');
				$mainframe->redirect(CRoute::_('index.php?option=com_community&view=profile&task=editDetails', false), $msg, 'error');
				return false;
			}
		}
		
		// we don't want users to edit certain fields so we will unset them
		unset($post['gid']);
		unset($post['block']);
		unset($post['usertype']);
		unset($post['registerDate']);
		unset($post['activation']);

		//update CUser param 1st so that the new value will not be replace wif the old one.
		$my			= CFactory::getUser();
		$params		=& $my->getParams();
		$postvars	= $post['daylightsavingoffset'];
		$params->set('daylightsavingoffset', $postvars);		
		$my->save('params');
		
		
		$editSuccess	= true;	
		$msg			= JText::_( 'CC SETTINGS SAVED' );	
		$jUser			= JFactory::getUser();

		// Bind the form fields to the user table
		if (!$jUser->bind($post))
		{
			$msg = $jUser->getError();
			$editSuccess = false;
		}

		// Store the web link table to the database
		if (!$jUser->save()) {
			$msg	= $jUser->getError();
			$editSuccess = false;
		}

		if($editSuccess)
		{
			$session =& JFactory::getSession();
			$session->set('user', $jUser);
			
			//execute the trigger
			$appsLib	=& CAppPlugins::getInstance();
			$appsLib->loadApplications();
			
			$userRow	= array();
			$userRow[]	= $jUser;
			 
			$appsLib->triggerEvent( 'onUserDetailsUpdate' , $userRow );
		}
		
		//done
		$mainframe->redirect(CRoute::_('index.php?option=com_community&view=profile&task=editDetails', false), $msg);
	}	
	
	/**
	 * Show rss feed for this user
	 */	 	
	function feed(){
		$document	=& JFactory::getDocument();
		
		$item = new JFeedItem();
		$item->author = '';
		$document->addItem($item);
	}
	
	/**
	 * Saves a user's profile	
	 * 	 	
	 * @access	private
	 * @param	none 
	 */
	function _saveProfile()
	{
		
		$model		=& $this->getModel('profile');
		$document	=& JFactory::getDocument();
		$my			= CFactory::getUser();
		
		if($my->id == 0)
		{
		   return $this->blockUnregister();
		}		
		
		$values		= array();
		$profiles	= $model->getEditableProfile( $my->id );
		$mainframe	=& JFactory::getApplication();
		
		CFactory::load( 'libraries' , 'profile' );
		
		foreach( $profiles['fields'] as $group => $fields )
		{
			foreach( $fields as $data )
			{
				// Get value from posted data and map it to the field.
				// Here we need to prepend the 'field' before the id because in the form, the 'field' is prepended to the id.
				$postData				= JRequest::getVar( 'field' . $data['id'] , '' , 'POST' );
				$values[ $data['id'] ]	= CProfileLibrary::formatData( $data['type']  , $postData );

				// @rule: Validate custom profile if necessary
				if( !CProfileLibrary::validateField( $data['type'] , $values[ $data['id'] ] , $data['required']) )
				{
					// If there are errors on the form, display to the user.
					$message	= JText::sprintf('CC FIELD CONTAIN IMPROPER VALUES' ,  $data['name'] );
					$mainframe->enqueueMessage( $message , 'error' );
					return;
				}
			}
		}
		
		// Rebuild new $values with field code
		$valuesCode = array();
		foreach( $values as $key => &$val ) {
			$fieldCode = $model->getFieldCode($key);
			if( $fieldCode ){
				$valuesCode[$fieldCode] = &$val;
			}
		}
		
		$saveSuccess = true;
		$appsLib	=& CAppPlugins::getInstance();
		$appsLib->loadApplications();
		
		// Trigger before onBeforeUserProfileUpdate
		$args 	= array();
		$args[]	= $my->id;
		$args[]	= $valuesCode;

		$result = $appsLib->triggerEvent( 'onBeforeProfileUpdate' , $args );
		
		// make sure none of the $result is false
		if(!$result || ( !in_array(false, $result) ) ) {
			 $model->saveProfile($my->id, $values);
		} else {
			$saveSuccess = false;
		}
		

		// Trigger before onAfterUserProfileUpdate
		$args 	= array();
		$args[]	= $my->id;
		$args[]	= $saveSuccess; 
		$result = $appsLib->triggerEvent( 'onAfterProfileUpdate' , $args );
		
		if( $saveSuccess )
		{
			CFactory::load( 'libraries' , 'userpoints' );		
			CUserPoints::assignPoint('profile.save');		
	
			$mainframe->enqueueMessage(JText::_('CC PROFILE SAVED') );
			
			
		} else {
			
			$mainframe->enqueueMessage( JText::_('CC PROFILE NOT SAVED'), 'error');
			
		}
	}
	
	/**
	 * Displays front page profile of user
	 * 	 	
	 * @access	public
	 * @param	none
	 * @returns none	 
	 */
	function display()
	{
		// By default, display the user profile page
		$this->profile();
	}
	
	function preferences()
	{
		$view	=& $this->getView('profile');
		$my		= CFactory::getUser();
		
		if($my->id == 0)
		{
		   return $this->blockUnregister();
		}		
		
		$method	= JRequest::getMethod();
		
		if($method == 'POST')
		{			
			$params		= $my->getParams();
			$postvars	= JRequest::get('POST');
			
			foreach( $postvars as $key => $val )
			{
				$params->set( $key , $val );
			}
			$my->save( 'params' );

			$mainframe =& JFactory::getApplication();
			$mainframe->enqueueMessage( JText::_('CC PREFERENCES SETTINGS SAVED') );
		}
		echo $view->get(__FUNCTION__);
	}
	
	/**
	 * Allow user to set their privacy setting.
	 * User privacy setting is actually just part of their params	 
	 */	 	
	function privacy()
	{
		CFactory::setActiveProfile();
		$my		= CFactory::getUser();
		
		if($my->id == 0)
		{
		   return $this->blockUnregister();
		}		
		
		if(JRequest::getVar( 'action', '', 'POST') != '' )
		{
			$params		=& $my->getParams();
			$postvars	= JRequest::get('POST');
			$previousProfilePermission	= $my->get('privacyProfileView');
			
			foreach($postvars as $key => $val)
			{
				$params->set($key, $val);
			}
			$my->save('params');

			//add user points
			CFactory::load( 'libraries' , 'userpoints' );		
			CUserPoints::assignPoint('profile.privacy.update');
			
 			//Update all photos and album permission
			$photoPermission	= JRequest::getVar('privacyPhotoView', 0, 'POST');
			$photoModel			= CFactory::getModel('photos');
			$photoModel->updatePermission($my->id, $photoPermission);

			//update all profile related activity streams.
			$profilePermission = JRequest::getVar('privacyProfileView', 0, 'POST');
			$activityModel = CFactory::getModel('activities');
			$activityModel->updatePermission($profilePermission, $previousProfilePermission , $my->id );
			
			$mainframe =& JFactory::getApplication();
			$mainframe->enqueueMessage( JText::_('CC PRIVACY SETTINGS SAVED') );

		}
		
		$view =& CFactory::getView('profile');
		echo $view->get('privacy');
	}
	
	/**
	 * Viewing a user's profile
	 * 	 	
	 * @access	public
	 * @param	none
	 * @returns none	 
	 */
	function profile()
	{
		// Set cookie
		$userid = JRequest::getVar('userid', 0, 'GET');		
		
		$data			= new stdClass();
        $model 			=& $this->getModel('profile');
		$my 			= CFactory::getUser();
		
		// Test if userid is 0, check if the user is viewing its own profile.
		if( $userid == 0 && $my->id != 0 )
		{
			$userid 	= $my->id;
			
			// We need to set the 'userid' var so that other code that uses
			// JRequest::getVar will work properly
			JRequest::setVar('userid', $userid);
		}
		
		$data->profile	= $model->getViewableProfile( $userid );

		//show error if user id invalid / not found.
        if(empty($data->profile['id']) )
		{
			$this->blockUnregister();		
		}
		else
		{
				
			CFactory::setActiveProfile($userid);
			
			$my			= CFactory::getUser();
			$appsModel	=& CFactory::getModel('apps');
					
			$avatar		=& $this->getModel('avatar');
			
			$document 	=& JFactory::getDocument();
	
			$viewType	= $document->getType();	
	 		//$viewName	= JRequest::getCmd( 'view', $this->getName() ); 						
			$view = & $this->getView( 'profile', '', $viewType);
			
			require_once (JPATH_COMPONENT.DS.'helpers'.DS.'friends.php');
			require_once (JPATH_COMPONENT.DS.'libraries'.DS.'template.php');
			
			// Try initialize the user id. Maybe that user is logged in.
			$user	= CFactory::getUser( $userid );
			$id		= $user->id;		

			$data->largeAvatar			= $my->getAvatar();
			
			// Assign the user object for the current viewer whether a guest or a member
			$data->user		= $user;			
			$data->apps		= array();
			
		
			if(!$id)
			{
				echo $view->get('error', JText::_('CC USER NOT FOUND') );
			}
			else
			{
				echo $view->get(__FUNCTION__, $data, $id);
			}
		}//end if else
	}
	
	/**
	 * Upload a new user avatar
	 */	 	
	function uploadAvatar()
	{
		CFactory::setActiveProfile();
		
		jimport('joomla.filesystem.file');
		jimport('joomla.utilities.utility');

		$view 	= & $this->getView( 'profile');

		CFactory::load( 'helpers' , 'image' );
		
		$my			= CFactory::getUser();
		
		if($my->id == 0)
		{
		   return $this->blockUnregister();
		}				
		
		// If uplaod is detected, we process the uploaded avatar
		if( JRequest::getVar('action', '', 'POST') )
		{
			$mainframe =& JFactory::getApplication();
						
			$file		= JRequest::getVar( 'Filedata' , '' , 'FILES' , 'array' );

			if( !isset( $file['tmp_name'] ) || empty( $file['tmp_name'] ) )
			{	
				$mainframe->enqueueMessage(JText::_('CC NO POST DATA'), 'error');
			}
			else
			{
				$config			= CFactory::getConfig();
				$uploadLimit	= (double) $config->get('maxuploadsize');
				$uploadLimit	= ( $uploadLimit * 1024 * 1024 );

				// @rule: Limit image size based on the maximum upload allowed.
				if( filesize( $file['tmp_name'] ) > $uploadLimit )
				{
					$mainframe->enqueueMessage( JText::_('CC IMAGE FILE SIZE EXCEEDED') , 'error' );
					$mainframe->redirect( CRoute::_('index.php?option=com_community&view=profile&userid=' . $my->id . '&task=uploadAvatar', false) );
				}

                                if( !cValidImageType( $file['type'] ) )
                                {
					$mainframe->enqueueMessage( JText::_('CC IMAGE FILE NOT SUPPORTED') , 'error' );
					$mainframe->redirect( CRoute::_('index.php?option=com_community&view=profile&userid=' . $my->id . '&task=uploadAvatar', false) );
                                }
				
				if( !cValidImage($file['tmp_name'] ) )
				{
					$mainframe->enqueueMessage(JText::_('CC IMAGE FILE NOT SUPPORTED'), 'error');
				}
				else
				{
					$imageSize		= cImageGetSize( $file['tmp_name'] );

					// @todo: configurable width?
					$imageMaxWidth	= 160;
					
					if( $imageSize->width > $imageMaxWidth )
					{
						$mainframe->enqueueMessage( JText::sprintf('CC IMAGE WIDTH LARGER' , $imageSize->width , $imageMaxWidth ) );
					}
						
					// Get a hash for the file name.
					$fileName		= JUtility::getHash( $file['tmp_name'] . time() );
					$hashFileName	= JString::substr( $fileName , 0 , 24 );

					//@todo: configurable path for avatar storage?
					$storage			= JPATH_ROOT . DS . 'images' . DS . 'avatar';
					$storageImage		= $storage . DS . $hashFileName . cImageTypeToExt( $file['type'] );
					$storageThumbnail	= $storage . DS . 'thumb_' . $hashFileName . cImageTypeToExt( $file['type'] );
					$image				= 'images/avatar/' . $hashFileName . cImageTypeToExt( $file['type'] );
					$thumbnail			= 'images/avatar/' . 'thumb_' . $hashFileName . cImageTypeToExt( $file['type'] );
					
					$userModel			=& CFactory::getModel( 'user' );


					// Only resize when the width exceeds the max.
					if( !cImageResizePropotional( $file['tmp_name'] , $storageImage , $file['type'] , $imageMaxWidth ) )
					{
						$mainframe->enqueueMessage(JText::sprintf('CC ERROR MOVING UPLOADED FILE' , $storageImage), 'error');
					}

					// Generate thumbnail
					if(!cImageCreateThumb( $file['tmp_name'] , $storageThumbnail , $file['type'] ))
					{
						$mainframe->enqueueMessage(JText::sprintf('CC ERROR MOVING UPLOADED FILE' , $storageThumbnail), 'error');
					}			


							
					$userModel->setImage( $my->id , $image , 'avatar' );
					$userModel->setImage( $my->id , $thumbnail , 'thumb' );
					
					// Update the user object so that the profile picture gets updated.
					$my->set( '_avatar' , $image );
					$my->set( '_thumb'	, $thumbnail );
					
					//add user points
					CFactory::load( 'libraries' , 'userpoints' );
					CFactory::load( 'libraries' , 'activities');
							
					$act = new stdClass();
					$act->cmd 		= 'profile.avatar.upload';
					$act->actor   	= $my->id;
					$act->target  	= 0;
					$act->title	  	= JText::_('CC ACTIVITIES NEW AVATAR');
					$act->content	= '';
					$act->app		= 'profile';
					$act->cid		= 0;
							
					// Add activity logging
					CFactory::load ( 'libraries', 'activities' );
					CActivityStream::add( $act );
					
					CUserPoints::assignPoint('profile.avatar.upload');
				}
			}
		}
				
		echo $view->get( __FUNCTION__ );
	}
	
	/**
	 * Full application view
	 */	 	
	function app()
	{
		require_once (JPATH_COMPONENT.DS.'libraries'.DS.'apps.php');

		$view = & $this->getView('profile');
		echo $view->get( 'appFullView' );
	}
	
	/**
	 * Show pop up error message screen
	 * for invalid image file upload	 
	 */	 
	function ajaxErrorFileUpload()
	{
		$objResponse	= new JAXResponse();
				
		$html			= '<div style="overflow:auto; height:200px; position: absolute-nothing;">' . JText::_('CC PHOTO UPLOAD DESC') . '</div>';
		$action			= '<button class="button" onclick="javascript:cWindowHide();" name="close">' . JText::_('CC BUTTON CLOSE') . '</button>';

		$objResponse->addAssign('cWindowContent', 'innerHTML', $html);
		$objResponse->addScriptCall('cWindowActions', $action);

		return $objResponse->sendResponse();
	}
	
	/*
	 * Allow users to delete their own profile
	 * 
	 */
	function deleteProfile()
	{
		$view	=& $this->getView('profile');
		$method	= JRequest::getMethod();
		
		$my			= CFactory::getUser();
		
		if($my->id == 0)
		{
		   return $this->blockUnregister();
		}				
		
		if($method == 'POST')
		{
			// Instead of delete the user straight away, 
			// we'll block the user and notify the admin. 
			// Admin then would delete the user from backend
			JRequest::checkToken() or jexit( 'CC INVALID TOKEN' );			
			$my->set('block', 1);
			$my->save();
			
			// send notification email
			$model		=& CFactory::getModel( 'profile' );
			$emails		= $model->getAdminEmails();
			$url		= rtrim( JURI::root() , '/' ) . '/administrator/index.php?option=com_community&view=users&layout=edit&id=' . $my->id;
			$subject	= JText::sprintf('CC ACCOUNT DELETE SUBJECT', $my->getDisplayName() );
			$body		= JText::sprintf( 'CC ACCOUNT DELETE CONTENT' , $my->getDisplayName() , $my->id , $url );

			$this->_notify('user.profile.delete', $my->id , $emails , $subject , $body );
			
			// logout and redirect the user
			$mainframe	=& JFactory::getApplication();
			$mainframe->logout($my->id);
			$mainframe->redirect(CRoute::_('index.php?option=com_community', false));
		}
		echo $view->get(__FUNCTION__);
	}
}
