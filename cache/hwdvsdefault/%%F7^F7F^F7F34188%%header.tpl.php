<?php /* Smarty version 2.6.26, created on 2010-08-22 00:15:52
         compiled from header.tpl */ ?>

<?php if ($this->_tpl_vars['show_page_title'] == '1'): ?><div class="componentheading<?php echo $this->_tpl_vars['pageclass_sfx']; ?>
"><?php echo $this->_tpl_vars['page_title']; ?>
</div><?php endif; ?>

<div id="hwdvids">
<center>
   <?php if ($this->_tpl_vars['print_ads']): ?><?php if ($this->_tpl_vars['advert1']): ?><div id="hwdadverts-padding"><?php echo $this->_tpl_vars['advert1']; ?>
</div><?php endif; ?><?php endif; ?>
   <?php if ($this->_tpl_vars['print_search']): ?>
   <form action="<?php echo $this->_tpl_vars['form_search']; ?>
" method="post" name="mainnavform">
      <div id="hwdsearchbar" class="hwdsearchbar">
         <div class="hwdsearchbox"><?php echo $this->_tpl_vars['searchinput']; ?>
</div>
      </div>
   </form>
   <?php endif; ?>
   <?php if ($this->_tpl_vars['print_nav']): ?>
   <div id="hwdvs_navcontainer">
      <ul id="navlist">
         <?php if ($this->_tpl_vars['print_vlink']): ?><li<?php echo $this->_tpl_vars['von']; ?>
><?php echo $this->_tpl_vars['vlink']; ?>
</li><?php endif; ?>
	 <?php if ($this->_tpl_vars['print_clink']): ?><li<?php echo $this->_tpl_vars['con']; ?>
><?php echo $this->_tpl_vars['clink']; ?>
</li><?php endif; ?>
	 <?php if ($this->_tpl_vars['print_glink']): ?><li<?php echo $this->_tpl_vars['gon']; ?>
><?php echo $this->_tpl_vars['glink']; ?>
</li><?php endif; ?>
	 <?php if ($this->_tpl_vars['print_ulink']): ?><li<?php echo $this->_tpl_vars['uon']; ?>
><?php echo $this->_tpl_vars['ulink']; ?>
</li><?php endif; ?>
      </ul>
   </div>
   <?php endif; ?>
   <div style="clear:both;"></div>
   <?php if ($this->_tpl_vars['print_moderation']): ?>
   <div class="usernav">Pending Approval&nbsp;&nbsp;Reported Videos&nbsp;&nbsp;Reported Groups</div>
   <?php endif; ?>
   <div style="clear:both;"></div>
   
   <?php if ($this->_tpl_vars['print_usernav']): ?>
   <div class="usernav"><?php echo $this->_tpl_vars['yv']; ?>
&nbsp;&nbsp;<?php echo $this->_tpl_vars['yf']; ?>
&nbsp;&nbsp;<?php echo $this->_tpl_vars['yg']; ?>
&nbsp;&nbsp;<?php echo $this->_tpl_vars['ym']; ?>
&nbsp;&nbsp;<?php echo $this->_tpl_vars['cg']; ?>
</div>
   <?php endif; ?>
   <?php if ($this->_tpl_vars['print_ads']): ?><?php if ($this->_tpl_vars['advert2']): ?><div id="hwdadverts-padding"><?php echo $this->_tpl_vars['advert2']; ?>
</div><?php endif; ?><?php endif; ?>
</center>