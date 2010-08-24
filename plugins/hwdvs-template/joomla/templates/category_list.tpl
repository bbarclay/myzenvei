{* 
//////
//    @version [ Dannevirke ]
//    @package hwdVideoShare
//    @copyright (C) 2007 - 2009 Highwood Design
//    @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
//////
//    hwdVideoShare Template System:::This template system uses the Smarty Template Engine. 
//    For full documentation, including syntax usage please refer to http://www.smarty.net 
//    or our website at http://www.hwdmediashare.co.uk   
//////
//    This file generates the display for each separate category in the main category page. 
//    --$data->level = 0 is a top level category
//    --$data->level = 1 is a second level category
//    --$data->level = 2 is a third level category
//    Subcategories under the third level are not generated for the main category page.
//////
//    VARIABLES AVAILBLE IN THIS TEMPLATE FILE:                                        
//    -- $data->level.......The level of the category. Top level categories have the   
//                          $data->level = 0, subcategories have $data->level = 1 etc 
//    -- $data->title.......The title of the category                                  
//    -- $data->description.The description of the category                            
//    -- $data->num_vids....The number of videos in the category                       
//    -- $data->num_subcats.The number of subcategories the category
//////
*}

{if $data->level eq 0}
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr class="sectiontableentry{$data->k}">
    <td width="{$thumbwidth}" valign="top">{$data->thumbnail}</td>
    <td width="" valign="top">
      <div class="listtitle">{$data->title} ({$data->num_vids} {$smarty.const._HWDVIDS_INFO_VIDEOS}, {$data->num_subcats} {$smarty.const._HWDVIDS_INFO_SUBCATS})</div>
      <div class="listdesc">{$data->description}</div>
    </td>
  </tr>
</table>
{elseif $data->level eq 1}
{if $hideSubcats eq 0}
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr class="sectiontableentry{$data->k}">
    <td width="{$thumbwidth}" valign="top" style="vertical-align:top;text-align:right;"> <img src="{$mosConfig_live_site}/components/com_hwdvideoshare/images/sub_dir_arrow.png" style="vertical-align:top;text-align:right;"></td>
    <td width="" valign="top">
      <div class="listtitle">{$data->title} ({$data->num_vids} {$smarty.const._HWDVIDS_INFO_VIDEOS}, {$data->num_subcats} {$smarty.const._HWDVIDS_INFO_SUBCATS})</div>
    </td>
  </tr>
</table>
{/if}
{elseif $data->level eq 2}
{if $hideSubcats eq 0}
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr class="sectiontableentry{$data->k}">
    <td width="{$thumbwidth}" valign="top" style="vertical-align:top;text-align:right;"> <img src="{$mosConfig_live_site}/components/com_hwdvideoshare/images/sub_sub_dir_arrow.png" style="vertical-align:top;text-align:right;"></td>
    <td width="" valign="top">
      <div class="listtitle">{$data->title} ({$data->num_vids} {$smarty.const._HWDVIDS_INFO_VIDEOS}, {$data->num_subcats} {$smarty.const._HWDVIDS_INFO_SUBCATS})</div>
    </td>
  </tr>
</table>
{/if}
{/if}