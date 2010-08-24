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
class hwd_vs_tp_screencastCom {
    /**
     * Extracts the appropriate third party video code used to generate
     * the player and thumbnail images
     *
     * @param string $option  the 'embed code' input given by user
     * @return       $ext_v_code   the third party video code
     */
	function screencastComProcessCode($option)
	{
		$code = hwd_vs_tp_screencastCom::screencastComGetCode($option);

		if (!empty($code)) {

			$thumbnail = hwd_vs_tp_screencastCom::screencastComGetThumbnail($code);
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
	function screencastComGetCode($option)
	{
		// check for embed code format
		$parsed = parse_url($option);

		$code = $parsed['path'];
		$code = strip_tags($code);
		$code = preg_replace("/[^a-zA-Z0-9s_\/-]/", "", $code);

		return $code;
	}
    /**
     * Extracts the appropriate third party video code used to generate
     * the player and thumbnail images
     *
     * @param string $option  the 'embed code' input given by user
     * @return       $ext_v_code   the third party video code
     */
	function screencastComGetThumbnail($option)
	{
		$thumbnail = 'http://content.screencast.com'.$option.'/FirstFrame.jpg';
		$thumbnail = trim(strip_tags($thumbnail));
		return $thumbnail;
	}
    /**
     * Extracts the title of the third party video
     *
     * @param string $option  the 'embed code' input given by user
     * @return       $ext_v_title   the third party video title
     */
	function screencastComProcessTitle($option)
	{
		if (!defined('HWDVIDSPATH')) { define('HWDVIDSPATH', dirname(__FILE__).'/../../'); }
		$c = hwd_vs_Config::get_instance();

		$code = hwd_vs_tp_screencastCom::screencastComGetCode($option);
		$watchvideourl = "http://www.screencast.com".$code;
		$watchvideourl = hwd_vs_tools::get_final_url( $watchvideourl );

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
     * @param string $option  the 'embed code' input given by user
     * @return       $ext_v_title   the third party video description
     */
	function screencastComProcessDescription($option)
	{
		if (!defined('HWDVIDSPATH')) { define('HWDVIDSPATH', dirname(__FILE__).'/../../'); }
		$c = hwd_vs_Config::get_instance();

		$code = hwd_vs_tp_screencastCom::screencastComGetCode($option);
		$watchvideourl = "http://www.screencast.com".$code;
		$watchvideourl = hwd_vs_tools::get_final_url( $watchvideourl );

		if (function_exists('curl_init')) {
			// get title with CURL
			$curl_handle=curl_init();
			curl_setopt($curl_handle,CURLOPT_URL,$watchvideourl);
			curl_setopt($curl_handle,CURLOPT_CONNECTTIMEOUT,2);
			curl_setopt($curl_handle,CURLOPT_RETURNTRANSFER,1);
			$buffer = curl_exec($curl_handle);
			curl_close($curl_handle);

			if (!empty($buffer)) {

				$tagst = strpos($buffer, '<b>Description:</b>');

				if ($tagst === false) {

					$ext_v_descr[0] = 0;

				} else if ($tagst) {

					$tagst = $tagst + 27;
					$tagen = strpos($buffer, '</div>', $tagst);

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
	function screencastComProcessKeywords($option)
	{
		if (!defined('HWDVIDSPATH')) { define('HWDVIDSPATH', dirname(__FILE__).'/../../'); }
		$c = hwd_vs_Config::get_instance();

		$code = hwd_vs_tp_screencastCom::screencastComGetCode($option);
		$watchvideourl = "http://www.screencast.com".$code;
		$watchvideourl = hwd_vs_tools::get_final_url( $watchvideourl );

		if (function_exists('curl_init')) {
			// get title with CURL
			$curl_handle=curl_init();
			curl_setopt($curl_handle,CURLOPT_URL,$watchvideourl);
			curl_setopt($curl_handle,CURLOPT_CONNECTTIMEOUT,2);
			curl_setopt($curl_handle,CURLOPT_RETURNTRANSFER,1);
			$buffer = curl_exec($curl_handle);
			curl_close($curl_handle);

			if (!empty($buffer)) {

				$tagst = strpos($buffer, '<b>Description:</b>');

				if ($tagst === false) {

					$ext_v_keywo[0] = 0;

				} else if ($tagst) {

					$tagst = $tagst + 27;
					$tagen = strpos($buffer, '</div>', $tagst);

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
	function screencastComProcessDuration($option)
	{
		if (!defined('HWDVIDSPATH')) { define('HWDVIDSPATH', dirname(__FILE__).'/../../'); }
		$c = hwd_vs_Config::get_instance();

		$ext_v_durat[0] = 0;
		$ext_v_durat[1] = "0:00:00";
		return $ext_v_durat;
	}
}
?>