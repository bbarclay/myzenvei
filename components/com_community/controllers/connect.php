<?php
/**
 * @package	JomSocial
 * @copyright (C) 2008 by Slashes & Dots Sdn Bhd - All rights reserved!
 * @license http://www.jomsocial.com Copyrighted Commercial Software
 */
// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die();

class CommunityConnectController extends CommunityBaseController
{
	function test()
	{
		CFactory::load( 'libraries' , 'facebook' );
		$facebook	= new CFacebook();
		
		$facebook->hasPermission('read_stream');

		//$facebook->setStatus( 'hello world again from Jomsocial API' );
	}

	/**
	 *	Validates an existing user account.
	 *	If their user / password combination is valid, import facebook data / profile into their account
	 **/	 	 	
	function ajaxValidateLogin( $username , $password )
	{
		CFactory::load( 'libraries' , 'facebook' );

		$response	= new JAXResponse();
		$facebook	= new CFacebook();
		$mainframe	=& JFactory::getApplication();
		$connectId	= $facebook->getUserId();
		$fields		= array( 'first_name' , 'last_name' , 'birthday' , 'current_location' , 'status' , 'pic' , 'sex' , 'name' , 'pic_square' , 'profile_url' , 'pic_big' , 'current_location');
		$user		= $facebook->getUserInfo( $fields );
		$login		= $mainframe->login( array( 'username' => $username , 'password' => $password ) );
		
		if( $login === true)
		{
			$my				= CFactory::getUser();
			$connectModel	=& CFactory::getModel( 'Connect' );
			$connectTable	=& JTable::getInstance( 'Connect' , 'CTable' );
			$connectTable->load( $connectId );
			CFactory::load( 'helpers' , 'owner' );
			
			// Only allow linking for normal users.
			if(!isCommunityAdmin())
			{
				if(!$connectTable->userid )
				{
					$connectTable->userid	= $my->id;
					$connectTable->type		= 'facebook';
					$connectTable->store();
					$response->addScriptCall( 'joms.connect.update();');
					return $response->sendResponse();
				}
			}
			else
			{
				$mainframe->logout();
				
				$tmpl		= new CTemplate();
				$content	= $tmpl->fetch( 'facebook.link.notallowed' );
				$buttons	= '<input type="button" value="' . JText::_('CC BACK') . '" class="button" onclick="joms.connect.update();" />';
				$response->addScriptCall('jQuery("#cwin_logo").html("' . JText::_('CC ACCOUNT MERGE TITLE') . '");');
				$response->addScriptCall('cWindowActions', $buttons);
				$response->addAssign('cWindowContent' , 'innerHTML' , $content);
				return $response->sendResponse();
			}
		}
		
		$tmpl		= new CTemplate();
		$tmpl->set( 'login'	, $login );
		$content	= $tmpl->fetch( 'facebook.link.failed' );
		$buttons	= '<input type="button" value="' . JText::_('CC BACK') . '" class="button" onclick="jax.call(\'community\',\'connect,ajaxShowExistingUserForm\');" />';
		$response->addScriptCall('cWindowResize' , 150 );
		$response->addScriptCall('jQuery("#cwin_logo").html("' . JText::_('CC ACCOUNT MERGE TITLE') . '");');
		$response->addScriptCall('cWindowActions', $buttons);
		$response->addAssign('cWindowContent' , 'innerHTML' , $content);
		
		return $response->sendResponse();
	}

	function update()
	{
		$view	= & $this->getView ( 'connect' );
		echo $view->get( __FUNCTION__ );
	}
	
	function ajaxCreateNewAccount( $name , $username , $email )
	{
		CFactory::load( 'libraries' , 'facebook' );
		jimport('joomla.user.helper');
		
		// Once they reach here, we assume that they are already logged into facebook.
		// Since CFacebook library handles the security we don't need to worry about any intercepts here.
		$facebook		= new CFacebook();
		$connectModel	=& CFactory::getModel( 'Connect' );
		$connectTable	=& JTable::getInstance( 'Connect' , 'CTable' );
		$mainframe		=& JFactory::getApplication();		
		$connectId		= $facebook->getUserId();
		$response		= new JAXResponse();
		$connectTable->load( $connectId );
		$fields			= array( 'first_name' , 'last_name' , 'birthday' , 'current_location' , 'status' , 'pic' , 'sex' , 'name' , 'pic_square' , 'profile_url' , 'pic_big' , 'current_location');
		$user			= $facebook->getUserInfo( $fields );
		$config			=& CFactory::getConfig();

		// @rule: Ensure user doesn't really exists
		if(!$connectTable->userid)
		{
			//@rule: Test if username already exists
			$username			= $this->_checkUserName( $username );
			$usersConfig		=& JComponentHelper::getParams( 'com_users' );
			$authorize			=& JFactory::getACL();
	
			// Grab the new user type so we can get the correct gid for the ACL
			$newUsertype		= $usersConfig->get( 'new_usertype' );
	
			if(!$newUsertype)
				$newUsertype = 'Registered';
	
			// Generate a joomla password format for the user.
			$password					= JUserHelper::genRandomPassword();
	
			$userData					= array();			
			$userData['name']			= $name;
			$userData['username']		= $username;
			$userData['email']			= $email;
			$userData['password']		= $password;
			$userData['password2']		= $password;
	
			// Update user's login to the current user
			$my		= clone( JFactory::getUser() );
			$my->bind( $userData );
			$my->set('id', 0);
			$my->set('usertype', '');
			$my->set('gid', $authorize->get_group_id( '', $newUsertype, 'ARO' ));
			$date =& JFactory::getDate();
			$my->set('registerDate', $date->toMySQL());

			ob_start();
			if( !$my->save() )
			{
			?>
				<div style="margin-bottom: 5px;"><?php echo JText::_('CC ERROR VALIDATING FACEBOOK ACCOUNT');?></div>
				<div><strong><?php echo JText::sprintf('Error: %1$s' , $my->getError() );?></strong></div>
				<div class="clear"></div>
			<?php
				$buttons	= '<input type="button" onclick="joms.connect.update();" value="' . JText::_('CC BACK') . '" class="button" />'; 
				$content	= ob_get_contents();
				@ob_end_clean();
	
				$response->addAssign('cWindowContent' , 'innerHTML' , $content);
				$response->addScriptCall('jQuery("#cwin_logo").html("' . $config->get('sitename') . '");');
				$response->addScriptCall('cWindowActions', $buttons);
				return $response->sendResponse();
			}

			$my	= CFactory::getUser( $my->id );

			// Store user mapping so the next time it will be able to detect this facebook user.
			$connectTable->connectid	= $connectId;
			$connectTable->userid		= $my->id;
			$connectTable->type			= 'facebook';
			$connectTable->store();
			
			$response->addScriptCall('joms.connect.update();');
			return $response->sendResponse();
		}
	}
	
	function ajaxShowNewUserForm()
	{
		$response	= new JAXResponse();

		CFactory::load( 'libraries' , 'facebook' );
		jimport('joomla.user.helper');

		// Once they reach here, we assume that they are already logged into facebook.
		// Since CFacebook library handles the security we don't need to worry about any intercepts here.
		$facebook		= new CFacebook();
		$connectModel	=& CFactory::getModel( 'Connect' );
		$connectTable	=& JTable::getInstance( 'Connect' , 'CTable' );
		$mainframe		=& JFactory::getApplication();
		$config			=& CFactory::getConfig();
		$fields			= array( 'first_name' , 'last_name' , 'birthday' , 'current_location' , 'status' , 'pic' , 'sex' , 'name' , 'pic_square' , 'profile_url' , 'pic_big' , 'current_location');
		$user			= $facebook->getUserInfo( $fields );
		$connectId		= $facebook->getUserId();
		$connectTable->load( $connectId );
		
		$tmpl	= new CTemplate();
		$tmpl->set( 'user' , $user );
		$html	= $tmpl->fetch('facebook.newuserform');

        $buttons	= '<input type="button" value="' . JText::_('CC BACK') . '" class="button" onclick="joms.connect.update();return false;" />';
		$buttons	.= '<input type="button" value="' . JText::_('CC CREATE') . '" class="button" onclick="joms.connect.validateNewAccount();return false;" />';
		$response->addScriptCall('cWindowResize' , 250 );
		$response->addAssign('cWindowContent' , 'innerHTML' , $html);
		$response->addScriptCall('jQuery("#cwin_logo").html("' . JText::_('CC ACCOUNT SIGNUP FROM FACEBOOK') . '");');
		$response->addScriptCall('cWindowActions', $buttons);
		$response->sendResponse();
	}

	function ajaxShowExistingUserForm()
	{
		$response	= new JAXResponse();

		CFactory::load( 'libraries' , 'facebook' );
		jimport('joomla.user.helper');

		// Once they reach here, we assume that they are already logged into facebook.
		// Since CFacebook library handles the security we don't need to worry about any intercepts here.
		$facebook		= new CFacebook();
		$connectModel	=& CFactory::getModel( 'Connect' );
		$connectTable	=& JTable::getInstance( 'Connect' , 'CTable' );
		$mainframe		=& JFactory::getApplication();
		$config			=& CFactory::getConfig();

		$connectId		= $facebook->getUserId();
		$connectTable->load( $connectId );

		$tmpl       = new CTemplate();
		$html		=$tmpl->fetch('facebook.existinguserform');

        $buttons	= '<input type="button" value="' . JText::_('CC BACK') . '" class="button" onclick="joms.connect.update();return false;" />';
		$buttons	.= '<input type="button" value="' . JText::_('CC LOGIN') . '" class="button" onclick="joms.connect.validateUser();return false;" />';
		$response->addScriptCall('cWindowResize' , 250 );
		$response->addAssign('cWindowContent' , 'innerHTML' , $html);
		$response->addScriptCall('jQuery("#cwin_logo").html("' . JText::_('CC ACCOUNT SIGNUP FROM FACEBOOK') . '");');
		$response->addScriptCall('cWindowActions', $buttons);
		$response->sendResponse();
	}
	
	function ajaxUpdate()
	{
		$response	= new JAXResponse();
		
		CFactory::load( 'libraries' , 'facebook' );
		jimport('joomla.user.helper');
		
		// Once they reach here, we assume that they are already logged into facebook.
		// Since CFacebook library handles the security we don't need to worry about any intercepts here.
		$facebook		= new CFacebook();
		$connectModel	=& CFactory::getModel( 'Connect' );
		$connectTable	=& JTable::getInstance( 'Connect' , 'CTable' );
		$mainframe		=& JFactory::getApplication();
		$config			=& CFactory::getConfig();
		
		$connectId		= $facebook->getUserId();
		$connectTable->load( $connectId );

		$fields			= array( 'first_name' , 'last_name' , 'birthday' , 'current_location' , 'status' , 'pic' , 'sex' , 'name' , 'pic_square' , 'profile_url' , 'pic_big' , 'current_location');
		$user			= $facebook->getUserInfo( $fields );
		
		//@todo: configurable redirect for continue button
		$redirect		= CRoute::_('index.php?option=com_community&view=profile');
		$error			= false;
		$content		= '';
		
		if(!$connectTable->userid )
		{
			$tmpl		= new CTemplate();
			$tmpl->set( 'user' , $user );
			$content	= $tmpl->fetch( 'facebook.firstlogin' );

			$buttons	= '<input type="button" value="' . JText::_('CC NEXT') . '" class="button" onclick="joms.connect.selectType();" />';
			$response->addScriptCall('cWindowResize' , 320 );
			$response->addAssign('cWindowContent' , 'innerHTML' , $content);
			$response->addScriptCall('jQuery("#cwin_logo").html("' . JText::_('CC ACCOUNT SIGNUP FROM FACEBOOK') . '");');
			$response->addScriptCall('cWindowActions', $buttons);
			$response->sendResponse();
		}
		else
		{
			$my	= CFactory::getUser( $connectTable->userid );

			CFactory::load( 'helpers' , 'owner' );

			if( isCommunityAdmin( $connectTable->userid ) )
			{
				$tmpl		= new CTemplate();
				$content	= $tmpl->fetch( 'facebook.link.notallowed' );
				$buttons	= '<input type="button" value="' . JText::_('CC BUTTON CLOSE') . '" class="button" onclick="cWindowHide();" />';
				$response->addScriptCall('cWindowActions', $buttons);
				$response->addAssign('cWindowContent' , 'innerHTML' , $content);
				$response->addScriptCall('cWindowResize' , 150 );
				return $response->sendResponse();
			}

			// Generate a joomla password format for the user so we can log them in.
			$password					= JUserHelper::genRandomPassword();
			
			$userData					= array();
			$userData['password']		= $password;
			$userData['password2']		= $password;
			$my->bind( $userData );

			// User object must be saved again so the password change get's reflected.
			$my->save();
			
			$mainframe->login( array( 'username' => $my->username , 'password' => $password ) );

			// Map user's profile on each login if administrator configured it to.
// 			if( $config->get('fbloginimportprofile') )
// 			{
// 				$facebook->mapProfile( $user , $my->id );
// 			}
			
			$tmpl		= new CTemplate();
			$tmpl->set( 'my'	, $my );
			$tmpl->set( 'user'	, $user );

			$content	= $tmpl->fetch( 'facebook.existinguser' );
			$buttons	= '<input type="button" class="button" onclick="joms.connect.importData();" value="' . JText::_('CC CONTINUE BUTTON') . '"/>';

			// Add invite button
			$response->addScriptCall('cWindowResize' , 190 );
			$response->addAssign('cWindowContent' , 'innerHTML' , $content);
			$response->addScriptCall('jQuery("#cwin_logo").html("' . $config->get('sitename') . '");');
			$response->addScriptCall('cWindowActions', $buttons);
			$response->sendResponse();
		}
	}
	
	function ajaxImportData( $importStatus , $importAvatar )
	{
	    $response   	= new JAXResponse();
	    $importStatus	= (boolean) $importStatus;
	    $importAvatar	= (boolean) $importAvatar;

		CFactory::load( 'libraries' , 'facebook' );
		jimport('joomla.user.helper');

		// Once they reach here, we assume that they are already logged into facebook.
		// Since CFacebook library handles the security we don't need to worry about any intercepts here.
		$facebook		= new CFacebook();
		$connectModel	=& CFactory::getModel( 'Connect' );
		$connectTable	=& JTable::getInstance( 'Connect' , 'CTable' );
		$mainframe		=& JFactory::getApplication();
		$config			=& CFactory::getConfig();

		$connectId		= $facebook->getUserId();
		$connectTable->load( $connectId );

		$fields			= array( 'first_name' , 'last_name' , 'birthday' , 'current_location' , 'status' , 'pic' , 'sex' , 'name' , 'pic_square' , 'profile_url' , 'pic_big' , 'current_location');
		$user			= $facebook->getUserInfo( $fields );

		//@todo: configurable redirect for continue button
		$my             = CFactory::getUser();
		$redirect		= CRoute::_('index.php?option=com_community&view=profile&userid=' . $my->id );

		if( isCommunityAdmin( $connectTable->userid ) )
		{
			$tmpl		= new CTemplate();
			$content	= $tmpl->fetch( 'facebook.link.notallowed' );
			$buttons	= '<input type="button" value="' . JText::_('CC BUTTON CLOSE') . '" class="button" onclick="cWindowHide();" />';
			$response->addScriptCall('cWindowActions', $buttons);
			$response->addAssign('cWindowContent' , 'innerHTML' , $content);
			$response->addScriptCall('cWindowResize' , 150 );
			return $response->sendResponse();
		}

		if( $importAvatar )
		{
			$facebook->mapAvatar( $user['pic_big'] , $my->id , $config->get('fbwatermark') );
		}

		if( $importStatus && isset( $user['status']['message'] ) && !empty( $user['status']['message'] ) && $my->getStatus() != $user['status']['message'] )
		{
			$facebook->mapStatus( $user['status']['message'] , $my->id );
		}
		
		// Test if user email is updated before by checking if @localdomain.com exists
		if( !JString::stristr( $my->email , '@foo.bar' ) )
		{
		    $response->addScriptCall( 'cWindowHide();' );
			$response->addScriptCall('window.location.href = "' . $redirect . '";' );
			return $response->sendResponse();
		}

		// If it passes the above, the user definitely needs to edit the e-mail.
		$tmpl   	= new CTemplate();
		$tmpl->set( 'my'	, $my );
		$content    = $tmpl->fetch( 'facebook.emailupdate' );

		$buttons	= '<form method="post" action="' . $redirect . '" style="float:right;">';
		$buttons	.= '<input type="submit" value="' . JText::_('CC SKIP BUTTON') . '" class="button" name="Submit"/>';
		$buttons	.= '</form>';
		$buttons	.= '<input type="button" value="' . JText::_('CC UPDATE EMAIL BUTTON') . '" class="button" onclick="joms.connect.updateEmail();" />';


		// Add invite button
		$response->addScriptCall('cWindowResize' , 150 );
		$response->addAssign('cWindowContent' , 'innerHTML' , $content );
		$response->addScriptCall('jQuery("#cwin_logo").html("' . $config->get('sitename') . '");');
		$response->addScriptCall('cWindowActions', $buttons);
		$response->sendResponse();
	}

	/**
	 * Displays the XDReceiver data for Facebook to connect
	 **/	 
	function receiver()
	{
		$view	= & $this->getView ( 'connect' );
		echo $view->get( 'receiver' );
		
		// Exit here so joomla will not process anything.
		exit;
	}

	function invite()
	{
		$view	= & $this->getView ( 'connect' );
		$my		= CFactory::getUser();
		
		// Although user is signed on in Facebook, we should never allow them to view this page if
		// they are not logged into the site.
		if( $my->id == 0 )
		{
			return $this->blockUnregister();
		}
		echo $view->get( __FUNCTION__ );
	}
	
	function logout()
	{
		$my			=& JFactory::getUser();
		$mainframe	=& JFactory::getApplication();
		
		// Double check that user is really logged in
		if( $my->id != 0 )
		{
			$mainframe->logout();
	
			// Return to JomSocial front page.
			// @todo: configurable?
			$url		= CRoute::_('index.php?option=com_community&view=frontpage' , false );
			
			$mainframe->redirect( $url , JText::_('CC SUCCESSFULL LOGOUT') );
		}
	}

	/**
	 *	Method to test if username already exists
	 **/	 
	function _checkUserName( $username )
	{
		$model		=& CFactory::getModel( 'register' );
		
		$originalUsername	= $username;
		$exists				= $model->isUserNameExists( array( 'username' => $username ) );
		
		if( $exists )
		{
			//@rule: If user exists, generate random username for the user by appending some integer
			$i	= 1;
			while( $exists )
			{
				$username	= $originalUsername . $i;
				$exists		= $model->isUserNameExists( array( 'username' => $username ) );
				$i++;
			}
		}
		return $username;
	}

	/**
	 *	Checks the validity of the email via AJAX calls
	 **/	 	
	function ajaxCheckEmail( $email )
	{
		$response	= new JAXResponse();
	    $model 		=& $this->getModel( 'user' );
	    
	    // @rule: Check email format
	    CFactory::load( 'helpers' , 'emails' );
	    
	    $valid		= isValidInetAddress( $email );

		if( (!$valid && !empty($email ) ) || empty($email) )
		{
			$response->addScriptCall('jQuery("#newemail").addClass("invalid");');
			$response->addScriptCall('jQuery("#error-newemail").show();');
			$response->addScriptCall('jQuery("#error-newemail").html("' . JText::sprintf('CC INVALID FB EMAIL', htmlspecialchars($email) ) . '");');
			return $response->sendResponse();
		}
	    
	    $exists		= $model->userExistsbyEmail( $email );

		if( $exists )
		{
			$response->addScriptCall('jQuery("#newemail").addClass("invalid");');
			$response->addScriptCall('jQuery("#error-newemail").show();');
			$response->addScriptCall('jQuery("#error-newemail").html("' . JText::sprintf('CC INVITE EMAIL EXIST', htmlspecialchars($email)) . '");');
			return $response->sendResponse();
		}

		$response->addScriptCall('jQuery("#newemail").removeClass("invalid");');
		$response->addScriptCall('jQuery("#error-newemail").html("&nbsp");');
		$response->addScriptCall('jQuery("#error-newemail").hide();');
		return $response->sendResponse();
	}

	/**
	 *	Checks the validity of the username via AJAX calls
	 *	
	 *	@params	$username	String	The username that is passed.	 	 
	 **/
	function ajaxCheckUsername( $username )
	{
		$response	= new JAXResponse();

		CFactory::load( 'helpers' , 'user' );
		$valid		= cValidUsername( $username );

		if( (!$valid && !empty($username )) || empty($username) )
		{
			$response->addScriptCall('jQuery("#newusername").addClass("invalid");');
			$response->addScriptCall('jQuery("#error-newusername").show();');
			$response->addScriptCall('jQuery("#error-newusername").html("' . JText::sprintf('CC INVALID USERNAME', htmlspecialchars( $username ) ) . '");');
			return $response->sendResponse();
		}
		
		$model		=& CFactory::getModel( 'register' );
		$exists		= $model->isUserNameExists( array( 'username' => $username ) );

		if( $exists )
		{
			$response->addScriptCall('jQuery("#newusername").addClass("invalid");');
			$response->addScriptCall('jQuery("#error-newusername").show();');
			$response->addScriptCall('jQuery("#error-newusername").html("' . JText::sprintf('CC USERNAME EXISTS', htmlspecialchars($username)) . '");');
			return $response->sendResponse();
		}
		$response->addScriptCall('jQuery("#newusername").removeClass("invalid");');
		$response->addScriptCall('jQuery("#error-newusername").html("&nbsp");');
		$response->addScriptCall('jQuery("#error-newusername").hide();');

        return $response->sendResponse();
	}

	/**
	 *	Checks the validity of the name via AJAX calls
	 *	
	 *	@params	$name	String	The name that is passed.
	 **/
	function ajaxCheckName( $name )
	{
		$response	= new JAXResponse();

		if( empty($name) )
		{
			$response->addScriptCall('jQuery("#newname").addClass("invalid");');
			$response->addScriptCall('jQuery("#error-newname").show();');
			$response->addScriptCall('jQuery("#error-newname").html("' . JText::_('CC PLEASE ENTER NAME' ) . '");');
			return $response->sendResponse();
		}
		
		$response->addScriptCall('jQuery("#newname").removeClass("invalid");');
		$response->addScriptCall('jQuery("#error-newname").html("&nbsp");');
		$response->addScriptCall('jQuery("#error-newname").hide();');

        return $response->sendResponse();
	}
}
