Hi there,

A user would like to share a link with you.

You can view the link at:
<?php
	/*Fahd Email Tempering*/
/* 	$user_id =  $_GET['userid'];
	$sql="SELECT `userid`,`username` FROM jos_jsusernames WHERE `userid`=".$user_id;
	$result = mysql_query($sql);
	$row = mysql_fetch_array($result);
  	$refname = $row['username'];
	$uri = "http://www.".$refname.".myzenvei.com/";  */
?>
<?php echo $uri; ?>

<?php
if( !empty($message) )
{
?>
Message:
===============================================================================

<?php echo $message; ?>

===============================================================================
<?php
}
?>