<?php defined('_JEXEC') or die('Restricted access'); ?>

<?php if ($this->status) { ?>
  <span class="valid">This <?php echo $this->field ?> is available.</span>
<?php } else { ?>
  <span class="invalid">This <?php echo $this->field ?> is not available.</span>
<?php } ?>
