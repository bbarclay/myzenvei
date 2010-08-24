<?php
ob_start();
include ("settings.inc");
$q=$_GET["q"];
?>

<div  class = "tooltip" >
<?php
$query2 = "SELECT avatar FROM  jos_community_users where userid = '$q'"; 
$result2 = mysql_query($query2);
$row2 = mysql_fetch_array($result2);
$avatar = $row2['avatar'];
//$avatar = 'images/default.jpg';

$query = "SELECT * FROM mlm_geneology_tree where userid = '$q'"; 
		$result = mysql_query($query);
		$numrows =  mysql_num_rows($result);
		while ($row = mysql_fetch_array($result)){
			?>


			<table style="margin: 0pt;" align="center">
		<tbody><tr>
		  <td width="69" rowspan="9"  class="label"><img src="<?php echo $avatar; ?>" width="80" height="80" alt="default"></td>
			<td width="90"  class="label">ID: </td>
			<td width="148"> <?php echo $row['userid']; ?></td>
		</tr>
		<tr>
		  <td class="label">Name:</td>
			<td><?php echo $row['username']; ?></td>
		</tr>
		<tr>
		  <td class="label">Left:</td>
			<td><?php echo $row['lft']; ?></td>
		</tr>
		<tr>
		  <td class="label">Right:</td>
			<td><?php echo $row['rgt']; ?></td>
		</tr>
        
        	<tr>
        	  <td class="label">Sponser Id:</td>
			<td><?php echo $row['parentid']; ?></td>
		</tr>
		<tr>
		  <td class="label">Sponser Name:</td>
			<td><?php echo '-'; ?></td>
		</tr>
		<tr>
		  <td class="label">Position:</td>
			<td><?php echo $row['position']; ?></td>
		</tr>
        <tr>
          <td class="label">Balance:</td>
			<td><?php echo '-'; ?></td>
		</tr>
		<tr>
		  <td class="label">D.O.J:</td>
			<td><?php echo $row['datejoining']; ?></td>
		</tr>			
	</tbody></table>
			
			<?php
			  
			  
				
		
		}
?> 
</div>
<?php ob_end_flush(); ?>