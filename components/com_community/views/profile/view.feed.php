<?php
/**
 * @package	JomSocial
 * @copyright (C) 2008 by Slashes & Dots Sdn Bhd - All rights reserved!
 * @license http://www.jomsocial.com Copyrighted Commercial Software
 */
defined('_JEXEC') or die('Restricted access');
jimport( 'joomla.application.component.view');

class CommunityViewProfile extends CommunityView
{

	/**
	 * Displays the viewing profile page.
	 * 	 	
	 * @access	public
	 * @param	array  An associative array to display the fields
	 */	  	
	function profile(& $data)
	{
		$mainframe		= JFactory::getApplication();
		$friendsModel	=& CFactory::getModel('friends');
		
		$userid		= JRequest::getVar( 'userid' , '' );
		$user		= CFactory::getUser($userid);
		
		$document =& JFactory::getDocument();
		
		$document->setTitle( JText::sprintf( 'CC USERS FEED TITLE' , $user->getDisplayName() ) );
		$document->setDescription( JText::sprintf('CC USERS FEED DESCRIPTION', $user->getDisplayName() , $user->lastvisitDate ) );
		$document->setLink(CRoute::_('index.php?option=com_community&view=profile&userid='.$user->id));
		
		include_once(JPATH_COMPONENT . DS.'libraries'.DS.'activities.php');
		$act = new CActivityStream();
		
		$friendIds	= $friendsModel->getFriendIds($user->id);
		$rows = $act->getFEED($user->id, $friendIds, null, $mainframe->getCfg('feed_limit'));
		
		// add the avatar image
		$rssImage = new JFeedImage();
		$rssImage->url = $user->getThumbAvatar();
		$rssImage->link = CRoute::_('index.php?option=com_community&view=profile&userid='.$user->id);
		$rssImage->width  = 64;
		$rssImage->height = 64;
		$document->image = $rssImage;

		foreach($rows as $row){
			if($row->type != 'title') {
				// load individual item creator class
				$item = new JFeedItem();
				$item->title 		= strip_tags($row->title);
				$item->link 		= '';//$row->link;
				$item->description 	= "<img src=\"{$row->favicon}\" alt=\"\" />&nbsp;".$row->title;
				$item->date			= $row->createdDate;
				$item->category   	= '';//$row->category;
				
				// Make sure url is absolute
				$item->description = JString::str_ireplace('href="/', 'href="'. JURI::base(), $item->description); 
	
				// loads item info into rss array
				$document->addItem( $item );
			}
		}
		
	}
}
?>
