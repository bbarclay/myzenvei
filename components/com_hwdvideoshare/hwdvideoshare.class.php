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
define( '_HWD_VS_PLUGIN_COMPS', 214 );

/**
 * @package    hwdVideoShare
 * @author     Dave Horsfall <info@highwooddesign.co.uk>
 * @copyright  2008 Highwood Design
 * @license    http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @version    1.1.3
 */
class hwdvids_video extends JTable
{
    var $id = null;
  	var $video_type = null;
  	var $video_id = null;
  	var $title = null;
  	var $description = null;
  	var $tags = null;
  	var $category_id = null;
    var $date_uploaded = null;
  	var $video_length = null;
  	var $allow_comments = null;
  	var $allow_embedding = null;
  	var $allow_ratings = null;
  	var $rating_number_votes = null;
  	var $rating_total_points = null;
  	var $updated_rating = null;
  	var $public_private = null;
  	var $thumb_snap = null;
  	var $thumbnail = null;
  	var $approved = null;
  	var $number_of_views = null;
  	var $user_id = null;
  	var $featured = null;
  	var $ordering = null;
  	var $checked_out = null;
  	var $checked_out_time = null;
  	var $published = null;

    /**
     * Constructor
     * @param database A database connector object
     */
	function hwdvids_video(&$db){
        parent::__construct( '#__hwdvidsvideos', 'id', $db );
	}
}

/**
 * @package    hwdVideoShare
 * @author     Dave Horsfall <info@highwooddesign.co.uk>
 * @copyright  2008 Highwood Design
 * @license    http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @version    1.1.3
 */
class hwdvids_favs extends JTable
{
	var $id = null;
	var $userid = null;
	var $videoid = null;
	var $date = null;

    /**
     * Constructor
     * @param database A database connector object
     */
	function hwdvids_favs(&$db){
        parent::__construct( '#__hwdvidsfavorites', 'id', $db );
	}
}

/**
 * @package    hwdVideoShare
 * @author     Dave Horsfall <info@highwooddesign.co.uk>
 * @copyright  2008 Highwood Design
 * @license    http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @version    1.1.3
 */
class hwdvids_flagvid extends JTable
{
 	var $id = null;
 	var $username = null;
 	var $videoid = null;
 	var $status = null;
 	var $ignore = null;
 	var $date = null;

    /**
     * Constructor
     * @param database A database connector object
     */
	function hwdvids_flagvid(&$db){
        parent::__construct( '#__hwdvidsflagged_videos', 'id', $db );
	}
}

/**
 * @package    hwdVideoShare
 * @author     Dave Horsfall <info@highwooddesign.co.uk>
 * @copyright  2008 Highwood Design
 * @license    http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @version    1.1.4 Alpha RC2.13
 */
class hwdvids_cats extends JTable
{
 	var $id = null;
 	var $parent = null;
 	var $category_name = null;
 	var $category_description = null;
 	var $date = null;
 	var $access_b_v = null;
 	var $access_u_r = null;
 	var $access_v_r = null;
 	var $access_u = null;
 	var $access_lev_u = null;
 	var $access_v = null;
 	var $access_lev_v = null;
  	var $thumbnail = null;
 	var $ordering = null;
 	var $num_vids = null;
 	var $num_subcats = null;
 	var $checked_out = null;
 	var $checked_out_time = null;
 	var $published = null;

    /**
     * Constructor
     * @param database A database connector object
     */
	function hwdvids_cats(&$db){
        parent::__construct( '#__hwdvidscategories', 'id', $db );
	}
}

/**
 * @package    hwdVideoShare
 * @author     Dave Horsfall <info@highwooddesign.co.uk>
 * @copyright  2008 Highwood Design
 * @license    http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @version    1.1.3
 */
class hwdvids_flaggroup extends JTable
{
 	var $id = null;
 	var $username = null;
 	var $groupid = null;
 	var $status = null;
 	var $ignore = null;
 	var $date = null;

    /**
     * Constructor
     * @param database A database connector object
     */
	function hwdvids_flaggroup(&$db){
        parent::__construct( '#__hwdvidsflagged_groups', 'id', $db );
	}
}

/**
 * @package    hwdVideoShare
 * @author     Dave Horsfall <info@highwooddesign.co.uk>
 * @copyright  2008 Highwood Design
 * @license    http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @version    1.1.3
 */
class hwdvids_groupmember extends JTable
{
 	var $id = null;
 	var $memberid = null;
 	var $date = null;
 	var $group_admin = null;
 	var $groupid = null;
 	var $approved = null;

    /**
     * Constructor
     * @param database A database connector object
     */
	function hwdvids_groupmember(&$db){
        parent::__construct( '#__hwdvidsgroup_membership', 'id', $db );
	}
}

/**
 * @package    hwdVideoShare
 * @author     Dave Horsfall <info@highwooddesign.co.uk>
 * @copyright  2008 Highwood Design
 * @license    http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @version    1.1.3
 */
class hwdvids_group extends JTable
{
 	var $id = null;
 	var $group_name = null;
 	var $public_private = null;
 	var $date = null;
 	var $allow_comments = null;
 	var $require_approval = null;
 	var $group_description = null;
 	var $featured = null;
 	var $adminid = null;
  	var $thumbnail = null;
 	var $total_members = null;
 	var $total_videos = null;
 	var $ordering = null;
 	var $checked_out = null;
 	var $checked_out_time = null;
 	var $published = null;

    /**
     * Constructor
     * @param database A database connector object
     */
	function hwdvids_group(&$db){
        parent::__construct( '#__hwdvidsgroups', 'id', $db );
	}
}

/**
 * @package    hwdVideoShare
 * @author     Dave Horsfall <info@highwooddesign.co.uk>
 * @copyright  2008 Highwood Design
 * @license    http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @version    1.1.3
 */
class hwdvids_groupvideo extends JTable
{
 	var $id = null;
 	var $videoid = null;
 	var $groupid = null;
 	var $memberid = null;
 	var $date = null;
 	var $published = null;

    /**
     * Constructor
     * @param database A database connector object
     */
	function hwdvids_groupvideo(&$db){
        parent::__construct( '#__hwdvidsgroup_videos', 'id', $db );
	}
}

/**
 * @package    hwdVideoShare
 * @author     Dave Horsfall <info@highwooddesign.co.uk>
 * @copyright  2008 Highwood Design
 * @license    http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @version    1.1.3
 */
class hwdvids_rating extends JTable
{
 	var $id = null;
 	var $userid = null;
 	var $videoid = null;
 	var $ip = null;
 	var $date = null;

    /**
     * Constructor
     * @param database A database connector object
     */
	function hwdvids_rating(&$db){
        parent::__construct( '#__hwdvidsrating', 'id', $db );
	}
}

/**
 * @package    hwdVideoShare
 * @author     Dave Horsfall <info@highwooddesign.co.uk>
 * @copyright  2008 Highwood Design
 * @license    http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @version    1.1.3
 */
class hwdvidslogs_views extends JTable
{
 	var $id = null;
 	var $videoid = null;
 	var $userid = null;
 	var $date = null;

    /**
     * Constructor
     * @param database A database connector object
     */
	function hwdvidslogs_views(&$db){
        parent::__construct( '#__hwdvidslogs_views', 'id', $db );
	}
}

/**
 * @package    hwdVideoShare
 * @author     Dave Horsfall <info@highwooddesign.co.uk>
 * @copyright  2008 Highwood Design
 * @license    http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @version    1.1.3
 */
class hwdvidslogs_votes extends JTable
{
 	var $id = null;
 	var $videoid = null;
 	var $userid = null;
 	var $vote = null;
 	var $date = null;

    /**
     * Constructor
     * @param database A database connector object
     */
	function hwdvidslogs_votes(&$db){
        parent::__construct( '#__hwdvidslogs_votes', 'id', $db );
	}
}

/**
 * @package    hwdVideoShare
 * @author     Dave Horsfall <info@highwooddesign.co.uk>
 * @copyright  2008 Highwood Design
 * @license    http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @version    1.1.3
 */
class hwdvidslogs_favours extends JTable
{
 	var $id = null;
 	var $videoid = null;
 	var $userid = null;
 	var $favour = null;
 	var $date = null;

    /**
     * Constructor
     * @param database A database connector object
     */
	function hwdvidslogs_favours(&$db){
        parent::__construct( '#__hwdvidslogs_favours', 'id', $db );
	}
}

/**
 * @package    hwdVideoShare
 * @author     Dave Horsfall <info@highwooddesign.co.uk>
 * @copyright  2008 Highwood Design
 * @license    http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @version    1.1.3
 */
class hwdvidslogs_archive extends JTable
{
 	var $id = null;
 	var $videoid = null;
 	var $views = null;
 	var $number_of_votes = null;
 	var $sum_of_votes = null;
 	var $rating = null;
 	var $favours = null;

    /**
     * Constructor
     * @param database A database connector object
     */
	function hwdvidslogs_archive(&$db){
        parent::__construct( '#__hwdvidslogs_archive', 'id', $db );
	}
}

/**
 * @package    hwdVideoShare
 * @author     Dave Horsfall <info@highwooddesign.co.uk>
 * @copyright  2008 Highwood Design
 * @license    http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @version    1.1.3
 */
class hwdvidsantileech extends JTable
{
 	var $index = null;
 	var $expiration = null;

    /**
     * Constructor
     * @param database A database connector object
     */
	function hwdvidsantileech(&$db){
        parent::__construct( '#__hwdvidsantileech', 'index', $db );
	}
}

/**
 * @package    hwdVideoShare
 * @author     Dave Horsfall <info@highwooddesign.co.uk>
 * @copyright  2008 Highwood Design
 * @license    http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @version    1.1.4
 */
class hwdvidsplugin extends JTable
{
	/** @var int */
	var $id=null;
	/** @var varchar */
	var $name=null;
	/** @var varchar */
	var $element=null;
	/** @var varchar */
	var $type=null;
	/** @var varchar */
	var $folder=null;
	/** @var varchar */
	var $access=null;
	/** @var int */
	var $ordering=null;
	/** @var tinyint */
	var $published=null;
	/** @var tinyint */
	var $iscore=null;
	/** @var tinyint */
	var $client_id=null;
	/** @var int unsigned */
	var $checked_out=null;
	/** @var datetime */
	var $checked_out_time=null;
	/** @var string */
	var $website=null;
	/** @var int */
	var $playlist_compat=null;
	/** @var text */
	var $params=null;
    /**
     * Constructor
     * @param database A database connector object
     */
	function hwdvidsplugin(&$db){
        parent::__construct( '#__hwdvidsplugin', 'id', $db );
	}
}

/**
 * @package    hwdVideoShare
 * @author     Dave Horsfall <info@highwooddesign.co.uk>
 * @copyright  2008 Highwood Design
 * @license    http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @version    1.1.4 Alpha RC3.5
 */
class hwd_vs_tools {
    /**
     * Truncates a php string to $length with a suffix
     *
     * @param string $text  the php input string
     * @param int    $length  the truncation length
     * @param string $suffix(optional)  the string to add to the trucated string
     * @return       $code  the trucated string
     */
	function truncateText( $text, $length, $suffix = "...") {
		$text = stripslashes($text);
		if (strlen($text) < $length ) {
			$code = $text;
		} else {
			$code = stripslashes($text);
			$code = substr($code,0,$length);

			$gap = strrpos($code,' ');
			if (!empty($gap) && $gap <= $length) {
				$code = substr($code,0,$gap);
			}

			$pos = strrpos($code, "&#");
			$acc = strlen($code)-6;

			if ($pos === false) {
				$code = $code.$suffix;
			} else {
				if ($pos > $acc) {
					$code = substr($code,0,$pos);
					$code = $code.$suffix;
				} else {
					$code = $code.$suffix;
				}
			}
		}
		return $code;
	}
    /**
     * Outputs a stop message for frontend user, generally
     * used for error/success messages
     *
     * @param int    $active_menu  the number of the current active menu (1/2/3/4)
     * @param int    $active_usermenu  the number of the current active user navigation menu (0)
     * @param string $title  the title of the message page
     * @param string $message  the body of the message page
     * @param string $icon(optional)  the name of the icon to display
     * @param int    $backlink(optional) display javascript backlink (1/0)
     * @return       Nothing
     */
	function infoMessage( $active_menu, $active_usermenu, $title=_HWDVIDS_TITLE_ERROR, $message ,$icon=null, $backlink=0, $full=1) {
		global $smartyvs;

		hwd_vs_tools::generateActiveLink($active_menu);
		$smartyvs->assign("title", $title);
		$smartyvs->assign("message", $message);
		if ($full == 1) { $smartyvs->assign("full", $message); }
		$smartyvs->assign("icon", URL_HWDVS_IMAGES."icons/".$icon);
		if ($backlink) {
		$smartyvs->assign("backlink", "<a href=\"javascript: history.go(-1)\">"._HWDVIDS_BACKLINK."</a><br /><br />");
		}

		$uri = JFactory::getURI();
		$url = $uri->toString(array('path', 'query', 'fragment'));
		$smartyvs->assign("session_token", JHTML::_( 'form.token' ));
		$smartyvs->assign("session_return", base64_encode($url));

		$smartyvs->display('infomessage.tpl');
		return;
    }
    /**
     * Generates a link to category using $cat_id, and generates the
     * category name if necessary
     *
     * @param int    $cat_id  the category id
     * @param string $category(optional)  the name of the category
     * @return       $code  the html category link
     */
	function generateCategoryLink( $cat_id, $category=null, $hwd_vs_itemid=null ) {
		global $Itemid, $database, $mosConfig_absolute_path;
		$c = hwd_vs_Config::get_instance();
		$code = null;

		if ($hwd_vs_itemid == null) { $hwd_vs_itemid=$Itemid; }

		if ($cat_id == 0) {
			return _HWDVIDS_TEXT_NONE;
		}
		$code.= "<a href=\"".JRoute::_("index.php?option=com_hwdvideoshare&task=viewcategory&Itemid=".$hwd_vs_itemid."&cat_id=".$cat_id)."\">";
		if (isset($category)) {
			$code.= hwd_vs_tools::truncateText($category, $c->truntitle);
		} else {
			$code.= hwd_vs_tools::generateCategory( $cat_id );
		}
		$code.= "</a>";
		return $code;
    }
    /**
     * Generates a link to category using $cat_id, and generates the
     * category name if necessary
     *
     * @param int    $video_id  the category id
     * @param string $video(optional)  the name of the video
     * @return       $code  the html video link
     */
	function generateVideoLink( $video_id, $video=null, $hwdvs_itemid=null, $onclick_js=null, $truntitle=null ) {
		global $Itemid, $database, $mosConfig_absolute_path;
		$c = hwd_vs_Config::get_instance();
		if ($hwdvs_itemid == null) { $hwdvs_itemid = $Itemid; }

		if (!empty($onclick_js)) {
			$onclick_txt="onclick=\"".$onclick_js."(".$video_id.");return false;\"";
			$link="#video";
		} else {
			$onclick_txt="";
			$link=JRoute::_("index.php?option=com_hwdvideoshare&task=viewvideo&Itemid=".$hwdvs_itemid."&video_id=".$video_id);
		}

		$code = null;
		$code.= "<a href=\"".$link."\" ".$onclick_txt.">";
		if (isset($video)) {
			$code.= hwd_vs_tools::truncateText($video, $truntitle);
		} else {
			$code.= "0";
		}
		$code.= "</a>";
		return $code;
    }
    /**
     * Generates the name of a category from the $cat_id
     *
     * @param int    $cat_id  the joomla component name
     * @return       $code  the name of the category
     */
	function generateCategory( $cat_id ) {
		global $catnames;
		$c = hwd_vs_Config::get_instance();
  		$db =& JFactory::getDBO();

		if ($cat_id == 0) {
			$code = _HWDVIDS_TEXT_NONE;
		}
		if (!isset($catnames)) {
			// get category name
			$query = 'SELECT id, category_name FROM #__hwdvidscategories';
			$db->SetQuery( $query );
			$catnames = $db->loadObjectList();
 		}
		$code = _HWDVIDS_TEXT_NONE;
		for ($i=0, $n=count($catnames); $i < $n; $i++) {
			$row = $catnames[$i];
			if ($row->id == $cat_id) {
				$code = $row->category_name;
				break;
			}
		}
		return $code;
    }
    /**
     * Generates a linked thumbnail for category id $row->id
     *
     * @param array  $row  the category details from sql
     * @param int    $k  current css tag
     * @param int    $width  width of the thumbnail
     * @param int    $height  height of the thumbnail
     * @param string $class  class for thumbnail (not link)
     * @param string $target(optional)  the target for the link
     * @return       $code
     */
	function generateCategoryThumbnailLink( $row, $k, $width, $height, $class, $target="_top") {
		global $Itemid, $database, $mosConfig_absolute_path;
		$c = hwd_vs_Config::get_instance();
		$db = & JFactory::getDBO();

		if ($row->thumbnail == '') {
			$query = 'SELECT *'
						. ' FROM #__hwdvidsvideos'
						. ' WHERE category_id = '.$row->id
						. ' AND published = 1'
						. ' AND approved = "yes"'
						. ' ORDER BY date_uploaded DESC'
						. ' LIMIT 0, 1'
						;
			$db->SetQuery($query);
			$latestcatvid = $db->loadObject();
			if (empty($latestcatvid->id)) {$latestcatvid->id=null;}
			if (empty($latestcatvid->video_id)) {$latestcatvid->video_id=null;}
			if (empty($latestcatvid->video_type)) {$latestcatvid->video_type=null;}
			if (empty($latestcatvid->thumbnail)) {$latestcatvid->thumbnail=null;}
			$code = null;
			$code.= "<a href=\"".JRoute::_("index.php?option=com_hwdvideoshare&task=viewcategory&Itemid=".$Itemid."&cat_id=".$row->id)."\">";
			$code.= hwd_vs_tools::generateThumbnail( $latestcatvid->id, $latestcatvid->video_id, $latestcatvid->video_type, $latestcatvid->thumbnail, $k, $width, $height, $class );
			$code.= "</a>";
		} else {
			$code = null;
			$code.= "<a href=\"".JRoute::_("index.php?option=com_hwdvideoshare&task=viewcategory&Itemid=".$Itemid."&cat_id=".$row->id)."\">";
			$code.= hwd_vs_tools::generateThumbnail( null, null, "category", $row->thumbnail, $k, $width, $height, $class );
			$code.= "</a>";
		}
		return $code;
    }
    /**
     * Generates a linked thumbnail for group id $row->id
     *
     * @param array  $row  the group details from sql
     * @param int    $k  current css tag
     * @param int    $width  width of the thumbnail
     * @param int    $height  height of the thumbnail
     * @param string $class  class for thumbnail (not link)
     * @param string $target(optional)  the target for the link
     * @return       $code
     */
	function generateGroupThumbnailLink( $row, $k, $width, $height, $class, $target="_top") {
		global $Itemid, $database, $mosConfig_absolute_path;
		$c = hwd_vs_Config::get_instance();
		$db = & JFactory::getDBO();

		$query = 'SELECT a.video_id, a.id, a.video_type, a.thumbnail'
				. ' FROM #__hwdvidsvideos AS a'
				. ' LEFT JOIN #__hwdvidsgroup_videos AS l ON l.videoid = a.id'
				. ' WHERE l.groupid = '.$row->id
				. ' AND a.published = 1'
				. ' AND a.approved = "yes"'
				. ' ORDER BY a.date_uploaded'
				. ' LIMIT 0, 1'
				;
		$db->SetQuery($query);
		$group_video = $db->loadObject();
		if (empty($group_video->id)) { $group_video->id=null; }
		if (empty($group_video->video_id)) { $group_video->video_id=null; }
		if (empty($group_video->video_type)) { $group_video->video_type=null; }
		if (empty($group_video->thumbnail)) { $group_video->thumbnail=null; }
		$code = null;
		$code.= "<a href=\"".JRoute::_("index.php?option=com_hwdvideoshare&task=viewgroup&Itemid=".$Itemid."&group_id=".$row->id)."\">";
		$code.= hwd_vs_tools::generateThumbnail( $group_video->id, $group_video->video_id, $group_video->video_type, $group_video->thumbnail, $k, $width, $height, $class );
		$code.= "</a>";
		return $code;
		return $code;
    }
    /**
     * Generates a linked thumbnail for video id $video_id
     *
     * @param int    $video_id  the id of the video
     * @param string $video_code  the name of the video file (excluding ext)
     * @param string $video_type  the video type tag
     * @param int    $k  current css tag
     * @param int    $width  width of the thumbnail
     * @param int    $height  height of the thumbnail
     * @param string $class  class for thumbnail (not link)
     * @param string $target(optional)  the target for the link
     * @return       $code
     */
	function generateVideoThumbnailLink( $video_id, $video_code, $video_type, $video_thumbnail, $k, $width, $height, $class, $target="_top", $hwdvs_itemid=null, $onclick_js=null, $tooltip_data=null) {
		global $Itemid, $database, $mosConfig_absolute_path;
		$c = hwd_vs_Config::get_instance();
		if ($hwdvs_itemid == null) { $hwdvs_itemid = $Itemid; }
		if (!empty($onclick_js)) {
			$onclick_txt="onclick=\"".$onclick_js."(".$video_id.");return false;\"";
			$link="#video";
		} else {
			$onclick_txt="";
			$link=JRoute::_("index.php?option=com_hwdvideoshare&task=viewvideo&Itemid=".$hwdvs_itemid."&video_id=".$video_id);
		}

		$code = null;
		$code.= "<a href=\"".$link."\" ".$onclick_txt.">";
		$code.= hwd_vs_tools::generateThumbnail( $video_id, $video_code, $video_type, $video_thumbnail, $k, $width, $height, $class, $tooltip_data );
		$code.= "</a>";

		return $code;
    }
    /**
     * Generates the video url for the Permalink
     *
     * @param array  $row  the group details from sql
     * @return       $code  the Permalink
     */
	function generateVideoUrl( $row ) {
		global $Itemid, $smartyvs, $mosConfig_absolute_path;
		$c = hwd_vs_Config::get_instance();

		$code = null;
		if ($c->showvurl == "1") {
			$code.= JURI::root()."index.php?option=com_hwdvideoshare&task=viewvideo&Itemid=".$Itemid."&video_id=".$row->id;
			$smartyvs->assign("print_videourl", 1);
		}

		return $code;
    }
    /**
     * Generates the array of information for a standard group list from sql queries
     *
     * @param array  $rows  the list from a standard sql queries
     * @return       $code  the array prepared for Smarty template
     */
	function generateGroupListFromSql( $rows ) {
		global $Itemid, $database, $mosConfig_absolute_path;
		$c = hwd_vs_Config::get_instance();

		$code = array();
		$k = 0;
		for ($i=0, $n=count($rows); $i < $n; $i++) {
			$row = $rows[$i];

			if (!isset($row->avatar)) { $row->avatar=null; }

			$code[$i]->thumbnail = hwd_vs_tools::generateGroupThumbnailLink($row, $k, null, null, null);
			$code[$i]->avatar = hwd_vs_tools::generateAvatar($row->adminid, $row->avatar, $k, null, null, null);
			$code[$i]->grouptitle = hwd_vs_tools::generateGroupLink($row->id, $row->group_name);
			$code[$i]->groupdescription = hwd_vs_tools::truncateText(strip_tags($row->group_description), $c->trunvdesc);
			$code[$i]->totalmembers = $row->total_members;
			$code[$i]->totalvideos = $row->total_videos;
			$code[$i]->administrator = hwd_vs_tools::generateUserFromID($row->adminid, $row->username, $row->name);
			$code[$i]->groupmembership = hwd_vs_tools::generateGroupMembershipStatus($row);
			$code[$i]->reportgroup = hwd_vs_tools::generateReportGroupButton($row);
			$code[$i]->datecreated = $row->date;
			$code[$i]->deletegroup = hwd_vs_tools::generateDeleteGroupLink($row);
			$code[$i]->editgroup = hwd_vs_tools::generateEditGroupLink($row);
			$code[$i]->k = $k;
			$k = 1 - $k;
		}
		return $code;
    }
    /**
     * Generates the array of information for a standard video list from sql queries
     *
     * @param array  $rows  the list from a standard sql queries
     * @param string $thumbclass(optional)  the class for the thumbnail images
     * @param int    $thumbwidth(optional)  the thumbnail width
     * @param int    $thumbheight(optional)  the thumbnail height
     * @return       $code  the array prepared for Smarty template
     */
    function generateVideoListFromSql( $rows, $thumbclass=null, $thumbwidth=null, $thumbheight=null, $hwdvs_itemid=null, $onclick_js=null, $tooltip=null, $or_title_trunc=null, $or_descr_trunc=null) {
		global $Itemid, $database, $mosConfig_absolute_path;
		$acl= & JFactory::getACL();
		$usersConfig = &JComponentHelper::getParams( 'com_users' );
		$c = hwd_vs_Config::get_instance();

		if ($tooltip == false) {
			$tooltip = 0;
		} else if ($c->show_tooltip == "1") {
			$tooltip = 1;
		}

		$code = array();
		$k = 0;
		if (isset($thumbwidth)) { $twidth = $thumbwidth; } else { $twidth = null; }
		if (isset($thumbheight)) { $theight = $thumbheight; } else { $theight = null; }
		if (isset($thumbclass)) { $tclass = $thumbclass; } else { $tclass = null; }
		if (isset($or_title_trunc) && !empty($or_title_trunc)) { $truntitle = $or_title_trunc; } else { $truntitle = $c->truntitle; }
		if (isset($or_descr_trunc) && !empty($or_descr_trunc)) { $trunvdesc = $or_descr_trunc; } else { $trunvdesc = $c->trunvdesc; }
		$width = null;
		$height = null;
		$class = null;
		$tooltip_data = null;

		for ($i=0, $n=count($rows); $i < $n; $i++) {
			$row = $rows[$i];

			if (!isset($row->avatar)) { $row->avatar=null; }
			if (!isset($row->username)) { $row->username = ''; }
			if (!isset($row->name)) { $row->name = ''; }

			$code[$i]->avatar = hwd_vs_tools::generateAvatar($row->user_id, $row->avatar, $k, $width, $height, $class);
			$code[$i]->title = hwd_vs_tools::generateVideoLink( $row->id, $row->title, $hwdvs_itemid, $onclick_js, $truntitle);
			$code[$i]->category = hwd_vs_tools::generateCategoryLink($row->category_id);
			$code[$i]->description = hwd_vs_tools::truncateText(strip_tags(stripslashes($row->description)), $trunvdesc);

			$tooltip_data[0] = $tooltip;
			$tooltip_data[1] = hwd_vs_tools::truncateText(htmlspecialchars(strip_tags(stripslashes($row->title))), $truntitle);
			$tooltip_data[2] = hwd_vs_tools::truncateText(htmlspecialchars(strip_tags(stripslashes($row->description))), $trunvdesc);

			$code[$i]->thumbnail = hwd_vs_tools::generateVideoThumbnailLink($row->id, $row->video_id, $row->video_type, $row->thumbnail, $k, $twidth, $theight, $tclass, null, $hwdvs_itemid, $onclick_js, $tooltip_data);
			$code[$i]->rating = hwd_vs_tools::generateRatingImg($row->updated_rating);
			$code[$i]->views = $row->number_of_views;
			$code[$i]->duration = $row->video_length;
			$code[$i]->uploader = hwd_vs_tools::generateUserFromID($row->user_id, $row->username, $row->name);
			$code[$i]->timesince = hwd_vs_tools::generateTimeSinceUpload($row->date_uploaded);
			$code[$i]->deletevideo = hwd_vs_tools::generateDeleteVideoLink($row);
			$code[$i]->editvideo = hwd_vs_tools::generateEditVideoLink($row);
			$code[$i]->publishvideo = hwd_vs_tools::generatePublishVideoLink($row);
			$code[$i]->upload_date = $row->date_uploaded;
			$code[$i]->k = $k;
			$k = 1 - $k;
		}
		return $code;
    }
    /**
     * Generates the array of information for a standard video list from parsed xml files
     *
     * @param array  $rows  the list from an xml file
     * @return       $code  the array prepared for Smarty template
     */
	function generateVideoListFromXml( $rows, $thumbwidth=null, $hwdvs_itemid=null, $tooltip=null, $or_title_trunc=null, $or_descr_trunc=null, $onclick_js=null ) {
		$c = hwd_vs_Config::get_instance();

		$code = array();
		$k = 0;

		if (isset($thumbwidth)) { $twidth = $thumbwidth; } else { $twidth = $c->thumbwidth; }
		$theight = $twidth*$c->tar_fb;

		if (isset($or_title_trunc) && !empty($or_title_trunc)) { $truntitle = $or_title_trunc; } else { $truntitle = $c->truntitle; }
		if (isset($or_descr_trunc) && !empty($or_descr_trunc)) { $trunvdesc = $or_descr_trunc; } else { $trunvdesc = $c->trunvdesc; }
		$class=null;
		$width=null;
		$height=null;

		for ($i=0, $n=count($rows); $i < $n; $i++) {
			$row = $rows[$i];

			$video_code = explode(",", $rows[$i]["videocode"]);
			if (!empty($video_code[1])) {
				$video_code[1] = urldecode($video_code[1]);
				$rows[$i]["videocode"] = implode(",", $video_code);
			}

			if (empty($rows[$i]["category"])) {$rows[$i]["category"]=null;}
			if (empty($rows[$i]["avatar"])) {$rows[$i]["avatar"]=null;}
			if (empty($rows[$i]["uploader"])) {$rows[$i]["uploader"]=null;}
			if (empty($rows[$i]["description"])) {$rows[$i]["description"]=null;}
			if (empty($rows[$i]["thumbnail"])) {$rows[$i]["thumbnail"]=null;}

			$tooltip_data[0] = $tooltip;
			$tooltip_data[1] = addslashes(hwd_vs_tools::truncateText(strip_tags($rows[$i]["videotitle"]), $truntitle));
			$tooltip_data[2] = addslashes(hwd_vs_tools::truncateText(strip_tags($rows[$i]["description"]), $trunvdesc));

			$code[$i]->thumbnail = hwd_vs_tools::generateVideoThumbnailLink($rows[$i]["id"], $rows[$i]["videocode"], $rows[$i]["videotype"], $rows[$i]["thumbnail"], $k, $twidth, $theight, $class, null, $hwdvs_itemid, $onclick_js, $tooltip_data);
			if ($c->cbint == "1" || $c->cbint == "2" || $c->cbint == "3") { $code[$i]->avatar = hwd_vs_tools::generateAvatar($rows[$i]["uploader_id"], $rows[$i]["avatar"], $k, $width, $height, $class); }
			$code[$i]->title = hwd_vs_tools::generateVideoLink( $rows[$i]["id"], $rows[$i]["videotitle"], $hwdvs_itemid, $onclick_js, $truntitle);
			$code[$i]->category = hwd_vs_tools::generateCategoryLink($rows[$i]["category_id"], $rows[$i]["category"], $hwdvs_itemid);
			$code[$i]->description = hwd_vs_tools::truncateText(strip_tags(hwdEncoding::UNXMLEntities($rows[$i]["description"])), $trunvdesc);
			$code[$i]->rating = hwd_vs_tools::generateRatingImg($rows[$i]["rating"]);
			$code[$i]->views = $rows[$i]["views"];
			$code[$i]->duration = $rows[$i]["duration"];
			$code[$i]->uploader = hwd_vs_tools::generateUserFromID($rows[$i]["uploader_id"], $rows[$i]["uploader"], $rows[$i]["uploader"]);
			$code[$i]->timesince = '';
			//$code[$i]->timesince = hwd_vs_tools::generateTimeSinceUpload();
			$code[$i]->k = $k;
			$k = 1 - $k;

		}
		return $code;
    }
    /**
     * Generates the array of information for a standard group member list
     *
     * @param array  $rows  the list from a standard sql queries
     * @return       $code  the array prepared for Smarty template
     */
    function generateGroupMemberList( $rows ) {
		global $Itemid, $database, $mosConfig_absolute_path;
		$c = hwd_vs_Config::get_instance();

		$code = array();
		$k = 0;
		for ($i=0, $n=count($rows); $i < $n; $i++) {
			$row = $rows[$i];
			$code[$i]->member_id = $row->id;
			$code[$i]->member_username = hwd_vs_tools::generateUserFromID($row->memberid, $row->username, $row->name);
			$code[$i]->k = $k;
			$k = 1 - $k;
		}
		return $code;
    }
    /**
     * Generates the human readable status of a video from the raw sql data
     *
     * @param string $status  the raw sql format
     * @return       $code  the multilingual human readable text
     */
	function generateVideoStatus( $status ) {

		$code = null;
		if ($status == "yes") {
			$code.= _HWDVIDS_DETAILS_VIDSTATUS_Y;
		} else if ($status == "queuedforconversion") {
			$code.= _HWDVIDS_DETAILS_VIDSTATUS_QFC;
		} else if ($status == "queuedforthumbnail") {
			$code.= _HWDVIDS_DETAILS_VIDSTATUS_QFT;
		} else if ($status == "queuedforswf") {
			$code.= _HWDVIDS_DETAILS_VIDSTATUS_QFSWF;
		} else if ($status == "queuedformp4") {
			$code.= _HWDVIDS_DETAILS_VIDSTATUS_QFMP4;
		} else if ($status == "deleted") {
			$code.= "<a href=\"index.php?option=com_hwdvideoshare&task=maintenance\">"._HWDVIDS_DETAILS_VIDSTATUS_D."</a>";
		} else if ($status == "pending") {
			$code.= _HWDVIDS_DETAILS_VIDSTATUS_P;
		} else {
			$code.= $status;
		}
		return $code;
    }
    /**
     * Generates the human readable access level of a video from the raw sql data
     *
     * @param string $status  the raw sql format
     * @return       $code  the multilingual human readable text
     */
	function generateVideoAccess( $status ) {

		$code = null;
		if ($status == "public") {
			$code.= _HWDVIDS_SELECT_PUBLIC;
		} else if ($status == "registered") {
			$code.= _HWDVIDS_SELECT_REG;
		} else {
			$code.= $status;
		}
		return $code;
    }
    /**
     * Generates the embed code of a video
     *
     * @param array  $row  the video information
     * @return       $code
     */
	function generateEmbedCode( $row ) {
		global $Itemid, $database, $mainframe, $option, $task, $smartyvs, $show_video_ad, $pre_url, $post_url;
		$c = hwd_vs_Config::get_instance();
		$db = & JFactory::getDBO();

		$vp_plugin_path = JPATH_SITE.'/plugins/hwdvs-videoplayer/'.$c->hwdvids_videoplayer_file.'.view.php';
		if (file_exists($vp_plugin_path)) {
			require_once($vp_plugin_path);
		} else if (file_exists(JPATH_SITE.'/plugins/hwdvs-videoplayer/flow.view.php')) {
			require_once(JPATH_SITE.'/plugins/hwdvs-videoplayer/flow.view.php');
		} else {
        	$code = "This video can not be displayed because there are no video players installed.";
        	return $code;
		}

		$player = new hwd_vs_videoplayer();
		$flv_url = null;
		$flv_path = null;
		$thumb_url = null;
		$code = null;

		$code = null;
		if ($c->showvebc == "1") {
			$smartyvs->assign("print_embedcode", 1);

			if ( $row->allow_embedding == "0" ) {

				$code.= _HWDVIDS_INFO_EMBEDDISABLED;
				return $code;

			}

			if ($row->video_type == "local" ||
				$row->video_type == "remote" ||
				$row->video_type == "mp4" ||
				$row->video_type == "swf" &&
				$c->standaloneswf == 0) {

				if ($row->video_type == "local") {
					$flv_url = JURI::root(true)."/hwdvideos/uploads/".$row->video_id.".flv";
					$flv_path = HWDVIDSPATH.'/../../hwdvideos/uploads/'.$row->video_id.'.flv';
					$thumb_url = JURI::root()."hwdvideos/thumbs/".$row->video_id.".jpg";
				} else if ($row->video_type == "remote"){
					$data = explode(",", $row->video_id);
					$flv_url = @$data[0];
					$flv_path = null;
					$thumb_url = @$data[1];
				} else if ($row->video_type == "mp4"){
					$flv_url = JURI::root(true)."/hwdvideos/uploads/".$row->video_id.".mp4";
					$flv_path = HWDVIDSPATH.'/../../hwdvideos/uploads/'.$row->video_id.'.mp4';
					$thumb_url = JURI::root()."hwdvideos/thumbs/".$row->video_id.".jpg";
				} else if ($row->video_type == "swf"){
					$flv_url = JURI::root(true)."/hwdvideos/uploads/".$row->video_id.".swf";
					$flv_path = HWDVIDSPATH.'/../../hwdvideos/uploads/'.$row->video_id.'.swf';
					$thumb_url = JURI::root()."hwdvideos/thumbs/".$row->video_id.".jpg";
				}

				// setup antileech system expiration
				$dlink = hwd_vs_tools::generateAntileechExpiration($row->id, $row->video_type, 'player');
				$dlink = urlencode($dlink);
				$code.= $player->prepareEmbedCode($dlink, null, null, null, "video", null, $thumb_url, 0, $row->id);

			} else if ( $row->video_type == "swf" ) {

				if ($c->standaloneswf == 1) {
					if ($c->embedreturnlink == 1) {
						$code.='<div><center>';
					}
					$code.= "<object classid=&#34;clsid:d27cdb6e-ae6d-11cf-96b8-444553540000&#34; width=&#34;427&#34; height=&#34;340&#34; codebase=&#34;http://active.macromedia.com/flash7/cabs/ swflash.cab#version=9,0,0,0&#34;><param name=&#34;movie&#34; value=&#34;&#34;.$flv_url.&#34;&#34;><param name=&#34;play&#34; value=&#34;true&#34;><param name=&#34;loop&#34; value=&#34;true&#34;><param name=&#34;quality&#34; value=&#34;high&#34;><param name=&#34;scale&#34; value=&#34;showall&#34;><embed src=&#34;".$flv_url."&#34; width=&#34;427&#34; height=&#34;340&#34; play=&#34;true&#34; scale=&#34;showall&#34; loop=&#34;true&#34; quality=&#34;high&#34; pluginspage=&#34;http://www.macromedia.com/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash&#34;></embed></object>";
					if ($c->embedreturnlink == 1) {
						$jconfig = new jconfig();
						$code.='<br /><a href=&#34;'.JURI::root( true ).'&#34; title=&#34;'.$jconfig->sitename.'&#34;>'.$jconfig->sitename.'</a></center></div>';
					}
				} else {
					$player = new hwd_vs_videoplayer();
					$code.= $player->prepareEmbedCode($flv_url, null, null, null, "video", null, $thumb_url);
				}

			} else if ( $row->video_type == "playlist" ) {

				$flv_path = $row->playlist;
				$code.= $player->prepareEmbedCode($flv_path, null, null, null, "playlist", null, $thumb_url);

			} else if ($row->video_type == "seyret") {

				if (@explode(",", $video_code)) {
					$data = explode(",", $row->video_id);
				} else {
					return;
				}
				if ($data[0] == "local") {
					$file->id = $row->id;
					$file->allow_embedding = $row->allow_embedding;
					$file->video_type = "remote";
					$file->video_id = $data[1].",".$data[2];
					$code.= hwd_vs_tools::generateEmbedCode($file);
				} else {
					$file->id = $row->id;
					$file->allow_embedding = $row->allow_embedding;
					$file->video_type = $data[0];
					$file->video_id = $data[1].",".$data[2];
					$code.= hwd_vs_tools::generateEmbedCode($file);
				}

			} else {
				$plugin = hwd_vs_tools::getPluginDetails($row->video_type);
				if (!$plugin) {
					$code.= _HWDVIDS_INFO_EMBEDDISABLED;
				} else {
					// print video embed code
					$preparevidembed = preg_replace("/[^a-zA-Z0-9s_-]/", "", $row->video_type)."PrepareVideoEmbed";
					$embedcode = $preparevidembed($row->video_id, $row->id, $Itemid);
					$code.= $embedcode;
				}
			}

		}
		return $code;
    }
    /**
     * Generates the category list with formatted subcategories
     *
     * @param string $header  the joomla component name
     * @param int    $selid  array of video data
     * @param string $nocatsmess  no category message
     * @param int    $pub(optional)  only list published categories (0/1)
     * @param int    $cname(optional)  category select list name value
     * @param int    $checkaccess(optional)  only list accessible categories for current user (0/1)
     * @return       $code
     */
	function categoryList( $header, $selid, $nocatsmess, $pub = 0, $cname = "category_id", $checkaccess = 1, $tag_attribs = 'class="inputbox"', $show_uncategorised=false) {

		global $database, $my, $mosConfig_lang;
  		$db =& JFactory::getDBO();
		$my = & JFactory::getUser();
        $c = hwd_vs_Config::get_instance();

		if ($pub) { $where = "\nWHERE published = 1"; } else { $where = null; }
		$db->setQuery("SELECT id ,parent,category_name, access_u, access_lev_u, access_u_r from #__hwdvidscategories"
		                . $where
		                . "\nORDER BY category_name"
		                );
		$mitems = $db->loadObjectList();
		// establish the hierarchy of the menu
		$children = array ();

		$nocats = 0;
		// first pass - collect children
		foreach ($mitems as $v)
		{
			$pt = $v->parent;
			if ($checkaccess) {

				// check component access settings and deny those without privileges
				if ($c->access_method == 0) {
					if (!hwd_vs_access::allowAccess( $v->access_u, $v->access_u_r, hwd_vs_access::userGID( $my->id ))) {
						continue;
					}
				} else if ($c->access_method == 1) {
					if (!hwd_vs_access::allowLevelAccess( $v->access_lev_u, hwd_vs_access::userGID( $my->id ))) {
						continue;
					}
				}
			}
			$nocats = 1;
			$list = @$children[$pt] ? $children[$pt] : array ();
			array_push($list, $v);
			$children[$pt] = $list;
		}

		// second pass - get an indent list of the items
		$list = hwd_vs_tools::catTreeRecurse(0, '', array (), $children);
		// assemble menu items to the array
		$mitems = array ();
		if ($nocats == 0) {
			$mitems[] = JHTML::_('select.option', '0', $nocatsmess);
		} else {
			$mitems[] = JHTML::_('select.option', '0', $header);
			if ($show_uncategorised) {
				$mitems[] = JHTML::_('select.option', 'none', 'Uncategorized');
			}
		}
		$this_treename = '';

		foreach ($list as $item)
		{
			if ($this_treename)
			{
				if ($item->id != $mitems && strpos($item->treename, $this_treename) === false) {
					$mitems[] = JHTML::makeOption($item->id, $item->treename);
				}
			}
			else
			{
				if ($item->id != $mitems) {
					$mitems[] = JHTML::_('select.option', $item->id, $item->treename);
				}
				else {
					$this_treename = "$item->treename/";
				}
			}
		}

		// build the html select list
		$code = hwd_vs_tools::selectList2($mitems, $cname, $tag_attribs, 'value', 'text', $selid);
		return $code;
    }
    /**
     * Generates a thumbnail image
     *
     * @param int    $video_id  the video sql id
     * @param string $video_code  the video uid
     * @param string $video_type  the video type
     * @param int    $k  the css variable
     * @param int    $width(optional)  the width of the thumbnail image
     * @param int    $height(optional)  the height of the thumbnail image
     * @param string $class(optional)  the class of the thumbnail image
     * @return       $code
     */
	function generateThumbnail( $video_id, $video_code, $video_type, $video_thumbnail, $k, $width=null, $height=null, $class=null, $tooltip_data=null) {
		global $Itemid, $mainframe, $hwdvsTemplateOverride;
		$c = hwd_vs_Config::get_instance();
  		$db =& JFactory::getDBO();

		if (!isset($width)) {
			if (isset($hwdvsTemplateOverride['thumbWidth1'])) {
				$width = $hwdvsTemplateOverride['thumbWidth1'];
			} else {
				$width = $c->thumbwidth;
			}
		}
		if (!isset($height)) {
			$height = $width*$c->tar_fb;
		}
		if (!isset($class) || empty($class)) {
			$class = "thumb".$k;
		}
		if ($tooltip_data[0]) {
			JHTML::_('behavior.tooltip');
			$class = "hasTip";
			$thumb_title = $tooltip_data[1]." :: ".$tooltip_data[2];
		} else {
			$thumb_title = $tooltip_data[1];
		}

		$thumbnailURL = hwd_vs_tools::generateThumbnailURL( $video_id, $video_code, $video_type, $video_thumbnail );

		$path_ext = (!empty($video_thumbnail) ? $video_thumbnail : "jpg");
		$path_thumb = JPATH_SITE."/hwdvideos/thumbs/".$video_code.".".$path_ext;
		$url_thumb = JURI::root( true )."/hwdvideos/thumbs/".$video_code.".".$path_ext;
		$path_thumbd = JPATH_SITE."/hwdvideos/thumbs/".$video_code.".gif";
		$url_thumbd = JURI::root( true )."/hwdvideos/thumbs/".$video_code.".gif";

		if (($video_type == "local" || $video_type == "mp4" || $video_type == "swf") && (file_exists($path_thumb) && (filesize($path_thumb) > 0))) {

			if ($c->udt == 1 && file_exists($path_thumbd) && (filesize($path_thumbd) > 0)) {
				if (!defined( '_HWD_VS_DTFLAG' )) {
					define( '_HWD_VS_DTFLAG', 1 );
					$mainframe->addCustomHeadTag("<script type='text/javascript'>function roll_over(img_name, img_src) { document[img_name].src = img_src; }</script>");
				}
				$thumb = "<img src=\"".$thumbnailURL."\" border=\"0\" alt=\""._HWDVIDS_DETAILS_VIEWVID."\" width=\"".$width."\" height=\"".$height."\" title=\"".$thumb_title."\" class=\"".$class."\" name=\"".$video_code."\" onmouseover=\"roll_over('".$video_code."', '".$url_thumbd."')\" onmouseout=\"roll_over('".$video_code."', '".$thumbnailURL."')\" />";
			} else {
				$thumb = "<img src=\"".$thumbnailURL."\" border=\"0\" alt=\""._HWDVIDS_DETAILS_VIEWVID."\" width=\"".$width."\" height=\"".$height."\" title=\"".$thumb_title."\" class=\"".$class."\" />";
			}

		} else {

			$thumb = "<img src=\"".$thumbnailURL."\" alt=\""._HWDVIDS_DETAILS_VIEWVID."\" border=\"0\" width=\"".$width."\" height=\"".$height."\" title=\"".$thumb_title."\" class=\"".$class."\" />";

		}
		return $thumb;
    }
    /**
     * Generates a thumbnail image
     *
     * @param int    $video_id  the video sql id
     * @param string $video_code  the video uid
     * @param string $video_type  the video type
     * @param int    $k  the css variable
     * @param int    $width(optional)  the width of the thumbnail image
     * @param int    $height(optional)  the height of the thumbnail image
     * @param string $class(optional)  the class of the thumbnail image
     * @return       $code
     */
	function generateThumbnailURL( $video_id, $video_code, $video_type, $video_thumbnail ) {
		global $Itemid, $mainframe, $mosConfig_absolute_path;
		$c = hwd_vs_Config::get_instance();
  		$db =& JFactory::getDBO();

		$path_ext = (!empty($video_thumbnail) ? $video_thumbnail : "jpg");
		$path_thumb = JPATH_SITE."/hwdvideos/thumbs/".$video_code.".".$path_ext;
		$url_thumb = JURI::root( true )."/hwdvideos/thumbs/".$video_code.".".$path_ext;
		$path_thumbd = JPATH_SITE."/hwdvideos/thumbs/".$video_code.".gif";
		$url_thumbd = JURI::root( true )."/hwdvideos/thumbs/".$video_code.".gif";

		if (($video_type == "local" || $video_type == "mp4" || $video_type == "swf") && (file_exists($path_thumb) && (filesize($path_thumb) > 0))) {

			$thumb = $url_thumb;
			$thumb = JURI::root( true ).'/index.php?option=com_hwdvideoshare&task=deliverThumb&id='.$video_id.'&tmpl=component';

		} else if (($video_type == "local" || $video_type == "swf") && (!file_exists(JPATH_SITE.DS.'hwdvideos'.DS.'thumbs'.DS.$video_id.'.jpg') || (filesize(JPATH_SITE.DS.'hwdvideos'.DS.'thumbs'.DS.$video_id.'.jpg') <= 0))) {

			$thumb = URL_HWDVS_IMAGES.'default_thumb.jpg';

		} else if (!empty($video_thumbnail)) {

			$thumb = $video_thumbnail;

		} else if ($video_type == "seyret") {

			$data = @explode(",", $video_code);
			if ($data[0] == "local") {

				if (!empty($video_thumbnail)) {

					$thumb = $video_thumbnail;

				} else {

					$pos = strpos($data[2], "http://");
					if ($pos === false) {
						$thumb = JURI::root().$data[2];
					} else {
						$thumb = $data[2];
					}

				}

			} else {

				if (!empty($video_thumbnail)) {
					$thumb = $video_thumbnail;
				} else {

					$plugin = hwd_vs_tools::getPluginDetails($data[0]);
					if (!$plugin) {
						$thumb = URL_HWDVS_IMAGES.'default_thumb.jpg';
					} else {

						$preparethumb = preg_replace("/[^a-zA-Z0-9s_-]/", "", $data[0])."PrepareThumbURL";
						$new_video_code = $data[1].",".$data[2];

						if ($thumbcode = $preparethumb($new_video_code, $video_id)) {
							$thumb = $thumbcode;
						} else {
							$thumb = URL_HWDVS_IMAGES.'default_thumb.jpg';
						}
					}
				}
			}

		} else {
			if (!empty($video_thumbnail)) {
				$thumb = $video_thumbnail;
			} else {

				$plugin = hwd_vs_tools::getPluginDetails($video_type);
				if (!$plugin) {

					$thumb = URL_HWDVS_IMAGES.'default_thumb.jpg';

				} else {

					$preparethumb = preg_replace("/[^a-zA-Z0-9s_-]/", "", $video_type)."PrepareThumbURL";

					if ($thumbcode = $preparethumb($video_code, $video_id)) {
						$thumbcode = $thumbcode;
					} else {
						$thumbcode = URL_HWDVS_IMAGES.'default_thumb.jpg';
					}

					$thumb = $thumbcode;
				}
			}
		}
		return $thumb;
    }
    /**
     * Generates the CB avatar thumbnail image from user id
     *
     * @param string $user_id  the joomla user's id
     * @param array  $k  the css variable
     * @param array  $width  the width of the avatar image
     * @param object $height  the height of the avatar image
     * @param int    $class  the class of the avatar image
     * @param int    $target(optional)  the target of the link
     * @return       $code
     */
	function generateAvatar( $user_id, $avatar=null, $k=null, $width=null, $height=null, $class=null, $target="_top" ) {
		global $Itemid, $database, $mosConfig_absolute_path, $rows_avatars;
		$c = hwd_vs_Config::get_instance();
  		$db =& JFactory::getDBO();

		if ($user_id == 0)
			return;

		$code = null;
		if ($c->cbavatar == 1) {
			if ($c->cbint == 3) {

				$juserini = parse_ini_file(JPATH_SITE.DS.'administrator'.DS.'components'.DS.'com_juser'.DS.'config.ini');

				if (file_exists(JPATH_SITE.DS.$juserini['general::avatars_dir'].DS.$avatar.'.jpg')) {

					$avatar_path = JURI::root().DS.$juserini['general::avatars_dir'].DS.$avatar.'.jpg';

				} else {

					return;

				}

				if ($c->cbitemid !== "") { $c->cbitemid = "&Itemid=".$c->cbitemid; }

				$code = "<a href=\"".JRoute::_("index.php?option=com_community&controller=profile".$c->cbitemid."&user_id=".$user_id)."\"><img src=\"".$avatar_path."\" width=\"".$c->avatarwidth."\" border=\"0\" alt=\""._HWDVIDS_ALT_USRPRO."\" class=\"thumb".$k."\" /></a><br />";

			} else if ($c->cbint == 2) {
				if (isset($avatar)) {
					$avatar_path = JURI::root().$avatar;
				} else {
					$avatar_path = JURI::root()."/components/com_community/assets/default.jpg";
				}

				if ($c->cbitemid !== "") { $c->cbitemid = "&Itemid=".$c->cbitemid; }
				$code = "<a href=\"".JRoute::_("index.php?option=com_community".$c->cbitemid."&view=profile&userid=".$user_id)."\"><img src=\"".$avatar_path."\" width=\"".$c->avatarwidth."\" border=\"0\" alt=\""._HWDVIDS_ALT_USRPRO."\" class=\"thumb".$k."\" /></a><br />";
			} else if ($c->cbint == 1) {
				if (isset($avatar)) {
					$atype = strpos($avatar, "gallery/");
					if ($atype === false) {
				        $avatar_path = JURI::root()."images/comprofiler/tn".$avatar;
					} else {
				        $avatar_path = JURI::root()."images/comprofiler/".$avatar;
				    }
				} else {
					if (@file_exists(JPATH_SITE."/components/com_comprofiler/plugin/language/default_language/images/tnnophoto.jpg")) {
						$avatar_path = JURI::root()."/components/com_comprofiler/plugin/language/default_language/images/tnnophoto.jpg";
					} else {
						$avatar_path = JURI::root()."/components/com_comprofiler/plugin/templates/default/images/avatar/nophoto_n.png";
					}
				}

				if ($c->cbitemid !== "") { $c->cbitemid = "&Itemid=".$c->cbitemid; }
				$code = "<a href=\"".JRoute::_("index.php?option=com_comprofiler".$c->cbitemid."&task=userProfile&user=".$user_id)."\"><img src=\"".$avatar_path."\" width=\"".$c->avatarwidth."\" border=\"0\" alt=\""._HWDVIDS_ALT_USRPRO."\" class=\"thumb".$k."\" /></a><br />";
			} else if ($c->cbint == 4) {
				if (file_exists(JPATH_SITE.DS.'images'.DS.'fbfiles'.DS.'avatars'.DS.'s_'.$user_id.'.jpg')) {

					$avatar_path = JURI::root().'/images/fbfiles/avatars/s_'.$user_id.'.jpg';

				} else {

					$avatar_path = JURI::root().'/images/fbfiles/avatars/s_nophoto.jpg';

				}

				if ($c->cbitemid !== "") { $c->cbitemid = "&Itemid=".$c->cbitemid; }
				$code = "<a href=\"".JRoute::_("index.php?option=com_kunena&func=fbprofile&Itemid=".$c->cbitemid."&userid=".$user_id)."\"><img src=\"".$avatar_path."\" width=\"".$c->avatarwidth."\" border=\"0\" alt=\""._HWDVIDS_ALT_USRPRO."\" class=\"thumb".$k."\" /></a><br />";
			}
		}
		return $code;
    }
    /**
     * Generates a link to group using $group_id, and generates the
     * group name if necessary
     *
     * @param int    $group_id  the category id
     * @param string $group(optional)  the name of the category
     * @return       $code
     */
	function generateGroupLink( $group_id, $group=null ) {
		global $Itemid, $database, $mosConfig_absolute_path;
		$c = hwd_vs_Config::get_instance();

		$code = null;
		$code.= "<a href=\"".JRoute::_("index.php?option=com_hwdvideoshare&task=viewgroup&Itemid=".$Itemid."&group_id=".$group_id)."\">";
		if (isset($group)) {
			$code.= hwd_vs_tools::truncateText($group, $c->truntitle);
		} else {
			$code.= hwd_vs_tools::generateCategory( $cat_id );
		}
		$code.= "</a>";
		return $code;
    }
    /**
     * Generates the array of information for a standard video list from sql queries
     *
     * @param array  $rows  the list from a standard sql queries
     * @param string $thumbclass(optional)  the class for the thumbnail images
     * @return       $code  the array prepared for Smarty template
     */
    function generateTagListString( $tags, $layout_type=0, $link_type=0 ) {

		global $Itemid;
		$code = null;
		$tags0 = explode(" ", stripslashes($tags));

		$m=count($tags0);
		if ($m > 0) {
			for ($j=0, $m; $j < $m; $j++) {
				$tag0 = $tags0[$j];

				$tag0 = stripslashes($tag0);
				$tags1 = explode(",", $tag0);

				$o=count($tags1);
				if ($o > 0) {
					for ($k=0, $o; $k < $o; $k++) {
						$tag1 = $tags1[$k];

						$tag1 = str_replace(",", "", $tag1);
						$tag1 = str_replace(" ", "", $tag1);
						$tag1 = trim($tag1);

						if ($tag1 != "") {

							$code.= "<a href=\"".JRoute::_("index.php?option=com_hwdvideoshare&task=search&Itemid=".$Itemid."&pattern=".$tag1."&category_id=0")."\">".$tag1."</a>, ";

						}
					}
				} else {
					continue;
				}
			}
		} else {
			continue;
		}
		if (substr($code, -2) == ", ") {$code = substr($code, 0, -2);}

		return $code;
    }
    /**
     * Generates the Add/Remove favourite video button
     *
     * @param array  $row  the video sql data
     * @return       $code
     */
	function generateFavouriteButton($row) {
		global $database, $Itemid, $smartyvs, $my;
		$c = hwd_vs_Config::get_instance();
		$db = & JFactory::getDBO();
		$my = & JFactory::getUser();

		// setup ajax tags
		if ($c->ajaxfavmeth == 1) {
			$ajaxremfav = "onsubmit=\"ajaxFunctionRFF();return false;\"";
			$ajaxaddfav = "onsubmit=\"ajaxFunctionATF();return false;\"";
		} else {
			$ajaxremfav = null;
			$ajaxaddfav = null;
		}

		$code = null;

		$userid = $my->id;
		$videoid = $row->id;

		$where = ' WHERE a.userid = '.$userid;
		$where .= ' AND a.videoid = '.$videoid;

		$db->SetQuery( 'SELECT count(*)'
					. ' FROM #__hwdvidsfavorites AS a'
					. $where
					);
		$total = $db->loadResult();

		if ($my->id) {
			$remfav = "<form name=\"favourite1\" onsubmit=\"ajaxFunctionRFF();return false;\" action=\"".JRoute::_("index.php?option=com_hwdvideoshare&Itemid=".$Itemid."&task=removefavourite")."\" method=\"post\"><input type=\"image\" src=\"".URL_HWDVS_IMAGES."icons/rff.png\" alt=\""._HWDVIDS_DETAILS_REMFAV."\" />&nbsp;<input type=\"submit\" value=\""._HWDVIDS_DETAILS_REMFAV."\" class=\"interactbutton\" /></form>";
			$addfav = "<form name=\"favourite2\" onsubmit=\"ajaxFunctionATF();return false;\" action=\"".JRoute::_("index.php?option=com_hwdvideoshare&Itemid=".$Itemid."&task=addfavourite")."\" method=\"post\"><input type=\"image\" src=\"".URL_HWDVS_IMAGES."icons/atf.png\" alt=\""._HWDVIDS_DETAILS_ADDFAV."\" />&nbsp;<input type=\"submit\" value=\""._HWDVIDS_DETAILS_ADDFAV."\" class=\"interactbutton\" /></form>";
		} else {
			$remfav = "<form name=\"favourite2\" onsubmit=\"ajaxFunctionATF();return false;\" action=\"".JRoute::_("index.php?option=com_hwdvideoshare&Itemid=".$Itemid."&task=addfavourite")."\" method=\"post\"><input type=\"image\" src=\"".URL_HWDVS_IMAGES."icons/atf.png\" alt=\""._HWDVIDS_DETAILS_ADDFAV."\" />&nbsp;<input type=\"submit\" value=\""._HWDVIDS_DETAILS_ADDFAV."\" class=\"interactbutton\" /></form>";
			$addfav = "<form name=\"favourite2\" onsubmit=\"ajaxFunctionATF();return false;\" action=\"".JRoute::_("index.php?option=com_hwdvideoshare&Itemid=".$Itemid."&task=addfavourite")."\" method=\"post\"><input type=\"image\" src=\"".URL_HWDVS_IMAGES."icons/atf.png\" alt=\""._HWDVIDS_DETAILS_ADDFAV."\" />&nbsp;<input type=\"submit\" value=\""._HWDVIDS_DETAILS_ADDFAV."\" class=\"interactbutton\" /></form>";
		}
		hwd_vs_javascript::ajaxaddtofav($row, $remfav, $addfav);

		if ( $total>0 ) {
		    $code.= "<form name=\"favourite1\" ".$ajaxremfav." action=\"".JRoute::_("index.php?option=com_hwdvideoshare&Itemid=".$Itemid."&task=removefavourite")."\" method=\"post\">
					 <input type=\"hidden\" name=\"userid\" value=\"".$my->id."\" />
					 <input type=\"hidden\" name=\"videoid\" value=\"".$row->id."\" />
					 <input type=\"image\" src=\"".URL_HWDVS_IMAGES."icons/rff.png\" alt=\""._HWDVIDS_DETAILS_REMFAV."\" />
					 <input type=\"submit\" value=\""._HWDVIDS_DETAILS_REMFAV."\" class=\"interactbutton\" />
					 </form>";
		} else {
		    $code.= "<form name=\"favourite2\" ".$ajaxaddfav." action=\"".JRoute::_("index.php?option=com_hwdvideoshare&Itemid=".$Itemid."&task=addfavourite")."\" method=\"post\">
					 <input type=\"hidden\" name=\"userid\" value=\"".$my->id."\" />
					 <input type=\"hidden\" name=\"videoid\" value=\"".$row->id."\" />
					 <input type=\"image\" src=\"".URL_HWDVS_IMAGES."icons/atf.png\" alt=\""._HWDVIDS_DETAILS_ADDFAV."\" />
					 <input type=\"submit\" value=\""._HWDVIDS_DETAILS_ADDFAV."\" class=\"interactbutton\" />
					 </form>";
		}
		return $code;
    }
    /**
     * Generates the video Report Media button
     *
     * @param array  $row  the video sql data
     * @return       $code
     */
	function generateReportMediaButton($row) {
		global $Itemid, $smartyvs;
		$c = hwd_vs_Config::get_instance();
		$db = & JFactory::getDBO();
		$my = & JFactory::getUser();

		// setup ajax tags
		if ($c->ajaxrepmeth == 1) { $ajaxrep = "onsubmit=\"ajaxFunctionRV();return false;\""; } else { $ajaxrep = null; }

		$code = null;

		$code.= "<form name=\"share\" ".$ajaxrep." action=\"".JRoute::_("index.php?option=com_hwdvideoshare&Itemid=".$Itemid."&task=reportvideo")."\" method=\"post\">
				 <input type=\"hidden\" name=\"userid\" value=\"".$my->id."\" />
				 <input type=\"hidden\" name=\"videoid\" value=\"".$row->id."\" />
				 <input type=\"image\" src=\"".URL_HWDVS_IMAGES."icons/flag.png\" alt=\""._HWDVIDS_DETAILS_FLAGVID."\" id=\"reportvidbutton\" />
				 <input type=\"submit\" value=\""._HWDVIDS_DETAILS_FLAG."\" class=\"interactbutton\" />
				 </form>";

		return $code;
    }
    /**
     * Generates the video Rating System
     *
     * @param array  $row  the video sql data
     * @return       $code
     */
	function generateRatingSystem($row) {
		global $database, $mainframe, $Itemid, $smartyvs, $my;
		$c = hwd_vs_Config::get_instance();
		require_once(JPATH_SITE.DS.'administrator'.DS.'components'.DS.'com_hwdvideoshare'.DS.'helpers'.DS.'js.php');

		$code = null;

		if ( $row->allow_ratings == 1 ) {

			if ($row->rating_number_votes < 1) {
				$count = 0;
			} else {
				$count = $row->rating_number_votes; //how many votes total
			}
			$tense = ($count==1) ? _HWDVIDS_INFO_M_VOTE : _HWDVIDS_INFO_M_VOTES; //plural form votes/vote

			$rating0 = @number_format($row->rating_total_points/$count,0);
			$rating1 = @number_format($row->rating_total_points/$count,1);

			$code='<div id="hwdvsrb"><ul id="1001" class="rating rated'.$rating0.'star">
			  <li id="1" class="rate one"><a href="'.JURI::root( true ).'/index.php?option=com_hwdvideoshare&task=rate&videoid='.$row->id.'&rating=1" onclick="ajaxFunctionRate(1);return false;" title="1 Star">1</a></li>
			  <li id="2" class="rate two"><a href="'.JURI::root( true ).'/index.php?option=com_hwdvideoshare&task=rate&videoid='.$row->id.'&rating=2" onclick="ajaxFunctionRate(2);return false;" title="2 Stars">2</a></li>
			  <li id="3" class="rate three"><a href="'.JURI::root( true ).'/index.php?option=com_hwdvideoshare&task=rate&videoid='.$row->id.'&rating=3" onclick="ajaxFunctionRate(3);return false;" title="3 Stars">3</a></li>
			  <li id="4" class="rate four"><a href="'.JURI::root( true ).'/index.php?option=com_hwdvideoshare&task=rate&videoid='.$row->id.'&rating=4" onclick="ajaxFunctionRate(4);return false;" title="4 Stars">4</a></li>
			  <li id="5" class="rate five"><a href="'.JURI::root( true ).'/index.php?option=com_hwdvideoshare&task=rate&videoid='.$row->id.'&rating=5" onclick="ajaxFunctionRate(5);return false;" title="5 Stars">5</a></li>
			</ul>
			<div>'._HWDVIDS_INFO_RATED.'<strong> '.$rating1.'</strong> ('.$count.' '.$tense.')</div>
			<!--<script>
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
						}
					});

				});
			});
			</script>-->
			</div>';

		}

		return $code;

    }
    /**
     * Generates the social bookmark links
     *
     * @return       $code
     */
    function generateSocialBookmarks()
	{
	global $mainframe;
	$c = hwd_vs_Config::get_instance();

		$code = null;
		if ($c->showscbm == "1") {

			$sbtitle = rawurlencode($mainframe->getPageTitle());
			$sburl = rawurlencode(hwd_vs_tools::getSelfURL());
			$jrandom = rand(1000, 9999);
			$bmhtml = null;

				//digg
				if ($c->sb_digg == "on") {
				$temphtml = '<a rel="nofollow" href="http://digg.com/submit?phase=2&url='. $sburl .'&title='. $sbtitle .'" title="Digg!" target="_blank"><img height="18" width="18" src="'.URL_HWDVS_IMAGES.'socialbookmarker/digg.png" alt="Digg!" title="Digg!" class="sblinks" /></a>';
				$bmhtml = $bmhtml . $temphtml .' ';
				}
				//reddit
				if ($c->sb_reddit == "on") {
				$temphtml = '<a rel="nofollow" href="http://reddit.com/submit?url='. $sburl .'&title='. $sbtitle .'" title="Reddit!" target="_blank"><img height="18" width="18" src="'.URL_HWDVS_IMAGES.'socialbookmarker/reddit.png" alt="Reddit!" title="Reddit!" class="sblinks" /></a>';
				$bmhtml = $bmhtml . $temphtml .' ';
				}
				//delicious
				if ($c->sb_delicious == "on") {
				$temphtml = '<a rel="nofollow" href="http://del.icio.us/post?url='. $sburl .'&title='. $sbtitle .'" title="Del.icio.us!" target="_blank"><img height="18" width="18" src="'.URL_HWDVS_IMAGES.'socialbookmarker/delicious.png" alt="Del.icio.us!" title="Del.icio.us!" class="sblinks" /></a>';
				$bmhtml = $bmhtml . $temphtml .' ';
				}
				//google
				if ($c->sb_google == "on") {
				$temphtml = '<a rel="nofollow" href="http://www.google.com/bookmarks/mark?op=add&bkmk='. $sburl .'&title='. $sbtitle .'" title="Google!" target="_blank"><img height="18" width="18" src="'.URL_HWDVS_IMAGES.'socialbookmarker/google.png" alt="Google!" title="Google!" class="sblinks" /></a>';
				$bmhtml = $bmhtml . $temphtml .' ';
				}
				//live
				if ($c->sb_live == "on") {
				$temphtml = '<a rel="nofollow" href="https://favorites.live.com/quickadd.aspx?marklet=1&mkt=en-us&top=0&url='. $sburl .'&title='. $sbtitle .'" title="Live!" target="_blank"><img height="18" width="18" src="'.URL_HWDVS_IMAGES.'socialbookmarker/live.png" alt="Live!" title="Live!" class="sblinks" /></a>';
				$bmhtml = $bmhtml . $temphtml .' ';
				}
				//facebook
				if ($c->sb_facebook == "on") {
				$temphtml = '<a rel="nofollow" href="http://www.facebook.com/share.php?u='. $sburl .'&t='. $sbtitle .'" title="Facebook!" target="_blank"><img height="18" width="18" src="'.URL_HWDVS_IMAGES.'socialbookmarker/facebook.png" alt="Facebook!" title="Facebook!" class="sblinks" /></a>';
				$bmhtml = $bmhtml . $temphtml .' ';
				}
				//slashdot
				if ($c->sb_slashdot == "on") {
				$temphtml = '<a rel="nofollow" href="http://slashdot.org/bookmark.pl?url='. $sburl .'&title='. $sbtitle .'" title="Slashdot!" target="_blank"><img height="18" width="18" src="'.URL_HWDVS_IMAGES.'socialbookmarker/slashdot.png" alt="Slashdot!" title="Slashdot!" class="sblinks" /></a>';
				$bmhtml = $bmhtml . $temphtml .' ';
				}
				//netscape
				if ($c->sb_netscape == "on") {
				$temphtml = '<a rel="nofollow" href="http://www.netscape.com/submit/?U='. $sburl .'&T='. $sbtitle .'" title="Netscape!" target="_blank"><img height="18" width="18" src="'.URL_HWDVS_IMAGES.'socialbookmarker/netscape.png" alt="Netscape!" title="Netscape!" class="sblinks" /></a>';
				$bmhtml = $bmhtml . $temphtml .' ';
				}
				//technorati
				if ($c->sb_technorati == "on") {
				$temphtml = '<a rel="nofollow" href="http://technorati.com/faves/?add='. $sburl .'" title="Technorati!" target="_blank"><img src="'.URL_HWDVS_IMAGES.'socialbookmarker/technorati.png" alt="Technorati!" title="Technorati!" class="sblinks" /></a>';
				$bmhtml = $bmhtml . $temphtml .' ';
				}
				//stumbleupon
				if ($c->sb_stumbleupon == "on") {
				$temphtml = '<a rel="nofollow" href="http://www.stumbleupon.com/submit?url='. $sburl .'&title='. $sbtitle .'" title="StumbleUpon!" target="_blank"><img src="'.URL_HWDVS_IMAGES.'socialbookmarker/stumbleupon.png" alt="StumbleUpon!" title="StumbleUpon!" class="sblinks" /></a>';
				$bmhtml = $bmhtml . $temphtml .' ';
				}
				//spurl
				if ($c->sb_spurl == "on") {
				$temphtml = '<a rel="nofollow" href="http://www.spurl.net/spurl.php?url='. $sburl .'&title='. $sbtitle .'" title="Spurl!" target="_blank"><img src="'.URL_HWDVS_IMAGES.'socialbookmarker/spurl.png" alt="Spurl!" title="Spurl!" class="sblinks" /></a>';
				$bmhtml = $bmhtml . $temphtml .' ';
				}
				//wists
				if ($c->sb_wists == "on") {
				$temphtml = '<a rel="nofollow" href="http://wists.com/r.php?r='. $sburl .'&title='. $sbtitle .'" title="Wists!" target="_blank"><img src="'.URL_HWDVS_IMAGES.'socialbookmarker/wists.png" alt="Wists!" title="Wists!" class="sblinks" /></a>';
				$bmhtml = $bmhtml . $temphtml .' ';
				}
				//simpy
				if ($c->sb_simpy == "on") {
				$temphtml = '<a rel="nofollow" href="http://www.simpy.com/simpy/LinkAdd.do?href='. $sburl .'&title='. $sbtitle .'" title="Simpy!" target="_blank"><img src="'.URL_HWDVS_IMAGES.'socialbookmarker/simpy.png" alt="Simpy!" title="Simpy!" class="sblinks" /></a>';
				$bmhtml = $bmhtml . $temphtml .' ';
				}
				//newsvine
				if ($c->sb_newsvine == "on") {
				$temphtml = '<a rel="nofollow" href="http://www.newsvine.com/_tools/seed&save?u='. $sburl .'&h='. $sbtitle .'" title="Newsvine!" target="_blank"><img src="'.URL_HWDVS_IMAGES.'socialbookmarker/newsvine.png" alt="Newsvine!" title="Newsvine!" class="sblinks" /></a>';
				$bmhtml = $bmhtml . $temphtml .' ';
				}
				//blinklist
				if ($c->sb_blinklist == "on") {
				$temphtml = '<a rel="nofollow" href="http://www.blinklist.com/index.php?Action=Blink/addblink.php&Url='. $sburl .'&Title='. $sbtitle .'" title="Blinklist!" target="_blank"><img src="'.URL_HWDVS_IMAGES.'socialbookmarker/blinklist.png" alt="Blinklist!" title="Blinklist!" class="sblinks" /></a>';
				$bmhtml = $bmhtml . $temphtml .' ';
				}
				//furl
				if ($c->sb_furl == "on") {
				$temphtml = '<a rel="nofollow" href="http://www.furl.net/storeIt.jsp?u='. $sburl .'&t='. $sbtitle .'" title="Furl!" target="_blank"><img src="'.URL_HWDVS_IMAGES.'socialbookmarker/furl.png" alt="Furl!" title="Furl!" class="sblinks" /></a>';
				$bmhtml = $bmhtml . $temphtml .' ';
				}
				//fark
				if ($c->sb_fark == "on") {
				$temphtml = '<a rel="nofollow" href="http://cgi.fark.com/cgi/fark/submit.pl?new_url='. $sburl .'" title="Fark!" target="_blank"><img src="'.URL_HWDVS_IMAGES.'socialbookmarker/fark.png" alt="Fark!" title="Fark!" class="sblinks" /></a>';
				$bmhtml = $bmhtml . $temphtml .' ';
				}
				//blogmarks
				if ($c->sb_blogmarks == "on") {
				$temphtml = '<a rel="nofollow" href="http://blogmarks.net/my/new.php?mini=1&simple=1&url='. $sburl .'&title='. $sbtitle .'" title="Blogmarks!" target="_blank"><img src="'.URL_HWDVS_IMAGES.'socialbookmarker/blogmarks.png" alt="Blogmarks!" title="Blogmarks!" class="sblinks" /></a>';
				$bmhtml = $bmhtml . $temphtml .' ';
				}
				//yahoo
				if ($c->sb_yahoo == "on") {
				$temphtml = '<a rel="nofollow" href="http://myweb2.search.yahoo.com/myresults/bookmarklet?u='. $sburl .'&t='. $sbtitle .'" title="Yahoo!" target="_blank"><img src="'.URL_HWDVS_IMAGES.'socialbookmarker/yahoo.png" alt="Yahoo!" title="Yahoo!" class="sblinks" /></a>';
				$bmhtml = $bmhtml . $temphtml .' ';
				}
				//smarking
				if ($c->sb_smarking == "on") {
				$temphtml = '<a rel="nofollow" href="http://smarking.com/editbookmark/?url='. $sburl .'" title="Smarking!" target="_blank"><img src="'.URL_HWDVS_IMAGES.'socialbookmarker/smarking.png" alt="Smarking!" title="Smarking!" class="sblinks" /></a>';
				$bmhtml = $bmhtml . $temphtml .' ';
				}
				//netvouz
				if ($c->sb_netvouz == "on") {
				$temphtml = '<a rel="nofollow" href="http://www.netvouz.com/action/submitBookmark?url='. $sburl .'&title='. $sbtitle .'" title="Smarking!" target="_blank"><img src="'.URL_HWDVS_IMAGES.'socialbookmarker/netvouz.png" alt="Netvouz!" title="Netvouz!" class="sblinks" /></a>';
				$bmhtml = $bmhtml . $temphtml .' ';
				}
				//shadows
				if ($c->sb_shadows == "on") {
				$temphtml = '<a rel="nofollow" href="http://www.shadows.com/bookmark/saveLink.rails?page='. $sburl .'&title='. $sbtitle .'" title="Shadows!" target="_blank"><img src="'.URL_HWDVS_IMAGES.'socialbookmarker/shadows.png" alt="Shadows!" title="Shadows!" class="sblinks" /></a>';
				$bmhtml = $bmhtml . $temphtml .' ';
				}
				//rawsugar
				if ($c->sb_rawsugar == "on") {
				$temphtml = '<a rel="nofollow" href="http://www.rawsugar.com/tagger/?turl='. $sburl .'&title='. $sbtitle .'" title="RawSugar!" target="_blank"><img src="'.URL_HWDVS_IMAGES.'socialbookmarker/rawsugar.png" alt="RawSugar!" title="RawSugar!" class="sblinks" /></a>';
				$bmhtml = $bmhtml . $temphtml .' ';
				}
				//magnolia
				if ($c->sb_magnolia == "on") {
				$temphtml = '<a rel="nofollow" href="http://ma.gnolia.com/beta/bookmarklet/add?url='. $sburl .'&title='. $sbtitle .'" title="Ma.gnolia!" target="_blank"><img src="'.URL_HWDVS_IMAGES.'socialbookmarker/magnolia.png" alt="Ma.gnolia!" title="Ma.gnolia!" class="sblinks" /></a>';
				$bmhtml = $bmhtml . $temphtml .' ';
				}
				//plugim
				if ($c->sb_plugim == "on") {
				$temphtml = '<a rel="nofollow" href="http://www.plugim.com/submit?url='. $sburl .'&title='. $sbtitle .'" title="PlugIM!" target="_blank"><img src="'.URL_HWDVS_IMAGES.'socialbookmarker/plugim.png" alt="PlugIM!" title="PlugIM!" class="sblinks" /></a>';
				$bmhtml = $bmhtml . $temphtml .' ';
				}
				//squidoo
				if ($c->sb_squidoo == "on") {
				$temphtml = '<a rel="nofollow" href="http://www.squidoo.com/lensmaster/bookmark?'. $sburl .'" title="Squidoo!" target="_blank"><img src="'.URL_HWDVS_IMAGES.'socialbookmarker/squidoo.png" alt="Squidoo!" title="Squidoo!" class="sblinks" /></a>';
				$bmhtml = $bmhtml . $temphtml .' ';
				}
				//blogmemes
				if ($c->sb_blogmemes == "on") {
				$temphtml = '<a rel="nofollow" href="http://www.blogmemes.net/post.php?url='. $sburl .'&title='. $sbtitle .'" title="BlogMemes!" target="_blank"><img src="'.URL_HWDVS_IMAGES.'socialbookmarker/blogmemes.png" alt="BlogMemes!" title="BlogMemes!" class="sblinks" /></a>';
				$bmhtml = $bmhtml . $temphtml .' ';
				}
				//feedmelinks
				if ($c->sb_feedmelinks == "on") {
				$temphtml = '<a rel="nofollow" href="http://feedmelinks.com/categorize?from=toolbar&op=submit&url='. $sburl .'&name='. $sbtitle .'" title="FeedMeLinks!" target="_blank"><img src="'.URL_HWDVS_IMAGES.'socialbookmarker/feedmelinks.png" alt="FeedMeLinks!" title="FeedMeLinks!" class="sblinks" /></a>';
				$bmhtml = $bmhtml . $temphtml .' ';
				}
				//blinkbits
				if ($c->sb_blinkbits == "on") {
				$temphtml = '<a rel="nofollow" href="http://www.blinkbits.com/bookmarklets/save.php?v=1&source_url='. $sburl .'&title='. $sbtitle .'" title="BlinkBits!" target="_blank"><img src="'.URL_HWDVS_IMAGES.'socialbookmarker/blinkbits.png" alt="BlinkBits!" title="BlinkBits!" class="sblinks" /></a>';
				$bmhtml = $bmhtml . $temphtml .' ';
				}
				//tailrank
				if ($c->sb_tailrank == "on") {
				$temphtml = '<a rel="nofollow" href="http://tailrank.com/share/?text=&link_href='. $sburl .'&title='. $sbtitle .'" title="Tailrank!" target="_blank"><img src="'.URL_HWDVS_IMAGES.'socialbookmarker/tailrank.png" alt="Tailrank!" title="Tailrank!" class="sblinks" /></a>';
				$bmhtml = $bmhtml . $temphtml .' ';
				}
				//linkagogo
				if ($c->sb_linkagogo == "on") {
				$temphtml = '<a rel="nofollow" href="http://www.linkagogo.com/go/AddNoPopup?url='. $sburl .'&title='. $sbtitle .'" title="linkaGoGo!" target="_blank"><img src="'.URL_HWDVS_IMAGES.'socialbookmarker/linkagogo.png" alt="linkaGoGo!" title="linkaGoGo!" class="sblinks" /></a>';
				$bmhtml = $bmhtml . $temphtml .' ';
				}

			$code = $bmhtml;
		}
		return $code;
	}
    /**
     * Generates the group membership status of a user
     *
     * @param string $row  the group sql data
     * @return       $code
     */
	function generateGroupMembershipStatus( $row ) {
		global $Itemid, $database, $my, $mosConfig_absolute_path;
		$c = hwd_vs_Config::get_instance();
		$db = & JFactory::getDBO();
		$my = & JFactory::getUser();

		$code = null;
		if ( !$my->id ){ return $code; }

		$url = JRoute::_($_SERVER['REQUEST_URI']);

		$db->SetQuery( 'SELECT count(*)'
				. ' FROM #__hwdvidsgroup_membership'
				. ' WHERE groupid = '.$row->id
				. ' AND memberid = '.$my->id
				);
		$total = $db->loadResult();
		echo $db->getErrorMsg();

		if ($total > 0) {
			$code.="<form name=\"leavegroup\" style=\"display: inline;\" action=\"".JRoute::_("index.php?option=com_hwdvideoshare&Itemid=".$Itemid."&task=leavegroup")."\" method=\"post\">";
			$code.="<input type=\"hidden\" name=\"memberid\" value=\"".$my->id."\" />";
			$code.="<input type=\"hidden\" name=\"groupid\" value=\"".$row->id."\" />";
			$code.="<input type=\"hidden\" name=\"url\" value=\"".$url."\" />";
			$code.="<input type=\"image\" src=\"".URL_HWDVS_IMAGES."icons/group_delete.png\" alt=\""._HWDVIDS_DETAILS_LEAVEG."\">&nbsp;";
			$code.="<input type=\"submit\" value=\""._HWDVIDS_DETAILS_LEAVEG."\" class=\"interactbutton\">";
			$code.="</form>";
		} else {
			$code.="<form name=\"joingroup\" style=\"display: inline;\" action=\"".JRoute::_("index.php?option=com_hwdvideoshare&Itemid=".$Itemid."&task=joingroup")."\" method=\"post\">";
			$code.="<input type=\"hidden\" name=\"memberid\" value=\"".$my->id."\" />";
			$code.="<input type=\"hidden\" name=\"groupid\" value=\"".$row->id."\" />";
			$code.="<input type=\"hidden\" name=\"url\" value=\"".$url."\" />";
			$code.="<input type=\"image\" src=\"".URL_HWDVS_IMAGES."icons/group_add.png\" alt=\""._HWDVIDS_DETAILS_JOING."\">&nbsp;";
			$code.="<input type=\"submit\" value=\""._HWDVIDS_DETAILS_JOING."\" class=\"interactbutton\">";
			$code.="</form>";
		}
		return $code;
    }
    /**
     * Generates the delete group button
     *
     * @param string $row  the group sql data
     * @return       $code
     */
	function generateDeleteGroupButton( $row ) {
		global $Itemid, $database, $mainframe, $my, $mosConfig_absolute_path;
		$c = hwd_vs_Config::get_instance();
		$my = & JFactory::getUser();

		$code = null;
		$url = JRoute::_($_SERVER['REQUEST_URI']);
		if ( $my->id == $row->adminid ){
			$mainframe->addCustomHeadTag(hwd_vs_javascript::confirmDelete());
			$code.="<form name=\"deletegroup\" style=\"display: inline;\" action=\"".JRoute::_("index.php?option=com_hwdvideoshare&Itemid=".$Itemid."&task=deletegroup")."\" method=\"post\">";
			$code.="<input type=\"hidden\" name=\"userid\" value=\"".$my->id."\" />";
			$code.="<input type=\"hidden\" name=\"groupid\" value=\"".$row->id."\" />";
			$code.="<input type=\"hidden\" name=\"url\" value=\"".$url."\" />";
			$code.="<input type=\"image\" src=\"".URL_HWDVS_IMAGES."icons/delete.png\" alt=\""._HWDVIDS_DETAILS_DELETEG."\" onClick=\"return confirmDelete()\">";
			$code.="<input type=\"submit\" value=\""._HWDVIDS_DETAILS_DELETEG."\" class=\"interactbutton\" onClick=\"return confirmDelete()\">";
			$code.="</form>";
		}
		return $code;
    }
    /**
     * Generates the delete group link
     *
     * @param string $row  the group sql data
     * @return       $code
     */
	function generateDeleteGroupLink( $row ) {
		global $Itemid, $database, $my, $mainframe, $mosConfig_absolute_path;
		$c = hwd_vs_Config::get_instance();
		$my = & JFactory::getUser();

		$code = null;
		$url = JRoute::_($_SERVER['REQUEST_URI']);
		if ( $my->id == $row->adminid ){
			$mainframe->addCustomHeadTag(hwd_vs_javascript::confirmDelete());
			$code.="<form name=\"deletegroup\" style=\"display: inline;\" action=\"".JRoute::_("index.php?option=com_hwdvideoshare&Itemid=".$Itemid."&task=deletegroup")."\" method=\"post\">";
			$code.="<input type=\"hidden\" name=\"userid\" value=\"".$my->id."\" />";
			$code.="<input type=\"hidden\" name=\"groupid\" value=\"".$row->id."\" />";
			$code.="<input type=\"hidden\" name=\"url\" value=\"".$url."\" />";
			$code.="<input type=\"image\" src=\"".URL_HWDVS_IMAGES."icons/delete.png\" alt=\""._HWDVIDS_DETAILS_DELETEG."\"  onClick=\"return confirmDelete()\">";
			$code.="</form>";
		}
		return $code;
    }
    /**
     * Generates the edit group button
     *
     * @param string $row  the group sql data
     * @return       $code
     */
	function generateEditGroupButton( $row ) {
		global $Itemid, $database, $my, $mainframe, $mosConfig_absolute_path;
		$c = hwd_vs_Config::get_instance();
		$my = & JFactory::getUser();

		$code = null;
		$url = JRoute::_($_SERVER['REQUEST_URI']);
		if ( $my->id == $row->adminid ){
			$mainframe->addCustomHeadTag(hwd_vs_javascript::confirmEdit());
			$code.="<form name=\"editgroup\" style=\"display: inline;\" action=\"".JRoute::_("index.php?option=com_hwdvideoshare&Itemid=".$Itemid."&task=editgroup")."\" method=\"post\">";
			$code.="<input type=\"hidden\" name=\"userid\" value=\"".$my->id."\" />";
			$code.="<input type=\"hidden\" name=\"groupid\" value=\"".$row->id."\" />";
			$code.="<input type=\"hidden\" name=\"url\" value=\"".$url."\" />";
			$code.="<input type=\"image\" src=\"".URL_HWDVS_IMAGES."icons/edit.png\" alt=\""._HWDVIDS_DETAILS_EDITG."\"  onClick=\"return confirmEdit()\">";
			$code.="<input type=\"submit\" value=\""._HWDVIDS_DETAILS_EDITG."\" class=\"interactbutton\"  onClick=\"return confirmEdit()\">";
			$code.="</form>";
		}
		return $code;
    }
    /**
     * Generates the edit group link
     *
     * @param string $row  the group sql data
     * @return       $code
     */
	function generateEditGroupLink( $row ) {
		global $Itemid, $database, $my, $mainframe, $mosConfig_absolute_path;
		$c = hwd_vs_Config::get_instance();
		$my = & JFactory::getUser();

		$code = null;
		$url = JRoute::_($_SERVER['REQUEST_URI']);
		if ( $my->id == $row->adminid ){
			$mainframe->addCustomHeadTag(hwd_vs_javascript::confirmEdit());
			$code.="<form name=\"editgroup\" style=\"display: inline;\" action=\"".JRoute::_("index.php?option=com_hwdvideoshare&Itemid=".$Itemid."&task=editgroup")."\" method=\"post\">";
			$code.="<input type=\"hidden\" name=\"userid\" value=\"".$my->id."\" />";
			$code.="<input type=\"hidden\" name=\"groupid\" value=\"".$row->id."\" />";
			$code.="<input type=\"hidden\" name=\"url\" value=\"".$url."\" />";
			$code.="<input type=\"image\" src=\"".URL_HWDVS_IMAGES."icons/edit.png\" alt=\""._HWDVIDS_DETAILS_EDITG."\"  onClick=\"return confirmEdit()\">";
			$code.="</form>";
		}
		return $code;
    }
    /**
     * Generates the delete video button
     *
     * @param string $row  the video sql data
     * @return       $code
     */
	function generateDeleteVideoLink( $row ) {
		global $Itemid, $database, $my, $mainframe;
		$c = hwd_vs_Config::get_instance();
		$my = & JFactory::getUser();
		require_once(JPATH_SITE.DS.'administrator'.DS.'components'.DS.'com_hwdvideoshare'.DS.'helpers'.DS.'js.php');

		$code = null;
		$url = JRoute::_($_SERVER['REQUEST_URI']);

		// check component access settings and deny those without privileges
		if ($c->access_method == 0) {
			if (!hwd_vs_access::allowAccess( $c->gtree_mdrt, $c->gtree_mdrt_child, hwd_vs_access::userGID( $my->id ))) {
				if ($my->id == $row->user_id) {
					if ($my->id == "0") {
						return $code;
					}
					if ($c->allowviddel == "0") {
						return $code;
					}
					// continue
				} else {
					return $code;
				}
			}
		}

		if (!defined( '_HWD_VS_JSDELETE' )) {
			define( '_HWD_VS_JSDELETE', 1 );
			$mainframe->addCustomHeadTag(hwd_vs_javascript::confirmDelete());
		}

		$code.="<form name=\"deletevideo\" style=\"display: inline;\" action=\"".JRoute::_("index.php?option=com_hwdvideoshare&Itemid=".$Itemid."&task=deletevideo&video_id=".$row->id)."\" method=\"post\">";
		$code.="<input type=\"hidden\" name=\"userid\" value=\"".$my->id."\" />";
		$code.="<input type=\"hidden\" name=\"videoid\" value=\"".$row->id."\" />";
		$code.="<input type=\"hidden\" name=\"url\" value=\"".$url."\" />";
		$code.="<input type=\"image\" src=\"".URL_HWDVS_IMAGES."icons/delete.png\" alt=\""._HWDVIDS_DETAILS_DELETEVID."\" onClick=\"return confirmDelete()\">";
		$code.="</form>";

		return $code;
    }
    /**
     * Generates the delete video button
     *
     * @param string $row  the video sql data
     * @return       $code
     */
	function generateBreadcrumbs($crumbs=null) {

		global $mainframe;
		jimport( 'joomla.application.pathway' );

		$breadcrumbs = &$mainframe->getPathWay();

		for ($i=0, $n=count($crumbs); $i < $n; $i++) {
			$breadcrumbs->addItem($crumbs[$i][0], $crumbs[$i][1]);
		}

		return;
    }
    /**
     * Generates the delete video button
     *
     * @param string $row  the video sql data
     * @return       $code
     */
	function generatePublishVideoLink( $row ) {
		global $Itemid, $database, $my, $mainframe;
		$c = hwd_vs_Config::get_instance();
		$my = & JFactory::getUser();
		require_once(JPATH_SITE.DS.'administrator'.DS.'components'.DS.'com_hwdvideoshare'.DS.'helpers'.DS.'js.php');

		$code = null;
		$url = JRoute::_($_SERVER['REQUEST_URI']);

		// check component access settings and deny those without privileges
		if ($c->access_method == 0) {
			if (!hwd_vs_access::allowAccess( $c->gtree_mdrt, $c->gtree_mdrt_child, hwd_vs_access::userGID( $my->id ))) {
				return $code;
			}
		}

		$publish_task = $row->published ? '0' : '1';
		$publish_text = $row->published ? 'Unpublish' : 'Publish';
		$publish_img = $row->published ? 'unpublish.png' : 'publish.png';

		$code.="<form name=\"publishvideo\" style=\"display: inline;\" action=\"".JRoute::_("index.php?option=com_hwdvideoshare&Itemid=".$Itemid."&task=publishvideo&video_id=".$row->id."&publish=".$publish_task)."\" method=\"post\">";
		$code.="<input type=\"hidden\" name=\"userid\" value=\"".$my->id."\" />";
		$code.="<input type=\"hidden\" name=\"videoid\" value=\"".$row->id."\" />";
		$code.="<input type=\"hidden\" name=\"url\" value=\"".$url."\" />";
		$code.="<input type=\"image\" src=\"".URL_HWDVS_IMAGES."icons/".$publish_img."\" alt=\"".$publish_text."\">";
		$code.="</form>";

		return $code;
    }
    /**
     * Generates the delete video link
     *
     * @param string $row  the video sql data
     * @return       $code
     */
	function generateEditVideoLink( $row ) {
		global $Itemid, $database, $my, $mainframe;
		$c = hwd_vs_Config::get_instance();
		$my = & JFactory::getUser();

		$code = null;
		$url = JRoute::_($_SERVER['REQUEST_URI']);

		// check component access settings and deny those without privileges
		if ($c->access_method == 0) {
			if (!hwd_vs_access::allowAccess( $c->gtree_mdrt, $c->gtree_mdrt_child, hwd_vs_access::userGID( $my->id ))) {
				if ($my->id == $row->user_id) {
					if ($my->id == "0") {
						return $code;
					}
					if ($c->allowvidedit == "0") {
						return $code;
					}
					// continue
				} else {
					return $code;
				}
			}
		}

		if (!defined( '_HWD_VS_JSEDIT' )) {
			define( '_HWD_VS_JSEDIT', 1 );
			//$mainframe->addCustomHeadTag(hwd_vs_javascript::confirmEdit());
		}

		$code.="<form name=\"editvideo\" style=\"display: inline;\" action=\"".JRoute::_("index.php?option=com_hwdvideoshare&Itemid=".$Itemid."&task=editvideo")."\" method=\"post\">";
		$code.="<input type=\"hidden\" name=\"user_id\" value=\"".$my->id."\" />";
		$code.="<input type=\"hidden\" name=\"video_id\" value=\"".$row->id."\" />";
		$code.="<input type=\"hidden\" name=\"url\" value=\"".$url."\" />";
		$code.="<input type=\"image\" src=\"".URL_HWDVS_IMAGES."icons/edit.png\" alt=\""._HWDVIDS_DETAILS_EDITVID."\" onClick=\"return confirmEdit()\">";
		$code.="</form>";

		return $code;
    }
    /**
     * Generates the report group button
     *
     * @param string $row  the group sql data
     * @return       $code
     */
	function generateReportGroupButton( $row ) {
		global $Itemid, $mosConfig_absolute_path;
		$c = hwd_vs_Config::get_instance();
		$db = & JFactory::getDBO();
		$my = & JFactory::getUser();

		$code = null;
		if ( !$my->id ){ return $code; }

		$url = JRoute::_($_SERVER['REQUEST_URI']);

			$code.="<form name=\"reportgroup\" style=\"display: inline;\" action=\"".JRoute::_("index.php?option=com_hwdvideoshare&Itemid=".$Itemid."&task=reportgroup")."\" method=\"post\">";
			$code.="<input type=\"hidden\" name=\"userid\" value=\"".$my->id."\" />";
			$code.="<input type=\"hidden\" name=\"groupid\" value=\"".$row->id."\" />";
			$code.="<input type=\"hidden\" name=\"url\" value=\"".$url."\" />";
			$code.="<input type=\"image\" src=\"".URL_HWDVS_IMAGES."icons/flag.png\" alt=\""._HWDVIDS_DETAILS_REPORTG."\">&nbsp;";
			$code.="<input type=\"submit\" value=\""._HWDVIDS_DETAILS_REPORTG."\" class=\"interactbutton\">";
			$code.="</form>";

		return $code;
    }
    /**
     * Generates the 'add video to group' button
     *
     * @param string $row  the group sql data
     * @return       $code
     */
	function generateAddToGroupButton($row) {
		global $database, $Itemid, $smartyvs, $my;
		$c = hwd_vs_Config::get_instance();
		$db = & JFactory::getDBO();
		$my = & JFactory::getUser();

		// setup ajax tags
	    if ($c->ajaxa2gmeth == 1) { $ajaxa2g = "onsubmit=\"ajaxFunctionA2G();return false;\""; } else { $ajaxa2g = null; }

		$code = null;

		$db->SetQuery( 'SELECT count(*)'
							. ' FROM #__hwdvidsgroup_membership AS a'
							. ' LEFT JOIN #__hwdvidsgroups AS l ON l.id = a.groupid'
							. ' WHERE a.memberid = '.$my->id
							);
		$total = $db->loadResult();
		echo $db->getErrorMsg();

		if ($total > 0) {

			$query = 'SELECT a.*, l.*'
								. ' FROM #__hwdvidsgroup_membership AS a'
								. ' LEFT JOIN #__hwdvidsgroups AS l ON l.id = a.groupid'
								. ' WHERE a.memberid = '.$my->id
								. ' ORDER BY a.memberid'
								;

			$db->SetQuery($query);
			$grows = $db->loadObjectList();

			$code.= "<form name=\"add2group\" ".$ajaxa2g." action=\"".JURI::root( true )."/index.php?option=com_hwdvideoshare&Itemid=".$Itemid."&task=addvideotogroup\" method=\"post\">";
			$code.= "<input type=\"hidden\" name=\"userid\" value=\"".$my->id."\" />";
			$code.= "<input type=\"hidden\" name=\"videoid\" value=\"".$row->id."\" />";
			$code.= "<select name=\"groupid\" class=\"add2gselect\">";
			$code.= "<option value=\"0\">"._HWDVIDS_DETAILS_A2G."</option>";
				$n=count($grows);
				for ($i=0, $n=count($grows); $i < $n; $i++) {
					$grow = $grows[$i];
					$code.= "<option value =\"".$grow->id."\">".$grow->group_name."</option>";
				}
			$code.= "</select>&nbsp;";
			$code.= "<input type=\"submit\" value=\""._HWDVIDS_BUTTON_ADD."\" id=\"add2groupbutton\" class=\"interactbutton\" />";
			$code.= "</form>";

		}

		return $code;
    }
    /**
     * Generates the 'video comments' system
     *
     * @param string $row  the video sql data
     * @return       $code
     */
	function generateVideoComments($row) {
		global $mainframe, $Itemid, $smartyvs, $botDisplay;
		$c = hwd_vs_Config::get_instance();
		$my = & JFactory::getUser();

		$code = null;
        require_once(JPATH_SITE.DS.'administrator'.DS.'components'.DS.'com_hwdvideoshare'.DS.'libraries'.DS.'maintenance_recount.class.php');

		if ( $c->showcoms ==1 && $row->allow_comments == 1 ) {
		$smartyvs->assign("print_comments", 1);
			if ( $c->commssys == 0 ) {
				if (!file_exists(JPATH_SITE.DS.'components'.DS.'com_jcomments'.DS)) {
					$code.= "<div class=\"padding\">"._HWDVIDS_INFO_NOINS_JCOMMENTS."</div>";
				} else {
					$comments = JPATH_SITE.DS.'components'.DS.'com_jcomments'.DS.'jcomments.php';
					if (file_exists( $comments )) {
						require_once( $comments );
						$comments = JComments::showComments( $row->id, 'com_hwdvideoshare_v', $row->title );
			            $code.= "<div class=\"padding\">".$comments."</div>";
					}
				}
			} else if ( $c->commssys == 3 ) {
				if (!file_exists(JPATH_SITE.DS.'plugins'.DS.'content'.DS.'jom_comment_bot.php')) {
					$code.= "<div class=\"padding\">"._HWDVIDS_INFO_NOINS_JOMCOMMENTS."</div>";
				} else {
					include_once(JPATH_SITE.DS.'plugins'.DS.'content'.DS.'jom_comment_bot.php');
					$comments = jomcomment( $row->id, 'com_hwdvideoshare_v');
					$code.= "<div class=\"padding\">".$comments."</div>";
				}
			} else if ( $c->commssys == 7 ) {
				if (!file_exists(JPATH_SITE.DS.'plugins'.DS.'content'.DS.'kunenadiscuss.php')) {
					$code.= "<div class=\"padding\">Kunena DicsussBot is not installed.</div>";
				} else {
					$db_catid = 4;

					include_once(JPATH_SITE.DS.'plugins'.DS.'content'.DS.'kunenadiscuss.php');
					$dispatcher	=& JDispatcher::getInstance();
					JPluginHelper::importPlugin('content');
					$db_comments->id = $row->id;
					$db_comments->sectionid = $row->category_id;
					$db_comments->catid = $row->category_id;
					$db_comments->state = $row->published;
					$db_comments->title = $row->title;
					$db_comments->created_by = $my->id;
					$db_comments->text = '{mos_fb_discuss:'.$db_catid.'}';
					$db_results = $dispatcher->trigger('onPrepareContent', array (&$db_comments, null, 0));
					//print_r($db_comments);
					//print_r($botDisplay);
					//exit;
					$code.= "<div class=\"padding\">".$botDisplay[$row->id]."</div>";
				}
			}
		}
		$smartyvs->assign("comment_code", $code);
		return $code;
    }
    /**
     * Generates the 'group comments' system
     *
     * @param string $row  the group sql data
     * @return       $code
     */
	function generateGroupComments($row) {
		global $Itemid, $smartyvs, $my;
		$c = hwd_vs_Config::get_instance();

		$code = null;

		if ( $c->showcoms ==1 && $row->allow_comments == 1 ) {
		$smartyvs->assign("print_comments", 1);
			if ( $c->commssys == 0 ) {
				if (!file_exists(JPATH_SITE.DS.'components'.DS.'com_jcomments'.DS)) {
					$code.= "<div class=\"padding\">"._HWDVIDS_INFO_NOINS_JCOMMENTS."</div>";
				} else {
					$comments = JPATH_SITE.DS.'components'.DS.'com_jcomments'.DS.'jcomments.php';
					if (file_exists( $comments )) {
						require_once( $comments );
						$comments = JComments::showComments( $row->id, 'com_hwdvideoshare_g', $row->title );
			            $code.= "<div class=\"padding\">".$comments."</div>";
					}
				}
			} else if ( $c->commssys == 3 ) {
				if (!file_exists(JPATH_SITE.DS.'plugins'.DS.'content'.DS.'jom_comment_bot.php')) {
					$code.= "<div class=\"padding\">"._HWDVIDS_INFO_NOINS_JOMCOMMENTS."</div>";
				} else {
					include_once(JPATH_SITE.DS.'plugins'.DS.'content'.DS.'jom_comment_bot.php');
					$comments = jomcomment( $row->id, 'com_hwdvideoshare_g');
					$code.= "<div class=\"padding\">".$comments."</div>";
				}
			}
		}
		$smartyvs->assign("comment_code", $code);
		return $code;
    }
    /**
     * Generates the human readable allowed video formats string
     *
     * @return       $code
     */
	function generateAllowedFormats() {
		global $Itemid, $database, $mosConfig_absolute_path;
		$c = hwd_vs_Config::get_instance();

		$code = null;
		if ($c->requiredins == 1) {
			if ($c->ft_mpg == "on") {$code .= "<b>mpg</b>, ";}
			if ($c->ft_mpeg == "on") {$code .= "<b>mpeg</b>, ";}
			if ($c->ft_avi == "on") {$code .=  "<b>avi</b>, ";}
			if ($c->ft_divx == "on") {$code .=  "<b>divx</b>, ";}
			if ($c->ft_mp4 == "on") {$code .=  "<b>mp4</b>, ";}
			if ($c->ft_flv == "on") {$code .=  "<b>flv</b>, ";}
			if ($c->ft_wmv == "on") {$code .=  "<b>wmv</b>, ";}
			if ($c->ft_rm == "on") {$code .=  "<b>rm</b>, ";}
			if ($c->ft_mov == "on") {$code .=  "<b>mov</b>, ";}
			if ($c->ft_moov == "on") {$code .=  "<b>moov</b>, ";}
			if ($c->ft_asf == "on") {$code .=  "<b>asf</b>, ";}
			if ($c->ft_swf == "on") {$code .=  "<b>swf</b>, ";}
			if ($c->ft_vob == "on") {$code .=  "<b>vob</b>, ";}

			$oformats = explode(",", $c->oformats);
			for ($i = 0, $n = count($oformats); $i < $n; $i++)
			{
				$oformat = $oformats[$i];
				$oformat = preg_replace("/[^a-zA-Z0-9s]/", "", $oformat);
				$code .=  "<b>".$oformat."</b>, ";
			}

		} else {
			$code =  "<b>flv</b>";
		}
		if (substr($code, -2) == ", ") {$code = substr($code, 0, -2);}
		return $code;
    }
    /**
     * Generates a username from user id with CB link if CB integration is avtivated
     *
     * @param int    $user_id  the user id
     * @return       $code
     */
	function generateUserFromID( $user_id=null, $username=null, $name=null ) {
		global $rows_usernames;
		$c = hwd_vs_Config::get_instance();
  		$db =& JFactory::getDBO();

		if (!isset($user_id) || $user_id == 0)
			return _HWDVIDS_INFO_GUEST;

		if ($c->userdisplay == 1) {
			if (!isset($username) || empty($username)) {
				$query = 'SELECT username FROM #__users WHERE id = '.$user_id;
				$db->SetQuery( $query );
				$displayname = $db->loadResult();
			} else {
				$displayname = $username;
			}
		} else {
			if (!isset($name) || empty($name)) {
				$query = 'SELECT name FROM #__users WHERE id = '.$user_id;
				$db->SetQuery( $query );
				$displayname = $db->loadResult();
			} else {
				$displayname = $name;
			}
		}

		$code = null;

		if ($c->cbint == 3) {
			if ($c->cbitemid !== "") { $c->cbitemid = "&Itemid=".$c->cbitemid; }
			$code = "<a href=\"".JRoute::_("index.php?option=com_community&controller=profile".$c->cbitemid."&user_id=".$user_id)."\">".$displayname."</a>";
		} else if ($c->cbint == 2) {
			if ($c->cbitemid !== "") { $c->cbitemid = "&Itemid=".$c->cbitemid; }
			$code = "<a href=\"".JRoute::_("index.php?option=com_community".$c->cbitemid."&view=profile&userid=".$user_id)."\">".$displayname."</a>";
		} else if ($c->cbint == 1) {
			if ($c->cbitemid !== "") { $c->cbitemid = "&Itemid=".$c->cbitemid; }
			$code = "<a href=\"".JRoute::_("index.php?option=com_comprofiler".$c->cbitemid."&task=userProfile&user=".$user_id)."\">".$displayname."</a>";
		} else {
			$code = $displayname;
		}

		return $code;
    }

	/**
	 * get_redirect_url()
	 * Gets the address that the provided URL redirects to,
	 * or FALSE if there's no redirect.
	 *
	 * @param string $url
	 * @return string
	 */
	function generateValidItemid($current=null){
  		$db =& JFactory::getDBO();

		if (isset($current)) {
			$db->SetQuery( 'SELECT id FROM #__menu WHERE `link` LIKE "%com_hwdvideoshare%" AND id = '.$current );
			$Itemid = $db->loadResult();
			if (!empty($Itemid)) {
				return $Itemid;
			}
		}

		$db->SetQuery( 'SELECT id FROM #__menu WHERE `link` LIKE "%com_hwdvideoshare%"' );
		$Itemid = $db->loadResult();

		if (empty($Itemid)) {
			$Itemid = "0";
		}

		return $Itemid;
	}

	/**
	 * get_redirect_url()
	 * Gets the address that the provided URL redirects to,
	 * or FALSE if there's no redirect.
	 *
	 * @param string $url
	 * @return string
	 */
	function generateLanguageDefinition($text){
		if(defined($text)) $returnText = constant($text);
		else $returnText = $text;
		return $returnText;
	}
    /**
     * Verifies an URL is valid
     *
     * @param string $url  the url to check
     * @return       true/false
     */
	function is_valid_url ( $url )
	{
		$theresults = ereg("^[a-zA-Z0-9]+://[^ ]+$", $url, $trashed);
		if ($theresults) {
			return true;
		} else {
			return false;
		}
	}
    /**
     * Generates a username from user id and creates a Joomla Backend link to either
     * core or CB profile page
     *
     * @param int    $user_id  the user id
     * @return       $code;
     */
	function generateBEUserFromID( $user_id=null ) {
		global $Itemid, $database, $mosConfig_absolute_path;
		$c = hwd_vs_Config::get_instance();
		$db =& JFactory::getDBO();
		$code = null;
		if (!isset($user_id)) {
			$code = _HWDVIDS_INFO_GUEST;
		} else {
			// find user
			$query = 'SELECT username FROM #__users WHERE id = '.$user_id;
			$db->SetQuery( $query );
			$user = $db->loadResult();
			if ($c->cbint == 1) {
				if ($c->cbitemid !== "") { $c->cbitemid = "&Itemid=".$c->cbitemid; }
				$code = "<a href=\"index.php?option=com_comprofiler&task=edit&cid=".$user_id."\">".$user."</a>";
			} else {
				$code = "<a href=\"index.php?option=com_users&task=editA&id=".$user_id."&hidemainmenu=1\">".$user."</a>";
			}
		}
		return $code;
    }
    /**
     * Generates a new random video id
     *
     * @param int    $length  the length of new string
     * @return       $code;
     *
     * FUTURE: Check does not already exist
     */
	function generateNewVideoid( $length=13 ) {
		global $Itemid, $database, $mosConfig_absolute_path;
		$c = hwd_vs_Config::get_instance();

		$code =null;
		// set default rating values
		$chars = "abcdefghijkmnopqrstuvwxyz023456789";
		srand((double)microtime()*1000000);
		$i = 0;
		$pass = '' ;
			while ($i <= 13) {
				$num = rand() % 33;
				$tmp = substr($chars, $num, 1);
				$code = $code . $tmp;
				$i++;
			}
		return $code;
	}
    /**
     * Generates the exact rating of a video
     *
     * @param array  $row  the video sql data
     * @return       $code;
     */
	function generateExactRating( $row ) {
		global $Itemid, $database, $mosConfig_absolute_path;
		$c = hwd_vs_Config::get_instance();

		$code =null;
		if ((isset($row->rating_total_points) && $row->rating_total_points !== "0") && (isset($row->rating_number_votes) && $row->rating_number_votes !== "0") ) {
			$code = $row->rating_total_points/$row->rating_number_votes;
		} else {
			$code = "0";
		}
		return $code;
	}
    /**
     * Generates the rating star image for current rating
     *
     * @param int    $rating  the video rating
     * @return       $code;
     */
	function generateRatingImg( $rating ) {
		global $Itemid, $database, $mosConfig_absolute_path;
		$c = hwd_vs_Config::get_instance();

		$code =null;
		// set default rating values
		if (!isset($rating)) { $rating = "0"; }
		$code = "<img src=\"".URL_HWDVS_IMAGES."ratings/stars".intval($rating)."0.png\" width=\"80\" height=\"16\" alt=\""._HWDVIDS_ALT_RATED." ".$rating."\" />";
		return $code;
	}
    /**
     * Appends the current avtive main navigation link with new id
     *
     * @param int    $active  the navigation link that is currently active
     * @return       Nothing
     */
	function generateActiveLink( $active ) {
		global $smartyvs;
		if ($active == 1) { $smartyvs->assign("von", " id=\"active\""); $smartyvs->assign("vact", 1); } else { $smartyvs->assign("von", ""); }
		if ($active == 2) { $smartyvs->assign("con", " id=\"active\""); $smartyvs->assign("cact", 1); } else { $smartyvs->assign("con", ""); }
		if ($active == 3) { $smartyvs->assign("gon", " id=\"active\""); $smartyvs->assign("gact", 1); } else { $smartyvs->assign("gon", ""); }
		if ($active == 4) { $smartyvs->assign("uon", " id=\"active\""); $smartyvs->assign("uact", 1); } else { $smartyvs->assign("uon", ""); }
		return;
	}
    /**
     * Generates the video player
     *
     * @param array  $row  the video sql data
     * @param int    $width(optional)  the video player width
     * @param int    $height(optional)  the video player width
     * @return       $code
     */
	function generateVideoPlayer( $row, $width=null, $height=null, $autostart=null ) {
		global $Itemid, $database, $mainframe, $option, $task, $smartyvs, $show_video_ad, $pre_url, $post_url;
		$c = hwd_vs_Config::get_instance();
  		$db =& JFactory::getDBO();

		$vp_plugin_path = JPATH_SITE.'/plugins/hwdvs-videoplayer/'.$c->hwdvids_videoplayer_file.'.view.php';
		if (file_exists($vp_plugin_path)) {
			require_once($vp_plugin_path);
		} else if (file_exists(JPATH_SITE.'/plugins/hwdvs-videoplayer/flow.view.php')) {
			require_once(JPATH_SITE.'/plugins/hwdvs-videoplayer/flow.view.php');
		} else {
        	$code = "This video can not be displayed because there are no video players installed.";
        	return $code;
		}

		$player = new hwd_vs_videoplayer();
		$flv_url = null;
		$flv_path = null;
		$thumb_url = null;
		$code = null;

		if ($row->video_type == "local" ||
		    $row->video_type == "mp4" ||
		    $row->video_type == "swf") {

			if ($row->video_type == "local" || $row->video_type == "mp4") {

				if (file_exists(JPATH_SITE.DS.'hwdvideos'.DS.'uploads'.DS.$row->video_id.'.mp4') && $c->usehq == 1) {
					$flv_url = JURI::root(true)."/hwdvideos/uploads/".$row->video_id.".mp4";
					$flv_path = JPATH_SITE.DS.'hwdvideos'.DS.'uploads'.DS.$row->video_id.'.mp4';
				} else {
					$flv_url = JURI::root(true)."/hwdvideos/uploads/".$row->video_id.".flv";
					$flv_path = JPATH_SITE.DS.'hwdvideos'.DS.'uploads'.DS.$row->video_id.'.flv';
				}

				if (file_exists(JPATH_SITE."/hwdvideos/thumbs/l_".$row->video_id.".jpg")) {
					$thumb_url = JURI::root()."hwdvideos/thumbs/l_".$row->video_id.".jpg";
				} else if (file_exists(JPATH_SITE."/hwdvideos/thumbs/".$row->video_id.".jpg")) {
					$thumb_url = JURI::root()."hwdvideos/thumbs/".$row->video_id.".jpg";
				} else {
					$thumb_url = '';
				}

			} else if ($row->video_type == "swf"){

				$flv_url = JURI::root(true)."/hwdvideos/uploads/".$row->video_id.".swf";
				$flv_path = HWDVIDSPATH.'/../../hwdvideos/uploads/'.$row->video_id.'.swf';
				$thumb_url = JURI::root(true)."/hwdvideos/thumbs/".$row->video_id.".jpg";

			}

			// setup antileech system expiration
			$dlink = hwd_vs_tools::generateAntileechExpiration($row->id, $row->video_type, 'player');
			$dlink = urlencode($dlink);

			if ( $row->video_type == "swf" && $c->standaloneswf == 1 ) {

				$flv_url = JURI::root(true)."/hwdvideos/uploads/".$row->video_id.".swf";
				$flv_path = HWDVIDSPATH.'/../../hwdvideos/uploads/'.$row->video_id.'.swf';

				$width = $c->flvplay_width;
				$height = $width*$c->var_fb;
				$smartyvs->assign("player_width", $width);
				$code.= "<div style=\"text-align: inherit;width:".$width."px!important;height:".$height."px!important;\">";
				$code.= "<object classid=\"clsid:d27cdb6e-ae6d-11cf-96b8-444553540000\" width=\"".$width."\" height=\"".$height."\" codebase=\"http://active.macromedia.com/flash7/cabs/ swflash.cab#version=9,0,0,0\" ID=testcommand>
						 <param name=\"movie\" value=\"".$flv_url."\">
						 <param name=\"play\" value=\"true\">
						 <param name=\"loop\" value=\"true\">
						 <param name=\"width\" value=\"".$width."\">
						 <param name=\"height\" value=\"".$height."\">
						 <param name=\"quality\" value=\"high\">
						 <param name=\"allowscale\" value=\"true\">
						 <param name=\"scale\" value=\"showall\">
						 <embed NAME=\"testcommand\" src=\"".$flv_url."\" width=\"".$width."\" height=\"".$height."\" play=\"true\" scale=\"showall\" loop=\"true\" quality=\"high\" pluginspage=\"http://www.macromedia.com/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash\" swLiveConnect=\"true\">
						 </embed>
						 </object>";
				return $code;
			}

			if ($show_video_ad == 1) {

				if ($c->hwdvids_videoplayer_file == "flow") {
					$flv_tracks = array();
					$flv_tracks[0] = $pre_url;
					$flv_tracks[1] = $flv_url;
					$flv_tracks[2] = $post_url;
					$code.= $player->prepareEmbeddedPlayer($flv_tracks, $width, $height, rand(100, 999), "playlist", $flv_path, null, $autostart);
					return $code;
				} else {
					$xspf_playlist = JPATH_SITE.'/components/com_hwdvideoshare/xml/xspf/'.$row->id.'.xml';
					@unlink($xspf_playlist);
					require_once(JPATH_SITE.'/administrator/components/com_hwdrevenuemanager/redrawplaylist.class.php');
					hwd_rm_playlist::writeFile($row, $flv_url, $pre_url, $post_url, $thumb_url);

					if (file_exists($xspf_playlist)) {
						$flv_url = JURI::root(true).'/components/com_hwdvideoshare/xml/xspf/'.$row->id.'.xml';
						$flv_path = JPATH_SITE.'/components/com_hwdvideoshare/xml/xspf/'.$row->id.'.xml';

						if ($c->loadswfobject == "on" && $task !=="grabjomsocialplayer") {
							$code.= $player->prepareplayer($flv_url, $width, $height, rand(100, 999), "playlist", $flv_path, null, $autostart);
						} else {
							$code.= $player->prepareEmbeddedPlayer($flv_url, $width, $height, rand(100, 999), "playlist", $flv_path, null, $autostart);
						}
						return $code;
					}
				}

			} else {
				if ($c->loadswfobject == "on" && $task !=="grabjomsocialplayer") {
					$code.= $player->prepareplayer($dlink, $width, $height, rand(100, 999), "video", $flv_path, $thumb_url, $autostart);
				} else {
					$code.= $player->prepareEmbeddedPlayer($dlink, $width, $height, rand(100, 999), "video", $flv_path, $thumb_url, $autostart);
				}
			}

		} else if ( $row->video_type == "playlist" ) {

			$flv_path = $row->playlist;
			if ($c->loadswfobject == "on") {
				$code.= $player->prepareplayer($flv_path, $width, $height, rand(100, 999), "playlist", null, null, $autostart);
			} else {
				$code.= $player->prepareEmbeddedPlayer($flv_path, $width, $height, rand(100, 999), "playlist", null, null, $autostart);
			}

		} else if ( $row->video_type == "direct" ) {

			$code.= $player->prepareEmbeddedPlayer($row->video_url, $width, $height, rand(100, 999), "video", $flv_path, $thumb_url, $autostart);

		} else if ($row->video_type == "seyret") {

			if (@explode(",", $video_code)) {
				$data = explode(",", $row->video_id);
			} else {
				return;
			}
			if ($data[0] == "local") {
				$file->id = $row->id;
				$file->video_type = "remote";
				$file->video_id = $data[1].",".$data[2];
				$file->thumbnail = $row->thumbnail;
				$code.= hwd_vs_tools::generateVideoPlayer($file, $width, $height);
			} else {
				$file->id = $row->id;
				$file->video_type = $data[0];
				$file->video_id = $data[1].",".$data[2];
				$file->thumbnail = $row->thumbnail;
				$code.= hwd_vs_tools::generateVideoPlayer($file, $width, $height);
			}

		} else {

			$plugin = hwd_vs_tools::getPluginDetails($row->video_type);
			if (!$plugin) {
				if ($width==null) {
					$smartyvs->assign("player_width", $c->tpwidth);
				} else {
					$smartyvs->assign("player_width", $width);
				}
				$code.= _HWDVIDS_INFO_NOPLUGIN." "._HWDVIDS_WMIP_01.$row->video_type._HWDVIDS_WMIP_02;
			} else {
				$preparevid = preg_replace("/[^a-zA-Z0-9s_-]/", "", $row->video_type)."PrepareVideo";
				$code.= $preparevid($row, $width, $height, $autostart);
			}
		}

		return $code;
	}
    /**
     * Multiple select list
     *
     * @param int    $arr
     * @param int    $tag_name
     * @param int    $tag_attribs
     * @param int    $key
     * @param int    $text
     * @param int    $selected
     * @return       $html
     */
	function selectList2(&$arr, $tag_name, $tag_attribs, $key, $text, $selected)
	{
		reset ($arr);
		$html = "\n<select name=\"$tag_name\" $tag_attribs>";

		for ($i = 0, $n = count($arr); $i < $n; $i++)
		{
			$k = $arr[$i]->$key;
			$t = $arr[$i]->$text;
			$id = @$arr[$i]->id;
			$extra = '';
			$extra .= $id ? " id=\"" . $arr[$i]->id . "\"" : '';

			if (is_array($selected))
			{
				foreach ($selected as $obj)
				{
					$k2 = $obj;

					if ($k == $k2)
					{
						$extra .= " selected=\"selected\"";
						break;
					}
				}
			}
			else {
				$extra .= ($k == $selected ? " selected=\"selected\"" : '');
			}

			$html .= "\n\t<option value=\"" . $k . "\"$extra>" . $t . "</option>";
		}

		$html .= "\n</select>\n";
		return $html;
	}
    /**
     * catTreeRecurse
     *
     * @param int    $id
     * @param int    $indent
     * @param int    $list
     * @param int    $children
     * @param int    $maxlevel
     * @param int    $level
     * @param int    $seperator
     * @return       Nothing
     */
	function catTreeRecurse($id, $indent = "&nbsp;&nbsp;&nbsp;", $list, &$children, $maxlevel = 9999, $level = 0, $seperator = " >> ")
	{
		if (@$children[$id] && $level <= $maxlevel)
		{
			foreach ($children[$id] as $v)
			{
				$id = $v->id;
				$txt = $v->category_name;
				$pt = $v->parent;
				$list[$id] = $v;
				$list[$id]->treename = "$indent$txt";
				$list[$id]->children = count(@$children[$id]);
				$list = hwd_vs_tools::catTreeRecurse($id, "$indent$txt$seperator", $list, $children, $maxlevel, $level + 1);
			//$list = hwd_vs_tools::catTreeRecurse( $id, "*", $list, $children, $maxlevel, $level+1 );
			}
		}

		return $list;
	}
    /**
     * Generate select list for JACL access levels
     *
     * @param int    $jaclplus
     * @param int    $selectname
     * @return       $access
     */
	function hwdvsMultiAccess( $jaclplus, $selectname='access' ) {
		global $database;
		$db =& JFactory::getDBO();

		$jaclplusarray = explode( ",", $jaclplus );
		$i = 0;
		$result = count($jaclplusarray);
		while($i < $result){
			$jaclpluslists[$i] = new stdClass();
			$jaclpluslists[$i]->value = $jaclplusarray[$i];
			$i++;
		}

		$query = "SELECT id AS value, name AS text"
		. "\n FROM #__groups"
		. "\n ORDER BY id"
		;
		$db->setQuery( $query );
		$groups = $db->loadObjectList();
		$access = JHTML::_('select.genericlist', $groups, $selectname, 'class="inputbox" size="6" multiple="true"', 'value', 'text', $jaclpluslists);

		return $access;
	}
    /**
     * Checks that the video upload form is complete and valid
     *
     * @param string $title
     * @param string $description
     * @param int    $category_id
     * @param string $tags
     * @param string $public_private
     * @param int    $allow_comments
     * @param int    $allow_embedding
     * @param int    $allow_ratings
     * @return       true/false
     */
	function checkFormComplete( $title, $description, $category_id, $tags, $public_private, $allow_comments, $allow_embedding, $allow_ratings ) {
		global $database;

		if ($title == "" || !isset($title)) {
        	hwd_vs_tools::infoMessage(4, 0, _HWDVIDS_TITLE_UPLDFAIL, _HWDVIDS_UPLD_FORMERR01, "exclamation.png", 0);
			return false;
		} else if ($description == "" || !isset($description)) {
        	hwd_vs_tools::infoMessage(4, 0, _HWDVIDS_TITLE_UPLDFAIL, _HWDVIDS_UPLD_FORMERR02, "exclamation.png", 0);
			return false;
		} else if ($category_id == "" || $category_id == 0 || !isset($category_id)) {
        	hwd_vs_tools::infoMessage(4, 0, _HWDVIDS_TITLE_UPLDFAIL, _HWDVIDS_UPLD_FORMERR03, "exclamation.png", 0);
			return false;
		} else if ($tags == "" || !isset($tags)) {
        	hwd_vs_tools::infoMessage(4, 0, _HWDVIDS_TITLE_UPLDFAIL, _HWDVIDS_UPLD_FORMERR04, "exclamation.png", 0);
			return false;
		} else if ($public_private == "" || !isset($public_private)) {
        	hwd_vs_tools::infoMessage(4, 0, _HWDVIDS_TITLE_UPLDFAIL, _HWDVIDS_UPLD_FORMERR05, "exclamation.png", 0);
			return false;
		} else if (!isset($allow_comments)) {
        	hwd_vs_tools::infoMessage(4, 0, _HWDVIDS_TITLE_UPLDFAIL, _HWDVIDS_UPLD_FORMERR06, "exclamation.png", 0);
			return false;
		} else if (!isset($allow_embedding)) {
        	hwd_vs_tools::infoMessage(4, 0, _HWDVIDS_TITLE_UPLDFAIL, _HWDVIDS_UPLD_FORMERR07, "exclamation.png", 0);
			return false;
		} else if (!isset($allow_ratings)) {
        	hwd_vs_tools::infoMessage(4, 0, _HWDVIDS_TITLE_UPLDFAIL, _HWDVIDS_UPLD_FORMERR08, "exclamation.png", 0);
			return false;
		} else {
			return true;
		}
	}
    /**
     * Checks that the video upload form is complete and valid
     *
     * @param string $group_name
     * @param string $public_private
     * @param int    $allow_comments
     * @param string $group_description
     * @return       true/false
     */
	function checkGroupFormComplete( $group_name, $public_private, $allow_comments, $group_description ) {
		global $database;

		if ($group_name == "" || !isset($group_name)) {
        	hwd_vs_tools::infoMessage(3, 0, _HWDVIDS_TITLE_UPLDFAIL, "group name", "exclamation.png", 0);
			return false;
		} else if ($public_private == "" || !isset($public_private)) {
        	hwd_vs_tools::infoMessage(3, 0, _HWDVIDS_TITLE_UPLDFAIL, "public private", "exclamation.png", 0);
			return false;
		} else if (!isset($allow_comments)) {
        	hwd_vs_tools::infoMessage(3, 0, _HWDVIDS_TITLE_UPLDFAIL, "allow comms", "exclamation.png", 0);
			return false;
		} else if ($group_description == "" || !isset($group_description)) {
        	hwd_vs_tools::infoMessage(3, 0, _HWDVIDS_TITLE_UPLDFAIL, "group description", "exclamation.png", 0);
			return false;
		} else {
			return true;
		}
	}
    /**
     * Trys to get the flv dimensions
     *
     * @param string $flv
     * @return
     */
	function getflvsize( $flv ) {
		require_once(HWDVIDSPATH.'/mvc/controller/id3/getid3.php');
		$getID3 = new getID3;
		$fileinfo = $getID3->analyze($flv);
		if(!($fileinfo['meta']['onMetaData']['width'] && $fileinfo['meta']['onMetaData']['height']))
			return false;
		$width = $fileinfo['meta']['onMetaData']['width'];
		$height = $fileinfo['meta']['onMetaData']['height'];
		return array($width, $height);
	}
    /**
     * Decodes parsed XML data
     *
     * @param string $string  the parsed xml string
     * @return       $string
     */
	function xmlDecode($string) {
		$string = str_replace("&#38;", "&", $string);
		$string = str_replace("&#60;", "<", $string);
		$string = str_replace("&#62;", ">", $string);
		$string = str_replace("&#39;", "\"", $string);
		$string = str_replace("&#39;", "'", $string);
		$string = str_replace("&#169;", "©", $string);
		$string = str_replace("&#174;", "®", $string);
		return $string;
	}
    /**
     * Generates the captcha security code
     *
     * @return       $code
     */
	function generateCaptcha( ) {
		global $database, $smartyvs;
		$c = hwd_vs_Config::get_instance();

		$code = null;
		if ($c->disablecaptcha == 0) {

			$jversion = hwd_vs_access::checkJversion();

			$code.="<script language=\"javascript\">
					window.onload=refresh_hwd_Captcha;
					var image=\"".JURI::root( true )."/components/com_hwdvideoshare/assets/captcha/CaptchaSecurityImages.php?width=120&height=40&jversion=".$jversion."&characters=6&uid=".rand()."\";
						function refresh_hwd_Captcha()
						{
							document.images[\"hwdCaptchaPic\"].src=image+\"?\"+new Date();
						}
					</script>
					<img src=\"".JURI::root( true )."/components/com_hwdvideoshare/assets/images/loadingCaptcha.png\" alt=\"Security Code\" name=\"hwdCaptchaPic\" id=\"hwdCaptchaPic\" width=\"120\" height=\"40\" style=\"border: 1px solid Black; width: 120px; height: 40px;\" />
					<script language=\"javascript\">
					document.write('<div style=\"cursor:pointer;padding:3px;\" onclick=\"refresh_hwd_Captcha()\" >"._HWDVIDS_INFO_NEWCODE."</a>');
					</script>";
		$smartyvs->assign("print_captcha", 1);
		}

	return $code;
	}
    /**
     * Generates the human readable supported 'third party' website list
     *
     * @return       $code
     */
	function generateSupportedWebsiteList() {
		$db = & JFactory::getDBO();

		$query = 'SELECT *'
			. ' FROM #__plugins'
			. ' WHERE published = 1'
			. ' AND folder = "hwdvs-thirdparty"'
			. ' ORDER BY name ASC'
			;

		$db->SetQuery( $query );
    	$rows = $db->loadObjectList();

		$code = null;
		for ($i=0, $n=count($rows); $i < $n; $i++) {
			$row = $rows[$i];

			if ($row->element == "thirdpartysupportpack") {
				if (file_exists(JPATH_SITE.'/plugins/hwdvs-thirdparty/support.ini')) {
					require_once(JPATH_SITE.DS.'administrator'.DS.'components'.DS.'com_hwdvideoshare'.DS.'libraries'.DS.'csv_iterator.class.php');
					$csvIterator = new CsvIterator(JPATH_SITE.DS.'plugins'.DS.'hwdvs-thirdparty'.DS.'support.ini', true, ",", "\"");

					while ($csvIterator->next()) {

						$row = $csvIterator->current();

						if (!isset($row['Name']) || empty($row['Name'])) { continue; }
						if (!isset($row['Website']) || empty($row['Website'])) { continue; }

						$code.= "<a href=\"".$row['Website']."\" target=\"_blank\">".$row['Name']."</a>, ";

					}
				}
			} else if ($row->element == "youtube") {
				$code.= "<a href=\"http://www.youtube.com\" target=\"_blank\">Youtube.com</a>, ";
			} else if ($row->element == "google") {
				$code.= "<a href=\"http://video.google.com\" target=\"_blank\">Google.com</a>, ";
			}
		}
		if (substr($code, -2) == ", ") {$code = substr($code, 0, -2);}
		return $code;

	}
	/**
     * Generates the Download Video Button
     *
     * @param array  $row  the video sql data
     * @param int    $original  link to original video or converted flv video (0/1)
     * @return       $code
     */
	function generateDownloadVideoLink( $row, $original=0 ) {
		global $Itemid, $database, $mosConfig_absolute_path;
		$c = hwd_vs_Config::get_instance();
		$db = & JFactory::getDBO();
		$my = & JFactory::getUser();
		$acl= & JFactory::getACL();
		$usersConfig = &JComponentHelper::getParams( 'com_users' );

		// check component access settings and deny those without privileges
		if ($c->access_method == 0) {
			if (!hwd_vs_access::allowAccess( $c->gtree_dnld, $c->gtree_dnld_child, hwd_vs_access::userGID( $my->id ))) {
				if ( ($my->id < 1) && (!$usersConfig->get( 'allowUserRegistration' ) == '0' && hwd_vs_access::allowAccess( $c->gtree_upld, 'RECURSE', $acl->get_group_id('Registered','ARO') ) ) ) {
					return;
				} else {
					return;
				}
			}
		} else if ($c->access_method == 1) {
			if (!hwd_vs_access::allowLevelAccess( $c->accesslevel_dnld, hwd_vs_access::userGID( $my->id ))) {
				return;
			}
		}

		$code =null;
		if ($original == 0) {

			// setup antileech system expiration
			$dlink = hwd_vs_tools::generateAntileechExpiration($row->id, 'local', 'download');

			$code =null;
			$code.= "<form name=\"downloadoriginal\" action=\"".$dlink."\" method=\"post\">
					 <input type=\"image\" src=\"".URL_HWDVS_IMAGES."icons/download.png\" alt=\"Download FLV Video\" id=\"downloadoriginalbutton\" />
					 <input type=\"submit\" value=\"Download FLV Video\" class=\"interactbutton\" />
					 </form>";

		} else {

			// setup antileech system expiration
			$dlink = hwd_vs_tools::generateAntileechExpiration($row->id, 'local', 'downloadoriginal');

			$code =null;
			$code.= "<form name=\"downloadoriginal\" action=\"".$dlink."\" method=\"post\">
					 <input type=\"image\" src=\"".URL_HWDVS_IMAGES."icons/download.png\" alt=\"Download Original Video\" id=\"downloadoriginalbutton\" />
					 <input type=\"submit\" value=\"Download Original Video\" class=\"interactbutton\" />
					 </form>";
		}


		return $code;
	}
	/**
     * Generates the View Original Video Button
     *
     * @param array  $row  the video sql data
     * @return       $code
     */
	function generateViewOriginalLink( $row ) {
		global $Itemid, $database, $mosConfig_absolute_path;
		$c = hwd_vs_Config::get_instance();
		$db = & JFactory::getDBO();

		$code =null;

			$plugin = hwd_vs_tools::getPluginDetails($row->video_type);
			if (!$plugin) {
				$code.= "";
			} else {
				// print third party thumbnail
				$prepareurl = preg_replace("/[^a-zA-Z0-9s_-]/", "", $row->video_type)."PrepareVideoURL";
				if ($url = $prepareurl($row->video_id)) {
					$code.= "<form name=\"vieworiginal\" action=\"".$url."\" method=\"post\" target=\"_blank\">
							 <input type=\"image\" src=\"".URL_HWDVS_IMAGES."icons/view.png\" alt=\""._HWDVIDS_VOV."\" id=\"vieworiginalbutton\" />
							 <input type=\"submit\" value=\""._HWDVIDS_VOV."\" class=\"interactbutton\" />
							 </form>";
				} else {
					$code.= "";
				}
			}

		return $code;
	}
	/**
     * Log a video view
     *
     * @param int    $videoid  the video id
     * @return       true/false
     */
	function logViewing( $videoid ) {
		$c = hwd_vs_Config::get_instance();
		$db = & JFactory::getDBO();
		$my = & JFactory::getUser();

		$row = new hwdvidslogs_views($db);

		$_POST['videoid'] 	= $videoid;
		$_POST['userid'] 	= $my->id;
		$_POST['date'] 		= date('Y-m-d H:i:s');

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

		unset($_POST['videoid']);
		unset($_POST['userid']);
		unset($_POST['date']);

		return true;
	}
	/**
     * Log a rate
     *
     * @param int    $videoid  the video id
     * @param int    $vote  the rating value
     * @return       true/false
     */
	function logRating( $videoid, $vote ) {
		global $database, $my;
		$c = hwd_vs_Config::get_instance();
		$db = & JFactory::getDBO();
		$my = & JFactory::getUser();

		$row = new hwdvidslogs_votes($db);

		$_POST['videoid'] 	= $videoid;
		$_POST['userid'] 	= $my->id;
		$_POST['vote'] 		= $vote;
		$_POST['date'] 		= date('Y-m-d H:i:s');

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

		return true;
	}
	/**
     * Log a favour
     *
     * @param int    $videoid  the video id
     * @param int    $favour  adding or removing favourite
     * @return       true/false
     */
	function logFavour( $videoid, $favour=1 ) {
		global $database, $my;
		$c = hwd_vs_Config::get_instance();
		$db = & JFactory::getDBO();
		$my = & JFactory::getUser();

		$row = new hwdvidslogs_favours($db);

		$_POST['videoid'] 	= $videoid;
		$_POST['userid'] 	= $my->id;
		$_POST['favour'] 	= $favour;
		$_POST['date'] 		= date('Y-m-d H:i:s');

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

		return true;
	}
	/**
     * Uploads a file from form
     *
     * @param int    $sec  the total number of seconds
     * @param int    $padHours(optional)
     * @return       $hms
     */
	function uploadFile( $input_name, $file_name, $base_Dir, $sizelimit=2, $allowed_formats='', $overwrite=0 ) {
		global $database, $my;
		$c = hwd_vs_Config::get_instance();

		$report = array();

		$file_name_tmp      = $_FILES[$input_name]['tmp_name'];
		$file_name_org      = $_FILES[$input_name]['name'];
		$file_size          = $_FILES[$input_name]['size'];
		$file_size_limit    = $sizelimit*1024*1024; //size limit in mb
		$file_ext[0]        = substr($file_name_org, strrpos($file_name_org, '.') + 1);
		$allowed_ext        = explode(",", $allowed_formats);
		$allowed_ext_compare = array_intersect($file_ext, $allowed_ext);
		$allowed_ext_result=false;
		if (count($allowed_ext_compare) > 0) {$allowed_ext_result=true;}

		if (empty($_FILES[$input_name]['name'])) {
        	$report[0] = "0";
        	$report[1] = _HWDVIDS_PHPUPLD_ERR00;
			return $report;
		} else if (!isset($_FILES[$input_name]['error'])) {
        	$report[0] = "0";
        	$report[1] = _HWDVIDS_PHPUPLD_ERR00;
			return $report;
		} else if ($_FILES[$input_name]['error'] == 8) {
        	$report[0] = "0";
        	$report[1] = _HWDVIDS_PHPUPLD_ERR08;
			return $report;
		} else if ($_FILES[$input_name]['error'] == 7) {
        	$report[0] = "0";
        	$report[1] = _HWDVIDS_PHPUPLD_ERR07;
			return $report;
		} else if ($_FILES[$input_name]['error'] == 6) {
        	$report[0] = "0";
        	$report[1] = _HWDVIDS_PHPUPLD_ERR06;
			return $report;
		} else if ($_FILES[$input_name]['error'] == 5) {
        	$report[0] = "0";
        	$report[1] = _HWDVIDS_PHPUPLD_ERR05;
			return $report;
		} else if ($_FILES[$input_name]['error'] == 4) {
        	$report[0] = "0";
        	$report[1] = _HWDVIDS_PHPUPLD_ERR04;
			return $report;
		} else if ($_FILES[$input_name]['error'] == 3) {
        	$report[0] = "0";
        	$report[1] = _HWDVIDS_PHPUPLD_ERR03;
			return $report;
		} else if ($_FILES[$input_name]['error'] == 2) {
        	$report[0] = "0";
        	$report[1] = _HWDVIDS_PHPUPLD_ERR02;
			return $report;
		} else if ($_FILES[$input_name]['error'] == 1) {
        	$report[0] = "0";
        	$report[1] = _HWDVIDS_PHPUPLD_ERR01;
			return $report;
		} else if ($_FILES[$input_name]['error'] == 0) {

			if (empty($file_name)) {
				// generate random filename
				$file_name = hwd_vs_tools::generateNewVideoid().".".$file_ext[0];
			} else {
				$file_name = $file_name.".".$file_ext[0];
			}

			if ($file_size > $file_size_limit) {
				$report[0] = "0";
				$report[1] = "File is too big";
				return $report;
			}

			if (!$allowed_ext_result) {
				$report[0] = "0";
				$report[1] = _HWDVIDS_ERROR_UPLDERR04." (".$allowed_formats.")";
				return $report;
			}

			if (!$overwrite && file_exists($base_Dir.$file_name)) {
				$report[0] = "0";
				$report[1] = _HWDVIDS_ERROR_UPLDERR05;
				return $report;
			}
			if (!move_uploaded_file ($_FILES[$input_name]['tmp_name'],$base_Dir.$file_name)) {
				$report[0] = "0";
				$report[1] = _HWDVIDS_ERROR_UPLDERR06;
				return $report;
			}

			@chmod($base_Dir.$file_name, 0755);

			$report[0] = "1";
			$report[1] = "Success";
			return $report;
		}
	}
	/**
	 * get_redirect_url()
	 * Gets the address that the provided URL redirects to,
	 * or FALSE if there's no redirect.
	 *
	 * @param string $url
	 * @return string
	 */
	function get_redirect_url($url){
		$redirect_url = null;

		$url_parts = @parse_url($url);
		if (!$url_parts) return false;
		if (!isset($url_parts['host'])) return false; //can't process relative URLs
		if (!isset($url_parts['path'])) $url_parts['path'] = '/';

		$sock = @fsockopen($url_parts['host'], (isset($url_parts['port']) ? (int)$url_parts['port'] : 80), $errno, $errstr, 30);
		if (!$sock) return false;

		$request = "HEAD " . $url_parts['path'] . (isset($url_parts['query']) ? '?'.$url_parts['query'] : '') . " HTTP/1.1\r\n";
		$request .= 'Host: ' . $url_parts['host'] . "\r\n";
		$request .= "Connection: Close\r\n\r\n";
		fwrite($sock, $request);
		$response = '';
		while(!feof($sock)) $response .= fread($sock, 8192);
		fclose($sock);

		if (preg_match('/^Location: (.+?)$/m', $response, $matches)){
			return trim($matches[1]);
		} else {
			return false;
		}

	}


    /**
     * Convert seconds to HOURS:MINUTES:SECONDS format
     * @param database A database connector object
     */
	function sec2hms ($sec, $padHours = false)
	{
		// holds formatted string
		$hms = "";

		// there are 3600 seconds in an hour, so if we
		// divide total seconds by 3600 and throw away
		// the remainder, we've got the number of hours
		$hours = intval(intval($sec) / 3600);

		// add to $hms, with a leading 0 if asked for
		$hms .= ($padHours)
			  ? str_pad($hours, 2, "0", STR_PAD_LEFT). ':'
			  : $hours. ':';


		// dividing the total seconds by 60 will give us
		// the number of minutes, but we're interested in
		// minutes past the hour: to get that, we need to
		// divide by 60 again and keep the remainder
		$minutes = intval(($sec / 60) % 60);

		// then add to $hms (with a leading 0 if needed)
		$hms .= str_pad($minutes, 2, "0", STR_PAD_LEFT). ':';

		// seconds are simple - just divide the total
		// seconds by 60 and keep the remainder
		$seconds = intval($sec % 60);

		// add to $hms, again with a leading 0 if needed
		$hms .= str_pad($seconds, 2, "0", STR_PAD_LEFT);

		// done!
		return $hms;
	}
   /**
	* Convert seconds to HOURS:MINUTES:SECONDS format
	**/
	function hms2sec ($time, $padHours = false)
	{
		$temp = explode(":",$time);

		if (is_numeric(@$temp[0])) {
			$hour = @$temp[0];
		} else { $hour = 0; }
		if (is_numeric(@$temp[0])) {
			$minute = @$temp[1];
		} else { $minute = 0; }
		if (is_numeric(@$temp[0])) {
			$second = @$temp[2];
		} else { $second = 0; }

 		$sec = ($hour*3600) + ($minute*60) + ($second);
		return $sec;
	}

	/**
	 * get_all_redirects()
	 * Follows and collects all redirects, in order, for the given URL.
	 *
	 * @param string $url
	 * @return array
	 */
	function get_all_redirects($url){
		$redirects = array();
		while ($newurl = hwd_vs_tools::get_redirect_url($url)){
			if (in_array($newurl, $redirects)){
				break;
			}
			$redirects[] = $newurl;
			$url = $newurl;
		}
		return $redirects;
	}
	/**
	 * get_final_url()
	 * Gets the address that the URL ultimately leads to.
	 * Returns $url itself if it isn't a redirect.
	 *
	 * @param string $url
	 * @return string
	 */
	function get_final_url($url){
		$redirects = hwd_vs_tools::get_all_redirects($url);
		if (count($redirects)>0){
			return array_pop($redirects);
		} else {
			return $url;
		}
	}
	/**
	 * get_final_url()
	 * Gets the address that the URL ultimately leads to.
	 * Returns $url itself if it isn't a redirect.
	 *
	 * @param string $url
	 * @return string
	 */
	function checkRemoteFileExists($url){
		if (@fopen($url, "r")) {
			return true;
		} else {
			return false;
		}
	}
	/**
	 * get_final_url()
	 * Gets the address that the URL ultimately leads to.
	 * Returns $url itself if it isn't a redirect.
	 *
	 * @param string $url
	 * @return string
	 */
	function getSelfURL(){
		$s = empty($_SERVER["HTTPS"]) ? ''
			: ($_SERVER["HTTPS"] == "on") ? "s"
			: "";
		$protocol = hwd_vs_tools::strleft(strtolower($_SERVER["SERVER_PROTOCOL"]), "/").$s;
		$port = ($_SERVER["SERVER_PORT"] == "80") ? ""
			: (":".$_SERVER["SERVER_PORT"]);
		return $protocol."://".$_SERVER['SERVER_NAME'].$port.$_SERVER['REQUEST_URI'];
	}
	function strleft($s1, $s2) { return substr($s1, 0, strpos($s1, $s2)); }
	/**
	 * Legacy function, deprecated
	 *
	 * @deprecated    As of version 1.5
	 */
	function yesnoSelectList( $tag_name, $tag_attribs, $selected, $yes='yes', $no='no' )
	{
		$arr = array(
			JHTML::_('select.option', 0, JText::_( $no )),
			JHTML::_('select.option', 1, JText::_( $yes )),
		);

		return JHTML::_('select.genericlist', $arr, $tag_name, $tag_attribs, 'value', 'text', (int) $selected);
	}
	/**
	 * get_final_url()
	 * Gets the address that the URL ultimately leads to.
	 * Returns $url itself if it isn't a redirect.
	 *
	 * @param string $url
	 * @return string
	 */
	function getPluginDetails($type){

		if ($type == 'youtube.com' && file_exists(JPATH_SITE.'/plugins/hwdvs-thirdparty/youtube.view.php')) {
			require_once(JPATH_SITE.'/plugins/hwdvs-thirdparty/youtube.view.php');
		} else if ($type == 'google.com' && file_exists(JPATH_SITE.'/plugins/hwdvs-thirdparty/google.view.php')) {
			require_once(JPATH_SITE.'/plugins/hwdvs-thirdparty/google.view.php');
		} else if ($type == 'remote' && file_exists(JPATH_SITE.'/plugins/hwdvs-thirdparty/remote.view.php')) {
			require_once(JPATH_SITE.'/plugins/hwdvs-thirdparty/remote.view.php');
		} else if (file_exists(JPATH_SITE.'/plugins/hwdvs-thirdparty/'.$type.'.php')) {
			require_once(JPATH_SITE.'/plugins/hwdvs-thirdparty/'.$type.'.view.php');
		} else {
			return false;
		}

		return true;
	}
    /**
     * addslashes() and prevents double-quoting
     *
     * @param array  $rows  the list from an xml file
     * @return       $code  the array prepared for Smarty template
     */
	function generateMetaText($receive) {

		$output = $receive;
		$output = strip_tags($output);
		$output = hwdEncoding::charset_encode_utf_8($output);
		while(strchr($output,'\"')) {
			$output = stripslashes($output);
		}
		$output = str_replace("\r", "", $output);
		$output = str_replace("\n", "", $output);

		return $output;

	}
    /**
     * Generates the array of information for a standard video list from parsed xml files
     *
     * @param array  $rows  the list from an xml file
     * @return       $code  the array prepared for Smarty template
     */
	function generateCarousel( $rows, $uid, $hwdvids_params, $template="fmtItem", $thumbwidth=null, $location="head" ) {
		global $mainframe, $Itemid, $database, $option, $mainframe, $mosConfig_absolute_path;
		$c = hwd_vs_Config::get_instance();

		if ($thumbwidth==null) {$thumbwidth=$c->thumbwidth;}
		$thumbwidth=$thumbwidth+10;

		$code =null;
		$style =null;
		if (!defined( '_HWD_VS_CAROUSELFLAG' )) {
			define( '_HWD_VS_CAROUSELFLAG', 1 );
			$code.='<script type="text/javascript" src="http://yui.yahooapis.com/2.5.2/build/utilities/utilities.js"></script>';
			$code.='<script type="text/javascript" src="http://yui.yahooapis.com/2.5.2/build/container/container_core-min.js"></script>';
			$code.='<script type="text/javascript" src="'.JURI::root( true ).'/components/com_hwdvideoshare/js/carousel.js"></script>';
			$code.="<style type=\"text/css\">
					.carousel-component {
						position:relative;
						overflow:hidden;   /* causes the clipping */
						display:none; /* component turns it on when first item is rendered */

					}

					.carousel-component ul.carousel-list {
						width:10000000px;
						position:relative;
						z-index:1;
					}

					.carousel-component .carousel-list li {
						float:left;
						list-style:none;
						overflow:hidden;


					}
					</style>";
		}

		$carousel_layout = "var innerHTML = thumbnail";
		if (@$hwdvids_params['showtitle'] == 1) {$carousel_layout.= " + title";}
		if (@$hwdvids_params['showcategory'] == 1) {$carousel_layout.= " + category";}
		if (@$hwdvids_params['showdescription'] == 1) {$carousel_layout.= " + description + '<br />'";}
		if (@$hwdvids_params['showrating'] == 1) {$carousel_layout.= " + rating + '<br />'";}
		if (@$hwdvids_params['shownov'] == 1) {$carousel_layout.= " + '"._HWDVIDS_DETAILS_VIEWED." ' + views + ' "._HWDVIDS_DETAILS_TIMES."<br />'";}
		if (@$hwdvids_params['showduration'] == 1) {$carousel_layout.= " + duration + '<br />'";}
		if (@$hwdvids_params['showuser'] == 1) {$carousel_layout.= " + uploader";}
		if (@$hwdvids_params['showtime'] == 1) {$carousel_layout.= "";}


		$code.="<script type=\"text/javascript\">
					var $template = function(thumbnail, title, category, description, rating, views, duration, uploader) {
						".$carousel_layout."
						return innerHTML;

					};
				</script>";

		$code.="<script type=\"text/javascript\">
					var listThumbnail_".$uid." =   [";
													for ($i=0, $n=count($rows); $i < $n; $i++)
													{
													 $row = $rows[$i];
													 $thumbnail = str_replace("'", "&#39;", $row->thumbnail);
													 $thumbnail = str_replace("\r", "", $thumbnail);
													 $thumbnail = str_replace("\n", "", $thumbnail);
													 $thumbnail = addslashes($thumbnail);

													 if ($i == $n-1) {$code.="'".$thumbnail."'";}
													 else {$code.="'".$thumbnail."',";}
													}
		$code.="];
		            var listTitle_".$uid." =       [";
													for ($i=0, $n=count($rows); $i < $n; $i++)
													{
													 $row = $rows[$i];
													 $title = str_replace("'", "&#39;", $row->title);
													 $title = str_replace("\r", "", $title);
													 $title = str_replace("\n", "", $title);

													 if ($i == $n-1) {$code.="'".$title."'";}
													 else {$code.="'".$title."',";}
													}
		$code.="];
		            var listCategory_".$uid." =    [";
													for ($i=0, $n=count($rows); $i < $n; $i++)
													{
													 $row = $rows[$i];
													 $category = str_replace("'", "&#39;", $row->category);

													 if ($i == $n-1) {$code.="'".$category."'";}
													 else {$code.="'".$category."',";}
													}
		$code.="];
		            var listDescription_".$uid." = [";
													for ($i=0, $n=count($rows); $i < $n; $i++)
													{
													 $row = $rows[$i];
													 $description = str_replace("'", "&#39;", $row->description);
													 $description = str_replace("\r", "", $description);
													 $description = str_replace("\n", "", $description);

													 if ($i == $n-1) {$code.="'".$description."'";}
													 else {$code.="'".$description."',";}
													}
		$code.="];
		            var listRating_".$uid." =      [";
													for ($i=0, $n=count($rows); $i < $n; $i++)
													{
													 $row = $rows[$i];
													 if ($i == $n-1) {$code.="'".$row->rating."'";}
													 else {$code.="'".$row->rating."',";}
													}
		$code.="];
		            var listViews_".$uid." =       [";
													for ($i=0, $n=count($rows); $i < $n; $i++)
													{
													 $row = $rows[$i];
													 if ($i == $n-1) {$code.="'".$row->views."'";}
													 else {$code.="'".$row->views."',";}
													}
		$code.="];
		            var listDuration_".$uid." =    [";
													for ($i=0, $n=count($rows); $i < $n; $i++)
													{
													 $row = $rows[$i];
													 if ($i == $n-1) {$code.="'".$row->duration."'";}
													 else {$code.="'".$row->duration."',";}
													}
		$code.="];
		            var listUploader_".$uid." =    [";
													for ($i=0, $n=count($rows); $i < $n; $i++)
													{
													 $row = $rows[$i];
													 if ($i == $n-1) {$code.="'".$row->uploader."'";}
													 else {$code.="'".$row->uploader."',";}
													}
		$code.="];

					var lastRan_".$uid." = -1;

					var loadInitialItems_".$uid." = function(type, args_".$uid.") {
						var start = args_".$uid."[0];
						var last = args_".$uid."[1];
						load_".$uid."(this, start, last);
					};

					var loadNextItems_".$uid." = function(type, args_".$uid.") {

						var start = args_".$uid."[0];
						var last = args_".$uid."[1];
						var alreadyCached = args_".$uid."[2];

						if(!alreadyCached) {
							load_".$uid."(this, start, last);
						}
					};

					var loadPrevItems_".$uid." = function(type, args_".$uid.") {
						var start = args_".$uid."[0];
						var last = args_".$uid."[1];
						var alreadyCached = args_".$uid."[2];

						if(!alreadyCached) {
							load_".$uid."(this, start, last);
						}
					};

					var load_".$uid." = function(carousel_".$uid.", start, last) {
						for(var i=start;i<=last;i++) {
							j = i - 1;
							carousel_".$uid.".addItem(i, ".$template."(listThumbnail_".$uid."[j], listTitle_".$uid."[j], listCategory_".$uid."[j], listDescription_".$uid."[j], listRating_".$uid."[j], listViews_".$uid."[j], listDuration_".$uid."[j], listUploader_".$uid."[j]));
						}
					};

					var handlePrevButtonState_".$uid." = function(type, args_".$uid.") {

						var enabling = args_".$uid."[0];
						var leftImage = args_".$uid."[1];
						if(enabling) {
							leftImage.src = \"".JURI::root( true )."/components/com_hwdvideoshare/images/modules/left-enabled.png\";
						} else {
							leftImage.src = \"".JURI::root( true )."/components/com_hwdvideoshare/images/modules/left-disabled.png\";
						}

					};

					var carousel_".$uid."; // for ease of debugging; globals generally not a good idea
					var pageLoad_".$uid." = function()
					{
						carousel_".$uid." = new YAHOO.extension.Carousel(\"carousel_".$uid."\",\"carousel_".$uid."-list\",\"carousel_".$uid."-clip-region\",
							{
								numVisible:               Math.min(listThumbnail_".$uid.".length,".$hwdvids_params['novtd']."),
								animationSpeed:           ".$c->scroll_as.",
								scrollInc:                3,
								navMargin:                40,
								prevElement:              \"prev-arrow_".$uid."\",
								nextElement:              \"next-arrow_".$uid."\",
								autoPlay: 	              ".$c->scroll_au.",
								size:                     listThumbnail_".$uid.".length,
								wrap:                     ".$c->scroll_wr.",
								loadInitHandler:          loadInitialItems_".$uid.",
								loadNextHandler:          loadNextItems_".$uid.",
								loadPrevHandler:          loadPrevItems_".$uid.",
								prevButtonStateHandler:   handlePrevButtonState_".$uid."
							}
						);
					};
					YAHOO.util.Event.addListener(window, 'load', pageLoad_".$uid.");
				</script>";

		$code.="<style type=\"text/css\">
				.carousel-component ul.carousel_".$uid."-list {
					width:10000000px;
					position:relative;
					z-index:1;
					/**/
					margin:0px;
					padding:0px!important;
					line-height:0px;
				}

				.carousel-component .carousel_".$uid."-list li {
					float:left;
					list-style:none;
					overflow:hidden;
					/**/
					text-align:center;
					margin:4px!important;
					padding:0px!important;
					font:10px verdana,arial,sans-serif;
					color:#666;
					/*
					background-repeat: none;
					*/
				}

				.carousel-component .carousel_".$uid."-list li a {
					display:block;
					outline:none;
				}

				.carousel-component .carousel_".$uid."-list li a:hover {
				}

				.carousel-component .carousel_".$uid."-clip-region {
					overflow:hidden;
					margin:0px auto;
					position:relative;
				}

				#prev-arrow_".$uid." {
					position:absolute;
					top:40px;
					z-index:3;
					cursor:pointer;
					left:5px;
				}

				#next-arrow_".$uid." {
					position:absolute;
					top:40px;
					z-index:3;
					cursor:pointer;
					right:5px;
				}
				.carousel-component .carousel_".$uid."-list li {
					list-style-image: url(".JURI::root( true )."/images/blank.png)!important;
					background-image:url(".JURI::root( true )."/images/blank.png)!important;
				}
				.carousel-component .carousel_".$uid."-list li {
					list-style-image: url(".JURI::root( true )."/images/blank.png)!important;
					background-image:url(".JURI::root( true )."/images/blank.png)!important;
					width:".$thumbwidth."px;
				}
				</style>";

		if ($location == "head") {
			$mainframe->addCustomHeadTag($code);
		} else {
			return $code;
		}

		return;
    }
    /**
     * Generates the array of information for a standard video list from parsed xml files
     *
     * @param array  $rows  the list from an xml file
     * @return       $code  the array prepared for Smarty template
     */
	function generateStaticModuleDisplay( $rows, $hwdvids_params ) {
		global $mosConfig_live_site, $Itemid, $database, $option, $mainframe, $mosConfig_absolute_path;

		$code =null;

		if ($hwdvids_params['talignment'] == 1) { $talign = "text-align:left;"; }
		if ($hwdvids_params['talignment'] == 2) { $talign = "text-align:center;"; }
		if ($hwdvids_params['talignment'] == 3) { $talign = "text-align:right;"; }
		if ($hwdvids_params['malignment'] == 1) { $malign = "float:left;"; }
		if ($hwdvids_params['malignment'] == 2) { $malign = "float:left;"; }
		if ($hwdvids_params['malignment'] == 3) { $malign = "float:right;"; }
		if (empty($hwdvids_params['novpr']) || $hwdvids_params['novpr'] == '') { $hwdvids_params['novpr'] = 3; }

		$n = min($hwdvids_params['novtd'],count($rows));

		for ($i=0, $n; $i < $n; $i++)
		{
			$row = $rows[$i];
			$code.="<div style=\"display:block;".$malign."padding:5px;overflow:hidden;".$talign."width:".$hwdvids_params['thumb_width']."px;\">".$row->thumbnail;
			if ($hwdvids_params['showtitle'] == 1) {$code.= '<br />'.$row->title;}
			if ($hwdvids_params['showcategory'] == 1) {$code.= '<br />'.$row->category;}
			if ($hwdvids_params['showdescription'] == 1) {$code.= '<br />'.$row->description;}
			if ($hwdvids_params['showrating'] == 1) {$code.= '<br />'.$row->rating;}
			if ($hwdvids_params['shownov'] == 1) {$code.= '<br />'._HWDVIDS_DETAILS_VIEWED.' '.$row->views.' '._HWDVIDS_DETAILS_TIMES;}
			if ($hwdvids_params['showduration'] == 1) {$code.= '<br />'.$row->duration;}
			if ($hwdvids_params['showuser'] == 1) {$code.= '<br />'.$row->uploader;}
			if ($hwdvids_params['showtime'] == 1) {$code.= '<br />'.$row->timesince;}
			$code.="</div>";

			if (($i-($hwdvids_params['novpr']-1)) % $hwdvids_params['novpr'] == 0) {
				$code.="<div style=\"clear:both;\"></div>";
			}
		}
		return $code;
    }
    /**
     * Generates the array of information for a standard video list from parsed xml files
     *
     * @param array  $rows  the list from an xml file
     * @return       $code  the array prepared for Smarty template
     */
	function generateNextPrevLinks( $row ) {
		global $Itemid, $option, $mainframe;

		$code =null;
		$code.= "<a href=\"".JRoute::_("index.php?option=com_hwdvideoshare&task=previousvideo&category_id=".$row->category_id."&video_id=".$row->id)."\" class=\"swap\">"._HWDVIDS_PREV."</a> | <a href=\"".JRoute::_("index.php?option=com_hwdvideoshare&task=nextvideo&category_id=".$row->category_id."&video_id=".$row->id)."\" class=\"swap\">"._HWDVIDS_NEXT."</a>";
		return $code;
	}
    /**
     * Generates the array of information for a standard video list from parsed xml files
     *
     * @param array  $rows  the list from an xml file
     * @return       $code  the array prepared for Smarty template
     */
	function generateTimeSinceUpload( $date_uploaded ) {

		$code =null;

		// get time since upload
		$hour = substr($date_uploaded, 11, 2);
		$minutes = substr($date_uploaded, 14, 2);
		$seconds = substr($date_uploaded, 17, 2);
		$month = substr($date_uploaded, 5, 2);
		$date = substr($date_uploaded, 8, 2);
		$year = substr($date_uploaded, 0, 4);
		$upld_date = mktime($hour, $minutes, $seconds, $month, $date, $year);
		$today = time();
		$difference = $today - $upld_date;

		if ($difference < 60) {
			$code = $difference." "._HWDVIDS_MP_SAGO;
		} else if ($difference < 3600) {
			$code = floor($difference / 60)." "._HWDVIDS_MP_MAGO;
		} else if ($difference < 86400) {
			$code = round($difference / 3600, 0)." "._HWDVIDS_MP_HAGO;
		} else {
			$code = round($difference / 86400, 0)." "._HWDVIDS_MP_DAGO;
		}

		return $code;
	}
	/**
     * readfile_chunked
     * Read the contents of a file in chunks
     * @param array  $row  the video sql data
     * @param int    $original  link to original video or converted flv video (0/1)
     * @return       $code
     */
	function readfile_chunked($filename,$retbytes=true) {
	   $chunksize = 1*(1024*1024); // how many bytes per chunk
	   $buffer = '';
	   $cnt =0;

	   $handle = fopen($filename, 'rb');
	   if ($handle === false) {
		   return false;
	   }

	   while (!feof($handle)) {
		   $buffer = fread($handle, $chunksize);
		   echo $buffer;
		   ob_flush();
		   flush();
		   if ($retbytes) {
			   $cnt += strlen($buffer);
		   }
	   }

	   $status = fclose($handle);
	   if ($retbytes && $status) {
		   return $cnt; // return num. bytes delivered like readfile() does.
	   }
	   return $status;

	}
	/**
     * Generates the Download Video Button
     *
     * @param array  $row  the video sql data
     * @param int    $original  link to original video or converted flv video (0/1)
     * @return       $code
     */
	function generateAntileechExpiration($fid, $media, $deliver) {
		global $Itemid, $database, $mosConfig_absolute_path;
		$c = hwd_vs_Config::get_instance();
		$db = & JFactory::getDBO();

		// setup antileech system expiration
		$download_exp_key = md5(microtime());

		$leech = new hwdvidsantileech($db);

		$_POST['expiration'] 		= $download_exp_key;

		// bind it to the table
		if (!$leech -> bind($_POST)) {
			echo "<script> alert('"
				.$leech -> getError()
				."'); window.history.go(-1); </script>\n";
			exit();
		}

		// store it in the db
		if (!$leech -> store()) {
			echo "<script> alert('"
				.$leech -> getError()
				."'); window.history.go(-1); </script>\n";
			exit();
		}

		unset($_POST['expiration']);

		$dlink = JURI::root()."index.php?option=com_hwdvideoshare&task=downloadfile&file=".$fid."&evp=".$download_exp_key."&media=".$media."&deliver=".$deliver."&tmpl=component";

		return $dlink;
	}
}
/**
 * Tab Creation handler
 * @package    hwdVideoShare
 * @author     Dave Horsfall <info@highwooddesign.co.uk>
 * @copyright  2008 Highwood Design
 * @license    http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @version    1.1.3
 */
class hwdTabs {
	/** @var int Use cookies */
	var $useCookies = 0;
	/**
	* Constructor
	* Includes files needed for displaying tabs and sets cookie options
	* @param int useCookies, if set to 1 cookie will hold last used tab between page refreshes
	*/
	function hwdTabs( $useCookies, $xhtml=NULL ) {
		global $mainframe;
		$html = null;

		if ( $xhtml ) {
			$mainframe->addCustomHeadTag( '<link rel="stylesheet" type="text/css" media="all" href="includes/js/tabs/tabpane.css" id="luna-tab-style-sheet" />' );
		} else {
			echo "<link id=\"luna-tab-style-sheet\" type=\"text/css\" rel=\"stylesheet\" href=\"" . JURI::root( true ). "/includes/js/tabs/tabpane.css\" />";
		}

		echo "<script type=\"text/javascript\" src=\"". JURI::root( true ) . "/includes/js/tabs/tabpane_mini.js\"></script>";

		$this->useCookies = $useCookies;
	}
	/**
	* creates a tab pane and creates JS obj
	* @param string The Tab Pane Name
	*/
	function startPane($id){
		$html = null;

		$html.= "<div class=\"tab-page\" id=\"".$id."\">";
		$html.= "<script type=\"text/javascript\">\n";
		$html.= "	var tabPane1 = new WebFXTabPane( document.getElementById( \"".$id."\" ), ".$this->useCookies." )\n";
		$html.= "</script>\n";
		return $html;
	}
	/**
	* Ends Tab Pane
	*/
	function endPane() {
		$html = null;
		$html.= "</div>";
		return $html;
	}
	/*
	* Creates a tab with title text and starts that tabs page
	* @param tabText - This is what is displayed on the tab
	* @param paneid - This is the parent pane to build this tab on
	*/
	function startTab( $tabText, $paneid ) {
		$html = null;
		$html.= "<div class=\"tab-page\" id=\"".$paneid."\">";
		$html.= "<h2 class=\"tab\">".$tabText."</h2>";
		$html.= "<script type=\"text/javascript\">\n";
		$html.= "  tabPane1.addTabPage( document.getElementById( \"".$paneid."\" ) );";
		$html.= "</script>";
		return $html;
	}
	/*
	* Ends a tab page
	*/
	function endTab() {
		$html = null;
		$html.= "</div>";
		return $html;
	}
}
/**
 * Process character encoding
 * @package    hwdVideoShare
 * @author     Dave Horsfall <info@highwooddesign.co.uk>
 * @copyright  2008 Highwood Design
 * @license    http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @version    1.1.3
 */
class hwdEncoding {

    function XMLEntities($string)
    {

		// Try to tidy up double encodings
		$string = str_replace("&#38;#38;#", "&#", $string);
		$string = str_replace("&#38;#", "&#", $string);
		$string = str_replace("&#38;amp;#", "&#", $string);
		$string = str_replace("&amp;#", "&#", $string);

		$string = str_replace("&", "&#38;", $string);
		$string = str_replace("<", "&#60;", $string);
		$string = str_replace(">", "&#62;", $string);
		$string = str_replace("\"", "&#34;", $string);
		$string = str_replace("'", "&#39;", $string);

		// Try to tidy up double encodings
		$string = str_replace("&#38;#38;#", "&#", $string);
		$string = str_replace("&#38;#", "&#", $string);
		$string = str_replace("&#38;amp;#", "&#", $string);
		$string = str_replace("&amp;#", "&#", $string);

		return $string;
    }

    function UNXMLEntities($string)
    {

		$string = str_replace("&#38;", "&", $string);
		$string = str_replace("&#60;", "<", $string);
		$string = str_replace("&#62;", ">", $string);
		$string = str_replace("&#34;", "\"", $string);
		$string = str_replace("&#39;", "'", $string);

		return $string;
    }

    function fixDoubleEncodings($string)
    {

		// Try to tidy up double encodings
		$string = str_replace("&#38;#38;#", "&#", $string);
		$string = str_replace("&#38;#", "&#", $string);
		$string = str_replace("&#38;amp;#", "&#", $string);
		$string = str_replace("&amp;#", "&#", $string);

		// Try to tidy up double encodings
		$string = str_replace("&#38;#38;#", "&#", $string);
		$string = str_replace("&#38;#", "&#", $string);
		$string = str_replace("&#38;amp;#", "&#", $string);
		$string = str_replace("&amp;#", "&#", $string);

		return $string;
    }

	function charset_decode_utf_8 ($string) {
		/* Only do the slow convert if there are 8-bit characters */
		/* avoid using 0xA0 (\240) in ereg ranges. RH73 does not like that */
		if (! ereg("[\200-\237]", $string) and ! ereg("[\241-\377]", $string))
			return $string;

		// decode three byte unicode characters
		$string = preg_replace("/([\340-\357])([\200-\277])([\200-\277])/e",
		"'&#'.((ord('\\1')-224)*4096 + (ord('\\2')-128)*64 + (ord('\\3')-128)).';'",
		$string);

		// decode two byte unicode characters
		$string = preg_replace("/([\300-\337])([\200-\277])/e",
		"'&#'.((ord('\\1')-192)*64+(ord('\\2')-128)).';'",
		$string);

		return $string;

	}

	function charset_encode_utf_8($string)
	{
		static $trans_tbl;

		// replace numeric entities
		$string = preg_replace('~&#([0-9]+);~e', 'hwdEncoding::unicodetoutf8(\\1)', $string);

		// replace literal entities
		if (!isset($trans_tbl))
		{
			$trans_tbl = array();

			foreach (get_html_translation_table(HTML_ENTITIES) as $val=>$key)
				$trans_tbl[$key] = utf8_encode($val);
		}

		return strtr($string, $trans_tbl);
	}

	/**
	 * Return utf8 symbol when unicode character number is provided
	 *
	 */
	function unicodetoutf8($var) {

		if ($var < 128) {

			$ret = chr ($var);

		} else if ($var < 2048) {

			// Two byte utf-8
			$binVal = str_pad (decbin ($var), 11, "0", STR_PAD_LEFT);
			$binPart1 = substr ($binVal, 0, 5);
			$binPart2 = substr ($binVal, 5);

			$char1 = chr (192 + bindec ($binPart1));
			$char2 = chr (128 + bindec ($binPart2));
			$ret = $char1 . $char2;

		} else if ($var < 65536) {

	        // Three byte utf-8
	        $binVal = str_pad (decbin ($var), 16, "0", STR_PAD_LEFT);
	        $binPart1 = substr ($binVal, 0, 4);
	        $binPart2 = substr ($binVal, 4, 6);
	        $binPart3 = substr ($binVal, 10);

	        $char1 = chr (224 + bindec ($binPart1));
	        $char2 = chr (128 + bindec ($binPart2));
	        $char3 = chr (128 + bindec ($binPart3));
	        $ret = $char1 . $char2 . $char3;

	    } else if ($var < 2097152) {

	        // Four byte utf-8
	        $binVal = str_pad (decbin ($var), 21, "0", STR_PAD_LEFT);
	        $binPart1 = substr ($binVal, 0, 3);
	        $binPart2 = substr ($binVal, 3, 6);
	        $binPart3 = substr ($binVal, 9, 6);
	        $binPart4 = substr ($binVal, 15);

	        $char1 = chr (240 + bindec ($binPart1));
	        $char2 = chr (128 + bindec ($binPart2));
	        $char3 = chr (128 + bindec ($binPart3));
	        $char4 = chr (128 + bindec ($binPart4));
	        $ret = $char1 . $char2 . $char3 . $char4;

	    } else if ($var < 67108864) {

	        // Five byte utf-8
	        $binVal = str_pad (decbin ($var), 26, "0", STR_PAD_LEFT);
	        $binPart1 = substr ($binVal, 0, 2);
	        $binPart2 = substr ($binVal, 2, 6);
	        $binPart3 = substr ($binVal, 8, 6);
	        $binPart4 = substr ($binVal, 14,6);
	        $binPart5 = substr ($binVal, 20);

	        $char1 = chr (248 + bindec ($binPart1));
	        $char2 = chr (128 + bindec ($binPart2));
	        $char3 = chr (128 + bindec ($binPart3));
	        $char4 = chr (128 + bindec ($binPart4));
	        $char5 = chr (128 + bindec ($binPart5));
	        $ret = $char1 . $char2 . $char3 . $char4 . $char5;

	    } else if ($var < 2147483648) {

	        // Six byte utf-8
	        $binVal = str_pad (decbin ($var), 31, "0", STR_PAD_LEFT);
	        $binPart1 = substr ($binVal, 0, 1);
	        $binPart2 = substr ($binVal, 1, 6);
	        $binPart3 = substr ($binVal, 7, 6);
	        $binPart4 = substr ($binVal, 13,6);
	        $binPart5 = substr ($binVal, 19,6);
	        $binPart6 = substr ($binVal, 25);

	        $char1 = chr (252 + bindec ($binPart1));
	        $char2 = chr (128 + bindec ($binPart2));
	        $char3 = chr (128 + bindec ($binPart3));
	        $char4 = chr (128 + bindec ($binPart4));
	        $char5 = chr (128 + bindec ($binPart5));
	        $char6 = chr (128 + bindec ($binPart6));
	        $ret = $char1 . $char2 . $char3 . $char4 . $char5 . $char6;

	    } else {

	        // there is no such symbol in utf-8
	        $ret='?';

	    }

		return $ret;

	}
}

?>