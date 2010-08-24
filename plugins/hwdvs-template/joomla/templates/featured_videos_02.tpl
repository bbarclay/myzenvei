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
//    This file generates the display for the featured video section on the homepage.
//////
//    VARIABLES AVAILBLE IN THIS TEMPLATE FILE:                                        
//    -- $featured_video_player...A video player that plays the top ordered featured video
//    -- $print_multiple_featured.Only set if more than one video is featured                          
//    -- $featured_link...........Link to more featured videos                            
//////
*}

<h2 class="contentheading">{$smarty.const._HWDVIDS_TITLE_FEATUREDVIDS}</h2>

    <div class="standard">
    {foreach name=outer item=data from=$featuredlist}
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
    
    <div style="text-align:right;padding:5px;"><a href="{$featured_link}" title="{$smarty.const._HWDVIDS_INFO_MOREFEATUREDV}">{$smarty.const._HWDVIDS_INFO_MOREFEATUREDV}</a></div>
