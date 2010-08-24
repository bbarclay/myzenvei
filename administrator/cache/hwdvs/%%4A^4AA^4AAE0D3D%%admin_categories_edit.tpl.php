<?php /* Smarty version 2.6.26, created on 2010-02-27 16:10:39
         compiled from admin_categories_edit.tpl */ ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'admin_header.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php if ($this->_tpl_vars['print_parentcheck']): ?>
<?php echo '
<script language="javascript" type="text/javascript">
function submitbutton(pressbutton) {
	var form = document.adminForm;
	if (pressbutton == \'cancelcat\') {
		submitform( pressbutton );
		return;
	}

	// do field validation
	if (form.category_name.value == ""){
		alert( "{$smarty.const._HWDVIDS_ALERT_NOCNAME}" );
	} else if (form.parent.value == "'; ?>
<?php echo $this->_tpl_vars['category_id']; ?>
<?php echo '"){
		alert( "'; ?>
<?php echo @_HWDVIDS_ALERT_PARENTNOTSELF; ?>
<?php echo '" );
		return false;
	} else {
		submitform( pressbutton );
	}
}
</script>
'; ?>

<?php endif; ?>

<table cellpadding="4" cellspacing="1" border="0" class="adminform">
  <tr>
    <th colspan="2"><h2><?php echo @_HWDVIDS_CATEGORYDET; ?>
</h2></th>
  </tr>
  <tr>
    <td valign="top" align="left" width="60%">
      <table>
        <tr>
          <td><?php echo @_HWDVIDS_CPARENT; ?>
</td>
          <td><?php echo $this->_tpl_vars['categoryList']; ?>
</td>
        </tr>
        <tr>
          <td></td>
          <td></td>
        </tr>
        <tr>
          <td><?php echo @_HWDVIDS_TITLE; ?>
</td>
          <td><input name="category_name" value="<?php echo $this->_tpl_vars['row']->category_name; ?>
" size="55" maxlength="50"></td>
        </tr>
        <tr>
          <td></td>
          <td></td>
        </tr>
        <tr>
          <td valign="top"><?php echo @_HWDVIDS_DESC; ?>
</td>
          <td valign="top"><textarea rows="5" cols="80" name ="category_description"><?php echo $this->_tpl_vars['row']->category_description; ?>
</textarea></td>
        </tr>
      </table>
    </td>
    <td valign="top" align="right" width="40%">
      <table>
        <tr>
          <td valign="top" width="40%">
            <table class="adminform">
              <tr>
                <td><?php echo @_HWDVIDS_PUB; ?>
</td>
                <td><?php echo $this->_tpl_vars['published']; ?>
</td>
              </tr>
              <?php if ($this->_tpl_vars['print_accessgroups']): ?>
              <tr>
                <td valign="top"><?php echo @_HWDVIDS_CVACCESS; ?>
</td>
                <td valign="top"><?php echo $this->_tpl_vars['cvaccess_g']; ?>
</td>
              </tr>
              <tr>
                <td valign="top"><?php echo @_HWDVIDS_INCLUDECHILD; ?>
</td>
                <td valign="top"><?php echo $this->_tpl_vars['access_v_r']; ?>
</td>
              </tr>
              <tr>
                <td valign="top"><?php echo @_HWDVIDS_CUACCESS; ?>
</td>
                <td valign="top"><?php echo $this->_tpl_vars['cuaccess_g']; ?>
</td>
              </tr>	  
              <tr>
                <td valign="top"><?php echo @_HWDVIDS_INCLUDECHILD; ?>
</td>
                <td valign="top"><?php echo $this->_tpl_vars['access_u_r']; ?>
</td>
              </tr>	  
              <?php else: ?>
              <tr>
                <td valign="top"><?php echo @_HWDVIDS_CVACCESS; ?>
</td>
                <td valign="top"><?php echo $this->_tpl_vars['cvaccess_l']; ?>
</td>
              </tr>
              <tr>
                <td valign="top"><?php echo @_HWDVIDS_CUACCESS; ?>
</td>
                <td valign="top"><?php echo $this->_tpl_vars['cuaccess_l']; ?>
</td>
              </tr>
              <?php endif; ?>
              <tr>
                <td valign="top"><?php echo @_HWDVIDS_CVVISIBLE; ?>
</td>
                <td valign="top"><?php echo $this->_tpl_vars['access_b_v']; ?>
</td>
              </tr>
              <tr>
                <td valign="top" colspan="2">
                <?php echo $this->_tpl_vars['hidden_inputs']; ?>

		</form>
                <h3>Custom Thumbnail</h3>
 			
 			<?php if ($this->_tpl_vars['print_thumbnail']): ?>
 			<div style="float:right;padding:5px;"><img src="<?php echo $this->_tpl_vars['thumbnail_url']; ?>
" border="0" alt="" /></div>
			<?php endif; ?>
			
			<form action="index.php" method="post" enctype="multipart/form-data">
			<div style="padding:2px 0;"><input type="file" name="thumbnail_file" value="" size="30"></div>
			<div style="padding:2px 0;"><input type="submit" value="Upload"></div>

			<?php echo $this->_tpl_vars['hidden_inputs']; ?>

			</form>
 			
 			<div style="padding:5px 0;">Delete Custom Thumbnail</div>

                 </td>
              </tr>
            </table>
          </td>
        </tr>
      </table>
    </td>
  </tr>
</table>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'admin_footer.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>