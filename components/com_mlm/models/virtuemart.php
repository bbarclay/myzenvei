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
 * mlm Component Virtuemart Model
 *
 * @author      Abdul Basit
 * @package		  Joomla
 * @subpackage	mlm
 * @since       1.5
 */
class MlmModelVirtueMart extends JModel
{

  function getShippingCarriers()
  {
    $db = $this->getDBO();

    $query = 'SELECT *
      FROM #__vm_shipping_carrier';

    $db->setQuery($query);

    $carrier = $db->loadObjectList();
    return is_array($carrier) ? $carrier : false;
  }

  function getRegistrationFee($shopper_group_id) {
    $db = $this->getDBO();

    $query = sprintf('SELECT regfee
      FROM #__mlm_regfee
      WHERE shopper_group_id = %d',
      $shoppergroup_id);

    $db->setQuery($query);

    $reg_fee = $db->loadResult();
    return $reg_fee ? $reg_fee : false;
  }

  function getTaxRate($state, $country)
  {
    $db = $this->getDBO();

    $query = sprintf('SELECT tax_rate
      FROM #__vm_tax_rate
      WHERE tax_state = \'%s\' AND tax_country = \'%s\'',
      $state, $country);

    $db->setQuery($query);

    $tax_rate = $db->loadResult();
    return $tax_rate ? $tax_rate : 0.00;
  }

  function getCountries()
  {
    $db = $this->getDBO();

    $query = 'SELECT *
      FROM #__vm_country';
    $db->setQuery($query);

    $countries = $db->loadObjectList();
    return is_array($countries) ? $countries : false;
  }

  function getStates($country)
  {
    $db = $this->getDBO();

    $query = sprintf('SELECT *
      FROM #__vm_state S
      JOIN #__vm_country C ON S.country_id = C.country_id
      WHERE C.country_3_code = \'%s\'', $country);
    $db->setQuery($query);

    $states = $db->loadObjectList();
    return is_array($states) ? $states : false;
  }

  function getShopperGroups()
  {
    $db = $this->getDBO();

    $query = 'SELECT *
      FROM #__vm_shopper_group G';
    $db->setQuery($query);

    $groups = $db->loadObjectList();
    return is_array($groups) ? $groups : false;
  }

  function getShopperGroupByName($group_name)
  {
    $db = $this->getDBO();

    $query = sprintf('SELECT *
      FROM #__vm_shopper_group G
      WHERE shopper_group_name = \'%s\'', $group_name);
    $db->setQuery($query);

    $groups = $db->loadObject();
    return $groups ? $groups : false;
  }

  function addUser($user, $coapplicant, $business, $shipping, $card, $autoship)
  {
    $db = $this->getDBO();

    $user_info_id = md5($user['id']);
    $addr_type = 'BT';
    $addr_type_name = 'BT Address';
    $vendor_id = 1;

    $query = sprintf("INSERT INTO jos_vm_user_info
      (user_info_id, user_id, address_type, address_type_name, company,
      last_name, first_name, phone_1, phone_2, fax, address_1, address_2,
      city, state, country, zip, user_email, vm_coapplicant_firtsname ,
      vm_coapplicant_lastname, vm_coapplicant_birthday, vm_card_type,
      vm_name_on_card, vm_card_number, vm_card_expirydate, vm_csv_digits,
      vm_ssn_number, vm_autoship_date)
      VALUES ('%s', %d, '%s', '%s', '%s',
        '%s', '%s','%s', '%s','%s','%s', '%s',
        '%s', '%s', '%s', '%s', '%s', '%s',
        '%s', '%s', '%s',
        '%s', '%s', '%s', '%s',
        '%s', '%s')",
        $user_info_id, $user['id'], $addr_type, $addr_type_name, $business['name'],
        $user['last_name'], $user['first_name'], $user['day_phone'], $user['evening_phone'], $user['fax_number'], $shipping['addr_1'], $shipping['addr_2'],
        $shipping['city'], $shipping['state'], $shipping['country'], $shipping['zip'], $user['email'], $coapplicant['fname'],
        $coapplicant['lname'], $coapplicant['birthday'], $card['type'],
        $card['name'], $card['number'], $card['expire_date'], $card['csv'],
        $user['ssn'], $autoship['date']);
    
    $db->query($query);

    $query = sprintf("INSERT INTO jos_vm_shopper_vendor_xrefx (user_id, vendor_id, shopper_group_id) 
      VALUES(%d , %d, %d)",
        $user['id'], $vendor_id, $user['shopper_group_id']);
    $db->query($query);
  }
}

