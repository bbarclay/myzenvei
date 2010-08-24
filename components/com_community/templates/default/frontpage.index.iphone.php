<?php
/**
 * @package		JomSocial
 * @subpackage 	Template 
 * @copyright (C) 2008 by Slashes & Dots Sdn Bhd - All rights reserved!
 * @license http://www.jomsocial.com Copyrighted Commercial Software
 * 
 */
defined('_JEXEC') or die();

$uri	= CRoute::_('index.php?option=com_community&view=profile' , false );
$return	= base64_encode($uri);
?>


<?php if ( $my->id > 0 ) : ?>
<div class="frontpage">
	<div style="position: relative;">
	    <div id="latest-members-container">
	        <ul class="application-group-avatars" id="membersBox">
	            <?php foreach ( $rows as $row ) : ?>
	            <li style="">
	                <a href="<?php echo CRoute::_('index.php?option=com_community&view=profile&userid='.$row->id ); ?>">
						<img class="avatar" src="<?php echo $row->smallAvatar; ?>" width="45" height="45" alt="" />
					</a>
	            </li>
	            <?php endforeach; ?>
	        </ul>
	        <div class="app-box-footer no-border">
                <a href="<?php echo CRoute::_('index.php?option=com_community&view=search&task=browse'); ?>">
					<?php echo JText::sprintf('CC BROWSE ALL' , $totalMembers );?>
				</a>
            </div>
	    </div>
	</div>
	
	<?php if( $config->get('showactivitystream') == '1' || ($config->get('showactivitystream') == '2' && $my->id != 0 ) ) { ?>
	<div style="position: relative;">
	    <div id="activity-stream-container">
	        <?php echo $userActivities; ?>
	    </div>
	</div>
	<?php } ?>
</div>

<?php else: ?>
<script type="text/javascript">
function clearInputs()
{
	jQuery('#username').val('');
	jQuery('#password').val('');
	jQuery('#username').focus();
}
window.scrollTo(0, 1);
</script>
<div id="sitelogo">
	<a class="logo" href="<?php echo CRoute::_('index.php?option=com_community'); ?>" title="<?php echo $config->getValue('sitename'); ?>">
		<span><?php echo $config->getValue('sitename'); ?></span>
	</a>
</div>
<div class="loginform">
	<form action="<?php echo CRoute::getURI();?>" method="post" name="login" id="form-login">
        <label>
			<?php echo JText::_('CC USERNAME'); ?><br />
            <input type="text" class="inputbox frontlogin" name="username" id="username" />
        </label>

        <label>
			<?php echo JText::_('CC PASSWORD'); ?><br />
            <input type="password" class="inputbox frontlogin" name="passwd" id="password" />
        </label>
		
		<!--
        <?php if(JPluginHelper::isEnabled('system', 'remember')) : ?>
		<label for="remember">
			<input type="checkbox" alt="<?php echo JText::_('CC REMEMBER MY DETAILS'); ?>" value="yes" id="remember" name="remember"/>
			<?php echo JText::_('CC REMEMBER MY DETAILS'); ?>
		</label>
		<?php endif; ?>
		-->

		<div style="text-align: center; padding: 10px 0 5px;">
		    <input type="submit" value="<?php echo JText::_('CC IPHONE BUTTON LOGIN');?>" name="submit" id="submit" class="button" />
		    <input type="button" value="<?php echo JText::_('CC IPHONE BUTTON CLEAR');?>" name="clear" id="clear" class="button" onclick="clearInputs();return false;" />
			<input type="hidden" name="option" value="com_user" />
			<input type="hidden" name="task" value="login" />
			<input type="hidden" name="return" value="<?php echo $return; ?>" />
			<?php echo JHTML::_( 'form.token' ); ?>
		</div>
		
		<!--
		<a href="<?php echo CRoute::_( 'index.php?option=com_user&view=reset' ); ?>" class="login-forgot-password">
			<span><?php echo JText::_('CC FORGOT PASSWORD'); ?></span>
		</a><br />
		<a href="<?php echo CRoute::_( 'index.php?option=com_user&view=remind' ); ?>" class="login-forgot-username">
			<span><?php echo JText::_('CC FORGOT USERNAME'); ?></span>
		</a>
		-->
    </form>
	<?php echo $fbHtml;?>
</div>	
<?php endif; ?>
