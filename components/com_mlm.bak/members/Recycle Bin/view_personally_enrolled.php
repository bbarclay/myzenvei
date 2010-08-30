 <?php include_once 'clients/zenvieConfig.php'; ?>
<br><br>

		<table width="100%" border="0">
			
			  <tr>
				
				<td>User Name</td>
				<td>Left</td>
				<td>Right</td>
				<td>Sponsored By</td>
				<td>Shopper Group</td>
				<td>Position</td>
				<td>Joining Date</td>
				<td>Status</td>
			  </tr>
			  <tr>
				
		<td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>

			  </tr>
			  <?php
			 		
$id = 63;
					$query = "SELECT * FROM mlm_geneology_tree spon_parent_id='$CustomUid'"; 
					$result = mysql_query($query); 
					
					while($row = @mysql_fetch_array($result))
					{
							
							if( $row['status'] == 1 )
							$status = '<span><Font color=green>Enabled</font></span>';
							else
							$status = '<span><Font color=red>Disabled</font></span>';
							
							$shopperid = $row['shopperid'];
	
							if($shopperid == 8)
							{
								$shoppergroup =  '<span><Font color=green>Business Associate</font></span>';
							}
							elseif($shopperid == 6)
							{
								$shoppergroup =  '<span><Font color=red>Marketing Associate</font></span>';
							}
							else
							{
								$shoppergroup =  '<span><Font color=red>No Autoship</font></span>';
							}
							
							
							echo '<tr>		
							
								<td>'.$row['username'].'</td>
								<td>'.$row['lft'].'</td>
								<td>'.$row['rgt'].'</td>
								
								<td>'.$row['parent'].'</td>
								
								<td>'.$shoppergroup.'</td>
								<td>'.$row['position'].'</td>
								<td>'.$row['datejoining'].'</td>
								<td>'.$status.'</td>
							  </tr> ';
					} 
				?>
			
		</table>
