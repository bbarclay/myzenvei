<?php 
/**
 * @package		JomSocial
 * @subpackage 	Template 
 * @copyright (C) 2008 by Slashes & Dots Sdn Bhd - All rights reserved!
 * @license http://www.jomsocial.com Copyrighted Commercial Software
 * 
 */
defined('_JEXEC') or die();
?>

<!-- begin: .app-box -->
<div id="<?php echo $boxid; ?>" class="app-box">
	<!-- begin: .app-box-header -->
	<div class="app-box-header">
		<div class="app-box-header">
			<h2 class="app-box-title"><?php echo $title; ?></h2>
			<div class="app-box-menus">
				<div class="app-box-menu toggle">
					<a class="app-box-menu-icon" href="javascript: void(0)" onclick="joms.apps.toggle('#<?php echo $boxid; ?>');"><span class="app-box-menu-title"><?php echo JText::_('CC EXPAND');?></span></a>
				</div>
			
				<?php 
				/**
				 * Only show this if you are the owner
				 */				 				
				if ( $isOwner) { 
				?>
	            <div class="app-box-menu options">
	            	<a class="app-box-menu-icon" href="javascript: void(0)" onclick="joms.apps.showSettingsWindow('<?php echo $appid;?>','<?php echo $appname;?>');">
	                	<span class="app-box-menu-title"><?php echo JText::_('CC OPTIONS');?></span>
	                </a>
	            </div>
	            <?php } ?>
	            
			</div>
		</div>
	</div>
	<!-- end: .app-box-header -->


	<!-- begin: .app-box-content -->
	<div class="app-box-content">
		
		<?php echo $content; ?>
		
	</div>
	<div class="app-box-footer"> <div class="app-box-footer"> </div> </div>
	<!-- end: .app-box-content -->
	
</div>
<!-- end: .app-box -->