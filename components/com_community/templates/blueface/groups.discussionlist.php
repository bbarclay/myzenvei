<?php
/**
 * @package		JomSocial
 * @subpackage 	Template 
 * @copyright (C) 2008 by Slashes & Dots Sdn Bhd - All rights reserved!
 * @license http://www.jomsocial.com Copyrighted Commercial Software
 *
 * @param	$discussions	An array of discussions object
 * @param	$groupId		The group id
 * @param	$total			The number of total discussions 
 */
defined('_JEXEC') or die();


if( $discussions )
{
	for($i = 0; $i < count( $discussions ); $i++ )
	{
		$row	=& $discussions[$i];
?>
	<div id="discuss_<?php echo $row->id; ?>" style="border-bottom: 1px solid #ECEFF5; overflow: hidden; padding: 10px 0">
		<div style="float: left; margin: 0 0 5px 16px; width: 95%;">
			<div class="icon-bubble" style="width: 70%; float: left; font-size: 14px;font-weight: bold;text-transform: capitalize; text-decoration: underline; margin: 0;">
				<a href="<?php echo CRoute::_('index.php?option=com_community&view=groups&task=viewdiscussion&groupid=' . $groupId. '&topicid=' . $row->id ); ?>">
					<?php echo $row->title; ?>
				</a>
			</div>
			<div class="icon-replies" style="float: right; margin: 0;">
				<a href="<?php echo CRoute::_('index.php?option=com_community&view=groups&task=viewdiscussion&groupid=' . $groupId . '&topicid=' . $row->id ); ?>">
					<?php echo JText::sprintf( (cIsPlural($row->count)) ? 'CC TOTAL REPLIES MANY' : 'CC TOTAL REPLIES', $row->count); ?>
				</a>
			</div>
			<div class="clr"></div>
			<div style="color: gray; padding: 0 0 0 20px;">
				<div><small><?php echo JText::sprintf('CC DISCUSS STARTED BY' , $row->user->getDisplayName() ); ?></small></div>
				<?php
				if( isset( $row->lastreplier ) && !empty( $row->lastreplier ) )
				{
				?>
					<div><small>
						<?php echo JText::sprintf('CC DISCUSSION LAST REPLIED' , $row->lastreplier->post_by->getDisplayName() , JHTML::_('date', $row->lastreplier->date, JText::_('DATE_FORMAT_LC')) ); ?>
					</small></div>
				<?php
				}
				?>
			</div>
		</div>
		<div class="clr"></div>
	</div>
	<?php
	}
	?>
<?php
}
else
{
?>
	<div class="empty"><?php echo JText::_('CC NO DISCUSSIONS'); ?></div>
<?php
}
?>