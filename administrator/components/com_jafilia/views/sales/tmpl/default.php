<?php
defined( '_JEXEC' ) or die( '=;) linki ' );
?>
<div id="editcell">
<form action="index.php" method="post" name="adminForm">
	<table class="adminlist">
	<thead>
		<tr>
			<th width="5%">#</th>			
			<th class="title" width="15%"><?php echo JText::_('JAF_NAME'); ?>:</th>
			<th class="title" width="15%"><?php echo JText::_('JAF_VERSION'); ?>:</th>
			<th class="title" width="15%"><?php echo JText::_('JAF_ORDER'); ?>:</th>
			<th class="title" width="10%"><?php echo JText::_('JAF_AMOUNT'); ?>:</th>
			<th class="title" width="15%"><?php echo JText::_('JAF_STATUS'); ?>:</th>
			<th class="title" width="20%"><?php echo JText::_('JAF_DATE'); ?>:</th>
			<th class="title" width="20%"><?php echo JText::_('JAF_PAIDOFF'); ?>:</th>				
		</tr>
	</thead>	
		<?php
		$path = JPATH_COMPONENT.DS.'helpers'.DS.'jafilia.class.php';
		include($path);			
	   $k = 0;
	   for ($i=0, $n=count( $this->items ); $i < $n; $i++)
	   {
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
			</td>
			<td><?php
		
				$user = new cluserdata($row->uid);	
				$user->userdata($row->uid);
				$partner = $user->data; 
				$link3 = JRoute::_( 'index.php?option=com_jafilia&controller=user&task=userLeads&cid[]='. $row->uid );
				?>
				<a href="<?php echo $link3; ?>"><?php echo $partner[2] . " " . $partner[3]; ?></a>				
			</td>
			<td><?php echo $row->version; ?></td>
			<td><?php echo $row->order; ?></td>
			<td><?php echo $row->sale; ?></td>
			<td>
			<?php 	if($row->status == "open") $status = JText::_('JAF_OPEN'); 
					if($row->status == "canceled") $status = JText::_('JAF_CANCELED');
					if($row->status == "approved") $status = JText::_('JAF_APPROVED');
					echo $status;
			?>    
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
      <td colspan="8">
         <?php echo $this->pagination->getListFooter(); ?>
      </td>
    </tr>
  </tfoot>       
</table>

<input type="hidden" name="option" value="com_jafilia" />
<input type="hidden" name="task" value="" />
<input type="hidden" name="boxchecked" value="0" />
<input type="hidden" name="controller" value="sales" />
</form>
</div>
