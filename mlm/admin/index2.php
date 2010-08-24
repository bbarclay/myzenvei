<? 
include('settings.inc');
$_SESSION['username'] = $_POST['username'];
$_SESSION['password'] = $_POST['password'];

if ($_POST){
if(!$_SESSION['username'] & !$_SESSION['password']){
$message = "User Name and Password cannot be blank";
}
else if(!$_SESSION['username'])
{
$message ="User Name cannot be blank";
}
else if(!$_SESSION['password'])
{
$message ="Password cannot be blank";
}else if( isset($_SESSION['username']) & isset($_SESSION['password'])){
$sql = "select username,password from company where username = '".$_SESSION['username'] ."' and password = '".$_SESSION['password']."'";
$result = mysql_query($sql);
$results = mysql_fetch_array($result);


if ( $_SESSION['username']==$results['username'] & $_SESSION['password']==$results['password']){
$_SESSION['admin'] = $results['username'];
header('location:main.php');
}else{

$message1 = "Sorry, the User Name and/or Password you entered is not valid.";
}



}
}
 ?>
<style>ACRONYM {
	border-bottom: none;
}

BODY {
	
	font-family:Tahoma, Verdana, Sans-Serif;
	font-size:11px;
	padding:0px;
	margin:10px 0px;
	background-image:   url();
}

SELECT {
	background-color:#FFFFFF;
	font-family:Tahoma, Verdana, Sans-Serif;
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
	font-family:Tahoma, Verdana, Geneva;
	font-size:11px;
	color:#333333;
	text-decoration:none;
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
	font-family:Tahoma, Verdana, Geneva;
	color: black;
	text-align: center;
}</style>
<body bgcolor="#999999"><table width="100%" height="100" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="100%" height="270" align="center" valign="top"> <br>
      <br>
      <form action="index.php" method="post" name="loginform" >
			
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
                        <td height="20" colspan="2" valign="bottom"><strong><font color="#FF0000">
                          <?= $message1 ?>
                          </font></strong></td>
                      </tr>
                      <tr align="left" valign="top"> 
                        <td width="50%" height="20" valign="bottom"><strong>Administrator 
                          Control Panel</strong></td>
                        <td width="50%" align="right">&nbsp;</td>
                      </tr>
                      <tr align="left" valign="top" bgcolor="#FFFFFF"> 
                        <td colspan="2">&nbsp;</td>
                      </tr>
                      <tr align="left" valign="top"> 
                        <td width="50%" valign="middle"><div align="right">User 
                            Name :&nbsp;&nbsp;&nbsp;</div></td>
                        <td width="50%"><input type="text" name="username" class="TaskEdit_tf" style="width:100%" value="<? echo $_SESSION['username']; ?>"></td>
                      </tr>
                      <tr align="left" valign="top"> 
                        <td height="10" colspan="2">&nbsp;</td>
                      </tr>
                      <tr align="left" valign="top"> 
                        <td width="50%" valign="middle"><div align="right">Password 
                            :&nbsp;&nbsp;&nbsp;</div></td>
                        <td width="50%"><input type="password" name="password" class="TaskEdit_tf" style="width:100%" value="<? echo $_SESSION['password']; ?>"></td>
                      </tr>
                      <tr align="left" valign="middle"> 
                        <td height="30" colspan="2"><font color="#FF0000"><? echo $message; ?></font></td>
                      </tr>
                      <tr align="left" valign="top"> 
                        <td colspan="2"> <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr> 
                              <td width="331" height="18" align="left" valign="middle" bgcolor="#FFFFFF"> 
                                <div align="left"> </div></td>
                              <td width="19" align="center" ><div align="right"> 
                                  <input type="submit" name="Submit" value="Login As Administrator" class="TaskEdit_tf">
                                </div></td>
                            </tr>
                          </table></td>
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
