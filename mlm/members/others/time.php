<?php
include('../header.php');

$user=$_SESSION['username'];
$pass=$_SESSION['password'];
$sql="select * from company where username='".$user."' and password='".$pass."'";
$query=mysql_query($sql);
$result=mysql_fetch_array($query);
$compname=$result['companyname'];
$tim1=$result['timefrom'];
$tim2=$result['timeto'];
if( $_POST)
{
	if(trim($_POST['time1'])=='')
	{
		$message1[0] = "It can't be left blank";
	}
	if(trim($_POST['time2'])=='')
	{
		$message1[1] = "It can't be left blank";
	}
	
	$time1 = $_POST['time1'];
	$time2 = $_POST['time2'];
	
	if(empty($message1))
	{
			$sql =	 "update company set timefrom='".$time1."',timeto='".$time2."' where companyname='".$compname."'";
			$result = mysql_query($sql);	
			$message="Time Updated";
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
                    &nbsp;View Off-peak Hours Fee</strong></font></td>
                </tr>
                <tr> 
                  <td height="15" colspan="2" bgcolor="#FFFFFF" class="blue_txt"><div align="justify"><font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 
                      The following information is Available - </font></div></td>
                </tr>
                <tr> 
                  <td width="24%" height="15" bgcolor="#FFFFFF" class="blue_txt"><div align="right"><font color="#990000"><strong><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><u>Time 
                      Range</u> </font></strong></font></div></td>
                  <td bgcolor="#FFFFFF" class="blue_txt">&nbsp;</td>
                  </tr>
                  <tr>
                  <td width="24%" height="15" bgcolor="#FFFFFF" class="blue_txt"><div align="right"><font color="#990000"><strong><font size="1" face="Verdana, Arial, Helvetica, sans-serif">From: </font></strong></font></div>
                    </td>
                    <td bgcolor="#FFFFFF" class="blue_txt"><input name="time1" type="text" id="time1" size="10" value="<?=$tim1?>">
                    &nbsp;<font color="#000000"><strong><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><? echo $message1[0]; ?></strong></font> </td>
                </tr>
                  <tr>
                  <td width="24%" height="15" bgcolor="#FFFFFF" class="blue_txt"><div align="right"><font color="#990000"><strong><font size="1" face="Verdana, Arial, Helvetica, sans-serif">To: </font></strong></font></div>
                    </td>
                    <td bgcolor="#FFFFFF" class="blue_txt"><input name="time2" type="text" id="time2" size="10" value="<?=$tim2?>">
                    &nbsp;<font color="#000000"><strong><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><? echo $message1[1]; ?></strong></font> </td>
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

