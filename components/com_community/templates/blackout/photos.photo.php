<div id="jsGallery" class="gallery">
	<script type="text/javascript">
		var jsPhotos = {
			album: <?php echo $album->id;?>,
			entry:	[
					<?php
					if($photos)
					{
						for($i = 0; $i < count($photos); $i++ )
						{
							$photo	=& $photos[$i];
							$imgpath = str_replace('/', DS, $photo->original);
							if(file_exists(JPATH_BASE . DS . $imgpath)) {
					?>
						{photoid: <?php echo $photo->id;?>,
						 caption: '<?php echo addslashes( $photo->caption );?>',
						 thumbnail: '<?php echo JURI::base() . $photo->thumbnail;?>',
						 fullsize: '<?php echo JURI::base() . 'index.php?option=com_community&view=photos&task=showimage&tmpl=component&imgid='.$photo->id; ?>'
						}<?php  ?>
					<?php
							$end	= end( $photos );
							if ($end->id!=$photo->id)
								echo ',';
							}
						}
					}
					?>
					],
			current: 0
			};
			
			defaultPhotoDialog	= '<?php echo JText::_('CC SET PHOTO AS DEFAULT DIALOG');?>';
			removePhotoDialog	= '<?php echo JText::_('CC REMOVE PHOTO DIALOG');?>';
			
	</script>

	<div class="viewport">
		<?php if ($default) { ?>

		<div class="photoCaption" style="float: left; width: 60%;">
			<h3><?php echo $default->caption;?></h3>
			<?php
			if( $isOwner )
			{
			?>
			<a class="photoCaptionBtn_Edit" onclick="editPhotoCaption()" href="javascript:void(0)">[<?php echo JText::_('Edit');?>]</a>
			<?php
			}
			?>
			
		</div>
		<div id="photoReport" style="float: right;height: 30px; line-height: 30px;margin: 0 10px;"></div>
		<div class="clr"></div>
		<?php if ($isOwner) { ?>
		<div class="photoCaption_EditMode">
			<input type="text" value=""   size="48" enabled="enabled"/>
			<a class="photoCaptionBtn_Save" onclick="savePhotoCaption()" href="javascript:void(0);">[<?php echo JText::_('Save');?>]</a>
			<a class="photoCaptionBtn_Cancel" onclick="cancelPhotoCaption()" href="javascript:void(0)">[<?php echo JText::_('Cancel');?>]</a>
		</div>
		<?php } ?>
	  
        <div class="photoDisplay">
			<div class="container">
				<img class="photoImg" src="" alt="" />
            </div>
            <div class="photoLoad"></div>
		<?php
		}
		?>
			<div class="overlay">
				<div class="photoBtn next"><img src="" height="50"/></div>
				<div class="photoBtn prev"><img src="" height="50"/></div>
			</div>
		</div>
	</div>
	<div class="clr"></div>	
</div>

<?php
if($photos || $default)
{
?>
<script type="text/javascript" language="javascript">
if( typeof wallRemove !=='function' )
{
	function wallRemove( id )
	{
		if(confirm('<?php echo JText::_('CC CONFIRM REMOVE WALL'); ?>'))
		{
			jQuery('#wall_'+id).fadeOut('normal').remove();
			jax.call('community','photos,ajaxRemoveWall', id );
		}
	}
}

</script>
<!-- Load walls for this photo -->
<div class="ctitle" id="community-photo-walls-title"><?php echo JText::_('CC WALL');?></div>
<div id="community-photo-walls"></div>
<div id="wallContent"></div>

<script type="text/javascript" language="javascript">
jQuery(document).ready(function(){ initGallery(); });
</script>

<?php
}
?>