<?php header("Content-type: text/css"); ?>
/* Default style. No need to change */

.pcdtr {
    text-decoration:none !important;
}

.pcdtr a{
    cursor:pointer;
    text-decoration:none !important;
}
.pcdtr a:hover span {
    /*background-position:left bottom;*/
    background-attachment:scroll !important;
    background-attachment:fixed;
}
.pcdtr span {
    display:inline-block;
    background-repeat:no-repeat;
    overflow:hidden;
    line-height:999px;
    letter-spacing:-999px;
<?php 
$ua=$_SERVER['HTTP_USER_AGENT'];
$pos=strpos($ua, 'Firefox/');
if($pos!==false){
	$v=substr($ua,$pos+8,1);
	if($v<3)echo 'display:-moz-inline-box;';	
}	
?>
}

@media print{
    .pcdtr span {
        background-image:none;
        display:inline;
        line-height:normal;
        letter-spacing:0;
    }
}

