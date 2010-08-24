<?php
/**
 * @package		JomSocial
 * @subpackage 	Template 
 * @copyright (C) 2008 by Slashes & Dots Sdn Bhd - All rights reserved!
 * @license http://www.azrul.com Copyrighted Commercial Software
 * 
 * @params	categories Array	An array of categories
 */
defined('_JEXEC') or die();
?>
<form method="post" action="<?php echo CRoute::getURI(); ?>" id="createGroup" name="createGroup" class="community-form-validate">
<div id="community-groups-wrap">

	<table class="formtable" cellspacing="1" cellpadding="0">
	<!-- group name -->
	<tr>
		<td class="key">
			<label for="name" class="label title hasTip" title="<?php echo JText::_('CC GROUP NAME');?>::<?php echo JText::_('CC GROUP NAME TIPS'); ?>">
				*<?php echo JText::_('CC GROUP NAME'); ?>
			</label>
		</td>
		<td class="value">
			<input name="name" id="name" type="text" size="45" class="required inputbox" value="<?php echo $group->name; ?>" />
		</td>
	</tr>
	<!-- group description -->
	<tr>
		<td class="key">
			<label for="description" class="label title hasTip" title="<?php echo JText::_('CC GROUP DESCRIPTION');?>::<?php echo JText::_('CC GROUP DESCRIPTION TIPS');?>">
				*<?php echo JText::_('CC GROUP DESCRIPTION');?>
			</label>
		</td>
		<td class="value">
			<textarea name="description" id="description" class="required inputbox"><?php echo $group->description; ?></textarea>
		</td>
	</tr>
	<!-- group category -->
	<tr>
		<td class="key">
			<label for="categoryid" class="label title hasTip" title="<?php echo JText::_('CC GROUP CATEGORY');?>::<?php echo JText::_('CC GROUP CATEGORY TIPS');?>">
				*<?php echo JText::_('CC GROUP CATEGORY');?>
			</label>
		</td>
		<td class="value">
			<select name="categoryid" id="categoryid" class="required inputbox">
			<?php
			foreach( $categories as $category )
			{
				$selected	= ( $group->categoryid == $category->id ) ? ' selected="selected"' : '';
			?>
				<option value="<?php echo $category->id; ?>"<?php echo $selected;?>><?php echo JText::_( $category->name ); ?></option>
			<?php
			}
			?>
			</select>
		</td>
	</tr>
	<!-- group type -->
	<tr>
		<td class="key">
			<label class="label title hasTip" title="<?php echo JText::_('CC GROUP REQUIRE APPROVAL');?>::<?php echo JText::_('CC GROUP REQUIRE APPROVAL TIPS');?>">
				<?php echo JText::_('CC GROUP TYPE'); ?>
			</label>
		</td>
		<td class="value">
			<div>
				<input type="radio" name="approvals" id="approve-open" value="0"<?php echo ($group->approvals == COMMUNITY_PUBLIC_GROUP ) ? ' checked="checked"' : '';?> />
				<label for="approve-open" class="label lblradio"><?php echo JText::_('CC OPEN GROUP');?></label>
			</div>
			<div style="margin-bottom: 10px;" class="small">
				<?php echo JText::_('CC OPEN GROUP DESCRIPTION');?>
			</div>
			
			<div>
				<input type="radio" name="approvals" id="approve-private" value="1"<?php echo ($group->approvals == COMMUNITY_PRIVATE_GROUP ) ? ' checked="checked"' : '';?> />
				<label for="approve-private" class="label lblradio"><?php echo JText::_('CC PRIVATE GROUP');?></label>
			</div>
			<div class="small">
				<?php echo JText::_('CC PRIVATE GROUP DESCRIPTION');?>
			</div>
		</td>
	</tr>
	<!-- group photos -->
	<tr>
		<td class="key">
			<label class="label title hasTip" title="<?php echo JText::_('CC PHOTOS');?>::<?php echo JText::_('CC GROUP PHOTOS PERMISSION TIPS');?>">
				<?php echo JText::_('CC PHOTOS'); ?>
			</label>
		</td>
		<td class="value">
			<div>
				<input type="radio" name="photopermission" id="photopermission-members" value="0"<?php echo ($params->get('photopermission') == GROUP_PHOTO_PERMISSION_MEMBERS ) ? ' checked="checked"' : '';?> />
				<label for="photopermission-members" class="label lblradio"><?php echo JText::_('CC GROUP PHOTO ALLOW MEMBERS UPLOAD');?></label>
			</div>
			<div>
				<input type="radio" name="photopermission" id="photopermission-admin" value="1"<?php echo ($params->get('photopermission') == GROUP_PHOTO_PERMISSION_ADMINS ) ? ' checked="checked"' : '';?> />
				<label for="photopermission-admin" class="label lblradio"><?php echo JText::_('CC GROUP PHOTO ALLOW ONLY ADMINS UPLOAD');?></label>
			</div>		
		</td>
	</tr>
	
	
	<!-- group videos -->
	<tr>
		<td class="key">
			<label for="discussordering" class="label title hasTip" title="<?php echo JText::_('CC VIDEOS');?>::<?php echo JText::_('CC GROUP VIDEOS PERMISSION TIPS');?>">
				<?php echo JText::_('CC VIDEOS'); ?>
			</label>
		</td>
		<td class="value">
		
			<div>
				<input type="radio" name="videopermission" id="videopermission-members" value="0"<?php echo ($params->get('videopermission') == GROUP_VIDEO_PERMISSION_MEMBERS ) ? ' checked="checked"' : '';?> />
				<label for="videopermission-members" class="label lblradio"><?php echo JText::_('CC GROUP VIDEO ALLOW MEMBERS UPLOAD');?></label>
			</div>
			<div>
				<input type="radio" name="videopermission" id="videopermission-admin" value="1"<?php echo ($params->get('videopermission') == GROUP_VIDEO_PERMISSION_ADMINS ) ? ' checked="checked"' : '';?> />
				<label for="videopermission-admin" class="label lblradio"><?php echo JText::_('CC GROUP VIDEO ALLOW ONLY ADMINS UPLOAD');?>
			</div>		

		</td>
	</tr>
	
	
	<!-- group hint -->
	<tr>
		<td class="key"></td>
		<td class="value"><span class="hints"><?php echo JText::_( 'CC_REG_REQUIRED_FILEDS' ); ?></span></td>
	</tr>
	
	
	<!-- group buttons -->
	<tr>
		<td class="key"></td>
		<td class="value">
			<input type="hidden" name="groupid" value="<?php echo $group->id;?>" />
			<input type="submit" value="<?php echo JText::_('CC BUTTON SAVE');?>" class="button validateSubmit" />
			<input type="button" class="button" onclick="history.go(-1);return false;" value="<?php echo JText::_('CC BUTTON CANCEL');?>" />
		</td>
	</tr>
	</table>

</div>

</form>
<script type="text/javascript">
	cvalidate.init();
	cvalidate.setSystemText('REM','<?php echo addslashes(JText::_("CC REQUIRED ENTRY MISSING")); ?>');
</script>