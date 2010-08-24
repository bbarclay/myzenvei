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
 * @package    hwdphotoshare
 * @author     Dave Horsfall <info@highwooddesign.co.uk>
 * @copyright  2008 Highwood Design
 * @license    http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @version    2.1.1 Build 21107 Alpha [Swami ]
 */
class hwd_ps_recount {
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
	function initiate($override) {

		global $mainframe;

		// set cache variables
		$cachedir = JPATH_SITE.DS.'administrator'.DS.'cache'.DS; // Directory to cache files in (keep outside web root)
		$cachetime = 86400; // Seconds to cache files for
		$cacheext = 'cache'; // Extension to give cached files (usually cache, htm, txt)
		$page = 'http://hwdpsrecountfile'; // Requested page
		$cachefile = $cachedir . md5($page) . '.' . $cacheext; // Cache file to either load or create

		$cachefile_created = (@file_exists($cachefile)) ? @filemtime($cachefile) : 0;
		@clearstatcache();

		if ($override == 2) {
			// Show file from cache if still valid
			if (time() - $cachetime < $cachefile_created) {
				$mainframe->enqueueMessage("Maintenance [Recount SQL Database Statistics] has already been performed in the past 24 hours. It probably does not need to be run again.");
				return;
			}
		}

		// Now the script has run, generate a new cache file
		$fp = @fopen($cachefile, 'w');

		// save the contents of output buffer to the file
		@fwrite($fp, ob_get_contents());
		@fclose($fp);

		hwd_ps_recount::recountPhotosInAlbum();
		hwd_ps_recount::recountSubcatsInCategory();
		hwd_ps_recount::recountAlbumsInCategory();
		hwd_ps_recount::recountMembersInGroup();


		return true;
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
	function recountPhotosInAlbum($album_id=null) {
		global $db;
  		$db =& JFactory::getDBO();

        if (isset($album_id)) {
			$rows[0]->id = $album_id;
        } else {
        	// get all categories
			$query = 'SELECT id'
					. ' FROM #__hwdpsalbums'
					;
			$db->SetQuery($query);
			$rows = $db->loadObjectList();
		}

		for ($i=0, $n=count($rows); $i < $n; $i++) {
			$row = $rows[$i];

			// count videos in category
			$query = 'SELECT count(*)'
					. ' FROM #__hwdpsphotos'
					. ' WHERE album_id = '.$row->id
					. ' AND approved = "yes"'
					;
			$db->SetQuery($query);
			$total = $db->loadResult();

			// update category
			$db->SetQuery("UPDATE #__hwdpsalbums SET number_of_photos = $total WHERE id = $row->id");
			$db->Query();
			if ( !$db->query() ) {
				echo "<script> alert('".$db->getErrorMsg()."'); window.history.go(-1); </script>\n";
				exit();
			}
		}

		return true;
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
	function recountSubcatsInCategory($catid=null) {
		global $mainframe;
		$db = & JFactory::getDBO();

        if (isset($catid)) {
			$rows[0]->id = $catid;
        } else {
			// get all categories
			$query = 'SELECT id'
					. ' FROM #__hwdpscategories'
					;
			$db->SetQuery($query);
			$rows = $db->loadObjectList();
		}

		for ($i=0, $n=count($rows); $i < $n; $i++) {
			$row = $rows[$i];

			// count subcats in category
			$query = 'SELECT count(*)'
					. ' FROM #__hwdpscategories'
					. ' WHERE parent = '.$row->id
					;
			$db->SetQuery($query);
			$total = $db->loadResult();

			// update category
			$db->SetQuery("UPDATE #__hwdpscategories SET num_subcats = $total WHERE id = $row->id");
			$db->Query();
			if ( !$db->query() ) {
				echo "<script> alert('".$db->getErrorMsg()."'); window.history.go(-1); </script>\n";
				exit();
			}
		}
		return true;
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
	function recountAlbumsInCategory($category_id=null) {
		global $db;
  		$db =& JFactory::getDBO();

        if (isset($category_id)) {
			$rows[0]->id = $category_id;
        } else {
			// get all categories
			$query = 'SELECT id'
					. ' FROM #__hwdpsalbums'
					;
			$db->SetQuery($query);
			$rows = $db->loadObjectList();
		}

		for ($i=0, $n=count($rows); $i < $n; $i++) {
			$row = $rows[$i];

			// count subcats in category
			$query = 'SELECT count(*)'
					. ' FROM #__hwdpsalbums'
					. ' WHERE category_id = '.$row->id
					. ' AND published = 1'
					. ' AND approved = "yes"'
					;
			$db->SetQuery($query);
			$total = $db->loadResult();

			// update category
			$db->SetQuery("UPDATE #__hwdpscategories SET num_albums = $total WHERE id = $row->id");
			$db->Query();
			if ( !$db->query() ) {
				echo "<script> alert('".$db->getErrorMsg()."'); window.history.go(-1); </script>\n";
				exit();
			}
		}
		return true;
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
	function recountMembersInGroup($groupid=null) {
  		$db =& JFactory::getDBO();

        if (isset($groupid)) {
			$rows[0]->id = $groupid;
        } else {
			// get all groups
			$query = 'SELECT id'
					. ' FROM #__hwdpsgroups'
					;
			$db->SetQuery($query);
			$rows = $db->loadObjectList();
		}

		for ($i=0, $n=count($rows); $i < $n; $i++) {
			$row = $rows[$i];

			//count group members
			$db->SetQuery( 'SELECT count(*)'
							. ' FROM #__hwdpsgroup_membership'
							. ' WHERE groupid = '.$row->id
							);
			$total = $db->loadResult();

			// update category
			$db->SetQuery("UPDATE #__hwdpsgroups SET total_members = $total WHERE id = $row->id");
			$db->Query();
			if ( !$db->query() ) {
				echo "<script> alert('".$db->getErrorMsg()."'); window.history.go(-1); </script>\n";
				exit();
			}
		}
		return true;
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
	function recountVideosInGroup($groupid=null) {
		global $db;

        if (isset($groupid)) {
			$rows[0]->id = $groupid;
        } else {
			// get all groups
			$query = 'SELECT id'
					. ' FROM #__hwdpsgroups'
					;
			$db->SetQuery($query);
			$rows = $db->loadObjectList();
		}

		for ($i=0, $n=count($rows); $i < $n; $i++) {
			$row = $rows[$i];

			//count group members
			$db->SetQuery( 'SELECT count(*)'
							. ' FROM #__hwdpsgroup_photos'
							. ' WHERE groupid = '.$row->id
							);
			$total = $db->loadResult();

			// update category
			$db->SetQuery("UPDATE #__hwdpsgroups SET total_videos = $total WHERE id = $row->id");
			$db->Query();
			if ( !$db->query() ) {
				echo "<script> alert('".$db->getErrorMsg()."'); window.history.go(-1); </script>\n";
				exit();
			}
		}
		return true;
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
	function recountVideoViews($videoid=null) {
		global $db;

        if (isset($videoid)) {
			$rows[0]->id = $videoid;
        } else {
			// get all groups
			$query = 'SELECT id'
					. ' FROM #__hwdpsphotos'
					;
			$db->SetQuery($query);
			$rows = $db->loadObjectList();
		}

		for ($i=0, $n=count($rows); $i < $n; $i++) {
			$row = $rows[$i];

			//count views in previous 30 days
			$db->SetQuery( 'SELECT count(*)'
							. ' FROM #__hwdpslogs_views'
							. ' WHERE videoid = '.$row->id
							);
			$total1 = $db->loadResult();
			//count views in archive
			$db->SetQuery( 'SELECT views'
							. ' FROM #__hwdpslogs_archive'
							. ' WHERE videoid = '.$row->id
							);
			$total2 = $db->loadResult();
			//count total views
			$total = $total1 + $total2;
			// update category
			$db->SetQuery("UPDATE #__hwdpsphotos SET number_of_views = $total WHERE id = $row->id");
			$db->Query();
			if ( !$db->query() ) {
				echo "<script> alert('".$db->getErrorMsg()."'); window.history.go(-1); </script>\n";
				exit();
			}
		}
		return true;
    }
}