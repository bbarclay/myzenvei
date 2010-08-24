<?php
/**
 * @category	Model
 * @package		JomSocial
 * @subpackage	Messaging
 * @copyright (C) 2008 by Slashes & Dots Sdn Bhd - All rights reserved!
 * @license http://www.jomsocial.com/license-agreement.html Copyrighted Commercial Software
 */
defined('_JEXEC') or die('Restricted access');

require_once( JPATH_ROOT . DS . 'components' . DS . 'com_community' . DS . 'models' . DS . 'models.php' );

class CommunityModelNotification extends JCCModel
{
	/**
	 * Add new notification
	 */	 	
	function add($from, $to , $title, $content, $privacy=COMMUNITY_PRIVACY_PUBLIC){
		jimport('joomla.utilities.date');
		
		$db	 = &$this->getDBO();
		$date =& JFactory::getDate();
		
		$obj = new stdClass();
		$obj->actor  = $from;
		$obj->target  = $to;
		$obj->title	  = $title;
		$obj->content = $content;
		$obj->created = $date->toMySQL();
		
		$userFrom =& JFactory::getUser($from);
		$userTo =& JFactory::getUser($to);
		
		// Porcess the message and title
		$search = array('{actor}', '{target}');
		$replace = array($userFrom->name, $userTo->name);
		
		$title 	 = JString::str_ireplace($search, $replace, $title);
		$content = JString::str_ireplace($search, $replace, $content);
	}
	
	/**
	 * return array of notification items
	 */	 	
	function get($userid, $viwerid = 0, $isfrined = false, $limit = 10){
		$db	 = &$this->getDBO();
		return null;
	}
}
