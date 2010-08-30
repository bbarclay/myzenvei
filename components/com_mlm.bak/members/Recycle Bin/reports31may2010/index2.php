<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Simple Slide Panel</title>
<style type="text/css">@import "css/jquery.datepick.css";</style>
<!--<link rel="stylesheet" href="css/jquery.safari-checkbox.css" />-->
<link rel="stylesheet" type="text/css" href="mlm_z_css/layout.css" />
<link rel="stylesheet" href="mlm_z_css/jquery.checkbox.css" />   
<link rel="stylesheet" href="mlm_z_css/jquery-ui-1.8.1.custom.css" />

<style type="text/css" title="currentStyle">
			@import "media/css/demo_page.css";
			@import "media/css/demo_table.css";
			@import "media/css/TableTools.css";
			.FixedHeader_Cloned th { background-color: white; }
			
		</style>


<script type="text/javascript" src="mlm_z_js/jquery-latest.pack.js" language="javascript"></script>
<script language="javascript" src="mlm_z_js/javaformfunctions.js"></script>
<script type="text/javascript" src="mlm_z_js/jquery.checkbox.min.js"></script>
<script language="javascript" src="mlm_z_js/jquery.pop.js" type="text/javascript"></script>  
<script type="text/javascript" src="mlm_z_js/jquery.datepick.js"></script>
<script type="text/javascript" src="mlm_z_js/checkboxfunctions.js"  ></script>
<script type="text/javascript" src="mlm_z_js/jquery-ui-1.8.1.custom.min.js"  ></script>
<script>
	$(function() {
		$(".datepicker").datepicker();
	});
</script>



		<script type="text/javascript" charset="utf-8" src="media/js/jquery.dataTables.js"></script>
		<script type="text/javascript" charset="utf-8" src="media/ZeroClipboard/ZeroClipboard.js"></script>
		<script type="text/javascript" charset="utf-8" src="media/js/TableTools.js"></script>
        <script type="text/javascript" charset="utf-8" src="media/js/FixedHeader.js"></script>
		<script type="text/javascript" charset="utf-8">
			$(document).ready( function () {
				/* You might need to set the sSwfPath! Something like:
				 *   TableToolsInit.sSwfPath = "/media/swf/ZeroClipboard.swf";
				 */
				$('#example').dataTable( {
					"sDom": 'T<"clear">lfrtip'
				} );
			} );
		</script>
        
       
















<script>  


function addTable(id)
{
	

		var L1=document.getElementById("chkCommissions").checked;
		var L2=document.getElementById("chkFastStartBonus").checked;
		var L3=document.getElementById("chkComission").checked;
		var L4=document.getElementById("chkPrefCustomerCommission").checked;
		
		
		var L5=document.getElementById("chkMatchingAll").checked;
		var L6=document.getElementById("chkMatchingFastStart").checked;
		var L7=document.getElementById("chkMatchingCommissions").checked;
		var L8=document.getElementById("chkMatchingPreferredCustomer").checked;
		
		//middle box 
		var M1=document.getElementById("chkStatusAll").checked;
		var M2=document.getElementById("chkDownlineAssociates").checked;
		var M3=document.getElementById("chkPendingAssoc").checked;
		var M4=document.getElementById("chkActiveAssoc").checked;
		var M5=document.getElementById("chkInnactiveAssoc").checked;
		var M6=document.getElementById("chkPendingAutoship").checked;
		var M7=document.getElementById("chklPendingActiveDate").checked;
		
		//Right Box
		var R1=document.getElementById("chkLevelInformation").checked;
		var R2=document.getElementById("chkShowNames").checked;
		var R3=document.getElementById("chkMyPersonally").checked;
		var R4=document.getElementById("chkPhoneNumbers").checked;

		//////All Levels
		var R5=document.getElementById("chkAllLevels").checked;
		var R6=document.getElementById("chkOne").checked;
		var R7=document.getElementById("chkTwo").checked;
		var R8=document.getElementById("chkThree").checked;
		var R9=document.getElementById("chkFour").checked;
		var R10=document.getElementById("chkFive").checked;
		var R11=document.getElementById("chkSix").checked;
		var R12=document.getElementById("chkSeven").checked;
		var R13=document.getElementById("chkEight").checked;
		var R14=document.getElementById("chkNine").checked;
		
		//report box
		
		var R15=document.getElementById("datepicker").value;
		var R16=document.getElementById("datepicker2").value;
		var R17=document.getElementById("Save_report").value;	
	
	if (window.XMLHttpRequest)
 	 {// code for IE7+, Firefox, Chrome, Opera, Safari
 		 xmlhttp=new XMLHttpRequest();
 	 }
	else
 		{// code for IE6, IE5
  		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
 		}
	xmlhttp.onreadystatechange=function()
  	{
  	if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("demo").innerHTML=xmlhttp.responseText;
	$('#example').dataTable( {
					"sDom": 'T<"clear">lfrtip'
				} );
	
	
    }
  }
xmlhttp.open("GET","mlm_z_tableData.php?q="+1+"&q2="+L1+"&q3="+L2+"&q4="+L3+"&q5="+L4+"&q6="+L5+"&q7="+L6+"&q8="+L7+"&q9="+L8+"&q10="+M1+"&q11="+M2+"&q12="+M3+"&q13="+M4+"&q14="+M5+"&q15="+M6+"&q16="+M7+"&q17="+R1+"&q18="+R2+"&q19="+R3+"&q20="+R4+"&q21="+R5+"&q22="+R6+"&q23="+R7+"&q24="+R8+"&q25="+R9+"&q26="+R10+"&q27="+R11+"&q28="+R12+"&q29="+R13+"&q30="+R14+"&q31="+R15+"&q32="+R16+"&q33="+R17,true);
xmlhttp.send();

}



function emptyTable(){
	document.getElementById("demo").innerHTML="";
	}

function addfile(id1){
	
		var L1=document.getElementById("chkCommissions").checked;
		var L2=document.getElementById("chkFastStartBonus").checked;
		var L3=document.getElementById("chkComission").checked;
		var L4=document.getElementById("chkPrefCustomerCommission").checked;
		
		
		var L5=document.getElementById("chkMatchingAll").checked;
		var L6=document.getElementById("chkMatchingFastStart").checked;
		var L7=document.getElementById("chkMatchingCommissions").checked;
		var L8=document.getElementById("chkMatchingPreferredCustomer").checked;
		
		//middle box 
		var M1=document.getElementById("chkStatusAll").checked;
		var M2=document.getElementById("chkDownlineAssociates").checked;
		var M3=document.getElementById("chkPendingAssoc").checked;
		var M4=document.getElementById("chkActiveAssoc").checked;
		var M5=document.getElementById("chkInnactiveAssoc").checked;
		var M6=document.getElementById("chkPendingAutoship").checked;
		var M7=document.getElementById("chklPendingActiveDate").checked;
		
		//Right Box
		var R1=document.getElementById("chkLevelInformation").checked;
		var R2=document.getElementById("chkShowNames").checked;
		var R3=document.getElementById("chkMyPersonally").checked;
		var R4=document.getElementById("chkPhoneNumbers").checked;

		//////All Levels
		var R5=document.getElementById("chkAllLevels").checked;
		var R6=document.getElementById("chkOne").checked;
		var R7=document.getElementById("chkTwo").checked;
		var R8=document.getElementById("chkThree").checked;
		var R9=document.getElementById("chkFour").checked;
		var R10=document.getElementById("chkFive").checked;
		var R11=document.getElementById("chkSix").checked;
		var R12=document.getElementById("chkSeven").checked;
		var R13=document.getElementById("chkEight").checked;
		var R14=document.getElementById("chkNine").checked;
		
		//report box
		
		var R15=document.getElementById("datepicker").value;
		var R16=document.getElementById("datepicker2").value;
		var R17=document.getElementById("Save_report").value;
		
	
	if (window.XMLHttpRequest)
 	 {// code for IE7+, Firefox, Chrome, Opera, Safari
 		 xmlhttp=new XMLHttpRequest();
 	 }
	else
 		{// code for IE6, IE5
  		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
 		}
	xmlhttp.onreadystatechange=function()
  	{
  	if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("Saved_reports").innerHTML=xmlhttp.responseText;
	addReport(1);
    }
  }
xmlhttp.open("GET","mlm_z_getFile.php?q="+1+"&q2="+L1+"&q3="+L2+"&q4="+L3+"&q5="+L4+"&q6="+L5+"&q7="+L6+"&q8="+L7+"&q9="+L8+"&q10="+M1+"&q11="+M2+"&q12="+M3+"&q13="+M4+"&q14="+M5+"&q15="+M6+"&q16="+M7+"&q17="+R1+"&q18="+R2+"&q19="+R3+"&q20="+R4+"&q21="+R5+"&q22="+R6+"&q23="+R7+"&q24="+R8+"&q25="+R9+"&q26="+R10+"&q27="+R11+"&q28="+R12+"&q29="+R13+"&q30="+R14+"&q31="+R15+"&q32="+R16+"&q33="+R17,true);
xmlhttp.send();
 
 }
 
 
function status3(L1,L2,L3,L4,L5,L6,L7,L8,M1,M2,M3,M4,M5,M6,M7,R1,R2,R3,R4,R5,R6,R7,R8,R9,R10,R11,R12,R13,R14,R15,R16){
	
	//--left box
		document.getElementById("chkCommissions").checked=L1;
		document.getElementById("chkFastStartBonus").checked=L2;
		document.getElementById("chkComission").checked=L3;
		document.getElementById("chkPrefCustomerCommission").checked=L4;
		
		
		document.getElementById("chkMatchingAll").checked=L5;
		document.getElementById("chkMatchingFastStart").checked=L6;
		document.getElementById("chkMatchingCommissions").checked=L7;
		document.getElementById("chkMatchingPreferredCustomer").checked=L8;
		
		//middle box 
		document.getElementById("chkStatusAll").checked=M1;
		document.getElementById("chkDownlineAssociates").checked=M2;
		document.getElementById("chkPendingAssoc").checked=M3;
		document.getElementById("chkActiveAssoc").checked=M4;
		document.getElementById("chkInnactiveAssoc").checked=M5;
		document.getElementById("chkPendingAutoship").checked=M6;
		document.getElementById("chklPendingActiveDate").checked=M7;
		
		//Right Box
		document.getElementById("chkLevelInformation").checked=R1;
		document.getElementById("chkShowNames").checked=R2;
		document.getElementById("chkMyPersonally").checked=R3;
		document.getElementById("chkPhoneNumbers").checked=R4;

		//////All Levels
		document.getElementById("chkAllLevels").checked=R5;
		document.getElementById("chkOne").checked=R6;
		document.getElementById("chkTwo").checked=R7;
		document.getElementById("chkThree").checked=R8;
		document.getElementById("chkFour").checked=R9;
		document.getElementById("chkFive").checked=R10;
		document.getElementById("chkSix").checked=R11;
		document.getElementById("chkSeven").checked=R12;
		document.getElementById("chkEight").checked=R13;
		document.getElementById("chkNine").checked=R14;
		
		//report box
		//alert(R14);
		document.getElementById("datepicker").value=R15;
		document.getElementById("datepicker2").value=R16;
		
 }


function addReport(id)
{
	if (window.XMLHttpRequest)
 	 {// code for IE7+, Firefox, Chrome, Opera, Safari
 		 xmlhttp=new XMLHttpRequest();
 	 }
	else
 		{// code for IE6, IE5
  		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
 		}
	xmlhttp.onreadystatechange=function()
  	{
  	if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("Saved_reports").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","mlm_z_getReport.php?q="+id,true);
xmlhttp.send();
}


function onstart(){
 addReport(1);
 $("#panel").slideToggle("slow");
 $(this).toggleClass("active"); return false;
 }
</script>  




</head>

<body onload="onstart()" >
<form name="frmRegistration" >
<div id="panel">
<table  border="0" align="center" >
  <tr>
  
   <td style="vertical-align:top">
    
<div id="apDiv5">
  <fieldset>
  <legend>
  <input type="image"  src="media/images/generate.png"name="generate" id="generate" value=" Generate Report" class="btn-slide" onclick="addTable(id)"  />
  </legend>
  <div class="demo">
    <p align="center">Start Date:
      
      <input type="text" id="datepicker"  class="datepicker"/>
    </p>
    <p align="center">    End Date:
      <input type="text" id="datepicker2" class="datepicker"/>
    </p>
  </div>
<p align="center">
    <!-- End demo -->
    <!-- End demo-description -->
    Name Report Settings to Save:  </p>
  <p align="center">
    <input type="text" name="Save_report" id="Save_report" />
    &nbsp;&nbsp;
    <input  type="button" name="Save_report2" id="Save_report2" value=" Save"  onclick="addfile(id)"/>
  </p>
  <p>Saved Reports:</p>
  
    <div name="Saved_reports" id="Saved_reports" style="overflow:scroll; border:1px; width:250px; height:71px; background-color:orange; margin-left:10px;" ></div>
</fieldset></div>


    </td>
    
    <td>
    <div id="apDiv3">  
  <fieldset>
  <legend class="style3">
  <input type="checkbox" name="chkStatusAll" class="top5"  onClick="return fnStatusAll(chkStatusAll);"  id="chkStatusAll" checked="checked"/>  <strong>Status All On/Off</strong></legend>
  <p>
    <input type="checkbox" name="chkDownlineAssociates" class="top5"  id="chkDownlineAssociates" checked="checked"/>    Show/Hide Downline Associates</p>
  <p>
    <input type="checkbox" name="chkPendingAssoc" class="top5" id="chkPendingAssoc" checked="checked"/>    Show Pending Assoc.</p>
  <p>
    <input type="checkbox" name="chkActiveAssoc" class="top5"  id="chkActiveAssoc"  checked="checked"/>    Show Active Assoc.</p>
  <p>
    <input type="checkbox" name="chkInnactiveAssoc" class="top5"  id="chkInnactiveAssoc" checked="checked"/>    Show Innactive Assoc.</p>
  <p>
    <input type="checkbox" name="chkPendingAutoship" class="top5"   id="chkPendingAutoship" checked="checked"/>   Show Pending Autoship</p>
  <p>
    <input type="checkbox" name="chklPendingActiveDate" class="top5"  id="chklPendingActiveDate" checked="checked"/>   Show Pending/Active Date</p>
  <p>&nbsp; </p>
  </fieldset>
</div>
    
    </td>
    <td style="vertical-align:top;">
    <div id="apDiv4"> 
  <fieldset>
  <legend class="style3">
  <input type="checkbox" name="chkLevelInformation" class="top5" onClick="return fnLevelInformation(chkLevelInformation);"  id="chkLevelInformation"/>  <strong>Level Information All On/Off</strong></legend>
  <p>
    <input type="checkbox" name="chkShowNames" class="top5"  id="chkShowNames" checked="checked"/>  Show Names</p>
  <p>
    <input type="checkbox" name="chkMyPersonally" class="top5"  id="chkMyPersonally" checked="checked"/>   Show My Personally Sponsored Only</p>
  <p>
    <input type="checkbox" name="chkPhoneNumbers" class="top5"  id="chkPhoneNumbers" checked="checked"/>  Show Phone Numbers (P.S. Only)</p>
  <fieldset>
  <legend class="style3">
  <input type="checkbox" name="chkAllLevels" class="top5"  id="chkAllLevels" onClick="return subLevelInformation(chkAllLevels);" />  <strong>Check All Levels </strong></legend>
  <p>
    <input type="checkbox" name="chkOne" class="top5"  id="chkOne" checked="checked"/>    One 
    <input type="checkbox" name="chkTwo" class="top5"  id="chkTwo" checked="checked"/>     Two 
    <input type="checkbox" name="chkThree" class="top5"  id="chkThree" checked="checked"/>    Three</p>
  <p>
    <input type="checkbox" name="chkFour" class="top5" id="chkFour" checked="checked" />    Four 
    <input type="checkbox" name="chkFive" class="top5"  id="chkFive" checked="checked"/>    Five 
    <input type="checkbox" name="chkSix" class="top5" id="chkSix" checked="checked"/>    Six</p>
  <p>
    <input type="checkbox" name="chkSeven" class="top5"  id="chkSeven" checked="checked"/>    Seven 
    <input type="checkbox" name="chkEight" class="top5" id="chkEight" checked="checked"/>    Eight 
    <input type="checkbox" name="chkNine" class="top5" id="chkNine"  checked="checked"/>    Nine  </p>
  </fieldset>
  </fieldset>
</div>
    
    
    </td>
    <td>
    <div id="apDiv1">
  <fieldset>
  <legend>
  <span><input type="checkbox" name="chkCommissions" class="checkAll"  id="chkCommissions" onClick="return fnCheckAllCommissions(chkCommissions);" checked="checked" /> 
  <b></b><span class="style1">Check All Commissions  </span></legend>
  <p>
    <input type="checkbox" name="chkFastStartBonus" class="top5" id="chkFastStartBonus"  checked="checked"/>  Fast Start Bonus</p>
  <p>
    <input type="checkbox" name="chkComission" class="top5"  id="chkComission" checked="checked" />  Commission  </p>
  <p>
    <input type="checkbox" name="chkPrefCustomerCommission" class="top5"  id="chkPrefCustomerCommission" checked="checked"/>  Preferred Customer Commissions</p>
  <fieldset>
  <legend class="style3"><input type="checkbox" name="chkMatchingAll" class="top5" id="chkMatchingAll" checked="checked" onClick="return subAllCommissions(chkMatchingAll);" /><strong>Matching  All On/Off</strong></legend>
  <p>
    <input type="checkbox" name="chkMatchingFastStart" class="top5"  id="chkMatchingFastStart" checked="checked"/>  Matching Fast Start</p>
  <p>
    <input type="checkbox" name="chkMatchingCommissions" class="top5"  id="chkMatchingCommissions" checked="checked"/>  Matching Commissions</p>
  <p>
    <input type="checkbox" name="chkMatchingPreferredCustomer" class="top5"  id="chkMatchingPreferredCustomer"  checked="checked"/>  Matching Preferred Customer</p>
  </fieldset>
  </fieldset>
</div>
    </td>
   
  </tr>
</table>


</div>

<p class="slide"><a href="#" class="btn-slide"  onclick="emptyTable()">Slide Panel</a></p>
</form>
		<div id="container" >
			<div class="full_width big"></div>
<div id="demo">
 
			</div>
			<div class="spacer"></div>
			
			
			<h1>&nbsp;</h1>
</div>

</body>
</html>
