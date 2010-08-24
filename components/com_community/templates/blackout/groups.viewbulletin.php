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
<div class="page-actions">
  <?php echo $bookmarksHTML;?>
  <div class="clr"></div>
</div>
<div class="community-groups-results-item">
	<div class="icon-calendar"><?php echo JHTML::_('date' , $bulletin->date, JText::_('DATE_FORMAT_LC')); ?></div>
	<hr />
	<?php echo $bulletin->message;?>
</div>