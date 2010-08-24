<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport('joomla.application.component.model');

class unused_detailModelunused_detail extends JModel
{
	
	var $_id = null;
	var $_data = null;
	var $_table_prefix = null;
	
	function __construct()
	{
		parent::__construct();
	  	$this->_table_prefix = '#__';			
		
		$array = JRequest::getVar('cid',  0, '', 'array');
		$this->setId((int)$array[0]);
	}
	
	function setId($id)
	{
		$this->_id	= $id;
		$this->_data		= null;
	}

	function publish($cid = array(), $publish = 1)
	{
		$user 	=& JFactory::getUser();
		if (count( $cid ))
		{
			$cids = implode( ',', $cid );

			$query = 'UPDATE '.$this->_table_prefix.'modules'
				. ' SET published = ' . intval( $publish )
				. ' WHERE id IN ( '.$cids.' )';
			$this->_db->setQuery( $query );
			if (!$this->_db->query()) {
				$this->setError($this->_db->getErrorMsg());
				return false;
			}
		}
		return true;
	}
}

?>

























