
<br><br>

		<table width="200%" border="0">
			
			  <tr>
				
				<td>Associate Name</td>
				<td>Sponsored Person</td>
				<td>Level</td>
				<td>Order Amount</td>
				<td>Status Date</td>
				<td>Fast Start</td>
				<td>Commissions</td>
				<td>Preferred </td>
				<td>Fast Match</td>
				<td>Commission Match</td>
				<td>Preferred Match</td>
				<td>Associate Status</td>
				<td>Phone Number</td>
				<td>Payment Status</td>
			  </tr>
			  <tr>
				
		<td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>

			  </tr>
			  <?php
			 		
					echo calculate_commisions($id);
					
					$query = "SELECT * FROM mlm_geneology_tree where lft BETWEEN ".$left." AND ".$right." "; 
					$result = mysql_query($query); 
					
					while($row = mysql_fetch_array($result))
					{
							
					
						/* 	echo '<tr>		
							
								<td>'.$row['username'].'</td>
								<td>'.$row['parent'].'</td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
							
								<td>&nbsp;</td>
							  </tr> '; */
					} 
				?>
			
		</table>

