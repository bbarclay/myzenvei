<?php 
defined('_JEXEC') or die('Restricted access');
define('JPATH_BASE', dirname(__FILE__) );
define( 'DS', DIRECTORY_SEPARATOR );
require_once ( JPATH_BASE .DS.'includes'.DS.'framework.php' );

require_once ( JPATH_BASE .DS.'includes'.DS.'framework.php' );
/* To use Joomla's Database Class */
require_once ( JPATH_LIBRARIES .DS.'joomla'.DS.'factory.php' );
$mainframe =& JFactory::getApplication('site');
$userInfo = $mainframe->getUser();
echo $CustomUid = $userInfo->id; 
$_SESSION['$CustomUid'] = $CustomUid;

?>