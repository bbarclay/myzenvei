<?php

$_POST['fname_co']="Sokchea";
$_POST['lname_co']="Doung";
$_POST['buss_name']="Khmer Design Team";
$_POST['day_phone']="85516854858";
$_POST['add1_ship']="Phnom Penh";
$_POST['city_ship']="Phnom Penh";
$_POST['state_ship']="PP";
$_POST['zip_ship']="85523";

$_POST['fname_co']="Sokchea";
$_POST['lname_co']="Doung";
$_POST['buss_name']="Khmer Design Team";
$_POST['day_phone']="85516854858";
$_POST['add1_bill']="Phnom Penh";
$_POST['city_bill']="Phnom Penh";
$_POST['state_bill']="PP";
$_POST['zip_bill']="85523";


$_POST['totals']="39.50";
$_POST['name_card']="Sokchea Doung";
$_POST['card_no']="4111111111111111";
$_POST['card_code'] ='234';	
$_POST['expire_date']="06";	
$_POST['expire_year']="2012";	

// some information for you to validate payment before register user
require("mtrex.class.php");
$mtrex =& new mtrex();

// assign all required variables
$mtrex_variables = array();
$mtrex_variables["billing_first_name"] = $_POST['fname_co'];
$mtrex_variables["billing_last_name"] = $_POST['lname_co'];
$mtrex_variables["billing_company"] = $_POST['buss_name'];
$mtrex_variables["billing_phone"] = $_POST['day_phone'];
$mtrex_variables["billing_address"] = $_POST['add1_ship'];
$mtrex_variables["billing_city"] =$_POST['city_ship'];
$mtrex_variables["billing_state"] =$_POST['state_ship'];
$mtrex_variables["billing_zip"] =$_POST['zip_ship'];
$mtrex_variables["billing_country"] =	'USA';	

$mtrex_variables["shipping_first_name"] = $_POST['fname_co'];
$mtrex_variables["shipping_last_name"] = $_POST['lname_co'];
$mtrex_variables["shipping_company"] = $_POST['buss_name'];
$mtrex_variables["shipping_phone"] = $_POST['day_phone'];
$mtrex_variables["shipping_address"] = $_POST['add1_bill'];
$mtrex_variables["shipping_city"] =$_POST['city_bill'];
$mtrex_variables["shipping_state"] =$_POST['state_bill'];
$mtrex_variables["shipping_zip"] =$_POST['zip_bill'];
$mtrex_variables["shipping_country"] =	'USA';	

$mtrex_variables["order_total"] =$_POST['totals'];
$mtrex_variables["credit_card_name"] =$_POST['name_card'];
$mtrex_variables["credit_card_number"] =$_POST['card_no'];
$mtrex_variables["credit_card_code"] =	$_POST['card_code'];	
$mtrex_variables["expire_month"] =	$_POST['expire_date'];	
$mtrex_variables["expire_year"] =	$_POST['expire_year'];	

$result = $mtrex->process_payment($mtrex_variables); 

// This is a one time payment if you want recurring you have to use this : 
//$mtrex->process_payment($mtrex_variables,"TRUE");

//print_r($result);exit; // Just to test what will return


if($result["mp_TransResult"]=="Approved")
	{
	// Payment Successed
	echo 'Payment Succesfull';
	}
else
	{
	// Payment Fail
echo 'Payment Un-Succesfull';
	}
		
?>