<?php
/**
 * @version $Id: header.php 789 2009-01-26 15:56:03Z elkuku $
 * @package    Jafilia
 * @subpackage
 * @author     EasyJoomla {@link http://www.easy-joomla.org Easy-Joomla.org}
 * @author     Arkadiusz Maniecki {@link http://www.jafilia.pl}
 * @author     Created on 08-Apr-2009
 */

//--No direct access
defined( '_JEXEC' ) or die( '=;)' );

jimport('joomla.application.component.controller');

/**
 * Jafilia Controller
 *
 * @package    Jafilia
 * @subpackage Controllers
 */
class JafiliaControllerUser extends JController //JafiliaController
{
   /**
    * constructor (registers additional tasks to methods)
    * @return void
    */
   function __construct()
   {
		
		$language =& JFactory::getLanguage();
		$language->load('com_jafilia');
		parent::__construct();
		// Register Extra tasks
		$this->registerTask( 'add', 'edit' );
   }// function
	function display()
    {
		JRequest::setVar('view', 'user');
		//JRequest::setVar( 'layout', 'linklist' );	//layout pokazyje szablon widoku z katalogu tmpl inny niz default
		//JRequest::setVar('layout', 'links');
		
		parent::display();	
	
        //parent::display();
		//echo 'dupa maryni';
    }
	/**
	 * Shows the charts screen
	 */
	//function links() {	//wskazuje na task 'links'
		//JRequest::setVar('view', 'links');
		//JRequest::setVar( 'layout', 'linklist' );	//layout pokazyje szablon widoku z katalogu tmpl inny niz default
		//JRequest::setVar('layout', 'links');
		
		//parent::display();
	//}
   /**
    * display the edit form
    * @return void
    */
   function edit()
   {
      JRequest::setVar( 'view', 'user' );
      JRequest::setVar( 'layout', 'form'  );
      //JRequest::setVar('hidemainmenu', 1);
      parent::display();
   }// function
   function userLeads()
   {
      JRequest::setVar( 'view', 'user' );
      JRequest::setVar( 'layout', 'userleads'  );
      //JRequest::setVar('hidemainmenu', 1);
      parent::display();
   }  
function changeStatus () {
      $model = $this->getModel('User');
      if(!$model->changeStatus()) {
         $msg = JText::_('Error: Status Could not be changed');
      } else {
         $msg = JText::_('JAF_UPDATED');
      }
      $this->setRedirect( 'index.php?option=com_jafilia&controller=user&task=userLeads&cid[]='.$_GET['uid'], $msg );
/*
      JRequest::setVar( 'view', 'user' );
      JRequest::setVar( 'layout', 'userleads'  );
      //JRequest::setVar('hidemainmenu', 1);
      parent::display();
	  */
}   
   function userClicks()
   {
      JRequest::setVar( 'view', 'user' );
      JRequest::setVar( 'layout', 'userclicks'  );
      //JRequest::setVar('hidemainmenu', 1);
      parent::display();
   }// function
   /**
    * save a record (and redirect to main page)
    * @return void
    */
   function save()
   {
      $model = $this->getModel('User');

      if ($model->store($post)) {
         $msg = JText::_('JAF_SAVED');
      } else {
         $msg = JText::_('Error Saving');
      }

      // Check the table in so it can be edited.... we are done with it anyway
      $link = 'index.php?option=com_jafilia&controller=user';
      $this->setRedirect($link, $msg);
   }// function

   /**
    * remove record(s)
    * @return void
    */
   function remove()
   {
      $model = $this->getModel('User');
      if(!$model->delete()) {
         $msg = JText::_('Error: One or More user Could not be Deleted');
      } else {
         $msg = JText::_('JAF_DELETED');
      }

      $this->setRedirect( 'index.php?option=com_jafilia&controller=user', $msg );
   }// function
	function unpublish()
	{
		// Check for request forgeries
		//JRequest::checkToken() or jexit( 'Invalid Token' );

		$cid = JRequest::getVar( 'cid', array(), 'post', 'array' );
		JArrayHelper::toInteger($cid);

		if (count( $cid ) < 1) {
			JError::raiseError(500, JText::_( 'Select an item to unpublish' ) );
		}

		$model = $this->getModel('User');
		if(!$model->publish($cid, 0)) {
			echo "<script> alert('".$model->getError(true)."'); window.history.go(-1); </script>\n";
		}

		$this->setRedirect( 'index.php?option=com_jafilia&controller=user' );
	}   
   function publish()
   {
 		// Check for request forgeries
	//	JRequest::checkToken() or jexit( 'Invalid Token' );

		$cid = JRequest::getVar( 'cid', array(), 'post', 'array' );
		JArrayHelper::toInteger($cid);

		if (count( $cid ) < 1) {
			JError::raiseError(500, JText::_( 'Select an item to publish' ) );
		}

		$model = $this->getModel('User');
		if(!$model->publish($cid, 1)) {
			echo "<script> alert('".$model->getError(true)."'); window.history.go(-1); </script>\n";
		}

		$this->setRedirect( 'index.php?option=com_jafilia&controller=user' );  
   /*
      $model = $this->getModel('user');
      if(!$model->publish()) {
         $msg = JText::_( 'Error: One or More Greetings Could not be Published' );
      } else {
         $msg = JText::_( 'Greeting(s) Published' );
      }

      $this->setRedirect( 'index.php?option=com_jafilia', $msg );
	  */
   }
	function payout()  {
      $model = $this->getModel('User');
      if(!$model->payout()) {
         $msg = JText::_('payout+done');
      } else {
         $msg = JText::_('payout+error');
      }	
		//mosRedirect("index2.php?option=$option&task=editUser&id=".$id."&mosmsg=payout+done");
		//$msg = 'payout+done'; //JText::_('JAF_CANCELED');
		'http://127.0.0.1/joomla_1.5.10-stable-full_package-test/administrator/index.php?option=com_jafilia&controller=user&task=edit&cid[]=5';
		//$this->setRedirect( 'index.php?option=com_jafilia&controller=user', $msg );
		$this->setRedirect( 'index.php?option=com_jafilia&controller=user&task=edit&cid[]='.$_GET['uid'], $msg );
	}
   function cancel()
   {
      //$msg = JText::_('JAF_CANCELED');
      //$this->setRedirect( 'index.php?option=com_jafilia&controller=user', $msg );
	  $this->setRedirect( 'index.php?option=com_jafilia&controller=user');
   }// function

}// class