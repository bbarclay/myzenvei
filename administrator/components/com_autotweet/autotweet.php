<?php
/**
 * @version 1.0
 * @license    GNU/GPL
 */

// No direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

// Require the base controller
require_once( JPATH_COMPONENT_ADMINISTRATOR . DS . 'controller.php' );

// Create the controller
$controller	= new AutotweetController( );

// Perform the Request task
$controller->execute( JRequest::getVar( 'task' ) );

// Redirect if set by the controller
$controller->redirect();