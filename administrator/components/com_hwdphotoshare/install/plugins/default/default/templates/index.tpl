{* 
//////
//    @version [ Accetto ]
//    @package hwdPhotoShare
//    @copyright (C) 2007 - 2009 Highwood Design
//    @license http://creativecommons.org/licenses/by-nc-nd/3.0/
//////
*}

{include file='header.tpl'}

<div class="sic-container">
  
  <div class="sic-center">
  
    <div class="standard">
      <h2>{$smarty.const._HWDPS_EXPLORE}</h2>
        <div class="padding">
	{if $print_featured_photos}
	
  <div id="{$featured_iCID}">
     <ul id="{$featured_iCID}_content">  
       {foreach name=outer item=data from=$list_featured_photos}
         <li class="{$featured_iCID}_item"><a href="{$mosConfig_live_site}/index.php?option=com_hwdphotoshare&task=viewphoto&Itemid={$Itemid}&album_id={$data->album_id}&limitstart={$data->ordering}"><div style="height: {$featured_isize}px; width: {$featured_isize}px; display:table-cell; vertical-align: middle;"><img src="{$data->photo_url}" alt="slide {$data->i}" style="max-width: {$featured_isize}px; max-height: {$featured_isize}px; margin: auto;" /></div></a></li> 
       {/foreach}
     </ul>  
     <div id="{$featured_iCID}_frame">  
         <ul>  
           {foreach name=outer item=data from=$list_featured_photos}
             <li><a href="#"><img id="thumb{$data->i}" src="{$data->thumbnail_url}" alt="thumbnail {$data->i}" width="{$featured_resize_thumb}" /></a></li>  
           {/foreach}
         </ul>  
     </div>  
 </div>
	  
	{else}
	  {$smarty.const._HWDPS_INFO_NUP}
	{/if}
	</div>
    </div>
 
    {if $print_recent_tags}
    <div class="standard">
      <h2>{$smarty.const._HWDPS_TAGS}</h2>
        <div class="padding">
	    {foreach name=loop01 item=tags from=$list_recent_tags}
		<a href="index.php?option=com_hwdphotoshare&Itemid=29&task=search&searchterm={$tags->tag}" style="font-size:{$tags->size}%;font-weight:normal;padding: 0 5px 0 0;">{$tags->tag}</a>
	    {/foreach}
	</div>
    </div>
    {/if}

  </div>

  <div class="sic-right">
		
    <div class="standard">
      <h2>{$smarty.const._HWDPS_RECENTALBUMS}</h2>
        <div class="padding">
		{if $list_recent_albums}
		    {foreach name=outer item=data from=$list_recent_albums}
			{include file="album_list_mini.tpl"}
		    {/foreach}
		{else}
		  {$smarty.const._HWDPS_INFO_NRA}
		{/if}
	</div>
    </div>

    <div class="standard">
      <h2>{$smarty.const._HWDPS_BROWSE}</h2>
        <div class="padding">
{literal}
<script language="javaScript">
function goto(form) { var index=form.select.selectedIndex
if (form.select.options[index].value != "0") {
location=form.select.options[index].value;}}
//-->
</script>
{/literal}
<form name="redirect">
<select name="select" onchange="goto(this.form)" size="1">
<option value="{$mosConfig_live_site}/index.php?option=com_hwdphotoshare&Itemid=29" selected="selected">{$smarty.const._HWDPS_BROWSEBY}</option>
<option value="{$mosConfig_live_site}/index.php?option=com_hwdphotoshare&Itemid=29&task=albums">{$smarty.const._HWDPS_ALBUMS}</option>
<option value="{$mosConfig_live_site}/index.php?option=com_hwdphotoshare&Itemid=29&task=photos">{$smarty.const._HWDPS_PHOTOS}</option>
<option value="{$mosConfig_live_site}/index.php?option=com_hwdphotoshare&Itemid=29&task=groups">{$smarty.const._HWDPS_GROUPS}</option>
<option value="{$mosConfig_live_site}/index.php?option=com_hwdphotoshare&Itemid=29&task=categories">{$smarty.const._HWDPS_CATEGORIES}</option>
</select>
</form>
	</div>
    </div>	

    {if $print_ads}{if $advert4}<div class="standard"><div class="padding"><div id="hwdadverts-nopadding">{$advert4}</div></div></div>{/if}{/if}
  
  </div>
  
  <div style="clear:both;"></div>
    
  {if $print_ads}{if $advert3}<div class="standard"><div class="padding"><div id="hwdadverts-nopadding">{$advert3}</div></div></div>{/if}{/if}

    <div class="standard">
      <h2>{$smarty.const._HWDPS_RECENTPHOTOS}</h2>
        <div class="padding">
	{if $print_recent_photos}

	<div id="{$recent_iCID}_frame"><img id="{$recent_iCID}_next" src="{$URL_HWDPS_IMAGES}arrow_next.png" alt="Next" style="padding: 5px 5px 5px 0;" /><img id="{$recent_iCID}_prev" src="{$URL_HWDPS_IMAGES}arrow_prev.png" alt="Previous" style="padding: 5px 0;" /></div>

	<center>

	  <div id="{$recent_iCID}">

	      <ul id="{$recent_iCID}_content">  
		{foreach name=outer item=data from=$list_recent_photos}
             	  <li class="{$recent_iCID}_item"><a href="{$mosConfig_live_site}/index.php?option=com_hwdphotoshare&task=viewphoto&Itemid={$Itemid}&album_id={$data->album_id}&limitstart={$data->ordering}"><img id="thumb{$data->i}" src="{$data->thumbnail_url}" alt="thumbnail {$data->i}" width="{$recent_resize_thumb}" /></a></li>  
		{/foreach}
	       </ul>  

	  </div> 

	</center>
	  
	{else}
	  {$smarty.const._HWDPS_INFO_NUP}
	{/if}
	</div>
    </div>
    
  {if $print_recent_groups}
  <div class="standard">
      <h2>{$smarty.const._HWDPS_GROUPS}</h2>
        <div class="padding">{$smarty.const._HWDPS_UD}</div>
  </div>
  {/if}
    
</div>

{include file="footer.tpl"}
