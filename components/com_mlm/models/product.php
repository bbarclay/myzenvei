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
 * mlm Component Product Model
 *
 * @author      Abdul Basit
 * @package		  Joomla
 * @subpackage	mlm
 * @since       1.5
 */
class MlmModelProduct extends JModel
{
  function getAllProducts()
  {
    $db = $this->getDBO();

    $query = 'SELECT p.*, pp.*
      FROM #__vm_product p 
      INNER JOIN #__vm_product_price pp ON p.product_id = pp.product_id
      INNER JOIN #__vm_shopper_group g ON g.shopper_group_id = pp.shopper_group_id
      WHERE p.product_publish = \'Y\' 
      AND g.default = 1';
    $db->setQuery($query);

    $products = $db->loadObjectList();
    return is_array($products) ? $products : false;
  }

  function getProductPrices($group_id)
  {
    $db = $this->getDBO();

    $query = sprintf('SELECT p.product_sku, IF (gp.product_price, gp.product_price, pp.product_price) AS product_price, IF (gp.product_currency, gp.product_currency, pp.product_currency) AS product_currency
      FROM #__vm_product p
      LEFT JOIN #__vm_product_price gp ON p.product_id = gp.product_id AND gp.shopper_group_id = %d
      INNER JOIN #__vm_product_price pp ON p.product_id = pp.product_id
      INNER JOIN #__vm_shopper_group g ON g.shopper_group_id = pp.shopper_group_id AND g.default = 1
      WHERE p.product_publish = \'Y\'', $group_id);
    $db->setQuery($query);

    $products = $db->loadObjectList();
    return is_array($products) ? $products : false;
  }

  function getProductImage($filename, $type)
  {
    switch ($type) {
    case 'full':
      return JURI::base().'components/com_virtuemart/shop_image/product/'.$filename;
    default: 
      return false;
    }
  }

}

