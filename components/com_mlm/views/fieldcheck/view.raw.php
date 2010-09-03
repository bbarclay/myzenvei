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
class MlmViewFieldCheck extends JView {
  function display($tpl = null) {
    $user = $this->getModel('User');

    $type = JRequest::getVar('field');
    switch ($type) {
    case 'username':
      $res = $user->username_available(JRequest::getVar('value'));
      break;
    case 'email':
      $res = $user->email_available(JRequest::getVar('value'));
      break;
    case 'replicated_site':
      $res = $user->replicated_site_available(JRequest::getVar('value'));
      break;
    default:
      break;
    }

    $type = ucwords(str_replace('_', ' ', $type));
    $this->assignRef('status', $res);
    $this->assignRef('field', $type);
    parent::display($tpl);
  }

}

