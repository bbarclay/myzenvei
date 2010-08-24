<?php /* Smarty version 2.6.26, created on 2010-02-27 14:52:57
         compiled from admin_upload_sharingoptions.tpl */ ?>

<?php if ($this->_tpl_vars['print_sharing']): ?>
  <table width="100%" cellpadding="2" cellspacing="2" border="0">
  <?php if ($this->_tpl_vars['usershare1']): ?>
    <tr>
      <td width="150"><?php echo @_HWDVIDS_ACCESS; ?>
</td>
      <td>
        <select name="public_private">
          <option value="public"<?php echo $this->_tpl_vars['so1p']; ?>
><?php echo @_HWDVIDS_SELECT_PUBLIC; ?>
</option>
          <option value="registered"<?php echo $this->_tpl_vars['so1r']; ?>
><?php echo @_HWDVIDS_SELECT_REG; ?>
</option>
        </select>
      </td>
    </tr>
  <?php else: ?>
    <tr>
      <td colspan="2"><input type="hidden" name="public_private" value="<?php echo $this->_tpl_vars['so1value']; ?>
"></td>
    </tr>
  <?php endif; ?>
  <?php if ($this->_tpl_vars['usershare2']): ?>
    <tr>
      <td width="150"><?php echo @_HWDVIDS_ACOMMENTS; ?>
</td>
      <td>
        <select name="allow_comments">
          <option value="1"<?php echo $this->_tpl_vars['so21']; ?>
><?php echo @_HWDVIDS_SELECT_ALLOWCOMMS; ?>
</option>
          <option value="0"<?php echo $this->_tpl_vars['so20']; ?>
><?php echo @_HWDVIDS_SELECT_DONTALLOWCOMMS; ?>
</option>
        </select>
      </td>
    </tr>
  <?php else: ?>
    <tr>
      <td colspan="2"><input type="hidden" name="allow_comments" value="<?php echo $this->_tpl_vars['so2value']; ?>
"></td>
    </tr>
  <?php endif; ?>
  <?php if ($this->_tpl_vars['usershare3']): ?>
    <tr>
      <td width="150"><?php echo @_HWDVIDS_AEMBEDDING; ?>
</td>
      <td>
        <select name="allow_embedding">
          <option value="1"<?php echo $this->_tpl_vars['so31']; ?>
><?php echo @_HWDVIDS_SELECT_ALLOWEMB; ?>
</option>
          <option value="0"<?php echo $this->_tpl_vars['so30']; ?>
><?php echo @_HWDVIDS_SELECT_DONTALLOWEMB; ?>
</option>
        </select>
      </td>
    </tr>
  <?php else: ?>
    <tr>
      <td colspan="2"><input type="hidden" name="allow_embedding" value="<?php echo $this->_tpl_vars['so3value']; ?>
"></td>
    </tr>
  <?php endif; ?>
  <?php if ($this->_tpl_vars['usershare4']): ?>
    <tr>
      <td width="150"><?php echo @_HWDVIDS_ARATINGS; ?>
</td>
      <td>
        <select name="allow_ratings">
          <option value="1"<?php echo $this->_tpl_vars['so31']; ?>
><?php echo @_HWDVIDS_SELECT_ALLOWRATE; ?>
</option>
          <option value="0"<?php echo $this->_tpl_vars['so30']; ?>
><?php echo @_HWDVIDS_SELECT_DONTALLOWRATE; ?>
</option>
        </select>
      </td>
    </tr>
  <?php else: ?>
    <tr>
      <td colspan="2"><input type="hidden" name="allow_ratings" value="<?php echo $this->_tpl_vars['so4value']; ?>
"></td>
    </tr>
  <?php endif; ?>
  </table>
<?php else: ?>
  <input type="hidden" name="public_private" value="<?php echo $this->_tpl_vars['so1value']; ?>
" />
  <input type="hidden" name="allow_comments" value="<?php echo $this->_tpl_vars['so2value']; ?>
" />
  <input type="hidden" name="allow_embedding" value="<?php echo $this->_tpl_vars['so3value']; ?>
" />
  <input type="hidden" name="allow_ratings" value="<?php echo $this->_tpl_vars['so4value']; ?>
" />
<?php endif; ?>