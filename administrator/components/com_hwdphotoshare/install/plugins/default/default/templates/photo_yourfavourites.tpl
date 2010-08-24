{* 
//////
//    @version [ Accetto ]
//    @package hwdPhotoShare
//    @copyright (C) 2007 - 2009 Highwood Design
//    @license http://creativecommons.org/licenses/by-nc-nd/3.0/
//////
*}

{include file="header.tpl" title=foo}

<div class="standard">
  <h2>{$smarty.const._HWDPS_YFP}</h2>
  {if $print_photolist}
  <div class="padding">
  <div class="pageData">
    {if $print_photolist}
      {$pageData}
    {else}
      {$smarty.const._HWDPS_INFO_0PHOTOS}
    {/if}
  </div>
  <div class="pageNavigation">{$pageNavigation}</div>
  <div style="clear:both"></div>  
  </div>
    {foreach name=outer item=data from=$list}
	  {if $smarty.foreach.outer.index % $ppr-0 == 0}
	    <div class="photoRow">
	  {/if}
	  
	  <div class="photoBox"><div class="photoContainer-h"><div class="photoContainer-v">{$data->thumbnail}</div></div></div>
	  
	  {if $smarty.foreach.outer.last}
	    <div style="clear:both;"></div></div>
	  {elseif $smarty.foreach.outer.index % $ppr-($ppr-1) == 0}
	    <div style="clear:both;"></div></div>
	  {/if}
    {/foreach}
  <div class="padding">
  <div class="pageNavigation">{$pageNavigation}</div>
  <div style="clear:both"></div>  
  </div>    
  {else}
    <div class="padding">{$smarty.const._HWDPS_INFO_NFP}</div>
  {/if}
</div>

{include file="footer.tpl"}
