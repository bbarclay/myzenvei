<?php 
	include ("settings.inc");
	include_once '../dbCustomConnection.php';
	$userid = $_REQUEST['userid'];
	if(!$userid)
		$userid = '63';
	if($myzDb->query("select * from jos_fixed_reg_fee where userid='$userid '") && $myzDb->rowCount()>0)
		{
			$myzRegFee = $myzDb->fetchRow();
			$regFeeDate = $myzRegFee['regdate'];
			$nextPaymentDate = $myzRegFee['nextpaymentdate'];
			$regFee = $myzRegFee['regfee'];
		}
	 error_reporting(0);
	
	if($_REQUEST['Submit'] != '')
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
		
		$userid = $_GET['Result'];
		if($userid == '')
		$userid = $_POST['userid'];
		
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


<form id="form1" name="form1" method="post" action="">
<table border="0" align="center" cellpadding="2" cellspacing="2" class="display" id="example" style="margin-top:10px; margin-left:20px; width:50%">
	<thead>
	<tr>
	  <td colspan="4"><span class="style2"><? if(!empty($error_msg)) echo $row['username'] . "'s ". $error_msg; ?></span></td>
	  </tr>
	<tr style= "background-color: #FF6600; color:#FFFFFF;">	
     <td colspan="4"><strong>Change Options </strong></td>
    </tr>
  </thead>
	 <tbody>
	  <tr>
	    <td colspan="4"><span class="style2"><?php 
		  	  
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
	    <td colspan="4">
			<input name="userid" type="hidden" value="<? echo $userid; ?>" />
			&nbsp;
			<input name="orderid" type="hidden" value="<? echo $order_id; ?>" />		</td>
       </tr>
	  <tr>
	    <td colspan="4"><strong>Change Products Quantity</strong></td>
       </tr>
	  <tr>
	    <td width="20%">Zenvei Red </td>
	    <td width="25%"><input name="qnt_red" type="text" id="qnt_red" size="2" value="<? echo $ZENVEI_RED; ?>" /></td>
	    <td width="20%">Zenvei Blue</td>
	    <td width="30%"><input name="qnt_blu" type="text" id="qnt_blu" size="2" value="<? echo $ZENVEI_BLUE; ?>"/></td>
       </tr>
	  <tr>
	    <td width="20%">Zenvei Green</td>
	    <td width="25%"><input name="qnt_gre" type="text" id="qnt_gre" size="2" value="<? echo $ZENVEI_GREEN; ?>"/></td>
	    <td width="20%">Zenvei Silver</td>
	    <td width="30%"><input name="qnt_sil" type="text" id="qnt_sil" size="2" value="<? echo $ZENVEI_SILVER; ?>"/></td>
       </tr>
	  <tr>
	    <td colspan="4">&nbsp;</td>
       </tr>
        <tr>
	    <td colspan="4"><strong>Registeration Fee</strong></td>
       </tr>
       <tr>
	    <td>Last Payment Date </td>
	    <td><?php echo $regFeeDate;?></td>
	    <td>Next Payment Date</td>
	    <td><?php echo $nextPaymentDate;?></td>
       </tr>
        <tr>
	    <td>Reg. Fee</td>
	    <td>$<?php echo $regFee;?></td>
	    <td colspan="2">&nbsp;</td>
       </tr>
        <tr>
	    <td colspan="4">&nbsp;</td>
       </tr>
	  <tr>
	    <td colspan="4"><strong>Change Prefferences</strong></td>
       </tr>
	  <tr>
	    <td width="20%">AutoShip Date</td>
	    <td width="25%">
						
          	<?php 
				
				
				if($autoship_date == '10')
				{ 
					$th10 = 'selected="Selected"'; 
				}
				elseif($autoship_date == '20')
				{ 
					$th20 = 'selected="Selected"'; 
				}
				else
				{}
			?>
			<select name="Auto_Date" id="Auto_Date">  
			<option value="10th" <?php echo $th10; ?> > 10th </option>
          	<option value="20th" <?php echo $th20; ?> > 20th </option>
        	</select>		</td>
	    <td width="14%">Shipping Type </td>
	    
	    <td width="15%"><select name="ship_method" id="ship_method">
          <!--<option value="">Select Shipping Method</option> -->
          <option value="US Mail">US Mail</option>
        </select></td>
	    
       </tr>
	  <tr><td>&nbsp;</td></tr>
	  <tr>
	    <td colspan="4" height="24"><strong>Update CreditCard Information </strong></td>
       </tr>
	  <tr>
	    <td width="20%">Card Type</td>
	    <td width="25%"> 
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
	    <td width="20%">Name on Card</td>
	    <td width="30%"><input name="name_card" type="text" id="name_card" value="<?php echo $vm_name_oncard; ?>"/></td>
       </tr>
	  <tr>
	    <td width="20%">Card Number:</td>
	    <td width="25%"><input name="card_no" type="text" id="card_no" maxlength="18"  value="<?php echo $vm_card_number;?>"/></td>
	    <td width="50%" colspan="2"> &nbsp;<span class="style1"><?php 
		$exp = explode('-',$row['vm_card_expirydate']);
		
		echo $exp[1].' / '.$exp[0];
		
		?>
		</span></td>
       </tr>
	  <tr>
	    <td width="20%">CSV 3 or 4 Digits </td>
	    <td width="25%"><input name="csv" type="text" id="csv" maxlength="18" value="<?php echo $vm_csv_digits;?>" /></td>
	    <td width="20%">Change Expiry</td>
	    <td width="30%">
		<select id="expire_date" name="expire_date">
       
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
		</select>		</td>
       </tr>
	  <tr>
	    <td colspan="4">&nbsp;</td>
       </tr>
	  <tr>
	    <td width="20%">&nbsp;</td>
	    <td colspan="3">&nbsp;</td>
       </tr>
	  <tr>
	    <td width="20%">&nbsp;</td>
	    <td colspan="3">&nbsp;</td>
       </tr>
	  <tr>
	    <td width="20%"><strong>Pause Billing </strong></td>
	    <td colspan="3">
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
	    <td width="20%"><strong>Cancel Account</strong></td>
	    <td colspan="3">
		
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
	  	    <td height="23" colspan="4">&nbsp;</td>
       </tr>
	  	  
	  	  
	  	  <tr>
		<td height="23" colspan="4"><input type="submit" name="Submit" id="Submit" value="Save" /></td>
	  </tr>
	</tbody>
</table>
</form>
<script src="../scripts/jquery.js" type="text/javascript"></script>
<script src="../scripts/jquery.form.js" type="text/javascript"></script>
<link rel="stylesheet" href="../scripts/datepicker.css" type="text/css" />
<script type="text/javascript" src="../scripts/datepicker.js"></script>
<script type="text/javascript" src="../scripts/eye.js"></script>
<script type="text/javascript" src="../scripts/utils.js"></script>
<script type="text/javascript" src="../scripts/layout.js?ver=1.0.2"></script>
		<script type="text/javascript" charset="utf-8">
			$(document).ready( function () {
				/* You might need to set the sSwfPath! Something like:
				 *   TableToolsInit.sSwfPath = "/media/swf/ZeroClipboard.swf";
				 */
				//$('#example').dataTable( {
				//	"sDom": 'T<"clear">lfrtip'
				//} );

				//alert("ready");
				$('#regfee_fdate').DatePicker({
				format:'m/d/Y',
				date: $('#regfee_fdate').val(),
				current: $('#regfee_fdate').val(),
				starts: 1,
				position: 'r',
				onBeforeShow: function(){
					$('#regfee_fdate').DatePickerSetDate($('#regfee_fdate').val(), true);
				},
				onChange: function(formated, dates){
					$('#regfee_fdate').val(formated);
					if ($('#closeOnSelect input').attr('checked')) {
						$('#regfee_fdate').DatePickerHide();
					}
				}
			});


			$('#regfee_ndate').DatePicker({
				format:'m/d/Y',
				date: $('#regfee_ndate').val(),
				current: $('#regfee_ndate').val(),
				starts: 1,
				position: 'r',
				onBeforeShow: function(){
					$('#regfee_ndate').DatePickerSetDate($('#regfee_ndate').val(), true);
				},
				onChange: function(formated, dates){
					$('#regfee_ndate').val(formated);
					if ($('#closeOnSelect input').attr('checked')) {
						$('#regfee_ndate').DatePickerHide();
					}
				}
			});
				
			} );
		</script>
