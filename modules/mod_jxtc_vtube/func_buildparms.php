<?php
/*
	JoomlaXTC VTube module

	version 1.4
	
	Copyright (C) 2009,2010  Monev Software LLC.	All Rights Reserved.
	
	This program is free software; you can redistribute it and/or modify
	it under the terms of the GNU General Public License as published by
	the Free Software Foundation; either version 2 of the License, or
	(at your option) any later version.
	
	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.
	
	You should have received a copy of the GNU General Public License
	along with this program; if not, write to the Free Software
	Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
	
	THIS LICENSE MIGHT NOT APPLY TO OTHER FILES CONTAINED IN THE SAME PACKAGE.
	
	See COPYRIGHT.php for more information.
	See LICENSE.php for more information.
	
	Monev Software LLC
	www.joomlaxtc.com
*/

$boole=array('false','true');
$display = $params->get('display','m');
$width = $params->get('width',500);
$height = $params->get('height',350);
$playerWidth = $params->get('playerWidth',500);
$playerHeight = $params->get('playerHeight',300);
$speed = $params->get('speed',300);
$button = $params->get('button','');
$autoLoad = $params->get('autoLoad','1');
$autoPlay = $params->get('autoPlay','1');
$autoResize = $params->get('autoResize','1');
$bufferTime = $params->get('bufferTime','5');
$buttonSound = $params->get('buttonSound','0');
$cBarAutoHide = $params->get('cBarAutoHide','1');
$cBarHideDelay = $params->get('cBarHideDelay','3');
$clickListener = $params->get('clickListener','1');
$controllerBackground = $params->get('controllerBackground','000000');
$controllerButtonsDown = $params->get('controllerButtonsDown','ffffff');
$controllerButtonsNormal = $params->get('controllerButtonsNormal','cccccc');
$controllerButtonsOver = $params->get('controllerButtonsOver','ffffff');
$controlsPadding = $params->get('controlsPadding','10');
$doubleClickListener = $params->get('doubleClickListener','1');
$keepAspectRatio = $params->get('keepAspectRatio','1');
$loop = $params->get('loop','0');
$middlePlayBtnalphaDown = $params->get('middlePlayBtnalphaDown','100');
$middlePlayBtnalphaNormal = $params->get('middlePlayBtnalphaNormal','60');
$middlePlayBtnalphaOver = $params->get('middlePlayBtnalphaOver','80');
$middlePlayBtnarrowDown = $params->get('middlePlayBtnarrowDown','f0ff0f');
$middlePlayBtnarrowNormal = $params->get('middlePlayBtnarrowNormal','00ffff');
$middlePlayBtnarrowOver = $params->get('middlePlayBtnarrowOver','ffff00');
$middlePlayBtnbckDown = $params->get('middlePlayBtnbckDown','0000ff');
$middlePlayBtnbckNormal = $params->get('middlePlayBtnbckNormal','00FF00');
$middlePlayBtnbckOver = $params->get('middlePlayBtnbckOver','000ff0');
$mouseCursorAutoHide = $params->get('mouseCursorAutoHide','1');
$mouseCursorHideDelay = $params->get('mouseCursorHideDelay','5');
$playContinuously = $params->get('playContinuously','0');
$playerBackgroundValue = $params->get('playerBackgroundValue','00FF00');
$playlistAutoHide = $params->get('playlistAutoHide','1');
$playlistBackground = $params->get('playlistBackground','000000');
$playlistBckAlpha = $params->get('playlistBckAlpha','60');
$playlistHideDelay = $params->get('playlistHideDelay','2');
$playlistHideType = $params->get('playlistHideType','"fade"');
$playlistPos = $params->get('playlistPos','"B"');
$playlistSize = $params->get('playlistSize','70');
$playlistThumbBck = $params->get('playlistThumbBck','000000');
$playlistThumbHeight = $params->get('playlistThumbHeight','50');
$playlistThumbNormalAlpha = $params->get('playlistThumbNormalAlpha','50');
$playlistThumbOverAlpha = $params->get('playlistThumbOverAlpha','80');
$playlistThumbPadding = $params->get('playlistThumbPadding','10');
$playlistThumbSelectedAlpha = $params->get('playlistThumbSelectedAlpha','100');
$playlistThumbWidth = $params->get('playlistThumbWidth','70');
$preloaderBackground = $params->get('preloaderBackground','000000');
$preloaderBckAlpha = $params->get('preloaderBckAlpha','70');
$preloaderCircle = $params->get('preloaderCircle','559bb5');
$preloaderText = $params->get('preloaderText','cccccc');
$progressBarBackground = $params->get('progressBarBackground','386F92');
$progressBarBorder = $params->get('progressBarBorder','386F92');
$progressBarDownload = $params->get('progressBarDownload','386F92');
$progressBarElapse = $params->get('progressBarElapse','fe9be5');
$progressScrubBtnbckDown = $params->get('progressScrubBtnbckDown','00ffff');
$progressScrubBtnbckNormal = $params->get('progressScrubBtnbckNormal','00ff00');
$progressScrubBtnbckOver = $params->get('progressScrubBtnbckOver','ff00ff');
$progressScrubBtnbrdDown = $params->get('progressScrubBtnbrdDown','ffff00');
$progressScrubBtnbrdNormal = $params->get('progressScrubBtnbrdNormal','ff0000');
$progressScrubBtnbrdOver = $params->get('progressScrubBtnbrdOver','0000ff');
$random = $params->get('random','0');
$shareBackground = $params->get('shareBackground','000000');
$shareBckAlpha = $params->get('shareBckAlpha','40');
$shareBoxBck = $params->get('shareBoxBck','000000');
$shareBoxBckAlpha = $params->get('shareBoxBckAlpha','70');
$shareBtnsDown = $params->get('shareBtnsDown','ffffff');
$shareBtnsNormal = $params->get('shareBtnsNormal','cccccc');
$shareBtnsOver = $params->get('shareBtnsOver','ffffff');
$shareErrorText = $params->get('shareErrorText','00ff00');
$shareLabels = $params->get('shareLabels','ffffff');
$shareText = $params->get('shareText','000000');
$shareTextBck = $params->get('shareTextBck','ffffff');
$shareTextBrd = $params->get('shareTextBrd','000000');
$showFullScreenBtn = $params->get('showFullScreenBtn','1');
$showMiddlePlayBtn = $params->get('showMiddlePlayBtn','1');
$showPreviewImage = $params->get('showPreviewImage','1');
$showShareBtn = $params->get('showShareBtn','1');
$showWatermark = $params->get('showWatermark','1');
$spaceKeyListener = $params->get('spaceKeyListener','1');
$times = $params->get('times','00ff00');
$volumeBackground = $params->get('volumeBackground','000000');
$volumeBar = $params->get('volumeBar','559bb5');
$volumeBorder = $params->get('volumeBorder','666666');
$volumes = $params->get('volumes','100');
$volumeScrubBtnbckDown = $params->get('volumeScrubBtnbckDown','000000');
$volumeScrubBtnbckNormal = $params->get('volumeScrubBtnbckNormal','000000');
$volumeScrubBtnbckOver = $params->get('volumeScrubBtnbckOver','000000');
$volumeScrubBtnbrdDown = $params->get('volumeScrubBtnbrdDown','ffffff');
$volumeScrubBtnbrdNormal = $params->get('volumeScrubBtnbrdNormal','cccccc');
$volumeScrubBtnbrdOver = $params->get('volumeScrubBtnbrdOver','ffffff');
$volumeSpeaker = $params->get('volumeSpeaker','cccccc');
$watermarkPos = $params->get('watermarkPos','"TR"');
$subject = $params->get('subject','Message from your friend');
$message = urlencode($params->get('message')."<br/><br/><a href='[videoPage]' target='_blank'>Go To Video Here</a>");
	
$xps = $params->get('xps');
$xps = str_replace("<br />","",$xps);
$xps = str_replace("\r","\n",$xps);
$rows = explode("\n",$xps);
$hold = array();
foreach ($rows as $row) {
	if (substr(trim($row),0,1) == '#') continue;
	if (empty($row)) {
		$lists[] = $hold;
		$hold=array();
	}
	else {
		$hold[] = $row;
	}
}
if (!empty($hold)) $lists[] = $hold;

$playdata  = '';
foreach ($lists as $list) {
	if (empty($list[0])) continue;
	$playdata .= implode(',',$list).'|';
}
$playdata=trim($playdata,'|');

$playvars = 'var '.$jxtc.'flashvars = {"autoLoad":"'.$boole[$autoLoad].'",'.
'"autoPlay":"'.$boole[$autoPlay].'",'.
'"autoResize":"'.$boole[$autoResize].'",'.
'"bufferTime":"'.$bufferTime.'",'.
'"buttonSound":"'.$boole[$buttonSound].'",'.
'"cBarAutoHide":"'.$boole[$cBarAutoHide].'",'.
'"cBarHideDelay":'.$cBarHideDelay.','.
'"clickListener":"'.$boole[$clickListener].'",'.
'"controllerBackground":"0x'.$controllerBackground.'",'.
'"controllerButtons-down":"0x'.$controllerButtonsDown.'",'.
'"controllerButtons-normal":"0x'.$controllerButtonsNormal.'",'.
'"controllerButtons-over":"0x'.$controllerButtonsOver.'",'.
'"controlsPadding":"'.$controlsPadding.'",'.
'"doubleClickListener":"'.$boole[$doubleClickListener].'",'.
'"keepAspectRatio":"'.$boole[$keepAspectRatio].'",'.
'"loop":"'.$boole[$loop].'",'.
'"middlePlayBtn-alphaDown":"'.$middlePlayBtnalphaDown.'",'.
'"middlePlayBtn-alphaNormal":"'.$middlePlayBtnalphaNormal.'",'.
'"middlePlayBtn-alphaOver":"'.$middlePlayBtnalphaOver.'",'.
'"middlePlayBtn-arrowDown":"0x'.$middlePlayBtnarrowDown.'",'.
'"middlePlayBtn-arrowNormal":"0x'.$middlePlayBtnarrowNormal.'",'.
'"middlePlayBtn-arrowOver":"0x'.$middlePlayBtnarrowOver.'",'.
'"middlePlayBtn-bckDown":"0x'.$middlePlayBtnbckDown.'",'.
'"middlePlayBtn-bckNormal":"0x'.$middlePlayBtnbckNormal.'",'.
'"middlePlayBtn-bckOver":"0x'.$middlePlayBtnbckOver.'",'.
'"mouseCursorAutoHide":"'.$boole[$mouseCursorAutoHide].'",'.
'"mouseCursorHideDelay":"'.$mouseCursorHideDelay.'",'.
'"playContinuously":"'.$boole[$playContinuously].'",'.
'"playerBackground-value":"0x'.$playerBackgroundValue.'",'.
'"playerWidth":"'.$Width.'",'.
'"playerHeight":"'.$Height.'",'.
'"playlistAutoHide":"'.$boole[$playlistAutoHide].'",'.
'"playlistHideDelay":"'.$playlistHideDelay.'",'.
'"playlistHideType":"'.$playlistHideType.'",'.
'"playlistPos":"'.$playlistPos.'",'.
'"playlistSize":"'.$playlistSize.'",'.
'"playlistThumbHeight":"'.$playlistThumbHeight.'",'.
'"playlistThumbPadding":"'.$playlistThumbPadding.'",'.
'"playlistThumbWidth":"'.$playlistThumbWidth.'",'.
'"playlist-background":"0x'.$playlistBackground.'",'.
'"playlist-bckAlpha":"'.$playlistBckAlpha.'",'.
'"playlist-thumbBck":"0x'.$playlistThumbBck.'",'.
'"playlist-thumbNormalAlpha":"'.$playlistThumbNormalAlpha.'",'.
'"playlist-thumbOverAlpha":"'.$playlistThumbOverAlpha.'",'.
'"playlist-thumbSelectedAlpha":"'.$playlistThumbSelectedAlpha.'",'.
'"preloader-background":"0x'.$preloaderBackground.'",'.
'"preloader-bckAlpha":"'.$preloaderBckAlpha.'",'.
'"preloader-circle":"0x'.$preloaderCircle.'",'.
'"preloader-text":"0x'.$preloaderText.'",'.
'"progressBar-background":"0x'.$progressBarBackground.'",'.
'"progressBar-border":"0x'.$progressBarBorder.'",'.
'"progressBar-download":"0x'.$progressBarDownload.'",'.
'"progressBar-elapse":"0x'.$progressBarElapse.'",'.
'"progressScrubBtn-bckDown":"0x'.$progressScrubBtnbckDown.'",'.
'"progressScrubBtn-bckNormal":"0x'.$progressScrubBtnbckNormal.'",'.
'"progressScrubBtn-bckOver":"0x'.$progressScrubBtnbckOver.'",'.
'"progressScrubBtn-brdDown":"0x'.$progressScrubBtnbrdDown.'",'.
'"progressScrubBtn-brdNormal":"0x'.$progressScrubBtnbrdNormal.'",'.
'"progressScrubBtn-brdOver":"0x'.$progressScrubBtnbrdOver.'",'.
'"random":"'.$boole[$random].'",'.
'"share-background":"0x'.$shareBackground.'",'.
'"share-bckAlpha":"'.$shareBckAlpha.'",'.
'"share-boxBck":"0x'.$shareBoxBck.'",'.
'"share-boxBckAlpha":"0x'.$shareBoxBckAlpha.'",'.
'"share-btnsDown":"0x'.$shareBtnsDown.'",'.
'"share-btnsNormal":"0x'.$shareBtnsNormal.'",'.
'"share-btnsOver":"0x'.$shareBtnsOver.'",'.
'"share-errorText":"0x'.$shareErrorText.'",'.
'"share-labels":"0x'.$shareLabels.'",'.
'"share-text":"0x'.$shareText.'",'.
'"share-textBck":"0x'.$shareTextBck.'",'.
'"share-textBrd":"0x'.$shareTextBrd.'",'.
'"showFullScreenBtn":"'.$boole[$showFullScreenBtn].'",'.
'"showMiddlePlayBtn":"'.$boole[$showMiddlePlayBtn].'",'.
'"showPreviewImage":"'.$boole[$showPreviewImage].'",'.
'"showShareBtn":"'.$boole[$showShareBtn].'",'.
'"showWatermark":"'.$boole[$showWatermark].'",'.
'"spaceKeyListener":"'.$boole[$spaceKeyListener].'",'.
'"times":"0x'.$times.'",'.
'"volumeScrubBtn-bckDown":"0x'.$volumeScrubBtnbckDown.'",'.
'"volumeScrubBtn-bckNormal":"0x'.$volumeScrubBtnbckNormal.'",'.
'"volumeScrubBtn-bckOver":"0x'.$volumeScrubBtnbckOver.'",'.
'"volumeScrubBtn-brdDown":"0x'.$volumeScrubBtnbrdDown.'",'.
'"volumeScrubBtn-brdNormal":"0x'.$volumeScrubBtnbrdNormal.'",'.
'"volumeScrubBtn-brdOver":"0x'.$volumeScrubBtnbrdOver.'",'.
'"volume-background":"0x'.$volumeBackground.'",'.
'"volume-bar":"0x'.$volumeBar.'",'.
'"volume-border":"0x'.$volumeBorder.'",'.
'"volumes":"'.$volumes.'",'.
'"volume-speaker":"0x'.$volumeSpeaker.'",'.
'"watermarkPos":"'.$watermarkPos.'",'.
'"data":"'.$playdata.'",'.
'"subject":"'.$subject.'",'.
'"message":"'.$message.'",'.
'"htmlPage":"'.$live_site.'",'.
'"playerPath":"",'.
'"sendtoafriend-php":"modules/mod_jxtc_vtube/staf.php"};
var '.$jxtc.'params = {wmode:"transparent",allowFullScreen: "true", base:"'.$live_site.'"};';
?>