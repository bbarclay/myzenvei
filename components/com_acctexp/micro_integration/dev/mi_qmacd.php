<?php
// Dont allow direct linking
( defined('_JEXEC') || defined( '_VALID_MOS' ) ) or die( 'Direct Access to this location is not allowed.' );

class mi_qmacd {

	function mi_qmacd () {
		//include_once JPATH_SITE . "/components/com_acctexp/micro_integration/mi_htaccess/htaccess.class.php";
	}

	function Settings ( $params ) {
		// field type; name; variable value, description, extra (variable name)
		if(!isset($params['plans'])) $params['plans']="";
		if(!isset($params['quotas'])) $params['quotas']="";

		$settings = array();
		$settings[] = array("inputC", "QMACD DB Host", $params['qmacd_dbhost'], "Enter the DB Server name and port where the QMACD DB is located. ie. 186.43.56.23:2709", "qmacd_dbhost");
		$settings[] = array("inputC", "QMACD DB User", $params['qmacd_dbuser'], "Enter the Username needed to access the QMACD DB.", "qmacd_dbuser");
		$settings[] = array("inputC", "QMACD DB Password", $params['qmacd_dbpass'], "Enter the Password for the Username above", "qmacd_dbpass");
		$settings[] = array("inputC", "QMACD DB Name", $params['qmacd_dbname'], "Enter the DB Name of the QMACD DB", "qmacd_dbname");
		$settings[] = array("inputD", "Plans", $params['plans'], "Enter the Plan ID's, comma seperated, that require email quotas. ie: 2,5,8,9,10", "plans");
		$settings[] = array("inputD", "Quotas", $params['quotas'], "Enter the amount of HD space, comma seperated, allowed per Plan above. Use MB and GB as needed. ie. 25 MB,1 GB,2 GB,5 MB,6 MB", "quotas");

		return $settings;
	}

	/*function saveparams ( $params ) {
		return;
	}*/

	function expiration_action($params, $userid) {
		$database = &JFactory::getDBO();

	global $qmacddatabase, $mainframe;

		if(!method_exists($qmacddatabase,"setQuery")){
			$qmacddatabase = new database( $params['qmacd_dbhost'], $params['qmacd_dbuser'], $params['qmacd_dbpass'], $params['qmacd_dbtable'], "" );
			if ($qmacddatabase->getErrorNum()) {
				$mosSystemError = $qmacddatabase->getErrorNum();
				$basePath = dirname( __FILE__ );
				exit();
			}
		}
		$qmacddatabase->debug( $mainframe->getCfg( 'debug' ) );

   		$qmacddatabase->setQuery("update users set action='suspend' where uid='".$userid."'");
        $qmacddatabase->query();
   		$qmacddatabase->setQuery("insert into tags (tag) values ('scan users:now ".$userid."')");
       	$qmacddatabase->query();
	}

	function action($params, $userid) {
		$database = &JFactory::getDBO();

	global $mainframe, $qmacddatabase;

		$tplans = explode(",",$params['plans']);
	    $quotas = explode(",",$params['quotas']);
        $pcounter=0;
		foreach($quotas as $cquota){
			$wq= explode(" ",$cquota);
			if($wq[1] == "GB") $plans[$tplans[$pcounter]]=$wq[0] * 1073741824;
			elseif($wq[1] == "MB") $plans[$tplans[$pcounter]] = $wq[0] * 1048576;
			elseif($wq[1] == "KB") $plans[$tplans[$pcounter]]=$wq[0] * 1024;
			else $plans[$tplans[$pcounter]] = $wq[0];
			++$pcounter;
		}

		$database->setQuery("select plan from #__acctexp_subscr where userid='".$userid."'");
		$newplan=$database->loadResult();

		if(isset($plans[$newplan])){
			//$database = &JFactory::getDBO();

	global $qmacddatabase;
			if(!method_exists($qmacddatabase,"setQuery")){
				$qmacddatabase = new database( $params['qmacd_dbhost'], $params['qmacd_dbuser'], $params['qmacd_dbpass'], $params['qmacd_dbtable'], "" );
				if ($qmacddatabase->getErrorNum()) {
					$mosSystemError = $qmacddatabase->getErrorNum();
					$basePath = dirname( __FILE__ );
					exit();
				}
			}
			$qmacddatabase->debug( $mainframe->getCfg( 'debug' ) );

     		$qmacddatabase->setQuery("update users set type='email', hd='".$plans[$newplan]."',level='4', action='create' where uid='".$userid."'");
	        $qmacddatabase->query();
    		$qmacddatabase->setQuery("insert into tags (tag) values ('scan users:now ".$userid."')");
        	$qmacddatabase->query();
		}

	}

}


?>