<?php
/**
 * @copyright (C) 2008 by Slashes & Dots Sdn Bhd - All rights reserved!
 * @license http://www.jomsocial.com/license-agreement.html Copyrighted Commercial Software
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

require_once ( JPATH_ROOT .DS.'components'.DS.'com_community'.DS.'models'.DS.'models.php');

class CommunityModelFiles extends JCCModel
{
	var $_table		= '#__community_files';
		
	function setCaption( $photoId , $caption )
	{
		$db		=& $this->getDBO();
		$data	= $this->getPhoto( $photoId );
		$data->caption	= $caption;
		
		$db->updateObject( '#__community_photos' , $data , 'id' );
		
		return $data;
	}
	
	function create( $data )
	{
		// Set creation date
		if(!isset($data->created))
		{
			$today			=& JFactory::getDate();
			$data->created	= $today->toMySQL();
		}

		// Fix the directory separators.
		$data->thumbnail	= JString::str_ireplace( '\\' , '/' , $data->thumbnail );
		$data->source		= JString::str_ireplace( '\\' , '/' , $data->source );

		$db		=& $this->getDBO();
		$db->insertObject( $this->_table , $data );
		$data->id	= $db->insertid();

		return $data;
	}
	
	function get( $id )
	{
		$db		=& $this->getDBO();
		
		$strSQL	= 'SELECT * FROM ' . $db->nameQuote( $this->_table ) . ' '
				. 'WHERE ' . $db->nameQuote('id') . '=' . $db->Quote($id);

		$db->setQuery( $strSQL );
		$result	= $db->loadObject();
		
		return $result;
	}
	
	function getFiles( $userId , $limit = 0)
	{
		$db		=& $this->getDBO();
		$query	= '';
		
		if($limit != 0)
		{
			$query	= ' LIMIT 0 , ' . $limit;	
		}
		
		$strSQL	= 'SELECT * FROM ' . $db->nameQuote( $this->_table ) . ' '
				. 'WHERE ' . $db->nameQuote('creator') . '=' . $db->Quote($userId)
				. $query;

		$db->setQuery( $strSQL );
		$result	= $db->loadObjectList();
		return $result;
	}
}