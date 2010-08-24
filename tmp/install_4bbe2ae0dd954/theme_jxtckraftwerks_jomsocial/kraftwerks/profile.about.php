<?php
/**
 * @package		JomSocial
 * @subpackage 	Template 
 * @copyright (C) 2008 by Slashes & Dots Sdn Bhd - All rights reserved!
 * @license http://www.jomsocial.com Copyrighted Commercial Software
 * 
 * @param	profile			A Profile object that contains profile fields for this specific user
 * @param	profile->
 * @params	isMine		boolean is this profile belongs to me?
 */
defined('_JEXEC') or die();
?>
<div class="app-box">
		<div class="app-box-header">
		<div class="app-box-header">
			<h2 style="float:left;width:80%;" class="app-box-title"><?php echo JText::_('CC ABOUT ME');?></h2>
			<div style="float:right;"><?php if( $isMine ): ?>
	<a class="editprofilelink" href="<?php echo CRoute::_('index.php?option=com_community&view=profile&task=edit');?>" title="<?php echo JText::_('CC EDIT PROFILE'); ?>">[ <?php echo JText::_('CC EDIT PROFILE'); ?> ]</a>
	<?php endif; ?></div>
		</div></div>		
	<div class="app-box-content">
	<?php foreach( $profile['fields'] as $groupName => $items ): ?>

	<?php if( $groupName != 'ungrouped' ): ?>
	<h4 class="infoGroupTitle"><?php echo JText::_( $groupName ); ?></h4>
	<?php endif; ?>
	
	<dl class="profile-right-info">


		<?php foreach( $items as $item ): ?>
			<dt><?php echo JText::_( $item['name'] ); ?></dt>
	    	<dd>
	    		<?php if(!empty($item['searchLink'])) :?>
					<a href="<?php echo $item['searchLink']; ?>"> 
				<?php endif; ?>
				
				<?php echo CProfileLibrary::getFieldData( $item['type'] , $item['value'] ); ?>
				
				<?php if(!empty($item['searchLink'])) :?>
					</a> 
				<?php endif; ?>
			</dd>
	    <?php endforeach; ?>
	</dl>
	<?php endforeach; ?>
	</div>
	<div class="app-box-footer"> <div class="app-box-footer"> </div> </div>
	</div>
