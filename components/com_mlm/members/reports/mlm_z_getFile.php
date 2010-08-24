<?php
ob_start();
include ("settings.inc");
include_once '../../../../clients/zenvieConfig.php';
$q=$CustomUid;//$_GET["q"];
//$q=$_GET["q"];
$q2=$_GET["q2"];
$q3=$_GET["q3"];
$q4=$_GET["q4"];
$q5=$_GET["q5"];
$q6=$_GET["q6"];
$q7=$_GET["q7"];
$q8=$_GET["q8"];
$q9=$_GET["q9"];
$q10=$_GET["q10"];
$q11=$_GET["q11"];
$q12=$_GET["q12"];
$q13=$_GET["q13"];
$q14=$_GET["q14"];
$q15=$_GET["q15"];
$q16=$_GET["q16"];
$q17=$_GET["q17"];
$q18=$_GET["q18"];
$q19=$_GET["q19"];
$q20=$_GET["q20"];
$q21=$_GET["q21"];
$q22=$_GET["q22"];
$q23=$_GET["q23"];
$q24=$_GET["q24"];
$q25=$_GET["q25"];
$q26=$_GET["q26"];
$q27=$_GET["q27"];
$q28=$_GET["q28"];
$q29=$_GET["q29"];
$q30=$_GET["q30"];
$q31=$_GET["q31"];
$q32=$_GET["q32"];
$q33=$_GET["q33"];

$date = strtotime( $q31 );
$sDate = date( 'y-m-d', $date );
$curdate = date('y-m-d');

$date = strtotime( $q32 );
$eDate = date( 'y-m-d', $date );
$numrows=0;
$query="SELECT * FROM reports"; 
$result=mysql_query($query);
$numrows=mysql_num_rows($result);
$numrows++;

$query2="INSERT INTO reports VALUES('$numrows','12', '$q33', '$q2', '$q3', '$q4', '$q5', '$q6', '$q7', '$q8', '$q9', '$q10', '$q11', '$q12', '$q13', '$q14', '$q15', '$q16', '$q17', '$q18', '$q19', '$q20', '$q21', '$q22', '$q23', '$q24', '$q25', '$q26', '$q27', '$q28', '$q29', '$q30', '$sDate' , '$eDate','$curdate','$q')";
//$query3="INSERT INTO reports (report_id, user_id, report_name, check_all_comm, fast_start) VALUES('$numrows','$q', '$q33', $q2, $q3)";
$result2=mysql_query($query2) or mysql_error();
ob_end_flush();
?>