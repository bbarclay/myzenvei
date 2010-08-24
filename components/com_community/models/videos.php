<?php
/**
 * @copyright (C) 2009 by Slashes & Dots Sdn Bhd - All rights reserved!
 * @license http://www.jomsocial.com Copyrighted Commercial Software
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

require_once ( JPATH_ROOT .DS.'components'.DS.'com_community'.DS.'models'.DS.'models.php');

class CommunityModelVideos extends JCCModel
{
	var $_pagination 	= '';
	var $total			= '';

	function CommunityModelVideos()
	{
		parent::JCCModel();
		
		$id = JRequest::getVar('videoid', 0, '', 'int');
		$this->setId((int)$id);

 	 	$mainframe = JFactory::getApplication();

 	 	// Get the pagination request variables		
 	 	$limit		= ($mainframe->getCfg('list_limit') == 0) ? 5 : $mainframe->getCfg('list_limit');
	    $limitstart = JRequest::getVar('limitstart', 0, 'REQUEST');

		// In case limit has been changed, adjust limitstart accordingly
		$limitstart = ($limit != 0 ? (floor($limitstart / $limit) * $limit) : 0);

		$this->setState('limit', $limit);
		$this->setState('limitstart', $limitstart);
	}

	function setId($id)
	{
		// Set new video ID and wipe data
		$this->_id		= $id;
	}

	/**
	 *	Checks whether specific user or group has pending videos
	 *	
	 *	@params	$id	int	The unique id of the creator or groupid
	 *	@params	$type	string	The video type whether user or group	 	 	 
	 **/
	function hasPendingVideos( $id , $type = VIDEO_USER_TYPE )
	{
		if($type == VIDEO_USER_TYPE && $id == 0)
		{
			return 0;
		}
		
		$db		= $this->getDBO();
		
		$query	= 'SELECT COUNT(*) FROM ' . $db->nameQuote( '#__community_videos' ) . ' '
				. 'WHERE ' . $db->nameQuote( 'creator_type') . '=' . $db->Quote( $type ) . ' ';
				
		if( $type == VIDEO_USER_TYPE )
		{
			$query	.= 'AND ' . $db->nameQuote( 'creator' ) . '=' . $db->Quote( $id );
		}
		else
		{
			$query	.= 'AND ' . $db->nameQuote( 'groupid' ) . '=' . $db->Quote( $id );
		}
		
		$query	.= ' AND ' . $db->nameQuote( 'status' ) . '=' . $db->Quote( 'pending' );
		$query	.= ' AND ' . $db->nameQuote( 'published' ) . '=' . $db->Quote( 1 );
		
		$db->setQuery($query);
		$result	= $db->loadResult() >= 1 ? true : false;
		
		return $result;
	}
	
	/**
	 * Loads the videos
	 * 
	 * @public
	 * @param	array	$filters	The video's filter
	 * @return	array	An array of videos object
	 * @since	1.2
	 */
	function getVideos($filters = array())
	{
		$db		= $this->getDBO();

		$where	= array();
		foreach ($filters as $field => $value)
		{
			if ($value || $value === 0)
			{
				switch (strtolower($field))
				{
					case 'id':
						if (is_array($value)) {
							JArrayHelper::toInteger($value);
							$value	= implode( ',', $value );
						}
						$where[]	= 'v.`id` IN (' . $value . ')';
						break;
					case 'title':
						$where[]	= 'v.`title`  LIKE ' . $db->quote('%' . $value . '%');
						break;
					case 'type':
						$where[]	= 'v.`type` = ' . $db->quote($value);
						break;
					case 'description':
						$where[]	= 'v.`description` LIKE ' . $db->quote('%' . $value . '%');
						break;
					case 'creator':
						$where[]	= 'v.`creator` = ' . $db->quote((int)$value);
						break;
					case 'creator_type':
						$where[]	= 'v.`creator_type` = ' . $db->quote($value);
						break;
					case 'created':
						$value		= JFactory::getDate($value)->toMySQL();
						$where[]	= 'v.`created` BETWEEN ' . $db->quote('1970-01-01 00:00:01') . ' AND ' . $db->quote($value);
						break;
					/*case 'and_group_privacy':
						// if there is no video found with given group privacy
						// value, this filter will be ignored.
						// careful if this filter is set, or_group_privacy will
						// not be working. see line 185
						$config		= CFactory::getConfig();
						if ($config->get('groupvideos'))
						{
							$query	= 'SELECT ' . $db->nameQuote( 'id' )
									. ' FROM ' . $db->nameQuote( '#__community_groups' )
									. ' WHERE ' . $db->nameQuote( 'approvals' ) . '<=' . $db->Quote( $value );
							$db->setQuery($query);
							$groupId	= $db->loadResultArray();
							if ($groupId)
							{
								$idString	= implode(', ', $groupId);
								$where[]	= $db->nameQuote('groupid') . ' IN ( ' . $idString . ')';
							}
							unset($groupId);
						}
						break;
					*/
					case 'permissions':
						$where[]	= 'v.`permissions` <= ' . $db->quote((int)$value);
						break;
					case 'category_id':
						if (is_array($value)) {
							JArrayHelper::toInteger($value);
							$value	= implode( ',', $value );
						}
						$where[]	= 'v.`category_id` IN (' . $value . ')';
						break;
					case 'hits':
						$where[]	= 'v.`hits` >= ' . $db->quote((int)$value);
						break;
					case 'published':
						$where[]	= 'v.`published` = ' . $db->quote((bool)$value);
						break;
					case 'featured':
						$where[]	= 'v.`featured` = ' . $db->quote((bool)$value);
						break;
					case 'duration':
						$where[]	= 'v.`duration` >= ' . $db->quote((int)$value);
						break;
					case 'status':
						$where[]	= 'v.`status` = ' . $db->quote($value);
						break;
					case 'groupid':
						$where[]	= 'v.`groupid` = ' . $db->quote($value);
						break;
					case 'limitstart':
						$limitstart	= (int) $value;
						break;
					case 'limit':
						$limit		= (int) $value;
						break;					
				}
			}
		}

		$where		= count($where) ? ' WHERE ' . implode(' AND ', $where) : '';
		
		// Or-Group-Privacy Filter
		// Any videos that match or less than the filter value will be included
		/*if (isset($filters['or_group_privacy']) && !isset($filters['and_group_privacy']))
		{
			$config		= CFactory::getConfig();
			if ($config->get('groupvideos'))
			{
				$query	= 'SELECT ' . $db->nameQuote( 'id' )
						. ' FROM ' . $db->nameQuote( '#__community_groups' )
						. ' WHERE ' . $db->nameQuote( 'approvals' ) . '<=' . $db->Quote( $filters['or_group_privacy'] );
				$db->setQuery($query);
				$groupId	= $db->loadResultArray();
				if ($groupId)
				{
					$idString	= implode(', ', $groupId);
					$where		.= ' OR ' . $db->nameQuote('groupid') . ' IN ( ' . $idString . ')';
				}
			}
		}*/
		// Joint with group table
		$join	= '';
		if (isset($filters['or_group_privacy']))
		{
			$approvals	= (int) $filters['or_group_privacy'];
			$join		=  ' LEFT JOIN ' . $db->nameQuote('#__community_groups') . ' AS g';
			$join 		.= ' ON g.id = v.groupid';
			$where		.= ' AND (g.approvals = 0 OR g.approvals IS NULL)';
		}

		$order		= '';
		$sorting	= isset($filters['sorting']) ? $filters['sorting'] : 'latest';

		switch ($sorting)
		{
			case 'mostwalls':
				// mostwalls is sorted below using JArrayHelper::sortObjects
				// since in db vidoes doesn't has wallcount field
			case 'mostviews':
				$order	= ' ORDER BY v.`hits` DESC';
				break;
			case 'title':
				$order	= ' ORDER BY v.`title` ASC';
				break;
			case 'latest':
			default :
				$order	= ' ORDER BY v.`created` DESC';
				break;
		}

		$limit		= (isset($limit)) ? $limit : $this->getState('limit');
		$limitstart = (isset($limitstart)) ? $limitstart : $this->getState('limitstart');

		$limiter	= ' LIMIT '	. $limitstart . ', ' . $limit;

		$query		= ' SELECT v.*, v.created AS lastupdated'
					. ' FROM ' . $db->nameQuote('#__community_videos') . ' AS v'
					. $join
					. $where
					. $order
					. $limiter;
		$db->setQuery($query);// echo $db->_sql;exit;
		$result		= $db->loadObjectList();

		if ($db->getErrorNum())
			JError::raiseError(500, $db->stderr());

		// Get total of records to be used in the pagination
		$query		= ' SELECT COUNT(*)'
					. ' FROM ' . $db->nameQuote('#__community_videos') . ' AS v'
					. $join
					. $where
					;
		$db->setQuery($query);
		$total		= $db->loadResult();
		$this->total	= $total;

		if($db->getErrorNum())
			JError::raiseError( 500, $db->stderr());

		// Apply pagination
		if (empty($this->_pagination)) {
	 	    jimport('joomla.html.pagination');
	 	    $this->_pagination	= new JPagination($total, $limitstart, $limit);
	 	}


		// Add the wallcount property for sorting purpose
		foreach ($result as $video) {
			// Wall post count
			$query	= ' SELECT COUNT(*)'
					. ' FROM ' . $db->nameQuote('#__community_wall')
					. ' WHERE ' . $db->nameQuote('type') . ' = ' . $db->quote('videos')
					. ' AND ' . $db->nameQuote('published') . ' = ' . $db->quote(1)
					. ' AND ' . $db->nameQuote('contentid') . ' = ' . $db->quote($video->id)
					;
			$db->setQuery($query);
			$video->wallcount	= $db->loadResult();
		}

		// Sort videos according to wall post count
		if ($sorting == 'mostwalls')
			JArrayHelper::sortObjects( $result, 'wallcount', -1);

		return $result;
	}

	/**
	 * Loads the categories
	 * 
	 * @access	public
	 * @return	array	An array of categories object
	 * @since	1.2
	 */
	function getCategories()
	{
		$my			= CFactory::getUser();
		$permissions= ($my->id==0) ? 0 : 20;
		$groupId	= JRequest::getVar('groupid' , '' , 'GET');
		$conditions = '';
		$db			= $this->getDBO();
		
		if( !empty($groupId) )
		{
			$conditions	= ' AND v.creator_type = ' . $db->quote(VIDEO_GROUP_TYPE);
			//$conditions	.= ' AND b.groupid = ' . $groupId;
			$conditions	.= ' AND g.id = ' . $groupId;
		}
		else
		{
			$conditions	.= ' AND (g.approvals = 0 OR g.approvals IS NULL)';
		}
		
		$query	= ' SELECT c.*, COUNT(v.id) AS count'
				. ' FROM ' . $db->nameQuote('#__community_videos_category') . ' AS c'
				. ' LEFT JOIN ' . $db->nameQuote('#__community_videos') . ' AS v ON c.id = v.category_id'
				. ' LEFT JOIN ' . $db->nameQuote('#__community_groups') . ' AS g ON g.id = v.groupid'
				. ' WHERE v.status = ' . $db->Quote('ready')
				. ' AND v.published = ' . $db->Quote(1)
				. ' AND v.permissions <= ' . $db->Quote($permissions)
				. $conditions
				. ' GROUP BY c.id';

		$db->setQuery( $query );
		$result	= $db->loadObjectList();

		if($db->getErrorNum())
			JError::raiseError( 500, $db->stderr());

		return $result;
	}
	
	function getAllCategories()
	{
		$db		= $this->getDBO();
		$query	= ' SELECT * '
				. ' FROM ' . $db->nameQuote('#__community_videos_category');
		$db->setQuery($query);
		$result	= $db->loadObjectList();
		return $result;
	}

	function getPagination()
	{
	    return $this->_pagination;
	}
	
	function getTotal()
	{
	    return $this->total;
	}
	
	function deleteVideoWalls($id)
	{
		if (!$id) return;
		$db		= $this->getDBO();
		$query	= 'DELETE FROM ' . $db->nameQuote('#__community_wall')
				. ' WHERE ' . $db->nameQuote('contentid') . ' = ' . $db->quote($id)
				. ' AND ' . $db->nameQuote('type') . ' = ' . $db->quote('videos');
		$db->setQuery($query);
		$db->query();
		if($db->getErrorNum()){
			JError::raiseError( 500, $db->stderr());
		}
		return true;
	}
	
	function deleteVideoActivities($id = 0)
	{
		if (!$id) return;
		$db		= $this->getDBO();
		$query	= 'DELETE FROM ' . $db->nameQuote('#__community_activities')
				. ' WHERE ' . $db->nameQuote('app') . ' = ' . $db->quote('videos')
				. ' AND ' . $db->nameQuote('cid') . ' = ' . $db->quote($id);
		$db->setQuery($query);
		$db->query();
		if($db->getErrorNum()){
			JError::raiseError( 500, $db->stderr());
		}
		return true;
	}
	
	/**
	 * Returns Group's videos
	 *
	 * @access public
	 * @param integer the id of the group
	 */	 
	function getGroupVideos( $groupid, $categoryid="", $limit="" )
	{
		$filter	= array(
			'groupid'		=> $groupid,
			'published'		=> 1,
			'status'		=> 'ready',
			'category_id'	=> $categoryid,
			'creator_type' 	=> VIDEO_GROUP_TYPE,
			'sorting'		=> JRequest::getVar('sort', 'latest'),
			'limit'			=> $limit
		);
		
		$videos 		= $this->getVideos( $filter );
		
		return $videos;
	}
	
	function getPendingVideos()
	{
		$filter		= array('status' => 'pending');
		return $this->getVideos($filter);
	}
	
	/**
	 * Get the count of the videos from specific user
	 **/
	function getVideosCount( $userId = 0, $videoType = VIDEO_USER_TYPE )
	{
		if ($userId==0) return 0;
		
		$db		= $this->getDBO();
		
		$query	= 'SELECT COUNT(1) FROM ' 
				. $db->nameQuote( '#__community_videos' ) . ' AS a '
				. 'WHERE creator=' . $db->Quote( $userId ) . ' '
				. 'AND creator_type=' . $db->Quote( $videoType );
		
		$db->setQuery( $query );
		$count	= $db->loadResult();
		
		return $count;
	}
}


class CTableVideosCategory extends JTable 
{
	var $id 			= null;
	var $name 			= null;
  	var $description	= null;
  	var $published		= null;

	/**
	 * Constructor
	 */
	function CTableVideosCategory( &$db )
	{
		parent::__construct( '#__community_videos_category', 'id', $db );
	}	
}


class CTableVideo extends JTable 
{
	//Table's field
	var $id 			= null;
	var $title 			= null;
  	var $type 			= null;
	var $video_id 	    = null;
  	var $description 	= null;
  	var $creator 		= null;
  	var $creator_type	= null;
	var $created 		= null;
	var $permissions	= null;
	var $category_id 	= null;
	var $hits 			= null;
	var $published		= null;
	var $featured		= null;
	var $duration 		= null;
	var $status 		= null;
	var $thumb			= null;
	var $path			= null;
	var $groupid		= null;
	var $storage		= null;

	//non-table fields
	var $_wallcount		= 0;
	var $_size			= 0;
	var $_width			= 0;
	var $_height		= 0;
	var $_lastupdated	= null;
	
	var $_videoUrl		= null;
	var $_videoId		= null;
	var $_thumbnail		= null;
	var $_provider		= null;
	
	/**
	 * Constructor
	 */
	function __construct(&$db)
	{
		parent::__construct( '#__community_videos', 'id', $db );

		require_once(JPATH_ROOT .DS. 'components' .DS. 'com_community' .DS. 'libraries' .DS. 'core.php');
		CFactory::load('helpers', 'videos');

		$config			= CFactory::getConfig();
		$this->_size	= $config->get('videosSize');
		$this->_width	= cGetVideoSize('width');
		$this->_height	= cGetVideoSize('height');
		$this->storage	= 'file';
		
		$this->hits		= 0;
	}
	
	
	/**
	 * Load the object and the video provider as well 
	 */	 		 	
	function load( $oid = null)
	{
		if( parent::load( $oid ) )
		{
			// @todo: make sure loading is done ok
			$providerName	= JString::strtolower($this->type);
			$libraryPath	= COMMUNITY_COM_PATH . DS . 'libraries' . DS . 'videos' . DS . $providerName . '.php';
			
			require_once($libraryPath);
			$className		 = 'CTableVideo' . JString::ucfirst($providerName);
			$this->_provider = new $className( $this->_db );
			
			return true;
		}
		return false;

	}
	
	function loadExtra()
	{
 		CFactory::load('helpers', 'videos');
		return cPrepareVideo($this);
	}

	/**
	 * Initialize the video with a new url
	 */	 	
	function init($url)
	{
		// create the provider
		// $this->_provider should be null here
		CFactory::load('libraries', 'videos');
		$videoLib 	= new CVideoLibrary();
		
		$this->_provider = $videoLib->getProvider($url);
		$isValid = $this->_provider->isValid();
		 
		if($isValid)
		{
			$this->title	= $this->_provider->getTitle();
			$this->type		= $this->_provider->getType();
			$this->video_id	= $this->_provider->getId();
			$this->duration	= $this->_provider->getDuration();
			$this->status	= 'ready';
			$this->thumb	= $this->_provider->getThumbnail();
			$this->path 	= $url;
			$this->description=	$this->_provider->getDescription();
			$this->status	= 'ready';
		}
		
		return $isValid;
	}
	
	/**
	 * Make sure hits are user and session sensitive
	 */	 	
	function hit()
	{
		$session = JFactory::getSession();
		if( $session->get('view-video-'. $this->id, false) == false ) {
			parent::hit();
		}
		$session->set('view-video-'. $this->id, true);
	}

	/**
	 * Verify whether weblinks is accessible
	 * 
	 * @param $url
	 * @return boolean
	 */
	function isValid() {
	}

	function getId() {
		return $this->id;
	}

	function getType() {
		return $this->type;
	}

	/**
	 * Get video's title from videoid
	 * 
	 * @access 	public
	 * @param 	videoid
	 * @return video title
	 */
	function getTitle()
	{
		//CError::assert($this->title, '', '!empty');
		$this->title	= $this->title ? $this->title : JText::_('CC UNTITLED VIDEO');
		
		return $this->title;
	}

	/**
	 * Get video's description from videoid
	 * 
	 * @access 	public	 
	 * @return desctiption
	 */
	function getDescription()
	{
		if(empty($this->description))
		{
			$this->description = JText::_('CC NOT AVAILABLE');
		}
		
		return $this->description;
	}

	/**
	 * Get video duration 
	 * 
	 * @return $duration seconds
	 */
	function getDuration()
	{
		//CError::assert($this->duration, '', '!empty');
		if (empty($this->duration))
		{
			$this->duration = 0;
		}
		return $this->duration;
	}

	/**
	 * Get video's thumbnail URL from videoid
	 * 
	 * @access 	public
	 * @param 	videoid
	 * @return url
	 */
	function getThumbnail()
	{
		$uri = '';
		if($this->storage != 'file'){
			CFactory::load('libraries', 'storage');
			$storage = CStorage::getStorage($this->storage);
			$uri = $storage->getURI($this->thumb);
		} else {
			$uri = JURI::root() . $this->thumb;
			// use default thumbnail if it's corrupted
			if (!JFile::exists(JPATH_ROOT.$this->thumb))
			{
				$uri = JURI::root(). '/components/com_community/assets/video_thumb.png';
			}
		}
		return $uri;
	}

	function getSize() {
		return $this->_size;
	}

	function getWidth() {
		return $this->_width;
	}

	function getHeight() {
		return $this->_height;
	}
	
	function getWallCount()
	{
		$query	= ' SELECT COUNT(*)'
				. ' FROM ' . $this->_db->nameQuote('#__community_wall')
				. ' WHERE ' . $this->_db->nameQuote('type') . ' = ' . $this->_db->quote('videos')
				. ' AND ' . $this->_db->nameQuote('published') . ' = ' . $this->_db->quote(1)
				. ' AND ' . $this->_db->nameQuote('contentid') . ' = ' . $this->_db->quote($this->id)
				;
		$this->_db->setQuery($query);
		$this->_wallcount	= $this->_db->loadResult();

		return $this->_wallcount;
	}

	function getLastUpdated()
	{
		$query	= ' SELECT MAX(created) AS lastupdated'
				. ' FROM ' . $this->_db->nameQuote('#__community_videos')
				. ' WHERE ' . $this->_db->nameQuote('id') . ' = '
				. $this->_db->quote($this->getId())
				;
		$this->_db->setQuery($query);
		$this->_lastupdated	= $this->_db->loadResult();

		return $this->_lastupdated;
	}

	function isPending()
	{
		return ($this->status == 'pending');
	}

	function check()
	{
		// Santinise data
		CFactory::load('helpers', 'string');
		$this->title		= cCleanString(JString::trim($this->title));
		$this->description	= cCleanString(JString::trim($this->description));
		$this->category_id	= JString::trim((int)$this->category_id);
		$this->permissions	= JString::trim((int)$this->permissions);
		
		// Validate user information
		if ($this->title == '')
			$this->title = JText::_('CC VIDEO UNTITLED');

		if ($this->description == '')
			$this->description = JText::_('CC VIDEO NO DESCRIPTION');

		if ($this->created == null) {
			$now = JFactory::getDate();
			$this->created = $now->toMySQL();
		}
		
		if ($this->published == null)
			$this->published = 1;

		return true;
	}
	
	/** 
	 * @return $embedvideo specific embeded code to play the video
	 */
	function getViewHTML($videoWidth='425' , $videoHeight='344')
	{
		$id		= ($this->video_id) ? $this->video_id : $this->id;
		$html 	= $this->_provider->getViewHTML($id, $videoWidth , $videoHeight );
		
		return $html;
	}
	
	/**
	 * Return the video provider object
	 */	 	
	function getProvider()
	{
		return $this->_provider;
	}
	
	function store( )
	{
		if (empty($source)) {
			$source	= $this;
		}
		
		if (!$this->check()) {
			return false;
		}
		if (!parent::store()) {
			return false;
		}
		$this->setError('');
		return true;
	}
}

abstract class CVideoProvider extends JObject
{
	abstract function getThumbnail();
	abstract function getTitle();
	abstract function getDuration();
	abstract function getType();
	abstract function init($url);
	abstract function isValid();
	abstract function getViewHTML($videoId, $videoWidth, $videoHeight);
}