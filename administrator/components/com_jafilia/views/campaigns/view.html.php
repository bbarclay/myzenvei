<?php
defined( '_JEXEC' ) or die( '=;)' );
jimport( 'joomla.application.component.view');
class JafiliaViewCampaigns extends JView {
   function display($tpl = null) {
		$task = JRequest::getCmd('task');
		if ($task) {
			$Jafilia =& $this->get('Data2');
			$isNew = ($Jafilia->id < 1);
			$text = $isNew ? JText::_( 'New' ) : JText::_( 'Edit' );
			JToolBarHelper::title( JText::_('JAF_COM_TITLE').': '.JText::_('JAF_CAMPAIGNS').' <small><small>[ ' . $text.' ]</small></small>', 'banners48.jpg' );
			JToolBarHelper::save();
			if ($isNew)  {			
				JToolBarHelper::cancel();
			} else {
			
				JToolBarHelper::cancel( 'cancel', JText::_('Close') );
			}
			$this->assignRef('Campaigns', $Jafilia);		
		}
		else {
			JToolBarHelper::title( JText::_('JAF_COM_TITLE').': '.JText::_('JAF_CAMPAIGNS'), 'banners48.jpg' );
			JToolBarHelper::publishList();
			JToolBarHelper::unpublishList();
			JToolBarHelper::deleteList();
			JToolBarHelper::editListX();
			JToolBarHelper::addNewX();		
			$this->CampaignsList();
		}
		parent::display($tpl);
		include_once(JPATH_COMPONENT.DS.'helpers'.DS.'footer.php');		
	}	   
	function CampaignsList() {
		global $mainframe, $option;		
		$items =& $this->get('Data'); 
		$pagination =& $this->get('Pagination');
		$this->assignRef('items', $items);
		$this->assignRef('pagination', $pagination);
	}   
}
?>