<?php
/**
 * @version		$Id: config.php 67 2009-05-29 13:02:32Z eddieajau $
 * @copyright	Copyright (C) 2009 New Life in IT Pty Ltd. All rights reserved.
 * @license		GNU General Public License <http://www.gnu.org/copyleft/gpl.html>
 * @link		http://www.theartofjoomla.com
 */

// no direct access
defined('_JEXEC') or die();

// import library dependencies
jimport('joomla.application.component.model');

/**
 * Configuration model class for com_aamenu.
 *
 * @package		TAOJ.AAMenu
 * @subpackage	com_aamenu
 */
class MenuModelConfig extends JModel
{
	/**
	 * Flag to indicate model state initialization.
	 *
	 * @access	protected
	 * @var		boolean
	 */
	var $__state_set		= null;

	/**
	 * Overridden method to get model state variables.
	 *
	 * @access	public
	 * @param	string	$property	Optional parameter name.
	 * @return	object	The property where specified, the state object where omitted.
	 * @since	1.0
	 */
	function getState($property = null)
	{
		// If the model state is uninitialized lets set some values we will need from the request.
		if (!$this->__state_set)
		{
			// Load the parameters.
			$this->setState('params', JComponentHelper::getParams('com_aamenu'));

			$this->__state_set = true;
		}

		return parent::getState($property);
	}

	/**
	 * Method to save the component configuration
	 *
	 * @return	boolean	True on success
	 */
	public function save()
	{
		// Initialize variables.
		$table			= &JTable::getInstance('component');
		$params 		= JRequest::getVar('params', array(), 'post', 'array');
		$row			= array();
		$row['option']	= 'com_aamenu';
		$row['params']	= $params;

		// Load the component data for com_aamenu.
		if (!$table->loadByOption('com_aamenu')) {
			$this->setError($table->getError());
			return false;
		}

		// Bind the new values
		$table->bind($row);

		// Check the row.
		if (!$table->check()) {
			$this->setError($table->getError());
			return false;
		}

		// Store the row.
		if (!$table->store()) {
			$this->setError($table->getError());
			return false;
		}

		return true;
	}
}