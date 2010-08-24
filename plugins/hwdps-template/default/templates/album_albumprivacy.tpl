{* 
//////
//    @version [ Accetto ]
//    @package hwdPhotoShare
//    @copyright (C) 2007 - 2009 Highwood Design
//    @license http://creativecommons.org/licenses/by-nc-nd/3.0/
//////
*}

{include file="header.tpl" title=foo}

{include file="navigation_selects.tpl"}
<div class="standard">
  <h2>{$smarty.const._HWDPS_ALBUMPRIVACY}</h2>
  <div style="text-align:right;padding:5px;"><a href="{$link_createalbum}" title="{$smarty.const._HWDPS_CNA}">{$smarty.const._HWDPS_CNA}</a> | <a href="{$link_viewalbums}" title="{$smarty.const._HWDPS_VA}">{$smarty.const._HWDPS_VA}</a></div>
  {if $print_videolist}
    {foreach name=outer item=data from=$list}
	  {include file="album_list_privacy.tpl"}
    {/foreach}
  {else}
    <div class="padding">{$smarty.const._HWDPS_INFO_NUA}</div>
  {/if}
  {$pageNavigation}
</div>

{include file="footer.tpl"}
