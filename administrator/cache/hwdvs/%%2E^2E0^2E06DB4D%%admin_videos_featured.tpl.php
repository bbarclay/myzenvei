<?php /* Smarty version 2.6.26, created on 2010-02-27 14:58:09
         compiled from admin_videos_featured.tpl */ ?>

<div id="editcell">
  <table class="adminlist">
    <thead>
      <tr>
        <th width="5" class="title">ID</th>
        <th width="5"></th>
        <th class="title"><?php echo @_HWDVIDS_TITLE; ?>
</th>
        <th class="title"><?php echo @_HWDVIDS_LENGTH; ?>
</th>
        <th class="title"><?php echo @_HWDVIDS_RATING; ?>
</th>
        <th class="title"><?php echo @_HWDVIDS_VIEWS; ?>
</th>
        <th class="title"><?php echo @_HWDVIDS_ACCESS; ?>
</th>
        <th class="title"><?php echo @_HWDVIDS_DATEUPLD; ?>
</th>
        <th class="title"><?php echo @_HWDVIDS_APPROVED; ?>
</th>
        <th class="title" width="50"><?php echo @_HWDVIDS_FEATURED; ?>
</th>
        <th class="title" width="50"><?php echo @_HWDVIDS_PUB; ?>
</th>
        <th class="title" width="30"><?php echo @_HWDVIDS_ORDER; ?>
</th>
        <th class="title" width="40" colspan="2"><?php echo @_HWDVIDS_REORDER; ?>
</th>
      </tr>
    </thead>
    <tbody>
      <?php $_from = $this->_tpl_vars['list_feat']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['outer'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['outer']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['data']):
        $this->_foreach['outer']['iteration']++;
?>
      <tr class="row<?php echo $this->_tpl_vars['data']->k; ?>
">
        <td><?php echo $this->_tpl_vars['data']->id; ?>
</td>
        <td><?php echo $this->_tpl_vars['data']->checked; ?>
</td>
        <td><?php echo $this->_tpl_vars['data']->title; ?>
</td>
        <td><?php echo $this->_tpl_vars['data']->length; ?>
</td>
        <td><?php echo $this->_tpl_vars['data']->rating; ?>
</td>
        <td><?php echo $this->_tpl_vars['data']->views; ?>
</td>
        <td><?php echo $this->_tpl_vars['data']->access; ?>
</td>
        <td><?php echo $this->_tpl_vars['data']->date; ?>
</td>
        <td><?php echo $this->_tpl_vars['data']->status; ?>
</td>
        <td><a href="javascript: void(0);" onclick="return listItemTask('cb<?php echo $this->_tpl_vars['data']->i; ?>
','<?php echo $this->_tpl_vars['data']->featured_task; ?>
')"><img src="images/<?php echo $this->_tpl_vars['data']->featured_img; ?>
" width="12" height="12" border="0" alt="" /></a></td>
        <td><a href="javascript: void(0);" onclick="return listItemTask('cb<?php echo $this->_tpl_vars['data']->i; ?>
','<?php echo $this->_tpl_vars['data']->published_task; ?>
')"><img src="images/<?php echo $this->_tpl_vars['data']->published_img; ?>
" width="12" height="12" border="0" alt="" /></a></td>
        <td><?php echo $this->_tpl_vars['data']->ordering; ?>
</td>
        <td width="20"><?php echo $this->_tpl_vars['data']->reorderup; ?>
</td>
        <td width="20"><?php echo $this->_tpl_vars['data']->reorderdown; ?>
</td>
      </tr>
      <?php endforeach; endif; unset($_from); ?>
    </tbody>
  </table>
</div>