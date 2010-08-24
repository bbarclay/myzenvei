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
	<div id="bulletin-data"><?php echo $bulletin->message;?></div>
	<div id="bulletin-edit-data" style="display: none;">
		<form name="addnews" method="post" action="<?php echo CRoute::_('index.php?option=com_community&view=groups&task=editnews'); ?>">
			<div>
				<label style="font-weight: 700;" for="title">News Title:</label>
			</div>
			<input type="text" value="<?php echo $bulletin->title;?>" name="title" class="inputbox" style="width: 90%;" />
			<div>
				<label style="font-weight: 700;" for="description">News Description:</label>
			</div>
		<?php
			if( $config->get( 'htmleditor' ) )
			{
		?>
		<?php echo $editor->display( 'message',  $bulletin->message , '95%', '450', '10', '20' , false ); ?>
		<?php
			}
			else
			{
		?>
			<textarea style="width: 350px;" name="message"><?php echo $bulletin->message;?></textarea>
		<?php
			}
		?>
		<div style="text-align: center; padding-top: 20px;">
			<input type="hidden" value="<?php echo $bulletin->groupid;?>" name="groupid" />
			<input type="hidden" value="<?php echo $bulletin->id;?>" name="bulletinid" />
			<input type="submit" value="<?php echo JText::_('CC BUTTON SAVE'); ?>" class="button" />
			<button class="button" onclick="joms.groups.editBulletin();return false;"><?php echo JText::_('CC BUTTON CANCEL'); ?></button>
		</div>
		</form>
	</div>
</div>