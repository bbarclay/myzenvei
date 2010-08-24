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
    function googleCoUKPrepareVideo($row, $flv_width=null, $flv_height=null)
	{
		global $show_video_ad, $smartyvs, $task;
		if (!defined('HWDVIDSPATH')) { define('HWDVIDSPATH', dirname(__FILE__).'/../../'); }
		$c = hwd_vs_Config::get_instance();

			if (@explode(",", $row->video_id)) {
				$data = explode(",", $row->video_id);
				$videocode = $data[0];
			} else { $videocode = "ERROR"; }
			$code=null;

			if ($c->playlocal == "1") {
				$truepath = googleCoUKPrepareFlvURL($row->video_id);
			} else {
				$truepath = '';
			}
			$thumbnail = hwd_vs_tools::get_final_url( $data[1] );

			if (!empty($truepath) && $c->playlocal == "1") {

				$player = new hwd_vs_videoplayer();

				if ($show_video_ad == 1) {
					$xspf_playlist = JPATH_SITE."/components/com_hwdvideoshare/xml/xspf/".$row->id.".xml";
					@unlink($xspf_playlist);
                    require_once(JPATH_SITE.'/administrator/components/com_hwdrevenuemanager/redrawplaylist.class.php');
                    hwd_rm_playlist::writeFile($row, $truepath);

					if (file_exists($xspf_playlist)) {
						$flv_url = JURI::root(true)."/components/com_hwdvideoshare/xml/xspf/".$row->id.".xml";
						$flv_path = HWDVIDSPATH.'/xml/xspf/'.$row->id.'.xml';

						require_once(HWDVIDSPATH.'/../../hwdvideos/plugin/videoplayer/'.$c->hwdvids_videoplayer_path.'/view.'.$c->hwdvids_videoplayer_file.'.php');
						$player = new hwd_vs_videoplayer();

						if ($c->loadswfobject == "on" && $task !=="grabjomsocialplayer") {
							$code.= $player->prepareplayer($flv_url, $flv_width, $flv_height, rand(100, 999), "playlist", $flv_path );
						} else {
							$code.= $player->prepareEmbeddedPlayer($flv_url, $flv_width, $flv_height, "playlist");
						}
						return $code;
					}
				}

				if ($c->loadswfobject == "on") {
					$code.= $player->prepareplayer($truepath, $flv_width, $flv_height, rand(100, 999), "video", null, $thumbnail);
				} else {
					$code.= $player->prepareEmbeddedPlayer($truepath, $flv_width, $flv_height, "remote", $thumbnail);
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

				$code = "<embed id=\"VideoPlayback\" src=\"http://video.google.com/googleplayer.swf?docid=".$videocode."&hl=en&fs=true\" style=\"width:".$flv_width.";height:".$flv_height."\" allowFullScreen=\"true\" allowScriptAccess=\"always\" wmode=\"transparent\" type=\"application/x-shockwave-flash\"></embed>";
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
	function googleCoUKPrepareThumb($option, $vid, $Itemid, $k, $width=null, $height=null, $class=null, $tooltip_data=null)
	{
		if (!isset($width)) {
			$width = $c->thumbwidth;
		}
		if (!isset($height)) {
			$height = $width*$c->tar_fb;
		}

		$code = "<img src=\"".googleCoUKPrepareThumbURL($option, $vid)."\" border=\"0\" width=\"".$width."\" height=\"".$height."\" title=\"".$tooltip_data[1]." :: ".$tooltip_data[2]."\" class=\"".$class."\" />";
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
	function googleCoUKPrepareThumbURL($option, $vid)
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
	function googleCoUKPrepareVideoURL($option)
	{
			if (@explode(",", $option)) {
				$data = explode(",", $option);
				$videocode = $data[0];
			} else { $videocode = "ERROR"; }

			$code = "http://video.google.com/videoplay?docid=".$videocode;
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
	function googleCoUKPrepareVideoEmbed($option, $vid, $Itemid)
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
			$code.= "<embed style=&#34;width:400px; height:326px;&#34; id=&#34;VideoPlayback&#34; type=&#34;application/x-shockwave-flash&#34; src=&#34;http://video.google.com/googleplayer.swf?docId=".$videocode."&hl=en&#34; flashvars=&#34;&#34;> </embed>";
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
	function googleCoUKPrepareFlvURL($option)
	{
		global $mosConfig_sitename, $mosConfig_live_site;
		$c = hwd_vs_Config::get_instance();

			if (@explode(",", $option)) {
				$data = explode(",", $option);
				$videocode = $data[0];
			} else { $videocode = "ERROR"; }
			$code=null;

			$truepath = '';

			$feedurl = "http://video.google.com/videofeed?docid=".$data[0];

			if (function_exists('curl_init')) {
				// get thumbnail URL with CURL
				$curl_handle=curl_init();
				curl_setopt($curl_handle,CURLOPT_URL,$feedurl);
				curl_setopt($curl_handle,CURLOPT_CONNECTTIMEOUT,2);
				curl_setopt($curl_handle,CURLOPT_RETURNTRANSFER,1);
				$buffer = curl_exec($curl_handle);
				curl_close($curl_handle);

				if (empty($buffer))	{
					$truepath = '';
				} else {
					preg_match_all('/<media:content url="([^"]+)/',$buffer,$matches, PREG_PATTERN_ORDER);
					foreach ($matches[1] as $val) {
						if (!is_array($val)) {
							$check = strpos($val, "videoplayback");
							if ($check === false) {
								continue;
							} else {
								$truepath = str_replace('amp;','',$val);
								break;
							}
						}
					}
				}
			}

			if (isset($truepath) && !empty($truepath)) {
				$truepath = hwd_vs_tools::get_final_url( $truepath );
				$truepath = urlencode( $truepath );
			}

			return $truepath;
	}
?>