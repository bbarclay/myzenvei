<?php
// Disallow direct access to this file
defined('_JEXEC') or die('Restricted access');

jimport('joomla.html.pane');

$pane	=& JPane::getInstance('Tabs');
?>
<script type="text/javascript" language="javascript">
/**
 * This function needs to be here because, Joomla calls it
 **/
function submitbutton( action )
{
	if( action == 'removeavatar' )
	{
		jax.call('community' , 'admin,users,ajaxRemoveAvatar' , '<?php echo $this->user->id;?>');
	}
	else
	{
		var form = document.adminForm;
		
		if( action == 'cancel')
		{
			submitform( action );
			return;
		}
		
		var r = new RegExp("[\<|\>|\"|\'|\%|\;|\(|\)|\&]", "i");
	
		// do field validation
		if (trim(form.name.value) == "")
		{
			alert( "<?php echo JText::_('CC YOU MUST PROVIDE A NAME'); ?>" );
		}
		else if (form.username.value == "") 
		{
			alert( "<?php echo JText::_('CC YOU MUST PROVIDE A USER LOGIN NAME'); ?>" );
		}
		else if (r.exec(form.username.value) || form.username.value.length < 2)
		{
			alert( "<?php echo JText::_('CC WARNLOGININVALID'); ?>" );
		}
		else if (trim(form.email.value) == "")
		{
			alert( "<?php echo JText::_('CC YOU MUST PROVIDE AN EMAIL ADDRESS'); ?>" );
		}
		else if (((trim(form.password.value) != "") || (trim(form.password2.value) != "")) && (form.password.value != form.password2.value))
		{
			alert( "<?php echo JText::_('CC PASSWORD DO NOT MATCH'); ?>" );
		}
		else
		{
			submitform( action );
		}
	}
}
</script>
<form name="adminForm" id="adminForm" action="index.php?option=com_community" method="POST">
<?php
echo $pane->startPane( 'profile-fields' );
echo $pane->startPanel( JText::_('CC ACCOUNT DETAILS') , 'details-page' );
?>
<table  width="100%" class="paramlist admintable" cellspacing="1">
	<tr>
		<td class="paramlist_key">
			<label for="username"><?php echo JText::_('CC PROFILE PICTURE'); ?></label>
		</td>
		<td class="paramlist_value">
			<img id="user-avatar" src="<?php echo $this->user->getThumbAvatar();?>" style="border: 1px solid #eee;" alt="<?php echo $this->user->getDisplayName();?>" />
			<div id="user-avatar-message"></div>
		</td>
	</tr>
	<tr>
		<td class="paramlist_key"><?php echo JText::_('CC USER STATUS');?></td>
		<td class="paramlist_value"><input type="text" name="status" size="80" value="<?php echo $this->user->getStatus();?>" /></td>
	</tr>
	<tr>
		<td class="paramlist_key">
			<label for="username"><?php echo JText::_('CC USER NAME'); ?></label>
		</td>
		<td class="paramlist_value">
			<input type="text" name="username" value="<?php echo $this->user->get('username');?>" />
		</td>
	</tr>
	<tr>
		<td class="paramlist_key">
			<label id="jsemailmsg"><?php echo JText::_('CC EMAIL'); ?></label>
		</td>
		<td class="paramlist_value">
			<input type="text" class="inputbox" id="email" name="email" value="<?php echo $this->user->get('email');?>" size="80" />
		</td>
	</tr>
	<tr>
		<td class="paramlist_key">
			<label for="name"><?php echo JText::_('CC NAME'); ?></label>
		</td>
		<td class="paramlist_value">
			<input class="inputbox" type="text" id="name" name="name" value="<?php echo $this->user->get('name');?>" size="80" />
			<div style="clear:both;"></div>
			<span id="errnamemsg" style="display:none;">&nbsp;</span>
		</td>
	</tr>
	<tr>
		<td class="paramlist_key">
			<label for="jspassword">
				<?php echo JText::_('CC PASSWORD'); ?>
			</label>
		</td>
		<td class="paramlist_value">
			<input id="password" name="password" class="inputbox" type="password" value="" size="80"/>
			<span id="errjspasswordmsg" style="display: none;"> </span>
		</td>
	</tr>
	<tr>
		<td class="paramlist_key">
			<label for="jspassword2">
				<?php echo JText::_('CC VERIFY PASSWORD'); ?>
			</label>
		</td>
		<td class="paramlist_value">
			<input id="password2" class="inputbox" type="password" value="" size="80" name="password2"/>
			<span id="errjspassword2msg" style="display:none;"> </span>
			<div style="clear:both;"></div>
			<span id="errpasswordmsg" style="display:none;">&nbsp;</span>
		</td>
	</tr>
	<tr>
		<td class="paramlist_key">
			<?php echo JText::_('CC USER POINTS'); ?>
		</td>
		<td class="paramlist_value">
			<input id="userpoint" name="userpoint" class="inputbox" type="text" value="<?php echo $this->user->getKarmaPoint();?>" size="8" style="text-align: center;"/>
		</td>
	</tr>
	<tr>
		<td class="paramlist_key">
			<?php echo JText::_('CC BLOCK USER'); ?>
		</td>
		<td class="paramlist_value">
			<?php echo JHTML::_('select.booleanlist',  'block', 'class="inputbox" size="1"', $this->user->get('block') ); ?>
		</td>
	</tr>
	<tr>
		<td class="paramlist_key">
			<?php echo JText::_('CC RECEIVE SYSTEM EMAILS'); ?>
		</td>
		<td>
			<?php echo JHTML::_('select.booleanlist',  'sendEmail', 'class="inputbox" size="1"', $this->user->get('sendEmail') ); ?>
		</td>
	</tr>
	<tr>
		<td class="key">
			<?php echo JText::_('CC REGISTERED DATE'); ?>
		</td>
		<td>
			<?php echo JHTML::_('date', $this->user->get('registerDate'), '%Y-%m-%d %H:%M:%S');?>
		</td>
	</tr>
	<tr>
		<td class="key">
			<?php echo JText::_('CC LAST VISIT DATE'); ?>
		</td>
		<td>
			<?php echo ($this->user->get('lastvisitDate') == "0000-00-00 00:00:00") ? JText::_('CC NEVER') : JHTML::_('date', $this->user->get('lastvisitDate'), '%Y-%m-%d %H:%M:%S'); ?>
		</td>
	</tr>
	<tr>
		<td class="paramlist_key">
			<label class="hasTip" title="<?php echo JText::_( 'CC DST TIME OFFSET' );?>::<?php echo JText::_('CC DAYLIGHT SAVING OFFSET TOOLTIP');?>" for="daylightsavingoffset">
				<?php echo JText::_( 'CC DAYLIGHT SAVING OFFSET' ); ?>
			</label>
		</td>
		<td class="paramlist_value">
			<?php echo $this->offsetList; ?>
		</td>
	</tr>
</table>
<?php if(isset($this->params)) :  echo $this->params->render( 'params' ); endif; ?>
<?php
echo $pane->endPanel();

// Create tabs
foreach( $this->user->profile->fields as $group => $groupFields )
{
	echo $pane->startPanel( $group , $group . '-page' );
?>
	<table class="paramlist admintable" cellspacing="1" style="width: 100%;">
	<tbody>
<?php
	foreach( $groupFields as $field )
	{
		$field	= JArrayHelper::toObject ( $field );
?>
		<tr>
			<td class="paramlist_key" id="lblfield<?php echo $field->id;?>"><?php if($field->required == 1) echo '*'; ?><?php echo JText::_( $field->name );?></td>
			<td class="paramlist_value"><?php echo CProfileLibrary::getFieldHTML( $field , '' ); ?></td>
		</tr>
<?php
	}
?>
	</tbody>
	</table>
<?php
	echo $pane->endPanel();

}
echo $pane->endPane();
?>
<input type="hidden" name="view" value="users" />
<input type="hidden" name="task" value="save" />
<input type="hidden" name="userid" value="<?php echo $this->user->id; ?>" />
<input type="hidden" name="option" value="com_community" />
<input type="hidden" name="boxchecked" value="0" />
<?php echo JHTML::_( 'form.token' ); ?>	
</form>