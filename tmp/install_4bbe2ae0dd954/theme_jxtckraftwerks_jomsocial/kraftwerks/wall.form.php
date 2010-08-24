<script type="text/javascript" language="javascript">

function wallRemove( id )
{
	if(confirm('<?php echo JText::_('CC CONFIRM REMOVE WALL'); ?>'))
	{		
		jQuery('#wall_'+id).fadeOut('normal').remove();
		if(typeof getCacheId == 'function') {
			cache_id = getCacheId();
		}else{
			cache_id = "";
		}	
		jax.call('community','<?php echo $ajaxRemoveFunc; ?>', id, cache_id );
	}
}

jQuery(document).ready(function()
{
	joms.utils.textAreaWidth('#wall-message');
	joms.utils.autogrow('#wall-message');
});
</script>

<textarea id="wall-message" name="message" class="inputbox" rows="" cols=""></textarea>

<div style="position: relative;">
	<button id="wall-submit" class="button" onclick="joms.walls.add('<?php echo $uniqueId; ?>', '<?php echo $ajaxAddFunction;?>');return false;" name="save">
		<?php echo JText::_('CC WALL ADD COMMENT');?>
	</button>
	<div style="position:absolute; right:0; top:0; display:none;" id="wall-message-counter"></div>
</div>
<div style="clear:both;"></div>
<?php if(!empty($viewAllLink)): ?>
<div style="text-align:right">
	<a href="<?php echo $viewAllLink; ?>">
		<?php echo JText::_('CC SHOW ALL'); ?>
	</a>
</div>
<?php endif; ?>
