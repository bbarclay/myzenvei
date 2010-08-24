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

$plugin =& JPluginHelper::getPlugin('hwdvs-template', 'joomla');
$pluginParams = new JParameter( $plugin->params );
$hwdvsTemplateOverride['thumbWidth1'] = $pluginParams->def( 'thumbWidth1', '120' );
$hwdvsTemplateOverride['thumbWidth2'] = $pluginParams->def( 'thumbWidth2', '120' );
$hwdvsTemplateOverride['thumbWidth3'] = $pluginParams->def( 'thumbWidth3', '120' );
$hwdvsTemplateOverride['thumbWidth4'] = $pluginParams->def( 'thumbWidth4', '120' );
$hwdvsTemplateOverride['thumbWidth5'] = $pluginParams->def( 'thumbWidth5', '120' );
$hwdvsTemplateOverride['thumbWidth6'] = $pluginParams->def( 'thumbWidth6', '120' );
$hwdvsTemplateOverride['thumbWidth7'] = $pluginParams->def( 'thumbWidth7', '50' );
$hwdvsTemplateOverride['thumbWidth8'] = $pluginParams->def( 'thumbWidth8', '50' );
$hwdvsTemplateOverride['thumbWidth9'] = $pluginParams->def( 'thumbWidth9', '50' );
$hwdvsTemplateOverride['beingWatchNow'] = $pluginParams->def( 'beingWatchNow', '3' );
$hwdvsTemplateOverride['vpr'] = $pluginParams->def( 'vpr', '3' );
$hwdvsTemplateOverride['cpr'] = $pluginParams->def( 'cpr', '3' );
$hwdvsTemplateOverride['gpr'] = $pluginParams->def( 'gpr', '2' );
$hwdvsTemplateOverride['hideSubcats'] = $pluginParams->def( 'hideSubcats', '0' );
$hwdvsTemplateOverride['loadCarousel'] = 1;

$template_folder = $mainframe->getUserState( "com_hwdvideoshare.template_folder", '' );
$template_element = $mainframe->getUserState( "com_hwdvideoshare.template_element", '' );
if (!empty($template_folder) && !empty($template_element)) {

	$c->hwdvids_template_path = $template_folder;
	$c->hwdvids_template_file = $template_element;

}
$mainframe->addCustomHeadTag('<link rel="stylesheet" href="'.JURI::root( true ).'/plugins/hwdvs-template/'.$c->hwdvids_template_file.'/template.css" type="text/css" />');
$mainframe->addCustomHeadTag('<link rel="stylesheet" href="'.JURI::root( true ).'/plugins/hwdvs-template/'.$c->hwdvids_template_file.'/css/rating.css" type="text/css" />');

$smartyvs->assign("vpr", $hwdvsTemplateOverride['vpr']);
$smartyvs->assign("gpr", $hwdvsTemplateOverride['gpr']);
$smartyvs->assign("cpr", $hwdvsTemplateOverride['cpr']);

if ($hwdvsTemplateOverride['hideSubcats'] == "1") {
	$smartyvs->assign("hideSubcats", 1);
} else {
	$smartyvs->assign("hideSubcats", 0);
}

$psvboxwidth = intval(100/$hwdvsTemplateOverride['vpr'])-2;
$psgboxwidth = intval(100/$hwdvsTemplateOverride['gpr'])-2;
$pscboxwidth = intval(100/$hwdvsTemplateOverride['cpr'])-2;

if ($c->frontpage_viewed == "today") {
	$title_mostviewed = _HWDVIDS_MVTD;
} else if ($c->frontpage_viewed == "thisweek") {
	$title_mostviewed = _HWDVIDS_MVTW;
} else if ($c->frontpage_viewed == "thismonth") {
	$title_mostviewed = _HWDVIDS_MVTM;
} else if ($c->frontpage_viewed == "alltime") {
	$title_mostviewed = _HWDVIDS_MVAT;
} else {
	$title_mostviewed = '92';
}

if ($c->frontpage_favoured == "today") {
	$title_mostfavoured = _HWDVIDS_MFTD;
} else if ($c->frontpage_favoured == "thisweek") {
	$title_mostfavoured = _HWDVIDS_MFTW;
} else if ($c->frontpage_favoured == "thismonth") {
	$title_mostfavoured = _HWDVIDS_MFTM;
} else if ($c->frontpage_favoured == "alltime") {
	$title_mostfavoured = _HWDVIDS_MFAT;
} else {
	$title_mostfavoured = '92';
}

if ($c->frontpage_popular == "today") {
	$title_mostpopular = _HWDVIDS_MPTD;
} else if ($c->frontpage_popular == "thisweek") {
	$title_mostpopular = _HWDVIDS_MPTW;
} else if ($c->frontpage_popular == "thismonth") {
	$title_mostpopular = _HWDVIDS_MPTM;
} else if ($c->frontpage_popular == "alltime") {
	$title_mostpopular = _HWDVIDS_MPAT;
} else {
	$title_mostpopular = '92';
}

jimport('joomla.html.pane');
//global $task;
//if ($task == "viewcategory") {
//	$pane =& JPane::getInstance('tabs', array('startOffset'=>1));
//} else {
	$pane =& JPane::getInstance('tabs');
//}
$startpane = $pane->startPane( 'hwd-pane' );
$endtab = $pane->endPanel();
$endpane = $pane->endPane();
$starttab1 = $pane->startPanel(_HWDVIDS_RECENT, 'panel1' );
$starttab2 = $pane->startPanel($title_mostviewed, 'panel2' );
$starttab3 = $pane->startPanel($title_mostfavoured, 'panel3' );
$starttab4 = $pane->startPanel($title_mostpopular, 'panel4' );
$starttab5 = $pane->startPanel(_HWDVIDS_VIDEOS, 'panel5' );
$starttab6 = $pane->startPanel(_HWDVIDS_SUBCATS, 'panel6' );
$starttab7 = $pane->startPanel(_HWDVIDS_TITLE_MOREBYUSR, 'panel6' );
$starttab8 = $pane->startPanel(_HWDVIDS_RELATED, 'panel8' );
$starttab9 = $pane->startPanel(_HWDVIDS_MORECATVIDS, 'panel9' );
/** assign template variables **/
$smartyvs->assign( "startpane", $startpane );
$smartyvs->assign( "endtab", $endtab );
$smartyvs->assign( "endpane", $endpane );
$smartyvs->assign( "starttab1", $starttab1 );
$smartyvs->assign( "starttab2", $starttab2 );
$smartyvs->assign( "starttab3", $starttab3 );
$smartyvs->assign( "starttab4", $starttab4 );
$smartyvs->assign( "starttab5", $starttab5 );
$smartyvs->assign( "starttab6", $starttab6 );
$smartyvs->assign( "starttab7", $starttab7 );
$smartyvs->assign( "starttab8", $starttab8 );
$smartyvs->assign( "starttab9", $starttab9 );

$var = "<style type=\"text/css\">

		#hwdvs_navcontainer ul li, #hwdvids ul.tabbernav, #hwdvids ul.tabbernav li {
			list-style-image: url('".JURI::root( true )."/images/blank.png') no-repeat top center!important;
			background-image: url('".JURI::root( true )."/images/blank.png') no-repeat top center!important;
			background: url('".JURI::root( true )."/images/blank.png') no-repeat top center!important;
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