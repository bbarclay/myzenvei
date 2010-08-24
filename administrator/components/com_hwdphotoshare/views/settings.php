<?php
/**
 *    @version 2.1.1 Build 21108 Alpha [ Gehlen ]
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

class hwd_ps_HTML_settings
{
   /**
	* show general settings
	*/
	function showgeneralsettings(&$gtree)
	{
		global $mosConfig_live_site, $mosConfig_absolute_path, $mosConfig_mailfrom, $smartyps, $acl, $db;
		$c = hwd_ps_Config::get_instance();
		$db =& JFactory::getDBO();
		jimport('joomla.html.pane');
		$pane =& JPane::getInstance('tabs');
		$startpane = $pane->startPane( 'content-pane' );
		$endtab = $pane->endPanel();
		$endpane = $pane->endPane();
		$starttab1 = $pane->startPanel( _HWDPS_TAB_SETUP, 'panel1' );
		$starttab2 = $pane->startPanel( _HWDPS_TAB_SETTS, 'panel2' );
		$starttab3 = $pane->startPanel( _HWDPS_TAB_SHARES, 'panel3' );
		$starttab4 = $pane->startPanel( _HWDPS_TAB_APVLS, 'panel4' );
		$starttab5 = $pane->startPanel( _HWDPS_TAB_RESIZING, 'panel5' );
		$starttab6 = $pane->startPanel( _HWDPS_TAB_NOTFY, 'panel6' );
		$starttab7 = $pane->startPanel( _HWDPS_TAB_INTGTN, 'panel7' );
		$starttab8 = $pane->startPanel( _HWDPS_TAB_ACCESS, 'panel8' );



		/** assign template variables **/
		$smartyps->assign( "header_title", _HWDPS_SECTIONHEAD_GS );

		/** display template **/
		$smartyps->display('admin_header.tpl');

  		if (is_writable(JPATH_SITE.DS.'administrator'.DS.'components'.DS.'com_hwdphotoshare'.DS.'config.hwdphotoshare.php')) {
  			$config_file_status = "<span style=\"color:#458B00;\">"._HWDPS_INFO_CONFIGF2."</span>.";
  		} else {
  			$config_file_status = '<span style=\"color:#ff0000;\">'._HWDPS_INFO_CONFIGF3.'</span> ('.JPATH_SITE.DS.'administrator'.DS.'components'.DS.'com_hwdphotoshare'.DS.'config.hwdphotoshare.php)';
  		}
  		?>
  		<div style="border: solid 1px #333;margin:5px 0 5px 0;padding:5px;text-align:left;font-weight:bold;"><?php echo _HWDPS_INFO_CONFIGF1." ".$config_file_status; ?></div>
		<?php
		$upload_max = ereg_replace("[^0-9]", "", ini_get("upload_max_filesize") );
		$post_max = ereg_replace("[^0-9]", "", ini_get("post_max_size") );

		?>
  		<div style="width:100%;margin-top:5px;text-align:left;">
			<?php
			echo $startpane;
			echo $starttab1;
			?>
			<div style="margin:1px;padding:1px;"><br />
			<table cellpadding="0" cellspacing="0" border="0" width="100%" class="adminform">
			  <tr><td align="left" valign="top" colspan="3"><h3><?php echo _ADMIN_HWDPS_SETT_PLUGINS ?></h3></td></tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _ADMIN_HWDPS_SETT_TEMPLATE ?></td>
				<td width="20%" align="left" valign="top">
				<select name="template" size="1" class="inputbox">
				<option value=""><?php echo _ADMIN_HWDPS_SELECT_TEMPLATE ?></option>
				<?php
				$query = 'SELECT *'
					. ' FROM #__plugins'
					. ' WHERE published = 1'
					. ' AND folder = "hwdps-template"'
					. ' ORDER BY name ASC'
					;
				$db->setQuery( $query );
				$rows = $db->loadObjectList();
					for ($i=0, $n=count($rows); $i < $n; $i++) {
						$row = $rows[$i];
						?>
						<option value="<?php echo $row->element."|".$row->folder; ?>" <?php if ($c->hwdvids_template_file == $row->element) echo "selected=\"selected\"" ?>><?php echo $row->name; ?></option>
						<?php
					}
				?>
				</select>
				</td>
				<td width="60%" align="left" valign="top"><?php echo _ADMIN_HWDPS_SETT_TEMPLATE_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b>Select Slideshow</td>
				<td width="20%" align="left" valign="top">
				<select name="slideshow" size="1" class="inputbox">
				<option value="">Select SlideShow</option>
				<?php
				$query = 'SELECT *'
					. ' FROM #__plugins'
					. ' WHERE published = 1'
					. ' AND folder = "hwdps-slideshow"'
					. ' ORDER BY name ASC'
					;
				$db->setQuery( $query );
				$rows = $db->loadObjectList();
					for ($i=0, $n=count($rows); $i < $n; $i++) {
						$row = $rows[$i];
						?>
						<option value="<?php echo $row->element."|".$row->folder; ?>" <?php if ($c->hwdps_slideshow_file == $row->element) echo "selected=\"selected\"" ?>><?php echo $row->name; ?></option>
						<?php
					}
				?>
				</select>
				</td>
				<td width="60%" align="left" valign="top">Choose the hwdPhotoShare slideshow plugin. To add more slideshows, install slideshow plugins through the plugin manager.</td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _ADMIN_HWDPS_SETT_LANGUAGE ?></td>
				<td width="20%" align="left" valign="top">
				<select name="language" size="1" class="inputbox">
				<option value=""><?php echo _ADMIN_HWDPS_SELECT_LANGUAGE ?></option>
				<option value="joomfish|joomfish" <?php if ($c->hwdvids_language_file == "joomfish") echo "selected=\"selected\"" ?>><?php echo _ADMIN_HWDPS_LANGUAGE_JOOMFISH ?></option>
				<?php
				$query = 'SELECT *'
					. ' FROM #__plugins'
					. ' WHERE published = 1'
					. ' AND folder = "hwdps-language"'
					. ' ORDER BY name ASC'
					;
				$db->setQuery( $query );
				$rows = $db->loadObjectList();
					for ($i=0, $n=count($rows); $i < $n; $i++) {
						$row = $rows[$i];
						?>
						<option value="<?php echo $row->element."|".$row->folder; ?>" <?php if ($c->hwdvids_language_file == $row->element) echo "selected=\"selected\"" ?>><?php echo $row->name; ?></option>
						<?php
					}
				?>
				</select>
				</td>
				<td width="60%" align="left" valign="top"><?php echo _ADMIN_HWDPS_SETT_LANGUAGE_DESC ?></td>
			  </tr>
			</table>
			</div>
			<?php
			echo $endtab;
			echo $starttab2;
			?>
			<div style="margin:1px;padding:1px;"><br />
			<table cellpadding="0" cellspacing="0" border="0" width="100%" class="adminform">
			  <tr><td align="left" valign="top" colspan="3"><h3>Uploads</h3></td></tr>
			  <tr>
				<td width="20%" align="left" valign="top">Disable Advanced Java Upload</td>
				<td width="20%" align="left" valign="top">
				<select name="disablejupload" size="1" class="inputbox">
					<option value="1"<?php if ($c->disablejupload == 1) { ?> selected="selected"<?php } ?>><?php echo _ADMIN_HWDPS_SETT_YES.' '; ?></option>
					<option value="0"<?php if ($c->disablejupload == 0) { ?> selected="selected"<?php } ?>><?php echo _ADMIN_HWDPS_SETT_NO.' '; ?></option>
				</select>
				</td>
				<td width="60%" align="left" valign="top">Disable the Advanced Java Upload method so users only use the basic upload method.</td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top">Core User Data Allowance</td>
				<td align="left" valign="top" width="20%"><input type="text" name="core_uploadlimit" value="<?php echo $c->core_uploadlimit; ?>" size="10" maxlength="10"></td>
				<td align="left" valign="top" width="60%">Set the core data allowance for all users.</td>
			  </tr>
			</table>
			<table cellpadding="0" cellspacing="0" border="0" width="100%" class="adminform">
			  <tr><td align="left" valign="top" colspan="3"><h3><?php echo _ADMIN_HWDPS_SETT_DISABLENAVTABS ?></h3></td></tr>
			  <tr>
				<td width="20%" align="left" valign="top">Disable Explore Tab</td>
				<td width="20%" align="left" valign="top">
				<select name="disable_nav_explor" size="1" class="inputbox">
					<option value="1"<?php if ($c->disable_nav_explor == 1) { ?> selected="selected"<?php } ?>><?php echo _ADMIN_HWDPS_SETT_YES.' '; ?></option>
					<option value="0"<?php if ($c->disable_nav_explor == 0) { ?> selected="selected"<?php } ?>><?php echo _ADMIN_HWDPS_SETT_NO.' '; ?></option>
				</select>
				</td>
				<td width="60%" align="left" valign="top">Disable the explore tab so this link does not appear at the top of the page</td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top">Disable Categories Tab</td>
				<td width="20%" align="left" valign="top">
				<select name="disable_nav_catego" size="1" class="inputbox">
					<option value="1"<?php if ($c->disable_nav_catego == 1) { ?> selected="selected"<?php } ?>><?php echo _ADMIN_HWDPS_SETT_YES.' '; ?></option>
					<option value="0"<?php if ($c->disable_nav_catego == 0) { ?> selected="selected"<?php } ?>><?php echo _ADMIN_HWDPS_SETT_NO.' '; ?></option>
				</select>
				</td>
				<td width="60%" align="left" valign="top">Disable the category tab so this link does not appear at the top of the page</td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><?php echo _ADMIN_HWDPS_SETT_DISABLEGRPTAB ?></td>
				<td width="20%" align="left" valign="top">
				<select name="disable_nav_groups" size="1" class="inputbox">
					<option value="1"<?php if ($c->disable_nav_groups == 1) { ?> selected="selected"<?php } ?>><?php echo _ADMIN_HWDPS_SETT_YES.' '; ?></option>
					<option value="0"<?php if ($c->disable_nav_groups == 0) { ?> selected="selected"<?php } ?>><?php echo _ADMIN_HWDPS_SETT_NO.' '; ?></option>
				</select>
				</td>
				<td width="60%" align="left" valign="top"><?php echo _ADMIN_HWDPS_SETT_DISABLEGRPTAB_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><?php echo _ADMIN_HWDPS_SETT_DISABLEULDTAB ?></td>
				<td width="20%" align="left" valign="top">
				<select name="disable_nav_upload" size="1" class="inputbox">
					<option value="1"<?php if ($c->disable_nav_upload == 1) { ?> selected="selected"<?php } ?>><?php echo _ADMIN_HWDPS_SETT_YES.' '; ?></option>
					<option value="0"<?php if ($c->disable_nav_upload == 0) { ?> selected="selected"<?php } ?>><?php echo _ADMIN_HWDPS_SETT_NO.' '; ?></option>
				</select>
				</td>
				<td width="60%" align="left" valign="top"><?php echo _ADMIN_HWDPS_SETT_DISABLEULDTAB_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><?php echo _ADMIN_HWDPS_SETT_DISABLESEARCHBAR ?></td>
				<td width="20%" align="left" valign="top">
				<select name="disable_nav_search" size="1" class="inputbox">
					<option value="1"<?php if ($c->disable_nav_search == 1) { ?> selected="selected"<?php } ?>><?php echo _ADMIN_HWDPS_SETT_YES.' '; ?></option>
					<option value="0"<?php if ($c->disable_nav_search == 0) { ?> selected="selected"<?php } ?>><?php echo _ADMIN_HWDPS_SETT_NO.' '; ?></option>
				</select>
				</td>
				<td width="60%" align="left" valign="top"><?php echo _ADMIN_HWDPS_SETT_DISABLESEARCHBAR_DESC ?></td>
			  </tr>
			</table>
			<table cellpadding="0" cellspacing="0" border="0" width="100%" class="adminform">
			  <tr><td align="left" valign="top" colspan="3"><h3><?php echo _ADMIN_HWDPS_SETT_DISABLEUSRTABS ?></h3></td></tr>
			  <tr>
				<td width="20%" align="left" valign="top"><?php echo _ADMIN_HWDPS_SETT_DISABLEUSERBAR ?></td>
				<td width="20%" align="left" valign="top">
				<select name="disable_nav_user" size="1" class="inputbox">
					<option value="1"<?php if ($c->disable_nav_user == 1) { ?> selected="selected"<?php } ?>><?php echo _ADMIN_HWDPS_SETT_YES.' '; ?></option>
					<option value="0"<?php if ($c->disable_nav_user == 0) { ?> selected="selected"<?php } ?>><?php echo _ADMIN_HWDPS_SETT_NO.' '; ?></option>
				</select>
				</td>
				<td width="60%" align="left" valign="top"><?php echo _ADMIN_HWDPS_SETT_DISABLEUSERBAR_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top">Disable <b>Your Photos</b> Link</td>
				<td width="20%" align="left" valign="top">
				<select name="disable_nav_user1" size="1" class="inputbox">
					<option value="1"<?php if ($c->disable_nav_user1 == 1) { ?> selected="selected"<?php } ?>><?php echo _ADMIN_HWDPS_SETT_YES.' '; ?></option>
					<option value="0"<?php if ($c->disable_nav_user1 == 0) { ?> selected="selected"<?php } ?>><?php echo _ADMIN_HWDPS_SETT_NO.' '; ?></option>
				</select>
				</td>
				<td width="60%" align="left" valign="top"><?php echo _ADMIN_HWDPS_SETT_DISABLEYVLINK_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><?php echo _ADMIN_HWDPS_SETT_DISABLEYFLINK ?></td>
				<td width="20%" align="left" valign="top">
				<select name="disable_nav_user2" size="1" class="inputbox">
					<option value="1"<?php if ($c->disable_nav_user2 == 1) { ?> selected="selected"<?php } ?>><?php echo _ADMIN_HWDPS_SETT_YES.' '; ?></option>
					<option value="0"<?php if ($c->disable_nav_user2 == 0) { ?> selected="selected"<?php } ?>><?php echo _ADMIN_HWDPS_SETT_NO.' '; ?></option>
				</select>
				</td>
				<td width="60%" align="left" valign="top"><?php echo _ADMIN_HWDPS_SETT_DISABLEYFLINK_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><?php echo _ADMIN_HWDPS_SETT_DISABLEYGLINK ?></td>
				<td width="20%" align="left" valign="top">
				<select name="disable_nav_user3" size="1" class="inputbox">
					<option value="1"<?php if ($c->disable_nav_user3 == 1) { ?> selected="selected"<?php } ?>><?php echo _ADMIN_HWDPS_SETT_YES.' '; ?></option>
					<option value="0"<?php if ($c->disable_nav_user3 == 0) { ?> selected="selected"<?php } ?>><?php echo _ADMIN_HWDPS_SETT_NO.' '; ?></option>
				</select>
				</td>
				<td width="60%" align="left" valign="top"><?php echo _ADMIN_HWDPS_SETT_DISABLEYGLINK_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><?php echo _ADMIN_HWDPS_SETT_DISABLEYMLINK ?></td>
				<td width="20%" align="left" valign="top">
				<select name="disable_nav_user4" size="1" class="inputbox">
					<option value="1"<?php if ($c->disable_nav_user4 == 1) { ?> selected="selected"<?php } ?>><?php echo _ADMIN_HWDPS_SETT_YES.' '; ?></option>
					<option value="0"<?php if ($c->disable_nav_user4 == 0) { ?> selected="selected"<?php } ?>><?php echo _ADMIN_HWDPS_SETT_NO.' '; ?></option>
				</select>
				</td>
				<td width="60%" align="left" valign="top"><?php echo _ADMIN_HWDPS_SETT_DISABLEYMLINK_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><?php echo _ADMIN_HWDPS_SETT_DISABLECGLINK ?></td>
				<td width="20%" align="left" valign="top">
				<select name="disable_nav_user5" size="1" class="inputbox">
					<option value="1"<?php if ($c->disable_nav_user5 == 1) { ?> selected="selected"<?php } ?>><?php echo _ADMIN_HWDPS_SETT_YES.' '; ?></option>
					<option value="0"<?php if ($c->disable_nav_user5 == 0) { ?> selected="selected"<?php } ?>><?php echo _ADMIN_HWDPS_SETT_NO.' '; ?></option>
				</select>
				</td>
				<td width="60%" align="left" valign="top"><?php echo _ADMIN_HWDPS_SETT_DISABLECGLINK_DESC ?></td>
			  </tr>
			</table>

			<table cellpadding="0" cellspacing="0" border="0" width="100%" class="adminform">
			  <tr><td align="left" valign="top" colspan="3"><h3>Frontpage Options</h3></td></tr>
			  <tr>
				<td width="20%" align="left" valign="top">Photos in Slider</td>
				<td width="20%" align="left" valign="top">
				<select name="fp_nos" size="1" class="inputbox">
					<option value="1"<?php if ($c->fp_nos == 1) { ?> selected="selected"<?php } ?>>1</option>
					<option value="2"<?php if ($c->fp_nos == 2) { ?> selected="selected"<?php } ?>>2</option>
					<option value="3"<?php if ($c->fp_nos == 3) { ?> selected="selected"<?php } ?>>3</option>
					<option value="4"<?php if ($c->fp_nos == 4) { ?> selected="selected"<?php } ?>>4</option>
					<option value="5"<?php if ($c->fp_nos == 5) { ?> selected="selected"<?php } ?>>5</option>
					<option value="6"<?php if ($c->fp_nos == 6) { ?> selected="selected"<?php } ?>>6</option>
				</select>
				</td>
				<td width="60%" align="left" valign="top">The number of photos in the frontpage slider</td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top">Recent Albums</td>
				<td width="20%" align="left" valign="top">
				<select name="fp_noa" size="1" class="inputbox">
					<option value="1"<?php if ($c->fp_noa == 1) { ?> selected="selected"<?php } ?>>1</option>
					<option value="2"<?php if ($c->fp_noa == 2) { ?> selected="selected"<?php } ?>>2</option>
					<option value="3"<?php if ($c->fp_noa == 3) { ?> selected="selected"<?php } ?>>3</option>
					<option value="4"<?php if ($c->fp_noa == 4) { ?> selected="selected"<?php } ?>>4</option>
					<option value="5"<?php if ($c->fp_noa == 5) { ?> selected="selected"<?php } ?>>5</option>
					<option value="6"<?php if ($c->fp_noa == 6) { ?> selected="selected"<?php } ?>>6</option>
				</select>
				</td>
				<td width="60%" align="left" valign="top">The number of recent albums to display</td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top">Show Tags?</td>
				<td width="20%" align="left" valign="top">
				<select name="fp_showt" size="1" class="inputbox">
					<option value="1"<?php if ($c->fp_showt == 1) { ?> selected="selected"<?php } ?>><?php echo _ADMIN_HWDPS_SETT_YES.' '; ?></option>
					<option value="0"<?php if ($c->fp_showt == 0) { ?> selected="selected"<?php } ?>><?php echo _ADMIN_HWDPS_SETT_NO.' '; ?></option>
				</select>
				</td>
				<td width="60%" align="left" valign="top">Show tags on the frontpage?</td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top">Show Groups?</td>
				<td width="20%" align="left" valign="top">
				<select name="fp_showg" size="1" class="inputbox">
					<option value="1"<?php if ($c->fp_showg == 1) { ?> selected="selected"<?php } ?>><?php echo _ADMIN_HWDPS_SETT_YES.' '; ?></option>
					<option value="0"<?php if ($c->fp_showg == 0) { ?> selected="selected"<?php } ?>><?php echo _ADMIN_HWDPS_SETT_NO.' '; ?></option>
				</select>
				</td>
				<td width="60%" align="left" valign="top">Show groups on the frontpage?</td>
			  </tr>
			</table>

			<table cellpadding="0" cellspacing="0" border="0" width="100%" class="adminform">
			  <tr><td align="left" valign="top" colspan="3"><h3>Photo Albums</h3></td></tr>
			  <tr>
				<td width="20%" align="left" valign="top">Photos per page</td>
				<td width="20%" align="left" valign="top">
				<select name="ppp" size="1" class="inputbox">
					<option value="5"<?php if ($c->ppp == 5) { ?> selected="selected"<?php } ?>><?php echo _ADMIN_HWDPS_SETT_05.' '; ?></option>
					<option value="10"<?php if ($c->ppp == 10) { ?> selected="selected"<?php } ?>><?php echo _ADMIN_HWDPS_SETT_10.' '; ?></option>
					<option value="15"<?php if ($c->ppp == 15) { ?> selected="selected"<?php } ?>><?php echo _ADMIN_HWDPS_SETT_15.' '; ?></option>
					<option value="20"<?php if ($c->ppp == 20) { ?> selected="selected"<?php } ?>><?php echo _ADMIN_HWDPS_SETT_20.' '; ?></option>
					<option value="25"<?php if ($c->ppp == 25) { ?> selected="selected"<?php } ?>><?php echo _ADMIN_HWDPS_SETT_25.' '; ?></option>
					<option value="30"<?php if ($c->ppp == 30) { ?> selected="selected"<?php } ?>><?php echo _ADMIN_HWDPS_SETT_30.' '; ?></option>
					<option value="35"<?php if ($c->ppp == 35) { ?> selected="selected"<?php } ?>><?php echo _ADMIN_HWDPS_SETT_35.' '; ?></option>
					<option value="40"<?php if ($c->ppp == 40) { ?> selected="selected"<?php } ?>><?php echo _ADMIN_HWDPS_SETT_40.' '; ?></option>
					<option value="45"<?php if ($c->ppp == 45) { ?> selected="selected"<?php } ?>><?php echo _ADMIN_HWDPS_SETT_45.' '; ?></option>
					<option value="50"<?php if ($c->ppp == 50) { ?> selected="selected"<?php } ?>><?php echo _ADMIN_HWDPS_SETT_50.' '; ?></option>
				</select>
				</td>
				<td width="60%" align="left" valign="top">Set the number of photos displayed per page in albums</td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top">Photos per row</td>
				<td width="20%" align="left" valign="top">
				<select name="ppr" size="1" class="inputbox">
					<option value="1"<?php if ($c->ppr == 1) { ?> selected="selected"<?php } ?>><?php echo _ADMIN_HWDPS_SETT_01.' '; ?></option>
					<option value="2"<?php if ($c->ppr == 2) { ?> selected="selected"<?php } ?>><?php echo _ADMIN_HWDPS_SETT_02.' '; ?></option>
					<option value="3"<?php if ($c->ppr == 3) { ?> selected="selected"<?php } ?>><?php echo _ADMIN_HWDPS_SETT_03.' '; ?></option>
					<option value="4"<?php if ($c->ppr == 4) { ?> selected="selected"<?php } ?>><?php echo _ADMIN_HWDPS_SETT_04.' '; ?></option>
					<option value="5"<?php if ($c->ppr == 5) { ?> selected="selected"<?php } ?>><?php echo _ADMIN_HWDPS_SETT_05.' '; ?></option>
					<option value="6"<?php if ($c->ppr == 6) { ?> selected="selected"<?php } ?>><?php echo _ADMIN_HWDPS_SETT_06.' '; ?></option>
					<option value="7"<?php if ($c->ppr == 7) { ?> selected="selected"<?php } ?>><?php echo _ADMIN_HWDPS_SETT_07.' '; ?></option>
					<option value="8"<?php if ($c->ppr == 8) { ?> selected="selected"<?php } ?>><?php echo _ADMIN_HWDPS_SETT_08.' '; ?></option>
					<option value="9"<?php if ($c->ppr == 9) { ?> selected="selected"<?php } ?>><?php echo _ADMIN_HWDPS_SETT_09.' '; ?></option>
					<option value="10"<?php if ($c->ppr == 10) { ?> selected="selected"<?php } ?>><?php echo _ADMIN_HWDPS_SETT_10.' '; ?></option>
				</select>
				</td>
				<td width="60%" align="left" valign="top">Set the number of photos displayed per row in albums</td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top">Albums per page</td>
				<td width="20%" align="left" valign="top">
				<select name="app" size="1" class="inputbox">
					<option value="5"<?php if ($c->app == 5) { ?> selected="selected"<?php } ?>><?php echo _ADMIN_HWDPS_SETT_05.' '; ?></option>
					<option value="10"<?php if ($c->app == 10) { ?> selected="selected"<?php } ?>><?php echo _ADMIN_HWDPS_SETT_10.' '; ?></option>
					<option value="15"<?php if ($c->app == 15) { ?> selected="selected"<?php } ?>><?php echo _ADMIN_HWDPS_SETT_15.' '; ?></option>
					<option value="20"<?php if ($c->app == 20) { ?> selected="selected"<?php } ?>><?php echo _ADMIN_HWDPS_SETT_20.' '; ?></option>
					<option value="25"<?php if ($c->app == 25) { ?> selected="selected"<?php } ?>><?php echo _ADMIN_HWDPS_SETT_25.' '; ?></option>
					<option value="30"<?php if ($c->app == 30) { ?> selected="selected"<?php } ?>><?php echo _ADMIN_HWDPS_SETT_30.' '; ?></option>
					<option value="35"<?php if ($c->app == 35) { ?> selected="selected"<?php } ?>><?php echo _ADMIN_HWDPS_SETT_35.' '; ?></option>
					<option value="40"<?php if ($c->app == 40) { ?> selected="selected"<?php } ?>><?php echo _ADMIN_HWDPS_SETT_40.' '; ?></option>
					<option value="45"<?php if ($c->app == 45) { ?> selected="selected"<?php } ?>><?php echo _ADMIN_HWDPS_SETT_45.' '; ?></option>
					<option value="50"<?php if ($c->app == 50) { ?> selected="selected"<?php } ?>><?php echo _ADMIN_HWDPS_SETT_50.' '; ?></option>
				</select>
				</td>
				<td width="60%" align="left" valign="top">Set the number of photos displayed per page in albums</td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top">Albums per row</td>
				<td width="20%" align="left" valign="top">
				<select name="apr" size="1" class="inputbox">
					<option value="1"<?php if ($c->apr == 1) { ?> selected="selected"<?php } ?>><?php echo _ADMIN_HWDPS_SETT_01.' '; ?></option>
					<option value="2"<?php if ($c->apr == 2) { ?> selected="selected"<?php } ?>><?php echo _ADMIN_HWDPS_SETT_02.' '; ?></option>
					<option value="3"<?php if ($c->apr == 3) { ?> selected="selected"<?php } ?>><?php echo _ADMIN_HWDPS_SETT_03.' '; ?></option>
					<option value="4"<?php if ($c->apr == 4) { ?> selected="selected"<?php } ?>><?php echo _ADMIN_HWDPS_SETT_04.' '; ?></option>
					<option value="5"<?php if ($c->apr == 5) { ?> selected="selected"<?php } ?>><?php echo _ADMIN_HWDPS_SETT_05.' '; ?></option>
					<option value="6"<?php if ($c->apr == 6) { ?> selected="selected"<?php } ?>><?php echo _ADMIN_HWDPS_SETT_06.' '; ?></option>
					<option value="7"<?php if ($c->apr == 7) { ?> selected="selected"<?php } ?>><?php echo _ADMIN_HWDPS_SETT_07.' '; ?></option>
					<option value="8"<?php if ($c->apr == 8) { ?> selected="selected"<?php } ?>><?php echo _ADMIN_HWDPS_SETT_08.' '; ?></option>
					<option value="9"<?php if ($c->apr == 9) { ?> selected="selected"<?php } ?>><?php echo _ADMIN_HWDPS_SETT_09.' '; ?></option>
					<option value="10"<?php if ($c->apr == 10) { ?> selected="selected"<?php } ?>><?php echo _ADMIN_HWDPS_SETT_10.' '; ?></option>
				</select>
				</td>
				<td width="60%" align="left" valign="top">Set the number of photos displayed per row in albums</td>
			  </tr>
			</table>
			<table cellpadding="0" cellspacing="0" border="0" width="100%" class="adminform">
			  <tr><td align="left" valign="top" colspan="3"><h3>Photo Page Information Options</h3></td></tr>
			  <tr>
				<td width="20%" align="left" valign="top"><?php echo _ADMIN_HWDPS_SETT_SHOWRAT ?></td>
				<td width="20%" align="left" valign="top">
				<select name="showrate" size="1" class="inputbox">
					<option value="1"<?php if ($c->showrate == 1) { ?> selected="selected"<?php } ?>><?php echo _ADMIN_HWDPS_SETT_YES.' '; ?></option>
					<option value="0"<?php if ($c->showrate == 0) { ?> selected="selected"<?php } ?>><?php echo _ADMIN_HWDPS_SETT_NO.' '; ?></option>
				</select>
				</td>
				<td width="60%" align="left" valign="top"><?php echo _ADMIN_HWDPS_SETT_SHOWRAT_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><?php echo _ADMIN_HWDPS_SETT_SHOWATF ?></td>
				<td width="20%" align="left" valign="top">
				<select name="showatfb" size="1" class="inputbox">
					<option value="1"<?php if ($c->showatfb == 1) { ?> selected="selected"<?php } ?>><?php echo _ADMIN_HWDPS_SETT_YES.' '; ?></option>
					<option value="0"<?php if ($c->showatfb == 0) { ?> selected="selected"<?php } ?>><?php echo _ADMIN_HWDPS_SETT_NO.' '; ?></option>
				</select>
				</td>
				<td width="60%" align="left" valign="top"><?php echo _ADMIN_HWDPS_SETT_SHOWATF_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><?php echo _ADMIN_HWDPS_SETT_SHOWRPB ?></td>
				<td width="20%" align="left" valign="top">
				<select name="showrpmb" size="1" class="inputbox">
					<option value="1"<?php if ($c->showrpmb == 1) { ?> selected="selected"<?php } ?>><?php echo _ADMIN_HWDPS_SETT_YES.' '; ?></option>
					<option value="0"<?php if ($c->showrpmb == 0) { ?> selected="selected"<?php } ?>><?php echo _ADMIN_HWDPS_SETT_NO.' '; ?></option>
				</select>
				</td>
				<td width="60%" align="left" valign="top"><?php echo _ADMIN_HWDPS_SETT_SHOWRPB_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><?php echo _ADMIN_HWDPS_SETT_SHOWCOM ?></td>
				<td width="20%" align="left" valign="top">
				<select name="showcoms" size="1" class="inputbox">
					<option value="1"<?php if ($c->showcoms == 1) { ?> selected="selected"<?php } ?>><?php echo _ADMIN_HWDPS_SETT_YES.' '; ?></option>
					<option value="0"<?php if ($c->showcoms == 0) { ?> selected="selected"<?php } ?>><?php echo _ADMIN_HWDPS_SETT_NO.' '; ?></option>
				</select>
				</td>
				<td width="60%" align="left" valign="top"><?php echo _ADMIN_HWDPS_SETT_SHOWCOM_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><?php echo _ADMIN_HWDPS_SETT_SHOWDSC ?></td>
				<td width="20%" align="left" valign="top">
				<select name="showdesc" size="1" class="inputbox">
					<option value="1"<?php if ($c->showdesc == 1) { ?> selected="selected"<?php } ?>><?php echo _ADMIN_HWDPS_SETT_YES.' '; ?></option>
					<option value="0"<?php if ($c->showdesc == 0) { ?> selected="selected"<?php } ?>><?php echo _ADMIN_HWDPS_SETT_NO.' '; ?></option>
				</select>
				</td>
				<td width="60%" align="left" valign="top"><?php echo _ADMIN_HWDPS_SETT_SHOWDSC_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><?php echo _ADMIN_HWDPS_SETT_SHOWTAG ?></td>
				<td width="20%" align="left" valign="top">
				<select name="showtags" size="1" class="inputbox">
					<option value="1"<?php if ($c->showtags == 1) { ?> selected="selected"<?php } ?>><?php echo _ADMIN_HWDPS_SETT_YES.' '; ?></option>
					<option value="0"<?php if ($c->showtags == 0) { ?> selected="selected"<?php } ?>><?php echo _ADMIN_HWDPS_SETT_NO.' '; ?></option>
				</select>
				</td>
				<td width="60%" align="left" valign="top"><?php echo _ADMIN_HWDPS_SETT_SHOWTAG_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><?php echo _ADMIN_HWDPS_SETT_SHOWSBK ?></td>
				<td width="20%" align="left" valign="top">
				<select name="showscbm" size="1" class="inputbox">
					<option value="1"<?php if ($c->showscbm == 1) { ?> selected="selected"<?php } ?>><?php echo _ADMIN_HWDPS_SETT_YES.' '; ?></option>
					<option value="0"<?php if ($c->showscbm == 0) { ?> selected="selected"<?php } ?>><?php echo _ADMIN_HWDPS_SETT_NO.' '; ?></option>
				</select>
				</td>
				<td width="60%" align="left" valign="top"><?php echo _ADMIN_HWDPS_SETT_SHOWSBK_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><?php echo _ADMIN_HWDPS_SETT_SHOWULR ?></td>
				<td width="20%" align="left" valign="top">
				<select name="showuldr" size="1" class="inputbox">
					<option value="1"<?php if ($c->showuldr == 1) { ?> selected="selected"<?php } ?>><?php echo _ADMIN_HWDPS_SETT_YES.' '; ?></option>
					<option value="0"<?php if ($c->showuldr == 0) { ?> selected="selected"<?php } ?>><?php echo _ADMIN_HWDPS_SETT_NO.' '; ?></option>
				</select>
				</td>
				<td width="60%" align="left" valign="top"><?php echo _ADMIN_HWDPS_SETT_SHOWULR_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top">Number of photos to display</td>
				<td width="20%" align="left" valign="top">
				<select name="mbtu_no" size="1" class="inputbox">
					<option value="0"<?php if ($c->mbtu_no == 0) { ?> selected="selected"<?php } ?>>0</option>
					<option value="1"<?php if ($c->mbtu_no == 1) { ?> selected="selected"<?php } ?>>1</option>
					<option value="2"<?php if ($c->mbtu_no == 2) { ?> selected="selected"<?php } ?>>2</option>
					<option value="3"<?php if ($c->mbtu_no == 3) { ?> selected="selected"<?php } ?>>3</option>
					<option value="4"<?php if ($c->mbtu_no == 4) { ?> selected="selected"<?php } ?>>4</option>
					<option value="5"<?php if ($c->mbtu_no == 5) { ?> selected="selected"<?php } ?>>5</option>
					<option value="6"<?php if ($c->mbtu_no == 6) { ?> selected="selected"<?php } ?>>6</option>
					<option value="7"<?php if ($c->mbtu_no == 7) { ?> selected="selected"<?php } ?>>7</option>
					<option value="8"<?php if ($c->mbtu_no == 8) { ?> selected="selected"<?php } ?>>8</option>
					<option value="9"<?php if ($c->mbtu_no == 9) { ?> selected="selected"<?php } ?>>9</option>
					<option value="10"<?php if ($c->mbtu_no == 10) { ?> selected="selected"<?php } ?>>10</option>
					<option value="11"<?php if ($c->mbtu_no == 11) { ?> selected="selected"<?php } ?>>11</option>
					<option value="12"<?php if ($c->mbtu_no == 12) { ?> selected="selected"<?php } ?>>12</option>
					<option value="13"<?php if ($c->mbtu_no == 13) { ?> selected="selected"<?php } ?>>13</option>
					<option value="14"<?php if ($c->mbtu_no == 14) { ?> selected="selected"<?php } ?>>14</option>
					<option value="15"<?php if ($c->mbtu_no == 15) { ?> selected="selected"<?php } ?>>15</option>
					<option value="16"<?php if ($c->mbtu_no == 16) { ?> selected="selected"<?php } ?>>16</option>
					<option value="17"<?php if ($c->mbtu_no == 17) { ?> selected="selected"<?php } ?>>17</option>
					<option value="18"<?php if ($c->mbtu_no == 18) { ?> selected="selected"<?php } ?>>18</option>
					<option value="19"<?php if ($c->mbtu_no == 19) { ?> selected="selected"<?php } ?>>19</option>
					<option value="20"<?php if ($c->mbtu_no == 20) { ?> selected="selected"<?php } ?>>20</option>
					<option value="21"<?php if ($c->mbtu_no == 21) { ?> selected="selected"<?php } ?>>21</option>
					<option value="22"<?php if ($c->mbtu_no == 22) { ?> selected="selected"<?php } ?>>22</option>
					<option value="23"<?php if ($c->mbtu_no == 23) { ?> selected="selected"<?php } ?>>23</option>
					<option value="24"<?php if ($c->mbtu_no == 24) { ?> selected="selected"<?php } ?>>24</option>
					<option value="25"<?php if ($c->mbtu_no == 25) { ?> selected="selected"<?php } ?>>25</option>
					<option value="26"<?php if ($c->mbtu_no == 26) { ?> selected="selected"<?php } ?>>26</option>
					<option value="27"<?php if ($c->mbtu_no == 27) { ?> selected="selected"<?php } ?>>27</option>
					<option value="28"<?php if ($c->mbtu_no == 28) { ?> selected="selected"<?php } ?>>28</option>
					<option value="29"<?php if ($c->mbtu_no == 29) { ?> selected="selected"<?php } ?>>29</option>
					<option value="30"<?php if ($c->mbtu_no == 30) { ?> selected="selected"<?php } ?>>30</option>
					<option value="31"<?php if ($c->mbtu_no == 31) { ?> selected="selected"<?php } ?>>31</option>
					<option value="32"<?php if ($c->mbtu_no == 32) { ?> selected="selected"<?php } ?>>32</option>
					<option value="33"<?php if ($c->mbtu_no == 33) { ?> selected="selected"<?php } ?>>33</option>
					<option value="34"<?php if ($c->mbtu_no == 34) { ?> selected="selected"<?php } ?>>34</option>
					<option value="35"<?php if ($c->mbtu_no == 35) { ?> selected="selected"<?php } ?>>35</option>
					<option value="36"<?php if ($c->mbtu_no == 36) { ?> selected="selected"<?php } ?>>36</option>
					<option value="37"<?php if ($c->mbtu_no == 37) { ?> selected="selected"<?php } ?>>37</option>
					<option value="38"<?php if ($c->mbtu_no == 38) { ?> selected="selected"<?php } ?>>38</option>
					<option value="39"<?php if ($c->mbtu_no == 39) { ?> selected="selected"<?php } ?>>39</option>
					<option value="40"<?php if ($c->mbtu_no == 40) { ?> selected="selected"<?php } ?>>40</option>
					<option value="41"<?php if ($c->mbtu_no == 41) { ?> selected="selected"<?php } ?>>41</option>
					<option value="42"<?php if ($c->mbtu_no == 42) { ?> selected="selected"<?php } ?>>42</option>
					<option value="43"<?php if ($c->mbtu_no == 43) { ?> selected="selected"<?php } ?>>43</option>
					<option value="44"<?php if ($c->mbtu_no == 44) { ?> selected="selected"<?php } ?>>44</option>
					<option value="45"<?php if ($c->mbtu_no == 45) { ?> selected="selected"<?php } ?>>45</option>
					<option value="46"<?php if ($c->mbtu_no == 46) { ?> selected="selected"<?php } ?>>46</option>
					<option value="47"<?php if ($c->mbtu_no == 47) { ?> selected="selected"<?php } ?>>47</option>
					<option value="48"<?php if ($c->mbtu_no == 48) { ?> selected="selected"<?php } ?>>48</option>
					<option value="49"<?php if ($c->mbtu_no == 49) { ?> selected="selected"<?php } ?>>49</option>
					<option value="50"<?php if ($c->mbtu_no == 50) { ?> selected="selected"<?php } ?>>50</option>
				</select>
				</td>
				<td width="60%" align="left" valign="top">Set the number of photos to display from this user</td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><?php echo _ADMIN_HWDPS_SETT_SHOWA2G ?></td>
				<td width="20%" align="left" valign="top">
				<select name="showa2gb" size="1" class="inputbox">
					<option value="1"<?php if ($c->showa2gb == 1) { ?> selected="selected"<?php } ?>><?php echo _ADMIN_HWDPS_SETT_YES.' '; ?></option>
					<option value="0"<?php if ($c->showa2gb == 0) { ?> selected="selected"<?php } ?>><?php echo _ADMIN_HWDPS_SETT_NO.' '; ?></option>
				</select>
				</td>
				<td width="60%" align="left" valign="top"><?php echo _ADMIN_HWDPS_SETT_SHOWA2G_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top">Show <b>Download Original</b> Link</td>
				<td width="20%" align="left" valign="top">
				<select name="showdlor" size="1" class="inputbox">
					<option value="1"<?php if ($c->showdlor == 1) { ?> selected="selected"<?php } ?>><?php echo _ADMIN_HWDPS_SETT_YES.' '; ?></option>
					<option value="0"<?php if ($c->showdlor == 0) { ?> selected="selected"<?php } ?>><?php echo _ADMIN_HWDPS_SETT_NO.' '; ?></option>
				</select>
				</td>
				<td width="60%" align="left" valign="top">Allow users to download the original (generally higher resolution) image.</td>
			  </tr>
			</table>
			<table cellpadding="0" cellspacing="0" border="0" width="100%" class="adminform">
			  <tr><td align="left" valign="top" colspan="3"><h3>Photo Page Interaction Methods</h3></td></tr>
			  <tr>
				<td width="20%" align="left" valign="top">Photo rating method</td>
				<td width="20%" align="left" valign="top">
				<select name="ajaxratemeth" size="1" class="inputbox">
					<option value="1"<?php if ($c->ajaxratemeth == 1) { ?> selected="selected"<?php } ?>>AJAX</option>
					<option value="0"<?php if ($c->ajaxratemeth == 0) { ?> selected="selected"<?php } ?>>POST</option>
				</select>
				</td>
				<td width="60%" align="left" valign="top">Choose which video rating method you want to use.</td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><?php echo _ADMIN_HWDPS_SETT_FAVSYS ?></td>
				<td width="20%" align="left" valign="top">
				<select name="ajaxfavmeth" size="1" class="inputbox">
					<option value="1"<?php if ($c->ajaxfavmeth == 1) { ?> selected="selected"<?php } ?>>AJAX</option>
					<option value="0"<?php if ($c->ajaxfavmeth == 0) { ?> selected="selected"<?php } ?>>POST</option>
				</select>
				</td>
				<td width="60%" align="left" valign="top"> Select the method (POST or AJAX) that users will use to add photos to their favourites. The AJAX method will not refresh the screen.</td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top">Report photo method</td>
				<td width="20%" align="left" valign="top">
				<select name="ajaxrepmeth" size="1" class="inputbox">
					<option value="1"<?php if ($c->ajaxrepmeth == 1) { ?> selected="selected"<?php } ?>>AJAX</option>
					<option value="0"<?php if ($c->ajaxrepmeth == 0) { ?> selected="selected"<?php } ?>>POST</option>
				</select>
				</td>
				<td width="60%" align="left" valign="top">Select the method (POST or AJAX) that users will use to report inappropriate photos. The AJAX method will not refresh the screen.</td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><?php echo _ADMIN_HWDPS_SETT_A2GSYS ?></td>
				<td width="20%" align="left" valign="top">
				<select name="ajaxa2gmeth" size="1" class="inputbox">
					<option value="1"<?php if ($c->ajaxa2gmeth == 1) { ?> selected="selected"<?php } ?>>AJAX</option>
					<option value="0"<?php if ($c->ajaxa2gmeth == 0) { ?> selected="selected"<?php } ?>>POST</option>
				</select>
				</td>
				<td width="60%" align="left" valign="top"> Select the method (POST or AJAX) that users will use to add photos to groups. The AJAX method will not refresh the screen.</td>
			  </tr>
			</table>
			<table cellpadding="0" cellspacing="0" border="0" width="100%" class="adminform">
			  <tr><td align="left" valign="top" colspan="3"><h3><?php echo _ADMIN_HWDPS_SETT_GROUPS ?></h3></td></tr>
			  <tr>
				<td width="20%" align="left" valign="top"><?php echo _ADMIN_HWDPS_SETT_GPP ?></td>
				<td width="20%" align="left" valign="top">
				<select name="gpp" size="1" class="inputbox">
					<option value="5"<?php if ($c->gpp == 5) { ?> selected="selected"<?php } ?>><?php echo _ADMIN_HWDPS_SETT_05.' '; ?></option>
					<option value="10"<?php if ($c->gpp == 10) { ?> selected="selected"<?php } ?>><?php echo _ADMIN_HWDPS_SETT_10.' '; ?></option>
					<option value="15"<?php if ($c->gpp == 15) { ?> selected="selected"<?php } ?>><?php echo _ADMIN_HWDPS_SETT_15.' '; ?></option>
					<option value="20"<?php if ($c->gpp == 20) { ?> selected="selected"<?php } ?>><?php echo _ADMIN_HWDPS_SETT_20.' '; ?></option>
					<option value="25"<?php if ($c->gpp == 25) { ?> selected="selected"<?php } ?>><?php echo _ADMIN_HWDPS_SETT_25.' '; ?></option>
					<option value="30"<?php if ($c->gpp == 30) { ?> selected="selected"<?php } ?>><?php echo _ADMIN_HWDPS_SETT_30.' '; ?></option>
					<option value="35"<?php if ($c->gpp == 35) { ?> selected="selected"<?php } ?>><?php echo _ADMIN_HWDPS_SETT_35.' '; ?></option>
					<option value="40"<?php if ($c->gpp == 40) { ?> selected="selected"<?php } ?>><?php echo _ADMIN_HWDPS_SETT_40.' '; ?></option>
					<option value="45"<?php if ($c->gpp == 45) { ?> selected="selected"<?php } ?>><?php echo _ADMIN_HWDPS_SETT_45.' '; ?></option>
					<option value="50"<?php if ($c->gpp == 50) { ?> selected="selected"<?php } ?>><?php echo _ADMIN_HWDPS_SETT_50.' '; ?></option>
				</select>
				</td>
				<td width="60%" align="left" valign="top"><?php echo _ADMIN_HWDPS_SETT_GPP_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><?php echo _ADMIN_HWDPS_SETT_FGROUPS ?></td>
				<td width="20%" align="left" valign="top">
				<select name="fgpp" size="1" class="inputbox" onChange="changeoldMode()">
					<option value="1"<?php if ($c->fgpp == 1) { ?> selected="selected"<?php } ?>><?php echo _ADMIN_HWDPS_SETT_01.' '; ?></option>
					<option value="2"<?php if ($c->fgpp == 2) { ?> selected="selected"<?php } ?>><?php echo _ADMIN_HWDPS_SETT_02.' '; ?></option>
					<option value="3"<?php if ($c->fgpp == 3) { ?> selected="selected"<?php } ?>><?php echo _ADMIN_HWDPS_SETT_03.' '; ?></option>
					<option value="4"<?php if ($c->fgpp == 4) { ?> selected="selected"<?php } ?>><?php echo _ADMIN_HWDPS_SETT_04.' '; ?></option>
					<option value="5"<?php if ($c->fgpp == 5) { ?> selected="selected"<?php } ?>><?php echo _ADMIN_HWDPS_SETT_05.' '; ?></option>
					<option value="6"<?php if ($c->fgpp == 6) { ?> selected="selected"<?php } ?>><?php echo _ADMIN_HWDPS_SETT_06.' '; ?></option>
					<option value="7"<?php if ($c->fgpp == 7) { ?> selected="selected"<?php } ?>><?php echo _ADMIN_HWDPS_SETT_07.' '; ?></option>
					<option value="8"<?php if ($c->fgpp == 8) { ?> selected="selected"<?php } ?>><?php echo _ADMIN_HWDPS_SETT_08.' '; ?></option>
					<option value="9"<?php if ($c->fgpp == 9) { ?> selected="selected"<?php } ?>><?php echo _ADMIN_HWDPS_SETT_09.' '; ?></option>
					<option value="10"<?php if ($c->fgpp == 10) { ?> selected="selected"<?php } ?>><?php echo _ADMIN_HWDPS_SETT_10.' '; ?></option>
				</select>
				</td>
				<td width="60%" align="left" valign="top"><?php echo _ADMIN_HWDPS_SETT_FGROUPS_DESC ?></td>
			  </tr>
			</table>
			<table cellpadding="0" cellspacing="0" border="0" width="100%" class="adminform">
			  <tr><td align="left" valign="top" colspan="3"><h3><?php echo _ADMIN_HWDPS_SETT_TRUNCATE ?></h3></td></tr>
			  <tr>
				<td width="20%" align="left" valign="top"><?php echo _ADMIN_HWDPS_SETT_TRUNTITLE ?></td>
				<td align="left" valign="top" width="20%"><input type="text" name="truntitle" value="<?php echo $c->truntitle; ?>" size="7" maxlength="100"></td>
				<td width="60%" align="left" valign="top">You can choose to truncate the titles of photos and groups on the main list pages to this number of characters</td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top">Truncate photo descriptions</td>
				<td align="left" valign="top" width="20%"><input type="text" name="trunpdesc" value="<?php echo $c->trunpdesc; ?>" size="7" maxlength="100"></td>
				<td width="60%" align="left" valign="top">You can choose to truncate the descriptions of photos to this number of characters</td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top">Truncate album descriptions</td>
				<td align="left" valign="top" width="20%"><input type="text" name="trunadesc" value="<?php echo $c->trunadesc; ?>" size="7" maxlength="100"></td>
				<td width="60%" align="left" valign="top">You can choose to truncate the descriptions of albums to this number of characters</td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><?php echo _ADMIN_HWDPS_SETT_TRUNCDESC ?></td>
				<td align="left" valign="top" width="20%"><input type="text" name="truncdesc" value="<?php echo $c->truncdesc; ?>" size="7" maxlength="100"></td>
				<td width="60%" align="left" valign="top"><?php echo _ADMIN_HWDPS_SETT_TRUNCDESC_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><?php echo _ADMIN_HWDPS_SETT_TRUNGDESC ?></td>
				<td align="left" valign="top" width="20%"><input type="text" name="trungdesc" value="<?php echo $c->trungdesc; ?>" size="7" maxlength="100"></td>
				<td width="60%" align="left" valign="top"><?php echo _ADMIN_HWDPS_SETT_TRUNGDESC_DESC ?></td>
			  </tr>
			</table>
			<table cellpadding="0" cellspacing="0" border="0" width="100%" class="adminform">
			  <tr><td align="left" valign="top" colspan="3"><h3><?php echo _ADMIN_HWDPS_SETT_SOCBM ?></h3></td></tr>
			  <tr><td align="left" valign="top" colspan="3">
				<input type="checkbox" name="sb_digg" value="on" <?php if ($c->sb_digg == "on") { ?> checked="checked"<?php } ?> />Digg!&#160;
				<input type="checkbox" name="sb_reddit" value="on" <?php if ($c->sb_reddit == "on") { ?> checked="checked"<?php } ?> />Reddit!&#160;
				<input type="checkbox" name="sb_delicious" value="on" <?php if ($c->sb_delicious == "on") { ?> checked="checked"<?php } ?> />Del.icio.us!&#160;
				<input type="checkbox" name="sb_google" value="on" <?php if ($c->sb_google == "on") { ?> checked="checked"<?php } ?> />Google!&#160;
				<input type="checkbox" name="sb_live" value="on" <?php if ($c->sb_live == "on") { ?> checked="checked"<?php } ?> />Live!&#160;
				<input type="checkbox" name="sb_facebook" value="on" <?php if ($c->sb_facebook == "on") { ?> checked="checked"<?php } ?> />Facebook!&#160;
				<input type="checkbox" name="sb_slashdot" value="on" <?php if ($c->sb_slashdot == "on") { ?> checked="checked"<?php } ?> />Slashdot!&#160;
				<input type="checkbox" name="sb_netscape" value="on" <?php if ($c->sb_netscape == "on") { ?> checked="checked"<?php } ?> />Netscape!&#160;
				<input type="checkbox" name="sb_technorati" value="on" <?php if ($c->sb_technorati == "on") { ?> checked="checked"<?php } ?> />Technorati!&#160;
				<input type="checkbox" name="sb_stumbleupon" value="on" <?php if ($c->sb_stumbleupon == "on") { ?> checked="checked"<?php } ?> />StumbleUpon!&#160;
				<input type="checkbox" name="sb_spurl" value="on" <?php if ($c->sb_spurl == "on") { ?> checked="checked"<?php } ?> />Spurl!&#160;
				<input type="checkbox" name="sb_wists" value="on" <?php if ($c->sb_wists == "on") { ?> checked="checked"<?php } ?> />Wists!&#160;
				<input type="checkbox" name="sb_simpy" value="on" <?php if ($c->sb_simpy == "on") { ?> checked="checked"<?php } ?> />Simpy!&#160;
				<input type="checkbox" name="sb_newsvine" value="on" <?php if ($c->sb_newsvine == "on") { ?> checked="checked"<?php } ?> />Newsvine!&#160;
				<input type="checkbox" name="sb_blinklist" value="on" <?php if ($c->sb_blinklist == "on") { ?> checked="checked"<?php } ?> />Blinklist!&#160;
				<input type="checkbox" name="sb_furl" value="on" <?php if ($c->sb_furl == "on") { ?> checked="checked"<?php } ?> />Furl!&#160;
				<input type="checkbox" name="sb_fark" value="on" <?php if ($c->sb_fark == "on") { ?> checked="checked"<?php } ?> />Fark!&#160;
				<input type="checkbox" name="sb_blogmarks" value="on" <?php if ($c->sb_blogmarks == "on") { ?> checked="checked"<?php } ?> />Blogmarks!&#160;
				<input type="checkbox" name="sb_yahoo" value="on" <?php if ($c->sb_yahoo == "on") { ?> checked="checked"<?php } ?> />Yahoo!&#160;
				<input type="checkbox" name="sb_smarking" value="on" <?php if ($c->sb_smarking == "on") { ?> checked="checked"<?php } ?> />Smarking!&#160;
				<input type="checkbox" name="sb_netvouz" value="on" <?php if ($c->sb_netvouz == "on") { ?> checked="checked"<?php } ?> />Netvouz!&#160;
				<input type="checkbox" name="sb_shadows" value="on" <?php if ($c->sb_shadows == "on") { ?> checked="checked"<?php } ?> />Shadows!&#160;
				<input type="checkbox" name="sb_rawsugar" value="on" <?php if ($c->sb_rawsugar == "on") { ?> checked="checked"<?php } ?> />RawSugar!&#160;
				<input type="checkbox" name="sb_magnolia" value="on" <?php if ($c->sb_magnolia == "on") { ?> checked="checked"<?php } ?> />Ma.gnolia!&#160;
				<input type="checkbox" name="sb_plugim" value="on" <?php if ($c->sb_plugim == "on") { ?> checked="checked"<?php } ?> />PlugIM!&#160;
				<input type="checkbox" name="sb_squidoo" value="on" <?php if ($c->sb_squidoo == "on") { ?> checked="checked"<?php } ?> />Squidoo!&#160;
				<input type="checkbox" name="sb_blogmemes" value="on" <?php if ($c->sb_blogmemes == "on") { ?> checked="checked"<?php } ?> />BlogMemes!&#160;
				<input type="checkbox" name="sb_feedmelinks" value="on" <?php if ($c->sb_feedmelinks == "on") { ?> checked="checked"<?php } ?> />FeedMeLinks!&#160;
				<input type="checkbox" name="sb_blinkbits" value="on" <?php if ($c->sb_blinkbits == "on") { ?> checked="checked"<?php } ?> />BlinkBits!&#160;
				<input type="checkbox" name="sb_tailrank" value="on" <?php if ($c->sb_tailrank == "on") { ?> checked="checked"<?php } ?> />Tailrank!&#160;
				<input type="checkbox" name="sb_linkagogo" value="on" <?php if ($c->sb_linkagogo == "on") { ?> checked="checked"<?php } ?> />linkaGoGo!&#160;
			  </td></tr>
			</table>

			<table cellpadding="0" cellspacing="0" border="0" width="100%" class="adminform">
			  <tr><td align="left" valign="top" colspan="3">
			  <h3>Javascript Conflicts</h3>
			  <p>hwdPhotoShare uses popular javascript frameworks such as Mootools and Prototype.
			  Many other Joomla extensions and templates also use these frameworks. Unfortunately,
			  when different versions of these frameworks are loaded into a webpage, conflicts can occur that cause
			  website features to stop working. You can avoid this problem by only loading one version of each javascript framework.
			  To help you achieve this more easily, use the options below to stop hwdPhotoShare loading a new version of
			  each javascript.</p></td></tr>
			  <tr><td align="left" valign="top" colspan="3">
				<input type="checkbox" name="loadmootools" value="on" <?php if ($c->loadmootools == "on") { ?> checked="checked"<?php } ?> />Load <a href="http://mootools.net/" target="_blank">MooTools</a>&#160;<br />
				<input type="checkbox" name="loadprototype" value="on" <?php if ($c->loadprototype == "on") { ?> checked="checked"<?php } ?> />Load <a href="http://www.prototypejs.org/" target="_blank">Prototype</a>&#160;<br />
				<input type="checkbox" name="loadscriptaculous" value="on" <?php if ($c->loadscriptaculous == "on") { ?> checked="checked"<?php } ?> />Load <a href="http://script.aculo.us/" target="_blank">Script.aculo.us</a>&#160;<br />
				<input type="checkbox" name="loadswfobject" value="on" <?php if ($c->loadswfobject == "on") { ?> checked="checked"<?php } ?> />Load <a href="http://code.google.com/p/swfobject/" target="_blank">SWFObject</a>&#160;<br />
			  </td></tr>
			</table>


			<table cellpadding="0" cellspacing="0" border="0" width="95%" class="adminform">
			  <tr><td align="left" valign="top" colspan="3"><h3><?php echo _ADMIN_HWDPS_SETT_CAPTCHA ?></h3></td></tr>
			  <tr>
				<td width="20%" align="left" valign="top"><?php echo _ADMIN_HWDPS_SETT_DISABLECAPTCHA ?></td>
				<td width="20%" align="left" valign="top">
				<select name="disablecaptcha" size="1" class="inputbox">
					<option value="1"<?php if ($c->disablecaptcha == 1) { ?> selected="selected"<?php } ?>><?php echo _ADMIN_HWDPS_SETT_YES.' '; ?></option>
					<option value="0"<?php if ($c->disablecaptcha == 0) { ?> selected="selected"<?php } ?>><?php echo _ADMIN_HWDPS_SETT_NO.' '; ?></option>
				</select>
				</td>
				<td width="60%" align="left" valign="top"><?php echo _ADMIN_HWDPS_SETT_DISABLECAPTCHA_DESC ?></td>
			  </tr>
			</table>

			<table cellpadding="0" cellspacing="0" border="0" width="100%" class="adminform">
			  <tr><td align="left" valign="top" colspan="3"><h3><?php echo _ADMIN_HWDPS_SETT_SHOWCOPYRIGHT ?></h3></td></tr>
			  <tr>
				<td width="20%" align="left" valign="top"><?php echo _ADMIN_HWDPS_SETT_SHOWCREDIT ?></td>
				<td width="20%" align="left" valign="top">
				<select name="showcredit" size="1" class="inputbox">
					<option value="1"<?php if ($c->showcredit == 1) { ?> selected="selected"<?php } ?>><?php echo _ADMIN_HWDPS_SETT_YES.' '; ?></option>
					<option value="0"<?php if ($c->showcredit == 0) { ?> selected="selected"<?php } ?>><?php echo _ADMIN_HWDPS_SETT_NO.' '; ?></option>
				</select>
				</td>
				<td width="60%" align="left" valign="top"><?php echo _ADMIN_HWDPS_SETT_SHOWCREDIT_DESC ?></td>
			  </tr>
			</table>
			</div>
			<?php
			echo $endtab;
			echo $starttab3;
			?>
			<div style="margin:1px;padding:1px;"><br />
			<table cellpadding="0" cellspacing="0" border="0" width="100%" class="adminform">
			  <tr><td align="left" valign="top" colspan="3"><h3><?php echo _ADMIN_HWDPS_SETT_DEFAULTSO ?></h3></td></tr>
			  <tr>
				<td width="20%" align="left" valign="top"><?php echo _ADMIN_HWDPS_SETT_DSACCESS ?></td>
				<td width="20%" align="left" valign="top">
				<select name="shareoption1" size="1" class="inputbox">
					<option value="1"<?php if ($c->shareoption1 == 1) { ?> selected="selected"<?php } ?>><?php echo _HWDPS_SELECT_PUBLIC.' '; ?></option>
					<option value="0"<?php if ($c->shareoption1 == 0) { ?> selected="selected"<?php } ?>><?php echo _HWDPS_SELECT_REG.' '; ?></option>
				</select>
				</td>
				<td width="60%" align="left" valign="top"><?php echo _ADMIN_HWDPS_SETT_DSACCESS_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><?php echo _ADMIN_HWDPS_SETT_USACCESS ?></td>
				<td width="20%" align="left" valign="top">
				<select name="usershare1" size="1" class="inputbox">
					<option value="1"<?php if ($c->usershare1 == 1) { ?> selected="selected"<?php } ?>><?php echo _ADMIN_HWDPS_SETT_YES.' '; ?></option>
					<option value="0"<?php if ($c->usershare1 == 0) { ?> selected="selected"<?php } ?>><?php echo _ADMIN_HWDPS_SETT_NO.' '; ?></option>
				</select>
				</td>
				<td width="60%" align="left" valign="top"><?php echo _ADMIN_HWDPS_SETT_USACCESS_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><?php echo _ADMIN_HWDPS_SETT_DSCOMMS ?></td>
				<td width="20%" align="left" valign="top">
				<select name="shareoption2" size="1" class="inputbox">
					<option value="1"<?php if ($c->shareoption2 == 1) { ?> selected="selected"<?php } ?>><?php echo _HWDPS_SELECT_ALLOWCOMMS.' '; ?></option>
					<option value="0"<?php if ($c->shareoption2 == 0) { ?> selected="selected"<?php } ?>><?php echo _HWDPS_SELECT_DONTALLOWCOMMS.' '; ?></option>
				</select>
				</td>
				<td width="60%" align="left" valign="top"><?php echo _ADMIN_HWDPS_SETT_DSCOMMS_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><?php echo _ADMIN_HWDPS_SETT_USCOMMS ?></td>
				<td width="20%" align="left" valign="top">
				<select name="usershare2" size="1" class="inputbox">
					<option value="1"<?php if ($c->usershare2 == 1) { ?> selected="selected"<?php } ?>><?php echo _ADMIN_HWDPS_SETT_YES.' '; ?></option>
					<option value="0"<?php if ($c->usershare2 == 0) { ?> selected="selected"<?php } ?>><?php echo _ADMIN_HWDPS_SETT_NO.' '; ?></option>
				</select>
				</td>
				<td width="60%" align="left" valign="top"><?php echo _ADMIN_HWDPS_SETT_USCOMMS_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><?php echo _ADMIN_HWDPS_SETT_DSRATE ?></td>
				<td width="20%" align="left" valign="top">
				<select name="shareoption4" size="1" class="inputbox">
					<option value="1"<?php if ($c->shareoption4 == 1) { ?> selected="selected"<?php } ?>><?php echo _HWDPS_SELECT_ALLOWRATE.' '; ?></option>
					<option value="0"<?php if ($c->shareoption4 == 0) { ?> selected="selected"<?php } ?>><?php echo _HWDPS_SELECT_DONTALLOWRATE.' '; ?></option>
				</select>
				</td>
				<td width="60%" align="left" valign="top"><?php echo _ADMIN_HWDPS_SETT_DSRATE_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><?php echo _ADMIN_HWDPS_SETT_USRATE ?></td>
				<td width="20%" align="left" valign="top">
				<select name="usershare4" size="1" class="inputbox">
					<option value="1"<?php if ($c->usershare4 == 1) { ?> selected="selected"<?php } ?>><?php echo _ADMIN_HWDPS_SETT_YES.' '; ?></option>
					<option value="0"<?php if ($c->usershare4 == 0) { ?> selected="selected"<?php } ?>><?php echo _ADMIN_HWDPS_SETT_NO.' '; ?></option>
				</select>
				</td>
				<td width="60%" align="left" valign="top"><?php echo _ADMIN_HWDPS_SETT_USRATE_DESC ?></td>
			  </tr>
			</table>
			</div>
			<?php
			echo $endtab;
			echo $starttab4;
			?>
			<div style="margin:1px;padding:1px;"><br />
			<table cellpadding="0" cellspacing="0" border="0" width="95%" class="adminform">
			  <tr><td align="left" valign="top" colspan="3"><h3><?php echo _ADMIN_HWDPS_SETT_APPROVALS ?></h3></td></tr>
			  <tr>
				<td width="20%" align="left" valign="top">Auto-approve Photos?</td>
				<td width="20%" align="left" valign="top">
				<select name="aap" size="1" class="inputbox">
					<option value="1"<?php if ($c->aap == 1) { ?> selected="selected"<?php } ?>><?php echo _ADMIN_HWDPS_SETT_YES.' '; ?></option>
					<option value="0"<?php if ($c->aap == 0) { ?> selected="selected"<?php } ?>><?php echo _ADMIN_HWDPS_SETT_NO.' '; ?></option>
				</select>
				</td>
				<td width="60%" align="left" valign="top">Should photos be automatically approved after upload?</td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top">Auto-approve Albums?</td>
				<td width="20%" align="left" valign="top">
				<select name="aaa" size="1" class="inputbox">
					<option value="1"<?php if ($c->aaa == 1) { ?> selected="selected"<?php } ?>><?php echo _ADMIN_HWDPS_SETT_YES.' '; ?></option>
					<option value="0"<?php if ($c->aaa == 0) { ?> selected="selected"<?php } ?>><?php echo _ADMIN_HWDPS_SETT_NO.' '; ?></option>
				</select>
				</td>
				<td width="60%" align="left" valign="top">Should albums be automatically approved after creation?</td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><?php echo _ADMIN_HWDPS_SETT_AAGROUPS ?></td>
				<td width="20%" align="left" valign="top">
				<select name="aag" size="1" class="inputbox">
					<option value="1"<?php if ($c->aag == 1) { ?> selected="selected"<?php } ?>><?php echo _ADMIN_HWDPS_SETT_YES.' '; ?></option>
					<option value="0"<?php if ($c->aag == 0) { ?> selected="selected"<?php } ?>><?php echo _ADMIN_HWDPS_SETT_NO.' '; ?></option>
				</select>
				</td>
				<td width="60%" align="left" valign="top">Should groups be automatically approved after creation?</td>
			  </tr>
			</table>
			</div>
			<?php
			echo $endtab;
			echo $starttab5;
			?>
			<div style="margin:1px;padding:1px;"><br />
			<table cellpadding="0" cellspacing="0" border="0" width="95%" class="adminform">
			  <tr><td align="left" valign="top" colspan="3"><h3>Main Images</h3></td></tr>
			  <tr>
				<td width="20%" align="left" valign="top">Resize all main images</td>
				<td width="20%" align="left" valign="top">
				<select name="resize_main" size="1" class="inputbox">
					<option value="200"<?php if ($c->resize_main == 200) { ?> selected="selected"<?php } ?>>200px</option>
					<option value="205"<?php if ($c->resize_main == 205) { ?> selected="selected"<?php } ?>>205px</option>
					<option value="210"<?php if ($c->resize_main == 210) { ?> selected="selected"<?php } ?>>210px</option>
					<option value="215"<?php if ($c->resize_main == 215) { ?> selected="selected"<?php } ?>>215px</option>
					<option value="220"<?php if ($c->resize_main == 220) { ?> selected="selected"<?php } ?>>220px</option>
					<option value="225"<?php if ($c->resize_main == 225) { ?> selected="selected"<?php } ?>>225px</option>
					<option value="230"<?php if ($c->resize_main == 230) { ?> selected="selected"<?php } ?>>230px</option>
					<option value="235"<?php if ($c->resize_main == 235) { ?> selected="selected"<?php } ?>>235px</option>
					<option value="240"<?php if ($c->resize_main == 240) { ?> selected="selected"<?php } ?>>240px</option>
					<option value="245"<?php if ($c->resize_main == 245) { ?> selected="selected"<?php } ?>>245px</option>
					<option value="250"<?php if ($c->resize_main == 250) { ?> selected="selected"<?php } ?>>250px</option>
					<option value="255"<?php if ($c->resize_main == 255) { ?> selected="selected"<?php } ?>>255px</option>
					<option value="260"<?php if ($c->resize_main == 260) { ?> selected="selected"<?php } ?>>260px</option>
					<option value="265"<?php if ($c->resize_main == 265) { ?> selected="selected"<?php } ?>>265px</option>
					<option value="270"<?php if ($c->resize_main == 270) { ?> selected="selected"<?php } ?>>270px</option>
					<option value="275"<?php if ($c->resize_main == 275) { ?> selected="selected"<?php } ?>>275px</option>
					<option value="280"<?php if ($c->resize_main == 280) { ?> selected="selected"<?php } ?>>280px</option>
					<option value="285"<?php if ($c->resize_main == 285) { ?> selected="selected"<?php } ?>>285px</option>
					<option value="290"<?php if ($c->resize_main == 290) { ?> selected="selected"<?php } ?>>290px</option>
					<option value="295"<?php if ($c->resize_main == 295) { ?> selected="selected"<?php } ?>>295px</option>
					<option value="300"<?php if ($c->resize_main == 300) { ?> selected="selected"<?php } ?>>300px</option>
					<option value="305"<?php if ($c->resize_main == 305) { ?> selected="selected"<?php } ?>>305px</option>
					<option value="310"<?php if ($c->resize_main == 310) { ?> selected="selected"<?php } ?>>310px</option>
					<option value="315"<?php if ($c->resize_main == 315) { ?> selected="selected"<?php } ?>>315px</option>
					<option value="320"<?php if ($c->resize_main == 320) { ?> selected="selected"<?php } ?>>320px</option>
					<option value="325"<?php if ($c->resize_main == 325) { ?> selected="selected"<?php } ?>>325px</option>
					<option value="330"<?php if ($c->resize_main == 330) { ?> selected="selected"<?php } ?>>330px</option>
					<option value="335"<?php if ($c->resize_main == 335) { ?> selected="selected"<?php } ?>>335px</option>
					<option value="340"<?php if ($c->resize_main == 340) { ?> selected="selected"<?php } ?>>340px</option>
					<option value="345"<?php if ($c->resize_main == 345) { ?> selected="selected"<?php } ?>>345px</option>
					<option value="350"<?php if ($c->resize_main == 350) { ?> selected="selected"<?php } ?>>350px</option>
					<option value="355"<?php if ($c->resize_main == 355) { ?> selected="selected"<?php } ?>>355px</option>
					<option value="360"<?php if ($c->resize_main == 360) { ?> selected="selected"<?php } ?>>360px</option>
					<option value="365"<?php if ($c->resize_main == 365) { ?> selected="selected"<?php } ?>>365px</option>
					<option value="370"<?php if ($c->resize_main == 370) { ?> selected="selected"<?php } ?>>370px</option>
					<option value="375"<?php if ($c->resize_main == 375) { ?> selected="selected"<?php } ?>>375px</option>
					<option value="380"<?php if ($c->resize_main == 380) { ?> selected="selected"<?php } ?>>380px</option>
					<option value="385"<?php if ($c->resize_main == 385) { ?> selected="selected"<?php } ?>>385px</option>
					<option value="390"<?php if ($c->resize_main == 390) { ?> selected="selected"<?php } ?>>390px</option>
					<option value="395"<?php if ($c->resize_main == 395) { ?> selected="selected"<?php } ?>>395px</option>
					<option value="400"<?php if ($c->resize_main == 400) { ?> selected="selected"<?php } ?>>400px</option>
					<option value="405"<?php if ($c->resize_main == 405) { ?> selected="selected"<?php } ?>>405px</option>
					<option value="410"<?php if ($c->resize_main == 410) { ?> selected="selected"<?php } ?>>410px</option>
					<option value="415"<?php if ($c->resize_main == 415) { ?> selected="selected"<?php } ?>>415px</option>
					<option value="420"<?php if ($c->resize_main == 420) { ?> selected="selected"<?php } ?>>420px</option>
					<option value="425"<?php if ($c->resize_main == 425) { ?> selected="selected"<?php } ?>>425px</option>
					<option value="430"<?php if ($c->resize_main == 430) { ?> selected="selected"<?php } ?>>430px</option>
					<option value="435"<?php if ($c->resize_main == 435) { ?> selected="selected"<?php } ?>>435px</option>
					<option value="440"<?php if ($c->resize_main == 440) { ?> selected="selected"<?php } ?>>440px</option>
					<option value="445"<?php if ($c->resize_main == 445) { ?> selected="selected"<?php } ?>>445px</option>
					<option value="450"<?php if ($c->resize_main == 450) { ?> selected="selected"<?php } ?>>450px</option>
					<option value="455"<?php if ($c->resize_main == 455) { ?> selected="selected"<?php } ?>>455px</option>
					<option value="460"<?php if ($c->resize_main == 460) { ?> selected="selected"<?php } ?>>460px</option>
					<option value="465"<?php if ($c->resize_main == 465) { ?> selected="selected"<?php } ?>>465px</option>
					<option value="470"<?php if ($c->resize_main == 470) { ?> selected="selected"<?php } ?>>470px</option>
					<option value="475"<?php if ($c->resize_main == 475) { ?> selected="selected"<?php } ?>>475px</option>
					<option value="480"<?php if ($c->resize_main == 480) { ?> selected="selected"<?php } ?>>480px</option>
					<option value="485"<?php if ($c->resize_main == 485) { ?> selected="selected"<?php } ?>>485px</option>
					<option value="490"<?php if ($c->resize_main == 490) { ?> selected="selected"<?php } ?>>490px</option>
					<option value="495"<?php if ($c->resize_main == 495) { ?> selected="selected"<?php } ?>>495px</option>
					<option value="500"<?php if ($c->resize_main == 500) { ?> selected="selected"<?php } ?>>500px</option>
					<option value="505"<?php if ($c->resize_main == 505) { ?> selected="selected"<?php } ?>>505px</option>
					<option value="510"<?php if ($c->resize_main == 510) { ?> selected="selected"<?php } ?>>510px</option>
					<option value="515"<?php if ($c->resize_main == 515) { ?> selected="selected"<?php } ?>>515px</option>
					<option value="520"<?php if ($c->resize_main == 520) { ?> selected="selected"<?php } ?>>520px</option>
					<option value="525"<?php if ($c->resize_main == 525) { ?> selected="selected"<?php } ?>>525px</option>
					<option value="530"<?php if ($c->resize_main == 530) { ?> selected="selected"<?php } ?>>530px</option>
					<option value="535"<?php if ($c->resize_main == 535) { ?> selected="selected"<?php } ?>>535px</option>
					<option value="540"<?php if ($c->resize_main == 540) { ?> selected="selected"<?php } ?>>540px</option>
					<option value="545"<?php if ($c->resize_main == 545) { ?> selected="selected"<?php } ?>>545px</option>
					<option value="550"<?php if ($c->resize_main == 550) { ?> selected="selected"<?php } ?>>550px</option>
					<option value="555"<?php if ($c->resize_main == 555) { ?> selected="selected"<?php } ?>>555px</option>
					<option value="560"<?php if ($c->resize_main == 560) { ?> selected="selected"<?php } ?>>560px</option>
					<option value="565"<?php if ($c->resize_main == 565) { ?> selected="selected"<?php } ?>>565px</option>
					<option value="570"<?php if ($c->resize_main == 570) { ?> selected="selected"<?php } ?>>570px</option>
					<option value="575"<?php if ($c->resize_main == 575) { ?> selected="selected"<?php } ?>>575px</option>
					<option value="580"<?php if ($c->resize_main == 580) { ?> selected="selected"<?php } ?>>580px</option>
					<option value="585"<?php if ($c->resize_main == 585) { ?> selected="selected"<?php } ?>>585px</option>
					<option value="590"<?php if ($c->resize_main == 590) { ?> selected="selected"<?php } ?>>590px</option>
					<option value="595"<?php if ($c->resize_main == 595) { ?> selected="selected"<?php } ?>>595px</option>
					<option value="600"<?php if ($c->resize_main == 600) { ?> selected="selected"<?php } ?>>600px</option>
					<option value="605"<?php if ($c->resize_main == 605) { ?> selected="selected"<?php } ?>>605px</option>
					<option value="610"<?php if ($c->resize_main == 610) { ?> selected="selected"<?php } ?>>610px</option>
					<option value="615"<?php if ($c->resize_main == 615) { ?> selected="selected"<?php } ?>>615px</option>
					<option value="620"<?php if ($c->resize_main == 620) { ?> selected="selected"<?php } ?>>620px</option>
					<option value="625"<?php if ($c->resize_main == 625) { ?> selected="selected"<?php } ?>>625px</option>
					<option value="630"<?php if ($c->resize_main == 630) { ?> selected="selected"<?php } ?>>630px</option>
					<option value="635"<?php if ($c->resize_main == 635) { ?> selected="selected"<?php } ?>>635px</option>
					<option value="640"<?php if ($c->resize_main == 640) { ?> selected="selected"<?php } ?>>640px</option>
					<option value="645"<?php if ($c->resize_main == 645) { ?> selected="selected"<?php } ?>>645px</option>
					<option value="650"<?php if ($c->resize_main == 650) { ?> selected="selected"<?php } ?>>650px</option>
					<option value="655"<?php if ($c->resize_main == 655) { ?> selected="selected"<?php } ?>>655px</option>
					<option value="660"<?php if ($c->resize_main == 660) { ?> selected="selected"<?php } ?>>660px</option>
					<option value="665"<?php if ($c->resize_main == 665) { ?> selected="selected"<?php } ?>>665px</option>
					<option value="670"<?php if ($c->resize_main == 670) { ?> selected="selected"<?php } ?>>670px</option>
					<option value="675"<?php if ($c->resize_main == 675) { ?> selected="selected"<?php } ?>>675px</option>
					<option value="680"<?php if ($c->resize_main == 680) { ?> selected="selected"<?php } ?>>680px</option>
					<option value="685"<?php if ($c->resize_main == 685) { ?> selected="selected"<?php } ?>>685px</option>
					<option value="690"<?php if ($c->resize_main == 690) { ?> selected="selected"<?php } ?>>690px</option>
					<option value="695"<?php if ($c->resize_main == 695) { ?> selected="selected"<?php } ?>>695px</option>
					<option value="700"<?php if ($c->resize_main == 700) { ?> selected="selected"<?php } ?>>700px</option>
					<option value="705"<?php if ($c->resize_main == 705) { ?> selected="selected"<?php } ?>>705px</option>
					<option value="710"<?php if ($c->resize_main == 710) { ?> selected="selected"<?php } ?>>710px</option>
					<option value="715"<?php if ($c->resize_main == 715) { ?> selected="selected"<?php } ?>>715px</option>
					<option value="720"<?php if ($c->resize_main == 720) { ?> selected="selected"<?php } ?>>720px</option>
					<option value="725"<?php if ($c->resize_main == 725) { ?> selected="selected"<?php } ?>>725px</option>
					<option value="730"<?php if ($c->resize_main == 730) { ?> selected="selected"<?php } ?>>730px</option>
					<option value="735"<?php if ($c->resize_main == 735) { ?> selected="selected"<?php } ?>>735px</option>
					<option value="740"<?php if ($c->resize_main == 740) { ?> selected="selected"<?php } ?>>740px</option>
					<option value="745"<?php if ($c->resize_main == 745) { ?> selected="selected"<?php } ?>>745px</option>
					<option value="750"<?php if ($c->resize_main == 750) { ?> selected="selected"<?php } ?>>750px</option>
					<option value="755"<?php if ($c->resize_main == 755) { ?> selected="selected"<?php } ?>>755px</option>
					<option value="760"<?php if ($c->resize_main == 760) { ?> selected="selected"<?php } ?>>760px</option>
					<option value="765"<?php if ($c->resize_main == 765) { ?> selected="selected"<?php } ?>>765px</option>
					<option value="770"<?php if ($c->resize_main == 770) { ?> selected="selected"<?php } ?>>770px</option>
					<option value="775"<?php if ($c->resize_main == 775) { ?> selected="selected"<?php } ?>>775px</option>
					<option value="780"<?php if ($c->resize_main == 780) { ?> selected="selected"<?php } ?>>780px</option>
					<option value="785"<?php if ($c->resize_main == 785) { ?> selected="selected"<?php } ?>>785px</option>
					<option value="790"<?php if ($c->resize_main == 790) { ?> selected="selected"<?php } ?>>790px</option>
					<option value="795"<?php if ($c->resize_main == 795) { ?> selected="selected"<?php } ?>>795px</option>
					<option value="800"<?php if ($c->resize_main == 800) { ?> selected="selected"<?php } ?>>800px</option>
					<option value="805"<?php if ($c->resize_main == 805) { ?> selected="selected"<?php } ?>>805px</option>
					<option value="810"<?php if ($c->resize_main == 810) { ?> selected="selected"<?php } ?>>810px</option>
					<option value="815"<?php if ($c->resize_main == 815) { ?> selected="selected"<?php } ?>>815px</option>
					<option value="820"<?php if ($c->resize_main == 820) { ?> selected="selected"<?php } ?>>820px</option>
					<option value="825"<?php if ($c->resize_main == 825) { ?> selected="selected"<?php } ?>>825px</option>
					<option value="830"<?php if ($c->resize_main == 830) { ?> selected="selected"<?php } ?>>830px</option>
					<option value="835"<?php if ($c->resize_main == 835) { ?> selected="selected"<?php } ?>>835px</option>
					<option value="840"<?php if ($c->resize_main == 840) { ?> selected="selected"<?php } ?>>840px</option>
					<option value="845"<?php if ($c->resize_main == 845) { ?> selected="selected"<?php } ?>>845px</option>
					<option value="850"<?php if ($c->resize_main == 850) { ?> selected="selected"<?php } ?>>850px</option>
					<option value="855"<?php if ($c->resize_main == 855) { ?> selected="selected"<?php } ?>>855px</option>
					<option value="860"<?php if ($c->resize_main == 860) { ?> selected="selected"<?php } ?>>860px</option>
					<option value="865"<?php if ($c->resize_main == 865) { ?> selected="selected"<?php } ?>>865px</option>
					<option value="870"<?php if ($c->resize_main == 870) { ?> selected="selected"<?php } ?>>870px</option>
					<option value="875"<?php if ($c->resize_main == 875) { ?> selected="selected"<?php } ?>>875px</option>
					<option value="880"<?php if ($c->resize_main == 880) { ?> selected="selected"<?php } ?>>880px</option>
					<option value="885"<?php if ($c->resize_main == 885) { ?> selected="selected"<?php } ?>>885px</option>
					<option value="890"<?php if ($c->resize_main == 890) { ?> selected="selected"<?php } ?>>890px</option>
					<option value="895"<?php if ($c->resize_main == 895) { ?> selected="selected"<?php } ?>>895px</option>
					<option value="900"<?php if ($c->resize_main == 900) { ?> selected="selected"<?php } ?>>900px</option>
					<option value="905"<?php if ($c->resize_main == 905) { ?> selected="selected"<?php } ?>>905px</option>
					<option value="910"<?php if ($c->resize_main == 910) { ?> selected="selected"<?php } ?>>910px</option>
					<option value="915"<?php if ($c->resize_main == 915) { ?> selected="selected"<?php } ?>>915px</option>
					<option value="920"<?php if ($c->resize_main == 920) { ?> selected="selected"<?php } ?>>920px</option>
					<option value="925"<?php if ($c->resize_main == 925) { ?> selected="selected"<?php } ?>>925px</option>
					<option value="930"<?php if ($c->resize_main == 930) { ?> selected="selected"<?php } ?>>930px</option>
					<option value="935"<?php if ($c->resize_main == 935) { ?> selected="selected"<?php } ?>>935px</option>
					<option value="940"<?php if ($c->resize_main == 940) { ?> selected="selected"<?php } ?>>940px</option>
					<option value="945"<?php if ($c->resize_main == 945) { ?> selected="selected"<?php } ?>>945px</option>
					<option value="950"<?php if ($c->resize_main == 950) { ?> selected="selected"<?php } ?>>950px</option>
					<option value="955"<?php if ($c->resize_main == 955) { ?> selected="selected"<?php } ?>>955px</option>
					<option value="960"<?php if ($c->resize_main == 960) { ?> selected="selected"<?php } ?>>960px</option>
					<option value="965"<?php if ($c->resize_main == 965) { ?> selected="selected"<?php } ?>>965px</option>
					<option value="970"<?php if ($c->resize_main == 970) { ?> selected="selected"<?php } ?>>970px</option>
					<option value="975"<?php if ($c->resize_main == 975) { ?> selected="selected"<?php } ?>>975px</option>
					<option value="980"<?php if ($c->resize_main == 980) { ?> selected="selected"<?php } ?>>980px</option>
					<option value="985"<?php if ($c->resize_main == 985) { ?> selected="selected"<?php } ?>>985px</option>
					<option value="990"<?php if ($c->resize_main == 990) { ?> selected="selected"<?php } ?>>990px</option>
					<option value="995"<?php if ($c->resize_main == 995) { ?> selected="selected"<?php } ?>>995px</option>
					<option value="1000"<?php if ($c->resize_main == 1000) { ?> selected="selected"<?php } ?>>1000px</option>

				</select>
				</td>
				<td width="60%" align="left" valign="top"></td>
			  </tr>
			</table>
			<table cellpadding="0" cellspacing="0" border="0" width="95%" class="adminform">
			  <tr><td align="left" valign="top" colspan="3"><h3>Thumbnail Images</h3></td></tr>
			  <tr>
				<td width="20%" align="left" valign="top">Resize all thumbnail images</td>
				<td width="20%" align="left" valign="top">
				<select name="resize_thumb" size="1" class="inputbox">
					<option value="50"<?php if ($c->resize_thumb == 50) { ?> selected="selected"<?php } ?>>50px</option>
					<option value="60"<?php if ($c->resize_thumb == 60) { ?> selected="selected"<?php } ?>>60px</option>
					<option value="70"<?php if ($c->resize_thumb == 70) { ?> selected="selected"<?php } ?>>70px</option>
					<option value="80"<?php if ($c->resize_thumb == 80) { ?> selected="selected"<?php } ?>>80px</option>
					<option value="90"<?php if ($c->resize_thumb == 90) { ?> selected="selected"<?php } ?>>90px</option>
					<option value="100"<?php if ($c->resize_thumb == 100) { ?> selected="selected"<?php } ?>>100px</option>
					<option value="105"<?php if ($c->resize_thumb == 105) { ?> selected="selected"<?php } ?>>105px</option>
					<option value="110"<?php if ($c->resize_thumb == 110) { ?> selected="selected"<?php } ?>>110px</option>
					<option value="115"<?php if ($c->resize_thumb == 115) { ?> selected="selected"<?php } ?>>115px</option>
					<option value="120"<?php if ($c->resize_thumb == 120) { ?> selected="selected"<?php } ?>>120px</option>
					<option value="125"<?php if ($c->resize_thumb == 125) { ?> selected="selected"<?php } ?>>125px</option>
					<option value="130"<?php if ($c->resize_thumb == 130) { ?> selected="selected"<?php } ?>>130px</option>
					<option value="135"<?php if ($c->resize_thumb == 135) { ?> selected="selected"<?php } ?>>135px</option>
					<option value="140"<?php if ($c->resize_thumb == 140) { ?> selected="selected"<?php } ?>>140px</option>
					<option value="145"<?php if ($c->resize_thumb == 145) { ?> selected="selected"<?php } ?>>145px</option>
					<option value="150"<?php if ($c->resize_thumb == 150) { ?> selected="selected"<?php } ?>>150px</option>
					<option value="155"<?php if ($c->resize_thumb == 155) { ?> selected="selected"<?php } ?>>155px</option>
					<option value="160"<?php if ($c->resize_thumb == 160) { ?> selected="selected"<?php } ?>>160px</option>
					<option value="165"<?php if ($c->resize_thumb == 165) { ?> selected="selected"<?php } ?>>165px</option>
					<option value="170"<?php if ($c->resize_thumb == 170) { ?> selected="selected"<?php } ?>>170px</option>
					<option value="175"<?php if ($c->resize_thumb == 175) { ?> selected="selected"<?php } ?>>175px</option>
					<option value="180"<?php if ($c->resize_thumb == 180) { ?> selected="selected"<?php } ?>>180px</option>
					<option value="185"<?php if ($c->resize_thumb == 185) { ?> selected="selected"<?php } ?>>185px</option>
					<option value="190"<?php if ($c->resize_thumb == 190) { ?> selected="selected"<?php } ?>>190px</option>
					<option value="195"<?php if ($c->resize_thumb == 195) { ?> selected="selected"<?php } ?>>195px</option>
					<option value="200"<?php if ($c->resize_thumb == 200) { ?> selected="selected"<?php } ?>>200px</option>
					<option value="205"<?php if ($c->resize_thumb == 205) { ?> selected="selected"<?php } ?>>205px</option>
					<option value="210"<?php if ($c->resize_thumb == 210) { ?> selected="selected"<?php } ?>>210px</option>
					<option value="215"<?php if ($c->resize_thumb == 215) { ?> selected="selected"<?php } ?>>215px</option>
					<option value="220"<?php if ($c->resize_thumb == 220) { ?> selected="selected"<?php } ?>>220px</option>
					<option value="225"<?php if ($c->resize_thumb == 225) { ?> selected="selected"<?php } ?>>225px</option>
					<option value="230"<?php if ($c->resize_thumb == 230) { ?> selected="selected"<?php } ?>>230px</option>
					<option value="235"<?php if ($c->resize_thumb == 235) { ?> selected="selected"<?php } ?>>235px</option>
					<option value="240"<?php if ($c->resize_thumb == 240) { ?> selected="selected"<?php } ?>>240px</option>
					<option value="245"<?php if ($c->resize_thumb == 245) { ?> selected="selected"<?php } ?>>245px</option>
					<option value="250"<?php if ($c->resize_thumb == 250) { ?> selected="selected"<?php } ?>>250px</option>
				</select>
				</td>
				<td width="60%" align="left" valign="top"></td>
			  </tr>
			</table>
			<table cellpadding="0" cellspacing="0" border="0" width="95%" class="adminform">
			  <tr><td align="left" valign="top" colspan="3"><h3>Square Thumbnail Images</h3></td></tr>
			  <tr>
				<td width="20%" align="left" valign="top">Resize all square thumbnail images</td>
				<td width="20%" align="left" valign="top">
				<select name="resize_square" size="1" class="inputbox">
					<option value="50"<?php if ($c->resize_square == 50) { ?> selected="selected"<?php } ?>>50px</option>
					<option value="60"<?php if ($c->resize_square == 60) { ?> selected="selected"<?php } ?>>60px</option>
					<option value="70"<?php if ($c->resize_square == 70) { ?> selected="selected"<?php } ?>>70px</option>
					<option value="80"<?php if ($c->resize_square == 80) { ?> selected="selected"<?php } ?>>80px</option>
					<option value="90"<?php if ($c->resize_square == 90) { ?> selected="selected"<?php } ?>>90px</option>
					<option value="100"<?php if ($c->resize_square == 100) { ?> selected="selected"<?php } ?>>100px</option>
					<option value="105"<?php if ($c->resize_square == 105) { ?> selected="selected"<?php } ?>>105px</option>
					<option value="110"<?php if ($c->resize_square == 110) { ?> selected="selected"<?php } ?>>110px</option>
					<option value="115"<?php if ($c->resize_square == 115) { ?> selected="selected"<?php } ?>>115px</option>
					<option value="120"<?php if ($c->resize_square == 120) { ?> selected="selected"<?php } ?>>120px</option>
					<option value="125"<?php if ($c->resize_square == 125) { ?> selected="selected"<?php } ?>>125px</option>
					<option value="130"<?php if ($c->resize_square == 130) { ?> selected="selected"<?php } ?>>130px</option>
					<option value="135"<?php if ($c->resize_square == 135) { ?> selected="selected"<?php } ?>>135px</option>
					<option value="140"<?php if ($c->resize_square == 140) { ?> selected="selected"<?php } ?>>140px</option>
					<option value="145"<?php if ($c->resize_square == 145) { ?> selected="selected"<?php } ?>>145px</option>
					<option value="150"<?php if ($c->resize_square == 150) { ?> selected="selected"<?php } ?>>150px</option>
					<option value="155"<?php if ($c->resize_square == 155) { ?> selected="selected"<?php } ?>>155px</option>
					<option value="160"<?php if ($c->resize_square == 160) { ?> selected="selected"<?php } ?>>160px</option>
					<option value="165"<?php if ($c->resize_square == 165) { ?> selected="selected"<?php } ?>>165px</option>
					<option value="170"<?php if ($c->resize_square == 170) { ?> selected="selected"<?php } ?>>170px</option>
					<option value="175"<?php if ($c->resize_square == 175) { ?> selected="selected"<?php } ?>>175px</option>
					<option value="180"<?php if ($c->resize_square == 180) { ?> selected="selected"<?php } ?>>180px</option>
					<option value="185"<?php if ($c->resize_square == 185) { ?> selected="selected"<?php } ?>>185px</option>
					<option value="190"<?php if ($c->resize_square == 190) { ?> selected="selected"<?php } ?>>190px</option>
					<option value="195"<?php if ($c->resize_square == 195) { ?> selected="selected"<?php } ?>>195px</option>
					<option value="200"<?php if ($c->resize_square == 200) { ?> selected="selected"<?php } ?>>200px</option>
					<option value="205"<?php if ($c->resize_square == 205) { ?> selected="selected"<?php } ?>>205px</option>
					<option value="210"<?php if ($c->resize_square == 210) { ?> selected="selected"<?php } ?>>210px</option>
					<option value="215"<?php if ($c->resize_square == 215) { ?> selected="selected"<?php } ?>>215px</option>
					<option value="220"<?php if ($c->resize_square == 220) { ?> selected="selected"<?php } ?>>220px</option>
					<option value="225"<?php if ($c->resize_square == 225) { ?> selected="selected"<?php } ?>>225px</option>
					<option value="230"<?php if ($c->resize_square == 230) { ?> selected="selected"<?php } ?>>230px</option>
					<option value="235"<?php if ($c->resize_square == 235) { ?> selected="selected"<?php } ?>>235px</option>
					<option value="240"<?php if ($c->resize_square == 240) { ?> selected="selected"<?php } ?>>240px</option>
					<option value="245"<?php if ($c->resize_square == 245) { ?> selected="selected"<?php } ?>>245px</option>
					<option value="250"<?php if ($c->resize_square == 250) { ?> selected="selected"<?php } ?>>250px</option>
				</select>
				</td>
				<td width="60%" align="left" valign="top"></td>
			  </tr>
			</table>
			</div>
			<?php
			echo $endtab;
			echo $starttab6;
			?>
			<div style="margin:1px;padding:1px;"><br />
			<table cellpadding="0" cellspacing="0" border="0" width="95%" class="adminform">
			  <tr><td align="left" valign="top" colspan="3"><h3><?php echo _ADMIN_HWDPS_SETT_NOTIFICATIONS ?></h3></td></tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b>Notify after new photo upload?</b></td>
				<td width="20%" align="left" valign="top">
				<select name="mailphotonotification" size="1" class="inputbox">
					<option value="1"<?php if ($c->mailphotonotification == 1) { ?> selected="selected"<?php } ?>><?php echo _ADMIN_HWDPS_SETT_YES.' '; ?></option>
					<option value="0"<?php if ($c->mailphotonotification == 0) { ?> selected="selected"<?php } ?>><?php echo _ADMIN_HWDPS_SETT_NO.' '; ?></option>
				</select>
				</td>
				<td width="60%" align="left" valign="top">Send a notification email when a user uploads a photo</td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b>Notify after new album creation?</b></td>
				<td width="20%" align="left" valign="top">
				<select name="mailalbumnotification" size="1" class="inputbox">
					<option value="1"<?php if ($c->mailalbumnotification == 1) { ?> selected="selected"<?php } ?>><?php echo _ADMIN_HWDPS_SETT_YES.' '; ?></option>
					<option value="0"<?php if ($c->mailalbumnotification == 0) { ?> selected="selected"<?php } ?>><?php echo _ADMIN_HWDPS_SETT_NO.' '; ?></option>
				</select>
				</td>
				<td width="60%" align="left" valign="top">Send a notification email when a user creates an album</td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _ADMIN_HWDPS_SETT_NOTIFYG ?></b></td>
				<td width="20%" align="left" valign="top">
				<select name="mailgroupnotification" size="1" class="inputbox">
					<option value="1"<?php if ($c->mailgroupnotification == 1) { ?> selected="selected"<?php } ?>><?php echo _ADMIN_HWDPS_SETT_YES.' '; ?></option>
					<option value="0"<?php if ($c->mailgroupnotification == 0) { ?> selected="selected"<?php } ?>><?php echo _ADMIN_HWDPS_SETT_NO.' '; ?></option>
				</select>
				</td>
				<td width="60%" align="left" valign="top"><?php echo _ADMIN_HWDPS_SETT_NOTIFYG_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _ADMIN_HWDPS_SETT_NOTIFYR ?></b></td>
				<td width="20%" align="left" valign="top">
				<select name="mailreportnotification" size="1" class="inputbox">
					<option value="1"<?php if ($c->mailreportnotification == 1) { ?> selected="selected"<?php } ?>><?php echo _ADMIN_HWDPS_SETT_YES.' '; ?></option>
					<option value="0"<?php if ($c->mailreportnotification == 0) { ?> selected="selected"<?php } ?>><?php echo _ADMIN_HWDPS_SETT_NO.' '; ?></option>
				</select>
				</td>
				<td width="60%" align="left" valign="top"><?php echo _ADMIN_HWDPS_SETT_NOTIFYR_DESC ?></td>
			  </tr>
			  <tr>
				<td align="left" valign="top" width="20%"><b><?php echo _ADMIN_HWDPS_SETT_SENTTO ?></b></td>
				<td align="left" valign="top" width="20%"><input type="text" name="mailnotifyaddress" value="<?php if ($c->mailnotifyaddress == "") { echo $mosConfig_mailfrom; } else { echo $c->mailnotifyaddress; } ?>" size="40" maxlength="100"></td>
				<td align="left" valign="top" width="60%"><?php echo _ADMIN_HWDPS_SETT_SENDTO_DESC ?></td>
			  </tr>
			</table>
			</div>
			<?php
			echo $endtab;
			echo $starttab7;
			?>
			<div style="margin:1px;padding:1px;"><br />
			<table cellpadding="0" cellspacing="0" border="0" width="95%" class="adminform">
			  <tr><td align="left" valign="top" colspan="3"><h3><?php echo _ADMIN_HWDPS_SETT_INTEGRATIONSCB ?></h3></td></tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _ADMIN_HWDPS_SETT_INTCB ?></b></td>
				<td width="20%" align="left" valign="top">
				<select name="cbint" size="1" class="inputbox">
					<option value="3"<?php if ($c->cbint == 3) { ?> selected="selected"<?php } ?>>JoomSuite People Touch</option>
					<option value="2"<?php if ($c->cbint == 2) { ?> selected="selected"<?php } ?>>Jom Social</option>
					<option value="1"<?php if ($c->cbint == 1) { ?> selected="selected"<?php } ?>>Community Builder</option>
					<option value="0"<?php if ($c->cbint == 0) { ?> selected="selected"<?php } ?>><?php echo _ADMIN_HWDPS_SETT_NO.' '; ?></option>
				</select>
				</td>
				<td width="60%" align="left" valign="top"><?php echo _ADMIN_HWDPS_SETT_INTCB_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _ADMIN_HWDPS_SETT_SHOWCBAVA ?></b></td>
				<td width="20%" align="left" valign="top">
				<select name="cbavatar" size="1" class="inputbox">
					<option value="1"<?php if ($c->cbavatar == 1) { ?> selected="selected"<?php } ?>><?php echo _ADMIN_HWDPS_SETT_YES.' '; ?></option>
					<option value="0"<?php if ($c->cbavatar == 0) { ?> selected="selected"<?php } ?>><?php echo _ADMIN_HWDPS_SETT_NO.' '; ?></option>
				</select>
				</td>
				<td width="60%" align="left" valign="top"><?php echo _ADMIN_HWDPS_SETT_SHOWCBAVA_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _ADMIN_HWDPS_SETT_CBAVAWIDTH ?></b></td>
				<td align="left" valign="top" width="20%"><input type="text" name="avatarwidth" value="<?php echo $c->avatarwidth; ?>" size="7" maxlength="100"></td>
				<td width="60%" align="left" valign="top"><?php echo _ADMIN_HWDPS_SETT_CBAVAWIDTH_DESC ?></td>
			  </tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _ADMIN_HWDPS_SETT_CBITEMID ?></b></td>
				<td align="left" valign="top" width="20%"><input type="text" name="cbitemid" value="<?php echo $c->cbitemid; ?>" size="7" maxlength="100"></td>
				<td width="60%" align="left" valign="top"><?php echo _ADMIN_HWDPS_SETT_CBITEMID_DESC ?></td>
			  </tr>
			</table>
			<table cellpadding="0" cellspacing="0" border="0" width="95%" class="adminform">
			  <tr><td align="left" valign="top" colspan="3"><h3><?php echo _ADMIN_HWDPS_SETT_COMMSYS ?></h3></td></tr>
			  <tr>
				<td width="20%" align="left" valign="top"><b><?php echo _ADMIN_HWDPS_SETT_COMMCOM ?></b></td>
				<td width="20%" align="left" valign="top">
				<select name="commssys" size="1" class="inputbox">
					<option value="0"<?php if ($c->commssys == 0) { ?> selected="selected"<?php } ?>>JComments</option>
					<!-- <option value="1"<?php if ($c->commssys == 1) { ?> selected="selected"<?php } ?>>mXcomment</option> -->
					<!-- <option value="2"<?php if ($c->commssys == 2) { ?> selected="selected"<?php } ?>>!joomlacomment</option> -->
					<option value="3"<?php if ($c->commssys == 3) { ?> selected="selected"<?php } ?>>Jom Comment</option>
					<!-- <option value="4"<?php if ($c->commssys == 4) { ?> selected="selected"<?php } ?>>Akocomment</option> -->
					<!-- <option value="5"<?php if ($c->commssys == 5) { ?> selected="selected"<?php } ?>>yvComment</option> -->
					<!-- <option value="6"<?php if ($c->commssys == 6) { ?> selected="selected"<?php } ?>>EasyComments</option> -->
				</select>
				</td>
				<td width="60%" align="left" valign="top"><?php echo _ADMIN_HWDPS_SETT_COMMCOM_DESC ?></td>
			  </tr>
			</table>
			</div>
			<?php
			echo $endtab;
			echo $starttab8;
			?>
			<div style="margin:1px;padding:1px;"><br />
			<script language="javascript">
			function ShowAccessPane(){
				box = document.forms[0].access_method;
				uploadstatus = box.options[box.selectedIndex].value;
					if (uploadstatus == 0)
					{
					document.getElementById("groupaccess").style.visibility="visible";
					document.getElementById("groupaccess").style.height="auto";
					document.getElementById("levelaccess").style.visibility="hidden";
					document.getElementById("levelaccess").style.height="0px";
					}
					else
					{
					document.getElementById("groupaccess").style.visibility="hidden";
					document.getElementById("groupaccess").style.height="0px";
					document.getElementById("levelaccess").style.visibility="visible";
					document.getElementById("levelaccess").style.height="auto";
					}
			}
			</script>
			<div <?php if ($c->jaclint == 0) { ?> style="visibility: hidden; height: 0px;"<?php } ?>>
			<table cellpadding="0" cellspacing="0" border="0" width="100%" class="adminform">
			  <tr><td align="left" valign="top" colspan="3"><h3><?php echo _ADMIN_HWDPS_SETT_ACCESSSET ?></h3></td></tr>
			  <tr>
				<td width="20%" align="left" valign="top"><?php echo _ADMIN_HWDPS_SETT_ACCESSMETHOD; ?></td>
				<td width="20%" align="left" valign="top">
				<select name="access_method" size="1" class="inputbox" onChange="ShowAccessPane()">
					<option value="0"<?php if ($c->access_method == 0) { ?> selected="selected"<?php } ?>><?php echo _ADMIN_HWDPS_SETT_ACCESSGRP.' '; ?></option>
					<option value="1"<?php if ($c->access_method == 1) { ?> selected="selected"<?php } ?>><?php echo _ADMIN_HWDPS_SETT_ACCESSLEV.' '; ?></option>
				</select>
				</td>
				<td width="60%" align="left" valign="top"><?php echo _ADMIN_HWDPS_SETT_ACCESSMETHOD_DESC ?></td>
			  </tr>
			</table>
			</div>
			<div id="groupaccess" <?php if ($c->access_method == 1 && $c->jaclint == 1) { ?> style="visibility: hidden; height: 0px;"<?php } ?>>
				<table cellpadding="0" cellspacing="0" border="0" width="95%" class="adminform">
				  <tr><td align="left" valign="top" colspan="3"><h3><?php echo _ADMIN_HWDPS_SETT_MAINACCESS ?></h3></td></tr>
				  <tr>
					<td width="20%" align="left" valign="top"><b><?php echo _ADMIN_HWDPS_SETT_MAINCOMACCESS ?></b></td>
					<td width="20%" align="left" valign="top">
					<?php
					$gtree_core =  JHTML::_('select.genericlist', $gtree, 'gtree_core', 'size="4"', 'value', 'text', $c->gtree_core );
					echo $gtree_core;
					?>
					</td>
					<td width="60%" align="left" valign="top"><?php echo _ADMIN_HWDPS_SETT_MAINCOMACCESS_DESC ?></td>
				  </tr>
				  <tr>
					<td width="20%" align="left" valign="top"><b><?php echo _ADMIN_HWDPS_SETT_INCLUDECHILD ?></b></td>
					<td width="20%" align="left" valign="top">
					<select name="gtree_core_child" size="1" class="inputbox">
						<option value="RECURSE"<?php if ($c->gtree_core_child == "RECURSE") { ?> selected="selected"<?php } ?>><?php echo _ADMIN_HWDPS_SETT_YES.' '; ?></option>
						<option value="0"<?php if ($c->gtree_core_child == "0") { ?> selected="selected"<?php } ?>><?php echo _ADMIN_HWDPS_SETT_NO.' '; ?></option>
					</select>
					</td>
					<td width="60%" align="left" valign="top"><?php echo _ADMIN_HWDPS_SETT_INCLUDECHILD_DESC ?></td>
				  </tr>
				  <tr>
					<td width="20%" align="left" valign="top"><b><?php echo _ADMIN_HWDPS_SETT_UPLOADACCESS ?></b></td>
					<td width="20%" align="left" valign="top">
					<?php
					$gtree_upld =  JHTML::_('select.genericlist', $gtree, 'gtree_upld', 'size="4"', 'value', 'text', $c->gtree_upld );
					echo $gtree_upld;
					?>
					</td>
					<td width="60%" align="left" valign="top"><?php echo _ADMIN_HWDPS_SETT_UPLOADACCESS_DESC ?></td>
				  </tr>
				  <tr>
					<td width="20%" align="left" valign="top"><b><?php echo _ADMIN_HWDPS_SETT_INCLUDECHILD ?></b></td>
					<td width="20%" align="left" valign="top">
					<select name="gtree_upld_child" size="1" class="inputbox">
						<option value="RECURSE"<?php if ($c->gtree_upld_child == "RECURSE") { ?> selected="selected"<?php } ?>><?php echo _ADMIN_HWDPS_SETT_YES.' '; ?></option>
						<option value="0"<?php if ($c->gtree_upld_child == "0") { ?> selected="selected"<?php } ?>><?php echo _ADMIN_HWDPS_SETT_NO.' '; ?></option>
					</select>
					</td>
					<td width="60%" align="left" valign="top"><?php echo _ADMIN_HWDPS_SETT_INCLUDECHILD_DESC ?></td>
				  </tr>
				  <tr>
					<td width="20%" align="left" valign="top"><b><?php echo _ADMIN_HWDPS_SETT_ULDTC ?></b></td>
					<td width="20%" align="left" valign="top">
					<select name="upld_cats" size="1" class="inputbox">
						<option value="1"<?php if ($c->upld_cats == 1) { ?> selected="selected"<?php } ?>><?php echo _ADMIN_HWDPS_SETT_YES.' '; ?></option>
						<option value="0"<?php if ($c->upld_cats == 0) { ?> selected="selected"<?php } ?>><?php echo _ADMIN_HWDPS_SETT_NO.' '; ?></option>
					</select>
					</td>
					<td width="60%" align="left" valign="top"><?php echo _ADMIN_HWDPS_SETT_ULDTC_DESC ?></td>
				  </tr>
				  <!--<tr>
					<td width="20%" align="left" valign="top"><b><?php echo _ADMIN_HWDPS_SETT_PLAYERACCESS ?></b></td>
					<td width="20%" align="left" valign="top">
					<?php
					$gtree_plyr =  JHTML::_('select.genericlist', $gtree, 'gtree_plyr', 'size="4"', 'value', 'text', $c->gtree_plyr );
					echo $gtree_plyr;
					?>
					</td>
					<td width="60%" align="left" valign="top"><?php echo _ADMIN_HWDPS_SETT_PLAYERACCESS_DESC ?></td>
				  </tr>
				  <tr>
					<td width="20%" align="left" valign="top"><b><?php echo _ADMIN_HWDPS_SETT_INCLUDECHILD ?></b></td>
					<td width="20%" align="left" valign="top">
					<select name="gtree_plyr_child" size="1" class="inputbox">
						<option value="RECURSE"<?php if ($c->gtree_plyr_child == "RECURSE") { ?> selected="selected"<?php } ?>><?php echo _ADMIN_HWDPS_SETT_YES.' '; ?></option>
						<option value="0"<?php if ($c->gtree_plyr_child == "0") { ?> selected="selected"<?php } ?>><?php echo _ADMIN_HWDPS_SETT_NO.' '; ?></option>
					</select>
					</td>
					<td width="60%" align="left" valign="top"><?php echo _ADMIN_HWDPS_SETT_INCLUDECHILD_DESC ?></td>
				  </tr>
				  <tr>
					<td width="20%" align="left" valign="top"><b><?php echo _ADMIN_HWDPS_SETT_GROUPACCESS ?></b></td>
					<td width="20%" align="left" valign="top">
					<?php
					$gtree_grup =  JHTML::_('select.genericlist', $gtree, 'gtree_grup', 'size="4"', 'value', 'text', $c->gtree_grup );
					echo $gtree_grup;
					?>
					</td>
					<td width="60%" align="left" valign="top"><?php echo _ADMIN_HWDPS_SETT_GROUPACCESS_DESC ?></td>
				  </tr>
				  <tr>
					<td width="20%" align="left" valign="top"><b><?php echo _ADMIN_HWDPS_SETT_INCLUDECHILD ?></b></td>
					<td width="20%" align="left" valign="top">
					<select name="gtree_grup_child" size="1" class="inputbox">
						<option value="RECURSE"<?php if ($c->gtree_grup_child == "RECURSE") { ?> selected="selected"<?php } ?>><?php echo _ADMIN_HWDPS_SETT_YES.' '; ?></option>
						<option value="0"<?php if ($c->gtree_grup_child == "0") { ?> selected="selected"<?php } ?>><?php echo _ADMIN_HWDPS_SETT_NO.' '; ?></option>
					</select>
					</td>
					<td width="60%" align="left" valign="top"><?php echo _ADMIN_HWDPS_SETT_INCLUDECHILD_DESC ?></td>
				  </tr>-->
				</table>
			</div>
			<div id="levelaccess" <?php if ($c->access_method == 0 || $c->jaclint == 0) { ?> style="visibility: hidden; height: 0px;"<?php } ?>>
				<table cellpadding="0" cellspacing="0" border="0" width="95%" class="adminform">
				  <tr><td align="left" valign="top" colspan="3"><h3><?php echo _ADMIN_HWDPS_SETT_MAINACCESS ?></h3></td></tr>
				  <tr>
					<td width="20%" align="left" valign="top"><b><?php echo _ADMIN_HWDPS_SETT_MAINCOMACCESS ?></b></td>
					<td width="20%" align="left" valign="top">
					<?php
					$main_access = hwd_ps_tools::hwdpsMultiAccess( $c->accesslevel_main, 'accesslevel_main[]' );
					echo $main_access;
					?>
					</td>
					<td width="60%" align="left" valign="top"><?php echo _ADMIN_HWDPS_SETT_MAINCOMACCESS_DESC ?></td>
				  </tr>
				  <!--<tr>
					<td width="20%" align="left" valign="top"><b><?php echo _ADMIN_HWDPS_SETT_UPLOADACCESS ?></b></td>
					<td width="20%" align="left" valign="top">
					<?php
					$upld_access = hwd_ps_tools::hwdpsMultiAccess( $c->accesslevel_upld, 'accesslevel_upld[]' );
					echo $upld_access;
					?>
					</td>
					<td width="60%" align="left" valign="top"><?php echo _ADMIN_HWDPS_SETT_UPLOADACCESS_DESC ?></td>
				  </tr>
				  <tr>
					<td width="20%" align="left" valign="top"><b><?php echo _ADMIN_HWDPS_SETT_PLAYERACCESS ?></b></td>
					<td width="20%" align="left" valign="top">
					<?php
					$plyr_access = hwd_ps_tools::hwdpsMultiAccess( $c->accesslevel_plyr, 'accesslevel_plyr[]' );
					echo $plyr_access;
					?>
					</td>
					<td width="60%" align="left" valign="top"><?php echo _ADMIN_HWDPS_SETT_PLAYERACCESS_DESC ?></td>
				  </tr>
				  <tr>
					<td width="20%" align="left" valign="top"><b><?php echo _ADMIN_HWDPS_SETT_GROUPACCESS ?></b></td>
					<td width="20%" align="left" valign="top">
					<?php
					$grps_access = hwd_ps_tools::hwdpsMultiAccess( $c->accesslevel_grps, 'accesslevel_grps[]' );
					echo $grps_access;
					?>
					</td>
					<td width="60%" align="left" valign="top"><?php echo _ADMIN_HWDPS_SETT_GROUPACCESS_DESC ?></td>
				  </tr>-->
				</table>
			</div>
			</div>
			<?php
			echo $endtab;
			echo $endpane;
			?>
		</div>
		<input type="hidden" name="boxchecked" value="0" />
		<input type="hidden" name="option" value="com_hwdphotoshare" />
		<input type="hidden" name="task" value="generalsettings" />
		<input type="hidden" name="hidemainmenu" value="0">
		</form>
		<div style="clear:both;"></div>
		<?php
		/** display template **/
		$smartyps->display('admin_footer.tpl');
	}
}
?>