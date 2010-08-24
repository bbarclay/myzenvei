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

class hwdps_BE_maintenance
{
   /**
	* system cleanup
	*/
	function maintenance()
	{
		global $database, $mainframe, $limit, $limitstart;
  		$db =& JFactory::getDBO();

		// set fixerror cache variables
		$cachedir = JPATH_SITE.'/administrator/cache/'; // Directory to cache files in (keep outside web root)
		$cacheext = 'cache'; // Extension to give cached files (usually cache, htm, txt)
		$page = 'http://hwdpsfixerrorfile'; // Requested page
		$cachefile = $cachedir . md5($page) . '.' . $cacheext; // Cache file to either load or create
		$fixerror_cache = (@file_exists($cachefile)) ? @date ("F d Y H:i:s.", filemtime($cachefile)) : "Never";

		// set recount cache variables
		$cachedir = JPATH_SITE.'/administrator/cache/'; // Directory to cache files in (keep outside web root)
		$cacheext = 'cache'; // Extension to give cached files (usually cache, htm, txt)
		$page = 'http://hwdpsrecountfile'; // Requested page
		$cachefile = $cachedir . md5($page) . '.' . $cacheext; // Cache file to either load or create
		$recount_cache = (@file_exists($cachefile)) ? @date ("F d Y H:i:s.", filemtime($cachefile)) : "Never";

		// set archive cache variables
		$cachedir = JPATH_SITE.'/administrator/cache/'; // Directory to cache files in (keep outside web root)
		$cacheext = 'cache'; // Extension to give cached files (usually cache, htm, txt)
		$page = 'http://hwdpsarchivefile'; // Requested page
		$cachefile = $cachedir . md5($page) . '.' . $cacheext; // Cache file to either load or create
		$archive_cache = (@file_exists($cachefile)) ? @date ("F d Y H:i:s.", filemtime($cachefile)) : "Never";

		hwd_ps_HTML::maintenance($fixerror_cache, $recount_cache, $archive_cache);
	}
   /**
	* system cleanup
	*/
	function runmaintenance()
	{
		global $database, $mainframe, $limit, $limitstart;

		$run_permdel = JRequest::getInt( 'run_permdel', 0 );
		$run_fixerrors = JRequest::getInt( 'run_fixerrors', 0 );
		$run_recount = JRequest::getInt( 'run_recount', 0 );
		$run_archivelogs = JRequest::getInt( 'run_archivelogs', 0 );

		if ($run_fixerrors !== 0) {
			require_once(JPATH_SITE.DS.'administrator'.DS.'components'.DS.'com_hwdphotoshare'.DS.'libraries'.DS.'maintenance_fixerrors.class.php');
			$fixerrors_report = hwd_ps_fixerrors::initiate($run_fixerrors);
		}

		if ($run_recount !== 0) {
			require_once(JPATH_SITE.DS.'administrator'.DS.'components'.DS.'com_hwdphotoshare'.DS.'libraries'.DS.'maintenance_recount.class.php');
			$recount_report = hwd_ps_recount::initiate($run_recount);
		}

		if ($run_archivelogs !== 0) {
			require_once(JPATH_SITE.DS.'administrator'.DS.'components'.DS.'com_hwdphotoshare'.DS.'libraries'.DS.'maintenance_archivelogs.class.php');
			$archivelogs_report = hwd_ps_logs::initiate($run_archivelogs);
		}

		// set fixerror cache variables
		$cachedir = JPATH_SITE.'/administrator/cache/'; // Directory to cache files in (keep outside web root)
		$cacheext = 'cache'; // Extension to give cached files (usually cache, htm, txt)
		$page = 'http://hwdpsfixerrorfile'; // Requested page
		$cachefile = $cachedir . md5($page) . '.' . $cacheext; // Cache file to either load or create
		$fixerror_cache = (@file_exists($cachefile)) ? @date ("F d Y H:i:s.", filemtime($cachefile)) : "Never";

		// set recount cache variables
		$cachedir = JPATH_SITE.'/administrator/cache/'; // Directory to cache files in (keep outside web root)
		$cacheext = 'cache'; // Extension to give cached files (usually cache, htm, txt)
		$page = 'http://hwdpsrecountfile'; // Requested page
		$cachefile = $cachedir . md5($page) . '.' . $cacheext; // Cache file to either load or create
		$recount_cache = (@file_exists($cachefile)) ? @date ("F d Y H:i:s.", filemtime($cachefile)) : "Never";

		// set archive cache variables
		$cachedir = JPATH_SITE.'/administrator/cache/'; // Directory to cache files in (keep outside web root)
		$cacheext = 'cache'; // Extension to give cached files (usually cache, htm, txt)
		$page = 'http://hwdpsarchivefile'; // Requested page
		$cachefile = $cachedir . md5($page) . '.' . $cacheext; // Cache file to either load or create
		$archive_cache = (@file_exists($cachefile)) ? @date ("F d Y H:i:s.", filemtime($cachefile)) : "Never";

		hwd_ps_HTML::maintenance($fixerror_cache, $recount_cache, $archive_cache);
	}
   /**
	* system cleanup
	*/
	function clearTemplateCache()
	{
		global $smartyps;
		$c = hwd_ps_Config::get_instance();

		$smartyps->clear_compiled_tpl();

		$vs_temp_cache = JPATH_SITE.'/cache/hwdps'.$c->hwdvids_template_file;
		$smartyps->compile_dir = $vs_temp_cache;
		$smartyps->clear_compiled_tpl();

		echo "Template Cache Successfully Cleared";
		exit;
	}


}
?>
