<?php
/**
 *    @version [ Cape ]
 *    @package hwdRevenueManager
 *    @copyright (C) 2007 - 2009 Highwood Design
 *    @license Creative Commons Attribution-Non-Commercial-No Derivative Works 3.0 Unported Licence
 *    @license http://creativecommons.org/licenses/by-nc-nd/3.0/
 */
defined( '_JEXEC' ) or die( 'Direct Access to this location is not allowed.' );

/**
 * @package    hwdRevenueManager
 * @author     Dave Horsfall <info@highwooddesign.co.uk>
 * @copyright  2008 Highwood Design
 * @license    http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @version    1.1.3
 */
class hwdrm_vads extends JTable
{
    var $id = null;
  	var $type = null;
  	var $url = null;
  	var $priority = null;
  	var $description = null;
  	var $impressions = null;
  	var $date_activate = null;
    var $date_deactivate = null;
  	var $impression_limit = null;
  	var $ordering = null;
  	var $checked_out = null;
  	var $checked_out_time = null;
  	var $published = null;

    /**
     * Constructor
     * @param database A database connector object
     */
	function hwdrm_vads(&$db){
        parent::__construct( '#__hwdrm_vads', 'id', $db );
	}
}
/**
 * @package    hwdRevenueManager
 * @author     Dave Horsfall <info@highwooddesign.co.uk>
 * @copyright  2008 Highwood Design
 * @license    http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @version    1.1.3
 */
class hwd_vs_adverts
{
    /**
     */
	function grabVideoAdverts() {
		global $show_video_ad, $pre_url, $post_url;
  		$db =& JFactory::getDBO();
		$show_video_ad = 0;

		// get pre
		$query = "SELECT *"
			    ." FROM #__hwdrm_vads"
				." WHERE published = 1"
				." AND type = 0"
				." AND date_activate <= NOW()"
				." AND date_deactivate >= NOW()"
				." AND impression_limit > impressions"
				." ORDER BY rand()*priority DESC"
				." LIMIT 0, 1"
				;

		$db->SetQuery( $query );
		$rows_pre = $db->loadObject();

		if (!empty($rows_pre->id)) {
			$show_video_ad = 1;
			$pre_url = $rows_pre->url;

			$impressions = $rows_pre->impressions+1;
			$db->SetQuery("UPDATE #__hwdrm_vads SET impressions = ".$impressions." WHERE id = ".$rows_pre->id);
			$db->Query();
			if ( !$db->query() ) {
				echo "<script> alert('".$db->getErrorMsg()."'); window.history.go(-1); </script>\n";
				exit();
			}

		} else {
			$pre_url = '';
		}

		// get post
		$query = "SELECT *"
			    ." FROM #__hwdrm_vads"
				." WHERE published = 1"
				." AND type = 1"
				." AND date_activate <= NOW()"
				." AND date_deactivate >= NOW()"
				." AND impression_limit > impressions"
				." ORDER BY rand()*priority DESC"
				." LIMIT 0, 1"
							;
		$db->SetQuery( $query );
		$rows_pos = $db->loadObject();

		if (!empty($rows_pos->id)) {
			$show_video_ad = 1;
			$post_url = $rows_pos->url;

			$impressions = $rows_pos->impressions+1;
			$db->SetQuery("UPDATE #__hwdrm_vads SET impressions = ".$impressions." WHERE id = ".$rows_pos->id);
			$db->Query();
			if ( !$db->query() ) {
				echo "<script> alert('".$db->getErrorMsg()."'); window.history.go(-1); </script>\n";
				exit();
			}

		} else {
			$post_url = '';
		}

	}
    /**
     */
	function grabLongTailAdverts() {
		global $show_longtail, $longtail_c, $longtail_d, $longtail_s;

		require_once(JPATH_SITE .'/administrator/components/com_hwdrevenuemanager/config.lt.hwdrevenuemanager.php');
		$rm = hwd_rm_lt_Config::get_instance();
		if ($rm->enable_longtail == 1) {
			$show_longtail = true;
			$longtail_c = $rm->longtail_channel_default;
			$longtail_d = $rm->longtail_d;
			$longtail_s = $rm->longtail_s;
		} else {
			$show_longtail = false;
		}
	}
	/**
     */
	function grabTextAdverts() {
		global $smartyvs;

		$advert1 = null;
		$advert2 = null;
		$advert3 = null;
		$advert4 = null;
		$advert5 = null;
		$advert6 = null;
		$advert7 = null;
		$advert8 = null;

		require_once(JPATH_SITE .'/administrator/components/com_hwdrevenuemanager/config.vs.hwdrevenuemanager.php');
		$rm = hwd_rm_vs_Config::get_instance();

		if ($rm->ad1show == 2) {
			//sizes
			$rm->ad1_format = explode("-", $rm->ad1_ad_format);
			$rm->ad1_ad_width = explode("x", $rm->ad1_format[0]);
			$rm->ad1_ad_height = explode("_", $rm->ad1_ad_width[1]);

			$advert1.= "<script type=\"text/javascript\"><!--\r\n";

			if ($rm->ad1_ad_client !== "") {
				$advert1.= "google_ad_client = \"" . $rm->ad1_ad_client . "\";\r\n";
			} else {
				$advert1.= "google_ad_client = \"pub-1907076410385444\";\r\n";
			}

			$advert1.= "google_alternate_ad_url = \"http://www.alternate-ad-url.com/alternate\";\r\n";

			$advert1.= "google_ad_width = " .  $rm->ad1_ad_width[0] . "; \r\n"
			   . "google_ad_height = " . $rm->ad1_ad_height[0] . "; \r\n"
			   . "google_ad_format = \"" . $rm->ad1_format[0] . "\"; \r\n";

			if ($rm->ad1_ad_format !== "") {
				$advert1.= "google_ad_type = \"" . $rm->ad1_ad_type . "\"; \r\n";
			}

			if ($rm->ad1_ad_channel !== "") {
				$advert1.= "google_ad_channel = \"" . $rm->ad1_ad_channel . "\"; \r\n";
			}

			if ($rm->ad1_color_border1 !== "") {
				$advert1.= "google_color_border = \"" . $rm->ad1_color_border1 . "\"; \r\n";
			}

			if ($rm->ad1_color_bg1 !== "") {
				$advert1.= "google_color_bg = \"" . $rm->ad1_color_bg1 . "\"; \r\n";
			}

			if ($rm->ad1_color_link1 !== "") {
				$advert1.= "google_color_link = \"" . $rm->ad1_color_link1 . "\"; \r\n";
			}

			if ($rm->ad1_color_text1 !== "") {
				$advert1.= "google_color_text = \"" . $rm->ad1_color_text1 . "\"; \r\n";
			}

			if ($rm->ad1_color_url1 !== "") {
				$advert1.= "google_color_url = \"" . $rm->ad1_color_url1 . "\"; \r\n";
			}

			if ($rm->ad1_ad_uifeatures !== "") {
				$advert1.= "google_ui_features = \"rc:" . $rm->ad1_ad_uifeatures . "\"; \r\n";
			}
			$advert1.= "//--> \r\n"
			. "</script>\r\n"
			. "<script type=\"text/javascript\" src=\"http://pagead2.googlesyndication.com/pagead/show_ads.js\">\r\n"
			. "</script>\r\n";

		} else if ($rm->ad1show == 1){
			$rm->ad1custom = stripslashes($rm->ad1custom);
			$advert1.= $rm->ad1custom;
		}

		if ($rm->ad2show == 2) {
			//sizes
			$rm->ad2_format = explode("-", $rm->ad2_ad_format);
			$rm->ad2_ad_width = explode("x", $rm->ad2_format[0]);
			$rm->ad2_ad_height = explode("_", $rm->ad2_ad_width[1]);

			$advert2.= "<script type=\"text/javascript\"><!--\r\n";

			if ($rm->ad2_ad_client !== "") {
				$advert2.= "google_ad_client = \"" . $rm->ad2_ad_client . "\";\r\n";
			} else {
				$advert2.= "google_ad_client = \"pub-1907076410385444\";\r\n";
			}

			$advert2.= "google_alternate_ad_url = \"http://www.alternate-ad-url.com/alternate\";\r\n";

			$advert2.= "google_ad_width = " .  $rm->ad2_ad_width[0] . "; \r\n"
			   . "google_ad_height = " . $rm->ad2_ad_height[0] . "; \r\n"
			   . "google_ad_format = \"" . $rm->ad2_format[0] . "\"; \r\n";

			if ($rm->ad2_ad_format !== "") {
				$advert2.= "google_ad_type = \"" . $rm->ad2_ad_type . "\"; \r\n";
			}

			if ($rm->ad2_ad_channel !== "") {
				$advert2.= "google_ad_channel = \"" . $rm->ad2_ad_channel . "\"; \r\n";
			}

			if ($rm->ad2_color_border1 !== "") {
				$advert2.= "google_color_border = \"" . $rm->ad2_color_border1 . "\"; \r\n";
			}

			if ($rm->ad2_color_bg1 !== "") {
				$advert2.= "google_color_bg = \"" . $rm->ad2_color_bg1 . "\"; \r\n";
			}

			if ($rm->ad2_color_link1 !== "") {
				$advert2.= "google_color_link = \"" . $rm->ad2_color_link1 . "\"; \r\n";
			}

			if ($rm->ad2_color_text1 !== "") {
				$advert2.= "google_color_text = \"" . $rm->ad2_color_text1 . "\"; \r\n";
			}

			if ($rm->ad2_color_url1 !== "") {
				$advert2.= "google_color_url = \"" . $rm->ad2_color_url1 . "\"; \r\n";
			}

			if ($rm->ad2_ad_uifeatures !== "") {
				$advert2.= "google_ui_features = \"rc:" . $rm->ad2_ad_uifeatures . "\"; \r\n";
			}
			$advert2.= "//--> \r\n"
			. "</script>\r\n"
			. "<script type=\"text/javascript\" src=\"http://pagead2.googlesyndication.com/pagead/show_ads.js\">\r\n"
			. "</script>\r\n";

		} else if ($rm->ad2show == 1){
			$rm->ad2custom = stripslashes($rm->ad2custom);
			$advert2.= $rm->ad2custom;
		}

		if ($rm->ad3show == 2) {
			//sizes
			$rm->ad3_format = explode("-", $rm->ad3_ad_format);
			$rm->ad3_ad_width = explode("x", $rm->ad3_format[0]);
			$rm->ad3_ad_height = explode("_", $rm->ad3_ad_width[1]);

			$advert3.= "<script type=\"text/javascript\"><!--\r\n";

			if ($rm->ad3_ad_client !== "") {
				$advert3.= "google_ad_client = \"" . $rm->ad3_ad_client . "\";\r\n";
			} else {
				$advert3.= "google_ad_client = \"pub-1907076410385444\";\r\n";
			}

			$advert3.= "google_alternate_ad_url = \"http://www.alternate-ad-url.com/alternate\";\r\n";

			$advert3.= "google_ad_width = " .  $rm->ad3_ad_width[0] . "; \r\n"
			   . "google_ad_height = " . $rm->ad3_ad_height[0] . "; \r\n"
			   . "google_ad_format = \"" . $rm->ad3_format[0] . "\"; \r\n";

			if ($rm->ad3_ad_format !== "") {
				$advert3.= "google_ad_type = \"" . $rm->ad3_ad_type . "\"; \r\n";
			}

			if ($rm->ad3_ad_channel !== "") {
				$advert3.= "google_ad_channel = \"" . $rm->ad3_ad_channel . "\"; \r\n";
			}

			if ($rm->ad3_color_border1 !== "") {
				$advert3.= "google_color_border = \"" . $rm->ad3_color_border1 . "\"; \r\n";
			}

			if ($rm->ad3_color_bg1 !== "") {
				$advert3.= "google_color_bg = \"" . $rm->ad3_color_bg1 . "\"; \r\n";
			}

			if ($rm->ad3_color_link1 !== "") {
				$advert3.= "google_color_link = \"" . $rm->ad3_color_link1 . "\"; \r\n";
			}

			if ($rm->ad3_color_text1 !== "") {
				$advert3.= "google_color_text = \"" . $rm->ad3_color_text1 . "\"; \r\n";
			}

			if ($rm->ad3_color_url1 !== "") {
				$advert3.= "google_color_url = \"" . $rm->ad3_color_url1 . "\"; \r\n";
			}

			if ($rm->ad3_ad_uifeatures !== "") {
				$advert3.= "google_ui_features = \"rc:" . $rm->ad3_ad_uifeatures . "\"; \r\n";
			}
			$advert3.= "//--> \r\n"
			. "</script>\r\n"
			. "<script type=\"text/javascript\" src=\"http://pagead2.googlesyndication.com/pagead/show_ads.js\">\r\n"
			. "</script>\r\n";

		} else if ($rm->ad3show == 1){
			$rm->ad3custom = stripslashes($rm->ad3custom);
			$advert3.= $rm->ad3custom;
		}

		if ($rm->ad4show == 2) {
			//sizes
			$rm->ad4_format = explode("-", $rm->ad4_ad_format);
			$rm->ad4_ad_width = explode("x", $rm->ad4_format[0]);
			$rm->ad4_ad_height = explode("_", $rm->ad4_ad_width[1]);

			$advert4.= "<script type=\"text/javascript\"><!--\r\n";

			if ($rm->ad4_ad_client !== "") {
				$advert4.= "google_ad_client = \"" . $rm->ad4_ad_client . "\";\r\n";
			} else {
				$advert4.= "google_ad_client = \"pub-1907076410385444\";\r\n";
			}

			$advert4.= "google_alternate_ad_url = \"http://www.alternate-ad-url.com/alternate\";\r\n";


			$advert4.= "google_ad_width = " .  $rm->ad4_ad_width[0] . "; \r\n"
			   . "google_ad_height = " . $rm->ad4_ad_height[0] . "; \r\n"
			   . "google_ad_format = \"" . $rm->ad4_format[0] . "\"; \r\n";

			if ($rm->ad4_ad_format !== "") {
				$advert4.= "google_ad_type = \"" . $rm->ad4_ad_type . "\"; \r\n";
			}

			if ($rm->ad4_ad_channel !== "") {
				$advert4.= "google_ad_channel = \"" . $rm->ad4_ad_channel . "\"; \r\n";
			}

			if ($rm->ad4_color_border1 !== "") {
				$advert4.= "google_color_border = \"" . $rm->ad4_color_border1 . "\"; \r\n";
			}

			if ($rm->ad4_color_bg1 !== "") {
				$advert4.= "google_color_bg = \"" . $rm->ad4_color_bg1 . "\"; \r\n";
			}

			if ($rm->ad4_color_link1 !== "") {
				$advert4.= "google_color_link = \"" . $rm->ad4_color_link1 . "\"; \r\n";
			}

			if ($rm->ad4_color_text1 !== "") {
				$advert4.= "google_color_text = \"" . $rm->ad4_color_text1 . "\"; \r\n";
			}

			if ($rm->ad4_color_url1 !== "") {
				$advert4.= "google_color_url = \"" . $rm->ad4_color_url1 . "\"; \r\n";
			}

			if ($rm->ad4_ad_uifeatures !== "") {
				$advert4.= "google_ui_features = \"rc:" . $rm->ad4_ad_uifeatures . "\"; \r\n";
			}
			$advert4.= "//--> \r\n"
			. "</script>\r\n"
			. "<script type=\"text/javascript\" src=\"http://pagead2.googlesyndication.com/pagead/show_ads.js\">\r\n"
			. "</script>\r\n";

		} else if ($rm->ad4show == 1){
			$rm->ad4custom = stripslashes($rm->ad4custom);
			$advert4.= $rm->ad4custom;
		}

		if ($rm->ad5show == 2) {
			//sizes
			$rm->ad5_format = explode("-", $rm->ad5_ad_format);
			$rm->ad5_ad_width = explode("x", $rm->ad5_format[0]);
			$rm->ad5_ad_height = explode("_", $rm->ad5_ad_width[1]);

			$advert5.= "<script type=\"text/javascript\"><!--\r\n";

			if ($rm->ad5_ad_client !== "") {
				$advert5.= "google_ad_client = \"" . $rm->ad5_ad_client . "\";\r\n";
			} else {
				$advert5.= "google_ad_client = \"pub-1907076410385444\";\r\n";
			}

			$advert5.= "google_alternate_ad_url = \"http://www.alternate-ad-url.com/alternate\";\r\n";

			$advert5.= "google_ad_width = " .  $rm->ad5_ad_width[0] . "; \r\n"
			   . "google_ad_height = " . $rm->ad5_ad_height[0] . "; \r\n"
			   . "google_ad_format = \"" . $rm->ad5_format[0] . "\"; \r\n";

			if ($rm->ad5_ad_format !== "") {
				$advert5.= "google_ad_type = \"" . $rm->ad5_ad_type . "\"; \r\n";
			}

			if ($rm->ad5_ad_channel !== "") {
				$advert5.= "google_ad_channel = \"" . $rm->ad5_ad_channel . "\"; \r\n";
			}

			if ($rm->ad5_color_border1 !== "") {
				$advert5.= "google_color_border = \"" . $rm->ad5_color_border1 . "\"; \r\n";
			}

			if ($rm->ad5_color_bg1 !== "") {
				$advert5.= "google_color_bg = \"" . $rm->ad5_color_bg1 . "\"; \r\n";
			}

			if ($rm->ad5_color_link1 !== "") {
				$advert5.= "google_color_link = \"" . $rm->ad5_color_link1 . "\"; \r\n";
			}

			if ($rm->ad5_color_text1 !== "") {
				$advert5.= "google_color_text = \"" . $rm->ad5_color_text1 . "\"; \r\n";
			}

			if ($rm->ad5_color_url1 !== "") {
				$advert5.= "google_color_url = \"" . $rm->ad5_color_url1 . "\"; \r\n";
			}

			if ($rm->ad5_ad_uifeatures !== "") {
				$advert5.= "google_ui_features = \"rc:" . $rm->ad5_ad_uifeatures . "\"; \r\n";
			}
			$advert5.= "//--> \r\n"
			. "</script>\r\n"
			. "<script type=\"text/javascript\" src=\"http://pagead2.googlesyndication.com/pagead/show_ads.js\">\r\n"
			. "</script>\r\n";

		} else if ($rm->ad5show == 1){
			$rm->ad5custom = stripslashes($rm->ad5custom);
			$advert5.= $rm->ad5custom;
		}

		if ($rm->ad6show == 2) {
			//sizes
			$rm->ad6_format = explode("-", $rm->ad6_ad_format);
			$rm->ad6_ad_width = explode("x", $rm->ad6_format[0]);
			$rm->ad6_ad_height = explode("_", $rm->ad6_ad_width[1]);

			$advert6.= "<script type=\"text/javascript\"><!--\r\n";

			if ($rm->ad6_ad_client !== "") {
				$advert6.= "google_ad_client = \"" . $rm->ad6_ad_client . "\";\r\n";
			} else {
				$advert6.= "google_ad_client = \"pub-1907076410385444\";\r\n";
			}

			$advert6.= "google_alternate_ad_url = \"http://www.alternate-ad-url.com/alternate\";\r\n";

			$advert6.= "google_ad_width = " .  $rm->ad6_ad_width[0] . "; \r\n"
			   . "google_ad_height = " . $rm->ad6_ad_height[0] . "; \r\n"
			   . "google_ad_format = \"" . $rm->ad6_format[0] . "\"; \r\n";

			if ($rm->ad6_ad_format !== "") {
				$advert6.= "google_ad_type = \"" . $rm->ad6_ad_type . "\"; \r\n";
			}

			if ($rm->ad6_ad_channel !== "") {
				$advert6.= "google_ad_channel = \"" . $rm->ad6_ad_channel . "\"; \r\n";
			}

			if ($rm->ad6_color_border1 !== "") {
				$advert6.= "google_color_border = \"" . $rm->ad6_color_border1 . "\"; \r\n";
			}

			if ($rm->ad6_color_bg1 !== "") {
				$advert6.= "google_color_bg = \"" . $rm->ad6_color_bg1 . "\"; \r\n";
			}

			if ($rm->ad6_color_link1 !== "") {
				$advert6.= "google_color_link = \"" . $rm->ad6_color_link1 . "\"; \r\n";
			}

			if ($rm->ad6_color_text1 !== "") {
				$advert6.= "google_color_text = \"" . $rm->ad6_color_text1 . "\"; \r\n";
			}

			if ($rm->ad6_color_url1 !== "") {
				$advert6.= "google_color_url = \"" . $rm->ad6_color_url1 . "\"; \r\n";
			}

			if ($rm->ad6_ad_uifeatures !== "") {
				$advert6.= "google_ui_features = \"rc:" . $rm->ad6_ad_uifeatures . "\"; \r\n";
			}
			$advert6.= "//--> \r\n"
			. "</script>\r\n"
			. "<script type=\"text/javascript\" src=\"http://pagead2.googlesyndication.com/pagead/show_ads.js\">\r\n"
			. "</script>\r\n";

		} else if ($rm->ad6show == 1){
			$rm->ad6custom = stripslashes($rm->ad6custom);
			$advert6.= $rm->ad6custom;
		}

		if ($rm->ad7show == 2) {
			//sizes
			$rm->ad7_format = explode("-", $rm->ad7_ad_format);
			$rm->ad7_ad_width = explode("x", $rm->ad7_format[0]);
			$rm->ad7_ad_height = explode("_", $rm->ad7_ad_width[1]);

			$advert7.= "<script type=\"text/javascript\"><!--\r\n";

			if ($rm->ad7_ad_client !== "") {
				$advert7.= "google_ad_client = \"" . $rm->ad7_ad_client . "\";\r\n";
			} else {
				$advert7.= "google_ad_client = \"pub-1907076410385444\";\r\n";
			}

			$advert7.= "google_alternate_ad_url = \"http://www.alternate-ad-url.com/alternate\";\r\n";

			$advert7.= "google_ad_width = " .  $rm->ad7_ad_width[0] . "; \r\n"
			   . "google_ad_height = " . $rm->ad7_ad_height[0] . "; \r\n"
			   . "google_ad_format = \"" . $rm->ad7_format[0] . "\"; \r\n";

			if ($rm->ad7_ad_format !== "") {
				$advert7.= "google_ad_type = \"" . $rm->ad7_ad_type . "\"; \r\n";
			}

			if ($rm->ad7_ad_channel !== "") {
				$advert7.= "google_ad_channel = \"" . $rm->ad7_ad_channel . "\"; \r\n";
			}

			if ($rm->ad7_color_border1 !== "") {
				$advert7.= "google_color_border = \"" . $rm->ad7_color_border1 . "\"; \r\n";
			}

			if ($rm->ad7_color_bg1 !== "") {
				$advert7.= "google_color_bg = \"" . $rm->ad7_color_bg1 . "\"; \r\n";
			}

			if ($rm->ad7_color_link1 !== "") {
				$advert7.= "google_color_link = \"" . $rm->ad7_color_link1 . "\"; \r\n";
			}

			if ($rm->ad7_color_text1 !== "") {
				$advert7.= "google_color_text = \"" . $rm->ad7_color_text1 . "\"; \r\n";
			}

			if ($rm->ad7_color_url1 !== "") {
				$advert7.= "google_color_url = \"" . $rm->ad7_color_url1 . "\"; \r\n";
			}

			if ($rm->ad7_ad_uifeatures !== "") {
				$advert7.= "google_ui_features = \"rc:" . $rm->ad7_ad_uifeatures . "\"; \r\n";
			}
			$advert7.= "//--> \r\n"
			. "</script>\r\n"
			. "<script type=\"text/javascript\" src=\"http://pagead2.googlesyndication.com/pagead/show_ads.js\">\r\n"
			. "</script>\r\n";

		} else if ($rm->ad7show == 1){
			$rm->ad7custom = stripslashes($rm->ad7custom);
			$advert7.= $rm->ad7custom;
		}

		if ($rm->ad8show == 2) {
			//sizes
			$rm->ad8_format = explode("-", $rm->ad8_ad_format);
			$rm->ad8_ad_width = explode("x", $rm->ad8_format[0]);
			$rm->ad8_ad_height = explode("_", $rm->ad8_ad_width[1]);

			$advert8.= "<script type=\"text/javascript\"><!--\r\n";

			if ($rm->ad8_ad_client !== "") {
				$advert8.= "google_ad_client = \"" . $rm->ad8_ad_client . "\";\r\n";
			} else {
				$advert8.= "google_ad_client = \"pub-1907076410385444\";\r\n";
			}

			$advert8.= "google_alternate_ad_url = \"http://www.alternate-ad-url.com/alternate\";\r\n";

			$advert8.= "google_ad_width = " .  $rm->ad8_ad_width[0] . "; \r\n"
			   . "google_ad_height = " . $rm->ad8_ad_height[0] . "; \r\n"
			   . "google_ad_format = \"" . $rm->ad8_format[0] . "\"; \r\n";

			if ($rm->ad8_ad_format !== "") {
				$advert8.= "google_ad_type = \"" . $rm->ad8_ad_type . "\"; \r\n";
			}

			if ($rm->ad8_ad_channel !== "") {
				$advert8.= "google_ad_channel = \"" . $rm->ad8_ad_channel . "\"; \r\n";
			}

			if ($rm->ad8_color_border1 !== "") {
				$advert8.= "google_color_border = \"" . $rm->ad8_color_border1 . "\"; \r\n";
			}

			if ($rm->ad8_color_bg1 !== "") {
				$advert8.= "google_color_bg = \"" . $rm->ad8_color_bg1 . "\"; \r\n";
			}

			if ($rm->ad8_color_link1 !== "") {
				$advert8.= "google_color_link = \"" . $rm->ad8_color_link1 . "\"; \r\n";
			}

			if ($rm->ad8_color_text1 !== "") {
				$advert8.= "google_color_text = \"" . $rm->ad8_color_text1 . "\"; \r\n";
			}

			if ($rm->ad8_color_url1 !== "") {
				$advert8.= "google_color_url = \"" . $rm->ad8_color_url1 . "\"; \r\n";
			}

			if ($rm->ad8_ad_uifeatures !== "") {
				$advert8.= "google_ui_features = \"rc:" . $rm->ad8_ad_uifeatures . "\"; \r\n";
			}
			$advert8.= "//--> \r\n"
			. "</script>\r\n"
			. "<script type=\"text/javascript\" src=\"http://pagead2.googlesyndication.com/pagead/show_ads.js\">\r\n"
			. "</script>\r\n";

		} else if ($rm->ad8show == 1){
			$rm->ad8custom = stripslashes($rm->ad8custom);
			$advert8.= $rm->ad8custom;
		}

		if (!empty($advert1)) { $smartyvs->assign("advert1", $advert1); }
		if (!empty($advert2)) { $smartyvs->assign("advert2", $advert2); }
		if (!empty($advert3)) { $smartyvs->assign("advert3", $advert3); }
		if (!empty($advert4)) { $smartyvs->assign("advert4", $advert4); }
		if (!empty($advert5)) { $smartyvs->assign("advert5", $advert5); }
		if (!empty($advert6)) { $smartyvs->assign("custom_advert1", $advert6); }
		if (!empty($advert7)) { $smartyvs->assign("custom_advert2", $advert7); }
		if (!empty($advert8)) { $smartyvs->assign("custom_advert3", $advert8); }
	}
}
/**
 * @package    hwdRevenueManager
 * @author     Dave Horsfall <info@highwooddesign.co.uk>
 * @copyright  2008 Highwood Design
 * @license    http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @version    1.1.3
 */
class hwd_ps_adverts
{
	/**
     */
	function grabTextAdverts() {
		global $smartyps;

		$advert1 = null;
		$advert2 = null;
		$advert3 = null;
		$advert4 = null;
		$advert5 = null;
		$advert6 = null;
		$advert7 = null;
		$advert8 = null;

		require_once(JPATH_SITE .'/administrator/components/com_hwdrevenuemanager/config.ps.hwdrevenuemanager.php');
		$rm = hwd_rm_ps_Config::get_instance();

		if ($rm->ad1show == 2) {
			//sizes
			$rm->ad1_format = explode("-", $rm->ad1_ad_format);
			$rm->ad1_ad_width = explode("x", $rm->ad1_format[0]);
			$rm->ad1_ad_height = explode("_", $rm->ad1_ad_width[1]);

			$advert1.= "<script type=\"text/javascript\"><!--\r\n";

			if ($rm->ad1_ad_client !== "") {
				$advert1.= "google_ad_client = \"" . $rm->ad1_ad_client . "\";\r\n";
			} else {
				$advert1.= "google_ad_client = \"pub-1907076410385444\";\r\n";
			}

			$advert1.= "google_alternate_ad_url = \"http://www.alternate-ad-url.com/alternate\";\r\n";

			$advert1.= "google_ad_width = " .  $rm->ad1_ad_width[0] . "; \r\n"
			   . "google_ad_height = " . $rm->ad1_ad_height[0] . "; \r\n"
			   . "google_ad_format = \"" . $rm->ad1_format[0] . "\"; \r\n";

			if ($rm->ad1_ad_format !== "") {
				$advert1.= "google_ad_type = \"" . $rm->ad1_ad_type . "\"; \r\n";
			}

			if ($rm->ad1_ad_channel !== "") {
				$advert1.= "google_ad_channel = \"" . $rm->ad1_ad_channel . "\"; \r\n";
			}

			if ($rm->ad1_color_border1 !== "") {
				$advert1.= "google_color_border = \"" . $rm->ad1_color_border1 . "\"; \r\n";
			}

			if ($rm->ad1_color_bg1 !== "") {
				$advert1.= "google_color_bg = \"" . $rm->ad1_color_bg1 . "\"; \r\n";
			}

			if ($rm->ad1_color_link1 !== "") {
				$advert1.= "google_color_link = \"" . $rm->ad1_color_link1 . "\"; \r\n";
			}

			if ($rm->ad1_color_text1 !== "") {
				$advert1.= "google_color_text = \"" . $rm->ad1_color_text1 . "\"; \r\n";
			}

			if ($rm->ad1_color_url1 !== "") {
				$advert1.= "google_color_url = \"" . $rm->ad1_color_url1 . "\"; \r\n";
			}

			if ($rm->ad1_ad_uifeatures !== "") {
				$advert1.= "google_ui_features = \"rc:" . $rm->ad1_ad_uifeatures . "\"; \r\n";
			}
			$advert1.= "//--> \r\n"
			. "</script>\r\n"
			. "<script type=\"text/javascript\" src=\"http://pagead2.googlesyndication.com/pagead/show_ads.js\">\r\n"
			. "</script>\r\n";

		} else if ($rm->ad1show == 1){
			$rm->ad1custom = stripslashes($rm->ad1custom);
			$advert1.= $rm->ad1custom;
		}

		if ($rm->ad2show == 2) {
			//sizes
			$rm->ad2_format = explode("-", $rm->ad2_ad_format);
			$rm->ad2_ad_width = explode("x", $rm->ad2_format[0]);
			$rm->ad2_ad_height = explode("_", $rm->ad2_ad_width[1]);

			$advert2.= "<script type=\"text/javascript\"><!--\r\n";

			if ($rm->ad2_ad_client !== "") {
				$advert2.= "google_ad_client = \"" . $rm->ad2_ad_client . "\";\r\n";
			} else {
				$advert2.= "google_ad_client = \"pub-1907076410385444\";\r\n";
			}

			$advert2.= "google_alternate_ad_url = \"http://www.alternate-ad-url.com/alternate\";\r\n";

			$advert2.= "google_ad_width = " .  $rm->ad2_ad_width[0] . "; \r\n"
			   . "google_ad_height = " . $rm->ad2_ad_height[0] . "; \r\n"
			   . "google_ad_format = \"" . $rm->ad2_format[0] . "\"; \r\n";

			if ($rm->ad2_ad_format !== "") {
				$advert2.= "google_ad_type = \"" . $rm->ad2_ad_type . "\"; \r\n";
			}

			if ($rm->ad2_ad_channel !== "") {
				$advert2.= "google_ad_channel = \"" . $rm->ad2_ad_channel . "\"; \r\n";
			}

			if ($rm->ad2_color_border1 !== "") {
				$advert2.= "google_color_border = \"" . $rm->ad2_color_border1 . "\"; \r\n";
			}

			if ($rm->ad2_color_bg1 !== "") {
				$advert2.= "google_color_bg = \"" . $rm->ad2_color_bg1 . "\"; \r\n";
			}

			if ($rm->ad2_color_link1 !== "") {
				$advert2.= "google_color_link = \"" . $rm->ad2_color_link1 . "\"; \r\n";
			}

			if ($rm->ad2_color_text1 !== "") {
				$advert2.= "google_color_text = \"" . $rm->ad2_color_text1 . "\"; \r\n";
			}

			if ($rm->ad2_color_url1 !== "") {
				$advert2.= "google_color_url = \"" . $rm->ad2_color_url1 . "\"; \r\n";
			}

			if ($rm->ad2_ad_uifeatures !== "") {
				$advert2.= "google_ui_features = \"rc:" . $rm->ad2_ad_uifeatures . "\"; \r\n";
			}
			$advert2.= "//--> \r\n"
			. "</script>\r\n"
			. "<script type=\"text/javascript\" src=\"http://pagead2.googlesyndication.com/pagead/show_ads.js\">\r\n"
			. "</script>\r\n";

		} else if ($rm->ad2show == 1){
			$rm->ad2custom = stripslashes($rm->ad2custom);
			$advert2.= $rm->ad2custom;
		}

		if ($rm->ad3show == 2) {
			//sizes
			$rm->ad3_format = explode("-", $rm->ad3_ad_format);
			$rm->ad3_ad_width = explode("x", $rm->ad3_format[0]);
			$rm->ad3_ad_height = explode("_", $rm->ad3_ad_width[1]);

			$advert3.= "<script type=\"text/javascript\"><!--\r\n";

			if ($rm->ad3_ad_client !== "") {
				$advert3.= "google_ad_client = \"" . $rm->ad3_ad_client . "\";\r\n";
			} else {
				$advert3.= "google_ad_client = \"pub-1907076410385444\";\r\n";
			}

			$advert3.= "google_alternate_ad_url = \"http://www.alternate-ad-url.com/alternate\";\r\n";

			$advert3.= "google_ad_width = " .  $rm->ad3_ad_width[0] . "; \r\n"
			   . "google_ad_height = " . $rm->ad3_ad_height[0] . "; \r\n"
			   . "google_ad_format = \"" . $rm->ad3_format[0] . "\"; \r\n";

			if ($rm->ad3_ad_format !== "") {
				$advert3.= "google_ad_type = \"" . $rm->ad3_ad_type . "\"; \r\n";
			}

			if ($rm->ad3_ad_channel !== "") {
				$advert3.= "google_ad_channel = \"" . $rm->ad3_ad_channel . "\"; \r\n";
			}

			if ($rm->ad3_color_border1 !== "") {
				$advert3.= "google_color_border = \"" . $rm->ad3_color_border1 . "\"; \r\n";
			}

			if ($rm->ad3_color_bg1 !== "") {
				$advert3.= "google_color_bg = \"" . $rm->ad3_color_bg1 . "\"; \r\n";
			}

			if ($rm->ad3_color_link1 !== "") {
				$advert3.= "google_color_link = \"" . $rm->ad3_color_link1 . "\"; \r\n";
			}

			if ($rm->ad3_color_text1 !== "") {
				$advert3.= "google_color_text = \"" . $rm->ad3_color_text1 . "\"; \r\n";
			}

			if ($rm->ad3_color_url1 !== "") {
				$advert3.= "google_color_url = \"" . $rm->ad3_color_url1 . "\"; \r\n";
			}

			if ($rm->ad3_ad_uifeatures !== "") {
				$advert3.= "google_ui_features = \"rc:" . $rm->ad3_ad_uifeatures . "\"; \r\n";
			}
			$advert3.= "//--> \r\n"
			. "</script>\r\n"
			. "<script type=\"text/javascript\" src=\"http://pagead2.googlesyndication.com/pagead/show_ads.js\">\r\n"
			. "</script>\r\n";

		} else if ($rm->ad3show == 1){
			$rm->ad3custom = stripslashes($rm->ad3custom);
			$advert3.= $rm->ad3custom;
		}

		if ($rm->ad4show == 2) {
			//sizes
			$rm->ad4_format = explode("-", $rm->ad4_ad_format);
			$rm->ad4_ad_width = explode("x", $rm->ad4_format[0]);
			$rm->ad4_ad_height = explode("_", $rm->ad4_ad_width[1]);

			$advert4.= "<script type=\"text/javascript\"><!--\r\n";

			if ($rm->ad4_ad_client !== "") {
				$advert4.= "google_ad_client = \"" . $rm->ad4_ad_client . "\";\r\n";
			} else {
				$advert4.= "google_ad_client = \"pub-1907076410385444\";\r\n";
			}

			$advert4.= "google_alternate_ad_url = \"http://www.alternate-ad-url.com/alternate\";\r\n";


			$advert4.= "google_ad_width = " .  $rm->ad4_ad_width[0] . "; \r\n"
			   . "google_ad_height = " . $rm->ad4_ad_height[0] . "; \r\n"
			   . "google_ad_format = \"" . $rm->ad4_format[0] . "\"; \r\n";

			if ($rm->ad4_ad_format !== "") {
				$advert4.= "google_ad_type = \"" . $rm->ad4_ad_type . "\"; \r\n";
			}

			if ($rm->ad4_ad_channel !== "") {
				$advert4.= "google_ad_channel = \"" . $rm->ad4_ad_channel . "\"; \r\n";
			}

			if ($rm->ad4_color_border1 !== "") {
				$advert4.= "google_color_border = \"" . $rm->ad4_color_border1 . "\"; \r\n";
			}

			if ($rm->ad4_color_bg1 !== "") {
				$advert4.= "google_color_bg = \"" . $rm->ad4_color_bg1 . "\"; \r\n";
			}

			if ($rm->ad4_color_link1 !== "") {
				$advert4.= "google_color_link = \"" . $rm->ad4_color_link1 . "\"; \r\n";
			}

			if ($rm->ad4_color_text1 !== "") {
				$advert4.= "google_color_text = \"" . $rm->ad4_color_text1 . "\"; \r\n";
			}

			if ($rm->ad4_color_url1 !== "") {
				$advert4.= "google_color_url = \"" . $rm->ad4_color_url1 . "\"; \r\n";
			}

			if ($rm->ad4_ad_uifeatures !== "") {
				$advert4.= "google_ui_features = \"rc:" . $rm->ad4_ad_uifeatures . "\"; \r\n";
			}
			$advert4.= "//--> \r\n"
			. "</script>\r\n"
			. "<script type=\"text/javascript\" src=\"http://pagead2.googlesyndication.com/pagead/show_ads.js\">\r\n"
			. "</script>\r\n";

		} else if ($rm->ad4show == 1){
			$rm->ad4custom = stripslashes($rm->ad4custom);
			$advert4.= $rm->ad4custom;
		}

		if ($rm->ad5show == 2) {
			//sizes
			$rm->ad5_format = explode("-", $rm->ad5_ad_format);
			$rm->ad5_ad_width = explode("x", $rm->ad5_format[0]);
			$rm->ad5_ad_height = explode("_", $rm->ad5_ad_width[1]);

			$advert5.= "<script type=\"text/javascript\"><!--\r\n";

			if ($rm->ad5_ad_client !== "") {
				$advert5.= "google_ad_client = \"" . $rm->ad5_ad_client . "\";\r\n";
			} else {
				$advert5.= "google_ad_client = \"pub-1907076410385444\";\r\n";
			}

			$advert5.= "google_alternate_ad_url = \"http://www.alternate-ad-url.com/alternate\";\r\n";

			$advert5.= "google_ad_width = " .  $rm->ad5_ad_width[0] . "; \r\n"
			   . "google_ad_height = " . $rm->ad5_ad_height[0] . "; \r\n"
			   . "google_ad_format = \"" . $rm->ad5_format[0] . "\"; \r\n";

			if ($rm->ad5_ad_format !== "") {
				$advert5.= "google_ad_type = \"" . $rm->ad5_ad_type . "\"; \r\n";
			}

			if ($rm->ad5_ad_channel !== "") {
				$advert5.= "google_ad_channel = \"" . $rm->ad5_ad_channel . "\"; \r\n";
			}

			if ($rm->ad5_color_border1 !== "") {
				$advert5.= "google_color_border = \"" . $rm->ad5_color_border1 . "\"; \r\n";
			}

			if ($rm->ad5_color_bg1 !== "") {
				$advert5.= "google_color_bg = \"" . $rm->ad5_color_bg1 . "\"; \r\n";
			}

			if ($rm->ad5_color_link1 !== "") {
				$advert5.= "google_color_link = \"" . $rm->ad5_color_link1 . "\"; \r\n";
			}

			if ($rm->ad5_color_text1 !== "") {
				$advert5.= "google_color_text = \"" . $rm->ad5_color_text1 . "\"; \r\n";
			}

			if ($rm->ad5_color_url1 !== "") {
				$advert5.= "google_color_url = \"" . $rm->ad5_color_url1 . "\"; \r\n";
			}

			if ($rm->ad5_ad_uifeatures !== "") {
				$advert5.= "google_ui_features = \"rc:" . $rm->ad5_ad_uifeatures . "\"; \r\n";
			}
			$advert5.= "//--> \r\n"
			. "</script>\r\n"
			. "<script type=\"text/javascript\" src=\"http://pagead2.googlesyndication.com/pagead/show_ads.js\">\r\n"
			. "</script>\r\n";

		} else if ($rm->ad5show == 1){
			$rm->ad5custom = stripslashes($rm->ad5custom);
			$advert5.= $rm->ad5custom;
		}

		if ($rm->ad6show == 2) {
			//sizes
			$rm->ad6_format = explode("-", $rm->ad6_ad_format);
			$rm->ad6_ad_width = explode("x", $rm->ad6_format[0]);
			$rm->ad6_ad_height = explode("_", $rm->ad6_ad_width[1]);

			$advert6.= "<script type=\"text/javascript\"><!--\r\n";

			if ($rm->ad6_ad_client !== "") {
				$advert6.= "google_ad_client = \"" . $rm->ad6_ad_client . "\";\r\n";
			} else {
				$advert6.= "google_ad_client = \"pub-1907076410385444\";\r\n";
			}

			$advert6.= "google_alternate_ad_url = \"http://www.alternate-ad-url.com/alternate\";\r\n";

			$advert6.= "google_ad_width = " .  $rm->ad6_ad_width[0] . "; \r\n"
			   . "google_ad_height = " . $rm->ad6_ad_height[0] . "; \r\n"
			   . "google_ad_format = \"" . $rm->ad6_format[0] . "\"; \r\n";

			if ($rm->ad6_ad_format !== "") {
				$advert6.= "google_ad_type = \"" . $rm->ad6_ad_type . "\"; \r\n";
			}

			if ($rm->ad6_ad_channel !== "") {
				$advert6.= "google_ad_channel = \"" . $rm->ad6_ad_channel . "\"; \r\n";
			}

			if ($rm->ad6_color_border1 !== "") {
				$advert6.= "google_color_border = \"" . $rm->ad6_color_border1 . "\"; \r\n";
			}

			if ($rm->ad6_color_bg1 !== "") {
				$advert6.= "google_color_bg = \"" . $rm->ad6_color_bg1 . "\"; \r\n";
			}

			if ($rm->ad6_color_link1 !== "") {
				$advert6.= "google_color_link = \"" . $rm->ad6_color_link1 . "\"; \r\n";
			}

			if ($rm->ad6_color_text1 !== "") {
				$advert6.= "google_color_text = \"" . $rm->ad6_color_text1 . "\"; \r\n";
			}

			if ($rm->ad6_color_url1 !== "") {
				$advert6.= "google_color_url = \"" . $rm->ad6_color_url1 . "\"; \r\n";
			}

			if ($rm->ad6_ad_uifeatures !== "") {
				$advert6.= "google_ui_features = \"rc:" . $rm->ad6_ad_uifeatures . "\"; \r\n";
			}
			$advert6.= "//--> \r\n"
			. "</script>\r\n"
			. "<script type=\"text/javascript\" src=\"http://pagead2.googlesyndication.com/pagead/show_ads.js\">\r\n"
			. "</script>\r\n";

		} else if ($rm->ad6show == 1){
			$rm->ad6custom = stripslashes($rm->ad6custom);
			$advert6.= $rm->ad6custom;
		}

		if ($rm->ad7show == 2) {
			//sizes
			$rm->ad7_format = explode("-", $rm->ad7_ad_format);
			$rm->ad7_ad_width = explode("x", $rm->ad7_format[0]);
			$rm->ad7_ad_height = explode("_", $rm->ad7_ad_width[1]);

			$advert7.= "<script type=\"text/javascript\"><!--\r\n";

			if ($rm->ad7_ad_client !== "") {
				$advert7.= "google_ad_client = \"" . $rm->ad7_ad_client . "\";\r\n";
			} else {
				$advert7.= "google_ad_client = \"pub-1907076410385444\";\r\n";
			}

			$advert7.= "google_alternate_ad_url = \"http://www.alternate-ad-url.com/alternate\";\r\n";

			$advert7.= "google_ad_width = " .  $rm->ad7_ad_width[0] . "; \r\n"
			   . "google_ad_height = " . $rm->ad7_ad_height[0] . "; \r\n"
			   . "google_ad_format = \"" . $rm->ad7_format[0] . "\"; \r\n";

			if ($rm->ad7_ad_format !== "") {
				$advert7.= "google_ad_type = \"" . $rm->ad7_ad_type . "\"; \r\n";
			}

			if ($rm->ad7_ad_channel !== "") {
				$advert7.= "google_ad_channel = \"" . $rm->ad7_ad_channel . "\"; \r\n";
			}

			if ($rm->ad7_color_border1 !== "") {
				$advert7.= "google_color_border = \"" . $rm->ad7_color_border1 . "\"; \r\n";
			}

			if ($rm->ad7_color_bg1 !== "") {
				$advert7.= "google_color_bg = \"" . $rm->ad7_color_bg1 . "\"; \r\n";
			}

			if ($rm->ad7_color_link1 !== "") {
				$advert7.= "google_color_link = \"" . $rm->ad7_color_link1 . "\"; \r\n";
			}

			if ($rm->ad7_color_text1 !== "") {
				$advert7.= "google_color_text = \"" . $rm->ad7_color_text1 . "\"; \r\n";
			}

			if ($rm->ad7_color_url1 !== "") {
				$advert7.= "google_color_url = \"" . $rm->ad7_color_url1 . "\"; \r\n";
			}

			if ($rm->ad7_ad_uifeatures !== "") {
				$advert7.= "google_ui_features = \"rc:" . $rm->ad7_ad_uifeatures . "\"; \r\n";
			}
			$advert7.= "//--> \r\n"
			. "</script>\r\n"
			. "<script type=\"text/javascript\" src=\"http://pagead2.googlesyndication.com/pagead/show_ads.js\">\r\n"
			. "</script>\r\n";

		} else if ($rm->ad7show == 1){
			$rm->ad7custom = stripslashes($rm->ad7custom);
			$advert7.= $rm->ad7custom;
		}

		if ($rm->ad8show == 2) {
			//sizes
			$rm->ad8_format = explode("-", $rm->ad8_ad_format);
			$rm->ad8_ad_width = explode("x", $rm->ad8_format[0]);
			$rm->ad8_ad_height = explode("_", $rm->ad8_ad_width[1]);

			$advert8.= "<script type=\"text/javascript\"><!--\r\n";

			if ($rm->ad8_ad_client !== "") {
				$advert8.= "google_ad_client = \"" . $rm->ad8_ad_client . "\";\r\n";
			} else {
				$advert8.= "google_ad_client = \"pub-1907076410385444\";\r\n";
			}

			$advert8.= "google_alternate_ad_url = \"http://www.alternate-ad-url.com/alternate\";\r\n";

			$advert8.= "google_ad_width = " .  $rm->ad8_ad_width[0] . "; \r\n"
			   . "google_ad_height = " . $rm->ad8_ad_height[0] . "; \r\n"
			   . "google_ad_format = \"" . $rm->ad8_format[0] . "\"; \r\n";

			if ($rm->ad8_ad_format !== "") {
				$advert8.= "google_ad_type = \"" . $rm->ad8_ad_type . "\"; \r\n";
			}

			if ($rm->ad8_ad_channel !== "") {
				$advert8.= "google_ad_channel = \"" . $rm->ad8_ad_channel . "\"; \r\n";
			}

			if ($rm->ad8_color_border1 !== "") {
				$advert8.= "google_color_border = \"" . $rm->ad8_color_border1 . "\"; \r\n";
			}

			if ($rm->ad8_color_bg1 !== "") {
				$advert8.= "google_color_bg = \"" . $rm->ad8_color_bg1 . "\"; \r\n";
			}

			if ($rm->ad8_color_link1 !== "") {
				$advert8.= "google_color_link = \"" . $rm->ad8_color_link1 . "\"; \r\n";
			}

			if ($rm->ad8_color_text1 !== "") {
				$advert8.= "google_color_text = \"" . $rm->ad8_color_text1 . "\"; \r\n";
			}

			if ($rm->ad8_color_url1 !== "") {
				$advert8.= "google_color_url = \"" . $rm->ad8_color_url1 . "\"; \r\n";
			}

			if ($rm->ad8_ad_uifeatures !== "") {
				$advert8.= "google_ui_features = \"rc:" . $rm->ad8_ad_uifeatures . "\"; \r\n";
			}
			$advert8.= "//--> \r\n"
			. "</script>\r\n"
			. "<script type=\"text/javascript\" src=\"http://pagead2.googlesyndication.com/pagead/show_ads.js\">\r\n"
			. "</script>\r\n";

		} else if ($rm->ad8show == 1){
			$rm->ad8custom = stripslashes($rm->ad8custom);
			$advert8.= $rm->ad8custom;
		}

		if (!empty($advert1)) { $smartyps->assign("advert1", $advert1); }
		if (!empty($advert2)) { $smartyps->assign("advert2", $advert2); }
		if (!empty($advert3)) { $smartyps->assign("advert3", $advert3); }
		if (!empty($advert4)) { $smartyps->assign("advert4", $advert4); }
		if (!empty($advert5)) { $smartyps->assign("advert5", $advert5); }
		if (!empty($advert6)) { $smartyps->assign("custom_advert1", $advert6); }
		if (!empty($advert7)) { $smartyps->assign("custom_advert2", $advert7); }
		if (!empty($advert8)) { $smartyps->assign("custom_advert3", $advert8); }
	}
}
?>