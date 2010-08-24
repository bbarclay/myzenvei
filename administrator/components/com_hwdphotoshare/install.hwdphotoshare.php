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

function com_install() {
	global $mainframe;
	$db =& JFactory::getDBO();

	$mainframe->addCustomHeadTag('<link rel="stylesheet" href="'.JURI::root( true ).'/administrator/components/com_hwdphotoshare/assets/css/installer.css" type="text/css" />');

	?>
	<div class="installer_logo_box"><img src="../administrator/components/com_hwdphotoshare/assets/images/logo.png" border="0" alt="hwdPhotoShare" title="hwdPhotoShare" /></div>

	<div class="installer_box">
		<h2>hwdPhotoShare [ Accetto ]</h2>
        <p>An open source photo sharing component developed by <a href="http://joomla.highwooddesign.co.uk" target="_blank">Highwood Design</a>.<br />
        Released under the terms and conditions of the <a href="http://www.gnu.org/licenses/gpl.html" target="_blank">GNU General Public License</a>.<br />
		See the component homepage for more details after installation.</p>
	</div>

	<div class="installer_box">
		<h3>Menu Configuration</h3>
		<?php
		$section_check=true;

		# Set up new icons for admin menu
		$db->setQuery("UPDATE #__components SET admin_menu_img='../administrator/components/com_hwdphotoshare/assets/images/menu/photos.png' WHERE admin_menu_link='option=com_hwdphotoshare&task=photos'");
		$iconresult[0] = $db->query();
		$db->setQuery("UPDATE #__components SET admin_menu_img='../administrator/components/com_hwdphotoshare/assets/images/menu/albums.png' WHERE admin_menu_link='option=com_hwdphotoshare&task=albums'");
		$iconresult[1] = $db->query();
		$db->setQuery("UPDATE #__components SET admin_menu_img='../administrator/components/com_hwdphotoshare/assets/images/menu/categories.png' WHERE admin_menu_link='option=com_hwdphotoshare&task=categories'");
		$iconresult[2] = $db->query();
		$db->setQuery("UPDATE #__components SET admin_menu_img='../administrator/components/com_hwdphotoshare/assets/images/menu/groups.png' WHERE admin_menu_link='option=com_hwdphotoshare&task=groups'");
		$iconresult[3] = $db->query();
		$db->setQuery("UPDATE #__components SET admin_menu_img='../administrator/components/com_hwdphotoshare/assets/images/menu/settings.png' WHERE admin_menu_link='option=com_hwdphotoshare&task=generalsettings'");
		$iconresult[4] = $db->query();
		$db->setQuery("UPDATE #__components SET admin_menu_img='../administrator/components/com_hwdphotoshare/assets/images/menu/approvals.png' WHERE admin_menu_link='option=com_hwdphotoshare&task=approvals'");
		$iconresult[5] = $db->query();
		$db->setQuery("UPDATE #__components SET admin_menu_img='../administrator/components/com_hwdphotoshare/assets/images/menu/reported.png' WHERE admin_menu_link='option=com_hwdphotoshare&task=reported'");
		$iconresult[6] = $db->query();
		$db->setQuery("UPDATE #__components SET admin_menu_img='../administrator/components/com_hwdphotoshare/assets/images/menu/plugins.png' WHERE admin_menu_link='option=com_hwdphotoshare&task=plugins'");
		$iconresult[7] = $db->query();
		$db->setQuery("UPDATE #__components SET admin_menu_img='../administrator/components/com_hwdphotoshare/assets/images/menu/export.png' WHERE admin_menu_link='option=com_hwdphotoshare&task=export'");
		$iconresult[8] = $db->query();
		$db->setQuery("UPDATE #__components SET admin_menu_img='../administrator/components/com_hwdphotoshare/assets/images/menu/import.png' WHERE admin_menu_link='option=com_hwdphotoshare&task=import'");
		$iconresult[9] = $db->query();
		$db->setQuery("UPDATE #__components SET admin_menu_img='../administrator/components/com_hwdphotoshare/assets/images/menu/maintenance.png' WHERE admin_menu_link='option=com_hwdphotoshare&task=maintenance'");
		$iconresult[10] = $db->query();
		$db->setQuery("UPDATE #__components SET admin_menu_img='../administrator/components/com_hwdphotoshare/assets/images/menu/hwdphotoshare.png' WHERE admin_menu_link='option=com_hwdphotoshare'");
		$iconresult[11] = $db->query();

		foreach ($iconresult as $i=>$icresult) {
			if (!$icresult) {
				echo '<img src="../administrator/components/com_hwdphotoshare/assets/images/icons/delete.png" border="0" alt="" title="" class="icon" /><font class="fail">ERROR:</font> Image of menu entry $i could not be set correctly.<br />';
				$section_check=false;
			}
		}

		if ($section_check==true) {
			echo '<img src="../administrator/components/com_hwdphotoshare/assets/images/icons/add.png" border="0" alt="" title="" class="icon" /><font class="success">SUCCESS</font><br />';
		}

		$db->setQuery("SELECT COUNT(*) FROM #__components WHERE link = 'option=com_hwdphotoshare'");
		$components =& $db->loadResult();
		if ($components > 1) {
			$db->setQuery("SELECT id FROM #__components WHERE link = 'option=com_hwdphotoshare' ORDER BY id DESC LIMIT 1");
			$comid =& $db->loadResult();
			$db->setQuery("DELETE FROM #__components WHERE link  = 'option=com_hwdphotoshare' AND id != $comid  ");
			$db->query();
			$db->setQuery("DELETE FROM #__components WHERE #__components.option = 'com_hwdphotoshare' AND parent != $comid AND id != $comid ");
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
		$HWDUpgrades[0]['test'] = "SELECT `default` FROM #__hwdpsphotos";
		$HWDUpgrades[0]['updates'][0] = "ALTER TABLE `#__hwdpsphotos` CHANGE `rating_number_votes` `rating_number_votes` int(50) NOT NULL DEFAULT 0";
		$HWDUpgrades[0]['updates'][1] = "ALTER TABLE `#__hwdpsphotos` CHANGE `rating_total_points` `rating_total_points` int(50) NOT NULL DEFAULT 0";
		$HWDUpgrades[0]['updates'][2] = "ALTER TABLE `#__hwdpsphotos` CHANGE `privacy` `privacy` varchar(250) NOT NULL DEFAULT 'public'";
		$HWDUpgrades[0]['updates'][3] = "ALTER TABLE `#__hwdpsphotos` CHANGE `approved` `approved` varchar(250) NOT NULL DEFAULT 'pending'";
		$HWDUpgrades[0]['updates'][4] = "ALTER TABLE `#__hwdpsphotos` CHANGE `user_id` `user_id` int(50) NOT NULL DEFAULT 0";
		$HWDUpgrades[0]['updates'][5] = "ALTER TABLE `#__hwdpsphotos` CHANGE `updated_rating` `updated_rating` float(4,2) NOT NULL DEFAULT 0";
		$HWDUpgrades[0]['updates'][6] = "ALTER TABLE `#__hwdpsphotos` CHANGE `number_of_views` `number_of_views` int(50) NOT NULL DEFAULT 0";
		$HWDUpgrades[0]['message'] = "All Version Compatibility Check [Patch 1]";

		// from 1.1.4 ALPHA RC1 to 2.1.1:
		$HWDUpgrades[1]['test'] = "SELECT `category_id` FROM #__hwdpsphotos";
		$HWDUpgrades[1]['updates'][0] = "ALTER TABLE `#__hwdpsphotos` ADD `category_id` INT ( 50 ) DEFAULT '0' NOT NULL AFTER `album_id`";
		$HWDUpgrades[1]['message'] = "Build 1.1.4 ALPHA RC1 to Build 2.1.1";

		// from SVN-r118 to SVN-r119:
		$HWDUpgrades[2]['test'] = "SELECT `photoid` FROM #__hwdpslogs_views";
		$HWDUpgrades[2]['updates'][0] = "ALTER TABLE `#__hwdpslogs_views` CHANGE `videoid` `photoid` int(50) NOT NULL default '0'";
		$HWDUpgrades[2]['updates'][1] = "ALTER TABLE `#__hwdpslogs_votes` CHANGE `videoid` `photoid` int(50) NOT NULL default '0'";
		$HWDUpgrades[2]['updates'][2] = "ALTER TABLE `#__hwdpslogs_favours` CHANGE `videoid` `photoid` int(50) NOT NULL default '0'";
		$HWDUpgrades[2]['updates'][3] = "ALTER TABLE `#__hwdpslogs_archive` CHANGE `videoid` `photoid` int(50) NOT NULL default '0'";
		$HWDUpgrades[2]['message'] = "SVN-r118 to SVN-r119";

		//Apply Upgrades
		foreach ($HWDUpgrades AS $HWDUpgrade) {
			$db->setQuery($HWDUpgrade['test']);
			//if it fails test then apply upgrade
			if (!$db->query()) {
				foreach($HWDUpgrade['updates'] as $UPDT) {
					$db->setQuery($UPDT);
					if(!$db->query()) {
						//Upgrade failed
						echo '<img src="../administrator/components/com_hwdphotoshare/assets/images/icons/delete.png" border="0" alt="" title="" class="icon" /><font class="fail">ERROR:</font> '.$HWDUpgrade['message'].'... <b>Upgrade failed! SQL error: ' . $db->stderr(true).'</b><br />';
						$section_check=false;

					}
				}
				//Upgrade was successful
				//echo '<img src="../administrator/components/com_hwdphotoshare/assets/images/icons/add.png" border="0" alt="" title="" class="icon" /><font class="success">FINISHED:</font> '.$HWDUpgrade['message'].'... <b>Upgrade Applied Successfully</b><br />';
			}
		}

		if ($section_check==true) {
			echo '<img src="../administrator/components/com_hwdphotoshare/assets/images/icons/add.png" border="0" alt="" title="" class="icon" /><font class="success">SUCCESS</font><br />';
		}
	?>
	</div>

	<div class="installer_box">
		<h3>Update Configuration</h3>
		<?php
		$section_check=true;

		// Set up initialisation
		$db->setQuery("UPDATE #__hwdpsgs SET value=1 WHERE setting='initialise_now'");
		$initialise[0] = $db->query();
		foreach ($initialise as $i=>$icresult) {
			if (!$icresult) {
				echo '<img src="../administrator/components/com_hwdphotoshare/assets/images/icons/delete.png" border="0" alt="" title="" class="icon" /><font class="fail">ERROR:</font> Failed to set initialisation<br />';
				$section_check=false;
			}
		}

		// update general config file
		$updt_config = drawconfig();
		if ($updt_config == false) {
			echo '<img src="../administrator/components/com_hwdphotoshare/assets/images/icons/delete.png" border="0" alt="" title="" class="icon" /><font class="fail">ERROR:</font> Failed to update general configuration file<br />';
			$section_check=false;
		}

		if ($section_check==true) {
			echo '<img src="../administrator/components/com_hwdphotoshare/assets/images/icons/add.png" border="0" alt="" title="" class="icon" /><font class="success">SUCCESS</font><br />';
		}
	?>
	</div>

	<div class="installer_box">
		<h3>Unpacking Files</h3>
		<?php
		$section_check=true;

		require_once(JPATH_SITE.'/libraries/joomla/filesystem/archive/gzip.php');
		jimport( 'joomla.filesystem.archive.gzip' );
		$garchive = new JArchiveGzip();

		// uploader
		$archive = JPATH_SITE.'/components/com_hwdphotoshare/assets/uploads/jumpuploader/jumploader_z.gz';
		$destination = JPATH_SITE.'/components/com_hwdphotoshare/assets/uploads/jumpuploader/jumploader_z.jar';
		$gextract = & $garchive->extract($archive,$destination);
		if($gextract) {
			unlink($archive);
		} else {
			echo '<img src="../administrator/components/com_hwdphotoshare/assets/images/icons/delete.png" border="0" alt="" title="" class="icon" /><font class="fail">ERROR:</font> Failed to unpack the Java Upload archive<br />';
		}

		if ($section_check==true) {
			echo '<img src="../administrator/components/com_hwdphotoshare/assets/images/icons/add.png" border="0" alt="" title="" class="icon" /><font class="success">SUCCESS</font><br />';
		}
	?>
	</div>

	<div class="installer_box">
		<h3>File and Folder Permissions</h3>
		<?php
		$section_check=true;

		$path = JPATH_SITE . '/components/com_hwdphotoshare/xml/';
		if (!makeDirectoryWritable($path)) {
			$section_check=false;
		}

		$path = JPATH_SITE . '/components/com_hwdphotoshare/assets/uploads/jumpuploader/jumploader_z.jar';
		if (!makeDirectoryExecutable($path)) {
			$section_check=false;
		}

		if ($section_check==true) {
			echo '<img src="../administrator/components/com_hwdphotoshare/assets/images/icons/add.png" border="0" alt="" title="" class="icon" /><font class="success">SUCCESS</font><br />';
		}
	?>
	</div>

	<div class="installer_box">
		<h3>Directory Creation Process</h3>
		<?php
		$section_check=true;

		$path = JPATH_SITE . '/hwdphotos/';
		if (!createDirectory($path)) {
			$section_check=false;
		}

		if(file_exists($path) && is_writable($path)){

			$path = JPATH_SITE . '/hwdphotos/originals/';
			if (!createDirectory($path)) {
				$section_check=false;
			}

			$path = JPATH_SITE . '/hwdphotos/thumbs/';
			if (!createDirectory($path)) {
				$section_check=false;
			}

			$path = JPATH_SITE . '/hwdphotos/thumbs/normal/';
			if (!createDirectory($path)) {
				$section_check=false;
			}

			$path = JPATH_SITE . '/hwdphotos/thumbs/square/';
			if (!createDirectory($path)) {
				$section_check=false;
			}

			$path = JPATH_SITE . '/hwdphotos/thumbs/squarerf/';
			if (!createDirectory($path)) {
				$section_check=false;
			}

			$path = JPATH_SITE . '/hwdphotos/uploads/';
			if (!createDirectory($path)) {
				$section_check=false;
			}

		} else {
			echo '<img src="../administrator/components/com_hwdphotoshare/assets/images/icons/delete.png" border="0" alt="" title="" class="icon" /><font class="fail">ERROR:</font> The directory <b>'.$path.'</b> could not be created or could not be made writable<br /><p style="padding-left: 26px">Manually do the following:<br />1) Create the directory <b>'.$path.'</b><br />2) Make this directory writable (chmod 0777)<br />3) Re-install hwdPhotoShare</p><br />';
		}

		if ($section_check==true) {
			echo '<img src="../administrator/components/com_hwdphotoshare/assets/images/icons/add.png" border="0" alt="" title="" class="icon" /><font class="success">SUCCESS</font><br />';
		}
	?>
	</div>

	<div class="installer_box">
		<h3>Plugin Configuration</h3>
		<?php
		$section_check=true;

		$plugdir = JPATH_PLUGINS.DS.'hwdps-slideshow';
		if (!JFolder::create($plugdir)) {
			JError::raiseWarning(1, 'JInstaller::install: '.JText::_('Failed to create directory').' "'.$plugdir.'"');
		}

		$plugdir = JPATH_PLUGINS.DS.'hwdps-language';
		if (!JFolder::create($plugdir)) {
			JError::raiseWarning(1, 'JInstaller::install: '.JText::_('Failed to create directory').' "'.$plugdir.'"');
		}

		$plugdir = JPATH_PLUGINS.DS.'hwdps-template';
		if (!JFolder::create($plugdir)) {
			JError::raiseWarning(1, 'JInstaller::install: '.JText::_('Failed to create directory').' "'.$plugdir.'"');
		}

		// english

			$file_destination = JPATH_PLUGINS.DS.'hwdps-language'.DS;
			$file_original = JPATH_SITE.DS.'administrator'.DS.'components'.DS.'com_hwdphotoshare'.DS.'install'.DS.'plugins'.DS.'english'.DS;

			if (!copyDirectoryRecursive($file_original, $file_destination )) {
				echo '<img src="../administrator/components/com_hwdphotoshare/assets/images/icons/delete.png" border="0" alt="" title="" class="icon" /><font class="fail">ERROR:</font> Failed to install English plugin. Check your Joomla <a href="'.JURI::root( true ).DS.'administrator'.DS.'index.php?option=com_admin&task=sysinfo">Directory Permissions</a> are writeable.<br />';
				$section_check=false;
			}

			//@deleteDirectoryRecursive( $file_original );

			$db->setQuery("SELECT COUNT(*) FROM #__plugins WHERE element = 'english' AND folder = 'hwdps-language'");
			$count = $db->loadResult();
			if ($count == 0) {
				$query = "INSERT IGNORE INTO `#__plugins` VALUES ('', 'English', 'english', 'hwdps-language', 0, 1, 1, 0, 0, 0, '0000-00-00 00:00:00', '')";
				$db->setQuery( $query );
				$db->query();
			}

		// default

			$file_destination = JPATH_PLUGINS.DS.'hwdps-template'.DS;
			$file_original = JPATH_SITE.DS.'administrator'.DS.'components'.DS.'com_hwdphotoshare'.DS.'install'.DS.'plugins'.DS.'default'.DS;

			if (!copyDirectoryRecursive($file_original, $file_destination )) {
				echo '<img src="../administrator/components/com_hwdphotoshare/assets/images/icons/delete.png" border="0" alt="" title="" class="icon" /><font class="fail">ERROR:</font> Failed to install Default Template plugin. Check your Joomla <a href="'.JURI::root( true ).DS.'administrator'.DS.'index.php?option=com_admin&task=sysinfo">Directory Permissions</a> are writeable.<br />';
				$section_check=false;
			}

			//@deleteDirectoryRecursive( $file_original );

			$db->setQuery("SELECT COUNT(*) FROM #__plugins WHERE element = 'default' AND folder = 'hwdps-template'");
			$count = $db->loadResult();
			if ($count == 0) {
				$query = "INSERT IGNORE INTO `#__plugins` VALUES ('', 'Default Template', 'default', 'hwdps-template', 0, 1, 1, 0, 0, 0, '0000-00-00 00:00:00', '')";
				$db->setQuery( $query );
				$db->query();
			}

		// autoviewer

			$file_destination = JPATH_PLUGINS.DS.'hwdps-slideshow'.DS;
			$file_original = JPATH_SITE.DS.'administrator'.DS.'components'.DS.'com_hwdphotoshare'.DS.'install'.DS.'plugins'.DS.'autoviewer'.DS;

			if (!copyDirectoryRecursive($file_original, $file_destination )) {
				echo '<img src="../administrator/components/com_hwdphotoshare/assets/images/icons/delete.png" border="0" alt="" title="" class="icon" /><font class="fail">ERROR:</font> Failed to install Autoviewer plugin. Check your Joomla <a href="'.JURI::root( true ).DS.'administrator'.DS.'index.php?option=com_admin&task=sysinfo">Directory Permissions</a> are writeable.<br />';
				$section_check=false;
			}

			//@deleteDirectoryRecursive( $file_original );

			$db->setQuery("SELECT COUNT(*) FROM #__plugins WHERE element = 'autoviewer' AND folder = 'hwdps-slideshow'");
			$count = $db->loadResult();
			if ($count == 0) {
				$query = "INSERT IGNORE INTO `#__plugins` VALUES ('', 'AutoViewer', 'autoviewer', 'hwdps-slideshow', 0, 1, 1, 0, 0, 0, '0000-00-00 00:00:00', '')";
				$db->setQuery( $query );
				$db->query();
			}

		if ($section_check==true) {
			echo '<img src="../administrator/components/com_hwdphotoshare/assets/images/icons/add.png" border="0" alt="" title="" class="icon" /><font class="success">SUCCESS</font><br />';
		}
	?>
	</div>
<?php
}


/**
 * Draws the general configuration file
 */
function drawconfig()
	{
	global $database;
	$db =& JFactory::getDBO();

	$configfile = "components/com_hwdphotoshare/config.hwdphotoshare.php";
	@chmod ($configfile, 0777);
	$permission = is_writable($configfile);
	if (!$permission) {
		return false;
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
	$db->setQuery($query);
	$rows = $db->loadObjectList();
	for ($i=0, $n=count($rows); $i < $n; $i++) {
		$row = $rows[$i];
		//if ($row->setting == "flvplay_width" && empty($row->value)) { $row->value = "450"; }
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

/**
 * Draws the server configuration file
 */
function createDirectory($path, $suppress=false)
{
	if(!file_exists($path)){
		if(@mkdir($path)) {
			if(!is_writable($path)){
				if(@!chmod($path, 0777)) {
					if (!$suppress) {
						echo '<img src="../administrator/components/com_hwdphotoshare/assets/images/icons/delete.png" border="0" alt="" title="" class="icon" /><font class="fail">ERROR:</font> Failed to make '.$path.' writeable<br />';
					}
					return false;
				}
			}
		} else {
			if (!$suppress) {
				echo '<img src="../administrator/components/com_hwdphotoshare/assets/images/icons/delete.png" border="0" alt="" title="" class="icon" /><font class="fail">ERROR:</font> Failed to create '.$path.'<br />';
			}
			return false;
		}
	} else {
		if(!is_writable($path)){
			if(@!chmod($path, 0777)) {
				if (!$suppress) {
					echo '<img src="../administrator/components/com_hwdphotoshare/assets/images/icons/delete.png" border="0" alt="" title="" class="icon" /><font class="fail">ERROR:</font> Failed to make '.$path.' writeable<br />';
				}
				return false;
			}
		}
	}
	return true;
}

/**
 * Draws the server configuration file
 */
function makeDirectoryWritable($path)
{
	if (@!is_writable($path)) {
		if(@!chmod($path, 0777)) {
			echo '<img src="../administrator/components/com_hwdphotoshare/assets/images/icons/delete.png" border="0" alt="" title="" class="icon" /><font class="fail">ERROR:</font> Failed to make '.$path.' writeable<br />';
			return false;
		}
	}
	return true;
}

/**
 * Draws the server configuration file
 */
function makeDirectoryExecutable($path)
{
	if (@!is_executable($path)) {
		if(@!chmod($path, 0755)) {
			echo '<img src="../administrator/components/com_hwdphotoshare/assets/images/icons/delete.png" border="0" alt="" title="" class="icon" /><font class="fail">ERROR:</font> Failed to make '.$path.' executable<br />';
			return false;
		}
	}
	return true;
}
/**
 * Copy a directory
 */
function copyDirectoryRecursive($source, $dest, $options=array('folderPermission'=>0755,'filePermission'=>0755))
    {
        $result=false;

        if (is_file($source)) {
            if ($dest[strlen($dest)-1]=='/') {
                if (!file_exists($dest)) {
                    cmfcDirectory::makeAll($dest,$options['folderPermission'],true);
                }
                $__dest=$dest."/".basename($source);
            } else {
                $__dest=$dest;
            }
            $result=copy($source, $__dest);
            chmod($__dest,$options['filePermission']);

        } elseif(is_dir($source)) {
            if ($dest[strlen($dest)-1]=='/') {
                if ($source[strlen($source)-1]=='/') {
                    //Copy only contents
                } else {
                    //Change parent itself and its contents
                    $dest=$dest.basename($source);
                    @mkdir($dest);
                    chmod($dest,$options['filePermission']);
                }
            } else {
                if ($source[strlen($source)-1]=='/') {
                    //Copy parent directory with new name and all its content
                    @mkdir($dest,$options['folderPermission']);
                    chmod($dest,$options['filePermission']);
                } else {
                    //Copy parent directory with new name and all its content
                    @mkdir($dest,$options['folderPermission']);
                    chmod($dest,$options['filePermission']);
                }
            }

            $dirHandle=opendir($source);
            while($file=readdir($dirHandle))
            {
                if($file!="." && $file!="..")
                {
                     if(!is_dir($source."/".$file)) {
                        $__dest=$dest."/".$file;
                    } else {
                        $__dest=$dest."/".$file;
                    }
                    //echo "$source/$file ||| $__dest<br />";
                    $result=copyDirectoryRecursive($source."/".$file, $__dest, $options);
                }
            }
            closedir($dirHandle);

        } else {
            $result=false;
        }
        return $result;
    }

/**
 * Delete a directory
 */
function deleteDirectoryRecursive($directory, $empty=FALSE)
   {
     if(substr($directory,-1) == '/')
     {
         $directory = substr($directory,0,-1);
     }
     if(!file_exists($directory) || !is_dir($directory))
     {
        return FALSE;
     }elseif(is_readable($directory))
     {
         $handle = opendir($directory);
         while (FALSE !== ($item = readdir($handle)))
         {
             if($item != '.' && $item != '..')
             {
                 $path = $directory.'/'.$item;
                 if(is_dir($path))
                 {
                     deleteDirectoryRecursive($path);
                 }else{
                     unlink($path);
                 }
             }
         }
         closedir($handle);
         if($empty == FALSE)
         {
             if(!rmdir($directory))
             {
                 return FALSE;
             }
         }
     }
     return TRUE;
 }
?>
