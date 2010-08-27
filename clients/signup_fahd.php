<?php
//defined( '_JEXEC' ) or die( 'Restricted access' );

ini_set('memory_limit', '40M');

/* Initialize Joomla framework */
define( '_JEXEC', 1 );
define('JPATH_BASE', dirname(__FILE__) );
define( 'DS', DIRECTORY_SEPARATOR );
include('../configuration.php');


//require_once ( JPATH_BASE .DS.'../includes'.DS.'defines.php' );

//Joomla framework path definitions
$parts = explode( DS, JPATH_BASE );
array_pop( $parts );

define( 'JPATH_ROOT',			implode( DS, $parts ) );
define( 'JPATH_SITE',			JPATH_ROOT );
define( 'JPATH_CONFIGURATION',	JPATH_ROOT );
define( 'JPATH_INSTALLATION',	JPATH_ROOT . DS . 'installation' );
define( 'JPATH_ADMINISTRATOR',	JPATH_ROOT . DS . 'administrator' );
define( 'JPATH_XMLRPC', 		JPATH_ROOT . DS . 'xmlrpc' );
define( 'JPATH_LIBRARIES',		JPATH_ROOT . DS . 'libraries' );
define( 'JPATH_PLUGINS',		JPATH_ROOT . DS . 'plugins'   );
define( 'JPATH_CACHE',			JPATH_BASE . DS . 'cache');
define( 'JPATH_INCLUDES',		JPATH_ROOT . DS . 'includes');

require_once ( JPATH_BASE .DS.'../includes'.DS.'framework.php' );

if (! class_exists('JLoader')) {
//    require_once( dirname(__FILE__)  .'/../libraries/loader.php' );
}

    require_once( dirname(__FILE__)  .'/../libraries/joomla/import.php' );
    require_once( dirname(__FILE__)  .'/../plugins/system/legacy/mainframe.php' );

//	JLoader::register('JApplication' , JPATH_LIBRARIES.DS.'joomla'.DS.'application'.DS.'application.php');

/* Required Files */
require_once ( JPATH_INCLUDES .DS.'defines.php' );
require_once ( JPATH_INCLUDES .DS.'framework.php' );
/* To use Joomla's Database Class */
require_once ( JPATH_LIBRARIES .DS.'joomla'.DS.'factory.php' );
/* Create the Application */
$mainframe =& JFactory::getApplication('site');


#to include the language folder in the file
$language =& JFactory::getLanguage();
$language->load('clients' , dirname(__FILE__), $language->getTag(), true);

// trigger the onAfterInitialise events

JDEBUG ? $_PROFILER->mark('afterInitialise') : null;

$mainframe->triggerEvent('onAfterInitialise');

/**************************************************/


		#####################################################################
		/*Config is custom file which takes (user,pass,host,DB) from joomla configration file*/
		include('../dbCustomConnection.php');
		/* Setting Cookies Starts */
  
		   $user_cookie = $_COOKIE['cook_jaffiliate'];
		    if(!empty($user_cookie))
		    {
		      $sql="SELECT userid,username FROM jos_jsusernames WHERE userid = ".$user_cookie;
		      $result = $myzDb->query($sql);
		      $row = $myzDb->fetchRow();
		      $refname = $row['username'];
		    }
    
 			 /* Setting Cookies Ends */
			


		if(isset($_POST['Submit']))
		{
		
			/* User Data Insertion Starts */			
			$First_Name = $_POST['fname'][0];
			$Last_Name = $_POST['lname'][0];
			$Username = $_POST['username'][0];
			$Email = $_POST['email'][0];
			$regDate = date("Y-m-d H:i:s");
			$Parameters = "admin_language=language=editor=helpsite=timezone=0";
			/* User Information Data Insertion Starts */
			$Bussiness_Name = $_POST['buss_name'][0];
			$Day_Phone = $_POST['day_phone'][0];
			$Evening_Phone = $_POST['even_phone'][0];
			$Cell_Phone = $_POST['cell'][0];
			$Fax_Number = $_POST['fax'][0];
			$Birth_Day = $_POST['b_day2'][0];
			$CoApplicant_FirstName = $_POST['fname_co'][0];
			$CoApplicant_LastName = $_POST['lname_co'][0];
			$CoApplicant_BirthDay = $_POST['b_day_co'][0];
            
            /* Autoship Date */
              $vm_autoship_date = $_POST['vm_autoship_date'][0];          
            			
			$Shipping_Address1 = $_POST['add1_ship'][0];
			$Shipping_Address2 = $_POST['add2_ship'][0];
			$Shipping_city = $_POST['city_ship'][0];
			$Shipping_state = $_POST['state_ship'][0];
			$Shipping_zip = $_POST['zip_ship'][0];
			//$Shipping_country = $_POST['country_ship'];
			$Shipping_country ='USA';
			
			$Billing_Address1 = $_POST['add1_bill'][0];
			$Billing_Address2 = $_POST['add2_bill'][0];
			$Billing_city = $_POST['city_bill'][0];
			$Billing_state = $_POST['state_bill'][0];
			$Billing_zip = $_POST['zip_bill'][0];
			$Billing_country ='USA';
			//$Billing_country = $_POST['country_bill'];			
			$Referre_name = $_POST['Referre'];	
			
			/* User Card information : Pend*/
			$Card_Type = $_POST['card_type'][0];
			$Name_on_Card = $_POST['name_card'][0];
			$Card_No = $_POST['card_no'][0];
			
			$edate = '01';
			$emonth = $_POST['expire_date'][0];
			$eyear = $_POST['expire_year'][0];
			
			$Card_Expriration = $eyear.'-'.$emonth.'-'.$edate;
			$c_cdate = time();
			$m_mdate = time();
			//registeration fee
			$reg_fee = $_POST['reg_fee'];
			
			$CSV = $_POST['csv'][0];
                        $SSN_SIN_TaxNo = $_POST['ssn'][0];
			$Ip_address = $_SERVER['REMOTE_ADDR'];
			/* Joomla VM Password Code */
			
				jimport('joomla.user.helper');
				$p = $_POST['password'][0];
				$salt  = JUserHelper::genRandomPassword(32);
				$crypt = JUserHelper::getCryptedPassword($p, $salt);
				//echo 'pass :  '.$Password = $crypt.':'.$salt;
				$Password = $crypt.':'.$salt;
				//$Password = '2c7e2a2381c7fd93a279f23aca0ee025:fGnnFX6OZqgdHKWk6o4RVVNGbXJQtXXK';

			/* Joomla VM Password Code End */
			
			$sql = "INSERT INTO jos_users(id, name, username, email, "."
										 password, usertype, block, sendEmail, "."
										 gid, registerDate, lastvisitDate,params) "."
								
								  VALUES (NULL, '$First_Name', '$Username', '$Email',
									   	  '$Password','Registered', 0, 1,
									 	  18, '$regDate', '0000-00-00 00:00:00','$Parameters')";
		
			if ($myzDb->execute($sql))
			{
				/*Getting ID of user last Inserted*/
				$newuser_id = $myzDb->insertID();
			}
			$sql="INSERT INTO jos_core_acl_aro VALUES ('','users', '$newuser_id', '0', '$Username', '0')";
			if (!$myzDb->query($sql)){die('Error 2 : core_acl_aro ' . mysql_error());}
			
			/*Getting inserted aro ID*/
			$aro_id = $myzDb->insertID();
			
			$sql="INSERT INTO jos_core_acl_groups_aro_map VALUES (18, '', '$aro_id')";
			if (!$myzDb->query($sql)){die('Error 3: jos_core_acl_groups_aro_map ' . mysql_error());}			
			
			
			#insertion of fixed registration fee
			$seconds	=30*86400;
			$to_date	=time();
			$from_date	=$to_date+$seconds;
			$to_date	=time()-86400;
			$to_date	=date("Y-m-d",$to_date);
			$from_date	=date("Y-m-d",$from_date);
			
			$regfeeQuery = "insert into jos_fixed_reg_fee set regfee = '$reg_fee', userid = '$newuser_id', regdate = now(),nextpaymentdate='$from_date' ";
		    if (!$myzDb->query($regfeeQuery)){die('Error 4: jos_fixed_reg_fee: ' . mysql_error());}
			
			$user_info_id_value = md5( uniqid(_VIRTUEMART_SECRET ));
			$sql="INSERT INTO  jos_vm_user_info 
							   ( user_info_id , user_id   , address_type , address_type_name , 		"."
								 company      , last_name , first_name   , phone_1           , 		"."
								 phone_2      ,	fax       ,	address_1    , address_2  		 , 		"."
								 city  		  ,	state 	  ,	country 	 , zip 				 , 		"."
								 user_email	  , vm_coapplicant_firtsname , vm_coapplicant_lastname, "."
								 vm_coapplicant_birthday  , vm_card_type ,							"."		
								 vm_name_on_card	 	  , vm_card_number, vm_card_expirydate ,	"."
								 vm_csv_digits			  , vm_refferal_id_name				   ,	"."
								 vm_ssn_number		  ,	vm_autoship_date							"."
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
								'$Referre_name','$SSN_SIN_TaxNo', '$vm_autoship_date'
								
							  )";

			if (!$myzDb->query($sql)){die('Error 5: user_info: ' . $myzDb->error());}
									
			/*Associates*/
			$Associates = $_POST['tp1']; 
			if($Associates == 0)		{$shoppergroup = 8;}
			elseif($Associates == 1)	{$shoppergroup = 6;}
			elseif($Associates == 2)	{$shoppergroup = 5;}
			
			/* Inserting  Shopper Group */
			$sql="INSERT INTO  jos_vm_shopper_vendor_xref (user_id,vendor_id,shopper_group_id) 
													VALUES('$newuser_id','1','$shoppergroup')";
			
			if (!$myzDb->query($sql)){die('Error 6: shopper_vendor_xref: ' . mysql_error());}
			
			
			/* Inserting  JSUSERNAME */
			$rep_siteid = $_POST['replicated_siteid'][0];
			
			$sql="INSERT INTO  jos_jsusernames (userid,username) VALUES ('$newuser_id','$rep_siteid')";
			if (!$myzDb->query($sql)){die('Error 7: jos_jsusernames: ' . $myzDb->error());}
			
		
			
			/* Tree Work Start */
			
			require  '../components/com_mlm/members/graph_custom_functions.php';
		
			/* In $user_cookie we have id of Enrolling 
				$rep_siteid We have name of enrollred person
			*/
			if($user_cookie != '')
			{
			
				$root  = $user_cookie;
				$node  = $rep_siteid;
								
				scan4place($root,1);
				insert_node($id2,$node,$newuser_id,$user_cookie,$shoppergroup);
				calculate_commisions($root);
				
			}
			else
			{
				$left = 1;
				$right = 2;
				$v_position = "M";
				 $result = "INSERT INTO mlm_geneology_tree 
								   (userid       , username , lft     ,  rgt      , 
								   	parentid  ,  parent,  shopperid, position,datejoining,status) 
									
							values ( '$newuser_id' , '$rep_siteid' , '$left' , '$right'  
									
									,  '0'  , '$rep_siteid' , '$shoppergroup', '$v_position',now(),0 )"; 
								 
   				if(!$myzDb->query($result)){die('Error 7: mlm_geneology_tree: ' . mysql_error());}

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
			
			if (!$myzDb->query($sql)){die('Error : community_fields_values: ' . mysql_error());}
			
			/*Affiliate form information. jos_jafilia_user*/
			
			$sql="INSERT INTO  jos_jafilia_user (uid, firstname ,lastname ,	zipcode ,location ,mail ,fon ,published)
				  VALUES(
		 			  '$newuser_id','$First_Name','$Last_Name',
		 			  '$Shipping_zip','$Shipping_country','$Email','$Day_Phone','1'
					 )";
			if (!$myzDb->query($sql)){die('Error : jafilia_user ' . mysql_error());}
				
			$PRODUCT_ORDER  = $_POST['prod_total'];
			$Shipping_Method = $_POST['ship_method'][0]; 
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
								  ship_method_id, ip_address,cdate,mdate)
			 			
						VALUES  ( '$newuser_id', '1','$order_number_value','$user_info_id_value',
								 '$TOTAL', '$PRODUCT_ORDER', '$TAX', '$Shipping', 'P', 
								 '$ship_method_id', '$Ip_address','$c_cdate','$m_mdate')";
			
			if (!$myzDb->query($sql)){die('Error : vm_orders: ' . mysql_error());}
			
			
			/*Getting ID of Order last Inserted*/
    		$neworder_id = $myzDb->insertID();
			
			$sql = "INSERT INTO jos_vm_order_history (order_id,order_status_code , date_added, customer_notified,comments) 
			
			
										VALUES ('$neworder_id','P', '$regDate', '0', 'This is a new order ...')";
			if (!$myzDb->query($sql)){die('Error : order_history  ' . mysql_error());}
			
			 
			
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
			
			if (!$myzDb->query($sql)){die('Error :order_user_info ' . mysql_error());}
			
			$ZENVEI_RED = $_POST['quantity'][0];
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
							product_item_price,product_final_price,order_status,cdate,mdate
						)
                       VALUES 
			   			( 	'$neworder_id', '$user_info_id_value', '1','$product_id',
			   		   		'$order_item_sku','ZENVEI RED','$ZENVEI_RED','$product_price',
					   		'$product_finalprice','P','$c_cdate','$m_mdate'
						)";
						var_dump($sql);
				if (!$myzDb->query($sql)){die('Error :vm_order_item 1 ' . mysql_error());}
			}
		
			$ZENVEI_BLUE = $_POST['quantity'][1];
			
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
					     product_final_price,order_status,cdate,mdate)
                          
		   				VALUES ('$neworder_id', '$user_info_id_value',
		   					'1','$product_id_' ,
		   					'$order_item_sku_','ZENVEI BLUE',
		   					'$ZENVEI_BLUE','$product_price',
		   					'$product_finalprice','P','$c_cdate','$m_mdate')";
				
				if (!$myzDb->query($sql)){die('Error :vm_order_item 2 ' . mysql_error());}
			}
			$ZENVEI_GREEN = $_POST['quantity'][2];
 			
			if($ZENVEI_GREEN != 0)
			{
				$product_id = '2';	
				$order_item_sku = 'ZR3';
				if($Associates == 0){$product_finalprice = 32;}else{$product_finalprice = 35;}
				

				$sql = "INSERT INTO jos_vm_order_item 
										(
											order_id, user_info_id, vendor_id,product_id	,
											order_item_sku,order_item_name,product_quantity,
											product_item_price,product_final_price,order_status,cdate,mdate)
			                     VALUES (	'$neworder_id', '$user_info_id_value', '1','$product_id','$order_item_sku'
										   ,'ZENVEI GREEN','$ZENVEI_GREEN','$product_price',
										   '$product_finalprice','P','$c_cdate','$m_mdate'
										 )";
    			if (!$myzDb->query($sql)){die('Error : vm_order_item 3 ' . mysql_error());}
			}
			
			$ZENVEI_SILVER = $_POST['quantity'][3];
			if($ZENVEI_SILVER != 0)
			{
				$product_id = '4';	
				$order_item_sku = 'ZR4';
				
				if($Associates == 0){$product_finalprice = 32;}else{$product_finalprice = 35;}			

				
				$sql = "INSERT INTO jos_vm_order_item 
						(
						order_id, user_info_id, vendor_id,product_id	,
						order_item_sku,order_item_name, product_quantity, 
						product_item_price,product_final_price,order_status,cdate,mdate)
                          
		   				VALUES 	(	'$neworder_id', '$user_info_id_value',
		   				'1','$product_id','$order_item_sku',
		   				'ZENVEI SILVER','$ZENVEI_SILVER',
		   				'$product_price','$product_finalprice','P','$c_cdate','$m_mdate')";
				if (!$myzDb->query($sql)){die('Error :vm_order_item 4 ' . mysql_error());}
			}
						
			/*   Email code of Virtuemart   */
			// VirtueMart needs a bunch of things from the main Joomla code 
			require_once('../includes/joomla.php' );
			// VirtueMart needs the sef code, whether you use it or not

			if (file_exists( '../components/com_sh404sef/sh404sef.php' )) {
			require_once( '../components/com_sh404sef/sh404sef.php' );
			}
			else {
			require_once('../includes/sef.php' );
			}
			
			//	VirtueMart needs a mosMainframe object
			    //$mainframe = new mosMainFrame( $database, '', $mosConfig_absolute_path ); 

			/*	This is the main VirtueMart code */
					
			require_once('../components/com_virtuemart/virtuemart_parser.php' );
			/* We need the ps_checkout class so that we can call it's email_receipt function */
			//echo CLASSPATH . 'ps_checkout.php';
			require_once ( CLASSPATH . 'ps_checkout.php' );
			$ps_checkout = new ps_checkout ;
			$ps_checkout->email_receipt($neworder_id);
			
			/* Email code End */
?>				
		<script type='text/javascript' language="javascript"> 
		alert("Thank you for your order. Your order has been successfully placed. A confirmation email has been sent to you.");
		
		//	window.location.href = "http://www.zenvei.com/index.php?option=com_community&view=frontpage&itemid=15";
			//window.location.href = "http://localhost/Brandons/site/index.php?option=com_community&view=frontpage&itemid=15";
		
		</script>	
<?php 
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
<link type="text/css" rel="stylesheet" href="style2.css" />


<script type="text/javascript" src="../js/jquery.pack.js"></script>
<script type="text/javascript" src="../js/ui.core.js"></script>
<script type="text/javascript" src="../js/ui.datepicker.js"></script>
<script src="zenvei.js" type="text/javascript"></script>

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
		   

	/*$("#form").validate({
							
	    invalidHandler: function(form, validator) 
		{
			$('label.error').html('');
			/*	var error = 1;
				
				$('label.error').html('');
				if($('#ship_method').val() == '')
				{
					error = 0;
					$('#flip-navigation li #tab-0').addClass('error_tab');
					$('#flip-navigation li #tab-0').fadeOut(500).fadeIn(500).fadeOut(500).fadeIn(500).fadeOut(500).fadeIn(500);
				}
				else
				{
					error = 1;
				}
				if($('#ship_method2').val() == '')
				{
					error = 0;
					$('#flip-navigation li #tab-1').addClass('error_tab');
					$('#flip-navigation li #tab-1').fadeOut(500).fadeIn(500).fadeOut(500).fadeIn(500).fadeOut(500).fadeIn(500);
				}
				else
				{
					error = 1;
				}
				
				if(error == 1 || error == 0)
				{
					$('#flip-navigation li #tab-2').addClass('error_tab');
					$('#flip-navigation li #tab-2').fadeOut(500).fadeIn(500).fadeOut(500).fadeIn(500).fadeOut(500).fadeIn(500);
				}
					
					$('#error_on_tab').html('Check all tabs in red for missing information.');
			
		},
		rules: {
				  ship_method: "required",
				  //username: "required",
				  password: "required",
				  vpassword: {
						  required: true,
						  equalTo: "#password"
				  },
				  username: "required",
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
				  
				  ship_method: "required",
				  ship_method2: "required",
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
	*/
	
	
    
	 $("#drop1").change( function() {
		 test = $("#drop1").val();
		 
	if(test == '<?php echo JText::_('ClI_FORM_D1_OPTION1');?>')
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
		
		$('#rprice2').html(35);
		$('#bprice2').html(38);
		$('#gprice2').html(35);
		$('#sprice2').html(35);
		
		var red_total2 = parseInt($('#red_total2').val());
		new_red_total2 = (red_total2/32)*35
		var blue_total2 = parseInt($('#blue_total2').val());
		new_blue_total2 = (blue_total2/35)*38
		var green_total2 = parseInt($('#green_total2').val());
		new_green_total2 = (green_total2/32)*35
		var silver_total2 = parseInt($('#silver_total2').val());
		new_silver_total2 = (silver_total2/32)*35
		
		$('#red_total2').val(new_red_total2);
		$('#blue_total2').val(new_blue_total2);
		$('#green_total2').val(new_green_total2);
		$('#silver_total2').val(new_silver_total2);
		
		//test = 0;
		update();
		}
	
		else if(test == '<?php echo JText::_('ClI_FORM_D1_OPTION2');?>')
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
		
		
		$('#rprice2').html(32);
		$('#bprice2').html(35);
		$('#gprice2').html(32);
		$('#sprice2').html(32);
		
		var red_total2 = parseInt($('#red_total2').val());
		new_red_total2 = (red_total2/35)*32
		var blue_total2 = parseInt($('#blue_total2').val());
		new_blue_total2 = (blue_total2/38)*35
		var green_total2 = parseInt($('#green_total2').val());
		new_green_total2 = (green_total2/35)*32
		var silver_total2 = parseInt($('#silver_total2').val());
		new_silver_total2 = (silver_total2/35)*32
		
		$('#red_total2').val(new_red_total2);
		$('#blue_total2').val(new_blue_total2);
		$('#green_total2').val(new_green_total2);
		$('#silver_total2').val(new_silver_total2);
		
		update();
	  }
	  			
	  else if(test == '<?php echo JText::_('ClI_FORM_D1_OPTION3');?>')
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
		
		
		$('#rprice2').html(35);
		$('#bprice2').html(38);
		$('#gprice2').html(35);
		$('#sprice2').html(35);
		
		var red_total2 = parseInt($('#red_total2').val());
		new_red_total2 = (red_total2/32)*35
		var blue_total2 = parseInt($('#blue_total2').val());
		new_blue_total2 = (blue_total2/35)*38
		var green_total2 = parseInt($('#green_total2').val());
		new_green_total2 = (green_total2/32)*35
		var silver_total2 = parseInt($('#silver_total2').val());
		new_silver_total2 = (silver_total2/32)*35
		
		$('#red_total2').val(new_red_total2);
		$('#blue_total2').val(new_blue_total2);
		$('#green_total2').val(new_green_total2);
		$('#silver_total2').val(new_silver_total2);
		
		//test = 0;
		update();
		
		window.location="http://www.myzenvei.com/clients/";
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
		
		$('#rprice2').html(35);
		$('#bprice2').html(38);
		$('#gprice2').html(35);
		$('#sprice2').html(35);
		
		var red_total2 = parseInt($('#red_total2').val());
		new_red_total2 = (red_total2/32)*35
		var blue_total2 = parseInt($('#blue_total2').val());
		new_blue_total2 = (blue_total2/35)*38
		var green_total2 = parseInt($('#green_total2').val());
		new_green_total2 = (green_total2/32)*35
		var silver_total2 = parseInt($('#silver_total2').val());
		new_silver_total2 = (silver_total2/32)*35
		
		$('#red_total2').val(new_red_total2);
		$('#blue_total2').val(new_blue_total2);
		$('#green_total2').val(new_green_total2);
		$('#silver_total2').val(new_silver_total2);
		
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
		
		
		$('#rprice2').html(32);
		$('#bprice2').html(35);
		$('#gprice2').html(32);
		$('#sprice2').html(32);
		
		var red_total2 = parseInt($('#red_total2').val());
		new_red_total2 = (red_total2/35)*32
		var blue_total2 = parseInt($('#blue_total2').val());
		new_blue_total2 = (blue_total2/38)*35
		var green_total2 = parseInt($('#green_total2').val());
		new_green_total2 = (green_total2/35)*32
		var silver_total2 = parseInt($('#silver_total2').val());
		new_silver_total2 = (silver_total2/35)*32
		
		$('#red_total2').val(new_red_total2);
		$('#blue_total2').val(new_blue_total2);
		$('#green_total2').val(new_green_total2);
		$('#silver_total2').val(new_silver_total2);
		
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
	$('#red_qty2').change(function(){
								  
								  var qty = parseInt($(this).val());
								  var price = parseInt($('#rprice2').html());
								  var item_total = qty*price;
								  $('#qtr').val(qty);
								  $('#red_total2').val(item_total);
								  shipping2();
								  update();
	});
	$('#blue_qty2').change(function(){
								  
								  var qty = parseInt($(this).val());
								  var price = parseInt($('#bprice2').html());
								  var item_total = qty*price;
								  $('#qtb').val(qty);
								  $('#blue_total').val(item_total);
								  shipping2();
								  update();
	});
	$('#green_qty2').change(function(){
								  
								  var qty = parseInt($(this).val());
								  var price = parseInt($('#gprice2').html());
								  var item_total = qty*price;
								  $('#qtg').val(qty);
								  $('#green_total2').val(item_total);
								  shipping2();
								  update();
	});$('#silver_qty2').change(function(){
								  
								  var qty = parseInt($(this).val());
								  var price = parseInt($('#sprice2').html());
								  var item_total = qty*price;
								  $('#qts').val(qty);
								  $('#silver_total2').val(item_total);
								  shipping2();
								  update();
	});
	

$('#ship_method').change(function(){
								  
								   var test = $("#ship_method").val()
									//alert(test);
									if(test == 'Will-Call')
									{
									$('#shipping').val(2);
									}
									else
									{
									 shipping();
									}

									update();							
	});
	
	$('#ship_method2').change(function(){
								  
								   var test = $("#ship_method").val()
									//alert(test);
									if(test == 'Will-Call')
									{
									$('#shipping2').val(2);
									}
									else
									{
									 shipping2();
									}

									update();							
	});


function update(){
	
	var reg_fee = parseFloat($('#reg_fee').val());
	
	var red_total = parseInt($('#red_total').val());
	var blue_total = parseInt($('#blue_total').val());
	var green_total = parseInt($('#green_total').val());
	var silver_total = parseInt($('#silver_total').val());
	
	var red_total2 = parseInt($('#red_total2').val());
	var blue_total2 = parseInt($('#blue_total2').val());
	var green_total2 = parseInt($('#green_total2').val());
	var silver_total2 = parseInt($('#silver_total2').val());
	
	var prod_total = red_total+blue_total+green_total+silver_total;
	var prod_total2 = red_total2+blue_total2+green_total2+silver_total2;
	
	var shipping = parseInt($('#shipping').val());
	var shipping2 = parseInt($('#shipping2').val());
	
	var tax_amount = (prod_total/100)*6.5;
	var tax_amount2 = (prod_total2/100)*6.5;
	
    var all_total = reg_fee+prod_total+tax_amount+shipping;
	
	var auto_ship = prod_total2+tax_amount2+shipping2;
	
	$('#prod_total').val(prod_total);
	$('#products_total').html(prod_total);
	
	$('#shipping_amount').html(shipping);
	
	$('#taxx').val(tax_amount.toFixed(2));
	//$('#tax_amount').html(tax_amount.toFixed(2));
	
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

function shipping2(){
	
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


</script>
<script type="text/javascript" src="../js/jquery.validate.pack.js"></script>
<!-- 
   Checking Usename is database
-->

<script src="../js/settings.js" type="text/javascript"></script>
<SCRIPT type="text/javascript">
	
	pic1 = new Image(15, 15); 
	pic1.src = "../loader.gif";

	/*$(document).ready(function()
	{
		$("#username").blur(function() 
		{ 
			var usr = $("#username").val();

			if(usr.length >= 3)
			{
				$("#status").html('<img src="../loader.gif" align="absmiddle">&nbsp;Checking availability...');

    			$.ajax({  
   			    type: "POST",  
    			url: "../check.php",  
   				data: "username="+ usr,  
   			    success: function(msg){  
   
   				$("#status").ajaxComplete(function(event, request, settings){ 
				if(msg == 'OK')
				{
					alert(msg);
        			$("#username").removeClass('object_error'); // if necessary
					$("#username").addClass("object_ok");
					$(this).html('&nbsp;<img src="../accepted.png" align="absmiddle"> <font color="Green"> Congratulations your username is available </font>  ');
					
				}  
				else  
				{
					alert(msg);
					$("#username").removeClass('object_ok'); // if necessary
					$("#username").addClass("object_error");
					$(this).html(msg);
					//jQuery("#username").val('');
					var fst = document.getElementById('username');
					fst.focus();
					$("#username").val('');
					//document.getElementById('username').value='';
					return false;

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
				$("#replicated_status").html('<img src="../loader.gif" align="absmiddle">&nbsp;Checking availability...');

    			$.ajax({  
   			    type: "POST",  
    			url: "../check.php",  
   				data: "replicated_siteid="+ usr,  
   			    success: function(msg){  
   
   				$("#replicated_status").ajaxComplete(function(event, request, settings){ 
				if(msg == 'OK')
				{ 
        			$("#replicated_siteid").removeClass('object_error'); // if necessary
					$("#replicated_siteid").addClass("object_ok");
					$(this).html('&nbsp;<img src="../accepted.png" align="absmiddle"> <font color="Green"> Congratulations your site ID is available </font>  ');
				}  
				else  
				{  
					$("#replicated_siteid").removeClass('object_ok'); // if necessary
					$("#replicated_siteid").addClass("object_error");
					$(this).html(msg);
					//jQuery("#replicated_siteid").val('');
					document.getElementById('replicated_siteid').value='';
					var vst = document.getElementById('replicated_siteid');
					vst.focus();vst.focus(); return false;

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

		});*/

		//checking username already exist
		function checkUsername(params)
		{
			if(params.length >= 3)
			{
				$("#status").html('<img src="../loader.gif" align="absmiddle">&nbsp;Checking availability...');
				$.ajax({  
						type: "POST",  
						url: "check.php",  
						data: "username="+ params,  
						success: function(msg){
						if(msg == 'OK')
						{
							$("#username").removeClass('object_error'); // if necessary
							$("#username").addClass("object_ok");
							$("#status").html('&nbsp;<img src="../accepted.png" align="absmiddle"> <font color="Green"> Congratulations your username is available </font>  ');
							
						}  
						else  
						{
							$("#username").removeClass('object_ok'); // if necessary
							$("#username").addClass("object_error");
							$("#status").html(msg);
							//jQuery("#username").val('');
							var fst = document.getElementById('username');
							$("#username").val('');
							fst.focus();
							//document.getElementById('username').value='';
							return false;
						}	
					 }
				});
			}
			else
			{
				$("#status").html('<font color="red">The username should have atleast <strong>3</strong> characters.</font>');
				$("#username").removeClass('object_ok'); // if necessary
				$("#username").addClass("object_error");
			}
		}

		//checking Replicated id already exist
		function checkRep(params)
		{
			if(params.length >= 3)
			{
				$("#replicated_status").html('<img src="../loader.gif" align="absmiddle">&nbsp;Checking availability...');
				$.ajax({  
						type: "POST",  
						url: "check.php",  
						data: "replicated_siteid="+ params,  
						success: function(msg){
						if(msg == 'OK')
						{ 
							$("#replicated_siteid").removeClass('object_error'); // if necessary
							$("#replicated_siteid").addClass("object_ok");
							$("#replicated_status").html('&nbsp;<img src="../accepted.png" align="absmiddle"> <font color="Green"> Congratulations your site ID is available </font>  ');
						}  
						else  
						{  
							$("#replicated_siteid").removeClass('object_ok'); // if necessary
							$("#replicated_siteid").addClass("object_error");
							$("#replicated_status").html(msg);
							$("#replicated_siteid").val('');
							//document.getElementById('replicated_siteid').value='';
							var vst = document.getElementById('replicated_siteid');
							vst.focus();vst.focus(); return false;
						}
					 }
				});
			}
			else
			{
				$("#replicated_status").html('<font color="red">The site ID should have atleast <strong>3</strong> characters.</font>');
				$("#replicated_siteid").removeClass('object_ok'); // if necessary
				$("#replicated_siteid").addClass("object_error");
			}
		}


		//checking email already exist
		function checkEmail(params)
		{
			$("#email_status").html('<img src="../loader.gif" align="absmiddle">&nbsp;Checking availability...');
			$.ajax({  
					type: "POST",  
					url: "check.php",  
					data: "email="+ params,  
					success: function(msg){
					if(msg == 'OK')
					{ 
						$("#email").removeClass('object_error'); // if necessary
						$("#email").addClass("object_ok");
						$("#email_status").html('&nbsp;<img src="../accepted.png" align="absmiddle"> <font color="Green"> Congratulations your email is available </font>  ');
					}  
					else  
					{  
						$("#email").removeClass('object_ok'); // if necessary
						$("#email").addClass("object_error");
						$("#email_status").html(msg);
						$("#email").val('');
						var vst = document.getElementById('email');
						vst.focus();vst.focus(); return false;
					}
				 }
			});
		}
//-->
</SCRIPT>
</head>

<body>


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
<form id="form" method="post" action="" name="form">

<input type="hidden" id="red_total" value="0" />
<input type="hidden" id="blue_total" value="0" />
<input type="hidden" id="green_total" value="0" />
<input type="hidden" id="silver_total" value="0" />
<input type="hidden" id="prod_total" name="prod_total" value="0" />

<input type="hidden" id="red_total2" value="0" />
<input type="hidden" id="blue_total2" value="0" />
<input type="hidden" id="green_total2" value="0" />
<input type="hidden" id="silver_total2" value="0" />
<input type="hidden" id="prod_total2" name="prod_total2" value="0" />

<input type="hidden" id="reg_fee" name="reg_fee" value="39.00" />
<input type="hidden" id="qtr" value="0" />
<input type="hidden" id="qtb" value="0" />
<input type="hidden" id="qtg" value="0" />
<input type="hidden" id="qts" value="0" />

<input type="hidden" id="shipping" name="shippings" value="0" />
<input type="hidden" id="shipping2" name="shippings" value="0" />
<input type="hidden" id="taxx" name="taxx" value="0" />
<input type="hidden" id="state_taxx" name="state_taxx" value="0" />
<input type="hidden" id="totals" name="totals" value="0" />
<input type="hidden" id="auto_ships" name="auto_ships" value="0" />

<input type="hidden" id="cur_tab" value="0" />
<input type="hidden" name="Referre" value="<?php echo $refname;?>" />

<h1>Join the ZENVEI Team</h1>

<!--step1 starts -->
<div id="step1">	
	<div id="step4">
	<?php
		if($refname != '' And $_COOKIE['cook_jaffiliate'] != '')
		{$dis = '';}
		else $dis='';
	?>
    <h3><?php echo JText::_('CLI_STEP4_HEAD');?></h3>
      <tr>
          <td width="129">
          <td colspan="3"><?php echo $refname;?> <?php //echo $dis; ?> </td>
        </tr>
	</div>
       
    <h3>Enrollment Type:</h3>
    <p><span class="bus">BUSINESS</span><span class="mar" >MARKETING</span><span class="noauto" style="display:none;">MARKETING</span>  ASSOCIATE -<?php echo JText::_('CUSTOM');?>$<span class="bus">128</span><span class="mar">70</span><span class="noauto" style="display:none;">0</span> or more </p>
<!--    <p>Benefits include:</p>
     <p>
      <select name="tp1" id="tp1">
        <option value="0">BUSINESS ASSOCIATE</option>
        <option value="1">MARKETING ASSOCIATE</option>
        <option value="2">No AutoShip</option>
      </select>
    </p>
    -->
	<?php include('packages_dropdown.php'); ?>
	
	<p><?php echo JText::_('CLI_FORM_D3_HEAD');?></p>
    <p> 
      <select name="vm_autoship_date" id="vm_autoship_date">
        <option value="10">10th</option>
        <option value="20">20th</option>     
      </select>
      
    </p>
    <p>&nbsp;</p>
    <p><?php echo JText::_('CLI_FORM_PREF_LINK');?></p>
    <p>&nbsp;</p>

	<table cellspacing="0" width="70">
		<tr>
		  <td width="686" colspan="5" class="bold">
		  <?php include('tabs.php'); ?>
		  </td>
		</tr>
	</table> 
  
</div>
<div id="footer" class="footer"><input type="button" class="previous" onClick="_previous();" name="Previous" value="Previous">&nbsp;&nbsp;&nbsp;<input type="button" class="next" onClick="_next();" name="Next" value="Next"></div><br>
<!--ends step 1 -->
</div>
<!--container div ends -->
    

<!--footer div start -->

<!--end footer -->

<div id="package">
    <table width="180" cellpadding="0" cellspacing="0">
        <tr id="row_signup_fee">
            <td valign="bottom" style="color: #55a51c; border-bottom: 1px solid #d5d6d0; padding: 5px 0px 5px 0px;">
                <?php echo JText::_('CLI_FLOAT_REG');?>

            </td>
            <td valign="bottom" align="right" style="border-bottom: 1px solid #d5d6d0; padding: 5px 0px 5px 0px; text-align: right">
                <span id="fee_amount" style="font-weight: bold;">$39.00</span>
            </td>
        </tr>
        <tr>
            <td style="color: #55a51c; border-bottom: 0px solid #d5d6d0; padding: 5px 0px 5px 0px;">
                <?php echo JText::_('CLI_FLOAT_PRODUCT_ORD');?>
            </td>
            <td align="right" style="border-bottom: 1px solid #d5d6d0; padding: 5px 0px 5px 0px; text-align: right">
                <span id="order_amount" style="font-weight: bold;">$<span id="products_total">0.00</span></span>
            </td>
        </tr>
        <tr>
            <td style="color: #55a51c; border-bottom: 1px solid #d5d6d0; padding: 5px 0px 5px 0px;">
               <?php echo JText::_('CLI_FLOAT_SHIPPING');?>
            </td>
            <td align="right" style="border-bottom: 1px solid #d5d6d0; padding: 5px 0px 5px 0px; text-align: right">
                $<span id="shipping_amount" style="font-weight: bold;">0.00</span>
            </td>
        </tr>
        <tr>
            <td style="color: #55a51c; border-bottom: 0px solid #d5d6d0; padding: 5px 0px 5px 0px;">
               <?php echo JText::_('CLI_FLOAT_TAX');?>
            </td>
            <td align="right" style="border-bottom: 0px solid #d5d6d0; padding: 5px 0px 5px 0px; text-align: right">
                $<span id="tax_amount" style="font-weight: bold;">0.00</span>
            </td>
        </tr>
        <tr>
            <td align="right" style="color: #64184c; border-bottom: 0px solid #d5d6d0; padding: 5px 0px 5px 0px; font-weight: bold; font-size: 14px;">
                <img src="../images/arrow.png" width="8" height="9" alt="" style="margin-right: 4px;" /><?php echo JText::_('CLI_FLOAT_TOTAL');?>
            </td>
            <td align="right" style="border-bottom: 0px solid #d5d6d0; padding: 5px 0px 5px 0px; text-align: right">
                $<span id="total_amount" style="font-weight: bold; font-size: 14px;">39.00</span>
            </td>
        </tr>
    </table>
        <?php echo JText::_('CLI_FLOAT_FUTURE_AUTO_VALUE');?> <span id="autoship_amount">
            0.00</span>
</div>
    
    
</body>
</html>
