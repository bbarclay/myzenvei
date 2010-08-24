<?php
/**
 * @author     GeoXeo <contact@geoxeo.com>
 * @link       http://www.geoxeo.com
 * @copyright  Copyright (C) 2010 GeoXeo - All Rights Reserved
 * @license    http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 * 
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

class comContentTrailHelper
{
	/**
	 * At the moment we just append the request parms
	 * We should remove duplicate parms (in non SEF mode) to avoid things like: view=article&view=category
	 */
	function _buildLink($parms) 
	{
		$url = JURI::getInstance()->toString();
		if(strpos($url, '?') === false) {
			$url .= '?' . $parms;
		}
		else {
			$url .= '&' . $parms;
		}
		
		return $url;
	}
	
	function getList(&$params)
	{
		// get current request parms
		$option = JRequest::getCmd('option');
		$id = JRequest::getVar('id');
		$view = JRequest::getCmd('view');
		$items = array();
		
		// this is a com_content-only feature
		if($option != 'com_content') {
			return $items;
		}
		
		// get config
		$selectedSections = $params->get('sections', -2);  // -1: all, 0: uncategorized
		if(!is_array($selectedSections)) {
			if($selectedSections == -2) {
				// no config: don't process
				return $items;
			}
			$selectedSections = array(0 => $selectedSections);
		}
		$selectedItemid = $params->get('itemid', '');
		if($selectedItemid == '') {
			$itemid = JRequest::getInt('Itemid',0);
			if($itemid) {
				$selectedItemid = $itemid;
			}
			else {
				$selectedItemid = '';
			}
		}
		$layout = $params->get('layout', 0) == 0 ? '' : '&layout=blog';

		// create breadcrumbs
		$db = JFactory::getDBO();
		if($view == 'section') {
			$db->setQuery('SELECT title FROM #__sections WHERE id = '.(int) $id);
			$result = $db->loadResult();
			if($selectedSections[0] == -1 || false !== array_search($id, $selectedSections)) {
				$item = (object) array('name' => $result);
				$items[] = $item;	
			}
		}
		else if($view == 'category') {
			$query = 'SELECT c.title as title, s.id as sectionid, s.title as sectiontitle' .
					' FROM #__categories AS c' .
					' INNER JOIN #__sections AS s ON s.id = c.section' .
					' WHERE c.id = '. (int) $id;
			$db->setQuery($query, 0, 1);
			$result = $db->loadObject();
			if($selectedSections[0] == -1 || ($result !== null && false !== array_search($result->sectionid, $selectedSections))) {
				$link = comContentTrailHelper::_buildLink('view=section&id='.$result->sectionid.$layout);
				$item = (object) array('name' => $result->sectiontitle, 'link' => $link);
				$items[] = $item;	
				$item = (object) array('name' => $result->title);
				$items[] = $item;	
			}
		} 
		else if($view == 'article') {
			$query = 'SELECT a.title as title, c.title as cattitle, c.id as catid, s.id as sectionid, s.title as sectiontitle' .
					' FROM #__content AS a' .
					' INNER JOIN #__categories AS c on c.id = a.catid' .
					' INNER JOIN #__sections AS s ON s.id = a.sectionid' .
					' WHERE a.id = '. (int) $id;
			$db->setQuery($query, 0, 1);
			$result = $db->loadObject();
			if($selectedSections[0] == -1 || ($result !== null && false !== array_search($result->sectionid, $selectedSections))) {
				$link = comContentTrailHelper::_buildLink('view=section&id='.$result->sectionid.$layout);
				$item = (object) array('name' => $result->sectiontitle, 'link' => $link);
				$items[] = $item;	
				$link = comContentTrailHelper::_buildLink('view=category&id='.$result->catid.$layout);
				$item = (object) array('name' => $result->cattitle, 'link' => $link);
				$items[] = $item;	
				$item = (object) array('name' => $result->title);
				$items[] = $item;
			}	
		}
		
		return $items;
	}	
}