<?php
/**
 *    @version [ Cape ]
 *    @package hwdRevenueManager
 *    @copyright (C) 2007 - 2009 Highwood Design
 *    @license Creative Commons Attribution-Non-Commercial-No Derivative Works 3.0 Unported Licence
 *    @license http://creativecommons.org/licenses/by-nc-nd/3.0/
 */
defined( '_JEXEC' ) or die( 'Direct Access to this location is not allowed.' );

function com_install()
{
	global $mainframe, $option;
	$db =& JFactory::getDBO();

	$mainframe->addCustomHeadTag('<link rel="stylesheet" href="'.JURI::root( true ).'/administrator/components/com_hwdrevenuemanager/assets/css/installer.css" type="text/css" />');

	?>
	<div class="installer_logo_box"><img src="../administrator/components/com_hwdrevenuemanager/images/logo.png" border="0" alt="hwdRevenueManager" title="hwdRevenueManager" /></div>

	<div class="installer_box">
		<h2>hwdRevenueManager [ Cape ]</h2>
        <p>An open source revenue manager for hwdVideoShare and hwdPhotoShare by <a href="http://joomla.highwooddesign.co.uk" target="_blank">Highwood Design</a>.<br />
		See the component homepage for more details after installation.</p>
	</div>

	<div class="installer_box">
		<h3>Menu Configuration</h3>
		<?php
		$section_check=true;

		# Set up new icons for admin menu
		$db->setQuery("UPDATE #__components SET admin_menu_img='../administrator/components/com_hwdrevenuemanager/images/hwdrevenuemanager.png' WHERE admin_menu_link='option=com_hwdrevenuemanager'");
		$iconresult[0] = $db->query();
		$db->setQuery("UPDATE #__components SET admin_menu_img='../administrator/components/com_hwdrevenuemanager/images/hwdvideoshare.png' WHERE admin_menu_link='option=com_hwdrevenuemanager&task=hwdvideoshare'");
		$iconresult[1] = $db->query();
		$db->setQuery("UPDATE #__components SET admin_menu_img='../administrator/components/com_hwdrevenuemanager/images/hwdphotoshare.png' WHERE admin_menu_link='option=com_hwdrevenuemanager&task=hwdphotoshare'");
		$iconresult[2] = $db->query();
		$db->setQuery("UPDATE #__components SET admin_menu_img='../administrator/components/com_hwdrevenuemanager/images/television.png' WHERE admin_menu_link='option=com_hwdrevenuemanager&task=videoads'");
		$iconresult[3] = $db->query();
		$db->setQuery("UPDATE #__components SET admin_menu_img='../administrator/components/com_hwdrevenuemanager/images/longtail.png' WHERE admin_menu_link='option=com_hwdrevenuemanager&task=longtail'");
		$iconresult[4] = $db->query();

		foreach ($iconresult as $i=>$icresult) {
			if (!$icresult) {
				echo '<img src="../administrator/components/com_hwdrevenuemanager/images/delete.png" border="0" alt="" title="" class="icon" /><font class="fail">ERROR:</font> Image of menu entry $i could not be set correctly.<br />';
				$section_check=false;
			}
		}

		if ($section_check==true) {
			echo '<img src="../administrator/components/com_hwdrevenuemanager/images/tick.png" border="0" alt="" title="" class="icon" /><font class="success">SUCCESS</font><br />';
		}

		$db->setQuery("SELECT COUNT(*) FROM #__components WHERE link = 'option='.$option.''");
		$components =& $db->loadResult();
		if ($components > 1) {
			$db->setQuery("SELECT id FROM #__components WHERE link = 'option='.$option.'' ORDER BY id DESC LIMIT 1");
			$comid =& $db->loadResult();
			$db->setQuery("DELETE FROM #__components WHERE link  = 'option='.$option.'' AND id != $comid  ");
			$db->query();
			$db->setQuery("DELETE FROM #__components WHERE #__components.option = ''.$option.'' AND parent != $comid AND id != $comid ");
			$db->query();
		}
	?>
	</div>

	<div class="installer_box">
		<h3>Database Upgrade & Patches</h3>
		<?php
		$section_check=true;

		$HWDUpgrades = array();
		// from 1.1.3 to 1.1.4 ALPHA RC1:
		$HWDUpgrades[0]['test'] = "SELECT `default` FROM #__hwdrm_vs_settings";
		$HWDUpgrades[0]['updates'][0] = "SELECT `setting` FROM #__hwdrm_vs_settings";
		$HWDUpgrades[0]['message'] = "All Version Compatibility Check";

		//Apply Upgrades
		foreach ($HWDUpgrades AS $HWDUpgrade) {
			$db->setQuery($HWDUpgrade['test']);
			//if it fails test then apply upgrade
			if (!$db->query()) {
				foreach($HWDUpgrade['updates'] as $UPDT) {
					$db->setQuery($UPDT);
					if(!$db->query()) {
						//Upgrade failed
						echo '<img src="../administrator/components/com_hwdrevenuemanager/images/delete.png" border="0" alt="" title="" class="icon" /><font class="fail">ERROR:</font> '.$HWDUpgrade['message'].'... <b>Upgrade failed! SQL error: ' . $db->stderr(true).'</b><br />';
						$section_check=false;

					}
				}
				//Upgrade was successful
				//echo '<img src="../administrator/components/com_hwdrevenuemanager/images/tick.png" border="0" alt="" title="" class="icon" /><font class="success">FINISHED:</font> '.$HWDUpgrade['message'].'... <b>Upgrade Applied Successfully</b><br />';
			}
		}

		if ($section_check==true) {
			echo '<img src="../administrator/components/com_hwdrevenuemanager/images/tick.png" border="0" alt="" title="" class="icon" /><font class="success">SUCCESS</font><br />';
		}
	?>
	</div>

	<div class="installer_box">
		<h3>Update Configuration</h3>
		<?php
		$section_check=true;

		// update general config file
		$updt_configVS = drawVSconfig();
		if ($updt_configVS == false) {
			echo '<img src="../administrator/components/com_hwdrevenuemanager/images/delete.png" border="0" alt="" title="" class="icon" /><font class="fail">ERROR:</font> Failed to update hwdVideoShare configuration file<br />';
			$section_check=false;
		}

		// update general config file
		$updt_configPS = drawPSconfig();
		if ($updt_configPS == false) {
			echo '<img src="../administrator/components/com_hwdrevenuemanager/images/delete.png" border="0" alt="" title="" class="icon" /><font class="fail">ERROR:</font> Failed to update hwdPhotoShare configuration file<br />';
			$section_check=false;
		}

		// update general config file
		$updt_configLT = drawLTconfig();
		if ($updt_configLT == false) {
			echo '<img src="../administrator/components/com_hwdrevenuemanager/images/delete.png" border="0" alt="" title="" class="icon" /><font class="fail">ERROR:</font> Failed to update LongTail configuration file<br />';
			$section_check=false;
		}

		if ($section_check==true) {
			echo '<img src="../administrator/components/com_hwdrevenuemanager/images/tick.png" border="0" alt="" title="" class="icon" /><font class="success">SUCCESS</font><br />';
		}
	?>
	</div>
	<?php
	}
	/**
     * Draws configuration file
     *
     * @return       Nothing
     */
	function drawVSconfig()
	{
		global $database;
		$db = & JFactory::getDBO();

		$configfile = "components/com_hwdrevenuemanager/config.vs.hwdrevenuemanager.php";
		@chmod ($configfile, 0777);
		$permission = is_writable($configfile);
		if (!$permission) {
			return false;
		}

		$config = "<?php\n";
		$config .= "class hwd_rm_vs_Config{ \n\n";
		$config .= "  // Stores the only allowable instance of this class.\n";
		$config .= "  var \$instanceConfig = null;\n\n";
		$config .= "  // Member variables\n";
		// print out config
		$query  = 'SELECT *'
				. ' FROM #__hwdrm_vs_settings'
				;
				$db->SetQuery($query);
		$rows = $db->loadObjectList();
		for ($i=0, $n=count($rows); $i < $n; $i++) {
			$row = $rows[$i];

			$row->value = stripslashes($row->value);
			$row->value = stripslashes($row->value);
			$row->value = addslashes($row->value);

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
		$config .= "    \$instanceConfig = new hwd_rm_vs_Config;\n";
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
    /**
     * Draws configuration file
     *
     * @return       Nothing
     */
	function drawPSconfig()
	{
		global $database;
		$db = & JFactory::getDBO();

		$configfile = "components/com_hwdrevenuemanager/config.ps.hwdrevenuemanager.php";
		@chmod ($configfile, 0777);
		$permission = is_writable($configfile);
		if (!$permission) {
			return false;
		}

		$config = "<?php\n";
		$config .= "class hwd_rm_ps_Config{ \n\n";
		$config .= "  // Stores the only allowable instance of this class.\n";
		$config .= "  var \$instanceConfig = null;\n\n";
		$config .= "  // Member variables\n";
		// print out config
		$query  = 'SELECT *'
				. ' FROM #__hwdrm_ps_settings'
				;
				$db->SetQuery($query);
		$rows = $db->loadObjectList();
		for ($i=0, $n=count($rows); $i < $n; $i++) {
			$row = $rows[$i];

			$row->value = stripslashes($row->value);
			$row->value = stripslashes($row->value);
			$row->value = addslashes($row->value);

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
		$config .= "    \$instanceConfig = new hwd_rm_ps_Config;\n";
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
    /**
     * Generates configuration file
     *
     * @return       Nothing
     */
	function drawLTconfig()
	{
		global $mainframe;
		$db =& JFactory::getDBO();

		$configfile = "components/com_hwdrevenuemanager/config.lt.hwdrevenuemanager.php";
		@chmod ($configfile, 0777);
		$permission = is_writable($configfile);
		if (!$permission) {
			return false;
		}

		$config = "<?php\n";
		$config .= "class hwd_rm_lt_Config{ \n\n";
		$config .= "  // Stores the only allowable instance of this class.\n";
		$config .= "  var \$instanceConfig = null;\n\n";
		$config .= "  // Member variables\n";
		// print out config
		$cids = "101,102, 103, 104";

		$query  = 'SELECT *'
				. ' FROM #__hwdrm_vs_settings'
				. ' WHERE id IN ( '.$cids.' )'
				;
				$db->SetQuery($query);
		$rows = $db->loadObjectList();
		for ($i=0, $n=count($rows); $i < $n; $i++) {
			$row = $rows[$i];

			$row->value = stripslashes($row->value);
			$row->value = stripslashes($row->value);
			$row->value = addslashes($row->value);

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
		$config .= "    \$instanceConfig = new hwd_rm_lt_Config;\n";
		$config .= "    return \$instanceConfig;\n";
		$config .= "  }\n\n";
		$config .= "}\n";
		$config .= "?>";

		if ($fp = @fopen("$configfile", "w")) {
			fputs($fp, $config, strlen($config));
			fclose ($fp);
		}

		return true;
	}
?>