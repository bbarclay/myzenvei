<?php
ob_start();
session_start();


		//localhost:3307
		
		/*	Test Sever Connection*/
		/*
			//$con = mysql_connect('127.0.0.1', 'zenveic_j014', '7XL6mRNumSUD');
			$con = mysql_connect('127.0.0.1', 'root', '');
			mysql_select_db('zenveic_mainzen');
		
		*/
		//Local Conection 
		$con = mysql_connect('localhost', 'root', '');
		mysql_select_db('myzenvei_testing');
		/* Setting Cookies Starts */
		//$user_cookie = $_COOKIE['cook_jaffiliate'];
				$user_cookie = 63;
				if(!empty($user_cookie))
				{
						$sql="SELECT userid,username FROM jos_jsusernames WHERE userid = '$user_cookie' ";
						$result = mysql_query($sql);
						$row = mysql_fetch_array($result);
						$refname = $row['username'];
				}
				
		/* Setting Cookies Ends */

		if(isset($_POST['Submit']))
		{			
			/* User Data Insertion Starts */			
				$First_Name = $_POST['fname'];
				$Last_Name = $_POST['lname'];
				$Username = $_POST['username'];
				$Email = $_POST['email'];
				$regDate = date("Y-m-d H:i:s");
				$Parameters = "admin_language=language=editor=helpsite=timezone=0";

			/* Joomla VM Password Code */
			
				//jimport('../joomla.user.helper');	
				//$p = $_POST['password'];
				//$salt  = JUserHelper::genRandomPassword(32);
				//$crypt = JUserHelper::getCryptedPassword($p, $salt);
				//$Password = $crypt.':'.$salt;
				$Password = '';
			/* Joomla VM Password Code End */
			
			$sql = "INSERT INTO jos_users(id, name, username, email, "."
										 password, usertype, block, sendEmail, "."
										 gid, registerDate, lastvisitDate,params) "."
								
								  VALUES (NULL, '$First_Name', '$Username', '$Email',
									   	  '$Password','Registered', 0, 1,
									 	  18, '$regDate', '0000-00-00 00:00:00','$Parameters')";
		
			if (!mysql_query($sql,$con)){die('Error: ' . mysql_error());}
			
			/*Getting ID of user last Inserted*/
			$newuser_id = mysql_insert_id();

			$sql="INSERT INTO jos_core_acl_aro VALUES (NULL, 'users', '$newuser_id', 0, '$Username', 0)";
			if (!mysql_query($sql,$con)){die('Error:core_acl_aro ' . mysql_error());}
			
			/*Getting inserted aro ID*/
			$aro_id = mysql_insert_id();
			
			$sql="INSERT INTO jos_core_acl_groups_aro_map VALUES (18, '', '$aro_id')";
			if (!mysql_query($sql,$con)){die('Error:jos_core_acl_groups_aro_map ' . mysql_error());}			
			
			/* User Information Data Insertion Starts */
			$Bussiness_Name = $_POST['buss_name'];
			$Day_Phone = $_POST['day_phone'];
			$Evening_Phone = $_POST['even_phone'];
			$Cell_Phone = $_POST['cell'];
			$Fax_Number = $_POST['fax'];
			$Birth_Day = $_POST['b_day2'];
			$CoApplicant_FirstName = $_POST['fname_co'];
			$CoApplicant_LastName = $_POST['lname_co'];
			$CoApplicant_BirthDay = $_POST['b_day_co'];
            
            /* Autoship Date */
            
           $vm_autoship_date = $_POST['vm_autoship_date'];            
            
			
			
			$Shipping_Address1 = $_POST['add1_ship'];
			$Shipping_Address2 = $_POST['add2_ship'];
			$Shipping_city = $_POST['city_ship'];
			$Shipping_state = $_POST['state_ship'];
			$Shipping_zip = $_POST['zip_ship'];
			//$Shipping_country = $_POST['country_ship'];
			$Shipping_country ='USA';
			
			$Billing_Address1 = $_POST['add1_bill'];
			$Billing_Address2 = $_POST['add2_bill'];
			$Billing_city = $_POST['city_bill'];
			$Billing_state = $_POST['state_bill'];
			$Billing_zip = $_POST['zip_bill'];
			$Billing_country ='USA';
			//$Billing_country = $_POST['country_bill'];			
			$Referre_name = $_POST['Referre'];	
			
			/* User Card information : Pend*/
			$Card_Type = $_POST['card_type'];
			$Name_on_Card = $_POST['name_card'];
			$Card_No = $_POST['card_no'];
			
			$edate = '01';
			$emonth = $_POST['expire_date'];
			$eyear = $_POST['expire_year'];
			
			$Card_Expriration = $eyear.'-'.$emonth.'-'.$edate;
			
			//registeration fee
			$reg_fee = $_POST['reg_fee'];
			
			$CSV = $_POST['csv'];
                        $SSN_SIN_TaxNo = $_POST['ssn'];
			$Ip_address = $_SERVER['REMOTE_ADDR'];
			#insertion of fixed registration fee
			
			$regfeeQuery = "insert into jos_fixed_reg_fee set regfee = '$reg_fee', userid = '$user_cookie', regdate = now()";
			if (!mysql_query($regfeeQuery, $con)){die('Error : jos_fixed_reg_fee: ' . mysql_error());}
			
			$user_info_id_value = 1;//md5( uniqid(_VIRTUEMART_SECRET ));
			$sql="INSERT INTO  jos_vm_user_info 
							   ( user_info_id , user_id   , address_type , address_type_name , 		"."
								 company      , last_name , first_name   , phone_1           , 		"."
								 phone_2      ,	fax       ,	address_1    , address_2  		 , 		"."
								 city  		  ,	state 	  ,	country 	 , zip 				 , 		"."
								 user_email	  , vm_coapplicant_firtsname , vm_coapplicant_lastname, "."
								 vm_coapplicant_birthday  , vm_card_type ,							"."		
								 vm_name_on_card	 	  , vm_card_number, vm_card_expirydate ,	"."
								 vm_csv_digits			  , vm_refferal_id_name				   ,	"."
								 vm_autoship_date		  ,	vm_ssn_number							"."
							   ) 																	"."
								
						VALUES ( 
								'$user_info_id_value','$newuser_id','BT'
								,'BT Address','$Bussiness_Name','$Last_Name',
								'$First_Name','$Day_Phone',
								'$Evening_Phone','$Fax_Number','$Shipping_Address1','$Shipping_Address2',
								'$Shipping_city','$Shipping_state','$Shipping_country','$Shipping_zip',
								'$Email','$CoApplicant_FirstName','$CoApplicant_LastName',
								'$CoApplicant_BirthDay','$Card_Type','$Name_on_Card',
								'$Card_No','$Card_Expriration','$CSV',
								'$Referre_name','$vm_autoship_date', '$SSN_SIN_TaxNo'
								
							  )";

			if (!mysql_query($sql,$con)){die('Error : user_info: ' . mysql_error());}
									
			/*Associates*/
			$Associates = $_POST['tp1']; 
			if($Associates == 0)		{$shoppergroup = 8;}
			elseif($Associates == 1)	{$shoppergroup = 6;}
			elseif($Associates == 2)	{$shoppergroup = 5;}
			
			/* Inserting  Shopper Group */
			$sql="INSERT INTO  jos_vm_shopper_vendor_xref (user_id,vendor_id,shopper_group_id) 
													VALUES('$newuser_id','1','$shoppergroup')";
			
			if (!mysql_query($sql,$con)){die('Error : shopper_vendor_xref: ' . mysql_error());}
			
			
			/* Inserting  JSUSERNAME */
			$rep_siteid = $_POST['replicated_siteid'];
			
			$sql="INSERT INTO  jos_jsusernames (userid,username) VALUES ('$newuser_id','$rep_siteid')";
			if (!mysql_query($sql,$con)){die('Error : jos_jsusernames: ' . mysql_error());}
			
			/* Tree Work Start */
			
			require  'components/com_mlm/members/graph_custom_functions.php';
		
			/* In $user_cookie we have id of Enrolling 
				$rep_siteid We have name of enrollred person
			*/
			if($user_cookie != '')
			{
			
				echo $root  = $user_cookie;
				echo '<br>'.$node  = $rep_siteid;
				echo '<br>'.$newuser_id;
				
				scan4place($root,1);
				insert_node($id2,$node,$newuser_id,$user_cookie,$shoppergroup);
				//echo rebuild_tree('bman',1);
				
			}
			else
			{
				$left = 1;
				$right = 2;

				$result = "INSERT INTO mlm_geneology_tree 
								   (userid       , username , lft     ,  rgt      , 
								   	parentid  ,  parent, ,  shopperid) 
									
							values ( '$newuser_id' , '$rep_siteid' , '$left' , '$right'  
									
									,  '0'  , '$rep_siteid' , '$shoppergroup')"; 
									 
   				mysql_query($result);

			} 
			/* Tree Work End */
			
			/* Community Section :All values written into 'jos_community_fields_values'  
			but field numbers come from  'jos_community_fields'	*/
 			
			$sql="INSERT INTO jos_community_fields_values (user_id,field_id,value) 
				  VALUES ('$newuser_id','3','$Birth_Day'),
						('$newuser_id','7','$Cell_Phone'),
						('$newuser_id','8','$Day_Phone'),
						('$newuser_id','9','$Shipping_Address1'),
						('$newuser_id','10','$Shipping_state'),
						('$newuser_id','11','$Shipping_city'),
						('$newuser_id','12','$Shipping_country')";
			
			if (!mysql_query($sql,$con)){die('Error : community_fields_values: ' . mysql_error());}
			
			/*Affiliate form information. jos_jafilia_user*/
			
			$sql="INSERT INTO  jos_jafilia_user (uid, firstname ,lastname ,	zipcode ,location ,mail ,fon ,published)
				  VALUES(
		 			  '$newuser_id','$First_Name','$Last_Name',
		 			  '$Shipping_zip','$Shipping_country','$Email','$Day_Phone','1'
					 )";
			if (!mysql_query($sql,$con)){die('Error : jafilia_user ' . mysql_error());}
				
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
			
			if (!mysql_query($sql,$con)){die('Error : vm_orders: ' . mysql_error());}
			
			
			/*Getting ID of Order last Inserted*/
    		$neworder_id = mysql_insert_id();
			
			$sql = "INSERT INTO jos_vm_order_history (order_id,order_status_code , date_added, customer_notified,comments) 
			
			
										VALUES ('$neworder_id','P', '$regDate', '0', 'This is a new order ...')";
			if (!mysql_query($sql,$con)){die('Error : order_history  ' . mysql_error());}
			
			 
			
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
			
			if (!mysql_query($sql,$con)){die('Error :order_user_info ' . mysql_error());}
			
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
				if (!mysql_query($sql,$con)){die('Error :vm_order_item 1 ' . mysql_error());}
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
				
				if (!mysql_query($sql,$con)){die('Error :vm_order_item 2 ' . mysql_error());}
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
    			if (!mysql_query($sql,$con)){die('Error : vm_order_item 3 ' . mysql_error());}
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
				if (!mysql_query($sql,$con)){die('Error :vm_order_item 4 ' . mysql_error());}
			}
						
			/*   Email code of Virtuemart   */
			// VirtueMart needs a bunch of things from the main Joomla code 
			require_once('includes/joomla.php' );
			// VirtueMart needs the sef code, whether you use it or not
			if (file_exists( 'components/com_sef/sef.php' )) {
			require_once( 'components/com_sef/sef.php' );
			} else {
			//require_once('includes/sef.php' );
			}
			/* 
				VirtueMart needs a mosMainframe object
			    $mainframe = new mosMainFrame( $database, '', $mosConfig_absolute_path ); */

			/*	This is the main VirtueMart code */
					
			require_once('components/com_virtuemart/virtuemart_parser.php' );
			/* We need the ps_checkout class so that we can call it's email_receipt function */
			require_once ( CLASSPATH . 'ps_checkout.php' );
			$ps_checkout = new ps_checkout ;
			$ps_checkout->email_receipt($neworder_id);
			
			/* Email code End */
?>				
		<script type='text/javascript' language="javascript"> 
		alert("Thank you for your order. Your order has been successfully placed. A confirmation email has been sent to you.");
		
			//window.location.href = "http://www.zenvei.com/index.php?option=com_community&view=frontpage&itemid=15";
			//window.location.href = "http://localhost/Brandons/site/index.php?option=com_community&view=frontpage&itemid=15";
		
		</script>	
<?php			

mysql_close($con);
}
ob_end_flush();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Form</title>
<link type="text/css" rel="stylesheet" href="css/style.css" />
<link type="text/css" rel="stylesheet" href="css/datepicker.css" />

<script type="text/javascript" src="js/jquery.pack.js"></script>
<script type="text/javascript" src="js/ui.core.js"></script>
<script type="text/javascript" src="js/ui.datepicker.js"></script>
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
				  replicated_siteid: "required",
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
		// alert(test);
		
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
	
	var reg_fee = parseFloat($('#reg_fee').val());
	var red_total = parseInt($('#red_total').val());
	var blue_total = parseInt($('#blue_total').val());
	var green_total = parseInt($('#green_total').val());
	var silver_total = parseInt($('#silver_total').val());
	
	var prod_total = red_total+blue_total+green_total+silver_total;
	var shipping = parseInt($('#shipping').val());
	var tax_amount = (prod_total/100)*6.5;
    var all_total = reg_fee+prod_total+tax_amount+shipping;
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
<script type="text/javascript" src="js/jquery.validate.pack.js"></script>
<!-- 
   Checking Usename is database
-->

<script src="js/settings.js" type="text/javascript"></script>
<SCRIPT type="text/javascript">
	
	pic1 = new Image(15, 15); 
	pic1.src = "loader.gif";

	$(document).ready(function()
	{
		$("#username").change(function() 
		{ 
			var usr = $("#username").val();

			if(usr.length >= 3)
			{
				$("#status").html('<img src="loader.gif" align="absmiddle">&nbsp;Checking availability...');

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
					$(this).html('&nbsp;<img src="accepted.png" align="absmiddle"> <font color="Green"> Congratulations your username is available </font>  ');
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
		
		
		$(document).ready(function()
		{
		$("#replicated_siteid").change(function() 
		{ 
			var usr = $("#replicated_siteid").val();

			if(usr.length >= 3)
			{
				$("#replicated_status").html('<img src="loader.gif" align="absmiddle">&nbsp;Checking availability...');

    			$.ajax({  
   			    type: "POST",  
    			url: "check.php",  
   				data: "replicated_siteid="+ usr,  
   			    success: function(msg){  
   
   				$("#replicated_status").ajaxComplete(function(event, request, settings){ 
				if(msg == 'OK')
				{ 
        			$("#replicated_siteid").removeClass('object_error'); // if necessary
					$("#replicated_siteid").addClass("object_ok");
					$(this).html('&nbsp;<img src="accepted.png" align="absmiddle"> <font color="Green"> Congratulations your site ID is available </font>  ');
				}  
				else  
				{  
					$("#replicated_siteid").removeClass('object_ok'); // if necessary
					$("#replicated_siteid").addClass("object_error");
					$(this).html(msg);
				} });

	 			} }); 

			}
			else
			{
				$("#replicated_status").html('<font color="red">The site ID should have atleast <strong>3</strong> characters.</font>');
				$("#replicated_siteid").removeClass('object_ok'); // if necessary
				$("#replicated_siteid").addClass("object_error");
			}

		});

		});

//-->
</SCRIPT>
</head>

<body>


<div id="header">
	<div id="Nav"></div>
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
<input type="hidden" id="reg_fee" name="reg_fee" value="39.00" />
<input type="hidden" id="qtr" value="0" />
<input type="hidden" id="qtb" value="0" />
<input type="hidden" id="qtg" value="0" />
<input type="hidden" id="qts" value="0" />
<input type="hidden" id="shipping" name="shippings" value="0" />
<input type="hidden" id="taxx" name="taxx" value="0" />
<input type="hidden" id="totals" name="totals" value="0" />
<input type="hidden" id="auto_ships" name="auto_ships" value="0" />



<h1>Join the ZENVEI Team</h1>

<!--step1 starts -->
<div id="step1">
       
    <h3>Enrollment Type:</h3>
    <p><span class="bus">BUSINESS</span><span class="mar" >MARKETING</span><span class="noauto" style="display:none;">MARKETING</span>  ASSOCIATE - Monthly autoship of $<span class="bus">128</span><span class="mar">70</span><span class="noauto" style="display:none;">0</span> or more </p>
    <p>Benefits include:</p>
    <p>
      <select name="tp1" id="tp1">
        <option value="0">BUSINESS ASSOCIATE</option>
        <option value="1">MARKETING ASSOCIATE</option>
        <option value="2">No AutoShip</option>
      </select>
    </p>
    <p>Auto Ship Date:</p>
    <p> 
      <select name="vm_autoship_date" id="vm_autoship_date">
        <option value="10">10th</option>
        <option value="20">20th</option>     
      </select>
      
    </p>
    <p>&nbsp;</p>
    <p><a href="#">Click here</a> to order products without creating an autoship order >></p>
    <p>&nbsp;</p>
    
    <h3>Registration Fee: </h3>
    <p>An annual registration fee of $39.00 will be added to your registration order. This fee will be automatically</p>
    <p> renewed each
      year unless you cancel your Zenvei membership.</p>
    <p>&nbsp;</p>    
    
    <h3>Select Monthly AutoShip Program.</h3>
    <p>Your first order will ship immedialtely and on that date every month thereafter, until you contact Zenvei<br /> to cancel. </p>
    <p>To qualify as a <span class="bus">Business</span><span class="mar">MARKETING</span><span class="noauto" style="display:none;">MARKETING</span>  Associate you must choose a combination of products totallying $<span class="bus">128</span><span class="mar">70</span><span class="noauto" style="display:none;">0</span></p>
    <p> or more. 
      To enjoy the benefits of a <span class="bus">Business</span><span class="mar">MARKETING</span><span class="noauto" style="display:none;">MARKETING</span>  Associate, your monthly qualifying purchase</p>
    <p> would be a combination 
      of products totallying $<span class="bus">128</span><span class="mar">70</span><span class="noauto" style="display:none;">0</span> or more.</p>
    <p>&nbsp;</p>
    
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
          <td width="225"><img src="/images/red_bottle.gif" alt="" width="225" height="236" /></td>
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
          <td><img src="/images/blue_bottle.gif" alt="" width="225" height="236" /></td>
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
          <td><img src="/images/green_bottle.gif" alt="" width="225" height="236" /></td>
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
          <td><img src="/images/silver_bottle.png" alt="" width="225" height="236" /></td>
        </tr>
        <tr>
          <td>Shipping Method</td>
          <td><select name="ship_method" id="ship_method">
            <option value="">Select Shipping Method</option>
            <option value="US Mail">US Mail</option>
          </select>
          </td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
    </table>
   
</div>
<!--ends step 1 -->


<div id="step2">
    
    <table cellspacing="0" width="100%">
        <tr>
          <td colspan="2"><h3>Step 1: User Inofrmation </h3></td>
          <td colspan="2" class="bold">&nbsp;</td>
        </tr>
        <tr>
          <td colspan="2"><div id="status">  &nbsp;</div></td>
          <td colspan="2"><div id="replicated_status">  &nbsp;</div></td>
        </tr>
        <tr>
          <td>*Username</td>
          <td>
		  <input id="username"  type="text" name="username" onKeyUp="twitter.updateUrl(this.value)"/> 
		  
		  
		 </td>
        <td>*


Replicated Site ID</td>
        <td><input id="replicated_siteid"  type="text" name="replicated_siteid" onKeyUp="twitter.updateUrl(this.value)"/></td>
        </tr>
      
        <tr>
          <td>*Password</td>
          <td><input name="password" type="password" id="password" /></td>
          <td>*Verify Password </td>
        <td class="bold"><input name="vpassword" type="password" id="vpassword" /></td>
        </tr>
        <tr>
          <td colspan="2"><h3>Step 2: Personal Info (Secure)</h3></td>
          <td colspan="2" class="bold">Signup as Business
          <input name="as_buss" type="checkbox" class="check" id="as_buss" value="1" /></td>
        </tr>
        <tr>
          <td width="15%" height="30">First Name:</td>
          <td width="33%">
            <input name="fname" type="text" id="fname" />
          </td>
          <td width="17%">Last Name: </td>
          <td width="35%"><input name="lname" type="text" id="lname" /></td>
        </tr>
        <tr>
          <td>Birthday: </td>
          <td><input name="b_day2" type="text"  id="b_day2" /></td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr id="buss_name_field">
          <td>Business Name: </td>
          <td colspan="3"><input name="buss_name" type="text" class="large" id="buss_name" /></td>
        </tr>
        <tr>
          <td>Email: </td>
          <td><input name="email" type="text" id="email" /></td>
          <td>Confirm Email: </td>
          <td><input name="c_email" type="text" id="c_email" /></td>
        </tr>
        <tr>
          <td><span class="ssn_text">SSN/SIN:</span> </td>
          <td><input name="ssn" type="text" id="ssn" /></td>
          <td>Confirm <span class="ssn_text">SSN/SIN:</span> </td>
          <td><input name="c_ssn" type="text" id="c_ssn" /></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td class="bold">Why do you need my SSN/SIN? </td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>Daytime Phone: </td>
          <td><input name="day_phone" type="text" id="day_phone" /></td>
          <td>Evening Phone: </td>
          <td><input name="even_phone" type="text" id="even_phone" /></td>
        </tr>
        <tr>
          <td>Cell Phone: </td>
          <td><input name="cell" type="text" id="cell" /></td>
          <td>Fax Number: </td>
          <td><input name="fax" type="text" id="fax" /></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td class="bold">CoApplicant Information:(optional) </td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>First Name: </td>
          <td><input name="fname_co" type="text" id="fname_co" /></td>
          <td>Last Name: </td>
          <td><input name="lname_co" type="text" id="lname_co" /></td>
        </tr>
        <tr>
          <td>Birthday: </td>
          <td><input name="b_day_co" type="text" id="b_day_co" /></td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
    </table>

</div>
<!--end step2 -->


<!--step3 starts -->
<div id="step3">
    <h3>Step 3: Payment Info (Secure)</h3>
    <table cellspacing="0" width="96%">
        <tr>
          <td colspan="2" class="bold">Shipping Address: (No PO Boxes)</td>
          <td width="156"></td>
          <td width="252"></td>
        </tr>
        <tr>
          <td width="147">Address 1: </td>
          <td colspan="3"><input name="add1_ship" type="text" class="large" id="add1_ship" /></td>
        </tr>
        <tr>
          <td>Address 2: </td>
          <td colspan="3"><input name="add2_ship" type="text" class="large" id="add2_ship" /></td>
        </tr>
        <tr>
          <td>City: </td>
          <td width="275"><input name="city_ship" type="text" id="city_ship" /></td>
          <td>State:</td>
          <td><select name="state_ship" id="state_ship">
            <option value="">Select a state</option>
            <option value="AL">Alabama</option>
            <option value="AK">Alaska</option>
            <option value="AZ">Arizona</option>
            <option value="AR">Arkansas</option>
            <option value="CA">California</option>
            <option value="CO">Colorado</option>
            <option value="CT">Connecticut</option>
            <option value="DE">Delaware</option>
            <option value="DC">District of Columbia</option>
            <option value="FL">Florida</option>
            <option value="GA">Georgia</option>
            <option value="HI">Hawaii</option>
            <option value="ID">Idaho</option>
            <option value="IL">Illinois</option>
            <option value="IN">Indiana</option>
            <option value="IA">Iowa</option>
            <option value="KS">Kansas</option>
            <option value="KY">Kentucky</option>
            <option value="LA">Louisiana</option>
            <option value="ME">Maine</option>
            <option value="MD">Maryland</option>
            <option value="MA">Massachusetts</option>
            <option value="MI">Michigan</option>
            <option value="MS">Mississippi</option>
            <option value="MO">Missouri</option>
            <option value="MT">Montana</option>
            <option value="NE">Nebraska</option>
            <option value="NV">Nevada</option>
            <option value="NH">New Hampshire</option>
            <option value="NJ">New Jersey</option>
            <option value="NM">New Mexico</option>
            <option value="NY">New York</option>
            <option value="NC">North Carolina</option>
            <option value="ND">North Dakota</option>
            <option value="OH">Ohio</option>
            <option value="OK">Oklahoma</option>
            <option value="OR">Oregon</option>
            <option value="PA">Pennsylvania</option>
            <option value="RI">Rhode Island</option>
            <option value="SC">South Carolina</option>
            <option value="SD">South Dakota</option>
            <option value="TN">Tennessee</option>
            <option value="TX">Texas</option>
            <option value="UT">Utah</option>
            <option value="VT">Vermont</option>
            <option value="VA">Virginia</option>
            <option value="WA">Washington</option>
            <option value="DC">Washington D.C.</option>
            <option value="WV">West Virginia</option>
            <option value="WI">Wisconsin</option>
            <option value="WY">Wyoming</option>
          </select></td>
        </tr>
        <tr>
          <td height="63">Zip:</td>
          <td><input name="zip_ship" type="text" id="zip_ship" /></td>
          <td>Country: </td>
          <td><input name="country_ship" type="text" id="country_ship"  value="USA"/></td>
        </tr>
        <tr>
          <td height="63"></td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td></td>
        </tr>
        <tr>
          <td height="63" class="bold">Billing Address:</td>
          <td valign="top">Same as shipping          
          <input name="same_as_ship" type="checkbox" class="check" id="same_as_ship" value="1" /></td>
          <td>&nbsp;</td>
          <td></td>
        </tr>
        <tr>
          <td>Address 1: </td>
          <td colspan="3"><input name="add1_bill" type="text" class="large" id="add1_bill" /></td>
        </tr>
        <tr>
          <td>Address 2: </td>
          <td colspan="3"><input name="add2_bill" type="text" class="large" id="add2_bill" /></td>
        </tr>
        <tr>
          <td>City: </td>
          <td><input name="city_bill" type="text" id="city_bill" /></td>
          <td>State:</td>
          <td><select name="state_bill" id="state_bill">
              <option value="">Select a state</option>
              <option value="AL">Alabama</option>
              <option value="AK">Alaska</option>
              <option value="AZ">Arizona</option>
              <option value="AR">Arkansas</option>
              <option value="CA">California</option>
              <option value="CO">Colorado</option>
              <option value="CT">Connecticut</option>
              <option value="DE">Delaware</option>
              <option value="DC">District of Columbia</option>
              <option value="FL">Florida</option>
              <option value="GA">Georgia</option>
              <option value="HI">Hawaii</option>
              <option value="ID">Idaho</option>
              <option value="IL">Illinois</option>
              <option value="IN">Indiana</option>
              <option value="IA">Iowa</option>
              <option value="KS">Kansas</option>
              <option value="KY">Kentucky</option>
              <option value="LA">Louisiana</option>
              <option value="ME">Maine</option>
              <option value="MD">Maryland</option>
              <option value="MA">Massachusetts</option>
              <option value="MI">Michigan</option>
              <option value="MS">Mississippi</option>
              <option value="MO">Missouri</option>
              <option value="MT">Montana</option>
              <option value="NE">Nebraska</option>
              <option value="NV">Nevada</option>
              <option value="NH">New Hampshire</option>
              <option value="NJ">New Jersey</option>
              <option value="NM">New Mexico</option>
              <option value="NY">New York</option>
              <option value="NC">North Carolina</option>
              <option value="ND">North Dakota</option>
              <option value="OH">Ohio</option>
              <option value="OK">Oklahoma</option>
              <option value="OR">Oregon</option>
              <option value="PA">Pennsylvania</option>
              <option value="RI">Rhode Island</option>
              <option value="SC">South Carolina</option>
              <option value="SD">South Dakota</option>
              <option value="TN">Tennessee</option>
              <option value="TX">Texas</option>
              <option value="UT">Utah</option>
              <option value="VT">Vermont</option>
              <option value="VA">Virginia</option>
              <option value="WA">Washington</option>
              <option value="DC">Washington D.C.</option>
              <option value="WV">West Virginia</option>
              <option value="WI">Wisconsin</option>
              <option value="WY">Wyoming</option>
          </select></td>
        </tr>
        <tr>
          <td>Zip:</td>
          <td><input name="zip_bill" type="text" id="zip_bill" /></td>
          <td>Country: </td>
          <td><input name="country_bill" type="text" id="country_bill" value="USA" /></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td></td>
          <td></td>
        </tr>
        <tr>
          <td colspan="2" class="bold">&nbsp;</td>
          <td></td>
          <td></td>
        </tr>
        <tr>
          <td colspan="2" class="bold">Credit Card Information: </td>
          <td></td>
          <td></td>
        </tr>
        <tr>
          <td>Card Type: </td>
          <td>
          	<select name="card_type" id="card_type">
            	<option value="AMEX">American Express</option>
                <option value="Visa">Visa</option>
                <option value="MasterCard">MasterCard</option>
                <option value="Discover">Discover</option>
            </select>
          </td>
          <td>Name on Card: </td>
          <td><input name="name_card" type="text" id="name_card" /></td>
        </tr>
        <tr>
          <td>Card Number: </td>
          <td><input name="card_no" type="text" id="card_no" maxlength="18" /></td>
          <td>Expiration Date: </td>
          <td>
		  <select id="expire_date" name="expire_date">
		  <option value=''>Select Month</option>
		<option value='01'>January</option>
		<option value='02'>February</option>
		<option value='03'>March</option>
		<option value='04'>April</option>
		<option value='05'>May</option>
		<option value='06'>June</option>
		<option value='07'>July</option>
		<option value='08'>August</option>
		<option value='09'>September</option>
		<option value='10'>October</option>
		<option value='11'>November</option>
		<option value='12'>December</option>
		</select>
/
	  <select id="expire_year" name="expire_year">
		<option value='2010'>2010</option>
		<option value='2011'>2011</option>
		<option value='2012'>2012</option>
		<option value='2013'>2013</option>
		<option value='2014'>2014</option>
		<option value='2015'>2015</option>

		</select>


</td>
        </tr>
        <tr>
          <td>CSV 3 or 4 Digits: </td>
          <td><input name="csv" type="text" id="csv" maxlength="18" /></td>
          <td></td>
          <td></td>
        </tr>
    </table>

</div>
<!--end step3 -->


<!--step4 start -->
<div id="step4">
<?php
if($refname != '' And $_COOKIE['cook_jaffiliate'] != '')
{$dis = '';}
else $dis='';

?>
    <h3>Step 4: Referring Associate Name or ID:
      <tr>
          <td width="129">
          <td colspan="3"><input name="Referre" type="text" class="large" id="Referre" value="<?php echo $refname;?>" <?php echo $dis; ?> /></td>
        </tr></h3>
</div>
<!--end step4 -->

<h2>Terms &amp; Conditions</h2>
<p>To become a ZENVEI Associate, you must acknowledge that you have read, understand, and agree<br /> to the  Terms &amp; Conditions. </p>
<p>If you have not already done so, click on the links below to read and print these documents then check<br /> the boxes to indicate your agreement.</p> 
<p>&nbsp;</p>

<p><input name="terms_condition" type="checkbox" class="check" id="terms_condition" /> &nbsp;I have read, understand and agree to abide by the terms set forth in the <<p class="ecxecxMsoNormal"> </p>
<p class="ecxecxMsoNormal"><a rel="lightbox" href="https://www.zenvei.com/index.php?option=com_content&amp;view=article&amp;id=44" class="jcepopup">Terms and Conditions</a></p>
<p class="ecxecxMsoNormal"> </p></p>
<p>&nbsp;</p>
<input type="submit" value="Submit Now!" name="Submit" />
<p>&nbsp;</p> 

<p class="congrets">Congratulations!  This will submit your enrollment and  your order will be shipped within 72 hours.  You should talk with your  </p>
<p class="congrets">Referring Associate immediately for any questions and information you  require.  Thank you for your interest in Zenvei International!</p>
<p class="red">Please note it may take a few moments to process your credit card.</p>
<p class="red b">To avoid multiple charges, please do not click the continue button more than once.</p>    

</form>  

</div>

</div>
<!--container div ends -->
    

<!--footer div start -->
<!--end footer -->

<div id="package">
    <table width="180" cellpadding="0" cellspacing="0">
        <tr id="row_signup_fee">
            <td valign="bottom" style="color: #55a51c; border-bottom: 1px solid #d5d6d0; padding: 5px 0px 5px 0px;">
                REGIST. FEE

            </td>
            <td valign="bottom" align="right" style="border-bottom: 1px solid #d5d6d0; padding: 5px 0px 5px 0px; text-align: right">
                <span id="fee_amount" style="font-weight: bold;">$39.00</span>
            </td>
        </tr>
        <tr>
            <td style="color: #55a51c; border-bottom: 1px solid #d5d6d0; padding: 5px 0px 5px 0px;">
                PRODUCT ORDER
            </td>
            <td align="right" style="border-bottom: 1px solid #d5d6d0; padding: 5px 0px 5px 0px; text-align: right">
                <span id="order_amount" style="font-weight: bold;">$<span id="products_total">0.00</span></span>
            </td>
        </tr>
        <tr>
            <td style="color: #55a51c; border-bottom: 1px solid #d5d6d0; padding: 5px 0px 5px 0px;">
                SHIPPING
            </td>
            <td align="right" style="border-bottom: 1px solid #d5d6d0; padding: 5px 0px 5px 0px; text-align: right">
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
                <img src="/images/arrow.png" width="8" height="9" alt="" style="margin-right: 4px;" />TOTAL:
            </td>
            <td align="right" style="border-bottom: 0px solid #d5d6d0; padding: 5px 0px 5px 0px; text-align: right">
                $<span id="total_amount" style="font-weight: bold; font-size: 14px;">39.00</span>
            </td>
        </tr>
    </table>
        Your AutoShip order will be charged monthly at an amount of $<span id="autoship_amount">
            0.00</span>
</div>
    
    
</body>
</html>
