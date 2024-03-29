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
//    This file generates the display for the search results page.
//////
//    VARIABLES AVAILBLE IN THIS TEMPLATE FILE:                                        
//    -- $searchterm.........The search pattern which has been requested
//    -- $print_matchvids....Only set if there are any matching videos
//    -- $matchingvids.......Array containing all matching videos
//    -- $print_matchgrps....Only set if there are any matching groups
//    -- $matchinggroups.....Array containing all matching groups
//////
*}

{include file='header.tpl'}

<h2 class="contentheading">{$smarty.const._HWDVIDS_TITLE_VIDMATCHING} "{$searchterm}"</h2>
<div class="standard">
  {if $print_matchvids}
    {foreach name=outer item=data from=$matchingvids}
          <div class="videoBox">
	  {include file="video_list.tpl"}
	  </div>
	  {if $smarty.foreach.outer.last}
	     <div style="clear:both;"></div>
	  {elseif $smarty.foreach.outer.index % $vpr-($vpr-1) == 0}
	     <div style="clear:both;"></div>
	  {/if}
    {/foreach}
  {else}
    <div class="padding">{$mvempty}</div>
  {/if}
  {$vpageNavigation}
</div>
<h2 class="contentheading">{$smarty.const._HWDVIDS_TITLE_GROUPMATCHING} "{$searchterm}"</h2>
<div class="standard">
  {if $print_matchgrps}

          {foreach name=outer item=data from=$matchinggroups}
          <div class="groupBox">
	  {include file="group_list.tpl"}
	  </div>
	  {if $smarty.foreach.outer.last}
	     <div style="clear:both;"></div>
	  {elseif $smarty.foreach.outer.index % $gpr-($gpr-1) == 0}
	     <div style="clear:both;"></div>
	  {/if}
          {/foreach}

  {else}
    <div class="padding">{$mgempty}</div>
  {/if}
  {$gpageNavigation}
</div>

{include file='footer.tpl'}
