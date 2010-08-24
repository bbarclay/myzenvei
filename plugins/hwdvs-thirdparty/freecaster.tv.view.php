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
    function freecasterTvPrepareVideo($row, $flv_width=null, $flv_height=null, $autostart=null)
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
				$truepath = freecasterTvPrepareFlvURL($row->video_id);
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
					$smartyvs->assign("player_width", $c->flvplay_width);
					$flv_width = $c->flvplay_width;
				} else {
					$smartyvs->assign("player_width", $flv_width);
					$flv_width = $flv_width;
				}
				if ($flv_height==null) {
					$flv_height = intval (($c->flvplay_width * $c->var_fb) + 27);
				} else {
					$flv_height = $flv_height;
				}

				$url = "http://freecaster.tv/".$data[0];

				if (function_exists('curl_init')) {
					// get thumbnail URL with CURL
					$curl_handle=curl_init();
					curl_setopt($curl_handle,CURLOPT_URL,$url);
					curl_setopt($curl_handle,CURLOPT_CONNECTTIMEOUT,2);
					curl_setopt($curl_handle,CURLOPT_RETURNTRANSFER,1);
					$buffer = curl_exec($curl_handle);
					curl_close($curl_handle);

					if (empty($buffer))	{
						$code = "";
					} else {
						preg_match('/<link rel="video_src" type="" href="([^"]+)/', $buffer, $match);
					}
				}

				if ($match[1]) {
					$split = explode("id=", $match[1]);
					$trim = explode("&", $split[1]);
					$code = $trim[0];
				}

				$code = '<object width="'.$flv_width.'" height="'.$flv_height.'"><param name="movie" value="http://play.freecaster.com/player/FCPlayer.swf?id='.$code.'"/><param name="allowscriptaccess" value="always" /><embed src="http://play.freecaster.com/player/FCPlayer.swf?id='.$code.'" width="'.$flv_width.'" height="'.$flv_height.'" type="application/x-shockwave-flash" allowFullScreen="true" allowscriptaccess="always" /></object>';
				return $code;
			}
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
	function freecasterTvPrepareThumb($option, $vid, $Itemid, $k, $width=null, $height=null, $class=null, $tooltip_data=null)
	{
		if (!isset($width)) {
			$width = $c->thumbwidth;
		}
		if (!isset($height)) {
			$height = $width*$c->tar_fb;
		}

		$code = "<img src=&#34;".freecasterTvPrepareThumbURL($option, $vid)."&#34; border=&#34;0&#34; width=&#34;".$width."&#34; height=&#34;".$height."&#34; title=&#34;".$tooltip_data[1]." :: ".$tooltip_data[2]."&#34; class=&#34;".$class."&#34; />";
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
	function freecasterTvPrepareThumbURL($option, $vid)
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
	function freecasterTvPrepareVideoURL($option)
	{
			$data = explode(",", $option);

			$code = "http://freecaster.tv/".$data[0];
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
	function freecasterTvPrepareVideoEmbed($option, $vid, $Itemid)
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
			$code = "<object width=&#34;480&#34; height=&#34;290&#34;><param name=&#34;movie&#34; value=&#34;http://play.freecaster.com/player/FCPlayer.swf?id=".$code."&#34;/><param name=&#34;allowscriptaccess&#34; value=&#34;always&#34; /><embed src=&#34;http://play.freecaster.com/player/FCPlayer.swf?id=".$code."&#34; width=&#34;480&#34; height=&#34;290&#34; type=&#34;application/x-shockwave-flash&#34; allowFullScreen=&#34;true&#34; allowscriptaccess=&#34;always&#34; /></object>";
			if ($c->embedreturnlink == 1) {
				$jconfig = new jconfig();
				$code.='<br /><a href=&#34;'.JURI::root().'index.php?option=com_hwdvideoshare&Itemid='.$Itemid.'&#34; title=&#34;'.$jconfig->sitename.'&#34;>'.$jconfig->sitename.'</a></center></div>';
			}

			return $code;
	}
    /**
     * Prepares the real flv url
     *
     * @param string $option  the $video_id output containing video paramters
     * @param int    $vid  the video database id
     * @param int    $Itemid  the joomla menu id
     * @return       $code   the full third party thumbnail image tag
     */
	function freecasterTvPrepareFlvURL($option)
	{
		$truepath = "";
		return $truepath;
	}
?>
