<?php
/**
 * JEvents Component for Joomla 1.5.x
 *
 * @version     $Id: icals.php 1603 2009-10-12 08:59:30Z geraint $
 * @package     JEvents
 * @copyright   Copyright (C) 2008-2009 GWE Systems Ltd,2006-2008 JEvents Project Group
 * @license     GNU/GPLv2, see http://www.gnu.org/licenses/gpl-2.0.html
 * @link        http://www.jevents.net
 */

defined( '_JEXEC' ) or die( 'Restricted access' );

jimport('joomla.application.component.controller');


class AdminIcalsController extends JController {

	var $_debug = false;
	var $queryModel = null;
	var $dataModel = null;

	/**
	 * Controler for the Ical Functions
	 * @param array		configuration
	 */
	function __construct($config = array())
	{
		parent::__construct($config);
		$this->registerTask( 'list',  'overview' );
		$this->registerTask( 'new',  'newical' );
		$this->registerTask( 'reload',  'save' );
		$this->registerDefaultTask("overview");

		$cfg = & JEVConfig::getInstance();
		$this->_debug = $cfg->get('jev_debug', 0);

		$this->dataModel = new JEventsDataModel("JEventsAdminDBModel");
		$this->queryModel =new JEventsDBModel($this->dataModel);

	}

	/**
	 * List Icals
	 *
	 */
	function overview( )
	{
		// get the view
		$this->view = & $this->getView("icals","html");

		$this->_checkValidCategories();

		$option = JEV_COM_COMPONENT;
		$db	=& JFactory::getDBO();

		global $mainframe;
		$catid		= intval( $mainframe->getUserStateFromRequest( "catid{$option}", 'catid', 0 ));
		$limit		= intval( $mainframe->getUserStateFromRequest( "viewlistlimit", 'limit', 10 ));
		$limitstart = intval( $mainframe->getUserStateFromRequest( "view{$option}limitstart", 'limitstart', 0 ));
		$search		= $mainframe->getUserStateFromRequest( "search{$option}", 'search', '' );
		$search		= $db->getEscaped( trim( strtolower( $search ) ) );
		$where		= array();

		if( $search ){
			$where[] = "LOWER(a.summary) LIKE '%$search%'";
		}
		if ($catid>0){
			$where[] ="catid = $catid";
		}
		// get the total number of records
		$query = "SELECT count(*)"
		. "\n FROM #__jevents_icsfile AS icsf"
		. ( count( $where ) ? "\n WHERE " . implode( ' AND ', $where ) : '' )
		;
		$db->setQuery( $query);
		$total = $db->loadResult();
		echo $db->getErrorMsg();

		if( $limitstart > $total ) {
			$limitstart = 0;
		}

		$query = "SELECT icsf.*, g.name AS _groupname"
		. "\n FROM #__jevents_icsfile as icsf "
		. "\n LEFT JOIN #__groups AS g ON g.id = icsf.access"
		. ( count( $where ) ? "\n WHERE " . implode( ' AND ', $where ) : '' )
		//	. "\n WHERE icsf.catid IN(".$this->accessibleCategoryList().")"
		;
		if ($limit>0){
			$query .= "\n LIMIT $limitstart, $limit";
		}

		$db->setQuery( $query );
		$rows = $db->loadObjectList();

		$catData = JEV_CommonFunctions::getCategoryData();

		for ($s=0;$s<count($rows);$s++) {
			$row =& $rows[$s];
			if (array_key_exists($row->catid,$catData)){
				$row->category = $catData[$row->catid]->name;
			}
			else {
				$row->category = "?";
			}
		}

		if( $this->_debug ){
			echo '[DEBUG]<br />';
			echo 'query:';
			echo '<pre>';
			echo $query;
			echo '-----------<br />';
			echo 'option "' . $option . '"<br />';
			echo '</pre>';
			//die( 'userbreak - mic ' );
		}

		if ($db->getErrorNum()) {
			echo $db->stderr();
			return false;
		}

		// get list of categories
		$attribs = 'class="inputbox" size="1" onchange="document.adminForm.submit();"';
		$clist = JEventsHTML::buildCategorySelect( $catid, $attribs, null, true,false, 0, 'catid');

		jimport('joomla.html.pagination');
		$pageNav = new JPagination( $total, $limitstart, $limit  );


		// Set the layout
		$this->view->setLayout('overview');

		$this->view->assign('option',JEV_COM_COMPONENT);
		$this->view->assign('rows',$rows);
		$this->view->assign('clist',$clist);
		$this->view->assign('search',$search);
		$this->view->assign('pageNav',$pageNav);

		$this->view->display();
	}

	function edit () {
		$user =& JFactory::getUser();
		if (strtolower($user->usertype)!="super administrator" && strtolower($user->usertype)!="administrator"){
			$this->setRedirect( "index.php?option=".JEV_COM_COMPONENT."&task=cpanel.cpanel", "Not Authorised - must be super admin" );
			return;
		}

		// get the view
		$this->view = & $this->getView("icals","html");

		$cid	= JRequest::getVar(	'cid',	array(0) );
		JArrayHelper::toInteger($cid);
		if (is_array($cid) && count($cid)>0) $editItem=$cid[0];
		else $editItem=0;

		$item =new stdClass();
		if ($editItem!=null){
			$db	=& JFactory::getDBO();
			$query = "SELECT * FROM #__jevents_icsfile as ics where ics.ics_id=$editItem";

			$db->setQuery( $query );
			$item = null;
			$item = $db->loadObject();
		}


		// Set the layout
		$this->view->setLayout('edit');

		// for Admin interface only
		global $mainframe;
		$this->view->assign('with_unpublished_cat',$mainframe->isAdmin());

		$this->view->assign('editItem',$item);
		$this->view->assign('option',JEV_COM_COMPONENT);

		$this->view->display();

	}

	function save(){

		$authorised = false;
		global $mainframe;
		if ($mainframe->isAdmin()){
			$redirect_task="icals.list";
		}
		else {
			$redirect_task="month.calendar";
		}

		// clean this up later - this is a quick fix for frontend reloading
		$autorefresh = 0;
		$icsid = intval(JRequest::getVar('icsid',0));
		if ($icsid>0){
			$query = "SELECT icsf.* FROM #__jevents_icsfile as icsf WHERE ics_id=$icsid";
			$db	=& JFactory::getDBO();
			$db->setQuery($query);
			$currentICS = $db->loadObjectList();
			if (count($currentICS)>0){
				$currentICS= $currentICS[0];
				if ($currentICS->autorefresh){
					$authorised = true;
					$autorefresh=1;
				}
			}
		}
		$user =& JFactory::getUser();
		if (!($authorised || strtolower($user->usertype)=="super administrator" || strtolower($user->usertype)=="administrator")) {
			$this->setRedirect( "index.php?option=".JEV_COM_COMPONENT."&task=$redirect_task", "Not Authorised - must be super admin" );
			return;
		}
		$cid	= JRequest::getVar(	'cid',	array(0) );
		JArrayHelper::toInteger($cid);
		if (is_array($cid) && count($cid)>0) {
			$cid=$cid[0];
		} else {
			$cid=0;
		}

		$db	=& JFactory::getDBO();

		// include ical files
		global $mainframe;
		
		if ($icsid>0 || $cid!=0){
			$icsid = ($icsid>0)?$icsid:$cid;
			$query = "SELECT icsf.* FROM #__jevents_icsfile as icsf WHERE ics_id=$icsid";
			$db->setQuery($query);
			$currentICS = $db->loadObjectList();
			if (count($currentICS)>0){
				$currentICS= $currentICS[0];
			}
			else {
				$this->setRedirect( "index.php?option=".JEV_COM_COMPONENT."&task=$redirect_task", "Invalid Ical Details");
				$this->redirect();
			}

			$catid = JRequest::getInt('catid',$currentICS->catid);
			if ($catid<=0 && $currentICS->catid>0){
				$catid = intval($currentICS->catid);
			}
			$access = intval(JRequest::getVar('access',$currentICS->access));
			if ($access<0 && $currentICS->access>=0){
				$access = intval($currentICS->access);
			}
			$icsLabel = JRequest::getVar('icsLabel',$currentICS->label );
			if ($icsLabel=="" && strlen($currentICS->icsLabel)>=0){
				$icsLabel = $currentICS->icsLabel;
			}
			$isdefault = JRequest::getInt('isdefault',$currentICS->isdefault);
			$autorefresh = JRequest::getInt('autorefresh',$autorefresh);
			$ignoreembedcat = JRequest::getInt('ignoreembedcat',$currentICS->ignoreembedcat);

			// This is a native ical - so we are only updating identifiers etc
			if ($currentICS->icaltype==2){
				$ics = new iCalICSFile($db);
				$ics->load($icsid);
				$ics->catid=$catid;
				$ics->isdefault=$isdefault;
				$ics->access=$access;
				$ics->label=$icsLabel;
				// TODO update access and state
				$ics->updateDetails();
				$this->setRedirect( "index.php?option=".JEV_COM_COMPONENT."&task=$redirect_task", JText::_("ICS saved"));
				$this->redirect();
			}

			$state = 1;
			if (strlen($currentICS->srcURL)==0) {
				echo "Can only reload URL based subscriptions";
				return;
			}
			$uploadURL = $currentICS->srcURL;

		}
		else {
			$catid = JRequest::getInt('catid',0);
			$ignoreembedcat = JRequest::getInt('ignoreembedcat',0);
			// Should come from the form or existing item
			$access = 0;
			$state = 1;
			$uploadURL = JRequest::getVar('uploadURL','' );
			$icsLabel = JRequest::getVar('icsLabel','' );
		}
		if ($catid==0){
			// Paranoia, should not be here, validation is done by java script
			JError::raiseError('Fatal error', JText::_('JEV_E_WARNCAT') );
			$this->setRedirect( "index.php?option=".JEV_COM_COMPONENT."&task=$redirect_task",  JText::_('JEV_E_WARNCAT'));
			$this->redirect();
			return;
		}

		// I need a better check and expiry information etc.
		if (strlen($uploadURL)>0){
			$icsFile = iCalICSFile::newICSFileFromURL($uploadURL,$icsid,$catid,$access,$state,$icsLabel, $autorefresh, $ignoreembedcat);
		}
		else if (isset($_FILES['upload']) && is_array($_FILES['upload']) ) {
			$file 			= $_FILES['upload'];
			if ($file['size']==0 ){//|| !($file['type']=="text/calendar" || $file['type']=="application/octet-stream")){
				JError::raiseWarning(0, 'empty upload file');
				$icsFile = false;
			}
			else {
				$icsFile = iCalICSFile::newICSFileFromFile($file,$icsid,$catid,$access,$state,$icsLabel);
			}
		}

		$message = '';
		if ($icsFile !== false) {
			$icsFileid = $icsFile->store();
			$message = JText::_('ICS FILE IMPORTED');
		}

		$this->setRedirect( "index.php?option=".JEV_COM_COMPONENT."&task=$redirect_task", $message);
	}

	/**
	 * This just updates the details not the content of the calendar
	 *
	 */
	function savedetails(){
		$authorised = false;
		global $mainframe;
		if ($mainframe->isAdmin()){
			$redirect_task="icals.list";
		}
		else {
			$redirect_task="month.calendar";
		}

		$user =& JFactory::getUser();
		if (!($authorised || strtolower($user->usertype)=="super administrator" || strtolower($user->usertype)=="administrator")){
			$this->setRedirect( "index.php?option=".JEV_COM_COMPONENT."&task=$redirect_task", "Not Authorised - must be super admin" );
			return;
		}

		$icsid = intval(JRequest::getVar('icsid',0));
		$cid	= JRequest::getVar(	'cid',	array(0) );
		JArrayHelper::toInteger($cid);
		if (is_array($cid) && count($cid)>0) {
			$cid=$cid[0];
		} else {
			$cid=0;
		}

		$db	=& JFactory::getDBO();

		// include ical files
		global $mainframe;

		if ($icsid>0 || $cid!=0){
			$icsid = ($icsid>0)?$icsid:$cid;
			$query = "SELECT icsf.* FROM #__jevents_icsfile as icsf WHERE ics_id=$icsid";
			$db->setQuery($query);
			$currentICS = $db->loadObjectList();
			if (count($currentICS)>0){
				$currentICS= $currentICS[0];
			}
			else {
				$this->setRedirect( "index.php?option=".JEV_COM_COMPONENT."&task=$redirect_task", "Invalid Ical Details");
				$this->redirect();
			}

			$catid = JRequest::getInt('catid',$currentICS->catid);
			if ($catid<=0 && $currentICS->catid>0){
				$catid = intval($currentICS->catid);
			}
			$access = intval(JRequest::getVar('access',$currentICS->access));
			if ($access<0 && $currentICS->access>=0){
				$access = intval($currentICS->access);
			}
			$state = intval(JRequest::getVar('state',$currentICS->state));
			if ($state<0 && $currentICS->state>=0){
				$state = intval($currentICS->state);
			}
			$icsLabel = JRequest::getVar('icsLabel',$currentICS->label );
			if ($icsLabel=="" && strlen($currentICS->icsLabel)>=0){
				$icsLabel = $currentICS->icsLabel;
			}
			$uploadURL = JRequest::getVar('uploadURL',$currentICS->srcURL );
			if ($uploadURL=="" && strlen($currentICS->srcURL)>=0){
				$uploadURL = $currentICS->srcURL;
			}
			$isdefault = JRequest::getInt('isdefault',$currentICS->isdefault);
			$autorefresh = JRequest::getInt('autorefresh',$currentICS->autorefresh);
			$ignoreembed = JRequest::getInt('ignoreembedcat',$currentICS->ignoreembedcat);

			// We are only updating identifiers etc
			$ics = new iCalICSFile($db);
			$ics->load($icsid);
			$ics->catid=$catid;
			$ics->isdefault=$isdefault;
			$ics->state=$state;
			$ics->access=$access;
			$ics->label=$icsLabel;
			$ics->srcURL= $uploadURL;
			$ics->ignoreembedcat= $ignoreembed;
			// TODO update access and state
			$ics->updateDetails();
			$this->setRedirect( "index.php?option=".JEV_COM_COMPONENT."&task=$redirect_task", JText::_("ICS saved"));
			$this->redirect();
		}
	}

	function publish(){
		$cid = JRequest::getVar(	'cid',	array(0) );
		JArrayHelper::toInteger($cid);
		$this->toggleICalPublish($cid,1);
	}

	function unpublish(){
		$cid = JRequest::getVar(	'cid',	array(0) );
		JArrayHelper::toInteger($cid);
		$this->toggleICalPublish($cid,0);
	}

	function toggleICalPublish($cid,$newstate){
		$user =& JFactory::getUser();
		if (strtolower($user->usertype)!="super administrator" && strtolower($user->usertype)!="administrator"){
			$this->setRedirect( "index.php?option=".JEV_COM_COMPONENT."&task=cpanel.cpanel", "Not Authorised - must be super admin" );
			return;
		}

		$db	=& JFactory::getDBO();
		foreach ($cid as $id) {
			$sql = "UPDATE #__jevents_icsfile SET state=$newstate where ics_id='".$id."'";
			$db->setQuery($sql);
			$db->query();
		}
		$this->setRedirect( "index.php?option=".JEV_COM_COMPONENT."&task=icals.list", JText::_('JEV_ADMIN_ICALSUPDATED'));
	}

	function autorefresh(){
		$cid = JRequest::getVar(	'cid',	array(0) );
		JArrayHelper::toInteger($cid);
		$this->toggleAutorefresh($cid,1);
	}

	function noautorefresh(){
		$cid = JRequest::getVar(	'cid',	array(0) );
		JArrayHelper::toInteger($cid);
		$this->toggleAutorefresh($cid,0);
	}

	function toggleAutorefresh($cid,$newstate){
		$user =& JFactory::getUser();
		if (strtolower($user->usertype)!="super administrator" && strtolower($user->usertype)!="administrator"){
			$this->setRedirect( "index.php?option=".JEV_COM_COMPONENT."&task=cpanel.cpanel", "Not Authorised - must be super admin" );
			return;
		}

		$db	=& JFactory::getDBO();
		foreach ($cid as $id) {
			$sql = "UPDATE #__jevents_icsfile SET autorefresh=$newstate where ics_id='".$id."'";
			$db->setQuery($sql);
			$db->query();
		}
		$this->setRedirect( "index.php?option=".JEV_COM_COMPONENT."&task=icals.list", JText::_('JEV_ADMIN_ICALSUPDATED'));
	}

	function isdefault(){
		$cid = JRequest::getVar(	'cid',	array(0) );
		JArrayHelper::toInteger($cid);
		$this->toggleDefault($cid,1);
	}

	function notdefault(){
		$cid = JRequest::getVar(	'cid',	array(0) );
		JArrayHelper::toInteger($cid);
		$this->toggleDefault($cid,0);
	}

	function toggleDefault($cid,$newstate){
		$user =& JFactory::getUser();
		if (strtolower($user->usertype)!="super administrator" && strtolower($user->usertype)!="administrator"){
			$this->setRedirect( "index.php?option=".JEV_COM_COMPONENT."&task=cpanel.cpanel", "Not Authorised - must be super admin" );
			return;
		}

		$db	=& JFactory::getDBO();
		// set all to not default first
		$sql = "UPDATE #__jevents_icsfile SET isdefault=0";
		$db->setQuery($sql);
		$db->query();

		$id = $cid[0];
		$sql = "UPDATE #__jevents_icsfile SET isdefault=$newstate where ics_id='".$id."'";
		$db->setQuery($sql);
		$db->query();
		$this->setRedirect( "index.php?option=".JEV_COM_COMPONENT."&task=icals.list", JText::_('JEV_ADMIN_ICALSUPDATED'));
	}

	/**
 	* create new ICAL from scratch
 	*/
	function newical() {

		// include ical files
		$catid = intval(JRequest::getVar('catid',0));
		// Should come from the form or existing item
		$access = 0;
		$state = 1;
		$icsLabel = JRequest::getVar('icsLabel','');

		if ($catid==0){
			// Paranoia, should not be here, validation is done by java script
			JError::raiseError('Fatal error', JText::_('JEV_E_WARNCAT') );
			global $mainframe;
			$mainframe->redirect( 'index2.php?option=' . $option);
			return;
		}
		$icsid = 0;
		$icsFile = iCalICSFile::editICalendar($icsid,$catid,$access,$state,$icsLabel);
		$icsFileid = $icsFile->store();

		$this->setRedirect( "index.php?option=".JEV_COM_COMPONENT."&task=icals.list", JText::_('ICal File Created'));
	}


	function delete(){
		$cid	= JRequest::getVar(	'cid',	array(0) );
		JArrayHelper::toInteger($cid);

		$db	=& JFactory::getDBO();

		// check this won't create orphan events
		$query = "SELECT ev_id FROM #__jevents_vevent WHERE icsid in (".implode(",",$cid).")";
		$db->setQuery( $query );
		$kids = $db->loadObjectList();
		if (count($kids)>0){
			$this->setRedirect( "index.php?option=".JEV_COM_COMPONENT."&task=icals.list", JText::_("DELETE CREATES ORPHAN EVENTS") );
			return;	
		}
		
		$icsids = $this->_deleteICal($cid);
		$query = "DELETE FROM #__jevents_icsfile WHERE ics_id IN ($icsids)";
		$db->setQuery( $query);
		$db->query();

		$this->setRedirect( "index.php?option=".JEV_COM_COMPONENT."&task=icals.list", "ICal deleted" );
	}

	function _deleteICal($cid){
		$db	=& JFactory::getDBO();
		$icsids = implode(",",$cid);

		$query = "SELECT ev_id FROM #__jevents_vevent WHERE icsid IN ($icsids)";
		$db->setQuery( $query);
		$veventids = $db->loadResultArray();
		$veventidstring = implode(",",$veventids);

		if ($veventidstring) {
			// TODO the ruccurences should take care of all of these??
			// This would fail if all recurrances have been 'adjusted'
			$query = "SELECT DISTINCT (eventdetail_id) FROM #__jevents_repetition WHERE eventid IN ($veventidstring)";
			$db->setQuery( $query);
			$detailids = $db->loadResultArray();
			$detailidstring = implode(",",$detailids);

			$query = "DELETE FROM #__jevents_rrule WHERE eventid IN ($veventidstring)";
			$db->setQuery( $query);
			$db->query();

			$query = "DELETE FROM #__jevents_repetition WHERE eventid IN ($veventidstring)";
			$db->setQuery( $query);
			$db->query();

			if ($detailidstring) {
				$query = "DELETE FROM #__jevents_vevdetail WHERE evdet_id IN ($detailidstring)";
				$db->setQuery( $query);
				$db->query();
			}
		}

		if ($icsids) {
			$query = "DELETE FROM #__jevents_vevent WHERE icsid IN ($icsids)";
			$db->setQuery( $query);
			$db->query();
		}

		return $icsids;
	}


	function _checkValidCategories(){
		// TODO switch this after migration
		$component_name = "com_jevents";

		$db	=& JFactory::getDBO();
		$query = "SELECT count(*) as count FROM #__categories"
		. "\n WHERE section='$component_name'";
		$db->setQuery($query);
		$count = intval($db->loadResult());
		if ($count<=0){
			$this->setRedirect("index.php?option=".JEV_COM_COMPONENT."&task=categories.list","You must first create at least one category");
			$this->redirect();
		}
	}

}
