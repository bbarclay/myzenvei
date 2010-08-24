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
//    This file generates the featured group page.
//////
//    VARIABLES AVAILBLE IN THIS TEMPLATE FILE:                                        
//    -- $pageNavigation........displays the page navigation details (where appropriate)
//////
*}

{include file='header.tpl'}

<h2 class="contentheading">{$smarty.const._HWDVIDS_TITLE_FEATUREDGROUPS}</h2>
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
    <div class="padding">{$smarty.const._HWDVIDS_INFO_NFEATG}</div>
  {/if}
  {$pageNavigation}
</div>

{include file='footer.tpl'}
