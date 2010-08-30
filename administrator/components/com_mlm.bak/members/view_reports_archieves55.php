<?php
	$drill_date = $_POST['drill_date'];
	$date = explode('^',$drill_date);
	$starting_date = $date[0];
	$ending_date = $date[1];
	$weekly_monthly = $date[2];
?>

<br><br>
		<table width="100%" border="0">
		 
		 <tr bgcolor="#99CCFF">
		 	 <td colspan="2" align="center"><b>Commision Report Payout Archieve </b></td>
	  	 </tr>
	
		 <tr>
		   <td width="52%" align="center">Weekly</td>
		   <td width="48%" align="center">Monthly</td>
	      </tr>
		 <tr>
		  	<td align="center">
			<table width="80%" border="0" align="center">
  			

			<?php
					
				$query="SELECT start_date,end_date,weekly_monthly FROM reports"; 
				
				$result=mysql_query($query);
		
				if(mysql_affected_rows() > 0 )
				{
					
				  while ($row = mysql_fetch_array($result))
				  {
					$start_date = $row['start_date'];
					$end_date = $row['end_date'];
					echo '<tr><td>
					 <b>From</b> : '.$start_date.' --   <b>To</b> : '.$end_date.'
					 <a href="
					 index.php?option=com_mlm&page=view_earnings&drill_date='.$start_date.'^'.$end_date.'^'.$row['weekly_monthly'].'">View Report</a>
					 </td></tr>';	
				  }
				}
				else
				{
					echo '<option value="None">None</option>';	
				}
				
				?>
						
				
			  
			</table>
			</td>
	        <td align="center">
						<table width="100%" border="0" align="center">
  			

			<?php
					
				$query="SELECT start_date,end_date,weekly_monthly FROM reports"; 
				
				$result=mysql_query($query);
		
				if(mysql_affected_rows() > 0 )
				{
					
				  while ($row = mysql_fetch_array($result))
				  {
					$start_date = $row['start_date'];
					$end_date = $row['end_date'];
					echo '<tr><td>
					 <b>From</b> : '.$start_date.' --   <b>To</b> : '.$end_date.'
					 <a href="
					 index.php?option=com_mlm&page=view_earnings&drill_date='.$start_date.'^'.$end_date.'^'.$row['weekly_monthly'].'">View Report</a>
					 </td></tr>';	
				  }
				}
				else
				{
					echo '<option value="None">None</option>';	
				}
				
				?>
						
				
			  
			</table>
			
			
			</td>
		</tr>
		<form id="paybill" name="paybill" action="" method="post" enctype="multipart/form-data">
		
		<tr>
	 		<td colspan="2" align="left">&nbsp;</td>
		</tr>
		</form>
		</table>
<br>
