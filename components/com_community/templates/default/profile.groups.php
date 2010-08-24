<?php
/**
 * @package		JomSocial
 * @subpackage 	Template 
 * @copyright (C) 2008 by Slashes & Dots Sdn Bhd - All rights reserved!
 * @license http://www.jomsocial.com Copyrighted Commercial Software
 * 
 * @param	groups		Array	Array of groups object
 * @param	total		integer total number of groups
 * @param	user		CFactory User object 
 */
defined('_JEXEC') or die();
?>
<div class="cModule">
	<h3><span><?php echo JText::_('CC PROFILE GROUPS'); ?></span></h3>
	
	<div class="small"><?php echo JText::sprintf((cIsPlural($total)) ? 'CC GROUPS COUNT MANY' : 'CC GROUPS COUNT', $total); ?></div>
	<ul class="cThumbList clrfix">

	<?php
	for($i = 0; ($i < 12) && ($i < count($groups)); $i++)
	{
		$row	=& $groups[$i];
	?>
	<li>
		<a href="<?php echo $row->link;?>">
			<img width="45" title="<?php echo $row->name;?>::<?php echo $row->description;?>" alt="<?php echo $row->name;?>" src="<?php echo $row->avatar; ?>" class="avatar jomTips"/>
		</a>
	</li>
	<?php
	}
	?>
</ul>
	<div style="clear: both;"></div>
	<div style="text-align:right;">
		<a href="<?php echo CRoute::_('index.php?option=com_community&view=groups&userid=' . $user->id ); ?>">
			<?php echo JText::_('CC SHOW ALL GROUPS'); ?>
		</a>
	</div>
	
</div>
	
