<?php

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die();

jimport( 'joomla.application.component.view');
jimport( 'joomla.utilities.arrayhelper');
jimport( 'joomla.html.html');


require_once(JPATH_ROOT . DS . 'components' . DS . 'com_community' . DS . 'views' . DS . 'friends' . DS . 'view.html.php' );

class CommunityViewIphoneFriends extends CommunityViewFriends
{	
	function friends($data = null)
	{		
		parent::friends($data);
	}

	function _addSubmenu(){	
	}

	function showSubmenu(){
	}	
}
