<?php /* Smarty version 2.6.26, created on 2010-08-22 06:04:24
         compiled from index.tpl */ ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'header.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php if ($this->_tpl_vars['print_mostviewed'] || $this->_tpl_vars['print_mostviewed'] || $this->_tpl_vars['print_mostpopular']): ?>
<div class="sic-container">
  
  <div class="sic-right">

    <?php if ($this->_tpl_vars['print_mostviewed']): ?>
    <div class="standard">
      <h2><?php echo $this->_tpl_vars['title_mostviewed']; ?>
</h2>
      <div class="scoller">
      <div class="list">
        <div class="box">
          <?php $_from = $this->_tpl_vars['mostviewedlist']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['outer'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['outer']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['data']):
        $this->_foreach['outer']['iteration']++;
?>
	  <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "video_list_small.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	  <div style="clear:both;"></div>
          <?php endforeach; endif; unset($_from); ?>
        </div>
      </div>  
      </div>
    </div>
    <?php endif; ?>

    <?php if ($this->_tpl_vars['print_ads']): ?><?php if ($this->_tpl_vars['advert4']): ?><div class="standard"><div class="padding"><div id="hwdadverts-nopadding"><?php echo $this->_tpl_vars['advert4']; ?>
</div></div></div><?php endif; ?><?php endif; ?>
    
    <?php if ($this->_tpl_vars['print_mostfavoured']): ?>
    <div class="standard">
      <h2><?php echo $this->_tpl_vars['title_mostfavoured']; ?>
</h2>
      <div class="scoller">
      <div class="list">
        <div class="box">
          <?php $_from = $this->_tpl_vars['mostfavouredlist']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['outer'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['outer']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['data']):
        $this->_foreach['outer']['iteration']++;
?>
	  <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "video_list_small.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	  <div style="clear:both;"></div>
          <?php endforeach; endif; unset($_from); ?>
        </div>
      </div>  
      </div>
    </div>
    <?php endif; ?>

    <?php if ($this->_tpl_vars['print_mostpopular']): ?>
    <div class="standard">
      <h2><?php echo $this->_tpl_vars['title_mostpopular']; ?>
</h2>
      <div class="scoller">
      <div class="list">
        <div class="box">
          <?php $_from = $this->_tpl_vars['mostpopularlist']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['outer'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['outer']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['data']):
        $this->_foreach['outer']['iteration']++;
?>
	  <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "video_list_small.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	  <div style="clear:both;"></div>
          <?php endforeach; endif; unset($_from); ?>
        </div>
      </div>  
      </div>
    </div>
    <?php endif; ?>
  
  </div>
  
  <div class="sic-center">
<?php endif; ?>
  
    <?php if ($this->_tpl_vars['print_featured']): ?>
      <div class="hwdmodule-h3">
        <?php if ($this->_tpl_vars['print_featured_player']): ?>
          <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "featured_videos_01.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
        <?php else: ?>
          <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "featured_videos_02.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
        <?php endif; ?>
      </div>
    <?php endif; ?>

    <?php if ($this->_tpl_vars['print_ads']): ?><?php if ($this->_tpl_vars['advert3']): ?><div class="standard"><div class="padding"><div id="hwdadverts-nopadding"><?php echo $this->_tpl_vars['advert3']; ?>
</div></div></div><?php endif; ?><?php endif; ?>
    
    <?php if ($this->_tpl_vars['print_nowlist']): ?>
      <div class="hwdmodule-h4">
        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "video_beingwatched.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
      </div>
    <?php endif; ?>
    
    <div class="standard">
      <h2><?php echo @_HWDVIDS_RECENT; ?>
</h2>
      <?php if ($this->_tpl_vars['print_videolist']): ?>

          <?php $_from = $this->_tpl_vars['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['outer'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['outer']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['data']):
        $this->_foreach['outer']['iteration']++;
?>
          <div class="videoBox">
	  <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "video_list_full.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	  </div>
	  <?php if (($this->_foreach['outer']['iteration'] == $this->_foreach['outer']['total'])): ?>
	     <div style="clear:both;"></div>
	  <?php elseif (($this->_foreach['outer']['iteration']-1) % $this->_tpl_vars['vpr']- ( $this->_tpl_vars['vpr']-1 ) == 0): ?>
	     <div style="clear:both;"></div>
	  <?php endif; ?>
          <?php endforeach; endif; unset($_from); ?>
      
      <?php else: ?>
        <div class="padding"><?php echo @_HWDVIDS_INFO_NRV; ?>
</div>
      <?php endif; ?>
      <?php echo $this->_tpl_vars['pageNavigation']; ?>

    </div>

<?php if ($this->_tpl_vars['print_mostviewed'] || $this->_tpl_vars['print_mostviewed'] || $this->_tpl_vars['print_mostpopular']): ?>
  </div>
</div>
<?php endif; ?>
<div style="clear:both;"></div>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'footer.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>