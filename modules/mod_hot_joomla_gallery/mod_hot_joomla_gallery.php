<?php
//no direct access
defined('_JEXEC') or die('Direct Access to this location is not allowed.');

// Path assignments
$mosConfig_absolute_path = JPATH_SITE;
$mosConfig_live_site = JURI :: base();
if(substr($mosConfig_live_site, -1)=="/") { $mosConfig_live_site = substr($mosConfig_live_site, 0, -1); }
 
// get parameters from the module's configuration
$enablejQuery = $params->get('enablejQuery','1');

$imageFolder = $params->get('imageFolder','images/stories/fruit');
$bigImageWidth = $params->get('bigImageWidth','300');
$bigImageHeight = $params->get('bigImageHeight','200');
$userInput = $params->get('userInput','');
$thumbsNumber = $params->get('thumbsNumber','3');
$thumbsSize = $params->get('thumbsSize','20');
$timerValue = $params->get('timerValue','3500');

$galleryBackground = $params->get('galleryBackground','000000');
$galleryBorder = $params->get('galleryBorder','6');
$galleryBorderColor = $params->get('galleryBorderColor','cccccc');

$thumbBorderColor = $params->get('thumbBorderColor','cccccc');
$activeThumbBorderColor = $params->get('activeThumbBorderColor','ffffff');
$bigImageBorder = $params->get('bigImageBorder','0');
$bigImageBorderColor = $params->get('bigImageBorderColor','cccccc');
$descTextBackground = $params->get('descTextBackground','000000');
$descTextColor = $params->get('descTextColor','ffffff');

require(JModuleHelper::getLayoutPath('mod_hot_joomla_gallery'));
