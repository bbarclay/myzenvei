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
<div class="greybox">	
			<table cellpadding="0" cellspacing="0" border="0" width="100%">
			    <tr>
			        <td valign="top" width="70%">
                    <div style="margin:0px; padding:0px; height: 295px;">
								<?php $this->renderModules( 'js_fpslide' ); ?></div>
			        </td>
			        <td width="30%">
						<div style="position:relative;width:100%" class="loginform">
						<div class="app-box-header">
						<div class="app-box-header">
							<h2 class="app-box-title"><?php echo JText::_('CC MEMBER LOGIN'); ?></h2>
						</div>
						</div>
							<div class="app-box-content">					   
					    	<form action="<?php echo CRoute::getURI();?>" method="post" name="login" id="form-login" >
					        
					            <label>
									<?php echo JText::_('CC USERNAME'); ?><br />
					                <input type="text" class="inputbox frontlogin" name="username" id="username" />
					            </label>

					            <label>
									<?php echo JText::_('CC PASSWORD'); ?><br />
					                <input type="password" class="inputbox frontlogin" name="passwd" id="password" />
					            </label>

                                <?php if(JPluginHelper::isEnabled('system', 'remember')) : ?>
								<label for="remember">
									<input type="checkbox" alt="<?php echo JText::_('CC REMEMBER MY DETAILS'); ?>" value="yes" id="remember" name="remember"/>
									<?php echo JText::_('CC REMEMBER MY DETAILS'); ?>
								</label>
								<?php endif; ?>

								<div style="text-align: center; padding: 10px 0 5px;">
								    <input type="submit" value="<?php echo JText::_('CC BUTTON LOGIN');?>" name="submit" id="submit" class="button" />
									<input type="hidden" name="option" value="com_user" />
									<input type="hidden" name="task" value="login" />
									<input type="hidden" name="return" value="<?php echo $return; ?>" />
									<?php echo JHTML::_( 'form.token' ); ?>
								</div>
								
								<span>
									<?php echo JText::_('CC FORGOT YOUR'); ?> <a href="<?php echo CRoute::_( 'index.php?option=com_user&view=reset' ); ?>" class="login-forgot-password"><span><?php echo JText::_('CC PASSWORD'); ?></span></a> /
									<a href="<?php echo CRoute::_( 'index.php?option=com_user&view=remind' ); ?>" class="login-forgot-username"><span><?php echo JText::_('CC USERNAME'); ?></span></a>?
								</span>
								<br />									
								<a href="<?php echo CRoute::_( 'index.php?option=com_community&view=register&task=activation' ); ?>" class="login-forgot-username">
									<span><?php echo JText::_('CC RESEND ACTIVATION CODE'); ?></span>
								</a>
					        </form>
					        <?php echo $fbHtml;?>					    
						</div>
						<div class="app-box-footer"><div class="app-box-footer"></div></div></div>
			        </td>
			    </tr>
			</table>	
</div>