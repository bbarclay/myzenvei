<?php /* Smarty version 2.6.26, created on 2010-02-27 14:52:57
         compiled from admin_import_remote.tpl */ ?>

<?php echo '
<script language="javascript" type="text/javascript">
function chk_importFormRemote() {
	var form = document.importFormRemote;

	// do field validation
	if (form.videourl.value == ""){
	    alert( "'; ?>
<?php echo @_HWDVIDS_ALERT_NOURL; ?>
<?php echo '" );
    	    form.videourl.focus();
	    return false;
	} else if (form.title.value == ""){
	    alert( "'; ?>
<?php echo @_HWDVIDS_ALERT_NOTITLE; ?>
<?php echo '" );
    	    form.title.focus();
	    return false;
	} else if (form.description.value == "") {
	    alert( "'; ?>
<?php echo @_HWDVIDS_ALERT_NODESC; ?>
<?php echo '" );
    	    form.description.focus();
	    return false;
  	} else if (form.category_id.value == 0) {
	    alert( "'; ?>
<?php echo @_HWDVIDS_ALERT_NOCAT; ?>
<?php echo '" );
    	    form.category_id.focus();
	    return false;
  	} else if (form.tags.value == "") {
	    alert( "'; ?>
<?php echo @_HWDVIDS_ALERT_NOTAG; ?>
<?php echo '" );
    	    form.tags.focus();
	    return false;
  	}
}
</script>
'; ?>


<div style="text-align:left;padding:5px;margin:5px;border:1px solid #ccc;background:#f5f5ee;">
  <h3><?php echo @_HWDVIDS_IMPT_REMOTE_TITLE; ?>
</h3>
  <?php echo @_HWDVIDS_DOCS; ?>
: <a href="http://documentation.hwdmediashare.co.uk/wiki/Import_Videos_from_SQL_Backup_File" target="_blank">http://documentation.hwdmediashare.co.uk/wiki/Import_Videos_from_SQL_Backup_File</a>
  <p><?php echo @_HWDVIDS_IMPT_REMOTE_DESC; ?>
</p>
</div>

<div style="border:1px solid #c30;color:#333333;background:#e9ddd9;font-weight: bold;text-align:left;padding:5px;margin:5px;"><?php echo @_HWDVIDS_IMPT_REMOTE_WARN; ?>
</div>

<div style="text-align:left;padding:5px;margin:5px;border:1px solid #ccc;">
<form name="importFormRemote" action="index.php" method="post" onsubmit="return chk_importFormRemote()">
  <table cellpadding="0" cellspacing="0" border="0">
    <tr><td align="left" valign="top">  
    <table width="100%" cellpadding="2" cellspacing="2" border="0">
    <tr><td width="150"><?php echo @_HWDVIDS_VREMURL; ?>
 <font class="required">*</font></td><td><input name="videourl" value="" class="inputbox" size="20" maxlength="600" style="width: 200px;" /></td></tr>
    <tr><td width="150"><?php echo @_HWDVIDS_IMGREMURL; ?>
 </td><td><input name="thumbnailurl" value="" class="inputbox" size="20" maxlength="600" style="width: 200px;" /></td></tr>
    </table>
    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'admin_upload_form.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
    <input type="submit" name="send" class="inputbox" value="<?php echo @_HWDVIDS_BUTTON_SAVE; ?>
" />
    </td></tr>
  </table> 
  <input type="hidden" name="videoid" value="$smarty.const.$filename}" />
  <input type="hidden" name="option" value="com_hwdvideoshare" />
  <input type="hidden" name="videoid" value="<?php echo $this->_tpl_vars['newvideoid']; ?>
" />
  <input type="hidden" name="duration" value="0:00:00" />
  <input type="hidden" name="task" value="remoteupload" />
  <input type="hidden" name="hidemainmenu" value="0">
</form>
</div>