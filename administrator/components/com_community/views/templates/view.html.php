<?php
/**
 * @package		JomSocial
 * @copyright (C) 2008 by Slashes & Dots Sdn Bhd - All rights reserved!
 * @license http://www.azrul.com Copyrighted Commercial Software
 */

// Disallow direct access to this file
defined('_JEXEC') or die('Restricted access');

jimport( 'joomla.application.component.view' );

/**
 * Configuration view for Jom Social
 */
class CommunityViewTemplates extends JView
{
	/**
	 * The default method that will display the output of this view which is called by
	 * Joomla
	 * 
	 * @param	string template	Template file name
	 **/	 	
	function display( $tpl = null )
	{
		// Load tooltips
		JHTML::_('behavior.tooltip', '.hasTip');

		$this->assignRef( 'fields' 		, $fields );
		$this->assignRef( 'pagination'	, $pagination );
		parent::display( $tpl );
	}

	/**
	 * Private method to set the toolbar for this view
	 * 
	 * @access private
	 * 
	 * @return null
	 **/
	function setToolBar()
	{

		// Set the titlebar text
		JToolBarHelper::title( JText::_('CC TEMPLATES'), 'templates' );

		// Add the necessary buttons
		JToolBarHelper::back('Home' , 'index.php?option=com_community');
	}

	/**
	 * Public method to get the templates listings
	 * 
	 * @access private
	 * 
	 * @return null
	 **/
	function getTemplatesListing()
	{
		$templatesPath	= COMMUNITY_BASE_PATH . DS . 'templates';
		$templates		= array();

		if( $handle = @opendir($templatesPath) )
		{
			while( false !== ( $file = readdir( $handle ) ) )
			{
				// Do not get '.' or '..' or '.svn' since we only want folders.
				if( $file != '.' && $file != '..' && $file != '.svn' )
					$templates[]	= $file;
			}
		}
		
		
		$html	= '<select name="template" style="width: 200px;" onchange="azcommunity.changeTemplate(this.value);">';
		
		$html	.= '<option value="none" selected="true">' . JText::_('CC SELECT A TEMPLATE') . '</option>';
		for( $i = 0; $i < count( $templates ); $i++ )
		{
			$html	.= '<option value="' . $templates[$i] . '">' . $templates[$i] . '</option>';
		}
		$html	.= '</select>';
		
		return $html;
	}
}