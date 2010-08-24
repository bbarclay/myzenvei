<?php
/**
 * Main Plugin File
 * Does all the magic!
 *
 * @package     Better Preview
 * @version     1.6.0
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
* Plugin that makes the preview button as it should be
*/
class plgSystemBetterPreview extends JPlugin
{
	var $_name = 'betterpreview';

	/**
	* Constructor
	*
	* For php4 compatability we must not use the __constructor as a constructor for
	* plugins because func_get_args ( void ) returns a copy of all passed arguments
	* NOT references. This causes problems with cross-referencing necessary for the
	* observer design pattern.
	*/
	function plgSystemBetterPreview( &$subject, $config )
	{
		$mainframe =& JFactory::getApplication();

		$action = JRequest::getCmd( 'action' );

		// if current page is not an administrator page, return nothing
		if ( !$mainframe->isAdmin() && $action != 'betterpreview' ) { return; }

		$document =& JFactory::getDocument();
		$docType = $document->getType();

		// only in html
		if ( $docType != 'html' ) { return; }

		parent::__construct( $subject );

		//load the language file
		$this->loadLanguage();

		// Load plugin parameters
		$params = new JParameter( $config['params'], JPATH_PLUGINS.DS.$config['type'].DS.$config['name'].'.xml' );

		// Include the Helper
		require_once JPATH_SITE.DS.'plugins'.DS.'system'.DS.'betterpreview'.DS.'helper.php';
		$this->helper = new plgSystemBetterPreviewHelper;

		$this->helper->init( $params );

		$show = JRequest::getCmd( 'show', 0 );
		if ( $action == 'betterpreview' && !$show ) {
			$this->helper->prePreviewArticle();
		}
	}

	function onPrepareContent( &$article )
	{
		$action = JRequest::getCmd( 'action' );
		if ( $action == 'betterpreview' ) {
			$this->helper->previewArticle( $article );
		}
	}

	function onAfterDispatch()
	{
		$this->helper->addScripts();
	}

	function onAfterRender()
	{
		$this->helper->updateBody();
	}
}