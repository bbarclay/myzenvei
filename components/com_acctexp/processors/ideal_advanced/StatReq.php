<script language="JavaScript" type="text/JavaScript">
function refresh()
{
	window.location.reload()
}
</script>

<?php
require_once(dirname(__FILE__) . "/ThinMPI.php");
require_once(dirname(__FILE__) . "/AcquirerStatusRequest.php");

define('_VALID_MOS', '1');
global $mosConfig_absolute_path, $mosConfig_live_site, $mosConfig_lang, $database,
$mosConfig_mailfrom, $mosConfig_fromname;

if( file_exists($mosConfig_absolute_path."/configuration.php"))
	require_once($mosConfig_absolute_path."/configuration.php");
if( file_exists ($mosConfig_absolute_path. '/includes/database.php'))
	require_once($mosConfig_absolute_path. '/includes/database.php');

require_once($mosConfig_absolute_path.'/administrator/components/com_virtuemart/virtuemart.cfg.php');
require_once( $mosConfig_absolute_path . '/includes/phpmailer/class.phpmailer.php');
require_once( CLASSPATH. 'ps_database.php' );

$mail = new mosPHPMailer();
$mail->PluginDir = $mosConfig_absolute_path . '/includes/phpmailer/';
$mail->SetLanguage("en", $mosConfig_absolute_path . '/includes/phpmailer/language/');

if (file_exists( ADMINPATH. 'languages/'.$mosConfig_lang.'.php' ))
	{
	require_once( ADMINPATH. 'languages/'.$mosConfig_lang.'.php' );
  	}
		else
		{
		require_once( ADMINPATH. 'languages/english.php' );
		}

$order_number = $_REQUEST['ec'];

// Get the Order Details from the database
$qv = "SELECT order_id, order_number, user_id FROM #__{vm}_orders ";
$qv .= "WHERE order_number='".$order_number."'";
$dbbt = new ps_DB;
$dbbt->query($qv);
$dbbt->next_record();
$order_id = $dbbt->f("order_id");
$d['order_id'] = $order_id;

/** Retrieve User Email **/
$q  = "SELECT * FROM #__{vm}_order_user_info WHERE order_id='$order_id' AND address_type='BT'";
$db->query( $q );
$db->next_record();
$user = $db->record[0];
$dbbt = $db->_clone( $db );
$user->email = $db->f("user_email");

require(CLASSPATH ."payment/ps_ideal.cfg.php");

//Create StatusRequest
$data = & new AcquirerStatusRequest();
$transID = $_GET['trxid'];
$transID = str_pad($transID, 16, "0");
$data -> setTransactionID( $transID  );

//Create ThinMPI instance and process request
$rule = new ThinMPI();
$result = $rule->ProcessRequest( $data );


/* =========================================================================================== */

	/* ******************* Status betaling ************************************
	 * 1] Geslaagde betaling is NIET OK.
	 * 2] Betaling is NIET gelukt.
	 * 3] Betaling gelukt.
	 ************************************************************************ */
	if(!$result->isOK())
		{
		// StatusRequest failed, let the consumer click to try again
		print("Status kon niet worden opgehaald, klik <a href=\"\" onclick=\"refresh()\">hier</a> om het nogmaals te proberen<br>");
		print("Foutmelding van iDEAL: ");
		$Msg = $result->getErrorMessage();
		print("$Msg<br>");
		}
	else if(!$result->isAuthenticated())
		{
		//Transaction failed, inform the consumer
		//print("Uw bestelling is helaas niet betaald, probeer het nog eens");
		
		// Update: Order status aanpassen
		require_once ( CLASSPATH . 'ps_order.php' );
		$d['order_status'] = $conf_data['IDEAL_INVALID_STATUS'];
		$ps_order= new ps_order;
		$ps_order->order_status_update($d);

		// Check: Order status ophalen
		$osn = "SELECT #__{vm}_order_status.order_status_name FROM #__{vm}_order_status, #__{vm}_orders ";
		$osn .= "WHERE #__{vm}_orders.order_number='".$order_number."' AND #__{vm}_orders. order_status=#__{vm}_order_status.order_status_code";
		$rstosn = new ps_DB;
		$rstosn->query($osn);
		$rstosn->next_record();
		$orderstatusname = $rstosn->f("order_status_name");

		$mail->From = $mosConfig_mailfrom;
		$mail->FromName = $mosConfig_fromname;
		$mail->AddAddress($vendor_mail);
		$mail->Subject = "".$vendor_store_name." - Betaling: failed - Order ".$order_id."";
		$mail->Body = "Hallo,\n\n";
		$mail->Body .= "Ideal transactie: FAILED \n";
		$mail->Body .= "Transactie voor: ".$vendor_store_name." via ".$mosConfig_live_site."\n";
		$mail->Body .= "-----------------------------------------------------------\n";
		$mail->Body .= "Transaction ID: $transactionID\n";
		$mail->Body .= "Email betaler: ".$user->user_email."\n";
		$mail->Body .= "Order ID: $order_id\n";
		$mail->Body .= "Order Status: ".$orderstatusname;
		$mail->Send();
		$mail->ClearAddresses();
		echo nl2br($conf_data['IDEAL_Status_Failed']);
		}
			else
				{
				/* **********************************************************************
				 * 1] Bij geslaagde betaling: Update status in database
				 * 2] Mail gegevens geslaagde betaling naar admin
				 * 3] Mail gebruiker dat status van bestellin is aangepast naar Confirmed
				 ************************************************************************ */
				$transactionID = $result->getTransactionID();

				// Update: Order status aanpassen
				require_once ( CLASSPATH . 'ps_order.php' );
				$d['order_status'] = $conf_data['IDEAL_VERIFIED_STATUS'];
				$ps_order= new ps_order;
				$ps_order->order_status_update($d);

				// Check: Nieuwe order status ophalen
				$osn = "SELECT #__{vm}_order_status.order_status_name FROM #__{vm}_order_status, #__{vm}_orders ";
				$osn .= "WHERE #__{vm}_orders.order_number='".$order_number."' AND #__{vm}_orders. order_status=#__{vm}_order_status.order_status_code";
				$rstosn = new ps_DB;
				$rstosn->query($osn);
				$rstosn->next_record();
				$orderstatusname = $rstosn->f("order_status_name");
				//echo $orderstatusname;

				$mail->From = $mosConfig_mailfrom;
				$mail->FromName = $mosConfig_fromname;
				$mail->AddAddress($vendor_mail);
				$mail->Subject = "".$vendor_store_name." - Betaling: succes - Order ".$order_id."";
				$mail->Body = "Hallo,\n\n";
				$mail->Body .= "Ideal transactie: SUCCES \n";
				$mail->Body .= "Transactie voor: ".$vendor_store_name." via ".$mosConfig_live_site."\n";
				$mail->Body .= "-----------------------------------------------------------\n";
				$mail->Body .= "Transaction ID: $transactionID\n";
				$mail->Body .= "Email betaler: ".$user->user_email."\n";
				$mail->Body .= "Order ID: $order_id\n";
				$mail->Body .= "Order Status: ".$orderstatusname;
				$mail->Send();
				$mail->ClearAddresses();

				$mail->From = $vendor_mail;
				$mail->FromName = $vendor_store_name;
				$mail->AddAddress($user->user_email);
				$mail->Subject = "".$vendor_store_name." - Betaling: succes - Order ".$order_id."";
				$mail->Body = "Hallo,\n\n";
				$mail->Body .= "De status van bestellingnummer ".$order_id." is aangepast.\n";
				$mail->Body .= "--------------------------------------------------------------------------------------------------------\n";
				$mail->Body .= "De nieuwe status is: ".$orderstatusname."\n";
				$mail->Body .= "--------------------------------------------------------------------------------------------------------\n";
				$mail->Body .= "\n\n";
				$mail->Body .= "To view the Order Details, please follow this link (or copy it into your browser):\n";
				$mail->Body .= "".$mosConfig_live_site."/index.php?option=com_virtuemart&page=account.order_details&order_id=".$order_id."\n";
				$mail->Body .= "\n\n";
				$mail->Body .= "--------------------------------------------------------------------------------------------------------\n";
				$mail->Body .= "".$vendor_store_name."\n";
				$mail->Body .= "".$mosConfig_live_site."\n";
				$mail->Body .= "".$vendor_mail."";
				$mail->Send();
				$mail->ClearAddresses();

				echo nl2br($conf_data['IDEAL_Status_ThankYou']);
	}
?>