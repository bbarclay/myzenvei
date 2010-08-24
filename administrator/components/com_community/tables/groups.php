<?php
/**
 * @package		JomSocial
 * @copyright (C) 2008 by Slashes & Dots Sdn Bhd - All rights reserved!
 * @license http://www.azrul.com Copyrighted Commercial Software
 */

// Disallow direct access to this file
defined('_JEXEC') or die('Restricted access');

/**
 * Jom Social Table Model
 */
class CommunityTableGroups extends JTable
{
	var $id				= null;
	var $published		= null;
	var $ownerid		= null;
	var $categoryid		= null;
	var $name			= null;
	var $description	= null;
	var $email			= null;
	var $website		= null;
	var $approvals		= null;
	var $created		= null;
	var $avatar			= null;
	var $thumb			= null;
	var $discusscount	= null;
	var $membercount	= null;
	var $wallcount		= null;
	
	function __construct(&$db)
	{
		parent::__construct('#__community_groups','id', $db);
	}

	function getWallCount()
	{
		$db		=& JFactory::getDBO();
		
		$query	= 'SELECT COUNT(*) FROM ' . $db->nameQuote( '#__community_wall') . ' '
				. 'WHERE ' . $db->nameQuote( 'contentid' ) . '=' . $db->Quote( $this->id ) . ' '
				. 'AND ' . $db->nameQuote( 'type' ) . '=' . $db->Quote( 'groups' ) . ' '
				. 'AND ' . $db->nameQuote( 'published' ) . '=' . $db->Quote( '1' );

		$db->setQuery( $query );
		$count	= $db->loadResult();
		
		return $count;
	}

	function getDiscussCount()
	{
		$db		=& JFactory::getDBO();
		
		$query	= 'SELECT COUNT(*) FROM ' . $db->nameQuote( '#__community_groups_discuss') . ' '
				. 'WHERE ' . $db->nameQuote( 'groupid' ) . '=' . $db->Quote( $this->id );

		$db->setQuery( $query );
		$count	= $db->loadResult();
		
		return $count;
	}

	function isMember( $memberId , $groupId )
	{
		$db 		=& JFactory::getDBO();
		$query 	= 'SELECT * FROM ' . $db->nameQuote( '#__community_groups_members' ) . ' ' 
					. 'WHERE ' . $db->nameQuote( 'memberid' ) . '=' . $db->Quote( $memberId ) . ' '
					. 'AND ' . $db->nameQuote( 'groupid' ) . '=' . $db->Quote( $groupId );

		$db->setQuery( $query );
		
		$count 	= ( $db->loadResult() > 0 ) ? true : false;
		return $count;
	}
	
	function addMember( $data )
	{
		$db	=& $this->getDBO();
		
		// Test if user if already exists
		if( !$this->isMember($data->memberid, $data->groupid) )
		{
			$db->insertObject('#__community_groups_members' , $data);
		}
		
		if($db->getErrorNum())
		{
			JError::raiseError( 500, $db->stderr());
		}
		return $data;
	}

	function addMembersCount( $groupId )
	{
		$db		=& $this->getDBO();
				
		$query	= 'UPDATE ' . $db->nameQuote( '#__community_groups' )
				. 'SET ' . $db->nameQuote( 'membercount' ) . '= (membercount +1) '
				. 'WHERE ' . $db->nameQuote( 'id' ) . '=' . $db->Quote( $groupId );
		$db->setQuery( $query );
		$db->query();				

		if($db->getErrorNum())
		{
			JError::raiseError( 500, $db->stderr());
		}
	}
		
	function getMembersCount()
	{
		$db		=& JFactory::getDBO();
		
		$query	= 'SELECT COUNT(*) FROM ' . $db->nameQuote( '#__community_groups_members') . ' '
				. 'WHERE ' . $db->nameQuote( 'groupid' ) . '=' . $db->Quote( $this->id )
				. 'AND ' . $db->nameQuote( 'approved' ) . '=' . $db->Quote( '1' );

		$db->setQuery( $query );
		$count	= $db->loadResult();
		
		return $count;
	}
}