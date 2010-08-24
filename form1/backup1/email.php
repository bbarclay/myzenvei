<?php
ob_start();
session_start();
require_once 'class.phpmailer.php';

$Mail = new PHPMailer();
//$Mail -> LoginSMTP();
			
		
			$Mail -> ClearAllRecipients();
		   
			//$Mail -> AddAddress('haroonm@live.com');
			$Mail -> AddAddress('brandon@731days.com');
			$Mail -> AddAddress('jay.sampson@xellana.com');
			$Mail -> AddCC($_POST[email]); 
			
		    $Mail -> FromName=$_POST[email];
		    $Mail -> Subject='Your Website - New Query'; 
		    $Mail -> From=$_POST[email];
			$message=StartBody('100%');
			$message.='
			<style type="text/css">
			table{
				font-size:14px;	
				text-align:left;
			}
			.bold, .b { font-weight:bold }
			.heading { 
				font-size:20px;
				color:#5EA11E;
				padding:5px 0;
			}
			.text{
				text-align:left;	
			}
			</style>';
			
		    $message.='
  <tr>
    <td width="100%" colspan="3" class="heading">Inquiry Form</td>
  </tr>';
	 		$message .= AddEmailRow('ZENVEI RED',$_POST[red_qty]);
			$message .= AddEmailRow('ZENVEI BLUE',$_POST[blue_qty]);
			$message .= AddEmailRow('ZENVEI GREEN',$_POST[green_qty]);
			$message .= AddEmailRow('ZENVEI SILVER',$_POST[silver_qty]);
			$message .= AddEmailRow('Shipping Method',$_POST[ship_method]);
			
//			$message .= AddEmailRow('Personal Info:',"&nbsp;"]);
			$message .= AddEmailRow('First Name',$_POST[fname]);
			$message .= AddEmailRow('Last Name',$_POST[lname]);
			$message .= AddEmailRow('Bussiness Name',$_POST[buss_name]);
			$message .= AddEmailRow('Email',$_POST[email]);
			$message .= AddEmailRow('(SSN/SIN)/Tax No.',$_POST[ssn]);
			
			$message .= AddEmailRow('Day Phone',$_POST[day_phone]);
			$message .= AddEmailRow('Evening Phone',$_POST[even_phone]);
			$message .= AddEmailRow('Cell Phone',$_POST[cell]);
			$message .= AddEmailRow('Fax Number',$_POST[fax]);
			
//			$message .= AddEmailRow('CoApplicant Information:','');
			$message .= AddEmailRow('CoApplicant First Name',$_POST[fname_co]);
			$message .= AddEmailRow('CoApplicant Last Name',$_POST[lname_co]);
			$message .= AddEmailRow('CoApplicant Birth Day',$_POST[b_day_co]);
			
			
			$message .= AddEmailRow('Shipping Address1',$_POST[add1_ship]);
			$message .= AddEmailRow('Shipping Address2',$_POST[add2_ship]);
			$message .= AddEmailRow('Shipping city',$_POST[city_ship]);
			$message .= AddEmailRow('Shipping state',$_POST[state_ship]);
			$message .= AddEmailRow('Shipping zip',$_POST[zip_ship]);
			$message .= AddEmailRow('Shipping country',$_POST[country_ship]);
			
			$message .= AddEmailRow('Billing Address1',$_POST[add1_bill]);
			$message .= AddEmailRow('Billing Address2',$_POST[add2_bill]);
			$message .= AddEmailRow('Billing city',$_POST[city_bill]);
			$message .= AddEmailRow('Billing state',$_POST[state_bill]);
			$message .= AddEmailRow('Billing zip',$_POST[zip_bill]);
			$message .= AddEmailRow('Billing country',$_POST[country_bill]);
			
			$message .= AddEmailRow('Referred',$_POST[referred]);
			
			$message .= AddEmailRow('Card Type',$_POST[card_type]);
			$message .= AddEmailRow('Name on Card',$_POST[name_card]);
			$message .= AddEmailRow('Card No',$_POST[card_no]);
			$message .= AddEmailRow('Card Expriration',$_POST[expire_date]);
			
			
			$message .= AddEmailRow('PRODUCT ORDER ',$_POST[prod_total]);
			$message .= AddEmailRow('SHIPPING',$_POST[shippings]);
			$message .= AddEmailRow('TAX',$_POST[taxx]);
			$message .= AddEmailRow('TOTAL',$_POST[totals]);
			$message .= AddEmailRow('AutoShip ',$_POST[auto_ships]);
			
			
			
			$message .= EndBody();
			
			$Mail -> Body = stripslashes($message);
			$Mail->IsHTML(true); //html format
			
//			print_r($Mail); exit;
			
			if ($Mail -> Send()){
/*				echo 'Mail Sent';
				echo '<br/><pre>';
				print_r($Mail);*/
				header("location:thankyou.html");
			}else{
				echo '<pre>';
				print_r($Mail);
				header("location:error.html");
			}
?>