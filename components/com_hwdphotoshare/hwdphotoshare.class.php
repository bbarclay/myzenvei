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
define( '_HWD_PS_PLUGIN_COMPS', 212 );

/**
 * @package    hwdphotoshare
 * @author     Dave Horsfall <info@highwooddesign.co.uk>
 * @copyright  2008 Highwood Design
 * @license    http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @version    1.1.3
 */
class hwdpsalbums extends JTable
{
    var $id = null;
  	var $title = null;
  	var $description = null;
  	var $tags = null;
  	var $category_id = null;
  	var $date_created = null;
  	var $date_modified = null;
  	var $location = null;
  	var $allow_comments = null;
  	var $allow_ratings = null;
  	var $privacy = null;
  	var $approved = null;
  	var $user_id = null;
  	var $number_of_photos = null;
  	var $featured = null;
  	var $ordering = null;
  	var $checked_out = null;
  	var $checked_out_time = null;
  	var $published = null;
    /**
     * Constructor
     * @param database A database connector object
     */
	function hwdpsalbums(&$db){
		parent::__construct('#__hwdpsalbums', 'id', $db);
	}
}

/**
 * @package    hwdphotoshare
 * @author     Dave Horsfall <info@highwooddesign.co.uk>
 * @copyright  2008 Highwood Design
 * @license    http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @version    1.1.3
 */
class hwdpsphotos extends JTable
{
    var $id = null;
  	var $photo_type = null;
  	var $photo_id = null;
  	var $thumb_id = null;
  	var $album_id = null;
  	var $category_id = null;
  	var $title = null;
  	var $caption = null;
  	var $tags = null;
  	var $date_uploaded = null;
  	var $location = null;
  	var $allow_comments = null;
  	var $allow_ratings = null;
  	var $rating_number_votes = null;
  	var $rating_total_points = null;
  	var $updated_rating = null;
  	var $privacy = null;
  	var $approved = null;
  	var $number_of_views = null;
  	var $user_id = null;
  	var $setcover = null;
  	var $original_type = null;
  	var $featured = null;
  	var $ordering = null;
  	var $checked_out = null;
  	var $checked_out_time = null;
  	var $published = null;
    /**
     * Constructor
     * @param database A database connector object
     */
	function hwdpsphotos(&$db){
		parent::__construct('#__hwdpsphotos', 'id', $db);
	}
}

/**
 * @package    hwdphotoshare
 * @author     Dave Horsfall <info@highwooddesign.co.uk>
 * @copyright  2008 Highwood Design
 * @license    http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @version    1.1.3
 */
class hwdps_favs extends JTable {
	var $id = null;
	var $userid = null;
	var $photoid = null;
	var $date = null;

    /**
     * Constructor
     * @param database A database connector object
     */
    function hwdps_favs(&$db){
		parent::__construct('#__hwdpsfavorites', 'id', $db);
	}
}

/**
 * @package    hwdphotoshare
 * @author     Dave Horsfall <info@highwooddesign.co.uk>
 * @copyright  2008 Highwood Design
 * @license    http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @version    1.1.3
 */
class hwdps_flagphoto extends JTable {
 	var $id = null;
 	var $username = null;
 	var $photoid = null;
 	var $status = null;
 	var $ignore = null;
 	var $date = null;

    /**
     * Constructor
     * @param database A database connector object
     */
	function hwdps_flagphoto(&$db){
		parent::__construct('#__hwdpsflagged_photos', 'id', $db);
	}
}

/**
 * @package    hwdphotoshare
 * @author     Dave Horsfall <info@highwooddesign.co.uk>
 * @copyright  2008 Highwood Design
 * @license    http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @version    1.1.4 Alpha RC2.13
 */
class hwdps_cats extends JTable {
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
	function hwdps_cats(&$db){
		parent::__construct('#__hwdpscategories', 'id', $db);
	}
}

/**
 * @package    hwdphotoshare
 * @author     Dave Horsfall <info@highwooddesign.co.uk>
 * @copyright  2008 Highwood Design
 * @license    http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @version    1.1.3
 */
class hwdps_flaggroup extends JTable {
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
	function hwdps_flaggroup(&$db){
		parent::__construct('#__hwdpsflagged_groups', 'id', $db);
	}
}

/**
 * @package    hwdphotoshare
 * @author     Dave Horsfall <info@highwooddesign.co.uk>
 * @copyright  2008 Highwood Design
 * @license    http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @version    1.1.3
 */
class hwdps_groupmember extends JTable {
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
	function hwdps_groupmember(&$db){
		parent::__construct('#__hwdpsgroup_membership', 'id', $db);
	}
}

/**
 * @package    hwdphotoshare
 * @author     Dave Horsfall <info@highwooddesign.co.uk>
 * @copyright  2008 Highwood Design
 * @license    http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @version    1.1.3
 */
class hwdps_group extends JTable {
 	var $id = null;
 	var $group_name = null;
 	var $privacy = null;
 	var $date = null;
 	var $allow_comments = null;
 	var $require_approval = null;
 	var $group_description = null;
 	var $featured = null;
 	var $adminid = null;
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
	function hwdps_group(&$db){
		parent::__construct('#__hwdpsgroups', 'id', $db);
	}
}

/**
 * @package    hwdphotoshare
 * @author     Dave Horsfall <info@highwooddesign.co.uk>
 * @copyright  2008 Highwood Design
 * @license    http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @version    1.1.3
 */
class hwdps_groupvideo extends JTable {
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
	function hwdps_groupvideo(&$db){
		parent::__construct('#__hwdpsgroup_photos', 'id', $db);
	}
}

/**
 * @package    hwdphotoshare
 * @author     Dave Horsfall <info@highwooddesign.co.uk>
 * @copyright  2008 Highwood Design
 * @license    http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @version    1.1.3
 */
class hwdps_rating extends JTable {
 	var $id = null;
 	var $userid = null;
 	var $photoid = null;
 	var $ip = null;
 	var $date = null;

    /**
     * Constructor
     * @param database A database connector object
     */
	function hwdps_rating(&$db){
		parent::__construct('#__hwdpsrating', 'id', $db);
	}
}

/**
 * @package    hwdphotoshare
 * @author     Dave Horsfall <info@highwooddesign.co.uk>
 * @copyright  2008 Highwood Design
 * @license    http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @version    1.1.3
 */
class hwdpslogs_views extends JTable {
 	var $id = null;
 	var $videoid = null;
 	var $userid = null;
 	var $date = null;

    /**
     * Constructor
     * @param database A database connector object
     */
	function hwdpslogs_views(&$db){
		parent::__construct('#__hwdpslogs_views', 'id', $db);
	}
}

/**
 * @package    hwdphotoshare
 * @author     Dave Horsfall <info@highwooddesign.co.uk>
 * @copyright  2008 Highwood Design
 * @license    http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @version    1.1.3
 */
class hwdpslogs_votes extends JTable {
 	var $id = null;
 	var $videoid = null;
 	var $userid = null;
 	var $vote = null;
 	var $date = null;

    /**
     * Constructor
     * @param database A database connector object
     */
	function hwdpslogs_votes(&$db){
		parent::__construct('#__hwdpslogs_votes', 'id', $db);
	}
}

/**
 * @package    hwdphotoshare
 * @author     Dave Horsfall <info@highwooddesign.co.uk>
 * @copyright  2008 Highwood Design
 * @license    http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @version    1.1.3
 */
class hwdpslogs_favours extends JTable {
 	var $id = null;
 	var $videoid = null;
 	var $userid = null;
 	var $date = null;

    /**
     * Constructor
     * @param database A database connector object
     */
	function hwdpslogs_favours(&$db){
		parent::__construct('#__hwdpslogs_favours', 'id', $db);
	}
}

/**
 * @package    hwdphotoshare
 * @author     Dave Horsfall <info@highwooddesign.co.uk>
 * @copyright  2008 Highwood Design
 * @license    http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @version    1.1.3
 */
class hwdpslogs_archive extends JTable {
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
	function hwdpslogs_archive(&$db){
		parent::__construct('#__hwdpslogs_archive', 'id', $db);
	}
}

/**
 * @package    hwdphotoshare
 * @author     Dave Horsfall <info@highwooddesign.co.uk>
 * @copyright  2008 Highwood Design
 * @license    http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @version    1.1.4
 */
class hwdpsplugin extends JTable {
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
	function hwdpsplugin( &$db ) {
		parent::__construct( '#__hwdpsplugin', 'id', $db );
	}
}

/**
 * @package    hwdphotoshare
 * @author     Dave Horsfall <info@highwooddesign.co.uk>
 * @copyright  2008 Highwood Design
 * @license    http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @version    2.1.1 Build 21107 Alpha [Swami ]
 */
class hwd_ps_tools {
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
			$code = stripslashes($text).' ';
			$code = substr($code,0,$length);
			$code = substr($code,0,strrpos($code,' '));
			$code = $code.$suffix;
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
	function infoMessage( $active_menu, $active_usermenu, $title=_HWDPS_TITLE_ERROR, $message ,$icon=null, $backlink=0) {
		global $smartyps;

		$smartyps->assign("active_menu", $active_menu);
		$smartyps->assign("active_usermenu", $active_usermenu);
		$smartyps->assign("title", $title);
		$smartyps->assign("message", $message);
		$smartyps->assign("icon", URL_HWDPS_IMAGES.'icons/'.$icon);
		if ($backlink) {
		$smartyps->assign("backlink", "<a href=\"javascript: history.go(-1)\" class=\"jback1\">"._HWDPS_BACKLINK."</a><br /><br />");
		}

		$smartyps->display('infomessage.tpl');
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
	function generateCategoryLink( $cat_id, $category=null ) {
		global $Itemid, $database, $mosConfig_absolute_path;
		$c = hwd_ps_Config::get_instance();

		$code = null;
		$code.= "<a href=\"".JRoute::_("index.php?option=com_hwdphotoshare&amp;task=viewcategory&amp;Itemid=".$Itemid."&amp;cat_id=".$cat_id)."\">";
		if (isset($category)) {
			$code.= hwd_ps_tools::truncateText($category, $c->truntitle);
		} else {
			$code.= hwd_ps_tools::generateCategory( $cat_id );
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
		global $Itemid, $database, $mosConfig_absolute_path;
  		$db =& JFactory::getDBO();
		$c = hwd_ps_Config::get_instance();

		// get category name
		$query = 'SELECT category_name FROM #__hwdpscategories WHERE id = '.$cat_id;
		$db->SetQuery( $query );
 		$catname = $db->loadResult();
		// set default if category is empty
		if (empty($catname)) {$catname = _HWDPS_TEXT_NONE;}
		$code = $catname;
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
	function generateCategoryThumbnailLink( $row, $k, $width, $height, $class=null, $target="_top") {
		global $Itemid, $database, $mosConfig_absolute_path;
		$c = hwd_ps_Config::get_instance();
		$my = & JFactory::getUser();
  		$db =& JFactory::getDBO();

		$query = 'SELECT *'
					. ' FROM #__hwdpsphotos'
					. ' WHERE category_id = '.$row->id
					. ' AND published = 1'
					. ' ORDER BY date_uploaded DESC'
					. ' LIMIT 0, 1'
					;
		$db->SetQuery($query);
		$photo = $db->loadObject();

		if (empty($photo->id)) {$photo->id=null;}
		if (empty($photo->photo_id)) {$photo->photo_id=null;}
		if (empty($photo->photo_type)) {$photo->photo_type= "local";}
		if (empty($photo->original_type)) {$photo->original_type=null;}

		$code = null;
		$code.= "<a href=\"".JRoute::_("index.php?option=com_hwdphotoshare&amp;task=viewcategory&amp;Itemid=".$Itemid."&amp;cat_id=".$row->id)."\">";
		$code.= hwd_ps_tools::generateThumbnail( $photo->id, $photo->photo_id, $photo->photo_type, $photo->original_type, $k, 2, $class );
		$code.= "</a>";

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
  		$db =& JFactory::getDBO();
		$c = hwd_ps_Config::get_instance();

		$query = 'SELECT a.id, a.photo_id, a.photo_type, a.original_type'
				. ' FROM #__hwdpsphotos AS a'
				. ' LEFT JOIN #__hwdpsgroup_photos AS l ON l.photoid = a.id'
				. ' WHERE l.groupid = '.$row->id
				. ' AND a.published = 1'
				. ' AND a.approved = "yes"'
				. ' ORDER BY a.date_uploaded'
				. ' LIMIT 0, 1'
				;
		$db->SetQuery($query);
		$group_photo = $db->loadObject();

		if (empty($group_photo->id))            { $group_photo->id=null; }
		if (empty($group_photo->photo_id))      { $group_photo->photo_id=null; }
		if (empty($group_photo->photo_type))    { $group_photo->photo_type=null; }
		if (empty($group_photo->original_type)) { $group_photo->original_type=null; }
		$code = null;
		$code.= "<a href=\"".JRoute::_("index.php?option=com_hwdphotoshare&amp;task=viewgroup&amp;Itemid=".$Itemid."&amp;group_id=".$row->id)."\">";
		$code.= hwd_ps_tools::generateThumbnail( $group_photo->id, $group_photo->photo_id, $group_photo->photo_type, $group_photo->original_type, 0, 2, $class );
		$code.= "</a>";
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
	function generatePhotoThumbnailLink( $photo_id, $photo_code, $photo_type, $photo_format, $album_id, $ordering, $k, $format, $width=null, $height=null, $class=null, $target="_top") {
		global $Itemid, $database, $mosConfig_absolute_path;
		$c = hwd_ps_Config::get_instance();

		$width = 120;

		$code = null;
		$code.= "<a href=\"".JRoute::_("index.php?option=com_hwdphotoshare&amp;task=viewphoto&amp;Itemid=".$Itemid."&amp;album_id=".$album_id."&amp;limitstart=".$ordering)."\">";
		$code.= hwd_ps_tools::generateThumbnail( $photo_id, $photo_code, $photo_type, $photo_format, $k, $format, $class );
		$code.= "</a>";
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
	function generateAlbumThumbnailLink( $row, $k, $width, $height, $class=null, $format=2) {
		global $Itemid, $database, $mosConfig_absolute_path;
  		$db =& JFactory::getDBO();
		$c = hwd_ps_Config::get_instance();

		$db->setQuery("SELECT * FROM #__hwdpsphotos WHERE album_id = $row->id AND approved = \"yes\" ORDER BY setcover DESC LIMIT 0,1");
		$row_cover = $db->loadObject();

		if (@empty($row_cover->id)) {
			$row_cover->id = '';
			$row_cover->photo_id = '';
			$row_cover->photo_type = 'local';
			$row_cover->original_type = 'jpg';
		}

		$code = null;
		$code.= "<a href=\"".JRoute::_("index.php?option=com_hwdphotoshare&amp;task=viewalbum&amp;Itemid=".$Itemid."&amp;album_id=".$row->id)."\">";
		$code.= hwd_ps_tools::generateThumbnail( $row_cover->id, $row_cover->photo_id, $row_cover->photo_type, $row_cover->original_type, $k, $format, $class );
		$code.= "</a>";
		return $code;
    }
    /**
     * Generates the array of information for a standard group list from sql queries
     *
     * @param array  $rows  the list from a standard sql queries
     * @return       $code  the array prepared for Smarty template
     */
	function generatePhotoListFromSql( $rows, $class=null ) {
		global $Itemid, $database, $mosConfig_absolute_path;
		$c = hwd_ps_Config::get_instance();

		$k = 0;
		$twidth = null;
		$theight = null;

		$code = array();

		for ($i=0, $n=count($rows); $i < $n; $i++) {
			$row = $rows[$i];

			$code[$i]->thumbnail = hwd_ps_tools::generatePhotoThumbnailLink($row->id, $row->photo_id, $row->photo_type, $row->original_type, $row->album_id, $row->ordering, $k, 0, $twidth, $theight, $class);
			$code[$i]->thumbnail_url = hwd_ps_tools::generateThumbnailURL($row->id, $row->photo_id, $row->photo_type, $row->original_type, $k, 0, $class);
			$code[$i]->photo_url = hwd_ps_tools::generatePhotoURL($row);
			$code[$i]->caption = $row->caption;
			$code[$i]->pid = (int)$row->id;
			$code[$i]->ordering = (int)$row->ordering;
			$code[$i]->album_id = (int)$row->album_id;
			$code[$i]->previewlink = hwd_ps_tools::generatePreviewLink($row, $code[$i]->photo_url);
			$code[$i]->addtofavourites = hwd_ps_tools::generateFavouriteLink($row);
			$code[$i]->reportphoto = hwd_ps_tools::generateReportMediaLink($row);

			$code[$i]->k = $k;
			$code[$i]->i = $i;
			$k = 1 - $k;

		}

		return $code;
    }
    /**
     * Generates the array of information for a standard group list from sql queries
     *
     * @param array  $rows  the list from a standard sql queries
     * @return       $code  the array prepared for Smarty template
     */
	function generatePhotoEditListFromSql( $rows ) {
		global $Itemid, $database, $mosConfig_absolute_path;
		$c = hwd_ps_Config::get_instance();

		$twidth=null;
		$theight=null;
		$tclass=null;

		$code = array();
		$k = 0;
		for ($i=0, $n=count($rows); $i < $n; $i++) {
			$row = $rows[$i];

			$code[$i]->thumbnail = hwd_ps_tools::generatePhotoThumbnailLink($row->id, $row->photo_id, $row->photo_type, $row->original_type, $row->album_id, $row->ordering, $k, 0, $twidth, $theight, $tclass);
			$code[$i]->thumbnail_nolink = hwd_ps_tools::generateThumbnail( $row->id, $row->photo_id, $row->photo_type, $row->original_type, $k, 0, "psorgthumb");
			$code[$i]->title = $row->title;
			$code[$i]->caption = $row->caption;
			$code[$i]->tags = $row->tags;
			$code[$i]->pid = (int)$row->id;
			$code[$i]->counter = $i+1;
			$row->approved == "pending" ? $code[$i]->pending = "yes" : $code[$i]->pending = "no";
			if ($row->setcover == 1) {
				$code[$i]->setcover = "checked = \"checked\"";
			}
		}
		return $code;
    }
    /**
     * Generates the array of information for a standard group list from sql queries
     *
     * @param array  $rows  the list from a standard sql queries
     * @return       $code  the array prepared for Smarty template
     */
	function generatePhotoViewListFromSql( $rows ) {
		global $Itemid, $database, $mosConfig_absolute_path;
		$c = hwd_ps_Config::get_instance();

		$code = array();
		for ($i=0, $n=count($rows); $i < $n; $i++) {
			$row = $rows[$i];

			$code[$i]->photo = hwd_ps_tools::generatePhoto($row);
			$code[$i]->caption = $row->caption;
			$code[$i]->title = $row->title;
			$code[$i]->ratingsystem = hwd_ps_tools::generateRatingSystem($row);
			$code[$i]->commentingsystem = hwd_ps_tools::generatePhotoComments($row);
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
		$c = hwd_ps_Config::get_instance();

		$width = null;
		$height = null;
		$class = null;

		$code = array();
		$k = 0;
		for ($i=0, $n=count($rows); $i < $n; $i++) {
			$row = $rows[$i];

			$code[$i]->thumbnail = hwd_ps_tools::generateGroupThumbnailLink($row, $k, $width, $height, "ps-gl-thumb");
			//$code[$i]->avatar = hwd_ps_tools::generateAvatar($row->user_id, $k, $width, $height, $class);
			$code[$i]->grouptitle = hwd_ps_tools::generateGroupLink($row->id, $row->group_name);
			$code[$i]->groupdescription = hwd_ps_tools::truncateText($row->group_description, $c->trungdesc);
			$code[$i]->totalmembers = $row->total_members;
			$code[$i]->totalphotos = $row->total_photos;
			$code[$i]->administrator = hwd_ps_tools::generateUserFromID($row->adminid);
			$code[$i]->groupmembership = hwd_ps_tools::generateGroupMembershipStatus($row);
			$code[$i]->reportgroup = hwd_ps_tools::generateReportGroupButton($row);
			$code[$i]->datecreated = $row->date;
			$code[$i]->deletegroup = hwd_ps_tools::generateDeleteGroupLink($row);
			$code[$i]->editgroup = hwd_ps_tools::generateEditGroupLink($row);
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
     * @return       $code  the array prepared for Smarty template
     */
    function generateAlbumListFromSql( $rows, $format=2 ) {
		global $Itemid, $database, $mosConfig_absolute_path;
		$c = hwd_ps_Config::get_instance();

		$code = array();
		$k = 0;
		$twidth = null;
		$theight = null;
		$tclass = null;
		$width = null;
		$height = null;
		$class = null;

		for ($i=0, $n=count($rows); $i < $n; $i++) {
			$row = $rows[$i];

			if ($row->privacy == "public") { $pubsel = "selected=\"selected\"";$regsel=null; } else { $regsel = "selected=\"selected\"";$pubsel=null; }
			if (!isset($row->avatar)) { $row->avatar = ''; }

			$code[$i]->thumbnail = hwd_ps_tools::generateAlbumThumbnailLink($row, $k, $twidth, $theight, "ps-al-thumb", $format);
			$code[$i]->avatar = hwd_ps_tools::generateAvatar($row->user_id, $row->avatar, $k, $width, $height, $class);
			$code[$i]->title = hwd_ps_tools::generateAlbumLink( $row->id, $row->title );
			$code[$i]->description = hwd_ps_tools::truncateText($row->description, $c->trunadesc);
			$code[$i]->category = hwd_ps_tools::generateCategoryLink( $row->category_id );
			$code[$i]->numberofphotos = (int)$row->number_of_photos;
			$code[$i]->datecreated = date("ga - F j, Y", strtotime($row->date_created));
			$code[$i]->datemodified = date("ga - F j, Y", strtotime($row->date_modified));
			$code[$i]->uploader = hwd_ps_tools::generateUserFromID($row->user_id);
			$code[$i]->deletealbum_button = hwd_ps_tools::generateDeleteAlbumButton($row);
			$code[$i]->editalbum_button = hwd_ps_tools::generateEditAlbumButton($row);
			$code[$i]->addphotos_button = hwd_ps_tools::generateAddNewPhotosButton($row);
			$code[$i]->deletealbum_link = hwd_ps_tools::generateDeleteAlbumLink($row);
			$code[$i]->editalbum_link = hwd_ps_tools::generateEditAlbumLink($row);
			$code[$i]->addphotos_link = hwd_ps_tools::generateAddNewPhotosLink($row);
			$code[$i]->k = $k;
			$code[$i]->album_id = (int)$row->id;
			$code[$i]->privacyselectlist = "<select name=\"privacy\"><option value=\"public\" ".$pubsel.">"._HWDPS_SELECT_PUBLIC."</option><option value=\"registered\" ".$regsel.">"._HWDPS_SELECT_REG."</option></select>";
			$k = 1 - $k;
			$pubsel=null;
			$regsel=null;
		}
		return $code;
    }
    /**
     * Generates the array of information for a standard video list from sql queries
     *
     * @param array  $rows  the list from a standard sql queries
     * @param string $thumbclass(optional)  the class for the thumbnail images
     * @return       $code  the array prepared for Smarty template
     */
    function generateTagListString( $row, $layout_type=0, $link_type=0 ) {

		$code = null;
		$x = 0;

			$tags = explode(" ", $row->tags);

			for ($j=0, $m=count($tags); $j < $m; $j++) {
				$tag = $tags[$j];
				if (empty($tag)) { break; }

				if ($x!==0) {
					$code.= ', ';
				}

				if ($link_type == 1) {
					$code.= '';;
				}
				$code.= preg_replace("/[^a-zA-Z0-9s_-]/", "", $tag);
				if ($link_type == 1) {
					$code.= '';
				}

				$x++;
			}

		return $code;
    }
    /**
     * Generates the array of information for a standard video list from sql queries
     *
     * @param array  $rows  the list from a standard sql queries
     * @param string $thumbclass(optional)  the class for the thumbnail images
     * @return       $code  the array prepared for Smarty template
     */
    function generateTagListArrayFromSql( $rows ) {
		global $Itemid, $database, $mosConfig_absolute_path;
		$c = hwd_ps_Config::get_instance();

		$code = null;
		$x = 0;

		for ($i=0, $n=count($rows); $i < $n; $i++) {
			$row = $rows[$i];

			$tags = explode(" ", $row->tags);

			for ($j=0, $m=count($tags); $j < $m; $j++) {
				$tag = $tags[$j];
				if (empty($tag)) { break; }

				$code[$x]->tag  = preg_replace("/[^a-zA-Z0-9s_-]/", "", $tag);
				$code[$x]->size = rand(70, 250);
				$x++;
			}
		}
		return $code;
    }
    /**
     * Generates the array of information for a standard video list from sql queries
     *
     * @param array  $rows  the list from a standard sql queries
     * @param string $thumbclass(optional)  the class for the thumbnail images
     * @return       $code  the array prepared for Smarty template
     */
    function generateGroupMemberList( $rows ) {
		global $Itemid, $database, $mosConfig_absolute_path;
		$c = hwd_ps_Config::get_instance();

		$code = array();
		$k = 0;
		for ($i=0, $n=count($rows); $i < $n; $i++) {
			$row = $rows[$i];
			$code[$i]->member_id = $row->id;
			$code[$i]->member_username = $row->username;
			$code[$i]->k = $k;
			$k = 1 - $k;
		}
		return $code;
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
	function categoryList( $header, $selid, $nocatsmess, $pub = 0, $cname = "category_id", $checkaccess = 1 ) {

		global $database, $my, $mosConfig_lang;
  		$db =& JFactory::getDBO();
		$my = & JFactory::getUser();
        $c = hwd_ps_Config::get_instance();
		require_once(JPATH_SITE.DS.'administrator'.DS.'components'.DS.'com_hwdphotoshare'.DS.'helpers'.DS.'access.php');

		if ($pub) { $where = "\nWHERE published = 1"; } else { $where = null; }
		$db->setQuery("SELECT id ,parent,category_name, access_u, access_lev_u, access_u_r from #__hwdpscategories"
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
					if (!hwd_ps_access::allowAccess( $v->access_u, $v->access_u_r, hwd_ps_access::userGID( $my->id ))) {
						continue;
					}
				} else if ($c->access_method == 1) {
					if (!hwd_ps_access::allowLevelAccess( $v->access_lev_u, hwd_ps_access::userGID( $my->id ))) {
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
		$list = hwd_ps_tools::catTreeRecurse(0, '', array (), $children);
		// assemble menu items to the array
		$mitems = array ();
		if ($nocats == 0) {
			$mitems[] = JHTML::_('select.option', '0', $nocatsmess);
		} else {
			$mitems[] = JHTML::_('select.option', '0', $header);
		}
		$this_treename = '';

		foreach ($list as $item)
		{
			if ($this_treename)
			{
				if ($item->id != $mitems && strpos($item->treename, $this_treename) === false) {
					$mitems[] = mosHTML::makeOption($item->id, $item->treename);
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
		$code = hwd_ps_tools::selectList2($mitems, $cname, 'class="inputbox"', 'value', 'text', $selid);
		return $code;
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
	function generateThumbnailURL( $photo_id, $photo_code, $photo_type, $photo_format, $k=0, $format=0, $class="psthumb" ) {
		global $Itemid, $database, $mosConfig_absolute_path;
		$c = hwd_ps_Config::get_instance();
		$refresh = 0;

		if ($format=="0") {
			$thumbpath = JPATH_SITE."/hwdphotos/thumbs/normal/".$photo_code.".".$photo_format;
			if (!@fopen($imagepath, 'r')) {
				@chmod($imagepath, 0644);
				@JPath::setPermissions($imagepath, 644);
			}
			if (file_exists($thumbpath) && @fopen($thumbpath, 'r') && !empty($photo_id)) {
				$thumburl = JURI::root(true)."/hwdphotos/thumbs/normal/".$photo_code.".".$photo_format;
			} else {
				$thumbpath = PATH_HWDPS_IMAGES.'default_thumb.jpg';
				$thumburl = URL_HWDPS_IMAGES.'default_thumb.jpg';
				$refresh = 1;
			}
		} else if ($format=="1") {
			$thumbpath = JPATH_SITE."/hwdphotos/thumbs/square/".$photo_code.".".$photo_format;
			if (!@fopen($imagepath, 'r')) {
				@chmod($imagepath, 0644);
				@JPath::setPermissions($imagepath, 644);
			}
			if (file_exists($thumbpath) && @fopen($thumbpath, 'r') && !empty($photo_id)) {
				$thumburl = JURI::root(true)."/hwdphotos/thumbs/square/".$photo_code.".".$photo_format;
			} else {
				$thumbpath = PATH_HWDPS_IMAGES.'default_thumb_square.jpg';
				$thumburl = URL_HWDPS_IMAGES.'default_thumb_square.jpg';
				$refresh = 1;
			}
		} else if ($format=="2") {
			$thumbpath = JPATH_SITE."/hwdphotos/thumbs/squarerf/".$photo_code.".".$photo_format;
			if (!@fopen($imagepath, 'r')) {
				@chmod($imagepath, 0644);
				@JPath::setPermissions($imagepath, 644);
			}
			if (file_exists($thumbpath) && @fopen($thumbpath, 'r') && !empty($photo_id)) {
				$thumburl = JURI::root(true)."/hwdphotos/thumbs/squarerf/".$photo_code.".".$photo_format;
			} else {
				$thumbpath = PATH_HWDPS_IMAGES.'default_thumb_squarerf.jpg';
				$thumburl = URL_HWDPS_IMAGES.'default_thumb_squarerf.jpg';
				$refresh = 1;
			}
		}

		list($width, $height, $type, $attr) = @getimagesize($thumbpath);

		if (file_exists($thumbpath) && (filesize($thumbpath) > 0)) {
			return $thumburl;
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
	function generateThumbnail( $photo_id, $photo_code, $photo_type, $photo_format, $k=0, $format=0, $class="psthumb" ) {
		$c = hwd_ps_Config::get_instance();

		$thumburl = hwd_ps_tools::generateThumbnailURL( $photo_id, $photo_code, $photo_type, $photo_format, $k, $format, $class );

		if (!isset($class) || empty($class)) {
			$class="psthumb";
		}

		$thumb = "<img src=\"".$thumburl."\" border=\"0\" alt=\""._HWDPS_VIEWPHOTO."\" class=\"".$class."\" width=\"".$c->resize_thumb."\" />";

		return $thumb;
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
	function generateEditAlbumLink( $row ) {
		global $Itemid, $database, $my, $mainframe;
		$my = & JFactory::getUser();
		$c = hwd_ps_Config::get_instance();

		$code = null;
		$url = JRoute::_($_SERVER['REQUEST_URI']);
		if ( $my->id == $row->user_id ){
			$mainframe->addCustomHeadTag(hwd_ps_javascript::confirmEdit());
			$code.="<form name=\"editvideo\" style=\"display: inline;\" action=\"".JURI::root(true)."/index.php?option=com_hwdphotoshare&amp;Itemid=".$Itemid."&amp;task=editalbum\" method=\"post\">";
			$code.="<input type=\"hidden\" name=\"userid\" value=\"".$my->id."\" />";
			$code.="<input type=\"hidden\" name=\"album_id\" value=\"".$row->id."\" />";
			$code.="<input type=\"hidden\" name=\"url\" value=\"".$url."\" />";
			$code.="<input type=\"submit\" value=\""._HWDPS_EDITALBUM."\" class=\"interactbutton_sm\" onClick=\"return confirmEdit()\">";
			$code.="</form>";
		}
		return $code;
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
	function generateEditAlbumButton( $row ) {
		global $Itemid, $database, $my, $mainframe;
		$my = & JFactory::getUser();
		$c = hwd_ps_Config::get_instance();

		$code = null;
		$url = JRoute::_($_SERVER['REQUEST_URI']);
		if ( $my->id == $row->user_id ){
			$mainframe->addCustomHeadTag(hwd_ps_javascript::confirmEdit());
			$code.="<form name=\"editvideo\" style=\"display: inline;\" action=\"".JURI::root(true)."/index.php?option=com_hwdphotoshare&amp;Itemid=".$Itemid."&amp;task=editalbum\" method=\"post\">";
			$code.="<input type=\"hidden\" name=\"userid\" value=\"".$my->id."\" />";
			$code.="<input type=\"hidden\" name=\"album_id\" value=\"".$row->id."\" />";
			$code.="<input type=\"hidden\" name=\"url\" value=\"".$url."\" />";
			$code.="<input type=\"image\" src=\"".URL_HWDPS_IMAGES."icons/edit.png\" alt=\""._HWDPS_EDITALBUM."\" onClick=\"return confirmEdit()\">";
			$code.="</form>";
		}
		return $code;
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
	function generatePreviewLink( $row, $url, $thumbnail=null) {
		global $Itemid, $database, $my, $mainframe;
		$my = & JFactory::getUser();
		$c = hwd_ps_Config::get_instance();

		if (empty($thumbnail)) {
			$thumbnail = JURI::root(true).'/components/com_hwdphotoshare/assets/images/icons/eye.png';
		}
		$code = null;

		if (!defined( 'HWDVS_MB' )) {
			define( 'HWDVS_MB', 1 );
			$mainframe->addCustomHeadTag('<script type="text/javascript" src="'.JURI::root(true).'/components/com_hwdphotoshare/assets/js/slimbox.js"></script>');
			$mainframe->addCustomHeadTag('<link rel="stylesheet" type="text/css" href="'.JURI::root(true).'/components/com_hwdphotoshare/assets/css/slimbox/slimbox.css" />');
		}

		$code.='<a href="'.$url.'" rel="lightbox" title="'.$row->title.'"><img src="'.$thumbnail.'" alt="" /></a>';

		return $code;
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
		$c = hwd_ps_Config::get_instance();
  		$db =& JFactory::getDBO();

		if ($user_id == 0)
			return;

		$code = null;
		if ($c->cbavatar == 1) {
			if ($c->cbint == 2) {
				if (isset($avatar)) {
					$avatar_path = JURI::root().$avatar;
				} else {
					$avatar_path = JURI::root()."/components/com_community/assets/default.jpg";
				}

				if ($c->cbitemid !== "") { $c->cbitemid = "&Itemid=".$c->cbitemid; }
				$code = "<a href=\"".JRoute::_("index.php?option=com_community".$c->cbitemid."&view=profile&userid=".$user_id)."\"><img src=\"".$avatar_path."\" width=\"".$c->avatarwidth."\" border=\"0\" alt=\""._HWDPS_ALT_USRPRO."\" class=\"thumb".$k."\" /></a><br />";
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
				$code = "<a href=\"".JRoute::_("index.php?option=com_comprofiler".$c->cbitemid."&task=userProfile&user=".$user_id)."\"><img src=\"".$avatar_path."\" width=\"".$c->avatarwidth."\" border=\"0\" alt=\""._HWDPS_ALT_USRPRO."\" class=\"thumb".$k."\" /></a><br />";
			}
		}

		return $code;
    }
    /**
     * Generates a link to category using $cat_id, and generates the
     * category name if necessary
     *
     * @param int    $cat_id  the category id
     * @param string $category(optional)  the name of the category
     * @return       $code  the html category link
     */
	function generatePhotoURL( $row )  {
		global $Itemid, $my, $database, $mosConfig_absolute_path;
		$c = hwd_ps_Config::get_instance();

		if ($row->photo_type == "local") {
			$imagepath = JPATH_SITE."/hwdphotos/uploads/".$row->user_id."/".$row->album_id."/".$row->photo_id.".".$row->original_type;
			$imageurl = JURI::root(true)."/hwdphotos/uploads/".$row->user_id."/".$row->album_id."/".$row->photo_id.".".$row->original_type;
			if (!@fopen($imagepath, 'r')) {
				@chmod($imagepath, 0644);
				@JPath::setPermissions($imagepath, 644);
			}
		} else {
		}

		return $imageurl;
    }
    /**
     * Generates a link to category using $cat_id, and generates the
     * category name if necessary
     *
     * @param int    $cat_id  the category id
     * @param string $category(optional)  the name of the category
     * @return       $code  the html category link
     */
	function generatePhoto($row)  {
		return "<img src=\"".hwd_ps_tools::generatePhotoURL($row)."\" alt=\"\" border=\"0\">";
    }
    /**
     * Generates a link to category using $cat_id, and generates the
     * category name if necessary
     *
     * @param int    $cat_id  the category id
     * @param string $category(optional)  the name of the category
     * @return       $code  the html category link
     */
	function generatePhotoLink( $row ) {
		global $Itemid, $my, $database, $mosConfig_absolute_path;
		$c = hwd_ps_Config::get_instance();

		$code = null;
		$code.= "<a href=\"".JRoute::_("index.php?option=com_hwdphotoshare&amp;Itemid=".$Itemid."&task=viewphoto&album_id=".$row->album_id."&limitstart=".$row->ordering)."\" >";
		$code.= hwd_ps_tools::generatePhoto($row);
		$code.= "</a>";
		return $code;
    }
    /**
     * Generates a link to category using $cat_id, and generates the
     * category name if necessary
     *
     * @param int    $cat_id  the category id
     * @param string $category(optional)  the name of the category
     * @return       $code  the html category link
     */
	function generateGroupLink( $group_id, $group=null ) {
		global $Itemid, $database, $mosConfig_absolute_path;
		$c = hwd_ps_Config::get_instance();

		$code = null;
		$code.= "<a href=\"".JRoute::_("index.php?option=com_hwdphotoshare&amp;task=viewgroup&amp;Itemid=".$Itemid."&amp;group_id=".$group_id)."\">";
		if (isset($group)) {
			$code.= hwd_ps_tools::truncateText($group, $c->truntitle);
		} else {
			$code.= hwd_ps_tools::generateCategory( $cat_id );
		}
		$code.= "</a>";
		return $code;
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
	function generateFavouriteLink($row) {
		global $database, $Itemid, $smartyps, $my;
		$c = hwd_ps_Config::get_instance();
		$db = & JFactory::getDBO();
		$my = & JFactory::getUser();

		require_once(JPATH_SITE.DS.'administrator'.DS.'components'.DS.'com_hwdphotoshare'.DS.'helpers'.DS.'js.php');

		if (!defined( 'HWDVS_ATFJS' )) {
			DEFINE('HWDVS_ATFJS',1);
			hwd_ps_javascript::ajaxaddtofav($row);
		}

		// setup ajax tags
		if ($c->ajaxfavmeth == 1) {
			$ajaxremfav = 'onsubmit="ajaxFunctionRFF('.$row->id.');return false;"';
			$ajaxaddfav = 'onsubmit="ajaxFunctionATF('.$row->id.');return false;"';
		} else {
			$ajaxremfav = null;
			$ajaxaddfav = null;
		}

		$code = null;

		$userid = $my->id;
		$photoid = $row->id;

		$where = ' WHERE a.userid = '.$userid;
		$where .= ' AND a.photoid = '.$photoid;

		$db->SetQuery( 'SELECT count(*)'
					. ' FROM #__hwdpsfavorites AS a'
					. $where
					);
		$total = $db->loadResult();

		if ( $total>0 ) {
		    $code.= "<form name=\"favourite1\" ".$ajaxremfav." style=\"display: inline;\" action=\"".JURI::root(true)."/index.php?option=com_hwdphotoshare&amp;Itemid=".$Itemid."&amp;task=removefavourite\" method=\"post\">
					 <input type=\"hidden\" name=\"userid\" value=\"".$my->id."\" />
					 <input type=\"hidden\" name=\"photoid\" value=\"".$row->id."\" />
					 <input type=\"image\" src=\"".URL_HWDPS_IMAGES."icons/rff.png\" alt=\""._HWDPS_DETAILS_REMFAV."\" />
					 </form>";
		} else {
		    $code.= "<form name=\"favourite2\" ".$ajaxaddfav." style=\"display: inline;\" action=\"".JURI::root(true)."/index.php?option=com_hwdphotoshare&amp;Itemid=".$Itemid."&amp;task=favourite\" method=\"post\">
					 <input type=\"hidden\" name=\"userid\" value=\"".$my->id."\" />
					 <input type=\"hidden\" name=\"photoid\" value=\"".$row->id."\" />
					 <input type=\"image\" src=\"".URL_HWDPS_IMAGES."icons/atf.png\" alt=\""._HWDPS_DETAILS_ADDFAV."\" />
					 </form>";
		}
		return $code;
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
	function generateFavouriteButton($row) {
		global $database, $Itemid, $smartyps, $my;
		$c = hwd_ps_Config::get_instance();
		$db = & JFactory::getDBO();
		$my = & JFactory::getUser();

		require_once(JPATH_SITE.DS.'administrator'.DS.'components'.DS.'com_hwdphotoshare'.DS.'helpers'.DS.'js.php');

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
		$photoid = $row->id;

		$where = ' WHERE a.userid = '.$userid;
		$where .= ' AND a.photoid = '.$photoid;

		$db->SetQuery( 'SELECT count(*)'
					. ' FROM #__hwdpsfavorites AS a'
					. $where
					);
		$total = $db->loadResult();

		$remfav = "<form name=\"favourite1\" onsubmit=\"ajaxFunctionRFF();return false;\" action=\"".JURI::root(true)."/index.php?option=com_hwdphotoshare&amp;Itemid=".$Itemid."&amp;task=removefavourite\" method=\"post\"><input type=\"image\" src=\"".URL_HWDPS_IMAGES."icons/rff.png\" alt=\""._HWDPS_DETAILS_REMFAV."\" />&nbsp;<input type=\"submit\" value=\""._HWDPS_DETAILS_REMFAV."\" class=\"interactbutton\" /></form>";
		$addfav = "<form name=\"favourite2\" onsubmit=\"ajaxFunctionATF();return false;\" action=\"".JURI::root(true)."/index.php?option=com_hwdphotoshare&amp;Itemid=".$Itemid."&amp;task=favourite\" method=\"post\"><input type=\"image\" src=\"".URL_HWDPS_IMAGES."icons/atf.png\" alt=\""._HWDPS_DETAILS_ADDFAV."\" />&nbsp;<input type=\"submit\" value=\""._HWDPS_DETAILS_ADDFAV."\" class=\"interactbutton\" /></form>";
		hwd_ps_javascript::ajaxaddtofav($row, $remfav, $addfav);

		if ( $total>0 ) {
		    $code.= "<form name=\"favourite1\" ".$ajaxremfav." action=\"".JURI::root(true)."/index.php?option=com_hwdphotoshare&amp;Itemid=".$Itemid."&amp;task=removefavourite\" method=\"post\">
					 <input type=\"hidden\" name=\"userid\" value=\"".$my->id."\" />
					 <input type=\"hidden\" name=\"photoid\" value=\"".$row->id."\" />
					 <input type=\"image\" src=\"".URL_HWDPS_IMAGES."icons/rff.png\" alt=\""._HWDPS_DETAILS_REMFAV."\" />
					 <input type=\"submit\" value=\""._HWDPS_DETAILS_REMFAV."\" class=\"interactbutton\" />
					 </form>";
		} else {
		    $code.= "<form name=\"favourite2\" ".$ajaxaddfav." action=\"".JURI::root(true)."/index.php?option=com_hwdphotoshare&amp;Itemid=".$Itemid."&amp;task=favourite\" method=\"post\">
					 <input type=\"hidden\" name=\"userid\" value=\"".$my->id."\" />
					 <input type=\"hidden\" name=\"photoid\" value=\"".$row->id."\" />
					 <input type=\"image\" src=\"".URL_HWDPS_IMAGES."icons/atf.png\" alt=\""._HWDPS_DETAILS_ADDFAV."\" />
					 <input type=\"submit\" value=\""._HWDPS_DETAILS_ADDFAV."\" class=\"interactbutton\" />
					 </form>";
		}
		return $code;
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
	function generateReportMediaButton($row) {
		global $database, $Itemid, $smartyps, $my;
		$c = hwd_ps_Config::get_instance();

		// setup ajax tags
		if ($c->ajaxrepmeth == 1) { $ajaxrep = "onsubmit=\"ajaxFunctionRV();return false;\""; } else { $ajaxrep = null; }

		$code = null;

		$code.= "<form name=\"share\" ".$ajaxrep." action=\"index.php?option=com_hwdphotoshare&amp;Itemid=".$Itemid."&amp;task=flagvideo\" method=\"post\">
				 <input type=\"hidden\" name=\"userid\" value=\"".$my->id."\" />
				 <input type=\"hidden\" name=\"videoid\" value=\"".$row->id."\" />
				 <input type=\"image\" src=\"".URL_HWDPS_IMAGES."icons/flag.png\" alt=\""._HWDPS_REPORT_PHOTO."\" id=\"reportvidbutton\" />
				 <input type=\"submit\" value=\""._HWDPS_REPORT_PHOTO."\" class=\"interactbutton\" />
				 </form>";

		return $code;
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
	function generateReportMediaLink($row) {
		global $database, $Itemid, $smartyps, $my;
		$c = hwd_ps_Config::get_instance();
		$my = & JFactory::getUser();

		require_once(JPATH_SITE.DS.'administrator'.DS.'components'.DS.'com_hwdphotoshare'.DS.'helpers'.DS.'js.php');

		if (!defined( 'HWDVS_RPJS' )) {
			DEFINE('HWDVS_RPJS',1);
			hwd_ps_javascript::ajaxReportMedia($row);
		}

		// setup ajax tags
		if ($c->ajaxrepmeth == 1) { $ajaxrep = 'onsubmit="ajaxFunctionReportPhoto('.$row->id.');return false;"'; } else { $ajaxrep = null; }

		$code = null;

		$code.= "<form name=\"share\" ".$ajaxrep." style=\"display: inline;\" action=\"index.php?option=com_hwdphotoshare&amp;Itemid=".$Itemid."&amp;task=reportphoto\" method=\"post\">
				 <input type=\"hidden\" name=\"userid\" value=\"".$my->id."\" />
				 <input type=\"hidden\" name=\"photoid\" value=\"".$row->id."\" />
				 <input type=\"image\" src=\"".URL_HWDPS_IMAGES."icons/flag.png\" alt=\""._HWDPS_REPORT_PHOTO."\" id=\"reportphotobutton\" />
				 </form>";

		return $code;
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
	function generateRatingSystem($row) {

		global $mainframe;
		$c = hwd_ps_Config::get_instance();
		$code = null;

		if ( $row->allow_ratings == 1 ) {

			if ($row->rating_number_votes < 1) {
				$count = 0;
			} else {
				$count = $row->rating_number_votes; //how many votes total
			}
			$tense = ($count==1) ? _HWDPS_INFO_M_VOTE : _HWDPS_INFO_M_VOTES; //plural form votes/vote

			$rating0 = @number_format($row->rating_total_points/$count,0);
			$rating1 = @number_format($row->rating_total_points/$count,1);

			$code='<div id="hwdpsrb"><ul id="1001" class="rating rated'.$rating0.'star">
			  <li id="1" class="rate one"><a href="'.JURI::root( true ).'/index.php?option=com_hwdphotoshare&task=rate&photoid='.$row->id.'&rating=1" onclick="ajaxFunctionRate(1);return false;" title="1 Star">1</a></li>
			  <li id="2" class="rate two"><a href="'.JURI::root( true ).'/index.php?option=com_hwdphotoshare&task=rate&photoid='.$row->id.'&rating=2" onclick="ajaxFunctionRate(2);return false;" title="2 Stars">2</a></li>
			  <li id="3" class="rate three"><a href="'.JURI::root( true ).'/index.php?option=com_hwdphotoshare&task=rate&photoid='.$row->id.'&rating=3" onclick="ajaxFunctionRate(3);return false;" title="3 Stars">3</a></li>
			  <li id="4" class="rate four"><a href="'.JURI::root( true ).'/index.php?option=com_hwdphotoshare&task=rate&photoid='.$row->id.'&rating=4" onclick="ajaxFunctionRate(4);return false;" title="4 Stars">4</a></li>
			  <li id="5" class="rate five"><a href="'.JURI::root( true ).'/index.php?option=com_hwdphotoshare&task=rate&photoid='.$row->id.'&rating=5" onclick="ajaxFunctionRate(5);return false;" title="5 Stars">5</a></li>
			</ul>
			<div>'._HWDPS_INFO_RATED.'<strong> '.$rating1.'</strong> ('.$count.' '.$tense.')</div>
			<script>
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
			</script>
			</div>';

		}
		return $code;

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
    function generateSocialBookmarks()
	{
	global $mainframe;
	$c = hwd_ps_Config::get_instance();

		$sbtitle = rawurlencode($mainframe->getPageTitle());
		$sburl = rawurlencode(hwd_ps_tools::getSelfURL());
		$jrandom = rand(1000, 9999);
		$bmhtml = null;

  			//digg
			if ($c->sb_digg == "on") {
			$temphtml = '<a rel="nofollow" href="http://digg.com/submit?phase=2&amp;url='. $sburl .'&amp;title='. $sbtitle .'" title="Digg!" target="_blank"><img height="18" width="18" src="'.URL_HWDPS_IMAGES.'socialbookmarker/digg.png" alt="Digg!" title="Digg!" class="sblinks" /></a>';
			$bmhtml = $bmhtml . $temphtml;
			}
			//reddit
			if ($c->sb_reddit == "on") {
			$temphtml = '<a rel="nofollow" href="http://reddit.com/submit?url='. $sburl .'&amp;title='. $sbtitle .'" title="Reddit!" target="_blank"><img height="18" width="18" src="'.URL_HWDPS_IMAGES.'socialbookmarker/reddit.png" alt="Reddit!" title="Reddit!" class="sblinks" /></a>';
			$bmhtml = $bmhtml . $temphtml;
			}
			//delicious
			if ($c->sb_delicious == "on") {
			$temphtml = '<a rel="nofollow" href="http://del.icio.us/post?url='. $sburl .'&amp;title='. $sbtitle .'" title="Del.icio.us!" target="_blank"><img height="18" width="18" src="'.URL_HWDPS_IMAGES.'socialbookmarker/delicious.png" alt="Del.icio.us!" title="Del.icio.us!" class="sblinks" /></a>';
			$bmhtml = $bmhtml . $temphtml;
			}
			//google
			if ($c->sb_google == "on") {
			$temphtml = '<a rel="nofollow" href="http://www.google.com/bookmarks/mark?op=add&amp;bkmk='. $sburl .'&amp;title='. $sbtitle .'" title="Google!" target="_blank"><img height="18" width="18" src="'.URL_HWDPS_IMAGES.'socialbookmarker/google.png" alt="Google!" title="Google!" class="sblinks" /></a>';
			$bmhtml = $bmhtml . $temphtml;
			}
			//live
			if ($c->sb_live == "on") {
			$temphtml = '<a rel="nofollow" href="https://favorites.live.com/quickadd.aspx?marklet=1&amp;mkt=en-us&amp;top=0&amp;url='. $sburl .'&amp;title='. $sbtitle .'" title="Live!" target="_blank"><img height="18" width="18" src="'.URL_HWDPS_IMAGES.'socialbookmarker/live.png" alt="Live!" title="Live!" class="sblinks" /></a>';
			$bmhtml = $bmhtml . $temphtml;
			}
			//facebook
			if ($c->sb_facebook == "on") {
			$temphtml = '<a rel="nofollow" href="http://www.facebook.com/share.php?u='. $sburl .'&amp;t='. $sbtitle .'" title="Facebook!" target="_blank"><img height="18" width="18" src="'.URL_HWDPS_IMAGES.'socialbookmarker/facebook.png" alt="Facebook!" title="Facebook!" class="sblinks" /></a>';
			$bmhtml = $bmhtml . $temphtml;
			}
			//slashdot
			if ($c->sb_slashdot == "on") {
			$temphtml = '<a rel="nofollow" href="http://slashdot.org/bookmark.pl?url='. $sburl .'&amp;title='. $sbtitle .'" title="Slashdot!" target="_blank"><img height="18" width="18" src="'.URL_HWDPS_IMAGES.'socialbookmarker/slashdot.png" alt="Slashdot!" title="Slashdot!" class="sblinks" /></a>';
			$bmhtml = $bmhtml . $temphtml;
			}
			//netscape
			if ($c->sb_netscape == "on") {
			$temphtml = '<a rel="nofollow" href="http://www.netscape.com/submit/?U='. $sburl .'&amp;T='. $sbtitle .'" title="Netscape!" target="_blank"><img height="18" width="18" src="'.URL_HWDPS_IMAGES.'socialbookmarker/netscape.png" alt="Netscape!" title="Netscape!" class="sblinks" /></a>';
			$bmhtml = $bmhtml . $temphtml;
			}
			//technorati
			if ($c->sb_technorati == "on") {
			$temphtml = '<a rel="nofollow" href="http://technorati.com/faves/?add='. $sburl .'" title="Technorati!" target="_blank"><img src="'.URL_HWDPS_IMAGES.'socialbookmarker/technorati.png" alt="Technorati!" title="Technorati!" class="sblinks" /></a>';
			$bmhtml = $bmhtml . $temphtml;
			}
			//stumbleupon
			if ($c->sb_stumbleupon == "on") {
			$temphtml = '<a rel="nofollow" href="http://www.stumbleupon.com/submit?url='. $sburl .'&amp;title='. $sbtitle .'" title="StumbleUpon!" target="_blank"><img src="'.URL_HWDPS_IMAGES.'socialbookmarker/stumbleupon.png" alt="StumbleUpon!" title="StumbleUpon!" class="sblinks" /></a>';
			$bmhtml = $bmhtml . $temphtml;
			}
			//spurl
			if ($c->sb_spurl == "on") {
			$temphtml = '<a rel="nofollow" href="http://www.spurl.net/spurl.php?url='. $sburl .'&amp;title='. $sbtitle .'" title="Spurl!" target="_blank"><img src="'.URL_HWDPS_IMAGES.'socialbookmarker/spurl.png" alt="Spurl!" title="Spurl!" class="sblinks" /></a>';
			$bmhtml = $bmhtml . $temphtml;
			}
			//wists
			if ($c->sb_wists == "on") {
			$temphtml = '<a rel="nofollow" href="http://wists.com/r.php?r='. $sburl .'&amp;title='. $sbtitle .'" title="Wists!" target="_blank"><img src="'.URL_HWDPS_IMAGES.'socialbookmarker/wists.png" alt="Wists!" title="Wists!" class="sblinks" /></a>';
			$bmhtml = $bmhtml . $temphtml;
			}
			//simpy
			if ($c->sb_simpy == "on") {
			$temphtml = '<a rel="nofollow" href="http://www.simpy.com/simpy/LinkAdd.do?href='. $sburl .'&amp;title='. $sbtitle .'" title="Simpy!" target="_blank"><img src="'.URL_HWDPS_IMAGES.'socialbookmarker/simpy.png" alt="Simpy!" title="Simpy!" class="sblinks" /></a>';
			$bmhtml = $bmhtml . $temphtml;
			}
			//newsvine
			if ($c->sb_newsvine == "on") {
			$temphtml = '<a rel="nofollow" href="http://www.newsvine.com/_tools/seed&amp;save?u='. $sburl .'&amp;h='. $sbtitle .'" title="Newsvine!" target="_blank"><img src="'.URL_HWDPS_IMAGES.'socialbookmarker/newsvine.png" alt="Newsvine!" title="Newsvine!" class="sblinks" /></a>';
			$bmhtml = $bmhtml . $temphtml;
			}
			//blinklist
			if ($c->sb_blinklist == "on") {
			$temphtml = '<a rel="nofollow" href="http://www.blinklist.com/index.php?Action=Blink/addblink.php&amp;Url='. $sburl .'&amp;Title='. $sbtitle .'" title="Blinklist!" target="_blank"><img src="'.URL_HWDPS_IMAGES.'socialbookmarker/blinklist.png" alt="Blinklist!" title="Blinklist!" class="sblinks" /></a>';
			$bmhtml = $bmhtml . $temphtml;
			}
			//furl
			if ($c->sb_furl == "on") {
			$temphtml = '<a rel="nofollow" href="http://www.furl.net/storeIt.jsp?u='. $sburl .'&amp;t='. $sbtitle .'" title="Furl!" target="_blank"><img src="'.URL_HWDPS_IMAGES.'socialbookmarker/furl.png" alt="Furl!" title="Furl!" class="sblinks" /></a>';
			$bmhtml = $bmhtml . $temphtml;
			}
			//fark
			if ($c->sb_fark == "on") {
			$temphtml = '<a rel="nofollow" href="http://cgi.fark.com/cgi/fark/submit.pl?new_url='. $sburl .'" title="Fark!" target="_blank"><img src="'.URL_HWDPS_IMAGES.'socialbookmarker/fark.png" alt="Fark!" title="Fark!" class="sblinks" /></a>';
			$bmhtml = $bmhtml . $temphtml;
			}
			//blogmarks
			if ($c->sb_blogmarks == "on") {
			$temphtml = '<a rel="nofollow" href="http://blogmarks.net/my/new.php?mini=1&amp;simple=1&amp;url='. $sburl .'&amp;title='. $sbtitle .'" title="Blogmarks!" target="_blank"><img src="'.URL_HWDPS_IMAGES.'socialbookmarker/blogmarks.png" alt="Blogmarks!" title="Blogmarks!" class="sblinks" /></a>';
			$bmhtml = $bmhtml . $temphtml;
			}
			//yahoo
			if ($c->sb_yahoo == "on") {
			$temphtml = '<a rel="nofollow" href="http://myweb2.search.yahoo.com/myresults/bookmarklet?u='. $sburl .'&amp;t='. $sbtitle .'" title="Yahoo!" target="_blank"><img src="'.URL_HWDPS_IMAGES.'socialbookmarker/yahoo.png" alt="Yahoo!" title="Yahoo!" class="sblinks" /></a>';
			$bmhtml = $bmhtml . $temphtml;
			}
			//smarking
			if ($c->sb_smarking == "on") {
			$temphtml = '<a rel="nofollow" href="http://smarking.com/editbookmark/?url='. $sburl .'" title="Smarking!" target="_blank"><img src="'.URL_HWDPS_IMAGES.'socialbookmarker/smarking.png" alt="Smarking!" title="Smarking!" class="sblinks" /></a>';
			$bmhtml = $bmhtml . $temphtml;
			}
			//netvouz
			if ($c->sb_netvouz == "on") {
			$temphtml = '<a rel="nofollow" href="http://www.netvouz.com/action/submitBookmark?url='. $sburl .'&amp;title='. $sbtitle .'" title="Smarking!" target="_blank"><img src="'.URL_HWDPS_IMAGES.'socialbookmarker/netvouz.png" alt="Netvouz!" title="Netvouz!" class="sblinks" /></a>';
			$bmhtml = $bmhtml . $temphtml;
			}
			//shadows
			if ($c->sb_shadows == "on") {
			$temphtml = '<a rel="nofollow" href="http://www.shadows.com/bookmark/saveLink.rails?page='. $sburl .'&amp;title='. $sbtitle .'" title="Shadows!" target="_blank"><img src="'.URL_HWDPS_IMAGES.'socialbookmarker/shadows.png" alt="Shadows!" title="Shadows!" class="sblinks" /></a>';
			$bmhtml = $bmhtml . $temphtml;
			}
			//rawsugar
			if ($c->sb_rawsugar == "on") {
			$temphtml = '<a rel="nofollow" href="http://www.rawsugar.com/tagger/?turl='. $sburl .'&amp;title='. $sbtitle .'" title="RawSugar!" target="_blank"><img src="'.URL_HWDPS_IMAGES.'socialbookmarker/rawsugar.png" alt="RawSugar!" title="RawSugar!" class="sblinks" /></a>';
			$bmhtml = $bmhtml . $temphtml;
			}
			//magnolia
			if ($c->sb_magnolia == "on") {
			$temphtml = '<a rel="nofollow" href="http://ma.gnolia.com/beta/bookmarklet/add?url='. $sburl .'&amp;title='. $sbtitle .'" title="Ma.gnolia!" target="_blank"><img src="'.URL_HWDPS_IMAGES.'socialbookmarker/magnolia.png" alt="Ma.gnolia!" title="Ma.gnolia!" class="sblinks" /></a>';
			$bmhtml = $bmhtml . $temphtml;
			}
			//plugim
			if ($c->sb_plugim == "on") {
			$temphtml = '<a rel="nofollow" href="http://www.plugim.com/submit?url='. $sburl .'&amp;title='. $sbtitle .'" title="PlugIM!" target="_blank"><img src="'.URL_HWDPS_IMAGES.'socialbookmarker/plugim.png" alt="PlugIM!" title="PlugIM!" class="sblinks" /></a>';
			$bmhtml = $bmhtml . $temphtml;
			}
			//squidoo
			if ($c->sb_squidoo == "on") {
			$temphtml = '<a rel="nofollow" href="http://www.squidoo.com/lensmaster/bookmark?'. $sburl .'" title="Squidoo!" target="_blank"><img src="'.URL_HWDPS_IMAGES.'socialbookmarker/squidoo.png" alt="Squidoo!" title="Squidoo!" class="sblinks" /></a>';
			$bmhtml = $bmhtml . $temphtml;
			}
			//blogmemes
			if ($c->sb_blogmemes == "on") {
			$temphtml = '<a rel="nofollow" href="http://www.blogmemes.net/post.php?url='. $sburl .'&amp;title='. $sbtitle .'" title="BlogMemes!" target="_blank"><img src="'.URL_HWDPS_IMAGES.'socialbookmarker/blogmemes.png" alt="BlogMemes!" title="BlogMemes!" class="sblinks" /></a>';
			$bmhtml = $bmhtml . $temphtml;
			}
			//feedmelinks
			if ($c->sb_feedmelinks == "on") {
			$temphtml = '<a rel="nofollow" href="http://feedmelinks.com/categorize?from=toolbar&amp;op=submit&amp;url='. $sburl .'&amp;name='. $sbtitle .'" title="FeedMeLinks!" target="_blank"><img src="'.URL_HWDPS_IMAGES.'socialbookmarker/feedmelinks.png" alt="FeedMeLinks!" title="FeedMeLinks!" class="sblinks" /></a>';
			$bmhtml = $bmhtml . $temphtml;
			}
			//blinkbits
			if ($c->sb_blinkbits == "on") {
			$temphtml = '<a rel="nofollow" href="http://www.blinkbits.com/bookmarklets/save.php?v=1&amp;source_url='. $sburl .'&amp;title='. $sbtitle .'" title="BlinkBits!" target="_blank"><img src="'.URL_HWDPS_IMAGES.'socialbookmarker/blinkbits.png" alt="BlinkBits!" title="BlinkBits!" class="sblinks" /></a>';
			$bmhtml = $bmhtml . $temphtml;
			}
			//tailrank
			if ($c->sb_tailrank == "on") {
			$temphtml = '<a rel="nofollow" href="http://tailrank.com/share/?text=&amp;link_href='. $sburl .'&amp;title='. $sbtitle .'" title="Tailrank!" target="_blank"><img src="'.URL_HWDPS_IMAGES.'socialbookmarker/tailrank.png" alt="Tailrank!" title="Tailrank!" class="sblinks" /></a>';
			$bmhtml = $bmhtml . $temphtml;
			}
			//linkagogo
			if ($c->sb_linkagogo == "on") {
			$temphtml = '<a rel="nofollow" href="http://www.linkagogo.com/go/AddNoPopup?url='. $sburl .'&amp;title='. $sbtitle .'" title="linkaGoGo!" target="_blank"><img src="'.URL_HWDPS_IMAGES.'socialbookmarker/linkagogo.png" alt="linkaGoGo!" title="linkaGoGo!" class="sblinks" /></a>';
			$bmhtml = $bmhtml . $temphtml;
			}

		$code = $bmhtml;
		return $code;
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
	function generateGroupMembershipStatus( $row ) {
		global $Itemid, $database, $my, $mosConfig_absolute_path;
  		$db =& JFactory::getDBO();
		$my = & JFactory::getUser();
		$c = hwd_ps_Config::get_instance();

		$code = null;
		if ( !$my->id ){ return $code; }

		$url = JRoute::_($_SERVER['REQUEST_URI']);

		$db->SetQuery( 'SELECT count(*)'
				. ' FROM #__hwdpsgroup_membership'
				. ' WHERE groupid = '.$row->id
				. ' AND memberid = '.$my->id
				);
		$total = $db->loadResult();
		echo $db->getErrorMsg();

		if ($total > 0) {
			$code.="<form name=\"leavegroup\" style=\"display: inline;\" action=\"".JURI::root(true)."/index.php?option=com_hwdphotoshare&amp;Itemid=".$Itemid."&amp;task=leavegroup\" method=\"post\">";
			$code.="<input type=\"hidden\" name=\"memberid\" value=\"".$my->id."\" />";
			$code.="<input type=\"hidden\" name=\"groupid\" value=\"".$row->id."\" />";
			$code.="<input type=\"hidden\" name=\"url\" value=\"".$url."\" />";
			$code.="<input type=\"image\" src=\"".URL_HWDPS_IMAGES."icons/group_delete.png\" alt=\""._HWDPS_DETAILS_LEAVEG."\">&nbsp;";
			$code.="<input type=\"submit\" value=\""._HWDPS_DETAILS_LEAVEG."\" class=\"interactbutton\">";
			$code.="</form>";
		} else {
			$code.="<form name=\"joingroup\" style=\"display: inline;\" action=\"".JURI::root(true)."/index.php?option=com_hwdphotoshare&amp;Itemid=".$Itemid."&amp;task=joingroup\" method=\"post\">";
			$code.="<input type=\"hidden\" name=\"memberid\" value=\"".$my->id."\" />";
			$code.="<input type=\"hidden\" name=\"groupid\" value=\"".$row->id."\" />";
			$code.="<input type=\"hidden\" name=\"url\" value=\"".$url."\" />";
			$code.="<input type=\"image\" src=\"".URL_HWDPS_IMAGES."icons/group_add.png\" alt=\""._HWDPS_DETAILS_JOING."\">&nbsp;";
			$code.="<input type=\"submit\" value=\""._HWDPS_DETAILS_JOING."\" class=\"interactbutton\">";
			$code.="</form>";
		}
		return $code;
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
	function generateDeleteGroupButton( $row ) {
		global $Itemid, $database, $mainframe, $my, $mosConfig_absolute_path;
		$my = & JFactory::getUser();
		$c = hwd_ps_Config::get_instance();

		$code = null;
		$url = JRoute::_($_SERVER['REQUEST_URI']);
		if ( $my->id == $row->adminid ){
			$mainframe->addCustomHeadTag(hwd_ps_javascript::confirmDelete());
			$code.="<form name=\"deletegroup\" style=\"display: inline;\" action=\"".JURI::root(true)."/index.php?option=com_hwdphotoshare&amp;Itemid=".$Itemid."&amp;task=deletegroup\" method=\"post\">";
			$code.="<input type=\"hidden\" name=\"userid\" value=\"".$my->id."\" />";
			$code.="<input type=\"hidden\" name=\"groupid\" value=\"".$row->id."\" />";
			$code.="<input type=\"hidden\" name=\"url\" value=\"".$url."\" />";
			$code.="<input type=\"image\" src=\"".URL_HWDPS_IMAGES."icons/delete.png\" alt=\""._HWDPS_DELETEG."\" onClick=\"return confirmDelete()\">";
			$code.="<input type=\"submit\" value=\""._HWDPS_DELETEG."\" class=\"interactbutton\" onClick=\"return confirmDelete()\">";
			$code.="</form>";
		}
		return $code;
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
	function generateDeleteGroupLink( $row ) {
		global $Itemid, $database, $my, $mainframe, $mosConfig_absolute_path;
		$my = & JFactory::getUser();
		$c = hwd_ps_Config::get_instance();

		$code = null;
		$url = JRoute::_($_SERVER['REQUEST_URI']);
		if ( $my->id == $row->adminid ){
			$mainframe->addCustomHeadTag(hwd_ps_javascript::confirmDelete());
			$code.="<form name=\"deletegroup\" style=\"display: inline;\" action=\"".JURI::root(true)."/index.php?option=com_hwdphotoshare&amp;Itemid=".$Itemid."&amp;task=deletegroup\" method=\"post\">";
			$code.="<input type=\"hidden\" name=\"userid\" value=\"".$my->id."\" />";
			$code.="<input type=\"hidden\" name=\"groupid\" value=\"".$row->id."\" />";
			$code.="<input type=\"hidden\" name=\"url\" value=\"".$url."\" />";
			$code.="<input type=\"image\" src=\"".URL_HWDPS_IMAGES."icons/delete.png\" alt=\""._HWDPS_DELETEG."\"  onClick=\"return confirmDelete()\">";
			$code.="</form>";
		}
		return $code;
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
	function generateEditGroupButton( $row ) {
		global $Itemid, $database, $my, $mainframe, $mosConfig_absolute_path;
		$my = & JFactory::getUser();
		$c = hwd_ps_Config::get_instance();

		$code = null;
		$url = JRoute::_($_SERVER['REQUEST_URI']);
		if ( $my->id == $row->adminid ){
			$mainframe->addCustomHeadTag(hwd_ps_javascript::confirmEdit());
			$code.="<form name=\"editgroup\" style=\"display: inline;\" action=\"".JURI::root(true)."/index.php?option=com_hwdphotoshare&amp;Itemid=".$Itemid."&amp;task=editgroup\" method=\"post\">";
			$code.="<input type=\"hidden\" name=\"userid\" value=\"".$my->id."\" />";
			$code.="<input type=\"hidden\" name=\"groupid\" value=\"".$row->id."\" />";
			$code.="<input type=\"hidden\" name=\"url\" value=\"".$url."\" />";
			$code.="<input type=\"image\" src=\"".URL_HWDPS_IMAGES."icons/edit.png\" alt=\""._HWDPS_EDITG."\"  onClick=\"return confirmEdit()\">";
			$code.="<input type=\"submit\" value=\""._HWDPS_EDITG."\" class=\"interactbutton\"  onClick=\"return confirmEdit()\">";
			$code.="</form>";
		}
		return $code;
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
	function generateEditGroupLink( $row ) {
		global $Itemid, $database, $my, $mainframe, $mosConfig_absolute_path;
		$my = & JFactory::getUser();
		$c = hwd_ps_Config::get_instance();

		$code = null;
		$url = JRoute::_($_SERVER['REQUEST_URI']);
		if ( $my->id == $row->adminid ){
			$mainframe->addCustomHeadTag(hwd_ps_javascript::confirmEdit());
			$code.="<form name=\"editgroup\" style=\"display: inline;\" action=\"".JURI::root(true)."/index.php?option=com_hwdphotoshare&amp;Itemid=".$Itemid."&amp;task=editgroup\" method=\"post\">";
			$code.="<input type=\"hidden\" name=\"userid\" value=\"".$my->id."\" />";
			$code.="<input type=\"hidden\" name=\"groupid\" value=\"".$row->id."\" />";
			$code.="<input type=\"hidden\" name=\"url\" value=\"".$url."\" />";
			$code.="<input type=\"image\" src=\"".URL_HWDPS_IMAGES."icons/edit.png\" alt=\""._HWDPS_EDITG."\"  onClick=\"return confirmEdit()\">";
			$code.="</form>";
		}
		return $code;
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
	function generateReportGroupButton( $row ) {
		global $Itemid, $database, $my, $mosConfig_absolute_path;
		$my = & JFactory::getUser();
		$c = hwd_ps_Config::get_instance();

		$code = null;
		if ( !$my->id ){ return $code; }

		$url = JRoute::_($_SERVER['REQUEST_URI']);

			$code.="<form name=\"reportgroup\" style=\"display: inline;\" action=\"".JURI::root(true)."/index.php?option=com_hwdphotoshare&amp;Itemid=".$Itemid."&amp;task=flaggroup\" method=\"post\">";
			$code.="<input type=\"hidden\" name=\"userid\" value=\"".$my->id."\" />";
			$code.="<input type=\"hidden\" name=\"groupid\" value=\"".$row->id."\" />";
			$code.="<input type=\"hidden\" name=\"url\" value=\"".$url."\" />";
			$code.="<input type=\"image\" src=\"".URL_HWDPS_IMAGES."icons/flag.png\" alt=\""._HWDPS_DETAILS_REPORTG."\">&nbsp;";
			$code.="<input type=\"submit\" value=\""._HWDPS_DETAILS_REPORTG."\" class=\"interactbutton\">";
			$code.="</form>";

		return $code;
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
	function generateAlbumSelectList($header, $selid, $nocatsmess, $pub = 0, $cname = "album_id", $checkaccess = 1, $own = null) {
		global $database, $Itemid, $smartyps, $my;
  		$db =& JFactory::getDBO();
		$c = hwd_ps_Config::get_instance();

        $where = '';
        if ($pub) {
        	$where.= "\nWHERE published = 1";
        	if (!empty($own)) {
        		$where.= "\nAND user_id = ".$own;
        	}
        } else {
        	if (!empty($own)) {
        		$where.= "\nAND user_id = ".$own;
        	}
        }

		$db->setQuery("SELECT * from #__hwdpsalbums"
		                . $where
		                . "\nORDER BY title"
		                );
		$rows_albums = $db->loadObjectList();

		$nocats = 0;

		//if ($checkaccess) {
		//	// check component access settings and deny those without privileges
		//	if ($c->access_method == 0) {
		//		if (!hwd_ps_access::allowAccess( $v->access_u, $v->access_u_r, hwd_ps_access::userGID( $my->id ))) {
		//			continue;
		//		}
		//	} else if ($c->access_method == 1) {
		//		if (!hwd_ps_access::allowLevelAccess( $v->access_lev_u, hwd_ps_access::userGID( $my->id ))) {
		//			continue;
		//		}
		//	}
		//}


		$mitems = array ();
		if (count($rows_albums) == 0) {
			$mitems[] = JHTML::_('select.option', '0', $nocatsmess);
		} else {
			$mitems[] = JHTML::_('select.option', '0', $header);
		}

		foreach ($rows_albums as $item)
		{
			$mitems[] = JHTML::_('select.option', $item->id, $item->title);
		}

		// build the html select list
		$code = hwd_ps_tools::selectList2($mitems, $cname, 'class="inputbox"', 'value', 'text', $selid);
		return $code;
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
	function generateAddToGroupButton($row) {
		global $database, $Itemid, $smartyps, $my;
		$c = hwd_ps_Config::get_instance();

		// setup ajax tags
	    if ($c->ajaxa2gmeth == 1) { $ajaxa2g = "onsubmit=\"ajaxFunctionA2G();return false;\""; } else { $ajaxa2g = null; }

		$code = null;

		$db->SetQuery( 'SELECT count(*)'
							. ' FROM #__hwdpsgroup_membership AS a'
							. ' LEFT JOIN #__hwdpsgroups AS l ON l.id = a.groupid'
							. ' WHERE a.memberid = '.$my->id
							);
		$total = $db->loadResult();
		echo $db->getErrorMsg();

		if ($total > 0) {

			$query = 'SELECT a.*, l.*'
								. ' FROM #__hwdpsgroup_membership AS a'
								. ' LEFT JOIN #__hwdpsgroups AS l ON l.id = a.groupid'
								. ' WHERE a.memberid = '.$my->id
								. ' ORDER BY a.memberid'
								;

			$db->SetQuery($query);
			$grows = $db->loadObjectList();

			$code.= "<form name=\"add2group\" ".$ajaxa2g." action=\"".JURI::root(true)."/index.php?option=com_hwdphotoshare&Itemid=".$Itemid."&task=addv2g\" method=\"post\">";
			$code.= "<input type=\"hidden\" name=\"userid\" value=\"".$my->id."\" />";
			$code.= "<input type=\"hidden\" name=\"videoid\" value=\"".$row->id."\" />";
			$code.= "<select name=\"groupid\" class=\"add2gselect\">";
			$code.= "<option value=\"0\">"._HWDPS_DETAILS_A2G."</option>";
				$n=count($grows);
				for ($i=0, $n=count($grows); $i < $n; $i++) {
					$grow = $grows[$i];
					$code.= "<option value =\"".$grow->id."\">".$grow->group_name."</option>";
				}
			$code.= "</select>&nbsp;";
			$code.= "<input type=\"submit\" value=\""._HWDCOURSES_BUTTON_ADD."\" id=\"add2groupbutton\" class=\"interactbutton\" />";
			$code.= "</form>";

		}

		return $code;
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
	function generateGroupComments($row) {
		global $Itemid, $smartyps, $my;
		$c = hwd_ps_Config::get_instance();

		$code = null;

		if ( $c->showcoms ==1 && $row->allow_comments == 1 ) {
		$smartyps->assign("print_comments", 1);
			if ( $c->commssys == 0 ) {
				if (!file_exists(HWDPSPATH."/../../components/com_jcomments/")) {
					$code.= _HWDPS_INFO_NOINS_JCOMMENTS;
				} else {
					$comments = HWDPSPATH . '/../../components/com_jcomments/jcomments.php';
					if (file_exists( $comments )) {
						require_once( $comments );
						$comments = JComments::showComments( $row->id, 'com_hwdphotoshare_g', $row->title );
			            $code.= $comments;
					}
				}
			} else if ( $c->commssys == 3 ) {
				// joomla1.5
				if (!file_exists(HWDPSPATH."/../../plugins/content/jom_comment_bot.php")) {
					$code.= _HWDPS_INFO_NOINS_JOMCOMMENTS;
				} else {
					include_once(HWDPSPATH. "/../../plugins/content/jom_comment_bot.php");
					$comments = jomcomment( $row->id, 'com_hwdphotoshare_g' );
					$code.= $comments;
				}
			}
		}
		$smartyps->assign("comment_code", $code);
		return $code;
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
	function generateAllowedFormats() {
		global $Itemid, $database, $mosConfig_absolute_path;
		$c = hwd_ps_Config::get_instance();

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
		$c = hwd_ps_Config::get_instance();
  		$db =& JFactory::getDBO();

		if (!isset($user_id) || $user_id == 0)
			return _HWDPS_INFO_GUEST;

		//if ($c->userdisplay == 1) {
			if (!isset($username) || empty($username)) {
				$query = 'SELECT username FROM #__users WHERE id = '.$user_id;
				$db->SetQuery( $query );
				$displayname = $db->loadResult();
			} else {
				$displayname = $username;
			}
		//} else {
		//	if (!isset($name) || empty($name)) {
		//		$query = 'SELECT name FROM #__users WHERE id = '.$user_id;
		//		$db->SetQuery( $query );
		//		$displayname = $db->loadResult();
		//	} else {
		//		$displayname = $name;
		//	}
		//}

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
     * Outputs frontpage HTML
     *
     * @param string $option  the joomla component name
     * @param array  $rows  array of video data
     * @param array  $rowsfeatured  array of featured video data
     * @param object $pageNav  page navigation object
     * @param int    $total  the total video count
     * @return       Nothing
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
     * Outputs frontpage HTML
     *
     * @param string $option  the joomla component name
     * @param array  $rows  array of video data
     * @param array  $rowsfeatured  array of featured video data
     * @param object $pageNav  page navigation object
     * @param int    $total  the total video count
     * @return       Nothing
     */
	function generateBEUserFromID( $user_id=null ) {
		global $Itemid, $database, $mosConfig_absolute_path;
  		$db =& JFactory::getDBO();
		$c = hwd_ps_Config::get_instance();
		$code = null;
		if (!isset($user_id)) {
			$code = _HWDPS_INFO_GUEST;
		} else {
			// find user
			$query = 'SELECT username FROM #__users WHERE id = '.$user_id;
			$db->SetQuery( $query );
			$user = $db->loadResult();
			if ($c->cbint == 1) {
				if ($c->cbitemid !== "") { $c->cbitemid = "&amp;Itemid=".$c->cbitemid; }
				$code = "<a href=\"index.php?option=com_comprofiler&task=edit&cid=".$user_id."\">".$user."</a>";
			} else {
				$code = "<a href=\"index.php?option=com_users&task=editA&id=".$user_id."&hidemainmenu=1\">".$user."</a>";
			}
		}
		return $code;
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
	function generateNewPhotoid( $length=13 ) {
		global $Itemid, $database, $mosConfig_absolute_path;
		$c = hwd_ps_Config::get_instance();

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
     * Outputs frontpage HTML
     *
     * @param string $option  the joomla component name
     * @param array  $rows  array of video data
     * @param array  $rowsfeatured  array of featured video data
     * @param object $pageNav  page navigation object
     * @param int    $total  the total video count
     * @return       Nothing
     */
	function generateExactRating( $row ) {
		global $Itemid, $database, $mosConfig_absolute_path;
		$c = hwd_ps_Config::get_instance();

		$code =null;
		if ((isset($row->rating_total_points) && $row->rating_total_points !== "0") && (isset($row->rating_number_votes) && $row->rating_number_votes !== "0") ) {
			$code = $row->rating_total_points/$row->rating_number_votes;
		} else {
			$code = "0";
		}
		return $code;
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
	function generateRatingImg( $rating ) {
		global $Itemid, $database, $mosConfig_absolute_path;
		$c = hwd_ps_Config::get_instance();

		$code =null;
		// set default rating values
		if (!isset($rating)) { $rating = "0"; }
		$code = "<img src=\"".JURI::root(true)."/components/com_hwdphotoshare/images/ratings/stars".$rating."0.png\" width=\"80\" height=\"16\" alt=\""._HWDPS_ALT_RATED." ".$rating."\" />";
		return $code;
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
	function generateActiveLink( $active ) {
		global $smartyps;
		if ($active == 1) { $smartyps->assign("eon", " id=\"active\""); } else { $smartyps->assign("eon", ""); }
		if ($active == 2) { $smartyps->assign("con", " id=\"active\""); } else { $smartyps->assign("con", ""); }
		if ($active == 3) { $smartyps->assign("gon", " id=\"active\""); } else { $smartyps->assign("gon", ""); }
		if ($active == 4) { $smartyps->assign("uon", " id=\"active\""); } else { $smartyps->assign("uon", ""); }
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
	#######################################
	## multiple select list
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
     * Outputs frontpage HTML
     *
     * @param string $option  the joomla component name
     * @param array  $rows  array of video data
     * @param array  $rowsfeatured  array of featured video data
     * @param object $pageNav  page navigation object
     * @param int    $total  the total video count
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
				$list = hwd_ps_tools::catTreeRecurse($id, "$indent$txt$seperator", $list, $children, $maxlevel, $level + 1);
			//$list = hwd_ps_tools::catTreeRecurse( $id, "*", $list, $children, $maxlevel, $level+1 );
			}
		}

		return $list;
	}
	/**
	* build the select list for multi access levels
	*/
	function hwdpsMultiAccess( $jaclplus, $selectname='access' ) {
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
		$access = JHTML::_('select.genericlist', $groups, $selectname, 'class="inputbox" size="6" multiple="true"', 'value', 'text', $jaclpluslists );

		return $access;
	}
	/**
	* build the select list for multi access levels
	*/
	function checkFormComplete( $title, $description, $category_id, $tags, $public_private, $allow_comments, $allow_embedding, $allow_ratings ) {
		global $database;

		if ($title == "" || !isset($title)) {
        	hwd_ps_tools::infoMessage(4, 0, _HWDPS_TITLE_UPLDFAIL, _HWDPS_UPLD_FORMERR01, "exclamation.png", 0);
			return false;
		} else if ($description == "" || !isset($description)) {
        	hwd_ps_tools::infoMessage(4, 0, _HWDPS_TITLE_UPLDFAIL, _HWDPS_UPLD_FORMERR02, "exclamation.png", 0);
			return false;
		} else if ($category_id == "" || $category_id == 0 || !isset($category_id)) {
        	hwd_ps_tools::infoMessage(4, 0, _HWDPS_TITLE_UPLDFAIL, _HWDPS_UPLD_FORMERR03, "exclamation.png", 0);
			return false;
		} else if ($tags == "" || !isset($tags)) {
        	hwd_ps_tools::infoMessage(4, 0, _HWDPS_TITLE_UPLDFAIL, _HWDPS_UPLD_FORMERR04, "exclamation.png", 0);
			return false;
		} else if ($public_private == "" || !isset($public_private)) {
        	hwd_ps_tools::infoMessage(4, 0, _HWDPS_TITLE_UPLDFAIL, _HWDPS_UPLD_FORMERR05, "exclamation.png", 0);
			return false;
		} else if (!isset($allow_comments)) {
        	hwd_ps_tools::infoMessage(4, 0, _HWDPS_TITLE_UPLDFAIL, _HWDPS_UPLD_FORMERR06, "exclamation.png", 0);
			return false;
		} else if (!isset($allow_embedding)) {
        	hwd_ps_tools::infoMessage(4, 0, _HWDPS_TITLE_UPLDFAIL, _HWDPS_UPLD_FORMERR07, "exclamation.png", 0);
			return false;
		} else if (!isset($allow_ratings)) {
        	hwd_ps_tools::infoMessage(4, 0, _HWDPS_TITLE_UPLDFAIL, _HWDPS_UPLD_FORMERR08, "exclamation.png", 0);
			return false;
		} else {
			return true;
		}
	}
	/**
	* build the select list for multi access levels
	*/
	function checkAlbumFormComplete( $album_name, $album_description, $allow_comments ) {
		global $database;

		if ($album_name == "" || !isset($album_name)) {
        	hwd_ps_tools::infoMessage(3, 0, _HWDPS_TITLE_UPLDFAIL, "group name", "exclamation.png", 0);
			return false;
		} else if ($album_description == "" || !isset($album_description)) {
        	hwd_ps_tools::infoMessage(3, 0, _HWDPS_TITLE_UPLDFAIL, "group description", "exclamation.png", 0);
			return false;
		} else if (!isset($allow_comments)) {
        	hwd_ps_tools::infoMessage(3, 0, _HWDPS_TITLE_UPLDFAIL, "allow comms", "exclamation.png", 0);
			return false;
		} else {
			return true;
		}
	}
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
	* build the select list for multi access levels
	*/
	function generateCaptcha( ) {
		global $database, $smartyps;
		$c = hwd_ps_Config::get_instance();

		$code = null;
		if ($c->disablecaptcha == 0) {

			$jversion = hwd_ps_access::checkJversion();

			$code.="<script language=\"javascript\">
					var image=\"".JURI::root(true)."/components/com_hwdphotoshare/assets/captcha/CaptchaSecurityImages.php?width=120&height=40&jversion=".$jversion."&characters=6\";
						function refresh()
						{
							document.images[\"pic\"].src=image+\"?\"+new Date();
						}
					</script>
					<img src=\"".JURI::root(true)."/components/com_hwdphotoshare/assets/captcha/CaptchaSecurityImages.php?width=120&height=40&jversion=".$jversion."&characters=6\" alt=\"Security Code\" name=\"pic\" id=\"pic\" width=\"120\" height=\"40\" style=\"border: 1px solid Black; width: 120px; height: 40px;\" />
					<script language=\"javascript\">
					document.write('<div style=\"cursor:pointer;padding:3px;\" onclick=\"refresh()\" >"._HWDPS_INFO_NEWCODE."</a>');
					</script>";
		$smartyps->assign("print_captcha", 1);
		}

	return $code;
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
	function logViewing( $videoid ) {
		global $database, $my;
		$c = hwd_ps_Config::get_instance();

		$row = new hwdpslogs_views($database);

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
	function logRating( $photoid, $vote ) {
		$c = hwd_ps_Config::get_instance();
		$db = & JFactory::getDBO();
		$my = & JFactory::getUser();

		$row = new hwdpslogs_votes($db);

		$_POST['photoid'] 	= $photoid;
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
     * Outputs frontpage HTML
     *
     * @param string $option  the joomla component name
     * @param array  $rows  array of video data
     * @param array  $rowsfeatured  array of featured video data
     * @param object $pageNav  page navigation object
     * @param int    $total  the total video count
     * @return       Nothing
     */
	function logFavour( $photoid, $favour=1 ) {
		global $database, $my;
		$c = hwd_ps_Config::get_instance();
		$db = & JFactory::getDBO();
		$my = & JFactory::getUser();

		$row = new hwdpslogs_favours($database);

		$_POST['photoid'] 	= $photoid;
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
     * Generates a link to category using $cat_id, and generates the
     * category name if necessary
     *
     * @param int    $cat_id  the category id
     * @param string $category(optional)  the name of the category
     * @return       $code  the html category link
     */
	function generateAlbumLink( $album_id, $album=null ) {
		global $Itemid, $database, $mosConfig_absolute_path;
		$c = hwd_ps_Config::get_instance();

		$code = null;
		$code.= "<a href=\"".JRoute::_("index.php?option=com_hwdphotoshare&amp;task=viewalbum&amp;Itemid=".$Itemid."&amp;album_id=".$album_id)."\">";
		if (isset($album)) {
			$code.= hwd_ps_tools::truncateText($album, $c->truntitle);
		} else {
			$code.= "0";
		}
		$code.= "</a>";
		return $code;
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
	function generateDeleteAlbumLink( $row ) {
		global $Itemid, $database, $my, $mainframe;
		$my = & JFactory::getUser();
		$c = hwd_ps_Config::get_instance();
		require_once(JPATH_SITE.DS.'administrator'.DS.'components'.DS.'com_hwdphotoshare'.DS.'helpers'.DS.'js.php');

		$code = null;
		$url = JRoute::_($_SERVER['REQUEST_URI']);
		if ( $my->id == $row->user_id ){
			$mainframe->addCustomHeadTag(hwd_ps_javascript::confirmDelete());
			$code.="<form name=\"deletealbum\" style=\"display: inline;\" action=\"".JURI::root(true)."/index.php?option=com_hwdphotoshare&amp;Itemid=".$Itemid."&amp;task=deletealbum&album_id=".$row->id."\" method=\"post\">";
			$code.="<input type=\"hidden\" name=\"uid\" value=\"".$my->id."\" />";
			$code.="<input type=\"hidden\" name=\"aid\" value=\"".$row->id."\" />";
			$code.="<input type=\"hidden\" name=\"url\" value=\"".$url."\" />";
			$code.="<input type=\"submit\" value=\""._HWDPS_DELETEALBUM."\" class=\"interactbutton_sm\" onClick=\"return confirmDelete()\">";
			$code.="</form>";
		}
		return $code;
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
	function generateDeleteAlbumButton( $row ) {
		global $Itemid, $database, $my, $mainframe;
		$my = & JFactory::getUser();
		$c = hwd_ps_Config::get_instance();
		require_once(JPATH_SITE.DS.'administrator'.DS.'components'.DS.'com_hwdphotoshare'.DS.'helpers'.DS.'js.php');

		$code = null;
		$url = JRoute::_($_SERVER['REQUEST_URI']);
		if ( $my->id == $row->user_id ){
			$mainframe->addCustomHeadTag(hwd_ps_javascript::confirmDelete());
			$code.="<form name=\"deletealbum\" style=\"display: inline;\" action=\"".JURI::root(true)."/index.php?option=com_hwdphotoshare&amp;Itemid=".$Itemid."&amp;task=deletealbum&album_id=".$row->id."\" method=\"post\">";
			$code.="<input type=\"hidden\" name=\"uid\" value=\"".$my->id."\" />";
			$code.="<input type=\"hidden\" name=\"aid\" value=\"".$row->id."\" />";
			$code.="<input type=\"hidden\" name=\"url\" value=\"".$url."\" />";
			$code.="<input type=\"image\" src=\"".URL_HWDPS_IMAGES."icons/delete.png\" alt=\""._HWDPS_DELETEALBUM."\" onClick=\"return confirmDelete()\">";
			$code.="</form>";
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
			$db->SetQuery( 'SELECT id FROM #__menu WHERE `link` LIKE "%com_hwdphotoshare%" AND id = '.$current );
			$Itemid = $db->loadResult();
			if (!empty($Itemid)) {
				return $Itemid;
			}
		}

		$db->SetQuery( 'SELECT id FROM #__menu WHERE `link` LIKE "%com_hwdphotoshare%"' );
		$Itemid = $db->loadResult();

		if (empty($Itemid)) {
			$Itemid = "0";
		}

		return $Itemid;
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
	function generateAddNewPhotosLink( $row ) {
		global $Itemid, $database, $my, $mainframe;
		$my = & JFactory::getUser();
		$c = hwd_ps_Config::get_instance();
		require_once(JPATH_SITE.DS.'administrator'.DS.'components'.DS.'com_hwdphotoshare'.DS.'helpers'.DS.'js.php');

		$code = null;
		$url = JRoute::_($_SERVER['REQUEST_URI']);
		if ( $my->id == $row->user_id ){
			$code.="<form name=\"deletealbum\" style=\"display: inline;\" action=\"".JURI::root(true)."/index.php?option=com_hwdphotoshare&amp;Itemid=".$Itemid."&amp;task=addphotos&album_id=".$row->id."\" method=\"post\">";
			$code.="<input type=\"hidden\" name=\"uid\" value=\"".$my->id."\" />";
			$code.="<input type=\"hidden\" name=\"aid\" value=\"".$row->id."\" />";
			$code.="<input type=\"hidden\" name=\"url\" value=\"".$url."\" />";
			$code.="<input type=\"submit\" class=\"interactbutton_sm\" value=\""._HWDPS_ADDNEWPHOTOS."\" >";
			$code.="</form>";
		}
		return $code;
    }
	/**
     * Generates the Download Video Button
     *
     * @param array  $row  the video sql data
     * @param int    $original  link to original video or converted flv video (0/1)
     * @return       $code
     */
	function generateDownloadPhotoButton( $row ) {
		global $Itemid, $database, $mosConfig_absolute_path;
		$c = hwd_ps_Config::get_instance();
		$db = & JFactory::getDBO();
		$my = & JFactory::getUser();
		$acl= & JFactory::getACL();
		$usersConfig = &JComponentHelper::getParams( 'com_users' );

		$code =null;

		// setup antileech system expiration
		$dlink = hwd_ps_tools::generateAntileechExpiration($row->id, 'local', 'download');

		$code = null;
		$code.= "<form name=\"downloadoriginal\" action=\"".$dlink."\" method=\"post\">
				 <input type=\"image\" src=\"".URL_HWDPS_IMAGES."icons/download.png\" alt=\""._HWDPS_DLORIGINALP."\" id=\"downloadoriginalbutton\" />
				 <input type=\"submit\" value=\""._HWDPS_DLORIGINALP."\" class=\"interactbutton\" />
				 </form>";



		return $code;
	}
	/**
     * readfile_chunked
     * Read the contents of a file in chunks
     * @param array  $row  the video sql data
     * @param int    $original  link to original video or converted flv video (0/1)
     * @return       $code
     */
	function readfile_chunked($filename,$retbytes=true)
	{
		$chunksize = 1*(512*1024); // how many bytes per chunk
		$buffer = '';
		$cnt =0;
		$handle = fopen($filename, 'rb');
		if ($handle === false)
		{
		 return false;
		}
		while (!feof($handle))
		{
		 $buffer = fread($handle, $chunksize);
		 echo $buffer;
		 flush();
		 if ($retbytes)
		 {
		   $cnt += strlen($buffer);
		 }
		}
		$status = fclose($handle);
		if ($retbytes && $status)
		{
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
		$c = hwd_ps_Config::get_instance();
		$db = & JFactory::getDBO();

		// setup antileech system expiration
		$download_exp_key = md5(microtime());

		$dlink = JURI::root()."index.php?option=com_hwdphotoshare&task=downloadfile&file=".$fid."&evp=".$download_exp_key."&media=".$media."&deliver=".$deliver;

		return $dlink;
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
	function generateAddNewPhotosButton( $row ) {
		global $Itemid, $database, $my, $mainframe;
		$my = & JFactory::getUser();
		$c = hwd_ps_Config::get_instance();
		require_once(JPATH_SITE.DS.'administrator'.DS.'components'.DS.'com_hwdphotoshare'.DS.'helpers'.DS.'js.php');

		$code = null;
		$url = JRoute::_($_SERVER['REQUEST_URI']);
		if ( $my->id == $row->user_id ){
			$code.="<form name=\"deletealbum\" style=\"display: inline;\" action=\"".JURI::root(true)."/index.php?option=com_hwdphotoshare&amp;Itemid=".$Itemid."&amp;task=addphotos&album_id=".$row->id."\" method=\"post\">";
			$code.="<input type=\"hidden\" name=\"uid\" value=\"".$my->id."\" />";
			$code.="<input type=\"hidden\" name=\"aid\" value=\"".$row->id."\" />";
			$code.="<input type=\"hidden\" name=\"url\" value=\"".$url."\" />";
			$code.="<input type=\"image\" src=\"".URL_HWDPS_IMAGES."icons/add.png\" alt=\""._HWDPS_ADDNEWPHOTOS."\" >";
			$code.="</form>";
		}
		return $code;
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
	function reorganiseAlbum( $album_id ) {
		global $Itemid, $database, $my, $mainframe;
		$c = hwd_ps_Config::get_instance();
  		$db =& JFactory::getDBO();

        if (isset($album_id)) {

			$query =  ' SELECT *'
					. ' FROM #__hwdpsphotos'
					. ' WHERE album_id = '.$album_id
					. ' ORDER BY ordering, date_uploaded'
					;

			$db->SetQuery($query);
			$rows = $db->loadObjectList();

			for ($i=0, $n=count($rows); $i < $n; $i++) {
				$row = $rows[$i];

				// update category
				$db->SetQuery("UPDATE #__hwdpsphotos SET ordering = $i WHERE id = $row->id");
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
	function setAlbumModifiedDate( $album_id ) {
		global $Itemid, $database, $my, $mainframe;
  		$db =& JFactory::getDBO();

		$date = date('Y-m-d H:i:s');
		$album_id = (int)$album_id;

		// update category
		$db->SetQuery("UPDATE #__hwdpsalbums SET date_modified = \"$date\" WHERE id = $album_id");
		$db->Query();
		if ( !$db->query() ) {
			echo "<script> alert('".$db->getErrorMsg()."'); window.history.go(-1); </script>\n";
			exit();
		}
		return true;
    }
	// ------------ lixlpixel recursive PHP functions -------------
	// recursive_directory_size( directory, human readable format )
	// expects path to directory and optional TRUE / FALSE
	// PHP has to have the rights to read the directory you specify
	// and all files and folders inside the directory to count size
	// if you choose to get human readable format,
	// the function returns the filesize in bytes, KB and MB
	// ------------------------------------------------------------

	// to use this function to get the filesize in bytes, write:
	// recursive_directory_size('path/to/directory/to/count');

	// to use this function to get the size in a nice format, write:
	// recursive_directory_size('path/to/directory/to/count',TRUE);

	function recursive_directory_size($directory, $format=FALSE)
	{
		$size = 0;

		// if the path has a slash at the end we remove it here
		if(substr($directory,-1) == '/')
		{
			$directory = substr($directory,0,-1);
		}

		// if the path is not valid or is not a directory ...
		if(!file_exists($directory) || !is_dir($directory) || !is_readable($directory))
		{
			// ... we return -1 and exit the function
			return -1;
		}
		// we open the directory
		if($handle = opendir($directory))
		{
			// and scan through the items inside
			while(($file = readdir($handle)) !== false)
			{
				// we build the new path
				$path = $directory.'/'.$file;

				// if the filepointer is not the current directory
				// or the parent directory
				if($file != '.' && $file != '..')
				{
					// if the new path is a file
					if(is_file($path))
					{
						// we add the filesize to the total size
						$size += filesize($path);

					// if the new path is a directory
					}elseif(is_dir($path))
					{
						// we call this function with the new path
						$handlesize = hwd_ps_tools::recursive_directory_size($path);

						// if the function returns more than zero
						if($handlesize >= 0)
						{
							// we add the result to the total size
							$size += $handlesize;

						// else we return -1 and exit the function
						}else{
							return -1;
						}
					}
				}
			}
			// close the directory
			closedir($handle);
		}
		// if the format is set to human readable
		if($format == TRUE)
		{
			// if the total size is bigger than 1 MB
			if($size / 1048576 > 1)
			{
				return round($size / 1048576, 1).' MB';

			// if the total size is bigger than 1 KB
			}elseif($size / 1024 > 1)
			{
				return round($size / 1024, 1).' KB';

			// else return the filesize in bytes
			}else{
				return round($size, 1).' bytes';
			}
		}else{
			// return the total filesize in bytes
			return $size;
		}
	}
	/**
	* build the select list for multi access levels
	*/
	function checkGroupFormComplete( $group_name, $public_private, $allow_comments, $group_description ) {
		global $database;

		if ($group_name == "" || !isset($group_name)) {
        	hwd_ps_tools::infoMessage(3, 0, _HWDPS_TITLE_UPLDFAIL, "group name", "exclamation.png", 0);
			return false;
		} else if ($public_private == "" || !isset($public_private)) {
        	hwd_ps_tools::infoMessage(3, 0, _HWDPS_TITLE_UPLDFAIL, "public private", "exclamation.png", 0);
			return false;
		} else if (!isset($allow_comments)) {
        	hwd_ps_tools::infoMessage(3, 0, _HWDPS_TITLE_UPLDFAIL, "allow comms", "exclamation.png", 0);
			return false;
		} else if ($group_description == "" || !isset($group_description)) {
        	hwd_ps_tools::infoMessage(3, 0, _HWDPS_TITLE_UPLDFAIL, "group description", "exclamation.png", 0);
			return false;
		} else {
			return true;
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
		$protocol = hwd_ps_tools::strleft(strtolower($_SERVER["SERVER_PROTOCOL"]), "/").$s;
		$port = ($_SERVER["SERVER_PORT"] == "80") ? ""
			: (":".$_SERVER["SERVER_PORT"]);
		return $protocol."://".$_SERVER['SERVER_NAME'].$port.$_SERVER['REQUEST_URI'];
	}
	function strleft($s1, $s2) { return substr($s1, 0, strpos($s1, $s2)); }
	/**
     * Generates the human readable access level of a video from the raw sql data
     *
     * @param string $status  the raw sql format
     * @return       $code  the multilingual human readable text
     */
	function generateAlbumAccess( $status ) {

		$code = null;
		if ($status == "public") {
			$code.= _HWDPS_SELECT_PUBLIC;
		} else if ($status == "registered") {
			$code.= _HWDPS_SELECT_REG;
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
	function generatePhotoAccess( $status ) {

		$code = null;
		if ($status == "public") {
			$code.= _HWDPS_SELECT_PUBLIC;
		} else if ($status == "registered") {
			$code.= _HWDPS_SELECT_REG;
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
	function generateGroupAccess( $status ) {

		$code = null;
		if ($status == "public") {
			$code.= _HWDPS_SELECT_PUBLIC;
		} else if ($status == "registered") {
			$code.= _HWDPS_SELECT_REG;
		} else {
			$code.= $status;
		}
		return $code;
    }
    /**
     * Generates the human readable status of a video from the raw sql data
     *
     * @param string $status  the raw sql format
     * @return       $code  the multilingual human readable text
     */
	function generatePhotoStatus( $status ) {

		$code = null;
		if ($status == "yes") {
			$code.= _HWDPS_DETAILS_STATUS_Y;
		} else if ($status == "queuedforconversion") {
			$code.= _HWDPS_DETAILS_STATUS_QFC;
		} else if ($status == "queuedforthumbnail") {
			$code.= _HWDPS_DETAILS_STATUS_QFT;
		} else if ($status == "queuedforswf") {
			$code.= _HWDPS_DETAILS_STATUS_QFSWF;
		} else if ($status == "deleted") {
			$code.= "<a href=\"index.php?option=com_hwdphotoshare&task=maintenance\">"._HWDPS_DETAILS_PSTATUS_D."</a>";
		} else if ($status == "pending") {
			$code.= _HWDPS_DETAILS_STATUS_P;
		} else {
			$code.= $status;
		}
		return $code;
    }
    /**
     * Generates the human readable status of a video from the raw sql data
     *
     * @param string $status  the raw sql format
     * @return       $code  the multilingual human readable text
     */
	function generateAlbumStatus( $status ) {

		$code = null;
		if ($status == "yes") {
			$code.= _HWDPS_DETAILS_STATUS_Y;
		} else if ($status == "queuedforconversion") {
			$code.= _HWDPS_DETAILS_STATUS_QFC;
		} else if ($status == "queuedforthumbnail") {
			$code.= _HWDPS_DETAILS_STATUS_QFT;
		} else if ($status == "queuedforswf") {
			$code.= _HWDPS_DETAILS_STATUS_QFSWF;
		} else if ($status == "deleted") {
			$code.= "<a href=\"index.php?option=com_hwdphotoshare&task=maintenance\">"._HWDPS_DETAILS_STATUS_D."</a>";
		} else if ($status == "pending") {
			$code.= _HWDPS_DETAILS_STATUS_P;
		} else {
			$code.= $status;
		}
		return $code;
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
	function generatePhotoComments($row) {
		global $Itemid, $smartyps, $my;
		$c = hwd_ps_Config::get_instance();

		$code = null;
		if ( $c->showcoms ==1 ) {
		$smartyps->assign("print_comments", 1);
			if ( $c->commssys == 0 ) {
				if (!file_exists(JPATH_SITE.DS.'components'.DS.'com_jcomments'.DS)) {
					$code.= "<div class=\"padding\">"._HWDPS_INFO_NOINS_JCOMMENTS."</div>";
				} else {
					$comments = JPATH_SITE.DS.'components'.DS.'com_jcomments'.DS.'jcomments.php';
					if (file_exists( $comments )) {
						require_once( $comments );
						$comments = JComments::showComments( $row->id, 'com_hwdphotoshare_p', $row->title );
			            $code.= "<div class=\"padding\">".$comments."</div>";
					}
				}
			} else if ( $c->commssys == 3 ) {
				// joomla1.5
				if (!file_exists(JPATH_SITE.DS.'plugins'.DS.'content'.DS.'jom_comment_bot.php')) {
					$code.= "<div class=\"padding\">"._HWDPS_INFO_NOINS_JOMCOMMENTS."</div>";
				} else {
					include_once(JPATH_SITE.DS.'plugins'.DS.'content'.DS.'jom_comment_bot.php');
					$comments = jomcomment( $row->id, 'com_hwdphotoshare_p' );
					$code.= "<div class=\"padding\">".$comments."</div>";
				}
			}
		}
		$smartyps->assign("comment_code", $code);
		return $code;
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
	function resizeMainImages() {
		global $Itemid, $database, $smartyps, $my;
		$c = hwd_ps_Config::get_instance();

		include_once(HWDPSPATH.'/mvc/controller/thumbnail.inc.php');

		$query = ' SELECT *'
				.' FROM #__hwdpsphotos'
				;
		$db->SetQuery($query);
    	$rows = $db->loadObjectList();

		for ($i=0, $n=count($rows); $i < $n; $i++) {
			$row = $rows[$i];

			@mkdir(HWDPSPATH.'/../../hwdphotos/', 0777);
			@mkdir(HWDPSPATH.'/../../hwdphotos/uploads/', 0777);
			@mkdir(HWDPSPATH.'/../../hwdphotos/uploads/'.$my->id.'/', 0777);
			@mkdir(HWDPSPATH.'/../../hwdphotos/uploads/'.$my->id.'/'.$row->album_id.'/', 0777);

			@chmod(HWDPSPATH.'/../../hwdphotos/', 0777);
			@chmod(HWDPSPATH.'/../../hwdphotos/uploads/', 0777);
			@chmod(HWDPSPATH.'/../../hwdphotos/uploads/'.$my->id.'/', 0777);
			@chmod(HWDPSPATH.'/../../hwdphotos/uploads/'.$my->id.'/'.$row->album_id.'/', 0777);

			$baseOriginalDir = HWDPSPATH.'/../../hwdphotos/originals/'.$my->id.'/';
			$baseResizedDir = HWDPSPATH.'/../../hwdphotos/uploads/'.$my->id.'/'.$row->album_id.'/';

			$resized = new Thumbnail($baseOriginalDir.$row->photo_id.".".$row->original_type);
			$resized->resize($c->resize_main,$c->resize_main);
			$resized->save($baseResizedDir.$row->photo_id.".jpg");
			$resized->destruct();
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
	function resizeThumbnailImages() {
		global $Itemid, $database, $smartyps, $my;
		$c = hwd_ps_Config::get_instance();

		include_once(HWDPSPATH.'/mvc/controller/thumbnail.inc.php');

		$query = ' SELECT *'
				.' FROM #__hwdpsphotos'
				;
		$db->SetQuery($query);
    	$rows = $db->loadObjectList();

		for ($i=0, $n=count($rows); $i < $n; $i++) {
			$row = $rows[$i];

			@mkdir(HWDPSPATH.'/../../hwdphotos/', 0777);
			@mkdir(HWDPSPATH.'/../../hwdphotos/thumbs/', 0777);
			@mkdir(HWDPSPATH.'/../../hwdphotos/thumbs/normal/', 0777);

			@chmod(HWDPSPATH.'/../../hwdphotos/', 0777);
			@chmod(HWDPSPATH.'/../../hwdphotos/thumbs/', 0777);
			@chmod(HWDPSPATH.'/../../hwdphotos/thumbs/normal/', 0777);

			$baseOriginalDir = HWDPSPATH.'/../../hwdphotos/originals/'.$my->id.'/';
			$baseThumbDir = HWDPSPATH.'/../../hwdphotos/thumbs/normal/';

			$resized = new Thumbnail($baseOriginalDir.$row->photo_id.".".$row->original_type);
			$resized->resize($c->resize_thumb,$c->resize_thumb);
			$resized->save($baseThumbDir.$row->photo_id.".jpg");
			$resized->destruct();
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
	function resizeSquareImages() {
		global $Itemid, $database, $smartyps, $my;
		$c = hwd_ps_Config::get_instance();

		include_once(HWDPSPATH.'/mvc/controller/thumbnail.inc.php');

		$query = ' SELECT *'
				.' FROM #__hwdpsphotos'
				;
		$db->SetQuery($query);
    	$rows = $db->loadObjectList();

		for ($i=0, $n=count($rows); $i < $n; $i++) {
			$row = $rows[$i];

			@mkdir(HWDPSPATH.'/../../hwdphotos/', 0777);
			@mkdir(HWDPSPATH.'/../../hwdphotos/thumbs/', 0777);
			@mkdir(HWDPSPATH.'/../../hwdphotos/thumbs/square/', 0777);
			@mkdir(HWDPSPATH.'/../../hwdphotos/thumbs/squarerf/', 0777);

			@chmod(HWDPSPATH.'/../../hwdphotos/', 0777);
			@chmod(HWDPSPATH.'/../../hwdphotos/thumbs/', 0777);
			@chmod(HWDPSPATH.'/../../hwdphotos/thumbs/square/', 0777);
			@chmod(HWDPSPATH.'/../../hwdphotos/thumbs/squarerf/', 0777);

			$baseOriginalDir = HWDPSPATH.'/../../hwdphotos/originals/'.$my->id.'/';
			$baseSquareThumbDir = HWDPSPATH.'/../../hwdphotos/thumbs/square/';
			$baseSquareThumbRfDir = HWDPSPATH.'/../../hwdphotos/thumbs/squarerf/';

			list($width, $height, $type, $attr) = @getimagesize($baseOriginalDir.$row->photo_id.".".$row->original_type);
			$ratio = min($width,$height)/max($width,$height);
			if ($ratio > 0.50) {
				$resize = 200;
			} else if ($ratio > 0.35) {
				$resize = 300;
			} else {
				$resize = 500;
			}

			$thumb = new Thumbnail($baseOriginalDir.$row->photo_id.".".$row->original_type);
			$thumb->resize($resize,$resize);
			$thumb->cropFromCenter($c->resize_square);
			$thumb->save($baseSquareThumbDir.$row->photo_id.".jpg");
			$thumb->destruct();

			$thumb = new Thumbnail($baseOriginalDir.$row->photo_id.".".$row->original_type);
			$thumb->resize($resize,$resize);
			$thumb->cropFromCenter($c->resize_square);
			$thumb->createReflection(40,40,80,true,'#a4a4a4');
			$thumb->save($baseSquareThumbRfDir.$row->photo_id.".jpg");
			$thumb->destruct();
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
	function deletePhotoFiles($row) {
		global $Itemid, $database, $smartyps, $my;
		$c = hwd_ps_Config::get_instance();


		if (file_exists(JPATH_SITE.DS.'hwdphotos'.DS.'originals'.DS.$row->user_id.DS.$row->photo_id.'.'.$row->original_type)) {
			unlink(JPATH_SITE.DS.'hwdphotos'.DS.'originals'.DS.$row->user_id.DS.$row->photo_id.'.'.$row->original_type);
		}
		if (file_exists(JPATH_SITE.DS.'hwdphotos'.DS.'uploads'.DS.$row->user_id.DS.$row->album_id.DS.$row->photo_id.'.'.$row->original_type)) {
			unlink(JPATH_SITE.DS.'hwdphotos'.DS.'uploads'.DS.$row->user_id.DS.$row->album_id.DS.$row->photo_id.'.'.$row->original_type);
		}
		if (file_exists(JPATH_SITE.DS.'hwdphotos'.DS.'thumbs'.DS.'normal'.DS.$row->photo_id.'.'.$row->original_type)) {
			unlink(JPATH_SITE.DS.'hwdphotos'.DS.'thumbs'.DS.'normal'.DS.$row->photo_id.'.'.$row->original_type);
		}
		if (file_exists(JPATH_SITE.DS.'hwdphotos'.DS.'thumbs'.DS.'square'.DS.$row->photo_id.'.'.$row->original_type)) {
			unlink(JPATH_SITE.DS.'hwdphotos'.DS.'thumbs'.DS.'square'.DS.$row->photo_id.'.'.$row->original_type);
		}
		if (file_exists(JPATH_SITE.DS.'hwdphotos'.DS.'thumbs'.DS.'squarerf'.DS.$row->photo_id.'.'.$row->original_type)) {
			unlink(JPATH_SITE.DS.'hwdphotos'.DS.'thumbs'.DS.'squarerf'.DS.$row->photo_id.'.'.$row->original_type);
		}

		return true;
    }




}

/**
* Tab Creation handler
* @package Joomla
*/
class hwd_ps_Tabs {
	/** @var int Use cookies */
	var $useCookies = 0;

	/**
	* Constructor
	* Includes files needed for displaying tabs and sets cookie options
	* @param int useCookies, if set to 1 cookie will hold last used tab between page refreshes
	*/
	function hwd_ps_Tabs( $useCookies, $xhtml=NULL ) {
		global $mainframe;
		$html = null;

		if ( $xhtml ) {
			$mainframe->addCustomHeadTag( '<link rel="stylesheet" type="text/css" media="all" href="includes/js/tabs/tabpane.css" id="luna-tab-style-sheet" />' );
		} else {
			echo "<link id=\"luna-tab-style-sheet\" type=\"text/css\" rel=\"stylesheet\" href=\"" . JURI::root(true). "/includes/js/tabs/tabpane.css\" />";
		}

		echo "<script type=\"text/javascript\" src=\"". JURI::root(true) . "/includes/js/tabs/tabpane_mini.js\"></script>";

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
* @version $Id: pageNavigation.php 9847 2008-01-04 04:10:37Z eddieajau $
* @package Joomla
* @copyright Copyright (C) 2005 Open Source Matters. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* Joomla! is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See COPYRIGHT.php for copyright notices and details.
*/

/**
* Page navigation support class
* @package Joomla
*/
class hwdpsPageNav {
	/** @var int The record number to start dislpaying from */
	var $limitstart = null;
	/** @var int Number of rows to display per page */
	var $limit = null;
	/** @var int Total number of rows */
	var $total = null;

	function hwdpsPageNav( $total, $limitstart, $limit ) {
		$this->total		= (int) $total;
		$this->limitstart	= (int) max( $limitstart, 0 );
		$this->limit		= (int) max( $limit, 0 );
	}
	/**
	* Returns the html limit # input box
	* @param string The basic link to include in the href
	* @return string
	*/
	function getLimitBox ( $link ) {
		$limits = array();
		for ($i=5; $i <= 30; $i+=5) {
			$limits[] = mosHTML::makeOption( "$i" );
		}
		$limits[] = mosHTML::makeOption( "50" );

		// build the html select list
		$link = $link ."&amp;limit=' + this.options[selectedIndex].value + '&amp;limitstart=". $this->limitstart;
		$link = JRoute::_( $link );
		return mosHTML::selectList( $limits, 'limit', 'class="inputbox" size="1" onchange="document.location.href=\''. $link .'\';"', 'value', 'text', $this->limit );
	}
	/**
	* Writes the html for the pages counter, eg, Results 1-10 of x
	*/
	function getPagesCounter() {
		$txt = '';
		$from_result = $this->limitstart+1;
		if ($this->limitstart + $this->limit < $this->total) {
			$to_result = $this->limitstart + $this->limit;
		} else {
			$to_result = $this->total;
		}
		if ($this->total > 0) {
			$txt .= '<span class="hwdpsNav">';
			$txt .= _HWDPS_PHOTOS." ".$from_result." - ".$to_result." "._HWDPS_OUTOF." ".$this->total;
			$txt .= '</span> ';
		}
		return $to_result ? $txt : '';
	}
	/**
	* Writes the html for the pages counter, eg, Results 1-10 of x
	*/
	function getPageCounter() {
		$txt = '';
		$from_result = $this->limitstart+1;
		if ($this->limitstart + $this->limit < $this->total) {
			$to_result = $this->limitstart + $this->limit;
		} else {
			$to_result = $this->total;
		}
		if ($from_result == $to_result) {
			if ($this->total > 0) {
				$txt .= '<span class="hwdpsNav">';
				$txt .= _HWDPS_PHOTO." ".$from_result." "._HWDPS_OUTOF." ".$this->total;
				$txt .= '</span> ';
			}
		} else {
			if ($this->total > 0) {
				$txt .= '<span class="hwdpsNav">';
				$txt .= _HWDPS_PHOTOS." ".$from_result." - ".$to_result." "._HWDPS_OUTOF." ".$this->total;
				$txt .= '</span> ';
			}
		}
		return $to_result ? $txt : '';
	}
	/**
	* Writes the html links for pages, eg, previous, next, 1 2 3 ... x
	* @param string The basic link to include in the href
	*/
	function getPagesLinks( $link ) {
		$txt = '';

		$displayed_pages = 10;
		$total_pages = $this->limit ? ceil( $this->total / $this->limit ) : 0;
		$this_page = $this->limit ? ceil( ($this->limitstart+1) / $this->limit ) : 1;
		$start_loop = (floor(($this_page-1)/$displayed_pages))*$displayed_pages+1;
		if ($start_loop + $displayed_pages - 1 < $total_pages) {
			$stop_loop = $start_loop + $displayed_pages - 1;
		} else {
			$stop_loop = $total_pages;
		}

		$link .= '&amp;limit='. $this->limit;

		if (!defined( '_PN_LT' ) || !defined( '_PN_RT' ) ) {
			DEFINE('_PN_LT','&lt;');
			DEFINE('_PN_RT','&gt;');
		}

		$pnSpace = '';
		if (_PN_LT || _PN_RT) $pnSpace = "&nbsp;";

		if ($this_page > 1) {
			$page = ($this_page - 2) * $this->limit;
			//$txt .= '<a href="'. JRoute::_( "$link&amp;limitstart=0" ) .'" class="hwdpsNav" title="'. _PN_START .'">&laquo;</a> ';
			$txt .= '<a href="'. JRoute::_( "$link&amp;limitstart=$page" ) .'" class="hwdpsNav" title="'. _HWDPS_PN_PREVIOUS .'">'._HWDPS_PN_PREVIOUS.'</a> ';
		} else {
			//$txt .= '<span class="hwdpsNav">&laquo;</span> ';
			$txt .= '<span class="hwdpsNav">'._HWDPS_PN_PREVIOUS.'</span> ';
		}

		for ($i=$start_loop; $i <= $stop_loop; $i++) {
			$page = ($i - 1) * $this->limit;
			if ($i == $this_page) {
				$txt .= '<span class="hwdpsNav">'. $i .'</span> ';
			} else {
				$txt .= '<a href="'. JRoute::_( $link .'&amp;limitstart='. $page ) .'" class="hwdpsNav"><strong>'. $i .'</strong></a> ';
			}
		}

		if ($this_page < $total_pages) {
			$page = $this_page * $this->limit;
			$end_page = ($total_pages-1) * $this->limit;
			$txt .= '<a href="'. JRoute::_( $link .'&amp;limitstart='. $page ) .'" class="hwdpsNav" title="'. _HWDPS_PN_NEXT .'">'._HWDPS_PN_NEXT.'</a> ';
			//$txt .= '<a href="'. JRoute::_( $link .'&amp;limitstart='. $end_page ) .'" class="hwdpsNav" title="'. _PN_END .'">&raquo;</a>';
		} else {
			$txt .= '<span class="hwdpsNav">'._HWDPS_PN_NEXT.'</span> ';
			//$txt .= '<span class="hwdpsNav">&raquo;</span>';
		}
		return $txt;
	}

	/**
	* Writes the html links for pages, eg, previous, next, 1 2 3 ... x
	* @param string The basic link to include in the href
	*/
	function getSinglePageLink( $link ) {
		$txt = '';

		$displayed_pages = 10;
		$total_pages = $this->limit ? ceil( $this->total / $this->limit ) : 0;
		$this_page = $this->limit ? ceil( ($this->limitstart+1) / $this->limit ) : 1;
		$start_loop = (floor(($this_page-1)/$displayed_pages))*$displayed_pages+1;
		if ($start_loop + $displayed_pages - 1 < $total_pages) {
			$stop_loop = $start_loop + $displayed_pages - 1;
		} else {
			$stop_loop = $total_pages;
		}

		$link .= '&amp;limit='. $this->limit;

		if (!defined( '_PN_LT' ) || !defined( '_PN_RT' ) ) {
			DEFINE('_PN_LT','&lt;');
			DEFINE('_PN_RT','&gt;');
		}

		$pnSpace = '';
		if (_PN_LT || _PN_RT) $pnSpace = "&nbsp;";

		if ($this_page > 1) {
			$page = ($this_page - 2) * $this->limit;
			//$txt .= '<a href="'. JRoute::_( "$link&amp;limitstart=0" ) .'" class="hwdpsNav" title="'. _PN_START .'">&laquo;</a> ';
			$txt .= '<a href="'. JRoute::_( "$link&amp;limitstart=$page" ) .'" class="hwdpsNav" title="'. _HWDPS_PN_PREVIOUS .'">'._HWDPS_PN_PREVIOUS.'</a> ';
		} else {
			//$txt .= '<span class="hwdpsNav">&laquo;</span> ';
			$txt .= '<span class="hwdpsNav">'._HWDPS_PN_PREVIOUS.'</span> ';
		}

		$txt .= ' | ';

		//for ($i=$start_loop; $i <= $stop_loop; $i++) {
		//	$page = ($i - 1) * $this->limit;
		//	if ($i == $this_page) {
		//		$txt .= '<span class="hwdpsNav">'. $i .'</span> ';
		//	} else {
		//		$txt .= '<a href="'. JRoute::_( $link .'&amp;limitstart='. $page ) .'" class="hwdpsNav"><strong>'. $i .'</strong></a> ';
		//	}
		//}

		if ($this_page < $total_pages) {
			$page = $this_page * $this->limit;
			$end_page = ($total_pages-1) * $this->limit;
			$txt .= '<a href="'. JRoute::_( $link .'&amp;limitstart='. $page ) .'" class="hwdpsNav" title="'. _HWDPS_PN_NEXT .'">'._HWDPS_PN_NEXT.'</a> ';
			//$txt .= '<a href="'. JRoute::_( $link .'&amp;limitstart='. $end_page ) .'" class="hwdpsNav" title="'. _PN_END .'">&raquo;</a>';
		} else {
			$txt .= '<span class="hwdpsNav">'._HWDPS_PN_NEXT.'</span> ';
			//$txt .= '<span class="hwdpsNav">&raquo;</span>';
		}
		return $txt;
	}

	/**
	 * Sets the vars {PAGE_LINKS}, {PAGE_LIST_OPTIONS} and {PAGE_COUNTER} for the page navigation template
	 * @param object The patTemplate object
	 * @param string The full link to be used in the nav link, eg index.php?option=com_content
	 * @param string The name of the template to add the variables
	 */
	function setTemplateVars( &$tmpl, $link = '', $name = 'admin-list-footer' ) {
		$tmpl->addVar( $name, 'PAGE_LINKS', $this->writePagesLinks( $link ) );
		$tmpl->addVar( $name, 'PAGE_LIST_OPTIONS', $this->getLimitBox( $link ) );
		$tmpl->addVar( $name, 'PAGE_COUNTER', $this->writePagesCounter() );
	}
}
?>