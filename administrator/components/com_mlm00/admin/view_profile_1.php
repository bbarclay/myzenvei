<?
 session_start();
 include('settings.inc');
 include('header.php');
 $username=$_SESSION['username'];
 $pwd=$_SESSION['pwd'];
 $enrolled_id2=$_GET['enrolled_id'];
$enrolled_id_2=$enrolled_id2;
 $sql="select * from members where enrolled_id_2='".$enrolled_id_2."'";
 $query=mysql_query($sql);
 $result=mysql_fetch_array($query);
 $mem_name=$result['mem_name'];
 $mem_name=str_replace("_"," ",$mem_name);
 $f_name=$result['f_name'];
 $l_name=$result['l_name'];
 $comp_name=$result['comp_name'];
 $address=$result['address'];
 $address_2=$result['address_2'];
 $city=$result['city'];
 $state=$result['state'];	
 $zip_code=$result['zip_code'];
 $country=$result['country'];
 $hm_ph=$result['hm_ph'];
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

//$mem_name2 = $_POST['mem_name'];
//$mem_name2 = ereg_replace("[ \t\n\r]+", "_", $mem_name2);
//$mem_name=str_replace("_"," ",$mem_name);

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
$pawd = $_POST['pawd'];
$pan_no = $_POST['pan_no'];
$father_gur_name = $_POST['father_gur_name'];
//$compname = $_POST['compname'];
$bank_name = $_POST['bank_name'];
$bk_acc_no = $_POST['bk_acc_no'];
$d_b = $_POST['d_b'];
$nominee = $_POST['nominee'];

if(empty($message1))
		{
		$sql1 ="update  members set
		comp_name='".$comp_name."',
		address='".$address."',
		address_2='".$address_2."',
		city='".$city."',
		state='".$state."',
		zip_code='".$zip_code."',
		country='".$country."',
		hm_ph='".$hm_ph."',
		wk_ph='".$wk_ph."',
		fax_no='".$fax_no."',
		cell_no='".$cell_no."',
		pgr_no='".$pgr_no."',
		other_no='".$other_no."',
		email_id='".$email_id."',
		rep_site='".$rep_site."',
		pawd='".$pawd."',
		pan_no='".$pan_no."',
		father_gur_name='".$father_gur_name."',
		bank_name='".$bank_name."',
		bk_acc_no='".$bk_acc_no."',
		d_b='".$d_b."',
		nominee='".$nominee."'";

$result1 = mysql_query($sql1);
				
				//$sql1 ="update  company set companyname='".$compname."',street='".$street."',city='".$city."',state='".$state."',zip='".$zip."',phone='".$phone."',email='".$mail."',password='".$password."' where compid='".$id."'";
				//$result1 = mysql_query($sql1);
				$message="Profile Updated Successfully";
		}
}

?>
<head>       
<link href="style2.css" rel="stylesheet" type="text/css">
</head>
<body bgcolor="#666666" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table width="990" border="0" align="center" cellpadding="0" cellspacing="0">
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
                  <td bgcolor="#FFFFFF" class="blue_txt"><input name="mem_name" disabled type="text" id="mem_name" size="40" value="<?=$mem_name;?>"> 
                    &nbsp;<font color="#000000"><strong><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><? echo $message1[0]; ?></strong></font></td>
                </tr>
								
								
								
								
								 <tr>
                                  <td height="15" bgcolor="#FFFFFF" class="blue_txt"><div align="right"><font color="#990000"><strong><font size="1" face="Verdana, Arial, Helvetica, sans-serif">Company Name  
                                    :</font></strong></font></div></td>
                                  <td bgcolor="#FFFFFF" class="blue_txt"><input name="comp_name" type="text" id="comp_name" size="40" value="<?=$comp_name;?>">                                  </td>
                                </tr>
								
								
								
								 <tr>
                                  <td height="15" bgcolor="#FFFFFF" class="blue_txt"><div align="right"><font color="#990000"><strong><font size="1" face="Verdana, Arial, Helvetica, sans-serif">Billing Address  
                                    :</font></strong></font></div></td>
                                  <td bgcolor="#FFFFFF" class="blue_txt"><input name="address" type="text" id="address" size="40" value="<?=$address;?>">                                  </td>
                                </tr>
								
								<tr>
                                  <td height="15" bgcolor="#FFFFFF" class="blue_txt"><div align="right"><font color="#990000"><strong><font size="1" face="Verdana, Arial, Helvetica, sans-serif">Billing Address two 
                                    :</font></strong></font></div></td>
                                  <td bgcolor="#FFFFFF" class="blue_txt"><input name="address_2" type="text" id="address_2" size="40" value="<?=$address_2;?>">                                  </td>
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
                                  <td bgcolor="#FFFFFF" class="blue_txt"><input name="zip_code" type="text" id="zip_code" size="40" value="<?=$zip_code;?>">                                  </td>
                                </tr>



								
								
								 <tr>
                                  <td height="15" bgcolor="#FFFFFF" class="blue_txt"><div align="right"><font color="#990000"><strong><font color="#990000"><strong><font size="1" face="Verdana, Arial, Helvetica, sans-serif">Billing</font></strong></font><font size="1" face="Verdana, Arial, Helvetica, sans-serif"> Country  
                                    :</font></strong></font></div></td>
                                  <td bgcolor="#FFFFFF" class="blue_txt"><input name="country" type="text" id="country" size="40" value="<?=$country;?>">                                  </td>
                                </tr>



								
								
								 <tr>
                                  <td height="15" bgcolor="#FFFFFF" class="blue_txt"><div align="right"><font color="#990000"><strong><font size="1" face="Verdana, Arial, Helvetica, sans-serif">Home Phone  
                                    :</font></strong></font></div></td>
                                  <td bgcolor="#FFFFFF" class="blue_txt"><input name="hm_ph" type="text" id="hm_ph" size="40" value="<?=$hm_ph;?>">                                  </td>
                                </tr>



								
								
								 <tr>
                                  <td height="15" bgcolor="#FFFFFF" class="blue_txt"><div align="right"><font color="#990000"><strong><font size="1" face="Verdana, Arial, Helvetica, sans-serif">Work Phone  
                                    :</font></strong></font></div></td>
                                  <td bgcolor="#FFFFFF" class="blue_txt"><input name="wk_ph" type="text" id="wk_ph" size="40" value="<?=$wk_ph;?>">                                  </td>
                                </tr>



								
								
								 <tr>
                                  <td height="15" bgcolor="#FFFFFF" class="blue_txt"><div align="right"><font color="#990000"><strong><font size="1" face="Verdana, Arial, Helvetica, sans-serif">Fax No.  
                                    :</font></strong></font></div></td>
                                  <td bgcolor="#FFFFFF" class="blue_txt"><input name="fax_no" type="text" id="fax_no" size="40" value="<?=$fax_no;?>">                                  </td>
                                </tr>



								
								
								 <tr>
                                  <td height="15" bgcolor="#FFFFFF" class="blue_txt"><div align="right"><font color="#990000"><strong><font size="1" face="Verdana, Arial, Helvetica, sans-serif">Mobile No.  
                                    :</font></strong></font></div></td>
                                  <td bgcolor="#FFFFFF" class="blue_txt"><input name="cell_no" type="text" id="cell_no" size="40" value="<?=$cell_no;?>">                                  </td>
                                </tr>



								
								
								 <tr>
                                  <td height="15" bgcolor="#FFFFFF" class="blue_txt"><div align="right"><font color="#990000"><strong><font size="1" face="Verdana, Arial, Helvetica, sans-serif">Pager No.  
                                    :</font></strong></font></div></td>
                                  <td bgcolor="#FFFFFF" class="blue_txt"><input name="pgr_no" type="text" id="pgr_no" size="40" value="<?=$pgr_no;?>">                                  </td>
                                </tr>
								
								<tr>
                                  <td height="15" bgcolor="#FFFFFF" class="blue_txt"><div align="right"><font color="#990000"><strong><font size="1" face="Verdana, Arial, Helvetica, sans-serif">Other No.  
                                    :</font></strong></font></div></td>
                                  <td bgcolor="#FFFFFF" class="blue_txt"><input name="other_no" type="text" id="other_no" size="40" value="<?=$other_no;?>">                                  </td>
                                </tr>



								
								
								 <tr>
                                  <td height="15" bgcolor="#FFFFFF" class="blue_txt"><div align="right"><font color="#990000"><strong><font size="1" face="Verdana, Arial, Helvetica, sans-serif">Email Id  
                                    :</font></strong></font></div></td>
                                  <td bgcolor="#FFFFFF" class="blue_txt"><input name="email_id" type="text" id="email_id" size="40" value="<?=$email_id;?>">                                  </td>
                                </tr>



								
								
								 <tr>
                                  <td height="15" bgcolor="#FFFFFF" class="blue_txt"><div align="right"><font color="#990000"><strong><font size="1" face="Verdana, Arial, Helvetica, sans-serif">Replicate Site  
                                    :</font></strong></font></div></td>
                                  <td bgcolor="#FFFFFF" class="blue_txt"><input name="rep_site" type="text" id="rep_site" size="40" value="<?=$rep_site;?>">                                  </td>
                                </tr>



								
								
								 <tr>
                                  <td height="15" bgcolor="#FFFFFF" class="blue_txt"><div align="right"><font color="#990000"><strong><font size="1" face="Verdana, Arial, Helvetica, sans-serif">Password 
                                    :</font></strong></font></div></td>
                                  <td bgcolor="#FFFFFF" class="blue_txt"><input name="pawd" type="text" id="pawd" size="40" value="<?=$pawd;?>">                                  </td>
                                </tr>

<tr> 
                  <td height="19" colspan="2" bgcolor="#EFEFE7" class="blue_txt"><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong>:: Details Regarding Payment </strong></font></td>
                </tr>

								
								
								 <tr>
                                  <td height="15" bgcolor="#FFFFFF" class="blue_txt"><div align="right"><font color="#990000"><strong><font size="1" face="Verdana, Arial, Helvetica, sans-serif">PAN no.
                                    :</font></strong></font></div></td>
                                  <td bgcolor="#FFFFFF" class="blue_txt"><input name="pan_no" type="text" id="pan_no" size="40" value="<?=$pan_no;?>">                                  </td>
                                </tr>



								
								
								 <tr>
                                  <td height="15" bgcolor="#FFFFFF" class="blue_txt"><div align="right"><font color="#990000"><strong><font size="1" face="Verdana, Arial, Helvetica, sans-serif">Father/Guardian Name  
                                    :</font></strong></font></div></td>
                                  <td bgcolor="#FFFFFF" class="blue_txt"><input name="father_gur_name" type="text" id="father_gur_name" size="40" value="<?=$father_gur_name;?>">                                  </td>
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
                                  <td bgcolor="#FFFFFF" class="blue_txt"><input name="nominee" type="text" id="nominee" size="40" value="<?=$nominee;?>">                                  </td>
                                </tr>



								
								
								 <tr>
                                  <td height="15" bgcolor="#FFFFFF" class="blue_txt"><div align="right"><font color="#990000"><strong><font size="1" face="Verdana, Arial, Helvetica, sans-serif">Enroleer ID  
                                    :</font></strong></font></div></td>
                                  <td bgcolor="#FFFFFF" class="blue_txt"><input name="enroller_id"  disabled="disabled" type="text" id="enroller_id" size="40" value="<?=$enroller_id;?>">                                  </td>
                                </tr>



								
								
								 <tr>
                                  <td height="15" bgcolor="#FFFFFF" class="blue_txt"><div align="right"><font color="#990000"><strong><font size="1" face="Verdana, Arial, Helvetica, sans-serif">Enrolled ID  
                                    :</font></strong></font></div></td>
                                  <td bgcolor="#FFFFFF" class="blue_txt"><input name="enrolled_id" disabled="disabled" type="text" id="Enrolled" size="40" value="<?=$enrolled_id;?>">                                  </td>
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
