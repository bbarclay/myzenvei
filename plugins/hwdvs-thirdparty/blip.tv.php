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
class hwd_vs_tp_blipTv {
    /**
     * Extracts the appropriate third party video code used to generate
     * the player and thumbnail images
     *
     * @param string $option  the 'embed code' input given by user
     * @return       $ext_v_code   the third party video code
     */
	function blipTvProcessCode($option)
	{
		$code = hwd_vs_tp_blipTv::blipTvGetCode($option);
		if (!empty($code)) {
			$thumbnail = hwd_vs_tp_blipTv::blipTvGetThumbnail($code);
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
	function blipTvGetCode($option)
	{
		$code=array();
		// check for embed code format
		$pos_u = strpos($option, "blip.tv/file/");

		if ($pos_u === false) {
			return null;
		} else if ($pos_u) {

			$parsed = parse_url($option);
			$code = preg_replace("/[^0-9]/", "", $parsed['path']);

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
	function blipTvGetThumbnail($option)
	{
		if (isset($option)) {

			$url = "http://blip.tv/file/".$option."?skin=rss";
			$url = hwd_vs_tools::get_final_url( $url );

			if (function_exists('curl_init')) {

				$curl_handle=curl_init();
				curl_setopt($curl_handle,CURLOPT_URL,$url);
				curl_setopt($curl_handle,CURLOPT_CONNECTTIMEOUT,2);
				curl_setopt($curl_handle,CURLOPT_RETURNTRANSFER,1);
				$buffer = curl_exec($curl_handle);
				curl_close($curl_handle);

				if (empty($buffer))	{
					$code = "";
				} else {
					$pos_e_search = strpos($buffer, $option[0]);

					if ($pos_e_search === false) {
						return null;
					} else if ($pos_e_search) {
						$pos_tn_start = strpos($buffer, "<blip:smallThumbnail>", $pos_e_search);
						$pos_tn_start = $pos_tn_start+21;
						$pos_tn_end = strpos($buffer, '</blip:smallThumbnail>', $pos_tn_start);
						if ($pos_tn_end === false) {
							return null;
						}
						$length = $pos_tn_end - $pos_tn_start;

						$code = substr($buffer, $pos_tn_start, $length);
						$code = strip_tags($code);
					}
				}
			} else if (function_exists('get_meta_tags')) {
				$code = "";
			} else {
				$code = "";
			}

		}
		$thumbnail = $code;
		$thumbnail = trim(strip_tags($thumbnail));
		return $thumbnail;
	}
    /**
     * Extracts the title of the third party video
     *
     * @param string $option  the 'embed code' input given by user
     * @return       $ext_v_title   the third party video title
     */
	function blipTvProcessTitle($option)
	{
		if (!defined('HWDVIDSPATH')) { define('HWDVIDSPATH', dirname(__FILE__).'/../../'); }
		$c = hwd_vs_Config::get_instance();

		$code = hwd_vs_tp_blipTv::blipTvGetCode($option);
		if (isset($code)) {

			$rssfeed = "http://blip.tv/file/".$code."?skin=rss";
			$rssfeed = hwd_vs_tools::get_final_url( $rssfeed );

			if (function_exists('curl_init')) {
				// get title with CURL
				$curl_handle=curl_init();
				curl_setopt($curl_handle,CURLOPT_URL,$rssfeed);
				curl_setopt($curl_handle,CURLOPT_CONNECTTIMEOUT,2);
				curl_setopt($curl_handle,CURLOPT_RETURNTRANSFER,1);
				$buffer = curl_exec($curl_handle);
				curl_close($curl_handle);

				if (!empty($buffer)) {

					$pos_tstart = strpos($buffer, "<media:title>");
					$pos_tstart = $pos_tstart+13;
					$pos_tend = strpos($buffer, '</media:title>');
					if ($pos_tend === false) {
						return null;
					}
					$length = $pos_tend - $pos_tstart;

					$code = substr($buffer, $pos_tstart, $length);

					if (!empty($code)) {
						$ext_v_title[0] = 1;
						$ext_v_title[1] = $code;
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

		}

		return $ext_v_title;

	}
    /**
     * Extracts the description of the third party video
     *
     * @param string $option  the 'embed code' input given by user
     * @return       $ext_v_title   the third party video description
     */
	function blipTvProcessDescription($option)
	{
		if (!defined('HWDVIDSPATH')) { define('HWDVIDSPATH', dirname(__FILE__).'/../../'); }
		$c = hwd_vs_Config::get_instance();

		$code = hwd_vs_tp_blipTv::blipTvGetCode($option);
		if (isset($code)) {

			$rssfeed = "http://blip.tv/file/".$code."?skin=rss";
			$rssfeed = hwd_vs_tools::get_final_url( $rssfeed );

			if (function_exists('curl_init')) {

				$curl_handle=curl_init();
				curl_setopt($curl_handle,CURLOPT_URL,$rssfeed);
				curl_setopt($curl_handle,CURLOPT_CONNECTTIMEOUT,2);
				curl_setopt($curl_handle,CURLOPT_RETURNTRANSFER,1);
				$buffer = curl_exec($curl_handle);
				curl_close($curl_handle);

				if (!empty($buffer)) {

					$pos_tstart = strpos($buffer, "<blip:puredescription>");
					$pos_tstart = $pos_tstart+22;
					$pos_tend = strpos($buffer, '</blip:puredescription>', $pos_tstart);

					if ($pos_tend === false) {
						return null;
					}
					$length = $pos_tend - $pos_tstart;

					$code = substr($buffer, $pos_tstart, $length);
					$code = str_replace("<![CDATA[", "", $code);
					$code = str_replace("]]>", "", $code);

					if (!empty($code)) {
						$ext_v_descr[0] = 1;
						$ext_v_descr[1] = $code;
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

		}

		return $ext_v_descr;

	}
    /**
     * Extracts the keywords of the third party video
     *
     * @param string $option  the 'embed code' input given by user
     * @return       $ext_v_title   the third party video keywords
     */
	function blipTvProcessKeywords($option)
	{
		if (!defined('HWDVIDSPATH')) { define('HWDVIDSPATH', dirname(__FILE__).'/../../'); }
		$c = hwd_vs_Config::get_instance();

		$code = hwd_vs_tp_blipTv::blipTvGetCode($option);
		if (isset($code)) {

			$rssfeed = "http://blip.tv/file/".$code."?skin=rss";
			$rssfeed = hwd_vs_tools::get_final_url( $rssfeed );

			if (function_exists('curl_init')) {
				// get title with CURL
				$curl_handle=curl_init();
				curl_setopt($curl_handle,CURLOPT_URL,$rssfeed);
				curl_setopt($curl_handle,CURLOPT_CONNECTTIMEOUT,2);
				curl_setopt($curl_handle,CURLOPT_RETURNTRANSFER,1);
				$buffer = curl_exec($curl_handle);
				curl_close($curl_handle);

				if (!empty($buffer)) {

					$pos_tstart = strpos($buffer, "<media:keywords>");
					$pos_tstart = $pos_tstart+16;
					$pos_tend = strpos($buffer, '</media:keywords>', $pos_tstart);

					if ($pos_tend === false) {
						return null;
					}
					$length = $pos_tend - $pos_tstart;

					$code = substr($buffer, $pos_tstart, $length);

					if (!empty($code)) {
						$ext_v_keywo[0] = 1;
						$ext_v_keywo[1] = $code;
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

		}

		return $ext_v_keywo;

	}
    /**
     * Extracts the duration of the third party video
     *
     * @param string $option  the 'embed code' input given by user
     * @return       $ext_v_title   the third party video duration
     */
	function blipTvProcessDuration($option)
	{
		if (!defined('HWDVIDSPATH')) { define('HWDVIDSPATH', dirname(__FILE__).'/../../'); }
		$c = hwd_vs_Config::get_instance();

		$code = hwd_vs_tp_blipTv::blipTvGetCode($option);
		if (isset($code)) {

			$rssfeed = "http://blip.tv/file/".$code."?skin=rss";
			$rssfeed = hwd_vs_tools::get_final_url( $rssfeed );

			if (function_exists('curl_init')) {
				// get title with CURL
				$curl_handle=curl_init();
				curl_setopt($curl_handle,CURLOPT_URL,$rssfeed);
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
					$ext_v_durat[1] = "Unknown";
				} else {
					$pos_search = strpos($buffer, $option[0]);

					if ($pos_search === false) {
						$ext_v_title[0] = 0;
						$ext_v_title[1] = "Unknown";
					} else if ($pos_search) {
						$pos_start = strpos($buffer, "<blip:runtime>", $pos_search);
						$pos_start = $pos_start+14;
						$pos_end = strpos($buffer, '</blip:runtime>', $pos_start);
						if ($pos_end === false) {
							return null;
						}
						$length = $pos_end - $pos_start;

						$code = substr($buffer, $pos_start, $length);
						$ext_v_durat[0] = 1;
						$ext_v_durat[1] = hwd_vs_tools::sec2hms($code);
					}
				}
			} else if (function_exists('file_get_contents')) {
				$ext_v_durat[0] = 0;
				$ext_v_durat[1] = "Unknown";
			} else {
				$ext_v_durat[0] = 0;
				$ext_v_durat[1] = "Unknown";
			}
			$ext_v_durat[1] = preg_replace("/[^0-9-:]/", "", $ext_v_durat[1]);
		} else {
			$ext_v_durat[0] = 0;
			$ext_v_durat[1] = "Unknown";
		}
		return $ext_v_durat;
	}
}
?>
