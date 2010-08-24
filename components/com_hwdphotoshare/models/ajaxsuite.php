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
class hwd_ps_ajax
{
    /**
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

		$code='<div id="hwdpsrb"><ul id="1001" class="rating rated'.$rating0.'star">
			  <li id="1" class="rate one"><a href="'.JURI::root( true ).'/index.php?option=com_hwdphotoshare&task=rate&photoid='.$row->id.'&rating=1" onclick="ajaxFunctionRate(1);return false;" title="1 Star">1</a></li>
			  <li id="2" class="rate two"><a href="'.JURI::root( true ).'/index.php?option=com_hwdphotoshare&task=rate&photoid='.$row->id.'&rating=2" onclick="ajaxFunctionRate(2);return false;" title="2 Stars">2</a></li>
			  <li id="3" class="rate three"><a href="'.JURI::root( true ).'/index.php?option=com_hwdphotoshare&task=rate&photoid='.$row->id.'&rating=3" onclick="ajaxFunctionRate(3);return false;" title="3 Stars">3</a></li>
			  <li id="4" class="rate four"><a href="'.JURI::root( true ).'/index.php?option=com_hwdphotoshare&task=rate&photoid='.$row->id.'&rating=4" onclick="ajaxFunctionRate(4);return false;" title="4 Stars">4</a></li>
			  <li id="5" class="rate five"><a href="'.JURI::root( true ).'/index.php?option=com_hwdphotoshare&task=rate&photoid='.$row->id.'&rating=5" onclick="ajaxFunctionRate(5);return false;" title="5 Stars">5</a></li>
		</ul>';

		// Stop if user not logged in and guest rating blocked
		// if ($c->allowgr == 0 && (!$my->id || $my->id == 0)) {
		if (!$my->id || $my->id == 0) {

			$code.=_HWDPS_INFO_RATED.'<strong> '.$rating1.'</strong> ('.$count.' '.$tense.')';
			$code.='<br /><p><span class="error">'._HWDPS_AJAX_LOG2RATE.'</span></p>';

		} else if ( $total>0 ) {

			$code.=_HWDPS_INFO_RATED.'<strong> '.$rating1.'</strong> ('.$count.' '.$tense.')';
			$code.='<br /><p><span class="error">'._HWDPS_AJAX_ALREADYRATE.'</span></p>';

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

			$code='<div id="hwdvsrb"><ul id="1001" class="rating rated'.@number_format($new_rating,0).'star">
			  <li id="1" class="rate one"><a href="'.JURI::root( true ).'/index.php?option=com_hwdphotoshare&task=rate&photoid='.$row->id.'&rating=1" onclick="ajaxFunctionRate(1);return false;" title="1 Star">1</a></li>
			  <li id="2" class="rate two"><a href="'.JURI::root( true ).'/index.php?option=com_hwdphotoshare&task=rate&photoid='.$row->id.'&rating=2" onclick="ajaxFunctionRate(2);return false;" title="2 Stars">2</a></li>
			  <li id="3" class="rate three"><a href="'.JURI::root( true ).'/index.php?option=com_hwdphotoshare&task=rate&photoid='.$row->id.'&rating=3" onclick="ajaxFunctionRate(3);return false;" title="3 Stars">3</a></li>
			  <li id="4" class="rate four"><a href="'.JURI::root( true ).'/index.php?option=com_hwdphotoshare&task=rate&photoid='.$row->id.'&rating=4" onclick="ajaxFunctionRate(4);return false;" title="4 Stars">4</a></li>
			  <li id="5" class="rate five"><a href="'.JURI::root( true ).'/index.php?option=com_hwdphotoshare&task=rate&photoid='.$row->id.'&rating=5" onclick="ajaxFunctionRate(5);return false;" title="5 Stars">5</a></li>
			</ul>';
			$code.=_HWDPS_INFO_RATED.'<strong> '.@number_format($new_rating,1).'</strong> ('.$count.' '.$tense.')';
			$code.='<br /><p><span class="success">'._HWDPS_ALERT_THANKSVOTER.'</span></p>';

		}

		$code.= '<script>
			$$(\'.rate\').each(function(element,i){
				element.addEvent(\'click\', function(){
					var myStyles = [\'0star\', \'1star\', \'2star\', \'3star\', \'4star\', \'5star\'];
					myStyles.each(function(myStyle){
						if(element.getParent().hasClass(myStyle)){
							element.getParent().removeClass(myStyle)
						}
					});
					myStyles.each(function(myStyle, index){
						if(index == element.id){
							element.getParent().toggleClass(myStyle);
							ajaxFunctionRate(element.id)
						}
					});

				});
			});
			</script>
			</div>';

		echo $code;
		hwd_ps_tools::logRating( $photoid, $rating );

		exit;
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

    function addToFavourites()
	{
	global $database, $my, $acl, $mosConfig_absolute_path, $mosConfig_mailfrom, $mosConfig_fromname, $mosConfig_live_site, $Itemid, $mosConfig_sitename;

		$c = hwd_ps_Config::get_instance();
		$db = & JFactory::getDBO();
		$my = & JFactory::getUser();

		if (!$my->id) {
			echo _HWDPS_AJAX_LOG2FAV1;
			exit;
		}

		$userid = $my->id;
		$photoid = JRequest::getInt( 'photoid', 0, 'request' );

		$where = ' WHERE a.userid = '.$userid;
		$where .= ' AND a.photoid = '.$photoid;

		$db->SetQuery( 'SELECT count(*)'
               		. ' FROM #__hwdpsfavorites AS a'
               		. $where
               		);
  		$total = $db->loadResult();

		if ( $total>0 ) {
			echo _HWDPS_AJAX_ALREADYFAV;
			exit;
		}

		$row = new hwdps_favs($db);

		$_POST['userid'] = $userid;
		$_POST['photoid'] = $photoid;

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

		hwd_ps_tools::logFavour( $photoid, 1 );
		echo _HWDPS_AJAX_ADDEDFAV;
		exit;
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

    function removeFromFavourites()
	{
	global $database, $my, $acl, $mosConfig_absolute_path, $mosConfig_mailfrom, $mosConfig_fromname, $mosConfig_live_site, $Itemid, $mosConfig_sitename;
		$c = hwd_ps_Config::get_instance();
		$db = & JFactory::getDBO();
		$my = & JFactory::getUser();

		if (!$my->id) {
			echo _HWDPS_AJAX_LOG2FAV2;
			exit;
		}

		$userid = $my->id;
		$photoid = JRequest::getInt( 'photoid', 0, 'request' );

		$where = ' WHERE userid = '.$userid;
		$where .= ' AND photoid = '.$photoid;

		$db->SetQuery( 'DELETE FROM #__hwdpsfavorites'
               		. $where
               		);

		if ( !$db->query() ) {
			echo "<script> alert('".$db->getErrorMsg()."'); window.history.go(-1); </script>\n";
			exit();
		}

		hwd_ps_tools::logFavour( $photoid, -1 );
		echo _HWDPS_AJAX_REMFAV;
		exit;
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
		global  $Itemid;

		$c = hwd_ps_Config::get_instance();
		$db = & JFactory::getDBO();
		$my = & JFactory::getUser();

		if (!$my->id) {
			echo _HWDPS_AJAX_LOG2REPORT;
			exit;
		}

		$userid = $my->id;
		$photoid = JRequest::getInt( 'photoid', 0, 'request' );

		$db->SetQuery( 'SELECT count(*) FROM #__hwdpsflagged_photos WHERE photoid = '.$photoid );
  		$total = $db->loadResult();

		if ( $total > 0 ) {
			echo _HWDPS_AJAX_ALREADYREPORT;
			exit;
		}

		$row = new hwdps_flagphoto($db);

		$_POST['userid'] = $userid;
		$_POST['photoid'] = $photoid;
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

		echo _HWDPS_AJAX_VIDREPORT;
		exit;
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

		if (!$my->id) {
			echo _HWDPS_AJAX_LOG2ADD2G;
			exit;
		}

		$user_id = $my->id;
		$videoid = intval ( mosGetParam($_GET, 'videoid') );
		$groupid = intval ( mosGetParam($_GET, 'groupid') );
		$date = date('Y-m-d H:i:s');
		$published = 1;

		if ($groupid == 0) {
			echo _HWDPS_ALERTSELGROUP;
			exit;
		}

		$where = ' WHERE a.videoid = '.$videoid;
		$where .= ' AND a.groupid = '.$groupid;

		$database->SetQuery( 'SELECT count(*)'
							. ' FROM #__hwdpsgroup_photos AS a'
							. $where
							);
  		$total = $database->loadResult();

		if ( $total>0 ) {
			echo _HWDPS_ALERT_ALREADYAV2G;
			exit;
		}

		$row = new hwdps_groupvideo($database);

		$_POST['videoid'] = intval ( mosGetParam($_GET, 'videoid') );
		$_POST['groupid'] = intval ( mosGetParam($_GET, 'groupid') );
		$_POST['memberid'] = intval ( mosGetParam($_GET, 'userid') );
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

		echo _HWDPS_ALERT_SUCAV2G;
		exit;
	}
}
?>