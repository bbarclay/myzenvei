<?php
/**
 * @version		$Id: tags.php 67 2009-05-29 13:02:32Z eddieajau $
 * @copyright	Copyright (C) 2009 New Life in IT Pty Ltd. All rights reserved.
 * @license		GNU General Public License <http://www.gnu.org/copyleft/gpl.html>
 * @link		http://www.theartofjoomla.com
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

jximport('jxtended.application.component.modellist');
jximport('jxtended.database.query');

/**
 * @package		TAOJ.AAMenu
 * @subpackage	com_aamenu
 */
class MenuModelTags extends JxModelList
{
	/**
	 * Model context string.
	 *
	 * @var		string
	 */
	public $_context = 'com_aamenu.tags';

	/**
	 * Get a list of the tags defined in the component parameters
	 *
	 * @return	array
	 */
	function getTags()
	{
		// Get the tags field from the parameters, explode on new line
		$config		= JComponentHelper::getParams('com_aamenu');
		$tags		= explode("\n", $config->get('tags'));

		// Build an options list
		$options	= array();
		$options[]	= JHtml::_('select.option', '', '');
		foreach ($tags as $tag) {
			$options[]	= JHtml::_('select.option', trim($tag));
		}

		return $options;
	}

	/**
	 * Assemble the query for the list based on the model state.
	 *
	 * @return	object
	 */
	function _getListQuery()
	{
		$query	= new JXQuery;
		$db		= &$this->getDBO();

		// Only get the fields we want the layout to know about
		$query->select($this->getState('list.select', 'a.id, a.name, a.option'));

		$query->from('#__components AS a');

		// We need to exclude some core components
		$exclude	= array(
						'com_content',
						'com_frontpage',
						'com_media',
						);

		$query->where($db->NameQuote('option').' NOT IN ('.implode(',', array_map(array($db, 'Quote'), $exclude)).')');

		// We need to exclude the sub-menu items
		$query->where('parent = 0');
		$query->where('enabled = 1');
		$query->where('admin_menu_link <> '.$db->quote(''));

		// Join on the tags mapped to the component
		$query->select('t.tag, t.ordering');
		$query->join('LEFT', '#__taoj_aamenu_tags AS t ON t.component_id = a.id');

		// Filter by search in title
		$search = $this->getState('filter.search');
		if (!empty($search)) {
			$search = $this->_db->Quote('%'.$this->_db->getEscaped( $search, true ).'%', false);
			$query->where('(a.title LIKE '.$search.')');
		}

		// Add the list ordering clause.
		$query->order($this->_db->getEscaped($this->getState('list.ordering', 'a.ordering')).' '.$this->_db->getEscaped($this->getState('list.direction', 'ASC')));

		//echo nl2br(str_replace('#__','jos_',$query->toString()));
		return $query;
	}

	/**
	 * Method to get a store id based on model configuration state.
	 *
	 * This is necessary because the model is used by the component and
	 * different modules that might need different sets of data or different
	 * ordering requirements.
	 *
	 * @param	string		$id	A prefix for the store id.
	 *
	 * @return	string		A store id.
	 */
	public function _getStoreId($id = '')
	{
		// Compile the store id.
		$id	.= ':'.$this->getState('list.start');
		$id	.= ':'.$this->getState('list.limit');
		$id	.= ':'.$this->getState('list.ordering');
		$id	.= ':'.$this->getState('list.direction');
		$id	.= ':'.$this->getState('filter.search');

		return md5($id);
	}

	/**
	 * Method to auto-populate the model state.
	 *
	 * This method should only be called once per instantiation and is designed
	 * to be called on the first call to the getState() method unless the model
	 * configuration flag to ignore the request is set.
	 *
	 * @return	void
	 */
	public function _populateState()
	{
		// Initialize variables.
		$app		= &JFactory::getApplication('administrator');
		$params		= JComponentHelper::getParams('com_aamenu');
		$context	= $this->_context.'.';

		// Load the filter state.
		$this->setState('filter.search', $app->getUserStateFromRequest($context.'filter.search', 'filter_search', ''));

		// Load the list state.
		$this->setState('list.start', $app->getUserStateFromRequest($context.'list.start', 'limitstart', 0, 'int'));
		$this->setState('list.limit', $app->getUserStateFromRequest($context.'list.limit', 'limit', $app->getCfg('list_limit', 25), 'int'));
		$this->setState('list.ordering', $app->getUserStateFromRequest($context.'list.ordering', 'filter_order', 'a.name', 'cmd'));
		$this->setState('list.direction', $app->getUserStateFromRequest($context.'list.direction', 'filter_order_Dir', 'ASC', 'word'));

		// Load the check parameters.
		if ($this->_state->get('filter.state') === '*') {
			$this->setState('check.state', false);
		} else {
			$this->setState('check.state', true);
		}

		// Load the parameters.
		$this->setState('params', $params);
	}

	/**
	 * Save the tags assigned to the components in the list
	 *
	 * @return	boolean		True if successful, false otherwise and internal error set
	 */
	function save()
	{
		$request	= $this->getState('request');
		$db			= &$this->getDBO();

		$tags		= JArrayHelper::getValue($request, 'tags', array(), 'array');
		$ordering	= JArrayHelper::getValue($request, 'ordering', array(), 'array');

		$ids	= array_keys($tags);
		JArrayHelper::toInteger($ids);

		$query	= 'DELETE FROM #__taoj_aamenu_tags' .
				' WHERE component_id IN ('.implode(',', $ids).')';
		$db->setQuery($query);
		if (!$db->query()) {
			$this->setError($db->getErrorMsg());
			return false;
		}

		$tuples	= array();
		foreach ($ids as $id) {
			$tuples[]	= '('.(int) $id.','.$db->Quote($tags[$id]).','.(int) $ordering[$id].')';
		}

		$query	= 'INSERT INTO #__taoj_aamenu_tags (component_id,tag,ordering) VALUES '.
				implode(',', $tuples);
		$db->setQuery($query);
		if (!$db->query()) {
			$this->setError($db->getErrorMsg());
			return false;
		}

		return true;
	}
}
