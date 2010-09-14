<?php
/**
 * Joomla! 1.5 component mlm
 *
 * @version $Id: mlm.php 2010-08-27 14:49:16 svn $
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

jimport('joomla.application.component.model');

/**
 * mlm Component Order Model
 *
 * @author      Abdul Basit
 * @package		  Joomla
 * @subpackage	mlm
 * @since       1.5
 */
class MlmModelOrder extends JModel
{
  function save($user, $order)
  {
    $db = $this->getDBO();

    // Insert order
    $query = sprintf("INSERT INTO #__vm_orders
      (user_id, vendor_id, order_number, user_info_id, order_total, 
      order_subtotal, order_tax, order_shipping, order_status, ship_method_id, 
      ip_address, cdate, mdate)
      VALUES(%d, %d, %d, %d, '%.2f',
        '%.2f', '%.2f', '%.2f', '%s', %d,
        '%s', %d, %d)",
        $user['id'], false, false, false, $order['total'],
        $order['subtotal'], $order['tax'], $order['shipping'], false, $order['shipping_method'],
        JRequest::getVar('REMOTE_ADDR', '', 'server'), false, false
      );
    var_dump($query);
//    $db->query($query);

    $order_id = $db->insertid();

    // Insert Order History
    $query = sprintf("INSERT INTO #__vm_order_history
      (order_id, order_status_code, date_added, customer_notified, comments
      VALUES(%d, '%s', '%s', '%s', '%s')",
        $order_id, false, false, false, false
      );
    var_dump($query);
//    $db->query($query);

/*    // Insert Order User Info
    $query = sprintf("INSERT INTO  #_vm_order_user_info
    order_id, user_id, address_type, address_type_name, company, last_name, first_name, phone_1, phone_2,	
    fax, address_1, address_2, city, state,	country, zip, user_email, vm_coapplicant_firtsname, vm_coapplicant_lastname,
    vm_coapplicant_birthday, vm_card_type, vm_name_on_card, vm_card_number, vm_card_expirydate, vm_csv_digits, vm_refferal_id_name, vm_ssn_number
    values('".$order_id."','".$user_info['user_id']."','BT','BT Address','".$business_info['business_name']."','".$business_info['last_name']."',
      '".$business_info['lname']."','".$business_info['day_phone']."','".$business_info['evening_phone']."','".$business_info['fax']."',
      '".$shipping_info['address_1']."','".$shipping_info['address_2']."','".$shipping_info['city']."','".$shipping_info['state']."',
      '".$shipping_info['country']."','".$shipping_info['country']."','".$shipping_info['zip']."','".$user_info['email']."',
      '".$coapplicant_info['fname']."','".$coapplicant_info['lname']."','".$coapplicant_info['birthday']."','".$card_info['type']"',
      '".$card_info['name']"','".$card_info['number']."','".$card_info['expire_date']."','".$card_info['csv']."','".$refferal_name."'.
      '".$business_info['ssn']"')");
    $db->query($query);
 */
    // Insert Products Info
    $values = array();
    foreach ($order['products'] as $sku => $product) {
      $values[] = sprintf("(%d, %d, %d, %d, '%s',
        '%s', %d, '%.2f',
        '%.2f', '%s', %d, %d)",
        $order_id, false, false, $product['id'], $sku,
        $product['name'], $product['quantity'], $product['price'],
        $product['total'], false, false, false);
    }

    $query = sprintf("INSERT INTO #__vm_order_item
      (order_id, user_info_id, vendor_id, product_id, order_item_sku, 
      order_item_name, product_quantity, product_item_price, 
      product_final_price, order_status, cdate, mdate)
      VALUES %s", implode(',', $values));
    var_dump($query);
//    $db->query($query);
  }
}

