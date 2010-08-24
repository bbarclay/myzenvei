<?php
/**
 * @version	3.0 - free version
 * @author	Ulli Storck
 * @license	GPL 2.0
 */

// Check to ensure this file is included in Joomla!
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.plugin.plugin' );

require_once (JPATH_ROOT . DS . 'administrator' . DS . 'components' . DS . 'com_autotweet' . DS . 'helpers' . DS . 'autotweetposthelper.php');


/**
 * Base class for extension plugins for AutoTweet.
 *
  */
abstract class plgAutotweetBase extends JPlugin
{

	function plgAutotweetBase( &$subject, $params )
	{
		parent::__construct( $subject, $params );
	}
	
	/**
	 * Sends an event to the main AutoTweet plugin to post status message..
	 *
	 * @return	bool	true, if message is posted without errors
	 */
	protected function postStatusMessage ($id, $publish_up, $text, $url = '')
	{
		// get plugin name and remove prefix		
		$plug_id = substr_replace($this->toString(), '', 0, 9);
	
		$helper =& AutotweetPostHelper::getInstance();
		$result = $helper->postTwitterMessage($id, $publish_up, $text, $url, $plug_id);

		return $result;
	}


	/**
	 * DEPRECATED: USE postStatusMessage instead!!!
	 *
	 */
	protected function postTwitterStatusMessage ($id, $publish_up, $text, $url = '')
	{
		return $this->postStatusMessage ($id, $publish_up, $text, $url);
	}
	
	//
	//  check type and range of textcount parameter, and correct if needed
	//
	protected function getTextcount($textcount)
	{
		if (is_numeric($textcount) || ('' == $textcount)) {
			$textcount = (int)$textcount;
			if ($textcount > 140) {
				$textcount = 140;
			}
			elseif ($textcount < 10) {
				$textcount = 10;
			}
		}
		else {
			$textcount = 100;
		}
		
		return $textcount;
	}

	//
	// use title or text as twitter message
	//
	protected function getMessagetext($usetext, $textcount, $title, $text)
	{
		$message = '';
		
		switch ($usetext) {
			case 0:	// show title only
				$message = $title;
				break;
			case 1:	// show text only
				if ('' != $text) {
					$message = $text;
				}
				else {
					$message = $title;
				}
				break;
			case 2:	// show title and text
				if ('' != $text) {
					$message = $title . ': ' . $text;
				}
				else {
					$message = $title;
				}
				break;
			default:
				$message = $title;					
		}

		return substr(strip_tags($message), 0, $textcount);
	}

	//
	// replaces spaces for hashtags
	//
	protected function getAsHashtag($word)
	{
		if ('' != $word) {
			$word = strip_tags($word);
			$word = str_replace(' ', '', $word);
			$word = str_replace('-', '', $word);	
			$hash = '#' . $word;
		}
		else {
			$hash = '';
		}
		
		return $hash;
	}

	
	//
	// returns hashtags from comma sperated string (metakey field)
	//
	protected function getHashtags($metakey, $count = 1)
	{
		$hashtags = '';
		
		if (!empty($metakey)) {
			$i = 0;
			$words = explode(',', $metakey);
			foreach ($words as $word) {
				$i++;
				if ($i > $count) { break; }
				if ('' != $hashtags) { $hashtags .= ' '; }
				$hashtags .= $this->getAsHashtag($word);
			}
		}
			
		return $hashtags;
	}
	
	//
	// add static text / hashtags to message
	//
	protected function addStatictext($textpos, $text, $statictext)
	{
		switch ($textpos) {
			case 0:	// dont use static_text, use original text
				$result_text = $text;
				break;
			case 1:	//show static text at the beginning of message text
				$result_text = $statictext . ' ' . $text;
				break;
			case 2:	// show static text at the end of message text
				$result_text = $text . ' ' . $statictext;
				break;
			default:
				$result_text = $text;
		}
		
		return strip_tags($result_text);
	}

	//
	// add category / section to message text
	//
	protected function addCatsec($show, $section, $category, $text, $add_hash = false)
	{
		if ($add_hash) {
			$section = $this->getAsHashtag($section);
			$category = $this->getAsHashtag($category);
			
			switch ($show) {
				case 0:	// do nothing, use original text
					$result_text = $text;
					break;
				case 1:	// show section only
					$result_text = $text . ' ' . $section;
					break;
				case 2:	// show section and category
					$result_text = $text . ' ' . $section . ' ' . $category;
					break;
				case 3: // show category only (new feature since 3.0 stable)
					$result_text = $text . ' ' . $category;
					break;			
				default:
					$result_text = $text;
			}		
		}
		else {
			switch ($show) {
				case 0:	// do nothing, use original text
					$result_text = $text;
					break;
				case 1:	// show section only
					$result_text = $section . ': ' . $text;
					break;
				case 2:	// show section and category
					$result_text = $section . '/' . $category . ': ' . $text;
					break;
				case 3: // show category only (new feature since 3.0 stable)
					$result_text = $category . ': ' . $text;
					break;			
				default:
					$result_text = $text;
			}
		}

		return $result_text;	
	}

				
	//
	// database helpers
	//
	protected function getID($table)
	{
		$db = &JFactory::getDBO();		
		
		$prefix = $db->getPrefix();
		$table = str_replace  ('#__', $prefix, $table);

		$query = 'SHOW TABLE STATUS LIKE ' . $db->Quote($table);
		$db->setQuery($query);
		$result = $db->loadAssoc();

		$next_key = (int)$result['Auto_increment'];
		
		return $next_key;
	}

	//
	// better implementation to handle multiple menu entry for component (multiple itemids)
	//
	protected function getItemid($comp_name, $needles, $q_view = 'view')
	{
		$component =& JComponentHelper::getComponent($comp_name);

		$menus	= &JApplication::getMenu('site', array());
		$items	= $menus->getItems('componentid', $component->id);

		$match = null;

		foreach($needles as $needle => $id) {
			foreach($items as $item) {
				if ((@$item->query[$q_view] == $needle) && (@$item->query['id'] == $id)) {
					$match = $item;
					break;
				}
			}

			if(isset($match)) {	break; }
		}
		
		// defaults if no item is found
		if(!isset($match)) {
			// get first public itemid
			foreach($items as $item) {
				if (0 == (int)$item->access) {
					$match = $item;
					break;
				}
			}

			// last chance: get first itemid (also when private)
			if(!isset($match) && !empty($items)) {
				$match = $items[0];
			}
		}

		// set id if item is found
		if(isset($match)) {
			$match = $match->id;

		}

		return $match;
	}
	
	//
	// special implementation to ad multiple categories
	//
	protected function addCategories($show, $categories, $text, $add_hash)
	{
		if ($add_hash) {
			switch ($show) {
				case 0:	// do nothing, use original text
					$result_text = $text;
					break;
				case 1:	// show first category only
					$result_text = $text . ' ' . $this->getAsHashtag($categories[0]);
					break;
				case 2:	// show all categories
					$result_text = $text . ' ' . $this->getHashtags(implode(',', $categories), count($categories));
					break;
				default:
					$result_text = $text;
			}		
		}
		else {
			switch ($show) {
				case 0:	// do nothing, use original text
					$result_text = $text;
					break;
				case 1:	// show first category only
					$result_text = $categories[0] . ': ' . $text;
					break;
				case 2:	// show all categories
					$result_text = trim(implode('/', $categories)) . ': ' . $text;
					break;
				default:
					$result_text = $text;
			}
		}

		return $result_text;	
	}

}	
?>
