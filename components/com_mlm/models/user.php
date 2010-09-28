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

  private $reserved_words = array();

  function check_username($username)
  {
    $username = strtolower($username);
    if (preg_match('/[^a-z1-9].*/', $username)) {
      return 'invalid';
    } else if (in_array($username, $this->reserved_words)) {
      return 'reserved';
    } else {
      $db = $this->getDBO();
      $query = sprintf('SELECT COUNT(id)
        FROM #__users
        WHERE username = \'%s\'', $username);
      $db->setQuery($query);

      $count = $db->loadResult();
      return $count == 0 ? 'available' : 'taken';
    }
  }

  function check_replicated_site($site_id)
  {
    $site_id = strtolower($site_id);
    if (preg_match('/[^a-z1-9].*/', $site_id)) {
      return 'invalid';
    } else if (in_array($site_id, $this->reserved_words)) {
      return 'reserved';
    } else {
      $db = $this->getDBO();
      $query = sprintf('SELECT COUNT(id)
        FROM #__vm_jsusernames
        WHERE username = \'%s\'', $site_id);
      $db->setQuery($query);

      $count = $db->loadResult();
      return $count == 0 ? 'available' : 'taken';
    }
  }

  function check_email($email)
  {
    $email = strtolower($email);

    $db = $this->getDBO();
    $query = sprintf('SELECT COUNT(id)
      FROM #__users
      WHERE email = \'%s\'', $email);
    $db->setQuery($query);

    $count = $db->loadResult();
    return $count == 0 ? 'available' : 'taken';
  }

  function addReplicatedSite($user)
  {
  }
/*
  function insertVirtuemartInfo($biz, $coapplicant, $user, $shipping, $billing, $card, $shopper_group_id, $order_info, $products_info) {
    $db = $this->getDBO();

    $user_info_id_value = md5( uniqid('_VIRTUEMART_SECRET '));

    $query = sprintf("
    INSERT INTO # _vm_user_info 
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
    INSERT INTO  #_vm_shopper_vendor_xref
    (user_id,vendor_id,shopper_group_id)
    values('".$user_info['user_id']."','1','".$shopper_group_id."')");

    var_dump($query);
     $db->Execute($query);

    $order_number = md5(time());

    $query = sprintf("INSERT INTO #_vm_orders
    user_id, vendor_id, order_number, user_info_id, order_total, order_subtotal, order_tax, order_shipping, order_status, 
    ship_method_id, ip_address, cdate, mdate
    values('".$user_info['user_id']."','1','".$order_info['number']."','".$user_info_id_value."','".$order_info['total']."',
      '".$order_info['subtotal']."','".$order_info['tax']."','".$order_info['shipping']."','".$order_info['status']."','".$order_info['ship_method']."',
      '".$order_info['ip_address']."','".$order_info['cdate']."','".$order_info['mdate']."')");

    $db->query($query);

    $order_id = $db->insertid();

    $reg_date = date('Y-d-m',time());


    $query = sprintf("INSERT INTO #_vm_order_history
    order_id, order_status_code, date_added, customer_notified, comments
    values('%d','%s','%s','%s','%s')",$order_id, $order_info['status'], $reg_date, '0', 'This is a Test order');

    $db->query($query);

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

    foreach($products_info as $product){

      $query = sprintf("INSERT INTO #_vm_order_item
      order_id, user_info_id, vendor_id, product_id, order_item_sku, order_item_name, product_quantity,
      product_item_price, product_final_price, order_status, cdate, mdate
      values('".$order_id."','".$user_info_id_value."','1','".$product['id']."','".$product['sku']."','".$product['name']."',
        '".$product['quantity']."','".$product['price']."','".$product['final_price']."','P','".$cdate."','".$mdate."')");

      $db->query($query);
    }
  }

  function insert_registration_fee($user_id, $fee){
    $db = $this->getDBO();
    
    $regdate = time(); // current date
    $next_date = $regdate + 30*86400; //a month later

    $regdate = date('Y-m-d',$regdate);
    $next_date = date('Y-m-d',$regdate);

    $query = sprintf('INSERT INTO #_fixed_reg_fee
      (regfee,userid,regdate,nextpaymentdate)
      VALUES(\'%f\',\'%d\',\'%s\',\'%s\')',$fee, $user_id, $regdate, $next_date);

    $db->query($query);

    return $db->getAffectedRows()>0;

  }

  function add_community_fields($com_info){
    $db = $this->getDBO();
    $user_id = $com_info['user_id'];
    $query = sprintf('INSERT INTO #_community_fields_values
      (user_id,field_id,value
      VALUES (\'%d\',\'%d\',\'%s\'),
      (\'%d\',\'%d\',\'%s\'),
      (\'%d\',\'%d\',\'%s\'),
      (\'%d\',\'%d\',\'%s\'),
      (\'%d\',\'%d\',\'%s\'),
      (\'%d\',\'%d\',\'%s\'),
      (\'%d\',\'%d\,\'%s\')',
      $user_id,'3',$com_info['birth_day'],
      $user_id,'7',$com_info['cell_phone'],
      $user_id,'8',$com_info['day_phone'],
      $user_id,'9',$com_info['addr1'],
      $user_id,'10',$com_info['state'],
      $user_id,'11',$com_info['city'],
      $user_id,'12',$com_info['country']);

    $db->query($query);

    return $db->getAffectedRows()>0;
  }

  function add_jafilia_user($user_info){
    $db = $this->getDBO();

    $query = sprintf('INSERT INTO #_jafilia_user
      (uid, firstname, lastname, zipcode, location, mail, fon, published)
      VALUES(\'%d\'),\'%s\',\'%s\',\'%s\',\'%s\',\'%s\',\'%s\'',
      $user_info['user_id'],$user_info['first_name'],$user_info['last_name'],
      $user_info['zip'],$user_info['location'],$user_info['email'],$user_info['phone'],'1');

    $db->query($query);

    return $db->getAffectedRows()>0;

  }

  function add_autoship($user_id, $autoship){
    $db = $this->getDBO();

    $query = sprintf("INSERT INTO #_mlm_autoship
      (user_id, autoship_date, autoship_status, autoship_cost, state_taxx)
      VALUES('%d','%s','%s','%f','%f')",$user_id, $autoship['date'], $autoship['status'], $autoship['cost'], $autoship['state_tax']);

    $db->query($query);

    return $db->insertid();
  }

  function add_autoship_items($autoship_id, $itemsa, $shopper_group_id){
    
    $db = $this->getDBO();

    foreach($items as $item){
      $query = sprintf("INSERT INTO #_mlm_autoship_item
        (autoship_id, product_id, quantity, shopper_group_id)
        VALUES('%d','%d','%d','%d')",$autoship_id, $item['product_id'], $item['quantity'],$shopper_group_id]);

      $db->query($query);
      $inserted = $db->getAffectedRows();
      if($inserted < 1) return false;

    }

    return true;

  }


  function process_fast_start(){
  
    $db = $this->getDBO();

    $query = sprintf("INSERT INTO #_mlm_user_info
      (user_id, ref_id, amtrex_id, annual_fee_payed_date)
      VALUES('%d','%d','%d','%s')",$user_id, $ref_id, $amtrex_id, $annaul_fee);

    $db->query($query);

    $inserted = $db->getAffectedRows();

    if($inserted<1) return false;

    $query = sprintf("INSERT INTO #_mlm_fast_start
      (user_id, ref_id, vm_order_id, vm_order_amount, vm_order_date)
      VALUES('%d','%d','%d','%f','%s')",$user_id, $ref_id, $vm_order['order_id'], $vm_order['amount'], $vm_order['date'] );

    $db->query($query);

    return $db->getAffectedRows()>0;

  }
 */
}


