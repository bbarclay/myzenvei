<?php
defined( '_JEXEC' ) or die( 'Direct Access to this location is not allowed.' );
?>
<form action="index.php" method="post" name="adminForm" id="adminForm">
	<table class="adminlist">
		<tbody>
			<tr><td colspan="2"><?php echo JText::_('JAF_HELP'); ?></td></tr>
			<tr><th>Support Forum:</th><td><?php echo JHTML::_('link', 'http://www.jafilia.com/index.php/forum', 'Jafilia Support Forum', 'target="_blank"'); ?></td></tr>
			<tr><th>Homepage:</th><td><?php echo JHTML::_('link', 'http://www.jafilia.com/', 'Jafilia Homepage', 'target="_blank"'); ?></td></tr>
			<tr><th>Needed Hacks:</th>
				<td>
					<?php include( JPATH_COMPONENT.DS."helpers".DS."hackinfo.php" ); ?>
				</td>
			</tr>
		</tbody>	
	</table>
	<input type="hidden" name="option" value="com_jafilia" />
	<input type="hidden" name="task" value="" />
	<input type="hidden" name="controller" value="" />	
</form>	