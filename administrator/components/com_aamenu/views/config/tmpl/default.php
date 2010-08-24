<?php
/**
 * @version		$Id: default.php 67 2009-05-29 13:02:32Z eddieajau $
 * @package		TAOJ.AAMenu
 * @subpackage	com_aamenu
 * @copyright	(C) 2008 New Life in IT Pty Ltd. All rights reserved.
 * @license		GNU General Public License
 * @author		Andrew Eddie <andrew.eddie@newlifeinit.com>
 */

defined('_JEXEC') or die;

JHTML::_('behavior.tooltip');
JHTML::addIncludePath(JPATH_COMPONENT.DS.'helpers'.DS.'html');
JHTML::stylesheet('default.css', 'administrator/components/com_aamenu/media/css/');
?>

<form action="index.php?option=com_aamenu" method="post" name="adminForm" autocomplete="off">
	<fieldset>
		<div style="float: right">
			<button type="button" onclick="submitbutton('config.save');">
				<?php echo JText::_('SAVE');?>
			</button>
			<button type="button" onclick="window.parent.document.getElementById('sbox-window').close();">
				<?php echo JText::_('CANCEL');?>
			</button>
		</div>
		<div class="configuration" >
			<?php echo JText::_('AAMenu_Config_Title'); ?>
		</div>
	</fieldset>

	<fieldset>
		<?php echo JHTML::_('aamenu.params', 'params', $this->params->toString(), 'models/forms/config/component.xml'); ?>
	</fieldset>

	<input type="hidden" name="task" value="" />
	<input type="hidden" name="option" value="com_aamenu" />
	<?php echo JHTML::_('form.token'); ?>
</form>
