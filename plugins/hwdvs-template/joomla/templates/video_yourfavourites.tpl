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
//    This file generates the display for the user favourite videos page.
//////
//    VARIABLES AVAILBLE IN THIS TEMPLATE FILE:                                        
//    -- $print_videolist.......Only set if the current user has any favourite videos
//    -- $list..................Array containing the current user's favourite videos                              
//////
*}

{include file='header.tpl'}

<h2 class="contentheading">{$smarty.const._HWDVIDS_TITLE_YOURFAVS}</h2>
<div class="standard">
  {if $print_videolist}
    {foreach name=outer item=data from=$list}
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
    <div class="padding">{$smarty.const._HWDVIDS_INFO_NFV}</div>
  {/if}
  {$pageNavigation}
</div>

{include file='footer.tpl'}
