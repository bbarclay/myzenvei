<?php
/**
 * @version     $Id$ 2.0.9 0
 * @package     Joomla
 * @copyright   Copyright (C) 2005 - 2008 Open Source Matters. All rights reserved.
 * @license     GNU/GPL, see LICENSE.php
 *
 * added/fixed in version 2.0.1
 * - removed unnecesary initialization of $artio variable
 *
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

// function called when the component is uninstalled
function com_uninstall() {

	// import joomla clases to manage file system
	jimport('joomla.filesystem.file');

	// delete joomfish contentelements
	$aicontactsafe_contactinformations = JPath::clean(JPATH_ROOT.DS.'administrator'.DS.'components'.DS.'com_joomfish'.DS.'contentelements'.DS.'aicontactsafe_contactinformations.xml');
	if (is_file($aicontactsafe_contactinformations)) {
		JFile::delete($aicontactsafe_contactinformations);
	}
	$aicontactsafe_fields = JPath::clean(JPATH_ROOT.DS.'administrator'.DS.'components'.DS.'com_joomfish'.DS.'contentelements'.DS.'aicontactsafe_fields.xml');
	if (is_file($aicontactsafe_fields)) {
		JFile::delete($aicontactsafe_fields);
	}
	$aicontactsafe_profiles = JPath::clean(JPATH_ROOT.DS.'administrator'.DS.'components'.DS.'com_joomfish'.DS.'contentelements'.DS.'aicontactsafe_profiles.xml');
	if (is_file($aicontactsafe_profiles)) {
		JFile::delete($aicontactsafe_profiles);
	}

	// delete artio plugin
	$com_aicontactsafe = JPath::clean(JPATH_ROOT.DS.'components'.DS.'com_sef'.DS.'sef_ext'.DS.'com_aicontactsafe.php');
	if (is_file($com_aicontactsafe)) {
		JFile::delete($com_aicontactsafe);
	}
	$com_aicontactsafe = JPath::clean(JPATH_ROOT.DS.'components'.DS.'com_sef'.DS.'sef_ext'.DS.'com_aicontactsafe.xml');
	if (is_file($com_aicontactsafe)) {
		JFile::delete($com_aicontactsafe);
	}

?>
	<div class="header">
		aiContactSafe is now removed from your web page.
	</div><br/>
	<br/>
	If you didn't use the command from Control Panel to remove the tables, you will be able to install it again and use the old records.<br/>
	<br/>
	If you want to completely remove aiContactSafe, install it again, use the command from Control Panel to remove aiContactSafe tables and then uninstall it again.<br/>
	<br/>
	<br/>
<?php
}
?>
