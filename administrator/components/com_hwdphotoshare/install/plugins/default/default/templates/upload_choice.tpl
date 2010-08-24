{* 
//////
//    @version [ Accetto ]
//    @package hwdPhotoShare
//    @copyright (C) 2007 - 2009 Highwood Design
//    @license http://creativecommons.org/licenses/by-nc-nd/3.0/
//////
*}

{include file='header.tpl'}

{literal}
    <script language="javascript" type="text/javascript">
	function selectCategory(){
	    document.getElementById("selectCategory").style.visibility="hidden";
	    if(document.uploadPhoto.album_id.value == '-1'){
	        document.getElementById("selectCategory").style.visibility="visible";
	    }
	}
    </script>
{/literal}

<form name="uploadPhoto" action="{$uploadForm}" method="post">

<div class="standard">
  <h2>{$smarty.const._HWDPS_TITLE_UPLOADTYPE}</h2>
  
  <div class="padding">
    {if $print_noAlbums}
      <p>{$smarty.const._HWDPS_NOALBUMSCON}</p>
    {else}
      <p>{$smarty.const._HWDPS_CMA}</p>
    {/if}

    {if $print_pending}
      <p>{$smarty.const._HWDPS_ALBUMSPENDING}</p>
    {/if}
  </div>
  
  <table width="100%" cellpadding="0" cellspacing="0" border="0">
    <tr>
      <td width="150">{$smarty.const._HWDPS_DETAILS_SALBUM}</td>
      <td>
        <select name="album_id" onChange="selectCategory();" >
          {if $print_categoryupload}
          <option value="-1">{$smarty.const._HWDPS_SELECT_SELECTCATEGORY}</option>
          {/if}
          {if $print_noAlbums}
            <option value="0" selected="selected">{$smarty.const._HWDPS_NOALBUMS}</option>
          {else}
            <option value="0" selected="selected">{$smarty.const._HWDPS_SELECT_SELECTALBUM}</option>
          {/if}
          {$albumOptions}
        </select>
      </td>
    </tr>
  </table>
  <div style="visibility:hidden;" id="selectCategory">
  <table width="100%" cellpadding="0" cellspacing="0" border="0">
    <tr>
      <td width="150"></td>
      <td>
        {$categoryselect}
      </td>
    </tr>
  </table>
  </div>
</div>

<div class="standard">
  <table width="100%" cellpadding="0" cellspacing="0" border="0">
    <tr>
      <td width="150"></td>
      <td><input type="submit" name="send" class="inputbox" value="{$smarty.const._HWDPS_BUTTON_CONTINUE}" onClick="uploadPhoto.send.disabled=true;document.uploadPhoto.submit();" /></td>
    </tr>
  </table>
</div>

</form>

{include file='footer.tpl'}



