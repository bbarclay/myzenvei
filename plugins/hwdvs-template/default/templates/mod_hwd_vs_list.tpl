{* 
//////
//    @version [ Dannevirke ]
//    @package hwdVideoShare
//    @copyright (C) 2007 - 2009 Highwood Design
//    @license http://creativecommons.org/licenses/by-nc-nd/3.0/
//////
*}

<div class="box">
<div>{$data->thumbnail}</div>
<div >

{if $hwdvids_params.showtitle eq 1}<div class="listtitle">{$data->title} {$data->editvideo} {$data->deletevideo} {$data->publishvideo}</div>{/if}
{if $hwdvids_params.showcategory eq 1}<div class="listcat">{$smarty.const._HWDVIDS_CATEGORY}: {$data->category}</div>{/if}
{if $hwdvids_params.showdescription eq 1}<div class="listdesc">{$data->description}</div>{/if}
{if $hwdvids_params.showrating eq 1}<div class="listrating">{$data->rating}</div>{/if}
{if $hwdvids_params.shownov eq 1}<div class="listviews">{$data->views} {$smarty.const._HWDVIDS_INFO_VIEWS}</div>{/if}
{if $hwdvids_params.showduration eq 1}<div class="listduration">{$data->duration}</div>{/if}
{if $hwdvids_params.showuser eq 1}<div class="listuploader">{$data->uploader}</div>{/if}
{if $hwdvids_params.showtime eq 1}<div class="listduration">{$data->timesince}</div>{/if}

</div>
<div style="clear:both;"></div>
</div>