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

    $view  =& $this->getView('register', 'html');

    $product =& $this->getModel('Product');
    $view->setModel($product);

    $virtuemart =& $this->getModel('VirtueMart');
    $view->setModel($virtuemart);

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
    if (!$newUsertype) {
      $newUsertype = 'Registered';
      // TODO: Set to bussiness_associate, marketing_associate or preferred_customer?
    }

    // Bind the post array to the user object
    if (!$user->bind( JRequest::get('post'), 'usertype' )) {
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
      $this->register();
      return false;
    }

    // TODO: Build Tree
    // TODO: Add autship

    // Send registration confirmation mail
    $password = JRequest::getString('password', '', 'post', JREQUEST_ALLOWRAW);
    $password = preg_replace('/[\x00-\x1F\x7F]/', '', $password); //Disallow control chars in the email
    self::_sendMail($user, $password);

    // Everything went fine, set relevant message depending upon user activation state and display message
    $message = JText::_( 'REG_COMPLETE' );

    $this->setRedirect('index.php', $message);
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

