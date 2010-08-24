<?php /* Smarty version 2.6.26, created on 2010-02-27 14:52:58
         compiled from admin_import_seyret.tpl */ ?>

<div style="text-align:left;padding:5px;margin:5px;border:1px solid #ccc;background:#f5f5ee;">
  <h3><?php echo @_HWDVIDS_IMPT_SEYRET_TITLE; ?>
</h3>
  <?php echo @_HWDVIDS_DOCS; ?>
: <a href="http://documentation.hwdmediashare.co.uk/wiki/Import_Videos_from_SQL_Backup_File" target="_blank">http://documentation.hwdmediashare.co.uk/wiki/Import_Videos_from_SQL_Backup_File</a>
  <p><?php echo @_HWDVIDS_IMPT_SEYRET_DESC; ?>
</p>
</div>


<?php if ($this->_tpl_vars['seyretinstalled']): ?>
    <div style="border:1px solid #ccc;color:#333333;font-weight: bold;text-align:left;padding:5px;margin:5px;">Seyret is installed on this Joomla website and you can import <?php echo $this->_tpl_vars['seyretitems']; ?>
 videos.</div>

    <div style="text-align:left;padding:5px;margin:5px;border:1px solid #ccc;">

      <h3>Import <?php echo $this->_tpl_vars['seyretitems']; ?>
 videos from Seyret</h3>
      <form name="seyretimport" action="index.php" method="post">

        <table cellpadding="4" cellspacing="1" border="0">
          <tr>
            <td valign="top">Import from Seyret category:</td>
            <td valign="top"><?php echo $this->_tpl_vars['seyretcatsel']; ?>
</td>
          </tr>
          <tr>
            <td valign="top">Import into hwdVideoShare category:</td>
            <td valign="top"><?php echo $this->_tpl_vars['categoryselect']; ?>
</td>
          </tr>
        </table>
  
        <input type="submit" value="<?php echo @_HWDVIDS_BUTTON_IMPORT; ?>
" />
        <input type="hidden" name="limitstart" value="0" />
        <input type="hidden" name="boxchecked" value="0" />
        <input type="hidden" name="option" value="com_hwdvideoshare" />	
        <input type="hidden" name="task" value="seyretImport" />
        <input type="hidden" name="hidemainmenu" value="0">
      
      </form>

      <h3>Remove all videos imported from Seyret<h3>
      <form name="seyretimport" action="index.php" method="post">
 
        <input type="submit" value="<?php echo @_HWDVIDS_BUTTON_UNDOIMPORT; ?>
"/>
        <input type="hidden" name="limitstart" value="0" />
        <input type="hidden" name="boxchecked" value="0" />
        <input type="hidden" name="option" value="com_hwdvideoshare" />
        <input type="hidden" name="task" value="seyretImportUndo" />
        <input type="hidden" name="hidemainmenu" value="0">
      
      </form>

    </div>

<?php else: ?>
    <div style="border:1px solid #c30;color:#333333;background:#e9ddd9;font-weight: bold;text-align:left;padding:5px;margin:5px;"><?php echo @_HWDVIDS_IMPT_SEYRET_WARN; ?>
</div>
<?php endif; ?>