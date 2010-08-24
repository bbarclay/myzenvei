<?php
/**
 * @package	JomSocial
 * @copyright (C) 2008 by Slashes & Dots Sdn Bhd - All rights reserved!
 * @license http://www.jomsocial.com Copyrighted Commercial Software
 */
defined('_JEXEC') or die('Restricted access');
jimport ( 'joomla.application.component.view' );

require_once(JPATH_ROOT . DS . 'components' . DS . 'com_community' . DS . 'views' . DS . 'profile' . DS . 'view.html.php' );

class CommunityViewIphoneProfile extends CommunityViewProfile {

	
	function profile(& $data)
	{
		
		$document =& JFactory::getDocument();
		
		
		$mainframe	=& JFactory::getApplication();
		$my 		= CFactory::getUser();
		
		$userid		= JRequest::getVar( 'userid' , '' );
		$user		= CFactory::getUser($userid);
		
		$userId		= JRequest::getVar('userid' , '' , 'GET' );
		
		if( $my->id != 0 && empty( $userId ) )
		{
			CFactory::setActiveProfile( $my->id );
			$user		= $my;
		}
        
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

		$pathway 	=& $mainframe->getPathway();
		$pathway->addItem(JText::_('CC PROFILE'), ''); 
		
		require_once (JPATH_COMPONENT.DS.'libraries'.DS.'userpoints.php');
		
		$userid		= JRequest::getVar( 'userid' , '' );
		$user		= CFactory::getUser($userid);
		
		$appsLib	=& CAppPlugins::getInstance();
		
		$appsLib->loadApplications();
		
		$document = & JFactory::getDocument ();
		$document->setTitle ( $user->getDisplayName() .' : '. $user->getStatus() );

		$feedLink = CRoute::_('index.php?option=com_community&view=profile&userid=' . $user->id . '&format=feed');
		$feed = '<link rel="alternate" type="application/rss+xml" href="'.$feedLink.'"/>';
		$mainframe->addCustomHeadTag( $feed );
		
		// Show profile header
 		$headerHTML = $this->_showHeader( $data );
		$document->addStylesheet( JURI::root() . 'components/com_community/templates/default/css/style.iphone.css' );

		ob_start ();

		// Load user application
		$apps = $data->apps;

		// Load community applications plugin
		$app 		=& CAppPlugins::getInstance();	
		
		$appsModel	=& CFactory::getModel( 'apps' );
		$tmpAppData = $app->triggerEvent('onProfileDisplay' , '' , true);
		
		$appData 		= array();

		// @rule: Only display necessary apps.
		// for now, only display wall plugin for iphone.
		
		$count 	= count( $tmpAppData );

		for( $i = 0; $i < $count; $i++ )
		{
			$app 		=& $tmpAppData[ $i ];
			
			if($app->name != 'walls') continue;						
			
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
			$tmpl->set( 'boxid' , rand( 500 , 999 ) );
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

		// Get reporting html
		CFactory::load('libraries', 'reporting');
		$report		= new CReportingLibrary();
		$reportHTML	= $report->getReportingHTML( JText::_('CC REPORT BAD USER') , 'profile,reportProfile' , array( $user->id ) );
		
		$tmpl = new CTemplate( );
		
		$tmpl->set ( 'my' , $my );
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
		$tmpl->set ( 'isMine', isMine($my->id, $user->id));
		$tmpl->setRef ( 'user'	, $user );

		echo $tmpl->fetch ( 'profile.index' );
				
	}

}
?>
