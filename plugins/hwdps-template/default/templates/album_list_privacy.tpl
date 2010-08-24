{* 
//////
//    @version [ Accetto ]
//    @package hwdPhotoShare
//    @copyright (C) 2007 - 2009 Highwood Design
//    @license http://creativecommons.org/licenses/by-nc-nd/3.0/
//////
*}

<div style="float:left;padding:5px 10px 5px 5px;">{$data->thumbnail}</div>

<div class="listtitle">{$data->title} {$data->editalbum_link} {$data->deletealbum_link} {$data->addphotos_link}</div>

<form name="updatealbumprivacy" action="{$form_albumprivacy}" method="post">

<div class="padding">
  {$smarty.const._HWDPS_WCSTW}<br />
  {$data->privacyselectlist}
  <br /><br />
  <input type="submit" name="Submit" class="interactbutton" value="Save Changes" />
</div>

<input type="hidden" name="album_id" value="{$data->album_id}" />
<input type="hidden" name="url" value="{$url}" />
</form>

<div style="clear:both;"></div>






