<?
  session_start();
 include('settings.inc');
 include('header.php');
 $user=$_SESSION['username'];
 $pass=$_SESSION['password'];
 $sql="select * from company where username='".$user."' and password='".$pass."'";
 $query=mysql_query($sql);
 $result=mysql_fetch_array($query);
 $comp=$result['companyname'];
 $street=$result['street'];
 $city=$result['city'];
 $state=$result['state'];	
 $zip=$result['zip'];
 $phone=$result['phone'];
 $mail=$result['email'];
 $id=$result['compid'];
if(isset($_GET['mode']))
		{
			$mode=$_GET['mode'];
    		if($mode=="add")
			{
				$message="Fares Updated Successfully.";

			}
		}
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

if(trim($_POST['airport'])==''){
				$message1[0] = "Airport Name Required";
			}
if(trim($_POST['city'])==''){
				$message1[1] = "City Required";
			}
$air=$_POST['airport'];
$cit=$_POST['city'];

if(empty($message1))
		{
				header('location:edit_fare.php?id='.$id.'&airport='.$air.'&city='.$cit);	
		}
}

?>
 <script>
 function change_airport()
{
	document.form1.action="fare_update.php?m=cs";
	document.form1.submit();
}

 </script>
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
                      Fill the following information  - </font></div></td>
                </tr>
                <tr> 
                  <td width="24%" height="15" bgcolor="#FFFFFF" class="blue_txt"><div align="right"><font color="#990000"><strong><font size="1" face="Verdana, Arial, Helvetica, sans-serif">Airport 
                      Name :</font></strong></font></div></td>
                  <td bgcolor="#FFFFFF" class="blue_txt">
                  <select name="airport" onChange="javascript:change_airport();">
                  <option value="">Select Any</option>
                  <?
				  		$sql1="select distinct airport from ".$comp."";
						$query1=mysql_query($sql1);
						while($result=mysql_fetch_array($query1))
						{
						$airname=$result['airport'];
						$as=str_replace("\\","",$airprt);
						
				  ?>
                  <option value="<?=$airname;?>" <? if($airname==$as) echo "selected";?>><?=$airname;?></option>
                  <?
				  }
				  ?>
                  </select>
                    &nbsp;<font color="#000000"><strong><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><? echo $message1[0];?></strong></font></td>
                </tr>
                                <tr> 
                  <td width="24%" height="15" bgcolor="#FFFFFF" class="blue_txt"><div align="right"><font color="#990000"><strong><font size="1" face="Verdana, Arial, Helvetica, sans-serif">City 
                       :</font></strong></font></div></td>
                  <td bgcolor="#FFFFFF" class="blue_txt">
                  <select name="city">
                                <option value="">Select Any</option>
                      <?	
                          if($no_of_city>0)
					      {
						   		while($city_data=mysql_fetch_array($city_list))
							{
                                 $city=$city_data['city'];

					  ?>
                      <option value="<?=$city;?>"><?=$city;?></option>
                      <?
					  }
					  }
					  ?>

                                </select>
                                &nbsp;<font color="#000000"><strong><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><? echo $message1[1];?></strong></font>
                    </td>
                </tr>

                <tr> 
                  <td height="15" bgcolor="#FFFFFF" class="blue_txt">&nbsp;</td>
                  <td height="15" bgcolor="#FFFFFF" class="blue_txt"><input type="submit" name="Submit"  onclick="" value="Go Next"></td>
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
