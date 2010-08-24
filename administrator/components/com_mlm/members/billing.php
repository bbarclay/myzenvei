<?php
ob_start(); 
include ("settings.inc");
	$drill_date = $_POST['drill_date'];
	if($drill_date == '')
	$drill_date = $_GET['drill_date'];
	$date = explode('^',$drill_date);
	$starting_date = $date[0];
	$ending_date = $date[1];
	$weekly_monthly = $date[2];

	
?>
		<table width="100%" border="0">
		 
		 <tr bgcolor="#99CCFF">
		 	 <td align="center"><b>Billing</b></td>
	  	 </tr>
	
		<tr>
		  	<td align="center">&nbsp;</td>
	    </tr>
		<form id="paybill" name="paybill" action="" method="post" enctype="multipart/form-data">
		<tr>
		  <td  align="center">&nbsp;</td>
		</tr>
		
		
		<tr>
		  <td align="left">&nbsp;</td>
		  </tr>
		<tr>
	 		<td align="left">&nbsp;</td>
		</tr>
		</form>
		</table>

<br>
<table cellpadding="2" cellspacing="2" border="0" class="display" id="example" style="margin-top:10px;">
	<thead>
		
		<tr style= "background-color: #FF6600; color:#FFFFFF;">
			<th width="109">Associate Name</th>
			<th width="104">Recurring date </th>
			
			<th width="116">Autoship amount </th>
			
			<!--<th>Fast Start</th> -->
            <th width="118">Carry Over Amounts</th>
           
            <!--<th>Fast Match</th> -->
            <th width="99">Charge to CC </th>
             <th width="64">Payment status </th>
			
		<!--	<th>Associate Status</th>
            
		 	<th>Status Date</th>
           <th>Phone Number</th> -->
            
			<!--<th>Payment Status</th> -->
			
		</tr>
	</thead>
	<tbody>
	
	

	<?php
	
	
	$query="SELECT * FROM  mlm_generate_report"; 
	$result=mysql_query($query);
		
		if(mysql_affected_rows() > 0 )
		{
			$i=0;
			while ($row = mysql_fetch_array($result))
			{
	
				$payment_status = $row['payment_status'];
	
	?>
		
    
		<tr>
						<?php echo "<td>".$row['associate_name']."</td>";?>
			<?php echo "<td>".$row['sponsored_person']."</td>"; ?>    
			
			<td><?php echo $row['level']; ?></td>
			
			<?php //echo "<td>".$row['fast_start']."</td>";?>
            <?php echo "<td>".$row['commissions']."</td>";?> 
            <?php echo "<td>".$row['commission_match']."</td>";?>
			<?php //echo "<td>".$row['fast_match']."</td>";?>
			<?php echo "<td>".$row['preferred']."</td>";?> 
			
            <?php echo "<td>".$row['preferred_match']."</td>";?>
         	
			<?php //echo <td>$row['associate_status'];</td> ?>
			
			<?php //echo "<td>".$row['status_date']."</td>";?>
	        <?php //echo "<td>".$row['phone_numbner']."</td>";?>  
            <?php echo "<td>0</td>";?>  
		    
			<?php
			/* <td>	if($payment_status == 'Paid')
				{
					echo '<font color="#00FF66"> Paid </font>';
				}
				else
				{
					echo '<font color="red"> Unpaid </font>';
				} </td>*/			
			?>
			
		
			<td>&nbsp;</td>
		</tr>
		
	<?php
	$i++;
	}
	
	$carry=0;
	?>
</tbody>
</table>


<?php  
			} 
	 
ob_end_flush(); 
?>
