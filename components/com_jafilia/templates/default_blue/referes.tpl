<!--- NAME: referes.tpl --->
<?php defined( '_JEXEC' ) or die( '=;)' ); ?>
<div id="jaf_mainpart">
<table width="95%" border="0" cellspacing="1" cellpadding="1">
  <tr>
    <th scope="col" align="left"><h3><?php echo JText::_('JAF_REFERER'); ?></h3></th>
    <th colspan="2" scope="col" align="right"><?php echo $BOX; ?></th>
  </tr>
  <tr>
    <th width="20%"><?php echo JText::_('JAF_DATE'); ?></th>
    <th width="70%"><?php echo JText::_('JAF_REF_LINK'); ?></th>
    <th width="10%"><?php echo JText::_('JAF_TIME'); ?></th>
  </tr>
  <?php 
  foreach($rows as $row)  {
	$DATE=JHTML::_('date', $row->date, JText::_('DATE_FORMAT_LC1'));//mosFormatDate ($row->date, '%d.%m.%Y');
	$REF=$row->referer;
	$TIME=JHTML::_('date', $row->date, '%H:%M:%S');//mosFormatDate ($row->date, );  
  ?>
  <tr>
    <td width="15%" align="center"><?php echo $DATE; ?></td>
    <td width="70%"><a href="<?php echo $REF; ?>" target="_blank" ><?php echo $REF; ?></a></td>
    <td width="15%"><?php echo $TIME; ?></td>
  </tr>
  <?php   
  }
  ?>
</table>
  <?php echo $PAGENAV; ?>
</div>
<!--- END: referes.tpl --->
