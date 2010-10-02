<?php defined('_JEXEC') or die('Restricted access'); ?>

  <option value=""><?php echo JText::_('MLM_SELECT_STATE') ?></option>
<?php foreach ($this->states as $state)  { ?>
  <option value="<?php echo $state->state_2_code ?>"><?php echo $state->state_name ?></option>
<?php } ?>
