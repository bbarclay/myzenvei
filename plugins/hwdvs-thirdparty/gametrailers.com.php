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
class hwd_vs_tp_gametrailersCom {
    /**
     * Extracts the appropriate third party video code used to generate
     * the player and thumbnail images
     *
     * @param string $option  the 'embed code' input given by user
     * @return       $ext_v_code   the third party video code
     */
	function gametrailersComProcessCode($option)
	{
		$code = hwd_vs_tp_gametrailersCom::gametrailersComGetCode($option);
		if (!empty($code)) {
			$thumbnail = hwd_vs_tp_gametrailersCom::gametrailersComGetThumbnail($code);
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
	function gametrailersComGetCode($option)
	{
		// check for embed code format
		$pos = strpos($option, "gametrailers.com");
		$code = array();

		if ($pos === false) {
			return null;
		} else if ($pos) {
			$pos_n = strrpos($option, "/");
			if ($pos_n === false) {
				return null;
			}

			$code = substr($option, $pos_n);
			$code = strip_tags($code);
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
	function gametrailersComGetThumbnail($option)
	{
		$watchvideourl = "http://www.gametrailers.com/player/".$option.".html";
		$watchvideourl = hwd_vs_tools::get_final_url( $watchvideourl );
		$url_check = strpos($watchvideourl, 'http://www.gametrailers.com');

		if ($url_check === false) {
			$watchvideourl = "http://www.gametrailers.com".$watchvideourl;
		}

		if (function_exists('curl_init')) {
			// get title with CURL
			$curl_handle=curl_init();
			curl_setopt($curl_handle,CURLOPT_URL,$watchvideourl);
			curl_setopt($curl_handle,CURLOPT_CONNECTTIMEOUT,2);
			curl_setopt($curl_handle,CURLOPT_RETURNTRANSFER,1);
			$buffer = curl_exec($curl_handle);
			curl_close($curl_handle);

			if (empty($buffer))	{
				return null;
			} else {
				// get thumbnail
				$pos_thumb_search = strpos($buffer, "playlistThumb");
				$pos_thumb_start = strpos($buffer, 'http://www.gametrailers.com/moses/moviesthumbs/', $pos_thumb_search);
				$pos_thumb_end = strpos($buffer, '.jpg', $pos_thumb_start);

				if ($pos_thumb_end === false) {
					$pos_thumb_end = strpos($buffer, '" />', $pos_thumb_start);
					if ($pos_thumb_end === false) { return null; }
					$length = ($pos_thumb_end) - $pos_thumb_start;
				} else {
					$length = ($pos_thumb_end+4) - $pos_thumb_start;
				}

				$code = substr($buffer, $pos_thumb_start, $length);
				$code = strip_tags($code);

				if (!$code || empty($code)) {
					return null;
				} else {
					$thumbnail = $code;
				}
			}
		} else if (function_exists('file_get_contents')) {
			return null;
		} else {
			return null;
		}

		return $thumbnail;
	}
    /**
     * Extracts the title of the third party video
     *
     * @param string $option  the 'embed code' input given by user
     * @return       $ext_v_title   the third party video title
     */
	function gametrailersComProcessTitle($option)
	{
		if (!defined('HWDVIDSPATH')) { define('HWDVIDSPATH', dirname(__FILE__).'/../../'); }
		$c = hwd_vs_Config::get_instance();

		$code = hwd_vs_tp_gametrailersCom::gametrailersComGetCode($option);

		$watchvideourl = "http://www.gametrailers.com/player/".$code.".html";
		$watchvideourl = hwd_vs_tools::get_final_url( $watchvideourl );
		$url_check = strpos($watchvideourl, 'www.gametrailers.com');

		if ($url_check === false) {
			$watchvideourl = "http://www.gametrailers.com".$watchvideourl;
		} else {
			$watchvideourl = $watchvideourl;
		}

		if (function_exists('curl_init')) {

			$curl_handle=curl_init();
			curl_setopt($curl_handle,CURLOPT_URL,$watchvideourl);
			curl_setopt($curl_handle,CURLOPT_CONNECTTIMEOUT,2);
			curl_setopt($curl_handle,CURLOPT_RETURNTRANSFER,1);
			$buffer = curl_exec($curl_handle);
			curl_close($curl_handle);

			if (!empty($buffer)) {

				$fcontents = stristr($buffer, '<title>');
				$rest = substr($fcontents, 7);
				$extra = stristr($fcontents, '</title>');
				$titlelen = strlen($rest) - strlen($extra);
				$gettitle = trim(substr($rest, 0, $titlelen));

				if (!empty($gettitle)) {
					$ext_v_title[0] = 1;
					$ext_v_title[1] = $gettitle;
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
	function gametrailersComProcessDescription($option)
	{
		if (!defined('HWDVIDSPATH')) { define('HWDVIDSPATH', dirname(__FILE__).'/../../'); }
		$c = hwd_vs_Config::get_instance();

		$ext_v_descr[0] = 0;

		$code = hwd_vs_tp_gametrailersCom::gametrailersComGetCode($option);

		$watchvideourl = "http://www.gametrailers.com/player/".$code.".html";
		$watchvideourl = hwd_vs_tools::get_final_url( $watchvideourl );
		$url_check = strpos($watchvideourl, 'www.gametrailers.com');

		if ($url_check === false) {
			$watchvideourl = "http://www.gametrailers.com".$watchvideourl;
		} else {
			$watchvideourl = $watchvideourl;
		}

		if (function_exists('curl_init')) {
			// get title with CURL
			$curl_handle=curl_init();
			curl_setopt($curl_handle,CURLOPT_URL,$watchvideourl);
			curl_setopt($curl_handle,CURLOPT_CONNECTTIMEOUT,2);
			curl_setopt($curl_handle,CURLOPT_RETURNTRANSFER,1);
			$buffer = curl_exec($curl_handle);
			curl_close($curl_handle);

			if (!empty($buffer)) {

				preg_match('/<meta name="Description" content="([^"]+)/', $buffer, $match);
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
	function gametrailersComProcessKeywords($option)
	{
		if (!defined('HWDVIDSPATH')) { define('HWDVIDSPATH', dirname(__FILE__).'/../../'); }
		$c = hwd_vs_Config::get_instance();

		$ext_v_keywo[0] = 0;

		$code = hwd_vs_tp_gametrailersCom::gametrailersComGetCode($option);

		$watchvideourl = "http://www.gametrailers.com/player/".$code.".html";
		$watchvideourl = hwd_vs_tools::get_final_url( $watchvideourl );
		$url_check = strpos($watchvideourl, 'www.gametrailers.com');

		if ($url_check === false) {
			$watchvideourl = "http://www.gametrailers.com".$watchvideourl;
		} else {
			$watchvideourl = $watchvideourl;
		}

		if (function_exists('curl_init')) {
			// get title with CURL
			$curl_handle=curl_init();
			curl_setopt($curl_handle,CURLOPT_URL,$watchvideourl);
			curl_setopt($curl_handle,CURLOPT_CONNECTTIMEOUT,2);
			curl_setopt($curl_handle,CURLOPT_RETURNTRANSFER,1);
			$buffer = curl_exec($curl_handle);
			curl_close($curl_handle);

			if (!empty($buffer)) {

				preg_match('/<meta name="Keywords" content="([^"]+)/', $buffer, $match);
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
	function gametrailersComProcessDuration($option)
	{
		if (!defined('HWDVIDSPATH')) { define('HWDVIDSPATH', dirname(__FILE__).'/../../'); }
		$c = hwd_vs_Config::get_instance();

		$ext_v_durat[0] = 0;
		$ext_v_durat[1] = "0:00:00";
		return $ext_v_durat;
	}
}
?>
