<?php

/**

* @version		$Id: index.php 11407 2009-01-09 17:23:42Z willebil $

* @package		Joomla

* @copyright	Copyright (C) 2005 - 2009 Open Source Matters. All rights reserved.

* @license		GNU/GPL, see LICENSE.php

* Joomla! is free software. This version may have been modified pursuant

* to the GNU General Public License, and as distributed it includes or

* is derivative of works licensed under the GNU General Public License or

* other free or open source software licenses.

* See COPYRIGHT.php for copyright notices and details.

*/



// Set flag that this is a parent file

define( '_JEXEC', 1 );



define('JPATH_BASE', dirname(__FILE__) );



define( 'DS', DIRECTORY_SEPARATOR );



require_once ( JPATH_BASE .DS.'includes'.DS.'defines.php' );

require_once ( JPATH_BASE .DS.'includes'.DS.'framework.php' );



JDEBUG ? $_PROFILER->mark( 'afterLoad' ) : null;



/**

 * CREATE THE APPLICATION

 *

 * NOTE :

 */

$mainframe =& JFactory::getApplication('site');



/**

 * INITIALISE THE APPLICATION

 *

 * NOTE :

 */

// set the language

$mainframe->initialise();



JPluginHelper::importPlugin('system');



// trigger the onAfterInitialise events

JDEBUG ? $_PROFILER->mark('afterInitialise') : null;

$mainframe->triggerEvent('onAfterInitialise');



/**

 * ROUTE THE APPLICATION

 *

 * NOTE :

 */

$mainframe->route();



// authorization

$Itemid = JRequest::getInt( 'Itemid');

$mainframe->authorize($Itemid);



// trigger the onAfterRoute events

JDEBUG ? $_PROFILER->mark('afterRoute') : null;

$mainframe->triggerEvent('onAfterRoute');



function jsUsernameCheck($name)
{
	$db	=& JFactory::getDBO();
	$sql = "SELECT `userid`,`username` FROM #__jsusernames WHERE `username`=" . $db->Quote($name);
	$db->setQuery($sql);
	$id = $db->loadResult();
	return $id;
}

	$sub = $_SERVER['HTTP_HOST'];
	$server_querystring = $_SERVER['QUERY_STRING']; 
	$tmp = explode('.', $sub);
	
	
	if($tmp[0] != 'www')
	{
		header("Location: http://www.$tmp[0].myzenvei.com/index.php?$server_querystring");
		exit();
	}  
	else
	{
		
		$subdomain = trim($tmp[1]);
		$id = jsUsernameCheck($subdomain);
		
		if(!empty($id))
		{
			
			header("Location: http://www.myzenvei.com/index.php?option=com_community&userid=$id&view=profile&affiliate=$id&Itemid=15");
			
			exit();
		}
	
	}
  

	if($_GET['option'] == 'com_community' And $_GET['view'] == 'register')
	{
	 
	   header("Location: index.php?option=com_jumi&fileid=8&Itemid=34&affiliate=$id");
	   exit();
	}
 	
	
	 
				
/**

 * DISPATCH THE APPLICATION

 *

 * NOTE :

 */

$option = JRequest::getCmd('option');

$mainframe->dispatch($option);



// trigger the onAfterDispatch events

JDEBUG ? $_PROFILER->mark('afterDispatch') : null;

$mainframe->triggerEvent('onAfterDispatch');



/**

 * RENDER  THE APPLICATION

 *

 * NOTE :

 */

$mainframe->render();



// trigger the onAfterRender events

JDEBUG ? $_PROFILER->mark('afterRender') : null;

$mainframe->triggerEvent('onAfterRender');



/**

 * RETURN THE RESPONSE

 */

echo JResponse::toString($mainframe->getCfg('gzip'));

