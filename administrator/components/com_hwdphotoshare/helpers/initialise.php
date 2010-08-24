<?php
/**
 *    @version 2.1.3 Build 21301 Alpha [ Plimmerton ]
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
 * Process character encoding
 * @package    hwdVideoShare
 * @author     Dave Horsfall <info@highwooddesign.co.uk>
 * @copyright  2008 Highwood Design
 * @license    http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @version    1.1.3
 */
class hwdpsInitialise {

    function coreRequire()
    {
		require_once(JPATH_SITE.DS.'administrator'.DS.'components'.DS.'com_hwdphotoshare'.DS.'config.hwdphotoshare.php');
		require_once(JPATH_SITE.DS.'administrator'.DS.'components'.DS.'com_hwdphotoshare'.DS.'helpers'.DS.'access.php');
		require_once(JPATH_SITE.DS.'administrator'.DS.'components'.DS.'com_hwdphotoshare'.DS.'helpers'.DS.'initialise.php');
		require_once(JPATH_SITE.DS.'administrator'.DS.'components'.DS.'com_hwdphotoshare'.DS.'helpers'.DS.'carousel.php');
		require_once(JPATH_SITE.DS.'components'.DS.'com_hwdphotoshare'.DS.'hwdphotoshare.class.php');
    }

    function language($type='fe')
    {
		global $mainframe;
        $c = hwd_ps_Config::get_instance();

		if ($c->hwdvids_language_path == "joomfish" && file_exists(JPATH_SITE.DS.'components'.DS.'com_hwdphotoshare'.DS.'languages'.DS.$mainframe->getCfg('language').'.'.$type.'.php')) {

			include_once(JPATH_SITE.DS.'components'.DS.'com_hwdphotoshare'.DS.'languages'.DS.$mainframe->getCfg('language').'.'.$type.'.php');

		} else if (file_exists(JPATH_PLUGINS.DS.$c->hwdvids_language_path.DS.$c->hwdvids_language_file.'.'.$type.'.php')) {

			include_once(JPATH_PLUGINS.DS.$c->hwdvids_language_path.DS.$c->hwdvids_language_file.'.'.$type.'.php');

		} else {

			require_once(JPATH_PLUGINS.DS.'hwdps-language'.DS.'english.'.$type.'.php');

		}

    }

    function template($fe=true)
    {
		global $mainframe, $option, $smartyps;
        $c = hwd_ps_Config::get_instance();

		// setup template system
		if (!class_exists('smarty')) {

			require_once(JPATH_SITE.DS.'administrator'.DS.'components'.DS.'com_hwdphotoshare'.DS.'libraries'.DS.'smarty'.DS.'Smarty.class.php');

		}

		$smartyps = new Smarty;

		if (!$fe) {

			$smartyps->template_dir = JPATH_SITE.DS.'administrator'.DS.'components'.DS.'com_hwdphotoshare'.DS.'templates';
			$ps_temp_cache = JPATH_SITE.DS.'administrator'.DS.'cache'.DS.'hwdps';
			require_once(JPATH_SITE.DS.'administrator'.DS.'components'.DS.'com_hwdphotoshare'.DS.'helpers'.DS.'templates.php');
			hwd_ps_templates::backend();

		} else {

			$template_folder = $mainframe->getUserState( "com_hwdphotoshare.template_folder", '' );
			$template_element = $mainframe->getUserState( "com_hwdphotoshare.template_element", '' );

			if (!empty($template_folder) && !empty($template_element)) {

				$c->hwdvids_template_path = $template_folder;
				$c->hwdvids_template_file = $template_element;

			}

			if (file_exists(JPATH_PLUGINS.DS.$c->hwdvids_template_path.DS.$c->hwdvids_template_file.DS.'templates'.DS.'index.tpl')) {

				$smartyps->template_dir = JPATH_PLUGINS.DS.$c->hwdvids_template_path.DS.$c->hwdvids_template_file.DS.'templates';

			} else {

				$smartyps->template_dir = JPATH_PLUGINS.DS.'hwdps-template'.DS.'default'.DS.'templates';

			}

			$ps_temp_cache = JPATH_SITE.DS.'cache'.DS.'hwdps'.$c->hwdvids_template_file;
			require_once(JPATH_SITE.DS.'administrator'.DS.'components'.DS.'com_hwdphotoshare'.DS.'helpers'.DS.'templates.php');
			hwd_ps_templates::frontend();

		}

		@mkdir($ps_temp_cache, 0777);

		if (!file_exists($ps_temp_cache) || !is_writable($ps_temp_cache)) {
			echo "<div style=\"border:2px solid #c30;margin: 0 0 5px 0;padding:5px;text-align:left;\">hwdPhotoShare can not load until the following directory has been made writeable:<br />".$ps_temp_cache."</div>";
			echo "<div style=\"border:2px solid #c30;margin: 0 0 5px 0;padding:5px;text-align:left;\">Ensure all your <a href=\"index.php?option=com_admin&task=sysinfo\">Joomla Cache Directory Permissions</a> are writeable before attempting to use hwdPhotoShare</div>";
			return false;
		}

		$smartyps->compile_check = true;
		$smartyps->debugging = false;
		$smartyps->compile_dir = $ps_temp_cache;
		$smartyps->cache_dir = $ps_temp_cache;
		$smartyps->config_dir = $ps_temp_cache;
		//$smartyps->clear_compiled_tpl();

		$template_folder = $mainframe->getUserState( "com_hwdphotoshare.template_folder", '' );
		$template_element = $mainframe->getUserState( "com_hwdphotoshare.template_element", '' );

		if (!empty($template_folder) && !empty($template_element)) {

			$c->hwdvids_template_path = $template_folder;
			$c->hwdvids_template_file = $template_element;

		}

		if (file_exists(JPATH_PLUGINS.DS.$c->hwdvids_template_path.DS.$c->hwdvids_template_file.'.php')) {

			$template_css = include_once(JPATH_PLUGINS.DS.$c->hwdvids_template_path.DS.$c->hwdvids_template_file.'.php');

		} else if (file_exists(JPATH_PLUGINS.DS.'hwdps-template'.DS.'default.php')) {

			$template_css = include_once(JPATH_PLUGINS.DS.'hwdps-template'.DS.'default.php');

		} else {

			echo "die - failed to load template";
			exit;

		}

		return true;

	}

    function itemid($set=true)
    {
		global $Itemid;
  		$db = & JFactory::getDBO();

		$db->SetQuery( 'SELECT count(*) FROM #__menu WHERE id = '.$Itemid.' AND link LIKE "%com_hwdphotoshare%"');
		$total = $db->loadResult();

		if ($total == '0') {

			$query = "SELECT id FROM #__menu WHERE link LIKE '%com_hwdphotoshare%' LIMIT 0, 1";
			$db->SetQuery($query);
			$row = $db->loadResult();

			if (!empty($row)) {
				if ($set) {
					$Itemid = $row;
					return;
				} else {
					return $row;
				}
			}

		}

		return $Itemid;

    }

    function definitions()
    {
		global $mainframe, $option, $smartyps;
        $c = hwd_ps_Config::get_instance();

		defined('_HWD_PS_PLUGIN_COMPS') ? null : define('_HWD_PS_PLUGIN_COMPS', 212);

		$template_folder = $mainframe->getUserState( "com_hwdphotoshare.template_folder", '' );
		$template_element = $mainframe->getUserState( "com_hwdphotoshare.template_element", '' );

		if (!empty($template_folder) && !empty($template_element)) {

			$c->hwdvids_template_path = $template_folder;
			$c->hwdvids_template_file = $template_element;

		}

		if (file_exists(JPATH_PLUGINS.DS.$c->hwdvids_template_path.DS.$c->hwdvids_template_file.DS.'images'.DS.'core'.DS)) {

			defined('URL_HWDPS_IMAGES') ? null : define('URL_HWDPS_IMAGES', JURI::root( true ).DS.$c->hwdvids_template_path.DS.$c->hwdvids_template_file.DS.'images'.DS.'core'.DS);
			defined('PATH_HWDPS_IMAGES') ? null : define('PATH_HWDPS_IMAGES', JPATH_SITE.DS.$c->hwdvids_template_path.DS.$c->hwdvids_template_file.DS.'images'.DS.'core'.DS);

		} else {

			defined('URL_HWDPS_IMAGES') ? null : define('URL_HWDPS_IMAGES', JURI::root( true ).'/components/com_hwdphotoshare/assets/images/');
			defined('PATH_HWDPS_IMAGES') ? null : define('PATH_HWDPS_IMAGES', JPATH_SITE.DS.'components'.DS.'com_hwdphotoshare'.DS.'assets'.DS.'images'.DS);

		}
		$smartyps->assign("URL_HWDPS_IMAGES", URL_HWDPS_IMAGES);
    }

    function mysqlQuery()
    {
		global $hwdps_joinp, $hwdps_joina, $hwdps_joing, $hwdps_selectp, $hwdps_selecta, $hwdps_selectg;
        $c = hwd_ps_Config::get_instance();

		// set core sql variables
		$hwdps_joinp = ' LEFT JOIN #__users AS u ON u.id = photo.user_id';
		$hwdps_joina = ' LEFT JOIN #__users AS u ON u.id = album.user_id';
		$hwdps_joing = ' LEFT JOIN #__users AS u ON u.id = group.adminid';
		$hwdps_selectp = ' photo.*, u.name, u.username';
		$hwdps_selecta = ' album.*, u.name, u.username';
		$hwdps_selectg = ' group.*, u.name, u.username';
		if ($c->cbint == 2) {
			$hwdps_joinp.= ' LEFT JOIN #__community_users AS p ON p.userid = photo.user_id';
			$hwdps_joina.= ' LEFT JOIN #__community_users AS p ON p.userid = album.user_id';
			$hwdps_joing.= ' LEFT JOIN #__community_users AS p ON p.userid = group.adminid';
			$hwdps_selectp.= ', p.avatar';
			$hwdps_selecta.= ', p.avatar';
			$hwdps_selectg.= ', p.avatar';
		} else if ($c->cbint == 1) {
			$hwdps_joinp.= ' LEFT JOIN #__comprofiler AS p ON p.id = photo.user_id';
			$hwdps_joina.= ' LEFT JOIN #__comprofiler AS p ON p.id = album.user_id';
			$hwdps_joing.= ' LEFT JOIN #__comprofiler AS p ON p.id = group.adminid';
			$hwdps_selectp.= ', p.avatar';
			$hwdps_selecta.= ', p.avatar';
			$hwdps_selectg.= ', p.avatar';
		}

    }

    function revenueManager()
    {
		$revenue_manager = JPATH_SITE.DS.'components'.DS.'com_hwdrevenuemanager';

		if (file_exists($revenue_manager)) {

			require_once(JPATH_SITE.DS.'administrator'.DS.'components'.DS.'com_hwdphotoshare'.DS.'helpers'.DS.'adverts.php');

		}
    }

    function background()
    {
		global $mainframe;
        $c = hwd_ps_Config::get_instance();
    }

	function initialiseSetup()
	{
		global $mainframe;
		$db =& JFactory::getDBO();

		$cats    		= JRequest::getInt( 'cats', 0, 'post' );

		if ($cats == 1) {
			$db->setQuery( 'INSERT IGNORE INTO `#__hwdpscategories` (`id`, `parent`, `category_name`, `category_description`, `date`, `access_b_v`, `access_u_r`, `access_v_r`, `access_u`, `access_v`, `ordering`, `num_albums`, `num_subcats`, `checked_out`, `checked_out_time`, `published`)'
								.'VALUES (1, 0, \'Abstract\', \'Shape, Light/Shade, Movement, Mist, Reflection and Mirror, Fire/Flame, Graffiti, Loop/Spring, Smoke, Sign/Symbol\', \'0000-00-00 00:00:00\', 0, \'RECURSE\', \'RECURSE\', -2, -2, 4, 0, 0, 0, \'0000-00-00 00:00:00\', 1),'
								.'(2, 0, \'Architecture\', \'Old Construction, Small construction, Religious Edifice, Urban Building, Industrial Building, Trade Building, Private Construction, Public Construction, Monument, Infrastructure\', \'0000-00-00 00:00:00\', 0, \'RECURSE\', \'RECURSE\', -2, -2, 5, 0, 0, 0, \'0000-00-00 00:00:00\', 1),'
								.'(3, 0, \'Background & Texture\', \'Materials, Texture, Raw Material, Background\', \'0000-00-00 00:00:00\', 0, \'RECURSE\', \'RECURSE\', -2, -2, 10, 0, 0, 0, \'0000-00-00 00:00:00\', 1),'
								.'(4, 0, \'Fauna &amp; Flora\', \'Animal, Flora\', \'0000-00-00 00:00:00\', 0, \'RECURSE\', \'RECURSE\', -2, -2, 1, 0, 0, 0, \'0000-00-00 00:00:00\', 1),'
								.'(5, 0, \'Film &amp; Animation\', \'Short Films, Stop-motion &amp; Animation\', \'0000-00-00 00:00:00\', 0, \'RECURSE\', \'RECURSE\', -2, -2, 3, 0, 0, 0, \'0000-00-00 00:00:00\', 1),'
								.'(6, 0, \'Food &amp; Drink\', \'Drinks, Food, Situation\', \'0000-00-00 00:00:00\', 0, \'RECURSE\', \'RECURSE\', -2, -2, 2, 0, 0, 0, \'0000-00-00 00:00:00\', 1),'
								.'(7, 0, \'Landscape\', \'City, Village, Countryside, Mountain, Island, Desert, Water, Sky, Submarine landscape, Wild landscape, Natural disaster, Bird&#39;s Eye View\', \'0000-00-00 00:00:00\', 0, \'RECURSE\', \'RECURSE\', -2, -2, 0, 0, 0, 0, \'0000-00-00 00:00:00\', 1),'
								.'(8, 0, \'Objects\', \'Objects of Art, Hygiene Health, Jewelry and clock, Dishes and Glass, Computer, Games / Leisure / Sport, Printed support, House, Tool and Utensil, Music, Electronics, Apparel/Fabric, Mechanics-Optics, Electric material, Contents\', \'0000-00-00 00:00:00\', 0, \'RECURSE\', \'RECURSE\', -2, -2, 6, 0, 0, 0, \'0000-00-00 00:00:00\', 1),'
								.'(9, 0, \'Other\', \'3D images, Retro, Photography Technique, Calendar, Frame, Button, Icon\', \'0000-00-00 00:00:00\', 0, \'RECURSE\', \'RECURSE\', -2, -2, 8, 0, 0, 0, \'0000-00-00 00:00:00\', 1),'
								.'(10, 0, \'People\', \'Out of Situation, In Situation, In Action, Part of Body, In Uniform\', \'0000-00-00 00:00:00\', 0, \'RECURSE\', \'RECURSE\', -2, -2, 9, 0, 0, 0, \'0000-00-00 00:00:00\', 1),'
								.'(11, 0, \'Sport &amp; Leisure\', \'Sport, Leisure\', \'0000-00-00 00:00:00\', 0, \'RECURSE\', \'RECURSE\', -2, -2, 7, 0, 0, 0, \'0000-00-00 00:00:00\', 1),'
								.'(12, 0, \'Transport\', \'By Road, Aerial Transport, Urban, Nautical and river, Railway, Spatial\', \'0000-00-00 00:00:00\', 0, \'RECURSE\', \'RECURSE\', -2, -2, 10, 0, 0, 0, \'0000-00-00 00:00:00\', 1);'
								);
			if ( !$db->query() ) {
				echo "<script> alert('".$db->getErrorMsg()."'); window.history.go(-1); </script>\n";
				exit();
			}
		}

		$db->SetQuery("UPDATE #__hwdpsgs SET value = 0 WHERE setting = \"initialise_now\"");
		if ( !$db->query() ) {
			echo "<script> alert('".$db->getErrorMsg()."'); window.history.go(-1); </script>\n";
			exit();
		}

		require_once(JPATH_SITE.DS.'administrator'.DS.'components'.DS.'com_hwdphotoshare'.DS.'helpers'.DS.'draw.php');
		hwdpsDrawFile::generalConfig();

		$mainframe->enqueueMessage('Setup Completed! Please run the maintenance tools before proceeding.');
		$mainframe->redirect( JURI::root( true ) . '/administrator/index.php?option=com_hwdphotoshare&task=maintenance' );
	}
}
?>