<?php
/**
 * GAnalytics is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * GAnalytics is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with GAnalytics.  If not, see <http://www.gnu.org/licenses/>.
 *
 * @author Allon Moritz
 * @copyright 2007-2010 Allon Moritz
 * @version $Revision: 0.6.1 $
 */

defined( '_JEXEC' ) or die( 'Restricted access' );

require_once(JPATH_COMPONENT.DS.'controller.php');
require_once(JPATH_ADMINISTRATOR.DS.'components'.DS.'com_ganalytics'.DS.'util'.DS.'util.php');
require_once(JPATH_ADMINISTRATOR.DS.'components'.DS.'com_ganalytics'.DS.'util'.DS.'dbutil.php');
require_once(JPATH_ADMINISTRATOR.DS.'components'.DS.'com_ganalytics'.DS.'util'.DS.'listutil.php');
if (file_exists(JPATH_ADMINISTRATOR.DS.'components'.DS.'com_ganalytics'.DS.'util'.DS.'proutil.php')) {
	require_once (JPATH_ADMINISTRATOR.DS.'components'.DS.'com_ganalytics'.DS.'util'.DS.'proutil.php');
}
if (file_exists(JPATH_ADMINISTRATOR.DS.'components'.DS.'com_ganalytics'.DS.'util'.DS.'chartutil.php')) {
	require_once (JPATH_ADMINISTRATOR.DS.'components'.DS.'com_ganalytics'.DS.'util'.DS.'chartutil.php');
}
jimport('simplepie.simplepie');
require_once( JPATH_ADMINISTRATOR.DS.'components'.DS.'com_ganalytics'.DS.'libraries'.DS.'sp-ganalytics'.DS.'simplepie-ganalytics.php' );

if($controller = JRequest::getWord('controller')) {
	$path = JPATH_COMPONENT.DS.'controllers'.DS.$controller.'.php';
	if (file_exists($path)) {
		require_once $path;
	} else {
		$controller = '';
	}
}

$classname	= 'GAnalyticsController'.$controller;
$controller	= new $classname( );

$controller->execute( JRequest::getVar( 'task' ) );

$controller->redirect();
?>