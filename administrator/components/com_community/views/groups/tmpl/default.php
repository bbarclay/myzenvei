<?php
// Disallow direct access to this file
defined('_JEXEC') or die('Restricted access');
?>
<form action="index.php?option=com_community" method="post" name="adminForm">
<div>
	<?php echo JText::_('CC NOTE GROUP CREATION IS NOW ONLY AVAILABLE THROUGH THE FRONT END OF JOM SOCIAL'); ?>
</div>
<table class="adminform" cellpadding="3">
	<tr>
		<td width="95%">&nbsp;</td>
		<td nowrap="nowrap" align="right">
		<span style="font-weight: bold;"><?php echo JText::_('CC VIEWING GROUPS BY CATEGORY'); ?>:
		<?php echo $this->categories;?>
		</td>
	</tr>
</table>
	
<table class="adminlist" cellspacing="1">
	<thead>
		<tr class="title">
			<th width="1%"><?php echo JText::_('CC NUM'); ?></th>
			<th width="1%">
				<input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count( $this->groups ); ?>);" />
			</th>
			<th width="15%" style="text-align: left;">
				<?php echo JText::_('CC NAME'); ?>
			</th>
			<th style="text-align: left;">
				<?php echo JText::_('CC GROUP DESCRIPTION'); ?>
			</th>
			<th width="10%">
				<?php echo JText::_('CC GROUP ADMINISTRATOR'); ?>
			</th>
			<th width="5%">
				<?php echo JText::_('CC PUBLISHED');?>
			</th>
			<th width="5%">
				<?php echo JText::_('CC MEMBER S'); ?>
			</th>
		</tr>
	</thead>
	<?php $i = 0; ?>
	<?php
		if( empty( $this->groups ) )
		{
	?>
	<tr>
		<td colspan="7" align="center"><?php echo JText::_('CC NO GROUPS CREATED YET');?></td>
	</tr>
	<?php
		} 
	?>
	<?php foreach( $this->groups as $row ): ?>
	<tr>
		<td>
			<?php echo ( $i + 1 ); ?>
		</td>
		<td>
			<?php echo JHTML::_('grid.id', $i++, $row->id); ?>
		</td>
		<td>
			<a href="javascript:void(0);" onclick="azcommunity.editGroup('<?php echo $row->id;?>');">
				<?php echo $row->name; ?>
			</a>
		</td>
		<td>
			<?php echo $row->description; ?>
		</td>
		<td align="center">
			<?php echo $row->user->name; ?>
			<span>[ <a href="javascript:void(0);" onclick="azcommunity.changeGroupOwner('<?php echo $row->id; ?>');"><?php echo JText::_('CC CHANGE'); ?></a> ]</span>
		</td>
		<td id="published<?php echo $row->id;?>" align="center">
			<?php echo $this->getPublish( $row , 'published' , 'groups,ajaxTogglePublish' );?>
		</td>
		<td align="center">
			<?php echo $row->membercount; ?>
		</td>
	</tr>
	<?php endforeach; ?>
	<tfoot>
	<tr>
		<td colspan="15">
			<?php echo $this->pagination->getListFooter(); ?>
		</td>
	</tr>
	</tfoot>
</table>
<input type="hidden" name="view" value="groups" />
<input type="hidden" name="option" value="com_community" />
<input type="hidden" name="task" value="groups" />
<input type="hidden" name="boxchecked" value="0" />
</form>