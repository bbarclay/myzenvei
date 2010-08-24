<?php
ob_start();
include ("settings.inc");
$q=$_GET["q"];
?>
<head>
</head>
<body>



<?php 



$query = "SELECT * FROM reports where user_id = $q"; 
		$result = mysql_query($query);
		$numrows =  mysql_num_rows($result);
		while ($row = mysql_fetch_array($result)){
		
				 $L1=$row['check_all_comm']; 
				 $L2=$row['fast_start'];	
				 $L3=$row['commission']; 
				 $L4=$row['pref_cust_comm'];
				 $L5=$row['match_all']; 
				 $L6=$row['match_fast'];
				 $L7=$row['match_comm']; 
				 $L8=$row['match_pref_cust'];
				 $M1=$row['status_all'];
				 $M2=$row['down_assoc']; 
				 $M3=$row['pend_assoc'];
				 $M4=$row['active_assoc'];
				 $M5=$row['innactive_assoc'];
				 $M6=$row['pend_auto'];
				 $M7=$row['pend_active'];
				 $R1=$row['level_all'];
				 $R2=$row['show_name'];
				 $R3=$row['show_personal'];
				 $R4=$row['show_phone'];
				 $R5=$row['check_sub_all'];
				 $R6=$row['level_one'];
				 $R7=$row['level_two'];
				 $R8=$row['level_three'];
				 $R9=$row['level_four'];
				 $R10=$row['level_five'];
				 $R11=$row['level_six'];
				 $R12=$row['level_seven'];
				 $R13=$row['level_eight'];
				 $R14=$row['level_nine'];
				 $R15=$row['start_date'];
				 $R16=$row['end_date'];
				 
				?>
			
<a href='#' onclick="status3( <?php echo $L1;?>, <?php echo $L2;?>, <?php echo $L3;?>, <?php echo $L4;?>, <?php echo $L5;?>, <?php echo $L6;?>, <?php echo $L7;?>
, <?php echo $L8;?>, <?php echo $M1;?>, <?php echo $M2;?>, <?php echo $M3;?>, <?php echo $M4;?>, <?php echo $M5;?>, <?php echo $M6;?>, <?php echo $M7;?>, <?php echo $R1;?>, <?php echo $R2;?>, <?php echo $R3;?>, <?php echo $R4;?>, <?php echo $R5;?>, <?php echo $R6;?>, <?php echo $R7;?>, <?php echo $R8;?>, <?php echo $R9;?>, <?php echo $R10;?>, <?php echo $R11;?>, <?php echo $R12;?>, <?php echo $R13;?>, <?php echo $R14;?>, '<?php echo $R15;?>', '<?php echo $R16;?>' )"><?php echo $row['report_name']?></a><br/>

		<?php	

		}

ob_end_flush(); 
?>
