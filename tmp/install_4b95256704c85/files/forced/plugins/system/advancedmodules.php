<?php
/**
 * Main Plugin File
 * Does all the magic!
 *
 * @package     Advanced Module Manager
 * @version     1.7.0
 *
 * @author      Peter van Westen <peter@nonumber.nl>
 * @link        http://www.nonumber.nl
 * @copyright   Copyright (C) 2010 NoNumber! All Rights Reserved
 * @license     http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 */

// No direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

// Import library dependencies
jimport( 'joomla.event.plugin' );
 // Include the moduleHelper
require_once JPATH_SITE.DS.'plugins'.DS.'system'.DS.'advancedmodules'.DS.'modulehelper.php';

/**
* Plugin that shows active modules in menu item edit view
*/
class plgSystemAdvancedModules extends JPlugin
{
	/**
	* Constructor
	*
	* For php4 compatability we must not use the __constructor as a constructor for
	* plugins because func_get_args ( void ) returns a copy of all passed arguments
	* NOT references. This causes problems with cross-referencing necessary for the
	* observer design pattern.
	*/
	function plgSystemAdvancedModules( &$subject, $config )
	{
		$mainframe =& JFactory::getApplication();
		$option = JRequest::getCmd( 'option' );

		if( !$mainframe->isAdmin() || $option == 'com_modules' ) {
			return;
		}
		
		$document =& JFactory::getDocument();
		$docType = $document->getType();

		// only in html
		if ( $docType != 'html' ) { return; }

		if ( !file_exists( JPATH_ADMINISTRATOR.DS.'components'.DS.'com_advancedmodules'.DS.'admin.advancedmodules.php' ) ) {
			return;
		}

		if ( !file_exists( JPATH_SITE.DS.'plugins'.DS.'system'.DS.'advancedmodules'.DS.'helper.php' ) ) {
			return;
		}

		parent::__construct( $subject, $config );

		$this->_params = new JParameter( $config['params'] );

		require_once JPATH_SITE.DS.'plugins'.DS.'system'.DS.'advancedmodules'.DS.'helper.php';
		$this->helper = new plgSystemAdvancedModulesHelper();
	}

	/*
	 * Shows active modules in menu item edit view
	 */
	function onAfterDispatch()
	{
		$option = JRequest::getCmd( 'option' );

		if(
				$option != 'com_menus'
			||	!$this->_params->get( 'show_activemodules', 1 )
		) {
			return;
		}

		// Get cid
		$cid = JRequest::getVar( 'cid', array( 0 ), 'method', 'array' );
		$cid = array( (int) $cid['0'] );
		$id = $cid['0'];

		// return if no cid is set
		if ( !$id ) { return; }

		$this->helper->showModulesByItemid( $id );
	}

	/*
	 * Replace links to com_modules with com_advancedmodules
	 */
	function onAfterRender()
	{
		$this->helper->replaceComponentLinks();
	}
}