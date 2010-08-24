<?php
	include_once('paging.class.php');
	$Paging 	= new PagedResults();
	$drill_date = $_POST['drill_date'];
	$date = explode('^',$drill_date);
	$starting_date = $date[0];
	$ending_date = $date[1];
	$weekly_monthly = $date[2];
?>


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
			
				 $query1 = mysql_query("SELECT * FROM reports");
				 $rowscount = mysql_num_rows($query1);
				 
				#paging count for listing
				$Paging->TotalResults = $rowscount;	
					$Paging->ResultsPerPage = 3; 
					$page  = $Paging->getCurrentPage();
					if($page > 1)
						$start = ($page-1) * $Paging->ResultsPerPage;
					else 
						$start = 0;
				
				$end   = $Paging->ResultsPerPage;	
							
				$query="SELECT start_date,end_date,weekly_monthly FROM reports limit $start, $end"; 
				
				$result=mysql_query($query);
		
				if(mysql_affected_rows() > 0 )
				{
					
				  while ($row = mysql_fetch_array($result))
				  {
					$start_date = date("m/d/Y",strtotime($row['start_date']));
					$end_date = date("m/d/Y",strtotime($row['end_date']));
					echo '<tr><td>
					 <b>From</b> : '.$start_date.' --   <b>To</b> : '.$end_date.'
					 <a href="index.php?option=com_mlm&page=view_earnings&drill_date='.$start_date.'^'.$end_date.'^'.$row['weekly_monthly'].'">View Report</a>
					 </td></tr>';	
				  }
				  
				}
				else
				{
					echo '<option value="None">None</option>';	
				}
				
				?>
						
				<tr>
	 		<td colspan="2" align="left">
	 		 		&nbsp;</td>
		</tr>

			  
			</table>
			</td>
	        <td align="center">
						<table width="100%" border="0" align="center">
  			

			<?php
					
				$query="SELECT start_date,end_date,weekly_monthly FROM reports limit $start, $end"; 
				
				$result=mysql_query($query);
		
				if(mysql_affected_rows() > 0 )
				{
					
				  while ($row = mysql_fetch_array($result))
				  {
					$start_date = date("m/d/Y",strtotime($row['start_date']));
					$end_date = date("m/d/Y",strtotime($row['end_date']));
					echo '<tr><td>
					 <b>From</b> : '.$start_date.' --   <b>To</b> : '.$end_date.'
					 <a href="index.php?option=com_mlm&page=view_earnings&drill_date='.$start_date.'^'.$end_date.'^'.$row['weekly_monthly'].'">View Report</a>
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
	 		<td colspan="2" align="center">
	 		<?php
				if($rowscount > $end) 
					{
					    $pageParameter =  $_SERVER["QUERY_STRING"];
						$pages = $Paging->pageHTML('index.php?'.$pageParameter.'&pageno=~~i~~');	
						echo $pages;
					}	
					
			 ?>
	 		
	 		
	 		&nbsp;</td>
		</tr>
		</form>
		</table>