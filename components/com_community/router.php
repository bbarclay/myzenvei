<?php
/**
 * @package		JomSocial
 * @subpackage	Core
 * @copyright (C) 2008 by Slashes & Dots Sdn Bhd - All rights reserved!
 * @license http://www.jomsocial.com Copyrighted Commercial Software
 */

defined('_JEXEC') or die('Restricted access');
// Testing Merge

function CommunityBuildRoute(&$query)
{
	$segments = array();
	$escapeRouteChar	= array('.', '-', '\\', '/', '@', '#', '?', '!', '^', '&', '<', '>', '\'' , '"' );
	include_once( JPATH_BASE . DS . 'components' . DS . 'com_community' . DS . 'libraries' . DS . 'core.php');
	$config =& CFactory::getConfig();

	if($config->get('sef') == 'feature')
	{
	}
	else
	{
		// Profile based,
		if(array_key_exists( 'userid', $query))
		{
			$user		= CFactory::getUser($query['userid']);
			$username	= $user->username;
			
			if( $config->get('sefcompatibilityfix') )
			{
				foreach($escapeRouteChar as $escapeChar)
				{
					$username 	= JString::str_ireplace($escapeChar, '', $username);
				}
				$segments[]	= $query['userid'] . '-' . $username;
			}
			else
			{
				//$segments[] = JString::str_ireplace( '.' , '_' , $username );
				$segments[]	= $username;
			}
			
			
			unset($query['userid']);
		}
	}

		

		if(isset($query['view']))
		{
			if(empty($query['Itemid'])) {
				$segments[] = $query['view'];

			} else {
				$menu = &JSite::getMenu();
				$menuItem = &$menu->getItem( $query['Itemid'] );
				if(!isset($menuItem->query['view']) || $menuItem->query['view'] != $query['view']) {
					$segments[] = $query['view'];
				}
			}
			unset($query['view']);
		}

		if(isset($query['task']))
		{			
			// For viewgroup, fix the group title
			if( $query['task'] == 'viewgroup' ) 
			{
				$db	=& JFactory::getDBO();
				$groupid =   $query['groupid'];
				$groupModel =& CFactory::getModel('groups');
				$group = new CTableGroup($db);
				$group->load($groupid);
				
				$segments[] = $query['task'];
				$groupName	= $group->name;

				foreach($escapeRouteChar as $escapeChar)
				{
					$groupName 	= JString::str_ireplace($escapeChar, '', $groupName);
				}
				
				$groupName	= urlencode($groupName);
				$groupName	= JString::str_ireplace('++', '+', $groupName);
				$segments[] = $groupid . '-' . $groupName;

				unset($query['groupid']);
			}
			else if( $query['task'] == 'video' )
			{
				$videoModel	=& CFactory::getModel('Videos');
				$videoid	= $query['videoid'];
				
				$video		=& JTable::getInstance( 'Video' , 'CTable' );
				$video->load( $videoid );
				
				// We hide the 'video' task to avoid the url from showing 
				// ... /community/videos/video/
				//$segments[] = $query['task'];
				
				$title		= trim( $video->title );
				foreach($escapeRouteChar as $escapeChar)
				{
					$title	= JString::str_ireplace($escapeChar, '', $title);
				}
				$title		= urlencode( $title );
				$title		= JString::str_ireplace( '++' , '+' , $title );
				$segments[]	= $video->id . '-' . $title;
				unset( $query['videoid'] );
			}
			// For viewdiscussion, fix the discussion title
			else if( $query['task'] == 'viewdiscussion' ) 
			{
				$db	=& JFactory::getDBO();
				$topicId =   $query['topicid'];
				$discussionsModel =& CFactory::getModel('discussions');
				$discussions = new CTableDiscussion($db);
				$discussions->load($topicId);
				
				$segments[] = $query['task'];
				$discussionName	= $discussions->title;
				
				foreach($escapeRouteChar as $escapeChar)
				{
					$discussionName 	= JString::str_ireplace($escapeChar, '', $discussionName);
				}				
				
				$discussionName	= urlencode($discussionName);
				$discussionName	= JString::str_ireplace('++', '+', $discussionName);	
				
				$segments[] = $topicId . '-' . $discussionName;
				unset($query['topicid']);
			} 
			
			// For viewdiscussion, fix the discussion title
			else if( $query['task'] == 'viewbulletin' ) 
			{
				$db	=& JFactory::getDBO();
				$bulletinid =   $query['bulletinid'];
				$bulletinsModel =& CFactory::getModel('bulletins');
				$bulletins = new CTableBulletin($db);
				$bulletins->load($bulletinid);
				
				$segments[] = $query['task'];
				$bullentinName	= $bulletins->title;
				
				foreach($escapeRouteChar as $escapeChar)
				{
					$bullentinName 	= JString::str_ireplace($escapeChar, '', $bullentinName);
				}				
				
				$bullentinName	= urlencode($bullentinName);
				$bullentinName	= JString::str_ireplace('++', '+', $bullentinName);
				
				$segments[] = $bulletinid . '-' . $bullentinName;
				unset($query['bulletinid']);
			} 
			else
			{
				$segments[] = $query['task'];
			}
			unset($query['task']);
		}

	return $segments;
}

function CommunityParseRoute($segments)
{
	$vars = array();

	$menu			=& JSite::getMenu();
	$selectedMenu	=& $menu->getActive();

	// We need to grab the user id first see if the first segment is a user
	// because once CFactory::getConfig is loaded, it will automatically trigger
	// the plugins. Once triggered, the getRequestUser will only get the current user.
	$count = count($segments);
	
	if(!empty($count))
	{
		$username	= $segments[0];
		$userid		= '';
		
		// Test if this is for a compatibility fix
		if( JString::stristr( $username , ':' ) )
		{
			$user		= explode('-' , JString::str_ireplace( ':' , '-' , $username ) );

			if( isset($user[0] ) )
			{
				$userid	= $user[0];
			}
			
		}

		if( !$userid )
		{
			// Check if this user exist
			$userid = CommunityGetUserId( $username );
	
			// Joomla converts ':' to '-' when encoding and during decoding, 
			// it converts '-' to ':' back for the query string which will break things
			// if the username has '-'. So we do not have any choice apart from 
			// testing both this values until Joomla tries to fix this
			if( !$userid && JString::stristr( $username , ':' ) )
			{
				$user		= explode('-' , JString::str_ireplace( ':' , '-' , $username ) );

				$userid		= CommunityGetUserId( $user );
			}
		}

		
		if($userid != 0)
		{
			array_shift($segments);
			$vars['userid'] = $userid;
			// if empty, we should display the user's profile
			if(empty($segments))
			{
				$vars['view'] = 'profile';
			}
		}
	}

	$count	= count($segments);
	if( !isset($selectedMenu) )
	{
		if( $count > 0 )
		{
			// If there are no menus we try to use the segments
			$vars['view']  = $segments[0];

			if(!empty($segments[1]))
			{
				$vars['task'] = $segments[1];
			}
			
			if(!empty($segments[2] ) && $segments[1] == 'viewgroup' )
			{
				$groupTitle 		= $segments[2];
				$vars['groupid']	= _parseGroup( $groupTitle );
			}
		}
		return $vars;
	}

	if( $selectedMenu->query['view'] == 'frontpage' )
	{
		// We know this is a frontpage view in the menu, try to get the 
		// view from the segments instead.
		if( $count > 0 )
		{
			$vars['view'] = $segments[0];
	
			if(!empty($segments[1]))
			{
				$vars['task'] = $segments[1];
			}
		}
	}
	else
	{
		$vars['view']	= $selectedMenu->query['view'];
		
		if( $count > 0 )
		{
			$vars['task']	= $segments[0];
		} 
	}
	
	// In case of video view, the 'task' (video) has been removed during
	// BuildRoute. We need to detect if the segment[0] is actually a 
	// permalink to the actual video, and add the proper task
	if($vars['view'] == 'videos') 
	{
		$pattern = "'^[0-9]+'s";
		$videoTitle	= $segments[ count( $segments ) - 1 ];
		preg_match($pattern, $videoTitle, $matches);
		if($matches){
			$vars['task'] = 'video';
		}
	}  


	// If the task is video then, query the last segment to grab the video id
	if( isset($vars['task'] ) && $vars['task'] == 'video' )
	{
		$videoTitle	= $segments[ count( $segments ) - 1 ];
		$titles		= explode('-', $videoTitle);
		$vars['videoid'] = $titles[0];
	}
	
	// If the task is viewgroup then, query the last segment to grab the group id
	if( isset($vars['task'] ) && $vars['task'] == 'viewgroup' )
	{
		$groupTitle = $segments[count($segments) - 1];
		$vars['groupid'] = _parseGroup( $groupTitle );
	}
	
	// If the task is viewdiscussion then, query the last segment to grab the topic id
	if( isset($vars['task'] ) && $vars['task'] == 'viewdiscussion' ){
		$groupTitle = $segments[count($segments) - 1];
		$titles = explode('-', $groupTitle);
		$vars['topicid'] = $titles[0];
	}
	
	// If the task is viewgroup then, query the last segment to grab the group id
	if( isset($vars['task'] ) && $vars['task'] == 'viewbulletin' ){
		$groupTitle = $segments[count($segments) - 1];
		$titles = explode('-', $groupTitle);
		$vars['bulletinid'] = $titles[0];
	}

	return $vars;
}

function & _parseGroup( $title )
{
	$titles 	= explode('-', $title);
	$groupId	= $titles[0];
	
	return $groupId;
}

function CommunityGetUserId($name)
{
	$db			=& JFactory::getDBO();
	$sql = "SELECT `id` FROM #__users WHERE `username`=" . $db->Quote($name);
	$db->setQuery($sql);
	$id = $db->loadResult();

	return $id;
}