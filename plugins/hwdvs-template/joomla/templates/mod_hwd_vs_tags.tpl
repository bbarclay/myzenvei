<div style="width:{$hwdvids_params.mod_width};text-align:{$hwdvids_params.textalignment};overflow:hidden;line-height:normal;">
  
  {foreach name=outer item=data from=$list}

      <a href="{$mosConfig_live_site}/index.php?option=com_hwdvideoshare&task=search&Itemid={$hwdvids_params.mod_hwd_itemid}&pattern={$data->tag}&category_id=0">
        <span style="font-size: {$data->size}%; filter:alpha(opacity={$data->transparency1}); -moz-opacity:{$data->transparency2}; -khtml-opacity: {$data->transparency2}; opacity: {$data->transparency2};\">{$data->tag}</span>
      </a>

  {/foreach}
  
<div class="clear"></div>
</div>