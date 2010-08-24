<div id="profile-edit">
<form name="frmSaveProfile" id="frmSaveProfile" action="<?php echo CRoute::getURI(); ?>" method="POST" class="community-form-validate">
<?php

foreach ( $fields as $name => $fieldGroup )
{
		if ($name != 'ungrouped')
		{
?>
		
			<h2 class="app-box-title"><?php echo $name;?></h2>
 		
<?php
		}
?>
		<table class="ccontentTable paramlist" cellspacing="1" cellpadding="0">
		<tbody>
			<?php
				foreach ( $fieldGroup as $f )
				{
					$f = JArrayHelper::toObject ( $f );
			?>
					<tr>
	 					<td class="paramlist_key" valign="top" id="lblfield<?php echo $f->id;?>"><?php if($f->required == 1) echo '*'; ?><?php echo JText::_( $f->name );?></td>
	 					<td class="paramlist_value" valign="top"><?php echo CProfileLibrary::getFieldHTML( $f , '' ); ?></td>
	 				</tr>
	 		<?php
				}
			?>
		</tbody>
		</table>
<?php
}
?>
		<table class="ccontentTable paramlist" cellspacing="1" cellpadding="0">
		<tbody>
			<tr>
			    <td class="paramlist_key" valign="top"></td>
			    <td class="paramlist_value" valign="top">
					<input type="hidden" name="action" value="save" />
					<input class="validateSubmit" type="submit" value="<?php echo JText::_('CC BUTTON SAVE'); ?>" class="button" />
			    </td>
			</tr>
		</tbody>
		</table>
</form>
	<script type="text/javascript">
	    cvalidate.init();
	    cvalidate.setSystemText('REM','<?php echo addslashes(JText::_("CC REQUIRED ENTRY MISSING")); ?>');
	</script>
</div>