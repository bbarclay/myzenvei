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

<div id="hwd_vs_joms">

  <div style="text-align:right;padding: 5px 0;">
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

  {if $print_videodata}

    {$jomsocial_js}
  
    <center>
      <div id="carousel_jomsocial" class="carousel-component">
        <div><img id="prev-arrow_jomsocial" class="left-button-image" src="{$JURL}/components/com_hwdvideoshare/images/modules/left-enabled.png" alt="Previous Button"/></div>
        <div><img id="next-arrow_jomsocial" class="right-button-image" src="{$JURL}/components/com_hwdvideoshare/images/modules/right-enabled.png" alt="Next Button"/></div>
        <div class="carousel_jomsocial-clip-region">
          <ul class="carousel_jomsocial-list">
            <!-- Filled in via the loadInitHandler, loadNextHandler, and loadPrevHandler -->
          </ul>
        </div>
      </div>
      <a name="video"></a>
      <div id="joms_hwdvs_videoplayer"></div>
    </center>

    <div class="recent">
    {if $print_app}
      {foreach name=outer item=data from=$list}
        <table width="100%" border="0" cellspacing="0" cellpadding="0" class="box{$data->k}">
          <tr>
            <td width="{$thumbwidth}" valign="top">{$data->thumbnail}</td>
            <td width="" valign="top">
              <div style="float:right;">
                <div class="listrating">{$data->rating}</div>
                <div class="listviews">{$smarty.const._HWDVIDS_INFO_VIEWS}: {$data->views}</div>
              </div>
              <div class="listtitle">{$data->title} {$data->editvideo} {$data->deletevideo}</div>
              <div class="listcat">{$smarty.const._HWDVIDS_INFO_CATEGORY}: {$data->category}</div>
              <div class="listdesc">{$data->description}</div>
            </td>
          </tr>
        </table>
      {/foreach}
    {/if}
    {$pageNavigation}
    </div>

  {else}
  
    <div class="recent">
      <div class="padding">{$smarty.const._HWDVIDS_CN_NOUV}</div>
    </div>
    
  {/if}

</div>
  
<div style='clear:both;'></div>