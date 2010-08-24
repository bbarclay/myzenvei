<?php // no direct access
defined('_JEXEC') or die('Restricted access'); ?>
<div class="musicPlayer<?php echo $params->get('moduleclass_sfx'); ?>">    
  <div id="<?php echo $flvlist->uniq_id; ?>">
  <script type="text/javascript" language="javascript">
      <?php echo $flvlist->js; ?>  
  </script>  
  <script type="text/javascript" language="javascript" src="modules/mod_random_flv_pro/flashscript/embedplayer.js"></script>
  </div>
   <script type="text/javascript" language="javascript" src="modules/mod_random_flv_pro/flashscript/embedpopup.js"></script>
    <noscript>
        <p>Sorry, you need to have javascript and flash enabled on your web browser to experience    this content.</p>
  </noscript>
  <div style="display:none;">module by <a href="http://www.iswebdesign.co.uk">Inspiration</a></div>

</div>