<?php
/**
 * @package	JomSocial
 * @copyright (C) 2008 by Slashes & Dots Sdn Bhd - All rights reserved!
 * @license http://www.jomsocial.com Copyrighted Commercial Software
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

jimport( 'joomla.application.component.view');
jimport( 'joomla.utilities.arrayhelper');

class CommunityViewFrontpage extends CommunityView
{
	function display($data = null){
		$mainframe= JFactory::getApplication();
		$document =& JFactory::getDocument();
		
		$document->setLink(CRoute::_('index.php?option=com_community'));
		
		include_once(JPATH_COMPONENT . DS.'libraries'.DS.'activities.php');
		$act = new CActivityStream();
		
		$rows = $act->getFEED('', '', null, $mainframe->getCfg('feed_limit'));
		
		foreach($rows as $row){
			if($row->type != 'title') {
				// load individual item creator class
				$item = new JFeedItem();
				$item->title 		= strip_tags($row->title);
				$item->link 		= CRoute::_('index.php?option=com_community&view=profile&userid='.$row->actor);
				$item->description 	= "<img src=\"{$act->favicon}\" alt=\"\"/>&nbsp;".$row->title;
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