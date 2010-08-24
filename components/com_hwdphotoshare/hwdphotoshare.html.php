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
class hwd_ps_html
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
    function frontpage($featured_photos, $recent_albums, $recent_tags, $recent_photos)
    {
		global $smartyps, $mainframe, $params;
		$c = hwd_ps_Config::get_instance();

		// load the menu name
		jimport( 'joomla.application.menu' );
		$menu   = &JMenu::getInstance('site');
		$active = &$menu->getActive();
		if (!empty($active->name)) {$metatitle = $active->name;} else {$metatitle = _HWDPS_META_DEFAULT;}
		// set the page/meta title
		$mainframe->setPageTitle( $metatitle );
		$mainframe->addMetaTag( 'title' , $metatitle );
		hwd_ps_tools::generateActiveLink(1);

		// define javascript
		hwd_ps_javascript::confirmdelete();

		$k = 0;
		if (count($featured_photos) > 0) {

			$smartyps->assign("print_featured_photos", 1);

			$iCID = 'featuredPhotos';
			$params['novtd'] = min(count($featured_photos), $c->fp_nos);
			$params['isize'] = 400;

			$mainframe->addCustomHeadTag('<script type="text/javascript" src="'.JURI::root( true ).'/components/com_hwdphotoshare/assets/js/icarousel.js"></script> ');
			require_once(JPATH_SITE.DS.'administrator'.DS.'components'.DS.'com_hwdphotoshare'.DS.'helpers'.DS.'carousel.php');
			hwdpsCarousel::setupSlider($iCID, $params);

			$smartyps->assign("featured_iCID", $iCID);
			$smartyps->assign("featured_isize", $params['isize']);

			$list_featured_photos = hwd_ps_tools::generatePhotoListFromSql($featured_photos);
			$smartyps->assign("list_featured_photos", $list_featured_photos);
			$smartyps->assign("featured_resize_main", $c->resize_main);
			$smartyps->assign("featured_resize_thumb", $c->resize_thumb);

		}

		if (count($recent_albums) > 0) {
			$smartyps->assign("print_recent_albums", 1);
			$list_recent_albums = hwd_ps_tools::generateAlbumListFromSql($recent_albums, "1");
			$smartyps->assign("list_recent_albums", $list_recent_albums);
		}

		if (count($recent_tags) > 0 && $c->fp_showt == 1) {
			$list_recent_tags = hwd_ps_tools::generateTagListArrayFromSql($recent_tags);
			if (count($list_recent_tags) > 0) {
				$smartyps->assign("print_recent_tags", 1);
				$smartyps->assign("list_recent_tags", $list_recent_tags);
			}
		}

		if ($c->fp_showg == 1) {
			$smartyps->assign("print_recent_groups", 1);
		}

		if (count($recent_photos) > 0) {

			$smartyps->assign("print_recent_photos", 1);

			$iCID = 'recentPhotos';
			$params['novtd'] = min(count($featured_photos), $c->fp_nos);
			$params['isize'] = 400;

			$mainframe->addCustomHeadTag('<script type="text/javascript" src="'.JURI::root( true ).'/components/com_hwdphotoshare/assets/js/icarousel.js"></script> ');
			require_once(JPATH_SITE.DS.'administrator'.DS.'components'.DS.'com_hwdphotoshare'.DS.'helpers'.DS.'carousel.php');
			hwdpsCarousel::setupScroller($iCID, $params);

			$smartyps->assign("recent_iCID", $iCID);
			$smartyps->assign("recen_isize", $params['isize']);

			$list_recent_photos = hwd_ps_tools::generatePhotoListFromSql($recent_photos);
			$smartyps->assign("list_recent_photos", $list_recent_photos);
			$smartyps->assign("recent_resize_main", $c->resize_main);
			$smartyps->assign("recent_resize_thumb", $c->resize_thumb);

		}

		$smartyps->display('index.tpl');
		return;
    }
    /**
     * Outputs results from user search
     *
     * @param string $option  the joomla component name
     * @param int    $totalvids  the total matching video count
     * @param array  $matchingvids  array of matching video data
     * @param object $videoNav  page navigation object
     * @param int    $totalgroups  the total matching group count
     * @param array  $matchinggroups  array of matching group data
     * @param object $groupNav  page navigation object
     * @param string $searchterm  the search pattern from user search
     * @return       Nothing
     */
    function search($totalphotos, $matchingphotos, $photoNav, $totalalbums, $matchingalbums, $albumsNav, $totalgroups, $matchinggroups, $groupNav, $searchterm)
    {
		global $Itemid, $my, $mainframe, $smartyps, $params;
		$c = hwd_ps_Config::get_instance();
		// load the menu name
		jimport( 'joomla.application.menu' );
		$menu   = &JMenu::getInstance('site');
		$active = &$menu->getActive();
		if (!empty($active->name)) {$metatitle = $active->name;} else {$metatitle = _HWDPS_META_DEFAULT;}
		// set the page/meta title
		$mainframe->setPageTitle( $metatitle );
		$mainframe->addMetaTag( 'title' , $metatitle );
		hwd_ps_tools::generateActiveLink(1);

		$smartyps->assign("searchterm", $searchterm);

		if (count($matchingphotos) > 0) {
			$smartyps->assign("print_matchphotos", 1);
			$matchingp = hwd_ps_tools::generatePhotoListFromSql($matchingphotos);
			$smartyps->assign("matchingphotos", $matchingp);
		} else {
			$smartyps->assign("mpempty", _HWDPS_INFO_NMP);
		}

		if (count($matchingalbums) > 0) {
			$smartyps->assign("print_matchalbums", 1);
			$matchinga = hwd_ps_tools::generateAlbumListFromSql($matchingalbums);
			$smartyps->assign("matchingalbums", $matchinga);
		} else {
			$smartyps->assign("maempty", _HWDPS_INFO_NMA);
		}

		if (count($matchinggroups) > 0) {
			$smartyps->assign("print_matchgroups", 1);
			$matchingg = hwd_ps_tools::generateGroupListFromSql($matchinggroups);
			$smartyps->assign("matchinggroups", $matchingg);
		} else {
			$smartyps->assign("mgempty", _HWDPS_INFO_NMG);
		}

		$smartyps->display('search.tpl');
		return;
    }
    /**
     * Constructs the video player page
     *
     * @param string $option  the joomla component name
     * @param array  $row  the array containing video information
     * @return       Nothing
     */
    function viewAlbum($rows, $pageNav, $total, $albumdetails, $total_pending)
    {
		global $mainframe, $Itemid, $my, $params, $smartyps, $mosConfig_sitename, $mosConfig_fromname, $mosConfig_mailfrom;
		$c = hwd_ps_Config::get_instance();
		$my = & JFactory::getUser();

		// load the menu name
		jimport( 'joomla.application.menu' );
		$menu   = &JMenu::getInstance('site');
		$active = &$menu->getActive();
		if (!empty($active->name)) {$metatitle = $active->name;} else {$metatitle = _HWDPS_META_DEFAULT;}
		// decode
		$meta_title = html_entity_decode($albumdetails->title);
		$meta_description = html_entity_decode($albumdetails->description);
		$meta_tags = html_entity_decode($albumdetails->tags);
		// set the page/meta title
		$mainframe->setPageTitle( $metatitle." - ".$meta_title );
		$mainframe->addMetaTag( 'title' , $metatitle." - ".$meta_title );
		$mainframe->addMetaTag( 'description' , $meta_description );
		$mainframe->addMetaTag( 'keywords' , $meta_tags );

		hwd_ps_tools::generateActiveLink(1);

		$smartyps->assign("link_viewslideshow", JURI::root(true)."/index.php?option=com_hwdphotoshare&task=viewslideshow&album_id=".$albumdetails->id);
		if ($my->id == $albumdetails->user_id) {
			$smartyps->assign("print_editlink", 1);
			$smartyps->assign("link_editalbum", JURI::root(true)."/index.php?option=com_hwdphotoshare&task=editalbum&album_id=".$albumdetails->id);
		} else {
			$smartyps->assign("print_profilelink", 1);
			$username = hwd_ps_tools::generateUserFromID($albumdetails->user_id);
			$smartyps->assign("username", $username);
		}

			$album->title = $albumdetails->title;
			$album->description = $albumdetails->description;
			$album->datecreated = date("ga - F j, Y", strtotime($albumdetails->date_created));
			$album->datemodified = date("ga - F j, Y", strtotime($albumdetails->date_modified));
			$album->deletevideo = hwd_ps_tools::generateDeleteAlbumLink($albumdetails);
			$album->editvideo = hwd_ps_tools::generateEditAlbumLink($albumdetails);

			if (!empty($albumdetails->location)) {
				$smartyps->assign("print_location", 1);
				$album->location = $albumdetails->location;
			}


			$smartyps->assign("album", $album);




		if (count($rows) > 0) {
			$smartyps->assign("print_photothumbs", 1);
			$photolist = hwd_ps_tools::generatePhotoListFromSql($rows);
			$smartyps->assign("photolist", $photolist);
		}


		$page = $total - $c->ppp;
		$pageData = $pageNav->getPagesCounter();
		$pageNavigation = null;
		if ( $page > 0 ) {
			$link = "index.php?option=com_hwdphotoshare&amp;Itemid=".$Itemid."&amp;task=viewalbum&amp;album_id=".$albumdetails->id;
			$pageNavigation.= $pageNav->getPagesLinks($link);
		}
		$smartyps->assign("pageNavigation", $pageNavigation);
		$smartyps->assign("pageData", $pageData);

		if ($total_pending > 0) {
			$smartyps->assign( "print_pending" , 1);
		}



		$smartyps->display('album_view.tpl');

		return;
    }
    /**
     * Constructs the video player page
     *
     * @param string $option  the joomla component name
     * @param array  $row  the array containing video information
     * @return       Nothing
     */
    function viewPhoto($row, $pageNav, $total, $album_details)
    {
		global $mainframe, $Itemid, $params, $smartyps, $mosConfig_sitename, $mosConfig_fromname, $mosConfig_mailfrom;
		$c = hwd_ps_Config::get_instance();
		$my = & JFactory::getUser();

		// load the menu name
		jimport( 'joomla.application.menu' );
		$menu   = &JMenu::getInstance('site');
		$active = &$menu->getActive();
		if (!empty($active->name)) {$metatitle = $active->name;} else {$metatitle = _HWDPS_META_DEFAULT;}
		// decode
		if (!empty($row[0]->title)) {$meta_title = html_entity_decode($row[0]->title);} else {$meta_title = _HWDPS_META_DEFAULT;}
		if (!empty($row[0]->description)) {$meta_description = html_entity_decode($row[0]->description);} else {$meta_description = _HWDPS_META_DEFAULT;}
		if (!empty($row[0]->tags)) {$meta_tags = html_entity_decode($row[0]->tags);} else {$meta_tags = _HWDPS_META_DEFAULT;}

		// set the page/meta title
		$mainframe->setPageTitle( $metatitle." - ".$meta_title );
		$mainframe->addMetaTag( 'title' , $metatitle." - ".$meta_title );
		$mainframe->addMetaTag( 'description' , $meta_description );
		$mainframe->addMetaTag( 'keywords' , $meta_tags );

		hwd_ps_tools::generateActiveLink(1);

		if ($row[0]->album_id !== "0") {

			// back
			$smartyps->assign("back_link", JURI::root(true)."/index.php?option=com_hwdphotoshare&task=viewalbum&album_id=".$album_details->id);
			$smartyps->assign("back_text", _HWDPS_BACKTOALBUM);

			//slideshow
			$smartyps->assign("ss_link", JURI::root(true)."/index.php?option=com_hwdphotoshare&task=viewslideshow&album_id=".$album_details->id);
			$smartyps->assign("ss_text", _HWDPS_VIEWSS);

			if ($my->id == $row[0]->user_id) {
				$smartyps->assign("edit_print", 1);
				$smartyps->assign("edit_link", JURI::root(true)."/index.php?option=com_hwdphotoshare&task=editalbum&album_id=".$row[0]->id);
				$smartyps->assign("edit_text", _HWDPS_EDITALBUM);
			} else {
				$username = hwd_ps_tools::generateUserFromID($row[0]->user_id);
				$smartyps->assign("profile_print", 1);
				$smartyps->assign("profile_link", 1);
			}

		} else {

			// back
			$smartyps->assign("back_link", JURI::root(true)."/index.php?option=com_hwdphotoshare&task=viewcategory&cat_id=".$row[0]->category_id);
			$smartyps->assign("back_text", _HWDPS_BACKTOCATEGORY);

			//slideshow
			$smartyps->assign("ss_link", JURI::root(true)."/index.php?option=com_hwdphotoshare&task=viewslideshow&category_id=".$row[0]->category_id);
			$smartyps->assign("ss_text", _HWDPS_VIEWSS);

			if ($my->id == $row[0]->user_id) {
				$smartyps->assign("edit_print", 1);
				$smartyps->assign("edit_link", JURI::root(true)."/index.php?option=com_hwdphotoshare&task=editphoto&photo_id=".$row[0]->id);
				$smartyps->assign("edit_text", _HWDPS_EDITALBUM);
			} else {
				$username = hwd_ps_tools::generateUserFromID($row[0]->user_id);
				$smartyps->assign("profile_print", 1);
				$smartyps->assign("profile_link", 1);
				$smartyps->assign("profile_username", $username);
			}

		}

		$smartyps->assign("deletevideo", hwd_ps_tools::generateDeleteAlbumLink($album_details));
		$smartyps->assign("editvideo", hwd_ps_tools::generateEditAlbumLink($album_details));
		$smartyps->assign("socialbmlinks", hwd_ps_tools::generateSocialBookmarks());



		$pageData = $pageNav->getPageCounter();
		$pageNavigation = null;

		$link = "index.php?option=com_hwdphotoshare&amp;Itemid=".$Itemid."&amp;task=viewphoto&amp;album_id=".$album_details->id;
		$pageNavigation.= $pageNav->getSinglePageLink($link);

		$smartyps->assign("pageNavigation", $pageNavigation);
		$smartyps->assign("pageData", $pageData);

		$row = $row[0];
		if (count($row) > 0) {
			$photo->photo = hwd_ps_tools::generatePhoto($row);
			$photo->caption = $row->caption;
			if (!empty($photo->caption)) {
				$smartyps->assign("print_caption", 1);
			}
			$photo->title = $row->title;
			$photo->category = hwd_ps_tools::generateCategoryLink( $row->category_id );

			hwd_ps_javascript::ajaxRate($row);
			$photo->ratingsystem = hwd_ps_tools::generateRatingSystem($row);



			$photo->commentingsystem = hwd_ps_tools::generatePhotoComments($row);
			$photo->ratingsystem = hwd_ps_tools::generateRatingSystem($row);
			$photo->commentsystem = hwd_ps_tools::generatePhotoComments($row);

			if (!isset($row->avatar)) { $row->avatar = ''; }
			$photo->avatar = hwd_ps_tools::generateAvatar($row->user_id, $row->avatar);

			$photo->tags = hwd_ps_tools::generateTagListString($row);
			if (!empty($photo->tags) && $c->showtags == "1") {
				$smartyps->assign("print_tags", 1);
			}
			if (empty($row->location)) {
				$photo->location = "Unknown Location";
			} else {
				$photo->location = $row->location;
			}
			$photo->views = $row->number_of_views;
			$photo->uploaded = $row->date_uploaded;
			$photo->album_title = $album_details->title;
			$photo->album_description = $album_details->description;

			$photo->album_description = $album_details->description;

			if ($c->showatfb == "1") {
				$photo->favourites = hwd_ps_tools::generateFavouriteButton($row);
			}
			if ($c->showdlor == "1") {
				$photo->download = hwd_ps_tools::generateDownloadPhotoButton($row);
			}



			$smartyps->assign("photo", $photo);
		}

		$smartyps->display('photo_display.tpl');

		return;
    }
    /**
     * Lists all available categories
     *
     * @param string $option  the joomla component name
     * @param array  $row  the array containing category information
     * @return       Nothing
     */
    function categories($rows)
    {
		global $Itemid, $mainframe, $smartyps, $params, $hide_js, $pop;
		$c = hwd_ps_Config::get_instance();
		$my = & JFactory::getUser();
  		$db =& JFactory::getDBO();

		// load the menu name
		jimport( 'joomla.application.menu' );
		$menu   = &JMenu::getInstance('site');
		$active = &$menu->getActive();
		if (!empty($active->name)) {$metatitle = $active->name;} else {$metatitle = _HWDPS_META_DEFAULT;}
		// set the page/meta title
		$mainframe->setPageTitle( $metatitle );
		$mainframe->addMetaTag( 'title' , $metatitle );
		hwd_ps_tools::generateActiveLink(2);

$width = null;
$height = null;
$class = null;

		$k = 0;
		if (count($rows) > 0) {
			$smartyps->assign("print_categories", 1);
			$z = 0;
			for ($i=0, $m=count($rows); $i < $m; $i++) {
				$row = $rows[$i];
				$list[$z]->level = 0;
				$list[$z]->thumbnail = hwd_ps_tools::generateCategoryThumbnailLink( $row, $k, $width, $height, "ps-cl-thumb");
				$list[$z]->title = hwd_ps_tools::generateCategoryLink($row->id, $row->category_name);
				$list[$z]->num_albums = $row->num_albums;
				$list[$z]->num_subcats = $row->num_subcats;
				$list[$z]->description = hwd_ps_tools::truncateText($row->category_description, $c->truncdesc);
				$list[$z]->k = $k;
				$k = 1 - $k;

				$query = 'SELECT *'
						. ' FROM #__hwdpscategories'
						. ' WHERE published = 1'
						. ' AND parent = '.$row->id
						. ' ORDER BY ordering, category_name'
						;
				$db->setQuery( $query );
				$subs1 = $db->loadObjectList();
				if (count($subs1) > 0) {
					for ($j=0, $n=count($subs1); $j < $n; $j++) {
						$z++;
						$sub1 = $subs1[$j];
						$list[$z]->level = 1;
						$list[$z]->thumbnail = hwd_ps_tools::generateCategoryThumbnailLink($sub1, $k, $width, $height, "ps-cl-thumb");
						$list[$z]->title = hwd_ps_tools::generateCategoryLink($sub1->id, $sub1->category_name);
						$list[$z]->num_albums = $sub1->num_albums;
						$list[$z]->num_subcats = $sub1->num_subcats;
						$list[$z]->description = null;
						$list[$z]->k = $k;
						$k = 1 - $k;

						$query = 'SELECT *'
								. ' FROM #__hwdpscategories'
								. ' WHERE published = 1'
								. ' AND parent = '.$sub1->id
								. ' ORDER BY ordering, category_name'
								;
						$db->setQuery( $query );
						$subs2 = $db->loadObjectList();
						if (count($subs2) > 0) {
							for ($l=0, $o=count($subs2); $l < $o; $l++) {
								$z++;
								$sub2 = $subs2[$l];
								$list[$z]->level = 2;
								$list[$z]->thumbnail = null;
								$list[$z]->title = hwd_ps_tools::generateCategoryLink($sub2->id, $sub2->category_name);
								$list[$z]->num_albums = $sub2->num_albums;
								$list[$z]->num_subcats = $sub2->num_subcats;
								$list[$z]->description = null;
								$list[$z]->k = $k;
								$k = 1 - $k;
							}
						}
					}
				}
			$z++;
			}
			$smartyps->assign("list", $list);
		}
		$smartyps->display('category_index.tpl');
		return;


    }
    /**
     * Constructs the category page and lists all category videos
     *
     * @param string $option  the joomla component name
     * @param array  $rows  the array containing video information
     * @param object $pageNav  the page navigation object
     * @param int    $total  the total category video count
     * @param int    $cat_id  the id of the category
     * @param array  $cat  the array containing category information
     * @return       Nothing
     */
    function viewCategory($rows, $pageNav, $total, $cat_id, $cat, $subcats)
    {
    	global $Itemid, $smartyps, $my, $mainframe, $params;
		$c = hwd_ps_Config::get_instance();

		// load the menu name
		jimport( 'joomla.application.menu' );
		$menu   = &JMenu::getInstance('site');
		$active = &$menu->getActive();
		if (!empty($active->name)) {$metatitle = $active->name;} else {$metatitle = _HWDPS_META_DEFAULT;}
		// set the page/meta title
		$mainframe->setPageTitle( $metatitle );
		$mainframe->addMetaTag( 'title' , $metatitle );
		hwd_ps_tools::generateActiveLink(2);

		$smartyps->assign("category_name", $cat->category_name);

		if (count($rows) > 0) {
			$smartyps->assign("print_albumlist", 1);
			$list = hwd_ps_tools::generateAlbumListFromSql($rows);
			$smartyps->assign("list", $list);
		}

		$page = $total - $c->app;
		$pageNavigation = null;
		if ( $page > 0 ) {
			$link = "index.php?option=com_hwdphotoshare&task=viewcategory&cat_id=".$cat_id."&amp;Itemid=".$Itemid;
			$pageNavigation.= "<div class=\"pagenavi\" align=\"center\">";
			$pageNavigation.= $pageNav->getPagesLinks($link);
			$pageNavigation.= "<div class=\"pagecount\">".$pageNav->getPagesCounter()."</div>";
			$pageNavigation.= "</div>";
		}
		$smartyps->assign("pageNavigation", $pageNavigation);

		if (count($subcats) > 0) {
			$smartyps->assign("print_subcategories", 1);

			$k=0;
			for ($i=0, $m=count($subcats); $i < $m; $i++) {
				$row = $subcats[$i];
				$subcatlist[$i]->level = 0;
				$subcatlist[$i]->thumbnail = hwd_ps_tools::generateCategoryThumbnailLink( $row, $k, null, null, "ps-cl-thumb");
				$subcatlist[$i]->title = hwd_ps_tools::generateCategoryLink($row->id, $row->category_name);
				$subcatlist[$i]->num_vids = $row->num_albums;
				$subcatlist[$i]->num_subcats = $row->num_subcats;
				$subcatlist[$i]->description = hwd_ps_tools::truncateText($row->category_description, $c->truncdesc);
				$subcatlist[$i]->k = $k;
				$k = 1 - $k;
			}
			$smartyps->assign("subcatlist", $subcatlist);
		}

		$smartyps->display('category_view.tpl');
		return;
    }


    /**
     * Outputs results from user search
     *
     * @param string $option  the joomla component name
     * @param int    $totalvids  the total matching video count
     * @param array  $matchingvids  array of matching video data
     * @param object $videoNav  page navigation object
     * @param int    $totalgroups  the total matching group count
     * @param array  $matchinggroups  array of matching group data
     * @param object $groupNav  page navigation object
     * @param string $searchterm  the search pattern from user search
     * @return       Nothing
     */
    function uploadMedia($albums, $count_pending)
    {
		global $mainframe, $Itemid, $my, $params, $smartyps;
		$c = hwd_ps_Config::get_instance();

		// load the menu name
		jimport( 'joomla.application.menu' );
		$menu   = &JMenu::getInstance('site');
		$mparams = &$menu->getParams($Itemid);
		$mparams_pt	= $mparams->get( 'page_title', '');
		$mparams_st	= $mparams->get( 'show_page_title', '0');

		$active = &$menu->getActive();

		if (!empty($mparams_pt) && ($mparams_st	== 1)) {
			$metatitle = $mparams_pt;
		} else if (!empty($active->name)) {
			$metatitle = $active->name;
		} else {
			$metatitle = _HWDPS_META_DEFAULT;
		}

		// set the page/meta title
		$mainframe->setPageTitle( $metatitle." - "._HWDPS_META_UPLD );
		$mainframe->addMetaTag( 'title' , $metatitle." - "._HWDPS_META_UPLD );
		hwd_ps_tools::generateActiveLink(4);

		if (count($albums) == 0) {
			$smartyps->assign("print_noAlbums", 1);
		}

		if ($count_pending > 0) {
			$smartyps->assign("print_pending", 1);
		}

		if ($c->upld_cats == 1) {
			$smartyps->assign("print_categoryupload", 1);
		}

		$albumOptions = null;
		for ($i=0, $n=count($albums); $i < $n; $i++) {
			$album = $albums[$i];
			$albumOptions .= '<option value="'.$album->id.'">'.$album->title.'</option>';
		}
		$smartyps->assign("albumOptions", $albumOptions);
		$smartyps->assign("uploadForm", JRoute::_("index.php?option=com_hwdphotoshare&Itemid=".$Itemid."&task=upload"));

		$smartyps->display('upload_choice.tpl');
		return;


    }


    /**
     * Outputs results from user search
     *
     * @param string $option  the joomla component name
     * @param int    $totalvids  the total matching video count
     * @param array  $matchingvids  array of matching video data
     * @param object $videoNav  page navigation object
     * @param int    $totalgroups  the total matching group count
     * @param array  $matchinggroups  array of matching group data
     * @param object $groupNav  page navigation object
     * @param string $searchterm  the search pattern from user search
     * @return       Nothing
     */
    function createAlbum()
    {
		global $mainframe, $Itemid, $database, $my, $params, $smartyps, $option, $Itemid;
		$c = hwd_ps_Config::get_instance();

		// load the menu name
		jimport( 'joomla.application.menu' );
		$menu   = &JMenu::getInstance('site');
		$active = &$menu->getActive();
		if (!empty($active->name)) {$metatitle = $active->name;} else {$metatitle = _HWDPS_META_DEFAULT;}
		// set the page/meta title
		$mainframe->setPageTitle( $metatitle );
		$mainframe->addMetaTag( 'title' , $metatitle );
		hwd_ps_tools::generateActiveLink(4);
		// define javascript
		hwd_ps_javascript::chkNewAlbumForm();

		$form_add_album = JURI::root(true)."/index.php?option=com_hwdphotoshare&amp;Itemid=".$Itemid."&amp;task=savealbum";
		$smartyps->assign("form_add_album", $form_add_album);
		$captcha = hwd_ps_tools::generateCaptcha();
		$smartyps->assign("captcha", $captcha);

		$smartyps->display('album_add.tpl');
		return;
    }

    /**
     * Constructs a video list of all user videos
     *
     * @param string $option  the joomla component name
     * @param array  $rows  the array containing video information
     * @param object $pageNav  the page navigation object
     * @param int    $total  the total video count
     * @return       Nothing
     */
    function albumPrivacy($rows)
    {
		global $smartyps, $Itemid, $mainframe, $params, $my, $hide_js, $pop;
		$c = hwd_ps_Config::get_instance();

		// load the menu name
		jimport( 'joomla.application.menu' );
		$menu   = &JMenu::getInstance('site');
		$active = &$menu->getActive();
		if (!empty($active->name)) {$metatitle = $active->name;} else {$metatitle = _HWDPS_META_DEFAULT;}
		// set the page/meta title
		$mainframe->setPageTitle( $metatitle." - "._HWDPS_META_AP );
		$mainframe->addMetaTag( 'title' , $metatitle." - "._HWDPS_META_AP );
		hwd_ps_tools::generateActiveLink(4);

		if (count($rows) > 0) {
			$smartyps->assign("print_videolist", 1);
			$list = hwd_ps_tools::generateAlbumListFromSql($rows);
			$smartyps->assign("list", $list);
		}


		$smartyps->assign( "form_albumprivacy" , JURI::root( true )."/index.php?option=com_hwdphotoshare&Itemid=".$Itemid."&task=savealbumprivacy");
		$smartyps->assign( "link_createalbum" , JRoute::_("index.php?option=com_hwdphotoshare&Itemid=".$Itemid."&task=createalbum")  );
		$smartyps->assign( "link_viewalbums" , JRoute::_("index.php?option=com_hwdphotoshare&Itemid=".$Itemid."&task=yourphotos")  );

		$smartyps->display('album_albumprivacy.tpl');
		return;
    }

    /**
     * Constructs the group list page and lists all groups
     *
     * @param string $option  the joomla component name
     * @param array  $rows  the array containing group information
     * @param array  $rowsfeatured  the array containing featured group information
     * @param object $pageNav  the page navigation object
     * @param int    $total  the total group count
     * @return       Nothing
     */
    function albums($rows, $pageNav, $total, $sort)
    {
		global $Itemid, $mainframe, $smartyps, $params, $my;
		$c = hwd_ps_Config::get_instance();

		// load the menu name
		jimport( 'joomla.application.menu' );
		$menu   = &JMenu::getInstance('site');
		$active = &$menu->getActive();
		if (!empty($active->name)) {$metatitle = $active->name;} else {$metatitle = _HWDPS_META_DEFAULT;}
		// set the page/meta title
		$mainframe->setPageTitle( $metatitle );
		$mainframe->addMetaTag( 'title' , $metatitle );
		hwd_ps_tools::generateActiveLink(1);
		// define javascript
		hwd_ps_javascript::confirmdelete();

		$k = 0;
		if (count($rows) > 0) {
			$smartyps->assign("print_grouplist", 1);
			$list = hwd_ps_tools::generateAlbumListFromSql($rows);
			$smartyps->assign("list", $list);
		}

		$page = $total - $c->app;
		$pageNavigation = null;
		if ( $page > 0 ) {
			$link = "index.php?option=com_hwdphotoshare&amp;task=yourphotos&amp;Itemid=".$Itemid;
			$pageNavigation.= "<div class=\"pagenavi\" align=\"center\">";
			$pageNavigation.= $pageNav->getPagesLinks($link);
			$pageNavigation.= "<div class=\"pagecount\">".$pageNav->getPagesCounter()."</div>";
			$pageNavigation.= "</div>";
		}
		$smartyps->assign("pageNavigation", $pageNavigation);

		$smartyps->assign( "featured_link" , JRoute::_("index.php?option=com_hwdphotoshare&Itemid=".$Itemid."&task=featuredgroups")  );

		$smartyps->assign( "print_sortoptions" , 1 );
		$url_sort_featured = JRoute::_("index.php?option=com_hwdphotoshare&Itemid=".$Itemid."&task=albums&sort=featured");
		$url_sort_recent = JRoute::_("index.php?option=com_hwdphotoshare&Itemid=".$Itemid."&task=albums&sort=recent");
		$url_sort_updated = JRoute::_("index.php?option=com_hwdphotoshare&Itemid=".$Itemid."&task=albums&sort=updated");
		$url_sort_biggest = JRoute::_("index.php?option=com_hwdphotoshare&Itemid=".$Itemid."&task=albums&sort=biggest");

		$sel_f = $sel_r = $sel_u = $sel_b = '';
		if ($sort == "featured") {$sel_f = 'selected="selected"';}
		if ($sort == "recent") {$sel_r = 'selected="selected"';}
		if ($sort == "updated") {$sel_u = 'selected="selected"';}
		if ($sort == "biggest") {$sel_b = 'selected="selected"';}

		$sort_options = '<option value="'.$url_sort_featured.'" '.$sel_f.'>Featured</option>
						 <option value="'.$url_sort_recent.'" '.$sel_r.'>Recent</option>
						 <option value="'.$url_sort_updated.'" '.$sel_u.'>Updated</option>
						 <option value="'.$url_sort_biggest.'" '.$sel_b.'>Biggest</option>';

		$smartyps->assign( "sort_options" , $sort_options );

		$smartyps->display('album_index.tpl');
		return;
    }

    /**
     * Constructs the group list page and lists all groups
     *
     * @param string $option  the joomla component name
     * @param array  $rows  the array containing group information
     * @param array  $rowsfeatured  the array containing featured group information
     * @param object $pageNav  the page navigation object
     * @param int    $total  the total group count
     * @return       Nothing
     */
    function photos($rows, $pageNav, $total, $sort)
    {
		global $Itemid, $mainframe, $smartyps, $params, $my;
		$c = hwd_ps_Config::get_instance();

		// load the menu name
		jimport( 'joomla.application.menu' );
		$menu   = &JMenu::getInstance('site');
		$active = &$menu->getActive();
		if (!empty($active->name)) {$metatitle = $active->name;} else {$metatitle = _HWDPS_META_DEFAULT;}
		// set the page/meta title
		$mainframe->setPageTitle( $metatitle );
		$mainframe->addMetaTag( 'title' , $metatitle );
		hwd_ps_tools::generateActiveLink(1);
		// define javascript
		hwd_ps_javascript::confirmdelete();

		$k = 0;
		if (count($rows) > 0) {
			$smartyps->assign("print_photothumbs", 1);
			$photolist = hwd_ps_tools::generatePhotoListFromSql($rows);
			$smartyps->assign("photolist", $photolist);
		}

		$page = $total - $c->ppp;
		$pageData = $pageNav->getPagesCounter();
		$pageNavigation = null;
		if ( $page > 0 ) {
			$link = "index.php?option=com_hwdphotoshare&amp;Itemid=".$Itemid."&amp;task=photos";
			$pageNavigation.= $pageNav->getPagesLinks($link);
		}
		$smartyps->assign("pageNavigation", $pageNavigation);
		$smartyps->assign("pageData", $pageData);


		$smartyps->assign( "featured_link" , JRoute::_("index.php?option=com_hwdphotoshare&Itemid=".$Itemid."&task=featuredgroups")  );

		$smartyps->assign( "print_sortoptions" , 1 );
		$url_sort_featured = JRoute::_("index.php?option=com_hwdphotoshare&Itemid=".$Itemid."&task=photos&sort=featured");
		$url_sort_recent = JRoute::_("index.php?option=com_hwdphotoshare&Itemid=".$Itemid."&task=photos&sort=recent");
		$url_sort_updated = JRoute::_("index.php?option=com_hwdphotoshare&Itemid=".$Itemid."&task=photos&sort=updated");
		$url_sort_biggest = JRoute::_("index.php?option=com_hwdphotoshare&Itemid=".$Itemid."&task=photos&sort=biggest");

		if ($sort == "featured") {$sel_f = 'selected="selected"';}
		if ($sort == "recent") {$sel_r = 'selected="selected"';}
		if ($sort == "updated") {$sel_u = 'selected="selected"';}
		if ($sort == "biggest") {$sel_b = 'selected="selected"';}

		$sel_f = $sel_r = $sel_u = $sel_b = '';

		$sort_options = '<option value="'.$url_sort_featured.'" '.$sel_f.'>Featured</option>
						 <option value="'.$url_sort_recent.'" '.$sel_r.'>Recent</option>
						 <option value="'.$url_sort_updated.'" '.$sel_u.'>Updated</option>
						 <option value="'.$url_sort_biggest.'" '.$sel_b.'>Biggest</option>';

		$smartyps->assign( "sort_options" , $sort_options );

		$smartyps->display('photo_index.tpl');
		return;
    }

    /**
     * Constructs the group list page and lists all groups
     *
     * @param string $option  the joomla component name
     * @param array  $rows  the array containing group information
     * @param array  $rowsfeatured  the array containing featured group information
     * @param object $pageNav  the page navigation object
     * @param int    $total  the total group count
     * @return       Nothing
     */
    function groups($rows, $rowsfeatured, $pageNav, $total)
    {
		global $Itemid, $mainframe, $smartyps, $params, $my;
		$c = hwd_ps_Config::get_instance();

		// load the menu name
		jimport( 'joomla.application.menu' );
		$menu   = &JMenu::getInstance('site');
		$active = &$menu->getActive();
		if (!empty($active->name)) {$metatitle = $active->name;} else {$metatitle = _HWDPS_META_DEFAULT;}
		// set the page/meta title
		$mainframe->setPageTitle( $metatitle );
		$mainframe->addMetaTag( 'title' , $metatitle );
		hwd_ps_tools::generateActiveLink(3);
		// define javascript
		hwd_ps_javascript::confirmdelete();

		$k = 0;
		if (count($rowsfeatured) > 0) {
			$smartyps->assign("print_featured", 1);
			$featuredlist = hwd_ps_tools::generateGroupListFromSql($rowsfeatured);
			$smartyps->assign("featuredlist", $featuredlist);
		}

		if (count($rows) > 0) {
			$smartyps->assign("print_grouplist", 1);
			$list = hwd_ps_tools::generateGroupListFromSql($rows);
			$smartyps->assign("list", $list);
		}

		$page = $total - $c->gpp;
		$pageNavigation = null;
		if ( $page > 0 ) {
			$link = "index.php?option=com_hwdphotoshare&amp;Itemid=".$Itemid."&amp;task=groups";
			$pageNavigation.= "<div class=\"pagenavi\" align=\"center\">";
			$pageNavigation.= $pageNav->getPagesLinks($link);
			$pageNavigation.= "<div class=\"pagecount\">".$pageNav->getPagesCounter()."</div>";
			$pageNavigation.= "</div>";
		}
		$smartyps->assign("pageNavigation", $pageNavigation);

		$smartyps->assign( "featured_link" , JRoute::_("index.php?option=com_hwdphotoshare&Itemid=".$Itemid."&task=featuredgroups")  );

		$smartyps->display('group_index.tpl');
		return;
    }
    /**
     * Constructs the new group form
     *
     * @param string $option  the joomla component name
     * @return       Nothing
     */
    function createGroup()
    {
		global $mainframe, $Itemid, $database, $my, $params, $smartyps, $option, $Itemid;
		$c = hwd_ps_Config::get_instance();

		// load the menu name
		jimport( 'joomla.application.menu' );
		$menu   = &JMenu::getInstance('site');
		$active = &$menu->getActive();
		if (!empty($active->name)) {$metatitle = $active->name;} else {$metatitle = _HWDPS_META_DEFAULT;}
		// set the page/meta title
		$mainframe->setPageTitle( $metatitle );
		$mainframe->addMetaTag( 'title' , $metatitle );
		hwd_ps_tools::generateActiveLink(3);
		// define javascript
		hwd_ps_javascript::checkaddgroupform();

		$form_add_group = JURI::root(true)."/index.php?option=com_hwdphotoshare&amp;Itemid=".$Itemid."&amp;task=savegroup";
		$smartyps->assign("form_add_group", $form_add_group);
		$captcha = hwd_ps_tools::generateCaptcha();
		$smartyps->assign("captcha", $captcha);

		$smartyps->display('group_add.tpl');
		return;
    }
    /**
     * Constructs the group page and lists all containing group videos
     *
     * @param string $option  the joomla component name
     * @param array  $rows  the array containing video information
     * @param object $pageNav  the page navigation object
     * @param int    $total  the total video count
     * @param array  $groupdetails  the array containing group information
     * @return       Nothing
     */
    function viewGroup($rows, $pageNav, $total, $members, $groupdetails)
    {
		global $mainframe, $Itemid, $database, $smartyps, $my, $params, $hide_js, $pop;
		$c = hwd_ps_Config::get_instance();

		// load the menu name
		jimport( 'joomla.application.menu' );
		$menu   = &JMenu::getInstance('site');
		$active = &$menu->getActive();
		if (!empty($active->name)) {$metatitle = $active->name;} else {$metatitle = _HWDPS_META_DEFAULT;}
		// set the page/meta title
		$mainframe->setPageTitle( $metatitle );
		$mainframe->addMetaTag( 'title' , $metatitle );
		hwd_ps_tools::generateActiveLink(3);

		$smartyps->assign("group_name", stripslashes($groupdetails->group_name));
		$smartyps->assign("group_description", stripslashes($groupdetails->group_description));

		$group->totalmembers = $groupdetails->total_members;
		$group->totalphotos = $groupdetails->total_photos;
		$group->administrator = hwd_ps_tools::generateUserFromID($groupdetails->adminid);


		$group->groupmembership = hwd_ps_tools::generateGroupMembershipStatus($groupdetails);
		$group->reportgroup = hwd_ps_tools::generateReportGroupButton($groupdetails);
		$group->deletegroup = hwd_ps_tools::generateDeleteGroupButton($groupdetails);
		$group->editgroup = hwd_ps_tools::generateEditGroupButton($groupdetails);

		$smartyps->assign("group", $group);




		if (count($members) > 0) {
			$smartyps->assign("print_memberslist", 1);

			for ($i=0, $n=count($members); $i < $n; $i++) {
				$row = $members[$i];
				$memberslist[$i]->id = $row->id;
				$memberslist[$i]->username = $row->username;
			}

			$smartyps->assign("memberslist", $memberslist);
		}



		if (count($rows) > 0) {
			$smartyps->assign("print_videolist", 1);
			$list = hwd_ps_tools::generateVideoListFromSql($rows);
			$smartyps->assign("list", $list);
		}



		$page = $total - $c->ppp;
		$pageNavigation = null;
		if ( $page > 0 ) {
				$link = "index.php?option=com_hwdphotoshare&amp;Itemid=".$Itemid."&amp;task=viewgroup&amp;group_id=".$groupdetails->id;
			$pageNavigation.= "<div class=\"pagenavi\" align=\"center\">";
			$pageNavigation.= $pageNav->getPagesLinks($link);
			$pageNavigation.= "<div class=\"pagecount\">".$pageNav->getPagesCounter()."</div>";
			$pageNavigation.= "</div>";
		}
		$smartyps->assign("pageNavigation", $pageNavigation);











		$group->comments = hwd_ps_tools::generateGroupComments($groupdetails);

		$smartyps->display('group_view.tpl');
		return;



    }
    /**
     * Constructs a video list of all user videos
     *
     * @param string $option  the joomla component name
     * @param array  $rows  the array containing video information
     * @param object $pageNav  the page navigation object
     * @param int    $total  the total video count
     * @return       Nothing
     */
    function yourPhotos($rows_a, $rows_p, $pageNav, $total, $total_pending)
    {
		global $smartyps, $Itemid, $mainframe, $params, $my, $hide_js, $pop;
		$c = hwd_ps_Config::get_instance();

		// load the menu name
		jimport( 'joomla.application.menu' );
		$menu   = &JMenu::getInstance('site');
		$active = &$menu->getActive();
		if (!empty($active->name)) {$metatitle = $active->name;} else {$metatitle = _HWDPS_META_DEFAULT;}
		// set the page/meta title
		$mainframe->setPageTitle( $metatitle );
		$mainframe->addMetaTag( 'title' , $metatitle );
		hwd_ps_tools::generateActiveLink(1);

		if (count($rows_a) > 0) {
			$smartyps->assign("print_albumlist", 1);
			$list_a = hwd_ps_tools::generateAlbumListFromSql($rows_a);
			$smartyps->assign("list_a", $list_a);
		}

		if (count($rows_p) > 0) {
			$smartyps->assign("print_photolist", 1);
			$list_p = hwd_ps_tools::generatePhotoListFromSql($rows_p);
			$smartyps->assign("list_p", $list_p);
		}

		$page = $total - $c->ppp;
		$pageData = $pageNav->getPagesCounter();
		$pageNavigation = null;
		if ( $page > 0 ) {
			$link = "index.php?option=com_hwdphotoshare&amp;Itemid=".$Itemid."&amp;task=photos";
			$pageNavigation.= $pageNav->getPagesLinks($link);
		}
		$smartyps->assign("pageNavigation", $pageNavigation);
		$smartyps->assign("pageData", $pageData);


		if ($total_pending > 0) {
			$mainframe->enqueueMessage("You have albums that are waiting approval by the moderators.");
		}


		$smartyps->assign( "link_createalbum" , JRoute::_("index.php?option=com_hwdphotoshare&Itemid=".$Itemid."&task=createalbum")  );
		$smartyps->assign( "link_albumprivacy" , JRoute::_("index.php?option=com_hwdphotoshare&Itemid=".$Itemid."&task=albumprivacy")  );

		$smartyps->display('photo_yourphotos.tpl');
		return;
    }
    /**
     * Constructs a video list of all user favourite videos
     *
     * @param string $option  the joomla component name
     * @param array  $rows  the array containing video information
     * @param object $pageNav  the page navigation object
     * @param int    $total  the total video count
     * @return       Nothing
     */
    function yourFavourites($rows, $pageNav, $total)
    {
		global $Itemid, $smartyps, $mainframe, $params, $my, $hide_js, $pop;
		$c = hwd_ps_Config::get_instance();

		// load the menu name
		jimport( 'joomla.application.menu' );
		$menu   = &JMenu::getInstance('site');
		$active = &$menu->getActive();
		if (!empty($active->name)) {$metatitle = $active->name;} else {$metatitle = _HWDPS_META_DEFAULT;}
		// set the page/meta title
		$mainframe->setPageTitle( $metatitle );
		$mainframe->addMetaTag( 'title' , $metatitle );
		hwd_ps_tools::generateActiveLink(1);

		if (count($rows) > 0) {
			$smartyps->assign("print_photolist", 1);
			$list = hwd_ps_tools::generatePhotoListFromSql($rows);
			$smartyps->assign("list", $list);
		}

		$page = $total - $c->ppp;
		$pageNavigation = null;
		if ( $page > 0 ) {
			$link = "index.php?option=com_hwdphotoshare&amp;task=yourfavourites&amp;Itemid=".$Itemid;
			$pageNavigation.= "<div class=\"pagenavi\" align=\"center\">";
			$pageNavigation.= $pageNav->getPagesLinks($link);
			$pageNavigation.= "<div class=\"pagecount\">".$pageNav->getPagesCounter()."</div>";
			$pageNavigation.= "</div>";
		}
		$smartyps->assign("pageNavigation", $pageNavigation);

		$smartyps->display('photo_yourfavourites.tpl');
		return;

    }
    /**
     * Constructs a group list of all user groups
     *
     * @param string $option  the joomla component name
     * @param array  $rows  the array containing group information
     * @param object $pageNav  the page navigation object
     * @param int    $total  the total group count
     * @return       Nothing
     */
    function yourGroups($rows, $pageNav, $total)
    {
		global $Itemid, $smartyps, $mainframe, $params, $my, $hide_js, $pop;
		$c = hwd_ps_Config::get_instance();

		// load the menu name
		jimport( 'joomla.application.menu' );
		$menu   = &JMenu::getInstance('site');
		$active = &$menu->getActive();
		if (!empty($active->name)) {$metatitle = $active->name;} else {$metatitle = _HWDPS_META_DEFAULT;}
		// set the page/meta title
		$mainframe->setPageTitle( $metatitle );
		$mainframe->addMetaTag( 'title' , $metatitle );
		hwd_ps_tools::generateActiveLink(3);

		if (count($rows) > 0) {
			$smartyps->assign("print_grouplist", 1);
			$list = hwd_ps_tools::generateGroupListFromSql($rows);
			$smartyps->assign("list", $list);
		}

		$page = $total - $c->gpp;
		$pageNavigation = null;
		if ( $page > 0 ) {
					$link = "index.php?option=com_hwdphotoshare&amp;task=yourgroups&amp;Itemid=".$Itemid;
			$pageNavigation.= "<div class=\"pagenavi\" align=\"center\">";
			$pageNavigation.= $pageNav->getPagesLinks($link);
			$pageNavigation.= "<div class=\"pagecount\">".$pageNav->getPagesCounter()."</div>";
			$pageNavigation.= "</div>";
		}
		$smartyps->assign("pageNavigation", $pageNavigation);

		$smartyps->display('group_yourgroups.tpl');
		return;
    }
    /**
     * Constructs a group list of all user group memberships
     *
     * @param string $option  the joomla component name
     * @param array  $rows  the array containing group information
     * @param object $pageNav  the page navigation object
     * @param int    $total  the total group count
     * @return       Nothing
     */
    function yourMemberships($rows, $pageNav, $total)
    {
		global $Itemid, $smartyps, $mainframe, $params, $my, $hide_js, $pop;
		$c = hwd_ps_Config::get_instance();

		// load the menu name
		jimport( 'joomla.application.menu' );
		$menu   = &JMenu::getInstance('site');
		$active = &$menu->getActive();
		if (!empty($active->name)) {$metatitle = $active->name;} else {$metatitle = _HWDPS_META_DEFAULT;}
		// set the page/meta title
		$mainframe->setPageTitle( $metatitle );
		$mainframe->addMetaTag( 'title' , $metatitle );
		hwd_ps_tools::generateActiveLink(3);
		if (count($rows) > 0) {
			$smartyps->assign("print_grouplist", 1);
			$list = hwd_ps_tools::generateGroupListFromSql($rows);
			$smartyps->assign("list", $list);
		}

		$page = $total - $c->gpp;
		$pageNavigation = null;
		if ( $page > 0 ) {
					$link = "index.php?option=com_hwdphotoshare&amp;task=yourmemberships&amp;Itemid=".$Itemid;
			$pageNavigation.= "<div class=\"pagenavi\" align=\"center\">";
			$pageNavigation.= $pageNav->getPagesLinks($link);
			$pageNavigation.= "<div class=\"pagecount\">".$pageNav->getPagesCounter()."</div>";
			$pageNavigation.= "</div>";
		}
		$smartyps->assign("pageNavigation", $pageNavigation);

		$smartyps->display('group_yourgroupmemberships.tpl');
		return;
    }
    /**
     * Constructs a group list of all featured groups
     *
     * @param string $option  the joomla component name
     * @param array  $rows  the array containing group information
     * @param object $pageNav  the page navigation object
     * @param int    $total  the total group count
     * @return       Nothing
     */
    function featuredGroups($rows, $pageNav, $total)
    {
		global $Itemid, $smartyps, $mainframe, $params, $my, $hide_js, $pop;
		$c = hwd_ps_Config::get_instance();

		// load the menu name
		jimport( 'joomla.application.menu' );
		$menu   = &JMenu::getInstance('site');
		$active = &$menu->getActive();
		if (!empty($active->name)) {$metatitle = $active->name;} else {$metatitle = _HWDPS_META_DEFAULT;}
		// set the page/meta title
		$mainframe->setPageTitle( $metatitle );
		$mainframe->addMetaTag( 'title' , $metatitle );
		hwd_ps_tools::generateActiveLink(3);
		if (count($rows) > 0) {
			$smartyps->assign("print_grouplist", 1);
			$list = hwd_ps_tools::generateGroupListFromSql($rows);
			$smartyps->assign("list", $list);
		}

		$page = $total - $c->gpp;
		$pageNavigation = null;
		if ( $page > 0 ) {
					$link = "index.php?option=com_hwdphotoshare&task=featuredvids&Itemid=".$Itemid."&amp;task=featuredgroups";
			$pageNavigation.= "<div class=\"pagenavi\" align=\"center\">";
			$pageNavigation.= $pageNav->getPagesLinks($link);
			$pageNavigation.= "<div class=\"pagecount\">".$pageNav->getPagesCounter()."</div>";
			$pageNavigation.= "</div>";
		}
		$smartyps->assign("pageNavigation", $pageNavigation);

		$smartyps->display('group_featuredgroups.tpl');
		return;
    }
    /**
     * Loads video data to edit
     *
     * @param string $option  the joomla component name
     * @param array  $row  the array containing video information
     * @return       Nothing
     */
    function editGroupInfo($row, $grp_members)
    {
    	global $mainframe, $Itemid, $database, $my, $params, $mosConfig_absolute_path, $smartyps, $option, $Itemid;
        $c = hwd_ps_Config::get_instance();

		// load the menu name
		jimport( 'joomla.application.menu' );
		$menu   = &JMenu::getInstance('site');
		$active = &$menu->getActive();
		if (!empty($active->name)) {$metatitle = $active->name;} else {$metatitle = _HWDPS_META_DEFAULT;}

        $meta_title = html_entity_decode($row->group_name);

		// set the page/meta title
        $mainframe->setPageTitle( $metatitle." - "._HWDPS_META_EGROUP." - ".$meta_title );
        $mainframe->addMetaTag( 'title' , $metatitle." - "._HWDPS_META_EGROUP." - ".$meta_title );

		hwd_ps_tools::generateActiveLink(1);
		// define javascript
		hwd_ps_javascript::confirmdelete();

			$smartyps->assign("title", stripslashes($row->group_name));
			$smartyps->assign("description", stripslashes($row->group_description));
			$smartyps->assign("rowid", $row->id);
			$smartyps->assign("rowuid", $row->adminid);


		if (count($grp_members) > 0) {
			$smartyps->assign("print_grp_members", 1);
			$grp_memberlist = hwd_ps_tools::generateGroupMemberList($grp_members);
			$smartyps->assign("grp_memberlist", $grp_memberlist);
		}

			$smartyps->assign("form_edit_group", JURI::root(true)."/index.php?option=com_hwdphotoshare&task=updategroup");


		$smartyps->display('group_edit.tpl');
		return;
    }

    /**
     * Loads video data to edit
     *
     * @param string $option  the joomla component name
     * @param array  $row  the array containing video information
     * @return       Nothing
     */
    function editAlbumInfo($albumid, $row, $albumphotos)
    {
    	global $mainframe, $Itemid, $database, $my, $params, $smartyps, $option, $Itemid;
		$my = & JFactory::getUser();
        $c = hwd_ps_Config::get_instance();

		// load the menu name
		jimport( 'joomla.application.menu' );
		$menu   = &JMenu::getInstance('site');
		$active = &$menu->getActive();
		if (!empty($active->name)) {$metatitle = $active->name;} else {$metatitle = _HWDPS_META_DEFAULT;}
        // decode
        $meta_title = html_entity_decode($row->title);
        // set the page/meta title
        $mainframe->setPageTitle( $metatitle." - "._HWDPS_META_EA." - ".$meta_title );
        $mainframe->addMetaTag( 'title' , $metatitle." - "._HWDPS_META_EA." - ".$meta_title );
		hwd_ps_tools::generateActiveLink(4);
		// define javascript
		hwd_ps_javascript::chkUpdateAlbumForm();

    	//$mainframe->addCustomHeadTag('<script language="JavaScript" type="text/javascript" src="'.JURI::root(true).'/components/com_hwdphotoshare/js/tool-man/core.js"></script>');
    	//$mainframe->addCustomHeadTag('<script language="JavaScript" type="text/javascript" src="'.JURI::root(true).'/components/com_hwdphotoshare/js/tool-man/events.js"></script>');
    	//$mainframe->addCustomHeadTag('<script language="JavaScript" type="text/javascript" src="'.JURI::root(true).'/components/com_hwdphotoshare/js/tool-man/css.js"></script>');
    	//$mainframe->addCustomHeadTag('<script language="JavaScript" type="text/javascript" src="'.JURI::root(true).'/components/com_hwdphotoshare/js/tool-man/coordinates.js"></script>');
    	//$mainframe->addCustomHeadTag('<script language="JavaScript" type="text/javascript" src="'.JURI::root(true).'/components/com_hwdphotoshare/js/tool-man/drag.js"></script>');
    	//$mainframe->addCustomHeadTag('<script language="JavaScript" type="text/javascript" src="'.JURI::root(true).'/components/com_hwdphotoshare/js/tool-man/dragsort.js"></script>');
    	//$mainframe->addCustomHeadTag('<script language="JavaScript" type="text/javascript" src="'.JURI::root(true).'/components/com_hwdphotoshare/js/tool-man/cookies.js"></script>');
    	//$mainframe->addCustomHeadTag('<script language="JavaScript" type="text/javascript" src="'.JURI::root(true).'/components/com_hwdphotoshare/js/tool-man/hwd.js"></script>');

		jimport('joomla.html.pane');
		$pane =& JPane::getInstance('tabs');
		$startpane = $pane->startPane( 'reported-pane' );
		$endtab = $pane->endPanel();
		$endpane = $pane->endPane();
		$starttab0 = $pane->startPanel(_HWDPS_TAB_EDITPHOTOS, 'panel1' );
		$starttab1 = $pane->startPanel(_HWDPS_TAB_ADDMORE, 'panel2' );
		$starttab2 = $pane->startPanel(_HWDPS_TAB_EDITINFO, 'panel3' );
		$starttab3 = $pane->startPanel(_HWDPS_TAB_DELETE, 'panel4' );
		$starttab4 = $pane->startPanel(_HWDPS_TAB_ORGANISE, 'panel5' );



		$form_editphoto = JURI::root(true)."/index.php?option=com_hwdphotoshare&task=savephoto";
		$form_editalbum = JURI::root(true)."/index.php?option=com_hwdphotoshare&task=updatealbum";
		$form_deletealbum = JURI::root(true)."/index.php?option=com_hwdphotoshare&task=deletealbum";

		$users_storage = hwd_ps_tools::recursive_directory_size(JPATH_SITE.DS.'hwdphotos'.DS.'originals'.DS.$my->id.DS);
		$users_storage = round($users_storage/(1024*1024), 2);
		$users_limit = 20;
		$users_percentage = round((($users_storage/$users_limit)*100));

		$album_select_list = hwd_ps_tools::generateAlbumSelectList(_HWDPS_SELECT_SELECTALBUM, $row->id, _HWDPS_SELECT_NOALBUMS, 1, "album_id", 0, $row->user_id);
		$album_title = $row->title;
		$album_description = $row->description;
		$album_cid = $row->category_id;
		$album_tags = $row->tags;
		$album_location = $row->location;
		$album_id = $row->id;
		$album_uid = $row->user_id;

		$smartyps->assign( "link_addphotos" , JRoute::_("index.php?option=com_hwdphotoshare&Itemid=".$Itemid."&task=addphotos&album_id=".$album_id)  );
		$smartyps->assign( "link_createalbum" , JRoute::_("index.php?option=com_hwdphotoshare&Itemid=".$Itemid."&task=createalbum")  );
		$smartyps->assign( "link_albumprivacy" , JRoute::_("index.php?option=com_hwdphotoshare&Itemid=".$Itemid."&task=albumprivacy")  );
		$smartyps->assign( "link_viewalbums" , JRoute::_("index.php?option=com_hwdphotoshare&Itemid=".$Itemid."&task=yourphotos")  );

		$ini = array();
		$ini[0] = intval(ini_get('post_max_size'));
		$ini[1] = intval(ini_get('post_max_size'));
		$smartyps->assign( "max_basic_upload" , max($ini) );

		if (count($albumphotos) > 0) {
			$smartyps->assign("print_phototab", 1);
			$albumphotoslist = hwd_ps_tools::generatePhotoEditListFromSql($albumphotos);
			$smartyps->assign("albumphotoslist", $albumphotoslist);
		}

		$smartyps->assign("print_sharingoptions", 1);

		if ($row->privacy == "registered") {
			$smartyps->assign("so1p", "");
			$smartyps->assign("so1r", " selected=\"selected\"");
			$smartyps->assign("so1value", "registered");
		} else if ($row->privacy == "public") {
			$smartyps->assign("so1p", " selected=\"selected\"");
			$smartyps->assign("so1r", "");
			$smartyps->assign("so1value", "public");
		}
		if ($row->allow_comments == 0) {
			$smartyps->assign("so21", "");
			$smartyps->assign("so20", " selected=\"selected\"");
			$smartyps->assign("so2value", "0");
		} else if ($row->allow_comments == 1) {
			$smartyps->assign("so21", " selected=\"selected\"");
			$smartyps->assign("so20", "");
			$smartyps->assign("so2value", "1");
		}
		if ($row->allow_ratings == 0) {
			$smartyps->assign("so41", "");
			$smartyps->assign("so40", " selected=\"selected\"");
			$smartyps->assign("so4value", "0");
		} else if ($row->allow_ratings == 1) {
			$smartyps->assign("so41", " selected=\"selected\"");
			$smartyps->assign("so40", "");
			$smartyps->assign("so4value", "1");
		}

		//require_once(HWDPSPATH."/mvc/view/upload_php.php");
		$PHPFORMURL = JURI::root(true)."/index.php?option=com_hwdphotoshare&amp;Itemid=".$Itemid."&amp;task=upldconfirmb0";
		$PHPHIDDENINPUTS = "<input type=\"hidden\" name=\"albumid\" value=\"".stripslashes($album_id)."\" />";
		$smartyps->assign("PHPFORMURL", $PHPFORMURL);
		$smartyps->assign("PHPHIDDENINPUTS", $PHPHIDDENINPUTS);

		/** assign template variables **/
		$smartyps->assign( "startpane", $startpane );
		$smartyps->assign( "endtab", $endtab );
		$smartyps->assign( "endpane", $endpane );
		$smartyps->assign( "starttab0", $starttab0 );
		$smartyps->assign( "starttab1", $starttab1 );
		$smartyps->assign( "starttab2", $starttab2 );
		$smartyps->assign( "starttab3", $starttab3 );
		$smartyps->assign( "starttab4", $starttab4 );
		$smartyps->assign( "form_editphoto", $form_editphoto );
		$smartyps->assign( "form_editalbum", $form_editalbum );
		$smartyps->assign( "form_deletealbum", $form_deletealbum );
		$smartyps->assign( "album_select_list", $album_select_list );
		$smartyps->assign( "album_title", $album_title );
		$smartyps->assign( "album_delete", hwd_ps_tools::generateDeleteAlbumButton($row) );
		$smartyps->assign( "album_edit", hwd_ps_tools::generateEditAlbumButton($row) );
		$smartyps->assign( "album_addphotos", hwd_ps_tools::generateAddNewPhotosButton($row) );

		$smartyps->assign( "album_description", $album_description );
		$smartyps->assign( "album_cid", $album_cid );
		$smartyps->assign( "album_tags", $album_tags );
		$smartyps->assign( "album_location", $album_location );
		$smartyps->assign( "album_id", $album_id );
		$smartyps->assign( "album_uid", $album_uid );
		$smartyps->assign( "categoryselect", $categoryselectlist = hwd_ps_tools::categoryList(_HWDPS_SELECT_SELECTCATEGORY, $row->category_id, _HWDPS_SELECT_NOCATS, 1) );
		$smartyps->assign( "url", JRoute::_($_SERVER['REQUEST_URI']) );
		$smartyps->assign( "users_storage", $users_storage);
		$smartyps->assign( "users_limit", $users_limit);
		$smartyps->assign( "users_percentage", $users_percentage);

		$smartyps->display('album_edit.tpl');
		return;
    }
    /**
     * Loads video data to edit
     *
     * @param string $option  the joomla component name
     * @param array  $row  the array containing video information
     * @return       Nothing
     */
    function addPhotos($album_id, $category_id, $row)
    {
    	global $mainframe, $Itemid, $database, $my, $params, $mosConfig_absolute_path, $smartyps, $option, $Itemid;
        $c = hwd_ps_Config::get_instance();
		$my = & JFactory::getUser();

		// load the menu name
		jimport( 'joomla.application.menu' );
		$menu   = &JMenu::getInstance('site');
		$active = &$menu->getActive();
		if (!empty($active->name)) {$metatitle = $active->name;} else {$metatitle = _HWDPS_META_DEFAULT;}
        // decode
        $meta_title = html_entity_decode($row->title);
        // set the page/meta title
        $mainframe->setPageTitle( $metatitle." - "._HWDPS_META_ADDP." - ".$meta_title );
        $mainframe->addMetaTag( 'title' , $metatitle." - "._HWDPS_META_ADDP." - ".$meta_title );
		hwd_ps_tools::generateActiveLink(4);
		// define javascript
		hwd_ps_javascript::chkUpdateAlbumForm();


		$users_storage = hwd_ps_tools::recursive_directory_size(JPATH_SITE.DS.'hwdphotos'.DS.'originals'.DS.$my->id.DS);
		if ( $users_storage > 0 ) {
			$users_storage = round($users_storage/(1024*1024), 2);
		} else {
			$users_storage = "0.0";
		}
		$users_limit = $c->core_uploadlimit;
		if ($users_limit > 0) {
			$users_percentage = round((($users_storage/$users_limit)*100));
		} else {
			$users_percentage = 0;
		}

		if ($users_percentage > 100) {
			$users_percentage = 100;
		} else if ($users_percentage < 0) {
			$users_percentage = 0;
		}

		//$album_select_list = hwd_ps_tools::generateAlbumSelectList(_HWDPS_INFO_CHOOSEALBUM, $row->id, _HWDPS_INFO_NOALBUMS, 1);
		$album_title = $row->title;
		$album_description = $row->description;
		$album_cid = $row->category_id;
		$album_tags = $row->tags;
		$album_location = $row->location;
		$album_id = $row->id;
		$album_uid = $row->user_id;

		$smartyps->assign( "link_editalbum" , JRoute::_("index.php?option=com_hwdphotoshare&Itemid=".$Itemid."&task=editalbum&album_id=".$album_id)  );
		$smartyps->assign( "link_createalbum" , JRoute::_("index.php?option=com_hwdphotoshare&Itemid=".$Itemid."&task=createalbum")  );
		$smartyps->assign( "link_albumprivacy" , JRoute::_("index.php?option=com_hwdphotoshare&Itemid=".$Itemid."&task=albumprivacy")  );
		$smartyps->assign( "link_viewalbums" , JRoute::_("index.php?option=com_hwdphotoshare&Itemid=".$Itemid."&task=yourphotos")  );

		$ini = array();
		$ini[0] = intval(ini_get('post_max_size'));
		$ini[1] = intval(ini_get('post_max_size'));
		$smartyps->assign( "max_basic_upload" , max($ini) );

		//require_once(HWDPSPATH."/mvc/view/upload_php.php");
		$PHPFORMURL = JURI::root(true)."/index.php?option=com_hwdphotoshare&amp;Itemid=".$Itemid."&amp;task=uploadconfirmphp";
		$PHPHIDDENINPUTS = "<input type=\"hidden\" name=\"album_id\" value=\"".stripslashes($album_id)."\" /><input type=\"hidden\" name=\"category_id\" value=\"".stripslashes($category_id)."\" />";
		$smartyps->assign("PHPFORMURL", $PHPFORMURL);
		$smartyps->assign("PHPHIDDENINPUTS", $PHPHIDDENINPUTS);

		/** assign template variables **/
		//$smartyps->assign( "album_select_list", $album_select_list );
		$smartyps->assign( "album_title", $album_title );
		$smartyps->assign( "album_delete", hwd_ps_tools::generateDeleteAlbumLink($row) );
		$smartyps->assign( "album_edit", hwd_ps_tools::generateEditAlbumLink($row) );
		$smartyps->assign( "album_addphotos", hwd_ps_tools::generateAddNewPhotosLink($row) );

		if ($c->disablejupload == "0") {
			$smartyps->assign( "show_applet", 1);
		}
		$smartyps->assign( "album_description", $album_description );
		$smartyps->assign( "album_cid", $album_cid );
		$smartyps->assign( "album_tags", $album_tags );
		$smartyps->assign( "album_location", $album_location );
		$smartyps->assign( "album_id", $album_id );
		$smartyps->assign( "album_uid", $album_uid );
		$smartyps->assign( "category_id", $category_id );
		$smartyps->assign( "categoryselect", $categoryselectlist = hwd_ps_tools::categoryList(_HWDPS_SELECT_SELECTCATEGORY, $row->category_id, _HWDPS_SELECT_NOCATS, 1) );
		$smartyps->assign( "url", JRoute::_($_SERVER['REQUEST_URI']) );
		$smartyps->assign( "users_storage", $users_storage);
		$smartyps->assign( "users_limit", $users_limit);
		$smartyps->assign( "users_percentage", $users_percentage);


		$smartyps->display('photo_add.tpl');
		return;
    }
}
?>