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
	<legend><?php echo JText::_( 'CC NOTIFICATIONS' ); ?></legend>
	<table class="admintable" cellspacing="1">
		<tbody>
			<tr>
				<td width="300" class="key">
					<span class="hasTip" title="<?php echo JText::_( 'CC SEND NOTIFICATIONS VIA' ); ?>::<?php echo JText::_('CC SEND NOTIFICATIONS VIA TIPS'); ?>">
						<?php echo JText::_( 'CC SEND NOTIFICATIONS VIA' ); ?>
					</span>
				</td>
				<td valign="top">
					<?php echo $this->getNotifyTypeHTML( $this->config->get( 'notifyby' ) ); ?>
				</td>
			</tr>
		</tbody>
	</table>
</fieldset>