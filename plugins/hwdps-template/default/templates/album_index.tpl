{* 
//////
//    @version [ Accetto ]
//    @package hwdPhotoShare
//    @copyright (C) 2007 - 2009 Highwood Design
//    @license http://creativecommons.org/licenses/by-nc-nd/3.0/
//////
*}

{include file="header.tpl" title=foo}

{if $print_featured}
<h5 class="header">{$smarty.const._HWDPS_TITLE_ALBUMS}</h5>
    <div class="standard">
        {foreach name=outer item=data from=$list}
	    {include file="group_list.tpl"}
        {/foreach}
    <div style="text-align:right;padding:5px;"><a href="{$featured_link}" title="{$smarty.const._HWDPS_INFO_MOREFEATUREDG}">{$smarty.const._HWDPS_INFO_MOREFEATUREDG}</a></div>
    </div>
{/if}

{include file="navigation_selects.tpl"}
<div class="standard">
  <h2>{$smarty.const._HWDPS_TITLE_ALBUMS}</h2>
  {if $print_grouplist}
    {foreach name=outer item=data from=$list}
          <div class="albumBox">
	  {include file="album_list.tpl"}
	  </div>
	  {if $smarty.foreach.outer.last}
	     <div style="clear:both;"></div>
	  {elseif $smarty.foreach.outer.index % $apr-($apr-1) == 0}
	     <div style="clear:both;"></div>
	  {/if}
    {/foreach}
  {else}
    <div class="padding">{$smarty.const._HWDPS_INFO_NOA}</div>
  {/if}
  {$pageNavigation}
</div>

{include file="footer.tpl"}
