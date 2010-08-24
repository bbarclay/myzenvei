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
//    This file generates the display when a user views a category. It lists all the videos in that category
//    and if any subcategories exist it can also display these
//////
//    VARIABLES AVAILBLE IN THIS TEMPLATE FILE:                                        
//    -- $print_videolist...Only set if any video exist in the category
//    -- $print_subcats.....Only set if any subcategories exist in the category                            
//    -- $link_home.........Your website URL (to your Joomla root)                   
//////
*}

{include file='header.tpl'}

<h2 class="contentheading">{$smarty.const._HWDVIDS_TITLE_CATEGORYVIDS} ({$category_name})</h2>

{if $print_subcats}

{$startpane}
  {$starttab5}
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
	  <div class="padding">{$smarty.const._HWDVIDS_INFO_NCV}</div>
	{/if}
	{$pageNavigation}
      </div>
  {$endtab}
  {$starttab6}
      <div class="standard">
        {foreach name=outer item=data from=$subcatlist}
          {include file='category_list.tpl'}
        {/foreach}
      </div>  
  {$endtab} 
{$endpane}

{else}
  <div class="recent">
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
      <div class="padding">{$smarty.const._HWDVIDS_INFO_NCV}</div>
    {/if}
    {$pageNavigation}
  </div>
{/if}
	
{include file='footer.tpl'}
