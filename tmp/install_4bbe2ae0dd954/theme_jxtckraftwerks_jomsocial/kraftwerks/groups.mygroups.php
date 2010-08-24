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
<div class="app-box">
<div class="app-box-header">
	<div class="app-box-header">
		<h2 class="app-box-title"></h2>
	</div>
</div>
<div class="app-box-content">
<div id="community-groups-wrap">
	<?php echo $groupsHTML; ?>
	<div class="pagination-container">
		<?php echo $pagination->getPagesLinks(); ?>
	</div>
</div>
</div>
<div class="app-box-footer"> <div class="app-box-footer"></div></div>
</div>