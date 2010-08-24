{* 
//////
//    @version [ Accetto ]
//    @package hwdPhotoShare
//    @copyright (C) 2007 - 2009 Highwood Design
//    @license http://creativecommons.org/licenses/by-nc-nd/3.0/
//////
*}

{if $data->level eq 0}
<div class="box">
  <div style="width:{$thumbwidth};float:left;">{$data->thumbnail}</div>
  <div class="listtitle">{$data->title} ({$data->num_albums} {$smarty.const._HWDPS_INFO_ALBUMS}, {$data->num_subcats} {$smarty.const._HWDPS_INFO_SUBCATS})</div>
  <div class="listdesc">{$data->description}</div>
<div style="clear:both;"></div>
</div>
{elseif $data->level eq 1}
<div class="box">
  <div style="width:{$thumbwidth};float:left;"><img src="{$mosConfig_live_site}/components/com_hwdphotoshare/images/sub_dir_arrow.png" style="vertical-align:top;text-align:right;"></div>
  <div class="listtitle">{$data->title} ({$data->num_albums} {$smarty.const._HWDPS_INFO_ALBUMS}, {$data->num_subcats} {$smarty.const._HWDPS_INFO_SUBCATS})</div>
  <div class="listdesc">{$data->description}</div>
<div style="clear:both;"></div>
</div>
{elseif $data->level eq 2}
<div class="box">
  <div style="width:{$thumbwidth};float:left;"><img src="{$mosConfig_live_site}/components/com_hwdphotoshare/images/sub_sub_dir_arrow.png" style="vertical-align:top;text-align:right;"></div>
  <div class="listtitle">{$data->title} ({$data->num_albums} {$smarty.const._HWDPS_INFO_ALBUMS}, {$data->num_subcats} {$smarty.const._HWDPS_INFO_SUBCATS})</div>
  <div class="listdesc">{$data->description}</div>
<div style="clear:both;"></div>
</div>
{/if}
