<?php
include 'config.php';

if(isSet($_POST['username']))
{
$username = $_POST['username'];
	
	$sql_check = mysql_query("SELECT username FROM jos_users WHERE username='$username'");

	if(mysql_num_rows($sql_check))
	{
		echo '<font color="red">The username <STRONG>'.$username.'</STRONG> is already in use.</font>';
	}
	else
	{
		echo 'OK';
	}

}
elseif(isSet($_POST['replicated_siteid']))
{
	$rep_siteid = $_POST['replicated_siteid'];
	$sql_check = mysql_query("SELECT username FROM jos_jsusernames WHERE username='$rep_siteid'");
	if(mysql_num_rows($sql_check))
	{
		echo '<font color="red">The Replicated Site ID <STRONG>'.$username.'</STRONG> is already in use.</font>';
	}
	else
	{
		echo 'OK';
	}

}


?>