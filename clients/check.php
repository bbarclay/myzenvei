<?php
include 'config.php';
global $keywords;$handle = @fopen("keywords.txt", "r");if ($handle) {	$i = 0;	while (!feof($handle)) 	{		$keywords[$i] = trim(fgets($handle, 4096));		$i++;	}	fclose($handle);}function checkforReserved($name){	/*	1.- For not reserved,	2.- is reserved.	*/		global $keywords;	$status = 1;		for($g=0;$g<=sizeof($keywords)-1;$g++)	{		if($name == $keywords[$g])		{			$status = 0;		}	}	return $status;}function isValid($name) {	$status = 1;	$invalid = array(0=>'Á',1=>'á',2=>'Ä',3=>'ä',4=>'Ë',5=>'ë',6=>'É',7=>'é',8=>'}',9=>'{',10=>'[',11=>']',12=>'*',13=>'+',14=>'~',15=>'^',16=>'`',17=>'/',18=>'(',19=>')',20=>'%',21=>'!',22=>'¬',23=>'\'',24=>'?',25=>'$',26=>'&');    for($i=0;$i<=sizeof($invalid);$i++)	{		if(stristr($name, $invalid[$i]) != FALSE)		{			return $invalid[$i];		}	}	return $status;}
if(isSet($_POST['username']))
{
	$username = $_POST['username'];	if(checkforReserved($username) == 1)	{			$sql_check = mysql_query("SELECT username FROM jos_users WHERE username='$username'");
		if(mysql_num_rows($sql_check))
		{
			echo '<font color="red">The username <STRONG>'.$username.'</STRONG> is already in use.</font>';
		}
		else
		{
			echo 'OK';
		}	}	else	{		echo '<font color="red">The username <STRONG>'.$username.'</STRONG> is reserved.</font>';	}}
elseif(isSet($_POST['replicated_siteid']))
{	$rep_siteid = $_POST['replicated_siteid'];	$result = isValid($rep_siteid);	if($result == 1)	{			if(checkforReserved($rep_siteid) == 1)		{			$sql_check = mysql_query("SELECT username FROM jos_jsusernames WHERE username='$rep_siteid'");			if(mysql_num_rows($sql_check))			{				echo '<font color="red">The Replicated Site ID <STRONG>'.$rep_siteid.'</STRONG> is already in use.</font>';			}
			else			{				echo 'OK';			}		}		else		{			echo '<font color="red">The Replicated Site ID <STRONG>'.$rep_siteid.'</STRONG> is reserved.</font>';		}	}	else	{		echo '<font color="red">You have entered an invalid character ('.$result.')</font>';	}}elseif(isSet($_POST['email'])){	$email = $_POST['email'];	$sql_check = mysql_query("SELECT email FROM jos_users WHERE email='$email'");	if(mysql_num_rows($sql_check))	{		echo '<font color="red">The email <STRONG>'.$email.'</STRONG> is already in use.</font>';	}	else	{		echo 'OK';	}}?>