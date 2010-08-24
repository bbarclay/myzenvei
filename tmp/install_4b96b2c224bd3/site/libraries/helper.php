<?php
/**
 * JEvents Component for Joomla 1.5.x
 *
 * @version     $Id: helper.php 1580 2009-09-26 15:30:30Z geraint $
 * @package     JEvents
 * @copyright   Copyright (C) 2008-2009 GWE Systems Ltd, 2006-2008 JEvents Project Group
 * @license     GNU/GPLv2, see http://www.gnu.org/licenses/gpl-2.0.html
 * @link        http://www.jevents.net
 */

defined( '_JEXEC' ) or die( 'Restricted access' );

/**
 * Helper class with common functions for the component and modules
 *
 * @author     Thomas Stahl
 * @since      1.4
 */
class JEVHelper {

	/**
	 * load language file
	 *
	 * @static
	 * @access public
	 * @since 1.4
	 */
	function loadLanguage($type='default', $lang='') {

		// to be enhanced in future : load by $type (com, modcal, modlatest) [tstahl]

		global $mainframe, $option;
		$cfg 		= & JEVConfig::getInstance();
		$lang 		=& JFactory::getLanguage();
		$langname	= $lang->getBackwardLang();

		static $isloaded = array();

		$typemap	= array(
		'default'	=> 'front',
		'front'		=> 'front',
		'admin'		=> 'admin',
		'modcal'	=> 'front',
		'modlatest'	=> 'front',
		'modfeatured'	=> 'front'
		);
		$type = (isset($typemap[$type])) ? $typemap[$type] : $typemap['default'];

		// load language defines only once
		if (isset($isloaded[$type])) {
			return;
		}

		$cfg = JEVConfig::getInstance();
		$isloaded[$type] = true;

		switch ($type) {
			case 'front':
				// load new style language
				// if loading from another component or is admin then force the load of the site language file - otherwite done automatically
				if ($option != JEV_COM_COMPONENT || $mainframe->isAdmin()) {
					// force load of installed language pack
					$lang->load(JEV_COM_COMPONENT, JPATH_SITE);
				}
				// overload language with components language directory if available
				//$inibase = JPATH_SITE . '/components/' . JEV_COM_COMPONENT;
				//$lang->load(JEV_COM_COMPONENT, $inibase);

				$com_jevents_form_help = null;

				if($cfg->get('com_calForceCatColorEventForm', 0) == 0)
				$com_jevents_form_help =  JText::_('JEV_FORM_HELP_COLOR');

				$com_jevents_form_help .= JText::_('JEV_FORM_HELP');

				if($cfg->get('com_calSimpleEventForm', 0) ==0)
				$com_jevents_form_help .= JText::_('JEV_FORM_HELP_EXTENDED');

				// backend code used to edit events
				DEFINE('JEV_EVENT_FORM_HELP_ADMIN', $com_jevents_form_help);

				break;

			case 'admin':
				// load new style language
				// if loading from another component or is frontend then force the load of the admin language file - otherwite done automatically
				if ($option != JEV_COM_COMPONENT || !$mainframe->isAdmin()) {
					// force load of installed language pack
					$lang->load(JEV_COM_COMPONENT, JPATH_ADMINISTRATOR);
				}
				// overload language with components language directory if available
				//$inibase = JPATH_ADMINISTRATOR . '/components/' . JEV_COM_COMPONENT;
				//$lang->load(JEV_COM_COMPONENT, $inibase);

				break;
			default:
				break;
		} // switch
	}

	/**
	 * load iCal instance for filename
	 *
	 * @static
	 * @access public
	 * @since 1.5
	 */
	function & iCalInstance($filename, $rawtext="")
	{
		static $instances = array();
		if (is_array($filename)){
			echo "problem";
		}
		$index = md5($filename.$rawtext);
		if (array_key_exists($index,$instances)) {
			return $instances[$index];
		}
		else {
			$import =new iCalImport();
			$instances[$index] =& $import->import($filename, $rawtext);

			return $instances[$index];
		}
	}

	/**
	 * Returns the full month name
	 * 
	 * @static
	 * @access public
	 * @param	string	$month		numeric month
	 * @return	string				localised long month name
	 */
	function getMonthName( $month=12 ){

		switch( intval($month) ){

			case  1:	return JText::_('JEV_JANUARY');
			case  2:	return JText::_('JEV_FEBRUARY');
			case  3:	return JText::_('JEV_MARCH');
			case  4:	return JText::_('JEV_APRIL');
			case  5:	return JText::_('JEV_MAY');
			case  6:	return JText::_('JEV_JUNE');
			case  7:	return JText::_('JEV_JULY');
			case  8:	return JText::_('JEV_AUGUST');
			case  9:	return JText::_('JEV_SEPTEMBER');
			case 10:	return JText::_('JEV_OCTOBER');
			case 11:	return JText::_('JEV_NOVEMBER');
			case 12:    return JText::_('JEV_DECEMBER');

		}
	}

	/**
	 * Return the short month name
	 * 
	 * @static
	 * @access public
	 * @param	string	$month		numeric month
	 * @return	string				localised short month name
	 */
	function getShortMonthName( $month=12 ){

		switch( intval($month) ){

			// Use Joomla translation
			case 1:  return JText::_('JANUARY_SHORT');
			case 2:  return JText::_('FEBRUARY_SHORT');
			case 3:  return JText::_('MARCH_SHORT');
			case 4:  return JText::_('APRIL_SHORT');
			case 5:  return JText::_('MAY_SHORT');
			case 6:  return JText::_('JUNE_SHORT');
			case 7:  return JText::_('JULY_SHORT');
			case 8:  return JText::_('AUGUST_SHORT');
			case 9:  return JText::_('SEPTEMBER_SHORT');
			case 10: return JText::_('OCTOBER_SHORT');
			case 11: return JText::_('NOVEMBER_SHORT');
			case 12: return JText::_('DECEMBER_SHORT');
		}
	}

	/**
	 * Returns name of the day longversion
	 * 
	 * @static
	 * @param	int		daynb	# of day
	 * @param	int		array, 0 return single day, 1 return array of all days
	 * @return	mixed	localised short day letter or array of names
	 **/
	function getDayName( $daynb=0, $array=0){

		static $days = null;

		if ($days === null) {
			$days = array();

			$days[0] = JText::_('JEV_SUNDAY');
			$days[1] = JText::_('JEV_MONDAY');
			$days[2] = JText::_('JEV_TUESDAY');
			$days[3] = JText::_('JEV_WEDNESDAY');
			$days[4] = JText::_('JEV_THURSDAY');
			$days[5] = JText::_('JEV_FRIDAY');
			$days[6] = JText::_('JEV_SATURDAY');
		}

		if ($array == 1) {
			return $days;
		}

		$i = $daynb % 7; //modulo 7
		return $days[$i];
	}

	/**
	 * Returns the short day name
	 * 
	 * @static
	 * @param	int		daynb	# of day
	 * @param	int		array, 0 return single day, 1 return array of all days
	 * @return	mixed	localised short day letter or array of names
	 **/
	function getShortDayName( $daynb=0, $array=0){

		static $days = null;

		if ($days === null) {
			$days = array();

			$days[0] = JText::_('JEV_SUN');
			$days[1] = JText::_('JEV_MON');
			$days[2] = JText::_('JEV_TUE');
			$days[3] = JText::_('JEV_WED');
			$days[4] = JText::_('JEV_THU');
			$days[5] = JText::_('JEV_FRI');
			$days[6] = JText::_('JEV_SAT');

		}

		if ($array == 1) {
			return $days;
		}

		$i = $daynb % 7; //modulo 7
		return $days[$i];
	}

	/**
	 * Returns name of the day letter
	 * 
	 * @param	i
	 * @staticnt		daynb	# of day
	 * @param	int		array, 0 return single day, 1 return array of all days
	 * @return	mixed	localised short day letter or array of letters
	 **/
	function getWeekdayLetter($daynb=0, $array=0){

		static $days = null;

		if ($days === null) {
			$days = array();
			$days[0] = JText::_('JEV_SUNDAY_CHR');
			$days[1] = JText::_('JEV_MONDAY_CHR');
			$days[2] = JText::_('JEV_TUESDAY_CHR');
			$days[3] = JText::_('JEV_WEDNESDAY_CHR');
			$days[4] = JText::_('JEV_THURSDAY_CHR');
			$days[5] = JText::_('JEV_FRIDAY_CHR');
			$days[6] = JText::_('JEV_SATURDAY_CHR');
		}

		if ($array == 1) {
			return $days;
		}

		$i = $daynb % 7; //modulo 7
		return $days[$i];
	}

	/**
	 * Function that overwrites meta-tags in mainframe!!
	 *
	 * @static
	 * @param string $name - metatag name
	 * @param string $content - metatag value
	 */
	function checkRobotsMetaTag( $name="robots", $content="noindex, nofollow" ) {

		// force robots metatag
		$cfg = & JEVConfig::getInstance();
		if ($cfg->get('com_blockRobots', 0) >= 1) {
			$document =& JFactory::getDocument();
			// Allow on content pages
			if ($cfg->get('com_blockRobots', 0) == 3) {
				if (strpos(JRequest::getString("jevtask",""),".detail")>0){
					$document->setMetaData( $name, "nofollow" );
					return;
				}
				$document->setMetaData( $name, $content );
				return;
			}
			if ($cfg->get('com_blockRobots', 0) == 1){
				$document->setMetaData( $name, $content );
				return;
			}
			list($cyear, $cmonth, $cday) = JEVHelper::getYMD();
			$cdate = mktime(0,0,0,$cmonth, $cday, $cyear);
			$prior = strtotime($cfg->get('robotprior', "-1 day"));
			if ($cdate<$prior){
				$document->setMetaData( $name, $content );
				return;
			}
			$post =  strtotime($cfg->get('robotpost', "-1 day"));
			if ($cdate>$post){
				$document->setMetaData( $name, $content );
				return;
			}
		}

	}

	function forceIntegerArray(&$cid,$asString=true) {
		for($c=0;$c<count($cid);$c++) {
			$cid[$c] = intval($cid[$c]);
		}
		if($asString){
			$id_string = implode(",",$cid);
			return $id_string;
		}
		else {
			return "";
		}
	}

	/**
	 * Loads all necessary files for JS Overlib tooltips
	 * 
	 * @static
	 */
	function loadOverlib() {
		global  $mainframe;
		$cfg	= & JEVConfig::getInstance();

		// check if this function is already loaded
		if ( !$mainframe->get( 'loadOverlib' ) ) {
			if( $cfg->get("com_enableToolTip",1) || $mainframe->isAdmin()) {
				$document=& JFactory::getDocument();
				$document->addScript(JURI::root() . 'includes/js/overlib_mini.js');
				$document->addScript(JURI::root() . 'includes/js/overlib_hideform_mini.js');
				// change state so it isnt loaded a second time
				$mainframe->set( 'loadOverlib', true );

				if( $cfg->get("com_calTTShadow",1) && !$mainframe->isAdmin()) {
					$document->addScript(JURI::root() . 'components/' . JEV_COM_COMPONENT . '/assets/js/overlib_shadow.js');
				}
				if (!$mainframe->isAdmin()) {
					// Override Joomla class definitions for overlib decoration - only affects logged in users
					$ol_script	=  "  /* <![CDATA[ */\n";
					$ol_script	.= "  // inserted by JEvents\n";
					$ol_script	.= "  ol_fgclass='';\n";
					$ol_script	.= "  ol_bgclass='';\n";
					$ol_script	.= "  ol_textfontclass='';\n";
					$ol_script	.= "  ol_captionfontclass='';\n";
					$ol_script	.= "  ol_closefontclass='';\n";
					$ol_script	.= "  /* ]]> */";
					$document->addScriptDeclaration($ol_script);
				}

			}
		}
	}

	function getItemid(){
		static $jevitemid;
		if (!isset($jevitemid)){
			$jevitemid = 0;
			$menu	=& JSite::getMenu();
			$active = $menu->getActive();
			if (!is_null($active) && $active->component==JEV_COM_COMPONENT){
				$jevitemid = $active->id;
				return $jevitemid;
			}
			else {
				$jevitems = $menu->getItems("component",JEV_COM_COMPONENT);
				// TODO Check enclosing categories
				if (count($jevitems)>0){
					$user =& JFactory::getUser();
					foreach ($jevitems as $jevitem) {
						if ($user->aid>=$jevitem->access){
							$jevitemid = $jevitem->id;
							return $jevitemid;
						}
					}
				}
			}

		}
		return $jevitemid;
	}

	function getAdminItemid(){
		static $jevitemid;
		if (!isset($jevitemid)){
			$jevitemid = 0;
			$menu	=& JSite::getMenu();
			$active = $menu->getActive();
			if (!is_null($active) && $active->component==JEV_COM_COMPONENT && strpos($active->link, "admin.listevents")>0){
				$jevitemid = $active->id;
				return $jevitemid;
			}
			else {
				$jevitems = $menu->getItems("component",JEV_COM_COMPONENT);
				// TODO Check enclosing categories
				if (count($jevitems)>0){
					$user =& JFactory::getUser();
					foreach ($jevitems as $jevitem) {
						if ($user->aid>=$jevitem->access  && strpos($active->link, "admin.listevents")>0){
							$jevitemid = $jevitem->id;
							return $jevitemid;
						}
					}
				}
			}
			$jevitemid = JEVHelper::getItemid();
		}
		return $jevitemid;
	}

	/**
	 * Get array Year, Month, Day from current Request, fallback to current date
	 *
	 * @return array
	 */
	function getYMD(){

		static $data;

		if (!isset($data)){
			$datenow = JEVHelper::getNow();
			list($year, $month, $day) = explode('-', $datenow->toFormat('%Y-%m-%d'));

			$year	= min(2100,abs(intval(JRequest::getVar('year',	$year))));
			$month	= min(99,abs(intval(JRequest::getVar('month',	$month))));
			$day	= min(3650,abs(intval(JRequest::getVar('day',	$day))));
			if( $day <= '9' ) {
				$day = '0' . $day;
			}
			if( $month <= '9') {
				$month = '0' . $month;
			}
			$data = array();
			$data[]=$year;
			$data[]=$month;
			$data[]=$day;
		}
		return $data;
	}

	/**
	 * Get JDate object of current time
	 *
	 * @return object JDate
	 */
	function getNow() {

		/* JDate object of current time */
		static $datenow = null;

		if (!isset($datenow)) {
			$config	=& JFactory::getConfig();
			$offset = $config->getValue('config.offset', 0);

			$datenow =& JFactory::getDate();
			$datenow->setOffset($offset);
		}
		return $datenow;
	}

	function & getJEV_Access(){
		static $instance;
		if (!isset($instance)){
			$instance = new JEVAccess();
		}
		return $instance;
	}

	/**
	 * Test to see if user can add events from the front end
	 *
	 * @return boolean
	 */
	function isEventCreator(){
		static $isEventCreator;
		if (!isset($isEventCreator)){
			$isEventCreator = false;
			/*
			// experiment in alternative approval mechanism
			// just incase we don't have jevents plugins registered yet
			JPluginHelper::importPlugin("jevents");
			$dispatcher	=& JDispatcher::getInstance();
			$set = $dispatcher->trigger('isEventCreator', array (& $isEventCreator));
			if (count($set)>0) return $isEventCreator;
			*/
			$user =& JEVHelper::getAuthorisedUser();
			if (is_null($user)){
				$params =& JComponentHelper::getParams(JEV_COM_COMPONENT);
				$authorisedonly = $params->get("authorisedonly",0);
				if (!$authorisedonly){
					$creatorlevel = $params->get("jevcreator_level",20);
					$juser =& JFactory::getUser();
					if ($juser->gid>=$creatorlevel){
						$isEventCreator = true;
					}
				}
			}
			else if ($user->cancreate){
				$isEventCreator = true;
			}
		}
		return $isEventCreator;
	}

	// is the user an event editor - i.e. can edit own and other events
	function isEventEditor(){
		static $isEventEditor;
		if (!isset($isEventEditor)){
			$isEventEditor = false;

			$user =& JEVHelper::getAuthorisedUser();
			if (is_null($user)){
				$params = JComponentHelper::getParams(JEV_COM_COMPONENT);
				$authorisedonly = $params->get("authorisedonly",0);
				if (!$authorisedonly){
					$publishlevel = $params->get("jeveditor_level",20);
					$juser =& JFactory::getUser();
					if ($juser->gid>=$publishlevel){
						$isEventEditor = true;
					}
				}
			}
			/*
			$user =& JEVHelper::getAuthorisedUser();
			if (is_null($user)){
			$params =& JComponentHelper::getParams(JEV_COM_COMPONENT);
			$editorLevel= $params->get("jeveditor_level",20);
			$juser =& JFactory::getUser();
			if ($juser->gid>=$editorLevel){
			$isEventEditor = true;
			}
			}
			*/
			else if ($user->canedit){
				$isEventEditor = true;
			}
		}
		return $isEventEditor;
	}



	/**
	 * Test to see if user can edit event
	 *
	 * @param unknown_type $row
	 * @param unknown_type $user
	 * @return unknown
	 */
	function canEditEvent($row,$user=null){
		// TODO make this call a plugin
		if ($user==null){
			$user =& JFactory::getUser();
		}

		if( JEVHelper::isEventEditor() ){
			return true;
		}
		else if( $row->created_by() == $user->id ){
			return true;
		}
		return false;
	}

	// is the user an event publisher - i.e. can publish own OR other events
	function isEventPublisher($strict=false){
		static $isEventPublisher;
		if (!isset($isEventPublisher)){
			$isEventPublisher=array();
		}
		$type = $strict?"strict":"notstrict";
		if (!isset($isEventPublisher[$type])){
			$isEventPublisher[$type] = false;

			$user =& JEVHelper::getAuthorisedUser();
			if (is_null($user)){
				$params =& JComponentHelper::getParams(JEV_COM_COMPONENT);
				$authorisedonly = $params->get("authorisedonly",0);
				if (!$authorisedonly){
					$publishlevel = $params->get("jevpublish_level",20);
					$juser =& JFactory::getUser();
					if ($juser->gid>=$publishlevel){
						$isEventPublisher[$type] = true;
					}
				}

				/*
				$publishlevel = $params->get("jevpublish_level",20);
				$juser =& JFactory::getUser();
				if ($juser->gid>=$publishlevel){
				$isEventPublisher[$type] = true;
				}
				else {
				// if can't publish because of level then check if can publish own but this test only applied if not strict
				$params = JComponentHelper::getParams(JEV_COM_COMPONENT);
				$authorisedonly = $params->get("authorisedonly",1);
				$publishown = $params->get("jevpublishown",0);
				if (!$strict && !$authorisedonly && $publishown){
				$isEventPublisher[$type] = true;
				}
				}
				*/
			}
			else if ($user->canpublishall){
				$isEventPublisher[$type] = true;
			}
			else if (!$strict &&  $user->canpublishown){
				$isEventPublisher[$type] = true;
			}

		}


		return $isEventPublisher[$type];
	}

	// Fall back test to see if user can publish their own events based on config setting
	function canPublishOwnEvents($evid){
		$params =& JComponentHelper::getParams(JEV_COM_COMPONENT);
		$authorisedonly = $params->get("authorisedonly",1);
		$publishown = $params->get("jevpublishown",0);
		if (!$authorisedonly && $publishown){
			$user =& JFactory::getUser();

			// can publish all?
			if( JEVHelper::isEventPublisher(true) ){
				return true;
			}
			else if( $evid==0){
				return true;
			}
			$dataModel = new JEventsDataModel("JEventsAdminDBModel");
			$queryModel =new JEventsDBModel($dataModel);

			$evid = intval($evid);
			$testevent = $queryModel->getEventById( $evid, 1, "icaldb" );
			if($testevent->ev_id()==$evid && $testevent->created_by() == $user->id ){
				return true;

			}
		}
		return false;

	}

	// gets a list of categories for which this user is the admin
	function categoryAdmin(){
		if (!JEVHelper::isEventPublisher()) return false;
		$juser =& JFactory::getUser();

		$db =& JFactory::getDBO();
		$sql = "SELECT id FROM #__jevents_categories WHERE admin=".$juser->id;
		$db->setQuery($sql);
		$catids = $db->loadResultArray();
		if (count($catids)>0) return $catids;
		return false;
	}

	/**
	 * Test to see if user can publish event
	 *
	 * @param unknown_type $row
	 * @param unknown_type $user
	 * @return unknown
	 */
	function canPublishEvent($row,$user=null){
		// TODO make this call a plugin
		if ($user==null){
			$user =& JFactory::getUser();
		}

		// can publish all?
		if( JEVHelper::isEventPublisher(true) ){
			return true;
		}
		else if( $row->created_by() == $user->id ){
			$jevuser =& JEVHelper::getAuthorisedUser();
			if (!is_null($jevuser)){
				return $jevuser->canpublishown;
			}

			$params = JComponentHelper::getParams(JEV_COM_COMPONENT);
			$authorisedonly = $params->get("authorisedonly",1);
			$publishown = $params->get("jevpublishown",0);
			if (!$authorisedonly && $publishown){
				return true;
			}

		}
		return false;
	}

	// is the user an event publisher - i.e. can publish own OR other events
	function isEventDeletor($strict = false){
		static $isEventDeletor;
		if (!isset($isEventDeletor)){
			$isEventDeletor=array();
		}
		$type = $strict?"strict":"notstrict";
		if (!isset($isEventDeletor[$type])){
			$isEventDeletor[$type] = false;

			$user =& JEVHelper::getAuthorisedUser();
			if (is_null($user)){
				$params = JComponentHelper::getParams(JEV_COM_COMPONENT);
				$authorisedonly = $params->get("authorisedonly",0);
				if (!$authorisedonly){
					$publishlevel = $params->get("jevpublish_level",20);
					$juser =& JFactory::getUser();
					if ($juser->gid>=$publishlevel){
						$isEventDeletor[$type] = true;
					}
				}

				/*
				$params =& JComponentHelper::getParams(JEV_COM_COMPONENT);
				$publishlevel = $params->get("jevpublish_level",20);
				$juser =& JFactory::getUser();
				if ($juser->gid>=$publishlevel){
				$isEventDeletor[$type] = true;
				}
				$params = JComponentHelper::getParams(JEV_COM_COMPONENT);
				$authorisedonly = $params->get("authorisedonly",1);
				$publishown = $params->get("jevpublishown",0);
				if (!$strict && !$authorisedonly && $publishown){
				$isEventDeletor[$type]= true;
				}
				*/

			}
			else if ($user->candeleteall ){
				$isEventDeletor[$type] = true;
			}
			else if (!$strict &&  $user->candeleteown){
				$isEventDeletor[$type] = true;
			}

		}
		return $isEventDeletor[$type];
	}


	/**
	 * Test to see if user can delete event
	 *
	 * @param unknown_type $row
	 * @param unknown_type $user
	 * @return unknown
	 */
	function canDeleteEvent($row,$user=null){
		// TODO make this call a plugin
		if ($user==null){
			$user =& JFactory::getUser();
		}

		// can publish all?
		if( JEVHelper::isEventDeletor(true) ){
			return true;
		}
		else if( $row->created_by() == $user->id ){
			$jevuser =& JEVHelper::getAuthorisedUser();
			if (!is_null($jevuser)){
				return $jevuser->candeleteown;
			}
			// if a user can publish their own then cal delete their own too
			$params = JComponentHelper::getParams(JEV_COM_COMPONENT);
			$authorisedonly = $params->get("authorisedonly",1);
			$publishown = $params->get("jevpublishown",0);
			if (!$authorisedonly && $publishown){
				return true;
			}

		}
		return false;
	}

	/**
	 * Serves requested user object or attributes
	 *
	 * @param int id		key of user
	 * @param string attrib	Requested attribute of the user object
	 * @return mixed row	Attribute or row object
	 */
	function getUser($id, $attrib='Object') {

		$db	=& JFactory::getDBO();

		static $rows = array();

		if ($id <= 0) {
			return null;
		}

		if (!isset($rows[$id])) {
			$rows[$id] = null;
			$query = "SELECT id, name, username, usertype, sendEmail, email FROM #__users"
			. "\n WHERE block ='0'"
			. "\n AND id = " . $id;
			$db->setQuery($query);
			$rows[$id]=$db->loadObject();
		}

		if ($attrib == 'Object') {
			return $rows[$id];
		} elseif (isset($rows[$id]->$attrib)) {
			return $rows[$id]->$attrib;
		} else {
			return null;
		}
	}

	/**
	 * Returns contact details or user details as fall back
	 *
	 * @param int id		key of user
	 * @param string attrib	Requested attribute of the user object
	 * @return mixed row	Attribute or row object
	 */
	function getContact($id, $attrib='Object') {

		$db	=& JFactory::getDBO();

		static $rows = array();

		if ($id <= 0) {
			return null;
		}

		if (!isset($rows[$id])) {
			$user =& JFactory::getUser();
			$rows[$id] = null;
			$query = "SELECT ju.id, ju.name, ju.username, ju.usertype, ju.sendEmail, ju.email, cd.name as contactname, "
			. ' CASE WHEN CHAR_LENGTH(cd.alias) THEN CONCAT_WS(\':\', cd.id, cd.alias) ELSE cd.id END as slug, '
			. ' CASE WHEN CHAR_LENGTH(cat.alias) THEN CONCAT_WS(\':\', cat.id, cat.alias) ELSE cat.id END AS catslug '
			." \n FROM #__users AS ju"
			. "\n LEFT JOIN #__contact_details AS cd ON cd.user_id = ju.id "
			. "\n LEFT JOIN #__categories AS cat ON cat.id = cd.catid "
			. "\n WHERE block ='0'"
			. "\n AND cd.access <= " . $user->aid
			. "\n AND cat.access <= " . $user->aid
			. "\n AND ju.id = " . $id;

			$db->setQuery($query);
			$rows[$id]=$db->loadObject();
			if (is_null($rows[$id])){
				// if the user has been deleted then try to suppress the warning
				$handlers = JError::getErrorHandling(2);
				JError::setErrorHandling(2,"ignore");
				$rows[$id] = JFactory::getUser($id);
				foreach ($handlers as $handler) {
					JError::setErrorHandling(2,$handler);
				}
				if ($rows[$id]){
					$error = JError::getError(true);
				}

			}
		}

		if ($attrib == 'Object') {
			return $rows[$id];
		} elseif (isset($rows[$id]->$attrib)) {
			return $rows[$id]->$attrib;
		} else {
			return null;
		}
	}

	/**
	 * Get user details for authorisation testing
	 *
	 * @param int $id Joomla user id
	 * @return array TableUser  
	 */
	function getAuthorisedUser($id=null){
		static $userarray;
		if (!isset($userarray)){
			$userarray = array();
		}
		if (is_null($id)){
			$juser =& JFactory::getUser();
			$id = $juser->id;
		}
		if (!array_key_exists($id,$userarray)){
			JLoader::import("jevuser",JPATH_ADMINISTRATOR."/components/".JEV_COM_COMPONENT."/tables/");

			$user = new TableUser();

			$params =& JComponentHelper::getParams(JEV_COM_COMPONENT);
			$authorisedonly = $params->get("authorisedonly",0);
			// if authorised only then load from database
			if ($authorisedonly){
				$users = $user->getUsersByUserid($id);
				if (count($users)>0){
					$userarray[$id] = current($users);
					// user must also be enabled!
					if (!$userarray[$id]->published){
						$userarray[$id] = null;

					}
				}
				else {
					$userarray[$id] = null;
				}
			}
			else {
				/*
				$creator_level = $params->get("jevcreator_level",20);
				$jeveditor_level= $params->get("jeveditor_level",20);
				$jevpublish_level= $params->get("jevpublish_level",20);
				$jevpublishown = $params->get("jevpublishown",20);
				$user->disableAll();
				$juser = JFactory::getUser();
				$user->user_id = $juser->id;
				if ($juser->gid>=$creator_level){
				$user->creator_level=true;
				$user->enabled=true;
				}
				if ($juser->gid>=$jeveditor_level){
				$user->jeveditor_level=true;
				$user->enabled=true;
				}
				if ($juser->gid>=$jevpublish_level){
				$user->$jevpublish_level=true;
				$user->enabled=true;
				}
				if ($juser->gid>=$jevpublishown){
				$user->jevpublishown=true;
				$user->enabled=true;
				}
				$userarray[$id] = $user;
				*/
				$userarray[$id] = null;
			}

		}
		return $userarray[$id];
	}

	function componentStylesheet($view, $filename='events_css.css'){

		global $mainframe;
		if (!isset($view->jevlayout) ){
			if (method_exists($view,"getViewName")) $view->jevlayout = $view->getViewName();
			else if (method_exists($view,"getTheme")) $view->jevlayout = $view->getTheme();
		}

		if (file_exists(JPATH_BASE.DS.'templates'.DS.$mainframe->getTemplate().DS.'html'.DS.JEV_COM_COMPONENT.DS.$view->jevlayout.DS."assets".DS."css".DS.$filename)){
			JHTML::stylesheet($filename , 'templates/'.$mainframe->getTemplate().'/html/'.JEV_COM_COMPONENT.'/'.$view->jevlayout."/assets/css/" );
		}
		else {
			JHTML::stylesheet($filename, 'components/'.JEV_COM_COMPONENT."/views/".$view->jevlayout."/assets/css/" );
		}
	}


}

