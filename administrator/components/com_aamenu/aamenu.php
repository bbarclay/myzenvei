<?php
/**
 * @version		$Id: aamenu.php 96 2009-06-04 11:52:30Z eddieajau $
 * @package		TAOJ.AAMenu
 * @subpackage	com_aamenu
 * @copyright	Copyright (C) 2009 New Life in IT Pty Ltd. All rights reserved.
 * @license		GNU General Public License <http://www.gnu.org/copyleft/gpl.html>
 * @link		http://www.theartofjoomla.com
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

// PHP 5 check
if (version_compare(PHP_VERSION, '5.0.0', '>'))
{
	if (!function_exists('jximport')) {
		require_once JPATH_COMPONENT.DS.'libraries'.DS.'jxtended.php';
	}

	// Include dependancies
	jximport('jxtended.application.component.controller');

	require_once JPATH_COMPONENT.DS.'version.php';

	$controller	= JxController::getInstance('Menu');
	$controller->execute(JRequest::getCmd('task'));
	$controller->redirect();

	// Display the copyright notice and version
	$version = new MenuVersion;

	echo '<div id="nlitcopy">Advanced Administrator Menu - Version '.$version->version.'.'.$version->subversion.':'.$version->getBuild().' '.$version->status.' &copy; 2009 <a href="http://www.newlifeinit.com" target="_blank">New Life in IT Pty Ltd</a>.' .
			' All rights reserved</div>';
}
else {
    JError::raiseWarning(500, JText::_('TAOJ_Use_PHP5'));
}
