<?php /* Smarty version 2.6.26, created on 2010-02-27 14:58:03
         compiled from admin_categories_browse.tpl */ ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'admin_header.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<div id="editcell">
  <table class="adminlist">
    <thead>
      <tr>
        <th width="5" class="title">ID</th>
        <th width="5" class="title"><input type="checkbox" name="toggle" value="" onClick="checkAll(<?php echo $this->_tpl_vars['totalcategories']; ?>
);" /></th>
        <th align="left" class="title"><?php echo @_HWDVIDS_TITLE; ?>
</th>
        <th align="left" class="title"><?php echo @_HWDVIDS_CVACCESS; ?>
</th>
        <th align="left" class="title"><?php echo @_HWDVIDS_CUACCESS; ?>
</th>
        <th align="left" width="50" class="title"><?php echo @_HWDVIDS_PUB; ?>
</th>
        <th align="left" width="30" class="title"><?php echo @_HWDVIDS_ORDER; ?>
</th>
        <th align="left" width="40" class="title" colspan="2"><?php echo @_HWDVIDS_REORDER; ?>
</th>
      </tr>
    </thead>
    <tbody>
      <?php $_from = $this->_tpl_vars['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['outer'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['outer']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['data']):
        $this->_foreach['outer']['iteration']++;
?>
      <?php if ($this->_tpl_vars['data']->isparent): ?>
        <tr bgcolor = "#f1f3f0">
      <?php else: ?>
        <tr class = "row<?php echo $this->_tpl_vars['data']->k; ?>
">
      <?php endif; ?>
        <td width="20"><?php echo $this->_tpl_vars['data']->id; ?>
</td>
        <td><?php echo $this->_tpl_vars['data']->checked; ?>
</td>
        <td><?php echo $this->_tpl_vars['data']->title; ?>
</td>
        <td><?php echo $this->_tpl_vars['data']->view_access; ?>
</td>
        <td><?php echo $this->_tpl_vars['data']->upld_access; ?>
</td>
        <td><a href="javascript: void(0);" onclick="return listItemTask('cb<?php echo $this->_tpl_vars['data']->i; ?>
','<?php echo $this->_tpl_vars['data']->published_task; ?>
')"><img src="images/<?php echo $this->_tpl_vars['data']->published_img; ?>
" width="12" height="12" border="0" alt="" /></a></td>
        <td><?php echo $this->_tpl_vars['data']->order; ?>
</td>
        <td width="20"><?php echo $this->_tpl_vars['data']->reorderup; ?>
</td>
        <td width="20"><?php echo $this->_tpl_vars['data']->reorderdown; ?>
</td>
      </tr>
      <?php endforeach; endif; unset($_from); ?>
    </tbody>
    <tfoot>
      <tr><td colspan="9" align="center"><?php echo $this->_tpl_vars['writePagesLinks']; ?>
<br /><?php echo $this->_tpl_vars['writePagesCounter']; ?>
</td></tr>
    </tfoot>
  </table>
</div>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'admin_footer.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>