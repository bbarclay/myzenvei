<?php
defined( '_JEXEC' ) or die( '=;) linki ' );
?>
<div id="editcell">
	<table class="adminlist">
	<thead>
		<tr>
			<th width="10%">#</th>
			<th class="title" width="15%"><?php echo JText::_('JAF_VERSION'); ?>:</th>
			<th class="title" width="15%"><?php echo JText::_('JAF_ORDER'); ?>:</th>
			<th class="title" width="10%"><?php echo JText::_('JAF_AMOUNT'); ?>:</th>
			<th class="title" width="15%"><?php echo JText::_('JAF_STATUS'); ?>:</th>
			<th class="title" width="20%"><?php echo JText::_('JAF_DATE'); ?>:</th>
			<th class="title" width="20%"><?php echo JText::_('JAF_PAIDOFF'); ?>:</th>
		</tr>
	</thead>	
<?php
	$k = 0;
	for ($i=0, $n=count( $this->items ); $i < $n; $i++) {
		$row = &$this->items[$i];
		if($row->paid == "1") {
			$img = 'tick.png';
		} else {
			$img = 'publish_x.png';
		}		
?>
		<tr class="<?php echo "row$k"; ?>">
			<td align="center">
				<?php echo $row->id; ?>
		<script type="text/javascript" language="javascript">
		
		function changeStatus(f)  {
			var id = f.id.value;
			var uid = <?php echo $row->uid; ?>;
			var index = f.status.selectedIndex;
			var stat = f.status.options[index].value;

			location.href='index.php?option=com_jafilia&controller=user&task=changestatus&status=' + stat + '&id=' + id + '&uid=' + uid;
		}
		
		</script>
			</td>
			<td><?php echo $row->version; ?></td>
			<td><?php echo $row->order; ?></td>
			<td><?php echo $row->sale; ?></td>			
			<td>
                <form  method="post" name="adminForm<?php echo $i; ?>" id="adminForm" class="adminForm">
				<select name="status" onChange="changeStatus(document.adminForm<?php echo $i; ?>);">
                    <option value="approved" <?php if($row->status == "approved") echo "selected='selected'"; ?>><?php echo JText::_('JAF_APPROVED'); ?></option>
                    <option value="open" <?php if($row->status == "open") echo "selected='selected'"; ?>><?php echo JText::_('JAF_OPEN'); ?></option>
                    <option value="canceled" <?php if($row->status == "canceled") echo "selected='selected'"; ?>><?php echo JText::_('JAF_CANCELED'); ?></option>
                </select>
                <input type="hidden" name="id" value="<?php echo $row->id; ?>" />
                </form> 			
			</td>
			<td><?php 
				echo JHTML::_('date', $row->date, JText::_('DATE_FORMAT_LC1'));
			?></td>
			<td><img src="images/<?php echo $img;?>" width="12" height="12" border="0" /></td>
			
			
		</tr>
<?php
		$k = 1 - $k;
	}
?>
    <tfoot>
    <tr>
      <td colspan="7">
         <?php echo $this->pagination->getListFooter(); ?>
      </td>
    </tr>
  </tfoot>       
</table>


</div>
