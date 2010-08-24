<?php
/**
 * Element: Sections
 * Displays a selectbox of available sections
 *
 * @author     GeoXeo <contact@geoxeo.com>
 * @based      on orginal code by Peter van Westen <peter@nonumber.nl>
 * @link       http://www.geoxeo.com
 * @copyright  Copyright (C) 2010 GeoXeo - All Rights Reserved
 * @license    http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 */

// Ensure this file is being included by a parent file
defined( '_JEXEC' ) or die( 'Restricted access' );

/**
 * Sections Element
 */
class JElementSections extends JElement
{
	/**
	 * Element name
	 *
	 * @access	protected
	 * @var		string
	 */
	var	$_name = 'Sections';

	function fetchElement( $name, $value, &$node, $control_name )
	{
		$_db =& JFactory::getDBO();

		$_query = 'SELECT id, title FROM #__sections WHERE published = 1 AND scope = "content" ORDER BY ordering';
		$_db->setQuery( $_query );
		$_options = $_db->loadObjectList();		
		for ( $i=0; $i<count( $_options ); $i++ ) {
			$_title = explode( "\n",wordwrap( $_options[$i]->title, 86, "\n" ) );;
			$_title = $_title['0'];
			$_title = ( $_title != $_options[$i]->title ) ? $_title.'...' : $_title;
			$_options[$i]->title = $_title;
		}

		array_unshift( $_options, JHTML::_( 'select.option', '0', JText::_( 'Uncategorized' ), 'id', 'title' ) );
		array_unshift( $_options, JHTML::_( 'select.option', '-1', '- '.JText::_( 'All sections' ).' -', 'id', 'title' ) );

		return JHTML::_( 'select.genericlist',  $_options, ''.$control_name.'['.$name.'][]', 'multiple="multiple" size="8" class="inputbox"', 'id', 'title', $value, $control_name.$name );
	}
}