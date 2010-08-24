<?php
/**
 * @package		JomSocial
 * @subpackage 	Template 
 * @copyright (C) 2008 by Slashes & Dots Sdn Bhd - All rights reserved!
 * @license http://www.azrul.com Copyrighted Commercial Software
 * 
 * @param	groups		Array	Array of groups object
 * @param	total		integer total number of groups
 * @param	user		CFactory User object 
 */
defined('_JEXEC') or die();
?>
<h2 class="app-box-title" style="position: relative;">
	<?php echo JText::_('CC PROFILE GROUPS'); ?>
    <a href="<?php echo CRoute::_('index.php?option=com_community&view=groups&userid=' . $user->id ); ?>" class="app-title-link">
		<span><?php echo JText::_('CC SHOW ALL FRIENDS'); ?></span>
	</a>
</h2>


<div class="small" style="text-align: right;"><?php echo JText::sprintf((cIsPlural($total)) ? 'CC GROUPS COUNT MANY' : 'CC GROUPS COUNT', $total); ?></div>
<div style="margin: 0 auto 10px;">
	<ul class="friend-right-info">
		<?php
		for($i = 0; ($i < 12) && ($i < count($groups)); $i++)
		{
			$row	=& $groups[$i];
		?>
		<li>
			<a href="<?php echo $row->link;?>">
				<img title="<?php echo $row->name;?>::<?php echo $row->description;?>" alt="<?php echo $row->name;?>" src="<?php echo $row->avatar; ?>" width="33" class="avatar hasTip"/>
			</a>
		</li>
		<?php
		}
		?>
	</ul>
	<div class="clr"></div>
</div>
	
