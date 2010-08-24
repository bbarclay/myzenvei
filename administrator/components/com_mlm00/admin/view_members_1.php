<?
 session_start();
 include('settings.inc');
 include('header.php');
 $username=$_SESSION['username'];
 $pwd=$_SESSION['pwd']; $enrolled_id=$_SESSION['enrolled_id'];
 $sql="select * from members where username='".$username."' and pwd='".$pwd."'";
 $query=mysql_query($sql);
 $result=mysql_fetch_array($query);
 $mem_name=$result['mem_name'];
 $enrolled_id=$result['enrolled_id'];
 $enroller_id=$result['enroller_id'];
 
 //$direct=$result['direction'];
 

if( $_POST)
{

if(trim($_POST['mem_name'])==''){
				$message1[0] = "Member Name Required";
			}

if(trim($_POST['address'])==''){
				$message1[1] = "Address Required";
			}

if(trim($_POST['city'])==''){
				$message1[2] = "City Name Required";
			}

if(trim($_POST['state'])==''){
				$message1[3] = "State Name Required";
			}

if(trim($_POST['zip_code'])==''){
				$message1[4] = "Zipcode Required";
			}

if(trim($_POST['hm_ph'])==''){
				$message1[5] = "Phone is Required";
			}

if(trim($_POST['email_id'])==''){
				$message1[6] = "Email ID is Required";
			}

if(trim($_POST['pwd'])==''){
				$message1[7] = "Password is Required";
			}

if(trim($_POST['username'])==''){
				$message1[8] = "Username Required";
			}

if(trim($_POST['pan_no'])==''){
				$message1[9] = "PAN No Required";
			}

//if(trim($_POST['nominee'])==''){
				//$message1[10] = "Nominee Name Required";
			//}

if(trim($_POST['enroller_un_id'])==''){
				$message1[11] = "Enrolling Under Whos ID is  Required";
			}

if(trim($_POST['direction'])==''){
				$message1[12] = "Enrolling Direction Required";
			}



$mem_name = $_POST['mem_name'];
$jn_dt = $_POST['jn_dt'];
//$l_name = $_POST['l_name'];
$address = $_POST['address'];
$city = $_POST['city'];
$state = $_POST['state'];
$zip_code = $_POST['zip_code'];
$country = $_POST['country'];
$hm_ph = $_POST['hm_ph'];
$email_id = $_POST['email_id'];
$pwd = $_POST['pwd'];
$username = $_POST['username'];
$pan_no = $_POST['pan_no'];
//$nominee = $_POST['nominee'];
$direction = $_POST['direction'];

$enroller_id = $_POST['enroller_un_id'];
$enrolled_id=$result['enrolled_id2'];
$enroller_id=$result['enroller_id'];
$real_enroller_id2=$result['real_enroller_id2'];


if(empty($message1))
		{
						

	
	
	
	
		///////     cehcking finush   ////////////////////
			
			
			
				
$sql = "insert into members (mem_name,jn_dt,address,city,state,zip_code,country,hm_ph,email_id,pwd,username,pan_no,nominee,enroller_un_id,direction,enrolled_id,enroller_id,real_enroller_id)
				
				values('".$mem_name."',
				'".$jn_dt."',
				'".$address."',
				'".$city."',
				'".$state."',
				'".$zip_code."',
				'".$country."',
				'".$hm_ph."',
				'".$email_id."',
				'".$pwd."',
				'".$username."',
				'".$pan_no."',
				'".$nominee."',
				'".$enroller_un_id."',
				'".$direction."',
				'".$enrolled_id."','".real_enroller_id."',
				'".$enroller_id."')";
				$result = mysql_query($sql)or die(mysql_error());
				
				
				$sql1="create table ".$mem_name."(cycle_id varchar(25) NOT NULL DEFAULT 1,id int(25)NOT NULL AUTO_INCREMENT,id int(25)NOT NULL DEFAULT 0,binary_rank varchar(25) NOT NULL DEFAULT 1,left_id varchar(25) NOT NULL DEFAULT 1,right_id varchar(25) NOT NULL DEFAULT 1,volume_id varchar(255) NOT NULL DEFAULT 1,enroller_id varchar(25) NOT NULL DEFAULT 1,enrolled_id varchar(25) NOT NULL DEFAULT 1,UNIQUE KEY left_id (left_id),UNIQUE KEY id (id),UNIQUE KEY right_id (right_id))";
				
				$query=mysql_query($sql1)or die(mysql_error());
							
				
				
				
							
							
				
				header('location:view_geneology.php');
		}
}

?>
