<?php
/**
 * @version		$Id: config.php 67 2009-05-29 13:02:32Z eddieajau $
 * @copyright	Copyright (C) 2009 New Life in IT Pty Ltd. All rights reserved.
 * @license		GNU General Public License <http://www.gnu.org/copyleft/gpl.html>
 * @link		http://www.theartofjoomla.com
 */

// no direct access
defined('_JEXEC') or die;

/**
 * Configuration controller class for com_aamenu.
 *
 * @package		TAOJ.AAMenu
 * @subpackage	com_aamenu
 */
class MenuControllerConfig extends JController
{
	/**
	 * Method to save the configuration.
	 *
	 * @return	bool	True on success, false on failure.
	 */
	public function save()
	{
		// Check for request forgeries
		JRequest::checkToken('request') or jexit(JText::_('AAMenu_Invalid_Token'));

		$model	= &$this->getModel('Config');
		$model->setState('request', JRequest::get('post'));

		if ($model->save())
		{
			$this->setRedirect('index.php?option=com_aamenu&view=config&layout=close&tmpl=component');
			return true;
		}
		else
		{
			$message = JText::sprintf('AAMenu_Config_Save_Failed', $model->getError());
			$this->setRedirect('index.php?option=com_aamenu&view=config&tmpl=component', $message, 'notice');
			return false;
		}
	}
}
