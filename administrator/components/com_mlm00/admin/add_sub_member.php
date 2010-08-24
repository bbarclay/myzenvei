<?php
 $username=$_SESSION['username'];
 $pwd=$_SESSION['pwd']; $enrolled_id=$_SESSION['enrolled_id'];
 $sql="select * from members where username='".$username."' and pwd='".$pwd."'";
 $query=mysql_query($sql);
 $result=mysql_fetch_array($query);
 $mem_name=$result['mem_name'];
 $enrolled_id=$result['enrolled_id'];
 $enroller_id=$result['enroller_id'];
 //$direct=$result['direction'];
 

if( $_POST)
{

if(trim($_POST['mem_name'])==''){
				$message1[0] = "Member Name Required";
			}

if(trim($_POST['address'])==''){
				$message1[1] = "Address Required";
			}

if(trim($_POST['city'])==''){
				$message1[2] = "City Name Required";
			}

if(trim($_POST['state'])==''){
				$message1[3] = "State Name Required";
			}

if(trim($_POST['zip_code'])==''){
				$message1[4] = "Zipcode Required";
			}

if(trim($_POST['hm_ph'])==''){
				$message1[5] = "Phone is Required";
			}

if(trim($_POST['email_id'])==''){
				$message1[6] = "Email ID is Required";
			}

if(trim($_POST['pwd'])==''){
				$message1[7] = "Password is Required";
			}

if(trim($_POST['username'])==''){
				$message1[8] = "Username Required";
			}

if(trim($_POST['pan_no'])==''){
				$message1[9] = "PAN No Required";
			}

//if(trim($_POST['nominee'])==''){
				//$message1[10] = "Nominee Name Required";
			//}

if(trim($_POST['enroller_un_id'])==''){
				$message1[11] = "Enrolling Under Whos ID is  Required";
			}

if(trim($_POST['direction'])==''){
				$message1[12] = "Enrolling Direction Required";
			}



$mem_name = $_POST['mem_name'];
$jn_dt = $_POST['jn_dt'];
//$l_name = $_POST['l_name'];
$address = $_POST['address'];
$city = $_POST['city'];
$state = $_POST['state'];
$zip_code = $_POST['zip_code'];
$country = $_POST['country'];
$hm_ph = $_POST['hm_ph'];
$email_id = $_POST['email_id'];
$pwd = $_POST['pwd'];
$username = $_POST['username'];
$pan_no = $_POST['pan_no'];
//$nominee = $_POST['nominee'];
$enroller_un_id = $_POST['enroller_un_id'];
$direction = $_POST['direction'];
$enrolled_id=$result['enrolled_id'];
$enroller_id2=$result['enroller_id'];
$real_enroller_id=$result['real_enroller_id'];


if(empty($message1))
		{
				
				if(left)
				$sql ="insert into members (mem_name,jn_dt,address,city,state,zip_code,country,hm_ph,email_id,pwd,username,pan_no,nominee,enroller_un_id,direction,enrolled_id,enroller_id,real_enroller_id)
				
				values('".$mem_name."',
				'".$jn_dt."',
				'".$address."',
				'".$city."',
				'".$state."',
				'".$zip_code."',
				'".$country."',
				'".$hm_ph."',
				'".$email_id."',
				'".$pwd."',
				'".$username."',
				'".$pan_no."',
				'".$nominee."',
				'".$enroller_un_id."',
				'".$direction."',
				'".$enrolled_id."','".real_enroller_id."',
				'".$enroller_id."')";
				$result = mysql_query($sql);
				
					
				$sql1="create table ".$mem_name."(cycle_id varchar(25) NOT NULL DEFAULT 1,binary_rank varchar(25) NOT NULL DEFAULT 1,left varchar(25) NOT NULL DEFAULT 1,right varchar(25) NOT NULL DEFAULT 1,volume varchar(255) NOT NULL DEFAULT 1,enroller_id varchar(25) NOT NULL DEFAULT 1,enrolled_id varchar(25) NOT NULL DEFAULT 1,UNIQUE KEY left (left),UNIQUE KEY right (right)";
				
							$query=mysql_query($sql1);
				
				
				$pql="insert into ".$mem_name."(cycle_id,binary_rank,left,right,volume,enroller_id,enrolled_id)
				values('".$cycle_id."','".$cycle_id."','".$cycle_id."','".$left."','".$right."','".$volume."','".$enroller_id."','".$enrolled_id."')";
				
							$query1=mysql_query($pql);
				
				$pql1="insert into earnings(date,check_no,check_dt,amount,enroller_id,enroller_id)
				
				values('".$date."','".$check_no."','".$check_dt."','".$amount."','".$enroller_id."','".$enrolled_id."')";
				
							$result1=mysql_query($pql1);
							
				$eql="insert into gene_logy(level,mem_name,volume,jn_dt,enroller_id,enroller_id)
				
				values('".$level."','".$mem_name."','".$volume."','".$jn_dt."','".$enroller_id."','".$enrolled_id."')";
				
							$gesult1=mysql_query($eq);
				
				header('location:view_geneology.php');
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
                    &nbsp;New Sub Member Details </strong></font></td>
                </tr>
                <tr> 
                  <td height="15" colspan="2" bgcolor="#FFFFFF" class="blue_txt"><div align="justify"><font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 
                      The following information is Available - </font></div></td>
                </tr>
                <tr> 
                  <td width="24%" height="15" bgcolor="#FFFFFF" class="blue_txt"><div align="right"><font color="#990000"><strong><font size="1" face="Verdana, Arial, Helvetica, sans-serif">Members  
                      Name :</font></strong></font></div></td>
                  <td bgcolor="#FFFFFF" class="blue_txt"><input name="mem_name" type="text" id="mem_name" size="40"> 
                    &nbsp;<font color="#000000"><strong><font size="1" face="Verdana, Arial, Helvetica, sans-serif">
					<? echo $message1[0]; ?></strong></font></td>
                </tr>
                               
							   <!--
							    <tr>
                                  <td height="15" bgcolor="#FFFFFF" class="blue_txt"><div align="right"><font color="#990000"><strong><font size="1" face="Verdana, Arial, Helvetica, sans-serif">First Name  
                                    :</font></strong></font></div></td>
                                  <td bgcolor="#FFFFFF" class="blue_txt"><input name="fname" type="text" id="fname" size="40">
&nbsp;<font color="#000000"><strong><font size="1" face="Verdana, Arial, Helvetica, sans-serif"> <?// echo $message1[0]; ?></strong></font> </td>
                                </tr>
								
								
								
								 <tr>
                                  <td height="15" bgcolor="#FFFFFF" class="blue_txt"><div align="right"><font color="#990000"><strong><font size="1" face="Verdana, Arial, Helvetica, sans-serif">Last Name  
                                    :</font></strong></font></div></td>
                                  <td bgcolor="#FFFFFF" class="blue_txt"><input name="lname" type="text" id="lname" size="40">
&nbsp;<font color="#000000"><strong><font size="1" face="Verdana, Arial, Helvetica, sans-serif"> <?// echo $message1[0]; ?></strong></font> </td>
                                </tr>
								
								-->
								
								 <tr>
                                  <td height="15" bgcolor="#FFFFFF" class="blue_txt"><div align="right"><font color="#990000"><strong><font size="1" face="Verdana, Arial, Helvetica, sans-serif">Join Date  
                                    :</font></strong></font></div></td>
                                  <td bgcolor="#FFFFFF" class="blue_txt"><input name="jn_dt" type="text" id="jn_dt" size="40">
&nbsp;<font color="#000000"><strong><font size="1" face="Verdana, Arial, Helvetica, sans-serif"></strong></font></td>
                                </tr>
								
								<tr>
                                  <td height="15" bgcolor="#FFFFFF" class="blue_txt"><div align="right"><font color="#990000"><strong><font size="1" face="Verdana, Arial, Helvetica, sans-serif">Billing Address  
                                    :</font></strong></font></div></td>
                                  <td bgcolor="#FFFFFF" class="blue_txt"><input name="address" type="text" id="address" size="40">
&nbsp;<font color="#000000"><strong><font size="1" face="Verdana, Arial, Helvetica, sans-serif"> <? echo $message1[1]; ?></strong></font></td>
                                </tr>
								
								
								 <tr>
                                  <td height="15" bgcolor="#FFFFFF" class="blue_txt"><div align="right"><font color="#990000"><strong><font color="#990000"><strong><font size="1" face="Verdana, Arial, Helvetica, sans-serif">Billing</font></strong></font><font size="1" face="Verdana, Arial, Helvetica, sans-serif"> City  
                                    :</font></strong></font></div></td>
                                  <td bgcolor="#FFFFFF" class="blue_txt"><input name="city" type="text" id="city" size="40">
&nbsp;<font color="#000000"><strong><font size="1" face="Verdana, Arial, Helvetica, sans-serif"> <? echo $message1[2]; ?></strong></font> </td>
                                </tr>



								
								
								 <tr>
                                  <td height="15" bgcolor="#FFFFFF" class="blue_txt"><div align="right"><font color="#990000"><strong><font color="#990000"><strong><font size="1" face="Verdana, Arial, Helvetica, sans-serif">Billing</font></strong></font><font size="1" face="Verdana, Arial, Helvetica, sans-serif"> State  
                                    :</font></strong></font></div></td>
                                  <td bgcolor="#FFFFFF" class="blue_txt"><input name="state" type="text" id="state" size="40">
&nbsp;<font color="#000000"><strong><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong><? echo $message1[3]; ?></strong></font></td>
                                </tr>



								
								
								 <tr>
                                  <td height="15" bgcolor="#FFFFFF" class="blue_txt"><div align="right"><font color="#990000"><strong><font color="#990000"><strong><font size="1" face="Verdana, Arial, Helvetica, sans-serif">Billing</font></strong></font><font size="1" face="Verdana, Arial, Helvetica, sans-serif"> ZipCode  
                                    :</font></strong></font></div></td>
                                  <td bgcolor="#FFFFFF" class="blue_txt"><input name="zip_code" type="text" id="zip_code" size="40">
&nbsp;<font color="#000000"><strong><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><? echo $message1[4]; ?></strong></font> </td>
                                </tr>



								
								
								 <tr>
                                  <td height="15" bgcolor="#FFFFFF" class="blue_txt"><div align="right"><font color="#990000"><strong><font color="#990000"><strong><font size="1" face="Verdana, Arial, Helvetica, sans-serif">Billing</font></strong></font><font size="1" face="Verdana, Arial, Helvetica, sans-serif"> Country  
                                    :</font></strong></font></div></td>
                                  <td bgcolor="#FFFFFF" class="blue_txt"><input name="country" type="text" id="country" size="40">
&nbsp;<font color="#000000"><strong><font size="1" face="Verdana, Arial, Helvetica, sans-serif"></strong></font> </td>
                                </tr>



								
								
								 <tr>
                                  <td height="15" bgcolor="#FFFFFF" class="blue_txt"><div align="right"><font color="#990000"><strong><font size="1" face="Verdana, Arial, Helvetica, sans-serif">Home Phone  
                                    :</font></strong></font></div></td>
                                  <td bgcolor="#FFFFFF" class="blue_txt"><input name="hm_ph" type="text" id="hm_ph" size="40">
&nbsp;<font color="#000000"><strong><font size="1" face="Verdana, Arial, Helvetica, sans-serif"></strong></font> </td>
                                </tr>



								
								
								 <tr>
                                  <td height="15" bgcolor="#FFFFFF" class="blue_txt"><div align="right"><font color="#990000"><strong><font size="1" face="Verdana, Arial, Helvetica, sans-serif">Email Id  
                                    :</font></strong></font></div></td>
                                  <td bgcolor="#FFFFFF" class="blue_txt"><input name="email_id" type="text" id="email_id" size="40">
&nbsp;<font color="#000000"><strong><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong><? echo $message1[6]; ?></strong></font></td>
                                </tr>
<tr>
                                  <td height="15" bgcolor="#FFFFFF" class="blue_txt"><div align="right"><font color="#990000"><strong><font size="1" face="Verdana, Arial, Helvetica, sans-serif">PAN No.  
                                    :</font></strong></font></div></td>
                                  <td bgcolor="#FFFFFF" class="blue_txt"><input name="pan_no" type="text" id="pan_no" size="40">
&nbsp;<font color="#000000"><strong><font size="1" face="Verdana, Arial, Helvetica, sans-serif"> <? echo $message1[9]; ?></strong></font> </td>
                                </tr>


								
								
								 <tr>
                                  <td height="15" bgcolor="#FFFFFF" class="blue_txt"><div align="right"><font color="#990000"><strong><font size="1" face="Verdana, Arial, Helvetica, sans-serif">Username :</font></strong></font></div></td>
                                  <td bgcolor="#FFFFFF" class="blue_txt"><input name="username" type="text" id="username" size="40" value="">
&nbsp;<font color="#000000"><strong><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><? echo $message1[8]; ?></strong></font> </td>
                                </tr>



								
								
								 <tr>
                                  <td height="15" bgcolor="#FFFFFF" class="blue_txt"><div align="right"><font color="#990000"><strong><font size="1" face="Verdana, Arial, Helvetica, sans-serif">Password 
                                    :</font></strong></font></div></td>
                                  <td bgcolor="#FFFFFF" class="blue_txt"><input name="pwd" type="text" id="pwd" size="40" value="">
&nbsp;<font color="#000000"><strong><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong><? echo $message1[7]; ?></strong></font></td>
                                </tr>

<tr> 
                  <td height="19" colspan="2" bgcolor="#EFEFE7" class="blue_txt"><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong>:: Other Details (Auto Insertion) </strong></font></td>
                </tr>



								
								<!--
								 <tr>
                                  <td height="15" bgcolor="#FFFFFF" class="blue_txt"><div align="right"><font color="#990000"><strong><font size="1" face="Verdana, Arial, Helvetica, sans-serif">MICR No.  
                                    :</font></strong></font></div></td>
                                  <td bgcolor="#FFFFFF" class="blue_txt"><input name="street" type="text" id="street" size="40" value="">                                  </td>
                                </tr>
-->



								
								
								 <tr>
                                   <td height="15" bgcolor="#FFFFFF" class="blue_txt"><div align="right"><font color="#990000"><strong><font size="1" face="Verdana, Arial, Helvetica, sans-serif">Enroleed Under ID  
                                     :</font></strong></font></div></td>
								   <td bgcolor="#FFFFFF" class="blue_txt"><input name="enroller_un_id" type="text" id="enroller_un_id" size="40" value="">
                    &nbsp;<font color="#000000"><strong><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><? echo $message1[11]; ?></strong></font></td>
			    </tr>
				 <tr>
                                   <td height="15" bgcolor="#FFFFFF" class="blue_txt"><div align="right"><font color="#990000"><strong><font size="1" face="Verdana, Arial, Helvetica, sans-serif">Direction  
                                     :</font></strong></font></div></td>
				   <td bgcolor="#FFFFFF" class="blue_txt">
								   
								   <select name="direction">
								   <option value="" selected="selected">SELECT...</option>
								   <option value="left">LEFT</option>
								   <option value="right">RIGHT</option>
								   </select>
&nbsp; <font color="#000000"><strong><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<? echo $message1[12]; ?></strong></font></td>
			    </tr>
				 <tr>
                                   <td height="15" bgcolor="#FFFFFF" class="blue_txt"><div align="right"><font color="#990000"><strong><font size="1" face="Verdana, Arial, Helvetica, sans-serif">Enroleer ID  
                                     :</font></strong></font></div></td>
								   <td bgcolor="#FFFFFF" class="blue_txt"><input name="enroller_id"  disabled="disabled" type="text" id="enroller_id" size="40" value="<?=$enroller_id;?>">
                                   </td>
			    </tr>



								
								
								 <tr>
                                  <td height="15" bgcolor="#FFFFFF" class="blue_txt"><div align="right"><font color="#990000"><strong><font size="1" face="Verdana, Arial, Helvetica, sans-serif">Enrolled ID  
                                    :</font></strong></font></div></td>
                                  <td bgcolor="#FFFFFF" class="blue_txt">
								   <? 
				  $sql3="SELECT enroller_id FROM members ORDER BY enroller_id DESC LIMIT 1";
				 // $sql="select * from members where username='".$user."' and password='".$pass."'";
 $query=mysql_query($sql);
 $result=mysql_fetch_array($query);
// $mem_name=$result['mem_name'];
 //$enrolled_id=$result['enrolled_id'];
$real_enroller_id=$result['real_enroller_id'];
$string2 = "6";
$stringnw = $enroller_id+$string2;
$string7 = "e707e";
$enroller_id2 = $enroller_id2.$stringnw;
$real_enroller_id = trim($enroller_id2, "e707e");		
				  ?>
								  
								  
								  
								  
								  <input name="enroller_id2" disabled="disabled" type="text" id="Enrolled" size="40" value="<?=$enrolled_id2;?>"> 
								  <input name="real_enroller_id" type="hidden" id="real_enroller_id" size="40" value="<?=$real_enroller_id;?>"> 
								                                   </td>
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
