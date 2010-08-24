<?php
/**
 * @package	JomSocial
 * @copyright (C) 2008 by Slashes & Dots Sdn Bhd - All rights reserved!
 * @license http://www.jomsocial.com Copyrighted Commercial Software
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die();

jimport( 'joomla.application.component.view');

class CommunityViewGroups extends CommunityView
{
	function _addGroupInPathway( $groupId )
	{
		$group			=& JTable::getInstance( 'Group' , 'CTable' );
		$group->load( $groupId );

		$this->addPathway( $group->name , CRoute::_('index.php?option=com_community&view=groups&task=viewgroup&groupid=' . $group->id) );
	}
	
	function _addSubmenu()
	{

		$task	= JRequest::getVar( 'task' , '' , 'GET' );

		$config	=& CFactory::getConfig();
		$groupid	= JRequest::getVar( 'groupid' , '' , 'GET' );

		$backLink	= array( 'invitefriends', 'viewmembers' , 'viewdiscussion' , 'viewdiscussions' , 'viewbulletins', 'adddiscussion' , 'addnews' , 'viewbulletin', 'uploadavatar' , 'edit');

		if( in_array( $task , $backLink) )
		{
			$this->addSubmenuItem('index.php?option=com_community&view=groups&task=viewgroup&groupid=' . $groupid, JText::_('CC BACK TO GROUP'));
				
			if( $task == 'viewdiscussions' )
				$this->addSubmenuItem('index.php?option=com_community&view=groups&groupid=' . $groupid . '&task=adddiscussion', JText::_('CC ADD DISCUSSION') , '' , SUBMENU_RIGHT );
				
			if( $task == 'viewmembers' )
				$this->addSubmenuItem('index.php?option=com_community&view=groups&task=invitefriends&groupid=' . $groupid, JText::_('CC TAB INVITE') , '' , SUBMENU_RIGHT );
		}
		else
		{
			$this->addSubmenuItem('index.php?option=com_community&view=groups', JText::_('CC GROUP LISTING'));
			
			if(isRegisteredUser())
				$this->addSubmenuItem('index.php?option=com_community&view=groups&task=mygroups', JText::_('CC MY GROUPS'));

			if( $config->get('creategroups')  && isRegisteredUser())
				$this->addSubmenuItem('index.php?option=com_community&view=groups&task=create', JText::_('CC CREATE') , '' , SUBMENU_RIGHT );
				
			$this->addSubmenuItem('index.php?option=com_community&view=groups&task=search', JText::_('CC SEARCH GROUP'));
		}
	}

	function showSubmenu()
	{
		$this->_addSubmenu();
		parent::showSubmenu();
	}

	/**
	 * Display invite form
	 **/
	function invitefriends()
	{
		$document	=& JFactory::getDocument();
		$document->setTitle( JText::_('CC INVITE FRIENDS TO GROUP TITLE') );

		if( !$this->accessAllowed( 'registered' ) )
		{
			return;
		}
		
		$this->showSubmenu();
		
		$my				= CFactory::getUser();
		$groupId		= JRequest::getVar( 'groupid' , '' , 'GET' );
		$this->_addGroupInPathway( $groupId );
		$this->addPathway( JText::_('CC INVITE FRIENDS TO GROUP TITLE') );

		$friendsModel	=& CFactory::getModel( 'Friends' );
		$groupsModel	=& CFactory::getModel( 'Groups' );
						
		$tmpFriends		= $friendsModel->getFriends( $my->id , 'name' , false);				
		
		$friends		= array();
		
		for( $i = 0; $i < count( $tmpFriends ); $i++ )
		{
			$friend		=& $tmpFriends[ $i ];
			
			if( !$groupsModel->isMember( $friend->id , $groupId ) )
			{
				$friends[]	= $friend;
			}
		}
		unset( $tmpFriends );

		$group			=& JTable::getInstance( 'Group' , 'CTable' );
		$group->load( $groupId );
		
		$tmpl			= new CTemplate();
		$tmpl->set( 'friends' , $friends );
		$tmpl->set( 'group' , $group );
		echo $tmpl->fetch( 'groups.invitefriends' );
	}

	function edit()
	{
		$config		=& CFactory::getConfig();
		$document 	=& JFactory::getDocument();
        $document->setTitle( JText::_('CC EDIT GROUP TITLE') );
        

		$this->showSubmenu();

        $uri	= JURI::root();
        $js		= $uri . 'components/com_community/assets/validate-1.5';        		
		$js	.= ( $config->getBool('usepackedjavascript') ) ? '.pack.js' : '.js';        
        
        $document->addScript($js);
        
        $groupId		= JRequest::getVar( 'groupid' , '' , 'REQUEST' );
		$groupModel		= CFactory::getModel( 'Groups' );
		$categories		= $groupModel->getCategories();
		$group			=& JTable::getInstance( 'Group' , 'CTable' );
		$group->load( $groupId );
		
		$this->_addGroupInPathway( $group->id );
		$this->addPathway( JText::_('CC EDIT GROUP TITLE') );

		$tmpl	= new CTemplate();
		$tmpl->set( 'config'	, $config );
		$tmpl->set( 'categories', $categories );
		$tmpl->set( 'group' 	, $group );
		$tmpl->set( 'params'	, $group->getParams() );
		$tmpl->set( 'isNew'		, false );
		
		echo $tmpl->fetch( 'groups.forms' );
	}
	
	/**
	 * Method to display group creation form
	 **/
	function create( $data )
	{
		$config		=& CFactory::getConfig();
		$document	=& JFactory::getDocument();
        $document->setTitle( JText::_('CC CREATE NEW GROUP TITLE') );

        $uri	= JURI::root();
        $js		= $uri . 'components/com_community/assets/validate-1.5';        		
		$js	.= ( $config->getBool('usepackedjavascript') ) ? '.pack.js' : '.js';        
        
        $document->addScript($js);

		$this->showSubmenu();

		$tmpl	= new CTemplate();
				
		$my			= CFactory::getUser();
		$model		=& CFactory::getModel( 'groups' );					
		$totalGroup	= $model->getGroupsCreationCount($my->id);
		
		
		//initialize default value	
		$group			=& JTable::getInstance( 'Group' , 'CTable' );					
		$group->name 			= JRequest::getVar('name', '', 'POST');
		$group->description		= JRequest::getVar('description', '', 'POST');
		$group->email			= JRequest::getVar('email', '', 'POST');
		$group->website 		= JRequest::getVar('website', '', 'POST');		
				

		$tmpl->set('config'				, $config );
		$tmpl->set('categories' 		, $data->categories );
		
// 		$tmpl->set('name'				, JRequest::getVar('name', '', 'POST'));
// 		$tmpl->set('email'				, JRequest::getVar('email', '', 'POST'));
// 		$tmpl->set('website'			, JRequest::getVar('website', '', 'POST'));
// 		$tmpl->set('description'		, JRequest::getVar('description', '', 'POST'));
		$tmpl->set('group'				, $group );
				
		$tmpl->set('groupCreated'		, $totalGroup );
		$tmpl->set('groupCreationLimit'	, $config->get('groupcreatelimit') );		
		$tmpl->set('params'				, $group->getParams() );
		$tmpl->set('isNew'				, true );

		echo $tmpl->fetch( 'groups.forms' );
	}

	/**
	 * A group has just been created, should we just show the album ?
	 */
	function created()
	{

		$groupid 	=  JRequest::getCmd( 'groupid', 0 );

		CFactory::load( 'models' , 'groups');
		$group		=& JTable::getInstance( 'Group' , 'CTable' );

		$group->load($groupid);
		$document =& JFactory::getDocument();
        $document->setTitle( $group->name );

        $uri	= JURI::base();
		$this->showSubmenu();

		$tmpl	= new CTemplate();

		$tmpl->set( 'link'			, CRoute::_('index.php?option=com_community&view=groups&task=viewgroup&groupid='.$groupid));
		$tmpl->set( 'linkBulletin'	, CRoute::_('index.php?option=com_community&view=groups&task=addnews&groupid=' . $groupid) );
		$tmpl->set('linkUpload', CRoute::_('index.php?option=com_community&view=groups&task=uploadavatar&groupid='.$groupid));
		$tmpl->set( 'linkEdit'		, CRoute::_('index.php?option=com_community&view=groups&task=edit&groupid=' . $groupid ) );

		echo $tmpl->fetch( 'groups.created' );
	}

	/**
	 * Method to display output after saving group
	 *
	 * @param	JTable	Group JTable object
	 **/
	function save( $group )
	{
		$mainframe =& JFactory::getApplication();

		$document =& JFactory::getDocument();
        $document->setTitle(JText::_('CC UPLOAD GROUP AVATAR TITLE'));

        // Load submenus
        $this->showSubmenu();

		if( !$group->id )
		{
			$this->addWarning('CC SAVE GROUP ERROR');
			return;
		}
		$mainframe->enqueueMessage(JText::sprintf('CC NEW GROUP CREATED', $group->name));

		$tmpl	= new CTemplate();

		$tmpl->set( 'group'		, $group );

		echo $tmpl->fetch( 'groups.save' );
	}

	/**
	 * Method to display listing of groups from the site
	 **/
	function display( $data )
	{
		$mainframe =& JFactory::getApplication();

		// Load required filterbar library that will be used to display the filtering and sorting.
		CFactory::load( 'libraries' , 'filterbar' );
		
		require_once( JPATH_COMPONENT . DS . 'libraries' . DS . 'activities.php');
		
		$model			=& CFactory::getModel( 'groups' );
 		$avatarModel	=& CFactory::getModel( 'avatar' );
		$wallsModel		=& CFactory::getModel( 'wall' );
		
		// Get category id from the query string if there are any.
		$categoryId		= JRequest::getInt( 'categoryid' , 0 );
		$category		=& JTable::getInstance( 'Category' , 'CTable' );
		$category->load( $categoryId );
		
		$document =& JFactory::getDocument();
		$this->addPathway( JText::_('CC GROUPS') , CRoute::_('index.php?option=com_community&view=groups') );
		 
		
		// If we are browing by category, add additional breadcrumb and add
		// category name in the page title
		if($categoryId != 0) 
		{
			$this->addPathway( JText::_('CC BROWSE GROUPS TITLE') , CRoute::_('index.php?option=com_community&view=groups') );
			$this->addPathway( $category->name , '' );
        	$document->setTitle(JText::_( 'CC BROWSE GROUPS TITLE' ) . ' : ' . JText::_($category->name) );
        } 
		else 
		{
			$this->addPathway( JText::_('CC BROWSE GROUPS TITLE') , '' );
			$document->setTitle(JText::_( 'CC BROWSE GROUPS TITLE' ));
		}

		$config	=& CFactory::getConfig();
		$my		= CFactory::getUser();
        $uri	= JURI::base();

		$this->showSubmenu();

 		$data		= new stdClass();
		$sorted		= JRequest::getVar( 'sort' , 'latest' , 'GET' );

 		// Get the categories
 		$data->categories	= $model->getCategories();

 		// It is safe to pass 0 as the category id as the model itself checks for this value.
 		$data->groups			= $model->getAllGroups( $category->id , $sorted );

		// Get pagination object
		$data->pagination	= $model->getPagination();

		$act			= new CActivityStream();

 		// Attach the necessary properties for each group
 		for($i = 0; $i < count($data->groups);  $i++)
 		{
 			$data->groups[$i]->thumb		= $model->getThumbAvatar( $data->groups[$i]->id , $data->groups[$i]->thumb );
		}

		// Get the template for the group lists
		$groupsHTML	= $this->_getGroupsHTML( $data->groups );
		
		CFactory::load( 'helpers' , 'owner' );
		CFactory::load( 'libraries' , 'featured' );
		$featured		= new CFeatured( FEATURED_GROUPS );
		$featuredGroups	= $featured->getItemIds();
		$featuredList	= array();
		
		foreach($featuredGroups as $group )
		{
			$table			=& JTable::getInstance( 'Group' , 'CTable' );
			$table->load($group);
			$featuredList[]	= $table;
		}

		$tmpl		= new CTemplate();

		$sortItems =  array(
				'latest' 		=> JText::_('CC GROUP SORT LATEST') ,
				'alphabetical'	=> JText::_('CC SORT ALPHABETICAL'),
				'mostdiscussed'	=> JText::_('CC GROUP SORT MOST DISCUSSED'),
				'mostwall'		=> JText::_('CC GROUP SORT MOST WALL POST'),
 				'mostmembers'	=> JText::_('CC GROUP SORT MOST MEMBERS'),
 				'mostactive'	=> JText::_('CC GROUP SORT MOST ACTIVE') );

		$tmpl->set( 'featuredList'	, $featuredList );
        $tmpl->set( 'index'			, true );
		$tmpl->set( 'categories' 	, $data->categories );
		$tmpl->set( 'groupsHTML'	, $groupsHTML );
		$tmpl->set( 'pagination' 	, $data->pagination );
		$tmpl->set( 'config'		, $config );
		$tmpl->set( 'category' 		, $category );
		$tmpl->set( 'isCommunityAdmin', isCommunityAdmin() );
		$tmpl->set( 'sortings'		, CFilterBar::getHTML( CRoute::getURI(), $sortItems, 'latest') );
		$tmpl->set( 'my' 			, $my );
		echo $tmpl->fetch( 'groups.index' );
	}

	/**
	 * Application full view
	 **/
	function discussAppFullView()
	{
		$document		=& JFactory::getDocument();
		$document->setTitle( JText::_('CC REPLY TO DISCUSSION TITLE') );
			
		$applicationName	= JString::strtolower( JRequest::getVar( 'app' , '' , 'GET' ) );

		if(empty($applicationName))
		{
			JError::raiseError( 500, 'CC APP ID REQUIRED');
		}

		$output		= '';
		$topicId	= JRequest::getVar( 'topicid' , '' , 'GET' );

		$model		=& CFactory::getModel( 'discussions' );
		$discussion	=& JTable::getInstance( 'Discussion' , 'CTable' );
		$discussion->load( $topicId );

		$this->addSubmenuItem('index.php?option=com_community&view=groups&task=viewdiscussion&groupid=' . $discussion->groupid . '&topicid=' . $topicId, JText::_('CC BACK TO TOPIC'));
		parent::showSubmenu();
		
		//@todo: Since group walls doesn't use application yet, we process it manually now.
		if( $applicationName == 'walls' )
		{
			CFactory::load( 'libraries' , 'wall' );
			$limit		= JRequest::getVar( 'limit' , 5 , 'REQUEST' );
			$limitstart = JRequest::getVar( 'limitstart', 0, 'REQUEST' );
			
			$my			= CFactory::getUser();
			$config		=& CFactory::getConfig();
			
		
			CFactory::load( 'helpers' , 'owner' );
			
			if( !$config->get('lockgroupwalls') || ($config->get('lockgroupwalls') ) || isCommunityAdmin() )
			{
				$viewAllLink = false;
				if(JRequest::getVar('task', '', 'REQUEST') != 'app')
				{
					$viewAllLink	= CRoute::_('index.php?option=com_community&view=groups&task=discussapp&topicid=' . $discussion->id . '&app=walls');
				}
				
				$output	.= CWallLibrary::getWallInputForm( $discussion->id , 'groups,ajaxSaveWall', 'groups,ajaxRemoveWall' , $viewAllLink );
			}

			// Get the walls content
			$output 		.='<div id="wallContent">';
			$output			.= CWallLibrary::getWallContents( 'discussions' , $discussion->id , ($my->id == $discussion->creator) , $limit , $limitstart );
			$output 		.= '</div>';
			
			jimport('joomla.html.pagination');
			$wallModel 		=& CFactory::getModel('wall');
			$pagination		= new JPagination( $wallModel->getCount( $discussion->id , 'discussions' ) , $limitstart , $limit );

			$output		.= '<div class="pagination-container">' . $pagination->getPagesLinks() . '</div>';
		}
		else
		{
			CFactory::load( 'libraries' , 'apps' );
			$model				=& CFactory::getModel('apps');
			$applications		=& CAppPlugins::getInstance();
			$applicationId		= $model->getUserApplicationId( $applicationName );
			
			$application		= $applications->get( $applicationName , $applicationId );
	
			// Get the parameters
			$manifest			= JPATH_PLUGINS . DS . 'community' . DS . $applicationName . DS . $applicationName . '.xml';
			
			$params			= new JParameter( $model->getUserAppParams( $applicationId ) , $manifest );
	
			$application->params	=& $params;
			$application->id		= $applicationId;
			
			$output	= $application->onAppDisplay( $params );
		}
		
		echo $output;
	}
	
	/**
	 * Application full view
	 **/
	function appFullView()
	{
		$document		=& JFactory::getDocument();
		$document->setTitle( JText::_('CC GROUP WALL TITLE') );
		
		$applicationName	= JString::strtolower( JRequest::getVar( 'app' , '' , 'GET' ) );

		if(empty($applicationName))
		{
			JError::raiseError( 500, 'CC APP ID REQUIRED');
		}

		$output	= '';
		
		//@todo: Since group walls doesn't use application yet, we process it manually now.
		if( $applicationName == 'walls' )
		{
			CFactory::load( 'libraries' , 'wall' );
			$limit		= JRequest::getVar( 'limit' , 5 , 'REQUEST' );
			$limitstart = JRequest::getVar( 'limitstart', 0, 'REQUEST' );
			$groupId	= JRequest::getVar( 'groupid' , '' , 'GET' );
			$my			= CFactory::getUser();
			$config		=& CFactory::getConfig();
			
			$groupModel	=& CFactory::getModel( 'groups' );
			$group		=& JTable::getInstance( 'Group' , 'CTable' );
			$group->load( $groupId );

			// Test if the current browser is a member of the group
			$isMember			= $group->isMember( $my->id );
			$waitingApproval	= $groupModel->isWaitingAuthorization( $my->id , $group->id );
		
			CFactory::load( 'helpers' , 'owner' );
			
			if( !$isMember && !isCommunityAdmin() && $group->approvals == COMMUNITY_PRIVATE_GROUP )
			{
				echo JText::_('CC PRIVATE GROUP NOTICE');
				return;
			}
			
			if( !$config->get('lockgroupwalls') || ($config->get('lockgroupwalls') && ($isMember) && !($waitingApproval) ) || isCommunityAdmin() )
			{
				$viewAllLink = false;
				if(JRequest::getVar('task', '', 'REQUEST') != 'app')
				{
					$viewAllLink	= CRoute::_('index.php?option=com_community&view=groups&task=app&groupid=' . $group->id . '&app=walls');
				}
				
				$output	.= CWallLibrary::getWallInputForm( $group->id , 'groups,ajaxSaveWall', 'groups,ajaxRemoveWall' , $viewAllLink );
			}

			// Get the walls content
			$output 		.='<div id="wallContent">';
			$output			.= CWallLibrary::getWallContents( 'groups' , $group->id , ($my->id == $group->ownerid) , $limit , $limitstart );
			$output 		.= '</div>';
			
			jimport('joomla.html.pagination');
			$wallModel 		=& CFactory::getModel('wall');
			$pagination		= new JPagination( $wallModel->getCount( $group->id , 'groups' ) , $limitstart , $limit );

			$output		.= '<div class="pagination-container">' . $pagination->getPagesLinks() . '</div>';
		}
		else
		{
			CFactory::load( 'libraries' , 'apps' );
			$model				=& CFactory::getModel('apps');
			$applications		=& CAppPlugins::getInstance();
			$applicationId		= $model->getUserApplicationId( $applicationName );
			
			$application		= $applications->get( $applicationName , $applicationId );

			if( !$application )
			{
				JError::raiseError( 500 , 'CC APPLICATION NOT FOUND' );
			}
			
			// Get the parameters
			$manifest			= JPATH_PLUGINS . DS . 'community' . DS . $applicationName . DS . $applicationName . '.xml';
			
			$params			= new JParameter( $model->getUserAppParams( $applicationId ) , $manifest );
	
			$application->params	=& $params;
			$application->id		= $applicationId;
			
			$output	= $application->onAppDisplay( $params );
		}
		
		echo $output;
	}
		 	
	/**
	 * Displays specific groups
	 **/
	function viewGroup()
	{
		$mainframe =& JFactory::getApplication();

		require_once (JPATH_COMPONENT.DS.'libraries'.DS.'tooltip.php');
		require_once( JPATH_COMPONENT . DS .'libraries' . DS . 'wall.php' );

		// Load window library
		CFactory::load( 'libraries' , 'window' );
		
		// Load necessary window css / javascript headers.
		CWindow::load();
		
		$config			=& CFactory::getConfig();
		$document		=& JFactory::getDocument();

		// Load appropriate models
		$groupModel		=& CFactory::getModel( 'groups' );
		$wallModel		=& CFactory::getModel( 'wall' );
		$userModel		=& CFactory::getModel( 'user' );
		$discussModel	=& CFactory::getModel( 'discussions' );
		$bulletinModel	=& CFactory::getModel( 'bulletins' );
		$photosModel	=& CFactory::getModel( 'photos' );
		
		$groupid		= JRequest::getInt( 'groupid' , '' );
		CError::assert( $groupid , '' , '!empty' , __FILE__ , __LINE__ );

		$editGroup		= JRequest::getVar( 'edit' , false , 'GET' );
		$editGroup		= ( $editGroup == 1 ) ? true : false;
		
		// Load the group table.
		$group			=& JTable::getInstance( 'Group' , 'CTable' );
		$group->load( $groupid );
		$params			= $group->getParams();
		
		// @rule: Test if the group is unpublished, don't display it at all.
		if( !$group->published )
		{
			echo JText::_('CC GROUP UNPUBLISHED');
			return;
		}
		
		// Set the group info to contain proper <br>
		$group->description	= nl2br( $group->description );
		
		$groupType	= $group->approvals == COMMUNITY_PRIVATE_GROUP ?  JText::_( 'CC PRIVATE GROUP') : JText::_( 'CC OPEN GROUP');
		$groupName	= $group->approvals == COMMUNITY_PRIVATE_GROUP ? $group->name . ' (' . JText::_( 'CC PRIVATE GROUP') . ')' : $group->name;

		// Set page title
        $document->setTitle( $groupName );
        $this->showSubmenu();

		$this->addPathway( JText::_('CC GROUPS') , CRoute::_('index.php?option=com_community&view=groups') );
		$this->addPathway( JText::sprintf( 'CC VIEW GROUP TITLE' , $group->name ), '' );

		// Update group's avatar path to use absolute path
		$group->avatar	= rtrim( JURI::root() , '/' ) . '/' . $group->avatar;
		
		// Load the current browsers data
		$my			= CFactory::getUser();

		// Get members list for display
		$members		= $groupModel->getMembers( $groupid , 12 , true , CC_RANDOMIZE);
		$membersCount	= $groupModel->total;
		CError::assert( $members , 'array' , 'istype' , __FILE__ , __LINE__ );

		// Get the news
		$bulletins		= $bulletinModel->getBulletins( $group->id );
		$totalBulletin	= $bulletinModel->total;
		CError::assert( $bulletins , 'array', 'istype', __FILE__ , __LINE__ );

		// Get discussions
		$discussions		= $discussModel->getDiscussionTopics( $group->id , '10' , $params->get('discussordering' , DISCUSSION_ORDER_BYLASTACTIVITY) );
		$totalDiscussion	= $discussModel->total;

		CError::assert( $discussions , 'array', 'istype', __FILE__ , __LINE__ );

		// Get list of unapproved members
		$unapproved		= $groupModel->getMembers( $group->id , null , false );

		// Attach avatar of the member to the discussions
		for( $i = 0; $i < count( $discussions ); $i++ )
		{
			$row	=& $discussions[$i];

			$row->user	= CFactory::getUser( $row->creator );
			
			// Get last replier for the discussion
			$row->lastreplier			= $discussModel->getLastReplier( $row->id );
			if( $row->lastreplier )
				$row->lastreplier->post_by	= CFactory::getUser( $row->lastreplier->post_by );
		}

		// Attach avatar of the member
		for( $i = 0; ($i < count($members)); $i++)
		{
			$row	=& $members[$i];

			$members[$i]	= CFactory::getUser( $row->id );
		}
		// Test if the current user is admin
		$isAdmin			= $groupModel->isAdmin( $my->id , $group->id );
		
		// Test if the current browser is a member of the group
		$isMember			= $group->isMember( $my->id );
		$waitingApproval	= false;

		// If I have tried to join this group, but not yet approved, display a notice
		if( $groupModel->isWaitingAuthorization( $my->id , $group->id ) )
		{
			$waitingApproval	= true;
		}

		// Get the walls
		$wallContent	= CWallLibrary::getWallContents( 'groups' , $group->id , $isAdmin , 10 ,0);
		$wallForm		='';

		CFactory::load( 'helpers' , 'owner' );
		
		if( !$config->get('lockgroupwalls') || ($config->get('lockgroupwalls') && ($isMember) && !($waitingApproval) ) || isCommunityAdmin() )
		{
			$viewAllLink = false;
			if(JRequest::getVar('task', '', 'REQUEST') != 'app')
			{
				$viewAllLink	= CRoute::_('index.php?option=com_community&view=groups&task=app&groupid=' . $group->id . '&app=walls');
			}
			
			$wallForm	= CWallLibrary::getWallInputForm( $group->id , 'groups,ajaxSaveWall', 'groups,ajaxRemoveWall' , $viewAllLink );
		}

		// Process discussions HTML output
		$tmpl		= new CTemplate();
		$tmpl->set( 'discussions'	, $discussions );
		$tmpl->set( 'groupId'		, $group->id );
		$discussionsHTML	= $tmpl->fetch( 'groups.discussionlist' );
		unset( $tmpl );

		// Get the creator of the discussions
		for( $i = 0; $i < count( $bulletins ); $i++ )
		{
			$row			=& $bulletins[ $i ];

			$row->creator	= CFactory::getUser( $row->created_by );
		}
		
		// Process bulletins HTML output
		$tmpl		= new CTemplate();
		$tmpl->set( 'bulletins'	, $bulletins );
		$tmpl->set( 'groupId'		, $group->id );
		$bulletinsHTML	= $tmpl->fetch( 'groups.bulletinlist' );
		unset( $tmpl );
		$tmpl		= new CTemplate();

		// Get categories list
		// We should really load this in saperate file
		// @todo: editing group should really open a new page
		if($my->id == $group->ownerid || isCommunityAdmin() )
		{
			$categories		= $groupModel->getCategories();
			CError::assert( $categories , 'array', 'istype', __FILE__ , __LINE__ );
			
			$tmpl->set( 'categories' 		, $categories );
		}

		$isMine		= ($my->id == $group->ownerid);
		// Get reporting html
		CFactory::load('libraries', 'reporting');
		$report		= new CReportingLibrary();

		$reportHTML	= $report->getReportingHTML( JText::_('CC REPORT GROUP') , 'groups,reportGroup' , array( $group->id ) );
		
		$isSuperAdmin	= isCommunityAdmin();
		
		if( $group->approvals == '1' && !$isMine && !$isMember && !$isSuperAdmin )
		{
			$this->addWarning( JText::_( 'CC PRIVATE GROUP NOTICE' ) );
		}
		
		$albums			=& $photosModel->getGroupAlbums($group->id , true, false, $params->get('grouprecentphotos' , GROUP_PHOTO_RECENT_LIMIT));
		$totalAlbums	= $photosModel->total;
		
		CFactory::load( 'helpers', 'videos' );
		CFactory::load( 'libraries' , 'videos' );
		CFactory::load( 'helpers' , 'group' );
		$videoModel 	=& CFactory::getModel('videos');
		$videos 		= $videoModel->getGroupVideos( $group->id, '', $params->get('grouprecentvideos' , GROUP_VIDEO_RECENT_LIMIT) );
		$videos			= cPrepareVideos($videos);
		$videoThumbWidth	= CVideoLibrary::thumbSize('width');
		$videoThumbHeight	= CVideoLibrary::thumbSize('height');
		$totalVideos	= $videoModel->total;
			
		//photo permission
		$allowManagePhotos = cAllowManagePhoto($group->id);
		
		//video permission			
		$allowManageVideos = cAllowManageVideo($group->id);
		CFactory::load( 'libraries' , 'bookmarks' );
		$bookmarks		= new CBookmarks(CRoute::getExternalURL( 'index.php?option=com_community&view=groups&task=viewgroup&groupid=' . $group->id ));
		$bookmarksHTML	= $bookmarks->getHTML();
		$isCommunityAdmin	= isCommunityAdmin();
		
		if( $group->approvals=='0' || $isMine || $isMember || $isCommunityAdmin )
		{
			// Set feed url
			$feedLink = CRoute::_('index.php?option=com_community&view=groups&task=viewbulletins&groupid=' . $group->id . '&format=feed');
			$feed = '<link rel="alternate" type="application/rss+xml" title="' . JText::_('CC SUBSCRIBE TO BULLETIN FEEDS') . '" href="'.$feedLink.'"/>';
			$document->addCustomTag( $feed );
			
			$feedLink = CRoute::_('index.php?option=com_community&view=groups&task=viewdiscussions&groupid=' . $group->id . '&format=feed');
			$feed = '<link rel="alternate" type="application/rss+xml" title="'. JText::_('CC SUBSCRIBE TO DISCUSSION FEEDS') .'" href="'.$feedLink.'"/>';
			$document->addCustomTag( $feed );
		}
		
		$tmpl->set( 'showPhotos'		, ($params->get('photopermission') != -1) );
		$tmpl->set( 'showVideos'		, ($params->get('videopermission') != -1) );
		$tmpl->set( 'bookmarksHTML'		, $bookmarksHTML );
		$tmpl->set( 'allowManagePhotos'	, $allowManagePhotos );
		$tmpl->set( 'allowManageVideos'	, $allowManageVideos );
		$tmpl->set( 'videos'			, $videos );
		$tmpl->set( 'videoThumbWidth'	, $videoThumbWidth );
		$tmpl->set( 'videoThumbHeight'	, $videoThumbHeight );
		$tmpl->set( 'totalVideos'		, $totalVideos );
		$tmpl->set( 'albums'			, $albums );
		$tmpl->set( 'totalAlbums'		, $totalAlbums );
		$tmpl->set( 'reportHTML'		, $reportHTML );
		$tmpl->set( 'editGroup'			, $editGroup );
		$tmpl->set( 'waitingApproval'	, $waitingApproval );
		$tmpl->set( 'config'			, $config );
		$tmpl->set( 'my'				, $my);
		$tmpl->set( 'isMine'			, $isMine );
		$tmpl->set( 'isAdmin'			, $isAdmin );
		$tmpl->set( 'isSuperAdmin'		, $isSuperAdmin );
		$tmpl->set( 'isMember' 			, $isMember );
		$tmpl->set( 'unapproved'		, count( $unapproved ) );
		$tmpl->set( 'membersCount'		, $membersCount );
		$tmpl->set( 'group' 			, $group );
		$tmpl->set( 'totalBulletin'		, $totalBulletin );
		$tmpl->set( 'totalDiscussion'	, $totalDiscussion );
		$tmpl->set( 'members' 			, $members );
		$tmpl->set( 'bulletins'			, $bulletins );
		$tmpl->set( 'wallForm' 			, $wallForm );
		$tmpl->set( 'wallContent' 		, $wallContent );
		$tmpl->set( 'discussions' 		, $discussions );
		$tmpl->set( 'discussionsHTML'	, $discussionsHTML );
		$tmpl->set( 'bulletinsHTML'		, $bulletinsHTML );
		$tmpl->set( 'isCommunityAdmin'	, $isCommunityAdmin );
		
		echo $tmpl->fetch( 'groups.viewgroup' );
	}

	function uploadAvatar( $data )
	{

		$document =& JFactory::getDocument();
        $document->setTitle(JText::_('CC UPLOAD GROUP AVATAR'));
		
		$this->_addGroupInPathway( $data->id );		
		$this->addPathway( JText::_('CC UPLOAD GROUP AVATAR') );

		$this->showSubmenu();

		$config			= CFactory::getConfig();
		$uploadLimit	= (double) $config->get('maxuploadsize');
		$uploadLimit	.= 'MB';
		
		$tmpl	= new CTemplate();

		$tmpl->set( 'groupId' 	, $data->id );
		$tmpl->set( 'thumbnail' , $data->thumb );
		$tmpl->set( 'uploadLimit'	, $uploadLimit );
		$tmpl->set( 'avatar'	, $data->avatar ); 
		echo $tmpl->fetch( 'groups.uploadavatar' );
	}

	/**
	 * Method to display groups that belongs to a user.
	 *
	 * @access public
	 */
	function mygroups()
	{
		$mainframe =& JFactory::getApplication();

		// Load required filterbar library that will be used to display the filtering and sorting.
		CFactory::load( 'libraries' , 'filterbar' );
		
		$document =& JFactory::getDocument();
		
		$this->addPathway( JText::_('CC GROUPS') , CRoute::_('index.php?option=com_community&view=groups') );
		$this->addPathway( JText::_('CC MY GROUPS TITLE') , '' );

        $document->setTitle(JText::_('CC MY GROUPS TITLE'));
        $this->showSubmenu();

		$uri	= JURI::base();

		//@todo: make mygroups page to contain several admin tools for owner?
        $my				= CFactory::getUser();
        $groupsModel	=& CFactory::getModel('groups');
        $avatarModel	=& CFactory::getModel('avatar');
        $wallsModel		=& CFactory::getModel( 'wall' );
        $activityModel	=& CFactory::getModel( 'activities' );

		$sorted			= JRequest::getVar( 'sort' , 'latest' , 'GET' );

		// @todo: proper check with CError::assertion
		// Make sure the sort value is not other than the array keys

		$groups			= $groupsModel->getGroups( $my->id , $sorted );
		$pagination		= $groupsModel->getPagination(count($groups));

		require_once( JPATH_COMPONENT . DS . 'libraries' . DS . 'activities.php');
		$act			= new CActivityStream();

 		// Attach additional properties that the group might have
 		if( $groups )
 		{
	 		foreach( $groups as $group )
	 		{
	 			$group->thumb			= $groupsModel->getThumbAvatar( $group->id , $group->thumb );
	 			//$group->count			= $groupsModel->getMembersCount( $group->id );

	 			//@todo: make number of activities configurable?
	 			// ( $actor, $target, $date = null, $maxEntry=20 , $type = '')
	 			#$group->activity		= $act->getHTML( $group->id , '' , null , 2 , 'groups' );
			}
		}

		// Get the template for the group lists
		$groupsHTML	= $this->_getGroupsHTML( $groups );

		$sortItems =  array(
				'latest' 		=> JText::_('CC GROUP SORT LATEST') ,
				'alphabetical'	=> JText::_('CC SORT ALPHABETICAL'),
				'mostdiscussed'	=> JText::_('CC GROUP SORT MOST DISCUSSED'),
				'mostwall'		=> JText::_('CC GROUP SORT MOST WALL POST'),
 				'mostmembers'	=> JText::_('CC GROUP SORT MOST MEMBERS'),
 				'mostactive'	=> JText::_('CC GROUP SORT MOST ACTIVE') );
		$tmpl			= new CTemplate();
		$tmpl->set( 'groupsHTML'	, $groupsHTML );
        $tmpl->set( 'pagination'	, $pagination );
        $tmpl->set( 'my'			, $my );
        $tmpl->set( 'sortings'		, CFilterBar::getHTML( CRoute::getURI(), $sortItems, 'latest') );

        //echo $tmpl->fetch('groups.mygroups');
        echo $tmpl->fetch('groups.mygroups');
	}

	function viewbulletin( )
	{
		$document		=& JFactory::getDocument();
		
		// Load necessary libraries
		CFactory::load( 'models' , 	'bulletins' );
		CFactory::load( 'libraries' , 'apps' );
		$groupsModel	=& CFactory::getModel( 'groups' );
		$bulletin		=& JTable::getInstance( 'Bulletin' , 'CTable' );
		$group			=& JTable::getInstance( 'Group' , 'CTable' );
		$my				= CFactory::getUser();
		$bulletinId		= JRequest::getVar( 'bulletinid' , '' , 'GET' );
		$bulletin->load( $bulletinId );
		$group->load( $bulletin->groupid );

		// @rule: Test if the group is unpublished, don't display it at all.
		if( !$group->published )
		{
			echo JText::_('CC GROUP UNPUBLISHED');
			return;
		}
		
		CFactory::load( 'helpers' , 'owner' );
		
		if( $group->approvals == 1 && !($group->isMember($my->id) ) && !isCommunityAdmin() )
		{
			echo JText::_('CC PRIVATE GROUP NOTICE');
			return;
		}
		
		$document->setTitle( $bulletin->title );

		CFactory::load( 'helpers' , 'owner' );
		
		if( $groupsModel->isAdmin( $my->id , $group->id )  || isCommunityAdmin() )
		{
			$this->addSubmenuItem( '' , JText::_('CC DELETE') , "joms.groups.removeBulletin('" . JText::_('CC DELETE') . "','" . $bulletin->groupid . "','" . $bulletin->id . "');" , true );
			$this->addSubmenuItem( '' , JText::_('CC EDIT') , "joms.groups.editBulletin();" , true );
		}
		$this->showSubMenu();

		$config		=& CFactory::getConfig();

		//$editor		=& JFactory::getEditor();
		jimport( 'joomla.html.editor' );
		$editor		= new JEditor( $config->get('htmleditor' , 'none') );
		
		$appsLib	=& CAppPlugins::getInstance();
		$appsLib->loadApplications();

		$args[]		=& $bulletin;

		// Format the bulletins
		$appsLib->triggerEvent( 'onBulletinDisplay',  $args );
		CFactory::load( 'libraries' , 'bookmarks' );
		$bookmarks		= new CBookmarks(CRoute::getExternalURL( 'index.php?option=com_community&view=groups&task=viewbulletin&groupid=' . $group->id . '&bulletinid=' . $bulletin->id));
		$bookmarksHTML	= $bookmarks->getHTML();
		
        $tmpl			= new CTemplate();
        $tmpl->set( 'bookmarksHTML' , $bookmarksHTML );
        $tmpl->set( 'bulletin' , $bulletin );
        $tmpl->set( 'editor'	, $editor );
        $tmpl->set( 'config'	, $config );
        echo $tmpl->fetch( 'groups.viewbulletin' );

	}

	/**
	 * Display a list of bulletins from the specific group
	 **/
	function viewbulletins()
	{
		$document	=& JFactory::getDocument();

		// Load necessary files
		CFactory::load( 'models' , 'groups' );
		CFactory::load( 'helpers' , 'owner' );

		$id			= JRequest::getInt( 'groupid' , '' , 'GET' );
		$my			= CFactory::getUser();
		
		// Load the group
		$group		=& JTable::getInstance( 'Group' , 'CTable' );
		$group->load( $id );

		if( $group->id == 0 )
		{
			echo JText::_('CC INVALID GROUP ID');
			return;
		}
		
		//display notice if the user is not a member of the group
		if( $group->approvals == 1 && !($group->isMember($my->id) ) && !isCommunityAdmin() )
		{
			echo JText::_('CC PRIVATE GROUP NOTICE');
			return;
		}
		
		// Set page title
		$document->setTitle( JText::sprintf('CC VIEW ALL BULLETINS TITLE' , $group->name ) );

		// Load submenu
		$this->showSubMenu();

		$model			=& CFactory::getModel( 'bulletins');
		$bulletins		= $model->getBulletins( $group->id );

		// Set feed url
		$feedLink = CRoute::_('index.php?option=com_community&view=groups&task=viewbulletins&groupid=' . $group->id . '&format=feed');
		$feed = '<link rel="alternate" type="application/rss+xml" title="' . JText::_('CC SUBSCRIBE TO BULLETIN FEEDS') . '" href="'.$feedLink.'"/>';
		$document->addCustomTag( $feed );

		// Get the creator of the bulletins
		for( $i = 0; $i < count( $bulletins ); $i++ )
		{
			$row			=& $bulletins[ $i ];

			$row->creator	= CFactory::getUser( $row->created_by );
		}

		// Process bulletins HTML output
		$tmpl		= new CTemplate();
		$tmpl->set( 'bulletins'	, $bulletins );
		$tmpl->set( 'groupId'		, $group->id );
		$bulletinsHTML	= $tmpl->fetch( 'groups.bulletinlist' );
		unset( $tmpl );

		$tmpl			= new CTemplate();
		$tmpl->set( 'group'			, $group );
		$tmpl->set( 'bulletinsHTML'	, $bulletinsHTML );
		$tmpl->set( 'pagination'	, $model->getPagination() );
		echo $tmpl->fetch( 'groups.viewbulletins' );
	}

	/**
	 * View method to display members of the groups
	 *
	 * @access	public
	 * @param	string 	Group Id
	 * @returns object  An object of the specific group
	 */
	function viewmembers( $data )
	{
		$mainframe =& JFactory::getApplication();

		$groupsModel	=& CFactory::getModel( 'groups' );
		$friendsModel	=& CFactory::getModel( 'friends' );
		$userModel		=& CFactory::getModel('user');
		$my				= CFactory::getUser();
		$config			=& CFactory::getConfig();
		$type			= JRequest::getVar( 'approve' , '' , 'GET' );

		$group			=& JTable::getInstance( 'Group' , 'CTable' );
		

		if(!$group->load( $data->id ))
		{
			echo JText::_('CC GROUP NOT FOUND');
			return;
		}
		
		$document =& JFactory::getDocument();
        $document->setTitle(JText::sprintf("CC GROUP MEMBERS TITLE" , $group->name ));

		$this->addPathway(JText::_('CC GROUPS'), CRoute::_('index.php?option=com_community&view=groups'));
		$this->addPathway( $group->name , CRoute::_('index.php?option=com_community&view=groups&task=viewgroup&groupid='.$group->id));
		$this->addPathway( JText::sprintf("CC GROUP MEMBERS TITLE" , $group->name ), '');
		
		CFactory::load('helpers' , 'owner' );
		$isSuperAdmin	= isCommunityAdmin();
		$isAdmin		= $groupsModel->isAdmin( $my->id , $group->id );		
		$isMember		= $group->isMember( $my->id );
		$isMine			= ($my->id == $group->ownerid);
		if( $group->approvals == '1' && !$isMine && !$isMember && !$isSuperAdmin )
		{
			$this->addWarning( JText::_( 'CC PRIVATE GROUP NOTICE' ) );
			return;
		}
		
		if( !empty( $type ) && ( $type == '1' ) )
		{
			// Test if browser is really the group admin
			$members	= $groupsModel->getMembers( $data->id , 0 , false );
		}
		else
		{
			$members		= $groupsModel->getMembers( $data->id );
		}
		$this->showSubmenu();

		// Attach avatar of the member
		$membersList = array();
		foreach($members as $member)
		{
			$user				= CFactory::getUser( $member->id );

			$user->friendsCount	= $user->getFriendCount();
			$user->approved		= $member->approved;
			$user->isMe			= ( $my->id == $member->id ) ? true : false;
			$user->isAdmin		= $groupsModel->isAdmin( $user->id , $group->id ); 
			$membersList[] 		= $user;
		}
		$pagination		= $groupsModel->getPagination();

        $tmpl			= new CTemplate();
		$tmpl->set( 'members'	, $membersList );
		$tmpl->set( 'type'		, $type );
		$tmpl->set( 'isMine'	, $groupsModel->isCreator($my->id, $group->id));
		$tmpl->set( 'isAdmin'	, $isAdmin );
		$tmpl->set( 'isSuperAdmin' , $isSuperAdmin );
		$tmpl->set( 'pagination', $pagination );
		$tmpl->set( 'groupid'	, $group->id );
		$tmpl->set( 'my'		, $my );
		$tmpl->set( 'config'	, $config );
        echo $tmpl->fetch( 'groups.viewmembers' );
	}

	/**
	 * View method to display discussions from a group
	 *
	 * @access	public
	 */
	function viewdiscussions()
	{
		$document	=& JFactory::getDocument();

		$id			= JRequest::getInt( 'groupid' , '' , 'GET' );
		$my			= CFactory::getUser();

		// Load necessary models, libraries & helpers
		CFactory::load( 'models' , 'groups' );
		CFactory::load( 'helpers' , 'owner' );
		$model		=& CFactory::getModel( 'discussions' );

		// Load the group
		$group		=& JTable::getInstance( 'Group' , 'CTable' );
		$group->load( $id );
		$this->_addGroupInPathway( $group->id );		
		$this->addPathway( JText::_('CC DISCUSSIONS') );
		$params		= $group->getParams();
		
		//check if group is valid
		if( $group->id == 0 )
		{
			echo JText::_('CC INVALID GROUP ID');
			return;
		}
		
		//display notice if the user is not a member of the group
		if( $group->approvals == 1 && !($group->isMember($my->id) ) && !isCommunityAdmin() )
		{
			echo JText::_('CC PRIVATE GROUP NOTICE');
			return;
		}
		
		// Set page title
		$document->setTitle( JText::sprintf('CC VIEW ALL DISCUSSIONS TITLE' , $group->name ) );

		$feedLink = CRoute::_('index.php?option=com_community&view=groups&task=viewdiscussions&groupid=' . $group->id . '&format=feed');
		$feed = '<link rel="alternate" type="application/rss+xml" title="'. JText::_('CC SUBSCRIBE TO DISCUSSION FEEDS') .'" href="'.$feedLink.'"/>';
		$document->addCustomTag( $feed );

		// Load submenu
		$this->showSubMenu();
		
		$discussions	= $model->getDiscussionTopics( $group->id , 0 ,  $params->get('discussordering' , DISCUSSION_ORDER_BYLASTACTIVITY) );

		for( $i = 0; $i < count( $discussions ); $i++ )
		{
			$row		=& $discussions[$i];

			$row->user	= CFactory::getUser( $row->creator );
		}

		// Process discussions HTML output
		$tmpl		= new CTemplate();
		$tmpl->set( 'discussions'	, $discussions );
		$tmpl->set( 'groupId'		, $group->id );
		$discussionsHTML	= $tmpl->fetch( 'groups.discussionlist' );
		unset( $tmpl );

		$tmpl			= new CTemplate();
		$tmpl->set( 'group'				, $group );
		$tmpl->set( 'discussions'		, $discussions );
		$tmpl->set( 'discussionsHTML'	, $discussionsHTML );
		$tmpl->set( 'pagination'		, $model->getPagination() );
		echo $tmpl->fetch( 'groups.viewdiscussions' );
	}

	/**
	 * View method to display specific discussion from a group
	 *
	 * @access	public
	 * @param	Object	Data object passed from controller
	 */
	function viewdiscussion( )
	{
		$mainframe	=& JFactory::getApplication();
		$document	=& JFactory::getDocument();

		// Load window library
		CFactory::load( 'libraries' , 'window' );
		
		// Load necessary window css / javascript headers.
		CWindow::load();

		// Get necessary variables
		CFactory::load( 'models' , 'groups' );
		CFactory::load( 'models' , 'discussions' );
		$my				= CFactory::getUser();
		$groupId		= JRequest::getVar( 'groupid' , '' , 'GET' );
		$topicId		= JRequest::getVar( 'topicid' , '' , 'GET' );

		// Load necessary library and objects
		$groupModel		=& CFactory::getModel( 'groups' );
		$group			=& JTable::getInstance( 'Group' , 'CTable' );
		$discussion		=& JTable::getInstance( 'Discussion' , 'CTable' );
		$group->load( $groupId );
		$discussion->load( $topicId );

		// @rule: Test if the group is unpublished, don't display it at all.
		if( !$group->published )
		{
			echo JText::_('CC GROUP UNPUBLISHED');
			return;
		}

		CFactory::load( 'helpers' , 'owner' );
		if( $group->approvals == 1 && !($group->isMember($my->id) ) && !isCommunityAdmin() )
		{
			echo JText::_('CC PRIVATE GROUP NOTICE');
			return;
		}
		
		// Execute discussion onDisplay filter
		$appsLib	=& CAppPlugins::getInstance();
		$appsLib->loadApplications();
		$args = array();
		$args[]		=& $discussion;
		$appsLib->triggerEvent( 'onDiscussionDisplay',  $args );
		
		
		$creator		= CFactory::getUser( $discussion->creator );

		// Fromat the date accordingly.
		$discussion->created	= CGetDate( $discussion->created );

		// Set page title
		$document->setTitle( JText::sprintf( 'CC DISCUSSION VIEW TITLE' , $discussion->title ) );

		// Add pathways
		$this->_addGroupInPathway( $group->id );		
		$this->addPathway( JText::sprintf( 'CC DISCUSSION VIEW TITLE' , $discussion->title ) );

		CFactory::load( 'helpers' , 'owner' );
		
		$isGroupAdmin	= $groupModel->isAdmin( $my->id , $group->id );
		
		if( $isGroupAdmin || isCommunityAdmin() )
		{
			$title	= JText::_('CC DELETE DISCUSSION');
			//$deleteLink	= CRoute::_('index.php?option=com_community&view=groups&task=deletediscussion&groupid=' . $group->id . '&topicid=' . $discussion->id );
			$this->addSubmenuItem( '' , JText::_('CC DELETE DISCUSSION') , "joms.groups.removeTopic('" . $title . "','" . $group->id . "','" . $discussion->id . "');" , true );
		}
	
		
		$this->showSubmenu();

		CFactory::load( 'libraries' , 'wall' );
		$wallContent	= CWallLibrary::getWallContents( 'discussions' , $discussion->id , $isGroupAdmin , 10 , 0);

		$wallForm	='';
		$config		=& CFactory::getConfig();

		// Test if the current browser is a member of the group
		$isMember			= $group->isMember( $my->id );
		$waitingApproval	= false;

		// If I have tried to join this group, but not yet approved, display a notice
		if( $groupModel->isWaitingAuthorization( $my->id , $group->id ) )
		{
			$waitingApproval	= true;
		}

		// Only get the wall form if user is really allowed to see it.
		if( !$config->get('lockgroupwalls') || ($config->get('lockgroupwalls') && ($isMember) && !($waitingApproval) ) || isCommunityAdmin() )
		{
			$viewAllLink	= CRoute::_('index.php?option=com_community&view=groups&task=discussapp&topicid=' . $discussion->id . '&app=walls'); 
			$wallForm	= CWallLibrary::getWallInputForm( $discussion->id , 'groups,ajaxSaveDiscussionWall', 'groups,ajaxRemoveReply' , $viewAllLink );
		}

		$config		=& CFactory::getConfig();

		// Get creator link
		$creatorLink	= CRoute::_('index.php?option=com_community&view=profile&userid=' . $creator->id );
		
		// Get reporting html
		CFactory::load('libraries', 'reporting');
		$report		= new CReportingLibrary();
		$reportHTML	= $report->getReportingHTML( JText::_('CC REPORT DISCUSSION') , 'groups,reportDiscussion' , array( $discussion->id ) );
		CFactory::load( 'libraries' , 'bookmarks' );
		$bookmarks		= new CBookmarks(CRoute::getExternalURL( 'index.php?option=com_community&view=groups&task=viewdiscussion&groupid=' . $group->id . '&topicid=' . $discussion->id));
		$bookmarksHTML	= $bookmarks->getHTML();

		$tmpl	= new CTemplate();
		$tmpl->set( 'bookmarksHTML'	, $bookmarksHTML );
		$tmpl->set( 'discussion' 	, $discussion );
		$tmpl->set( 'creator'		, $creator );
		$tmpl->set( 'wallContent'	, $wallContent );
		$tmpl->set( 'wallForm'		, $wallForm );
		$tmpl->set( 'creatorLink'	, $creatorLink );
		$tmpl->set( 'reportHTML'	, $reportHTML );
 		echo $tmpl->fetch( 'groups.viewdiscussion' );
	}

	/**
	 * View method to display new discussion form
	 *
	 * @access	public
	 * @param	Object	Data object passed from controller
	 */
	function adddiscussion( $data )
	{
		$document =& JFactory::getDocument();
        $document->setTitle( JText::_('CC ADD DISCUSSION') );

		$this->_addGroupInPathway( $data->id );		
		$this->addPathway( JText::_('CC ADD DISCUSSION') );
		
		$this->showSubmenu();

		jimport( 'joomla.html.editor' );
		$config			=& CFactory::getConfig();
		$editor			= new JEditor( $config->get('htmleditor' , 'none') );
		$groupsModel	=& CFactory::getModel( 'groups' );
		$group			=& JTable::getInstance( 'Group' , 'CTable' );
		$group->load( $data->id );

		$tmpl			= new CTemplate();
		$tmpl->set( 'config'	, $config );
        $tmpl->set( 'editor'	, $editor );
		$tmpl->set( 'group'		, $group );

		echo $tmpl->fetch( 'groups.adddiscussion' );
	}

	/**
	 * View method to search groups
	 *
	 * @access	public
	 *
	 * @returns object  An object of the specific group
	 */
	function search()
	{
		// Get the document object and set the necessary properties of the document
		$document	=& JFactory::getDocument();
        $document->setTitle( JText::_('CC SEARCH TITLE') );

		$this->addPathway(JText::_('CC GROUPS'), CRoute::_('index.php?option=com_community&view=groups'));
		$this->addPathway( JText::_("CC SEARCH"), '');
		
		// Display the submenu
		$this->showSubmenu();
		$search		= JRequest::getVar( 'search' , '' , 'POST' );
		$groups		= '';
		$posted		= false;
		$count		= 0;

		// Test if there are any post requests made
		if( JRequest::getMethod() == 'POST' && !empty( $search ) )
		{
			$posted	= true;
			$model	=& CFactory::getModel( 'groups' );

			$groups	= $model->getAllGroups( null , null , $search );
			$count	= count( $groups );
		}

		// Get the template for the group lists
		$groupsHTML	= $this->_getGroupsHTML( $groups );

		$tmpl		= new CTemplate();
		$tmpl->set( 'posted'		, $posted );
		$tmpl->set( 'groupsCount'	, $count );
		$tmpl->set( 'groupsHTML'	, $groupsHTML );
		$tmpl->set( 'search'		, $search );

		echo $tmpl->fetch( 'groups.search' );
	}

	/**
	 * Method to display add new bulletin form
	 *
	 * @param	$title	The title of the bulletin if the adding failed
	 * @param	$message	The message of the bulletin if adding failed
	 **/
	function addNews( $bulletin )
	{
		// Get the document object and set the necessary properties of the document
		$document	=& JFactory::getDocument();
        $document->setTitle( JText::_('CC ADD NEWS TITLE') );
        $this->showSubmenu();

		$config		=& CFactory::getConfig();
		$groupId	= JRequest::getVar( 'groupid' , '' , 'GET' );

		jimport( 'joomla.html.editor' );
		$editor		= new JEditor( $config->get('htmleditor' , 'none') );
		$title		= ( $bulletin ) ? $bulletin->title : '';
		$message	= ( $bulletin ) ? $bulletin->message : '';

		$tmpl		= new CTemplate();
		$tmpl->set( 'config'	, $config );
		$tmpl->set( 'title'		, $title );
		$tmpl->set( 'message'	, $message );
        $tmpl->set( 'groupid' 	, $groupId );
        $tmpl->set( 'editor'	, $editor );
        echo $tmpl->fetch( 'groups.addnews' );
	}
	
	function _getGroupsHTML( $groups )
	{	
		$tmpl	= new CTemplate();
		CFactory::load( 'helpers' , 'owner' );

		CFactory::load( 'libraries' , 'featured' );
		$featured	= new CFeatured( FEATURED_GROUPS );
		$featuredList	= $featured->getItemIds();

		$task			= JRequest::getVar( 'task' , '' , 'GET' );
		$showFeatured	= (empty($task) ) ? true : false;
		
		$tmpl->set( 'showFeatured'		, $showFeatured );
		$tmpl->set( 'featuredList'		, $featuredList );
		$tmpl->set( 'isCommunityAdmin'	, isCommunityAdmin() );
		$tmpl->set( 'groups'			, $groups );
		$groupsHTML	= $tmpl->fetch( 'groups.list' );
		unset( $tmpl );
		
		return $groupsHTML;
	}
}
