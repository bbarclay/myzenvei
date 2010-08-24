<?php
/**
 * Install File
 * Does the stuff for the specific extensions
 *
 * @package     AdminBar Docker
 * @version     1.1.1
 *
 * @author      Peter van Westen <peter@nonumber.nl>
 * @link        http://www.nonumber.nl
 * @copyright   Copyright (C) 2010 NoNumber! All Rights Reserved
 * @license     http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 */

// No direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

$name = 'AdminBar Docker';
$alias = 'adminbardocker';
$ext = $name.' (system plugin)';

// SYSTEM PLUGIN
$states[] = installExtension( $alias, 'System - '.$name, 'plugin', array( 'folder'=>'system' ) );