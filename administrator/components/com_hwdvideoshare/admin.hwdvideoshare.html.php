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

class hwdvids_HTML
{
   /**
	* show frontpage
	*/
	function frontpage($stats, $mostpopular, $mostviewed, $mostrecent, $recentgroups)
	{
		global $smartyvs, $limitstart;

		/** define template variables **/
		$hidden_inputs = '<input type="hidden" name="option" value="com_hwdvideoshare" />
						  <input type="hidden" name="limitstart" value="'.$limitstart.'" />
		                  <input type="hidden" name="task" value="homepage" />';
		jimport('joomla.html.pane');
		$pane =& JPane::getInstance('tabs');
		$startpane = $pane->startPane( 'welcome-pane' );
		$endtab = $pane->endPanel();
		$endpane = $pane->endPane();
		$starttab1 = $pane->startPanel( _HWDVIDS_TAB_STATS, 'panel1' );
		$starttab2 = $pane->startPanel( _HWDVIDS_TAB_INFO, 'panel2' );

		/** assign template variables **/
		$smartyvs->assign( "hidden_inputs", $hidden_inputs );
		$smartyvs->assign( "header_title", _HWDVIDS_SECTIONHEAD_HOME );
		$smartyvs->assign( "stats", $stats );
		$smartyvs->assign( "mostpopular", $mostpopular );
		$smartyvs->assign( "mostviewed", $mostviewed );
		$smartyvs->assign( "mostrecent", $mostrecent );
		$smartyvs->assign( "recentgroups", $recentgroups );
		$smartyvs->assign( "startpane", $startpane );
		$smartyvs->assign( "endTab", $endtab );
		$smartyvs->assign( "endpane", $endpane );
		$smartyvs->assign( "starttab1", $starttab1 );
		$smartyvs->assign( "starttab2", $starttab2 );

		/** display template **/
		$smartyvs->display('admin_index.tpl');
		return;
	}
   /**
	* show videos
	*/
	function showvideos($rows, $rows_feat, &$pageNav, $searchtext, $category_id)
	{
		global $mainframe, $smartyvs, $mosConfig_offset, $limitstart, $Itemid, $my, $option;

		$filter_order     = $mainframe->getUserStateFromRequest( $option.'filter_order', 'filter_order', 'a.date_uploaded', 'cmd' );
		$filter_order_Dir = $mainframe->getUserStateFromRequest( $option.'filter_order_Dir', 'filter_order_Dir', 'desc', 'word' );

		/** define template variables **/
		$hidden_inputs = '<input type="hidden" name="boxchecked" value="0" />
						  <input type="hidden" name="option" value="com_hwdvideoshare" />
						  <input type="hidden" name="task" value="videos" />
						  <input type="hidden" name="limitstart" value="'.$limitstart.'" />
						  <input type="hidden" name="hidemainmenu" value="0">
						  <input type="hidden" name="filter_order" value="'.$filter_order.'" />
						  <input type="hidden" name="filter_order_Dir" value="'.$filter_order_Dir.'" />';


		$categoryselectlist = hwd_vs_tools::categoryList(_HWDVIDS_INFO_ANYCAT, $category_id, _HWDVIDS_INFO_NOCATS, 0, "category_id", 0, 'class="inputbox" onChange="document.adminForm.submit()"', true);
		$search = _HWDVIDS_SEARCHV.'&nbsp;';
		$search.= '<input type="text" name="search" value="'.$searchtext.'" class="text_area" onChange="document.adminForm.submit();" />&nbsp;';
		$search.= $categoryselectlist.'&nbsp;';
		$search.= _HWDVIDS_RPP.'&nbsp;';
		$search.= $pageNav->getLimitBox().'&nbsp;';
		jimport('joomla.html.pane');
		$pane =& JPane::getInstance('tabs');
		$startpane = $pane->startPane( 'video-pane');
		$endtab = $pane->endPanel();
		$endpane = $pane->endPane();
		$starttab1 = $pane->startPanel( _HWDVIDS_TAB_ALLVIDS, 'panel1' );
		$starttab2 = $pane->startPanel( _HWDVIDS_TAB_FEATV, 'panel2' );

		$video_header = ($filter_order == 'a.title') ? _HWDVIDS_TITLE.'<img src="/subdirectory/administrator/images/sort_'.$filter_order_Dir.'.png" />' : _HWDVIDS_TITLE;
		$length_header = ($filter_order == 'a.video_length') ? _HWDVIDS_LENGTH.'<img src="/subdirectory/administrator/images/sort_'.$filter_order_Dir.'.png" />' : _HWDVIDS_LENGTH;
		$rating_header = ($filter_order == 'a.updated_rating') ? _HWDVIDS_RATING.'<img src="/subdirectory/administrator/images/sort_'.$filter_order_Dir.'.png" />' : _HWDVIDS_RATING;
		$date_header = ($filter_order == 'a.date_uploaded') ? _HWDVIDS_DATEUPLD.'<img src="/subdirectory/administrator/images/sort_'.$filter_order_Dir.'.png" />' : _HWDVIDS_DATEUPLD;
		$status_header =  ($filter_order == 'a.approved') ? _HWDVIDS_APPROVED.'<img src="/subdirectory/administrator/images/sort_'.$filter_order_Dir.'.png" />' : _HWDVIDS_APPROVED;
		$featured_header = ($filter_order == 'a.featured') ? _HWDVIDS_FEATURED.'<img src="/subdirectory/administrator/images/sort_'.$filter_order_Dir.'.png" />' : _HWDVIDS_FEATURED;
		$published_header = ($filter_order == 'a.published') ? _HWDVIDS_PUB.'<img src="/subdirectory/administrator/images/sort_'.$filter_order_Dir.'.png" />' : _HWDVIDS_PUB;
		$views_header = ($filter_order == 'a.number_of_views') ? _HWDVIDS_VIEWS.'<img src="/subdirectory/administrator/images/sort_'.$filter_order_Dir.'.png" />' : _HWDVIDS_VIEWS;
		$access_header = ($filter_order == 'a.public_private') ? _HWDVIDS_ACCESS.'<img src="/subdirectory/administrator/images/sort_'.$filter_order_Dir.'.png" />' : _HWDVIDS_ACCESS;
		$order_header = ($filter_order == 'a.ordering') ? _HWDVIDS_ORDER.'<img src="/subdirectory/administrator/images/sort_'.$filter_order_Dir.'.png" />' : _HWDVIDS_ORDER;

		/** define template arrays **/
		$list_all = array();
		$k = 0;
		for ($i=0, $n=count($rows); $i < $n; $i++) {
			$row = $rows[$i];

			$list_all[$i]->id = $row->id;
			$list_all[$i]->checked = JHTML::_('grid.checkedout', $row, $i);
			if ( $row->checked_out && ( $row->checked_out != $my->id ) ) {
				$list_all[$i]->title = stripslashes($row->title);
			} else {
				$link = 'index.php?option=com_hwdvideoshare&task=editvidsA&hidemainmenu=1&cid='. $row->id;
				$list_all[$i]->title = '<a href="'.$link.'" title="Edit Category">'.stripslashes($row->title).'</a>';
			}
			$list_all[$i]->length = $row->video_length;
			$list_all[$i]->rating = $row->updated_rating;
			$list_all[$i]->views = $row->number_of_views;
			$list_all[$i]->access = hwd_vs_tools::generateVideoAccess($row->public_private);
			$list_all[$i]->date = $row->date_uploaded;
			$list_all[$i]->status = hwd_vs_tools::generateVideoStatus($row->approved);
			$list_all[$i]->published_task = $row->published ? 'unpublish' : 'publish';
			$list_all[$i]->published_img = $row->published ? 'publish_g.png' : 'publish_x.png';
			$list_all[$i]->featured_task = $row->featured ? 'unfeature' : 'feature';
			$list_all[$i]->featured_img =$row->featured ? 'publish_g.png' : 'publish_x.png';
			$list_all[$i]->ordering = $row->ordering;
            if ($i > 0 || ($i + $pageNav->limitstart > 0)) {
			    $list_all[$i]->reorderup = '<a href = "#reorder" onClick = "return listItemTask(\'cb'.$i.'\',\'order_up\')"> <img src = "images/uparrow.png" width = "12" height = "12" border = "0" alt = ""> </a>';
            }
			if ($i < $n - 1 || $i + $pageNav->limitstart < $pageNav->total - 1) {
			    $list_all[$i]->reorderdown = '<a href = "#reorder" onClick = "return listItemTask(\'cb'.$i.'\',\'order_down\')"> <img src = "images/downarrow.png" width = "12" height = "12" border = "0" alt = ""> </a>';
			}
			$list_all[$i]->k = $k;
			$list_all[$i]->i = $i;
			$k = 1 - $k;
		}

		$cbtotal = count($rows)+1;
		$list_feat = array();
		$k = 0;
		for ($i=0, $n=count($rows_feat); $i < $n; $i++) {
			$row = $rows_feat[$i];

			$list_feat[$i]->id = $row->id;
			$list_feat[$i]->checked = JHTML::_('grid.checkedout', $row, $cbtotal);
			if ( $row->checked_out && ( $row->checked_out != $my->id ) ) {
				$list_feat[$i]->title = stripslashes($row->title);
			} else {
				$link = 'index.php?option=com_hwdvideoshare&task=editvidsA&hidemainmenu=1&cid='. $row->id;
				$list_feat[$i]->title = '<a href="'.$link.'" title="Edit Category">'.stripslashes($row->title).'</a>';
			}
			$list_feat[$i]->length = $row->video_length;
			$list_feat[$i]->rating = $row->updated_rating;
			$list_feat[$i]->views = $row->number_of_views;
			$list_feat[$i]->access = hwd_vs_tools::generateVideoAccess($row->public_private);
			$list_feat[$i]->date = $row->date_uploaded;
			$list_feat[$i]->ordering = $row->ordering;
			$list_feat[$i]->status = hwd_vs_tools::generateVideoStatus($row->approved);
			$list_feat[$i]->published_task = $row->published ? 'unpublish' : 'publish';
			$list_feat[$i]->published_img = $row->published ? 'publish_g.png' : 'publish_x.png';
			$list_feat[$i]->featured_task = $row->featured ? 'unfeature' : 'feature';
			$list_feat[$i]->featured_img =$row->featured ? 'publish_g.png' : 'publish_x.png';
			$list_feat[$i]->k = $k;
			$list_feat[$i]->i = $cbtotal;
			$list_feat[$i]->ordering = $i;
            if ($i > 0 || ($i + $pageNav->limitstart > 0)) {
			    $list_feat[$i]->reorderup = '<a href = "#reorder" onClick = "return listItemTask(\'cb'.$cbtotal.'\',\'order_f_up\')"> <img src = "images/uparrow.png" width = "12" height = "12" border = "0" alt = ""> </a>';
            }
			if ($i < $n - 1 || $i + $pageNav->limitstart < $pageNav->total - 1) {
			    $list_feat[$i]->reorderdown = '<a href = "#reorder" onClick = "return listItemTask(\'cb'.$cbtotal.'\',\'order_f_down\')"> <img src = "images/downarrow.png" width = "12" height = "12" border = "0" alt = ""> </a>';
			}
			$cbtotal++;
			$k = 1 - $k;
		}

		/** assign template variables **/
		$smartyvs->assign( "hidden_inputs" , $hidden_inputs );
		$smartyvs->assign( "header_title" , _HWDVIDS_SECTIONHEAD_VIDEOS );
		$smartyvs->assign( "print_search", 1 );
		$smartyvs->assign( "search", $search );
		$smartyvs->assign( "totalvideos", count($rows) );
		$smartyvs->assign( "writePagesLinks", $pageNav->getPagesLinks() );
		$smartyvs->assign( "writePagesCounter", $pageNav->getPagesCounter() );
		$smartyvs->assign( "list_all", $list_all );
		$smartyvs->assign( "list_feat", $list_feat );
		$smartyvs->assign( "startpane", $startpane );
		$smartyvs->assign( "endtab", $endtab );
		$smartyvs->assign( "endpane", $endpane );
		$smartyvs->assign( "starttab1", $starttab1 );
		$smartyvs->assign( "starttab2", $starttab2 );

		$smartyvs->assign( "video_sort_header", JHTML::_('grid.sort', $video_header, 'a.title', $filter_order_Dir, $filter_order_Dir ) );
		$smartyvs->assign( "length_sort_header", JHTML::_('grid.sort', $length_header, 'a.video_length', $filter_order_Dir, $filter_order_Dir ) );
		$smartyvs->assign( "rating_sort_header", JHTML::_('grid.sort', $rating_header, 'a.updated_rating', $filter_order_Dir, $filter_order_Dir ) );
		$smartyvs->assign( "date_sort_header", JHTML::_('grid.sort', $date_header, 'a.date_uploaded', $filter_order_Dir, $filter_order_Dir ) );
		$smartyvs->assign( "status_sort_header", JHTML::_('grid.sort', $status_header, 'a.approved', $filter_order_Dir, $filter_order_Dir ) );
		$smartyvs->assign( "featured_sort_header", JHTML::_('grid.sort', $featured_header, 'a.featured', $filter_order_Dir, $filter_order_Dir ) );
		$smartyvs->assign( "published_sort_header", JHTML::_('grid.sort', $published_header, 'a.published', $filter_order_Dir, $filter_order_Dir ) );
		$smartyvs->assign( "views_sort_header", JHTML::_('grid.sort', $views_header, 'a.number_of_views', $filter_order_Dir, $filter_order_Dir ) );
		$smartyvs->assign( "access_sort_header", JHTML::_('grid.sort', $access_header, 'a.public_private', $filter_order_Dir, $filter_order_Dir ) );
		$smartyvs->assign( "ordering_sort_header", JHTML::_('grid.sort', $order_header, 'a.ordering', $filter_order_Dir, $filter_order_Dir ) );

		/** display template **/
		$smartyvs->display('admin_videos.tpl');
		return;
	}
   /**
	* edit videos
	*/
	function editvideos($row, $cat, $usr, $favs, $flagged)
	{
		global $option, $smartyvs, $Itemid;
		$c = hwd_vs_Config::get_instance();
		$editor      =& JFactory::getEditor();

		// force no-cache so new thumbnail will display
		@header( 'Expires: Mon, 26 Jul 1997 05:00:00 GMT' );
		@header( 'Last-Modified: ' . gmdate( 'D, d M Y H:i:s' ) . ' GMT' );
		@header( 'Cache-Control: no-store, no-cache, must-revalidate' );
		@header( 'Cache-Control: post-check=0, pre-check=0', false );
		@header( 'Pragma: no-cache' );

		/** define template variables **/
		$hidden_inputs = '<input type="hidden" name="option" value="com_hwdvideoshare" />
		<input type="hidden" name="id" value="'.$row->id.'" />
		<input type="hidden" name="video_type" value="'.$row->video_type.'" />
		<input type="hidden" name="task" value="savevid" />';
		jimport('joomla.html.pane');
		$pane =& JPane::getInstance('tabs');
		$startpane = $pane->startPane( 'video-edit-pane' );
		$endtab = $pane->endPanel();
		$endpane = $pane->endPane();
		$starttab1 = $pane->startPanel( _HWDVIDS_TAB_BASIC, 'panel1' );
		$starttab2 = $pane->startPanel( _HWDVIDS_TAB_SHARING, 'panel2' );

		//echo '<script type="text/javascript" src="'.JURI::root(true).'/components/com_hwdvideoshare/js/mootools-1.2-core-yc.js"></script>';

		if ($row->public_private == "public") { $pubsel = "selected=\"selected\""; $regsel=null; } else { $regsel = "selected=\"selected\""; $pubsel=null; }
		$public_private = "<select name=\"public_private\">
		                   <option value=\"public\" ".$pubsel.">"._HWDVIDS_SELECT_PUBLIC."</option>
		                   <option value=\"registered\" ".$regsel.">"._HWDVIDS_SELECT_REG."</option>
					       </select>";

		$missingfile=null;
		if ($row->video_type == "local" || $row->video_type == "mp4") {

			$location = _HWDVIDS_DETAILS_SOTS."<br />";
			if (file_exists(JPATH_SITE."/hwdvideos/uploads/".$row->video_id.".flv")) {
				$location.= "<b>"._HWDVIDS_NQFILE.":</b> ".JPATH_SITE."/hwdvideos/uploads/".$row->video_id.".flv<br />";
			}
			if (file_exists(JPATH_SITE."/hwdvideos/uploads/".$row->video_id.".mp4")) {
				$location.= "<b>"._HWDVIDS_HQFILE.":</b> ".JPATH_SITE."/hwdvideos/uploads/".$row->video_id.".mp4<br />";
			}
			if (!file_exists(JPATH_SITE."/hwdvideos/uploads/".$row->video_id.".flv") && !file_exists(JPATH_SITE."/hwdvideos/uploads/".$row->video_id.".mp4")) {
				$missingfile = "<div style=\"color:#ff0000;font-weight:bold;\">"._HWDVIDS_ALERT_MISSINGVIDFILE."</div>";
			}
		} else if ($row->video_type == "swf") {
			$location = _HWDVIDS_DETAILS_SOTS."<br /><b>"._HWDVIDS_FNAME.":</b> ".JPATH_SITE."/hwdvideos/uploads/".$row->video_id.".swf";
			if (@!file_exists(JPATH_SITE."/hwdvideos/uploads/".$row->video_id.".swf")) {
				$missingfile = "<div style=\"color:#ff0000;font-weight:bold;\">"._HWDVIDS_ALERT_MISSINGVIDFILE."</div>";
			}
		} else if ($row->video_type == "remote") {
			$data = @explode(",", $row->video_id);
			$location = _HWDVIDS_DETAILS_REMSER." (".$row->video_type.")<br /><b>"._HWDVIDS_FURL.":</b> ".$data[0];
		} else if ($row->video_type == "seyret") {

			$data = @explode(",", $row->video_id);
			if ($data[0] == "local") {

				$data = @explode(",", $row->video_id);
				$location = _HWDVIDS_DETAILS_SOTS."<br /><b>"._HWDVIDS_NAME.":</b> ".$data[1];

			} else {

				hwd_vs_tools::getPluginDetails($data[0]);
				$flvurlfunc = preg_replace("/[^a-zA-Z0-9s_-]/", "", $data[0])."PrepareFlvURL";
				if (function_exists($flvurlfunc)) {
					$truepath = $flvurlfunc($data[1].",".$data[2]);
					$location = _HWDVIDS_DETAILS_REMSER." (".$data[0].")<br /><b>"._HWDVIDS_FURL.":</b><br /><textarea readonly rows=\"5\" cols=\"60\">".urldecode($truepath)."</textarea>";
				} else {
					$location = _HWDVIDS_DETAILS_REMSER." (".$data[0].")";
				}
			}

		} else {
			hwd_vs_tools::getPluginDetails($row->video_type);
			$flvurlfunc = preg_replace("/[^a-zA-Z0-9s_-]/", "", $row->video_type)."PrepareFlvURL";
			if (function_exists($flvurlfunc)) {
				$truepath = $flvurlfunc($row->video_id);
				$location = _HWDVIDS_DETAILS_REMSER." (".$row->video_type.")<br /><b>"._HWDVIDS_FURL.":</b><br /><textarea readonly rows=\"5\" cols=\"60\">".urldecode($truepath)."</textarea>";
			} else {
				$location = _HWDVIDS_DETAILS_REMSER." (".$row->video_type.")";
			}
		}

		/** assign template variables **/
		$smartyvs->assign( "hidden_inputs" , $hidden_inputs );
		$smartyvs->assign( "header_title" , _HWDVIDS_SECTIONHEAD_VIDEOS );
		$smartyvs->assign( "row" , $row );
		$smartyvs->assign( "startpane", $startpane );
		$smartyvs->assign( "endtab", $endtab );
		$smartyvs->assign( "endpane", $endpane );
		$smartyvs->assign( "starttab1", $starttab1 );
		$smartyvs->assign( "starttab2", $starttab2 );
		$smartyvs->assign( "vid", $row->id);

		if ($row->approved == "deleted") {
			$smartyvs->display('admin_videos_edit_deleted.tpl');
			return;
		} else if ($row->approved == "queuedforconversion") {
			$smartyvs->display('admin_videos_edit_queuedforconversion.tpl');
			return;
		} else if ($row->approved == "queuedforthumbnail") {
			$smartyvs->display('admin_videos_edit_queuedforthumbnail.tpl');
			return;
		} else if ($row->approved == "queuedforswf") {
			$smartyvs->display('admin_videos_edit_queuedforswf.tpl');
			return;
		} else if ($row->approved == "converting") {
		    $smartyvs->display( 'admin_videos_edit_converting.tpl');
			return;
		} else if ($row->approved == "queuedformp4" || $row->approved == "re-calculate_duration" || $row->approved == "re-generate_thumb") {
		    $smartyvs->display( 'admin_videos_edit_queuedforconversion.tpl');
			return;
		} else if ($row->approved == "pending") {
		    $smartyvs->assign( 'print_pending', 1 );
		}

		$smartyvs->assign( "categorylist" , hwd_vs_tools::categoryList(_HWDVIDS_INFO_CHOOSECAT, $row->category_id, _HWDVIDS_INFO_NOCATS, 1) );
		$smartyvs->assign( "title", str_replace('"', "&#34;", stripslashes($row->title)) );
		$smartyvs->assign( "category", hwd_vs_tools::generateCategory( $row->category_id ) );
		$smartyvs->assign( "description", $editor->display("description",stripslashes($row->description),350,250,40,20,1) );
		$smartyvs->assign( "tags", str_replace('"', "&#34;", $row->tags) );
		$smartyvs->assign( "published", hwd_vs_tools::yesnoSelectList( 'published', 'class="inputbox"', $row->published ) );
		$smartyvs->assign( "featured", hwd_vs_tools::yesnoSelectList( 'featured', 'class="inputbox"', $row->featured ) );
		$smartyvs->assign( "dateuploaded", $row->date_uploaded );
		$smartyvs->assign( "duration", $row->video_length );
		$smartyvs->assign( "thumb_snap", $row->thumb_snap );
		$smartyvs->assign( "public_private", $public_private );
		$smartyvs->assign( "allow_comments", hwd_vs_tools::yesnoSelectList( 'allow_comments', 'class="inputbox"', $row->allow_comments ) );
		$smartyvs->assign( "allow_embedding", hwd_vs_tools::yesnoSelectList( 'allow_embedding', 'class="inputbox"', $row->allow_embedding ) );
		$smartyvs->assign( "allow_ratings", hwd_vs_tools::yesnoSelectList( 'allow_ratings', 'class="inputbox"', $row->allow_ratings ) );
		$smartyvs->assign( "link_live_video", JURI::root(true)."/index.php?option=com_hwdvideoshare&task=viewvideo&Itemid=".$Itemid."&video_id=".$row->id );
		$smartyvs->assign( "status", hwd_vs_tools::generateVideoStatus($row->approved) );
		$smartyvs->assign( "videoplayer", hwd_vs_tools::generateVideoPlayer($row) );
		$smartyvs->assign( "missingfile", $missingfile );
		$smartyvs->assign( "location", $location );
		$smartyvs->assign( "thumbnail", hwd_vs_tools::generateThumbnail( $row->id, $row->video_id, $row->video_type, $row->thumbnail, null, null, null, null) );
		$smartyvs->assign( "access", hwd_vs_tools::generateVideoAccess( $row->public_private ) );
		$smartyvs->assign( "rating", hwd_vs_tools::generateExactRating($row) );
		$smartyvs->assign( "views", $row->number_of_views );
		$smartyvs->assign( "user", $usr->username );
		$smartyvs->assign( "favoured", $favs );

		if ($row->video_type == "local" || $row->video_type == "mp4" || $row->video_type == "swf"  || $row->video_type == "seyret") {
			$smartyvs->assign( "remotevideo", 0 );
		} else {
			$smartyvs->assign( "remotevideo", 1 );
		}

		$thumbnail_form_code = null;
		// generate thumbnail form
		if ($row->approved == "yes" || $row->approved == "pending") {
			$thumbnail_form_code.= '<h3>Upload Custom Thumbnail</h3>';
			$thumbnail_form_code.= '<p>Upload a custom thumbnail image from your computer.</p>';
			$thumbnail_form_code.= '<form action="index.php" method="post" enctype="multipart/form-data">
			<div style="padding:2px 0;"><input type="file" name="thumbnail_file" value="" size="30"></div>
			<div style="padding:2px 0;"><input type="submit" value="Upload"></div>
			<input type="hidden" name="option" value="'.$option.'" />
			<input type="hidden" name="cid" value="'.$row->id.'" />
			<input type="hidden" name="task" value="editvidsA" />
			<input type="hidden" name="upld_thumbnail" value="1" />
			</form>';
		}
		$smartyvs->assign( "thumbnail_form_code", $thumbnail_form_code );

		/** display template **/
		$smartyvs->display('admin_videos_edit.tpl');
		return;
	}
   /**
	* show categories
	*/
	function showcategories($rows, &$pageNav, $searchtext)
	{
		global $database, $mosConfig_offset, $limitstart, $smartyvs, $Itemid, $my;

		/** define template variables **/
		$hidden_inputs = '<input type="hidden" name="boxchecked" value="0" />
		<input type="hidden" name="option" value="com_hwdvideoshare" />
		<input type="hidden" name="task" value="categories" />
		<input type="hidden" name="limitstart" value="'.$limitstart.'" />
		<input type="hidden" name="hidemainmenu" value="0">';
		$search = _HWDVIDS_SEARCHC.'&nbsp;';
		$search.= '<input type="text" name="search" value="'.$searchtext.'" class="text_area" onChange="document.adminForm.submit();" />&nbsp;';
		$search.= _HWDVIDS_RPP.'&nbsp;';
		$search.= $pageNav->getLimitBox().'&nbsp;';

		/** assign template variables **/
		$smartyvs->assign( "hidden_inputs" , $hidden_inputs );
		$smartyvs->assign( "header_title" , _HWDVIDS_SECTIONHEAD_CATS );
		$smartyvs->assign( "print_search", 1 );
		$smartyvs->assign( "search", $search );
		$smartyvs->assign( "totalcategories", count($rows) );
		$smartyvs->assign( "writePagesLinks", $pageNav->getPagesLinks() );
		$smartyvs->assign( "writePagesCounter", $pageNav->getPagesCounter() );

		/** define template arrays **/
		$list = array();
		$k = 0;
		for ($i=0, $n=count($rows); $i < $n; $i++) {
			$row = $rows[$i];

			$list[$i]->id = $row->id;
			$list[$i]->checked = JHTML::_('grid.checkedout', $row, $i);
            if ($row->parent == 0) {
                $list[$i]->isparent = 1;
			}

			$link = 'index.php?option=com_hwdvideoshare&task=editcatA&hidemainmenu=1&cid='. $row->id;
			$list[$i]->title = '<a href="'.$link.'" title="Edit Category">'.stripslashes($row->treename).'</a>';

            if ($row->access_v == -2) {
				$list[$i]->view_access = _HWDVIDS_SELECT_EVERYONE;
            } else if ($row->access_v == -2) {
				$list[$i]->view_access = _HWDVIDS_SELECT_ALLREGUSER;
			} else {
                $gID = hwd_vs_access::groupName($row->access_v);
				$list[$i]->view_access = $gID;
            }
            if ($row->access_u == -2) {
				$list[$i]->upld_access = _HWDVIDS_SELECT_EVERYONE;
            } else if ($row->access_u == -2) {
				$list[$i]->upld_access = _HWDVIDS_SELECT_ALLREGUSER;
			} else {
                $gID = hwd_vs_access::groupName($row->access_u);
				$list[$i]->upld_access = $gID;
            }
			$list[$i]->published_task = $row->published ? 'unpublishcat' : 'publishcat';
			$list[$i]->published_img = $row->published ? 'publish_g.png' : 'publish_x.png';
			$list[$i]->order = $row->ordering;
	        if ($i > 0 || ($i + $pageNav->limitstart > 0)) {
			    $list[$i]->reorderup = '<a href = "#reorder" onClick = "return listItemTask(\'cb'.$i.'\',\'orderup\')"> <img src = "images/uparrow.png" width = "12" height = "12" border = "0" alt = ""> </a>';
            }
			if ($i < $n - 1 || $i + $pageNav->limitstart < $pageNav->total - 1) {
			    $list[$i]->reorderdown = '<a href = "#reorder" onClick = "return listItemTask(\'cb'.$i.'\',\'orderdown\')"> <img src = "images/downarrow.png" width = "12" height = "12" border = "0" alt = ""> </a>';
			}
			$list[$i]->k = $k;
			$list[$i]->i = $i;
			$k = 1 - $k;
		}
		$smartyvs->assign( "list", $list );

		/** display template **/
		$smartyvs->display('admin_categories_browse.tpl');
		return;
	}
   /**
	* edit categories
	*/
	function editcategories($row, $gtree, $categoryList)
	{
		global $option, $smartyvs, $task;
		$task        = JRequest::getCmd( 'task', 'frontpage' );
		$c = hwd_vs_Config::get_instance();

		/** define template variables **/
		$hidden_inputs = '<input type="hidden" name="option" value="'.$option.'" />
		<input type="hidden" name="id" value="'.$row->id.'" />
		<input type="hidden" name="task" value="savecat" />';

		if ($row->access_v_r == "RECURSE") { $recusel = "selected=\"selected\""; $nonesel=null; } else { $nonesel = "selected=\"selected\""; $recusel=null; }
		$access_v_r = "<select name=\"access_v_r\" size=\"1\" class=\"inputbox\">
		                   <option value=\"RECURSE\" ".$recusel.">"._HWDVIDS_YES."</option>
		                   <option value=\"0\" ".$nonesel.">"._HWDVIDS_NO."</option>
					       </select>";
		if ($row->access_u_r == "RECURSE") { $recusel = "selected=\"selected\""; } else { $nonesel = "selected=\"selected\""; }
		$access_u_r = "<select name=\"access_u_r\" size=\"1\" class=\"inputbox\">
		                   <option value=\"RECURSE\" ".$recusel.">"._HWDVIDS_YES."</option>
		                   <option value=\"0\" ".$nonesel.">"._HWDVIDS_NO."</option>
					       </select>";

		/** assign template variables **/
		$smartyvs->assign( "hidden_inputs" , $hidden_inputs );
		$smartyvs->assign( "header_title" , _HWDVIDS_SECTIONHEAD_CATS );
		$smartyvs->assign( "row" , $row );
		$smartyvs->assign( "categoryList" , $categoryList );
		if ($c->access_method == 0) {
			$smartyvs->assign( "print_accessgroups", 1 );
		} else {
			$smartyvs->assign( "print_accesslevels", 1 );
		}


		if ($task !== "newcat") {
			$smartyvs->assign( "print_parentcheck", 1 );
		}

		$smartyvs->assign( "category_id", $row->id );
		$smartyvs->assign( "published", hwd_vs_tools::yesnoSelectList( 'published', 'class="inputbox"', $row->published ) );
		$smartyvs->assign( "cvaccess_g", JHTML::_('select.genericlist', $gtree, 'access_v', 'size="4"', 'value', 'text', $row->access_v) ) ;
		$smartyvs->assign( "cuaccess_g", JHTML::_('select.genericlist', $gtree, 'access_u', 'size="4"', 'value', 'text', $row->access_u) );
		$smartyvs->assign( "access_v_r", $access_v_r );
		$smartyvs->assign( "access_u_r", $access_u_r );
		$smartyvs->assign( "cvaccess_l", hwd_vs_tools::hwdvsMultiAccess( $row->access_lev_v, 'access_lev_v[]' ) );
		$smartyvs->assign( "cuaccess_l", hwd_vs_tools::hwdvsMultiAccess( $row->access_lev_u, 'access_lev_u[]' ) );
		$smartyvs->assign( "access_b_v", hwd_vs_tools::yesnoSelectList( 'access_b_v', 'class="inputbox"', $row->access_b_v ) );
		if (!empty($row->thumbnail)) {
			$smartyvs->assign( "print_thumbnail", 1 );
			$smartyvs->assign( "thumbnail_url", $row->thumbnail );
		}

		/** display template **/
		$smartyvs->display('admin_categories_edit.tpl');
		return;
	}
   /**
	* show groups
	*/
	function showgroups($rows, &$pageNav, $searchtext)
	{
		global $Itemid, $smartyvs, $limitstart, $my;

		/** define template variables **/
		$hidden_inputs = '<input type="hidden" name="boxchecked" value="0" />
		<input type="hidden" name="option" value="com_hwdvideoshare" />
		<input type="hidden" name="limitstart" value="'.$limitstart.'" />
		<input type="hidden" name="task" value="groups" />
		<input type="hidden" name="hidemainmenu" value="0">';
		$search = _HWDVIDS_SEARCHG.'&nbsp;';
		$search.= '<input type="text" name="search" value="'.$searchtext.'" class="text_area" onChange="document.adminForm.submit();" />&nbsp;';
		$search.= _HWDVIDS_RPP.'&nbsp;';
		$search.= $pageNav->getLimitBox().'&nbsp;';

		/** assign template variables **/
		$smartyvs->assign( "hidden_inputs" , $hidden_inputs );
		$smartyvs->assign( "header_title" , _HWDVIDS_SECTIONHEAD_GROUPS );
		$smartyvs->assign( "print_search", 1 );
		$smartyvs->assign( "search", $search );
		$smartyvs->assign( "totalgroups", count($rows) );
		$smartyvs->assign( "writePagesLinks", $pageNav->getPagesLinks() );
		$smartyvs->assign( "writePagesCounter", $pageNav->getPagesCounter() );

		/** define template arrays **/
		$list = array();
		$k = 0;
		for ($i=0, $n=count($rows); $i < $n; $i++) {
			$row = $rows[$i];

			$list[$i]->id = $row->id;
			$list[$i]->checked = JHTML::_('grid.checkedout', $row, $i);
			if ( $row->checked_out && ( $row->checked_out != $my->id ) ) {
				$list[$i]->title = stripslashes($row->treename);
			} else {
				$link = 'index.php?option=com_hwdvideoshare&task=editgrpA&hidemainmenu=1&cid='. $row->id;
				$list[$i]->title = '<a href="'.$link.'" title="Edit Group">'.stripslashes($row->group_name).'</a>';
			}
			$list[$i]->description = stripslashes($row->group_description);
			$list[$i]->access = hwd_vs_tools::generateVideoAccess( $row->public_private );
			$list[$i]->date = $row->date;
			$list[$i]->total_members = $row->total_members;
			$list[$i]->total_videos = $row->total_videos;
			$list[$i]->published_task = $row->published ? 'unpublishg' : 'publishg';
			$list[$i]->published_img = $row->published ? 'publish_g.png' : 'publish_x.png';
			$list[$i]->featured_task = $row->featured ? 'unfeatureg' : 'featureg';
			$list[$i]->featured_img =$row->featured ? 'publish_g.png' : 'publish_x.png';
			$list[$i]->k = $k;
			$list[$i]->i = $i;
			$k = 1 - $k;
		}
		$smartyvs->assign( "list", $list );

		/** display template **/
		$smartyvs->display('admin_groups_browse.tpl');
		return;
	}
   /**
	* edit categories
	*/
	function editgroups($row, $uploader_list)
	{
		global $option, $smartyvs;
		$c = hwd_vs_Config::get_instance();

		/** define template variables **/
		$hidden_inputs = '<input type="hidden" name="option" value="'.$option.'" />
		<input type="hidden" name="id" value="'.$row->id.'" />
		<input type="hidden" name="task" value="" />';
		jimport('joomla.html.pane');
		$pane =& JPane::getInstance('tabs');
		$startpane = $pane->startPane( 'group-edit-pane' );
		$endtab = $pane->endPanel();
		$endpane = $pane->endPane();
		$starttab1 = $pane->startPanel( "Basic", 'panel1' );
		$starttab2 = $pane->startPanel( "Videos", 'panel2' );
		$starttab3 = $pane->startPanel( "Members", 'panel3' );

		if ($row->public_private == "public") { $pubsel = "selected=\"selected\""; $regsel=null; } else { $regsel = "selected=\"selected\""; $pubsel=null; }
		$public_private = "<select name=\"public_private\">
		                   <option value=\"public\" ".$pubsel.">"._HWDVIDS_SELECT_PUBLIC."</option>
		                   <option value=\"registered\" ".$regsel.">"._HWDVIDS_SELECT_REG."</option>
					       </select>";

		/** assign template variables **/
		$smartyvs->assign( "hidden_inputs", $hidden_inputs );
		$smartyvs->assign( "header_title", _HWDVIDS_SECTIONHEAD_GROUPS );
		$smartyvs->assign( "startpane", $startpane );
		$smartyvs->assign( "endtab", $endtab );
		$smartyvs->assign( "endpane", $endpane );
		$smartyvs->assign( "starttab1", $starttab1 );
		$smartyvs->assign( "starttab2", $starttab2 );
		$smartyvs->assign( "starttab3", $starttab3 );

		$smartyvs->assign( "group_name", stripslashes($row->group_name) );
		$smartyvs->assign( "group_description", stripslashes($row->group_description) );
		$smartyvs->assign( "group_published", hwd_vs_tools::yesnoSelectList( 'published', 'class="inputbox"', $row->published ) );
		$smartyvs->assign( "group_featured", hwd_vs_tools::yesnoSelectList( 'featured', 'class="inputbox"', $row->featured ) );
		$smartyvs->assign( "group_admin", $uploader_list );
		$smartyvs->assign( "group_access", $public_private );
		$smartyvs->assign( "group_comments", hwd_vs_tools::yesnoSelectList( 'allow_comments', 'class="inputbox"', $row->allow_comments ) );

		/** display template **/
		$smartyvs->display('admin_groups_edit.tpl');
		return;
	}
   /**
	* show server settings
	*/
	function showserversettings()
	{
		global $smartyvs, $database;
		$s = hwd_vs_SConfig::get_instance();

		/** define template variables **/
		$hidden_inputs = '<input type="hidden" name="boxchecked" value="0" />
		<input type="hidden" name="option" value="com_hwdvideoshare" />
		<input type="hidden" name="task" value="serversettings" />
		<input type="hidden" name="hidemainmenu" value="0">';
  		if (is_writable(JPATH_SITE.DS.'administrator'.DS.'components'.DS.'com_hwdvideoshare'.DS.'serverconfig.hwdvideoshare.php')) {
  			$config_file_status = "<span style=\"color:#458B00;\">"._HWDVIDS_INFO_CONFIGF2."</span>.";
  		} else {
  			$config_file_status = '<span style="color:#ff0000;">'._HWDVIDS_INFO_CONFIGF3.'</span>. ('.JPATH_SITE.DS.'administrator'.DS.'components'.DS.'com_hwdvideoshare'.DS.'serverconfig.hwdvideoshare.php)';
  		}

		/** assign template variables **/
		$smartyvs->assign( "hidden_inputs" , $hidden_inputs );
		$smartyvs->assign( "header_title" , _HWDVIDS_SECTIONHEAD_SS );
  		$smartyvs->assign( "s" , $s );
  		$smartyvs->assign( "config_file_status" , $config_file_status );

		/** display template **/
		$smartyvs->display('admin_settings_server.tpl');
		return;
	}
   /**
	* show server settings
	*/
	function showgeneralsettings(&$gtree)
	{
		global $smartyvs, $mainframe;
		$s = hwd_vs_SConfig::get_instance();
		$c = hwd_vs_Config::get_instance();

		hwdvsInitialise::language('settings');

		require_once(JPATH_SITE.DS.'administrator'.DS.'components'.DS.'com_hwdvideoshare'.DS.'views'.DS.'generalsettings.php');
		hwdvids_HTML_settings::showgeneralsettings($gtree);
		return;
	}
   /**
	* show server settings
	*/
	function showlayoutsettings(&$gtree)
	{
		global $smartyvs, $database, $mainframe;
		$s = hwd_vs_SConfig::get_instance();
		$c = hwd_vs_Config::get_instance();

		hwdvsInitialise::language('settings');

		require_once(JPATH_SITE.DS.'administrator'.DS.'components'.DS.'com_hwdvideoshare'.DS.'views'.DS.'layoutsettings.php');
		hwdvids_HTML_settings::showlayoutsettings($gtree);
		return;
	}
   /**
	* show converter
	*/
	function converter()
	{
		global $smartyvs;

		/** define template variables **/
		$hidden_inputs = '<input type="hidden" name="boxchecked" value="0" />
		<input type="hidden" name="option" value="com_hwdvideoshare" />
		<input type="hidden" name="hidemainmenu" value="0">';

		/** assign template variables **/
		$smartyvs->assign( "hidden_inputs" , $hidden_inputs );
		$smartyvs->assign( "header_title" , _HWDVIDS_SECTIONHEAD_CONVERTOR );

		if (file_exists(JPATH_SITE.DS.'media'.DS.'hwdVideoShare_VideoConversionLog.dat')) {
			$download_log = '<a href="'.JURI::root( true ).'/media/hwdVideoShare_VideoConversionLog.dat" target="_blank">View Log</a>';
		} else {
			$download_log = 'Conversion Log does not exist!';
		}

		$smartyvs->assign( "download_log" , $download_log );

		/** display template **/
		$smartyvs->display('admin_converter.tpl');
		return;
	}
   /**
	* show converter
	*/
	function startconverter($total1, $total2, $total3, $total4, $total5, $total6, $total7)
	{
		global $smartyvs;

		/** define template variables **/
		$hidden_inputs = '<input type="hidden" name="boxchecked" value="0" />
		<input type="hidden" name="option" value="com_hwdvideoshare" />
		<input type="hidden" name="task" value="resetfconv" />
		<input type="hidden" name="hidemainmenu" value="0">';

		/** assign template variables **/
		$smartyvs->assign( "hidden_inputs" , $hidden_inputs );
		$smartyvs->assign( "header_title" , _HWDVIDS_SECTIONHEAD_CONVERTOR );
		$smartyvs->assign( "total1" , $total1 );
		$smartyvs->assign( "total2" , $total2 );
		$smartyvs->assign( "total3" , $total3 );
		$smartyvs->assign( "total4" , $total4 );
		$smartyvs->assign( "total5" , $total5 );
		$smartyvs->assign( "total6" , $total6 );
		$smartyvs->assign( "total7" , $total7 );
		$smartyvs->assign( "tool1" , JHTML::_('behavior.tooltip', _HWDVIDS_TT_01B, _HWDVIDS_TT_01H) );

		/** display template **/
		$smartyvs->display('admin_converter_go.tpl');
		exit;
	}
   /**
	* Show waiting approvals
	*/
	function showapprovals($rows, $pageNav)
	{
		global $database, $smartyvs, $limitstart, $mosConfig_offset, $Itemid, $option, $my;

		/** define template variables **/
		$hidden_inputs = '<input type="hidden" name="boxchecked" value="0" />
		<input type="hidden" name="option" value="com_hwdvideoshare" />
		<input type="hidden" name="limitstart" value="'.$limitstart.'" />
		<input type="hidden" name="task" value="approve" />
		<input type="hidden" name="hidemainmenu" value="0">';
		$search = _HWDVIDS_RPP.'&nbsp;';
		$search.= $pageNav->getLimitBox().'&nbsp;';

		/** assign template variables **/
		$smartyvs->assign( "hidden_inputs" , $hidden_inputs );
		$smartyvs->assign( "header_title" , _HWDVIDS_SECTIONHEAD_APPROVALS );
		$smartyvs->assign( "print_search", 1 );
		$smartyvs->assign( "search", $search );
		$smartyvs->assign( "totalvideos", count($rows) );
		$smartyvs->assign( "writePagesLinks", $pageNav->getPagesLinks() );
		$smartyvs->assign( "writePagesCounter", $pageNav->getPagesCounter() );

		/** assign template arrays **/
		$list_all = array();
		$k = 0;
		for ($i=0, $n=count($rows); $i < $n; $i++) {
			$row = $rows[$i];

			$list_all[$i]->id = $row->id;
			$list_all[$i]->checked = JHTML::_('grid.checkedout', $row, $i);
			if ( $row->checked_out && ( $row->checked_out != $my->id ) ) {
				$list_all[$i]->title = stripslashes($row->title);
			} else {
				$link = 'index.php?option=com_hwdvideoshare&task=editvidsA&hidemainmenu=1&cid='. $row->id;
				$list_all[$i]->title = '<a href="'.$link.'" title="Edit Category">'.stripslashes($row->title).'</a>';
			}
			$list_all[$i]->length = $row->video_length;
			$list_all[$i]->rating = $row->updated_rating;
			$list_all[$i]->views = $row->number_of_views;
			$list_all[$i]->access = hwd_vs_tools::generateVideoAccess($row->public_private);
			$list_all[$i]->date = $row->date_uploaded;
			$list_all[$i]->status = hwd_vs_tools::generateVideoStatus($row->approved);
			$list_all[$i]->published_task = $row->published ? 'unpublish' : 'publish';
			$list_all[$i]->published_img = $row->published ? 'publish_g.png' : 'publish_x.png';
			$list_all[$i]->featured_task = $row->featured ? 'unfeature' : 'feature';
			$list_all[$i]->featured_img =$row->featured ? 'publish_g.png' : 'publish_x.png';
			$list_all[$i]->approve_task = 'approve';
			$list_all[$i]->approve_img = 'publish_g.png';

			$list_all[$i]->k = $k;
			$list_all[$i]->i = $i;
			$k = 1 - $k;
		}
		$smartyvs->assign( "list_all", $list_all );

		/** display template **/
		$smartyvs->display('admin_approvals.tpl');
		return;
	}
   /**
	* show flagged media
	*/
	function showflagged(&$rowsfv, &$rowsfg)
	{
		global $database, $mosConfig_offset, $limitstart, $smartyvs, $Itemid, $my;

		/** define template variables **/
		$hidden_inputs = '<input type="hidden" name="boxchecked" value="0" />
		<input type="hidden" name="limitstart" value="'.$limitstart.'" />
		<input type="hidden" name="option" value="com_hwdvideoshare" />
		<input type="hidden" name="task" value="flagged" />
		<input type="hidden" name="hidemainmenu" value="0">';
		jimport('joomla.html.pane');
		$pane =& JPane::getInstance('tabs');
		$startpane = $pane->startPane( 'reported-pane' );
		$endtab = $pane->endPanel();
		$endpane = $pane->endPane();
		$starttab1 = $pane->startPanel( _HWDVIDS_TAB_VIDEO, 'panel-v' );
		$starttab2 = $pane->startPanel( _HWDVIDS_TAB_GROUPS, 'panel-g' );

		/** assign template variables **/
		$smartyvs->assign( "hidden_inputs", $hidden_inputs );
		$smartyvs->assign( "header_title", _HWDVIDS_SECTIONHEAD_FLAGGED );
		$smartyvs->assign( "totalvideos", count($rowsfv) );
		$smartyvs->assign( "totalgroups", count($rowsfg) );
		$smartyvs->assign( "startpane", $startpane );
		$smartyvs->assign( "endtab", $endtab );
		$smartyvs->assign( "endpane", $endpane );
		$smartyvs->assign( "starttab1", $starttab1 );
		$smartyvs->assign( "starttab2", $starttab2 );

		$list_videos = array();
		$k = 0;
		for ($i=0, $n=count($rowsfv); $i < $n; $i++) {
			$row = $rowsfv[$i];
			$list_videos[$i]->id = $row->id;
			$list_videos[$i]->checked = JHTML::_('grid.checkedout', $row, $i);
			if ( $row->checked_out && ( $row->checked_out != $my->id ) ) {
				$list_videos[$i]->title = stripslashes($row->title);
			} else {
				$link = 'index.php?option=com_hwdvideoshare&task=editvidsA&hidemainmenu=1&cid='. $row->id;
				$list_videos[$i]->title = '<a href="'.$link.'" title="Edit Category">'.stripslashes($row->title).'</a>';
			}
			$list_videos[$i]->user = hwd_vs_tools::generateBEUserFromID($row->user_id);
			$list_videos[$i]->status = $row->status;
			$list_videos[$i]->date = $row->date;
			$list_videos[$i]->k = $k;
			$list_videos[$i]->i = $i;
			$k = 1 - $k;
		}
		$smartyvs->assign( "list_videos", $list_videos );

		$cbtotal = count($rowsfv)+1;
		$list_groups = array();
		$k = 0;
		for ($i=0, $n=count($rowsfg); $i < $n; $i++) {
			$row = $rowsfg[$i];
			$list_groups[$i]->id = $row->id;
			$list_groups[$i]->checked = JHTML::_('grid.checkedout', $row, $cbtotal);
			if ( $row->checked_out && ( $row->checked_out != $my->id ) ) {
				$list_groups[$i]->title = stripslashes($row->title);
			} else {
				$link = 'index.php?option=com_hwdvideoshare&task=editgrpA&hidemainmenu=1&cid='. $row->id;
				$list_groups[$i]->title = '<a href="'.$link.'" title="Edit Category">'.stripslashes($row->group_name).'</a>';
			}
			$list_groups[$i]->user = hwd_vs_tools::generateBEUserFromID($row->adminid);
			$list_groups[$i]->status = $row->status;
			$list_groups[$i]->date = $row->date;
			$list_groups[$i]->k = $k;
			$list_groups[$i]->i = $cbtotal;
			$cbtotal++;
			$k = 1 - $k;
		}
		$smartyvs->assign( "list_groups", $list_groups );

		/** display template **/
		$smartyvs->display('admin_reported.tpl');
		return;
	}
   /**
	* show plugins
	*/
	function plugins() {
		global $my, $smartyvs, $limitstart, $mainframe, $option;

		$hidden_inputs = '<input type="hidden" name="option" value="'.$option.'" />
		<input type="hidden" name="task" value="plugins" />
		<input type="hidden" name="boxchecked" value="0" />
		<input type="hidden" name="limitstart" value="'.$limitstart.'" />
		<input type="hidden" name="hidemainmenu" value="0" />';
		$smartyvs->assign( "hidden_inputs" , $hidden_inputs );
		$smartyvs->assign( "header_title" , _HWDVIDS_SECTIONHEAD_PLUGIN );

        $smartyvs->display('admin_plugins.tpl');
		return;
	}


   /**
	* export
	*/
	function backuptables()
	{
		global $mosConfig_mailfrom, $smartyvs;
		$config = new JConfig;

		$hidden_inputs = '<input type="hidden" name="boxchecked" value="0" />
		<input type="hidden" name="option" value="com_hwdvideoshare" />
		<input type="hidden" name="task" value="botJombackup" />
		<input type="hidden" name="hidemainmenu" value="0">';
		$smartyvs->assign( "hidden_inputs" , $hidden_inputs );
		$smartyvs->assign( "header_title" , _HWDVIDS_SECTIONHEAD_BCUP );
  		$smartyvs->assign( "mosConfig_mailfrom" , $config->mailfrom );

		$smartyvs->display('admin_export.tpl');
		return;
	}
   /**
	* export
	*/
	function importdata()
	{
		global $mosConfig_mailfrom, $smartyvs;
		$db = & JFactory::getDBO();

		$hidden_inputs = '<input type="hidden" name="boxchecked" value="0" />
		<input type="hidden" name="option" value="com_hwdvideoshare" />
		<input type="hidden" name="task" value="botJombackup" />
		<input type="hidden" name="hidemainmenu" value="0">';
		jimport('joomla.html.pane');
		$pane =& JPane::getInstance('tabs');
		$startpane = $pane->startPane( 'video-pane' );
		$endtab = $pane->endPanel();
		$endpane = $pane->endPane();
		$starttab1 = $pane->startPanel( _HWDVIDS_TAB_FTP, 'panel1' );
		$starttab2 = $pane->startPanel( _HWDVIDS_TAB_REMOTE, 'panel2' );
		$starttab3 = $pane->startPanel( _HWDVIDS_TAB_SQL, 'panel3' );
		$starttab4 = $pane->startPanel( _HWDVIDS_TAB_CSV, 'panel4' );
		$starttab5 = $pane->startPanel( _HWDVIDS_TAB_SEYRET, 'panel5' );
		$starttab6 = $pane->startPanel( _HWDVIDS_TAB_TPV, 'panel6' );
		$starttab7 = $pane->startPanel( _HWDVIDS_TAB_PHPM, 'panel7' );
		$starttab8 = $pane->startPanel( _HWDVIDS_TAB_SCAN, 'panel8' );

		/** assign template variables **/
		$smartyvs->assign( "hidden_inputs", $hidden_inputs );
		$smartyvs->assign( "header_title", _HWDVIDS_SECTIONHEAD_IMPORT );
		$smartyvs->assign( "startpane", $startpane );
		$smartyvs->assign( "endtab", $endtab );
		$smartyvs->assign( "endpane", $endpane );
		$smartyvs->assign( "starttab1", $starttab1 );
		$smartyvs->assign( "starttab2", $starttab2 );
		$smartyvs->assign( "starttab3", $starttab3 );
		$smartyvs->assign( "starttab4", $starttab4 );
		$smartyvs->assign( "starttab5", $starttab5 );
		$smartyvs->assign( "starttab6", $starttab6 );
		$smartyvs->assign( "starttab7", $starttab7 );
		$smartyvs->assign( "starttab8", $starttab8 );
		$smartyvs->assign( "newvideoid", hwd_vs_tools::generateNewVideoid() );

		if (file_exists(JPATH_SITE.DS.'components'.DS.'com_seyret'.DS)) {
			$smartyvs->assign( "seyretinstalled", 1 );

			//check number of seyret videos
			$db->SetQuery( 'SELECT count(*)'
							. ' FROM #__seyret_items'
						 );
			$seyretitems = $db->loadResult();
			$smartyvs->assign( "seyretitems", $seyretitems );

			//get seyret categories
			$db->setQuery( "SELECT `id` AS `key`, `categoryname` AS `text` FROM #__seyret_categories ORDER BY categoryname" );
			$rows_seyret = $db->loadObjectList();

			$n = count($rows_seyret);
			$rows_seyret[$n]->key = "-1";
			$rows_seyret[$n]->text = "All Categories";

			$seyretcatsel = JHTML::_('select.genericlist', $rows_seyret, 'seyretcid', 'class="inputbox" size="1"', 'key', 'text', -1);

			$smartyvs->assign( "seyretcatsel", $seyretcatsel );
		}
		if (file_exists(JPATH_SITE.DS.'components'.DS.'com_achtube'.DS)) {
			$smartyvs->assign( "achtubeinstalled", 1 );
		}

		$smartyvs->display('admin_import.tpl');
		return;
	}
   /**
	* system cleanup
	*/
	function maintenance($permdelete_report, $total, $fixerrors_report, $recount_report, $archivelogs_report, $fixerror_cache, $recount_cache, $archive_cache)
	{
		global $smartyvs;

		$hidden_inputs = '<input type="hidden" name="boxchecked" value="0" />
				<input type="hidden" name="option" value="com_hwdvideoshare" />
				<input type="hidden" name="task" value="runmaintenance" />
				<input type="hidden" name="hidemainmenu" value="0">';
		$smartyvs->assign( "hidden_inputs" , $hidden_inputs );
		$smartyvs->assign( "header_title" , _HWDVIDS_SECTIONHEAD_CLUP );
		$smartyvs->assign( "permdelete_report" , $permdelete_report );
		$smartyvs->assign( "total" , $total );
		$smartyvs->assign( "fixerrors_report" , $fixerrors_report );
		$smartyvs->assign( "recount_report" , $recount_report );
		$smartyvs->assign( "archivelogs_report" , $archivelogs_report );
		$smartyvs->assign( "fixerror_cache" , $fixerror_cache );
		$smartyvs->assign( "recount_cache" , $recount_cache );
		$smartyvs->assign( "archive_cache" , $archive_cache );

		$smartyvs->display('admin_maintenance.tpl');
		return;
	}
   /**
	* system cleanup
	*/
	function initialise()
	{
		global $smartyvs;

		$hidden_inputs = '<input type="hidden" name="boxchecked" value="0" />
		<input type="hidden" name="option" value="com_hwdvideoshare" />
		<input type="hidden" name="task" value="initialise_now" />
		<input type="hidden" name="hidemainmenu" value="0">';
		$smartyvs->assign( "hidden_inputs" , $hidden_inputs );
		$smartyvs->assign( "header_title" , _HWDVIDS_SECTIONHEAD_HOME );
		$smartyvs->assign( "block_maintenance", 1 );

		$smartyvs->display('admin_initialise.tpl');
		return;
	}
}
?>