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
}

