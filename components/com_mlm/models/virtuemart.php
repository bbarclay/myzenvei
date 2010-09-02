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

  function getTaxRate($state, $country)
  {
    $db = $this->getDBO();

    $query = sprintf('SELECT tax_rate
      FROM #__vm_tax_rate
      WHERE tax_state = \'%s\' AND tax_country = \'%s\'',
      $state, $country);

    $db->setQuery($query);

    $tax_rate = $db->loadResult();
    return $tax_rate ? $tax_rate : false;
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

}

