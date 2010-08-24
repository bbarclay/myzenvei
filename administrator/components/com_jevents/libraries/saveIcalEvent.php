<?php
/**
 * JEvents Component for Joomla 1.5.x
 *
 * @version     $Id: saveIcalEvent.php 1653 2010-01-05 01:32:52Z geraint $
 * @package     JEvents
 * @copyright   Copyright (C) 2008-2009 GWE Systems Ltd, 2006-2008 JEvents Project Group
 * @license     GNU/GPLv2, see http://www.gnu.org/licenses/gpl-2.0.html
 * @link        http://www.jevents.net
 */

defined( '_JEXEC' ) or die( 'Restricted access' );

class SaveIcalEvent {

	function save($array, &$queryModel, $rrule){

		$cfg = & JEVConfig::getInstance();
		$db	=& JFactory::getDBO();
		$user =& JFactory::getUser();

		// Allow plugins to check data validity
		$dispatcher     =& JDispatcher::getInstance();
		JPluginHelper::importPlugin("jevents");
		$res = $dispatcher->trigger( 'onBeforeSaveEvent' , $array, $rrule);

		// TODO do error and hack checks here
		$ev_id = intval(JArrayHelper::getValue( $array,  "evid",0));
		$newevent = $ev_id==0;
		
		$data = array();

		// TODO add UID to edit form
		$data["UID"]				= JArrayHelper::getValue( $array,  "uid",md5(uniqid(rand(),true)));

		$data["X-EXTRAINFO"]	= JArrayHelper::getValue( $array,  "extra_info","");
		$data["LOCATION"]		= JArrayHelper::getValue( $array,  "location","");
		$data["allDayEvent"]	= JArrayHelper::getValue( $array,  "allDayEvent","off");
		$data["CONTACT"]		= JArrayHelper::getValue( $array,  "contact_info","");
		$data["DESCRIPTION"]	= JArrayHelper::getValue( $array,  "jevcontent","");
		$data["publish_down"]	= JArrayHelper::getValue( $array,  "publish_down","2006-12-12");
		$data["publish_up"]		= JArrayHelper::getValue( $array,  "publish_up","2006-12-12");
		$data["SUMMARY"]		= JArrayHelper::getValue( $array,  "title","");

		// If user is jevents can deleteall or has backend access then allow them to specify the creator
		$jevuser	= JEVHelper::getAuthorisedUser();
		$creatorid = JRequest::getInt("jev_creatorid",0);
		if ( $creatorid>0){
			// Get an ACL object
			$acl =& JFactory::getACL();
			$grp = $acl->getAroGroup($user->get('id'));
			$access = $acl->is_group_child_of($grp->name, 'Public Backend');

			if (($jevuser && $jevuser->candeleteall) || $access) {
				$data["X-CREATEDBY"]	= $creatorid;
			}
		}

		$ics_id				= JArrayHelper::getValue( $array,  "ics_id",0);

		if ($data["allDayEvent"]=="on"){
			$start_time="00:00";
		}
		else $start_time			= JArrayHelper::getValue( $array,  "start_time","08:00");
		$publishstart		= $data["publish_up"] . ' ' . $start_time . ':00';
		$data["DTSTART"]	= strtotime( $publishstart );

		if ($data["allDayEvent"]=="on"){
			$end_time="00:00";
		}
		else $end_time 			= JArrayHelper::getValue( $array,  "end_time","15:00");
		$publishend		= $data["publish_down"] . ' ' . $end_time . ':00';

		$data["DTEND"]		= strtotime( $publishend );
		// iCal for whole day uses 00:00:00 on the next day JEvents uses 23:59:59 on the same day
		list ($h,$m,$s) = explode(":",$end_time . ':00');
		if (($h+$m+$s)==0 && $data["allDayEvent"]=="on" && $data["DTEND"]>$data["DTSTART"]) {
			//if (($h+$m+$s)==0 && $data["allDayEvent"]=="on" && $data["DTEND"]>=$data["DTSTART"]) {
			//$publishend = strftime('%Y-%m-%d 23:59:59',($data["DTEND"]-86400));
			$publishend = strftime('%Y-%m-%d 23:59:59',($data["DTEND"]));
			$data["DTEND"]		= strtotime( $publishend );
		}

		$data["RRULE"]	= $rrule;

		$data["MULTIDAY"]	= JArrayHelper::getValue( $array,  "multiday","1");
		$data["NOENDTIME"]	= JArrayHelper::getValue( $array,  "noendtime","0");
		$data["X-COLOR"]	= JArrayHelper::getValue( $array,  "color","");

		// Add any custom fields into $data array
		foreach ($array as $key=>$value) {
			if (strpos($key,"custom_")===0){
				$data[$key]=$value;
			}
		}

		global $mainframe;
		$vevent = iCalEvent::iCalEventFromData($data);

		$vevent->catid = JArrayHelper::getValue( $array,  "catid",0);
		// if catid is empty then use the catid of the ical calendar
		if ($vevent->catid<=0){
			$query = "SELECT catid FROM #__jevents_icsfile WHERE ics_id=$ics_id";
			$db->setQuery( $query);
			$vevent->catid = $db->loadResult();
		}
		$vevent->access = intval(JArrayHelper::getValue( $array,  "access",0));
		$vevent->state =  intval(JArrayHelper::getValue( $array,  "state",0));
		// Shouldn't really do this like this
		$vevent->_detail->priority =  intval(JArrayHelper::getValue( $array,  "priority",0));

		// FRONT END AUTO PUBLISHING CODE
		$frontendPublish = JEVHelper::isEventPublisher();

		if (!$frontendPublish){
			$frontendPublish = JEVHelper::canPublishOwnEvents($ev_id);
		}
		// Always unpublish if no Publisher otherwise publish automatically (for new events)
		// Should we always notify of new events
		$notifyAdmin = $cfg->get("com_notifyallevents",0);
		if (!$mainframe->isAdmin()){
			if ($frontendPublish && $ev_id==0){
				$vevent->state = 1;
			}else if (!$frontendPublish){
				$vevent->state = 0;
				// In this case we send a notification email to admin
				$notifyAdmin = true;
			}
		}

		$vevent->icsid = $ics_id;
		if ($ev_id>0){
			$vevent->ev_id=$ev_id;
		}

		$rp_id = intval(JArrayHelper::getValue( $array,  "rp_id",0));
		if ($rp_id>0){
			// I should be able to do this in one operation but that can come later
			$testevent = $queryModel->listEventsById( intval($rp_id), 1, "icaldb" );
			if (!JEVHelper::canEditEvent($testevent)){
				JError::raiseError( 403, JText::_("ALERTNOTAUTH") );
			}
		}

		$db =& JFactory::getDBO();
		$success = true;
		echo "class = ".get_class($vevent);
		if (!$vevent->store()){
			echo $db->getErrorMsg()."<br/>";
			$success = false;
			JError::raiseWarning(101,JText::_("Could not save event "));
		}

		// Only update the repetitions if the event edit says the reptitions will have changed or a new event
		if ($newevent || JRequest::getInt("updaterepeats",1)){
			$repetitions = $vevent->getRepetitions(true);
			if (!$vevent->storeRepetitions()){
				echo $db->getErrorMsg()."<br/>";
				$success = false;
				JError::raiseWarning(101,JText::_("Could not save repetitions"));
			}
		}
		
		global $mainframe;
		// If not authorised to publish in the frontend then notify the administrator
		if ($success && $notifyAdmin && !$mainframe->isAdmin()){

			JLoader::register('JEventsCategory',JEV_ADMINPATH."/libraries/categoryClass.php");
			$cat = new JEventsCategory($db);
			$cat->load($vevent->catid);
			$adminuser = $cat->getAdminUser();

			$adminEmail	= $adminuser->email;
			$config = new JConfig();
			$sitename =  $config->sitename;
			$subject	= JText::_('JEV_MAIL_ADDED') . ' ' . $sitename;
			$subject	= ($vevent->state == '1') ? '[Info] ' . $subject : '[Approval] ' . $subject;
			$Itemid = JEVHelper::getItemid();
			// reload the event to get the reptition ids
			$evid = intval($vevent->ev_id);
			$testevent = $queryModel->getEventById( $evid, 1, "icaldb" );
			$rp_id = $testevent->rp_id();

			list($year,$month,$day) = JEVHelper::getYMD();
			//http://joomlacode1.5svn/index.php?option=com_jevents&task=icalevent.edit&evid=1&Itemid=68&rp_id=72&year=2008&month=09&day=10&lang=cy
			$modifylink = '<a href="' . JURI::root() . JRoute::_( 'index.php?option=' .JEV_COM_COMPONENT . '&task=icalevent.edit&evid='.$evid.'&rp_id='.$rp_id. '&Itemid=' . $Itemid."&year=$year&month=$month&day=$day" ) . '"><b>' . JText::_('JEV_MODIFY') . '</b></a>' . "\n";

			$created_by = $user->name;
			if ($created_by==null) $created_by="Anonymous";

			JEV_CommonFunctions::sendAdminMail( $sitename, $adminEmail, $subject, $testevent->title(), $testevent->content(), $created_by, JURI::root(), $modifylink );

		}
		if ($success){
			return $vevent;
		}
		return $success;
	}

	function generateRRule($array){
		//static $weekdayMap=array("SU"=>0,"MO"=>1,"TU"=>2,"WE"=>3,"TH"=>4,"FR"=>5,"SA"=>6);
		static $weekdayReverseMap=array("SU","MO","TU","WE","TH","FR","SA");

		$interval 	= JArrayHelper::getValue( $array,  "rinterval",1);

		$freq = JArrayHelper::getValue( $array,  "freq","NONE");
		if ($freq!="NONE") {
			$rrule = array();
			$rrule["FREQ"]	= $freq;
			$countuntil		= JArrayHelper::getValue( $array,  "countuntil","count");
			if ($countuntil=="count" ){
				$count 			= intval(JArrayHelper::getValue( $array,  "count",1));
				if ($count<=0) $count=1;
				$rrule["COUNT"] = $count;
			}
			else {
				$publish_down	= JArrayHelper::getValue( $array,  "publish_down","2006-12-12");
				$until			= JArrayHelper::getValue( $array,  "until",$publish_down);
				$rrule["UNTIL"] = strtotime($until." 00:00:00");
			}
			$rrule["INTERVAL"] = $interval;
		}

		$whichby			= JArrayHelper::getValue( $array,  "whichby","bd");

		switch ($whichby){
			case "byd":
				$byd_direction		= JArrayHelper::getValue( $array,  "byd_direction","off")=="off"?"+":"-";
				$byyearday 			= JArrayHelper::getValue( $array,  "byyearday","");
				$rrule["BYYEARDAY"] = $byd_direction.$byyearday;
				break;
			case "bm":
				$bm_direction		= JArrayHelper::getValue( $array,  "bm_direction","off")=="off"?"+":"-";
				$bymonth			= JArrayHelper::getValue( $array,  "bymonth","");
				$rrule["BYMONTH"] 	= $bymonth;
				break;
			case "bwn":
				$bwn_direction		= JArrayHelper::getValue( $array,  "bwn_direction","off")=="off"?"+":"-";
				$byweekno			= JArrayHelper::getValue( $array,  "byweekno","");
				$rrule["BYWEEKNO"] 	= $bwn_direction.$byweekno;
				break;
			case "bmd":
				$bmd_direction		= JArrayHelper::getValue( $array,  "bmd_direction","off")=="off"?"+":"-";
				$bymonthday			= JArrayHelper::getValue( $array,  "bymonthday","");
				$rrule["BYMONTHDAY"]= $bmd_direction.$bymonthday;
				break;
			case "bd":
				$bd_direction		= JArrayHelper::getValue( $array,  "bd_direction","off")=="off"?"+":"-";
				$weekdays			= JArrayHelper::getValue( $array,  "weekdays",array());
				$weeknums			= JArrayHelper::getValue( $array,  "weeknums",array());
				$byday		= "";
				if (count($weeknums)==0){
					// special case for weekly repeats which don't specify eeek of a month
					foreach ($weekdays as $wd) {
						if (strlen($byday)>0) $byday.=",";
						$byday .= $weekdayReverseMap[$wd];
					}
				}
				foreach ($weeknums as $week){
					foreach ($weekdays as $wd) {
						if (strlen($byday)>0) $byday.=",";
						$byday .= $bd_direction.$week.$weekdayReverseMap[$wd];
					}
				}
				$rrule["BYDAY"] = $byday;
				break;
		}
		return $rrule;
	}
}