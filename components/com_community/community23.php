<?php
/**
 * @category	Core
 * @package		JomSocial
 * @copyright (C) 2008 by Slashes & Dots Sdn Bhd - All rights reserved!
 * @license http://www.jomsocial.com Copyrighted Commercial Software
 */
defined('_JEXEC') or die('Restricted access');

//JRequest::setVar( 'no_html', 1 ,'REQUEST');

// we detech here whether the user from iphone or normal web.
// if(strstr($_SERVER['HTTP_USER_AGENT'],'iPhone') || strstr($_SERVER['HTTP_USER_AGENT'],'iPod'))
// {
// 	$document =& JFactory::getDocument();
// 	$document->setMetaData( 'viewport', 'width=device-width, initial-scale=1, user-scalable=no' );
// 	
// 	JRequest::setVar('tmpl', 'component');
// 	JRequest::setVar('format', 'iphone');
// 
// }

// During ajax calls, the following constant might not be called
if(!defined('JPATH_COMPONENT'))
{
	define('JPATH_COMPONENT', dirname(__FILE__));
}

require_once ( JPATH_ROOT.DS.'components'.DS.'com_community'.DS.'defines.community.php');

// Require the base controller
require_once (COMMUNITY_COM_PATH.DS.'libraries'.DS.'error.php');
require_once (COMMUNITY_COM_PATH.DS.'controllers'.DS.'controller.php');
require_once (COMMUNITY_COM_PATH.DS.'libraries'.DS.'apps.php' );
require_once (COMMUNITY_COM_PATH.DS.'libraries'.DS.'core.php');
require_once (COMMUNITY_COM_PATH.DS.'libraries'.DS.'template.php');
require_once (COMMUNITY_COM_PATH.DS.'views'.DS.'views.php');
require_once (COMMUNITY_COM_PATH.DS.'helpers'.DS.'url.php');
require_once (COMMUNITY_COM_PATH.DS.'helpers'.DS.'ajax.php');
require_once (COMMUNITY_COM_PATH.DS.'helpers'.DS.'time.php');
require_once (COMMUNITY_COM_PATH.DS.'helpers'.DS.'owner.php');
require_once (COMMUNITY_COM_PATH.DS.'helpers'.DS.'azrul.php');
require_once (COMMUNITY_COM_PATH.DS.'helpers'.DS.'string.php');
jimport('joomla.utilities.date');

//@todo: only load related language file
$view	= JRequest::getCmd('view', 'frontpage');
$task 	= JRequest::getCmd('task', '');
$tmpl	= JRequest::getCmd( 'tmpl' , '' ,'GET' );

// Run scheduled task and exit.
if (JRequest::getCmd('task', '', 'GET') == 'cron')
{
	CFactory::load('libraries', 'cron');

	$cron = new CCron();
	$cron->run();
	exit;
}

$config	= CFactory::getConfig();
if ($config->get('sendemailonpageload'))
{
	CFactory::load('libraries', 'cron');

	$cron = new CCron();
	$cron->sendEmailsOnPageLoad();
}

// If the task is 'azrul_ajax', it would be an ajax call and core file
// should not be processing it.
if($task != 'azrul_ajax')
{
//	$time_start = microtime(true);

	// Trigger system start
	if(function_exists('xdebug_memory_usage')) {
		$mem = xdebug_memory_usage();
		$tm	 = xdebug_time_index();
	}
	
	require_once( JPATH_COMPONENT . DS . 'libraries' . DS . 'apps.php' );
	$appsLib	=& CAppPlugins::getInstance();
	$appsLib->loadApplications();
	
	// Only trigger applications and set active URI when needed
	if( $tmpl != 'component' )
	{
		
		$args = array();
		$appsLib->triggerEvent( 'onSystemStart' , $args );

		// Set active URI
		CFactory::setCurrentURI();
	}

	// Normal call
	// Component configuration
	$config = array('name'=>JString::strtolower(JRequest::getCmd('view', 'frontpage')));

	// Create the controller
	$viewController = JString::strtolower($config['name']);
	if( JFile::exists( JPATH_COMPONENT.DS.'controllers'.DS.$viewController.'.php' ) )
	{
		// If the controller is one of our controller, include the file
		// If not, it could be other 3rd party controller. Do not throw error message yet
		require_once (JPATH_COMPONENT.DS.'controllers'.DS.$viewController.'.php');	
	}
	
	$viewController = JString::ucfirst($viewController);
	$viewController = 'Community'.$viewController.'Controller';
	
	
	// Trigger onBeforeControllerCreate (pass controller name by reference to allow override)
	$args 	= array();
	$args[]	= &$viewController;

	$results = $appsLib->triggerEvent( 'onBeforeControllerCreate' , $args );
	
	// make sure none of the $result is false
	// If true, then one of the plugin is trying to override the controller creation
	// since we could only create 1 controller, we will pick the very first one only
	// plugin trigger function will return true if plugin want to intercept it
	if(!empty($results) && ( in_array(true, $results) ) ) 
	{
		// 3rd party override used
		// @todo: use Reflection API to ensure that the class actually implement
		// our controller interface to avoid error
	} 
	
	if( !class_exists($viewController) )
	{
		JError::raiseError(500, 'Controller '. $viewController . ' not found!');
	}
	
	$controller = new $viewController($config);

	// Perform the Request task
	$controller->execute(JRequest::getCmd('task', ''));

	// Redirect if set by the controller
	// $controller->redirect();
	if(function_exists('xdebug_memory_usage')) {
		$memNow = xdebug_memory_usage();
		echo '<div style="clear:both">&nbsp;</div>';
		echo '<br/>Start usage:' . $mem . '<br/>';
		echo 'End usage:' . $memNow . '<br/>';
		echo 'Mem usage:' . ($memNow - $mem) . '<br/>';
		echo 'Peak mem:' . xdebug_peak_memory_usage(). '<br/>';
		echo 'Time: '. (xdebug_time_index() - $tm) ;
	}
	echo getJomSocialPoweredByLink();
	
	
//	 getTriggerCount
//	$appLib = CAppPlugins::getInstance();
//	echo 'Trigger count: '. $appLib->triggerCount . '<br/>';
//	$time_end = microtime(true);
//	$time = $time_end - $time_start;
//	echo $time;
}


/**
 * Entry poitn for all ajax call
 */
function communityAjaxEntry($func, $args = null)
{
	// For AJAX calls, we need to load the language file manually.
	$lang =& JFactory::getLanguage();
	$lang->load( 'com_community' );
	
	$response = new JAXResponse();
	$output = '';
	
	require_once( JPATH_COMPONENT . DS . 'libraries' . DS . 'apps.php' );
	$appsLib	=& CAppPlugins::getInstance();
	$appsLib->loadApplications();
	$triggerArgs = array();
	$triggerArgs[] = $func;
 	$triggerArgs[] = $args;
	$triggerArgs[] = $response;
	
	$results = $appsLib->triggerEvent( 'onAjaxCall' , $triggerArgs );
	if( in_array( false, $results ) )
	{
		$output		= $response->sendResponse();
	} 
	else 
	{
	
		$calls		= explode( ',' , $func );
	
		if(is_array($calls) && $calls[0] == 'plugins')
		{
			// Plugins ajax calls go here
			$func		= $_REQUEST['func'];
	
			// Load CAppPlugins
			if(!class_exists('CAppPlugins'))
			{
				require_once( JPATH_COMPONENT . DS . 'libraries' . DS . 'apps.php');
			}
	
			$apps		=& CAppPlugins::getInstance();
			$plugin  	=& $apps->get($calls[1]);
			$method		= $calls[2];
	
			// Move the $response object to be the first in the array so that the plugin knows
			// the first argument is always the JAXResponse object
			array_unshift($args, $response);
	
			// Call plugin AJAX method. Caller method's should only return the JAXResponse object.
			$response	= call_user_func_array( array($plugin, $method) , $args);

			$output		= $response->sendResponse();
		}
		else
		{
			// Built-in ajax calls go here
			$config		= array();
			$func		= $_REQUEST['func'];
			$callArray	= explode(',', $func);
			$viewController = JString::strtolower($callArray[0]);
	
			if(($viewController == 'videos' || $viewController == 'photos' || $viewController == 'groups' ) && COMMUNITY_FREE_VERSION ) 
			{				
				$tmpl	= new CTemplate();
				$output	= $tmpl->fetch( 'freeversion.ajax' );
				$response->addAssign('cWindowContent', 'innerHTML', $output );
				$response->addScriptCall('cWindowResize' , 500 );
				return $response->sendResponse();
			}
			
			require_once( JPATH_ROOT . DS . 'components' . DS . 'com_community' . DS . 'controllers' . DS . $viewController . '.php' );
			$viewController = JString::ucfirst($viewController);
			$viewController	= 'Community'.$viewController.'Controller';
			$controller		 = new $viewController($config);
	
			// Perform the Request task
			$output = call_user_func_array(array(&$controller, $callArray[1]), $args);
		}
	}
	return $output;
}


