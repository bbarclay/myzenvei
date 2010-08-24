<?php
/**
 * @version		$Id: mod_aamenu.php 67 2009-05-29 13:02:32Z eddieajau $
 * @package		TAOJ.AAMenu
 * @subpackage	mod_aamenu
 * @copyright	Copyright (C) 2005 - 2008 Open Source Matters. All rights reserved.
 * @copyright	Copyright (C) 2009 New Life in IT Pty Ltd. All rights reserved.
 * @license		GNU General Public License <http://www.gnu.org/copyleft/gpl.html>
 * @link		http://www.theartofjoomla.com
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

require_once(dirname(__FILE__).DS.'helper.php');

// We need to add these support files in from the Khepri template
JHtml::script('menu.js', 'administrator/templates/khepri/js/');
JHtml::script('index.js', 'administrator/templates/khepri/js/');

$hide	= JRequest::getInt('hidemainmenu');

if ($hide) {
	modAAMenuHelper::buildDisabledMenu();
}
else {
	modAAMenuHelper::buildMenu();
}
