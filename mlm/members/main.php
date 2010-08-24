<?php
	include 'header.php';
	$username = $_SESSION['username'];
	$password = $_SESSION['pwd'];

	$sql="select * from members where username='".$username."' and pwd='".$password."'";
	$query=mysql_query($sql);
	$result=mysql_fetch_array($query);

	$mem_name=$result['mem_name'];
	//$comp=str_replace("_"," ",$comp);
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

	
	<table width="97%" border="0" align="center" cellpadding="0" cellspacing="0">
	  
	  <tr valign="top"> 
		<td width="172" rowspan="2" valign="top" bgcolor="#FFFFFF"> <?php include('categoryside.php'); ?></td>
		<td width="580" bgcolor="#FFFFFF"> 
				 
				  <table width="100%" border="0" align="left" cellpadding="0" cellspacing="0" bgcolor="#D4D4C8">
					<tr valign="top"> <br /><br />
					  <td height="19" colspan="6" align="center" bgcolor="#EFEFE7" >
					  	<font color="#990000"><strong>			
							Welcome <?php echo $mem_name; ?>  to Members Control Panel<br />
					  	</strong></font>					  </td>
					</tr>
		  </table>	</td>
	  </tr>
	  <tr valign="top">
	    <td bgcolor="#FFFFFF">
        
		<p>&quot;Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.&quot;</p>
		
		<p>&quot;Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.&quot;</p>		</td>
      </tr>
	</table>
	