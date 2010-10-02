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
  function save($user, $order, $coapplicant, $business, $shipping, $card)
  {
    $db = $this->getDBO();

    $timestamp = time();
    $date = date('Y-m-d H:i:s', time());

    // Insert order
    $vendor_id = 1;
    $order_number = md5(uniqid($user['id']));
    $user_info_id = md5($user['id']);
    $order_status = 'P';

    $query = sprintf("INSERT INTO #__vm_orders
      (user_id, vendor_id, order_number, user_info_id, order_total, 
      order_subtotal, order_tax, order_shipping, order_status, ship_method_id, 
      ip_address, cdate, mdate)
      VALUES(%d, %d, %d, %d, '%.2f',
        '%.2f', '%.2f', '%.2f', '%s', %d,
        '%s', %d, %d)",
        $user['id'], $vendor_id, $order_number, $user_info_id, $order['total'],
        $order['subtotal'], $order['tax'], $order['shipping'], $order_status, $order['shipping_method'],
        JRequest::getVar('REMOTE_ADDR', '', 'server'), $timestamp, $timestamp
      );
    $db->query($query);
    $order_id = $db->insertid();

    // Insert Order History
    $query = sprintf("INSERT INTO #__vm_order_history
      (order_id, order_status_code, date_added, customer_notified, comments)
      VALUES(%d, '%s', '%s', '%s', '%s')",
        $order_id, $order_status, $date, 0, ''
      );
    $db->query($query);

    // Insert Order User Info
    $addr_type = 'BT';
    $addr_type_name = 'BT Address';

    $query = sprintf("INSERT INTO #__vm_order_user_info
      (order_id, user_id, address_type, address_type_name, company, last_name,
      first_name, phone_1, phone_2,	fax, address_1, address_2, city, state,
      country, zip, user_email, vm_coapplicant_firstname,
      vm_coapplicant_lastname, vm_coapplicant_birthday, vm_card_type,
      vm_name_on_card, vm_card_number, vm_card_expirydate, vm_csv_digits, vm_ssn_number)
      VALUES (%d, %d, '%s', '%s', '%s', '%s',
        '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s',
        '%s', '%s', '%s', '%s',
        '%s', '%s', '%s',
        '%s', '%s', '%s', '%s', '%s')",
      $order_id, $user['id'], $addr_type, $addr_type_name, $business['name'], $user['last_name'],
      $user['first_name'], $user['day_phone'], $user['evening_phone'], $user['fax_number'], $shipping['addr_1'], $shipping['addr_2'], $shipping['city'], $shipping['state'],
      $shipping['country'], $shipping['zip'], $user['email'], $coapplicant['fname'],
      $coapplicant['lname'], $coapplicant['birthday'], $card['type'],
      $card['name'], $card['number'], $card['expire_date'], $card['csv'], $user['ssn']);
    $db->query($query);

    // Insert Products Info
    $values = array();
    foreach ($order['products'] as $sku => $product) {
      $values[] = sprintf("(%d, %d, %d, %d, '%s',
        '%s', %d, '%.2f',
        '%.2f', '%s', %d, %d)",
        $order_id, $user_info_id, $vendor_id, $product['id'], $sku,
        $product['name'], $product['quantity'], $product['price'],
        $product['total'], $order_status, $timestamp, $timestamp);
    }

    $query = sprintf("INSERT INTO #__vm_order_item
      (order_id, user_info_id, vendor_id, product_id, order_item_sku, 
      order_item_name, product_quantity, product_item_price, 
      product_final_price, order_status, cdate, mdate)
      VALUES %s", implode(',', $values));
    $db->query($query);
  }
}

