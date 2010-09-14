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
  function addUser($user_id, $referee) {
    $pos = $this->_findPosition($referee);
    if ($pos) {
      return $this->_insertNode($user_id, $pos['parent_id'], $pos['position']);
    }
    return false;
  }

  function _findPosition($parent_id) {
    $nodes = array($parent_id);
    while (count($nodes)) {
      $node = array_shift($nodes);
      $children = $this->_getChildren($node);

      $child_count = count($children);
      if ($child_count < 3) {
        return array(
          'parent_id'  => $node,
          'position'   => $child_count
        );
      }
      $nodes = array_merge($nodes, $children);
    }
    return false;
  }

  function _insertNode($user_id, $parent_id, $position) {
    $db = $this->getDBO();
    $query = sprintf('INSERT INTO geneology_tree(user_id, parent_id, position)
      VALUES (%d, %d, %d)',
      $user_id, $parent_id, $position);
    $db->query($query);

    return $db->getAffectedRows() > 0;
  }
  
  function _getChildern($parent_id) {
    $query = sprintf('SELECT *
      FROM geneology_tree
      WHERE parent_id = %d
      ORDER BY position ASC', $parent_id);
    $db->setQuery($query);
    $result = $db->loadObjectList();

    return is_array($result) ? $result : false;
  }
}

