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
<?php foreach($activities as $act): ?>
<?php if($act->type =='title'): ?>
<div class="ctitle"><?php echo $act->title; ?></div>
<?php else: $actor = CFactory::getUser($act->actor);?>
<div id="<?php echo $idprefix; ?>profile-newsfeed-item<?php echo $act->id; ?>" class="feed-item">
	<table style="width: 98%; overflow: hidden;">
		<tr>
			<?php
			if($config->get('showactivityavatar'))
			{
			?>
			<td style="width:20px;text-align: left; vertical-align: top;">
				<?php	
				if(!empty($actor->id))
				{
				?>
					<a href="<?php echo cUserLink($actor->id); ?>"><img class="avatar" src="<?php echo $actor->getThumbAvatar(); ?>" width="36" border="0" alt=""/></a>
				<?php
				}
				else
				{
				?>
					<img class="avatar" src="<?php echo $actor->getThumbAvatar(); ?>" width="36" border="0" alt=""/>
				<?php
				}
				?>
			</td>
			<?php
			}
			?>
			<td style="width:20px;text-align: left; vertical-align: top;">
				<img src="<?php echo $act->favicon; ?>" class="icon" alt=""/>
			</td>

			<td style="width:70%; text-align: left; vertical-align: top;">
				<?php echo $act->title; ?>
				<?php
				if(!empty($act->content) && $showMore )
				{
				?>
				<div id="<?php echo $idprefix; ?>profile-newsfeed-item-content-<?php echo $act->id;?>" class="small profile-newsfeed-item-action"><a href="javascript:void(0);" id="newsfeed-content-<?php echo $act->id;?>" onclick="joms.activities.getContent('<?php echo $act->id;?>');"><?php echo JText::_('CC MORE');?></a></div>
				<?php
				}
				?>
			</td>

			<td style="text-align: right; vertical-align: top;">
				<?php echo $act->created; ?>
			</td>

			<?php if($isMine): ?>
			<td width="20">
				<a class="remove" onclick="jax.call('community', 'activities,ajaxHideActivity' , '<?php echo $my->id; ?>' , '<?php echo $act->id; ?>');" href="javascript:void(0);">
					<span><?php echo JText::_('Hide');?></span>
				</a>
			</td>
			<?php endif; ?>
		</tr>
	</table>
</div>
<?php endif; ?>
<?php endforeach; ?>
