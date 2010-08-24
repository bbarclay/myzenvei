<?php
defined( '_JEXEC' ) or die( 'Direct Access to this location is not allowed.' );
jimport('joomla.application.component.controller');
class JafiliaControllerHelp extends JController {
	function __construct() {
		parent::__construct();		
	}
	function display() {
		JRequest::setVar('view', 'help');
		parent::display();	
    }
}
?>
