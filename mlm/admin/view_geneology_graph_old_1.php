<?
 session_start();
 include('settings.inc');
 include('header.php');
 $user=$_SESSION['username'];
 $pwd=$_SESSION['pwd']; $enrolled_id=$_SESSION['enrolled_id'];
 $sql="select * from members where username='".$username."' and pwd='".$pwd."'";
 $query=mysql_query($sql);
 $result=mysql_fetch_array($query);
 $enroller_id=$result['enroller_id'];
 $enrolled_id=$result['enrolled_id'];
 //$d_left="left_mem";
 //$d_right="right_mem";
 
 /*if($_GET['mode']=="view")
{
	$enrolled_id=$_GET['enrolled_id'];
	//$compname = ereg_replace("[ \t\n\r]+", "_", $compname);
	$sql="slect * FROM geneology WHERE companyname = '".$companyname."'";
	$update_sql=mysql_query($sql);
	$message="Data Deleted Successfully";
	$sql1="drop table ".$companyname."";
	$query1=mysql_query($sql1);
	$spg = "_spg";
	$table = $companyname.$spg; 
	$sql12="drop table ".$table."";
	$query12=mysql_query($sql12);
	
}
if($_GET['mode']=="edit")
{
$message="Company Profile Updated Successfully";
}
 
 */
		//}

?>
<head>       
<link href="style2.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
.style1 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	color: #A41415;
}
-->
</style></head>
<body bgcolor="#666666" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table width="990" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr> 
    <td width="200" valign="top" bgcolor="#FFFFFF"> 
            
      <div align="center">
        <? include('categoryside.php'); ?>             
        </div></td>
    <td width="785" valign="top" bgcolor="#FFFFFF"> 
			<br>
<br>
<br>


	  <div align="center">
	    <!-- -------------------------------------------   -->
			    
	    <table id="Table_01" width="646" height="415" border="0" cellpadding="0" cellspacing="0">
	      <tr>
	        <td colspan="5">&nbsp;</td>
		    <td width="123" height="84" colspan="3" align="center" valign="middle" background="images/tree_09.gif">	
		      
		      <div align="center" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-weight:bold; font-size:11px;margin:10px 10px 10px 10px;"><a href=# color=white>
		        
		        <?  
		 
				$query  = "SELECT * from members where enrolled_id='".$enrolled_id."'";
					$querys=mysql_query($sql)or die(mysql_error());
 					$results=mysql_fetch_array($querys);
					$enrolled_id=$results['enrolled_id'];
					$enroller_id=$results['enroller_id'];
					$mem_name=$results['mem_name'];
					//$mem_name = ereg_replace("[ \t\n\r]+", "_", $mem_name);
					$mem_name=str_replace("_"," ",$mem_name);
					$statuse=$results['statuse'];
					$direction=$results['direction'];
				
								
				  ?>
		        
		        
		        
		        <font color=white><?=$mem_name?></font></a> <BR>
		        ID: <?=$enrolled_id?><br>
		        <strong><font color=lightgreen>Status:<?=$statuse?></font></strong> <br>
            <a href=""><font color=white>View Details</font></a> </div>		  </td>
		    <td colspan="5">&nbsp;</td>
	    </tr>
	      <tr>
	        <td rowspan="2">&nbsp;</td>
		    <td height="78" colspan="11"align="center" valign="bottom" background="images/tree_05.gif">&nbsp;</td>
		    <td rowspan="2">&nbsp;</td>
	    </tr>
	      <tr>
	        <td width="123" height="84" colspan="3" align="center" valign="middle" background="images/tree_09.gif"><div align="center" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-weight:bold; font-size:11px;margin:10px 10px 10px 10px;"> <a href=# color=white><font color=white>
<?
 					$sql="select * from personally_enrolled where enroller_id='".$enrolled_id."'";
 					$query=mysql_query($sql)or die(mysql_error());
 					$result=mysql_fetch_array($query);
					$left_mem=$result['left_mem'];
					$test="left_mem";
					
					if($left_mem==$test)
					{
					$query  = "SELECT * from members where enroller_id='".$enrolled_id."' and direction='".$left_mem."'";
					$querys=mysql_query($sql);
 					$results=mysql_fetch_array($querys);
					$enrolled_id2=$results['enrolled_id'];
					$enroller_id2=$results['enroller_id'];
					$mem_name_2=$results['mem_name'];
					//$mem_name = ereg_replace("[ \t\n\r]+", "_", $mem_name);
					$mem_name2=str_replace("_"," ",$mem_name_2);
					$statuse=$results['statuse'];
					$direction=$results['direction'];
				
				 
		  
		  }
				else
				{
					if($left_mem==NULL)
				{
					$message2="Not Available";
				}
				$message2="Available";
				}
				  ?>
		          <?=$message2?>
		          <?=$mem_name_2?>
	            </a></font> <BR>
	            <?=$enrolled_id2?>
	            <br>
	            <strong><font color=lightgreen>
	            <?=$statuse?>
	            </font></strong> <br>
            <a href=""><font color=white>View Details</font></a> </div></td>
		    <td colspan="5">&nbsp;</td>
		    <td width="123" height="84" colspan="3" align="center" valign="middle" background="images/tree_09.gif"><div align="center" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-weight:bold; font-size:11px;margin:10px 10px 10px 10px;"> <font color=white><a href=# color=white>
		      <?
		  
$sql="select * from personally_enrolled where enroller_id='".$enrolled_id."'";
 $query=mysql_query($sql);
 $result=mysql_fetch_array($query);
		  			//$sql="slect * from personally_enrolled where enroller_id='".$enrolled_id."'";
					//$query=mysql_query($sql);
 					//$result=mysql_fetch_array($query);
					$right_mem=$result['right_mem'];
					$test="right_mem";
					
					if($right_mem!=$test)
					{
					$query  = "SELECT * from members where enroller_id='".$enrolled_id."' and direction='".$d_right."'";
					$querys=mysql_query($query)or die(mysql_error());
 					$results=mysql_fetch_array($querys);
					$enrolled_id3=$results['enrolled_id'];
					$enroller_id3=$results['enroller_id'];
					$mem_name_1=$results['mem_name'];
					//$mem_name = ereg_replace("[ \t\n\r]+", "_", $mem_name);
					$mem_name_1=str_replace("_"," ",$mem_name_1);
					$statuse=$results['statuse'];
					$direction=$results['direction'];
				}
				else
				{
				if($right_mem==NULL)
				{
					$message1="Not Available";
				}
				
				}
				echo $right_mem;
				  ?>
		      <?=$message1?>
		      <?=$mem_name_1?>
		      </a></font> <BR>
		      <?=$enrolled_id1?>
			  
			  
		      <br>
		      <strong><font color=lightgreen>
		        <?=$statuse?>
		        </font></strong> <br>
	        <a href=""><font color=white>View Details</font></a> </div></td>
	    </tr>
	      <tr>
	        <td height="84" colspan="6" align="center" valign="bottom" background="images/tree_10.gif">&nbsp;</td>
		    <td rowspan="2">&nbsp;</td>
		    <td colspan="6" align="center" valign="bottom" background="images/tree_12.gif">&nbsp;</td>
	    </tr>
	      <tr>
	        <td colspan="2" align="center" valign="middle" background="images/tree_09.gif"><div align="center" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-weight:bold; font-size:11px;margin:10px 10px 10px 10px;"><a href=# color=white><font color=white>
		          <?
$sql="select * from personally_enrolled where enroller_id='".$enrolled_id2."'";
 $query=mysql_query($sql);
 $result=mysql_fetch_array($query);
$left_mem2=$result['left_mem'];
$test="left_mem";
					
					if($left_mem2!=$test)
					{
					$query  = "SELECT * from members where enroller_id='".$enrolled_id2."' and direction='".$d_left."'";
					$querys=mysql_query($sql);
 					$results=mysql_fetch_array($querys);
					$enrolled_id4=$results['enrolled_id'];
					$enroller_id4=$results['enroller_id'];
					$mem_name_3=$results['mem_name'];
					//$mem_name = ereg_replace("[ \t\n\r]+", "_", $mem_name);
					$mem_name_3=str_replace("_"," ",$mem_name_3);
					$statuse=$results['statuse'];
					$direction=$results['direction'];
				
				 }
				else
				{
					if($left_mem2==NULL)
				{
					$message3="Not Available";
				}
				$message3="Available";
				}
				  ?>
		          <?=$message3?>
		          <?=$mem_name_3?>
	            </a></font> <BR>
	            <?=$enrolled_id4?>
	            <br>
	            <strong><font color=lightgreen>
	            <?=$statuse?>
	            </font></strong> <br>
            <a href=""><font color=white>View Details</font></a> </div></td>
		    <td>&nbsp;</td>
		    <td colspan="3" align="center" valign="middle" background="images/tree_09.gif"><div align="center" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-weight:bold; font-size:11px;margin:10px 10px 10px 10px;"><a href=# color=white><font color=white>
		      <?
		  				
		  			$sql="select * from personally_enrolled where enroller_id='".$enrolled_id2."'";
 $query=mysql_query($sql);
 $result=mysql_fetch_array($query);
					$right_mem2=$result['right_mem'];
					$test="right_mem";
					
					if($left_mem!=$test)
					{
					$query  = "SELECT * from members where enroller_id='".$enrolled_id2."' and direction='".$d_right."'";
					$querys=mysql_query($sql);
 					$results=mysql_fetch_array($querys);
					$enrolled_id5=$results['enrolled_id'];
					$enroller_id5=$results['enroller_id'];
					$mem_name_4=$results['mem_name'];
					//$mem_name = ereg_replace("[ \t\n\r]+", "_", $mem_name);
					$mem_name_4=str_replace("_"," ",$mem_name_4);
					$statuse=$results['statuse'];
					$direction=$results['direction'];
				
				  }
				else
				{
					if($right_mem2==NULL)
				{
					$message4="Not Available";
				}
				$message4="Available";
				}
				  ?>
		      <?=$message4?>
		      <?=$mem_name_4?>
		      </a></font> <BR>
		      <?=$enrolled_id5?>
		      <br>
		      <strong><font color=lightgreen>
		        <?=$statuse?>
		        </font></strong> <br>
	        <a href=""><font color=white>View Details</font></a> </div></td>
		    <td colspan="3" align="center" valign="middle" background="images/tree_09.gif"><div align="center" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-weight:bold; font-size:11px;margin:10px 10px 10px 10px;"><a href=# color=white><font color=white>
		      <?
		  			$sql="select * from personally_enrolled where enroller_id='".$enrolled_id3."'";
 $query=mysql_query($sql);
 $result=mysql_fetch_array($query);
					$left_mem3=$result['left_mem'];
					$test="left_mem";
					
					if($left_mem!=$test)
					{	
					$query  = "SELECT * from members where enroller_id='".$enrolled_id3."' and direction='".$d_left."'";
					$querys=mysql_query($sql);
 					$results=mysql_fetch_array($querys);
					$enrolled_id6=$results['enrolled_id'];
					$enroller_id6=$results['enroller_id'];
					$mem_name_5=$results['mem_name'];
					//$mem_name_5 = ereg_replace("[ \t\n\r]+", "_", $mem_name);
					$mem_name_5=str_replace("_"," ",$mem_name_5);
					$statuse=$results['statuse'];
					$direction=$results['direction'];
				
				   }
				else
				{
				if($left_mem3==NULL)
				{
					$message5="Not Available";
				}
				$message5="Available";
				}
				  ?>
		      <?=$message5?>
		      <?=$mem_name_5?>
		      </a></font> <BR>
		      <?=$enrolled_id6?>
		      <br>
		      <strong><font color=lightgreen>
		        <?=$statuse?>
		        </font></strong> <br>
	        <a href=""><font color=white>View Details</font></a> </div></td>
		    <td>&nbsp;</td>
		    <td colspan="2" align="center" valign="middle" background="images/tree_09.gif"><div align="center" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-weight:bold; font-size:11px;margin:10px 10px 10px 10px;"><a href=# color=white><font color=white>
		      <?
$sql="select * from personally_enrolled where enroller_id='".$enrolled_id3."'";
$query=mysql_query($sql);
$result=mysql_fetch_array($query);
$right_mem3=$result['right_mem'];
$test="right_mem";
					
					if($right_mem3!=$test)
					{	
					$query  = "SELECT * from members where enroller_id='".$enrolled_id3."' and direction='".$d_right."'";
					$querys=mysql_query($sql);
 					$results=mysql_fetch_array($querys);
					$enrolled_id7=$results['enrolled_id'];
					$enroller_id7=$results['enroller_id'];
					$mem_name_6=$results['mem_name'];
					//$mem_name = ereg_replace("[ \t\n\r]+", "_", $mem_name);
					$mem_name_6=str_replace("_"," ",$mem_name_6);
					$statuse=$results['statuse'];
					$direction=$results['direction'];
				
				   }
				else
				{
					if($right_mem3==NULL)
				{
					$message6="Not Available";
				}
				$message6="Available";
				}
				  ?>
		      <?=$message6?>
		      <?=$mem_name_6?>
		      </a></font> <BR>
		      <?=$enrolled_id7?>
		      <br>
		      <strong><font color=lightgreen>
		        <?=$statuse?>
		        </font></strong> <br>
	        <a href=""><font color=white>View Details</font></a> </div></td>
	    </tr>
	      <tr>
	        <td>
	          <img src="images/spacer.gif" width="105" height="1" alt=""></td>
		    <td>
	        <img src="images/spacer.gif" width="18" height="1" alt=""></td>
		    <td>
	        <img src="images/spacer.gif" width="70" height="1" alt=""></td>
		    <td>
	        <img src="images/spacer.gif" width="35" height="1" alt=""></td>
		    <td>
	        <img src="images/spacer.gif" width="33" height="1" alt=""></td>
		    <td>
	        <img src="images/spacer.gif" width="55" height="1" alt=""></td>
		    <td>
	        <img src="images/spacer.gif" width="28" height="1" alt=""></td>
		    <td>
	        <img src="images/spacer.gif" width="40" height="1" alt=""></td>
		    <td>
	        <img src="images/spacer.gif" width="34" height="1" alt=""></td>
		    <td>
	        <img src="images/spacer.gif" width="49" height="1" alt=""></td>
		    <td>
	        <img src="images/spacer.gif" width="56" height="1" alt=""></td>
		    <td>
	        <img src="images/spacer.gif" width="18" height="1" alt=""></td>
		    <td>
	        <img src="images/spacer.gif" width="105" height="1" alt=""></td>
	    </tr>
                        </table>
      </div>
		    <p align="center">&nbsp;</p>
			<p align="center">&nbsp;</p>
			<p align="center">&nbsp;</p>
			<p align="center">&nbsp;</p>
			<p align="center">&nbsp;</p>
			<p align="center">&nbsp;</p>
	        
      <div align="center">
        <!--                  -----------------------                    -->
              </div></td>
  </tr>
        </table>
        
      </div></td>
  </tr>
</table>
<? include('footer.php'); ?>