<?php /* Smarty version 2.6.26, created on 2010-08-23 22:30:35
         compiled from category_view.tpl */ ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'header.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<div class="standard">
  <h2><?php echo @_HWDVIDS_TITLE_CATEGORYVIDS; ?>
 (<?php echo $this->_tpl_vars['category_name']; ?>
)</h2>
  <!--<div class="padding"><?php echo $this->_tpl_vars['category_description']; ?>
</div>-->
  
  <?php if ($this->_tpl_vars['print_subcats']): ?>
  <?php echo '
  <script type="text/javascript">
 
  document.write(\'<style type="text/css">.tabber{display:none;}<\\/style>\');

  var tabberOptions = {

    \'manualStartup\':true,
 
    \'onLoad\': function(argsObj) {
      if (argsObj.tabber.id == \'tab2\') {
        alert(\'Finished loading tab2!\');
      }
    },

    \'onClick\': function(argsObj) {

      var t = argsObj.tabber; 
      var id = t.id; 
      var i = argsObj.index; 
      var e = argsObj.event;

      if (id == \'tab2\') {
        return confirm(\'Swtich\');
      }
    },

    \'addLinkId\': true

  };
  </script>
  '; ?>

  <script type="text/javascript" src="<?php echo $this->_tpl_vars['link_home']; ?>
/plugins/hwdvs-template/default/js/tabber.js"></script>
  
  <div class="tabber" id="tab1">
    <div class="tabbertab">
      <h2><a name="tab1"><?php echo @_HWDVIDS_VIDEOS; ?>
</a></h2>
      <?php if ($this->_tpl_vars['print_videolist']): ?>

        <?php $_from = $this->_tpl_vars['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['outer'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['outer']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['data']):
        $this->_foreach['outer']['iteration']++;
?>
          <div style="width: 30%; float:left;">
            <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "video_list_full.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
          </div>
          <?php if (($this->_foreach['outer']['iteration'] == $this->_foreach['outer']['total'])): ?>
            <div style="clear:both;"></div>
          <?php elseif (($this->_foreach['outer']['iteration']-1) % 3 -2 == 0): ?>
            <div style="clear:both;"></div>
          <?php endif; ?>
        <?php endforeach; endif; unset($_from); ?>

      <?php else: ?>

        <div class="padding"><?php echo @_HWDVIDS_INFO_NCV; ?>
</div>

      <?php endif; ?>
      <?php echo $this->_tpl_vars['pageNavigation']; ?>

    </div>
    <div class="tabbertab">
      <h2><?php echo @_HWDVIDS_SUBCATS; ?>
</h2>
        <div class="categories">
          <?php $_from = $this->_tpl_vars['subcatlist']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['outer'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['outer']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['data']):
        $this->_foreach['outer']['iteration']++;
?>
            <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'category_list.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
          <?php endforeach; endif; unset($_from); ?>
        </div>
      </div>
    </div>
  
  <?php else: ?>
  
    <?php if ($this->_tpl_vars['print_videolist']): ?>
      
      <?php $_from = $this->_tpl_vars['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['outer'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['outer']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['data']):
        $this->_foreach['outer']['iteration']++;
?>
        <div style="width: 30%; float:left;">
          <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "video_list_full.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
        </div>
        <?php if (($this->_foreach['outer']['iteration'] == $this->_foreach['outer']['total'])): ?>
          <div style="clear:both;"></div>
        <?php elseif (($this->_foreach['outer']['iteration']-1) % 3 -2 == 0): ?>
          <div style="clear:both;"></div>
        <?php endif; ?>
      <?php endforeach; endif; unset($_from); ?>

    <?php else: ?>

      <div class="padding"><?php echo @_HWDVIDS_INFO_NCV; ?>
</div>
  
    <?php endif; ?>
    <?php echo $this->_tpl_vars['pageNavigation']; ?>

    
  <?php endif; ?>
  
</div>

<script type="text/javascript">
tabberAutomatic(tabberOptions);
</script>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'footer.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>