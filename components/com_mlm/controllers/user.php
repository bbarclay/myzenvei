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

  /**
   * Save user registration
   * @return void
   */
  function register_save()
  {
    echo '<pre>';
    // Check for request forgeries
    JRequest::checkToken() or jexit('Invalid Token');

    $user              = JRequest::getVar('user');
    $referee           = JRequest::getVar('referee');
    $enrollment_type   = JRequest::getVar('enrollment_type');
    $order             = JRequest::getVar('order');
    $autoship          = JRequest::getVar('autoship');
    $coapplicant       = JRequest::getVar('coapplicant');
    $business          = JRequest::getVar('business');
    $shipping          = JRequest::getVar('shipping');
    $billing           = JRequest::getVar('billing');
    $card              = JRequest::getVar('card');
    $terms_conditions  = JRequest::getVar('terms_conditions');

    // Create Joomla User
    $user['name'] = trim($user['first_name'].' '.$user['last_name']);
    
    $user_obj = $this->_createJoomlaUser();

    $user['id'] = $user_obj->id;
    
    // Insert user in the referral tree
    if ($enrollment_type  != 'preferred_customer') {
      $referral_tree = $this->getModel('ReferralTree');
      $referral_tree->addUser($user_obj->id, $referee);
    }

    // Create Replicated Site
    $user_model    = $this->getModel('User');
    $user_model->addReplicatedSite($user);

    $shopper_group = ucwords(str_replace('_', ' ', $enrollment_type));
    $shopper_group = $virtuemart->getShopperGroupByName($shopper_group);
    if ($shopper_group) {
      $user['shopper_group_id'] = $shopper_group->shopper_group_id;
    } else {
      $user['shopper_group_id'] = 0;
    }

    // Insert virtuemart information
    $virtuemart    = $this->getModel('VirtueMart');
    $virtuemart->addUser('VirtueMart');

    // Add Registration Fee Info
    // Add Jafilia Info
    // Add Communtiy Info

    // Insert virtuemart information
    $virtuemart    = $this->getModel('VirtueMart');
    $virtuemart->addUser('VirtueMart');

    // Process current order
    $order_id = $this->_createOrder($user, $order, $coapplicant, $business, $shipping, $card);


//    $user_model = $this->getModel('User');

//    $user_model->enter_virtuemart_info($business_info, $autoship_date, $co_applicant, $user_info, $shipping_info, $billing_info, $credit_card,
//      5, array(), array() );

//      die('Completed Execution');



    // Send registration confirmation mail
    /*
      $password = JRequest::getString('password', '', 'post', JREQUEST_ALLOWRAW);
    $password = preg_replace('/[\x00-\x1F\x7F]/', '', $password); //Disallow control chars in the email
    self::_sendMail($user, $password);

    // Everything went fine, set relevant message depending upon user activation state and display message
    $message = JText::_('REG_COMPLETE');
    $this->setRedirect('index.php', $message);
     */
    jexit();
  }

  function _createJoomlaUser($user_info)
  {
    $user_obj   = clone(JFactory::getUser());
    $authorize  =& JFactory::getACL();

    // Bind the post array to the user object
    if (!$user_obj->bind($user)) {
      JError::raiseError( 500, $user->getError());
    }

    // Set some initial user values
    $user_obj->set('id', 0);
    $user_obj->set('usertype', 'Registered');
    $user_obj->set('gid', $authorize->get_group_id('', 'Registered', 'ARO'));

    $date =& JFactory::getDate();
    $user_obj->set('registerDate', $date->toMySQL());

    // If there was an error with registration, set the message and display form
    if (!$user_obj->save()) {
      JError::raiseWarning('', JText::_($user_obj->getError()));
      $this->register();
    }

    return $user_obj;
  }

  function _createOrder($user, $order, $coapplicant, $business, $shipping, $card)
  {
    $virtuemart    = $this->getModel('VirtueMart');
    $product_model = $this->getModel('Product');
    $order_model   = $this->getModel('Order');


    $order_subtotal = 0;

    $products = $product_model->getProductsByShopperGroup($user['shopper_group_id']);
    // Calculations for individual products
    foreach ($products as $product) {
      $sku = $product->product_sku;

      $quantity = $order['products'][$sku];
      if ($quantity > 0) {
        $order['products'][$sku] = array();
        $price = sprintf('%.2f', $product->product_price);
        $total = sprintf('%.2f', $price*$quantity);

        $order['products'][$sku]['id']        = $product->product_id;
        $order['products'][$sku]['name']      = $product->product_name;
        $order['products'][$sku]['price']     = $price;
        $order['products'][$sku]['total']     = $total;
        $order['products'][$sku]['quantity']  = $quantity;

        $order_subtotal += $total;
      } else {
        unset($order['products'][$sku]);
      }
    }

    $order['subtotal']  = sprintf('%.2f', $order_subtotal);

    // Tax Rate
    $tax_rate = $virtuemart->getTaxRate($shipping['state'], $shipping['country']);
    $order['tax'] = sprintf('%.2f', $tax_rate*$order['subtotal']);

    // Shipping
    $order['shipping'] = '0.00';

    $order['total'] = $order['subtotal'] + $order['shipping'] + $order['tax'];

    return $order_model->save($user, $order, $coapplicant, $business, $shipping, $card);
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
  function _debug($obj)
  {
    global $mainframe;
    echo '<pre>';
    var_dump($obj);
    $mainframe->close();
  }

}

