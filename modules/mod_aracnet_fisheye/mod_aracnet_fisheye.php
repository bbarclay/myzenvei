<?php

/**
* Module AracNet iFishEye Menu For Joomla 1.5
* Version: 1.1
* Created by: Alejandro Malo
* Email: soporte@aracnet.com.mx
* Created on: 30 May 2008
* 
* URL: www.aracnet.com.mx
* License http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Based on iFishEye (http://zendold.lojcomm.com.br/ifisheye/) by Fabio Zendhi Nagao
*/

/** ensure this file is being included by a parent file */
defined('_JEXEC') or die('Restricted access');

global $mainframe;

// Add CSS and Javascript required files
$document =& JFactory::getDocument();
$document->addScript( JURI::base() . 'media/system/js/mootools.js');
$document->addScript( JURI::base() . 'modules/mod_aracnet_fisheye/assets/iFishEye.js');
if ($params->get('menu_css', 1)) {
	$document->addStyleSheet(JURI::base() . 'modules/mod_aracnet_fisheye/assets/iFishEye.css');
}

// Add Javascript iFishEye initializer
$sd = 'var Page = {
	initialize: function() {
		new iFishEye({
		container: $("iFishEye"),blankPath: "modules/mod_aracnet_fisheye/images/blank.gif",';
		if ($params->get('menu_dimthumb') != '64') {
			$sd .= 'dimThumb: {width:'.$params->get('menu_dimthumb').', height:'.$params->get('menu_dimthumb').'},';
		}
		if ($params->get('menu_dimfocus') != '128') {
			$sd .= 'dimFocus: {width:'.$params->get('menu_dimfocus').', height:'.$params->get('menu_dimfocus').'},';
		}
		if ($params->get('menu_radius') != '128') {
			$sd .= 'eyeRadius: '.$params->get('menu_radius').',';
		}
		if ($params->get('menu_axis') != 'x') {
			$sd .= 'useAxis: "y",';
		} 
		$sd .= 'norm: "L2"
		});
	}
};
window.addEvent("domready", Page.initialize);';
$document->addScriptDeclaration($sd);

// Get Menu items
$menus =& JSite::getMenu();
for ($j = 0; $j < 10; $j ++) {
	$itemid = $params->get( 'menu_item'.$j );
	$item = $menus->getItem($itemid);
	$image = $params->get('menu_image'.$j);
	if ($params->get('menu_item'.$j) != '') {
		$i += 1;
		if ($item->home == '1') {
			$list[$i] = '<a href="' . JURI::base() . '">';
		} else {
			$list[$i] =  '<a href="' . stripslashes(htmlspecialchars($item->link)) . '&amp;itemid=' . $itemid . '">';
		}
		$img = '<img class="iFishEyeImg" src="' . JURI::base() . 'images/aracnet_fisheye/';
		$img .= $image . '" alt="' . $item->name . '" />';
		$span = '<span class="iFishEyeCaption">' . $item->name . '</span>';
		if ($params->get('menu_axis') == 'x' && $params->get('menu_align') == 'btm') {
			$list[$i] .= $span . '<br />' . $img . '</a>' ;
		} else {
			$list[$i] .= $img . '<br />' . $span . '</a>' ;
		}
	}
}
$count = count($list);
?>
<!-- FishEye Menu by Alejandro Malo (http://www.aracnet.com.mx/) for Joomla 1.5 :: Start-->
<div id="iFishEye">
<?php
$style = '';
if ($params->get('menu_bgnd') != "-1") {
	$style = ' style="background: url(' . JURI::base() . 'images/aracnet_fisheye/';
	$style .= $params->get('menu_bgnd') . ') ';
	$style .= $params->get('menu_bg_valign') . ' '; 
	$style .= $params->get('menu_bg_align') . ' '; 
	$style .= $params->get('menu_bg_rep') . '; ';
	if ($params->get('menu_axis') != 'x') {
		$style .= 'width: ' . $params->get('menu_size') . 'px;"';
	} else {
		$style .= 'height: ' . $params->get('menu_size') . 'px;"';			
	}	
}
if ($params->get('menu_axis') == "y") {
	echo '<div' . $style . '>';
	for ($j = 0; $j < $count; $j ++) {
		echo '<div class="iFishEye_' . $params->get('menu_align') . '">'. $list[$j] . '</div>';
	}
	echo '</tdiv>';
} else {
	echo '<table' . $style . '><tr>';
	for ($j = 0; $j < $count; $j ++) {
		echo '<td class="iFishEye_' . $params->get('menu_align') . '">'. $list[$j] . '</td>';
	}
	echo '</tr></table>';
}
?>
</div>
<!-- FishEye Menu by Alejandro Malo (http://www.aracnet.com.mx/) for Joomla 1.5 :: End-->
