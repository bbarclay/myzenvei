{* 
//////
//    @version [ Accetto ]
//    @package hwdPhotoShare
//    @copyright (C) 2007 - 2009 Highwood Design
//    @license http://creativecommons.org/licenses/by-nc-nd/3.0/
//////
*}

{include file="admin_header.tpl"}
		
<table cellpadding="0" cellspacing="0" border="0" width="100%">
  <tr>
    <td align="left" valign="top" width="50%">
      <div style="border: 1px solid #ccc; padding: 5px; margin: 0 5px 5px 0;">
	<h2>Fix SQL Database Errors</h2>
	<p><b>Last Run: {$fixerror_cache}</b></p>
	<select name="run_fixerrors">
            <option value="2">{$smarty.const._HWDPS_MAIN_RIR}</option>
            <option value="1" selected="selected">{$smarty.const._HWDPS_MAIN_RN}</option>
            <option value="0">{$smarty.const._HWDPS_MAIN_DRN}</option>
	</select>
      </div>
    </td>
    <td align="left" valign="top">
      <div style="border: 1px solid #ccc; padding: 5px; margin: 0 0 5px 0;">
	<h2>Recount SQL Database Statistics</h2>
	<p><b>Last Run: {$recount_cache}</b></p>
	<select name="run_recount">
            <option value="2">{$smarty.const._HWDPS_MAIN_RIR}</option>
            <option value="1" selected="selected">{$smarty.const._HWDPS_MAIN_RN}</option>
            <option value="0">{$smarty.const._HWDPS_MAIN_DRN}</option>
	</select>
      </div>
    </td>
    <td align="left" valign="top">
  </tr>
  <tr>
    <td align="left" valign="top" width="50%">
      <div style="border: 1px solid #ccc; padding: 5px; margin: 0 5px 5px 0;">
	<h2>Archive Access Logs</h2>
	<p><b>Last Run: {$archive_cache}</b></p>
	<select name="run_archivelogs">
            <option value="2">{$smarty.const._HWDPS_MAIN_RIR}</option>
            <option value="1" selected="selected">{$smarty.const._HWDPS_MAIN_RN}</option>
            <option value="0">{$smarty.const._HWDPS_MAIN_DRN}</option>
	</select>
      </div>
    </td>
    <td align="left" valign="top"></td>
  </tr>
</table>

{include file="admin_footer.tpl"}
