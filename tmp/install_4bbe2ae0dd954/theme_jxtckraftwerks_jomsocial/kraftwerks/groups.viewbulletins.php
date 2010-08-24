<?php
/**
 * @package		JomSocial
 * @subpackage 	Template 
 * @copyright (C) 2008 by Slashes & Dots Sdn Bhd - All rights reserved!
 * @license http://www.jomsocial.com Copyrighted Commercial Software
 * 
 * @params	categories Array	An array of categories
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

<?php echo $bulletinsHTML; ?>
<!-- Pagination -->
<div class="pagination-container">
	<?php echo $pagination->getPagesLinks(); ?>
</div>
</div>
<div class="app-box-footer"> <div class="app-box-footer"></div></div>
</div>