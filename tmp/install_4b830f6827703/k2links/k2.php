<?php
/**
* @copyright    Copyright (C) 2009 Nicholas K. Dionysopoulos. All rights reserved.
* @author		Nicholas K. Dionysopoulos
* @license      GNU/GPL v.2 or later
* K2Links is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
*
* Based on "joomlalinks" found in JCE's core distribution. Modified by Nicholas K. Dionysopoulos
* to support JoomlaWork's K2
*/
// no direct access
defined('_JCE_EXT') or die('Restricted access');

class AdvlinkK2 
{
	function getOptions()
	{
		$advlink =& AdvLink::getInstance();
		$list = '';
		if ($advlink->checkAccess('advlink_k2content', '1')) {
			$list = '<li id="index.php?option=com_k2"><div class="tree-row"><div class="tree-image"></div><span class="folder content nolink"><a href="javascript:;">' . JText::_('K2 Content') . '</a></span></div></li>';
		}
		return $list;	
	}
	
	function _getK2Categories($parent_id = 0)
	{
		$db		=& JFactory::getDBO();
		$user	=& JFactory::getUser();

		$query = 'SELECT id, name, alias'
		. ' FROM #__k2_categories'
		. ' WHERE published = 1'
		. ' AND access <= '.(int) $user->get('aid')
		. ' AND parent = '.$db->Quote($parent_id)
		. ' ORDER BY ordering ASC'
		;

		$db->setQuery($query);
		return $db->loadObjectList();
	}
	
	function _getK2Items($category_id = 0)
	{
		$db		=& JFactory::getDBO();
		$user	=& JFactory::getUser();

		$query = 'SELECT id, title, alias'
		. ' FROM #__k2_items'
		. ' WHERE published = 1'
		. ' AND access <= '.(int) $user->get('aid')
		. ' AND catid = '.$db->Quote($category_id)
		. ' ORDER BY ordering ASC'
		;

		$db->setQuery($query);
		return $db->loadObjectList();
	}
	
	/** I HAVE NOT MODIFIED BELOW THIS LINE **/
	
	function getItems($args)
	{		
		global $mainframe;	
		
		$advlink =& AdvLink::getInstance();
		
		require_once(JPATH_SITE .DS. 'components' .DS. 'com_k2' .DS. 'helpers' .DS. 'route.php');

		$items 		= array();
		$view		= isset($args->view) ? $args->view : '';
		
		switch ($view) {
		
		default:
			$categories	= AdvlinkK2::_getK2Categories();
			foreach ($categories as $category) {
				$items[] = array(
					'id'		=>	K2HelperRoute::getCategoryRoute($category->id),
					'name'		=>	$category->name,
					'class'		=>	'folder content'
				);
			}
			break;
			
		case 'itemlist':
			$categories	= AdvlinkK2::_getK2Categories($args->id);
			$itemlist = AdvlinkK2::_getK2Items($args->id);
			foreach ($categories as $category) {
				$items[] = array(
					'id'		=>	K2HelperRoute::getCategoryRoute($category->id),
					'name'		=>	$category->name,
					'class'		=>	'folder content'
				);
			}
			foreach ($itemlist as $item) {
				$items[] = array(
					'id'		=>	K2HelperRoute::getItemRoute($item->id, $args->id),
					'name'		=>	$item->title,
					'class'		=>	'file'
				);
			}
			break;
			
		case 'item':
			break;
		}
		return $items;
	}
}
?>