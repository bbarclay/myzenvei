<?php 
	$from_header = "MIME-Version: 1.0"."\r\n";
	$from_header .= "Content-type: text/html; charset=iso-8859-1"."\r\n";
	$from_header .= "From: ".urldecode($_POST["fromEmail"]);
	
	mail(urldecode($_POST["toEmail"]), urldecode($_POST["subject"]), urldecode($_POST["message"]), $from_header);
	
	echo "status=sent";
?>