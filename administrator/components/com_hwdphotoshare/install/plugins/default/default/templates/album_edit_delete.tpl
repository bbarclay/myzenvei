{* 
//////
//    @version [ Accetto ]
//    @package hwdPhotoShare
//    @copyright (C) 2007 - 2009 Highwood Design
//    @license http://creativecommons.org/licenses/by-nc-nd/3.0/
//////
*}

<form name="deleteAlbum" action="{$form_deletealbum}" method="post">

  <div class="padding">
    <p>{$smarty.const._HWDPS_AYSYWTDTA}</p>
    <p><input type="submit" name="send" class="inputbox" value="{$smarty.const._HWDPS_BUTTON_DELETE}" /></p>
  </div>

  <input type="hidden" name="aid" value="{$album_id}" />
  <input type="hidden" name="uid" value="{$album_uid}" />
</form>
