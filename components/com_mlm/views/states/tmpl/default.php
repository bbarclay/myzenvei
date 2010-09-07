<?php defined('_JEXEC') or die('Restricted access'); ?>

  <option value="">Select a state</option>
<?php foreach ($this->states as $state)  { ?>
  <option value="<?php echo $state->state_2_code ?>"><?php echo $state->state_name ?></option>
<?php } ?>
