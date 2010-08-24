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

<?php echo $sortings; ?>
<div class="app-box">
<div class="app-box-header">
	<div class="app-box-header">
	</div>
</div>
<div class="app-box-content">
<?php echo $videosHTML;?>
<div class="pagination-container">
	<?php echo $pagination->getPagesLinks(); ?>
</div>
</div>
<div class="app-box-footer"> <div class="app-box-footer"></div></div>
</div>