<?php
//v2.3.0
defined( '_JEXEC' ) or die( 'Restricted access' );

$ucode1    = $params->get('ucode1');
$disusers  = $params->get('disusers');
$keyword1  = $params->get('keyword1');
$keyword2  = $params->get('keyword2');
$referrer1 = $params->get('referrer1');
$referrer2 = $params->get('referrer2');
$sampler   = $params->get('sampler');
$search    = $params->get('search');
$search1   = $params->get('search1');
$search2   = $params->get('search2');
$session   = $params->get('session');
$subdroot  = $params->get('subdroot');
$subdtrack = $params->get('subdtrack');
$trbrowse  = $params->get('trbrowse');
$trcookie  = $params->get('trcookie');
$trdl      = $params->get('trdl');
$trdlname  = $params->get('trdlname');
$trext     = $params->get('trext');
$trflash   = $params->get('trflash');
$trlink    = $params->get('trlink');
$trlkname  = $params->get('trlkname');
$trmail    = $params->get('trmail');
$trmlname  = $params->get('trmlname');
$trtitle   = $params->get('trtitle');
$trueloc   = $params->get('trueloc');
$truncurl  = $params->get('truncurl');
$truser    = $params->get('truser');
$userlist  = explode('|',$params->get('userlist'));

$uri    = JURI::base();
$user   = JFactory::getUser();
$output = '';

if($disusers==1 && $user->username) {
	$halt = 1;
} else if($disusers==2) {
	$halt = 0;
	$nousers = sizeof($userlist);
	for ($i = 0; $i < $nousers; $i++) {
		if($user->username==$userlist[$i]){
			$halt = 1;
		}
	}
} else {
	$halt = 0;
}

if($ucode1 && $halt==0) {
	if($trdl==1 || $trlink==1 || $trmail==1) {
	$output = "<script type=\"text/javascript\">\n";
	$output .= "var pv = new Array(".$trdl.",".$trmail.",".$trlink.",".$truncurl.",".$trueloc.");\n";
	$output .= "var trdlname = \"".$trdlname."\";\n";
	$output .= "//<![CDATA[\n"; 
	$output .= "var regex = /\.(?:".$trext.")($|\&|\?)/;\n";
	$output .= "//]]>\n";
	$output .= "var trlkname = \"".$trlkname."\";\n";
	$output .= "var trmlname = \"".$trmlname."\";\n";
	$output .= "</script>\n";
	$output .= "<script type=\"text/javascript\" src=\"".$uri."modules/".$module->module."/gatr.js\"></script>\n";
	}
	$output .= "<script type=\"text/javascript\">\n";
	$output .= "var gaJsHost = ((\"https:\" == document.location.protocol) ? \"https://ssl.\" : \"http://www.\");\n";
	$output .= "document.write(unescape(\"%3Cscript src='\" + gaJsHost + \"google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E\"));\n";
	$output .= "</script>\n";
	$output .= "<script type=\"text/javascript\">\n";
	$output .= "try {\n";
	$output .= "var pageTracker = _gat._getTracker(\"".$ucode1."\");\n";
	if($subdtrack==1) {
		$output .= "pageTracker._setDomainName(\"".$subdroot."\");\n";
	}
	if($search1 && $search2) {
		$output .= "pageTracker._addOrganic(\"".$search1."\", \"".$search2."\");\n";
	}
	if($session) {
		$output .= "pageTracker._setSessionTimeout(\"".$session."\");\n";
	}
	if($trbrowse==0) {
		$output .= "pageTracker._setClientInfo(false);\n";
	}
	if($trcookie==0) {
		$output .= "pageTracker._setAllowHash(false);\n";
	}
	if($trflash==0) {
		$output .= "pageTracker._setDetectFlash(false);\n";
	}
	if($trtitle==0) {
		$output .= "pageTracker._setDetectTitle(false);\n";
	}
	if($sampler) {
		$output .= "pageTracker._setSampleRate(".$sampler.");\n";
	}
	if($keyword1 && $keyword2) {
		$output .= "pageTracker._addIgnoredOrganic(\"".$keyword1."\",\"".$keyword2."\");\n";
	}
	elseif($keyword1) {
		$output .= "pageTracker._addIgnoredOrganic(\"".$keyword1."\");\n";
	}
	if($referrer1 && $referrer2) {
		$output .= "pageTracker._addIgnoredRef(\"".$referrer1."\",\"".$referrer2."\");\n";
	}
	elseif($referrer1) {
		$output .= "pageTracker._addIgnoredRef(\"".$referrer1."\");\n";
	}
	$output .= "pageTracker._initData();\n";
	if (JApplication::getCfg("sef") == '1') {
		$is_com_search = false;
		$search_value = null;
		foreach ( JRequest::get('GET') as $key=>$value ) {
	    	if ($key == 'option' && $value == 'com_search') {
				$is_com_search = true;
			}
	    	else if ($key == 'searchword') {
				$search_value = $value;
			}
	    }
	    if ($is_com_search)
	    	$output .= "pageTracker._trackPageview(\"/search?searchword=".$search_value."\");\n";
	}
	$output .= "pageTracker._trackPageview();\n";
	if($truser==1) {
		if($user->guest) {
			$output .= "pageTracker._setVar(\"Guest\");\n";
		} else {
			$output .= "pageTracker._setVar(\"".$user->username."\");\n";
		}
	}
	$output .= "} catch(err) {}\n";
	$output .= "</script>\n";
	echo $output;
}
?>