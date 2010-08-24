<?php
/**
 * @package		JomSocial
 * @subpackage 	Template 
 * @copyright (C) 2008 by Slashes & Dots Sdn Bhd - All rights reserved!
 * @license http://www.azrul.com Copyrighted Commercial Software
 */
defined('_JEXEC') or die();

$script  = '';
$script .= '
<script type="text/javascript">
function checkAll()
{
	jQuery("#inbox-listing input[type=\'checkbox\']").each( function() {
	    if ( jQuery("#checkall").attr("checked") )
			jQuery(this).attr("checked", true);
  		else
  		    jQuery(this).attr("checked", false);
	});
	return false;
}
function checkSelected()
{
	var sel;
	sel = false;
    jQuery("#inbox-listing input[type=\'checkbox\']").each( function() {
        if ( !jQuery(this).attr("checked") )
            jQuery("#checkall").attr("checked", false);
    });
}
function deleteMarked()
{
	if ( confirm("'.JText::_('CC INBOX REMOVE CONFIRM').'") ) {
	    jQuery("#inbox-listing input[type=\'checkbox\']").each( function() {
	        if ( jQuery(this).attr("checked") ) {
				jax.call( "community", "inbox,ajaxRemoveFullMessages", jQuery(this).attr("value") );
			}
		});
		return false;
	}
}
function markAsRead( id )
{
    jQuery("#message-"+id).removeClass("inbox-unread");
    jQuery("#message-"+id).addClass("inbox-read");
    jQuery("#new-message-"+id).hide();
    jQuery("#message-"+id+" input[type=\'checkbox\']").attr("checked", false);
    jQuery("#checkall").attr("checked", false);
}
function markAsUnread( id )
{
    jQuery("#message-"+id).removeClass("inbox-read");
    jQuery("#message-"+id).addClass("inbox-unread");
    jQuery("#new-message-"+id).show();
    jQuery("#message-"+id+" input[type=\'checkbox\']").attr("checked", false);
    jQuery("#checkall").attr("checked", false);
}
function setAllAsRead()
{
    jQuery("#inbox-listing input[type=\'checkbox\']").each( function() {
        if ( jQuery(this).attr("checked") ) {
            if ( jQuery("#message-"+jQuery(this).attr("value")).hasClass("inbox-unread") ) {
            	jax.call( "community", "inbox,ajaxMarkMessageAsRead", jQuery(this).attr("value") );
            }
		}
    });
}
function setAllAsUnread()
{
    jQuery("#inbox-listing input[type=\'checkbox\']").each( function() {
        if ( jQuery(this).attr("checked") )
            if ( jQuery("#message-"+jQuery(this).attr("value")).hasClass("inbox-read") ) {
            	jax.call( "community", "inbox,ajaxMarkMessageAsUnread", jQuery(this).attr("value") );
            }
    });
}
</script>';
$mainframe =& JFactory::getApplication();
$mainframe->addCustomHeadTag( $script );
?>
<div class="inbox-toolbar">
	<table border="0" cellpadding="2" cellspacing="0" width="100%">
	    <tr class="sectiontableheader">
	        <td width="30" align="center">
	            <input type="checkbox" name="select" class="checkbox" onclick="checkAll();" id="checkall" />
			</td>
	        <td>
	            <?php if ( !JRequest::getVar('task') == 'sent' ) : ?>
				<a href="javascript:void(0);" onclick="setAllAsRead();"><?php echo JText::_('CC INBOX MARK READ'); ?></a>&nbsp;&nbsp;&nbsp;
				<a href="javascript:void(0);" onclick="setAllAsUnread();"><?php echo JText::_('CC INBOX MARK UNREAD'); ?></a>&nbsp;&nbsp;&nbsp;
				<?php endif; ?>
				<a href="javascript:void(0);" onclick="deleteMarked();"><?php echo JText::_('CC INBOX REMOVE MESSAGE'); ?></a>&nbsp;
			</td>
	    </tr>
	</table>
</div>


<div class="inbox-list" id="inbox-listing">
	<?php
	$x = 1;
	foreach ( $messages as $message ) :

	?>
	<div class="<?php echo $message->isUnread ? 'inbox-unread' : 'inbox-read'; ?>" id="message-<?php echo $message->id; ?>">
	<table border="0" cellpadding="2" cellspacing="0" width="100%">
	    <tr class="sectiontableentry<?php echo $x; ?>">
	        <td width="30" align="center">
	            <input type="checkbox" name="message[]" value="<?php echo $message->id; ?>" class="checkbox" onclick="checkSelected();" />
			</td>

	        <td width="50">
	            <img width="32" src="<?php echo $message->avatar; ?>" alt="<?php echo JString::ucfirst( $message->from_name ); ?>" class="avatar" />
			</td>
			<td>
				<a class="subject" href="<?php echo CRoute::_('index.php?option=com_community&view=inbox&task=read&msgid='. $message->parent); ?>">
					<?php if($message->isUnread) { ?>
						<img style="vertical-align:middle;" id="new-message-<?php echo $message->id;?>" src="<?php echo JURI::base(); ?>components/com_community/templates/default/images/new.gif"/>
					<?php } else { ?>
						<img style="vertical-align:middle; display:none;" id="new-message-<?php echo $message->id;?>" src="<?php echo JURI::base(); ?>components/com_community/templates/default/images/new.gif"/>					
					<?php } ?>					
					<?php echo $message->subject; ?>
				</a>
				<div class="small">
				    <?php echo $message->from_name; ?>, 
					<?php
						$postdate =  cGetDate($message->posted_on);
						echo $postdate->toFormat('%d %b %Y, %I:%M %p'); 
					?>
				</div>
			</td>
			<td width="20" align="center">
                <a href="javascript:jax.call('community', 'inbox,ajaxRemoveFullMessages', <?php echo $message->id; ?>);" class="remove" style="" title="<?php echo JText::_('CC INBOX REMOVE CONVERSATION'); ?>"><?php echo JText::_('CC INBOX REMOVE'); ?></a>
			</td>
	    </tr>
	</table>
	</div>
	<?php endforeach; ?>
</div>
<div class="pagination">
	<?php echo $pagination; ?>
</div>
