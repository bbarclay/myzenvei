<?php /* Smarty version 2.6.26, created on 2010-08-22 06:04:24
         compiled from video_list_full.tpl */ ?>

<div class="box">
<div style="width:<?php echo $this->_tpl_vars['thumbwidth']; ?>
px;"><?php echo $this->_tpl_vars['data']->thumbnail; ?>
</div>
<div >

<div class="listtitle"><?php echo $this->_tpl_vars['data']->title; ?>
 <?php echo $this->_tpl_vars['data']->editvideo; ?>
 <?php echo $this->_tpl_vars['data']->deletevideo; ?>
 <?php echo $this->_tpl_vars['data']->publishvideo; ?>
</div>
<div class="listviews"><?php echo $this->_tpl_vars['data']->views; ?>
 <?php echo @_HWDVIDS_INFO_VIEWS; ?>
</div>
<div class="listcat"><?php echo @_HWDVIDS_INFO_CATEGORY; ?>
: <?php echo $this->_tpl_vars['data']->category; ?>
</div>
<div class="listrating"><?php echo $this->_tpl_vars['data']->rating; ?>
</div>
<div class="listuploader"><?php echo $this->_tpl_vars['data']->uploader; ?>
</div>
<!--<div class="listdesc"><?php echo $this->_tpl_vars['data']->description; ?>
</div>-->
<!--<div class="listduration"><?php echo @_HWDVIDS_INFO_DURATION; ?>
: <?php echo $this->_tpl_vars['data']->duration; ?>
</div>-->
<!--<div class="listduration"><?php echo @_HWDVIDS_DETAILS_VDATE; ?>
: <?php echo $this->_tpl_vars['data']->upload_date; ?>
</div>-->
<!--<?php echo $this->_tpl_vars['data']->avatar; ?>
-->
     
</div>
<div style="clear:both;"></div>
</div>