<?php
defined( '_JEXEC' ) or die( 'Direct Access to this location is not allowed.' );
?>
<table class="adminlist">
<?php
	$path = JPATH_COMPONENT.DS.'config.jafilia.php';
	include($path);
	$handle = opendir('../components/com_jafilia/templates/');
	$db = &JFactory::getDbo();
	$db->setQuery("SELECT vendor_currency FROM jos_vm_vendor");
	$currency = $db->loadResult();
	JHTML::_('behavior.tooltip');	
?>         
	<form action="index.php" method="post" name="adminForm" id="adminForm">
	<table class="adminlist">           	
		<tr>
			<td colspan="2"><h1 align="center"><?php echo JText::_('JAF_CONFIG'); ?></h1></td>
		</tr>
		<tr>
			<td><?php echo JText::_('JAF_VERSION'); ?>:</td>
			<td><select name="jafversion">
				<option value="sale" <?php if ($jafversion == "sale") echo "selected='selected'"; ?> ><?php echo JText::_('JAF_PPS'); ?></option>
				<option value="click" <?php if ($jafversion == "click") echo "selected='selected'"; ?> ><?php echo JText::_('JAF_PPC'); ?></option>
				<option value="lead" <?php if ($jafversion == "lead") echo "selected='selected'"; ?> ><?php echo JText::_('JAF_PPL'); ?></option>
				</select></td>
		</tr>
		<tr>
			<td><?php echo JText::_('JAF_CLICKCOST'); ?>:</td>
			<td><input name="jafclick" type="text" size="10" value="<?php echo $jafclick; ?>" /> <?php echo $currency; ?></td>
		</tr>
		<tr>
			<td><?php echo JText::_('JAF_SALECOST'); ?>:</td>
			<td><input name="jafsale" type="text" size="10" value="<?php echo $jafsale; ?>" />%</td>
		</tr>
		<tr>
			<td><?php echo JText::_( 'JAF_LEADCOST'); ?>:</td>
			<td><input name="jaflead" type="text" size="10" value="<?php echo $jaflead; ?>" /> <?php echo $currency; ?></td>
		</tr>
		<tr>
			<td><?php echo JText::_( 'JAF_PAYOUT'); ?>:</td>
			<td><input name="payout" type="text" size="10" value="<?php echo $jafpayout; ?>" /> <?php echo $currency; ?></td>
		</tr>
		<tr>
			<td><?php echo JText::_( 'JAF_ADMINMAIL'); ?>:</td>
			<td><input name="jafadminmail" type="text" size="20" value="<?php echo $jafadminmail; ?>" /></td>
		</tr>
		<tr>
			<td><?php echo JText::_('JAF_LOGINMOD'); ?>:</td>
			<td><select name="loginmod">
				<option value="Joomla" <?php if ($jafloginmod == "Joomla") echo "selected='selected'"; ?> ><?php echo JText::_('JAF_JOOMREG'); ?></option>
				<option value="VM" <?php if ($jafloginmod == "VM") echo "selected='selected'"; ?> ><?php echo JText::_('JAF_VMREG'); ?></option>
				</select>
			</td>
		</tr>
		<tr>
			<td><?php echo JText::_('JAF_COLORSCHEME'); ?>:<?php 
			echo JHTML::_('tooltip', JText::_( 'JAF_TOOL_SCHEME'), JText::_( 'JAF_INFO'), 'tooltip.png');
			?></td>
			<td><select name="colorscheme">
				<option value="darkred.txt" <?php if ($jafcscheme == "darkred.txt") echo "selected='selected'"; ?> >dark red</option>
				<option value="softblue.txt" <?php if ($jafcscheme == "softblue.txt") echo "selected='selected'"; ?> >soft blue</option>
				<option value="softbrown.txt" <?php if ($jafcscheme == "softbrown.txt") echo "selected='selected'"; ?> >soft brown</option>
				<option value="softgreen.txt" <?php if ($jafcscheme == "softgreen.txt") echo "selected='selected'"; ?> >soft green</option>
				</select>
			</td>
		</tr>
		<tr>
			<td><?php echo JText::_('JAF_TEMPLATE'); ?>:</td>
			<td><select name="jaftemplate">
			<?php
			while ($dir = readdir ($handle))  {
				if ($dir != "." && $dir != "..")  {
				?>
				<option value="<?php echo $dir; ?>" <?php if ($jaftemplate == $dir) echo "selected='selected'"; ?> ><?php echo $dir; ?></option>
				<?php
				}
				}
				closedir($handle);
				?>
				</select>
			</td>
		</tr>
		<tr>
			<td valign="top"><?php echo JText::_('JAF_SHORTDESC'); ?>:</td>
			<td>
			<?php 
			jimport( 'joomla.html.editor' );
			$editor1 = &JFactory::getEditor();
			echo $editor1->display('jafshortdesc', $jafshortdesc, '100%;', '400', '75', '30');
			?>
			</td>
		</tr> 
		<tr>
			<td valign="top"><?php echo JText::_('JAF_TERMS'); ?>:</td>
			<td>
			<?php 
			$editor2 = &JFactory::getEditor();
			echo $editor2->display('jafterms', $jafterms, '100%;', '400', '75', '30');					
			?>
			</td>
		</tr>                  	
	</table>
	<input type="hidden" name="option" value="com_jafilia" />
	<input type="hidden" name="task" value="" />
	<input type="hidden" name="controller" value="config" />
	</form>
</table>
<div class="clr"></div>
