<?php
/**
 * @package		JomSocial
 * @subpackage 	Template 
 * @copyright (C) 2008 by Slashes & Dots Sdn Bhd - All rights reserved!
 * @license http://www.jomsocial.com Copyrighted Commercial Software
 * 
 * @param	albums	An array of album objects.
 * @param	user	Current browser's CUser object. 
 * @params	isOwner		boolean Determines if the current photos view belongs to the browser
 */
defined('_JEXEC') or die();
?>
<div class="app-box">
<div class="app-box-header">
	<div class="app-box-header">
		<h2 class="app-box-title"></h2>
	</div>
</div>
<div class="app-box-content">

<div>
	<?php echo $albumsHTML; ?>
</div>
<div class="clr"></div>
<div class="pagination-container">
	<?php echo $pagination->getPagesLinks(); ?>
</div>
</div>
<div class="app-box-footer"> <div class="app-box-footer"></div></div>
</div>
