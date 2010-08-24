<?php
/**
 * @package		JomSocial
 * @subpackage 	Template 
 * @copyright (C) 2008 by Slashes & Dots Sdn Bhd - All rights reserved!
 * @license http://www.azrul.com Copyrighted Commercial Software
 * 
 * @param	profile			A Profile object that contains profile fields for this specific user
 * @param	profile->
 * @params	isMine		boolean is this profile belongs to me?
 */
defined('_JEXEC') or die();
?>
	<h2 class="app-box-title">
		<?php echo JText::_('CC ABOUT ME');?>
		<?php if( $isMine ) : ?>
		<span>
			<a class="app-title-link" href="<?php echo CRoute::_('index.php?option=com_community&view=profile&task=edit');?>">[ <?php echo JText::_('CC EDIT PROFILE');?> ]</a>
		</span>
		<?php endif; ?>
	</h2>
	

	<?php foreach( $profile['fields'] as $groupName => $items ): ?>
	<ul class="profile-info">
		<?php if( $groupName != 'ungrouped' ): ?>
			<li class="title"><?php echo ($groupName != 'ungrouped') ? JText::_( $groupName ) : ''; ?></li>
		<?php endif; ?>

		<?php foreach( $items as $item ): ?>
			<li class="info-title"><?php echo JText::_( $item['name'] ); ?></li>
	    	<li class="info-detail">
	    		<?php if(!empty($item['searchLink'])) :?>
					<a href="<?php echo $item['searchLink']; ?>"> 
				<?php endif; ?>
				
				<?php echo CProfileLibrary::getFieldData( $item['type'] , $item['value'] ); ?>
				
				<?php if(!empty($item['searchLink'])) :?>
					</a> 
				<?php endif; ?>
			</li>
	    <?php endforeach; ?>
	</ul>
	<?php endforeach; ?>