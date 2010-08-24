<?php
/**
 * @package		JomSocial
 * @copyright (C) 2008 by Slashes & Dots Sdn Bhd - All rights reserved!
 * @license http://www.azrul.com Copyrighted Commercial Software
 */

// Disallow direct access to this file
defined('_JEXEC') or die('Restricted access');

jimport( 'joomla.application.component.model' );

class CommunityModelProfiles extends JModel
{
	/**
	 * Configuration data
	 * 
	 * @var object	JPagination object
	 **/	 	 	 
	var $_pagination;
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
	 * Retrieves the JPagination object
	 *
	 * @return object	JPagination object	 	 
	 **/	 	
	function &getPagination()
	{
		if ($this->_pagination == null)
		{
			$this->getFields();
		}
		return $this->_pagination;
	}
	
	/**
	 * Returns the Fields
	 *
	 * @return object	JParameter object
	 **/
	function &getFields()
	{
		$mainframe	=& JFactory::getApplication();

		static $fields;
		
		if( isset( $fields ) )
		{
			return $fields;
		}

		// Initialize variables
		$db			=& JFactory::getDBO();

		// Get the limit / limitstart
		$limit		= $mainframe->getUserStateFromRequest('global.list.limit', 'limit', $mainframe->getCfg('list_limit'), 'int');
		$limitstart	= $mainframe->getUserStateFromRequest('com_communitylimitstart', 'limitstart', 0, 'int');

		// In case limit has been changed, adjust limitstart accordingly
		$limitstart	= ($limit != 0) ? ($limitstart / $limit ) * $limit : 0;

		// Get the total number of records for pagination
		$query	= 'SELECT COUNT(*) FROM ' . $db->nameQuote( '#__community_fields' );
		$db->setQuery( $query );
		$total	= $db->loadResult();

		jimport('joomla.html.pagination');
		
		// Get the pagination object
		$this->_pagination	= new JPagination( $total , $limitstart , $limit );

		$query	= 'SELECT * FROM ' . $db->nameQuote( '#__community_fields' ) . ' '
				. 'ORDER BY ' . $db->nameQuote( 'ordering' );

		$db->setQuery( $query , $this->_pagination->limitstart , $this->_pagination->limit );		
		
		$fields	= $db->loadObjectList();
		
		return $fields;
	}
	
	function &getGroups()
	{
		static $fieldGroups;
		
		if( isset( $fieldGroups ) )
		{
			return $fieldGroups;
		}
		
		$db		=& JFactory::getDBO();
		
		$query	= 'SELECT * '
				. 'FROM ' . $db->nameQuote( '#__community_fields' )
				. 'WHERE ' . $db->nameQuote( 'type' ) . '=' . $db->Quote( 'group' );

		$db->setQuery( $query );		
		
		$fieldGroups	= $db->loadObjectList();
		
		return $fieldGroups;
	}
	
	function &getFieldGroup( $fieldId )
	{
		static $fieldGroup;
		
		if( isset( $fieldGroup ) )
		{
			return $fieldGroup;
		}

		$db		=& JFactory::getDBO();

		$query	= 'SELECT * FROM ' . $db->nameQuote( '#__community_fields' )
				. 'WHERE ' . $db->nameQuote( 'ordering' ) . '<' . $db->Quote( $fieldId ) . ' '
				. 'AND ' . $db->nameQuote( 'type' ) . '=' . $db->Quote( 'group' )
				. 'ORDER BY ordering DESC '
				. 'LIMIT 1';

		$db->setQuery( $query );		
		
		$fieldGroup	= $db->loadObject();
		
		return $fieldGroup;
	}
	
	
	
	function getGroupFields( $groupOrderingId )
	{
		$fieldArray	= array();
		$db			=& JFactory::getDBO();

		$query	= 'SELECT * FROM ' . $db->nameQuote( '#__community_fields' )
				. ' WHERE ' . $db->nameQuote( 'ordering' ) . '>' . $db->Quote( $groupOrderingId )				
				. ' ORDER BY `ordering` ASC ';

		$db->setQuery( $query );		
		
		$fieldGroup	= $db->loadObjectList();
		
		if(count($fieldGroup) > 0)
		{
			foreach($fieldGroup as $field)
			{
				if($field->type == 'group')
					break;
				else
				 	$fieldArray[]	= $field;
			}
		}
		
		return $fieldArray;
	}	
	
	
	function getProfileTypes()
	{
		static $types = false;
		
		if( !$types )
		{
			$path	= JPATH_ROOT . DS . 'components' . DS . 'com_community' . DS . 'libraries' . DS . 'fields' . DS . 'customfields.xml';
			
			$parser	=& JFactory::getXMLParser( 'Simple' );
			$parser->loadFile( $path );
			$fields	= $parser->document->getElementByPath( 'fields' );
			$data	= array();
			
			foreach( $fields->children() as $field )
			{
				$type	= $field->getElementByPath( 'type' );
				$name	= $field->getElementByPath( 'name' );
				$data[ $type->data() ]	= $name->data();
			}
			$types	= $data;
		}
		return $types;
	}
}