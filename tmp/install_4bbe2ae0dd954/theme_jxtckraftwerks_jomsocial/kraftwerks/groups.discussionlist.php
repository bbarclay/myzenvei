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
?>

<style type="text/css">

#community-wrap .group-discussion {
	overflow: hidden;
	padding: 5px;
}
#community-wrap .group-discussion + .group-discussion {
	border-top: 1px solid #CCC;
}
#community-wrap .group-discussion-title {
	width: 70%; float: left; font-size: 14px; font-weight: bold;
	margin: 0 !important;
}
#community-wrap .group-discussion-replies {
	float: right;
	margin: 0 !important;
}
#community-wrap .group-discussion-author {
	padding: 0pt 0pt 0pt 20px; color: gray;
}
</style>


<?php

if( $discussions )
{
	for($i = 0; $i < count( $discussions ); $i++ )
	{
		$row	=& $discussions[$i];
?>



	<div id="discuss_<?php echo $row->id; ?>" class="group-discussion">
        <div class="group-discussion-title icon-bubble">
            <a href="<?php echo CRoute::_('index.php?option=com_community&view=groups&task=viewdiscussion&groupid=' . $groupId. '&topicid=' . $row->id ); ?>">
                <?php echo $row->title; ?>
            </a>
        </div>
        <div class="group-discussion-replies icon-replies">
            <a href="<?php echo CRoute::_('index.php?option=com_community&view=groups&task=viewdiscussion&groupid=' . $groupId . '&topicid=' . $row->id ); ?>">
                <?php echo JText::sprintf( (cIsPlural($row->count)) ? 'CC TOTAL REPLIES MANY' : 'CC TOTAL REPLIES', $row->count); ?>
            </a>
        </div>
        <div class="clr"></div>
        <div class="group-discussion-author small">
            <span class="groups-news-author"><?php echo JText::sprintf('CC DISCUSS STARTED BY' , $row->user->getDisplayName() ); ?></span>
            <?php if( isset( $row->lastreplier ) && !empty( $row->lastreplier ) ) { ?>
            <span class="groups-news-author">
                <?php echo JText::sprintf('CC DISCUSSION LAST REPLIED', $row->lastreplier->post_by->getDisplayName(), JHTML::_('date', $row->lastreplier->date, JText::_('DATE_FORMAT_LC')) ); ?>
            </span>
            <?php } ?>
        </div>
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