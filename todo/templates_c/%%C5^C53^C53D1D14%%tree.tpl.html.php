<?php /* Smarty version 2.6.18, created on 2010-08-07 16:02:15
         compiled from reports/tree.tpl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 't', 'reports/tree.tpl.html', 29, false),)), $this); ?>
<html>
<head>
<link rel="StyleSheet" href="<?php echo $this->_tpl_vars['rel_url']; ?>
css/dtree.css?c=dfa7" type="text/css" />
<script type="text/javascript" src="<?php echo $this->_tpl_vars['rel_url']; ?>
js/dtree.js?c=8dbc"></script>
</head>

<body topmargin="5" marginheight="5">

<div class="dtree">
<script type="text/javascript">
<!--
tree = new dTree('tree');
tree.config.useCookies = false;
tree.icon.root = '<?php echo $this->_tpl_vars['rel_url']; ?>
images/dtree/base.gif';
tree.icon.folder = '<?php echo $this->_tpl_vars['rel_url']; ?>
images/dtree/folder.gif';
tree.icon.folderOpen = '<?php echo $this->_tpl_vars['rel_url']; ?>
images/dtree/folderopen.gif';
tree.icon.node = '<?php echo $this->_tpl_vars['rel_url']; ?>
images/dtree/page.gif';
tree.icon.empty = '<?php echo $this->_tpl_vars['rel_url']; ?>
images/dtree/empty.gif';
tree.icon.line = '<?php echo $this->_tpl_vars['rel_url']; ?>
images/dtree/line.gif';
tree.icon.join= '<?php echo $this->_tpl_vars['rel_url']; ?>
images/dtree/join.gif';
tree.icon.joinBottom = '<?php echo $this->_tpl_vars['rel_url']; ?>
images/dtree/joinbottom.gif';
tree.icon.plus = '<?php echo $this->_tpl_vars['rel_url']; ?>
images/dtree/plus.gif';
tree.icon.plusBottom = '<?php echo $this->_tpl_vars['rel_url']; ?>
images/dtree/plusbottom.gif';
tree.icon.minus = '<?php echo $this->_tpl_vars['rel_url']; ?>
images/dtree/minus.gif';
tree.icon.minusBottom = '<?php echo $this->_tpl_vars['rel_url']; ?>
images/dtree/minusbottom.gif';
tree.icon.nlPlus = '<?php echo $this->_tpl_vars['rel_url']; ?>
images/dtree/nolines_plus.gif';
tree.icon.nlMinus = '<?php echo $this->_tpl_vars['rel_url']; ?>
images/dtree/nolines_minus.gif';

tree.add(0, -1, '<?php $this->_tag_stack[] = array('t', array('escape' => 'js')); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Available Reports<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>');
tree.add(1, 0, '<?php $this->_tag_stack[] = array('t', array('escape' => 'js')); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Issues<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>');
tree.add(2, 1, '<?php $this->_tag_stack[] = array('t', array('escape' => 'js')); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Issues by User<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>', 'issue.php?cat=user', '', 'basefrm');
tree.add(3, 1, '<?php $this->_tag_stack[] = array('t', array('escape' => 'js')); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Open Issues By Assignee<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>', 'open_issues.php', '', 'basefrm');
tree.add(4, 1, '<?php $this->_tag_stack[] = array('t', array('escape' => 'js')); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Open Issues By Reporter<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>', 'open_issues.php?group_by_reporter=1', '', 'basefrm');
tree.add(5, 0, '<?php $this->_tag_stack[] = array('t', array('escape' => 'js')); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Weekly Report<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>', 'weekly.php', '', 'basefrm');
tree.add(6, 0, '<?php $this->_tag_stack[] = array('t', array('escape' => 'js')); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Workload by time period<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>', 'workload_time_period.php', '', 'basefrm');
tree.add(7, 0, '<?php $this->_tag_stack[] = array('t', array('escape' => 'js')); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Email by time period<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>', 'workload_time_period.php?type=email', '', 'basefrm');
tree.add(8, 0, '<?php $this->_tag_stack[] = array('t', array('escape' => 'js')); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Custom Fields<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>', 'custom_fields.php', '', 'basefrm');
tree.add(8, 0, '<?php $this->_tag_stack[] = array('t', array('escape' => 'js')); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Custom Fields Weekly Report<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>', 'custom_fields_weekly.php', '', 'basefrm');
tree.add(9, 0, '<?php $this->_tag_stack[] = array('t', array('escape' => 'js')); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Customer Profile Stats<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>', 'customer_stats.php', '', 'basefrm');
tree.add(10, 0, '<?php $this->_tag_stack[] = array('t', array('escape' => 'js')); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Recent Activity<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>', 'recent_activity.php', '', 'basefrm');
tree.add(11, 0, '<?php $this->_tag_stack[] = array('t', array('escape' => 'js')); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Workload By Date Range<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>', 'workload_date_range.php', '', 'basefrm');
tree.add(12, 0, '<?php $this->_tag_stack[] = array('t', array('escape' => 'js')); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Stalled Issues<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>', 'stalled_issues.php', '', 'basefrm');
tree.add(13, 0, '<?php $this->_tag_stack[] = array('t', array('escape' => 'js')); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Estimated Development Time<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>', 'estimated_dev_time.php', '', 'basefrm');
tree.add(14, 0, '<?php $this->_tag_stack[] = array('t', array('escape' => 'js')); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Categories and Statuses<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>', 'category_statuses.php', '', 'basefrm');

document.write(tree);

tree.openAll();
//-->
</script>
</div>

</body>
</html>