<?php
/**
 * @package		JomSocial
 * @subpackage 	Template 
 * @copyright (C) 2008 by Slashes & Dots Sdn Bhd - All rights reserved!
 * @license http://www.jomsocial.com Copyrighted Commercial Software
 * 
 * @params	sortings	string	HTML code for the sorting
 * @params	groupsHTML	string HTML code for the group listings
 * @params	pagination	JPagination JPagination object 
 */
defined('_JEXEC') or die();
?>

<?php echo $sortings; ?>
<div id="community-groups-wrap">
	<?php echo $groupsHTML; ?>
	<div class="pagination-container">
		<?php echo $pagination->getPagesLinks(); ?>
	</div>
</div>