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
class hwd_vs_html
{
    /**
     * Outputs frontpage HTML
     *
     * @param array  $rows  array of video data
     * @param array  $rowsfeatured  array of featured video data
     * @param object $pageNav  page navigation object
     * @param int    $total  the total video count
     * @return       Nothing
     */
    function frontpage($rows, $rowsfeatured, $pageNav, $total, $rowsnow, $mostviewed, $mostfavoured, $mostpopular)
    {
		global $Itemid, $smartyvs, $mainframe, $hwdvsTemplateOverride, $limit;
		$c = hwd_vs_Config::get_instance();
  		$db =& JFactory::getDBO();
		// load the menu name
		jimport( 'joomla.application.menu' );
		$menu   = &JMenu::getInstance('site');
		$mparams = &$menu->getParams($Itemid);
		$mparams_pt	= $mparams->get( 'page_title', '');

		$active = &$menu->getActive();

		if (!empty($mparams_pt)) {
			$metatitle = $mparams_pt;
		} else if (!empty($active->name)) {
			$metatitle = $active->name;
		} else {
			$metatitle = _HWDVIDS_META_DEFAULT;
		}

		// set the page/meta title
		$mainframe->setPageTitle( $metatitle );
		$mainframe->addMetaTag( 'title' , $metatitle );
		hwd_vs_tools::generateActiveLink(1);

		$crumbs[0][0] = _HWDVIDS_META_DEFAULT;
		$crumbs[0][1] = JRoute::_('index.php?option=com_hwdvideoshare&Itemid='.$Itemid.'&task=frontpage');
		hwd_vs_tools::generateBreadcrumbs($crumbs);

		// define javascript
		hwd_vs_javascript::confirmdelete();

		$k = 0;
		if (count($rowsfeatured) > 0) {
			$smartyvs->assign("print_featured", 1);
			if ($c->fvid_w == 0) { $c->fvid_w = "100%"; }

			if ($c->feat_rand == 1) {
				$array_size = count($rowsfeatured);
				$array_i = rand(0, $array_size-1);
			} else {
				$array_i = 0;
			}

			if ($c->feat_as == "yes") {
				$as = "1";
			} else if ($c->feat_as == "no") {
				$as = "0";
			} else if ($c->feat_as == "first") {
				$as = null;
			} else {
				$as = null;
			}

			$featured_video_player = hwd_vs_tools::generateVideoPlayer($rowsfeatured[$array_i], $c->fvid_w, $c->fvid_h, $as);
			$smartyvs->assign("featured_video_player", $featured_video_player);

			if (isset($hwdvsTemplateOverride['thumbWidth6'])) {
				$thumbwidth = $hwdvsTemplateOverride['thumbWidth6'];
			} else {
				$thumbwidth = null;
			}

			$featuredlist = hwd_vs_tools::generateVideoListFromSql($rowsfeatured, "featuredthumbs", $thumbwidth);
			$smartyvs->assign("featuredlist", $featuredlist);
		}
		if (count($rowsfeatured) > 1) {
			$smartyvs->assign("print_multiple_featured", 1);
		}

		if (count($rows) > 0) {
			$smartyvs->assign("print_videolist", 1);
			$list = hwd_vs_tools::generateVideoListFromSql($rows);
			$smartyvs->assign("list", $list);
		}

		if (count($rowsnow) > 0 && $c->frontpage_watched == "1") {
			$params = array();

			if (isset($hwdvsTemplateOverride['beingWatchNow'])) {
				$params['novtd'] = $hwdvsTemplateOverride['beingWatchNow'];
			} else {
				$params['novtd'] = $c->bwn_no;
			}

			if (isset($hwdvsTemplateOverride['thumbWidth5'])) {
				$thumbwidth = $hwdvsTemplateOverride['thumbWidth5'];
				$params['thumb_width'] = $hwdvsTemplateOverride['thumbWidth5'];

			} else {
				$thumbwidth = null;
				$params['thumb_width'] = $hwdvsTemplateOverride['thumbWidth5'];
			}

			$smartyvs->assign("print_nowlist", 1);
			$nowlist = hwd_vs_tools::generateVideoListFromSql($rowsnow, null, $thumbwidth);
			$smartyvs->assign("nowlist", $nowlist);

			if ($c->loadmootools == "on") {
				JHTML::_('behavior.mootools');
			}

			if (isset($hwdvsTemplateOverride['loadCarousel']) && $hwdvsTemplateOverride['loadCarousel'] == 0) {
				// continue;
			} else {
				$mainframe->addCustomHeadTag('<script type="text/javascript" src="'.JURI::root( true ).'/components/com_hwdvideoshare/assets/js/icarousel.js"></script> ');
				require_once(JPATH_SITE.DS.'administrator'.DS.'components'.DS.'com_hwdvideoshare'.DS.'helpers'.DS.'carousel.php');
				$iCID = 'example_3';
				hwdvsCarousel::setup($iCID, $params);
				$smartyvs->assign("iCID", $iCID);
			}
		}

		if (count($mostviewed) > 0 && $c->frontpage_viewed !== "0") {
			$smartyvs->assign("print_mostviewed", 1);

			if (isset($hwdvsTemplateOverride['thumbWidth2'])) {
				$thumbwidth = $hwdvsTemplateOverride['thumbWidth2'];
			} else {
				$thumbwidth = null;
			}

			$mostviewedlist = hwd_vs_tools::generateVideoListFromXml($mostviewed, $thumbwidth);
			$smartyvs->assign("mostviewedlist", $mostviewedlist);
			if ($c->frontpage_viewed == "today") {
				$smartyvs->assign("title_mostviewed", _HWDVIDS_MVTD);
			} else if ($c->frontpage_viewed == "thisweek") {
				$smartyvs->assign("title_mostviewed", _HWDVIDS_MVTW);
			} else if ($c->frontpage_viewed == "thismonth") {
				$smartyvs->assign("title_mostviewed", _HWDVIDS_MVTM);
			} else if ($c->frontpage_viewed == "alltime") {
				$smartyvs->assign("title_mostviewed", _HWDVIDS_MVAT);
			}
		}

		if (count($mostfavoured) > 0 && $c->frontpage_favoured !== "0") {
			$smartyvs->assign("print_mostfavoured", 1);

			if (isset($hwdvsTemplateOverride['thumbWidth3'])) {
				$thumbwidth = $hwdvsTemplateOverride['thumbWidth3'];
			} else {
				$thumbwidth = null;
			}

			$mostfavouredlist = hwd_vs_tools::generateVideoListFromXml($mostfavoured, $thumbwidth);
			$smartyvs->assign("mostfavouredlist", $mostfavouredlist);
			if ($c->frontpage_favoured == "today") {
				$smartyvs->assign("title_mostfavoured", _HWDVIDS_MFTD);
			} else if ($c->frontpage_favoured == "thisweek") {
				$smartyvs->assign("title_mostfavoured", _HWDVIDS_MFTW);
			} else if ($c->frontpage_favoured == "thismonth") {
				$smartyvs->assign("title_mostfavoured", _HWDVIDS_MFTM);
			} else if ($c->frontpage_favoured == "alltime") {
				$smartyvs->assign("title_mostfavoured", _HWDVIDS_MFAT);
			}
		}

		if (count($mostpopular) > 0 && $c->frontpage_popular !== "0") {
			$smartyvs->assign("print_mostpopular", 1);

			if (isset($hwdvsTemplateOverride['thumbWidth4'])) {
				$thumbwidth = $hwdvsTemplateOverride['thumbWidth4'];
			} else {
				$thumbwidth = null;
			}

			$mostpopularlist = hwd_vs_tools::generateVideoListFromXml($mostpopular, $thumbwidth);
			$smartyvs->assign("mostpopularlist", $mostpopularlist);
			if ($c->frontpage_popular == "today") {
				$smartyvs->assign("title_mostpopular", _HWDVIDS_MPTD);
			} else if ($c->frontpage_popular == "thisweek") {
				$smartyvs->assign("title_mostpopular", _HWDVIDS_MPTW);
			} else if ($c->frontpage_popular == "thismonth") {
				$smartyvs->assign("title_mostpopular", _HWDVIDS_MPTM);
			} else if ($c->frontpage_popular == "alltime") {
				$smartyvs->assign("title_mostpopular", _HWDVIDS_MPAT);
			}
		}

		$smartyvs->assign( "featured_link" , JRoute::_("index.php?option=com_hwdvideoshare&Itemid=".$Itemid."&task=featuredvideos") );
		$smartyvs->assign( "print_featured_player", $c->feat_show );

		$page = $total - $c->vpp;
		$pageNavigation = null;
		if ( $page > 0 ) {
			$link = "index.php?option=com_hwdvideoshare&Itemid=".$Itemid."&limit=".$limit;
			$pageNavigation.= "<div class=\"pagenavi\" align=\"center\">";
			$pageNavigation.= $pageNav->getPagesLinks($link);
			$pageNavigation.= "<div class=\"pagecount\">".$pageNav->getPagesCounter()."</div>";
			$pageNavigation.= "</div>";
		}
		$smartyvs->assign("pageNavigation", $pageNavigation);

		$smartyvs->display('index.tpl');
		return;
    }
    /**
     * Outputs results from user search
     *
     * @param int    $totalvids  the total matching video count
     * @param array  $matchingvids  array of matching video data
     * @param object $videoNav  page navigation object
     * @param int    $totalgroups  the total matching group count
     * @param array  $matchinggroups  array of matching group data
     * @param object $groupNav  page navigation object
     * @param string $searchterm  the search pattern from user search
     * @return       Nothing
     */
    function search($totalvids, $matchingvids, $videoNav, $totalgroups, $matchinggroups, $groupNav, $searchterm)
    {
		global $Itemid, $mainframe, $smartyvs;
		$c = hwd_vs_Config::get_instance();
		// load the menu name
		jimport( 'joomla.application.menu' );
		$menu   = &JMenu::getInstance('site');
		$mparams = &$menu->getParams($Itemid);
		$mparams_pt	= $mparams->get( 'page_title', '');

		$active = &$menu->getActive();

		if (!empty($mparams_pt)) {
			$metatitle = $mparams_pt;
		} else if (!empty($active->name)) {
			$metatitle = $active->name;
		} else {
			$metatitle = _HWDVIDS_META_DEFAULT;
		}

		// set the page/meta title
		$mainframe->setPageTitle( $metatitle." - "._HWDVIDS_META_SR." - ".$searchterm );
		$mainframe->addMetaTag( 'title' , $metatitle." - "._HWDVIDS_META_SR." - ".$searchterm );
		hwd_vs_tools::generateActiveLink(1);

		$crumbs[0][0] = _HWDVIDS_META_SR;
		$crumbs[0][1] = JRoute::_('index.php?option=com_hwdvideoshare&Itemid='.$Itemid.'&task=search');
		hwd_vs_tools::generateBreadcrumbs($crumbs);

			$smartyvs->assign("searchterm", $searchterm);

		if (count($matchingvids) > 0) {
			$smartyvs->assign("print_matchvids", 1);
			$matchingvids = hwd_vs_tools::generateVideoListFromSql($matchingvids);
			$smartyvs->assign("matchingvids", $matchingvids);

			$vpage = $totalvids - $c->vpp;
			$vpageNavigation = null;
			if ( $vpage > 0 ) {
			$vlink = "index.php?option=com_hwdvideoshare&task=search&searchterm=".$searchterm."&Itemid=".$Itemid;
			$vpageNavigation.= "<div class=\"pagenavi\" align=\"center\">";
			$vpageNavigation.= $videoNav->getPagesLinks($vlink);
			$vpageNavigation.= "<div class=\"pagecount\">".$videoNav->getPagesCounter()."</div>";
			$vpageNavigation.= "</div>";
			}
			$smartyvs->assign("vpageNavigation", $vpageNavigation);


		} else {
			$smartyvs->assign("mvempty", _HWDVIDS_INFO_NMV);
		}

		if (count($matchinggroups) > 0) {
			$smartyvs->assign("print_matchgrps", 1);
			$matchinggroups = hwd_vs_tools::generateGroupListFromSql($matchinggroups);
			$smartyvs->assign("matchinggroups", $matchinggroups);

			$gpage = $totalgroups - $c->gpp;
			$gpageNavigation = null;
			if ( $gpage > 0 ) {
			$glink = "index.php?option=com_hwdvideoshare&task=search&searchterm=".$searchterm."&Itemid=".$Itemid;
			$gpageNavigation.= "<div class=\"pagenavi\" align=\"center\">";
			$gpageNavigation.= $groupNav->getPagesLinks($glink);
			$gpageNavigation.= "<div class=\"pagecount\">".$groupNav->getPagesCounter()."</div>";
			$gpageNavigation.= "</div>";
			}
			$smartyvs->assign("gpageNavigation", $gpageNavigation);


		} else {
			$smartyvs->assign("mgempty", _HWDVIDS_INFO_NMG);
		}

		$smartyvs->display('search.tpl');
		return;
    }
    /**
     * Constructs the necessary upload form
     *
     * @param int    $uploadpage  the parameter that determines the necessary upload page
     * @param string $videotype  determines the source of video file
     * @param int    $checksecurity  an integer for checking captcha security
     * @param string $title  user inputted video data
     * @param string $description  user inputted video data
     * @param int    $category_id  user inputted video data
     * @param string $tags  user inputted video data
     * @param string $public_private  user inputted video data
     * @param int    $allow_comments  user inputted video data
     * @param int    $allow_embedding  user inputted video data
     * @param int    $allow_ratings  user inputted video data
     * @return       Nothing
     */
    function uploadMedia($uploadpage, $videotype, $checksecurity, $title, $description, $category_id, $tags, $public_private, $allow_comments, $allow_embedding, $allow_ratings)
    {
		global $mainframe, $Itemid, $my, $params, $smartyvs;
		$c = hwd_vs_Config::get_instance();

		// load the menu name
		jimport( 'joomla.application.menu' );
		$menu   = &JMenu::getInstance('site');
		$mparams = &$menu->getParams($Itemid);
		$mparams_pt	= $mparams->get( 'page_title', '');

		$active = &$menu->getActive();

		if (!empty($mparams_pt)) {
			$metatitle = $mparams_pt;
		} else if (!empty($active->name)) {
			$metatitle = $active->name;
		} else {
			$metatitle = _HWDVIDS_META_DEFAULT;
		}

		// set the page/meta title
		$mainframe->setPageTitle( $metatitle." - "._HWDVIDS_META_UPLD );
		$mainframe->addMetaTag( 'title' , $metatitle." - "._HWDVIDS_META_UPLD );
		hwd_vs_tools::generateActiveLink(4);

		$crumbs[0][0] = _HWDVIDS_META_UPLD;
		$crumbs[0][1] = JRoute::_('index.php?option=com_hwdvideoshare&Itemid='.$Itemid.'&task=upload');
		hwd_vs_tools::generateBreadcrumbs($crumbs);

		$supported_websites = hwd_vs_tools::generateSupportedWebsiteList();
		$smartyvs->assign("supported_websites", $supported_websites);

		if ($uploadpage == "2") {

			$allowedformats = hwd_vs_tools::generateAllowedFormats();
			$smartyvs->assign("allowed_formats", $allowedformats);
			$smartyvs->assign("maximum_upload", $c->maxupld);

			if ($c->locupldmeth == "3") {
				require_once(JPATH_SITE.DS.'components'.DS.'com_hwdvideoshare'.DS.'views'.DS.'upload_perl.php');
				$smartyvs->display('upload_local_perl.tpl');
				return;
			} else if ($c->locupldmeth == "2") {
				require_once(JPATH_SITE.DS.'components'.DS.'com_hwdvideoshare'.DS.'views'.DS.'upload_flash.php');
				$smartyvs->display('upload_local_flash.tpl');
				return;
			} else if ($c->locupldmeth == "0") {
				require_once(JPATH_SITE.DS.'components'.DS.'com_hwdvideoshare'.DS.'views'.DS.'upload_php.php');
				$smartyvs->display('upload_local_php.tpl');
				return;
			} else {
				require_once(JPATH_SITE.DS.'components'.DS.'com_hwdvideoshare'.DS.'views'.DS.'upload_php.php');
				$smartyvs->display('upload_local_php.tpl');
				return;
			}

		} else if ($uploadpage == "thirdparty") {

			$mainframe->setUserState( "com_hwdvideoshare.upload_selection", "tp" );
			hwd_vs_javascript::checkaddform();
			$smartyvs->display('upload_thirdparty.tpl');
			return;

		} else if ($uploadpage == "1") {

			$mainframe->setUserState( "com_hwdvideoshare.upload_selection", "local" );
			hwd_vs_javascript::checkuploadform();
			$captcha = hwd_vs_tools::generateCaptcha();
			$smartyvs->assign("captcha", $captcha);
			$smartyvs->display('upload_local.tpl');
			return;

		} else if ($uploadpage == "0") {

			hwd_vs_javascript::disablesubmit();
			$upload_selection = $mainframe->getUserState( "com_hwdvideoshare.upload_selection", '' );
			if ($upload_selection == "tp") {
				$tpselect = 'selected="selected"';
			} else {
				$tpselect = '';
			}
			$smartyvs->assign("tpselect", $tpselect);
			$smartyvs->display('upload_choice.tpl');
			return;

		}
    }
    /**
     * Confirms local file upload
     *
     * @param string $uploadname  the title of uploaded media
     * @return       Nothing
     */
    function uploadConfirm($uploadname, $row)
    {
		global $Itemid, $smartyvs, $mainframe;
		$c = hwd_vs_Config::get_instance();

		// load the menu name
		jimport( 'joomla.application.menu' );
		$menu   = &JMenu::getInstance('site');
		$mparams = &$menu->getParams($Itemid);
		$mparams_pt	= $mparams->get( 'page_title', '');

		$active = &$menu->getActive();

		if (!empty($mparams_pt)) {
			$metatitle = $mparams_pt;
		} else if (!empty($active->name)) {
			$metatitle = $active->name;
		} else {
			$metatitle = _HWDVIDS_META_DEFAULT;
		}

		// set the page/meta title
		$mainframe->setPageTitle( $metatitle." - "._HWDVIDS_META_UPLDSUC );
		$mainframe->addMetaTag( 'title' , $metatitle." - "._HWDVIDS_META_UPLDSUC );
		hwd_vs_tools::generateActiveLink(4);

		$crumbs[0][0] = _HWDVIDS_META_UPLDSUC;
		$crumbs[0][1] = JRoute::_('index.php?option=com_hwdvideoshare&Itemid='.$Itemid.'&task=uploadconfirm');
		hwd_vs_tools::generateBreadcrumbs($crumbs);

		$smartyvs->assign("videolink", JRoute::_("index.php?option=com_hwdvideoshare&Itemid=".$Itemid."&task=viewvideo&video_id=".$row->id));
		$smartyvs->assign("uploadname", stripslashes($uploadname));
		$smartyvs->assign("url_upld_another", JRoute::_("index.php?option=com_hwdvideoshare&Itemid=".$Itemid."&task=upload"));
		if ($c->aav == 1) {
			$smartyvs->assign("video_wait_message", _HWDVIDS_INFO_VIDEOWAIT1);
		} else {
			$smartyvs->assign("video_wait_message", _HWDVIDS_INFO_VIDEOWAIT2);
		}



		$smartyvs->display('upload_local_confirm.tpl');
		return;
    }
    /**
     * Confirms video addition from third party video website
     *
     * @param string $uploadname  the title of uploaded media
     * @param string $failures  list of information that failed
     *                          to be extracted from third party website
     * @return       Nothing
     */
    function addConfirm($uploadname, $failures, $row)
    {
		global $mainframe, $smartyvs, $Itemid;
		$c = hwd_vs_Config::get_instance();
  		$db =& JFactory::getDBO();
		$my = & JFactory::getUser();

		// load the menu name
		jimport( 'joomla.application.menu' );
		$menu   = &JMenu::getInstance('site');
		$mparams = &$menu->getParams($Itemid);
		$mparams_pt	= $mparams->get( 'page_title', '');

		$active = &$menu->getActive();

		if (!empty($mparams_pt)) {
			$metatitle = $mparams_pt;
		} else if (!empty($active->name)) {
			$metatitle = $active->name;
		} else {
			$metatitle = _HWDVIDS_META_DEFAULT;
		}

		// set the page/meta title
		$mainframe->setPageTitle( $metatitle." - "._HWDVIDS_META_ADDSUC );
		$mainframe->addMetaTag( 'title' , $metatitle." - "._HWDVIDS_META_ADDSUC );
		hwd_vs_tools::generateActiveLink(4);

		$crumbs[0][0] = _HWDVIDS_META_ADDSUC;
		$crumbs[0][1] = JRoute::_('index.php?option=com_hwdvideoshare&Itemid='.$Itemid.'&task=addconfirm');
		hwd_vs_tools::generateBreadcrumbs($crumbs);

		$smartyvs->assign("videolink", JRoute::_("index.php?option=com_hwdvideoshare&Itemid=".$Itemid."&task=viewvideo&video_id=".$row->id));
		$smartyvs->assign("failures", $failures);
		$smartyvs->assign("thumbnail", hwd_vs_tools::generateVideoThumbnailLink($row->id, $row->video_id, $row->video_type, $row->thumbnail, 0, $c->thumbwidth, $c->thumbwidth*3/4, null));
		$smartyvs->assign("title", stripslashes($row->title));
		$smartyvs->assign("description", stripslashes($row->description));
		$smartyvs->assign("tags", stripslashes($row->tags));
		$smartyvs->assign("rowid", $row->id);
		$smartyvs->assign("rowuid", $row->user_id);
		$smartyvs->assign("print_sharing", 0);
		$smartyvs->assign("url_upld_another", JRoute::_("index.php?option=com_hwdvideoshare&Itemid=".$Itemid."&task=upload"));
		$smartyvs->assign("form_save_video", JRoute::_("index.php?option=com_hwdvideoshare&Itemid=".$Itemid."&task=savevideo"));
		$smartyvs->assign("uploadname", stripslashes($uploadname));
		if ($c->aav == 1) {
			$smartyvs->assign("waitmessage", _HWDVIDS_INFO_VIDEOWAIT3);
		} else {
			$smartyvs->assign("waitmessage", _HWDVIDS_INFO_VIDEOWAIT2);
		}

		if ($my->id == 0) {
			$smartyvs->assign("showEditForm", 0);
		} else {
			$smartyvs->assign("showEditForm", 1);

			if ($row->public_private == "registered") {
				$smartyvs->assign("so1p", "");
				$smartyvs->assign("so1r", " selected=\"selected\"");
				$smartyvs->assign("so1value", "registered");
			} else if ($row->public_private == "public") {
				$smartyvs->assign("so1p", " selected=\"selected\"");
				$smartyvs->assign("so1r", "");
				$smartyvs->assign("so1value", "public");
			}
			if ($row->allow_comments == 0) {
				$smartyvs->assign("so21", "");
				$smartyvs->assign("so20", " selected=\"selected\"");
				$smartyvs->assign("so2value", "0");
			} else if ($row->allow_comments == 1) {
				$smartyvs->assign("so21", " selected=\"selected\"");
				$smartyvs->assign("so20", "");
				$smartyvs->assign("so2value", "1");
			}
			if ($row->allow_embedding == 0) {
				$smartyvs->assign("so31", "");
				$smartyvs->assign("so30", " selected=\"selected\"");
				$smartyvs->assign("so3value", "0");
			} else if ($row->allow_embedding == 1) {
				$smartyvs->assign("so31", " selected=\"selected\"");
				$smartyvs->assign("so30", "");
				$smartyvs->assign("so3value", "1");
			}
			if ($row->allow_ratings == 0) {
				$smartyvs->assign("so41", "");
				$smartyvs->assign("so40", " selected=\"selected\"");
				$smartyvs->assign("so4value", "0");
			} else if ($row->allow_ratings == 1) {
				$smartyvs->assign("so41", " selected=\"selected\"");
				$smartyvs->assign("so40", "");
				$smartyvs->assign("so4value", "1");
			}

			$smartyvs->assign("categoryselect", $categoryselectlist = hwd_vs_tools::categoryList(_HWDVIDS_INFO_CHOOSECAT, $row->category_id, _HWDVIDS_INFO_NOCATS, 1) );
		}

		$smartyvs->display('upload_thirdparty_confirm.tpl');

		return;
    }
    /**
     * Constructs the video player page
     *
     * @param array  $row  the array containing video information
     * @return       Nothing
     */
    function viewVideo($row, $userrows, $related_videos, $categoryrows)
    {
		global $mainframe, $Itemid, $smartyvs, $hwdvsTemplateOverride;
		$c = hwd_vs_Config::get_instance();
  		$db =& JFactory::getDBO();
		$my = & JFactory::getUser();

		// load the menu name
		jimport( 'joomla.application.menu' );
		$menu   = &JMenu::getInstance('site');
		$mparams = &$menu->getParams($Itemid);
		$mparams_pt	= $mparams->get( 'page_title', '');

		$active = &$menu->getActive();

		if (!empty($mparams_pt)) {
			$metatitle = $mparams_pt;
		} else if (!empty($active->name)) {
			$metatitle = $active->name;
		} else {
			$metatitle = _HWDVIDS_META_DEFAULT;
		}

		// decode
		$meta_title = hwd_vs_tools::generateMetaText(stripslashes($row->title));
		$meta_description = hwd_vs_tools::generateMetaText($row->description);
		$meta_tags = hwd_vs_tools::generateMetaText($row->tags);

		// set the page/meta title
		$mainframe->setPageTitle( $metatitle." - ".$meta_title );
		$mainframe->addMetaTag( 'title' , $metatitle." - ".$meta_title );
		$mainframe->addMetaTag( 'description' , $meta_description );
		$mainframe->addMetaTag( 'keywords' , $meta_tags );
		$mainframe->addCustomHeadTag('<link rel="image_src" href="'.hwd_vs_tools::generateThumbnailURL( $row->id, $row->video_id, $row->video_type, $row->thumbnail ).'"></script>');
		hwd_vs_tools::generateActiveLink(1);

		$crumbs[0][0] = $meta_title;
		$crumbs[0][1] = JRoute::_('index.php?option=com_hwdvideoshare&Itemid='.$Itemid.'&task=viewvideo&video_id='.$row->id);
		hwd_vs_tools::generateBreadcrumbs($crumbs);

		if (!isset($row->username)) { $row->username = ''; }
		if (!isset($row->name)) { $row->name = ''; }

		$videoplayer->title = stripslashes($row->title);
		$videoplayer->player = hwd_vs_tools::generateVideoPlayer($row);
		$videoplayer->videourl = hwd_vs_tools::generateVideoUrl($row);
		$videoplayer->embedcode = hwd_vs_tools::generateEmbedCode($row);
		$videoplayer->socialbmlinks = hwd_vs_tools::generateSocialBookmarks();
		$videoplayer->comments = hwd_vs_tools::generateVideoComments($row);

		$videoplayer->editvideo = hwd_vs_tools::generateEditVideoLink($row);
		$videoplayer->deletevideo = hwd_vs_tools::generateDeleteVideoLink($row);

		if ($c->showdesc == "1") {
			$smartyvs->assign("print_description", 1);
			$videoplayer->description = stripslashes($row->description);
		}
		if ($c->showtags == "1") {
			$smartyvs->assign("print_tags", 1);
			$videoplayer->tags = hwd_vs_tools::generateTagListString($row->tags);
		}

		if ($c->showatfb == "1") {
			$videoplayer->favourties = hwd_vs_tools::generateFavouriteButton($row);
		}

		if ($my->id && $c->showa2gb == "1") {
			$smartyvs->assign("print_addtogroup", 1);
			hwd_vs_javascript::ajaxaddtogroup($row);
			$videoplayer->addtogroup = hwd_vs_tools::generateAddToGroupButton($row);
		}

		$videoplayer->uploader = hwd_vs_tools::generateUserFromID($row->user_id, $row->username, $row->name);

		if ($c->showrpmb == "1") {
			hwd_vs_javascript::ajaxreportmedia($row);
			$videoplayer->reportmedia = hwd_vs_tools::generateReportMediaButton($row);
		}

		if ($c->showrate == "1") {
			hwd_vs_javascript::ajaxRate($row);
			$videoplayer->ratingsystem = hwd_vs_tools::generateRatingSystem($row);
		}

		if ($row->video_type == "local" || $row->video_type == "swf"  || $row->video_type == "seyret" || ($row->video_type == "remote" && substr($row->video_id, 0, 6) !== "embed|")) {
			if ($c->showdlor == "1") {
				$videoplayer->downloadoriginal = hwd_vs_tools::generateDownloadVideoLink($row, 1);
			}
			if ($c->showdlfl == "1") {
				$videoplayer->downloadflv = hwd_vs_tools::generateDownloadVideoLink($row, 0);
			}
		} else {
			if ($c->showvuor == "1") {
				$videoplayer->vieworiginal = hwd_vs_tools::generateViewOriginalLink($row);
			}
		}

		if ($c->showprnx == "1") {
			$smartyvs->assign("print_nextprev", 1);
			$videoplayer->nextprev = hwd_vs_tools::generateNextPrevLinks($row);
		}


		if (count($related_videos) > 0 && $c->showrevi == "1") {
			if (isset($hwdvsTemplateOverride['thumbWidth8'])) {
				$thumbwidth = $hwdvsTemplateOverride['thumbWidth8'];
			} else {
				$thumbwidth = null;
			}

			$smartyvs->assign("print_relatedlist", 1);
			$listrelated = hwd_vs_tools::generateVideoListFromSql($related_videos, "", $thumbwidth);
			$smartyvs->assign("listrelated", $listrelated);
		}



		$videoplayer->customad1 = "";
		$videoplayer->customad2 = "";
		$videoplayer->customad3 = "";
		$videoplayer->morebyuser = "";

		if ($c->cbint == 3) { $row->avatar=$row->username; }
		if (!isset($row->avatar)) { $row->avatar=null; }
		$videoplayer->avatar = hwd_vs_tools::generateAvatar($row->user_id, $row->avatar, 0, null, null, null);




		$videoplayer->views = $row->number_of_views;;
		$videoplayer->category = hwd_vs_tools::generateCategoryLink($row->category_id);;
		$videoplayer->upload_date = $row->date_uploaded;

		$smartyvs->assign("videoplayer", $videoplayer);


		if (count($userrows) > 0 && $c->showuldr == "1") {
			if (isset($hwdvsTemplateOverride['thumbWidth7'])) {
				$thumbwidth = $hwdvsTemplateOverride['thumbWidth7'];
			} else {
				$thumbwidth = null;
			}

			$smartyvs->assign("print_uservideolist", 1);
			$userlist = hwd_vs_tools::generateVideoListFromSql($userrows, "", $thumbwidth);
			$smartyvs->assign("userlist", $userlist);
		} else {
			$smartyvs->assign("userlist", "This user does not have any other videos.");
		}

		if (count($categoryrows) > 0 && $c->showmftc == "1") {
			if (isset($hwdvsTemplateOverride['thumbWidth9'])) {
				$thumbwidth = $hwdvsTemplateOverride['thumbWidth9'];
			} else {
				$thumbwidth = null;
			}

			$smartyvs->assign("print_categoryvideolist", 1);
			$categoryvideolist = hwd_vs_tools::generateVideoListFromSql($categoryrows, "", $thumbwidth);
			$smartyvs->assign("categoryvideolist", $categoryvideolist);
		} else {
			$smartyvs->assign("categoryvideolist", "There are no more videos in this category.");
		}




		$smartyvs->display('video_player.tpl');

		return;
    }
    /**
     * Lists all available categories
     *
     * @param array  $row  the array containing category information
     * @return       Nothing
     */
    function categories($rows)
    {
		global $Itemid, $mainframe, $smartyvs, $params;
		$c = hwd_vs_Config::get_instance();
		$db = & JFactory::getDBO();
		$my = & JFactory::getUser();
		$acl= & JFactory::getACL();
		$usersConfig = &JComponentHelper::getParams( 'com_users' );

		// load the menu name
		jimport( 'joomla.application.menu' );
		$menu   = &JMenu::getInstance('site');
		$mparams = &$menu->getParams($Itemid);
		$mparams_pt	= $mparams->get( 'page_title', '');

		$active = &$menu->getActive();

		if (!empty($mparams_pt)) {
			$metatitle = $mparams_pt;
		} else if (!empty($active->name)) {
			$metatitle = $active->name;
		} else {
			$metatitle = _HWDVIDS_META_DEFAULT;
		}

		// set the page/meta title
		$mainframe->setPageTitle( $metatitle." - "._HWDVIDS_META_CATS );
		$mainframe->addMetaTag( 'title' , $metatitle." - "._HWDVIDS_META_CATS );
		hwd_vs_tools::generateActiveLink(2);

		$crumbs[0][0] = _HWDVIDS_META_CATS;
		$crumbs[0][1] = JRoute::_('index.php?option=com_hwdvideoshare&Itemid='.$Itemid.'&task=categories');
		hwd_vs_tools::generateBreadcrumbs($crumbs);

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

		$k = 0;
		if (count($rows) > 0) {
			$smartyvs->assign("print_categories", 1);
			$z = 0;
			for ($i=0, $m=count($rows); $i < $m; $i++) {
				$row = $rows[$i];

				// check component access settings and deny those without privileges
				if ($c->access_method == 0) {
					if (!hwd_vs_access::allowAccess( $row->access_v, $row->access_v_r, hwd_vs_access::userGID( $my->id ))) {
						if ( ($my->id < 1) && (!$usersConfig->get( 'allowUserRegistration' ) == '0' && hwd_vs_access::allowAccess( $c->gtree_upld, 'RECURSE', $acl->get_group_id('Registered','ARO') ) ) ) {
							continue;
						} else {
							continue;
						}
					}
				} else if ($c->access_method == 1) {
					if (!hwd_vs_access::allowLevelAccess( $row->access_lev_v, hwd_vs_access::userGID( $my->id ))) {
						continue;
					}
				}

				$list[$z]->level = 0;
				$list[$z]->thumbnail = hwd_vs_tools::generateCategoryThumbnailLink( $row, $k, $c->thumbwidth, $c->thumbwidth*$c->tar_fb, null);
				$list[$z]->title = hwd_vs_tools::generateCategoryLink($row->id, $row->category_name);
				$list[$z]->num_vids = $row->num_vids;
				$list[$z]->num_subcats = $row->num_subcats;
				$list[$z]->description = hwd_vs_tools::truncateText($row->category_description, $c->trunvdesc);
				$list[$z]->k = $k;
				$k = 1 - $k;

				$where = ' WHERE published = 1';
				$where.= ' AND parent = '.$row->id;
				if ($c->cat_he == 1) {
					$where.= ' AND num_vids > 0';
				}

				$query = 'SELECT *'
						. ' FROM #__hwdvidscategories'
						. $where
						. $order
						;
				$db->setQuery( $query );
				$subs1 = $db->loadObjectList();
				if (count($subs1) > 0) {
					for ($j=0, $n=count($subs1); $j < $n; $j++) {
						$z++;
						$sub1 = $subs1[$j];

						// check component access settings and deny those without privileges
						if ($c->access_method == 0) {
							if (!hwd_vs_access::allowAccess( $sub1->access_v, $sub1->access_v_r, hwd_vs_access::userGID( $my->id ))) {
								if ( ($my->id < 1) && (!$usersConfig->get( 'allowUserRegistration' ) == '0' && hwd_vs_access::allowAccess( $c->gtree_upld, 'RECURSE', $acl->get_group_id('Registered','ARO') ) ) ) {
									continue;
								} else {
									continue;
								}
							}
						} else if ($c->access_method == 1) {
							if (!hwd_vs_access::allowLevelAccess( $sub1->access_lev_v, hwd_vs_access::userGID( $my->id ))) {
								continue;
							}
						}

						$list[$z]->level = 1;
						$list[$z]->thumbnail = hwd_vs_tools::generateCategoryThumbnailLink($sub1, $k, $c->thumbwidth, $c->thumbwidth*$c->tar_fb, null);
						$list[$z]->title = hwd_vs_tools::generateCategoryLink($sub1->id, $sub1->category_name);
						$list[$z]->num_vids = $sub1->num_vids;
						$list[$z]->num_subcats = $sub1->num_subcats;
						$list[$z]->description = null;
						$list[$z]->k = $k;
						$k = 1 - $k;

						$where = ' WHERE published = 1';
						$where.= ' AND parent = '.$sub1->id;
						if ($c->cat_he == 1) {
							$where.= ' AND num_vids > 0';
						}

						$query = 'SELECT *'
								. ' FROM #__hwdvidscategories'
								. $where
								. $order
								;
						$db->setQuery( $query );
						$subs2 = $db->loadObjectList();
						if (count($subs2) > 0) {
							for ($l=0, $o=count($subs2); $l < $o; $l++) {
								$z++;
								$sub2 = $subs2[$l];

								// check component access settings and deny those without privileges
								if ($c->access_method == 0) {
									if (!hwd_vs_access::allowAccess( $sub2->access_v, $sub2->access_v_r, hwd_vs_access::userGID( $my->id ))) {
										if ( ($my->id < 1) && (!$usersConfig->get( 'allowUserRegistration' ) == '0' && hwd_vs_access::allowAccess( $c->gtree_upld, 'RECURSE', $acl->get_group_id('Registered','ARO') ) ) ) {
											continue;
										} else {
											continue;
										}
									}
								} else if ($c->access_method == 1) {
									if (!hwd_vs_access::allowLevelAccess( $sub2->access_lev_v, hwd_vs_access::userGID( $my->id ))) {
										continue;
									}
								}

								$list[$z]->level = 2;
								$list[$z]->thumbnail = null;
								$list[$z]->title = hwd_vs_tools::generateCategoryLink($sub2->id, $sub2->category_name);
								$list[$z]->num_vids = $sub2->num_vids;
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
			$smartyvs->assign("list", $list);
		}

		if ($c->custordering == 1) {
			$smartyvs->assign("print_orderselect", 1);
		}

		$smartyvs->display('category_index.tpl');
		return;


    }
    /**
     * Constructs the category page and lists all category videos
     *
     * @param array  $rows  the array containing video information
     * @param object $pageNav  the page navigation object
     * @param int    $total  the total category video count
     * @param int    $cat_id  the id of the category
     * @param array  $cat  the array containing category information
     * @return       Nothing
     */
    function viewCategory($rows, $pageNav, $total, $cat_id, $cat, $subcats)
    {
    	global $Itemid, $smartyvs, $mainframe;
		$c = hwd_vs_Config::get_instance();
		if ($c->showrating == 1 || $c->showviews == 1 || $c->showduration == 1 || $c->showuplder == 1) { $infowidth = 150; } else { $infowidth = 0; }

		// load the menu name
		jimport( 'joomla.application.menu' );
		$menu   = &JMenu::getInstance('site');
		$mparams = &$menu->getParams($Itemid);
		$mparams_pt	= $mparams->get( 'page_title', '');

		$active = &$menu->getActive();

		if (!empty($mparams_pt)) {
			$metatitle = $mparams_pt;
		} else if (!empty($active->name)) {
			$metatitle = $active->name;
		} else {
			$metatitle = _HWDVIDS_META_DEFAULT;
		}

		// set the page/meta title
		$mainframe->setPageTitle( $metatitle." - "._HWDVIDS_META_CATS." - ".$cat->category_name );
		$mainframe->addMetaTag( 'title' , $metatitle." - "._HWDVIDS_META_CATS." - ".$cat->category_name );
		hwd_vs_tools::generateActiveLink(2);

		$crumbs[0][0] = _HWDVIDS_META_CATS;
		$crumbs[0][1] = JRoute::_('index.php?option=com_hwdvideoshare&Itemid='.$Itemid.'&task=categories');
		$crumbs[1][0] = $cat->category_name;
		$crumbs[1][1] = JRoute::_('index.php?option=com_hwdvideoshare&Itemid='.$Itemid.'&task=viewcategory&cat_id='.$cat_id);
		hwd_vs_tools::generateBreadcrumbs($crumbs);

		$smartyvs->assign("category_name", $cat->category_name);
		$smartyvs->assign("category_description", $cat->category_description);

		if (count($rows) > 0) {
			$smartyvs->assign("print_videolist", 1);
			$list = hwd_vs_tools::generateVideoListFromSql($rows);
			$smartyvs->assign("list", $list);
		}

		$page = $total - $c->vpp;
		$pageNavigation = null;
		if ( $page > 0 ) {
			$link = "index.php?option=com_hwdvideoshare&task=viewcategory&cat_id=".$cat_id."&Itemid=".$Itemid;
			$pageNavigation.= "<div class=\"pagenavi\" align=\"center\">";
			$pageNavigation.= $pageNav->getPagesLinks($link);
			$pageNavigation.= "<div class=\"pagecount\">".$pageNav->getPagesCounter()."</div>";
			$pageNavigation.= "</div>";
		}
		$smartyvs->assign("pageNavigation", $pageNavigation);

		if (count($subcats) > 0) {
			$smartyvs->assign("print_subcats", 1);

			$k=0;
			for ($i=0, $m=count($subcats); $i < $m; $i++) {
				$row = $subcats[$i];
				$subcatlist[$i]->level = 0;
				$subcatlist[$i]->thumbnail = hwd_vs_tools::generateCategoryThumbnailLink( $row, $k, $c->thumbwidth, $c->thumbwidth*$c->tar_fb, null);
				$subcatlist[$i]->title = hwd_vs_tools::generateCategoryLink($row->id, $row->category_name);
				$subcatlist[$i]->num_vids = $row->num_vids;
				$subcatlist[$i]->num_subcats = $row->num_subcats;
				$subcatlist[$i]->description = hwd_vs_tools::truncateText($row->category_description, $c->trunvdesc);
				$subcatlist[$i]->k = $k;
				$k = 1 - $k;
			}
			$smartyvs->assign("subcatlist", $subcatlist);
		}

		$smartyvs->display('category_view.tpl');
		return;
    }
    /**
     * Constructs the group list page and lists all groups
     *
     * @param array  $rows  the array containing group information
     * @param array  $rowsfeatured  the array containing featured group information
     * @param object $pageNav  the page navigation object
     * @param int    $total  the total group count
     * @return       Nothing
     */
    function groups($rows, $rowsfeatured, $pageNav, $total)
    {
		global $Itemid, $mainframe, $smartyvs, $params;
		$c = hwd_vs_Config::get_instance();

		// load the menu name
		jimport( 'joomla.application.menu' );
		$menu   = &JMenu::getInstance('site');
		$mparams = &$menu->getParams($Itemid);
		$mparams_pt	= $mparams->get( 'page_title', '');

		$active = &$menu->getActive();

		if (!empty($mparams_pt)) {
			$metatitle = $mparams_pt;
		} else if (!empty($active->name)) {
			$metatitle = $active->name;
		} else {
			$metatitle = _HWDVIDS_META_DEFAULT;
		}

		// set the page/meta title
		$mainframe->setPageTitle( $metatitle." - "._HWDVIDS_META_GRPS );
		$mainframe->addMetaTag( 'title' , $metatitle." - "._HWDVIDS_META_GRPS );
		hwd_vs_tools::generateActiveLink(3);
		// define javascript
		hwd_vs_javascript::confirmdelete();

		$k = 0;
		if (count($rowsfeatured) > 0) {
			$smartyvs->assign("print_featured", 1);
			$featuredlist = hwd_vs_tools::generateGroupListFromSql($rowsfeatured);
			$smartyvs->assign("featuredlist", $featuredlist);
		}

		if (count($rows) > 0) {
			$smartyvs->assign("print_grouplist", 1);
			$list = hwd_vs_tools::generateGroupListFromSql($rows);
			$smartyvs->assign("list", $list);
		}

		$page = $total - $c->gpp;
		$pageNavigation = null;
		if ( $page > 0 ) {
			$link = "index.php?option=com_hwdvideoshare&Itemid=".$Itemid."&task=groups";
			$pageNavigation.= "<div class=\"pagenavi\" align=\"center\">";
			$pageNavigation.= $pageNav->getPagesLinks($link);
			$pageNavigation.= "<div class=\"pagecount\">".$pageNav->getPagesCounter()."</div>";
			$pageNavigation.= "</div>";
		}
		$smartyvs->assign("pageNavigation", $pageNavigation);

		$smartyvs->assign( "featured_link" , JRoute::_("index.php?option=com_hwdvideoshare&Itemid=".$Itemid."&task=featuredgroups")  );

		$smartyvs->display('group_index.tpl');
		return;
    }
    /**
     * Constructs the new group form
     *
     * @return       Nothing
     */
    function createGroup()
    {
		global $mainframe, $Itemid, $smartyvs, $Itemid;
		$c = hwd_vs_Config::get_instance();

		// load the menu name
		jimport( 'joomla.application.menu' );
		$menu   = &JMenu::getInstance('site');
		$mparams = &$menu->getParams($Itemid);
		$mparams_pt	= $mparams->get( 'page_title', '');

		$active = &$menu->getActive();

		if (!empty($mparams_pt)) {
			$metatitle = $mparams_pt;
		} else if (!empty($active->name)) {
			$metatitle = $active->name;
		} else {
			$metatitle = _HWDVIDS_META_DEFAULT;
		}

		// set the page/meta title
		$mainframe->setPageTitle( $metatitle." - "._HWDVIDS_META_NGRPS );
		$mainframe->addMetaTag( 'title' , $metatitle." - "._HWDVIDS_META_NGRPS );
		hwd_vs_tools::generateActiveLink(3);
		// define javascript
		hwd_vs_javascript::checkaddgroupform();

		$form_add_group = JRoute::_("index.php?option=com_hwdvideoshare&Itemid=".$Itemid."&task=savegroup");
		$smartyvs->assign("form_add_group", $form_add_group);
		$captcha = hwd_vs_tools::generateCaptcha();
		$smartyvs->assign("captcha", $captcha);

		$smartyvs->display('group_add.tpl');
		return;
    }
    /**
     * Constructs the group page and lists all containing group videos
     *
     * @param array  $rows  the array containing video information
     * @param object $pageNav  the page navigation object
     * @param int    $total  the total video count
     * @param array  $groupdetails  the array containing group information
     * @return       Nothing
     */
    function viewGroup($rows, $pageNav, $total, $members, $groupdetails)
    {
		global $mainframe, $Itemid, $smartyvs;
		$c = hwd_vs_Config::get_instance();

		if ($c->showrating == 1 || $c->showviews == 1 || $c->showduration == 1 || $c->showuplder == 1) { $infowidth = 150; } else { $infowidth = 0; }
		// load the menu name
		jimport( 'joomla.application.menu' );
		$menu   = &JMenu::getInstance('site');
		$mparams = &$menu->getParams($Itemid);
		$mparams_pt	= $mparams->get( 'page_title', '');

		$active = &$menu->getActive();

		if (!empty($mparams_pt)) {
			$metatitle = $mparams_pt;
		} else if (!empty($active->name)) {
			$metatitle = $active->name;
		} else {
			$metatitle = _HWDVIDS_META_DEFAULT;
		}

		// set the page/meta title
		$mainframe->setPageTitle( $metatitle." - "._HWDVIDS_META_GRPS." - ".$groupdetails->group_name );
		$mainframe->addMetaTag( 'title' , $metatitle." - "._HWDVIDS_META_GRPS." - ".$groupdetails->group_name );
		hwd_vs_tools::generateActiveLink(3);

		$smartyvs->assign("group_name", stripslashes($groupdetails->group_name));
		$smartyvs->assign("group_description", stripslashes($groupdetails->group_description));


		$group->totalmembers = $groupdetails->total_members;
		$group->totalvideos = $groupdetails->total_videos;
		$group->administrator = hwd_vs_tools::generateUserFromID($groupdetails->adminid, $groupdetails->username, $groupdetails->name);


		$group->groupmembership = hwd_vs_tools::generateGroupMembershipStatus($groupdetails);
		$group->reportgroup = hwd_vs_tools::generateReportGroupButton($groupdetails);
		$group->deletegroup = hwd_vs_tools::generateDeleteGroupButton($groupdetails);
		$group->editgroup = hwd_vs_tools::generateEditGroupButton($groupdetails);

		$smartyvs->assign("group", $group);




		if (count($members) > 0) {
			$smartyvs->assign("print_memberslist", 1);

			for ($i=0, $n=count($members); $i < $n; $i++) {
				$row = $members[$i];
				$memberslist[$i]->id = $row->id;
				$memberslist[$i]->username = $row->username;
			}

			$smartyvs->assign("memberslist", $memberslist);
		}



		if (count($rows) > 0) {
			$smartyvs->assign("print_videolist", 1);
			$list = hwd_vs_tools::generateVideoListFromSql($rows);
			$smartyvs->assign("list", $list);
		}



		$page = $total - $c->vpp;
		$pageNavigation = null;
		if ( $page > 0 ) {
				$link = "index.php?option=com_hwdvideoshare&Itemid=".$Itemid."&task=viewgroup&group_id=".$groupdetails->id;
			$pageNavigation.= "<div class=\"pagenavi\" align=\"center\">";
			$pageNavigation.= $pageNav->getPagesLinks($link);
			$pageNavigation.= "<div class=\"pagecount\">".$pageNav->getPagesCounter()."</div>";
			$pageNavigation.= "</div>";
		}
		$smartyvs->assign("pageNavigation", $pageNavigation);











		$group->comments = hwd_vs_tools::generateGroupComments($groupdetails);

		$smartyvs->display('group_view.tpl');
		return;



    }
    /**
     * Constructs a video list of all user videos
     *
     * @param array  $rows  the array containing video information
     * @param object $pageNav  the page navigation object
     * @param int    $total  the total video count
     * @return       Nothing
     */
    function yourVideos($rows, $pageNav, $total)
    {
		global $smartyvs, $Itemid, $mainframe;
		$c = hwd_vs_Config::get_instance();

		if ($c->showrating == 1 || $c->showviews == 1 || $c->showduration == 1 || $c->showuplder == 1) { $infowidth = 150; } else { $infowidth = 0; }
		// load the menu name
		jimport( 'joomla.application.menu' );
		$menu   = &JMenu::getInstance('site');
		$mparams = &$menu->getParams($Itemid);
		$mparams_pt	= $mparams->get( 'page_title', '');

		$active = &$menu->getActive();

		if (!empty($mparams_pt)) {
			$metatitle = $mparams_pt;
		} else if (!empty($active->name)) {
			$metatitle = $active->name;
		} else {
			$metatitle = _HWDVIDS_META_DEFAULT;
		}

		// set the page/meta title
		$mainframe->setPageTitle( $metatitle." - "._HWDVIDS_META_YVIDS );
		$mainframe->addMetaTag( 'title' , $metatitle." - "._HWDVIDS_META_YVIDS );
		hwd_vs_tools::generateActiveLink(1);

		if (count($rows) > 0) {
			$smartyvs->assign("print_videolist", 1);
			$list = hwd_vs_tools::generateVideoListFromSql($rows);
			$smartyvs->assign("list", $list);
		}

		$page = $total - $c->vpp;
		$pageNavigation = null;
		if ( $page > 0 ) {
			$link = "index.php?option=com_hwdvideoshare&task=yourvids&Itemid=".$Itemid;
			$pageNavigation.= "<div class=\"pagenavi\" align=\"center\">";
			$pageNavigation.= $pageNav->getPagesLinks($link);
			$pageNavigation.= "<div class=\"pagecount\">".$pageNav->getPagesCounter()."</div>";
			$pageNavigation.= "</div>";
		}
		$smartyvs->assign("pageNavigation", $pageNavigation);

		$smartyvs->display('video_yourvideos.tpl');
		return;
    }
    /**
     * Constructs a video list of all user favourite videos
     *
     * @param array  $rows  the array containing video information
     * @param object $pageNav  the page navigation object
     * @param int    $total  the total video count
     * @return       Nothing
     */
    function yourFavourites($rows, $pageNav, $total)
    {
		global $Itemid, $smartyvs, $mainframe;
		$c = hwd_vs_Config::get_instance();

		if ($c->showrating == 1 || $c->showviews == 1 || $c->showduration == 1 || $c->showuplder == 1) { $infowidth = 150; } else { $infowidth = 0; }
		// load the menu name
		jimport( 'joomla.application.menu' );
		$menu   = &JMenu::getInstance('site');
		$mparams = &$menu->getParams($Itemid);
		$mparams_pt	= $mparams->get( 'page_title', '');

		$active = &$menu->getActive();

		if (!empty($mparams_pt)) {
			$metatitle = $mparams_pt;
		} else if (!empty($active->name)) {
			$metatitle = $active->name;
		} else {
			$metatitle = _HWDVIDS_META_DEFAULT;
		}

		// set the page/meta title
		$mainframe->setPageTitle( $metatitle." - "._HWDVIDS_META_YFAVS );
		$mainframe->addMetaTag( 'title' , $metatitle." - "._HWDVIDS_META_YFAVS );
		hwd_vs_tools::generateActiveLink(1);

		if (count($rows) > 0) {
			$smartyvs->assign("print_videolist", 1);
			$list = hwd_vs_tools::generateVideoListFromSql($rows);
			$smartyvs->assign("list", $list);
		}

		$page = $total - $c->vpp;
		$pageNavigation = null;
		if ( $page > 0 ) {
			$link = "index.php?option=com_hwdvideoshare&task=yourfavs&Itemid=".$Itemid;
			$pageNavigation.= "<div class=\"pagenavi\" align=\"center\">";
			$pageNavigation.= $pageNav->getPagesLinks($link);
			$pageNavigation.= "<div class=\"pagecount\">".$pageNav->getPagesCounter()."</div>";
			$pageNavigation.= "</div>";
		}
		$smartyvs->assign("pageNavigation", $pageNavigation);

		$smartyvs->display('video_yourfavourites.tpl');
		return;

    }
    /**
     * Constructs a video list of all featured videos
     *
     * @param array  $rows  the array containing video information
     * @param object $pageNav  the page navigation object
     * @param int    $total  the total video count
     * @return       Nothing
     */
    function featuredVideos($rows, $pageNav, $total)
    {
		global $Itemid, $smartyvs, $mainframe;
		$c = hwd_vs_Config::get_instance();

		// load the menu name
		jimport( 'joomla.application.menu' );
		$menu   = &JMenu::getInstance('site');
		$mparams = &$menu->getParams($Itemid);
		$mparams_pt	= $mparams->get( 'page_title', '');

		$active = &$menu->getActive();

		if (!empty($mparams_pt)) {
			$metatitle = $mparams_pt;
		} else if (!empty($active->name)) {
			$metatitle = $active->name;
		} else {
			$metatitle = _HWDVIDS_META_DEFAULT;
		}

		// set the page/meta title
		$mainframe->setPageTitle( $metatitle." - "._HWDVIDS_META_FEATU );
		$mainframe->addMetaTag( 'title' , $metatitle." - "._HWDVIDS_META_FEATU );
		hwd_vs_tools::generateActiveLink(1);

		if (count($rows) > 0) {
			$smartyvs->assign("print_videolist", 1);
			$list = hwd_vs_tools::generateVideoListFromSql($rows);
			$smartyvs->assign("list", $list);
		}

		$page = $total - $c->vpp;
		$pageNavigation = null;
		if ( $page > 0 ) {
			$link = "index.php?option=com_hwdvideoshare&task=featuredvids&Itemid=".$Itemid;
			$pageNavigation.= "<div class=\"pagenavi\" align=\"center\">";
			$pageNavigation.= $pageNav->getPagesLinks($link);
			$pageNavigation.= "<div class=\"pagecount\">".$pageNav->getPagesCounter()."</div>";
			$pageNavigation.= "</div>";
		}
		$smartyvs->assign("pageNavigation", $pageNavigation);

		$smartyvs->display('video_featuredvideos.tpl');
		return;
    }
    /**
     * Constructs a group list of all user groups
     *
     * @param array  $rows  the array containing group information
     * @param object $pageNav  the page navigation object
     * @param int    $total  the total group count
     * @return       Nothing
     */
    function yourGroups($rows, $pageNav, $total)
    {
		global $Itemid, $smartyvs, $mainframe;
		$c = hwd_vs_Config::get_instance();

		// load the menu name
		jimport( 'joomla.application.menu' );
		$menu   = &JMenu::getInstance('site');
		$mparams = &$menu->getParams($Itemid);
		$mparams_pt	= $mparams->get( 'page_title', '');

		$active = &$menu->getActive();

		if (!empty($mparams_pt)) {
			$metatitle = $mparams_pt;
		} else if (!empty($active->name)) {
			$metatitle = $active->name;
		} else {
			$metatitle = _HWDVIDS_META_DEFAULT;
		}

		// set the page/meta title
		$mainframe->setPageTitle( $metatitle." - "._HWDVIDS_META_YGRPS );
		$mainframe->addMetaTag( 'title' , $metatitle." - "._HWDVIDS_META_YGRPS );
		hwd_vs_tools::generateActiveLink(3);

		if (count($rows) > 0) {
			$smartyvs->assign("print_grouplist", 1);
			$list = hwd_vs_tools::generateGroupListFromSql($rows);
			$smartyvs->assign("list", $list);
		}

		$page = $total - $c->vpp;
		$pageNavigation = null;
		if ( $page > 0 ) {
					$link = "index.php?option=com_hwdvideoshare&task=yourgroups&Itemid=".$Itemid;
			$pageNavigation.= "<div class=\"pagenavi\" align=\"center\">";
			$pageNavigation.= $pageNav->getPagesLinks($link);
			$pageNavigation.= "<div class=\"pagecount\">".$pageNav->getPagesCounter()."</div>";
			$pageNavigation.= "</div>";
		}
		$smartyvs->assign("pageNavigation", $pageNavigation);

		$smartyvs->display('group_yourgroups.tpl');
		return;
    }
    /**
     * Constructs a group list of all user group memberships
     *
     * @param array  $rows  the array containing group information
     * @param object $pageNav  the page navigation object
     * @param int    $total  the total group count
     * @return       Nothing
     */
    function yourMemberships($rows, $pageNav, $total)
    {
		global $Itemid, $smartyvs, $mainframe;
		$c = hwd_vs_Config::get_instance();

		// load the menu name
		jimport( 'joomla.application.menu' );
		$menu   = &JMenu::getInstance('site');
		$mparams = &$menu->getParams($Itemid);
		$mparams_pt	= $mparams->get( 'page_title', '');

		$active = &$menu->getActive();

		if (!empty($mparams_pt)) {
			$metatitle = $mparams_pt;
		} else if (!empty($active->name)) {
			$metatitle = $active->name;
		} else {
			$metatitle = _HWDVIDS_META_DEFAULT;
		}

		// set the page/meta title
		$mainframe->setPageTitle( $metatitle." - "._HWDVIDS_META_YGRPM );
		$mainframe->addMetaTag( 'title' , $metatitle." - "._HWDVIDS_META_YGRPM );
		hwd_vs_tools::generateActiveLink(3);

		if (count($rows) > 0) {
			$smartyvs->assign("print_grouplist", 1);
			$list = hwd_vs_tools::generateGroupListFromSql($rows);
			$smartyvs->assign("list", $list);
		}

		$page = $total - $c->vpp;
		$pageNavigation = null;
		if ( $page > 0 ) {
					$link = "index.php?option=com_hwdvideoshare&task=yourmemberships&Itemid=".$Itemid;
			$pageNavigation.= "<div class=\"pagenavi\" align=\"center\">";
			$pageNavigation.= $pageNav->getPagesLinks($link);
			$pageNavigation.= "<div class=\"pagecount\">".$pageNav->getPagesCounter()."</div>";
			$pageNavigation.= "</div>";
		}
		$smartyvs->assign("pageNavigation", $pageNavigation);

		$smartyvs->display('group_yourgroupmemberships.tpl');
		return;
    }
    /**
     * Constructs a group list of all featured groups
     *
     * @param array  $rows  the array containing group information
     * @param object $pageNav  the page navigation object
     * @param int    $total  the total group count
     * @return       Nothing
     */
    function featuredGroups($rows, $pageNav, $total)
    {
		global $Itemid, $smartyvs, $mainframe;
		$c = hwd_vs_Config::get_instance();

		// load the menu name
		jimport( 'joomla.application.menu' );
		$menu   = &JMenu::getInstance('site');
		$mparams = &$menu->getParams($Itemid);
		$mparams_pt	= $mparams->get( 'page_title', '');

		$active = &$menu->getActive();

		if (!empty($mparams_pt)) {
			$metatitle = $mparams_pt;
		} else if (!empty($active->name)) {
			$metatitle = $active->name;
		} else {
			$metatitle = _HWDVIDS_META_DEFAULT;
		}

		// set the page/meta title
		$mainframe->setPageTitle( $metatitle." - "._HWDVIDS_META_FEATG );
		$mainframe->addMetaTag( 'title' , $metatitle." - "._HWDVIDS_META_FEATG );
		hwd_vs_tools::generateActiveLink(3);

		if (count($rows) > 0) {
			$smartyvs->assign("print_grouplist", 1);
			$list = hwd_vs_tools::generateGroupListFromSql($rows);
			$smartyvs->assign("list", $list);
		}

		$page = $total - $c->vpp;
		$pageNavigation = null;
		if ( $page > 0 ) {
					$link = "index.php?option=com_hwdvideoshare&task=featuredvids&Itemid=".$Itemid."&task=featuredgroups";
			$pageNavigation.= "<div class=\"pagenavi\" align=\"center\">";
			$pageNavigation.= $pageNav->getPagesLinks($link);
			$pageNavigation.= "<div class=\"pagecount\">".$pageNav->getPagesCounter()."</div>";
			$pageNavigation.= "</div>";
		}
		$smartyvs->assign("pageNavigation", $pageNavigation);

		$smartyvs->display('group_featuredgroups.tpl');
		return;
    }
    /**
     * Loads video data to edit
     *
     * @param array  $row  the array containing video information
     * @return       Nothing
     */
    function editVideoInfo($row)
    {
    	global $mainframe, $Itemid, $smartyvs, $Itemid;
        $c = hwd_vs_Config::get_instance();

		// load the menu name
		jimport( 'joomla.application.menu' );
		$menu   = &JMenu::getInstance('site');
		$mparams = &$menu->getParams($Itemid);
		$mparams_pt	= $mparams->get( 'page_title', '');

		$active = &$menu->getActive();

		if (!empty($mparams_pt)) {
			$metatitle = $mparams_pt;
		} else if (!empty($active->name)) {
			$metatitle = $active->name;
		} else {
			$metatitle = _HWDVIDS_META_DEFAULT;
		}

		$referrer = JRequest::getVar( 'url', '' );

        // decode
        $meta_title = html_entity_decode($row->title);
        // set the page/meta title
        $mainframe->setPageTitle( $metatitle." - "._HWDVIDS_META_EVIDS." - ".$meta_title );
        $mainframe->addMetaTag( 'title' , $metatitle." - "._HWDVIDS_META_EVIDS." - ".$meta_title );
		hwd_vs_tools::generateActiveLink(1);
		// define javascript
			hwd_vs_javascript::checkuploadform();

			$smartyvs->assign("thumbnail", hwd_vs_tools::generateVideoThumbnailLink($row->id, $row->video_id, $row->video_type, $row->thumbnail, 0, null, null, null));
			$smartyvs->assign("title", stripslashes($row->title));
			$smartyvs->assign("description", stripslashes($row->description));
			$smartyvs->assign("tags", stripslashes($row->tags));
			$smartyvs->assign("rowid", $row->id);
			$smartyvs->assign("rowuid", $row->user_id);
			$smartyvs->assign("print_sharingoptions", 1);
			$smartyvs->assign("form_save_video", JRoute::_("index.php?option=com_hwdvideoshare&Itemid=".$Itemid."&task=savevideo"));
			$smartyvs->assign("referrer", $referrer);

				if ($row->public_private == "registered") {
					$smartyvs->assign("so1p", "");
					$smartyvs->assign("so1r", " selected=\"selected\"");
					$smartyvs->assign("so1value", "registered");
				} else if ($row->public_private == "public") {
					$smartyvs->assign("so1p", " selected=\"selected\"");
					$smartyvs->assign("so1r", "");
					$smartyvs->assign("so1value", "public");
				}
				if ($row->allow_comments == 0) {
					$smartyvs->assign("so21", "");
					$smartyvs->assign("so20", " selected=\"selected\"");
					$smartyvs->assign("so2value", "0");
				} else if ($row->allow_comments == 1) {
					$smartyvs->assign("so21", " selected=\"selected\"");
					$smartyvs->assign("so20", "");
					$smartyvs->assign("so2value", "1");
				}
				if ($row->allow_embedding == 0) {
					$smartyvs->assign("so31", "");
					$smartyvs->assign("so30", " selected=\"selected\"");
					$smartyvs->assign("so3value", "0");
				} else if ($row->allow_embedding == 1) {
					$smartyvs->assign("so31", " selected=\"selected\"");
					$smartyvs->assign("so30", "");
					$smartyvs->assign("so3value", "1");
				}
				if ($row->allow_ratings == 0) {
					$smartyvs->assign("so41", "");
					$smartyvs->assign("so40", " selected=\"selected\"");
					$smartyvs->assign("so4value", "0");
				} else if ($row->allow_ratings == 1) {
					$smartyvs->assign("so41", " selected=\"selected\"");
					$smartyvs->assign("so40", "");
					$smartyvs->assign("so4value", "1");
				}

			$smartyvs->assign("categoryselect", $categoryselectlist = hwd_vs_tools::categoryList(_HWDVIDS_INFO_CHOOSECAT, $row->category_id, _HWDVIDS_INFO_NOCATS, 1) );


		$smartyvs->display('video_edit.tpl');
		return;
    }
    /**
     * Loads group data to edit
     *
     * @param array  $row  the array containing group information
     * @return       Nothing
     */
    function editGroupInfo($row, $grp_members)
    {
    	global $mainframe, $Itemid, $smartyvs, $Itemid;
        $c = hwd_vs_Config::get_instance();

		// load the menu name
		jimport( 'joomla.application.menu' );
		$menu   = &JMenu::getInstance('site');
		$mparams = &$menu->getParams($Itemid);
		$mparams_pt	= $mparams->get( 'page_title', '');

		$active = &$menu->getActive();

		if (!empty($mparams_pt)) {
			$metatitle = $mparams_pt;
		} else if (!empty($active->name)) {
			$metatitle = $active->name;
		} else {
			$metatitle = _HWDVIDS_META_DEFAULT;
		}

        // decode
        $meta_title = html_entity_decode($row->group_name);
        // set the page/meta title
        $mainframe->setPageTitle( $metatitle." - "._HWDVIDS_META_EVIDS." - ".$meta_title );
        $mainframe->addMetaTag( 'title' , $metatitle." - "._HWDVIDS_META_EVIDS." - ".$meta_title );
		hwd_vs_tools::generateActiveLink(3);
		// define javascript
		hwd_vs_javascript::confirmdelete();

			$smartyvs->assign("title", stripslashes($row->group_name));
			$smartyvs->assign("description", stripslashes($row->group_description));
			$smartyvs->assign("rowid", $row->id);
			$smartyvs->assign("rowuid", $row->adminid);


		if (count($grp_members) > 0) {
			$smartyvs->assign("print_grp_members", 1);
			$grp_memberlist = hwd_vs_tools::generateGroupMemberList($grp_members);
			$smartyvs->assign("grp_memberlist", $grp_memberlist);
		}

			$smartyvs->assign("form_edit_group", JURI::root(true)."/index.php?option=com_hwdvideoshare&task=updategroup");

		$smartyvs->display('group_edit.tpl');
		return;
    }
}
?>