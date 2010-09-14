<?php
/**
 * Joomla! 1.5 component mlm
 *
 * @version $Id: view.html.php 2010-08-27 14:49:16 svn $
 * @author Abdul Basit
 * @package Joomla
 * @subpackage mlm
 * @license GNU/GPL
 *
 * Package for Multi-Level-Marketing. Functionality contains: Client Signup, Building Referral Tree
 *
 * This component file was created using the Joomla Component Creator by Not Web Design
 * http://www.notwebdesign.com/joomla_component_creator/
 *
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

jimport( 'joomla.application.component.view');

/**
 * HTML Register View class for the mlm component
 */
class MlmViewProductPrices extends JView {
  function display($tpl = null) {
    $product = $this->getModel('Product');
    $prices = $product->getProductsByShopperGroup(JRequest::getVar('group_id'));

    $obj = array();
    foreach ($prices as $price) {
      $obj[] = array(
        'sku'       => $price->product_sku,
        'text_val'  => $this->getCurrencySymbol($price->product_currency).sprintf('%.2f', $price->product_price),
        'value'     => sprintf('%.2f', $price->product_price),
      );
    }

    $this->assignRef('obj', $obj);

    parent::display($tpl);
  }

  function getCurrencySymbol($currency_code)
  {
    switch ($currency_code) {
    case 'USD':
      return '&#36;';
    default:
      return $currency_code;
    }
  }

}

