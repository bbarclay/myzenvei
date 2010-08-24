<?php
/**
 * @package		JomSocial
 * @subpackage 	Template 
 * @copyright (C) 2008 by Slashes & Dots Sdn Bhd - All rights reserved!
 * @license http://www.jomsocial.com Copyrighted Commercial Software
 */
defined('_JEXEC') or die();

if(! empty($messages))
{
?>
<script type="text/javascript">
	function cAddReply() {
	    if(jQuery('textarea.replybox').val() == '<?php echo JText::_('CC MESSAGE MISSING'); ?>' || jQuery('textarea.replybox').val() == '') {
	        alert('<?php echo JText::_('CC MESSAGE MISSING'); ?>');
	        return;
		}
	    var html='<div class=\'ajax-wait\'>&nbsp;</div>';
	    jQuery('#community-wrap table tbody').append(html);
		jax.call('community', 'inbox,ajaxAddReply', <?php echo $parentData->id; ?>, jQuery('textarea.replybox').val());
	    jQuery('textarea.replybox').attr('disabled', 'disabled');
		jQuery('button.replybox').attr('disabled', 'disabled');					
	}
	
	function cReplyFocus(){
		if(jQuery('textarea.replybox').val() == '<?php echo JText::_('CC DEFAULT REPLY'); ?>')
			jQuery('textarea.replybox').val('');
	}
	
	function cReplyBlur(){
		if(jQuery('textarea.replybox').val() == '')
			jQuery('textarea.replybox').val('<?php echo JText::_('CC DEFAULT REPLY'); ?>');
	}
	
	function cAppendReply(html){
		jQuery('div.ajax-wait').remove();
		jQuery('textarea.replybox').attr('disabled', '');
		jQuery('button.replybox').attr('disabled', '');					
		jQuery('textarea.replybox').val('');				
		jQuery('#community-wrap div#inbox-messages').append(html);
	}
</script>
<div class="inbox-message-heading"><?php echo $messageHeading;?></div>
<div id="inbox-messages">
	<?php echo $htmlContent; ?>
</div>

<a name="latest"></a>
<form action="" method="post" class="inbox-reply-form" style="margin: 0 10px 0 60px">
	<div class="inbox-reply">
		<textarea id="replybox" onfocus="cReplyFocus()" onblur="cReplyBlur()" class="replybox"><?php echo JText::_('CC DEFAULT REPLY'); ?></textarea>
	</div>
	<div>
		<input type="hidden" name="action" value="doSubmit"/>
		<button id="replybutton" class="replybox ajax-wait button" onclick="cAddReply();return false;"><?php echo JText::_('CC BUTTON ADD REPLY'); ?></button>
	</div>
</form>
<?php } else { ?>
<?php echo $htmlContent; ?>
<?php } ?>