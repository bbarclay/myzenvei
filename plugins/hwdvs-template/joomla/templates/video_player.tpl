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
//    This file generates the display for the video player page.
//////
//    VARIABLES AVAILBLE IN THIS TEMPLATE FILE:                                        
//    -- TO BE ADDED
//////
*}

{include file='header.tpl'}

{if $print_nextprev}
  <div style="float:right;">{$videoplayer->nextprev}</div>
{/if}
          
<h2 class="contentheading">{$videoplayer->title} {$videoplayer->editvideo} {$videoplayer->deletevideo}</h2>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="{$player_width+15}" valign="top" style="overflow:hidden;">
      <div style="margin-right:5px;">
        <div class="standard"><div class="padding"><center>{$videoplayer->player}</center></div></div>

{$startpane}
  {if $print_uservideolist}
  {$starttab7}
            <div class="standard">
              <div class="padding">
                {foreach name=outer item=data from=$userlist}
                  {include file='video_list_simple.tpl'}
                {/foreach}
              </div>
            </div>
  {$endtab}
  {/if}
  {if $print_relatedlist}
  {$starttab8}
            <div class="standard">
              <div class="padding">
                  {foreach name=outer item=data from=$listrelated}
                    {include file='video_list_simple.tpl'}
                  {/foreach}
              </div>
            </div>
  {$endtab}
  {/if}
  {if $print_categoryvideolist}
  {$starttab9}
            <div class="standard">
              <div class="padding">
                  {foreach name=outer item=data from=$categoryvideolist}
                    {include file='video_list_simple.tpl'}
                  {/foreach}
              </div>
            </div>
  {$endtab}
  {/if}
{$endpane}
        </div> 
      </div>
    </td>
    <td valign="top">
      <div class="standard">
        <div class="padding">
	  {if $print_ads}{if $advert4}<div id="hwdadverts-padding">{$advert4}</div>{/if}{/if}
          {$videoplayer->ratingsystem}
          {if $print_videourl}
          <div>
            <h4>{$smarty.const._HWDVIDS_TITLE_PERMALINK}</h4>
            <form name="vlink"><input type="text" value="{$videoplayer->videourl}" width="90%" onclick="copyit('vlink.vlink')" name="vlink" /></form>
          </div>
          {/if}
          {if $print_embedcode}
          <div>
            <h4>{$smarty.const._HWDVIDS_INFO_VIDEMBEDCODE}</h4>
            <form name="elink"><input type="text" value="{$videoplayer->embedcode}" width="90%" onclick="copyit('elink.elink')" name="elink" /></form>
          </div>
          {/if}
          {if $print_description}<div style="width:100%;overflow:hidden;"><h4>{$smarty.const._HWDVIDS_DESC}</h4>{$videoplayer->description}</div>{/if}
          {if $print_tags}<div style="width:100%;overflow:hidden;"><h4>{$smarty.const._HWDVIDS_TAGS}</h4>{$videoplayer->tags}</div>{/if}
          <div style="width:100%;overflow:hidden;">{$videoplayer->category}</div>
          <div style="float:right;">
            <div class="padding">
              {$videoplayer->avatar}
            </div>
          </div>
          <div style="padding:5px;"/>
            <div>{$videoplayer->downloadoriginal}</div>
            <div>{$videoplayer->vieworiginal}</div>
            <div>{$videoplayer->downloadflv}</div>
            <div id="addremfav">{$videoplayer->favourties}</div>
            <div>{$videoplayer->reportmedia}</div>
            <div style="clear:both;"></div>
            <div id="ajaxresponse"></div>
            <div style="clear:both;"></div>
          </div>
        </div>
        <div class="standard">
          <div class="padding">
            {$videoplayer->socialbmlinks}
          </div>
        </div>
        <div class="standard">
          <div class="padding">
            {if $print_addtogroup}{$videoplayer->addtogroup}<div id="add2groupresponse"></div>{/if}
          </div>
        </div>
        <!--{$videoplayer->views}-->
        <!--{$videoplayer->upload_date}-->
      </div>
    </td>
  </tr>
</table>

<div style="clear:both;"></div>
{if $print_ads}{if $advert3}<div id="hwdadverts-padding">{$advert3}</div>{/if}{/if}
<div style="clear:both;"></div>

{if $print_comments}
  <h2 class="contentheading">{$smarty.const._HWDVIDS_TITLE_VIDCOMMS}</h2>
  <div class="standard">{$videoplayer->comments}</div>
{/if}   


{include file='footer.tpl'}
