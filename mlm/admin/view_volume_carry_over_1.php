<?
 session_start();
 include('settings.inc');
 include('header.php');
 $user=$_SESSION['username'];
 $pass=$_SESSION['password'];
$enrolled_id2=$_GET['enrolled_id'];
$enrolled_id_2=$enrolled_id2;

$sqll="select * from members where enrolled_id='".$enrolled_id_2."'"
	or die(mysql_error()) ;
$queryl=mysql_query($sqll);
$resultl=mysql_fetch_array($queryl);

$mem_name2=$resultl['mem_name'];
 
 
 

?>
<head>       
<link href="style2.css" rel="stylesheet" type="text/css">
</head>
<body bgcolor="#666666" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table width="990" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr> 
    <td width="200" valign="top" bgcolor="#FFFFFF"> 
            <? include('categoryside.php'); ?>             </td>
            <td width="785" valign="top" bgcolor="#FFFFFF"> <br>
              <br>
             <form method="post" action="" name="articlelist">
              <table width="95%" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#D4D4C8">
                <?php
				if($message != "")
				{
				?>
                <tr> 
                  <td height="19" colspan="8" align="center" bgcolor="#EFEFE7" class="blue_txt"><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong><?php echo $message;?> 
                    </strong></font></td>
                </tr>
                <?php
				}
				?>
                <!--<tr> 
                  <td height="19" colspan="3" align="center" bgcolor="#EFEFE7" class="blue_txt"><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 
                    <a href="list_form.php?show=a">A</a> <a href="list_form.php?show=b">B</a> 
                    <a href="list_form.php?show=c">C</a> <a href="list_form.php?show=d">D</a> 
                    <a href="list_form.php?show=e">E</a> <a href="list_form.php?show=f">F</a> 
                    <a href="list_form.php?show=g">G</a> <a href="list_form.php?show=h">H</a> 
                    <a href="list_form.php?show=i">I</a> <a href="list_form.php?show=j">J</a> 
                    <a href="list_form.php?show=k">K</a> <a href="list_form.php?show=l">L</a> 
                    <a href="list_form.php?show=m">M</a> <a href="list_form.php?show=n">N</a> 
                    <a href="list_form.php?show=o">O</a> <a href="list_form.php?show=p">P</a> 
                    <a href="list_form.php?show=q">Q</a> <a href="list_form.php?show=r">R</a> 
                    <a href="list_form.php?show=s">S</a> <a href="list_form.php?show=t">T</a> 
                    <a href="list_form.php?show=u">U</a> <a href="list_form.php?show=v">V</a> 
                    <a href="list_form.php?show=w">W</a> <a href="list_form.php?show=x">X</a> 
                    <a href="list_form.php?show=y">Y</a> <a href="list_form.php?show=z">Z</a> 
                    <a href="list_form.php">All</a></strong></font></td>
                </tr>-->
                <tr> 
                  <td height="19" colspan="8" bgcolor="#EFEFE7" class="blue_txt"><font color="#000000" size="2" face="Verdana, Arial, Helvetica, sans-serif"><strong>:: 
                    &nbsp;VOLUME CARRY OVER</strong></font></td>
                </tr>
                <tr> 
                  <td height="15" colspan="8" bgcolor="#FFFFFF" class="blue_txt"><div align="justify"><font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 
                      The following desciption is there -</font></div></td>
                </tr>
                <tr> 
                  <td width="18%" height="15" bgcolor="#FFFFFF" class="blue_txt">
                    <font color="#990000" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 
                      LEFT CARRY OVER</strong></font>
                  </td>
				  <td width="15%" align="center" bgcolor="#FFFFFF" class="blue_txt"><font color="#990000" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong>RIGHT CARRY OVER</strong></font></td>
                  <!--<td width="13%" align="center" bgcolor="#FFFFFF" class="blue_txt"><font color="#990000" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong>AMOUNT</strong></font></td>
				  <td width="12%" align="center" bgcolor="#FFFFFF" class="blue_txt"><font color="#990000" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong>STATUS</strong></font></td>
				  <td width="14%" align="center" bgcolor="#FFFFFF" class="blue_txt"><font color="#990000" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong>INVOICE </strong></font></td>
				  <td width="7%" align="center" bgcolor="#FFFFFF" class="blue_txt"><font color="#990000" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong>PURCHASER ID </strong></font></td>
				  <td width="10%" align="center" bgcolor="#FFFFFF" class="blue_txt"><font color="#990000" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong>JOIN DATE</strong></font></td>
				<td width="11%" align="center" bgcolor="#FFFFFF" class="blue_txt">Delete</font></strong></font></td>-->
				                   
                </tr>
                <? 
						///////////////   sum of left ids and right ids ////////////////////
	
	$lid2 =mysql_query("SELECT SUM(left_id) FROM ".$mem_name2."") or die(mysql_error());
	$lresult = mysql_result($lid2, 0);
	$lid=$lresult;
	
	$rid2  =mysql_query("SELECT SUM(right_id) FROM ".$mem_name2."") or die(mysql_error());
	$rresult = mysql_result($rid2, 0);
	$rid=$rresult;
					
				
				  ?>
                <tr> 
					<td height="15" bgcolor="#FFFFFF" class="blue_txt"><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif" >
					 <?=$lid;?>
                  </font></td>
					<td align="center" bgcolor="#FFFFFF" class="blue_txt"><font color="#990000"><strong><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif" >
					  <?=$rid;?>
					</font></td>
					<!--<td align="center" bgcolor="#FFFFFF" class="blue_txt">
					
					<font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif" >
					<?//=$mem_name;?>
					</font></td>
     
	 
	 <td align="center" bgcolor="#FFFFFF" class="blue_txt"><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif" >
			  <?//=$binaryrank;?>
			  </font></td>
					
					
					
					
					<td align="center" bgcolor="#FFFFFF" class="blue_txt"><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif" >
					<?//=$enroller_id;?>
					</font></td>
					
					
					
					<td align="center" bgcolor="#FFFFFF" class="blue_txt"><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif" >
					<?//=$volume;?>
					</font></td>
					
					
				<!--	<td align="center" bgcolor="#FFFFFF" class="blue_txt"><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif" >
					<?//=$joindate;?>
					</font></td>
					
					
					<td align="center" bgcolor="#FFFFFF" class="blue_txt">
					
					</font><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif" >
					<?//=$company;?>
					</font><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><a onClick="return confirm('Are you sure you want to delete?')" 
					href="<?// print "company_profile.php?mode=del&compname=". $results[0]."&compname=".$results[0]; ?>"></a></font></strong></font></td>-->
	 
	 
	 
	 
                </tr>
               
               
              </table>
              </form>
              
              <p>&nbsp;</p>
              <p>&nbsp;</p>
              <p>&nbsp;</p>
              <p>&nbsp;</p>
              <p>&nbsp;</p>
    <p>&nbsp;</p></td>
  </tr>
        </table>
        
      </div></td>
  </tr>
</table>
<? include('footer.php'); ?>