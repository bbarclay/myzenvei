{* 
//////
//    @version [ Accetto ]
//    @package hwdPhotoShare
//    @copyright (C) 2007 - 2009 Highwood Design
//    @license http://creativecommons.org/licenses/by-nc-nd/3.0/
//////
*}

<div id="hwdps">
    <div class="padding">
	<div class="standard">

	{if $print_photothumbs}
	    {foreach name=outer item=data from=$photolist}
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
	{else}
	    <div class="padding">{$smarty.const._HWDPS_INFO_NPIA}</div>
	{/if}

        {$message}
        <div style="clear:both;"></div
        </div>
    </div>
</div>
