<?php
/**
 * @package	JomSocial
 * @copyright (C) 2008 by Slashes & Dots Sdn Bhd - All rights reserved!
 * @license http://www.jomsocial.com Copyrighted Commercial Software
 */
defined('_JEXEC') or die('Restricted access');

if( !$isCommunityAdmin || !$isDefaultPhoto )
{
?>
<div id="community-admin-wrapper">
	<ul id="community-admin-controls">
		<?php
		if( !$isCommunityAdmin )
		{
		?>
		<li class="icon-block-user">
			<?php
				if( !$blocked )
				{
			?>
					<a href="javascript:void(0);" onclick="joms.users.blockUser('<?php echo $userid; ?>', '0' );"><span><?php echo JText::_('CC BLOCK USER');?></span></a>
			<?php
				}
				else
				{
			?>
				<a href="javascript:void(0);" onclick="joms.users.blockUser('<?php echo $userid; ?>' , '1');"><span><?php echo JText::_('CC UNBLOCK USER');?></span></a>
			<?php
				}
			?>
		</li>
		<?php
		}
		?>
		<?php
		if( !$isDefaultPhoto )
		{
		?>
		<li class="icon-remove-avatar">
			<a href="javascript:void(0);" onclick="joms.users.removePicture('<?php echo $userid;?>');"><span><?php echo JText::_('CC REMOVE PROFILE PICTURE');?></span></a>
		</li>
		<?php
		}
		?>
	</ul>
</div>
<?php
}
?>