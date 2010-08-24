<?php
/**
 * @package		JomSocial
 * @copyright (C) 2008 by Slashes & Dots Sdn Bhd - All rights reserved!
 * @license http://www.azrul.com Copyrighted Commercial Software
 */

// Disallow direct access to this file
defined('_JEXEC') or die('Restricted access');
?>
<fieldset class="adminform">
	<legend><?php echo JText::_('CC WALLS'); ?></legend>
	<table class="admintable" cellspacing="1">
		<tbody>
			<tr>
				<td width="300" class="key">
					<span class="hasTip" title="<?php echo JText::_( 'CC LOCK PROFILE WALLS TO FRIENDS' ); ?>::<?php echo JText::_('CC LOCK PROFILE WALLS TO FRIENDS TIPS'); ?>">
						<?php echo JText::_( 'CC LOCK PROFILE WALLS TO FRIENDS' ); ?>
					</span>
				</td>
				<td valign="top">
					<?php echo JHTML::_('select.booleanlist' , 'lockprofilewalls' , null , $this->config->get('lockprofilewalls') , JText::_('CC YES') , JText::_('CC NO') ); ?>
				</td>
			</tr>
			<tr>
				<td width="300" class="key">
					<span class="hasTip" title="<?php echo JText::_( 'CC LOCK VIDEO WALLS TO FRIENDS' ); ?>::<?php echo JText::_('CC LOCK VIDEO WALLS TO FRIENDS TIPS'); ?>">
						<?php echo JText::_( 'CC LOCK VIDEO WALLS TO FRIENDS' ); ?>
					</span>
				</td>
				<td valign="top">
					<?php echo JHTML::_('select.booleanlist' , 'lockvideoswalls' , null , $this->config->get('lockvideoswalls') , JText::_('CC YES') , JText::_('CC NO') ); ?>
				</td>
			</tr>
			<tr>
				<td class="key">
					<span class="hasTip" title="<?php echo JText::_( 'CC LOCK GROUP WALLS TO MEMBERS' ); ?>::<?php echo JText::_('CC LOCK GROUP WALLS TO MEMBERS TIPS'); ?>">
						<?php echo JText::_( 'CC LOCK GROUP WALLS TO MEMBERS' ); ?>
					</span>
				</td>
				<td valign="top">
					<?php echo JHTML::_('select.booleanlist' , 'lockgroupwalls' , null , $this->config->get('lockgroupwalls') , JText::_('CC YES') , JText::_('CC NO') ); ?>
				</td>
			</tr>
		</tbody>
	</table>
</fieldset>