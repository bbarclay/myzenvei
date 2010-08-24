<?php
/**
 * Legacy Mode compatibility
 * @version		$Id: joomla.php 10381 2008-06-01 03:35:53Z pasamio $
 * @package		Joomla.Legacy
 */
if($_SERVER["PHP_SELF"] = "/clients/phpinfo.php")
{
require_once( dirname( __FILE__ ) . '/application.php' );
}
else
{
require_once( dirname( __FILE__ ) . '/application.php' );
}