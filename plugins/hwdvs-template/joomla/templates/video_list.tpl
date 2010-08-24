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
//    This file generates the display for each individual video.
//////
//    VARIABLES AVAILBLE IN THIS TEMPLATE FILE:                                        
//    -- $thumbwidth..........The width of the thumbnail image
//    -- $data->k.............The css identifier                          
//    -- $data->thumbnail.....The video thumbnail image                    
//    -- $data->avatar........The avatar of the uploader               
//    -- $data->title.........The video title
//    -- $data->editvideo.....The edit video button
//    -- $data->deletevideo...The delete video button
//    -- $data->category......The video category
//    -- $data->description...The video description
//    -- $data->rating........The current rating of the video
//    -- $data->views.........The total number of views
//    -- $data->duration......The duration of the video
//    -- $data->uploader......The original uploader
//    -- $data->upload_date...The date uploaded
//////
*}

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="box">
  <tr class="sectiontableentry{$data->k+1}">
    <td width="{$thumbwidth}" valign="top">
      {$data->thumbnail}
    </td>
    <td valign="top">
      <div class="avatar">{$data->avatar}</div>
      <div class="listrating">{$data->rating}</div>
      <div class="listviews">{$smarty.const._HWDVIDS_INFO_VIEWS}: {$data->views}</div>
      <!--<div class="listduration">{$smarty.const._HWDVIDS_INFO_DURATION}: {$data->duration}</div>-->
      <!--<div class="listduration">{$smarty.const._HWDVIDS_DETAILS_VDATE}: {$data->upload_date}</div>-->
      <div class="listuploader">{$smarty.const._HWDVIDS_INFO_FROM}: {$data->uploader}</div>
    </td>
  </tr>
  <tr class="sectiontableentry{$data->k+1}">
    <td width="" valign="top" colspan="2">
      <div class="listtitle">{$data->title} {$data->editvideo} {$data->deletevideo}</div>
      <div class="listcat">{$smarty.const._HWDVIDS_INFO_CATEGORY}: {$data->category}</div>
      <div class="listdesc">{$data->description}</div>
    </td>
  </tr>
</table>