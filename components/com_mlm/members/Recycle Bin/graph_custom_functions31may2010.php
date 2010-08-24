<?php
function rebuild_tree($parent, $left) 
{   


   // the right value of this node is the left value + 1   
   $right = $left+1;   
  
   // get all children of this node   
   echo 'SELECT username FROM mlm_geneology_tree '.   
                          'WHERE parent="'.$parent.'"';
						  
   $result = mysql_query('SELECT username FROM mlm_geneology_tree '.   
                          'WHERE parent="'.$parent.'";');   
   while ($row = mysql_fetch_array($result)) {   
       // recursive execution of this function for each   
       // child of this node   
       // $right is the current right value, which is   
       // incremented by the rebuild_tree function   
       $right = rebuild_tree($row['username'], $right);  
   }   
  
   // we've got the left value, and now that we've processed   
   // the children of this node we also know the right value   
   mysql_query('UPDATE mlm_geneology_tree SET lft='.$left.', rgt='.   
                $right.' WHERE username="'.$parent.'";');   
  
   // return the right value of this node + 1   
   return $right+1;    
}   


function display_tree($root) 
{  
  
   // retrieve the left and right value of the $root node  
   $result = mysql_query('SELECT lft, rgt FROM mlm_geneology_tree '.  
                          'WHERE username="'.$root.'";');  
   $row = mysql_fetch_array($result);  
 
   // start with an empty $right stack  
   $right = array();  
 
   // now, retrieve all descendants of the $root node  
   $result = mysql_query('SELECT * FROM mlm_geneology_tree '.  
                          'WHERE lft BETWEEN '.$row['lft'].' AND '.  
                          $row['rgt'].' ORDER BY lft ASC;');  
 
 	$i=0;
   // display each row  
   while ($row = mysql_fetch_array($result)) 
   {  
     //echo $i;
	   // only check stack if there is one  
       if (count($right)>0) 
	   {  
           
		   // check if we should remove a node from the stack  
           while ($right[count($right)-1] < $row['rgt']) 
		   {  
              array_pop($right);  
           }  
  	  }  
 
	 //print_r($right);
	 // display indented node title  
	
	if($row['parentid'] == 1)
	{
		$color = "#00FF00";
	}
	else
	{
		 $color = "";
	}
	
	echo "<tr bgcolor='$color'><td >";
	 
	 echo str_repeat('&nbsp______&nbsp;',count($right)).$row['username']."(".$row['lft'].",".$row['rgt'].")";  
	 
	 echo '</td></tr>';
		// add this node to the stack  
       $right[] = $row['rgt'];  
	  //print_r($right);
   }  
}  

function insert_node($root,$node,$newuser_id,$user_cookie,$shoppergroup)
{
		$result = mysql_query('SELECT username,lft, rgt FROM mlm_geneology_tree '.  
                          'WHERE userid="'.$root.'";');  
   		$row = mysql_fetch_array($result); 
		
		$parentname = $row['username'];
		$rightval = $row['rgt'];
		
		$rightval = $rightval-1;
		$result = mysql_query('UPDATE mlm_geneology_tree SET rgt=rgt+2 WHERE rgt > '.$rightval.''); 
		$result = mysql_query('UPDATE mlm_geneology_tree SET lft=lft+2 WHERE lft > '.$rightval.'');  
   			
		$rightval = $row['rgt'];
		$left = $rightval;
		$right = $rightval+1;
		
		$Jdate = date("Y-m-d");
		
		$query2 = "SELECT * FROM mlm_geneology_tree where parentid= '$root'"; 
     	$result2 = mysql_query($query2); 
  		$numrows =  mysql_num_rows($result2);
  		if($numrows ==0){$v_position ='L';}
  		if($numrows ==1){$v_position='M';}
  		if($numrows  ==2){$v_position='R';}
  
  		//$result = "INSERT INTO tree (username,lft,rgt,parentid,parent,position)
		///			values('$node','$left','$right','$root','$parentname','$position')";  
		
		echo $result = "INSERT INTO mlm_geneology_tree "." 
						( userid, username , lft     ,  rgt      "."
						, parentid  ,  parent,sponsor_parent_id, shopperid ,position,datejoining,	status) "."
				  
				  values( '$newuser_id' ,'$node'  , '$left' , '$right'  "."
							,  '$root'  , '$parentname','$user_cookie','$shoppergroup' , '$v_position' ,'$Jdate' , '1')";  
   	
		mysql_query($result);

return 1;
}
// finding where to place the new node

$id2 = 0;
$level2 = -1;

function scan4place($root,$level)
{
	global $id2 , $level2;
	$query = "SELECT * FROM mlm_geneology_tree where parentid = '$root'"; 
	$result = mysql_query($query);
	$numrows =  mysql_num_rows($result);
	
	if($numrows < 3 )
	{
			if ($level2 == -1)
			{
				//echo $root." ".$level." ".$id2. " ".$level2."<br/>";
				$id2=$root;
				$level2=$level;
				
				
			}
			
			else if($level < $level2) 
			{
				//echo $root." ".$level." ".$id2. " ".$level2."<br/>";
				$id2=$root;
				$level2=$level;
			}
			
	}
		
	if($numrows == 3 )
	{	
			//echo "-";
			$level++;
			while ($row = mysql_fetch_array($result)){
		    $root = $row['userid'];
			//echo $row['parentid']."<br/>";
			scan4place($root,$level);
	}
}
	
return 1;
}


function calculate_commisions($root)
{

   // retrieve the left and right value of the $root node  
   $result = mysql_query('SELECT lft, rgt FROM mlm_geneology_tree '.  
                          'WHERE userid="'.$root.'";');  
   $row = mysql_fetch_array($result);  
 
   // start with an empty $right stack  
   $right = array();  
 
   // now, retrieve all descendants of the $root node  
   $result = mysql_query('SELECT * FROM mlm_geneology_tree '.  
                          'WHERE lft BETWEEN '.$row['lft'].' AND '.  
                          $row['rgt'].' ORDER BY lft ASC;');  
 
	$i=1;
 
   while ($row = mysql_fetch_array($result)) 
   {  

       if (count($right)>0) 
	   {  
           
		     
           while ($right[count($right)-1] < $row['rgt']) 
		   {  
              array_pop($right);  
           }  
  	  }  
 
if($i <= 3)
{
$level = 1;
$od = 217;
$comm = '1%';

$commt = (217*1) / 100 ; 
}
elseif($i <= 9)
{
$level=2;
$od = 158;
$comm = '3%';
$commt = (158*3) / 100 ;
}	
else
{
$level=3;
$od = 180;
$comm = '3%';
$commt = (180*3) / 100 ;

}
	echo "<tr >";
	echo '
	 <td>'.$row['username'].'</td>
	 <td>'.$row['parent'].'</td>
	 <td>'.$level.'</td>
	 <td>'.$od.'$</td>
	 <td>20-05-2010</td>
	 <td></td>
	 <td>'.$comm.' = '.$commt.'$</td>
	 			
				<td></td>
				<td> </td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
	 
	 </tr>';
		
       $right[] = $row['rgt'];  
	  $i++;
   }  
}  

?>