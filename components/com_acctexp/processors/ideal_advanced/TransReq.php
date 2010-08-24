<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' ); 
	ob_start();

	//Show errors so we know if any PHP error occurs
	ini_set('display_errors',1);
	error_reporting(E_ALL & ~E_NOTICE);
	
	//include needed files
	require_once(dirname(__FILE__) . "/ThinMPI.php");
	require_once(dirname(__FILE__) . "/AcquirerTrxRequest.php");

	//Put information from form in variables
	$orderNumber = $_POST['ordernumber'];
	$amount = $_POST['grandtotal'];
	$EntranceCode = $_POST['ec'];
	$amount *= 100;//Multiply amount by 100 to remove decimals
	$issuerID = $_POST['issuerID'];
	if($issuerID==0)
	{
		session_unregister("issuerID");
		echo "<br><br>Wij hebben geen juiste keuze van bank ontvangen.<br>";
		echo "Ga naar het <a href='".$mosConfig_live_site."/index.php?page=account.index&option=com_virtuemart&Itemid=1'>overzicht bestellingen</a> en probeer het opnieuw.";
		$stophere = "true";
	}
	
	if ($stophere != "true")
		{
		//Create TransactionRequest
		$data = & new AcquirerTrxRequest();

		//Set parameters for TransactionRequest
		$data -> setIssuerID($issuerID);
		$data -> setPurchaseID( $orderNumber  );
		$data -> setAmount($amount );
		$data -> setEntranceCode($EntranceCode );

		//Create ThinMPI instance
		$rule = new ThinMPI();

		$result = new AcquirerTrxResponse();

		//Process Request
		$result = $rule->ProcessRequest( $data );

		if($result->isOK())
			{
			$transactionID = $result->getTransactionID();
			//Here you should store the transactionID along with the order (in the database
			//of your webshop system) so you can later retrieve the order with the 
			//transactionID.  To keep this example simple we store the transaction in a file
			$filename = "trans".$transactionID;
			$file = fopen($filename, 'w');
			fputs($file, $description, strlen($description));
			fputs($file, "\r\n\r\n");
			fclose($file);

			//Get IssuerURL en decode it
			$ISSURL = $result->getIssuerAuthenticationURL();
			$ISSURL = html_entity_decode($ISSURL);

			//Redirect the browser to the issuer URL
			header("Location: $ISSURL"); 
			exit();
			}
				else
				{
				//TransactionRequest failed, inform the consumer
				session_unregister("issuerID");
				echo "<br><br>Er is helaas iets misgegaan.<br>Foutmelding van Ideal: ";
				$Msg = $result->getErrorMessage();
				print("$Msg<br><br>");
				echo "Ga naar het <a href='".$mosConfig_live_site."/index.php?page=account.index&option=com_virtuemart&Itemid=1'>overzicht bestellingen</a> en probeer het opnieuw.";
				}
		}
?>

</body>
</html>