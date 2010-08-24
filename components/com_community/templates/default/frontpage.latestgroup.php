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
		<h3><span><?php echo JText::_('CC GROUP LATEST'); ?></span></h3>
		<ul class="cThumbList clrfix">

		<?php foreach ( $groups as $group ) { ?>
		
		<?php if ( $count == 1 ) { ?>
		<li class="featured">
			<a href="<?php echo CRoute::_('index.php?option=com_community&view=groups&task=viewgroup&groupid='.$group->id); ?>"><img src="<?php echo JURI::root() . $group->avatar; ?>" alt="<?php echo $group->name; ?>" /></a>
			
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
		<?php } elseif ( $count > 1 ) { ?>
			<li>
				<a href="<?php echo CRoute::_('index.php?option=com_community&view=groups&task=viewgroup&groupid='.$group->id); ?>"><img src="<?php echo JURI::root() . $group->thumb; ?>" alt="<?php echo $group->name; ?>" class="avatar jomTips" width="45" title="<?php echo htmlspecialchars( JText::_( $group->name )); ?>::<?php echo JText::_( $group->description ); ?>" /></a>
			</li>
		<?php } ?>
		<?php $count++; ?>
		
		<?php } ?>
		
		</ul>

		<div class="app-box-footer">
	        <a href="<?php echo JText::_('index.php?option=com_community&view=groups'); ?>"><?php echo JText::_('CC VIEW ALL GROUPS'); ?></a>
	    </div>

<?php
}
?>