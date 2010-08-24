<?php 
//ini_set('memory_limit', '16M');
//		include('../joomla_configs.php');
//		include('../index.php');
//define( '_JEXEC', 1 );

/* Initialize Joomla framework */
define( '_JEXEC', 1 );
define('JPATH_BASE', dirname(__FILE__) );
define( 'DS', DIRECTORY_SEPARATOR );


//include('../configuration.php');


//require_once ( JPATH_BASE .DS.'../includes'.DS.'defines.php' );

//Joomla framework path definitions
$parts = explode( DS, JPATH_BASE );
array_pop( $parts );

define( 'JPATH_ROOT',			implode( DS, $parts ) );
define( 'JPATH_SITE',			JPATH_ROOT );
define( 'JPATH_CONFIGURATION',	JPATH_ROOT );
define( 'JPATH_INSTALLATION',	JPATH_ROOT . DS . 'installation' );
define( 'JPATH_ADMINISTRATOR',	JPATH_ROOT . DS . 'administrator' );
define( 'JPATH_XMLRPC', 		JPATH_ROOT . DS . 'xmlrpc' );
define( 'JPATH_LIBRARIES',		JPATH_ROOT . DS . 'libraries' );
define( 'JPATH_PLUGINS',		JPATH_ROOT . DS . 'plugins'   );
define( 'JPATH_CACHE',			JPATH_BASE . DS . 'cache');
define( 'JPATH_INCLUDES',		JPATH_ROOT . DS . 'includes');

require_once ( JPATH_BASE .DS.'../includes'.DS.'framework.php' );

require_once ( JPATH_BASE .DS.'../includes'.DS.'framework.php' );

if (! class_exists('JLoader')) {
//    require_once( dirname(__FILE__)  .'/../libraries/loader.php' );
}

    require_once( dirname(__FILE__)  .'/../libraries/joomla/import.php' );
    require_once( dirname(__FILE__)  .'/../plugins/system/legacy/mainframe.php' );

//	JLoader::register('JApplication' , JPATH_LIBRARIES.DS.'joomla'.DS.'application'.DS.'application.php');

/* Required Files */
require_once ( JPATH_INCLUDES .DS.'defines.php' );
require_once ( JPATH_INCLUDES .DS.'framework.php' );
/* To use Joomla's Database Class */
require_once ( JPATH_LIBRARIES .DS.'joomla'.DS.'factory.php' );
/* Create the Application */
$mainframe =& JFactory::getApplication('site');
$userInfo = $mainframe->getUser();
echo $CustomUid = $userInfo->id; 
if(!$CustomUid)
{
	header("Location: http://www.myzenvei.com/index.php?option=com_community&view=frontpage&itemid=15");
	exit;
}
?>