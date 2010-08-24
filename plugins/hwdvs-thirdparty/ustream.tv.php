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
class hwd_vs_tp_ustreamTv {
    /**
     * Extracts the appropriate third party video code used to generate
     * the player and thumbnail images
     *
     * @param string $option  the 'embed code' input given by user
     * @return       $ext_v_code   the third party video code
     */
	function ustreamTvProcessCode($raw_code)
	{
		$code = hwd_vs_tp_ustreamTv::ustreamTvGetCode($raw_code);
		if (!empty($code)) {
			$thumbnail = hwd_vs_tp_ustreamTv::ustreamTvGetThumbnail($code);
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
	function ustreamTvGetCode($raw_code)
	{
		// check for embed code format
		$pos_u1 = strpos($raw_code, "/recorded/");

		if ($pos_u1 === false) {

			return null;

		} else if ($pos_u1) {

			$pos_u1_start = $pos_u1 + 10;

			$pos_end = strpos($raw_code, "/", $pos_u1_start);
			if ($pos_end === false) {

				$pos_end = strpos($raw_code, "&", $pos_u1_start);
				if ($pos_end === false) {

					$code = substr($raw_code, $pos_u1_start);
					$code = preg_replace("/[^0-9]/", "", $code);

				} else {

					$length = $pos_end - $pos_u1_start;
					$code = substr($raw_code, $pos_u1_start, $length);
					$code = preg_replace("/[^0-9]/", "", $code);

				}

			} else {

				$length = $pos_end - $pos_u1_start;
				$code = substr($raw_code, $pos_u1_start, $length);
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
	function ustreamTvGetThumbnail($code)
	{
		$watchvideourl = "http://www.ustream.tv/recorded/".$code;
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

				$tagsh = strpos($buffer, '<div id="AboutVideo">');

				if ($tagsh === false) {

					return null;

				} else if ($tagsh) {

					$tagst = strpos($buffer, 'http', $tagsh);

					if ($tagst === false) {

						return null;

					} else if ($tagst) {

						//$tagen = strpos($buffer, '.jpg', $tagst);
						$tagen = strpos($buffer, '"', $tagst);

						if ($tagen === false) {

							return null;

						} else if ($tagen) {

							//$tagle = $tagen + 4 - $tagst;
							$tagle = $tagen - $tagst;
							$thumbnail   = substr($buffer, $tagst, $tagle);

						}

					}

				}

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
	function ustreamTvProcessTitle($raw_code, $processed_code=null)
	{
		$c = hwd_vs_Config::get_instance();

		if (empty($processed_code)) {
			$code = hwd_vs_tp_ustreamTv::ustreamTvGetCode($raw_code);
		} else {
			$code = $processed_code;
		}

		$watchvideourl = "http://www.ustream.tv/recorded/".$code;
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

				$tagst = strpos($buffer, '<title>');
				$tagst = $tagst + 7;
				$tagen = strpos($buffer, '</title>', $tagst);
				$tagle = $tagen - $tagst;
				$tag   = substr($buffer, $tagst, $tagle);

				if (!empty($tag)) {
					$ext_v_title[0] = 1;
					$ext_v_title[1] = $tag;
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
	function ustreamTvProcessDescription($raw_code, $processed_code=null)
	{
		$c = hwd_vs_Config::get_instance();

		if (empty($processed_code)) {
			$code = hwd_vs_tp_ustreamTv::ustreamTvGetCode($raw_code);
		} else {
			$code = $processed_code;
		}

		$watchvideourl = "http://www.ustream.tv/recorded/".$code;
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
	function ustreamTvProcessKeywords($raw_code, $processed_code=null)
	{
		$c = hwd_vs_Config::get_instance();

		if (empty($processed_code)) {
			$code = hwd_vs_tp_ustreamTv::ustreamTvGetCode($raw_code);
		} else {
			$code = $processed_code;
		}

		$watchvideourl = "http://www.ustream.tv/recorded/".$code;
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
	function ustreamTvProcessDuration($raw_code, $processed_code=null)
	{
		$c = hwd_vs_Config::get_instance();

		$ext_v_durat[0] = 0;
		$ext_v_durat[1] = "0:00:00";

		return $ext_v_durat;
	}
}
?>