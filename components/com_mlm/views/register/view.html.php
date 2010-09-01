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
class MlmViewRegister extends JView {
  function display($tpl = null) {
    /*
     * Check who the referrer is.
     */
    $referee = JRequest::getInt('cook_jaffiliate', 0, 'COOKIE');
    $referee = $referee ? JFactory::getUser($referee) : false;

    $language =& JFactory::getLanguage();
    $language->load('com_mlm');

    parent::display($tpl);
  }
}
