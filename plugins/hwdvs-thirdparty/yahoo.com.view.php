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
     * @param string $row  the $video_id output containing video paramters
     * @param int    $flv_width  the video width
     * @param int    $flv_height  the video height
     * @return       $code   the third party embed code
     */
    function yahooComPrepareVideo($row, $flv_width=null, $flv_height=null)
	{
		global $show_video_ad, $pre_url, $post_url, $smartyvs, $task;
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
				$truepath = yahooComPrepareFlvURL($row->video_id);
			} else {
				$truepath = '';
			}

			$thumb_url = (!empty($row->thumbnail) ? $row->thumbnail : $data[1]);

			if (!empty($truepath) && $c->playlocal == "1") {

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
					$flv_height = $flv_height."px";
				} else {
					if (preg_match("/%/", $flv_height)) {
						$flv_height = $flv_height;
					} else {
						$flv_height = $flv_height."px";
					}
				}

				$id = null;
				$vid = $videocode;
				$jpeg = null;
				$ap = null;

				$watchvideourl = "http://video.yahoo.com/watch/".$videocode;
				$watchvideourl = hwd_vs_tools::get_final_url( $watchvideourl );

				$thumbnail = '';
				if (function_exists('curl_init')) {
					// get title with CURL
					$curl_handle=curl_init();
					curl_setopt($curl_handle,CURLOPT_URL,$watchvideourl);
					curl_setopt($curl_handle,CURLOPT_CONNECTTIMEOUT,2);
					curl_setopt($curl_handle,CURLOPT_RETURNTRANSFER,1);
					$buffer = curl_exec($curl_handle);
					curl_close($curl_handle);

					if (!empty($buffer)) {

						preg_match('/<link rel="video_src" href="([^"]+)/', $buffer, $match);
						if (!empty($match[1])) {
							$video_src = $match[1];
							$data = explode("&id=", $video_src);
						}

					}
				}

				$code = "<object width=\"".$flv_width."\" height=\"".$flv_height."\"><param name=\"movie\" value=\"".$data[0]."\" /><param name=\"allowFullScreen\" value=\"true\" /><param name=\"AllowScriptAccess\" VALUE=\"always\" /><param name=\"bgcolor\" value=\"#000000\" /><param name=\"flashVars\" value=\"id=".$data[1]."&embed=1\" /><embed src=\"".$data[0]."\" type=\"application/x-shockwave-flash\" width=\"".$flv_width."\" height=\"".$flv_height."\" allowFullScreen=\"true\" AllowScriptAccess=\"always\" bgcolor=\"#000000\" flashVars=\"id=".$data[1]."&embed=1\" ></embed></object>";

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
	function yahooComPrepareThumb($option, $vid, $Itemid, $k, $width=null, $height=null, $class=null, $tooltip_data=null)
	{
		if (!isset($width)) {
			$width = $c->thumbwidth;
		}
		if (!isset($height)) {
			$height = $width*$c->tar_fb;
		}

		$code = "<img src=\"".yahooComPrepareThumbURL($option, $vid)."\" border=\"0\" width=\"".$width."\" height=\"".$height."\" title=\"".$tooltip_data[1]." :: ".$tooltip_data[2]."\" class=\"".$class."\" />";
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
	function yahooComPrepareThumbURL($option, $vid)
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
	function yahooComPrepareVideoURL($option)
	{
			if (@explode(",", $option)) {
				$data = explode(",", $option);
				$videocode = $data[0];
			} else { $videocode = "ERROR"; }

			$code = "http://video.yahoo.com/watch/".$videocode;
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
	function yahooComPrepareVideoEmbed($option, $vid, $Itemid)
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
			$code.= "";
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
	function yahooComPrepareFlvURL($option)
	{
		global $mosConfig_sitename, $mosConfig_live_site;
		$c = hwd_vs_Config::get_instance();

		$truepath = '';
		return $truepath;

	}
?>