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

if (!defined( '_JEXEC' )) die( 'Direct Access to this location is not allowed.');

JHTML::_('behavior.mootools');
$doc =&JFactory::getDocument();
$live_site = JURI::base();
$live_site .= (substr($live_site,-1) == '/') ? '' : '/';
$myself=$module->id;
$modulekey = base64_encode("$myself|$live_site");
$helper_url = $live_site."modules/mod_jxtc_vtube/helper.php?ref=".$modulekey;
$player_url = $live_site.'modules/mod_jxtc_vtube/flash/videoPlayer.swf';
$button_url = $live_site.'images/'.$button;
$jxtc=uniqid('jxtc');

require 'func_buildparms.php';

$doc->addScript($live_site."modules/mod_jxtc_vtube/js/jxtcswfobject.js");
switch ($display) {
	case 'p': //popup
		$play = "<a href=\"#\" onclick=\"MyWindow=window.open('$helper_url','_blank','toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=no,resizable=no,width=$width,height=$height,left=200,top=200'); return false;\">";
		$play .= (empty($button) ? 'Click Here' : '<img src="'.$button_url.'" />');
		$play .= '</a>';
		echo $play;
	break;
	case 'a': // auto pop-up
	$play = "<a href=\"#\" onclick=\"MyWindow=window.open('$helper_url','_blank','toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=no,resizable=no,width=$width,height=$height,left=200,top=200'); return false;\">";
	$play .= (empty($button) ? 'Click Here' : '<img src="'.$button_url.'" />');
	$play .= '</a>';
	echo $play;
	$script = 'swfobject.embedSWF("'.$player_url.'", "'.$jxtc.'", "'.$width.'", "'.$height.'", "9", null, '.$jxtc.'flashvars, '.$jxtc.'params);
	window.open("$helper_url","_blank","toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=no,resizable=no,width='.$width.',height='.$height.',left=200,top=200");';
	$doc->addScriptDeclaration($playvars.$script);
	break;
	case 's': //lightbox
		JHTML::_('behavior.modal',  'a.modal', array('onClose'=>'\function(){this.content.empty();}'));
		?>
		<a class="modal" href="<?php echo $helper_url ?>" rel="{handler: 'iframe', size: {x: <?php echo $width; ?>, y: <?php echo $height; ?>}}">
		<img src="<?php echo $button_url ?>" />
		</a>
		<?php
	break;
	default: //module
	echo '<div id="'.$jxtc.'"><a href="http://www.adobe.com/go/getflashplayer"><img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Get Adobe Flash player" /></a></div>';
	$script = 'swfobject.embedSWF("'.$player_url.'", "'.$jxtc.'", "'.$width.'", "'.$height.'", "9", null, '.$jxtc.'flashvars, '.$jxtc.'params);';
	$doc->addScriptDeclaration($playvars.$script);
	break;
}
?>
<div style="display:none"><a href="http://www.joomlaxtc.com">JoomlaXTC VTube - Copyright 2009 Monev Software LLC</a></div>
