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

class hwd_ps_usrfunc
{
   /**
    * List Groups Created by User
    */
    function yourGroups()
	{
		global $database, $mainframe, $mosConfig_live_site, $limitstart, $Itemid, $my, $acl;
  		$db =& JFactory::getDBO();
		$my = & JFactory::getUser();
		$c = hwd_ps_Config::get_instance();

		if (!$my->id) {
			$msg = _HWDPS_ALERT_LOG2CYG;
			mosRedirect( $mosConfig_live_site."/index.php?option=com_hwdphotoshare&task=groups&Itemid=".$Itemid, $msg );
		}

		$limit 	= intval($c->gpp);
		$gid 	= intval($my->gid);

		$user_id = $my->id;

		$where = ' WHERE a.published = 1';
		$where .= ' AND a.adminid = '.$user_id;

		$db->SetQuery( 'SELECT count(*)'
						. ' FROM #__hwdpsgroups AS a'
							. $where
							);
  		$total = $db->loadResult();
		echo $db->getErrorMsg();

		$pageNav = new JPagination( $total, $limitstart, $limit );

		$query = 'SELECT a.*'
				. ' FROM #__hwdpsgroups AS a'
				. $where
				. ' ORDER BY a.id DESC'
				;

		$db->SetQuery($query, $pageNav->limitstart, $pageNav->limit);
		$rows = $db->loadObjectList();

		hwd_ps_html::yourGroups($rows, $pageNav, $total);
	}

   /**
    * List Groups User Has Joined
    */
	function yourMemberships()
	{
		global $database, $mainframe, $mosConfig_live_site, $limitstart, $Itemid, $my, $acl;
  		$db =& JFactory::getDBO();
		$my = & JFactory::getUser();
		$c = hwd_ps_Config::get_instance();

		if (!$my->id) {
			$msg = _HWDPS_ALERT_LOG2CYM;
			mosRedirect( $mosConfig_live_site."/index.php?option=com_hwdphotoshare&task=groups&Itemid=".$Itemid, $msg );
		}

		$limit 	= intval($c->gpp);
		$gid 	= intval($my->gid);

		$user_id = $my->id;

		$where = ' WHERE a.approved = 1';
		$where .= ' AND a.memberid = '.$user_id;

		$db->SetQuery( 'SELECT count(*)'
						. ' FROM #__hwdpsgroup_membership AS a'
							. $where
							);
  		$total = $db->loadResult();
		echo $db->getErrorMsg();

		$pageNav = new JPagination( $total, $limitstart, $limit );

		$query = 'SELECT l.*'
				. ' FROM #__hwdpsgroup_membership AS a'
				. ' LEFT JOIN #__hwdpsgroups AS l ON a.groupid = l.id'
				. $where
				. ' ORDER BY a.id DESC'
				;

		$db->SetQuery($query, $pageNav->limitstart, $pageNav->limit);
		$rows = $db->loadObjectList();

		hwd_ps_html::yourMemberships($rows, $pageNav, $total);
	}

   /**
    * List User Videos
    */
	function yourPhotos()
	{
		global $mainframe, $limitstart, $hwdps_selecta, $hwdps_joina, $hwdps_selectp, $hwdps_joinp;
  		$db =& JFactory::getDBO();
		$my = & JFactory::getUser();
		$c = hwd_ps_Config::get_instance();

		if (!$my->id) {
			hwd_ps_tools::infomessage(4, 0, _HWDPS_TITLE_NOACCESS, _HWDPS_ALERT_LOG2CYP, "exclamation.png", 0);
			return;
		}

		$limit 	= intval($c->app);

		$user_id = $my->id;

		// get pending

		$where = ' WHERE album.approved = "pending"';
		$where .= ' AND album.user_id = '.$user_id;

		$db->SetQuery( 'SELECT count(*)'
						. ' FROM #__hwdpsalbums AS album'
							. $where
							);
  		$total_pending = $db->loadResult();
		echo $db->getErrorMsg();

		// get albums

		$where = ' WHERE album.published = 1';
		$where.= ' AND album.approved = "yes"';
		$where.= ' AND album.user_id = '.$user_id;

		$query = 'SELECT'.$hwdps_selecta
				. ' FROM #__hwdpsalbums AS album'
				. $hwdps_joina
				. $where
				. ' ORDER BY album.date_created DESC'
				;

		$db->SetQuery($query);
		$rows_a = $db->loadObjectList();

		// get photos

		$where = ' WHERE photo.published = 1';
		$where .= ' AND photo.user_id = '.$user_id;

		$db->SetQuery( 'SELECT count(*)'
						. ' FROM #__hwdpsphotos AS photo'
						. $where
						);
  		$total = $db->loadResult();
		echo $db->getErrorMsg();

		$pageNav = new hwdpsPageNav( $total, $limitstart, $limit );

		$query = 'SELECT'.$hwdps_selectp
				. ' FROM #__hwdpsphotos AS photo'
				. $hwdps_joinp
				. $where
				. ' ORDER BY photo.date_uploaded DESC'
				;

		$db->SetQuery($query, $pageNav->limitstart, $pageNav->limit);
		$rows_p = $db->loadObjectList();

		hwd_ps_html::yourPhotos($rows_a, $rows_p, $pageNav, $total, $total_pending);
	}

   /**
    * List User Favourite Videos
    */
	function yourFavourites()
	{
		global $database, $mainframe, $mosConfig_live_site, $limitstart, $Itemid, $my, $acl;
  		$db =& JFactory::getDBO();
		$my = & JFactory::getUser();
		$c = hwd_ps_Config::get_instance();

		if (!$my->id) {
			$msg = _HWDPS_ALERT_LOG2CYF;
			mosRedirect( $mosConfig_live_site."/index.php?option=com_hwdphotoshare&task=groups&Itemid=".$Itemid, $msg );
		}

		$limit 	= intval($c->ppp);
		$gid 	= intval($my->gid);

		$user_id = $my->id;

		$where = ' WHERE a.approved = "yes"';
		$where .= ' AND a.published = 1';
		$where .= ' AND l.userid = '.$user_id;

		$db->SetQuery( 'SELECT count(*)'
						. ' FROM #__hwdpsphotos AS a'
						. ' LEFT JOIN #__hwdpsfavorites AS l ON a.id = l.photoid'
							. $where
							);
  		$total = $db->loadResult();
		echo $db->getErrorMsg();

		$pageNav = new JPagination( $total, $limitstart, $limit );

		$query = 'SELECT a.*'
				. ' FROM #__hwdpsphotos AS a'
				. ' LEFT JOIN #__hwdpsfavorites AS l ON a.id = l.photoid'
				. $where
				. ' ORDER BY a.date_uploaded DESC'
				;

		$db->SetQuery($query, $pageNav->limitstart, $pageNav->limit);
		$rows = $db->loadObjectList();

		hwd_ps_html::yourFavourites($rows, $pageNav, $total);
	}
   /**
	* Featured groups
	*/
	function featuredGroups()
	{
		global $mainframe, $limitstart, $Itemid;
  		$db =& JFactory::getDBO();
		$c = hwd_ps_Config::get_instance();

		$limit 	= intval($c->gpp);

		$where = ' WHERE a.published = 1';
		$where .= ' AND a.featured = 1';

		$db->SetQuery( 'SELECT count(*)'
						. ' FROM #__hwdpsgroups AS a'
							. $where
							);
  		$total = $db->loadResult();
		echo $db->getErrorMsg();

		$pageNav = new JPagination( $total, $limitstart, $limit );

		$query = 'SELECT a.*'
				. ' FROM #__hwdpsgroups AS a'
				. $where
				. ' ORDER BY a.id DESC'
				;

		$db->SetQuery($query, $pageNav->limitstart, $pageNav->limit);
		$rows = $db->loadObjectList();

		hwd_ps_html::featuredGroups($rows, $pageNav, $total);
	}
   /**
	* Featured groups
	*/
	function setUserTemplate()
	{
		global $mainframe, $option, $Itemid;

		$hwdvstemplate	= JRequest::getCmd( 'hwdpstemplate' );
		$url	= JRequest::getVar( 'url' );
		$states = explode("----", $hwdpstemplate);

		$mainframe->setUserState( "com_hwdphotoshare.template_folder", $states[0] );
		$mainframe->setUserState( "com_hwdphotoshare.template_element", $states[1] );

		$mainframe->enqueueMessage("Your photo gallery theme has been changed.");
		$mainframe->redirect( $url );
	}
}
?>