{* 
//////
//    @version [ Accetto ]
//    @package hwdPhotoShare
//    @copyright (C) 2007 - 2009 Highwood Design
//    @license http://creativecommons.org/licenses/by-nc-nd/3.0/
//////
*}

{include file="header.tpl"}

{if $print_featured}
<h5 class="header">{$smarty.const._HWDPS_TITLE_PHOTOS}</h5>
    <div class="standard">
        {foreach name=outer item=data from=$list}
	    {include file="group_list.tpl"}
        {/foreach}
    <div style="text-align:right;padding:5px;"><a href="{$featured_link}" title="{$smarty.const._HWDPS_INFO_MOREFEATUREDG}">{$smarty.const._HWDPS_INFO_MOREFEATUREDG}</a></div>
    </div>
{/if}

{include file="navigation_selects.tpl"}
<div class="standard">
  <h2>{$smarty.const._HWDPS_TITLE_PHOTOS}</h2>
  <div class="padding">
  <div class="pageData">
    {if $print_photothumbs}
      {$pageData}
    {else}
      {$smarty.const._HWDPS_INFO_0PHOTOS}
    {/if}
  </div>
  <div class="pageNavigation">{$pageNavigation}</div>
  <div style="clear:both"></div>  
  </div>
  
  {if $print_photothumbs}
    {foreach name=outer item=data from=$photolist}
	  {if $smarty.foreach.outer.index % $ppr-0 == 0}
	    <div class="photoRow">
	  {/if}
	  
	  <div class="photoBox"><div class="photoContainer-h"><div class="photoContainer-v">{$data->thumbnail}</div></div></div>
	  
	  {if $smarty.foreach.outer.last}
	    <div style="clear:both;"></div></div>
	  {elseif $smarty.foreach.outer.index % $ppr-($ppr-1) == 0}
	    <div style="clear:both;"></div></div>
	  {/if}
    {/foreach}
  {else}
    <div class="padding">{$smarty.const._HWDPS_INFO_NPIA}</div>
  {/if}

  <div class="padding">
  <div class="pageNavigation">{$pageNavigation}</div>
  <div style="clear:both"></div>  
  </div>

</div>

{include file="footer.tpl"}
