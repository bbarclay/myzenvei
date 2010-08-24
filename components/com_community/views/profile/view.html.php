<?php
/**
 * @package	JomSocial
 * @copyright (C) 2008 by Slashes & Dots Sdn Bhd - All rights reserved!
 * @license http://www.jomsocial.com Copyrighted Commercial Software
 */
defined('_JEXEC') or die('Restricted access');
jimport ( 'joomla.application.component.view' );

class CommunityViewProfile extends CommunityView {

	function _addSubmenu()
	{
		$this->addSubmenuItem ( 'index.php?option=com_community&view=profile&task=uploadAvatar', JText::_('CC EDIT AVATAR') );
		$this->addSubmenuItem ( 'index.php?option=com_community&view=profile&task=edit', JText::_('CC EDIT PROFILE') );
		$this->addSubmenuItem ( 'index.php?option=com_community&view=profile&task=editDetails', JText::_('CC EDIT DETAILS') );
		$this->addSubmenuItem ( 'index.php?option=com_community&view=profile&task=privacy', JText::_('CC EDIT PRIVACY') );
		$this->addSubmenuItem ( 'index.php?option=com_community&view=profile&task=preferences', JText::_('CC EDIT PREFERENCES') );
		$this->addSubmenuItem ( 'index.php?option=com_community&view=profile&task=deleteProfile', JText::_('CC DELETE PROFILE'), '', SUBMENU_RIGHT );
	}

	/**
	 * Return friends html block
	 */
	function _getFriendsHTML()
	{
		$tmpl = new CTemplate ( );
		
		$friendsModel =& CFactory::getModel('friends');
		
		$my		 = CFactory::getUser();
		$user 	 = CFactory::getRequestUser();
		
		$params  = $user->getParams();
		
		// site visitor
		$relation = 10;
		
		// site members
		if( $my->id != 0 )
			$relation = 20;
		
		// friends
		if( friendIsConnected($my->id, $user->id) )
			 $relation = 30;
		
		// mine
		if( isMine($my->id, $user->id) )
			 $relation = 40;
			 
		// @todo: respect privacy settings
		if( $relation >= $params->get('privacyFriendsView'))
		{
			$friends =& $friendsModel->getFriends($user->id, 'latest', false, '', PROFILE_MAX_FRIEND_LIMIT + PROFILE_MAX_FRIEND_LIMIT);
			
			// randomize the friend count
			if( $friends )
				shuffle($friends);
			
			$tmpl->setRef('friends', $friends);
			$tmpl->set('total', $user->getFriendCount() );
			$tmpl->setRef('user' , $user );
			return $tmpl->fetch( 'profile.friends' );
		}
	}

	/**
	 * Return groups html block
	 */
	function _getGroupsHTML()
	{
		$tmpl	= new CTemplate();

		$model	=& CFactory::getModel( 'groups' );
		$my		= CFactory::getUser();
		$userid	=  JRequest::getVar('userid', $my->id);
		$user	= CFactory::getUser($userid);

		$groups	= $model->getGroups( $user->id );
		$total	= count( $groups );
		
		// Randomize groups
		if( $groups )
			shuffle( $groups );
		
		CFactory::load( 'helpers' , 'url' );
		
		for( $i = 0; $i < count($groups); $i++ )
		{
			$row			=& $groups[$i];
			$row->avatar	= $model->getThumbAvatar( $row->id , $row->thumb );
			
			$row->link		= CUrl::build( 'groups' , 'viewgroup' , array('groupid' => $row->id) , true );
		}
		$tmpl->set( 'user'		, $user );
		$tmpl->set( 'total'		, $total );
		$tmpl->set( 'groups'	, $groups );
		return $tmpl->fetch( 'profile.groups' );
	}
	
	/**
	 * Return the 'about us' html block
	 */
	function _getProfileHTML( &$profile )
	{
		$tmpl	= new CTemplate();

		$profileModel	=& CFactory::getModel( 'profile' );
		$my				= CFactory::getUser();
		$config			=& CFactory::getConfig();
		
		$userid	=  JRequest::getVar('userid', $my->id);
		$user	= CFactory::getUser($userid);
		
		//$profile		= $profileModel->getViewableProfile( $user->id );

		$profileField	=& $profile['fields'];
				
		CFactory::load( 'helpers' , 'linkgenerator' );
		CFactory::load( 'helpers' , 'phone' );
		
		// Allow search only on profile with type text and not empty
		foreach($profileField as $key => $val)
		{

			foreach($profileField[$key] as $pKey => $pVal)
			{
				$field	=& $profileField[$key][$pKey];								

				// Remove this info if we don't want empty field displayed
				if( !$config->get('showemptyfield') && ( empty($field['value']) && $field['value']!="0") )
				{
					unset( $profileField[$key][$pKey] );
					
				}
				else
				{
					if(!empty($field['value']) || $field['value']=="0" )
					{
						switch($field['type'])
						{
							case 'text':
								if(cValidateEmails($field['value']))
								{
									$profileField[$key][$pKey]['value'] = cGenerateEmailLink($field['value']);
								}
								else if (cValidateURL($field['value']))
								{
									$profileField[$key][$pKey]['value'] = cGenerateHyperLink($field['value']);
								}
								else if(!cValidatePhone($field['value']) && !empty($field['fieldcode']))
								{
									$profileField[$key][$pKey]['searchLink'] = CRoute::_('index.php?option=com_community&view=search&task=field&'.$field['fieldcode'].'='. urlencode( $field['value'] ) );					
								}
								break;
							case 'select':
							case 'singleselect':
							case 'radio':
							case 'country':
								$profileField[$key][$pKey]['searchLink'] = CRoute::_('index.php?option=com_community&view=search&task=field&'.$field['fieldcode'].'='. urlencode( $field['value'] ) );
								break;
							default:
								break;
						}
					}
				}
			}
		}
		
		CFactory::load( 'libraries' , 'profile' );
		
		$tmpl->set( 'profile' , $profile );
		$tmpl->set( 'isMine' , isMine($my->id, $user->id));
		return $tmpl->fetch( 'profile.about' );
	}

	/**
	 * Return newsfeed html block
	 */
	function _getNewsfeedHTML()
	{
		jimport('joomla.utilities.date');
		$mainframe =& JFactory::getApplication();
		
		$config			=& CFactory::getConfig();
		$my				= CFactory::getUser();
		
		//$user 			=& CFactory::getActiveProfile();
		$userid	=  JRequest::getVar('userid', $my->id);
		$user	= CFactory::getUser($userid);
		
		$params			=& $user->getParams();
		$activities 	=& CFactory::getModel('activities');
		$appModel		=& CFactory::getModel('apps');
		$friendsModel	=& CFactory::getModel('friends');
		$html			= '';
		$activityLimit	= (! empty($params)) ? $params->get( 'activityLimit' , '' ) : ''; 
		if(empty($activityLimit))
		{
			$activityLimit	= $config->get('maxactivities');
		}

		$memberSince = cGetDate($user->registerDate);
		$friendIds	= $friendsModel->getFriendIds($user->id);

		include_once(JPATH_COMPONENT . DS.'libraries'.DS.'activities.php');
		$act = new CActivityStream();
		
		
		return $act->getHTML($user->id, $friendIds, $memberSince, $activityLimit, '', '' );
	}
	
	
	function _getLoginDiff( $diff ) {
	}


	function showSubmenu() {
		$this->_addSubmenu ();
		parent::showSubmenu ();
	}

	/**
	 * Show the main profile header
	 */
	function _showHeader(& $data)
	{
		jimport ( 'joomla.utilities.arrayhelper' );

		$my 	= & JFactory::getUser ();
		$userid	=  JRequest::getVar('userid', $my->id);
		$user	= CFactory::getUser($userid);
		//$user	= & CFactory::getActiveProfile ();
		$userModel = & CFactory::getModel ( 'user' );
		
		CFactory::load ( 'libraries', 'messaging' );
		CFactory::load( 'helpers' , 'owner' );
		
		// Get the admin controls HTML data
		$tmpl				= new CTemplate();
		$adminControlHTML	= '';
		
		if( isCommunityAdmin() )
		{
			$tmpl->set('userid'		, $user->id );
			
			$isDefaultPhoto	= ( $user->getThumbAvatar() == rtrim( JURI::root() , '/' ) . '/components/com_community/assets/default_thumb.jpg' ) ? true : false;
			
			CFactory::load( 'libraries' , 'featured' );
			$featured	= new CFeatured( FEATURED_USERS );
			$isFeatured	= $featured->isFeatured( $user->id );
			
			$tmpl->set('isCommunityAdmin' , isCommunityAdmin( $user->id ) );
			$tmpl->set('blocked'	, $user->isBlocked() );
			$tmpl->set( 'isFeatured'		, $isFeatured );
			$tmpl->set( 'isDefaultPhoto'	, $isDefaultPhoto );
			$adminControlHTML	= $tmpl->fetch( 'admin.controls' );
		}
		unset( $tmpl );
		
		$tmpl = new CTemplate ();

		if (isMine($my->id, $user->id)) {
			$editStatus = '<input id="new-status" style="border:1px solid #cccccc;" type="text" value="" size="38" onkeyup="if(event.keyCode == 13) {cStatusAct()}"/>';
			$editLink = '<span id="profile-status-edit" onclick="cStatusAct()">[' . JText::_('CC EDIT') . ']</span>';
		} else {
			$editStatus = '';
			$editLink = '';
		}
		// get how many unread message
		$inboxModel = & CFactory::getModel ( 'inbox' );
		$filter['user_id'] 	= $my->id;
		$unread = $inboxModel->countUnRead( $filter );

		// get how many pending connection
		$friendModel = & CFactory::getModel ( 'friends' );
		$pending = $friendModel->countPending( $my->id );
		
		$tmpl->set ( 'karmaImgUrl', CUserPoints::getPointsImage($user));
		$tmpl->set ( 'editStatus', $editStatus );
		$tmpl->set ( 'editLink', $editLink );

		$tmpl->set ( 'isMine', isMine($my->id, $user->id));
		
		$profile = JArrayHelper::toObject ( $data->profile );
		$profile->largeAvatar = $user->getAvatar();
		$profile->status = $user->getStatus ( $data->profile ['id'] );

		$addbuddy = "joms.friends.connect('{$profile->id}')";
		$sendMsg = CMessaging::getPopup ( $profile->id );

		$config	=& CFactory::getConfig();
		
		if( $user->lastvisitDate == '0000-00-00 00:00:00' )
		{
			$lastLogin	= JText::_('CC NEVER LOGGED IN');
		}
		else
		{
			//$now =& JFactory::getDate();
			$userLastLogin	= new JDate( $user->lastvisitDate );
			CFactory::load( 'libraries' , 'activities');
			$lastLogin		= CActivityStream::_createdLapse( $userLastLogin );
		}

        // @todo : beside checking the owner, maybe we want to check for a cookie,
		// say every few hours only the hit get increment by 1.
        if (! isMine($my->id, $user->id)) {
		    $user->viewHit();
		}

		$tmpl->set ( 'lastLogin'		, $lastLogin );
		$tmpl->setRef ( 'user'				, $user );
		$tmpl->set ( 'addBuddy'			, $addbuddy );
		$tmpl->set ( 'sendMsg'			, $sendMsg );
		$tmpl->set ( 'config'			, $config );
				
		// @rule: myblog integrations
		$showBlogLink	= false;
		
		CFactory::load( 'libraries' , 'myblog' );
		$myblog			=& CMyBlog::getInstance();
		if( $config->get('enablemyblogicon') && $myblog )
		{
			if( $myblog->userCanPost( $user->id ) )
			{
				$showBlogLink	= true;
			}
			$tmpl->set( 'blogItemId'		, $myblog->getItemId() );
		}
		$tmpl->set( 'showBlogLink'		, $showBlogLink );

		$tmpl->set ( 'isFriend'			, friendIsConnected ( $user->id, $my->id ) && $user->id != $my->id );
		$tmpl->set ( 'profile'			, $profile );
		$tmpl->set ( 'unread'			, $unread );
		$tmpl->set ( 'pending'			, $pending );
		$tmpl->set ( 'registerDate'		, $user->registerDate);
		
		$tmpl->set( 'adminControlHTML'	, $adminControlHTML );
		
		$html = $tmpl->fetch ( 'profile.header' );
		
		return $html;
	}
	
	

	/**
	 * Displays the viewing profile page.
	 *
	 * @access	public
	 * @param	array  An associative array to display the fields
	 */
	function profile(& $data)
	{
		$mainframe	=& JFactory::getApplication();
		$my 		= CFactory::getUser();
		//$user		=& CFactory::getActiveProfile ();
		
		$userid	=  JRequest::getVar('userid', $my->id);
		$user	= CFactory::getUser($userid);
		
		$userId		= JRequest::getVar('userid' , '' , 'GET' );
		
		if( $my->id != 0 && empty( $userId ) )
		{
			CFactory::setActiveProfile( $my->id );
			$user		= $my;
		}
        
        // Display breadcrumb regardless whether the user is blocked or not
        $pathway 	=& $mainframe->getPathway();
		$pathway->addItem($user->getDisplayName(), '');
		
        CFactory::load('helpers' , 'owner' );
        $blocked	= $user->isBlocked();
        
		if( $blocked && !isCommunityAdmin() )
		{
			$tmpl	= new CTemplate();
			echo $tmpl->fetch('profile.blocked');
			return;
		}

		// If the current browser is a site admin, display some notice that user is blocked.
		if( $blocked )
		{
			$this->addWarning( JText::_('CC USER ACCOUNT BLOCKED') );
		}
		
		// access check
		if(!$this->accessAllowed('privacyProfileView'))
		{
			return ;
		}

		 
		
		require_once (JPATH_COMPONENT.DS.'libraries'.DS.'userpoints.php');
		$appsLib	=& CAppPlugins::getInstance();
		
		$appsLib->loadApplications();
		
		$userStatus = $user->getStatus();
		$userStatus = empty($userStatus) ? '' : ' : '. $userStatus;  
		
		$document = & JFactory::getDocument ();
		$document->setTitle ( $user->getDisplayName() . $userStatus);

		/* begin: COMMUNITY_FREE_VERSION */
		if( !COMMUNITY_FREE_VERSION ) {
			$feedLink = CRoute::_('index.php?option=com_community&view=profile&userid=' . $user->id . '&format=feed');
			$feed = '<link rel="alternate" type="application/rss+xml" href="'.$feedLink.'"/>';
			$mainframe->addCustomHeadTag( $feed );
		}
		/* end: COMMUNITY_FREE_VERSION */
		
		// Show profile header
 		$headerHTML = $this->_showHeader( $data );
		

		ob_start ();

		// Load user application
		$apps = $data->apps;

		// Load community applications plugin
		$app 		=& CAppPlugins::getInstance();
		
		$appsModel	=& CFactory::getModel( 'apps' );
		$tmpAppData = $app->triggerEvent('onProfileDisplay' , '' , true);
		$appData 		= array();

		// @rule: Only display necessary apps.
		$count 	= COMMUNITY_FREE_VERSION && count( $tmpAppData ) > COMMUNITY_FREE_VERSION_APPS_LIMIT ? COMMUNITY_FREE_VERSION_APPS_LIMIT : count( $tmpAppData );

		for( $i = 0; $i < $count; $i++ )
		{
			$app 		=& $tmpAppData[ $i ];
			
			$privacy 	= $appsModel->getPrivacy( $user->id , $app->name );
			$app->id	= $appsModel->getUserApplicationId( $app->name , $user->id );
			
			if( $this->appPrivacyAllowed( $privacy ) )
			{
				$appData[]	= $app;
			}
		}
		unset( $tmpAppData );
		
		$tmpl	= new CTemplate();
		
		foreach( $appData as $app )
		{
			// If the apps content is empty, we ignore this app from showing
			// the header in profile page.
			if(JString::trim($app->data) == "")
				continue;
		
			$tmpl->set( 'title' , $app->title );
			$tmpl->set( 'boxid' , 'jsapp-' . rand( 500 , 999 ) );
			$tmpl->set( 'appname' , $app->name );
			$tmpl->set( 'appid'		, $app->id );
			$tmpl->set( 'content' , $app->data );
			$tmpl->set( 'core'		, $app->core );
			$tmpl->set( 'isOwner'	, isMine($my->id , $user->id ) );
			echo $tmpl->fetch( 'application.box' );
		}
		
		$contenHTML = ob_get_contents ();
		ob_end_clean ();


		// Get the config
		$config			=& CFactory::getConfig();
		
		// get total group
		$groupsModel	=& CFactory::getModel( 'groups' );
		$totalgroups    = $groupsModel->getGroupsCount( $user->id );

		// get total friend
		$friendsModel =& CFactory::getModel('friends');
		$totalfriends = $user->getFriendCount();
		
		// get total photos
		$photosModel	=& CFactory::getModel('photos');
		$totalphotos    = $photosModel->getPhotosCount( $user->id );

		// get total activities
		$activitiesModel =& CFactory::getModel('activities');
		$totalactivities = $activitiesModel->getActivityCount( $user->id );

		$isMine	= isMine($my->id, $user->id);

		// Get reporting html
		CFactory::load('libraries', 'reporting');
		$report		= new CReportingLibrary();
		$reportHTML	= $isMine ? '' : $report->getReportingHTML( JText::_('CC REPORT BAD USER') , 'profile,reportProfile' , array( $user->id ) );
		
		CFactory::load( 'libraries' , 'bookmarks' );
		$bookmarks		=new CBookmarks(CRoute::getExternalURL( 'index.php?option=com_community&view=profile&userid=' . $user->id ));
		$bookmarksHTML	= $bookmarks->getHTML();
		$tmpl = new CTemplate( );
		
		$tmpl->set( 'bookmarksHTML' , $bookmarksHTML );
		$tmpl->set ( 'profileOwnerName', $user->getDisplayName());
		$tmpl->set ( 'totalgroups' , $totalgroups );
		$tmpl->set ( 'totalfriends' , $totalfriends );
		$tmpl->set ( 'totalphotos' , $totalphotos );
		$tmpl->set ( 'totalactivities' , $totalactivities );
		$tmpl->set ( 'reportsHTML'		, $reportHTML );
		$tmpl->set ( 'mainframe' , $mainframe );
		$tmpl->set ( 'config'	, $config );
		$tmpl->set ( 'about' , $this->_getProfileHTML( $data->profile ) );
		$tmpl->set ( 'friends' , $this->_getFriendsHTML() );
		$tmpl->set ( 'groups' , $this->_getGroupsHTML() );
		$tmpl->set ( 'newsfeed', $this->_getNewsfeedHTML());
		$tmpl->set ( 'header', $headerHTML );
		$tmpl->set ( 'content', $contenHTML );
		$tmpl->set ( 'isMine', $isMine );
		$tmpl->setRef ( 'user'	, $user );

		echo $tmpl->fetch ( 'profile.index' );
	}


	/**
	 * Saves a user profile.
	 *
	 * @access	public
	 * @param	array  An associative array to display the fields
	 */
	function save($data) {
		?>
<h3>Profile saved</h3>
<a href="<?php
		echo cUserLink ( $data ['user'] ['id'] );
		?>">Return to profile</a>
		<?php
	}

	/**
	 * Edits a user profile
	 *
	 * @access	public
	 * @param	array  An associative array to display the editing of the fields
	 */
	function edit(& $data) {
		$mainframe =& JFactory::getApplication();
		
		// access check
		CFactory::setActiveProfile();
		if(!$this->accessAllowed('registered'))return ;
		
		$my = CFactory::getUser();
		$config		=& CFactory::getConfig();
		
		$pathway 	=& $mainframe->getPathway();
		$pathway->addItem(JText::_('CC PROFILE'), CRoute::_('index.php?option=com_community&view=profile&userid='.$my->id));
		$pathway->addItem(JText::_('CC EDIT PROFILE'), '');
		
		$document = & JFactory::getDocument ();
		$document->setTitle ( JText::_ ( 'CC EDIT PROFILE' ) );
		
		$js = JURI::root(). 'components/com_community/assets/validate-1.5';
		$js	.= ( $config->getBool('usepackedjavascript') ) ? '.pack.js' : '.js';		
		$document->addScript($js);		

		$this->showSubmenu ();

		CFactory::load( 'libraries' , 'profile' );
		
		$tmpl	= new CTemplate();
		
		$tmpl->set( 'fields' , $data->profile ['fields'] );
		
		echo $tmpl->fetch( 'profile.edit' );

	}
	
	/**
	 * Edits a user details
	 *
	 * @access	public
	 * @param	array  An associative array to display the editing of the fields
	 */
	function editDetails(& $data) 
	{
		$mainframe =& JFactory::getApplication();
		
		// access check
		CFactory::setActiveProfile();
		if(!$this->accessAllowed('registered'))return ;
				
		$my	=& JFactory::getUser();
		$config		=& CFactory::getConfig();
		
		$pathway 	=& $mainframe->getPathway();
		$pathway->addItem(JText::_('CC PROFILE'), CRoute::_('index.php?option=com_community&view=profile&userid='.$my->id));
		$pathway->addItem(JText::_('CC EDIT DETAILS'), '');
		
		$document = & JFactory::getDocument ();
		$document->setTitle ( JText::_ ( 'CC EDIT DETAILS' ) );
				
		$js = JURI::root(). 'components/com_community/assets/validate-1.5';
		$js	.= ( $config->getBool('usepackedjavascript') ) ? '.pack.js' : '.js';		
		$document->addScript($js);		

		$this->showSubmenu ();
		
		$connectModel	=& CFactory::getModel( 'Connect' );
		$associated		= $connectModel->isAssociated( $my->id );

		CFactory::load( 'helpers' , 'owner' );
		CFactory::load( 'libraries' , 'facebook' );
		
		$readPermission		= false;
		$writePermission	= false;
		
		if( $associated )
		{
			CFactory::load( 'libraries' , 'facebook' );
			$facebook		= new CFacebook();

			$readPermission		= $facebook->hasPermission('read_stream'); 
			$writePermission	= $facebook->hasPermission('publish_stream');
		}

		$fbHtml	= '';

		if( $config->get('fbconnectkey') && $config->get('fbconnectsecret') )
		{
			CFactory::load( 'libraries' , 'facebook' );
			$facebook	= new CFacebook( FACEBOOK_LOGIN_NOT_REQUIRED );
			$fbHtml		= $facebook->getButtonHTML();
		}
		

		$tmpl	= new CTemplate();
		$tmpl->set( 'fbHtml' , $fbHtml );
		$tmpl->set( 'readPermission'	, $readPermission );
		$tmpl->set( 'writePermission'	, $writePermission );
		$tmpl->set( 'params' , $data->params);
		$tmpl->set( 'user' , $my);
		$tmpl->set( 'config' , $config);
		$tmpl->set( 'associated' , $associated );
		$tmpl->set( 'isAdmin'	, isCommunityAdmin() );
		$tmpl->set( 'offsetList' , $data->offsetList );
		
		echo $tmpl->fetch( 'profile.edit.details' );
	}	

	function connect() {
	
		$document = & JFactory::getDocument ();
		$document->setTitle ( JText::_ ( 'CC CONNECT REQUEST' ) );
		
	?>
	<form method="post" action="">
		<input type="submit" name="yes" id="button_yes" value="<?php echo JText::_('CC BUTTON YES');?>" />
		<input type="submit" name="no" id="button_no" value="<?php echo JText::_('CC BUTTON NO');?>" />
	</form>

		<?php
	}

	function connect_sent() {
		$document = & JFactory::getDocument ();
		$document->setTitle ( JText::_ ( 'CC CONNECT REQUEST SENT' ) );

	}

	function appFullView()
	{
		$userid			= JRequest::getVar( 'userid' , '' );
		$profileModel	=& $this->getModel('profile');
		$avatarModel	=& $this->getModel('avatar');
		$applications	=& CAppPlugins::getInstance();
		$appName		= JString::strtolower(JRequest::getVar('app', '', 'GET'));
		
		if(empty($appName))
		{
			JError::raiseError( 500, 'CC APPLICATION ID REQUIRED');
		}

		if( empty($userid ) )
		{
			JError::raiseError( 500 , 'CC USER ID REQUIRED' );
		}
		$user			= CFactory::getUser( $userid );
		$document		=& JFactory::getDocument();
		$document->setTitle ( $user->getDisplayName() .' : '. $user->getStatus() );
		$appsModel		=& CFactory::getModel('apps');
		$appId			= $appsModel->getUserApplicationId($appName); 
		$plugin  		=& $applications->get($appName, $appId);

		if( !$plugin )
		{
			JError::raiseError( 500 , 'CC APPLICATION NOT FOUND' );
		}
		// Load plugin params
		$paramsPath		= JPATH_PLUGINS . DS . 'community' . DS . $appName . '.xml';
		$params			= new JParameter($appsModel->getPluginParams( $appsModel->getPluginId($appName)), $paramsPath );
		$plugin->params =& $params;
		
		// Load user params
		$xmlPath			= JPATH_PLUGINS . DS . 'community' . DS . $appName . DS . $appName . '.xml';
		$userParams			= new JParameter($appsModel->getUserAppParams($appId , $user->id ), $xmlPath );
		$plugin->userparams =& $userParams;
		$plugin->id			= $appId;
		
		$appObj			= new stdClass();
		$appObj->name	= $plugin->name;
		$appObj->html	= $plugin->onAppDisplay($params);
		$data->html		= $appObj->html;

		$this->attachMiniHeaderUser ( $user->id );

		echo $data->html;
	}

	/**
	 * Display Upload avatar form for user
	 **/	 	
	function uploadAvatar()
	{
		$mainframe =& JFactory::getApplication();
		if(!$this->accessAllowed('registered'))
		{
			echo JText::_('CC MEMBERS AREA');
			return;
		}		
		
		$my		= CFactory::getUser();
		$firstLogin	= false;				
		
		$pathway	=& $mainframe->getPathway();

		$pathway->addItem(JText::_('CC PROFILE'), CRoute::_('index.php?option=com_community&view=profile&userid='.$my->id));
		$pathway->addItem(JText::_('CC EDIT AVATAR'), '');
		
		// Load the toolbar
		$this->showSubmenu();
		$document = & JFactory::getDocument ();
		$document->setTitle ( JText::_ ( 'CC EDIT AVATAR' ) );

		$config			= CFactory::getConfig();
		$uploadLimit	= (double) $config->get('maxuploadsize');
		$uploadLimit	.= 'MB';
		
		$tmpl		= new CTemplate();
		$skipLink   = CRoute::_('index.php?option=com_community&view=frontpage&doSkipAvatar=Y&userid='.$my->id);
		
		$tmpl->set( 'my' , $my );
		$tmpl->set( 'uploadLimit' , $uploadLimit );
		$tmpl->set( 'firstLogin' , $firstLogin );
		$tmpl->set( 'skipLink' , $skipLink );
		
		echo $tmpl->fetch( 'profile.uploadavatar' );
	}

	/**
	 *
	 */
	function privacy()
	{
		$mainframe =& JFactory::getApplication();
		
		if(!$this->accessAllowed('registered'))
			return ;
		
		$pathway 	=& $mainframe->getPathway();
		$my = CFactory::getUser();

		$pathway->addItem(JText::_('CC PROFILE'), CRoute::_('index.php?option=com_community&view=profile&userid='.$my->id));
		$pathway->addItem(JText::_('CC EDIT PRIVACY'), '');
		
		$document = & JFactory::getDocument ();
		$document->setTitle ( JText::_ ( 'CC EDIT PRIVACY' ) );
		
		$this->showSubmenu();
		$user	= CFactory::getUser();
		$params = $user->getParams();		
		$config	=& CFactory::getConfig();

		$tmpl = new CTemplate();
		$tmpl->set('params', $params);
		$tmpl->set('config', $config);
		
		$html = $tmpl->fetch('profile.privacy');
		echo $html;
	}	

	function preferences()
	{
		$mainframe	=& JFactory::getApplication();
		
		if(!$this->accessAllowed('registered') )
		{
			return;
		}
		$this->showSubmenu();
		
		$my			= CFactory::getUser();
		$params		= $my->getParams();
		
		$this->addPathWay( JText::_('CC PROFILE') , CRoute::_('index.php?option=com_community&view=profile&userid='.$my->id) );
		$this->addPathWay( JText::_('CC EDIT PREFERENCES') , '' );
		
		$tmpl	= new CTemplate();
		$tmpl->set( 'params'	, $params );
		$html	= $tmpl->fetch('profile.preferences');
		echo $html;
	}
	
	function deleteProfile()
	{
		if(!$this->accessAllowed('registered')) return;
		
		$document = & JFactory::getDocument ();
		$document->setTitle ( JText::_ ('CC DELETE PROFILE') );
		
		$my		= CFactory::getUser();
		$this->addPathWay( JText::_('CC PROFILE') , CRoute::_('index.php?option=com_community&view=profile&userid='.$my->id) );
		$this->addPathWay( JText::_('CC EDIT PREFERENCES') , '' );
		
		$tmpl	= new CTemplate();
		$html	= $tmpl->fetch('profile.deleteprofile');
		echo $html;
	}
	/**
	 * Method to display the media lists
	 **/	 	
// 	function media()
// 	{
// 		$document =& JFactory::getDocument();
// 		$document->setTitle(JText::_('CC MEDIA LISTING'));
// 
// 		// Load up libraries and objects
// 		$user		=& CFactory::getActiveProfile();
// 		$my			=& JFactory::getUser();
// 		$config		=& CFactory::getConfig();		
//  		$model		=& CFactory::getModel('photos');
//  		$filesModel	=& CFactory::getModel('files');
// 
//  		
//  		$albums		= $model->get( $user->id , 'albums' );
//  		$files		= $filesModel->getFiles( $user->id , 5 );
// 
// 		// Add the menu item for media
// 		$this->addSubmenuItem('index.php?option=com_community&view=profile&userid=' . $user->id , JText::_('CC BACK TO PROFILE'));
// 		$this->addSubmenuItem( 'index.php?option=com_community&view=profile&task=media&id=' . $user->id , JText::_('CC MEDIA LISTING'));
// 		
// 		// @rule: Check if photos are enabled in the back end
// 		if( $config->get('enablephotos') )
// 		{
// 			$this->addSubmenuItem('index.php?option=com_community&view=photos&id=' . $user->id , JText::_('CC PHOTOS'));
// 		}
// 
// 		// @rule: Check if files are enabled in the back end
// 		if( $config->get('enablefiles') )
// 		{
// 			$this->addSubmenuItem('index.php?option=com_community&view=files&id=' . $user->id , JText::_('CC FILES'));
// 		}
// 		
// 		// @rule: Test if browser is viewing his own medias, display admin tools
// 		if(isMine($my->id, $user->id))
// 		{
// 			if( $config->get('enablephotos') )
// 			{
// 				$this->addSubmenuItem('index.php?option=com_community&view=photos&task=newalbum&id=' . $user->id, JText::_('CC CREATE ALBUM'));
// 				$this->addSubmenuItem('index.php?option=com_community&view=photos&task=upload&id=' . $user->id, JText::_('CC UPLOAD PHOTOS'));
// 			}
// 			
// 			if( $config->get('enablefiles') )
// 				$this->addSubmenuItem('index.php?option=com_community&view=files&task=upload&id=' . $user->id, JText::_('CC UPLOAD FILES'));
// 		}
// 		parent::showSubmenu();
// 
// 		$tmpl	= new CTemplate();
// 		
// 		$info	= JText::_('CC RECENT MEDIA NOTICE');
// 		
// 		$tmpl->set('isOwner'		, (isMine($my->id, $user->id)) );
// 		$tmpl->set('user' 		, $user);
// 		$tmpl->set('albums' 		, $albums);
// 		$tmpl->set('files' 		, $files );
// 		$tmpl->set('config' 		, $config);
// 		echo $tmpl->fetch('profile.media');
// 	}
}
?>
