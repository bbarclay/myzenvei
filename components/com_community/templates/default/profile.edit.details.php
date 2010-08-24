<?php // no direct access
defined('_JEXEC') or die('Restricted access'); 

$validPassword = JText::sprintf( JText::_( 'VALID_AZ09', true ), JText::_( 'Password', true ), 4 );
 
?>
<script language="javascript" type="text/javascript">
jQuery.noConflict();

function submitbutton() {	
	var r = new RegExp("[\<|\>|\"|\'|\%|\;|\(|\)|\&|\+|\-]", "i");
	
	//hide all the error messsage span 1st
	jQuery('#name').removeClass('invalid');
	jQuery('#jspassword').removeClass('invalid');
	jQuery('#jspassword2').removeClass('invalid');
	jQuery('#jsemail').removeClass('invalid');
	
	jQuery('#errnamemsg').hide();
	jQuery('#errnamemsg').html('&nbsp');	

	jQuery('#errpasswordmsg').hide();
	jQuery('#errpasswordmsg').html('&nbsp');
	
	jQuery('#errjsemailmsg').hide();
	jQuery('#errjsemailmsg').html('&nbsp');
	
	jQuery('#password').val(jQuery('#jspassword').val());
	jQuery('#password2').val(jQuery('#jspassword2').val());
	
	// do field validation
	var isValid	= true;
	
	if (jQuery('#name').val() == "") {
		isValid = false;
		jQuery('#errnamemsg').html('<?php echo addslashes(JText::_( 'Please enter your name', true ));?>');
		jQuery('#errnamemsg').show();
		jQuery('#name').addClass('invalid');
	}
	
	if(jQuery('#jsemail').val() !=  jQuery('#email').val())
	{
		regex=/^[a-zA-Z0-9._-]+@([a-zA-Z0-9.-]+\.)+[a-zA-Z0-9.-]{2,4}$/;
	   	isValid = regex.test(jQuery('#jsemail').val());
	   	
		var fieldname = jQuery('#jsemail').attr('name');;			       
		if(isValid == false){
			cvalidate.setMessage(fieldname, '', 'CC INVALID EMAIL');
			jQuery('#jsemail').addClass('invalid');
		}	   	
   	}
	
	if(jQuery('#password').val().length > 0 || jQuery('#password2').val().length > 0) {
		//check the password only when the password is not empty!
		if(jQuery('#password').val().length < 6 ){
			isValid = false;
			jQuery('#jspassword').addClass('invalid');
			alert('<?php echo addslashes(JText::_( 'CC PASSWORD TOO SHORT' ));?>');		
		} else if (((jQuery('#password').val() != "") || (jQuery('#password2').val() != "")) && (jQuery('#password').val() != jQuery('#password2').val())){
			isValid = false;			
			jQuery('#jspassword').addClass('invalid');
			jQuery('#jspassword2').addClass('invalid');
			var err_msg = "<?php echo addslashes(JText::_( 'CC PASSWORD NOT SAME' )); ?>";
			alert(err_msg);
		} else if (r.exec(jQuery('#password').val())) {
			isValid = false;		
			jQuery('#errpasswordmsg').html('<?php echo $validPassword; ?>');
			jQuery('#errpasswordmsg').show();
			
			jQuery('#jspassword').addClass('invalid');
		}
	}
		
	if(isValid) {
		//replace the email value.
		jQuery('#email').val(jQuery('#jsemail').val());
		jQuery('#jomsForm').submit();
	}
}
</script>

<div id="profile-edit-details">
<div class="ctitle">
	<h2><?php echo JText::_('CC YOUR DETAILS');?></h2>
</div>

<form name="jomsForm" id="jomsForm" action="" method="POST">
<table class="formtable" cellspacing="1" cellpadding="0" style="width: 98%;">
<tbody>
	
	<!-- username -->
	<tr>
	    <td class="key"><label class="label" for="username"><?php echo JText::_( 'User Name' ); ?></label></td>
	    <td class="value">
			<div class="inputbox halfwidth"><?php echo $user->get('username'); ?></div>
	    </td>
	</tr>
	
	
	<!-- fullname -->
	<tr>
	    <td class="key"><label class="label" for="name"><?php echo JText::_( 'Your Name' ); ?></label></td>
	    <td class="value">
			<input class="inputbox halfwidth" type="text" id="name" name="name" value="<?php echo $user->get('name');?>" />
	    </td>
	</tr>
	
	
	<!-- email -->
	<tr>
	    <td class="key"><label class="label" for="jsemail"><?php echo JText::_( 'email' ); ?></label></td>
	    <td class="value">
			<input type="text" class="inputbox halfwidth" id="jsemail" name="jsemail" value="<?php echo $user->get('email'); ?>" />
			<input type="hidden" id="email" name="email" value="<?php echo $user->get('email'); ?>" />
		    <input type="hidden" id="emailpass" name="emailpass" id="emailpass" value="<?php echo $user->get('email'); ?>"/>
		    <span id="errjsemailmsg" style="display:none;">&nbsp;</span>
	    </td>
	</tr>
	
	<?php if ( !$associated ) : ?>
	<?php     if ( $user->get('password') ) : ?>
	<!-- password -->
	<tr>
	    <td class="key"><label class="label" for="jspassword"><?php echo JText::_( 'Password' ); ?></label></td>
	    <td class="value">
			<input id="jspassword" name="jspassword" class="inputbox halfwidth" type="password" value="" />
			<span id="errjspasswordmsg" style="display: none;"> </span>
	    </td>
	</tr>
	
	<!-- 2nd password -->
	<tr>
	    <td class="key"><label class="label" for="jspassword2"><?php echo JText::_( 'Verify Password' ); ?></label></td>
	    <td class="value">
			<input id="jspassword2" name="jspassword2" class="inputbox halfwidth" type="password" value="" />
			<span id="errjspassword2msg" style="display:none;"> </span>
			<div style="clear:both;"></div>
			<span id="errpasswordmsg" style="display:none;">&nbsp;</span>
	    </td>
	</tr>
			
	<?php     endif; ?>
	<?php endif; ?>

</tbody>
</table>



<?php if(isset($params)) :  echo $params->render( 'params' ); endif; ?>



<table class="formtable" cellspacing="1" cellpadding="0" style="width: 98%;">
<tbody>

	<!-- DST -->
	<tr>
	    <td class="key">
			<label class="jomTips label" title="<?php echo JText::_( 'CC DST TIME OFFSET' );?>::<?php echo JText::_('CC DAYLIGHT SAVING OFFSET TOOLTIP');?>" for="daylightsavingoffset">
				<?php echo JText::_( 'CC DAYLIGHT SAVING OFFSET' ); ?>
			</label>
		</td>
	    <td class="value">
			<?php echo $offsetList; ?>
	    </td>
	</tr>


	<!-- group buttons -->
	<tr>
		<td class="key"></td>
		<td class="value">			
			<input type="hidden" name="id" value="<?php echo $user->get('id');?>" />
			<input type="hidden" name="gid" value="<?php echo $user->get('gid');?>" />
			<input type="hidden" name="option" value="com_community" />
			<input type="hidden" name="view" value="profile" />
			<input type="hidden" name="task" value="save" />
			<input type="hidden" id="password" name="password" />
			<input type="hidden" id="password2" name="password2" />		
			<?php echo JHTML::_( 'form.token' ); ?>	
			<input type="submit" name="frmSubmit" onclick="submitbutton(); return false;" class="button" value="<?php echo JText::_('CC BUTTON SAVE'); ?>" />
		</td>
	</tr>
</table>


</form>

<?php
if( $config->get('fbconnectkey') && $config->get('fbconnectsecret') )
{
?>
	<div class="ctitle"><h2><?php echo JText::_('CC ASSOCIATE FACEBOOK LOGIN' );?></h2></div>
<?php
	if( $isAdmin )
	{
?>
	<div class="small facebook"><?php echo JText::_('CC ADMIN NOT ALLOWED TO ASSOCIATE FACEBOOK');?></div>
<?php
	}
	else
	{
?>
	<script type="text/javascript" src="http://static.ak.connect.facebook.com/js/api_lib/v0.4/FeatureLoader.js.php"></script>
	<script type="text/javascript">
		window.addEvent('load', function()
		{
			FB_RequireFeatures(["XFBML"], function() {
    			FB.Facebook.init( "<?php echo $config->get('fbconnectkey');?>" , "<?php echo CRoute::_('index.php?option=com_community&view=connect&task=receiver&tmpl=component');?>");
			});
		});
	</script>
<?php
		if( $associated )
		{
?>
	<div class="small facebook"><?php echo JText::_('CC ACCOUNT ALREADY MERGED');?></div>
	<!--
	<div>
		<input<?php echo $readPermission ? ' checked="checked" disabled="true"' : '';?> type="checkbox" id="facebookread" name="connectpermission" onclick="FB.Connect.showPermissionDialog('read_stream', function(x){if(!x){ jQuery('#facebookread').attr('checked',false);}}, true );">
		<label for="facebookread" style="display: inline;"><?php echo JText::_('Allow site to read updates from your Facebook account');?></label>
	</div>

	<div>
		<input<?php echo $writePermission ? ' checked="checked"' : '';?> type="checkbox" id="facebookpublish" name="connectpermission" onclick="FB.Connect.showPermissionDialog('publish_stream', function(x){if(!x){ jQuery('#facebookpublish').attr('checked',false);};}, true );">
		<label for="facebookpublish" style="display: inline;"><?php echo JText::_('Allow site to publish updates to your Facebook account. Allowing this, will post updates to your Facebook account whenever you change your status on the site.');?></label>
	</div>
	<div>
		<a href="<?php echo CRoute::_('index.php?option=com_community&view=connect&task=invite');?>"><?php echo JText::_('Invite friends from Facebook'); ?></a>
	</div>
	-->
<?php
		}
		else
		{
			echo $fbHtml;
		}
	}
}
?>
</div>
