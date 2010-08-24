<?php
defined( '_JEXEC' ) or die( '=;)' );
?>
<form action="index.php" method="post" name="adminForm" id="adminForm" enctype="multipart/form-data">
<div class="col100">
	<fieldset class="adminform">
		<legend><?php echo JText::_( 'Details' ); ?></legend>
		<table class="admintable">
		<tr>
			<td width="100" align="right" class="key">
				<label for="title">
					<?php echo JText::_( 'Title' ); ?>:
				</label>
				<input class="text_area" type="text" name="title" id="title" size="32" maxlength="250" value="<?php echo $this->Campaigns->title;?>" />
			</td>		
			
			<td width="100" align="right" class="key">		
				<label for="version"><?php echo JText::_( 'JAF_VERSION' ); ?>
				<select id="version" name="version">
					<option value=""><?php echo JText::_( 'JAF_SELECT' ); ?></option>
					<option value="text"><?php echo JText::_( 'JAF_TLINK' ); ?></option>
					<option value="banner"><?php echo JText::_( 'JAF_BLINK' ); ?></option>
				</select>		
			</td>

			<td align="right" class="key">
				<label for="text">
					<?php echo JText::_( 'Description' ); ?>:
				</label>				
				<input class="text_area" type="text" name="desc" id="desc" size="32" maxlength="250" value="<?php echo $this->Campaigns->desc;?>" />
			</td>

			<td align="right" class="key">
				<label for="text">
					<?php echo JText::_( 'Terms' ); ?>:
				</label>				
				<input class="text_area" type="text" name="terms" id="terms" size="32" maxlength="250" value="<?php echo $this->Campaigns->terms;?>" />
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