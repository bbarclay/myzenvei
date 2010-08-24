<br><br>

		<table width="100%" border="0">
			
			  <tr>
				
				<td>User Name</td>
				<td>Sponsored By</td>
				<td>Level</td>
				<td>Order Amount</td>
				<td>Order Date</td>
				<td>Commission</td>
				
				
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

