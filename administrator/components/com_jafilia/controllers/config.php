<?php
defined( '_JEXEC' ) or die( 'Direct Access to this location is not allowed.' );
jimport('joomla.application.component.controller');
class JafiliaControllerConfig extends JController
{

	function __construct() {
		parent::__construct();	
	}
	
	function display() {
		JRequest::setVar('view', 'config');
		parent::display();	
    }
   function save() {
      $model = $this->getModel('Config');

      if ($model->store($post)) {
         $msg = JText::_('JAF_SAVED');
      } else {
         $msg = JText::_('Error Saving Config');
      }
      $link = 'index.php?option=com_jafilia&controller=config';
      $this->setRedirect($link, $msg);
   }
  
	function cancel()
   {
      $msg = JText::_('JAF_CANCELED');
      $this->setRedirect( 'index.php?option=com_jafilia', $msg );
   }

}
?>
