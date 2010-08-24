<?php
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport( 'joomla.application.component.view' );

/**
 [controller]View[controller]
 */
 
class unusedViewunused extends JView
{
	function __construct( $config = array())
	{	  
 	 global $context;
	 $context = 'unused.list.';
 	 parent::__construct( $config );
	}
    
	function display($tpl = null)
	{		 
    	global $mainframe, $context;
		$document = & JFactory::getDocument();
		$document->setTitle( JText::_('J!position') );
    	JToolBarHelper::title(   JText::_( 'J!POSITION' ), 'module.png' );
    
    	//DEVNOTE: Set toolbar items for the page
 		//JToolBarHelper::addNewX();
 		//JToolBarHelper::editListX();		
		//JToolBarHelper::deleteList();
		JToolBarHelper::publishList();
		JToolBarHelper::unpublishList();
		//JToolBarHelper::help( 'screen.jposition.edit' );    

    	//DEVNOTE: Set ToolBar title
		$uri	=& JFactory::getURI();
		
		//DEVNOTE:give me ordering from request
		$filter_order     = $mainframe->getUserStateFromRequest( $context.'filter_order',      'filter_order', 	  'ordering' );
		$filter_order_Dir = $mainframe->getUserStateFromRequest( $context.'filter_order_Dir',  'filter_order_Dir', '' );		
	
		//DEVNOTE:remember the actual order and column  
		$lists['order'] = $filter_order;  
		$lists['order_Dir'] = $filter_order_Dir;
  	
		//DEVNOTE:Get data from the model
		$items		= & $this->get( 'Data');
		$total		= & $this->get( 'Total');
		$pagination	= & $this->get( 'Pagination' );
		
		//DEVNOTE:save a reference into view	
		$this->assignRef('user',		JFactory::getUser());	
		$this->assignRef('lists',		$lists);    
		$this->assignRef('items',		$items); 		
		$this->assignRef('pagination',	$pagination);
		$this->assignRef('request_url',	$uri->toString());

		//DEVNOTE:call parent display
    	parent::display($tpl);
  }
}

?>
