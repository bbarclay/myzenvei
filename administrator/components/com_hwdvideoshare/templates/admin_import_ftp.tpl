{* 
//////
//    @version [ Dannevirke ]
//    @package hwdVideoShare
//    @copyright (C) 2007 - 2009 Highwood Design
//    @license http://creativecommons.org/licenses/by-nc-nd/3.0/
//////
*}

{literal}
<script language="javascript" type="text/javascript">
function chk_importFormFTP() {
	var form = document.importFormFTP;

	// do field validation
	if (form.title.value == ""){
	    alert( "{/literal}{$smarty.const._HWDVIDS_ALERT_NOTITLE}{literal}" );
    	    form.title.focus();
	    return false;
	} else if (form.description.value == "") {
	    alert( "{/literal}{$smarty.const._HWDVIDS_ALERT_NODESC}{literal}" );
    	    form.description.focus();
	    return false;
  	} else if (form.category_id.value == 0) {
	    alert( "{/literal}{$smarty.const._HWDVIDS_ALERT_NOCAT}{literal}" );
    	    form.category_id.focus();
	    return false;
  	} else if (form.tags.value == "") {
	    alert( "{/literal}{$smarty.const._HWDVIDS_ALERT_NOTAG}{literal}" );
    	    form.tags.focus();
	    return false;
  	}
}
</script>
{/literal}

<div style="text-align:left;padding:5px;margin:5px;border:1px solid #ccc;background:#f5f5ee;">
  <h3>{$smarty.const._HWDVIDS_IMPT_FTP_TITLE}</h3>
  {$smarty.const._HWDVIDS_DOCS}: <a href="http://documentation.hwdmediashare.co.uk/wiki/Import_Videos_from_SQL_Backup_File" target="_blank">http://documentation.hwdmediashare.co.uk/wiki/Import_Videos_from_SQL_Backup_File</a>
  <p>{$smarty.const._HWDVIDS_IMPT_FTP_DESC}</p>
  <ol>
    <li>{$smarty.const._HWDVIDS_IMPT_FTP_DESC1}</li>
    <li>{$smarty.const._HWDVIDS_IMPT_FTP_DESC2} <b style='color:#ff0000'>{$newvideoid}.flv</b></li>
    <li>{$smarty.const._HWDVIDS_IMPT_FTP_DESC3}</li>
    <li>{$smarty.const._HWDVIDS_IMPT_FTP_DESC4}</li>
  </ol>
</div>

<div style="text-align:left;padding:5px;margin:5px;border:1px solid #ccc;">
<form name="importFormFTP" action="index.php" method="post" onsubmit="return chk_importFormFTP()">
  <table cellpadding="0" cellspacing="0" border="0">
    <tr><td align="left" valign="top">  
    {include file='admin_upload_form.tpl'}
    <input type="submit" name="send" class="inputbox" value="{$smarty.const._HWDVIDS_BUTTON_SAVE}" />
    </td></tr>
  </table> 
  <input type="hidden" name="videoid" value="$smarty.const.$filename}" />
  <input type="hidden" name="option" value="com_hwdvideoshare" />
  <input type="hidden" name="videoid" value="{$newvideoid}" />
  <input type="hidden" name="duration" value="0:00:00" />
  <input type="hidden" name="task" value="ftpupload" />
  <input type="hidden" name="hidemainmenu" value="0">
</form>
</div>
