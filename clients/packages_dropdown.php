		<p><?php echo JText::_('CLI_FORM_D1_HEAD');?></p>
		<select name="drop1" id="drop1" onChange="Changedrop2options(this,'drop2');">
		  <option value="<?php echo JText::_('CLI_FORM_D1_OPTION0');?>"><?php echo JText::_('CLI_FORM_D1_OPTION0');?></option>
		  <option value="<?php echo JText::_('CLI_FORM_D1_OPTION1');?>"><?php echo JText::_('CLI_FORM_D1_OPTION1');?></option>
		  <option value="<?php echo JText::_('CLI_FORM_D1_OPTION2');?>"><?php echo JText::_('CLI_FORM_D1_OPTION2');?></option>
		  <option value="<?php echo JText::_('CLI_FORM_D1_OPTION3');?>"><?php echo JText::_('CLI_FORM_D1_OPTION3');?></option>
		 </select>
		 <br>
		 <p><?php echo JText::_('CLI_FORM_D2_HEAD');?></p>
		 <select name="drop2" id="drop2" onChange="Changedrop1options(this,'drop1');">
		    <option value="<?php echo JText::_('CLI_FORM_D1_OPTION0');?>" selected><?php echo JText::_('CLI_FORM_D1_OPTION0');?></option>
		    <option value="<?php echo JText::_('CLI_FORM_D2_OPTION1');?>"><?php echo JText::_('CLI_FORM_D2_OPTION1');?></option>
		    <option value="<?php echo JText::_('CLI_FORM_D2_OPTION2');?>"><?php echo JText::_('CLI_FORM_D2_OPTION2');?></option>
		    <option value="<?php echo JText::_('CLI_FORM_D2_OPTION3');?>"><?php echo JText::_('CLI_FORM_D2_OPTION3');?></option>
		    <option value="<?php echo JText::_('CLI_FORM_D2_OPTION4');?>"><?php echo JText::_('CLI_FORM_D2_OPTION4');?></option>
		  </select>