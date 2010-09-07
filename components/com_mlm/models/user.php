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
 * mlm Component User Model
 *
 * @author      Abdul Basit
 * @package		  Joomla
 * @subpackage	mlm
 * @since       1.5
 */
class MlmModelUser extends JModel
{

  function username_available($username)
  {
    $db = $this->getDBO();

    $query = sprintf('SELECT COUNT(id)
      FROM #__users
      WHERE username = \'%s\'', $username);

    $db->setQuery($query);

    $count = $db->loadResult();
    return $count == 0;
  }

  function replicated_site_available($site_id)
  {
    $db = $this->getDBO();

    $query = sprintf('SELECT COUNT(id)
      FROM #__vm_jsusernames
      WHERE username = \'%s\'', $site_id);

    $db->setQuery($query);

    $count = $db->loadResult();
    return $count == 0;
  }

  function email_available($email)
  {
    $db = $this->getDBO();

    $query = sprintf('SELECT COUNT(id)
      FROM #__users
      WHERE email = \'%s\'', $email);

    $db->setQuery($query);

    $count = $db->loadResult();
    return $count == 0;
  }

  function enter_virtuemart_info($business_info, $autoship_date, $coapplicant_info, $user_info, $shipping_info, $billing_info, $card_info,
    $shopper_group_id, $order_info, $products_info ){
    $refferal_name  = "HardCoded Value";
    $db = $this->getDBO();

    $user_info_id_value = md5( uniqid('_VIRTUEMART_SECRET '));

    $query = sprintf("
    INSERT INTO  jos_vm_user_info 
    (user_info_id, user_id, address_type, address_type_name, company, last_name, first_name, phone_1, phone_2, fax,	address_1, address_2, city,
    state,	country, zip, user_email, vm_coapplicant_firtsname, vm_coapplicant_lastname, vm_coapplicant_birthday, vm_card_type, vm_name_on_card,
    vm_card_number, vm_card_expirydate, vm_csv_digits, vm_refferal_id_name, vm_ssn_number, vm_autoship_date)

    values('".$user_info_id_value."','".$user_info['user_id']."','BT','BT Address','".$business_info['business_name']."',
      '". $business_info['last_name']."','".$business_info['first_name']."','".$business_info['day_phone']."',
      '".$business_info['evening_phone']."','".$business_info['fax_number']."','".$shipping_info['addr_1']."','".$shipping_info['addr_2']."',
      '".$shipping_info['city']."','".$shipping_info['state']."','".$shipping_info['country']."','".$shipping_info['zip']."',
      '".$user_info['email']."','".$coapplicant_info['fname']."','".$coapplicant_info['lname']."','".$coapplicant_info['birthday']."',
      '".$card_info['type']."','".$card_info['name']."','".$card_info['number']."','".$card_info['expire_date']."','".$card_info['csv']."',
      '".$refferal_name."','".$business_info['ssn']."','".$autoship_date."')");

    $db->Execute($query);
    $query = sprintf(" 
    INSERT INTO  jos_vm_shopper_vendor_xref
    (user_id,vendor_id,shopper_group_id)
    values('".$user_info['user_id']."','1','".$shopper_group_id."')");
    
    var_dump($query);
     $db->Execute($query);


/*
    $query = sprintf("INSERT INTO jos_vm_orders
    user_id, vendor_id, order_number, user_info_id, order_total, order_subtotal, order_tax, order_shipping, order_status, 
    ship_method_id, ip_address, cdate, mdate
    values('".$user_info['user_id']."','1','".$order_info['number']."','".$user_info_id_value."','".$order_info['total']."',
      '".$order_info['subtotal']."','".$order_info['tax']."','".$order_info['shipping']."','".$order_info['status']."','".$order_info['ship_method']."',
      '".$order_info['ip_address']."','".$order_info['cdate']."','".$order_info['mdate']."')");

    //TODO:Get Id of inserted order in $order_id

    var_dump($query);die();
/*
    $db->ExecuteQuery($query);
    $reg_date = date("Y-m-d H:i:s");

    $query = sprintf("INSERT INTO jos_vm_order_history
    order_id, order_status_code, date_added, customer_notified, comments
    values('".$order_id."',".$order_info['status']."','".$reg_date."','0','This is Test Order')");

    $db->ExecuteQuery($query);

    $query = sprintf("INSERT INTO  jos_vm_order_user_info
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

    $db->ExecuteQuery($query);

    foreach($products_info as $product){ 
      $query = sprintf("INSERT INTO jos_vm_order_item
      order_id, user_info_id, vendor_id, product_id, order_item_sku, order_item_name, product_quantity,
      product_item_price, product_final_price, order_status, cdate, mdate
      values('".$order_id."','".$user_info_id_value."','1','".$product['id']."','".$product['sku']."','".$product['name']."',
        '".$product['quantity']."','".$product['price']."','".$product['final_price']."','P','".$cdate."','".$mdate."')");

      $db->ExecuteQuery($query);


    }*/




  }


}

