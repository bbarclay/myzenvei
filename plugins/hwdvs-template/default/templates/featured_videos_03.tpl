{* 
//////
//    @version [ Dannevirke ]
//    @package hwdVideoShare
//    @copyright (C) 2007 - 2009 Highwood Design
//    @license http://creativecommons.org/licenses/by-nc-nd/3.0/
//////
*}

  {if $print_multiple_featured}
    <div class="standard">
      {foreach name=outer item=data from=$featuredlist}
        {if $smarty.foreach.outer.first}
            <h2>{$smarty.const._HWDVIDS_FEATURED_VIDEOS}</h2>
            <div class="padding"><center>{$featured_video_player}</center></div>

            <div class="box">
            <div style="float:left;">{$data->thumbnail}</div>
            <div class="listtitle">{$data->title} {$data->editvideo} {$data->deletevideo} {$data->publishvideo}</div>
            <div class="listviews">{$data->views} {$smarty.const._HWDVIDS_INFO_VIEWS}</div>
            <div class="listcat">{$smarty.const._HWDVIDS_INFO_CATEGORY}: {$data->category}</div>
            <div class="listrating">{$data->rating}</div>
            <!--<div class="listuploader">{$data->uploader}</div>-->
            <!--<div class="listdesc">{$data->description}</div>-->
            <!--<div class="listduration">{$smarty.const._HWDVIDS_INFO_DURATION}: {$data->duration}</div>-->
            <!--<div class="listduration">{$smarty.const._HWDVIDS_DETAILS_VDATE}: {$data->upload_date}</div>-->
            <!--{$data->avatar}-->
            <div style="clear:both;"></div>
            </div>

          </div>
          <div class="standard">
        {else}
          <div class="videoBox">
	  {include file="video_list_full.tpl"}
	  </div>
	  {if $smarty.foreach.outer.last}
	     <div style="clear:both;"></div>
	  {elseif $smarty.foreach.outer.index % $vpr == 0}
	     <div style="clear:both;"></div>
	  {/if}
        {/if}
      {/foreach}

      <div style="text-align:right;padding:5px;"><a href="{$featured_link}" title="{$smarty.const._HWDVIDS_INFO_MOREFEATUREDV}">{$smarty.const._HWDVIDS_INFO_MOREFEATUREDV}</a></div>
    </div>
  {/if}
