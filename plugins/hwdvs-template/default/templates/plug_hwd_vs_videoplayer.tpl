{* 
//////
//    @version [ Dannevirke ]
//    @package hwdVideoShare
//    @copyright (C) 2007 - 2009 Highwood Design
//    @license http://creativecommons.org/licenses/by-nc-nd/3.0/
//////
*}

<div id="hwdvids">

<div class="sic-container">
  
  <div class="sic-right">

    <div class="standard">

      <div style="float:right;"><div class="padding">{$data->avatar}</div></div>
      {if $print_videourl}
          <div class="padding"><form name="vlink"><div>{$smarty.const._HWDVIDS_TITLE_PERMALINK}</div><input type="text" value="{$data->videourl}" name="vlink" /></form></div>
      {/if}
      {if $print_embedcode}
          <div class="padding"><form name="elink"><div>{$smarty.const._HWDVIDS_INFO_VIDEMBEDCODE}</div><input type="text" value="{$data->embedcode}" name="elink" /></form></div>
      {/if}
      <div style="clear:both;"></div>

    </div>

    <div class="standard"><div class="padding">{$data->ratingsystem}</div></div>

    <div class="standard">
      <div class="padding">
        <div>{$data->thumbnail}</div>
        <div>{$smarty.const._HWDVIDS_INFO_CATEGORY}: {$data->category}</div>
        <div class="listdesc">{$data->description}</div>
      </div>    
    </div>
    
  </div>
  
  <div class="sic-center">
  
    <div class="standard">
      <h2>{$data->title} {$data->editvideo} {$data->deletevideo}</h2>
      <div class="padding"><center>{$data->player}</center></div>
    </div>
    
  </div>

</div>
<div style="clear:both;"></div>
</div>

