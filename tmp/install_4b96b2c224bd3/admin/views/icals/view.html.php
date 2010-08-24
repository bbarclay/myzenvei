<?php
/**
 * JEvents Component for Joomla 1.5.x
 *
 * @version     $Id: view.html.php 1575 2009-09-23 09:05:07Z geraint $
 * @package     JEvents
 * @copyright   Copyright (C)  2008-2009 GWE Systems Ltd
 * @license     GNU/GPLv2, see http://www.gnu.org/licenses/gpl-2.0.html
 * @link        http://www.jevents.net
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die();

/**
 * HTML View class for the component
 *
 * @static
 */
class AdminIcalsViewIcals extends JEventsAbstractView 
{
	function overview($tpl = null)
	{
		
		JHTML::stylesheet( 'eventsadmin.css', 'administrator/components/'.JEV_COM_COMPONENT.'/assets/css/' );

		$document =& JFactory::getDocument();
		$document->setTitle(JText::_('ICals'));
		
		// Set toolbar items for the page
		JToolBarHelper::title( JText::_( 'ICals' ), 'jevents' );
	
		JToolBarHelper::publishList('icals.publish');
		JToolBarHelper::unpublishList('icals.unpublish');
		JToolBarHelper::addNew('icals.edit');
		JToolBarHelper::editList('icals.edit');
		JToolBarHelper::deleteList('Delete Ical and all associated events and repeats?','icals.delete');
		JToolBarHelper::spacer();
		JToolBarHelper::custom( 'cpanel.cpanel', 'default.png', 'default.png', 'JEV_ADMIN_CPANEL', false );
		//JToolBarHelper::help( 'screen.ical', true);

		JSubMenuHelper::addEntry(JText::_('Control Panel'), 'index.php?option='.JEV_COM_COMPONENT, true);
		
		$params = JComponentHelper::getParams(JEV_COM_COMPONENT);
		//$section = $params->getValue("section",0);
		
		JHTML::_('behavior.tooltip');
	}	

	function edit($tpl = null)
	{
		
		JHTML::stylesheet( 'eventsadmin.css', 'administrator/components/'.JEV_COM_COMPONENT.'/assets/css/' );
		JHTML::script('editicals.js?v=1.5.3','administrator/components/'.JEV_COM_COMPONENT.'/assets/js/');
		
		$document =& JFactory::getDocument();
		$document->setTitle(JText::_('Edit ICS'));
		
		// Set toolbar items for the page
		JToolBarHelper::title( JText::_( 'Edit ICS' ), 'jevents' );
	
		//JToolBarHelper::save('icals.save');
		$bar = & JToolBar::getInstance('toolbar');
		if ($this->editItem && isset($this->editItem->ics_id) && $this->editItem->ics_id >0){
			JToolBarHelper::save('icals.savedetails');
		}
		JToolBarHelper::cancel('icals.list');
		//JToolBarHelper::help( 'screen.icals.edit', true);
		
		$this->_hideSubmenu();
		
		$params = JComponentHelper::getParams(JEV_COM_COMPONENT);
		//$section = $params->getValue("section",0);
				
		JHTML::_('behavior.tooltip');
	}	

}