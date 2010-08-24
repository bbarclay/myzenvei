<?php
/**
 *    @version [ Dannevirke ]
 *    @package hwdVideoShare
 *    @copyright (C) 2007 - 2009 Highwood Design
 *    @license Creative Commons Attribution-Non-Commercial-No Derivative Works 3.0 Unported Licence
 *    @license http://creativecommons.org/licenses/by-nc-nd/3.0/
 */
defined( '_JEXEC' ) or die( 'Direct Access to this location is not allowed.' );

class plgContentplug_hwd_vs_videoplayer extends JPlugin
{
	/**
	 * Constructor
	 *
	 * For php4 compatibility we must not use the __constructor as a constructor for plugins
	 * because func_get_args ( void ) returns a copy of all passed arguments NOT references.
	 * This causes problems with cross-referencing necessary for the observer design pattern.
	 *
	 * @access	protected
	 * @param	object	$subject The object to observe
	 * @param 	array   $config  An array that holds the plugin configuration
	 * @since	1.0
	 */
	function plgContentplug_hwd_vs_videoplayer()
	{
	}


    function onPrepareContent(&$row, &$params, $page=0)
    {
    global $mainframe, $Itemid, $smartyvs;
		$db =& JFactory::getDBO();

		if (!$params) {
			return;
		} else {
			$plugin =& JPluginHelper::getPlugin('content', 'plug_hwd_vs_videoplayer');
			$pluginParams = new JParameter( $plugin->params );

			//And define the parameters. For example like this..
			$limit = $pluginParams->def( 'nameofparameter', 0 );
            $allvideos_css = $pluginParams->def( 'allvideos_css', 'allvideos' );
			$width         = $pluginParams->def( 'width', 400 );
			$height        = $pluginParams->def( 'height', 300 );
			$top_margin    = 'margin-top:'.$pluginParams->def( 'top_margin', 8 ).'px;';
			$bottom_margin = 'margin-bottom:'.$pluginParams->def( 'bottom_margin', 8 ).'px;';
			$roweo_align   = 'text-align:'.$pluginParams->def( 'video_align', 'center' ).';';
		}

		if (!defined( '_HWDVS_INI_FLAG' )) {
			define( '_HWDVS_INI_FLAG', 1 );

			if (!file_exists(JPATH_SITE.DS.'administrator'.DS.'components'.DS.'com_hwdvideoshare'.DS)) {
				echo "<div style=\"border:1px solid #c30;color:#c30;margin: 0 0 5px 0;padding: 5px;font-weight: bold;text-align:left;text-align:center;\">The hwdVideoShare component is not installed, you can not use this module.</div>"; return;
			}

			$db =& JFactory::getDBO();
			$my = & JFactory::getUser();
			require_once(JPATH_SITE.DS.'administrator'.DS.'components'.DS.'com_hwdvideoshare'.DS.'helpers'.DS.'initialise.php');
			hwdvsInitialise::coreRequire();
			hwdvsInitialise::language();
			hwdvsInitialise::template();
			hwdvsInitialise::mysqlQuery();
			hwdvsInitialise::definitions();

			if (@_HWD_VS_PLUGIN_COMPS !== 214) {
				echo "<div style=\"border:1px solid #c30;color:#c30;margin: 0 0 5px 0;padding: 5px;font-weight: bold;text-align:left;text-align:center;\">This module is not compatible with your version of hwdVideoShare.</div>"; return;
			}

			$c = hwd_vs_Config::get_instance();
			$video_id = JRequest::getInt( 'video_id', null );

		}

		$regex = array("hwdvideoshare" => array("", "#{hwdvideoshare}(.*?){/hwdvideoshare}#s"),
		               "hwdvs"         => array("", "#{hwdvs}(.*?){/hwdvs}#s"),
		               "hwdvs-player"  => array("", "#{hwdvs-player}(.*?){/hwdvs-player}#s"),
		               "hwdvs-related" => array("", "#{hwdvs-related}(.*?){/hwdvs-related}#s")
		              );

		// prepend and append code
		$startcode = "\n\n<!-- hwdVideoShare Mambot starts here -->\n<div style=\"clear:both;".$roweo_align.$top_margin.$bottom_margin."\" class=\"".$allvideos_css."\">\n";
		$endcode = "\n</div>\n<!-- hwdVideoShare Mambot ends here -->\n\n";

		if ( !$params->get( 'enabled', 1 ) ) {
			foreach ($regex as $key => $value) {
			  $row->text = preg_replace( $regex[$key][1], '', $row->text );
			}
			return;
		}

		foreach ($regex as $key => $value) {  // searching for marks

			if (preg_match_all($regex[$key][1], $row->text, $matches, PREG_PATTERN_ORDER) > 0) {

				foreach ($matches[0] as $match) {

					if ($key == "hwdvideoshare" || $key == "hwdvs" || $key == "hwdvs-player") {

						$i_template = null;
						$i_width = null;
						$i_height = null;

						$match_original = preg_replace("/{.+?}/", "", $match);
						if (explode("|",$match_original)) {
							$rawpars=explode("|",$match_original); # What params may the user have given us?
							foreach($rawpars as $rawpar) { # Parse them all
								$curpar=explode("=",$rawpar); # Separate key name and parameter value
								if (@$curpar[1]) { # is there a value behind the "="?
									switch ($curpar[0]) { # key specific auto values

										case "id"      : $match=$curpar[1]; break;
										case "tpl"     : $i_template=$curpar[1]; break;
										case "width"   : $i_width=$curpar[1]; break;
										case "height"  : $i_height=$curpar[1]; break;

									} # switch ($curkey)
								} else {
									$match = preg_replace("/{.+?}/", "", $match);
								}
							}
						} else {
							$match = preg_replace("/{.+?}/", "", $match);
						}

						$bot_template = null;
						$bot_width = null;
						$bot_height = null;

						$bot_template = "mambot_".$i_template.".tpl";

						if (!empty($i_width)) {
							$bot_width = $i_width;
						} else {
							$bot_width = $width;
						}
						if (!empty($i_height)) {
							$bot_height = $i_height;
						} else {
							if ($height == 0) {
								$bot_height = null;
							} else {
								$bot_height = $height;
							}
						}

						// set core sql variables
						$joinv = ' LEFT JOIN #__users AS u ON u.id = a.user_id';
						$select = ' a.*, u.name, u.username';
						if ($c->cbint == 2) {
							$joinv.= ' LEFT JOIN #__community_users AS p ON p.userid = a.user_id';
							$select.= ', p.avatar';
						} else if ($c->cbint == 1) {
							$joinv.= ' LEFT JOIN #__comprofiler AS p ON p.id = a.user_id';
							$select.= ', p.avatar';
						}

						$query = "SELECT".$select." FROM #__hwdvidsvideos AS a ".$joinv." WHERE a.id = ".(int)$match;
						$db->SetQuery( $query );
						$video = $db->loadObject();

						// get view count
						hwd_vs_tools::logViewing($video->id);
						require_once(JPATH_SITE.DS.'administrator'.DS.'components'.DS.'com_hwdvideoshare'.DS.'libraries'.DS.'maintenance_recount.class.php');
						hwd_vs_recount::recountVideoViews($video->id);

						$hwdvsItemid = hwd_vs_tools::generateValidItemid();
						if (empty($video->avatar)) { $video->avatar = ''; }

						if (empty($video->video_type)) {
							$code = "<div style=\"border:1px solid #c30;color:#c30;margin: 0 0 5px 0;padding: 5px;font-weight: bold;text-align:left;text-align:center;\">The video (Video ID: ".(int)$match.") does not exist</div>";
						} else if ($video->approved !== "yes") {
							$code = "<div style=\"border:1px solid #c30;color:#c30;margin: 0 0 5px 0;padding: 5px;font-weight: bold;text-align:left;text-align:center;\">The video (Video ID: ".(int)$match.") is not available</div>";
						} else if ($video->published !== "1") {
							$code = "<div style=\"border:1px solid #c30;color:#c30;margin: 0 0 5px 0;padding: 5px;font-weight: bold;text-align:left;text-align:center;\">The video (Video ID: ".(int)$match.") is not published</div>";
						} else {

							$c = hwd_vs_Config::get_instance();
							$template_folder = $mainframe->getUserState( "com_hwdvideoshare.template_folder", '' );
							$template_element = $mainframe->getUserState( "com_hwdvideoshare.template_element", '' );

							if (!empty($template_folder) && !empty($template_element)) {
								$c->hwdvids_template_path = $template_folder;
								$c->hwdvids_template_file = $template_element;
							}

							$tooltip_data = null;
							$tooltip_data[0] = 0;
							$tooltip_data[1] = addslashes(hwd_vs_tools::truncateText(strip_tags(html_entity_decode($video->title)), $c->truntitle));
							$tooltip_data[2] = addslashes(hwd_vs_tools::truncateText(strip_tags(html_entity_decode($video->description)), $c->trunvdesc));
							$data->player = hwd_vs_tools::generateVideoPlayer($video, $bot_width, $bot_height);
							$data->videourl = hwd_vs_tools::generateVideoUrl($video);
							$data->embedcode = hwd_vs_tools::generateEmbedCode($video);
							$data->ratingsystem = hwd_vs_tools::generateRatingSystem($video);
							$data->favouritebutton = hwd_vs_tools::generateFavouriteButton($video);
							$data->thumbnail = hwd_vs_tools::generateVideoThumbnailLink($video->id, $video->video_id, $video->video_type, $video->thumbnail, 0, $c->thumbwidth, null, null, null, $hwdvsItemid, null, $tooltip_data);
							$data->avatar = hwd_vs_tools::generateAvatar($video->user_id, $video->avatar, 0);
							$data->title = hwd_vs_tools::generateVideoLink( $video->id, $video->title, $hwdvsItemid, null, $c->truntitle );
							$data->category = hwd_vs_tools::generateCategoryLink($video->category_id);
							$data->description = hwd_vs_tools::truncateText($video->description, $c->trunvdesc);
							$data->rating = hwd_vs_tools::generateRatingImg($video->updated_rating);
							$data->views = $video->number_of_views;
							$data->duration = $video->video_length;
							$data->uploader = hwd_vs_tools::generateUserFromID($video->user_id);
							$data->deletevideo = hwd_vs_tools::generateDeleteVideoLink($video);
							$data->editvideo = hwd_vs_tools::generateEditVideoLink($video);
							$data->k = 0;
							$smartyvs->assign("data", $data);
							$smartyvs->assign("thumbwidth", $c->thumbwidth);
							hwd_vs_javascript::ajaxRate($row);

							if (file_exists(JPATH_PLUGINS.DS.$c->hwdvids_template_path.DS.$c->hwdvids_template_file.DS.'templates'.DS.$bot_template)) {
								$code = $smartyvs->fetch($template);
							} else if (file_exists(JPATH_PLUGINS.DS.$c->hwdvids_template_path.DS.$c->hwdvids_template_file.DS.'templates'.DS.'plug_hwd_vs_videoplayer.tpl')) {
								$code = $smartyvs->fetch('plug_hwd_vs_videoplayer.tpl');
							} else {
								$code = $smartyvs->fetch(HWDVIDSPATH.'/templates/plug_hwd_vs_videoplayer.tpl');
							}
						}

					} else if ($key == "hwdvs-related") {

						$match_original = preg_replace("/{.+?}/", "", $match);
						$i_template = intval($match_original);

						/* Security Note: These values are auto-sanitized by mosGetParam() */
						$hwdvids_params['style']	 		= (int)$params->get( 'style', '1');
						$hwdvids_params['malignment']	 	= (int)$params->get( 'malignment', '2');
						$hwdvids_params['talignment']	 	= (int)$params->get( 'talignment', '2');
						$hwdvids_params['order']	 		= $params->get( 'order', 'date_uploaded');
						$hwdvids_params['featured']	 		= (int)$params->get( 'featured', '0');
						$hwdvids_params['include_cats']	 	= $params->get( 'include_cats', '');
						$hwdvids_params['exclude_cats']	 	= $params->get( 'exclude_cats', '');
						$hwdvids_params['mod_hwd_itemid'] 	= (int)$params->get( 'mod_hwd_itemid', '0');
						$hwdvids_params['mod_width'] 		= $params->get( 'mod_width', '100%');
						$hwdvids_params['thumb_width'] 		= (int)$params->get( 'thumb_width', '120');
						$hwdvids_params['novpr'] 			= (int)$params->get( 'novpr', '3');
						$hwdvids_params['trunc_title'] 		= (int)$params->get( 'trunc_title', '');
						$hwdvids_params['trunc_descr'] 		= (int)$params->get( 'trunc_descr', '');
						$hwdvids_params['showtt'] 		    = (int)$params->get( 'showtt', '0');
						$hwdvids_params['showtitle'] 		= (int)$params->get( 'showtitle', '1');
						$hwdvids_params['showcategory'] 	= (int)$params->get( 'showcategory', '0');
						$hwdvids_params['showdescription'] 	= (int)$params->get( 'showdescription', '0');
						$hwdvids_params['showrating'] 		= (int)$params->get( 'showrating', '0');
						$hwdvids_params['shownov'] 			= (int)$params->get( 'shownov', '0');
						$hwdvids_params['showduration'] 	= (int)$params->get( 'showduration', '0');
						$hwdvids_params['showuser'] 		= (int)$params->get( 'showuser', '0');
						$hwdvids_params['showtime'] 		= (int)$params->get( 'showtime', '0');
						$hwdvids_params['timeformat'] 		= $params->get( 'timeformat', 'm');

						if ($i_template > 0) {
							$hwdvids_params['novtd'] = $i_template;
						} else {
							$hwdvids_params['novtd'] = 3;
						}


						if ($hwdvids_params['mod_hwd_itemid'] == 0) {
							$hwdvids_params['mod_hwd_itemid'] = hwd_vs_tools::generateValidItemid();
						}

						if ($hwdvids_params['showtt'] == 0) {
							$tooltip = false;
						} else {
							$tooltip = true;
						}

						$join = ' LEFT JOIN #__users AS u ON u.id = a.user_id';
						$select = ' a.*, u.name, u.username';
						if ($c->cbint == 2) {
							$join.= ' LEFT JOIN #__community_users AS p ON p.userid = a.user_id';
							$select.= ', p.avatar';
						} else if ($c->cbint == 1) {
							$join.= ' LEFT JOIN #__comprofiler AS p ON p.id = a.user_id';
							$select.= ', p.avatar';
						}

						if ($hwdvids_params['style'] == 1) {
							$limit = ' LIMIT 0, 20';
						} else {
							$limit = ' LIMIT 0, '.$hwdvids_params['novtd'];
						}


						$doc =& JFactory::getDocument();
						$meta_title = $doc->getMetaData( "title" );
						$meta_description = $doc->getMetaData( "description" );
						$meta_keywords = $doc->getMetaData( "keywords" );

						$searchterm = $meta_title." ".$meta_description." ".$meta_keywords;
						$searchterm = explode(" ", $searchterm);
						$searchterm = preg_replace("/[^a-zA-Z0-9s_-]/", "", $searchterm);
						$searchterm = implode(" ", $searchterm);

						if (!$my->id) {
							$wherevids = ' WHERE a.public_private = \'public\' AND MATCH (title,tags,description) AGAINST (\''.$searchterm.'\')';
						} else {
							$wherevids = ' WHERE MATCH (title,tags,description) AGAINST (\''.$searchterm.'\')';
						}

						$where = ' AND a.published = 1';
						$where.= ' AND a.approved = "yes"';

						if (isset($video_id)) {
							$where.= ' AND a.id <> '.$video_id;
						}

						if ($hwdvids_params['featured'] == 1) {
							$where.= ' AND a.featured = 1';
						}
						if (!empty($hwdvids_params['include_cats'])) {
							$where.= ' AND a.category_id IN ( '.$hwdvids_params['include_cats'].' )';
						}
						if (!empty($hwdvids_params['exclude_cats'])) {
							$where.= ' AND a.category_id NOT IN ( '.$hwdvids_params['exclude_cats'].' )';
						}

						// get matching video data
						$query = 'SELECT'.$select
								. ' FROM #__hwdvidsvideos AS a'
								. $join
								. $wherevids
								. $where
								;


						$db->SetQuery($query);
						$rows = $db->loadObjectList();

						$list = hwd_vs_tools::generateVideoListFromSql($rows, null, $hwdvids_params['thumb_width'], null, $hwdvids_params['mod_hwd_itemid'], null, $tooltip, $hwdvids_params['trunc_title'], $hwdvids_params['trunc_descr']);
						$smartyvs->assign("list", $list);

						if ($hwdvids_params['style'] == 1) {
							$mainframe->addCustomHeadTag('<script type="text/javascript" src="'.JURI::root( true ).'/components/com_hwdvideoshare/assets/js/icarousel.js"></script> ');
							$iCID = 'sqlmod'.rand(10, 99);
							hwdvsCarousel::setup($iCID, $hwdvids_params);
							$smartyvs->assign("iCID", $iCID);
						} else {
							$smartyvs->assign("static_width", ((100/$hwdvids_params['novpr'])));
						}

						$smartyvs->assign("hwdvids_params", $hwdvids_params);

						$code = $smartyvs->fetch('mod_hwd_vs_sql_datalists.tpl');

					}

					// replace original code with new output
					$row->text = preg_replace("#{".preg_quote($key)."}".preg_quote($match_original)."{/".preg_quote($key)."}#s", $startcode.$code.$endcode , $row->text );
				}
			}
		}
    }
}

// Import library dependencies
jimport('joomla.event.plugin');
jimport( 'joomla.plugin.plugin' );
$mainframe->registerEvent('onBeforeDisplayContent', 'plgContentplug_hwd_vs_videoplayer');

?>
