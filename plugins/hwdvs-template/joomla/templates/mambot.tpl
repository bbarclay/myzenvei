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
//    This file generates the display for the content mambot.
//////
//    VARIABLES AVAILBLE IN THIS TEMPLATE FILE:                                        
//    -- $thumbwidth..........The width of the thumbnail images
//    -- $videoplayer.........The video player containing the inserted video   
//    -- $ratingsystem........The rating system for the video   
//    -- $favouritebutton.....The add/remove from favourites button   
//    -- $message.............Contains any impotant error messages or notices (generally empty)   
//    -- $data->k.............The css identifier
//    -- $data->thumbnail.....The video thumbnail   
//    -- $data->avatar........The uploader avatar  
//    -- $data->title.........The video title  
//    -- $data->editvideo.....The edit video button  
//    -- $data->deletevideo...The delete video button 
//    -- $data->category......The video category
//    -- $data->description...The video description
//    -- $data->rating........The current video rating
//    -- $data->views.........The number fo views for the video
//    -- $data->duration......The video duration
//    -- $data->uploader......The user details of the original uploader
//////
*}

<div id="hwdvids">
  <div class="standard">
    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="box{$data->k}">
      <tr>
        <td width="{$thumbwidth}" valign="top">{$data->thumbnail}</td>
        <td width="" valign="top">
          <div class="avatar">{$data->avatar}</div>
          <div class="listtitle">{$data->title} {$data->editvideo} {$data->deletevideo}</div>
          <div class="listcat">{$smarty.const._HWDVIDS_INFO_CATEGORY}: {$data->category}</div>
          <div class="listdesc">{$data->description}</div>
        </td>
        <!--
        <td width="150" valign="top">
          <div class="listrating">{$data->rating}</div>
          <div class="listviews">{$smarty.const._HWDVIDS_INFO_VIEWS}: {$data->views}</div>
          <div class="listduration">{$smarty.const._HWDVIDS_INFO_DURATION}: {$data->duration}</div>
          <div class="listuploader">{$smarty.const._HWDVIDS_INFO_FROM}: {$data->uploader}</div>
        </td>
        -->
      </tr>
    </table>
    <div class="padding">
      <center>
         {$videoplayer}
         {$ratingsystem}
        <!--{$favouritebutton}-->
        <div>{$message}</div>
      </center>
    </div>
  </div>
</div>

