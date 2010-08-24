<?php
defined( '_JEXEC' ) or die( '=;)' );
?>
<form action="index.php" method="post" name="adminForm" id="adminForm" >
<div class="col100">
	<fieldset class="adminform">
		<legend><?php echo JText::_( 'Details' ); ?></legend>
		
	<table class="adminlist">           	
		<tr>
			<td colspan="2"><h1 align="center"><?php echo JText::_('JAF_CONFIG'); ?></h1></td>
		</tr>
		<tr>
			<td><?php echo JText::_( 'Title' ); ?>:</td>
			<td>
				<input class="text_area" type="text" name="title" id="title" size="32" maxlength="250" value="<?php echo $this->Campaigns->title;?>" />
			</td>	
		</tr>			
		<tr>
			<td><?php echo JText::_('JAF_VERSION'); ?>:</td>
			<td><select name="version">
				<option value="sale" <?php if ($this->Campaigns->version == "sale") echo "selected='selected'"; ?> ><?php echo JText::_('JAF_PPS'); ?></option>
				<option value="click" <?php if ($this->Campaigns->version == "click") echo "selected='selected'"; ?> ><?php echo JText::_('JAF_PPC'); ?></option>
				<option value="lead" <?php if ($this->Campaigns->version == "lead") echo "selected='selected'"; ?> ><?php echo JText::_('JAF_PPL'); ?></option>
				</select></td>
		</tr>
		<tr>
			<td><?php echo JText::_('JAF_CLICKCOST'); ?>:</td>
			<td><input name="jafclick" type="text" size="10" value="<?php echo $this->Campaigns->ppcvalue; ?>" /> <?php echo $currency; ?></td>
		</tr>
		<tr>
			<td><?php echo JText::_('JAF_SALECOST'); ?>:</td>
			<td><input name="jafsale" type="text" size="10" value="<?php echo $this->Campaigns->fpsvalue; ?>" />%</td>
		</tr>
		<tr>
			<td><?php echo JText::_( 'JAF_LEADCOST'); ?>:</td>
			<td><input name="jaflead" type="text" size="10" value="<?php echo $this->Campaigns->fplvalue; ?>" /> <?php echo $currency; ?></td>
		</tr>
		<tr>
			<td><?php echo JText::_( 'JAF_PAYOUT'); ?>:</td>
			<td><input name="payout" type="text" size="10" value="<?php echo $this->Campaigns->payout; ?>" /> <?php echo $currency; ?></td>
		</tr>

		<tr>
			<td><?php echo JText::_('JAF_COLORSCHEME'); ?>:<?php 
			echo JHTML::_('tooltip', JText::_( 'JAF_TOOL_SCHEME'), JText::_( 'JAF_INFO'), 'tooltip.png');
			?></td>
			<td><select name="chartscolor">
				<option value="darkred.txt" <?php if ($this->Campaigns->chartscolor == "darkred.txt") echo "selected='selected'"; ?> >dark red</option>
				<option value="softblue.txt" <?php if ($this->Campaigns->chartscolor == "softblue.txt") echo "selected='selected'"; ?> >soft blue</option>
				<option value="softbrown.txt" <?php if ($this->Campaigns->chartscolor == "softbrown.txt") echo "selected='selected'"; ?> >soft brown</option>
				<option value="softgreen.txt" <?php if ($this->Campaigns->chartscolor == "softgreen.txt") echo "selected='selected'"; ?> >soft green</option>
				</select>
			</td>
		</tr>
		<tr>
			<td><?php echo JText::_('JAF_TEMPLATE'); ?>:</td>
			<td><select name="template">
			<?php
			while ($dir = readdir ($handle))  {
				if ($dir != "." && $dir != "..")  {
				?>
				<option value="<?php echo $dir; ?>" <?php if ($this->Campaigns->template == $dir) echo "selected='selected'"; ?> ><?php echo $dir; ?></option>
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
			echo $editor1->display('desc', $this->Campaigns->desc, '100%;', '400', '75', '30');
			?>
			</td>
		</tr> 
		<tr>
			<td valign="top"><?php echo JText::_('JAF_TERMS'); ?>:</td>
			<td>
			<?php 
			$editor2 = &JFactory::getEditor();
			echo $editor2->display('terms', $this->Campaigns->terms, '100%;', '400', '75', '30');					
			?>
			</td>
			
<?php 
/*
JHTML::_('behavior.tooltip');	
echo JHTML::_('tooltip', JText::_( 'JAF_TOOL_UPLOAD'), JText::_( 'JAF_INFO'), 'tooltip.png');
*/
?>				

		</tr>
	</table>
	</fieldset>
</div>
<div class="clr"></div>

<input type="hidden" name="option" value="com_jafilia" />
<input type="hidden" name="id" value="<?php echo $this->Campaigns->id; ?>" />
<input type="hidden" name="task" value="" />
<input type="hidden" name="controller" value="campaigns" />
</form>