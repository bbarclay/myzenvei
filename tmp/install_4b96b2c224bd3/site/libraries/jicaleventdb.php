<?php
/**
 * JEvents Component for Joomla 1.5.x
 *
 * @version     $Id: jicaleventdb.php 1626 2009-11-05 14:41:13Z geraint $
 * @package     JEvents
 * @copyright   Copyright (C) 2008-2009 GWE Systems Ltd, 2006-2008 JEvents Project Group
 * @license     GNU/GPLv2, see http://www.gnu.org/licenses/gpl-2.0.html
 * @link        http://www.jevents.net
 */

defined( '_JEXEC' ) or die( 'Restricted access' );

class jIcalEventDB extends jEventCal {
	//var $vevent;
	var $_icsid=0;
	// array of jIcalEventRepeat
	var $_repeats=null;

	function jIcalEventDB($vevent) {
		// get default value for multiday from params
		$cfg = & JEVConfig::getInstance();
		if ($this->_multiday==-1){
			$this->_multiday=$cfg->get('multiday',1);
		}
		// TODO - what is vevent is actually stdClass already
		$this->data = new stdClass();
		$array= get_object_vars($vevent);
		foreach ($array as $key=>$val) {
			if (strpos($key,"_")!==0  && $key!="_db"){
				$key = "_".$key;
				$this->$key = $val;
			}
		}
		// Mysql reserved word workaround
		$this->_interval = isset($vevent->rinterval)?$vevent->rinterval:0;
		//global $mainframe;
		//include_once(JPATH_SITE."/components/$compname/libraries/iCalImport.php");
		//$this->vevent = iCalEvent::iCalEventFromDB($array);

		$this->_access=@$vevent->access;;
		$this->_content= @$vevent->description;
		$this->_title= @$vevent->summary;
		//TODO move start repeat to descendent class where it belongs
		if (isset($this->_startrepeat)) {
			$this->_publish_up = $this->_startrepeat;
		}
		else {
			$this->_publish_up = strftime( '%Y-%m-%d %H:%M:%S',@$this->_dtstart);
		}

		$this->_reccurtype = 0;
		$this->_reccurday = "";
		$this->_reccurweekdays = "";
		$this->_reccurweeks = "";
		$this->_alldayevent = 0;
		list($hs,$ms,$ss) = explode(":",strftime( '%H:%M:%S',@$this->_dtstart));
		list($he,$me,$se) = explode(":",strftime( '%H:%M:%S',@$this->_dtend));
		if (($hs+$ms+$ss)==0 && ($he==23 && $me==59 && $se==59)) {
			$this->_alldayevent = 1;
		}
		// catch legacy events with mixed database structure
		else if (($hs+$ms+$ss)==0 && ($he+$me+$se)==0) {
			if (isset($this->_endrepeat)){
				$temp = strtotime($this->_endrepeat);
				if ($temp==$this->_dtend){
					$this->_endrepeat=strftime( '%Y-%m-%d %H:%M:%S',$temp-1);
				}
				$this->_dtend-=1;
			}
			$this->_alldayevent = 1;
		}
		// TODO Make this an option in the config
		if (trim($this->_color)!==""){
			$this->_useCatColor=0;
			$this->_color_bar=$this->_color;
		}
		else {
			$this->_useCatColor=1;
			$this->_color_bar="#ffffff";
		}

		if (isset($this->_endrepeat)){
			$this->_publish_down = $this->_endrepeat;
		}
		else {
			$this->_publish_down = strftime( '%Y-%m-%d %H:%M:%S',@$this->_dtend);
		}

		$user =& JFactory::getUser();

		if (!isset($this->_created_by)){
			$this->_created_by=$user->id;
		}
//		$this->_hits=0;

		list($this->_yup,$this->_mup,$this->_dup) = explode("-",$this->_publish_up);
		list($this->_dup,$temp) = explode(" ",$this->_dup);
		list($this->_ydn,$this->_mdn,$this->_ddn) = explode("-",$this->_publish_down);
		list($this->_ddn,$temp) = explode(" ",$this->_ddn);

		// initially unpublished
		if (!isset($this->_state)) $this->_state=0;

		$this->_contactlink="n/a";
	}

	function ev_id() {
		return $this->id();
	}
	
	function hasLocation() {
		return !empty( $this->_location );
	}

	function evdet_id($val="") {
		return $this->getOrSet(__FUNCTION__,$val);
	}

	function color($val="") {
		return $this->getOrSet(__FUNCTION__,$val);
	}

	function location($val="") {
		return $this->getOrSet(__FUNCTION__,$val);
	}

	function hasContactInfo() {
		return !empty( $this->_contact);

	}

	function contact_info($val="") {
		return $this->getOrSet("contact",$val);
	}


	function dtstart($val=""){
		if (strlen($val)==0) return $this->_dtstart;
		else {
			$this->_dtstart=$val;
			$this->_publish_up = strftime( '%Y-%m-%d %H:%M:%S',$this->_dtstart);
		}
	}

	function interval($val="") {
		if (strlen($val)==0) {
			if (!isset($this->_interval) || $this->_interval=="" || $this->_interval==0) return 1;
			else return $this->_interval;
		}
		else {
			$this->_interval=$val;
		}
	}

	function count($val="") {
		if (strlen($val)==0) {
			if (!isset($this->_count) || $this->_count=="" || $this->_count==0) return 1;
			else return $this->_count;
		}
		else {
			$this->_count=$val;
		}
	}

	function rawuntil(){
		if (!isset($this->_until) || $this->_until=="" || $this->_until==0) return "";
		return $this->_until;
	}

	function until($val="") {
		if (strlen($val)==0) {
			if (!isset($this->_until) || $this->_until=="" || $this->_until==0) return $this->_dtstart;
			return $this->_until;
		}
		else {
			$this->_until=$val;
		}
	}

	function freq($val="") {
		return $this->getOrSet(__FUNCTION__,$val);
	}

	function icsid($val=""){
		return $this->getOrSet(__FUNCTION__,$val);
	}

	function priority($val=""){
		return $this->getOrSet(__FUNCTION__,$val);
	}
	
	function dtend($val=""){
		if (strlen($val)==0) return $this->_dtend;
		else {
			$this->_dtend=$val;
			$this->_publish_down = strftime( '%Y-%m-%d %H:%M:%S',$this->_dtend);
		}
	}

	function starttime24(){
		$cfg	 = & JEVConfig::getInstance();
		return strftime("%H:%M",$this->_dtstart);
	}
	
	function starttime($val=""){
		if (strlen($val)==0) {
			$cfg	 = & JEVConfig::getInstance();
			// com_calUseStdTime = 12h clock
			return ($cfg->get('com_calUseStdTime')== '1') ? (JUtility::isWinOS()?date("g:ia",$this->_dtstart):strftime("%I:%M%p",$this->_dtstart)) :strftime("%H:%M",$this->_dtstart);
		}
		else {
			$this->_dtstart = strtotime($val,$this->_dtstart);
		}
	}

	function endtime24(){
		$cfg	 = & JEVConfig::getInstance();
		return strftime("%H:%M",$this->_dtend);
	}
	

	function endtime($val=""){
		if (strlen($val)==0) {
			$cfg	 = & JEVConfig::getInstance();
			// com_calUseStdTime = 12h clock
			return ($cfg->get('com_calUseStdTime')== '1') ? (JUtility::isWinOS()?date("g:ia",$this->_dtend):strftime("%I:%M%p",$this->_dtend)) :strftime("%H:%M",$this->_dtend);
		}
		else {
			$this->_dtend = strtotime($val,$this->_dtend);
		}
	}

	function byyearday($raw=false){
		if ($raw) return $this->_byyearday;
		// TODO consider relaxing assumption that always + or - and not a mixture
		if (isset($this->_byyearday) && $this->_byyearday!="") {
			$temp = $this->_byyearday;
			$temp = str_replace("+","",$temp);
			$temp = str_replace("-","",$temp);
			return $temp;
		}
		else return $this->startYearDay();
	}

	function byday($raw=false){
		if ($raw) return $this->_byday;
		// TODO consider relaxing assumption that always + or - and not a mixture
		if (isset($this->_byday) && $this->_byday!="") {
			$temp = $this->_byday;
			$temp = str_replace("+","",$temp);
			$temp = str_replace("-","",$temp);
			return $temp;
		}
		else return "";
	}

	function startYearDay() {
		return strftime("%j",$this->_dtstart);
	}

	function byweekno($raw=false){
		if ($raw) return $this->_byweekno;
		if (isset($this->_byweekno) && $this->_byweekno!="") return $this->_byweekno;
		else return $this->startWeekNo();
	}

	function getByDay_weeks(){
		if (isset($this->_byday) && $this->_byday!="") {
			$days = explode(",",$this->_byday);
			if (count($days)==0) return $this->startWeekDay();
			$weeknums = array();
			foreach ($days as $day) {
				preg_match("/(\+|-?)(\d?)(.+)/",$day,$details);
				if (count($details)!=4) {
					echo "<br/><br/><b>PROBLEMS with $day</b><br/><br/>";
					return  $this->startWeekDay();
				}
				else {
					list($temp,$plusminus,$weeknumber,$dayname) = $details;
					if (!in_array($weeknumber,$weeknums)){
						$weeknums[]=$weeknumber;
					}
				}
			}
			// need to return as a string because of using old function later!!
			return implode("|",$weeknums);
		}
		return $this->startWeekNo();
	}

	function startWeekNo() {

		$cfg = & JEVConfig::getInstance();
		$fmt = ($cfg->get("com_starday")==0)?"%U":"%W";
		return strftime($fmt,$this->_dtstart);
	}

	function startWeekOfMonth() {
		$md = $this->startMonthDay();
		return ceil($md/7);
	}

	function bymonthday($raw=false) {
		if ($raw) return $this->_bymonthday;
		// TODO consider relaxing assumption that always + or - and not a mixture
		if (isset($this->_bymonthday) && $this->_bymonthday!=""){
			$temp = $this->_bymonthday;
			$temp = str_replace("+","",$temp);
			$temp = str_replace("-","",$temp);
			return $temp;
		}
		else return $this->startMonthDay();
	}

	function startMonthDay() {
		return intval(strftime("%d",$this->_dtstart));
	}

	function bymonth($raw=false){
		if ($raw) return $this->_bymonth;
		if (isset($this->_bymonth) && $this->_bymonth!="") return $this->_bymonth;
		else return $this->startMonth();
	}

	function startMonth() {
		return intval(strftime("%m",$this->_dtstart));
	}


	function getByDirectionChecked($direction = "byday"){
		if ($this->getByDirection($direction)){
			return "";
		}
		else {
			return "checked";
		}
	}

	/**
	 * Returns true if from start of period otheriwse false if counting back
	 */
	function getByDirection($direction = "byday"){
		$direction = "_".$direction;
		if (isset($this->$direction) && $this->$direction!="") {
			$parts = explode(",",$this->$direction);
			if (count($parts)==0) return true;
			foreach ($parts as $part) {
				preg_match("/(\+|-?)(\d?)(.+)/",$part,$details);
				if (count($details)!=4) {
					return true;
				}
				else {
					list($temp,$plusminus,$number,$name) = $details;
					if ($plusminus=="-") {
						return false;
					}
					else {
						return true;
					}
				}
			}
			// just in case
			return true;
		}
		else {
			return true;
		}
	}

	function getByDay_days(){
		static $weekdayMap=array("SU"=>0,"MO"=>1,"TU"=>2,"WE"=>3,"TH"=>4,"FR"=>5,"SA"=>6);
		if (isset($this->_byday) && $this->_byday!="") {
			$days = explode(",",$this->_byday);
			if (count($days)==0) return $this->startWeekDay();
			$weekdays = array();
			foreach ($days as $day) {
				preg_match("/(\+|-?)(\d?)(.+)/",$day,$details);
				if (count($details)!=4) {
					echo "<br/><br/><b>PROBLEMS with $day</b><br/><br/>";
					return  $this->startWeekDay();
				}
				else {
					list($temp,$plusminus,$weeknumber,$dayname) = $details;
					if (!in_array($weekdayMap[$dayname],$weekdays)){
						$weekdays[]=$weekdayMap[$dayname];
					}
				}
			}
			// need to return as a string because of using old function later!!
			return implode("|",$weekdays);
		}
		else return $this->startWeekDay();
	}

	function startWeekDay() {
		return intval(strftime("%w",$this->_dtstart));
	}

	function isEditable(){
		return true;
	}

	function publishLink($sef=false ){
		$Itemid	= JEVHelper::getItemid();
		// I need $year,$month,$day So that I can return to an appropriate date after deleting a repetition!!!
		list($year,$month,$day) = JEVHelper::getYMD();		
		$link ="index.php?option=".JEV_COM_COMPONENT."&task=".$this->publishTask().'&cid[]='. $this->ev_id().'&Itemid='.$Itemid."&year=$year&month=$month&day=$day" ;
		$link = $sef?JRoute::_( $link  ):$link;
		return $link;
	}

	function unpublishLink($sef=false ){
		$Itemid	= JEVHelper::getItemid();
		// I need $year,$month,$day So that I can return to an appropriate date after deleting a repetition!!!
		list($year,$month,$day) = JEVHelper::getYMD();		
		$link ="index.php?option=".JEV_COM_COMPONENT."&task=".$this->unpublishTask().'&cid[]='. $this->ev_id().'&Itemid='.$Itemid."&year=$year&month=$month&day=$day" ;
		$link = $sef?JRoute::_( $link  ):$link;
		return $link;
	}
	
	function editTask(){
		return "icalevent.edit";
	}

	function editCopyTask(){
		return "icalevent.editcopy";
	}
	
	function deleteTask(){
		return "icalevent.delete";
	}

	function detailTask(){
		return "icalevent.detail";
	}

	function publishTask(){
		return "icalevent.publish";
	}

	function unpublishTask(){
		return "icalevent.unpublish";
	}

	function id() {
		if (!isset($this->_ev_id)) return 0;
		return $this->_ev_id;
	}
	
	function uid() {
		if (!isset($this->_uid)) return 0;
		return $this->_uid;
	}

	// Note for and icaldb event a single repetition represents the single event

	function getCategoryName( ){
		return parent::getCategoryName();
	}

	// Dont report hists for a ICS entry
	function reportHits(){	}

	/**
	 * export in ICAL format
	 *
	 */
	function export(){

	}

	function repeatSummary(){
		$sum = "";
		$cfg = & JEVConfig::getInstance();

		// i.e. 1 = follow english word order by default
		$grammar = intval(JText::_('JEV_REPEAT_GRAMMAR'));

		if ($this->alldayevent()){
			if( $this->start_date == $this->stop_date ){
				$sum.= $this->start_date;
			}
			else {
				$sum.= JText::_('JEV_FROM') . '&nbsp;' . $this->start_date . '<br />'
				. JText::_('JEV_TO') . '&nbsp;' . $this->stop_date . '<br/>';
			}
		}
		// if starttime and end time the same then show no times!
		else if( $this->start_date == $this->stop_date ){
			if ($this->noendtime()){
				$sum.= $this->start_date . ',&nbsp;' . $this->start_time . '<br/>';				
			}
			else if (($this->start_time != $this->stop_time) && !($this->alldayevent())){
				$sum.= $this->start_date . ',&nbsp;' . $this->start_time
				. '&nbsp;-&nbsp;' . $this->stop_time . '<br/>';
			} else {
				$sum.= $this->start_date . '<br/>';
			}
		} else {
			// recurring events should have time related to recurrance not range of dates
			if ($this->noendtime() && !($this->reccurtype() > 0)){
				$sum.= $this->start_date . ',&nbsp;' . $this->start_time . '<br/>';				
			}
			else if ($this->start_time != $this->stop_time && !($this->reccurtype() > 0)) {
				$sum.= JText::_('JEV_FROM') . '&nbsp;' . $this->start_date . '&nbsp;-&nbsp; '
				. $this->start_time . '<br />'
				. JText::_('JEV_TO') . '&nbsp;' . $this->stop_date . '&nbsp;-&nbsp;'
				. $this->stop_time . '<br/>';
			} else {
				$sum.= JText::_('JEV_FROM') . '&nbsp;' . $this->start_date . '<br />'
				. JText::_('JEV_TO') . '&nbsp;' . $this->stop_date . '<br/>';
			}
		}
		if ($this->_freq=="none"){
			return $sum;
		}
		
		return $sum;
		// TODO consider finishing this later - it is VERY COMPLICATED
		if ($this->_interval>0){
			if ($this->_interval==1){
				switch ($this->_freq){
					case 'DAILY': $reccur = JText::_('JEV_ALLDAYS');     break;
					case 'WEEKLY': $reccur = JText::_('JEV_EACHWEEK');    break;
					case 'MONTHLY': $reccur = JText::_('JEV_EACHMONTH');  break;
					case 'YEARLY': $reccur = JText::_('JEV_EACHYEAR');    break;
				}
			}
			else {
				switch ($this->_freq){
					case 'DAILY': $reccur = JText::_('JEV_EVERY_N_DAYS');     break;
					case 'WEEKLY': $reccur = JText::_('JEV_EVERY_N_WEEKS');    break;
					case 'MONTHLY': $reccur = JText::_('JEV_EVERY_N_MONTHS');  break;
					case 'YEARLY': $reccur = JText::_('JEV_EVERY_N_YEARS');    break;
				}
				$reccur = sprintf($reccur,$this->_interval);
			}
			if ($this->_count==99999){
				list ($y,$m,$d) = explode(":",strftime("%Y:%m:%d",$this->until()));
				$extra = JText::_('JEV_UNTIL')."&nbsp;".JEventsHTML::getDateFormat($y,$m,$d,1);
			}
			else {
				$extra = sprintf(JText::_('JEV_COUNTREPEATS'), $this->_count);
			}
			$sum.= $reccur."&nbsp;".$extra;
		}
		return $sum;
	}

	function previousnextLinks(){ return "";}

	function prevRepeat(){
		return "";
	}

	function nextRepeat(){
		return "";
	}
	
	// Gets repeats for this event from databases
	function getFirstRepeat(){
		$db =& JFactory::getDBO();
		$query = "SELECT ev.*, rpt.*, rr.*, det.* "
		. "\n , YEAR(rpt.startrepeat) as yup, MONTH(rpt.startrepeat ) as mup, DAYOFMONTH(rpt.startrepeat ) as dup"
		. "\n , YEAR(rpt.endrepeat  ) as ydn, MONTH(rpt.endrepeat   ) as mdn, DAYOFMONTH(rpt.endrepeat   ) as ddn"
		. "\n , HOUR(rpt.startrepeat) as hup, MINUTE(rpt.startrepeat ) as minup, SECOND(rpt.startrepeat ) as sup"
		. "\n , HOUR(rpt.endrepeat  ) as hdn, MINUTE(rpt.endrepeat   ) as mindn, SECOND(rpt.endrepeat   ) as sdn"
		. "\n FROM #__jevents_vevent as ev "
		. "\n LEFT JOIN #__jevents_repetition as rpt ON rpt.eventid = ev.ev_id"
		. "\n LEFT JOIN #__jevents_vevdetail as det ON det.evdet_id = rpt.eventdetail_id"
		. "\n LEFT JOIN #__jevents_rrule as rr ON rr.eventid = ev.ev_id"
		. "\n WHERE ev.ev_id = '".$this->ev_id()."' ORDER BY rpt.startrepeat asc LIMIT 1" ;

		$db->setQuery( $query );
		$rows = $db->loadObjectList();

		// iCal agid uses GUID or UUID as identifier
		if( $rows ){
			$row = new jIcalEventRepeat($rows[0]);
		}
		return $row;
	}

	function updateHits(){
		$db =& JFactory::getDBO();

		// Should this happen here?
		$query = "UPDATE #__jevents_vevdetail SET hits=(hits+1) WHERE evdet_id='".$this->evdet_id()."'"	;
		$db->setQuery( $query );
		if( !$db->query() ) {
			echo "<script> alert('".$db->getErrorMsg()."'); window.history.go(-1); </script>\n";
			exit();
		}
		$this->_hits++;

	}
	
	function creatorName(){
		if (!isset($this->_creatorname)){
			$user = JFactory::getUser($this->_created_by);
			$this->_creatorname = $user->username. "(".$user->name.")";
		}
		return $this->_creatorname;
	}
}
