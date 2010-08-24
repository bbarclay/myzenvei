{* 
//////
//    @version [ Accetto ]
//    @package hwdPhotoShare
//    @copyright (C) 2007 - 2009 Highwood Design
//    @license http://creativecommons.org/licenses/by-nc-nd/3.0/
//////
*}

{$data->thumbnail}
<div>{$data->addphotos_link}{$data->editalbum_link}{$data->deletealbum_link}</div>
<div class="avatar">{$data->avatar}</div>
<div>{$data->editalbum_button} {$data->deletealbum_button} {$data->addphotos_button}</div>
<div>{$data->title}</div>
<div>{$data->numberofphotos} {$smarty.const._HWDPS_PHOTOS}</div>
<div>{$data->category}</div>
<div>{$data->description}</div>
<div style="clear:right;"></div>
<div>{$smarty.const._HWDPS_MODIFIED} {$data->datemodified}</div>
<div>{$smarty.const._HWDPS_CREATED} {$data->datecreated}</div>
<div style="clear:both;"></div>
