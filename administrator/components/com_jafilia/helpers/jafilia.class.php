<?php
defined( '_JEXEC' ) or die( 'Direct Access to this location is not allowed.' );
/**
* Affiliate Component for Virtue Mart
* 
* @package Jaffilia
* @version 1.0 RC2
* @author Michael
* @date 09/08/2008
* @copyright Michael Pfister <info@mp-development.de>
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
*
*/
error_reporting(E_ALL);
/**
*
* functions for graph drawing
*
*/
// draws a graph with clicks and sales over all years
$urlhelpers = JUri::base(true);
$pathc = JPATH_SITE;
//JPATH_SITE = JPATH_ADMINISTRATOR;
$db = &JFactory::getDbo();
//====================================
/**
*
* class userdata
*
* different functions to get all usefull data of a partner
*
* @var id = user(affiliate partner) id
*
*/
class cluserdata {

	// user id
	var $id;
	
	// get the currency of the shop owner
	function getCurrency()  {
	$db = &JFactory::getDbo();
	
		$this->query =$db->setQuery("SELECT vendor_currency FROM #__vm_vendor");
		$this->currency = $db->loadResult($this->query);
		return $this->currency;
	}
	

	// read all userdata from DB
	function userdata($id)  {
		//$urlhelpers = JUri::base(true);
		//JPATH_SITE = JPATH_ADMINISTRATOR;
		$db = &JFactory::getDbo();
		
		$this->query = $db->setQuery("SELECT * FROM #__jafilia_user WHERE uid='".$id."'");
		//echo"<hr>SELECT * FROM #__jafilia_user WHERE uid=".$id."<hr>";
		$this->data = $db->loadRow($this->query);//$db->loadObjectList($this->query);
		//echo"<hr>row='".print_r($this->data)."'<hr>";
	}
	
	// count all referer clicks from a partner
	function countClicks($id)  {
	$db = &JFactory::getDbo();
		
		$this->query = $db->setQuery("SELECT COUNT(id) FROM #__jafilia_clicks WHERE uid='" . $id . "'");
		$this->clicks = $db->loadResult($this->query);
		return $this->clicks;	
		
	}
	
	// count all amounts from a partner
	function countLeads($id)  {
	$db = &JFactory::getDbo();
		
		$this->query = $db->setQuery("SELECT COUNT(id) FROM #__jafilia_sales WHERE uid='" . $id . "'");
		$this->leads = $db->loadResult($this->query);
		return $this->leads;
	}
	
	// count all open amounts from a partner
	function countOpenAmount($id)  {
	$db = &JFactory::getDbo();
	
		$this->query = $db->setQuery("SELECT SUM(sale) FROM #__jafilia_sales WHERE uid='".$id."' AND status='approved' AND paid='0'");
		$this->amount = $db->loadResult($this->query);
		return $this->amount;
	}
	
	// count all paid amounts from a partner
	function countAmountAll($id)  {
	$db = &JFactory::getDbo();
	
		$this->query = $db->setQuery("SELECT SUM(amount) FROM #__jafilia_payings WHERE uid='".$id."'");
		$this->payings = $db->loadResult($this->query);
		return $this->payings;
	}
	
	function getReferes($id)  {
	$db = &JFactory::getDbo();
	
		$this->query = $db->setQuery("SELECT * FROM #__jafilia_clicks WHERE uid='".$id."' ORDER BY date DESC");
		$this->referes = $db->loadObjectList($this->query);
	}
	
	/**
	*
	* do all the payout stuff
	* update the sales and set the paid sales to paid
	* wrights a new payout to the DB
	*
	*/
	function doPayOut($id)  {
	$db = &JFactory::getDbo();
		
		$date = date('Y-m-d');
	
		$this->query = $db->setQuery("SELECT SUM(sale) FROM #__jafilia_sales WHERE uid='".$id."' AND status='approved' AND paid='0'");
		$this->amount = $db->loadResult($this->query);
		
		$db->setQuery("UPDATE #__jafilia_sales SET
							paid='1'
							WHERE uid='".$id."'
							AND status='approved'
							AND paid='0'
							");
		$db->Query();
							
		$db->setQuery("INSERT INTO #__jafilia_payings SET
							uid='$id',
							amount='".$this->amount."',
							status='0',
							date='$date'
							");
		$db->Query();
	
	}
	
	// gets all payouts for one partner
	function getPayouts($id)  {
	$db = &JFactory::getDbo();
	
		$this->query = $db->setQuery("SELECT * FROM #__jafilia_payings WHERE uid='".$id."'");
		$this->payouts = $db->loadObjectList($this->query);
	
	}
	
	function getSinglePayout($id, $uid)  {
	$db = &JFactory::getDbo();
	
		$this->query = $db->setQuery("SELECT * FROM #__jafilia_payings WHERE id='".$id."' AND uid='".$uid."'");
		$this->singlepayout = $db->loadRow($this->query);
	
	}
	
}


//====================================
function drawGraphClickSale($id)  {

global $urlhelpers, $db, $jafcscheme;
  // Standard inclusions     
$urlhelpers = JUri::base(true);
//JPATH_SITE = JPATH_ADMINISTRATOR;
$db = &JFactory::getDbo();  
  require_once(JPATH_SITE.DS."components".DS."com_jafilia".DS."assets".DS."pData.class");  
  require_once(JPATH_SITE.DS."components".DS."com_jafilia".DS."assets".DS."pChart.class");  

	 $month = array("01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12");
	 $mnames = array(JText::_('JAF_JAN'),JText::_('JAF_FEB'),JText::_('JAF_MAR'),JText::_('JAF_APR'),JText::_('JAF_MAY'),JText::_('JAF_JUN'),JText::_('JAF_JUL'),JText::_('JAF_AUG'),JText::_('JAF_SEP'),JText::_('JAF_OCT'),JText::_('JAF_NOV'),JText::_('JAF_DEC'));
	 $actmonth = date("m");
	 $date = date('Y-m-d H:i:s');
	 // sort the month array new, so we have it for one year backwarts
	 $month1 = array_slice($month,$actmonth,11);
	 $month2 = array_slice($month,0,$actmonth);
	 foreach($month2 as $key => $element)  {
		$month1[] = $element;
	 }
	 // do the same for the month names
	 $mnames1 = array_slice($mnames,$actmonth,11);
	 $mnames2 = array_slice($mnames,0,$actmonth);
	 foreach($mnames2 as $key => $element)  {
		$mnames1[] = $element;
	 }
	 
	$i = 0;
	$click = array();
	$db = &JFactory::getDbo();
	for($i; $i<=11; $i++)  {
		$m = &$month1[$i];		
		$db->setQuery("SELECT COUNT(*) FROM #__jafilia_clicks WHERE 
							MONTH(date)='".$m."' 
							AND uid='".$id."'
							AND date>DATE_SUB('" . $date . "', INTERVAL 1 YEAR)");
							
		$count = $db->loadResult();
		$click[] = $count;
	}
	$clicks = implode(",", $click);
	
	$i = 0;
	$sales = array();
	for($i; $i<=11; $i++)  {
		$m = &$month1[$i];
		$db->setQuery("SELECT COUNT(*) FROM #__jafilia_sales WHERE 
							MONTH(date)='".$m."' 
							AND uid='".$id."'
							AND date>DATE_SUB('" . $date . "', INTERVAL 1 YEAR)");
							
		$count = $db->loadResult();
		$sales[] = $count;
	}
	$sale = implode(",", $sales);

			  
  // Dataset definition   
  $DataSet = new pData;  
  $DataSet->AddPoint($click,"Serie1");
  $DataSet->AddPoint($sales,"Serie2");  
  $DataSet->AddAllSeries();  
  $DataSet->SetAbsciseLabelSerie(); 
  $DataSet->SetSerieName(JText::_('JAF_CLICKS'),"Serie1");
  $DataSet->SetSerieName(JText::_('JAF_SALE'),"Serie2"); 
  $DataSet->AddPoint($mnames1,"XLabel");
  $DataSet->SetAbsciseLabelSerie("XLabel");
   
   
  // Initialise the graph  
 $Graph = new pChart(500,230);
 $Graph->setFontProperties(JPATH_SITE.DS."components".DS."com_jafilia".DS."assets".DS."Fonts".DS."tahoma.ttf",8); 
 $Graph->loadColorPalette(JPATH_SITE.DS."components".DS."com_jafilia".DS."assets".DS."colorsets".DS.$jafcscheme);
 $Graph->setGraphArea(50,30,480,200);  
 $Graph->drawFilledRoundedRectangle(7,7,693,223,5,240,240,240);  
 $Graph->drawRoundedRectangle(5,5,695,225,5,230,230,230);  
 $Graph->drawGraphArea(255,255,255,TRUE);  
 $Graph->drawScale($DataSet->GetData(),$DataSet->GetDataDescription(),5,150,150,150,TRUE,0,2,TRUE);  
 $Graph->drawGrid(4,TRUE,230,230,230,50);    

 // Draw the 0 line  
 $Graph->drawTreshold(0,143,55,72,TRUE,TRUE);  
  // Draw the line graph  
  $Graph->drawBarGraph($DataSet->GetData(),$DataSet->GetDataDescription(),TRUE);   
   
  // Finish the graph  
  $Graph->drawLegend(65,35,$DataSet->GetDataDescription(),255,255,255);  
  $Graph->drawTitle(60,22,JText::_('JAF_L12'),0,0,0,485);  
  $Graph->Render(JPATH_SITE.DS."components".DS."com_jafilia".DS."images".DS."clicksales_".$id.".png"); 
  
}

// draws a graph with clicks and sales for last 12 month
function drawGraphFees($id)  {
global $urlhelpers, $jafcscheme;
  // Standard inclusions     
$urlhelpers = JUri::base(true);
$jafcscheme			= "softblue.txt";
//JPATH_SITE = JPATH_ADMINISTRATOR;
$db = &JFactory::getDbo();  
  require_once(JPATH_SITE.DS."components".DS."com_jafilia".DS."assets".DS."pData.class");  
  require_once(JPATH_SITE.DS."components".DS."com_jafilia".DS."assets".DS."pChart.class");  

	 $month = array("01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12");
	 $mnames = array(JText::_('JAF_JAN'),JText::_('JAF_FEB'),JText::_('JAF_MAR'),JText::_('JAF_APR'),JText::_('JAF_MAY'),JText::_('JAF_JUN'),JText::_('JAF_JUL'),JText::_('JAF_AUG'),JText::_('JAF_SEP'),JText::_('JAF_OCT'),JText::_('JAF_NOV'),JText::_('JAF_DEC'));
	 $actmonth = date("m");
	 $date = date('Y-m-d H:i:s');
	 // sort the month array new, so we have it for one year backwarts
	 $month1 = array_slice($month,$actmonth,11);
	 $month2 = array_slice($month,0,$actmonth);
	 foreach($month2 as $key => $element)  {
		$month1[] = $element;
	 }
	 // do the same for the month names
	 $mnames1 = array_slice($mnames,$actmonth,11);
	 $mnames2 = array_slice($mnames,0,$actmonth);
	 foreach($mnames2 as $key => $element)  {
		$mnames1[] = $element;
	 }
 
	$i = 0;
	$fees = array();
	$db = &JFactory::getDbo();
	for($i; $i<=11; $i++)  {
		$m = &$month1[$i];
		$squery ="SELECT SUM(sale) FROM #__jafilia_sales WHERE MONTH(date)='".$m."' AND uid='".$id."' AND date>DATE_SUB('" . $date . "', INTERVAL 1 YEAR)";
		$db->setQuery($squery);
							
		$sum = $db->loadResult();
		$fees[] = $sum;
	}
	$fee = implode(",", $fees);

			  
  // Dataset definition   
  $DataSet2 = new pData;  
  $DataSet2->AddPoint($fees,"Serie1");  
  $DataSet2->AddSerie();  
  $DataSet2->SetAbsciseLabelSerie(); 
  $DataSet2->SetSerieName(JText::_('JAF_SALES'),"Serie1");
  $DataSet2->AddPoint($mnames1,"XLabel");
  $DataSet2->SetAbsciseLabelSerie("XLabel");
   
   
  // Initialise the graph  
 $Fee = new pChart(500,230); 
 $Fee->setFontProperties(JPATH_SITE.DS."components".DS."com_jafilia".DS."assets".DS."Fonts".DS."tahoma.ttf",8); 
 $Fee->loadColorPalette(JPATH_SITE.DS."components".DS."com_jafilia".DS."assets".DS."colorsets".DS.$jafcscheme); 
 $Fee->setGraphArea(50,30,480,200);  
 $Fee->drawFilledRoundedRectangle(7,7,693,223,5,240,240,240);  
 $Fee->drawRoundedRectangle(5,5,695,225,5,230,230,230);  
 $Fee->drawGraphArea(255,255,255,TRUE);  
 $Fee->drawScale($DataSet2->GetData(),$DataSet2->GetDataDescription(),5,150,150,150,TRUE,0,2,TRUE);  
 $Fee->drawGrid(4,TRUE,230,230,230,50);    

 // Draw the 0 line   
 $Fee->drawTreshold(0,143,55,72,TRUE,TRUE);  
  // Draw the line graph  
  $Fee->drawFilledCubicCurve($DataSet2->GetData(),$DataSet2->GetDataDescription(),TRUE);   
   
  // Finish the graph  
  $Fee->drawLegend(65,35,$DataSet2->GetDataDescription(),255,255,255);  
  $Fee->drawTitle(60,22,JText::_('JAF_L12'),0,0,0,485);  
  $Fee->Render(JPATH_SITE.DS."components".DS."com_jafilia".DS."images".DS."fees_".$id.".png"); 
 // echo'<hr>fvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvv'.$jafcscheme.'<hr>';
  
}



// draws a graph with clicks and sales for last 12 month in backend
function drawGraphClickSaleBE()  {
global $urlhelpers, $jafcscheme;
$urlhelpers = JUri::base(true);
//JPATH_SITE = JPATH_ADMINISTRATOR;
$db = &JFactory::getDbo();

  // Standard inclusions     
  require_once(JPATH_SITE.DS."components".DS."com_jafilia".DS."assets".DS."pData.class");  
  require_once(JPATH_SITE.DS."components".DS."com_jafilia".DS."assets".DS."pChart.class");  

	 $month = array("01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12");
	 $mnames = array(JText::_('JAF_JAN'),JText::_('JAF_FEB'),JText::_('JAF_MAR'),JText::_('JAF_APR'),JText::_('JAF_MAY'),JText::_('JAF_JUN'),JText::_('JAF_JUL'),JText::_('JAF_AUG'),JText::_('JAF_SEP'),JText::_('JAF_OCT'),JText::_('JAF_NOV'),JText::_('JAF_DEC'));
	 $actmonth = date("m");
	 $date = date('Y-m-d H:i:s');
	 // sort the month array new, so we have it for one year backwarts
	 $month1 = array_slice($month,$actmonth,11);
	 $month2 = array_slice($month,0,$actmonth);
	 foreach($month2 as $key => $element)  {
		$month1[] = $element;
	 }
	 // do the same for the month names
	 $mnames1 = array_slice($mnames,$actmonth,11);
	 $mnames2 = array_slice($mnames,0,$actmonth);
	 foreach($mnames2 as $key => $element)  {
		$mnames1[] = $element;
	 }
	 
	$i = 0;
	$click = array();
	for($i; $i<=11; $i++)  {
		$m = &$month1[$i];
		$db->setQuery("SELECT COUNT(*) FROM #__jafilia_clicks WHERE 
							MONTH(date)='".$m."' 
							AND date>DATE_SUB('" . $date . "', INTERVAL 1 YEAR)");
							
		$count = $db->loadResult();
		$click[] = $count;
	}
	$clicks = implode(",", $click);
	
	$i = 0;
	$sales = array();
	for($i; $i<=11; $i++)  {
		$m = &$month1[$i];
		$db->setQuery("SELECT COUNT(*) FROM #__jafilia_sales WHERE 
							MONTH(date)='".$m."' 
							AND date>DATE_SUB('" . $date . "', INTERVAL 1 YEAR)");
							
		$count = $db->loadResult();
		$sales[] = $count;
	}
	$sale = implode(",", $sales);

			  
  // Dataset definition   
  $DataSet = new pData;  
  $DataSet->AddPoint($click,"Serie1");
  $DataSet->AddPoint($sales,"Serie2");  
  $DataSet->AddAllSeries();  
  $DataSet->SetAbsciseLabelSerie(); 
  $DataSet->SetSerieName(JText::_('JAF_CLICKS'),"Serie1");
  $DataSet->SetSerieName(JText::_('JAF_SALE'),"Serie2"); 
  $DataSet->AddPoint($mnames1,"XLabel");
  $DataSet->SetAbsciseLabelSerie("XLabel");
   
   
  // Initialise the graph  
 $Graph = new pChart(500,230);
 $Graph->setFontProperties(JPATH_SITE.DS."components".DS."com_jafilia".DS."assets".DS."Fonts".DS."tahoma.ttf",8);   
 $Graph->loadColorPalette(JPATH_SITE.DS."components".DS."com_jafilia".DS."assets".DS."colorsets".DS.$jafcscheme);
 $Graph->setGraphArea(50,30,480,200);  
 $Graph->drawFilledRoundedRectangle(7,7,693,223,5,240,240,240);  
 $Graph->drawRoundedRectangle(5,5,695,225,5,230,230,230);  
 $Graph->drawGraphArea(255,255,255,TRUE);  
 $Graph->drawScale($DataSet->GetData(),$DataSet->GetDataDescription(),5,150,150,150,TRUE,0,2,TRUE);  
 $Graph->drawGrid(4,TRUE,230,230,230,50);    

 // Draw the 0 line    
 $Graph->drawTreshold(0,143,55,72,TRUE,TRUE);  
  // Draw the line graph  
  $Graph->drawBarGraph($DataSet->GetData(),$DataSet->GetDataDescription(),TRUE);   
   
  // Finish the graph   
  $Graph->drawLegend(65,35,$DataSet->GetDataDescription(),255,255,255);  
  $Graph->drawTitle(60,22,JText::_('JAF_L12'),0,0,0,485);  
  $Graph->Render(JPATH_SITE.DS."components".DS."com_jafilia".DS."images".DS."csBE.png"); 
  
}

// draws a graph with fees for last 12 month in Backend
function drawGraphFeesBE()  {
global $urlhelpers, $jafcscheme;
$urlhelpers = JUri::base(true);
//JPATH_SITE = JPATH_ADMINISTRATOR;
$db = &JFactory::getDbo();
  // Standard inclusions     
  require_once(JPATH_SITE.DS."components".DS."com_jafilia".DS."assets".DS."pData.class");  
  require_once(JPATH_SITE.DS."components".DS."com_jafilia".DS."assets".DS."pChart.class");  

	 $month = array("01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12");
	 $mnames = array(JText::_('JAF_JAN'),JText::_('JAF_FEB'),JText::_('JAF_MAR'),JText::_('JAF_APR'),JText::_('JAF_MAY'),JText::_('JAF_JUN'),JText::_('JAF_JUL'),JText::_('JAF_AUG'),JText::_('JAF_SEP'),JText::_('JAF_OCT'),JText::_('JAF_NOV'),JText::_('JAF_DEC'));
	 $actmonth = date("m");
	 $date = date('Y-m-d H:i:s');
	 // sort the month array new, so we have it for one year backwarts
	 $month1 = array_slice($month,$actmonth,11);
	 $month2 = array_slice($month,0,$actmonth);
	 foreach($month2 as $key => $element)  {
		$month1[] = $element;
	 }
	 // do the same for the month names
	 $mnames1 = array_slice($mnames,$actmonth,11);
	 $mnames2 = array_slice($mnames,0,$actmonth);
	 foreach($mnames2 as $key => $element)  {
		$mnames1[] = $element;
	 }
 
	$i = 0;
	$fees = array();
	for($i; $i<=11; $i++)  {
		$m = &$month1[$i];
		$db->setQuery("SELECT SUM(sale) FROM #__jafilia_sales WHERE 
							MONTH(date)='".$m."' 
							AND date>DATE_SUB('" . $date . "', INTERVAL 1 YEAR)");
							
		$sum = $db->loadResult();
		$fees[] = $sum;
	}
	$fee = implode(",", $fees);

			  
  // Dataset definition   
  $DataSet2 = new pData;  
  $DataSet2->AddPoint($fees,"Serie1");  
  $DataSet2->AddSerie();  
  $DataSet2->SetAbsciseLabelSerie(); 
  $DataSet2->SetSerieName(JText::_('JAF_SALES'),"Serie1");
  $DataSet2->AddPoint($mnames1,"XLabel");
  $DataSet2->SetAbsciseLabelSerie("XLabel");
   
   
  // Initialise the graph  
 $Fee = new pChart(500,230); 
 $Fee->setFontProperties(JPATH_SITE.DS."components".DS."com_jafilia".DS."assets".DS."Fonts".DS."tahoma.ttf",8); 
 $Fee->loadColorPalette(JPATH_SITE.DS."components".DS."com_jafilia".DS."assets".DS."colorsets".DS.$jafcscheme); 
 $Fee->setGraphArea(50,30,480,200);  
 $Fee->drawFilledRoundedRectangle(7,7,693,223,5,240,240,240);  
 $Fee->drawRoundedRectangle(5,5,695,225,5,230,230,230);  
 $Fee->drawGraphArea(255,255,255,TRUE);  
 $Fee->drawScale($DataSet2->GetData(),$DataSet2->GetDataDescription(),5,150,150,150,TRUE,0,2,TRUE);  
 $Fee->drawGrid(4,TRUE,230,230,230,50);    

 // Draw the 0 line  
 $Fee->drawTreshold(0,143,55,72,TRUE,TRUE);  
  // Draw the line graph  
  $Fee->drawFilledCubicCurve($DataSet2->GetData(),$DataSet2->GetDataDescription(),TRUE);   
   
  // Finish the graph  
  $Fee->drawLegend(65,35,$DataSet2->GetDataDescription(),255,255,255);  
  $Fee->drawTitle(60,22,JText::_('JAF_L12'),0,0,0,485);  
  $Fee->Render(JPATH_SITE.DS."components".DS."com_jafilia".DS."images".DS."feesBE.png"); 
  
}
?>
