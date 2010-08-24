<?php
/**
 * @copyright (C) 2008 by Slashes & Dots Sdn Bhd - All rights reserved!
 * @license http://www.jomsocial.com Copyrighted Commercial Software
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

class CommunityViewPhotos extends CommunityView
{
	function _addSubmenu()
	{
		$my			= CFactory::getUser();
		$task		= JRequest::getVar( 'task' , '' , 'GET' );
		$albumId	= JRequest::getVar('albumid' , '' , 'GET');
		$groupId	= JRequest::getVar('groupid' , '' , 'GET');
		$userId		= JRequest::getVar( 'userid' , '' , 'GET' );
		if(!empty($albumId))
		{
			$albumId	= '&albumid=' . $albumId;
		}

		if( !empty($groupId) )
		{
			$this->addSubmenuItem('index.php?option=com_community&view=groups&task=viewgroup&groupid=' . $groupId , JText::_('CC BACK TO GROUP'));
		}
		
		if( ($task == 'singleupload' || $task == 'uploader' || $task == 'photo') && !empty($albumId) )
		{
			if(!empty($groupId ) )
			{
				$this->addSubmenuItem('index.php?option=com_community&view=photos&groupid=' . $groupId . '&task=album' . $albumId , JText::_('CC BACK TO ALBUM'));
			}
			else
			{
				$this->addSubmenuItem('index.php?option=com_community&view=photos&userid=' . $userId . '&task=album' . $albumId , JText::_('CC BACK TO ALBUM'));
			}
		}
		

		if(empty($groupId))
		{
			$this->addSubmenuItem('index.php?option=com_community&view=photos', JText::_('CC ALL PHOTOS'));
		}
		
		if( $my->id != 0 && empty($groupId) )
		{
			$this->addSubmenuItem('index.php?option=com_community&view=photos&task=myphotos&userid=' . $my->id, JText::_('CC MY PHOTOS'));
		}
	}

	function _flashuploader()
	{
		$groupId	= JRequest::getVar( 'groupid' , '' , 'REQUEST' );
		$model		=& CFactory::getModel( 'photos' );

		// Since upload will always be the browser's photos, use the browsers id
		$my			= CFactory::getUser();

		// Maintenance mode, clear out tokens that are older than 1 hours
		$model->cleanUpTokens();
		$token		= $model->getUserUploadToken( $my->id );

		// We need to generate our own session management since there
		// are some bridges causes the flash browser to not really work.
		if( !$token && $my->id != 0 )
		{
			// Get the current browsers session object.
			$mySession	=& JFactory::getSession();

			// Generate a session handler for this user.
			$myToken	= $mySession->getToken( true );
			
			$date		=& JFactory::getDate();
			$token				= new stdClass();
			$token->userid		= $my->id;
			$token->datetime	= $date->toMySQL();
			$token->token		= $myToken;
			
			$model->addUserUploadSession( $token );
		}
		
		$model			=& CFactory::getModel( 'photos' );
		$config			=& CFactory::getConfig();
		$albumId		= JRequest::getVar( 'albumid' , '' , 'REQUEST' );
		
		if(!empty($groupId) )
		{
			CFactory::load( 'models' , 'groups' );
			$group				=& JTable::getInstance( 'Group' , 'CTable' );
			$group->load( $groupId );
			$albums				= $model->getGroupAlbums( $groupId , false , false , '', ( $group->isAdmin( $my->id )  || isCommunityAdmin() )  , $my->id );
			$createAlbumLink	= CRoute::_('index.php?option=com_community&view=photos&task=newalbum&groupid=' . $groupId );
			$photoUploaded		= $model->getPhotosCount( $groupId , PHOTOS_GROUP_TYPE );
			$photoUploadLimit	= $config->get('groupphotouploadlimit');
			$viewAlbumLink		= CRoute::_('index.php?option=com_community&view=photos&task=album&groupid=' . $groupId . '&albumid=' . $albumId);
		}
		else
		{
			$albums				= $model->getAlbums( $my->id );
			$createAlbumLink	= CRoute::_('index.php?option=com_community&view=photos&task=newalbum&userid=' . $my->id );
			$photoUploaded		= $model->getPhotosCount( $my->id , PHOTOS_USER_TYPE );
			$photoUploadLimit	= $config->get('photouploadlimit');
			$viewAlbumLink		= CRoute::_('index.php?option=com_community&view=photos&task=album&userid=' . $my->id . '&albumid=' . $albumId);
		}

		$tmpl				= new CTemplate();

		$tmpl->set('token'			, $token );
		$tmpl->set('createAlbumLink', $createAlbumLink );
		$tmpl->set('albums'			, $albums );
		$tmpl->set('session' 		, JFactory::getSession());
		$tmpl->set('albumId' 		, $albumId);
		$tmpl->set('uploadLimit'	, $config->get('maxuploadsize') );
		$tmpl->set('photoUploaded'	, $photoUploaded );
		$tmpl->set('viewAlbumLink'	, $viewAlbumLink );
		$tmpl->set('photoUploadLimit' , $photoUploadLimit );
		echo $tmpl->fetch( 'photos.flashuploader' );
	}
	
	/**
	 * Display the multi upload form
	 **/
	function _htmluploader()
	{	
		$groupId	= JRequest::getVar( 'groupid' , '' , 'REQUEST' );
		$model		=& CFactory::getModel( 'photos' );
		$my			= CFactory::getUser();
		$config		=& CFactory::getConfig();
		$albumId	= JRequest::getVar( 'albumid' , '' , 'REQUEST' );
		
		if(!empty($groupId) )
		{
			CFactory::load( 'models' , 'groups' );
			
			$group				=& JTable::getInstance( 'Group' , 'CTable' );
			$group->load( $groupId );
			$albums				= $model->getGroupAlbums( $groupId , false , false , '', ( $group->isAdmin( $my->id )  || isCommunityAdmin() ) , $my->id );
			$createAlbumLink	= CRoute::_('index.php?option=com_community&view=photos&task=newalbum&groupid=' . $groupId );
			$photoUploaded		= $model->getPhotosCount( $groupId , PHOTOS_GROUP_TYPE );
			$photoUploadLimit	= $config->get('groupphotouploadlimit');
			$viewAlbumLink		= CRoute::_('index.php?option=com_community&view=photos&task=album&groupid=' . $groupId . '&albumid=' . $albumId);
		}
		else
		{
			$albums				= $model->getAlbums( $my->id );
			$createAlbumLink	= CRoute::_('index.php?option=com_community&view=photos&task=newalbum&userid=' . $my->id );
			$photoUploaded		= $model->getPhotosCount( $my->id , PHOTOS_USER_TYPE );
			$photoUploadLimit	= $config->get('photouploadlimit');
			$viewAlbumLink		= CRoute::_('index.php?option=com_community&view=photos&task=album&userid=' . $my->id . '&albumid=' . $albumId);
		}

		// Attach the photo upload css.
		CTemplate::addStylesheet( 'photouploader' );
		
		$tmpl			= new CTemplate();

		$tmpl->set('createAlbumLink', $createAlbumLink );
		$tmpl->set('albums'			, $albums );
		$tmpl->set( 'my'			, CFactory::getUser() );
		$tmpl->set('albumId' 		, $albumId);
		$tmpl->set('photoUploaded'	, $photoUploaded );
		$tmpl->set('viewAlbumLink'	, $viewAlbumLink );
		$tmpl->set('photoUploadLimit' , $photoUploadLimit );
		$tmpl->set('uploadLimit'	, $config->get('maxuploadsize') );

		echo $tmpl->fetch( 'photos.htmluploader' );
	}
	
	function showSubmenu()
	{
		$this->_addSubmenu();
		parent::showSubmenu();
	}

	/**
	 * Default view method
	 * Display all photos in the whole system
	 **/
	function display()
	{
		$document	=& JFactory::getDocument();
		$my			= CFactory::getUser();
		$document->setTitle( JText::_('CC ALL PHOTOS TITLE') );
		$this->addPathway( JText::_('CC ALL PHOTOS TITLE') );
		$mainframe	=& JFactory::getApplication();
		// Load tooltips lib
		CFactory::load( 'libraries' , 'tooltip' );
		CFactory::load( 'models', 'groups' );
		
 		$model		=& CFactory::getModel( 'photos' );
 		$groupId	= JRequest::getVar( 'groupid' , '' , 'REQUEST' );
		$type		= PHOTOS_USER_TYPE;

		if($my->id != 0)
		{
			if(!empty($groupId) )
			{
				CFactory::load( 'helpers' , 'group' );			
				$allowManagePhotos = cAllowManagePhoto($groupId);	
				if($allowManagePhotos)
				{
					$this->addSubmenuItem('index.php?option=com_community&view=photos&task=uploader&groupid=' . $groupId , JText::_('CC UPLOAD PHOTOS'), '', true);
					$this->addSubmenuItem('index.php?option=com_community&view=photos&task=newalbum&groupid=' . $groupId, JText::_('CC ADD ALBUM') , '' , true );
				}
			}
			else
			{
				$this->addSubmenuItem('index.php?option=com_community&view=photos&task=uploader&userid=' . $my->id , JText::_('CC UPLOAD PHOTOS'), '', true);
				$this->addSubmenuItem('index.php?option=com_community&view=photos&task=newalbum&userid=' . $my->id, JText::_('CC ADD ALBUM') , '' , true );
			}
		}
		$this->showSubmenu();

 		if( !empty($groupId) )
 		{
 			$group		=& JTable::getInstance( 'Group' , 'CTable' );
 			$group->load( $groupId );
			//@rule: Do not allow non members to view albums for private group
			if( $group->approvals == COMMUNITY_PRIVATE_GROUP && !$group->isMember( $my->id ) && !$group->isAdmin( $my->id ) )
			{
				echo JText::_('CC ACCESS FORBIDDEN');
				return;			
			}
 			$type		= PHOTOS_GROUP_TYPE;
 			$albumsData	= $model->getGroupAlbums( $groupId );
		}
		else
		{
			// Get albums
			$albumsData		= $model->getAllAlbums( $my->id );
			
			/* begin: COMMUNITY_FREE_VERSION */
			if( !COMMUNITY_FREE_VERSION ) {
				// Set feed url
				$feedLink = CRoute::_('index.php?option=com_community&view=photos&format=feed');
				$feed = '<link rel="alternate" type="application/rss+xml" href="'.$feedLink.'"/>';
				$mainframe->addCustomHeadTag( $feed );
			}
			/* end: COMMUNITY_FREE_VERSION */
		}

		CFactory::load( 'libraries' , 'featured' );
		$featured		= new CFeatured( FEATURED_ALBUMS );
		$featuredAlbums	= $featured->getItemIds();
		$featuredList	= array();
		
		/* begin: COMMUNITY_FREE_VERSION */
		if( !COMMUNITY_FREE_VERSION ) {
			foreach($featuredAlbums as $album )
			{
				$table			=& JTable::getInstance( 'Album' , 'CTable' );
				$table->load($album);
	
				$table->thumbnail	= $table->getCoverThumbPath();
				$table->thumbnail	= ($table->thumbnail) ? JURI::root() . $table->thumbnail : JURI::root() . 'components/com_community/assets/album_thumb.jpg';
				$featuredList[]	= $table;
			}
		}
		/* end: COMMUNITY_FREE_VERSION */
		
		$tmpl	= new CTemplate();
		CFactory::load( 'helpers' , 'owner' );

		$tmpl->set( 'isCommunityAdmin' , isCommunityAdmin() );
		$tmpl->set( 'featuredList'	, $featuredList );
		$tmpl->set( 'albumsHTML'	, $this->_getAllAlbumsHTML($albumsData , $type ) );
		$tmpl->set( 'pagination'	, $model->getPagination() );

		echo $tmpl->fetch( 'photos.index' );
	}

	function myphotos()
	{
		$my			= CFactory::getUser();		
		$document	=& JFactory::getDocument();
		$this->addPathway( JText::_('CC MY PHOTOS TITLE') );
        CFactory::load('helpers' , 'owner' );
        $userid		= JRequest::getVar( 'userid' , '' );
		$user		= CFactory::getUser($userid);
		
        $blocked	= $user->isBlocked();
		CFactory::load('libraries','privacy');
		if( !CPrivacy::isAccessAllowed($my->id, $user->id, 'user', 'privacyPhotoView') )
		{
			echo JText::_('CC ACCESS FORBIDDEN');
			return;
		}
		
		if( $blocked && !isCommunityAdmin() )
		{
			$tmpl	= new CTemplate();
			echo $tmpl->fetch('profile.blocked');
			return;
		}
				
		if($my->id == $user->id)
			$document->setTitle( JText::_('CC MY PHOTOS TITLE') );
		else
			$document->setTitle( JText::sprintf('CC USERS PHOTO TITLE', $user->getDisplayName()) );
		
		
		// Show the mini header when viewing other's photos
		if($my->id != $user->id)
			$this->attachMiniHeaderUser($user->id);
		
		
		if($my->id != 0)
		{
			$this->addSubmenuItem('index.php?option=com_community&view=photos&task=uploader&userid=' . $user->id , JText::_('CC UPLOAD PHOTOS'), '', true);
			$this->addSubmenuItem('index.php?option=com_community&view=photos&task=newalbum&userid=' . $user->id, JText::_('CC ADD ALBUM') , '' , true );
		}
		$this->showSubmenu();

 		$model	=& CFactory::getModel( 'photos' );

 		$albums		= $model->getAlbums( $user->id , true , true );
		
		// Load tooltips lib
		CFactory::load( 'libraries' , 'tooltip' );

		$tmpl	= new CTemplate();
		
		$tmpl->set( 'albumsHTML'	, $this->_getAlbumsHTML($albums) );
		$tmpl->set( 'pagination'	, $model->getPagination() );
		
		echo $tmpl->fetch( 'photos.myphotos' );
	}

	function _getAllAlbumsHTML( $albums , $type = PHOTOS_USER_TYPE )
	{
		$my			= CFactory::getUser();
		$groupId	= JRequest::getVar( 'groupid' , '' ,'REQUEST');

		$tmpl		= new CTemplate();

		CFactory::load( 'libraries' , 'activities' );
		CFactory::load( 'models' , 'groups' );
		CFactory::load( 'helpers' , 'owner' );
		
		for($i = 0; $i < count($albums); $i++)
		{
			$type	= $albums[$i]->groupid > 0 ? PHOTOS_GROUP_TYPE : PHOTOS_USER_TYPE;
			
			$albums[$i]->user		= CFactory::getUser( $albums[$i]->creator );
			$albums[$i]->link 		= CRoute::_("index.php?option=com_community&view=photos&task=album&albumid={$albums[$i]->id}&userid={$albums[$i]->creator}");
			$albums[$i]->editLink 	= CRoute::_("index.php?option=com_community&view=photos&task=editAlbum&albumid={$albums[$i]->id}&userid={$albums[$i]->creator}");
			$albums[$i]->uploadLink = CRoute::_("index.php?option=com_community&view=photos&task=uploader&albumid={$albums[$i]->id}&userid={$albums[$i]->creator}");
			$albums[$i]->isOwner	= ($my->id == $albums[$i]->creator);

			if( $type == PHOTOS_GROUP_TYPE)
			{
				$group	=& JTable::getInstance( 'Group' , 'CTable' );
				$group->load($groupId);
				
				$albums[$i]->link 		= CRoute::_("index.php?option=com_community&view=photos&task=album&albumid={$albums[$i]->id}&groupid={$albums[$i]->groupid}");
				$albums[$i]->editLink	= CRoute::_("index.php?option=com_community&view=photos&task=editAlbum&albumid={$albums[$i]->id}&groupid={$albums[$i]->groupid}");
				$albums[$i]->uploadLink = CRoute::_("index.php?option=com_community&view=photos&task=uploader&albumid={$albums[$i]->id}&groupid={$albums[$i]->groupid}");

				
				$params				= $group->getParams();
				$photopermission	= $params->get('photopermission', GROUP_PHOTO_PERMISSION_ADMINS);
			
				if( $photopermission == GROUP_PHOTO_PERMISSION_MEMBERS && $group->isMember($my->id) )
				{
					$albums[$i]->isOwner	= ($my->id == $albums[$i]->creator || $group->isAdmin($my->id ));
				}
				else if( ($photopermission == GROUP_PHOTO_PERMISSION_ADMINS && $group->isAdmin($my->id ) ) || isCommunityAdmin() )
				{
					$albums[$i]->isOwner	= true;
				}
				else
				{
					$albums[$i]->isOwner	= false;
				}
			}

			// If new albums that has just been created and
			// does not contain any images, the lastupdated will always be 0000-00-00 00:00:00:00
			// Try to use the albums creation date instead.
			if( $albums[$i]->lastupdated == '0000-00-00 00:00:00' || $albums[$i]->lastupdated == '')
			{
				$albums[$i]->lastupdated	= $albums[$i]->created;

				if( $albums[$i]->lastupdated == '' || $albums[$i]->lastupdated == '0000-00-00 00:00:00')
				{
					$albums[$i]->lastupdated	= JText::_( 'CC NO LAST ACTIVITY' );
				}
				else
				{
					$lastUpdated	= new JDate( $albums[$i]->lastupdated );
					$albums[$i]->lastupdated	= CActivityStream::_createdLapse( $lastUpdated );
				}
			}
			else
			{
				$lastUpdated	= new JDate( $albums[$i]->lastupdated );
				$albums[$i]->lastupdated	= CActivityStream::_createdLapse( $lastUpdated );
			}

		}

		CFactory::load( 'helpers' , 'owner' );

		CFactory::load( 'libraries' , 'featured' );
		$featured	= new CFeatured( FEATURED_ALBUMS );
		$featuredList	= $featured->getItemIds();

		$task			= JRequest::getVar( 'task' , '' , 'GET' );
		$showFeatured	= (empty($task) ) ? true : false;

		$createLink		= CRoute::_('index.php?option=com_community&view=photos&task=newalbum&userid=' . $my->id );

		if( $type == PHOTOS_GROUP_TYPE )
		{
			$createLink	= CRoute::_('index.php?option=com_community&view=photos&task=newalbum&groupid=' . $groupId );
			
			CFactory::load( 'helpers' , 'group' );
			
			$isOwner	= cAllowManagePhoto( $groupId );
		}
		else
		{
			$userId		= JRequest::getVar( 'userid' , '' , 'REQUEST' );
			$user		= CFactory::getUser( $userId );
			
			$isOwner		= ($my->id == $user->id) ? true : false;
		}
		$task	= JRequest::getCmd( 'task' , '');
		$tmpl->set( 'isOwner'		, $isOwner );
		$tmpl->set( 'type'			, $type );
		$tmpl->set( 'createLink'	, $createLink );
		$tmpl->set( 'currentTask'	, $task );
		$tmpl->set( 'showFeatured'		, $showFeatured );
		$tmpl->set( 'featuredList'		, $featuredList );
		$tmpl->set( 'isCommunityAdmin'	, isCommunityAdmin() );
		$tmpl->set( 'my'		, $my );
		$tmpl->set( 'albums' 	, $albums );
		$tmpl->set( 'isSuperAdmin'	, isCommunityAdmin());

		return $tmpl->fetch( 'albums.list' );
	}

	function _getAlbumsHTML( $albums , $type = PHOTOS_USER_TYPE )
	{
		$my			= CFactory::getUser();
		$groupId	= JRequest::getVar( 'groupid' , '' ,'REQUEST');

		$tmpl		= new CTemplate();

		CFactory::load( 'libraries' , 'activities' );
		CFactory::load( 'models' , 'groups' );
		CFactory::load( 'helpers' , 'owner' );
		
		for($i = 0; $i < count($albums); $i++)
		{
			$albums[$i]->user		= CFactory::getUser( $albums[$i]->creator );
			$albums[$i]->link 		= CRoute::_("index.php?option=com_community&view=photos&task=album&albumid={$albums[$i]->id}&userid={$albums[$i]->creator}");
			$albums[$i]->editLink 	= CRoute::_("index.php?option=com_community&view=photos&task=editAlbum&albumid={$albums[$i]->id}&userid={$albums[$i]->creator}");
			$albums[$i]->uploadLink = CRoute::_("index.php?option=com_community&view=photos&task=uploader&albumid={$albums[$i]->id}&userid={$albums[$i]->creator}");
			$albums[$i]->isOwner	= ($my->id == $albums[$i]->creator);

			if( $type == PHOTOS_GROUP_TYPE)
			{
				$group	=& JTable::getInstance( 'Group' , 'CTable' );
				$group->load($groupId);
				
				$albums[$i]->link 		= CRoute::_("index.php?option=com_community&view=photos&task=album&albumid={$albums[$i]->id}&groupid={$albums[$i]->groupid}");
				$albums[$i]->editLink	= CRoute::_("index.php?option=com_community&view=photos&task=editAlbum&albumid={$albums[$i]->id}&groupid={$albums[$i]->groupid}");
				$albums[$i]->uploadLink = CRoute::_("index.php?option=com_community&view=photos&task=uploader&albumid={$albums[$i]->id}&groupid={$albums[$i]->groupid}");

				
				$params				= $group->getParams();
				$photopermission	= $params->get('photopermission', GROUP_PHOTO_PERMISSION_ADMINS);
			
				if( $photopermission == GROUP_PHOTO_PERMISSION_MEMBERS && $group->isMember($my->id) )
				{
					$albums[$i]->isOwner	= ($my->id == $albums[$i]->creator);
				}
				else if( ($photopermission == GROUP_PHOTO_PERMISSION_ADMINS && $group->isAdmin($my->id ) ) || isCommunityAdmin() )
				{
					$albums[$i]->isOwner	= true;
				}
				else
				{
					$albums[$i]->isOwner	= false;
				}
			}

			// If new albums that has just been created and
			// does not contain any images, the lastupdated will always be 0000-00-00 00:00:00:00
			// Try to use the albums creation date instead.
			if( $albums[$i]->lastupdated == '0000-00-00 00:00:00' || $albums[$i]->lastupdated == '')
			{
				$albums[$i]->lastupdated	= $albums[$i]->created;

				if( $albums[$i]->lastupdated == '' || $albums[$i]->lastupdated == '0000-00-00 00:00:00')
				{
					$albums[$i]->lastupdated	= JText::_( 'CC NO LAST ACTIVITY' );
				}
				else
				{
					$lastUpdated	= new JDate( $albums[$i]->lastupdated );
					$albums[$i]->lastupdated	= CActivityStream::_createdLapse( $lastUpdated );
				}
			}
			else
			{
				$lastUpdated	= new JDate( $albums[$i]->lastupdated );
				$albums[$i]->lastupdated	= CActivityStream::_createdLapse( $lastUpdated );
			}

		}
		CFactory::load( 'helpers' , 'owner' );

		CFactory::load( 'libraries' , 'featured' );
		$featured	= new CFeatured( FEATURED_ALBUMS );
		$featuredList	= $featured->getItemIds();

		$task			= JRequest::getVar( 'task' , '' , 'GET' );
		$showFeatured	= (empty($task) ) ? true : false;

		$createLink		= CRoute::_('index.php?option=com_community&view=photos&task=newalbum&userid=' . $my->id );

		if( $type == PHOTOS_GROUP_TYPE )
		{
			$createLink	= CRoute::_('index.php?option=com_community&view=photos&task=newalbum&groupid=' . $groupId );
			
			CFactory::load( 'helpers' , 'group' );
			
			$isOwner	= cAllowManagePhoto( $groupId );
		}
		else
		{
			$userId		= JRequest::getVar( 'userid' , '' , 'REQUEST' );
			$user		= CFactory::getUser( $userId );
			
			$isOwner		= ($my->id == $user->id) ? true : false;
		}
		$task	= JRequest::getCmd( 'task' , '');
		$tmpl->set( 'isOwner'		, $isOwner );
		$tmpl->set( 'type'			, $type );
		$tmpl->set( 'createLink'	, $createLink );
		$tmpl->set( 'currentTask'	, $task );
		$tmpl->set( 'showFeatured'		, $showFeatured );
		$tmpl->set( 'featuredList'		, $featuredList );
		$tmpl->set( 'isCommunityAdmin'	, isCommunityAdmin() );
		$tmpl->set( 'my'		, $my );
		$tmpl->set( 'albums' 	, $albums );
		$tmpl->set( 'isSuperAdmin'	, isCommunityAdmin());

		return $tmpl->fetch( 'albums.list' );
	}
	
	/**
	 * Displays edit album form
	 **/
	function editAlbum()
	{
		$document	=& JFactory::getDocument();
		$config		=& CFactory::getConfig();

		
		// Load necessary libraries, models
		CFactory::load( 'models' , 'photos' );
		$album		=& JTable::getInstance( 'Album' , 'CTable' );
		$albumId	= JRequest::getVar( 'albumid' , '' , 'GET' );
		$type		= JRequest::getVar( 'groupid' , '' , 'REQUEST' );
		$type		= !empty($type) ? PHOTOS_GROUP_TYPE : PHOTOS_USER_TYPE;
		$album->load( $albumId );
		$this->addPathway( JText::sprintf('CC EDIT ALBUM TITLE', $album->name ) );
		$this->showSubmenu();
		
		if( $album->id == 0 )
		{
			echo JText::_('CC INVALID ALBUM');
			return;
		}

		$document->setTitle( JText::sprintf('CC EDIT ALBUM TITLE', $album->name ) );
        
		$js = JURI::root(). 'components/com_community/assets/validate-1.5';
		$js	.= ( $config->getBool('usepackedjavascript') ) ? '.pack.js' : '.js';        
        $document->addScript($js);


        $tmpl	= new CTemplate();
        $tmpl->set( 'album'	, $album );
		$tmpl->set('type' , $type );
        echo $tmpl->fetch( 'photos.editalbum' );
	}

	/**
	 * Display the new album form
	 **/
	function newalbum()
	{
		$config		=& CFactory::getConfig();	
		$document 	=& JFactory::getDocument();

		$document->setTitle( JText::_('CC CREATE NEW ALBUM TITLE') );
        $this->addPathway( JText::_('CC CREATE NEW ALBUM TITLE') );
        
		$js = JURI::root(). 'components/com_community/assets/validate-1.5';
		$js	.= ( $config->getBool('usepackedjavascript') ) ? '.pack.js' : '.js';                
        $document->addScript($js);
        
		$type	= JRequest::getVar( 'groupid' , '' , 'REQUEST' );
		$type	= !empty($type) ? PHOTOS_GROUP_TYPE : PHOTOS_USER_TYPE;
		
		// Load submenu
		$this->showSubmenu();
		
		$tmpl	= new CTemplate();
		$tmpl->set('type' , $type );
		
		echo $tmpl->fetch( 'photos.newalbum' );
	}

	function uploader()
	{
		$document =& JFactory::getDocument();
		$document->setTitle(JText::_('CC UPLOAD MULTIPLE PHOTOS TITLE'));
		$this->addPathway( JText::_('CC UPLOAD MULTIPLE PHOTOS TITLE') );
		$css		= rtrim( JURI::root() , '/' ) . '/components/com_community/assets/uploader/style.css';
		$document->addStyleSheet($css);
		$my			= CFactory::getUser();
		
		
		// Add create album link
		if($my->id != 0)
		{
			$this->addSubmenuItem('index.php?option=com_community&view=photos&task=uploader&userid=' . $my->id, JText::_('CC UPLOAD PHOTOS'), '', true);
			$this->addSubmenuItem('index.php?option=com_community&view=photos&task=newalbum&userid=' . $my->id, JText::_('CC ADD ALBUM') , '' , true );
		}
		
		// Display submenu on the page.
		$this->showSubmenu();
		
		// Add create album link
		$groupId	= JRequest::getVar( 'groupid' , '' , 'REQUEST' );
		$type		= PHOTOS_USER_TYPE;	

		// Get the configuration for uploader tool
		$config		=& CFactory::getConfig();
		$groupId	= JRequest::getVar( 'groupid' , '' , 'REQUEST' );

		CFactory::load( 'helpers' , 'limits' );

		if( empty($groupId) )
		{
			if( cExceededPhotoUploadLimit($my->id , PHOTOS_USER_TYPE ) )
			{
				$config			=& CFactory::getConfig();
				$photoLimit		= $config->get( 'photouploadlimit' );
				
				echo JText::sprintf('CC PHOTO UPLOAD LIMIT REACHED' , $photoLimit );
				return;
			}
		}
		else
		{
			if( cExceededPhotoUploadLimit($groupId , PHOTOS_GROUP_TYPE ) )
			{
				$config			=& CFactory::getConfig();
				$photoLimit		= $config->get( 'groupphotouploadlimit' );
				
				echo JText::sprintf('CC GROUP PHOTO UPLOAD LIMIT REACHED' , $photoLimit );
				return;
			}
		}

		$useFlash	= $config->get( 'flashuploader' );

		if( $useFlash )
		{
			echo $this->_flashuploader();
		}
		else
		{
			echo $this->_htmluploader();
		}
		
	}

	function _groupAlbum()
	{
		CFactory::load( 'models' , 'photos' );
		CFactory::load('helpers', 'friends');
		CFactory::load( 'models' , 'groups' );
		
		$mainframe	=& JFactory::getApplication();
		$document	=& JFactory::getDocument();
		$config		=& CFactory::getConfig();
		$my			= CFactory::getUser();
 		$model		=& CFactory::getModel('photos');
 		$groupModel	=& CFactory::getModel( 'groups' );
		$albumId	= JRequest::getVar('albumid' , '' , 'GET');
 		$defaultId	= JRequest::getVar('photo' , '' , 'GET');
		$groupId	= JRequest::getVar( 'groupid' , '' , 'REQUEST' );
		$group		=& JTable::getInstance( 'Group' , 'CTable' );
		$group->load( $groupId );
		
 		if( empty( $albumId ) )
 		{
 			echo JText::_('CC NO PROPER ALBUM ID');
 			return;
		}

		CFactory::load( 'helpers' , 'owner' );
		//@rule: Do not allow non members to view albums for private group
		if( $group->approvals == COMMUNITY_PRIVATE_GROUP && !$group->isMember( $my->id ) && !$group->isAdmin( $my->id ) && !isCommunityAdmin() )
		{			
			// Set document title
			$document->setTitle( JText::_('CC RESTRICTED ACCESS') );
			$mainframe->enqueueMessage(JText::_('CC RESTRICTED ACCESS', 'notice'));
			
			echo JText::_('CC ALBUM NEED GROUP MEMBER PERMISSION');			
			return;
		}

		$album		=& JTable::getInstance( 'Album' , 'CTable' );
		$album->load( $albumId );

		// Set document title
		$document->setTitle( JText::sprintf( 'CC USER PHOTOS TITLE' ,  $group->name) .' - '. $album->name);
		$this->setTitle( $album->name );

        $pathway 	=& $mainframe->getPathway();
		$pathway->addItem( $album->name, '' );
		
		CError::assert( $group , 'object' , 'istype' , __FILE__ , __LINE__ );
	
		// Get list of photos and set some limit to be displayed.
		// @todo: make limit configurable?
		$photos		= $model->getAllPhotos( $albumId, PHOTOS_GROUP_TYPE  , null , null , $config->get('photosordering') );
	
		// Need to append the absolute path for the captions
		for( $i = 0; $i < count( $photos ); $i++ )
		{
			$item =& JTable::getInstance( 'Photo' , 'CTable' );
			$item->bind($photos[$i]);
			$photos[$i] = $item;
			
			$photo	=& $photos[ $i ];
			$photo->link		= CRoute::_('index.php?option=com_community&view=photos&task=photo&groupid=' . $groupId . '&albumid=' . $photo->albumid) . '#photoid=' . $photo->id;
		}

		CFactory::load( 'helpers' , 'group' );					
		$allowManagePhotos = cAllowManagePhoto($groupId);

		if( $allowManagePhotos && $my->id != 0 )
		{
			$this->addSubmenuItem('index.php?option=com_community&view=photos&task=newalbum&groupid=' . $group->id, JText::_('CC ADD ALBUM') , '' , true );
			
			if( $my->id == $album->creator || $group->isAdmin($my->id) || isCommunityAdmin() )
			{
				$this->addSubmenuItem('index.php?option=com_community&view=photos&task=uploader&albumid=' . $album->id . '&groupid=' . $group->id , JText::_('CC UPLOAD PHOTOS'), '', true);
				$this->addSubmenuItem('index.php?option=com_community&view=photos&task=editAlbum&albumid=' . $album->id . '&groupid=' . $group->id , JText::_('CC EDIT ALBUM') , '' , true );
			}
		}
		$this->showSubmenu();
		$tmpl	= new CTemplate();
		CFactory::load( 'libraries' , 'bookmarks' );
		$bookmarks		= new CBookmarks(CRoute::getExternalURL( 'index.php?option=com_community&view=photos&task=album&albumid=' . $album->id . '&groupid=' . $group->id ));
		$bookmarksHTML	= $bookmarks->getHTML();

		$tmpl->set( 'bookmarksHTML'	, $bookmarksHTML );
		$tmpl->set( 'isOwner' 		, $group->isAdmin( $my->id ) );
		$tmpl->set( 'photos' 		, $photos );
		$tmpl->set( 'album'			, $album );

		echo $tmpl->fetch('photos.album');
	}
	
	function _userAlbum()
	{
		$mainframe =& JFactory::getApplication();
		$document =& JFactory::getDocument();

		// Get the configuration object.
		$config	=& CFactory::getConfig();

		// Get necessary properties and load the libraries
		CFactory::load( 'models' , 'photos' );
		CFactory::load('helpers', 'friends');
		CFactory::load('helpers', 'privacy');

		$my			= CFactory::getUser();
		$userid		= JRequest::getVar( 'userid' , '' );
		$user		= CFactory::getUser($userid);
		
		// Display breadcrumb regardless whether the user is blocked or not
        $pathway 	=& $mainframe->getPathway();
		$pathway->addItem($user->getDisplayName(), cUserLink($user->id) );
		

		if(!$user->block || isCommunityAdmin($my->id))
		{
	 		$model		=& CFactory::getModel('photos');
	 		$albumId	= JRequest::getVar('albumid' , '' , 'GET');
	 		$defaultId	= JRequest::getVar('photo' , '' , 'GET');

			// Show the mini header when viewing other's photos
			if( $my->id != $user->id )
			{
				$this->attachMiniHeaderUser($user->id);
			}

			// Load the album table
			$album		=& JTable::getInstance( 'Album' , 'CTable' );
			$album->load( $albumId );
			
			CFactory::load('helpers', 'owner');
			CFactory::load('libraries', 'privacy');
			
	 		if( empty( $albumId ) || ( $album->creator != $user->id && !isCommunityAdmin() ) )
	 		{
	 			echo JText::_('CC NO PROPER ALBUM ID');
	 			return;
			}
			
			// Set pathway
	        $pathway 	=& $mainframe->getPathway();
			$pathway->addItem( $album->name, '' );
			
			/* begin: COMMUNITY_FREE_VERSION */
			if( !COMMUNITY_FREE_VERSION ) {
				// Set feed url
				$feedLink = CRoute::_('index.php?option=com_community&view=photos&task=album&albumid='.$album->id.'&userid='.$album->creator.'&format=feed');
				$feed = '<link rel="alternate" type="application/rss+xml" href="'.$feedLink.'"/>';
				$mainframe->addCustomHeadTag( $feed );
			}
			/* end: COMMUNITY_FREE_VERSION */

			// Get list of photos and set some limit to be displayed.
			// @todo: make limit configurable?
			$photos		= $model->getAllPhotos( $albumId, PHOTOS_USER_TYPE , null , null , $config->get('photosordering') );
	
			// Need to append the absolute path for the captions
			for( $i = 0; $i < count( $photos ); $i++ )
			{
				$item =& JTable::getInstance( 'Photo' , 'CTable' );
				$item->bind($photos[$i]);
				$photos[$i] = $item;
				
				$photo	=& $photos[ $i ];
				$photo->link		= CRoute::_('index.php?option=com_community&view=photos&task=photo&userid=' . $user->id . '&albumid=' . $photo->albumid) . '#photoid=' . $photo->id;
			}
			
			// Set document title
			$document->setTitle( JText::sprintf( 'CC USER PHOTOS TITLE' ,  $user->getDisplayName() ) .' - '. $album->name);
			$this->setTitle( $album->name );

			if( !CPrivacy::isAccessAllowed($my->id, $user->id, 'user', 'privacyPhotoView') ){
				echo JText::_('CC ACCESS FORBIDDEN');
				return;
			}
			
			CFactory::load( 'helpers' , 'owner' );
	
			if( ($my->id == $album->creator && ($my->id != 0) ) )
			{
				$this->addSubmenuItem('index.php?option=com_community&view=photos&task=uploader&albumid=' . $albumId . '&userid=' . $user->id , JText::_('CC UPLOAD PHOTOS'), '', true);
				$this->addSubmenuItem('index.php?option=com_community&view=photos&task=editAlbum&albumid=' . $albumId . '&userid=' . $user->id , JText::_('CC EDIT ALBUM') , '' , true );
				$this->addSubmenuItem('index.php?option=com_community&view=photos&task=newalbum&userid=' . $user->id, JText::_('CC ADD ALBUM') , '' , true );
			}
			
			$this->showSubmenu();
			$tmpl	= new CTemplate();
			
			CFactory::load( 'libraries' , 'bookmarks' );
			$bookmarks		=new CBookmarks(CRoute::getExternalURL( 'index.php?option=com_community&view=photos&task=album&albumid=' . $album->id . '&userid=' . $user->id ));
			$bookmarksHTML	= $bookmarks->getHTML();
	
			$tmpl->set( 'bookmarksHTML'	, $bookmarksHTML );
			$tmpl->set( 'isOwner' 		, isMine($my->id, $user->id));
			$tmpl->set( 'photos' 		, $photos );
			$tmpl->set( 'album'			, $album);
	
			echo $tmpl->fetch('photos.album');
		}
		else
		{
			$mainframe->redirect( 'index.php?option=com_community&view=photos', JText::_('CC USER ACCOUNT IS BLOCKED') );
		}
	}
	
	/**
	 * Display the photo thumbnails from an album
	 **/
	function album()
	{
		$document	=& JFactory::getDocument();
		$css		= rtrim( JURI::root() , '/' ) . '/components/com_community/assets/album.css';
		$document->addStyleSheet($css);	
		$groupId	= JRequest::getVar( 'groupid' , '' , 'REQUEST' );
		
		if(!empty($groupId) )
		{
			$this->_groupAlbum();
		}
		else
		{
			$this->_userAlbum();
		}
	}

	function _groupPhoto()
	{
		$mainframe =& JFactory::getApplication();
		$document =& JFactory::getDocument();


		// Get necessary properties and load the libraries
		CFactory::load( 'models' , 'photos' );
		CFactory::load('helpers', 'friends');

		$my			= CFactory::getUser();
 		$model		=& CFactory::getModel('photos');
 		$groupId	= JRequest::getVar('groupid' , '' , 'GET');
 		$albumId	= JRequest::getVar('albumid' , '' , 'GET');
 		$defaultId	= JRequest::getVar('photoid' , '' , 'GET');

 		if( empty( $albumId ) )
 		{
 			echo JText::_('CC NO PROPER ALBUM ID');
 			return;
		}

		// Load the album table
		$album		=& JTable::getInstance( 'Album' , 'CTable' );
		$album->load( $albumId );
		
		// Set pathway
        $pathway 	=& $mainframe->getPathway();
		$pathway->addItem( $album->name, '' );
		
		CFactory::load( 'models' , 'groups' );
		$group		=& JTable::getInstance( 'Group' , 'CTable' );
		$group->load( $groupId );
		
		CFactory::load( 'helpers' , 'group' );
		
		//@rule: Do not allow non members to view albums for private group
		if(!cAllowViewMedia($group->id))
		{
			// Set document title
			$document->setTitle( JText::_('CC RESTRICTED ACCESS') );
			$mainframe->enqueueMessage(JText::_('CC RESTRICTED ACCESS', 'notice'));
			
			echo JText::_('CC PHOTO NEED GROUP MEMBER PERMISSION');			
			return;			
		}
		
		// Get list of photos and set some limit to be displayed.
		// @todo: make limit configurable? set to 1000, unlimited?
		$photos		= $model->getPhotos( $albumId, 1000);

		// Set document title
		$document->setTitle( $album->name );

		// @checks: Test if album doesnt have any default photo id. We need to get the first row
		// of the photos to be the default
		if($album->photoid == '0')
		{
			$album->photoid	= ( count( $photos ) >= 1 ) ? $photos[0]->id : '0';
		}

		// Try to see if there is any photo id in the query
		$defaultId		= ( !empty($defaultId) ) ? $defaultId : $album->photoid;

		// Load the default photo
		$photo			=& JTable::getInstance( 'Photo' , 'CTable' );
		$photo->load( $defaultId );

		// If default has an id of 0, we need to tell the template to dont process anything
		$default		= ($photo->id == 0 ) ? false : $photo;

		CFactory::load( 'helpers' , 'owner' );	
		
		//friend list for photo tag
		CFactory::load( 'libraries' , 'phototagging' );
		$tagging	= new CPhotoTagging();
								
		
		for($i=0; $i < count($photos); $i++)
		{
			// Convert the generic object row into CTablePhoto object 
			$item =& JTable::getInstance( 'Photo' , 'CTable' );
			$item->bind($photos[$i]);
			$photos[$i] = $item;
			
			$row			=& $photos[$i];
			$taggedList		= $tagging->getTaggedList($row->id);
							
			for($t=0;$t < count($taggedList);$t++)
			{
				$tagItem	=& $taggedList[$t];
				$tagUser	= CFactory::getUser($tagItem->userid);
				
				$canRemoveTag	= 0;
				// 1st we check the tagged user is the photo owner.
				//	If yes, canRemoveTag == true.
				//	If no, then check on user is the tag creator or not.
				//		If yes, canRemoveTag == true
				//		If no, then check on user whether user is being tagged
				if(isMine($my->id, $row->creator) || isMine($my->id, $tagItem->created_by) || isMine($my->id, $tagItem->userid))
				{
					$canRemoveTag = 1;
				}
				
				$tagItem->user			= $tagUser;
				$tagItem->canRemoveTag	= $canRemoveTag;
			}
			$row->tagged	= $taggedList;
		}
					
		// for photo tagging. only allow to tag members
		$groupModel 		=& CFactory::getModel( 'groups' );
		$groupMemberIds		= $groupModel->getMembersId($groupId, true);
		$friends			= array();
		
		foreach($groupMemberIds as $grpMemberId)
		{
			if($my->id != $grpMemberId)
			{
				$memberUser		= CFactory::getUser($grpMemberId);			
				$friends[]		= $memberUser;
			}
		}
		if(isCommunityAdmin() || $group->isAdmin( $my->id ) || $group->isMember( $my->id )) array_unshift($friends, $my);
		
		CFactory::load( 'helpers' , 'group' );
		CFactory::load( 'helpers' , 'owner' );
				
		$allowManagePhotos = cAllowManagePhoto($groupId);	

		if( ( ($my->id == $album->creator && $allowManagePhotos ) || $group->isAdmin($my->id) || isCommunityAdmin() ) && $default )
		{
			$this->addSubmenuItem('' , JText::_('CC SET IMAGE AS ALBUM COVER'), "setPhotoAsDefault();" , true);
			$this->addSubmenuItem('' , JText::_('CC DELETE IMAGE'), "removePhoto();", true);
		}
		$this->addSubmenuItem('' , JText::_('CC DOWNLOAD IMAGE'), "downloadPhoto();", true);
		

		// Show wall contents
		CFactory::load( 'helpers' , 'friends' );
		
		// Load up required objects.
		$friendModel 	=& CFactory::getModel( 'friends' );
		$config			=& CFactory::getConfig();
		$showWall		= false;
		$allowTag		= false;

		//check if we can allow the current viewing user to tag the photos
		if($group->isMember( $my->id ) || $group->isAdmin( $my->id ) || isCommunityAdmin())
		{
			$showWall	= true;
			$allowTag = true;
		}

		$this->showSubmenu();
		$tmpl			= new CTemplate();
		CFactory::load( 'libraries' , 'bookmarks' );
		$bookmarks		= new CBookmarks(CRoute::getExternalURL( 'index.php?option=com_community&view=photos&task=album&albumid=' . $album->id . '&groupid=' . $group->id ));
		$bookmarksHTML	= $bookmarks->getHTML();
		
		$photoCreator = CFactory::getUser($photo->creator);
		
		CFactory::load( 'helpers' , 'owner' );
		
		$tmpl->set( 'bookmarksHTML'	, $bookmarksHTML );
		$tmpl->set( 'showWall'		, $showWall );
		$tmpl->set( 'allowTag'		, $allowTag );
		$tmpl->set( 'isOwner' 		, $group->isAdmin($my->id) );
		$tmpl->set( 'isAdmin'		, isCommunityAdmin() );
		$tmpl->set( 'photos' 		, $photos );
		$tmpl->set( 'default'		, $default );
		$tmpl->set( 'album'			, $album);
		$tmpl->set( 'friends'		, $friends);
		$tmpl->set( 'config'		, $config);
		$tmpl->set( 'photoCreator'	, $photoCreator);
		
		echo $tmpl->fetch('photos.photo');
	}
	
	function _userPhoto()
	{
		$mainframe =& JFactory::getApplication();
		$document =& JFactory::getDocument();


		// Get necessary properties and load the libraries
		CFactory::load( 'models' , 'photos' );
		CFactory::load('helpers', 'friends');

		$my			= CFactory::getUser();
 		$model		=& CFactory::getModel('photos');
 		$albumId	= JRequest::getVar('albumid' , '' , 'GET');
 		$defaultId	= JRequest::getVar('photoid' , '' , 'GET');

 		if( empty( $albumId ) )
 		{
 			echo JText::_('CC NO PROPER ALBUM ID');
 			return;
		}

		// Load the album table
		$album		=& JTable::getInstance( 'Album' , 'CTable' );
		$album->load( $albumId );
		
		// Set pathway
        $pathway 	=& $mainframe->getPathway();
		$pathway->addItem( $album->name, '' );

		// Since the URL might not contain userid, we need to get the user object from the creator
		$user		= CFactory::getUser( $album->creator );
		
		if(!$user->block || isCommunityAdmin($my->id))
		{
			// Set the current user's active profile
			CFactory::setActiveProfile( $album->creator );
			
			// Get list of photos and set some limit to be displayed.
			// @todo: make limit configurable? set to 1000, unlimited?
			$photos		= $model->getPhotos( $albumId, 1000);
			$pagination	= $model->getPagination();
	
			CFactory::load( 'helpers' , 'pagination' );
			// @todo: make limit configurable?
			$paging		= CPaginationLibrary::getLinks( $pagination , 'photos,ajaxPagination' , $albumId , 10 );
	
			// Set document title
			$document->setTitle( $album->name );
	
			// @checks: Test if album doesnt have any default photo id. We need to get the first row
			// of the photos to be the default
			if($album->photoid == '0')
			{
				$album->photoid	= ( count( $photos ) >= 1 ) ? $photos[0]->id : '0';
			}
	
			// Try to see if there is any photo id in the query
			$defaultId		= ( !empty($defaultId) ) ? $defaultId : $album->photoid;
	
			// Load the default photo
			$photo			=& JTable::getInstance( 'Photo' , 'CTable' );
			$photo->load( $defaultId );
	
			// If default has an id of 0, we need to tell the template to dont process anything
			$default		= ($photo->id == 0 ) ? false : $photo;
	
			// Load User params
			$params			=& $user->getParams();
	
			// site visitor
			$relation = 10;
	
			// site members
			if( $my->id != 0 )
				$relation = 20;
	
			// friends
			if( friendIsConnected($my->id, $user->id) )
				 $relation = 30;
	
			// mine
			if( isMine($my->id, $user->id) ){
				 $relation = 40;
			}
	
			if( $my->id != $user->id )
			{
				$this->attachMiniHeaderUser( $user->id );
			}

			CFactory::load( 'helpers' , 'owner' );
			
			// @todo: respect privacy settings
			if( $relation < $params->get('privacyPhotoView') && !isCommunityAdmin() )
			{
				echo JText::_('CC ACCESS FORBIDDEN');
				return;
			}
	
			CFactory::load( 'helpers' , 'owner' );	
			
			//friend list for photo tag
			CFactory::load( 'libraries' , 'phototagging' );
			$tagging	= new CPhotoTagging();
	
			for($i=0; $i < count($photos); $i++)
			{
				$item =& JTable::getInstance( 'Photo' , 'CTable' );
				$item->bind($photos[$i]);
				$photos[$i] = $item;
				$row			=& $photos[$i];
				$taggedList		= $tagging->getTaggedList($row->id);				
								
				for($t=0;$t < count($taggedList);$t++)
				{
					$tagItem	=& $taggedList[$t];
					$tagUser	= CFactory::getUser($tagItem->userid);
					
					$canRemoveTag	= 0;
					// 1st we check the tagged user is the photo owner.
					//	If yes, canRemoveTag == true.
					//	If no, then check on user is the tag creator or not.
					//		If yes, canRemoveTag == true
					//		If no, then check on user whether user is being tagged
					if(isMine($my->id, $row->creator) || isMine($my->id, $tagItem->created_by) || isMine($my->id, $tagItem->userid))
					{
						$canRemoveTag = 1;
					}
					
					$tagItem->user			= $tagUser;
					$tagItem->canRemoveTag	= $canRemoveTag;									
					
				}
				$row->tagged	= $taggedList;			
			}
						
			$friendModel 		=& CFactory::getModel( 'friends' );
			$friends			= $friendModel->getFriends( $my->id , '' , false );
			array_unshift($friends, $my);
				
			// Only add these links when there are photos in the album
			if( $default && isCommunityAdmin() || ($my->id == $album->creator && ($my->id != 0) && $default) )
			{
				$this->addSubmenuItem('' , JText::_('CC DELETE IMAGE'), "removePhoto();", true);
				$this->addSubmenuItem('' , JText::_('CC SET IMAGE AS ALBUM COVER'), "setPhotoAsDefault();" , true);
				//$this->addSubmenuItem('' , JText::_('Set as profile photo'), "setPhotoAsProfileImage();", true);
			}
			$this->addSubmenuItem('' , JText::_('CC DOWNLOAD IMAGE'), "downloadPhoto();", true);

			// Show wall contents
			CFactory::load( 'helpers' , 'friends' );
			
			// Load up required objects.
			$user			= CFactory::getUser( $photo->creator );
			$config			=& CFactory::getConfig();
			
			$isConnected	= friendIsConnected( $my->id , $user->id );
			$isMe			= isMine( $my->id , $user->id );
			$showWall		= false;
			$allowTag		= false;
			
			// Check if user is really allowed to post walls on this photo.
			if( ($isMe) || (!$config->get('lockprofilewalls')) || ( $config->get('lockprofilewalls') && $isConnected ) )
			{
				$showWall	= true;
			}
			
			//check if we can allow the current viewing user to tag the photos
			if(($isMe) || $isConnected)
			{
				$allowTag = true;
			}

			$this->showSubmenu();
			
			$tmpl	= new CTemplate();
			CFactory::load( 'libraries' , 'bookmarks' );
			$bookmarks		=new CBookmarks(CRoute::getExternalURL( 'index.php?option=com_community&view=photos&task=album&albumid=' . $album->id . '&userid=' . $user->id ));
			$bookmarksHTML	= $bookmarks->getHTML();
			
			CFactory::load( 'helpers' , 'owner' );
			
			$tmpl->set( 'bookmarksHTML'	, $bookmarksHTML );
			$tmpl->set( 'showWall'		, $showWall );
			$tmpl->set( 'allowTag'		, $allowTag );
			$tmpl->set( 'isOwner' 		, isMine($my->id, $user->id));
			$tmpl->set( 'isAdmin'		, isCommunityAdmin() );
			$tmpl->set( 'photos' 		, $photos );
			$tmpl->set( 'pagination'	, $paging );
			$tmpl->set( 'default'		, $default );
			$tmpl->set( 'album'			, $album);
			$tmpl->set( 'friends'		, $friends);
			$tmpl->set( 'config'		, $config);
	
			echo $tmpl->fetch('photos.photo');
		}
		else
		{
	        CFactory::load('helpers' , 'owner' );
			$tmpl	= new CTemplate();
			echo $tmpl->fetch('profile.blocked');
			return;
		}	
	}
	
	/**
	 * Displays single photo view
	 *
	 **/
	function photo()
	{
		$mainframe	=& JFactory::getApplication();
		$document	=& JFactory::getDocument();

		// Load window library
		CFactory::load( 'libraries' , 'window' );		
		CWindow::load();
		
		// Get the configuration object.
		$config	=& CFactory::getConfig();

		$css	= JURI::root() . 'components/com_community/assets/album.css';
		$document->addStyleSheet($css);
		$css	= JURI::root() . 'components/com_community/assets/photos.css';
		$document->addStyleSheet($css);
		
		$js = '/assets/gallery';
		$js	.= ( $config->getBool('usepackedjavascript') ) ? '.pack.js' : '.js';
		CAssets::attach($js, 'js');

 		$albumId	= JRequest::getVar('albumid' , '' , 'GET');

 		if( empty( $albumId ) )
 		{
 			echo JText::_('CC NO PROPER ALBUM ID');
 			return;
		}
		
		CFactory::load( 'models' , 'photos' );
		// Load the album table
		$album		=& JTable::getInstance( 'Album' , 'CTable' );
		$album->load( $albumId );

		if($album->type == PHOTOS_GROUP_TYPE)
		{
			$this->_groupPhoto();
		}
		else
		{			
			$this->_userPhoto();
		}
	}
	
	/**
	 * return the resized images
	 */	 	
	function showimage(){
	}
}