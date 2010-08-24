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
//    This file generates the "now being watched" section on the component homepage.
//////
//    VARIABLES AVAILBLE IN THIS TEMPLATE FILE:                                        
//    -- $bw_carousel_js.......The necessary javascript to initiate the carousel   
//////
*}

<h2 class="contentheading">{$smarty.const._HWDVIDS_BWN}</h2>
<div id="{$iCID}_frame"><img id="{$iCID}_next" src="{$URL_HWDVS_IMAGES}arrow_next.png" alt="Next" /><img id="{$iCID}_prev" src="{$URL_HWDVS_IMAGES}arrow_prev.png" alt="Previous" /></div>
<div style="clear:bith;"></div>
<center>

  <div id="{$iCID}">
  
      <ul id="{$iCID}_content">  
        {foreach name=outer item=data from=$nowlist}
          <li class="{$iCID}_item">{$data->thumbnail}</li>  
        {/foreach}
       </ul>  
 
  </div> 

</center>


