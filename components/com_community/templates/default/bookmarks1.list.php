<?php
/**
 * @package		JomSocial
 * @subpackage 	Template 
 * @copyright (C) 2008 by Slashes & Dots Sdn Bhd - All rights reserved!
 * @license http://www.jomsocial.com Copyrighted Commercial Software
 * 
 */
defined('_JEXEC') or die();
?>
<div style="margin-bottom: 5px; font-weight: 700;"><?php echo JText::_('CC SHARE THIS VIA LINK');?></div>
<ul class="bookmarks-list">
	<?php
	foreach($bookmarks as $bookmark)
	{
	?>
	<li><a href="<?php echo $bookmark->link;?>" target="_blank" class="<?php echo $bookmark->className;?>"><?php echo $bookmark->name;?></a></li>
	<?php
	}
	?>
</ul>
<div class="clr"></div>
<div style="margin-bottom: 5px; font-weight: 700;"><?php echo JText::_('CC SHARE THIS VIA EMAIL');?></div>
<div><input type="text" id="bookmarks-email" name="bookmarks-email" class="bookmarks-email" /></div>
<div style="margin-bottom: 5px;"><?php echo JText::_('CC SHARE THIS VIA EMAIL INFO');?></div>
<div style="margin-bottom: 5px; font-weight: 700;"><?php echo JText::_('CC SHARE THIS MESSAGE');?></div>
<div><textarea rows="3" class="bookmarks-message" id="bookmarks-message" name="bookmarks-message"></textarea></div>