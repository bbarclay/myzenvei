{* 
//////
//    @version [ Accetto ]
//    @package hwdPhotoShare
//    @copyright (C) 2007 - 2009 Highwood Design
//    @license http://creativecommons.org/licenses/by-nc-nd/3.0/
//////
*}

<form name="updatealbum" action="{$form_editalbum}" method="post" onsubmit="return chkUpdateAlbumForm()">
    <div class="standard">
        <table width="100%" cellpadding="0" cellspacing="0" border="0">
            <tr>
                <td width="150">{$smarty.const._HWDPS_TITLE} <font class="required">*</font></td>
                <td><input name="title" value="{$album_title}" class="inputbox" size="20" maxlength="50" style="width: 200px;" /></td>
            </tr>
            <tr>
                <td valign="top">{$smarty.const._HWDPS_DESC} <font class="required">*</font></td>
                <td valign="top"><textarea rows="4" cols="20" name="description" class="inputbox" style="width: 200px;">{$album_description}</textarea></td>
            </tr>
            <tr>
                <td>{$smarty.const._HWDPS_CATEGORY} <font class="required">*</font></td>
                <td>{$categoryselect}</td>
            </tr>
            <tr>
                <td>{$smarty.const._HWDPS_TAGS} <font class="required">*</font></td>
                <td><input name="tags" value="{$album_tags}" class="inputbox" size="20" maxlength="50" style="width: 200px;" /></td>
            </tr>
            <tr>
                <td></td>
                <td>{$smarty.const._HWDPS_INFO_TAGS}</td>
            </tr>
            <tr>
                <td>{$smarty.const._HWDPS_LOCATION}</td>
                <td><input name="location" value="{$album_location}" class="inputbox" size="20" maxlength="50" style="width: 200px;" /></td>
            </tr>
            <tr>
                <td colspan="2"><font class="required">*</font> {$smarty.const._HWDPS_INFO_REQUIREDFIELDS}</td>
            </tr>
        </table>
    </div>
    {if $print_sharingoptions}
        {include file="sharingoptions.tpl"}
    {/if}
    <div class="standard">
        <table width="100%" cellpadding="0" cellspacing="4" border="0"><tr><td width="150"></td><td><input type="submit" name="send" class="inputbox" value="{$smarty.const._HWDPS_BUTTON_UPDT}" />&#160;<input type="button" class="inputbox" value="{$smarty.const._HWDPS_BUTTON_CANX}" onClick="javascript:window.location.href='{$link_home_hwd_ps}';" /></td></tr></table>
    </div>
<input type="hidden" name="aid" value="{$album_id}" />
</form>
