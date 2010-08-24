<?php
class hwd_ps_Config{ 

  // Stores the only allowable instance of this class.
  var $instanceConfig = null;

  // Member variables
  var $hwdvids_template_path = 'hwdps-template';
  var $hwdvids_template_file = 'default';
  var $hwdps_slideshow_path = 'hwdps-slideshow';
  var $hwdps_slideshow_file = 'autoviewer';
  var $hwdvids_language_path = 'hwdps-language';
  var $hwdvids_language_file = 'english';
  var $disable_nav_explor = '0';
  var $disable_nav_groups = '0';
  var $disable_nav_upload = '0';
  var $disable_nav_search = '0';
  var $disable_nav_user = '0';
  var $disable_nav_user1 = '0';
  var $disable_nav_user2 = '0';
  var $disable_nav_user3 = '0';
  var $disable_nav_user4 = '0';
  var $disable_nav_user5 = '0';
  var $ppp = '12';
  var $ppr = '3';
  var $app = '12';
  var $apr = '3';
  var $showrate = '1';
  var $showatfb = '1';
  var $showrpmb = '1';
  var $showcoms = '1';
  var $showdesc = '1';
  var $showtags = '1';
  var $showscbm = '1';
  var $showuldr = '0';
  var $mbtu_no = '0';
  var $showa2gb = '1';
  var $showdlor = '1';
  var $ajaxratemeth = '1';
  var $ajaxfavmeth = '1';
  var $ajaxrepmeth = '1';
  var $ajaxa2gmeth = '1';
  var $gpp = '5';
  var $fgpp = '3';
  var $truntitle = '25';
  var $trunpdesc = '70';
  var $trunadesc = '70';
  var $truncdesc = '200';
  var $trungdesc = '70';
  var $sb_digg = 'on';
  var $sb_reddit = 'on';
  var $sb_delicious = 'on';
  var $sb_google = 'on';
  var $sb_live = 'on';
  var $sb_facebook = 'on';
  var $sb_slashdot = 'on';
  var $sb_netscape = 'on';
  var $sb_technorati = 'on';
  var $sb_stumbleupon = 'on';
  var $sb_spurl = 'on';
  var $sb_wists = 'on';
  var $sb_simpy = 'on';
  var $sb_newsvine = 'on';
  var $sb_blinklist = 'on';
  var $sb_furl = 'on';
  var $sb_fark = 'on';
  var $sb_blogmarks = 'on';
  var $sb_yahoo = 'on';
  var $sb_smarking = 'on';
  var $sb_netvouz = 'on';
  var $sb_shadows = 'on';
  var $sb_rawsugar = 'on';
  var $sb_magnolia = 'on';
  var $sb_plugim = 'on';
  var $sb_squidoo = 'on';
  var $sb_blogmemes = 'on';
  var $sb_feedmelinks = 'on';
  var $sb_blinkbits = 'on';
  var $sb_tailrank = 'on';
  var $sb_linkagogo = 'on';
  var $loadmootools = 'on';
  var $loadprototype = 'off';
  var $loadscriptaculous = 'off';
  var $loadswfobject = 'off';
  var $disablecaptcha = '1';
  var $showcredit = '1';
  var $usershare1 = '1';
  var $shareoption1 = '1';
  var $usershare2 = '1';
  var $shareoption2 = '1';
  var $usershare3 = '1';
  var $shareoption3 = '1';
  var $usershare4 = '1';
  var $shareoption4 = '1';
  var $aap = '1';
  var $aaa = '1';
  var $aag = '1';
  var $resize_main = '500';
  var $resize_thumb = '100';
  var $resize_square = '100';
  var $mailphotonotification = '0';
  var $mailalbumnotification = '0';
  var $mailgroupnotification = '0';
  var $mailreportnotification = '0';
  var $mailnotifyaddress = '';
  var $cbint = '0';
  var $cbavatar = '1';
  var $avatarwidth = '61';
  var $cbitemid = '0';
  var $commssys = '0';
  var $gjint = '';
  var $jaclint = '0';
  var $gtree_core = '-2';
  var $gtree_core_child = 'RECURSE';
  var $accesslevel_main = '0,1';
  var $access_method = '0';
  var $initialise_now = '1';
  var $disablejupload = '0';
  var $core_uploadlimit = '50';
  var $gtree_upld = '-1';
  var $gtree_upld_child = 'RECURSE';
  var $upld_cats = '0';
  var $disable_nav_catego = '0';
  var $fp_nos = '4';
  var $fp_noa = '2';
  var $fp_showt = '1';
  var $fp_showg = '1';

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
    $instanceConfig = new hwd_ps_Config;
    return $instanceConfig;
  }

}
?>