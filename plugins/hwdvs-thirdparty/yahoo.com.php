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
class hwd_vs_tp_yahooCom {
    /**
     * Extracts the appropriate third party video code used to generate
     * the player and thumbnail images
     *
     * @param string $option  the 'embed code' input given by user
     * @return       $ext_v_code   the third party video code
     */
	function yahooComProcessCode($raw_code)
	{
		$code = hwd_vs_tp_yahooCom::yahooComGetCode($raw_code);
		if (!empty($code)) {
			$thumbnail = hwd_vs_tp_yahooCom::yahooComGetThumbnail($code);
			$ext_v_code[0] = true;
			$ext_v_code[1] = $code.",".$thumbnail;
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
	function yahooComGetCode($raw_code)
	{
		// check for embed code format
		$pos_u1 = strpos($raw_code, "?v=");
		$pos_u2 = strpos($raw_code, "/watch/");

		if ($pos_u1 === false && $pos_u2 === false) {
			return null;
		} else if ($pos_u1) {
			$pos_u1_start = $pos_u1 + 3;

			$pos_end = strpos($raw_code, "&", $pos_u1_start);
			if ($pos_end === false) {
				$code = substr($raw_code, $pos_u1_start);
				$code = preg_replace("/[^0-9]/", "", $code);
			} else {
				$length = $pos_end - $pos_u1_start;
				$code = substr($raw_code, $pos_u1_start, $length);
				$code = preg_replace("/[^0-9]/", "", $code);
			}
		} else if ($pos_u2) {
			$pos_u2_start = $pos_u2 + 7;

			$pos_end = strpos($raw_code, "/", $pos_u2_start);
			if ($pos_end === false) {
				$code = substr($raw_code, $pos_u2_start);
				$code = preg_replace("/[^0-9]/", "", $code);
			} else {
				$length = $pos_end - $pos_u2_start;
				$code = substr($raw_code, $pos_u2_start, $length);
				$code = preg_replace("/[^0-9]/", "", $code);
			}
		}
		return $code;
	}
    /**
     * Extracts the appropriate third party video code used to generate
     * the player and thumbnail images
     *
     * @param string $raw_code  the 'embed code' input given by user
     * @return       $ext_v_code   the third party video code
     */
	function yahooComGetThumbnail($code)
	{
		$watchvideourl = "http://video.yahoo.com/watch/".$code;
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

				preg_match('/"thumbUrl", "([^"]+)/',$buffer,$match_array);
				$thumbnail = $match_array[1];
				$thumbnail = str_replace('amp;','',$thumbnail);

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
	function yahooComProcessTitle($raw_code, $processed_code=null)
	{
		$c = hwd_vs_Config::get_instance();

		if (empty($processed_code)) {
			$code = hwd_vs_tp_yahooCom::yahooComGetCode($raw_code);
		} else {
			$code = $processed_code;
		}

		$watchvideourl = "http://video.yahoo.com/watch/".$code;
		$watchvideourl = hwd_vs_tools::get_final_url( $watchvideourl );

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

				preg_match('/<meta name="title" content="([^"]+)/',$buffer,$match_array);
				if (!empty($match_array[1])) {
					$ext_v_title[0] = 1;
					$ext_v_title[1] = $match_array[1];
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
	function yahooComProcessDescription($raw_code, $processed_code=null)
	{
		$c = hwd_vs_Config::get_instance();

		if (empty($processed_code)) {
			$code = hwd_vs_tp_yahooCom::yahooComGetCode($raw_code);
		} else {
			$code = $processed_code;
		}

		$watchvideourl = "http://video.yahoo.com/watch/".$code;
		$watchvideourl = hwd_vs_tools::get_final_url( $watchvideourl );

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
	function yahooComProcessKeywords($raw_code, $processed_code=null)
	{
		$c = hwd_vs_Config::get_instance();

		if (empty($processed_code)) {
			$code = hwd_vs_tp_yahooCom::yahooComGetCode($raw_code);
		} else {
			$code = $processed_code;
		}

		$watchvideourl = "http://video.yahoo.com/watch/".$code;
		$watchvideourl = hwd_vs_tools::get_final_url( $watchvideourl );

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

				preg_match('/<meta name="description" content="([^"]+)/',$buffer,$match_array);
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
	function yahooComProcessDuration($raw_code, $processed_code=null)
	{
		$c = hwd_vs_Config::get_instance();

		if (empty($processed_code)) {
			$code = hwd_vs_tp_yahooCom::yahooComGetCode($raw_code);
		} else {
			$code = $processed_code;
		}

		$watchvideourl = "http://video.yahoo.com/watch/".$code;
		$watchvideourl = hwd_vs_tools::get_final_url( $watchvideourl );

		$ext_v_durat    = array();
		$ext_v_durat[0] = "";
		$ext_v_durat[1] = "";

		if (function_exists('curl_init')) {
			// get title with CURL
			$curl_handle=curl_init();
			curl_setopt($curl_handle,CURLOPT_URL,$watchvideourl);
			curl_setopt($curl_handle,CURLOPT_CONNECTTIMEOUT,2);
			curl_setopt($curl_handle,CURLOPT_RETURNTRANSFER,1);
			$buffer = curl_exec($curl_handle);
			curl_close($curl_handle);

			if (!empty($buffer)) {

				preg_match('/<div class="tv_vid_fv_vldescRuntime"(.*)?>(.*)?<\/div>/', $buffer, $match_array);
				if (!empty($match_array[0])) {
					$ext_v_durat[0] = 1;
					$ext_v_durat[1] = $match_array[0];
					$ext_v_durat[1] = str_replace("(", "", $ext_v_durat[1]);
					$ext_v_durat[1] = str_replace(")", "", $ext_v_durat[1]);
				}
			}
		}

		if ($ext_v_durat[0] == '1') {
			if ($ext_v_durat[1] == '') {
				$ext_v_durat[1] = "0:00:00";
			}
		} else {
			$ext_v_durat[0] = 0;
			$ext_v_durat[1] = "0:00:00";
		}

		return $ext_v_durat;
	}
}
?>