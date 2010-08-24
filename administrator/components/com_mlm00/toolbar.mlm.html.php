<?php
defined( '_JEXEC' ) or die( 'Restricted access' );

class TOOLBAR_hello {

	function _NEW() {
		JToolBarHelper::save();
		JToolBarHelper::apply();
		JToolBarHelper::cancel();		
	}

	function _DEFAULT() {

		JToolBarHelper::title( JText::_( 'MLM Manager' ), 'generic.png' );
		//JToolBarHelper::publishList();
		//JToolBarHelper::unpublishList();
		//JToolBarHelper::deleteList();
		//JToolBarHelper::editListX();
		//JToolBarHelper::addNewX();
	}
}
?>