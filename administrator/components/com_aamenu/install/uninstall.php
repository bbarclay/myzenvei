<?php
/**
 * @version		$Id: uninstall.php 67 2009-05-29 13:02:32Z eddieajau $
 * @package		TAOJ.AAMenu
 * @subpackage	com_aamenu
 * @copyright	Copyright (C) 2009 New Life in IT Pty Ltd. All rights reserved.
 * @license		GNU General Public License <http://www.gnu.org/copyleft/gpl.html>
 * @link		http://www.theartofjoomla.com
 */

// no direct access
defined('_JEXEC') or die();

// load the component language file
$language = &JFactory::getLanguage();
$language->load('com_aamenu');

//$nPaths = $this->_paths;
$status = new JObject();
$status->modules = array();
$status->plugins = array();

/***********************************************************************************************
 * ---------------------------------------------------------------------------------------------
 * MODULE REMOVAL SECTION
 * ---------------------------------------------------------------------------------------------
 ***********************************************************************************************/

$modules = &$this->manifest->getElementByPath('modules');
if (is_a($modules, 'JSimpleXMLElement') && count($modules->children())) {

	foreach ($modules->children() as $module)
	{
		$mname		= $module->attributes('module');
		$mclient	= JApplicationHelper::getClientInfo($module->attributes('client'), true);
		$mposition	= $module->attributes('position');

		// Set the installation path
		if (!empty ($mname)) {
			$this->parent->setPath('extension_root', $mclient->path.DS.'modules'.DS.$mname);
		} else {
			$this->parent->abort(JText::_('TAOJ_Install_Module').' '.JText::_('TAOJ_Install_Uninstall').': '.JText::_('TAOJ_Install_Module_File_Missing'));
			return false;
		}

		/**
		 * ---------------------------------------------------------------------------------------------
		 * Database Processing Section
		 * ---------------------------------------------------------------------------------------------
		 */
		$db = &JFactory::getDBO();

		// Lets delete all the module copies for the type we are uninstalling
		$query = 'SELECT `id`' .
				' FROM `#__modules`' .
				' WHERE module = '.$db->Quote($mname) .
				' AND client_id = '.(int)$mclient->id;
		$db->setQuery($query);
		$modules = $db->loadResultArray();

		// Do we have any module copies?
		if (count($modules)) {
			JArrayHelper::toInteger($modules);
			$modID = implode(',', $modules);
			$query = 'DELETE' .
					' FROM #__modules_menu' .
					' WHERE moduleid IN ('.$modID.')';
			$db->setQuery($query);
			if (!$db->query()) {
				JError::raiseWarning(100, JText::_('TAOJ_Install_Module').' '.JText::_('TAOJ_Install_Uninstall').': '.$db->stderr(true));
				$retval = false;
			}
		}

		// Delete the modules in the #__modules table
		$query = 'DELETE FROM #__modules WHERE module = '.$db->Quote($mname);
		$db->setQuery($query);
		if (!$db->query()) {
			JError::raiseWarning(100, JText::_('TAOJ_Install_Module').' '.JText::_('TAOJ_Install_Uninstall').': '.$db->stderr(true));
			$retval = false;
		}

		/**
		 * ---------------------------------------------------------------------------------------------
		 * Filesystem Processing Section
		 * ---------------------------------------------------------------------------------------------
		 */

		// Remove all necessary files
		$element = &$module->getElementByPath('files');
		if (is_a($element, 'JSimpleXMLElement') && count($element->children())) {
			$this->parent->removeFiles($element, -1);
		}

		// Remove all necessary files
		$element = &$module->getElementByPath('media');
		if (is_a($element, 'JSimpleXMLElement') && count($element->children())) {
			$this->parent->removeFiles($element, -1);
		}

		$element = &$module->getElementByPath('languages');
		if (is_a($element, 'JSimpleXMLElement') && count($element->children())) {
			$this->parent->removeFiles($element, $mclient->id);
		}

		// Remove the installation folder
		if (!JFolder::delete($this->parent->getPath('extension_root'))) {
		}

		$status->modules[] = array('name'=>$mname,'client'=>$mclient->name);
	}
}

/***********************************************************************************************
 * ---------------------------------------------------------------------------------------------
 * PLUGIN REMOVAL SECTION
 * ---------------------------------------------------------------------------------------------
 ***********************************************************************************************/

$plugins = &$this->manifest->getElementByPath('plugins');
if (is_a($plugins, 'JSimpleXMLElement') && count($plugins->children())) {

	foreach ($plugins->children() as $plugin)
	{
		$pname		= $plugin->attributes('plugin');
		$pgroup		= $plugin->attributes('group');

		// Set the installation path
		if (!empty($pname) && !empty($pgroup)) {
			$this->parent->setPath('extension_root', JPATH_ROOT.DS.'plugins'.DS.$pgroup);
		} else {
			$this->parent->abort(JText::_('TAOJ_Install_Plugin').' '.JText::_('TAOJ_Install_Uninstall').': '.JText::_('TAOJ_Install_Plugin_File_Missing'));
			return false;
		}

		/**
		 * ---------------------------------------------------------------------------------------------
		 * Database Processing Section
		 * ---------------------------------------------------------------------------------------------
		 */
		$db = &JFactory::getDBO();

		// Delete the plugins in the #__plugins table
		$query = 'DELETE FROM #__plugins WHERE element = '.$db->Quote($pname).' AND folder = '.$db->Quote($pgroup);
		$db->setQuery($query);
		if (!$db->query()) {
			JError::raiseWarning(100, JText::_('TAOJ_Install_Plugin').' '.JText::_('TAOJ_Install_Uninstall').': '.$db->stderr(true));
			$retval = false;
		}

		/**
		 * ---------------------------------------------------------------------------------------------
		 * Filesystem Processing Section
		 * ---------------------------------------------------------------------------------------------
		 */

		// Remove all necessary files
		$element = &$plugin->getElementByPath('files');
		if (is_a($element, 'JSimpleXMLElement') && count($element->children())) {
			$this->parent->removeFiles($element, -1);
		}

		$element = &$plugin->getElementByPath('languages');
		if (is_a($element, 'JSimpleXMLElement') && count($element->children())) {
			$this->parent->removeFiles($element, 1);
		}

		// If the folder is empty, let's delete it
		$files = JFolder::files($this->parent->getPath('extension_root'));
		if (!count($files)) {
			JFolder::delete($this->parent->getPath('extension_root'));
		}

		$status->plugins[] = array('name'=>$pname,'group'=>$pgroup);
	}
}


/***********************************************************************************************
 * ---------------------------------------------------------------------------------------------
 * OUTPUT TO SCREEN
 * ---------------------------------------------------------------------------------------------
 ***********************************************************************************************/
 $rows = 0;
?>

<h2><?php echo JText::_('AAMenu_UnInstall_Heading');?></h2>
<table class="adminlist">
	<thead>
		<tr>
			<th class="title" colspan="2"><?php echo JText::_('TAOJ_Install_Extension'); ?></th>
			<th width="30%"><?php echo JText::_('TAOJ_Install_Status'); ?></th>
		</tr>
	</thead>
	<tfoot>
		<tr>
			<td colspan="3"></td>
		</tr>
	</tfoot>
	<tbody>
		<tr class="row0">
			<td class="key" colspan="2"><?php echo 'Advanced Administrator Menu '.JText::_('TAOJ_Install_Component'); ?></td>
			<td><strong><?php echo JText::_('TAOJ_Install_Removed'); ?></strong></td>
		</tr>
<?php if (count($status->modules)) : ?>
		<tr>
			<th><?php echo JText::_('TAOJ_Install_Module'); ?></th>
			<th><?php echo JText::_('TAOJ_Install_Client'); ?></th>
			<th></th>
		</tr>
	<?php foreach ($status->modules as $module) : ?>
		<tr class="row<?php echo (++ $rows % 2); ?>">
			<td class="key"><?php echo $module['name']; ?></td>
			<td class="key"><?php echo ucfirst($module['client']); ?></td>
			<td><strong><?php echo JText::_('TAOJ_Install_Removed'); ?></strong></td>
		</tr>
	<?php endforeach;
endif;
if (count($status->plugins)) : ?>
		<tr>
			<th><?php echo JText::_('TAOJ_Install_Plugin'); ?></th>
			<th><?php echo JText::_('TAOJ_Install_Group'); ?></th>
			<th></th>
		</tr>
	<?php foreach ($status->plugins as $plugin) : ?>
		<tr class="row<?php echo (++ $rows % 2); ?>">
			<td class="key"><?php echo ucfirst($plugin['name']); ?></td>
			<td class="key"><?php echo ucfirst($plugin['group']); ?></td>
			<td><strong><?php echo JText::_('TAOJ_Install_Removed'); ?></strong></td>
		</tr>
	<?php endforeach;
endif; ?>
	</tbody>
</table>
