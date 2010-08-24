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
class hwd_vs_tp_myspaceCom {
    /**
     * Extracts the appropriate third party video code used to generate
     * the player and thumbnail images
     *
     * @param string $option  the 'embed code' input given by user
     * @return       $ext_v_code   the third party video code
     */
	function myspaceComProcessCode($raw_code)
	{
		$code = hwd_vs_tp_myspaceCom::myspaceComGetCode($raw_code);
		if (!empty($code)) {
			$thumbnail = hwd_vs_tp_myspaceCom::myspaceComGetThumbnail($code);
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
	function myspaceComGetCode($raw_code)
	{
		// check for embed code format
		$pos_u = strpos(strtolower($raw_code), "&videoid=");

		if ($pos_u === false) {
			return null;
		} else if ($pos_u) {
			$pos_u_start = $pos_u + 9;
			$code = substr($raw_code, $pos_u_start, 11);
			$code = preg_replace("/[^0-9]/", "", $code);
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
	function myspaceComGetThumbnail($code)
	{
		if (function_exists('curl_init')) {
			// get thumbnail URL with CURL
			$curl_handle=curl_init();
			curl_setopt($curl_handle,CURLOPT_URL,"http://vids.myspace.com/index.cfm?fuseaction=vids.individual&VideoID=".$code);
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
				preg_match('/<link rel="image_src" href="([^"]+)/',$buffer,$thumbnail_array);
				$thumbnail = $thumbnail_array[1];
				$thumbnail = str_replace('amp;','',$thumbnail);
			}
		} else {
			$thumbnail = "";
		}
		$thumbnail = trim($thumbnail);
		return $thumbnail;
	}
    /**
     * Extracts the title of the third party video
     *
     * @param string $raw_code  the 'embed code' input given by user
     * @return       $ext_v_title   the third party video title
     */
	function myspaceComProcessTitle($raw_code, $processed_code=null)
	{
		$c = hwd_vs_Config::get_instance();

		if (empty($processed_code)) {
			$code = hwd_vs_tp_myspaceCom::myspaceComGetCode($raw_code);
		} else {
			$code = $processed_code;
		}

		$watchvideourl = "http://vids.myspace.com/index.cfm?fuseaction=vids.individual&VideoID=".$code;
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
	function myspaceComProcessDescription($raw_code, $processed_code=null)
	{
		$c = hwd_vs_Config::get_instance();

		if (empty($processed_code)) {
			$code = hwd_vs_tp_myspaceCom::myspaceComGetCode($raw_code);
		} else {
			$code = $processed_code;
		}

		$watchvideourl = "http://vids.myspace.com/index.cfm?fuseaction=vids.individual&VideoID=".$code;
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
	function myspaceComProcessKeywords($raw_code, $processed_code=null)
	{
		$c = hwd_vs_Config::get_instance();

		if (empty($processed_code)) {
			$code = hwd_vs_tp_myspaceCom::myspaceComGetCode($raw_code);
		} else {
			$code = $processed_code;
		}

		$watchvideourl = "http://vids.myspace.com/index.cfm?fuseaction=vids.individual&VideoID=".$code;
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
	function myspaceComProcessDuration($raw_code, $processed_code=null)
	{
		$c = hwd_vs_Config::get_instance();

		if (empty($processed_code)) {
			$code = hwd_vs_tp_myspaceCom::myspaceComGetCode($raw_code);
		} else {
			$code = $processed_code;
		}

		$watchvideourl = "http://vids.myspace.com/index.cfm?fuseaction=vids.individual&VideoID=".$code;
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