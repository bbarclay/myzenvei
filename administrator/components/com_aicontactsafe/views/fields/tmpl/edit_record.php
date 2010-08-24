<?php
/**
 * @version     $Id$ 2.0.10 b
 * @package     Joomla
 * @copyright   Copyright (C) 2005 - 2008 Open Source Matters. All rights reserved.
 * @license     GNU/GPL, see LICENSE.php
 *
 * added/fixed in version 2.0.1
 * - added new field types Checkbox - List, Radio - List, Date, Emails, Contacts
 * added/fixed in version 2.0.10.b
 * - replaced sufix with prefix as it is the correct order
 *
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

?>

<?php 
	// header of the adminForm
	// don't remove this line
	echo $this->getTmplHeader();
?>

<fieldset class="adminform">
	<legend><?php echo JText::_( 'Field' ); ?></legend>
	<table id="type">
		<tr>
			<td class="key">
				<?php echo JText::_( 'Field name' ); ?>:
			</td>
			<td class="space">&nbsp;</td>
			<td class="value">
				<input class="textbox" type="text" name="name" id="name" value="<?php echo $this->name;?>" />&nbsp;&nbsp;&nbsp;<font color="#FF0000"><?php echo JText::_( 'Use only latin characters here and no spaces !' ); ?></font>
			</td>
		</tr>
		<tr>
			<td class="key">
				<?php echo JText::_( 'Field label' ); ?>:
			</td>
			<td class="space">&nbsp;</td>
			<td class="value">
				<input class="textbox" type="text" name="field_label" id="field_label" value="<?php echo $this->field_label;?>" onchange="copyLabel()" />
			</td>
		</tr>
		<tr>
			<td class="key">
				<?php echo JText::_( 'Label parameters' ); ?>:
			</td>
			<td class="space">&nbsp;</td>
			<td class="value">
				<input class="textbox" type="text" name="label_parameters" id="label_parameters" value="<?php echo $this->label_parameters;?>" onchange="copyParameters()" />
			</td>
		</tr>
		<tr>
			<td class="key">
				<?php echo JText::_( 'Field label in message' ); ?>:
			</td>
			<td class="space">&nbsp;</td>
			<td class="value">
				<input class="textbox" type="text" name="field_label_message" id="field_label_message" value="<?php echo $this->field_label_message;?>" />
			</td>
		</tr>
		<tr>
			<td class="key">
				<?php echo JText::_( 'Label in message parameters' ); ?>:
			</td>
			<td class="space">&nbsp;</td>
			<td class="value">
				<input class="textbox" type="text" name="label_message_parameters" id="label_message_parameters" value="<?php echo $this->label_message_parameters;?>" />
			</td>
		</tr>
		<tr>
			<td class="key">
				<?php echo JText::_( 'Label after field' ); ?>:
			</td>
			<td class="space">&nbsp;</td>
			<td class="value">
				<input class="checkbox" type="checkbox" name="label_after_field" id="label_after_field" value="1" <?php echo ($this->label_after_field)?'checked':'' ?> />
			</td>
		</tr>
		<tr>
			<td class="key">
				<?php echo JText::_( 'Field type' ); ?>:
			</td>
			<td class="space">&nbsp;</td>
			<td class="value">
				<?php echo $this->comboField_type; ?>
			</td>
		</tr>
		<tr>
			<td class="key">
				<?php echo JText::_( 'Send message' ); ?>:
			</td>
			<td class="space">&nbsp;</td>
			<td class="value">
				<input class="checkbox" type="checkbox" name="send_message" id="send_message" value="1" <?php echo ($this->send_message)?'checked':'' ?> />
			</td>
		</tr>
		<tr>
			<td class="key">
				<?php echo JText::_( 'Field values' ); ?>:
			</td>
			<td class="space">&nbsp;</td>
			<td class="value">
				<textarea class="textbox" name="field_values" id="field_values" cols="50" rows="3" ><?php echo $this->field_values;?></textarea>
			</td>
		</tr>
		<tr>
			<td class="key">
				<?php echo JText::_( 'Field limit' ); ?>:
			</td>
			<td class="space">&nbsp;</td>
			<td class="value">
				<input class="textbox" type="text" name="field_limit" id="field_limit" value="<?php echo $this->field_limit;?>" />
			</td>
		</tr>
		<tr>
			<td class="key">
				<?php echo JText::_( 'Field parameters' ); ?>:
			</td>
			<td class="space">&nbsp;</td>
			<td class="value">
				<input class="textbox" type="text" name="field_parameters" id="field_parameters" value="<?php echo $this->field_parameters;?>" />
			</td>
		</tr>
		<tr>
			<td class="key">
				<?php echo JText::_( 'Auto fill' ); ?>:
			</td>
			<td class="space">&nbsp;</td>
			<td class="value">
				<?php echo $this->comboAutoFill; ?>
			</td>
		</tr>
		<tr>
			<td class="key">
				<?php echo JText::_( 'Default value' ); ?>:
			</td>
			<td class="space">&nbsp;</td>
			<td class="value">
				<input class="textbox" type="text" name="default_value" id="default_value" value="<?php echo $this->default_value;?>" />
			</td>
		</tr>
		<tr>
			<td class="key">
				<?php echo JText::_( 'Field prefix' ); ?>:
			</td>
			<td class="space">&nbsp;</td>
			<td class="value">
				<input class="textbox" type="text" name="field_prefix" id="field_prefix" value="<?php echo $this->field_prefix;?>" />
			</td>
		</tr>
		<tr>
			<td class="key">
				<?php echo JText::_( 'Field sufix' ); ?>:
			</td>
			<td class="space">&nbsp;</td>
			<td class="value">
				<input class="textbox" type="text" name="field_sufix" id="field_sufix" value="<?php echo $this->field_sufix;?>" />
			</td>
		</tr>
		<tr>
			<td class="key">
				<?php echo JText::_( 'Field required' ); ?>:
			</td>
			<td class="space">&nbsp;</td>
			<td class="value">
				<input class="checkbox" type="checkbox" name="field_required" id="field_required" value="1" <?php echo ($this->field_required)?'checked':'' ?> />
			</td>
		</tr>
		<tr>
			<td class="key">
				<?php echo JText::_( 'Add in message' ); ?>:
			</td>
			<td class="space">&nbsp;</td>
			<td class="value">
				<input class="checkbox" type="checkbox" name="field_in_message" id="field_in_message" value="1" <?php echo ($this->field_in_message)?'checked':'' ?> />
			</td>
		</tr>
		<tr>
			<td class="key">
				<?php echo JText::_( 'Published' ); ?>:
			</td>
			<td class="space">&nbsp;</td>
			<td class="value">
				<input class="checkbox" type="checkbox" name="published" id="published" value="1" <?php echo ($this->published)?'checked':'' ?> />
			</td>
		</tr>
	</table>
</fieldset>
	
<?php 
	// footer of the adminForm
	// don't remove this line
	echo $this->getTmplFooter();
?>
<script type="text/javascript" language="javascript">
	checkFieldValues();
</script>

