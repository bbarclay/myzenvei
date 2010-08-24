<?php
/**
 * @package	JomSocial
 * @subpackage Core 
 * @copyright (C) 2008 by Slashes & Dots Sdn Bhd - All rights reserved!
 * @license http://www.jomsocial.com Copyrighted Commercial Software
 */
defined('_JEXEC') or die();
?>
<div class="ctitle"><h2><?php echo JText::_('CC EDIT PREFERENCES'); ?></h2></div>
<form method="post" action="<?php echo CRoute::getURI();?>" name="saveProfile">

<table class="formtable" cellspacing="1" cellpadding="0">
<tr>
	<td class="key" style="width: 300px;">
		<label for="activityLimit" class="label title">
			<?php echo JText::_('CC PREFERENCES ACTIVITY LIMIT'); ?>
		</label>
	</td>
	<td class="value">
		<input type="text" id="activityLimit" name="activityLimit" value="<?php echo $params->get('activityLimit', 20 );?>" size="5" />
	</td>
</tr>

<tr>
	<td class="key"></td>
	<td class="value">
		<input type="submit" class="button" value="<?php echo JText::_('CC BUTTON SAVE'); ?>" />
	</td>
</tr>
</table>

</form>