<?php
defined('_JEXEC') or die('Restricted access');

JTable::addIncludePath( JPATH_ROOT.DS.'administrator'.DS.'components'.DS.'com_jsusernames'.DS.'tables');

require_once(JPATH_ROOT.DS.'administrator'.DS.'components'.DS.'com_jsusernames'.DS.'controllers'.DS.'controller.php');
require_once(JPATH_ROOT.DS.'components'.DS.'com_community'.DS.'libraries'.DS.'core.php');

// Require specific controller if requested
$controller = JRequest::getWord('c' , 'JSUsernames');
if($controller)
{
	$path = JPATH_COMPONENT.DS.'controllers'.DS.$controller.'.php';
	if (file_exists($path))
	{
		require_once $path;
	}
	else
	{
		$controller = 'JSUsernames';
	}
}

$obj	= $controller . 'Controller';
$controller = new $obj( );

// Perform the Request task
$controller->execute( JRequest::getWord('task'));
$controller->redirect();