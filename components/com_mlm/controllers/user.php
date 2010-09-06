<?php
/**
 * Joomla! 1.5 component mlm
 *
 * @version $Id: controller.php 2010-08-27 14:49:16 svn $
 * @author Abdul Basit
 * @package Joomla
 * @subpackage mlm
 * @license GNU/GPL
 *
 * Package for Multi-Level-Marketing. Functionality contains: Client Signup, Building Referral Tree
 *
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.controller');

/**
 * mlm Component Controller
 */
class MlmControllerUser extends JController
{
  /**
   * Prepares the registration form
   * @return void
   */
  function register()
  {
    $user =& JFactory::getUser();

    if ($user->get('guest') == 0) {
      $this->setredirect('index.php?option=com_mlm', JText::_('You are already registered.'));
    }

    $view  =& $this->getView('Register', 'html');

    $product =& $this->getModel('Product');
    $view->setModel($product);

    $virtuemart =& $this->getModel('VirtueMart');
    $view->setModel($virtuemart);

    $view->display();
  }

  function fieldcheck()
  {
    $view  =& $this->getView('FieldCheck', 'raw');

    $user =& $this->getModel('User');
    $view->setModel($user);

    $view->display();
  }

  /**
   * Save user registration and notify users and admins if required
   * @return void
   */


  function register_save()
  {
    global $mainframe;

    // Check for request forgeries
    JRequest::checkToken() or jexit( 'Invalid Token' );

    // Get required system objects
    $user       = clone(JFactory::getUser());
    $pathway    =& $mainframe->getPathway();
    $config     =& JFactory::getConfig();
    $authorize  =& JFactory::getACL();
    $document   =& JFactory::getDocument();

    // Initialize new usertype setting
    if (!isset($newUsertype)) {
      $newUsertype = 'Registered';
     
    // TODO: Set to bussiness_associate, marketing_associate or preferred_customer?
    }

    $user_info = JRequest::getVar('user_info');
    $business_info = JRequest::getVar('business_info');
    $credit_card = JRequest::getVar('card');
    $shipping_info = JRequest::getVar('shipping');
    $billing_info = JRequest::getVar('billing');
    $co_applicant = JRequest::getVar('coapplicant');
    $autoship_date = JRequest::getVar('auto_ship_date');

    $user_info_id_value = md5( uniqid('_VIRTUEMART_SECRET' ));
    $user_info['name'] = $business_info['first_name'].' '.$business_info['last_name'];
    
    // Bind the post array to the user object
    if (!$user->bind($user_info)) {
      JError::raiseError( 500, $user->getError());
    }
    // Set some initial user values
    $user->set('id', 0);
    $user->set('usertype', $newUsertype);
    $user->set('gid', $authorize->get_group_id( '', $newUsertype, 'ARO' ));

    $date =& JFactory::getDate();
    $user->set('registerDate', $date->toMySQL());

    // If there was an error with registration, set the message and display form
    if (!$user->save()) {
      JError::raiseWarning('', JText::_( $user->getError()));
      echo $user->getError();
      echo "waj gaye";
      $this->register();
      return false;
    }
    $user_info['user_id'] = $user->id;

    $user_model = $this->getModel('User');

    $user_model->enter_virtuemart_info($business_info, $autoship_date, $co_applicant, $user_info, $shipping_info, $billing_info, $credit_card,
      5, array(), array() );

      die('Completed Execution');



    // TODO: Build Tree
    // TODO: Add autship

    // Send registration confirmation mail
    /*$password = JRequest::getString('password', '', 'post', JREQUEST_ALLOWRAW);
    $password = preg_replace('/[\x00-\x1F\x7F]/', '', $password); //Disallow control chars in the email
    self::_sendMail($user, $password);

    // Everything went fine, set relevant message depending upon user activation state and display message
    $message = JText::_( 'REG_COMPLETE' );
    $this->setRedirect('index.php', $message);*/
  }

  /**
   * Send registeration confirmation email.
   * @return void
   */
  function _sendMail()
  {
    // TODO: Send email
  }

  /**
   * Debug function
   * @return void
   */
  function _stop($obj)
  {
    global $mainframe;
    echo '<pre>';
    var_dump($obj);
    $mainframe->close();
  }

}

