<script type="text/javascript" language="javascript">
var wall = {
	toggle: 	function(id) {
		if ( !jQuery('#' + id).hasClass('open') ) {
			jQuery('#' + id).slideDown().addClass('open');
		}
		else {
			jQuery('#'+id).slideUp().removeClass('open');
		}
	}
}; 

<?php if( $isMine ): ?>
var curStatus = '';
var iphone = {
	editStatus:		function() {
		jQuery('#edit-status-overlay').fadeIn();
		jQuery('#status-text').focus();
	},
	cancelUpdate: 	function() {
		jQuery('#edit-status-overlay').fadeOut();
	},
	saveUpdate: 	function() {
		if ( curStatus != jQuery('#status-text').val() ) {
			
			// show loading?
			jQuery('#loading').show();
			
			curStatus = escape(jQuery('#status-text').val());
			jax.call('community', 'status,ajaxUpdate', curStatus);
			
			jQuery('#profile-status-message').html(unescape(curStatus));
			jQuery('#status-text').val(unescape(curStatus));
		}
		jQuery('#loading').hide();
		jQuery('#edit-status-overlay').hide();
	},
	clearField: 	function() {
		jQuery('#status-text').val('').focus();
	}
};
jQuery(document).ready( function() {
	jQuery('#status-text').val('<?php echo addslashes(JText::_($user->_status)); ?>');
});
<?php endif; ?>

function tabToggle(id)
{
	if ( !jQuery('#section-' + id).hasClass('current') )
	{
		var destination = jQuery('#profile-tab').offset().top;
		jQuery("html:not(:animated),body:not(:animated)").animate({ 
			scrollTop: destination
		}, 500, '');
			
		jQuery('.tab-item').removeClass('active');
		jQuery('.section-item').removeClass('current');
		jQuery('.section-item').hide();
		
		jQuery('#section-' + id).addClass('current');
		jQuery('#section-' + id).show();
		jQuery('#' + id).addClass('active');
	}
	return false;
}
jQuery(document).ready( function() {
	jQuery('#section-wall .app-box-header').remove();
});
</script>

<div class="profile-main">
	
	<?php if ( !$isMine ): ?>
	<div class="black-button" id="back-toolbar">
		<a class="btn-blue btn-prev" href="<?php echo CRoute::_('index.php?option=com_community&view=profile&userid=' . $my->id); ?>">
			<span><?php echo JText::_('CC BACK TO PROFILE'); ?></span>
		</a>
		<div class="clr"></div>
	</div>
	<?php endif; ?>
	
	
	<?php echo @$header; ?>
	<a name="ctab" id="ctab"></a>
	<ul id="profile-tab">
		<li id="activity" class="tab-item active"><a href="javascript:void(0);" onclick="tabToggle('activity');"><?php echo JText::_('CC ACTIVITY'); ?></a></li>
		<li id="wall" class="tab-item"><a href="javascript:void(0);" onclick="tabToggle('wall');"><?php echo JText::_('CC WALL'); ?></a></li>
		<li id="info" class="tab-item"><a href="javascript:void(0);" onclick="tabToggle('info');"><?php echo JText::_('CC INFO'); ?></a></li>
		<li id="friends" class="tab-item"><a href="javascript:void(0);" onclick="tabToggle('friends');"><?php echo JText::_('CC FRIENDS'); ?></a></li>
	</ul>
	<div class="clr">&nbsp;</div>

	<div id="section-activity" style="" class="section-item current">
		<?php echo $newsfeed; ?>
	</div>

	<div id="section-wall" style="display: none;" class="section-item">
		<?php echo $content; ?>
	</div>
	
	<div id="section-info" style="display: none;" class="section-item">
		<?php echo $about; ?>
	</div>
	
	<div id="section-friends" style="display: none;" class="section-item">
		<?php echo $friends; ?>
	</div>
	
</div>

<div class="clr">&nbsp;</div>