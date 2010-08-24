<?php
/* ******************************************************************************
 * History: 
 * $Log: LoadConf.php,v $
 * Revision 1.1.2.5  2005/10/18 09:25:45  mos
 * AW references removed
 *
 * Revision 1.1.2.3  2005/06/28 08:59:18  mike
 * switch to Ascii
 * 
 * ****************************************************************************** 
 * Last CheckIn : $Author: mos $ 
 * Date : $Date: 2005/10/18 09:25:45 $ 
 * Revision : $Revision: 1.1.2.5 $ 
 * Repository File : $Source: /cvs/as/WLP_NEW/src_php/Attic/LoadConf.php,v $ 
 * ******************************************************************************
 */

/*
* load the config file and save the data into an array
* @return array (with configfile data)
*/

function LoadConfiguration() 
	{
	$conf_data=array();
	/*
	$my_path = dirname(__FILE__);
	if( file_exists($my_path."/../../../phpshop.cfg.php"))
		{
		require_once($my_path."/../../../phpshop.cfg.php");
		}
	elseif( file_exists($my_path."/../../../virtuemart.cfg.php"))
		{
		require_once($my_path."/../../../virtuemart.cfg.php");
		}
		else
			{
			die( "Mambo Configuration File not found!" );
			}
	require(CLASSPATH."/payment/ps_ideal.cfg.php");
	*/
	$my_path = dirname(__FILE__);
	if( file_exists($my_path."/../ps_ideal.cfg.php"))
		{
		require($my_path."/../ps_ideal.cfg.php");
		}
	elseif( file_exists($my_path."/../../ps_ideal.cfg.php"))
		{
		require($my_path."/../../ps_ideal.cfg.php");
		}
	return $conf_data;
	}

?>


