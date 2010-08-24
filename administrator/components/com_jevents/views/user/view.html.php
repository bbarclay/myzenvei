<?php
/**
 * JEvents Component for Joomla 1.5.x
 *
 * @version     $Id: view.html.php 1479 2009-06-25 14:40:55Z geraint $
 * @package     JEvents
 * @copyright   Copyright (C)  2008-2009 GWE Systems Ltd
 * @license     GNU/GPLv2, see http://www.gnu.org/licenses/gpl-2.0.html
 * @link        http://www.jevents.net
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die();

jimport( 'joomla.filesystem.file');
jimport( 'joomla.application.component.view');
jimport('joomla.html.pane');

class AdminUserViewUser extends JEventsAbstractView
{
	/**
	 * Control Panel display function
	 *
	 * @param template $tpl
	 */
	function overview($tpl = null)
	{
		global $mainframe;
		
		$document =& JFactory::getDocument();
		// this already includes administrator
		$livesite = JURI::base();
		$document->addStyleSheet($livesite.'components/'.JEV_COM_COMPONENT.'/assets/css/eventsadmin.css');

		$document->setTitle(JText::_('JEvents') . ' :: ' .JText::_('Users'));
				
		// Set toolbar items for the page
		JToolBarHelper::title( JText::_( 'Users' ), 'jevents' );
		JToolBarHelper::addNew("user.edit");
		JToolBarHelper::editList("user.edit");
		//JToolBarHelper::publish("user.publish");
		//JToolBarHelper::unpublish("user.unpublish");
		JToolBarHelper::deleteList("ARE YOU SURE YOU WANT TO DELETE THIS USER", "user.remove");
		//JToolBarHelper::preferences(JEV_COM_COMPONENT, '580', '750');
		JToolBarHelper::spacer();
		JToolBarHelper::custom( 'cpanel.cpanel', 'default.png', 'default.png', 'JEV_ADMIN_CPANEL', false );
		//JToolBarHelper::help( 'screen.user', true);

		$option				= JRequest::getCmd('option', JEV_COM_COMPONENT);

		$pagination = & $this->get( 'Pagination' );
		$users	= &$this->get('users');
		
		$this->assignRef('pagination',	$pagination);
		$this->assignRef('users', $users);

		JHTML::_('behavior.tooltip');
	}

	function edit($tpl = null)
	{
		global $mainframe;
		
		$document =& JFactory::getDocument();
		// this already includes administrator
		$livesite = JURI::base();
		$document->addStyleSheet($livesite.'components/'.JEV_COM_COMPONENT.'/assets/css/eventsadmin.css');

		$document->setTitle(JText::_('JEvents') . ' :: ' .JText::_('Edit User'));
				
		// Set toolbar items for the page
		JToolBarHelper::title( JText::_( 'Edit User' ), 'jevents' );
		
		JToolBarHelper::save("user.save");
		JToolBarHelper::cancel("user.overview");

		//JToolBarHelper::help( 'edit.user', true);

		$option				= JRequest::getCmd('option', JEV_COM_COMPONENT);
		
		$db=& JFactory::getDBO();
		
		$params =& JComponentHelper::getParams( JEV_COM_COMPONENT );
		$minaccess = $params->getValue("jevcreator_level",19);
		
		// get users AUTHORS and above
		$sql = "SELECT * FROM #__users where gid>=".$minaccess;
		$db->setQuery( $sql );
		$users = $db->loadObjectList();

		$userOptions[] = JHTML::_('select.option', '-1','Select User' );
		foreach( $users as $user )
		{
			$userOptions[] = JHTML::_('select.option', $user->id, $user->name );
		}
		$jevuser	= &$this->get('user');
		$userlist = JHTML::_('select.genericlist', $userOptions, 'user_id', 'class="inputbox" size="1" ', 'value', 'text', $jevuser->user_id);
		
		$this->assignRef("users",$userlist);
		$this->assignRef('jevuser', $jevuser);

		JHTML::_('behavior.tooltip');
	}

	
}
