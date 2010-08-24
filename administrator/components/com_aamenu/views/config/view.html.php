<?php
/**
 * @version		$Id: view.html.php 67 2009-05-29 13:02:32Z eddieajau $
 * @copyright	Copyright (C) 2009 New Life in IT Pty Ltd. All rights reserved.
 * @license		GNU General Public License <http://www.gnu.org/copyleft/gpl.html>
 * @link		http://www.theartofjoomla.com
 */

// no direct access
defined('_JEXEC') or die();

// import library dependencies
jimport('joomla.application.component.view');

/**
 * The configuration view
 *
 * @package		TAOJ.AAMenu
 * @subpackage	com_aamenu
 */
class MenuViewConfig extends JView
{
	/**
	 * Method to display the view.
	 *
	 * @access	public
	 * @param	string	$tpl	A template file to load.
	 * @return	mixed	JError object on failure, void on success.
	 * @throws	object	JError
	 * @since	1.0
	 */
	function display($tpl = null)
	{
		$state		= &$this->get('State');
		$params		= &$state->get('params');

		// Check for errors.
		if (count($errors = $this->get('Errors'))) {
			JError::raiseError(500, implode("\n", $errors));
			return false;
		}

		// Push out the view data.
		$this->assignRef('state',		$state);
		$this->assignRef('params',		$params);

		parent::display($tpl);
	}
}