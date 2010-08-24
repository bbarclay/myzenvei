{* 
//////
//    @version [ Accetto ]
//    @package hwdPhotoShare
//    @copyright (C) 2007 - 2009 Highwood Design
//    @license http://creativecommons.org/licenses/by-nc-nd/3.0/
//////
*}

<div style="width:{$hwdps_params.mod_width};text-align:{$hwdps_params.textalignment};overflow:hidden;line-height:normal;">
  
  {foreach name=outer item=data from=$list}

      <a href="{$mosConfig_live_site}/index.php?option=com_hwdphotoshare&task=search&Itemid={$hwdps_params.mod_hwd_itemid}&pattern={$data->tag}&category_id=0">
        <span style="font-size: {$data->size}%; filter:alpha(opacity={$data->transparency1}); -moz-opacity:{$data->transparency2}; -khtml-opacity: {$data->transparency2}; opacity: {$data->transparency2};\">{$data->tag}</span>
      </a>

  {/foreach}
  
<div class="clear"></div>
</div>