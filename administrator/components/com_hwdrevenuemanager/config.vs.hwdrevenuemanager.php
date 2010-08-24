<?php
class hwd_rm_vs_Config{ 

  // Stores the only allowable instance of this class.
  var $instanceConfig = null;

  // Member variables
  var $ad1show = '';
  var $ad1_ad_client = '';
  var $ad1_ad_channel = '';
  var $ad1_ad_type = '';
  var $ad1_ad_uifeatures = '';
  var $ad1_ad_format = '';
  var $ad1_color_border1 = '';
  var $ad1_color_bg1 = '';
  var $ad1_color_link1 = '';
  var $ad1_color_text1 = '';
  var $ad1_color_url1 = '';
  var $ad1custom = '';
  var $ad2show = '';
  var $ad2_ad_client = '';
  var $ad2_ad_channel = '';
  var $ad2_ad_type = '';
  var $ad2_ad_uifeatures = '';
  var $ad2_ad_format = '';
  var $ad2_color_border1 = '';
  var $ad2_color_bg1 = '';
  var $ad2_color_link1 = '';
  var $ad2_color_text1 = '';
  var $ad2_color_url1 = '';
  var $ad2custom = '';
  var $ad3show = '';
  var $ad3_ad_client = '';
  var $ad3_ad_channel = '';
  var $ad3_ad_type = '';
  var $ad3_ad_uifeatures = '';
  var $ad3_ad_format = '';
  var $ad3_color_border1 = '';
  var $ad3_color_bg1 = '';
  var $ad3_color_link1 = '';
  var $ad3_color_text1 = '';
  var $ad3_color_url1 = '';
  var $ad3custom = '';
  var $ad4show = '';
  var $ad4_ad_client = '';
  var $ad4_ad_channel = '';
  var $ad4_ad_type = '';
  var $ad4_ad_uifeatures = '';
  var $ad4_ad_format = '';
  var $ad4_color_border1 = '';
  var $ad4_color_bg1 = '';
  var $ad4_color_link1 = '';
  var $ad4_color_text1 = '';
  var $ad4_color_url1 = '';
  var $ad4custom = '';
  var $ad5show = '';
  var $ad5_ad_client = '';
  var $ad5_ad_channel = '';
  var $ad5_ad_type = '';
  var $ad5_ad_uifeatures = '';
  var $ad5_ad_format = '';
  var $ad5_color_border1 = '';
  var $ad5_color_bg1 = '';
  var $ad5_color_link1 = '';
  var $ad5_color_text1 = '';
  var $ad5_color_url1 = '';
  var $ad5custom = '';
  var $ad6show = '';
  var $ad6_ad_client = '';
  var $ad6_ad_channel = '';
  var $ad6_ad_type = '';
  var $ad6_ad_uifeatures = '';
  var $ad6_ad_format = '';
  var $ad6_color_border1 = '';
  var $ad6_color_bg1 = '';
  var $ad6_color_link1 = '';
  var $ad6_color_text1 = '';
  var $ad6_color_url1 = '';
  var $ad6custom = '';
  var $ad7show = '';
  var $ad7_ad_client = '';
  var $ad7_ad_channel = '';
  var $ad7_ad_type = '';
  var $ad7_ad_uifeatures = '';
  var $ad7_ad_format = '';
  var $ad7_color_border1 = '';
  var $ad7_color_bg1 = '';
  var $ad7_color_link1 = '';
  var $ad7_color_text1 = '';
  var $ad7_color_url1 = '';
  var $ad7custom = '';
  var $ad8show = '';
  var $ad8_ad_client = '';
  var $ad8_ad_channel = '';
  var $ad8_ad_type = '';
  var $ad8_ad_uifeatures = '';
  var $ad8_ad_format = '';
  var $ad8_color_border1 = '';
  var $ad8_color_bg1 = '';
  var $ad8_color_link1 = '';
  var $ad8_color_text1 = '';
  var $ad8_color_url1 = '';
  var $ad8custom = '';
  var $preroll_url = '';
  var $postroll_url = '';
  var $preroll_show = '0';
  var $postroll_show = '0';
  var $enable_longtail = '0';
  var $longtail_channel_default = '';
  var $longtail_d = '';
  var $longtail_s = '';

/**
  * get_instance
  *	Description:
  *		This function is used to instantiate the object
  * 		and ensure only one of this type exists at any
  *		time. It returns a reference to the only Config
  *		instance.
  *	Parameters:
  *		none
  *	Returns:
  *		Config
  **/

  function get_instance(){
    $instanceConfig = new hwd_rm_vs_Config;
    return $instanceConfig;
  }

}
?>