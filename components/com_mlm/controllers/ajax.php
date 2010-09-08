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
class MlmControllerAjax extends JController
{
  function fieldcheck()
  {
    $view  =& $this->getView('FieldCheck', 'json');

    $user =& $this->getModel('User');
    $view->setModel($user);

    $view->display();
  }

  function productprices()
  {
    $view  =& $this->getView('ProductPrices', 'json');

    $group_name = ucwords(str_replace('_', ' ', JRequest::getVar('group')));

    $virtuemart =& $this->getModel('VirtueMart');
    $group = $virtuemart->getShopperGroupByName($group_name);

    $group_id = $group ? $group->shopper_group_id : 0;
    JRequest::setVar('group_id', $group_id); 

    $user =& $this->getModel('Product');
    $view->setModel($user);

    $view->display();
  }

  function states()
  {
    $view  =& $this->getView('States', 'raw');

    $virtuemart =& $this->getModel('VirtueMart');
    $view->setModel($virtuemart);

    $view->display();
  }

  function statetax()
  {
    $view  =& $this->getView('StateTax', 'json');

    $virtuemart =& $this->getModel('VirtueMart');
    $view->setModel($virtuemart);

    $view->display();
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

