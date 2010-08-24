<!--- NAME: leads.tpl --->
<?php defined( '_JEXEC' ) or die( '=;)' ); ?>
<div id="jaf_mainpart">
<table width="95%" border="0" cellspacing="1" cellpadding="1">
  <tr>
    <th scope="col" colspan="3" align="left"><h3><?php echo JText::_('JAF_AMOUNTS'); ?></h3></th>
    <th scope="col" colspan="2" align="right"><?php echo $BOX; ?></th>
  </tr>
  <tr>
    <th scope="col"><?php echo JText::_('JAF_DATE'); ?></th>
    <th scope="col"><?php echo JText::_('JAF_VERSION'); ?></th>
    <th scope="col"><?php echo JText::_('JAF_ORDER'); ?></th>
    <th scope="col"><?php echo JText::_('JAF_SALE'); ?></th>
    <th scope="col"><?php echo JText::_('JAF_STATUS'); ?></th>
  </tr>
<?php 
//echo $ROWS; 
	foreach($rows as $row)  {

		if($row->status == "approved") $status = JText::_('JAF_APPROVED');
		if($row->status == "open") $status = JText::_('JAF_OPEN');
		if($row->status == "canceled") $status = JText::_('JAF_CANCELED');
				
		$DATE=JHTML::_('date', $row->date, JText::_('DATE_FORMAT_LC1'));//mosFormatDate ($row->date, '%d.%m.%Y');
		$VERSION=$row->version;
		$ORDER=$row->order;
		$SALE=$row->sale . " " . $currency;
		$STATUS=$status;
?>
  <tr>
    <td align="center"><?php echo $DATE; ?></td>
    <td align="center"><?php echo $VERSION; ?></td>
    <td align="center"><?php echo $ORDER; ?></td>
    <td align="center"><?php echo $SALE; ?></td>
    <td align="center"><?php echo $STATUS; ?></td>
  </tr>
<?php  		
	}
?>
</table>
<?php echo $PAGENAV; ?>
</div>

<!--- END: leads.tpl --->
