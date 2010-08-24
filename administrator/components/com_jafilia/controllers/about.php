<?php
defined( '_JEXEC' ) or die( 'Direct Access to this location is not allowed.' );
jimport('joomla.application.component.controller');
class JafiliaControllerAbout extends JController {
	function __construct() {
		parent::__construct();		
	}
	function display() {
		JRequest::setVar('view', 'about');
		parent::display();	
    }
}
?>
