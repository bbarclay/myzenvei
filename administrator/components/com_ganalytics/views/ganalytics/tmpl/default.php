<?php
/**
 * GAnalytics is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * GAnalytics is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with GAnalytics.  If not, see <http://www.gnu.org/licenses/>.
 *
 * @author Allon Moritz
 * @copyright 2007-2010 Allon Moritz
 * @version $Revision: 0.6.1 $
 */

defined('_JEXEC') or die('Restricted access');
?>
<form action="index.php" method="post" name="adminForm">
<div id="editcell">
<table class="adminlist">
	<thead>
		<tr>
			<th width="5">ID</th>
			<th width="20"><input type="checkbox" name="toggle" value=""
				onclick="checkAll(<?php echo count( $this->items ); ?>);" /></th>
			<th>Account Name</th>
			<th>Profile Name</th>
			<th>Start Date</th>
			<th>Account ID</th>
			<th>Profile ID</th>
			<th>Web Profile ID</th>
		</tr>
	</thead>
	<?php
	$k = 0;
	for ($i=0, $n=count( $this->items ); $i < $n; $i++)	{
		$row = &$this->items[$i];
		$checked 	= JHTML::_('grid.id',   $i, $row->id );
		?>
	<tr class="<?php echo "row$k"; ?>">
		<td><?php echo $row->id; ?></td>
		<td><?php echo $checked; ?></td>
		<td><?php echo $row->accountName; ?></td>
		<td><?php echo $row->profileName; ?></td>
		<td><?php echo $row->startDate; ?></td>
		<td><?php echo $row->accountID; ?></td>
		<td><?php echo $row->profileID; ?></td>
		<td><?php echo $row->webPropertyId; ?></td>
	</tr>
	<?php
	$k = 1 - $k;
	}
	?>
</table>
</div>

<input type="hidden" name="option" value="com_ganalytics" /> <input
	type="hidden" name="task" value="" /> <input type="hidden"
	name="boxchecked" value="0" /> <input type="hidden" name="controller"
	value="ganalytics" /></form>
