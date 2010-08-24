<?php
error_reporting(E_ALL);
defined( '_JEXEC' ) or die( '=;)' );
require_once( JPATH_COMPONENT.DS.'controller.php' );
if( $controller = JRequest::getWord('controller')) {
	$path = JPATH_COMPONENT.DS.'controllers'.DS.$controller.'.php';
	if( file_exists($path))	{
		require_once $path;
	}
	else {
		$controller = '';
	}
}
	/* Add stylesheets */
	$document = JFactory::getDocument();
	$document->addStyleSheet($mainframe->getSiteURL().'administrator/components/com_jafilia/css/images.css');
	$document->addStyleSheet($mainframe->getSiteURL().'administrator/components/com_jafilia/css/display.css');
	$document->addStyleSheet($mainframe->getSiteURL().'administrator/components/com_jafilia/css/tables.css');

$classname = 'JafiliaController'.$controller;
$controller = new $classname( );
$controller->execute( JRequest::getVar('task') );
$controller->redirect();
