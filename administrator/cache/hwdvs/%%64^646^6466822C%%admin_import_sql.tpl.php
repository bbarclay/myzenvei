<?php /* Smarty version 2.6.26, created on 2010-02-27 14:52:57
         compiled from admin_import_sql.tpl */ ?>

<div style="text-align:left;padding:5px;margin:5px;border:1px solid #ccc;background:#f5f5ee;">
  <h3><?php echo @_HWDVIDS_IMPT_SQL_TITLE; ?>
</h3>
  <?php echo @_HWDVIDS_DOCS; ?>
: <a href="http://documentation.hwdmediashare.co.uk/wiki/Import_Videos_from_SQL_Backup_File" target="_blank">http://documentation.hwdmediashare.co.uk/wiki/Import_Videos_from_SQL_Backup_File</a>
  <p><?php echo @_HWDVIDS_IMPT_SQL_DESC; ?>
</p>
</div>

<div style="border:1px solid #c30;color:#333333;background:#e9ddd9;font-weight: bold;text-align:left;padding:5px;margin:5px;"><?php echo @_HWDVIDS_IMPT_SQL_WARN; ?>
</div>

<div style="text-align:left;padding:5px;margin:5px;border:1px solid #ccc;">
  <form action="index.php" method="post" enctype="multipart/form-data">
    <input type="file" name="upfile_0" value="" size="30">
    <input type="submit" value="<?php echo @_HWDVIDS_BUTTON_UPLOAD; ?>
">
    <input type="hidden" name="option" value="com_hwdvideoshare" />
    <input type="hidden" name="task" value="sqlRestore" />
    <input type="hidden" name="hidemainmenu" value="0">
  </form>
</div>