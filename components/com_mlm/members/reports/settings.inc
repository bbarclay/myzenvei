<?php
ob_start();
session_start();

	$host = 'localhost';
	$user = 'myzenvei_testing';
	$pass ='TbTOpEgpWf7t';
	$db = 'myzenvei_testing';
	
	
	mysql_connect($host,$user,$pass) or die('Could not connect to mysql');
	mysql_select_db($db);
?>