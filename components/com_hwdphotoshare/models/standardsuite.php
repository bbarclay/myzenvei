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
class hwd_ps_standard
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
    function rate()
	{
		$c = hwd_ps_Config::get_instance();
		$db = & JFactory::getDBO();
		$my = & JFactory::getUser();
		$ip = $_SERVER['REMOTE_ADDR'];

		$rating = JRequest::getInt( 'rating', 0, 'request' );
		$photoid = JRequest::getInt( 'photoid', 0, 'request' );

		if ($my->id == "0" || !$my->id || empty($my->id)) {
			$where = ' WHERE a.ip = "'.$ip.'"';
		} else {
			$where = ' WHERE a.userid = '.$my->id;
		}
		$where .= ' AND a.photoid = '.$photoid;

		if ($rating > 5) die(_HWDPS_ALERT_INVALVOTE); // kill the script because normal users will never see this.

		//Current Video Details
		$query = 'SELECT *'
				. ' FROM #__hwdpsphotos'
				. ' WHERE id = '.$photoid
				;
		$db->SetQuery( $query );
    	$row = $db->loadObject();

		if ($row->rating_number_votes < 1) {
			$count = 0;
		} else {
			$count = $row->rating_number_votes; //how many votes total
		}
		$tense = ($count==1) ? _HWDPS_INFO_M_VOTE : _HWDPS_INFO_M_VOTES; //plural form votes/vote

		$rating0 = @number_format($row->rating_total_points/$count,0);
		$rating1 = @number_format($row->rating_total_points/$count,1);

		// check if user has voted already
		$db->SetQuery( 'SELECT count(*)'
					. ' FROM #__hwdpsrating AS a'
					. $where
					);
		$total = $db->loadResult();

		// Stop if user not logged in and guest rating blocked
		// if ($c->allowgr == 0 && (!$my->id || $my->id == 0)) {
		if (!$my->id || $my->id == 0) {

			hwd_ps_tools::infomessage(1, 0, _HWDPS_AJAX_LOG2RATE, _HWDPS_ALERT_LOG2RATE, "exclamation.png", 1);
			return;

		} else if ( $total>0 ) {

			hwd_ps_tools::infomessage(1, 0, _HWDPS_AJAX_ALREADYRATE, _HWDPS_AJAX_ALREADYRATE, "exclamation.png", 1);
			return;

		} else {

			//update rating details
			$rating_number_votes = $row->rating_number_votes + 1;
			$rating_total_points = $row->rating_total_points + $rating;
			$new_rating = $rating_total_points / $rating_number_votes;

			$db->setQuery( "UPDATE #__hwdpsphotos"
					 . "\nSET rating_number_votes = $rating_number_votes, rating_total_points = $rating_total_points, updated_rating = $new_rating"
				   . "\nWHERE id = $photoid"
				   );

			if (!$db->query()) {
				echo "<script> alert('".$db->getErrorMsg()."'); window.history.go(-1); </script>\n";
				exit();
			}

			// mark video as rated by this user
			$row = new hwdps_rating($db);

			$_POST['userid'] = $my->id;
			$_POST['photoid'] = $photoid;
			$_POST['ip'] = $ip;

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

			//connecting to the database to get some information
			$numbers['total_votes'] = $rating_number_votes;
			$numbers['total_value'] = $rating_total_points;

			$count = $numbers['total_votes']; //how many votes total
			$current_rating = $numbers['total_value']; //total number of rating added together and stored
			$sum = $rating+$current_rating; // add together the current vote value and the total vote value


			hwd_ps_tools::infomessage(1, 0, _HWDPS_AJAX_RATEADDED, _HWDPS_AJAX_RATEADDED, "exclamation.png", 1);

		}

		hwd_ps_tools::logRating( $photoid, $rating );
		return;

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
    function addFavourite()
	{
	global $database, $my, $acl, $mosConfig_absolute_path, $mosConfig_mailfrom, $mosConfig_fromname, $mosConfig_live_site, $Itemid, $mosConfig_sitename;
	$c = hwd_ps_Config::get_instance();

		if (!$my->id) {
			hwd_ps_tools::infomessage(1, 0, _HWDPS_TITLE_UPLDFAIL, _HWDPS_ALERT_LOG2ADDF, "exclamation.png", 1);
			return;
		}

		$userid = $my->id;
		$videoid = intval ( mosGetParam($_POST, 'videoid') );

		$where = ' WHERE a.userid = '.$userid;
		$where .= ' AND a.videoid = '.$videoid;

		$database->SetQuery( 'SELECT count(*)'
							. ' FROM #__hwdpsfavorites AS a'
							. $where
							);
  		$total = $database->loadResult();

		if ( $total>0 ) {
			hwd_ps_tools::infomessage(1, 0, _HWDPS_TITLE_UPLDFAIL, _HWDPS_ALERT_ALREADYFAV, "exclamation.png", 1);
			return;
		}

		$row = new hwdps_favs($database);

		$_POST['userid'] = $userid;
		$_POST['videoid'] = $videoid;

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

		hwd_ps_tools::logFavour( $videoid, 1 );
		hwd_ps_tools::infomessage(1, 0, _HWDPS_TITLE_UPLDFAIL, _HWDPS_ALERT_FAVADDED, "exclamation.png", 1);
		return;
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
    function removeFavourite()
	{
	global $database, $my, $acl, $mosConfig_absolute_path, $mosConfig_mailfrom, $mosConfig_fromname, $mosConfig_live_site, $Itemid, $mosConfig_sitename;
	$c = hwd_ps_Config::get_instance();

		if (!$my->id) {
			hwd_ps_tools::infomessage(1, 0, _HWDPS_TITLE_UPLDFAIL, _HWDPS_ALERT_LOG2REMF, "exclamation.png", 1);
			return;
		}

		$userid = $my->id;
		$videoid = intval ( mosGetParam($_POST, 'videoid') );

		$where = ' WHERE userid = '.$userid;
		$where .= ' AND videoid = '.$videoid;

		$database->SetQuery( 'DELETE FROM #__hwdpsfavorites'
							. $where
						    );

		if ( !$database->query() ) {
			echo "<script> alert('".$database->getErrorMsg()."'); window.history.go(-1); </script>\n";
			exit();
		}

		hwd_ps_tools::logFavour( $videoid, -1 );
		hwd_ps_tools::infomessage(4, 0, _HWDPS_TITLE_UPLDFAIL, _HWDPS_ALERT_FAVREM, "exclamation.png", 1);
		return;
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
    function reportPhoto()
	{
	global $database, $my, $acl, $mosConfig_absolute_path, $mosConfig_mailfrom, $mosConfig_fromname, $mosConfig_live_site, $Itemid, $mosConfig_sitename;
	$c = hwd_ps_Config::get_instance();

		if (!$my->id) {
			hwd_ps_tools::infomessage(1, 0, _HWDPS_TITLE_UPLDFAIL, _HWDPS_ALERT_LOG2FLAG, "exclamation.png", 1);
			return;
		}

		$userid = $my->id;
		$videoid = intval ( mosGetParam($_POST, 'videoid') );

		$where = ' WHERE a.videoid = '.$videoid;

		$database->SetQuery( 'SELECT count(*)'
							. ' FROM #__hwdpsflagged_photos AS a'
							. $where
							);
  		$total = $database->loadResult();

		if ( $total>0 ) {
			hwd_ps_tools::infomessage(1, 0, _HWDPS_TITLE_UPLDFAIL, _HWDPS_ALERT_ALREADYFLAG, "exclamation.png", 1);
			return;
		}

		$row = new hwdps_flagvid($database);

		$_POST['userid'] = $userid;
		$_POST['videoid'] = $videoid;
		$_POST['status'] = "UNREAD";
		$_POST['date'] = date('Y-m-d H:i:s');

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

		hwd_ps_tools::infomessage(1, 0, _HWDPS_TITLE_UPLDFAIL, _HWDPS_ALERT_SUCFLAGGED, "exclamation.png", 1);
		return;
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
    function reportGroup()
	{
	global $database, $my, $acl, $mosConfig_absolute_path, $mosConfig_mailfrom, $mosConfig_fromname, $mosConfig_live_site, $Itemid, $mosConfig_sitename;
	$c = hwd_ps_Config::get_instance();
		$url = $database->getEscaped( strip_tags( trim( strtolower( mosGetParam( $_POST, 'url' ) ) ) ) );

		if (!$my->id) {
			$msg = _HWDPS_ALERT_LOG2FLAG;
			mosRedirect( $url, $msg );
		}

		$userid = $my->id;
		$groupid = intval ( mosGetParam($_POST, 'groupid') );

		$where = ' WHERE a.groupid = '.$groupid;

		$database->SetQuery( 'SELECT count(*)'
							. ' FROM #__hwdpsflagged_groups AS a'
							. $where
							);
  		$total = $database->loadResult();

		if ( $total>0 ) {
			$msg = _HWDPS_ALERT_ALREADYFLAG;
			mosRedirect( $url, $msg );
		}

		$row = new hwdps_flaggroup($database);

		$_POST['userid'] = $userid;
		$_POST['groupid'] = $groupid;
		$_POST['status'] = "UNREAD";
		$_POST['date'] = date('Y-m-d H:i:s');

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

		$msg = _HWDPS_ALERT_SUCFLAGGED;
		mosRedirect( $url, $msg );
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
    function addPhotoToGroup()
	{
	global $database, $my, $acl, $mosConfig_absolute_path, $mosConfig_mailfrom, $mosConfig_fromname, $mosConfig_live_site, $Itemid, $mosConfig_sitename;
	$c = hwd_ps_Config::get_instance();
		$url = $database->getEscaped( strip_tags( trim( strtolower( mosGetParam( $_POST, 'url' ) ) ) ) );

		if (!$my->id) {
			hwd_ps_tools::infomessage(1, 0, _HWDPS_TITLE_UPLDFAIL, _HWDPS_ALERT_LOG2AV2G, "exclamation.png", 1);
			return;
		}

		$userid = $my->id;
		$videoid = intval ( mosGetParam($_POST, 'videoid') );
		$groupid = intval ( mosGetParam($_POST, 'groupid') );
		$date = date('Y-m-d H:i:s');
		$published = 1;

		if ($groupid == 0) {
			hwd_ps_tools::infomessage(1, 0, _HWDPS_TITLE_UPLDFAIL, _HWDPS_ALERTSELGROUP, "exclamation.png", 1);
			return;
		}

		$where = ' WHERE a.videoid = '.$videoid;
		$where .= ' AND a.groupid = '.$groupid;

		$database->SetQuery( 'SELECT count(*)'
							. ' FROM #__hwdpsgroup_photos AS a'
							. $where
							);
  		$total = $database->loadResult();

		if ( $total>0 ) {
			hwd_ps_tools::infomessage(1, 0, _HWDPS_TITLE_UPLDFAIL, _HWDPS_ALERT_ALREADYAV2G, "exclamation.png", 1);
			return;
		}

		$row = new hwdps_groupvideo($database);

		$_POST['videoid'] = $videoid;
		$_POST['groupid'] = $groupid;
		$_POST['memberid'] = $userid;
		$_POST['date'] = $date;

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
		include(HWDPSPATH.'/../../administrator/components/com_hwdphotoshare/maintenance/recount.class.php');
		hwd_ps_recount::recountVideosInGroup($groupid);

		hwd_ps_tools::infomessage(1, 0, _HWDPS_TITLE_UPLDFAIL, _HWDPS_ALERT_SUCAV2G, "exclamation.png", 1);
		return;
	}
}
?>