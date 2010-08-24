<?php
/**
 * Posts View for AutoTweet Component
 * Shows a list of posted messages.
 * 
 * @version		1.1
 * @license		GNU/GPL
 */

// No direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.application.component.view' );

/**
 * Posts View
 *
 */
class AutotweetViewAutotweet extends JView
{
	/**
	 * Posts view display method
	 * @return void
	 **/
	function display()
	{
		global $mainframe, $option;

		// do cleanup; only one time per session
		$session =& JFactory::getSession();
		if (!$session->has('hascleaned', 'autotweet')) {
			$session->set('hascleaned', 1, 'autotweet');
			
			$model =& $this->getModel('autotweet');
			$result_msg = $model->removeOlderThan(); 
			if('' != $result_msg) {
				$mainframe->enqueueMessage($result_msg);
			}
			// old code for redirect (does not work with Google Chrome):
			//$mainframe->redirect( 'index.php?option=com_autotweet&controller=autotweet&task=removeOlderThan');
		}
		
		// add logo for backend view
		$doc =& JFactory::getDocument();
		$style = " .icon-48-fm-logo {background-image:url(components/com_autotweet/assets/fm-logo.png); no-repeat; }";
		$doc->addStyleDeclaration($style);
		
		// toolbar buttons
		JToolBarHelper::title( JText::_( 'Autotweet Manager' ), 'fm-logo.png' );
		JToolBarHelper::publishList();
		JToolBarHelper::publish($task = 'publishall', $alt = 'Publish all');
		JToolBarHelper::unpublishList();
		JToolBarHelper::spacer();
		JToolBarHelper::deleteList('Delete selected posts?');
		JToolBarHelper::spacer();
		JToolBarHelper::preferences('com_autotweet', '500', '600');
		JToolBarHelper::help('screen.autotweet', true);
		
		// Get data from the model and assign data to template/view
		$items =& $this->get('Data');
		$this->assignRef('items', $items);

		// pagination
		$pagination =& $this->get('Pagination');		
		$this->assignRef('pagination', $pagination);
		
		// Table ordering and filtering/searching
		$lists = array();
		$filter_order		= $mainframe->getUserStateFromRequest($option . 'filter_order', 'filter_order', 'postdate');
        $filter_order_Dir	= $mainframe->getUserStateFromRequest($option . 'filter_order_Dir', 'filter_order_Dir', 'DESC');
		$filter_state		= $mainframe->getUserStateFromRequest($option . 'filter_state', 'filter_state');
		
		$lists['order_Dir'] = $filter_order_Dir;
		$lists['order']     = $filter_order;
		$lists['state']     = JHTML::_('grid.state', $filter_state);
		
		$this->assignRef( 'lists', $lists );
		
		
		parent::display();
	}
}