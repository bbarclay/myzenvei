<?php
/**
 * @package		JomSocial
 * @copyright (C) 2008 by Slashes & Dots Sdn Bhd - All rights reserved!
 * @license http://www.azrul.com Copyrighted Commercial Software
 */

// Disallow direct access to this file
defined('_JEXEC') or die('Restricted access');

jimport( 'joomla.application.component.model' );

class CommunityModelGroups extends JModel
{
	/**
	 * Configuration data
	 * 
	 * @var object
	 **/	 	 	 
	var $_params;

	/**
	 * Configuration data
	 * 
	 * @var object	JPagination object
	 **/	 	 	 
	var $_pagination;

	/**
	 * Configuration data
	 * 
	 * @var int	Total number of rows
	 **/
	var $_total;

	/**
	 * Configuration data
	 * 
	 * @var int	Total number of rows
	 **/
	var $_data;
	
	/**
	 * Constructor
	 */
	function __construct()
	{
		$mainframe	=& JFactory::getApplication();

		// Call the parents constructor
		parent::__construct();

		// Get the pagination request variables
		$limit		= $mainframe->getUserStateFromRequest( 'global.list.limit', 'limit', $mainframe->getCfg('list_limit'), 'int' );
		$limitstart	= $mainframe->getUserStateFromRequest( 'com_community.limitstart', 'limitstart', 0, 'int' );

		// In case limit has been changed, adjust limitstart accordingly
		$limitstart = ($limit != 0 ? (floor($limitstart / $limit) * $limit) : 0);

		$this->setState('limit', $limit);
		$this->setState('limitstart', $limitstart);
	}

	/**
	 * Method to get a pagination object for the events
	 *
	 * @access public
	 * @return integer
	 */
	function getPagination()
	{
		// Lets load the content if it doesn't already exist
		if ( empty( $this->_pagination ) )
		{
			jimport('joomla.html.pagination');
			$this->_pagination = new JPagination( $this->getTotal(), $this->getState('limitstart'), $this->getState('limit') );
		}

		return $this->_pagination;
	}

	/**
	 * Method to return the total number of rows
	 *
	 * @access public
	 * @return integer
	 */
	function getTotal()
	{
		// Load total number of rows
		if( empty($this->_total) )
		{
			$this->_total	= $this->_getListCount( $this->_buildQuery() );
		}

		return $this->_total;
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
	
	/**
	 * Build the SQL query string
	 *
	 * @access	private
	 * @return	string	SQL Query string	 
	 */
	function _buildQuery()
	{		
		$db			=& JFactory::getDBO();
		$category	= JRequest::getInt( 'category' , 0 );
		$condition	= '';
		
		if( $category != 0 )
		{
			$condition	= ' WHERE a.categoryid=' . $db->Quote( $category );
		}
		
		$query		= 'SELECT a.*, COUNT(DISTINCT(b.memberid)) AS membercount FROM ' . $db->nameQuote( '#__community_groups' ) . ' AS a '
					. 'LEFT JOIN ' . $db->nameQuote( '#__community_groups_members') . ' AS b '
					. 'ON b.groupid=a.id'
					. $condition
					. ' GROUP BY a.id';
					
		return $query;
	}

	/**
	 * Returns the Groups
	 *
	 * @return Array	Array of groups object
	 **/
	function getGroups()
	{
		if(empty($this->_data))
		{

			$query = $this->_buildQuery( );

			$this->_data	= $this->_getList( $this->_buildQuery() , $this->getState('limitstart'), $this->getState('limit') );
		}

		return $this->_data;
	}
	
	function getAllGroups()
	{
		$db		=& JFactory::getDBO();
		
		$query	= "SELECT * FROM " . $db->nameQuote( '#__community_groups');
		
		$db->setQuery( $query );
		$result	= $db->loadObjectList();
		
		return $result;
	}

	/**
	 * Returns the Groups Categories list
	 *
	 * @return Array An array of group category objects
	 **/
	function &getCategories()
	{
		$mainframe	=& JFactory::getApplication();
		
		$db		=& JFactory::getDBO();
		
		$query	= 'SELECT * FROM ' . $db->nameQuote( '#__community_groups_category');
		$db->setQuery( $query );
		$categories	= $db->loadObjectList();
		
		return $categories;
	}
	
	function isLatestTable()
	{
		$fields	= $this->_getFields();

		if(!array_key_exists( 'membercount' , $fields ) )
		{
			return false;
		}

		if(!array_key_exists( 'wallcount' , $fields ) )
		{
			return false;
		}

		if(!array_key_exists( 'discusscount' , $fields ) )
		{
			return false;
		}
		
		return true;
	}
	
	function _getFields( $table = '#__community_groups' )
	{
		$result	= array();
		$db		=& JFactory::getDBO();
		
		$query	= 'SHOW FIELDS FROM ' . $db->nameQuote( $table );

		$db->setQuery( $query );
		
		$fields	= $db->loadObjectList();

		foreach( $fields as $field )
		{
			$result[ $field->Field ]	= preg_replace( '/[(0-9)]/' , '' , $field->Type );
		}

		return $result;
	}
}