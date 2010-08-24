<?php
/**
 * @package		JomSocial
 * @subpackage 	Template 
 * @copyright (C) 2008 by Slashes & Dots Sdn Bhd - All rights reserved!
 * @license http://www.azrul.com Copyrighted Commercial Software
 * 
 * @param	friends		array or CUser (all user)
 * @param	total		integer total number of friends
 * @param	user		CFactory User object 
 */
defined('_JEXEC') or die();
?>
<h2 class="app-box-title" style="position: relative;">
	<?php echo JText::_('CC PROFILE FRIENDS'); ?>
	
	<a href="<?php echo CRoute::_('index.php?option=com_community&view=friends&userid=' . $user->id ); ?>" class="app-title-link">
		<span><?php echo JText::_('CC SHOW ALL'); ?></span>
	</a>
</h2>
<div class="clr"></div>
<div class="small" style="text-align: right;"><?php echo JText::sprintf((cIsPlural($total)) ? 'CC TOTAL FRIENDS COUNT MANY': 'CC TOTAL FRIENDS COUNT' , $total); ?></div>
<div style="margin: 0 auto 10px;">
	<ul class="friend-right-info">
		<?php
		for($i = 0; ($i < 12) && ($i < count($friends)); $i++) {
			$friend =& $friends[$i];
		?>
		<li>
			<a href="<?php echo CRoute::_('index.php?option=com_community&view=profile&userid='. $friend->id); ?>">
				<img alt="<?php echo $friend->getDisplayName();?>" title="<?php echo $friend->getTooltip(); ?>" src="<?php echo $friend->getThumbAvatar(); ?>" width="33" class="avatar hasTip"/>
			</a>
		</li>
		<?php } ?>
	</ul>
	<div class="clr"></div>
</div>


