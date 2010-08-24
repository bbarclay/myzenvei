<?
include('header.php');
include('settings.inc');


$userns=$_SESSION['username'];
$passns=$_SESSION['pwd'];


$sql="select * from members where username='".$username."' and pwd='".$pwd."'";
$query=mysql_query($sql);
$result=mysql_fetch_array($query);
$mem_name=$result['mem_name'];
$comp=str_replace("_"," ",$comp);
$street=$result['street'];
$city=$result['city'];
$state=$result['state'];	
$zip=$result['zip'];
$phone=$result['phone'];
$mail=$result['email'];




?>
<style type="text/css">
<!--
.style1 {
	font-family: Georgia, "Times New Roman", Times, serif;
	font-weight: bold;
}
.style2 {color: #000000}
-->
</style>

<table width="990" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr valign="top"> 
    <td width="172" valign="top" bgcolor="#FFFFFF"> <? include('categoryside.php'); ?></td>
    <td width="580" bgcolor="#FFFFFF"> 
              <table width="580" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#D4D4C8">
                <tr valign="top"> <br /><br />
                  <td height="19" colspan="6" align="center" bgcolor="#EFEFE7" class="blue_txt"><font color="#990000"><strong>Welcome  
	             
	         to ADMIN Control Panel </strong></font></td>
                </tr>
      </table>
          
		  
		      <div align="center" class="style1 style2">     </div></td>
  </tr>
</table>
<? include('footer.php'); ?>


