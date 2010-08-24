<?php
/*------------------------------------------------------------------------
# ogweb.net All rights reserved.
# ------------------------------------------------------------------------
# Copyright © 2009 ogweb.net. 
# Website:  http://www.ogweb.net/
-------------------------------------------------------------------------*/
// no direct access
defined('_JEXEC') or die('Restricted access'); 

// Include the syndicate functions only once
require_once( dirname(__FILE__).DS.'helper.php' );

$__menu = $params->get( 'mymenu' );
$__maxwidth = $params->get( 'maxwidth' );
$__itemwidth = $params->get( 'itemwidth' );
$__direction = $params->get( 'direction' );
$__menutype = $params->get( 'menutype' );
$__menutheme = $params->get( 'menutheme' );

$document =&JFactory::getDocument();

//***********
//loading css
//***********

$attribs = array('type' => 'text/css', 'class' => 'BodyText', 'rel' => 'nofollow'); 
$document->addHeadLink('modules/mod_imenu/nitobi.fisheye.css', 'stylesheet', 'rel', $attribs);


//**************
//loading script
//**************

//javascript added in tamplate index!!!!! -> $document->addScript('modules/mod_imenu/js/nitobi.toolkit.js');
$document->addScript('modules/mod_imenu/js/nitobi.fisheye.js');

//***********
//menu loader
//***********
$document->addCustomTag('<script type="text/javascript">');
$document->addCustomTag('function init() { ');
$document->addCustomTag("f1 = nitobi.loadComponent('fisheye1');");
$document->addCustomTag('}');
$document->addCustomTag('nitobi.html.attachEvent(window,"load",init);');
$document->addCustomTag('</script>');

//***************
//load menu items
//***************

$_items= modIMenuHelper::getMenuItems($__menu);
require(JModuleHelper::getLayoutPath('mod_imenu'));

?>

