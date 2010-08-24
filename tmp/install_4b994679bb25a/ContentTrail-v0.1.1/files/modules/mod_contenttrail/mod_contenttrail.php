<?php
/**
 * @author     GeoXeo <contact@geoxeo.com>
 * @link       http://www.geoxeo.com
 * @copyright  Copyright (C) 2010 GeoXeo - All Rights Reserved
 * @license    http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 * 
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

require_once (dirname(__FILE__).DS.'helper.php');

// Get the breadcrumbs
$list	= modContentTrailHelper::getList($params);
$count	= count($list);

// Set the default separator
$separator = modContentTrailHelper::setSeparator( $params->get( 'separator' ));

require(JModuleHelper::getLayoutPath('mod_contenttrail'));