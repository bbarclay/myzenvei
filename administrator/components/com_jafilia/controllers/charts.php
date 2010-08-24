<?php
defined( '_JEXEC' ) or die( 'Direct Access to this location is not allowed.' );
jimport('joomla.application.component.controller');
class JafiliaControllerCharts extends JController
{
	/**
	 * Method to display the view
	 *
	 * @access	public
	 */
	function __construct() {
		//$language =& JFactory::getLanguage();
		//$language->load('com_jafilia');
		parent::__construct();		
	}
	
	/**
	 * Shows the charts screen
	 */
	function display() {
		JRequest::setVar('view', 'charts');
		JRequest::setVar('layout', 'charts');
		parent::display();	
    }

   // function	


}
?>
