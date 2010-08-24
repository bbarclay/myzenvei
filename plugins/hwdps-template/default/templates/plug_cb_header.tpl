{* 
//////
//    @version [ Accetto ]
//    @package hwdPhotoShare
//    @copyright (C) 2007 - 2009 Highwood Design
//    @license http://creativecommons.org/licenses/by-nc-nd/3.0/
//////
*}

<div id="hwdps">
<center>
   {if $print_ads}<div id="hwdadverts">{$advert1}</div>{/if}
   {if $print_search}
   <form action="{$form_search}" method="post" name="mainnavform">
      <div id="hwdps_searchbar" class="hwdsearchbar">
         <div class="hwdsearchbox">{$searchinput}</div>
      </div>
   </form>
   {/if}
   {if $print_nav}
   <div id="hwdps_navcontainer">
      <ul id="navlist">
         {if $print_elink}<li{$eon}>{$elink}</li>{/if}
         {if $print_clink}<li{$con}>{$clink}</li>{/if}
         {if $print_glink}<li{$gon}>{$glink}</li>{/if}
         {if $print_ulink}<li{$uon}>{$ulink}</li>{/if}
      </ul>
   </div>
   {/if}
   <div style="clear:both;"></div>

   {if $print_usernav}
   <div class="usernav">{$yp}&nbsp;&nbsp;{$yf}&nbsp;&nbsp;{$yg}&nbsp;&nbsp;{$ym}&nbsp;&nbsp;{$cg}</div>
   {/if}
   
   {if $print_ads}<div id="hwdadverts">{$advert2}</div>{/if}
</center>