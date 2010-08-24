<?php
/**
 * @package		JomSocial
 * @subpackage 	Template 
 * @copyright (C) 2008 by Slashes & Dots Sdn Bhd - All rights reserved!
 * @license http://www.jomsocial.com Copyrighted Commercial Software
 * 
 * @param	my		User object
 **/
defined('_JEXEC') or die();
?>
<div class="cModule">
<p><?php echo JText::_('CC INVITE TEXT'); ?></p>
<form action="<?php echo CRoute::getURI(); ?>" method="post">

<dl class="2cols" style="width: 80%; margin: 0 auto;">
    <dt class="col-left">
        <?php echo JText::_('CC INVITE FROM'); ?>:
    </dt>
    <dd class="col-right" style="margin: 0pt 0pt 10px;">
        <div class="inputbox" style="width: 100%;"><strong><?php echo $my->email; ?></strong></div>
	</dd>
    
    <dt class="col-left">
        <?php echo JText::_('CC INVITE TO'); ?>:
        
    </dt>
    <dd class="col-right">
        <textarea class="inputbox" style="width: 100%; height: 100px; margin: 0;" name="emails"><?php echo (! empty($post['emails'])) ? $post['emails'] : '' ; ?></textarea><br />
        <span class="small" style="padding: 0 0 0 10px; line-height: normal;"><?php echo JText::_('CC SEPARATE BY COMMA'); ?></span>
	</dd>
    
    <dt class="col-left">
        <?php echo JText::_('CC INVITE MESSAGE'); ?>:
    </dt>
    <dd class="col-right">
        <textarea class="inputbox" style="width: 100%; height: 100px; margin: 0;" name="message"><?php echo (! empty($post['message'])) ? $post['message'] : '' ; ?></textarea><br />
        <span class="small" style="padding: 0 0 0 10px; line-height: normal;"><?php echo JText::_('CC OPTIONAL');?></span>
	</dd>
    
    <dt class="col-left">
    </dt>
    
    <dd class="col-right">
        <input type="hidden" name="action" value="invite" />
        <input type="submit" class="button" value="<?php echo JText::_('CC INVITE BUTTON'); ?>">
	</dd>
</dl>
</form>
</div>

<?php if( !empty( $friends ) ) : ?>
<hr/>
<div class="suggest-friends">
	<h3><?php echo JText::_('CC FRIEND SUGGESTION'); ?></h3>
	<?php foreach( $friends as $user ) : ?>
	<div class="mini-profile">
		<div class="mini-profile-avatar">
			<a href="<?php echo $user->profileLink; ?>">
				<img class="avatar" src="<?php echo $user->getThumbAvatar(); ?>" alt="<?php echo $user->getDisplayName(); ?>" />
			</a>
		</div>
		<div class="mini-profile-details">
			<h3 class="name">
				<a href="<?php echo $user->profileLink; ?>"><strong><?php echo $user->getDisplayName(); ?></strong></a>
			</h3>
		
			<div class="mini-profile-details-status"><?php echo $user->getStatus() ;?></div>
		<div class="icons">
		    <span class="icon-group"><a href="<?php echo CRoute::_('index.php?option=com_community&view=friends&userid=' . $user->id );?>"><?php echo JText::sprintf( (cIsPlural($user->friendsCount)) ? 'CC FRIENDS COUNT MANY' : 'CC FRIENDS COUNT' , $user->friendsCount);?></a></span>
			<?php if( $my->id != $user->id && $config->get('enablepm') ): ?>
	        <span class="icon-write"><a onclick="joms.messaging.loadComposeWindow(<?php echo $user->id; ?>)" href="javascript:void(0);"><?php echo JText::_('CC WRITE MESSAGE'); ?></a></span>
	        <?php endif; ?>
			<!-- new online icon -->
			<?php if($user->isOnline()): ?>
			<span class="icon-online-overlay"><?php echo JText::_('CC ONLINE'); ?></span>
			<?php endif; ?>	        
		</div>
		<div class="clr"></div>
	</div>
	<?php endforeach; ?>
</div>
<?php endif; ?>