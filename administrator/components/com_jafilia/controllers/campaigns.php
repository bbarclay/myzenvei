<?php

defined( '_JEXEC' ) or die( '=;)' );
jimport('joomla.application.component.controller');
class JafiliaControllerCampaigns extends JController 
{
   function __construct() {		
		$language =& JFactory::getLanguage();
		$language->load('com_jafilia');
		parent::__construct();
		$this->registerTask( 'add', 'edit' );
   }
	function display() {
		JRequest::setVar('view', 'campaigns');
		parent::display();	
    }
   function edit() {
      JRequest::setVar( 'view', 'campaigns' );
      JRequest::setVar( 'layout', 'form'  );
      JRequest::setVar('hidemainmenu', 1);
      parent::display();
   }
   function save() {
      $model = $this->getModel('Campaigns');
      if ($model->store($post)) {
         $msg = JText::_('JAF_SAVED');
      } else {
         $msg = JText::_('Error Saving');
      }
      $link = 'index.php?option=com_jafilia&controller=campaigns';
      $this->setRedirect($link, $msg);
   }
   function remove() {
      $model = $this->getModel('Campaigns');
      if(!$model->delete()) {
         $msg = JText::_('Error: One or More Campaigns Could not be Deleted');
      } else {
         $msg = JText::_('JAF_DELETED');
      }
      $this->setRedirect( 'index.php?option=com_jafilia&controller=campaigns', $msg );
   }
	function unpublish() {
		$cid = JRequest::getVar( 'cid', array(), 'post', 'array' );
		JArrayHelper::toInteger($cid);
		if (count( $cid ) < 1) {
			JError::raiseError(500, JText::_( 'Select an item to unpublish' ) );
		}
		$model = $this->getModel('Campaigns');
		if(!$model->publish($cid, 0)) {
			echo "<script> alert('".$model->getError(true)."'); window.history.go(-1); </script>\n";
		}
		$this->setRedirect( 'index.php?option=com_jafilia&controller=campaigns' );
	}   
   function publish() {
		$cid = JRequest::getVar( 'cid', array(), 'post', 'array' );
		JArrayHelper::toInteger($cid);
		if (count( $cid ) < 1) {
			JError::raiseError(500, JText::_( 'Select an item to publish' ) );
		}
		$model = $this->getModel('Campaigns');
		if(!$model->publish($cid, 1)) {
			echo "<script> alert('".$model->getError(true)."'); window.history.go(-1); </script>\n";
		}
		$this->setRedirect( 'index.php?option=com_jafilia&controller=campaigns' );  
   }
   function cancel() {
      $msg = JText::_('JAF_CANCELED');
      $this->setRedirect( 'index.php?option=com_jafilia&controller=campaigns', $msg );
   }
}// class