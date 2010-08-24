<?php
/**
 * @package		JomSocial
 * @subpackage 	Template
 * @copyright (C) 2008 by Slashes & Dots Sdn Bhd - All rights reserved!
 * @license http://www.jomsocial.com Copyrighted Commercial Software
 *
 * @param	$app	Application object
 */
defined('_JEXEC') or die();
?>

<table class="cWindowForm" cellspacing="1" cellpadding="0">
	<tr>
		<td class="cWindowFormKey"><?php echo JText::_('CC APPLICATION NAME');?></td>
		<td class="cWindowFormVal"><?php echo $app->name;?></td>
	</tr>
	<tr>
		<td class="cWindowFormKey"><?php echo JText::_('CC APPLICATION AUTHOR');?></td>
		<td class="cWindowFormVal"><?php echo $app->author;?></td>
	</tr>
	<tr>
		<td class="cWindowFormKey"><?php echo JText::_('CC APPLICATION VERSION');?></td>
		<td class="cWindowFormVal"><?php echo $app->version;?></td>
	</tr>
	<tr>
		<td class="cWindowFormKey"><?php echo JText::_('CC APPLICATION DESCRIPTION');?></td>
		<td class="cWindowFormVal"><?php echo $app->description;?></td>
	</tr>
</table>