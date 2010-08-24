<?php
/**
 * JEvents Component for Joomla 1.5.x
 *
 * @version     $Id: commonfunctions.php 1549 2009-08-21 14:40:01Z geraint $
 * @package     JEvents
 * @copyright   Copyright (C) 2008-2009 GWE Systems Ltd, 2006-2008 JEvents Project Group
 * @license     GNU/GPLv2, see http://www.gnu.org/licenses/gpl-2.0.html
 * @link        http://www.jevents.net
 */

// functions common to component and modules
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

// Joomla 1.5
// tasker/controller
jimport('joomla.application.component.controller');

class JEV_CommonFunctions {

	function getJEventsViewName(){

		static $jEventsView;

		if (!isset($jEventsView)){
			$cfg = & JEVConfig::getInstance();
			// priority of view setting is url, cookie, config,
			$jEventsView = $cfg->get('com_calViewName',"default");
			$jEventsView = JRequest::getString("jevents_view",$jEventsView,"cookie");
			$jEventsView = JRequest::getString("jEV",$jEventsView);
			// security check
			if (!in_array($jEventsView, JEV_CommonFunctions::getJEventsViewList() )){
				$jEventsView = "default";
			}
		}
		return $jEventsView ;
	}

	function loadJEventsViewLang(){

		$jEventsView = JEV_CommonFunctions::getJEventsViewName();
		$lang =& JFactory::getLanguage();
		$lang->load(JEV_COM_COMPONENT."_".$jEventsView);
		
	}
	
	function getJEventsViewList(){

		static $jEventsViews;


		if (!isset($jEventsViews)){
			$jEventsViews = array();
			$handler = opendir(JPATH_SITE . "/components/".JEV_COM_COMPONENT."/views/");
			while ($file = readdir($handler)) {
				if ($file != '.' && $file != '..' && $file != '.svn' ){
					if (is_dir(JPATH_SITE . "/components/".JEV_COM_COMPONENT."/views/".$file) &&
					file_exists(JPATH_SITE . "/components/".JEV_COM_COMPONENT."/views/".$file."/month"))
						 $jEventsViews[] = $file;
				}
					
			}
		}
		return $jEventsViews ;
	}

	/**
 * get all events_categories to use category color
 * @return  object
 */
	function getCategoryData(){

		static $cats;
		if (!isset($cats)){
			$db	=& JFactory::getDBO();

			$sql = "SELECT c.*, e.color FROM #__jevents_categories AS e LEFT JOIN #__categories as c ON c.id=e.id";
			$db->setQuery( $sql);
			$cats = $db->loadObjectList('id');
		}
		return $cats;
	}

	function setColor($row){

		$cfg = & JEVConfig::getInstance();

		static $catData;
		if (!isset($catData))   $catData = JEV_CommonFunctions::getCategoryData();

		if (is_object($row) && strtolower(get_class($row))!="stdclass"){
			if( $cfg->get('com_calForceCatColorEventForm',2) == '2' ){
				$color = ($row->catid() > 0 ) ? $catData[$row->catid()]->color : '#333333';
			}
			else $color = $row->useCatColor() ? ( $row->catid() > 0 ) ? $catData[$row->catid()]->color : '#333333' : $row->color_bar();

		}
		else {
			if( $cfg->get('com_calForceCatColorEventForm',2) == '2' ){
				$color = ($row->catid > 0 ) ? $catData[$row->catid]->color : '#333333';
			}
			else $color = $row->useCatColor ? ( $row->catid > 0 ) ? $catData[$row->catid]->color : '#333333' : $row->color_bar;

		}

		//$color = $row->useCatColor ? ( $row->catid > 0 ) ? $catData[$row->catid]->color : '#333333' : $row->color_bar;
		return $color;
	}

	// defunct?
	function mosEventRepeatArrayMonth( $row=null, $year=null, $month=null) {
		// builds and returns array

		if( is_null( $row ) || is_null($year) || is_null( $month)) {
			$eventDays = array();
			return $eventDays;
		}

		$monthStartDate = mktime( 0,0,0, $month, 1, $year );
		$daysInMonth = intval(date("t",$monthStartDate ));
		$monthEndDate = mktime( 0,0,0, $month, $daysInMonth , $year );
		$monthEndSecond = mktime( 23,59,59, $month, $daysInMonth , $year );

		return mosEventRepeatArrayPeriod($row, $monthStartDate, $monthEndDate, $monthEndSecond );
	}

	// defunct?
	function mosEventRepeatArrayDay( $row=null, $year=null, $month=null, $day=null) {
		// builds and returns array
		if( is_null( $row ) || is_null($year) || is_null( $month)|| is_null( $day)) {
			$eventDays = array();
			return $eventDays;
		}

		$dayStartDate = mktime( 0,0,0, $month, $day, $year );
		$dayEndDate = mktime( 0,0,0, $month, $day , $year );
		$dayEndSecond = mktime( 23,59,59, $month, $day , $year );

		// This routine will find all the event dates for the month - could make more efficient later?
		return mosEventRepeatArrayPeriod($row, $dayStartDate, $dayEndDate, $dayEndSecond );
	}

	// defunct?
	function mosEventRepeatArrayWeek( $row=null, $weekStart=null, $weekEnd=null) {
		// builds and returns array
		if( is_null( $row ) || is_null($weekStart) || is_null( $weekEnd)) {
			$eventDays = array();
			return $eventDays;
		}

		list($dayStart, $monthStart, $yearStart) = explode(":",(date("d:m:Y",$weekStart)));
		list($dayEnd, $monthEnd, $yearEnd) = explode(":",(date("d:m:Y",$weekEnd)));

		if ($monthStart == $monthEnd) {
			$weekEndSecond = mktime( 23,59,59, $monthEnd, $dayEnd, $yearEnd );
			return mosEventRepeatArrayPeriod($row, $weekStart, $weekEnd, $weekEndSecond );
		}
		else {

			// do end of first month to start
			$daysInMonth = intval(date("t",$weekStart ));
			$monthEndDate = mktime( 0,0,0, $monthStart, $daysInMonth , $yearStart);
			$monthEndSecond = mktime( 23,59,59, $monthStart, $daysInMonth , $yearStart );
			$part1 = mosEventRepeatArrayPeriod($row, $weekStart, $monthEndDate, $monthEndSecond );

			// then do start of second month
			$part2Start = mktime( 0,0,0, $monthEnd, 1, $yearEnd );
			$weekEndSecond = mktime( 23,59,59, $monthEnd, $dayEnd, $yearEnd );
			$part2 = mosEventRepeatArrayPeriod($row, $part2Start, $weekEnd, $weekEndSecond );

			/*
			// This is overkill but the mosEventRepeatArrayPeriod function works most simply
			// if it works with whole months.

			// do end of first month to start
			$daysInMonth = intval(date("t",$weekStart ));
			$tempStart = mktime( 0,0,0, $monthStart, 1 , $yearStart);
			$monthEndDate = mktime( 0,0,0, $monthStart, $daysInMonth , $yearStart);
			$monthEndSecond = mktime( 23,59,59, $monthStart, $daysInMonth , $yearStart );
			$part1 = mosEventRepeatArrayPeriod($row, $tempStart, $monthEndDate, $monthEndSecond );

			// then do start of second month
			$part2Start = mktime( 0,0,0, $monthEnd, 1, $yearEnd );
			$daysInMonth2 = intval(date("t",$weekEnd ));
			$part2End = mktime( 0,0,0, $monthEnd, $daysInMonth2, $yearEnd );
			$part2EndSecond = mktime( 23,59,59, $monthEnd, $daysInMonth2, $yearEnd );
			$part2 = mosEventRepeatArrayPeriod($row, $part2Start, $part2End, $part2EndSecond);
			*/
			foreach ($part2 as $key=>$val){
				$part1[$key]=$val;
			}
			return $part1;
		}

	}

	// defunct?
	function mosEventRepeatArrayFlex( $row=null, $flexStart=null, $flexEnd=null) {
		// builds and returns array
		if( is_null( $row ) || is_null($flexStart) || is_null( $flexEnd)) {
			$eventDays = array();
			return $eventDays;
		}

		list($dayStart, $monthStart, $yearStart) = explode(":",(date("d:m:Y",$flexStart)));
		list($dayEnd, $monthEnd, $yearEnd) = explode(":",(date("d:m:Y",$flexEnd)));

		if ($monthStart == $monthEnd && $yearStart==$yearEnd) {
			$flexEndSecond = mktime( 23,59,59, $monthEnd, $dayEnd, $yearEnd );
			return mosEventRepeatArrayPeriod($row, $flexStart, $flexEnd, $flexEndSecond );
		}
		else {
			$eventDays = array();
			for($y=$yearStart;$y<=$yearEnd;$y++){
				$startMonth = 1;
				if ($y==$yearStart) $startMonth = $monthStart;
				$endMonth = 12;
				if ($y==$yearEnd) $endMonth = $monthEnd;
				for ($m=$startMonth;$m<=$endMonth;$m++){
					$dateStart = mktime(0,0,0,$m,1,$y);
					$daysInMonth = intval(date("t",$dateStart ));
					$dateEnd = mktime(0,0,0,$m,$daysInMonth,$y);
					$dateEndSecond = mktime(23,59,59,$m,$daysInMonth,$y);
					$part = mosEventRepeatArrayPeriod($row, $dateStart, $dateEnd, $dateEndSecond);

					foreach ($part as $key=>$val){
						$eventDays[$key]=$val;
					}
				}
			}
			return $eventDays;
		}

	}

	// defunct?
	function mosEventRepeatArrayPeriod( $row=null, $startPeriod, $endPeriod, $periodEndSecond) {
		// NEED TO CHECK MONTH and week overlapping month end
		return $row->getRepeatArray( $startPeriod, $endPeriod, $periodEndSecond);
	}

	/**
 * Cloaks html link whith javascript
 *
 * @param string $url		The cloaking URL
 * @param string $text		The link text
 * @param array $attribs	additional attributes
 * @return string HTML
 */
	function jEventsLinkCloaking($url='', $text='', $attribs=array()) {

		static $linkCloaking;

		if (!isset($linkCloaking)) {
			$cfg = & JEVConfig::getInstance();
			$linkCloaking = $cfg->get('com_linkcloaking', 0);
		}

		if (!is_array($attribs)) {
			$attribs = array();
		}
		if ($linkCloaking) {
			$cloakattribs = array('onclick'=>'"window.location.href=\''. JRoute::_($url).'\';return false;"');
			return JEV_CommonFunctions::jEventsDoLink("", $text, array_merge($cloakattribs, $attribs));
		} else {
			return JEV_CommonFunctions::jEventsDoLink( JRoute::_($url), "$text", $attribs);
		}
	}

	function jEventsDoLink($url="",$alt="alt",$attr=array()){
		if (strlen($url)==0) $url="javascript:void(0)";
		$link = "<a href='".$url."' ";
		if (count($attr)>0) {
			foreach ($attr as $key=>$val){
				$link .= " $key=$val";
			}
		}
		$link .= ">$alt</a>";
		return $link;
	}


	/**
 * Support all strftime() parameter for Window systems
 *
 * @param string $format
 * @param int $timestamp
 * @return string formated string
 */
	function jev_strftime($format='', $timestamp=null) {

		if (!$timestamp) $timestamp = time();

		// Replace names by own translation to get rid of improper os system library
		if(strpos($format, '%a') !== false)
		$format = str_replace('%a', JEVHelper::getShortDayName(date('w', $timestamp)), $format);
		if(strpos($format, '%A') !== false)
		$format = str_replace('%A', JEVHelper::getDayName(date('w', $timestamp)), $format);
		if(strpos($format, '%b') !== false)
		$format = str_replace('%b', JEVHelper::getShortMonthName(date('n', $timestamp)), $format);
		if(strpos($format, '%B') !== false)
		$format = str_replace('%B', JEVHelper::getMonthName(date('n', $timestamp)), $format);

		if (JUtility::isWinOS()) {
			if (!class_exists('JEV_CompatWin')) {
				require_once(dirname(__FILE__) . '/compatwin.php');
			}
			return JEV_CompatWin::win_strftime($format, $timestamp);
		} else {
			return strftime($format, $timestamp);
		}

	}


	/**
	 * Test to see if user is creator of the event or editor or above
	 *
	 * @param unknown_type $row
	 * @param unknown_type $user
	 * @return unknown
	 */
	function hasAdvancedRowPermissions($row,$user=null){
		// TODO make this call a plugin
		if ($user==null){
			$user =& JFactory::getUser();
		}
		
		// strictt publishing test	
		if( JEVHelper::isEventEditor() || JEVHelper::isEventPublisher(true)){
			return true;
		} 
		if (is_null($row)){
			return false;
		}
		else if( $row->created_by() == $user->id ){
			return true;
		}
		return false;
	}


	function sendAdminMail( $adminName, $adminEmail, $subject='', $title='', $content='', $author='', $live_site, $modifylink ) {

		if (!$adminEmail) return;
		if ((strpos($adminEmail,'@example.com') !== false)) return;

		$htmlmail = true;
		$lf = ($htmlmail === true) ? '<br />' : '\r\n';

		$content  = sprintf( JText::_('JEV_EMAIL_EVENT_TITLE'), $title).$lf.$lf . $content;
		$content .= $lf.$lf. sprintf( JText::_('JEV_MAIL_TO_ADMIN'), $live_site, $author );
		$content .= $lf . sprintf( JText::_('JEV_EMAIL_EDIT_EVENT'), $modifylink);
		
		$adminLink = JURI::root().JRoute::_("index.php?option=".JEV_COM_COMPONENT."&task=admin.listevents&Itemid=".JEVHelper::getAdminItemid());
		$content .= $lf . JText::sprintf('JEV_MANAGE_EVENTS', $adminLink);

		// mail function
		$mail =& JFactory::getMailer();
		$mail->setSender(array( 0 => $adminEmail, 1 => $adminName ));
		$mail->addRecipient($adminEmail);
		
		$params = JComponentHelper::getParams(JEV_COM_COMPONENT);
		if ($params->get("com_notifyboth")){
			$jevadminuser = new  JUser($params->get("jevadmin",62));
			if ($jevadminuser->email != $adminEmail){
				$mail->addCC($jevadminuser->email);
			}
		}
		
		$mail->setSubject($subject);
		$mail->setBody($content);
		$mail->IsHTML(true);
		$mail->send();

	}

}

