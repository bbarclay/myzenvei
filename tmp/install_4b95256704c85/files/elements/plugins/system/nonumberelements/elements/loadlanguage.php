<?php
/**
 * Element: Load Language
 * Loads the English language file as fallback
 *
 * @package     NoNumber! Elements
 * @version     1.2.12
 *
 * @author      Peter van Westen <peter@nonumber.nl>
 * @link        http://www.nonumber.nl
 * @copyright   Copyright (C) 2010 NoNumber! All Rights Reserved
 * @license     http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 */

// Ensure this file is being included by a parent file
defined( '_JEXEC' ) or die( 'Restricted access' );

/**
 * Load Language Element
 */
class JElementLoadLanguage extends JElement
{
	/**
	 * Element name
	 *
	 * @access	protected
	 * @var		string
	 */
	var	$_name = 'Load Language';

	function fetchTooltip( $label, $description, &$node, $control_name, $name )
	{
		return;
	}

	function fetchElement( $name, $value, &$node, $control_name )
	{
		$document =& JFactory::getDocument();
		$file_root = str_replace( '\\', '/', str_replace( JPATH_SITE, '', dirname( __FILE__ ) ) );
		$document->addScript( JURI::root(true).$file_root.'/script.js' );

		$extension =		$node->attributes( 'extension' );
		$admin =			$this->def( $node->attributes( 'admin' ), 1 );

		$this->loadLanguage( $extension, $admin );

		$random = rand( 1000, 10000 );
		$html = '<div id="end-'.$random.'"></div><script>NoNumberElementsHideTD( "end-'.$random.'" );</script>';

		return $html;
	}

	function loadLanguage( $extension, $admin = 1 )
	{
		if ( $extension ) {
			// Loads English language file as fallback (for undefined stuff in other language file)
			$file = 'language'.DS.'en-GB'.DS.'en-GB.'.$extension.'.ini';
			if ( $admin ) {
				$file = JPATH_ADMINISTRATOR.DS.$file;
			} else {
				$file = JPATH_SITE.DS.$file;
			}
			$lang =& JFactory::getLanguage();
			$lang->_load( $file, $extension, 0 );
		}
	}

	function def( $val, $default )
	{
		return ( $val == '' ) ? $default : $val;
	}
}