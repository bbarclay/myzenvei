<?php
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.application.component.view');

class JSUsernamesViewJSUsernames extends JView {
	function display( $tpl = null ){
		
		JToolBarHelper::title( JText::_( 'JSUsernames' ) );
		
		$usernames = $this->get('Usernames');
		$pagination	= $this->get('Pagination');

		$this->set( 'usernames' , $usernames );
		$this->set( 'pagination' , $pagination );
		parent::display( $tpl );
	}
}