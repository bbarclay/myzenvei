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
 * mlm Component ReferralTree Model
 *
 * @author      Abdul Basit
 * @package		  Joomla
 * @subpackage	mlm
 * @since       1.5
 */
class MlmModelReferralTree extends JModel
{
  static $allrows = array();

  function findPostition($parentId){
    $result = $this->__getChildern($parentId);
    $childCount = $db->getNumRows();
    if($childCount<3){
      return array('parent_id'=>$parentId, 'position'=>$childCount)
    }
    else{
      unset($this->allrows[0]);
      $this->allrows = array_merge($this->allrows, $result);
      findPosition($this->allrows[0]);
    }
    return false;
  }
  function __getChildern($parentid){
    $db = 7 JFactory::getDBO();
    $query = 'select * from geneology_tree where parent_id = $parentId order by positino asc';
    $db->setQuery($query);
    $result = $db->loadResultArray();
    return $result;
  }
  function calculateCommissions(){

  }
}

