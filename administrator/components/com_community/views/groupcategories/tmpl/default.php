<?php
// Disallow direct access to this file
defined('_JEXEC') or die('Restricted access');

?>
<script type="text/javascript" language="javascript">
/**
 * This function needs to be here because, Joomla calls it
 **/ 
function submitbutton(action)
{
	if(action == 'newcategory')
	{
		azcommunity.editGroupCategory( 0 , '<?php echo JText::_('CC NEW CATEGORY'); ?>');
	}
	
	if(action == 'removecategory')
	{
		submitform(action);
	}
}
</script>
	<form action="index.php?option=com_community" method="post" name="adminForm">
	<table class="adminlist" cellspacing="1">
		<thead>
			<tr class="title">
				<th width="1%"><?php echo JText::_('CC NUM'); ?></th>
				<th width="1%"><input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count( $this->categories ); ?>);" /></th>
				<th width="15%" style="text-align: left;">
					<?php echo JHTML::_('grid.sort',   JText::_('CC NAME') , 'name', $this->lists['order_Dir'], $this->lists['order'] ); ?>
				</th>
				<th style="text-align: left;">
					<?php echo JText::_('CC CATEGORY DESCRIPTION'); ?>
				</th>
				<th width="5%">
					<?php echo JHTML::_('grid.sort',   JText::_('CC GROUPS'), 'groups', $this->lists['order_Dir'], $this->lists['order'] ); ?>
				</th>
				<th width="5%">
					<?php echo JHTML::_('grid.sort',   JText::_('CC GROUPS'), 'members', $this->lists['order_Dir'], $this->lists['order'] ); ?>
				</th>
			</tr>		
		</thead>
<?php
		$i		= 0;
		
		foreach($this->categories as $category)
		{
?>
			<tr>
				<td><?php echo $i + 1; ?></td>
				<td><?php echo JHTML::_('grid.id', $i++, $category->id); ?></td>
				<td>
					<?php echo JHTML::_('link', 'javascript:void(0);', $category->name, array('id' => 'group-title-' . $category->id , 'onclick'=>'azcommunity.editGroupCategory(\'' . $category->id . '\',\'' . JText::_('CC EDIT CATEGORY') . '\');')); ?>
				</td>
				<td id="group-description-<?php echo $category->id; ?>">
					<?php echo $category->description;?>
				</td>
				<td align="center">
					<a href="index.php?option=com_community&view=groups&category=<?php echo $category->id;?>">
						<?php echo $category->groupscount; ?>
					</a>
				</td>
				<td align="center"><?php echo $category->memberscount; ?></td>
			</tr>
<?php
		}
?>
		<tfoot>
		<tr>
			<td colspan="6">
				<?php echo $this->pagination->getListFooter(); ?>
			</td>
		</tr>
		</tfoot>
	</table>
	<input type="hidden" name="view" value="groupcategories" />
	<input type="hidden" name="option" value="com_community" />
	<input type="hidden" name="task" value="groupcategories" />
	<input type="hidden" name="boxchecked" value="0" />
	<input type="hidden" name="filter_order" value="<?php echo $this->lists['order']; ?>" />
	<input type="hidden" name="filter_order_Dir" value="<?php echo $this->lists['order_Dir']; ?>" />
	</form>