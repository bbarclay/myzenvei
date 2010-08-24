<!--- NAME: payouts.tpl --->
<?php defined( '_JEXEC' ) or die( '=;)' ); ?>
<div id="jaf_mainpart">
<table width="95%" border="0" cellspacing="1" cellpadding="1">
  <tr>
    <th scope="col" align="left"><h3><?php echo JText::_('JAF_PAYOUTS'); ?></h3></th>
    <th colspan="3" scope="col" align="right"><?php echo $BOX; ?></th>
  </tr>
  <tr>
    <th scope="col" width="20px"><?php echo JText::_('JAF_ID'); ?></th>
    <th scope="col" align="left"><?php echo JText::_('JAF_DATE'); ?></th>
    <th scope="col"><?php echo JText::_('JAF_SALE'); ?></th>
    <th scope="col"><?php echo JText::_('JAF_PDF'); ?></th>
  </tr>
  <?php 
	foreach($rows as $row)  {
		$ID=$row->id;
		$AMOUNT=$row->amount . " " . $currency;
		$DATE=JHTML::_('date', $row->date, JText::_('DATE_FORMAT_LC1'));//mosFormatDate ($row->date, '%d.%m.%Y');
		//$LnkPDF=JPATH_ADMINISTRATOR.DS.'index.php?option=com_jafilia&controller=user&id='.$ID.'&format=pdf';		//admin
		$url = JUri::base(true);
		//$LnkPDF=$url.'/index.php?option=com_jafilia&view=jafilia&id='.$ID.'&format=pdf';
		//$LnkPDF=$url.'/index.php?option=com_jafilia&view=jafilia&id='.$ID.'&format=pdf';
		//index.php?option=com_jafilia&amp;task=insidemodal&amp;format=raw
		$LnkPDF=$url.'/index.php?option=com_jafilia&amp;task=generatepdf&amp;format=pdf&id='.$ID;
		//$LnkPDF=$url.'/administrator/index.php?option=com_jafilia&controller=user&id='.$ID.'&format=pdf';		//admin
		//$PDFimg=JPATH_SITE.DS.'images'.DS.'M_images'.DS.'pdf_button.png';
		$PDFimg='images/M_images/pdf_button.png';
  ?>		
  <tr>
    <td align="center"><?php echo $ID; ?></td>
    <td><?php echo $DATE; ?></td>
    <td align="center"><?php echo $AMOUNT; ?></td>
    <td align="center"><a href="<?php echo $LnkPDF; ?>" target="_blank"><img src="<?php echo $PDFimg; ?>" border="0"></a></td>
  </tr>		
  <?php 
	}
  ?>
</table>
<?php echo $PAGENAV; ?>
</div>

<!--- END: payouts.tpl --->
