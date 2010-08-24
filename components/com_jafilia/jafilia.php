<?php
/**
 * @version $Id: header.php 789 2009-01-26 15:56:03Z elkuku $
 * @package    Jafilia
 * @subpackage
 * @author     EasyJoomla {@link http://www.easy-joomla.org Easy-Joomla.org}
 * @author     Arkadiusz Maniecki {@link http://www.jafilia.pl}
 * @author     Created on 08-Apr-2009
 */
//error_reporting(E_ALL);
//--No direct access
defined( '_JEXEC' ) or die( '=;)' );
include( JPATH_ADMINISTRATOR.DS."components".DS."com_jafilia".DS."helpers".DS."version.php" );
$JAFVERSION =& new jafVersion();
$shortversion = $JAFVERSION->RELEASE . " " . $JAFVERSION->DEV_STATUS; //. " " . $JAFVERSION->REVISION;
JRequest::setVar( 'JAF_COMP_VERSION', $shortversion );
/**********/
		/*
			P  	Pending
			C 	Confirmed
			X 	Cancelled
			R 	Refunded
			S 	Shipped	
		*/
		$db = &JFactory::getDbo();
		$db2 = &JFactory::getDbo();
		$db3 = &JFactory::getDbo();
		$query="SELECT * FROM #__jafilia_sales WHERE version='sale'";
		$db->setQuery($query);						
		$rows = $db->loadObjectList();
		foreach ($rows as $row)	{
			$query2="SELECT order_status FROM #__vm_orders WHERE order_id=".$row->order." LIMIT 1";	//order_status
			$db2->setQuery($query2);						
			$rsta = $db2->loadResult();
			//echo"<hr>".$row->order." - ".$rsta." = ".$row->status;
			switch ($rsta) {
				case "P":
				if ($row->status!="open") {
				$sql = 'UPDATE `#__jafilia_sales` SET `status` = \'open\' WHERE `order` = '.$row->order.' LIMIT 1;'; 
				//echo"<hr>".$sql;
				$db3->setQuery($sql);
					if (!$db3->query()) {
					//echo'nie zapisano zmiany';
					}
					//else echo 'zapisano';
				}
				break;
				case "C":
				if ($row->status!="approved") {
				$sql = 'UPDATE `#__jafilia_sales` SET `status` = \'approved\' WHERE `order` = '.$row->order.' LIMIT 1;'; 
				//echo"<hr>".$sql;
				$db3->setQuery($sql);
					if (!$db3->query()) {
					//echo'nie zapisano zmiany';
					}
					//else echo 'zapisano';
				}
				break;
				case "X":
				if ($row->status!="canceled") {
				$sql = 'UPDATE `#__jafilia_sales` SET `status` = \'canceled\' WHERE `order` = '.$row->order.' LIMIT 1;'; 
				//echo"<hr>".$sql;
				$db3->setQuery($sql);
					if (!$db3->query()) {
					//echo'nie zapisano zmiany';
					}
					//else echo 'zapisano';
				}
				break;
			}
		}
/*********/
$urlhelpers = JUri::base(true);
$pathc = JPATH_SITE;
$admpath = JPATH_ADMINISTRATOR;
$db = &JFactory::getDbo();
$db->setQuery("SELECT id FROM #__menu WHERE link='index.php?option=com_jafilia'");
$itemid = $db->loadResult();
global $Itemid;
$language =& JFactory::getLanguage();
$language->load('com_jafilia');
$path = JPATH_ADMINISTRATOR.DS.'components'.DS.'com_jafilia'.DS.'config.jafilia.php';
include($path);
//require_once(JPATH_ADMINISTRATOR.DS.'components'.DS.'com_jafilia'.DS.'config.jafilia.php');//include
require_once(JPATH_ADMINISTRATOR.DS."components".DS."com_jafilia".DS."helpers".DS."jafilia.class.php");
JTable::addIncludePath(JPATH_SITE.DS.'components'.DS.'com_jafilia'.DS.'tables');
$row =& JTable::getInstance('jafilia_user', 'Table');
JRequest::setVar( 'shortdesc', $jafshortdesc );

JRequest::setVar( 'terms', $jafterms );
JRequest::setVar( 'reglink', $jafloginmod );
JRequest::setVar( 'db', $db );
JRequest::setVar( 'jaftpl', $jaftemplate );
JRequest::setVar( 'jaadminmail', $jafadminmail );
//echo"<hr>".$jaftemplate;
$my = &JFactory::getUser();
$user = new cluserdata($my->id);
$tpl = array(
			'L-REFERES'	=> JRoute::_("index.php?option=com_jafilia&task=referes&Itemid=".$Itemid),
			'L-LEADS'	=> JRoute::_("index.php?option=com_jafilia&task=leads&Itemid=".$Itemid),
			'L-OV'		=> JRoute::_("index.php?option=com_jafilia&Itemid=".$Itemid),
			'L-PAYOUT'	=> JRoute::_("index.php?option=com_jafilia&task=payouts&Itemid=".$Itemid),
			'L-BANNER'	=> JRoute::_("index.php?option=com_jafilia&task=banner&Itemid=".$Itemid),
			'L-DETAILS'	=> JRoute::_("index.php?option=com_jafilia&task=userdetails&Itemid=".$Itemid)
);
JRequest::setVar( 'tpl', $tpl );

switch($task) {

	default:

	$my = &JFactory::getUser();
	$mainframe->setPageTitle(JText::_('JAF_COM_TITLE'));

		if ($my->aid == 1 || $my->aid == 2)  {	// changed gid to aid
			$db->setQuery("SELECT COUNT(*) FROM #__jafilia_user WHERE uid='".$my->id."'");
			$result = $db->loadResult();
			if($result)  {
				JAFmainpage();
			} else {				
				$app = &JFactory::getApplication();
				$app->redirect(JRoute::_("index.php?option=com_jafilia&task=register&Itemid=".JRequest::getVar('Itemid')));
			}
		} else {
			JAFnotauth();
		}	
	break;
	
	case "register":
	$my = &JFactory::getUser();
	$mainframe->setPageTitle(JText::_('JAF_REGISTRATION'));
		if ($my->aid == 1 || $my->aid == 2)  {
			JAFregister();
		} else {
			JAFnotauth();
		}
	break;
	
	case "save":
	$my = &JFactory::getUser();
		if ($my->aid == 1 || $my->aid == 2)  {
			JAFsave();
		} else {
			JAFnotauth();
		}
	break;
	
	case "referes":
	$my = &JFactory::getUser();
	$mainframe->setPageTitle(JText::_('JAF_COM_TITLE'). " - " . JText::_('JAF_REFERER'));
		if ($my->aid == 1 || $my->aid == 2)  {
			JAFshowreferes();
		} else {
			JAFnotauth();
		}
	break;
	
	case "leads":
	$my = &JFactory::getUser();
	$mainframe->setPageTitle(JText::_('JAF_COM_TITLE'). " - " . JText::_('JAF_AMOUNTS'));
		if ($my->aid == 1 || $my->aid == 2)  {
			JAFshowleads();
		} else {
			JAFnotauth();
		}
	break;
	
	case "payouts":
	$my = &JFactory::getUser();
	$mainframe->setPageTitle(JText::_('JAF_COM_TITLE'). " - " . JText::_('JAF_PAYOUTS'));
		if ($my->aid == 1 || $my->aid == 2)  {
			JAFpayouts();
		} else {
			JAFnotauth();
		}
	break;
	
	case "banner":
	$my = &JFactory::getUser();
	$mainframe->setPageTitle(JText::_('JAF_COM_TITLE'). " - " . JText::_('JAF_LINKS'));
		if ($my->aid == 1 || $my->aid == 2)  {
			JAFbanner();
		} else {
			JAFnotauth();
		}
	break;
	
	case "userdetails":
	$my = &JFactory::getUser();
	$mainframe->setPageTitle(JText::_('JAF_COM_TITLE'). " - " . JText::_('JAF_DETAILS'));
		if ($my->aid == 1 || $my->aid == 2)  {
			JAFuserdetails();
		} else {
			JAFnotauth();
		}
	break;
	case "insidemodal":
		insideModal();
	break;	
	case "generatepdf":
		generatePDF();
	break;
	
		
}
/*******/
function insideModal()
{
	$TERMS = JRequest::getVar('terms');
	echo'
	<div style="padding:15px;">'.$TERMS.'</div>
	';

}
/*******/
function generatePDF()
{
		global $mainframe;
		jimport('joomla.filesystem.folder');
		$lang =& JFactory::getLanguage();
		$langTag = $lang->getTag();
		if( !JFolder::exists( JPATH_BASE.DS.'language'.DS.$langTag )) { $langTag = 'en-GB'; }
		$lang->setLanguage($langTag);
		$lang->load();
		$lang->_metadata['pdffontname'] = 'freesans';
		$lang->load('joomla',JPATH_BASE,$langTag,true);
		$lang->load('com_jafilia',JPATH_BASE,$langTag,true);
		//========================================
		
		$mosConfig_live_site = JUri::base(true);
		//$path = JPATH_ADMINISTRATOR.DS.'helpers'.DS.'jafilia.class.php';
		//$path = 'administrator/components/com_jafilia/helpers/jafilia.class.php';
		//require($path);
		$id = intval($_GET['id']);
		$db = &JFactory::getDbo(); 	
		$db->setQuery("SELECT uid FROM #__jafilia_payings WHERE id='".$id."'");
		$uid = $db->loadResult();	
		$db->setQuery("SELECT * FROM #__vm_vendor");
		$vendor = $db->loadRow();
		$vendor_adress = '';
		$vendor_adress .= $vendor[1] . "<br>";
		$vendor_adress .= $vendor[11] . "<br>";
		$vendor_adress .= "<br>";
		$vendor_adress .= $vendor[16] . " " . $vendor[13];
		$user = new cluserdata($uid);
		$user->getSinglePayout($id, $uid);
		$payout = $user->singlepayout;
		$date = JText::_('JAF_DATE'). " " . JHTML::_('date', $payout[4], '%d.%m.%Y');
		$paying = JText::_('JAF_PAYOUT') . " #: " . $payout[0];
		$user->userdata($uid);
		$partner = $user->data;//$user->get('Data');
		$partner_adr = '';
		$partner_adr .= $partner[2] . " " . $partner[3] . "<br>";
		$partner_adr .= $partner[4] . "<br>";
		$partner_adr .= "<br>";
		$partner_adr .= $partner[5] . " " . $partner[6];	
		$amount = $payout[2] . " " . $user->getCurrency();
		//echo "[<pre>".$id."|".print_r($partner)."|".$uid."</pre>]";
		$id = intval($_GET['id']);
		//==============================================
		$document = &JFactory::getDocument();
		$document->setTitle($mosConfig_live_site.': '.JText::_('JAF_PAYOUT'));
		$document->setName("alias_test_pdf");
		$document->setHeader($date);
		$jafpdftext = '';
		$jafpdftext .= $vendor_adress;
		$jafpdftext .= '<br><br><br><br><br><br>';
		$jafpdftext .= $partner_adr;
		$jafpdftext .= '<br><br><br><br><br><h1>';
		$jafpdftext .= $paying;
		$jafpdftext .= '</h1><hr><table width="100%" border="0"><tr><td>';
		$jafpdftext .= JText::_('JAF_YOUR_AMOUNT').':';
		$jafpdftext .= '</td><td>';
		$jafpdftext .= $amount;
		$jafpdftext .= '</td></tr></table><hr><br>';
		$jafpdftext .= JText::_('JAF_THANX');
		echo $jafpdftext; 

}
/*******/
/**
* shows a short description to unregistert users
**/
function JAFnotauth()  {
	$jaftpl = JRequest::getVar('jaftpl');
	$db = JRequest::getVar('db');
	$jaloginmod = JRequest::getVar('reglink');
	//$SHORTDESC = JRequest::getVar('shortdesc');
	$path = JPATH_ADMINISTRATOR.DS.'components'.DS.'com_jafilia'.DS.'config.jafilia.php';
	include($path);
	$SHORTDESC = $jafshortdesc;
	//echo"<hr>".$jafshortdesc."<hr>";
	$db->setQuery("SELECT id FROM #__menu WHERE link='index.php?option=com_virtuemart'");
	$vmitemid = $db->loadResult();	

	if($jaloginmod == "VM")  {
		$REGLINK = JRoute::_('index.php?option=com_virtuemart&page=shop.registration&Itemid='.$vmitemid);
	} else {		
		$REGLINK = JRoute::_('index.php?option=com_user&task=register');
	}
	include('templates'.DS.$jaftpl.DS.'notAuth.tpl');
	include('templates'.DS.$jaftpl.DS.'footer.tpl');
}
/**
* shows the registration form for new affiliate partners
**/
function JAFregister()  {
$jaftpl = JRequest::getVar('jaftpl');
$my = &JFactory::getUser();
$db = JRequest::getVar('db');
$STYLE= JRequest::getVar('STYLE');
$JS=JRequest::getVar('JS'); 
$jaloginmod = JRequest::getVar('reglink');

	if($jaloginmod == "VM") {
		//$REGLINK = JRoute::_('index.php?option=com_virtuemart&page=shop.registration&Itemid='.$vmitemid);
		$db->setQuery("SELECT * FROM #__vm_user_info WHERE user_id='".$my->id."'");
		$userdetails = $db->loadObjectList();
		/*
		echo"<hr><pre>";
		print_r($userdetails);
		echo"</pre><hr>";
		*/
		foreach($userdetails as $detail) {
			$FNAME=$detail->first_name;
			$LNAME=$detail->last_name;
			$STREET=$detail->address_1;
			$ZIP=$detail->zip;
			$CITY=$detail->city;
			$STATE=$detail->state;
			$EMAIL=$detail->user_email;
			$FON=$detail->phone_1;
			$BNAME=$detail->bank_name;
			$BLZ=$detail->bank_sort_code;
			$BACCOUNT=$detail->bank_account_nr;
		}			
	} else {		
		//$REGLINK = JRoute::_('index.php?option=com_user&task=register');
		/*
		echo"<hr><pre>";
		print_r($my);
		echo"</pre><hr>";
		*/
		$FNAME=$my->name;
		$LNAME=$my->username;
		$STREET="";
		$ZIP="";
		$CITY="";
		$STATE="";
		$EMAIL=$my->email;
		$FON="";
		$BNAME="";
		$BLZ="";
		$BACCOUNT="";		
	}
	$UID = $my->id;
	$TERMS = JRequest::getVar('terms');
	
	include('templates'.DS.$jaftpl.DS.'registerForm.tpl');
	include('templates'.DS.$jaftpl.DS.'footer.tpl');	
	// Backbutton anzeigen
}
/**
* saves a new registration
**/
function JAFsave()  {
	//global $tpl;
	global $mainframe, $pathc;
	$jaadminmail = JRequest::getVar( 'jaadminmail');

	JTable::addIncludePath(JPATH_COMPONENT.DS.'tables');
	$row = JTable::getInstance('jafilia_user', 'table');
	
	if(!$row->bind($_POST)) {
		echo "<script>alert(".$row->getError().");
		window.history.go(-1);</script>\n";
		exit();
	}
	if(!$row->store()) {
		echo "<script>alert(".$row->getError().");
		window.history.go(-1);</script>\n";
		exit();
	}
	else
	{
		if(isset($_POST['submit']))  {		
			$subject = JText::_('JAF_MAIL_SUBJECT');
			$message = sprintf(JText::_('JAF_MAIL_NEWUSER'), "\n".JURI::root()."administrator/index.php?option=com_jafilia&controller=user\n");
			$MailFrom	= $mainframe->getCfg('mailfrom');
			$FromName	= $mainframe->getCfg('fromname');
			$SiteName	= $mainframe->getCfg('sitename');
			if ($jaadminmail=="youremailname@yourdomain.com") $jaadminmail=$MailFrom;
			/*
			echo"<hr>1 ".$MailFrom; 
			echo"<hr>2 ".$FromName; 
			echo"<hr>3 ".$jaadminmail;
			echo"<hr>4 ".$subject;
			echo"<hr>5 ".$message;
			*/
			JUtility::sendMail($MailFrom, $FromName, $jaadminmail, $subject, $message);
		}		
		$mainframe->redirect('index.php?option=com_jafilia&task=mainpage',JText::_('JAF_SAVED'));
	}	
}

/**
*
* shows the mainpage  with the overview
*
*/
function JAFmainpage() {
global $mainframe;
	$jaftpl = JRequest::getVar('jaftpl');
	$tpl = JRequest::getVar('tpl');
	$my = &JFactory::getUser();
	$user = new cluserdata($my->id);	
	
	drawGraphClickSale($my->id);
	drawGraphFees($my->id);
	
	$clicks = $user->countClicks($my->id);
	$leads = $user->countLeads($my->id);
	if($clicks && $leads)  {
		$conversion = round((100/$clicks)*$leads,2);
	}
	else {
		$conversion = 0;
	}
	$currency = $user->getCurrency();
	$openAmount = $user->countOpenAmount($my->id);
	$amount = $user->countAmountAll($my->id);
	
	$urlb = JUri::base(true);
	$CLICKS=$clicks;
	$LEADS=$leads;
	$CONV=$conversion . " %";
	$OPEN=$openAmount . " " . $currency;
	$AMOUNT=$amount . " " . $currency;
	$GRAPH="<img src='".$urlb."/components/com_jafilia/images/clicksales_".$my->id.".png'>";
	$FEES="<img src='".$urlb."/components/com_jafilia/images/fees_".$my->id.".png'>";

	include('templates'.DS.$jaftpl.DS.'header.tpl');
	include('templates'.DS.$jaftpl.DS.'navigation.tpl');	
	include('templates'.DS.$jaftpl.DS.'overview.tpl');
	include('templates'.DS.$jaftpl.DS.'footer.tpl');	
}

/**
*
* shows the referes
*
*/
function JAFshowreferes() {
global $my, $mainframe, $params, $mosConfig_list_limit;
	$jaftpl = JRequest::getVar('jaftpl');
	$tpl = JRequest::getVar('tpl');
	$my = &JFactory::getUser();
	$user = new cluserdata($my->id);	
require_once( JPATH_SITE.DS.'includes'.DS.'pageNavigation.php' );

$app = &JFactory::getApplication();
$mosConfig_list_limit = $app->getCfg('list_limit');
	
	$limit = JRequest::getVar('limit', $mosConfig_list_limit);
	$limitstart = JRequest::getVar('limitstart', 0);

	$total = $user->countClicks($my->id);

	$pageNav = new mosPageNav( $total, $limitstart, $limit );
	$link = "index.php?option=com_jafilia&task=referes&Itemid=JRequest::getVar('Itemid')";
		
			$LIMIT=$limit;
			$LIMITSTART=$limitstart;
			$TOTAL=$total;
			$PAGENAV=$pageNav->writePagesLinks( $link );
			$BOX=JText::_('JAF_DISPLAY') . $pageNav->getLimitBox( $link );

	$db = &JFactory::getDbo();
	$query="SELECT * FROM #__jafilia_clicks WHERE uid='".$my->id."' 
						ORDER BY date DESC 
						LIMIT $limitstart, $limit";
	$db->setQuery($query);						
	$rows = $db->loadObjectList();
	include('templates'.DS.$jaftpl.DS.'header.tpl');
	include('templates'.DS.$jaftpl.DS.'navigation.tpl');	
	include('templates'.DS.$jaftpl.DS.'referes.tpl');
	include('templates'.DS.$jaftpl.DS.'footer.tpl');	
}

/**
*
* shows the leads
*
*/
function JAFshowleads()  {
global $params, $mosConfig_list_limit, $_JAF_APPROVED, $_JAF_OPEN;
	$jaftpl = JRequest::getVar('jaftpl');
	$tpl = JRequest::getVar('tpl');
	$my = &JFactory::getUser();
	$user = new cluserdata($my->id);
	$db = &JFactory::getDbo();
require_once( JPATH_SITE.DS.'includes'.DS.'pageNavigation.php' );

$app = &JFactory::getApplication();
$mosConfig_list_limit = $app->getCfg('list_limit');
	
	$limit = JRequest::getVar('limit');
	$limitstart = JRequest::getVar('limitstart');	
	
	if (!$limit) $limit = $mosConfig_list_limit;
	if (!$limitstart) $limitstart = 0;

	$total = $user->countOpenAmount($my->id);
	$currency = $user->getCurrency();

	$pageNav = new mosPageNav( $total, $limitstart, $limit );
	$link = "index.php?option=com_jafilia&task=leads&Itemid=JRequest::getVar('Itemid')";

			$LIMIT=$limit;
			$LIMITSTART=$limitstart;
			$TOTAL=$total;
			$PAGENAV=$pageNav->writePagesLinks( $link );
			$BOX=JText::_('JAF_DISPLAY') . $pageNav->getLimitBox( $link );
	
	$db->setQuery("SELECT * FROM #__jafilia_sales WHERE uid='".$my->id."'  
						ORDER BY date DESC 
						LIMIT $limitstart, $limit"
						);
						
	$rows = $db->loadObjectList();
	include('templates'.DS.$jaftpl.DS.'header.tpl');
	include('templates'.DS.$jaftpl.DS.'navigation.tpl');	
	include('templates'.DS.$jaftpl.DS.'leads.tpl');
	include('templates'.DS.$jaftpl.DS.'footer.tpl');	
}

/**
*
* shows the payings
*
*/
function JAFpayouts() {
global $params, $mosConfig_list_limit;
	$jaftpl = JRequest::getVar('jaftpl');
	$tpl = JRequest::getVar('tpl');
	$my = &JFactory::getUser();
	$user = new cluserdata($my->id);
	$db = &JFactory::getDbo();
require_once( JPATH_SITE.DS.'includes'.DS.'pageNavigation.php' );
	
$app = &JFactory::getApplication();
$mosConfig_list_limit = $app->getCfg('list_limit');
	
	$limit = JRequest::getVar('limit');
	$limitstart = JRequest::getVar('limitstart');	
	if (!$limit) $limit = $mosConfig_list_limit;
	if (!$limitstart) $limitstart = 0;
	
	$total = $user->getPayouts($my->id);
	$currency = $user->getCurrency();
	
	$pageNav = new mosPageNav( $total, $limitstart, $limit );
	$link = "index.php?option=com_jafilia&task=payouts&Itemid=JRequest::getVar('Itemid')";

			$LIMIT=$limit;
			$LIMITSTART=$limitstart;
			$TOTAL=$total;
			$PAGENAV=$pageNav->writePagesLinks( $link );
			$BOX=JText::_('JAF_DISPLAY') . $pageNav->getLimitBox( $link );
		
	$db->setQuery("SELECT * FROM #__jafilia_payings WHERE uid='".$my->id."' 
						ORDER BY date DESC 
						LIMIT $limitstart, $limit"
						);
						
	$rows = $db->loadObjectList();

	include('templates'.DS.$jaftpl.DS.'header.tpl');
	include('templates'.DS.$jaftpl.DS.'navigation.tpl');	
	include('templates'.DS.$jaftpl.DS.'payouts.tpl');
	include('templates'.DS.$jaftpl.DS.'footer.tpl');		
}


function JAFbanner()  {
global $params, $mosConfig_list_limit, $mosConfig_live_site;
	$jaftpl = JRequest::getVar('jaftpl');
	$tpl = JRequest::getVar('tpl');
	$my = &JFactory::getUser();
	$user = new cluserdata($my->id);
	$db = &JFactory::getDbo();
require_once( JPATH_SITE.DS.'includes'.DS.'pageNavigation.php' );
	
$app = &JFactory::getApplication();
$mosConfig_list_limit = $app->getCfg('list_limit');
	
	$limit = JRequest::getVar('limit');
	$limitstart = JRequest::getVar('limitstart');
	if (!$limit) $limit = $mosConfig_list_limit;
	if (!$limitstart) $limitstart = 0;
	
	$db->setQuery("SELECT COUNT(*) FROM #__jafilia_banner");
	$total = $db->loadResult();
	
	$pageNav = new mosPageNav( $total, $limitstart, $limit );
	$link = "index.php?option=com_jafilia&task=banner&Itemid=JRequest::getVar('Itemid')";

			$LIMIT=$limit;
			$LIMITSTART=$limitstart;
			$TOTAL=$total;
			$PAGENAV=$pageNav->writePagesLinks( $link );
			$BOX=JText::_('JAF_DISPLAY') . $pageNav->getLimitBox( $link );
			
	$db->setQuery("SELECT * FROM #__jafilia_banner WHERE published='1'
						ORDER BY version DESC
						LIMIT $limitstart, $limit"
						);
						
	$rows = $db->loadObjectList();
	include('templates'.DS.$jaftpl.DS.'header.tpl');
	include('templates'.DS.$jaftpl.DS.'navigation.tpl');	
	include('templates'.DS.$jaftpl.DS.'banner.tpl');
	include('templates'.DS.$jaftpl.DS.'footer.tpl');		
}

function JAFuserdetails()  {

	$jaftpl = JRequest::getVar('jaftpl');
	$tpl = JRequest::getVar('tpl');
	$my = &JFactory::getUser();
	$db = &JFactory::getDbo();	
	$user = new cluserdata($my->id);

	$user->userdata($my->id);
	$row = $user->data;

		$STREET=$row[4];
		$ZIP=$row[5];
		$LOCAT=$row[6];
		$MAIL=$row[7];
		$FON=$row[8];
		$WEB=$row[9];
		$BANK=$row[10];
		$BLZ=$row[11];
		$KONTO=$row[12];
		$ID=$row[0];
		$UID=$my->id;
		$PAYPAL=$row[14];
		$STATE=$row[15];

	include('templates'.DS.$jaftpl.DS.'header.tpl');
	include('templates'.DS.$jaftpl.DS.'navigation.tpl');	
	include('templates'.DS.$jaftpl.DS.'userdetails.tpl');
	include('templates'.DS.$jaftpl.DS.'footer.tpl');	
	
	if(isset($_POST['submit']))  {
		//$row = new JAffiliate_user($db);					
	JTable::addIncludePath(JPATH_COMPONENT.DS.'tables');
	$row = JTable::getInstance('jafilia_user', 'table');		
		
		if(!$row->bind($_POST)) {
			echo "<script>alert(".$row->getError().");
			window.history.go(-1);</script>\n";
			exit();
		}
		
		if(!$row->store()) {
			echo "<script>alert(".$row->getError().");
			window.history.go(-1);</script>\n";
			exit();
		}
		//mosRedirect(JRoute::_("index.php?option=com_jafilia&task=userdetails&Itemid=".JRequest::getVar('Itemid')."&mosmsg=details+updated"));
		$app = &JFactory::getApplication();
		$app->redirect("index.php?option=com_jafilia&task=userdetails&Itemid=".JRequest::getVar('Itemid'), JText::_('JAF_DETAILS').": ".JText::_('JAF_UPDATED'));

	}
}
?>