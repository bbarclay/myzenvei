<?php
/**
 * JEvents Component for Joomla 1.5.x
 *
 * @version     $Id: filters.php 1560 2009-09-09 13:09:14Z geraint $
 * @package     JEvents
 * @copyright   Copyright (C) 2008-2009 GWE Systems Ltd
 * @license     GNU/GPLv2, see http://www.gnu.org/licenses/gpl-2.0.html
 * @link        http://www.jevents.net
 */

// ensure this file is being included by a parent file
defined('_JEXEC') or die( 'Direct Access to this location is not allowed.' );

class jevFilterProcessing
{
	var $filters;
	var $filterpath;
	var $where = array();
	var $join = array();
	var $filterHTML;
	var $filterReset;
	var $needsgroupby=false;

	function & getInstance($item, $filterpath="", $unsetfilter=false, $uid = ""){

		if ($uid==""){
			// find what is running - used by the filters 
			$registry	=& JRegistry::getInstance("jevents");
			$activeprocess = $registry->getValue("jevents.activeprocess","");
			$moduleid = $registry->getValue("jevents.moduleid", 0);
			$moduleparams = $registry->getValue("jevents.moduleparams", false);
			if ($moduleparams && $moduleparams->get("ignorefiltermodule",false)){
				$uid="mod".$moduleid;
			}
		}

		$pluginsDir = JPATH_ROOT.DS.'plugins'.DS.'jevents';
		if ($filterpath=="") $filterpath=$pluginsDir.DS."filters";

		static $instances;
		if ($unsetfilter && is_array($instances)){
			foreach (array_keys($instances) as $key){
				$newkey = @unserialize($key);
				if (is_array($newkey) && in_array($unsetfilter,$newkey)){
					unset($instances[$key]);
				}
			}
		}
		if (!isset($instances)){
			$instances=array();
		}
		if (is_object($item)){
			$key = get_class($item);
		}
		else if (is_array($item)){
			$key = serialize($item);
		}
		// enable the use of unique filters for a specific module or component instance
		$key .= $uid;
		if (!array_key_exists($key,$instances)){
			$instances[$key]= new jevFilterProcessing($item, $filterpath);
		}
		return $instances[$key];
	}

	function jevFilterProcessing($item, $filterpath=false){

		$this->filterpath = array();
		if ($filterpath){
			$this->filterpath = $filterpath;
		}

		settype($this->filterpath, 'array'); //force to array
		$this->filterpath[]=dirname(__FILE__).DS."filters";

		// get filter details
		if (is_object($item)){
			$filters = & $item->getFilters();
		}
		else if (is_array($item)){
			$filters = $item;
		}

		$this->filters = array();
		// extract filters if set
		foreach ($filters as $filtername) {
			$filter = "jev".ucfirst($filtername)."Filter";
			if (!class_exists($filter)){
				$filterFile = ucfirst($filtername).'.php';

				$filterFilePath = JPath::find($this->filterpath,$filterFile);
				if ($filterFilePath){
					include_once($filterFilePath);
				}
				else {
					echo "Missing filter file $filterFile<br/>";
					continue;
				}

			}
			$this->filters[] = new $filter("",$filtername);
		}
		foreach ($this->filters as $filter) {
			$sqlFilter = $filter->_createFilter();
			if ($sqlFilter!="") $this->where[]=$sqlFilter;
			$joinFilter =  $filter->_createJoinFilter();
			if ($joinFilter!="") $this->join[] = $joinFilter;
			if ($filter->needsgroupby) $this->needsgroupby=true;
		}

	}

	function setWhereJoin(&$where, &$join){
		$where = array_merge($where, $this->where);
		$join = array_merge($join, $this->join);
	}

	function needsGroupBy(){
		return 	$this->needsgroupby;
	}

	function getFilterHTML(){
		if (!isset($this->filterHTML)){
			$this->filterHTML = array();
			foreach ($this->filters as $filter) {
				$this->filterHTML[] = $filter->_createfilterHTML();
			}
		}
		return $this->filterHTML;
	}

	function getFilterReset(){
		if (!isset($this->filterReset)){
			$this->filterReset = array();
			foreach ($this->filters as $filter) {
				$this->filterReset[] = $filter->_createfilterReset();
			}
		}
		return $this->filterReset;
	}

}

class jevFilter
{
	var $filterNullValue;
	var $filterType;
	var $filterIsString = false;
	var $filter_value;
	var $needsgroupby = false;

	// number of filter fields on top of standard 1 (TODO in time merge these concepts)
	var $valueNum = 0;
	var $filterNullValues = array();
	var $filter_values = array();

	var $filterField = false;
	var $tableName = "";
	var $filterHTML="";
	var $session = null;
	var $useMemory = false;

	var $fieldset=false;

	function jevFilter($tablename, $filterfield, $isString=false){
		global $mainframe;

		// If using caching should disable session filtering if not logged in
		$cfg	 = & JEVConfig::getInstance();
		$useCache = intval($cfg->get('com_cache', 0));
		$user = &JFactory::getUser();
		// TODO chek this logic
		if (intval(JRequest::getVar('filter_reset',0))){
			$this->filter_value =  $this->filterNullValue;
			for ($v=0;$v<$this->valueNum;$v++){
				$this->filter_values[$v] = $this->filterNullValues[$v] ;
			}
			$this->filter_value = $mainframe->setUserState( $this->filterType.'_fv_ses', $this->filterNullValue );
			for ($v=0;$v<$this->valueNum;$v++){
				$this->filter_values[$v] = $mainframe->setUserState( $this->filterType.'_fvs_ses'.$v,$this->filterNullValues[$v] );
			}
		}
		else if ( $user->get('id')==0 && $useCache) {
			$this->filter_value =  JRequest::getVar($this->filterType.'_fv', $this->filterNullValue );
			for ($v=0;$v<$this->valueNum;$v++){
				$this->filter_values[$v] = JRequest::getVar($this->filterType.'_fvs'.$v, $this->filterNullValues[$v]);
			}
		}
		else {
			$this->filter_value = $mainframe->getUserStateFromRequest( $this->filterType.'_fv_ses', $this->filterType.'_fv', $this->filterNullValue );
			for ($v=0;$v<$this->valueNum;$v++){
				$this->filter_values[$v] = $mainframe->getUserStateFromRequest( $this->filterType.'_fvs_ses'.$v, $this->filterType.'_fvs'.$v,$this->filterNullValues[$v] );
			}
		}
		/*
}
else {
$this->filter_value = JRequest::getString($this->filterType.'_fv', $this->filterNullValue );
for ($v=0;$v<$this->valueNum;$v++){
$this->filter_values[$v] = JRequest::getInt($this->filterType."_fvs".$v, $this->filterNullValues[$v] );
}
}
*/
		$this->tableName = $tablename;
		$this->filterField = $filterfield;
		$this->filterIsString = $isString;
	}

	// simple utility function
	function _getFilterValue($filterType, $filterNullValue ){
		global $mainframe;
		if ($mainframe->isAdmin()){
			$filterValue = $mainframe->getUserStateFromRequest( $filterType.'_fv_ses', $filterType.'_fv', $filterNullValue );
		}
		else {
			$filterValue = JRequest::getInt($filterType.'_fv', $filterNullValue );
		}
		return $filterValue;
	}

	function &getSession(){
		static $session;
		if (!isset($session)){
			include_once(dirname(__FILE__)."/Session.php");
			$session = new gweSession();
		}
		return $session;
	}

	function _createFilter($prefix=""){
		if (!$this->filterField ) return "";
		$filter="";
		if ($this->filter_value!=$this->filterNullValue){
			if ($this->filterIsString){
				$filter = "$prefix".$this->filterField."='$this->filter_value'";
			}
			else {
				$filter = "$prefix".$this->filterField."=$this->filter_value";
			}
		}
		return $filter;
	}

	function _createJoinFilter($prefix=""){
		if (!$this->filterField ) return "";
		$filter="";
		return $filter;
	}


	function _createfilterHTML(){ return "";}

	function _createfilterReset(){
		return 'elems = document.getElementsByName("'.$this->filterType.'_fv");if (elems.length>0) {elems[0].value="'.$this->filterNullValue.'"};';
	}

}

class jevBooleanFilter extends jevFilter
{
	var $label="";
	var $bothLabel = "";
	var $yesLabel = "";
	var $noLabel = "";

	function jevBooleanFilter($tablename, $filterfield, $isstring=true,$bothLabel="Both", $yesLabel="Yes", $noLabel="No"){
		$this->filterNullValue="-1";
		$this->yesLabel = $yesLabel;
		$this->noLabel = $noLabel;
		$this->bothLabel = $bothLabel;
		parent::jevFilter($tablename, $filterfield, $isstring);
	}

	function _createFilter($prefix=""){
		if (!$this->filterField ) return "";
		if ($this->filter_value==$this->filterNullValue) return "";
		$filter = "$prefix".$this->filterField."=".$this->filter_value;
		return $filter;
	}

	function _createfilterHTML(){
		$filterList=array();
		$filterList["title"] = $this->filterLabel;
		$options = array();
		$options[] = JHTML::_('select.option', "-1", $this->bothLabel, "value","yesno");
		$options[] = JHTML::_('select.option', "0", $this->noLabel,"value","yesno");
		$options[] = JHTML::_('select.option',  "1", $this->yesLabel,"value","yesno");
		$filterList["html"] = JHTML::_('select.genericlist',$options, $this->filterType.'_fv', 'class="inputbox" size="1" onchange="form.submit();"', 'value', 'yesno', $this->filter_value );
		return $filterList;
	}

}

class jevTitleFilter extends jevFilter
{
	function jevTitleFilter ($tablename, $filterfield, $isstring=true){
		$this->filterNullValue="";
		$this->filterType="title";
		parent::jevFilter($tablename,$filterfield, true);
	}

	function _createFilter($prefix=""){
		if (!$this->filterField ) return "";
		$filter="";
		if ($this->filter_value!=$this->filterNullValue){
			$filter =  "LOWER( cont.title ) LIKE '%".$this->filter_value."%'";
		}
		return $filter;
	}

	function _createJoinFilter($prefix=""){
		if (!$this->filterField ) return "";
		if ($this->filter_value==$this->filterNullValue) return "";
		$filter="#__content AS cont ON cont.id=c.target_id";
		return $filter;
	}

	function _createfilterHTML(){
		global $database;

		if (!$this->filterField) return "";


		if (!$this->filterField) return "";
		$filterList=array();
		$filterList["title"]="Content Title";
		$filterList["html"] = 	'<input type="text" name="'.$this->filterType.'_fv" value="'.$this->filter_value.'" class="text_area" onchange="form.submit();" />';

		return $filterList;

	}

}