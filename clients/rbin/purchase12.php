<?php

	/*Config is custom file which takes (user,pass,host,DB) from joomla configration file*/
	include('config.php');
	
	if(empty($_SESSION['userid']))
	header("Location: login.php");
 
		if(isset($_POST['Submit']))
		{			
			
				
			$PRODUCT_ORDER  = $_POST['prod_total'];
			
			$Shipping_Method = $_POST['ship_method']; 
			$ship_method_id = 1;/*AS only one shipping method so ship_method_id =1 hardcoded*/
			$Shipping = $_POST['shippings'];
			
			$TAX = $_POST['taxx'];
			
			$TOTAL = $_POST['totals'];
			
			
			
			//$Referred = $_POST['referred'];Referrel $_COOKIE["activeProfile"]
			//$AutoShip  = $_POST['auto_ships'];
			
			$order_number_value = md5($regDate);
			
			/*Insert Orders to database*/
			$sql = "INSERT INTO jos_vm_orders 
								( user_id, vendor_id,order_number,user_info_id,order_total, 
								  order_subtotal, order_tax, order_shipping, order_status, 
								  ship_method_id, ip_address)
			 			
						VALUES  ( '$newuser_id', '1','$order_number_value','$user_info_id_value',
								 '$TOTAL', '$PRODUCT_ORDER', '$TAX', '$Shipping', 'P', 
								 '$ship_method_id', '$Ip_address')";
			
			//if (!mysql_query($sql,$con)){die('Error : vm_orders: ' . mysql_error());}
			
			/*Getting ID of Order last Inserted*/
    		$neworder_id = mysql_insert_id();
			
			$sql = "INSERT INTO jos_vm_order_history (order_id,order_status_code , date_added, customer_notified,comments) 
													VALUES ('$neworder_id','P', '$regDate', '0', 'This is a new order ...')";
			//if (!mysql_query($sql,$con)){die('Error : order_history  ' . mysql_error());}
			
			 
			
			$sql="INSERT INTO  jos_vm_order_user_info 
													(
														order_id,user_id,address_type,address_type_name,
														company,last_name,first_name,phone_1, 	phone_2 ,	
														fax ,	address_1 ,	address_2 ,	city ,	state ,	country ,	
														zip ,	user_email,vm_coapplicant_firtsname,
														vm_coapplicant_lastname,vm_coapplicant_birthday,
														vm_card_type,vm_name_on_card,vm_card_number,vm_card_expirydate,
														vm_csv_digits,vm_refferal_id_name,vm_ssn_number
													) 
											  VALUES 
													(
														'$neworder_id','$newuser_id','BT','BT Address',
														'$Bussiness_Name','$Last_Name','$First_Name',
														'$Day_Phone','$Evening_Phone','$Fax_Number',
														'$Shipping_Address1',
														'$Shipping_Address2','$Shipping_city'
														,'$Shipping_state',
														'$Shipping_country','$Shipping_zip','$Email',
														'$CoApplicant_FirstName','$CoApplicant_LastName',
														'$CoApplicant_BirthDay','$Card_Type',
														'$Name_on_Card',
														'$Card_No','$Card_Expriration','$CSV',
														'$Referre_name','$SSN_SIN_TaxNo')";
			
			//if (!mysql_query($sql,$con)){die('Error :order_user_info ' . mysql_error());}
									
			
			
			
			$ZENVEI_RED = $_POST['red_qty'];
			
			if($ZENVEI_RED != 0)
			{
				$product_id = '3';	  
				$order_item_sku = 'ZR1';
				
				if($Associates == 0)
				{
					$product_finalprice = 32;
				}
				else
				{
					$product_finalprice = 35;
				}
				
				$sql = "INSERT INTO jos_vm_order_item 
													(	order_id, user_info_id, vendor_id,product_id,
														order_item_sku,order_item_name, product_quantity, 
														product_item_price,product_final_price,order_status
													)
			                               VALUES 
										   			( 	'$neworder_id', '$user_info_id_value', '1','$product_id',
										   		   		'$order_item_sku','ZENVEI RED','$ZENVEI_RED','$product_price',
												   		'$product_finalprice','P'
													)";
				//if (!mysql_query($sql,$con)){die('Error :vm_order_item 1 ' . mysql_error());}
			}
		
			$ZENVEI_BLUE = $_POST['blue_qty'];
			
			if($ZENVEI_BLUE != 0)
			{
				$product_id_ = '1';	
				$order_item_sku_ = 'ZR2';
				//$product_price = $_POST['blue_total'];
				if($Associates == 0){$product_finalprice = 35;}else{$product_finalprice = 38;}
				
				//$product_finalprice = ($ZENVEI_BLUE * $product_price);
				//product_quantity	product_item_price	product_final_price
				
				$sql = "INSERT INTO jos_vm_order_item (order_id, user_info_id,
													   vendor_id,product_id	,
													   order_item_sku,order_item_name,
													   product_quantity, product_item_price,
													   product_final_price,order_status)
			                               
										   			VALUES ('$neworder_id', '$user_info_id_value',
										   					'1','$product_id_' ,
										   					'$order_item_sku_','ZENVEI BLUE',
										   					'$ZENVEI_BLUE','$product_price',
										   					'$product_finalprice','P')";
				
				//if (!mysql_query($sql,$con)){die('Error :vm_order_item 2 ' . mysql_error());}
			}
			$ZENVEI_GREEN = $_POST['green_qty'];
 			
			if($ZENVEI_GREEN != 0)
			{
				$product_id = '2';	
				$order_item_sku = 'ZR3';
				if($Associates == 0){$product_finalprice = 32;}else{$product_finalprice = 35;}
				

				$sql = "INSERT INTO jos_vm_order_item 
										(
											order_id, user_info_id, vendor_id,product_id	,
											order_item_sku,order_item_name,product_quantity,
											product_item_price,product_final_price,order_status)
			                     VALUES (	'$neworder_id', '$user_info_id_value', '1','$product_id','$order_item_sku'
										   ,'ZENVEI GREEN','$ZENVEI_GREEN','$product_price',
										   '$product_finalprice','P'
										 )";
    			//if (!mysql_query($sql,$con)){die('Error : vm_order_item 3 ' . mysql_error());}
			}
			
			$ZENVEI_SILVER = $_POST['silver_qty'];
			if($ZENVEI_SILVER != 0)
			{
				$product_id = '4';	
				$order_item_sku = 'ZR4';
				
				if($Associates == 0){$product_finalprice = 32;}else{$product_finalprice = 35;}			

				
				$sql = "INSERT INTO jos_vm_order_item 
													(
														order_id, user_info_id, vendor_id,product_id	,
														order_item_sku,order_item_name, product_quantity, 
														product_item_price,product_final_price,order_status)
			                               
										   VALUES 	(	'$neworder_id', '$user_info_id_value',
										   				'1','$product_id','$order_item_sku',
										   				'ZENVEI SILVER','$ZENVEI_SILVER',
										   				'$product_price','$product_finalprice','P')";
				//if (!mysql_query($sql,$con)){die('Error :vm_order_item 4 ' . mysql_error());}
			}
			

?>				
		<script type='text/javascript' language="javascript"> 
		//alert("Thank you for your order. Your order has been successfully placed. A confirmation email has been sent to you.");
		
			//window.location.href = "purchasenow_form.php";
			//window.location.href = "http://localhost/Brandons/site/index.php?option=com_community&view=frontpage&itemid=15";
		
		</script>	
<?				

//mysql_close($con);
}
ob_end_flush();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Form</title>
<link type="text/css" rel="stylesheet" href="../css/style.css" />
<link type="text/css" rel="stylesheet" href="../css/datepicker.css" />

<script type="text/javascript" src="../js/jquery.pack.js"></script>
<script type="text/javascript" src="../js/ui.core.js"></script>
<script type="text/javascript" src="../js/ui.datepicker.js"></script>
<script type="text/javascript">
$(function(){
		   $('.dates').datepicker();
		   $('#dates').datepicker('option', {dateFormat: "dd-mm-yy",  
								  			 changeMonth: true, 
											 changeYear: true,
											 yearRange: '1920:2030'
											 });
		   
		   var lefti = ($(window).width()/2)+300;
		   $('#package').css({ 'left':  lefti+'px' });
		   
		   $('#as_buss').click(function(){
				
				if($(this).val()==1){
					
					$(this).val(0);
					$('.ssn_text').html('Tax ID');
					$('#buss_name_field').show();
					//$(this).attr('checked', 'checked');
				}else{
					
					$(this).val(1);
					$('.ssn_text').html('SSN/SIN');
					$('#buss_name_field').hide();
					//$(this).attr('checked', 'checked');
				}
			});
		   
		   
// Same as shipping Address 		   
		   $('#same_as_ship').click(function(){
				
				if($(this).val()==1){
					
					$(this).val(0);
					var ind = $('#state_ship').attr('selectedIndex');
					$('#add1_bill').val($('#add1_ship').val());
					$('#add2_bill').val($('#add2_ship').val());
					$('#city_bill').val($('#city_ship').val());
					$('#state_bill').attr('selectedIndex', ind);
					$('#zip_bill').val($('#zip_ship').val());
					$('#country_bill').val($('#country_ship').val());
					
					
				}else{
					
					$(this).val(1);
					
					
					$('#add1_bill').val('');
					$('#add2_bill').val('');
					$('#city_bill').val('');
					$('#zip_bill').val('');
					$('#state_bill').attr('selectedIndex', 0);
					$('#country_bill').val('');
				}
			});
		   

	$("#form").validate({
							
	    invalidHandler: function(form, validator) {
									$('label.error').html('');
		},
		rules: {
				  ship_method: "required",
				  //username: "required",
				  password: "required",
				  vpassword: {
						  required: true,
						  equalTo: "#password"
				  },
				  fname: "required",
				  lname: "required",
				  b_day2: "required",
				  //buss_name: "required",
				  email: {
						  required: true,
						  email: true
				  },
				  c_email: {
						  required: true,
						  equalTo: "#email"
				  },
				  ssn: "required",
				  c_ssn: {
						  required: true,
						  equalTo: "#ssn"
				  },
				  
				  
				  add1_ship: "required",
				  city_ship: "required",
				  country_ship: "required",
				  
				  card_type: "required",
				  name_card: "required",
				  card_no: "required",
				  expire_date: "required",
				  
				  csv: "required",
				  terms_policy: "required",
				  terms_condition: "required"
				  

		},// rules end
		
		messages: {
				//  name: "Please Enter Name",

		}// messages end
	});// validate
	
	
	
    
	 $("#tp1").change( function() {
		 
		 test = $("#tp1").val()
		//alert(test);
		
		if(test == 0)
		{
		
		//alert(test);
		
		$('span.mar').hide();
		$('span.bus').show();
		$('span.noauto').hide();		
		
		$('#rprice').html(32);
		$('#bprice').html(35);
		$('#gprice').html(32);
		$('#sprice').html(32);
		
		var red_total = parseInt($('#red_total').val());
		new_red_total = (red_total/35)*32
		var blue_total = parseInt($('#blue_total').val());
		new_blue_total = (blue_total/38)*35
		var green_total = parseInt($('#green_total').val());
		new_green_total = (green_total/35)*32
		var silver_total = parseInt($('#silver_total').val());
		new_silver_total = (silver_total/35)*32
		
		$('#red_total').val(new_red_total);
		$('#blue_total').val(new_blue_total);
		$('#green_total').val(new_green_total);
		$('#silver_total').val(new_silver_total);
		
		update();

		
		
	  }
				
	  else if(test == 1)
	  {
		//alert(test);
		
		$('span.mar').show();
		$('span.bus').hide();
		$('span.noauto').hide();		
		
		$('#rprice').html(35);
		$('#bprice').html(38);
		$('#gprice').html(35);
		$('#sprice').html(35);
		
		var red_total = parseInt($('#red_total').val());
		new_red_total = (red_total/32)*35
		var blue_total = parseInt($('#blue_total').val());
		new_blue_total = (blue_total/35)*38
		var green_total = parseInt($('#green_total').val());
		new_green_total = (green_total/32)*35
		var silver_total = parseInt($('#silver_total').val());
		new_silver_total = (silver_total/32)*35
		
		$('#red_total').val(new_red_total);
		$('#blue_total').val(new_blue_total);
		$('#green_total').val(new_green_total);
		$('#silver_total').val(new_silver_total);
		test = 0;
		update();
		}
		
	  			
	  else if(test == 2)
	  {
		//alert(test);
		
		$('span.mar').hide();
		$('span.bus').hide();
		$('span.noauto').show();		
		
		$('#rprice').html(35);
		$('#bprice').html(38);
		$('#gprice').html(35);
		$('#sprice').html(35);
		
		var red_total = parseInt($('#red_total').val());
		new_red_total = (red_total/32)*35
		var blue_total = parseInt($('#blue_total').val());
		new_blue_total = (blue_total/35)*38
		var green_total = parseInt($('#green_total').val());
		new_green_total = (green_total/32)*35
		var silver_total = parseInt($('#silver_total').val());
		new_silver_total = (silver_total/32)*35
		
		$('#red_total').val(new_red_total);
		$('#blue_total').val(new_blue_total);
		$('#green_total').val(new_green_total);
		$('#silver_total').val(new_silver_total);
		test = 0;
		update();
		}
	  
	  
	  } );
	
	
	$('#tp').toggle(function(){
									  
			
		$('span.mar').show();
		$('span.bus').hide();
		$('span.noauto').show();
		
		
		$('#rprice').html(35);
		$('#bprice').html(38);
		$('#gprice').html(35);
		$('#sprice').html(35);
		
		var red_total = parseInt($('#red_total').val());
		new_red_total = (red_total/32)*35
		var blue_total = parseInt($('#blue_total').val());
		new_blue_total = (blue_total/35)*38
		var green_total = parseInt($('#green_total').val());
		new_green_total = (green_total/32)*35
		var silver_total = parseInt($('#silver_total').val());
		new_silver_total = (silver_total/32)*35
		
		$('#red_total').val(new_red_total);
		$('#blue_total').val(new_blue_total);
		$('#green_total').val(new_green_total);
		$('#silver_total').val(new_silver_total);
		
		update();
		
		
		
	},function(){
										  
		$('span.mar').hide();
		$('span.bus').show();
		$('span.noauto').hide();
		
		
		$('#rprice').html(32);
		$('#bprice').html(35);
		$('#gprice').html(32);
		$('#sprice').html(32);
		
		var red_total = parseInt($('#red_total').val());
		new_red_total = (red_total/35)*32
		var blue_total = parseInt($('#blue_total').val());
		new_blue_total = (blue_total/38)*35
		var green_total = parseInt($('#green_total').val());
		new_green_total = (green_total/35)*32
		var silver_total = parseInt($('#silver_total').val());
		new_silver_total = (silver_total/35)*32
		
		$('#red_total').val(new_red_total);
		$('#blue_total').val(new_blue_total);
		$('#green_total').val(new_green_total);
		$('#silver_total').val(new_silver_total);
		
		update();
	});
	
	
	
//	var current = parseInt($('#current').html());
	
	$('#red_qty').change(function(){
								  
								  var qty = parseInt($(this).val());
								  var price = parseInt($('#rprice').html()); 
								  var item_total = qty*price;
								  $('#qtr').val(qty);
								  $('#red_total').val(item_total);
								  
								  shipping();
								  update();
	});
	$('#blue_qty').change(function(){
								  
								  var qty = parseInt($(this).val());
								  var price = parseInt($('#bprice').html()); 
								  var item_total = qty*price;
								  $('#qtb').val(qty);
								  $('#blue_total').val(item_total);
								  
								  shipping();
								  update();
	});
	$('#green_qty').change(function(){
								  
								  var qty = parseInt($(this).val());
								  var price = parseInt($('#gprice').html()); 
								  var item_total = qty*price;
								  $('#qtg').val(qty);
								  $('#green_total').val(item_total);

								  shipping();
								  update();
								  
	});
	$('#silver_qty').change(function(){
								  
								  var qty = parseInt($(this).val());
								  var price = parseInt($('#sprice').html());
								  var item_total = qty*price;
								  $('#qts').val(qty);
								  $('#silver_total').val(item_total);
								  shipping();
								  update();
	});
	

	

function update(){
	
	var red_total = parseInt($('#red_total').val());
	var blue_total = parseInt($('#blue_total').val());
	var green_total = parseInt($('#green_total').val());
	var silver_total = parseInt($('#silver_total').val());
	
	var prod_total = red_total+blue_total+green_total+silver_total;
	var shipping = parseInt($('#shipping').val());
	var tax_amount = (prod_total/100)*6.5;
    var all_total = prod_total+tax_amount+shipping;
	var auto_ship = prod_total+tax_amount+shipping;
	
	$('#prod_total').val(prod_total);
	$('#products_total').html(prod_total);
	
	$('#shipping_amount').html(shipping);
	
	$('#taxx').val(tax_amount.toFixed(2));
	$('#tax_amount').html(tax_amount.toFixed(2));
	
	$('#total_amount').html(all_total.toFixed(2));
	$('#totals').val(all_total.toFixed(2));
	
	$('#autoship_amount').html(auto_ship.toFixed(2));
	$('#auto_ships').val(auto_ship.toFixed(2));
}

function shipping(){
	
	var qtr = parseInt($('#qtr').val());
	var qtb = parseInt($('#qtb').val());
	var qtg = parseInt($('#qtg').val());
	var qts = parseInt($('#qts').val());
	
	var w_o_blue = qtr+qtg+qts;
	
	if(qtb==0){
		
		if(w_o_blue<=6){
			
			$('#shipping').val(8);
		}else{
			
			$('#shipping').val(16);
		}
	}else{
		
		if(qtb<3){
			
			if(w_o_blue>6){
				
				$('#shipping').val(28);	
				
			}else if((w_o_blue>0)){
				
				$('#shipping').val(20);	
				
			}else{
				
				$('#shipping').val(12);	
			}
		}else{
			
			if(w_o_blue>6){
				
				$('#shipping').val(40);	
				
			}else if((w_o_blue>0)){
				
				$('#shipping').val(32);	
				
			}else{
				
				$('#shipping').val(24);	
			}
		}
	}
	
}

}); // jQuery


</script>
<script type="text/javascript" src="../js/jquery.validate.pack.js"></script>
<!-- 
   Checking Usename is database
-->

<script src="../js/settings.js" type="text/javascript"></script>
<SCRIPT type="text/javascript">
	
	pic1 = new Image(15, 15); 
	pic1.src="../loader.gif";

	$(document).ready(function()
	{
		$("#username").change(function() 
		{ 
			var usr = $("#username").val();

			if(usr.length >= 3)
			{
				$("#status").html('<img src="../loader.gif" align="absmiddle">&nbsp;Checking availability...');

    			$.ajax({  
   			    type: "POST",  
    			url: "check.php",  
   				data: "username="+ usr,  
   			    success: function(msg){  
   
   				$("#status").ajaxComplete(function(event, request, settings){ 
				if(msg == 'OK')
				{ 
        			$("#username").removeClass('object_error'); // if necessary
					$("#username").addClass("object_ok");
					$(this).html('&nbsp;<img src="../accepted.png" align="absmiddle"> <font color="Green"> Congratulations your username is available </font>  ');
				}  
				else  
				{  
					$("#username").removeClass('object_ok'); // if necessary
					$("#username").addClass("object_error");
					$(this).html(msg);
				} });

	 			} }); 

			}
			else
			{
				$("#status").html('<font color="red">The username should have atleast <strong>3</strong> characters.</font>');
				$("#username").removeClass('object_ok'); // if necessary
				$("#username").addClass("object_error");
			}

		});

		});
				
//-->
</SCRIPT>
</head>

<body onLoad="">



<div id="header">
	<div id="Nav"><a href="signup.php">
	<img src="../images/header.jpg" alt="header" width="903" height="105" border="0" usemap="#Map" />
        <map name="Map" id="Map">
          <area shape="rect" coords="833,57,903,75" href="#" />
        <area shape="rect" coords="-4,39,83,56" href="http://www.zenvei.com/" />
        </map>
  </a></div>
<div id="personal"> </div>
    <!--end personal div -->
</div>
<!--end header div -->



<!--container div start -->
<div id="container">
<form id="form" method="post" action="">

<input type="hidden" id="red_total" value="0" />
<input type="hidden" id="blue_total" value="0" />
<input type="hidden" id="green_total" value="0" />
<input type="hidden" id="silver_total" value="0" />
<input type="hidden" id="prod_total" name="prod_total" value="0" />
<input type="hidden" id="qtr" value="0" />
<input type="hidden" id="qtb" value="0" />
<input type="hidden" id="qtg" value="0" />
<input type="hidden" id="qts" value="0" />
<input type="hidden" id="shipping" name="shippings" value="0" />
<input type="hidden" id="taxx" name="taxx" value="0" />
<input type="hidden" id="totals" name="totals" value="0" />
<input type="hidden" id="auto_ships" name="auto_ships" value="0" />



<h1>ZENVEI</h1>
   
    <table width="70%" border="0">
      <tr>
        <td align="center">
		
		<a href="purchase.php">Home</a> 
		| <a href="EditAutoShip.php">Update AutoShip</a> | 		<a href="login.php?action=logout">Logout </a></td>
      </tr>
    </table>
    
	<p>
      <select name="tp1" id="tp1">
        <option value="0">BUSINESS ASSOCIATE</option>
        <option value="1" selected="selected">MARKETING ASSOCIATE</option>
        <!--<option value="2">No AutoShip</option> -->
      </select>
    </p>
<!--step1 starts -->
<div id="step1">
       
    <h3>&nbsp;</h3>
    <table cellspacing="0" width="70">
        <tr>
          <td width="98" class="bold">ZENVEI RED</td>
          <td width="215">Improves and maintains cardiovascular function. </td>
          <td width="30" align="left" class="b">$<span id="rprice">32</span><!--<span class="bus">32</span><span class="mar">35</span> --></td>
          <td width="118">
          	<select name="red_qty" id="red_qty">
              <option value="0">Select Quantity</option>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
              <option value="6">6</option>
              <option value="7">7</option>
              <option value="8">8</option>
              <option value="9">9</option>
              <option value="10">10</option>
            </select>
          </td>
          <td width="225"><img src="../images/red_bottle.gif" alt="" width="225" height="236" /></td>
        </tr>
        <tr>
          <td class="bold">ZENVEI BLUE</td>
          <td>Immunity, brain function and cell therapy</td>
          <td align="left" class="b">$<span id="bprice">35</span></td>
          <td><select name="blue_qty" id="blue_qty">
              <option value="0">Select Quantity</option>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
              <option value="6">6</option>
              <option value="7">7</option>
              <option value="8">8</option>
              <option value="9">9</option>
              <option value="10">10</option>
          </select></td>
          <td><img src="../images/blue_bottle.gif" alt="" width="225" height="236" /></td>
        </tr>
        <tr>
          <td class="bold">ZENVEI GREEN </td>
          <td>Cellular detoxification</td>
          <td align="left" class="b">$<span id="gprice">32</span></td>
          <td><select name="green_qty" id="green_qty">
              <option value="0">Select Quantity</option>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
              <option value="6">6</option>
              <option value="7">7</option>
              <option value="8">8</option>
              <option value="9">9</option>
              <option value="10">10</option>
          </select></td>
          <td><img src="../images/green_bottle.gif" alt="" width="225" height="236" /></td>
        </tr>
        <tr>
          <td class="bold">ZENVEI SILVER</td>
          <td>True Colloidal Silver</td>
          <td align="left" class="b">$<span id="sprice">32</span></td>
          <td><select name="silver_qty" id="silver_qty">
              <option value="0">Select Quantity</option>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
              <option value="6">6</option>
              <option value="7">7</option>
              <option value="8">8</option>
              <option value="9">9</option>
              <option value="10">10</option>
          </select></td>
          <td><img src="../images/silver_bottle.png" alt="" width="225" height="236" /></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
    </table>
   
</div>
<!--ends step 1 -->


<div id="step2"></div>
<!--end step2 -->


<!--step3 starts -->
<div id="step3">
    <h3>&nbsp;</h3>
    </div>
<!--end step3 -->


<!--step4 start -->
<div id="step4">
  <h3><tr>
      <td width="129">
      
      <td colspan="3">&nbsp;</td>
      </tr></h3>
</div>
<!--end step4 -->

<h2>&nbsp;</h2>
<p class="ecxecxMsoNormal"> </p></p>
<p>&nbsp;</p>
<input type="submit" value="Quick Order" name="Submit" />
<p>&nbsp;</p> 

<p class="congrets">&nbsp;</p>
</form>  

</div>

</div>
<!--container div ends -->
    

<!--footer div start -->
<!--end footer -->

<div id="package">
    <table width="180" cellpadding="0" cellspacing="0">
   
        </tr>
        <tr>
            <td style="color: #55a51c; border-bottom: 0px solid #d5d6d0; padding: 5px 0px 5px 0px;">
                PRODUCT ORDER
            </td>
            <td align="right" style="border-bottom: 0px solid #d5d6d0; padding: 5px 0px 5px 0px; text-align: right">
                <span id="order_amount" style="font-weight: bold;">$<span id="products_total">0.00</span></span>
            </td>
        </tr>
        <tr>
            <td style="color: #55a51c; border-bottom: 0px solid #d5d6d0; padding: 5px 0px 5px 0px;">
                SHIPPING
            </td>
            <td align="right" style="border-bottom: 0px solid #d5d6d0; padding: 5px 0px 5px 0px; text-align: right">
                $<span id="shipping_amount" style="font-weight: bold;">0.00</span>
            </td>
        </tr>
        <tr>
            <td style="color: #55a51c; border-bottom: 0px solid #d5d6d0; padding: 5px 0px 5px 0px;">
                TAX
            </td>
            <td align="right" style="border-bottom: 0px solid #d5d6d0; padding: 5px 0px 5px 0px; text-align: right">
                $<span id="tax_amount" style="font-weight: bold;">0.00</span>
            </td>
        </tr>
        <tr>
            <td align="right" style="color: #64184c; border-bottom: 0px solid #d5d6d0; padding: 5px 0px 5px 0px; font-weight: bold; font-size: 14px;">
                <img src="../images/arrow.png" width="8" height="9" alt="" style="margin-right: 4px;" />TOTAL:
            </td>
            <td align="right" style="border-bottom: 0px solid #d5d6d0; padding: 5px 0px 5px 0px; text-align: right">
                $<span id="total_amount" style="font-weight: bold; font-size: 14px;">0.00</span>            </td>
      </tr>
    </table>
        </div>
    
    
</body>
</html>