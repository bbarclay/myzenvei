<?php
/**
 * @package		JomSocial
 * @subpackage 	Template 
 * @copyright (C) 2008 by Slashes & Dots Sdn Bhd - All rights reserved!
 * @license http://www.jomsocial.com Copyrighted Commercial Software
 * 
 * 
 */
defined('_JEXEC') or die();
?>
<div class="app-box">
<div class="app-box-header">
	<div class="app-box-header">
	</div>
</div>
<div class="app-box-content">
<div class="video-search-form">
	<form name="searchVideo" action="<?php echo CRoute::getURI(); ?>" method="get">
		<input type="text" class="inputbox" id="search-text" name="search-text" size="50" />
		<input type="hidden" name="option" value="com_community" />
		<input type="hidden" name="task" value="search" />
		<input type="hidden" name="view" value="videos" />
		<input type="submit" name="search" class="button" value="<?php echo JText::_('CC BUTTON SEARCH');?>"/>
		<input type="hidden" name="Itemid" value="<?php echo CRoute::getItemId(); ?>" />
	</form>
</div>

<?php echo $videosHTML; ?>
</div>
<div class="app-box-footer"> <div class="app-box-footer"></div></div>
</div>