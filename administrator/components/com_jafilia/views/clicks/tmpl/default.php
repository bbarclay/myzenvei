<?php
defined( '_JEXEC' ) or die( '=;) linki ' );
?>
<div id="editcell">
<form action="index.php" method="post" name="adminForm">
	<table class="adminlist">
	<thead>
		<tr>
			<th width="10%">#</th>
			<th class="title" width="40%"><?php echo JText::_('JAF_REFERER'); ?>:</th>
			<th class="title" width="20%"><?php echo JText::_('JAF_IP'); ?>:</th>
			<th class="title" width="20%"><?php echo JText::_('JAF_DATE'); ?>:</th>
		</tr>
	</thead>	
<?php
	$k = 0;
	for ($i=0, $n=count( $this->items ); $i < $n; $i++) {
		$row = &$this->items[$i];
?>
		<tr class="<?php echo "row$k"; ?>">
			<td align="center">
				<?php echo $row->id; ?>
			</td>
			<td><a href="<?php echo $row->referer; ?>" target="_blank"><?php echo $row->referer; ?></a></td>
			<td><?php echo $row->ip; ?></td>
			<td><?php 
				echo JHTML::_('date', $row->date, JText::_('DATE_FORMAT_LC1'));
			?></td>
		</tr>
<?php
		$k = 1 - $k;
	}
?>
    <tfoot>
    <tr>
      <td colspan="4">
         <?php echo $this->pagination->getListFooter(); ?>
      </td>
    </tr>
  </tfoot>       
</table>

<input type="hidden" name="option" value="com_jafilia" />
<input type="hidden" name="task" value="" />
<input type="hidden" name="boxchecked" value="0" />
<input type="hidden" name="controller" value="clicks" />
</form>
</div>
