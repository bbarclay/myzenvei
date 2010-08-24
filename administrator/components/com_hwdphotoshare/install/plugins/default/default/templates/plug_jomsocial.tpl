{* 
//////
//    @version [ Accetto ]
//    @package hwdPhotoShare
//    @copyright (C) 2007 - 2009 Highwood Design
//    @license http://creativecommons.org/licenses/by-nc-nd/3.0/
//////
*}

<div id="hwdps">

  <div class="standard">
    <div class="padding">
      {if $showall_print}
        <a href='{$showall_link}'>{$showall_text}</a> |
      {/if}
      {if $btp_print}
        <a href='{$btp_link}'>{$btp_text}</a> |
      {/if}
      {if $navlinks_print}
        <a href='{$myphotos_link}'>{$smarty.const._HWDPS_NAV_YOURPHOTOS}</a> | <a href='{$uploadphotos_link}'>{$smarty.const._HWDPS_NAV_UPLOAD}</a>
      {/if}
    </div>
  </div>

  {if $print_photodata}

    <div class="standard">
        <div class="padding">
	
          <div id="{$iCID}">
             <ul id="{$iCID}_content">  
               {foreach name=outer item=data from=$listphoto}
                 <li class="{$iCID}_item"><a href="{$JURL}/index.php?option=com_hwdphotoshare&task=viewphoto&Itemid={$Itemid}&album_id={$data->album_id}&limitstart={$data->ordering}"><div style="height: {$isize}px; width: {$isize}px; display:table-cell; vertical-align: middle;"><img src="{$data->photo_url}" alt="slide {$data->i}" style="max-width: {$isize}px; max-height: {$isize}px; margin: auto;" /></div></a></li> 
               {/foreach}
             </ul>  
             <div id="{$iCID}_frame">  
                 <ul>  
                   {foreach name=outer item=data from=$listphoto}
                     <li><a href="#"><img id="thumb{$data->i}" src="{$data->thumbnail_url}" alt="thumbnail {$data->i}" width="{$resize_thumb}" /></a></li>  
                   {/foreach}
                 </ul>  
             </div>  
         </div>
        	  
	</div>
    </div>
    
  {else}
      {if $display eq "own"}
          <div class="standard"><div class="padding">{$smarty.const._HWDVIDS_CN_NOUV}</div></div>
      {else}
          <div class="standard"><div class="padding">{$smarty.const._HWDVIDS_CN_NOFV}</div></div>
      {/if}
  {/if}

</div>
<div style='clear:both;'></div>