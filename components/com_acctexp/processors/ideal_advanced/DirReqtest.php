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

</head>
<body>

<!--We display a form with 4 products, of course a much more advanced shopping system can be used. 
As long as it generates transaction info such as purchase id, amount, description.-->


<!--Send form to script that sends a TransReq-->
<!--<form action="administrator/components/com_phpshop/classes/payment/ideal/TransReq.php" method="post" name="OrderForm">
<input name="ordernumber" type="text"  
<?php 
	//The ordernumber is a random string, you should replace this with an ordernumber from your webshop system.
	print("value=\"" . RandomString(16) . "\"") 
?>
	readonly="true" size="18" maxlength="16"> </td>
<input name="Submit" src="icons/iDEALLogoGroot.jpg" type="submit" value="Bestel"><br>
<input name="grandtotal" type="text" value="0.00" size="7" maxlength="7">-->
<!--<br>
Kies uw bank:<br>-->
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
			print("<select name=\"issuerID\" class=\"inputbox\">");
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


</body>
</html>
