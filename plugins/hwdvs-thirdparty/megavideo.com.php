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
class hwd_vs_tp_megavideoCom {
    /**
     * Extracts the appropriate third party video code used to generate
     * the player and thumbnail images
     *
     * @param string $option  the 'embed code' input given by user
     * @return       $ext_v_code   the third party video code
     */
	function megavideoComProcessCode($option)
	{
		$code = hwd_vs_tp_megavideoCom::megavideoComGetCode($option);

		if (!empty($code)) {
			$thumbnail = hwd_vs_tp_megavideoCom::megavideoComGetThumbnail($code);
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
	function megavideoComGetCode($option)
	{
		$code=array();
		// check for embed code format
		$pos_e = strpos($option, 'megavideo.com/v/');
		$pos_u = strpos($option, "megavideo.com/?v=");

		if (($pos_e === false) && ($pos_u === false)) {
			return null;
		} else if ($pos_e) {
			$pos_e_start = $pos_e + 16;
			$pos_e_end = strpos($option, '"');
			if ($pos_e_end === false) {
				return null;
			}
			$length = $pos_e_end - $pos_e_start;

			$code = substr($option, $pos_e_start, $length);
			$code = strip_tags($code);
			$code = preg_replace("/[^a-zA-Z0-9s_-]/", "", $code);
		} else if ($pos_u) {
			$pos_u_start = $pos_u + 17;
			$pos_u_end = strpos($option, '&');
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
	function megavideoComGetThumbnail($option)
	{
		$thumbnail = '';
		return $thumbnail;
	}
    /**
     * Extracts the title of the third party video
     *
     * @param string $option  the 'embed code' input given by user
     * @return       $ext_v_title   the third party video title
     */
	function megavideoComProcessTitle($option)
	{
		if (!defined('HWDVIDSPATH')) { define('HWDVIDSPATH', dirname(__FILE__).'/../../'); }
		$c = hwd_vs_Config::get_instance();

		$code = hwd_vs_tp_megavideoCom::megavideoComGetCode($option);

		$ext_v_title[0] = 0;
		$ext_v_title[1] = "Unknown";

		return $ext_v_title;
	}
    /**
     * Extracts the description of the third party video
     *
     * @param string $option  the 'embed code' input given by user
     * @return       $ext_v_title   the third party video description
     */
	function megavideoComProcessDescription($option)
	{
		if (!defined('HWDVIDSPATH')) { define('HWDVIDSPATH', dirname(__FILE__).'/../../'); }
		$c = hwd_vs_Config::get_instance();

		$code = hwd_vs_tp_megavideoCom::megavideoComGetCode($option);

		$ext_v_descr[0] = 0;
		$ext_v_descr[1] = "Unknown";

		return $ext_v_descr;
	}
    /**
     * Extracts the keywords of the third party video
     *
     * @param string $option  the 'embed code' input given by user
     * @return       $ext_v_title   the third party video keywords
     */
	function megavideoComProcessKeywords($option)
	{
		if (!defined('HWDVIDSPATH')) { define('HWDVIDSPATH', dirname(__FILE__).'/../../'); }
		$c = hwd_vs_Config::get_instance();

		$code = hwd_vs_tp_megavideoCom::megavideoComGetCode($option);

		$ext_v_keywo[0] = 0;
		$ext_v_keywo[1] = "Unknown";

		return $ext_v_keywo;
	}
    /**
     * Extracts the duration of the third party video
     *
     * @param string $option  the 'embed code' input given by user
     * @return       $ext_v_title   the third party video duration
     */
	function megavideoComProcessDuration($option)
	{
		if (!defined('HWDVIDSPATH')) { define('HWDVIDSPATH', dirname(__FILE__).'/../../'); }
		$c = hwd_vs_Config::get_instance();

		$ext_v_durat[0] = 0;
		$ext_v_durat[1] = "Unknown";

		return $ext_v_durat;
	}
}
?>
