<?php
//no direct access
defined('_JEXEC') or die('Direct Access to this location is not allowed.');

// Path assignments
$mosConfig_absolute_path = JPATH_SITE;
$mosConfig_live_site = JURI :: base();
if(substr($mosConfig_live_site, -1)=="/") { $mosConfig_live_site = substr($mosConfig_live_site, 0, -1); }
 
// get parameters from the module's configuration
$enablejQuery = $params->get('enablejQuery','1');
$moduleWidth = $params->get('moduleWidth','500');
$moduleHeight = $params->get('moduleHeight','136'); $controlPositon = ($moduleHeight - 32) / 2;
$carouselImagesPath = $params->get('imageFolder','images/stories');
$imageNumber = $params->get('imageNumber','3');
$imageWidth = $params->get('imageWidth','145');
$imageHeight = $params->get('imageHeight','128');
$imageMargin = $params->get('imageMargin','10'); $imageMarginReal = $imageMargin / 2;
$imagePadding = $params->get('imagePadding','2');
$imageBorderWidth = $params->get('imageBorderWidth','2');
$imageBorderColor = $params->get('imageBorderColor','000000');
$carouselPagination = $params->get('carouselPagination','false');
$carouselAutoSlide = $params->get('carouselAutoSlide','false');
$carouselAutoSlideInterval = $params->get('carouselAutoSlideInterval','3000');
$carouselEffect = $params->get('carouselEffect','slide');
$carouselAnimSpeed = $params->get('carouselAnimSpeed','normal');
$carouselDirection = $params->get('carouselDirection','horizontal');
$carouselLoop = $params->get('carouselLoop','false');

require(JModuleHelper::getLayoutPath('mod_hot_joomla_carousel'));
