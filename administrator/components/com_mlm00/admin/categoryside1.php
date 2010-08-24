<?
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
			  
			  <a href="<? print "view_profile.php" ?>">
			  
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
						  
						   <a href="<? print "view_personally_enrolled.php" ?>">
						  
						 Personaly Enrolled</a></font></strong></font></td>
                        </tr> 
						 <!-- <tr>
                          <td bgcolor="#FFFFFF" class="blue_txt"  width="6"><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong><font color="#990000">::</font></strong></font></td>
                          <td height="15" bgcolor="#FFFFFF" class="blue_txt"><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong><font color="#990000">
						   <a href="<? print "view_mem_cust.php" ?>">
						  
						  Customers</a></font></strong></font></td>
                        </tr>-->
                        <tr>
                          <td bgcolor="#FFFFFF" class="blue_txt"  width="6"><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong><font color="#990000">::</font></strong></font></td>
                          <td height="15" bgcolor="#FFFFFF" class="blue_txt"><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong><font color="#990000">
						  
						   <a href="<? print "view_geneology.php" ?>">
						  Genelogy</a></font></strong></font></td>
                        </tr>
                        <tr>
                          <td bgcolor="#FFFFFF" class="blue_txt"  width="6"><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong><font color="#990000">::</font></strong></font></td>
                          <td height="15" bgcolor="#FFFFFF" class="blue_txt"><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong><font color="#990000">
						  
						   <a href="<? print "view_geneology_graph.php" ?>">
						  Graphical Genelogy</a></font></strong></font></td>
                        </tr>
                        
                        <tr>
                          <td bgcolor="#FFFFFF" class="blue_txt"  width="6"><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong><font color="#990000">::</font></strong></font></td>
                          <td height="15" bgcolor="#FFFFFF" class="blue_txt"><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong><font color="#990000">
						   <a href="<? print "view_orders.php" ?>">
						  
					View Orders</a></font></strong></font></td>
                        </tr>
						<!--<tr>
                          <td bgcolor="#FFFFFF" class="blue_txt"  width="6"><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong><font color="#990000">::</font></strong></font></td>
                          <td height="15" bgcolor="#FFFFFF" class="blue_txt"><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong><font color="#990000">
						   <a href="<?// print "view_mem_cust.php" ?>">
						 Sub-Members Order</a></font></strong></font></td>
                        </tr>-->
						
						
						<!--<tr>
                          <td bgcolor="#FFFFFF" class="blue_txt"  width="6"><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong><font color="#990000">::</font></strong></font></td>
                          <td height="15" bgcolor="#FFFFFF" class="blue_txt"><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong><font color="#990000">
						   <a href="<?// print "view_mem_cust.php" ?>">
						 Sale Volume</a></font></strong></font></td>
                        </tr>-->
						<tr>
                          <td bgcolor="#FFFFFF" class="blue_txt"  width="6"><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong><font color="#990000">::</font></strong></font></td>
                          <td height="15" bgcolor="#FFFFFF" class="blue_txt"><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong><font color="#990000">
						   <a href="<? print "view_volume_carry_over.php" ?>">
						 Volume Carry Over</a></font></strong></font></td>
                        </tr>
						
						<tr>
                          <td bgcolor="#FFFFFF" class="blue_txt"  width="6"><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong><font color="#990000">::</font></strong></font></td>
                          <td height="15" bgcolor="#FFFFFF" class="blue_txt"><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong><font color="#990000">
						   <a href="<? print "view_commisions.php" ?>">
						 Commisions</a></font></strong></font></td>
                        </tr>
						<tr>
                          <td bgcolor="#FFFFFF" class="blue_txt"  width="6"><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong><font color="#990000">::</font></strong></font></td>
                          <td height="15" bgcolor="#FFFFFF" class="blue_txt"><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong><font color="#990000">
						   <a href="<? print "view_earnings.php" ?>">
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