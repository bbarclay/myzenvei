<?php
/**
 * JEvents Component for Joomla 1.5.x
 *
 * @version     $Id: view.html.php 1653 2010-01-05 01:32:52Z geraint $
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
class AdminIcaleventViewIcalevent extends JEventsAbstractView
{
	function overview($tpl = null)
	{

		JHTML::stylesheet( 'eventsadmin.css', 'administrator/components/'.JEV_COM_COMPONENT.'/assets/css/' );

		$document =& JFactory::getDocument();
		$document->setTitle(JText::_('ICal Events'));

		// Set toolbar items for the page
		JToolBarHelper::title( JText::_( 'ICal Events' ), 'jevents' );

		JToolBarHelper::publishList('icalevent.publish');
		JToolBarHelper::unpublishList('icalevent.unpublish');
		JToolBarHelper::addNew('icalevent.edit');
		JToolBarHelper::editList('icalevent.edit');
		JToolBarHelper::custom('icalevent.editcopy','copy.png','copy.png','JEV_ADMIN_COPYEDIT');
		JToolBarHelper::deleteList('Delete Event and all repeats?','icalevent.delete');
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
		$document =& JFactory::getDocument();
		include(JEV_LIBS."editStrings.php");
		$document->addScriptDeclaration($editStrings);

		JHTML::stylesheet( 'eventsadmin.css', 'administrator/components/'.JEV_COM_COMPONENT.'/assets/css/' );
		JHTML::script('editical.js?v=1.5.2','administrator/components/'.JEV_COM_COMPONENT.'/assets/js/');

		$document->setTitle(JText::_('Edit ICal Event'));

		// Set toolbar items for the page
		JToolBarHelper::title( JText::_( 'Edit ICal Event' ), 'jevents' );

		$bar = & JToolBar::getInstance('toolbar');
		if ($this->id>0){
			if ($this->editCopy){
				$bar->appendButton( 'Confirm', "save copy warning", 'save', "Save",'icalevent.save', false, false );
				$bar->appendButton( 'Confirm', "save copy warning", 'apply', "Apply",'icalevent.apply', false, false );
			}
			else {
				$bar->appendButton( 'Confirm', "save icalevent warning", 'save', "Save",'icalevent.save', false, false );
				$bar->appendButton( 'Confirm', "save icalevent warning", 'apply', "Apply",'icalevent.apply', false, false );
			}
		}
		else {
			JToolBarHelper::save('icalevent.save');
			JToolBarHelper::apply('icalevent.apply');
			//$bar->appendButton( 'Apply',  'apply', "Apply",'icalevent.apply', false, false );
		}

		JToolBarHelper::cancel('icalevent.list');
		//JToolBarHelper::help( 'screen.icalevent.edit', true);

		$this->_hideSubmenu();

		$params = JComponentHelper::getParams(JEV_COM_COMPONENT);
		//$section = $params->getValue("section",0);

		JHTML::_('behavior.tooltip');

		$this->setCreatorLookup();
	}


	protected function setCreatorLookup(){
		// If user is jevents can deleteall or has backend access then allow them to specify the creator
		$jevuser	= JEVHelper::getAuthorisedUser();
		$user = JFactory::getUser();
		
		// Get an ACL object
		$acl =& JFactory::getACL();
		$grp = $acl->getAroGroup($user->get('id'));
		$access = $acl->is_group_child_of($grp->name, 'Public Backend');
	
		if (($jevuser && $jevuser->candeleteall) || $access){
			$params =& JComponentHelper::getParams( JEV_COM_COMPONENT );
			$minaccess = $params->getValue("jevcreator_level",19);
			$sql = "SELECT * FROM #__users where gid>=".$minaccess;
			$db = JFactory::getDBO();
			$db->setQuery( $sql );
			$users = $db->loadObjectList();

			$userOptions[] = JHTML::_('select.option', '-1','Select User' );
			foreach( $users as $user )
			{
				$userOptions[] = JHTML::_('select.option', $user->id, $user->name );
			}
			$creator = $this->row->created_by()>0?$this->row->created_by():$jevuser->user_id;
			$userlist = JHTML::_('select.genericlist', $userOptions, 'jev_creatorid', 'class="inputbox" size="1" ', 'value', 'text', $creator);

			$this->assignRef("users",$userlist);
		}
		
	}

}