<?php
ob_start(); 
include ("settings.inc");
error_reporting(0);
?>
		<!-- Div Control Script -->
		<script language=javascript type='text/javascript'> 
		function hideDiv() 
		{ 
			if (document.getElementById) 
			{ 	// DOM3 = IE5, NS6 
				document.getElementById('hideShow').style.visibility = 'hidden'; 
			} 
			else 
			{ 
				if (document.layers) 
				{ 	// Netscape 4 
					document.hideShow.visibility = 'hidden'; 
				} 
				else 
				{ 	// IE 4 
					document.all.hideShow.style.visibility = 'hidden'; 
				} 
			} 
		}
		
		function showDiv(id) 
		{ 
			var id;
			
			if (document.getElementById)
			{ // DOM3 = IE5, NS6 
				document.getElementById('hideShow').style.visibility = 'visible'; 
				frames['Auto'].location.href="EditAutoShip.php?Result=" + id;
				//alert(id);
			} 
			else 
			{ 
				if (document.layers) 
				{ 	// Netscape 4 
					document.hideShow.visibility = 'visible'; 
				} 
				else 
				{ 	// IE 4 
					document.all.hideShow.style.visibility = 'visible'; 
				} 
			} 
		} 
		</script>

		<table width="100%" border="0">
		 
		 <tr bgcolor="#99CCFF">
		 	 <td align="center"><b>Billings Section</b></td>
	  	 </tr>

		</table>

<br>
	<table cellpadding="2" cellspacing="2" border="0" class="display" id="example" style="margin-top:10px;">
		<thead>
			<tr style= "background-color: #FF6600; color:#FFFFFF;">
					<th>Associate Name</th>
					<th>Recurring Date</th>
					<th>Associate Type</th>
					<th>Autoship Amount</th>
					<th>Carry Over Amounts</th>
					<th>Charge / Charged to CC</th>    
					<th>Payment Status</th>
			</tr>
		</thead>
		<tbody>
		
		

	<?php
	
	
	$query="SELECT * FROM mlm_geneology_tree"; 
	$result= mysql_query($query);
		
		if(mysql_affected_rows() > 0 )
		{
			$i=0;
			while ($row = mysql_fetch_array($result))
			{
	
				/*Getting Recurring Date*/
				$query_fordate = "SELECT vm_autoship_date FROM jos_vm_user_info Where user_id=".$row['userid'].""; 
				$result_fordate=mysql_query($query_fordate);
				$row_fordate = mysql_fetch_array($result_fordate);
				
				/*Getting Recurring Date End*/
				
				$shopperid = $row['shopperid'];
				if($shopperid == 6)
				{$associates_type = "Marketing Associate";}
				elseif($shopperid == 8)
				{$associates_type = "Buisness Associate";}
				else
				{$associates_type = "Autoship";}
				
			if($row_fordate['vm_autoship_date'] == '')
			$date_autoship = '10';
			else
			$date_autoship = $row_fordate['vm_autoship_date'];
	?>
		
    
		<tr>
			<?php 
			echo 
			"<td>".$row['username']."
			( Update :
			<a href='javascript:showDiv(".$row['userid'].")'>show</a>
			<a href='javascript:hideDiv()'>Hide</a>
			)
			</td>";
			
			?>
			<?php echo "<td>".$date_autoship."</td>";?>
			<?php echo "<td>Buisness Associate</td>";?>
			<?php echo "<td> $ 210</td>";?>
			<?php echo "<td> $ ".round($row['commissions'],2)."</td>";?> 
			<?php
					$t=$row['commission_match']+$row['commissions']+$row['preferred']+$row['preferred_match'];
					$total+=$t;
					echo "<td> $ ".round($t,2)."</td>";
			?>
			
			<?php echo "<td>".$row['payment_status']."</td>";?> 
		
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
		else
		{

		} 
	?>
<br><br>
<!--	<table width="100%" border="0" align="left">
	  <tr>
		<td align="left">Show Recurring For
		  <select name="filter" id="filter">
            <option value="">Show All</option>
			<option value="8">B-Associates</option>
            <option value="6">M-Associates</option>
			<option value="">Preferred Customers</option>
           </select></td>
	  </tr>
	</table>
 -->
<br><br>


<div id="hideShow" style="visibility:hidden;"> 
<iframe name="Auto" frameborder="no" width="100%" height="800px" scrolling="no"></iframe>
</div> 

<?php
ob_end_flush(); 
?>