<?
session_start();
if (empty($_SESSION["admin"]))
	if (PAGE_NAME != "index.php")
		header("Location:index.php");
		?>
<html><head>
<style type="text/css">
<!--
.style1 {color: #FFFFFF}
-->
</style>
<style type="text/css">
<!--
a:link {
	text-decoration: none;
	color: #AA0000;
}
a:visited {
	text-decoration: none;
}
a:hover {
	text-decoration: underline;
}
a:active {
	text-decoration: none;
}
-->
</style></head>
<body topmargin="0" bgcolor="#666666" text="#000000">
<table align="center" border="0" width="780">
	<tbody><tr>
		<td width="112">&nbsp;</td>
		<td width="786">
			<table align="center" bgcolor="#cccccc" border="2" bordercolor="#ffffff" cellpadding="0" cellspacing="0" width="100%">
			<tbody>
            	<tr>
					<td width="100%" bgcolor="#CCCCCC">
							<p>
								<font face="Arial, Helvetica, sans-serif">
							<table background="images/bg.htm" border="0" cellpadding="0" cellspacing="0" width="780">
  								<tbody>
                                	<tr>
                      					<td align="center"><font face="Arial, Helvetica, sans-serif">Dealers Panel </font></td>
   									</tr>
  								</tbody>
                             </table>
                                </font>
                             </p>
 					</td>
            	</tr>
			</tbody>
          </table>
		</td>
		<td width="132" bgcolor="#666666">&nbsp;</td>
	</tr>
</tbody>
</table>

