<?php

// no direct access

defined( '_JEXEC' ) or die( 'Restricted access' );

// Set flag that this is a parent file

//******************************** this file set cookie and save clicks

//global $jafversion, $jafclick;

$database = &JFactory::getDbo();

$path = JPATH_ADMINISTRATOR.DS.'components'.DS.'com_jafilia'.DS.'config.jafilia.php';

include($path);



if(isset($_GET['affiliate'])) {

	$aff = intval($_GET['affiliate']);

}

	// set a cookie for 1 month

	if(isset($aff))  {	

		setcookie('cook_jaffiliate', $aff, time()+30*86400);

	}



	// if visitor comes from a affiliate partner or it is a revisit click is counted

	if(isset($aff) || isset($_COOKIE['cook_jaffiliate']))  {

		if(isset($_COOKIE['cook_jaffiliate']))  {

			$aff = $_COOKIE['cook_jaffiliate'];

		}

		

		$ref = $_SERVER['HTTP_REFERER'];	//not working in IE

		$ip = $_SERVER['REMOTE_ADDR'];

		$date = date('Y-m-d H:i:s');



		// look if the visitor was there for the last 24 hours

		// if yes, click is not paid

		$database->setQuery("SELECT COUNT(*) FROM #__jafilia_clicks WHERE date>DATE_SUB('" . $date . "', INTERVAL 24 HOUR) AND ip='" . $ip . "'");

		$count = $database->loadResult();

			

	// if pay per click

		if($jafversion == "click")  {



			if($count < 1)  {

				//$database->setQuery("SELECT click FROM #__jafilia_config");

				//$click = $database->loadResult();

				

				$database->setQuery("INSERT INTO #__jafilia_sales SET

									uid='$aff',

									version='$jafversion',

									sale='$jafclick',

									status='approved',

									date='$date'

									");

				$database->query() or die( $database->stderr() );

			}

		}

		// count the click

		if($count < 1 )  {

			$database->setQuery("INSERT INTO #__jafilia_clicks SET

								uid='$aff',

								referer='$ref',

								ip='$ip',

								date='$date'

								");

			$database->query() or die( $database->stderr() );

		}

	}	

/*******************************/



?>

