<?php
/**
 * @package		JomSocial
 * @subpackage 	Template 
 * @copyright (C) 2008 by Slashes & Dots Sdn Bhd - All rights reserved!
 * @license http://www.jomsocial.com Copyrighted Commercial Software
 * 
 */
defined('_JEXEC') or die();
?>

<div class="denied-box">
<h3 style="margin: 0;"><?php echo JText::_('CC MEMBER LOGIN');?></h3>
<?php echo JText::_('CC PERMISSION DENIED');?>
<div class="loginform" style="padding-top: 15px;">
	<form action="<?php echo CRoute::getURI();?>" method="post" name="login" id="form-login" >
	
		<label for="username" style="display:inline; float: left; width: 100px;"><?php echo JText::_('CC USERNAME'); ?></label>
		<input type="text" class="inputbox frontlogin" name="username" id="username" style="width: 200px; margin-bottom: 5px;" />
		
		<div style="clear: left;"></div>		

		<label for="passwd" style="display:inline; float: left; width: 100px;"><?php echo JText::_('CC PASSWORD'); ?></label>
		<input type="password" class="inputbox frontlogin" name="passwd" id="password" style="width: 200px; margin-bottom: 5px;" />

		<div style="clear: left;"></div>		

		<?php if(JPluginHelper::isEnabled('system', 'remember')) : ?>
		<label for="remember" style="padding: 4px 0 4px 100px;">
			<input type="checkbox" alt="<?php echo JText::_('CC REMEMBER MY DETAILS'); ?>" value="yes" id="remember" name="remember"/>
			<?php echo JText::_('CC REMEMBER MY DETAILS'); ?>
		</label>
		<?php endif; ?>

		<div style="padding: 4px 0 0 100px">
			<input type="submit" value="<?php echo JText::_('CC BUTTON LOGIN');?>" name="submit" id="submit" class="button" />
			<input type="hidden" name="option" value="com_user" />
			<input type="hidden" name="task" value="login" />
			<input type="hidden" name="return" value="<?php echo $return; ?>" />
			<?php echo JHTML::_( 'form.token' ); ?>
		</div>
		
		<div style="padding: 12px 0 0 100px">
			<a href="<?php echo CRoute::_( 'index.php?option=com_user&view=reset' ); ?>" class="login-forgot-password"><span><?php echo JText::_('CC FORGOT PASSWORD'); ?></span></a>
			<br/>
			<a href="<?php echo CRoute::_( 'index.php?option=com_user&view=remind' ); ?>" class="login-forgot-username"><span><?php echo JText::_('CC FORGOT USERNAME'); ?></span></a>
			<br/>
			<a href="<?php echo CRoute::_( 'index.php?option=com_community&view=register' ); ?>"><span><?php echo JText::_('CC CREATE ACCOUNT'); ?></span></a>
		</div>
	</form>
	<?php echo $fbHtml;?>
</div>
</div>