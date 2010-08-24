{* 
//////
//    @version [ Dannevirke ]
//    @package hwdVideoShare
//    @copyright (C) 2007 - 2009 Highwood Design
//    @license http://creativecommons.org/licenses/by-nc-nd/3.0/
//////
*}

{include file='header.tpl'}

<div class="standard">
  <h2>{$smarty.const._HWDVIDS_TITLE_VIDMATCHING} "{$searchterm}"</h2>
  {if $print_matchvids}
    {foreach name=outer item=data from=$matchingvids}
          <div style="width: 24%; float:left;">
	  {include file="video_list_full.tpl"}
	  </div>
	  {if $smarty.foreach.outer.last}
	     <div style="clear:both;"></div>
	  {elseif $smarty.foreach.outer.index % 4-3 == 0}
	     <div style="clear:both;"></div>
	  {/if}
    {/foreach}
  {else}
    <div class="padding">{$mvempty}</div>
  {/if}
  {$vpageNavigation}
</div>

{if $print_glink}
<div class="standard">
  <h2>{$smarty.const._HWDVIDS_TITLE_GROUPMATCHING} "{$searchterm}"</h2>
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
  {$gpageNavigation}
</div>
{/if}

{include file='footer.tpl'}
