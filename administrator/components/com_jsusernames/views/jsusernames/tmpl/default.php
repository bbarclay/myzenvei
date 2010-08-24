<?php
defined('_JEXEC') or die('Restricted access');
?>
<form action="index.php?option=com_jsusernames" method="post" name="adminForm">
<table class="adminlist" cellspacing="1">
	<thead>
		<tr class="title">
			<th width="25%" style="text-align: left;">
				<?php echo JText::_( 'UserName' ); ?>
			</th>
			<th width="5%" style="text-align: left;">
				<?php echo JText::_( 'URL' ); ?>
			</th>
			<th width="5%">
				<?php echo JText::_( 'Profile' ); ?>
			</th>
		</tr>
	</thead>
	<?php $i = 0; ?>
	<?php foreach( $this->usernames as $row ): ?>
	<?php
	$user =& JFactory::getUser( $row->userid );
	?>
	<tr>
		<td>
			<?php echo $user->username; ?>
		</td>
		<td>
			<a href="<?php echo JURI::root() . $row->username; ?>"><?php echo JURI::root() . $row->username; ?></a>
		</td>
		<td align="center">
			<a href="<?php echo JURI::root();?>index.php?option=com_community&view=profile&userid=<?php echo $user->id;?>" target="_blank"><?php echo JText::_('View');?></a>
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
<input type="hidden" name="option" value="com_jsusernames" />
<input type="hidden" name="view" value="jsusernames" />
<input type="hidden" name="boxchecked" value="0" />
<?php echo JHTML::_( 'form.token' ); ?>
</form>