<?php
/**
 * @package		JomSocial
 * @subpackage 	Template 
 * @copyright (C) 2008 by Slashes & Dots Sdn Bhd - All rights reserved!
 * @license http://www.jomsocial.com Copyrighted Commercial Software
 * 
 * @param	friends		array or CUser (all user)
 * @param	total		integer total number of friends  
 */
defined('_JEXEC') or die();

$jnow		= cGetDate();
?>

<div id="writeMessageContainer">
	<form method="post" action="" name="writeMessageForm" id="writeMessageForm">
		<table class="cWindowForm">
			<tr>
				<td class="cWindowFormKey"><label class="label"><?php echo JText::_('CC COMPOSE TO'); ?></td>
				<td class="cWindowFormVal">
				    <table cellpadding="0" cellspacing="0" border="0" width="100%" class="receiverContainer">
						<tr>
						    <td style="padding: 0; width: 40px;">
						    	<div>
									<img src="<?php echo $user->getThumbAvatar(); ?>" height="30" style="border: solid 1px #999;" alt="<?php echo $user->getDisplayName(); ?>" />
								</div>
							</td>
						    <td style="padding: 0;">
								<strong><?php echo $user->getDisplayName(); ?></strong><br />
						        <span class="small"><?php echo $jnow->toFormat('%d %B %Y  %I:%M %p');?></span>
						    </td>
						</tr>
				    </table>				
				</td>
			</tr>
			<tr>	
				<td class="cWindowFormKey"><label for="subject" class="label"><?php echo JText::_('CC COMPOSE SUBJECT'); ?></label></td>
				<td class="cWindowFormVal"><input class="inputbox" type="text" value="<?php echo (empty($subject))?'':$subject; ?>" id="subject" name="subject" /></td>
			</tr>
			<tr>	
				<td class="cWindowFormKey"><label for="body" class="label"><?php echo JText::_('CC COMPOSE MESSAGE'); ?></label></td>
				<td class="cWindowFormVal"><textarea class="inputbox" style="height: 80px;" id="body" name="body"><?php echo (empty($body))?'':$body;; ?></textarea></td>
			</tr>
			<tr class="hidden">	
				<td class="cWindowFormKey"></td>
				<td class="cWindowFormVal">
					<input type="hidden" value="<?php echo $user->id; ?>" name="to" />
				</td>
			</tr>
		</table>

	</form>
</div>