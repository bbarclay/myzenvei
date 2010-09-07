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
  function findPostition($parentId){
    $allrows = array();
    $allrows = $this->__getChildern($parentId);
    $childCount = count($allrows);
    while(count($allrows)!=0){
      if($childCount<3){
        return array('parent_id'=>$parentId, 'position'=>$childCount)
      }
      else{
        unset($allrows[0]);
        $result = $this->__getChildern($allrows[0]);
        $childCount = count($result);
        $allrows = array_merge($allrows, $result);
      }
    }
    return false;
  }
  function insertInTree($userId, $parentId, $position){
    $db = & JFactory::getDBO();
    $query = 'insert into geneology_tree values($userId, $parentId, $position)';
    $db->Execute($query);
  }
  function __getChildern($parentId){
    $db = & JFactory::getDBO();
    $query = 'select * from geneology_tree where parent_id = $parentId order by positino asc';
    $db->setQuery($query);
    $result = $db->loadResultArray();
    return $result;
  }
  function calculateCommissions(){

  }
}

