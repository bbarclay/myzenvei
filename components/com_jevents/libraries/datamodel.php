<?php
/**
 * JEvents Component for Joomla 1.5.x
 *
 * @version     $Id: datamodel.php 1632 2009-11-27 02:59:08Z geraint $
 * @package     JEvents
 * @copyright   Copyright (C) 2008-2009 GWE Systems Ltd, 2006-2008 JEvents Project Group
 * @license     GNU/GPLv2, see http://www.gnu.org/licenses/gpl-2.0.html
 * @link        http://www.jevents.net
 */

// functions common to component and modules
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

class JEventsDataModel {
	var $myItemid = null;
	var $catidsOut = "";
	var $catids = null;
	var $catidList = null;

	var $gid = null;
	var $aid = null;

	// flag to track if we should who all categories 
	var $moduleAllCats = false;
	
	var $queryModel;

	function  JEventsDataModel($dbmodel=null){
		$cfg = & JEVConfig::getInstance();
		$user =& JFactory::getUser();
		$this->gid = intval( $user->gid);
		$this->aid = intval( $user->aid);

		if (is_null($dbmodel)){
			$this->queryModel =new JEventsDBModel($this);
		}
		else {
			include_once(JPATH_ADMINISTRATOR."/components/".JEV_COM_COMPONENT."/libraries/adminqueries.php");
			$this->queryModel = new $dbmodel($this);
		}

	}

	function setupModuleCatids($modparams){
		$this->myItemid = findAppropriateMenuID ($this->catidsOut, $this->catids, $this->catidList, $modparams->toObject(), $this->moduleAllCats);
		return $this->myItemid;
	}

	function setupComponentCatids(){
		// if no catids from GET or POST default to the menu values
		// Note that module links must pass a non default value
		global $mainframe;
		$Itemid = JEVHelper::getItemid();
		$this->myItemid = $Itemid;

		$menu	=& JSite::getMenu();
		$active = $menu->getActive();
		if (!is_null($active) && $active->component==JEV_COM_COMPONENT){		
			$params	=&  JComponentHelper::getParams(JEV_COM_COMPONENT);
		}
		else {
			// If accessing this function from outside the component then I must load suitable parameters
			$params = $menu->getParams($this->myItemid);
		}

		$catidsIn		= JRequest::getVar(	'catids', 		'NONE' ) ;
		$this->catids = array();
		if ($catidsIn == "NONE") {
			$this->catidList	= "";

			for ($c=0; $c < 999; $c++) {
				$nextCID = "catid$c";
				//  stop looking for more catids when you reach the last one!
				if (!$nextCatId = $params->get( $nextCID, null)) {
					break;
				}
				if ( !in_array( $nextCatId, $this->catids )){
					$this->catids[]	= $nextCatId;
					$this->catidList	.= ( strlen( $this->catidList )>0 ? ',' : '' ) . $nextCatId;
				}
			}
			$this->catidsOut = str_replace( ',', '|', $this->catidList );
		}
		else {
			$this->catids = explode( '|', $catidsIn );
			// hardening!
			$this->catidList = JEVHelper::forceIntegerArray($this->catids,true);
			$this->catidsOut = str_replace(',', '|', $this->catidList);
		}

		// some functions e.g. JEventCal::viewDetailLink don't have access to a datamodel so set a global value
		// as a backup
		global $catidsOut;
		$catidsOut = $this->catidsOut;
	}

	/**
	 * Gets appropriate Itemid part of URL 
	 *
	 * @return string
	 */
	function getItemidLink($withAmp=true){
		if (!is_null($this->myItemid)){
			return ($withAmp?"&":"")."Itemid=".$this->myItemid;
		}
		else return "";
	}

	/**
	 * Gets appropriate category restriction part of URL 
	 * 
	 * @return string
	 */
	function getCatidsOutLink($withAmp=true){
		$ret = "";
		if ($this->catidsOut!=""){
			$ret .= ($withAmp?"&":"")."catids=".$this->catidsOut;
		}
		return $ret;
	}

	/**
	 * Gets calendar data for use in main calendar and module
	 *
	 * @param int $year
	 * @param int $month
	 * @param int $day
	 * @param boolean $short - use true for module which only requires knowledge of if dat has an event
	 * @param boolean $veryshort - use true for module which only requires dates and nothing about events
	 * @return array - calendar data array
	 */
	function getCalendarData( $year, $month, $day , $short=false, $veryshort = false){
		global $mainframe;

		$data = array();
		$data['year']=$year;
		$data['month']=$month;

		$db	=& JFactory::getDBO();

		if (!isset($this->myItemid) || is_null($this->myItemid)) {
			$Itemid = JEVHelper::getItemid();
			$this->myItemid = $Itemid;
		}

		include_once(JPATH_ADMINISTRATOR."/components/".JEV_COM_COMPONENT."/libraries/colorMap.php");

		$cfg = & JEVConfig::getInstance();

		if (!$veryshort){
			//$rows = $this->queryModel->listEventsByMonthNEW( $year, $month, 'reccurtype ASC,publish_up');
			$icalrows = $this->queryModel->listIcalEventsByMonth( $year, $month);

			// handy for developement in case I comment out part of the above
			if (!isset($rows)) $rows = array();
			if (!isset($icalrows)) $icalrows = array();
			$rows = array_merge($icalrows,$rows);
		}
		else {
			$rows = array();
		}
		$rowcount = count( $rows );

		if (strlen($this->catidsOut)>0) {
			$cat = "&catids=$this->catidsOut";
		} else {
			$cat="";
		}
	
		$month = intval($month);
		if( $month <= '9' ) {
			$month = '0' . $month;
		}

		$fieldsetText = "";
		$yearNow = date("Y");
		$monthNow = date("m");
		$dayNow = intval(date("d"));
		if (!$short){
			if ($year==$yearNow && $month==$monthNow && $day==$dayNow){
				$fieldsetText = JEventsHTML::getDateFormat( $year, $month, $day, 1 );
			}
			else $fieldsetText = JEventsHTML::getDateFormat( $year, $month, "", 3 );
			$data["fieldsetText"]=$fieldsetText;
		}
		$startday = $cfg->get('com_starday');
		if(( !$startday ) || ( $startday > 1 )){
			$startday = 0;
		}
		$data['startday']=$startday;
		if (!$short){
			$data["daynames"]=array();
			for( $i = 0; $i < 7; $i++ ) {
				$data["daynames"][$i]=JEventsHTML::getDayName(($i+$startday)%7, true );
			}
		}

		$data["dates"]=array();
		//Start days
		$start = (( date( 'w', mktime( 0, 0, 0, $month, 1, $year )) - $startday + 7 ) % 7 );
		$base = date( 't', mktime( 0, 0, 0, $month, 0, $year ));
		$dayCount=0;
		$priorMonth = $month-1;
		$priorYear = $year;
		if ($priorMonth<=0) {
			$priorMonth+=12;
			$priorYear-=1;
		}
		for( $a = $start; $a > 0; $a-- ){
			$d =  intval($base - $a + 1);

			$data["dates"][$dayCount]=array();
			$data["dates"][$dayCount]["monthType"]="prior";
			$data["dates"][$dayCount]["month"]=$priorMonth;
			$data["dates"][$dayCount]["year"]=$priorYear;
			$data["dates"][$dayCount]['countDisplay']=0;
			if( $d <= '9' ) {
				$do = '0' . $d;
			} else {
				$do = $d;
			}
			$data["dates"][$dayCount]['d']=$d;
			$data["dates"][$dayCount]['d0']=$do;

			if ($short){
				$data["dates"][$dayCount]["events"]=false;
			}
			else {
				$data["dates"][$dayCount]["events"]=array();
			}

			$cellDate		= mktime (0, 0, 0, $priorMonth, $d, $priorYear);
			$data["dates"][$dayCount]['cellDate']=$cellDate;

			$data["dates"][$dayCount]["today"]=false;

			$link = JRoute::_( 'index.php?option=' . JEV_COM_COMPONENT . '&task=day.listevents&year='
			. $priorYear . '&month=' . $priorMonth . '&day=' . $do .$cat. '&Itemid=' . $this->myItemid );

			$data["dates"][$dayCount]["link"]=$link;
			$dayCount++;
		}
		sort($data["dates"]);

		//Current month
		$end = date( 't', mktime( 0, 0, 0,( $month + 1 ), 0, $year ));
		for( $d = 1; $d <= $end; $d++ ){
			$data["dates"][$dayCount]=array();
			// utility field used to keep track of events displayed in a day!
			$data["dates"][$dayCount]['countDisplay']=0;
			$data["dates"][$dayCount]["monthType"]="current";
			$data["dates"][$dayCount]["month"]=$month;
			$data["dates"][$dayCount]["year"]=$year;

			if ($short){
				$data["dates"][$dayCount]["events"]=false;
			}
			else {
				$data["dates"][$dayCount]["events"]=array();
			}
			$t_datenow = JEVHelper::getNow();
			$now_adjusted = $t_datenow->toUnix(true);
			if( $month == strftime( '%m', $now_adjusted)
			&& $year == strftime( '%Y', $now_adjusted)
			&& $d == strftime( '%d', $now_adjusted)) {
				$data["dates"][$dayCount]["today"]=true;
			}else{
				$data["dates"][$dayCount]["today"]=false;
			}

			if( $d <= '9') {
				$do = '0' . $d;
			} else {
				$do = $d;
			}

			$data["dates"][$dayCount]['d']=$d;
			$data["dates"][$dayCount]['d0']=$do;

			$link = JRoute::_( 'index.php?option=' . JEV_COM_COMPONENT . '&task=day.listevents&year='
			. $year . '&month=' . $month . '&day=' . $do .$cat. '&Itemid=' . $this->myItemid );
			$data["dates"][$dayCount]["link"]=$link;

			$cellDate		= mktime (0, 0, 0, $month, $d, $year);
			$data["dates"][$dayCount]['cellDate']=$cellDate;
			//$data["dates"][$dayCount]['events'] = array();

			if( $rowcount > 0 ){
				foreach ($rows as $row) {

					if ($row->checkRepeatMonth($cellDate,$year,$month))  {

					
						if ($short){
							$data["dates"][$dayCount]['events']=true;
							// I can skip testing all the events since checkRepeatMonth tests for multiday events to make xure they only appear
							// on secondary days if the multiday flag is set to 1
							break;
						}
						else {
							$i=count($data["dates"][$dayCount]['events']);
							$data["dates"][$dayCount]['events'][$i] = $row;
						}
					}
				}
			}
			// sort events of this day by time
			if (is_array($data["dates"][$dayCount]['events'])) {
				usort($data["dates"][$dayCount]['events'],array("JEventsDataModel", "_sortEventsByTime"));
			}
			$dayCount++;
		}

		$days 	= ( 7 - date( 'w', mktime( 0, 0, 0, $month + 1, 1, $year )) + $startday ) %7;
		$d		= 1;

		$followMonth = $month+1;
		$followYear = $year;
		if ($followMonth>12) {
			$followMonth-=12;
			$followYear+=1;
		}
		$data["followingMonth"]=array();
		for( $d = 1; $d <= $days; $d++ ) {

			$data["dates"][$dayCount]=array();
			$data["dates"][$dayCount]["monthType"]="following";
			$data["dates"][$dayCount]["month"]=$followMonth;
			$data["dates"][$dayCount]["year"]=$followYear;
			$data["dates"][$dayCount]['countDisplay']=0;
			if( $d <= '9') {
				$do = '0' . $d;
			} else {
				$do = $d;
			}

			$data["dates"][$dayCount]['d']=$d;
			$data["dates"][$dayCount]['d0']=$do;

			if ($short){
				$data["dates"][$dayCount]["events"]=false;
			}
			else {
				$data["dates"][$dayCount]["events"]=array();
			}

			$cellDate		= mktime (0, 0, 0, $followMonth, $d, $followYear);
			$data["dates"][$dayCount]['cellDate']=$cellDate;

			$data["dates"][$dayCount]["today"]=false;

			$link = JRoute::_( 'index.php?option=' . JEV_COM_COMPONENT . '&task=day.listevents&year='
			. $followYear . '&month=' . $followMonth . '&day=' . $do .$cat. '&Itemid=' . $this->myItemid );

			$data["dates"][$dayCount]["link"]=$link;
			$dayCount++;
		}

		// Week data and links
		$data["weeks"]=array();
		for ($w=0;$w<6 && $w*7<count($data["dates"]);$w++){
			$date = $data["dates"][$w*7]['cellDate'];
			$day = $data["dates"][$w*7]["d"];
			$month = $data["dates"][$w*7]["month"];
			$year = $data["dates"][$w*7]["year"];
			// get week number from second weekday to avoid confusion with week start sunday
			$week = intval(JEV_CommonFunctions::jev_strftime("%V",$date+86400));
			$link = JRoute::_( 'index.php?option=' . JEV_COM_COMPONENT . '&task=week.listevents&year='
			. $year . '&month=' . $month . '&day=' . $day .$cat. '&Itemid=' . $this->myItemid );
			$data["weeks"][$week]=$link;
		}

		return $data;
	}


	function getYearData($year, $limit, $limitstart )
	{
		global $mainframe;

		$data = array();
		$data ["year"]=$year;

		$db	=& JFactory::getDBO();

		$cfg = & JEVConfig::getInstance();

		include_once(JPATH_ADMINISTRATOR."/components/".JEV_COM_COMPONENT."/libraries/colorMap.php");

		$data ["limit"] = $limit;

		if ($data ["limit"]>0){

			$counter = $this->queryModel->countIcalEventsByYear( $year,  $cfg->get('com_showrepeats'));

			$data["total"] =  $counter ;

			if( $data["total"] <= $data ["limit"] ) {
				$limitstart = 0;
			}
			$data ["limitstart"]=$limitstart;
		}
		else {
			$data["total"]=0;
			$data ["limitstart"]=0;
		}

		$data["months"]=array();
		$rows = $this->queryModel->listIcalEventsByYear( $year, $data ["limitstart"], $data ["limit"],  $cfg->get('com_showrepeats'));

		$num_events = count( $rows );

		for($month = 1; $month <= 12; $month++) {
			$data["months"][$month] = array();
			$data["months"][$month]["rows"] = array();
			for( $r = 0; $r < $num_events; $r++ ) {
				$row =& $rows[$r];
				if ($month == $row->mup() && $row->yup()==$year){
					$count = count($data["months"][$month]["rows"]);
					$data["months"][$month]["rows"][$count] = $row;
				}
			}
		}

		//global $mainframe;
		//include_once(JPATH_BASE."/components/".JEV_COM_COMPONENT."/libraries/iCalImport.php");
		//iCalHelper::getHolidayDataForYear($data, "USHolidays.ics");

		return $data;
	}

	function getRangeData($start,$end, $limit, $limitstart )
	{
		global $mainframe;

		$data = array();

		$db	=& JFactory::getDBO();

		$cfg = & JEVConfig::getInstance();

		include_once(JPATH_ADMINISTRATOR."/components/".JEV_COM_COMPONENT."/libraries/colorMap.php");

		$data ["limit"] = $limit;

		if ($data ["limit"]>0){

			$counter = $this->queryModel->countIcalEventsByRange( $start,$end,  $cfg->get('com_showrepeats'));

			$data["total"] =  $counter ;

			if( $data["total"] <= $data ["limit"] ) {
				$limitstart = 0;
			}
			$data ["limitstart"]=$limitstart;
		}
		else {
			$data["total"]=0;
			$data ["limitstart"]=0;
		}

		$data["rows"] = $this->queryModel->listIcalEventsByRange( $start,$end, $data ["limitstart"], $data ["limit"],  $cfg->get('com_showrepeats'));

		return $data;
	}

	/**
	 * gets structured week data
	 *
	 * @param int $year
	 * @param int $month
	 * @param int $day
	 * @param boolean $detailedDay when true gives hour by hour data for the day $day
	 * @return unknown
	 */
	function getWeekData($year, $month, $day, $detailedDay=false) {

		global $mainframe;
		$Itemid = JEVHelper::getItemid();
		$db	=& JFactory::getDBO();

		$cat = "";
		if ($this->catidsOut != 0){
			$cat = '&catids='.$this->catidsOut;
		}

		$cfg = & JEVConfig::getInstance();

		include_once(JPATH_ADMINISTRATOR."/components/".JEV_COM_COMPONENT."/libraries/colorMap.php");

		$data = array();
		$indate = mktime( 0, 0, 0, $month, $day, $year) ;
		$startday 	= $cfg->get('com_starday', 0);
		$numday		= (( date( 'w', $indate) - $startday + 7) %7 );

		$week_start = mktime( 0, 0, 0, $month, ( $day - $numday ), $year );
		$week_end = mktime( 0, 0, 0, $month, ( $day - $numday )+6, $year ); // + 6 for inclusinve week

		$rows = $this->queryModel->listEventsByWeekNEW(strftime("%Y-%m-%d",$week_start),strftime("%Y-%m-%d",$week_end));

		$icalrows = $this->queryModel->listIcalEventsByWeek( $week_start, $week_end);

		$rows = array_merge($icalrows,$rows);
		$rowcount = count( $rows );

		$data['startdate']	= JEventsHTML::getDateFormat( strftime("%Y",$week_start), strftime("%m",$week_start), strftime("%d",$week_start), 1 );
		$data['enddate']	= JEventsHTML::getDateFormat( strftime("%Y",$week_end), strftime("%m",$week_end), strftime("%d",$week_end), 1 );

		$data['days'] = array();

		for( $d = 0; $d < 7; $d++ ){
			$data['days'][$d] = array();
			$data['days'][$d]['rows'] = array();

			$this_currentdate = mktime( 0, 0, 0, $month, ( $day - $numday + $d ), $year );

			$data['days'][$d]['week_day'] = strftime("%d",$this_currentdate);
			$data['days'][$d]['week_month'] = strftime("%m",$this_currentdate);
			$data['days'][$d]['week_year'] = strftime("%Y",$this_currentdate);

			// This is really view specific - remove it later
			$data['days'][$d]['link']= JRoute::_( 'index.php?option='.JEV_COM_COMPONENT.'&task=day.listevents&year='.$data['days'][$d]['week_year'].'&month='.$data['days'][$d]['week_month'].'&day='.$data['days'][$d]['week_day'].'&Itemid='.$Itemid . $cat);

			$t_datenow = JEVHelper::getNow();
			$now_adjusted = $t_datenow->toUnix(true);
			if( strftime('%Y-%m-%d',$this_currentdate) == strftime('%Y-%m-%d', $now_adjusted ))
			{
				$data['days'][$d]['today']=true;
				$data['days']['today']=$d;
			}
			else
			{
				$data['days'][$d]['today']=false;
			}

			if ($detailedDay && ($this_currentdate==$indate)){
				$this->_populateHourData($data, $rows, $indate);
			}

			$num_events		= count( $rows );
			$countprint		= 0;

			for( $r = 0; $r < $num_events; $r++ ){
				$row = $rows[$r];
				if ($row->checkRepeatWeek($this_currentdate,$week_start,$week_end))  {

					$count = count($data['days'][$d]['rows']);
					$data['days'][$d]['rows'][$count] = $row;
				}
			}
			// sort events of this day by time
			usort($data['days'][$d]['rows'],array("JEventsDataModel", "_sortEventsByTime"));
		}

		return $data;
	}

	function _populateHourData(&$data, $rows, $target_date){
		$num_events			= count( $rows );

		$data['hours']=array();
		$data['hours']['timeless']=array();
		$data['hours']['timeless']['events']=array();

		// Timeless events
		for( $r = 0; $r < $num_events; $r++ ){
			$row =& $rows[$r];
			if ($row->checkRepeatDay($target_date))  {

				if ($row->alldayevent() || (!$row->noendtime() && ($row->hup()==$row->hdn() && $row->minup()==$row->mindn() && $row->sup()==$row->sdn()))){
					$count = count($data['hours']['timeless']['events']);
					$data['hours']['timeless']['events'][$count]=$row;
				}
			}
		}

		for ($h=0;$h<24;$h++){
			$data['hours'][$h]=array();
			$data['hours'][$h]['hour_start'] = $target_date+($h*3600);
			$data['hours'][$h]['hour_end'] = $target_date+59+(59*60)+($h*3600);
			$data['hours'][$h]['events'] = array();

			for( $r = 0; $r < $num_events; $r++ ){
				$row =& $rows[$r];
				if ($row->checkRepeatDay($target_date))  {
					if ($row->alldayevent() || (!$row->noendtime() && ($row->hup()==$row->hdn() && $row->minup()==$row->mindn() && $row->sup()==$row->sdn()))){
						// Ignore timeless events
					}
					else if ($row->hup()==$h && $row->minup()<=59 && $row->sup()<=59){

						$count = count($data['hours'][$h]['events']);
						$data['hours'][$h]['events'][$count]=$row;
					}

				}
			}
			// sort events of this day by time
			usort($data['hours'][$h]['events'],array("JEventsDataModel", "_sortEventsByTime"));
		}

	}

	function getDayData($year, $month, $day) {
		global $mainframe;

		include_once(JPATH_ADMINISTRATOR."/components/".JEV_COM_COMPONENT."/libraries/colorMap.php");

		$data = array();

		$target_date = mktime(0,0,0,$month,$day,$year);
		$rows	= $this->queryModel->listEventsByDateNEW( strftime("%Y-%m-%d",$target_date ));
		$icalrows = $this->queryModel->listIcalEventsByDay($target_date);

		$rows = array_merge($icalrows,$rows);

		$this->_populateHourData($data, $rows, $target_date);

		return $data;
	}

	function getEventData( $rpid, $jevtype, $year, $month, $day, $uid="" ) {
		$data = array();

		global  $mainframe;
		$pop = intval(JRequest::getVar( 'pop', 0 ));
		$Itemid = JEVHelper::getItemid();
		$db	=& JFactory::getDBO();

		$cfg = & JEVConfig::getInstance();

		$row = $this->queryModel->listEventsById ($rpid, 1, $jevtype);  // include unpublished events for publishers and above

		$num_row = count($row);

		// No matching rows - use uid as alternative
		if ($num_row==0 && strlen($uid)>0){
			$rpid = $this->queryModel->findMatchingRepeat($uid, $year, $month, $day);
			if (isset($rpid) && $rpid>0){
				$row = $this->queryModel->listEventsById ($rpid, 1, $jevtype);  // include unpublished events for publishers and above
				$num_row = count($row);
			}
		}
		
		if( $num_row ){

			// process the new plugins
			$dispatcher	=& JDispatcher::getInstance();
			$dispatcher->trigger('onGetEventData', array (& $row));

			$params =new JParameter(null);
			$row->contactlink = JEventsHTML::getUserMailtoLink( $row->id(), $row->created_by() );

			$event_up = new JEventDate( $row->publish_up() );
			$row->start_date = JEventsHTML::getDateFormat( $event_up->year, $event_up->month, $event_up->day, 0 );
			$row->start_time = ( $cfg->get('com_calUseStdTime')== '1' ) ? $event_up->get12hrTime() : $event_up->get24hrTime();


			$event_down = new JEventDate( $row->publish_down() );
			$row->stop_date = JEventsHTML::getDateFormat( $event_down->year, $event_down->month, $event_down->day, 0 );
			$row->stop_time = ( $cfg->get('com_calUseStdTime') == '1' ) ? $event_down->get12hrTime() : $event_down->get24hrTime();

			// *******************
			// ** This cloaking should be done by mambot/Joomla function
			// *******************

			// Parse http and  wrap in <a> tag
			// trigger content plugin

			$pattern = '[a-zA-Z0-9&?_.,=%\-\/]';

			// Adresse
			// don't convert address that already has a link tag
			if (strpos($row->location(),'<a href=')===false){
				$row->location(preg_replace('#(http://)('.$pattern.'*)#i', '<a href="\\1\\2">\\1\\2</a>', $row->location()));
			}
			$tmprow = new stdClass();
			$tmprow->text = $row->location();
			
			$dispatcher	=& JDispatcher::getInstance();
			JPluginHelper::importPlugin('content');
			
			$dispatcher->trigger( 'onPrepareContent', array( &$tmprow, &$params, 0 ));
			$row->location($tmprow->text);

			//Contact
			if (strpos($row->contact_info(),'<a href=')===false){
				$row->contact_info(preg_replace('#(http://)('.$pattern.'*)#i', '<a href="\\1\\2">\\1\\2</a>', $row->contact_info()));
			}
			$tmprow = new stdClass();
			$tmprow->text = $row->contact_info();

			$dispatcher->trigger( 'onPrepareContent', array( &$tmprow, &$params, 0 ));
			$row->contact_info($tmprow->text);

			//Extra
			if (strpos($row->extra_info(),'<a href=')===false){
				$row->extra_info(preg_replace('#(http://)('.$pattern.'*)#i', '<a href="\\1\\2">\\1\\2</a>', $row->extra_info()));
			}
			//$row->extra_info(eregi_replace('[^(href=|href="|href=\')](((f|ht){1}tp://)[-a-zA-Z0-9@:%_\+.~#?&//=]+)','\\1', $row->extra_info()));
			$tmprow = new stdClass();
			$tmprow->text = $row->extra_info();

			$dispatcher->trigger( 'onPrepareContent', array( &$tmprow, &$params, 0 ));
			$row->extra_info($tmprow->text);

			$mask = $mainframe->getCfg( 'hideAuthor' ) ? MASK_HIDEAUTHOR : 0;
			$mask |= $mainframe->getCfg( 'hideCreateDate' ) ? MASK_HIDECREATEDATE : 0;
			$mask |= $mainframe->getCfg( 'hideModifyDate' ) ? MASK_HIDEMODIFYDATE : 0;

			$mask |= $mainframe->getCfg( 'hidePdf' ) ? MASK_HIDEPDF : 0;
			$mask |= $mainframe->getCfg( 'hidePrint' ) ? MASK_HIDEPRINT : 0;
			$mask |= $mainframe->getCfg( 'hideEmail' ) ? MASK_HIDEEMAIL : 0;

			//$mask |= $mainframe->getCfg( 'vote' ) ? MASK_VOTES : 0;
			$mask |= $mainframe->getCfg( 'vote' ) ? (MASK_VOTES|MASK_VOTEFORM) : 0;
			$mask |= $pop ? MASK_POPUP | MASK_IMAGES | MASK_BACKTOLIST : 0;

			// Do main mambot processing here
			// process bots
			//$row->text      = $row->content;
			$params->set("image",1);
			$row->text = $row->content();

			$dispatcher->trigger( 'onPrepareContent', array( &$row, &$params, 0 ));
			$row->content( $row->text );

			$data['row']=$row;
			$data['mask']=$mask;

			$row->updateHits();

			return $data;

		}
		else return null;
	}

	function accessibleCategoryList($aid=null, $catids=null, $catidList=null){
		return $this->queryModel->accessibleCategoryList($aid, $catids, $catidList);
	}

	function getCatData( $catids, $showRepeats=true, $limit=0, $limitstart=0){
		$data = array();

		global   $mainframe;
		$Itemid = JEVHelper::getItemid();
		$db	=& JFactory::getDBO();
		include_once(JPATH_ADMINISTRATOR."/components/".JEV_COM_COMPONENT."/libraries/colorMap.php");

		$cfg = & JEVConfig::getInstance();

		$counter = $this->queryModel->countEventsByCat( $catids);
		$total = $this->queryModel->countIcalEventsByCat( $catids,$showRepeats);
		$counter += $total;

		$data ['total'] =  $counter ;
		//$limit = $limit ? $limit : $cfg->get('com_calEventListRowsPpg');

		if ( $data ['total']  <= $limit  || $limitstart > $data ['total']) {
			$limitstart = 0;
		}
		$data['limit']=$limit;
		$data['limitstart']=$limitstart;

		$rows 	  = $this->queryModel->listEventsByCat( $catids, $limitstart, $limit );
		$icalrows = $this->queryModel->listIcalEventsByCat( $catids,$showRepeats,$total, $limitstart, $limit );

		$rows = array_merge($icalrows,$rows);
		$num_events = count( $rows );

		if (count($catids)==0 || (count($catids)==1 && $catids[0]=="")){
			// We are using the filter instead
			$tempcat = JRequest::getVar("category_fv",0);
			$catids = array();
			$catids[] = $tempcat;
		}
		else {
			// Override multiple categories using the filter instead
			global $mainframe;
			$tempcat =$mainframe->getUserStateFromRequest( 'category_fv_ses', 'category_fv', 0);
			if ($tempcat>0){
				$catids = array();
				$catids[] = $tempcat;
			}
		}
		$catdesc = "";
		if (count($catids)>1){
			$catname = JText::_('JEV_EVENT_CHOOSE_CATEG');
		}
		if( $num_events > 0 ){
			$catname = $rows[0]->getCategoryName();
			$catdesc = $rows[0]->getCategoryDescription();
			foreach ($rows as $row) {
				if ($row->getCategoryName() != $catname){
					$catname = JText::_('JEV_EVENT_CHOOSE_CATEG');
					break;
				}
			}
		}
		else if( count($catids) == 0 ) {
			$catname = JText::_('JEV_EVENT_CHOOSE_CATEG');
		}
		else if (count($catids) == 1 ) {
			// get the cat name from the database
			$db	=& JFactory::getDBO();	
			$user =& JFactory::getUser();		
			$catsql = 'SELECT c.title, c.description FROM #__categories AS c' .
				' WHERE c.access<='.$db->Quote($user->aid) .
				' AND c.section = '.$db->Quote(JEV_COM_COMPONENT).
				' AND c.id = '.$db->Quote($catids[0]);
			$db->setQuery($catsql);
			$catdata = $db->loadObject();
			if ($catdata){
				$catname = $catdata->title;
				$catdesc = $catdata->description;
			}
			else {
				$catname = JText::_('JEV_EVENT_ALLCAT');
			}
		}
		$data['catname']=$catname;
		$data['catdesc']=$catdesc;
		$data['catids']=$catids;


		if( $num_events > 0 ){
			for( $r = 0; $r < $num_events; $r++ ){
				$row =& $rows[$r];

				$row->catname($catname); // for completeness of dataset
			}
		}
		$data['rows']=$rows;

		return $data;
	}

	function getKeywordData($keyword, $limit, $limitstart, $useRegX=true)
	{
		$data = array();

		global  $mainframe;
		$user =& JFactory::getUser();
		$aid = intval( $user->aid );
		$Itemid = JEVHelper::getItemid();
		$db	=& JFactory::getDBO();

		$cfg = & JEVConfig::getInstance();

		include_once(JPATH_ADMINISTRATOR."/components/".JEV_COM_COMPONENT."/libraries/colorMap.php");

		$keyword		= preg_replace( "/[[:space:]]+/", ' +', $keyword );
		$keyword		= trim( $keyword );
		$keyword		= preg_replace( "/\++/", '+', $keyword );
		$keywordcheck	= preg_replace( "/ |\+/", '', $keyword );
		$searchisValid	= false;
		$total			= 0;

		if( empty( $keyword ) || JString::strlen( $keywordcheck ) < 3 || $keyword == '%%' || $keywordcheck == '' ) {
			$keyword 	= JText::_('JEV_KEYWORD_NOT_VALID');
			$num_events = 0;
			$rows = array();
			$data['total'] = 0;
			$data['limit']=0;
			$data['limitstart']=0;
			$data['num_events']=0;
		} else {
			$searchisValid = true;

			$rows 		= $this->queryModel->listEventsByKeyword( $keyword, 'publish_up,catid', $limit, $limitstart, $total, $useRegX );
			$data['total'] = $total;
			$data['limit']=$limit;
			$data['limitstart']=$limitstart;

			$num_events = count( $rows );
			$data['num_events']=$num_events;
		}

		$chdate	= '';
		$chcat	= '';

		if( $num_events > 0 ){
			for( $r = 0; $r < $num_events; $r++ ){
				$row =& $rows[$r];

				$row->catname		= $row->getCategoryName( );
				$row->contactlink	= JEventsHTML::getUserMailtoLink( $row->id(), $row->created_by() );
				$row->bgcolor		= JEV_CommonFunctions::setColor($row);
				$row->fgcolor		= JevMapColor($row->bgcolor);

				$t_datenow = JEVHelper::getNow();
				$now_adjusted = $t_datenow->toUnix(true);
				if( $row->mup() == strftime( '%m', $now_adjusted)	&&
				$row->yup() == strftime( '%Y', $now_adjusted )&&
				$row->dup() == strftime( '%d', $now_adjusted))
				{
					$row->today=true;
				}
				else
				{
					$row->today=false;
				}
			}
		}

		$data['rows']=$rows;

		return $data;
	}

	function getDataForAdmin( $creator_id, $limit, $limitstart, $showrepeats = false ){

		$data= array();

		$is_event_editor = JEVHelper::isEventCreator();
		$user =& JFactory::getUser();
		$aid = intval( $user->aid );
		$Itemid = JEVHelper::getItemid();
		$user =& JFactory::getUser();

		$db	=& JFactory::getDBO();
		global $mainframe;

		$cfg = & JEVConfig::getInstance();

		include_once(JPATH_ADMINISTRATOR."/components/".JEV_COM_COMPONENT."/libraries/colorMap.php");

		// Note that these are the vevents not the repeats
		if (!$showrepeats) $total = $this->queryModel->countIcalEventsByCreator ($creator_id);
		else  $total = $this->queryModel->countIcalEventRepeatsByCreator ($creator_id);

		$data['total']=$total;

		$data['limit']=$limit;
		if( $data["total"] <= $data ["limit"] ) {
			$limitstart = 0;
		}
		$data ["limitstart"]=$limitstart;

		// Note that these are the vevents not the repeats
		if (!$showrepeats) $rows = $this->queryModel->listIcalEventsByCreator ($creator_id, $limitstart, $limit);
		else $rows = $this->queryModel->listIcalEventRepeatsByCreator ($creator_id, $limitstart, $limit);

		$adminView = true;
		$num_events = count( $rows );

		if( $num_events > 0 ){
			for( $r = 0; $r < $num_events; $r++ ) {
				$row =& $rows[$r];

				$row->catname($row->getCategoryName());
				$row->contactlink( JEventsHTML::getUserMailtoLink( $row->id(), $row->created_by(), true));
				$row->bgcolor		= JEV_CommonFunctions::setColor($row);
				$row->fgcolor		= JevMapColor($row->bgcolor);

			}
		}

		$data['rows']=$rows;
		return $data;
	}


	function getAdjacentMonth($data, $direction=1)
	{
		$cfg = & JEVConfig::getInstance();
		$monthResult = array();
		$d1 = mktime(0,0,0,intval($data['month'])+$direction,1,$data['year']);
		$monthResult['day1'] = $d1;
		$monthResult['lastday'] = date("t",$d1);
		$year = strftime("%Y",$d1);
		$monthResult['year'] = $year;
		$month = strftime("%m",$d1);
		$monthResult['month'] = $month;
		$monthResult['name'] = JEVHelper::getMonthName($month);
		$task = JRequest::getString('jevtask');
		$Itemid = JEVHelper::getItemid();
		if (isset($Itemid)) $item= "&Itemid=$Itemid";
		else $item="";
		$monthResult['link'] = JRoute::_("index.php?option=".JEV_COM_COMPONENT."&task=$task$item&year=$year&month=$month");
		return $monthResult;
	}

	function getPrecedingMonth($data)
	{
		return 	$this->getAdjacentMonth($data,-1);
	}
	function getFollowingMonth($data)
	{
		return 	$this->getAdjacentMonth($data,+1);
	}

	function getAdjacentWeek($year,$month,$day, $direction=1)
	{
		$d1 = mktime(0,0,0,$month,$day+$direction*7,$year);
		$day = strftime("%d",$d1);
		$year = strftime("%Y",$d1);
		$month = strftime("%m",$d1);
		$task = JRequest::getString('jevtask');
		$Itemid = JEVHelper::getItemid();
		if (isset($Itemid)) $item= "&Itemid=$Itemid";
		else $item="";
		return JRoute::_("index.php?option=".JEV_COM_COMPONENT."&task=$task$item&year=$year&month=$month&day=$day");
	}
	function getPrecedingWeek($year,$month,$day)
	{
		return 	$this->getAdjacentWeek($year,$month,$day,-1);
	}
	function getFollowingWeek($year,$month,$day)
	{
		return 	$this->getAdjacentWeek($year,$month,$day,+1);
	}
	function getAdjacentDay($year,$month,$day, $direction=1)
	{
		$d1 = mktime(0,0,0,$month,$day+$direction,$year);
		$day = strftime("%d",$d1);
		$year = strftime("%Y",$d1);
		$month = strftime("%m",$d1);
		$task = JRequest::getString('jevtask');
		$Itemid = JEVHelper::getItemid();
		if (isset($Itemid)) $item= "&Itemid=$Itemid";
		else $item="";
		return JRoute::_("index.php?option=".JEV_COM_COMPONENT."&task=$task$item&year=$year&month=$month&day=$day");
	}
	function getPrecedingDay($year,$month,$day)
	{
		return 	$this->getAdjacentDay($year,$month,$day,-1);
	}
	function getFollowingDay($year,$month,$day)
	{
		return 	$this->getAdjacentDay($year,$month,$day,+1);
	}

	/**
	 * Sort Events by time, use only for events of the same day
	 *
	 * @static
	 * @param object $a
	 * @param object $b
	 * @return boolean
	 */
	function _sortEventsByTime (&$a, &$b) {
		// this custom sort compare function compares the start times of events that are referenced by the a & b vars
		//if ($a->publish_up() == $b->publish_up()) return 0;

		list( $adate, $atime ) = explode( ' ', $a->publish_up() );
		list( $bdate, $btime ) = explode( ' ', $b->publish_up() );

		// allday events first, equal time sort by title
		$atime = $a->alldayevent() ? '00:00'.$a->title() : $atime.$a->title();
		$btime = $b->alldayevent() ? '00:00'.$b->title() : $btime.$b->title();
		return strcmp( $atime, $btime );

	}
}
