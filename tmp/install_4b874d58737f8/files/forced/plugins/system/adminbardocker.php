<?php
/**
 * Main Plugin File
 * Does all the magic!
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

// Import library dependencies
jimport( 'joomla.event.plugin' );

/**
* Plugin that shows active modules in menu item edit view
*/
class plgSystemAdminBarDocker extends JPlugin
{
	/**
	* Constructor
	*
	* For php4 compatability we must not use the __constructor as a constructor for
	* plugins because func_get_args ( void ) returns a copy of all passed arguments
	* NOT references. This causes problems with cross-referencing necessary for the
	* observer design pattern.
	*/
	function plgSystemAdminBarDocker( &$subject, $config )
	{
		$mainframe =& JFactory::getApplication();

		if( !$mainframe->isAdmin() ) {
			return;
		}

		$option = JRequest::getCmd( 'option' );
		if( $option == 'com_extplorer' ) {
			return;
		}

		$document =& JFactory::getDocument();
		$docType = $document->getType();

		// only in html
		if ( $docType != 'html' ) { return; }

		$this->template = JAdministrator::getTemplate();
		if ( !file_exists( JPATH_SITE.DS.'plugins'.DS.'system'.DS.'adminbardocker'.DS.'templates'.DS.$this->template.DS.'script.js' ) ) {
			return;
		}

		$user =& JFactory::getUser();
		if ( !$user->id ) { return; }

		parent::__construct( $subject, $config );

		$this->loadLanguage();

		$this->_params = new JParameter( $config['params'] );

		// include helper file
		require_once JPATH_SITE.DS.'plugins'.DS.'system'.DS.'adminbardocker'.DS.'helper.php';
		$this->helper = new plgSystemAdminBarDockerHelper();
	}

	function onAfterDispatch()
	{
		$this->helper->init( $this->_params, $this->template );
	}
}