<?php
session_start();
		$con = mysql_connect('localhost', 'myzenvei_testing', 'TbTOpEgpWf7t');
		mysql_select_db('myzenvei_testing');
		
		
	error_reporting(0);
	
	
	
	if($_REQUEST['Submit'] == 'Save')
	{
		
		$userid = $_POST['userid'];
		$order_id = $_POST['orderid'];
		
		/* Products */
		$qnt_red = $_POST['qnt_red'];
		$qnt_blu = $_POST['qnt_blu'];
		$qnt_gre = $_POST['qnt_gre'];
		$qnt_sil = $_POST['qnt_sil'];
		
		$Auto_Date = $_POST['Auto_Date'];
		$edate = '01';
		$emonth = $_POST['expire_date'];
		$eyear = $_POST['expire_year'];
			
		$Card_Expriration = $eyear.'-'.$emonth.'-'.$edate;
		
		/* Creditcard Information */
		$card_type = $_POST['card_type'];
		$name_card = $_POST['name_card'];
		$card_no = $_POST['card_no'];
		$csv = $_POST['csv'];
		$expire_date = $_POST['expire_date'];
		$expire_year = $_POST['expire_year'];
		
		/* Accounts and billing suspention */
		$Pause_auto = $_POST['Pause_auto'];
		$Cancel_acc = $_POST['Cancel_acc'];
		if($Pause_auto == '') $Pause_auto = 1;
		if($Cancel_acc == '') $Cancel_acc = 1;
		
		$query = "Update mlm_geneology_tree
						 SET pause_billing = '$Pause_auto' ,
						 	 cancel_account = '$Cancel_acc'
						
						 Where userid=".$userid.""; 
		$result = mysql_query($query);
		$query = "Update jos_vm_user_info
						 SET
						 vm_card_type = '$card_type',
						 vm_name_on_card = '$name_card' ,
						 vm_card_number = '$card_no' ,
						 vm_card_expirydate = '$Card_Expriration',
						 vm_csv_digits ='$csv',
						 vm_autoship_date = '$Auto_Date'
						 
						 Where user_id=".$userid."";
		
		$result = mysql_query($query);
	
		
		
		$query = "UPDATE jos_vm_order_item SET 
										   product_quantity = '$qnt_red'
							 			   Where 
										   order_item_name = 'ZENVEI RED' AND
										   order_id=".$order_id ."";
		$result = mysql_query($query);								   
		
		$query = "UPDATE jos_vm_order_item SET 
										   product_quantity = '$qnt_blu'
							 			   Where 
										   order_item_name = 'ZENVEI BLUE' AND
										   order_id=".$order_id ."";
		$result = mysql_query($query);
		
		$query = "UPDATE jos_vm_order_item SET 
										   product_quantity = '$qnt_gre'
							 			   Where 
										   order_item_name = 'ZENVEI GREEN' AND
										   order_id=".$order_id ."";
		$result = mysql_query($query);										   
		
		$query = "UPDATE jos_vm_order_item SET 
										   product_quantity = '$qnt_sil'
							 			   Where 
										   order_item_name = 'ZENVEI SILVER' AND
										   order_id=".$order_id .""; 
		$result = mysql_query($query);
		
		$error_msg = "information updated successfully";
	}
		
		$userid = $_SESSION['userid'];
		
		/* Getting User info from a user_info table and tree table */
		
		$query = "SELECT user_info_id,
						 vm_card_type,vm_name_on_card,vm_card_number,
						 vm_card_expirydate,vm_csv_digits ,vm_autoship_date
						 ,username,shopperid,pause_billing,cancel_account
						 FROM jos_vm_user_info as user_info,mlm_geneology_tree as tree
						 Where user_info.user_id=".$userid." And user_info.user_id = tree.userid"; 
		$result = mysql_query($query);
		$row = mysql_fetch_array($result);
		
		$shopperid = $row['shopperid'];
		$autoship_date = $row['vm_autoship_date'];
		$card_type = trim($row['vm_card_type']);
		$vm_name_oncard = $row['vm_name_on_card'];
		$vm_card_number = $row['vm_card_number'];
		$vm_csv_digits = $row['vm_csv_digits'];
	
		$tree_pause_billing = $row['pause_billing'];
		$tree_cancel_account = $row['cancel_account'];
		
		/* Orders id from order table */
		 
		$query_orders = "SELECT order_id From jos_vm_orders
						 Where user_id=".$userid.""; 
		$result_orders = mysql_query($query_orders);
		$row_orders = mysql_fetch_array($result_orders);
		
		$order_id = $row_orders['order_id'];
		
	
		$query_order_items = "SELECT * From jos_vm_order_item
						 Where order_id=".$order_id .""; 
		$result_order_items = mysql_query($query_order_items);
		
		while($row_order_items = mysql_fetch_array($result_order_items))
		{
			//$product_id	$order_item_sku	$order_item_name	$product_quantity	$product_item_price	$product_final_price
			//echo $product_id = $row_order_items['order_id'];
			//echo $order_item_sku = $row_order_items['order_item_sku'];
			//echo $order_item_name = $row_order_items['order_item_name'];
			$product_quantity = $row_order_items['product_quantity'];
			//$product_quantity_multiple .= $product_quantity;
			$product_quantity_multiple .= '-'.$product_quantity;;
			//echo $product_final_price = $row_order_items['product_final_price'];
		}
		$seprator = explode('-',$product_quantity_multiple);
		$ZENVEI_RED = $seprator[1];
		$ZENVEI_BLUE = $seprator[2];
		$ZENVEI_GREEN = $seprator[3];
		$ZENVEI_SILVER = $seprator[4];
	
		
?>
<style type="text/css">
<!--
.style1 {color: #FF0000}
.style2 {color: #00FF00}
-->
</style>



		<p align="center"><img src="images/header.jpg" alt="header" width="903" height="105" border="0" usemap ="#Map" />
		  
		    <map name="Map" id="Map">
		      <area shape="rect" coords="833,57,903,75" href="signup.php" />
	          <area shape="rect" coords="-4,39,83,56" href="http://www.zenvei.com/" />
	          <area shape="rect" coords="831,34,905,55" href="purchasenow.php" />
	          <a href="signup.php">  
		      <area shape="rect" coords="834,65,835,66" href="signup.php" />
		      </a>
	        </map>
</p>

   
    <table width="70%" border="1" align="center">
      <tr>
        <td align="center"><a href="purchasenow_form.php">Home</a> | <a href="EditAutoShip.php?id=<?php echo $_GET['id'];?>">Update AutoShip</a> | Logout </td>
      </tr>
    </table>
	<form id="form1" name="form1" method="post" action="">
		
			<table border="0" align="center" cellpadding="2" cellspacing="2" width="70%">

	<tr>
	  <td colspan="3"><span class="style2"><? if(!empty($error_msg)) echo $row['username'] . "'s ". $error_msg; ?></span></td>
	  </tr>
	<tr style= "background-color: #FF6600; color:#FFFFFF;">	
     <td colspan="3"><strong>Change Options </strong></td>
    </tr>


	  <tr>
	    <td colspan="3"><span class="style2"><?php 
		  	  
		  echo 'Uername : ' .$row['username'];
		  echo '&nbsp;&nbsp;&nbsp;&nbsp;';
		  
		  
		  if($shopperid == 6)
	      {$associates_type = "Marketing Associate";}
		  elseif($shopperid == 8)
		  {$associates_type = "Buisness Associate";}
		  else
		  {$associates_type = "Autoship";}
		  
		  echo $associates_type;
		  
		  ?>
       </span></td>
       </tr>
	  <tr>
	    <td colspan="3">
			<input name="userid" type="hidden" value="<? echo $userid; ?>" />
			&nbsp;
			<input name="orderid" type="hidden" value="<? echo $order_id; ?>" />		</td>
       </tr>
	  <tr>
	    <td colspan="3"><strong>Change Products Quantity</strong></td>
       </tr>
	  <tr>
	    <td>Zenvei Red </td>
	    <td><input name="qnt_red" type="text" id="qnt_red" size="2" value="<? echo $ZENVEI_RED; ?>" /></td>
       </tr>
	  <tr>
	    <td>Zenvei Green</td>
	    <td><input name="qnt_gre" type="text" id="qnt_gre" size="2" value="<? echo $ZENVEI_GREEN; ?>"/></td>
    </tr>
	  <tr>
	    <td>Zenvei Blue</td>
	    <td><input name="qnt_blu" type="text" id="qnt_blu" size="2" value="<? echo $ZENVEI_BLUE; ?>"/></td>
    </tr>
	  <tr>
	    <td>Zenvei Silver</td>
	    <td><input name="qnt_sil" type="text" id="qnt_sil" size="2" value="<? echo $ZENVEI_SILVER; ?>"/></td>
       </tr>
	  
	  <tr>
	    <td colspan="2">&nbsp;</td>
       </tr>
	  
	  <tr>
	    <td colspan="2"><strong>Update CreditCard Information </strong></td>
       </tr>
	  <tr>
	    <td>Card Type</td>
	    <td> 
		<?php 
			
			
			$AMEX = '';
			$Visa = '';
			$MasterCard = '';
			$Discover  = '';
		
			
			if($card_type == "AMEX")
			{ 
				$AMEX = 'selected="Selected"'; 
			}
			elseif($card_type == 'Visa')
			{ 
			
				$Visa = 'selected="Selected"';
			}
			elseif($card_type == "MasterCard")
			{ 
				$MasterCard = 'selected="Selected"'; 
			}
			elseif($card_type == "Discover")
			{ 
				$Discover = 'selected="Selected"'; 
			}
			
		
		?>
		<select name="card_type" id="card_type">
          <option value="AMEX" <?php echo $AMEX ; ?>>American Express</option>
          <option value="Visa" <?php echo $Visa ; ?>>Visa</option>
          <option value="MasterCard" <?php echo $MasterCard ; ?>>MasterCard</option>
          <option value="Discover" <?php echo $Discover ; ?>>Discover</option>
        </select></td>
       </tr>
	  <tr>
	    <td>Card Number:</td>
	    <td><input name="card_no" type="text" id="card_no" maxlength="18"  value="<?php echo $vm_card_number;?>"/></td>
       </tr>
	  <tr>
	    <td>CSV 3 or 4 Digits </td>
	    <td><input name="csv" type="text" id="csv" maxlength="18" value="<?php echo $vm_csv_digits;?>" /></td>
    </tr>
	  <tr>
	    <td>Name on Card</td>
	    <td><input name="name_card" type="text" id="name_card" value="<?php echo $vm_name_oncard; ?>"/></td>
    </tr>
	  <tr>
	    <td>Card Expiry</td>
	    <td><span class="style1">
	      <?php 
		$exp = explode('-',$row['vm_card_expirydate']);
		
		echo $exp[1].' / '.$exp[0];
		
		?>
	    </span></td>
    </tr>
	  <tr>
	    <td>Change Expiry</td>
	    <td><select id="expire_date" name="expire_date">
          <option value='01' <? if($emonth == '01') {?>selected="selected" <? }?>>January</option>
          <option value='02' <? if($emonth == '02') {?>selected="selected" <? }?>>February</option>
          <option value='03' <? if($emonth == '03') {?>selected="selected" <? }?>>March</option>
          <option value='04' <? if($emonth == '04') {?>selected="selected" <? }?>>April</option>
          <option value='05' <? if($emonth == '05') {?>selected="selected" <? }?>>May</option>
          <option value='06' <? if($emonth == '06') {?>selected="selected" <? }?>>June</option>
          <option value='07' <? if($emonth == '07') {?>selected="selected" <? }?>>July</option>
          <option value='08' <? if($emonth == '08') {?>selected="selected" <? }?>>August</option>
          <option value='09' <? if($emonth == '09') {?>selected="selected" <? }?>>September</option>
          <option value='10' <? if($emonth == '10') {?>selected="selected" <? }?>>October</option>
          <option value='11' <? if($emonth == '11') {?>selected="selected" <? }?>>November</option>
          <option value='12' <? if($emonth == '12') {?>selected="selected" <? }?>>December</option>
        </select>
        /
        <select id="expire_year" name="expire_year">
          <option value='2010' <? if($eyear == '2010') {?>selected="selected" <? }?>>2010</option>
          <option value='2011' <? if($eyear == '2011') {?>selected="selected" <? }?>>2011</option>
          <option value='2012' <? if($eyear == '2012') {?>selected="selected" <? }?>>2012</option>
          <option value='2013' <? if($eyear == '2013') {?>selected="selected" <? }?>>2013</option>
          <option value='2014' <? if($eyear == '2014') {?>selected="selected" <? }?>>2014</option>
          <option value='2015' <? if($eyear == '2015') {?>selected="selected" <? }?>>2015</option>
        </select></td>
       </tr>
	  <tr>
	    <td colspan="2">&nbsp;</td>
    </tr>
	  
	  
	  <tr>
	    <td><strong>Pause Billing </strong></td>
	    <td>
		<?php
		
			if($tree_pause_billing == 0)
			{
				$checked = 'checked="checked"';
				$bill_check =  '<span class="style1">Suspended</span>';
				echo '<input type="checkbox" name="Pause_auto" id="Pause_auto" '.$checked.' value="0" />';
			}
			if($tree_pause_billing == 1)
		 	{
				
				$bill_check =  ' <span class="style2">Resumed</span>';
				echo '<input type="checkbox" name="Pause_auto" id="Pause_auto" value="0" />';
			}
		 ?>
		
		
		<?php echo 'Billing Status : '.$bill_check ; ?>		</td>
       </tr>
	  
	  <tr>
	    <td><strong>Cancel Account</strong></td>
	    <td>
		
	    	<?php
		
			if($tree_cancel_account == 0)
			{
				$checked = 'checked="checked"';
				$acc_check = ' <span class="style1">Suspended</span>';
				echo '<input type="checkbox" name="Cancel_acc" id="Cancel_acc" '.$checked.' value="0" />';
			}
			if($tree_cancel_account == 1)
		 	{
				
				$acc_check =  ' <span class="style2">Open</span>';
				echo '<input type="checkbox" name="Cancel_acc" id="Cancel_acc"  value = "0" />';
			}
		 ?>
		
		
		<?php echo 'Account Status: '.$acc_check ; ?>		</td>
       </tr>
	  
	  	  <tr>
	  	    <td height="23" colspan="3">&nbsp;</td>
       </tr>
	  	  
	  	  
	  	  <tr>
		<td height="23" colspan="3"><input type="submit" name="Submit" id="Submit" value="Save" /></td>
	  </tr>
</table>

	
	</form>