<?php
/**
 *    @version [ Dannevirke ]
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
class hwdvsDrawConfig {

	function general()
		{
		global $database;
		$db =& JFactory::getDBO();

		$configfile = JPATH_SITE.DS.'administrator'.DS.'components'.DS.'com_hwdvideoshare'.DS.'config.hwdvideoshare.php';
		@chmod ($configfile, 0777);
		$permission = is_writable($configfile);
		if (!$permission) {
			return false;
		}

		$config = "<?php\n";
		$config .= "class hwd_vs_Config{ \n\n";
		$config .= "  // Stores the only allowable instance of this class.\n";
		$config .= "  var \$instanceConfig = null;\n\n";
		$config .= "  // Member variables\n";
		// print out config
		$query  = 'SELECT *'
				. ' FROM #__hwdvidsgs'
				;
		$db->setQuery($query);
		$rows = $db->loadObjectList();
		for ($i=0, $n=count($rows); $i < $n; $i++) {
			$row = $rows[$i];
			if ($row->setting == "flvplay_width" && empty($row->value)) { $row->value = "450"; }
			if ($row->setting == "customencode") { $row->value = addslashes($row->value); }
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
		$config .= "    \$instanceConfig = new hwd_vs_Config;\n";
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

	function server()
		{
		global $database;
		$db =& JFactory::getDBO();

		$configfile = JPATH_SITE.DS.'administrator'.DS.'components'.DS.'com_hwdvideoshare'.DS.'serverconfig.hwdvideoshare.php';
		@chmod ($configfile, 0777);
		$permission = is_writable($configfile);
		if (!$permission) {
			return false;
		}

		$config = "<?php\n";
		$config .= "class hwd_vs_SConfig{ \n\n";
		$config .= "  // Stores the only allowable instance of this class.\n";
		$config .= "  var \$instanceConfig = null;\n\n";
		$config .= "  // Member variables\n";
		// print out config
		$query  = 'SELECT *'
				. ' FROM #__hwdvidsss'
				;
		$db->setQuery($query);
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
		$config .= "    \$instanceConfig = new hwd_vs_SConfig;\n";
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