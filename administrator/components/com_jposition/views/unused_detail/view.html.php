<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport( 'joomla.application.component.view' );

class unused_detailVIEWunused_detail extends JView
{

	function display($tpl = null)
	{
	
		global $mainframe, $option;	
    	//DEVNOTE: Set ToolBar title
   		JToolBarHelper::title(   JText::_( 'J!POSITION' ), 'module.png' );

		parent::display($tpl);
	}
	
}	

?>
