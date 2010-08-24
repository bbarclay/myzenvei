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
class hwd_vs_tp_googleCoUk {
    /**
     * Extracts the appropriate third party video code used to generate
     * the player and thumbnail images
     *
     * @param string $option  the 'embed code' input given by user
     * @return       $ext_v_code   the third party video code
     */
	function googleCoUkProcessCode($option)
	{
		$code = hwd_vs_tp_googleCoUk::googleCoUkGetCode($option);

		if (!empty($code)) {
			$thumbnail = hwd_vs_tp_googleCoUk::googleCoUkGetThumbnail($code);
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
	function googleCoUkGetCode($option)
	{
		// check for embed code format
		$pos_e = strpos($option, "googleplayer.swf?docid=");
		$pos_u = strpos($option, "videoplay?docid=");

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
			$pos_u_end = strpos($option, '&', $pos_u_start);
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
	function googleCoUkGetThumbnail($option)
	{
		if (function_exists('curl_init')) {
			// get thumbnail URL with CURL
			$curl_handle=curl_init();
			curl_setopt($curl_handle,CURLOPT_URL,"http://video.google.com/videofeed?docid=".$option);
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
				preg_match('/<media:thumbnail url="([^"]+)/',$buffer,$thumbnail_array);
				$thumbnail = $thumbnail_array[1];
				//Remove amp;
				$thumbnail = str_replace('amp;','',$thumbnail);
			}
		} else if (function_exists('get_meta_tags')) {
			// get thumbnail URL with file_access
			$vrss = file_get_contents("http://video.google.com/videofeed?docid=".$option);

			if(!empty($vrss)) {
				preg_match('/<media:thumbnail url="([^"]+)/',$vrss,$thumbnail_array);
				$thumbnail = $thumbnail_array[1];
				//Remove amp;
				$thumbnail = str_replace('amp;','',$thumbnail);
			} else {
				$thumbnail = "";
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
	function googleCoUkProcessTitle($option)
	{
		if (!defined('HWDVIDSPATH')) { define('HWDVIDSPATH', dirname(__FILE__).'/../../'); }
		$c = hwd_vs_Config::get_instance();

		$code = hwd_vs_tp_googleCoUk::googleCoUkGetCode($option);

		$watchvideourl = "http://video.google.com/videoplay?docid=".$code;

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
				$ext_v_title[0] = 0;
				$ext_v_title[1] = "Unknown";
			} else {
				// get title information
				$fcontents = stristr($buffer, '<title>');
				$rest = substr($fcontents, 7);
				$extra = stristr($fcontents, '</title>');
				$titlelen = strlen($rest) - strlen($extra);
				$gettitle = trim(substr($rest, 0, $titlelen));

				if (!$gettitle) {
					$ext_v_title[0] = 0;
					$ext_v_title[1] = "Unknown";
				} else {
					$ext_v_title[0] = 1;
					$ext_v_title[1] = $gettitle;
				}
			}
		} else if (function_exists('file_get_contents')) {
			$fcontents = implode ('', file ("$watchvideourl"));
			$fcontents = stristr($fcontents, '<title>');
			$rest = substr($fcontents, 7);
			$extra = stristr($fcontents, '</title>');
			$titlelen = strlen($rest) - strlen($extra);
			$gettitle = trim(substr($rest, 0, $titlelen));

			if (!$gettitle) {
				$ext_v_title[0] = 0;
				$ext_v_title[1] = "Unknown";
			} else {
				$ext_v_title[0] = 1;
				$ext_v_title[1] = $gettitle;
			}
		} else {
			$ext_v_title[0] = 0;
			$ext_v_title[1] = "Unknown";
		}
		$ext_v_title[1] = hwd_vs_tools::truncateText($ext_v_title[1], 300);
		$ext_v_title[1] = addslashes(trim(strip_tags($ext_v_title[1])));
		return $ext_v_title;
	}
    /**
     * Extracts the description of the third party video
     *
     * @param string $option  the 'embed code' input given by user
     * @return       $ext_v_title   the third party video description
     */
	function googleCoUkProcessDescription($option)
	{
		if (!defined('HWDVIDSPATH')) { define('HWDVIDSPATH', dirname(__FILE__).'/../../'); }
		$c = hwd_vs_Config::get_instance();

		$code = hwd_vs_tp_googleCoUk::googleCoUkGetCode($option);

		$watchvideourl = "http://video.google.com/videofeed?docid=".$code;

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
				$ext_v_descr[0] = 0;
				$ext_v_descr[1] = "Unknown";
			} else {
				$tagst = strpos($buffer, '<media:description>');
				$tagst = $tagst + 19;
				$tagen = strpos($buffer, '</media:description>', $tagst);
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
		} else if (function_exists('file_get_contents')) {
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
		$ext_v_descr[1] = addslashes(trim(strip_tags($ext_v_descr[1])));
		return $ext_v_descr;
	}
    /**
     * Extracts the keywords of the third party video
     *
     * @param string $option  the 'embed code' input given by user
     * @return       $ext_v_title   the third party video keywords
     */
	function googleCoUkProcessKeywords($option)
	{
		if (!defined('HWDVIDSPATH')) { define('HWDVIDSPATH', dirname(__FILE__).'/../../'); }
		$c = hwd_vs_Config::get_instance();

		$code = hwd_vs_tp_googleCoUk::googleCoUkGetCode($option);

		$watchvideourl = "http://video.google.com/videofeed?docid=".$code;

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
				$ext_v_keywo[0] = 0;
				$ext_v_keywo[1] = "Unknown";
			} else {
				$tagst = strpos($buffer, '<media:description>');
				$tagst = $tagst + 19;
				$tagen = strpos($buffer, '</media:description>', $tagst);
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
		} else if (function_exists('file_get_contents')) {
			if (@get_meta_tags($watchvideourl)) {
				$tags = get_meta_tags($watchvideourl);
				$ext_v_keywo[0] = 1;
				$ext_v_keywo[1] = $tags['description'];
			} else {
				$ext_v_keywo[0] = 0;
				$ext_v_keywo[1] = "Unknown";
			}
		} else {
			$ext_v_keywo[0] = 0;
			$ext_v_keywo[1] = "Unknown";
		}
		$ext_v_keywo[1] = hwd_vs_tools::truncateText($ext_v_keywo[1], 300);
		$ext_v_keywo[1] = addslashes(trim(strip_tags($ext_v_keywo[1])));
		return $ext_v_keywo;
	}
    /**
     * Extracts the duration of the third party video
     *
     * @param string $option  the 'embed code' input given by user
     * @return       $ext_v_title   the third party video duration
     */
	function googleCoUkProcessDuration($option)
	{
		if (!defined('HWDVIDSPATH')) { define('HWDVIDSPATH', dirname(__FILE__).'/../../'); }
		$c = hwd_vs_Config::get_instance();

		$ext_v_durat[0] = 0;
		$ext_v_durat[1] = "0:00:00";
		return $ext_v_durat;
	}
}
?>