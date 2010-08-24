<?php
defined( '_JEXEC' ) or die( 'Direct Access to this location is not allowed.' );
jimport( 'joomla.application.component.view' );
class JafiliaViewConfig extends JView {	
	function display($tpl = null) {		
		JToolBarHelper::title( JText::_('JAF_COM_TITLE').': '.JText::_('JAF_CONFIG'), 'configuration48.jpg' );
		JToolBarHelper::save();
		JToolBarHelper::cancel();
		parent::display($tpl);
		include_once(JPATH_COMPONENT.DS.'helpers'.DS.'footer.php');
	}
}
?>
