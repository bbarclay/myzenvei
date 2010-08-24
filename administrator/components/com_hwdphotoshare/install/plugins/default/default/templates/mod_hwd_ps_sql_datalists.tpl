{* 
//////
//    @version [ Accetto ]
//    @package hwdPhotoShare
//    @copyright (C) 2007 - 2009 Highwood Design
//    @license http://creativecommons.org/licenses/by-nc-nd/3.0/
//////
*}

<div style="width:{$hwdps_params.mod_width}">
{if $hwdps_params.style eq 2}
    <div id="hwdps">
	<div class="standard">
	    <div class="padding">
	      {foreach name=outer item=data from=$list}
	        {if $smarty.foreach.outer.index % $ppr-0 == 0}
	        <div class="photoRow">
	        {/if}
	        
		    {include file="mod_hwd_ps_list.tpl"}
		  
	        {if $smarty.foreach.outer.last}
	        <div style="clear:both;"></div></div>
	        {elseif $smarty.foreach.outer.index % $hwdps_params.novpr-($hwdps_params.novpr-1) == 0}
	        <div style="clear:both;"></div></div>
	        {/if}		  
	      {/foreach}
            <div style="clear:both;"></div>
            </div>
        </div>
    </div>
{else}
    <div id="hwdps">
	<div class="standard">
	    <div id="{$iCID}_frame"><img id="{$iCID}_next" src="{$URL_HWDPS_IMAGES}arrow_next.png" alt="Next" style="padding: 5px 5px 5px 0;" /><img id="{$iCID}_prev" src="{$URL_HWDPS_IMAGES}arrow_prev.png" alt="Previous" style="padding: 5px 0;" /></div>
	    <center>
                <div id="{$iCID}">
                    <ul id="{$iCID}_content">  
                        {foreach name=outer item=data from=$list}
                        <li class="{$iCID}_item">{$data->thumbnail}</li>
                        {/foreach}
                    </ul>
                </div> 
	    </center>
	</div>
    </div>
{/if}
</div>