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
//    This file generates the display for the hwdVideoShare component homepage.
//////
//    VARIABLES AVAILBLE IN THIS TEMPLATE FILE:                                        
//    -- $print_nowlist........Only set if any videos are being watched now
//    -- $print_featured.......Only set if any videos are featured
//    -- $print_ads............Only set if hwdRevenueManager is installed   
//    -- $print_videolist......Only set if there are any videos
//    -- $list.................Array containing main video list data  
//    -- $pageNavigation.......Page navigation code 
//    -- $print_mostviewed.....Only set if there are any "most viewed" videos
//    -- $mostviewedlist.......Array containing main "most viewed" list data  
//    -- $print_mostfavoured...Only set if there are any "most favoured" videos
//    -- $mostfavouredlist.....Array containing main "most favoured" list data  
//    -- $print_mostpopular....Only set if there are any "most popular" videos
//    -- $mostpopularlist......Array containing main "most popular" list data  
//////
*}

{include file='header.tpl'}

{if $print_nowlist}
  {include file='video_beingwatched.tpl'}
{/if}
        
{if $print_featured}
        {if $print_featured_player}
          {include file="featured_videos_01.tpl"}
        {else}
          {include file="featured_videos_02.tpl"}
        {/if}
{/if}

{if $print_ads}{if $advert3}<div id="hwdadverts-padding">{$advert3}</div>{/if}{/if}

{$startpane}
  {$starttab1}
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
        <div class="padding"></div>
      {/if}
      <div style="clear:both;"></div>
      {$pageNavigation}
    </div>
  {$endtab}
  {if $print_mostviewed}
  {$starttab2}
    <div class="standard">

    {foreach name=outer item=data from=$mostviewedlist}
          <div class="videoBox">
	  {include file="video_list.tpl"}
	  </div>
	  {if $smarty.foreach.outer.last}
	     <div style="clear:both;"></div>
	  {elseif $smarty.foreach.outer.index % $vpr-($vpr-1) == 0}
	     <div style="clear:both;"></div>
	  {/if}
    {/foreach}

    </div>
  {$endtab}
  {/if}
  {if $print_mostfavoured}
  {$starttab4}
    <div class="standard">

    {foreach name=outer item=data from=$mostfavouredlist}
          <div class="videoBox">
	  {include file="video_list.tpl"}
	  </div>
	  {if $smarty.foreach.outer.last}
	     <div style="clear:both;"></div>
	  {elseif $smarty.foreach.outer.index % $vpr-($vpr-1) == 0}
	     <div style="clear:both;"></div>
	  {/if}
    {/foreach}
      
    </div>
  {$endtab}
  {/if}  
  {if $print_mostpopular}
  {$starttab3}
    <div class="standard">

    {foreach name=outer item=data from=$mostpopularlist}
          <div class="videoBox">
	  {include file="video_list.tpl"}
	  </div>
	  {if $smarty.foreach.outer.last}
	     <div style="clear:both;"></div>
	  {elseif $smarty.foreach.outer.index % $vpr-($vpr-1) == 0}
	     <div style="clear:both;"></div>
	  {/if}
    {/foreach}

    </div>
  {$endtab}
  {/if}
{$endpane}

{include file='footer.tpl'}
