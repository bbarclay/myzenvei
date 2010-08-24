<?php
/*
	JoomlaXTC Vtube Module

	version 1.4
	
	Copyright (C) 2009,2010  Monev Software LLC.	All Rights Reserved.
	
	All Rights Reserved.
	
	THIS PROGRAM IS NOT FREE SOFTWARE
	
	You shall not modify, copy, duplicate, reproduce, sell, license or
	sublicense the Software, or transfer or convey the Software or
	any right in the Software to anyone else without the prior
	written consent of Developer; provided that Licensee may make
	one copy of the Software for backup or archival purposes.
	
	www.joomlaxtc.com
	
	See COPYRIGHT.php for copyright notices and details.
	
	Monev Software LLC
	www.joomlaxtc.com
*/

	$from_header = "MIME-Version: 1.0"."\r\n";
	$from_header .= "Content-type: text/html; charset=iso-8859-1"."\r\n";
	$from_header .= "From: ".urldecode($_POST["fromEmail"]);
	
	mail(urldecode($_POST["toEmail"]), urldecode($_POST["subject"]), urldecode($_POST["message"]), $from_header);
	
	echo "status=sent";
?>