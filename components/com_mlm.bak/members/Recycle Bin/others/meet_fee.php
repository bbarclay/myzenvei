<? 
ob_start();
session_start();		
include('header.php');
include('settings.inc');

$user=$_SESSION['username'];
$pass=$_SESSION['password'];
$sql="select * from company where username='".$user."' and password='".$pass."'";
$query=mysql_query($sql);
$result=mysql_fetch_array($query);
$compname=$result['companyname'];
if( $_POST)
{
	if(trim($_POST['meet'])=='')
	{
		$message1[0] = "It can't be left blank";
	}
	
	$meet = $_POST['meet'];
	
	if(empty($message1))
	{
			$sql =	 "update ".$compname." set meetfee='".$meet."'";
			$result = mysql_query($sql);	
			$message="Meet & Greet Fee Updated Globally";
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
                    &nbsp;Update Meet & Greet / Check In Fee Globally</strong></font></td>
                </tr>
                <tr> 
                  <td height="15" colspan="2" bgcolor="#FFFFFF" class="blue_txt"><div align="justify"><font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 
                      Fill the following information - </font></div></td>
                </tr>
                <tr> 
                  <td width="24%" height="15" bgcolor="#FFFFFF" class="blue_txt"><div align="right"><font color="#990000"><strong><font size="1" face="Verdana, Arial, Helvetica, sans-serif">Meet & 
                      Greet Fee :</font></strong></font></div></td>
                  <td bgcolor="#FFFFFF" class="blue_txt"><input name="meet" type="text" id="meet" size="40"> 
                    &nbsp;<font color="#000000"><strong><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><? echo $message1[0]; ?></strong></font></td>
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

