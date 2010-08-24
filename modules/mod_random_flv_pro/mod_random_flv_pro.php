<?php
/**
/**
*
* @copyright	Inspiration Web Design
* License GNU/GPL
*/


// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

// Include the syndicate functions only once
require_once (dirname(__FILE__).DS.'helper.php');

$folder	= modRandomFLVProHelper::getFolder($params);
$flvs	= modRandomFLVProHelper::getFLVs($params, $folder);

if (!count($flvs)) {
	echo JText::_( 'No flvs ');
	return;
}
$random_flvs = modRandomFLVProHelper::getRandomFLVs($params, $flvs);

$flvlist->path = JURI::base().str_replace('\\','/',$folder);
$flvlist->flvString = implode(",", $random_flvs);
$flvlist->playerHeight = (int) $params->get('playerHeight', '60');
$flvlist->playerMovie = JURI::base() . 'modules/mod_random_flv_pro/assets/'. $params->get('skin', 'flvplayer'). '.swf';
$flvlist->uniq_id = uniqid('flv-');

if ( $params->get('jscriptDetect', 'default') == 'default' )
{
  $flvlist->js = modRandomFLVProHelper::addScripts( $params, $flvlist );
  
  if ( $params->get('autoPopup','no') == 'no')
  {
    require(JModuleHelper::getLayoutPath('mod_random_flv_pro', 'default' ));
  }
}
else
{
  require(JModuleHelper::getLayoutPath('mod_random_flv_pro', 'noscript' ));
}
