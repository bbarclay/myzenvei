<?php
include 'administrator/components/com_virtuemart/classes/ps_checkout.php';
$order_id = 16;
$b = new vm_ps_checkout();
$b->$this->email_receipt($order_id);
?>