<?php
/**
 * @version	1.5
 * @package	Amigos
 * @author 	Dioscouri Design
 * @link 	http://www.dioscouri.com
 * @copyright Copyright (C) 2007 Dioscouri Design. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
*/

/** ensure this file is being included by a parent file */
defined('_JEXEC') or die('Restricted access');

/** Import library dependencies */
jimport('joomla.event.plugin');

/**
 * Amigos Plugin
 *
 * @package		Joomla
 * @subpackage	JFramework
 * @since 		1.5
 */

class plgUserAmigos extends JPlugin 
{
	/**
	 * Constructor
	 *
	 * For php4 compatability we must not use the __constructor as a constructor for plugins
	 * because func_get_args ( void ) returns a copy of all passed arguments NOT references.
	 * This causes problems with cross-referencing necessary for the observer design pattern.
	 *
	 * @param object $subject The object to observe
	 * @param 	array  $config  An array that holds the plugin configuration
	 * @since 1.5
	 */
	function plgUserAmigos(& $subject, $config)
	{
		parent::__construct($subject, $config);
	}

	/**
	 * 
	 * @return unknown_type
	 */
	function _isInstalled()
	{
		$success = false;
		
		jimport('joomla.filesystem.file');
		if (JFile::exists(JPATH_ADMINISTRATOR.DS.'components'.DS.'com_amigos'.DS.'helpers'.DS.'_base.php')) 
		{
			JLoader::import( 'com_amigos.defines', JPATH_ADMINISTRATOR.DS.'components' );
			JLoader::import( 'com_amigos.helpers.user', JPATH_ADMINISTRATOR.DS.'components' );
			$success = true;
		}
				
		return $success;
	}

	/**
	 * This method should handle any login logic and report back to the subject
	 *
	 * @access	public
	 * @param 	array 	holds the user data
	 * @param 	array    extra options
	 * @return	boolean	True on success
	 * @since	1.5
	 */
	function onLoginUser( $user, &$options ) 
	{
		$success = null;
		if (!$this->_isInstalled()) 
		{
			return $success;
		}
		
		$app = JFactory::getApplication();
		if ( $app->isAdmin() ) 
		{
			return $success;
		}
		
		// assign the userid to user['id'] (onLogin doesn't populate this field in the array)
		jimport('joomla.user.helper'); 
		$user['id'] = intval( JUserHelper::getUserId($user['username']) );
				
		$run = $this->updateLogs( $user['id'] );
		
		return $success;
	}
	
	/**
	 * This function updates the Amigos Logs so that the 
	 * sessionid previously unassociated with a userid is now
	 * associated with a userid
	 *  
	 * @param $userid
	 * @return unknown_type
	 */
	function updateLogs($userid)
	{
		$success = null;
		JTable::addIncludePath( JPATH_ADMINISTRATOR.DS.'components'.DS.'com_amigos'.DS.'tables' );
		
		// get the sessionid from the session table
		$session = JFactory::getSession();
		$sessionid = $session->getId();
		
		// if that session exists in the amigos log WITHOUT an existing userid
		$logBySession = JTable::getInstance('Logs', 'Table');
		$logBySession->load( $sessionid, 'sessionid' );
		
		// AND if there is NOT an existing log entry for this userid
		$logByUser = JTable::getInstance('Logs', 'Table');
		$logByUser->load( $userid, 'userid' );
		
		if (!empty($logBySession->userid))
		{
			// log already has a userid associated with it
			// kill the cookie if it exists
			setcookie( 'amigosid', '', time()-42000, '/');
			return $success;
		}
		
		if ( !empty($logByUser->id) && $logBySession->id == $logByUser->id )
		{
			// user already has been associated
			// kill the cookie if it exists
			setcookie( 'amigosid', '', time()-42000, '/');
			return $success;
		}
		
		// if the referral created a new session & log entry, but once logged in we find that they are already associated
		// should we delete the log entry? (i.e. make the logs 1:1 for unique referrals?)
		if ( !empty($logByUser->id) && $logBySession->id != $logByUser->id )
		{
			$config = AmigosConfig::getInstance();
			if ($config->get('enforce_unique_logs', '0'))
			{
				$logBySession->delete();	
			}
			return $success;
		}		
		
		// then associate that log entry with this userid
		if (!empty($logBySession->id))
		{
			$logBySession->sessionid = "";
			$logBySession->userid = $userid;
			if (!$logBySession->store())
			{
				JError::raiseNotice("AmigosUserPlugin01", JText::_("AmigosUserPlugin01")."::".$logBySession->getError() );	
			}
				else
			{
				// kill the cookie if it exists
				setcookie( 'amigosid', '', time()-42000, '/');
			}			
		}
		
		return $success;
	}
}
