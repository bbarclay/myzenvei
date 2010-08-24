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
 * @package    hwdVideoShare
 * @author     Dave Horsfall <info@highwooddesign.co.uk>
 * @copyright  2008 Highwood Design
 * @license    http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @version    1.1.4 Alpha RC3.5
 */
class hwd_vs_tp_dailymotionCom {
    /**
     * Extracts the appropriate third party video code used to generate
     * the player and thumbnail images
     *
     * @param string $option  the 'embed code' input given by user
     * @return       $ext_v_code   the third party video code
     */
	function dailymotionComProcessCode($option)
	{
		$code = hwd_vs_tp_dailymotionCom::dailymotionComGetCode($option);
		if (!empty($code[0])) {
			$thumbnail = hwd_vs_tp_dailymotionCom::dailymotionComGetThumbnail($code[0]);
			$ext_v_code[0] = true;
			$ext_v_code[1] = $code[0].",".$thumbnail;
		} else {
			$ext_v_code[0] = false;
			$ext_v_code[1] = "";
		}

		return $ext_v_code;
	}
    /**
     * Extracts the appropriate third party video code used to generate
     * the player and thumbnail images
     *
     * @param string $option  the 'embed code' input given by user
     * @return       $ext_v_code   the third party video code
     */
	function dailymotionComGetCode($option)
	{
		// check for embed code format
		$pos_u = strpos($option, "/video/");
		$code = array();

		if ($pos_u === false) {

			return null;

		} else if ($pos_u) {

			$parsed = parse_url($option);
			$url = "http://www.dailymotion.com".$parsed['path'];
			$url = hwd_vs_tools::get_final_url( $url );

			$pos_http = strpos($url, "http");
			if ($pos_http === false) {
				$url = "http://www.dailymotion.com".$parsed['path'];
			}

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

					$pos_e_search = strpos($buffer, "&lt;div&gt;&lt;object");

					if ($pos_e_search === false) {
						return null;
					} else if ($pos_e_search) {
						$pos_e_start = strpos($buffer, "/swf/", $pos_e_search);
						$pos_e_start = $pos_e_start+5;
						$pos_e_end = strpos($buffer, '&', $pos_e_start);
						if ($pos_e_end === false) {
							$pos_u_end = strpos($option, '"', $pos_e_start);
							if ($pos_u_end === false) { return null; }
						}
						$length = $pos_e_end - $pos_e_start;

						$code[0] = substr($buffer, $pos_e_start, $length);
						$code[0] = strip_tags($code[0]);
						$code[0] = preg_replace("/[^a-zA-Z0-9s_-]/", "", $code[0]);
					}

					$pos_vid_search = strpos($option, '/video/');
					if ($pos_vid_search === false) {
						$code[1] = null;
					} else if ($pos_vid_search) {
						$pos_vid_start = $pos_vid_search+7;
						$pos_vid_end = strpos($option, '_', $pos_vid_start);
						if ($pos_vid_end === false) {
							$code[1] = null;
						}
						$length = $pos_vid_end - $pos_vid_start;

						$code[1] = substr($option, $pos_vid_start, $length);
						$code[1] = strip_tags($code[1]);
						$code[1] = preg_replace("/[^a-zA-Z0-9s_-]/", "", $code[1]);
					}
				}
			} else if (function_exists('get_meta_tags')) {
				$code[0] = "";
			} else {
				$code[0] = "";
			}
		}

		return $code;
	}
    /**
     * Extracts the appropriate third party video code used to generate
     * the player and thumbnail images
     *
     * @param string $option  the 'embed code' input given by user
     * @return       $ext_v_code   the third party video code
     */
	function dailymotionComGetThumbnail($option)
	{
		$thumbnail = "http://www.dailymotion.com/thumbnail/160x120/video/".$option;
		$thumbnail = trim(strip_tags($thumbnail));
		return $thumbnail;
	}
    /**
     * Extracts the title of the third party video
     *
     * @param string $option  the 'embed code' input given by user
     * @return       $ext_v_title   the third party video title
     */
	function dailymotionComProcessTitle($option)
	{
		if (!defined('HWDVIDSPATH')) { define('HWDVIDSPATH', dirname(__FILE__).'/../../'); }
		$c = hwd_vs_Config::get_instance();

		$code = hwd_vs_tp_dailymotionCom::dailymotionComGetCode($option);

		$code = $code[1];

		$watchvideourl = "http://www.dailymotion.com/video/".$code;
		$watchvideourl = hwd_vs_tools::get_final_url( $watchvideourl );

		if (function_exists('curl_init')) {
			// get title with CURL
			$curl_handle=curl_init();
			curl_setopt($curl_handle,CURLOPT_URL,$watchvideourl);
			curl_setopt($curl_handle,CURLOPT_CONNECTTIMEOUT,2);
			curl_setopt($curl_handle,CURLOPT_RETURNTRANSFER,1);
			$buffer = curl_exec($curl_handle);
			curl_close($curl_handle);

			if (!empty($buffer)) {

				preg_match_all('/<title(.*?)>(.*?)<\/title>/', $buffer, $match);
				if (!empty($match[2][0])) {
					$ext_v_title[0] = 1;
					$ext_v_title[1] = $match[2][0];

					$ext_v_title[1] = str_replace("Dailymotion - ", "", $ext_v_title[1]);

					$ext_v_title[1] = strip_tags($ext_v_title[1]);
					$ext_v_title[1] = trim($ext_v_title[1]);
					$ext_v_title[1] = hwdEncoding::XMLEntities($ext_v_title[1]);
					$ext_v_title[1] = hwdEncoding::charset_decode_utf_8($ext_v_title[1]);
					$ext_v_title[1] = addslashes($ext_v_title[1]);
					$ext_v_title[1] = hwd_vs_tools::truncateText($ext_v_title[1], 300);
				}

			}
		}

		if ($ext_v_title[0] == '1') {
			if ($ext_v_title[1] == '') {
				$ext_v_title[1] = _HWDVIDS_UNKNOWN;
			}
		} else {
			$ext_v_title[0] = 0;
			$ext_v_title[1] = _HWDVIDS_UNKNOWN;
		}

		return $ext_v_title;
	}
    /**
     * Extracts the description of the third party video
     *
     * @param string $option  the 'embed code' input given by user
     * @return       $ext_v_title   the third party video description
     */
	function dailymotionComProcessDescription($option)
	{
		if (!defined('HWDVIDSPATH')) { define('HWDVIDSPATH', dirname(__FILE__).'/../../'); }
		$c = hwd_vs_Config::get_instance();

		$code = hwd_vs_tp_dailymotionCom::dailymotionComGetCode($option);
		$code = $code[1];

		$watchvideourl = "http://www.dailymotion.com/video/".$code;
		$watchvideourl = hwd_vs_tools::get_final_url( $watchvideourl );

		if (function_exists('curl_init')) {
			// get title with CURL
			$curl_handle=curl_init();
			curl_setopt($curl_handle,CURLOPT_URL,$watchvideourl);
			curl_setopt($curl_handle,CURLOPT_CONNECTTIMEOUT,2);
			curl_setopt($curl_handle,CURLOPT_RETURNTRANSFER,1);
			$buffer = curl_exec($curl_handle);
			curl_close($curl_handle);

			preg_match('/<meta name="description" lang="([^"]+)/', $buffer, $lang);

			if (!empty($buffer)) {

				preg_match('/<meta name="description" lang="'.$lang[1].'" content="([^"]+)/', $buffer, $match);
				if (!empty($match[1])) {
					$ext_v_descr[0] = 1;
					$ext_v_descr[1] = $match[1];
					$ext_v_descr[1] = strip_tags($ext_v_descr[1]);
					$ext_v_descr[1] = trim($ext_v_descr[1]);
					$ext_v_descr[1] = hwdEncoding::XMLEntities($ext_v_descr[1]);
					$ext_v_descr[1] = hwdEncoding::charset_decode_utf_8($ext_v_descr[1]);
					$ext_v_descr[1] = addslashes($ext_v_descr[1]);
					$ext_v_descr[1] = hwd_vs_tools::truncateText($ext_v_descr[1], 300);
				}
			}
		}

		if ($ext_v_descr[0] == '1') {
			if ($ext_v_descr[1] == '') {
				$ext_v_descr[1] = _HWDVIDS_UNKNOWN;
			}
		} else {
			$ext_v_descr[0] = 0;
			$ext_v_descr[1] = _HWDVIDS_UNKNOWN;
		}

		return $ext_v_descr;
	}
    /**
     * Extracts the keywords of the third party video
     *
     * @param string $option  the 'embed code' input given by user
     * @return       $ext_v_title   the third party video keywords
     */
	function dailymotionComProcessKeywords($option)
	{
		if (!defined('HWDVIDSPATH')) { define('HWDVIDSPATH', dirname(__FILE__).'/../../'); }
		$c = hwd_vs_Config::get_instance();

		$code = hwd_vs_tp_dailymotionCom::dailymotionComGetCode($option);
		$code = $code[1];

		$watchvideourl = "http://www.dailymotion.com/video/".$code;
		$watchvideourl = hwd_vs_tools::get_final_url( $watchvideourl );

		if (function_exists('curl_init')) {
			// get title with CURL
			$curl_handle=curl_init();
			curl_setopt($curl_handle,CURLOPT_URL,$watchvideourl);
			curl_setopt($curl_handle,CURLOPT_CONNECTTIMEOUT,2);
			curl_setopt($curl_handle,CURLOPT_RETURNTRANSFER,1);
			$buffer = curl_exec($curl_handle);
			curl_close($curl_handle);

			if (!empty($buffer)) {

				preg_match('/<meta name="keywords" content="([^"]+)/', $buffer, $match);
				if (!empty($match[1])) {
					$ext_v_keywo[0] = 1;
					$ext_v_keywo[1] = $match[1];
					$ext_v_keywo[1] = strip_tags($ext_v_keywo[1]);
					$ext_v_keywo[1] = trim($ext_v_keywo[1]);
					$ext_v_keywo[1] = hwdEncoding::XMLEntities($ext_v_keywo[1]);
					$ext_v_keywo[1] = hwdEncoding::charset_decode_utf_8($ext_v_keywo[1]);
					$ext_v_keywo[1] = addslashes($ext_v_keywo[1]);
					$ext_v_keywo[1] = hwd_vs_tools::truncateText($ext_v_keywo[1], 300);
				}
			}
		}

		if ($ext_v_keywo[0] == '1') {
			if ($ext_v_keywo[1] == '') {
				$ext_v_keywo[1] = _HWDVIDS_UNKNOWN;
			}
		} else {
			$ext_v_keywo[0] = 0;
			$ext_v_keywo[1] = _HWDVIDS_UNKNOWN;
		}

		return $ext_v_keywo;
	}
    /**
     * Extracts the duration of the third party video
     *
     * @param string $option  the 'embed code' input given by user
     * @return       $ext_v_title   the third party video duration
     */
	function dailymotionComProcessDuration($option)
	{
		if (!defined('HWDVIDSPATH')) { define('HWDVIDSPATH', dirname(__FILE__).'/../../'); }
		$c = hwd_vs_Config::get_instance();

		$code = hwd_vs_tp_dailymotionCom::dailymotionComGetCode($option);
		$code = $code[1];

		$watchvideourl = "http://www.dailymotion.com/video/".$code;
		$watchvideourl = hwd_vs_tools::get_final_url( $watchvideourl );

		if (function_exists('curl_init')) {
			// get title with CURL
			$curl_handle=curl_init();
			curl_setopt($curl_handle,CURLOPT_URL,$watchvideourl);
			curl_setopt($curl_handle,CURLOPT_CONNECTTIMEOUT,2);
			curl_setopt($curl_handle,CURLOPT_RETURNTRANSFER,1);
			$buffer = curl_exec($curl_handle);
			curl_close($curl_handle);

			// check third party encoding and compare to system encoding
			// fix if necessary
			if (function_exists('mb_detect_encoding')) {
				if (mb_detect_encoding($buffer . 'a' , 'UTF-8, ISO-8859-1') == "ISO-8859-1") {
					$buffer = utf8_encode($buffer);
				}
			}

			if (empty($buffer))	{
				$ext_v_durat[0] = 0;
				$ext_v_durat[1] = "0:00:00";
			} else {
				$tagst = strpos($buffer, '&amp;DMDURATION=');
				$tagst = $tagst + 16;
				$tagen = strpos($buffer, '&amp;', $tagst);
				$tagle = $tagen - $tagst;

				if (($tagst === false) || ($tagen === false)) {
					$ext_v_durat[0] = 0;
					$ext_v_durat[1] = "0:00:00";
				} else {
					$tag   = substr($buffer, $tagst, $tagle);
					if ($tag) {
						$ext_v_durat[0] = 1;
						$ext_v_durat[1] = hwd_vs_tools::sec2hms($tag);
					} else {
						$ext_v_durat[0] = 0;
						$ext_v_durat[1] = "0:00:00";
					}
				}
			}
		} else {
			$ext_v_title[0] = 0;
			$ext_v_title[1] = "0:00:00";
		}
		$ext_v_durat[1] = preg_replace("/[^0-9-:]/", "", $ext_v_durat[1]);
		return $ext_v_durat;
	}
}
?>
