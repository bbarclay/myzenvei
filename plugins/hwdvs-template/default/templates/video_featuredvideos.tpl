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
  <h2>{$smarty.const._HWDVIDS_FEATURED_VIDEOS}</h2>
  {if $print_videolist}
    {foreach name=outer item=data from=$list}
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
    <div class="padding">{$smarty.const._HWDVIDS_INFO_NFEATV}</div>
  {/if}
  {$pageNavigation}
</div>

{include file='footer.tpl'}
