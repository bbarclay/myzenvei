<?php
/**
 * @package		JomSocial
 * @subpackage 	Template 
 * @copyright (C) 2008 by Slashes & Dots Sdn Bhd - All rights reserved!
 * @license http://www.jomsocial.com Copyrighted Commercial Software
 * 
 */
defined('_JEXEC') or die();

if ( !empty( $groups ) ) {
	$count = 1;
?>	
		 <div class="app-box">
			<div class="app-box-header">
			<div class="app-box-header">
               	<h2 class="app-box-title"><?php echo JText::_('CC GROUP LATEST'); ?></h2>
			</div>
			</div>
			<div class="app-box-content out">		
				<div class="app-box-shadow"><div class="filterlink">				
				 <div style="float: right;">
				<a href="<?php echo JText::_('index.php?option=com_community&view=groups'); ?>">
					<div class="Button">
						<div class="ButtonLeft"></div>
						<div class="ButtonMiddle"><p class="Text"><?php echo JText::_('CC VIEW ALL GROUPS'); ?></p></div>
						<div class="ButtonRight"></div>
					</div>	
				</a></div>
				</div>
				</div>
				<div class="app-box-info">
				<ul class="cThumbList clrfix">
		
				<?php foreach ( $groups as $group ) { ?>
				
				<?php if ( $count == 1 ) { ?>
				<li class="featured">
					<a href="<?php echo CRoute::_('index.php?option=com_community&view=groups&task=viewgroup&groupid='.$group->id); ?>"><img src="<?php echo JURI::root() . '/' . $group->avatar; ?>" alt="<?php echo $group->name; ?>" /></a>
					
					<div class="title">   
						<a href="<?php echo CRoute::_('index.php?option=com_community&view=groups&task=viewgroup&groupid='.$group->id); ?>"><?php echo JText::_( $group->name ); ?></a>
					</div> 
					
					<!--
					<div class="desc-title">
						<?php echo JText::_('CC GROUP INFO DESCRIPTION'); ?>
					</div>
					-->
					
					<div class="desc-details">
						<?php echo JText::_( $group->description ); ?>
					</div>			
				</li>
				<?php } elseif ( $count < 5 ) { ?>
					<li>
						<a href="<?php echo CRoute::_('index.php?option=com_community&view=groups&task=viewgroup&groupid='.$group->id); ?>"><img src="<?php echo JURI::root() . '/' . $group->thumb; ?>" alt="<?php echo $group->name; ?>" class="avatar jomTips" width="45" title="<?php echo htmlspecialchars( JText::_( $group->name )); ?>::<?php echo JText::_( $group->description ); ?>" /></a>
					</li>
				<?php } ?>
				<?php $count++; ?>
				
				<?php } ?>		
				</ul>
				</div>
			</div>
			<div class="app-box-footer"><div class="app-box-footer">				
			</div></div>
		</div>			
<?php
}
?>