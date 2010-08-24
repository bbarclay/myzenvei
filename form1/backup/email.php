<?php
ob_start();
session_start();
require_once 'class.phpmailer.php';

$Mail = new PHPMailer();
//$Mail -> LoginSMTP();
			
		
			$Mail -> ClearAllRecipients();
		   
			$Mail -> AddAddress('haroonm@live.com');
			$Mail -> AddBCC($_POST[email]); 
			
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
			$message .= AddEmailRow('SSN/SIN No.',$_POST[ssn]);
			
			$message .= AddEmailRow('Day Phone',$_POST[day_phone]);
			$message .= AddEmailRow('Evening Phone',$_POST[even_phone]);
			$message .= AddEmailRow('Cell Phone',$_POST[cell]);
			$message .= AddEmailRow('Fax Number',$_POST[fax]);
			
//			$message .= AddEmailRow('CoApplicant Information:','');
			$message .= AddEmailRow('CoApplicant First Name',$_POST[fname_co]);
			$message .= AddEmailRow('CoApplicant Last Name',$_POST[lname_co]);
			$message .= AddEmailRow('CoApplicant Birth Day',$_POST[b_day_co]);
			
			
			$message .= AddEmailRow('Shipping Address1',$_POST[add1_ship]);
			$message .= AddEmailRow('Shipping Address1',$_POST[add2_ship]);
			$message .= AddEmailRow('Shipping city',$_POST[city_ship]);
			$message .= AddEmailRow('Shipping country',$_POST[country_ship]);
			
			$message .= AddEmailRow('Billing Address1',$_POST[add1_bill]);
			$message .= AddEmailRow('Billing Address1',$_POST[add2_bill]);
			$message .= AddEmailRow('Billing city',$_POST[city_bill]);
			$message .= AddEmailRow('Billing country',$_POST[country_bill]);
			
			$message .= AddEmailRow('Password',$_POST[pass1]);
			
			$message .= AddEmailRow('Day',$_POST[b_day_co]);
			$message .= AddEmailRow('Day',$_POST[b_day_co]);
			$message .= AddEmailRow('Day',$_POST[b_day_co]);
			
			$message .= EndBody();
			
			$Mail -> Body = stripslashes($message);
			$Mail->IsHTML(true); //html format
			
			if ($Mail -> Send()){
				echo 'Mail Sent';
				echo '<br/><pre>';
				print_r($Mail);
				//header("Location:thanks.html");
			}else{
				echo '<pre>';
				print_r($Mail);
				header("Location:error.html");
			}
?>