<?php
/**
* @copyright    Copyright (C) 2009 Nicholas K. Dionysopoulos. All rights reserved.
* @author		Nicholas K. Dionysopoulos
* @license      GNU/GPL v.2 or later
* K2Links is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
*
* Based on "joomlalinks" found in JCE's core distribution. Modified by Nicholas K. Dionysopoulos
* to support JoomlaWork's K2
*/
// no direct access
defined( '_JCE_EXT' ) or die( 'Restricted access' );

// Core function	
function k2links(&$advlink)
{
	// Joomla! file and folder processing functions
	jimport('joomla.filesystem.folder');
	jimport('joomla.filesystem.file');
		
	// Base path for corelinks files
	$path = dirname(__FILE__) .DS. 'k2links';	
		
	// Get all files
	$files = JFolder::files($path, '\.(php)$');	
	
	$items = array();
	
	// For AdvLink link plugins
	if (isset($files)) {
		foreach ($files as $file) {
			$items[] = array(
				'name'		=> JFile::stripExt($file),
				'path' 		=> $path,
				'file' 		=> $file
			);
		}
	}
	return $items;
}	
?>