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
	<p>
		<?php echo JText::_('CC CREATE GROUP DESCRIPTION'); ?> 
	</p>

	<div class="items">
		<span class="title hasTip" title="<?php echo JText::_('CC GROUP NAME');?>::<?php echo JText::_('CC GROUP NAME TIPS'); ?>">
			<?php echo JText::_('CC GROUP NAME'); ?> *
		</span>
		<span style="vertical-align:top;">:</span>
		<span>
			<input name="name" id="name" type="text" size="45" class="required inputbox" value="<?php echo $name; ?>" />
		</span>
	</div>

	<div class="items">
		<span class="title hasTip" title="<?php echo JText::_('CC GROUP DESCRIPTION');?>::<?php echo JText::_('CC GROUP DESCRIPTION TIPS');?>">
			<?php echo JText::_('CC GROUP DESCRIPTION');?> *
		</span>
		<span style="vertical-align:top;">:</span>
		<span>
			<textarea name="description" id="description" class="required inputbox" value="<?php echo $description; ?>"></textarea>
		</span>
	</div>
	
	<div class="items">
		<span class="title hasTip" title="<?php echo JText::_('CC GROUP CATEGORY');?>::<?php echo JText::_('CC GROUP CATEGORY TIPS');?>">
			<?php echo JText::_('CC GROUP CATEGORY');?> *
		</span>
		<span style="vertical-align:top;">:</span>
		<span>
			<select name="categoryid" id="categoryid" class="required inputbox">
			<?php
			foreach( $categories as $category )
			{
			?>
				<option value="<?php echo $category->id; ?>"><?php echo $category->name; ?></option>
			<?php
			}
			?>
			</select>
		</span>
	</div>
	<div class="items">
		<span class="title hasTip" title="<?php echo JText::_('CC GROUP REQUIRE APPROVAL');?>::<?php echo JText::_('CC GROUP REQUIRE APPROVAL TIPS');?>">
			<?php echo JText::_('CC GROUP TYPE'); ?>
		</span>
		<span style="float: left;vertical-align:top;">:</span>
		<span style="float: left;padding-left: 20px; width: 60%;">
			<div>
				<input type="radio" name="approvals" value="0"  checked="checked" />
				<?php echo JText::_('CC OPEN GROUP');?>
			</div>
			<div style="margin-bottom: 10px;" class="small">
				<?php echo JText::_('CC OPEN GROUP DESCRIPTION');?>
			</div>
			<div>
				<input type="radio" name="approvals" value="1" />
				<?php echo JText::_('CC PRIVATE GROUP');?>
			</div>
			<div class="small">
				<?php echo JText::_('CC PRIVATE GROUP DESCRIPTION');?>
			</div>
		</span>
	</div>
	<div class="clr"></div>
	<div class="items">
		<span>
			<?php echo JText::_( 'CC_REG_REQUIRED_FILEDS' ); ?>
		</span>
	</div>
	<div class="submit">
		<input type="submit" value="<?php echo JText::_('CC BUTTON CREATE GROUP');?>" class="button validateSubmit" />
		<button class="button" onclick="history.go(-1);return false;"><?php echo JText::_('CC BUTTON CANCEL');?></button>
	</div>
</div>
<input name="action" type="hidden" value="save" />
</form>
<script type="text/javascript">
	cvalidate.init();
</script>