<?php
/**
 *    @version [ Accetto ]
 *    @package hwdVideoShare
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

/**
 * ACL functions: original code from com_comprofiler
 *
 * @package    hwdVideoShare
 * @author     Dave Horsfall <info@highwooddesign.co.uk>
 * @copyright  2008 Highwood Design
 * @license    http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @version    1.1.4 Alpha RC2.13
 */
class hwd_ps_templates
{
    /**
     * Grants or prevents access based on group id
     *
     * @param int    $accessgroupid  the group id to check against
     * @param string $recurse  the switch for recursive access check
     * @param int    $usersgroupid  the user's group id
     * @return       True or false
     */
	function frontend()
	{

global $smartyps, $Itemid;
$my = & JFactory::getUser();
$c           = hwd_ps_Config::get_instance();

$smartyps->assign("Itemid", $Itemid);
$smartyps->assign("mosConfig_live_site", JURI::root(true));
$smartyps->assign("mosConfig_absolute_path", JPATH_SITE);
$smartyps->assign("JURL", JURI::root(true));
$smartyps->assign("JPATH", JPATH_SITE);

$smartyps->assign("form_search", JURI::root(true)."/index.php?option=com_hwdphotoshare&Itemid=".$Itemid."&task=search");
$smartyps->assign("searchinput", "<input type=\"text\" name=\"pattern\" value=\""._HWDPS_SEARCHBAR."\" class=\"inputbox\" onchange=\"document.adminForm.submit();\"  onblur=\"if(this.value=='') this.value='"._HWDPS_SEARCHBAR."';\" onfocus=\"if(this.value=='"._HWDPS_SEARCHBAR."') this.value='';\"/>");

// define important links
$smartyps->assign("link_home", JURI::root(true));
$smartyps->assign("link_home_hwd_ps", JURI::root(true)."/index.php?option=com_hwdphotoshare&Itemid=".$Itemid);

if ($c->disable_nav_explor == 0 || $c->disable_nav_groups == 0 || $c->disable_nav_upload == 0) { $smartyps->assign("print_nav", 1); }
if ($c->disable_nav_search == 0) { $smartyps->assign("print_search", 1); }
if ($my->id && $c->disable_nav_user == 0 && ($c->disable_nav_user1 == 0 || $c->disable_nav_user2 == 0 || $c->disable_nav_user3 == 0 || $c->disable_nav_user4 == 0 || $c->disable_nav_user5 == 0)) { $smartyps->assign("print_usernav", 1); }

if ($c->disable_nav_explor == 0)     { $smartyps->assign("print_elink", 1); $smartyps->assign("elink", "<a href=\"".JRoute::_("index.php?option=com_hwdphotoshare&Itemid=".$Itemid."&task=frontpage")."\">"._HWDPS_NAV_EXPLORE."</a>"); }
if ($c->disable_nav_catego == 0)     { $smartyps->assign("print_clink", 1); $smartyps->assign("clink", "<a href=\"".JRoute::_("index.php?option=com_hwdphotoshare&Itemid=".$Itemid."&task=categories")."\">"._HWDPS_NAV_CATEGORIES."</a>"); }
if ($c->disable_nav_groups == 0)     { $smartyps->assign("print_glink", 1); $smartyps->assign("glink", "<a href=\"".JRoute::_("index.php?option=com_hwdphotoshare&Itemid=".$Itemid."&task=groups")."\">"._HWDPS_NAV_GROUPS."</a>"); }
if ($c->disable_nav_upload == 0)     { $smartyps->assign("print_ulink", 1); $smartyps->assign("ulink", "<a href=\"".JRoute::_("index.php?option=com_hwdphotoshare&Itemid=".$Itemid."&task=upload")."\">"._HWDPS_NAV_UPLOAD."</a>"); }
if ($c->disable_nav_user1 == 0) { $smartyps->assign("yp", "<a href=\"".JRoute::_("index.php?option=com_hwdphotoshare&Itemid=".$Itemid."&task=yourphotos")."\">"._HWDPS_NAV_YOURPHOTOS."</a>"); }
if ($c->disable_nav_user2 == 0) { $smartyps->assign("yf", "<a href=\"".JRoute::_("index.php?option=com_hwdphotoshare&Itemid=".$Itemid."&task=yourfavourites")."\">"._HWDPS_NAV_YOURFAVS."</a>"); }
if ($c->disable_nav_user3 == 0) { $smartyps->assign("yg", "<a href=\"".JRoute::_("index.php?option=com_hwdphotoshare&Itemid=".$Itemid."&task=yourgroups")."\">"._HWDPS_NAV_YOURGROUPS."</a>"); }
if ($c->disable_nav_user4 == 0) { $smartyps->assign("ym", "<a href=\"".JRoute::_("index.php?option=com_hwdphotoshare&Itemid=".$Itemid."&task=yourmemberships")."\">"._HWDPS_NAV_YOURMEMBERSHIPS."</a>"); }
if ($c->disable_nav_user5 == 0) { $smartyps->assign("cg", "<a href=\"".JRoute::_("index.php?option=com_hwdphotoshare&Itemid=".$Itemid."&task=creategroup")."\">"._HWDPS_NAV_CREATEGROUP."</a>"); }
if ($c->showcredit == 1) { $smartyps->assign("sc", "1"); $smartyps->assign("cl", _HWDPS_PB." <a href=\"http://hwdmediashare.co.uk\" target=\"_blank\">hwdPhotoShare</a>"); }

$smartyps->assign("help_link", "<a href=\"http://documentation.hwdmediashare.co.uk/wiki/Category:hwdphotoshare_User%27s_Manual\" target=\"_blank\">Help</a>");
$smartyps->assign("personalise_link", "<a href=\"http://documentation.hwdmediashare.co.uk/wiki/Category:hwdphotoshare_User%27s_Manual\">Personalise</a>");


				$smartyps->assign("usershare1", $c->usershare1);
				$smartyps->assign("usershare2", $c->usershare2);
				$smartyps->assign("usershare3", $c->usershare3);
				$smartyps->assign("usershare4", $c->usershare4);

				if ($c->usershare1 == 1 || $c->usershare2 == 1 || $c->usershare3 == 1 || $c->usershare4 == 1) {
					$smartyps->assign("print_sharing", 1);
				}

				if ($c->shareoption1 == 0) {
					$smartyps->assign("so1p", "");
					$smartyps->assign("so1r", " selected=\"selected\"");
					$smartyps->assign("so1value", "registered");
				} else if ($c->shareoption1 == 1) {
					$smartyps->assign("so1p", " selected=\"selected\"");
					$smartyps->assign("so1r", "");
					$smartyps->assign("so1value", "public");
				}
				if ($c->shareoption2 == 0) {
					$smartyps->assign("so21", "");
					$smartyps->assign("so20", " selected=\"selected\"");
					$smartyps->assign("so2value", "0");
				} else if ($c->shareoption2 == 1) {
					$smartyps->assign("so21", " selected=\"selected\"");
					$smartyps->assign("so20", "");
					$smartyps->assign("so2value", "1");
				}
				if ($c->shareoption3 == 0) {
					$smartyps->assign("so31", "");
					$smartyps->assign("so30", " selected=\"selected\"");
					$smartyps->assign("so3value", "0");
				} else if ($c->shareoption3 == 1) {
					$smartyps->assign("so31", " selected=\"selected\"");
					$smartyps->assign("so30", "");
					$smartyps->assign("so3value", "1");
				}
				if ($c->shareoption4 == 0) {
					$smartyps->assign("so41", "");
					$smartyps->assign("so40", " selected=\"selected\"");
					$smartyps->assign("so4value", "0");
				} else if ($c->shareoption4 == 1) {
					$smartyps->assign("so41", " selected=\"selected\"");
					$smartyps->assign("so40", "");
					$smartyps->assign("so4value", "1");
				}

$categoryselectlist = hwd_ps_tools::categoryList(_HWDPS_SELECT_SELECTCATEGORY, 0, _HWDPS_SELECT_NOCATS, 1);
$smartyps->assign("categoryselect", $categoryselectlist);

$smartyps->assign("ppr", $c->ppr);
$smartyps->assign("apr", $c->apr);
$smartyps->assign("rss_recent", JRoute::_("index.php?Itemid=".$Itemid."&option=com_hwdphotoshare&task=rss&feed=recent"));

	}
    /**
     * Grants or prevents access based on group id
     *
     * @param int    $accessgroupid  the group id to check against
     * @param string $recurse  the switch for recursive access check
     * @param int    $usersgroupid  the user's group id
     * @return       True or false
     */
	function backend()
	{
global $smartyps;

		$c = hwd_ps_Config::get_instance();
		$db = & JFactory::getDBO();
		$my = & JFactory::getUser();
		$acl= & JFactory::getACL();
		$usersConfig = &JComponentHelper::getParams( 'com_users' );

$smartyps->assign("backEndCopyright", hwd_ps_templates::copyright());
$smartyps->assign("mosConfig_live_site", JURI::root(true));
$smartyps->assign("mosConfig_absolute_path", JPATH_SITE);
$smartyps->assign("usershare1", $c->usershare1);
$smartyps->assign("usershare2", $c->usershare2);
$smartyps->assign("usershare3", $c->usershare3);
$smartyps->assign("usershare4", $c->usershare4);


$hidemainmenu 		= JRequest::getInt( 'hidemainmenu', 0 );
if ($hidemainmenu == 1) {
	$smartyps->assign("hidemainmenu", 1);
} else {
	$smartyps->assign("hidemainmenu", 0);
}





$categoryselectlist = hwd_ps_tools::categoryList(_HWDPS_SELECT_SELECTCATEGORY, 0, _HWDPS_SELECT_NOCATS, 1);
$smartyps->assign("categoryselect", $categoryselectlist);

if ($c->usershare1 == 1 || $c->usershare2 == 1 || $c->usershare3 == 1 || $c->usershare4 == 1) {
	$smartyps->assign("print_sharing", 1);
}

if ($c->shareoption1 == 0) {
	$smartyps->assign("so1p", "");
	$smartyps->assign("so1r", " selected=\"selected\"");
	$smartyps->assign("so1value", "registered");
} else if ($c->shareoption1 == 1) {
	$smartyps->assign("so1p", " selected=\"selected\"");
	$smartyps->assign("so1r", "");
	$smartyps->assign("so1value", "public");
}
if ($c->shareoption2 == 0) {
	$smartyps->assign("so21", "");
	$smartyps->assign("so20", " selected=\"selected\"");
	$smartyps->assign("so2value", "0");
} else if ($c->shareoption2 == 1) {
	$smartyps->assign("so21", " selected=\"selected\"");
	$smartyps->assign("so20", "");
	$smartyps->assign("so2value", "1");
}
if ($c->shareoption3 == 0) {
	$smartyps->assign("so31", "");
	$smartyps->assign("so30", " selected=\"selected\"");
	$smartyps->assign("so3value", "0");
} else if ($c->shareoption3 == 1) {
	$smartyps->assign("so31", " selected=\"selected\"");
	$smartyps->assign("so30", "");
	$smartyps->assign("so3value", "1");
}
if ($c->shareoption4 == 0) {
	$smartyps->assign("so41", "");
	$smartyps->assign("so40", " selected=\"selected\"");
	$smartyps->assign("so4value", "0");
} else if ($c->shareoption4 == 1) {
	$smartyps->assign("so41", " selected=\"selected\"");
	$smartyps->assign("so40", "");
	$smartyps->assign("so4value", "1");
}
	}
	function copyright()
	{
		include_once(JPATH_SITE.DS.'administrator'.DS.'components'.DS.'com_hwdphotoshare'.DS.'version.php');
		$version = new hwdPhotoShareVersion();
		$LongVersion = $version->getLongVersion();
		return "<div>".$LongVersion."<br />hwdMediaShare is created by <a href=\"http://hwdmediashare.co.uk\" target=\"_blank\">Highwood Design</a></div>";
	}
}
?>