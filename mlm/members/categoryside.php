<?php
include 'header.php';
$username=$_SESSION['username'];
$pwd=$_SESSION['pwd'];
$sql="select * from members where username='".$username."' and pwd='".$pwd."'";
$query=mysql_query($sql);
$result=mysql_fetch_array($query);
$mem_name=$result['mem_name'];
$enrolled_id=$result['enrolled_id'];
$enroller_id=$result['enroller_id'];
?>		
<table width="100%" border="0" align="left" cellpadding="0" cellspacing="0">
         	 <tr>
          	  <td width="23%" valign="top"><br>
    <br>
    <table width="168" border="0" align="center" cellpadding="0"  cellspacing="1" bgcolor="#D4D4C8">
      <tr> 
        <td> <table width="100%" cellspacing="0" border="0">
            <tr> 
              <td bgcolor="#EFEFE7" class="blue_txt" width="6" ><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong>::</strong></font></td>
              <td height="15" bgcolor="#EFEFE7" class="blue_txt"><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 
              <a href="main.php">
                Home :
                </a></strong></font></td>
            </tr>
          </table></td>
      </tr>
      
    </table>
    
    <br>
    <table width="168" border="0" align="center" cellpadding="0"  cellspacing="1" bgcolor="#D4D4C8">
                <tr><td>
				<table width="100%" cellspacing="0" border="0">
				  <tr><td bgcolor="#EFEFE7" class="blue_txt" width="6" ><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong>::</strong></font></td>
                  
              <td height="15" bgcolor="#EFEFE7" class="blue_txt"><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 
                Profile Management :</strong></font></td>
                  </tr>	
				</table>
				</td></tr>
				<tr><td>
				<table width="100%" cellspacing="0" border="0" cellpadding="3">
				  <tr><td bgcolor="#FFFFFF" class="blue_txt"  width="6"><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong><font color="#990000">::</font></strong></font></td>
                  
              <td height="15" bgcolor="#FFFFFF" class="blue_txt"><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong><font color="#990000">
			  
			  <a href="<? print "view_profile.php?enrolled_id=".$enrolled_id; ?>">
			  
			  View
                Profiles</a></font></strong></font></td>
                  </tr>
				
				  <tr><td bgcolor="#FFFFFF" class="blue_txt"  width="6"><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong><font color="#990000">::</font></strong></font></td>
                  
              <td height="15" bgcolor="#FFFFFF" class="blue_txt"><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong><font color="#990000"><a href="active_de_active_members.php">  Active/De-Active Members</a></font></strong></font></strong></font><font color="#990000"><a href="fare_update.php"></a></font></strong></font></td>
                  </tr>	
				
				
                			  <tr><td bgcolor="#FFFFFF" class="blue_txt"  width="6"><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong><font color="#990000">::</font></strong></font></td>
                  
              <td height="15" bgcolor="#FFFFFF" class="blue_txt"><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong><font color="#990000"><a href="logout.php">Logout</a></font></strong></font></strong></font><font color="#990000"><a href="fare_update.php"></a></font></strong></font></td>
                  </tr>	
				</table>
				</td></tr>
         		
				</table>
                <br />
                <table width="168" border="0" align="center" cellpadding="0"  cellspacing="1" bgcolor="#D4D4C8">
                  <tr>
                    <td><table width="100%" cellspacing="0" border="0">
                        <tr>
                          <td bgcolor="#EFEFE7" class="blue_txt" width="6" ><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong>::</strong></font></td>
                          <td height="15" bgcolor="#EFEFE7" class="blue_txt"><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> Othere Details :</strong></font></td>
                        </tr>
                    </table></td>
                  </tr>
                  
                  <tr>
                    <td><table width="100%" cellspacing="0" border="0" cellpadding="3">
                    <tr>
                          <td bgcolor="#FFFFFF" class="blue_txt"  width="6"><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong><font color="#990000">::</font></strong></font></td>
                          <td height="15" bgcolor="#FFFFFF" class="blue_txt">  <font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong><font color="#990000">
						  
						   <a href="<? print "view_personally_enrolled.php?enrolled_id=".$enrolled_id; ?>">
						  
						 Personaly Enrolled</a></font></strong></font></td>
                        </tr> 
						 <!-- <tr>
                          <td bgcolor="#FFFFFF" class="blue_txt"  width="6"><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong><font color="#990000">::</font></strong></font></td>
                          <td height="15" bgcolor="#FFFFFF" class="blue_txt"><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong><font color="#990000">
						   <a href="<? print "view_mem_cust.php?enrolled_id=".$enrolled_id; ?>">
						  
						  Customers</a></font></strong></font></td>
                        </tr>-->
                        <tr>
                          <td bgcolor="#FFFFFF" class="blue_txt"  width="6"><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong><font color="#990000">::</font></strong></font></td>
                          <td height="15" bgcolor="#FFFFFF" class="blue_txt"><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong><font color="#990000">
						  
						   <a href="<? print "view_geneology.php?enrolled_id=".$enrolled_id; ?>">
						  Genelogy</a></font></strong></font></td>
                        </tr>
                        <tr>
                          <td bgcolor="#FFFFFF" class="blue_txt"  width="6"><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong><font color="#990000">::</font></strong></font></td>
                          <td height="15" bgcolor="#FFFFFF" class="blue_txt"><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong><font color="#990000">
						  
						   <a href="<? print "view_geneology_graph.php?enrolled_id=".$enrolled_id; ?>">
						  Graphical Genelogy</a></font></strong></font></td>
                        </tr>
                        
                        <tr>
                          <td bgcolor="#FFFFFF" class="blue_txt"  width="6"><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong><font color="#990000">::</font></strong></font></td>
                          <td height="15" bgcolor="#FFFFFF" class="blue_txt"><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong><font color="#990000">
						   <a href="<? print "view_orders.php?enrolled_id=".$enrolled_id; ?>">
						  
					View Orders</a></font></strong></font></td>
                        </tr>
						<!--<tr>
                          <td bgcolor="#FFFFFF" class="blue_txt"  width="6"><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong><font color="#990000">::</font></strong></font></td>
                          <td height="15" bgcolor="#FFFFFF" class="blue_txt"><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong><font color="#990000">
						   <a href="<?// print "view_mem_cust.php?enrolled_id=".$enrolled_id; ?>">
						 Sub-Members Order</a></font></strong></font></td>
                        </tr>-->
						
						
						<!--<tr>
                          <td bgcolor="#FFFFFF" class="blue_txt"  width="6"><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong><font color="#990000">::</font></strong></font></td>
                          <td height="15" bgcolor="#FFFFFF" class="blue_txt"><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong><font color="#990000">
						   <a href="<?// print "view_mem_cust.php?enrolled_id=".$enrolled_id; ?>">
						 Sale Volume</a></font></strong></font></td>
                        </tr>-->
						<tr>
                          <td bgcolor="#FFFFFF" class="blue_txt"  width="6"><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong><font color="#990000">::</font></strong></font></td>
                          <td height="15" bgcolor="#FFFFFF" class="blue_txt"><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong><font color="#990000">
						   <a href="<? print "view_volume_carry_over.php?enrolled_id=".$enrolled_id; ?>">
						 Volume Carry Over</a></font></strong></font></td>
                        </tr>
						
						<tr>
                          <td bgcolor="#FFFFFF" class="blue_txt"  width="6"><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong><font color="#990000">::</font></strong></font></td>
                          <td height="15" bgcolor="#FFFFFF" class="blue_txt"><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong><font color="#990000">
						   <a href="<? print "view_commisions.php?enrolled_id=".$enrolled_id; ?>">
						 Commisions</a></font></strong></font></td>
                        </tr>
						<tr>
                          <td bgcolor="#FFFFFF" class="blue_txt"  width="6"><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong><font color="#990000">::</font></strong></font></td>
                          <td height="15" bgcolor="#FFFFFF" class="blue_txt"><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong><font color="#990000">
						   <a href="<? print "view_earnings.php?enrolled_id=".$enrolled_id; ?>">
						 Earnings</a></font></strong></font></td>
                        </tr>
                    </table></td>
                  </tr>
                </table>
                <br />
                <br />
                <br>
    </td>
</tr>
</table>