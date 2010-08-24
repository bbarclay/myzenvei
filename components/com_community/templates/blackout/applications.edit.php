<?php
/**
 * @package		JomSocial
 * @subpackage 	Template 
 * @copyright (C) 2008 by Slashes & Dots Sdn Bhd - All rights reserved!
 * @license http://www.azrul.com Copyrighted Commercial Software
 * 
 * @param	applications	An array of applications object
 */
defined('_JEXEC') or die();
?>
<h3><?php echo JText::_('CC CORE APPLICATIONS'); ?></h3>
<table width="100%" cellpadding="4" cellspacing="0">
	<tr>
		<td class="sectiontableheader">&nbsp;</td>
		<td class="sectiontableheader">
			<?php echo JText::_('CC APPLICATION COLUMN NAME'); ?>
		</td>
		<td class="sectiontableheader" width="15%">
			<?php echo JText::_('CC APPLICATION COLUMN SETTINGS'); ?>
		</td>
		<td class="sectiontableheader" width="15%">
			<?php echo JText::_('CC APPLICATION COLUMN PRIVACY'); ?>
		</td>
		<td class="sectiontableheader" width="15%">
			<?php echo JText::_('CC APPLICATION LIST REMOVE'); ?>
		</td>
	</tr>
	<?php
	$style = array('sectiontableentry1', 'sectiontableentry2');
	if( $coreApplications )
	{
		for($i = 0; $i < count( $coreApplications ); $i++ )
		{
			$class = array_shift($style);
			array_push($style, $class);
			$application	=& $coreApplications[$i];
	?>
	<tr class="<?php echo $class; ?>">
		<td>&nbsp;</td>
		<td>
   			<img src="<?php echo JURI::base() . 'plugins/community/' . $application->apps . '/favicon.png'; ?>" class="icon" />
			<?php echo $application->title; ?>
			<a href="javascript:void(0);" onclick="joms.apps.showAboutWindow('<?php echo $application->apps; ?>');">[ <?php echo JText::_('CC APPLICATION LIST ABOUT'); ?> ]</a>
		</td>
		<td>
			<a href="javascript:void(0);" onclick="joms.apps.showSettingsWindow('<?php echo $application->id; ?>','<?php echo $application->apps; ?>');">
			<?php echo JText::_('CC APPLICATION COLUMN SETTINGS'); ?>
			</a>
		</td>
		<td>
			<a href="javascript:void(0);" onclick="joms.apps.showPrivacyWindow('<?php echo $application->apps; ?>');">
			<?php echo JText::_('CC APPLICATION COLUMN PRIVACY'); ?>
			</a>		
		</td>
		<td>
			<?php echo JText::_('CC APPLICATION LIST CANT REMOVE'); ?>
		</td>
	</tr>
	<?php
		}
	}
	else
	{
	?>
	<tr>
		<td colspan="4" align="center">
			<?php echo JText::_('CC NO CORE APPLICATIONS INSTALLED');?>
		</td>
	</tr>
	<?php
	}
	?>
</table>
<h3><?php echo JText::_('CC INSTALLED APPLICATIONS'); ?></h3>
<table width="100%" cellpadding="4" cellspacing="0">
	<tr>
		<td class="sectiontableheader">&nbsp;</td>
		<td class="sectiontableheader">
			<?php echo JText::_('CC APPLICATION COLUMN NAME'); ?>
		</td>
		<td class="sectiontableheader" width="15%">
			<?php echo JText::_('CC APPLICATION COLUMN SETTINGS'); ?>
		</td>
		<td class="sectiontableheader" width="15%">
			<?php echo JText::_('CC APPLICATION COLUMN PRIVACY'); ?>
		</td>
		<td class="sectiontableheader" width="15%"><?php echo JText::_('CC APPLICATION LIST REMOVE'); ?></td>
	</tr>
	<tbody id="app-list">
	<?php		
	$style = array('sectiontableentry1', 'sectiontableentry2');
	
	if( $applications )
	{
		for($i = 0; $i < count( $applications ); $i++ )
		{
			$application	=& $applications[ $i ];
			$class = array_shift($style);
			array_push($style, $class);
		
			if( !$application->coreapp )
			{
	?>
	<tr class="<?php echo $class; ?>" id="app-<?php echo $application->id; ?>">
		<td class="dragHandle">&nbsp;</td>
		<td>
			<img src="<?php echo JURI::base() . 'plugins/community/' . $application->apps . '/favicon.png'; ?>" class="icon" />
			<?php echo $application->title; ?>
			<a href="javascript:void(0);" onclick="joms.apps.showAboutWindow('<?php echo $application->apps; ?>');">[ <?php echo JText::_('CC APPLICATION LIST ABOUT'); ?> ]</a>
		</td>
		<td>
			<a href="javascript:void(0);" onclick="joms.apps.showSettingsWindow('<?php echo $application->id; ?>','<?php echo $application->apps; ?>');">
			<?php echo JText::_('CC APPLICATION COLUMN SETTINGS'); ?>
			</a>
		</td>
		<td>
			<a href="javascript:void(0);" onclick="joms.apps.showPrivacyWindow('<?php echo $application->apps; ?>');">
			<?php echo JText::_('CC APPLICATION COLUMN PRIVACY'); ?>
			</a>		
		</td>
		<td>
		    <div style="position: relative; margin: 0 10px 0 0; width: 50px;">
			<?php if( !$application->coreapp ): ?>
				<a href="javascript:void(0);" onclick="joms.apps.windowTitle= '<?php echo JText::_('CC APPLICATION AJAX REMOVED');?>';joms.apps.remove('<?php echo $application->id; ?>');" class="remove" style="top: -7px; left: 10px;" title="<?php echo JText::_('CC APPLICATION BTN REMOVE'); ?>">
				[ <?php echo JText::_('CC APPLICATION LIST REMOVE'); ?> ]
				</a>
			<?php else: ?>
				<?php echo JText::_('CC APPLICATION LIST CANT REMOVE'); ?>
			<?php endif; ?>
			</div>
		</td>
	</tr>	
	<?php
			}
		}
	}
	else
	{
	?>
	<tr>
		<td colspan="4" align="center">
			<?php echo JText::_('CC NO APPLICATIONS ADDED YET');?>
		</td>
	</tr>
	<?php
	}
	?>
	</tbody>
</table>
<script type='text/javascript'>
	jQuery('#app-list').tableDnD({
		onDrop: function(table, row) {
			//alert(jQuery('#app-list').tableDnDSerialize());
			jax.call('community', 'apps,ajaxSaveOrder', jQuery('#app-list').tableDnDSerialize());
		},
		dragHandle: "dragHandle"
	});

	jQuery("#app-list tr").hover(function() {
		jQuery(this.cells[0]).addClass('showDragHandle');
	}, function() {
		jQuery(this.cells[0]).removeClass('showDragHandle');
	});
</script>
