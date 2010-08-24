<?
 session_start();
 include('settings.inc');
 include('header.php');
 $user=$_SESSION['username'];
 $pass=$_SESSION['password'];
$enrolled_id2=$_GET['enrolled_id'];
$enrolled_id_2=$enrolled_id2;

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
             
               
              <table width="95%" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#D4D4C8">
                <?php
				if($message != "")
				{
				?>
                <tr align="center"> 
                  <td height="19" colspan="4" bgcolor="#EFEFE7" class="blue_txt"><font color="#FF0000" size="2" face="Verdana, Arial, Helvetica, sans-serif"><strong><?php echo $message;?> 
                    </strong></font></td>
                </tr>
                <?php
				}
				?>
                <tr> 
                  <td height="19" colspan="4" bgcolor="#EFEFE7" class="blue_txt"><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong>:: 
                    &nbsp;View Company</strong></font></td>
                </tr>
                <tr> 
                  <td height="15" colspan="4" bgcolor="#FFFFFF" class="blue_txt"><div align="justify"><font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 
                      The following information is Available - </font></div></td>
                </tr>
               
				<tr> 
                  <td><div align="right"><strong><font size="1" color="#990000" face="Verdana, Arial, Helvetica, sans-serif">Enroller ID </font></strong></div></td>
				  <td><div align="right"><strong><font size="1" color="#990000" face="Verdana, Arial, Helvetica, sans-serif">Member Name </font></strong></div></td>
<td><div align="right"><strong><font size="1" color="#990000" face="Verdana, Arial, Helvetica, sans-serif">Direction.</font></strong></div></td>

				</tr>
				
				
				 <? 
				  $sql3="select * from members where enroller_id='".$enrolled_id_2."'";
				  $query3=mysql_query($sql3);
				  while($result3=mysql_fetch_array($query3))
				  {
				  $enroller_id = $result3['enroller_id'];
				  $direction=$result3['direction'];
				  
				  //$femalestr = str_replace("replaceme", "daughter", $rawstring);

				  $t_dir= str_replace("_mem","",$direction);
				  $mem_name=$result3['mem_name'];
				 // $mem_name = ereg_replace("[ \t\n\r]+", "_", $mem_name);
$mem_name=str_replace("_"," ",$mem_name);
					
				  ?>
				<tr> 
                  <td bgcolor="#7E7E63">
				  
                  
                  
				  
				  
				  
				  
				  
				  <div align="right"><strong><font size="1" color="#FFFFFF" face="Verdana, Arial, Helvetica, sans-serif">
				  <?=$enrolled_id;?></font></strong></div></td>
<td bgcolor="#FEFEFE">


<div align="right"><strong><font size="1" color="#000000" face="Verdana, Arial, Helvetica, sans-serif">
<?=$mem_name;?></font></strong></div>




</td>
<td bgcolor="#FEFEFE">


<div align="right"><strong><font size="1" color="#000000" face="Verdana, Arial, Helvetica, sans-serif">
<?=$t_dir;?></font></strong></div>




</td>
				</tr>
				
				   <?
				  }
				  ?>
              </table>
             
              
           
            </td>
          </tr>
        </table>
        </td>
          </tr>
        </table>

      <? include('footer.php'); ?>
