<?php
include 'header.php';
 $user=$_SESSION['username'];
 $pass=$_SESSION['password']; $enrolled_id=$_SESSION['enrolled_id'];
 $sql="select * from members where username='".$user."' and password='".$pass."'";
 $query=mysql_query($sql);
 $result=mysql_fetch_array($query);
 $mem_name=$result['mem_name'];
 $f_name=$result['f_name'];
 $l_name=$result['l_name'];
 $comp_name=$result['comp_name'];
 $address=$result['address'];
 $address_2=$result['address_2'];
 $city=$result['city'];
 $state=$result['state'];	
 $zip_code=$result['zip_code'];
 $country=$result['country'];
 $hm_ph=$result['hm_ph'];]
 $wk_ph=$result['wk_ph'];
 $fax_no=$result['fax_no'];
 $cell_no=$result['cell_no'];
 $pgr_no=$result['pgr_no'];
 $other_no=$result['other_no'];
 $email_id=$result['email_id'];
 $rep_site=$result['rep_site'];
 $pwd=$result['pwd'];
 $pan_no=$result['pan_no'];
 $father_gur_name=$result['father_gur_name'];
 $bank_name=$result['bank_name'];
$bk_acc_no=$result['bk_acc_no'];
$d_b=$result['d_b'];
$nominee=$result['nominee'];

if( $_POST)
{

$mem_name = $_POST['mem_name'];
$f_name = $_POST['f_name'];
$l_name = $_POST['l_name'];
$comp_name = $_POST['comp_name'];
$address = $_POST['address'];
$address_2 = $_POST['address_2'];
$city = $_POST['city'];
$state = $_POST['state'];
$zip_code = $_POST['zip_code'];
$country = $_POST['country'];
$hm_ph = $_POST['hm_ph'];
$wk_ph = $_POST['wk_ph'];
$fax_no = $_POST['fax_no'];
$cell_no = $_POST['cell_no'];
$pgr_no = $_POST['pgr_no'];
$other_no = $_POST['other_no'];
$email_id = $_POST['email_id'];
$rep_site = $_POST['rep_site'];
$pwd = $_POST['pwd'];
$pan_no = $_POST['pan_no'];
$father_gur_name = $_POST['father_gur_name'];
$compname = $_POST['compname'];
$bk_acc_no = $_POST['bk_acc_no'];
$bank_name = $_POST['bank_name'];
$d_b = $_POST['d_b'];
$nominee = $_POST['nominee'];

if(empty($message1))
		{
				$sql1 ="update  members set mem_name='".$mem_name"'+ f_name='".$f_name"'+l_name='".$l_name"'+comp_name='".$comp_name"'+address='".$address"'address_2='".$address_2"'+city='".$city"'+state='".$state"'+zip_code='".$zip_code"'+country='".$country"'+hm_ph='".$hm_ph"'+wk_ph='".$wk_ph"'+fax_no='".$fax_no"'+cell_no='".$cell_no"'+pgr_no='".$pgr_no"'+other_no='".$other_no"'+email_id='".$email_id"'+rep_site='".$rep_site"'+pwd='".$pwd"'+pan_no='".$pan_no"'+father_gur_name='".$father_gur_name"'+bank_name='".$bank_name"'+bk_acc_no='".$bk_acc_no"'+d_b='".$d_b"'+nominee='".$nominee"'";
				$result1 = mysql_query($sql1);
				$message="Profile Updated Successfully";
		}
}

?>
<head>       
<link href="style2.css" rel="stylesheet" type="text/css">
</head>
<body bgcolor="#666666" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr> 
    <td width="200" valign="top" bgcolor="#FFFFFF"> 
           <? include('categoryside.php');
		    ?>
		   <br>
		   
          </td>
            <td width="77%" valign="top" bgcolor="#FFFFFF"> <br><br>
             <form enctype="multipart/form-data"  method="post"  name="form1" action="">
               
              <table width="95%" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#D4D4C8">
                <?php
				if($message != "")
				{
				?>
                <tr align="center"> 
                  <td height="19" colspan="2" bgcolor="#EFEFE7" class="blue_txt"><font color="#FF0000" size="2" face="Verdana, Arial, Helvetica, sans-serif"><strong><?php echo $message;?> 
                    </strong></font></td>
                </tr>
                <?php
				}
				?>
                <tr> 
                  <td height="19" colspan="2" bgcolor="#EFEFE7" class="blue_txt"><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong>:: 
                    &nbsp;Your Details </strong></font></td>
                </tr>
                <tr> 
                  <td height="15" colspan="2" bgcolor="#FFFFFF" class="blue_txt"><div align="justify"><font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 
                      The following information is Available - </font></div></td>
                </tr>
                <tr> 
                  <td width="24%" height="15" bgcolor="#FFFFFF" class="blue_txt"><div align="right"><font color="#990000"><strong><font size="1" face="Verdana, Arial, Helvetica, sans-serif">Members  
                      Name :</font></strong></font></div></td>
                  <td bgcolor="#FFFFFF" class="blue_txt"><input name="mem_name" type="text" id="mem_name" size="40" value="<?=$mem_name;?>"> 
                    &nbsp;<font color="#000000"><strong><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><? echo $message1[0]; ?></strong></font></td>
                </tr>
                                <tr>
                                  <td height="15" bgcolor="#FFFFFF" class="blue_txt"><div align="right"><font color="#990000"><strong><font size="1" face="Verdana, Arial, Helvetica, sans-serif">First Name  
                                    :</font></strong></font></div></td>
                                  <td bgcolor="#FFFFFF" class="blue_txt"><input name="fname" type="text" id="fname" size="40" value="<?=$f_name;?>">                                  </td>
                                </tr>
								
								
								
								 <tr>
                                  <td height="15" bgcolor="#FFFFFF" class="blue_txt"><div align="right"><font color="#990000"><strong><font size="1" face="Verdana, Arial, Helvetica, sans-serif">Last Name  
                                    :</font></strong></font></div></td>
                                  <td bgcolor="#FFFFFF" class="blue_txt"><input name="lname" type="text" id="lname" size="40" value="<?=$l_name;?>">                                  </td>
                                </tr>
								
								
								
								
								 <tr>
                                  <td height="15" bgcolor="#FFFFFF" class="blue_txt"><div align="right"><font color="#990000"><strong><font size="1" face="Verdana, Arial, Helvetica, sans-serif">Company Name  
                                    :</font></strong></font></div></td>
                                  <td bgcolor="#FFFFFF" class="blue_txt"><input name="compname" type="text" id="comapname" size="40" value="<?=$comp_name;?>">                                  </td>
                                </tr>
								
								
								
								 <tr>
                                  <td height="15" bgcolor="#FFFFFF" class="blue_txt"><div align="right"><font color="#990000"><strong><font size="1" face="Verdana, Arial, Helvetica, sans-serif">Billing Address  
                                    :</font></strong></font></div></td>
                                  <td bgcolor="#FFFFFF" class="blue_txt"><input name="b_address" type="text" id="b_address" size="40" value="<?=$address;?>">                                  </td>
                                </tr>
								
								<tr>
                                  <td height="15" bgcolor="#FFFFFF" class="blue_txt"><div align="right"><font color="#990000"><strong><font size="1" face="Verdana, Arial, Helvetica, sans-serif">Billing Address two 
                                    :</font></strong></font></div></td>
                                  <td bgcolor="#FFFFFF" class="blue_txt"><input name="b_address_2" type="text" id="b_address_2" size="40" value="<?=$address_2;?>">                                  </td>
                                </tr>
								
								
								 <tr>
                                  <td height="15" bgcolor="#FFFFFF" class="blue_txt"><div align="right"><font color="#990000"><strong><font color="#990000"><strong><font size="1" face="Verdana, Arial, Helvetica, sans-serif">Billing</font></strong></font><font size="1" face="Verdana, Arial, Helvetica, sans-serif"> City  
                                    :</font></strong></font></div></td>
                                  <td bgcolor="#FFFFFF" class="blue_txt"><input name="city" type="text" id="city" size="40" value="<?=$city;?>">                                  </td>
                                </tr>



								
								
								 <tr>
                                  <td height="15" bgcolor="#FFFFFF" class="blue_txt"><div align="right"><font color="#990000"><strong><font color="#990000"><strong><font size="1" face="Verdana, Arial, Helvetica, sans-serif">Billing</font></strong></font><font size="1" face="Verdana, Arial, Helvetica, sans-serif"> State  
                                    :</font></strong></font></div></td>
                                  <td bgcolor="#FFFFFF" class="blue_txt"><input name="state" type="text" id="state" size="40" value="<?=$state;?>">                                  </td>
                                </tr>



								
								
								 <tr>
                                  <td height="15" bgcolor="#FFFFFF" class="blue_txt"><div align="right"><font color="#990000"><strong><font color="#990000"><strong><font size="1" face="Verdana, Arial, Helvetica, sans-serif">Billing</font></strong></font><font size="1" face="Verdana, Arial, Helvetica, sans-serif"> ZipCode  
                                    :</font></strong></font></div></td>
                                  <td bgcolor="#FFFFFF" class="blue_txt"><input name="zipcode" type="text" id="zipcode" size="40" value="<?=$zip_code;?>">                                  </td>
                                </tr>



								
								
								 <tr>
                                  <td height="15" bgcolor="#FFFFFF" class="blue_txt"><div align="right"><font color="#990000"><strong><font color="#990000"><strong><font size="1" face="Verdana, Arial, Helvetica, sans-serif">Billing</font></strong></font><font size="1" face="Verdana, Arial, Helvetica, sans-serif"> Country  
                                    :</font></strong></font></div></td>
                                  <td bgcolor="#FFFFFF" class="blue_txt"><input name="country" type="text" id="country" size="40" value="<?=$country;?>">                                  </td>
                                </tr>



								
								
								 <tr>
                                  <td height="15" bgcolor="#FFFFFF" class="blue_txt"><div align="right"><font color="#990000"><strong><font size="1" face="Verdana, Arial, Helvetica, sans-serif">Home Phone  
                                    :</font></strong></font></div></td>
                                  <td bgcolor="#FFFFFF" class="blue_txt"><input name="hPhone" type="text" id="hPhone" size="40" value="<?=$hm_ph;?>">                                  </td>
                                </tr>



								
								
								 <tr>
                                  <td height="15" bgcolor="#FFFFFF" class="blue_txt"><div align="right"><font color="#990000"><strong><font size="1" face="Verdana, Arial, Helvetica, sans-serif">Work Phone  
                                    :</font></strong></font></div></td>
                                  <td bgcolor="#FFFFFF" class="blue_txt"><input name="wPhone" type="text" id="wPhone" size="40" value="<?=$wk_ph;?>">                                  </td>
                                </tr>



								
								
								 <tr>
                                  <td height="15" bgcolor="#FFFFFF" class="blue_txt"><div align="right"><font color="#990000"><strong><font size="1" face="Verdana, Arial, Helvetica, sans-serif">Fax No.  
                                    :</font></strong></font></div></td>
                                  <td bgcolor="#FFFFFF" class="blue_txt"><input name="Fax" type="text" id="Fax" size="40" value="<?=$fax_no;?>">                                  </td>
                                </tr>



								
								
								 <tr>
                                  <td height="15" bgcolor="#FFFFFF" class="blue_txt"><div align="right"><font color="#990000"><strong><font size="1" face="Verdana, Arial, Helvetica, sans-serif">Mobile No.  
                                    :</font></strong></font></div></td>
                                  <td bgcolor="#FFFFFF" class="blue_txt"><input name="Mobile" type="text" id="Mobile" size="40" value="<?=$cell_no;?>">                                  </td>
                                </tr>



								
								
								 <tr>
                                  <td height="15" bgcolor="#FFFFFF" class="blue_txt"><div align="right"><font color="#990000"><strong><font size="1" face="Verdana, Arial, Helvetica, sans-serif">Pager No.  
                                    :</font></strong></font></div></td>
                                  <td bgcolor="#FFFFFF" class="blue_txt"><input name="Pager" type="text" id="Pager" size="40" value="<?=$pgr_no;?>">                                  </td>
                                </tr>
								
								<tr>
                                  <td height="15" bgcolor="#FFFFFF" class="blue_txt"><div align="right"><font color="#990000"><strong><font size="1" face="Verdana, Arial, Helvetica, sans-serif">Other No.  
                                    :</font></strong></font></div></td>
                                  <td bgcolor="#FFFFFF" class="blue_txt"><input name="Other_n" type="text" id="Other_n" size="40" value="<?=$other_no;?>">                                  </td>
                                </tr>



								
								
								 <tr>
                                  <td height="15" bgcolor="#FFFFFF" class="blue_txt"><div align="right"><font color="#990000"><strong><font size="1" face="Verdana, Arial, Helvetica, sans-serif">Email Id  
                                    :</font></strong></font></div></td>
                                  <td bgcolor="#FFFFFF" class="blue_txt"><input name="Email" type="text" id="Email" size="40" value="<?=$email_id;?>">                                  </td>
                                </tr>



								
								
								 <tr>
                                  <td height="15" bgcolor="#FFFFFF" class="blue_txt"><div align="right"><font color="#990000"><strong><font size="1" face="Verdana, Arial, Helvetica, sans-serif">Replicate Site  
                                    :</font></strong></font></div></td>
                                  <td bgcolor="#FFFFFF" class="blue_txt"><input name="Replicate" type="text" id="Replicate" size="40" value="<?=$rep_site;?>">                                  </td>
                                </tr>



								
								
								 <tr>
                                  <td height="15" bgcolor="#FFFFFF" class="blue_txt"><div align="right"><font color="#990000"><strong><font size="1" face="Verdana, Arial, Helvetica, sans-serif">Password 
                                    :</font></strong></font></div></td>
                                  <td bgcolor="#FFFFFF" class="blue_txt"><input name="Password" type="text" id="Password" size="40" value="<?=$pwd;?>">                                  </td>
                                </tr>



								
								
								 <tr>
                                  <td height="15" bgcolor="#FFFFFF" class="blue_txt"><div align="right"><font color="#990000"><strong><font size="1" face="Verdana, Arial, Helvetica, sans-serif">Re-Type Password
                                    :</font></strong></font></div></td>
                                  <td bgcolor="#FFFFFF" class="blue_txt"><input name="rPassword" type="text" id="rPassword" size="40">                                  </td>
                                </tr>

<tr> 
                  <td height="19" colspan="2" bgcolor="#EFEFE7" class="blue_txt"><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong>:: Details Regarding Payment </strong></font></td>
                </tr>

								
								
								 <tr>
                                  <td height="15" bgcolor="#FFFFFF" class="blue_txt"><div align="right"><font color="#990000"><strong><font size="1" face="Verdana, Arial, Helvetica, sans-serif">PAN no.
                                    :</font></strong></font></div></td>
                                  <td bgcolor="#FFFFFF" class="blue_txt"><input name="PAN" type="text" id="PAN" size="40" value="<?=$pan_no;?>">                                  </td>
                                </tr>



								
								
								 <tr>
                                  <td height="15" bgcolor="#FFFFFF" class="blue_txt"><div align="right"><font color="#990000"><strong><font size="1" face="Verdana, Arial, Helvetica, sans-serif">Father/Guardian Name  
                                    :</font></strong></font></div></td>
                                  <td bgcolor="#FFFFFF" class="blue_txt"><input name="Guardian" type="text" id="Guardian" size="40" value="<?=$father_gur_name;?>">                                  </td>
                                </tr>



								
								
								 <tr>
                                  <td height="15" bgcolor="#FFFFFF" class="blue_txt"><div align="right"><font color="#990000"><strong><font size="1" face="Verdana, Arial, Helvetica, sans-serif">Bank name  
                                    :</font></strong></font></div></td>
                                  <td bgcolor="#FFFFFF" class="blue_txt"><input name="bank_name" type="text" id="bank_name" size="40" value="<?=$bank_name;?>">                                  </td>
                                </tr>



								
								
								 



								
								
								



								
								
								 <tr>
                                  <td height="15" bgcolor="#FFFFFF" class="blue_txt"><div align="right"><font color="#990000"><strong><font size="1" face="Verdana, Arial, Helvetica, sans-serif">Bank Account No.  
                                    :</font></strong></font></div></td>
                                  <td bgcolor="#FFFFFF" class="blue_txt"><input name="bk_acc_no" type="text" id="bk_acc_no" size="40" value="<?=$bk_acc_no;?>">                                  </td>
                                </tr>



								
								<!--
								 <tr>
                                  <td height="15" bgcolor="#FFFFFF" class="blue_txt"><div align="right"><font color="#990000"><strong><font size="1" face="Verdana, Arial, Helvetica, sans-serif">MICR No.  
                                    :</font></strong></font></div></td>
                                  <td bgcolor="#FFFFFF" class="blue_txt"><input name="street" type="text" id="street" size="40" value="">                                  </td>
                                </tr>
-->


								
								
								 <tr>
                                  <td height="15" bgcolor="#FFFFFF" class="blue_txt"><div align="right"><font color="#990000"><strong><font size="1" face="Verdana, Arial, Helvetica, sans-serif">Date of Birth  
                                    :</font></strong></font></div></td>
                                  <td bgcolor="#FFFFFF" class="blue_txt"><input name="d_b" type="text" id="d_b" size="40" value="<?=$d_b;?>">                                  </td>
                                </tr>



								
								
								 <tr>
                                  <td height="15" bgcolor="#FFFFFF" class="blue_txt"><div align="right"><font color="#990000"><strong><font size="1" face="Verdana, Arial, Helvetica, sans-serif">Nominee 
                                    :</font></strong></font></div></td>
                                  <td bgcolor="#FFFFFF" class="blue_txt"><input name="Nominee" type="text" id="Nominee" size="40" value="<?=$nominee;?>">                                  </td>
                                </tr>



								
								
								 <tr>
                                  <td height="15" bgcolor="#FFFFFF" class="blue_txt"><div align="right"><font color="#990000"><strong><font size="1" face="Verdana, Arial, Helvetica, sans-serif">Enroleer ID  
                                    :</font></strong></font></div></td>
                                  <td bgcolor="#FFFFFF" class="blue_txt"><input name="Enroleer"  disabled="disabled" type="text" id="Enroller" size="40" value="<?=$enroller_id;?>">                                  </td>
                                </tr>



								
								
								 <tr>
                                  <td height="15" bgcolor="#FFFFFF" class="blue_txt"><div align="right"><font color="#990000"><strong><font size="1" face="Verdana, Arial, Helvetica, sans-serif">Enrolled ID  
                                    :</font></strong></font></div></td>
                                  <td bgcolor="#FFFFFF" class="blue_txt"><input name="Enrolled" disabled="disabled" type="text" id="Enrolled" size="40" value="<?=$enrolled_id;?>">                                  </td>
                                </tr>




                <tr> 
                  <td height="15" bgcolor="#FFFFFF" class="blue_txt">&nbsp;</td>
                  <td height="15" bgcolor="#FFFFFF" class="blue_txt"><input type="submit" name="Submit"  onclick="" value="Update"></td>
                </tr>
              </table>
              </form>
              
           
            </td>
          </tr>
        </table>
        </td>
          </tr>
        </table>

      <? include('footer.php'); ?>
