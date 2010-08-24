<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
JHTML::_('behavior.tooltip');
$ordering = ($this->lists['order'] == 'ordering');   //Ordering allowed ?
?>

<script language="javascript" type="text/javascript">
function submitform(pressbutton){
var form = document.adminForm;
   if (pressbutton)
    {form.task.value=pressbutton;}
    
	if ((pressbutton=='add')||(pressbutton=='edit')||(pressbutton=='publish')||(pressbutton=='unpublish')
	 ||(pressbutton=='orderdown')||(pressbutton=='orderup')||(pressbutton=='saveorder') )
	 {
	  form.controller.value="unused_detail";
	 }
	try {
		form.onsubmit();
		}
	catch(e){}
	
	form.submit();
}
</script>
<style type="text/css">
.style13_footer{background-color:#F3F3F3;border-top:1px solid #999999;text-align:center;float:left; width:100%;}
.pagination{display:table;margin:0 auto;padding:5px;}
</style>
<form action="<?php echo $this->request_url; ?>" method="post" name="adminForm" >
<div id="editcell">
	<table class="adminlist">
	<thead>
		<tr>
			<th width="5">
				<?php echo JText::_( 'NUM' ); ?>
			</th>
			<th width="20">
				<input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count( $this->items ); ?>);" />
			</th>
			<th class="title">
				<?php echo JHTML::_('grid.sort', 'Title', 'title', $this->lists['order_Dir'], $this->lists['order'] ); ?>
			</th>
			<th class="title">
				<?php echo JHTML::_('grid.sort', 'Module type', 'module',  $this->lists['order_Dir'], $this->lists['order'] ); ?>
			</th>
			<th class="title">
				<?php echo JHTML::_('grid.sort','Position', 'position',  $this->lists['order_Dir'], $this->lists['order'] ); ?>
			</th>
			<th width="5%" nowrap="nowrap">
				<?php echo JHTML::_('grid.sort', 'Published', 'published',  $this->lists['order_Dir'], $this->lists['order'] ); ?>
			</th>
			<th width="5%" nowrap="nowrap">
				<?php echo JHTML::_('grid.sort',  'ID', 'id', $this->lists['order_Dir'], $this->lists['order'] ); ?>
			</th>
		</tr>
	</thead>	
	<?php
	$k = 0;
	for ($i=0, $n=count( $this->items ); $i < $n; $i++)
	{
		$row = &$this->items[$i];

		$link 	= JRoute::_( 'index.php?option=com_modules&amp;client=0&amp;task=edit&amp;cid[]='. $row->id );

		$checked 	= JHTML::_('grid.checkedout',   $row, $i ,'id');
		$published 	= JHTML::_('grid.published', 	$row, $i );

		?>
		<tr class="<?php echo "row$k"; ?>">
			<td>
				<?php echo $this->pagination->getRowOffset( $i ); ?>
			</td>
			<td>
				<?php echo $checked; ?>
			</td>
			<td>
				<?php
				if (  JTable::isCheckedOut($this->user->get('id'), $row->checked_out ) ) {
					echo $row->title;
				} else {
				?>
					<a href="<?php echo $link; ?>" title="<?php echo JText::_( 'Edit ' ); ?>">
						<?php echo $row->title; ?></a>
				<?php
				}
				?>
			</td>
			<td>
				<?php echo $row->module; ?>
			</td>
			<td>
				<?php echo $row->position; echo $lists['position'];?>
			</td>
			
			<td align="center">
				<?php echo $published;?>
			</td>
			<td align="center">
				<?php echo $row->id; ?>
			</td>			
		</tr>
		<?php
		$k = 1 - $k;
	}
	?>
<tfoot>
		<td colspan="7">
			<?php echo $this->pagination->getListFooter(); ?>
		</td>
	</tfoot>
	</table>
</div>
<div class="style13_footer">
	<div class="pagination">
		<div class="button2-left">
			<div class="next">
				<span>J!Position 1.0.2</span>
				<a href="http://www.style13.com" title="Powered by Style13">Powered by Style13</a>
			</div>
		</div>
	</div>
</div>
<input type="hidden" name="controller" value="unused" />
<input type="hidden" name="task" value="" />
<input type="hidden" name="boxchecked" value="0" />
<input type="hidden" name="filter_order" value="<?php echo $this->lists['order']; ?>" />
<input type="hidden" name="filter_order_Dir" value="<?php echo $this->lists['order_Dir']; ?>" />
</form>
