<?php
/**
 *    @version [ Accetto ]
 *    @package hwdPhotoShare
 *    @copyright (C) 2007 - 2009 Highwood Design
 *    @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
 ***
 *    This program is free software: you can redistribute it and/or modify
 *    it under the terms of the GNU General Public License as published by
 *    the Free Software Foundation, either version 3 of the License, or
 *    (at your option) any later version.
 *
 *    This program is distributed in the hope that it will be useful,
 *    but WITHOUT ANY WARRANTY; without even the implied warranty of
 *    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *    GNU General Public License for more details.
 *
 *    You should have received a copy of the GNU General Public License
 *    along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */
defined( '_JEXEC' ) or die( 'Direct Access to this location is not allowed.' );

class hwdps_BE_settings
{
   /**
	*/
	function showgeneralsettings()
	{
		jimport('joomla.user.authorization');
		$acl=& JFactory::getACL();

		$gtree=array();
		$gtree[] = JHTML::_('select.option', -2 , '- ' ._HWDPS_SELECT_EVERYONE . ' -');
		$gtree[] = JHTML::_('select.option', -1, '- ' . _HWDPS_SELECT_ALLREGUSER . ' -');
		$gtree = array_merge( $gtree, $acl->get_group_children_tree( null, 'USERS', false  ) );

		require_once(JPATH_SITE.DS.'administrator'.DS.'components'.DS.'com_hwdphotoshare'.DS.'models'.DS.'settings.php');
		hwd_ps_HTML::showgeneralsettings($gtree);

	}
   /**
	*/
	function savegeneral() {
		global $mainframe;
		$db =& JFactory::getDBO();

		//register globals = off
		if (!empty($_POST)) {
			extract($_POST);
		}

		$cbitemid = intval($cbitemid);
		$hwdvids_language = explode("|", $language);
		$hwdvids_language_file = $hwdvids_language[0];
		$hwdvids_language_path = $hwdvids_language[1];
		$hwdvids_template = explode("|", $template);
		$hwdvids_template_file = $hwdvids_template[0];
		$hwdvids_template_path = $hwdvids_template[1];
		$hwdps_slideshow = explode("|", $slideshow);
		$hwdps_slideshow_file = $hwdps_slideshow[0];
		$hwdps_slideshow_path = $hwdps_slideshow[1];

		$accesslevel_main = @implode(",", $accesslevel_main);
		$accesslevel_upld = @implode(",", $accesslevel_upld);
		$accesslevel_plyr = @implode(",", $accesslevel_plyr);
		$accesslevel_grps = @implode(",", $accesslevel_grps);

		// update server settings db
		$HWDGS['updates'][0] = "UPDATE #__hwdpsgs SET value = '$hwdvids_template_path' WHERE setting = 'hwdvids_template_path'";
		$HWDGS['updates'][1] = "UPDATE #__hwdpsgs SET value = '$hwdvids_template_file' WHERE setting = 'hwdvids_template_file'";
		$HWDGS['updates'][2] = "UPDATE #__hwdpsgs SET value = '$hwdps_slideshow_path' WHERE setting = 'hwdps_slideshow_path'";
		$HWDGS['updates'][3] = "UPDATE #__hwdpsgs SET value = '$hwdps_slideshow_file' WHERE setting = 'hwdps_slideshow_file'";
		$HWDGS['updates'][4] = "UPDATE #__hwdpsgs SET value = '$hwdvids_language_path' WHERE setting = 'hwdvids_language_path'";
		$HWDGS['updates'][5] = "UPDATE #__hwdpsgs SET value = '$hwdvids_language_file' WHERE setting = 'hwdvids_language_file'";
		$HWDGS['updates'][6] = "UPDATE #__hwdpsgs SET value = '$disable_nav_explor' WHERE setting = 'disable_nav_explor'";
		$HWDGS['updates'][7] = "UPDATE #__hwdpsgs SET value = '$disable_nav_groups' WHERE setting = 'disable_nav_groups'";
		$HWDGS['updates'][8] = "UPDATE #__hwdpsgs SET value = '$disable_nav_upload' WHERE setting = 'disable_nav_upload'";
		$HWDGS['updates'][9] = "UPDATE #__hwdpsgs SET value = '$disable_nav_search' WHERE setting = 'disable_nav_search'";
		$HWDGS['updates'][10] = "UPDATE #__hwdpsgs SET value = '$disable_nav_user' WHERE setting = 'disable_nav_user'";
		$HWDGS['updates'][11] = "UPDATE #__hwdpsgs SET value = '$disable_nav_user1' WHERE setting = 'disable_nav_user1'";
		$HWDGS['updates'][12] = "UPDATE #__hwdpsgs SET value = '$disable_nav_user2' WHERE setting = 'disable_nav_user2'";
		$HWDGS['updates'][13] = "UPDATE #__hwdpsgs SET value = '$disable_nav_user3' WHERE setting = 'disable_nav_user3'";
		$HWDGS['updates'][14] = "UPDATE #__hwdpsgs SET value = '$disable_nav_user4' WHERE setting = 'disable_nav_user4'";
		$HWDGS['updates'][15] = "UPDATE #__hwdpsgs SET value = '$disable_nav_user5' WHERE setting = 'disable_nav_user5'";
		$HWDGS['updates'][16] = "UPDATE #__hwdpsgs SET value = '$ppp' WHERE setting = 'ppp'";
		$HWDGS['updates'][17] = "UPDATE #__hwdpsgs SET value = '$ppr' WHERE setting = 'ppr'";
		$HWDGS['updates'][18] = "UPDATE #__hwdpsgs SET value = '$app' WHERE setting = 'app'";
		$HWDGS['updates'][19] = "UPDATE #__hwdpsgs SET value = '$apr' WHERE setting = 'apr'";
		$HWDGS['updates'][20] = "UPDATE #__hwdpsgs SET value = '$showrate' WHERE setting = 'showrate'";
		$HWDGS['updates'][21] = "UPDATE #__hwdpsgs SET value = '$showatfb' WHERE setting = 'showatfb'";
		$HWDGS['updates'][22] = "UPDATE #__hwdpsgs SET value = '$showrpmb' WHERE setting = 'showrpmb'";
		$HWDGS['updates'][23] = "UPDATE #__hwdpsgs SET value = '$showcoms' WHERE setting = 'showcoms'";
		$HWDGS['updates'][24] = "UPDATE #__hwdpsgs SET value = '$showdesc' WHERE setting = 'showdesc'";
		$HWDGS['updates'][25] = "UPDATE #__hwdpsgs SET value = '$showtags' WHERE setting = 'showtags'";
		$HWDGS['updates'][26] = "UPDATE #__hwdpsgs SET value = '$showscbm' WHERE setting = 'showscbm'";
		$HWDGS['updates'][27] = "UPDATE #__hwdpsgs SET value = '$showuldr' WHERE setting = 'showuldr'";
		$HWDGS['updates'][28] = "UPDATE #__hwdpsgs SET value = '$mbtu_no' WHERE setting = 'mbtu_no'";
		$HWDGS['updates'][29] = "UPDATE #__hwdpsgs SET value = '$showa2gb' WHERE setting = 'showa2gb'";
		$HWDGS['updates'][30] = "UPDATE #__hwdpsgs SET value = '$showdlor' WHERE setting = 'showdlor'";
		$HWDGS['updates'][31] = "UPDATE #__hwdpsgs SET value = '$ajaxratemeth' WHERE setting = 'ajaxratemeth'";
		$HWDGS['updates'][32] = "UPDATE #__hwdpsgs SET value = '$ajaxfavmeth' WHERE setting = 'ajaxfavmeth'";
		$HWDGS['updates'][33] = "UPDATE #__hwdpsgs SET value = '$ajaxrepmeth' WHERE setting = 'ajaxrepmeth'";
		$HWDGS['updates'][34] = "UPDATE #__hwdpsgs SET value = '$ajaxa2gmeth' WHERE setting = 'ajaxa2gmeth'";
		$HWDGS['updates'][35] = "UPDATE #__hwdpsgs SET value = '$gpp' WHERE setting = 'gpp'";


		$HWDGS['updates'][37] = "UPDATE #__hwdpsgs SET value = '$truntitle' WHERE setting = 'truntitle'";
		$HWDGS['updates'][38] = "UPDATE #__hwdpsgs SET value = '$trunpdesc' WHERE setting = 'trunpdesc'";
		$HWDGS['updates'][39] = "UPDATE #__hwdpsgs SET value = '$trunadesc' WHERE setting = 'trunadesc'";
		$HWDGS['updates'][40] = "UPDATE #__hwdpsgs SET value = '$truncdesc' WHERE setting = 'truncdesc'";
		$HWDGS['updates'][41] = "UPDATE #__hwdpsgs SET value = '$trungdesc' WHERE setting = 'trungdesc'";
		$HWDGS['updates'][42] = "UPDATE #__hwdpsgs SET value = '$sb_digg' WHERE setting = 'sb_digg'";
		$HWDGS['updates'][43] = "UPDATE #__hwdpsgs SET value = '$sb_reddit' WHERE setting = 'sb_reddit'";
		$HWDGS['updates'][44] = "UPDATE #__hwdpsgs SET value = '$sb_delicious' WHERE setting = 'sb_delicious'";
		$HWDGS['updates'][45] = "UPDATE #__hwdpsgs SET value = '$sb_google' WHERE setting = 'sb_google'";
		$HWDGS['updates'][46] = "UPDATE #__hwdpsgs SET value = '$sb_live' WHERE setting = 'sb_live'";
		$HWDGS['updates'][47] = "UPDATE #__hwdpsgs SET value = '$sb_facebook' WHERE setting = 'sb_facebook'";
		$HWDGS['updates'][48] = "UPDATE #__hwdpsgs SET value = '$sb_slashdot' WHERE setting = 'sb_slashdot'";
		$HWDGS['updates'][49] = "UPDATE #__hwdpsgs SET value = '$sb_netscape' WHERE setting = 'sb_netscape'";
		$HWDGS['updates'][50] = "UPDATE #__hwdpsgs SET value = '$sb_technorati' WHERE setting = 'sb_technorati'";
		$HWDGS['updates'][51] = "UPDATE #__hwdpsgs SET value = '$sb_stumbleupon' WHERE setting = 'sb_stumbleupon'";
		$HWDGS['updates'][52] = "UPDATE #__hwdpsgs SET value = '$sb_spurl' WHERE setting = 'sb_spurl'";
		$HWDGS['updates'][53] = "UPDATE #__hwdpsgs SET value = '$sb_wists' WHERE setting = 'sb_wists'";
		$HWDGS['updates'][54] = "UPDATE #__hwdpsgs SET value = '$sb_simpy' WHERE setting = 'sb_simpy'";
		$HWDGS['updates'][55] = "UPDATE #__hwdpsgs SET value = '$sb_newsvine' WHERE setting = 'sb_newsvine'";
		$HWDGS['updates'][56] = "UPDATE #__hwdpsgs SET value = '$sb_blinklist' WHERE setting = 'sb_blinklist'";
		$HWDGS['updates'][57] = "UPDATE #__hwdpsgs SET value = '$sb_furl' WHERE setting = 'sb_furl'";
		$HWDGS['updates'][58] = "UPDATE #__hwdpsgs SET value = '$sb_fark' WHERE setting = 'sb_fark'";
		$HWDGS['updates'][59] = "UPDATE #__hwdpsgs SET value = '$sb_blogmarks' WHERE setting = 'sb_blogmarks'";
		$HWDGS['updates'][60] = "UPDATE #__hwdpsgs SET value = '$sb_yahoo' WHERE setting = 'sb_yahoo'";
		$HWDGS['updates'][61] = "UPDATE #__hwdpsgs SET value = '$sb_smarking' WHERE setting = 'sb_smarking'";
		$HWDGS['updates'][62] = "UPDATE #__hwdpsgs SET value = '$sb_netvouz' WHERE setting = 'sb_netvouz'";
		$HWDGS['updates'][63] = "UPDATE #__hwdpsgs SET value = '$sb_shadows' WHERE setting = 'sb_shadows'";
		$HWDGS['updates'][64] = "UPDATE #__hwdpsgs SET value = '$sb_rawsugar' WHERE setting = 'sb_rawsugar'";
		$HWDGS['updates'][65] = "UPDATE #__hwdpsgs SET value = '$sb_magnolia' WHERE setting = 'sb_magnolia'";
		$HWDGS['updates'][66] = "UPDATE #__hwdpsgs SET value = '$sb_plugim' WHERE setting = 'sb_plugim'";
		$HWDGS['updates'][67] = "UPDATE #__hwdpsgs SET value = '$sb_squidoo' WHERE setting = 'sb_squidoo'";
		$HWDGS['updates'][68] = "UPDATE #__hwdpsgs SET value = '$sb_blogmemes' WHERE setting = 'sb_blogmemes'";
		$HWDGS['updates'][69] = "UPDATE #__hwdpsgs SET value = '$sb_feedmelinks' WHERE setting = 'sb_feedmelinks'";
		$HWDGS['updates'][70] = "UPDATE #__hwdpsgs SET value = '$sb_blinkbits' WHERE setting = 'sb_blinkbits'";
		$HWDGS['updates'][71] = "UPDATE #__hwdpsgs SET value = '$sb_tailrank' WHERE setting = 'sb_tailrank'";
		$HWDGS['updates'][72] = "UPDATE #__hwdpsgs SET value = '$sb_linkagogo' WHERE setting = 'sb_linkagogo'";
		$HWDGS['updates'][73] = "UPDATE #__hwdpsgs SET value = '$loadmootools' WHERE setting = 'loadmootools'";
		$HWDGS['updates'][74] = "UPDATE #__hwdpsgs SET value = '$loadprototype' WHERE setting = 'loadprototype'";
		$HWDGS['updates'][75] = "UPDATE #__hwdpsgs SET value = '$loadscriptaculous' WHERE setting = 'loadscriptaculous'";
		$HWDGS['updates'][76] = "UPDATE #__hwdpsgs SET value = '$loadswfobject' WHERE setting = 'loadswfobject'";
		$HWDGS['updates'][77] = "UPDATE #__hwdpsgs SET value = '$disablecaptcha' WHERE setting = 'disablecaptcha'";
		$HWDGS['updates'][78] = "UPDATE #__hwdpsgs SET value = '$showcredit' WHERE setting = 'showcredit'";
		$HWDGS['updates'][79] = "UPDATE #__hwdpsgs SET value = '$usershare1' WHERE setting = 'usershare1'";
		$HWDGS['updates'][80] = "UPDATE #__hwdpsgs SET value = '$shareoption1' WHERE setting = 'shareoption1'";
		$HWDGS['updates'][81] = "UPDATE #__hwdpsgs SET value = '$usershare2' WHERE setting = 'usershare2'";
		$HWDGS['updates'][82] = "UPDATE #__hwdpsgs SET value = '$shareoption2' WHERE setting = 'shareoption2'";


		$HWDGS['updates'][85] = "UPDATE #__hwdpsgs SET value = '$usershare4' WHERE setting = 'usershare4'";
		$HWDGS['updates'][86] = "UPDATE #__hwdpsgs SET value = '$shareoption4' WHERE setting = 'shareoption4'";
		$HWDGS['updates'][87] = "UPDATE #__hwdpsgs SET value = '$aap' WHERE setting = 'aap'";
		$HWDGS['updates'][88] = "UPDATE #__hwdpsgs SET value = '$aaa' WHERE setting = 'aaa'";
		$HWDGS['updates'][89] = "UPDATE #__hwdpsgs SET value = '$aag' WHERE setting = 'aag'";
		$HWDGS['updates'][90] = "UPDATE #__hwdpsgs SET value = '$resize_main' WHERE setting = 'resize_main'";
		$HWDGS['updates'][91] = "UPDATE #__hwdpsgs SET value = '$resize_thumb' WHERE setting = 'resize_thumb'";
		$HWDGS['updates'][92] = "UPDATE #__hwdpsgs SET value = '$resize_square' WHERE setting = 'resize_square'";
		$HWDGS['updates'][93] = "UPDATE #__hwdpsgs SET value = '$mailphotonotification' WHERE setting = 'mailphotonotification'";
		$HWDGS['updates'][94] = "UPDATE #__hwdpsgs SET value = '$mailalbumnotification' WHERE setting = 'mailalbumnotification'";
		$HWDGS['updates'][95] = "UPDATE #__hwdpsgs SET value = '$mailgroupnotification' WHERE setting = 'mailgroupnotification'";
		$HWDGS['updates'][96] = "UPDATE #__hwdpsgs SET value = '$mailreportnotification' WHERE setting = 'mailreportnotification'";
		$HWDGS['updates'][97] = "UPDATE #__hwdpsgs SET value = '$mailnotifyaddress' WHERE setting = 'mailnotifyaddress'";
		$HWDGS['updates'][98] = "UPDATE #__hwdpsgs SET value = '$cbint' WHERE setting = 'cbint'";
		$HWDGS['updates'][99] = "UPDATE #__hwdpsgs SET value = '$cbavatar' WHERE setting = 'cbavatar'";
		$HWDGS['updates'][100] = "UPDATE #__hwdpsgs SET value = '$avatarwidth' WHERE setting = 'avatarwidth'";
		$HWDGS['updates'][101] = "UPDATE #__hwdpsgs SET value = '$cbitemid' WHERE setting = 'cbitemid'";
		$HWDGS['updates'][102] = "UPDATE #__hwdpsgs SET value = '$commssys' WHERE setting = 'commssys'";
		$HWDGS['updates'][103] = "UPDATE #__hwdpsgs SET value = '$gjint' WHERE setting = 'gjint'";
		$HWDGS['updates'][104] = "UPDATE #__hwdpsgs SET value = '$jaclint' WHERE setting = 'jaclint'";
		$HWDGS['updates'][105] = "UPDATE #__hwdpsgs SET value = '$gtree_core' WHERE setting = 'gtree_core'";
		$HWDGS['updates'][106] = "UPDATE #__hwdpsgs SET value = '$gtree_core_child' WHERE setting = 'gtree_core_child'";
		$HWDGS['updates'][107] = "UPDATE #__hwdpsgs SET value = '$accesslevel_main' WHERE setting = 'accesslevel_main'";
		$HWDGS['updates'][108] = "UPDATE #__hwdpsgs SET value = '$access_method' WHERE setting = 'access_method'";
		$HWDGS['updates'][109] = "UPDATE #__hwdpsgs SET value = '$initialise_now' WHERE setting = 'initialise_now'";

		$HWDGS['updates'][110] = "UPDATE #__hwdpsgs SET value = '$disablejupload' WHERE setting = 'disablejupload'";
		$HWDGS['updates'][111] = "UPDATE #__hwdpsgs SET value = '$core_uploadlimit' WHERE setting = 'core_uploadlimit'";
		$HWDGS['updates'][112] = "UPDATE #__hwdpsgs SET value = '$gtree_upld' WHERE setting = 'gtree_upld'";
		$HWDGS['updates'][113] = "UPDATE #__hwdpsgs SET value = '$gtree_upld_child' WHERE setting = 'gtree_upld_child'";
		$HWDGS['updates'][114] = "UPDATE #__hwdpsgs SET value = '$upld_cats' WHERE setting = 'upld_cats'";
		$HWDGS['updates'][115] = "UPDATE #__hwdpsgs SET value = '$disable_nav_catego' WHERE setting = 'disable_nav_catego'";

		$HWDGS['updates'][116] = "UPDATE #__hwdpsgs SET value = '$fp_nos' WHERE setting = 'fp_nos'";
		$HWDGS['updates'][117] = "UPDATE #__hwdpsgs SET value = '$fp_noa' WHERE setting = 'fp_noa'";
		$HWDGS['updates'][118] = "UPDATE #__hwdpsgs SET value = '$fp_showt' WHERE setting = 'fp_showt'";
		$HWDGS['updates'][119] = "UPDATE #__hwdpsgs SET value = '$fp_showg' WHERE setting = 'fp_showg'";

		$HWDGS['message'] = "Saving general settings to database";
		// apply
		foreach($HWDGS['updates'] as $UPDT) {
			$db->setQuery($UPDT);
			if(!$db->query()) {
				//Save failed
				print("<font color=red>".$HWDGS['message']." failed! SQL error:" . $db->stderr(true)."</font><br />");
				return;
			}
		}

		$updt_config = hwdps_BE_settings::drawconfig();
		if ($updt_config) {
			$msg = _HWDPS_ALERT_ADMIN_SETSAVED;
			$mainframe->enqueueMessage($msg);
			$mainframe->redirect( JURI::root( true ) . '/administrator/index.php?option=com_hwdphotoshare&task=generalsettings' );
		} else {
			$msg = _HWDPS_ALERT_ADMIN_SETNOTSAVED;
			$mainframe->enqueueMessage($msg);
			$mainframe->redirect( JURI::root( true ) . '/administrator/index.php?option=com_hwdphotoshare&task=generalsettings' );
		}
	}
   /**
	* draw singleton pattern config file
	*/
	function drawconfig()
	{
		global $option;
		$db =& JFactory::getDBO();

		$configfile = "components/com_hwdphotoshare/config.hwdphotoshare.php";
		@chmod ($configfile, 0777);
		$permission = is_writable($configfile);
		if (!$permission) {
			mosRedirect("index.php?option=$option&task=generalsettings", _HWDPS_ALERT_ADMIN_CONFUNWRT. " ");
			break;
		}

		$config = "<?php\n";
		$config .= "class hwd_ps_Config{ \n\n";
		$config .= "  // Stores the only allowable instance of this class.\n";
		$config .= "  var \$instanceConfig = null;\n\n";
		$config .= "  // Member variables\n";
		// print out config
		$query  = 'SELECT *'
				. ' FROM #__hwdpsgs'
				;
				$db->SetQuery($query);
		$rows = $db->loadObjectList();
		for ($i=0, $n=count($rows); $i < $n; $i++) {
			$row = $rows[$i];
			$config .= "  var \$".$row->setting." = '".$row->value."';\n";
		}
		$config .= "\n/**\n";
		$config .= "  * get_instance\n";
		$config .= "  *	Description:\n";
		$config .= "  *		This function is used to instantiate the object\n";
		$config .= "  * 		and ensure only one of this type exists at any\n";
		$config .= "  *		time. It returns a reference to the only Config\n";
		$config .= "  *		instance.\n";
		$config .= "  *	Parameters:\n";
		$config .= "  *		none\n";
		$config .= "  *	Returns:\n";
		$config .= "  *		Config\n";
		$config .= "  **/\n\n";
		$config .= "  function get_instance(){\n";
		$config .= "    \$instanceConfig = new hwd_ps_Config;\n";
		$config .= "    return \$instanceConfig;\n";
		$config .= "  }\n\n";
		$config .= "}\n";
		$config .= "?>";

		if ($fp = fopen("$configfile", "w")) {
			fputs($fp, $config, strlen($config));
			fclose ($fp);
		}

		return true;
	}
}
?>