<?php
ob_start(); 

$fast_start=$_GET["q3"];
$phone=$_GET["q20"];
$associate_name=$_GET["q18"];
$commission=$_GET["q4"];
$preferred=$_GET["q5"];
$fast_match=$_GET["q7"];
$commission_match=$_GET["q8"];
$preferred_match=$_GET["q9"];
$status_date=$_GET["q16"];



?>
<table cellpadding="0" cellspacing="0" border="0" class="display" id="example" style="margin-top:10px;">
	<thead>
		<tr>
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
		</tr>
	</thead>
	<tbody>
<?php
include ("settings.inc");
include_once '../../../../clients/zenvieConfig.php';
 //where associate_name='$usernameUid'
$query="SELECT * FROM  mlm_generate_report where associate_name='$usernameUid'"; 
$result=mysql_query($query);
while ($row = mysql_fetch_array($result)){

?>
    
    
		<tr class="odd_gradeX">
			<?php if ($associate_name == 'true'){ echo "<td><a href='http://www.zenvei.com/components/com_mlm/members/view_geneology_graph.php'>".$row['associate_name']."</a></td>";}?>
			<?php if ($sponsored_person == 'true'){ echo "<td>".$row['sponsored_person']."</td>";}?>    
			<td><?php echo $row['level']; ?></td>
			<?php if ($fast_start == 'true'){ echo "<td>".number_format($row['fast_start'],2)."</td>";}?>
                	<?php if ($commission == 'true'){ echo "<td>".number_format($row['commissions'],2)."</td>";}?> 
                	<?php if ($preferred == 'true'){ echo "<td>".$row['preferred']."</td>";}?>           
			<?php if ($fast_match == 'true'){ echo "<td>".number_format($row['fast_match'],2)."</td>";}?>
			<?php if ($commission_match == 'true'){ echo "<td>".number_format($row['commission_match'],2)."</td>";}?>
            <?php if ($preferred_match == 'true'){ echo "<td>".number_format($row['preferred_match'],2)."</td>";}?>
         <td><?php echo $row['associate_status']; ?></td>
			<?php if ($status_date == 'true'){ echo "<td>".date("m/d/Y",strtotime($row['status_date']))."</td>";}?>
	            <?php if ($phone == 'true'){ echo "<td>".$row['phone_numbner']."</td>";}?>  
                          
            <td><?php echo $row['payment_status']; ?></td>
			
		</tr>
<?php
}
?>
	</tbody>
</table>
<?php ob_end_flush(); ?>