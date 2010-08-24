<?php
// Dont allow direct linking
( defined('_JEXEC') || defined( '_VALID_MOS' ) ) or die( 'Direct Access to this location is not allowed.' );

class mi_qmacd_1 {

	function Info () {
		$info = array();
		$info['name'] = "QMAIL";
		$info['desc'] = "Connect to a QMACD Server and set quotas for the user";

		return $info;
	}

	function mi_qmacd () {
		//include_once JPATH_SITE . "/components/com_acctexp/micro_integration/mi_htaccess/htaccess.class.php";
	}

	function Settings ( $params ) {
		$salt="zdlksjlkjfsdkjf987sf98798sdfjlk2";
		// field type; name; variable value, description, extra (variable name)
		if(!isset($params['plans'])) $params['plans']="";
		if(!isset($params['quotas'])) $params['quotas']="";

		$settings = array();
		$settings['qmacd_dbhost'] = array("inputC", "QMACD DB Host", $params['qmacd_dbhost'], "Enter the DB Server name and port where the QMACD DB is located. ie. 186.43.56.23:2709");
		$settings['qmacd_dbuser'] = array("inputC", "QMACD DB User", $params['qmacd_dbuser'], "Enter the Username needed to access the QMACD DB.");
		$settings['qmacd_dbpass'] = array("inputC", "QMACD DB Password", $params['qmacd_dbpass'], "Enter the Password for the Username above");
		$settings['qmacd_dbname'] = array("inputC", "QMACD DB Name", $params['qmacd_dbname'], "Enter the DB Name of the QMACD DB");
		$settings['quota'] = array("inputD", "Quotas", $params['quotas'], "Enter the amount of HD space allowed. Use MB and GB as needed. ie. 25 MB,1 GB,2 GB,5 MB,6 MB");

		return $settings;
	}

	/*function saveparams ( $params ) {
		return;
	}*/

	function expiration_action($params, $userid, $plan) {
		$database = &JFactory::getDBO();

	global $qmacddatabase, $mainframe;

		if(!method_exists($qmacddatabase,"setQuery")){
			$qmacddatabase = new database( $params['qmacd_dbhost'], $params['qmacd_dbuser'], $params['qmacd_dbpass'], $params['qmacd_dbname'], "" );
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

	function action($params, $userid, $plan) {
		$database = &JFactory::getDBO();

		global $mainframe, $qmacddatabase;
		$salt="zdlksjlkjfsdkjf987sf98798sdfjlk2";

		$wq= explode(" ",$params['quota']);
		if($wq[1] == "GB") $hd = $wq[0] * 1073741824;
		elseif($wq[1] == "MB") $hd = $wq[0] * 1048576;
		elseif($wq[1] == "KB") $hd = $wq[0] * 1024;
		else $hd = $wq[0];

		//$database = &JFactory::getDBO();

	global $qmacddatabase;
		if(!method_exists($qmacddatabase,"setQuery")){
			$qmacddatabase = new database( $params['qmacd_dbhost'], $params['qmacd_dbuser'], $params['qmacd_dbpass'], $params['qmacd_dbname'], "" );
			if ($qmacddatabase->getErrorNum()) {
				$mosSystemError = $qmacddatabase->getErrorNum();
				$basePath = dirname( __FILE__ );
				exit();
			}
		}
		$qmacddatabase->debug( $mainframe->getCfg( 'debug' ) );

 		$qmacddatabase->setQuery("UPDATE users SET type='email', hd='".$hd."',level='4', action='create' WHERE uid='".$userid."'");
        $qmacddatabase->query();
		$qmacddatabase->setQuery("INSERT INTO tags (tag) VALUES ('scan users:now ".$userid."')");
    	$qmacddatabase->query();

	}

	function userchange($row,$post,$params){
		$database = &JFactory::getDBO();

	global $mainframe, $qmacddatabase;

		if($post['task']=="saveregisters" || $post['task']=="saveRegistration"){
			if(!method_exists($qmacddatabase,"setQuery")){
				$qmacddatabase = new database( $params['qmacd_dbhost'], $params['qmacd_dbuser'], $params['qmacd_dbpass'], $params['qmacd_dbname'], "" );
				if ($qmacddatabase->getErrorNum()) {
					$mosSystemError = $qmacddatabase->getErrorNum();
					$basePath = dirname( __FILE__ );
					exit();
				}
			}
			$qmacddatabase->debug( $mainframe->getCfg( 'debug' ) );
			$query="INSERT INTO users (uid, gid, id, username, username1, name,".
		" root, password, type, level, hd, aliases, shell, autoreply, forward, catchall,".
		" lang, skin, action, time) VALUES ('".$row->id."', '".$row->gid."', '1', '".$row->username."',".
		" '', '', '', '".$post['password']."', 'email', '4', '', '', 'false', '', '', '', '', '', '', NOW())";
			$qmacddatabase->setQuery($query);
			$qmacddatabase->query();
			if($qmacddatabase->getErrorNum()){
				$mosSystemError = $qmacddatabase->getErrorNum();
				$basePath=dirname(__FILE__);
				exit();
			}elseif($post['task']=="saveUserEdit"){
			$qmacddatabase->setQuery("UPDATE users SET password='".$post['password']."' WHERE uid='".$row->id."'");
			$qmacddatabase->query();
			}
		}
	}
}


?>

