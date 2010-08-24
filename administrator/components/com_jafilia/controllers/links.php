<?php

defined( '_JEXEC' ) or die( '=;)' );
jimport('joomla.application.component.controller');
class JafiliaControllerLinks extends JController 
{
   function __construct() {		
		$language =& JFactory::getLanguage();
		$language->load('com_jafilia');
		parent::__construct();
		$this->registerTask( 'add', 'edit' );
   }
	function display() {
		JRequest::setVar('view', 'links');
		parent::display();	
    }
   function edit() {
      JRequest::setVar( 'view', 'links' );
      JRequest::setVar( 'layout', 'form'  );
      JRequest::setVar('hidemainmenu', 1);
      parent::display();
   }
   function save() {
      $model = $this->getModel('Links');
      if ($model->store($post)) {
         $msg = JText::_('JAF_SAVED');
      } else {
         $msg = JText::_('Error Saving');
      }
      $link = 'index.php?option=com_jafilia&controller=links';
      $this->setRedirect($link, $msg);
   }
   function remove() {
      $model = $this->getModel('Links');
      if(!$model->delete()) {
         $msg = JText::_('Error: One or More Links Could not be Deleted');
      } else {
         $msg = JText::_('JAF_DELETED');
      }
      $this->setRedirect( 'index.php?option=com_jafilia&controller=links', $msg );
   }
	function unpublish() {
		$cid = JRequest::getVar( 'cid', array(), 'post', 'array' );
		JArrayHelper::toInteger($cid);
		if (count( $cid ) < 1) {
			JError::raiseError(500, JText::_( 'Select an item to unpublish' ) );
		}
		$model = $this->getModel('Links');
		if(!$model->publish($cid, 0)) {
			echo "<script> alert('".$model->getError(true)."'); window.history.go(-1); </script>\n";
		}
		$this->setRedirect( 'index.php?option=com_jafilia&controller=links' );
	}   
   function publish() {
		$cid = JRequest::getVar( 'cid', array(), 'post', 'array' );
		JArrayHelper::toInteger($cid);
		if (count( $cid ) < 1) {
			JError::raiseError(500, JText::_( 'Select an item to publish' ) );
		}
		$model = $this->getModel('Links');
		if(!$model->publish($cid, 1)) {
			echo "<script> alert('".$model->getError(true)."'); window.history.go(-1); </script>\n";
		}
		$this->setRedirect( 'index.php?option=com_jafilia&controller=links' );  
   }
   function cancel() {
      $msg = JText::_('JAF_CANCELED');
      $this->setRedirect( 'index.php?option=com_jafilia&controller=links', $msg );
   }
}// class