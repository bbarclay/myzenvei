<?php
/**
 *    @version [ Dannevirke ]
 *    @package hwdVideoShare
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
 * This class is the HTML generator for hwdVideoShare frontend
 *
 * @package    hwdVideoShare
 * @author     Dave Horsfall <info@highwooddesign.co.uk>
 * @copyright  2008 Highwood Design
 * @license    http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @version    1.1.4 Alpha RC2.13
 */
class HWDVS_xmlOutput
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
    function checkCacheThenWrite()
    {
    	// get general configuration data
		$c = hwd_vs_Config::get_instance();
  		$db =& JFactory::getDBO();
		$my = & JFactory::getUser();

		require_once(JPATH_SITE.DS.'administrator'.DS.'components'.DS.'com_hwdvideoshare'.DS.'helpers'.DS.'draw.php');

		$cpl = JRequest::getCmd( 'cpl', null );
		if ($cpl == 1) {

			if (!empty($c->xmlcustom01)) {
				$playlist = explode(",", $c->xmlcustom01);
				$playlist = preg_replace("/[^0-9]/", "", $playlist);
				$playlist = implode(",", $playlist);
				$db->SetQuery('SELECT * FROM #__hwdvidsvideos WHERE id IN ('.$playlist.')');
				$rows_custom01 = $db->loadObjectList();
				hwdvsDrawFile::XMLDataFile($rows_custom01, 'custom01');
				hwdvsDrawFile::XMLPlaylistFile($rows_custom01, 'custom01');
			}
			return;

		} else if ($cpl == 2) {

			if (!empty($c->xmlcustom02)) {
				$playlist = explode(",", $c->xmlcustom02);
				$playlist = preg_replace("/[^0-9]/", "", $playlist);
				$playlist = implode(",", $playlist);
				$db->SetQuery('SELECT * FROM #__hwdvidsvideos WHERE id IN ('.$playlist.')');
				$rows_custom02 = $db->loadObjectList();
				hwdvsDrawFile::XMLDataFile($rows_custom02, 'custom02');
				hwdvsDrawFile::XMLPlaylistFile($rows_custom02, 'custom02');
			}
			return;

		} else if ($cpl == 3) {

			if (!empty($c->xmlcustom03)) {
				$playlist = explode(",", $c->xmlcustom03);
				$playlist = preg_replace("/[^0-9]/", "", $playlist);
				$playlist = implode(",", $playlist);
				$db->SetQuery('SELECT * FROM #__hwdvidsvideos WHERE id IN ('.$playlist.')');
				$rows_custom03 = $db->loadObjectList();
				hwdvsDrawFile::XMLDataFile($rows_custom03, 'custom03');
				hwdvsDrawFile::XMLPlaylistFile($rows_custom03, 'custom03');
			}
			return;

		} else if ($cpl == 4) {

			if (!empty($c->xmlcustom04)) {
				$playlist = explode(",", $c->xmlcustom04);
				$playlist = preg_replace("/[^0-9]/", "", $playlist);
				$playlist = implode(",", $playlist);
				$db->SetQuery('SELECT * FROM #__hwdvidsvideos WHERE id IN ('.$playlist.')');
				$rows_custom04 = $db->loadObjectList();
				hwdvsDrawFile::XMLDataFile($rows_custom04, 'custom04');
				hwdvsDrawFile::XMLPlaylistFile($rows_custom04, 'custom04');
			}
			return;

		} else if ($cpl == 5) {

			if (!empty($c->xmlcustom05)) {
				$playlist = explode(",", $c->xmlcustom05);
				$playlist = preg_replace("/[^0-9]/", "", $playlist);
				$playlist = implode(",", $playlist);
				$db->SetQuery('SELECT * FROM #__hwdvidsvideos WHERE id IN ('.$playlist.')');
				$rows_custom05 = $db->loadObjectList();
				hwdvsDrawFile::XMLDataFile($rows_custom05, 'custom05');
				hwdvsDrawFile::XMLPlaylistFile($rows_custom05, 'custom05');
			}
			return;

		}

		// set cache variables
		$cachedir = JPATH_SITE.'/cache/'; // Directory to cache files in (keep outside web root)
		$cacheext = 'cache'; // Extension to give cached files (usually cache, htm, txt)

		/**
		 * Generate Today's Playlists
		 */
		$cachetime = $c->xmlcache_today; // Seconds to cache files for
		$page = 'http://xmlplaylists_today'; // Requested page
		$cachefile = $cachedir . md5($page) . '.' . $cacheext; // Cache file to either load or create
		$cachefile_created = (@file_exists($cachefile)) ? @filemtime($cachefile) : 0;
		@clearstatcache();

		// Show file from cache if still valid
		if (time() - $cachetime < $cachefile_created) {
			//echo "ALREADY CACHED";
		} else {
			 // Now the script has run, generate a new cache file
			$fp = fopen($cachefile, 'w');

			// save the contents of output buffer to the file
			@fwrite($fp, ob_get_contents());
			@fclose($fp);

			// sql search filters
			$where = ' WHERE published = 1';
			$where .= ' AND approved = "yes"';
			if (!$my->id) {
			$where .= ' AND public_private = "public"';
			}

			$join = ' LEFT JOIN #__users ON #__users.id = #__hwdvidsvideos.user_id';
			if ($c->userdisplay == 1) {
				$select = '#__users.username,';
			} else {
				$select = '#__users.name,';
			}
			if ($c->cbint == "2") {
				$join.= ' LEFT JOIN #__community_users ON #__community_users.userid = #__hwdvidsvideos.user_id';
				$select.= ' #__community_users.*,';
			} else if ($c->cbint == "1") {
				$join.= ' LEFT JOIN #__comprofiler ON #__comprofiler.user_id = #__hwdvidsvideos.user_id';
				$select.= ' #__comprofiler.avatar,';
			}

			// query SQL for today's data
			$db->SetQuery('SELECT #__hwdvidsvideos.*, '.$select.' COUNT(#__hwdvidslogs_views.videoid) AS counts FROM #__hwdvidsvideos LEFT JOIN #__hwdvidslogs_views ON #__hwdvidsvideos.id = #__hwdvidslogs_views.videoid '.$join.' WHERE #__hwdvidslogs_views.date >= DATE_SUB(NOW(),INTERVAL 1 DAY) AND #__hwdvidsvideos.approved = "yes" AND #__hwdvidsvideos.published = 1 GROUP BY #__hwdvidsvideos.id ORDER BY counts DESC LIMIT 0, 10');
			$rowsmostviewed_today = $db->loadObjectList();
			$db->SetQuery('SELECT #__hwdvidsvideos.*, '.$select.' COUNT(#__hwdvidslogs_favours.videoid) AS counts FROM #__hwdvidsvideos LEFT JOIN #__hwdvidslogs_favours ON #__hwdvidsvideos.id = #__hwdvidslogs_favours.videoid '.$join.' WHERE #__hwdvidslogs_favours.date >= DATE_SUB(NOW(),INTERVAL 1 DAY) AND favour = 1 AND #__hwdvidsvideos.approved = "yes" AND #__hwdvidsvideos.published = 1 GROUP BY #__hwdvidsvideos.id ORDER BY counts DESC LIMIT 0, 10');
			$rowsmostfavoured_today = $db->loadObjectList();
			$db->SetQuery('SELECT #__hwdvidsvideos.*, '.$select.' SUM(#__hwdvidslogs_votes.vote)/COUNT(#__hwdvidslogs_votes.videoid) AS sums, COUNT(#__hwdvidslogs_votes.videoid) AS counts FROM #__hwdvidsvideos LEFT JOIN #__hwdvidslogs_votes ON #__hwdvidsvideos.id = #__hwdvidslogs_votes.videoid '.$join.' WHERE #__hwdvidslogs_votes.date >= DATE_SUB(NOW(),INTERVAL 1 DAY) AND #__hwdvidsvideos.approved = "yes" AND #__hwdvidsvideos.published = 1 GROUP BY #__hwdvidsvideos.id ORDER BY sums DESC LIMIT 0, 10');
			$rowsmostpopular_today = $db->loadObjectList();
			hwdvsDrawFile::XMLDataFile($rowsmostviewed_today, 'mostviewed_today');
			hwdvsDrawFile::XMLDataFile($rowsmostfavoured_today, 'mostfavoured_today');
			hwdvsDrawFile::XMLDataFile($rowsmostpopular_today, 'mostpopular_today');
			hwdvsDrawFile::XMLPlaylistFile($rowsmostviewed_today, 'mostviewed_today');
			hwdvsDrawFile::XMLPlaylistFile($rowsmostfavoured_today, 'mostfavoured_today');
			hwdvsDrawFile::XMLPlaylistFile($rowsmostpopular_today, 'mostpopular_today');
		}

		/**
		 * Generate This Weeks's Playlists
		 */
		$cachetime = $c->xmlcache_thisweek; // Seconds to cache files for
		$page = 'http://xmlplaylists_thisweek'; // Requested page
		$cachefile = $cachedir . md5($page) . '.' . $cacheext; // Cache file to either load or create
		$cachefile_created = (@file_exists($cachefile)) ? @filemtime($cachefile) : 0;
		@clearstatcache();

		// Show file from cache if still valid
		if (time() - $cachetime < $cachefile_created) {
			//echo "ALREADY CACHED";
		} else {
			 // Now the script has run, generate a new cache file
			$fp = @fopen($cachefile, 'w');

			// save the contents of output buffer to the file
			@fwrite($fp, ob_get_contents());
			@fclose($fp);

			// sql search filters
			$where = ' WHERE published = 1';
			$where .= ' AND approved = "yes"';
			if (!$my->id) {
			$where .= ' AND public_private = "public"';
			}

			$join = ' LEFT JOIN #__users ON #__users.id = #__hwdvidsvideos.user_id';
			if ($c->userdisplay == 1) {
				$select = '#__users.username,';
			} else {
				$select = '#__users.name,';
			}
			if ($c->cbint == "2") {
				$join.= ' LEFT JOIN #__community_users ON #__community_users.userid = #__hwdvidsvideos.user_id';
				$select.= ' #__community_users.*,';
			} else if ($c->cbint == "1") {
				$join.= ' LEFT JOIN #__comprofiler ON #__comprofiler.user_id = #__hwdvidsvideos.user_id';
				$select.= ' #__comprofiler.avatar,';
			}

			// query SQL for this week's data
			$db->SetQuery('SELECT #__hwdvidsvideos.*, '.$select.' COUNT(#__hwdvidslogs_views.videoid) AS counts FROM #__hwdvidsvideos LEFT JOIN #__hwdvidslogs_views ON #__hwdvidsvideos.id = #__hwdvidslogs_views.videoid '.$join.' WHERE #__hwdvidslogs_views.date >= DATE_SUB(NOW(),INTERVAL 7 DAY) AND #__hwdvidsvideos.approved = "yes" AND #__hwdvidsvideos.published = 1 GROUP BY #__hwdvidsvideos.id ORDER BY counts DESC LIMIT 0, 10');
			$rowsmostviewed_thisweek = $db->loadObjectList();
			$db->SetQuery('SELECT #__hwdvidsvideos.*, '.$select.' COUNT(#__hwdvidslogs_favours.videoid) AS counts FROM #__hwdvidsvideos LEFT JOIN #__hwdvidslogs_favours ON #__hwdvidsvideos.id = #__hwdvidslogs_favours.videoid '.$join.' WHERE #__hwdvidslogs_favours.date >= DATE_SUB(NOW(),INTERVAL 7 DAY) AND #__hwdvidsvideos.approved = "yes" AND #__hwdvidsvideos.published = 1 GROUP BY #__hwdvidsvideos.id ORDER BY counts DESC LIMIT 0, 10');
			$rowsmostfavoured_thisweek = $db->loadObjectList();
			$db->SetQuery('SELECT #__hwdvidsvideos.*, '.$select.' SUM(#__hwdvidslogs_votes.vote)/COUNT(#__hwdvidslogs_votes.videoid) AS sums, COUNT(#__hwdvidslogs_votes.videoid) AS counts FROM #__hwdvidsvideos LEFT JOIN #__hwdvidslogs_votes ON #__hwdvidsvideos.id = #__hwdvidslogs_votes.videoid '.$join.' WHERE #__hwdvidslogs_votes.date >= DATE_SUB(NOW(),INTERVAL 7 DAY) AND #__hwdvidsvideos.approved = "yes" AND #__hwdvidsvideos.published = 1 GROUP BY #__hwdvidsvideos.id ORDER BY sums DESC LIMIT 0, 10');
			$rowsmostpopular_thisweek = $db->loadObjectList();
			hwdvsDrawFile::XMLDataFile($rowsmostviewed_thisweek, 'mostviewed_thisweek');
			hwdvsDrawFile::XMLDataFile($rowsmostfavoured_thisweek, 'mostfavoured_thisweek');
			hwdvsDrawFile::XMLDataFile($rowsmostpopular_thisweek, 'mostpopular_thisweek');
			hwdvsDrawFile::XMLPlaylistFile($rowsmostviewed_thisweek, 'mostviewed_thisweek');
			hwdvsDrawFile::XMLPlaylistFile($rowsmostfavoured_thisweek, 'mostfavoured_thisweek');
			hwdvsDrawFile::XMLPlaylistFile($rowsmostpopular_thisweek, 'mostpopular_thisweek');

			if (!empty($c->xmlcustom01)) {
				$playlist = explode(",", $c->xmlcustom01);
				$playlist = preg_replace("/[^0-9]/", "", $playlist);
				$playlist = implode(",", $playlist);
				$db->SetQuery('SELECT * FROM #__hwdvidsvideos WHERE id IN ('.$playlist.')');
				$rows_custom01 = $db->loadObjectList();
				hwdvsDrawFile::XMLDataFile($rows_custom01, 'custom01');
				hwdvsDrawFile::XMLPlaylistFile($rows_custom01, 'custom01');
			}
			if (!empty($c->xmlcustom02)) {
				$playlist = explode(",", $c->xmlcustom02);
				$playlist = preg_replace("/[^0-9]/", "", $playlist);
				$playlist = implode(",", $playlist);
				$db->SetQuery('SELECT * FROM #__hwdvidsvideos WHERE id IN ('.$playlist.')');
				$rows_custom02 = $db->loadObjectList();
				hwdvsDrawFile::XMLDataFile($rows_custom02, 'custom02');
				hwdvsDrawFile::XMLPlaylistFile($rows_custom02, 'custom02');
			}
			if (!empty($c->xmlcustom03)) {
				$playlist = explode(",", $c->xmlcustom03);
				$playlist = preg_replace("/[^0-9]/", "", $playlist);
				$playlist = implode(",", $playlist);
				$db->SetQuery('SELECT * FROM #__hwdvidsvideos WHERE id IN ('.$playlist.')');
				$rows_custom03 = $db->loadObjectList();
				hwdvsDrawFile::XMLDataFile($rows_custom03, 'custom03');
				hwdvsDrawFile::XMLPlaylistFile($rows_custom03, 'custom03');
			}
			if (!empty($c->xmlcustom04)) {
				$playlist = explode(",", $c->xmlcustom04);
				$playlist = preg_replace("/[^0-9]/", "", $playlist);
				$playlist = implode(",", $playlist);
				$db->SetQuery('SELECT * FROM #__hwdvidsvideos WHERE id IN ('.$playlist.')');
				$rows_custom04 = $db->loadObjectList();
				hwdvsDrawFile::XMLDataFile($rows_custom04, 'custom04');
				hwdvsDrawFile::XMLPlaylistFile($rows_custom04, 'custom04');
			}
			if (!empty($c->xmlcustom05)) {
				$playlist = explode(",", $c->xmlcustom05);
				$playlist = preg_replace("/[^0-9]/", "", $playlist);
				$playlist = implode(",", $playlist);
				$db->SetQuery('SELECT * FROM #__hwdvidsvideos WHERE id IN ('.$playlist.')');
				$rows_custom05 = $db->loadObjectList();
				hwdvsDrawFile::XMLDataFile($rows_custom05, 'custom05');
				hwdvsDrawFile::XMLPlaylistFile($rows_custom05, 'custom05');
			}
		}

		/**
		 * Generate This Month's Playlists
		 */
		$cachetime = $c->xmlcache_thismonth; // Seconds to cache files for
		$page = 'http://xmlplaylists_thismonth'; // Requested page
		$cachefile = $cachedir . md5($page) . '.' . $cacheext; // Cache file to either load or create
		$cachefile_created = (@file_exists($cachefile)) ? @filemtime($cachefile) : 0;
		@clearstatcache();

		// Show file from cache if still valid
		if (time() - $cachetime < $cachefile_created) {
			//echo "ALREADY CACHED";
		} else {
			 // Now the script has run, generate a new cache file
			$fp = @fopen($cachefile, 'w');

			// save the contents of output buffer to the file
			@fwrite($fp, ob_get_contents());
			@fclose($fp);

			$join = ' LEFT JOIN #__users ON #__users.id = #__hwdvidsvideos.user_id';
			if ($c->userdisplay == 1) {
				$select = '#__users.username,';
			} else {
				$select = '#__users.name,';
			}
			if ($c->cbint == "2") {
				$join.= ' LEFT JOIN #__community_users ON #__community_users.userid = #__hwdvidsvideos.user_id';
				$select.= ' #__community_users.*,';
			} else if ($c->cbint == "1") {
				$join.= ' LEFT JOIN #__comprofiler ON #__comprofiler.user_id = #__hwdvidsvideos.user_id';
				$select.= ' #__comprofiler.avatar,';
			}

			// sql search filters
			$where = ' WHERE published = 1';
			$where .= ' AND approved = "yes"';
			if (!$my->id) {
			$where .= ' AND public_private = "public"';
			}

			// query SQL for this month's data
			$db->SetQuery('SELECT #__hwdvidsvideos.*, '.$select.' COUNT(#__hwdvidslogs_views.videoid) AS counts FROM #__hwdvidsvideos LEFT JOIN #__hwdvidslogs_views ON #__hwdvidsvideos.id = #__hwdvidslogs_views.videoid '.$join.' WHERE #__hwdvidslogs_views.date >= DATE_SUB(NOW(),INTERVAL 30 DAY) AND #__hwdvidsvideos.approved = "yes" AND #__hwdvidsvideos.published = 1 GROUP BY #__hwdvidsvideos.id ORDER BY counts DESC LIMIT 0, 10');
			$rowsmostviewed_thismonth = $db->loadObjectList();
			$db->SetQuery('SELECT #__hwdvidsvideos.*, '.$select.' COUNT(#__hwdvidslogs_favours.videoid) AS counts FROM #__hwdvidsvideos LEFT JOIN #__hwdvidslogs_favours ON #__hwdvidsvideos.id = #__hwdvidslogs_favours.videoid '.$join.' WHERE #__hwdvidslogs_favours.date >= DATE_SUB(NOW(),INTERVAL 30 DAY) AND #__hwdvidsvideos.approved = "yes" AND #__hwdvidsvideos.published = 1 GROUP BY #__hwdvidsvideos.id ORDER BY counts DESC LIMIT 0, 10');
			$rowsmostfavoured_thismonth = $db->loadObjectList();
			$db->SetQuery('SELECT #__hwdvidsvideos.*, '.$select.' SUM(#__hwdvidslogs_votes.vote)/COUNT(#__hwdvidslogs_votes.videoid) AS sums, COUNT(#__hwdvidslogs_votes.videoid) AS counts FROM #__hwdvidsvideos LEFT JOIN #__hwdvidslogs_votes ON #__hwdvidsvideos.id = #__hwdvidslogs_votes.videoid '.$join.' WHERE #__hwdvidslogs_votes.date >= DATE_SUB(NOW(),INTERVAL 30 DAY) AND #__hwdvidsvideos.approved = "yes" AND #__hwdvidsvideos.published = 1 GROUP BY #__hwdvidsvideos.id ORDER BY sums DESC LIMIT 0, 10');
			$rowsmostpopular_thismonth = $db->loadObjectList();
			hwdvsDrawFile::XMLDataFile($rowsmostviewed_thismonth, 'mostviewed_thismonth');
			hwdvsDrawFile::XMLDataFile($rowsmostfavoured_thismonth, 'mostfavoured_thismonth');
			hwdvsDrawFile::XMLDataFile($rowsmostpopular_thismonth, 'mostpopular_thismonth');
			hwdvsDrawFile::XMLPlaylistFile($rowsmostviewed_thismonth, 'mostviewed_thismonth');
			hwdvsDrawFile::XMLPlaylistFile($rowsmostfavoured_thismonth, 'mostfavoured_thismonth');
			hwdvsDrawFile::XMLPlaylistFile($rowsmostpopular_thismonth, 'mostpopular_thismonth');
		}

		/**
		 * Generate All Time Playlists
		 */
		$cachetime = $c->xmlcache_thismonth; // Seconds to cache files for
		$page = 'http://xmlplaylists_alltime'; // Requested page
		$cachefile = $cachedir . md5($page) . '.' . $cacheext; // Cache file to either load or create
		$cachefile_created = (@file_exists($cachefile)) ? @filemtime($cachefile) : 0;
		@clearstatcache();

		// Show file from cache if still valid
		if (time() - $cachetime < $cachefile_created) {
			//echo "ALREADY CACHED";
		} else {
			 // Now the script has run, generate a new cache file
			$fp = @fopen($cachefile, 'w');

			// save the contents of output buffer to the file
			@fwrite($fp, ob_get_contents());
			@fclose($fp);

			// sql search filters
			$where = ' WHERE published = 1';
			$where .= ' AND approved = "yes"';
			if (!$my->id) {
			$where .= ' AND public_private = "public"';
			}

			$join     = ' LEFT JOIN #__users ON #__users.id = #__hwdvidsvideos.user_id';
			if ($c->userdisplay == 1) {
				$select   = '#__users.username,';
				$select_f = '#__users.username,';
			} else {
				$select   = '#__users.name,';
				$select_f = '#__users.name,';
			}
			if ($c->cbint == "2") {
				$join.= ' LEFT JOIN #__community_users ON #__community_users.userid = #__hwdvidsvideos.user_id';
				$select  .= ' #__community_users.*,';
				$select_f.= ' #__community_users.*';
			} else if ($c->cbint == "1") {
				$join.= ' LEFT JOIN #__comprofiler ON #__comprofiler.user_id = #__hwdvidsvideos.user_id';
				$select  .= ' #__comprofiler.avatar,';
				$select_f.= ' #__comprofiler.avatar';
			} else if ($c->cbint == "0") {
				if ($c->userdisplay == 1) {
					$select_f = '#__users.username';
				} else {
					$select_f = '#__users.name';
				}
			}

			// query SQL for all data
			$db->SetQuery('SELECT #__hwdvidsvideos.*, '.$select_f.' FROM #__hwdvidsvideos '.$join.' WHERE #__hwdvidsvideos.approved = "yes" AND #__hwdvidsvideos.published = 1 ORDER BY #__hwdvidsvideos.number_of_views DESC LIMIT 0, 10');
			$rowsmostviewed_alltime = $db->loadObjectList();

			$db->SetQuery('SELECT #__hwdvidsvideos.*, '.$select.' COUNT(#__hwdvidsfavorites.videoid) AS counts FROM #__hwdvidsvideos LEFT JOIN #__hwdvidsfavorites ON #__hwdvidsvideos.id = #__hwdvidsfavorites.videoid '.$join.' WHERE #__hwdvidsfavorites.videoid IS NOT NULL AND #__hwdvidsvideos.approved = "yes" AND #__hwdvidsvideos.published = 1 GROUP BY #__hwdvidsvideos.id ORDER BY counts DESC LIMIT 0, 10');
			$rowsmostfavoured_alltime = $db->loadObjectList();

			$db->SetQuery('SELECT #__hwdvidsvideos.*, '.$select_f.' FROM #__hwdvidsvideos '.$join.' WHERE #__hwdvidsvideos.approved = "yes" AND #__hwdvidsvideos.published = 1 ORDER BY #__hwdvidsvideos.updated_rating DESC LIMIT 0, 10');			$rowsmostpopular_alltime = $db->loadObjectList();

			hwdvsDrawFile::XMLDataFile($rowsmostviewed_alltime, 'mostviewed_alltime');
			hwdvsDrawFile::XMLDataFile($rowsmostfavoured_alltime, 'mostfavoured_alltime');
			hwdvsDrawFile::XMLDataFile($rowsmostpopular_alltime, 'mostpopular_alltime');
			hwdvsDrawFile::XMLPlaylistFile($rowsmostviewed_alltime, 'mostviewed_alltime');
			hwdvsDrawFile::XMLPlaylistFile($rowsmostfavoured_alltime, 'mostfavoured_alltime');
			hwdvsDrawFile::XMLPlaylistFile($rowsmostpopular_alltime, 'mostpopular_alltime');
		}
		return;
	}
}
?>