<?php
/**
 * @category	Model
 * @package		JomSocial
 * @copyright (C) 2008 by Slashes & Dots Sdn Bhd - All rights reserved!
 * @license http://www.jomsocial.com/license-agreement.html Copyrighted Commercial Software
 */
defined('_JEXEC') or die('Restricted access');

require_once( JPATH_ROOT . DS . 'components' . DS . 'com_community' . DS . 'models' . DS . 'models.php' );

class CommunityModelMailq extends JCCModel
{
	/**
	 * take an object with the send data
	 * $recipient, $body, $subject, 	 
	 */	 	
	function add($recipient, $subject, $body)
	{
		$db	 = &$this->getDBO();
		
		$date =& JFactory::getDate();
		$obj  = new stdClass();
		
		$obj->recipient = $recipient;
		$obj->body 		= $body;
		$obj->subject 	= $subject;
		$obj->created	= $date->toMySQL();
		$obj->status	= 0;
		
		$db->insertObject( '#__community_mailq', $obj );
	}
	
	/**
	 * Restrive some emails from the q and delete it
	 */	 	
	function get($limit = 100 )
	{
		$db	 = &$this->getDBO();
		
		$sql = "SELECT * FROM `#__community_mailq` WHERE `status`='0' LIMIT 0," . $limit;

		$db->setQuery( $sql );
		$result = $db->loadObjectList();
		if($db->getErrorNum()) {
			JError::raiseError( 500, $db->stderr() );
		}
		
		return $result;
	}
	
	/**
	 * Change the status of a message
	 */	 	
	function markSent($id)
	{
		$db	 = &$this->getDBO();
		
		$sql = "SELECT * FROM #__community_mailq WHERE `id`=" . $db->Quote($id);
		$db->setQuery( $sql );
		$obj = $db->loadObject();
		
		$obj->status = 1;
		$db->updateObject( '#__community_mailq', $obj, 'id' );
	}
	
	function purge(){
	}
	
	function remove(){
	}
}
