{* 
//////
//    @version [ Accetto ]
//    @package hwdPhotoShare
//    @copyright (C) 2007 - 2009 Highwood Design
//    @license http://creativecommons.org/licenses/by-nc-nd/3.0/
//////
*}

{if $print_sharing}
<div class="standard">
<h2>{$smarty.const._HWDPS_TITLE_OPTIONS}</h2>
    <table width="100%" cellpadding="0" cellspacing="0" border="0">
        {if $usershare1}
        <tr>
            <td width="150">{$smarty.const._HWDPS_ACCESS}</td>
            <td>
		<select name="privacy">
		<option value="public"{$so1p}>{$smarty.const._HWDPS_SELECT_PUBLIC}</option>
		<option value="registered"{$so1r}>{$smarty.const._HWDPS_SELECT_REG}</option>
		</select>
	    </td>
	</tr>
        {else}
	<tr>
	    <td colspan="2"><input type="hidden" name="public_private" value="{$so1value}"></td>
	</tr>
        {/if}
        {if $usershare2}
        <tr>
            <td width="150">{$smarty.const._HWDPS_ACOMMENTS}</td>
            <td>
		<select name="allow_comments">
		<option value="1"{$so21}>{$smarty.const._HWDPS_SELECT_ALLOWCOMMS}</option>
		<option value="0"{$so20}>{$smarty.const._HWDPS_SELECT_DONTALLOWCOMMS}</option>
		</select>
	    </td>
	</tr>
        {else}
	<tr>
	    <td colspan="2"><input type="hidden" name="allow_comments" value="{$so2value}"></td>
	</tr>
        {/if}
        {if $usershare4}
        <tr>
            <td width="150">{$smarty.const._HWDPS_ARATINGS}</td>
            <td>
		<select name="allow_ratings">
		<option value="1"{$so31}>{$smarty.const._HWDPS_SELECT_ALLOWRATE}</option>
		<option value="0"{$so30}>{$smarty.const._HWDPS_SELECT_DONTALLOWRATE}</option>
		</select>
	    </td>
	</tr>
        {else}
	<tr>
	    <td colspan="2"><input type="hidden" name="allow_ratings" value="{$so4value}"></td>
	</tr>
        {/if}
    </table>
</div>
{else}
<input type="hidden" name="public_private" value="{$so1value}" />
<input type="hidden" name="allow_comments" value="{$so2value}" />
<input type="hidden" name="allow_ratings" value="{$so4value}" />
{/if}