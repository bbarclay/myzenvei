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
<div>
<?php echo $discussionsHTML; ?>
</div>
<!-- Pagination -->
<div class="pagination-container">
	<?php echo $pagination->getPagesLinks(); ?>
</div>