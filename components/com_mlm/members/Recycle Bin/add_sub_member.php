<?php
 $username=$_SESSION['username'];
 $pwd=$_SESSION['pwd'];
 $enrolled_id=$_SESSION['enrolled_id'];
 $sql="select * from members where username='".$username."' and pwd='".$pwd."'";
 $query=mysql_query($sql);
 $result=mysql_fetch_array($query);
 $mem_name=$result['mem_name'];
 $enrolled_id=$result['enrolled_id'];
 $enroller_id=$result['enroller_id'];
 
 //$direct=$result['direction'];
 

if( $_POST)
{

if(trim($_POST['mem_name2'])==''){
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

if(trim($_POST['pawd'])==''){
				$message1[7] = "Password is Required";
			}

//if(trim($_POST['username2'])==''){
		//		$message1[8] = "Username Required";
		//	}
//
if(trim($_POST['pan_no'])==''){
				$message1[9] = "PAN No Required";
			}

//if(trim($_POST['nominee'])==''){
				//$message1[10] = "Nominee Name Required";
			//}

if(trim($_POST['enroller_id_n'])==''){
				$message1[11] = "Enrolling Under Whos ID is  Required";
			}

if(trim($_POST['direction'])==''){
				$message1[12] = "Enrolling Direction Required";
			}



$mem_name2 = $_POST['mem_name2'];
$mem_name2 = ereg_replace("[ \t\n\r]+", "_", $mem_name2);
$jn_dt = $_POST['jn_dt'];
//$l_name = $_POST['l_name'];
$address = $_POST['address'];
$city = $_POST['city'];
$state = $_POST['state'];
$zip_code = $_POST['zip_code'];
$country = $_POST['country'];
$hm_ph = $_POST['hm_ph'];
$email_id = $_POST['email_id'];
$pawd = $_POST['pawd'];
$username2 = $_POST['username2'];
$pan_no = $_POST['pan_no'];
//$nominee = $_POST['nominee'];
$direction = $_POST['direction'];

$enroller_id_n = $_POST['enroller_id_n'];
$enrolled_id_n=$_POST['enrolled_id_n'];
//$enroller_id=$result['enroller_id'];




//$real_enrolled_id_n=str_replace("L","",$enrolled_id_n);
//$real_enroller_id_n=$_POST['real_enroller_id_n'];



//echo $enroller_id_n;
if(empty($message1))
		{
//echo $mem_name;						
			
//if($username==$username2)			
			
			
			
	/////     checking left node and right node of tree   ///////
			
	$query="select * from personally_enrolled where enroller_id='".$enroller_id_n."'";
	$result = mysql_query($query);
	$results=mysql_fetch_array($result);
	//$mem_name=$results['mem_name'];
	//$enrolled_id=$results['enrolled_id'];
	$enroller_id3=$results['enroller_id'];
	$left_mem=$results['left_mem'];
	$right_mem=$results['right_mem'];
	$test="left_mem";
	$test2="right_mem";
	$direc=$direction;
//$left_mem2="left_mem";
//$right_mem2="right_mem";
//echo $mem_name;
	
	
	
	
//// checking if all feilds are null
if($left_mem!=$test && $right_mem!=$test2 && $enroller_id3!=enroller_id_n && $direc==$test)
{


$sql = "insert into personally_enrolled (enroller_id,left_mem )
values('".$enroller_id_n."','".$test."')";
					
mysql_query($sql);
$sql = "insert into members (mem_name,jn_dt,address,city,state,zip_code,country,hm_ph,email_id,pwd,username,pan_no,nominee,direction,enrolled_id,enroller_id)
				
				values('".$mem_name2."',
				'".$jn_dt."',
				'".$address."',
				'".$city."',
				'".$state."',
				'".$zip_code."',
				'".$country."',
				'".$hm_ph."',
				'".$email_id."',
				'".$pawd."',
				'".$username2."',
				'".$pan_no."',
				'".$nominee."',
				'".$direction."',
				'".$enrolled_id_n."',
				'".$enroller_id_n."')";
				$result = mysql_query($sql)or die(mysql_error());
				
				
				
				$sql1="create table ".$mem_name2."(cycle_id varchar(25) NOT NULL DEFAULT 1,id int(25)NOT NULL AUTO_INCREMENT,
				id2 int(25)NOT NULL DEFAULT 0,binary_rank varchar(25) NOT NULL DEFAULT 1,left_id varchar(25) NOT NULL DEFAULT 1,right_id varchar(25) NOT NULL DEFAULT 1,volume_id varchar(255) NOT NULL DEFAULT 1,enroller_id varchar(25) NOT NULL DEFAULT 1,enrolled_id varchar(25) NOT NULL DEFAULT 1,UNIQUE KEY left_id (left_id),UNIQUE KEY id (id),UNIQUE KEY right_id (right_id))";
				
				$query=mysql_query($sql1)or die(mysql_error());
$message = "Left node added Succesfully to the enroller you specified";

}
else
//////////////////////////////////////////////////////////////////////
{
if($left_mem!=$test && $right_mem!=$test2 && $enroller_id3==enroller_id_n && $direc==$test)
{


$sql = "Update personally_enrolled set
left_mem='".$test."' where enroller_id='".$enroller_id_n."'";
mysql_query($sql);
$message = "Left node added Succesfully to the enroller you specified2";
$sql = "insert into members (mem_name,jn_dt,address,city,state,zip_code,country,hm_ph,email_id,pwd,username,pan_no,nominee,direction,enrolled_id,enroller_id)
				
				values('".$mem_name2."',
				'".$jn_dt."',
				'".$address."',
				'".$city."',
				'".$state."',
				'".$zip_code."',
				'".$country."',
				'".$hm_ph."',
				'".$email_id."',
				'".$pawd."',
				'".$username2."',
				'".$pan_no."',
				'".$nominee."',
				'".$direction."',
				'".$enrolled_id_n."',
				'".$enroller_id_n."')";
				$result = mysql_query($sql)or die(mysql_error());
				
				
				
				$sql1="create table ".$mem_name2."(cycle_id varchar(25) NOT NULL DEFAULT 1,id int(25)NOT NULL AUTO_INCREMENT,
				id2 int(25)NOT NULL DEFAULT 0,binary_rank varchar(25) NOT NULL DEFAULT 1,left_id varchar(25) NOT NULL DEFAULT 1,right_id varchar(25) NOT NULL DEFAULT 1,volume_id varchar(255) NOT NULL DEFAULT 1,enroller_id varchar(25) NOT NULL DEFAULT 1,enrolled_id varchar(25) NOT NULL DEFAULT 1,UNIQUE KEY left_id (left_id),UNIQUE KEY id (id),UNIQUE KEY right_id (right_id))";
				
				$query=mysql_query($sql1)or die(mysql_error());
}
else
{
////////////////////////////////////////////////////////////////////////////////
if($left_mem!=$test && $right_mem!=$test2 && $enroller_id3!=enroller_id_n && $direc==$test2)
{


$sql = "insert into personally_enrolled (enroller_id,right_mem )
values('".$enroller_id_n."','".$test2."')";
					
mysql_query($sql);
$message = "Right node added Succesfully to the eenroller you specified";
$sql = "insert into members (mem_name,jn_dt,address,city,state,zip_code,country,hm_ph,email_id,pwd,username,pan_no,nominee,direction,enrolled_id,enroller_id)
				
				values('".$mem_name2."',
				'".$jn_dt."',
				'".$address."',
				'".$city."',
				'".$state."',
				'".$zip_code."',
				'".$country."',
				'".$hm_ph."',
				'".$email_id."',
				'".$pawd."',
				'".$username2."',
				'".$pan_no."',
				'".$nominee."',
				'".$direction."',
				'".$enrolled_id_n."',
				'".$enroller_id_n."')";
				$result = mysql_query($sql)or die(mysql_error());
				
				
				
				$sql1="create table ".$mem_name2."(cycle_id varchar(25) NOT NULL DEFAULT 1,id int(25)NOT NULL AUTO_INCREMENT,
				id2 int(25)NOT NULL DEFAULT 0,binary_rank varchar(25) NOT NULL DEFAULT 1,left_id varchar(25) NOT NULL DEFAULT 1,right_id varchar(25) NOT NULL DEFAULT 1,volume_id varchar(255) NOT NULL DEFAULT 1,enroller_id varchar(25) NOT NULL DEFAULT 1,enrolled_id varchar(25) NOT NULL DEFAULT 1,UNIQUE KEY left_id (left_id),UNIQUE KEY id (id),UNIQUE KEY right_id (right_id))";
				
				$query=mysql_query($sql1)or die(mysql_error());
}
else
//////////////////////////////////////////////////////////////////////
{
if($left_mem!=$test && $right_mem!=$test2 && $enroller_id3==enroller_id_n && $direc==$test2)
{


$sql = "Update personally_enrolled set
left_mem='".$test."' where enroller_id='".$enroller_id_n."'";
mysql_query($sql);
$message = "Left node added Succesfully to the eenroller you specified";
$sql = "insert into members (mem_name,jn_dt,address,city,state,zip_code,country,hm_ph,email_id,pwd,username,pan_no,nominee,direction,enrolled_id,enroller_id)
				
				values('".$mem_name2."',
				'".$jn_dt."',
				'".$address."',
				'".$city."',
				'".$state."',
				'".$zip_code."',
				'".$country."',
				'".$hm_ph."',
				'".$email_id."',
				'".$pawd."',
				'".$username2."',
				'".$pan_no."',
				'".$nominee."',
				'".$direction."',
				'".$enrolled_id_n."',
				'".$enroller_id_n."')";
				$result = mysql_query($sql)or die(mysql_error());
				
				
				
				$sql1="create table ".$mem_name2."(cycle_id varchar(25) NOT NULL DEFAULT 1,id int(25)NOT NULL AUTO_INCREMENT,
				id2 int(25)NOT NULL DEFAULT 0,binary_rank varchar(25) NOT NULL DEFAULT 1,left_id varchar(25) NOT NULL DEFAULT 1,right_id varchar(25) NOT NULL DEFAULT 1,volume_id varchar(255) NOT NULL DEFAULT 1,enroller_id varchar(25) NOT NULL DEFAULT 1,enrolled_id varchar(25) NOT NULL DEFAULT 1,UNIQUE KEY left_id (left_id),UNIQUE KEY id (id),UNIQUE KEY right_id (right_id))";
				
				$query=mysql_query($sql1)or die(mysql_error());
}

///////////////////////////////////////////////////////
else
{
if($left_mem!=$test && $right_mem==$test2 && $direc==$test)
{


$sql = "Update personally_enrolled set left_mem='".$leftmem."' enroller_id='".$enroller_id_n."'";
					
mysql_query($sql);
$message = "Left node added Succesfully to the eenroller you specified";
$sql = "insert into members (mem_name,jn_dt,address,city,state,zip_code,country,hm_ph,email_id,pwd,username,pan_no,nominee,direction,enrolled_id,enroller_id)
				
				values('".$mem_name2."',
				'".$jn_dt."',
				'".$address."',
				'".$city."',
				'".$state."',
				'".$zip_code."',
				'".$country."',
				'".$hm_ph."',
				'".$email_id."',
				'".$pawd."',
				'".$username2."',
				'".$pan_no."',
				'".$nominee."',
				'".$direction."',
				'".$enrolled_id_n."',
				'".$enroller_id_n."')";
				$result = mysql_query($sql)or die(mysql_error());
				
				
				
				$sql1="create table ".$mem_name2."(cycle_id varchar(25) NOT NULL DEFAULT 1,id int(25)NOT NULL AUTO_INCREMENT,
				id2 int(25)NOT NULL DEFAULT 0,binary_rank varchar(25) NOT NULL DEFAULT 1,left_id varchar(25) NOT NULL DEFAULT 1,right_id varchar(25) NOT NULL DEFAULT 1,volume_id varchar(255) NOT NULL DEFAULT 1,enroller_id varchar(25) NOT NULL DEFAULT 1,enrolled_id varchar(25) NOT NULL DEFAULT 1,UNIQUE KEY left_id (left_id),UNIQUE KEY id (id),UNIQUE KEY right_id (right_id))";
				
				$query=mysql_query($sql1)or die(mysql_error());
}
else

{
if($left_mem==$test && $right_mem!=$test2 && $direc==$test2)
{


$sql = "Update personally_enrolled set
right_mem='".$test2."' where enroller_id='".$enroller_id_n."'";
mysql_query($sql);
$message = "Right node added Succesfully to the eenroller you specified";
$sql = "insert into members (mem_name,jn_dt,address,city,state,zip_code,country,hm_ph,email_id,pwd,username,pan_no,nominee,direction,enrolled_id,enroller_id)
				
				values('".$mem_name2."',
				'".$jn_dt."',
				'".$address."',
				'".$city."',
				'".$state."',
				'".$zip_code."',
				'".$country."',
				'".$hm_ph."',
				'".$email_id."',
				'".$pawd."',
				'".$username2."',
				'".$pan_no."',
				'".$nominee."',
				'".$direction."',
				'".$enrolled_id_n."',
				'".$enroller_id_n."')";
				$result = mysql_query($sql)or die(mysql_error());
				
				
				
				$sql1="create table ".$mem_name2."(cycle_id varchar(25) NOT NULL DEFAULT 1,id int(25)NOT NULL AUTO_INCREMENT,
				id2 int(25)NOT NULL DEFAULT 0,binary_rank varchar(25) NOT NULL DEFAULT 1,left_id varchar(25) NOT NULL DEFAULT 1,right_id varchar(25) NOT NULL DEFAULT 1,volume_id varchar(255) NOT NULL DEFAULT 1,enroller_id varchar(25) NOT NULL DEFAULT 1,enrolled_id varchar(25) NOT NULL DEFAULT 1,UNIQUE KEY left_id (left_id),UNIQUE KEY id (id),UNIQUE KEY right_id (right_id))";
				
				$query=mysql_query($sql1)or die(mysql_error());
}
else
/////////////////////////
{
if($left_mem==$test && $right_mem==$test2)
{

$message = "Sorry Right/Left nodes are not available for the enroller you specified";

}
else
{
$message = "query failed";

}



}
}	
	}
}
	


		}	
		
		
		}
	
	
	
	
	
	
	
					}
		
		//header('location:view_personally_enrolled.php?enrolled_id='.$enrolled_id.'');
	
				
		}

?>
<head>       
<link href="style2.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
.style1 {
	color: #990066;
	font-weight: bold;
}
-->
</style>
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
                  <td bgcolor="#FFFFFF" class="blue_txt"><input name="mem_name2" type="text" id="mem_name2" size="40"> 
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
&nbsp;<font color="#000000"><strong><font size="1" face="Verdana, Arial, Helvetica, sans-serif">(Please
write in<span class="style1"> yyyy-mm-dd</span> formate)</strong></font></td>
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
&nbsp;<font color="#000000"><strong><font size="1" face="Verdana, Arial, Helvetica, sans-serif">(If
not having PAN no then simply type N/A) <br>
<? echo $message1[9]; ?></strong></font> </td>
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
                                   <td height="15" bgcolor="#FFFFFF" class="blue_txt"><div align="right"><font color="#990000"><strong><font size="1" face="Verdana, Arial, Helvetica, sans-serif">Direction  
                                     :</font></strong></font></div></td>
				   <td bgcolor="#FFFFFF" class="blue_txt">
								   
								   <select name="direction">
								   <option value="" selected="selected">SELECT...</option>
								   <option value="left_mem">LEFT</option>
								   <option value="right_mem">RIGHT</option>
								   </select>
&nbsp; <font color="#000000"><strong><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<? echo $message1[12]; ?></strong></font></td>
			    </tr>
				 <tr>
                                   <td height="15" bgcolor="#FFFFFF" class="blue_txt"><div align="right"><font color="#990000"><strong><font size="1" face="Verdana, Arial, Helvetica, sans-serif">Enroller ID  
                                     :</font></strong></font></div></td>
								   <td bgcolor="#FFFFFF" class="blue_txt">
								   
								   
								   

<? 
$sql3="SELECT * FROM members ORDER BY id DESC LIMIT 1";
$query=mysql_query($sql3);
$result=mysql_fetch_array($query);
$enrolled_id_c=$result['enrolled_id'];
$real_id=str_replace("L","",$enrolled_id_c);
$string2 = "1";
$real_enrolled_id2 = $real_id+$string2;
$string7 = "L";
$enrolled_id_n = $string7.$real_enrolled_id2;
//echo $real_enrolled_id;
?>

								   
<input name="enroller_id_n" type="text" id="enroller_id_n" size="40" value="<?=$enrolled_id;?>">
&nbsp;<font color="#000000"><strong><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><? echo $message1[11]; ?></strong></font><br>
<div align="left" class="style1"><font size="1" face="Verdana, Arial, Helvetica, sans-serif">(It's a by defoult ID please change it to the ID to whom you want to assign this member)</font></div>								   </td>
			    </tr>
				 <tr>
                   <td height="15" bgcolor="#FFFFFF" class="blue_txt"><div align="right"><font color="#990000"><strong><font size="1" face="Verdana, Arial, Helvetica, sans-serif">Username :</font></strong></font></div></td>
				   <td bgcolor="#FFFFFF" class="blue_txt"><input name="username2" type="text" id="username2" size="40" value="<?=$enrolled_id_n;?>">				     
				     &nbsp;<font color="#000000"><strong>(Please do not edit this feild)</strong></font> </td>
			    </tr>
				 <tr>
                   <td height="15" bgcolor="#FFFFFF" class="blue_txt"><div align="right"><font color="#990000"><strong><font size="1" face="Verdana, Arial, Helvetica, sans-serif">Password 
                     :</font></strong></font></div></td>
				   <td bgcolor="#FFFFFF" class="blue_txt"><input name="pawd" type="text" id="pawd" size="40" value="">
				     &nbsp;<font color="#000000"><strong><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong><? echo $message1[7]; ?></strong></font></td>
			    </tr>



								
								
								 <tr>
                                  <td height="15" bgcolor="#FFFFFF" class="blue_txt"><div align="right"><font color="#990000"><strong><font size="1" face="Verdana, Arial, Helvetica, sans-serif">Enrolled ID  
                                    :</font></strong></font></div></td>
                                  <td bgcolor="#FFFFFF" class="blue_txt">

								  
								  
								  
								  
<input name="enrolled_id_n" type="text" id="enrolled_id_n" size="40" value="<?=$enrolled_id_n;?>"> 
<font color="#000000"><strong>(Please do not edit this feild)</strong></font>
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
