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
    function breakComPrepareVideo($row, $flv_width=null, $flv_height=null)
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
				$truepath = breakComPrepareFlvURL($row->video_id);
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

				$code = "<object width=\"".$flv_width."\" height=\"".$flv_height."\"><param name=\"movie\" value=\"http://embed.break.com/".$videocode."\"></param><param name=\"allowScriptAccess\" value=\"always\"></param><embed src=\"http://embed.break.com/".$videocode."\" type=\"application/x-shockwave-flash\" allowScriptAccess=\"always\" width=\"".$flv_width."\" height=\"".$flv_height."\"></embed></object>";
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
	function breakComPrepareThumb($option, $vid, $Itemid, $k, $width=null, $height=null, $class=null, $tooltip_data=null)
	{
		if (!isset($width)) {
			$width = $c->thumbwidth;
		}
		if (!isset($height)) {
			$height = $width*$c->tar_fb;
		}

		$code = "<img src=\"".breakComPrepareThumbURL($option, $vid)."\" border=\"0\" width=\"".$width."\" height=\"".$height."\" title=\"".$tooltip_data[1]." :: ".$tooltip_data[2]."\" class=\"".$class."\" />";
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
	function breakComPrepareThumbURL($option, $vid)
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
	function breakComPrepareVideoURL($option)
	{
			if (@explode(",", $option)) {
				$data = explode(",", $option);
				$videocode = $data[2];
			} else { $videocode = "ERROR"; }

			$code = $data[2];
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
	function breakComPrepareVideoEmbed($option, $vid, $Itemid)
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
	function breakComPrepareFlvURL($option)
	{
		global $mosConfig_sitename, $mosConfig_live_site;
		$c = hwd_vs_Config::get_instance();

		$truepath = '';
		return $truepath;

	}
?>