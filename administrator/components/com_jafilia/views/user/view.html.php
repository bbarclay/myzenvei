<?php
defined( '_JEXEC' ) or die( '=;)' );
jimport( 'joomla.application.component.view');
class JafiliaViewUser extends JView {
   function display($tpl = null) {   
		$task = JRequest::getCmd('task');
		if ($task)
		{
			switch ($task) {
				case 'userClicks':
					JToolBarHelper::title( JText::_('JAF_COM_TITLE').': '.JText::_('JAF_USER').' <small><small>[ '.JText::_('JAF_CLICKS').' ]</small></small>', 'clicks48.jpg' );		
					JToolBarHelper::back();		
					$this->showClicks();						
				break;
				case 'userLeads':				
					JToolBarHelper::title( JText::_('JAF_COM_TITLE').': '.JText::_('JAF_USER').' <small><small>[ '.JText::_('JAF_SALES').' ]</small></small>', 'fee48.jpg' );		
					JToolBarHelper::back();		
					$this->showLeads();				
				break;
				case 'edit':
					$Jafilia =& $this->get('Data2');	
					JToolBarHelper::title( JText::_('JAF_COM_TITLE').': '.JText::_('JAF_USER').' <small><small>[ ' .JText::_( 'JAF_USER' ).' ]</small></small>', 'partner48.jpg' );			
					JToolBarHelper::cancel('cancel', JText::_('Close'));
					$this->assignRef('User', $Jafilia);	
					$path = JPATH_COMPONENT.DS.'config.jafilia.php';
					include($path);
					$this->assignRef('jafpayout',$jafpayout);
				break;	
			}
		}
		else
		{
			JToolBarHelper::title( JText::_('JAF_COM_TITLE').': '.JText::_('JAF_USER'), 'partner48.jpg' );
			JToolBarHelper::editListX();
			JToolBarHelper::publishList();
			JToolBarHelper::unpublishList();
			JToolBarHelper::deleteList();			
			JToolBarHelper::back();		
			$this->UsersList();
		}		
		parent::display($tpl);	
		include_once(JPATH_COMPONENT.DS.'helpers'.DS.'footer.php');
	}	   
	function UsersList() {
		global $mainframe, $option;		
		$items =& $this->get('Data'); 
		$pagination =& $this->get('Pagination');
		$this->assignRef('items', $items);
		$this->assignRef('pagination', $pagination);
	}   
	function showLeads() {
		global $mainframe, $option;		
		$items =& $this->get('Datale'); 
		$pagination =& $this->get('Pagination');
		$this->assignRef('items', $items);
		$this->assignRef('pagination', $pagination);
	} 	
	function showClicks() {
		global $mainframe, $option;		
		$items =& $this->get('Datauc'); 
		$pagination =& $this->get('Pagination');
		$this->assignRef('items', $items);
		$this->assignRef('pagination', $pagination);
	} 
}
?>