<?php /* Smarty version 2.6.26, created on 2010-02-27 14:52:58
         compiled from admin_import_tp.tpl */ ?>

<?php echo '
<script language="javascript" type="text/javascript">
function chk_importFormThirdParty() {
	var form = document.importFormThirdParty;

	// do field validation
	if (form.embeddump.value == ""){
	    alert( "'; ?>
<?php echo @_HWDVIDS_ALERT_NOURL; ?>
<?php echo '" );
    	    form.embeddump.focus();
	    return false;
	} else if (form.category_id.value == 0) {
	    alert( "'; ?>
<?php echo @_HWDVIDS_ALERT_NOCAT; ?>
<?php echo '" );
    	    form.category_id.focus();
	    return false;
  	}
}
</script>
'; ?>


<div style="text-align:left;padding:5px;margin:5px;border:1px solid #ccc;background:#f5f5ee;">
  <h3><?php echo @_HWDVIDS_IMPT_TP_TITLE; ?>
</h3>
  <?php echo @_HWDVIDS_DOCS; ?>
: <a href="http://documentation.hwdmediashare.co.uk/wiki/Import_Videos_from_SQL_Backup_File" target="_blank">http://documentation.hwdmediashare.co.uk/wiki/Import_Videos_from_SQL_Backup_File</a>
  <p><?php echo @_HWDVIDS_IMPT_TP_DESC; ?>
</p>
</div>

<div style="text-align:left;padding:5px;margin:5px;border:1px solid #ccc;">

    <form action="index.php" method="post" enctype="multipart/form-data" name="importFormThirdParty" onsubmit="return chk_importFormThirdParty()">
  
    <div style="float:right;">
      <table cellpadding="0" cellspacing="1" border="0" class="adminform">
        <tr>
          <td align="left" colspan="2" valign="top"><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'admin_upload_form_tp.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></td>
        </tr>
      </table>
    </div>

    <table cellpadding="2" cellspacing="2" border="0">
      <tr>
        <td valign="top" width="150"><?php echo @_HWDVIDS_IMPT_MT; ?>
</td>
        <td valign="top">
          <select name="videotype">
            <option value="1">Single YouTube Video</option>
            <option value="2">YouTube Playlist</option>
            <option value="3">YouTube User's Videos</option>
            <option value="4">YouTube RSS Feed</option>
            <!-- <option value="00">YouTube User's Favorites</option> -->
            <option value="5">Other Third Party Video</option>
          </select>
        </td>
      </tr>
      <tr>
        <td valign="top">Video / Playlist / Profile URL</td>
        <td valign="top"><input type="text" name="embeddump" value="" size="30"></td>
      </tr>
      <tr>
         <td valign="top" colspan="2" valign="top"><input type="submit" value="<?php echo @_HWDVIDS_BUTTON_UPLOAD; ?>
"></td>
      </tr>
    </table>

    <input type="hidden" name="option" value="com_hwdvideoshare" />
    <input type="hidden" name="task" value="thirdpartyimport" />
    <input type="hidden" name="hidemainmenu" value="0">
  
    </form>

    <div style="clear:both"></div>

</div>



