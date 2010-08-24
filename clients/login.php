<?php
	/*Config is custom file which takes (user,pass,host,DB) from joomla configration file*/
//include_once 'zenvieConfig.php';	
include('config.php');
	
	
	if($_GET['action'] == 'logout')
	{
		unset($_SESSION['userid']);
	}
	if($_REQUEST['Submit'] != '')
	{
		
		$username = $_POST['username'];
    	$password = $_POST['password'];
	
		if( !empty($username) && !empty($password) )
		{
			$query = "SELECT id,password FROM jos_users WHERE username = '$username'";  
   			$result = mysql_query($query);
			$row = mysql_fetch_array($result);
			
			$ps = explode(":",$row['password']);
			$crypt = $ps[0];
			$salt = $ps[1];
			
			$stored_password = md5($password.$salt);
			
			if($result && ($stored_password == $crypt))
			{
				$_SESSION['userid'] = $row['id'];
				$_SESSION['username'] = $username;
			echo	$_SESSION['userid'].$_SESSION['username'];
				header("Location: purchase.php");
			
			}
			else
			{
			$error = "Wrong Username or password"; 
			}
		}
		else
		{
			$error = "Wrong Username or password"; 
		}
	}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Purchase Now</title>
<style type="text/css">
<!--
.style1 {color: #FF0000}
-->
</style>
</head>

<body>


		<p align="center"><img src="../images/header.jpg" alt="header" width="903" height="105" border="0" usemap ="#Map" />
		  
		    <map name="Map" id="Map">
		      <area shape="rect" coords="833,57,903,75" href="../customers/signup.php" />
	          <area shape="rect" coords="-4,39,83,56" href="http://www.zenvei.com/" />
	          <area shape="rect" coords="831,34,905,55" href="../customers/purchasenow.php" />
	          <a href="signup.php">  
		      <area shape="rect" coords="834,65,835,66" href="../customers/signup.php" />
		      </a>
	        </map>
</p>
		<p>&nbsp;</p>
		<form action="" method="post" name="form1"> 
		<table width="50%" border="0" align="center">
		  <tr>
            <td align="left"><a href="signupnoregfee.php">New Preferred Customers</a> </td>
            <td>&nbsp;</td>
          </tr>
		<br>
          <tr>
            <td colspan="2">Existing associate or return customer login </td>
          </tr>
          <tr>
            <td colspan="2">&nbsp;<span class="style1"><?php echo $error; ?></span></td>
          </tr>
          <tr>
            <td width="39%">Login:</td>
            <td width="61%">&nbsp;</td>
          </tr>
          <tr>
            <td align="left">Username </td>
            <td><label>
              <input type="text" name="username"  value="<?php echo $username;?>"/>
            </label></td>
          </tr>
          <tr>
            <td align="left">Password</td>
            <td><input type="password" name="password" /></td>
          </tr>
          <tr>
            <td align="left">&nbsp;</td>
            <td><label>
              <input type="submit" name="Submit" value="Login" />
            </label></td>
          </tr>
          <tr>
            <td align="left">&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
        
          <tr>
            <td align="left">&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
        </table>
		</form>
		<p>&nbsp;        </p>
</body>
</html>