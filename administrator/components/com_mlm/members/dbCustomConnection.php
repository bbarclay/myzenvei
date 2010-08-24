<?php 
#class that will handle db operations
include_once '../../../../Database.php';

$myzDb = new Database();
$myzDb1 = new Database();
$myzDb->selectDB("myzenvei_testing"); 
$myzDb1->selectDB("myzenvei_testing"); 
?>