<?php
/**
 * @package		JomSocial
 * @subpackage 	Template
 * @copyright (C) 2008 by Slashes & Dots Sdn Bhd - All rights reserved!
 * @license http://www.azrul.com Copyrighted Commercial Software
 *
 * @param	author		string
 * @param	categories	An array of category objects.
 * @params	groups		An array of group objects.
 * @params	pagination	A JPagination object.
 * @params	isJoined	boolean	determines if the current browser is a member of the group
 * @params	isMine		boolean is this wall entry belong to me ?
 * @params	config		A CConfig object which holds the configurations for Jom Social
 */
defined('_JEXEC') or die();
?>
<?php echo $sortings; ?>
<?php if( !empty( $friends ) ) : ?>
<ul class="normal-list">
	<?php foreach( $friends as $user ) : ?>
	<li class="normal-list-item hasTip" title="<?php echo $user->getDisplayName(); ?>::<?php echo $user->getStatus() ;?>">
	    <!-- Avatar -->
	    <div class="mini-profile-avatar">
			<a href="<?php echo $user->profileLink; ?>">
				<img class="avatar" src="<?php echo $user->getThumbAvatar(); ?>" alt="<?php echo $user->getDisplayName(); ?>" />
			</a>
		</div>
	
	    <!-- Details -->
		<div class="mini-profile-details">
			<div class="friend-name"><a href="<?php echo $user->profileLink; ?>"><?php echo $user->getDisplayName(); ?></a></div>

			<div class="friend-status"><?php echo $user->getStatus() ;?></div>
			<?php
			if( $isMine )
			{
			?>
			<a class="remove" onclick="if(!confirm('<?php echo JText::_('CC CONFIRM DELETE FRIEND'); ?>'))return false;" href="<?php echo CRoute::_('index.php?option=com_community&view=friends&task=remove&fid='.$user->id); ?>">
				<?php echo JText::_('Remove'); ?>
			</a>
			<?php
			}
			?>
		</div>
		
		<!-- Actions -->
		<div class="mini-profile-actions">
		    <span class="icon-group">
				<a href="<?php echo CRoute::_('index.php?option=com_community&view=friends&userid=' . $user->id );?>"><?php echo JText::sprintf( (cIsPlural($user->friendsCount)) ? 'CC FRIENDS COUNT MANY' : 'CC FRIENDS COUNT' , $user->friendsCount);?></a>
			</span>
		    <?php if($user->isOnline()): ?>
			<span class="icon-online"><?php echo JText::_('CC ONLINE'); ?></span>
		    <?php else: ?>
		    <span class="icon-offline"><?php echo JText::_('CC OFFLINE'); ?></span>
		    <?php endif; ?>

			<?php if( $my->id != $user->id ): ?>
	        <a onclick="joms.messaging.loadComposeWindow(<?php echo $user->id; ?>)" class="icon-write" href="javascript:void(0);"><?php echo JText::_('CC WRITE MESSAGE'); ?></a>
	        <?php endif; ?>
		</div>
	</li>
	<?php endforeach; ?>
</ul>
<div style="clear: left;"></div>
<?php endif; ?>