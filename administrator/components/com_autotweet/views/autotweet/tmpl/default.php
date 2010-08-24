<?php defined('_JEXEC') or die('Restricted access'); ?>
<form id="adminForm" action="<?php echo JRoute::_( 'index.php' );?>" method="post" name="adminForm">
	<table>
		<tr>
			<td align="left" width="100%">
			</td>
			<td nowrap="nowrap">
				<?php echo $this->lists['state']; ?>
			</td>
		<tr>
	</table>
	<table class="adminlist">
	<thead>
		<tr>
			<th width="5">
				<?php echo JText::_( 'ID' ); ?>
			</th>
			<th width="20">
				<input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count( $this->items ); ?>);" />
			</th>			
			<th  width="60">
				<?php echo JHTML::_( 'grid.sort', 'Date posted', 'postdate', $this->lists['order_Dir'], $this->lists['order']); ?>
			</th>
			<th  width="60">
				<?php echo JHTML::_( 'grid.sort', 'Publish date', 'publish_up', $this->lists['order_Dir'], $this->lists['order']); ?>
			</th>
			<th>
				<?php echo JText::_( 'Message' ); ?>
			</th>
			<th>
				<?php echo JText::_( 'URL' ); ?>
			</th>
			<th  width="50">
				<?php echo JHTML::_( 'grid.sort', 'Article ID', 'articleid', $this->lists['order_Dir'], $this->lists['order']); ?>
			</th>
			<th  width="50">
				<?php echo JText::_( 'Attempts' ); ?>
			</th>
			<th  width="50">
				<?php echo JHTML::_( 'grid.sort', 'Published', 'published', $this->lists['order_Dir'], $this->lists['order']); ?>
			</th>
			<th  width="50">
				<?php echo JHTML::_( 'grid.sort', 'State', 'pubstate', $this->lists['order_Dir'], $this->lists['order']); ?>
			</th>
			<th  width="80">
				<?php echo JText::_( 'Result' ); ?>
			</th>
			<th  width="80">
				<?php echo JText::_( 'Source' ); ?>
			</th>
		</tr>
	</thead>
	<tfoot>
		<tr>
			<td colspan="12"><?php echo $this->pagination->getListFooter() . '<p>' . JText::_('Message entrys: ' . $this->pagination->total) . '</p>'; ?></td>
		</tr>
	</tfoot>
	<?php
	$k = 0;
	for ($i=0, $n=count( $this->items ); $i < $n; $i++)	{
		$row = &$this->items[$i];
		$checked 	= JHTML::_('grid.id',   $i, $row->id );
		$published	= JHTML::_('grid.published', $row, $i);

		$postdate =& JFactory::getDate($row->postdate);
		$postdate->setOffset(JFactory::getConfig()->getValue('config.offset'));
		$postdate = $postdate->toFormat();
		$publish_up =& JFactory::getDate($row->publish_up);
		$publish_up->setOffset(JFactory::getConfig()->getValue('config.offset'));
		$publish_up = $publish_up->toFormat();
		
		switch ($row->pubstate) {
			case 'success':
				$pubstate_color = '#00FF00';
				break;
			case 'pending':
				$pubstate_color = '#FFFF00';
				break;
			case 'error':
				$pubstate_color = '#FF0000';
				break;
			default:
				$pubstate_color = '#00FF00';
		}
							
	?>
		<tr class="<?php echo "row$k"; ?>">
			<td align="right">
				<?php echo $row->id; ?>
			</td>
			<td>
				<?php echo $checked; ?>
			</td>
			<td>
				<?php echo $postdate; ?>
			</td>
			<td>
				<?php echo $publish_up; ?>
			</td>
			<td>
				<?php echo $row->message; ?>
			</td>
			<td>
				<?php echo $row->url; ?>
			</td>

			<td align="center">
				<?php echo $row->articleid; ?>
			</td>
			<td align="center">
				<?php echo $row->attempts; ?>
			</td>
			<td align="center">
				<?php echo $published; ?>
			</td>
			<td align="center" style="background-color:<?php echo $pubstate_color; ?>">
				<?php echo $row->pubstate; ?>
			</td>
			<td>
				<?php echo $row->resultmsg; ?>
			</td>
			<td>
				<?php echo $row->source; ?>
			</td>
		</tr>
	<?php
		$k = 1 - $k;
	}
	?>
	</table>

<input type="hidden" name="filter_order" value="<?php echo $this->lists['order']; ?>" />
<input type="hidden" name="filter_order_Dir" value="" />

<input type="hidden" name="option" value="com_autotweet" />
<input type="hidden" name="task" value="" />
<input type="hidden" name="boxchecked" value="0" />
<input type="hidden" name="controller" value="post" />

</form>
