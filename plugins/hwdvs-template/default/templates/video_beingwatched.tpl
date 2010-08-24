{* 
//////
//    @version [ Dannevirke ]
//    @package hwdVideoShare
//    @copyright (C) 2007 - 2009 Highwood Design
//    @license http://creativecommons.org/licenses/by-nc-nd/3.0/
//////
*}

<div class="standard">
<h2><div id="{$iCID}_frame"><img id="{$iCID}_next" src="{$URL_HWDVS_IMAGES}arrow_next.png" alt="Next" /><img id="{$iCID}_prev" src="{$URL_HWDVS_IMAGES}arrow_prev.png" alt="Previous" /></div>{$smarty.const._HWDVIDS_BWN}</h2>

<center>

  <div id="{$iCID}">
  
      <ul id="{$iCID}_content">  
        {foreach name=outer item=data from=$nowlist}
          <li class="{$iCID}_item"><div class="box">{$data->thumbnail}</div></li>  
        {/foreach}
       </ul>  
 
  </div> 

</center>
</div>







 
