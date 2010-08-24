{* 
//////
//    @version [ Accetto ]
//    @package hwdPhotoShare
//    @copyright (C) 2007 - 2009 Highwood Design
//    @license http://creativecommons.org/licenses/by-nc-nd/3.0/
//////
*}

{include file="header.tpl"}

<div class="standard">
  <h2>{$smarty.const._HWDPS_TITLE_PHOTOMATCHING} "{$searchterm}"</h2>
  {if $print_matchphotos}
    {foreach name=outer item=data from=$matchingphotos}
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
    <div class="padding">{$mpempty}</div>
  {/if}
  {$pageNavigation}
</div>

<div class="standard">
  <h2>{$smarty.const._HWDPS_TITLE_ALBUMMATCHING} "{$searchterm}"</h2>
  {if $print_matchalbums}
    {foreach name=outer item=data from=$matchingalbums}
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
    <div class="padding">{$maempty}</div>
  {/if}
  {$pageNavigation}
</div>

<div class="standard">
  <h2>{$smarty.const._HWDPS_TITLE_GROUPMATCHING} "{$searchterm}"</h2>
  {if $print_matchgrps}
    {foreach name=outer item=data from=$matchinggroups}
          <div style="width: 49%; float:left;">
	  {include file="group_list.tpl"}
	  </div>
	  {if $smarty.foreach.outer.last}
	     <div style="clear:both;"></div>
	  {elseif $smarty.foreach.outer.index % 2-1 == 0}
	     <div style="clear:both;"></div>
	  {/if}
    {/foreach}
  {else}
    <div class="padding">{$mgempty}</div>
  {/if}
  {$pageNavigation}
</div>	
		
{include file="footer.tpl"}
