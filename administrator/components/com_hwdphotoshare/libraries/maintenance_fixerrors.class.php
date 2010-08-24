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
class hwd_ps_fixerrors {
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
		$page = 'http://hwdpsfixerrorfile'; // Requested page
		$cachefile = $cachedir . md5($page) . '.' . $cacheext; // Cache file to either load or create

		$cachefile_created = (@file_exists($cachefile)) ? @filemtime($cachefile) : 0;
		@clearstatcache();

		if ($override == 2) {
			// Show file from cache if still valid
			if (time() - $cachetime < $cachefile_created) {
				$mainframe->enqueueMessage("Maintenance [Fix SQL Database Errors] has already been performed in the past 24 hours. It probably does not need to be run again.");
				return;
			}
		}

		 // Now the script has run, generate a new cache file
		$fp = @fopen($cachefile, 'w');

		// save the contents of output buffer to the file
		@fwrite($fp, ob_get_contents());
		@fclose($fp);

		hwd_ps_fixerrors::permenantlyDelete();
		hwd_ps_fixerrors::setupBlankAlbums();
		hwd_ps_fixerrors::syncPhotosToAlbums();
		hwd_ps_fixerrors::reorderAlbums();
		hwd_ps_fixerrors::checkCategoryIDs();

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
	function permenantlyDelete() {
		global $db;
  		$db =& JFactory::getDBO();

		$db->SetQuery("DELETE FROM #__hwdpsphotos WHERE approved = \"deleted\"");
		$db->Query();
		if ( !$db->query() ) {
			echo "<script> alert('".$db->getErrorMsg()."'); window.history.go(-1); </script>\n";
			exit();
		}

		$db->SetQuery("DELETE FROM #__hwdpsalbums WHERE approved = \"deleted\"");
		$db->Query();
		if ( !$db->query() ) {
			echo "<script> alert('".$db->getErrorMsg()."'); window.history.go(-1); </script>\n";
			exit();
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
	function setupBlankAlbums($album_id=null) {
  		$db =& JFactory::getDBO();
        $c = hwd_ps_Config::get_instance();

        if (isset($album_id)) {

        	// get all album
			$query = 'SELECT *'
					. ' FROM #__hwdpsalbums'
					. ' WHERE id = '.$album_id
					;
			$db->SetQuery($query);
			$rows = $db->loadObjectList();

        } else {

        	// get all album
			$query = 'SELECT *'
					. ' FROM #__hwdpsalbums'
					;
			$db->SetQuery($query);
			$rows = $db->loadObjectList();

		}

		for ($i=0, $n=count($rows); $i < $n; $i++) {
			$row = $rows[$i];

			if ($row->privacy == '') {
				if ($c->shareoption1 == 0) {
					$privacy = "public";
				} else {
					$privacy = "registered";
				}
			} else {
				$privacy = $row->privacy;
			}

			if ($row->allow_comments == '') {
				$allow_comments = $c->shareoption2;
			} else {
				$allow_comments = $row->allow_comments;
			}

			if ($row->allow_ratings == '') {
				$allow_ratings = $c->shareoption4;
			} else {
				$allow_ratings = $row->allow_ratings;
			}

			$db->SetQuery("UPDATE #__hwdpsalbums SET allow_comments = $allow_comments, allow_ratings = $allow_ratings, privacy = \"$privacy\" WHERE id = $row->id");
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
	function syncPhotosToAlbums($album_id=null) {
		global $db;
  		$db =& JFactory::getDBO();

        if (isset($album_id)) {

        	// get all album
			$query = 'SELECT *'
					. ' FROM #__hwdpsalbums'
					. ' WHERE id = '.$album_id
					;
			$db->SetQuery($query);
			$rows = $db->loadObjectList();

        } else {

        	// get all album
			$query = 'SELECT *'
					. ' FROM #__hwdpsalbums'
					;
			$db->SetQuery($query);
			$rows = $db->loadObjectList();

		}

		for ($i=0, $n=count($rows); $i < $n; $i++) {
			$row = $rows[$i];

			// count videos in category
			$query = 'SELECT *'
					. ' FROM #__hwdpsphotos'
					. ' WHERE album_id = '.$row->id
					;
			$db->SetQuery($query);
			$photos = $db->loadObjectList();

			for ($j=0, $m=count($photos); $j < $m; $j++) {
				$photo = $photos[$j];

				$db->SetQuery("UPDATE #__hwdpsphotos SET allow_comments = $row->allow_comments, allow_ratings = $row->allow_ratings, privacy = \"$row->privacy\" WHERE id = $photo->id");
				$db->Query();
				if ( !$db->query() ) {
					echo "<script> alert('".$db->getErrorMsg()."'); window.history.go(-1); </script>\n";
					exit();
				}
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
	function reorderAlbums($album_id=null) {
		global $db;
  		$db =& JFactory::getDBO();

        if (isset($album_id)) {

        	// get all album
			$query = 'SELECT *'
					. ' FROM #__hwdpsalbums'
					. ' WHERE id = '.$album_id
					;
			$db->SetQuery($query);
			$rows = $db->loadObjectList();

        } else {

        	// get all album
			$query = 'SELECT *'
					. ' FROM #__hwdpsalbums'
					;
			$db->SetQuery($query);
			$rows = $db->loadObjectList();

		}

		for ($i=0, $n=count($rows); $i < $n; $i++) {
			$row = $rows[$i];

        	// get all album
			$query = 'SELECT *'
					. ' FROM #__hwdpsphotos'
					. ' WHERE album_id = '.$row->id
					. ' ORDER BY ordering'

					;
			$db->SetQuery($query);
			$photos = $db->loadObjectList();

			for ($j=0, $m=count($photos); $j < $m; $j++) {
			  $photo = $photos[$j];

			  // update ordering
			  $db->SetQuery("UPDATE #__hwdpsphotos SET ordering = $j WHERE id = $photo->id");
			  $db->Query();
			  if ( !$db->query() ) {
				echo "<script> alert('".$db->getErrorMsg()."'); window.history.go(-1); </script>\n";
				exit();
			  }
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
	function checkCategoryIDs($album_id=null) {
		global $db;
  		$db =& JFactory::getDBO();

        if (isset($album_id)) {

        	// get all album
			$query = 'SELECT *'
					. ' FROM #__hwdpsalbums'
					. ' WHERE id = '.$album_id
					;
			$db->SetQuery($query);
			$rows = $db->loadObjectList();

        } else {

        	// get all album
			$query = 'SELECT *'
					. ' FROM #__hwdpsalbums'
					;
			$db->SetQuery($query);
			$rows = $db->loadObjectList();

		}

		for ($i=0, $n=count($rows); $i < $n; $i++) {
			$row = $rows[$i];

        	// get all album
			$query = 'SELECT *'
					. ' FROM #__hwdpsphotos'
					. ' WHERE album_id = '.$row->id
					;
			$db->SetQuery($query);
			$photos = $db->loadObjectList();

			for ($j=0, $m=count($photos); $j < $m; $j++) {
			  $photo = $photos[$j];

			  // update ordering
			  $db->SetQuery("UPDATE #__hwdpsphotos SET category_id = $row->category_id WHERE id = $photo->id");
			  $db->Query();
			  if ( !$db->query() ) {
				echo "<script> alert('".$db->getErrorMsg()."'); window.history.go(-1); </script>\n";
				exit();
			  }
			}

		}

		return true;
    }
}