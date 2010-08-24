<?php
/**
 * @package		JomSocial
 * @subpackage 	Template 
 * @copyright (C) 2008 by Slashes & Dots Sdn Bhd - All rights reserved!
 * @license http://www.azrul.com Copyrighted Commercial Software
 * 
 */
defined('_JEXEC') or die();
?>

<div id="request-notice"></div>

<?php if ( $rows ) { ?>
<ul class="normal-list">
<?php for($i = 0; $i < count( $rows ); $i++ ) { ?>

	<li class="normal-list-item">
	    <!-- Avatar -->
	    <div class="mini-profile-avatar">
			<a href="<?php echo $rows[$i]->user->profileLink; ?>">
				<img class="avatar" src="<?php echo $rows[$i]->user->getThumbAvatar(); ?>" alt="<?php echo $rows[$i]->user->getDisplayName(); ?>" />
			</a>
		</div>

	    <!-- Details -->
		<div class="mini-profile-details">
			<div class="friend-name"><a href="<?php echo $rows[$i]->user->profileLink; ?>"><?php echo $rows[$i]->user->getDisplayName(); ?></a></div>

			<div class="friend-status"><?php echo $rows[$i]->user->getStatus() ;?></div>

            <a class="approve" href="javascript:void(0);" onclick="jax.call('community' , 'friends,ajaxApproveRequest' , '<?php echo $rows[$i]->connection_id; ?>');">
				<?php echo JText::_('CC PENDING ACTION APPROVE'); ?>
			</a>
			<a class="remove" href="javascript:void(0);" onclick="jax.call('community','friends,ajaxRejectRequest','<?php echo $rows[$i]->connection_id; ?>');">
				<?php echo JText::_('Remove'); ?>
			</a>
		</div>

		<!-- Actions -->
		<div class="mini-profile-actions">
		    <span class="icon-group"><?php echo JText::sprintf( (cIsPlural($rows[$i]->user->friendsCount)) ? 'CC FRIENDS COUNT MANY' : 'CC FRIENDS COUNT' , $rows[$i]->user->friendsCount);?></span>
		    <?php if($rows[$i]->user->isOnline()): ?>
			<span class="icon-online"><?php echo JText::_('CC ONLINE'); ?></span>
		    <?php else: ?>
		    <span class="icon-offline"><?php echo JText::_('CC OFFLINE'); ?></span>
		    <?php endif; ?>

			<?php if( $my->id != $rows[$i]->user->id ): ?>
	        <a onclick="joms.messaging.loadComposeWindow(<?php echo $rows[$i]->user->id; ?>)" class="icon-write" href="javascript:void(0);"><?php echo JText::_('CC WRITE MESSAGE'); ?></a>
	        <?php endif; ?>
		</div>
	</li>

<?php } ?>
</ul>
<?php } ?>