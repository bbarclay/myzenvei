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
 * @copyright  (C) 2007 - 2009 Highwood Design
 * @license    http://creativecommons.org/licenses/by-nc-nd/3.0/
 * @version    1.1.1
 */
class hwd_rm_html
{
    /**
     * Outputs frontpage HTML
     *
     * @param string $option  the joomla component name
     * @param array  $compatibility  compatibility data
     * @return       Nothing
     */
	function homepage($option, $compatibility)
	{
		?>
		<form action="index.php" method="post" name="adminForm">
		<table cellpadding="0" cellspacing="0" border="0" width="100%" class="adminform">
			<tr>
		  		<td style="background-color: #202626; width:100%; text-align: right; vertical-align: top;" colspan="2">
		  		<img src="<?php echo JURI::root()."/administrator/components/com_hwdrevenuemanager/images/logo.png"; ?>" height="47" width="250" alt="Logo" style="float: left;" />
				<font style="color: #fffffe; font-size: 200%; font-weight: bold;"><?php echo _HWDPS_SECTIONHEAD_HOME; ?></font>
				</td>
			</tr>
  		</table>
  		<div style="border: solid 1px #333;margin:5px 0 5px 0;padding:5px;text-align:left;font-weight:bold;"><?php echo _HWDRM_INFO_CONFIGF4." ".$compatibility[1]; ?></div>
  		<div style="border: solid 1px #333;margin:5px 0 5px 0;padding:5px;text-align:left;font-weight:bold;"><?php echo _HWDRM_INFO_CONFIGF5." ".$compatibility[3]; ?></div>
  		<div style="width:100%;margin-top:5px;text-align:left;">
  			<h3><?php echo _HWDRM_HOME_01; ?></h3>
			<p><?php echo _HWDRM_HOME_02 ?></p>
		</div>
		<div style="clear:both;"></div>
		<input type="hidden" name="option" value="com_hwdrevenuemanager" />
		<input type="hidden" name="task" value="homepage" />
		</form>
		<br />
		<table width="100%"  border="0" cellspacing="0" cellpadding="0" class="adminform">
  			<tr>
    			<td align="center"><center><?php copyright(); ?></center></td>
  			</tr>
		</table>
	<?php
	}
    /**
     * Shows hwdVideoShare revenue information
     *
     * @param string $option  the joomla component name
     * @param array  $compatibility  compatibility data
     * @return       Nothing
     */
	function showvssettings($option, $compatibility)
	{
		global $database;
		$c_v = hwd_rm_vs_Config::get_instance();
		$c_p = hwd_rm_ps_Config::get_instance();
		$db =& JFactory::getDBO();
		jimport('joomla.html.pane');
		$pane =& JPane::getInstance('tabs');
		$startpane = $pane->startPane( 'content-pane' );
		$endtab = $pane->endPanel();
		$endpane = $pane->endPane();
		$starttab1 = $pane->startPanel( _HWDRM_VSAD1, 'panel1' );
		$starttab2 = $pane->startPanel( _HWDRM_VSAD2, 'panel2' );
		$starttab3 = $pane->startPanel( _HWDRM_VSAD3, 'panel3' );
		$starttab4 = $pane->startPanel( _HWDRM_VSAD4, 'panel4' );
		$starttab5 = $pane->startPanel( _HWDRM_VSAD5, 'panel5' );
		$starttab6 = $pane->startPanel( _HWDRM_CUSVSAD1, 'panel6' );
		$starttab7 = $pane->startPanel( _HWDRM_CUSVSAD2, 'panel7' );
		$starttab8 = $pane->startPanel( _HWDRM_CUSVSAD3, 'panel8' );
		?>
		<form action="index.php" method="post" name="adminForm">
		<table cellpadding="0" cellspacing="0" border="0" width="100%" class="adminform">
			<tr>
		  		<td style="background-color: #202626; width:100%; text-align: right; vertical-align: top;" colspan="2">
		  		<img src="<?php echo JURI::root()."/administrator/components/com_hwdrevenuemanager/images/logo.png"; ?>" height="47" width="250" alt="Logo" style="float: left;" />
				<font style="color: #fffffe; font-size: 200%; font-weight: bold;"><?php echo _HWDPS_SECTIONHEAD_HWDVS; ?></font>
				</td>
			</tr>
  		</table>
  		<?php
  		if (is_writable(HWDRM_ADMIN_PATH.'/config.vs.hwdrevenuemanager.php')) {
  			$config_file_status = "<span style=\"color:#458B00;\">"._HWDRM_INFO_CONFIGF2."</span>.";
  		} else {
  			$config_file_status = "<span style=\"color:#ff0000;\">"._HWDRM_INFO_CONFIGF3."</span>. (".HWDRM_ADMIN_PATH."/config.vs.hwdrevenuemanager.php)";
  		}

  		if ($compatibility[0] == "0") {
  		?>
   		<div style="border: solid 1px #333;margin:5px 0 5px 0;padding:5px;text-align:left;font-weight:bold;"><?php echo _HWDRM_INFO_CONFIGF4." ".$compatibility[1]; ?></div>
		<div style="clear:both;"></div>
		<input type="hidden" name="boxchecked" value="0" />
		<input type="hidden" name="option" value="com_hwdrevenuemanager" />
		<input type="hidden" name="task" value="savevssettings" />
		<input type="hidden" name="hidemainmenu" value="0">
		</form>
		<br />
		<table width="100%"  border="0" cellspacing="0" cellpadding="0" class="adminform">
  			<tr>
    			<td align="center"><center><?php copyright(); ?></center></td>
  			</tr>
		</table>
  		<?php
  		} else {
  		?>
  		<div style="border: solid 1px #333;margin:5px 0 5px 0;padding:5px;text-align:left;font-weight:bold;"><?php echo _HWDRM_INFO_CONFIGF1." ".$config_file_status; ?></div>
  		<div style="width:100%;margin-top:5px;text-align:left;">
			<?php
			echo $startpane;
			echo $starttab1;
			?>
			<div style="margin:1px;padding:1px;"><br />
			<table cellpadding="0" cellspacing="0" border="0" width="95%" class="adminform">
			  <tr><td align="left" valign="top" colspan="3">
			  <h3><?php echo _HWDRM_VSADPOS1 ?></h3>
			  <p><?php echo _HWDRM_DOCS ?> <a href="http://documentation.hwdmediashare.co.uk/wiki/Main_Page" target="_blank">http://documentation.hwdmediashare.co.uk/wiki/Main_Page</a></p>
			  </td></tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _HWDRM_SETT_SHOWAD1 ?></b></td>
				<td width="20%" align="left" valign="top">
				<select name="ad1show" size="1" class="inputbox">
					<option value="2"<?php if ($c_v->ad1show == 2) { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_ADSENSE.' '; ?></option>
					<option value="1"<?php if ($c_v->ad1show == 1) { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_CUSTOM.' '; ?></option>
					<option value="0"<?php if ($c_v->ad1show == 0) { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_NO.' '; ?></option>
				</select>
				</td>
				<td width="60%" align="left" valign="top"><?php echo _HWDRM_SETT_SHOWAD1_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _HWDRM_SETT_AD1ADCLIENT ?></b></td>
				<td align="left" valign="top" width="20%"><input type="text" name="ad1_ad_client" value="<?php echo $c_v->ad1_ad_client; ?>" size="40" maxlength="100"></td>
				<td width="60%" align="left" valign="top"><?php echo _HWDRM_SETT_AD1ADCLIENT_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _HWDRM_SETT_AD1ADCHANNEL ?></b></td>
				<td align="left" valign="top" width="20%"><input type="text" name="ad1_ad_channel" value="<?php echo $c_v->ad1_ad_channel; ?>" size="40" maxlength="100"></td>
				<td width="60%" align="left" valign="top"><?php echo _HWDRM_SETT_AD1ADCHANNEL_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _HWDRM_SETT_AD1ADTYPE ?></b></td>
				<td width="20%" align="left" valign="top">
				<select name="ad1_ad_type" size="1" class="inputbox">
					<option value="text_image"<?php if ($c_v->ad1_ad_type == "text_image") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_ADS_TANDI.' '; ?></option>
					<option value="text"<?php if ($c_v->ad1_ad_type == "text") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_ADS_TEXT.' '; ?></option>
					<option value="image"<?php if ($c_v->ad1_ad_type == "image") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_ADS_IMAGE.' '; ?></option>
				</select>
				</td>
				<td width="60%" align="left" valign="top"><?php echo _HWDRM_SETT_AD1ADTYPE_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _HWDRM_SETT_AD1UIF ?></b></td>
				<td width="20%" align="left" valign="top">
				<select name="ad1_ad_uifeatures" size="1" class="inputbox">
					<option value="0"<?php if ($c_v->ad1_ad_uifeatures == 0) { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_ADS_SQUARE.' '; ?></option>
					<option value="6"<?php if ($c_v->ad1_ad_uifeatures == 6) { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_ADS_SR.' '; ?></option>
					<option value="10"<?php if ($c_v->ad1_ad_uifeatures == 10) { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_ADS_VR.' '; ?></option>
				</select>
				</td>
				<td width="60%" align="left" valign="top"><?php echo _HWDRM_SETT_AD1ADUIF_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _HWDRM_SETT_AD1LAYOUT ?></b></td>
				<td width="20%" align="left" valign="top">
				<select name="ad1_ad_format" size="1" class="inputbox">
					<option value="468x60_as"<?php if ($c_v->ad1_ad_format == "468x60_as") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM1.' '; ?></option>
					<option value="234x60_as"<?php if ($c_v->ad1_ad_format == "234x60_as") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM2.' '; ?></option>
					<option value=""> --- </option>
					<option value="120x600_as"<?php if ($c_v->ad1_ad_format == "120x600_as") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM3.' '; ?></option>
					<option value="160x600_as"<?php if ($c_v->ad1_ad_format == "160x600_as") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM4.' '; ?></option>
					<option value="120x240_as"<?php if ($c_v->ad1_ad_format == "120x240_as") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM5.' '; ?></option>
					<option value=""> --- </option>
					<option value="336x280_as"<?php if ($c_v->ad1_ad_format == "336x280_as") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM6.' '; ?></option>
					<option value="300x250_as"<?php if ($c_v->ad1_ad_format == "300x250_as") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM7.' '; ?></option>
					<option value="250x250_as"<?php if ($c_v->ad1_ad_format == "250x250_as") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM8.' '; ?></option>
					<option value="200x200_as"<?php if ($c_v->ad1_ad_format == "200x200_as") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM9.' '; ?></option>
					<option value="180x150_as"<?php if ($c_v->ad1_ad_format == "180x150_as") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM10.' '; ?></option>
					<option value="125x125_as"<?php if ($c_v->ad1_ad_format == "125x125_as") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM11.' '; ?></option>
					<option value=""> --- </option>
					<option value="728x90_as"<?php if ($c_v->ad1_ad_format == "728x90_as") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM12.' '; ?></option>
					<option value=""> --- </option>
					<option value="728x15_0ads_al"<?php if ($c_v->ad1_ad_format == "728x15_0ads_al") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM13.' '; ?></option>
					<option value="468x15_0ads_al"<?php if ($c_v->ad1_ad_format == "468x15_0ads_al") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM14.' '; ?></option>
					<option value="120x90_0ads_al"<?php if ($c_v->ad1_ad_format == "120x90_0ads_al") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM15.' '; ?></option>
					<option value="160x90_0ads_al"<?php if ($c_v->ad1_ad_format == "160x90_0ads_al") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM16.' '; ?></option>
					<option value="180x90_0ads_al"<?php if ($c_v->ad1_ad_format == "180x90_0ads_al") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM17.' '; ?></option>
					<option value="200x90_0ads_al"<?php if ($c_v->ad1_ad_format == "200x90_0ads_al") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM18.' '; ?></option>
					<option value=""> --- </option>
					<option value="728x15_0ads_al_s"<?php if ($c_v->ad1_ad_format == "728x15_0ads_al_s") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM19.' '; ?></option>
					<option value="468x15_0ads_al_s"<?php if ($c_v->ad1_ad_format == "468x15_0ads_al_s") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM20.' '; ?></option>
					<option value="120x90_0ads_al_s"<?php if ($c_v->ad1_ad_format == "120x90_0ads_al_s") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM21.' '; ?></option>
					<option value="160x90_0ads_al_s"<?php if ($c_v->ad1_ad_format == "160x90_0ads_al_s") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM22.' '; ?></option>
					<option value="180x90_0ads_al_s"<?php if ($c_v->ad1_ad_format == "180x90_0ads_al_s") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM23.' '; ?></option>
					<option value="200x90_0ads_al_s"<?php if ($c_v->ad1_ad_format == "200x90_0ads_al_s") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM24.' '; ?></option>
				</select>
				</td>
				<td width="60%" align="left" valign="top"><?php echo _HWDRM_SETT_AD1LAYOUT_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _HWDRM_SETT_AD1ADBORDER ?></b></td>
				<td align="left" valign="top" width="20%"><input type="text" name="ad1_color_border1" value="<?php echo $c_v->ad1_color_border1; ?>" size="40" maxlength="100"></td>
				<td width="60%" align="left" valign="top"><?php echo _HWDRM_SETT_AD1ADBORDER_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _HWDRM_SETT_AD1ADBG ?></b></td>
				<td align="left" valign="top" width="20%"><input type="text" name="ad1_color_bg1" value="<?php echo $c_v->ad1_color_bg1; ?>" size="40" maxlength="100"></td>
				<td width="60%" align="left" valign="top"><?php echo _HWDRM_SETT_AD1ADBG_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _HWDRM_SETT_AD1ADLINK ?></b></td>
				<td align="left" valign="top" width="20%"><input type="text" name="ad1_color_link1" value="<?php echo $c_v->ad1_color_link1; ?>" size="40" maxlength="100"></td>
				<td width="60%" align="left" valign="top"><?php echo _HWDRM_SETT_AD1ADLINK_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _HWDRM_SETT_AD1ADTEXT ?></b></td>
				<td align="left" valign="top" width="20%"><input type="text" name="ad1_color_text1" value="<?php echo $c_v->ad1_color_text1; ?>" size="40" maxlength="100"></td>
				<td width="60%" align="left" valign="top"><?php echo _HWDRM_SETT_AD1ADTEXT_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _HWDRM_SETT_AD1ADURL ?></b></td>
				<td align="left" valign="top" width="20%"><input type="text" name="ad1_color_url1" value="<?php echo $c_v->ad1_color_url1; ?>" size="40" maxlength="100"></td>
				<td width="60%" align="left" valign="top"><?php echo _HWDRM_SETT_AD1ADURL_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _HWDRM_SETT_AD1CUSTOM ?></b></td>
				<td width="20%" align="left" valign="top"><textarea rows="5" name="ad1custom"><?php echo stripslashes($c_v->ad1custom); ?></textarea></td>
				<td width="60%" align="left" valign="top"><?php echo _HWDRM_SETT_AD1CUSTOM_DESC ?></td>
			  </tr>
			</table>
			</div>
			<?php
			echo $endtab;
			echo $starttab2;
			?>
			<div style="margin:1px;padding:1px;"><br />
			<table cellpadding="0" cellspacing="0" border="0" width="95%" class="adminform">
			  <tr><td align="left" valign="top" colspan="3">
			  <h3><?php echo _HWDRM_VSADPOS2 ?></h3>
			  <p><?php echo _HWDRM_DOCS ?> <a href="http://documentation.hwdmediashare.co.uk/wiki/Main_Page" target="_blank">http://documentation.hwdmediashare.co.uk/wiki/Main_Page</a></p>
			  </td></tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _HWDRM_SETT_SHOWAD1 ?></b></td>
				<td width="20%" align="left" valign="top">
				<select name="ad2show" size="1" class="inputbox">
					<option value="2"<?php if ($c_v->ad2show == 2) { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_ADSENSE.' '; ?></option>
					<option value="1"<?php if ($c_v->ad2show == 1) { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_CUSTOM.' '; ?></option>
					<option value="0"<?php if ($c_v->ad2show == 0) { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_NO.' '; ?></option>
				</select>
				</td>
				<td width="60%" align="left" valign="top"><?php echo _HWDRM_SETT_SHOWAD1_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _HWDRM_SETT_AD1ADCLIENT ?></b></td>
				<td align="left" valign="top" width="20%"><input type="text" name="ad2_ad_client" value="<?php echo $c_v->ad2_ad_client; ?>" size="40" maxlength="100"></td>
				<td width="60%" align="left" valign="top"><?php echo _HWDRM_SETT_AD1ADCLIENT_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _HWDRM_SETT_AD1ADCHANNEL ?></b></td>
				<td align="left" valign="top" width="20%"><input type="text" name="ad2_ad_channel" value="<?php echo $c_v->ad2_ad_channel; ?>" size="40" maxlength="100"></td>
				<td width="60%" align="left" valign="top"><?php echo _HWDRM_SETT_AD1ADCHANNEL_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _HWDRM_SETT_AD1ADTYPE ?></b></td>
				<td width="20%" align="left" valign="top">
				<select name="ad2_ad_type" size="1" class="inputbox">
					<option value="text_image"<?php if ($c_v->ad2_ad_type == "text_image") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_ADS_TANDI.' '; ?></option>
					<option value="text"<?php if ($c_v->ad2_ad_type == "text") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_ADS_TEXT.' '; ?></option>
					<option value="image"<?php if ($c_v->ad2_ad_type == "image") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_ADS_IMAGE.' '; ?></option>
				</select>
				</td>
				<td width="60%" align="left" valign="top"><?php echo _HWDRM_SETT_AD1ADTYPE_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _HWDRM_SETT_AD1UIF ?></b></td>
				<td width="20%" align="left" valign="top">
				<select name="ad2_ad_uifeatures" size="1" class="inputbox">
					<option value="0"<?php if ($c_v->ad2_ad_uifeatures == 0) { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_ADS_SQUARE.' '; ?></option>
					<option value="6"<?php if ($c_v->ad2_ad_uifeatures == 6) { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_ADS_SR.' '; ?></option>
					<option value="10"<?php if ($c_v->ad2_ad_uifeatures == 10) { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_ADS_VR.' '; ?></option>
				</select>
				</td>
				<td width="60%" align="left" valign="top"><?php echo _HWDRM_SETT_AD1ADUIF_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _HWDRM_SETT_AD1LAYOUT ?></b></td>
				<td width="20%" align="left" valign="top">
				<select name="ad2_ad_format" size="1" class="inputbox">
					<option value="468x60_as"<?php if ($c_v->ad2_ad_format == "468x60_as") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM1.' '; ?></option>
					<option value="234x60_as"<?php if ($c_v->ad2_ad_format == "234x60_as") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM2.' '; ?></option>
					<option value=""> --- </option>
					<option value="120x600_as"<?php if ($c_v->ad2_ad_format == "120x600_as") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM3.' '; ?></option>
					<option value="160x600_as"<?php if ($c_v->ad2_ad_format == "160x600_as") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM4.' '; ?></option>
					<option value="120x240_as"<?php if ($c_v->ad2_ad_format == "120x240_as") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM5.' '; ?></option>
					<option value=""> --- </option>
					<option value="336x280_as"<?php if ($c_v->ad2_ad_format == "336x280_as") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM6.' '; ?></option>
					<option value="300x250_as"<?php if ($c_v->ad2_ad_format == "300x250_as") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM7.' '; ?></option>
					<option value="250x250_as"<?php if ($c_v->ad2_ad_format == "250x250_as") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM8.' '; ?></option>
					<option value="200x200_as"<?php if ($c_v->ad2_ad_format == "200x200_as") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM9.' '; ?></option>
					<option value="180x150_as"<?php if ($c_v->ad2_ad_format == "180x150_as") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM10.' '; ?></option>
					<option value="125x125_as"<?php if ($c_v->ad2_ad_format == "125x125_as") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM11.' '; ?></option>
					<option value=""> --- </option>
					<option value="728x90_as"<?php if ($c_v->ad2_ad_format == "728x90_as") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM12.' '; ?></option>
					<option value=""> --- </option>
					<option value="728x15_0ads_al"<?php if ($c_v->ad2_ad_format == "728x15_0ads_al") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM13.' '; ?></option>
					<option value="468x15_0ads_al"<?php if ($c_v->ad2_ad_format == "468x15_0ads_al") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM14.' '; ?></option>
					<option value="120x90_0ads_al"<?php if ($c_v->ad2_ad_format == "120x90_0ads_al") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM15.' '; ?></option>
					<option value="160x90_0ads_al"<?php if ($c_v->ad2_ad_format == "160x90_0ads_al") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM16.' '; ?></option>
					<option value="180x90_0ads_al"<?php if ($c_v->ad2_ad_format == "180x90_0ads_al") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM17.' '; ?></option>
					<option value="200x90_0ads_al"<?php if ($c_v->ad2_ad_format == "200x90_0ads_al") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM18.' '; ?></option>
					<option value=""> --- </option>
					<option value="728x15_0ads_al_s"<?php if ($c_v->ad2_ad_format == "728x15_0ads_al_s") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM19.' '; ?></option>
					<option value="468x15_0ads_al_s"<?php if ($c_v->ad2_ad_format == "468x15_0ads_al_s") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM20.' '; ?></option>
					<option value="120x90_0ads_al_s"<?php if ($c_v->ad2_ad_format == "120x90_0ads_al_s") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM21.' '; ?></option>
					<option value="160x90_0ads_al_s"<?php if ($c_v->ad2_ad_format == "160x90_0ads_al_s") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM22.' '; ?></option>
					<option value="180x90_0ads_al_s"<?php if ($c_v->ad2_ad_format == "180x90_0ads_al_s") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM23.' '; ?></option>
					<option value="200x90_0ads_al_s"<?php if ($c_v->ad2_ad_format == "200x90_0ads_al_s") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM24.' '; ?></option>
				</select>
				</td>
				<td width="60%" align="left" valign="top"><?php echo _HWDRM_SETT_AD1LAYOUT_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _HWDRM_SETT_AD1ADBORDER ?></b></td>
				<td align="left" valign="top" width="20%"><input type="text" name="ad2_color_border1" value="<?php echo $c_v->ad2_color_border1; ?>" size="40" maxlength="100"></td>
				<td width="60%" align="left" valign="top"><?php echo _HWDRM_SETT_AD1ADBORDER_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _HWDRM_SETT_AD1ADBG ?></b></td>
				<td align="left" valign="top" width="20%"><input type="text" name="ad2_color_bg1" value="<?php echo $c_v->ad2_color_bg1; ?>" size="40" maxlength="100"></td>
				<td width="60%" align="left" valign="top"><?php echo _HWDRM_SETT_AD1ADBG_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _HWDRM_SETT_AD1ADLINK ?></b></td>
				<td align="left" valign="top" width="20%"><input type="text" name="ad2_color_link1" value="<?php echo $c_v->ad2_color_link1; ?>" size="40" maxlength="100"></td>
				<td width="60%" align="left" valign="top"><?php echo _HWDRM_SETT_AD1ADLINK_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _HWDRM_SETT_AD1ADTEXT ?></b></td>
				<td align="left" valign="top" width="20%"><input type="text" name="ad2_color_text1" value="<?php echo $c_v->ad2_color_text1; ?>" size="40" maxlength="100"></td>
				<td width="60%" align="left" valign="top"><?php echo _HWDRM_SETT_AD1ADTEXT_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _HWDRM_SETT_AD1ADURL ?></b></td>
				<td align="left" valign="top" width="20%"><input type="text" name="ad2_color_url1" value="<?php echo $c_v->ad2_color_url1; ?>" size="40" maxlength="100"></td>
				<td width="60%" align="left" valign="top"><?php echo _HWDRM_SETT_AD1ADURL_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _HWDRM_SETT_AD1CUSTOM ?></b></td>
				<td width="20%" align="left" valign="top"><textarea rows="5" name="ad2custom"><?php echo stripslashes($c_v->ad2custom); ?></textarea></td>
				<td width="60%" align="left" valign="top"><?php echo _HWDRM_SETT_AD1CUSTOM_DESC ?></td>
			  </tr>
			</table>
			</div>
			<?php
			echo $endtab;
			echo $starttab3;
			?>
			<div style="margin:1px;padding:1px;"><br />
			<table cellpadding="0" cellspacing="0" border="0" width="95%" class="adminform">
			  <tr><td align="left" valign="top" colspan="3">
			  <h3><?php echo _HWDRM_VSADPOS3 ?></h3>
			  <p><?php echo _HWDRM_DOCS ?> <a href="http://documentation.hwdmediashare.co.uk/wiki/Main_Page" target="_blank">http://documentation.hwdmediashare.co.uk/wiki/Main_Page</a></p>
			  </td></tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _HWDRM_SETT_SHOWAD1 ?></b></td>
				<td width="20%" align="left" valign="top">
				<select name="ad3show" size="1" class="inputbox">
					<option value="2"<?php if ($c_v->ad3show == 2) { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_ADSENSE.' '; ?></option>
					<option value="1"<?php if ($c_v->ad3show == 1) { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_CUSTOM.' '; ?></option>
					<option value="0"<?php if ($c_v->ad3show == 0) { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_NO.' '; ?></option>
				</select>
				</td>
				<td width="60%" align="left" valign="top"><?php echo _HWDRM_SETT_SHOWAD1_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _HWDRM_SETT_AD1ADCLIENT ?></b></td>
				<td align="left" valign="top" width="20%"><input type="text" name="ad3_ad_client" value="<?php echo $c_v->ad3_ad_client; ?>" size="40" maxlength="100"></td>
				<td width="60%" align="left" valign="top"><?php echo _HWDRM_SETT_AD1ADCLIENT_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _HWDRM_SETT_AD1ADCHANNEL ?></b></td>
				<td align="left" valign="top" width="20%"><input type="text" name="ad3_ad_channel" value="<?php echo $c_v->ad3_ad_channel; ?>" size="40" maxlength="100"></td>
				<td width="60%" align="left" valign="top"><?php echo _HWDRM_SETT_AD1ADCHANNEL_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _HWDRM_SETT_AD1ADTYPE ?></b></td>
				<td width="20%" align="left" valign="top">
				<select name="ad3_ad_type" size="1" class="inputbox">
					<option value="text_image"<?php if ($c_v->ad3_ad_type == "text_image") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_ADS_TANDI.' '; ?></option>
					<option value="text"<?php if ($c_v->ad3_ad_type == "text") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_ADS_TEXT.' '; ?></option>
					<option value="image"<?php if ($c_v->ad3_ad_type == "image") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_ADS_IMAGE.' '; ?></option>
				</select>
				</td>
				<td width="60%" align="left" valign="top"><?php echo _HWDRM_SETT_AD1ADTYPE_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _HWDRM_SETT_AD1UIF ?></b></td>
				<td width="20%" align="left" valign="top">
				<select name="ad3_ad_uifeatures" size="1" class="inputbox">
					<option value="0"<?php if ($c_v->ad3_ad_uifeatures == 0) { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_ADS_SQUARE.' '; ?></option>
					<option value="6"<?php if ($c_v->ad3_ad_uifeatures == 6) { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_ADS_SR.' '; ?></option>
					<option value="10"<?php if ($c_v->ad3_ad_uifeatures == 10) { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_ADS_VR.' '; ?></option>
				</select>
				</td>
				<td width="60%" align="left" valign="top"><?php echo _HWDRM_SETT_AD1ADUIF_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _HWDRM_SETT_AD1LAYOUT ?></b></td>
				<td width="20%" align="left" valign="top">
				<select name="ad3_ad_format" size="1" class="inputbox">
					<option value="468x60_as"<?php if ($c_v->ad3_ad_format == "468x60_as") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM1.' '; ?></option>
					<option value="234x60_as"<?php if ($c_v->ad3_ad_format == "234x60_as") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM2.' '; ?></option>
					<option value=""> --- </option>
					<option value="120x600_as"<?php if ($c_v->ad3_ad_format == "120x600_as") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM3.' '; ?></option>
					<option value="160x600_as"<?php if ($c_v->ad3_ad_format == "160x600_as") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM4.' '; ?></option>
					<option value="120x240_as"<?php if ($c_v->ad3_ad_format == "120x240_as") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM5.' '; ?></option>
					<option value=""> --- </option>
					<option value="336x280_as"<?php if ($c_v->ad3_ad_format == "336x280_as") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM6.' '; ?></option>
					<option value="300x250_as"<?php if ($c_v->ad3_ad_format == "300x250_as") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM7.' '; ?></option>
					<option value="250x250_as"<?php if ($c_v->ad3_ad_format == "250x250_as") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM8.' '; ?></option>
					<option value="200x200_as"<?php if ($c_v->ad3_ad_format == "200x200_as") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM9.' '; ?></option>
					<option value="180x150_as"<?php if ($c_v->ad3_ad_format == "180x150_as") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM10.' '; ?></option>
					<option value="125x125_as"<?php if ($c_v->ad3_ad_format == "125x125_as") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM11.' '; ?></option>
					<option value=""> --- </option>
					<option value="728x90_as"<?php if ($c_v->ad3_ad_format == "728x90_as") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM12.' '; ?></option>
					<option value=""> --- </option>
					<option value="728x15_0ads_al"<?php if ($c_v->ad3_ad_format == "728x15_0ads_al") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM13.' '; ?></option>
					<option value="468x15_0ads_al"<?php if ($c_v->ad3_ad_format == "468x15_0ads_al") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM14.' '; ?></option>
					<option value="120x90_0ads_al"<?php if ($c_v->ad3_ad_format == "120x90_0ads_al") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM15.' '; ?></option>
					<option value="160x90_0ads_al"<?php if ($c_v->ad3_ad_format == "160x90_0ads_al") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM16.' '; ?></option>
					<option value="180x90_0ads_al"<?php if ($c_v->ad3_ad_format == "180x90_0ads_al") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM17.' '; ?></option>
					<option value="200x90_0ads_al"<?php if ($c_v->ad3_ad_format == "200x90_0ads_al") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM18.' '; ?></option>
					<option value=""> --- </option>
					<option value="728x15_0ads_al_s"<?php if ($c_v->ad3_ad_format == "728x15_0ads_al_s") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM19.' '; ?></option>
					<option value="468x15_0ads_al_s"<?php if ($c_v->ad3_ad_format == "468x15_0ads_al_s") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM20.' '; ?></option>
					<option value="120x90_0ads_al_s"<?php if ($c_v->ad3_ad_format == "120x90_0ads_al_s") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM21.' '; ?></option>
					<option value="160x90_0ads_al_s"<?php if ($c_v->ad3_ad_format == "160x90_0ads_al_s") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM22.' '; ?></option>
					<option value="180x90_0ads_al_s"<?php if ($c_v->ad3_ad_format == "180x90_0ads_al_s") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM23.' '; ?></option>
					<option value="200x90_0ads_al_s"<?php if ($c_v->ad3_ad_format == "200x90_0ads_al_s") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM24.' '; ?></option>
				</select>
				</td>
				<td width="60%" align="left" valign="top"><?php echo _HWDRM_SETT_AD1LAYOUT_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _HWDRM_SETT_AD1ADBORDER ?></b></td>
				<td align="left" valign="top" width="20%"><input type="text" name="ad3_color_border1" value="<?php echo $c_v->ad3_color_border1; ?>" size="40" maxlength="100"></td>
				<td width="60%" align="left" valign="top"><?php echo _HWDRM_SETT_AD1ADBORDER_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _HWDRM_SETT_AD1ADBG ?></b></td>
				<td align="left" valign="top" width="20%"><input type="text" name="ad3_color_bg1" value="<?php echo $c_v->ad3_color_bg1; ?>" size="40" maxlength="100"></td>
				<td width="60%" align="left" valign="top"><?php echo _HWDRM_SETT_AD1ADBG_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _HWDRM_SETT_AD1ADLINK ?></b></td>
				<td align="left" valign="top" width="20%"><input type="text" name="ad3_color_link1" value="<?php echo $c_v->ad3_color_link1; ?>" size="40" maxlength="100"></td>
				<td width="60%" align="left" valign="top"><?php echo _HWDRM_SETT_AD1ADLINK_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _HWDRM_SETT_AD1ADTEXT ?></b></td>
				<td align="left" valign="top" width="20%"><input type="text" name="ad3_color_text1" value="<?php echo $c_v->ad3_color_text1; ?>" size="40" maxlength="100"></td>
				<td width="60%" align="left" valign="top"><?php echo _HWDRM_SETT_AD1ADTEXT_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _HWDRM_SETT_AD1ADURL ?></b></td>
				<td align="left" valign="top" width="20%"><input type="text" name="ad3_color_url1" value="<?php echo $c_v->ad3_color_url1; ?>" size="40" maxlength="100"></td>
				<td width="60%" align="left" valign="top"><?php echo _HWDRM_SETT_AD1ADURL_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _HWDRM_SETT_AD1CUSTOM ?></b></td>
				<td width="20%" align="left" valign="top"><textarea rows="5" name="ad3custom"><?php echo stripslashes($c_v->ad3custom); ?></textarea></td>
				<td width="60%" align="left" valign="top"><?php echo _HWDRM_SETT_AD1CUSTOM_DESC ?></td>
			  </tr>
			</table>
			</div>
			<?php
			echo $endtab;
			echo $starttab4;
			?>
			<div style="margin:1px;padding:1px;"><br />
			<table cellpadding="0" cellspacing="0" border="0" width="95%" class="adminform">
			  <tr><td align="left" valign="top" colspan="3">
			  <h3><?php echo _HWDRM_VSADPOS4 ?></h3>
			  <p><?php echo _HWDRM_DOCS ?> <a href="http://documentation.hwdmediashare.co.uk/wiki/Main_Page" target="_blank">http://documentation.hwdmediashare.co.uk/wiki/Main_Page</a></p>
			  </td></tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _HWDRM_SETT_SHOWAD1 ?></b></td>
				<td width="20%" align="left" valign="top">
				<select name="ad4show" size="1" class="inputbox">
					<option value="2"<?php if ($c_v->ad4show == 2) { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_ADSENSE.' '; ?></option>
					<option value="1"<?php if ($c_v->ad4show == 1) { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_CUSTOM.' '; ?></option>
					<option value="0"<?php if ($c_v->ad4show == 0) { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_NO.' '; ?></option>
				</select>
				</td>
				<td width="60%" align="left" valign="top"><?php echo _HWDRM_SETT_SHOWAD1_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _HWDRM_SETT_AD1ADCLIENT ?></b></td>
				<td align="left" valign="top" width="20%"><input type="text" name="ad4_ad_client" value="<?php echo $c_v->ad4_ad_client; ?>" size="40" maxlength="100"></td>
				<td width="60%" align="left" valign="top"><?php echo _HWDRM_SETT_AD1ADCLIENT_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _HWDRM_SETT_AD1ADCHANNEL ?></b></td>
				<td align="left" valign="top" width="20%"><input type="text" name="ad4_ad_channel" value="<?php echo $c_v->ad4_ad_channel; ?>" size="40" maxlength="100"></td>
				<td width="60%" align="left" valign="top"><?php echo _HWDRM_SETT_AD1ADCHANNEL_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _HWDRM_SETT_AD1ADTYPE ?></b></td>
				<td width="20%" align="left" valign="top">
				<select name="ad4_ad_type" size="1" class="inputbox">
					<option value="text_image"<?php if ($c_v->ad4_ad_type == "text_image") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_ADS_TANDI.' '; ?></option>
					<option value="text"<?php if ($c_v->ad4_ad_type == "text") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_ADS_TEXT.' '; ?></option>
					<option value="image"<?php if ($c_v->ad4_ad_type == "image") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_ADS_IMAGE.' '; ?></option>
				</select>
				</td>
				<td width="60%" align="left" valign="top"><?php echo _HWDRM_SETT_AD1ADTYPE_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _HWDRM_SETT_AD1UIF ?></b></td>
				<td width="20%" align="left" valign="top">
				<select name="ad4_ad_uifeatures" size="1" class="inputbox">
					<option value="0"<?php if ($c_v->ad4_ad_uifeatures == 0) { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_ADS_SQUARE.' '; ?></option>
					<option value="6"<?php if ($c_v->ad4_ad_uifeatures == 6) { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_ADS_SR.' '; ?></option>
					<option value="10"<?php if ($c_v->ad4_ad_uifeatures == 10) { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_ADS_VR.' '; ?></option>
				</select>
				</td>
				<td width="60%" align="left" valign="top"><?php echo _HWDRM_SETT_AD1ADUIF_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _HWDRM_SETT_AD1LAYOUT ?></b></td>
				<td width="20%" align="left" valign="top">
				<select name="ad4_ad_format" size="1" class="inputbox">
					<option value="468x60_as"<?php if ($c_v->ad4_ad_format == "468x60_as") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM1.' '; ?></option>
					<option value="234x60_as"<?php if ($c_v->ad4_ad_format == "234x60_as") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM2.' '; ?></option>
					<option value=""> --- </option>
					<option value="120x600_as"<?php if ($c_v->ad4_ad_format == "120x600_as") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM3.' '; ?></option>
					<option value="160x600_as"<?php if ($c_v->ad4_ad_format == "160x600_as") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM4.' '; ?></option>
					<option value="120x240_as"<?php if ($c_v->ad4_ad_format == "120x240_as") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM5.' '; ?></option>
					<option value=""> --- </option>
					<option value="336x280_as"<?php if ($c_v->ad4_ad_format == "336x280_as") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM6.' '; ?></option>
					<option value="300x250_as"<?php if ($c_v->ad4_ad_format == "300x250_as") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM7.' '; ?></option>
					<option value="250x250_as"<?php if ($c_v->ad4_ad_format == "250x250_as") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM8.' '; ?></option>
					<option value="200x200_as"<?php if ($c_v->ad4_ad_format == "200x200_as") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM9.' '; ?></option>
					<option value="180x150_as"<?php if ($c_v->ad4_ad_format == "180x150_as") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM10.' '; ?></option>
					<option value="125x125_as"<?php if ($c_v->ad4_ad_format == "125x125_as") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM11.' '; ?></option>
					<option value=""> --- </option>
					<option value="728x90_as"<?php if ($c_v->ad4_ad_format == "728x90_as") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM12.' '; ?></option>
					<option value=""> --- </option>
					<option value="728x15_0ads_al"<?php if ($c_v->ad4_ad_format == "728x15_0ads_al") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM13.' '; ?></option>
					<option value="468x15_0ads_al"<?php if ($c_v->ad4_ad_format == "468x15_0ads_al") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM14.' '; ?></option>
					<option value="120x90_0ads_al"<?php if ($c_v->ad4_ad_format == "120x90_0ads_al") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM15.' '; ?></option>
					<option value="160x90_0ads_al"<?php if ($c_v->ad4_ad_format == "160x90_0ads_al") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM16.' '; ?></option>
					<option value="180x90_0ads_al"<?php if ($c_v->ad4_ad_format == "180x90_0ads_al") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM17.' '; ?></option>
					<option value="200x90_0ads_al"<?php if ($c_v->ad4_ad_format == "200x90_0ads_al") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM18.' '; ?></option>
					<option value=""> --- </option>
					<option value="728x15_0ads_al_s"<?php if ($c_v->ad4_ad_format == "728x15_0ads_al_s") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM19.' '; ?></option>
					<option value="468x15_0ads_al_s"<?php if ($c_v->ad4_ad_format == "468x15_0ads_al_s") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM20.' '; ?></option>
					<option value="120x90_0ads_al_s"<?php if ($c_v->ad4_ad_format == "120x90_0ads_al_s") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM21.' '; ?></option>
					<option value="160x90_0ads_al_s"<?php if ($c_v->ad4_ad_format == "160x90_0ads_al_s") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM22.' '; ?></option>
					<option value="180x90_0ads_al_s"<?php if ($c_v->ad4_ad_format == "180x90_0ads_al_s") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM23.' '; ?></option>
					<option value="200x90_0ads_al_s"<?php if ($c_v->ad4_ad_format == "200x90_0ads_al_s") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM24.' '; ?></option>
				</select>
				</td>
				<td width="60%" align="left" valign="top"><?php echo _HWDRM_SETT_AD1LAYOUT_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _HWDRM_SETT_AD1ADBORDER ?></b></td>
				<td align="left" valign="top" width="20%"><input type="text" name="ad4_color_border1" value="<?php echo $c_v->ad4_color_border1; ?>" size="40" maxlength="100"></td>
				<td width="60%" align="left" valign="top"><?php echo _HWDRM_SETT_AD1ADBORDER_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _HWDRM_SETT_AD1ADBG ?></b></td>
				<td align="left" valign="top" width="20%"><input type="text" name="ad4_color_bg1" value="<?php echo $c_v->ad4_color_bg1; ?>" size="40" maxlength="100"></td>
				<td width="60%" align="left" valign="top"><?php echo _HWDRM_SETT_AD1ADBG_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _HWDRM_SETT_AD1ADLINK ?></b></td>
				<td align="left" valign="top" width="20%"><input type="text" name="ad4_color_link1" value="<?php echo $c_v->ad4_color_link1; ?>" size="40" maxlength="100"></td>
				<td width="60%" align="left" valign="top"><?php echo _HWDRM_SETT_AD1ADLINK_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _HWDRM_SETT_AD1ADTEXT ?></b></td>
				<td align="left" valign="top" width="20%"><input type="text" name="ad4_color_text1" value="<?php echo $c_v->ad4_color_text1; ?>" size="40" maxlength="100"></td>
				<td width="60%" align="left" valign="top"><?php echo _HWDRM_SETT_AD1ADTEXT_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _HWDRM_SETT_AD1ADURL ?></b></td>
				<td align="left" valign="top" width="20%"><input type="text" name="ad4_color_url1" value="<?php echo $c_v->ad4_color_url1; ?>" size="40" maxlength="100"></td>
				<td width="60%" align="left" valign="top"><?php echo _HWDRM_SETT_AD1ADURL_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _HWDRM_SETT_AD1CUSTOM ?></b></td>
				<td width="20%" align="left" valign="top"><textarea rows="5" name="ad4custom"><?php echo stripslashes($c_v->ad4custom); ?></textarea></td>
				<td width="60%" align="left" valign="top"><?php echo _HWDRM_SETT_AD1CUSTOM_DESC ?></td>
			  </tr>
			</table>
			</div>
			<?php
			echo $endtab;
			echo $starttab5;
			?>
			<div style="margin:1px;padding:1px;"><br />
			<table cellpadding="0" cellspacing="0" border="0" width="95%" class="adminform">
			  <tr><td align="left" valign="top" colspan="3">
			  <h3><?php echo _HWDRM_VSADPOS5 ?></h3>
			  <p><?php echo _HWDRM_DOCS ?> <a href="http://documentation.hwdmediashare.co.uk/wiki/Main_Page" target="_blank">http://documentation.hwdmediashare.co.uk/wiki/Main_Page</a></p>
			  </td></tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _HWDRM_SETT_SHOWAD1 ?></b></td>
				<td width="20%" align="left" valign="top">
				<select name="ad5show" size="1" class="inputbox">
					<option value="2"<?php if ($c_v->ad5show == 2) { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_ADSENSE.' '; ?></option>
					<option value="1"<?php if ($c_v->ad5show == 1) { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_CUSTOM.' '; ?></option>
					<option value="0"<?php if ($c_v->ad5show == 0) { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_NO.' '; ?></option>
				</select>
				</td>
				<td width="60%" align="left" valign="top"><?php echo _HWDRM_SETT_SHOWAD1_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _HWDRM_SETT_AD1ADCLIENT ?></b></td>
				<td align="left" valign="top" width="20%"><input type="text" name="ad5_ad_client" value="<?php echo $c_v->ad5_ad_client; ?>" size="40" maxlength="100"></td>
				<td width="60%" align="left" valign="top"><?php echo _HWDRM_SETT_AD1ADCLIENT_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _HWDRM_SETT_AD1ADCHANNEL ?></b></td>
				<td align="left" valign="top" width="20%"><input type="text" name="ad5_ad_channel" value="<?php echo $c_v->ad5_ad_channel; ?>" size="40" maxlength="100"></td>
				<td width="60%" align="left" valign="top"><?php echo _HWDRM_SETT_AD1ADCHANNEL_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _HWDRM_SETT_AD1ADTYPE ?></b></td>
				<td width="20%" align="left" valign="top">
				<select name="ad5_ad_type" size="1" class="inputbox">
					<option value="text_image"<?php if ($c_v->ad5_ad_type == "text_image") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_ADS_TANDI.' '; ?></option>
					<option value="text"<?php if ($c_v->ad5_ad_type == "text") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_ADS_TEXT.' '; ?></option>
					<option value="image"<?php if ($c_v->ad5_ad_type == "image") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_ADS_IMAGE.' '; ?></option>
				</select>
				</td>
				<td width="60%" align="left" valign="top"><?php echo _HWDRM_SETT_AD1ADTYPE_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _HWDRM_SETT_AD1UIF ?></b></td>
				<td width="20%" align="left" valign="top">
				<select name="ad5_ad_uifeatures" size="1" class="inputbox">
					<option value="0"<?php if ($c_v->ad5_ad_uifeatures == 0) { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_ADS_SQUARE.' '; ?></option>
					<option value="6"<?php if ($c_v->ad5_ad_uifeatures == 6) { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_ADS_SR.' '; ?></option>
					<option value="10"<?php if ($c_v->ad5_ad_uifeatures == 10) { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_ADS_VR.' '; ?></option>
				</select>
				</td>
				<td width="60%" align="left" valign="top"><?php echo _HWDRM_SETT_AD1ADUIF_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _HWDRM_SETT_AD1LAYOUT ?></b></td>
				<td width="20%" align="left" valign="top">
				<select name="ad5_ad_format" size="1" class="inputbox">
					<option value="468x60_as"<?php if ($c_v->ad5_ad_format == "468x60_as") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM1.' '; ?></option>
					<option value="234x60_as"<?php if ($c_v->ad5_ad_format == "234x60_as") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM2.' '; ?></option>
					<option value=""> --- </option>
					<option value="120x600_as"<?php if ($c_v->ad5_ad_format == "120x600_as") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM3.' '; ?></option>
					<option value="160x600_as"<?php if ($c_v->ad5_ad_format == "160x600_as") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM4.' '; ?></option>
					<option value="120x240_as"<?php if ($c_v->ad5_ad_format == "120x240_as") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM5.' '; ?></option>
					<option value=""> --- </option>
					<option value="336x280_as"<?php if ($c_v->ad5_ad_format == "336x280_as") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM6.' '; ?></option>
					<option value="300x250_as"<?php if ($c_v->ad5_ad_format == "300x250_as") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM7.' '; ?></option>
					<option value="250x250_as"<?php if ($c_v->ad5_ad_format == "250x250_as") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM8.' '; ?></option>
					<option value="200x200_as"<?php if ($c_v->ad5_ad_format == "200x200_as") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM9.' '; ?></option>
					<option value="180x150_as"<?php if ($c_v->ad5_ad_format == "180x150_as") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM10.' '; ?></option>
					<option value="125x125_as"<?php if ($c_v->ad5_ad_format == "125x125_as") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM11.' '; ?></option>
					<option value=""> --- </option>
					<option value="728x90_as"<?php if ($c_v->ad5_ad_format == "728x90_as") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM12.' '; ?></option>
					<option value=""> --- </option>
					<option value="728x15_0ads_al"<?php if ($c_v->ad5_ad_format == "728x15_0ads_al") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM13.' '; ?></option>
					<option value="468x15_0ads_al"<?php if ($c_v->ad5_ad_format == "468x15_0ads_al") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM14.' '; ?></option>
					<option value="120x90_0ads_al"<?php if ($c_v->ad5_ad_format == "120x90_0ads_al") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM15.' '; ?></option>
					<option value="160x90_0ads_al"<?php if ($c_v->ad5_ad_format == "160x90_0ads_al") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM16.' '; ?></option>
					<option value="180x90_0ads_al"<?php if ($c_v->ad5_ad_format == "180x90_0ads_al") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM17.' '; ?></option>
					<option value="200x90_0ads_al"<?php if ($c_v->ad5_ad_format == "200x90_0ads_al") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM18.' '; ?></option>
					<option value=""> --- </option>
					<option value="728x15_0ads_al_s"<?php if ($c_v->ad5_ad_format == "728x15_0ads_al_s") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM19.' '; ?></option>
					<option value="468x15_0ads_al_s"<?php if ($c_v->ad5_ad_format == "468x15_0ads_al_s") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM20.' '; ?></option>
					<option value="120x90_0ads_al_s"<?php if ($c_v->ad5_ad_format == "120x90_0ads_al_s") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM21.' '; ?></option>
					<option value="160x90_0ads_al_s"<?php if ($c_v->ad5_ad_format == "160x90_0ads_al_s") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM22.' '; ?></option>
					<option value="180x90_0ads_al_s"<?php if ($c_v->ad5_ad_format == "180x90_0ads_al_s") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM23.' '; ?></option>
					<option value="200x90_0ads_al_s"<?php if ($c_v->ad5_ad_format == "200x90_0ads_al_s") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM24.' '; ?></option>
				</select>
				</td>
				<td width="60%" align="left" valign="top"><?php echo _HWDRM_SETT_AD1LAYOUT_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _HWDRM_SETT_AD1ADBORDER ?></b></td>
				<td align="left" valign="top" width="20%"><input type="text" name="ad5_color_border1" value="<?php echo $c_v->ad5_color_border1; ?>" size="40" maxlength="100"></td>
				<td width="60%" align="left" valign="top"><?php echo _HWDRM_SETT_AD1ADBORDER_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _HWDRM_SETT_AD1ADBG ?></b></td>
				<td align="left" valign="top" width="20%"><input type="text" name="ad5_color_bg1" value="<?php echo $c_v->ad5_color_bg1; ?>" size="40" maxlength="100"></td>
				<td width="60%" align="left" valign="top"><?php echo _HWDRM_SETT_AD1ADBG_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _HWDRM_SETT_AD1ADLINK ?></b></td>
				<td align="left" valign="top" width="20%"><input type="text" name="ad5_color_link1" value="<?php echo $c_v->ad5_color_link1; ?>" size="40" maxlength="100"></td>
				<td width="60%" align="left" valign="top"><?php echo _HWDRM_SETT_AD1ADLINK_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _HWDRM_SETT_AD1ADTEXT ?></b></td>
				<td align="left" valign="top" width="20%"><input type="text" name="ad5_color_text1" value="<?php echo $c_v->ad5_color_text1; ?>" size="40" maxlength="100"></td>
				<td width="60%" align="left" valign="top"><?php echo _HWDRM_SETT_AD1ADTEXT_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _HWDRM_SETT_AD1ADURL ?></b></td>
				<td align="left" valign="top" width="20%"><input type="text" name="ad5_color_url1" value="<?php echo $c_v->ad5_color_url1; ?>" size="40" maxlength="100"></td>
				<td width="60%" align="left" valign="top"><?php echo _HWDRM_SETT_AD1ADURL_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _HWDRM_SETT_AD1CUSTOM ?></b></td>
				<td width="20%" align="left" valign="top"><textarea rows="5" name="ad5custom"><?php echo stripslashes($c_v->ad5custom); ?></textarea></td>
				<td width="60%" align="left" valign="top"><?php echo _HWDRM_SETT_AD1CUSTOM_DESC ?></td>
			  </tr>
			</table>
			</div>
			<?php
			echo $endtab;
			echo $starttab6;
			?>
			<div style="margin:1px;padding:1px;"><br />
			<table cellpadding="0" cellspacing="0" border="0" width="95%" class="adminform">
			  <tr><td align="left" valign="top" colspan="3">
			  <h3><?php echo _HWDRM_VSADCUSPOS1 ?></h3>
			  <p><?php echo _HWDRM_DOCS ?> <a href="http://documentation.hwdmediashare.co.uk/wiki/Main_Page" target="_blank">http://documentation.hwdmediashare.co.uk/wiki/Main_Page</a></p>
			  </td></tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _HWDRM_SETT_SHOWAD1 ?></b></td>
				<td width="20%" align="left" valign="top">
				<select name="ad6show" size="1" class="inputbox">
					<option value="2"<?php if ($c_v->ad6show == 2) { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_ADSENSE.' '; ?></option>
					<option value="1"<?php if ($c_v->ad6show == 1) { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_CUSTOM.' '; ?></option>
					<option value="0"<?php if ($c_v->ad6show == 0) { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_NO.' '; ?></option>
				</select>
				</td>
				<td width="60%" align="left" valign="top"><?php echo _HWDRM_SETT_SHOWAD1_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _HWDRM_SETT_AD1ADCLIENT ?></b></td>
				<td align="left" valign="top" width="20%"><input type="text" name="ad6_ad_client" value="<?php echo $c_v->ad6_ad_client; ?>" size="40" maxlength="100"></td>
				<td width="60%" align="left" valign="top"><?php echo _HWDRM_SETT_AD1ADCLIENT_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _HWDRM_SETT_AD1ADCHANNEL ?></b></td>
				<td align="left" valign="top" width="20%"><input type="text" name="ad6_ad_channel" value="<?php echo $c_v->ad6_ad_channel; ?>" size="40" maxlength="100"></td>
				<td width="60%" align="left" valign="top"><?php echo _HWDRM_SETT_AD1ADCHANNEL_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _HWDRM_SETT_AD1ADTYPE ?></b></td>
				<td width="20%" align="left" valign="top">
				<select name="ad6_ad_type" size="1" class="inputbox">
					<option value="text_image"<?php if ($c_v->ad6_ad_type == "text_image") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_ADS_TANDI.' '; ?></option>
					<option value="text"<?php if ($c_v->ad6_ad_type == "text") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_ADS_TEXT.' '; ?></option>
					<option value="image"<?php if ($c_v->ad6_ad_type == "image") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_ADS_IMAGE.' '; ?></option>
				</select>
				</td>
				<td width="60%" align="left" valign="top"><?php echo _HWDRM_SETT_AD1ADTYPE_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _HWDRM_SETT_AD1UIF ?></b></td>
				<td width="20%" align="left" valign="top">
				<select name="ad6_ad_uifeatures" size="1" class="inputbox">
					<option value="0"<?php if ($c_v->ad6_ad_uifeatures == 0) { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_ADS_SQUARE.' '; ?></option>
					<option value="6"<?php if ($c_v->ad6_ad_uifeatures == 6) { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_ADS_SR.' '; ?></option>
					<option value="10"<?php if ($c_v->ad6_ad_uifeatures == 10) { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_ADS_VR.' '; ?></option>
				</select>
				</td>
				<td width="60%" align="left" valign="top"><?php echo _HWDRM_SETT_AD1ADUIF_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _HWDRM_SETT_AD1LAYOUT ?></b></td>
				<td width="20%" align="left" valign="top">
				<select name="ad6_ad_format" size="1" class="inputbox">
					<option value="468x60_as"<?php if ($c_v->ad6_ad_format == "468x60_as") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM1.' '; ?></option>
					<option value="234x60_as"<?php if ($c_v->ad6_ad_format == "234x60_as") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM2.' '; ?></option>
					<option value=""> --- </option>
					<option value="120x600_as"<?php if ($c_v->ad6_ad_format == "120x600_as") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM3.' '; ?></option>
					<option value="160x600_as"<?php if ($c_v->ad6_ad_format == "160x600_as") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM4.' '; ?></option>
					<option value="120x240_as"<?php if ($c_v->ad6_ad_format == "120x240_as") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM5.' '; ?></option>
					<option value=""> --- </option>
					<option value="336x280_as"<?php if ($c_v->ad6_ad_format == "336x280_as") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM6.' '; ?></option>
					<option value="300x250_as"<?php if ($c_v->ad6_ad_format == "300x250_as") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM7.' '; ?></option>
					<option value="250x250_as"<?php if ($c_v->ad6_ad_format == "250x250_as") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM8.' '; ?></option>
					<option value="200x200_as"<?php if ($c_v->ad6_ad_format == "200x200_as") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM9.' '; ?></option>
					<option value="180x150_as"<?php if ($c_v->ad6_ad_format == "180x150_as") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM10.' '; ?></option>
					<option value="125x125_as"<?php if ($c_v->ad6_ad_format == "125x125_as") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM11.' '; ?></option>
					<option value=""> --- </option>
					<option value="728x90_as"<?php if ($c_v->ad6_ad_format == "728x90_as") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM12.' '; ?></option>
					<option value=""> --- </option>
					<option value="728x15_0ads_al"<?php if ($c_v->ad6_ad_format == "728x15_0ads_al") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM13.' '; ?></option>
					<option value="468x15_0ads_al"<?php if ($c_v->ad6_ad_format == "468x15_0ads_al") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM14.' '; ?></option>
					<option value="120x90_0ads_al"<?php if ($c_v->ad6_ad_format == "120x90_0ads_al") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM15.' '; ?></option>
					<option value="160x90_0ads_al"<?php if ($c_v->ad6_ad_format == "160x90_0ads_al") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM16.' '; ?></option>
					<option value="180x90_0ads_al"<?php if ($c_v->ad6_ad_format == "180x90_0ads_al") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM17.' '; ?></option>
					<option value="200x90_0ads_al"<?php if ($c_v->ad6_ad_format == "200x90_0ads_al") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM18.' '; ?></option>
					<option value=""> --- </option>
					<option value="728x15_0ads_al_s"<?php if ($c_v->ad6_ad_format == "728x15_0ads_al_s") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM19.' '; ?></option>
					<option value="468x15_0ads_al_s"<?php if ($c_v->ad6_ad_format == "468x15_0ads_al_s") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM20.' '; ?></option>
					<option value="120x90_0ads_al_s"<?php if ($c_v->ad6_ad_format == "120x90_0ads_al_s") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM21.' '; ?></option>
					<option value="160x90_0ads_al_s"<?php if ($c_v->ad6_ad_format == "160x90_0ads_al_s") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM22.' '; ?></option>
					<option value="180x90_0ads_al_s"<?php if ($c_v->ad6_ad_format == "180x90_0ads_al_s") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM23.' '; ?></option>
					<option value="200x90_0ads_al_s"<?php if ($c_v->ad6_ad_format == "200x90_0ads_al_s") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM24.' '; ?></option>
				</select>
				</td>
				<td width="60%" align="left" valign="top"><?php echo _HWDRM_SETT_AD1LAYOUT_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _HWDRM_SETT_AD1ADBORDER ?></b></td>
				<td align="left" valign="top" width="20%"><input type="text" name="ad6_color_border1" value="<?php echo $c_v->ad6_color_border1; ?>" size="40" maxlength="100"></td>
				<td width="60%" align="left" valign="top"><?php echo _HWDRM_SETT_AD1ADBORDER_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _HWDRM_SETT_AD1ADBG ?></b></td>
				<td align="left" valign="top" width="20%"><input type="text" name="ad6_color_bg1" value="<?php echo $c_v->ad6_color_bg1; ?>" size="40" maxlength="100"></td>
				<td width="60%" align="left" valign="top"><?php echo _HWDRM_SETT_AD1ADBG_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _HWDRM_SETT_AD1ADLINK ?></b></td>
				<td align="left" valign="top" width="20%"><input type="text" name="ad6_color_link1" value="<?php echo $c_v->ad6_color_link1; ?>" size="40" maxlength="100"></td>
				<td width="60%" align="left" valign="top"><?php echo _HWDRM_SETT_AD1ADLINK_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _HWDRM_SETT_AD1ADTEXT ?></b></td>
				<td align="left" valign="top" width="20%"><input type="text" name="ad6_color_text1" value="<?php echo $c_v->ad6_color_text1; ?>" size="40" maxlength="100"></td>
				<td width="60%" align="left" valign="top"><?php echo _HWDRM_SETT_AD1ADTEXT_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _HWDRM_SETT_AD1ADURL ?></b></td>
				<td align="left" valign="top" width="20%"><input type="text" name="ad6_color_url1" value="<?php echo $c_v->ad6_color_url1; ?>" size="40" maxlength="100"></td>
				<td width="60%" align="left" valign="top"><?php echo _HWDRM_SETT_AD1ADURL_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _HWDRM_SETT_AD1CUSTOM ?></b></td>
				<td width="20%" align="left" valign="top"><textarea rows="5" name="ad6custom"><?php echo stripslashes($c_v->ad6custom); ?></textarea></td>
				<td width="60%" align="left" valign="top"><?php echo _HWDRM_SETT_AD1CUSTOM_DESC ?></td>
			  </tr>
			</table>
			</div>
			<?php
			echo $endtab;
			echo $starttab7;
			?>
			<div style="margin:1px;padding:1px;"><br />
			<table cellpadding="0" cellspacing="0" border="0" width="95%" class="adminform">
			  <tr><td align="left" valign="top" colspan="3">
			  <h3><?php echo _HWDRM_VSADCUSPOS2 ?></h3>
			  <p><?php echo _HWDRM_DOCS ?> <a href="http://documentation.hwdmediashare.co.uk/wiki/Main_Page" target="_blank">http://documentation.hwdmediashare.co.uk/wiki/Main_Page</a></p>
			  </td></tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _HWDRM_SETT_SHOWAD1 ?></b></td>
				<td width="20%" align="left" valign="top">
				<select name="ad7show" size="1" class="inputbox">
					<option value="2"<?php if ($c_v->ad7show == 2) { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_ADSENSE.' '; ?></option>
					<option value="1"<?php if ($c_v->ad7show == 1) { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_CUSTOM.' '; ?></option>
					<option value="0"<?php if ($c_v->ad7show == 0) { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_NO.' '; ?></option>
				</select>
				</td>
				<td width="60%" align="left" valign="top"><?php echo _HWDRM_SETT_SHOWAD1_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _HWDRM_SETT_AD1ADCLIENT ?></b></td>
				<td align="left" valign="top" width="20%"><input type="text" name="ad7_ad_client" value="<?php echo $c_v->ad7_ad_client; ?>" size="40" maxlength="100"></td>
				<td width="60%" align="left" valign="top"><?php echo _HWDRM_SETT_AD1ADCLIENT_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _HWDRM_SETT_AD1ADCHANNEL ?></b></td>
				<td align="left" valign="top" width="20%"><input type="text" name="ad7_ad_channel" value="<?php echo $c_v->ad7_ad_channel; ?>" size="40" maxlength="100"></td>
				<td width="60%" align="left" valign="top"><?php echo _HWDRM_SETT_AD1ADCHANNEL_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _HWDRM_SETT_AD1ADTYPE ?></b></td>
				<td width="20%" align="left" valign="top">
				<select name="ad7_ad_type" size="1" class="inputbox">
					<option value="text_image"<?php if ($c_v->ad7_ad_type == "text_image") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_ADS_TANDI.' '; ?></option>
					<option value="text"<?php if ($c_v->ad7_ad_type == "text") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_ADS_TEXT.' '; ?></option>
					<option value="image"<?php if ($c_v->ad7_ad_type == "image") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_ADS_IMAGE.' '; ?></option>
				</select>
				</td>
				<td width="60%" align="left" valign="top"><?php echo _HWDRM_SETT_AD1ADTYPE_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _HWDRM_SETT_AD1UIF ?></b></td>
				<td width="20%" align="left" valign="top">
				<select name="ad7_ad_uifeatures" size="1" class="inputbox">
					<option value="0"<?php if ($c_v->ad7_ad_uifeatures == 0) { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_ADS_SQUARE.' '; ?></option>
					<option value="6"<?php if ($c_v->ad7_ad_uifeatures == 6) { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_ADS_SR.' '; ?></option>
					<option value="10"<?php if ($c_v->ad7_ad_uifeatures == 10) { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_ADS_VR.' '; ?></option>
				</select>
				</td>
				<td width="60%" align="left" valign="top"><?php echo _HWDRM_SETT_AD1ADUIF_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _HWDRM_SETT_AD1LAYOUT ?></b></td>
				<td width="20%" align="left" valign="top">
				<select name="ad7_ad_format" size="1" class="inputbox">
					<option value="468x60_as"<?php if ($c_v->ad7_ad_format == "468x60_as") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM1.' '; ?></option>
					<option value="234x60_as"<?php if ($c_v->ad7_ad_format == "234x60_as") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM2.' '; ?></option>
					<option value=""> --- </option>
					<option value="120x600_as"<?php if ($c_v->ad7_ad_format == "120x600_as") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM3.' '; ?></option>
					<option value="160x600_as"<?php if ($c_v->ad7_ad_format == "160x600_as") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM4.' '; ?></option>
					<option value="120x240_as"<?php if ($c_v->ad7_ad_format == "120x240_as") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM5.' '; ?></option>
					<option value=""> --- </option>
					<option value="336x280_as"<?php if ($c_v->ad7_ad_format == "336x280_as") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM6.' '; ?></option>
					<option value="300x250_as"<?php if ($c_v->ad7_ad_format == "300x250_as") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM7.' '; ?></option>
					<option value="250x250_as"<?php if ($c_v->ad7_ad_format == "250x250_as") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM8.' '; ?></option>
					<option value="200x200_as"<?php if ($c_v->ad7_ad_format == "200x200_as") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM9.' '; ?></option>
					<option value="180x150_as"<?php if ($c_v->ad7_ad_format == "180x150_as") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM10.' '; ?></option>
					<option value="125x125_as"<?php if ($c_v->ad7_ad_format == "125x125_as") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM11.' '; ?></option>
					<option value=""> --- </option>
					<option value="728x90_as"<?php if ($c_v->ad7_ad_format == "728x90_as") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM12.' '; ?></option>
					<option value=""> --- </option>
					<option value="728x15_0ads_al"<?php if ($c_v->ad7_ad_format == "728x15_0ads_al") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM13.' '; ?></option>
					<option value="468x15_0ads_al"<?php if ($c_v->ad7_ad_format == "468x15_0ads_al") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM14.' '; ?></option>
					<option value="120x90_0ads_al"<?php if ($c_v->ad7_ad_format == "120x90_0ads_al") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM15.' '; ?></option>
					<option value="160x90_0ads_al"<?php if ($c_v->ad7_ad_format == "160x90_0ads_al") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM16.' '; ?></option>
					<option value="180x90_0ads_al"<?php if ($c_v->ad7_ad_format == "180x90_0ads_al") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM17.' '; ?></option>
					<option value="200x90_0ads_al"<?php if ($c_v->ad7_ad_format == "200x90_0ads_al") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM18.' '; ?></option>
					<option value=""> --- </option>
					<option value="728x15_0ads_al_s"<?php if ($c_v->ad7_ad_format == "728x15_0ads_al_s") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM19.' '; ?></option>
					<option value="468x15_0ads_al_s"<?php if ($c_v->ad7_ad_format == "468x15_0ads_al_s") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM20.' '; ?></option>
					<option value="120x90_0ads_al_s"<?php if ($c_v->ad7_ad_format == "120x90_0ads_al_s") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM21.' '; ?></option>
					<option value="160x90_0ads_al_s"<?php if ($c_v->ad7_ad_format == "160x90_0ads_al_s") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM22.' '; ?></option>
					<option value="180x90_0ads_al_s"<?php if ($c_v->ad7_ad_format == "180x90_0ads_al_s") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM23.' '; ?></option>
					<option value="200x90_0ads_al_s"<?php if ($c_v->ad7_ad_format == "200x90_0ads_al_s") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM24.' '; ?></option>
				</select>
				</td>
				<td width="60%" align="left" valign="top"><?php echo _HWDRM_SETT_AD1LAYOUT_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _HWDRM_SETT_AD1ADBORDER ?></b></td>
				<td align="left" valign="top" width="20%"><input type="text" name="ad7_color_border1" value="<?php echo $c_v->ad7_color_border1; ?>" size="40" maxlength="100"></td>
				<td width="60%" align="left" valign="top"><?php echo _HWDRM_SETT_AD1ADBORDER_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _HWDRM_SETT_AD1ADBG ?></b></td>
				<td align="left" valign="top" width="20%"><input type="text" name="ad7_color_bg1" value="<?php echo $c_v->ad7_color_bg1; ?>" size="40" maxlength="100"></td>
				<td width="60%" align="left" valign="top"><?php echo _HWDRM_SETT_AD1ADBG_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _HWDRM_SETT_AD1ADLINK ?></b></td>
				<td align="left" valign="top" width="20%"><input type="text" name="ad7_color_link1" value="<?php echo $c_v->ad7_color_link1; ?>" size="40" maxlength="100"></td>
				<td width="60%" align="left" valign="top"><?php echo _HWDRM_SETT_AD1ADLINK_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _HWDRM_SETT_AD1ADTEXT ?></b></td>
				<td align="left" valign="top" width="20%"><input type="text" name="ad7_color_text1" value="<?php echo $c_v->ad7_color_text1; ?>" size="40" maxlength="100"></td>
				<td width="60%" align="left" valign="top"><?php echo _HWDRM_SETT_AD1ADTEXT_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _HWDRM_SETT_AD1ADURL ?></b></td>
				<td align="left" valign="top" width="20%"><input type="text" name="ad7_color_url1" value="<?php echo $c_v->ad7_color_url1; ?>" size="40" maxlength="100"></td>
				<td width="60%" align="left" valign="top"><?php echo _HWDRM_SETT_AD1ADURL_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _HWDRM_SETT_AD1CUSTOM ?></b></td>
				<td width="20%" align="left" valign="top"><textarea rows="5" name="ad7custom"><?php echo stripslashes($c_v->ad7custom); ?></textarea></td>
				<td width="60%" align="left" valign="top"><?php echo _HWDRM_SETT_AD1CUSTOM_DESC ?></td>
			  </tr>
			</table>
			</div>
			<?php
			echo $endtab;
			echo $starttab8;
			?>
			<div style="margin:1px;padding:1px;"><br />
			<table cellpadding="0" cellspacing="0" border="0" width="95%" class="adminform">
			  <tr><td align="left" valign="top" colspan="3">
			  <h3><?php echo _HWDRM_VSADCUSPOS3 ?></h3>
			  <p><?php echo _HWDRM_DOCS ?> <a href="http://documentation.hwdmediashare.co.uk/wiki/Main_Page" target="_blank">http://documentation.hwdmediashare.co.uk/wiki/Main_Page</a></p>
			  </td></tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _HWDRM_SETT_SHOWAD1 ?></b></td>
				<td width="20%" align="left" valign="top">
				<select name="ad8show" size="1" class="inputbox">
					<option value="2"<?php if ($c_v->ad8show == 2) { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_ADSENSE.' '; ?></option>
					<option value="1"<?php if ($c_v->ad8show == 1) { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_CUSTOM.' '; ?></option>
					<option value="0"<?php if ($c_v->ad8show == 0) { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_NO.' '; ?></option>
				</select>
				</td>
				<td width="60%" align="left" valign="top"><?php echo _HWDRM_SETT_SHOWAD1_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _HWDRM_SETT_AD1ADCLIENT ?></b></td>
				<td align="left" valign="top" width="20%"><input type="text" name="ad8_ad_client" value="<?php echo $c_v->ad8_ad_client; ?>" size="40" maxlength="100"></td>
				<td width="60%" align="left" valign="top"><?php echo _HWDRM_SETT_AD1ADCLIENT_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _HWDRM_SETT_AD1ADCHANNEL ?></b></td>
				<td align="left" valign="top" width="20%"><input type="text" name="ad8_ad_channel" value="<?php echo $c_v->ad8_ad_channel; ?>" size="40" maxlength="100"></td>
				<td width="60%" align="left" valign="top"><?php echo _HWDRM_SETT_AD1ADCHANNEL_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _HWDRM_SETT_AD1ADTYPE ?></b></td>
				<td width="20%" align="left" valign="top">
				<select name="ad8_ad_type" size="1" class="inputbox">
					<option value="text_image"<?php if ($c_v->ad8_ad_type == "text_image") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_ADS_TANDI.' '; ?></option>
					<option value="text"<?php if ($c_v->ad8_ad_type == "text") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_ADS_TEXT.' '; ?></option>
					<option value="image"<?php if ($c_v->ad8_ad_type == "image") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_ADS_IMAGE.' '; ?></option>
				</select>
				</td>
				<td width="60%" align="left" valign="top"><?php echo _HWDRM_SETT_AD1ADTYPE_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _HWDRM_SETT_AD1UIF ?></b></td>
				<td width="20%" align="left" valign="top">
				<select name="ad8_ad_uifeatures" size="1" class="inputbox">
					<option value="0"<?php if ($c_v->ad8_ad_uifeatures == 0) { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_ADS_SQUARE.' '; ?></option>
					<option value="6"<?php if ($c_v->ad8_ad_uifeatures == 6) { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_ADS_SR.' '; ?></option>
					<option value="10"<?php if ($c_v->ad8_ad_uifeatures == 10) { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_ADS_VR.' '; ?></option>
				</select>
				</td>
				<td width="60%" align="left" valign="top"><?php echo _HWDRM_SETT_AD1ADUIF_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _HWDRM_SETT_AD1LAYOUT ?></b></td>
				<td width="20%" align="left" valign="top">
				<select name="ad8_ad_format" size="1" class="inputbox">
					<option value="468x60_as"<?php if ($c_v->ad8_ad_format == "468x60_as") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM1.' '; ?></option>
					<option value="234x60_as"<?php if ($c_v->ad8_ad_format == "234x60_as") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM2.' '; ?></option>
					<option value=""> --- </option>
					<option value="120x600_as"<?php if ($c_v->ad8_ad_format == "120x600_as") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM3.' '; ?></option>
					<option value="160x600_as"<?php if ($c_v->ad8_ad_format == "160x600_as") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM4.' '; ?></option>
					<option value="120x240_as"<?php if ($c_v->ad8_ad_format == "120x240_as") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM5.' '; ?></option>
					<option value=""> --- </option>
					<option value="336x280_as"<?php if ($c_v->ad8_ad_format == "336x280_as") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM6.' '; ?></option>
					<option value="300x250_as"<?php if ($c_v->ad8_ad_format == "300x250_as") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM7.' '; ?></option>
					<option value="250x250_as"<?php if ($c_v->ad8_ad_format == "250x250_as") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM8.' '; ?></option>
					<option value="200x200_as"<?php if ($c_v->ad8_ad_format == "200x200_as") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM9.' '; ?></option>
					<option value="180x150_as"<?php if ($c_v->ad8_ad_format == "180x150_as") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM10.' '; ?></option>
					<option value="125x125_as"<?php if ($c_v->ad8_ad_format == "125x125_as") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM11.' '; ?></option>
					<option value=""> --- </option>
					<option value="728x90_as"<?php if ($c_v->ad8_ad_format == "728x90_as") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM12.' '; ?></option>
					<option value=""> --- </option>
					<option value="728x15_0ads_al"<?php if ($c_v->ad8_ad_format == "728x15_0ads_al") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM13.' '; ?></option>
					<option value="468x15_0ads_al"<?php if ($c_v->ad8_ad_format == "468x15_0ads_al") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM14.' '; ?></option>
					<option value="120x90_0ads_al"<?php if ($c_v->ad8_ad_format == "120x90_0ads_al") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM15.' '; ?></option>
					<option value="160x90_0ads_al"<?php if ($c_v->ad8_ad_format == "160x90_0ads_al") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM16.' '; ?></option>
					<option value="180x90_0ads_al"<?php if ($c_v->ad8_ad_format == "180x90_0ads_al") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM17.' '; ?></option>
					<option value="200x90_0ads_al"<?php if ($c_v->ad8_ad_format == "200x90_0ads_al") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM18.' '; ?></option>
					<option value=""> --- </option>
					<option value="728x15_0ads_al_s"<?php if ($c_v->ad8_ad_format == "728x15_0ads_al_s") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM19.' '; ?></option>
					<option value="468x15_0ads_al_s"<?php if ($c_v->ad8_ad_format == "468x15_0ads_al_s") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM20.' '; ?></option>
					<option value="120x90_0ads_al_s"<?php if ($c_v->ad8_ad_format == "120x90_0ads_al_s") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM21.' '; ?></option>
					<option value="160x90_0ads_al_s"<?php if ($c_v->ad8_ad_format == "160x90_0ads_al_s") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM22.' '; ?></option>
					<option value="180x90_0ads_al_s"<?php if ($c_v->ad8_ad_format == "180x90_0ads_al_s") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM23.' '; ?></option>
					<option value="200x90_0ads_al_s"<?php if ($c_v->ad8_ad_format == "200x90_0ads_al_s") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM24.' '; ?></option>
				</select>
				</td>
				<td width="60%" align="left" valign="top"><?php echo _HWDRM_SETT_AD1LAYOUT_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _HWDRM_SETT_AD1ADBORDER ?></b></td>
				<td align="left" valign="top" width="20%"><input type="text" name="ad8_color_border1" value="<?php echo $c_v->ad8_color_border1; ?>" size="40" maxlength="100"></td>
				<td width="60%" align="left" valign="top"><?php echo _HWDRM_SETT_AD1ADBORDER_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _HWDRM_SETT_AD1ADBG ?></b></td>
				<td align="left" valign="top" width="20%"><input type="text" name="ad8_color_bg1" value="<?php echo $c_v->ad8_color_bg1; ?>" size="40" maxlength="100"></td>
				<td width="60%" align="left" valign="top"><?php echo _HWDRM_SETT_AD1ADBG_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _HWDRM_SETT_AD1ADLINK ?></b></td>
				<td align="left" valign="top" width="20%"><input type="text" name="ad8_color_link1" value="<?php echo $c_v->ad8_color_link1; ?>" size="40" maxlength="100"></td>
				<td width="60%" align="left" valign="top"><?php echo _HWDRM_SETT_AD1ADLINK_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _HWDRM_SETT_AD1ADTEXT ?></b></td>
				<td align="left" valign="top" width="20%"><input type="text" name="ad8_color_text1" value="<?php echo $c_v->ad8_color_text1; ?>" size="40" maxlength="100"></td>
				<td width="60%" align="left" valign="top"><?php echo _HWDRM_SETT_AD1ADTEXT_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _HWDRM_SETT_AD1ADURL ?></b></td>
				<td align="left" valign="top" width="20%"><input type="text" name="ad8_color_url1" value="<?php echo $c_v->ad8_color_url1; ?>" size="40" maxlength="100"></td>
				<td width="60%" align="left" valign="top"><?php echo _HWDRM_SETT_AD1ADURL_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _HWDRM_SETT_AD1CUSTOM ?></b></td>
				<td width="20%" align="left" valign="top"><textarea rows="5" name="ad8custom"><?php echo stripslashes($c_v->ad8custom); ?></textarea></td>
				<td width="60%" align="left" valign="top"><?php echo _HWDRM_SETT_AD1CUSTOM_DESC ?></td>
			  </tr>
			</table>
			</div>
			<?php
			echo $endtab;
			echo $endpane;
			?>
		</div>
		<div style="clear:both;"></div>
		<input type="hidden" name="boxchecked" value="0" />
		<input type="hidden" name="option" value="com_hwdrevenuemanager" />
		<input type="hidden" name="task" value="savevssettings" />
		<input type="hidden" name="hidemainmenu" value="0">
		</form>
		<br />
		<table width="100%"  border="0" cellspacing="0" cellpadding="0" class="adminform">
  			<tr>
    			<td align="center"><center><?php copyright(); ?></center></td>
  			</tr>
		</table>
		<?php
  		}
	}
    /**
     * Shows hwdPhotoShare revenue information
     *
     * @param string $option  the joomla component name
     * @param array  $compatibility  compatibility data
     * @return       Nothing
     */
	function showpssettings($option, $compatibility)
	{
		global $database;
		$c_v = hwd_rm_vs_Config::get_instance();
		$c_p = hwd_rm_ps_Config::get_instance();
		$db =& JFactory::getDBO();
		jimport('joomla.html.pane');
		$pane =& JPane::getInstance('tabs');
		$startpane = $pane->startPane( 'content-pane' );
		$endtab = $pane->endPanel();
		$endpane = $pane->endPane();
		$starttab1 = $pane->startPanel( _HWDRM_VSAD1, 'panel1' );
		$starttab2 = $pane->startPanel( _HWDRM_VSAD2, 'panel2' );
		$starttab3 = $pane->startPanel( _HWDRM_VSAD3, 'panel3' );
		$starttab4 = $pane->startPanel( _HWDRM_VSAD4, 'panel4' );
		$starttab5 = $pane->startPanel( _HWDRM_VSAD5, 'panel5' );
		$starttab6 = $pane->startPanel( _HWDRM_CUSVSAD1, 'panel6' );
		$starttab7 = $pane->startPanel( _HWDRM_CUSVSAD2, 'panel7' );
		$starttab8 = $pane->startPanel( _HWDRM_CUSVSAD3, 'panel8' );
		?>
		<form action="index.php" method="post" name="adminForm">
		<table cellpadding="0" cellspacing="0" border="0" width="100%" class="adminform">
			<tr>
		  		<td style="background-color: #202626; width:100%; text-align: right; vertical-align: top;" colspan="2">
		  		<img src="<?php echo JURI::root()."/administrator/components/com_hwdrevenuemanager/images/logo.png"; ?>" height="47" width="250" alt="Logo" style="float: left;" />
				<font style="color: #fffffe; font-size: 200%; font-weight: bold;"><?php echo _HWDPS_SECTIONHEAD_HWDPS; ?></font>
				</td>
			</tr>
  		</table>
  		<?php
  		if (is_writable(HWDRM_ADMIN_PATH.'/config.ps.hwdrevenuemanager.php')) {
  			$config_file_status = "<span style=\"color:#458B00;\">"._HWDRM_INFO_CONFIGF2."</span>.";
  		} else {
  			$config_file_status = "<span style=\"color:#ff0000;\">"._HWDRM_INFO_CONFIGF3."</span>. (".HWDRM_ADMIN_PATH."/config.ps.hwdrevenuemanager.php)";
  		}

  		if ($compatibility[2] == "0") {
  		?>
   		<div style="border: solid 1px #333;margin:5px 0 5px 0;padding:5px;text-align:left;font-weight:bold;"><?php echo _HWDRM_INFO_CONFIGF5." ".$compatibility[3]; ?></div>
		<div style="clear:both;"></div>
		<input type="hidden" name="boxchecked" value="0" />
		<input type="hidden" name="option" value="com_hwdrevenuemanager" />
		<input type="hidden" name="task" value="savepssettings" />
		<input type="hidden" name="hidemainmenu" value="0">
		</form>
		<br />
		<table width="100%"  border="0" cellspacing="0" cellpadding="0" class="adminform">
  			<tr>
    			<td align="center"><center><?php copyright(); ?></center></td>
  			</tr>
		</table>
  		<?php
  		} else {
  		?>
  		<div style="border: solid 1px #333;margin:5px 0 5px 0;padding:5px;text-align:left;font-weight:bold;"><?php echo _HWDRM_INFO_CONFIGF1." ".$config_file_status; ?></div>
  		<div style="width:100%;margin-top:5px;text-align:left;">
			<?php
			echo $startpane;
			echo $starttab1;
			?>
			<div style="margin:1px;padding:1px;"><br />
			<table cellpadding="0" cellspacing="0" border="0" width="95%" class="adminform">
			  <tr><td align="left" valign="top" colspan="3">
			  <h3><?php echo _HWDRM_VSADPOS1 ?></h3>
			  <p><?php echo _HWDRM_DOCS ?> <a href="http://documentation.hwdmediashare.co.uk/wiki/Main_Page" target="_blank">http://documentation.hwdmediashare.co.uk/wiki/Main_Page</a></p>
			  </td></tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _HWDRM_SETT_SHOWAD1 ?></b></td>
				<td width="20%" align="left" valign="top">
				<select name="ad1show" size="1" class="inputbox">
					<option value="2"<?php if ($c_p->ad1show == 2) { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_ADSENSE.' '; ?></option>
					<option value="1"<?php if ($c_p->ad1show == 1) { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_CUSTOM.' '; ?></option>
					<option value="0"<?php if ($c_p->ad1show == 0) { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_NO.' '; ?></option>
				</select>
				</td>
				<td width="60%" align="left" valign="top"><?php echo _HWDRM_SETT_SHOWAD1_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _HWDRM_SETT_AD1ADCLIENT ?></b></td>
				<td align="left" valign="top" width="20%"><input type="text" name="ad1_ad_client" value="<?php echo $c_p->ad1_ad_client; ?>" size="40" maxlength="100"></td>
				<td width="60%" align="left" valign="top"><?php echo _HWDRM_SETT_AD1ADCLIENT_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _HWDRM_SETT_AD1ADCHANNEL ?></b></td>
				<td align="left" valign="top" width="20%"><input type="text" name="ad1_ad_channel" value="<?php echo $c_p->ad1_ad_channel; ?>" size="40" maxlength="100"></td>
				<td width="60%" align="left" valign="top"><?php echo _HWDRM_SETT_AD1ADCHANNEL_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _HWDRM_SETT_AD1ADTYPE ?></b></td>
				<td width="20%" align="left" valign="top">
				<select name="ad1_ad_type" size="1" class="inputbox">
					<option value="text_image"<?php if ($c_p->ad1_ad_type == "text_image") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_ADS_TANDI.' '; ?></option>
					<option value="text"<?php if ($c_p->ad1_ad_type == "text") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_ADS_TEXT.' '; ?></option>
					<option value="image"<?php if ($c_p->ad1_ad_type == "image") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_ADS_IMAGE.' '; ?></option>
				</select>
				</td>
				<td width="60%" align="left" valign="top"><?php echo _HWDRM_SETT_AD1ADTYPE_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _HWDRM_SETT_AD1UIF ?></b></td>
				<td width="20%" align="left" valign="top">
				<select name="ad1_ad_uifeatures" size="1" class="inputbox">
					<option value="0"<?php if ($c_p->ad1_ad_uifeatures == 0) { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_ADS_SQUARE.' '; ?></option>
					<option value="6"<?php if ($c_p->ad1_ad_uifeatures == 6) { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_ADS_SR.' '; ?></option>
					<option value="10"<?php if ($c_p->ad1_ad_uifeatures == 10) { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_ADS_VR.' '; ?></option>
				</select>
				</td>
				<td width="60%" align="left" valign="top"><?php echo _HWDRM_SETT_AD1ADUIF_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _HWDRM_SETT_AD1LAYOUT ?></b></td>
				<td width="20%" align="left" valign="top">
				<select name="ad1_ad_format" size="1" class="inputbox">
					<option value="468x60_as"<?php if ($c_p->ad1_ad_format == "468x60_as") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM1.' '; ?></option>
					<option value="234x60_as"<?php if ($c_p->ad1_ad_format == "234x60_as") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM2.' '; ?></option>
					<option value=""> --- </option>
					<option value="120x600_as"<?php if ($c_p->ad1_ad_format == "120x600_as") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM3.' '; ?></option>
					<option value="160x600_as"<?php if ($c_p->ad1_ad_format == "160x600_as") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM4.' '; ?></option>
					<option value="120x240_as"<?php if ($c_p->ad1_ad_format == "120x240_as") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM5.' '; ?></option>
					<option value=""> --- </option>
					<option value="336x280_as"<?php if ($c_p->ad1_ad_format == "336x280_as") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM6.' '; ?></option>
					<option value="300x250_as"<?php if ($c_p->ad1_ad_format == "300x250_as") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM7.' '; ?></option>
					<option value="250x250_as"<?php if ($c_p->ad1_ad_format == "250x250_as") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM8.' '; ?></option>
					<option value="200x200_as"<?php if ($c_p->ad1_ad_format == "200x200_as") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM9.' '; ?></option>
					<option value="180x150_as"<?php if ($c_p->ad1_ad_format == "180x150_as") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM10.' '; ?></option>
					<option value="125x125_as"<?php if ($c_p->ad1_ad_format == "125x125_as") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM11.' '; ?></option>
					<option value=""> --- </option>
					<option value="728x90_as"<?php if ($c_p->ad1_ad_format == "728x90_as") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM12.' '; ?></option>
					<option value=""> --- </option>
					<option value="728x15_0ads_al"<?php if ($c_p->ad1_ad_format == "728x15_0ads_al") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM13.' '; ?></option>
					<option value="468x15_0ads_al"<?php if ($c_p->ad1_ad_format == "468x15_0ads_al") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM14.' '; ?></option>
					<option value="120x90_0ads_al"<?php if ($c_p->ad1_ad_format == "120x90_0ads_al") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM15.' '; ?></option>
					<option value="160x90_0ads_al"<?php if ($c_p->ad1_ad_format == "160x90_0ads_al") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM16.' '; ?></option>
					<option value="180x90_0ads_al"<?php if ($c_p->ad1_ad_format == "180x90_0ads_al") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM17.' '; ?></option>
					<option value="200x90_0ads_al"<?php if ($c_p->ad1_ad_format == "200x90_0ads_al") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM18.' '; ?></option>
					<option value=""> --- </option>
					<option value="728x15_0ads_al_s"<?php if ($c_p->ad1_ad_format == "728x15_0ads_al_s") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM19.' '; ?></option>
					<option value="468x15_0ads_al_s"<?php if ($c_p->ad1_ad_format == "468x15_0ads_al_s") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM20.' '; ?></option>
					<option value="120x90_0ads_al_s"<?php if ($c_p->ad1_ad_format == "120x90_0ads_al_s") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM21.' '; ?></option>
					<option value="160x90_0ads_al_s"<?php if ($c_p->ad1_ad_format == "160x90_0ads_al_s") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM22.' '; ?></option>
					<option value="180x90_0ads_al_s"<?php if ($c_p->ad1_ad_format == "180x90_0ads_al_s") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM23.' '; ?></option>
					<option value="200x90_0ads_al_s"<?php if ($c_p->ad1_ad_format == "200x90_0ads_al_s") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM24.' '; ?></option>
				</select>
				</td>
				<td width="60%" align="left" valign="top"><?php echo _HWDRM_SETT_AD1LAYOUT_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _HWDRM_SETT_AD1ADBORDER ?></b></td>
				<td align="left" valign="top" width="20%"><input type="text" name="ad1_color_border1" value="<?php echo $c_p->ad1_color_border1; ?>" size="40" maxlength="100"></td>
				<td width="60%" align="left" valign="top"><?php echo _HWDRM_SETT_AD1ADBORDER_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _HWDRM_SETT_AD1ADBG ?></b></td>
				<td align="left" valign="top" width="20%"><input type="text" name="ad1_color_bg1" value="<?php echo $c_p->ad1_color_bg1; ?>" size="40" maxlength="100"></td>
				<td width="60%" align="left" valign="top"><?php echo _HWDRM_SETT_AD1ADBG_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _HWDRM_SETT_AD1ADLINK ?></b></td>
				<td align="left" valign="top" width="20%"><input type="text" name="ad1_color_link1" value="<?php echo $c_p->ad1_color_link1; ?>" size="40" maxlength="100"></td>
				<td width="60%" align="left" valign="top"><?php echo _HWDRM_SETT_AD1ADLINK_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _HWDRM_SETT_AD1ADTEXT ?></b></td>
				<td align="left" valign="top" width="20%"><input type="text" name="ad1_color_text1" value="<?php echo $c_p->ad1_color_text1; ?>" size="40" maxlength="100"></td>
				<td width="60%" align="left" valign="top"><?php echo _HWDRM_SETT_AD1ADTEXT_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _HWDRM_SETT_AD1ADURL ?></b></td>
				<td align="left" valign="top" width="20%"><input type="text" name="ad1_color_url1" value="<?php echo $c_p->ad1_color_url1; ?>" size="40" maxlength="100"></td>
				<td width="60%" align="left" valign="top"><?php echo _HWDRM_SETT_AD1ADURL_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _HWDRM_SETT_AD1CUSTOM ?></b></td>
				<td width="20%" align="left" valign="top"><textarea rows="5" name="ad1custom"><?php echo stripslashes($c_p->ad1custom); ?></textarea></td>
				<td width="60%" align="left" valign="top"><?php echo _HWDRM_SETT_AD1CUSTOM_DESC ?></td>
			  </tr>
			</table>
			</div>
			<?php
			echo $endtab;
			echo $starttab2;
			?>
			<div style="margin:1px;padding:1px;"><br />
			<table cellpadding="0" cellspacing="0" border="0" width="95%" class="adminform">
			  <tr><td align="left" valign="top" colspan="3">
			  <h3><?php echo _HWDRM_VSADPOS2 ?></h3>
			  <p><?php echo _HWDRM_DOCS ?> <a href="http://documentation.hwdmediashare.co.uk/wiki/Main_Page" target="_blank">http://documentation.hwdmediashare.co.uk/wiki/Main_Page</a></p>
			  </td></tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _HWDRM_SETT_SHOWAD1 ?></b></td>
				<td width="20%" align="left" valign="top">
				<select name="ad2show" size="1" class="inputbox">
					<option value="2"<?php if ($c_p->ad2show == 2) { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_ADSENSE.' '; ?></option>
					<option value="1"<?php if ($c_p->ad2show == 1) { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_CUSTOM.' '; ?></option>
					<option value="0"<?php if ($c_p->ad2show == 0) { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_NO.' '; ?></option>
				</select>
				</td>
				<td width="60%" align="left" valign="top"><?php echo _HWDRM_SETT_SHOWAD1_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _HWDRM_SETT_AD1ADCLIENT ?></b></td>
				<td align="left" valign="top" width="20%"><input type="text" name="ad2_ad_client" value="<?php echo $c_p->ad2_ad_client; ?>" size="40" maxlength="100"></td>
				<td width="60%" align="left" valign="top"><?php echo _HWDRM_SETT_AD1ADCLIENT_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _HWDRM_SETT_AD1ADCHANNEL ?></b></td>
				<td align="left" valign="top" width="20%"><input type="text" name="ad2_ad_channel" value="<?php echo $c_p->ad2_ad_channel; ?>" size="40" maxlength="100"></td>
				<td width="60%" align="left" valign="top"><?php echo _HWDRM_SETT_AD1ADCHANNEL_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _HWDRM_SETT_AD1ADTYPE ?></b></td>
				<td width="20%" align="left" valign="top">
				<select name="ad2_ad_type" size="1" class="inputbox">
					<option value="text_image"<?php if ($c_p->ad2_ad_type == "text_image") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_ADS_TANDI.' '; ?></option>
					<option value="text"<?php if ($c_p->ad2_ad_type == "text") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_ADS_TEXT.' '; ?></option>
					<option value="image"<?php if ($c_p->ad2_ad_type == "image") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_ADS_IMAGE.' '; ?></option>
				</select>
				</td>
				<td width="60%" align="left" valign="top"><?php echo _HWDRM_SETT_AD1ADTYPE_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _HWDRM_SETT_AD1UIF ?></b></td>
				<td width="20%" align="left" valign="top">
				<select name="ad2_ad_uifeatures" size="1" class="inputbox">
					<option value="0"<?php if ($c_p->ad2_ad_uifeatures == 0) { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_ADS_SQUARE.' '; ?></option>
					<option value="6"<?php if ($c_p->ad2_ad_uifeatures == 6) { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_ADS_SR.' '; ?></option>
					<option value="10"<?php if ($c_p->ad2_ad_uifeatures == 10) { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_ADS_VR.' '; ?></option>
				</select>
				</td>
				<td width="60%" align="left" valign="top"><?php echo _HWDRM_SETT_AD1ADUIF_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _HWDRM_SETT_AD1LAYOUT ?></b></td>
				<td width="20%" align="left" valign="top">
				<select name="ad2_ad_format" size="1" class="inputbox">
					<option value="468x60_as"<?php if ($c_p->ad2_ad_format == "468x60_as") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM1.' '; ?></option>
					<option value="234x60_as"<?php if ($c_p->ad2_ad_format == "234x60_as") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM2.' '; ?></option>
					<option value=""> --- </option>
					<option value="120x600_as"<?php if ($c_p->ad2_ad_format == "120x600_as") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM3.' '; ?></option>
					<option value="160x600_as"<?php if ($c_p->ad2_ad_format == "160x600_as") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM4.' '; ?></option>
					<option value="120x240_as"<?php if ($c_p->ad2_ad_format == "120x240_as") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM5.' '; ?></option>
					<option value=""> --- </option>
					<option value="336x280_as"<?php if ($c_p->ad2_ad_format == "336x280_as") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM6.' '; ?></option>
					<option value="300x250_as"<?php if ($c_p->ad2_ad_format == "300x250_as") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM7.' '; ?></option>
					<option value="250x250_as"<?php if ($c_p->ad2_ad_format == "250x250_as") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM8.' '; ?></option>
					<option value="200x200_as"<?php if ($c_p->ad2_ad_format == "200x200_as") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM9.' '; ?></option>
					<option value="180x150_as"<?php if ($c_p->ad2_ad_format == "180x150_as") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM10.' '; ?></option>
					<option value="125x125_as"<?php if ($c_p->ad2_ad_format == "125x125_as") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM11.' '; ?></option>
					<option value=""> --- </option>
					<option value="728x90_as"<?php if ($c_p->ad2_ad_format == "728x90_as") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM12.' '; ?></option>
					<option value=""> --- </option>
					<option value="728x15_0ads_al"<?php if ($c_p->ad2_ad_format == "728x15_0ads_al") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM13.' '; ?></option>
					<option value="468x15_0ads_al"<?php if ($c_p->ad2_ad_format == "468x15_0ads_al") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM14.' '; ?></option>
					<option value="120x90_0ads_al"<?php if ($c_p->ad2_ad_format == "120x90_0ads_al") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM15.' '; ?></option>
					<option value="160x90_0ads_al"<?php if ($c_p->ad2_ad_format == "160x90_0ads_al") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM16.' '; ?></option>
					<option value="180x90_0ads_al"<?php if ($c_p->ad2_ad_format == "180x90_0ads_al") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM17.' '; ?></option>
					<option value="200x90_0ads_al"<?php if ($c_p->ad2_ad_format == "200x90_0ads_al") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM18.' '; ?></option>
					<option value=""> --- </option>
					<option value="728x15_0ads_al_s"<?php if ($c_p->ad2_ad_format == "728x15_0ads_al_s") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM19.' '; ?></option>
					<option value="468x15_0ads_al_s"<?php if ($c_p->ad2_ad_format == "468x15_0ads_al_s") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM20.' '; ?></option>
					<option value="120x90_0ads_al_s"<?php if ($c_p->ad2_ad_format == "120x90_0ads_al_s") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM21.' '; ?></option>
					<option value="160x90_0ads_al_s"<?php if ($c_p->ad2_ad_format == "160x90_0ads_al_s") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM22.' '; ?></option>
					<option value="180x90_0ads_al_s"<?php if ($c_p->ad2_ad_format == "180x90_0ads_al_s") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM23.' '; ?></option>
					<option value="200x90_0ads_al_s"<?php if ($c_p->ad2_ad_format == "200x90_0ads_al_s") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM24.' '; ?></option>
				</select>
				</td>
				<td width="60%" align="left" valign="top"><?php echo _HWDRM_SETT_AD1LAYOUT_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _HWDRM_SETT_AD1ADBORDER ?></b></td>
				<td align="left" valign="top" width="20%"><input type="text" name="ad2_color_border1" value="<?php echo $c_p->ad2_color_border1; ?>" size="40" maxlength="100"></td>
				<td width="60%" align="left" valign="top"><?php echo _HWDRM_SETT_AD1ADBORDER_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _HWDRM_SETT_AD1ADBG ?></b></td>
				<td align="left" valign="top" width="20%"><input type="text" name="ad2_color_bg1" value="<?php echo $c_p->ad2_color_bg1; ?>" size="40" maxlength="100"></td>
				<td width="60%" align="left" valign="top"><?php echo _HWDRM_SETT_AD1ADBG_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _HWDRM_SETT_AD1ADLINK ?></b></td>
				<td align="left" valign="top" width="20%"><input type="text" name="ad2_color_link1" value="<?php echo $c_p->ad2_color_link1; ?>" size="40" maxlength="100"></td>
				<td width="60%" align="left" valign="top"><?php echo _HWDRM_SETT_AD1ADLINK_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _HWDRM_SETT_AD1ADTEXT ?></b></td>
				<td align="left" valign="top" width="20%"><input type="text" name="ad2_color_text1" value="<?php echo $c_p->ad2_color_text1; ?>" size="40" maxlength="100"></td>
				<td width="60%" align="left" valign="top"><?php echo _HWDRM_SETT_AD1ADTEXT_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _HWDRM_SETT_AD1ADURL ?></b></td>
				<td align="left" valign="top" width="20%"><input type="text" name="ad2_color_url1" value="<?php echo $c_p->ad2_color_url1; ?>" size="40" maxlength="100"></td>
				<td width="60%" align="left" valign="top"><?php echo _HWDRM_SETT_AD1ADURL_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _HWDRM_SETT_AD1CUSTOM ?></b></td>
				<td width="20%" align="left" valign="top"><textarea rows="5" name="ad2custom"><?php echo stripslashes($c_p->ad2custom); ?></textarea></td>
				<td width="60%" align="left" valign="top"><?php echo _HWDRM_SETT_AD1CUSTOM_DESC ?></td>
			  </tr>
			</table>
			</div>
			<?php
			echo $endtab;
			echo $starttab3;
			?>
			<div style="margin:1px;padding:1px;"><br />
			<table cellpadding="0" cellspacing="0" border="0" width="95%" class="adminform">
			  <tr><td align="left" valign="top" colspan="3">
			  <h3><?php echo _HWDRM_VSADPOS3 ?></h3>
			  <p><?php echo _HWDRM_DOCS ?> <a href="http://documentation.hwdmediashare.co.uk/wiki/Main_Page" target="_blank">http://documentation.hwdmediashare.co.uk/wiki/Main_Page</a></p>
			  </td></tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _HWDRM_SETT_SHOWAD1 ?></b></td>
				<td width="20%" align="left" valign="top">
				<select name="ad3show" size="1" class="inputbox">
					<option value="2"<?php if ($c_p->ad3show == 2) { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_ADSENSE.' '; ?></option>
					<option value="1"<?php if ($c_p->ad3show == 1) { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_CUSTOM.' '; ?></option>
					<option value="0"<?php if ($c_p->ad3show == 0) { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_NO.' '; ?></option>
				</select>
				</td>
				<td width="60%" align="left" valign="top"><?php echo _HWDRM_SETT_SHOWAD1_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _HWDRM_SETT_AD1ADCLIENT ?></b></td>
				<td align="left" valign="top" width="20%"><input type="text" name="ad3_ad_client" value="<?php echo $c_p->ad3_ad_client; ?>" size="40" maxlength="100"></td>
				<td width="60%" align="left" valign="top"><?php echo _HWDRM_SETT_AD1ADCLIENT_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _HWDRM_SETT_AD1ADCHANNEL ?></b></td>
				<td align="left" valign="top" width="20%"><input type="text" name="ad3_ad_channel" value="<?php echo $c_p->ad3_ad_channel; ?>" size="40" maxlength="100"></td>
				<td width="60%" align="left" valign="top"><?php echo _HWDRM_SETT_AD1ADCHANNEL_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _HWDRM_SETT_AD1ADTYPE ?></b></td>
				<td width="20%" align="left" valign="top">
				<select name="ad3_ad_type" size="1" class="inputbox">
					<option value="text_image"<?php if ($c_p->ad3_ad_type == "text_image") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_ADS_TANDI.' '; ?></option>
					<option value="text"<?php if ($c_p->ad3_ad_type == "text") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_ADS_TEXT.' '; ?></option>
					<option value="image"<?php if ($c_p->ad3_ad_type == "image") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_ADS_IMAGE.' '; ?></option>
				</select>
				</td>
				<td width="60%" align="left" valign="top"><?php echo _HWDRM_SETT_AD1ADTYPE_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _HWDRM_SETT_AD1UIF ?></b></td>
				<td width="20%" align="left" valign="top">
				<select name="ad3_ad_uifeatures" size="1" class="inputbox">
					<option value="0"<?php if ($c_p->ad3_ad_uifeatures == 0) { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_ADS_SQUARE.' '; ?></option>
					<option value="6"<?php if ($c_p->ad3_ad_uifeatures == 6) { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_ADS_SR.' '; ?></option>
					<option value="10"<?php if ($c_p->ad3_ad_uifeatures == 10) { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_ADS_VR.' '; ?></option>
				</select>
				</td>
				<td width="60%" align="left" valign="top"><?php echo _HWDRM_SETT_AD1ADUIF_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _HWDRM_SETT_AD1LAYOUT ?></b></td>
				<td width="20%" align="left" valign="top">
				<select name="ad3_ad_format" size="1" class="inputbox">
					<option value="468x60_as"<?php if ($c_p->ad3_ad_format == "468x60_as") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM1.' '; ?></option>
					<option value="234x60_as"<?php if ($c_p->ad3_ad_format == "234x60_as") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM2.' '; ?></option>
					<option value=""> --- </option>
					<option value="120x600_as"<?php if ($c_p->ad3_ad_format == "120x600_as") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM3.' '; ?></option>
					<option value="160x600_as"<?php if ($c_p->ad3_ad_format == "160x600_as") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM4.' '; ?></option>
					<option value="120x240_as"<?php if ($c_p->ad3_ad_format == "120x240_as") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM5.' '; ?></option>
					<option value=""> --- </option>
					<option value="336x280_as"<?php if ($c_p->ad3_ad_format == "336x280_as") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM6.' '; ?></option>
					<option value="300x250_as"<?php if ($c_p->ad3_ad_format == "300x250_as") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM7.' '; ?></option>
					<option value="250x250_as"<?php if ($c_p->ad3_ad_format == "250x250_as") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM8.' '; ?></option>
					<option value="200x200_as"<?php if ($c_p->ad3_ad_format == "200x200_as") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM9.' '; ?></option>
					<option value="180x150_as"<?php if ($c_p->ad3_ad_format == "180x150_as") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM10.' '; ?></option>
					<option value="125x125_as"<?php if ($c_p->ad3_ad_format == "125x125_as") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM11.' '; ?></option>
					<option value=""> --- </option>
					<option value="728x90_as"<?php if ($c_p->ad3_ad_format == "728x90_as") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM12.' '; ?></option>
					<option value=""> --- </option>
					<option value="728x15_0ads_al"<?php if ($c_p->ad3_ad_format == "728x15_0ads_al") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM13.' '; ?></option>
					<option value="468x15_0ads_al"<?php if ($c_p->ad3_ad_format == "468x15_0ads_al") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM14.' '; ?></option>
					<option value="120x90_0ads_al"<?php if ($c_p->ad3_ad_format == "120x90_0ads_al") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM15.' '; ?></option>
					<option value="160x90_0ads_al"<?php if ($c_p->ad3_ad_format == "160x90_0ads_al") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM16.' '; ?></option>
					<option value="180x90_0ads_al"<?php if ($c_p->ad3_ad_format == "180x90_0ads_al") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM17.' '; ?></option>
					<option value="200x90_0ads_al"<?php if ($c_p->ad3_ad_format == "200x90_0ads_al") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM18.' '; ?></option>
					<option value=""> --- </option>
					<option value="728x15_0ads_al_s"<?php if ($c_p->ad3_ad_format == "728x15_0ads_al_s") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM19.' '; ?></option>
					<option value="468x15_0ads_al_s"<?php if ($c_p->ad3_ad_format == "468x15_0ads_al_s") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM20.' '; ?></option>
					<option value="120x90_0ads_al_s"<?php if ($c_p->ad3_ad_format == "120x90_0ads_al_s") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM21.' '; ?></option>
					<option value="160x90_0ads_al_s"<?php if ($c_p->ad3_ad_format == "160x90_0ads_al_s") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM22.' '; ?></option>
					<option value="180x90_0ads_al_s"<?php if ($c_p->ad3_ad_format == "180x90_0ads_al_s") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM23.' '; ?></option>
					<option value="200x90_0ads_al_s"<?php if ($c_p->ad3_ad_format == "200x90_0ads_al_s") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM24.' '; ?></option>
				</select>
				</td>
				<td width="60%" align="left" valign="top"><?php echo _HWDRM_SETT_AD1LAYOUT_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _HWDRM_SETT_AD1ADBORDER ?></b></td>
				<td align="left" valign="top" width="20%"><input type="text" name="ad3_color_border1" value="<?php echo $c_p->ad3_color_border1; ?>" size="40" maxlength="100"></td>
				<td width="60%" align="left" valign="top"><?php echo _HWDRM_SETT_AD1ADBORDER_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _HWDRM_SETT_AD1ADBG ?></b></td>
				<td align="left" valign="top" width="20%"><input type="text" name="ad3_color_bg1" value="<?php echo $c_p->ad3_color_bg1; ?>" size="40" maxlength="100"></td>
				<td width="60%" align="left" valign="top"><?php echo _HWDRM_SETT_AD1ADBG_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _HWDRM_SETT_AD1ADLINK ?></b></td>
				<td align="left" valign="top" width="20%"><input type="text" name="ad3_color_link1" value="<?php echo $c_p->ad3_color_link1; ?>" size="40" maxlength="100"></td>
				<td width="60%" align="left" valign="top"><?php echo _HWDRM_SETT_AD1ADLINK_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _HWDRM_SETT_AD1ADTEXT ?></b></td>
				<td align="left" valign="top" width="20%"><input type="text" name="ad3_color_text1" value="<?php echo $c_p->ad3_color_text1; ?>" size="40" maxlength="100"></td>
				<td width="60%" align="left" valign="top"><?php echo _HWDRM_SETT_AD1ADTEXT_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _HWDRM_SETT_AD1ADURL ?></b></td>
				<td align="left" valign="top" width="20%"><input type="text" name="ad3_color_url1" value="<?php echo $c_p->ad3_color_url1; ?>" size="40" maxlength="100"></td>
				<td width="60%" align="left" valign="top"><?php echo _HWDRM_SETT_AD1ADURL_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _HWDRM_SETT_AD1CUSTOM ?></b></td>
				<td width="20%" align="left" valign="top"><textarea rows="5" name="ad3custom"><?php echo stripslashes($c_p->ad3custom); ?></textarea></td>
				<td width="60%" align="left" valign="top"><?php echo _HWDRM_SETT_AD1CUSTOM_DESC ?></td>
			  </tr>
			</table>
			</div>
			<?php
			echo $endtab;
			echo $starttab4;
			?>
			<div style="margin:1px;padding:1px;"><br />
			<table cellpadding="0" cellspacing="0" border="0" width="95%" class="adminform">
			  <tr><td align="left" valign="top" colspan="3">
			  <h3><?php echo _HWDRM_VSADPOS4 ?></h3>
			  <p><?php echo _HWDRM_DOCS ?> <a href="http://documentation.hwdmediashare.co.uk/wiki/Main_Page" target="_blank">http://documentation.hwdmediashare.co.uk/wiki/Main_Page</a></p>
			  </td></tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _HWDRM_SETT_SHOWAD1 ?></b></td>
				<td width="20%" align="left" valign="top">
				<select name="ad4show" size="1" class="inputbox">
					<option value="2"<?php if ($c_p->ad4show == 2) { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_ADSENSE.' '; ?></option>
					<option value="1"<?php if ($c_p->ad4show == 1) { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_CUSTOM.' '; ?></option>
					<option value="0"<?php if ($c_p->ad4show == 0) { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_NO.' '; ?></option>
				</select>
				</td>
				<td width="60%" align="left" valign="top"><?php echo _HWDRM_SETT_SHOWAD1_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _HWDRM_SETT_AD1ADCLIENT ?></b></td>
				<td align="left" valign="top" width="20%"><input type="text" name="ad4_ad_client" value="<?php echo $c_p->ad4_ad_client; ?>" size="40" maxlength="100"></td>
				<td width="60%" align="left" valign="top"><?php echo _HWDRM_SETT_AD1ADCLIENT_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _HWDRM_SETT_AD1ADCHANNEL ?></b></td>
				<td align="left" valign="top" width="20%"><input type="text" name="ad4_ad_channel" value="<?php echo $c_p->ad4_ad_channel; ?>" size="40" maxlength="100"></td>
				<td width="60%" align="left" valign="top"><?php echo _HWDRM_SETT_AD1ADCHANNEL_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _HWDRM_SETT_AD1ADTYPE ?></b></td>
				<td width="20%" align="left" valign="top">
				<select name="ad4_ad_type" size="1" class="inputbox">
					<option value="text_image"<?php if ($c_p->ad4_ad_type == "text_image") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_ADS_TANDI.' '; ?></option>
					<option value="text"<?php if ($c_p->ad4_ad_type == "text") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_ADS_TEXT.' '; ?></option>
					<option value="image"<?php if ($c_p->ad4_ad_type == "image") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_ADS_IMAGE.' '; ?></option>
				</select>
				</td>
				<td width="60%" align="left" valign="top"><?php echo _HWDRM_SETT_AD1ADTYPE_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _HWDRM_SETT_AD1UIF ?></b></td>
				<td width="20%" align="left" valign="top">
				<select name="ad4_ad_uifeatures" size="1" class="inputbox">
					<option value="0"<?php if ($c_p->ad4_ad_uifeatures == 0) { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_ADS_SQUARE.' '; ?></option>
					<option value="6"<?php if ($c_p->ad4_ad_uifeatures == 6) { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_ADS_SR.' '; ?></option>
					<option value="10"<?php if ($c_p->ad4_ad_uifeatures == 10) { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_ADS_VR.' '; ?></option>
				</select>
				</td>
				<td width="60%" align="left" valign="top"><?php echo _HWDRM_SETT_AD1ADUIF_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _HWDRM_SETT_AD1LAYOUT ?></b></td>
				<td width="20%" align="left" valign="top">
				<select name="ad4_ad_format" size="1" class="inputbox">
					<option value="468x60_as"<?php if ($c_p->ad4_ad_format == "468x60_as") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM1.' '; ?></option>
					<option value="234x60_as"<?php if ($c_p->ad4_ad_format == "234x60_as") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM2.' '; ?></option>
					<option value=""> --- </option>
					<option value="120x600_as"<?php if ($c_p->ad4_ad_format == "120x600_as") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM3.' '; ?></option>
					<option value="160x600_as"<?php if ($c_p->ad4_ad_format == "160x600_as") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM4.' '; ?></option>
					<option value="120x240_as"<?php if ($c_p->ad4_ad_format == "120x240_as") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM5.' '; ?></option>
					<option value=""> --- </option>
					<option value="336x280_as"<?php if ($c_p->ad4_ad_format == "336x280_as") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM6.' '; ?></option>
					<option value="300x250_as"<?php if ($c_p->ad4_ad_format == "300x250_as") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM7.' '; ?></option>
					<option value="250x250_as"<?php if ($c_p->ad4_ad_format == "250x250_as") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM8.' '; ?></option>
					<option value="200x200_as"<?php if ($c_p->ad4_ad_format == "200x200_as") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM9.' '; ?></option>
					<option value="180x150_as"<?php if ($c_p->ad4_ad_format == "180x150_as") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM10.' '; ?></option>
					<option value="125x125_as"<?php if ($c_p->ad4_ad_format == "125x125_as") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM11.' '; ?></option>
					<option value=""> --- </option>
					<option value="728x90_as"<?php if ($c_p->ad4_ad_format == "728x90_as") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM12.' '; ?></option>
					<option value=""> --- </option>
					<option value="728x15_0ads_al"<?php if ($c_p->ad4_ad_format == "728x15_0ads_al") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM13.' '; ?></option>
					<option value="468x15_0ads_al"<?php if ($c_p->ad4_ad_format == "468x15_0ads_al") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM14.' '; ?></option>
					<option value="120x90_0ads_al"<?php if ($c_p->ad4_ad_format == "120x90_0ads_al") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM15.' '; ?></option>
					<option value="160x90_0ads_al"<?php if ($c_p->ad4_ad_format == "160x90_0ads_al") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM16.' '; ?></option>
					<option value="180x90_0ads_al"<?php if ($c_p->ad4_ad_format == "180x90_0ads_al") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM17.' '; ?></option>
					<option value="200x90_0ads_al"<?php if ($c_p->ad4_ad_format == "200x90_0ads_al") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM18.' '; ?></option>
					<option value=""> --- </option>
					<option value="728x15_0ads_al_s"<?php if ($c_p->ad4_ad_format == "728x15_0ads_al_s") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM19.' '; ?></option>
					<option value="468x15_0ads_al_s"<?php if ($c_p->ad4_ad_format == "468x15_0ads_al_s") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM20.' '; ?></option>
					<option value="120x90_0ads_al_s"<?php if ($c_p->ad4_ad_format == "120x90_0ads_al_s") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM21.' '; ?></option>
					<option value="160x90_0ads_al_s"<?php if ($c_p->ad4_ad_format == "160x90_0ads_al_s") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM22.' '; ?></option>
					<option value="180x90_0ads_al_s"<?php if ($c_p->ad4_ad_format == "180x90_0ads_al_s") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM23.' '; ?></option>
					<option value="200x90_0ads_al_s"<?php if ($c_p->ad4_ad_format == "200x90_0ads_al_s") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM24.' '; ?></option>
				</select>
				</td>
				<td width="60%" align="left" valign="top"><?php echo _HWDRM_SETT_AD1LAYOUT_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _HWDRM_SETT_AD1ADBORDER ?></b></td>
				<td align="left" valign="top" width="20%"><input type="text" name="ad4_color_border1" value="<?php echo $c_p->ad4_color_border1; ?>" size="40" maxlength="100"></td>
				<td width="60%" align="left" valign="top"><?php echo _HWDRM_SETT_AD1ADBORDER_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _HWDRM_SETT_AD1ADBG ?></b></td>
				<td align="left" valign="top" width="20%"><input type="text" name="ad4_color_bg1" value="<?php echo $c_p->ad4_color_bg1; ?>" size="40" maxlength="100"></td>
				<td width="60%" align="left" valign="top"><?php echo _HWDRM_SETT_AD1ADBG_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _HWDRM_SETT_AD1ADLINK ?></b></td>
				<td align="left" valign="top" width="20%"><input type="text" name="ad4_color_link1" value="<?php echo $c_p->ad4_color_link1; ?>" size="40" maxlength="100"></td>
				<td width="60%" align="left" valign="top"><?php echo _HWDRM_SETT_AD1ADLINK_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _HWDRM_SETT_AD1ADTEXT ?></b></td>
				<td align="left" valign="top" width="20%"><input type="text" name="ad4_color_text1" value="<?php echo $c_p->ad4_color_text1; ?>" size="40" maxlength="100"></td>
				<td width="60%" align="left" valign="top"><?php echo _HWDRM_SETT_AD1ADTEXT_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _HWDRM_SETT_AD1ADURL ?></b></td>
				<td align="left" valign="top" width="20%"><input type="text" name="ad4_color_url1" value="<?php echo $c_p->ad4_color_url1; ?>" size="40" maxlength="100"></td>
				<td width="60%" align="left" valign="top"><?php echo _HWDRM_SETT_AD1ADURL_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _HWDRM_SETT_AD1CUSTOM ?></b></td>
				<td width="20%" align="left" valign="top"><textarea rows="5" name="ad4custom"><?php echo stripslashes($c_p->ad4custom); ?></textarea></td>
				<td width="60%" align="left" valign="top"><?php echo _HWDRM_SETT_AD1CUSTOM_DESC ?></td>
			  </tr>
			</table>
			</div>
			<?php
			echo $endtab;
			echo $starttab5;
			?>
			<div style="margin:1px;padding:1px;"><br />
			<table cellpadding="0" cellspacing="0" border="0" width="95%" class="adminform">
			  <tr><td align="left" valign="top" colspan="3">
			  <h3><?php echo _HWDRM_VSADPOS5 ?></h3>
			  <p><?php echo _HWDRM_DOCS ?> <a href="http://documentation.hwdmediashare.co.uk/wiki/Main_Page" target="_blank">http://documentation.hwdmediashare.co.uk/wiki/Main_Page</a></p>
			  </td></tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _HWDRM_SETT_SHOWAD1 ?></b></td>
				<td width="20%" align="left" valign="top">
				<select name="ad5show" size="1" class="inputbox">
					<option value="2"<?php if ($c_p->ad5show == 2) { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_ADSENSE.' '; ?></option>
					<option value="1"<?php if ($c_p->ad5show == 1) { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_CUSTOM.' '; ?></option>
					<option value="0"<?php if ($c_p->ad5show == 0) { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_NO.' '; ?></option>
				</select>
				</td>
				<td width="60%" align="left" valign="top"><?php echo _HWDRM_SETT_SHOWAD1_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _HWDRM_SETT_AD1ADCLIENT ?></b></td>
				<td align="left" valign="top" width="20%"><input type="text" name="ad5_ad_client" value="<?php echo $c_p->ad5_ad_client; ?>" size="40" maxlength="100"></td>
				<td width="60%" align="left" valign="top"><?php echo _HWDRM_SETT_AD1ADCLIENT_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _HWDRM_SETT_AD1ADCHANNEL ?></b></td>
				<td align="left" valign="top" width="20%"><input type="text" name="ad5_ad_channel" value="<?php echo $c_p->ad5_ad_channel; ?>" size="40" maxlength="100"></td>
				<td width="60%" align="left" valign="top"><?php echo _HWDRM_SETT_AD1ADCHANNEL_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _HWDRM_SETT_AD1ADTYPE ?></b></td>
				<td width="20%" align="left" valign="top">
				<select name="ad5_ad_type" size="1" class="inputbox">
					<option value="text_image"<?php if ($c_p->ad5_ad_type == "text_image") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_ADS_TANDI.' '; ?></option>
					<option value="text"<?php if ($c_p->ad5_ad_type == "text") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_ADS_TEXT.' '; ?></option>
					<option value="image"<?php if ($c_p->ad5_ad_type == "image") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_ADS_IMAGE.' '; ?></option>
				</select>
				</td>
				<td width="60%" align="left" valign="top"><?php echo _HWDRM_SETT_AD1ADTYPE_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _HWDRM_SETT_AD1UIF ?></b></td>
				<td width="20%" align="left" valign="top">
				<select name="ad5_ad_uifeatures" size="1" class="inputbox">
					<option value="0"<?php if ($c_p->ad5_ad_uifeatures == 0) { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_ADS_SQUARE.' '; ?></option>
					<option value="6"<?php if ($c_p->ad5_ad_uifeatures == 6) { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_ADS_SR.' '; ?></option>
					<option value="10"<?php if ($c_p->ad5_ad_uifeatures == 10) { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_ADS_VR.' '; ?></option>
				</select>
				</td>
				<td width="60%" align="left" valign="top"><?php echo _HWDRM_SETT_AD1ADUIF_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _HWDRM_SETT_AD1LAYOUT ?></b></td>
				<td width="20%" align="left" valign="top">
				<select name="ad5_ad_format" size="1" class="inputbox">
					<option value="468x60_as"<?php if ($c_p->ad5_ad_format == "468x60_as") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM1.' '; ?></option>
					<option value="234x60_as"<?php if ($c_p->ad5_ad_format == "234x60_as") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM2.' '; ?></option>
					<option value=""> --- </option>
					<option value="120x600_as"<?php if ($c_p->ad5_ad_format == "120x600_as") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM3.' '; ?></option>
					<option value="160x600_as"<?php if ($c_p->ad5_ad_format == "160x600_as") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM4.' '; ?></option>
					<option value="120x240_as"<?php if ($c_p->ad5_ad_format == "120x240_as") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM5.' '; ?></option>
					<option value=""> --- </option>
					<option value="336x280_as"<?php if ($c_p->ad5_ad_format == "336x280_as") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM6.' '; ?></option>
					<option value="300x250_as"<?php if ($c_p->ad5_ad_format == "300x250_as") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM7.' '; ?></option>
					<option value="250x250_as"<?php if ($c_p->ad5_ad_format == "250x250_as") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM8.' '; ?></option>
					<option value="200x200_as"<?php if ($c_p->ad5_ad_format == "200x200_as") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM9.' '; ?></option>
					<option value="180x150_as"<?php if ($c_p->ad5_ad_format == "180x150_as") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM10.' '; ?></option>
					<option value="125x125_as"<?php if ($c_p->ad5_ad_format == "125x125_as") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM11.' '; ?></option>
					<option value=""> --- </option>
					<option value="728x90_as"<?php if ($c_p->ad5_ad_format == "728x90_as") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM12.' '; ?></option>
					<option value=""> --- </option>
					<option value="728x15_0ads_al"<?php if ($c_p->ad5_ad_format == "728x15_0ads_al") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM13.' '; ?></option>
					<option value="468x15_0ads_al"<?php if ($c_p->ad5_ad_format == "468x15_0ads_al") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM14.' '; ?></option>
					<option value="120x90_0ads_al"<?php if ($c_p->ad5_ad_format == "120x90_0ads_al") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM15.' '; ?></option>
					<option value="160x90_0ads_al"<?php if ($c_p->ad5_ad_format == "160x90_0ads_al") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM16.' '; ?></option>
					<option value="180x90_0ads_al"<?php if ($c_p->ad5_ad_format == "180x90_0ads_al") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM17.' '; ?></option>
					<option value="200x90_0ads_al"<?php if ($c_p->ad5_ad_format == "200x90_0ads_al") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM18.' '; ?></option>
					<option value=""> --- </option>
					<option value="728x15_0ads_al_s"<?php if ($c_p->ad5_ad_format == "728x15_0ads_al_s") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM19.' '; ?></option>
					<option value="468x15_0ads_al_s"<?php if ($c_p->ad5_ad_format == "468x15_0ads_al_s") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM20.' '; ?></option>
					<option value="120x90_0ads_al_s"<?php if ($c_p->ad5_ad_format == "120x90_0ads_al_s") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM21.' '; ?></option>
					<option value="160x90_0ads_al_s"<?php if ($c_p->ad5_ad_format == "160x90_0ads_al_s") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM22.' '; ?></option>
					<option value="180x90_0ads_al_s"<?php if ($c_p->ad5_ad_format == "180x90_0ads_al_s") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM23.' '; ?></option>
					<option value="200x90_0ads_al_s"<?php if ($c_p->ad5_ad_format == "200x90_0ads_al_s") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM24.' '; ?></option>
				</select>
				</td>
				<td width="60%" align="left" valign="top"><?php echo _HWDRM_SETT_AD1LAYOUT_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _HWDRM_SETT_AD1ADBORDER ?></b></td>
				<td align="left" valign="top" width="20%"><input type="text" name="ad5_color_border1" value="<?php echo $c_p->ad5_color_border1; ?>" size="40" maxlength="100"></td>
				<td width="60%" align="left" valign="top"><?php echo _HWDRM_SETT_AD1ADBORDER_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _HWDRM_SETT_AD1ADBG ?></b></td>
				<td align="left" valign="top" width="20%"><input type="text" name="ad5_color_bg1" value="<?php echo $c_p->ad5_color_bg1; ?>" size="40" maxlength="100"></td>
				<td width="60%" align="left" valign="top"><?php echo _HWDRM_SETT_AD1ADBG_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _HWDRM_SETT_AD1ADLINK ?></b></td>
				<td align="left" valign="top" width="20%"><input type="text" name="ad5_color_link1" value="<?php echo $c_p->ad5_color_link1; ?>" size="40" maxlength="100"></td>
				<td width="60%" align="left" valign="top"><?php echo _HWDRM_SETT_AD1ADLINK_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _HWDRM_SETT_AD1ADTEXT ?></b></td>
				<td align="left" valign="top" width="20%"><input type="text" name="ad5_color_text1" value="<?php echo $c_p->ad5_color_text1; ?>" size="40" maxlength="100"></td>
				<td width="60%" align="left" valign="top"><?php echo _HWDRM_SETT_AD1ADTEXT_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _HWDRM_SETT_AD1ADURL ?></b></td>
				<td align="left" valign="top" width="20%"><input type="text" name="ad5_color_url1" value="<?php echo $c_p->ad5_color_url1; ?>" size="40" maxlength="100"></td>
				<td width="60%" align="left" valign="top"><?php echo _HWDRM_SETT_AD1ADURL_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _HWDRM_SETT_AD1CUSTOM ?></b></td>
				<td width="20%" align="left" valign="top"><textarea rows="5" name="ad5custom"><?php echo stripslashes($c_p->ad5custom); ?></textarea></td>
				<td width="60%" align="left" valign="top"><?php echo _HWDRM_SETT_AD1CUSTOM_DESC ?></td>
			  </tr>
			</table>
			</div>
			<?php
			echo $endtab;
			echo $starttab6;
			?>
			<div style="margin:1px;padding:1px;"><br />
			<table cellpadding="0" cellspacing="0" border="0" width="95%" class="adminform">
			  <tr><td align="left" valign="top" colspan="3">
			  <h3><?php echo _HWDRM_VSADCUSPOS1 ?></h3>
			  <p><?php echo _HWDRM_DOCS ?> <a href="http://documentation.hwdmediashare.co.uk/wiki/Main_Page" target="_blank">http://documentation.hwdmediashare.co.uk/wiki/Main_Page</a></p>
			  </td></tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _HWDRM_SETT_SHOWAD1 ?></b></td>
				<td width="20%" align="left" valign="top">
				<select name="ad6show" size="1" class="inputbox">
					<option value="2"<?php if ($c_p->ad6show == 2) { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_ADSENSE.' '; ?></option>
					<option value="1"<?php if ($c_p->ad6show == 1) { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_CUSTOM.' '; ?></option>
					<option value="0"<?php if ($c_p->ad6show == 0) { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_NO.' '; ?></option>
				</select>
				</td>
				<td width="60%" align="left" valign="top"><?php echo _HWDRM_SETT_SHOWAD1_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _HWDRM_SETT_AD1ADCLIENT ?></b></td>
				<td align="left" valign="top" width="20%"><input type="text" name="ad6_ad_client" value="<?php echo $c_p->ad6_ad_client; ?>" size="40" maxlength="100"></td>
				<td width="60%" align="left" valign="top"><?php echo _HWDRM_SETT_AD1ADCLIENT_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _HWDRM_SETT_AD1ADCHANNEL ?></b></td>
				<td align="left" valign="top" width="20%"><input type="text" name="ad6_ad_channel" value="<?php echo $c_p->ad6_ad_channel; ?>" size="40" maxlength="100"></td>
				<td width="60%" align="left" valign="top"><?php echo _HWDRM_SETT_AD1ADCHANNEL_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _HWDRM_SETT_AD1ADTYPE ?></b></td>
				<td width="20%" align="left" valign="top">
				<select name="ad6_ad_type" size="1" class="inputbox">
					<option value="text_image"<?php if ($c_p->ad6_ad_type == "text_image") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_ADS_TANDI.' '; ?></option>
					<option value="text"<?php if ($c_p->ad6_ad_type == "text") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_ADS_TEXT.' '; ?></option>
					<option value="image"<?php if ($c_p->ad6_ad_type == "image") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_ADS_IMAGE.' '; ?></option>
				</select>
				</td>
				<td width="60%" align="left" valign="top"><?php echo _HWDRM_SETT_AD1ADTYPE_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _HWDRM_SETT_AD1UIF ?></b></td>
				<td width="20%" align="left" valign="top">
				<select name="ad6_ad_uifeatures" size="1" class="inputbox">
					<option value="0"<?php if ($c_p->ad6_ad_uifeatures == 0) { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_ADS_SQUARE.' '; ?></option>
					<option value="6"<?php if ($c_p->ad6_ad_uifeatures == 6) { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_ADS_SR.' '; ?></option>
					<option value="10"<?php if ($c_p->ad6_ad_uifeatures == 10) { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_ADS_VR.' '; ?></option>
				</select>
				</td>
				<td width="60%" align="left" valign="top"><?php echo _HWDRM_SETT_AD1ADUIF_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _HWDRM_SETT_AD1LAYOUT ?></b></td>
				<td width="20%" align="left" valign="top">
				<select name="ad6_ad_format" size="1" class="inputbox">
					<option value="468x60_as"<?php if ($c_p->ad6_ad_format == "468x60_as") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM1.' '; ?></option>
					<option value="234x60_as"<?php if ($c_p->ad6_ad_format == "234x60_as") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM2.' '; ?></option>
					<option value=""> --- </option>
					<option value="120x600_as"<?php if ($c_p->ad6_ad_format == "120x600_as") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM3.' '; ?></option>
					<option value="160x600_as"<?php if ($c_p->ad6_ad_format == "160x600_as") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM4.' '; ?></option>
					<option value="120x240_as"<?php if ($c_p->ad6_ad_format == "120x240_as") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM5.' '; ?></option>
					<option value=""> --- </option>
					<option value="336x280_as"<?php if ($c_p->ad6_ad_format == "336x280_as") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM6.' '; ?></option>
					<option value="300x250_as"<?php if ($c_p->ad6_ad_format == "300x250_as") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM7.' '; ?></option>
					<option value="250x250_as"<?php if ($c_p->ad6_ad_format == "250x250_as") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM8.' '; ?></option>
					<option value="200x200_as"<?php if ($c_p->ad6_ad_format == "200x200_as") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM9.' '; ?></option>
					<option value="180x150_as"<?php if ($c_p->ad6_ad_format == "180x150_as") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM10.' '; ?></option>
					<option value="125x125_as"<?php if ($c_p->ad6_ad_format == "125x125_as") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM11.' '; ?></option>
					<option value=""> --- </option>
					<option value="728x90_as"<?php if ($c_p->ad6_ad_format == "728x90_as") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM12.' '; ?></option>
					<option value=""> --- </option>
					<option value="728x15_0ads_al"<?php if ($c_p->ad6_ad_format == "728x15_0ads_al") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM13.' '; ?></option>
					<option value="468x15_0ads_al"<?php if ($c_p->ad6_ad_format == "468x15_0ads_al") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM14.' '; ?></option>
					<option value="120x90_0ads_al"<?php if ($c_p->ad6_ad_format == "120x90_0ads_al") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM15.' '; ?></option>
					<option value="160x90_0ads_al"<?php if ($c_p->ad6_ad_format == "160x90_0ads_al") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM16.' '; ?></option>
					<option value="180x90_0ads_al"<?php if ($c_p->ad6_ad_format == "180x90_0ads_al") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM17.' '; ?></option>
					<option value="200x90_0ads_al"<?php if ($c_p->ad6_ad_format == "200x90_0ads_al") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM18.' '; ?></option>
					<option value=""> --- </option>
					<option value="728x15_0ads_al_s"<?php if ($c_p->ad6_ad_format == "728x15_0ads_al_s") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM19.' '; ?></option>
					<option value="468x15_0ads_al_s"<?php if ($c_p->ad6_ad_format == "468x15_0ads_al_s") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM20.' '; ?></option>
					<option value="120x90_0ads_al_s"<?php if ($c_p->ad6_ad_format == "120x90_0ads_al_s") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM21.' '; ?></option>
					<option value="160x90_0ads_al_s"<?php if ($c_p->ad6_ad_format == "160x90_0ads_al_s") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM22.' '; ?></option>
					<option value="180x90_0ads_al_s"<?php if ($c_p->ad6_ad_format == "180x90_0ads_al_s") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM23.' '; ?></option>
					<option value="200x90_0ads_al_s"<?php if ($c_p->ad6_ad_format == "200x90_0ads_al_s") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM24.' '; ?></option>
				</select>
				</td>
				<td width="60%" align="left" valign="top"><?php echo _HWDRM_SETT_AD1LAYOUT_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _HWDRM_SETT_AD1ADBORDER ?></b></td>
				<td align="left" valign="top" width="20%"><input type="text" name="ad6_color_border1" value="<?php echo $c_p->ad6_color_border1; ?>" size="40" maxlength="100"></td>
				<td width="60%" align="left" valign="top"><?php echo _HWDRM_SETT_AD1ADBORDER_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _HWDRM_SETT_AD1ADBG ?></b></td>
				<td align="left" valign="top" width="20%"><input type="text" name="ad6_color_bg1" value="<?php echo $c_p->ad6_color_bg1; ?>" size="40" maxlength="100"></td>
				<td width="60%" align="left" valign="top"><?php echo _HWDRM_SETT_AD1ADBG_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _HWDRM_SETT_AD1ADLINK ?></b></td>
				<td align="left" valign="top" width="20%"><input type="text" name="ad6_color_link1" value="<?php echo $c_p->ad6_color_link1; ?>" size="40" maxlength="100"></td>
				<td width="60%" align="left" valign="top"><?php echo _HWDRM_SETT_AD1ADLINK_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _HWDRM_SETT_AD1ADTEXT ?></b></td>
				<td align="left" valign="top" width="20%"><input type="text" name="ad6_color_text1" value="<?php echo $c_p->ad6_color_text1; ?>" size="40" maxlength="100"></td>
				<td width="60%" align="left" valign="top"><?php echo _HWDRM_SETT_AD1ADTEXT_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _HWDRM_SETT_AD1ADURL ?></b></td>
				<td align="left" valign="top" width="20%"><input type="text" name="ad6_color_url1" value="<?php echo $c_p->ad6_color_url1; ?>" size="40" maxlength="100"></td>
				<td width="60%" align="left" valign="top"><?php echo _HWDRM_SETT_AD1ADURL_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _HWDRM_SETT_AD1CUSTOM ?></b></td>
				<td width="20%" align="left" valign="top"><textarea rows="5" name="ad6custom"><?php echo stripslashes($c_p->ad6custom); ?></textarea></td>
				<td width="60%" align="left" valign="top"><?php echo _HWDRM_SETT_AD1CUSTOM_DESC ?></td>
			  </tr>
			</table>
			</div>
			<?php
			echo $endtab;
			echo $starttab7;
			?>
			<div style="margin:1px;padding:1px;"><br />
			<table cellpadding="0" cellspacing="0" border="0" width="95%" class="adminform">
			  <tr><td align="left" valign="top" colspan="3">
			  <h3><?php echo _HWDRM_VSADCUSPOS2 ?></h3>
			  <p><?php echo _HWDRM_DOCS ?> <a href="http://documentation.hwdmediashare.co.uk/wiki/Main_Page" target="_blank">http://documentation.hwdmediashare.co.uk/wiki/Main_Page</a></p>
			  </td></tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _HWDRM_SETT_SHOWAD1 ?></b></td>
				<td width="20%" align="left" valign="top">
				<select name="ad7show" size="1" class="inputbox">
					<option value="2"<?php if ($c_p->ad7show == 2) { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_ADSENSE.' '; ?></option>
					<option value="1"<?php if ($c_p->ad7show == 1) { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_CUSTOM.' '; ?></option>
					<option value="0"<?php if ($c_p->ad7show == 0) { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_NO.' '; ?></option>
				</select>
				</td>
				<td width="60%" align="left" valign="top"><?php echo _HWDRM_SETT_SHOWAD1_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _HWDRM_SETT_AD1ADCLIENT ?></b></td>
				<td align="left" valign="top" width="20%"><input type="text" name="ad7_ad_client" value="<?php echo $c_p->ad7_ad_client; ?>" size="40" maxlength="100"></td>
				<td width="60%" align="left" valign="top"><?php echo _HWDRM_SETT_AD1ADCLIENT_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _HWDRM_SETT_AD1ADCHANNEL ?></b></td>
				<td align="left" valign="top" width="20%"><input type="text" name="ad7_ad_channel" value="<?php echo $c_p->ad7_ad_channel; ?>" size="40" maxlength="100"></td>
				<td width="60%" align="left" valign="top"><?php echo _HWDRM_SETT_AD1ADCHANNEL_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _HWDRM_SETT_AD1ADTYPE ?></b></td>
				<td width="20%" align="left" valign="top">
				<select name="ad7_ad_type" size="1" class="inputbox">
					<option value="text_image"<?php if ($c_p->ad7_ad_type == "text_image") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_ADS_TANDI.' '; ?></option>
					<option value="text"<?php if ($c_p->ad7_ad_type == "text") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_ADS_TEXT.' '; ?></option>
					<option value="image"<?php if ($c_p->ad7_ad_type == "image") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_ADS_IMAGE.' '; ?></option>
				</select>
				</td>
				<td width="60%" align="left" valign="top"><?php echo _HWDRM_SETT_AD1ADTYPE_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _HWDRM_SETT_AD1UIF ?></b></td>
				<td width="20%" align="left" valign="top">
				<select name="ad7_ad_uifeatures" size="1" class="inputbox">
					<option value="0"<?php if ($c_p->ad7_ad_uifeatures == 0) { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_ADS_SQUARE.' '; ?></option>
					<option value="6"<?php if ($c_p->ad7_ad_uifeatures == 6) { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_ADS_SR.' '; ?></option>
					<option value="10"<?php if ($c_p->ad7_ad_uifeatures == 10) { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_ADS_VR.' '; ?></option>
				</select>
				</td>
				<td width="60%" align="left" valign="top"><?php echo _HWDRM_SETT_AD1ADUIF_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _HWDRM_SETT_AD1LAYOUT ?></b></td>
				<td width="20%" align="left" valign="top">
				<select name="ad7_ad_format" size="1" class="inputbox">
					<option value="468x60_as"<?php if ($c_p->ad7_ad_format == "468x60_as") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM1.' '; ?></option>
					<option value="234x60_as"<?php if ($c_p->ad7_ad_format == "234x60_as") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM2.' '; ?></option>
					<option value=""> --- </option>
					<option value="120x600_as"<?php if ($c_p->ad7_ad_format == "120x600_as") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM3.' '; ?></option>
					<option value="160x600_as"<?php if ($c_p->ad7_ad_format == "160x600_as") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM4.' '; ?></option>
					<option value="120x240_as"<?php if ($c_p->ad7_ad_format == "120x240_as") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM5.' '; ?></option>
					<option value=""> --- </option>
					<option value="336x280_as"<?php if ($c_p->ad7_ad_format == "336x280_as") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM6.' '; ?></option>
					<option value="300x250_as"<?php if ($c_p->ad7_ad_format == "300x250_as") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM7.' '; ?></option>
					<option value="250x250_as"<?php if ($c_p->ad7_ad_format == "250x250_as") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM8.' '; ?></option>
					<option value="200x200_as"<?php if ($c_p->ad7_ad_format == "200x200_as") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM9.' '; ?></option>
					<option value="180x150_as"<?php if ($c_p->ad7_ad_format == "180x150_as") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM10.' '; ?></option>
					<option value="125x125_as"<?php if ($c_p->ad7_ad_format == "125x125_as") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM11.' '; ?></option>
					<option value=""> --- </option>
					<option value="728x90_as"<?php if ($c_p->ad7_ad_format == "728x90_as") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM12.' '; ?></option>
					<option value=""> --- </option>
					<option value="728x15_0ads_al"<?php if ($c_p->ad7_ad_format == "728x15_0ads_al") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM13.' '; ?></option>
					<option value="468x15_0ads_al"<?php if ($c_p->ad7_ad_format == "468x15_0ads_al") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM14.' '; ?></option>
					<option value="120x90_0ads_al"<?php if ($c_p->ad7_ad_format == "120x90_0ads_al") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM15.' '; ?></option>
					<option value="160x90_0ads_al"<?php if ($c_p->ad7_ad_format == "160x90_0ads_al") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM16.' '; ?></option>
					<option value="180x90_0ads_al"<?php if ($c_p->ad7_ad_format == "180x90_0ads_al") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM17.' '; ?></option>
					<option value="200x90_0ads_al"<?php if ($c_p->ad7_ad_format == "200x90_0ads_al") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM18.' '; ?></option>
					<option value=""> --- </option>
					<option value="728x15_0ads_al_s"<?php if ($c_p->ad7_ad_format == "728x15_0ads_al_s") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM19.' '; ?></option>
					<option value="468x15_0ads_al_s"<?php if ($c_p->ad7_ad_format == "468x15_0ads_al_s") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM20.' '; ?></option>
					<option value="120x90_0ads_al_s"<?php if ($c_p->ad7_ad_format == "120x90_0ads_al_s") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM21.' '; ?></option>
					<option value="160x90_0ads_al_s"<?php if ($c_p->ad7_ad_format == "160x90_0ads_al_s") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM22.' '; ?></option>
					<option value="180x90_0ads_al_s"<?php if ($c_p->ad7_ad_format == "180x90_0ads_al_s") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM23.' '; ?></option>
					<option value="200x90_0ads_al_s"<?php if ($c_p->ad7_ad_format == "200x90_0ads_al_s") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM24.' '; ?></option>
				</select>
				</td>
				<td width="60%" align="left" valign="top"><?php echo _HWDRM_SETT_AD1LAYOUT_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _HWDRM_SETT_AD1ADBORDER ?></b></td>
				<td align="left" valign="top" width="20%"><input type="text" name="ad7_color_border1" value="<?php echo $c_p->ad7_color_border1; ?>" size="40" maxlength="100"></td>
				<td width="60%" align="left" valign="top"><?php echo _HWDRM_SETT_AD1ADBORDER_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _HWDRM_SETT_AD1ADBG ?></b></td>
				<td align="left" valign="top" width="20%"><input type="text" name="ad7_color_bg1" value="<?php echo $c_p->ad7_color_bg1; ?>" size="40" maxlength="100"></td>
				<td width="60%" align="left" valign="top"><?php echo _HWDRM_SETT_AD1ADBG_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _HWDRM_SETT_AD1ADLINK ?></b></td>
				<td align="left" valign="top" width="20%"><input type="text" name="ad7_color_link1" value="<?php echo $c_p->ad7_color_link1; ?>" size="40" maxlength="100"></td>
				<td width="60%" align="left" valign="top"><?php echo _HWDRM_SETT_AD1ADLINK_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _HWDRM_SETT_AD1ADTEXT ?></b></td>
				<td align="left" valign="top" width="20%"><input type="text" name="ad7_color_text1" value="<?php echo $c_p->ad7_color_text1; ?>" size="40" maxlength="100"></td>
				<td width="60%" align="left" valign="top"><?php echo _HWDRM_SETT_AD1ADTEXT_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _HWDRM_SETT_AD1ADURL ?></b></td>
				<td align="left" valign="top" width="20%"><input type="text" name="ad7_color_url1" value="<?php echo $c_p->ad7_color_url1; ?>" size="40" maxlength="100"></td>
				<td width="60%" align="left" valign="top"><?php echo _HWDRM_SETT_AD1ADURL_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _HWDRM_SETT_AD1CUSTOM ?></b></td>
				<td width="20%" align="left" valign="top"><textarea rows="5" name="ad7custom"><?php echo stripslashes($c_p->ad7custom); ?></textarea></td>
				<td width="60%" align="left" valign="top"><?php echo _HWDRM_SETT_AD1CUSTOM_DESC ?></td>
			  </tr>
			</table>
			</div>
			<?php
			echo $endtab;
			echo $starttab8;
			?>
			<div style="margin:1px;padding:1px;"><br />
			<table cellpadding="0" cellspacing="0" border="0" width="95%" class="adminform">
			  <tr><td align="left" valign="top" colspan="3">
			  <h3><?php echo _HWDRM_VSADCUSPOS3 ?></h3>
			  <p><?php echo _HWDRM_DOCS ?> <a href="http://documentation.hwdmediashare.co.uk/wiki/Main_Page" target="_blank">http://documentation.hwdmediashare.co.uk/wiki/Main_Page</a></p>
			  </td></tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _HWDRM_SETT_SHOWAD1 ?></b></td>
				<td width="20%" align="left" valign="top">
				<select name="ad8show" size="1" class="inputbox">
					<option value="2"<?php if ($c_p->ad8show == 2) { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_ADSENSE.' '; ?></option>
					<option value="1"<?php if ($c_p->ad8show == 1) { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_CUSTOM.' '; ?></option>
					<option value="0"<?php if ($c_p->ad8show == 0) { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_NO.' '; ?></option>
				</select>
				</td>
				<td width="60%" align="left" valign="top"><?php echo _HWDRM_SETT_SHOWAD1_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _HWDRM_SETT_AD1ADCLIENT ?></b></td>
				<td align="left" valign="top" width="20%"><input type="text" name="ad8_ad_client" value="<?php echo $c_p->ad8_ad_client; ?>" size="40" maxlength="100"></td>
				<td width="60%" align="left" valign="top"><?php echo _HWDRM_SETT_AD1ADCLIENT_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _HWDRM_SETT_AD1ADCHANNEL ?></b></td>
				<td align="left" valign="top" width="20%"><input type="text" name="ad8_ad_channel" value="<?php echo $c_p->ad8_ad_channel; ?>" size="40" maxlength="100"></td>
				<td width="60%" align="left" valign="top"><?php echo _HWDRM_SETT_AD1ADCHANNEL_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _HWDRM_SETT_AD1ADTYPE ?></b></td>
				<td width="20%" align="left" valign="top">
				<select name="ad8_ad_type" size="1" class="inputbox">
					<option value="text_image"<?php if ($c_p->ad8_ad_type == "text_image") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_ADS_TANDI.' '; ?></option>
					<option value="text"<?php if ($c_p->ad8_ad_type == "text") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_ADS_TEXT.' '; ?></option>
					<option value="image"<?php if ($c_p->ad8_ad_type == "image") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_ADS_IMAGE.' '; ?></option>
				</select>
				</td>
				<td width="60%" align="left" valign="top"><?php echo _HWDRM_SETT_AD1ADTYPE_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _HWDRM_SETT_AD1UIF ?></b></td>
				<td width="20%" align="left" valign="top">
				<select name="ad8_ad_uifeatures" size="1" class="inputbox">
					<option value="0"<?php if ($c_p->ad8_ad_uifeatures == 0) { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_ADS_SQUARE.' '; ?></option>
					<option value="6"<?php if ($c_p->ad8_ad_uifeatures == 6) { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_ADS_SR.' '; ?></option>
					<option value="10"<?php if ($c_p->ad8_ad_uifeatures == 10) { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_ADS_VR.' '; ?></option>
				</select>
				</td>
				<td width="60%" align="left" valign="top"><?php echo _HWDRM_SETT_AD1ADUIF_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _HWDRM_SETT_AD1LAYOUT ?></b></td>
				<td width="20%" align="left" valign="top">
				<select name="ad8_ad_format" size="1" class="inputbox">
					<option value="468x60_as"<?php if ($c_p->ad8_ad_format == "468x60_as") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM1.' '; ?></option>
					<option value="234x60_as"<?php if ($c_p->ad8_ad_format == "234x60_as") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM2.' '; ?></option>
					<option value=""> --- </option>
					<option value="120x600_as"<?php if ($c_p->ad8_ad_format == "120x600_as") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM3.' '; ?></option>
					<option value="160x600_as"<?php if ($c_p->ad8_ad_format == "160x600_as") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM4.' '; ?></option>
					<option value="120x240_as"<?php if ($c_p->ad8_ad_format == "120x240_as") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM5.' '; ?></option>
					<option value=""> --- </option>
					<option value="336x280_as"<?php if ($c_p->ad8_ad_format == "336x280_as") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM6.' '; ?></option>
					<option value="300x250_as"<?php if ($c_p->ad8_ad_format == "300x250_as") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM7.' '; ?></option>
					<option value="250x250_as"<?php if ($c_p->ad8_ad_format == "250x250_as") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM8.' '; ?></option>
					<option value="200x200_as"<?php if ($c_p->ad8_ad_format == "200x200_as") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM9.' '; ?></option>
					<option value="180x150_as"<?php if ($c_p->ad8_ad_format == "180x150_as") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM10.' '; ?></option>
					<option value="125x125_as"<?php if ($c_p->ad8_ad_format == "125x125_as") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM11.' '; ?></option>
					<option value=""> --- </option>
					<option value="728x90_as"<?php if ($c_p->ad8_ad_format == "728x90_as") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM12.' '; ?></option>
					<option value=""> --- </option>
					<option value="728x15_0ads_al"<?php if ($c_p->ad8_ad_format == "728x15_0ads_al") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM13.' '; ?></option>
					<option value="468x15_0ads_al"<?php if ($c_p->ad8_ad_format == "468x15_0ads_al") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM14.' '; ?></option>
					<option value="120x90_0ads_al"<?php if ($c_p->ad8_ad_format == "120x90_0ads_al") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM15.' '; ?></option>
					<option value="160x90_0ads_al"<?php if ($c_p->ad8_ad_format == "160x90_0ads_al") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM16.' '; ?></option>
					<option value="180x90_0ads_al"<?php if ($c_p->ad8_ad_format == "180x90_0ads_al") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM17.' '; ?></option>
					<option value="200x90_0ads_al"<?php if ($c_p->ad8_ad_format == "200x90_0ads_al") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM18.' '; ?></option>
					<option value=""> --- </option>
					<option value="728x15_0ads_al_s"<?php if ($c_p->ad8_ad_format == "728x15_0ads_al_s") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM19.' '; ?></option>
					<option value="468x15_0ads_al_s"<?php if ($c_p->ad8_ad_format == "468x15_0ads_al_s") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM20.' '; ?></option>
					<option value="120x90_0ads_al_s"<?php if ($c_p->ad8_ad_format == "120x90_0ads_al_s") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM21.' '; ?></option>
					<option value="160x90_0ads_al_s"<?php if ($c_p->ad8_ad_format == "160x90_0ads_al_s") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM22.' '; ?></option>
					<option value="180x90_0ads_al_s"<?php if ($c_p->ad8_ad_format == "180x90_0ads_al_s") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM23.' '; ?></option>
					<option value="200x90_0ads_al_s"<?php if ($c_p->ad8_ad_format == "200x90_0ads_al_s") { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_AD1FORM24.' '; ?></option>
				</select>
				</td>
				<td width="60%" align="left" valign="top"><?php echo _HWDRM_SETT_AD1LAYOUT_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _HWDRM_SETT_AD1ADBORDER ?></b></td>
				<td align="left" valign="top" width="20%"><input type="text" name="ad8_color_border1" value="<?php echo $c_p->ad8_color_border1; ?>" size="40" maxlength="100"></td>
				<td width="60%" align="left" valign="top"><?php echo _HWDRM_SETT_AD1ADBORDER_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _HWDRM_SETT_AD1ADBG ?></b></td>
				<td align="left" valign="top" width="20%"><input type="text" name="ad8_color_bg1" value="<?php echo $c_p->ad8_color_bg1; ?>" size="40" maxlength="100"></td>
				<td width="60%" align="left" valign="top"><?php echo _HWDRM_SETT_AD1ADBG_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _HWDRM_SETT_AD1ADLINK ?></b></td>
				<td align="left" valign="top" width="20%"><input type="text" name="ad8_color_link1" value="<?php echo $c_p->ad8_color_link1; ?>" size="40" maxlength="100"></td>
				<td width="60%" align="left" valign="top"><?php echo _HWDRM_SETT_AD1ADLINK_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _HWDRM_SETT_AD1ADTEXT ?></b></td>
				<td align="left" valign="top" width="20%"><input type="text" name="ad8_color_text1" value="<?php echo $c_p->ad8_color_text1; ?>" size="40" maxlength="100"></td>
				<td width="60%" align="left" valign="top"><?php echo _HWDRM_SETT_AD1ADTEXT_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _HWDRM_SETT_AD1ADURL ?></b></td>
				<td align="left" valign="top" width="20%"><input type="text" name="ad8_color_url1" value="<?php echo $c_p->ad8_color_url1; ?>" size="40" maxlength="100"></td>
				<td width="60%" align="left" valign="top"><?php echo _HWDRM_SETT_AD1ADURL_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _HWDRM_SETT_AD1CUSTOM ?></b></td>
				<td width="20%" align="left" valign="top"><textarea rows="5" name="ad8custom"><?php echo stripslashes($c_p->ad8custom); ?></textarea></td>
				<td width="60%" align="left" valign="top"><?php echo _HWDRM_SETT_AD1CUSTOM_DESC ?></td>
			  </tr>
			</table>
			</div>
			<?php
			echo $endtab;
			echo $endpane;
			?>
		</div>
		<div style="clear:both;"></div>
		<input type="hidden" name="boxchecked" value="0" />
		<input type="hidden" name="option" value="com_hwdrevenuemanager" />
		<input type="hidden" name="task" value="savepssettings" />
		<input type="hidden" name="hidemainmenu" value="0">
		</form>
		<br />
		<table width="100%"  border="0" cellspacing="0" cellpadding="0" class="adminform">
  			<tr>
    			<td align="center"><center><?php copyright(); ?></center></td>
  			</tr>
		</table>
		<?php
  		}
	}







    /**
     * Shows hwdVideoShare revenue information
     *
     * @param string $option  the joomla component name
     * @param array  $compatibility  compatibility data
     * @return       Nothing
     */
	function videoads($option, $compatibility, $rows, $pageNav)
	{
		global $database;
		$c_v = hwd_rm_vs_Config::get_instance();
		$c_p = hwd_rm_ps_Config::get_instance();
		$db =& JFactory::getDBO();
		?>
		<form action="index.php" method="post" name="adminForm">
		<table cellpadding="0" cellspacing="0" border="0" width="100%" class="adminform">
			<tr>
		  		<td style="background-color: #202626; width:100%; text-align: right; vertical-align: top;" colspan="2">
		  		<img src="<?php echo JURI::root()."/administrator/components/com_hwdrevenuemanager/images/logo.png"; ?>" height="47" width="250" alt="Logo" style="float: left;" />
				<font style="color: #fffffe; font-size: 200%; font-weight: bold;"><?php echo _HWDPS_SECTIONHEAD_HWDVS; ?></font>
				</td>
			</tr>
  		</table>
  		<?php
  		if ($compatibility[0] == "0") {
  		?>
   		<div style="border: solid 1px #333;margin:5px 0 5px 0;padding:5px;text-align:left;font-weight:bold;"><?php echo _HWDRM_INFO_CONFIGF4." ".$compatibility[1]; ?></div>
		<div style="clear:both;"></div>
		<input type="hidden" name="boxchecked" value="0" />
		<input type="hidden" name="option" value="com_hwdrevenuemanager" />
		<input type="hidden" name="task" value="savevssettings" />
		<input type="hidden" name="hidemainmenu" value="0">
		</form>
		<br />
		<table width="100%"  border="0" cellspacing="0" cellpadding="0" class="adminform">
  			<tr>
    			<td align="center"><center><?php copyright(); ?></center></td>
  			</tr>
		</table>
  		<?php
  		} else {
  		?>
  		<div style="width:100%;margin-top:5px;text-align:left;">
		<div id="editcell">
		<table class="adminlist">
			<thead>
			  <tr>
				<th width="5" class="title">ID</th>
				<th width="5" class="title"><input type="checkbox" name="toggle" value="" onClick="checkAll(<?php echo count( $rows ); ?>);" /></th>
				<th class="title">Type</th>
				<th class="title">URL</th>
				<th class="title">Priority</th>
				<th class="title">Impressions</th>
				<th class="title">Activate Date</th>
				<th class="title">Deactivate Date</th>
				<th class="title">Impressions Limit</th>
				<th class="title" width="50">Status</th>
				<th class="title" width="50">Published?</th>
			  </tr>
			</thead>
			<tbody>
			<?php
			$k = 0;
			for($i=0, $n=count( $rows ); $i < $n; $i++) {
			$row = $rows[$i];
			$link = 'index.php?option=com_hwdrevenuemanager&task=editvad&cid='. $row->id;
			$checked = JHTML::_('grid.checkedout', $row, $i);
			?>
			<tr class="<?php echo "row$k"; ?>">
				<td><?php echo $row->id; ?></td>
				<td><?php echo $checked; ?></td>
				<?php
				if ($row->type == 0) {
					$type = "Pre-roll";
				} else {
					$type = "Post-roll";
				}
				?>
				<td><a href="<?php echo $link; ?>" title="Edit Advert"><?php echo $type; ?></a></td>
				<td><a href="<?php echo $row->url; ?>" title="Go to video advert" target="_blank"><?php echo $row->url; ?></a>
				<td><?php echo $row->priority; ?></td>
				<td><?php echo $row->impressions; ?></td>
				<td><?php echo $row->date_activate; ?></td>
				<td><?php echo $row->date_deactivate; ?></td>
				<td><?php echo $row->impression_limit; ?></td>
				<?php
				$now = strtotime(date("Y-m-d H:i:s"));
				$activate = strtotime($row->date_activate);
				$deactivate = strtotime($row->date_deactivate);

				if ($row->impressions >= $row->impression_limit || $now >= $deactivate || $now < $activate ) {
					$status = "De-activated";
				} else {
					$status = "Active";
				}
				?>
				<td><?php echo $status; ?></td>
				<?php
				$task = $row->published ? 'unpublish' : 'publish';
				$img = $row->published ? 'publish_g.png' : 'publish_x.png';
				$alt = $row->published ? 'Published' : 'Unpublished';
				?>
				<td><a href="javascript: void(0);" onclick="return listItemTask('cb<?php echo $i;?>','<?php echo $task;?>')"><img src="images/<?php echo $img;?>" width="12" height="12" border="0" alt="" /></a></td>
			</tr>
			<?php $k = 1 - $k;  } ?>
			</tbody>
			<tfoot>
			<tr>
				<td align="center" colspan="11"><?php echo $pageNav->writePagesLinks(); ?></td>
			</tr>
			<tr>
				<td align="center" colspan="11"><?php echo $pageNav->writePagesCounter(); ?></td>
			</tr>
			</tfoot>
		</table>
		</div>
		</div>
		<div style="clear:both;"></div>
		<input type="hidden" name="boxchecked" value="0" />
		<input type="hidden" name="limitstart" value="<?php echo $limitstart; ?>" />
		<input type="hidden" name="option" value="com_hwdrevenuemanager" />
		<input type="hidden" name="task" value="videoads" />
		<input type="hidden" name="hidemainmenu" value="0">
		</form>
		<br />
		<table width="100%"  border="0" cellspacing="0" cellpadding="0" class="adminform">
  			<tr>
    			<td align="center"><center><?php copyright(); ?></center></td>
  			</tr>
		</table>
		<?php
  		}
	}
    /**
     * Shows hwdVideoShare revenue information
     *
     * @param string $option  the joomla component name
     * @param array  $compatibility  compatibility data
     * @return       Nothing
     */
	function editvad($option, $compatibility, $row)
	{
		global $smartyvs, $task;
		$c_v = hwd_rm_vs_Config::get_instance();
		$c_p = hwd_rm_ps_Config::get_instance();
		$db =& JFactory::getDBO();
		JHTML::_('behavior.calendar');
		?>
		<form action="index.php" method="post" name="adminForm">
		<table cellpadding="0" cellspacing="0" border="0" width="100%" class="adminform">
			<tr>
		  		<td style="background-color: #202626; width:100%; text-align: right; vertical-align: top;" colspan="2">
		  		<img src="<?php echo JURI::root()."/administrator/components/com_hwdrevenuemanager/images/logo.png"; ?>" height="47" width="250" alt="Logo" style="float: left;" />
				<font style="color: #fffffe; font-size: 200%; font-weight: bold;"><?php echo _HWDPS_SECTIONHEAD_HWDVS; ?></font>
				</td>
			</tr>
  		</table>
  		<?php
  		if ($compatibility[0] == "0") {
  		?>
   		<div style="border: solid 1px #333;margin:5px 0 5px 0;padding:5px;text-align:left;font-weight:bold;"><?php echo _HWDRM_INFO_CONFIGF4." ".$compatibility[1]; ?></div>
		<div style="clear:both;"></div>
		<input type="hidden" name="boxchecked" value="0" />
		<input type="hidden" name="option" value="com_hwdrevenuemanager" />
		<input type="hidden" name="task" value="savevssettings" />
		<input type="hidden" name="hidemainmenu" value="0">
		</form>
		<br />
		<table width="100%"  border="0" cellspacing="0" cellpadding="0" class="adminform">
  			<tr>
    			<td align="center"><center><?php copyright(); ?></center></td>
  			</tr>
		</table>
  		<?php
  		} else {
  		?>
  		<div style="width:100%;margin-top:5px;text-align:left;">
		<div id="editcell">

<table cellpadding="4" cellspacing="1" border="0" class="adminform">
  <tr>
    <td width="50%" style="width:50%;" valign="top">
        <h1>Video Advert Details</h1>
		<table cellpadding="4" cellspacing="1" border="0">
		  <tr>
			<td valign="top" width="150">Advert type</td>
			<td valign="top">
			<select name="type">
				<option value="0" <?php if ($row->type == "0") { echo "selected=\"selected\""; } ?>>Pre-roll Advert</option>
				<option value="1" <?php if ($row->type == "1") { echo "selected=\"selected\""; } ?>>Post-roll Advert</option>
			</select>
			</td>
		  </tr>
		  <tr>
			<td valign="top">Advert URL</td>
			<td valign="top"><input type="text" name="url" value="<?php echo $row->url; ?>" size="50" /></td>
		  </tr>
		  <tr>
			<td valign="top">Priority</td>
			<td valign="top">
			<select name="priority">
				<option value="0" <?php if ($row->priority == "0") { echo "selected=\"selected\""; } ?>>0</option>
				<option value="1" <?php if ($row->priority == "1") { echo "selected=\"selected\""; } ?>>1</option>
				<option value="2" <?php if ($row->priority == "2") { echo "selected=\"selected\""; } ?>>2</option>
				<option value="3" <?php if ($row->priority == "3") { echo "selected=\"selected\""; } ?>>3</option>
				<option value="4" <?php if ($row->priority == "4") { echo "selected=\"selected\""; } ?>>4</option>
				<option value="5" <?php if ($row->priority == "5") { echo "selected=\"selected\""; } ?>>5</option>
				<option value="6" <?php if ($row->priority == "6") { echo "selected=\"selected\""; } ?>>6</option>
				<option value="7" <?php if ($row->priority == "7") { echo "selected=\"selected\""; } ?>>7</option>
				<option value="8" <?php if ($row->priority == "8") { echo "selected=\"selected\""; } ?>>8</option>
				<option value="9" <?php if ($row->priority == "9") { echo "selected=\"selected\""; } ?>>9</option>
			</select>
			</td>
		  </tr>
		  <tr>
			<td valign="top">Activate Date</td>
			<td valign="top"><input class="inputbox" type="text" name="date_activate" id="date_activate" size="25" maxlength="25" value="<?php echo $row->date_activate; ?>" />&nbsp;<input type="reset" class="button" value="..." onclick="return showCalendar('date_activate','%Y-%m-%d');" /></td>
		  </tr>
		  <tr>
			<td valign="top">Dectivate Date</td>
			<td valign="top"><input class="inputbox" type="text" name="date_deactivate" id="date_deactivate" size="25" maxlength="25" value="<?php echo $row->date_deactivate; ?>" />&nbsp;<input type="reset" class="button" value="..." onclick="return showCalendar('date_deactivate','%Y-%m-%d');" /></td>
		  </tr>
		  <tr>
			<td valign="top">Impression Limit</td>
			<td valign="top"><input type="text" name="impression_limit" value="<?php echo $row->impression_limit; ?>" /></td>
		  </tr>
		  <tr>
			<td valign="top">Published</td>
			<td valign="top">
			<select name="published">
				<option value="1" <?php if ($row->published == "1") { echo "selected=\"selected\""; } ?>>Yes</option>
				<option value="0" <?php if ($row->published == "0") { echo "selected=\"selected\""; } ?>>No</option>
			</select>
			</td>
		  </tr>
		</table>
    </td>
    <?php
    if ($task !== "newvad") {
	?>
    <td width="50%" style="width:50%:" valign="top">
      <div style="margin:5px;border:solid 1px #333;padding:5px;width:100%:">
        <h1>Watch Video Advert</h1>
        <center>
        <?php

		require_once(JPATH_SITE.DS.'administrator'.DS.'components'.DS.'com_hwdvideoshare'.DS.'helpers'.DS.'initialise.php');
		hwdvsInitialise::coreRequire();
		$c = hwd_vs_Config::get_instance();
		hwdvsInitialise::language('be');
		if (!hwdvsInitialise::template(false)) {return;}

		$show_video_ad = 0;
		$video->video_type = "direct";
		$video->video_url = $row->url;
		echo hwd_vs_tools::generateVideoPlayer($video);
        ?>
        </center>
      </div>
    </td>
    <?php
    }
	?>
  </tr>
</table>

		</div>
		</div>
		<div style="clear:both;"></div>
		<input type="hidden" name="id" value="<?php echo $row->id; ?>" />
		<input type="hidden" name="boxchecked" value="0" />
		<input type="hidden" name="option" value="com_hwdrevenuemanager" />
		<input type="hidden" name="task" value="savevad" />
		<input type="hidden" name="hidemainmenu" value="0">
		</form>
		<br />
		<table width="100%"  border="0" cellspacing="0" cellpadding="0" class="adminform">
  			<tr>
    			<td align="center"><center><?php copyright(); ?></center></td>
  			</tr>
		</table>
		<?php
  		}
	}






    /**
     * Shows hwdVideoShare revenue information
     *
     * @param string $option  the joomla component name
     * @param array  $compatibility  compatibility data
     * @return       Nothing
     */
	function longtail($option, $compatibility)
	{
		global $database;
		$c_l = hwd_rm_lt_Config::get_instance();
		$db =& JFactory::getDBO();
		?>
		<form action="index.php" method="post" name="adminForm">
		<table cellpadding="0" cellspacing="0" border="0" width="100%" class="adminform">
			<tr>
		  		<td style="background-color: #202626; width:100%; text-align: right; vertical-align: top;" colspan="2">
		  		<img src="<?php echo JURI::root()."/administrator/components/com_hwdrevenuemanager/images/logo.png"; ?>" height="47" width="250" alt="Logo" style="float: left;" />
				<font style="color: #fffffe; font-size: 200%; font-weight: bold;"><?php echo _HWDPS_SECTIONHEAD_HWDVS; ?></font>
				</td>
			</tr>
  		</table>
  		<?php
  		if (is_writable(HWDRM_ADMIN_PATH.'/config.vs.hwdrevenuemanager.php')) {
  			$config_file_status = "<span style=\"color:#458B00;\">"._HWDRM_INFO_CONFIGF2."</span>.";
  		} else {
  			$config_file_status = "<span style=\"color:#ff0000;\">"._HWDRM_INFO_CONFIGF3."</span>. (".HWDRM_ADMIN_PATH."/config.vs.hwdrevenuemanager.php)";
  		}
  		if ($compatibility[0] == "0") {
  		?>
   		<div style="border: solid 1px #333;margin:5px 0 5px 0;padding:5px;text-align:left;font-weight:bold;"><?php echo _HWDRM_INFO_CONFIGF4." ".$compatibility[1]; ?></div>
		<div style="clear:both;"></div>
		<input type="hidden" name="boxchecked" value="0" />
		<input type="hidden" name="option" value="com_hwdrevenuemanager" />
		<input type="hidden" name="task" value="savevssettings" />
		<input type="hidden" name="hidemainmenu" value="0">
		</form>
		<br />
		<table width="100%"  border="0" cellspacing="0" cellpadding="0" class="adminform">
  			<tr>
    			<td align="center"><center><?php copyright(); ?></center></td>
  			</tr>
		</table>
  		<?php
  		} else {
  		?>
  		<div style="border: solid 1px #333;margin:5px 0 5px 0;padding:5px;text-align:left;font-weight:bold;"><?php echo _HWDRM_INFO_CONFIGF1." ".$config_file_status; ?></div>
  		<div style="width:100%;margin-top:5px;text-align:left;">

			<table cellpadding="0" cellspacing="0" border="0" width="95%" class="adminform">
			  <tr><td align="left" valign="top" colspan="3">
			  <img src="<?php echo JURI::root()."/administrator/components/com_hwdrevenuemanager/images/longtail-logo.png"; ?>" style="float:right" />
			  <h3>Longtail Ad Solutions</h3>
			  <p><?php echo _HWDRM_DOCS ?> <a href="http://www.longtailvideo.com/" target="_blank">http://www.longtailvideo.com/</a></p>
			  <p>Enabling the LongTail integration will force hwdVideoShare to use the JW FLV Player.</p>
			  </td></tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b>Enable Longtail Adverts</b></td>
				<td width="20%" align="left" valign="top">
				<select name="enable_longtail" size="1" class="inputbox">
					<option value="1"<?php if ($c_l->enable_longtail == 1) { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_YES.' '; ?></option>
					<option value="0"<?php if ($c_l->enable_longtail == 0) { ?> selected="selected"<?php } ?>><?php echo _HWDRM_SETT_NO.' '; ?></option>
				</select>
				</td>
				<td width="60%" align="left" valign="top">Do you want to enable the LongTail Advert Solution to play pre, mid and post roll adverts in your videos?</td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b>Main Channel Code</b></td>
				<td align="left" valign="top" width="20%"><input type="text" name="longtail_channel_default" value="<?php echo $c_l->longtail_channel_default; ?>" size="40" maxlength="100"></td>
				<td width="60%" align="left" valign="top">This is the default channel number that will be used unless otherwise directed.</td>
			  </tr>
			  <!--
			  <tr>
				<td width="20%" align="left" valign="top"><b>d=</b></td>
				<td align="left" valign="top" width="20%"><input type="text" name="longtail_d" value="<?php echo $c_l->longtail_d; ?>" size="40" maxlength="100"></td>
				<td width="60%" align="left" valign="top">This is the value of the d parameter given in your Longtail dashboard.</td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b>s=</b></td>
				<td align="left" valign="top" width="20%"><input type="text" name="longtail_s" value="<?php echo $c_l->longtail_s; ?>" size="40" maxlength="100"></td>
				<td width="60%" align="left" valign="top">This is the value of the s parameter given in your Longtail dashboard.</td>
			  </tr>
			  -->
			</table>

		</div>
		<div style="clear:both;"></div>
		<input type="hidden" name="boxchecked" value="0" />
		<input type="hidden" name="option" value="com_hwdrevenuemanager" />
		<input type="hidden" name="task" value="saveltsettings" />
		<input type="hidden" name="hidemainmenu" value="0">
		</form>
		<br />
		<table width="100%"  border="0" cellspacing="0" cellpadding="0" class="adminform">
  			<tr>
    			<td align="center"><center><?php copyright(); ?></center></td>
  			</tr>
		</table>
		<?php
  		}
	}




}
?>