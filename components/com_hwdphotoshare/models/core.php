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

class hwd_ps_core
{
    /**
     * Make frontpage SQL queries with appropriate filters
     *
     * @param string $option  the joomla component name
     * @return       Nothing
     */
    function frontpage()
    {
        global $hwdps_selecta, $hwdps_joina, $hwdps_selectp, $hwdps_joinp;
        $c = hwd_ps_Config::get_instance();
  		$db =& JFactory::getDBO();
		$my = & JFactory::getUser();

        // get featured photos
        $wherep = ' WHERE photo.published = 1';
        $wherep.= ' AND photo.approved = "yes"';
        if (!$my->id) {
        $wherep.= ' AND photo.privacy = "public"';
        }

        $query = 'SELECT'.$hwdps_selectp
                . ' FROM #__hwdpsphotos AS photo'
                . $hwdps_joinp
                . $wherep
                . ' ORDER BY photo.featured DESC, photo.date_uploaded DESC'
                . ' LIMIT 0, '.$c->fp_nos
                ;
        $db->SetQuery($query);
        $featured_photos = $db->loadObjectList();

		// get recent albums
        $wherea = ' WHERE album.published = 1';
        $wherea.= ' AND album.approved = "yes"';
        if (!$my->id) {
        $wherea.= ' AND album.privacy = "public"';
        }

		$query = 'SELECT'.$hwdps_selecta
				. ' FROM #__hwdpsalbums AS album'
				. $hwdps_joina
				. $wherea
                . ' AND album.number_of_photos >= 1'
				. ' ORDER BY album.date_created DESC'
                . ' LIMIT 0, '.$c->fp_noa
				;

		$db->SetQuery($query);
		$recent_albums = $db->loadObjectList();

		// get recent tags
		$query = 'SELECT tags, privacy'
				. ' FROM #__hwdpsphotos'
				. ' WHERE published = 1'
				. ' ORDER BY date_uploaded DESC'
                . ' LIMIT 0, 100'
				;

		$db->SetQuery($query);
		$recent_tags = $db->loadObjectList();

        // get recent photos
        $query = 'SELECT'.$hwdps_selectp
                . ' FROM #__hwdpsphotos AS photo'
                . $hwdps_joinp
                . $wherep
                . ' ORDER BY photo.date_uploaded DESC'
                . ' LIMIT 0, 100'
                ;
        $db->SetQuery($query);
        $recent_photos = $db->loadObjectList();

        // send out
        hwd_ps_html::frontpage($featured_photos, $recent_albums, $recent_tags, $recent_photos);
    }
    /**
     * Query SQL for all accessible category data
     *
     * @param string $option  the joomla component name
     * @return       Nothing
     */
    function categories()
    {
        global $database, $mainframe, $limitstart, $my, $acl, $Itemid, $mosConfig_live_site;
        $c = hwd_ps_Config::get_instance();
		$my = & JFactory::getUser();
  		$db =& JFactory::getDBO();

        // get category list
        $query = 'SELECT *'
                . ' FROM #__hwdpscategories'
                . ' WHERE published = 1'
                . ' AND parent = 0'
    			. ' ORDER BY ordering, category_name'
    			;
        $db->setQuery( $query );
        $rows = $db->loadObjectList();

 		// send out
        hwd_ps_html::categories($rows);
    }
    /**
     * Query SQL for requested category data
     *
     * @param string $option  the joomla component name
     * @return       Nothing
     */
    function viewcategory()
    {
        global $mainframe, $limitstart, $hwdps_selecta, $hwdps_joina;
        $c = hwd_ps_Config::get_instance();
  		$db =& JFactory::getDBO();
		$my = & JFactory::getUser();

        // number of videos to display
        $limit     = intval($c->app);

        // get POST array values
        $cat_id = JRequest::getInt( 'cat_id', 0 );

        // filter for sql data
        $where = ' WHERE album.published = 1';
        $where .= ' AND album.category_id = '.$cat_id;
        if (!$my->id) {
        $where .= ' AND album.privacy = "public"';
        }

        // count filtered videos
        $db->SetQuery( 'SELECT count(*)'
                       . ' FROM #__hwdpsalbums AS album'
                       . $where
                       );
        $total = $db->loadResult();
        echo $db->getErrorMsg();

        // pagination
		$pageNav = new JPagination( $total, $limitstart, $limit );

        // get filtered video data
        $query = 'SELECT'.$hwdps_selecta
                . ' FROM #__hwdpsalbums AS album'
                . $hwdps_joina
                . $where
                . ' ORDER BY album.date_created DESC'
                ;
        $db->SetQuery($query, $pageNav->limitstart, $pageNav->limit);
        $rows = $db->loadObjectList();

        // get category name
        $query_cat = 'SELECT *'
                            . ' FROM #__hwdpscategories'
                            . ' WHERE id = '.$cat_id;
        $db->SetQuery( $query_cat );
        $cat = $db->loadObject();

		// check component access settings and deny those without privileges
		if ($c->access_method == 0) {
			if (!hwd_ps_access::allowAccess( $cat->access_v, $cat->access_v_r, hwd_ps_access::userGID( $my->id ))) {
				if ( ($my->id < 1) && (!$mosConfig_allowUserRegistration == '0' && hwd_ps_access::allowAccess( $c->gtree_core, 'RECURSE', $acl->get_group_id('Registered','ARO') ) ) ) {
					hwd_ps_tools::infomessage(1, 0,  _HWDPS_TITLE_NOACCESS, _HWDPS_ALERT_REGISTERFORCAT, "exclamation.png", 0);
					return;
				} else {
					hwd_ps_tools::infomessage(1, 0,  _HWDPS_TITLE_NOACCESS, _HWDPS_ALERT_CAT_NOT_AUTHORIZED, "exclamation.png", 0);
					return;
				}
			}
		} else if ($c->access_method == 1) {
			if (!hwd_ps_access::allowLevelAccess( $cat->access_lev_v, hwd_ps_access::userGID( $my->id ))) {
				hwd_ps_tools::infomessage(3, 0,  _HWDPS_TITLE_NOACCESS, _HWDPS_ALERT_NOT_AUTHORIZED, "exclamation.png", 0);
				return;
			}
		}



		// get subcategories
		$query = 'SELECT *'
				. ' FROM #__hwdpscategories'
				. ' WHERE published = 1'
				. ' AND parent = '.$cat_id
				. ' ORDER BY category_name'
				;
		$db->setQuery( $query );
		$subcats = $db->loadObjectList();

        // sent out
        hwd_ps_html::viewCategory($rows, $pageNav, $total, $cat_id, $cat, $subcats);
    }
    /**
     * Query SQL for user inputted search pattern
     *
     * @param string $option  the joomla component name
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
        $category = JRequest::getInt( 'category_id', '0' );
		$url = JRoute::_('index.php?option=com_hwdphotoshare&task=displayresults&pattern='.$pattern_safe.'&category_id='.$category.'&Itemid='.$Itemid);
		$mainframe->redirect(html_entity_decode($url));
    }
    /**
     * Query SQL for user inputted search pattern
     *
     * @param string $option  the joomla component name
     * @return       Nothing
     */
    function displayResults()
    {
        global $mainframe, $limitstart, $hwdps_joinp, $hwdps_joina, $hwdps_joing, $hwdps_selectp, $hwdps_selecta, $hwdps_selectg;
		$c = hwd_ps_Config::get_instance();
		$db = & JFactory::getDBO();
		$my = & JFactory::getUser();

		// number of videos and groups to display
        $limitp     = intval($c->ppp);
        $limita     = intval($c->app);
        $limitg     = intval($c->gpp);

        // get POST array values
        $pattern = JRequest::getVar( 'pattern', '' );
		$pattern_safe = str_replace("'", "", $pattern);
		$pattern_safe = str_replace('"', "", $pattern_safe);
		$pattern_safe = addslashes($pattern_safe);
        $category = JRequest::getInt( 'category_id', '0' );

        // setup search filter for videos and groups
        if (!$my->id) {
        $wherephotos = ' WHERE privacy = \'public\' AND MATCH (title,tags,caption) AGAINST (\''.$pattern_safe.'\')';
        $wherealbums = ' WHERE privacy = \'public\' AND MATCH (title,tags,description) AGAINST (\''.$pattern_safe.'\')';
        $wheregroups = ' WHERE privacy = \'public\' AND MATCH (group_name,group_description) AGAINST (\''.$pattern_safe.'\')';
        } else {
        $wherephotos = ' WHERE MATCH (title,tags,caption) AGAINST (\''.$pattern_safe.'\')';
        $wherealbums = ' WHERE MATCH (title,tags,description) AGAINST (\''.$pattern_safe.'\')';
        $wheregroups = ' WHERE MATCH (group_name,group_description) AGAINST (\''.$pattern_safe.'\')';
        }

        if ($category > 0) {
        	$wherephotos.= ' AND category_id = '.$category;
        	$wherealbums.= ' AND category_id = '.$category;
        }


        // count matching photos
        $db->SetQuery( 'SELECT count(*) FROM #__hwdpsphotos'.$wherephotos );
        $totalphotos = $db->loadResult();
        echo $db->getErrorMsg();

		$photoNav = new JPagination( $totalphotos, $limitstart, $limitp );

        $query = 'SELECT'.$hwdps_selectp.' FROM #__hwdpsphotos AS photo'.$hwdps_joinp.$wherephotos;
        $db->SetQuery($query, $photoNav->limitstart, $photoNav->limit);
        $matchingphotos = $db->loadObjectList();

        // count matching albums
        $db->SetQuery( 'SELECT count(*) FROM #__hwdpsalbums'.$wherealbums );
        $totalalbums = $db->loadResult();
        echo $db->getErrorMsg();

		$albumNav = new JPagination( $totalalbums, $limitstart, $limita );

        $query = 'SELECT'.$hwdps_selecta.' FROM #__hwdpsalbums AS album'.$hwdps_joina.$wherealbums;
        $db->SetQuery($query, $albumNav->limitstart, $albumNav->limit);
        $matchingalbums = $db->loadObjectList();

        if ($c->disable_nav_groups == 0) {

			// count matching groups
			$db->SetQuery( 'SELECT count(*) FROM #__hwdpsgroups'.$wheregroups );
			$totalgroups = $db->loadResult();
			echo $db->getErrorMsg();

			$groupNav = new JPagination( $totalgroups, $limitstart, $limitg );

            $query = 'SELECT'.$hwdps_selectg.' FROM #__hwdpsgroups AS group'.$hwdps_joina.$wheregroups;
			$db->SetQuery($query, $groupNav->limitstart, $groupNav->limit);
			$matchinggroups = $db->loadObjectList();

		} else {

			$totalgroups = 0;
			$groupNav = null;
			$matchinggroups = null;

		}

        // sent out
        hwd_ps_html::search($totalphotos, $matchingphotos, $photoNav, $totalalbums, $matchingalbums, $albumNav, $totalgroups, $matchinggroups, $groupNav, $pattern_safe);
    }
}
