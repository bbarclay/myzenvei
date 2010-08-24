<?php
/**
 * @package mod_foobla_shortcuts
 * @author Thong Tran - http://foobla.com
 * @copyright Copyright (C) 2009 foobla.com. All rights reserved.
 * @version 1.5.0.1
 * @since 2009.04.17
 * @license		GNU/GPL, see LICENSE.php
 * Joomla! is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * See COPYRIGHT.php for copyright notices and details.
 */

defined('_JEXEC') or die('Restricted access');
JHTML::_('behavior.mootools');
?>
<script type="text/javascript">
<!--
	window.addEvent('domready', function(){
			$('virtueorder').addEvent('change', function(e){
				var order_id = this.value;
				for (var i = 0; i < order_id.length; i++){
					if( order_id[i] != 0){
						order_id = order_id.substring(i);
						break;
					}
				}
         		window.location = 'index.php?page=order.order_print&limitstart=0&keyword=&order_id='+order_id+'&option=com_virtuemart';
				return;
	       	});
	});
//-->
</script>


<?php 
# clean the mess thing from rhuk template
echo "
<style type='text/css'>
#module-status {
	background: none;
}
</style>
";
// order virtue
if ( $params->get('orderinput') ){
	$ordernumber = JText::_('ORDER_NUMBER');
	echo '<span class="add_icons" style="margin: 0; padding: 4px"><input type="text" id="virtueorder" name="virtueorder" size="12px" value="'.$ordernumber.'" onfocus="this.value=\'\'"  onblur="this.value=\''.$ordernumber.'\'" /></span>';
}
if ($params->get('shortcuts')!='') {
	$shortcuts = $params->get('shortcuts');
	$shortcuts_arr = explode(';', $shortcuts);
	
	foreach ($shortcuts_arr AS $shortcut) {
		$shortcut_arr = explode('|', $shortcut);

		# get each element title|link|icon
		$title_value	= $shortcut_arr[0];
		$link_value		= $shortcut_arr[1];
		$icon_value		= $shortcut_arr[2];
		
		/**
		 * TODO
		 * If the icon can not be found, load the default icon
		 */

		# display them
		if ($link_value!='')		
			echo "<a href=\"".$link_value."\"><span class=\"foobla_shortcuts\" style=\"margin: 0; padding: 4px\"><img src=\"".$icon_value."\" alt=\"".$title_value."\" title=\"".$title_value."\" height=\"16\" width=\"16\" /></span></a>";
	}
} else
	for ($i = 0; $i < 12; $i++) {
		# get the params name
		$title 		= 'title_'.$i;
		$link		= 'link_'.$i;
		$icon		= 'icon_'.$i;
		$icon_lib	= 'icon_'.$i.'_lib';
		
		# get the params value
		$link_value		= $params->get($link);
		$title_value	= $params->get($title);
		$icon_value		= ($params->get($icon)) ? $params->get($icon) : JURI::root()."administrator/templates/khepri/images/menu/".$params->get($icon_lib);
		
		# display them
		if ($link_value!='')		
			echo "<a href=\"".$link_value."\"><span class=\"foobla_shortcuts\" style=\"margin: 0; padding: 4px\"><img src=\"".$icon_value."\" alt=\"".$title_value."\" title=\"".$title_value."\" height=\"16\" width=\"16\" /></span></a>";
	}
	
// display icon
$db 	= &JFactory::getDBO();
$query 	= " SELECT id".
		  " FROM #__modules".
		  " WHERE module = 'mod_foobla_shortcuts'"; 
$db->setQuery($query);
$cid = $db->loadResult();
$iconadd 	= $params->get('icon'); 
$altTitle 	= JText::_('ALT_TITLE_ICON');
if ( $iconadd ){
	echo '<a href="'.JURI::root().'administrator/index.php?option=com_modules&client=1&task=edit&cid[]='.$cid.'"><span class="add_icons" style="margin: 0; padding: 4px"><img src="'.JURI::root().'administrator/modules/mod_foobla_shortcuts/assets/images/icons/icon-16-editadd.png" alt="'.$altTitle.'" title="'.$altTitle.'" height="16" width="16" /></span></a>';
}

# display separater
$separate	= $params->get('separate');
if ($separate)
	echo "<span style=\"border-right:1px solid #D8D8D8;margin: 0; padding: 4px 0px 5px 0;\">&nbsp;</span>";
	
?>

