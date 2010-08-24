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
//    This file generates the display for the JomSocial plugin page.
//////
//    VARIABLES AVAILBLE IN THIS TEMPLATE FILE:                                        
//    -- TO BE ADDED
//////
*}

<div id="hwdvids">

  <div class="standard">
    <div class="padding">
      {if $showall_print}
        <a href='{$showall_link}'>{$showall_text}</a> |
      {/if}
      {if $btp_print}
        <a href='{$btp_link}'>{$btp_text}</a> |
      {/if}
      {if $navlinks_print}
        <a href='{$myvideos_link}'>{$smarty.const._HWDVIDS_NAV_YOURVIDS}</a> | <a href='{$uploadvideos_link}'>{$smarty.const._HWDVIDS_NAV_UPLOAD}</a>
      {/if}
    </div>
  </div>

  {if $print_videodata}

	  {$jomsocial_js}

	  <div class="standard">
	  <div id="{$iCID}_frame"><img id="{$iCID}_next" src="{$URL_HWDVS_IMAGES}arrow_next.png" alt="Next" style="padding: 5px 5px 5px 0;" /><img id="{$iCID}_prev" src="{$URL_HWDVS_IMAGES}arrow_prev.png" alt="Previous" style="padding: 5px 0;" /></div>
	  <center>

	    <div id="{$iCID}">

	      <ul id="{$iCID}_content">  
		{foreach name=outer item=data from=$list}
		  <li class="{$iCID}_item">
		    {include file="mod_hwd_vs_list.tpl"}
		  </li>   
		{/foreach}
	       </ul>  

	    </div> 

	  </center>
	  </div>

	  <div id="joms_hwdvs_videoplayer"></div>

	  {if $print_app}

		  <div class="standard">
		  <h2>{$smarty.const._HWDVIDS_USERS_VIDEOS}</h2>
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
		  <div class="padding">{$pageNavigation}</div>
		  </div>

	  {/if}

  {else}
      {if $display eq "own"}
          <div class="standard"><div class="padding">{$smarty.const._HWDVIDS_CN_NOUV}</div></div>
      {else}
          <div class="standard"><div class="padding">{$smarty.const._HWDVIDS_CN_NOFV}</div></div>
      {/if}
  {/if}

</div>
<div style='clear:both;'></div>