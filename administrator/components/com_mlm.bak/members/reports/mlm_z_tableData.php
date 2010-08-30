<?php
ob_start(); 
include ("settings.inc");

$fast_start=$_GET["q3"];
$phone=$_GET["q20"];
$associate_name=$_GET["q18"];
$commission=$_GET["q4"];
$preferred=$_GET["q5"];
$fast_match=$_GET["q7"];
$commission_match=$_GET["q8"];
$preferred_match=$_GET["q9"];
$status_date=$_GET["q16"];

$drill_date = $_POST['drill_date'];
if($drill_date == '')
$drill_date = $_GET['drill_date'];
$date = explode('^',$drill_date);
$starting_date = $date[0];
$ending_date = $date[1];
$weekly_monthly = $date[2];

	
?>
<style>
	div{
	width: 100%px;
	-moz-border-radius: 100px;
	border:#000;
	}
</style>
<div>
        	<form id="paybill" name="paybill" action="" method="post" enctype="multipart/form-data">
<table width="100%" border="0">
		 
		 <tr bgcolor="#99CCFF">
		 	 <td align="center"><b>Commision Report Payout</b></td>
	  	 </tr>
	
		<tr>
		  	<td align="center">&nbsp;</td>
	    </tr>
	
		<tr>
		  <td  align="center">
		
		  	  <b>Date :</b> 
			  <select name="drill_date" id="drill_date" >
			  
			 <?php
			  	
				echo '<option value="'.$starting_date.'^'.$ending_date.'^'.$weekly_monthly.'">
					 From : '.date("m/d/Y",strtotime($starting_date)).' --   To : '.date("m/d/Y",strtotime($ending_date)).' ( '.$weekly_monthly.' ) </option>';
				
				$query="SELECT start_date,end_date,weekly_monthly FROM reports"; 
				
				$result=mysql_query($query);
		
				if(mysql_affected_rows() > 0 )
				{
					
				  while ($row = mysql_fetch_array($result))
				  {
					$start_date = $row['start_date'];
					$end_date = $row['end_date'];
					echo '<option value="'.$start_date.'^'.$end_date.'^'.$row['weekly_monthly'].'">
					 <b>From</b> : '.date("m/d/Y",strtotime($start_date)).' --   <b>To</b> : '.date("m/d/Y",strtotime($end_date)).' ( <b>'.$row['weekly_monthly'].'</b> ) </option>';	
				  }
				}
				else
				{
					echo '<option value="None">None</option>';	
				}
				
				?>
			  </select>

			  <b> &nbsp;&nbsp;&nbsp;Payment Status :</b>
              <select name="payment_status" id="payment_status" >
                <option value="Paid">Paid</option>
                <option value="Unpaid">Unpaid</option>
              </select> 
              <b> &nbsp;&nbsp;&nbsp;View As :</b>
              <select name="weekly_monthly" id="weekly_monthly" >
                <option value="Weekly">Weekly</option>
                <option value="Monthly">Monthly</option>
              </select> 
              <input type="submit" name="payall" value="Pay" />		  </td>
		</tr>
		
		
		<tr>
		  <td align="left">&nbsp;</td>
		  </tr>
		<!--<tr>
	 		<td align="left">
			<b><?php// echo $weekly_monthly;?> Report From Date: </b>
			<?php// echo date("m/d/Y",strtotime($starting_date)); ?>
			&nbsp;&nbsp
			<b>To Date: </b>
			<?php// echo date("m/d/Y",strtotime($ending_date)); ?>			</td>
		</tr>
        -->
		</table>
       </form> 

<br>
<center><span id="payoutMade" style="color:#930; font-size:16px;"></span></center>


<table cellpadding="0" cellspacing="0" border="0" class="display" id="example" style="margin-top:10px;">
	<thead>
		<tr style= "background-color: #FF6600; color:#FFFFFF;">
	<?php if ($associate_name == 'true'){ echo "<th>Associate Name</th>";}?>
	<th>Address</th>
	<?php if ($sponsored_person == 'true'){ echo "<th>Sponsored Person</th>";}?>
	<th>Level</th>
	<?php if ($fast_start == 'true'){ echo "<th>Fast Start</th>";}?>
            <?php if ($commission == 'true'){ echo "<th>Commissions</th>";}?>
            <?php if ($preferred == 'true'){ echo "<th>Preferred</th>";}?>        
            <?php if ($fast_match == 'true'){ echo "<th>Fast Match</th>";}?>
            <?php if ($commission_match == 'true'){ echo "<th>Commission Match</th>";}?>
            <?php if ($preferred_match == 'true'){ echo "<th>Preferred Match</th>";}?>
            <th>Associate Status</th>
            <?php if ($status_date == 'true') { echo "<th>Status Date</th>";}?>
            <?php if ($phone == 'true'){ echo "<th>Phone Number</th>";}?>
            <th>Payment Status</th>
			<th>Total</th>
            <th>Payout</th>
		</tr>
	</thead>
	<tbody>
<?php
include ("settings.inc");
//include_once '../../../clients/zenvieConfig.php';

	$query="SELECT *  FROM  mlm_generate_report order by id DESC"; 
	$result=mysql_query($query);
		
		if(mysql_affected_rows() > 0 )
		{
			$i=0;
			while ($row = mysql_fetch_array($result))
			{
	
				$payment_status = $row['payment_status'];
				
				$query_for_address = "SELECT address_1,address_2,zip  FROM  jos_vm_order_user_info where user_id = ".$row['id'].""; 				$result_for_address = mysql_query($query_for_address);
				$row_for_address = mysql_fetch_array($result_for_address);
				
				$address_for_payouts = $row_for_address['address_1'].'  '.
				$row_for_address['address_2'].'  '.$row_for_address['zip'];
?>
    
    
		<tr class="odd_gradeX">
			<?php if ($associate_name == 'true'){ echo "<td><a href=''>".$row['associate_name']."</a></td>";}?>
			
			<?php echo "<td>".$address_for_payouts."</td>";?>
			<?php if ($sponsored_person == 'true'){ echo "<td>".$row['sponsored_person']."</td>";}?>    
			<td><?php echo $row['level']; ?></td>
			<?php if ($fast_start == 'true'){ echo "<td>".number_format($row['fast_start'],2)."</td>";}?>
                	<?php if ($commission == 'true'){ echo "<td>".number_format($row['commissions'],2)."</td>";}?> 
                	<?php if ($preferred == 'true'){ echo "<td>".$row['preferred']."</td>";}?>           
			<?php if ($fast_match == 'true'){ echo "<td>".number_format($row['fast_match'],2)."</td>";}?>
			<?php if ($commission_match == 'true'){ echo "<td>".number_format($row['commission_match'],2)."</td>";}?>
            <?php if ($preferred_match == 'true'){ echo "<td>".number_format($row['preferred_match'],2)."</td>";}?>
         <td><?php echo $row['associate_status']; ?></td>
			<?php if ($status_date == 'true'){ echo "<td>".date("m/d/Y",strtotime($row['status_date']))."</td>";}?>
	            <?php if ($phone == 'true'){ echo "<td>".$row['phone_numbner']."</td>";}?>  
                          
            <td><?php echo $row['payment_status']; ?></td>
			
	
		
			<td>
				<?php
					$t=$row['commission_match']+$row['commissions']+$row['preferred']+$row['preferred_match'];
					$total+=$t;
					echo " $ ".round($t,2);
					?>
			</td>
		
        
        	<td> <a href="javascript:makePayout(<?=$row['id']?>)">Pay</a>	</td>
		
		</tr>
		
	<?php
	$i++;
	}
	
	$carry=0;
	?>
	
	
</tbody>
</table>


<table width="100%" border="0" cellpadding="2" cellspacing="2">
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    
  </tr>

	<tr style= "background-color: #FF6600; color:#FFFFFF;">
		<td colspan="" align="right"><b>Total : </b></td>
		<td colspan="" align="right">&nbsp; $ &nbsp;<?php echo round($total,2); ?></td>
	</tr>
	
	<tr style= "background-color: #FF6600; color:#FFFFFF;">
		<td colspan="" align="right" ><b>Carry Over Amounts : </b></td>
		<td colspan="" align="right" >&nbsp; $ &nbsp;<?php echo round($carry,2); ?></td>
	</tr>
	
	<tr style= "background-color: #FF6600; color:#FFFFFF;" >
		<td colspan="" align="right"><b>Grand Total : </b></td>
		<td colspan="" align="right" >&nbsp; $ &nbsp;<?php echo round($total+$carry,2); ?></td>
	</tr>
	
	<?php  
		}
		else
		   {
	?> 
		
		<tr>
			<td align="center" colspan="10">&nbsp;</td>
		</tr>	
		<tr>
			<td align="center" colspan="10">
			<b style="color:#FF0000">No Record Found ! </b></td>
		</tr>
</table>
</div>	
<?php  
			} 
	 
ob_end_flush(); 
?>