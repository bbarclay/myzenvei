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
//    This file generates the header for the hwdVideoShare component and outputs the top navigation system.
//////
//    VARIABLES AVAILBLE IN THIS TEMPLATE FILE:                                        
//    -- $print_ads.......Only set if hwdRevenueManager is installed 
//    -- $advert1.........The code for Advert1 
//    -- $advert2.........The code for Advert2 
//    -- $print_nav.......Only set if any navigation buttons are enabled
//    -- $print_vlink.....Only set if "videos" link is enabled
//    -- $print_clink.....Only set if "categories" link is enabled
//    -- $print_glink.....Only set if "groups" link is enabled
//    -- $print_ulink.....Only set if "upload" link is enabled
//    -- $print_search....Only set if search function is enabled
//    -- $form_search.....The URL to post the search form
//    -- $searchinput.....The search text input code 
//    -- $print_usernav...Only set if any user navigation links are enabled
//    -- $yv..............The link to "your videos"
//    -- $yf..............The link to "your favourites"
//    -- $yg..............The link to "your groups"  
//    -- $ym..............The link to "your group memberships"
//    -- $cg..............The link to "create group" 
//////
*}

{if $show_page_title eq "1"}<div class="componentheading{$pageclass_sfx}">{$page_title}</div>{/if}

<div id="hwdvids">
{if $print_ads}{if $advert1}<div id="hwdadverts-padding">{$advert1}</div>{/if}{/if}
<div style="float:right;">
{if $print_search}
   <form action="{$form_search}" method="post" name="mainnavform">
      <div id="hwdsearchbar" class="hwdsearchbar">
         <div class="hwdsearchbox">{$searchinput}</div>
      </div>
   </form>
{/if}
</div>

<div style="float:left;">
   {if $print_nav}
   <div id="hwdvs_navcontainer">
      <ul id="navlist">
         {if $print_vlink}<li{$von}><h3 class="componentheading">{$vlink}</h3></li>{/if}
	 {if $print_clink}<li{$con}><h3 class="componentheading"> | {$clink}</h3>{/if}
	 {if $print_glink}<li{$gon}><h3 class="componentheading"> | {$glink}</h3>{/if}
	 {if $print_ulink}<li{$uon}><h3 class="componentheading"> | {$ulink}</h3>{/if}
      </ul>
   </div>
   {/if}

   {if $print_usernav}
   <div class="usernav">{$yv}&nbsp;&nbsp;{$yf}&nbsp;&nbsp;{$yg}&nbsp;&nbsp;{$ym}&nbsp;&nbsp;{$cg}</div>
   {/if}
</div>

<div class="hwdvsheader"></div>

{if $print_ads}{if $advert2}<div id="hwdadverts-padding">{$advert2}</div>{/if}{/if}
