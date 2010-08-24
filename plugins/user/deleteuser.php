<?php
/**
 * @version		$Id: example.php 10381 2008-06-01 03:35:53Z pasamio $
 * @package		Joomla
 * @subpackage	JFramework
 * @copyright	Copyright (C) 2005 - 2008 Open Source Matters. All rights reserved.
 * @license		GNU/GPL, see LICENSE.php
 * Joomla! is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * See COPYRIGHT.php for copyright notices and details.
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die( 'Restricted access' );

jimport('joomla.plugin.plugin');

class plgUserDeleteUser extends JPlugin {

	function plgUserDeleteUser(& $subject, $config){
		parent::__construct($subject, $config);
	}
	
	function onBeforeDeleteUser($user, $succes, $msg)
	{
		$mainframe =& JFactory::getApplication();
		$this->deleteFromCommunityUser($user);
		$this->deleteFromCommunityWall($user);
		$ids = $this->deleteFromCommunityGroup($user);
		$this->deleteFromCommunityDiscussion($user, $ids);
		$this->deleteFromCommunityPhoto($user);
		$this->deleteFromCommunityMsg($user);
		$this->deleteFromCommunityProfile($user);
		$this->deleteFromCommunityConnection($user);
		$this->deleteFromCommunityApps($user);
		$this->deleteFromCommunityActivities($user);
		$this->deleteFromCommunityVideos($user);
		$this->deleteFromCommunityConnectUsers( $user );
	}
	
	/**
	 * Remove association when a user is removed
	 **/	 	
	function deleteFromCommunityConnectUsers( $user )
	{
		$db		=& JFactory::getDBO();
		
		$query	= 'DELETE FROM ' . $db->nameQuote( '#__community_connect_users') . ' '
				. 'WHERE ' . $db->nameQuote( 'userid' ) . '=' . $db->Quote( $user['id'] );
		$db->setQuery( $query );
		$db->query();
	
		if($db->getErrorNum())
		{
			JError::raiseError( 500, $db->stderr());
		}	
	}
	
	function deleteFromCommunityUser($user){		
		$db =& JFactory::getDBO();
		
		$sql = "DELETE 
				
				FROM 
						".$db->nameQuote("#__community_users")." 
				WHERE 
						".$db->nameQuote("userid")." = ".$db->quote($user['id']);
						
		$db->setQuery($sql);
		$db->Query();
		if($db->getErrorNum()){
			JError::raiseError( 500, $db->stderr());
		}		
	}
	
	function deleteFromCommunityWall($user){		
		$db =& JFactory::getDBO();
		
		$sql = "DELETE 
				
				FROM 
						".$db->nameQuote("#__community_wall")." 
				WHERE 
						(".$db->nameQuote("contentid")." = ".$db->quote($user['id'])." OR 
						".$db->nameQuote("post_by")." = ".$db->quote($user['id']).") AND
						".$db->nameQuote("type")." = ".$db->quote('user');						
		$db->setQuery($sql);
		$db->Query();
		if($db->getErrorNum()){
			JError::raiseError( 500, $db->stderr());
		}
	}
	
	function deleteFromCommunityDiscussion($user, $gids){		
		$db =& JFactory::getDBO();
		
		if(!empty($gids)){
			$sql = "SELECT 
							".$db->nameQuote("id")." 						
					FROM 
							".$db->nameQuote("#__community_groups_discuss")." 
					WHERE 
							".$db->nameQuote("groupid")." IN (".$gids.")";						
			$db->setQuery($sql);
			$row = $db->loadobjectList();
			if($db->getErrorNum()){
				JError::raiseError( 500, $db->stderr());
			}
			
			if(!empty($row)){		
				$count = 0;
				$scount = sizeof($row) - 1;
				$ids = "";
				foreach($row as $data){
					$ids .= $data->id;
					if($count < $scount){
						$ids .= ",";
					}
					$count++;
				}
			}			
			$condition 	= $db->nameQuote("creator")." = ".$db->quote($user['id'])." OR 
						".$db->nameQuote("groupid")." IN (".$gids.")";
		}else{
			$condition 	= $db->nameQuote("creator")." = ".$db->quote($user['id']);
		}
		
		$sql = "DELETE 
				
				FROM 
						".$db->nameQuote("#__community_groups_discuss")." 
				WHERE 
						".$condition;						
		$db->setQuery($sql);
		$db->Query();
		if($db->getErrorNum()){
			JError::raiseError( 500, $db->stderr());
		}
		
		if(!empty($ids)){
			$condition = "(".$db->nameQuote("post_by")." = ".$db->quote($user['id'])." OR 
						   ".$db->nameQuote("contentid")." IN (".$ids."))";
		}else{		
			$condition = $db->nameQuote("post_by")." = ".$db->quote($user['id']);
		}
		
		$sql = "DELETE 
					
				FROM 
						".$db->nameQuote("#__community_wall")." 
				WHERE 
						".$condition." AND 
						".$db->nameQuote("type")." = ".$db->quote('discussions');				
		$db->setQuery($sql);
		$db->Query();
		if($db->getErrorNum()){
			JError::raiseError( 500, $db->stderr());
		}
	}
	
	function deleteFromCommunityPhoto($user){		
		$db =& JFactory::getDBO();
		
		$sql = "DELETE 
				
				FROM 
						".$db->nameQuote("#__community_photos")." 
				WHERE 
						".$db->nameQuote("creator")." = ".$db->quote($user['id']);						
		$db->setQuery($sql);
		$db->Query();
		if($db->getErrorNum()){
			JError::raiseError( 500, $db->stderr());
		}
		
		$sql = "DELETE 
				
				FROM 
						".$db->nameQuote("#__community_photos_albums")." 
				WHERE 
						".$db->nameQuote("creator")." = ".$db->quote($user['id']);
						
		$db->setQuery($sql);
		$db->Query();
		if($db->getErrorNum()){
			JError::raiseError( 500, $db->stderr());
		}
		
		$sql = "DELETE 
				
				FROM 
						".$db->nameQuote("#__community_photos_tokens")." 
				WHERE 
						".$db->nameQuote("userid")." = ".$db->quote($user['id']);
						
		$db->setQuery($sql);
		$db->Query();
		if($db->getErrorNum()){
			JError::raiseError( 500, $db->stderr());
		}
	}
	
	function deleteFromCommunityMsg($user){		
		$db =& JFactory::getDBO();
		
		$sql = "DELETE 
				
				FROM 
						".$db->nameQuote("#__community_msg")." 
				WHERE 
						".$db->nameQuote("from")." = ".$db->quote($user['id']);						
		$db->setQuery($sql);
		$db->Query();
		if($db->getErrorNum()){
			JError::raiseError( 500, $db->stderr());
		}
		
		$sql = "DELETE 
				
				FROM 
						".$db->nameQuote("#__community_msg_recepient")." 
				WHERE 
						".$db->nameQuote("msg_from")." = ".$db->quote($user['id'])." OR 
						".$db->nameQuote("to")." = ".$db->quote($user['id']);
						
		$db->setQuery($sql);
		$db->Query();
		if($db->getErrorNum()){
			JError::raiseError( 500, $db->stderr());
		}
	}
	
	function deleteFromCommunityGroup($user){		
		$db =& JFactory::getDBO();
		
		$sql = "DELETE 
				
				FROM 
						".$db->nameQuote("#__community_groups_bulletins")." 
				WHERE 
						".$db->nameQuote("created_by")." = ".$db->quote($user['id']);
						
		$db->setQuery($sql);
		$db->Query();
		if($db->getErrorNum()){
			JError::raiseError( 500, $db->stderr());
		}		
		
		$sql = "SELECT 
						".$db->nameQuote("id")." 						
				FROM 
						".$db->nameQuote("#__community_groups")." 
				WHERE 
						".$db->nameQuote("ownerid")." = ".$db->quote($user['id']);						
		$db->setQuery($sql);
		$row = $db->loadobjectList();
		if($db->getErrorNum()){
			JError::raiseError( 500, $db->stderr());
		}
		
		if(!empty($row)){		
			$count = 0;
			$scount = sizeof($row) - 1;
			$ids = "";
			foreach($row as $data){
				$ids .= $data->id;
				if($count < $scount){
					$ids .= ",";
				}
				$count++;
			}
					
			$sql = "DELETE 
					
					FROM 
							".$db->nameQuote("#__community_groups_members")." 
					WHERE 
							".$db->nameQuote("groupid")." IN (".$ids.") OR 
							".$db->nameQuote("memberid")." = ".$user['id'];						
			$db->setQuery($sql);
			$db->Query();
			if($db->getErrorNum()){
				JError::raiseError( 500, $db->stderr());
			}
		}
					
		$sql = "DELETE 
				
				FROM 
						".$db->nameQuote("#__community_groups")." 
				WHERE 
						".$db->nameQuote("ownerid")." = ".$db->quote($user['id']);						
		$db->setQuery($sql);
		$db->Query();
		if($db->getErrorNum()){
			JError::raiseError( 500, $db->stderr());
		}
		
		$sql = "DELETE 
				
				FROM 
						".$db->nameQuote("#__community_wall")." 
				WHERE 
						".$db->nameQuote("post_by")." = ".$db->quote($user['id'])." AND
						".$db->nameQuote("type")." = ".$db->quote('groups');						
		$db->setQuery($sql);
		$db->Query();
		if($db->getErrorNum()){
			JError::raiseError( 500, $db->stderr());
		}
		
		$ids = empty($ids)? "" : $ids;
		
		return $ids;
	}
	
	function deleteFromCommunityProfile($user){		
		$db =& JFactory::getDBO();
		
		$sql = "DELETE 
				
				FROM 
						".$db->nameQuote("#__community_fields_values")." 
				WHERE 
						".$db->nameQuote("user_id")." = ".$db->quote($user['id']);
						
		$db->setQuery($sql);
		$db->Query();
		if($db->getErrorNum()){
			JError::raiseError( 500, $db->stderr());
		}
	}
	
	function deleteFromCommunityConnection($user){		
		$db =& JFactory::getDBO();
		
		$sql = "SELECT 
						".$db->nameQuote("connect_from")." 						
				FROM 
						".$db->nameQuote("#__community_connection")." 
				WHERE 
						".$db->nameQuote("connect_to")." = ".$db->quote($user['id']);						
		$db->setQuery($sql);
		$row = $db->loadobjectList();
		if($db->getErrorNum()){
			JError::raiseError( 500, $db->stderr());
		}
		
		if(!empty($row)){
			$count = 0;
			$scount = sizeof($row) - 1;
			$ids = "";				
			foreach($row as $data){
				$ids .= $data->connect_from;
				if($count < $scount){
					$ids .= ", ";
				}
				$count++;
			}		
			
			$sql = "UPDATE
							".$db->nameQuote("#__community_users")." 				
					SET 
							".$db->nameQuote("friendcount")." = ".$db->nameQuote("friendcount")." - 1 
					WHERE 
							".$db->nameQuote("userid")." IN (".$ids.")";						
			$db->setQuery($sql);
			$db->Query();
			if($db->getErrorNum()){
				JError::raiseError( 500, $db->stderr());
			}
		}
		
		$sql = "DELETE 
				
				FROM 
						".$db->nameQuote("#__community_connection")." 
				WHERE 
						".$db->nameQuote("connect_from")." = ".$db->quote($user['id'])." OR 
						".$db->nameQuote("connect_to")." = ".$db->quote($user['id']);						
		$db->setQuery($sql);
		$db->Query();
		if($db->getErrorNum()){
			JError::raiseError( 500, $db->stderr());
		}
	}
	
	function deleteFromCommunityApps($user){		
		$db =& JFactory::getDBO();
				
		$sql = "DELETE 
				
				FROM 
						".$db->nameQuote("#__community_apps")." 
				WHERE 
						".$db->nameQuote("userid")." = ".$db->quote($user['id']);						
		$db->setQuery($sql);
		$db->Query();
		if($db->getErrorNum()){
			JError::raiseError( 500, $db->stderr());
		}
	}
	
	function deleteFromCommunityActivities($user){		
		$db =& JFactory::getDBO();
				
		$sql = "DELETE 
				
				FROM 
						".$db->nameQuote("#__community_activities")." 
				WHERE 
						(".$db->nameQuote("actor")." = ".$db->quote($user['id'])." OR 
						".$db->nameQuote("target")." = ".$db->quote($user['id']).") AND 
						".$db->nameQuote("archived")." = ".$db->quote(0);								
		$db->setQuery($sql);
		$db->Query();
		if($db->getErrorNum()){
			JError::raiseError( 500, $db->stderr());
		}
	}
	
	function deleteFromCommunityVideos($user){
		$db		=& JFactory::getDBO();
		
		$query	= 'DELETE FROM ' . $db->nameQuote('#__community_videos')
				. ' WHERE creator = ' . $db->quote($user['id']);
		$db->setQuery($query);
		$db->Query();
		if($db->getErrorNum()){
			JError::raiseError( 500, $db->stderr());
		}
		
		jimport(joomla.filesystem.folder);
		$library	= JPATH_ROOT . DS . 'components' . DS . 'com_community' . DS . 'libraries' . DS . 'videos.php';
		require_once($library);
		$videoLib 	= new CVideoLibrary();
		
		// Converted Videos Folder
		$videoFolder	= $videoLib->videoRootHome . DS . $user['id'];
		if(JFolder::exists($videoFolder)) {
			JFolder::delete($videoFolder);
		}
		// Original Videos Folder
		$videoFolder	= $videoLib->videoRootOrig . DS . $user['id'];
		if(JFolder::exists($videoFolder)) {
			JFolder::delete($videoFolder);
		}
		
		return true;
	}
}
