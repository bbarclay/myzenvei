<?php
/**
 * AutoTweet Model for posts
 * 
 * @version		1.1
 * @license		GNU/GPL
 */

// No direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.application.component.model' );
jimport( 'joomla.html.pagination' );

require_once (JPATH_COMPONENT_ADMINISTRATOR . DS . 'helpers' . DS . 'autotweetposthelper.php');


/**
 * Post Model
 *
 */
class AutotweetModelAutotweet extends JModel
{
	var $table			= '#__autotweet';
	var $_data			= null;

	var $_pagination	= null;
	var $_total			= null;

	
	function __construct()
	{
		global $mainframe, $option;
		
		parent::__construct();
		
		// get pagination request variables
		$limit		= $mainframe->getUserStateFromRequest('global.list.limit', 'limit', $mainframe->getCfg('list_limit'));
		$limitstart	= $mainframe->getUserStateFromRequest($option . 'limitstart', 'limitstart', 0);
		
		// set state pagination variables
		$this->setState('limit', $limit);
		$this->setState('limitstart', $limitstart);
	}
	
	
	/**
	 * Returns the orderby clause for the query
	 */
	function _buildQueryOrderBy()
	{
		global $mainframe, $option;
		
		$filter_order     = $mainframe->getUserStateFromRequest($option . 'filter_order', 'filter_order', 'postdate');
        $filter_order_Dir = strtoupper($mainframe->getUserStateFromRequest($option . 'filter_order_Dir', 'filter_order_Dir', 'DESC'));
 
 		if (($filter_order_Dir != 'ASC') && ($filter_order_Dir != 'DESC')) {
			$filter_order_Dir = 'DESC';
		}
		
		$db = &JFactory::getDBO();
		$query = ' ORDER BY ' . $db->NameQuote($filter_order) . ' ' . $filter_order_Dir;

		return $query;
	}
	
	/**
	 * Returns the where clause for the query
	 */
	function _buildQueryWhere()
	{
		global $mainframe, $option;
		
		$query			= array();
		$pubstate		= null;
		$filter_state	= $mainframe->getUserStateFromRequest($option . 'filter_state', 'filter_state');
		
 		// set published state for filter
		if ('P' == $filter_state) {
			$pubstate = '1';
		}
		elseif ('U' == $filter_state) {
			$pubstate = '0';
		}
		
		// set where only if filtering is active
		if (null != $pubstate) {
			$db =& JFactory::getDBO();
			$query = ' WHERE ' . $db->NameQuote('published') . ' = ' . (int)$pubstate;
		}
		
		return $query;
	}

	/**
	 * Returns the query
	 * @return string The query to be used to retrieve the rows from the database
	 */
	function _buildQuery()
	{
		$db = &JFactory::getDBO();
		$query = 'SELECT * FROM ' . $db->NameQuote($this->table) . $this->_buildQueryWhere() . $this->_buildQueryOrderBy();

		return $query;
	}

	/**
	 * Retrieves the post data
	 * @return array Array of objects containing the data from the database
	 */
	function getData()
	{
		// Lets load the data if it doesn't already exist
		if (empty($this->_data))
		{
			$query		= $this->_buildQuery();
			$limitstart	= $this->getState('limitstart');
			$limit		= $this->getState('limit');
			
			$this->_data = $this->_getList($query, $limitstart, $limit);
		}

		return $this->_data;
	}
	
	function delete()
	{
	    $result = true;
		
		$cids = JRequest::getVar( 'cid', array(0), 'post', 'array' );
	    $row =& $this->getTable();
	 
	    foreach($cids as $cid) {
	        if (!$row->delete($cid)) {
	            $this->setError( $row->getErrorMsg() );
	            $result = false;
	        }
	    }
	 
	    return $result;
	}
	
	function publish()
	{
	    $result = true;
		
		$cids = JRequest::getVar( 'cid', array(0), 'post', 'array' );
	    $row =& $this->getTable();
		
		$helper =& AutotweetPostHelper::getInstance();
		
		foreach($cids as $cid) {
	        $row->load($cid);
			
			// post only unpublished
			if (0 == $row->published) {
				$tmp_result = $helper->postTwitterMessage($row->articleid, $row->publish_up, $row->message, $row->url, null, true, $row->id);
			
				if (!$tmp_result) {
					$this->setError( 'AutoTweet NG component - article not posted, id = ' . $cid );
					$result = false;
				}
			}	
	    }
		
	    return $result;
	}
	
	function unpublish()
	{
		$cids = JRequest::getVar( 'cid', array(0), 'post', 'array' );
	    $row =& $this->getTable();
		
		$row->publish($cids, 0); 
		
	    return true;
	}
	
	function publishall()
	{
		$helper =& AutotweetPostHelper::getInstance();
		$result = $helper->postAll();
	
		if (!$result) {
			$this->setError( 'AutoTweet NG component - some articles not posted');
		}
	
	    return $result;
	}
	
	//
	// pagination
	//
	function getPagination()
	{
		if (empty($this->_pagination)) {
			$total		= $this->getTotal();
			$limitstart	= $this->getState('limitstart');
			$limit		= $this->getState('limit');
			
			// paganation object
			$this->_pagination = new JPagination($total, $limitstart, $limit);
		}
		
		return $this->_pagination;
	}
		
	
	
	function getTotal()
	{
		if (empty($this->_total)) {
			$query = $this->_buildQuery();
			$this->_total = $this->_getListcount($query);
		}
		
		return $this->_total;
	}
	
	private function deleteOlderThan($days)
	{
	    $result = true;
		
		$day_str = '-' . $days . ' days';
		$del_date = JFactory::getDate(strtotime(JFactory::getDate()->toFormat() . $day_str));
		
		$db = &JFactory::getDBO();
		$query = 'DELETE FROM ' . $db->NameQuote($this->table)
			. ' WHERE ' . 'Date(' . $db->Quote($del_date->toFormat()) . ')' . ' > ' . 'Date(' . $db->NameQuote('postdate') . ')';

		$db->setQuery($query);
		$q_result = $db->query();

        if (!$q_result) {
            $this->setError($db->getErrorMsg());
            $result = false;
	    }

	    return $result;
	}


	//
	// removes old database entrys
	// function must be in model to call directly from view to avoid problems with redirect (view/controller)
	//
	function removeOlderThan()
	{
		$msg = '';
		
		$params =& JComponentHelper::getParams('com_autotweet');
		$cleanup_enabled	= (int)$params->get('cleanup_enabled', 1);
		$cleanup_days		= (int)$params->get('cleanup_days', 4);
	
		if ($cleanup_enabled) {
			switch ($cleanup_days) {
				case 1:
					$days = '5';
					break;
				case 2:
					$days = '10';
					break;
				case 3:
					$days = '15';
					break;
				case 4:
					$days = '20';
					break;
				default:
					$days = '5';
					break;
			}

			$result = $this->deleteOlderThan($days);
			
			if ($result) {
				$msg = JText::_( 'Automatic database cleanup successfully.' );
			}
			else {
				$msg = JText::_( 'Error: Automatic database cleanup failed (' . $this->getError() . ')' . '.' );
			}
		}
		
		return $msg;
	}
	
}