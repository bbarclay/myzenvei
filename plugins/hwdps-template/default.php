<?php
/**
 *    @version [ Accetto ]
 *    @package hwdPhotoShare
 *    @copyright (C) 2007 - 2009 Highwood Design
 *    @license Creative Commons Attribution-Non-Commercial-No Derivative Works 3.0 Unported Licence
 *    @license http://creativecommons.org/licenses/by-nc-nd/3.0/
 */
defined( '_JEXEC' ) or die( 'Direct Access to this location is not allowed.' );

global $print_ulink, $print_glink, $mainframe, $smartyps, $hwdpsTemplateOverride;
$c = hwd_ps_Config::get_instance();

$plugin =& JPluginHelper::getPlugin('hwdps-template', 'default');
$pluginParams = new JParameter( $plugin->params );
$hwdvsTemplateOverride['ppr'] = $pluginParams->def( 'ppr', '3' );
$hwdvsTemplateOverride['apr'] = $pluginParams->def( 'apr', '2' );
$hwdvsTemplateOverride['cpr'] = $pluginParams->def( 'cpr', '2' );
$hwdvsTemplateOverride['gpr'] = $pluginParams->def( 'gpr', '1' );
$hwdvsTemplateOverride['hideSubcats'] = $pluginParams->def( 'hideSubcats', '0' );

if (empty($c->hwdvids_template_file)) { $c->hwdvids_template_file = "default"; }
$mainframe->addCustomHeadTag('<link rel="stylesheet" href="'.JURI::root( true ).'/plugins/hwdps-template/'.$c->hwdvids_template_file.'/template.css" type="text/css" />');
$mainframe->addCustomHeadTag('<link rel="stylesheet" href="'.JURI::root( true ).'/plugins/hwdps-template/'.$c->hwdvids_template_file.'/css/rating.css" type="text/css" />');

$nav_width = null;
if ($c->disable_nav_explor == "0") {$nav_width = $nav_width + 102;}
if ($c->disable_nav_catego == "0") {$nav_width = $nav_width + 102;}
if ($c->disable_nav_groups == "0") {$nav_width = $nav_width + 102;}
if ($c->disable_nav_upload == "0") {$nav_width = $nav_width + 102;}

$smartyps->assign("ppr", $hwdvsTemplateOverride['ppr']);
$smartyps->assign("apr", $hwdvsTemplateOverride['apr']);
$smartyps->assign("cpr", $hwdvsTemplateOverride['cpr']);
$smartyps->assign("gpr", $hwdvsTemplateOverride['gpr']);
$smartyps->assign("hideSubcats", $hwdvsTemplateOverride['hideSubcats']);

$psthumbsize = intval($c->resize_thumb)+10;
$psmainsize = intval($c->resize_main)+12;

$pspboxwidth = intval(100/$hwdvsTemplateOverride['ppr']);
$psaboxwidth = intval(100/$hwdvsTemplateOverride['apr']);
$pscboxwidth = intval(100/$hwdvsTemplateOverride['cpr']);
$psgboxwidth = intval(100/$hwdvsTemplateOverride['gpr']);

$var = "<style type=\"text/css\">
		#hwdps_navcontainer
		{
			width: ".$nav_width."px;
		}

		#hwdps_navcontainer ul li, #hwdps_navcontainer ul, #hwdps ul.tabbernav, #hwdps ul.tabbernav li
		{
			list-style-image: url('".JURI::root( true )."/images/blank.png')!important;
			background-image: url('".JURI::root( true )."/images/blank.png')!important;
		}

		#hwdps_navcontainer ul li
		{
			background: url('".JURI::root( true )."/plugins/hwdps-template/".$c->hwdvids_template_file."/images/button_nav_off.png') no-repeat top center!important;
		}

		#hwdps_navcontainer li#active
		{
			background: url('".JURI::root( true )."/plugins/hwdps-template/".$c->hwdvids_template_file."/images/button_nav_on.png') no-repeat top center!important;
		}

		#hwdps_navcontainer ul li:hover
		{
			background: url('".JURI::root( true )."/plugins/hwdps-template/".$c->hwdvids_template_file."/images/button_nav_hover.png') no-repeat top center!important;
		}

		#hwdps .box
		{
			background: transparent url('".JURI::root( true )."/images/blank.png') no-repeat top center!important;
		}

		#hwdps .photoBox {
			width: ".$pspboxwidth ."%;
		}

		#hwdps .albumBox {
			width: ".$psaboxwidth ."%;
			float:left;
		}

		#hwdps .groupBox {
			width: ".$psgboxwidth ."%;
		}

		#hwdps .categoryBox {
			width: ".$pscboxwidth ."%;
			float:left;
		}

		#hwdps .photoContainer-v {
			height: ".$psthumbsize."px;
			line-height: ".$psthumbsize."px;
			width: ".$psthumbsize."px;
		}

		#hwdps .photoContainer-h {
			width: ".$psthumbsize."px;
		}

		#hwdps .sic-center {
			width: ".$psmainsize."px;
		}

</style>";
$mainframe->addCustomHeadTag($var);
return;
?>
