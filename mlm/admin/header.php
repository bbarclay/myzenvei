<?
session_start();
if (empty($_SESSION["admin"]))
	if (PAGE_NAME != "index.php")
		header("Location:index.php");
		?>
<html><head>
<style type="text/css">
<!--
.style1 {
	color: #FFFFFF;
	font-weight: bold;
	font-family: Geneva, Arial, Helvetica, sans-serif;
}
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
<table align="center" border="0" style="border:#FFFFFF thin double;" width="990">
	<tr>
		<td width="990" bgcolor="#AA0000"><div align="center" class="style1">ADMINISTRATOR PANEL </div></td>
	</tr>
</table>

