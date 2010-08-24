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

// declare global variables
global $limitstart, $limit, $mainframe, $cid;

// get general configuration data
require_once( $mainframe->getPath( 'class' ) );
require_once( $mainframe->getPath( 'admin_html' ) );
require_once(JPATH_SITE.DS.'administrator'.DS.'components'.DS.'com_hwdphotoshare'.DS.'config.hwdphotoshare.php');
require_once(JPATH_SITE.DS.'administrator'.DS.'components'.DS.'com_hwdphotoshare'.DS.'helpers'.DS.'js.php');
require_once(JPATH_SITE.DS.'administrator'.DS.'components'.DS.'com_hwdphotoshare'.DS.'helpers'.DS.'access.php');
require_once(JPATH_SITE.DS.'administrator'.DS.'components'.DS.'com_hwdphotoshare'.DS.'helpers'.DS.'initialise.php');
require_once(JPATH_SITE.DS.'administrator'.DS.'components'.DS.'com_hwdphotoshare'.DS.'libraries'.DS.'file_management.class.php');

$c           = hwd_ps_Config::get_instance();
$db          = & JFactory::getDBO();
$my          = & JFactory::getUser();
$acl         = & JFactory::getACL();
$limit       = $mainframe->getUserStateFromRequest("viewlistlimit", 'limit', 10);
$limitstart  = $mainframe->getUserStateFromRequest("viewlimitstart", 'limitstart', 0);
$task        = JRequest::getCmd( 'task', 'frontpage' );

$request_array = JRequest::get( 'request' );
@$cid 	= $request_array['cid'];

hwdpsInitialise::language('be');
if (!hwdpsInitialise::template(false)) {return;}
hwdpsInitialise::mysqlQuery();
hwdpsInitialise::definitions();

jimport('joomla.html.pagination');

$db->SetQuery( "SELECT value FROM #__hwdpsgs WHERE setting = \"initialise_now\"" );
$c->initialise_now = $db->loadResult();
echo $db->getErrorMsg();

// check for initialisation request
if ( $c->initialise_now == "1" && $task !== "initialise_now" ) {
	hwd_ps_HTML::initialise($option);
	return;
} else if ( $c->initialise_now == "1" && $task == "initialise_now" ) {
	hwdpsInitialise::initialiseSetup();
	return;
}

// Require the base controller
require_once (JPATH_COMPONENT.DS.'controller.php');

// Create the controller
$controller	= new UsersController( );

// Perform the Request task
$controller->execute( $task );
$controller->redirect();

?>