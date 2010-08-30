<?php
	$_SESSION['username'] = $_POST['username'];
	$_SESSION['pwd'] = $_POST['pwd'];
	
		if ($_POST)
		{
			if(!$_SESSION['username'] & !$_SESSION['pwd']){
			$message = "Enter values for username and password";
		}
		else if(!$_SESSION['username'])
		{
			$message ="Username cannot be blank";
		}
		else if(!$_SESSION['pwd'])
		{
			$message ="Please cannot be blank";
		}
		else if( isset($_SESSION['username']) & isset($_SESSION['pwd']))
		{
			
			$sql = "select * from members";
			$result = mysql_query($sql);
			$results = mysql_fetch_array($result);
			
			$test = "inactive";
			
			if($test == $results['statuse'])
			{
				$message = "Sorry, your account is not active.";
			}
			else
			{
				if ( $_SESSION['username'] == $results['username'] & $_SESSION['pwd'] == $results['pwd'])
				{
					$_SESSION['admin'] = $results['username'];
					header('Location: http://localhost/Brandons/site/index.php?option=com_mlm&page=main');
				}
				else
				{
					$message = "Username and/or password you entered is not valid.";
				}
			
			}
			
		}
		}
 ?>
<style>
ACRONYM {
	border-bottom: none;
}

BODY {
	
	font-family: HelveticaNeue,Arial, Helvetica, Sans-Serif;
	font-size:11px;
	padding:0px;
	margin:10px 0px;
	background-image:   url();
}

SELECT {
	background-color:#FFFFFF;
	font-family: HelveticaNeue,Arial, Helvetica, Sans-Serif;
	font-size:11px;
	padding:0px;
	margin:0px;
}

A.Nav:link, A.Nav:visited, A.Nav:active {
	color: white;
	text-decoration: none;
	font-size: 12px;
}

A.Nav:hover {
	color: white;
	text-decoration: underline;
}

A:link, A:visited, A:active {
	color: black;
	text-decoration: none;
}

A:hover {
	color: #009CFF;
	/*color: black;*/
	text-decoration: underline;
}


A.linkon:link, A.linkon:visited, A.linkon:active {
	color: black;
	text-decoration: none;
}

A.linkon:hover {
	color: #009CFF;
	text-decoration: underline;
}

TD.ActiveTab {
	font-weight: bold;
	text-decoration: underline;
}

TD.InactiveTab {
	font-weight: bold;
	text-decoration: none;
}

table.outer {
	background-color:#EDEDE1;
}

table.inner {
	background-color:#FFFFFF;
}


TABLE, P, A, SELECT.TaskUpdate_dd, INPUT.TaskEdit_tf, TEXTAREA.TaskEdit_ta {
	font-family: HelveticaNeue,Arial, Helvetica, Sans-Serif;
	font-size:11px;
	color:#333333;
	text-decoration:none;
}
.button {
    border: 1px solid #006;
    background: #9cf;
}
.input {
    border: 1px solid #006;
    background: #ffc;
}

TABLE.Calendar_de {
	font-size:10px;
}

TD.pass, A.pass:link, A.pass:visited, A.pass:active, A.pass:hover {
	background-color:#FFFFFF;
	color: #009CFF;
}

TD.fail {
	background-color:#FFFFFF;
	color: red;
}

.ProgressBar {
	font-size:10px;
}
.Heading {
	color:#333333;
}
.LogDetails {
	font-size:10px;
}

DIV.copyright {
	font-size: 10px;
	font-family: HelveticaNeue,Arial, Helvetica, Sans-Serif;
	color: black;
	text-align: center;
}</style>

<table width="100%" height="100" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="100%" height="270" align="center" valign="top"> <br>
      <br>
      <form action="index.php?option=com_mlm" method="post" name="loginform" >
			
        <p> <br>
        </p>
        <p>&nbsp; </p>
        <table width="360" border="0" align="center" cellpadding="5" cellspacing="0" bgcolor="#EDEDE1">
        <tr>
          <td align="left" valign="top">
						<table width="360" border="0" cellpadding="5" cellspacing="0" bgcolor="#FFFFFF">
              <tr>
                <td align="left" valign="top">
									<table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr align="center" valign="top"> 
                        <td height="20" colspan="3" valign="bottom"><strong><font color="#FF0000">
                          <?= $message ?>
                          </font></strong></td>
                      </tr>
                      
                      <tr align="left" valign="top"> 
                        <td height="20" colspan="3" valign="bottom"><strong>MLM Member's
                          Login</strong></td>
                        </tr>
                      <tr align="left" valign="top" bgcolor="#FFFFFF"> 
                        <td colspan="3">&nbsp;</td>
                      </tr>
                      <tr align="left" valign="top"> 
                        <td width="42%" align="right" valign="middle">Username &nbsp;</td>
                        <td width="45%"><input type="text" name="username" class="input" style="width:100%"></td>
                        <td width="13%">&nbsp;</td>
                      </tr>
                      <tr align="left" valign="top"> 
                        <td height="10" colspan="3">&nbsp;</td>
                      </tr>
                      <tr align="left" valign="top"> 
                        <td width="42%" align="right" valign="middle">Password &nbsp;</td>
                        <td width="45%"><input type="password" name="pwd" class="input" style="width:100%"></td>
                        <td width="13%">&nbsp;</td>
                      </tr>
                      <tr align="left" valign="middle"> 
                        <td height="30" colspan="3">&nbsp;</td>
                      </tr>
                      <tr align="left" valign="top"> 
                        <td align="right">&nbsp;</td>
                        <td align="right"><input type="submit" name="Submit" value="Login" class="button"></td>
                        <td align="left">&nbsp;</td>
                      </tr>
                    </table>
				  </td>
              </tr>
            </table>
			</td>
        </tr>
      </table>
      </form>
	</td>
  </tr>
</table>