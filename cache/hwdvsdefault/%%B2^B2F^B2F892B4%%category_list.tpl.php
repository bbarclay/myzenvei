<?php /* Smarty version 2.6.26, created on 2010-08-22 20:36:33
         compiled from category_list.tpl */ ?>

<?php if ($this->_tpl_vars['data']->level == 0): ?>
  <div class="box">
    <div style="width:<?php echo $this->_tpl_vars['thumbwidth']; ?>
;float:left;"><?php echo $this->_tpl_vars['data']->thumbnail; ?>
</div>
    <div class="listtitle"><?php echo $this->_tpl_vars['data']->title; ?>
 (<?php echo $this->_tpl_vars['data']->num_vids; ?>
 <?php echo @_HWDVIDS_INFO_VIDEOS; ?>
, <?php echo $this->_tpl_vars['data']->num_subcats; ?>
 <?php echo @_HWDVIDS_INFO_SUBCATS; ?>
)</div>
    <div class="listdesc"><?php echo $this->_tpl_vars['data']->description; ?>
</div>
    <div style="clear:both;"></div>
  </div>
<?php elseif ($this->_tpl_vars['data']->level == 1): ?>
  <?php if ($this->_tpl_vars['hideSubcats'] == 0): ?>
    <div class="box">
      <div style="width:<?php echo $this->_tpl_vars['thumbwidth']; ?>
;float:left;"><img src="<?php echo $this->_tpl_vars['mosConfig_live_site']; ?>
/components/com_hwdvideoshare/images/sub_dir_arrow.png" style="vertical-align:top;text-align:right;"></div>
      <div class="listtitle"><?php echo $this->_tpl_vars['data']->title; ?>
 (<?php echo $this->_tpl_vars['data']->num_vids; ?>
 <?php echo @_HWDVIDS_INFO_VIDEOS; ?>
, <?php echo $this->_tpl_vars['data']->num_subcats; ?>
 <?php echo @_HWDVIDS_INFO_SUBCATS; ?>
)</div>
      <div class="listdesc"><?php echo $this->_tpl_vars['data']->description; ?>
</div>
      <div style="clear:both;"></div>
    </div>
  <?php endif; ?>
<?php elseif ($this->_tpl_vars['data']->level == 2): ?>
  <?php if ($this->_tpl_vars['hideSubcats'] == 0): ?>
    <div class="box">
      <div style="width:<?php echo $this->_tpl_vars['thumbwidth']; ?>
;float:left;"><img src="<?php echo $this->_tpl_vars['mosConfig_live_site']; ?>
/components/com_hwdvideoshare/images/sub_sub_dir_arrow.png" style="vertical-align:top;text-align:right;"></div>
      <div class="listtitle"><?php echo $this->_tpl_vars['data']->title; ?>
 (<?php echo $this->_tpl_vars['data']->num_vids; ?>
 <?php echo @_HWDVIDS_INFO_VIDEOS; ?>
, <?php echo $this->_tpl_vars['data']->num_subcats; ?>
 <?php echo @_HWDVIDS_INFO_SUBCATS; ?>
)</div>
      <div class="listdesc"><?php echo $this->_tpl_vars['data']->description; ?>
</div>
      <div style="clear:both;"></div>
    </div>
  <?php endif; ?>
<?php endif; ?>