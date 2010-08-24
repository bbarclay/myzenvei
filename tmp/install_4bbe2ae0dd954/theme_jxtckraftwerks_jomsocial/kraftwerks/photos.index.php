<?php
/**
 * @package		JomSocial
 * @subpackage 	Template 
 * @copyright (C) 2008 by Slashes & Dots Sdn Bhd - All rights reserved!
 * @license http://www.jomsocial.com Copyrighted Commercial Software
 * 
 * @param	albums	An array of album objects.
 * @param	user	Current browser's CUser object. 
 * @params	isOwner		boolean Determines if the current photos view belongs to the browser
 */
defined('_JEXEC') or die();

if( $featuredList )
{
?>
<div class="ctitle"><?php echo JText::_('CC FEATURED ALBUMS');?></div>
<?php
	foreach($featuredList as $album)
	{
?>
	<div class="featured-items">
		<a href="<?php echo CRoute::_('index.php?option=com_community&view=photos&task=album&albumid=' . $album->id . '&userid=' . $album->creator);?>"><img class="avatar" src="<?php echo $album->getCoverThumbPath();?>" alt="<?php echo $album->name;?>" /></a>
		
		<div class="clr"></div>
		<div style="display: block;font-weight:700;"><?php echo $album->name;?></div>
        <?php
		if( $isCommunityAdmin )
		{
		?>
		<div class="icon-removefeatured">
            <a onclick="joms.featured.remove('<?php echo $album->id;?>','photos');" href="javascript:void(0);"><?php echo JText::_('CC REMOVE FEATURED'); ?></a>
        </div>
		<?php
		}
		?>
	</div>
<?php
	}
?>
	<div class="clr"></div>
<?php
}
?>
<div class="app-box">
<div class="app-box-header">
	<div class="app-box-header">
		<h2 class="app-box-title"></h2>
	</div>
</div>
<div class="app-box-content">

<div>
	<?php echo $albumsHTML; ?>
</div>
<div class="clr"></div>
<div class="pagination-container">
	<?php echo $pagination->getPagesLinks(); ?>
</div>
</div>
<div class="app-box-footer"> <div class="app-box-footer"></div></div>
</div>
