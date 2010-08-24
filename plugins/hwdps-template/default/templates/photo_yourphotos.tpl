{* 
//////
//    @version [ Accetto ]
//    @package hwdPhotoShare
//    @copyright (C) 2007 - 2009 Highwood Design
//    @license http://creativecommons.org/licenses/by-nc-nd/3.0/
//////
*}

{include file="header.tpl" title=foo}

<div style="text-align:right;padding:5px;"><a href="{$link_createalbum}" title="Create New Album">Create New Album</a> | <a href="{$link_albumprivacy}" title="Album Privacy">Album Privacy</a></div>
  
<div class="standard">
  <h2>{$smarty.const._HWDPS_TITLE_YOURALBUMS}</h2>
  {if $print_albumlist}
    {foreach name=outer item=data from=$list_a}
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
    <div class="padding">{$smarty.const._HWDPS_INFO_NUA}</div>
  {/if}
</div>

<div class="standard">
  <h2>{$smarty.const._HWDPS_TITLE_YOURPHOTOS}</h2>
  {if $print_photolist}
  <div class="padding">
  <div class="pageData">
    {if $print_photolist}
      {$pageData}
    {else}
      {$smarty.const._HWDPS_INFO_0PHOTOS}
    {/if}
  </div>
  <div class="pageNavigation">{$pageNavigation}</div>
  <div style="clear:both"></div>  
  </div>
    {foreach name=outer item=data from=$list_p}
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
  <div class="padding">
  <div class="pageNavigation">{$pageNavigation}</div>
  <div style="clear:both"></div>  
  </div>    
  {else}
    <div class="padding">{$smarty.const._HWDPS_INFO_NUSERP}</div>
  {/if}
</div>

{include file="footer.tpl"}
