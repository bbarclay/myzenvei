<?php
/**
 *    @version [ Accetto ]
 *    @package hwdPhotoShare
 *    @copyright (C) 2007 - 2009 Highwood Design
 *    @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
 ***
 *    This program is free software: you can redistribute it and/or modify
 *    it under the terms of the GNU General Public License as published by
 *    the Free Software Foundation, either version 3 of the License, or
 *    (at your option) any later version.
 *
 *    This program is distributed in the hope that it will be useful,
 *    but WITHOUT ANY WARRANTY; without even the implied warranty of
 *    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *    GNU General Public License for more details.
 *
 *    You should have received a copy of the GNU General Public License
 *    along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */
defined( '_JEXEC' ) or die( 'Direct Access to this location is not allowed.' );

/**
 * This class is the HTML generator for hwdphotoshare frontend
 *
 * @package    hwdphotoshare
 * @author     Dave Horsfall <info@highwooddesign.co.uk>
 * @copyright  2008 Highwood Design
 * @license    http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @version    1.1.4 Alpha RC2.13
 */
class hwd_ps_groups
{
    /**
     * Outputs frontpage HTML
     *
     * @param string $option  the joomla component name
     * @param array  $rows  array of video data
     * @param array  $rowsfeatured  array of featured video data
     * @param object $pageNav  page navigation object
     * @param int    $total  the total video count
     * @return       Nothing
     */
    function groups()
	{
		global $db, $mainframe, $limitstart, $my, $mosConfig_live_site, $mosConfig_allowUserRegistration, $acl;
		$c = hwd_ps_Config::get_instance();
		$my = & JFactory::getUser();
  		$db =& JFactory::getDBO();

		$limit 	= intval($c->gpp);

		$where = ' WHERE a.published = 1';
		if (!$my->id) {
		$where .= ' AND a.privacy = "public"';
		}

		$db->SetQuery( 'SELECT count(*)'
							. ' FROM #__hwdpsgroups AS a'
							. $where
							);
  		$total = $db->loadResult();
		echo $db->getErrorMsg();

		$pageNav = new JPagination( $total, $limitstart, $limit );

		//Groups that are published
		$query = 'SELECT a.*'
				. ' FROM #__hwdpsgroups AS a'
				. $where
				. ' ORDER BY a.date DESC'
				;

		$db->SetQuery($query, $pageNav->limitstart, $pageNav->limit);
		$rows = $db->loadObjectList();

		//Featured groups
		$query = 'SELECT a.*'
				. ' FROM #__hwdpsgroups AS a'
				. $where
		        . ' AND a.featured = 1'
				. ' ORDER BY a.date DESC'
				. ' LIMIT 0, '.$c->fgpp
				;

		$db->SetQuery($query);
		$rowsfeatured = $db->loadObjectList();

		hwd_ps_html::groups($rows, $rowsfeatured, $pageNav, $total);
	}
    /**
     * Outputs frontpage HTML
     *
     * @param string $option  the joomla component name
     * @param array  $rows  array of video data
     * @param array  $rowsfeatured  array of featured video data
     * @param object $pageNav  page navigation object
     * @param int    $total  the total video count
     * @return       Nothing
     */
	function createGroup()
	{
		global $db, $my, $mosConfig_live_site, $Itemid, $acl;
		$my = & JFactory::getUser();
		$c = hwd_ps_Config::get_instance();

		if (!$my->id) {
        	hwd_ps_tools::infomessage(4, 0, _HWDPS_TITLE_NOACCESS, _HWDPS_ALERT_LOG2ADDG, "exclamation.png", 0);
			return;
		}

		hwd_ps_html::createGroup();
	}
    /**
     * Outputs frontpage HTML
     *
     * @param string $option  the joomla component name
     * @param array  $rows  array of video data
     * @param array  $rowsfeatured  array of featured video data
     * @param object $pageNav  page navigation object
     * @param int    $total  the total video count
     * @return       Nothing
     */
	function deleteGroup()
	{
		global $mainframe, $Itemid;
		$c = hwd_ps_Config::get_instance();
		$db = & JFactory::getDBO();
		$my = & JFactory::getUser();
		$acl= & JFactory::getACL();

		$userid = $my->id;
		$groupid	= JRequest::getInt( 'groupid', 0 );

		if (!$my->id) {
			$msg = _HWDPS_ALERT_LOG2REMG;
			mosRedirect( $mosConfig_live_site."/index.php?option=com_hwdphotoshare&task=groups&Itemid=".$Itemid, $msg );
		}

		$db->SetQuery("DELETE FROM #__hwdpsgroups WHERE id = $groupid AND adminid = $my->id");
		$db->Query();
		if ( !$db->query() ) {
			echo "<script> alert('".$db->getErrorMsg()."'); window.history.go(-1); </script>\n";
		exit();
		}

		$db->SetQuery("DELETE FROM #__hwdpsgroup_membership WHERE groupid = $groupid");
		$db->Query();
		if ( !$db->query() ) {
			echo "<script> alert('".$db->getErrorMsg()."'); window.history.go(-1); </script>\n";
		exit();
		}

		$db->SetQuery("DELETE FROM #__hwdpsgroup_photos WHERE groupid = $groupid");
		$db->Query();
		if ( !$db->query() ) {
			echo "<script> alert('".$db->getErrorMsg()."'); window.history.go(-1); </script>\n";
		exit();
		}

		$msg = _HWDPS_ALERT_GREMOVED;
		$mainframe->enqueueMessage($msg);
		$mainframe->redirect( JURI::root( true ) . '/index.php?option=com_hwdphotoshare&task=groups&Itemid='.$Itemid );
	}
    /**
     * Outputs frontpage HTML
     *
     * @param string $option  the joomla component name
     * @param array  $rows  array of video data
     * @param array  $rowsfeatured  array of featured video data
     * @param object $pageNav  page navigation object
     * @param int    $total  the total video count
     * @return       Nothing
     */
	function viewGroup()
	{
		global $mainframe, $mosConfig_live_site, $limitstart, $Itemid, $joinv, $select;
		$c = hwd_ps_Config::get_instance();
		$db = & JFactory::getDBO();
		$my = & JFactory::getUser();
		$acl= & JFactory::getACL();
		$usersConfig = &JComponentHelper::getParams( 'com_users' );

		$groupid = JRequest::getInt( 'group_id', 0, 'request' );

		$limit 	= intval($c->ppp);

		$where = ' WHERE published = 1';
		$where .= ' AND id = '.(int)$groupid;
		if (!$my->id) {
		$where .= ' AND public_private = "public"';
		}

		//Check group can be viewed
		$db->SetQuery( 'SELECT count(*)'
						. ' FROM #__hwdpsgroups'
						. $where
							);
  		$groupexists = $db->loadResult();
		echo $db->getErrorMsg();
		if ( $groupexists<1 ) {
			return;
		}

		$where = ' WHERE a.published = 1';
		$where .= ' AND a.approved = "yes"';
		$where .= ' AND l.groupid = '.$groupid;

		$db->SetQuery( 'SELECT count(*)'
							. ' FROM #__hwdpsphotos AS a'
							. ' LEFT JOIN #__hwdpsgroup_photos AS l ON l.photoid = a.id'
							. $where
							);
  		$total = $db->loadResult();
		echo $db->getErrorMsg();

		$pageNav = new JPagination( $total, $limitstart, $limit );

		//Videos that are approved(converted) and published in this group
		$query = 'SELECT'.$select
				. ' FROM #__hwdpsphotos AS a'
				. $joinv
				. ' LEFT JOIN #__hwdpsgroup_photos AS l ON l.photoid = a.id'
				. $where
				. ' ORDER BY a.date_uploaded DESC'
				;

		$db->SetQuery($query, $pageNav->limitstart, $pageNav->limit);
		$rows = $db->loadObjectList();

		//Videos that are approved(converted) and published in this group
		$query = 'SELECT m.*, u.name, u.username'
				. ' FROM #__hwdpsgroup_membership AS m'
				. ' LEFT JOIN #__users AS u ON u.id = m.memberid'
		        . ' WHERE m.groupid = '.$groupid
		        . ' AND m.approved = 1'
				. ' ORDER BY date DESC'
				;

		$db->SetQuery($query);
		$members = $db->loadObjectList();
		//Group details
		$query = 'SELECT a.*, u.name, u.username'
				. ' FROM #__hwdpsgroups AS a'
				. ' LEFT JOIN #__users AS u ON u.id = a.adminid'
				. ' WHERE a.id = '.$groupid
				. ' ORDER BY id DESC'
				;

		$db->SetQuery( $query );
    	$groupdetails = $db->loadObject();

		hwd_ps_html::viewGroup($option, $rows, $pageNav, $total, $members, $groupdetails);
	}
    /**
     * Outputs frontpage HTML
     *
     * @param string $option  the joomla component name
     * @param array  $rows  array of video data
     * @param array  $rowsfeatured  array of featured video data
     * @param object $pageNav  page navigation object
     * @param int    $total  the total video count
     * @return       Nothing
     */
    function saveGroup()
	{
		global $option, $mainframe, $params, $Itemid, $mosConfig_absolute_path, $db, $my, $acl, $mosConfig_mailfrom, $mosConfig_fromname, $mosConfig_live_site, $mosConfig_sitename;
		$c = hwd_ps_Config::get_instance();

		if ($c->disablecaptcha == "0") {

			$security_code = JRequest::getCmd( 'security_code' );

			$sessid = session_id();
			if (empty($sessid)) {
				session_start();
			}

			if(($_SESSION['security_code'] == $security_code) && (!empty($_SESSION['security_code'])) ) {
				hwd_ps_groups::bindNewGroup($option);
				unset($_SESSION['security_code']);
			} else {
				hwd_ps_tools::infomessage(3, 0, _HWDPS_TITLE_GROUPFAIL, _HWDPS_ALERT_ERRSC, "exclamation.png", 0);
				return;
			}

		} else {

		   hwd_ps_groups::bindNewGroup();

		}

	}
    /**
     * Outputs frontpage HTML
     *
     * @param string $option  the joomla component name
     * @param array  $rows  array of video data
     * @param array  $rowsfeatured  array of featured video data
     * @param object $pageNav  page navigation object
     * @param int    $total  the total video count
     * @return       Nothing
     */
    function updateGroup()
	{
		global $Itemid, $mainframe;
		$db = & JFactory::getDBO();
		$my = & JFactory::getUser();
		$c = hwd_ps_Config::get_instance();

		$row = new hwdps_group($db);

		$id = JRequest::getInt( 'id', 0 );
		$referrer = JRequest::getVar( 'referrer', JURI::root( true ) . '/index.php?option=com_hwdphotoshare&task=yourgroups&Itemid='.$Itemid );

		$row = new hwdps_group($db);
		$row->load( $id );

		if ($row->adminid != $my->id) {
			$mainframe->enqueueMessage(_HWDVIDS_ALERT_NOPERM);
			$mainframe->redirect( $referrer );
		}

		$group_name 		= Jrequest::getVar( 'group_name', _HWDPS_UNKNOWN );
		$group_description  = Jrequest::getVar( 'group_description', _HWDPS_UNKNOWN );
		$privacy        	= JRequest::getWord( 'privacy' );
		$allow_comments		= JRequest::getInt( 'allow_comments', 0, 'request' );

		$_POST['group_name'] 		= $group_name;
		$_POST['group_description'] = $group_description;
		$_POST['privacy'] 	        = $privacy;
		$_POST['allow_comments'] 	= $allow_comments;

		// bind it to the table
		if (!$row -> bind($_POST)) {
			echo "<script> alert('"
				.$row -> getError()
				."'); window.history.go(-1); </script>\n";
			exit();
		}

		// store it in the db
		if (!$row -> store()) {
			echo "<script> alert('"
				.$row -> getError()
				."'); window.history.go(-1); </script>\n";
			exit();
		}

		include(HWDVIDSPATH.'/../../administrator/components/com_hwdvideoshare/maintenance/recount.class.php');
		//hwd_vs_recount::recountVideosInCategory($row->category_id);

		$msg = _HWDPS_ALERT_GROUPEDITSAVED;
		$mainframe->enqueueMessage($msg);
		$mainframe->redirect( $referrer );
	}
	/**
     * Outputs frontpage HTML
     *
     * @param string $option  the joomla component name
     * @param array  $rows  array of video data
     * @param array  $rowsfeatured  array of featured video data
     * @param object $pageNav  page navigation object
     * @param int    $total  the total video count
     * @return       Nothing
     */
    function bindNewGroup()
	{
		global $option, $mainframe, $params, $Itemid, $mosConfig_absolute_path, $db, $my, $acl, $mosConfig_mailfrom, $mosConfig_fromname, $mosConfig_live_site, $mosConfig_sitename;
		$c = hwd_ps_Config::get_instance();
		$db = & JFactory::getDBO();
		$my = & JFactory::getUser();
		$acl= & JFactory::getACL();

			$group_name 		= Jrequest::getVar( 'group_name', _HWDPS_UNKNOWN );
			$public_private 	= JRequest::getWord( 'public_private' );
			$date 				= date('Y-m-d H:i:s');
			$allow_comments		= JRequest::getInt( 'allow_comments', 0, 'request' );
			$require_approval   = JRequest::getInt( 'require_approval', 0, 'request' );
			$group_description  = Jrequest::getVar( 'group_description', _HWDPS_UNKNOWN );
			$featured			= 0;
			$adminid            = $my->id;
			if ($c->aag == 1) {
				$published = 1;
			} else {
				$published = 0;
			}

			$checkform = hwd_ps_tools::checkGroupFormComplete( $group_name, $public_private, $allow_comments, $group_description );
			if (!$checkform) { return; }

			$row = new hwdps_group($db);

			$_POST['group_name'] 		= $group_name;
			$_POST['privacy'] 	        = $public_private;
			$_POST['date'] 				= $date;
			$_POST['allow_comments'] 	= $allow_comments;
			$_POST['require_approval'] 	= $require_approval;
			$_POST['group_description'] = $group_description;
			$_POST['featured'] 			= $featured;
			$_POST['adminid'] 			= $adminid;
			$_POST['published'] 		= $published;

			// bind it to the table
			if (!$row -> bind($_POST)) {
				echo "<script> alert('"
					.$row -> getError()
					."'); window.history.go(-1); </script>\n";
				exit();
			}

			// store it in the db
			if (!$row -> store()) {
				echo "<script> alert('"
					.$row -> getError()
					."'); window.history.go(-1); </script>\n";
				exit();
			}

			// mail admin notification
			if ($c->mailgroupnotification == 1) {
				$jconfig = new jconfig();

				$mailbody = ""._HWDPS_MAIL_BODY3.$jconfig->sitename.".\n";
				$mailbody .= ""._HWDPS_MAIL_BODY4."\"".$group_name."\".\n";
				$mailbody .= "".JURI::root()."index.php?option=com_hwdphotoshare&Itemid=".$Itemid."&task=viewgroup&video_id=".$row->id."\n\n";
				$mailbody .= ""._HWDPS_MAIL_BODY5."\n";
				$mailbody .= JURI::root()."administrator";

				JUtility::sendMail( $jconfig->mailfrom, $jconfig->fromname, $c->mailnotifyaddress, _HWDPS_MAIL_SUBJECT3.$jconfig->sitename.' ', $mailbody );
			}

			// automatically add admin to group
			$autoa2g = @$_POST['add2group'];
			if (isset($autoa2g)) {
				if ($autoa2g == "1") {

					$date = date('Y-m-d H:i:s');
					$published = 1;

					$_POST['memberid'] = $my->id;
					$_POST['date'] = $date;
					$_POST['groupid'] = $row->id;
					$_POST['approved'] = 1;

					$row = new hwdps_groupmember($db);

					// bind it to the table
					if (!$row -> bind($_POST)) {
						echo "<script> alert('"
							.$row -> getError()
							."'); window.history.go(-1); </script>\n";
						exit();
					}

					// store it in the db
					if (!$row -> store()) {
						echo "<script> alert('"
							.$row -> getError()
							."'); window.history.go(-1); </script>\n";
						exit();
					}

					//require_once(HWDPSPATH.'/../../administrator/components/com_hwdphotoshare/maintenance/recount.class.php');
					//hwd_ps_recount::recountMembersInGroup($row->groupid);
				}
			}

			if ($c->aag == 1) {
				$msg = _HWDPS_ALERT_GSAVED;
			} else {
				$msg = _HWDPS_ALERT_GPENDING;
			}

		$mainframe->enqueueMessage($msg);
		$mainframe->redirect( JURI::root( true ) . '/index.php?option=com_hwdphotoshare&task=groups&Itemid='.$Itemid );
	}
    /**
     * Outputs frontpage HTML
     *
     * @param string $option  the joomla component name
     * @param array  $rows  array of video data
     * @param array  $rowsfeatured  array of featured video data
     * @param object $pageNav  page navigation object
     * @param int    $total  the total video count
     * @return       Nothing
     */
    function joinGroup()
	{
		global $Itemid, $mainframe;
		$c = hwd_ps_Config::get_instance();
		$db = & JFactory::getDBO();
		$my = & JFactory::getUser();
		$acl= & JFactory::getACL();

		$url =  Jrequest::getVar( 'url', JURI::root() );

		if (!$my->id) {
			$mainframe->enqueueMessage(_HWDPS_ALERT_LOG2JOING);
			$mainframe->redirect( $url );
		}

		$memberid = $my->id;
		$groupid = JRequest::getInt( 'groupid', 0 );

		$date = date('Y-m-d H:i:s');
		$published = 1;

		$row = new hwdps_groupmember($db);

		$_POST['memberid'] = $memberid;
		$_POST['groupid'] = $groupid;
		$_POST['date'] = $date;
		$_POST['approved'] = 1;

		// bind it to the table
		if (!$row -> bind($_POST)) {
			echo "<script> alert('"
				.$row -> getError()
				."'); window.history.go(-1); </script>\n";
			exit();
		}

		// store it in the db
		if (!$row -> store()) {
			echo "<script> alert('"
				.$row -> getError()
				."'); window.history.go(-1); </script>\n";
			exit();
		}

		// perform maintenance
		include(JPATH_SITE.DS.'administrator'.DS.'components'.DS.'com_hwdphotoshare'.DS.'maintenance'.DS.'recount.class.php');
		hwd_ps_recount::recountMembersInGroup($groupid);

		$mainframe->enqueueMessage(_HWDPS_ALERT_SUCJOIN);
		$mainframe->redirect( $url );
	}
    /**
     * Outputs frontpage HTML
     *
     * @param string $option  the joomla component name
     * @param array  $rows  array of video data
     * @param array  $rowsfeatured  array of featured video data
     * @param object $pageNav  page navigation object
     * @param int    $total  the total video count
     * @return       Nothing
     */
    function leaveGroup()
	{
		global $Itemid, $mainframe;
		$c = hwd_ps_Config::get_instance();
		$db = & JFactory::getDBO();
		$my = & JFactory::getUser();
		$acl= & JFactory::getACL();

		$url =  Jrequest::getVar( 'url', JURI::root() );

		if (!$my->id) {
			$mainframe->enqueueMessage(_HWDPS_ALERT_LOG2LEAVEG);
			$mainframe->redirect( $url );
		}

		$memberid = $my->id;
		$groupid = JRequest::getInt( 'groupid', 0 );

		$where = ' WHERE memberid = '.$memberid;
		$where .= ' AND groupid = '.$groupid;

		$db->SetQuery( 'DELETE FROM #__hwdpsgroup_membership'
							. $where
							);

		if ( !$db->query() ) {
			echo "<script> alert('".$db->getErrorMsg()."'); window.history.go(-1); </script>\n";
			exit();
		}

		// perform maintenance
		include(JPATH_SITE.DS.'administrator'.DS.'components'.DS.'com_hwdphotoshare'.DS.'maintenance'.DS.'recount.class.php');
		hwd_ps_recount::recountMembersInGroup($groupid);

		$mainframe->enqueueMessage(_HWDPS_ALERT_SUCLEAVE);
		$mainframe->redirect( $url );
  	}
    /**
     * Outputs frontpage HTML
     *
     * @param string $option  the joomla component name
     * @param array  $rows  array of video data
     * @param array  $rowsfeatured  array of featured video data
     * @param object $pageNav  page navigation object
     * @param int    $total  the total video count
     * @return       Nothing
     */
    function editGroup()
	{
		global $mosConfig_live_site, $mainframe, $Itemid;
		$c = hwd_ps_Config::get_instance();
		$db = & JFactory::getDBO();
		$my = & JFactory::getUser();
		$acl= & JFactory::getACL();

		$groupid = JRequest::getInt( 'groupid', 0 );

		$row = new hwdps_group($db);
		$row->load( $groupid );

		//check valid user
		if ($row->adminid != $my->id) {
			$mainframe->enqueueMessage(_HWDVIDS_ALERT_NOPERM);
			$mainframe->redirect( JURI::root() . 'index.php?option=com_hwdvideoshare&task=groups&Itemid='.$Itemid );
		}

		//Videos that are approved(converted) and published in this group
		$query = 'SELECT user.*, mem.memberid'
				. ' FROM #__hwdpsgroup_membership AS `mem`'
				. ' LEFT JOIN #__hwdpsgroups AS `group` ON mem.groupid = group.id'
				. ' LEFT JOIN #__users AS `user` ON user.id = mem.memberid'
				. ' WHERE mem.groupid = '.$row->id
				;
		$db->SetQuery($query);
		$grp_members = $db->loadObjectList();
		echo $db->getErrorMsg();

		hwd_ps_html::editGroupInfo($row, $grp_members);
  	}

}
?>