<?php
/**
 * @package		JomSocial
 * @subpackage 	Template 
 * @copyright (C) 2008 by Slashes & Dots Sdn Bhd - All rights reserved!
 * @license http://www.jomsocial.com Copyrighted Commercial Software
 **/
defined('_JEXEC') or die();
?>
<?php if( $isMine ): ?>
<script type="text/javascript" language="javascript">

jQuery(document).ready(function(){
	
	var profileStatus = jQuery('#profile-new-status');
	var statusText    = jQuery('#statustext');
	var saveStatus    = jQuery('#save-status');

	statusText.data('CC_PROFILE_STATUS_INSTRUCTION', '<?php echo addslashes(JText::_('CC PROFILE STATUS INSTRUCTION')); ?>')
	          .val(statusText.data('CC_PROFILE_STATUS_INSTRUCTION'));
	
	joms.utils.textAreaWidth(statusText);
	joms.utils.autogrow(statusText);

	statusText.focus(function()
	{
		if (profileStatus.hasClass('inactive'))
		{
			profileStatus.removeClass('inactive');
			statusText.val('');
		}
	}).blur(function()
	{
		if (statusText.val()=='')
		{
			setTimeout(function()
			{
				statusText.val(statusText.data('CC_PROFILE_STATUS_INSTRUCTION'));
				profileStatus.addClass('inactive');
			}, 200);
		}
	});

	saveStatus.click(function()
	{
		var newStatusText = statusText.val();
		jax.call('community', 'status,ajaxUpdate', statusText.val());
		
		/* Update page */
		jQuery('#profile-status-message').html(newStatusText);
		jQuery('title').val(newStatusText); // Note: This omits out the member name.

		statusText.val('').trigger('blur');
	});
});
</script>
<?php endif; ?>
	<?php echo $adminControlHTML; ?>
	
	<!-- begin: .profile-box -->
	<div class="profile-box">
		<div class="profile-avatar">
		    <?php if( $isMine ): ?><a href="<?php echo CRoute::_('index.php?option=com_community&view=profile&task=edit'); ?>"><?php endif; ?><img src="<?php echo $profile->largeAvatar; ?>" alt="<?php echo $user->getDisplayName(); ?>" /><?php if( $isMine ): ?></a><?php endif; ?>
		</div>

		<!-- Short Profile info -->
		<div class="profile-info">
			<div class="contentheading">
				<?php echo $user->getDisplayName(); ?>
			</div>

			<div id="profile-status">
				<span id="profile-status-message"><?php echo $profile->status; ?></span>
			</div>

			<ul class="profile-details">
				<?php if($config->get('enablekarma')){ ?>
				<li class="title"><?php echo JText::_('CC KARMA'); ?></li>
				<li><img src="<?php echo $karmaImgUrl; ?>" alt="" /></li>
				<?php } ?>
				
			    <li class="title"><?php echo JText::_('CC MEMBER SINCE'); ?></li>
			    <li><?php echo JHTML::_('date', $registerDate , JText::_('DATE_FORMAT_LC2')); ?></li>

			    <li class="title"><?php echo JText::_('CC LAST LOGIN'); ?></li>
			    <li><?php echo $lastLogin; ?></li>

			    <li class="title"><?php echo JText::_('CC PROFILE VIEW'); ?></li>
			    <li><?php echo JText::sprintf('CC PROFILE VIEW RESULT', $user->getViewCount() ) ;?></li>			    
			</ul>
		</div>
		
		<div style="clear: left;"></div>
	</div>
	<!-- end: .profile-box -->

	<div class="profile-toolbox-bl">
	    <div class="profile-toolbox-br">
	    	
			<!-- begin: .profile-toolbox-tl -->
	        <div class="profile-toolbox-tl">
	        
				<?php if( !$isMine ): ?>
				<ul class="small-button">
					<?php if(!$isFriend && !$isMine) { ?>
				    <li class="btn-add-friend">
						<a href="javascript:void(0)" onclick="joms.friends.connect('<?php echo $profile->id;?>')"><span><?php echo JText::_('CC ADD AS FRIEND'); ?></span></a>
					</li>
					<?php } ?>

					<?php if($config->get('enablephotos')): ?>
				    <li class="btn-gallery">
						<a href="<?php echo CRoute::_('index.php?option=com_community&view=photos&task=myphotos&userid='.$profile->id); ?>">
							<span><?php echo JText::_('CC PHOTO GALLERY'); ?></span>
						</a>
					</li>
					<?php endif; ?>
	
					<?php if($showBlogLink): ?>
				    <li class="btn-blog">
						<a href="<?php echo CRoute::_('index.php?option=com_myblog&blogger=' . $user->getDisplayName() . '&Itemid=' . $blogItemId ); ?>">
							<span><?php echo JText::_('CC BLOG'); ?></span>
						</a>
					</li>
					<?php endif; ?>
									
					<?php if($config->get('enablevideos')): ?>
				    <li class="btn-videos">
						<a href="<?php echo CRoute::_('index.php?option=com_community&view=videos&task=myvideos&userid='.$profile->id); ?>">
							<span><?php echo JText::_('CC VIDEOS GALLERY'); ?></span>
						</a>
					</li>
					<?php endif; ?>

					<?php if( !$isMine && $config->get('enablepm')): ?>
				    <li class="btn-write-message">
						<a onclick="<?php echo $sendMsg; ?>" href="javascript:void(0);">
							<span><?php echo JText::_('CC WRITE MESSAGE'); ?></span>
						</a>
					</li>
					<?php endif; ?>
				</ul>
				
    			<?php else : ?>

			    <!-- begin: #profile-new-status -->
				<div id="profile-new-status" class="inactive">
					<label for="statustext"><?php echo JText::_('CC MY STATUS'); ?></label>
					<textarea name="statustext" id="statustext" class="status" rows="" cols=""></textarea>
					<button id="save-status" class="button"><?php echo JText::_('Save'); ?></button>
				</div>
				<!-- end: #profile-new-status -->
		        
		        <!-- begin: #profile-header -->
                <div id="profile-header" class="js-box-grey">
					<ul class="actions">
						<li class="profile">
	                        <a href="<?php echo CRoute::_('index.php?option=com_community&view=profile&task=edit'); ?>">
	                            <span><?php echo JText::_('CC EDIT PROFILE'); ?></span>
	                        </a>
						</li>
						<li class="avatar">
	                        <a href="<?php echo CRoute::_('index.php?option=com_community&view=profile&task=uploadAvatar'); ?>">
	                            <span><?php echo JText::_('CC EDIT AVATAR'); ?></span>
	                        </a>
						</li>
						<li class="privacy">
	                        <a href="<?php echo CRoute::_('index.php?option=com_community&view=profile&task=privacy'); ?>">
	                            <span><?php echo JText::_('CC EDIT PRIVACY'); ?></span>
	                        </a>
						</li>
						<?php if($config->get('enablevideos')){ ?>
							<li class="video">
		                        <a href="javascript:void(0);" onclick="joms.videos.addVideo();">
		                            <span><?php echo JText::_('CC ADD VIDEO'); ?></span>
		                        </a>
							</li>
						<?php } ?>
					</ul>

					<ul class="actions">
						<li class="apps">
	                        <a href="<?php echo CRoute::_('index.php?option=com_community&view=apps&task=browse'); ?>">
	                            <span><?php echo JText::_('CC ADD APPLICATIONS'); ?></span>
	                        </a>
						</li>
						<li class="group">
	                        <a href="<?php echo CRoute::_('index.php?option=com_community&view=groups&task=create'); ?>">
	                            <span><?php echo JText::_('CC ADD GROUP'); ?></span>
	                        </a>
						</li>
						<li class="invite">
	                        <a href="<?php echo CRoute::_('index.php?option=com_community&view=friends&task=invite'); ?>">
	                            <span><?php echo JText::_('CC INVITE FRIENDS'); ?></span>
	                        </a>
						</li>
					</ul>

	                <ul class="actions">
	                	<?php if( $config->get('enablepm')){ ?>
						<li class="write">
	                        <a href="<?php echo CRoute::_('index.php?option=com_community&view=inbox&task=write'); ?>">
	                            <span><?php echo JText::_('CC WRITE MESSAGE'); ?></span>
	                        </a>
						</li>
						<li class="inbox">
	                        <a href="<?php echo CRoute::_('index.php?option=com_community&view=inbox'); ?>">
	                            <span><?php echo JText::_('CC VIEW YOUR INBOX'); ?></span>
	                        </a>
						</li>
						<?php } ?>
						<?php if($config->get('enablephotos')){ ?>
							<li class="photo">
		                        <a href="<?php echo CRoute::_('index.php?option=com_community&view=photos&task=uploader&userid='.$profile->id); ?>">
		                            <span><?php echo JText::_('CC UPLOAD PHOTOS'); ?></span>
		                        </a>
							</li>
						<?php } ?>
					</ul>

					<div style="clear: left; margin-bottom: 10px;"></div>
				</div>
				<!-- end: #profile-header -->
				<?php endif; ?>

				</div>
				<!-- end: .profile-toolbox-tl -->
	
			</div>
		</div>
      