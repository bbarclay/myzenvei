<?php
/**
 * @version		$Id: move.php 315 2010-01-14 18:49:25Z joomlaworks $
 * @package		K2
 * @author    JoomlaWorks http://www.joomlaworks.gr
 * @copyright	Copyright (c) 2006 - 2010 JoomlaWorks Ltd. All rights reserved.
 * @license		GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

?>

<script type="text/javascript">
	//<![CDATA[
	function submitbutton(pressbutton) {
		if (pressbutton == 'cancel') {
			submitform( pressbutton );
			return;
		}
		if (trim( document.adminForm.category.value ) == "") {
			alert( '<?php echo JText::_('You must select a target category', true);?>' );
		} else {
			submitform( pressbutton );
		}
	}
	//]]>
</script>

<form action="index.php" method="post" name="adminForm">
	<fieldset>
		<legend><?php echo JText::_('Target category');?></legend>
		<?php echo $this->lists['categories'];?>
	</fieldset>
	<fieldset>
		<legend><?php echo JText::_('Items being moved');?></legend>
		<ol>
			<?php foreach ($this->rows as $row):?>
			<li><?php echo $row->title;?><input type="hidden" name="cid[]" value="<?php echo $row->id;?>" /></li>
			<?php endforeach;?>
		</ol>
	</fieldset>
	<input type="hidden" name="option" value="<?php echo $option;?>" />
	<input type="hidden" name="view" value="<?php echo JRequest::getVar('view'); ?>" />
	<input type="hidden" name="task" value="<?php echo JRequest::getVar('task'); ?>" />
</form>
