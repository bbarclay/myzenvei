<?php
defined( '_JEXEC' ) or die( 'Direct Access to this location is not allowed.' );
jimport( 'joomla.application.component.view' );
class JafiliaViewCharts extends JView {
	function display($tpl = null) {		
		JToolBarHelper::title( JText::_('JAF_COM_TITLE').': '.JText::_('JAF_CHARTS'), 'charts48.png');
		JToolBarHelper::cancel( 'cancel', JText::_('Close') );
		parent::display($tpl);
		include_once(JPATH_COMPONENT.DS.'helpers'.DS.'footer.php');
	}
}
?>
