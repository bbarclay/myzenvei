{* 
//////
//    @version [ Accetto ]
//    @package hwdPhotoShare
//    @copyright (C) 2007 - 2009 Highwood Design
//    @license http://creativecommons.org/licenses/by-nc-nd/3.0/
//////
*}

<form name="photoeditr" action="{$form_editphoto}" method="post">
{if $data->pending eq "yes"}
    <div class="hwdnotice">{$smarty.const._HWDPS_PENDINGPHOTO}</div>
{/if}
   <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
         <td width="270" valign="top">
	    <table width="100%" border="0" cellspacing="0" cellpadding="0">
	       <tr>
	          <td width="60"><b>{$smarty.const._HWDPS_TITLE}</b></td>
		  <td width="*"><input type="text" value="{$data->title}" name="title"/></td>
	       </tr>
	       <tr>
	          <td><b>{$smarty.const._HWDPS_TAGS}</b></td>
		  <td><input type="text" value="{$data->tags}" name="tags"/></td>
	       </tr>
	       <tr>
	          <td><b>{$smarty.const._HWDPS_MOVETO}</b></td>
		  <td>{$album_select_list}</td>
	       </tr>
	       <tr>
	          <td valign="top"><b>{$smarty.const._HWDPS_CAPTION}</b></td>
		  <td valign="top"><textarea rows="2" cols="20" name="caption">{$data->caption}</textarea></td>
	       </tr>
	    </table>           
         </td>
         <td width="200" valign="top">
	    <input type="checkbox" value="1" {$data->setcover} name="setascover" />&nbsp;{$smarty.const._HWDPS_SETALBUMCOVER}<br />
	    <input type="checkbox" value="1" name="deletephoto" />&nbsp;{$smarty.const._HWDPS_DELETEPHOTO}<br />
            <div class="padding"><input type="submit" name="Submit" class="button" value="{$smarty.const._HWDPS_BUTTON_SAVECHANGES}" /></div>
         </td>
         <td width="*" valign="top" align="right">{$data->thumbnail}</td>
      </tr>
   </table>
<input type="hidden" name="pid" value="{$data->pid}" />
<input type="hidden" name="url" value="{$url}" />
</form>