{* 
//////
//    @version [ Accetto ]
//    @package hwdPhotoShare
//    @copyright (C) 2007 - 2009 Highwood Design
//    @license http://creativecommons.org/licenses/by-nc-nd/3.0/
//////
*}

{include file="header.tpl" title=foo}

<form name="createalbum" action="{$form_add_album}" method="post" onsubmit="return chkNewAlbumForm()">

<div class="standard">
  <h2>{$smarty.const._HWDPS_TITLE_CREATEALBUM}</h2>
        <table width="100%" cellpadding="0" cellspacing="0" border="0">
            <tr>
                <td width="150">{$smarty.const._HWDPS_TITLE} <font class="required">*</font></td>
                <td><input name="album_name" value="" class="inputbox" size="20" maxlength="100" style="width: 200px;" /></td>
            </tr>
            <tr>
                <td valign="top">{$smarty.const._HWDPS_DESC} <font class="required">*</font></td>
                <td valign="top"><textarea rows="4" cols="20" name="album_description" class="inputbox" style="width: 200px;"></textarea><br /></td>
            </tr>
            <tr>
                <td>{$smarty.const._HWDPS_CATEGORY} <font class="required">*</font></td>
                <td>{$categoryselect}</td>
            </tr>
            <tr>
                <td colspan="2"><font class="required">*</font> {$smarty.const._HWDPS_INFO_REQUIREDFIELDS}</td>
            </tr>
         </table>
</div>

{include file="sharingoptions.tpl"}

<div class="standard">
        <table width="100%" cellpadding="0" cellspacing="0" border="0">
	    {if $print_captcha}
	    <tr>
                <td width="150"></td>
                <td>{$captcha}</td>
            </tr>
	    <tr>
	        <td>{$smarty.const._HWDPS_INFO_SECURECODE} <font class="required">*</font></td>
	        <td><input id="security_code" name="security_code" type="text" /></td>
	    </tr>
	    {/if}
            <tr>
                <td width="150"></td>
                <td><input type="submit" name="send" class="interactbutton" value="{$smarty.const._HWDPS_BUTTON_ADD}" /></td>
            </tr>
        </table>
</div>

<input type="hidden" name="videotype" value="local" />
</form>
	
{include file="footer.tpl"}



