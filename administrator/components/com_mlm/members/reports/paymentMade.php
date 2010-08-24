<?php
#W/W Abdul/20-08-2010
#Pay Commissions
//include_once '../../../../../clients/zenvieConfig.php';
include_once '../../../../../dbCustomConnection.php';
$id = $_GET['id'];

if($myzDb->execute("update mlm_generate_report set payment_status='Paid' where id='$id'"))
{
	echo "Payment successfully paid";
	exit;
}
 		

?>