<?php
	session_start();
	
	$con = mysql_connect('localhost', 'myzenvei_testing', 'TbTOpEgpWf7t');
		mysql_select_db('myzenvei_testing');
		
	error_reporting(0);
	
	if($_REQUEST['Submit'] != '')
	{
		$username = $_POST['username'];
    	$password = $_POST['password'];
		
		if($username!='')
		{
			$query = "SELECT * FROM mlm_geneology_tree WHERE username = '$username' ";  
   			$result = mysql_query($query);
			$num_rows = mysql_num_rows($result);
			$row = mysql_fetch_array($result);
			
			echo $row['userid'];
								
			if($num_rows > 0 )
			{	
				$_SESSION['user'] = $username;
				$_SESSION['userid'] = $row['userid'];
				header("Location: purchasenow_form.php?id=".$row['userid']."");
			
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


		<p align="center"><img src="images/header.jpg" alt="header" width="903" height="105" border="0" usemap ="#Map" />
		  
		    <map name="Map" id="Map">
		      <area shape="rect" coords="833,57,903,75" href="signup.php" />
	          <area shape="rect" coords="-4,39,83,56" href="http://www.zenvei.com/" />
	          <area shape="rect" coords="831,34,905,55" href="purchasenow.php" />
	          <a href="signup.php">  
		      <area shape="rect" coords="834,65,835,66" href="signup.php" />
		      </a>
	        </map>
</p>
		<p>&nbsp;</p>
		<form action="" method="post" name="form1"> 
		<table width="50%" border="1" align="center">
          <tr>
            <td colspan="2">If you are a existing associate or Return customer please login </td>
          </tr>
          <tr>
            <td colspan="2">&nbsp;<span class="style1"><?php echo $error; ?></span></td>
          </tr>
          <tr>
            <td width="39%">Return Customer </td>
            <td width="61%">&nbsp;</td>
          </tr>
          <tr>
            <td align="right">Username </td>
            <td><label>
              <input type="text" name="username"  value="<?php echo $username;?>"/>
            </label></td>
          </tr>
          <tr>
            <td align="right">Password</td>
            <td><input type="password" name="password" /></td>
          </tr>
          <tr>
            <td align="right">&nbsp;</td>
            <td><label>
              <input type="submit" name="Submit" value="Submit" />
            </label></td>
          </tr>
          <tr>
            <td align="left">&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td align="left"><a href="signupnoregfee.php">New Preffered Customers</a> </td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td align="right">&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
        </table>
		</form>
		<p>&nbsp;        </p>
</body>
</html>
