<?php
/**
 * @category	Library
 * @package		JomSocial
 * @subpackage	user 
 * @copyright (C) 2008 by Slashes & Dots Sdn Bhd - All rights reserved!
 * @license http://www.jomsocial.com Copyrighted Commercial Software
 */
defined('_JEXEC') or die('Restricted access');

require_once( JPATH_ROOT . DS . 'components' . DS . 'com_community' . DS . 'libraries' . DS . 'core.php' );

if(JFile::exists(JPATH_ROOT . DS . 'components' . DS . 'com_community' . DS . 'libraries' . DS . 'advancesearch.php'))
	require_once( JPATH_ROOT . DS . 'components' . DS . 'com_community' . DS . 'libraries' . DS . 'advancesearch.php' );

	
if(! defined('TOOLBAR_HOME'))
	define( 'TOOLBAR_HOME', 'HOME');
	
if(! defined('TOOLBAR_PROFILE'))
	define( 'TOOLBAR_PROFILE', 'PROFILE');
	
if(! defined('TOOLBAR_FRIEND'))
	define( 'TOOLBAR_FRIEND', 'FRIEND');
	
if(! defined('TOOLBAR_APP'))
	define( 'TOOLBAR_APP', 'APP');
	
if(! defined('TOOLBAR_INBOX'))
	define( 'TOOLBAR_INBOX', 'INBOX');	


class CToolbar {
	var $_toolbar		= array();	
					
	function CToolbar(){		
	
		$this->_toolbar	= array(
							TOOLBAR_HOME 	=> null,
							TOOLBAR_PROFILE => null,
							TOOLBAR_FRIEND 	=> null,
							TOOLBAR_APP	 	=> null,
							TOOLBAR_INBOX 	=> null				
						);
						
		$my	=& JFactory::getUser();
		$config		=& CFactory::getConfig();
		
		$mySQLVer	= 0;		
		if(JFile::exists(JPATH_ROOT . DS . 'components' . DS . 'com_community' . DS . 'libraries' . DS . 'advancesearch.php'))
			$mySQLVer	= CAdvanceSearch::getMySQLVersion();
						
		foreach ($this->_toolbar as $key => &$row)
		{										
			
			$defaultCoreMenuArray	= array();
			
			$default	= new stdClass();			
			
			switch ($key)
			{
				case TOOLBAR_HOME :
					$default->caption	= JText::_('CC HOME');
					$default->link		= CRoute::_('index.php?option=com_community&view=frontpage');
					$default->view		= array('frontpage');
					break;
					
				case TOOLBAR_PROFILE :
					$default->caption	= JText::_('CC PROFILE');
					$default->link		= CRoute::_('index.php?option=com_community&view=profile&userid='.$my->id);
					$default->view		= array('profile');
					
					$defaultCoreMenuArray['PROFILE_AVATAR']	= $this->_addDefaultItem(
							JText::_('CC EDIT AVATAR'),
							CRoute::_('index.php?option=com_community&view=profile&task=uploadAvatar')
						);
					$defaultCoreMenuArray['PROFILE_EDIT_PROFILE']	= $this->_addDefaultItem(
							JText::_('CC EDIT PROFILE'),
							CRoute::_('index.php?option=com_community&view=profile&task=edit')
						);					
					$defaultCoreMenuArray['PROFILE_EDIT_DETAILS']	= $this->_addDefaultItem(
							JText::_('CC EDIT DETAILS'),
							CRoute::_('index.php?option=com_community&view=profile&task=editDetails')
						);
					$defaultCoreMenuArray['PROFILE_EDIT_PRIVACY']	= $this->_addDefaultItem(
							JText::_('CC EDIT PRIVACY'),
							CRoute::_('index.php?option=com_community&view=profile&task=privacy')
						);
					$defaultCoreMenuArray['PROFILE_EDIT_PREFERENCES']	= $this->_addDefaultItem(
							JText::_('CC EDIT PREFERENCES'),
							CRoute::_('index.php?option=com_community&view=profile&task=preferences')
						);									
					break;
					
				case TOOLBAR_FRIEND :
					$default->caption	= JText::_('CC FRIENDS');
					$default->link		= CRoute::_('index.php?option=com_community&view=friends&userid='. $my->id);
					$default->view		= array('friends', 'search');
					
					$defaultCoreMenuArray['FRIEND_SHOW_ALL_FRIENDS']	= $this->_addDefaultItem(
							JText::_('CC SHOW ALL FRIENDS'),
							CRoute::_('index.php?option=com_community&view=friends'),
							false,
							true
						);
					$defaultCoreMenuArray['FRIEND_SEARCH_FRIENDS']	= $this->_addDefaultItem(
							JText::_('CC SEARCH FRIENDS'),
							CRoute::_('index.php?option=com_community&view=search')
						);
						
					if($mySQLVer > 4.1) {											
						$defaultCoreMenuArray['FRIEND_ADVANCE_SEARCH_FRIENDS']	= $this->_addDefaultItem(
								JText::_('CC CUSTOME SEARCH FRIENDS'),
								CRoute::_('index.php?option=com_community&view=search&task=advancesearch')
							);
					}	

					$defaultCoreMenuArray['FRIEND_INVITE_FRIENDS']	= $this->_addDefaultItem(
							JText::_('CC INVITE FRIENDS'),
							CRoute::_('index.php?option=com_community&view=friends&task=invite')
						);
					
					$defaultCoreMenuArray['FRIEND_REQUEST_SENT']	= $this->_addDefaultItem(
							JText::_('CC REQUEST SENT'),
							CRoute::_('index.php?option=com_community&view=friends&task=sent')
						);
						
					$defaultCoreMenuArray['FRIEND_PENDING_APPROVAL']	= $this->_addDefaultItem(
							JText::_('CC PENDING APPROVAL'),
							CRoute::_('index.php?option=com_community&view=friends&task=pending')
						);
									
					break;
					
				case TOOLBAR_APP :
					$default->caption	= JText::_('CC APPLICATIONS');
					$default->link		= CRoute::_('index.php?option=com_community&view=apps');
					$default->view		= array('apps', 'groups', 'photos', 'videos');
					
					$defaultCoreMenuArray['APP_EDIT_APPS']	= $this->_addDefaultItem(
							JText::_('CC EDIT APPS'),
							CRoute::_('index.php?option=com_community&view=apps')
						);
						
					$defaultCoreMenuArray['APP_BROWSE_APPS']	= $this->_addDefaultItem(
							JText::_('CC BROWSE APPS'),
							CRoute::_('index.php?option=com_community&view=apps&task=browse'),
							false,
							true
						);
						
					if($config->get('enablegroups')){
						$defaultCoreMenuArray['APP_GROUP']	= $this->_addDefaultItem(
								JText::_('CC GROUP'),
								CRoute::_('index.php?option=com_community&view=groups&task=mygroups&userid='. $my->id)
							);														
					}
					
					if($config->get('enablephotos')){
						$defaultCoreMenuArray['APP_PHOTOS']	= $this->_addDefaultItem(
								JText::_('CC PHOTOS'),
								CRoute::_('index.php?option=com_community&view=photos&task=myphotos&userid='. $my->id)
							);							
					}
					
					if($config->get('enablevideos')){
						$defaultCoreMenuArray['APP_VIDEOS']	= $this->_addDefaultItem(
								JText::_('CC VIDEOS'),
								CRoute::_('index.php?option=com_community&view=videos&task=myvideos&userid='. $my->id)
							);
					}											
									
					break;	
				
				case TOOLBAR_INBOX :				
					$default->caption	= JText::_('CC INBOX');
					$default->link		= CRoute::_('index.php?option=com_community&view=inbox');
					$default->view		= array('inbox');
					
					$defaultCoreMenuArray['INBOX_INBOX']	= $this->_addDefaultItem(
							JText::_('CC INBOX'),
							CRoute::_('index.php?option=com_community&view=inbox')
						);
					
					$defaultCoreMenuArray['INBOX_SENT']	= $this->_addDefaultItem(
							JText::_('CC SENT'),
							CRoute::_('index.php?option=com_community&view=inbox&task=sent')
						);
						
					$defaultCoreMenuArray['INBOX_WRITE']	= $this->_addDefaultItem(
							JText::_('CC WRITE'),
							CRoute::_('index.php?option=com_community&view=inbox&task=write')
						);
				
				default:
					break;
					
			}
			
			$default->child		= array(
									'prepend'	=> array(),
									'append'	=> $defaultCoreMenuArray
									);
			
			$row	= $default;					
		}						
	}
		
	function _addDefaultItem($caption='', $link='', $isScriptCall=false, $hasSeparator=false)
	{
		$child	= new stdClass();
								
		$child	= new stdClass();
		$child->caption			= $caption;
		$child->link			= $link;
		$child->isScriptCall	= $isScriptCall;
		$child->hasSeparator	= $hasSeparator;
							
		return $child;
	}
	
	/**
	 * Function to add new toolbar group.
	 * param - key : string - the key of the group
	 *       - caption : string - the label of the group name
	 *       - link	: string - the url that link to the page
	 */
	function addGroup($key, $caption='', $link='')
	{
		if(! array_key_exists($key, $this->_toolbar))
		{

	    	$newGroup	= new stdClass();
			$newGroup->caption	= $caption;
			$newGroup->link		= $link;
			$newGroup->view		= array();
			$newGroup->child	= array(
									'prepend'	=> array(),
									'append'	=> array()
									);
		
			$this->_toolbar[strtoupper($key)]	= $newGroup;
		}
	}
	
	/**
	 * Function used to remove toolbar group and its associated menu items.
	 * param - key : string - the key of the group
	 */
	function removeGroup($key)
	{
		if(array_key_exists($key, $this->_toolbar))
		{		
			unset($this->_toolbar[strtoupper($key)]);
		}
	}	


	/**
	 * Function to add new toolbar menu items.
	 * param - groupKey : string - the key of the group
	 *       - itemKey : string - the unique key of the menu item 
	 *       - caption : string - the label of the menu item name
	 *       - link	: string - the url that link to the page
	 *       - order : string - display sequence : append | prepend	
	 *       - isScriptCall : boolean - to indicate whether this is a javascript function or is a anchor link.
	 *       - hasSeparator : boolean - to indicate whether this item should use the class 'seperator' from JomSocial.	 	  
	 */
	
	function addItem($groupKey, $itemKey, $caption='', $link='', $order='append', $isScriptCall=false, $hasSeparator=false)
	{
		$sorting	= $order;
		
		if(array_key_exists($groupKey, $this->_toolbar))
		{
			$tbGroup	=& $this->_toolbar[strtoupper($groupKey)];
			$childItem	=& $tbGroup->child;
								
			$child	= new stdClass();
			$child->caption			= $caption;
			$child->link			= $link;
			$child->isScriptCall	= $isScriptCall;
			$child->hasSeparator	= $hasSeparator;
			
			if($sorting != 'append' && $sorting != 'prepend')
				$sorting	= 'append';
				
			
			$childItem[$sorting][$itemKey]	= $child;
		}
	}
	
	/**
	 * Function used to remove toolbar menu item
	 * param - groupKey : string - the key of the group
	 *       - itemKey : string - the unique key of the menu item
	 */
	function removeItem($groupKey, $itemKey)
	{
		if(array_key_exists($groupKey, $this->_toolbar))
		{
		
			$tbGroup	=& $this->_toolbar[strtoupper($groupKey)];
			$childItem	=& $tbGroup->child;				
			
			if(array_key_exists($itemKey, $childItem['prepend']))
			{
				unset($childItem['prepend'][$itemKey]);
			}
			if(array_key_exists($itemKey, $childItem['append']))
			{
				unset($childItem['append'][$itemKey]);
			}
		}
	}	
	
	/**
	 * Function used to return html anchor link
	 * param  - string - toolbar group key	
	 *        - string - order of the items	 	 
	 * return - string - html anchor links	 
	 */	 	
	function getMenuItems($groupKey, $order)
	{
		$sorting	= array();
		$itemString	= '';

		if($order != 'append' && $order != 'prepend' && $order != 'all')
		{
			$sorting[]	= 'append';
		} 
		else if($order == 'all')
		{	
			$sorting[]	= 'prepend';
			$sorting[]	= 'append';
		}	
		else
		{
			$sorting[]	= $order;
		}			
				
		if(isset($this->_toolbar) && !empty($this->_toolbar[$groupKey])){
		
			$toolbarItems	=  $this->_toolbar[$groupKey]->child;
			
			foreach($sorting as $row)
			{
				$menuItems		=  $toolbarItems[$row];
				
				if(! empty($menuItems))
				{
					foreach($menuItems as $row)
					{
						$caption		= $row->caption;
						$link			= $row->link;
						$isScriptCall	= $row->isScriptCall;
						$hasSeparator	= (isset($row->hasSeparator) && $row->hasSeparator) ? 'class="has-separator"' : '';
						
						
						if(isset($link) && !empty($link))
						{
							if($isScriptCall)
							{								
								$itemString .= '<a href="javascript:void(0)" onclick="'. $link . ';" ' . $hasSeparator . '>' . $caption . '</a>';
							}
							else
							{
								$itemString .= '<a href="' . $link . '" ' . $hasSeparator. '>' . $caption . '</a>';
							}
						}
						
							
					}
				}
			}
		}
		return $itemString;
	}
	
	/**
	 *	Function to retrieve those toolbar that user custom add.
	 *	return - an array of object.	 
	 */	
	function getExtraToolbars()
	{
		$tbExtra	= array();
		
		if( COMMUNITY_FREE_VERSION )
			return $tbExtra;
		
		/* begin: COMMUNITY_FREE_VERSION */
		if(isset($this->_toolbar) && !empty($this->_toolbar)){
			//we cant use array_diff_assoc bcos only php version > 4.3.0 support.
			//so no choice but we have to use looping.
		
			$tbCore		= array(
							TOOLBAR_HOME 	=> '1',
							TOOLBAR_PROFILE => '1',
							TOOLBAR_FRIEND 	=> '1',
							TOOLBAR_APP	 	=> '1',
							TOOLBAR_INBOX 	=> '1'				
						  );						  
			
			foreach($this->_toolbar as $key => $val){
				if(! array_key_exists($key, $tbCore))
				{
					$tbExtra[$key] = $val;
				}
			}//end foreach 
		}//end if
		/* end: COMMUNITY_FREE_VERSION */

		return $tbExtra;
	}
	
	
	/**
	 * Function to retrieve custom toolbar menu items to caller
	 * param - groupKey : string - the key of the group 
	 * return array of object
	 */
	function getToolbarItems($groupKey)
	{
	
		if(array_key_exists($groupKey, $this->_toolbar))
		{
			$tbGroup	= $this->_toolbar[strtoupper($groupKey)];
			return $tbGroup;
		}
		else
		{
			return	'';
		}
	}
	
	/**
	 * Function used to determined whether a core menu group was set.
	 * param  - string - toolbar group key
	 * return - boolean	 
	 */	 	 	
	function hasToolBarGroup($groupKey)
	{
		if(array_key_exists($groupKey, $this->_toolbar))
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	/**
	 * Function to add views that associated with the toolbar group.
	 * param  - string - group key
	 * param  - string - view name
	 */
	function addGroupActiveView($groupkey, $viewName)
	{
		if(! empty($groupkey) && ! empty($viewName))
		{
			if(array_key_exists($groupkey, $this->_toolbar))
			{				
			
				$tbGroup	=& $this->_toolbar[strtoupper($groupkey)];
				$tbView		=& $tbGroup->view;

				if(! in_array($viewName, $tbView))
				{
					array_push($tbView, $viewName);
				}												 
			}
		}
	}


	/**
	 * Function to get the toolbar group key based on what view being associated.
	 * param  - string - view name	 	  
	 * return - string
	 */	
	function getGroupActiveView($viewName)
	{
		$groupKey	= '';
		if(! empty($viewName))
		{
			foreach($this->_toolbar as $key => $tbGroup)
			{
				$tbView	= $tbGroup->view;
				if(in_array($viewName, $tbView))
				{
					$groupKey	= $key;
					break;
				}
			}
		}
		return $groupKey;
	}	
	
	
	/**
	 * Function used to return all the toolbar group keys. 	  
	 * return - array	 
	 */	
	function getToolBarGroupKey()
	{
		return array_keys($this->_toolbar);
	}
	

	/**
	 * Function to get the current viewing page, the toolbar group key.
	 * param  - string - uri of the current view page	 	  
	 * return - string	 
	 */		
	function getActiveToolBarGroup($uri)
	{			
		$activeGroup = '';
		$sorting	= array('prepend', 'append');
		foreach($this->_toolbar as $key => $group)
		{
			//check the parent link
			if(htmlspecialchars_decode($uri) == htmlspecialchars_decode($group->link))
			{
				$activeGroup = $key;
				break;
			}
			
			//check the child links			
			$toolbarItems	=  $group->child;			
			
			foreach($sorting as $row)
			{
				$menuItems		=  $toolbarItems[$row];
				if(! empty($menuItems))
				{
					foreach($menuItems as $item)
					{																														
						if(! $item->isScriptCall)
						{
							if(htmlspecialchars_decode($uri) == htmlspecialchars_decode($item->link))
							{								
								$activeGroup = $key;
								break;							
							}
						}																			
					}
				}
			}
		}
		
		return $activeGroup;	
	}
	
}