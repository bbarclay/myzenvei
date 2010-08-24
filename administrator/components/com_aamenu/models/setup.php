<?php
/**
 * @version		$Id: setup.php 67 2009-05-29 13:02:32Z eddieajau $
 * @copyright	Copyright (C) 2009 New Life in IT Pty Ltd. All rights reserved.
 * @license		GNU General Public License <http://www.gnu.org/copyleft/gpl.html>
 * @link		http://www.theartofjoomla.com
 */

// no direct access
defined('_JEXEC') or die();

jimport('joomla.application.component.model');
jimport('joomla.filesystem.file');
require_once(JPATH_ADMINISTRATOR.'/components/com_aamenu/version.php');

/**
 * Setup Model
 *
 * @package		TAOJ.AAMenu
 * @subpackage	com_aamenu
 */
class MenuModelSetup extends JModel
{
	/**
	 * Method to manually install the extension
	 *
	 * @return	boolean	True on success.
	 */
	public function install()
	{
		// Get the current component version information.
		$version = new MenuVersion();
		$current = $version->version.'.'.$version->subversion.$version->status;

		// Get the database object.
		$db = &$this->_db;

		// Get the number of relevant rows in the components table.
		$db->setQuery(
			'SELECT COUNT(id)' .
			' FROM `#__components`' .
			' WHERE `option` = "com_aamenu"'
		);
		$installed = $db->loadResult();

		// Check for a database error.
		if ($db->getErrorNum()) {
			$this->setError($db->getErrorMsg());
			return false;
		}

		// Check to see if the component is installed.
		if ($installed > 0) {
			$this->setError(JText::_('AAMenu_Setup_Already_Installed'));
			return false;
		}

		// Attempt to add the necessary rows to the components table.
		$db->setQuery(
			'INSERT INTO `#__components` VALUES' .
			' (0, "Advanced Administrator Menu", "option=com_aamenu", 0, 0, "option=com_aamenu", "Advanced Administrator Menu", "com_aamenu", 0, "components/com_aamenu/media/images/taoj_logo16x16.png", 0, "", 1)'
		);
		$db->query();

		// Check for a database error.
		if ($db->getErrorNum()) {
			$this->setError($db->getErrorMsg());
			return false;
		}

		// Verify the schema file.
		$file = JPATH_ADMINISTRATOR.'/components/com_aamenu/install/installsql.mysql.utf8.php';
		if (!JFile::exists($file)) {
			$this->setError(JText::_('TAOJ_Setup_Schema_File_Missing'));
			return false;
		}

		// Set the SQL from the schema file.
		$db->setQuery(JFile::read($file));

		// Attempt to import the component schema.
		$return = $db->queryBatch(false);

		// Check for a database error.
		if ($db->getErrorNum()) {
			$this->setError($db->getErrorMsg());
			return false;
		}

		// Attempt to insert the manual install entry into the component version table.
		$db->setQuery(
			'INSERT IGNORE INTO `#__taoj` (`extension`,`version`,`log`)' .
			' VALUES ('.$db->quote('com_aamenu').','.$db->Quote($current).', '.$db->Quote('TAOJ_Setup_Manual_Install').')'
		);
		$db->query();

		// Check for a database error.
		if ($db->getErrorNum()) {
			$this->setError($db->getErrorMsg());
			return false;
		}

		return true;
	}

	/**
	 * Method to run necessary database upgrade scripts
	 *
	 * @access	public
	 * @return	boolean	True on success.
	 * @since	1.2
	 */
	function upgrade()
	{
		// Get the component upgrade information.
		$version	= new MenuVersion();
		$upgrades	= $version->getUpgrades();

		// If there are upgrades to process, attempt to process them.
		if (is_array($upgrades) && count($upgrades))
		{
			// Sort the upgrades, lowest version first.
			uksort($upgrades, 'version_compare');

			// Get the database object.
			$db = &$this->_db;

			// Get the number of relevant rows in the components table.
			$db->setQuery(
				'SELECT COUNT(id)' .
				' FROM `#__components`' .
				' WHERE `option` = "com_aamenu"'
			);
			$installed = $db->loadResult();

			// Check for a database error.
			if ($db->getErrorNum()) {
				$this->setError($db->getErrorMsg());
				return false;
			}

			// Check to see if the component is installed.
			if ($installed < 1) {
				$this->setError(JText::_('AAMenu_Setup_Not_Installed'));
				return false;
			}

			foreach ($upgrades as $upgradeVersion => $file)
			{
				$file = JPATH_COMPONENT.DS.'install'.DS.$file;

				if (JFile::exists($file))
				{
					// Set the upgrade SQL from the file.
					$db->setQuery(JFile::read($file));

					// Execute the upgrade SQL.
					$return = $db->queryBatch(false);

					// Check for a database error.
					if ($db->getErrorNum()) {
						$this->setError(JText::sprintf('TAOJ_Setup_Database_Upgrade_Failed', $db->getErrorMsg()));
						return false;
					}

					// Upgrade was successful, attempt to log it to the versions table.
					$db->setQuery(
						'INSERT INTO `#__taoj` (`extension`,`version`,`log`) VALUES' .
						' ('.$db->quote('com_aamenu').','.$db->Quote($upgradeVersion).', '.$db->Quote(JText::sprintf('TAOJ_Setup_Database_Upgrade_Version', $upgradeVersion)).')'
					);
					$db->query();

					// Check for a database error.
					if ($db->getErrorNum()) {
						$this->setError(JText::sprintf('TAOJ_Setup_Database_Upgrade_Failed', $db->getErrorMsg()));
						return false;
					}
				}
			}
		}

		return true;
	}
}