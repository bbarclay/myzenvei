<div class="albums">
<?php
if( $albums )
{   
		$i	= 0;
        foreach($albums as $album)
		{
			// TODO: Push these 2 vars to views/controllers
			$album->thumbnail = ($album->thumbnail) ? $album->thumbnail : JURI::root() . 'components/com_community/assets/album_thumb.jpg';
?>
    
	<div class="album jomTips" title="<?php echo $album->name;?>::<?php echo $album->description;?>">
    	<div class="album-cover">
        	<a class="album-cover-link" href="<?php echo $album->link; ?>"><img src="<?php echo $album->thumbnail; ?>" alt="<?php echo $album->name;?>"/></a>
        </div>

        <div class="album-summary">
        	<div class="album-name"><a href="<?php echo $album->link; ?>"><?php echo $album->name; ?></a></div>
            <div class="album-count small"><?php echo JText::sprintf('CC PHOTOS COUNT', $album->count ); ?></div>
			<div class="album-lastupdated small"><?php echo JText::sprintf('CC ALBUM LAST UPDATED', $album->lastupdated);?></div> 
			<div class="album-creator"><?php echo JText::_('CC PHOTO ALBUM BY'); ?> <a href="<?php echo CRoute::_('index.php?option=com_community&view=profile&userid='.$album->creator); ?>"><?php echo $album->user->getDisplayName(); ?></a></div>
        </div>

        <div class="album-actions small">
            <?php if($album->isOwner) { ?>
                <a class="album-action edit" href="<?php echo $albums[$i]->editLink; ?>"><?php echo JText::_('CC ALBUM ACTION EDIT');?></a> | 
                <a class="album-action upload"href="<?php echo $albums[$i]->uploadLink; ?>"><?php echo JText::_('CC ALBUM ACTION UPLOAD');?></a> |
                <a class="album-action delete" href="javascript:void(0);" onclick="cWindowShow('jax.call(\'community\',\'photos,ajaxRemoveAlbum\',\'<?php echo $albums[$i]->id;?>\',\'<?php echo $currentTask; ?>\');' , '<?php echo JText::_('CC REMOVE');?>' , 450 , 150 );"><?php echo JText::_('CC ALBUM ACTION DELETE');?></a>
            <?php } elseif($isSuperAdmin) { ?>
                    <a class="album-action delete" href="javascript:void(0);" onclick="cWindowShow('jax.call(\'community\',\'photos,ajaxRemoveAlbum\',\'<?php echo $album->id;?>\',\'<?php echo $currentTask; ?>\');' , '<?php echo JText::_('CC REMOVE');?>' , 450 , 150 );"><?php echo JText::_('CC ALBUM ACTION DELETE');?></a>
            <?php } // end: foreach($albums as $album) ?>
				<?php
				if( $isCommunityAdmin && $showFeatured && $type == PHOTOS_USER_TYPE )
				{
					if( !in_array($album->id, $featuredList) )
					{
				?>
		            | <a class="album-action" onclick="joms.featured.add('<?php echo $album->id;?>','photos');" href="javascript:void(0);">	            	            
		            <?php echo JText::_('CC MAKE FEATURED'); ?>
		            </a>
				<?php			
					}
				}
				?>
        </div>
	</div> 
    
	<?php
			$i++;
		}
}
else
{
?>
	<div>
		<span><?php echo JText::_('CC NO ALBUM'); ?></span>
		<?php
		if( $isOwner )
		{
		?>
		<span>
			<a href="<?php echo $createLink;?>">
			<?php echo JText::_('CC CREATE ALBUM NOW');?>
			</a>
		</span>
		<?php
		}
		?>
	</div>
<?php
}
?>
	<div class="clr"></div>
</div>