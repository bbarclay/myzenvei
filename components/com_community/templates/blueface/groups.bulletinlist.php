<?php
/**
 * @package		JomSocial
 * @subpackage 	Template 
 * @copyright (C) 2008 by Slashes & Dots Sdn Bhd - All rights reserved!
 * @license http://www.jomsocial.com Copyrighted Commercial Software
 *
 * @param	$bulletins	An array of discussions object
 * @param	$groupId		The group id
 */
defined('_JEXEC') or die();

if( $bulletins )
{
	for($i = 0; $i < count( $bulletins ); $i++ )
	{
		$row	=& $bulletins[$i];
?>
	<div id="bulletin_<?php echo $row->id; ?>" class="bulletin-list" style="border-bottom: 1px solid #ECEFF5;">
		<div class="groups-news-title" style="text-transform: capitalize; font-weight: 700;">
			<a href="<?php echo CRoute::_('index.php?option=com_community&view=groups&task=viewbulletin&groupid=' . $groupId . '&bulletinid=' . $row->id);?>">
				<?php echo $row->title; ?>
			</a>
		</div>
		<div style="padding-left: 20px;">
			<small>
				<?php echo JHTML::_('date' , $row->date, JText::_('DATE_FORMAT_LC')); ?>
			</small>
			<small>
				<?php echo JText::sprintf( 'CC BULLETIN CREATED BY' , $row->creator->getDisplayName() , CRoute::_('index.php?option=com_community&view=profile&userid=' . $row->creator->id ) ); ?>
			</small>
		</div>
		    <?php
			// Only display news item for first item
			if( $i == 0 )
			{
			?>
			<div style="margin-top: 5px; margin-left:20px; display:block;">
				<?php echo $row->message;?>
			</div>
			<?php
			}
			?>
		
	</div>
<?php
	}
}
else
{
?>
	<div class="empty"><?php echo JText::_('CC NO BULLETINS'); ?></div>
<?php
}	
?>