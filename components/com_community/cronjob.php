<?php
/**
 * @category	Cron
 * @package		JomSocial
 * @copyright (C) 2008 by Slashes & Dots Sdn Bhd - All rights reserved!
 * @license http://www.jomsocial.com Copyrighted Commercial Software
 */

// Change the $hostname to your site's URL
$hostname 	= 'yoursite.com';

// If you have subfolder on your main site, specify it here. Should not end or begin with any trailing slash.
$subfolder	= '';

$resource	= @fsockopen( $hostname , 80 , $errorNumber , $errorString );

if( !$resource )
{
	echo 'Error connecting to host';
	return;
}

$output		= "GET /" . $subfolder . "/index.php?option=com_community&task=cron HTTP/1.1\r\n";
$output		.= "Host: " . $hostname . "\r\n";
$output		.= "Connection: Close\r\n\r\n";

fwrite( $resource , $output );
fclose( $resource );

echo "Cronjob processed.\r\n";
return;