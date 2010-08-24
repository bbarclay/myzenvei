<?php
/**
 * @category	Model
 * @package		JomSocial
 * @subpackage	Profile
 * @copyright (C) 2008 by Slashes & Dots Sdn Bhd - All rights reserved!
 * @license http://www.jomsocial.com/license-agreement.html Copyrighted Commercial Software
 */
defined('_JEXEC') or die('Restricted access');

require_once ( JPATH_ROOT .DS.'components'.DS.'com_community'.DS.'models'.DS.'models.php');

jimport( 'joomla.filesystem.file');

class CommunityModelConnect extends JCCModel
{

	/**
	 * Constructor
	 */
	function CommunityModelBulletins()
	{
		parent::JCCModel();
		
		$mainframe =& JFactory::getApplication();
		
		// Get pagination request variables
 	 	$limit		= ($mainframe->getCfg('list_limit') == 0) ? 5 : $mainframe->getCfg('list_limit');
	    $limitstart = JRequest::getVar('limitstart', 0, 'REQUEST');
	    
		// In case limit has been changed, adjust it
		$limitstart = ($limit != 0 ? (floor($limitstart / $limit) * $limit) : 0);

		$this->setState('limit', $limit);
		$this->setState('limitstart', $limitstart);
	}
	
	function updateConnectUserId( $connectid , $type , $userid )
	{
		$db		=& JFactory::getDBO();
		
		$query	= 'UPDATE ' . $db->nameQuote( '#__community_connect_users' ) . ' '
				. 'SET ' . $db->nameQuote('userid') . '=' . $db->Quote( $userid ) . ' '
				. 'WHERE ' . $db->nameQuote( 'connectid' ) . '=' . $db->Quote( $connectid ) . ' '
				. 'AND ' . $db->nameQuote('type') . '=' . $db->Quote( $type );
		$db->setQuery( $query );
		$db->query();
	}
	
	function isAssociated( $userId )
	{
		$db		=& JFactory::getDBO();
		
		$query	= 'SELECT COUNT(*) FROM ' . $db->nameQuote( '#__community_connect_users' ) . ' '
				. 'WHERE ' . $db->nameQuote( 'userid' ) . '=' . $db->Quote( $userId );
				
		$db->setQuery( $query );
		
		$exist	= ( $db->loadResult() > 0 ) ? true : false;
		return $exist;
	}
	
	function statusExists( $status , $userId )
	{
		$db		=& JFactory::getDBO();

		$query	= 'SELECT COUNT(1) FROM ' . $db->nameQuote( '#__community_activities' ) . ' '
				. 'WHERE ' . $db->nameQuote( 'actor' ) . '=' . $db->Quote( $userId ) . ' '
				. 'AND ' . $db->nameQuote( 'app' ) . '=' . $db->Quote( 'profile' )
				. 'AND ' . $db->nameQuote( 'title' ) . '=' . $db->Quote( '{actor} ' . $status );

		$db->setQuery( $query );

		$exist	= ( $db->loadResult() > 0 ) ? true : false;
		return $exist;
	}
}

class CTableConnect extends JTable
{
	var $connectid	= null;
	var $type		= null;
	var $userid		= null;
	
	/**
	 * Constructor
	 */	 	
	function __construct( &$db )
	{
		parent::__construct( '#__community_connect_users', 'connectid', $db );
	}
	
	function store()
	{
		$db		=& $this->getDBO();
		
		$query	= 'SELECT COUNT(1) FROM #__community_connect_users '
				. 'WHERE ' . $db->nameQuote( 'connectid' ) . '=' . $db->Quote( $this->connectid );
		
		$db->setQuery($query);
		$result	= $db->loadResult(); 
		
		if( !$result )
		{
			$obj			= new stdClass();
			$obj->connectid	= $this->connectid;
			$obj->type		= $this->type;
			$obj->userid	= $this->userid;
			return $db->insertObject( '#__community_connect_users' , $obj );
		}
		
		// Existing table, just need to update
		return $db->updateObject( '#__community_connect_users', $this, 'connectid' , false );
	}
}