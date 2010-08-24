<?php
/**
 * @version		$Id: version.php 92 2009-06-04 09:58:37Z eddieajau $
 * @copyright	Copyright (C) 2009 New Life in IT Pty Ltd. All rights reserved.
 * @license		GNU General Public License <http://www.gnu.org/copyleft/gpl.html>
 * @link		http://www.theartofjoomla.com
 */

// no direct access
defined('_JEXEC') or die();

/**
 * Version Object
 *
 * @package		TAOJ.AAMenu
 * @subpackage	com_aamenu
 */
class MenuVersion extends JObject
{
	/**
	 * Extension name string.
	 *
	 * @var		string
	 */
	public $extension	= 'com_aamenu';

	/**
	 * Major.Minor version string.
	 *
	 * @var		string
	 */
	public $version	= '1.0';

	/**
	 * Maintenance version string.
	 *
	 * @var		string
	 */
	public $subversion	= '1';

	/**
	 * Version status string.
	 *
	 * @var		string
	 */
	public $status		= '';

	/**
	 * Version release time stamp.
	 *
	 * @var		string
	 */
	public $date		= '2009-06-04 00:00:00';

	/**
	 * Source control revision string.
	 *
	 * @var		string
	 */
	public $revision	= '$Revision: 17 $';

	/**
	 * Container for version information.
	 *
	 * @var		array
	 */
	protected $_versions = null;

	/**
	 * Container for upgrade information.
	 *
	 * @var		array
	 */
	protected $_upgrades = null;

	/**
	 * Method to get the build number from the source control revision string.
	 *
	 * @return	integer	The version build number.
	 */
	public function getBuild()
	{
		return intval(substr($this->revision, 11));
	}

	/**
	 * Method to get version history information.
	 *
	 * @return	array	Array of installed versions.
	 */
	public function getVersions()
	{
		// Only load the versions once.
		if (empty($this->_versions))
		{
			// Initialize variables.
			$this->_versions = array();

			// Load the version information.
			$db	= &JFactory::getDBO();
			$db->setQuery(
				'SELECT *' .
				' FROM `#__taoj`' .
				' WHERE `extension` = '.$db->quote($this->extension).
				' ORDER BY `id` DESC'
			);
			$this->_versions = $db->loadObjectList();

			// Check for a database error.
			if ($db->getErrorNum()) {
				$this->setError($db->getErrorMsg());
			}
		}

		return $this->_versions;
	}

	/**
	 * Method to get version upgrade information.
	 *
	 * @return	mixed	False on failure, array otherwise.
	 */
	public function getUpgrades()
	{
		// Only load the upgrades once.
		if (empty($this->_upgrades))
		{
			// Initialize variables.
			$this->_upgrades = array();

			// Get the version log data.
			$versions = $this->getVersions();

			// If we have a previously installed version, get the most recent.
			if ($last = array_shift($versions))
			{
				// Get the current and installed version strings.
				$currentVersion = $this->version.'.'.$this->subversion.' '.$this->status;
				$installedVersion = $last->version;

				// Is the current version newer than the last version recorded?
				if (version_compare(strtolower($currentVersion), strtolower($installedVersion)) == 1)
				{
					// Import library dependencies.
					jimport('joomla.filesystem.folder');

					// Yes, so look for upgrade SQL files.
					$files = JFolder::files(JPATH_COMPONENT.DS.'install', '^upgradesql');

					// Grab only the upgrade SQL files that are newer than the current version.
					foreach ($files as $file)
					{
						$parts = explode('.', $file);
						$fileVersion = str_replace('_', '.', $parts[1]);

						if (version_compare($fileVersion, $installedVersion) > 0) {
							$this->_upgrades[$fileVersion] = $file;
						}
					}
				}
			}
		}

		return $this->_upgrades;
	}

	/**
	 * Method to get version upgrade information.
	 *
	 * @return	mixed	False on failure, array otherwise.
	 */
	public function showUpgrades()
	{
		if (count($this->getUpgrades())) {
			$url = JRoute::_('index.php?option='.$this->extension.'&task=setup.upgrade&'.JUtility::getToken().'=1');
			JError::raiseWarning(500, JText::sprintf('TAOJ_Setup_Database_Upgrade_Required', $url));
		}
	}
}
