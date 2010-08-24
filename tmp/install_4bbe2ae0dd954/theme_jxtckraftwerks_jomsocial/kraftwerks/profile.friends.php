<?php
/**
 * @package		JomSocial
 * @subpackage 	Template 
 * @copyright (C) 2008 by Slashes & Dots Sdn Bhd - All rights reserved!
 * @license http://www.jomsocial.com Copyrighted Commercial Software
 * 
 * @param	friends		array or CUser (all user)
 * @param	total		integer total number of friends
 * @param	user		CFactory User object 
 */
defined('_JEXEC') or die();
?>
<div class="app-box">
		<div class="app-box-header">
		<div class="app-box-header">
		<h2 class="app-box-title"><?php echo JText::_('CC PROFILE FRIENDS'); ?></h2>
		</div></div>
	<div class="app-box-content">
	<div class="small"><?php echo JText::sprintf((cIsPlural($total)) ? 'CC TOTAL FRIENDS COUNT MANY': 'CC TOTAL FRIENDS COUNT' , $total); ?></div>
	<ul class="cThumbList clrfix">
		<?php
		for($i = 0; ($i < 12) && ($i < count($friends)); $i++) {
			$friend =& $friends[$i];
		?>
		<li>
			<a href="<?php echo CRoute::_('index.php?option=com_community&view=profile&userid='.$friend->id); ?>"><img alt="<?php echo $friend->getDisplayName();?>" title="<?php echo $friend->getTooltip(); ?>" src="<?php echo $friend->getThumbAvatar(); ?>" class="avatar jomTips" width="45" height="45" /></a>
		</li>
		<?php } ?>
	</ul>
	<div style="clear: both;"></div>
	</div>
	<div class="app-box-footer"> <div class="app-box-footer"><div class="filterlink" style="margin-top:5px;">
	<a href="<?php echo CRoute::_('index.php?option=com_community&view=friends&userid=' . $user->id ); ?>">	
	<div class="Button">
		<div class="ButtonLeft"></div>
		<div class="ButtonMiddle"><p class="Text"><?php echo JText::_('CC SHOW ALL FRIENDS'); ?></p></div>
		<div class="ButtonRight"></div>
	</div>
	</a> </div> </div>		</div>
</div>
