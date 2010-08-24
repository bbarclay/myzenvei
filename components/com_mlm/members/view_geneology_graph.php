<?php
ob_start();
include ("settings.inc");
 include_once '../../../clients/zenvieConfig.php';


if (isset($_GET['tree_Id'])) {
	$user_id = $_GET['tree_Id'];
	}
else{
$user_id=$CustomUid;}
?>
<!--<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"> -->
<!DOCTYPE HTML>


<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<style>
   
   #svgbasics {
		position: absolute;
		left: 0px; top: 0px;
		border: solid 0px #484; 
		z-index: -100;
	}
	
.tooltip { background-repeat:no-repeat; 
	
	padding:10px 30px 10px 20px;
	height:400px;	
	width:400px;
	font-size:9px;
	color:white;
}
.tooltip .label {
	color:yellow;
	width:100px;
    font-size:9px;  
}
.tooltip .label2 {
	color:white;
    font-size:9px;  
}
	
	
.o1 { 
	
	 
               
}

.o1  img { margin: -30px; 
	
}

.o2 { 
	
	 
               
}

.o2  img{ margin: -30px;  
	
}

.o3 { 
	
	 
               
}

.o3 img{ margin: -30px; 
	
}

.o4 { 
	
	 
               
}

.o4 img{ margin: -30px; 
	
}

.o5 { 
	
	 
               
}

.o5 img{ margin: -30px;  
	
}


	</style>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js" type="text/javascript"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.0/jquery-ui.min.js" type="text/javascript" ></script>	
<script  src="scripts/jquery.jqDock.min.js" type="text/javascript" ></script> 
<script src="scripts/jquery_002.js" type="text/javascript" ></script> 

 


    <script type='text/javascript'> 
    $(document).ready(function(){		
		
		$(".o1").jqDock({size:80,distance:80,coefficient:1.0,duration:500,align:'middle',labels:false,source:false,loader:null});
		$(".o2").jqDock({size:50,distance:54,coefficient:1.0,duration:500,align:'middle',labels:false,source:false,loader:null});
		$(".o3").jqDock({size:30,distance:35,coefficient:1.0,duration:500,align:'middle',labels:false,source:false,loader:null});
		
		$(".o4").jqDock({size:70,distance:70,coefficient:1.0,duration:500,align:'middle',labels:false,source:false,loader:null});
		
		$(".o5").jqDock({size:40,distance:54,coefficient:1.0,duration:500,align:'middle',labels:false,source:false,loader:null});		
		
		
		});
	</script>
    






<?php
$link = 'http://localhost/Brandons/site/component/com_mlm/members/images/';

$fishobj=array();
$fishname=1;
$level1_list=array();
$level2_list=array();
$level3_list=array();
$level4_list=array();
$img_id=0;

function displayTree($root,$level,$position)
{
	global $level1_list;
	global $img_id;
	$query = "SELECT * FROM mlm_geneology_tree where parentid = '$root'"; 
	$result = mysql_query($query);
	$numrows =  mysql_num_rows($result);
	
	
	if( $level==0){
		$query2 = "SELECT thumb FROM  jos_community_users where userid = '$root'"; 
		$result2 = mysql_query($query2);
		$row2 = mysql_fetch_array($result2);
		$img = '../../../'.$row2['thumb'];
		
		
		
		echo"<div >";
			
			echo "<a href='#' >
			<img id='root_id' style=' position:absolute; left:575px;'width=100px height=100px 
			src='$img' onmouseover='showUser($root)' onmouseout='blank()' ></a>"; 
		echo"<div  style=' position:absolute; top:140px; left:370px;' >";
		
		
			$query2 = "SELECT * FROM mlm_geneology_tree where parentid = '$root'"; 
			$result2 = mysql_query($query2);
			$numrows2 =  mysql_num_rows($result2);
			while ($row = mysql_fetch_array($result2)){
			$img_id++;				
			$root_id=$row['userid'];
			
			$query3 = "SELECT thumb FROM  jos_community_users where userid = '$root_id'"; 
			$result3 = mysql_query($query3);
			$row3 = mysql_fetch_array($result3);
			$numrows3 =  mysql_num_rows($result3);
			$img=  '../../../'.$row3['thumb'];		
			//$img=$row3['thumb'];
			
	
			echo "<a href='view_geneology_graph.php?tree_Id=$root_id' >
			<img id='$img_id' style='width:100px; height:100px; margin-left:35px; margin-right:35px;' src='$img' onmouseover='showUser($root_id)' onmouseout='blank()'>
			</a>";  
			$level1_list[]=$img_id;
			}
			
			for( $i=$numrows2; $i< 3; $i++)
			{
				$img_id++;				
								
	
			echo "<a href='#' ><img id='$img_id' style='width:100px; height:100px; margin-left:35px; margin-right:35px;' src='images/empty.jpg'>"."</a>";  
			$level1_list[]=$img_id;
				
			
			
			}
			
			
	echo"</div>";
	}
	
		
		
	if(  $level<4)
		{	
														//fisho($root, $level, $position);
			$level++;
			while ($row = mysql_fetch_array($result)){
		    $root = $row['userid'];
			if ($row['position']=="L"){ $fishobj2=array(); $fishobj2[]=$root; left_tree($fishobj2,$level,100,'L'); }
			if ($row['position']=="R"){ $fishobj2=array();  $fishobj2[]=$root; left_tree($fishobj2,$level,100,'R');  }
			if ($row['position']=="M"){	$fishobj2=array();  $fishobj2[]=$root; $fishobj2=getlist($fishobj2); lfisho($fishobj2,$level,0,0,'M');
					displayTree($root,$level,$row['position']);
					}
			}
			
		for( $i=$numrows; $i< 3; $i++)
			{
			if ($i ==0){ $fishobj2=array();  $fishobj2[]=$root; left_tree($fishobj2,$level,100,'L'); }
			if ($i ==2){ $fishobj2=array();  $fishobj2[]=$root; left_tree($fishobj2,$level,100,'R');  }
			if ($i ==1){ $fishobj2=array();  $fishobj2[]=$root; $fishobj2=getlist($fishobj2); lfisho($fishobj2,$level,0,0,'M');
					displayTree($root,$level,$row['position']);
					}	
				
			}
		
	}
	

}










function left_tree($root,$level,$value,$pos){

$count=1;
while ($level <4){
$level++;
$root=getlist($root, $level);
lfisho($root,$level,$value,$count,$pos);
$value-=150;
$count++;


 }
}

function getlist($fishobj2)
{	$fishobj3=array();
	foreach ($fishobj2 as $obj){
		
		
		$query = "SELECT * FROM mlm_geneology_tree where parentid = '$obj'"; 
		$result = mysql_query($query);
		$numrows =  mysql_num_rows($result);
		while ($row = mysql_fetch_array($result)){
		$fishobj3[]=$row['userid'];
		}
		if($numrows<3){for($i=$numrows; $i<3; $i++ ) $fishobj3[]='-1';}
	}
		
		return $fishobj3;
	
}



function lfisho($fishobj5,$level,$value,$count,$pos){

global $level2_list;
global $level3_list;
global $level4_list;
global $img_id;

if($pos=='L'){


if($level==2 && $count==1){ $x=250; $y=250; $temp=20; $tempx=8; $id='o1';}
if($level==3 && $count==2){ $x=100; $y=350; $temp=12; $tempx=12; $id='o2';}
if($level==4 && $count==3){ $x=0; $y=400; $temp=7; $tempx=7; $id='o3';}
if($level==5 && $count==4){ $x=10; $y=420; $temp=2; $tempx=2; $id=2;}

if($level==3 && $count==1){ $x=390; $y=370; $temp=20; $tempx=20; $id="o4";}
if($level==4 && $count==2){ $x=270; $y=500; $temp=10; $tempx=10; $id="o5";}
if($level==5 && $count==3){ $x=350; $y=750; $id="";}

if($level==4 && $count==1){ $x=420; $y=500; $temp=20; $tempx=20; $id="o2";}
if($level==5 && $count==2){ $x=500; $y=750; $id="";}

//if($level==5 && $count==1){ $x=1000; $y=750; $id="";}
}

if($pos=='R'){

if($level==2 && $count==1){ $x=880; $y=330;  $temp=-20; $tempx=8; $id='o1';}
if($level==3 && $count==2){ $x=960; $y=450; $temp=-12; $tempx=12; $id='o2';}
if($level==4 && $count==3){ $x=980; $y=600; $temp=-7; $tempx=7; $id='o3'; }
if($level==5 && $count==4){ $x=1400; $y=800; $temp=2; $tempx=-2; $id=2;}

if($level==3 && $count==1){ $x=710; $y=450; $temp=-20; $tempx=20; $id="o4";}
if($level==4 && $count==2){ $x=840; $y=600; $temp=-10; $tempx=10; $id="o5";}
if($level==5 && $count==3){ $x=1420; $y=750; $id="";}

if($level==4 && $count==1){ $x=680; $y=580; $temp=-20; $tempx=20; $id="o2";}
if($level==5 && $count==2){ $x=1370; $y=750; $id="";}

//if($level==5 && $count==1){ $x=1500; $y=750; $id="";}
}


if($pos=='M'){
$tempx=40;
$temp=0;
$level+=1;
if($level==2 ){ $x=481; $y=280; $id="o1";}
if($level==3 ){ $x=510; $y=440; $id="o2";}
if($level==4 ){ $x=510; $y=580; $id="o2";}
if($level==5 ){ $x=780; $y=760; $id="o1";}
}

if($pos!='M'){
?>									  
	<div  class="<?php echo $id; ?>"  style=" position:absolute; <?php echo 'left:'.$x.'px; top:'.$y.'px;'; ?>">
	<?php
		
		
		$cordx=$tempx; $cordy=$temp;
		
		
		foreach ($fishobj5 as $obj)
		{						
		if ($obj != '-1' && $obj !=1){
			
		$query = "SELECT * FROM mlm_geneology_tree where userid = '$obj'"; 
		$result = mysql_query($query);
		$row = mysql_fetch_array($result);
		$root_id=$row['userid'];
		
		
		$query2 = "SELECT thumb FROM  jos_community_users where userid = '$obj'"; 
		$result2 = mysql_query($query2);
		$row2 = mysql_fetch_array($result2);
	?>  
		
	<a href="view_geneology_graph.php?tree_Id=<?php echo $root_id; ?>"><img id="<?php $img_id++; echo $img_id; if ($level==2){$level2_list[]=$img_id;} else if($level==3){$level3_list[]=$img_id;} else if($level==4){$level4_list[]=$img_id; }?>" onMouseOver="showUser(<?php echo $root_id; ?>)" onMouseOut="blank()" src="../../../<?php echo $row2['thumb']; ?>" style="<?php echo 'left:'.$cordx.'px;top:'.$cordy.'px;'; $cordx+=$tempx; $cordy+=$temp; ?>" /> </a>
	<?php
		}
	      else{
			  ?>
              <img id="<?php $img_id++; echo $img_id; if ($level==2){$level2_list[]=$img_id;} else if($level==3){$level3_list[]=$img_id;} else if($level==4){$level4_list[]=$img_id; }?>" src="images/empty.jpg" style=" <?php echo 'left:'.$cordx.'px;top:'.$cordy.'px;'; $cordx+=$tempx; $cordy+=$temp; ?>" />
              <?php
			  
			  }
	
	  }
	   
	  
	?>
            
	</div>	
	<?php
}

if($pos=='M' && $level !=5){
//----------------------pos==m
?>
	<div  class="<?php echo $id; ?>"  style=" position:absolute; <?php echo 'left:'.$x.'px; top:'.$y.'px;'; ?>">
	<?php
		
		
		$cordx=$tempx; $cordy=$temp;
		
		$counter=0;
		foreach ($fishobj5 as $obj)
		{$counter ++;						
		if ($obj != '-1' && $obj !=1){
			
		$query = "SELECT * FROM mlm_geneology_tree where userid = '$obj'"; 
		$result = mysql_query($query);
		$row = mysql_fetch_array($result);
		$root_id=$row['userid'];
		
		
		$query2 = "SELECT thumb FROM  jos_community_users where userid = '$obj'"; 
		$result2 = mysql_query($query2);
		$row2 = mysql_fetch_array($result2);
		
	?>  
		
	<a href="view_geneology_graph.php?tree_Id=<?php echo $root_id; ?>"><img id="<?php $img_id++; echo $img_id; if ($level==2){$level2_list[]=$img_id;} else if($level==3){$level3_list[]=$img_id;} else if($level==4){$level4_list[]=$img_id; }?>"  onmouseover="showUser(<?php echo $root_id; ?>)" onMouseOut="blank()"  src="../../../<?php echo $row2['thumb'];?>" style=" <?php echo 'left:'.$cordx.'px;top:'.$cordy.'px;'; $cordx+=$tempx; ($counter==1)?$cordy=40:$cordy=0; ?>" /> </a>
	<?php
		}
	      else{
			  ?>
              <img  id="<?php $img_id++; echo $img_id; if ($level==2){$level2_list[]=$img_id;} else if($level==3){$level3_list[]=$img_id;} else if($level==4){$level4_list[]=$img_id; }?>" src="images/empty.jpg" style=" <?php echo 'left:'.$cordx.'px;top:'.$cordy.'px;'; $cordx+=$tempx; $cordy+=$temp; ?>" />
              <?php
			  
			  }
	
	  }
	   
	  
	?>
            
	</div>
	
	<?php
	
	
	
//--------------end
}
  }


 

//-------------------------------draw lines-----------------------------------
?>


<script type="text/javascript" language="javascript">

       

		function svgDrawLine( eTarget, eSource, level, col ) {
		
			setTimeout(function(){		// wait 1 sec before draw the lines, so we can get the position of the draggable
		
				var $source = eSource;
				var $target = eTarget;
				
				// origin -> ending ... from left to right
				var originX = $source.offset().left + $source.width() + 20 + 4; // 10 + 10 (padding left + padding right) + 2 + 2 (border left + border right)
				var originY = $source.offset().top + (($source.height() + 20 + 4) / 2);
				
				var endingX = $target.offset().left;
				var endingY = $target.offset().top + (($target.height() + 20 + 4) / 2);
					
				// draw lines
				var svg = $("#svgbasics");
				
				var space = 20;
				var color=0;
				if (col==0){ color = "#6699FF"; }//colours[random(9)];
				if (col==1){ color = 'black'; }
				if (col==2){ color = "#00CC99"; }
				// drawLine(X1, Y1, X2, Y2);
				//{stroke: 1, color: 'black', opacity: 1, backgroundImage: 'none'}
				
				//svg.drawLine(originX, originY, originX + space, originY, { 'color': color, 'stroke': 2 }); // beginning		
				
				if (level==1 || level ==2){
				svg.drawLine(originX-74 , originY-16, endingX+55 , endingY-10, { 'color': color, 'stroke': 2 });}
				if (level==3 ||level==4){
				svg.drawLine(originX-60 , originY, endingX+20 , endingY-25, { 'color': color, 'stroke': 2 });} // diagonal line	
				//svg.drawLine(endingX - space, endingY, endingX, endingY, { 'color': color, 'stroke': 2 }); // ending
			}, 1000);
		}
 
		function random(range) {
			return Math.floor(Math.random() * range);
		}
		
		var colours = ['purple', 'red', 'orange', 'yellow', 'lime', 'green', 'blue', 'navy', 'black'];
		 
		
    </script>
    
<!--  ----------------------------------tool tip--------------------------  -->
<script>  
function blank(){
  document.getElementById("txtHint").innerHTML="";	
  document.getElementById("txtHint").style.backgroundImage = "";  
	}

function showUser(str)
{
	
	
document.getElementById("txtHint").style.backgroundImage = "url(images/black_arrow.png)";        
	
if (str=="")
  {
  document.getElementById("txtHint").innerHTML="";
  return;
  } 
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("txtHint").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","getuser.php?q="+str,true);
xmlhttp.send();
}


</script>    
 
 
 <SCRIPT language="JavaScript">
function checker(){
var browserName=navigator.appName; 

 if (browserName=="Microsoft Internet Explorer")
 {
  alert(1);
 }
 else 
 return 0;

}

</SCRIPT>   

<title>Tree</title>
</head>
<body >
<?php 
$checkbrowser=0;

    if (isset($_SERVER['HTTP_USER_AGENT']) && 
    (strpos($_SERVER['HTTP_USER_AGENT'], 'Firefox') !== false))
        $checkbrowser=1;
    else
       	$checkbrowser=0;

 

?>

<a href="http://www.myzenvei.com/index.php?option=com_mlm&amp;view=apps">Control Panel
</a>&nbsp; &nbsp;<a href="view_geneology_graph.php?tree_Id=<?php echo $CustomUid;?>">Parent Tree</a>
&nbsp; &nbsp;<a href="http://www.myzenvei.com/index.php?option=com_community&view=profile&userid=<?php echo $CustomUid;?>&Itemid=15">Profile</a>

<?php if ($checkbrowser!=1){ ?>
<div style="height: 1000px; width: 1200px; position:absolute; background:url(images/back1.png); background-repeat:no-repeat; top:33px;" id="svgbasics"></div>
<?php } else {?>
<div style="height: 1000px; width: 1200px; position:absolute;" id="svgbasics"></div>
<?php } ?>	
<div id="txtHint" style="position:absolute; left:5px; top:41px"  class="tooltip"><b>Person info will be listed here.</b></div>
		
<?php


//*************************end*************************************	


displayTree($user_id,0,'M');
		 
?>
<?php

//draw lines
global $level1_list;
global $level2_list;
global $level3_list;
global $level4_list;

if ($checkbrowser==1){

//--level 0 and 1

for ($i=0; $i < 3; $i++){
echo "<SCRIPT LANGUAGE='javascript'>";
echo "svgDrawLine( \$(document.getElementById('$level1_list[$i]')), \$(document.getElementById('root_id')),1,$i);" ; 
echo "</script>";
}

//--level 1 and 2
$count=0;
$count2=3;
for ($i=0; $i < 3; $i++){$col=0;
	for ($j=$count; $count<$count2; $j++,$count++,$col++){
echo "<SCRIPT LANGUAGE='javascript'>";
echo "svgDrawLine( \$(document.getElementById('$level2_list[$j]')), \$(document.getElementById('$level1_list[$i]')),2,$col);"; 
echo "</script>";

	}$count2+=3;
}


//--level 2 and 3
$count=0;
$count2=3;
for ($i=0; $i < 9; $i++){$col=0;
	for ($j=$count; $count<$count2; $j++,$count++,$col++){
echo "<SCRIPT LANGUAGE='javascript'>";
echo "svgDrawLine( \$(document.getElementById('$level3_list[$j]')), \$(document.getElementById('$level2_list[$i]')),3,$col);"; 
echo "</script>";

	}$count2+=3;
}

//--level 2 and 3
$count=0;
$col2=0;
$count2=3;
for ($i=0; $i < 27; $i++){$col=0;
	for ($j=$count; $count<$count2; $j++,$count++,$col++){
echo "<SCRIPT LANGUAGE='javascript'>";
echo "svgDrawLine( \$(document.getElementById('$level4_list[$j]')), \$(document.getElementById('$level3_list[$i]')),4,$col);"; 
echo "</script>";

	}$count2+=3;
}
}

?>

</body>
</html>

<?php ob_end_flush();?>