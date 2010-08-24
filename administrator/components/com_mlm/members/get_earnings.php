<?php
 //$user=$_SESSION['username'];
 //$pass=$_SESSION['password']; $enrolled_id=$_SESSION['enrolled_id'];

 
 include ("reports/settings.inc");
$q=$_REQUEST['q']; 


$a="SELECT start_date,end_date from reports where report_id=$q";
$b=mysql_query($a);
$c=mysql_fetch_array($b);

	$q31=$c[0];
	$q32=$c[1];

	
if(strchr($q31,'-'))
{
$qt31=$q31;
$qt32=$q32;
$s=explode('-',$qt31);
$e=explode('-',$qt32);
$q31=$s[2].'/'.$s[1].'/'.$s[0];
$q32=$e[2].'/'.$e[1].'/'.$e[0];
$startdate=$qt31;
$enddate=$qt32;
}


$query="SELECT * FROM  mlm_generate_report where status_date BETWEEN DATE_ADD($qt32, INTERVAL -7 day) and $qt32 and payment_status='paid' ";
$query1="SELECT * FROM  mlm_generate_report where status_date BETWEEN $qt31 and $qt32 and payment_status='paid' "; 


$result=mysql_query($query);
$aff_r=mysql_affected_rows();
$result1=mysql_query($query1);
$aff_r1=mysql_affected_rows();
?>

<div id="payyou">
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr> 
    	<td align="center" valign="top"> 
        <?php
		$report_q="SELECT report_id,report_name,start_date,end_date from reports";
		$report_t=mysql_query($report_q);
		while($report_r=mysql_fetch_array($report_t))
		{
		
		if(strchr($report_r[start_date],'-'))
			{
				$startdate=$report_r[start_date];
				$enddate=$report_r[end_date];
				$s8=explode('-',$qt31);
				$e8=explode('-',$qt32);
				$startdate=$s8[2].'/'.$s8[1].'/'.$s8[0];
				$enddate=$e8[2].'/'.$e8[1].'/'.$e8[0];

			}
		
			?>
        <a href="#_" style="font-size:11px; color:#666666" onClick="send_data(<?php echo $report_r[report_id]?>)"><?php echo $startdate.' thru '.$enddate ?></a><br/>
		<?php
		}
		?>
        </td>
            <td width="785" align="center" bgcolor="#FFFFFF" valign="top">

      <div id="weekly" style="display:none" >      
            <table cellpadding="0" cellspacing="0" border="0" class="display" id="example" style="margin-top:10px; font-size:12px">
	
    <tr>
 
    <td align="center" colspan="10">
    <b>Commision Report Payout</b>    </td>
    </tr><?php if(isset($q31) && isset($q32)) { ?>
     <tr>
            <td>
          
            <select  onchange="change_data(this.value);">
            
          
                    <option value="0">Weekly</option>
             
       <option value="1">Monthly</option>
                </select>
</td>
<td>&nbsp;
</td>
<td>&nbsp;</td>
<td>&nbsp;</td>

<td colspan="2" align="left"> <b>Date:&nbsp;</b><?php echo $q31 ?>&nbsp;thru&nbsp;<?php echo $q32?>   </td>
<td>&nbsp;</td><td align="center" colspan="3">&nbsp;
    
    </td>
    </tr>
	<?php }?>
    	
        <tr>
			<th>Associate Name</th>
			<th>Sponsored Person</th>
			<th>Level</th>
			<th>Commissions</th>
        	<th>Preferred</th>
 			<th>Commission Match</th>
            <th>Preferred Match</th>
          	<th>Associate Status</th>
         	<th>Phone Number</th>
            <th>Payment Status</th>
            <th>Total</th>
		</tr>


<?php

if($aff_r>0)
{
$i=0;
while ($row = mysql_fetch_array($result)){
 
?>
    		<tr  class="odd_gradeX" <?php if($i%2==0) echo 'style="background-color:#CCCCCC"'; else echo'style="background-color:#FFFFFF"'; ?>>
			<?php echo "<td>".$row['associate_name']."</td>"?>
			<?php echo "<td>".$row['sponsored_person']."</td>"?>    
			<?php echo "<td>".$row['level']."</td>"; ?>
            <?php echo "<td>".$row['commissions']."</td>"?> 
            <?php $p_total+=$row['preferred'];echo "<td>".$row['preferred']."</td>"?>           
			<?php echo "<td>".$row['commission_match']."</td>"?>
            <?php echo "<td>".$row['preferred_match']."</td>"?>
          	<?php echo "<td>".$row['associate_status']."</td>" ?>
	        <?php echo "<td>".$row['phone_numbner']."</td>"?>       
            <?php echo "<td>".$row['payment_status']."</td>"?>
            <?php
			$t=$row['commission_match']+$row['commissions']+$row['preferred']+$row['preferred_match'];
			$total+=$t;
			echo '<td >'.$t.'</td>';
			?>
			
		</tr>
    
<?php
$i++;
}

$carry=0;
echo "
<tr style='background-color:#CCCCCC' >
<td >&nbsp;</td>
<td >&nbsp;</td>


<td >&nbsp;</td>
<td >&nbsp;</td>
<td >&nbsp;</td>
<td >&nbsp;</td>
<td >&nbsp;</td>

<td >&nbsp;</td>
<td >&nbsp;</td>
<td >&nbsp;</td>
</tr>
<tr >
<td >&nbsp;</td>
<td >&nbsp;</td>
<td >&nbsp;</td>
<td   ><b>Total</b></td>
<td >&nbsp;</td>

<td >&nbsp;</td>
<td >&nbsp;</td>
<td >&nbsp;</td>
<td >&nbsp;</td>
<td >$&nbsp;$total</td>
</tr>
<tr style='background-color:#CCCCCC'>
<td >&nbsp;</td>
<td >&nbsp;</td>


<td colspan='2'  align='left' ><b>&nbsp;Carry over amounts</b></td>
<td >&nbsp;</td>
<td >&nbsp;</td>
<td >&nbsp;</td>
<td >&nbsp;</td>

<td >&nbsp;</td>
<td >$&nbsp;$carry</td>
</tr>
<tr >
<td >&nbsp;</td>
<td >&nbsp;</td>

<td colspan='2'  align='left' ><b>&nbsp;Grand Total:</b></td>
<td >&nbsp;</td>
<td >&nbsp;</td>
<td >&nbsp;</td>
<td >&nbsp;</td>


<td >&nbsp;</td>
<td >$&nbsp;".($total+$carry)."</td>
</tr>
";
}
else 
{
?> <tr>
 
    <td align="center" colspan="10">
    <b style="color:#FF0000">No Record Present</b>    </td>
    </tr>
<?php

}?>
</table>
</div>
<div id="monthly" >
<table cellpadding="0" cellspacing="0" border="0" class="display" id="example" style="margin-top:10px; font-size:12px">
	
    <tr>
 
    <td align="center" colspan="10">
    <b>Commision Report Payout</b>    </td>
    </tr><?php if(isset($q31_1) && isset($q32_1)) { ?>
     <tr>
            <td>

    
            <select onchange="change_data(this.value);">
            
          			<option value="1">Monthly</option>
                    <option value="0">Weekly</option>
                	
           
                </select>

    
</td>
<td>&nbsp;
<?php /*
<form id="paybill" name="paybill" action="" method="post" enctype="multipart/form-data">
<?php
if($value==2)
{
?>
<input type="hidden" name="st" value="2" />
<input type="submit" name="payall" value="Pay To Monthly" />
<?php
}elseif($value==1)
{
?>
<input type="hidden" name="st" value="1" />
<input type="submit" name="payall" value="Pay To Weekly" />
<?php
}
else
{
?>
<input type="hidden" name="st" value="0" />
<input type="hidden" name="startdate" value="<?php echo $startdate?>" />
<input type="hidden" name="enddate" value="<?php echo $enddate?>" />
<input type="submit" name="payall" value="Pay" />
<?php
}
?>

</form>
*/?>
</td>
<td>&nbsp;</td>
<td>&nbsp;</td>

<td colspan="2" align="left"> <b>Date:&nbsp;</b><?php echo $q31_1 ?>&nbsp;thru&nbsp;<?php echo $q32_1?>   </td>
<td>&nbsp;</td><td align="center" colspan="3">&nbsp;
    
    </td>
    </tr>
	<?php }?>
    	
        <tr>
			<th>Associate Name</th>
			<th>Sponsored Person</th>
			<th>Level</th>
			<th>Commissions</th>
        	<th>Preferred</th>
 			<th>Commission Match</th>
            <th>Preferred Match</th>
          	<th>Associate Status</th>
         	<th>Phone Number</th>
            <th>Payment Status</th>
            <th>Total</th>
		</tr>


<?php

if($aff_r1>0)
{
$i=0;
while ($row1 = mysql_fetch_array($result1)){
 
?>
    		<tr  class="odd_gradeX" <?php if($i%2==0) echo 'style="background-color:#CCCCCC"'; else echo'style="background-color:#FFFFFF"'; ?>>
			<?php echo "<td>".$row1['associate_name']."</td>"?>
			<?php echo "<td>".$row1['sponsored_person']."</td>"?>    
			<?php echo "<td>".$row1['level']."</td>"; ?>
            <?php echo "<td>".$row1['commissions']."</td>"?> 
            <?php $p_total1+=$row1['preferred'];echo "<td>".$row1['preferred']."</td>"?>           
			<?php echo "<td>".$row1['commission_match']."</td>"?>
            <?php echo "<td>".$row1['preferred_match']."</td>"?>
          	<?php echo "<td>".$row1['associate_status']."</td>" ?>
	        <?php echo "<td>".$row1['phone_numbner']."</td>"?>       
            <?php echo "<td>".$row1['payment_status']."</td>"?>
            <?php
			$t1=$row1['commission_match']+$row1['commissions']+$row1['preferred']+$row1['preferred_match'];
			$total1+=$t1;
			echo '<td >'.$t1.'</td>';
			?>
			
		</tr>
    
<?php
$i++;
}

$carry1=0;
echo "
<tr style='background-color:#CCCCCC' >
<td >&nbsp;</td>
<td >&nbsp;</td>


<td >&nbsp;</td>
<td >&nbsp;</td>
<td >&nbsp;</td>
<td >&nbsp;</td>
<td >&nbsp;</td>

<td >&nbsp;</td>
<td >&nbsp;</td>
<td >&nbsp;</td>
</tr>
<tr >
<td >&nbsp;</td>
<td >&nbsp;</td>
<td >&nbsp;</td>
<td   ><b>Total</b></td>
<td >&nbsp;</td>

<td >&nbsp;</td>
<td >&nbsp;</td>
<td >&nbsp;</td>
<td >&nbsp;</td>
<td >$&nbsp;$total1</td>
</tr>
<tr style='background-color:#CCCCCC'>
<td >&nbsp;</td>
<td >&nbsp;</td>


<td colspan='2'  align='left' ><b>&nbsp;Carry over amounts</b></td>
<td >&nbsp;</td>
<td >&nbsp;</td>
<td >&nbsp;</td>
<td >&nbsp;</td>

<td >&nbsp;</td>
<td >$&nbsp;$carry1</td>
</tr>
<tr >
<td >&nbsp;</td>
<td >&nbsp;</td>

<td colspan='2'  align='left' ><b>&nbsp;Grand Total:</b></td>
<td >&nbsp;</td>
<td >&nbsp;</td>
<td >&nbsp;</td>
<td >&nbsp;</td>


<td >&nbsp;</td>
<td >$&nbsp;".($total1+$carry1)."</td>
</tr>
";
}
else 
{
?> <tr>
 
    <td align="center" colspan="10">
    <b style="color:#FF0000">No Record Present</b>    </td>
    </tr>
<?php

}?>
</table>
</div>

    <p>&nbsp;</p></td>
  </tr>
        </table>
        
      </div></td>
  </tr>
</table>
</div>
