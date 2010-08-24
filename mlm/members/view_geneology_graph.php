<?php
include 'header.php';
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
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
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
					$enrolled_id1=$results['enrolled_id'];
					//$enroller_id1=$results['enroller_id'];
					$mem_name=$results['mem_name'];
					//$mem_name = ereg_replace("[ \t\n\r]+", "_", $mem_name);
					$mem_name1=str_replace("_"," ",$mem_name);
					$statuse=$results['statuse'];
					$direction=$results['direction'];
				
								
				  ?>
		        
		        
		        
		        <font color=white><?=$mem_name1?></font></a> <BR>
		        ID: <?=$enrolled_id1?><br>
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
 					$sql1="select * from personally_enrolled where enroller_id='".$enrolled_id1."'";
 					$query1=mysql_query($sql1)or die(mysql_error());
 					$result1=mysql_fetch_array($query1);
					$left_mem=$result1['left_mem'];
					$test="left_mem";
					
					if($left_mem==$test)
					{
					$querye  = "SELECT * from members where enroller_id='".$enrolled_id1."' and direction='".$left_mem."'";
					
					$querys=mysql_query($querye);
 					$resulta=mysql_fetch_array($querys);
					//print_r($resulta);
					$enr=$resulta['enrolled_id'];
					//$enroller_id2=$results['enroller_id'];
					$mem=$resulta['mem_name'];
					//$mem_name = ereg_replace("[ \t\n\r]+", "_", $mem_name);
					$mem_n=str_replace("_"," ",$mem);
					$statusa=$resulta['statuse'];
					//$directiona=$resulta['direction'];
				
				 
		  
		  }
				else
				{
					if($left_mem==NULL)
				{
					$message2="Not Available";
				}
				//$message2="Available";
				}
				  ?>
		          <? //=$message2?>
		          <?=$mem_n?>
	            </a></font> <BR>
	            <?=$enr?>
	            <br>
	            <strong><font color=lightgreen>
	            <?=$statusa?>
	            </font></strong> <br>
            <a href=""><font color=white>View Details</font></a> </div></td>
		    <td colspan="5">&nbsp;</td>
		    <td width="123" height="84" colspan="3" align="center" valign="middle" background="images/tree_09.gif">
			<div align="center" style="font-family:Verdana, Arial, Helvetica, sans-serif;
			font-weight:bold; font-size:11px;margin:10px 10px 10px 10px;"> <font color=white><a href=# color=white>
		      <?
 					$sqlq="select * from personally_enrolled where enroller_id='".$enrolled_id1."'";
 					$queryq=mysql_query($sqlq)or die(mysql_error());
 					$resultq=mysql_fetch_array($queryq);
					$right_mem=$resultq['right_mem'];
					$test="right_mem";
					
					if($right_mem==$test)
					{
					$queryn  = "SELECT * from members where enroller_id='".$enrolled_id1."' and direction='".$right_mem."'";
					
					$querysn=mysql_query($queryn);
 					$resultn=mysql_fetch_array($querysn);
					//print_r($resultn);
					$enrn=$resultn['enrolled_id'];
					//$enroller_id2=$results['enroller_id'];
					$memn=$resultn['mem_name'];
					//$mem_name = ereg_replace("[ \t\n\r]+", "_", $mem_name);
					$mem_nn=str_replace("_"," ",$memn);
					$statusn=$resultn['statuse'];
					//$directiona=$resultae['direction'];
				
				 
		  
		  }
				else
				{
					if($left_mem==NULL)
				{
					$message2="Not Available";
				}
				//$message2="Available";
				}
				  ?>
				  
				  
				  
		      <?=$message1?>
		      <?=$mem_nn?>
		      </a></font> <BR>
		      <?=$enrn?>
			  
			  
		      <br>
		      <strong><font color=lightgreen>
		        <?=$statusn?>
		        </font></strong> <br>
	        <a href=""><font color=white>View Details</font></a> </div></td>
	    </tr>
	      <tr>
	        <td height="84" colspan="6" align="center" valign="bottom" background="images/tree_10.gif">&nbsp;</td>
		    <td rowspan="2">&nbsp;</td>
		    <td colspan="6" align="center" valign="bottom" background="images/tree_12.gif">&nbsp;</td>
	    </tr>
	      <tr>
	        <td colspan="2" align="center" valign="middle" background="images/tree_09.gif"><div align="center" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-weight:bold; font-size:11px;margin:10px 10px 10px 10px;"> <a href=# color=white><font color=white>
<?
 					$sqlde="select * from personally_enrolled where enroller_id='".$enr."'";
 					$queryde=mysql_query($sqlde)or die(mysql_error());
 					$resultde=mysql_fetch_array($queryde);
					$left_mem=$resultde['left_mem'];
					$test="left_mem";
					
					if($left_mem==$test)
					{
					$queryf  = "SELECT * from members where enroller_id='".$enr."' and direction='".$left_mem."'";
					
					$queryf=mysql_query($queryf);
 					$resultf=mysql_fetch_array($queryf);
					//print_r($resulta);
					$enf=$resultf['enrolled_id'];
					//$enroller_id2=$results['enroller_id'];
					$memss=$resultf['mem_name'];
					//$mem_name = ereg_replace("[ \t\n\r]+", "_", $mem_name);
					$mem_nf=str_replace("_"," ",$memss);
					$statusaf=$resultf['statuse'];
					//$directiona=$resulta['direction'];
				
				 
		  
		  }
				else
				{
					if($left_mem==NULL)
				{
					$message2="Not Available";
				}
				//$message2="Available";
				}
				  ?>
		          <? //=$message2?>
		          <?=$mem_nf?>
	            </a></font> <BR>
	            <?=$enf?>
	            <br>
	            <strong><font color=lightgreen>
	            <?=$statusaf?>
	            </font></strong> <br>
            <a href=""><font color=white>View Details</font></a> </div></td>
		    <td>&nbsp;</td>
		    <td colspan="3" align="center" valign="middle" background="images/tree_09.gif"><div align="center" style="font-family:Verdana, Arial, Helvetica, sans-serif;
			font-weight:bold; font-size:11px;margin:10px 10px 10px 10px;"> <font color=white><a href=# color=white>
		      <?
 					$sqlr="select * from personally_enrolled where enroller_id='".$enr."'";
 					$queryr=mysql_query($sqlr)or die(mysql_error());
 					$resultr=mysql_fetch_array($queryr);
					$right_mem=$resultr['right_mem'];
					$test="right_mem";
					
					if($right_mem==$test)
					{
					$queryns  = "SELECT * from members where enroller_id='".$enr."' and direction='".$right_mem."'";
					
					$querysns=mysql_query($queryns);
 					$resultns=mysql_fetch_array($querysns);
					//print_r($resultn);
					$enrns=$resultns['enrolled_id'];
					//$enroller_id2=$results['enroller_id'];
					$memns=$resultns['mem_name'];
					//$mem_name = ereg_replace("[ \t\n\r]+", "_", $mem_name);
					$mem_ns=str_replace("_"," ",$memns);
					$statusns=$resultns['statuse'];
					//$directiona=$resultae['direction'];
				
				 
		  
		  }
				else
				{
					if($left_mem==NULL)
				{
					$message2="Not Available";
				}
				//$message2="Available";
				}
				  ?>
				  
				  
				  
		      <?=$message1?>
		      <?=$mem_ns?>
		      </a></font> <BR>
		      <?=$enrns?>
			  
			  
		      <br>
		      <strong><font color=lightgreen>
		        <?=$statusns?>
		        </font></strong> <br>
	        <a href=""><font color=white>View Details</font></a> </div></td>
		    <td colspan="3" align="center" valign="middle" background="images/tree_09.gif"><div align="center" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-weight:bold; font-size:11px;margin:10px 10px 10px 10px;"> <a href=# color=white><font color=white>
<?
 					$sqld="select * from personally_enrolled where enroller_id='".$enr."'";
 					$queryd=mysql_query($sqld)or die(mysql_error());
 					$resultd=mysql_fetch_array($queryd);
					$left_mem=$resultd['left_mem'];
					$test="left_mem";
					
					if($left_mem==$test)
					{
					$queryfa  = "SELECT * from members where enroller_id='".$enr."' and direction='".$left_mem."'";
					
					$queryfa=mysql_query($queryfa);
 					$resultfa=mysql_fetch_array($queryfa);
					//print_r($resulta);
					$enf=$resultf['enrolled_id'];
					//$enroller_id2=$results['enroller_id'];
					$memssa=$resultfa['mem_name'];
					//$mem_name = ereg_replace("[ \t\n\r]+", "_", $mem_name);
					$mem_nfa=str_replace("_"," ",$memssa);
					$statusafa=$resultf['statuse'];
					//$directiona=$resulta['direction'];
				
				 
		  
		  }
				else
				{
					if($left_mem==NULL)
				{
					$message2="Not Available";
				}
				//$message2="Available";
				}
				  ?>
		          <? //=$message2?>
		          <?=$mem_nfa?>
	            </a></font> <BR>
	            <?=$enfa?>
	            <br>
	            <strong><font color=lightgreen>
	            <?=$statusafa?>
	            </font></strong> <br>
            <a href=""><font color=white>View Details</font></a> </div></td>
		    <td>&nbsp;</td>
		    <td colspan="2" align="center" valign="middle" background="images/tree_09.gif"><div align="center" style="font-family:Verdana, Arial, Helvetica, sans-serif;
			font-weight:bold; font-size:11px;margin:10px 10px 10px 10px;"> <font color=white><a href=# color=white>
		      <?
 					$sqlqat="select * from personally_enrolled where enroller_id='".$enrn."'";
 					$queryqat=mysql_query($sqlqat)or die(mysql_error());
 					$resultqat=mysql_fetch_array($queryqat);
					$right_mem=$resultqat['right_mem'];
					$test="right_mem";
					
					if($right_mem==$test)
					{
					$querynai  = "SELECT * from members where enroller_id='".$enrn."' and direction='".$right_mem."'";
					
					$querysnai=mysql_query($querynai);
 					$resultnai=mysql_fetch_array($querysnai);
					//print_r($resultn);
					$enrnai=$resultnai['enrolled_id'];
					//$enroller_id2=$results['enroller_id'];
					$memna=$resultnai['mem_name'];
					//$mem_name = ereg_replace("[ \t\n\r]+", "_", $mem_name);
					$mem_nnai=str_replace("_"," ",$memna);
					$statusnai=$resultn['statuse'];
					//$directiona=$resultae['direction'];
				
				 
		  
		  }
				else
				{
					if($left_mem==NULL)
				{
					$message2="Not Available";
				}
				//$message2="Available";
				}
				  ?>
				  
				  
				  
		      <?=$message1?>
		      <?=$mem_nnai?>
		      </a></font> <BR>
		      <?=$enrna?>
			  
			  
		      <br>
		      <strong><font color=lightgreen>
		        <?=$statusni?>
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