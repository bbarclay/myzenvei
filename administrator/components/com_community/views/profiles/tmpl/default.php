<?php
// Disallow direct access to this file
defined('_JEXEC') or die('Restricted access');
?>
<script type="text/javascript" language="javascript">
/**
 * This function needs to be here because, Joomla toolbar calls it
 **/ 
function submitbutton( action )
{
	switch( action )
	{
		case 'newgroup':
			azcommunity.newFieldGroup();
			break;
		case 'newfield':
			azcommunity.newField( false );
			break;
		case 'removefield':
			if( !confirm( '<?php echo JText::_('CC ARE YOU SURE YOU WANT TO DELETE THIS FIELD'); ?>' ) )
			{
				break;
			}
		case 'publish':
		case 'unpublish':
		default:
			submitform( action );
	}
}
</script>
<form action="<?php echo JURI::base();?>index.php?option=com_community" method="post" name="adminForm">
<table class="adminlist" cellspacing="1">
	<thead>
		<tr class="title">
			<th width="1%">
				<?php echo JText::_('CC NUM'); ?>
			</th>
			<th width="1%">
				<input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count( $this->fields ); ?>);" />
			</th>
			<th>
				<?php echo JText::_('CC NAME'); ?>
			</th>
			<th width="10%">
				<?php echo JText::_('CC FIELD CODE'); ?>
			</th>
			<th align="center" width="10%">
				<?php echo JText::_('CC TYPE'); ?>
			</th>
			<th width="1%">
				<?php echo JText::_('CC PUBLISHED'); ?>
			</th>
			<th width="1%">
				<?php echo JText::_('CC VISIBLE'); ?>
			</th>
			<th width="1%">
				<?php echo JText::_('CC REQUIRED'); ?>
			</th>
			<th width="1%">
				<?php echo JText::_('CC REGISTRATION'); ?>
			</th>			
			<th width="5%" align="center">
				<?php echo JText::_('CC ORDERING'); ?>
			</th>
		</tr>		
	</thead>
<?php
	$count	= 0;
	$i		= 0;
			
	foreach($this->fields as $field)
	{
		$input	= JHTML::_('grid.id', $count, $field->id);
		
		if($field->type == 'group')
		{
?>
		<tr>
			<td  style="background-color: #EEEEEE;">&nbsp;</td>
			<td  style="background-color: #EEEEEE;">
				<?php echo $input; ?>
			</td>
			<td colspan="3" style="background-color: #EEEEEE;">
				<strong><?php echo JText::_('CC GROUP');?>
					<span id="name<?php echo $field->id; ?>">
						<?php echo JHTML::_('link', 'javascript:void(0);', $field->name, array('onclick'=>'azcommunity.editFieldGroup(\'' . $field->id . '\', \'' . JText::_('CC EDIT GROUP') . '\');')); ?>
					</span>
				</strong>
				<div style="clear: both;"></div>
			</td>
			<td align="center" id="published<?php echo $field->id;?>" style="background-color: #EEEEEE;">
				<?php echo $this->getPublish($field, 'published', 'profiles,ajaxGroupTogglePublish'); ?>
			</td>
			<td align="center" id="visible<?php echo $field->id;?>" style="background-color: #EEEEEE;">
				<?php echo $this->getPublish($field, 'visible', 'profiles,ajaxGroupTogglePublish'); ?>
			</td>
			<td align="center" id="required<?php echo $field->id;?>" style="background-color: #EEEEEE;">
				<?php echo $this->getPublish($field, 'required', 'profiles,ajaxGroupTogglePublish'); ?>
			</td>
			<td align="center" id="registration<?php echo $field->id;?>" style="background-color: #EEEEEE;">
				<?php echo $this->getPublish($field, 'registration', 'profiles,ajaxGroupTogglePublish'); ?>
			</td>			
			<td align="right" style="background-color: #EEEEEE;">
				<?php echo $this->pagination->orderUpIcon( $count, true, 'orderup', 'Move Up'); ?>
				<?php echo $this->pagination->orderDownIcon( $count, count($this->fields) , true , 'orderdown', 'Move Down', true ); ?>
			</td>
		</tr>
<?php
			$i	= 0;	// Reset count
		}
		else if($field->type != 'group')
		{

			// Process publish / unpublish images
			++$i;
?>
		<tr class="row<?php echo $i%2;?>" id="rowid<?php echo $field->id;?>">
			<td><?php echo $i;?></td>
			<td>
				<?php echo $input; ?>
			</td>
			<td>
				<span class="editlinktip hasTip" title="<?php echo $field->name; ?>::Tips: <?php echo $field->tips; ?>" id="name<?php echo $field->id;?>">
					<?php echo JHTML::_('link', 'javascript:void(0);', $field->name, array('onclick'=>'azcommunity.editField(\'' . $field->id . '\',\'' . JText::_('CC EDIT PROFILE') . '\');')); ?>
				</span>
			</td>
			<td align="center">
				<?php echo $field->fieldcode; ?>
			</td>
			<td align="center">
				<span id="type<?php echo $field->id;?>" onclick="$('typeOption').style.display = 'block';$(this).style.display = 'none';">
				<?php echo $this->getFieldText( $field->type ); ?>
				</span>
			</td>
			<td align="center" id="published<?php echo $field->id;?>">
				<?php echo $this->getPublish($field, 'published' , 'profiles,ajaxTogglePublish'); ?>
			</td>
			<td align="center" id="visible<?php echo $field->id;?>">
				<?php echo $this->getPublish($field, 'visible', 'profiles,ajaxTogglePublish'); ?>
			</td>
			<td align="center" id="required<?php echo $field->id;?>">
				<?php echo $this->getPublish($field, 'required', 'profiles,ajaxTogglePublish'); ?>
			</td>
			<td align="center" id="registration<?php echo $field->id;?>">
				<?php echo $this->getPublish($field, 'registration', 'profiles,ajaxTogglePublish'); ?>
			</td>			
			<td align="right">
				<span><?php echo $this->pagination->orderUpIcon( $count , true, 'orderup', 'Move Up'); ?></span>
				<span><?php echo $this->pagination->orderDownIcon( $count , count($this->fields), true , 'orderdown', 'Move Down', true ); ?></span>
			</td>
		</tr>
<?php
		}
		$count++;
	}
?>
	<tfoot>
	<tr>
		<td colspan="15">
			<?php echo $this->pagination->getListFooter(); ?>
		</td>
	</tr>
	</tfoot>
</table>
<input type="hidden" name="view" value="profiles" />
<input type="hidden" name="task" value="display" />
<input type="hidden" name="option" value="com_community" />
<input type="hidden" name="boxchecked" value="0" />
</form>