<?php

//Set errors on so we can see if there is a PHP error goes wrong
ini_set('display_errors',1);
error_reporting(E_ALL & ~E_NOTICE);



//include ThinMPI and Directory-request en -response
require_once(dirname(__FILE__) . "/ThinMPI.php");
require_once(dirname(__FILE__) . "/DirectoryRequest.php");
require_once(dirname(__FILE__) . "/DirectoryResponse.php");

//PHP function to create random string of numbers of length $num. 
function RandomString($num) {
  mt_srand((double)microtime()*1000000);
  while (strlen($pass) < $num) {
    $i = chr(mt_rand (48,57)); 
    $pass = $pass.$i; 
  }
  return ($pass);  
} 
?>


<html>
<head>
<title>Testshop</title>
<font face=""></font>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script language="JavaScript" type="text/JavaScript">

//Returns Number with 2 decimals
function Format(Number)
{
	Number = Math.round(Number*100)/100;
	var NumberText = Number + '';
	if((Number) == Math.round(Number))
	{
	  	//No decimals? Add .00
	  	NumberText += ".00";
	}
	else if((Number*10) == Math.round(Number*10))
	{
	  	//If 1 decimal only, add 0
	  	NumberText += "0";
	} 
	return NumberText;
}


//Updates totals in form
function Update(Number, Price, TotalPrice)
{
	TotalPrice.value = Format(Price.value * Number.value);
	var Total = parseFloat(document.forms[0].Product1TotalPrice.value) + parseFloat(document.forms[0].Product2TotalPrice.value) + parseFloat(document.forms[0].Product3TotalPrice.value) + parseFloat(document.forms[0].Product4TotalPrice.value);
	document.forms[0].grandtotal.value = Format(Total);
	if(Total > 0)
	{
		document.forms[0].Submit.disabled = false;
	}
	else
	{
		document.forms[0].Submit.disabled = true;
	}
}

</script>

</head>

<body>

<!--We display a form with 4 products, of course a much more advanced shopping system can be used. 
As long as it generates transaction info such as purchase id, amount, description.-->

<img src="icons/iDEALLogoGroot.jpg">

<!--Send form to script that sends a TransReq-->
<form action="TransReq.php" method="post" name="OrderForm">
<table width="80%"  border="1">
  <tr align="left">
    <th>Omschrijving</th>
	<th>Aantal</th>
	<th>&nbsp;</th>
	<th>Prijs</th>
	<th>&nbsp;</th>
	<th>Totaal</th>
  </tr>
  <tr>
    <td width="80%">Product 1</td>
	<td><input name="Product1Number" type="text" value="0" size="3" maxlength="3" onKeyUp="Update(Product1Number,Product1Price,Product1TotalPrice)"></td>
	<td>x</td>
    <td><input name="Product1Price" type="text"   align="right" value="0.01" readonly="true" size="7"></td>
    <td>=</td>   
    <td><input name="Product1TotalPrice" type="text"    align="middle" value="0.00" size="7" maxlength="7" readonly="true">&nbsp;</td>
  </tr>
 
  <tr>
    <td width="80%">Product 2</td>
	<td><input name="Product2Number" type="text" value="0" size="3" maxlength="3" onKeyUp="Update(Product2Number,Product2Price,Product2TotalPrice)"></td>
	<td>x</td>
    <td><input name="Product2Price" type="text"   value="7.15" readonly="true" size="7"></td>
    <td>=</td>   
    <td><input name="Product2TotalPrice" type="text"  value="0.00" size="7" maxlength="7" readonly="true"></td>
  </tr>
  <tr>
    <td width="80%">Product 3</td>
	<td><input name="Product3Number" type="text" value="0" size="3" maxlength="3" onKeyUp="Update(Product3Number,Product3Price,Product3TotalPrice)"></td>
	<td>x</td>
    <td><input name="Product3Price" type="text"   value="8.95" readonly="true" size="7"></td>
    <td>=</td>   
    <td><input name="Product3TotalPrice" type="text"  value="0.00" size="7" maxlength="7" readonly="true"></td>
  </tr>
  <tr>
    <td width="80%">Product 4</td>
	<td><input name="Product4Number" type="text" value="0" size="3" maxlength="3" onKeyUp="Update(Product4Number,Product4Price,Product4TotalPrice)"></td>
	<td>x</td>
    <td><input name="Product4Price" type="text"   value="10.00" readonly="true" size="7"></td>
    <td>=</td>   
    <td><input name="Product4TotalPrice" type="text"  value="0.00" size="7" maxlength="7" readonly="true"></td> 
  </tr>
 </table>

<table width="80%">
  <tr>
   	<td align="right"><strong>Ordernummer:</strong> </td>
	<td><input name="ordernumber" type="text"  
<?php 
	//The ordernumber is a random string, you should replace this with an ordernumber from your webshop system.
	print("value=\"" . RandomString(16) . "\"") 
?>
	readonly="true" size="18" maxlength="16"> </td>
    <td align="right"><input name="Reset" type="reset"  value="Reset" onClick="document.forms[0].Submit.disabled=true"></td>
	<td align="right"><input name="Submit" src="icons/iDEALLogoGroot.jpg" type="submit" disabled="true" value="Bestel"></td>
	<td align="right"><strong>Totaalbedrag:</strong></td>
    <td align="right"\><input name="grandtotal" type="text"  readonly="true" value="0.00" size="7" maxlength="7"></td>
  </tr>
  <tr>
  	<td align="right" colspan="1"><strong>Kies hier uw bank:</strong></td>
	<td colspan="5">

<?php
	//Here comes the interesting part: the Directory Request itself.
	//Create a directory request
	$data = & new DirectoryRequest();
	//Set parameters for directory request
	
	//Create thinMPI instance
	$rule = new ThinMPI();

	//Process directory request
	$result = $rule->ProcessRequest($data);
	
	if(!$result->isOK())
	{
		print("Er is op dit moment geen betaling met iDEAL mogelijk.<br>");
		print("Foutmelding van iDEAL: ");
		$Msg = $result->getErrorMessage();
		print("$Msg<br>");
	}
	else
	{
		//Get issuerlist
		$issuerArray = $result->getIssuerList();
		if(count($issuerArray) == 0)
		{
			print("Lijst met banken niet beschikbaar, er is op dit moment geen betaling met iDEAL mogelijk.");
		}
		else
		{
			//Directory request succesful and at least 1 issuer
			
			for($i=0;$i<count($issuerArray);$i++)
			{
				if($issuerArray[$i]->issuerList == "Short")
				{
					$issuerArrayShort[]=$issuerArray[$i];
				}
				else
				{
					$issuerArrayLong[]=$issuerArray[$i];
				}
				
			}
    		//Create a selection list
			print("<select name=\"issuerID\">");
		    print("<option value=\"0\">Kies uw bank...</option>");
			//Create an option tag for every issuer
			for($i=0;$i<count($issuerArrayShort);$i++)
			{
				print("<option value=\"{$issuerArrayShort[$i]->issuerID}\"> {$issuerArrayShort[$i]->issuerName} </option>");
			}
			if(count($issuerArrayLong) > 0)
			{
				print("<option value=\"0\">---Overige banken---</option>");
			}
			for($i=0;$i<count($issuerArrayLong);$i++)
			{
				print("<option value=\"{$issuerArrayLong[$i]->issuerID}\"> {$issuerArrayLong[$i]->issuerName} </option>");
			}
			print("</select>");
		}
	}
?>

</td></tr></table>
</form>

</body>
</html>

