<?php
/**
 * @package		JomSocial
 * @subpackage 	Template 
 * @copyright (C) 2008 by Slashes & Dots Sdn Bhd - All rights reserved!
 * @license http://www.azrul.com Copyrighted Commercial Software
 * 
 */
defined('_JEXEC') or die();
// echo '<pre>';
// var_dump( $activities );
// echo '</pre>';
// exit;

?>

<?php foreach($activities as $act): ?>
<?php if($act->type =='title'): ?>
<div class="ctitle" style="font-weight: bold;"><?php echo $act->title; ?></div>
<?php else: $actor =& CFactory::getUser($act->actor);?>
<div id="<?php echo $idprefix; ?>profile-newsfeed-item<?php echo $act->id; ?>" style="padding: 0 0 4px; margin: 0; border-bottom: 1px dotted #eee; position: relative; overflow: hidden; display: block;">
	<table style="width: 98%; overflow: hidden;"><tr>
		<?php
		if($config->get('showactivityavatar'))
		{
		?>
		<td style="width:20px;text-align: left; vertical-align: top;">
			<a href="<?php echo cUserLink($actor->id); ?>"><img class="avatar" src="<?php echo $actor->getThumbAvatar(); ?>" width="36" border="0" /></a>
		</td>
		<?php
		}
		?>
		<td style="width: 20px;text-align: left; vertical-align: top;">
			<img src="<?php echo $act->favicon; ?>" class="icon" />
		</td>
		
		<td style="width:70%; text-align: left; vertical-align: top;">
			<?php echo $act->title; ?>
		</td>
		
		<td style="text-align: right;">
			<?php echo $act->created; ?>
		</td>

		<?php if($isMine): ?>
		<td width="20">
			<a class="remove" onclick="jax.call('community', 'activities,ajaxHideActivity' , '<?php echo $my->id; ?>' , '<?php echo $act->id; ?>');" href="javascript:void(0);">
				<?php echo JText::_('Hide');?>
			</a>
		</td>
		<?php endif; ?>
	
	</tr></table>
</div>
<?php endif; ?>
<?php endforeach; ?>
