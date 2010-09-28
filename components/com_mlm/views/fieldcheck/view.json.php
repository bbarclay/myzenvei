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
    $data = JRequest::getVar('user', false);
    $res = false;

    if ($data and isset($data[$type])) {
      $data = $data[$type];

      $method = 'check_'.$type;
      $res = method_exists($user, $method) ? call_user_func(array($user, $method), $data) : false;

      switch ($res) {
      case 'invalid':
        $res = sprintf('The %s `%s` contains invalid characters. Only alphanumeric characters are allowed.', ucwords(str_replace('_', ' ', $type)), $data);
        break;
      case 'reserved':
        $res = sprintf('The %s `%s` is reserved.', ucwords(str_replace('_', ' ', $type)), $data);
        break;
      case 'taken':
        $res = sprintf('The %s `%s` is in use.', ucwords(str_replace('_', ' ', $type)), $data);
        break;
      case 'available':
        $res = true;
        break;
      default:
        $res = false;
      }
    }

    $this->assignRef('result', $res);
    parent::display($tpl);
  }

}

