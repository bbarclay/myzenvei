<?php /* Smarty version 2.6.18, created on 2010-07-29 16:07:30
         compiled from main.tpl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 't', 'main.tpl.html', 34, false),array('modifier', 'escape', 'main.tpl.html', 48, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.tpl.html", 'smarty_include_vars' => array('extra_title' => 'Stats')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "navigation.tpl.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<script type="text/javascript">
<!--
var page_url = '<?php echo $_SERVER['PHP_SELF']; ?>
';
var current_page = '<?php echo $this->_tpl_vars['list_info']['current_page']; ?>
';
var last_page = '<?php echo $this->_tpl_vars['list_info']['last_page']; ?>
';
<?php echo '
function hideClosed(hide_closed)
{
    if (hide_closed.checked) {
        window.location.href = page_url + "?" + replaceParam(window.location.href, \'hide_closed\', \'1\');
    } else {
        window.location.href = page_url + "?" + replaceParam(window.location.href, \'hide_closed\', \'0\');
    }
}
//-->
</script>
'; ?>


<?php if ($this->_tpl_vars['current_role'] == $this->_tpl_vars['roles']['customer']): ?>
  <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "customer/".($this->_tpl_vars['customer_backend_name'])."/customer_report.tpl.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php else: ?>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
  <?php if ($this->_tpl_vars['hide_stats'] != true): ?>
    <td valign="top">
      <table width="100%" bgcolor="<?php echo $this->_tpl_vars['cell_color']; ?>
" border="0" cellspacing="0" cellpadding="1" align="center">
        <tr>
          <td width="100%">
            <table bgcolor="#FFFFFF" width="100%" border="0" cellspacing="0" cellpadding="4">
              <tr>
                <td>
                  <span class="default"><b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Overall Stats<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></b></span><br />
                  <span class="default">
                  <input type="checkbox" id="hide_closed" name="hide_closed" <?php if ($this->_tpl_vars['hide_closed']): ?>checked<?php endif; ?> onClick="javascript:hideClosed(this);"> <label for="hide_closed"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Hide Closed Issues<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></label>
                  </span>
                  <hr size="1" noshade color="<?php echo $this->_tpl_vars['cell_color']; ?>
">
                </td>
              </tr>
              <tr>
                <td nowrap class="default">
                  <b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Issues by Status<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:</b>
                  <br /><br />
                  <table width="100%" border="0" cellpadding="0" cellspacing="0">
                    <?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['status']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['i']['show'] = true;
$this->_sections['i']['max'] = $this->_sections['i']['loop'];
$this->_sections['i']['step'] = 1;
$this->_sections['i']['start'] = $this->_sections['i']['step'] > 0 ? 0 : $this->_sections['i']['loop']-1;
if ($this->_sections['i']['show']) {
    $this->_sections['i']['total'] = $this->_sections['i']['loop'];
    if ($this->_sections['i']['total'] == 0)
        $this->_sections['i']['show'] = false;
} else
    $this->_sections['i']['total'] = 0;
if ($this->_sections['i']['show']):

            for ($this->_sections['i']['index'] = $this->_sections['i']['start'], $this->_sections['i']['iteration'] = 1;
                 $this->_sections['i']['iteration'] <= $this->_sections['i']['total'];
                 $this->_sections['i']['index'] += $this->_sections['i']['step'], $this->_sections['i']['iteration']++):
$this->_sections['i']['rownum'] = $this->_sections['i']['iteration'];
$this->_sections['i']['index_prev'] = $this->_sections['i']['index'] - $this->_sections['i']['step'];
$this->_sections['i']['index_next'] = $this->_sections['i']['index'] + $this->_sections['i']['step'];
$this->_sections['i']['first']      = ($this->_sections['i']['iteration'] == 1);
$this->_sections['i']['last']       = ($this->_sections['i']['iteration'] == $this->_sections['i']['total']);
?>
                    <tr>
                      <td class="default"><a class="link" href="list.php?keywords=&users=&category=&release=&priority=&status=<?php echo $this->_tpl_vars['status'][$this->_sections['i']['index']]['iss_sta_id']; ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['status'][$this->_sections['i']['index']]['sta_title'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
</a></td>
                      <td align="right" class="default"><?php echo $this->_tpl_vars['status'][$this->_sections['i']['index']]['total_items']; ?>
</td>
                    </tr>
                    <?php endfor; else: ?>
                    <tr>
                      <td class="default"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>No issues could be found.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></td>
                    </tr>
                    <?php endif; ?>
                  </table>
                  <br /><br />
                  <b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Issues by Release<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:</b>
                  <br /><br />
                  <table width="100%" border="0" cellpadding="0" cellspacing="0">
                    <?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['releases']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['i']['show'] = true;
$this->_sections['i']['max'] = $this->_sections['i']['loop'];
$this->_sections['i']['step'] = 1;
$this->_sections['i']['start'] = $this->_sections['i']['step'] > 0 ? 0 : $this->_sections['i']['loop']-1;
if ($this->_sections['i']['show']) {
    $this->_sections['i']['total'] = $this->_sections['i']['loop'];
    if ($this->_sections['i']['total'] == 0)
        $this->_sections['i']['show'] = false;
} else
    $this->_sections['i']['total'] = 0;
if ($this->_sections['i']['show']):

            for ($this->_sections['i']['index'] = $this->_sections['i']['start'], $this->_sections['i']['iteration'] = 1;
                 $this->_sections['i']['iteration'] <= $this->_sections['i']['total'];
                 $this->_sections['i']['index'] += $this->_sections['i']['step'], $this->_sections['i']['iteration']++):
$this->_sections['i']['rownum'] = $this->_sections['i']['iteration'];
$this->_sections['i']['index_prev'] = $this->_sections['i']['index'] - $this->_sections['i']['step'];
$this->_sections['i']['index_next'] = $this->_sections['i']['index'] + $this->_sections['i']['step'];
$this->_sections['i']['first']      = ($this->_sections['i']['iteration'] == 1);
$this->_sections['i']['last']       = ($this->_sections['i']['iteration'] == $this->_sections['i']['total']);
?>
                    <tr>
                      <td class="default"><a class="link" href="list.php?keywords=&users=&category=&status=&priority=&release=<?php echo $this->_tpl_vars['releases'][$this->_sections['i']['index']]['iss_pre_id']; ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['releases'][$this->_sections['i']['index']]['pre_title'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
</a></td>
                      <td align="right" class="default"><?php echo $this->_tpl_vars['releases'][$this->_sections['i']['index']]['total_open_items']; ?>
<?php if (! $this->_tpl_vars['hide_closed']): ?> / <?php echo $this->_tpl_vars['releases'][$this->_sections['i']['index']]['total_closed_items']; ?>
<?php endif; ?></td>
                    </tr>
                    <?php endfor; else: ?>
                    <tr>
                      <td class="default"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>No issues could be found.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></td>
                    </tr>
                    <?php endif; ?>
                  </table>
                  <br /><br />
                  <b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Issues by Priority<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:</b>
                  <br /><br />
                  <table width="100%" border="0" cellpadding="0" cellspacing="0">
                    <?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['priorities']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['i']['show'] = true;
$this->_sections['i']['max'] = $this->_sections['i']['loop'];
$this->_sections['i']['step'] = 1;
$this->_sections['i']['start'] = $this->_sections['i']['step'] > 0 ? 0 : $this->_sections['i']['loop']-1;
if ($this->_sections['i']['show']) {
    $this->_sections['i']['total'] = $this->_sections['i']['loop'];
    if ($this->_sections['i']['total'] == 0)
        $this->_sections['i']['show'] = false;
} else
    $this->_sections['i']['total'] = 0;
if ($this->_sections['i']['show']):

            for ($this->_sections['i']['index'] = $this->_sections['i']['start'], $this->_sections['i']['iteration'] = 1;
                 $this->_sections['i']['iteration'] <= $this->_sections['i']['total'];
                 $this->_sections['i']['index'] += $this->_sections['i']['step'], $this->_sections['i']['iteration']++):
$this->_sections['i']['rownum'] = $this->_sections['i']['iteration'];
$this->_sections['i']['index_prev'] = $this->_sections['i']['index'] - $this->_sections['i']['step'];
$this->_sections['i']['index_next'] = $this->_sections['i']['index'] + $this->_sections['i']['step'];
$this->_sections['i']['first']      = ($this->_sections['i']['iteration'] == 1);
$this->_sections['i']['last']       = ($this->_sections['i']['iteration'] == $this->_sections['i']['total']);
?>
                    <tr>
                      <td class="default"><a class="link" href="list.php?keywords=&users=&category=&release=&status=&priority=<?php echo $this->_tpl_vars['priorities'][$this->_sections['i']['index']]['iss_pri_id']; ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['priorities'][$this->_sections['i']['index']]['pri_title'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
</a></td>
                      <td align="right" class="default"><?php echo $this->_tpl_vars['priorities'][$this->_sections['i']['index']]['total_open_items']; ?>
<?php if (! $this->_tpl_vars['hide_closed']): ?> / <?php echo $this->_tpl_vars['priorities'][$this->_sections['i']['index']]['total_closed_items']; ?>
<?php endif; ?></td>
                    </tr>
                    <?php endfor; else: ?>
                    <tr>
                      <td class="default"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>No issues could be found.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></td>
                    </tr>
                    <?php endif; ?>
                  </table>
                  <br /><br />
                  <b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Issues by Category<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:</b>
                  <br /><br />
                  <table width="100%" border="0" cellpadding="0" cellspacing="0">
                    <?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['categories']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['i']['show'] = true;
$this->_sections['i']['max'] = $this->_sections['i']['loop'];
$this->_sections['i']['step'] = 1;
$this->_sections['i']['start'] = $this->_sections['i']['step'] > 0 ? 0 : $this->_sections['i']['loop']-1;
if ($this->_sections['i']['show']) {
    $this->_sections['i']['total'] = $this->_sections['i']['loop'];
    if ($this->_sections['i']['total'] == 0)
        $this->_sections['i']['show'] = false;
} else
    $this->_sections['i']['total'] = 0;
if ($this->_sections['i']['show']):

            for ($this->_sections['i']['index'] = $this->_sections['i']['start'], $this->_sections['i']['iteration'] = 1;
                 $this->_sections['i']['iteration'] <= $this->_sections['i']['total'];
                 $this->_sections['i']['index'] += $this->_sections['i']['step'], $this->_sections['i']['iteration']++):
$this->_sections['i']['rownum'] = $this->_sections['i']['iteration'];
$this->_sections['i']['index_prev'] = $this->_sections['i']['index'] - $this->_sections['i']['step'];
$this->_sections['i']['index_next'] = $this->_sections['i']['index'] + $this->_sections['i']['step'];
$this->_sections['i']['first']      = ($this->_sections['i']['iteration'] == 1);
$this->_sections['i']['last']       = ($this->_sections['i']['iteration'] == $this->_sections['i']['total']);
?>
                    <tr>
                      <td class="default"><a class="link" href="list.php?keywords=&users=&category=<?php echo $this->_tpl_vars['categories'][$this->_sections['i']['index']]['iss_prc_id']; ?>
&status=&priority=&release="><?php echo ((is_array($_tmp=$this->_tpl_vars['categories'][$this->_sections['i']['index']]['prc_title'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
</a></td>
                      <td align="right" class="default"><?php echo $this->_tpl_vars['categories'][$this->_sections['i']['index']]['total_open_items']; ?>
<?php if (! $this->_tpl_vars['hide_closed']): ?> / <?php echo $this->_tpl_vars['categories'][$this->_sections['i']['index']]['total_closed_items']; ?>
<?php endif; ?></td>
                    </tr>
                    <?php endfor; else: ?>
                    <tr>
                      <td class="default"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>No issues could be found.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></td>
                    </tr>
                    <?php endif; ?>
                  </table>
                  <br /><br />
                  <b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Assigned Issues<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:</b>
                  <br /><br />
                  <table width="100%" border="0" cellpadding="0" cellspacing="0">
                    <?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['users']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['i']['show'] = true;
$this->_sections['i']['max'] = $this->_sections['i']['loop'];
$this->_sections['i']['step'] = 1;
$this->_sections['i']['start'] = $this->_sections['i']['step'] > 0 ? 0 : $this->_sections['i']['loop']-1;
if ($this->_sections['i']['show']) {
    $this->_sections['i']['total'] = $this->_sections['i']['loop'];
    if ($this->_sections['i']['total'] == 0)
        $this->_sections['i']['show'] = false;
} else
    $this->_sections['i']['total'] = 0;
if ($this->_sections['i']['show']):

            for ($this->_sections['i']['index'] = $this->_sections['i']['start'], $this->_sections['i']['iteration'] = 1;
                 $this->_sections['i']['iteration'] <= $this->_sections['i']['total'];
                 $this->_sections['i']['index'] += $this->_sections['i']['step'], $this->_sections['i']['iteration']++):
$this->_sections['i']['rownum'] = $this->_sections['i']['iteration'];
$this->_sections['i']['index_prev'] = $this->_sections['i']['index'] - $this->_sections['i']['step'];
$this->_sections['i']['index_next'] = $this->_sections['i']['index'] + $this->_sections['i']['step'];
$this->_sections['i']['first']      = ($this->_sections['i']['iteration'] == 1);
$this->_sections['i']['last']       = ($this->_sections['i']['iteration'] == $this->_sections['i']['total']);
?>
                    <tr>
                      <td class="default"><a class="link" href="list.php?keywords=&category=&release=&status=&priority=&users=<?php echo $this->_tpl_vars['users'][$this->_sections['i']['index']]['isu_usr_id']; ?>
"><?php echo $this->_tpl_vars['users'][$this->_sections['i']['index']]['usr_full_name']; ?>
</a></td>
                      <td align="right" class="default"><?php echo $this->_tpl_vars['users'][$this->_sections['i']['index']]['total_open_items']; ?>
<?php if (! $this->_tpl_vars['hide_closed']): ?> / <?php echo $this->_tpl_vars['users'][$this->_sections['i']['index']]['total_closed_items']; ?>
<?php endif; ?></td>
                    </tr>
                    <?php endfor; else: ?>
                    <tr>
                      <td class="default"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>No issues could be found.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></td>
                    </tr>
                    <?php endif; ?>
                  </table>
                  <?php if ($this->_tpl_vars['app_setup']['support_email'] == 'enabled' && $this->_tpl_vars['current_role'] > $this->_tpl_vars['roles']['reporter']): ?>
                  <br /><br />
                  <b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Emails<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:</b>
                  <br /><br />
                  <table width="100%" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                      <td class="default"><a class="link" href="emails.php?hide_associated=0"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Associated<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a></td>
                      <td align="right" class="default"><?php echo $this->_tpl_vars['emails']['associated']; ?>
</td>
                    </tr>
                    <tr>
                      <td class="default"><a class="link" href="emails.php?hide_associated=1"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Pending<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a></td>
                      <td align="right" class="default"><?php echo $this->_tpl_vars['emails']['pending']; ?>
</td>
                    </tr>
                    <tr>
                      <td class="default"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Removed<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></td>
                      <td align="right" class="default"><?php echo $this->_tpl_vars['emails']['removed']; ?>
</td>
                    </tr>
                  </table>
                  <?php endif; ?>
                </td>
              </tr>
            </table>
          </td>
        </tr>
      </table>
      <br />
    </td>
    <td>
      &nbsp;
    </td>
    <?php endif; ?>
    <td width="80%" valign="top">
      <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "latest_news.tpl.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
      <?php if ($this->_tpl_vars['app_setup']['daily_tips'] == 'enabled'): ?>
      <table width="100%" bgcolor="<?php echo $this->_tpl_vars['cell_color']; ?>
" border="0" cellspacing="0" cellpadding="1" align="center">
        <tr>
          <td width="100%">
            <table bgcolor="#FFFFFF" width="100%" border="0" cellspacing="0" cellpadding="4">
              <tr>
                <td>
                  <span class="default"><b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Did you Know?<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></b></span>
                </td>
              </tr>
              <tr>
                <td bgcolor="<?php echo $this->_tpl_vars['light_color']; ?>
" class="default">
                  <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "tips/".($this->_tpl_vars['random_tip']), 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
                </td>
              </tr>
            </table>
          </td>
        </tr>
      </table>
      <br />
      <?php endif; ?>
      <?php if ($this->_tpl_vars['pie_chart'] && $this->_tpl_vars['hide_stats'] != true): ?>
      <table width="100%" bgcolor="<?php echo $this->_tpl_vars['cell_color']; ?>
" border="0" cellspacing="0" cellpadding="1" align="center">
        <tr>
          <td width="100%">
            <table bgcolor="#FFFFFF" width="100%" border="0" cellspacing="0" cellpadding="4">
              <tr>
                <td>
                  <span class="default"><b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Graphical Stats<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
                  <?php if ($this->_tpl_vars['hide_closed']): ?>
                    <?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>(Open Issues)<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
                  <?php else: ?>
                    <?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>(All Issues)<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
                  <?php endif; ?>
                  </b> </span>
                </td>
              </tr>
              <tr>
                <td bgcolor="<?php echo $this->_tpl_vars['light_color']; ?>
" class="default">
                  <img border="0" src="<?php echo $this->_tpl_vars['rel_url']; ?>
stats_chart.php?plot=status&hide_closed=<?php echo $this->_tpl_vars['hide_closed']; ?>
">
                  <img border="0" src="<?php echo $this->_tpl_vars['rel_url']; ?>
stats_chart.php?plot=priority&hide_closed=<?php echo $this->_tpl_vars['hide_closed']; ?>
">
                  <img border="0" src="<?php echo $this->_tpl_vars['rel_url']; ?>
stats_chart.php?plot=user&hide_closed=<?php echo $this->_tpl_vars['hide_closed']; ?>
">
                  <img border="0" src="<?php echo $this->_tpl_vars['rel_url']; ?>
stats_chart.php?plot=release&hide_closed=<?php echo $this->_tpl_vars['hide_closed']; ?>
">
                  <img border="0" src="<?php echo $this->_tpl_vars['rel_url']; ?>
stats_chart.php?plot=category&hide_closed=<?php echo $this->_tpl_vars['hide_closed']; ?>
">
                </td>
              </tr>
            </table>
          </td>
        </tr>
      </table>
      <?php endif; ?>
    </td>
  </tr>
</table>
<?php endif; ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "app_info.tpl.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer.tpl.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>