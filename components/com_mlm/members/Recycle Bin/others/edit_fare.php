<?
  session_start();
 include('settings.inc');
 include('header.php');
 $user=$_SESSION['username'];
 $pass=$_SESSION['password'];
	$id=$_REQUEST['id'];
	$airpo=$_REQUEST['airport'];
	$airport=str_replace('\\',"",$airpo);
	$city=$_REQUEST['city'];

 $sql="select * from company where username='".$user."' and password='".$pass."'";
 $query=mysql_query($sql);
 $result=mysql_fetch_array($query);
 $comp=$result['companyname'];
if(isset($_GET['m']))
{
	$mode=$_GET['m'];
	if($mode=="cs")
	{
		 $sql="select * from company where username='".$user."' and password='".$pass."'";
		 $query=mysql_query($sql);
		 $result=mysql_fetch_array($query);
		 $comp=$result['companyname'];
		  $id=$result['compid'];


		$airprt=$_POST['airport'];
		if($airprt<>"")
		{
			$sql="select distinct city from ".$comp." where airport='".$airprt."' and cid='".$id."'";
			$city_list=mysql_query($sql);
			$no_of_city=mysql_num_rows($city_list);

		}
	}
}

 if( $_POST['Submit'])
{
$stop=$_POST['stop'];
$peak=$_POST['peak'];
$meet=$_POST['meet'];
$tip=$_POST['tip'];
$tax=$_POST['tax'];
	$sql="update ".$comp." set passenger1='".$p1."',passenger2='".$p2."',passenger3='".$p3."',passenger4='".$p4."',passenger5='".$p5."',passenger6='".$p6."',passenger7='".$p7."',passenger8='".$p8."',passenger9='".$p9."',passenger10='".$p10."',passenger11='".$p11."',passenger12='".$p12."',passenger13='".$p13."',passenger14='".$p14."',passenger15='".$p15."',passenger16='".$p16."',passenger17='".$p17."',passenger18='".$p18."',passenger19='".$p19."',passenger20='".$p20."',passenger21='".$p21."',passenger22='".$p22."',passenger23='".$p23."',passenger24='".$p24."',passenger25='".$p25."',passenger26='".$p26."',passenger27='".$p27."',passenger28='".$p28."',passenger29='".$p29."',passenger30='".$p30."',passenger31='".$p31."',passenger32='".$p32."',passenger33='".$p33."',passenger34='".$p34."',passenger35='".$p35."',passenger36='".$p36."',passenger37='".$p37."',passenger38='".$p38."',passenger39='".$p39."',passenger40='".$p40."',passenger41='".$p41."',passenger42='".$p42."',passenger43='".$p43."',passenger44='".$p44."',passenger45='".$p45."',passenger46='".$p46."',passenger47='".$p47."',passenger48='".$p48."',passenger49='".$p49."',passenger50='".$p50."',stopfee='".$stop."',peakfee='".$peak."',meetfee='".$meet."',tip='".$tip."',tax='".$tax."' where airport='".$airport."' and city='".$city."' and cid='".$id."'";
	$query=mysql_query($sql);
	header('location:fare_update.php?mode=add');

}

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
             <form enctype="multipart/form-data"  method="post"  name="form1" action="">
               
              <table width="95%" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#D4D4C8">
                <?php
				if($message != "")
				{
				?>
                <tr align="center"> 
                  <td height="19" colspan="2" bgcolor="#EFEFE7" class="blue_txt"><font color="#FF0000" size="2" face="Verdana, Arial, Helvetica, sans-serif"><strong><?php echo $message;?> 
                    </strong></font></td>
                </tr>
                <?php
				}
				?>
                <tr> 
                  <td height="19" colspan="2" bgcolor="#EFEFE7" class="blue_txt"><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong>:: 
                    &nbsp;Update Fares</strong></font></td>
                </tr>
                <tr> 
                  <td height="15" colspan="2" bgcolor="#FFFFFF" class="blue_txt"><div align="justify"><font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 
                      The following information is Available - </font></div></td>
                </tr>
                <tr> 
                  <td width="24%" height="15" bgcolor="#FFFFFF" class="blue_txt"><div align="right"><font color="#990000"><strong><font size="1" face="Verdana, Arial, Helvetica, sans-serif">Airport 
                      Name :</font></strong></font></div></td>
                  <td bgcolor="#FFFFFF" class="blue_txt">
                  <?=$airport;?>                    </td>
                </tr>
                                <tr> 
                  <td width="24%" height="15" bgcolor="#FFFFFF" class="blue_txt"><div align="right"><font color="#990000"><strong><font size="1" face="Verdana, Arial, Helvetica, sans-serif">City 
                       :</font></strong></font></div></td>
                  <td bgcolor="#FFFFFF" class="blue_txt">
                  <?=$city;?>                    </td>
                </tr>
                           <?
						      $sql1="select * from ".$comp." where airport='".addslashes($airport)."' and city='".$city."' and cid='".$id."'";
							  $query1=mysql_query($sql1);
							  $result1=mysql_fetch_array($query1);
							?>
                   	       <tr>
                   	         <td bgcolor="#FFFFFF" class="blue_txt"><div align="right"><font color="#990000"><strong><font size="1" face="Verdana, Arial, Helvetica, sans-serif">Additional Stop Fee</font></strong></font></div></td>
                              <td bgcolor="#FFFFFF" class="blue_txt">
                                <div align="left">
                                  <input type="text" name="stop" value="<?=$result1['stopfee'];?>">
                                </div></td>
                           </tr>
                   	       <tr>
                   	         <td bgcolor="#FFFFFF" class="blue_txt"><div align="right"><font color="#990000"><strong><font size="1" face="Verdana, Arial, Helvetica, sans-serif">Off-Peak Hours Fee</font></strong></font></div></td>
                              <td bgcolor="#FFFFFF" class="blue_txt">
                                <div align="left">
                                  <input type="text" name="peak" value="<?=$result1['peakfee'];?>">
                                </div></td>
                           </tr>
                   	       <tr>
                   	         <td bgcolor="#FFFFFF" class="blue_txt"><div align="right"><font color="#990000"><strong><font size="1" face="Verdana, Arial, Helvetica, sans-serif">Meet & Greet / Check In Fee</font></strong></font></div></td>
                              <td bgcolor="#FFFFFF" class="blue_txt">
                                <div align="left">
                                  <input type="text" name="meet" value="<?=$result1['meetfee'];?>">
                                </div></td>
                           </tr>
                   	       <tr>
                   	         <td bgcolor="#FFFFFF" class="blue_txt"><div align="right"><font color="#990000"><strong><font size="1" face="Verdana, Arial, Helvetica, sans-serif">Tip</font></strong></font></div></td>
                              <td bgcolor="#FFFFFF" class="blue_txt">
                                <div align="left">
                                  <input type="text" name="tip" value="<?=$result1['tip'];?>">
                                </div></td>
                           </tr>
                   	       <tr>
                   	         <td bgcolor="#FFFFFF" class="blue_txt"><div align="right"><font color="#990000"><strong><font size="1" face="Verdana, Arial, Helvetica, sans-serif">Tax</font></strong></font></div></td>
                              <td bgcolor="#FFFFFF" class="blue_txt">
                                <div align="left">
                                  <input type="text" name="tax" value="<?=$result1['tax'];?>">
                                </div></td>
                           </tr>
                           <tr>
                           <td colspan="2" bgcolor="#FFFFFF" class="blue_txt">&nbsp;</td>
                           </tr>
							<?
							  $i=1;
							  while($i<=50)
							  {
                            ?>
                   	       <tr>
                   	         <td bgcolor="#FFFFFF" class="blue_txt"><div align="right"><font color="#990000"><strong><font size="1" face="Verdana, Arial, Helvetica, sans-serif">Passenger 
               	               <?=$i;?></font></strong></font>
                   	         </div></td>
                              <td bgcolor="#FFFFFF" class="blue_txt">
                                <div align="left">
                                  <input type="text" name="p<?=$i;?>" value="<?=$result1['passenger'.$i];?>">
                                </div></td>
                           </tr>
                           <?
                           $i++;
                           }
						   ?>

                <tr> 
                  <td height="15" bgcolor="#FFFFFF" class="blue_txt">&nbsp;</td>
                  <td height="15" bgcolor="#FFFFFF" class="blue_txt"><input type="submit" name="Submit"  onClick="" value="Update"></td>
                </tr>
              </table>
              </form>
              
           
            </td>
          </tr>
        </table>
        </td>
          </tr>
        </table>

      <? include('footer.php'); ?>
