<?php
/**
 * @package		JomSocial
 * @subpackage 	Template
 * @copyright (C) 2008 by Slashes & Dots Sdn Bhd - All rights reserved!
 * @license http://www.jomsocial.com Copyrighted Commercial Software
 *
 * @param	$appName	Current application name
 * @param	$showCheck0
 * @param	$showCheck1
 * @param	$showCheck2 
 */
defined('_JEXEC') or die();
?>
<form name="privacyForm" action="">
	<table class="cWindowForm" cellspacing="1" cellpadding="0">
		<tr>
			<td><input type="radio" value="0" name="privacy"<?php echo $showCheck0;?> /></td>
			<td width="100%">
				<strong><?php echo JText::_('CC APPLICATION PRIVACY EVERYONE');?></strong>
				<p><?php echo JText::_('CC APPLICATION PRIVACY EVERYONE DESC');?></p>
			</td>
		</tr>
		<tr>
			<td><input type="radio" value="10" name="privacy"<?php echo $showCheck1;?> /></td>
			<td>
				<strong><?php echo JText::_('CC APPLICATION PRIVACY FRIENDS');?></strong>
				<p><?php echo JText::_('CC APPLICATION PRIVACY FRIENDS DESC');?></p>
			</td>
		</tr>
		<tr>
			<td><input type="radio" value="20" name="privacy"<?php echo $showCheck2;?> /></td>
			<td>
				<strong><?php echo JText::_('CC PRIVACY ME');?></strong>
				<p><?php echo JText::_('CC APPLICATION PRIVACY ME DESC');?></p>
			</td>
		</tr>
	</table>
	<input type="hidden" name="appname" value="<?php echo $appName;?>" />
</form>