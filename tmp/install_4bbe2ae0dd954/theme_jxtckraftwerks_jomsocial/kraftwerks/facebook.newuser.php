<?php
defined('_JEXEC') or die();
?>
<a href="<?php echo $user['profile_url'];?>" target="_blank"><img src="<?php echo $user['pic_square'];?>" border="0" style="border: 1px solid #000; float: left; margin: 5px;line-height:0;" /></a>
<p><?php echo JText::sprintf('CC FACEBOOK CONNECT DESCRIPTION', $user['name'] );?></p>
<div style="margin-top: 5px; padding: 10px 0px">
<table width="100%" cellpadding="5" cellspacing="0">
	<tr>
		<td width="50%" valign="top">
			<h2><?php echo JText::_('CC EXISTING SITE MEMBER');?></h2>
			<div style="margin-bottom: 5px;height: 90px;">
				<?php echo JText::_('CC EXISTING SITE MEMBER DESCRIPTION');?>
			</div>
			<form name="loginForm">
				<label for="existingusername"><?php echo JText::_('CC USERNAME');?></label>
				<input type="text" id="existingusername" class="inputbox" size="30" />
				<label for="existingpassword"><?php echo JText::_('CC PASSWORD');?></label>
				<input type="password" id="existingpassword" class="inputbox" size="30" />
				<div style="margin-top: 10px;text-align:center;"><input type="button" onclick="joms.connect.validateUser();return false;" class="button" value="<?php echo JText::_('CC LOGIN');?>" /></div>
			</form>
		</td>
		<td valign="top" style="border-left: 1px solid #DDDDDD;">
			<h2><?php echo JText::_('CC NEW MEMBER');?></h2>
			<div style="margin-bottom: 5px;height: 90px;"><?php echo JText::_('CC NEW MEMBER DESCRIPTION');?></div>
			<form name="newloginForm">
				<label for="newname"><?php echo JText::_('CC NAME');?></label>
				<input type="text" id="newname" class="inputbox" size="30" value="<?php echo $user['name'];?>" onblur="jax.call('community','connect,ajaxCheckName', this.value);"/><div id="error-newname" class="small" style="display: none;color: red;"></div>
				<label for="newusername"><?php echo JText::_('CC USERNAME');?></label>
				<input type="text" id="newusername" class="inputbox required" size="30" onblur="jax.call('community','connect,ajaxCheckUsername', this.value);"/><div id="error-newusername" class="small" style="display: none;color: red;"></div>
				<label for="newemail"><?php echo JText::_('CC EMAIL');?></label>
				<input type="text" id="newemail" class="inputbox required" size="30" onblur="jax.call('community','connect,ajaxCheckEmail', this.value);" /><div id="error-newemail" class="small" style="display: none;color: red;"></div>
				<div style="margin-top: 10px;text-align:center;"><input type="button" class="button" onclick="joms.connect.validateNewAccount();return false;" value="<?php echo JText::_('CC CREATE');?>" /></div>
			</form>
		</td>
	</tr>
	<tr>
		<td colspan="2"><span style="color: red;"><?php echo JText::_('CC LINKING NOTICE');?></span></td>
	</tr>
</table>
</div>