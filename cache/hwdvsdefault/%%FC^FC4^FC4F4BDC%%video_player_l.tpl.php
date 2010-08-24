<?php /* Smarty version 2.6.26, created on 2010-08-22 10:28:44
         compiled from video_player_l.tpl */ ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'header.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

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

<?php if ($this->_tpl_vars['print_nextprev'] || $this->_tpl_vars['print_videourl'] || $this->_tpl_vars['print_embedcode'] || $this->_tpl_vars['print_uservideolist'] || $this->_tpl_vars['print_relatedlist']): ?>
<div class="sic-container">
  
  <div class="sic-right">

    <div class="standard">

      <div style="float:right;"><div class="padding"><?php echo $this->_tpl_vars['videoplayer']->avatar; ?>
</div></div>
      <?php if ($this->_tpl_vars['print_nextprev']): ?>
        <div class="padding"><?php echo $this->_tpl_vars['videoplayer']->nextprev; ?>
</div>
      <?php endif; ?>
      <?php if ($this->_tpl_vars['print_videourl']): ?>
          <div class="padding"><form name="vlink"><div><?php echo @_HWDVIDS_TITLE_PERMALINK; ?>
</div><input type="text" value="<?php echo $this->_tpl_vars['videoplayer']->videourl; ?>
" name="vlink" /></form></div>
      <?php endif; ?>
      <?php if ($this->_tpl_vars['print_embedcode']): ?>
          <div class="padding"><form name="elink"><div><?php echo @_HWDVIDS_INFO_VIDEMBEDCODE; ?>
</div><input type="text" value="<?php echo $this->_tpl_vars['videoplayer']->embedcode; ?>
" name="elink" /></form></div>
      <?php endif; ?>
      
      <div style="clear:both;"></div>
    </div>

    <?php if ($this->_tpl_vars['print_ads']): ?><?php if ($this->_tpl_vars['advert4']): ?><div class="standard"><div class="padding"><div id="hwdadverts-nopadding"><?php echo $this->_tpl_vars['advert4']; ?>
</div></div></div><?php endif; ?><?php endif; ?>
    
    <?php if ($this->_tpl_vars['print_uservideolist']): ?>
    <div class="standard">
      <h2><?php echo @_HWDVIDS_TITLE_MOREBYUSR; ?>
 <?php echo $this->_tpl_vars['videoplayer']->uploader; ?>
</h2>
      <div class="scoller">
      <div class="list">
        <div class="box">
          <?php $_from = $this->_tpl_vars['userlist']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['outer'] = array('total' => count($_from), 'iteration' => 0);
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
    
    <?php if ($this->_tpl_vars['print_relatedlist']): ?>
    <div class="standard">
      <h2><?php echo @_HWDVIDS_RELATED; ?>
</h2>
      <div class="scoller">
      <div class="list">
        <div class="box">
          <?php $_from = $this->_tpl_vars['listrelated']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['outer'] = array('total' => count($_from), 'iteration' => 0);
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

    <?php if ($this->_tpl_vars['print_categoryvideolist']): ?>
    <div class="standard">
      <h2><?php echo @_HWDVIDS_MORECATVIDS; ?>
</h2>
      <div class="scoller">
      <div class="list">
        <div class="box">
          <?php $_from = $this->_tpl_vars['categoryvideolist']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['outer'] = array('total' => count($_from), 'iteration' => 0);
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
    <div class="standard">
      <h2><?php echo $this->_tpl_vars['videoplayer']->title; ?>
 <?php echo $this->_tpl_vars['videoplayer']->editvideo; ?>
 <?php echo $this->_tpl_vars['videoplayer']->deletevideo; ?>
</h2>
      <div class="padding"><center><?php echo $this->_tpl_vars['videoplayer']->player; ?>
</center></div>
    </div>


    <div class="tabber" id="tab1">
    <?php if ($this->_tpl_vars['videoplayer']->ratingsystem || $this->_tpl_vars['videoplayer']->downloadoriginal || $this->_tpl_vars['videoplayer']->vieworiginal || $this->_tpl_vars['videoplayer']->downloadflv || $this->_tpl_vars['videoplayer']->favourties || $this->_tpl_vars['videoplayer']->reportmedia): ?>
      <div class="tabbertab">
      <h2><?php echo @_HWDVIDS_RATING; ?>
</h2>
	<div class="standard">
	  <div class="padding">
          <div style="float:right;">
            <div><?php echo $this->_tpl_vars['videoplayer']->downloadoriginal; ?>
</div>
            <div><?php echo $this->_tpl_vars['videoplayer']->vieworiginal; ?>
</div>
            <div><?php echo $this->_tpl_vars['videoplayer']->downloadflv; ?>
</div>
            <div id="addremfav"><?php echo $this->_tpl_vars['videoplayer']->favourties; ?>
</div>
            <div><?php echo $this->_tpl_vars['videoplayer']->reportmedia; ?>
</div>
          </div>
          <?php echo $this->_tpl_vars['videoplayer']->ratingsystem; ?>

          <div style="clear:both;"></div>
	    <div id="ajaxresponse"></div>
          <div style="clear:both;"></div>	
          <div style="clear:both;"></div>
	  </div>
        </div>
      </div>
      <?php endif; ?>
      <?php if ($this->_tpl_vars['videoplayer']->socialbmlinks || $this->_tpl_vars['print_addtogroup']): ?>
      <div class="tabbertab">
      <h2><?php echo @_HWDVIDS_SHARE; ?>
</h2>
	<div class="standard">
	  <div class="padding"><?php echo $this->_tpl_vars['videoplayer']->socialbmlinks; ?>
</div> 
	  <div class="padding"><?php if ($this->_tpl_vars['print_addtogroup']): ?><?php echo $this->_tpl_vars['videoplayer']->addtogroup; ?>
<div id="add2groupresponse"></div><?php endif; ?></div>
	</div>
      </div>
      <?php endif; ?>
      <?php if ($this->_tpl_vars['print_description'] || $this->_tpl_vars['print_tags'] || $this->_tpl_vars['print_tags'] || $this->_tpl_vars['videoplayer']->category): ?>
      <div class="tabbertab">
      <h2><?php echo @_HWDVIDS_INFO; ?>
</h2>
	<div class="standard">
	  <?php if ($this->_tpl_vars['print_description']): ?>
	  
	  <div class="padding"><strong><?php echo @_HWDVIDS_DESC; ?>
</strong><br /><p id="truncateMe"><?php echo $this->_tpl_vars['videoplayer']->description; ?>
</p></div><?php endif; ?>
	  
	  <!--
	  <?php echo '
	  <script type="text/javascript">
	   
	  var len = 200;
	  var p = document.getElementById(\'truncateMe\');
	  if (p) {
	   
	    var trunc = p.innerHTML;
	    if (trunc.length > len) {
	   
	      /* Truncate the content of the P, then go back to the end of the
	         previous word to ensure that we don\'t truncate in the middle of
	         a word */
	      trunc = trunc.substring(0, len);
	      trunc = trunc.replace(/\\w+$/, \'\');
	   
	      /* Add an ellipses to the end and make it a link that expands
	         the paragraph back to its original size */
	      trunc += \'<a href="#" \' +
	        \'onclick="this.parentNode.innerHTML=\' +
	        \'unescape(\\\'\'+escape(p.innerHTML)+\'\\\');return false;">\' +
	        \'... [ More ]<\\/a>\';
	      p.innerHTML = trunc;
	    }
	  }
	   
	  </script>
	  '; ?>

	  -->

	  <?php if ($this->_tpl_vars['print_tags']): ?><div class="padding"><strong><?php echo @_HWDVIDS_TAGS; ?>
</strong><br /><?php echo $this->_tpl_vars['videoplayer']->tags; ?>
</div><?php endif; ?>
	  <div class="padding"><?php echo $this->_tpl_vars['videoplayer']->category; ?>
</div>
	  <div class="padding"><!--<?php echo $this->_tpl_vars['videoplayer']->views; ?>
--></div>
	  <div class="padding"><!--<?php echo $this->_tpl_vars['videoplayer']->upload_date; ?>
--></div>
	</div>
      </div>
      <?php endif; ?>
    </div>

<?php if ($this->_tpl_vars['print_nextprev'] || $this->_tpl_vars['print_videourl'] || $this->_tpl_vars['print_embedcode'] || $this->_tpl_vars['print_uservideolist'] || $this->_tpl_vars['print_relatedlist']): ?>
  </div>
</div>
<?php endif; ?>

<div style="clear:both;"></div>
<?php if ($this->_tpl_vars['print_comments']): ?>
    <div class="standard">
      <h2><?php echo @_HWDVIDS_TITLE_VIDCOMMS; ?>
</h2>
      <?php echo $this->_tpl_vars['videoplayer']->comments; ?>

    </div>
<?php endif; ?> 
<div style="clear:both;"></div>

<script type="text/javascript">
tabberAutomatic(tabberOptions);
</script>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'footer.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>