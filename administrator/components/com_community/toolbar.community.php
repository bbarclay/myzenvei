<?php
/**
 * @package		JomSocial
 * @copyright (C) 2008 by Slashes & Dots Sdn Bhd - All rights reserved!
 * @license http://www.azrul.com Copyrighted Commercial Software
 */

// Disallow direct access to this file
defined('_JEXEC') or die('Restricted access');

//require_once( JApplicationHelper::getPath('toolbar_html') );

$view	= JRequest::getCmd('view','community');

JHTML::_('behavior.switcher');

// Load submenu's
$views	= array(
					'community'			=> JText::_('CC COMMUNITY'),
					'users'				=> JText::_('CC USERS'),
					'configuration'		=> JText::_('CC CONFIGURATION'),
					'profiles' 			=> JText::_('CC CUSTOM PROFILES'),
					'groups'			=> JText::_('CC GROUPS'),
					'groupcategories'	=> JText::_('CC GROUP CATEGORIES'),
					'videoscategories'	=> JText::_('CC VIDEOS CATEGORIES'),
					'reports'			=> JText::_('CC REPORTINGS'),
					'userpoints'		=> JText::_('CC USER POINTS'),
					'about'				=> JText::_('CC ABOUT')
				);	

foreach( $views as $key => $val )
{
	$active	= ( $view == $key );
	
// 	if( $key == 'applications' )
// 	{
// 		// For applications, we just link to Joomla's plugin manager which filters
// 		// plugins with the elements of 'community'
// 		JSubMenuHelper::addEntry( $val , 'index.php?option=com_plugins&filter_type=community' , false );
// 	}
// 	else
// 	{
		JSubMenuHelper::addEntry( $val , 'index.php?option=com_community&view=' . $key , $active );
// 	}
}
?>
