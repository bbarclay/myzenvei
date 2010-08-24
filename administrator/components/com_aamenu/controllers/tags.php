<?php
/**
 * @version		$Id: tags.php 67 2009-05-29 13:02:32Z eddieajau $
 * @copyright	Copyright (C) 2009 New Life in IT Pty Ltd. All rights reserved.
 * @license		GNU General Public License <http://www.gnu.org/copyleft/gpl.html>
 * @link		http://www.theartofjoomla.com
 */

defined('_JEXEC') or die('Invalid Request.');

jimport('joomla.application.component.controller');

/**
 * The Setup Controller
 *
 * @package		TAOJ.AAMenu
 * @subpackage	com_aamenu
 */
class MenuControllerTags extends JController
{
	/**
	 * Save the record
	 */
	function save()
	{
		// Check for request forgeries
		JRequest::checkToken('request') or jexit(JText::_('AAMenu_Invalid_Token'));

		$model	= &$this->getModel('tags');
		$model->setState('request', JRequest::get('post'));

		if ($model->save()) {
			$this->setMessage(JText::_('AAMenu_Tags_Saved'));
		}
		else {
			$this->setMessage(JText::_('AAMenu_Tags_Save_failed'));
			JError::raiseWarning($model->getError());
		}

		$this->setRedirect('index.php?option=com_aamenu&view=tags');
	}
}