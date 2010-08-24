<?php
/**
* @package System plugin kc_vm_registration_redirect
* @copyright (C) 2009-2010 Keashly.ca Consulting - www.keashly.ca
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* 
* kc_vm_registration_redirect version 1.0.1 for Joomla 1.5.x devloped by Keashly.ca Consulting
* The purpose of this plugin is to redirect any Core Joomla registration attempts to Virtuemart's Registration page
*
*/

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.plugin.plugin' );

/**
 * Core registration redirection to VirtueMart registration plugin
 */
class plgSystemkc_vm_registration_redirect extends JPlugin
{
        /**
         * Constructor
         *
         * For php4 compatability we must not use the __constructor as a constructor for plugins
         * because func_get_args ( void ) returns a copy of all passed arguments NOT references.
         * This causes problems with cross-referencing necessary for the observer design pattern.
         *
         * @access      protected
         * @param       object  $subject The object to observe
         * @param       array   $config  An array that holds the plugin configuration
         * @since       1.0
         */
        function plgSystemkc_vm_registration_redirect( &$subject, $config )
        {
                parent::__construct( $subject, $config );

        }

        /**
         * Check if normal registration link has been used and if so, 
				 * redirect to VirtueMart registration page 
         */
        function onAfterRoute()
        {
					global $mainframe;
					
					$option = JRequest::getCmd('option');
					$task = JRequest::getCmd('task');
					$view = JRequest::getCmd('view');
					// Look for a registration link to Joomla! User manager
					if (($option=='com_user' && $task=='register') || ($option=='com_user' && $view=='register')) {
						$mainframe->redirect("index.php?option=com_virtuemart&page=shop.registration");		  
					}
       }
}
