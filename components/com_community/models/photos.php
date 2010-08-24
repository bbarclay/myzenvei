<?php
/**
 * @copyright (C) 2008 by Slashes & Dots Sdn Bhd - All rights reserved!
 * @license http://www.jomsocial.com/license-agreement.html Copyrighted Commercial Software
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

jimport('joomla.filesystem.file');
jimport('joomla.filesystem.folder');
require_once ( JPATH_ROOT .DS.'components'.DS.'com_community'.DS.'models'.DS.'models.php');

class CommunityModelPhotos extends JCCModel
{
	var $_pagination;
	var $total;
	var $test;
	
	function CommunityModelPhotos()
	{
		parent::JCCModel();
 	 	global $option;
 	 	$mainframe =& JFactory::getApplication();
 	 	
 	 	// Get pagination request variables
 	 	$limit		= ($mainframe->getCfg('list_limit') == 0) ? 5 : $mainframe->getCfg('list_limit');
	    $limitstart = JRequest::getVar('limitstart', 0, 'REQUEST');
 	 	
 	 	// In case limit has been changed, adjust it
	    $limitstart = ($limit != 0 ? (floor($limitstart / $limit) * $limit) : 0);
		
 	 	$this->setState('limit',$limit);
 	 	$this->setState('limitstart',$limitstart);
	}
	
	function cleanUpTokens()
	{
		$date	= JFactory::getDate();
		$db		=& $this->getDBO();
		
		$query	= 'DELETE FROM ' . $db->nameQuote( '#__community_photos_tokens' ) . ' '
				. 'WHERE ' . $db->nameQuote( 'datetime' ) . '<= DATE_SUB(' . $db->Quote( $date->toMySQL() ) . ', INTERVAL 1 HOUR)'; 
		
		$db->setQuery($query);
		$db->query();
	}

	function getUserUploadToken( $userId )
	{
		$db		=& JFactory::getDBO();
		
		$query	= 'SELECT * FROM '
				. $db->nameQuote( '#__community_photos_tokens' ) . ' '
				. 'WHERE ' . $db->nameQuote( 'userid' ) . '=' . $db->Quote( $userId );
				
		$db->setQuery( $query );
		$result	= $db->loadObject();
		
		return $result;
	}
	
	function addUserUploadSession( $token )
	{
		$db		=& JFactory::getDBO();
		
		$db->insertObject( '#__community_photos_tokens' , $token );
	}
	
	function update( $data , $type = 'photo' )
	{
		// Set creation date
		if(!isset($data->created))
		{
			$today			=& JFactory::getDate();
			$data->created	= $today->toMySQL();
		}
		
		if(isset($data->id) && $data->id != 0 )
			$func	= '_update' . JString::ucfirst($type);
		else
			$func	= '_create' . JString::ucfirst($type);

		return $this->$func($data);
	}
	
	// A user updated his view permission, change the permission level for
	// all album and photos
	function updatePermission($userid, $permission){
		$db	=& $this->getDBO();
		$query = 'UPDATE #__community_photos_albums SET `permissions`='
				  . $db->Quote( $permission ) 
				  . ' WHERE `creator`='
				  . $db->Quote( $userid );
		$db->setQuery( $query );
		$db->query();
		if($db->getErrorNum())
		{
			JError::raiseError(500, $db->stderr());
		}
		
		$query = 'UPDATE #__community_photos SET `permissions`='
				  . $db->Quote( $permission ) 
				  . ' WHERE `creator`='
				  . $db->Quote( $userid );
		$db->setQuery( $query );
		$db->query();
		if($db->getErrorNum())
		{
			JError::raiseError(500, $db->stderr());
		}
		
	}
	
	function _createPhoto($data)
	{
		$db	=& $this->getDBO();
		
		// Fix the directory separators.
		$data->image		= JString::str_ireplace( '\\' , '/' , $data->image );
		$data->thumbnail	= JString::str_ireplace( '\\' , '/' , $data->thumbnail );

		$db->insertObject( '#__community_photos' , $data );

		if($db->getErrorNum()) {
			JError::raiseError( 500, $db->stderr());
		}
		$data->id				= $db->insertid();
		
		return $data;
	}
	
	function _createAlbum($data)
	{
		$db	=& $this->getDBO();

		// New record, insert it.
		$db->insertObject( '#__community_photos_albums' , $data );

		if($db->getErrorNum()) {
			JError::raiseError( 500, $db->stderr());
		}
		$data->id				= $db->insertid();
		
		return $data;
	}
	
	function _updateAlbum($data)
	{
	}
	
	function _updatePhoto($data)
	{
	}

	/**
	 * Removes a photo from the database and the file.
	 * 	 	
	 * @access	public
	 * @param	string 	User's id.
	 * @returns boolean true upon success.
	 */	 	 	
	function removePhoto( $id , $type = PHOTOS_USER_TYPE )
	{
		$photo	=& JTable::getInstance( 'Photo' , 'CTable' );
		$photo->load( $id );
		$photo->delete();
		
// 		$db		=& $this->getDBO();
// 		$photo	= $this->getPhoto( $id );
// 		$album	= $this->getAlbum( $photo->albumid );
// 
// 		// Before removing this, we need to check if it is associated to the album
// 		$query	= 'SELECT `id` FROM ' . $db->nameQuote('#__community_photos_albums') . ' '
// 				. 'WHERE ' . $db->nameQuote('photoid') . '=' . $db->Quote($id);
// 		$db->setQuery( $query );
// 
// 		$result	= $db->loadResult();
// 
// 		if($db->getErrorNum())
// 		{
// 			JError::raiseError(500, $db->stderr());
// 		}
// 		
// 		if($result)		
// 		{								
// 			$query	= 'UPDATE ' . $db->nameQuote('#__community_photos_albums') . ' '
// 					. 'SET ' . $db->nameQuote('photoid') . '=' . $db->Quote('0') . ' ' 
// 					. 'WHERE ' . $db->nameQuote('id') . '=' . $db->Quote( $result );
// 
// 			$db->setQuery( $query );
// 			$db->query();
// 
// 			if($db->getErrorNum())
// 			{
// 				JError::raiseError(500, $db->stderr());
// 			}
// 		}
// 		
// 		$albumPath	= $album->path;
// 		
// 		// Remove image files from the respective folder.
// 		jimport('joomla.filesystem.file');
// 		
// 		//$image	= JPATH_ROOT . DS . $photo->image;
// 		$thumb	= JPATH_ROOT . DS . $photo->thumbnail;
// 		
// 		// Remove the original photos as well
// 		if( !empty($photo->original) )
// 		{
// 			$original	= JPATH_ROOT . DS . $photo->original;
// 			JFile::delete( $original );
// 		}
// 		
// 		//JFile::delete( $image );
// 		JFile::delete( $thumb );
// 		
// 		// Remove all resized photos as well
// 		$files	= '';
// 		if(empty($albumPath))
// 		{
// 			$files = JFolder::files( JPATH_ROOT . DS . 'images'.DS.'photos'.DS.$photo->creator );
// 		}
// 		else
// 		{
// 			if($type == PHOTOS_GROUP_TYPE )
// 			{
// 				$files = JFolder::files( JPATH_ROOT . DS . 'images'.DS.'groupphotos'.DS.$album->groupid.DS.$photo->albumid );
// 			}
// 			else
// 			{
// 				$files = JFolder::files( JPATH_ROOT . DS . 'images'.DS.'photos'.DS.$photo->creator.DS.$photo->albumid );
// 			}
// 			
// 		}
// 		
// 		if( $files )
// 		{
// 			foreach($files as $filename){
// 				$path_parts = pathinfo($photo->original);
// 				$pattern = '/rsz_([0-9]+)_([0-9]+)_' . $path_parts['basename'] .'/i';
// 				if(preg_match ($pattern, $filename) > 0){				
// 					if(empty($albumPath))
// 					{
// 						JFile::delete( JPATH_ROOT.DS.'images'.DS.'photos'.DS.$photo->creator .DS.$filename );
// 					}
// 					else
// 					{
// 						if($type == PHOTOS_GROUP_TYPE )
// 						{
// 							JFile::delete( JPATH_ROOT.DS.'images'.DS.'groupphotos'.DS.$album->groupid.DS.$photo->albumid .DS.$filename );
// 						}
// 						else
// 						{
// 							JFile::delete( JPATH_ROOT.DS.'images'.DS.'photos'.DS.$photo->creator.DS.$photo->albumid .DS.$filename );
// 						}
// 					}
// 				}
// 			}
// 		}
// 		$query	= 'DELETE FROM ' . $db->nameQuote('#__community_photos') . ' '
// 				. 'WHERE ' . $db->nameQuote('id') . '=' . $db->Quote( $id );
// 		$db->setQuery( $query );
// 		$db->query();
// 
// 		if($db->getErrorNum())
// 		{
// 			JError::raiseError(500, $db->stderr());
// 		}
// 
// 		return true;
	}
	
	function get($id , $type = 'photos')
	{
		$func	= '_get' . JString::ucfirst($type);
		return $this->$func($id);
	}

	function getPagination()
	{
		return $this->_pagination;
	}

	/**
	 * Return a list of photos from specific album
	 *
	 * @param	int	$id	The album id that we want to retrieve photos from
	 */	 
	function getAllPhotos( $albumId = null , $photoType = PHOTOS_USER_TYPE, $limit = null , $permission=null , $orderType = 'DESC' )
	{
		$db		=& $this->getDBO();
		
		$where	= ' WHERE b.`type` = ' . $db->Quote($photoType);

		if( !is_null($albumId) )
		{
			$where	.=	' AND b.`id`'
					.	'=' . $db->Quote( $albumId )
					.	' AND a.`albumid`'
					.	'=' . $db->Quote( $albumId );												
		}
		
		// Only apply the permission if explicitly specified	
		if( !is_null($permission) ) 
		{
			$where	.= ' AND a.`permissions`'
				. '=' . $db->Quote( $permission );
		}
		
		$limitWhere	= '';
		
		if( !is_null($limit) )
		{
			$limitWhere	.= ' LIMIT ' . $limit;
		}
		
		$query	= 'SELECT a.* FROM ' . $db->nameQuote( '#__community_photos') . ' AS a';
		$query	.= ' INNER JOIN ' . $db->nameQuote( '#__community_photos_albums') . ' AS b';
		$query	.= ' ON a.`albumid` = b.`id`';
		$query	.= $where;
		$query	.= ' ORDER BY a.`created` ' . $orderType;
		$query	.= $limitWhere;				

		$db->setQuery( $query );
		
		$result	= $db->loadObjectList();

		if($db->getErrorNum())
		{
			JError::raiseError( 500, $db->stderr());
		}
		
		return $result;
	}
	
	/**
	 * Return a list of photos from specific album
	 *
	 * @param	int	$id	The album id that we want to retrieve photos from
	 */	 	
	function getPhotos( $id , $limit = null , $limitstart = null )
	{
		$db		=& $this->getDBO();
		
		// Get limit
		$limit		= ( is_null( $limit ) ) ? $this->getState('limit') : $limit;
		$limitstart	= ( is_null( $limitstart ) ) ? $this->getState( 'limitstart' ) : $limitstart;

		// Get total photos from specific album
		$query		= 'SELECT COUNT(*) FROM ' . $db->nameQuote( '#__community_photos') . ' '
					. 'WHERE ' . $db->nameQuote( 'albumid' ) . '=' . $db->Quote( $id );
		
		$db->setQuery( $query );
		$total		= $db->loadResult();
		
		if($db->getErrorNum())
		{
			JError::raiseError( 500, $db->stderr());
		}

		// Appy pagination
		if( empty($this->_pagination) )
		{
	 	    jimport('joomla.html.pagination');
	 	    $this->_pagination = new JPagination($total, $limitstart, $limit);
	 	}
	 	//var_dump($limitstart);
		// Get all photos from specific albumid
		$query		= 'SELECT * FROM ' . $db->nameQuote( '#__community_photos') . ' '
					. 'WHERE ' . $db->nameQuote( 'albumid' ) . '=' . $db->Quote( $id ) . ' '
					. ' ORDER BY `created` DESC '
					. 'LIMIT ' . $limitstart . ',' . $limit;

		$db->setQuery( $query );
		$result	= $db->loadObjectList();

		if($db->getErrorNum())
		{
			JError::raiseError( 500, $db->stderr());
		}
		
		return $result;
	}
	
	/**
	 * @param	integer albumid Unique if of the album
	 */	 	
	function getAlbum( $albumId )
	{
		$album	=& JTable::getInstance( 'Album' , 'CTable' );
		$album->load( $albumId );
		
		return $album;
	}

	/**
	 * Return total photos in a given album id.
	 *
	 * @param	int	$id	The album id.
	 */	 
	function getTotalPhotos( $albumId )
	{
		$db		=& $this->getDBO();
		
		$query	= 'SELECT COUNT(1) FROM ' . $db->nameQuote( '#__community_photos') . ' '
				. 'WHERE ' . $db->nameQuote( 'albumid' ) . '=' . $db->Quote( $albumId );

		$db->setQuery( $query );
		$total	= $db->loadResult();

		if($db->getErrorNum())
		{
			JError::raiseError( 500, $db->stderr());
		}
				
		return $total;
	}
	
	function getAllAlbums( $userId = 0, $limit = 0 )
	{
			
		$db			=& $this->getDBO();
		
		// Get limit
		$limit		= $limit == 0 ? $this->getState('limit') : $limit;
		$limitstart	= $this->getState( 'limitstart' );
		
		$subQuery	= 'SELECT COUNT( DISTINCT(s.id) ) '
					. 'FROM ' . $db->nameQuote( '#__community_photos_albums' ) . ' AS s '
					. 'RIGHT JOIN ' . $db->nameQuote( '#__community_groups_members' ) . ' AS t '
					. 'ON s.groupid=t.groupid '
					. 'WHERE t.memberid=' . $db->Quote( $userId ) . ' '
					. 'AND t.approved=1';
					
		// Get total albums
		$query	= 'SELECT a.*, COUNT(DISTINCT(a.id)), '
				. 'IF( a.groupid>0, IF( c.approvals=0,true,(' . $subQuery . ') ), true ) AS display '
				. 'FROM ' . $db->nameQuote( '#__community_photos_albums' ) . ' AS a '
				. 'INNER JOIN ' . $db->nameQuote( '#__community_photos' ) . ' AS b '
				. 'ON a.id=b.albumid '
				. 'LEFT JOIN ' . $db->nameQuote( '#__community_groups' ) . ' AS c '
				. 'ON a.groupid = c.id '
				. 'GROUP BY a.id '
				. 'HAVING display=true ';

		$db->setQuery( $query );
		$albums	= $db->loadObjectList();

		if($db->getErrorNum())
		{
			JError::raiseError( 500, $db->stderr());
		}
		
		$total			= 0;
		$albumCount		= array();

		// Check album permissions
		if( !empty($albums) )
		{
			foreach( $albums as &$row ){
				if( $this->checkAlbumsPermissions($row,$userId) )
				{
					$albumCount[$total]	= $row ;	
					$total++;
				}
			}
		}
		
		// Appy pagination
		if( empty($this->_pagination) )
		{
	 	    jimport('joomla.html.pagination');
	 	    $this->_pagination = new JPagination($total, $limitstart, $limit);
	 	}
	 	
// 		$query	= 'SELECT a.*, '
// 				. 'COUNT( DISTINCT(b.id) ) AS count, '
// 				. 'MAX(b.created) AS lastupdated, '
// 				. 'c.thumbnail, '
// 				. 'c.storage, '
// 				. 'c.id AS photoid, '
// 				. 'IF( a.groupid>0, IF( d.approvals=0,true,(' . $subQuery . ') ), true ) as display, '
// 				. 'CASE a.permissions '
// 				. '	WHEN 0 THEN '
// 				. '	  true '
// 				. '	WHEN 20 THEN '
// 				. '	  (SELECT COUNT(u.id) FROM ' . $db->nameQuote( '#__users' ) . ' AS u WHERE u.block=0 AND u.id=' . $db->Quote( $userId ) . ') '
// 				. '	WHEN 30 THEN '
// 				. '	  IF( a.creator=' . $db->Quote( $userId ) . ', true, (SELECT COUNT(v.connection_id) FROM ' . $db->nameQuote('#__community_connection') . ' AS v WHERE v.connect_from=a.creator AND v.connect_to=' . $db->Quote( $userId ) . ' AND v.status=1) ) '
// 				. '	WHEN 40 THEN '
// 				. '	  IF(a.creator=' . $db->Quote( $userId ) . ',true,false) '
// 				. '	END '
// 				. '	AS privacy '
// 				. 'FROM ' . $db->nameQuote( '#__community_photos_albums' ) . ' AS a '
// 				. 'INNER JOIN ' . $db->nameQuote( '#__community_photos' ) . ' AS b '
// 				. 'ON a.id=b.albumid '
// 				. 'LEFT JOIN ' . $db->nameQuote( '#__community_photos' ) . ' AS c '
// 				. 'ON a.photoid=c.id '
// 				. 'LEFT JOIN ' . $db->nameQuote( '#__community_groups' ) . ' AS d '
// 				. 'ON a.groupid=d.id '
// 				. 'GROUP BY a.id '
// 				. 'HAVING display=true AND privacy=true '
// 				. 'ORDER BY a.`created` DESC '
// 				. 'LIMIT ' . $limitstart . ',' . $limit;
				
				
		$query	= 'SELECT x.*, '
				. ' COUNT( DISTINCT(b.id) ) AS count, MAX(b.created) AS lastupdated FROM '
				. '(SELECT a.`id`, a.`creator`, a.`name`, a.`description`, a.`permissions`, a.`created`, '
				. ' a.`path` , a.`type` , a.`groupid`, '
				. 'c.thumbnail, '
				. 'c.storage, '
				. 'c.id as photoid, '	
				. 'IF( a.groupid>0, IF( d.approvals=0,true,(' . $subQuery . ') ), true ) as display, '
				. 'CASE a.permissions '
				. '	WHEN 0 THEN '
				. '	  true '
				. '	WHEN 20 THEN '
				. '	  (SELECT COUNT(u.id) FROM ' . $db->nameQuote( '#__users' ) . ' AS u WHERE u.block=0 AND u.id=' . $db->Quote( $userId ) . ') '
				. '	WHEN 30 THEN '
				. '	  IF( a.creator=' . $db->Quote( $userId ) . ', true, (SELECT COUNT(v.connection_id) FROM ' . $db->nameQuote('#__community_connection') . ' AS v WHERE v.connect_from=a.creator AND v.connect_to=' . $db->Quote( $userId ) . ' AND v.status=1) ) '
				. '	WHEN 40 THEN '
				. '	  IF(a.creator=' . $db->Quote( $userId ) . ',true,false) '
				. '	END '
				. '	AS privacy '
				. 'FROM ' . $db->nameQuote( '#__community_photos_albums' ) . ' AS a '
				. 'LEFT JOIN ' . $db->nameQuote( '#__community_photos' ) . ' AS c '
				. 'ON a.photoid=c.id '
				. 'LEFT JOIN ' . $db->nameQuote( '#__community_groups' ) . ' AS d '
				. 'ON a.groupid=d.id '
// 				. 'where ((a.permissions <= 0) ' 
// 				. 'or (a.permissions = 20 AND ' . $db->Quote( $userId ) . ' != 0) '
// 				. 'or (a.permissions = 30 AND a.creator IN (select v.connect_to FROM `#__community_connection` AS v WHERE  v.connect_from = '. $db->Quote( $userId ) .' AND v.STATUS=1)) '
// 				. 'or (a.permissions = 40 and a.creator = '. $db->Quote( $userId ) . ')) '
				. 'GROUP BY a.id '
 				. 'HAVING display=true AND privacy=true '				
				. 'ORDER BY a.`created` DESC '
				. 'LIMIT ' . $limitstart . ',' . $limit
				. ') AS x '
				. 'INNER JOIN `#__community_photos` AS b '
				. 'ON x.id=b.albumid '
				. 'GROUP BY x.id '
				. 'ORDER BY x.`created` DESC';
				
		//echo $query;exit;		

		$db->setQuery( $query );
		$result	= $db->loadObjectList();

		if($db->getErrorNum())
		{
			JError::raiseError(500, $db->stderr());
		}
		
		// Update their correct Thumbnails and check album permissions
		if( !empty($result) )
		{
			foreach( $result as &$row ){
				//$photo = $this->getPhoto($row->photoid);
				$photo	=& JTable::getInstance( 'Photo' , 'CTable' );
				$photo->bind($row);
				$photo->id = $row->photoid; // the id was photo_album id, need to fix it
				$row->thumbnail = $photo->getThumbURI();
			}
		}

		return $result;
		
	}


	function checkAlbumsPermissions($row,$myId)
	{
		CFactory::load( 'helpers' , 'friends' );
		
		switch ($row->permissions)
		{
			case 0:
					$result	= true;
				break;
			case 20:
					$result	= !empty($myId) ? true : false;
				break;
			case 30:
					$result	= friendIsConnected ( $row->creator, $myId ) ? true : false;
			  	break;
			case 40:
					$result	= $row->creator == $myId ? true : false;
			  	break;
			default:
					$result = false;
				break;
		}
		
		return $result;
	}
	
	/**
	 * Get site wide albums
	 * 
	 **/	 
	function getSiteAlbums( $type = PHOTOS_USER_TYPE )
	{
		$db			=& $this->getDBO();
		$searchType	= '';
		
		if( $type == PHOTOS_GROUP_TYPE )
		{
			$searchType	= PHOTOS_GROUP_TYPE;
		}
		else
		{
			$searchType	= PHOTOS_USER_TYPE;
		}
		
		// Get limit
		$limit		= $this->getState('limit');
		$limitstart	= $this->getState( 'limitstart' );

		// Get total albums
		$query	= 'SELECT COUNT(DISTINCT(a.id)) '
				. 'FROM ' . $db->nameQuote( '#__community_photos_albums' ) . ' AS a '
				. 'INNER JOIN ' . $db->nameQuote( '#__community_photos' ) . ' AS b '
				. 'ON a.id=b.albumid '
				. 'WHERE a.type=' . $db->Quote( $searchType );

		$db->setQuery( $query );
		$total	= $db->loadResult();

		if($db->getErrorNum())
		{
			JError::raiseError( 500, $db->stderr());
		}

		// Appy pagination
		if( empty($this->_pagination) )
		{
	 	    jimport('joomla.html.pagination');
	 	    $this->_pagination = new JPagination($total, $limitstart, $limit);
	 	}
	 	
		$query	= 'SELECT a.*, '
				. 'COUNT( DISTINCT(b.id) ) AS count, '
				. 'MAX(b.created) AS lastupdated, '
				. 'c.thumbnail, '
				. 'c.storage, '
				. 'c.id AS photoid '
				. 'FROM ' . $db->nameQuote( '#__community_photos_albums' ) . ' AS a '
				. 'INNER JOIN ' . $db->nameQuote( '#__community_photos' ) . ' AS b '
				. 'ON a.id=b.albumid '
				. 'LEFT JOIN ' . $db->nameQuote( '#__community_photos' ) . ' AS c '
				. 'ON a.photoid=c.id '
				. 'WHERE a.type=' . $db->Quote( $searchType ) . ' '
				. 'GROUP BY a.id '
				. 'ORDER BY a.`created` DESC '
				. 'LIMIT ' . $limitstart . ',' . $limit;

		$db->setQuery( $query );
		$result	= $db->loadObjectList();

		if($db->getErrorNum())
		{
			JError::raiseError(500, $db->stderr());
		}
		
		// Update their correct Thumbnails
		if( !empty($result) )
		{
			foreach( $result as &$row ){
				//$photo = $this->getPhoto($row->photoid);
				$photo	=& JTable::getInstance( 'Photo' , 'CTable' );
				$photo->bind($row);
				$photo->id = $row->photoid; // the id was photo_album id, need to fix it
				$row->thumbnail = $photo->getThumbURI();
			}
		}
		
		 		
		return $result;
	}
	
	function getGroupAlbums( $groupId = '' , $pagination = false , $doubleLimit = false, $limit="" , $isAdmin = false, $creator = '' )
	{
		$db			=& $this->getDBO();
		$extraSQL	= ' WHERE a.type = ' . $db->Quote( PHOTOS_GROUP_TYPE );
		$extraSQL	.= ' AND a.groupid=' . $db->Quote( $groupId ) . ' ';
		
		if( !$isAdmin && !empty($creator) )
		{
			$extraSQL	.= ' AND a.creator=' . $db->Quote( $creator ) . ' '; 
		}

		// Get limit
		$limit		= (!empty($limit)) ? $limit : $this->getState('limit');
		$limit		= ( $doubleLimit ) ? $this->getState('limit') : $limit;
		$limitstart	= $this->getState( 'limitstart' );
		
		// Get total albums
		$query	= 'SELECT COUNT(*) '
				. 'FROM ' . $db->nameQuote( '#__community_photos_albums' ) . ' AS a'
				. $extraSQL;

		$db->setQuery( $query );
		$total			= $db->loadResult();
		$this->total	= $total;
		
		if($db->getErrorNum())
		{
			JError::raiseError( 500, $db->stderr());
		}

		// Appy pagination
		if( empty($this->_pagination) )
		{
	 	    jimport('joomla.html.pagination');
	 	    $this->_pagination = new JPagination($total, $limitstart, $limit);
	 	}

		$query	= 'SELECT a.*, '
				. 'COUNT( DISTINCT(b.id) ) AS count, '
				. 'MAX(b.created) AS lastupdated, '
				. 'c.thumbnail as thumbnail, '
				. 'c.storage AS storage, '
				. 'c.id as photoid '
				. 'FROM ' . $db->nameQuote( '#__community_photos_albums' ) . ' AS a '
				. 'LEFT JOIN ' . $db->nameQuote( '#__community_photos' ) . ' AS b '
				. 'ON a.id=b.albumid '
				. 'LEFT JOIN ' . $db->nameQuote( '#__community_photos' ) . ' AS c '
				. 'ON a.photoid=c.id '
				. $extraSQL
				. 'GROUP BY a.id '
				. ' ORDER BY a.`created` DESC';
		if( $pagination )
		{
			$query	.= ' LIMIT ' . $limitstart . ',' . $limit;
		}

		$db->setQuery( $query );
		$result	= $db->loadObjectList();

		if($db->getErrorNum())
		{
			JError::raiseError(500, $db->stderr());
		}
		
		// Update their correct Thumbnails
		if( !empty($result) )
		{
			foreach( $result as &$row ){
				$photo	=& JTable::getInstance( 'Photo' , 'CTable' );
				$photo->bind($row);
				$photo->id = $row->photoid; // the id was photo_album id, need to fix it
				$row->thumbnail = $photo->getThumbURI();
			}
		}
		
		return $result;
	}
	
	/**
	 * Get the albums for specific user or site wide
	 * 
	 * @param	userId	string	The specific user id
	 * 	 
	 **/	 
	function getAlbums( $userId = '' , $pagination = false, $doubleLimit = false )
	{
		return $this->_getAlbums( $userId , PHOTOS_USER_TYPE , $pagination , $doubleLimit );
	}

	function _getAlbums( $id , $type , $pagination = false , $doubleLimit = false, $limit="" )
	{
		$db			=& $this->getDBO();
		$extraSQL	= ' WHERE a.type = ' . $db->Quote( $type );

		if( !empty($id) && $type == PHOTOS_GROUP_TYPE )
		{
			$extraSQL	.= ' AND a.groupid=' . $db->Quote( $id ) . ' ';
		}
		else if( !empty( $id ) && $type == PHOTOS_USER_TYPE )
		{
			$extraSQL	.= ' AND a.creator=' . $db->Quote( $id ) . ' ';
		}

		// Get limit
		$limit		= (!empty($limit)) ? $limit : $this->getState('limit');
		$limit		= ( $doubleLimit ) ? $this->getState('limit') : $limit;
		$limitstart	= $this->getState( 'limitstart' );
		
		// Get total albums
		$query	= 'SELECT COUNT(*) '
				. 'FROM ' . $db->nameQuote( '#__community_photos_albums' ) . ' AS a'
				. $extraSQL;

		$db->setQuery( $query );
		$total			= $db->loadResult();
		$this->total	= $total;
		
		if($db->getErrorNum())
		{
			JError::raiseError( 500, $db->stderr());
		}

		// Appy pagination
		if( empty($this->_pagination) )
		{
	 	    jimport('joomla.html.pagination');
	 	    $this->_pagination = new JPagination($total, $limitstart, $limit);
	 	}

		$query	= 'SELECT a.*, '
				. 'COUNT( DISTINCT(b.id) ) AS count, '
				. 'MAX(b.created) AS lastupdated, '
				. 'c.thumbnail as thumbnail, '
				. 'c.storage AS storage, '
				. 'c.id as photoid '
				. 'FROM ' . $db->nameQuote( '#__community_photos_albums' ) . ' AS a '
				. 'LEFT JOIN ' . $db->nameQuote( '#__community_photos' ) . ' AS b '
				. 'ON a.id=b.albumid '
				. 'LEFT JOIN ' . $db->nameQuote( '#__community_photos' ) . ' AS c '
				. 'ON a.photoid=c.id '
				. $extraSQL
				. 'GROUP BY a.id '
				. ' ORDER BY a.`created` DESC';
		if( $pagination )
		{
			$query	.= ' LIMIT ' . $limitstart . ',' . $limit;
		}

		$db->setQuery( $query );
		$result	= $db->loadObjectList();

		if($db->getErrorNum())
		{
			JError::raiseError(500, $db->stderr());
		}
		
		// Update their correct Thumbnails
		if( !empty($result) )
		{
			foreach( $result as &$row ){
				$photo	=& JTable::getInstance( 'Photo' , 'CTable' );
				$photo->bind($row);
				$photo->id = $row->photoid; // the id was photo_album id, need to fix it
				$row->thumbnail = $photo->getThumbURI();
			}
		}
		
		return $result;
	}
	
	function isCreator($photoId , $userId)
	{
		// Guest has no album
		if($userId == 0)
			return false;
			
		$db	=& $this->getDBO();
		
		$strSQL	= 'SELECT COUNT(*) FROM ' . $db->nameQuote('#__community_photos') . ' '
				. 'WHERE ' . $db->nameQuote('id') . '=' . $db->Quote($photoId) . ' '
				. 'AND creator=' . $db->Quote($userId);

		$db->setQuery($strSQL);
		$result	= $db->loadResult();
		
		return $result;
	}

	/**
	 * Return CPhoto object
	 */	 	
	function getPhoto($id)
	{
		$photo	=& JTable::getInstance( 'Photo' , 'CTable' );
		$photo->load( $id );
		
		return $photo;
	}
	
	/**
	 * Get the count of the photos from specific user or groups.
	 * @param id user or group id	 
	 **/	 	
	function getPhotosCount( $id , $photoType = PHOTOS_USER_TYPE )
	{
		$db		=& $this->getDBO();
		
		$query	= 'SELECT COUNT(1) FROM ' 
				. $db->nameQuote( '#__community_photos' ) . ' AS a '
				. 'INNER JOIN ' . $db->nameQuote( '#__community_photos_albums' ) . ' AS b '
				. 'ON a.albumid=b.id '
				. 'AND b.type=' . $db->Quote( $photoType );
		
		if( $photoType == PHOTOS_GROUP_TYPE )
		{
			$query	.= ' WHERE b.groupid=' . $db->Quote( $id );
		}
		else
		{
			$query	.= ' WHERE a.creator=' . $db->Quote( $id );
		}
		$query	.= ' AND `albumid`!=0';
				
		
		$db->setQuery( $query );
		$count	= $db->loadResult();
		
		return $count;
	}
	
	function getDefaultImage( $albumId ){
		$db	=& $this->getDBO();
		
		$strSQL	= 'SELECT b.* FROM ' . $db->nameQuote('#__community_photos_albums') . ' AS a '
				. 'INNER JOIN ' . $db->nameQuote('#__community_photos') . 'AS b '
				. 'WHERE a.id=' . $db->Quote($albumId) . ' '
				. 'AND a.photoid=b.id';

		//echo $strSQL;
		$db->setQuery($strSQL);
		$result	= $db->loadObject();
		
		return $result;
	}
	
	function setDefaultImage( $albumId , $photoId )
	{
		$db	=& $this->getDBO();
		
		$data	= $this->getAlbum($albumId);
		
		$data->photoid	= $photoId;
		
		$db->updateObject( '#__community_photos_albums' , $data , 'id');
	}
	
	function setCaption( $photoId , $caption )
	{
		$db		=& $this->getDBO();
		$data	= $this->getPhoto( $photoId );
		$data->caption	= $caption;
		
		$db->updateObject( '#__community_photos' , $data , 'id' );
		
		return $data;
	}
	
	function isGroupPhoto( $photoId )
	{
		$db	=& $this->getDBO();
		
		$query	= 'SELECT b.`type` FROM `#__community_photos` AS a';
		$query	.= ' INNER JOIN `#__community_photos_albums` AS b';
		$query	.= ' ON a.`albumid` = b.`id`';
		$query	.= ' WHERE a.`id` = ' . $db->Quote($photoId);
		
		$db->setQuery($query);
		$type	= $db->loadResult();
		
		if($type == PHOTOS_GROUP_TYPE)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	function getPhotoGroupId( $photoId )
	{
		$db	=& $this->getDBO();
		
		$query	= 'SELECT b.`groupid` FROM `#__community_photos` AS a';
		$query	.= ' INNER JOIN `#__community_photos_albums` AS b';
		$query	.= ' ON a.`albumid` = b.`id`';
		$query	.= ' WHERE a.`id` = ' . $db->Quote($photoId);
		$query	.= ' AND b.`type` = ' . $db->Quote(PHOTOS_GROUP_TYPE);
		
		$db->setQuery($query);
		$type	= $db->loadResult();
		
		return $type; 
	}	
	
}

class CTableAlbum extends JTable 
{
	var $id 			= null;
	
	/** Album cover , FK to the photo id **/
	var $photoid 		= null;
	var $creator		= null;
  	var $name			= null;
  	var $description	= null;
	var $permissions	= null;
	var $created		= null;
	var $path			= null;
	var $type			= null;
	var $groupid		= null;
	
	/**
	 * Constructor
	 */	 	
	function __construct( &$db )
	{
		parent::__construct( '#__community_photos_albums', 'id', $db );
	}
	
	
	/**
	 * Return the path to the cover photo
	 * If no cover photo is specifies, we just load the first photo in the album 	 
	 */	 	
	function getCoverThumbPath()
	{
		$photoModel =& CFactory::getModel('photos');
		$photo = $photoModel->getPhoto($this->photoid);
		
		// If this photo doesn't exist, we need to select a new valid one
		// @todo: test and see if the photo actually exist
		
		
		return $photo->getThumbURI();
	}
	
	/**
	 * Return the number of photos in this album
	 */	 	
	function getPhotosCount()
	{
		$model = CFactory::getModel('photos');
		return $model->getPhotosCount();
	}
	
	/**
	 * Delete an album
	 * Set all photo within the album to have albumid = 0
	 * Do not yet delete the photos, this could be very slow on an album that 
	 * has huge amount of photos	 	 	 
	 */	 	
	function delete()
	{
		
		$db	=& JFactory::getDBO();		
		$strSQL	= 'UPDATE ' . $db->nameQuote('#__community_photos')
				.' SET `albumid`=' . $db->Quote(0)
				.' WHERE `albumid`=' . $db->Quote($this->id) ;

		$db->setQuery($strSQL);
		$result	= $db->query();
					
		// The whole local folder should be deleted, regardless of the storage type
		// BUT some old version of JomSocial might store other photo in the same 
		// folder, we check in db first
		$strSQL	= 'SELECT count(*) FROM ' . $db->nameQuote('#__community_photos')
				.' WHERE `image` LIKE ' . $db->Quote('%'.dirname( $this->path ).'%') ;
		$db->setQuery($strSQL);
		$result	= $db->loadResult();

		if($result == 0)
		{
			JFolder::delete(dirname(JPATH_ROOT.DS.$this->path ));
		}
		
		// We need to delete all activity stream related to this album
		CFactory::load('libraries', 'activities');
		CActivityStream::remove('photos' , $this->id );
		
		return parent::delete();
	}
}

class CTablePhoto extends JTable 
{
	var $id = null;
	var $albumid = null;
  	var $name = null;
  	var $caption = null;
	var $permissions = null;
	var $created = null;
	var $thumbnail = null;
	var $image = null;
	var $creator = null;
	var $published = null;
	var $original	= null;
	var $filesize	= null;
	var $storage	= 'file';
  	
	/**
	 * Constructor
	 */	 	
	function __construct( &$db ) {
		parent::__construct( '#__community_photos', 'id', $db );
	}

	/**
	 * Overrides parent store function as we need to clean up some variables
	 **/
	function store()
	{
		$this->image		= JString::str_ireplace( '\\' , '/' , $this->image );
		$this->thumbnail	= JString::str_ireplace( '\\' , '/' , $this->thumbnail );
		$this->original		= JString::str_ireplace( '\\' , '/' , $this->original );

		return parent::store();
	}
	
	/**
	 * Delete the photo, the original and the actual resized photos and thumbnails
	 */	 	
	function delete()
	{
		
		CFactory::load('libraries', 'storage');
		$storage = CStorage::getStorage($this->storage);
		$storage->delete($this->image);
		$storage->delete($this->thumbnail);
		JFile::delete(JPATH_ROOT.DS.$this->original);
		
		// If the original path is empty, we can delete it too
		$files = JFolder::files( dirname(JPATH_ROOT.DS.$this->original) );
		if(empty($files)){
			JFolder::delete( dirname(JPATH_ROOT.DS.$this->original) );
		}
		
		
		return parent::delete();
	}
	/**
	 * Return the exact URL  
	 */	 	
	function getThumbURI(){
		
		// if the photoid = 0, we return the default thumb path
		if( empty($this->id))
		{
			return rtrim( JURI::root() , '/' ) . '/components/com_community/assets/album_thumb.jpg';
		}
		
		CFactory::load('libraries', 'storage');
		$uri = '';
		if($this->storage != 'file'){
			$storage = CStorage::getStorage($this->storage);
			$uri = $storage->getURI($this->thumbnail);
		} else {
			$uri = rtrim( JURI::root() , '/' ) . '/' . $this->thumbnail;
		}
		return $uri;
		
	}
	
	/**
	 * Return the exist URL to be displayed.
	 * @param size string, (normal, origianl, small)	 
	 */	 	
	function getImageURI($size = 'normal')
	{
		CFactory::load('libraries', 'storage');
		$uri = '';
		if($this->storage != 'file'){
			$storage = CStorage::getStorage($this->storage);
			$uri = $storage->getURI($this->image);
		} else {
			$uri = JURI::root() . 'index.php?option=com_community&view=photos&task=showimage&tmpl=component&imgid='. $this->image;
		}
		return $uri;
	}
	
	/**
	 * Return the URI of the original photo
	 */	 	
	function getOriginalURI()
	{
		$uri = rtrim( JURI::root() , '/' ) . '/' . $this->original;
		return $uri;
	}
	// Load the Photo object given the image path
	function loadFromImgPath($path)
	{
		$db	=& JFactory::getDBO();
		
		$strSQL	= 'SELECT (id) FROM ' . $db->nameQuote('#__community_photos') 
				. 'WHERE `image`=' . $db->Quote($path) ;

		//echo $strSQL;
		$db->setQuery($strSQL);
		$result	= $db->loadObject();
		
		if($db->getErrorNum())
		{
			JError::raiseError(500, $db->stderr());
		}

		// Backward compatibility because anything prior to this version uses id
		// @since 1.6
		if( !$result )
		{
			$id		= $path;
			$this->load( $id );
			return $id;
		}

		$this->load($result->id);
		return $result;
	}
}
