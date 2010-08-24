<?php
defined( '_JEXEC' ) or die( '=;)' );
jimport('joomla.application.component.model');
class JafiliaModelAbout extends JModel {
	function __construct() {
		parent::__construct();
	}	
	function cancel() {
      $msg = JText::_('JAF_CANCELED');
      $this->setRedirect( 'index.php?option=com_jafilia', $msg );
   }
}
?>