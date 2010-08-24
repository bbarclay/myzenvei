<?php /* Smarty version 2.6.26, created on 2010-08-22 20:36:33
         compiled from category_index.tpl */ ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'header.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

  <?php if ($this->_tpl_vars['print_orderselect']): ?>
  <div style="float:right;text-align:right;padding:5px;">
    <?php echo '
    <script language="javaScript">
      function goto_sort(form) { 
        var index=form.select_order.selectedIndex
        if (form.select_order.options[index].value != "0") {
          location=form.select_order.options[index].value;
        }
      }
    </script>
    '; ?>

    <form name="redirect">
      <select name="select_order" onchange="goto_sort(this.form)" size="1">
        <option value="" selected="selected"><?php echo @_HWDVIDS_TITLE_ORDERING; ?>
</option>
        <option value="<?php echo $this->_tpl_vars['mosConfig_live_site']; ?>
/index.php?option=com_hwdvideoshare&Itemid=<?php echo $this->_tpl_vars['Itemid']; ?>
&task=categories&hwdcorder=orderASC"><?php echo @_HWDVIDS_SELECT_ORDERING; ?>
 ASC</option>
        <option value="<?php echo $this->_tpl_vars['mosConfig_live_site']; ?>
/index.php?option=com_hwdvideoshare&Itemid=<?php echo $this->_tpl_vars['Itemid']; ?>
&task=categories&hwdcorder=orderDESC"><?php echo @_HWDVIDS_SELECT_ORDERING; ?>
 DESC</option>
        <option value="<?php echo $this->_tpl_vars['mosConfig_live_site']; ?>
/index.php?option=com_hwdvideoshare&Itemid=<?php echo $this->_tpl_vars['Itemid']; ?>
&task=categories&hwdcorder=nameASC"><?php echo @_HWDVIDS_SELECT_NAME; ?>
 ASC</option>
        <option value="<?php echo $this->_tpl_vars['mosConfig_live_site']; ?>
/index.php?option=com_hwdvideoshare&Itemid=<?php echo $this->_tpl_vars['Itemid']; ?>
&task=categories&hwdcorder=nameDESC"><?php echo @_HWDVIDS_SELECT_NAME; ?>
 DESC</option>
        <option value="<?php echo $this->_tpl_vars['mosConfig_live_site']; ?>
/index.php?option=com_hwdvideoshare&Itemid=<?php echo $this->_tpl_vars['Itemid']; ?>
&task=categories&hwdcorder=novidsASC"><?php echo @_HWDVIDS_SELECT_NOVIDS; ?>
 ASC</option>
        <option value="<?php echo $this->_tpl_vars['mosConfig_live_site']; ?>
/index.php?option=com_hwdvideoshare&Itemid=<?php echo $this->_tpl_vars['Itemid']; ?>
&task=categories&hwdcorder=novidsDESC"><?php echo @_HWDVIDS_SELECT_NOVIDS; ?>
 DESC</option>
        <option value="<?php echo $this->_tpl_vars['mosConfig_live_site']; ?>
/index.php?option=com_hwdvideoshare&Itemid=<?php echo $this->_tpl_vars['Itemid']; ?>
&task=categories&hwdcorder=nosubsASC"><?php echo @_HWDVIDS_SELECT_NOSUBS; ?>
 ASC</option>
        <option value="<?php echo $this->_tpl_vars['mosConfig_live_site']; ?>
/index.php?option=com_hwdvideoshare&Itemid=<?php echo $this->_tpl_vars['Itemid']; ?>
&task=categories&hwdcorder=nosubsDESC"><?php echo @_HWDVIDS_SELECT_NOSUBS; ?>
 DESC</option>
      </select>
    </form>
  </div>
  <?php endif; ?>
  <div style="clear:both;"></div>
  
<?php if ($this->_tpl_vars['print_categories']): ?>
<div class="standard">

  <?php $_from = $this->_tpl_vars['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['outer'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['outer']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['data']):
        $this->_foreach['outer']['iteration']++;
?>
    
    <?php if (($this->_foreach['outer']['iteration'] <= 1)): ?>
      <div class="categoryBox"><div class="padding">
    <?php elseif ($this->_tpl_vars['data']->level == 0): ?>
      </div></div><div class="categoryBox"><div class="padding">      
    <?php else: ?>
    <?php endif; ?>

          <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "category_list.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	  
	  <?php if (($this->_foreach['outer']['iteration'] == $this->_foreach['outer']['total'])): ?>
	   <div style="clear:both;"></div></div></div>
	  <?php elseif (($this->_foreach['outer']['iteration']-1) % $this->_tpl_vars['cpr']- ( $this->_tpl_vars['cpr']-1 ) == 0): ?>
	   <!--<div style="clear:both;"></div>-->
	  <?php endif; ?>
    
    <?php if ($this->_tpl_vars['data']->level == 0): ?>
    <?php else: ?>
    <?php endif; ?>
    
  <?php endforeach; endif; unset($_from); ?>
  <div style="clear:both;"></div>
  
</div>
<?php endif; ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'footer.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

