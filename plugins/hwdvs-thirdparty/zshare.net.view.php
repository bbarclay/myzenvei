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
    function zshareNetPrepareVideo($row, $flv_width=null, $flv_height=null)
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
			$truepath = zshareNetPrepareFlvURL($row->video_id);
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
					$code.= $player->prepareEmbeddedPlayer($flv_tracks, $flv_width, $flv_height, rand(100, 999), "playlist", null, null, $autostart);
					return $code;

				} else {

					$xspf_playlist = JPATH_SITE.DS.'components'.DS.'com_hwdvideoshare'.DS.'xml'.DS.'xspf'.DS.$row->id.'.xml';
					@unlink($xspf_playlist);
					require_once(JPATH_SITE.DS.'administrator'.DS.'components'.DS.'com_hwdrevenuemanager'.DS.'redrawplaylist.class.php');
					hwd_rm_playlist::writeFile($row, $truepath, $pre_url, $post_url, $thumb_url);

					if (file_exists($xspf_playlist)) {
						$flv_url = JURI::root(true)."/components/com_hwdvideoshare/xml/xspf/".$row->id.".xml";
						$flv_path = JPATH_SITE.DS.'components'.DS.'com_hwdvideoshare'.DS.'xml'.DS.'xspf'.DS.$row->id.'.xml';

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
				$code.= $player->prepareplayer($truepath, $flv_width, $flv_height, rand(100, 999), "youtube", null, $thumb_url, $autostart);
			} else {
				$code.= $player->prepareEmbeddedPlayer($truepath, $flv_width, $flv_height, rand(100, 999), "youtube", null, $thumb_url, $autostart);
			}

			return $code;

		} else {

			if ($flv_width==null) {
				$smartyvs->assign("player_width", $c->flvplay_width);
				$flv_width = $c->flvplay_width."px";
			} else {
				$smartyvs->assign("player_width", $flv_width);
				if (preg_match("/%/", $flv_width)) {
					$flv_width = $flv_width;
				} else {
					$flv_width = $flv_width."px";
				}
			}
			if ($flv_height==null) {
				$flv_height = intval ($flv_width*$c->var_fb);
				$flv_height = $flv_height+25;
				$flv_height = $flv_height."px";
			} else {
				if (preg_match("/%/", $flv_height)) {
					$flv_height = $flv_height;
				} else {
					$flv_height = $flv_height."px";
				}
			}

			if (function_exists('curl_init')) {
				// get title with CURL
				$curl_handle=curl_init();
				curl_setopt($curl_handle,CURLOPT_URL,"http://www.zshare.net/video/".$videocode);
				curl_setopt($curl_handle,CURLOPT_CONNECTTIMEOUT,2);
				curl_setopt($curl_handle,CURLOPT_RETURNTRANSFER,1);
				$buffer = curl_exec($curl_handle);
				curl_close($curl_handle);

				if (!empty($buffer)) {

					$pos = strpos($buffer, '<iframe src="')+13;
					$post = strpos($buffer, '" height=', $pos);
					$frame = substr($buffer, $pos, $post-$pos);
					$frame = trim($frame);
					$frame = str_replace("&iframewidth=530&iframeheight=435&width=480&height=385", "", $frame);
					$frame = str_replace(" ", "%20", $frame);

					$code = '<iframe frameborder="0" marginwidth="0" marginheight="0" scrolling="no" width="'.$flv_width.'" height="400" src="'.$frame.'"></IFRAME>';
					return $code;

				}

			}

		}

		return _HWDVIDS_ZSHAREWF;
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
	function zshareNetPrepareThumb($option, $vid, $Itemid, $k, $width=null, $height=null, $class=null, $tooltip_data=null)
	{
		if (!isset($width)) {
			$width = $c->thumbwidth;
		}
		if (!isset($height)) {
			$height = $width*$c->tar_fb;
		}

		$code = "<img src=\"".zshareNetPrepareThumbURL($option, $vid)."\" border=\"0\" width=\"".$width."\" height=\"".$height."\" title=\"".$tooltip_data[1]." :: ".$tooltip_data[2]."\" class=\"".$class."\" />";
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
	function zshareNetPrepareThumbURL($option, $vid)
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
	function zshareNetPrepareVideoURL($option)
	{
			if (@explode(",", $option)) {
				$data = explode(",", $option);
				$videocode = $data[0];
			} else { $videocode = "ERROR"; }

			$code = "http://www.zshare.net/video/".$videocode;
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
	function zshareNetPrepareVideoEmbed($option, $vid, $Itemid)
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
			$code = "";
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
	function zshareNetPrepareFlvURL($option)
	{
		global $mosConfig_sitename, $mosConfig_live_site;
		$c = hwd_vs_Config::get_instance();

		if (@explode(",", $option)) {
			$data = explode(",", $option);
			$videocode = $data[0];
		} else { $videocode = "ERROR"; }

		$truepath=null;

		if (function_exists('curl_init')) {
			// get title with CURL
			$curl_handle=curl_init();
			curl_setopt($curl_handle,CURLOPT_URL,"http://www.zshare.net/video/".$data[0]);
			curl_setopt($curl_handle,CURLOPT_CONNECTTIMEOUT,2);
			curl_setopt($curl_handle,CURLOPT_RETURNTRANSFER,1);
			$buffer = curl_exec($curl_handle);
			curl_close($curl_handle);

			if (!empty($buffer)) {

				$pos = strpos($buffer, '<iframe src="')+13;
				$post = strpos($buffer, '" height=', $pos);
				$frame = substr($buffer, $pos, $post-$pos);
				$frame = trim($frame);
				$frame = str_replace("&iframewidth=530&iframeheight=435&width=480&height=385", "", $frame);
				$frame = str_replace(" ", "%20", $frame);

			}
		}

		if (function_exists('curl_init')) {
			// get title with CURL
			$curl_handle=curl_init();
			curl_setopt($curl_handle,CURLOPT_URL,$frame);
			curl_setopt($curl_handle,CURLOPT_CONNECTTIMEOUT,2);
			curl_setopt($curl_handle,CURLOPT_RETURNTRANSFER,1);
			$buffer = curl_exec($curl_handle);
			curl_close($curl_handle);

			if (!empty($buffer)) {

				$pos = strpos($buffer, "filename=")+9;
				$post = strpos($buffer, "&fileid=", $pos);
				$file_name = substr($buffer, $pos, $post-$pos);

				$post = $post+8;
				$pos = strpos($buffer, "&serverid=", $post);
				$file_id = substr($buffer, $post, $pos-$post);

				$pos = $pos+10;
				$post = strpos($buffer, "&datetime=", $pos);
				$server_id = substr($buffer, $pos, $post-$pos);

				$post = $post+10;
				$pos = strpos($buffer, "&hash=", $post);
				$date_time = substr($buffer, $post, $pos-$post);

				$pos = $pos+6;
				$post = strpos($buffer, "&hnic=", $pos);
				$hash_string = substr($buffer, $pos, $post-$pos);

				$post = $post+6;
				$pos = strpos($buffer, "&player_width=", $post);
				$hnic = substr($buffer, $post, $pos-$post);

				$hash_password = "NuKanNiemandMeerKijken";

				$file_name = str_replace(" ", "%20", $file_name);
				//$flvlink = "http://" . $server_id . ".zshare.net/stream/" . $hash_string . "/" . $file_id . "/" . $date_time . "/" . $file_name . "/" . md5($file_name . $hash_password) ."/". $hnic;
				$truepath = "http://" . $server_id . ".zshare.net/download/" . $hash_string . "/" . $date_time . "/" . $file_id . "/" . $file_name;
				//http://dl024.zshare.net/download/1245e9dd66cca56a588897bf71c0d626/1245403078/58839879/101%20-%20Death%20Has%20A%20Shadow.avi.flv
				//http://dl048.zshare.net/download/6ecf6abbb38fcd2b92829d24dabe73a0/52778044/1245403208/Charming Leah Dizon.flv

			}
		}

		$filegrab = @file_get_contents($truepath, null, null, 0, 64);

		if (function_exists('stripos')) {
			$filecheck = @stripos($filegrab, "flv");
		} else {
			$filecheck = @strpos($filegrab, "flv");
		}

		if (isset($truepath) && !empty($truepath) && $filecheck !== false) {
			return urlencode( $truepath );
		}

		return null;
	}
?>
