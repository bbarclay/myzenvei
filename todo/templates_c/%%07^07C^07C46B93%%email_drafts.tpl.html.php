<?php /* Smarty version 2.6.18, created on 2010-07-29 22:17:40
         compiled from email_drafts.tpl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 't', 'email_drafts.tpl.html', 43, false),array('modifier', 'count', 'email_drafts.tpl.html', 43, false),array('modifier', 'escape', 'email_drafts.tpl.html', 74, false),array('modifier', 'default', 'email_drafts.tpl.html', 78, false),array('function', 'get_innerhtml', 'email_drafts.tpl.html', 48, false),array('function', 'get_display_style', 'email_drafts.tpl.html', 55, false),array('function', 'cycle', 'email_drafts.tpl.html', 67, false),)), $this); ?>

<?php echo '
<script type="text/javascript">
<!--
function viewDraft(draft_id, issue_id)
{
    var features = \'width=740,height=580,top=30,left=30,resizable=yes,scrollbars=yes,toolbar=no,location=no,menubar=no,status=no\';
    var draftWin = window.open(\'send.php?cat=view_draft&issue_id=\' + issue_id + \'&id=\' + draft_id, \'_draft\' + draft_id, features);
    draftWin.focus();
}
function createDraft(issue_id)
{
    var features = \'width=740,height=580,top=30,left=30,resizable=yes,scrollbars=yes,toolbar=no,location=no,menubar=no,status=no\';
    var draftWin = window.open(\'send.php?cat=create_draft&issue_id=\' + issue_id, \'_createDraft\', features);
    draftWin.focus();
}

function showAllDrafts(thisBox)
{
    if (thisBox.checked) {
        showValue = 1;
    } else {
        showValue = 0;
    }
    setCookie(\'show_all_drafts\', showValue);
    document.location.href = document.location.href;
}
//-->
</script>
'; ?>

<?php if ($_REQUEST['show_all_drafts'] == 1): ?>
  <?php $this->assign('draft_col_count', '7'); ?>
<?php else: ?>
  <?php $this->assign('draft_col_count', '6'); ?>
<?php endif; ?>
<table width="100%" bgcolor="<?php echo $this->_tpl_vars['cell_color']; ?>
" border="0" cellspacing="0" cellpadding="1" align="center">
  <tr>
    <td width="100%">
      <table bgcolor="#FFFFFF" width="100%" cellspacing="1" cellpadding="2" border="0">
        <form name="draft_form">
        <tr>
          <td class="default" nowrap>
            <b><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Drafts<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> (<?php echo count($this->_tpl_vars['drafts']); ?>
)</b>
          </td>
          <td align="right" class="default">
            [ <a class="link" href="#top"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Back to Top<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a> ]
          <?php if ($this->_tpl_vars['browser']['ie5up'] || $this->_tpl_vars['browser']['ns6up'] || $this->_tpl_vars['browser']['gecko'] || $this->_tpl_vars['browser']['safari'] || $this->_tpl_vars['browser']['opera5up'] || $this->_tpl_vars['browser']['safari'] || $this->_tpl_vars['browser']['opera5up']): ?>
            [ <a id="drafts_link" class="link" href="javascript:void(null);" onClick="javascript:toggleVisibility('drafts');"><?php echo smarty_function_get_innerhtml(array('element_name' => 'drafts','total' => count($this->_tpl_vars['drafts'])), $this);?>
</a> ]
            <?php endif; ?>
          </td>
        </tr>
        <tr>
          <td colspan="2">
            <table width="100%" cellpadding="2" cellspacing="1">
              <tr id="drafts1" <?php echo smarty_function_get_display_style(array('element_name' => 'drafts','total' => count($this->_tpl_vars['drafts'])), $this);?>
 bgcolor="<?php echo $this->_tpl_vars['internal_color']; ?>
">
                <td class="default_white" NOWRAP><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "expandable_cell/buttons.tpl.html", 'smarty_include_vars' => array('remote_func' => 'getDraft','ec_id' => 'draft')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></td>
                <td width="5" class="default_white" align="center">#</td>
                <?php if ($_REQUEST['show_all_drafts'] == 1): ?>
                <td width="5%" class="default_white"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Status<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></td>
                <?php endif; ?>
                <td width="20%" class="default_white"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>From<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></td>
                <td width="20%" class="default_white"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>To<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></td>
                <td width="20%" class="default_white" nowrap><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Last Updated Date<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></td>
                <td width="40%" class="default_white"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Subject<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></td>
              </tr>
              <?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['drafts']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
              <?php echo smarty_function_cycle(array('values' => $this->_tpl_vars['cycle'],'assign' => 'row_color'), $this);?>

              <tr id="drafts<?php echo $this->_sections['i']['iteration']+1; ?>
" <?php echo smarty_function_get_display_style(array('element_name' => 'drafts','total' => count($this->_tpl_vars['drafts'])), $this);?>
 <?php if ($this->_tpl_vars['drafts'][$this->_sections['i']['index']]['emd_status'] != 'pending'): ?>style="text-decoration: line-through;"<?php endif; ?>>
                <td class="default" NOWRAP bgcolor="<?php echo $this->_tpl_vars['row_color']; ?>
"><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "expandable_cell/buttons.tpl.html", 'smarty_include_vars' => array('ec_id' => 'draft','list_id' => $this->_tpl_vars['drafts'][$this->_sections['i']['index']]['emd_id'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></td>
                <td width="5" class="default" bgcolor="<?php echo $this->_tpl_vars['row_color']; ?>
" align="center"><?php echo $this->_sections['i']['iteration']; ?>
</td>
                <?php if ($_REQUEST['show_all_drafts'] == 1): ?>
                <td width="5%" class="default" bgcolor="<?php echo $this->_tpl_vars['row_color']; ?>
"><?php echo $this->_tpl_vars['drafts'][$this->_sections['i']['index']]['emd_status']; ?>
</td>
                <?php endif; ?>
                <td width="20%" class="default" bgcolor="<?php echo $this->_tpl_vars['row_color']; ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['drafts'][$this->_sections['i']['index']]['from'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
</td>
                <td width="20%" class="default" bgcolor="<?php echo $this->_tpl_vars['row_color']; ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['drafts'][$this->_sections['i']['index']]['to'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
</td>
                <td width="20%" class="default" nowrap bgcolor="<?php echo $this->_tpl_vars['row_color']; ?>
"><?php echo $this->_tpl_vars['drafts'][$this->_sections['i']['index']]['emd_updated_date']; ?>
</td>
                <td width="40%" class="default" bgcolor="<?php echo $this->_tpl_vars['row_color']; ?>
">
                  <a title="<?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>view email details<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" href="javascript:void(null);" onClick="javascript:viewDraft(<?php echo $this->_tpl_vars['drafts'][$this->_sections['i']['index']]['emd_id']; ?>
, <?php echo $_GET['id']; ?>
);" class="link"><?php echo ((is_array($_tmp=((is_array($_tmp=@$this->_tpl_vars['drafts'][$this->_sections['i']['index']]['emd_subject'])) ? $this->_run_mod_handler('default', true, $_tmp, "<Empty Subject Header>") : smarty_modifier_default($_tmp, "<Empty Subject Header>")))) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
</a>
                </td>
              </tr>
              <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "expandable_cell/body.tpl.html", 'smarty_include_vars' => array('ec_id' => 'draft','list_id' => $this->_tpl_vars['drafts'][$this->_sections['i']['index']]['emd_id'],'colspan' => $this->_tpl_vars['draft_col_count'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
              <?php endfor; else: ?>
              <tr id="drafts2" <?php echo smarty_function_get_display_style(array('element_name' => 'drafts','total' => count($this->_tpl_vars['drafts'])), $this);?>
>
                <td colspan="<?php echo $this->_tpl_vars['draft_col_count']; ?>
" bgcolor="<?php echo $this->_tpl_vars['light_color']; ?>
" class="default" align="center">
                  <i><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>No email drafts could be found.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></i>
                </td>
              </tr>
              <?php endif; ?>
              <?php if ($this->_tpl_vars['current_role'] > $this->_tpl_vars['roles']['reporter']): ?>
              <tr>
                <td colspan="<?php echo $this->_tpl_vars['draft_col_count']; ?>
" bgcolor="<?php echo $this->_tpl_vars['internal_color']; ?>
" align="center">
                  <table width="100%" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                      <td width="20%">&nbsp;</td>
                      <td width="60%" align="center"><input type="button" value="<?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Create Draft<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" class="button" onClick="javascript:createDraft(<?php echo $_GET['id']; ?>
);"></td>
                      <td width="20%" align="right">
                        <input type="checkbox" name="show_all_drafts" id="show_all_drafts" value="1" <?php if ($_REQUEST['show_all_drafts'] == 1): ?>checked<?php endif; ?> onClick="javascript:showAllDrafts(this)"><span class="default_white"><label for="show_all_drafts"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Show All Drafts<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></label></span>
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>
              <?php endif; ?>
            </table>
          </td>
        </tr>
        </form>
      </table>
    </td>
  </tr>
</table>
