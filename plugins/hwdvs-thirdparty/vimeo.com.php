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
class hwd_vs_tp_VimeoCom {
    /**
     * Extracts the appropriate third party video code used to generate
     * the player and thumbnail images
     *
     * @param string $option  the 'embed code' input given by user
     * @return       $ext_v_code   the third party video code
     */
	function VimeoComProcessCode($option)
	{
		$code = hwd_vs_tp_VimeoCom::VimeoComGetCode($option);

		if (!empty($code)) {
			$thumbnail = hwd_vs_tp_VimeoCom::VimeoComGetThumbnail($code);
			$ext_v_code[0] = true;
			$ext_v_code[1] = $code.",".$thumbnail;

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
	function VimeoComGetCode($option)
	{
		// check for embed code format
		$pos_e = strpos($option, "vimeo.com/moogaloop.swf?clip_id=");
		$pos_u = strpos($option, "/videos/");
		$pos_u_b = strpos($option, "vimeo.com");

		if (($pos_e === false) && ($pos_u === false) && ($pos_u_b === false)) {
			return null;
		} else if ($pos_e) {
			$pos_e_start = $pos_e + 32;
			$pos_e_end = strpos($option, '&amp;');
			if ($pos_e_end === false) {
				$pos_u_end = strpos($option, '"');
				if ($pos_u_end === false) { return null; }
			}
			$length = $pos_e_end - $pos_e_start;

			$code = substr($option, $pos_e_start, $length);
			$code = strip_tags($code);
			$code = preg_replace("/[^a-zA-Z0-9s_-]/", "", $code);
		} else if ($pos_u) {
			$pos_u_start = $pos_u + 8;
			$pos_u_end = strpos($option, '/', $pos_u_start);
			if ($pos_u_end === false) {
				$code = substr($option, $pos_u_start);
				$code = strip_tags($code);
				$code = preg_replace("/[^a-zA-Z0-9s_-]/", "", $code);
			} else {
				$length = $pos_u_end - $pos_u_start;
				$code = substr($option, $pos_u_start, $length);
				$code = strip_tags($code);
				$code = preg_replace("/[^a-zA-Z0-9s_-]/", "", $code);
			}
		} else if ($pos_u_b) {
			$pos_u_b_start = $pos_u_b + 10;
			$pos_u_b_end = strpos($option, '/', $pos_u_b_start);
			if ($pos_u_b_end === false) {
				$code = substr($option, $pos_u_b_start);
				$code = strip_tags($code);
				$code = preg_replace("/[^a-zA-Z0-9s_-]/", "", $code);
			} else {
				$length = $pos_u_b_end - $pos_u_b_start;
				$code = substr($option, $pos_u_b_start, $length);
				$code = strip_tags($code);
				$code = preg_replace("/[^a-zA-Z0-9s_-]/", "", $code);
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
	function VimeoComGetThumbnail($option)
	{
		$api_url = "http://vimeo.com/api/v2/video/".$option.".output";

		if (function_exists('curl_init')) {
			// get thumbnail URL with CURL
			$curl_handle=curl_init();
			curl_setopt($curl_handle,CURLOPT_URL,"http://vimeo.com/api/clip/".$option."/php/");
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
				$thumbnail = "";
			} else {
				//$pos_thumb_search = strpos($buffer, "thumbnail_large");
				$pos_thumb_search = strpos($buffer, "thumbnail_medium");

				if ($pos_thumb_search === false) {
					return null;
				} else {
					$pos_thumb_start = strpos($buffer, "http", $pos_thumb_search);
					$pos_thumb_end = strpos($buffer, '.jpg', $pos_thumb_start);
					if ($pos_thumb_end === false) {
						return null;
					} else {
						$length = $pos_thumb_end+4 - $pos_thumb_start;
						$thumbnail = substr($buffer, $pos_thumb_start, $length);
						$thumbnail = strip_tags($thumbnail);
						//$thumbnail = preg_replace("/[^a-zA-Z0-9s_-]/", "", $thumbnail);
					}
				}
			}
		} else {
			$thumbnail = "";
		}
		$thumbnail = trim(strip_tags($thumbnail));
		return $thumbnail;
	}
    /**
     * Extracts the title of the third party video
     *
     * @param string $option  the 'embed code' input given by user
     * @return       $ext_v_title   the third party video title
     */
	function VimeoComProcessTitle($option)
	{
		if (!defined('HWDVIDSPATH')) { define('HWDVIDSPATH', dirname(__FILE__).'/../../'); }
		$c = hwd_vs_Config::get_instance();

		$code = hwd_vs_tp_VimeoCom::VimeoComGetCode($option);
		$watchvideourl = "http://www.vimeo.com/".$code;

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
	function VimeoComProcessDescription($option)
	{
		if (!defined('HWDVIDSPATH')) { define('HWDVIDSPATH', dirname(__FILE__).'/../../'); }
		$c = hwd_vs_Config::get_instance();

		$code = hwd_vs_tp_VimeoCom::VimeoComGetCode($option);
		$watchvideourl = "http://www.vimeo.com/".$code;

		if (function_exists('curl_init')) {
			// get title with CURL
			$curl_handle=curl_init();
			curl_setopt($curl_handle,CURLOPT_URL,$watchvideourl);
			curl_setopt($curl_handle,CURLOPT_CONNECTTIMEOUT,2);
			curl_setopt($curl_handle,CURLOPT_RETURNTRANSFER,1);
			$buffer = curl_exec($curl_handle);
			curl_close($curl_handle);

			if (!empty($buffer)) {

				preg_match('/<meta name="description" content="([^"]+)/', $buffer, $match);
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
	function VimeoComProcessKeywords($option)
	{
		if (!defined('HWDVIDSPATH')) { define('HWDVIDSPATH', dirname(__FILE__).'/../../'); }
		$c = hwd_vs_Config::get_instance();

		$code = hwd_vs_tp_VimeoCom::VimeoComGetCode($option);
		$watchvideourl = "http://www.vimeo.com/".$code;

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
	function VimeoComProcessDuration($option)
	{
		if (!defined('HWDVIDSPATH')) { define('HWDVIDSPATH', dirname(__FILE__).'/../../'); }
		$c = hwd_vs_Config::get_instance();

		$ext_v_durat[0] = 0;
		$ext_v_durat[1] = "0:00:00";
		return $ext_v_durat;
	}
}
?>