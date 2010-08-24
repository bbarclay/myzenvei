<?php
/**
 * @version		$Id: model.php 36 2009-05-19 01:06:55Z eddieajau $
 * @package		JXtended.Libraries
 * @subpackage	Application.Component
 * @copyright	Copyright (C) 2008 - 2009 JXtended, LLC. All rights reserved.
 * @license		GNU General Public License <http://www.gnu.org/copyleft/gpl.html>
 * @link		http://jxtended.com
 */

defined('JPATH_BASE') or die;

jximport('jxtended.database.helper');
jximport('joomla.application.component.model');

if (!function_exists( 'property_exists' ))
{
	function property_exists( $class, $property )
	{
		static $class_vars;

		if (is_object( $class )) {
			$class = get_class( $class );
		}
		if (!isset( $class_vars['class'] )) {
			$class_vars['class'] = get_class_vars( $class );
		}
		return array_key_exists( $property, $class_vars['class'] );
	}
}

/**
 * Abstract Model class
 *
 * @abstract
 * @package		JXtended.Libraries
 * @subpackage	Application
 */
class JXModel extends JModel
{
	/**
	 * @protected
	 * @var	JTable	A persistant Table resource
	 */
	var $_resource = null;

	/**
	 * @protected
	 * @var	int	The count of items returned by getList
	 */
	var $_total = 0;

	/**
	 * @access	private
	 * @var		boolean	Has the state been autoset yet
	 */
	var $__state_set = false;

	/**
	 * Overridden constructor
	 *
	 * @access	protected
	 * @param	array	Configuration array
	 */
	function __construct($config = array())
	{
		if (!empty($config['ignore_request'])) {
			$this->__state_set = true;
		}

		parent::__construct($config);
	}

	/**
	 * Get's a list of categories objects
	 * @param	array	Names array of field-value filters (published|section)
	 * @param	boolean	True if foreign keys are to be resolved
	 * @return	int
	 */
	function getListCount( $filters, $resolveFKs=false )
	{
		$qb = $this->_getListQuery( $filters, $resolveFKs );

		$this->_db->setQuery( $qb->toString() );
		$this->_db->query();
		return $this->_db->getNumRows();
	}

	/**
	 * Get's a list of categories objects
	 * @param	array	Names array of field-value filters (published|section)
	 * @param	boolean	True if foreign keys are to be resolved
	 * @param	string	An optional key by which to index the result array
	 * @return	array
	 */
	function &getList( $filters=array(), $resolveFKs=false, $key='' )
	{
		$limit		= @$filters['limit'];
		$limitstart	= @$filters['limitstart'];

		$qb = $this->_getListQuery( $filters, $resolveFKs );

		$this->_db->setQuery( $qb->toString(), $limitstart, $limit );
		$result = $this->_db->loadObjectList( $key );

		return $result;
	}

	/**
	 * @abstract
	 */
	function _getListQuery( $filters=array(), $resolveFKs=false )
	{
		return null;
	}

	/**
	 * @return	object	A pagination object
	 */
	function &getPagination()
	{
		static $instance;

		if (!$instance)
		{
			jximport('jxtended.html.pagination');
			$state = &$this->getState();
			$instance = new JXPagination( $this->_total, $state->get( 'limitstart'), $state->get( 'limit' ), $state->get( 'pagination_mode' ) );
		}
		return $instance;
	}

	/**
	 * Gets the resource
	 * @return	JTable
	 */
	function &getResource()
	{
		return $this->_resource;
	}

	/**
	 * Get's a list of heirarchial records
	 * @param array Names array of field-value filters (see getList)
	 * @param boolean True if foreign keys are to be resolved
	 * @param string The name of the text field to display, defaults to name
	 * @param string The name of the parent id field
	 * @param int Tree Type
	 */
	function &getTree( $filters, $resolveFKs=false, $textName='name', $parentName='parent_id' )
	{
		$result = $this->getList( $filters, $resolveFKs );

		jximport('jxtended.tree');
		$tree = new JXTree();

		$tree->importObjectList( $result, 'id', $parentName, $textName );

		return $tree;
	}

	//
	// Common methods
	//

	function checkout()
	{
		$result	= true;

		if ($id = (int) $this->getState( 'id' ))
		{
			$user	= &JFactory::getUser();
			$userId	= $user->get( 'id' );
			$table	= &$this->getResource();
			if (property_exists( $table, 'checked_out' ))
			{
				$table->load( $id );
				if ($table->isCheckedOut( $userId, $table->checked_out )) {
					$result = &JError::raiseNotice( 500, 'errorItemCheckedOut' );
				} else {
					$table->checkout( $userId );
				}
			}
		}
		return $result;
	}

	/**
	 * Method to checkin/unlock a row
	 *
	 * @access	public
	 * @return	boolean	True on success
	 * @since	1.5
	 */
	function checkin()
	{
		$result	= true;
		if ($id = (int) $this->getState( 'id' ))
		{
			$table	= &$this->getResource();
			if (!$table->checkin($id)) {
				$result = new JException( $table->getError() );
			}
		}
		return $result;
	}

	/**
	 * Method to checkin/unlock a row
	 *
	 * @access	public
	 * @param	array	An array of id numbers
	 * @param	integer	0 if unpublishing, 1 if publishing
	 * @return	boolean	True on success
	 * @since	1.5
	 */
	function publish( $cid, $value )
	{
		$result	= true;
		$user = & JFactory::getUser();
		$table	= &$this->getResource();
		if (!$table->publish( $cid, $value, $user->get( 'id' ) )) {
			$result = JError::raiseWarning( 500, $table->getError() );
		}
		return $result;
	}

	/**
	 * @param array		Source array
	 * @param int		User id
	 * @return mixed	A JTable, or false if unsuccessful
	 */
	function save( $input = array(), $user_id=0 )
	{
		$result	= true;
		$user	= &JFactory::getUser();
		$table	= &$this->getResource();

		// parse out the params form elements
		$params	= @$input['params'];
		if (is_array( $params ))
		{
			$registry			= new JRegistry();
			$registry->loadArray( $params );
			$input['params']	= $registry->toString();
		}

		if ($k = $table->getKeyName())
		{
			if (isset( $input[$k] ))
			{
				global $mainframe;

				$txOffset	= $mainframe->getCfg( 'offset' );
				$now		= date( 'Y-m-d H:i:s', time() + $txOffset * 3600 );
				if ($input[$k] == 0)
				{
					$input['created_date']		= $now;
					$input['created_user_id']	= $user->get('id');
				}
				else
				{
					$input['modified_date']		= $now;
					$input['modified_user_id']	= $user->get('id');
				}
			}
		}

		if (!$table->save( $input )) {
			$result	= JError::raiseWarning( 500, $table->getError() );
		}
		return $result;
	}

	/**
	 * Delete an item
	 * @param array|int A single or array of primary keys
	 */
	function delete( $input )
	{
		$table = &$this->getResource();
		if (is_array( $input ))
		{
			foreach ($input as $id) {
				$table->delete( (int) $id );
			}
			return true;
		}
		else {
			return $table->delete( (int) $input );
		}
	}

	/**
	 * @param array		An array of primary keys
	 * @param int		Increment, usually +1 or -1
	 * @return boolean
	 */
	function ordering( $input, $inc=0 )
	{
		global $mainframe;

		$database		= &$this->getDBO();
		$user			= &JFactory::getUser();
		$table			= $this->getResource();

		JArrayHelper::toInteger( $input );

		if (count( $input ))
		{
			$cids = 'id=' . implode( ' OR id=', $input );
			$hasCO = property_exists( $table, 'checked_out' );

			$query = 'UPDATE ' . $table->getTableName()
			. ' SET ordering = ordering + ' . (int) $inc
			. ' WHERE (' . $cids . ')'
			. ($hasCO ? ' AND (checked_out = 0 OR checked_out = ' . (int) $user->get( 'id' ) . ')' : '' )
			;
			$database->setQuery( $query );
			if (!$database->query())
			{
				$this->setError( $database->getErrorMsg() );
			}
			else
			{
				return true;
			}
		}
	}

	/**
	 * Set the internal resource
	 * @param	JTable	The table object
	 * @return	JTable	The previous value of the property
	 */
	function &setResource( &$value )
	{
		$oldValue = &$this->_resource;
		$this->_resource = $value;
		return $oldValue;
	}
}