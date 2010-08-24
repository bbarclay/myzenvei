<?php
/**
 * @category	Model
 * @package		JomSocial
 * @subpackage	Walls
 * @copyright (C) 2008 by Slashes & Dots Sdn Bhd - All rights reserved!
 * @license http://www.jomsocial.com/license-agreement.html Copyrighted Commercial Software
 */
defined('_JEXEC') or die('Restricted access');

require_once( JPATH_ROOT . DS . 'components' . DS . 'com_community' . DS . 'models' . DS . 'models.php' );

class CommunityModelWall extends JCCModel
{
	var $_pagination	= '';
	
	/**
	 * Return 1 wall object
	 */	 	
	function get($id){
		$db=& JFactory::getDBO();

		$strSQL	= 'SELECT a.* , b.name FROM #__community_wall AS a '
				. 'INNER JOIN #__users AS b '
				. 'WHERE b.id=a.post_by '
				. 'AND a.id=' . $db->Quote( $id ) ;
 
		$db->setQuery( $strSQL );
		
		if($db->getErrorNum()){
			JError::raiseError(500, $db->stderr());
		}
		
		$result = $db->loadObjectList();
		if(empty($result))
			JError::raiseError(500, 'Invalid id given');
			
		return $result[0];
	}
	
	/**
	 * Return an array of wall post
	 */	 	
	function getPost($type, $cid, $limit, $limitstart){
		$db=& JFactory::getDBO();

		$strSQL	= 'SELECT a.* , b.name FROM #__community_wall AS a '
				. 'INNER JOIN #__users AS b '
				. 'WHERE b.id=a.post_by '
				. 'AND a.type=' . $db->Quote( $type ) . ' '
				. 'AND a.contentid=' . $db->Quote( $cid )
				. ' ORDER BY a.date DESC ';
 
		//if($limit > 0)
		{
			$strSQL.= " LIMIT $limitstart , $limit ";
		}

		$db->setQuery( $strSQL );
		//echo '<pre>'.$db->getQuery().'</pre>';
		if($db->getErrorNum()){
			JError::raiseError(500, $db->stderr());
		}
		
		$result=$db->loadObjectList();
		return $result;
	}
	
	
	/**
	 * Store wall post
	 */	 	
	function addPost($type, $cid, $post_by, $message){
		$db	= & JFactory::getDBO();
		
		$now =& JFactory::getDate();
		
		$query = "INSERT INTO #__community_wall SET"
			. ' `contentid`= '. $db->Quote($cid) 
			. ', `type`= '. $db->Quote($type)
			. ', `post_by`= '. $db->Quote($post_by)
			. ', `ip`= '. $db->Quote('127.0.0.1')
			. ', `published`= '. $db->Quote('1')
			. ', `comment`= '. $db->Quote($message)
			. ', `date` ='.$db->Quote($now->toMySQL());

		$db->setQuery( $query );
		$db->query();
		if($db->getErrorNum()) {
			JError::raiseError( 500, $db->stderr());
		}
				
		return $db->insertid();
	}
	
	/**
	 * This function removes all wall post from specific contentid
	 **/	 	
	function deleteAllChildPosts( $uniqueId , $type )
	{
		CError::assert( $uniqueId , '' , '!empty' , __FILE__ , __LINE__ );
		CError::assert( $type , '' , '!empty' , __FILE__ , __LINE__ );

		$db		=& JFactory::getDBO();
		
		$query	= 'DELETE FROM ' . $db->nameQuote( '#__community_wall' ) . ' '
				. 'WHERE ' . $db->nameQuote( 'contentid' ) . '=' . $db->Quote( $uniqueId ) . ' '
				. 'AND ' . $db->nameQuote( 'type' ) . '=' . $db->Quote( $type );
		
		$db->setQuery( $query );
		$db->query();

		 if($db->getErrorNum())
		 {
		 	JError::raiseError(500, $db->stderr());
		 }
		 return true;
	}

	/**
	 *	Deletes a wall entry
	 *	
	 * @param	id int Specific id for the wall
	 * 	 
	 */
	 function deletePost($id)
	 {
	 	CError::assert( $id , '' , '!empty' , __FILE__ , __LINE__ );
	 	
		$db =& JFactory::getDBO();

		//@todo check content id belong valid user b4 delete
		$query	= 'DELETE FROM ' . $db->nameQuote('#__community_wall') . ' '
				. 'WHERE ' . $db->nameQuote('id') . '=' . $db->Quote( $id );
				
		// should we need to check against the content id? Since the wall id is already unique
//.'AND'
//				.'`contentid`='.$db->Quote($contentid);
		 $db->setQuery($query);
		 $db->query();

		 if($db->getErrorNum())
		 {
		 	JError::raiseError(500, $db->stderr());
		 }
		 return true;	 
	 }
	 
	 /**
	  *	Gets the count of wall entries for specific item
	  *	
	  * @params uniqueId	The unique id for the speicific item
	  * @params	type		The unique type for the specific item
	  **/
	 function getCount( $uniqueId , $type )
	 {
	 	CError::assert( $uniqueId , '' , '!empty' , __FILE__ , __LINE__ );
	 	$db		=& $this->getDBO();
	 	
	 	$query	= 'SELECT COUNT(*) FROM ' . $db->nameQuote( '#__community_wall' )
	 			. 'WHERE ' . $db->nameQuote('contentid') . '=' . $db->Quote( $uniqueId )
	 			. 'AND ' . $db->nameQuote( 'type' ) . '=' . $db->Quote( $type );
	 	
	 	$db->setQuery( $query );
	 	$count	= $db->loadResult();
	 	
	 	return $count;
	 }	  	  	  	  	 
	
	
	function getPagination() {
		return $this->_pagination;
	}
}

/**
 * Wall object
 */ 
class CTableWall extends JTable
{
	/** Primary key **/
	var $id 			= null;
	
	/** The unique id of the specific app type **/
	var $contentid		= null;
	
	/** The user id that posted **/
	var $post_by		= null;
	
	/** The IP address of the poster **/
	var $ip				= null;
	
	/** Message **/
	var $comment		= null;
	
	/** Date the comment is posted **/
	var $date			= null;
	
	/** Publish status of the wall **/
	var $published		= null;
	
	/** Application type **/
	var $type			= null;

	/**
	 * Constructor
	 */	 	
	function __construct( &$db )
	{
		parent::__construct( '#__community_wall', 'id', $db );
	}
}
