<?php 
$rootid = $_REQUEST['id'];

if($rootid == "")
{
	$rootid = 1;
}


   // retrieve the left and right value of the $root node  
   $result = mysql_query('SELECT userid FROM tree '.  
                          'WHERE parentid="'.$rootid.'";');  

  // first level child
	$ctr = 1;
	$node1 = -1;
	$node2 = -1;
	$node3 = -1;
   while ($row = mysql_fetch_array($result))
	{
	   if($ctr == 1)
		{
		  $node1 = $row['userid'];
		}
	   if($ctr == 2)
		{
			$node2 = $row['userid'];
		}
	   if($ctr == 3)
		{
		   $node3 = $row['userid'];
		}

		$ctr = $ctr + 1;
	}

//second level child tha is node 1
    $ctr = 4;
	$node4 = -1;
	$node5 = -1;
	$node6 = -1;
	if($node1 != -1)
	{
		$node1_res = mysql_query("select userid from tree where parentid='".$node1."'");

		while($node1_row = mysql_fetch_array($node1_res))
		{
			if($ctr == 4)
			{
				$node4 = $node1_row['userid'];
			}
			if($ctr == 5)
			{
				$node5 = $node1_row['userid'];
			}
			if($ctr == 6)
			{
				$node6 = $node1_row['userid'];
			}
			$ctr = $ctr + 1 ;
		}
	}

//second level of node 2
	$ctr = 7;
	$node7 = -1;
	$node8 = -1;
	$node9 = -1;
	if($node2 != -1)
	{
		$node2_res = mysql_query("select userid from tree where parentid='".$node2."'");

		while($node2_row = mysql_fetch_array($node2_res))
		{
			if($ctr == 7)
			{
				$node7 = $node2_row['userid'];
			}
			if($ctr == 8)
			{
				$node8 = $node2_row['userid'];
			}
			if($ctr == 9)
			{
				$node9 = $node2_row['userid'];
			}

			$ctr = $ctr+1;
		}

	}

//second level of node 3
	$ctr = 10;
	$node10 = -1;
	$node11 = -1;
	$node12 = -1;

	if($node3 != -1)
	{
		$node3_res = mysql_query("select userid from tree where parentid='".$node3."'");

		while($node3_row = mysql_fetch_array($node3_res))
		{
			if($ctr == 10)
			{
				$node10 = $node3_row['userid'];
			}
			if($ctr == 11)
			{
				$node11 = $node3_row['userid'];
			}
			if($ctr == 12)
			{
				$node12 = $node3_row['userid'];
			}
			$ctr = $ctr + 1;
		}
	}
  
?>
<body>
<table width="100%" border="0">
	<TR>
		<TD height="19" colspan="9" align="center" valign="top">
		<h1>Graph</h1></TD>
		</TR>	
  <tr>
    <td colspan="9" align="center">
		<?php
			if($rootid != -1){
			
		?>
		<br />
		<img src="green.gif" border="0">
		<br>
  			<?php echo $node1; ?>
		
		<?php
				
			} else {
				echo "&nbsp;";
			}
		?>
	</td>
  </tr>
  
  <tr>
    <td colspan="9" align="center">
	
		<img src="big_bar.jpg" border="0">
	</td>
  </tr>
  
  <tr>
    <td colspan="3" align="center" width="33%">
		<?php
			if($node1 != -1){
			
		?>
		<br />
		<img src="green.gif" border="0">
		<br>
  			<a href="tree.php?id=<?php echo $node1;?>"><?php echo $node1; ?></a></font>
  			
		<?php
			
			}else{
				echo "&nbsp";
			}
		?>
		
	</td>
    <td colspan="3" align="center" width="33%">
		<?php
			if($node2 != -1){
			
		?>
		<br />
		<img src="green.gif" border="0">
		<br>
  			<a href="tree.php?id=<?php echo $node2;?>"><?php echo $node2; ?></a>
		<?php
			
			}else{
				echo "&nbsp;";
			}
		?>
	</td>

	<td colspan="3" align="center" width="34%">
		<?php
			if($node3 != -1){
			
		?>
		<br />
		<img src="green.gif" border="0">
		<br>
  			<a href="tree.php?id=<?php echo $node3;?>"><?php echo $node3; ?></a>
		<?php
			
			}else{
				echo "&nbsp;";
			}
		?>
	</td>
  </tr>
  
	<tr>
    <td colspan="3" align="center">
	  <img src="small_bar.jpg" border="0"></td>
    <td colspan="3" align="center">
	  <img src="small_bar.jpg" border="0"></td>
    <td colspan="3" align="center">
	  <img src="small_bar.jpg" border="0"></td>
    
  </tr>
  
  <tr>
    <td align="center">
		<?php
			if($node4 != -1){
			
		?>
		<br />
		<img src="green.gif" border="0">
		<br>
  			<a href="tree.php?id=<?php echo $node4 ;?>"><?php echo $node4; ?></a>
		<?php
			
			}else{
				echo "&nbsp";
			} 
		?>
		
	</td>
    
    <td align="center">
		<?php
			if($node5 != -1){
			
		?>
		<br />
		<img src="green.gif" border="0">
		<br>
  			<a href="tree.php?id=<?php echo $node5 ;?>"><?php echo $node5; ?></a>
		<?php
			
			}else{
				echo "&nbsp;";
			} 
		?>
		
	</td>
    <td align="center">
		<?php
			if($node6 != -1){
			
		?>
		<br />
		<img src="green.gif" border="0">
		<br>
  			<a href="tree.php?id=<?php echo $node6 ;?>"><?php echo $node6; ?></a>
		<?php
			
			}else{
				echo "&nbsp;";
			} 
		?>
		
	</td>
	<td align="center">
		<?php
			if($node7 != -1){
			
		?>
		<br />
		<img src="green.gif" border="0">
		<br>
  			<a href="tree.php?id=<?php echo $node7;?>"><?php echo $node7; ?></a>
		<?php
			
			}else{
				echo "&nbsp;";
			} 
		?>
		
	</td>

	<td align="center">
		<?php
			if($node8 != -1){
			
		?>
		<br />
		<img src="green.gif" border="0">
		<br>
  			<a href="tree.php?id=<?php echo $node8;?>"><?php echo $node8; ?></a>
		<?php
			
			}else{
				echo "&nbsp;";
			} 
		?>
		
	</td>

	<td align="center">
		<?php
			if($node9 != -1){
			
		?>
		<br />
		<img src="green.gif" border="0">
		<br>
  			<a href="tree.php?id=<?php echo $node9;?>"><?php echo $node9; ?></a>
		<?php
			
			}else{
				echo "&nbsp;";
			} 
		?>
		
	</td>

	<td align="center">
		<?php
			if($node10 != -1){
			
		?>
		<br />
		<img src="green.gif" border="0">
		<br>
  			<a href="tree.php?id=<?php echo $node10;?>"><?php echo $node10; ?></a>
		<?php
			
			}else{
				echo "&nbsp;";
			} 
		?>
		
	</td>

	<td align="center">
		<?php
			if($node11 != -1){
			
		?>
		<br />
		<img src="green.gif" border="0">
		<br>
  			<a href="tree.php?id=<?php echo $node11;?>"><?php echo $node11; ?></a>
		<?php
			
			}else{
				echo "&nbsp;";
			} 
		?>
		
	</td>

	<td align="center">
		<?php
			if($node12 != -1){
			
		?>
		<br />
		<img src="green.gif" border="0">
		<br>
  			<a href="tree.php?id=<?php echo $node12;?>"><?php echo $node12; ?></a>
		<?php
			
			}else{
				echo "&nbsp;";
			} 
		?>
		
	</td>
  </tr>
</table>
</body>

