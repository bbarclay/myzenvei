<?php
defined( '_JEXEC' ) or die( '=;)' );
jimport( 'joomla.application.component.model' );
class JafiliaModelCampaigns extends JModel {
	var $_data;
	var $_total = null;
	var $_pagination = null;
	
	function __construct() {
	 	parent::__construct();	
		global $mainframe, $option;	
		$limit = $mainframe->getUserStateFromRequest('global.list.limit', 'limit', $mainframe->getCfg('list_limit'), 'int');
		$limitstart = $mainframe->getUserStateFromRequest($option.'.limitstart', 'limitstart', 0, 'int');	
		$limitstart = ($limit != 0 ? (floor($limitstart / $limit) * $limit) : 0);	
		$this->setState('limit', $limit);
		$this->setState('limitstart', $limitstart);
		$array = JRequest::getVar('cid',  0, '', 'array');
        $this->setId((int)$array[0]);
	}
	function setId($id) { 
      $this->_id     = $id;
      $this->_data   = null;
   }
   function &getData2() {
      if (empty( $this->_data )) {
         $query = ' SELECT * FROM #__jafilia_campaigns '.
               '  WHERE id = '.$this->_id;
         $this->_db->setQuery( $query );
         $this->_data = $this->_db->loadObject();
      }
      if (!$this->_data) {
         $this->_data = new stdClass();
         $this->_data->id = 0;
         $this->_data->title = null;
         $this->_data->version = null;
         $this->_data->ppcvalue = null;
         $this->_data->fpsvalue = null;
		 $this->_data->fplvalue = null;
		 $this->_data->payout = null;
		 $this->_data->chartscolor = null;
		 $this->_data->template = null;
		 $this->_data->desc = null;
		 $this->_data->terms = null;
		 $this->_data->startdate = null;
		 $this->_data->enddate = null;		 
         $this->_data->published = 0; 
      }
      return $this->_data;
   }   
	function _buildQuery() {
		$query = ' SELECT * '
			. ' FROM #__jafilia_campaigns ';
		return $query;
	}
	function getData() {
		if (empty( $this->_data ))	{
			$query = $this->_buildQuery();
			$this->_data = $this->_getList( $query, $this->getState('limitstart'), $this->getState('limit') );
		}
		return $this->_data;
	}
	function getTotal()	{
		if (empty($this->_total))	{
			$query = $this->_buildQuery();
			$this->_total = $this->_getListCount($query);	
		}
		return $this->_total;
	}
	function getPagination()  {
 	if (empty($this->_pagination))
 	{
 	    jimport('joomla.html.pagination');
 	    $this->_pagination = new JPagination($this->getTotal(), $this->getState('limitstart'), $this->getState('limit') );
 	}
 	return $this->_pagination;
  }
   function store() {    
	$row =& $this->getTable();
	$data = JRequest::get( 'post' );
	$uploaddir = JPATH_SITE.DS.'components'.DS.'com_jafilia'.DS.'images'.DS;
	$image = strtolower($_FILES["image"]["name"]);
	// these datatypes are allowed
	$allowed = array ('image/jpg', 'image/gif', 'image/png', 'image/jpeg', 'application/x-shockwave-flash', '');
	$max_size = "100000";
	// get datatype
	$type = $_FILES["image"]["type"];
	// get file size
	$size = $_FILES["image"]["size"];
	// check if datatype and size is valid
	if ( !in_array($type, $allowed ) && $size < $max_size ) {
		$link = 'index.php?option=com_jafilia&controller=campaigns';
		$msg = $type.'+is+no+valid+datatype';
		$this->setRedirect($link, $msg);
	}
	// uploads				
	if(isset($_FILES['image'])) {	
		if(copy($_FILES['image']['tmp_name'], $uploaddir . $image));
	}	 	
	if($image) {		
		$data['image']=$image;
	}
	else {
		$data['image']=$data['oldimage'];
	}	
      if (!$row->bind($data)) {
         $this->setError($this->_db->stderr());
         return false;
      }
      if (!$row->check()) {
         $this->setError($this->_db->stderr());
         return false;
      }
      if (!$row->store()) {
         $this->setError( $row->getError() );
         return false;
      }
      return true;
   }
     
   function delete() {
      $cids = JRequest::getVar( 'cid', array(0), 'post', 'array' );
      $row =& $this->getTable();
      if (count( $cids )) {
         foreach($cids as $cid) {
            if (!$row->delete( $cid )) {
               $this->setError( $row->getError() );
               return false;
            }
         }
      }
      return true;
   }  
	function publish($cid = array(), $publish = 1) {  
	      if (count( $cid )) {
	         JArrayHelper::toInteger($cid);
	         $cids = implode( ',', $cid );
	         $query = 'UPDATE #__jafilia_campaigns'
	            . ' SET published = '.(int) $publish
	            . ' WHERE id IN ( '.$cids.' )'
	         ;
	         $this->_db->setQuery( $query );
	         if (!$this->_db->query()) {
	            $this->setError($this->_db->getErrorMsg());
	            return false;
	         }
	      }
	      return true;
	}     
}// class
?>