<?php
/**
 * @version     $Id$ 2.0.0 0
 * @package     Joomla
 * @copyright   Copyright (C) 2005 - 2008 Open Source Matters. All rights reserved.
 * @license     GNU/GPL, see LICENSE.php
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

?>

<?php 
	// header of the adminForm
	// don't remove this line
	echo $this->getTmplHeader();
?>

<table>
	<tr><td width="100%"><h3><?php echo JText::_( 'Fields' ); ?></h3></td></tr>
	<tr><td>
		<input type="text" name="filter_string" id="filter_string" value="<?php echo $this->filter_string;?>" class="text_area" onchange="document.adminForm.submit();" title="<?php echo JText::_( 'Filter by name' );?>"/>
		<button onclick="this.form.submit();"><?php echo JText::_( 'Go' ); ?></button>
		<button onclick="document.getElementById('filter_string').value='';document.getElementById('filter_order').value='';document.getElementById('filter_order_Dir').value='';this.form.submit();"><?php echo JText::_( 'Reset' ); ?></button>
	</td></tr>
</table>

<table class="adminlist" cellspacing="1">
<thead>
	<tr>
		<th width="1">
			<input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count($this->rows); ?>);" />
		</th>
		<th class="title">
			<?php echo JHTML::_('grid.sort', JText::_( 'Name' ), 'name', @$this->filter_order_Dir, @$this->filter_order ); ?>
		</th>
		<th>
			<?php echo JHTML::_('grid.sort', JText::_( 'Field label' ), 'field_label', @$this->filter_order_Dir, @$this->filter_order ); ?>
		</th>
		<th width="50" nowrap="nowrap">
			<?php echo JHTML::_('grid.sort', JText::_( 'To right' ), 'label_after_field', @$this->filter_order_Dir, @$this->filter_order ); ?>
		</th>
		<th width="120" nowrap="nowrap">
			<?php echo JHTML::_('grid.sort', JText::_( 'Field type' ), 'field_type', @$this->filter_order_Dir, @$this->filter_order ); ?>
		</th>
		<th width="60" nowrap="nowrap">
			<?php echo JHTML::_('grid.sort', JText::_( 'Field required' ), 'field_required', @$this->filter_order_Dir, @$this->filter_order ); ?>
		</th>
		<th width="80" nowrap="nowrap">
			<?php echo JHTML::_('grid.sort', JText::_( 'Published' ), 'published', @$this->filter_order_Dir, @$this->filter_order ); ?>
		</th>
		<th width="60" class="title">
			<?php echo JHTML::_('grid.sort', JText::_( 'ID' ), 'id', @$this->filter_order_Dir, @$this->filter_order ); ?>
		</th>
		<th align="center" width="80">
			<?php echo JHTML::_('grid.sort', JText::_( 'Date added' ), 'date_added', @$this->filter_order_Dir, @$this->filter_order ); ?>
		</th>
		<th align="center" width="80">
			<?php echo JHTML::_('grid.sort', JText::_( 'Last update' ), 'last_update', @$this->filter_order_Dir, @$this->filter_order ); ?>
		</th>
	</tr>
</thead>
<tfoot>
	<tr>
		<td colspan="10">
			<?php echo $this->pageNav->getListFooter(); ?>
		</td>
	</tr>
</tfoot>
<tbody>
	<?php
	if (count($this->rows) == 0) {
	?>
		<tr><td colspan="10" id="no_record">
			<?php echo JText::_( 'No record found !' ); ?>
		</td></tr>
	<?php
	} else {
		$k = 0;
		$i = 0;
		$n = count($this->rows);
		
		foreach($this->rows as $row) {
			$checked = JHTML::_('grid.id', $i, $row->id, false, 'cid');
			if ($row->published) {
				$img = JURI::root().'administrator/components/com_aicontactsafe/images/ok.gif';
				$alt = JText::_( 'Published' );
			} else {
				$img = JURI::root().'administrator/components/com_aicontactsafe/images/not_ok.gif';
				$alt = JText::_( 'Unpublished' );
			}
			if ($row->field_required) {
				$img_required = JURI::root().'administrator/components/com_aicontactsafe/images/required.gif';
				$alt_required = JText::_( 'Required' );
			} else {
				$img_required = JURI::root().'administrator/components/com_aicontactsafe/images/blank.gif';
				$alt_required = '';
			}
			if ($row->label_after_field) {
				$img_to_right = JURI::root().'administrator/components/com_aicontactsafe/images/ok.gif';
				$alt_to_right = JText::_( 'To right' );
			} else {
				$img_to_right = JURI::root().'administrator/components/com_aicontactsafe/images/blank.gif';
				$alt_to_right = '';
			}
			?>
			<tr class="row<?php echo $k; ?>">
				<td width="1" align="center"><?php echo $checked; ?></td>
				<td><a href="<?php echo $row->edit; ?>" class="aicontactsafe_edit"><?php echo $row->name; ?></a></td>
				<td align="left"><?php echo $row->field_label; ?></td>
				<td align="center"><img src="<?php echo $img_to_right;?>" width="16" height="16" border="0" alt="<?php echo $alt_to_right; ?>" /></td>
				<td align="left"><?php echo $row->field_type_text; ?></td>
				<td align="center"><img src="<?php echo $img_required;?>" width="16" height="16" border="0" alt="<?php echo $alt_required; ?>" /></td>
				<td align="center">
					<span class="editlinktip hasTip" title="<?php echo JText::_( 'Publish Information' );?>">
						<a href="javascript:void(0);" onclick="return listItemTask('cb<?php echo $i;?>','<?php echo $row->published ? 'unpublish' : 'publish' ?>')">
							<img src="<?php echo $img;?>" width="16" height="16" border="0" alt="<?php echo $alt; ?>" />
						</a>
					</span>
				</td>
				<td align="center"><?php echo $row->id; ?></td>
				<td nowrap="nowrap" align="center">
					<?php echo JHTML::_('date',  $row->date_added, $this->_config_values['date_format'] ); ?>
				</td>
				<td nowrap="nowrap" align="center">
					<?php echo JHTML::_('date',  $row->last_update, $this->_config_values['date_format'] ); ?>
				</td>
			</tr>
			<?php
			$k = 1 - $k;
			$i += 1;
		}
	}
	?>
</tbody>
</table>

<?php 
	// footer of the adminForm
	// don't remove this line
	echo $this->getTmplFooter();
?>
