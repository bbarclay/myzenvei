<?php
/**
 * @package		JomSocial
 * @subpackage 	Template 
 * @copyright (C) 2008 by Slashes & Dots Sdn Bhd - All rights reserved!
 * @license http://www.azrul.com Copyrighted Commercial Software
 * 
 * @param	applications	An array of applications object
 * @param	pagination		JPagination object 
 */
defined('_JEXEC') or die();
?>
<table width="100%" cellpadding="10" cellspacing="0" border="0">
	<tr>
		<td class="sectiontableheader" colspan="2">
			<?php echo JText::_('CC APPLICATION COLUMN NAME'); ?>
		</td>
		<td class="sectiontableheader">
			<?php echo JText::_('CC APPLICATION COLUMN DATE'); ?>
		</td>
		<td class="sectiontableheader">
			<?php echo JText::_('CC APPLICATION COLUMN VERSION'); ?>
		</td>
		<td class="sectiontableheader">
			<?php echo JText::_('CC APPLICATION COLUMN AUTHOR'); ?>
		</td>
		<td class="sectiontableheader">
			<?php echo JText::_('CC APPLICATION COLUMN ACTIONS'); ?>
		</td>
	</tr>
	<?php
	if( $applications )
	{
		$style	= array('sectiontableentry1' , 'sectiontableentry2');
		foreach( $applications as $application )
		{
			$class	= array_shift( $style );
			array_push( $style , $class );
	?>
	<tr class="apps-entry <?php echo $class; ?>">
		<td>
			<img src="<?php echo JURI::base() . 'plugins/community/' . $application->name . '/favicon.png'; ?>" class="icon" />
		</td>
		<td>
		    <div style="padding: 5px 0 0;"><strong><?php echo $application->title; ?></strong></div>
			<div style="padding: 0 0 10px;"><?php echo $application->description; ?></div>
		</td>
		<td><?php echo $application->creationDate; ?></td>
		<td><?php echo $application->version; ?></td>
		<td><?php echo $application->author; ?></td>
		<td align="center">
			<span id="<?php echo $application->name; ?>-status" style="position: relative;">
				<?php
					if(!$application->added && !$application->coreapp )
					{
				?>
					<a class="approve" href="javascript:void(0);" onclick="joms.apps.add('<?php echo $application->name; ?>')" style="top: -7px; left: 10px;" title="<?php echo JText::_('CC APPLICATION BTN ADD'); ?>">
					<?php echo JText::_('CC APPLICATION LIST ADD'); ?>
					</a>
				<?php
					}
					else
					{
				?>
					<strong><?php echo JText::_('CC APPLICATION LIST ADDED'); ?></strong>
				<?php
					}
				?>
			</span>
		</td>
	</tr>
	<?php 
		}
	}
	else
	{
	?>
	<tr>
		<td colspan="5" align="center">
			<?php echo JText::_('CC NO APPLICATIONS INSTALLED');?>
		</td>
	</tr>
	<?php
	}
	?>
	<tr>
		<td colspan="5" align="center" class="sectiontablefooter">
		<?php echo $pagination->getPagesLinks(); ?>
		</td>
	</tr>
</table>