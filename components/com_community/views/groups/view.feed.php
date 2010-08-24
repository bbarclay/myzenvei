<?php
/**
 * @copyright (C) 2008 by Slashes & Dots Sdn Bhd - All rights reserved!
 * @license http://www.jomsocial.com Copyrighted Commercial Software
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

class CommunityViewGroups extends CommunityView
{
	/**
	 * Display a list of bulletins from the specific group
	 **/
	function viewbulletins()
	{
		$mainframe  = JFactory::getApplication();
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
		$bulletins		= $model->getBulletins( $group->id, $mainframe->getCfg('feed_limit') );
		
		$jConfig		=& JFactory::getConfig();
		
		// Get the creator of the bulletins
		for( $i = 0; $i < count( $bulletins ); $i++ )
		{
			$row			=& $bulletins[ $i ];
			$row->creator	= CFactory::getUser( $row->created_by );
			$date		=& JFactory::getDate( $row->date );
			$date->setOffset( $jConfig->getValue('offset') );
			
			$item				= new JFeedItem();
			$item->title 		= $row->title;
			$item->link 		= CRoute::_('index.php?option=com_community&view=photos&task=photo&userid=');
			$item->description 	= $row->message;
			$item->date			= $row->date;

			$document->addItem( $item );
		}
	}
	
	function viewdiscussions()
	{
		$mainframe  = JFactory::getApplication();
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
		$params		= $group->getParams();
		
		//check if group is valid
		if( $group->id == 0 )
		{
			echo JText::_('CC INVALID GROUP ID');
			return;
		}

		// Set page title
		$document->setTitle( JText::sprintf('CC VIEW ALL DISCUSSIONS TITLE' , $group->name ) );

		//display notice if the user is not a member of the group
		if( $group->approvals == 1 && !($group->isMember($my->id) ) && !isCommunityAdmin() )
		{
			echo JText::_('CC PRIVATE GROUP NOTICE');
			return;
		}
		
		$discussions	= $model->getDiscussionTopics( $group->id , $mainframe->getCfg('feed_limit') ,  $params->get('discussordering' , DISCUSSION_ORDER_BYLASTACTIVITY) );

		$jConfig		=& JFactory::getConfig();
		for( $i = 0; $i < count( $discussions ); $i++ )
		{
			$row		=& $discussions[$i];
			$row->user	= CFactory::getUser( $row->creator );
			$date		=& JFactory::getDate( $row->created );
			$date->setOffset( $jConfig->getValue('offset') );
			
			$item				= new JFeedItem();
			$item->title 		= $row->title;
			$item->link 		= CRoute::_('index.php?option=com_community&view=photos&task=photo&userid=');
			$item->description 	= $row->message;
			$item->date			= $date->toFormat();

			$document->addItem( $item );
		}
	}
}