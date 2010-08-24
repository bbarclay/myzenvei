<?php
defined("_JEXEC") or die();


class JElementColorInput extends JElement {

	function fetchElement($name, $value, &$node, $control_name)
	{
		$live_site = JURI::base();
		$live_site .= (substr($live_site,-1) == "/") ? "" : "/";
		$dirname = basename(dirname(dirname(__FILE__)));
		
		$output = "";
		$document 	=& JFactory::getDocument();

		$document->addStyleSheet($live_site."../modules/$dirname/elements/colorpicker.css");
		$document->addScript($live_site."../modules/$dirname/elements/jquery-1.3.2.min.js"); 
		$document->addScript($live_site."../modules/$dirname/elements/colorpicker.js");

		$output = "<input id=\"".$control_name.$name."\" name=\"".$control_name."[".$name."]\" type=\"text\" size=\"7\" maxlength=\"7\" value=\"".$value."\" onfocus=\"jQuery.noConflict();jQuery(this).ColorPicker({
		onSubmit: function(hsb, hex, rgb, el) {
			hex=hex.toUpperCase();
			jQuery(el).val(hex);
			jQuery(el).ColorPickerHide();
			document.getElementById('".$control_name.$name."COLORBOX').style.backgroundColor = '#'+hex;
		},
		onBeforeShow: function () {
			jQuery(this).ColorPickerSetColor(this.value);
		}
	})\"/>&nbsp;&nbsp;<span id=\"".$control_name.$name."COLORBOX\" style=\"cursor:default;border:1px solid silver;background-color:#$value\">&nbsp;&nbsp;&nbsp;&nbsp;</span>";
	return $output;
	}
}
?>