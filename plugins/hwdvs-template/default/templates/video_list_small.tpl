{* 
//////
//    @version [ Dannevirke ]
//    @package hwdVideoShare
//    @copyright (C) 2007 - 2009 Highwood Design
//    @license http://creativecommons.org/licenses/by-nc-nd/3.0/
//////
*}

<div class="box">
<div style="float:left;">{$data->thumbnail}</div>
<div >

<div class="listtitle">{$data->title} {$data->editvideo} {$data->deletevideo}</div>
<div class="listviews">{$data->views} {$smarty.const._HWDVIDS_INFO_VIEWS}</div>
<!--<div class="listrating">{$data->rating}</div>-->
<!--<div class="listuploader">{$data->uploader}</div>-->
<!--<div class="listdesc">{$data->description}</div>-->
<!--<div class="listduration">{$smarty.const._HWDVIDS_INFO_DURATION}: {$data->duration}</div>-->
<!--<div class="listduration">{$smarty.const._HWDVIDS_DETAILS_VDATE}: {$data->upload_date}</div>-->
<!--{$data->avatar}-->
     
</div>
<div style="clear:both;"></div>
</div>