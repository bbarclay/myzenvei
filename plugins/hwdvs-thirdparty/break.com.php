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
class hwd_vs_tp_breakCom {
    /**
     * Extracts the appropriate third party video code used to generate
     * the player and thumbnail images
     *
     * @param string $option  the 'embed code' input given by user
     * @return       $ext_v_code   the third party video code
     */
	function breakComProcessCode($raw_code)
	{
		$code = hwd_vs_tp_breakCom::breakComGetCode($raw_code);
		if (!empty($code)) {
			$thumbnail = hwd_vs_tp_breakCom::breakComGetThumbnail($code);
			$ext_v_code[0] = true;
			$ext_v_code[1] = $code[0].",".$thumbnail.",".$code[1];
			$ext_v_code[2] = $code;
		} else {
			$ext_v_code[0] = false;
			$ext_v_code[1] = "";
			$ext_v_code[2] = "";
		}
		return $ext_v_code;
	}
    /**
     * Extracts the appropriate third party video code used to generate
     * the player and thumbnail images
     *
     * @param string $raw_code  the 'embed code' input given by user
     * @return       $ext_v_code   the third party video code
     */
	function breakComGetCode($raw_code)
	{
		$pos = strpos($raw_code, "break.com");
		$code = array();

		if ($pos === false) {

			return null;

		} else if ($pos) {

			$url = "http://www.break.com".parse_url($raw_code, PHP_URL_PATH);
			$url = hwd_vs_tools::get_final_url( $url );

			if (function_exists('curl_init')) {
				// get thumbnail URL with CURL
				$curl_handle=curl_init();
				curl_setopt($curl_handle,CURLOPT_URL,$url);
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
					$code = "";
				} else {

					$pos_e_search = strpos($buffer, "http://embed.break.com/");

					if ($pos_e_search === false) {

						return null;

					} else if ($pos_e_search) {

						$pos_e_start = $pos_e_search+23;
						$pos_e_end = strpos($buffer, '"', $pos_e_start);
						if ($pos_e_end === false) {
							return null;
						}
						$length = $pos_e_end - $pos_e_start;

						$code[0] = substr($buffer, $pos_e_start, $length);
						$code[0] = preg_replace("/[^0-9]/", "", $code[0]);

					}
				}
			} else {
				$code[0] = "";
			}
		}
		$code[1] = $url;
		return $code;
	}
    /**
     * Extracts the appropriate third party video code used to generate
     * the player and thumbnail images
     *
     * @param string $raw_code  the 'embed code' input given by user
     * @return       $ext_v_code   the third party video code
     */
	function breakComGetThumbnail($code)
	{
		$url = $code[1];

		if (!empty($url)) {

			if (function_exists('curl_init')) {
				// get thumbnail URL with CURL
				$curl_handle=curl_init();
				curl_setopt($curl_handle,CURLOPT_URL,$url);
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
					$code = "";
				} else {

					preg_match('/<meta name="embed_video_thumb_url" content="([^"]+)/',$buffer,$thumbnail_array);
					$thumbnail = $thumbnail_array[1];
					$thumbnail = str_replace('amp;','',$thumbnail);

				}
			} else {

				$thumbnail = "";

			}
		}
		return $thumbnail;
	}
    /**
     * Extracts the title of the third party video
     *
     * @param string $raw_code  the 'embed code' input given by user
     * @return       $ext_v_title   the third party video title
     */
	function breakComProcessTitle($raw_code, $processed_code=null)
	{
		$c = hwd_vs_Config::get_instance();

		if (empty($processed_code)) {
			$code = hwd_vs_tp_breakCom::breakComGetCode($raw_code);
		} else {
			$code = $processed_code;
		}

		$watchvideourl = $code[1];

		$ext_v_title    = array();
		$ext_v_title[0] = "";
		$ext_v_title[1] = "";

		if (function_exists('curl_init')) {
			// get title with CURL
			$curl_handle=curl_init();
			curl_setopt($curl_handle,CURLOPT_URL,$watchvideourl);
			curl_setopt($curl_handle,CURLOPT_CONNECTTIMEOUT,2);
			curl_setopt($curl_handle,CURLOPT_RETURNTRANSFER,1);
			$buffer = curl_exec($curl_handle);
			curl_close($curl_handle);

			if (!empty($buffer)) {

				preg_match_all('/<title>(.*?)<\/title>/', $buffer, $match);
				if (!empty($match[1][0])) {
					$ext_v_title[0] = 1;
					$ext_v_title[1] = $match[1][0];
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
     * @param string $raw_code  the 'embed code' input given by user
     * @return       $ext_v_title   the third party video description
     */
	function breakComProcessDescription($raw_code, $processed_code=null)
	{
		$c = hwd_vs_Config::get_instance();

		if (empty($processed_code)) {
			$code = hwd_vs_tp_breakCom::breakComGetCode($raw_code);
		} else {
			$code = $processed_code;
		}

		$watchvideourl = $code[1];

		$ext_v_descr    = array();
		$ext_v_descr[0] = "";
		$ext_v_descr[1] = "";

		if (function_exists('curl_init')) {
			// get title with CURL
			$curl_handle=curl_init();
			curl_setopt($curl_handle,CURLOPT_URL,$watchvideourl);
			curl_setopt($curl_handle,CURLOPT_CONNECTTIMEOUT,2);
			curl_setopt($curl_handle,CURLOPT_RETURNTRANSFER,1);
			$buffer = curl_exec($curl_handle);
			curl_close($curl_handle);

			if (!empty($buffer)) {

				preg_match('/<meta name="description" content="([^"]+)/',$buffer,$match_array);
				if (!empty($match_array[1])) {
					$ext_v_descr[0] = 1;
					$ext_v_descr[1] = $match_array[1];
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
     * @param string $raw_code  the 'embed code' input given by user
     * @return       $ext_v_title   the third party video keywords
     */
	function breakComProcessKeywords($raw_code, $processed_code=null)
	{
		$c = hwd_vs_Config::get_instance();

		if (empty($processed_code)) {
			$code = hwd_vs_tp_breakCom::breakComGetCode($raw_code);
		} else {
			$code = $processed_code;
		}

		$watchvideourl = $code[1];

		$ext_v_keywo    = array();
		$ext_v_keywo[0] = "";
		$ext_v_keywo[1] = "";

		if (function_exists('curl_init')) {
			// get title with CURL
			$curl_handle=curl_init();
			curl_setopt($curl_handle,CURLOPT_URL,$watchvideourl);
			curl_setopt($curl_handle,CURLOPT_CONNECTTIMEOUT,2);
			curl_setopt($curl_handle,CURLOPT_RETURNTRANSFER,1);
			$buffer = curl_exec($curl_handle);
			curl_close($curl_handle);

			if (!empty($buffer)) {

				preg_match('/<meta name="keywords" content="([^"]+)/',$buffer,$match_array);
				if (!empty($match_array[1])) {
					$ext_v_keywo[0] = 1;
					$ext_v_keywo[1] = $match_array[1];
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
     * @param string $raw_code  the 'embed code' input given by user
     * @return       $ext_v_title   the third party video duration
     */
	function breakComProcessDuration($raw_code, $processed_code=null)
	{
		$c = hwd_vs_Config::get_instance();

		$ext_v_durat[0] = 0;
		$ext_v_durat[1] = "0:00:00";

		return $ext_v_durat;
	}
}
?>