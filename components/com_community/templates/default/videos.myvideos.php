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

<?php echo $videosHTML;?>
<div class="pagination-container">
	<?php echo $pagination->getPagesLinks(); ?>
</div>
