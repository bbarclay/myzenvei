{* 
//////
//    @version [ Accetto ]
//    @package hwdPhotoShare
//    @copyright (C) 2007 - 2009 Highwood Design
//    @license http://creativecommons.org/licenses/by-nc-nd/3.0/
//////
*}

{include file="header.tpl"}

  {if $print_pending}
    <div class="notice">This album has photos that are pending approval.</div>
  {/if}

<div class="standard">
  <h2>{$album->title} {$album->editvideo} {$album->deletevideo}</h2>
  <div class="padding">
  <div class="pageData">
    {if $print_photothumbs}
      {$pageData}
    {else}
      {$smarty.const._HWDPS_INFO_0PHOTOS}
    {/if}
    {if $print_editlink} | <a href="{$link_editalbum}">Edit Album</a>{/if}
    {if $print_profilelink} | {$username}{/if}
    {if $print_photothumbs}| <a href="{$link_viewslideshow}">View Slideshow</a>{/if}    
  </div>
  <div class="pageNavigation">{$pageNavigation}</div>
  </div>
  <div style="clear:both"></div>  
	  
  {if $print_photothumbs}
    {foreach name=outer item=data from=$photolist}
	  {if $smarty.foreach.outer.index % $ppr-0 == 0}
	    <div class="photoRow">
	  {/if}
	  
	  <div class="photoBox">
	      <div class="photoContainer-h"><div class="photoContainer-v">{$data->thumbnail}</div></div>
	      <div><center><div id="addremfav{$data->pid}" style="display: inline;">{$data->addtofavourites}</div>&nbsp;{$data->previewlink}&nbsp;{$data->reportphoto}</center></div>
	      <div id="ajaxresponse{$data->pid}"></div>
	      </div>

	  {if $smarty.foreach.outer.last}
	    <div style="clear:both;"></div></div>
	  {elseif $smarty.foreach.outer.index % $ppr-($ppr-1) == 0}
	    <div style="clear:both;"></div></div>
	  {/if}
    {/foreach}
  {else}
    <div class="padding">{$smarty.const._HWDPS_INFO_NPIA}</div>
  {/if}
  <div class="padding">
  <div class="pageNavigation">{$pageNavigation}</div>
  </div>
  <div style="clear:both"></div>  
</div>

<div class="standard">
  <div class="padding">
    {$album->description}<br />
    Created: {$album->datecreated} | Modified: {$album->datemodified}<br />
    {if $print_location}
      Location: {$album->location}
    {/if}  
  </div>
</div>

{include file="footer.tpl"}