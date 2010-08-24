<?php
/**
 * @version		$Id: controller.php 36 2009-05-19 01:06:55Z eddieajau $
 * @copyright	Copyright (C) 2007 - 2009 JXtended, LLC. All rights reserved.
 * @license		GNU General Public License
 */

defined('_JEXEC') or die;

jimport('joomla.application.component.controller');

/**
 * Base controller class for Finder.
 *
 * @package		JXtended.Libraries
 * @subpackage	Application.Component
 * @version		1.0.9
 */
class JxController extends JController
{
	/**
	 * Method to get the appropriate controller.
	 *
	 * @access	public
	 * @param	string	The context
	 * @return	object	Finder Controller
	 */
	function &getInstance($context)
	{
		static $instance;

		if (!empty($instance)) {
			return $instance;
		}

		if (!file_exists(JPATH_COMPONENT.DS.'controller.php')) {
			JError::raiseError(500, 'controller.php not found');
		}
		require_once JPATH_COMPONENT.DS.'controller.php';

		$cmd = JRequest::getVar('task', 'display');
		if (is_array($cmd)) {
			$cmd = JFilterInput::clean(array_pop(array_keys($cmd)), 'cmd');
		}

		// Check for a controller.task command.
		if (strpos($cmd, '.') != false)
		{
			// Explode the controller.task command.
			list($type, $task) = explode('.', $cmd);

			// Define the controller name and path
			$protocol	= JRequest::getWord('protocol');
			$type		= strtolower($type);
			$file		= (!empty($protocol)) ? $type.'.'.$protocol.'.php' : $type.'.php';
			$path		= JPath::clean(JPATH_COMPONENT.DS.'controllers'.DS.$file);

			// If the controller file path exists, include it ... else lets die with a 500 error
			if (file_exists($path)) {
				require_once($path);
			}
			else {
				JError::raiseError(500, JText::sprintf( 'JX_INVALID_CONTROLLER', $type ) );
			}

			JRequest::setVar('task', $task);
		}
		else
		{
			// Base controller, just set the task :)
			$type = null;
			$task = $cmd;
		}

		// Set the name for the controller and instantiate it
		$class = ucfirst($context).'Controller'.ucfirst($type);
		if (class_exists($class)) {
			$instance = new $class();
		} else {
			JError::raiseError(500, JText::sprintf( 'JX_INVALID_CONTROLLER_CLASS', $class ) );
		}

		return $instance;
	}
}