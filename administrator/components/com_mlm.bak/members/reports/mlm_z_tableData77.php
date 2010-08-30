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
		
		
		if(strchr($_REQUEST[q31],'-'))
		{
			$qt31=$_REQUEST[q31];
			$qt32=$_REQUEST[q32];
			$s=explode('-',$qt31);
			$e=explode('-',$qt32);
			$q31=$s[2].'/'.$s[1].'/'.$s[0];
			$q32=$e[2].'/'.$e[1].'/'.$e[0];
			$startdate=$qt31;
			$enddate=$qt32;
		
		}
		elseif(strchr($_REQUEST[q31],'/'))
		{
		
			$q31=$_REQUEST[q31];
			$q32=$_REQUEST[q32];
			$t31=explode('/',$q31);
			$t32=explode('/',$q32);
			$qt31=$t31[2].'-'.$t31[0].'-'.$t31[1];
			$qt32=$t32[2].'-'.$t32[0].'-'.$t32[1];
			$startdate=$qt31;
			$enddate=$qt32;
		
		}
	
?>

<form id="paybill" name="paybill" action="" method="post" enctype="multipart/form-data">
		<table width="100%" border="0">
		 
		 <tr bgcolor="#99CCFF">
		 	 <td align="center"><b>Commision Report Payout</b></td>
	  	 </tr>
	
		<tr>
		  	<td align="center">&nbsp;</td>
	    </tr>
		
		<tr>
		  <td  align="center"><b>From Date :</b> <?php echo $q31;  ?> &nbsp;&nbsp;&nbsp; <b>To Date :</b> <?php echo $q32; ?> </td>
		  </tr>
		
		
		<tr>
	 		<td  align="center">
			Save Report As : 
				<select name="weekly_monthly" id="weekly_monthly" >
				<option value="Weekly">Weekly</option>
				<option value="Monthly">Monthly</option>
				</select>
			

			Set Payment Status To : 
				<select name="payment_status" id="payment_status">
				<option value="Paid">Paid</option>
				<option value="Unpaid">Unpaid</option>
				</select>
			

				<input type="hidden" name="st" value="0" />
				<input type="hidden" name="startdate" value="<?php echo $startdate?>" />
				<input type="hidden" name="enddate" value="<?php echo $enddate?>" />
				<input type="submit" name="payall" value="Pay To Associates" />
			
			</td>
		</tr>
		
		</form>
		
		
		
		</table>
<br>
<table cellpadding="2" cellspacing="2" border="0" class="display" id="example" style="margin-top:10px;">
	<thead>
		
		<tr style= "background-color: #FF6600; color:#FFFFFF;">
			<?php if ($associate_name == 'true'){ echo "<th>Associate Name</th>";}?>
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
			<?php if ($associate_name == 'true'){ echo "<td>".$row['associate_name']."</td>";}?>
			<?php if ($sponsored_person == 'true'){ echo "<td>".$row['sponsored_person']."</td>";}?>    
			
			<td><?php echo $row['level']; ?></td>
			
			<?php if ($fast_start == 'true'){ echo "<td> $ ".round($row['fast_start'],2)."</td>";}?>
            <?php if ($commission == 'true'){ echo "<td> $ ".round($row['commissions'],2)."</td>";}?> 
            <?php if ($preferred == 'true'){ echo "<td> $ ".round($row['preferred'],2)."</td>";}?>           
			<?php if ($fast_match == 'true'){ echo "<td> $ ".round($row['fast_match'],2)."</td>";}?>
			<?php if ($commission_match == 'true'){ echo "<td> $ ".round($row['commission_match'],2)."</td>";}?>
            <?php if ($preferred_match == 'true'){ echo "<td> $ ".round($row['preferred_match'],2)."</td>";}?>
         	
			<td><?php echo $row['associate_status']; ?></td>
			
			<?php if ($status_date == 'true'){ echo "<td>".$row['status_date']."</td>";}?>
	        <?php if ($phone == 'true'){ echo "<td>".$row['phone_numbner']."</td>";}?>  
            <td>
			<?php
				if($payment_status == 'Paid')
				{
					echo '<font color="#00FF66"> Paid </font>';
				}
				else
				{
					echo '<font color="red"> Unpaid </font>';
				}			
			?>
			</td>
		
			<td>
				<?php
					$t=$row['commission_match']+$row['commissions']+$row['preferred']+$row['preferred_match'];
					$total+=$t;
					echo " $ ".round($t,2);
					?>
			</td>
		
		
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
<?php  
			} 
	 
ob_end_flush(); 
?>