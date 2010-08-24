<?php
defined( '_JEXEC' ) or die( 'Direct Access to this location is not allowed.' );

	$path = JPATH_COMPONENT.DS.'helpers'.DS.'jafilia.class.php';
	include($path);
	drawGraphClickSaleBE();
	drawGraphFeesBE();
	JHTML::_('behavior.tooltip');	
?>
<form action="index.php" method="post" name="adminForm" id="adminForm">
	<table class="adminlist">
		<tr>
			<th> 
				<?php echo JText::_('JAF_CHARTS'); ?>
			</th>
		</tr>
		<tr>
			<td align="center"><img src="../components/com_jafilia/images/csBE.png" /></td>
		</tr>
		<tr>
			<td align="center"><img src="../components/com_jafilia/images/feesBE.png" /></td>
		</tr>
		<input type="hidden" name="option" value="com_jafilia" />
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="controller" value="" />			
	</table>
</form>