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
	<table border="0" cellpadding="4" width="100%">
		<tr>
			<td valign="top"><input type="radio" value="0" name="privacy"<?php echo $showCheck0;?> /></td>
			<td width="100%"><strong><?php echo JText::_('CC APPLICATION PRIVACY EVERYONE');?></strong>
				<div style="padding:4px"><?php echo JText::_('CC APPLICATION PRIVACY EVERYONE DESC');?></div>
			</td>
		</tr>			
		<tr>
			<td valign="top"><input type="radio" value="10" name="privacy"<?php echo $showCheck1;?> /></td>
			<td width="100%"><strong><?php echo JText::_('CC APPLICATION PRIVACY FRIENDS');?></strong>
				<div  style="padding:4px"><?php echo JText::_('CC APPLICATION PRIVACY FRIENDS DESC');?></div>
			</td>
		</tr>
		<tr>
			<td valign="top"><input type="radio" value="20" name="privacy"<?php echo $showCheck2;?> /></td>
			<td width="100%"><strong><?php echo JText::_('CC PRIVACY ME');?></strong>
				<div style="padding:4px"><?php echo JText::_('CC APPLICATION PRIVACY ME DESC');?></div>
			</td>
		</tr>
	</table>
	<input type="hidden" name="appname" value="<?php echo $appName;?>" />
</form>