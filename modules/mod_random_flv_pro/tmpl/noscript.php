<?php // no direct access
defined('_JEXEC') or die('Restricted access'); ?>
<div class="musicPlayer<?php echo $params->get('moduleclass_sfx'); ?>">
  <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" id="objectPlayer" 
  width="100%" height="<?php echo strval($flvlist->playerHeight); ?>px"
    codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab">
    <param name="movie" value="<?php echo $flvlist->playerMovie; ?>" /><param name="quality" value="high" /><param name="scale" value="scale" /><param name="wmode" value="transparent" /><param name="FlashVars" value="path=<?php echo rawurlencode($flvlist->path); ?>&amp;flvs=<?php echo rawurlencode( $flvlist->flvString); ?>&amp;startPlay=<?php echo $params->get('autoStart'); ?>&amp;autoReplay=<?php echo $params->get('autoReplay'); ?>" /><param name="allowScriptAccess" value="sameDomain" />
    <embed src="<?php echo $flvlist->playerMovie; ?>" quality="high" id="embedPlayer"
    width="100%" height="<?php echo strval($flvlist->playerHeight); ?>px" name="objectPlayer" align="middle" 
    play="true" scale="scale" wmode="transparent"  loop="true" quality="high" 
	allowScriptAccess="sameDomain" 
    FlashVars="path=<?php echo rawurlencode($flvlist->path); ?>&amp;flvs=<?php echo rawurlencode( $flvlist->flvString); ?>&amp;startPlay=<?php echo $params->get('autoStart'); ?>&amp;autoReplay=<?php echo $params->get('autoReplay'); ?>" 
    type="application/x-shockwave-flash" 
    pluginspage="http://www.macromedia.com/go/getflashplayer">
    </embed>
    </object>

 <div style="display:none;">module by <a href="http://www.iswebdesign.co.uk">Inspiration</a></div>

</div>
