<?php
/**
 *    @version [ Dannevirke ]
 *    @package hwdVideoShare
 *    @copyright (C) 2007 - 2009 Highwood Design
 *    @license Creative Commons Attribution-Non-Commercial-No Derivative Works 3.0 Unported Licence
 *    @license http://creativecommons.org/licenses/by-nc-nd/3.0/
 */
defined( '_JEXEC' ) or die( 'Direct Access to this location is not allowed.' );
    /**
     * Prepares the code to insert the third party video
     *
     * @param string $option  the $video_id output containing video paramters
     * @param int    $flv_width  the video width
     * @param int    $flv_height  the video height
     * @return       $code   the third party embed code
     */
    function veohComPrepareVideo($row, $flv_width=null, $flv_height=null, $autostart=null)
	{
		global $show_video_ad, $pre_url, $post_url, $smartyvs, $task, $pre_url, $post_url;
		if (!defined('HWDVIDSPATH')) { define('HWDVIDSPATH', dirname(__FILE__).'/../../'); }
		$c = hwd_vs_Config::get_instance();

			$code=null;

			if (@explode(",", $row->video_id)) {
				$data = explode(",", $row->video_id);
				$videocode = $data[0];
			} else {
			    return $code;
			}

			if ($c->playlocal == "1") {
				$truepath = veohComPrepareFlvURL($row->video_id);
			} else {
				$truepath = '';
			}

			$file_ext = substr($row->thumbnail, strrpos($row->thumbnail, '.') + 1);

			if (file_exists(JPATH_SITE . DS . "hwdvideos" . DS . "thumbs" . DS . "l_tp-" . $data[0] . "." . $file_ext)) {
				$thumb_url = JURI::root(true) . DS . "hwdvideos" . DS . "thumbs" . DS . "l_tp-" . $data[0] . "." . $file_ext;
			} else {
				$thumb_url = (!empty($row->thumbnail) ? $row->thumbnail : $data[1]);
			}

			if (!empty($truepath) && $c->playlocal == "1") {

				$player = new hwd_vs_videoplayer();

				if ($show_video_ad == 1) {

					if ($c->hwdvids_videoplayer_file == "flow") {

						$flv_tracks = array();
						$flv_tracks[0] = $pre_url;
						$flv_tracks[1] = $truepath;
						$flv_tracks[2] = $post_url;
						$code.= $player->prepareEmbeddedPlayer($flv_tracks, $flv_width, $flv_height, rand(100, 999), "playlist", null, null, null);
						return $code;

					} else {

						$xspf_playlist = JPATH_SITE."/components/com_hwdvideoshare/xml/xspf/".$row->id.".xml";
						@unlink($xspf_playlist);
						require_once(HWDVIDSPATH.'/../../administrator/components/com_hwdrevenuemanager/redrawplaylist.class.php');
						hwd_rm_playlist::writeFile($row, $truepath, $pre_url, $post_url, $thumb_url);

						if (file_exists($xspf_playlist)) {
							$flv_url = JURI::root(true)."/components/com_hwdvideoshare/xml/xspf/".$row->id.".xml";
							$flv_path = HWDVIDSPATH.'/xml/xspf/'.$row->id.'.xml';

							if ($c->loadswfobject == "on" && $task !=="grabjomsocialplayer") {
								$code.= $player->prepareplayer($flv_url, $flv_width, $flv_height, rand(100, 999), "playlist", $flv_path, null, $autostart);
							} else {
								$code.= $player->prepareEmbeddedPlayer($flv_url, $flv_width, $flv_height, rand(100, 999), "playlist", $flv_path, null, $autostart);
							}
							return $code;
						}
					}

				}

				if ($c->loadswfobject == "on") {
					$code.= $player->prepareplayer($truepath, $flv_width, $flv_height, rand(100, 999), "video", null, $thumb_url);
				} else {
					$code.= $player->prepareEmbeddedPlayer($truepath, $flv_width, $flv_height, rand(100, 999), "video", null, $thumb_url);
				}

				return $code;

			} else {

				if ($flv_width==null) {
					$smartyvs->assign("player_width", $c->tpwidth);
					$flv_width = $c->tpwidth."px";
				} else {
					$smartyvs->assign("player_width", $flv_width);
					if (preg_match("/%/", $flv_width)) {
						$flv_width = $flv_width;
					} else {
						$flv_width = $flv_width."px";
					}
				}
				if ($flv_height==null) {
					$flv_height = intval (($c->tpwidth * 0.75) + 27);
					$flv_height = $flv_height."px";
				} else {
					if (preg_match("/%/", $flv_height)) {
						$flv_height = $flv_height;
					} else {
						$flv_height = $flv_height."px";
					}
				}

				$code = "<object width=\"".$flv_width."\" height=\"".$flv_height."\" id=\"veohFlashPlayer\" name=\"veohFlashPlayer\"><param name=\"movie\" value=\"http://www.veoh.com/static/swf/webplayer/WebPlayer.swf?version=AFrontend.5.4.2.21.1002&permalinkId=".$videocode."&player=videodetailsembedded&videoAutoPlay=0&id=anonymous\"></param><param name=\"allowFullScreen\" value=\"true\"></param><param name=\"allowscriptaccess\" value=\"always\"></param><embed src=\"http://www.veoh.com/static/swf/webplayer/WebPlayer.swf?version=AFrontend.5.4.2.21.1002&permalinkId=".$videocode."&player=videodetailsembedded&videoAutoPlay=0&id=anonymous\" type=\"application/x-shockwave-flash\" allowscriptaccess=\"always\" allowfullscreen=\"true\" width=\"".$flv_width."\" height=\"".$flv_height."\" id=\"veohFlashPlayerEmbed\" name=\"veohFlashPlayerEmbed\"></embed></object>";

				return $code;
			}

		return $code;

	}
    /**
     * Prepares the code to insert the third party thumbnail image
     *
     * @param string $option  the $video_id output containing video paramters
     * @param int    $vid  the video database id
     * @param int    $Itemid  the joomla menu id
     * @param int    $k  the alternating CSS integer
     * @return       $code   the full third party thumbnail image tag
     */
	function veohComPrepareThumb($option, $vid, $Itemid, $k, $width=null, $height=null, $class=null, $tooltip_data=null)
	{
		if (!isset($width)) {
			$width = $c->thumbwidth;
		}
		if (!isset($height)) {
			$height = $width*$c->tar_fb;
		}

		$code = "<img src=\"".vimeoComPrepareThumbURL($option, $vid)."\" border=\"0\" width=\"".$width."\" height=\"".$height."\" title=\"".$tooltip_data[1]." :: ".$tooltip_data[2]."\" class=\"".$class."\" />";
		return $code;
	}
    /**
     * Prepares the code to insert the third party thumbnail image
     *
     * @param string $option  the $video_id output containing video paramters
     * @param int    $vid  the video database id
     * @param int    $Itemid  the joomla menu id
     * @param int    $k  the alternating CSS integer
     * @return       $code   the full third party thumbnail image tag
     */
	function veohComPrepareThumbURL($option, $vid)
	{
		$data = explode(",", $option);
		$thumbnail = @$data[1];

		if (!$thumbnail) {
			$code = URL_HWDVS_IMAGES.'default_thumb.jpg';
		} else {
			$code = $thumbnail;
		}
		return $code;
	}
    /**
     * Prepares the third party video link
     *
     * @param string $option  the $video_id output containing video paramters
     * @param int    $vid  the video database id
     * @param int    $Itemid  the joomla menu id
     * @return       $code   the full third party thumbnail image tag
     */
	function veohComPrepareVideoURL($option)
	{
			if (@explode(",", $option)) {
				$data = explode(",", $option);
				$videocode = $data[0];
			} else { $videocode = "ERROR"; }

			$code = "http://www.veoh.com/videos/".$videocode;
			return $code;
	}
    /**
     * Prepares the third party video embed code
     *
     * @param string $option  the $video_id output containing video paramters
     * @param int    $vid  the video database id
     * @param int    $Itemid  the joomla menu id
     * @return       $code   the full third party thumbnail image tag
     */
	function veohComPrepareVideoEmbed($option, $vid, $Itemid)
	{
		global $mosConfig_sitename, $mosConfig_live_site;
		$c = hwd_vs_Config::get_instance();
			if (@explode(",", $option)) {
				$data = explode(",", $option);
				$videocode = $data[0];
			} else { $videocode = "ERROR"; }

			$code = null;
			if ($c->embedreturnlink == 1) {
				$code.='<div><center>';
			}
			$code = "<object width=&#34;410&#34; height=&#34;341&#34; id=&#34;veohFlashPlayer&#34; name=&#34;veohFlashPlayer&#34;><param name=&#34;movie&#34; value=&#34;http://www.veoh.com/static/swf/webplayer/WebPlayer.swf?version=AFrontend.5.4.2.21.1002&permalinkId=".$videocode."&player=videodetailsembedded&videoAutoPlay=0&id=anonymous&#34;></param><param name=&#34;allowFullScreen&#34; value=&#34;true&#34;></param><param name=&#34;allowscriptaccess&#34; value=&#34;always&#34;></param><embed src=&#34;http://www.veoh.com/static/swf/webplayer/WebPlayer.swf?version=AFrontend.5.4.2.21.1002&permalinkId=".$videocode."&player=videodetailsembedded&videoAutoPlay=0&id=anonymous&#34; type=&#34;application/x-shockwave-flash&#34; allowscriptaccess=&#34;always&#34; allowfullscreen=&#34;true&#34; width=&#34;410&#34; height=&#34;341&#34; id=&#34;veohFlashPlayerEmbed&#34; name=&#34;veohFlashPlayerEmbed&#34;></embed></object>";
			if ($c->embedreturnlink == 1) {
				$jconfig = new jconfig();
				$code.='<br /><a href=&#34;'.JURI::root().'index.php?option=com_hwdvideoshare&Itemid='.$Itemid.'&#34; title=&#34;'.$jconfig->sitename.'&#34;>'.$jconfig->sitename.'</a></center></div>';
			}

			return $code;
	}
    /**
     * Prepares the third party video embed code
     *
     * @param string $option  the $video_id output containing video paramters
     * @param int    $vid  the video database id
     * @param int    $Itemid  the joomla menu id
     * @return       $code   the full third party thumbnail image tag
     */
	function veohComPrepareFlvURL($option)
	{
			$truepath = '';
			return $truepath;
	}
?>