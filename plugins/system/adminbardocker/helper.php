<?php
/**
 * Plugin Helper File
 *
 * @package     AdminBar Docker
 * @version     1.1.1
 *
 * @author      Peter van Westen <peter@nonumber.nl>
 * @link        http://www.nonumber.nl
 * @copyright   Copyright (C) 2010 NoNumber! All Rights Reserved
 * @license     http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 */

// No direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

/**
* Plugin that docks the admin toolbars
*/
class plgSystemAdminBarDockerHelper
{
	/*
	 * Place scripts and styles and load language
	 */
	function init( &$params, $template )
	{
		$document =& JFactory::getDocument();

		$document->addScript( JURI::root( true ).'/plugins/system/adminbardocker/templates/'.$template.'/script.js' );
		$document->addScript( JURI::root( true ).'/plugins/system/adminbardocker/js/adminbardocker.js' );
		$document->addStyleSheet( JURI::root( true ).'/plugins/system/adminbardocker/css/adminbardocker.css' );
		$document->addStyleSheet( JURI::root( true ).'/plugins/system/adminbardocker/templates/'.$template.'/style.css' );

		$set_cookies = '';
		if ( $params->get( 'dock_state', 'docked' ) == 'undocked' ) {
			$set_cookies .= '
				if ( !Cookie.get( \'abd_dock_state\' ) ) { Cookie.set( \'abd_dock_state\', \'undocked\' ); } ';
		}
		if ( $params->get( 'dock_pos', 'top' ) == 'bottom' ) {
			$set_cookies .= '
				if ( !Cookie.get( \'abd_dock_pos\' ) ) { Cookie.set( \'abd_dock_pos\', \'bottom\' ); } ';
		}
		if ( $params->get( 'autohide', 0 ) ) {
			$set_cookies .= '
				if ( !Cookie.get( \'abd_autohide\' ) ) { Cookie.set( \'abd_autohide\', 1 ); } ';
		}
		$script = "
			var abd_top = new Array();
			var abd_bottom = new Array();
			window.addEvent( 'domready', function() {"
				.$set_cookies."
				new AdminBarDocker( '".$template."', [ '".JText::_( 'Undock' )."', '".JText::_( 'Dock' )."', '".JText::_( 'Reload' )."', '".JText::_( 'To top' )."', '".JText::_( 'To bottom' )."', '".JText::_( 'Undock to top' )."', '".JText::_( 'Undock to bottom' )."', '".JText::_( 'Auto hide' )."', '".JText::_( 'No auto hide' )."' ] );
			});
		";
		$document->addScriptDeclaration( $script );
	}
}