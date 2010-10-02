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
    $db = $this->getDBO();

    $query = sprintf("INSERT INTO #__jsusernames (userid, username)
      VALUES (%d, '%s')", $user['id'], $user['replicated_site']);
    $db->query($query);

    return $db->getAffectedRows() > 0;
  }

  function addCommunityInfo($user, $shipping) {
    $db = $this->getDBO();

    $query = sprintf("INSERT INTO #__community_fields_values
      (user_id, field_id, value)
      VALUES (%d, %d, '%s'),
      (%d, %d, '%s'),
      (%d, %d, '%s'),
      (%d, %d, '%s'),
      (%d, %d, '%s'),
      (%d, %d, '%s'),
      (%d, %d, '%s')",
      $user['id'], 3, $user['birthday'],
      $user['id'], 7, $user['cell_phone'],
      $user['id'], 8, $user['day_phone'],
      $user['id'], 9, trim($shipping['addr_1']."\n".$shipping['addr_2']),
      $user['id'], 10, $shipping['state'],
      $user['id'], 11, $shipping['city'],
      $user['id'], 12, $shipping['country']);

    $db->query($query);

    return $db->getAffectedRows() > 0;
  }

  function addJafiliaInfo($user, $shipping) {
    $db = $this->getDBO();

    $query = sprintf("INSEkRT INTO #__jafilia_user
      (uid, firstname, lastname, zipcode, location, mail, fon, published)
      VALUES(%d, '%s', '%s', '%s', '%s', '%s', %d",
      $user['id'], $user['first_name'], $user['last_name'], $shipping['zip'], $shipping['country'], $user['email'], $user['day_phone'], 1);

    $db->query($query);

    return $db->getAffectedRows() > 0;
  }

  function addRegistrationInfo($user) {
    $db = $this->getDBO();


    if ($user['shopper_group_id'] == 8 or $user['shopper_group_id'] == 9) {
      $fee = '39.00';
    } else {
      $fee = '0.00';
    }

    $regdate = time();
    $next_date = $regdate + 30*86400; // One month later

    $regdate = date('Y-m-d', $regdate);
    $next_date = date('Y-m-d', $next_date);

    $query = sprintf("INSERT INTO #__fixed_reg_fee
      (regfee, userid, regdate, nextpaymentdate)
      VALUES(%f, %d, '%s', '%s')",
        $fee, $user['id'], $regdate, $next_date);

    $db->query($query);

    return $db->getAffectedRows() > 0;
  }

}


