<?php
/**
 * @version		$Id:plugin.php 6961 2007-03-15 16:06:53Z tcp $
 * @package		JLibMan
 * @subpackage	Installer
 * @copyright	Copyright (C) 2007 Toowoomba City Council/Sam Moffatt
 * @copyright 	Copyright (C) 2005-2007 Open Source Matters (Portions)
 * @license		GNU/GPL, see LICENSE.php
 * Joomla! is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * See COPYRIGHT.php for copyright notices and details.
 */

// Check to ensure this file is within the rest of the framework
defined('JPATH_BASE') or die();

if(!defined('LIBRARY_MANIFEST_PATH')) define('LIBRARY_MANIFEST_PATH',JPATH_ADMINISTRATOR . DS . 'components' . DS . 'com_jlibman' . DS .'manifests');

/**
 * Library installer
 *
 * @package		JLibMan
 * @subpackage	Installer
 * @since		1.5
 */
class JInstallerLibrary extends JObject
{
	/**
	 * Constructor
	 *
	 * @access	protected
	 * @param	object	$parent	Parent object [JInstaller instance]
	 * @return	void
	 * @since	1.5
	 */
	function __construct(&$parent)
	{
		$this->parent =& $parent;
	}

	/**
	 * Custom install method
	 *
	 * @access	public
	 * @return	boolean	True on success
	 * @since	1.5
	 */
	function install()
	{
		// Get the extension manifest object
		$manifest =& $this->parent->getManifest();
		$this->manifest =& $manifest->document;

		/**
		 * ---------------------------------------------------------------------------------------------
		 * Manifest Document Setup Section
		 * ---------------------------------------------------------------------------------------------
		 */

		// Set the extensions name
		$name =& $this->manifest->getElementByPath('name');
		$name = JFilterInput::clean($name->data(), 'string');
		$this->set('name', $name);

		// Get the component description
		$description = & $this->manifest->getElementByPath('description');
		if (is_a($description, 'JSimpleXMLElement')) {
			$this->parent->set('message', $description->data());
		} else {
			$this->parent->set('message', '' );
		}

		// Set the installation path
		$element =& $this->manifest->getElementByPath('files');
		$group = $this->manifest->getElementByPath('libraryname');
		$group = $group->data();
		if (!empty($group)) {
			$this->parent->setPath('extension_root', JPATH_ROOT.DS.'libraries'.DS.implode(DS,explode('/',$group)));
		} else {
			$this->parent->abort(JText::_('Library').' '.JText::_('Install').': '.JText::_('No library file specified'));
			return false;
		}

		/**
		 * ---------------------------------------------------------------------------------------------
		 * Filesystem Processing Section
		 * ---------------------------------------------------------------------------------------------
		 */

		// If the plugin directory does not exist, lets create it
		$created = false;
		if (!file_exists($this->parent->getPath('extension_root'))) {
			if (!$created = JFolder::create($this->parent->getPath('extension_root'))) {
				$this->parent->abort(JText::_('Library').' '.JText::_('Install').': '.JText::_('Failed to create directory').': "'.$this->parent->getPath('extension_root').'"');
				return false;
			}
		}

		/*
		 * If we created the plugin directory and will want to remove it if we
		 * have to roll back the installation, lets add it to the installation
		 * step stack
		 */
		if ($created) {
			$this->parent->pushStep(array ('type' => 'folder', 'path' => $this->parent->getPath('extension_root')));
		}

		// Copy all necessary files
		if ($this->parent->parseFiles($element, -1) === false) {
			// Install failed, roll back changes
			$this->parent->abort();
			return false;
		}

		/**
		 * ---------------------------------------------------------------------------------------------
		 * Finalization and Cleanup Section
		 * ---------------------------------------------------------------------------------------------
		 */

		// Lastly, we will copy the manifest file to its appropriate place.
		$manifest = Array();
		$manifest['src'] = $this->parent->getPath('manifest');
		$manifest['dest'] = JPATH_ADMINISTRATOR.DS.'components'.DS.'com_jlibman'.DS.'manifests'.DS.basename($this->parent->getPath('manifest'));
		if (!$this->parent->copyFiles(array($manifest), true)) {
			// Install failed, rollback changes
			$this->parent->abort(JText::_('Library').' '.JText::_('Install').': '.JText::_('Could not copy setup file'));
			return false;
		}
		return true;
	}

	/**
	 * Custom update method
	 * @access public
	 * @return boolean True on success
	 * @since  1.5
	 */
	function update() {
		// since this is just files, an update removes old files
		// Get the extension manifest object
		$manifest =& $this->parent->getManifest();
		$this->manifest =& $manifest->document;

		/**
		 * ---------------------------------------------------------------------------------------------
		 * Manifest Document Setup Section
		 * ---------------------------------------------------------------------------------------------
		 */

		// Set the extensions name
		$name =& $this->manifest->getElementByPath('name');
		$name = JFilterInput::clean($name->data(), 'string');
		$installer = new JInstaller(); // we don't want to compromise this instance!
		return $installer->uninstall('library', $name, 0 );
		// ...and adds new files
		return $this->install();
	}
	
	/**
	 * Custom uninstall method
	 *
	 * @access	public
	 * @param	string	$id	The id of the library to uninstall
	 * @param	int		$clientId	The id of the client (unused; libraries are global)
	 * @return	boolean	True on success
	 * @since	1.5
	 */
	function uninstall($id, $clientId )
	{
		// Initialize variables
		$row	= null;
		$retval = true;
		$manifestFile = LIBRARY_MANIFEST_PATH . DS . $id .'.xml'; 

		// Because libraries may not have their own folders we cannot use the standard method of finding an installation manifest
		if (file_exists($manifestFile))
		{
			$manifest = new JLibraryManifest($manifestFile);
			// Set the plugin root path
			$this->parent->setPath('extension_root', JPATH_ROOT.DS.'libraries'.DS.$manifest->libraryname);
			
			$xml =& JFactory::getXMLParser('Simple');

			// If we cannot load the xml file return null
			if (!$xml->loadFile($manifestFile)) {
				JError::raiseWarning(100, JText::_('Library').' '.JText::_('Uninstall').': '.JText::_('Could not load manifest file'));
				return false;
			}

			/*
			 * Check for a valid XML root tag.
			 * @todo: Remove backwards compatability in a future version
			 * Should be 'install', but for backward compatability we will accept 'mosinstall'.
			 */
			$root =& $xml->document;
			if ($root->name() != 'install' && $root->name() != 'mosinstall') {
				JError::raiseWarning(100, JText::_('Library').' '.JText::_('Uninstall').': '.JText::_('Invalid manifest file'));
				return false;
			}

			$this->parent->removeFiles($root->getElementByPath('files'), -1);
			JFile::delete($manifestFile);

		} else {
			JError::raiseWarning(100, 'Library Uninstall: Manifest File invalid or not found');
			return false;
		}

		// TODO: Change this so it walked up the path backwards so we clobber multiple empties
		// If the folder is empty, let's delete it
		if(JFolder::exists($this->parent->getPath('extension_root'))) {
			if(is_dir($this->parent->getPath('extension_root'))) {
				$files = JFolder::files($this->parent->getPath('extension_root'));
				if (!count($files)) {
					JFolder::delete($this->parent->getPath('extension_root'));
				}
			}
		}

		return $retval;
	}

}

if(!class_exists('JLibraryManifest')) {
	class JLibraryManifest extends JObject {
		
		var $name = '';
		var $libraryname = '';
		var $url = '';
		var $description = '';
		var $packager = '';
		var $packagerurl = '';
		var $update = '';
		var $version = '';
		var $filelist = Array();
		var $manifest_file = '';
		
		function __construct($xmlpath='') {
			if(strlen($xmlpath)) $this->loadManifestFromXML($xmlpath);
		}
		
		function loadManifestFromXML($xmlfile) {
			$this->manifest_file = JFile::stripExt(basename($xmlfile));
			$xml = JFactory::getXMLParser('Simple');
			if(!$xml->loadFile($xmlfile)) {
				$this->_errors[] = 'Failed to load XML File: ' . $xmlfile;
				return false;
			} else {
				$xml = $xml->document;
				$this->name = $xml->name[0]->data();
				$this->libraryname = $xml->libraryname[0]->data();
				$this->update = $xml->update[0]->data();
				$this->url = $xml->url[0]->data();
				$this->description = $xml->description[0]->data();
				$this->packager = $xml->packager[0]->data();
				$this->packagerurl = $xml->packagerurl[0]->data();
				$this->version = $xml->version[0]->data();
				if(isset($xml->files[0]->file) && count($xml->files[0]->file)) {
					foreach($xml->files[0]->file as $file) {
						$this->filelist[] = $file->data();
					}
				}
				return true;
			}
		}
	}
}