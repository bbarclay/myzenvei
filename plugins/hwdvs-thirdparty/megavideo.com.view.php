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
    function megavideoComPrepareVideo($row, $flv_width=null, $flv_height=null)
	{
		global $mosConfig_live_site, $smartyvs;
		if (!defined('HWDVIDSPATH')) { define('HWDVIDSPATH', dirname(__FILE__).'/../../'); }
		$c = hwd_vs_Config::get_instance();

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

			if (@explode(",", $row->video_id)) {
				$data = explode(",", $row->video_id);
				$videocode = $data[0];
			} else { $videocode = "ERROR"; }

			$code=null;

			$truepath='';
			if (!empty($truepath)) {
				require_once(HWDVIDSPATH.'/../../hwdvideos/plugin/videoplayer/'.$c->hwdvids_videoplayer_path.'/view.'.$c->hwdvids_videoplayer_file.'.php');
				$player = new hwd_vs_videoplayer();
				$code.= $player->prepareplayer($truepath, $flv_width, $flv_height);

				return $code;
			} else {

				$code = '<object width="'.$flv_width.'" height="'.$flv_height.'"><param name="movie" value="http://www.megavideo.com/v/'.$videocode.'"></param><param name="allowFullScreen" value="true"></param><embed src="http://www.megavideo.com/v/'.$videocode.'" type="application/x-shockwave-flash" allowfullscreen="true" width="'.$flv_width.'" height="'.$flv_height.'"></embed></object>';
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
	function megavideoComPrepareThumb($option, $vid, $Itemid, $k, $width=null, $height=null, $class=null, $tooltip_data=null)
	{
		if (!isset($width)) {
			$width = $c->thumbwidth;
		}
		if (!isset($height)) {
			$height = $width*$c->tar_fb;
		}

		$code = "<img src=\"".megavideoComPrepareThumbURL($option, $vid)."\" border=\"0\" width=\"".$width."\" height=\"".$height."\" title=\"".$tooltip_data[1]." :: ".$tooltip_data[2]."\" class=\"".$class."\" />";
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
	function megavideoComPrepareThumbURL($option, $vid)
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
	function megavideoComPrepareVideoURL($option)
	{
			if (@explode(",", $option)) {
				$data = explode(",", $option);
				$videocode = $data[0];
			} else { $videocode = "ERROR"; }

			$code = "http://www.megavideo.com/?v=".substr($videocode, 0, 8);
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
	function megavideoComPrepareVideoEmbed($option, $vid, $Itemid)
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
			$code = "<object width=&#34;640&#34; height=&#34;522&#34;><param name=&#34;movie&#34; value=&#34;http://www.megavideo.com/v/".$videocode."&#34;></param><param name=&#34;allowFullScreen&#34; value=&#34;true&#34;></param><embed src=&#34;http://www.megavideo.com/v/".$videocode."&#34; type=&#34;application/x-shockwave-flash&#34; allowfullscreen=&#34;true&#34; width=&#34;640&#34; height=&#34;522&#34;></embed></object>";
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
	function megavideoComPrepareFlvURL($option, $vid, $Itemid)
	{
		global $mosConfig_sitename, $mosConfig_live_site;
		$c = hwd_vs_Config::get_instance();

			$truepath = '';
			return urldecode($truepath);
	}
?>
