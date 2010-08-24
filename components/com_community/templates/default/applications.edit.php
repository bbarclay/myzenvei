<?php
/**
 * @package		JomSocial
 * @subpackage 	Template 
 * @copyright (C) 2008 by Slashes & Dots Sdn Bhd - All rights reserved!
 * @license http://www.jomsocial.com Copyrighted Commercial Software
 * 
 * @param	applications	An array of applications object
 */
defined('_JEXEC') or die();
?>

<div id="apps-core">
<h3><?php echo JText::_('CC CORE APPLICATIONS'); ?></h3>

	<?php
	if( $coreApplications )
	{
		for($i = 0; $i < count( $coreApplications ); $i++ )
		{
			$application	=& $coreApplications[$i];
	?>
	
	
	<div class="app-item dragHandle" id="app-<?php echo $application->id; ?>">
		
		<div class="app-avatar">
			<img src="<?php echo $application->appFavicon; ?>" alt="<?php echo $application->title; ?>" />
		</div>
		
		<h3><?php echo $application->title; ?></h3>
		
		<div class="app-item-description">
			<?php echo $application->description; ?>
		</div>	
		
		<div class="app-item-details">
			<a style="margin-right: 10px;" href="javascript:void(0);" onclick="joms.apps.showAboutWindow('<?php echo $application->apps; ?>');"><?php echo JText::_('CC APPLICATION LIST ABOUT'); ?></a>
			<a style="margin-right: 10px;" href="javascript:void(0);" onclick="joms.apps.showSettingsWindow('<?php echo $application->id; ?>','<?php echo $application->apps; ?>');"><?php echo JText::_('CC APPLICATION COLUMN SETTINGS'); ?></a>
			<a href="javascript:void(0);" onclick="joms.apps.showPrivacyWindow('<?php echo $application->apps; ?>');"><?php echo JText::_('CC APPLICATION COLUMN PRIVACY'); ?></a>	
		</div>	
		
	</div>		

	<?php
		}
	}
	else
	{
	?>
	<div class="app-item">
		<div class="app-item-empty"><?php echo JText::_('CC NO CORE APPLICATIONS INSTALLED');?></div>
	</div>
	<?php
	}
	?>
</div>



<div id="apps-mine">
	<h3><?php echo JText::_('CC INSTALLED APPLICATIONS'); ?></h3>
	<div id="apps-sortable">
	
	
		<?php
	
		if( $applications )
		{
			for($i = 0; $i < count( $applications ); $i++ )
			{
				$application	=& $applications[ $i ];
			
				if( !$application->coreapp )
				{
		?>
		
		<div class="app-item dragHandle" id="app-<?php echo $application->id; ?>">
		
			<div class="app-avatar">
				<img src="<?php echo $application->appFavicon; ?>" alt="<?php echo $application->title; ?>" />
			</div>
	
			<h3><?php echo $application->title; ?></h3>
			
			<div class="app-item-description">
				<?php echo $application->description; ?>
			</div>	
			
			<div class="app-item-details">
				<a style="margin-right: 10px;" href="javascript:void(0);" onclick="joms.apps.showAboutWindow('<?php echo $application->apps; ?>');"><?php echo JText::_('CC APPLICATION LIST ABOUT'); ?></a>
				<a style="margin-right: 10px;" href="javascript:void(0);" onclick="joms.apps.showSettingsWindow('<?php echo $application->id; ?>','<?php echo $application->apps; ?>');"><?php echo JText::_('CC APPLICATION COLUMN SETTINGS'); ?></a>
				<a href="javascript:void(0);" onclick="joms.apps.showPrivacyWindow('<?php echo $application->apps; ?>');"><?php echo JText::_('CC APPLICATION COLUMN PRIVACY'); ?></a>	
			</div>	
			
			<?php if( !$application->coreapp ): ?>
			<a class="remove-button" href="javascript:void(0);" onclick="joms.apps.windowTitle= '<?php echo JText::_('CC APPLICATION AJAX REMOVED');?>';joms.apps.remove('<?php echo $application->id; ?>');" title="<?php echo JText::_('CC APPLICATION BTN REMOVE'); ?>">
				<?php echo JText::_('CC APPLICATION LIST REMOVE'); ?>
			</a>
			<?php else: ?>
			<?php echo JText::_('CC APPLICATION LIST CANT REMOVE'); ?>
			<?php endif; ?>		
			
		</div>	
		<?php
				}
			}
		}
		else
		{
		?>
		<div class="app-item">
			<div class="app-item-empty"><?php echo JText::_('CC NO APPLICATIONS INSTALLED');?></div>
		</div>
		<?php
		}
		?>
	
	
	</div>
</div>
<script type="text/javascript" src="<?php echo rtrim(JURI::root(),'/'); ?>/components/com_community/assets/ui.core.js"></script>
<script type="text/javascript" src="<?php echo rtrim(JURI::root(),'/'); ?>/components/com_community/assets/ui.sortable.js"></script>
<script type='text/javascript'>	
jQuery('#apps-sortable').sortable({
	cursor: 'move',
	start: function(event, ui) {
		ui.item.addClass('onDrag');
	},
	stop: function(event, ui) {
		
		var inputs = [];
		var val = [];
		
		jQuery('#apps-sortable .app-item').each( function() {				
			var appid = jQuery(this).attr('id').split('-');
			inputs.push('app-list[]=' + appid[1]);
			jQuery(this).removeClass('onDrag');
		});
		
		jax.call('community', 'apps,ajaxSaveOrder', inputs.join('&'));
	}
});
</script>
