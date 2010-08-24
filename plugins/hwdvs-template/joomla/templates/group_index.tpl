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
//    This file generates the main group page which lists featured groups and recent groups.
//////
//    VARIABLES AVAILBLE IN THIS TEMPLATE FILE:                                        
//    -- $print_featured....Only set if there are any featured groups
//    -- $featuredlist......Array containing data for each featured group 
//    -- $list..............Array containing data for each group 
//    -- $pageNavigation....The page navigation system
//////
*}

{include file='header.tpl'}

{if $print_featured}
<h2 class="contentheading">{$smarty.const._HWDVIDS_TITLE_FEATUREDGROUPS}</h2>
  <div class="standard">

          {foreach name=outer item=data from=$featuredlist}
          <div class="groupBox">
	  {include file="group_list.tpl"}
	  </div>
	  {if $smarty.foreach.outer.last}
	     <div style="clear:both;"></div>
	  {elseif $smarty.foreach.outer.index % $gpr-($gpr-1) == 0}
	     <div style="clear:both;"></div>
	  {/if}
          {/foreach}
          
     <div style="text-align:right;padding:5px;"><a href="{$featured_link}" title="{$smarty.const._HWDVIDS_INFO_MOREFEATUREDG}">{$smarty.const._HWDVIDS_INFO_MOREFEATUREDG}</a></div>
  </div>
{/if}

<h2 class="contentheading">{$smarty.const._HWDVIDS_TITLE_GROUPS}</h2>
<div class="standard">
  {if $print_grouplist}

          {foreach name=outer item=data from=$list}
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
    <div class="padding">{$smarty.const._HWDVIDS_INFO_NOG}</div>
  {/if}
  {$pageNavigation}
</div>

{include file='footer.tpl'}
