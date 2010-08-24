<?php
/**
 * @version		$Id: default.php 67 2009-05-29 13:02:32Z eddieajau $
 * @package		TAOJ.AAMenu
 * @subpackage	com_aamenu
 * @copyright	(C) 2008 New Life in IT Pty Ltd. All rights reserved.
 * @license		GNU General Public License
 * @author		Andrew Eddie <andrew.eddie@newlifeinit.com>
 */

defined('_JEXEC') or die('Restricted access');

JHtml::addIncludePath(JPATH_COMPONENT.DS.'helpers'.DS.'html');
JHtml::script('checkall.js', 'administrator/components/com_aamenu/media/js/');
JHtml::stylesheet('default.css', 'administrator/components/com_aamenu/media/css/')
?>

<form action="index.php" method="post" name="adminForm">
	<fieldset class="filter">
		<ol>
			<li>
				<label for="search"><?php echo JText::_('AAMenu_Filter_Search'); ?>:</label>
				<input type="text" name="search" id="search" value="<?php echo $this->state->get('filter.search'); ?>" size="60" title="<?php echo JText::_('AAMenu_Filter_Search_Desc'); ?>" />
			</li>
			<li>
				<button type="submit"><?php echo JText::_('AAMenu_Filter_Go'); ?></button>
				<button type="button" onclick="document.getElementById('search').value='';this.form.submit();"><?php echo JText::_('AAMenu_Filter_Clear'); ?></button>
			</li>
		</ol>
	</fieldset>

	<table class="adminlist">
		<thead>
			<tr>
				<th class="left">
					<?php echo JHtml::_('grid.sort', 'AAMenu_Tags_Component_Name', 'a.name', $this->state->get('list.direction'), $this->state->get('list.ordering')); ?>
				</th>
				<th nowrap="nowrap" width="5%">
					<?php echo JHtml::_('grid.sort', 'AAMenu_Tags_Tag', 't.tag', $this->state->get('list.direction'), $this->state->get('list.ordering')); ?>
				</th>
				<th nowrap="nowrap" width="5%">
					<?php echo JHtml::_('grid.sort', 'AAMenu_Tags_Ordering', 't.ordering', $this->state->get('list.direction'), $this->state->get('list.ordering')); ?>
				</th>
				<th nowrap="nowrap" width="5%" align="center">
					<?php echo JHtml::_('grid.sort', 'AAMenu_Tags_ID', 'a.id', $this->state->get('list.direction'), $this->state->get('list.ordering')); ?>
				</th>
			</tr>
		</thead>
		<tfoot>
			<tr>
				<td colspan="15">
					<?php echo $this->pagination->getListFooter(); ?>
				</td>
			</tr>
		</tfoot>
		<tbody>
		<?php
			$k = 0;
			foreach ($this->items as $item) : ?>
			<tr class="row<?php echo $k; ?>">
				<td>
					<?php echo $item->name; ?>
					<small>(<?php echo $item->option; ?>)</small>
				</td>
				<td align="center">
					<?php echo JHtml::_('select.genericlist', $this->tags, 'tags['.$item->id.']', '', 'value', 'text', $item->tag); ?>
				</td>
				<td align="center">
					<input type="text" name="ordering[<?php echo $item->id;?>]" value="<?php echo (int) $item->ordering; ?>" class="inputbox" size="3" style="text-align:center" />
				</td>
				<td align="center">
					<?php echo $item->id; ?>
				</td>
			</tr>
		<?php
			$k = 1 - $k;
			endforeach; ?>
		</tbody>
	</table>

	<input type="hidden" name="option" value="com_aamenu" />
	<input type="hidden" name="task" value="" />
	<input type="hidden" name="view" value="tags" />
	<input type="hidden" name="model" value="tags" />

	<input type="hidden" name="boxchecked" value="0" />
	<input type="hidden" name="filter_order" value="<?php echo $this->state->get('list.ordering'); ?>" />
	<input type="hidden" name="filter_order_Dir" value="<?php echo $this->state->get('list.direction'); ?>" />
	<input type="hidden" name="<?php echo JUtility::getToken();?>" value="1" />
</form>