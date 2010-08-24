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

class hwd_ps_HTML
{
   /**
	* show frontpage
	*/
	function homepage($stats)
	{
		global $smartyps;

		/** define template variables **/
		$hidden_inputs = '<input type="hidden" name="option" value="com_hwdphotoshare" />
		                  <input type="hidden" name="task" value="homepage" />';
		jimport('joomla.html.pane');
		$pane =& JPane::getInstance('tabs');
		$startpane = $pane->startPane( 'welcome-pane' );
		$endtab = $pane->endPanel();
		$endpane = $pane->endPane();
		$starttab1 = $pane->startPanel( _HWDPS_TAB_STATS, 'panel1' );
		$starttab2 = $pane->startPanel( _HWDPS_TAB_INFO, 'panel2' );

		/** assign template variables **/
		$smartyps->assign( "hidden_inputs", $hidden_inputs );
		$smartyps->assign( "header_title", _HWDPS_SECTIONHEAD_HOME );
		$smartyps->assign( "stats", $stats );
		$smartyps->assign( "startpane", $startpane );
		$smartyps->assign( "endtab", $endtab );
		$smartyps->assign( "endpane", $endpane );
		$smartyps->assign( "starttab1", $starttab1 );
		$smartyps->assign( "starttab2", $starttab2 );

		/** display template **/
		$smartyps->display('admin_index.tpl');
		return;
	}
   /**
	* show videos
	*/
	function showphotos($rows, $rows_feat, &$pageNav, $searchtext, $category_id)
	{
		global $mosConfig_live_site, $mosConfig_absolute_path, $limitstart, $smartyps, $mosConfig_offset, $Itemid, $my;

		/** define template variables **/
		$hidden_inputs = '<input type="hidden" name="boxchecked" value="0" />
						  <input type="hidden" name="option" value="com_hwdphotoshare" />
						  <input type="hidden" name="limitstart" value="'.$limitstart.'" />
						  <input type="hidden" name="task" value="photos" />
						  <input type="hidden" name="hidemainmenu" value="0">';
		$categoryselectlist = hwd_ps_tools::categoryList(_HWDPS_INFO_ANYCAT, $category_id, _HWDPS_SELECT_NOCATS, 0, "category_id", 0);
		$search = _HWDPS_SEARCHP.'&nbsp;';
		$search.= '<input type="text" name="search" value="'.$searchtext.'" class="text_area" onChange="document.adminForm.submit();" />&nbsp;';
		$search.= $categoryselectlist.'&nbsp;';
		$search.= _HWDPS_RPP.'&nbsp;';
		$search.= $pageNav->getLimitBox().'&nbsp;';
		jimport('joomla.html.pane');
		$pane =& JPane::getInstance('tabs');
		$startpane = $pane->startPane( 'photos-pane' );
		$endtab = $pane->endPanel();
		$endpane = $pane->endPane();
		$starttab1 = $pane->startPanel( _HWDPS_TAB_ALLPHOTOS, 'panel1' );
		$starttab2 = $pane->startPanel( _HWDPS_TAB_FEATP, 'panel2' );

		/** define template arrays **/
		$list_all = array();
		$k = 0;
		for ($i=0, $n=count($rows); $i < $n; $i++) {
			$row = $rows[$i];
			$link = 'index.php?option=com_hwdphotoshare&task=editphotoA&hidemainmenu=1&cid='. $row->id;

			$list_all[$i]->id = $row->id;
			$list_all[$i]->checked = JHTML::_('grid.checkedout', $row, $i);

			//$list_all[$i]->thumbnail_nolink = hwd_ps_tools::generateThumbnail( $row->id, $row->photo_id, $row->photo_type, $row->original_type, $k, 0, "psorgthumb");
			//$list_all[$i]->thumbnail = '<a href="'.$link.'" title="Edit Category">'.$list_all[$i]->thumbnail_nolink.'</a>';

			$thumbnail = hwd_ps_tools::generateThumbnailURL($row->id, $row->photo_id, $row->photo_type, $row->original_type);
			$photo = hwd_ps_tools::generatePhotoURL($row);
			$list_all[$i]->thumbnail = hwd_ps_tools::generatePreviewLink( $row, $photo, $thumbnail );

			if (empty($row->title)) { $row->title = "No Title"; }
			$list_all[$i]->title = '<a href="'.$link.'" title="Edit Category">'.stripslashes($row->title).'</a>';

			if (empty($row->caption)) { $row->caption = "None"; }
			$list_all[$i]->caption = $row->caption;
			$list_all[$i]->rating = $row->updated_rating;
			$list_all[$i]->views = $row->number_of_views;
			$list_all[$i]->access = hwd_ps_tools::generateAlbumAccess($row->privacy);
			$list_all[$i]->date = $row->date_uploaded;
			$list_all[$i]->status = hwd_ps_tools::generatePhotoStatus($row->approved);
			$list_all[$i]->published_task = $row->published ? 'unpublish' : 'publish';
			$list_all[$i]->published_img = $row->published ? 'publish_g.png' : 'publish_x.png';
			$list_all[$i]->featured_task = $row->featured ? 'unfeaturephoto' : 'featurephoto';
			$list_all[$i]->featured_img =$row->featured ? 'publish_g.png' : 'publish_x.png';
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

			$list_feat[$i]->thumbnail_nolink = hwd_ps_tools::generateThumbnail( $row->id, $row->photo_id, $row->photo_type, $row->original_type, $k, 0, "psorgthumb");


			if ( $row->checked_out && ( $row->checked_out != $my->id ) ) {
				$list_feat[$i]->title = stripslashes($row->title);
			} else {
				$link = 'index.php?option=com_hwdphotoshare&task=editphotoA&hidemainmenu=1&cid='. $row->id;
				$list_feat[$i]->title = '<a href="'.$link.'" title="Edit Category">'.stripslashes($row->title).'</a>';
			}
			$list_feat[$i]->rating = $row->updated_rating;
			$list_feat[$i]->views = $row->number_of_views;
			$list_feat[$i]->access = hwd_ps_tools::generateAlbumAccess($row->privacy);
			$list_feat[$i]->date = $row->date_uploaded;
			$list_feat[$i]->published_task = $row->published ? 'unpublish' : 'publish';
			$list_feat[$i]->published_img = $row->published ? 'publish_g.png' : 'publish_x.png';
			$list_feat[$i]->featured_task = $row->featured ? 'unfeature' : 'feature';
			$list_feat[$i]->featured_img =$row->featured ? 'publish_g.png' : 'publish_x.png';
			$list_feat[$i]->k = $k;
			$list_feat[$i]->i = $cbtotal;
			$list_feat[$i]->order = $row->ordering;
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
		$smartyps->assign( "hidden_inputs" , $hidden_inputs );
		$smartyps->assign( "header_title" , _HWDPS_SECTIONHEAD_PHOTOS );
		$smartyps->assign( "print_search", 1 );
		$smartyps->assign( "search", $search );
		$smartyps->assign( "totalvideos", count($rows) );
		$smartyps->assign( "writePagesLinks", $pageNav->getPagesLinks() );
		$smartyps->assign( "writePagesCounter", $pageNav->getPagesCounter() );
		$smartyps->assign( "list_all", $list_all );
		$smartyps->assign( "list_feat", $list_feat );
		$smartyps->assign( "startpane", $startpane );
		$smartyps->assign( "endtab", $endtab );
		$smartyps->assign( "endpane", $endpane );
		$smartyps->assign( "starttab1", $starttab1 );
		$smartyps->assign( "starttab2", $starttab2 );

		/** display template **/
		$smartyps->display('admin_photos.tpl');
		return;
	}
	/**
	* show videos
	*/
	function showalbums($rows, $rows_feat, &$pageNav, $searchtext, $category_id)
	{
		global $mosConfig_live_site, $mosConfig_absolute_path, $limitstart, $smartyps, $mosConfig_offset, $Itemid, $my;

		/** define template variables **/
		$hidden_inputs = '<input type="hidden" name="boxchecked" value="0" />
						  <input type="hidden" name="option" value="com_hwdphotoshare" />
						  <input type="hidden" name="limitstart" value="'.$limitstart.'" />
						  <input type="hidden" name="task" value="albums" />
						  <input type="hidden" name="hidemainmenu" value="0">';
		$categoryselectlist = hwd_ps_tools::categoryList(_HWDPS_INFO_ANYCAT, $category_id, _HWDPS_SELECT_NOCATS, 0, "category_id", 0);
		$search = _HWDPS_SEARCHA.'&nbsp;';
		$search.= '<input type="text" name="search" value="'.$searchtext.'" class="text_area" onChange="document.adminForm.submit();" />&nbsp;';
		$search.= $categoryselectlist.'&nbsp;';
		$search.= _HWDPS_RPP.'&nbsp;';
		$search.= $pageNav->getLimitBox().'&nbsp;';
		jimport('joomla.html.pane');
		$pane =& JPane::getInstance('tabs');
		$startpane = $pane->startPane( 'albums-pane' );
		$endtab = $pane->endPanel();
		$endpane = $pane->endPane();
		$starttab1 = $pane->startPanel( _HWDPS_TAB_ALLALBUMS, 'panel1' );
		$starttab2 = $pane->startPanel( _HWDPS_TAB_FEATA, 'panel2' );

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
				$link = 'index.php?option=com_hwdphotoshare&task=editalbumA&hidemainmenu=1&cid='. $row->id;
				$list_all[$i]->title = '<a href="'.$link.'" title="Edit Category">'.stripslashes($row->title).'</a>';
			}
			$list_all[$i]->numphotos = (int)$row->number_of_photos;
			$list_all[$i]->access = hwd_ps_tools::generateAlbumAccess($row->privacy);
			$list_all[$i]->date_created = $row->date_created;
			$list_all[$i]->date_modified = $row->date_modified;
			$list_all[$i]->status = hwd_ps_tools::generateAlbumStatus($row->approved);
			$list_all[$i]->published_task = $row->published ? 'unpublishalbum' : 'publishalbum';
			$list_all[$i]->published_img = $row->published ? 'publish_g.png' : 'publish_x.png';
			$list_all[$i]->featured_task = $row->featured ? 'unfeaturealbum' : 'featurealbum';
			$list_all[$i]->featured_img =$row->featured ? 'publish_g.png' : 'publish_x.png';
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
			$list_feat[$i]->checked = JHTML::_('grid.checkedout', $row, $cbtotal );
			if ( $row->checked_out && ( $row->checked_out != $my->id ) ) {
				$list_feat[$i]->title = stripslashes($row->title);
			} else {
				$link = 'index.php?option=com_hwdphotoshare&task=editvidsA&hidemainmenu=1&cid='. $row->id;
				$list_feat[$i]->title = '<a href="'.$link.'" title="Edit Category">'.stripslashes($row->title).'</a>';
			}
			$list_feat[$i]->rating = $row->updated_rating;
			$list_feat[$i]->views = $row->number_of_views;
			$list_feat[$i]->access = hwd_ps_tools::generateAlbumAccess($row->privacy);
			$list_feat[$i]->date = $row->date_uploaded;
			$list_feat[$i]->published_task = $row->published ? 'unpublish' : 'publish';
			$list_feat[$i]->published_img = $row->published ? 'publish_g.png' : 'publish_x.png';
			$list_feat[$i]->featured_task = $row->featured ? 'unfeature' : 'feature';
			$list_feat[$i]->featured_img =$row->featured ? 'publish_g.png' : 'publish_x.png';
			$list_feat[$i]->k = $k;
			$list_feat[$i]->i = $cbtotal;
			$list_feat[$i]->order = $row->ordering;
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
		$smartyps->assign( "hidden_inputs" , $hidden_inputs );
		$smartyps->assign( "header_title" , _HWDPS_SECTIONHEAD_ALBUMS );
		$smartyps->assign( "print_search", 1 );
		$smartyps->assign( "search", $search );
		$smartyps->assign( "totalvideos", count($rows) );
		$smartyps->assign( "writePagesLinks", $pageNav->getPagesLinks() );
		$smartyps->assign( "writePagesCounter", $pageNav->getPagesCounter() );
		$smartyps->assign( "list_all", $list_all );
		$smartyps->assign( "list_feat", $list_feat );
		$smartyps->assign( "startpane", $startpane );
		$smartyps->assign( "endtab", $endtab );
		$smartyps->assign( "endpane", $endpane );
		$smartyps->assign( "starttab1", $starttab1 );
		$smartyps->assign( "starttab2", $starttab2 );

		/** display template **/
		$smartyps->display('admin_albums.tpl');
		return;
	}
   /**
	* export
	*/
	function editAlbum($row, $usr, $photos)
	{
		global $smartyps, $Itemid;
		$c = hwd_ps_Config::get_instance();
		$editor =& JFactory::getEditor();
		jimport('joomla.html.pane');
		$pane =& JPane::getInstance('tabs');
		$startpane = $pane->startPane( 'album-edit-pane' );
		$endtab = $pane->endPanel();
		$endpane = $pane->endPane();
		$starttab1 = $pane->startPanel( _HWDPS_TAB_BASIC, 'panel1' );
		$starttab2 = $pane->startPanel( _HWDPS_TAB_SHARING, 'panel2' );

		/** define template variables **/
		$hidden_inputs = '<input type="hidden" name="option" value="com_hwdphotoshare" />
		<input type="hidden" name="id" value="'.$row->id.'" />
		<input type="hidden" name="task" value="saveAlbum" />';

		if ($row->privacy == "public") { $pubsel = "selected=\"selected\""; $regsel=null; } else { $regsel = "selected=\"selected\""; $pubsel=null; }
		$privacy = "<select name=\"privacy\">
		            <option value=\"public\" ".$pubsel.">"._HWDPS_SELECT_PUBLIC."</option>
		            <option value=\"registered\" ".$regsel.">"._HWDPS_SELECT_REG."</option>
					</select>";

		/** assign template variables **/
		$smartyps->assign( "hidden_inputs" , $hidden_inputs );
		$smartyps->assign( "header_title" , _HWDPS_SECTIONHEAD_ALBUMS );
		$smartyps->assign( "row" , $row );
		$smartyps->assign( "startpane", $startpane );
		$smartyps->assign( "endtab", $endtab );
		$smartyps->assign( "endpane", $endpane );
		$smartyps->assign( "starttab1", $starttab1 );
		$smartyps->assign( "starttab2", $starttab2 );

		if ($row->approved == "deleted") {
			$smartyps->display('admin_videos_edit_deleted.tpl');
			return;
		} else if ($row->approved == "pending") {
		    $smartyps->assign( 'print_pending', 1 );
		}

		$smartyps->assign( "title", str_replace('"', "&#34;", $row->title) );
		$smartyps->assign( "description", $editor->display("description",stripslashes($row->description),350,250,40,20,1) );
		$smartyps->assign( "tags", str_replace('"', "&#34;", $row->tags) );
		$smartyps->assign( "tags_verified", empty($row->tags) ? "None" : str_replace('"', "&#34;", $row->tags) );
		$smartyps->assign( "category", hwd_ps_tools::generateCategory($row->category_id) );
		$smartyps->assign( "categorylist" , hwd_ps_tools::categoryList(_HWDPS_SELECT_SELECTCATEGORY, $row->category_id, _HWDPS_SELECT_NOCATS, 1) );
		$smartyps->assign( "published", hwd_ps_tools::yesnoSelectList( 'published', 'class="inputbox"', $row->published ) );
		$smartyps->assign( "featured", hwd_ps_tools::yesnoSelectList( 'featured', 'class="inputbox"', $row->featured ) );
		$smartyps->assign( "date_created", $row->date_created );
		$smartyps->assign( "date_modified", $row->date_modified );
		$smartyps->assign( "privacy", $privacy );
		$smartyps->assign( "allow_comments", hwd_ps_tools::yesnoSelectList( 'allow_comments', 'class="inputbox"', $row->allow_comments ) );
		$smartyps->assign( "allow_ratings", hwd_ps_tools::yesnoSelectList( 'allow_ratings', 'class="inputbox"', $row->allow_ratings ) );
		$smartyps->assign( "album_url", JURI::root(true)."/index.php?option=com_hwdphotoshare&task=viewalbum&Itemid=".$Itemid."&album_id=".$row->id );
		$smartyps->assign( "status", hwd_ps_tools::generateAlbumStatus($row->approved) );
		$smartyps->assign( "access", hwd_ps_tools::generateAlbumAccess($row->privacy) );
		$smartyps->assign( "user", $usr->username );

		$listphoto = hwd_ps_tools::generatePhotoListFromSql($photos);
		$smartyps->assign("listphoto", $listphoto);

		$smartyps->display('admin_albums_edit.tpl');
		return;
	}

   /**
	* export
	*/
	function editPhoto($row, $usr, $favs)
	{
		global $smartyps, $Itemid;
		$c = hwd_ps_Config::get_instance();
		$editor =& JFactory::getEditor();
		jimport('joomla.html.pane');
		$pane =& JPane::getInstance('tabs');
		$startpane = $pane->startPane( 'photo-edit-pane' );
		$endtab = $pane->endPanel();
		$endpane = $pane->endPane();
		$starttab1 = $pane->startPanel( _HWDPS_TAB_BASIC, 'panel1' );
		$starttab2 = $pane->startPanel( _HWDPS_TAB_SHARING, 'panel2' );

		/** define template variables **/
		$hidden_inputs = '<input type="hidden" name="option" value="com_hwdphotoshare" />
		<input type="hidden" name="id" value="'.$row->id.'" />
		<input type="hidden" name="task" value="savePhoto" />';

		if ($row->privacy == "public") { $pubsel = "selected=\"selected\""; $regsel=null; } else { $regsel = "selected=\"selected\""; $pubsel=null; }
		$privacy = "<select name=\"privacy\">
		            <option value=\"public\" ".$pubsel.">"._HWDPS_SELECT_PUBLIC."</option>
		            <option value=\"registered\" ".$regsel.">"._HWDPS_SELECT_REG."</option>
					</select>";

		/** assign template variables **/
		$smartyps->assign( "hidden_inputs" , $hidden_inputs );
		$smartyps->assign( "header_title" , _HWDPS_SECTIONHEAD_PHOTOS );
		$smartyps->assign( "row" , $row );
		$smartyps->assign( "startpane", $startpane );
		$smartyps->assign( "endtab", $endtab );
		$smartyps->assign( "endpane", $endpane );
		$smartyps->assign( "starttab1", $starttab1 );
		$smartyps->assign( "starttab2", $starttab2 );

		if ($row->approved == "deleted") {
			$smartyps->display('admin_videos_edit_deleted.tpl');
			return;
		} else if ($row->approved == "pending") {
		    $smartyps->assign( 'print_pending', 1 );
		}

		$smartyps->assign( "title", str_replace('"', "&#34;", $row->title) );
		$smartyps->assign( "caption", $editor->display("caption",stripslashes($row->caption),350,250,40,20,1) );
		$smartyps->assign( "tags", str_replace('"', "&#34;", $row->tags) );
		$smartyps->assign( "tags_verified", empty($row->tags) ? "None" : str_replace('"', "&#34;", $row->tags) );
		$smartyps->assign( "album_verified", empty($row->album_id) ? "None" : $row->album_id );
		$smartyps->assign( "albumlist" , hwd_ps_tools::generateAlbumSelectList(_HWDPS_SELECT_SELECTALBUM, $row->album_id, _HWDPS_SELECT_NOALBUMS, 1, "album_id", 0, $row->user_id) );
		$smartyps->assign( "published", hwd_ps_tools::yesnoSelectList( 'published', 'class="inputbox"', $row->published ) );
		$smartyps->assign( "featured", hwd_ps_tools::yesnoSelectList( 'featured', 'class="inputbox"', $row->featured ) );
		$smartyps->assign( "dateuploaded", $row->date_uploaded );
		$smartyps->assign( "privacy", $privacy );
		$smartyps->assign( "allow_comments", hwd_ps_tools::yesnoSelectList( 'allow_comments', 'class="inputbox"', $row->allow_comments ) );
		$smartyps->assign( "allow_ratings", hwd_ps_tools::yesnoSelectList( 'allow_ratings', 'class="inputbox"', $row->allow_ratings ) );
		$smartyps->assign( "photo_url", JURI::root(true)."/index.php?option=com_hwdphotoshare&task=viewphoto&Itemid=".$Itemid."&album_id=".$row->album_id."&limitstart=".$row->ordering );
		$smartyps->assign( "status", hwd_ps_tools::generatePhotoStatus($row->approved) );
		$smartyps->assign( "access", hwd_ps_tools::generatePhotoAccess($row->privacy) );
		$smartyps->assign( "rating", hwd_ps_tools::generateExactRating($row) );
		$smartyps->assign( "views", $row->number_of_views );
		$smartyps->assign( "user", $usr->username );
		$smartyps->assign( "favoured", $favs );

		$smartyps->assign( "image_tn", hwd_ps_tools::generateThumbnail( $row->id, $row->photo_id, $row->photo_type, $row->original_type, 0, 0, "psthumb" ) );
		$smartyps->assign( "image_tn_square", hwd_ps_tools::generateThumbnail( $row->id, $row->photo_id, $row->photo_type, $row->original_type, 0, 1, "psthumb" ) );
		$smartyps->assign( "image_tn_square_reflected", hwd_ps_tools::generateThumbnail( $row->id, $row->photo_id, $row->photo_type, $row->original_type, 0, 2, "psthumb" ) );
		$smartyps->assign( "image_main", hwd_ps_tools::generatePhoto( $row ) );
		$smartyps->assign( "image_original", hwd_ps_tools::generateThumbnail( $row->id, $row->photo_id, $row->photo_type, $row->original_type, 0, 2, "psthumb" ) );


		/** display template **/
		$smartyps->display('admin_photos_edit.tpl');
		return;
	}
   /**
	* edit videos
	*/
	function editvideos($row, $cat, $usr, $favs, $flagged, $uploader_list)
	{
		global $mosConfig_live_site, $mosConfig_absolute_path, $database, $smartyps, $Itemid;
		$c = hwd_ps_Config::get_instance();
		// force no-cache so new thumbnail will display
		header( 'Expires: Mon, 26 Jul 1997 05:00:00 GMT' );
		header( 'Last-Modified: ' . gmdate( 'D, d M Y H:i:s' ) . ' GMT' );
		header( 'Cache-Control: no-store, no-cache, must-revalidate' );
		header( 'Cache-Control: post-check=0, pre-check=0', false );
		header( 'Pragma: no-cache' );

		/** define template variables **/
		$hidden_inputs = '<input type="hidden" name="option" value="com_hwdphotoshare" />
		<input type="hidden" name="id" value="'.$row->id.'" />
		<input type="hidden" name="video_type" value="'.$row->video_type.'" />
		<input type="hidden" name="task" value="savevid" />';
		jimport('joomla.html.pane');
		$pane =& JPane::getInstance('tabs');
		$startpane = $pane->startPane( 'video-edit-pane' );
		$endtab = $pane->endPanel();
		$endpane = $pane->endPane();
		$starttab1 = $pane->startPanel( _HWDPS_TAB_BASIC, 'panel1' );
		$starttab2 = $pane->startPanel( _HWDPS_TAB_SHARING, 'panel2' );

		if ($row->public_private == "public") { $pubsel = "selected=\"selected\""; } else { $regsel = "selected=\"selected\""; }
		$public_private = "<select name=\"public_private\">
		                   <option value=\"public\" ".$pubsel.">"._HWDPS_SELECT_PUBLIC."</option>
		                   <option value=\"registered\" ".$regsel.">"._HWDPS_SELECT_REG."</option>
					       </select>";

		if ($row->video_type == "local") {
			$location = _HWDPS_DETAILS_SOTS."<br /><b>"._HWDPS_DETAILS_FNAME.":</b> ".$mosConfig_absolute_path."/hwdphotos/uploads/".$row->video_id.".flv";
			if (@!file_exists($mosConfig_absolute_path."/hwdphotos/uploads/".$row->video_id.".flv")) {
				$missingfile = "<div style=\"color:#ff0000;font-weight:bold;\">"._HWDPS_ALERT_MISSINGVIDFILE."</div>";
			}
		} else if ($row->video_type == "swf") {
			$location = _HWDPS_DETAILS_SOTS."<br /><b>"._HWDPS_DETAILS_FNAME.":</b> ".$mosConfig_absolute_path."/hwdphotos/uploads/".$row->video_id.".swf";
			if (@!file_exists($mosConfig_absolute_path."/hwdphotos/uploads/".$row->video_id.".swf")) {
				$missingfile = "<div style=\"color:#ff0000;font-weight:bold;\">"._HWDPS_ALERT_MISSINGVIDFILE."</div>";
			}
		} else {
			$location = _HWDPS_DETAILS_REMSER;
		}

		/** assign template variables **/
		$smartyps->assign( "hidden_inputs" , $hidden_inputs );
		$smartyps->assign( "header_title" , _HWDPS_SECTIONHEAD_VIDEOS );
		$smartyps->assign( "row" , $row );
		$smartyps->assign( "startpane", $startpane );
		$smartyps->assign( "endtab", $endtab );
		$smartyps->assign( "endpane", $endpane );
		$smartyps->assign( "starttab1", $starttab1 );
		$smartyps->assign( "starttab2", $starttab2 );

		if ($row->approved == "deleted") {
			$smartyps->display('admin_videos_edit_deleted.tpl');
			return;
		} else if ($row->approved == "queuedforconversion") {
			$smartyps->display('admin_videos_edit_queuedforconversion.tpl');
			return;
		} else if ($row->approved == "queuedforthumbnail") {
			$smartyps->display('admin_videos_edit_queuedforthumbnail.tpl');
			return;
		} else if ($row->approved == "queuedforswf") {
			$smartyps->display('admin_videos_edit_queuedforswf.tpl');
			return;
		}  else if ($row->approved == "pending") {
		    $smartyps->assign( "print_pending", 1 );
		}

		$smartyps->assign( "categorylist" , hwd_ps_tools::categoryList(_HWDPS_SELECT_SELECTCATEGORY, $row->category_id, _HWDPS_SELECT_NOCATS, 1) );
		$smartyps->assign( "title", stripslashes($row->title) );
		$smartyps->assign( "category", hwd_ps_tools::generateCategory( $row->category_id ) );
		$smartyps->assign( "description", stripslashes($row->description) );
		$smartyps->assign( "tags", stripslashes($row->tags) );
		$smartyps->assign( "published", mosHTML::yesnoSelectList( 'published', 'class="inputbox"', $row->published ) );
		$smartyps->assign( "featured", mosHTML::yesnoSelectList( 'featured', 'class="inputbox"', $row->featured ) );
		$smartyps->assign( "dateuploaded", $row->date_uploaded );
		$smartyps->assign( "duration", $row->video_length );
		$smartyps->assign( "uploader_list", $uploader_list );
		$smartyps->assign( "public_private", $public_private );
		$smartyps->assign( "allow_comments", mosHTML::yesnoSelectList( 'allow_comments', 'class="inputbox"', $row->allow_comments ) );
		$smartyps->assign( "allow_embedding", mosHTML::yesnoSelectList( 'allow_embedding', 'class="inputbox"', $row->allow_embedding ) );
		$smartyps->assign( "allow_ratings", mosHTML::yesnoSelectList( 'allow_ratings', 'class="inputbox"', $row->allow_ratings ) );
		$smartyps->assign( "link_live_video", $mosConfig_live_site."/index.php?option=com_hwdphotoshare&task=viewvideo&Itemid=".$Itemid."&video_id=".$row->id );
		$smartyps->assign( "status", hwd_ps_tools::generateVideoStatus($row->approved) );
		$smartyps->assign( "videoplayer", hwd_ps_tools::generateVideoPlayer($row) );
		$smartyps->assign( "missingfile", $missingfile );
		$smartyps->assign( "location", $location );
		$smartyps->assign( "thumbnail", hwd_ps_tools::generateThumbnail( $row->id, $row->video_id, $row->video_type, $k, $width, $height, $class) );
		$smartyps->assign( "access", hwd_ps_tools::generateVideoAccess( $row->public_private ) );
		$smartyps->assign( "rating", hwd_ps_tools::generateExactRating($row) );
		$smartyps->assign( "views", $row->number_of_views );
		$smartyps->assign( "user", $usr->username );
		$smartyps->assign( "favoured", $favs );

		$thumbnail_form_code = null;
		// generate thumbnail form
		if ($row->approved == "yes" || $row->approved == "pending") {
			if ($row->video_type == "local") {
				$thumbnail_form_code.= '<h3>Regenerate Thumbnail Images with FFMPEG</h3>';
				$thumbnail_form_code.= '<p>Enter the video time you want your new thumbnail taken and click <b>Generate</b>.</p>';
				$thumbnail_form_code.= '<form action="index.php" method="post">
				<input name="time" value="0:00:02" size="7" maxlength="8">
				<input type="submit" value="Generate">
				<input type="hidden" name="option" value="'.$option.'" />
				<input type="hidden" name="cid" value="'.$row->id.'" />
				<input type="hidden" name="task" value="editvidsA" />
				<input type="hidden" name="draw_thumbnail" value="1" />
				</form>';
				$thumbnail_form_code.= '<h3>Upload Custom Thumbnail</h3>';
				$thumbnail_form_code.= '<p>Upload a custom thumbnail image from your computer. If possible, it will be automatically re-sized.</p>';
				$thumbnail_form_code.= '<form action="index.php" method="post" enctype="multipart/form-data">
				<table cellpadding="0" cellspacing="0" border="0" width="100%">
					<tr>
						<td valign="top" align="left" width="60%">
							<table cellpadding="0" cellspacing="0" border="0" width="100%">
								<tr>
									<td valign="top">Custom Thumbnail Image</td>
									<td><input type="file" name="thumbnail_file" value="" size="30"></td>
								</tr>
								<tr>
									<td valign="top"></td>
									<td><input type="submit" value="Upload"></td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
				<input type="hidden" name="option" value="'.$option.'" />
				<input type="hidden" name="cid" value="'.$row->id.'" />
				<input type="hidden" name="task" value="editvidsA" />
				<input type="hidden" name="upld_thumbnail" value="1" />
				</form>';
			} else if ($row->video_type == "swf") {
				$thumbnail_form_code.= '<h3>Upload Custom Thumbnail</h3>';
				$thumbnail_form_code.= '<p>Upload a custom thumbnail image from your computer. If possible, it will be automatically re-sized.</p>';
				$thumbnail_form_code.= '<form action="index.php" method="post" enctype="multipart/form-data">
				<table cellpadding="0" cellspacing="0" border="0" width="100%">
					<tr>
						<td valign="top" align="left" width="60%">
							<table cellpadding="0" cellspacing="0" border="0" width="100%">
								<tr>
									<td valign="top">Custom Thumbnail Image</td>
									<td><input type="file" name="thumbnail_file" value="" size="30"></td>
								</tr>
								<tr>
									<td valign="top"></td>
									<td><input type="submit" value="Upload"></td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
				<input type="hidden" name="option" value="'.$option.'" />
				<input type="hidden" name="cid" value="'.$row->id.'" />
				<input type="hidden" name="task" value="editvidsA" />
				<input type="hidden" name="upld_thumbnail" value="1" />
				</form>';
			} else {
				if (@explode(",", $row->video_id)) {
					$data = @explode(",", $row->video_id);
					$thumbnail = @$data[1];
				} else { $thumbnail = "ERROR"; }
				$thumbnail_form_code.= '<p>This is a third party video. If you want to alter the thumbnail for this video please enter the URL of the new thumbnail image and click <b>Save</b>.</p>';
				$thumbnail_form_code.= '<form action="index.php" method="post">
				<table cellpadding="4" cellspacing="0" border="0" width="100%">
					<tr>
						<td valign="top" align="left" width="60%">
							<table>
								<tr>
									<td valign="top">Custom Thumbnail URL</td>
									<td><input type="text" name="thumbnail_url" value="'.$thumbnail.'" size="30"></td>
								</tr>
								<tr>
									<td valign="top"></td>
									<td><input type="submit" value="Save"></td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
				<input type="hidden" name="option" value="'.$option.'" />
				<input type="hidden" name="cid" value="'.$row->id.'" />
				<input type="hidden" name="task" value="editvidsA" />
				<input type="hidden" name="tp_thumbnail_updt" value="1" />
				</form>';
			}
		}
		$smartyps->assign( "thumbnail_form_code", $thumbnail_form_code );

		/** display template **/
		$smartyps->display('admin_videos_edit.tpl');
		return;
	}
   /**
	* show categories
	*/
	function showcategories($rows, &$pageNav, $searchtext)
	{
		global $mosConfig_live_site, $limitstart, $mosConfig_offset, $smartyps, $Itemid, $my;

		/** define template variables **/
		$hidden_inputs = '<input type="hidden" name="boxchecked" value="0" />
		<input type="hidden" name="option" value="com_hwdphotoshare" />
		<input type="hidden" name="limitstart" value="'.$limitstart.'" />
		<input type="hidden" name="task" value="categories" />
		<input type="hidden" name="hidemainmenu" value="0">';
		$search = _HWDPS_SEARCHC.'&nbsp;';
		$search.= '<input type="text" name="search" value="'.$searchtext.'" class="text_area" onChange="document.adminForm.submit();" />&nbsp;';
		$search.= _HWDPS_RPP.'&nbsp;';
		$search.= $pageNav->getLimitBox().'&nbsp;';

		/** assign template variables **/
		$smartyps->assign( "hidden_inputs" , $hidden_inputs );
		$smartyps->assign( "header_title" , _HWDPS_SECTIONHEAD_CATS );
		$smartyps->assign( "print_search", 1 );
		$smartyps->assign( "search", $search );
		$smartyps->assign( "totalcategories", count($rows) );
		$smartyps->assign( "writePagesLinks", $pageNav->getPagesLinks() );
		$smartyps->assign( "writePagesCounter", $pageNav->getPagesCounter() );

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
			if ( $row->checked_out && ( $row->checked_out != $my->id ) ) {
				$list[$i]->title = stripslashes($row->treename);
			} else {
				$link = 'index.php?option=com_hwdphotoshare&task=editcatA&hidemainmenu=1&cid='. $row->id;
				$list[$i]->title = '<a href="'.$link.'" title="Edit Category">'.stripslashes($row->treename).'</a>';
			}
            if ($row->access_v == -2) {
				$list[$i]->view_access = _HWDPS_SELECT_EVERYONE;
            } else if ($row->access_v == -2) {
				$list[$i]->view_access = _HWDPS_SELECT_ALLREGUSER;
			} else {
                $gID = hwd_ps_access::groupName($row->access_v);
				$list[$i]->view_access = $gID;
            }
            if ($row->access_u == -2) {
				$list[$i]->upld_access = _HWDPS_SELECT_EVERYONE;
            } else if ($row->access_u == -2) {
				$list[$i]->upld_access = _HWDPS_SELECT_ALLREGUSER;
			} else {
                $gID = hwd_ps_access::groupName($row->access_u);
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
		$smartyps->assign( "list", $list );

		/** display template **/
		$smartyps->display('admin_categories_browse.tpl');
		return;
	}
   /**
	* edit categories
	*/
	function editcategories($row, $gtree, $categoryList)
	{
		global $option, $smartyps, $task;
		$task        = JRequest::getCmd( 'task', 'frontpage' );
		$c = hwd_ps_Config::get_instance();

		/** define template variables **/
		$hidden_inputs = '<input type="hidden" name="option" value="'.$option.'" />
		<input type="hidden" name="id" value="'.$row->id.'" />
		<input type="hidden" name="task" value="" />';

		if ($row->access_v_r == "RECURSE") { $recusel = "selected=\"selected\""; $nonesel=null; } else { $nonesel = "selected=\"selected\""; $recusel=null; }
		$access_v_r = "<select name=\"access_v_r\" size=\"1\" class=\"inputbox\">
		                   <option value=\"RECURSE\" ".$recusel.">"._HWDPS_YES."</option>
		                   <option value=\"0\" ".$nonesel.">"._HWDPS_NO."</option>
					       </select>";
		if ($row->access_u_r == "RECURSE") { $recusel = "selected=\"selected\""; $nonesel=null; } else { $nonesel = "selected=\"selected\""; $recusel=null; }
		$access_u_r = "<select name=\"access_u_r\" size=\"1\" class=\"inputbox\">
		                   <option value=\"RECURSE\" ".$recusel.">"._HWDPS_YES."</option>
		                   <option value=\"0\" ".$nonesel.">"._HWDPS_NO."</option>
					       </select>";

		/** assign template variables **/
		$smartyps->assign( "hidden_inputs" , $hidden_inputs );
		$smartyps->assign( "header_title" , _HWDPS_SECTIONHEAD_CATS );
		$smartyps->assign( "title" , $row->category_name );
		$smartyps->assign( "row" , $row );
		$smartyps->assign( "categoryList" , $categoryList );
		if ($c->access_method == 0) {
			$smartyps->assign( "print_accessgroups", 1 );
		} else {
			$smartyps->assign( "print_accesslevels", 1 );
		}

		if ($task !== "newcat") {
			$smartyps->assign( "print_parentcheck", 1 );
		}

		$smartyps->assign( "category_id", $row->id );
		$smartyps->assign( "published", hwd_ps_tools::yesnoSelectList( 'published', 'class="inputbox"', $row->published ) );
		$smartyps->assign( "cvaccess_g", JHTML::_('select.genericlist', $gtree, 'access_v', 'size="4"', 'value', 'text', $row->access_v ) );
		$smartyps->assign( "cuaccess_g", JHTML::_('select.genericlist', $gtree, 'access_u', 'size="4"', 'value', 'text', $row->access_u ) );
		$smartyps->assign( "access_v_r", $access_v_r );
		$smartyps->assign( "access_u_r", $access_u_r );
		$smartyps->assign( "cvaccess_l", hwd_ps_tools::hwdpsMultiAccess( $row->access_lev_v, 'access_lev_v[]' ) );
		$smartyps->assign( "cuaccess_l", hwd_ps_tools::hwdpsMultiAccess( $row->access_lev_u, 'access_lev_u[]' ) );
		$smartyps->assign( "access_b_v", hwd_ps_tools::yesnoSelectList( 'access_b_v', 'class="inputbox"', $row->access_b_v ) );

		/** display template **/
		$smartyps->display('admin_categories_edit.tpl');
		return;
	}
   /**
	* show groups
	*/
	function showgroups($rows, &$pageNav, $searchtext)
	{
		global $mosConfig_live_site, $Itemid, $smartyps, $my;

		/** define template variables **/
		$hidden_inputs = '<input type="hidden" name="boxchecked" value="0" />
		<input type="hidden" name="option" value="com_hwdphotoshare" />
		<input type="hidden" name="task" value="groups" />
		<input type="hidden" name="hidemainmenu" value="0">';
		$search = _HWDPS_SEARCHG.'&nbsp;';
		$search.= '<input type="text" name="search" value="'.$searchtext.'" class="text_area" onChange="document.adminForm.submit();" />&nbsp;';
		$search.= _HWDPS_RPP.'&nbsp;';
		$search.= $pageNav->getLimitBox().'&nbsp;';

		/** assign template variables **/
		$smartyps->assign( "hidden_inputs" , $hidden_inputs );
		$smartyps->assign( "header_title" , _HWDPS_SECTIONHEAD_GROUPS );
		$smartyps->assign( "print_search", 1 );
		$smartyps->assign( "search", $search );
		$smartyps->assign( "totalgroups", count($rows) );
		$smartyps->assign( "writePagesLinks", $pageNav->getPagesLinks() );
		$smartyps->assign( "writePagesCounter", $pageNav->getPagesCounter() );

		/** define template arrays **/
		$list = array();
		$k = 0;
		for ($i=0, $n=count($rows); $i < $n; $i++) {
			$row = $rows[$i];

			$link = 'index.php?option=com_hwdphotoshare&task=editgrpA&hidemainmenu=1&cid='. $row->id;


			$list[$i]->id = $row->id;
			$list[$i]->checked = JHTML::_('grid.checkedout', $row, $i);
			$list[$i]->title = '<a href="'.$link.'" title="Edit Group">'.stripslashes($row->group_name).'</a>';
			$list[$i]->description = stripslashes($row->group_description);
			$list[$i]->access = hwd_ps_tools::generateGroupAccess( $row->privacy );
			$list[$i]->date = $row->date;
			$list[$i]->total_members = $row->total_members;
			$list[$i]->total_photos = $row->total_photos;
			$list[$i]->published_task = $row->published ? 'unpublishg' : 'publishg';
			$list[$i]->published_img = $row->published ? 'publish_g.png' : 'publish_x.png';
			$list[$i]->featured_task = $row->featured ? 'unfeatureg' : 'featureg';
			$list[$i]->featured_img =$row->featured ? 'publish_g.png' : 'publish_x.png';
			$list[$i]->k = $k;
			$list[$i]->i = $i;
			$k = 1 - $k;
		}
		$smartyps->assign( "list", $list );

		/** display template **/
		$smartyps->display('admin_groups_browse.tpl');
		return;
	}
   /**
	* edit categories
	*/
	function editgroups($row, $uploader_list)
	{
		global $mosConfig_live_site, $smartyps;
		$c = hwd_ps_Config::get_instance();

		/** define template variables **/
		$hidden_inputs = '<input type="hidden" name="option" value="'.$option.'" />
		<input type="hidden" name="id" value="'.$row->id.'" />
		<input type="hidden" name="task" value="" />';
		jimport('joomla.html.pane');
		$pane =& JPane::getInstance('tabs');
		$startpane = $pane->startPane( 'group-edit-pane' );
		$endtab = $pane->endPanel();
		$endpane = $pane->endPane();
		$starttab1 = $pane->startPanel("Basic", 'panel1' );
		$starttab2 = $pane->startPanel("Videos", 'panel2' );
		$starttab3 = $pane->startPanel("Members", 'panel3' );

		if ($row->privacy == "public") { $pubsel = "selected=\"selected\""; $regsel = null; } else { $regsel = "selected=\"selected\""; $pubsel = null; }
		$public_private = "<select name=\"public_private\">
		                   <option value=\"public\" ".$pubsel.">"._HWDPS_SELECT_PUBLIC."</option>
		                   <option value=\"registered\" ".$regsel.">"._HWDPS_SELECT_REG."</option>
					       </select>";

		/** assign template variables **/
		$smartyps->assign( "hidden_inputs", $hidden_inputs );
		$smartyps->assign( "header_title", _HWDPS_SECTIONHEAD_GROUPS );
		$smartyps->assign( "startpane", $startpane );
		$smartyps->assign( "endtab", $endtab );
		$smartyps->assign( "endpane", $endpane );
		$smartyps->assign( "starttab1", $starttab1 );
		$smartyps->assign( "starttab2", $starttab2 );
		$smartyps->assign( "starttab3", $starttab3 );

		$smartyps->assign( "group_name", stripslashes($row->group_name) );
		$smartyps->assign( "group_description", stripslashes($row->group_description) );
		$smartyps->assign( "group_published", hwd_ps_tools::yesnoSelectList( 'published', 'class="inputbox"', $row->published ) );
		$smartyps->assign( "group_featured", hwd_ps_tools::yesnoSelectList( 'featured', 'class="inputbox"', $row->featured ) );
		$smartyps->assign( "group_admin", $uploader_list );
		$smartyps->assign( "group_access", $public_private );
		$smartyps->assign( "group_comments", hwd_ps_tools::yesnoSelectList( 'allow_comments', 'class="inputbox"', $row->allow_comments ) );

		/** display template **/
		$smartyps->display('admin_groups_edit.tpl');
		return;
	}
   /**
	* show server settings
	*/
	function showgeneralsettings(&$gtree)
	{
		global $mosConfig_live_site, $smartyps, $database;
		$c = hwd_ps_Config::get_instance();

		hwdpsInitialise::language('settings');

		require_once(JPATH_SITE.DS.'administrator'.DS.'components'.DS.'com_hwdphotoshare'.DS.'views'.DS.'settings.php');
		hwd_ps_HTML_settings::showgeneralsettings($gtree);
		return;

	}
   /**
	* show converter
	*/
	function converter()
	{
		global $mosConfig_live_site, $smartyps;

		/** define template variables **/
		$hidden_inputs = '<input type="hidden" name="boxchecked" value="0" />
		<input type="hidden" name="option" value="com_hwdphotoshare" />
		<input type="hidden" name="hidemainmenu" value="0">';

		/** assign template variables **/
		$smartyps->assign( "hidden_inputs" , $hidden_inputs );
		$smartyps->assign( "header_title" , _HWDPS_SECTIONHEAD_CONVERTOR );

		/** display template **/
		$smartyps->display('admin_converter.tpl');
		return;
	}
   /**
	* show converter
	*/
	function startconverter($total1, $total2, $total3, $total4)
	{
		global $mosConfig_live_site, $smartyps;

		/** define template variables **/
		$hidden_inputs = '<input type="hidden" name="boxchecked" value="0" />
		<input type="hidden" name="option" value="com_hwdphotoshare" />
		<input type="hidden" name="task" value="resetfconv" />
		<input type="hidden" name="hidemainmenu" value="0">';

		/** assign template variables **/
		$smartyps->assign( "hidden_inputs" , $hidden_inputs );
		$smartyps->assign( "header_title" , _HWDPS_SECTIONHEAD_CONVERTOR );
		$smartyps->assign( "total1" , $total1 );
		$smartyps->assign( "total2" , $total2 );
		$smartyps->assign( "total3" , $total3 );
		$smartyps->assign( "total4" , $total4 );
		$smartyps->assign( "tool1" , mosToolTip( _HWDPS_TT_01B, _HWDPS_TT_01H ) );

		/** display template **/
		$smartyps->display('admin_converter_go.tpl');
		exit;
	}
   /**
	* Show waiting approvals
	*/
	function showapprovals($total_photos, $rows_photos, $total_albums, $rows_albums, &$search, &$filter)
	{
		global $mosConfig_live_site, $database, $smartyps, $mosConfig_offset, $Itemid, $my;

		/** define template variables **/
		$hidden_inputs = '<input type="hidden" name="boxchecked" value="0" />
		<input type="hidden" name="option" value="com_hwdphotoshare" />
		<input type="hidden" name="task" value="approvals" />
		<input type="hidden" name="hidemainmenu" value="0">';

		jimport('joomla.html.pane');
		$pane =& JPane::getInstance('tabs');
		$startpane = $pane->startPane( 'approval-pane' );
		$endtab = $pane->endPanel();
		$endpane = $pane->endPane();
		$starttab1 = $pane->startPanel("Photos", 'panel1' );
		$starttab2 = $pane->startPanel("Albums", 'panel2' );

		/** assign template variables **/
		$smartyps->assign( "hidden_inputs", $hidden_inputs );
		$smartyps->assign( "header_title", _HWDPS_SECTIONHEAD_APPROVALS );
		$smartyps->assign( "total_photos", $total_photos );
		$smartyps->assign( "total_albums", $total_albums );
		$smartyps->assign( "startpane", $startpane );
		$smartyps->assign( "endtab", $endtab );
		$smartyps->assign( "endpane", $endpane );
		$smartyps->assign( "starttab1", $starttab1 );
		$smartyps->assign( "starttab2", $starttab2 );

		$list_photos = array();
		$k = 0;
		for ($i=0, $n=count($rows_photos); $i < $n; $i++) {
			$row = $rows_photos[$i];

			$list_photos[$i]->id = $row->id;
			$list_photos[$i]->checked = JHTML::_('grid.checkedout', $row, $i);

			$list_photos[$i]->thumbnail_nolink = hwd_ps_tools::generateThumbnail( $row->id, $row->photo_id, $row->photo_type, $row->original_type, $k, 0, "psorgthumb");

			if ( $row->checked_out && ( $row->checked_out != $my->id ) ) {
				$list_photos[$i]->thumbnail = $list_photos[$i]->thumbnail_nolink;
			} else {
				$link = 'index.php?option=com_hwdphotoshare&task=editphotoA&hidemainmenu=1&cid='. $row->id;
				$list_photos[$i]->thumbnail = '<a href="'.$link.'" title="Edit Category">'.$list_photos[$i]->thumbnail_nolink.'</a>';
			}

			if (empty($row->title)) { $row->title = "No Title"; }
			if ( $row->checked_out && ( $row->checked_out != $my->id ) ) {
				$list_photos[$i]->title = stripslashes($row->title);
			} else {
				$link = 'index.php?option=com_hwdphotoshare&task=editphotoA&hidemainmenu=1&cid='. $row->id;
				$list_photos[$i]->title = '<a href="'.$link.'" title="Edit Category">'.stripslashes($row->title).'</a>';
			}

			if (empty($row->caption)) { $row->caption = "None"; }
			$list_photos[$i]->caption = $row->caption;
			$list_photos[$i]->rating = $row->updated_rating;
			$list_photos[$i]->views = $row->number_of_views;
			$list_photos[$i]->access = hwd_ps_tools::generateAlbumAccess($row->privacy);
			$list_photos[$i]->date = $row->date_uploaded;
			$list_photos[$i]->status = hwd_ps_tools::generatePhotoStatus($row->approved);
			$list_photos[$i]->approve_task = 'approvephoto';
			$list_photos[$i]->approve_img = 'publish_g.png';
			$list_photos[$i]->k = $k;
			$list_photos[$i]->i = $i;
			$k = 1 - $k;
		}
		$smartyps->assign( "list_photos", $list_photos );

		$cbtotal = count($rows_photos);
		$list_albums = array();
		$k = 0;
		for ($i=0, $n=count($rows_albums); $i < $n; $i++) {
			$row = $rows_albums[$i];

			$list_albums[$i]->id = $row->id;
			$list_albums[$i]->checked = JHTML::_('grid.checkedout', $row, $cbtotal );
			if ( $row->checked_out && ( $row->checked_out != $my->id ) ) {
				$list_albums[$i]->title = stripslashes($row->title);
			} else {
				$link = 'index.php?option=com_hwdphotoshare&task=editalbumA&hidemainmenu=1&cid='. $row->id;
				$list_albums[$i]->title = '<a href="'.$link.'" title="Edit Category">'.stripslashes($row->title).'</a>';
			}
			$list_albums[$i]->numphotos = (int)$row->number_of_photos;
			$list_albums[$i]->access = hwd_ps_tools::generateAlbumAccess($row->privacy);
			$list_albums[$i]->date_created = $row->date_created;
			$list_albums[$i]->date_modified = $row->date_modified;
			$list_albums[$i]->status = hwd_ps_tools::generateAlbumStatus($row->approved);
			$list_albums[$i]->published_task = $row->published ? 'unpublishalbum' : 'publishalbum';
			$list_albums[$i]->published_img = $row->published ? 'publish_g.png' : 'publish_x.png';
			$list_albums[$i]->featured_task = $row->featured ? 'unfeaturealbum' : 'featurealbum';
			$list_albums[$i]->featured_img =$row->featured ? 'publish_g.png' : 'publish_x.png';
			$list_albums[$i]->approve_task = 'approvealbum';
			$list_albums[$i]->approve_img = 'publish_g.png';
			$list_albums[$i]->k = $k;
			$list_albums[$i]->i = $cbtotal;
			$k = 1 - $k;
			$cbtotal++;
		}
		$smartyps->assign( "list_albums", $list_albums );
		$smartyps->assign( "cbtotal", $cbtotal );

		/** display template **/
		$smartyps->display('admin_approvals.tpl');
		return;






	}
   /**
	* show flagged media
	*/
	function showflagged(&$rowsfv, &$rowsfg)
	{
		global $mosConfig_live_site, $database, $mosConfig_offset, $smartyps, $Itemid, $my;

		/** define template variables **/
		$hidden_inputs = '<input type="hidden" name="boxchecked" value="0" />
		<input type="hidden" name="option" value="com_hwdphotoshare" />
		<input type="hidden" name="task" value="flagged" />
		<input type="hidden" name="hidemainmenu" value="0">';
		$smartyps->assign( "hidden_inputs", $hidden_inputs );
		$smartyps->assign( "header_title", _HWDPS_SECTIONHEAD_FLAGGED );
		$smartyps->assign( "totalvideos", count($rowsfv) );


		$smartyps->display('admin_underdevelopment.tpl');
		return;
	}
   /**
	* show plugins
	*/
	function plugins() {
		global $option, $smartyps, $limitstart;

		$hidden_inputs = '<input type="hidden" name="option" value="'.$option.'" />
		<input type="hidden" name="task" value="plugins" />
		<input type="hidden" name="boxchecked" value="0" />
		<input type="hidden" name="limitstart" value="'.$limitstart.'" />
		<input type="hidden" name="hidemainmenu" value="0" />';
		$smartyps->assign( "hidden_inputs" , $hidden_inputs );
		$smartyps->assign( "header_title" , _HWDPS_SECTIONHEAD_PLUGIN );

        $smartyps->display('admin_plugins.tpl');
		return;
	}

   /**
	* Writes the edit form for new and existing module
	*
	* A new record is defined when <var>$row</var> is passed with the <var>id</var>
	* property set to 0.
	* @param hwdpsplugin $row
	* @param array of string $lists  An array of select lists
	* @param cbParamsEditor $params
	* @param string $option of component.
	*
	*/
	function editPlugin( &$row, &$lists, &$params ) {
		global $mosConfig_live_site, $smartyps, $mainframe;

		$hidden_inputs = '<input type="hidden" name="option" value="com_hwdphotoshare" />
		<input type="hidden" name="id" value="'.$row->id.'" />
		<input type="hidden" name="task" value="editPlugin" />';
		$smartyps->assign( "hidden_inputs" , $hidden_inputs );
		$smartyps->assign( "header_title" , _HWDPS_SECTIONHEAD_PLUGIN );

	    $row->nameA = '';
		$filesInstalled = true;
		if ( $row->id ) {
			$row->nameA = '[ '. $row->name .' ]';

			$xmlfile = $mainframe->getCfg('absolute_path') . '/hwdphotos/plugin/' .$row->type . '/'.$row->folder . '/' . $row->element .'.xml';
			if (file_exists($xmlfile)) {
				$smartyps->assign( "message" , $message );
			} else {
				$smartyps->assign( "message" , $message );
			}

		}


		$smartyps->assign( "row" , $row );
		$smartyps->assign( "published", mosHTML::yesnoSelectList( 'published', 'class="inputbox"', $row->published ) );

		if ( $filesInstalled && $row->id ) {
			$smartyps->assign( "params" , $params->draw() );
		} elseif ( !$filesInstalled ) {
			$smartyps->assign( "params" , '<b><font style="color:red;">Plugin not installed</font></b><br />'.$params->draw() );
		} else {
			$smartyps->assign( "params" , '<i>No Parameters</i>' );
		}

		$smartyps->display('admin_plugins_edit.tpl');
		return;
	}

   /**
	*/
	function showInstallMessage( $message, $title, $url ) {
		global $smartyps, $PHP_SELF;

		$hidden_inputs = '';
		$smartyps->assign( "hidden_inputs" , $hidden_inputs );
		$smartyps->assign( "header_title" , _HWDPS_SECTIONHEAD_PLUGIN );
		$smartyps->assign( "title" , $title );
		$smartyps->assign( "message" , $message );



		$smartyps->display('admin_plugins_installmessage.tpl');
		return;
	}
   /**
	* export
	*/
	function backuptables()
	{
		global $mosConfig_mailfrom, $smartyps;
		$config = new JConfig;

		$hidden_inputs = '<input type="hidden" name="boxchecked" value="0" />
		<input type="hidden" name="option" value="com_hwdphotoshare" />
		<input type="hidden" name="task" value="botJombackup" />
		<input type="hidden" name="hidemainmenu" value="0">';
		$smartyps->assign( "hidden_inputs" , $hidden_inputs );
		$smartyps->assign( "header_title" , _HWDPS_SECTIONHEAD_BCUP );
  		$smartyps->assign( "mosConfig_mailfrom" , $config->mailfrom );

		$smartyps->display('admin_export.tpl');
		return;
	}
   /**
	* export
	*/
	function importdata()
	{
		global $mosConfig_live_site, $mosConfig_mailfrom, $smartyps, $mosConfig_absolute_path;

		$hidden_inputs = '<input type="hidden" name="boxchecked" value="0" />
				<input type="hidden" name="option" value="com_hwdphotoshare" />
				<input type="hidden" name="task" value="botJombackup" />
				<input type="hidden" name="hidemainmenu" value="0">';
		$smartyps->assign( "hidden_inputs", $hidden_inputs );
		$smartyps->assign( "header_title", _HWDPS_SECTIONHEAD_IMPORT );

		$smartyps->display('admin_underdevelopment.tpl');
		return;

		$smartyps->display('admin_import.tpl');
		return;
	}
   /**
	* system cleanup
	*/
	function maintenance($fixerror_cache, $recount_cache, $archive_cache)
	{
		global $smartyps;

		$hidden_inputs = '<input type="hidden" name="boxchecked" value="0" />
				<input type="hidden" name="option" value="com_hwdphotoshare" />
				<input type="hidden" name="task" value="runmaintenance" />
				<input type="hidden" name="hidemainmenu" value="0">';
		$smartyps->assign( "hidden_inputs" , $hidden_inputs );
		$smartyps->assign( "header_title" , _HWDPS_SECTIONHEAD_CLUP );
		$smartyps->assign( "fixerror_cache" , $fixerror_cache );
		$smartyps->assign( "recount_cache" , $recount_cache );
		$smartyps->assign( "archive_cache" , $archive_cache );

		$smartyps->display('admin_maintenance.tpl');
		return;
	}
   /**
	* system cleanup
	*/
	function noncompat()
	{
		global $mosConfig_live_site;
		?>
		<form action="index.php" method="post" name="adminForm">
		<table cellpadding="0" cellspacing="0" border="0" width="100%" class="adminform">
			<tr>
		  		<td style="background-color: #202626; width:100%; text-align: right; vertical-align: top;" colspan="2">
		  		<img src="<?php echo $mosConfig_live_site."/administrator/components/com_hwdphotoshare/images/logo.gif"; ?>" height="108" width="250" alt="Logo" style="float: left;" />
				<font style="color: #fffffe; font-size: 200%; font-weight: bold;"><?php echo _HWDPS_SECTIONHEAD_HOME; ?></font>
				</td>
			</tr>
			<tr>
   			  <th align="left" style="border: solid 1px #e9e9e9;"><center><div><b><a href="<?php echo $mosConfig_live_site; ?>/administrator/index.php?option=com_hwdphotoshare&amp;task=homepage"><?php echo _HWDPS_BENAV_HP; ?></a>&nbsp;&middot;&nbsp;<a href="<?php echo $mosConfig_live_site; ?>/administrator/index.php?option=com_hwdphotoshare&amp;task=videos"><?php echo _HWDPS_BENAV_VD; ?></a>&nbsp;&middot;&nbsp;<a href="<?php echo $mosConfig_live_site; ?>/administrator/index.php?option=com_hwdphotoshare&amp;task=categories"><?php echo _HWDPS_BENAV_CT; ?></a>&nbsp;&middot;&nbsp;<a href="<?php echo $mosConfig_live_site; ?>/administrator/index.php?option=com_hwdphotoshare&amp;task=groups"><?php echo _HWDPS_BENAV_GP; ?></a>&nbsp;&middot;&nbsp;<a href="<?php echo $mosConfig_live_site; ?>/administrator/index.php?option=com_hwdphotoshare&amp;task=serversettings"><?php echo _HWDPS_BENAV_SS; ?></a>&nbsp;&middot;&nbsp;<a href="<?php echo $mosConfig_live_site; ?>/administrator/index.php?option=com_hwdphotoshare&amp;task=generalsettings"><?php echo _HWDPS_BENAV_GS; ?></a>&nbsp;&middot;&nbsp;<a href="<?php echo $mosConfig_live_site; ?>/administrator/index.php?option=com_hwdphotoshare&amp;task=converter"><?php echo _HWDPS_BENAV_CV; ?></a>&nbsp;&middot;&nbsp;<a href="<?php echo $mosConfig_live_site; ?>/administrator/index.php?option=com_hwdphotoshare&amp;task=approvals"><?php echo _HWDPS_BENAV_WA; ?></a>&nbsp;&middot;&nbsp;<a href="<?php echo $mosConfig_live_site; ?>/administrator/index.php?option=com_hwdphotoshare&amp;task=flagged"><?php echo _HWDPS_BENAV_FM; ?></a>&nbsp;&middot;&nbsp;<a href="<?php echo $mosConfig_live_site; ?>/administrator/index.php?option=com_hwdphotoshare&amp;task=plugins"><?php echo _HWDPS_BENAV_PG; ?></a>&nbsp;&middot;&nbsp;<a href="<?php echo $mosConfig_live_site; ?>/administrator/index.php?option=com_hwdphotoshare&amp;task=export"><?php echo _HWDPS_BENAV_ED; ?></a>&nbsp;&middot;&nbsp;<a href="<?php echo $mosConfig_live_site; ?>/administrator/index.php?option=com_hwdphotoshare&amp;task=import"><?php echo _HWDPS_BENAV_ID; ?></a>&nbsp;&middot;&nbsp;<a href="<?php echo $mosConfig_live_site; ?>/administrator/index.php?option=com_hwdphotoshare&amp;task=maintenance"><?php echo _HWDPS_BENAV_SC; ?></a></b></div></center></td>
  			</tr>
  		</table>
  		<div>
		<table cellpadding="0" cellspacing="0" border="0" width="100%" class="adminform">
			<thead>
			<tr>
				<th align="left" style="border: solid 1px #ccc;"><p><?php echo _HWDPS_COMPATIBILITY_J10; ?></p></th>
			</tr>
			</thead>
		</table>
		</div>
		<input type="hidden" name="boxchecked" value="0" />
		<input type="hidden" name="option" value="com_hwdphotoshare" />
		<input type="hidden" name="task" value="permdelvids" />
		<input type="hidden" name="hidemainmenu" value="0">
		</form>
		<table width="100%"  border="0" cellspacing="0" cellpadding="0" class="adminform">
  			<tr>
    			<td align="center"><center><?php copyright(); ?></center></td>
  			</tr>
		</table>
	<?php
	}
   /**
	* system cleanup
	*/
	function initialise()
	{
		global $mosConfig_live_site, $smartyps;

		$hidden_inputs = '<input type="hidden" name="boxchecked" value="0" />
		<input type="hidden" name="option" value="com_hwdphotoshare" />
		<input type="hidden" name="task" value="initialise_now" />
		<input type="hidden" name="hidemainmenu" value="0">';

		/** assign template variables **/
		$smartyps->assign( "hidden_inputs", $hidden_inputs );
		$smartyps->assign( "header_title", _HWDPS_SECTIONHEAD_HOME );
		$smartyps->assign( "block_maintenance", 1 );

		$smartyps->display('admin_initialise.tpl');
		return;
	}

}
?>