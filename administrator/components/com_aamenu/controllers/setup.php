<?php
/**
 * @version		$Id: setup.php 67 2009-05-29 13:02:32Z eddieajau $
 * @copyright	Copyright (C) 2009 New Life in IT Pty Ltd. All rights reserved.
 * @license		GNU General Public License <http://www.gnu.org/copyleft/gpl.html>
 * @link		http://www.theartofjoomla.com
 */

// no direct access
defined('_JEXEC') or die();

jimport('joomla.application.component.controller');

/**
 * The Setup Controller
 *
 * @package		TAOJ.AAMenu
 * @subpackage	com_aamenu
 */
class MenuControllerSetup extends JController
{
	/**
	 * Method to manually install the component.
	 *
	 * @return	void
	 */
	public function install()
	{
		// Get the setup model.
		$model = &$this->getModel('Setup');

		// Attempt to run the manual install routine.
		$result	= $model->install();

		// Check for installation routine errors.
		if (!$result) {
			$this->setMessage(JText::sprintf('TAOJ_Setup_Install_failed', $model->getError()), 'notice');
		}
		else {
			$this->setMessage(JText::_('TAOJ_Setup_install_success'));
		}

		// Set the redirect.
		$this->setRedirect('index.php?option=com_aamenu');
	}

	/**
	 * Method to process any available database upgrades.
	 *
	 * @return	void
	 */
	public function upgrade()
	{
		// Check for request forgeries
		JRequest::checkToken('request') or jexit(JText::_('AAMenu_Invalid_Token'));

		// Get the upgrades.
		$version	= new AAMenuVersion();
		$upgrades	= $version->getUpgrades();

		// Get the setup model.
		$model = &$this->getModel('Setup');

		// Attempt to run the upgrade routine.
		if ($model->upgrade()) {
			$this->setMessage(JText::_('TAOJ_SETUP_DATABASE_UPGRADE_SUCCESS'));
		}
		else {
			$this->setMessage(JText::sprintf('TAOJ_SETUP_DATABASE_UPGRADE_FAILED', $model->getError()), 'notice');
		}
		$this->setRedirect('index.php?option=com_aamenu');
	}
}