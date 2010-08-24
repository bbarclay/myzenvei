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
class hwd_vs_tp_remote {
    /**
     * Extracts the appropriate third party video code used to generate
     * the player and thumbnail images
     *
     * @param string $option  the 'embed code' input given by user
     * @return       $ext_v_code   the third party video code
     */
	function remoteProcessCode($raw_code)
	{
		$code = hwd_vs_tp_remote::remoteGetCode($raw_code);
		if (!empty($code)) {
			$thumbnail = hwd_vs_tp_remote::remoteGetThumbnail($code);
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
     * @param string $raw_code  the 'embed code' input given by user
     * @return       $ext_v_code   the third party video code
     */
	function remoteGetCode($raw_code)
	{
		// check if an URL of valid video format
		if ($parseUrl = parse_url($raw_code)){

			$parsedUrl = @$parseUrl['scheme'].'://'.@$parseUrl['host'].@$parseUrl['path'];
			if (!empty($parseUrl['query'])) {
				$parsedUrl.= '?'.$parseUrl['query'];
			}
			$parsedUrl = hwd_vs_tools::get_final_url( $parsedUrl );

			$filegrab = @file_get_contents($parsedUrl, null, null, null, 150);

			if (function_exists('stripos')) {

				$filecheck1 = @stripos($filegrab, "flv");
				$filecheck2 = @stripos($filegrab, "mp4");

			} else {

				$filecheck1 = @strpos($filegrab, "flv");
				$filecheck2 = @strpos($filegrab, "mp4");

			}

			if (isset($parsedUrl) && !empty($parsedUrl) && ($filecheck1 !== false || $filecheck2 !== false)) {

				return $parsedUrl;

			} else {

				if (file_exists(JPATH_SITE.DS.'plugins'.DS.'hwdvs-thirdparty'.DS.'embed.php')) {

					require_once(JPATH_SITE.DS.'plugins'.DS.'hwdvs-thirdparty'.DS.'embed.php');
					$embedder = new hwd_vs_tp_embed();
					$code = $embedder->embedProcessURL($parsedUrl);
					return $code;

				}

			}

		} else {

		}

		return null;

	}
    /**
     * Extracts the appropriate third party video code used to generate
     * the player and thumbnail images
     *
     * @param string $raw_code  the 'embed code' input given by user
     * @return       $ext_v_code   the third party video code
     */
	function remoteGetThumbnail($raw_code)
	{
		// check if an URL of valid video format
		if ($parseUrl = parse_url($raw_code)){

			$parsedUrl = @$parseUrl['scheme'].'://'.@$parseUrl['host'].@$parseUrl['path'];
			if (!empty($parseUrl['query'])) {
				$parsedUrl.= '?'.$parseUrl['query'];
			}
			$parsedUrl = hwd_vs_tools::get_final_url( $parsedUrl );

			if (file_exists(JPATH_SITE.DS.'plugins'.DS.'hwdvs-thirdparty'.DS.'embed.php')) {

				require_once(JPATH_SITE.DS.'plugins'.DS.'hwdvs-thirdparty'.DS.'embed.php');
				$embedder = new hwd_vs_tp_embed();
				$code = $embedder->embedGetThumbnail($parsedUrl);
				return $code;

			}

		}

		return null;

	}
    /**
     * Extracts the title of the third party video
     *
     * @param string $raw_code  the 'embed code' input given by user
     * @return       $ext_v_title   the third party video title
     */
	function remoteProcessTitle($raw_code, $processed_code=null)
	{
		// check if an URL of valid video format
		if ($parseUrl = parse_url($raw_code)){

			$parsedUrl = @$parseUrl['scheme'].'://'.@$parseUrl['host'].@$parseUrl['path'];
			if (!empty($parseUrl['query'])) {
				$parsedUrl.= '?'.$parseUrl['query'];
			}
			$parsedUrl = hwd_vs_tools::get_final_url( $parsedUrl );

			if (file_exists(JPATH_SITE.DS.'plugins'.DS.'hwdvs-thirdparty'.DS.'embed.php')) {

				require_once(JPATH_SITE.DS.'plugins'.DS.'hwdvs-thirdparty'.DS.'embed.php');
				$embedder = new hwd_vs_tp_embed();
				$code = $embedder->embedProcessTitle($parsedUrl);

			}

		}

		if (!empty($code)) {
			$ext_video[0] = 1;
			$ext_video[1] = $code;
		} else {
			$ext_video[0] = 0;
			$ext_video[1] = _HWDVIDS_UNKNOWN;
		}

		return $ext_video;

	}
    /**
     * Extracts the description of the third party video
     *
     * @param string $raw_code  the 'embed code' input given by user
     * @return       $ext_v_title   the third party video description
     */
	function remoteProcessDescription($raw_code, $processed_code=null)
	{
		// check if an URL of valid video format
		if ($parseUrl = parse_url($raw_code)){

			$parsedUrl = @$parseUrl['scheme'].'://'.@$parseUrl['host'].@$parseUrl['path'];
			if (!empty($parseUrl['query'])) {
				$parsedUrl.= '?'.$parseUrl['query'];
			}
			$parsedUrl = hwd_vs_tools::get_final_url( $parsedUrl );

			if (file_exists(JPATH_SITE.DS.'plugins'.DS.'hwdvs-thirdparty'.DS.'embed.php')) {

				require_once(JPATH_SITE.DS.'plugins'.DS.'hwdvs-thirdparty'.DS.'embed.php');
				$embedder = new hwd_vs_tp_embed();
				$code = $embedder->embedProcessDescription($parsedUrl);

			}

		}

		if (!empty($code)) {
			$ext_video[0] = 1;
			$ext_video[1] = $code;
		} else {
			$ext_video[0] = 0;
			$ext_video[1] = _HWDVIDS_UNKNOWN;
		}

		return $ext_video;

	}
    /**
     * Extracts the keywords of the third party video
     *
     * @param string $raw_code  the 'embed code' input given by user
     * @return       $ext_v_title   the third party video keywords
     */
	function remoteProcessKeywords($raw_code, $processed_code=null)
	{
		// check if an URL of valid video format
		if ($parseUrl = parse_url($raw_code)){

			$parsedUrl = @$parseUrl['scheme'].'://'.@$parseUrl['host'].@$parseUrl['path'];
			if (!empty($parseUrl['query'])) {
				$parsedUrl.= '?'.$parseUrl['query'];
			}
			$parsedUrl = hwd_vs_tools::get_final_url( $parsedUrl );

			if (file_exists(JPATH_SITE.DS.'plugins'.DS.'hwdvs-thirdparty'.DS.'embed.php')) {

				require_once(JPATH_SITE.DS.'plugins'.DS.'hwdvs-thirdparty'.DS.'embed.php');
				$embedder = new hwd_vs_tp_embed();
				$code = $embedder->embedProcessDescription($parsedUrl);

			}

		}

		if (!empty($code)) {
			$ext_video[0] = 1;
			$ext_video[1] = $code;
		} else {
			$ext_video[0] = 0;
			$ext_video[1] = _HWDVIDS_UNKNOWN;
		}

		return $ext_video;

	}
    /**
     * Extracts the duration of the third party video
     *
     * @param string $raw_code  the 'embed code' input given by user
     * @return       $ext_v_title   the third party video duration
     */
	function remoteProcessDuration($raw_code, $processed_code=null)
	{
		// check if an URL of valid video format
		if ($parseUrl = parse_url($raw_code)){

			$parsedUrl = @$parseUrl['scheme'].'://'.@$parseUrl['host'].@$parseUrl['path'];
			if (!empty($parseUrl['query'])) {
				$parsedUrl.= '?'.$parseUrl['query'];
			}
			$parsedUrl = hwd_vs_tools::get_final_url( $parsedUrl );

			if (file_exists(JPATH_SITE.DS.'plugins'.DS.'hwdvs-thirdparty'.DS.'embed.php')) {

				require_once(JPATH_SITE.DS.'plugins'.DS.'hwdvs-thirdparty'.DS.'embed.php');
				$embedder = new hwd_vs_tp_embed();
				$code = $embedder->embedProcessDuration($parsedUrl);

			}

		}

		if (!empty($code)) {
			$ext_video[0] = 1;
			$ext_video[1] = $code;
		} else {
			$ext_video[0] = 0;
			$ext_video[1] = _HWDVIDS_UNKNOWN;
		}

		return $ext_video;

	}

}
?>





