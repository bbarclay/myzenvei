<?php
/**
 * @package		JomSocial
 * @subpackage  Controller 
 * @copyright (C) 2008 by Slashes & Dots Sdn Bhd - All rights reserved!
 * @license http://www.jomsocial.com Copyrighted Commercial Software
 */
// no direct access
defined('_JEXEC') or die('Restricted access');
jimport( 'joomla.application.component.controller' );

class CommunityPhotosController extends CommunityBaseController
{
	function _outputJSONText( $hasError , $text , $nextUpload )
	{
		echo "{\n";

		if( $hasError )
		{
			echo "error: 'true',\n";
		}

		echo "msg: '" . $text . "'\n,";
		echo "nextupload: '" . $nextUpload . "'\n";
		echo "}";
		exit;
	}
	
	function _addActivity( $command, $actor , $target , $title , $content , $app , $cid, $param='')
	{
		$act = new stdClass();
		$act->cmd 		= $command;
		$act->actor   	= $actor;
		$act->target  	= $target;
		$act->title	  	= $title;
		$act->content	= $content;
		$act->app		= $app;
		$act->cid		= $cid;
		
		// Add activity logging
		CFactory::load ( 'libraries', 'activities' );
		CActivityStream::add( $act, $param );
	}
	
	/**
	 * Method to save new album or existing album
	 **/	 	
	function _saveAlbum( $id = null )
	{
		if ($this->blockUnregister()) return;
		
		$my			= CFactory::getUser();
		$type		=& JRequest::getVar( 'type' , PHOTOS_USER_TYPE ,'REQUEST' );
		$mainframe	=& JFactory::getApplication();
		$groupId	= JRequest::getVar( 'groupid' , '' , 'REQUEST' );
		
		// Load models, libraries
		CFactory::load( 'models' , 'photos' );
		CFactory::load( 'helpers' , 'url' );

		$album		=& JTable::getInstance( 'Album' , 'CTable' );
		
		// Test if this is existing album or not
		if( !is_null( $id ) )
		{
			$album->load( $id );
		}
		else
		{
			// Only assign necessary variables for new album
			switch($type)
			{
				case PHOTOS_GROUP_TYPE:
					$album->groupid		= $groupId;
					break;
			}
			$album->creator		= $my->id;
			$album->created			= gmdate('Y-m-d H:i:s');
		}

		$album->name			= JRequest::getVar('name' , '' , 'POST');
		$album->description		= JRequest::getVar( 'description' , '' , 'POST' );
		
		switch($type)
		{
			case PHOTOS_GROUP_TYPE:
				$album->type	= PHOTOS_GROUP_TYPE;
				break;
			default:
				$album->type	= PHOTOS_USER_TYPE;
				break;
		}

		//@todo: add permissions
		$params					= $my->getParams();
		$album->permissions		= $params->get('privacyPhotoView');

		
		// Save it
		$album->store();
		
		// update album relative path [userid]/[albumid]
		// we need create the record 1st in order to get the albumid. 
		// the next 'store' will do an update.
		$storage		= JPATH_ROOT . DS . 'images';
		
		switch($album->type)
		{
			case PHOTOS_GROUP_TYPE:
				$albumPath	= $storage . DS . 'groupphotos' . DS . $groupId . DS . $album->id;
				break;
			default:
				$albumPath		= $storage . DS . 'photos' . DS . $my->id . DS . $album->id;
				break;
		}
		$albumPath		= JString::str_ireplace( JPATH_ROOT . DS , '' , $albumPath );		
		$albumPath		= JString::str_ireplace( '\\' , '/' , $albumPath );		
		
		$album->path	= $albumPath;
		$album->store();		
		
		return $album;
	}
	
	function _storeOriginal($tmpPath, $destPath, $albumId = 0)
	{
		jimport('joomla.filesystem.file');
		jimport('joomla.utilities.utility');
		
		// First we try to get the user object.
		$my			= CFactory::getUser();
		
		// Then test if the user id is still 0 as this might be
		// caused by the flash uploader.
		if( $my->id == 0 )
		{
			$tokenId	= JRequest::getVar( 'token' , '' , 'REQUEST' );
			$userId		= JRequest::getVar( 'userid' , '' , 'REQUEST' );

			$my			= CFactory::getUserFromTokenId( $tokenId , $userId );
		}
		$config =& CFactory::getConfig(); 
		 
		// @todo: We assume now that the config is using the relative path to the
		// default images folder in Joomla.
		// @todo:  this folder creation should really be in its own function
		$albumPath			= ($albumId == 0) ? '' : DS . $albumId;
		$originalPathFolder	= JPATH_ROOT . DS . 'images' . DS . JPath::clean( $config->get('originalphotopath') );
		$originalPathFolder	= $originalPathFolder . DS . $my->id . $albumPath;
		
		if( !JFile::exists( $originalPathFolder ) )
		{
			JFolder::create( $originalPathFolder, (int) octdec( $config->get('folderpermissionsphoto') ) );
		}
		
		if(!JFile::copy( $tmpPath, $destPath ) )
		{
			JError::raiseWarning(21, JText::sprintf('CC ERROR MOVING UPLOADED FILE' , $destPath));
		}
	}
	
	
	function _optimalResizedFilename(&$photo, $w , $h)
	{
		$album	=& JTable::getInstance( 'Album' , 'CTable' );
		$album->load( $photo->albumid );

		$filename 	= "";
		$newPath	= "";

		if( $album->type == PHOTOS_GROUP_TYPE )
		{
			// Since group photos introduced after the new photo path /ALBUMID/PHOTO/ , we do not
			// need to perform any checks.
			$filename = JString::str_ireplace('images/groupphotos/' . $album->groupid . '/' . $photo->albumid . '/', '' , $photo->image );
			$newPath  = 'images' . DS  . 'groupphotos' . DS . $album->groupid . DS . $photo->albumid;
		}
		else
		{
			/**
			 * We need to determine whether this is a new photo path, which include the albumid; or the old photo path.
			 * to get the image file name as well as the image path for resizing.		 
			 */
			$matches	= null;
			if(preg_match('/images\/photos\/'.$photo->creator . '\/' . $photo->albumid . '\//i', $photo->image, $matches))
			{	
			 	$filename = JString::str_ireplace('images/photos/'.$photo->creator . '/' . $photo->albumid . '/' , '' , $photo->image );
			 	$newPath  = 'images' . DS  . 'photos' . DS.$photo->creator . DS . $photo->albumid;
			}
			else
			{
				$filename = JString::str_ireplace('images/photos/'.$photo->creator . '/' , '' , $photo->image );
				$newPath  = 'images' . DS  . 'photos' . DS.$photo->creator;
			}
		}
					
		$filename = 'rsz_'.$w.'_'.$h.'_'.$filename;
		$filename = $newPath . DS . $filename;

		return $filename; 
	}
	
	
	function ajaxAddPhotoTag($photoId, $userId, $posX, $posY, $w, $h)	
	{
		if (!isRegisteredUser()) {
			return $this->ajaxBlockUnregister();
		}
		
		$response	= new JAXResponse();
		
		CFactory::load ( 'libraries', 'phototagging' );
		CFactory::load ( 'models' , 'photos' );
				
		$my			= CFactory::getUser();		
		$photoModel	=& CFactory::getModel('photos');
		$tagging 	= new CPhotoTagging();				

		$tag = new stdClass();
		$tag->photoId	= $photoId;
		$tag->userId	= $userId;
		$tag->posX		= $posX;
		$tag->posY		= $posY;
		$tag->width		= $w;
		$tag->height	= $h;
		
		$tagId	= $tagging->addTag($tag);
		
		$jsonString = '{}';
		if($tagId > 0)
		{
			$user		= CFactory::getUser($userId);
			$isGroup	= $photoModel->isGroupPhoto($photoId);
			$photo		= $photoModel->getPhoto($photoId);
										
			$jsonString = '{'
			 	. 'id:' . $tagId . ','
			 	. 'photoId:' . $photoId . ','
			 	. 'userId:' . $userId . ','			 	
			 	. 'displayName:\'' . $user->getDisplayName() . '\','
			 	. 'profileUrl:\'' . CRoute::_('index.php?option=com_community&view=profile&userid='.$userId, false) . '\','
			 	. 'top:' . $posX . ','
			 	. 'left:' . $posY . ','
			 	. 'width:' . $w . ','
			 	. 'height:' . $h . ','
			 	. 'canRemove:true'
				. '}';
				
			// jQuery call to update photo tagged list.		
			$response->addScriptCall('createPhotoTag', $jsonString);
			$response->addScriptCall('createPhotoTextTag', $jsonString);
			$response->addScriptCall('cWindowHide');
			$response->addScriptCall('cancelNewPhotoTag');
			
			
			//send notification emails
			$albumId		= $photo->albumid;
			$photoCreator	= $photo->creator;
			$url 			= '';			
			
			if($isGroup)
			{				
				$groupId	= $photoModel->getPhotoGroupId($albumId);							
				$url		= CRoute::getExternalURL('index.php?option=com_community&view=photos&task=photo&groupid='.$groupId.'&albumid='.$albumId, false) . '#photoid=' . $photoId;
			}
			else
			{
				$url	= CRoute::getExternalURL('index.php?option=com_community&view=photos&task=photo&userid='.$photoCreator.'&albumid='.$albumId, false) . '#photoid=' . $photoId;
			}
			
			// Send notification email to tagged user		
			$tmplData				= array();
			$tmplData['url']		= $url;
			
			if($my->id != $userId)
			{
				$this->_notify( 'photos.tagging' , $my->id , $userId , JText::sprintf( 'CC SOMEONE TAG YOU' , $my->getDisplayName() ) ,
								 '' , 'photos.email.tagging' , $tmplData );
			}				 
				 			
		}
		else
		{
			$html	= $tagging->getError();
			$action = '<button class="button" onclick="cWindowHide();cancelNewPhotoTag();" name="close">' . JText::_('Close') . '</button>';
			
			//remove the existing cwindow (for friend selection)
			$response->addScriptCall('jQuery(\'#cWindow\').remove();');
			//recreate the warning cwindow
			$response->addScriptCall('cWindowShow','','Notice',450,200,'warning');
			$response->addAssign('cWindowContent', 'innerHTML', $html);
 			$response->addScriptCall('cWindowActions', $action);						
		}				
		
		return $response->sendResponse();
	}
	
	function ajaxRemovePhotoTag($photoId, $userId)
	{
		if (!isRegisteredUser()) {
			return $this->ajaxBlockUnregister();
		}
		
		$response	= new JAXResponse();
		
		CFactory::load ( 'libraries', 'phototagging' );
		$tagging = new CPhotoTagging();
				
		if(! $tagging->removeTag($photoId, $userId))
		{
			$html	= $tagging->getError();
			$response->addScriptCall('cWindowShow','','Notice',450,200,'warning');
			$response->addAssign('cWindowContent', 'innerHTML', $html);					
		}
		
		return $response->sendResponse();		
	}
	
	function ajaxDisplayCreator($photoid)
	{
		$response	= new JAXResponse();
		
		// Load the default photo
		CFactory::load('models','photos');
		$photo	=& JTable::getInstance( 'Photo' , 'CTable' );
		$photo->load( $photoid );
		
		$photoCreator = CFactory::getUser($photo->creator);
		
		$html = JText::sprintf('CC UPLOADED BY', CRoute::_('index.php?option=com_community&view=profile&userid='.$photoCreator->id), $photoCreator->getDisplayName());
		$response->addAssign('uploadedBy', 'innerHTML', $html);
		
		return $response->sendResponse();
	}
    function ajaxRemoveFeatured( $albumId )
    {
    	$objResponse	= new JAXResponse();
    	CFactory::load( 'helpers' , 'owner' );
    	
    	$my			= CFactory::getUser();
		if($my->id == 0)
		{
		   return $this->ajaxBlockUnregister();
		}    	
		
		if( isCommunityAdmin() )
    	{
			$model	=& CFactory::getModel('Featured');

    		CFactory::load( 'libraries' , 'featured' );
    		$featured	= new CFeatured( FEATURED_ALBUMS );    		
    		
    		if($featured->delete($albumId))
    		{
    			$objResponse->addAssign('cWindowContent', 'innerHTML', JText::_('CC ALBUM REMOVED FROM FEATURED'));	
			}
			else
			{
				$objResponse->addAssign('cWindowContent', 'innerHTML', JText::_('CC ERROR REMOVING ALBUM FROM FEATURED'));
			}
		}
		else
		{
			$objResponse->addAssign('cWindowContent', 'innerHTML', JText::_('CC NOT ALLOWED TO ACCESS SECTION'));
		}
		$buttons   = '<input type="button" class="button" onclick="window.location.reload();" value="' . JText::_('CC BUTTON CLOSE') . '"/>';
		
		$objResponse->addScriptCall( 'cWindowActions' , $buttons );
		return $objResponse->sendResponse();
	}
	
    function ajaxAddFeatured( $albumId )
    {
    	$objResponse	= new JAXResponse();
    	CFactory::load( 'helpers' , 'owner' );
    	
    	$my			= CFactory::getUser();
		if($my->id == 0)
		{
		   return $this->ajaxBlockUnregister();
		}    	
		
		if( isCommunityAdmin() )
    	{
			$model	=& CFactory::getModel('Featured');
			
			if( !$model->isExists( FEATURED_ALBUMS , $albumId ) )
			{
	    		CFactory::load( 'libraries' , 'featured' );
	    		CFactory::load( 'models' , 'photos');
	    		$featured	= new CFeatured( FEATURED_ALBUMS );
	    		$featured->add( $albumId , $my->id );
	    		
	    		$table		=& JTable::getInstance( 'Album' , 'CTable' );
	    		$table->load( $albumId );

				$objResponse->addAssign('cWindowContent', 'innerHTML', JText::sprintf('CC ALBUM IS FEATURED', $table->name ));
			}
			else
			{
				$objResponse->addAssign('cWindowContent', 'innerHTML', JText::_('CC ALBUM ALREADY FEATURED'));
			}
		}
		else
		{
			$objResponse->addAssign('cWindowContent', 'innerHTML', JText::_('CC NOT ALLOWED TO ACCESS SECTION'));
		}
		$buttons   = '<input type="button" class="button" onclick="window.location.reload();" value="' . JText::_('CC BUTTON CLOSE') . '"/>';
		
		$objResponse->addScriptCall( 'cWindowActions' , $buttons );
		return $objResponse->sendResponse();
	}
	
	/**
	 * Method is called from the reporting library. Function calls should be
	 * registered here.
	 *
	 * return	String	Message that will be displayed to user upon submission.
	 **/	 	 	
	function reportPhoto( $link, $message , $id )
	{
		if ($this->blockUnregister()) return;
		
		CFactory::load( 'libraries' , 'reporting' );
		$report = new CReportingLibrary();
		
		// Pass the link and the reported message
		$report->createReport( JText::_('CC BAD PHOTO') ,$link , $message );
		
		// Add the action that needs to be called.
		$action					= new stdClass();
		$action->label			= 'Delete photo';
		$action->method			= 'photos,deletePhoto';
		$action->parameters		= $id;
		$action->defaultAction	= false;
		
		$report->addActions( array( $action ) );

		return JText::_('CC REPORT SUBMITTED');
	}

	/**
	 * Function that is called from the back end
	 **/	 	
	function deletePhoto( $photoId )
	{
		if ($this->blockUnregister()) return;
		
		$photo	=& JTable::getInstance( 'Photo' , 'CTable' );
		$photo->load( $id );
		$photo->delete();
		
		
		$album =& JTable::getInstance( 'Album' , 'CTable' );
		$album->load( $photo->albumId );
		
		// @todo: delete 1 particular activity
		// since we cannot identify any one activity (activity only store album id) 
		// just delete 1 activity with a matching album id
		$actModel = CFactory::getModel('activities');
		$actModel->removeOneActivity('photos' , $album->id );

		return JText::_('CC PHOTO DELETED');
	}
	
	function ajaxSetDefaultPhoto( $albumId , $photoId )
	{
		if (!isRegisteredUser())
		{
			return $this->ajaxBlockUnregister();
		}
				
		$response	= new JAXResponse();
		
		CFactory::load( 'models' , 'photos' );
		CFactory::load( 'helpers' , 'owner' );
		$album =& JTable::getInstance( 'Album' , 'CTable' );
		$album->load( $albumId );
		$model		=& $this->getModel('photos');
		$my			= CFactory::getUser();
		$photo		= $model->getPhoto( $photoId );

		if( $album->type == PHOTOS_GROUP_TYPE )
		{
			CFactory::load( 'helpers' , 'group' );			
			
			if( !cAllowManagePhoto($album->groupid) )
			{
				$response->addScriptCall( 'alert' , JText::_('CC PERMISSION DENIED') );
				return $response->sendResponse();
			}	
		}
		else
		{
			// We need to only allow album creator and site super administrator to really perform this.
			if($my->id != $photo->creator && !isCommunityAdmin() )
			{
				$response->addScriptCall( 'alert' , JText::_('CC PERMISSION DENIED') );
				return $response->sendResponse();
			}
		}
		
		$model->setDefaultImage( $albumId , $photoId );
		$response->addScriptCall('alert' , JText::_('CC PHOTO IS NOW ALBUM DEFAULT') );

		return $response->sendResponse();
	}
	
	/**
	 * Ajax method to display remove an album notice
	 *
	 * @param $id	Album id
	 **/
	function ajaxRemoveAlbum( $id , $currentTask )
	{
		if (!isRegisteredUser()) {
			return $this->ajaxBlockUnregister();
		}
		
		$response	= new JAXResponse();
		
		// Load models / libraries
		CFactory::load( 'models' , 'photos' );
		$my			= CFactory::getUser();
		$album		=& JTable::getInstance( 'Album' , 'CTable' );
		$album->load( $id );

		$content	= '<div>';
		$content	.= JText::sprintf('CC CONFIRM REMOVE ALBUM' , $album->name );
		$content	.= '</div>';

		$buttons	= '<form method="post" action="' . CRoute::_('index.php?option=com_community&view=photos&task=removealbum') . '">';
		$buttons	.= '<input type="submit" value="' . JText::_('CC BUTTON YES') . '" class="button" name="Submit"/>';
		$buttons	.= '<input type="hidden" value="' . $album->id . '" name="albumid" />';
		$buttons	.= '<input type="hidden" value="' . $currentTask . '" name="currentTask" />';
		$buttons	.= '&nbsp;';
		$buttons	.= '<input onclick="cWindowHide();" type="button" value="' . JText::_('CC BUTTON NO') . '" class="button" />';
		$buttons	.= '</form>';

		$response->addAssign('cWindowContent' , 'innerHTML' , $content);
		$response->addScriptCall('cWindowActions', $buttons);
		return $response->sendResponse();
	}
	 
	function ajaxRemovePhoto( $photoId , $lastEntry )
	{
		if (!isRegisteredUser())
		{
			return $this->ajaxBlockUnregister();
		}
		
		$response	= new JAXResponse();
		
		$model		=& $this->getModel('photos');
		$my			=& JFactory::getUser();
		
		$photo		= $model->getPhoto( $photoId );

		$album		=& JTable::getInstance( 'Album' , 'CTable' );
		$album->load( $photo->albumid );
		
		$allowed	= false;
		
		CFactory::load( 'helpers' , 'owner' );
		CFactory::load( 'models' , 'groups' );
		CFactory::load( 'helpers' , 'group' );
		if( $album->type == PHOTOS_GROUP_TYPE )
		{
			$group		=& JTable::getInstance( 'Group' , 'CTable' );
			$group->load( $groupId );
			
			$allowed	= ( $my->id == $album->creator || $group->isAdmin($my->id) || isCommunityAdmin() ) ? true : false;
		}
		else
		{
			// Test if user is really allowed to remove photo
			if( ( $my->id == $photo->creator ) || isCommunityAdmin() )
			{
				$allowed = true;
			}
		}

		if( $allowed )
		{
		
			CFactory::load( 'libraries' , 'apps' );
			$appsLib	=& CAppPlugins::getInstance();
			$appsLib->loadApplications();		
			
			$params		= array();
			$params[]	= &$photo;
			
			$appsLib->triggerEvent( 'onBeforePhotoDelete' , $params);
			$photo->delete();
			$appsLib->triggerEvent( 'onAfterPhotoDelete' , $params);
			
			$album =& JTable::getInstance( 'Album' , 'CTable' );
			$album->load( $photo->albumid );
			
			// @todo: delete 1 particular activity
			// since we cannot identify any one activity (activity only store album id) 
			// just delete 1 activity with a matching album id
			$actModel = CFactory::getModel('activities');
			$actModel->removeOneActivity('photos' , $album->id );

			//add user points
			CFactory::load( 'libraries' , 'userpoints' );		
			CUserPoints::assignPoint('photo.remove');
		}
		else
		{
			$response->addScriptCall( 'alert' , JText::_('CC PERMISSION DENIED') );
		}
		
		if( $lastEntry )
		{	
			$response->addScriptCall('window.location.reload');
		}

		return $response->sendResponse();
	}
	
	/**
	 * Populate the wall area in photos with wall/comments content
	 */	 	
	function showWallContents($photoId)
	{
		// Include necessary libraries
		CFactory::load( 'libraries' , 'wall' );
		CFactory::load( 'models' , 'photos' );

		$my			= CFactory::getUser();
		$photo		=& JTable::getInstance( 'Photo' , 'CTable' );
		$photo->load( $photoId );

		//@todo: Add limit
		$limit		= 20;
		
		if( $photo->id == '0' )
		{
			echo JText::_('CC INVALID PHOTO ID');
			return;
		}
		
		$contents	= CWallLibrary::getWallContents( 'photos' , $photoId , ($my->id == $photo->creator) , $limit , 0);
		CFactory::load( 'helpers' , 'string' );
		$contents	= cReplaceThumbnails($contents);

		return $contents;
	}

	/**
	 * Load photos pagination data
	 **/	 
	function ajaxPagination( $albumId , $limitstart , $limit )
	{
		$response	= new JAXResponse();
		
		// Load necessary libraries and models
		CFactory::load( 'models' , 'photos' );
		$my			= CFactory::getUser();
		$album		=& JTable::getInstance( 'Album' , 'CTable' );
		$album->load( $albumId );
		
		$model		=& CFactory::getModel( 'photos' );

		// Set the limitstart var so that the models constructor can set the proper value
 		JRequest::setVar( 'limitstart' , $limitstart );

		$photos		= $model->getPhotos( $album->id , $limit , $limitstart );

		// Clear the previous photo listings
		$response->addScriptCall('jQuery("#community-photo-items").html("");');

		ob_start();
		for( $i = 0; $i < count( $photos ); $i ++ )
		{
?>
			<li id="community-photo-item-<?php echo $photos[$i]->id;?>" style="width: 120px;" class="jomTips" title="<strong><?php echo $photos[$i]->caption;?></strong>">
				<a href="javascript:void(0);" onclick="cSwitchPhoto('<?php echo $photos[$i]->id;?>', '<?php echo JURI::root() . $photos[$i]->image; ?>' , '<?php echo $photos[$i]->caption;?>');">
					<img src="<?php echo $photos[$i]->getThumbURI();?>" alt=""/>
				</a>
				<input type="hidden" name="id" value="<?php echo $photos[$i]->id;?>" />
				<input type="hidden" name="source" value="<?php echo JURI::root() . $photos[$i]->image;?>" />
				<input type="hidden" name="caption" value="<?php echo $photos[$i]->caption;?>" />
			</li>
<?php
		}
		$data	= ob_get_contents();
		ob_end_clean();
		
		$response->addAssign( 'community-photo-items' , 'innerHTML' , $data );

		// Update the pagination links
		$pagination	= $model->getPagination();

		CFactory::load( 'helpers' , 'pagination' );
		$paging		= CPaginationLibrary::getLinks( $pagination , 'photos,ajaxPagination' , $album->id , $limit );
		
		$response->addAssign( 'photo-pagination' , 'innerHTML' , $paging );
		//$response->addScriptCall( 'jQuery("photo-pagination").html("' . $paging . '");' );
		return $response->sendResponse();
	}
	
	/**
	 * Ajax method to save the caption of a photo
	 *
	 * @param	int $photoId	The photo id
	 * @param	string $caption	The caption of the photo
	 **/	 	
	function ajaxSaveCaption($photoId , $caption)
	{
		if (!isRegisteredUser()) return $this->ajaxBlockUnregister();
		
		global $my;
		$response	= new JAXResponse();
		
		CFactory::load( 'models' , 'photos' );
		
		$photo			=& JTable::getInstance( 'Photo' , 'CTable' );
		$photo->load( $photoId );
		
		if( $photo->id == '0' )
		{
			// user shouldnt call this at all or reach here at all
			$response->addScriptCall( 'alert' , JText::_('CC INVALID PHOTO ID') );
			return $response->sendResponse();
		}
		
		CFactory::load( 'helpers' , 'owner' );
		if( $photo->creator != $my->id && !isCommunityAdmin() )
		{
			$response->addScriptCall( 'alert' , JText::_('CC NOT ALLOWED TO EDIT PHOTO CAPTION') );
			return $response->sendResponse();
		}
		
		$photo->caption	= $caption;
		$photo->store();		
		
		$response->addScriptCall('updatePhotoCaption', $photo->id, $photo->caption);
		
		return $response->sendResponse();
	}

	/**
	 * Trigger any necessary items that needs to be changed when the photo
	 * is changed.
	 **/	 
	function ajaxSwitchPhotoTrigger( $photoId )
	{
		$response	= new JAXResponse();
		
		// Get the wall form
		$wallInput	= $this->showWallForm( $photoId );
		$response->addAssign( 'community-photo-walls' , 'innerHTML' , $wallInput );
		
		// Get the wall contents
		$wallContents	= $this->showWallContents( $photoId );
		$response->addAssign('wallContent' , 'innerHTML' , $wallContents );
		
		$response->addScriptCall("joms.utils.textAreaWidth('#wall-message');");
		
		// Get the reporting data
		CFactory::load('libraries', 'reporting');
		$report		= new CReportingLibrary();

		$reportHTML	= $report->getReportingHTML( JText::_('CC REPORT BAD PHOTO') , 'photos,reportPhoto' , array( $photoId ) );
		$response->addScriptCall('updatePhotoReport', $reportHTML);
		$response->addScriptCall('jQuery("body").focus();');
				
		return $response->sendResponse();
	}
	
	/**
	 * This method is an AJAX call that displays the walls form
	 *
	 * @param	photoId	int The current photo id that is being browsed.
	 *
	 * returns
	 **/	 	
	function showWallForm($photoId)
	{
		// Include necessary libraries
		require_once( JPATH_COMPONENT . DS .'libraries' . DS . 'wall.php' );
		
		// Include helper
		require_once( JPATH_COMPONENT . DS . 'helpers' . DS . 'friends.php' );
		
		// Load up required objects.
		$my				= CFactory::getUser();
		$friendsModel	=& CFactory::getModel( 'friends' );
		$config			=& CFactory::getConfig();
		$html			= '';
		CFactory::load( 'models' , 'photos' );
		$photo			=& JTable::getInstance( 'Photo' , 'CTable' );
		$photo->load( $photoId );
		$album			=& JTable::getInstance( 'Album' , 'CTable' );
		$album->load( $photo->albumid );
		
		CFactory::load( 'helpers' , 'owner' );
		CFactory::load( 'helpers' , 'group' );
		
		if($album->type == PHOTOS_GROUP_TYPE )
		{
			if( cAllowPhotoWall($album->groupid ) )
			{
				$html		.= CWallLibrary::getWallInputForm( $photoId , 'photos,ajaxSaveWall', 'photos,ajaxRemoveWall' );
			}			
		}
		else
		{
			$isConnected	= friendIsConnected( $my->id , $photo->creator );
			$isMe			= isMine( $my->id , $photo->creator );

			// Check if user is really allowed to post walls on this photo.
			if( ($isMe) || (!$config->get('lockprofilewalls')) || ( $config->get('lockprofilewalls') && $isConnected ) || isCommunityAdmin() )
			{
				$html		.= CWallLibrary::getWallInputForm( $photoId , 'photos,ajaxSaveWall', 'photos,ajaxRemoveWall' );
			}
		}
		return $html;
	}
	
	function ajaxRemoveWall( $wallId )
	{
		if (!isRegisteredUser()) {
			return $this->ajaxBlockUnregister();
		}
		
		$response	= new JAXResponse();

		$wallsModel	=& $this->getModel( 'wall' );
		$wall		= $wallsModel->get( $wallId );
		
		if( $wallsModel->deletePost( $wallId ) )
		{
			$response->addAlert( JText::_('CC WALL REMOVED') );
			
			//add user points
			if($wall->post_by != 0)
			{
				CFactory::load( 'libraries' , 'userpoints' );		
				CUserPoints::assignPoint('wall.remove', $wall->post_by);
			}
		}
		else
		{
			$response->addAlert( JText::_('CC CANNOT REMOVE WALL') );
		}

		return $response->sendResponse();
	}


	
	/**
	 * Ajax function to save a new wall entry
	 * 	 
	 * @param message	A message that is submitted by the user
	 * @param uniqueId	The unique id for this group
	 * 
	 **/	 	 	 	 	 		
	function ajaxSaveWall( $message , $uniqueId )
	{
		if (!isRegisteredUser())
		{
			return $this->ajaxBlockUnregister();
		}
		$response		= new JAXResponse();
		$my				= CFactory::getUser();
		$config			=& CFactory::getConfig();
		
		// Load libraries
		CFactory::load( 'models' , 'photos' );
		CFactory::load( 'libraries' , 'wall' );
		CFactory::load( 'helpers' , 'url' );
		CFactory::load( 'libraries', 'activities' );	
		CFactory::load( 'helpers' , 'owner' );
		CFactory::load( 'helpers' , 'friends' );
		CFactory::load( 'helpers' , 'group' );
		
		$photo			=& JTable::getInstance( 'Photo' , 'CTable' );
		$photo->load( $uniqueId );
		
		$album			=& JTable::getInstance( 'Album' , 'CTable' );
		$album->load( $photo->albumid );

		if($album->type == PHOTOS_GROUP_TYPE )
		{
			if( !cAllowPhotoWall($album->groupid ) )
			{
				echo JText::_('CC NOT ALLOWED TO POST COMMENT');
				return;
			}
		}
		else
		{
			$isConnected	= friendIsConnected( $my->id , $photo->creator );
			$isMe			= isMine( $my->id , $photo->creator );

			// Check if user is really allowed to post walls on this photo.
			if(!$isMe && $config->get('lockprofilewalls') && !$isConnected && !isCommunityAdmin() )
			{
				echo JText::_('CC NOT ALLOWED TO POST COMMENT');
				return;
			}
		}
		
		// If the content is false, the message might be empty.
		if( empty( $message) )
		{
			$response->addAlert( JText::_('CC EMPTY WALL MESSAGE') );
		}
		else
		{
			$wall		= CWallLibrary::saveWall( $uniqueId , $message , 'photos' , $my , ( $my->id == $photo->creator ) );

			// Build the URL
			$url	= CRoute::_('index.php?option=com_community&view=photos&task=photo&albumid=' . $photo->albumid . '&userid=' . $photo->creator );
			$url	.= '#photoid=' . $uniqueId;
			$mailUrl	= CRoute::getExternalURL('index.php?option=com_community&view=photos&task=photo&albumid=' . $photo->albumid . '&userid=' . $photo->creator ) . '#photoid=' . $photo->id;
			
			$param = new JParameter('');
			$param->set( 'photoid', $uniqueId);
			$param->set( 'action', 'wall' );
			$param->set( 'wallid', $wall->id);
			$param->set( 'url'	, $url );
			
			switch( $album->type )
			{
				case PHOTOS_GROUP_TYPE:
					CFactory::load( 'models' , 'groups' );
					$group	=& JTable::getInstance( 'Group' , 'CTable' );
					$group->load( $album->groupid );
		
					// Build the URL
					$url			= CRoute::_('index.php?option=com_community&view=photos&task=photo&albumid=' . $photo->albumid . '&groupid=' . $album->groupid );
					$param->set( 'url'	, $url );
					$url			.= '#photoid=' . $uniqueId;
					$mailUrl		= CRoute::getExternalURL('index.php?option=com_community&view=photos&task=photo&albumid=' . $photo->albumid . '&groupid=' . $album->groupid ) . '#photoid=' . $photo->id;
								
					if( $group->approvals != COMMUNITY_PRIVATE_GROUP )
					{
						$this->_addActivity( 'photos.wall.create' , $my->id , 0 , JText::sprintf('CC ACTIVITIES WALL POST PHOTO' , $url , $photo->caption ) , $message , 'photos' , $uniqueId, $param->toString() );
					}
					break;
				default:
					if( $album->permissions <= PRIVACY_PUBLIC )
					{
						$this->_addActivity( 'photos.wall.create' , $my->id , 0 , JText::sprintf('CC ACTIVITIES WALL POST PHOTO' , $url , $photo->caption ) , $message , 'photos' , $uniqueId, $param->toString() );
					}
					break;
			}


			// @rule: Send notification to the photo owner.
			if( $my->id !== $photo->creator )
			{
				$nData				= array();
				$nData['url']		= $mailUrl;
				$nData['user']		= $my;
				$nData['message']	= $message;
	
				CFactory::load( 'libraries' , 'notification' );
				
				$notification	= new CNotificationLibrary();
				$notification->add( 'photos.submit.wall' , $my->id , $photo->creator , JText::sprintf('CC PHOTO WALL EMAIL SUBJECT' , $my->getDisplayName() ) , '' , 'photo.email.new.wall' , $nData);
			}
				
			//add user points
			CFactory::load( 'libraries' , 'userpoints' );		
			CUserPoints::assignPoint('photos.wall.create');

			$response->addScriptCall( 'joms.walls.insert' , $wall->content );
		}
		
		return $response->sendResponse();
	}

	/**
	 * Default task in photos controller
	 **/	 
	function display()
	{
		$document 	=& JFactory::getDocument();
		$viewType	= $document->getType();	
 		$viewName	= JRequest::getCmd( 'view', $this->getName() );
 		$view		=& $this->getView( $viewName , '' , $viewType );
 		if($this->checkPhotoAccess())
 			echo $view->get( __FUNCTION__ );
	}

	/**
	 * Alias method that calls the display task in photos controller
	 **/
	function myphotos()
	{		
	
		$document 	=& JFactory::getDocument();
		$viewType	= $document->getType();	
 		$viewName	= JRequest::getCmd( 'view', $this->getName() );
 		$view		=& $this->getView( $viewName , '' , $viewType );
 
 	 	if($this->checkPhotoAccess())	
 			echo $view->get( __FUNCTION__ );
	}
	
	/**
	 * Create new album for the photos
	 **/	 	
	function newalbum()
	{
		$my =& JFactory::getUser();
		if( $this->blockUnregister() ) return ;
		
		$groupId=JRequest::getVar('groupid', '0');
		if(!empty($groupId))
		{
			CFactory::load( 'helpers' , 'group' );			
			$allowManagePhotos = cAllowManagePhoto($groupId);
			CError::assert($allowManagePhotos, '', '!empty', __FILE__ , __LINE__ );
		}
		
		$document 	=& JFactory::getDocument();
		$viewType	= $document->getType();	
 		$viewName	= JRequest::getCmd( 'view', $this->getName() );
 		$view		=& $this->getView( $viewName , '' , $viewType );
 		
 		if( JRequest::getMethod() == 'POST' )
 		{
 			$mainframe =& JFactory::getApplication();
			$type		= JRequest::getVar( 'type' , '' , 'POST');
			$albumName	= JRequest::getVar( 'name' , '' , 'POST' );
			
			if( empty( $albumName ) )
			{
				$view->addWarning( JText::_('CC ALBUM NAME REQUIRED') );
			}
			else
			{
				$album	= $this->_saveAlbum();
				
				//add user points
				CFactory::load( 'libraries' , 'userpoints' );		
				CUserPoints::assignPoint('album.create');			

				// Redirect user to upload a photo
				switch($type)
				{
					case PHOTOS_GROUP_TYPE:
						$url		= CRoute::_('index.php?option=com_community&view=photos&task=uploader&albumid=' . $album->id . '&groupid=' . $album->groupid , false );
						break;
					default:
						$url		= CRoute::_('index.php?option=com_community&view=photos&task=uploader&albumid=' . $album->id . '&userid=' . $album->creator , false );
						break;
				}
				
				$message	= JText::_('CC NEW ALBUM CREATED');
				$mainframe->redirect( $url , $message );
			}
		}
		if($this->checkPhotoAccess())
 			echo $view->get( __FUNCTION__ );
	}
	


	/**
	 * Controller method to receive upload file
	 **/
	function upload()
	{
		// Then test if the user id is still 0 as this might be
		// caused by the flash uploader.
		$my			= CFactory::getUser();
		if( $my->id == 0 )
		{
			$tokenId	= JRequest::getVar( 'token' , '' , 'REQUEST' );
			$userId		= JRequest::getVar( 'userid' , '' , 'REQUEST' );
			$my			= CFactory::getUserFromTokenId( $tokenId , $userId );
		}

		// we have to check against the $my from here, and not from the inside blockUnregister() .
		// If still 0 then show error. 
		if ($this->blockUnregister()) return;
		
		CFactory::load('helpers', 'image');
		$imageFile	= JRequest::getVar( 'Filedata' , '' , 'FILES' , 'array' );

		// We need to read the filetype as uploaded always return application/octet-stream
		// regardless od the actual file type
		$info		= getimagesize( $imageFile['tmp_name'] );
		
		if( !cValidImage( $imageFile['tmp_name'] ) )
		{
			echo JText::_('CC IMAGE FILE NOT SUPPORTED');
			return;
		}

		$albumId		= JRequest::getVar( 'albumid' , '' , 'REQUEST' );
		$isDefault		= JRequest::getVar( 'default' , '' , 'POST');

		// Load up required models and properties
		CFactory::load( 'libraries' , 'avatar' );
		CFactory::load( 'models' , 'photos' );
		
		$album			=& JTable::getInstance( 'Album' , 'CTable' );
		$album->load( $albumId );
		
		if( $album->type == PHOTOS_GROUP_TYPE )
		{
			CFactory::load( 'models' , 'groups' );
			$group		=& JTable::getInstance( 'Group' , 'CTable' );
			$group->load( $album->groupid );
			
			if( $my->id != $album->creator && !$group->isAdmin( $my->id ) )
			{
				echo JText::_('CC INVALID ALBUM');
				return;
			}
		}


		// Load configurations.
		$config			=& CFactory::getConfig();
		
		// Hash the file name
		$fileName		= JUtility::getHash( $imageFile['tmp_name'] . time() );
		$hashFilename	= JString::substr( $fileName , 0 , 24 );
		$imgType		= image_type_to_mime_type($info[2]);
		
		// Load the tables
		$photo		=& JTable::getInstance( 'Photo' , 'CTable' );

		$storage		= JPATH_ROOT . DS . 'images';		
		$albumPath		= (empty($album->path)) ? '' : $album->id . DS;
		CFactory::load( 'helpers' , 'limits' );
		
		// @todo: configurable path?
		switch( $album->type )
		{
			case PHOTOS_GROUP_TYPE:
				CFactory::load( 'models' , 'groups' );
				$group			=& JTable::getInstance( 'Group' , 'CTable' );
				$group->load( $album->groupid );

				// @rule: Just in case user tries to exploit the system, we should prevent this from even happening.
				if( cExceededPhotoUploadLimit( $group->id , PHOTOS_GROUP_TYPE ) )
				{
					$config			=& CFactory::getConfig();
					$photoLimit		= $config->get( 'groupphotouploadlimit' );
					
					echo JText::sprintf('CC GROUP PHOTO UPLOAD LIMIT REACHED',$photoLimit);
					return;
				}

				$originalPath	= $storage . DS . JPath::clean( $config->get('originalphotopath') ) . DS . 'groupphotos' . DS . $group->id . DS . $albumPath . $hashFilename . cImageTypeToExt($imgType);
				$storedPath		= $storage . DS . 'groupphotos' . DS . $group->id . DS . $albumPath . $hashFilename . cImageTypeToExt($imageFile['type']);
				$thumbPath		= $storage . DS . 'groupphotos' . DS . $group->id . DS . $albumPath .'thumb_' . $hashFilename . cImageTypeToExt($imageFile['type']);
				$locationPath	= $storage . DS . 'groupphotos' . DS . $group->id . DS . $album->id;
				$originalGroupPhotos	= $storage . DS . JPath::clean( $config->get('originalphotopath') ) . DS . 'groupphotos' . DS . $group->id . DS . $albumPath;
		
				if( !JFolder::exists( $originalGroupPhotos) )
				{
					if( ! JFolder::create( $originalGroupPhotos , (int) octdec( $config->get('folderpermissionsphoto') ) ) )
					{
						echo JText::_('CC ERROR CREATING USERS PHOTO FOLDER');
						exit;
					}
				}
				break;
			default:
				// @rule: Just in case user tries to exploit the system, we should prevent this from even happening.
				if( cExceededPhotoUploadLimit($my->id , PHOTOS_USER_TYPE ) )
				{
					$config			=& CFactory::getConfig();
					$photoLimit		= $config->get( 'photouploadlimit' );
					
					echo JText::sprintf('CC PHOTO UPLOAD LIMIT REACHED' , $photoLimit );
					exit;
				}
				
				$originalPath	= $storage . DS . JPath::clean( $config->get('originalphotopath') ) . DS . $my->id . DS . $albumPath . $hashFilename . cImageTypeToExt($imgType);
				$storedPath		= $storage . DS . 'photos' . DS . $my->id . DS . $albumPath . $hashFilename . cImageTypeToExt($imageFile['type']);
				$thumbPath		= $storage . DS . 'photos' . DS . $my->id . DS . $albumPath .'thumb_' . $hashFilename . cImageTypeToExt($imageFile['type']);
				$locationPath	= (empty($albumPath)) ? $storage . DS . 'photos' . DS . $my->id : $storage . DS . 'photos' . DS . $my->id . DS . $album->id;
				$originalUserPhotos	= $storage . DS . JPath::clean( $config->get('originalphotopath') ) . DS . $my->id . DS . $albumPath;
				
				if( !JFolder::exists( $originalUserPhotos) )
				{
					if( ! JFolder::create( $originalUserPhotos , (int) octdec( $config->get('folderpermissionsphoto') ) ) )
					{
						echo JText::_('CC ERROR CREATING USERS PHOTO FOLDER');
						exit;
					}
				}
				break;
		}

		if( !JFolder::exists( $locationPath ) )
		{
			if( ! JFolder::create( $locationPath, (int) octdec( $config->get('folderpermissionsphoto') ) ) )
			{
				echo JText::_('CC ERROR CREATING USERS PHOTO FOLDER');
				exit;
			}
		}

		cImageCreateThumb( $imageFile['tmp_name'] , $thumbPath , $imgType );
		
		// Original photo need to be kept to make sure that, the gallery works
		$useAlbumId	= (empty($album->path)) ? 0 : $album->id;
		$this->_storeOriginal($imageFile['tmp_name'] , $originalPath, $useAlbumId );
		$photo->original	= JString::str_ireplace( JPATH_ROOT . DS , '' , $originalPath );

		// Set photos properties
		$photo->albumid		= $albumId;
		$photo->caption		= $imageFile['name'];
		$photo->creator		= $my->id;
		$photo->created		= gmdate('Y-m-d H:i:s');
		
		// Remove the filename extension from the caption
		if(JString::strlen($photo->caption) > 4) {
			$photo->caption = JString::substr($photo->caption, 0 , JString::strlen($photo->caption) - 4);
		}
		
		// @todo: configurable options?
		// Permission should follow album permission
		$photo->published	= '1';
		$photo->permissions	= $album->permissions;

		// Set the relative path.
		// @todo: configurable path?
		$photo->image		= JString::str_ireplace( JPATH_ROOT . DS , '' , $storedPath ); 
		$photo->thumbnail	= JString::str_ireplace( JPATH_ROOT . DS , '' , $thumbPath );
		
		//photo filesize, use sprintf to prevent return of unexpected results for large file.
		$photo->filesize = sprintf("%u", filesize($originalPath));
		
		// Store the object
		$photo->store();

		// Set image as default if necessary
		// Load photo album table
		if( $isDefault )
		{
			// Set the photo id
			$album->photoid	= $photo->id;
			$album->store();
		}

		// @rule: Set first photo as default album cover if enabled
		if( !$isDefault && $config->get('autoalbumcover') )
		{
			$photosModel	=& CFactory::getModel( 'Photos' );
			$totalPhotos	= $photosModel->getTotalPhotos( $album->id );
			
			if( $totalPhotos <= 1 )
			{
				$album->photoid	= $photo->id;
				$album->store();
			}
		}
		
		// Build URL
		CFactory::load( 'helpers' , 'url' );

		// Build URL
		switch( $album->type )
		{
			case PHOTOS_GROUP_TYPE:
				$url 		= CRoute::_('index.php?option=com_community&view=photos&task=photo&albumid=' . $albumId .  '&groupid=' . $album->groupid . '#photoid=' . $photo->id);
				$albumUrl	= CRoute::_('index.php?option=com_community&view=photos&task=album&albumid=' . $albumId .  '&groupid=' . $album->groupid );

				if( $group->approvals == COMMUNITY_PUBLIC_GROUP )
				{
			 		$params = new JParameter('');
			 		$params->set('url'		, $url );
			 		$params->set('multiUrl'	, $albumUrl );
					$params->set('albumid'	, $album->id );
					$param->set( 'action', 'upload' );
					
					$act = new stdClass();
					$act->cmd 		= 'photo.upload';
					$act->actor   	= $my->id;
					$act->target  	= 0;
					$act->title	  	= JText::sprintf('CC ACTIVITIES GROUP UPLOAD PHOTO' , $albumUrl , $album->name );
					$act->content	= '';
					$act->app		= 'photos';
					$act->cid		= $albumId;
							
					// Add activity logging
					CFactory::load ( 'libraries', 'activities' );
					CActivityStream::add( $act , $params->toString() );
				}
									
				break;
			default:
				$url 		= CRoute::_('index.php?option=com_community&view=photos&task=photo&albumid=' . $albumId .  '&userid=' . $my->id . '#photoid=' . $photo->id);
				$albumUrl	= CRoute::_('index.php?option=com_community&view=photos&task=album&albumid=' . $albumId .  '&userid=' . $my->id);

		 		$params = new JParameter('');
		 		$params->set('url'		, $url );
		 		$params->set('multiUrl'	, $albumUrl );
				$params->set('albumid'	, $album->id );
		
				$act = new stdClass();
				$act->cmd 		= 'photo.upload';
				$act->actor   	= $my->id;
				$act->target  	= 0;
				$act->title	  	= JText::sprintf('CC ACTIVITIES UPLOAD PHOTO' , $albumUrl , $album->name );
				$act->content	= '<img src="' . $photo->getThumbURI() . '" style=\"border: 1px solid #eee;margin-right: 3px;" />';
				$act->app		= 'photos';
				$act->cid		= $albumId;
						
				// Add activity logging
				CFactory::load ( 'libraries', 'activities' );
				CActivityStream::add( $act , $params->toString() );
				break;
		}
		
		//add user points
		CFactory::load( 'libraries' , 'userpoints' );		
		CUserPoints::assignPoint('photo.upload');
	}
	

	/**
	 * Display all photos from the current album
	 *	 
	 **/	 		
	function album()
	{
		$document 	=& JFactory::getDocument();
		$viewType	= $document->getType();	
 		$viewName	= JRequest::getCmd( 'view', $this->getName() );
 		$view		=& $this->getView( $viewName , '' , $viewType );
		if($this->checkPhotoAccess())
			echo $view->get( __FUNCTION__ );
	}

	/**
	 * Displays the photo
	 *	 
	 **/
	function photo()
	{
		$document 	=& JFactory::getDocument();
		$viewType	= $document->getType();	
 		$viewName	= JRequest::getCmd( 'view', $this->getName() );
 		$view		=& $this->getView( $viewName , '' , $viewType );
		
		if($this->checkPhotoAccess())				
			echo $view->get( __FUNCTION__ );
	}
	
	/**
	 * Method to edit an album
	 **/
	function editAlbum()
	{
		if ($this->blockUnregister()) return;
		
		// Make sure the user has permission to edit any this photo album
		$my = CFactory::getUser();
		
		// Load models, libraries
		CFactory::load( 'models' , 'photos' );
		CFactory::load( 'helpers' , 'url' );
		$albumid	= JRequest::getVar( 'albumid' , '' , 'GET' );
		
		$album		=& JTable::getInstance( 'Album' , 'CTable' );
		$album->load($albumid);
				
		if($album->type == PHOTOS_GROUP_TYPE)
		{
			CFactory::load( 'models' , 'groups' );			
			$groupId = JRequest::getVar( 'groupid' , '' , 'REQUEST' );
			$group =& JTable::getInstance( 'Group' , 'CTable' );
			$group->load( $groupId );
			
			if($album->creator != $my->id && !isCommunityAdmin() && !$group->isAdmin( $my->id ))
			{
				$this->blockUserAccess();
				return true;
			}
		}
		else
		{
			if($album->creator != $my->id && !isCommunityAdmin())
			{
				$this->blockUserAccess();
				return true;
			}
		}
		
		$document 	=& JFactory::getDocument();
		$viewType	= $document->getType();	
 		$viewName	= JRequest::getCmd( 'view', $this->getName() );
 		$view		=& $this->getView( $viewName , '' , $viewType );

 		if( JRequest::getMethod() == 'POST' )
 		{
 			$mainframe =& JFactory::getApplication();
			$albumid	= JRequest::getVar( 'albumid' , '' , 'POST' );
			$type		= JRequest::getVar( 'type' , '' , 'POST');

			$album		= $this->_saveAlbum( $albumid );

			// Redirect user to upload a photo
			switch($type)
			{
				case PHOTOS_GROUP_TYPE:
					$url	= CRoute::_('index.php?option=com_community&view=photos&groupid=' . $album->groupid , false );
					break;
				default:
					$url	= CRoute::_('index.php?option=com_community&view=photos&task=myphotos&userid=' . $album->creator , false);
					break;
			}
			$mainframe->redirect( $url , JText::_('CC ALBUM EDITED'));
		}
		
		if($this->checkPhotoAccess())
		{	
 			echo $view->get( __FUNCTION__ );
 		}
	}

	/**
	 * Controller method to remove an album
	 **/
	function removealbum()
	{
		if ($this->blockUnregister()) return;
		
		// Get the album id.
		$my			= CFactory::getUser();
		$id			= JRequest::getInt( 'albumid' , '' );
		$task		= JRequest::getCmd( 'currentTask' , '' );
		
		// Load libraries
		CFactory::load( 'models' , 'photos' );
		CFactory::load( 'libraries' , 'activities' );
		$album	=& JTable::getInstance( 'Album' , 'CTable' );
		$album->load( $id );

		CFactory::load( 'helpers' , 'owner' );
		
		// Test if user is really the owner and album really exists
		if( $album->type == PHOTOS_GROUP_TYPE )
		{
			CFactory::load( 'models' , 'groups' );
			
			$group	=& JTable::getInstance( 'Group', 'CTable');
			$group->load( $album->creator );
			
			CFactory::load( 'helpers' , 'group' );			
			$allowManagePhotos = cAllowManagePhoto($album->groupid);
			
			if( !$group->isAdmin($my->id) && !isCommunityAdmin() && !($allowManagePhotos && $my->id == $album->creator) )
			{
				echo JText::_('CC INVALID ALBUM');
				return;
			}
		}
		else
		{
			if( ( ($my->id != $album->creator) && !isCommunityAdmin() ) || ($album->id == 0) )
			{
				$this->blockUserAccess();
				return;
			}
		}
		$model	=& CFactory::getModel( 'photos' );

		if( $album->delete() )
		{
			// @rule: remove from featured item if item is featured
			CFactory::load( 'libraries' , 'featured' );
			$featured	= new CFeatured( FEATURED_ALBUMS );
			$featured->delete( $album->id );
			
			//add user points
			CFactory::load( 'libraries' , 'userpoints' );		
			CUserPoints::assignPoint('album.remove');
			
			// Remove from activity stream
			CActivityStream::remove('photos', $id);
		
			$mainframe =& JFactory::getApplication();
			
			$task		= ( !empty( $task ) ) ? '&task=' . $task : '';
			
			if($album->type == PHOTOS_GROUP_TYPE)
			{
				$url		= CRoute::_('index.php?option=com_community&view=photos' . $task . '&groupid=' . $album->groupid , false );
			}
			else
			{
				$url		= CRoute::_('index.php?option=com_community&view=photos' . $task . '&userid=' . $my->id , false );
			}
			$message	= JText::sprintf('CC ALBUM REMOVED' , $album->name);
			$mainframe->redirect( $url , $message);
		}
	}
	
	function showimage()
	{
		jimport('joomla.filesystem.file');
		$imgid 		= JRequest::getVar('imgid', '', 'GET');
		$maxWidth 	= JRequest::getVar('maxW', '', 'GET');
		$maxHeight	= JRequest::getVar('maxH', '', 'GET');
		
		// round up the w/h to the nearest 10
		$maxWidth	= round($maxWidth, -1);
		$maxHeight	= round($maxHeight, -1); 
		
		$photoModel		=& CFactory::getModel('photos');
		$photo			=& JTable::getInstance( 'Photo' , 'CTable' );
		$photo->loadFromImgPath( $imgid );

		CFactory::load('helpers', 'image');

		if(!JFile::exists (JPATH_ROOT . DS .$photo->image))
		{
			$config			= CFactory::getConfig($photo->image);
			$displyWidth	= $config->getInt('photodisplaysize');
			$info			= getimagesize( JPATH_ROOT . DS . $photo->original );
    		$imgType		= image_type_to_mime_type($info[2]);
    		$displyWidth 	= ($info[0] < $displyWidth) ? $info[0] : $displyWidth;
    		
			cImageResizePropotional( JPATH_ROOT . DS . $photo->original, JPATH_ROOT . DS . $photo->image, $imgType, $displyWidth);
		}
		
		$info	= getimagesize( JPATH_ROOT . DS .$photo->image );

		// @rule: Clean whitespaces as this might cause errors when header is used.
		$ob_active = ob_get_length () !== FALSE;

		if($ob_active)
		{
			while (@ ob_end_clean());
				if(function_exists('ob_clean'))
				{
					@ob_clean();
				}
		}
			
		header('Content-type: '.$info['mime']);
		echo JFile::read( JPATH_ROOT . DS .$photo->image );
		exit;
	}
	

	
	function uploader()
	{
		$document 	=& JFactory::getDocument();
		$viewType	= $document->getType();	
 		$viewName	= JRequest::getCmd( 'view', $this->getName() );
 		$view		=& $this->getView( $viewName , '' , $viewType );
 		$my			= CFactory::getUser();
		
		// If user is not logged in, we shouldn't really let them in to this page at all.
		if ($this->blockUnregister()) return;
		
		// Load models, libraries
		CFactory::load( 'models' , 'photos' );
		CFactory::load( 'helpers' , 'url' );
		$albumid	= JRequest::getVar( 'albumid' , '' , 'GET' );
		
		if(! empty($albumid) ){
			$album		=& JTable::getInstance( 'Album' , 'CTable' );
			$album->load($albumid);
			if($album->creator != $my->id && !isCommunityAdmin())
			{
				$this->blockUserAccess();
				return true;
			}
		}
		
		$groupId=JRequest::getVar('groupid', '0');
		if(!empty($groupId))
		{
			CFactory::load( 'helpers' , 'group' );			
			$allowManagePhotos = cAllowManagePhoto($groupId);
			CError::assert($allowManagePhotos, '', '!empty', __FILE__ , __LINE__ );
		}
		
		if($this->checkPhotoAccess())
 			echo $view->get( __FUNCTION__ );
	}
	
	function checkPhotoAccess()
	{
		$mainframe =& JFactory::getApplication();
		$config =& CFactory::getConfig();
		
 		if(! $config->get('enablephotos'))
		 { 			
 			$mainframe->enqueueMessage(JText::_('CC MEDIA DISABLE'), '');
 			return false;
 		}
		return true;
	}
	

	
	function jsonupload()
	{
		// First we try to get the user object.
		if ($this->blockUnregister()) return;
		
		$my			= CFactory::getUser();

		// Load up required models and properties
		CFactory::load( 'models' , 'photos' );
		CFactory::load('helpers', 'image');					

		// Load configurations.
		$config			=& CFactory::getConfig();		

		$photos		= JRequest::get('Files');
		$nextUpload	= JRequest::getVar('nextupload' , '' , 'GET');
		
		foreach( $photos as $imageFile )
		{

			if( empty($imageFile['tmp_name'] ) )
			{
				$this->_outputJSONText( true , JText::_('CC IMAGE FILE NOT SUPPORTED') , $nextUpload );
			}
			
			$uploadLimit	= (double) $config->get('maxuploadsize');
			$uploadLimit	= ( $uploadLimit * 1024 * 1024 );

			if( filesize( $imageFile['tmp_name'] ) > $uploadLimit )
			{
				$this->_outputJSONText( true , JText::_('CC IMAGE FILE SIZE EXCEEDED') , $nextUpload );
			}

                        if( !cValidImageType( $imageFile['type'] ) )
                        {
                                $this->_outputJSONText( true , JText::_('CC IMAGE FILE NOT SUPPORTED') , $nextUpload );
                        }
			
			if( !cValidImage( $imageFile['tmp_name'] ) )
			{
				$this->_outputJSONText( true , JText::_('CC IMAGE FILE NOT SUPPORTED') , $nextUpload );
			}

			// We need to read the filetype as uploaded always return application/octet-stream
			// regardless od the actual file type
			$info			= getimagesize( $imageFile['tmp_name'] );				
			$albumId		= JRequest::getVar( 'albumid' , '' , 'REQUEST' );
			$isDefaultPhoto	= JRequest::getVar( 'defaultphoto' , false , 'REQUEST' );

			$album			=& JTable::getInstance( 'Album' , 'CTable' );
			$album->load( $albumId );

			if( $album->id == 0 || ( ($my->id != $album->creator ) && $album->type != PHOTOS_GROUP_TYPE ) )
			{
				$this->_outputJSONText( true , JText::_('CC INVALID ALBUM') , $nextUpload );
			}
			
			if( $album->type == PHOTOS_GROUP_TYPE )
			{
				CFactory::load( 'models' , 'groups' );
				$group		=& JTable::getInstance( 'Group' , 'CTable' );
				$group->load( $album->groupid );
				
				if( $my->id != $album->creator && !$group->isAdmin( $my->id ) )
				{
					$this->_outputJSONText( true , JText::_('CC INVALID ALBUM') , $nextUpload );
				}
			}

			// Hash the image file name so that it gets as unique possible
			$fileName		= JUtility::getHash( $imageFile['tmp_name'] . time() );
			$hashFilename	= JString::substr( $fileName , 0 , 24 );
			$imgType		= image_type_to_mime_type($info[2]);
			
			// Load the tables
			$photoTable		=& JTable::getInstance( 'Photo' , 'CTable' );

			// @todo: configurable paths?
			$storage		= JPATH_ROOT . DS . 'images';
			$albumPath		= (empty($album->path)) ? '' : $album->id . DS;

			// Test if the photos path really exists.
			jimport('joomla.filesystem.file');
			jimport('joomla.filesystem.folder');
			CFactory::load( 'helpers' , 'limits' );
			
			switch( $album->type )
			{
				case PHOTOS_GROUP_TYPE:
					CFactory::load( 'models' , 'groups' );
					$group			=& JTable::getInstance( 'Group' , 'CTable' );
					$group->load( $album->groupid );

					// @rule: Just in case user tries to exploit the system, we should prevent this from even happening.
					if( cExceededPhotoUploadLimit( $group->id , PHOTOS_GROUP_TYPE ) )
					{
						$config			=& CFactory::getConfig();
						$photoLimit		= $config->get( 'groupphotouploadlimit' );
						
						echo JText::sprintf('CC GROUP PHOTO UPLOAD LIMIT REACHED' , $photoLimit );
						return;
					}
					
					$originalPath	= $storage . DS . JPath::clean( $config->get('originalphotopath') ) . DS . 'groupphotos' . DS . $group->id . DS . $albumPath . $hashFilename . cImageTypeToExt($imgType);
					$storedPath		= $storage . DS . 'groupphotos' . DS . $group->id . DS . $albumPath . $hashFilename . cImageTypeToExt($imageFile['type']);
					$thumbPath		= $storage . DS . 'groupphotos' . DS . $group->id . DS . $albumPath .'thumb_' . $hashFilename . cImageTypeToExt($imageFile['type']);
					$locationPath	= $storage . DS . 'groupphotos' . DS . $group->id . DS . $album->id;
					$originalGroupPhotos	= $storage . DS . JPath::clean( $config->get('originalphotopath') ) . DS . 'groupphotos' . DS . $group->id . DS . $albumPath;
			
					if( !JFolder::exists( $originalGroupPhotos) )
					{
						if( ! JFolder::create( $originalGroupPhotos , (int) octdec( $config->get('folderpermissionsphoto') ) ) )
						{
							$this->_outputJSONText( true , JText::_('CC ERROR CREATING USERS PHOTO FOLDER') , $nextUpload );
						}
					}
					break;
				default:
					// @rule: Just in case user tries to exploit the system, we should prevent this from even happening.
					if( cExceededPhotoUploadLimit($my->id , PHOTOS_USER_TYPE) )
					{
						$config			=& CFactory::getConfig();
						$photoLimit		= $config->get( 'photouploadlimit' );
						
						$this->_outputJSONText( true , JText::sprintf('CC PHOTO UPLOAD LIMIT REACHED' , $photoLimit ) , $nextUpload );
						return;
					}
					$originalPath	= $storage . DS . JPath::clean( $config->get('originalphotopath') ) . DS . $my->id . DS . $albumPath . $hashFilename . cImageTypeToExt($imgType);
					$storedPath		= $storage . DS . 'photos' . DS . $my->id . DS . $albumPath . $hashFilename . cImageTypeToExt($imageFile['type']);
					$thumbPath		= $storage . DS . 'photos' . DS . $my->id . DS . $albumPath .'thumb_' . $hashFilename . cImageTypeToExt($imageFile['type']);
					$locationPath	= (empty($albumPath)) ? $storage . DS . 'photos' . DS . $my->id : $storage . DS . 'photos' . DS . $my->id . DS . $album->id;
					$originalUserPhotos	= $storage . DS . JPath::clean( $config->get('originalphotopath') ) . DS . $my->id . DS . $albumPath;
					
					if( !JFolder::exists( $originalUserPhotos) )
					{
						if( ! JFolder::create( $originalUserPhotos , (int) octdec( $config->get('folderpermissionsphoto') ) ) )
						{
							$this->_outputJSONText( true , JText::_('CC ERROR CREATING USERS PHOTO FOLDER') , $nextUpload );
						}
					}
					break;
			}

			if( !JFolder::exists( $locationPath ) )
			{
				if( ! JFolder::create( $locationPath, (int) octdec( $config->get('folderpermissionsphoto') ) ) )
				{
					$this->_outputJSONText( true , JText::_('CC ERROR CREATING USERS PHOTO FOLDER') , $nextUpload );
				}
			}
			 
			cImageCreateThumb( $imageFile['tmp_name'] , $thumbPath , $imgType );
			
			// Original photo need to be kept to make sure that, the gallery works
			$useAlbumId	= (empty($album->path)) ? 0 : $album->id;
			$this->_storeOriginal($imageFile['tmp_name'] , $originalPath, $useAlbumId);
			$photoTable->original		= JString::str_ireplace( JPATH_ROOT . DS , '' , $originalPath );
	
			// Set photos properties
			$photoTable->albumid		= $albumId;
			$photoTable->caption		= $imageFile['name'];
			$photoTable->creator		= $my->id;
			$photoTable->created		= gmdate('Y-m-d H:i:s');
			
			// Remove the filename extension from the caption
			if(JString::strlen($photoTable->caption) > 4)
			{
				$photoTable->caption = JString::substr($photoTable->caption, 0 , JString::strlen($photoTable->caption) - 4);
			}
			
			// @todo: configurable options?
			// Permission should follow album permission
			$photoTable->published		= '1';
			$photoTable->permissions	= $album->permissions;
	
			// Set the relative path.
			// @todo: configurable path?
			$photoTable->image		= JString::str_ireplace( JPATH_ROOT . DS , '' , $storedPath ); 
			$photoTable->thumbnail	= JString::str_ireplace( JPATH_ROOT . DS , '' , $thumbPath );
			
			//photo filesize, use sprintf to prevent return of unexpected results for large file.
			$photoTable->filesize = sprintf("%u", filesize($originalPath));
			
			// Store the object
			$photoTable->store();
	
			// Set image as default if necessary
			// Load photo album table
			
			if( $isDefaultPhoto )
			{
				// Set the photo id
				$album->photoid	= $photoTable->id;
 				$album->store();
			}

			// @rule: Set first photo as default album cover if enabled
			if( !$isDefaultPhoto && $config->get('autoalbumcover') )
			{
				$photosModel	=& CFactory::getModel( 'Photos' );
				$totalPhotos	= $photosModel->getTotalPhotos( $album->id );

				if( $totalPhotos <= 1 )
				{
					$album->photoid	= $photoTable->id;
					$album->store();
				}
			}
			
			// Build URL
			switch( $album->type )
			{
				case PHOTOS_GROUP_TYPE:
					$url 		= CRoute::_('index.php?option=com_community&view=photos&task=photo&albumid=' . $albumId .  '&groupid=' . $album->groupid . '#photoid=' . $photoTable->id);
					$albumUrl	= CRoute::_('index.php?option=com_community&view=photos&task=album&albumid=' . $albumId .  '&groupid=' . $album->groupid );

					if( $group->approvals == COMMUNITY_PUBLIC_GROUP )
					{
				 		$params = new JParameter('');
				 		$params->set('url'		, $url );
				 		$params->set('multiUrl'	, $albumUrl );
						
						$act = new stdClass();
						$act->cmd 		= 'photo.upload';
						$act->actor   	= $my->id;
						$act->target  	= 0;
						$act->title	  	= JText::sprintf('CC ACTIVITIES GROUP UPLOAD PHOTO' , $albumUrl , $album->name );
						$act->content	= '<img src="' . rtrim( JURI::root() , '/' ) . '/' . $photoTable->thumbnail . '" style="border: 1px solid #eee;margin-right: 3px;" />';
						$act->app		= 'photos';
						$act->cid		= $albumId;
								
						// Add activity logging
						CFactory::load ( 'libraries', 'activities' );
						CActivityStream::add( $act , $params->toString() );
					}
										
					break;
				default:
					if( $album->permissions <= PRIVACY_PUBLIC )
					{
						$url 		= CRoute::_('index.php?option=com_community&view=photos&task=photo&albumid=' . $albumId .  '&userid=' . $my->id . '#photoid=' . $photoTable->id);
						$albumUrl	= CRoute::_('index.php?option=com_community&view=photos&task=album&albumid=' . $albumId .  '&userid=' . $my->id);
	
				 		$params = new JParameter('');
				 		$params->set('url'		, $url );
				 		$params->set('multiUrl'	, $albumUrl );
				
						$act = new stdClass();
						$act->cmd 		= 'photo.upload';
						$act->actor   	= $my->id;
						$act->target  	= 0;
						$act->title	  	= JText::sprintf('CC ACTIVITIES UPLOAD PHOTO' , $albumUrl , $album->name );
						$act->content	= '<img src="' . rtrim( JURI::root() , '/' ) . '/' . $photoTable->thumbnail . '" style=\"border: 1px solid #eee;margin-right: 3px;" />';
						$act->app		= 'photos';
						$act->cid		= $albumId;
								
						// Add activity logging
						CFactory::load ( 'libraries', 'activities' );
						CActivityStream::add( $act , $params->toString() );
					}
					break;
			}
			
			//add user points
			CFactory::load( 'libraries' , 'userpoints' );		
			CUserPoints::assignPoint('photo.upload');

			// Photo upload was successfull, display a proper message
			$this->_outputJSONText( false , JText::sprintf('CC PHOTO UPLOADED SUCCESSFULLY', $photoTable->caption ) , $nextUpload );
		}		
		exit;
	}
	

}
