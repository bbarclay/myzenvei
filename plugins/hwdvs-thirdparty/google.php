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
class hwd_vs_tp_googleCom {
    /**
     * Extracts the appropriate third party video code used to generate
     * the player and thumbnail images
     *
     * @param string $option  the 'embed code' input given by user
     * @return       $ext_v_code   the third party video code
     */
	function googleComProcessCode($option)
	{
		$code = hwd_vs_tp_googleCom::googleComGetCode($option);

		if (!empty($code)) {
			$thumbnail = hwd_vs_tp_googleCom::googleComGetThumbnail($code);
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
     * @param string $option  the 'embed code' input given by user
     * @return       $ext_v_code   the third party video code
     */
	function googleComGetCode($option)
	{
		// check for embed code format
		$pos_e = strpos($option, "googleplayer.swf?docid=");
		$pos_u = strpos($option, "videoplay?docid=");

		$code = '';

		if (($pos_e === false) && ($pos_u === false)) {
			return null;
		} else if ($pos_e) {
			$pos_e_start = $pos_e + 23;
			$pos_e_end = strpos($option, '&hl');
			if ($pos_e_end === false) {
				$pos_u_end = strpos($option, '&q');
				if ($pos_u_end === false) { return null; }
			}
			$length = $pos_e_end - $pos_e_start;

			$code = substr($option, $pos_e_start, $length);
			$code = strip_tags($code);
			$code = preg_replace("/[^a-zA-Z0-9s_-]/", "", $code);
		} else if ($pos_u) {

			$pos_u_start = $pos_u + 16;
			$pos_u_end_a = strpos($option, '&', $pos_u_start);
			$pos_u_end_h = strpos($option, '#', $pos_u_start);

			if ($pos_u_end_a === false && $pos_u_end_h === false) {
				$code = substr($option, $pos_u_start);
				$code = strip_tags($code);
				$code = preg_replace("/[^a-zA-Z0-9s_-]/", "", $code);
			} else if ($pos_u_end_a === false) {
				$length = $pos_u_end_h - $pos_u_start;
				$code = substr($option, $pos_u_start, $length);
				$code = strip_tags($code);
				$code = preg_replace("/[^a-zA-Z0-9s_-]/", "", $code);
			} else if ($pos_u_end_h === false) {
				$length = $pos_u_end_a - $pos_u_start;
				$code = substr($option, $pos_u_start, $length);
				$code = strip_tags($code);
				$code = preg_replace("/[^a-zA-Z0-9s_-]/", "", $code);
			} else {
				$length = $pos_u_end_a - $pos_u_start;
				$code = substr($option, $pos_u_start, $length);
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
	function googleComGetThumbnail($option)
	{
		if (function_exists('curl_init')) {

			$curl_handle=curl_init();
			curl_setopt($curl_handle,CURLOPT_URL,"http://video.google.com/videofeed?docid=".$option);
			curl_setopt($curl_handle,CURLOPT_CONNECTTIMEOUT,2);
			curl_setopt($curl_handle,CURLOPT_RETURNTRANSFER,1);
			$buffer = curl_exec($curl_handle);
			curl_close($curl_handle);

			if (empty($buffer))	{
				$thumbnail = "";
			} else {
				preg_match('/<media:thumbnail url="([^"]+)/',$buffer,$thumbnail_array);
				if (!empty($thumbnail_array[1])) {
					$thumbnail = $thumbnail_array[1];
					$thumbnail = str_replace('amp;','',$thumbnail);
				} else {
					$thumbnail = null;
				}
			}
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
	function googleComProcessTitle($option)
	{
		if (!defined('HWDVIDSPATH')) { define('HWDVIDSPATH', dirname(__FILE__).'/../../'); }
		$c = hwd_vs_Config::get_instance();

		$code = hwd_vs_tp_googleCom::googleComGetCode($option);

		$watchvideourl = "http://video.google.com/videoplay?docid=".$code;

		if (function_exists('curl_init')) {

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
     * @param string $option  the 'embed code' input given by user
     * @return       $ext_v_title   the third party video description
     */
	function googleComProcessDescription($option)
	{
		if (!defined('HWDVIDSPATH')) { define('HWDVIDSPATH', dirname(__FILE__).'/../../'); }
		$c = hwd_vs_Config::get_instance();

		$code = hwd_vs_tp_googleCom::googleComGetCode($option);

		$watchvideourl = "http://video.google.com/videoplay?docid=".$code;

		if (function_exists('curl_init')) {

			// get title with CURL
			$curl_handle=curl_init();
			curl_setopt($curl_handle,CURLOPT_URL,$watchvideourl);
			curl_setopt($curl_handle,CURLOPT_CONNECTTIMEOUT,2);
			curl_setopt($curl_handle,CURLOPT_RETURNTRANSFER,1);
			$buffer = curl_exec($curl_handle);
			curl_close($curl_handle);

			if (!empty($buffer)) {

				$tagst = strpos($buffer, '<span id=video-description>');

				if ($tagst === false) {

					$ext_v_descr[0] = 0;

				} else if ($tagst) {

					$tagst = $tagst + 27;
					$tagen = strpos($buffer, '</span>', $tagst);

					if ($tagen === false) {

						$ext_v_descr[0] = 0;

					} else if ($tagen) {

						$tagle = $tagen - $tagst;
						$tag   = substr($buffer, $tagst, $tagle);

						if (!empty($tag)) {
							$ext_v_descr[0] = 1;
							$ext_v_descr[1] = $tag;
							$ext_v_descr[1] = strip_tags($ext_v_descr[1]);
							$ext_v_descr[1] = trim($ext_v_descr[1]);
							$ext_v_descr[1] = hwdEncoding::XMLEntities($ext_v_descr[1]);
							$ext_v_descr[1] = hwdEncoding::charset_decode_utf_8($ext_v_descr[1]);
							$ext_v_descr[1] = addslashes($ext_v_descr[1]);
							$ext_v_descr[1] = hwd_vs_tools::truncateText($ext_v_descr[1], 300);
						}
					}
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
	function googleComProcessKeywords($option)
	{
		if (!defined('HWDVIDSPATH')) { define('HWDVIDSPATH', dirname(__FILE__).'/../../'); }
		$c = hwd_vs_Config::get_instance();

		$code = hwd_vs_tp_googleCom::googleComGetCode($option);

		$watchvideourl = "http://video.google.com/videoplay?docid=".$code;

		if (function_exists('curl_init')) {
			// get title with CURL
			$curl_handle=curl_init();
			curl_setopt($curl_handle,CURLOPT_URL,$watchvideourl);
			curl_setopt($curl_handle,CURLOPT_CONNECTTIMEOUT,2);
			curl_setopt($curl_handle,CURLOPT_RETURNTRANSFER,1);
			$buffer = curl_exec($curl_handle);
			curl_close($curl_handle);

			if (!empty($buffer)) {

				$tagst = strpos($buffer, '<span id=video-description>');

				if ($tagst === false) {

					$ext_v_keywo[0] = 0;

				} else if ($tagst) {

					$tagst = $tagst + 27;
					$tagen = strpos($buffer, '</span>', $tagst);

					if ($tagen === false) {

						$ext_v_keywo[0] = 0;

					} else if ($tagen) {

						$tagle = $tagen - $tagst;
						$tag   = substr($buffer, $tagst, $tagle);

						if (!empty($tag)) {
							$ext_v_keywo[0] = 1;
							$ext_v_keywo[1] = $tag;
							$ext_v_keywo[1] = strip_tags($ext_v_keywo[1]);
							$ext_v_keywo[1] = trim($ext_v_keywo[1]);
							$ext_v_keywo[1] = hwdEncoding::XMLEntities($ext_v_keywo[1]);
							$ext_v_keywo[1] = hwdEncoding::charset_decode_utf_8($ext_v_keywo[1]);
							$ext_v_keywo[1] = addslashes($ext_v_keywo[1]);
							$ext_v_keywo[1] = hwd_vs_tools::truncateText($ext_v_keywo[1], 300);
						}
					}
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
	function googleComProcessDuration($option)
	{
		if (!defined('HWDVIDSPATH')) { define('HWDVIDSPATH', dirname(__FILE__).'/../../'); }
		$c = hwd_vs_Config::get_instance();

		$ext_v_durat[0] = 0;
		$ext_v_durat[1] = "0:00:00";
		return $ext_v_durat;
	}
}
?>