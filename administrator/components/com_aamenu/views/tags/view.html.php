<?php
/**
 * @version		$Id: view.html.php 67 2009-05-29 13:02:32Z eddieajau $
 * @copyright	Copyright (C) 2009 New Life in IT Pty Ltd. All rights reserved.
 * @license		GNU General Public License <http://www.gnu.org/copyleft/gpl.html>
 * @link		http://www.theartofjoomla.com
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.view');

/**
 * @package		TAOJ.AAMenu
 * @subpackage	com_aamenu
 */
class MenuViewTags extends JView
{
	public $state;
	public $items;
	public $tags;
	public $pagination;

	/**
	 * Display the view
	 *
	 * @access	public
	 */
	public function display($tpl = null)
	{
		$state		= $this->get('State');
		$items		= $this->get('Items');
		$tags		= $this->get('Tags');
		$pagination	= $this->get('Pagination');

		// Check for errors.
		if (count($errors = $this->get('Errors'))) {
			JError::raiseError(500, implode("\n", $errors));
			return false;
		}

		$this->assignRef('state',		$state);
		$this->assignRef('items',		$items);
		$this->assignRef('tags',		$tags);
		$this->assignRef('pagination',	$pagination);

		parent::display($tpl);
		$this->_setToolbar();
	}

	/**
	 * Display the toolbar
	 */
	protected function _setToolbar()
	{
		JToolBarHelper::title(JText::_('COM_AAMENU'), 'logo');
		JToolBarHelper::save('tags.save', 'AAMenu_Toolbar_Save_Changes');

		$toolbar = &JToolBar::getInstance('toolbar');
		$toolbar->appendButton('Popup', 'config', 'AAMenu_Toolbar_Options', 'index.php?option=com_aamenu&view=config&tmpl=component', 640, 320);

		JToolBarHelper::help('index.html', 'true');
	}
}