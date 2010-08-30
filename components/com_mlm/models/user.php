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
  /**
   * User id
   *
   * @var int
   */
  var $_id = null;

  /**
   * User data
   *
   * @var array
   */
  var $_data = null;

  /**
   * Constructor
   *
   * @since 1.5
   */
  function __construct()
  {
    parent::__construct();

    $id = JRequest::getVar('id', 0, '', 'int');
    $this->setId($id);
  }

  /**
   * Method to set the weblink identifier
   *
   * @access  public
   * @param int Weblink identifier
   */
  function setId($id)
  {
    // Set weblink id and wipe data
    $this->_id    = $id;
    $this->_data  = null;
  }

  /**
   * Method to get a user
   *
   * @since 1.5
   */
  function getData()
  {
    // Load the weblink data
    $this->_loadData();
    return $this->_data;
  }

  /**
   * Method to store the user data
   *
   * @access  public
   * @return  boolean True on success
   * @since 1.5
   */
  function store($data)
  {
    $user   = JFactory::getUser();

    // Bind the form fields to the user table
    if (!$user->bind($data)) {
      $this->setError($this->_db->getErrorMsg());
      return false;
    }

    // Store the web link table to the database
    if (!$user->save()) {
      $this->setError($user->getError());
      return false;
    }

    $session =& JFactory::getSession();
    $session->set('user', $user);

    return true;
  }

}

