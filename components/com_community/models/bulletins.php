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

class CommunityModelBulletins extends JCCModel
{
	/**
	 * Configuration data
	 * 
	 * @var object	JPagination object
	 **/
	var $_pagination	= '';

	/**
	 * Configuration data
	 * 
	 * @var object	JPagination object
	 **/
	var $total			= '';
	
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

	
	/**
	 * Method to retrieve a list of bulletins
	 *
	 * @param	$id	The id of the group if necessary
	 *
	 * @return	$result	An array of bulletins	 
	 **/	 
	function getBulletins( $groupId = null , $limit = 0 )
	{
		$db			=& $this->getDBO();
		
		$where 		= ( !is_null($groupId) ) ? 'WHERE a.groupid=' . $db->Quote( $groupId ) : '';
		$limitSQL	= '';
		
		$limit		= ($limit == 0) ? $this->getState('limit') : $limit;
		$limitstart = $this->getState('limitstart');
				
		$query	= 'SELECT COUNT(*) '
				. 'FROM ' . $db->nameQuote( '#__community_groups_bulletins') . ' AS a '
				. $where;

		$db->setQuery( $query );
		$total	= $db->loadResult();
		$this->total	= $total;
		
		if($db->getErrorNum())
		{
			JError::raiseError( 500, $db->stderr());
	    }
	    
		if( empty($this->_pagination) )
		{
			jimport('joomla.html.pagination');
			
			$this->_pagination	= new JPagination( $total , $limitstart , $limit);
		}
		
		$limitSQL	.= ' LIMIT ' . $limitstart . ',' . $limit;

		$query	= 'SELECT * '
				. 'FROM ' . $db->nameQuote('#__community_groups_bulletins') . ' AS a '
				. $where . ' '
				. 'ORDER BY a.`date` DESC'
				. $limitSQL;

		$db->setQuery( $query );
		$result	= $db->loadObjectList();

		if($db->getErrorNum())
		{
			JError::raiseError( 500, $db->stderr());
	    }
	    
		return $result;
	}

	/**
	 * Method to get a pagination object for the events
	 *
	 * @access public
	 * @return integer
	 */
	function getPagination()
	{		
		return $this->_pagination;
	}
}

class CTableBulletin extends JTable
{

	var $id 		= null;
	var $groupid	= null;
	var $created_by	= null;
	var $published	= null;
	var $title		= null;
	var $message	= null;
	var $date		= null;

	/**
	 * Constructor
	 */	 	
	function __construct( &$db )
	{
		parent::__construct( '#__community_groups_bulletins', 'id', $db );
	}
}