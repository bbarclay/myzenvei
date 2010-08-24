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
class hwd_vs_tp_revverCom {
    /**
     * Extracts the appropriate third party video code used to generate
     * the player and thumbnail images
     *
     * @param string $option  the 'embed code' input given by user
     * @return       $ext_v_code   the third party video code
     */
	function revverComProcessCode($option)
	{
		$code = hwd_vs_tp_revverCom::revverComGetCode($option);
		if (!empty($code)) {
			$thumbnail = hwd_vs_tp_revverCom::revverComGetThumbnail($code);
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
	function revverComGetCode($option)
	{
		// check for embed code format
		$pos_e = strpos($option, "player.js?mediaId:");
		$pos_u = strpos($option, "revver.com/video/");

		if ($pos_e === false && $pos_u === false) {
			return null;
		} else if ($pos_e) {
			$pos_e_start = $pos_e + 18;

			$code = substr($option, $pos_e_start, 7);
			$code = strip_tags($code );
			$code = preg_replace("/[^a-zA-Z0-9s_-]/", "", $code);
		} else if ($pos_u) {
			$pos_u_start = $pos_u + 17;

			$code = substr($option, $pos_u_start, 7);
			$code = strip_tags($code );
			$code = preg_replace("/[^a-zA-Z0-9s_-]/", "", $code);
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
	function revverComGetThumbnail($option)
	{
		$thumbnail = "http://frame.revver.com/frame/120x90/".$option.".jpg";
		$thumbnail = trim(strip_tags($thumbnail));
		return $thumbnail;
	}
    /**
     * Extracts the title of the third party video
     *
     * @param string $option  the 'embed code' input given by user
     * @return       $ext_v_title   the third party video title
     */
	function revverComProcessTitle($option)
	{
		if (!defined('HWDVIDSPATH')) { define('HWDVIDSPATH', dirname(__FILE__).'/../../'); }
		$c = hwd_vs_Config::get_instance();

		$code = hwd_vs_tp_revverCom::revverComGetCode($option);

		$watchvideourl = "http://revver.com/video/".$code;
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
				if (mb_detect_encoding($buffer . 'a' , 'UTF-8, ISO-8859-1') == "UTF-8") {
					$buffer = utf8_decode($buffer);
				}
			}

			if (empty($buffer))	{
				$ext_v_title[0] = 0;
				$ext_v_title[1] = "Unknown";
			} else {
				// get title information
				$fcontents = stristr($buffer, '<title>');
				$rest = substr($fcontents, 7);
				$extra = stristr($fcontents, '</title>');
				$titlelen = strlen($rest) - strlen($extra);
				$gettitle = trim(substr($rest, 0, $titlelen));
				$gettitle = substr($gettitle, 10);

				if (!$gettitle) {
					$ext_v_title[0] = 0;
					$ext_v_title[1] = "Unknown";
				} else {
					$ext_v_title[0] = 1;
					$ext_v_title[1] = $gettitle;
				}
			}
		} else if (function_exists('get_meta_tags')) {
			if (@get_meta_tags($watchvideourl)) {
				$tags = get_meta_tags($watchvideourl);
				$ext_v_title[0] = 1;
				$ext_v_title[1] = $tags['title'];
			} else {
				$ext_v_title[0] = 0;
				$ext_v_title[1] = "Unknown";
			}
		} else {
			$ext_v_title[0] = 0;
			$ext_v_title[1] = "Unknown";
		}
		$ext_v_title[1] = hwd_vs_tools::truncateText($ext_v_title[1], 300);
		$ext_v_title[1] = mysql_real_escape_string(trim(strip_tags($ext_v_title[1])));

		return $ext_v_title;
	}
    /**
     * Extracts the description of the third party video
     *
     * @param string $option  the 'embed code' input given by user
     * @return       $ext_v_title   the third party video description
     */
	function revverComProcessDescription($option)
	{
		if (!defined('HWDVIDSPATH')) { define('HWDVIDSPATH', dirname(__FILE__).'/../../'); }
		$c = hwd_vs_Config::get_instance();

		$code = hwd_vs_tp_revverCom::revverComGetCode($option);

		$watchvideourl = "http://revver.com/video/".$code;
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
				if (mb_detect_encoding($buffer . 'a' , 'UTF-8, ISO-8859-1') == "UTF-8") {
					$buffer = utf8_decode($buffer);
				}
			}

			if (empty($buffer))	{
				$ext_v_descr[0] = 0;
				$ext_v_descr[1] = "Unknown";
			} else {
				$tagst = strpos($buffer, '<meta name="description" content="');
				$tagst = $tagst + 34;
				$tagen = strpos($buffer, '" />', $tagst);
				$tagle = $tagen - $tagst;
				$tag   = substr($buffer, $tagst, $tagle);
				if ($tag) {
					$ext_v_descr[0] = 1;
					$ext_v_descr[1] = $tag;
				} else {
					$ext_v_descr[0] = 0;
					$ext_v_descr[1] = "Unknown";
				}
			}
		} else if (function_exists('get_meta_tags')) {
			if (@get_meta_tags($watchvideourl)) {
				$tags = get_meta_tags($watchvideourl);
				$ext_v_descr[0] = 1;
				$ext_v_descr[1] = $tags['description'];
			} else {
				$ext_v_descr[0] = 0;
				$ext_v_descr[1] = "Unknown";
			}
		} else {
			$ext_v_descr[0] = 0;
			$ext_v_descr[1] = "Unknown";
		}
		$ext_v_descr[1] = hwd_vs_tools::truncateText($ext_v_descr[1], 500);
		$ext_v_descr[1] = mysql_real_escape_string(trim(strip_tags($ext_v_descr[1])));
		return $ext_v_descr;
	}
    /**
     * Extracts the keywords of the third party video
     *
     * @param string $option  the 'embed code' input given by user
     * @return       $ext_v_title   the third party video keywords
     */
	function revverComProcessKeywords($option)
	{
		if (!defined('HWDVIDSPATH')) { define('HWDVIDSPATH', dirname(__FILE__).'/../../'); }
		$c = hwd_vs_Config::get_instance();

		$code = hwd_vs_tp_revverCom::revverComGetCode($option);

		$watchvideourl = "http://revver.com/video/".$code;
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
				if (mb_detect_encoding($buffer . 'a' , 'UTF-8, ISO-8859-1') == "UTF-8") {
					$buffer = utf8_decode($buffer);
				}
			}

			if (empty($buffer))	{
				$ext_v_keywo[0] = 0;
				$ext_v_keywo[1] = "Unknown";
			} else {
				$tagst = strpos($buffer, '<meta name="keywords" content="');
				$tagst = $tagst + 31;
				$tagen = strpos($buffer, '" />', $tagst);
				$tagle = $tagen - $tagst;
				$tag   = substr($buffer, $tagst, $tagle);
				if ($tag) {
					$ext_v_keywo[0] = 1;
					$ext_v_keywo[1] = $tag;
				} else {
					$ext_v_keywo[0] = 0;
					$ext_v_keywo[1] = "Unknown";
				}
			}
		} else if (function_exists('get_meta_tags')) {
			if (@get_meta_tags($watchvideourl)) {
				$tags = get_meta_tags($watchvideourl);
				$ext_v_keywo[0] = 1;
				$ext_v_keywo[1] = $tags['keywords'];
			} else {
				$ext_v_keywo[0] = 0;
				$ext_v_keywo[1] = "Unknown";
			}
		} else {
			$ext_v_keywo[0] = 0;
			$ext_v_keywo[1] = "Unknown";
		}
		$ext_v_keywo[1] = hwd_vs_tools::truncateText($ext_v_keywo[1], 300);
		$ext_v_keywo[1] = mysql_real_escape_string(trim(strip_tags($ext_v_keywo[1])));
		return $ext_v_keywo;
	}
    /**
     * Extracts the duration of the third party video
     *
     * @param string $option  the 'embed code' input given by user
     * @return       $ext_v_title   the third party video duration
     */
	function revverComProcessDuration($option)
	{
		if (!defined('HWDVIDSPATH')) { define('HWDVIDSPATH', dirname(__FILE__).'/../../'); }
		$c = hwd_vs_Config::get_instance();

		$ext_v_durat[0] = 0;
		$ext_v_durat[1] = "0:00:00";
		return $ext_v_durat;
	}
}
?>