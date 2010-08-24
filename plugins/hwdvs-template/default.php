<?php
/**
 *    @version [ Dannevirke ]
 *    @package hwdVideoShare
 *    @copyright (C) 2007 - 2009 Highwood Design
 *    @license Creative Commons Attribution-Non-Commercial-No Derivative Works 3.0 Unported Licence
 *    @license http://creativecommons.org/licenses/by-nc-nd/3.0/
 */
defined( '_JEXEC' ) or die( 'Direct Access to this location is not allowed.' );

global $print_ulink, $print_glink, $mainframe, $smartyvs, $hwdvsTemplateOverride;
$c = hwd_vs_Config::get_instance();

$plugin =& JPluginHelper::getPlugin('hwdvs-template', 'default');
$pluginParams = new JParameter( $plugin->params );
$hwdvsTemplateOverride['thumbWidth1'] = $pluginParams->def( 'thumbWidth1', '120' );
$hwdvsTemplateOverride['thumbWidth2'] = $pluginParams->def( 'thumbWidth2', '60' );
$hwdvsTemplateOverride['thumbWidth3'] = $pluginParams->def( 'thumbWidth3', '60' );
$hwdvsTemplateOverride['thumbWidth4'] = $pluginParams->def( 'thumbWidth4', '60' );
$hwdvsTemplateOverride['thumbWidth5'] = $pluginParams->def( 'thumbWidth5', '120' );
$hwdvsTemplateOverride['thumbWidth6'] = $pluginParams->def( 'thumbWidth6', '90' );
$hwdvsTemplateOverride['thumbWidth7'] = $pluginParams->def( 'thumbWidth7', '50' );
$hwdvsTemplateOverride['thumbWidth8'] = $pluginParams->def( 'thumbWidth8', '50' );
$hwdvsTemplateOverride['thumbWidth9'] = $pluginParams->def( 'thumbWidth9', '50' );
$hwdvsTemplateOverride['beingWatchNow'] = $pluginParams->def( 'beingWatchNow', '2' );
$hwdvsTemplateOverride['vpr'] = $pluginParams->def( 'vpr', '3' );
$hwdvsTemplateOverride['cpr'] = $pluginParams->def( 'cpr', '2' );
$hwdvsTemplateOverride['gpr'] = $pluginParams->def( 'gpr', '1' );
$hwdvsTemplateOverride['playerAlign'] = $pluginParams->def( 'playerAlign', 'L' );
$hwdvsTemplateOverride['hideSubcats'] = $pluginParams->def( 'hideSubcats', '0' );
$hwdvsTemplateOverride['loadCarousel'] = 1;

$nav_width = null;
if ($c->diable_nav_videos == "0") {$nav_width = $nav_width + 102;}
if ($c->diable_nav_catego == "0") {$nav_width = $nav_width + 102;}
if ($print_glink) {$nav_width = $nav_width + 102;}
if ($print_ulink) {$nav_width = $nav_width + 102;}

$template_folder = $mainframe->getUserState( "com_hwdvideoshare.template_folder", '' );
$template_element = $mainframe->getUserState( "com_hwdvideoshare.template_element", '' );

if (!empty($template_folder) && !empty($template_element)) {

	$c->hwdvids_template_path = $template_folder;
	$c->hwdvids_template_file = $template_element;

}
if (empty($c->hwdvids_template_file)) { $c->hwdvids_template_file = "default"; }
$mainframe->addCustomHeadTag('<link rel="stylesheet" href="'.JURI::root( true ).'/plugins/hwdvs-template/'.$c->hwdvids_template_file.'/template.css" type="text/css" />');
$mainframe->addCustomHeadTag('<link rel="stylesheet" href="'.JURI::root( true ).'/plugins/hwdvs-template/'.$c->hwdvids_template_file.'/css/rating.css" type="text/css" />');

$smartyvs->assign("vpr", $hwdvsTemplateOverride['vpr']);
$smartyvs->assign("gpr", $hwdvsTemplateOverride['gpr']);
$smartyvs->assign("cpr", $hwdvsTemplateOverride['cpr']);
$smartyvs->assign("hideSubcats", 1);

if ($hwdvsTemplateOverride['hideSubcats'] == "1") {
	$smartyvs->assign("hideSubcats", 1);
} else {
	$smartyvs->assign("hideSubcats", 0);
}

if ($hwdvsTemplateOverride['playerAlign'] == "C") {
	$smartyvs->assign("playerAlign", "C");
} else if ($hwdvsTemplateOverride['playerAlign'] == "R") {
	$smartyvs->assign("playerAlign", "R");
} else  {
	$smartyvs->assign("playerAlign", "L");
}

$psvboxwidth = intval(100/$hwdvsTemplateOverride['vpr'])-2;
$psgboxwidth = intval(100/$hwdvsTemplateOverride['gpr'])-2;
$pscboxwidth = intval(100/$hwdvsTemplateOverride['cpr'])-2;

$var = "<style type=\"text/css\">
		#hwdvs_navcontainer
		{
			width: ".$nav_width."px;
		}

		#hwdvs_navcontainer ul li, #hwdvs_navcontainer ul, #hwdvids ul.tabbernav, #hwdvids ul.tabbernav li {
			list-style-image: url('".JURI::root( true )."/images/blank.png')!important;
			background-image: url('".JURI::root( true )."/images/blank.png')!important;
		}

		#hwdvs_navcontainer ul li
		{
			background: url('".JURI::root( true )."/plugins/hwdvs-template/".$c->hwdvids_template_file."/images/button_nav_off.png') no-repeat top center!important;
		}

		#hwdvs_navcontainer li#active
		{
			background: url('".JURI::root( true )."/plugins/hwdvs-template/".$c->hwdvids_template_file."/images/button_nav_on.png') no-repeat top center!important;
		}

		#hwdvs_navcontainer ul li:hover
		{
			background: url('".JURI::root( true )."/plugins/hwdvs-template/".$c->hwdvids_template_file."/images/button_nav_hover.png') no-repeat top center!important;
		}

		#hwdvids .box
		{
			background: transparent url('".JURI::root( true )."/images/blank.png') no-repeat top center!important;
		}

		#hwdvids .videoBox {
			width: ".$psvboxwidth ."%;
			float:left;
		}
		#hwdvids .groupBox {
			width: ".$psgboxwidth ."%;
			float:left;
		}
		#hwdvids .categoryBox {
			width: ".$pscboxwidth ."%;
			float:left;
		}

</style>";
$mainframe->addCustomHeadTag($var);
return;
?>