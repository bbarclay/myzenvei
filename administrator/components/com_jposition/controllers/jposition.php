<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport( 'joomla.application.component.controller' );

class jpositionController extends JController
{
	function __construct( $default = array()){
		parent::__construct( $default );
	}

	function cancel(){
		$this->setRedirect( 'index.php' );
	}
	function display() {
		parent::display();
	}
}	
?>
