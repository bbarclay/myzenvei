<?php /* Smarty version 2.6.26, created on 2010-08-22 06:04:24
         compiled from featured_videos_01.tpl */ ?>

<div class="standard">
<h2><?php echo @_HWDVIDS_FEATURED_VIDEOS; ?>
</h2>
    <div class="padding"><center><?php echo $this->_tpl_vars['featured_video_player']; ?>
</center></div>
</div>

  <?php if ($this->_tpl_vars['print_multiple_featured']): ?>
    <div class="standard">
      <?php $_from = $this->_tpl_vars['featuredlist']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['outer'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['outer']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['data']):
        $this->_foreach['outer']['iteration']++;
?>
        <?php if (($this->_foreach['outer']['iteration'] <= 1)): ?><?php else: ?>
          <div class="videoBox">
	  <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "video_list_full.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	  </div>
	  <?php if (($this->_foreach['outer']['iteration'] == $this->_foreach['outer']['total'])): ?>
	     <div style="clear:both;"></div>
	  <?php elseif (($this->_foreach['outer']['iteration']-1) % $this->_tpl_vars['vpr'] == 0): ?>
	     <div style="clear:both;"></div>
	  <?php endif; ?>
        <?php endif; ?>
      <?php endforeach; endif; unset($_from); ?>

      <div style="text-align:right;padding:5px;"><a href="<?php echo $this->_tpl_vars['featured_link']; ?>
" title="<?php echo @_HWDVIDS_INFO_MOREFEATUREDV; ?>
"><?php echo @_HWDVIDS_INFO_MOREFEATUREDV; ?>
</a></div>
    </div>
  <?php endif; ?>