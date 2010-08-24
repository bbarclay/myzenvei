<?php 
include_once '../dbCustomConnection.php';
if($_POST)
{
	
	$myzmail = $_POST['email'];
	if($myzDb->fetch("select 1 from jos_users where email='$myzmail'"))
	{
		
		echo '<font color="red">The email <STRONG>'.$myzmail.'</STRONG> is already in use.</font>';
		exit;
	}
else
	{
		echo 'OK';
	}
	
}

?>