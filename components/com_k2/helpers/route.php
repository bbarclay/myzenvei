<?php
/**
 * @version		$Id: route.php 303 2010-01-07 02:56:33Z joomlaworks $
 * @package		K2
 * @author    JoomlaWorks http://www.joomlaworks.gr
 * @copyright	Copyright (c) 2006 - 2010 JoomlaWorks Ltd. All rights reserved.
 * @license		GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.helper');

class K2HelperRoute
{

	function getItemRoute($id, $catid = 0) {
	
		$needles = array (
		'item'=>(int)$id,
		'itemlist'=>(int)$catid,
		);
		$link = 'index.php?option=com_k2&view=item&id='.$id;
	
		if ($item = K2HelperRoute::_findItem($needles)) {
			$link .= '&Itemid='.$item->id;
		}
		return $link;
	}

	function getCategoryRoute($catid)	{
	
		$needles = array (
		'itemlist'=>(int)$catid
		);
	
		$link = 'index.php?option=com_k2&view=itemlist&task=category&id='.$catid;
		
		if ($item = K2HelperRoute::_findItem($needles)) {
			$link .= '&Itemid='.$item->id;
		}
		return $link;
	}
	
	function getUserRoute($userID) {
	
		$needles = array (
		'user'=>(int)$userID
		);
		
		$user = &JFactory::getUser($userID);
	
	
        mb_internal_encoding("UTF-8");
		mb_regex_encoding("UTF-8");
        $alias = trim(mb_strtolower($user->name));
        $alias = str_replace('-', ' ', $alias);
        $alias = mb_ereg_replace('[[:space:]]+', ' ', $alias);
        $alias = trim(str_replace(' ', '', $alias));
        $alias = str_replace('.', '', $alias);

        
        $stripthese = ',|~|!|@|%|^|(|)|<|>|:|;|{|}|[|]|&|`|â€ž|â€¹|â€™|â€˜|â€œ|â€�|â€¢|â€º|Â«|Â´|Â»|Â°|«|»|…';
        $strips = explode('|', $stripthese);
        foreach ($strips as $strip) {
            $alias = str_replace($strip, '', $alias);
        }

        
        $params = &JComponentHelper::getParams('com_k2');
        $SEFReplacements = array();
        $items = explode(',', $params->get('SEFReplacements'));
        foreach ($items as $item) {
            if (! empty($item)) {
                @list($src, $dst) = explode('|', trim($item));
                $SEFReplacements[trim($src)] = trim($dst);
            }
        }

        
        foreach ($SEFReplacements as $key=>$value) {
            $alias = str_replace($key, $value, $alias);
        }
        
        $alias = trim($alias, '-.');
        
        if (trim(str_replace('-', '', $alias)) == '') {
            $datenow = &JFactory::getDate();
            $alias = $datenow->toFormat("%Y-%m-%d-%H-%M-%S");
        }
	
	
	
		$link = 'index.php?option=com_k2&view=itemlist&task=user&id='.$userID.':'.$alias;
	
		if ($item = K2HelperRoute::_findItem($needles)) {
			$link .= '&Itemid='.$item->id;
		}
		;
	
		return $link;
	}
	
	function getTagRoute($tag) {
	
		$needles = array (
		'tag'=>$tag
		);
	
		$link = 'index.php?option=com_k2&view=itemlist&task=tag&tag='.urlencode($tag);
	
		if ($item = K2HelperRoute::_findItem($needles)) {
			$link .= '&Itemid='.$item->id;
		}
		;
	
		return $link;
	}

	function _findItem($needles)	{
	
		$component = & JComponentHelper::getComponent('com_k2');
	
		$menus = & JApplication::getMenu('site', array ());
		$items = $menus->getItems('componentid', $component->id);
	
		$match = null;
	
		foreach ($needles as $needle=>$id)
		{
			if (count($items)){
				foreach ($items as $item)
				{	
					if ($needle=='user'){
						if ((@$item->query['task'] == $needle) && (@$item->query['id'] == $id)) {
							$match = $item;
							break;
						}					
						
					}
					else if ($needle=='tag'){
						if ((@$item->query['task'] == $needle) && (@$item->query['tag'] == $id)) {
							$match = $item;
							break;
						}		
					}
					else {

						if ((@$item->query['view'] == $needle) && (@$item->query['id'] == $id)) {
							$match = $item;
							break;
						}
						
						$menuparams = new JParameter( $item->params );
						$catids=$menuparams->get('categories');
						
						if(is_array($catids)){
							foreach ($catids as $catid)	{
								if ((@$item->query['view'] == $needle) && (@(int)$catid == $id)){
									$match = $item;
									break;
								}						
							}
						}
						/*else{
							
							if ( (@$item->query['view'] == $needle) && (!isset($item->query['task'])) && (@$item->query['view'] == 'itemlist') ) {
								$match = $item;
							}
							
						}*/

					}
	
				}
			}
		
			if ( isset ($match)) {
				break;
			}
		}
	
		return $match;
	}

}
