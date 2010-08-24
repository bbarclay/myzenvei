<?php
/**
 * @author     GeoXeo <contact@geoxeo.com>
 * @link       http://www.geoxeo.com
 * @copyright  Copyright (C) 2010 GeoXeo - All Rights Reserved
 * @license    http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 * 
 */


// no direct access
defined('_JEXEC') or die('Restricted access');

class modContentTrailHelper
{
	/**
	 * application pathway
	 */
	function getList(&$params)
	{
		$items = JRequest::getVar('contenttrail-breadcrumbs', ''); 
		if($items == '') {
			$items = array();
		}
		
		if ($params->get('showHome', 1))
		{
			$item = new stdClass();
			$item->name = $params->get('homeText', JText::_('Home'));
			$item->link = JURI::base();
			array_unshift($items, $item);
		}

		return $items;
	}

	/**
 	 * Set the breadcrumbs separator for the breadcrumbs display.
 	 *
 	 * @param	string	$custom	Custom xhtml complient string to separate the
 	 * items of the breadcrumbs
 	 * @return	string	Separator string
 	 * @since	1.5
 	 */
	function setSeparator($custom = null)
	{
		global $mainframe;

		$lang =& JFactory::getLanguage();

		/**
	 	* If a custom separator has not been provided we try to load a template
	 	* specific one first, and if that is not present we load the default separator
	 	*/
		if ($custom == null) {
			if($lang->isRTL()){
				$_separator = JHTML::_('image.site', 'arrow_rtl.png');
			}
			else{
				$_separator = JHTML::_('image.site', 'arrow.png');
			}
		} else {
			$_separator = $custom;
		}
		return $_separator;
	}
}