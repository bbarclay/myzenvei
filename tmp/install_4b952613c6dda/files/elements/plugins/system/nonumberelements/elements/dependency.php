<?php
/**
 * Element: Dependency
 * Displays an error if given file is not found
 *
 * @package     NoNumber! Elements
 * @version     1.2.10
 *
 * @author      Peter van Westen <peter@nonumber.nl>
 * @link        http://www.nonumber.nl
 * @copyright   Copyright (C) 2010 NoNumber! All Rights Reserved
 * @license     http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 */

// Ensure this file is being included by a parent file
defined( '_JEXEC' ) or die( 'Restricted access' );

/**
 * Dependency Element
 *
 * Available extra parameters:
 * label	The name of the extension that is needed
 * file		The file to check (from the root)
 */
class JElementDependency extends JElement
{
	/**
	 * Element name
	 *
	 * @access	protected
	 * @var		string
	 */
	var	$_name = 'Dependency';

	function fetchTooltip( $label, $description, &$node, $control_name, $name )
	{
		return;
	}

	function fetchElement( $name, $value, &$node, $control_name )
	{
		$label =	$this->def( $node->attributes( 'label' ), 'the main extension' );
		$file =		$node->attributes( 'file' );
		$file = 	str_replace( '/', DS, $file );
		
		$this->setMessage( $file, $label );

		$random = rand( 1000, 10000 );
		$html = '<div id="end-'.$random.'"></div><script>var enddiv = document.getElementById("end-'.$random.'");enddiv.parentNode.style.padding=0;</script>';

		return $html;
	}

	function setMessage( $file, $name )
	{
		jimport( 'joomla.filesystem.file' );

		if ( strpos( $file, '/administrator' ) === 0 ) {
			$file = str_replace( '/', DS, str_replace( '/administrator', JPATH_ADMINISTRATOR, $file ) );
		} else {
			$file = JPATH_SITE.str_replace( '/', DS, $file );
		}

		if ( !JFile::exists( $file ) ) {
			$mainframe =& JFactory::getApplication();

			$msg = JText::sprintf( '-This extension needs the main extension to function', $name );
			$message_set = 0;
			$messageQueue = $mainframe->getMessageQueue();
			foreach ( $messageQueue as $queue_message ) {
				if ( $queue_message['type'] == 'error' && $queue_message['message'] == $msg ) {
					$message_set = 1;
					break;
				}
			}
			if ( !$message_set ) {
				$mainframe->enqueueMessage( $msg, 'error' );
			}
		}
	}

	function def( $val, $default )
	{
		return ( $val == '' ) ? $default : $val;
	}
}