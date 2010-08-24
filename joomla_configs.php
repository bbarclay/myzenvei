<?php
#####################################################################
// load everything which joomla need 

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
?>