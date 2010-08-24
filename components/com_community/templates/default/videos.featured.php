<?php
/**
 * @package		JomSocial
 * @subpackage 	Template 
 * @copyright (C) 2008 by Slashes & Dots Sdn Bhd - All rights reserved!
 * @license http://www.jomsocial.com Copyrighted Commercial Software
 * 
 * 
 */
defined('_JEXEC') or die();
?>

<?php
if ($videos)
{
?>
	<div class="videos">
		<div class="ctitle"><?php echo JText::_('CC FEATURED VIDEOS');?></div>
		<?php
		foreach($videos as $video)
		{
		?>
		<div class="jomTips" style="float: left;" id="<?php echo "video-" . $video->id ?>" title="<?php echo $video->title . '::' . $video->description; ?>">
			<div class="video-thumb">
				<a class="video-thumb-url" href="<?php echo $video->url; ?>" style="width: <?php echo $videoThumbWidth; ?>px; height:<?php echo $videoThumbHeight; ?>px;"><img src="<?php echo $video->thumb; ?>" alt="<?php echo $video->title;?>"/></a>
				<span class="video-durationHMS"><?php echo $video->durationHMS; ?></span>
			</div>
			<div class="clr"></div>
            <?php
			if( $isCommunityAdmin )
			{
			?>
			<div class="icon-removefeatured">
	            <a onclick="joms.featured.remove('<?php echo $video->id;?>','videos');" href="javascript:void(0);">	            	            
	            <?php echo JText::_('CC REMOVE FEATURED'); ?>
	            </a>
	        </div>
	        <?php
	        }
	        ?>
		</div>
		<?php
		}
		?>
		<div class="clr"></div>
	</div>
<?php
}