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

class hwd_vs_core
{

    /**
     * Make frontpage SQL queries with appropriate filters
     *
     * @return       Nothing
     */
    function frontpage()
    {
        global $mainframe, $limitstart, $limit, $hwdvs_selectv, $hwdvs_joinv;
        $c = hwd_vs_Config::get_instance();
  		$db = & JFactory::getDBO();
		$my = & JFactory::getUser();

        // number of videos to display
        $limit     = intval($c->vpp);

        // sql search filters
        $where = ' WHERE video.published = 1';
        $where .= ' AND video.approved = "yes"';
        if (!$my->id) {
        $where .= ' AND video.public_private = "public"';
        }

        $userGID = hwd_vs_access::userGID( $my->id );
        $parentGID = implode(hwd_vs_access::getRecursiveGIDS($userGID), ",");
        if (!empty($parentGID)) { $parentGID = ",".$parentGID; }
        $parentGID = "-2,-1".$parentGID;
        $where .= ' AND (access.access_v IN ('.$parentGID.') OR video.category_id = 0)';

        $hwdvs_selectv.= ', access.access_v, access.access_v_r, access.access_lev_v';

        // get video count
        $db->SetQuery( 'SELECT count(*)'
					 . ' FROM #__hwdvidsvideos AS video'
					 . $hwdvs_joinv
					 . ' LEFT JOIN #__hwdvidscategories AS `access` ON access.id = video.category_id'
					 . $where
					 );
        $total = $db->loadResult();
        echo $db->getErrorMsg();

		$pageNav = new JPagination( $total, $limitstart, $limit );

        $query = 'SELECT'.$hwdvs_selectv
                . ' FROM #__hwdvidsvideos AS video'
                . $hwdvs_joinv
			    . ' LEFT JOIN #__hwdvidscategories AS `access` ON access.id = video.category_id'
                . $where
                . ' ORDER BY video.date_uploaded DESC'
                ;
        $db->SetQuery($query, $pageNav->limitstart, $pageNav->limit);
        $rows = $db->loadObjectList();

        if ($c->feat_rand == 0) {
        	$order = ' ORDER BY video.ordering ASC';
        } else {
        	$order = ' ORDER BY rand()';
        }

        if ($c->feat_show == 0) {
        	$limit = ' LIMIT 0, '.$c->fpfeaturedvids;
        } else {
        	$limit = ' LIMIT 0, '.($c->fpfeaturedvids+1);
        }

        // get featured videos
        $query = 'SELECT'.$hwdvs_selectv
                . ' FROM #__hwdvidsvideos AS video'
				. $hwdvs_joinv
			    . ' LEFT JOIN #__hwdvidscategories AS `access` ON access.id = video.category_id'
                . $where
                . ' AND video.featured = 1'
                . $order
                . $limit
                ;
        $db->SetQuery($query);
        $rowsfeatured = $db->loadObjectList();

		$rowsnow = array();
		if ($c->frontpage_watched == "1") {
			//Videos that are approved(converted) and published in this group
			$query = 'SELECT DISTINCT'.$hwdvs_selectv
					. ' FROM #__hwdvidsvideos AS video'
					. ' LEFT JOIN #__hwdvidslogs_views AS l ON l.videoid = video.id'
					. $hwdvs_joinv
					. ' LEFT JOIN #__hwdvidscategories AS `access` ON access.id = video.category_id'
					. $where
					. ' AND l.date > NOW() - INTERVAL 1440 MINUTE'
					. ' ORDER BY l.date DESC'
                	. ' LIMIT 0, 10'
					;
			$db->SetQuery($query);
			$rowsnow = $db->loadObjectList();
        }
		$mostviewed = array();
		if ($c->frontpage_viewed !== "0") {
			// parse xml playlists
			require_once(JPATH_SITE.DS.'components'.DS.'com_hwdvideoshare'.DS.'xml'.DS.'xmlparse.class.php');
			$parser = new HWDVS_xmlParse();
			$mostviewed = $parser->parse("mostviewed_".$c->frontpage_viewed);
		}
		$mostfavoured = array();
		if ($c->frontpage_favoured !== "0") {
			// parse xml playlists
			require_once(JPATH_SITE.DS.'components'.DS.'com_hwdvideoshare'.DS.'xml'.DS.'xmlparse.class.php');
			$parser = new HWDVS_xmlParse();
			$mostfavoured = $parser->parse("mostfavoured_".$c->frontpage_favoured);
		}

		$mostpopular = array();
		if ($c->frontpage_popular !== "0") {
			// parse xml playlists
			require_once(JPATH_SITE.DS.'components'.DS.'com_hwdvideoshare'.DS.'xml'.DS.'xmlparse.class.php');
			$parser = new HWDVS_xmlParse();
			$mostpopular = $parser->parse("mostpopular_".$c->frontpage_popular);
		}

        // send out
        hwd_vs_html::frontpage($rows, $rowsfeatured, $pageNav, $total, $rowsnow, $mostviewed, $mostfavoured, $mostpopular);
    }
    /**
     * Check video player access and cache settings and query SQL for video data
     *
     * @return       Nothing
     */
    function viewvideo()
    {
        global $hwdvs_joinv, $hwdvs_selectv;
		$c = hwd_vs_Config::get_instance();
		$db = & JFactory::getDBO();
		$my = & JFactory::getUser();
		$acl= & JFactory::getACL();
		$usersConfig = &JComponentHelper::getParams( 'com_users' );

		// check component access settings and deny those without privileges
		if ($c->access_method == 0) {
			if (!hwd_vs_access::allowAccess( $c->gtree_plyr, $c->gtree_plyr_child, hwd_vs_access::userGID( $my->id ))) {
				if ( ($my->id < 1) && (!$usersConfig->get( 'allowUserRegistration' ) == '0' && hwd_vs_access::allowAccess( $c->gtree_upld, 'RECURSE', $acl->get_group_id('Registered','ARO') ) ) ) {
					hwd_vs_tools::infomessage(1, 0, _HWDVIDS_TITLE_NOACCESS, _HWDVIDS_ALERT_REGISTERFORPLYR, "exclamation.png", 1);
					return;
				} else {
					hwd_vs_tools::infomessage(1, 0, _HWDVIDS_TITLE_NOACCESS, _HWDVIDS_ALERT_PLYR_NOT_AUTHORIZED, "exclamation.png", 1);
					return;
				}
			}
		} else if ($c->access_method == 1) {
			if (!hwd_vs_access::allowLevelAccess( $c->accesslevel_upld, hwd_vs_access::userGID( $my->id ))) {
				hwd_vs_tools::infomessage(1, 0,  _HWDVIDS_TITLE_NOACCESS, _HWDVIDS_ALERT_PLYR_NOT_AUTHORIZED, "exclamation.png", 0);
				return;
			}
		}

        // don't want to cache
        header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
        header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past

        // get video id from POST array
        $video_id = JRequest::getInt( 'video_id', 0 );

        // check video can be viewed by user
        $where = ' WHERE video.published = 1';
        $where .= ' AND video.id = '.$video_id;
        $where .= ' AND video.approved = "yes"';
        if (!$my->id) {
        $where .= ' AND video.public_private = "public"';
        }

        $hwdvs_selectv_extended = $hwdvs_selectv.', access.access_v, access.access_v_r, access.access_lev_v';

        $query = 'SELECT'.$hwdvs_selectv_extended
                . ' FROM #__hwdvidsvideos AS video'
                . $hwdvs_joinv
			    . ' LEFT JOIN #__hwdvidscategories AS `access` ON access.id = video.category_id'
                . $where
                . ' ORDER BY video.date_uploaded DESC'
                ;
        $db->SetQuery($query);
        $row = $db->loadObject();

        if ( count($row) < 1 ) {
        	hwd_vs_tools::infomessage(1, 0, _HWDVIDS_TITLE_NOACCESS, _HWDVIDS_ALERT_VIDNOEXIST, "exclamation.png", 0);
            return;
        }

        // get view count
        hwd_vs_tools::logViewing($video_id);
        require_once(JPATH_SITE.DS.'administrator'.DS.'components'.DS.'com_hwdvideoshare'.DS.'libraries'.DS.'maintenance_recount.class.php');
        hwd_vs_recount::recountVideoViews($video_id);

		// check component access settings and deny those without privileges
		if ($c->bviic == 1 && $row->category_id !== "0") {
			if ($c->access_method == 0) {
				if (!hwd_vs_access::allowAccess( $row->access_v, $row->access_v_r, hwd_vs_access::userGID( $my->id ))) {
					if ( ($my->id < 1) && (!$usersConfig->get( 'allowUserRegistration' ) == '0' && hwd_vs_access::allowAccess( $c->gtree_upld, 'RECURSE', $acl->get_group_id('Registered','ARO') ) ) ) {
						hwd_vs_tools::infomessage(2, 0, _HWDVIDS_TITLE_NOACCESS, _HWDVIDS_ALERT_REGISTERFORVCAT, "exclamation.png", 0);
						return;
					} else {
						hwd_vs_tools::infomessage(2, 0, _HWDVIDS_TITLE_NOACCESS, _HWDVIDS_ALERT_VCAT_NOT_AUTHORIZED, "exclamation.png", 0);
						return;
					}
				}
			} else if ($c->access_method == 1) {
				if (!hwd_vs_access::allowLevelAccess( $row->access_lev_v, hwd_vs_access::userGID( $my->id ))) {
					hwd_vs_tools::infomessage(2, 0,  _HWDVIDS_TITLE_NOACCESS, _HWDVIDS_ALERT_VCAT_NOT_AUTHORIZED, "exclamation.png", 0);
					return;
				}
			}
		}

		// get related videos
		if ($c->showuldr == "1") {
			$query = 'SELECT'.$hwdvs_selectv
                    . ' FROM #__hwdvidsvideos AS video'
                    . $hwdvs_joinv
					. ' WHERE video.user_id = '.$row->user_id
					. ' AND video.published = 1'
					. ' AND video.approved = "yes"'
					. ' AND video.id <> '.$row->id
					. ' ORDER BY video.date_uploaded DESC'
					. ' LIMIT 0, '.$c->mbtu_no
					;
			$db->SetQuery($query);
			$userrows = $db->loadObjectList();
		} else {
			$userrows = null;
		}

		// get related videos
		if ($c->showrevi == "1") {
			$searchterm = addslashes($row->title." ".$row->description." ".$row->tags);
			if (!$my->id) {
			$wherevids = ' WHERE video.public_private = \'public\' AND MATCH (title,tags,description) AGAINST (\''.$searchterm.'\')';
			} else {
			$wherevids = ' WHERE MATCH (title,tags,description) AGAINST (\''.$searchterm.'\')';
			}
			// get matching video data
			$query = 'SELECT'.$hwdvs_selectv
                    . ' FROM #__hwdvidsvideos AS video'
                    . $hwdvs_joinv
					. $wherevids
					. ' AND video.published = 1'
					. ' AND video.approved = "yes"'
					. ' AND video.id <> '.$row->id
					//. ' ORDER BY video.date_uploaded DESC'
					. ' LIMIT 0, '.$c->revi_no
					;
			$db->SetQuery($query);
			$relatedrows = $db->loadObjectList();
		} else {
			$relatedrows = null;
		}

		// get more from category
		if ($c->showmftc == "1") {
			$query = 'SELECT'.$hwdvs_selectv
                    . ' FROM #__hwdvidsvideos AS video'
                    . $hwdvs_joinv
					. ' WHERE video.category_id = '.$row->category_id
					. ' AND video.published = 1'
					. ' AND video.approved = "yes"'
					. ' AND video.id <> '.$row->id
					. ' ORDER BY video.date_uploaded DESC'
					. ' LIMIT 0, '.$c->mftc_no
					;
			$db->SetQuery($query);
			$categoryrows = $db->loadObjectList();
		} else {
			$categoryrows = null;
		}

        // send out
        hwd_vs_html::viewVideo($row, $userrows, $relatedrows, $categoryrows);
    }
    /**
     * Query SQL for all accessible category data
     *
     * @return       Nothing
     */
    function categories()
    {
        global $mainframe, $limitstart, $option;
		$c = hwd_vs_Config::get_instance();
		$db = & JFactory::getDBO();
		$my = & JFactory::getUser();

		$order = JRequest::getCmd( 'hwdcorder' );
		$mainframe->setUserState( $option.'cateorder', "$order" );

		$filter_order = $mainframe->getUserStateFromRequest( $option.'cateorder', 'cateorder', '', 'cmd' );

		if (!empty($filter_order)) {
			$c->cordering = $filter_order;
		}

		if ( $c->cordering == "orderASC" ) {
			$order = ' ORDER BY ordering ASC, category_name';
		} else if ( $c->cordering == "orderDESC" ) {
			$order = ' ORDER BY ordering DESC, category_name';
		} else if ( $c->cordering == "nameASC" ) {
			$order = ' ORDER BY category_name ASC';
		} else if ( $c->cordering == "nameDESC" ) {
			$order = ' ORDER BY category_name DESC';
		} else if ( $c->cordering == "novidsASC" ) {
			$order = ' ORDER BY num_vids ASC';
		} else if ( $c->cordering == "novidsDESC" ) {
			$order = ' ORDER BY num_vids DESC';
		} else if ( $c->cordering == "nosubsASC" ) {
			$order = ' ORDER BY num_subcats ASC';
		} else if ( $c->cordering == "nosubsDESC" ) {
			$order = ' ORDER BY num_subcats DESC';
		} else {
			$order = ' ORDER BY ordering, category_name';
		}

		$where = ' WHERE published = 1';
		$where.= ' AND parent = 0';
		if ($c->cat_he == 1) {
			$where.= ' AND num_vids > 0';
		}

		// get category list
        $query = 'SELECT *'
                . ' FROM #__hwdvidscategories'
                . $where
    			. $order
    			;
        $db->setQuery( $query );
        $rows = $db->loadObjectList();

 		// send out
        hwd_vs_html::categories($rows);
    }
    /**
     * Query SQL for requested category data
     *
     * @return       Nothing
     */
    function viewcategory()
    {
        global $mainframe, $limitstart, $hwdvs_joinv, $hwdvs_selectv;
		$c = hwd_vs_Config::get_instance();
		$db = & JFactory::getDBO();
		$my = & JFactory::getUser();
		$acl= & JFactory::getACL();
		$usersConfig = &JComponentHelper::getParams( 'com_users' );

        // number of videos to display
        $limit     = intval($c->vpp);

        // get POST array values
        $cat_id = JRequest::getInt( 'cat_id', 0 );

        // filter for sql data
        $where = ' WHERE video.published = 1';
        $where .= ' AND video.approved = "yes"';
        $where .= ' AND video.category_id = '.$cat_id;
        if (!$my->id) {
        $where .= ' AND video.public_private = "public"';
        }

		if ( $c->cvordering == "orderASC" ) {
			$order = ' ORDER BY video.ordering ASC';
		} else if ( $c->cvordering == "orderDESC" ) {
			$order = ' ORDER BY video.ordering DESC';
		} else if ( $c->cvordering == "dateASC" ) {
			$order = ' ORDER BY video.date_uploaded ASC';
		} else if ( $c->cvordering == "dateDESC" ) {
			$order = ' ORDER BY video.date_uploaded DESC';
		} else if ( $c->cvordering == "nameASC" ) {
			$order = ' ORDER BY video.title ASC';
		} else if ( $c->cvordering == "nameDESC" ) {
			$order = ' ORDER BY video.title DESC';
		} else if ( $c->cvordering == "hitsASC" ) {
			$order = ' ORDER BY video.number_of_views ASC';
		} else if ( $c->cvordering == "hitsDESC" ) {
			$order = ' ORDER BY video.number_of_views DESC';
		} else if ( $c->cvordering == "voteASC" ) {
			$order = ' ORDER BY video.updated_rating ASC';
		} else if ( $c->cvordering == "voteDESC" ) {
			$order = ' ORDER BY video.updated_rating DESC';
		} else {
			$order = ' ORDER BY video.date_uploaded DESC';
		}

        // count filtered videos
        $db->SetQuery( 'SELECT count(*)'
                     . ' FROM #__hwdvidsvideos AS video'
                     . $where
                     );
        $total = $db->loadResult();
        echo $db->getErrorMsg();

        // pagination
		$pageNav = new JPagination( $total, $limitstart, $limit );

        // get filtered video data
        $query = 'SELECT'.$hwdvs_selectv
                . ' FROM #__hwdvidsvideos AS video'
				. $hwdvs_joinv
                . $where
                . $order
                ;
        $db->SetQuery($query, $pageNav->limitstart, $pageNav->limit);
        $rows = $db->loadObjectList();

        // get category name
        $query_cat = 'SELECT *'
                   . ' FROM #__hwdvidscategories'
                   . ' WHERE id = '.$cat_id
                   ;
        $db->SetQuery( $query_cat );
        $cat = $db->loadObject();

		// check component access settings and deny those without privileges
		if ($c->access_method == 0) {
			if (!hwd_vs_access::allowAccess( $cat->access_v, $cat->access_v_r, hwd_vs_access::userGID( $my->id ))) {
				if ( ($my->id < 1) && (!$usersConfig->get( 'allowUserRegistration' ) == '0' && hwd_vs_access::allowAccess( $c->gtree_upld, 'RECURSE', $acl->get_group_id('Registered','ARO') ) ) ) {
					hwd_vs_tools::infomessage(2, 0, _HWDVIDS_TITLE_NOACCESS, _HWDVIDS_ALERT_REGISTERFORCAT, "exclamation.png", 0);
					return;
				} else {
					hwd_vs_tools::infomessage(2, 0, _HWDVIDS_TITLE_NOACCESS, _HWDVIDS_ALERT_CAT_NOT_AUTHORIZED, "exclamation.png", 0);
					return;
				}
			}
		} else if ($c->access_method == 1) {
			if (!hwd_vs_access::allowLevelAccess( $cat->access_lev_v, hwd_vs_access::userGID( $my->id ))) {
				hwd_vs_tools::infomessage(2, 0,  _HWDVIDS_TITLE_NOACCESS, _HWDVIDS_ALERT_NOT_AUTHORIZED, "exclamation.png", 0);
				return;
			}
		}

		if (count($cat) == 0) {
			hwd_vs_tools::infomessage(1, 0,  _HWDVIDS_TITLE_NOACCESS, _HWDVIDS_TCDNE, "exclamation.png", 0);
			return;
		}

		// get subcategories
		$query = 'SELECT *'
				. ' FROM #__hwdvidscategories'
				. ' WHERE published = 1'
				. ' AND parent = '.$cat_id
				. ' ORDER BY ordering, category_name'
				;
		$db->setQuery( $query );
		$subcats = $db->loadObjectList();

        // sent out
        hwd_vs_html::viewCategory($rows, $pageNav, $total, $cat_id, $cat, $subcats);
    }
    /**
     * Query SQL for user inputted search pattern
     *
     * @return       Nothing
     */
    function search()
    {
        global $mainframe, $Itemid;

        // get POST array values
        $pattern = JRequest::getVar( 'pattern', '' );
		$pattern_safe = str_replace("'", "", $pattern);
		$pattern_safe = str_replace('"', "", $pattern_safe);
		$pattern_safe = addslashes($pattern_safe);
        $category_id = JRequest::getInt( 'category_id', '0' );
		$url = JRoute::_('index.php?option=com_hwdvideoshare&task=displayresults&pattern='.$pattern_safe.'&category_id='.$category_id.'&Itemid='.$Itemid);
		$mainframe->redirect(html_entity_decode($url));
    }
    /**
     * Query SQL for user inputted search pattern
     *
     * @return       Nothing
     */
    function displayResults()
    {
        global $mainframe, $limitstart, $hwdvs_joinv, $hwdvs_joing, $hwdvs_selectv, $hwdvs_selectg;
		$c = hwd_vs_Config::get_instance();
		$db = & JFactory::getDBO();
		$my = & JFactory::getUser();

		// number of videos and groups to display
        $limitv     = intval($c->vpp);
        $limitg     = intval($c->gpp);

        // get POST array values
        $pattern = JRequest::getVar( 'pattern', '' );
		$pattern_safe = str_replace("'", "", $pattern);
		$pattern_safe = str_replace('"', "", $pattern_safe);
		$pattern_safe = addslashes($pattern_safe);
        $category = JRequest::getInt( 'category_id', '0' );

        // setup search filter for videos and groups
        if (!$my->id) {
        $wherevids = ' WHERE video.public_private = \'public\' AND MATCH (title,tags,description) AGAINST (\''.$pattern_safe.'\')';
        $wheregroups = ' WHERE g.public_private = \'public\' AND MATCH (group_name,group_description) AGAINST (\''.$pattern_safe.'\')';
        } else {
        $wherevids = ' WHERE MATCH (title,tags,description) AGAINST (\''.$pattern_safe.'\')';
        $wheregroups = ' WHERE MATCH (group_name,group_description) AGAINST (\''.$pattern_safe.'\')';
        }

        if ($category > 0) {
        	$wherevids.= ' AND video.category_id = '.$category;
        }

        $wherevids.= ' AND video.published = 1 AND video.approved = "yes"';

        // count matching videos
        $db->SetQuery( 'SELECT count(*)'
                     . ' FROM #__hwdvidsvideos AS video'
                     . $wherevids
                     );
        $totalvids = $db->loadResult();
        echo $db->getErrorMsg();

        // pagination
		$videoNav = new JPagination( $totalvids, $limitstart, $limitv );

        // get matching video data
        $query = 'SELECT'.$hwdvs_selectv
                . ' FROM #__hwdvidsvideos AS video'
				. $hwdvs_joinv
                . $wherevids
                ;
        $db->SetQuery($query, $videoNav->limitstart, $videoNav->limit);
        $matchingvids = $db->loadObjectList();

        if ($c->diable_nav_groups == 0) {

			// count matching groups
			$db->SetQuery( 'SELECT count(*)'
						 . ' FROM #__hwdvidsgroups AS g'
						 . $hwdvs_joing
					     . $wheregroups
						 );
			$totalgroups = $db->loadResult();
			echo $db->getErrorMsg();

			// pagination
			$groupNav = new JPagination( $totalgroups, $limitstart, $limitg );

			// get matching group data
			$query = 'SELECT'.$hwdvs_selectg
				   . ' FROM #__hwdvidsgroups AS g'
				   . $hwdvs_joing
				   . $wheregroups
				   ;
			$db->SetQuery($query, $groupNav->limitstart, $groupNav->limit);
			$matchinggroups = $db->loadObjectList();

		} else {

			$totalgroups = 0;
			$groupNav = null;
			$matchinggroups = null;

		}

        // sent out
        hwd_vs_html::search($totalvids, $matchingvids, $videoNav, $totalgroups, $matchinggroups, $groupNav, $pattern);
    }
    /**
     * Query SQL for all accessible category data
     *
     * @return       Nothing
     */
    function downloadFile()
    {
        global $mainframe, $limitstart;
		$c = hwd_vs_Config::get_instance();
		$db = & JFactory::getDBO();
		$my = & JFactory::getUser();
		$acl= & JFactory::getACL();
		$usersConfig = &JComponentHelper::getParams( 'com_users' );

		//$currentSession = JSession::getInstance('none',array());
		//$currentSession->destroy();

		$evp = JRequest::getCmd( 'evp', 0 );
		$file = JRequest::getCmd( 'file', 0 );
		$deliver = JRequest::getCmd( 'deliver', 0 );
		$media = JRequest::getCmd( 'media', 0 );
		$fix = JRequest::getCmd( 'fix', 0 );

		// get video details
		$db->SetQuery('SELECT *'
					. ' FROM #__hwdvidsvideos'
					. ' WHERE id = '.(int)$file);
		$db->Query();
		$row = $db->loadObject();


        $db->SetQuery( 'SELECT count(*)'
                       . ' FROM #__hwdvidsantileech'
                       . ' WHERE expiration = "'.$evp.'"'
                            );
        $result = $db->loadResult();

		if ($row->allow_embedding == 1 || $result > 0)
		{

			$BASEPATH = JPATH_SITE.DS.'hwdvideos';

			if ($row->video_type == "local" || $row->video_type == "mp4") {

				if ($c->usehq == "1" && file_exists("$BASEPATH/uploads/".$row->video_id.".mp4") && filesize("$BASEPATH/uploads/".$row->video_id.".mp4") > 0) {
					$path = "$BASEPATH/uploads/".$row->video_id.".mp4";
					$url = JURI::root()."hwdvideos/uploads/".$row->video_id.".mp4";
				} else {
					$path = "$BASEPATH/uploads/".$row->video_id.".flv";
					$url = JURI::root()."hwdvideos/uploads/".$row->video_id.".flv";
				}

			} else if ($row->video_type == "remote") {

				$data = explode(",", $row->video_id);
				$url = hwd_vs_tools::get_final_url( $data[0] );

			} else if ($row->video_type == "swf") {

				$path = "$BASEPATH/uploads/".$file.".swf";
				$url = JURI::root()."hwdvideos/uploads/".$row->video_id.".flv";

			} else if ($row->video_type == "seyret") {

				$data = explode(",", $row->video_id);

				if ($data[0] == "local") {

					$url = $data[1];

				} else if ($row->video_type == "remote") {

					$data = explode(",", $row->video_id);
					$url = hwd_vs_tools::get_final_url( $data[1] );

				} else {

					$plugin = hwd_vs_tools::getPluginDetails($data[0]);
					if (!$plugin) {
						$url = '';
					} else {
						$prepareurl = preg_replace("/[^a-zA-Z0-9s_-]/", "", $data[0])."PrepareFlvURL";
						$video_data = $data[1].",".$data[2];
						$url = $prepareurl($video_data);
						$url = urldecode($url);
					}

				}

			} else {
				$plugin = hwd_vs_tools::getPluginDetails($row->video_type);
				if (!$plugin) {
					$url = '';
				} else {
					$prepareurl = preg_replace("/[^a-zA-Z0-9s_-]/", "", $row->video_type)."PrepareFlvURL";
					$url = $prepareurl($row->video_id);
					$url = urldecode($url);
				}
			}

			if ($row->allow_embedding == 1 && $deliver == "player" && $result >= 5) {

				header('Location: '.$url);
				exit;

			} else if ($result < 5) {

				$newcount = $result+1;

				$db->SetQuery( "UPDATE #__hwdvidsantileech SET `count` = $newcount WHERE expiration = \"".$evp."\"" );
				$db->Query();

				if ($deliver == "player") {

					header('Location: '.$url);
					exit;

				} else if ($deliver == "downloadoriginal") {

					if ($handle = opendir($BASEPATH.'/uploads/originals')) {

						$original_url = '';

						while (false !== ($file = readdir($handle))) {
							list($filename_noext, $filename_ext) = @split('\.', basename($file));

							if ($filename_noext == $row->video_id) {
								$original_url = JURI::root().'hwdvideos/uploads/originals/'.$file;
							}
						}

						closedir($handle);

						if (!empty($original_url)) {
							$mainframe->redirect( $original_url );
						} else {
							$hwdvsItemid = hwd_vs_tools::generateValidItemid();
							$msg = "The original video no longer exists on this server.";
							$mainframe->enqueueMessage($msg);
							$mainframe->redirect( JURI::root()."index.php?option=com_hwdvideoshare&Itemid=".$hwdvsItemid."&task=viewvideo&video_id=".$row->id );
						}

					}

				} else {

					// check component access settings and deny those without privileges
					if ($c->access_method == 0) {
						if (!hwd_vs_access::allowAccess( $c->gtree_dnld, $c->gtree_dnld_child, hwd_vs_access::userGID( $my->id ))) {
							if ( ($my->id < 1) && (!$usersConfig->get( 'allowUserRegistration' ) == '0' && hwd_vs_access::allowAccess( $c->gtree_upld, 'RECURSE', $acl->get_group_id('Registered','ARO') ) ) ) {
								hwd_vs_tools::infomessage(1, 0, _HWDVIDS_TITLE_NOACCESS, _HWDVIDS_ALERT_REGISTERFORDNLD, "exclamation.png", 1);
								return;
							} else {
								hwd_vs_tools::infomessage(1, 0, _HWDVIDS_TITLE_NOACCESS, _HWDVIDS_ALERT_DNLD_NOT_AUTHORIZED, "exclamation.png", 1);
								return;
							}
						}
					} else if ($c->access_method == 1) {
						if (!hwd_vs_access::allowLevelAccess( $c->accesslevel_dnld, hwd_vs_access::userGID( $my->id ))) {
							hwd_vs_tools::infomessage(1, 0,  _HWDVIDS_TITLE_NOACCESS, _HWDVIDS_ALERT_DNLD_NOT_AUTHORIZED, "exclamation.png", 0);
							return;
						}
					}

					if (headers_sent($filename, $linenum) || $row->video_type == "seyret" || $row->video_type == "remote") {
						$mainframe->redirect( $url );
					} else {
						// Transfer file in chunks to preserve memory on the server
						$fn = basename($path);

						$title = str_replace(" ", "-", $row->title);
						$title = preg_replace("/[^a-zA-Z0-9s-]/", "", $title);

						if (!empty($title)) {
							$ftitle = $title.".flv";
						} else {
							$ftitle = $fn;
						}

						header('Content-Type: application/octet-stream');
						header("Content-Disposition: attachment; filename=\"$ftitle\"");
						header('Content-Length: '.filesize($path));
						@hwd_vs_tools::readfile_chunked($path, true);
						exit;

					}

				}

			} else {

				$db->SetQuery("DELETE FROM #__hwdvidsantileech WHERE expiration = \"$evp\"");
				$db->Query();
				$hwdvsItemid = hwd_vs_tools::generateValidItemid();
				$msg = "You do not have access to this file using the requested method.";
				$mainframe->enqueueMessage($msg);
				$mainframe->redirect( JURI::root()."index.php?option=com_hwdvideoshare&Itemid=".$hwdvsItemid."&task=viewvideo&video_id=".$row->id );

			}
		}
		else
		{
			$hwdvsItemid = hwd_vs_tools::generateValidItemid();
			$msg = "You do not have access to this file using the requested method.";
			$mainframe->enqueueMessage($msg);
			$mainframe->redirect( JURI::root()."index.php?option=com_hwdvideoshare&Itemid=".$hwdvsItemid."&task=viewvideo&video_id=".$row->id );
		}
    }
    /**
     * Query SQL for all accessible category data
     *
     * @return       Nothing
     */
    function deliverThumb()
    {
        global $mainframe, $limitstart;
		$c = hwd_vs_Config::get_instance();
		$db = & JFactory::getDBO();
		$my = & JFactory::getUser();
		$acl= & JFactory::getACL();
		$usersConfig = &JComponentHelper::getParams( 'com_users' );

		//$currentSession = JSession::getInstance('none',array());
		//$currentSession->destroy();

		$id = JRequest::getCmd( 'id', 0 );
		$db->SetQuery('SELECT * FROM #__hwdvidsvideos WHERE id = '.(int)$id);
		$db->Query();
		$row = $db->loadObject();

		$BASEPATH = JPATH_SITE.DS.'hwdvideos'.DS.'thumbs';
		$BASEURL = JURI::root().'hwdvideos'.DS.'thumbs';

		$path = $BASEPATH.DS.$row->video_id.'.jpg';
		$url = $BASEURL.DS.$row->video_id.'.jpg';
		$watermark = $row->video_length;

		if (headers_sent($filename, $linenum)) {
			//problem
		}

		if ($c->thumb_ts == 0 || !function_exists('imagettftext') || empty($row->video_length) || $row->video_length == "0:00:00" || $row->video_length == "0:00:02") {

			$image=imagecreatefromjpeg($path);
			header('Content-Type: image/jpeg');
			imagejpeg($image);
			exit;

		} else {

			list($width, $height) = getimagesize($path);
			$image_p = imagecreatetruecolor($width, $height);
			$image = imagecreatefromjpeg($path);
			imagecopyresampled($image_p, $image, 0, 0, 0, 0, $width, $height, $width, $height);
			imagedestroy($image);

			$x_1 = $width - 55;
			$x_s = $x_1+3;
			$y_1 = 0;
			$x_2 = $width;
			$y_2 = 15;

			$bk = ImageColorResolveAlpha($image_p, 68, 68, 68, 50);
			$fg = imagecolorallocate($image_p, 255, 255, 255);
			imagefilledrectangle($image_p, $x_1, $y_1, $x_2, $y_2, $bk); // draw transparent box

			$font = JPATH_SITE.DS.'components'.DS.'com_hwdvideoshare'.DS.'assets'.DS.'captcha'.DS.'monofont.ttf';
			$font_size = 13;
			imagettftext($image_p, $font_size, 0, $x_s, 13, $fg, $font, $watermark);

			header('Content-type: image/jpeg');
			imagejpeg ($image_p);
			imagedestroy($image_p);
			exit;

		}

    }

}
