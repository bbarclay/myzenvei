<?php
defined( '_JEXEC' ) or die( 'Direct Access to this location is not allowed.' );
jimport( 'joomla.application.component.view' );
class JafiliaViewAbout extends JView {	
	function display($tpl = null) {		
		JToolBarHelper::title( JText::_('JAF_COM_TITLE').': '.JText::_('JAF_ABOUT'), 'aboutus48.jpg');
		JToolBarHelper::cancel( 'cancel', JText::_('Close') );
		parent::display($tpl);
		include_once(JPATH_COMPONENT.DS.'helpers'.DS.'footer.php');
	}
}
?>
