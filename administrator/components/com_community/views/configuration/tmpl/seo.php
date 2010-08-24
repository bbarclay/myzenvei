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
	<legend><?php echo JText::_( 'CC SEO' ); ?></legend>
	<table class="admintable" cellspacing="1">
		<tbody>
			<tr>
				<td width="300" class="key">
					<span class="hasTip" title="<?php echo JText::_( 'CC URL FORMAT' ); ?>::<?php echo JText::_('CC URL FORMAT TIPS'); ?>">
					<?php echo JText::_( 'CC URL FORMAT' ); ?>
					</span>
				</td>
				<td valign="top">
					<select name="sef">
						<?php
							$selectedProfile	= ( $this->config->get('sef') == 'profile' ) ? 'selected="true"' : '';
							$selectedFeature	= ( $this->config->get('sef') == 'feature' ) ? 'selected="true"' : '';
						?>
							<option <?php echo $selectedProfile; ?> value="profile"><?php echo JText::_('CC USERNAME FEATURES');?></option>
							<option <?php echo $selectedFeature; ?> value="feature"><?php echo JText::_('CC FEATURES USERNAME');?></option>
					</select>
				</td>
			</tr>
			<tr>
				<td width="300" class="key">
					<span class="hasTip" title="<?php echo JText::_( 'CC SEF COMPATIBILITY' ); ?>::<?php echo JText::_('CC SEF COMPATIBILITY TIPS'); ?>">
					<?php echo JText::_( 'CC SEF COMPATIBILITY' ); ?>
					</span>
				</td>
				<td valign="top">
					<?php echo JHTML::_('select.booleanlist' , 'sefcompatibilityfix' , null , $this->config->get('sefcompatibilityfix') , JText::_('CC YES') , JText::_('CC NO') ); ?>
				</td>
			</tr>
		</tbody>
	</table>
</fieldset>