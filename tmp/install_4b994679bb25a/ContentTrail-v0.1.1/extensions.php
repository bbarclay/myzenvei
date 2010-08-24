<?php
/**
 * @author     GeoXeo <contact@geoxeo.com>
 * @link       http://www.geoxeo.com
 * @copyright  Copyright (C) 2010 GeoXeo - All Rights Reserved
 * @license    http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 * 
 */


// No direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

$_name = 'Content Trail';
$_alias = 'contenttrail';
$_ext = $_name;


$_states[] = installExtension( $_alias, $_name, 'component', array( 'link'=>'', 'admin_menu_link'=>'' ));
$_states[] = installExtension( $_alias, 'Content - '.$_name, 'plugin', array( 'folder'=>'content' ));
$_states[] = installExtension( $_alias, 'Content Trail', 'module');